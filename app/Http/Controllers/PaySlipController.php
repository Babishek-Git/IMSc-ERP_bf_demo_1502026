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
use Helper;
use DB;
use Session;
class PaySlipController extends Controller
{
    public function __construct(){ 
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
    }
    public function PaySlipGenerate(Request $request)
    {
        
        if(isset($request->btn_initiate)){  
            $EmpGroupId     = $request->ch_emp_group;
            $EmpGroupIdArr  = [$EmpGroupId]; 
            $PayGenYear     = $request->cmb_pay_year; 
            $PayGenMonth    = $request->cmb_pay_month; 
            
            /*$EmpAttendanceMaster = $this->EmployeeAttendanceMaster->employeeAttendanceMaster($PayGenYear,$PayGenMonth);
            $AttendMastId = filled($EmpAttendanceMaster) ? collect($EmpAttendanceMaster)->pluck('attendance_master_id')->first() : NULL;
            $EmpAttendanceData = $this->EmployeeAttendanceDt->employeeAttendanceDtAll($AttendMastId);
            $EmpAttendanceGrpData = filled($EmpAttendanceData) ? collect($EmpAttendanceData)->keyBy('emp_no')->toArray() : [];*/

            $employeeGroupMaster = $this->EmployeeGroupMaster->ShowEmployeeGroupByGrpIdArr($EmpGroupIdArr);
            $EmpGroupCodeList = filled($employeeGroupMaster) ? collect($employeeGroupMaster)->pluck('emp_group_code')->toArray() : [];
            $PayRollMasterData = $this->PayRollMaster->getPayrollDataByEmpGroup($PayGenMonth,$PayGenYear,$EmpGroupId);
            $PayRollMastId = filled($PayRollMasterData) ? collect($PayRollMasterData)->pluck('payroll_master_id')->first() : NULL;

            $PayRollEmpCompGrpData = [];
            $EmployeeGroupedData = [];
            if($PayRollMastId != NULL){
                $PayRollEmployeeData = $this->PayRollEmployee->getPayrollEmployeeData($PayRollMastId);
                $PayRollEmpIdList = filled($PayRollEmployeeData) ? collect($PayRollEmployeeData)->pluck('payroll_employee_id')->toArray() : [];
                
                //$PayRollEmployeeData = $this->PayRollEmployee->getPayrollEmployeeData($PayRollMastId);
                $PayRollEmpCompData = $this->PayRollComponent->getMultiplePayrollComponentDataByPayEmpId($PayRollEmpIdList);
                $PayRollEmpCompGrpData = filled($PayRollEmpCompData) ? collect($PayRollEmpCompData)->groupBy('payroll_employee_id')->toArray() : [];
                $EmpNoList = filled($PayRollEmployeeData) ? collect($PayRollEmployeeData)->pluck('emp_no')->toArray() : [];
                $EmployeeList = $this->Employee->ShowMultipleEmployees($EmpNoList); 
                $EmployeeGroupedData = filled($EmployeeList) ? collect($EmployeeList)->keyBy('emp_no')->toArray() : [];
            }

            $EmployeePayComponentList = $this->EmployeePayComponent->multipleEmployeePayComonent($EmpNoList); 
            $EmpPayComponentData = [];
            if(filled($EmployeePayComponentList)){
                foreach($EmployeePayComponentList as $EmployeePayComponent) {
                    $EmpPayComponentData[$EmployeePayComponent->emp_no][] = $EmployeePayComponent->component_id;
                }
            }
            
            return view('payroll.pay-slip.payslip-generate')->with('data',compact('PayRollMasterData','PayRollEmployeeData','PayRollEmpCompGrpData','PayGenYear','PayGenMonth','EmployeeGroupedData','EmpPayComponentData'));  
        }  
        $employeeGroupMaster= $this->EmployeeGroupMaster->ShowEmployeeGroup(NULL);  
        return view('payroll.pay-slip.payslip-initiate')->with('data', compact(var_name: 'employeeGroupMaster'));
    }
}
