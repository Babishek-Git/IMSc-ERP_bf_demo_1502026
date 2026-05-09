<?php 
namespace App\Services;

use App\Models\AemEmployee;
use App\Models\LeaveType;
use App\Models\LeaveBalance;
use App\Models\LeaveTransaction;
use App\Models\LeaveAccount;
use App\Models\LeaveApplicationDt;
use App\Models\LeaveDiesNon;
use App\Models\Holiday;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use Exception;

class LeaveCalculationService
{
    /**
     * --------------------------------
     * HALF-YEAR CREDIT ENGINE
     * Runs on 1st January and 1st July via scheduled command
     * --------------------------------
     */
    public function creditHalfYearLeave(int $year, int $halfYear): void
    {
        $employees = AemEmployee::where('is_active', true)->get();

        foreach ($employees as $employee) {
            DB::transaction(function () use ($employee, $year, $halfYear) {
                $this->creditEarnedLeave($employee, $year, $halfYear);
                $this->creditHalfPayLeave($employee, $year, $halfYear);
            });
        }
    }

    /**
     * EL Credit Calculation
     * Rule: 15 days per half-year (2.5 days per completed calendar month)
     * Deduction: 1/10 of EOL/dies-non in PREVIOUS half-year (max 15 days)
     */
    public function creditEarnedLeave(AemEmployee $employee, int $year, int $halfYear): void
    {
        $leaveType = LeaveType::where('leave_type_code', LeaveType::EL)->firstOrFail();
        $balance   = $this->getOrCreateBalance($employee, $leaveType);

        // Calculate credit days based on employee situation
        $creditDays = $this->calcELCredit($employee, $year, $halfYear);

        // Deduction for dies-non/EOL of PREVIOUS half-year
        $prevHalf      = $this->previousHalf($year, $halfYear);
        $deductionDays = $this->calcELDeduction($employee, $prevHalf['year'], $prevHalf['half']);

        $actualCredit = max(0, $creditDays - $deductionDays);
        

        // Apply max carry-forward (300 days)
        $newBalance = $balance->balance + $actualCredit;
        $maxCarry   = $leaveType->max_carry_forward ?? 300;
        $lapsed     = max(0, $newBalance - $maxCarry - $leaveType->credit_per_half_year);

        $this->recordTransaction($employee, $leaveType, 'credit', $actualCredit, $balance->balance,
            "Half-year EL credit for {$year}-H{$halfYear}");

        if ($lapsed > 0) {
            $this->recordTransaction($employee, $leaveType, 'lapse', $lapsed,
                $balance->balance + $actualCredit, "EL lapse — excess beyond max accumulation");
            $actualCredit -= $lapsed;
        }

        $balance->increment('balance', $actualCredit);

        // Record account snapshot
        LeaveAccount::updateOrCreate(
            ['emp_no' => $employee->emp_no, 'leave_type_id' => $leaveType->leave_type_id,
             'year' => $year, 'half_year' => $halfYear],
            [
                'opening_balance' => $balance->balance - $actualCredit,
                'credited'        => $actualCredit,
                'debited'         => 0,
                'lapsed'          => $lapsed,
                'closing_balance' => $balance->balance,
                'credited_at'     => now(),
            ]
        );
    }

    /**
     * HPL Credit Calculation
     * Rule: 10 days per half-year (5/3 days per completed calendar month)
     * Deduction: 1/18 of dies-non in previous half-year (max 10 days)
     */
    public function creditHalfPayLeave(AemEmployee $employee, int $year, int $halfYear): void
    {
        $leaveType = LeaveType::where('leave_type_code', LeaveType::HPL)->firstOrFail();
        $balance   = $this->getOrCreateBalance($employee, $leaveType);

        $creditDays    = $this->calcHPLCredit($employee, $year, $halfYear);
        $prevHalf      = $this->previousHalf($year, $halfYear);
        $deductionDays = $this->calcHPLDeduction($employee, $prevHalf['year'], $prevHalf['half']);

        $actualCredit = max(0, $creditDays - $deductionDays);

        $this->recordTransaction($employee, $leaveType, 'credit', $actualCredit, $balance->balance,
            "Half-year HPL credit for {$year}-H{$halfYear}");

        $balance->increment('balance', $actualCredit);
    }

