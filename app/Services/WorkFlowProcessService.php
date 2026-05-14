<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Models\AemEmployee;
use App\Models\EmployeePayBank;
use App\Models\WorkFlowMovement;
use App\Models\WorkFlow;
use App\Models\work_flow_modules;
use App\Models\RoleMapping;
use App\Models\Payment;
use App\Models\Role;
use App\Models\LeaveApplicationDt;
use App\Models\modules;
use Carbon\Carbon;
use Illuminate\Support\Str;
//use Exception;
use DB;

class WorkFlowProcessService
{
    
    protected LeaveCalculationService $calcService;
    protected LeaveApplicationService $appService;
    public function __construct(
        LeaveCalculationService $calcService,
        LeaveApplicationService $appService,
    ) {
        //$this->WorkFlowMovement = new WorkFlowMovement();
        $this->calcService = $calcService;
        $this->appService  = $appService;
    }

    public function GetEmployee($TransactionId, $WorkFlowModuleCode, $WorkFlowData)
    { 
        $EmpData         = []; 
        $RoleNameData    = []; 
        $WorkFlowModuleData = $this->GetWorkFlowModule($WorkFlowModuleCode);
        if($WorkFlowModuleData->isEmpty()) {
            return NULL;// Work flow module not configured
        }else{
            $WorkFlowModuleId = $WorkFlowModuleData->pluck('wf_moduleid')->first();
        } 
        $LatestTransactionData = $this->GetWorkFlowLastTransaction($TransactionId,$WorkFlowModuleId);//WorkFlowMovement::where('active',1)->where('transaction_id',$TransactionId)->where('wf_moduleid',$WorkFlowModuleId)->orderBy('work_move_id','DESC')->limit(1)->get();
        if($LatestTransactionData->isEmpty()) {
            $WorkFlowModuleData = $this->GetWorkFlowFromModule($WorkFlowModuleId);
            if(filled($WorkFlowModuleData)){
                $ModuleTargetRoles   = $WorkFlowModuleData->pluck('target_roles')->first();
            }
            $RolePosition = 0;
        }else{
            $ApplicationData = $this->GetWorkFlowFromApplication($TransactionId,$WorkFlowModuleCode, $WorkFlowModuleData);
            if(filled($ApplicationData)){ 
                $ApplnTargetRoles = $ApplicationData->target_roles; 
            }
            $RolePosition   = $LatestTransactionData->pluck('role_position')->first();
            $RolePosition++; // Current Role Position. We have incr  by 1 for current position. Because this is for previous record.
        } 
        $TargetRoles = $ApplnTargetRoles ?? $ModuleTargetRoles ?? NULL;  
        $ModalActionFlag = $WorkFlowData->ModalActionFlag ?? NULL; 
        $ExpTargetRoles = explode(",",$TargetRoles); 
        if(($ModalActionFlag == 'FW')||($ModalActionFlag == 'SU')){
            $RolePosition++; // To check next forward role
            $NextRole = $ExpTargetRoles[$RolePosition] ?? NULL;
        }else if($ModalActionFlag == 'BW'){
            $RolePosition--; // To check  previuos role
            $NextRole = $ExpTargetRoles[$RolePosition] ?? NULL;
        }else{
            $NextRole = NULL;
        } 
        if($NextRole != NULL){
            $EmpArr       = $this->GetEmployeeByRole($NextRole); 
            $RoleNameData = $this->GetRoleNameData($NextRole);

            if(filled($EmpArr)){
                $EmpData = $this->GetEmployeeData($EmpArr);
            }
        } 
        $RetArr = ['EmpData' => $EmpData, 'SelEmp' => NULL, 'NextRole' => $NextRole, 'RoleName' => $RoleNameData, 'RolePosition' => $RolePosition];
        return $RetArr;
    }

