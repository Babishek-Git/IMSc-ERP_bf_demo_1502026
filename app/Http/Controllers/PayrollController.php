<?php

namespace App\Http\Controllers;
use App\Services\PayrollCalculationService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\AemEmployee;
use App\Models\AgmOffice;
use App\Models\DesignationMaster;
use App\Models\organization;
use App\Models\EmployeeCategory;
use App\Models\EmployeeSalute;
use App\Models\EmployeeMaritalStatus;
use App\Models\EmployeeGroupMaster;
use App\Models\Role;
use App\Models\PayComponent;
use App\Models\PayComponentRuleType;
use App\Models\PayLevel;
use App\Models\EmployeePayLevel;
use App\Models\EmployeePayComponent;
use App\Models\EmployeePayBank;
use App\Models\EmployeeInsurance;
use App\Models\EmployeeAttendanceMaster;
use App\Models\EmployeeAttendanceDt;
use App\Models\PayRollMaster;
use App\Models\PayRollEmployee;
use App\Models\PayRollComponent;
use App\Models\EmployeeType;
use App\Models\BankBranchMaster;
use App\Models\BankMaster;
use App\models\EmpAllowAdvLoan;
use App\models\EmpAllowAdvLoanInstallment;
use App\models\EBCharges;
use App\models\HouseMaster;
use App\Models\EmpProjectedTax;
use App\Models\Payment;
use Helper;
use DB;
use Session;
class PayrollController extends Controller
{
    protected $payrollService;
    public function __construct(PayrollCalculationService $payrollService){ 
        $this->payrollService = $payrollService; /// For Payroll Calculation Services
        $this->Employee = new AemEmployee();
        $this->Office = new AgmOffice();
        $this->desigination = new DesignationMaster();
        $this->organization = new organization();
        $this->EmployeeSalute = new EmployeeSalute();
        $this->EmployeeMaritalStatus = new EmployeeMaritalStatus();
        $this->Category = new EmployeeCategory();
        $this->EmployeeGroupMaster = new EmployeeGroupMaster();
        $this->role  = new Role();
        $this->PayLevel  = new PayLevel();
        $this->EmployeePayLevel  = new EmployeePayLevel();
        $this->EmployeePayComponent  = new EmployeePayComponent();
        $this->EmployeePayBank  = new EmployeePayBank();
        $this->insurance  = new EmployeeInsurance();
        $this->EmployeeAttendanceMaster = new EmployeeAttendanceMaster();
        $this->EmployeeAttendanceDt = new EmployeeAttendanceDt();
        $this->PayRollMaster = new PayRollMaster();
        $this->PayRollEmployee = new PayRollEmployee();
        $this->PayRollComponent = new PayRollComponent();
        $this->EmployeeType =new EmployeeType();
        $this->BankBranchMaster =new BankBranchMaster();
        $this->BankMaster =new BankMaster();
        $this->EmpAllowAdvLoan = new EmpAllowAdvLoan();
        $this->EmpAllowAdvLoanInstallment = new EmpAllowAdvLoanInstallment();
        $this->EBCharges = new EBCharges();
        $this->HouseMaster = new HouseMaster();
        $this->EmpProjectedTax = new EmpProjectedTax();
        $this->Payment = new Payment();
    }
    public function PayGenerate(Request $request)
    {
        
        if(isset($request->btn_initiate)){  
            $Page = 'PAYGEN';
            $EmpGroupId     = $request->ch_emp_group; 
            $PayGenYear     = $request->cmb_pay_year; 
            $PayGenMonth    = $request->cmb_pay_month; 

            $EmpGroupIdArr = [$EmpGroupId];
            $EmpGroupStr = implode(",",$EmpGroupIdArr);
            
            $homeComponentFilterArr = array("HDEDU");
            $homePayComponents      = PayComponent::withType()->active()
                                    ->whereHas('componentType', function ($q) use ($homeComponentFilterArr) {
                                    $q->whereIn('component_type_code', $homeComponentFilterArr)->where('component_code','!=','BASIC');
                                })
                                ->orderBy('dp_order','ASC')->get(); 
            
            $componentFilterArr = array("DEDU","EARN");
            $payComponents      = PayComponent::withType()->active()
                                    ->whereHas('componentType', function ($q) use ($componentFilterArr) {
                                    $q->whereIn('component_type_code', $componentFilterArr)->where('component_code','!=','BASIC');
                                })
                                ->orderBy('dp_order','ASC')->get(); 

            $investComponentFilterArr = array("INVE");
            $investPayComponents      = PayComponent::withType()->active()
                                    ->whereHas('componentType', function ($q) use ($investComponentFilterArr) {
                                    $q->whereIn('component_type_code', $investComponentFilterArr)->where('component_code','!=','BASIC');
                                })
                                ->orderBy('dp_order','ASC')->get(); 

            if(filled($payComponents)){
                $groupedPayComponents = $payComponents->groupBy(function ($item) {
                    return $item['componentType']['pay_effect'];
                });
            }else{
                $groupedPayComponents = [];
            } 

            $employeeGroupMaster = $this->EmployeeGroupMaster->ShowEmployeeGroupByGrpIdArr($EmpGroupIdArr);  
            $EmployeeList = $this->Employee->ShowEmployeeByEmpGrpArr($EmpGroupIdArr); 
            $EmpGroupedData = filled($EmployeeList) ? collect($EmployeeList)->keyBy('emp_no') : [];
            $EmpNoList = filled($EmployeeList) ? collect($EmployeeList)->pluck('emp_no')->toArray() : [];
            $EmployeePayComponentList = $this->EmployeePayComponent->multipleEmployeePayComonent($EmpNoList); 
            $EmpPayComponentData = [];
            if(filled($EmployeePayComponentList)){
                foreach($EmployeePayComponentList as $EmployeePayComponent) {
                    $EmpPayComponentData[$EmployeePayComponent->emp_no][$EmployeePayComponent->component_id] = $EmployeePayComponent;
                }
            } 
            $EmployeePayLevelList = $this->EmployeePayLevel->multipleEmployeePayLevel($EmpNoList);
            $EmployeePayLevelGrpData = filled($EmployeePayLevelList) ? collect($EmployeePayLevelList)->keyBy('emp_no')->toArray() : [];
            $EmpAttendanceMaster = $this->EmployeeAttendanceMaster->employeeAttendanceMaster($PayGenYear,$PayGenMonth);
            $AttendMastId = filled($EmpAttendanceMaster) ? collect($EmpAttendanceMaster)->where('emp_group_type',$EmpGroupId)->pluck('attendance_master_id')->first() : NULL;
            $EmpAttendanceData = $this->EmployeeAttendanceDt->employeeAttendanceDtAll($AttendMastId);
            $EmpAttendanceGrpData = filled($EmpAttendanceData) ? collect($EmpAttendanceData)->keyBy('emp_no')->toArray() : [];
            $DaysInMonth = Helper::GetDaysInMonth($PayGenMonth,$PayGenYear);

            $EmpActiveLoanList = $this->EmpAllowAdvLoan->ShowEmpAllowAdvLoanPayMultiipleEmp($EmpNoList);
            $EmpActiveLoanData = []; $EmpActiveLoanInstallData = []; $ActiveLoanIdList = [];
            if(filled($EmpActiveLoanList)){
                $EmpActiveLoanIdList = $EmpActiveLoanList->pluck('emp_allow_adv_load_id')->toArray();
                if(filled($EmpActiveLoanIdList)){
                    $PayDate = $PayGenYear."-".$PayGenMonth."-01";
                    $EmpActiveLoanInstallList = $this->EmpAllowAdvLoanInstallment->ShowEmpAllowAdvLoanPayInstallmentMultiple($EmpActiveLoanIdList,$PayDate);
                    if(filled($EmpActiveLoanInstallList)){
                        $EmpActiveLoanInstallData = $EmpActiveLoanInstallList->groupBy('emp_allow_adv_load_id');
                    }
                }
                $EmpActiveLoanData = $EmpActiveLoanList->groupBy('emp_no');
                $ActiveLoanIdList = $EmpActiveLoanList->pluck('component_id')->unique()->toArray();
            }
            //dd($payComponents);
            $EmpEbChargeList = [];
            $EmpEbChargeData = $this->EBCharges->ShowEbChargesForPayRoll($PayGenMonth,$PayGenYear,$EmpNoList);
            if(filled($EmpEbChargeData)){
                $EmpEbChargeList = $EmpEbChargeData->keyBy('emp_no');
            }
            //dd($EmpActiveLoanList);
            $EmpHouseStayedList = [];
            $EmpHouseStayedData = $this->HouseMaster->ShowHouseMasterForStayedEmp($EmpNoList);
            if(filled($EmpHouseStayedData)){
                $EmpHouseStayedList = $EmpHouseStayedData->keyBy('emp_no');
            }

            $EmpInsuranceList = [];
            $CheckDate = date('Y-m-d');
            $EmpInsuranceData = $this->insurance->ShowMultipleEmployeeInsurance($EmpNoList,$CheckDate);
            if(filled($EmpInsuranceData)){
                $EmpInsuranceList = $EmpInsuranceData->groupBy('emp_no');
            }
            $PrevProjectedTaxData = [];
            $TaxFinYear = Helper::GetFinYearByMonthYear($PayGenMonth,$PayGenYear);
            $PrevProjectedTaxList = $this->EmpProjectedTax->showProjectedTaxForMultipleEmp($TaxFinYear,$EmpNoList);
            if(filled($PrevProjectedTaxList)){
                $PrevProjectedTaxData = $PrevProjectedTaxList->groupBy('emp_no');
            }
            //dd($EmpCalculatedTaxData);

            try {
                $effectiveDate = now()->format('Y-m-d');
                $results = [];
    
                foreach ($EmployeePayLevelList as $employee) {
                    $empNo = $employee->emp_no;
                    $BasicForPayCalc = $employee->basic_salary;
                    //if(isset($EmpAttendanceGrpData[$empNo])){
                        $AttendendanceData = $EmpAttendanceGrpData[$empNo] ?? [];
                        $PayCalcDays = $AttendendanceData['days_pay_calc'] ?? 0;
                        $EmpWorkingDays = $AttendendanceData['emp_working_days'] ?? 0;
                        if($EmpWorkingDays > 0){
                            $BasicPerDay = $employee->basic_salary / $EmpWorkingDays;
                        }else{
                            $BasicPerDay = 0;
                        }
                        $BasicForPayCalc = round($BasicPerDay * $PayCalcDays);
                    //}
                    
                    $TaxRegime = 'NEW'; $EmpData = [];
                    if(isset($EmpGroupedData[$empNo])){
                        $EmpData    = $EmpGroupedData[$empNo];
                        $TaxRegime  = $EmpData->tax_regime ?? 'NEW';
                    }

                    $EmpLoanData = []; $TotalLoanRecoveryAmount = 0; $TotalLoanDisbursementAmount = 0; $AllowAdvLoanIdArr = [];
                    if(isset($EmpActiveLoanData[$empNo])){
                        $EmpActiveLoan  = $EmpActiveLoanData[$empNo];
                        if(filled($EmpActiveLoan)){
                            foreach($EmpActiveLoan as $EmpActiveLoanKey => $EmpAllowAdvLoan){
                                $EmpAllowAdvLoanId       = $EmpAllowAdvLoan->emp_allow_adv_load_id;
                                $AllowAdvLoanIssueStatus = $EmpAllowAdvLoan->aal_issue_status;
                                $Status                  = $EmpAllowAdvLoan->status;
                                if(($Status == 'approved')&&($Status == 'pending')){
                                    $TotalLoanDisbursementAmount = $TotalLoanDisbursementAmount + $EmpAllowAdvLoan->aal_amount;
                                }
                                $TempArr = array();
                                if(isset($EmpActiveLoanInstallData[$EmpAllowAdvLoanId])){
                                    $EmpActiveLoanInstall = $EmpActiveLoanInstallData[$EmpAllowAdvLoanId];
                                    if(filled($EmpActiveLoanInstall)){
                                        foreach($EmpActiveLoanInstall as $EmpActiveLoanInstallKey => $EmpActiveLoanInstallValue){
                                            $TempArr[] = $EmpActiveLoanInstallValue;
                                            $TotalLoanRecoveryAmount = $TotalLoanRecoveryAmount + $EmpActiveLoanInstallValue->total_amount;
                                        }
                                    }
                                }
                                $TempArr2 = [];
                                if(filled($TempArr)){
                                    $TempArr2['loan_data'] = $EmpAllowAdvLoan;
                                    $TempArr2['install_data'] = $TempArr;
                                    $TempArr2['loan_recovery_amt'] = $TotalLoanRecoveryAmount;
                                    $TempArr2['loan_disbursement_amt'] = $TotalLoanDisbursementAmount;
                                    $EmpLoanData[] = $TempArr2;
                                }
                            }
                        }
                    }
                    $EbChargeAmount = 0; $EbChargeUnit = 0; $LicenceFees = 0; $WaterCharge = 0; $TotalInsuranceAmount = 0;
                    $OtherRecArr = [];
                    if(isset($EmpEbChargeList[$empNo])){
                        $EmpEbCharge = $EmpEbChargeList[$empNo];
                        if(filled($EmpEbCharge)){
                            $EbChargeAmount = $EmpEbCharge->pluck('eb_amount')->first();
                            $EbChargeUnit   = $EmpEbCharge->pluck('eb_consump_unit')->first();
                        }
                    }
                    $OtherRecArr['eb_amount'] = $EbChargeAmount;
                    $OtherRecArr['eb_consump_unit'] = $EbChargeUnit;
                    
                    if(isset($EmpHouseStayedList[$empNo])){
                        $EmpHouseStayed = $EmpHouseStayedList[$empNo];
                        if(filled($EmpHouseStayed)){  
                            $LicenceFees = $EmpHouseStayed->licence_fee;//$EmpHouseStayed->pluck('licence_fee')->first(); 
                            $WaterCharge = $EmpHouseStayed->water_charge;//$EmpHouseStayed->pluck('water_charge')->first();
                        }
                    }
                    $OtherRecArr['licence_fee']  = $LicenceFees;
                    $OtherRecArr['water_charge'] = $WaterCharge;

                    $InsuranceRecovery = [];
                    if(isset($EmpInsuranceList[$empNo])){
                        $EmpInsurance = $EmpInsuranceList[$empNo];
                        if(filled($EmpInsurance)){  
                            $EmpInsuranceGrpData = $EmpInsurance->groupBy('policy_for')->toArray();
                            foreach($EmpInsuranceGrpData as $EmpInsuranceKey => $EmpInsuranceValue){
                                $InsuranceAmount = array_sum(array_column($EmpInsuranceValue, 'premium_amount'));
                                $InsuranceRecovery[$EmpInsuranceKey]['premium_type'] = $EmpInsuranceKey;
                                $InsuranceRecovery[$EmpInsuranceKey]['premium_amount'] = $InsuranceAmount;
                                $InsuranceRecovery[$EmpInsuranceKey]['insurance_data'] = $EmpInsuranceValue;
                                $TotalInsuranceAmount = $TotalInsuranceAmount + $InsuranceAmount;
                            }
                        }
                    }
                    $OtherRecArr['insurance_data'] = $InsuranceRecovery;
                    $OtherRecArr['insurance_amount'] = $TotalInsuranceAmount;

                    $PayLevel = $EmployeePayLevelGrpData[$employee->emp_no]['pay_level'] ?? 0;
                    $employeeData = [
                        'emp_data' => $EmpData,
                        'basic_salary' => $BasicForPayCalc,
                        'pay_level' => $PayLevel,
                        'basic_salary_actual' => $employee->basic_salary,
                        'city_type' => 'non_metro',
                        'days_pay_calc' => $PayCalcDays,
                        'working_days' => $EmpWorkingDays,
                        'days_in_month' => $DaysInMonth,
                        'tax_regime' => $TaxRegime
                    ]; 
                    if(isset($EmpPayComponentData[$employee->emp_no])){
                        $EmpPayComponet = $EmpPayComponentData[$employee->emp_no];
                        // Add any additional fields
                        foreach ($EmpPayComponet as $key => $value) {
                            if (!in_array($key, ['emp_no', 'basic_salary', 'city_type'])) {
                                $employeeData[$key] = $value;
                            }
                        }
                    }
                    
                    $EmpPrevProjectedTaxData = $PrevProjectedTaxData[$empNo] ?? [];
                    $OtherParam = [
                        'it_component' => [],
                        'it_slab' => [],
                        'homePayComponents' => $homePayComponents,
                        'investPayComponents' => $investPayComponents,
                        'Page' => $Page,
                        'projected_prev_calc_tax' => $EmpPrevProjectedTaxData
                    ];
                    //dd($OtherParam);
                    $results[] = $this->payrollService->calculatePayroll($empNo, $employeeData, $effectiveDate, $OtherParam);
                }
                //dd($results);
                /*dd(collect($results)->keyBy('emp_no')->toArray());
                return response()->json([
                    'success' => true,
                    'data' => $results,
                    'total_employees' => count($results)
                ]);*/
                $otherComponentFilterArr = array("ALLOW","ADVA","LOAN");
                $otherPayComponents  = PayComponent::withType()->active()->whereIn('component_id',$ActiveLoanIdList)
                                    ->whereHas('componentType', function ($q) use ($otherComponentFilterArr) {
                                    $q->whereIn('component_type_code', $otherComponentFilterArr)->where('component_code','!=','BASIC');
                                    })->orderBy('dp_order','ASC')->get();

                if(filled($results)){
                    $CalculatedPayData = collect($results)->keyBy('emp_no')->toArray();
                }else{
                    $CalculatedPayData = [];
                }
            } catch (\Exception $e) { dd($e);
                $message = 'Error calculating bulk payroll. '.$e->getMessage();
                Session::put('ALertMesage', $message);
                return redirect()->back();
            }
            //dd($CalculatedPayData);
            
            return view('payroll.pay-generate.payroll-generate')->with('data',compact('EmpGroupIdArr','PayGenYear','PayGenMonth','payComponents','employeeGroupMaster','payComponents','employeeGroupMaster','EmployeeList','EmployeePayComponentList','EmployeePayLevelGrpData','EmpAttendanceGrpData','EmpPayComponentData','CalculatedPayData','groupedPayComponents','otherPayComponents','homePayComponents','investPayComponents','EmpGroupStr'));  
        }  
        $employeeGroupMaster= $this->EmployeeGroupMaster->ShowEmployeeGroup(NULL);  
        return view('payroll.pay-generate.payroll-initiate')->with('data', compact(var_name: 'employeeGroupMaster'));
    }