    /**
     * --------------------------------
     * CREDIT CALCULATORS
     * --------------------------------
     */

    /**
     * EL = 2.5 days per completed calendar month
     * For mid-year joiners, count completed months in that half-year
     * Full half-year = 15 days (rounded)
     */
    public function calcELCredit(AemEmployee $employee, int $year, int $halfYear): float
    {
        $halfStart = Carbon::create($year, $halfYear === 1 ? 1 : 7, 1);
        $halfEnd   = Carbon::create($year, $halfYear === 1 ? 6 : 12, 1)->endOfMonth();

        $joiningDate    = Carbon::parse($employee->date_of_joining);
        $retirementDate = $employee->date_of_retirement
            ? Carbon::parse($employee->date_of_retirement)
            : null;

        // Determine effective start & end
        $effectiveStart = $joiningDate->gt($halfStart) ? $joiningDate : $halfStart;
        $effectiveEnd   = $retirementDate && $retirementDate->lt($halfEnd)
            ? $retirementDate
            : $halfEnd;

        if ($effectiveStart->gt($effectiveEnd)) {
            return 0;
        }

        $completedMonths = $this->countCompletedCalendarMonths($effectiveStart, $effectiveEnd);
        $credit          = round($completedMonths * 2.5); // 2½ days PCCM, round fraction

        return min($credit, 15); // Cap at 15 per half-year
    }

    /**
     * HPL = 5/3 days per completed calendar month
     */
    public function calcHPLCredit(AemEmployee $employee, int $year, int $halfYear): float
    {
        $halfStart = Carbon::create($year, $halfYear === 1 ? 1 : 7, 1);
        $halfEnd   = Carbon::create($year, $halfYear === 1 ? 6 : 12, 1)->endOfMonth();

        $joiningDate    = Carbon::parse($employee->date_of_joining);
        $effectiveStart = $joiningDate->gt($halfStart) ? $joiningDate : $halfStart;
        $effectiveEnd   = $halfEnd;

        if ($effectiveStart->gt($effectiveEnd)) {
            return 0;
        }

        $completedMonths = $this->countCompletedCalendarMonths($effectiveStart, $effectiveEnd);
        return round($completedMonths * (5 / 3)); // 5/3 days PCCM
    }

    /**
     * EL Deduction = 1/10 of EOL+dies-non in half-year (max 15)
     */
    public function calcELDeduction(AemEmployee $employee, int $year, int $halfYear): float
    {
        $eolDays     = $this->getEOLDays($employee, $year, $halfYear);
        $diesNonDays = $this->getDiesNonDays($employee, $year, $halfYear);
        return min(floor(($eolDays + $diesNonDays) / 10), 15);
    }

    /**
     * HPL Deduction = 1/18 of dies-non in half-year (max 10)
     */
    public function calcHPLDeduction(AemEmployee $employee, int $year, int $halfYear): float
    {
        $diesNonDays = $this->getDiesNonDays($employee, $year, $halfYear);
        return min(floor($diesNonDays / 18), 10);
    }

    /**
     * --------------------------------
     * LEAVE DAY CALCULATION (for applications)
     * --------------------------------
     */

    /**
     * Calculate working days for a leave application
     * Rules differ per leave type:
     * - CL: Sundays/holidays prefix/suffix/intervening DO NOT count
     * - EL: Saturdays, Sundays, holidays prefix/suffix DO NOT count; intervening DO count
     * - AL: weekends/holidays prefix/suffix DO NOT count; intervening DO count
     * - CCL: treated like EL
     * - HPL, LND, EOL, ML, PL: calendar days (all count)
     */
    public function calculateLeaveDays(
        string $leaveTypeCode,
        Carbon $fromDate,
        Carbon $toDate,
        ?Carbon $prefixFrom = null,  // if combining with other leave
        ?Carbon $suffixTo   = null
    ): int {
        return match ($leaveTypeCode) {
            LeaveType::CL  => $this->calcCasualLeaveDays($fromDate, $toDate),
            LeaveType::EL,
            LeaveType::CCL => $this->calcEarnedLeaveDays($fromDate, $toDate),
            LeaveType::AL  => $this->calcAcademicLeaveDays($fromDate, $toDate),
            default        => $this->calcCalendarDays($fromDate, $toDate),
        };
    }