    public function GetWorkFlowFromModule($WorkFlowModuleId){
        $WorkFlowData = WorkFlow::where('wf_moduleid',$WorkFlowModuleId)->where('initiate_role',session('WcmsEmpRoleId'))->where('active',1)->get();
        return $WorkFlowData;
    }
    public function GetWorkFlowModule($ModuleCode){
        return work_flow_modules::where('wf_module_code',$ModuleCode)->where('active',1)->get();
    }
    public function GetWorkFlowFromApplication($TransactionId,$WorkFlowModuleCode,$WorkFlowModuleData){
        $ModelClassName = $WorkFlowModuleData->pluck('model_class_name')->first();
        $TableName = $WorkFlowModuleData->pluck('table_name')->first();
        return $ModelClassName::find($TransactionId);
    }
    public function GetEmployeeByRole($RoleId){
        $EmpData =  RoleMapping::where('role_id',$RoleId)->where('active',1)->get(); 
        $EmpArr = filled($EmpData) ? $EmpData->pluck('employee_no')->toArray() : [];
        return $EmpArr;
    }
    public function GetRoleNameData($RoleId){
        $RoleNameData =  Role::where('roleid',$RoleId)->where('active',1)->get(); 
        $RoleNameArr  = filled($RoleNameData) ? $RoleNameData->pluck('role_name')->toArray() : [];
        return $RoleNameArr;
    }
    public function GetWorkFlowLastTransaction($TransactionId,$WorkFlowModuleId){
        return WorkFlowMovement::where('active',1)->where('transaction_id',$TransactionId)->where('wf_moduleid',$WorkFlowModuleId)->orderBy('work_move_id','DESC')->limit(1)->get();
    }
    public function CheckForwardAndBackward($ModuleCode,$ApplicationId,$TargetRoles,$ApprAuthRole){
        $WorkFlowModuleData = $this->GetWorkFlowModule($ModuleCode);
        $WorkFlowModuleId = $WorkFlowModuleData->pluck('wf_moduleid')->first();
        $LastTransaction = $this->GetWorkFlowLastTransaction($ApplicationId,$WorkFlowModuleId);
        if(filled($LastTransaction)){
            $RolePosition   = $LastTransaction->pluck('role_position')->first();
            $LastActionFlag = $LastTransaction->pluck('action_flag')->first();
            if(($LastActionFlag == 'SU')||($LastActionFlag == 'FW')||($LastActionFlag = 'AP')){
                $RolePosition++;
            }else{
                $RolePosition--;
            }
        }else{
            $RolePosition = 0;
        }
        $ExpTargetRoles = explode(",",$TargetRoles);
        $PreviuosRole = $ExpTargetRoles[$RolePosition - 1] ?? NULL;
        $NextRole = $ExpTargetRoles[$RolePosition + 1] ?? NULL; 
        if($PreviuosRole !== NULL) {
            $IsPrevious = 'Y';
        }else{
            $IsPrevious = NULL;
        }
        $IsPrevious = ($PreviuosRole !== NULL) ? 'Y' : NULL;
        $IsNext     = ($NextRole !== NULL) ? 'Y' : NULL;
        /// Here we have to check one more condition with $ApprAuthRole and Session Role
        //$ApprovePosition = array_key_last(array_keys($ExpTargetRoles, (string)$ApprAuthRole));
        $ApprovePosition = null;

        if($ApprAuthRole == session('WcmsEmpRoleId')){
            foreach ($ExpTargetRoles as $ExpIndex => $ExpRole) {
                if ($ExpRole == $ApprAuthRole) {
                    $ApprovePosition = $ExpIndex; // keeps updating, so last match remains
                }
            }
        }
        $IsApprove = ($ApprovePosition == $RolePosition) ? 'Y' : NULL;
        if(filled($NextRole)){
            $RoleNameData = $this->GetRoleNameData($NextRole);
        }else{
            $RoleNameData = array();
        }
        if(filled($PreviuosRole)){
            $PreviuosNameData = $this->GetRoleNameData($PreviuosRole);
        }else{
            $PreviuosNameData = array();
        }
        $RetArr = ['IsNext'=>$IsNext,'NextRole'=>$NextRole,'NextRoleName'=>$RoleNameData,'PrevRoleName'=>$PreviuosNameData,'IsPrevious'=>$IsPrevious,'PreviuosRole'=>$PreviuosRole,'ApprovePosition'=>$ApprovePosition,'IsApprove'=>$IsApprove, 'WorkFlowAction' => 'FW_BW_AP'];
        return $RetArr;
    }

    public function GetEmployeeData($EmpArr){
        $EmpData = DB::table('erp_employee AS t1')
            ->select('t1.*','t2.office_name AS group','t3.office_name AS division','t3.office_short_name AS division_short_name','t4.office_name AS section','t4.office_short_name AS section_short_name','t5.designation_name')
            ->join('erp_emp_designation AS t5','t1.emp_designation_id','=','t5.designation_id')
            ->leftJoin("erp_office AS t2",function($join){
                $join->on('t1.group_id', '=', 't2.office_id');
            })
            ->leftJoin("erp_office AS t3",function($join){
                $join->on('t1.division_id', '=', 't3.office_id');
            })
            ->leftJoin("erp_office AS t4",function($join){
                $join->on('t1.section_id', '=', 't4.office_id');
            })->whereIn('t1.emp_no',$EmpArr)->get(); 
        return $EmpData;
    }

