<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
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
use App\Models\BankMaster;
use App\Models\EmpRelationshipMaster;
use App\Models\EmpFamilyDetails;
use App\Models\EmpDocuments;
use App\Models\DocumentsType;
use App\Models\EmpChangeRequest;
use App\Models\HouseMaster;
use App\Models\LtcAdvances;
use App\Models\DependentMaster;
use App\Models\AemBank;
use App\Models\BankBranchMaster;
use App\Models\CeaReimbursementDeatil;
use App\Models\ReimbursementMaster;
use App\Models\ReimbursementType;
use App\Models\CpfWithdraw;
use App\Models\CpfAllowance;
use App\Models\EmployeePayLevel;

use App\Services\WorkFlowProcessService;
use Helper;
use DB;
use Session;
use PDF;

class ChangeAddressRequestController extends Controller
{   
    public function __construct(
        WorkFlowProcessService $WorkFlowService,
    ){ 
        $this->Employee = new AemEmployee();
        $this->Office = new AgmOffice();
        $this->desigination = new DesignationMaster();
        $this->organization = new organization();
        $this->EmployeeSalute = new EmployeeSalute();
        $this->EmployeeMaritalStatus = new EmployeeMaritalStatus();
        $this->Category = new EmployeeCategory();
        $this->EmployeeGroupMaster = new EmployeeGroupMaster();
        $this->role  = new Role();
        $this->bank  = new BankMaster();
        $this->relationshipMas  = new EmpRelationshipMaster();
        $this->familydetails  = new EmpFamilyDetails();
        $this->EmpDocuments = new EmpDocuments(); 
        $this->DocumentsType = new DocumentsType(); 
        $this->ChangeRequest = new EmpChangeRequest(); 
        $this->House = new HouseMaster(); 
        $this->LtcAdv = new LtcAdvances(); 
        $this->DependentMaster = new DependentMaster();
        $this->bankdetail  = new AemBank();
        $this->BankBranch  = new BankBranchMaster();
        $this->ReimbursementDetail  = new CeaReimbursementDeatil();
        $this->Reimbursement  = new ReimbursementMaster();
        $this->ReimbursementType  = new ReimbursementType();
        $this->CpfWithdraw  = new CpfWithdraw();
        $this->CpfAllowance  = new CpfAllowance();
        $this->PayLevel  = new EmployeePayLevel();
        $this->WorkFlowService = $WorkFlowService;
    }

    
    public function EmpChangeAddrReqSelfService(Request $request)
    {  
        $EditClaimData = NULL;
        $Page = "REQ_APPLY";
        $message = NULL;
        if(isset($request->id)){ 
            try {
                $EditId = decrypt($request->id); 
                $Page   = decrypt($request->Page);
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $data = "Error : Sorry Invalid Attempt";
                return redirect()->back();
            }
            $EditClaimData = $this->ChangeRequest->ShowEmpRequest(NULL,$EditId); 
        }
        if(isset($request->btn_save)){  
            $EmpNo = $request->txt_emp_icno;
            $ActiveTab       = $request->txt_tab;
            $EmpAddress      = $request->txt_cont_address;
            $ChangeRequestId = $request->hid_change_id;
            $rules = [
				'EmpNo' => 'required|max:10',
				'EmpAddress' => 'required|max:50',
			];
			$ValidateData = [
                'EmpNo'      => $EmpNo,
				'EmpAddress' => $EmpAddress,
			];
            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($EmpNo == "EmpNo"){
                        $ErrArr[] = "Error : Invalid Employee No.";
                    }
                    if($EmpAddress == "EmpAddress"){
                        $ErrArr[] = "Error : Invalid Employee Address.";
                    }
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('change-request.address-change-request-list');
            }
            DB::beginTransaction();
            try { 
                $SaveArr1['emp_address'] = $request->txt_cont_address;
                $SaveData = json_encode($SaveArr1);
                $SaveArr2['emp_address'] = $request->txt_cont_oldaddress;
                $SaveData2 = json_encode($SaveArr2);
                $SaveArr['module_code'] =  'ADDRESS';
                $SaveArr['emp_no']      =   $EmpNo;
                $SaveArr['old_value']   =   $SaveData2;
                $SaveArr['new_value']   =   $SaveData;
                $SaveArr['request_date']=   NOW();
                $SaveArr['status']      =   'pending';
                $SaveArr['active'] = 1;
                $SaveArr['created_at'] = NOW();
                $SaveArr['created_by'] = session('WcmsEmpNo');
                if($ChangeRequestId != NULL){ 
                    $SaveArr['updated_at'] = NOW();
                    $SaveArr['updated_by'] = session('WcmsEmpNo');
                    $SaveEmployee= $this->ChangeRequest->updateChangeRequest($SaveArr,$ChangeRequestId);
                }else{
                    $SaveArr['created_at']              = NOW();
                    $SaveArr['created_by']              = session('WcmsEmpNo'); 
                    $SaveEmployee = $this->ChangeRequest->CreateChangeRequest($SaveArr); 
                }
                //dd($SaveEmployee);
                DB::commit();
                $message = "Address Update Request Form Data Saved";
            }catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            if(($EmpNo != NULL)&&($ActiveTab != NULL)){
                $this->SaveEmpAddressDocumentDetails($request);
            }else{
                $message = "Error : Invalid ICNO & Check your ICNO"; 
            }
            Session::put('ALertMesage', $message); 
            return redirect()->route('change-request.address-change-request-list');
        }
        $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo();
        return view('change-request.address.emp-address-change-request')->with('data',compact('Empdata','EditClaimData','Page'));
    } 

    public function EmpChangeAddrReqSelfServiceList(){
        $Page        = 'REQ_APPLY'; 
        $EmpNo       = session('WcmsEmpNo'); 
        $AddressData = $this->ChangeRequest->ShowEmpPendingChangeRequest(NULL,$EmpNo,'ADDRESS');
        return view('change-request.address.emp-address-change-request-list')->with('data', compact('AddressData','Page'));
    }
    public function EmpChangeAddrReqPendingList(){
        $Page        = 'REQ_PROCESS'; 
        $EmpNo       = session('WcmsEmpNo'); 
        $AddressData = $this->ChangeRequest->ShowEmpPendingChangeRequest(NULL,NULL,'ADDRESS'); 
        return view('change-request.address.emp-address-change-request-list')->with('data', compact('AddressData','Page'));
    }
    public function EmpChangeAddrReqProcess(Request $request)
    {  
        if(isset($request->SubmitApplication)){
            try {
                $TransactionId = decrypt($request->txt_application_id);
                $ModuleCode = decrypt($request->wf_module_code);
                $PageAction = decrypt($request->txt_action);
                $Page = decrypt($request->txt_page);
                
                $WorkFlowMode   = $request->txt_wf_mode;
                $ActualEmpNo    = $request->txt_actual_emp;
                $WorkFlowRemark = $request->txt_wf_remark;
                $WorkFlowEmpNo  = $request->txt_wf_emp_no;
                $WorkFlowRole   = $request->txt_wf_role;
                $WorkFlowAction = $request->txt_wf_action;
                $RolePosition = $request->txt_role_position;
                //dd($WorkFlowAction);
                
                
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) { 
                $message = "Error : Sorry Invalid Attempt";
                Session::put('ALertMesage', $message);
                if($Page == "REQ_PROCESS"){
                    return redirect()->route('change-request.address-change-request-pending-list');
                }else{
                    return redirect()->route('change-request.address-change-request-list');
                }
            }
            if(($request->SubmitApplication == 'RJ')||($request->SubmitApplication == 'AP')){
                $WorkFlowData = (object)['TransactionId'=>$TransactionId,'WflowModule'=>$ModuleCode,'WorkFlowMode'=>$WorkFlowMode,'ActualEmpNo'=>NULL,'WorkFlowRemark'=>$WorkFlowRemark,'WorkFlowEmpNo'=>NULL,'WorkFlowRole'=>NULL,'WorkFlowAction'=>$request->SubmitApplication,'RolePosition'=>NULL,'SubModule'=>'CHANGE_REQ'];
            }else{
                $WorkFlowData = (object)['TransactionId'=>$TransactionId,'WflowModule'=>$ModuleCode,'WorkFlowMode'=>$WorkFlowMode,'ActualEmpNo'=>$ActualEmpNo,'WorkFlowRemark'=>$WorkFlowRemark,'WorkFlowEmpNo'=>$WorkFlowEmpNo,'WorkFlowRole'=>$WorkFlowRole,'WorkFlowAction'=>$WorkFlowAction,'RolePosition'=>$RolePosition,'SubModule'=>'CHANGE_REQ'];
            }
            $WorkFlowMessage = $this->WorkFlowService->WorkFlowMovementProcess(
                $TransactionId,
                $ModuleCode,
                $WorkFlowData
            );
            Session::put('ALertMesage', $WorkFlowMessage);
            if($Page == "REQ_PROCESS"){
                return redirect()->route('change-request.address-change-request-pending-list');
            }else{
                return redirect()->route('change-request.address-change-request-list');
            }
        }
        $EditClaimData=NULL; $Page=NULL;
        if(isset($request->Application)){ 
            try {
                $ApplicationId = decrypt($request->Application); 
                $Page   = decrypt($request->Page);
                $Action = decrypt($request->action);
                if($Action != 'REQ_PROCESS'){
                    $message = "Error : Sorry Invalid Attempt";
                    Session::put('ALertMesage', $message);
                    if($Page == "REQ_PROCESS"){
                        return redirect()->route('change-request.address-change-request-pending-list');
                    }else{
                        return redirect()->route('change-request.address-change-request-list');
                    }
                }
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) { 
                $data = "Error : Sorry Invalid Attempt";
                return redirect()->back();
            }
            
        }
        
        $EditClaimData=$this->ChangeRequest->ShowEmpRequest(NULL,$ApplicationId);   
        $EmpNo = $EditClaimData->emp_no;//collect($EditClaimData)->pluck('emp_no')->first() ?? NULL;
        $Empdata = $this->Employee->ShowEmployees($request,$EmpNo);

        $WorkFlowAction = NULL;
        $TargetRoles = $EditClaimData->target_roles;//collect($EditClaimData)->pluck('target_roles')->first() ?? NULL;
        $IsCompleted = $EditClaimData->is_completed;//collect($EditClaimData)->pluck('is_completed')->first();
        $ApprAuthRole = $EditClaimData->approve_auth_role;//collect($EditClaimData)->pluck('approve_auth_role')->first() ?? NULL;
        $WorkFlowActionData = [];
        if(($IsCompleted == NULL)||($IsCompleted == false)){
            if(($TargetRoles == '')||($TargetRoles == NULL)){
                $WorkFlowAction = 'SU'; // Submit
                $WorkFlowActionData = ['WorkFlowAction' => $WorkFlowAction];
            }else{
                $WorkFlowActionData = $this->WorkFlowService->CheckForwardAndBackward('ADDRESS',$ApplicationId,$TargetRoles,$ApprAuthRole);
            }
        }
        //dd($WorkFlowActionData);
        return view('change-request.address.emp-address-change-request-view')->with('data',compact('ApplicationId','Action','Empdata','EditClaimData','Page','WorkFlowActionData'));  

    }


    public function SaveEmpAddressDocumentDetails($request){
        if($request->hasfile('file_emp_address')){
            $EmpAddress    = $request->file('file_emp_address');
            $EmpIcno  = $request->txt_emp_icno;
            $UploadExe = 0;

            $validator1 = Validator::make(
                $request->all(),
                [
                    'file_emp_address' => 'required|mimes:jpg,jpeg,png|max:2048', // max:2048 specifies the maximum size in kilobytes (2MB)
                ],
                [
                    'file_emp_address.required' => 'Error: Please select the  employee Address.',
                    'file_emp_address.mimes' => 'Error: Only jpg,jpeg,png files are allowed.',
                    'file_emp_address.max' => 'Error: The file size must be within 2MB.',
                ]
            );
            if($validator1->fails()) { 
                $message = $validator1->errors()->first(); 
                Session::put('ALertMesage', $message); 
            }

            $message = NULL;
            $OrgFileName = $EmpAddress->getClientOriginalName();
            $Extension   = $EmpAddress->getClientOriginalExtension();

            $UploadTimeStr = date("YmdHis");
            $FileType = $EmpAddress->getClientOriginalExtension();
            $FileName = "emp_".$EmpIcno."_address_supp_doc_".$UploadTimeStr.".".$FileType; //dd($FileName);
            $IsUpload = NULL;
            try {
                if($EmpAddress) {
                    $IsUpload = Helper::UploadFile($EmpAddress,$FileName,'ADDRESS','SUPDOC');
                }else{
                    $IsUpload = 'UE';
                }
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $IsUpload = 'UE';
            }
            if($IsUpload == "Y"){
                $UploadExe++;
            }
               
            if($UploadExe > 0){
                DB::beginTransaction();
                try {
                    $DocumentTypeData = $this->DocumentsType->ShowDocumentTypeByCode('ADDRESS'); 
                    $DocumentTypeId = NULL;
                    if(filled($DocumentTypeData)){
                        $DocumentTypeId = collect($DocumentTypeData)->pluck('document_type_id')->first();
                    }
                    //dd($DocumentTypeId);
                    $this->EmpDocuments->DeleteDocuments($EmpIcno,$DocumentTypeId);
                    $SaveData['emp_document_type_id']   = $DocumentTypeId;
                    $SaveData['doc_file_name']          = $FileName;
                    $SaveData['doc_file_name_actual']   = $OrgFileName;
                    $SaveData['active']                 = 1;
                    $SaveData['emp_no']                 = $EmpIcno;
                    $SaveData['created_at']             = NOW();
                    $SaveData['created_by']             = session('WcmsEmpNo');
                    $SaveEmployee= $this->EmpDocuments->createDocuments($SaveData);
                    //dd( $SaveEmployee);
                    DB::commit();
                    $message = "Document Uploaded";
                    
                }catch (\Exception $e){ dd($e); 
                    DB::rollback();
                    $message = "Error : Sorry transaction not fully completed";
                }
            }
        }
    }
    public function ExportEmployeeAddressPdf(Request $request)
    { 
        $EmpNo = decrypt($request->id);
        $AddressData = $this->ChangeRequest->ShowEmpPendingChangeRequest(NULL,$EmpNo,'ADDRESS');
        $data = ['AddressData'=>$AddressData];
        $pdf = PDF::loadView('change-request.address.export-address-pdf', $data);
        return $pdf->download('My_Profile_'.$EmpNo.'.pdf');
    }
    
}