    /**
     * CL: Do NOT count Sundays and holidays that prefix, suffix, OR intervene
     */
    private function calcCasualLeaveDays(Carbon $from, Carbon $to): int
    {
        $days   = 0;
        $period = CarbonPeriod::create($from, $to);
        foreach ($period as $date) {
            if (!$this->isHolidayOrSunday($date)) {
                $days++;
            }
        }
        return $days;
    }

    /**
     * EL: Prefix/suffix holidays do NOT count (i.e., exclude them from date range);
     * Intervening holidays DO count.
     */
    private function calcEarnedLeaveDays(Carbon $from, Carbon $to): int
    {
        // Trim prefix holidays
        while ($from->lte($to) && $this->isHolidayOrSunday($from)) {
            $from->addDay();
        }
        // Trim suffix holidays
        while ($to->gte($from) && $this->isHolidayOrSunday($to)) {
            $to->subDay();
        }
        if ($from->gt($to)) {
            return 0;
        }
        return $from->diffInDays($to) + 1; // all days including intervening holidays
    }

    /**
     * AL: weekends/declared holidays prefix/suffix excluded; intervening included
     */
    private function calcAcademicLeaveDays(Carbon $from, Carbon $to): int
    {
        return $this->calcEarnedLeaveDays($from, $to); // same logic
    }

    /**
     * Calendar days — no exclusions (ML, PL, HPL, EOL, LND)
     */
    private function calcCalendarDays(Carbon $from, Carbon $to): int
    {
        return $from->diffInDays($to) + 1;
    }

    /**
     * --------------------------------
     * ELIGIBILITY VALIDATORS
     * --------------------------------
     */

    /**
     * Master eligibility check — returns array of errors or empty array
     */
    public function checkEligibility(AemEmployee $employee, LeaveApplicationDt $application): array
    {
        $errors    = []; 
        $leaveType = $application->leaveType; 
        $code      = $leaveType->leave_type_code;

        // Gender check
        if (!empty($leaveType->applicable_genders) &&
            !in_array($employee->gender, $leaveType->applicable_genders) &&
            !in_array('all', $leaveType->applicable_genders ?? [])) {
            $errors[] = "{$leaveType->leave_type_name} is not applicable for {$employee->gender} employees.";
        }

        // Staff type check
        if (!empty($leaveType->applicable_staff_types) &&
            !in_array($employee->staff_type, $leaveType->applicable_staff_types)) {
            $errors[] = "{$leaveType->leave_type_name} is not applicable for {$employee->staff_type} staff.";
        }
        
        // Balance check (for debited leaves)
        if ($leaveType->is_debited_to_account &&
            !in_array($code, [LeaveType::ML, LeaveType::PL, LeaveType::CCL, LeaveType::STL, LeaveType::LND])) {
            $balance = $this->getAvailableBalance($employee, $leaveType);
            if ($balance < $application->actual_days) {
                $errors[] = "Insufficient {$leaveType->leave_type_short_name} balance. Available: {$balance}, Required: {$application->actual_days}.";
            }
        }

        // CL specific: max 5 days at a time
        if ($code === LeaveType::CL) {
            if ($application->actual_days > 5) {
                $errors[] = "Casual Leave cannot exceed 5 days at a time (requires Director approval for exceptions).";
            }
            // CL cannot be combined with other leave
        }

        // CL annual check
        if ($code === LeaveType::CL) {
            $yearUsed = $this->getCLUsedThisYear($employee);
            if (($yearUsed + $application->actual_days) > 8) {
                $errors[] = "Total Casual Leave for the year cannot exceed 8 days. Already used: {$yearUsed}.";
            }
        }

        // AL: max 60 days per year (academic staff only)
        if ($code === LeaveType::AL) {
            if (!in_array($employee->staff_type, ['academic', 'pdf', 'jrf'])) {
                //$errors[] = "Academic Leave is only for Academic Staff, PDFs, and JRFs.";
            }
            $yearUsed = $this->getALUsedThisYear($employee);
            if (($yearUsed + $application->actual_days) > 60) {
                $errors[] = "Academic Leave cannot exceed 60 days per year. Used: {$yearUsed}.";
            }
        }

        // ML: max 180 days for child birth (< 2 surviving children)
        if ($code === LeaveType::ML) {
            $errors = array_merge($errors, $this->validateMaternityLeave($employee, $application));
        }

        // PL validations
        if ($code === LeaveType::PL) {
            $errors = array_merge($errors, $this->validatePaternityLeave($employee, $application));
        }

        // CCL validations
        if ($code === LeaveType::CCL) {
            $errors = array_merge($errors, $this->validateCCL($employee, $application));
        }

        // LND: max 360 days entire service; requires MC
        if ($code === LeaveType::LND) {
            $errors = array_merge($errors, $this->validateLND($employee, $application));
        }

        // Commuted Leave: not more than half HPL due
        if ($code === LeaveType::CML) {
            $errors = array_merge($errors, $this->validateCommutedLeave($employee, $application));
        }

        // Study Leave
        if ($code === LeaveType::STL) {
            $errors = array_merge($errors, $this->validateStudyLeave($employee, $application));
        }

        // Sabbatical Leave
        if ($code === LeaveType::SBL) {
            $errors = array_merge($errors, $this->validateSabbatical($employee, $application));
        }

        // Max continuous leave: 5 years
        $totalContinuousDays = $this->getContinuousLeaveDays($employee, $application->from_date);
        if (($totalContinuousDays + $application->actual_days) > (5 * 365)) {
            $errors[] = "Total continuous leave cannot exceed 5 years.";
        }

        return $errors;
    }