    public function WorkFlowMovementProcess($TransactionId,$WorkFlowModuleCode,$WorkFlowData){
        $WorkFlowModuleData = $this->GetWorkFlowModule($WorkFlowModuleCode);
        $ModelClassName = $WorkFlowModuleData->pluck('model_class_name')->first();
        if($WorkFlowModuleData->isEmpty()) {
            return NULL;// Work flow module not configured
        }else{
            $WorkFlowModuleId = $WorkFlowModuleData->pluck('wf_moduleid')->first();
        } 
        $WorkFlowAction   = $WorkFlowData->WorkFlowAction ?? NULL;
        $BudgetExpDetails = $WorkFlowData->BudgetExpData ?? NULL;

        $ApprovAuthRole = NULL;
        $LatestTransactionData = $this->GetWorkFlowLastTransaction($TransactionId,$WorkFlowModuleId);//WorkFlowMovement::where('active',1)->where('transaction_id',$TransactionId)->where('wf_moduleid',$WorkFlowModuleId)->orderBy('work_move_id','DESC')->limit(1)->get();
        if($LatestTransactionData->isEmpty()) {
            $WorkFlowModuleData = $this->GetWorkFlowFromModule($WorkFlowModuleId);
            if(filled($WorkFlowModuleData)){
                $ModuleTargetRoles   = $WorkFlowModuleData->pluck('target_roles')->first();
                $ApprovAuthRole = $WorkFlowModuleData->pluck('appr_auth')->first();
            }
            $RolePosition = 0;
        }else{
            $ApplicationData = $this->GetWorkFlowFromApplication($TransactionId,$WorkFlowModuleCode, $WorkFlowModuleData);
            if(filled($ApplicationData)){
                $ApplnTargetRoles   = $ApplicationData->pluck('target_roles')->first();
                $ApprovAuthRole = $ApplicationData->pluck('approve_auth_role')->first();
            }
            $RolePosition   = $LatestTransactionData->pluck('role_position')->first();
            if(($WorkFlowAction == 'SU')||($WorkFlowAction == 'FW')){
                $RolePosition++;
            }else if($RolePosition == 'AP'){
                $RolePosition = NULL;
            }else if($RolePosition == 'BK'){
                $RolePosition--;
            }else if($RolePosition == 'RJ'){
                $RolePosition = NULL;
            }
        }
        $TargetRoles = $ApplnTargetRoles ?? $ModuleTargetRoles ?? NULL;  
        $ModalActionFlag = $WorkFlowData->ModalActionFlag ?? NULL; 

        $SaveMovementData = array();
        $SaveMovementData['transaction_id']     = $TransactionId;
        $SaveMovementData['wf_module_code']     = $WorkFlowModuleCode;
        $SaveMovementData['wf_moduleid']        = $WorkFlowModuleId;
        $SaveMovementData['wf_from_emp_no']     = session('WcmsEmpNo');
        $SaveMovementData['wf_to_emp_no']       = $WorkFlowData->WorkFlowEmpNo ?? NULL;
        $SaveMovementData['wf_from_role']       = session('WcmsEmpRoleId');
        $SaveMovementData['wf_to_role']         = $WorkFlowData->WorkFlowRole ?? NULL;
        $SaveMovementData['role_mapping_id']    = session('WcmsEmpRoleMapId');
        $SaveMovementData['status']             = NULL;
        $SaveMovementData['action_flag']        = $WorkFlowAction;
        $SaveMovementData['role_position']      = $RolePosition;
        $SaveMovementData['remarks']            = $WorkFlowData->WorkFlowRemark ?? NULL;
        $SaveMovementData['current_data']       = $BudgetExpDetails;
        $SaveMovementData['active']             = 1;
        $SaveMovementData['created_at']         = NOW();
        $SaveMovementData['created_by']         = session('WcmsEmpNo');
        if($WorkFlowAction == 'AP'){
            $SaveMovementData['status']         = 'approved';
        }else if($WorkFlowAction == 'RJ'){
            $SaveMovementData['status']         = 'rejected';
        }
        

        $SaveApplicationData = [];
        $SaveApplicationData['from_emp_no']     = session('WcmsEmpNo');
        $SaveApplicationData['to_emp_no']       = $WorkFlowData->WorkFlowEmpNo ?? NULL;
        $SaveApplicationData['from_role']       = session('WcmsEmpRoleId');
        $SaveApplicationData['to_role']         = $WorkFlowData->WorkFlowRole ?? NULL;
        if($WorkFlowAction == 'AP'){
            $SaveApplicationData['approved_by']  = session('WcmsEmpNo');
            $SaveApplicationData['approved_dt']  = NOW();
            $SaveApplicationData['status']       = 'approved';
            $SaveApplicationData['is_approved']  = true;
            $SaveApplicationData['is_completed'] = true;
        }
        if($WorkFlowAction == 'RJ'){
            $SaveApplicationData['rejected_by']  = session('WcmsEmpNo');
            $SaveApplicationData['rejected_dt']  = NOW();
            $SaveApplicationData['status']       = 'rejected';
            $SaveApplicationData['is_completed'] = true;
            $SaveApplicationData['is_approved']  = false;
        }
        if($WorkFlowAction == 'FW'){
            $SaveApplicationData['status']       = 'recommended';
        }
        if($WorkFlowAction == 'SU'){
            $SaveApplicationData['status']       = 'submitted';
        }
        if($LatestTransactionData->isEmpty()) {
            $SaveApplicationData['target_roles'] = $TargetRoles;
            $SaveApplicationData['approve_auth_role'] = $ApprovAuthRole;
        }
        $SubModule = $WorkFlowData->SubModule ?? NULL; 
        DB::beginTransaction();
        try {
            if($WorkFlowAction == 'AP'){
                if($SubModule == "CHANGE_REQ"){
                    $this->SaveChangeRequest($TransactionId,$ModelClassName);
                }
            }
            if(($WorkFlowAction == 'AP')||($WorkFlowAction == 'RJ')){
                if($WorkFlowModuleCode == "LEAVE"){
                    $ApplicationDtArr = $WorkFlowData->ApplicationDtArr ?? [];
                    $ApplicationActionArr = $WorkFlowData->ApplicationActionArr ?? [];
                    $OtherParam = ['ApplicationDtArr'=>$ApplicationDtArr,'ApplicationActionArr'=>$ApplicationActionArr,'WorkFlowAction'=>$WorkFlowAction];
                    $this->SaveLeaveRequest($TransactionId,$ModelClassName,$OtherParam);
                }
            }
            if($SubModule == "LTC_REQ"){
                $CurrentData = $ModelClassName::where('ltc_advance_id', $TransactionId)->get();
                $CurrentJsonData = json_encode($CurrentData);
                $SaveMovementData['current_data'] = $CurrentJsonData;
                if($WorkFlowAction == 'AP'){
                    $SaveApplicationData['module_code']         = "LTCCLAIM";
                    $SaveApplicationData['status']              = "pending";
                    $SaveApplicationData['from_emp_no']         = NULL;
                    $SaveApplicationData['to_emp_no']           = NULL;
                    $SaveApplicationData['from_role']           = NULL;
                    $SaveApplicationData['to_role']             = NULL;
                    $SaveApplicationData['target_roles']        = NULL;
                    $SaveApplicationData['target_roles_adv']    = $TargetRoles;
                    $SaveApplicationData['target_roles_claim']  = NULL;
                    $SaveApplicationData['advance_or_claim']    = "advance";
                    $SaveApplicationData['claim_amount']        = $CurrentData->first()->advance_amount ?? null;
                    $SaveApplicationData['is_adv_completed']    = true;
                    $SaveApplicationData['is_claim_completed']  = false;
                    $this->SaveLtcPayment($TransactionId,$ModelClassName);
                }
            }
            if($SubModule == "LTC_CLAIM"){
                $CurrentData = $ModelClassName::where('ltc_advance_id', $TransactionId)->get();
                $CurrentJsonData = json_encode($CurrentData);
                $SaveMovementData['current_data'] = $CurrentJsonData;
                if($WorkFlowAction == 'AP'){
                    $SaveApplicationData['claim_sanctioned_amount'] = $CurrentData->first()->claim_sanctioned_amount ?? null;
                    $SaveApplicationData['advance_or_claim']        = "claim";
                    $SaveApplicationData['is_claim_completed']      = true;
                    $SaveApplicationData['target_roles_claim']      = $TargetRoles;
                    $this->SaveLtcPayment($TransactionId,$ModelClassName);
                }
            }
            $this->SaveWorkFlowMovement($SaveMovementData);
            $this->SaveApplicationData($TransactionId,$ModelClassName,$SaveApplicationData);
            $messagePerfix     = modules::where('module_code', $WorkFlowModuleCode)->pluck('message_prefix')->first() ?? '';
            DB::commit();
            if($WorkFlowAction == 'RJ'){
                $message = $messagePerfix ." File returned to the user ";
            }else if($WorkFlowAction == 'AP'){
                $message = $messagePerfix ." File approved ";
            }else if($WorkFlowAction == 'SU'){
                $message = $messagePerfix ." File submitted ";
            }else if($WorkFlowAction == 'FW'){
                $message = $messagePerfix ." File forwarded / recommended ";
            }else{
                $message = $messagePerfix ." Work flow data saved ";
            }
        } catch (\Exception $e) { dd($e);
            DB::rollback();
            $message = "Error : Sorry transaction not fully completed";
        } 
        return $message;
    }
    public function SaveWorkFlowMovement($SaveMovementData)
    {
        return WorkFlowMovement::create($SaveMovementData);
    }

