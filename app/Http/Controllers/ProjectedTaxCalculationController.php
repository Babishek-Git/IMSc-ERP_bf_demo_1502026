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
use App\models\ItComponent;
use App\models\ItSlab;
use App\Models\EmpProjectedTax;
use Helper;
use DB;
use Session;
class ProjectedTaxCalculationController extends Controller
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
        $this->EmployeeType = new EmployeeType();
        $this->BankBranchMaster = new BankBranchMaster();
        $this->BankMaster = new BankMaster();
        $this->EmpAllowAdvLoan = new EmpAllowAdvLoan();
        $this->EmpAllowAdvLoanInstallment = new EmpAllowAdvLoanInstallment();
        $this->EBCharges = new EBCharges();
        $this->HouseMaster = new HouseMaster();
        $this->ItComponent = new ItComponent();
        $this->ItSlab = new ItSlab();
        $this->EmpProjectedTax = new EmpProjectedTax();
    }
    public function ProjectedITCalculation(Request $request)
    { //dd($request);
        if($request->input('Page') === 'Info'){
            $Page            = $request->input('Page');
            $PayGenMonth     = date('m'); 
            $PayGenYear      = date('Y');  
            $FinancialYear   = $request->FinYear;
            $ReqEmpNo        = $request->EmpNo;
            $ReqEmpGroup     = $request->EmpGroup;
            $EmpGroupIdArr   = [];
            $EmpGroupIdArr[] = $ReqEmpGroup;
            $ReqEmpNoArr     = [];
            $ReqEmpNoArr[]   = $ReqEmpNo;

        }else if(isset($request->btn_initiate)){
            $Page           = 'Generate';
            $EmpGroupIdArr  = $request->ch_emp_group; 
            $PayGenMonth    = date('m'); 
            $PayGenYear     = date('Y');  
            $FinancialYear  = $request->cmb_fin_year;
        }else{
            $Page = '';
        }

        if(isset($request->btn_save_tax)){ 
            $IcNoList           = $request->txt_float_icno;
            $TotalMonthTaxList  = $request->txt_float_month_tax;
            $TotalTaxList       = $request->txt_float_total_tax;
            $TaxRegimeList      = $request->txt_float_tax_regime;
            $TaxFinYear         = $request->txt_float_fin_year;

            if(($TotalMonthTaxList != NULL)&&($TotalMonthTaxList != "")){
                $TotalMonthTaxList = json_decode($TotalMonthTaxList);
            }else{
                $TotalMonthTaxList = [];
            }
            if(($TotalTaxList != NULL)&&($TotalTaxList != "")){
                $TotalTaxList = json_decode($TotalTaxList);
            }else{
                $TotalTaxList = [];
            }
            if(($TaxRegimeList != NULL)&&($TaxRegimeList != "")){
                $TaxRegimeList = json_decode($TaxRegimeList);
            }else{
                $TaxRegimeList = [];
            }
            if(($IcNoList != NULL)&&($IcNoList != "")){
                $IcNoList = json_decode($IcNoList);
            }else{
                $IcNoList = [];
            }
            
            DB::beginTransaction();
            try {
                EmpProjectedTax::where('fin_year',$TaxFinYear)->delete();
                if(($IcNoList != NULL)&&($IcNoList != '')){
                    foreach($IcNoList as $SaveIcNoKey => $SaveIcNo){ 
                        $SaveTaxArr['fin_year']        = $TaxFinYear;
                        $SaveTaxArr['emp_no']          = $SaveIcNo;
                        $SaveTaxArr['tax_regime']      = $TaxRegimeList[$SaveIcNoKey] ?? 0;
                        $SaveTaxArr['total_tax_amt']   = $TotalTaxList[$SaveIcNoKey] ?? 0;
                        $SaveTaxArr['month_tax_amt']   = $TotalMonthTaxList[$SaveIcNoKey] ?? 0;
                        $SaveTaxArr['active']          = 1;
                        $SaveTaxArr['created_by']      = session('WcmsEmpNo');
                        $SaveTaxArr['created_at']      = NOW();
                        $this->EmpProjectedTax->createProjectedTax($SaveTaxArr); 
                    }
                }
                DB::commit();
                $message = "Projected Tax generated & saved successfully"; 
            
            } catch (\Exception $e) { 
                $message = "Error : Projected Tax not generated & saved. Please try again"; 
            }
            Session::put('ALertMesage', $message);
            return redirect()->back();

        }

        //dd($EmpGroupIdArr);
        if($Page != ''){  
            $NoOfWorkingDays 	= \Carbon\Carbon::create($PayGenYear, $PayGenMonth, 1)->daysInMonth;
            
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
            $otherPayComponents = [];
            $employeeGroupMaster = $this->EmployeeGroupMaster->ShowEmployeeGroupByGrpIdArr($EmpGroupIdArr);  
            if($Page == "Info"){
                $EmployeeList = $this->Employee->ShowEmployeeByEmpNoArr($ReqEmpNoArr); 
            }else{
                $EmployeeList = $this->Employee->ShowEmployeeByEmpGrpArr($EmpGroupIdArr); 
            }
            
            

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
            $AttendMastId = filled($EmpAttendanceMaster) ? collect($EmpAttendanceMaster)->pluck('attendance_master_id')->first() : NULL; 
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

            $ItComponent = $this->ItComponent->ShowItComponent();
            $FinYear = Helper::GetCurrentFinYear(NULL);
            $ItSlab = $this->ItSlab->ShowItSlab($FinancialYear); 
            
            //dd($ItSlab);
            
            try {
                $effectiveDate = now()->format('Y-m-d');
                $results = [];
    
                foreach ($EmployeePayLevelList as $employee) {
                    $empNo = $employee->emp_no;
                    $BasicForPayCalc = $employee->basic_salary;
                    //if(isset($EmpAttendanceGrpData[$empNo])){
                        //$AttendendanceData = $EmpAttendanceGrpData[$empNo];
                        $PayCalcDays     = $NoOfWorkingDays;//$AttendendanceData['days_pay_calc'];
                        $EmpWorkingDays  = $NoOfWorkingDays;//$AttendendanceData['emp_working_days'];
                        $BasicPerDay     = $employee->basic_salary;// / $EmpWorkingDays;
                        $BasicForPayCalc = $employee->basic_salary;//round($BasicPerDay * $PayCalcDays);
                    //}
                    $TaxRegime = 'NEW'; $EmpData = [];
                    if(isset($EmpGroupedData[$empNo])){
                        $EmpData    = $EmpGroupedData[$empNo];
                        $TaxRegime  = $EmpData->tax_regime ?? 'NEW';
                    }
                    $EmpLoanData = []; $TotalLoanRecoveryAmount = 0; $TotalLoanDisbursementAmount = 0; $AllowAdvLoanIdArr = [];
                    if(isset($EmpActiveLoanData[$empNo])){
                        $EmpActiveLoan  = $EmpActiveLoanData[$empNo];
                        //$EmpActionLoanIdList = $EmpActiveLoan->pluck('emp_allow_adv_load_id')->toArray();
                        //$EmpActiveLoanInstall = $EmpActiveLoanInstallData->whereIn('emp_allow_adv_load_id',$EmpActionLoanIdList);
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
                    /*if(isset($homePayComponents['EB'])){
                        $EBComponentData = $homePayComponents['EB'];
                        $EBComponentId = $EBComponentData->component_id;
                        $EBComponentCode = $EBComponentData->component_code;
                        $EBComponentName = $EBComponentData->component_name;
                        $EBComponentTypeId = $EBComponentData->component_type_id;
                        $EBComponentIsTaxable = $EBComponentData->is_taxable;
                    }*/
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
                            //$LicenceFees = $EmpHouseStayed->licence_fee;//$EmpHouseStayed->pluck('licence_fee')->first(); 
                            //$WaterCharge = $EmpHouseStayed->water_charge;//$EmpHouseStayed->pluck('water_charge')->first();
                        }
                    }
                    $OtherRecArr['insurance_data'] = $InsuranceRecovery;
                    $OtherRecArr['insurance_amount'] = $TotalInsuranceAmount;
                    if($empNo == 68){
                        //dd($OtherRecArr);
                    }
                    
                    

                    $employeeData = [
                        'emp_data' => $EmpData,
                        'basic_salary' => $BasicForPayCalc,
                        'basic_salary_actual' => $employee->basic_salary,
                        'city_type' => 'non_metro',
                        'days_pay_calc' => $PayCalcDays,
                        'working_days' => $EmpWorkingDays,
                        'days_in_month' => $DaysInMonth,
                        'tax_regime' => $TaxRegime,
                        'it_calc_mode' => 'PROJECTED',
                        'active_loan' => $EmpLoanData,
                        'other_recovery' => $OtherRecArr
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
                    $OtherParam = [
                        'it_component' => $ItComponent,
                        'it_slab' => $ItSlab,
                        'homePayComponents' => $homePayComponents,
                        'investPayComponents' => $investPayComponents,
                        'Page' => $Page
                    ];
                    
                    $results[] = $this->payrollService->calculatePayroll($empNo, $employeeData, $effectiveDate, $OtherParam); 
                    if($empNo == 101){ 
                        //dd($results);
                        //dd($this->payrollService->calculatePayroll($empNo, $employeeData, $effectiveDate, $OtherParam));
                    }
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
            } catch (\Exception $e) { //dd($e);
                $message = 'Error calculating bulk payroll. '.$e->getMessage();
                if($Page == "Info"){
                    return NULL;
                }else{
                    Session::put('ALertMesage', $message);
                }
                return redirect()->back();
            }
            //dd($CalculatedPayData);
            if($Page == "Info"){
                $data = [
                    'EmpGroupIdArr'=>$EmpGroupIdArr, 
                    'FinancialYear'=>$FinancialYear, 
                    'PayGenYear' => $PayGenYear,
                    'PayGenMonth' => $PayGenMonth,
                    'payComponents' => $payComponents,
                    'employeeGroupMaster' => $employeeGroupMaster,
                    'EmployeeList' => $EmployeeList,
                    'EmployeePayComponentList' => $EmployeePayComponentList,
                    'EmployeePayLevelGrpData' => $EmployeePayLevelGrpData,
                    'EmpAttendanceGrpData' => $EmpAttendanceGrpData,
                    'EmpPayComponentData' => $EmpPayComponentData,
                    'CalculatedPayData' => $CalculatedPayData,
                    'groupedPayComponents' => $groupedPayComponents,
                    'otherPayComponents' => $otherPayComponents,
                    'homePayComponents' => $homePayComponents,
                    'investPayComponents' => $investPayComponents
                ];
                $HtmlData = view('incometax.projected-tax-calculation.projected-tax-view', compact('data'))->render();
                
                return response()->json([
                    'HtmlData' => $HtmlData
                ]);
            }else{
                return view('incometax.projected-tax-calculation.projected-tax-generate')->with('data',compact('EmpGroupIdArr','FinancialYear','PayGenYear','PayGenMonth','payComponents','employeeGroupMaster','EmployeeList','EmployeePayComponentList','EmployeePayLevelGrpData','EmpAttendanceGrpData','EmpPayComponentData','CalculatedPayData','groupedPayComponents','otherPayComponents','homePayComponents','investPayComponents'));  
            }
        }  
        $AllFinancialYear = Helper::GetAllFinancialYear(NULL);
        $employeeGroupMaster= $this->EmployeeGroupMaster->ShowEmployeeGroup(NULL);  
        return view('incometax.projected-tax-calculation.projected-tax-generate-initiate')->with('data', compact('employeeGroupMaster','AllFinancialYear'));
    }



    /*public function SaveProjectedTax(Request $request){ 
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
                $PayrollData = PayRollMaster::where('payroll_year',$PayRollYear)->where('payroll_month',$PayRollMonth)->get();
                $PayrollId = collect($PayrollData)->pluck('payroll_master_id')->first();
                if(filled($PayrollId)){
                    PayRollComponent::where('payroll_master_id',$PayrollId)->delete();
                    PayRollEmployee::where('payroll_master_id',$PayrollId)->delete();
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

                    $PayrollMastData = $this->PayRollMaster->createEmployeePayrollMaster($SaveMastArr);
                    $PayrollMastId = $PayrollMastData->payroll_master_id;

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
                        $EmpLevelData   = $EmployeePayLevelGrpData[$SaveIcNo]; //if($SaveIcNo == 100){ dd($SaveIcNo); }

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
                            //Log::info("GROSS calculated", [
                               // 'earnings_breakdown' => $SaveCompArr
                            //]);
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
                        $SaveArr['pay_level']           = $EmpLevelData->pay_level;
                        $SaveArr['pay_in_level']        = $EmpLevelData->basic_salary;
                        $SaveArr['next_incr_dt']        = $EmpLevelData->next_increment_dt;
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
            return redirect()->route('incometax.projected-it-calculation');
        }
    }*/
    
}