    /**
     * Maternity Leave Rules:
     * - Female only
     * - Less than 2 surviving children
     * - 180 days for childbirth/adoption (child < 1 year)
     * - 45 days for abortion/miscarriage (once in entire service, requires MC)
     */
    private function validateMaternityLeave(AemEmployee $employee, LeaveApplicationDt $application): array
    {
        $errors = [];

        if ($employee->surviving_children_count >= 2) {
            $errors[] = "Maternity Leave (180 days) is not admissible. Employee already has 2 or more surviving children.";
        }

        // Get the ML leave_type_id directly — no relationship needed on LeaveTransaction
        $mlType = LeaveType::where('leave_type_code', LeaveType::ML)->first();

        $alreadyAvailed = $mlType
            ? LeaveTransaction::where('emp_no', $employee->emp_no)
                ->where('leave_type_id', $mlType->leave_type_id)
                ->where('transaction_type', 'debit')
                ->sum('amount')
            : 0;

        $maxAllowed = 225;
        if (($alreadyAvailed + $application->actual_days) > $maxAllowed) {
            $errors[] = "Total Maternity Leave (including abortion) cannot exceed 225 days in service.";
        }

        return $errors;
    }

    /**
     * Paternity Leave Rules:
     * - Male only
     * - Less than 2 surviving children
     * - 15 days within 15 days before or 6 months after delivery
     * - If not availed, lapses
     */
    private function validatePaternityLeave(AemEmployee $employee, LeaveApplicationDt $application): array
    {
        $errors = [];

        if ($employee->surviving_children_count >= 2) {
            $errors[] = "Paternity Leave is not admissible. Employee already has 2 or more surviving children.";
        }

        if ($application->actual_days > 15) {
            $errors[] = "Paternity Leave cannot exceed 15 days.";
        }

        return $errors;
    }