    public function SaveApplicationData($TransactionId,$ModelClassName,$SaveApplicationData)
    {
        $Model = new $ModelClassName();
        $PrimaryKeyField = $Model->getKeyName();
        return $ModelClassName::where($PrimaryKeyField, $TransactionId)->update($SaveApplicationData);
    }

    public function SaveLtcPayment($TransactionId,$ModelClassName){
        $Model = new $ModelClassName();
        $ApplicationData    = $ModelClassName::where('ltc_advance_id', $TransactionId)->first();
        $TransactionTable   = $Model->getTable();
        $BankDetailData     = EmployeePayBank::where('emp_no', $ApplicationData->emp_no)->where('is_current', true)->first();
        if($ApplicationData->module_code == 'LTCADV'){
            $amount = $ApplicationData->sanctioned_amount;
        }
        if($ApplicationData->module_code == 'LTCCLAIM'){
            $amount = $ApplicationData->claim_sanctioned_amount;
        }
        $InsertArr = [
            'transaction_id'       => $ApplicationData->ltc_advance_id,
            'transaction_table'    => $TransactionTable,
            'module_code'          => $ApplicationData->module_code ?? null,
            'gross_amount'         => $amount ?? null,
            'net_amount'           => $amount ?? null,
            'payment_to'           => $ApplicationData->emp_no ?? null,
            'pay_emp_no'           => $ApplicationData->emp_no ?? null,
            'bank_id'              => $BankDetailData->bank_id ?? null,
            'branch_id'            => $BankDetailData->branch_id ?? null,
            'account_no'           => $BankDetailData->account_no ?? null,
            'active'               => 1,
            'created_by'           => session('WcmsEmpNo'),
            'created_at'           => now(),
            'updated_at'           => now()
        ];
        Payment::create($InsertArr);

    }

