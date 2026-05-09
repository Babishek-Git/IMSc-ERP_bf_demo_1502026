<?php
namespace App\Services;

use App\Models\AemEmployee;
use App\Models\LeaveApplicationDt;
use App\Models\LeaveType;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Exception;

class LeaveApplicationService
{
    public function __construct(
        private LeaveCalculationService $calcService
    ) {}

    public function apply(AemEmployee $employee, array $data): LeaveApplicationDt
    { 
        $leaveType = LeaveType::findOrFail($data['leave_type_id']);
        $fromDate = Carbon::createFromFormat('Y-m-d', $data['from_date'])->startOfDay();
        $toDate   = Carbon::createFromFormat('Y-m-d', $data['to_date'])->startOfDay();
         
        // Validate CL cannot be combined
        if ($leaveType->leave_type_code === LeaveType::CL && isset($data['combined_with'])) {
            throw new Exception("Casual Leave cannot be combined with any other leave.");
        }
        
        $actualDays = $this->calcService->calculateLeaveDays(
            $leaveType->leave_type_code, $fromDate, $toDate
        );
        
        
        $application = LeaveApplicationDt::create([
            ...$data,
            'emp_no'    => $employee->emp_no,
            'applied_days'   => $fromDate->diffInDays($toDate) + 1,
            'actual_days'    => $actualDays,
            'status'         => 'submitted',
        ]);
        
        // Validate eligibility
        $errors = $this->calcService->checkEligibility($employee, $application);
        if (!empty($errors)) {
            $application->delete();
            throw new Exception(implode("\n", $errors));
        }
       //dd($leaveType->leave_type_code);
        return $application;
    }

    public function approve(LeaveApplicationDt $application, AemEmployee $approver): LeaveApplicationDt
    {
        if (!$application->isPending()) {
            throw new Exception("Leave application is not in a pending state.");
        }
        $application->update([
            'status'      => 'approved',
            'approved_by' => $approver->emp_no,
            'approved_at' => now(),
        ]);
            
        // Debit leave balance
        $this->calcService->debitLeave($application);

        return $application;
    }

    public function cancel(LeaveApplicationDt $application): LeaveApplicationDt
    {
        if ($application->isApproved()) {
            // Reverse debit if leave has not started
            if (Carbon::parse($application->from_date)->isFuture()) {
                $this->calcService->reverseLeaveDebit($application);
            }
        }

        $application->update(['status' => 'cancelled']);
        return $application;
    }

    public function markJoined(LeaveApplicationDt $application, Carbon $joinDate): void
    {
        $application->update([
            'actual_join_date' => $joinDate,
            'joined'           => true,
            'status'           => 'availed',
        ]);

        // Post-join validation for Commuted / LND
        $code = $application->leaveType->leave_type_code;

        if (in_array($code, [LeaveType::CML, LeaveType::LND])) {
            // If employee resigns/retires after LND without returning
            // This is handled at the time of separation — see SeparationService
        }
    }

    public function generateApplicationNo(): string
    {
        $year  = now()->year;
        $count = LeaveApplicationDt::whereYear('created_at', $year)->count() + 1;
        return sprintf("IMSC/LV/%d/%04d", $year, $count);
    }
}