    /**
     * Child Care Leave Rules:
     * - Female only
     * - Children below 18 (no age limit for disabled children)
     * - Max 730 days in entire service
     * - Max 3 spells per calendar year
     * - For two eldest children only
     * - Not during probation (except extreme cases)
     */
    private function validateCCL(AemEmployee $employee, LeaveApplicationDt $application): array
    {
        $errors = [];

        $totalAvailed = $this->getTotalAvailed($employee, LeaveType::CCL);
        if (($totalAvailed + $application->actual_days) > 730) {
            $remaining = 730 - $totalAvailed;
            $errors[]  = "CCL balance exhausted. Remaining entitlement: {$remaining} days.";
        }

        // Max 3 spells per year
        $spellsThisYear = LeaveApplicationDt::where('emp_no', $employee->emp_no)
            ->whereHas('leaveType', fn($q) => $q->where('leave_type_code', LeaveType::CCL))
            ->whereYear('from_date', now()->year)
            ->whereIn('status', ['approved', 'availed'])
            ->count();

        if ($spellsThisYear >= 3) {
            $errors[] = "CCL cannot be granted more than 3 times (spells) in a calendar year.";
        }

        // Probation check
        if ($employee->employment_type === 'temporary' && !$employee->date_of_confirmation) {
            $errors[] = "CCL is generally not granted during probation period.";
            // Note: competent authority can override in extreme cases — this is a warning
        }

        return $errors;
    }

    /**
     * Leave Not Due Rules:
     * - Must be permanent OR temporary with 1+ year service + specified illness
     * - Medical cert mandatory
     * - Max 360 days in service
     */
    private function validateLND(AemEmployee $employee, LeaveApplicationDt $application): array
    {
        $errors = [];

        if ($employee->employment_type === 'temporary') {
            $yearsOfService = Carbon::parse($employee->date_of_joining)->diffInYears(now());
            if ($yearsOfService < 1) {
                $errors[] = "LND is not admissible. Temporary staff require at least 1 year of service.";
            }
        }

        if (empty($application->medical_certificate_no)) {
            //$errors[] = "Medical Certificate is mandatory for Leave Not Due.";
        }

        $totalAvailed = $this->getTotalAvailed($employee, LeaveType::LND);
        if (($totalAvailed + $application->actual_days) > 360) {
            $remaining = 360 - $totalAvailed;
            $errors[]  = "LND exceeds lifetime limit. Remaining: {$remaining} days.";
        }

        // HPL balance check for LND (it draws against future HPL)
        // Actually LND is granted against anticipated HPL — check if it would create excessive liability

        return $errors;
    }

    /**
     * Commuted Leave = not exceeding half of HPL due
     * 2× commuted leave is debited to HPL
     */
    private function validateCommutedLeave(AemEmployee $employee, LeaveApplicationDt $application): array
    {
        $errors = [];

        $hplType    = LeaveType::where('leave_type_code', LeaveType::HPL)->firstOrFail();
        $hplBalance = $this->getBalance($employee, $hplType);
        $maxAllowed = floor($hplBalance / 2);

        if ($application->actual_days > $maxAllowed) {
            $errors[] = "Commuted Leave cannot exceed half of HPL balance ({$maxAllowed} days). HPL available: {$hplBalance}.";
        }

        // MC required unless for approved course of study (max 90 days without MC in service)
        if (empty($application->medical_certificate_no) && $application->actual_days > 0) {
            // Check if purpose is study (special exception up to 90 days)
            if ($application->purpose !== 'approved_course_of_study') {
                $errors[] = "Medical Certificate is required for Commuted Leave.";
            }
        }

        return $errors;
    }

    /**
     * Study Leave Rules:
     * - Minimum 5 years service (1 year for Academic Staff)
     * - Max 12 months at one time
     * - Max 24 months in entire service
     * - Must serve 3 years after leave
     */
    private function validateStudyLeave(AemEmployee $employee, LeaveApplicationDt $application): array
    {
        $errors = [];

        $minYears = in_array($employee->staff_type, ['academic']) ? 1 : 5;
        $yearsOfService = Carbon::parse($employee->date_of_joining)->diffInYears(now());

        if ($yearsOfService < $minYears) {
            $errors[] = "Study Leave requires minimum {$minYears} year(s) of service. Current service: {$yearsOfService} year(s).";
        }

        if ($application->actual_days > 365) {
            $errors[] = "Study Leave cannot exceed 12 months at one time.";
        }

        $totalAvailed = $this->getTotalAvailed($employee, LeaveType::STL);
        if (($totalAvailed + $application->actual_days) > 730) {
            $remaining = 730 - $totalAvailed;
            $errors[]  = "Study Leave exceeds lifetime limit (24 months). Remaining: {$remaining} days.";
        }

        return $errors;
    }