    public function SaveChangeRequest($TransactionId,$ModelClassName)
    {
        $Model = new $ModelClassName();
        $PrimaryKeyField = $Model->getKeyName();
        $ApplicationData = $ModelClassName::where('change_req_id', $TransactionId)->get();
        if(filled($ApplicationData)){
            $ModuleCode = $ApplicationData->pluck('module_code')->first();
            if($ModuleCode == "ADDRESS"){
                $NewValue = $ApplicationData->pluck('new_value')->first(); 
                $NewValue = json_decode($NewValue, true); 
                $EmpNo = $ApplicationData->pluck('emp_no')->first();
                $NewAddress = $NewValue['emp_address']; /// Here emp_address -> field name of json stored in new_value in table - change request
                $UpdateArr = ['emp_address'=>$NewAddress]; /// Here emp_address -> field name of table to be updated
                AemEmployee::where('emp_no', $EmpNo)->update($UpdateArr); 
            }
            if($ModuleCode == "HOMETOWN"){
                $NewValue  = $ApplicationData->pluck('new_value')->first(); 
                $NewValue  = json_decode($NewValue, true); 
                $EmpNo     = $ApplicationData->pluck('emp_no')->first();
                $NewTown   = $NewValue['emp_hometown']; /// Here emp_address -> field name of json stored in new_value in table - change request
                $UpdateArr = ['emp_hometown'=>$NewTown]; /// Here emp_address -> field name of table to be updated
                AemEmployee::where('emp_no', $EmpNo)->update($UpdateArr); 
            }
            if($ModuleCode == "BANK"){
                $NewValue = $ApplicationData->pluck('new_value')->first(); 
                $NewValue = json_decode($NewValue, true); 
                $EmpNo = $ApplicationData->pluck('emp_no')->first();
                EmployeePayBank::where('emp_no', $EmpNo)->update([
                    'is_current' => false
                ]);
                $InsertArr = [
                    'emp_no'                 => $EmpNo,
                    'bank_id'                => $NewValue['bank_id'] ?? null,
                    'branch_id'              => $NewValue['branch_id'] ?? null,
                    'account_holder_name'    => $NewValue['account_holder_name'] ?? null,
                    'account_no'             => $NewValue['account_no'] ?? null,
                    'is_current'             => true,
                    'created_at'             => now(),
                    'updated_at'             => now()
                ];
                EmployeePayBank::create($InsertArr);
                
            }
            if($ModuleCode == "MARRIAGE"){

                $NewValue  = $ApplicationData->pluck('new_value')->first(); 
                $NewValue  = json_decode($NewValue, true); 
                $EmpNo     = $ApplicationData->pluck('emp_no')->first();
                
                $SpouseName= $NewValue['Spouse_name'];
                $SpouseDob = $NewValue['Spouse_dob']; /// Here emp_address -> field name of json stored in new_value in table - change request
                $UpdateArr = ['emp_marital_status'=>'M']; /// Here emp_address -> field name of table to be updated
                AemEmployee::where('emp_no', $EmpNo)->update($UpdateArr); 
                $UpdateArr1  = ['Spouse_name'=>$SpouseName];
                $UpdateArr1  = ['fam_member_dob'=>$SpouseDob]; /// Here emp_address -> field name of table to be updated
                EmpFamilyMaster::where('emp_no', $EmpNo)->update($UpdateArr1); 
            }
            if($ModuleCode  == "CONTACT"){
                $NewValue   = $ApplicationData->pluck('new_value')->first(); 
                $NewValue   = json_decode($NewValue, true); 
                $EmpNo      = $ApplicationData->pluck('emp_no')->first();
                $NewContact = $NewValue['emp_mobile']; /// Here emp_address -> field name of json stored in new_value in table - change request
                $UpdateArr  = ['emp_mobile'=>$NewContact]; /// Here emp_address -> field name of table to be updated
                AemEmployee::where('emp_no', $EmpNo)->update($UpdateArr); 
            }
            
        }
    }

