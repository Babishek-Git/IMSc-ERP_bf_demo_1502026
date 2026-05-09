<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\LeaveType;
use App\Models\AemEmployee;
use App\Models\LeaveBalance;


use Helper;
use DB;
use Session;
class LeaveBalanceController extends Controller
{
    public function __construct(){
        $this->leavetype  = new LeaveType();
        $this->Employee = new AemEmployee();
        $this->LeaveBalance = new LeaveBalance();
    }
    public function LeaveBalanceController(Request $request)
    {
        $LeaveData=$this->leavetype->ShowLeaveMaster();
        return view('LeaveMaster.LeaveMaster')->with('data', compact('LeaveData'));
    }
    // This function(and page UI) is created for temporary data entry use. will be deleted
    //  ==================================================================================================
    public function LeaveType(Request $request)
    {   
        $LeaveTypeData = $this->leavetype->ShowLeaveType(); 
        $EmpNameData = $this->Employee->ShowEmployeeNames();
        
        if(isset($request->btn_save)){
            $EmpArr = $request->input('txt_emp_no'); 
            foreach($EmpArr as $index => $EmpNo){
                $this->LeaveBalance->deleteLeaveBalance($EmpNo, date('Y'));
                $EmpLeaveTypeIdArr = $request->input('hid_leave_type_'.$EmpNo);
                $EmpLeaveBalArr = $request->input('txt_leave_balance_'.$EmpNo);
                if(filled($EmpLeaveTypeIdArr)){
                    foreach($EmpLeaveTypeIdArr as $EmpLeaveTypeIdKey => $EmpLeaveTypeId){
                        $EmpLeaveBal = $EmpLeaveBalArr[$EmpLeaveTypeIdKey];
                        $SaveData['emp_no'] = $EmpNo;
                        $SaveData['leave_type_id'] = $EmpLeaveTypeId;
                        $SaveData['balance'] = $EmpLeaveBal;
                        $SaveData['year'] = date('Y');
                        $SaveData['active'] = 1;
                        $SaveData['created_at'] = Now();
                        $SaveData['created_by'] = session('WcmsEmpNo');
                        
                        $this->LeaveBalance->CreateLeaveBalance($SaveData);
                    }
                }
            }
        }
        return view('leave.leave-balance-data-entry.leave-balance-data-entry')->with('data',compact('LeaveTypeData','EmpNameData')); //Leave Balance Update
    }
    // =====================================================================================================
    public function GetEmpLeaveBalance(Request $request){
        /*try{
            $EmpNo = $request->EmpNo;
            $LeaveType = $request->LeaveType;
        }catch (\Illuminate\Contracts\Encryption\DecryptException $e){
            return NULL;
        }*/
        $LeaveBalData = NULL;
        if($request->filled(['EmpNo', 'LeaveType'])) {
            $EmpNo = $request->EmpNo;
            $LeaveType = $request->LeaveType;
            $LeaveTypeMode = $request->LeaveTypeMode;
            $LeaveYear = date('Y');
            if($LeaveTypeMode == 'SINGLE'){
                $LeaveTypeArr[] = $LeaveType; // Convert single employee into array
            }else{
                $LeaveTypeArr = $LeaveType; // Already it is coming as array
            }
            $LeaveBalData = $this->LeaveBalance->ShowEmpLeaveBalanceByYear($EmpNo,$LeaveTypeArr,$LeaveYear);
        }
        $ReturnData = ['LeaveBalData'=>$LeaveBalData];
        return $ReturnData;
    }

}