    /**
     * Sabbatical Leave Rules:
     * - Only for faculty (academic staff)
     * - Max 1 year in every 6 years (counting from Reader F date)
     * - Between two long leaves: must have 3 years in Institute
     * - 2nd year possible only in exceptional cases (EoL + partial EL, not Sabbatical)
     */
    private function validateSabbatical(AemEmployee $employee, LeaveApplicationDt $application): array
    {
        $errors = [];

        if ($employee->staff_type !== 'academic') {
            $errors[] = "Sabbatical Leave is applicable only for Faculty (Academic Staff).";
            return $errors;
        }

        if (!$employee->date_reader_f) {
            $errors[] = "Sabbatical Leave can only be granted after the employee becomes a Reader F.";
            return $errors;
        }

        // Check 1-year-in-6-years rule
        $readerFDate = Carbon::parse($employee->date_reader_f);
        $periodStart = $readerFDate->copy();

        $sabbaticalDaysInPeriod = SabbaticalRecord::where('emp_no', $employee->emp_no)
            ->where('leave_type', 'sabbatical')
            ->whereDate('from_date', '>=', $periodStart)
            ->sum('days');

        // Calculate which 6-year window we're in
        $yearsSinceReaderF = $readerFDate->diffInYears(now());
        $allowedDays       = floor($yearsSinceReaderF / 6) * 365 + 365; // 1 year per 6 years

        if (($sabbaticalDaysInPeriod + $application->actual_days) > $allowedDays) {
            $errors[] = "Sabbatical Leave quota exhausted. Rule: max 1 year per 6-year block since Reader F.";
        }

        // 3-year stay between long leaves
        $lastLongLeave = SabbaticalRecord::where('emp_no', $employee->emp_no)
            ->orderByDesc('to_date')
            ->first();

        if ($lastLongLeave) {
            $daysSinceLastLeave = Carbon::parse($lastLongLeave->to_date)->diffInYears(now());
            if ($daysSinceLastLeave < 3) {
                $errors[] = "Minimum 3-year stay in the Institute required between two long-term leaves.";
            }
        }

        return $errors;
    }

    /**
     * --------------------------------
     * LEAVE DEBIT ENGINE (called when leave is approved/availed)
     * --------------------------------
     */
    public function debitLeave(LeaveApplicationDt $application): void
    {
        DB::transaction(function () use ($application) {
            $employee  = $application->employee;
            $leaveType = $application->leaveType;
            $days      = $application->actual_days;

            if (!$leaveType->is_debited_to_account) {
                return; // ML, PL — not debited
            }

            // Commuted Leave: debit 2× from HPL
            if ($leaveType->leave_type_code === LeaveType::CML) {
                $hplType    = LeaveType::where('leave_type_code', LeaveType::HPL)->firstOrFail();
                $hplBalance = $this->getOrCreateBalance($employee, $hplType);
                $hplDebit   = $days * 2;

                $this->recordTransaction($employee, $hplType, 'debit', $hplDebit, $hplBalance->balance,
                    "HPL debited for Commuted Leave: App #{$application->application_no}");

                $hplBalance->decrement('balance', $hplDebit);
                return;
            }

            $balance = $this->getOrCreateBalance($employee, $leaveType);

            if ($balance->balance < $days && $leaveType->leave_type_code !== LeaveType::LND) {
                throw new Exception("Insufficient {$leaveType->leave_type_code} balance.");
            }

            $this->recordTransaction($employee, $leaveType, 'debit', $days, $balance->balance,
                "Leave availed: App #{$application->application_no}");

            $balance->decrement('balance', $days);
            $balance->increment('total_availed_service', $days);
        });
    }