    public function SaveLeaveRequest($TransactionId,$ModelClassName,$OtherParam){
        $LeaveApplicationDt = new LeaveApplicationDt();
        $WorkFlowAction = $OtherParam['WorkFlowAction'];
        $ApplicationDtArr = $OtherParam['ApplicationDtArr'];
        $ApplicationActionArr = $OtherParam['ApplicationActionArr'];
        if($WorkFlowAction == 'RJ'){
            $UpdateArr['status'] = 'rejected';
            $UpdateArr['rejected_by'] = session('WcmsEmpNo');
            $UpdateArr['rejected_at'] = NOW();
            LeaveApplicationDt::where('leave_application_id',$TransactionId)->update($UpdateArr);
        }else if($WorkFlowAction == 'AP'){
            $UpdateArr['status'] = 'approved';
            $UpdateArr['approved_by'] = session('WcmsEmpNo');
            $UpdateArr['approved_at'] = NOW();
            LeaveApplicationDt::where('leave_application_id',$TransactionId)->update($UpdateArr);
        }
        $ApplicationData = $LeaveApplicationDt->ShowApplicationByArr($ApplicationDtArr); 
        if(filled($ApplicationData)){
            $approver = AemEmployee::where('emp_no', session('WcmsEmpNo'))->firstOrFail();
            foreach($ApplicationData as $Key => $Application){
                $ApplicationAction = $ApplicationActionArr[$Key];
                /*if($ApplicationAction == 'APPROVE'){ 
                    $this->appService->approve($Application, $approver);
                }else if($ApplicationAction == 'REJECT'){ 
                    $this->appService->cancel($Application);
                }*/
                if($WorkFlowAction == 'AP'){ 
                    $this->appService->approve($Application, $approver);
                }else if($WorkFlowAction == 'RJ'){ 
                    $this->appService->cancel($Application);
                }
            }
        }
    }
   

}