    /**
     * Calculate payroll for a single employee
     * 
     * POST /api/payroll/calculate
     * 
     * Request Body:
     * {
     *   "emp_no": 7,
     *   "basic_salary": 25000,
     *   "city_type": "metro",
     *   "effective_date": "2024-01-15"  // optional
     * }
     */
    /*public function calculateSingleEmployee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'emp_no' => 'required|integer',
            'basic_salary' => 'required|numeric|min:0',
            'city_type' => 'nullable|string',
            'effective_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            $message = 'Validation failed'.$validator->errors();
            Session::put('ALertMesage', $message);
            return redirect()->back();
        }

        try {
            $empNo = $request->emp_no;
            $employeeData = [
                'basic_salary' => $request->basic_salary,
                'city_type' => $request->city_type ?? 'non_metro',
            ];

            // Add any additional employee data from request
            $additionalFields = ['is_disabled', 'designation', 'department', 'grade'];
            foreach ($additionalFields as $field) {
                if ($request->has($field)) {
                    $employeeData[$field] = $request->$field;
                }
            }

            $effectiveDate = $request->effective_date ?? now()->format('Y-m-d');
            
            $result = $this->payrollService->calculatePayroll($empNo, $employeeData, $effectiveDate);

            return response()->json([
                'success' => true,
                'data' => $result
            ]);

        } catch (\Exception $e) {
            $message = 'Error calculating payroll'.$e->getMessage();
            Session::put('ALertMesage', $message);
            return redirect()->back();
        }
    }

    public function calculateBulkEmployees(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employees' => 'required|array',
            'employees.*.emp_no' => 'required|integer',
            'employees.*.basic_salary' => 'required|numeric|min:0',
            'employees.*.city_type' => 'nullable|string',
            'effective_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            $message = 'Validation failed'.$validator->errors();
            Session::put('ALertMesage', $message);
            return redirect()->back();
        }

        try {
            $effectiveDate = $request->effective_date ?? now()->format('Y-m-d');
            $results = [];

            foreach ($request->employees as $employee) {
                $empNo = $employee['emp_no'];
                $employeeData = [
                    'basic_salary' => $employee['basic_salary'],
                    'city_type' => $employee['city_type'] ?? 'non_metro',
                ];

                // Add any additional fields
                foreach ($employee as $key => $value) {
                    if (!in_array($key, ['emp_no', 'basic_salary', 'city_type'])) {
                        $employeeData[$key] = $value;
                    }
                }

                $results[] = $this->payrollService->calculatePayroll($empNo, $employeeData, $effectiveDate);
            }

            return response()->json([
                'success' => true,
                'data' => $results,
                'total_employees' => count($results)
            ]);

        } catch (\Exception $e) {
            $message = 'Error calculating bulk payroll'.$e->getMessage();
            Session::put('ALertMesage', $message);
            return redirect()->back();
        }
    }

    public function getEmployeeComponents($empNo)
    {
        try {
            $components = EmployeePayComponent::where('emp_no', $empNo)
                ->where('active', 1)
                ->where('is_current', true)
                ->with(['component' => function($query) {
                    $query->select('component_id', 'component_code', 'component_name', 'component_type_id')
                          ->with('componentType:component_type_id,component_type_name,pay_effect');
                }])
                ->get();

            return response()->json([
                'success' => true,
                'emp_no' => $empNo,
                'components' => $components
            ]);

        } catch (\Exception $e) {
            $message = 'Error fetching employee components'.$e->getMessage();
            Session::put('ALertMesage', $message);
            return redirect()->back();
        }
    }

    public function getAllComponents(Request $request)
    {
        try {
            $query = PayComponent::with('componentType')
                ->where('active', 1);

            // Filter by component type if provided
            if ($request->has('component_type_id')) {
                $query->where('component_type_id', $request->component_type_id);
            }

            // Filter by pay effect (ADD/DEDUCT)
            if ($request->has('pay_effect')) {
                $query->whereHas('componentType', function($q) use ($request) {
                    $q->where('pay_effect', $request->pay_effect);
                });
            }

            $components = $query->get();

            return response()->json([
                'success' => true,
                'data' => $components,
                'total' => $components->count()
            ]);

        } catch (\Exception $e) {
            $message = 'Error fetching components'.$e->getMessage();
            Session::put('ALertMesage', $message);
            return redirect()->back();
        }
    }

    public function getComponentRule($componentId, Request $request)
    {
        try {
            $effectiveDate = $request->effective_date ?? now()->format('Y-m-d');

            $rule = PayComponentRule::where('component_id', $componentId)
                ->where('active', 1)
                ->where('with_effect_from', '<=', $effectiveDate)
                ->orderBy('with_effect_from', 'desc')
                ->first();

            if (!$rule) {
                $message = 'No active rule found for this component';
                Session::put('ALertMesage', $message);
                return redirect()->back();
            }

            // Parse formula_json if exists
            if ($rule->formula_json) {
                $rule->formula_json_decoded = json_decode($rule->formula_json, true);
            }

            return response()->json([
                'success' => true,
                'data' => $rule
            ]);

        } catch (\Exception $e) {
            $message = 'Error fetching component rule'.$e->getMessage();
            Session::put('ALertMesage', $message);
            return redirect()->back();
        }
    }

    public function assignComponentsToEmployee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'emp_no' => 'required|integer',
            'components' => 'required|array',
            'components.*' => 'integer|exists:erp_pay_component,component_id',
            'effective_from' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            $message = 'Validation failed'.$validator->errors();
            Session::put('ALertMesage', $message);
            return redirect()->back();
        }

        DB::beginTransaction();
        
        try {
            $empNo = $request->emp_no;
            $effectiveFrom = $request->effective_from ?? now()->format('Y-m-d');

            // Mark existing components as not current
            EmployeePayComponent::where('emp_no', $empNo)
                ->where('active', 1)
                ->update(['is_current' => false]);

            // Assign new components
            $assignedComponents = [];
            foreach ($request->components as $componentId) {
                $empComponent = EmployeePayComponent::create([
                    'emp_no' => $empNo,
                    'component_id' => $componentId,
                    'effective_from' => $effectiveFrom,
                    'is_current' => true,
                    'active' => 1,
                    'created_at' => now(),
                    'created_by' => auth()->id() ?? 1,
                ]);

                $assignedComponents[] = $empComponent;
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Components assigned successfully',
                'data' => $assignedComponents
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            $message = 'Error assigning components'.$e->getMessage();
            Session::put('ALertMesage', $message);
            return redirect()->back();
        }
    }

    public function getPayrollSummary(Request $request)
    {
        try {
            $effectiveDate = $request->effective_date ?? now()->format('Y-m-d');
            
            // Get employee numbers
            if ($request->has('emp_nos')) {
                $empNos = is_array($request->emp_nos) ? $request->emp_nos : [$request->emp_nos];
            } else {
                // Get all active employees who have components assigned
                $empNos = EmployeePayComponent::where('active', 1)
                    ->where('is_current', true)
                    ->distinct()
                    ->pluck('emp_no')
                    ->toArray();
            }

            if (empty($empNos)) {
                return response()->json([
                    'success' => true,
                    'message' => 'No employees found',
                    'data' => []
                ]);
            }

            $summaries = [];
            $totalGross = 0;
            $totalDeductions = 0;
            $totalNet = 0;

            foreach ($empNos as $empNo) {
                // You need to fetch employee data (basic_salary, city_type, etc.)
                // from your employee master table
                $employeeData = [
                    'basic_salary' => 25000, // Fetch from employee master
                    'city_type' => 'metro', // Fetch from employee master
                ];

                $result = $this->payrollService->calculatePayroll($empNo, $employeeData, $effectiveDate);
                
                $summaries[] = [
                    'emp_no' => $empNo,
                    'gross_earnings' => $result['gross_earnings'],
                    'total_deductions' => $result['total_deductions'],
                    'net_salary' => $result['net_salary'],
                ];

                $totalGross += $result['gross_earnings'];
                $totalDeductions += $result['total_deductions'];
                $totalNet += $result['net_salary'];
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'employees' => $summaries,
                    'totals' => [
                        'total_employees' => count($summaries),
                        'total_gross' => $totalGross,
                        'total_deductions' => $totalDeductions,
                        'total_net' => $totalNet,
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            $message = 'Error generating payroll summary'.$e->getMessage();
            Session::put('ALertMesage', $message);
            return redirect()->back();
        }
    }

    public function testComponentCalculation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'component_id' => 'required|integer|exists:erp_pay_component,component_id',
            'basic_salary' => 'required|numeric',
            'calculated_components' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            $message = 'Error in Calculation'.$validator->errors();
            Session::put('ALertMesage', $message);
            return redirect()->back();
        }

        try {
            $component = PayComponent::with('componentType')->find($request->component_id);
            
            $rule = PayComponentRule::where('component_id', $request->component_id)
                ->where('active', 1)
                ->orderBy('with_effect_from', 'desc')
                ->first();

            if (!$rule) {
                $message = 'No active rule found for this component';
                Session::put('ALertMesage', $message);
                return redirect()->back();
            }

            $employeeData = $request->except(['component_id', 'calculated_components']);
            $calculatedComponents = $request->calculated_components ?? ['BASIC' => $request->basic_salary];

            // Use reflection to call protected method for testing
            $reflection = new \ReflectionClass($this->payrollService);
            $method = $reflection->getMethod('calculateComponent');
            $method->setAccessible(true);

            $empComponent = new EmployeePayComponent();
            $amount = $method->invoke(
                $this->payrollService,
                $component,
                $rule,
                $empComponent,
                $employeeData,
                $calculatedComponents
            );

            return response()->json([
                'success' => true,
                'data' => [
                    'component' => $component,
                    'rule' => $rule,
                    'calculated_amount' => $amount,
                    'input_data' => [
                        'employee_data' => $employeeData,
                        'calculated_components' => $calculatedComponents
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            $message = 'Error testing calculation'.$e->getMessage();
            Session::put('ALertMesage', $message);
            return redirect()->back();
        }
    }
    */
    public function SavePayRoll(Request $request){
        if(isset($request->btn_save_payroll)){  
            $PayRollYear            = $request->txt_float_pay_year;
            $PayRollMonth           = $request->txt_float_pay_month; 
            $PayRollMonthYear       = $request->txt_float_pay_month_yr; 
            $WorkingDays            = $request->txt_float_working_days;
            $SaveIcNoList           = $request->txt_float_icno;
            $SavePresentDaysList    = $request->txt_float_present;
            $SavePayComponentList   = $request->txt_float_component;
            $SaveBasicList          = $request->txt_float_basic;
            $SaveGrossSalaryList    = $request->txt_float_gross_salary;
            $SaveNetSalaryList      = $request->txt_float_net_salary; 
            $SaveTotalDeductionsList= $request->txt_float_total_deduction;
            $SavePayrollRemarksList = $request->txt_float_remarks;
            $SaveProcessedEmpList   = $request->txt_float_processed;
            $SaveEmpGroupType       = $request->txt_float_emp_group_type;

            try {
                $EmpGroupType = decrypt($SaveEmpGroupType);
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) { 
                $message = 'Invalid Access';
                Session::put('ALertMesage', $message);
                return redirect()->route('payroll.pay-generate');
            }
            $EmpGroupTypeArr = explode(",",$EmpGroupType);

            if(($SaveIcNoList != NULL)&&($SaveIcNoList != "")){
                $SaveIcNoList = json_decode($SaveIcNoList);
                //$SaveIcNoList = collect($SaveIcNoList)->toArray();
            }else{
                $SaveIcNoList = [];
            }

            if(($SavePresentDaysList != NULL)&&($SavePresentDaysList != "")){
                $SavePresentDaysList = json_decode($SavePresentDaysList);
                //$SavePresentDaysList = collect($SavePresentDaysList)->toArray();
            }else{
                $SavePresentDaysList = [];
            }

            if(($SavePayComponentList != NULL)&&($SavePayComponentList != "")){
                $SavePayComponentList = json_decode($SavePayComponentList);
                //$SaveAbsentDaysList = collect($SaveAbsentDaysList)->toArray();
            }else{
                $SavePayComponentList = [];
            } //dd($SavePayComponentList);

            if(($SaveBasicList != NULL)&&($SaveBasicList != "")){
                $SaveBasicList = json_decode($SaveBasicList);
                //$SaveLeaveList = collect($SaveLeaveList)->toArray();
            }else{
                $SaveBasicList = [];
            }

            if(($SaveGrossSalaryList != NULL)&&($SaveGrossSalaryList != "")){
                $SaveGrossSalaryList = json_decode($SaveGrossSalaryList);
                //$SaveLeaveTypeList = collect($SaveLeaveTypeList)->toArray();
            }else{
                $SaveGrossSalaryList = [];
            }

            if(($SaveNetSalaryList != NULL)&&($SaveNetSalaryList != "")){
                $SaveNetSalaryList = json_decode($SaveNetSalaryList);
                //$SaveHalfDaysList = collect($SaveHalfDaysList)->toArray();
            }else{
                $SaveNetSalaryList = [];
            }

            if(($SaveTotalDeductionsList != NULL)&&($SaveTotalDeductionsList != "")){
                $SaveTotalDeductionsList = json_decode($SaveTotalDeductionsList);
                //$SaveHalfDaysList = collect($SaveHalfDaysList)->toArray();
            }else{
                $SaveTotalDeductionsList = [];
            }

            if(($SavePayrollRemarksList != NULL)&&($SavePayrollRemarksList != "")){
                $SavePayrollRemarksList = json_decode($SavePayrollRemarksList);
                //$SaveAttendRemarksList = collect($SaveAttendRemarksList)->toArray();
            }else{
                $SavePayrollRemarksList = [];
            }

            if(($SaveProcessedEmpList != NULL)&&($SaveProcessedEmpList != "")){
                $SaveProcessedEmpList = json_decode($SaveProcessedEmpList);
                //$SaveAttendRemarksList = collect($SaveAttendRemarksList)->toArray();
            }else{
                $SaveProcessedEmpList = [];
            }

           
            DB::beginTransaction();
            try {
                $PayrollData = PayRollMaster::where('payroll_year',$PayRollYear)->where('payroll_month',$PayRollMonth)->where('emp_group_type',$EmpGroupType)->get();
                $PayrollId = collect($PayrollData)->pluck('payroll_master_id')->first();
                if(filled($PayrollId)){
                    $DelEmpNoData = $this->Employee->ShowEmployeeByEmpGrpArr($EmpGroupTypeArr);
                    $DelEmpNoList = filled($DelEmpNoData) ? $DelEmpNoData->pluck('emp_no')->toArray() : [];

                    $PayRollEmpNoData = PayRollEmployee::where('payroll_master_id',$PayrollId)->whereIn('emp_no',$DelEmpNoList)->get();
                    $DelPayRollEmpIdList = filled($PayRollEmpNoData) ? $PayRollEmpNoData->pluck('payroll_employee_id')->toArray() : [];

                    PayRollComponent::where('payroll_master_id',$PayrollId)->whereIn('payroll_employee_id',$DelPayRollEmpIdList)->delete();
                    PayRollEmployee::where('payroll_master_id',$PayrollId)->whereIn('payroll_employee_id',$DelPayRollEmpIdList)->delete();
                    Payment::where('transaction_id',$PayrollId)->where('transaction_table','erp_payroll_master')->where('module_code','PAYROLL')->delete();
                    PayRollMaster::where('payroll_master_id',$PayrollId)->delete();
                }
                if(($SaveIcNoList != NULL)&&($SaveIcNoList != '')){
                    $SaveMastArr['payroll_year']            = $PayRollYear;
                    $SaveMastArr['payroll_month']           = $PayRollMonth;
                    $SaveMastArr['payroll_month_year']      = $PayRollMonthYear;
                    $SaveMastArr['generated_date']          = NOW();
                    $SaveMastArr['generated_by']            = session('WcmsEmpNo');
                    $SaveMastArr['generated_by_name']       = $WorkingDays;
                    $SaveMastArr['total_employees']         = count($SaveIcNoList);
                    $SaveMastArr['total_gross_salary']      = NULL;
                    $SaveMastArr['total_deductions']        = NULL;
                    $SaveMastArr['total_net_salary']        = NULL;
                    $SaveMastArr['status']                  = NULL;
                    $SaveMastArr['active']                  = 1;
                    $SaveMastArr['created_at']              = NOW();
                    $SaveMastArr['created_by']              = session('WcmsEmpNo'); 
                    $SaveMastArr['emp_group_type']          = $EmpGroupType;
                    /*if(filled($PayrollId)){
                        $PayrollMastId = $PayrollId;
                    }else{
                        $PayrollMastData = $this->PayRollMaster->createEmployeePayrollMaster($SaveMastArr);
                        $PayrollMastId = $PayrollMastData->payroll_master_id;
                    }*/
                    $PayrollMastData = $this->PayRollMaster->createEmployeePayrollMaster($SaveMastArr);
                    $PayrollMastId = $PayrollMastData->payroll_master_id;

                    $SavePayment['transaction_id']      = $PayrollMastId;
                    $SavePayment['transaction_table']   = 'erp_payroll_master';
                    $SavePayment['module_code']         = 'PAYROLL';
                    $SavePayment['gross_amount']        = NULL;
                    $SavePayment['recovery_amount']     = NULL;
                    $SavePayment['net_amount']          = NULL;
                    $SavePayment['payment_to']          = 'EMPLOYEE';
                    $SavePayment['active']              = 1;
                    $SavePayment['created_at']          = NOW();
                    $SavePayment['created_by']          = session('WcmsEmpNo'); 
                    $SavePayment['pay_emp_group_type']  = $EmpGroupType;
                    $this->Payment->CreatePayment($SavePayment);

                    $EmployeeAttendanceData = $this->EmployeeAttendanceDt->multipleEmployeeAttendance($SaveIcNoList,$PayRollMonth,$PayRollYear);
                    if(filled($EmployeeAttendanceData)){
                        $EmpGroupedAttendData = collect($EmployeeAttendanceData)->keyBy('emp_no');
                    }else{
                        $EmpGroupedAttendData = [];
                    }
                    $EmployeeData = $this->Employee->ShowMultipleEmployees($SaveIcNoList);
                    $EmployeeGroupedData = [];
                    $EmployeeGrpTypeData   = [];
                    $EmployeeTypeData    = [];
                    if(filled($EmployeeData)){
                        $EmployeeGroupedData = collect($EmployeeData)->keyBy('emp_no');

                        $EmpGroupIdArr = collect($EmployeeGroupedData)->pluck('employee_group_type')->toArray();
                        $EmployeeGroupMaster = $this->EmployeeGroupMaster->ShowEmployeeGroupByGrpIdArr($EmpGroupIdArr); 
                        if(filled($EmployeeGroupMaster)){
                            $EmployeeGrpTypeData = collect($EmployeeGroupMaster)->keyBy('emp_group_id');
                        }
                        //dd($EmployeeGrpTypeData);
                        $EmpTypeIdArr = collect($EmployeeGroupedData)->pluck('employee_type')->toArray();
                        $EmployeeTypeMastData = $this->EmployeeType->ShowEmployeeTypeByCodeArr($EmpTypeIdArr);  
                        if(filled($EmployeeTypeMastData)){
                            $EmployeeTypeData = collect($EmployeeTypeMastData)->keyBy('emp_type_code');
                        }
                    }

                    $EmployeePayComponentList = $this->EmployeePayComponent->multipleEmployeePayComonent($SaveIcNoList); 
                    $EmpPayComponentData = [];
                    if(filled($EmployeePayComponentList)){
                        foreach($EmployeePayComponentList as $EmployeePayComponent) {
                            $EmpPayComponentData[$EmployeePayComponent->emp_no][$EmployeePayComponent->component_id] = $EmployeePayComponent;
                        }
                    }
                    $EmployeePayLevelList = $this->EmployeePayLevel->multipleEmployeePayLevel($SaveIcNoList);
                    $EmployeePayLevelGrpData = filled($EmployeePayLevelList) ? collect($EmployeePayLevelList)->keyBy('emp_no') : [];

                    $EmployeeBankList = $this->EmployeePayBank->multipleEmployeeBank($SaveIcNoList);
                    $EmployeeBankGrpData = filled($EmployeeBankList) ? collect($EmployeeBankList)->keyBy('emp_no') : []; 
                    $BankIdArr = filled($EmployeeBankList) ? collect($EmployeeBankList)->pluck('bank_id')->toArray() : [];
                    $BranchIdArr = filled($EmployeeBankList) ? collect($EmployeeBankList)->pluck('branch_id')->toArray() : [];
                    //dd($BankIdArr);
                    $BankGrpData = [];
                    if(filled($BankIdArr)){
                        $BankData = $this->BankMaster->multipleBank($BankIdArr); 
                        $BankGrpData = filled($BankData) ? collect($BankData)->keyBy('bank_id') : []; 
                    }
                    $BranchGrpData = [];
                    if(filled($BranchIdArr)){
                        $BranchData = $this->BankBranchMaster->multipleBranch($BranchIdArr);
                        $BranchGrpData = filled($BranchData) ? collect($BranchData)->keyBy('branch_id') : [];
                    }

                    $componentFilterArr = array("DEDU","EARN");
                    $PayComponents  = PayComponent::withType()->active()
                                    ->whereHas('componentType', function ($q) use ($componentFilterArr) {
                                    $q->whereIn('component_type_code', $componentFilterArr)->where('component_code','!=','BASIC');
                                })
                                ->get(); 
                    $PayComponentsGrpData = filled($PayComponents) ? collect($PayComponents)->keyBy('component_id') : [];
                    //dd($SaveIcNoList);
                    
                    foreach($SaveIcNoList as $SaveIcNoKey => $SaveIcNo){ 
                        $EmpData        = $EmployeeGroupedData[$SaveIcNo];  
                        $EmpGrpData     = $EmployeeGrpTypeData[$EmpData->employee_group_type]; 
                        $EmpLevelData   = $EmployeePayLevelGrpData[$SaveIcNo] ?? NULL; //if($SaveIcNo == 333){ dd($SaveIcNo); } //if($SaveIcNo == 100){ dd($SaveIcNo); }

                        if(in_array($SaveIcNo, $SaveProcessedEmpList)){
                            $Status = 'PENDING';
                        }else{
                            $Status = 'ON_HOLD'; //dd($Status);
                        }
                        
                        if(isset($EmployeeBankGrpData[$SaveIcNo])){ 
                            $EmpBankData    = $EmployeeBankGrpData[$SaveIcNo];
                            $BankId         = $EmpBankData->bank_id;
                            $BranchId       = $EmpBankData->branch_id;
                            $BankAccountNo  = $EmpBankData->account_no;
                            $BankMastData   = $BankGrpData[$BankId];
                            $BranchMastData = $BranchGrpData[$BranchId];
                            $BankName       = $BankMastData->bank_name;
                            $IfscCode       = $BranchMastData->ifsc_code;
                            /*Log::info("GROSS calculated", [
                                'earnings_breakdown' => $SaveCompArr
                            ]);*/
                        }else{
                            $BankId         = NULL;
                            $BranchId       = NULL;
                            $BankAccountNo  = NULL;
                            $BankName       = NULL;
                            $IfscCode       = NULL;
                        }


                        if(isset($EmployeeTypeData[$EmpData->employee_type])){
                            $EmpTypeData   = $EmployeeTypeData[$EmpData->employee_type];
                            $EmpTypeCode = $EmpTypeData->emp_type_code;
                            $EmpTypeName = $EmpTypeData->emp_type;
                        }else{
                            $EmpTypeCode = NULL;
                            $EmpTypeName = NULL;
                        }
                        
                        if(isset($EmpGroupedAttendData[$SaveIcNo])){
                            $EmpAttendData      = $EmpGroupedAttendData[$SaveIcNo];  
                            $TotalWorkingDays   = $EmpAttendData->total_working_days; 
                            $EmpPresentDays     = $EmpAttendData->days_present; //echo $SaveIcNo." = ".$EmpAttendData->days_pay_calc."<br/>";
                            $EmpAbsentDays      = $EmpAttendData->days_absent;
                            $EmpLeaveDays       = $EmpAttendData->days_leave;
                            $EmpHalfDays        = $EmpAttendData->days_half;
                            $EmpPayCalcDays     = $EmpAttendData->days_pay_calc;
                        }else{
                            $TotalWorkingDays   = 0;
                            $EmpPresentDays     = 0;
                            $EmpAbsentDays      = 0;
                            $EmpLeaveDays       = 0;
                            $EmpHalfDays        = 0;
                            $EmpPayCalcDays     = 0;
                        }
                        //dd($request);
                        $PayComponentArr= $SavePayComponentList->$SaveIcNo;
                        
                        $PresentDay     = $SavePresentDaysList[$SaveIcNoKey];
                        $BasicSalary    = $SaveBasicList[$SaveIcNoKey];
                        $GrossSalary    = $SaveGrossSalaryList[$SaveIcNoKey];
                        $NetSalary      = $SaveNetSalaryList[$SaveIcNoKey];
                        $TotalDeductions= $SaveTotalDeductionsList[$SaveIcNoKey];
                        $Remarks        = $SavePayrollRemarksList[$SaveIcNoKey];
                        if($Remarks == ''){
                            $Remarks = NULL;
                        }
                        $SaveArr['payroll_master_id']   = $PayrollMastId;
                        $SaveArr['emp_no']              = $SaveIcNo;
                        $SaveArr['emp_name']            = $EmpData->emp_name_payslip;
                        $SaveArr['designation']         = $EmpData->designation_name;
                        $SaveArr['group_id']            = $EmpData->group_id;
                        $SaveArr['group_name']          = $EmpData->group;
                        $SaveArr['division_id']          = $EmpData->division_id;
                        $SaveArr['division_name']       = $EmpData->division;
                        $SaveArr['section_id']          = $EmpData->section_id;
                        $SaveArr['section_name']        = $EmpData->section;
                        $SaveArr['emp_group_code']      = $EmpGrpData->emp_group_code;
                        $SaveArr['emp_group_name']      = $EmpGrpData->emp_group_name;
                        $SaveArr['emp_type_code']       = $EmpTypeCode;
                        $SaveArr['emp_type_name']       = $EmpTypeName;
                        $SaveArr['emp_marital_status']  = $EmpData->emp_marital_status;
                        $SaveArr['emp_salute']          = $EmpData->emp_salute;
                        $SaveArr['total_working_days']  = $TotalWorkingDays;
                        $SaveArr['present_days']        = $EmpPresentDays;
                        $SaveArr['absent_days']         = $EmpAbsentDays;
                        $SaveArr['leave_days']          = $EmpLeaveDays;
                        $SaveArr['holidays']            = 0;
                        $SaveArr['paid_days']           = $EmpPayCalcDays;
                        $SaveArr['basic_salary']        = $BasicSalary;
                        $SaveArr['gross_salary']        = $GrossSalary;
                        $SaveArr['total_earnings']      = $GrossSalary;//$Remarks;
                        $SaveArr['total_deductions']    = $TotalDeductions;//$Remarks;
                        $SaveArr['net_salary']          = $NetSalary;
                        $SaveArr['payment_mode']        = NULL;//$Remarks;
                        $SaveArr['bank_name']           = $BankName;//$Remarks;
                        $SaveArr['account_number']      = $BankAccountNo;//$Remarks;
                        $SaveArr['ifsc_code']           = $IfscCode;//$Remarks;
                        $SaveArr['payment_date']        = NULL;//$Remarks;
                        $SaveArr['payment_reference']   = NULL;//$Remarks;
                        $SaveArr['status']              = $Status;//$Remarks;
                        $SaveArr['calculation_date']    = NOW();
                        $SaveArr['pay_level']           = $EmpLevelData->pay_level ?? NULL;
                        $SaveArr['pay_in_level']        = $EmpLevelData->basic_salary ?? NULL;
                        $SaveArr['next_incr_dt']        = $EmpLevelData->next_increment_dt ?? NULL;
                        $SaveArr['remarks']             = $Remarks;
                        $SaveArr['bank_id']             = $BankId;
                        $SaveArr['branch_id']           = $BranchId;
                        $SaveArr['active']              = 1;
                        $SaveArr['created_at']          = NOW();
                        $SaveArr['created_by']          = session('WcmsEmpNo'); 
                        $PayrollEmpMastData = $this->PayRollEmployee->createEmployeePayroll($SaveArr); 
                        
                        $PayrollEmpMastId = $PayrollEmpMastData->payroll_employee_id;
                        //dd($PayComponentArr);
                        if(filled($PayComponentArr)){
                            $EmpPayComponentList = $PayComponentArr->payComponents;
                            $EmpPayComponentIdList = $PayComponentArr->payComponentIds;
                            $EmpPayComponentCodeList = $PayComponentArr->payComponentCodes;
                            if(filled($EmpPayComponentIdList)){
                                foreach($EmpPayComponentIdList as $EmpPayComponentIdKey => $EmpPayComponentId){
                                    $EmpPayComponentAmt  = $EmpPayComponentList[$EmpPayComponentIdKey];
                                    $EmpPayComponentCode = $EmpPayComponentCodeList[$EmpPayComponentIdKey];
                                    //$EmpComponentData    = $EmpPayComponentData[$SaveIcNo][$EmpPayComponentId];
                                    $PayCompMastData     = $PayComponentsGrpData[$EmpPayComponentId]; 
                                    $SaveCompArr['payroll_master_id']       = $PayrollMastId;
                                    $SaveCompArr['payroll_employee_id']     = $PayrollEmpMastId;
                                    $SaveCompArr['component_id']            = $EmpPayComponentId;
                                    $SaveCompArr['component_code']          = $EmpPayComponentCode;
                                    $SaveCompArr['component_name']          = $PayCompMastData->component_name;//$AbsentDay;
                                    $SaveCompArr['component_type']          = $PayCompMastData->componentType->component_type_code;//$Leave;
                                    $SaveCompArr['pay_effect']              = $PayCompMastData->componentType->pay_effect;//$Leave;
                                    $SaveCompArr['calculation_type']        = NULL;//$PresentDay;
                                    $SaveCompArr['base_amount']             = NULL;//$AbsentDay;
                                    $SaveCompArr['calculation_rate']        = NULL;//$Leave;
                                    $SaveCompArr['calculated_amount']       = $EmpPayComponentAmt;
                                    $SaveCompArr['adjustment_amount']       = $EmpPayComponentAmt;
                                    $SaveCompArr['final_amount']            = $EmpPayComponentAmt;
                                    $SaveCompArr['is_taxable']              = $PayCompMastData->is_taxable;//$AbsentDay;
                                    $SaveCompArr['is_statutory']            = NULL;//$Leave;
                                    $SaveCompArr['formula_used']            = NULL;//$AbsentDay;
                                    $SaveCompArr['remarks']                 = NULL;//$Leave;
                                    $SaveCompArr['active']                  = 1;
                                    $SaveCompArr['created_at']              = NOW();
                                    $SaveCompArr['created_by']              = session('WcmsEmpNo');  //dd($SaveCompArr);
                                    $this->PayRollComponent->createEmployeePayrollComponent($SaveCompArr);
                                    
                                }
                            }
                        }
                    }
                }
                DB::commit();
                $message = "Payroll generated & saved successfully"; 
            
            } catch (\Exception $e) { 
                dd($e);
                $message = "Error : Payroll not generated & saved. Please try again"; 
            }
            //dd($message);
            Session::put('ALertMesage', $message);
            return redirect()->route('payroll.pay-generate');
        }
    }
    
}