    /**
     * Reverse a leave debit (on cancellation before availing)
     */
    public function reverseLeaveDebit(LeaveApplicationDt $application): void
    {
        DB::transaction(function () use ($application) {
            $employee  = $application->employee;
            $leaveType = $application->leaveType;
            $days      = $application->actual_days;

            if (!$leaveType->is_debited_to_account) {
                return;
            }

            $balance = $this->getOrCreateBalance($employee, $leaveType);

            $this->recordTransaction($employee, $leaveType, 'reversal', $days, $balance->balance,
                "Leave cancelled/reversed: App #{$application->application_no}");

            $balance->increment('balance', $days);
            $balance->decrement('total_availed_service', $days);
        });
    }

    /**
     * --------------------------------
     * UTILITY HELPERS
     * --------------------------------
     */

    public function getBalance(AemEmployee $employee, LeaveType $leaveType): float
    {
        return $this->getOrCreateBalance($employee, $leaveType)->balance;
    }

    private function getOrCreateBalance(AemEmployee $employee, LeaveType $leaveType): LeaveBalance
    { 
        return LeaveBalance::firstOrCreate(
            ['emp_no' => $employee->emp_no, 'leave_type_id' => $leaveType->leave_type_id],
            ['balance' => 0, 'total_availed_service' => 0]
        );
    }

    private function recordTransaction(
        AemEmployee   $employee,
        LeaveType  $leaveType,
        string     $type,
        float      $amount,
        float      $balanceBefore,
        string     $remarks = ''
    ): void {
        $balanceAfter = match ($type) {
            'credit', 'reversal' => $balanceBefore + $amount,
            'debit', 'lapse'     => $balanceBefore - $amount,
            'adjustment'         => $balanceBefore + $amount, // can be negative for adjustment
            default              => $balanceBefore,
        };

        LeaveTransaction::create([
            'emp_no'    => $employee->emp_no,
            'leave_type_id'  => $leaveType->leave_type_id,
            'transaction_type' => $type,
            'amount'         => abs($amount),
            'balance_before' => $balanceBefore,
            'balance_after'  => $balanceAfter,
            'remarks'        => $remarks,
            'created_by'     => $employee->emp_no,
        ]);
    }

    private function isHolidayOrSunday(Carbon $date): bool
    {
        if ($date->isSaturday() || $date->isSunday()) {
            return true;
        }
        return Holiday::where('holiday_date', $date->toDateString())
            ->whereIn('holiday_type', ['gazetted', 'institute_closed'])
            ->exists();
    }

    /**
     * Count completed calendar months between two dates
     * "Completed" = full month (at least from 1st to last day of month, or partial month >= 15 days)
     * Per CCS rules: 2½ days per COMPLETED calendar month (PCCM)
     */
    private function countCompletedCalendarMonths(Carbon $start, Carbon $end): int
    {
        $months   = 0;
        $current  = $start->copy()->startOfMonth();
        $endMonth = $end->copy()->startOfMonth();

        while ($current->lte($endMonth)) {
            $monthStart = $current->copy()->startOfMonth();
            $monthEnd   = $current->copy()->endOfMonth();

            $effectiveStart = $start->gt($monthStart) ? $start : $monthStart;
            $effectiveEnd   = $end->lt($monthEnd) ? $end : $monthEnd;

            // A calendar month is "completed" if all working days of the month are present
            // Simplified: if the employee was present for the full calendar month
            if ($effectiveStart->equalTo($monthStart) && $effectiveEnd->equalTo($monthEnd)) {
                $months++;
            }
            // Note: CCS rules say PCCM — partial months don't count
            // Strict interpretation: only count full calendar months

            $current->addMonth();
        }

        return $months;
    }

    private function getEOLDays(AemEmployee $employee, int $year, int $halfYear): int
    {
        $halfStart = Carbon::create($year, $halfYear === 1 ? 1 : 7, 1);
        $halfEnd   = Carbon::create($year, $halfYear === 1 ? 6 : 12, 1)->endOfMonth();

        $leaveType = LeaveType::where('leave_type_code', LeaveType::EOL)->first();
        if (!$leaveType) return 0;

        return LeaveApplicationDt::where('emp_no', $employee->emp_no)
            ->where('leave_type_id', $leaveType->leave_type_id)
            ->whereIn('status', ['approved', 'availed'])
            ->where('from_date', '>=', $halfStart)
            ->where('to_date', '<=', $halfEnd)
            ->sum('actual_days');
    }

    private function getDiesNonDays(AemEmployee $employee, int $year, int $halfYear): int
    {
        $halfStart = Carbon::create($year, $halfYear === 1 ? 1 : 7, 1);
        $halfEnd   = Carbon::create($year, $halfYear === 1 ? 6 : 12, 1)->endOfMonth();

        return LeaveDiesNon::where('emp_no', $employee->emp_no)
            ->where('year', $year)
            ->where('half_year', $halfYear)
            ->sum('days');
    }

    private function getCLUsedThisYear(AemEmployee $employee): int
    {
        $leaveType = LeaveType::where('leave_type_code', LeaveType::CL)->first();
        if (!$leaveType) return 0;

        return LeaveApplicationDt::where('emp_no', $employee->emp_no)
            ->where('leave_type_id', $leaveType->leave_type_id)
            ->whereIn('status', ['approved', 'availed'])
            ->whereYear('from_date', now()->year)
            ->sum('actual_days');
    }

    private function getALUsedThisYear(AemEmployee $employee): int
    {
        $leaveType = LeaveType::where('leave_type_code', LeaveType::AL)->first();
        if (!$leaveType) return 0;

        return LeaveApplicationDt::where('emp_no', $employee->emp_no)
            ->where('leave_type_id', $leaveType->leave_type_id)
            ->whereIn('status', ['approved', 'availed'])
            ->whereYear('from_date', now()->year)
            ->sum('actual_days');
    }

    private function getTotalAvailed(AemEmployee $employee, string $leaveCode): int
    {
        $balance = LeaveBalance::where('emp_no', $employee->emp_no)
            ->whereHas('leaveType', fn($q) => $q->where('leave_type_code', $leaveCode))
            ->first();
        return $balance ? (int) $balance->total_availed_service : 0;
    }

    private function getContinuousLeaveDays(AemEmployee $employee, Carbon $fromDate): int
    {
        // Find if there's already leave running just before fromDate
        $prevLeave = LeaveApplicationDt::where('emp_no', $employee->emp_no)
            ->whereIn('status', ['approved', 'availed'])
            ->where('to_date', $fromDate->copy()->subDay())
            ->first();

        if (!$prevLeave) {
            return 0;
        }

        // Recursively count (simplified: just count total days in continuous block)
        return LeaveApplicationDt::where('emp_no', $employee->emp_no)
            ->whereIn('status', ['approved', 'availed'])
            ->where('from_date', '>=', $fromDate->copy()->subYears(5))
            ->where('to_date', '<', $fromDate)
            ->sum('actual_days');
    }

    private function previousHalf(int $year, int $halfYear): array
    {
        if ($halfYear === 1) {
            return ['year' => $year - 1, 'half' => 2];
        }
        return ['year' => $year, 'half' => 1];
    }
    public function getUsedThisYear(AemEmployee $employee, string $leaveCode): int
    {
        $leaveType = LeaveType::where('leave_type_code', $leaveCode)->first();

        if (!$leaveType) return 0;

        return LeaveApplicationDt::where('emp_no', $employee->emp_no)
            ->where('leave_type_id', $leaveType->leave_type_id)
            ->whereIn('status', ['approved', 'availed'])
            ->whereYear('from_date', now()->year)
            ->sum('actual_days');
    }

    public function getAvailableBalance(AemEmployee $employee, LeaveType $leaveType): float
    {
        if ($leaveType->max_per_year) {
            // CL, AL — remaining this year = max_per_year - used
            $used = $this->getUsedThisYear($employee, $leaveType->leave_type_code);
            return max(0, $leaveType->max_per_year - $used);
        }

        if ($leaveType->max_entire_service) {
            // ML, PL, CCL, LND, STL — remaining in service
            $balance = LeaveBalance::where('emp_no', $employee->emp_no)
                ->where('leave_type_id', $leaveType->leave_type_id)
                ->first();
            $availed = $balance ? $balance->total_availed_service : 0;
            return max(0, $leaveType->max_entire_service - $availed);
        }

        // EL, HPL, CML — stored balance
        return $this->getBalance($employee, $leaveType);
    }
}