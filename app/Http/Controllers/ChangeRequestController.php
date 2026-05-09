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

class ChangeRequestController extends Controller
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
    public function EmpNameChangeRequest(Request $request)
    {   
        if(isset($request->SaveDraft)){  
            if($request->filled('txt_emp_icno')) {
                $this->SaveEmpBasicDetails($request);
            }else{
                $message = "Error : Invalid ICNO & Check your ICNO"; 
                Session::put('ALertMesage', $message);
                return redirect()->route('employee.createEmployee');
            }
        }
        $EmployeeGroupMaster    = $this->EmployeeGroupMaster->ShowEmployeeGroup(NULL);  
        $OfficeList             = $this->Office->ShowOfficeWithType('G',NULL);  
        $DesiginationList       = $this->desigination->ShowDesignationMaster(NULL); 
        $CategoryList           = $this->Category->ShowEmployeeCategory(NULL);
        $ShowGrandParent        = $this->organization->ShowGrandParent($request); 
        $EmployeeSalute         = $this->EmployeeSalute->ShowSalute(NULL);
        $EmployeeMaritalStatus  = $this->EmployeeMaritalStatus->ShowMaritalStatus(NULL); 
        return view('change-request.empname-change-request')->with('data',compact('OfficeList','DesiginationList','ShowGrandParent','CategoryList','EmployeeSalute','EmployeeMaritalStatus','EmployeeGroupMaster'));  
    }  
    public function EmpAddrChangeRequest(Request $request)
    {  
       /*  if(((session('WcmsRoleGroupCode') == "ADMUSER")||(session('WcmsRoleGroupCode') == "SUPUSER"))){
            $Empdata = NULL;
            $UserData = $this->Employee->ShowEmployees(NULL,NULL);
        }else{
            $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo(); 
            $UserData = NULL;
        } */ 
        $EmpNo = $request->txt_emp_icno;
        if(isset($request->SaveDraft)){  
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
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($EmpNo == "EmpNo"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Employee No.";
                    }
                    if($EmpAddress == "EmpAddress"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid Employee Address.";
                    }
                    
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('change-request.empaddr-change-request');
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
                }
                else{
                    $SaveArr['created_at']              = NOW();
                    $SaveArr['created_by']              = session('WcmsEmpNo'); 
                    $SaveEmployee = $this->ChangeRequest->CreateChangeRequest($SaveArr); 
                }
                DB::commit();
                $message = "Address Update Request Form Data Saved Successfully";
            }catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            $message = NULL;
            if(($EmpNo != NULL)&&($ActiveTab != NULL)){
                  $this->SaveEmpAddressDetails($request);
            }
            else{
                $message = "Error : Invalid ICNO & Check your ICNO"; 
            }
            Session::put('ALertMesage', $message); 
            return redirect()->route('change-request.empaddr-change-request');
        }
        $EditClaimData=NULL; $Page=NULL;
        if(isset($request->id)){ 
            try {
                $EditId = decrypt($request->id); 
                $Page   = decrypt($request->Page);
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $data = "Error : Sorry Invalid Attempt";
                return redirect()->back();
            }
            $EditClaimData=$this->ChangeRequest->ShowEmpRequest(NULL,$EditId); 
        }
        if(filled($EditClaimData)){ 
            $EmpNo = $EditClaimData->emp_no; 
            $Empdata = $this->Employee->ShowEmployees(NULL,$EmpNo);
        }else{
            $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo(); 
        } 
        return view('change-request.empaddr-change-request')->with('data',compact('Empdata','EditClaimData','Page'));  
    } 

    public function EmpAddrChangeRequestProcess(Request $request)
    { 
        if(isset($request->SubmitApplication)){
            try {
                $TransactionId = decrypt($request->txt_application_id);
                $ModuleCode = decrypt($request->wf_module_code);
                $PageAction = decrypt($request->txt_action);
                
                $WorkFlowMode   = $request->txt_wf_mode;
                $ActualEmpNo    = $request->txt_actual_emp;
                $WorkFlowRemark = $request->txt_wf_remark;
                $WorkFlowEmpNo  = $request->txt_wf_emp_no;
                $WorkFlowRole   = $request->txt_wf_role;
                $WorkFlowAction = $request->txt_wf_action;
                $RolePosition = $request->txt_role_position;
                //dd($WorkFlowAction);
                
                
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) { dd($e);
                $message = "Error : Sorry Invalid Attempt";
                Session::put('ALertMesage', $message);
                return redirect()->route('request-updates.addr-update');
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
            return redirect()->route('request-updates.addr-update');
        }

        $EditClaimData=NULL; $Page=NULL;
        if(isset($request->Application)){ 
            try {
                $ApplicationId = decrypt($request->Application); 
                $Page   = decrypt($request->Page);
                $Action = decrypt($request->action);
                if($Action != 'PROCESS'){
                    $message = "Error : Sorry Invalid Attempt";
                    Session::put('ALertMesage', $message);
                    return redirect()->route('request-updates.addr-update');
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
        return view('change-request.empaddr-change-request-view')->with('data',compact('ApplicationId','Action','Empdata','EditClaimData','Page','WorkFlowActionData'));  

    }


    public function SaveEmpAddressDetails($request){
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
                    $message = "Document Uploaded Successfully";
                    
                }catch (\Exception $e){ dd($e); 
                    DB::rollback();
                    $message = "Error : Sorry transaction not fully completed";
                }
            }
        }
    }
    public function EmpContactChangeRequest(Request $request)
    { 
        if(isset($request->btn_save)){ 
            $EmpNo           = $request->txt_emp_icno;
            $ActiveTab       = $request->txt_tab;
            $EmpContact      = $request->txt_contact_no;
            $ChangeRequestId = $request->hid_change_id;
           // dd($ChangeRequestId);
            $rules = [
				'EmpNo' => 'required|max:10',
				'EmpContact' => 'required|max:10',
			];
			$ValidateData = [
                'EmpNo'      => $EmpNo,
				'EmpContact' => $EmpContact,
			];
            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($EmpNo == "EmpNo"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Employee No.";
                    }
                    if($EmpContact == "EmpContact"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid Emp Contact.";
                    }
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('change-request.empcontact-change-request');
            }
            DB::beginTransaction();
            try { 
                $SaveArr1['emp_mobile'] = $request->txt_contact_no_new;
                $SaveData  = json_encode($SaveArr1);
                $SaveArr2['emp_mobile'] = $request->txt_contact_no_old;
                $SaveDataOld = json_encode($SaveArr2);
                $SaveArr['module_code']  =   'MOBILE';
                $SaveArr['emp_no']       =   $EmpNo;
                $SaveArr['old_value']    =   $SaveDataOld;
                $SaveArr['new_value']    =   $SaveData;
                $SaveArr['request_date'] =   NOW();
                $SaveArr['status']       =   'PENDING';
                $SaveArr['active'] = 1;
                $SaveArr['created_at'] = NOW();
                $SaveArr['created_by'] = session('WcmsEmpNo');
                if($ChangeRequestId != NULL){ 
                    $SaveArr['updated_at'] = NOW();
                    $SaveArr['updated_by'] = session('WcmsEmpNo');
                    $SaveEmployee = $this->ChangeRequest->updateChangeRequest($SaveArr,$ChangeRequestId);
                }
                else{
                    $SaveArr['created_at']              = NOW();
                    $SaveArr['created_by']              = session('WcmsEmpNo'); 
                    $SaveEmployee = $this->ChangeRequest->CreateChangeRequest($SaveArr); 
                }
                DB::commit();
                $message = "Contact Update Request Form Data Saved Successfully";
                Session::put('ALertMesage', $message); 
                return redirect()->route('change-request.empcontact-change-request');
            }catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
        }
        /* if(((session('WcmsRoleGroupCode') == "ADMUSER")||(session('WcmsRoleGroupCode') == "SUPUSER"))){

            $Empdata = NULL;
            $UserData = $this->Employee->ShowEmployees(NULL,NULL);

        }else{
            $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo(); 
            $UserData = NULL;
        }   */
        $EditCliamData=NULL; $Page = NULL;
        if(isset($request->id)){ 
            try {
                $EditId = decrypt($request->id); 
                $Page   = decrypt($request->Page);
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $data = "Error : Sorry Invalid Attempt";
                return redirect()->back();
            }
            $EditCliamData=$this->ChangeRequest->ShowEmpRequest(NULL,$EditId); 
        }
        if(filled($EditCliamData)){ 
            $EmpNo = $EditCliamData->emp_no; 
            $Empdata = $this->Employee->ShowEmployees(NULL,$EmpNo);
        }else{
            $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo(); 
        }    
        return view('change-request.empcontact-change-request')->with('data',compact('Empdata','EditCliamData','Page'));  
    }
    public function EmpBankDetailsChangeRequest(Request $request)
    {   
        /*     
         if(((session('WcmsRoleGroupCode') == "ADMUSER")||(session('WcmsRoleGroupCode') == "SUPUSER"))){
            $Empdata = NULL;
            $UserData = $this->Employee->ShowEmployees(NULL,NULL);
        }else{
            $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo(); 
            $UserData = NULL;
        }  */
        if(isset($request->btn_save)){  
            $EmpNo           = $request->txt_emp_icno;
            $ActiveTab       = $request->txt_tab;
            $EmpAccountName  = $request->txt_account_name;
            $EmpAccountNo    = $request->txt_account_no;
            $EmpIfscCode     = $request->txt_ifsc_code;
            $EmpBankName     = $request->txt_bank_name;
            $EmpBranchAddr   = $request->txt_branc_addr;
            $ChangeRequestId = $request->hid_change_id;
         
            $rules = [
				'EmpAccountName' => 'required|max:50',
				'EmpAccountNo'   => 'required|max:20',
                'EmpIfscCode'    => 'required|max:25',
				'EmpBankName'    => 'required|max:20',
                'EmpBranchAddr'  => 'required|max:50',
			];

			$ValidateData = [
                'EmpAccountName' => $EmpAccountName,
				'EmpAccountNo'   => $EmpAccountNo,
                'EmpIfscCode'    => $EmpIfscCode,
				'EmpBankName'    => $EmpBankName,
                'EmpBranchAddr'  => $EmpBranchAddr,
			];

            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($EmpAccountName == "EmpAccountName"){
                        $ErrArr[] = "Error : Invalid Employee Account Name.";
                    }
                    if($EmpAccountNo == "EmpAccountNo"){
                        $ErrArr[] = "Error : Invalid Employee Employee Account No.";
                    }
                     if($EmpIfscCode == "EmpIfscCode"){
                        $ErrArr[] = "Error : Invalid Employee Ifsc code.";
                    }
                    if($EmpBankName == "EmpBankName"){
                        $ErrArr[] = "Error : Invalid Employee Employee Name.";
                    }
                    if($EmpBranchAddr == "EmpBranchAddr"){
                        $ErrArr[] = "Error : Invalid Employee Branch Address.";
                    }
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('hange-request.empbankdetails-change-request');
            }
            DB::beginTransaction();
            try { 
                $SaveArr1['account_no'] = $request->txt_account_no;
                $SaveArr1['account_holder_name'] = $request->txt_account_name;
                $SaveArr1['ifsc_code'] = $request->txt_ifsc_code;
                $SaveArr1['bank_name'] = $request->txt_bank_name;
                $SaveArr1['branch_addr1'] = $request->txt_branc_addr;
                $SaveData = json_encode($SaveArr1);

                $SaveArr2['account_no'] = $request->txt_account_oldno;
                $SaveArr2['account_holder_name'] = $request->txt_account_oldname;
                $SaveArr2['ifsc_code'] = $request->txt_ifsc_oldcode;
                $SaveArr2['bank_name'] = $request->txt_bank_oldname;
                $SaveArr2['branch_addr1'] = $request->txt_branc_oldaddr;
                $SaveDataOld = json_encode($SaveArr2);

                $SaveArr['module_code'] =  'BANK';
                $SaveArr['emp_no']      =   $EmpNo;
                $SaveArr['old_value']   =   $SaveDataOld;
                $SaveArr['new_value']   =   $SaveData;
                $SaveArr['request_date']=   NOW();
                $SaveArr['status']      =   'PENDING';
                $SaveArr['active'] = 1;
                $SaveArr['created_at'] = NOW();
                $SaveArr['created_by'] = session('WcmsEmpNo');
               if($ChangeRequestId != NULL){ 
                    $SaveArr['updated_at'] = NOW();
                    $SaveArr['updated_by'] = session('WcmsEmpNo');
                    $SaveEmployee = $this->ChangeRequest->updateChangeRequest($SaveArr,$ChangeRequestId);
                }
                else{
                    $SaveArr['created_at']              = NOW();
                    $SaveArr['created_by']              = session('WcmsEmpNo'); 
                    $SaveEmployee = $this->ChangeRequest->CreateChangeRequest($SaveArr); 
                }
                DB::commit();
                $message = "Bank Details Update Request Form Data Saved Successfully";
            }catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message); 
            return redirect()->route('change-request.empbankdetails-change-request');
            $message = NULL;
            if(($EmpNo != NULL)&&($ActiveTab != NULL)){
                  $this->SaveEmpBankDetails($request);
            }
            else{
                $message = "Error : Invalid ICNO & Check your ICNO"; 
            }
        }
        $EditCliamData=NULL; $Page = NULL;
        if(isset($request->id)){ 
            try {
                $EditId = decrypt($request->id); 
                $Page   = decrypt($request->Page);
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $data = "Error : Sorry Invalid Attempt";
                return redirect()->back();
            }
            $EditCliamData=$this->ChangeRequest->ShowEmpRequest(NULL,$EditId); 
        }  
        if(filled($EditCliamData)){ 
            $EmpNo = $EditCliamData->emp_no; 
            $Empdata = $this->Employee->ShowEmployees(NULL,$EmpNo);
            $Bankdata = $this->bankdetail->ShowBankDetailsByEmpNo($EmpNo);
        }else{
            $Empdata  = $this->Employee->ShowEmployeeBySessionEmpNo();
            $Bankdata = $this->bankdetail->ShowBankDetailsByEmpNo(session('WcmsEmpNo'));  
        } 
        $BankId     = collect($Empdata)->pluck('bank_id')->first();
        $BranchId   = collect($Empdata)->pluck('branch_id')->first();
        $Branchdata = $this->BankBranch->ShowBankBranchList($BranchId); 
        return view('change-request.empbankdetails-change-request')->with('data',compact('Empdata','Branchdata','EditCliamData','Page','Bankdata')); 
    } 
    public function SaveEmpBankDetails($request){
        if($request->hasfile('file_emp_bank')){
            $EmpBank    = $request->file('file_emp_bank');
            $EmpIcno  = $request->txt_emp_icno;
            $UploadExe = 0;

            $validator1 = Validator::make(
                $request->all(),
                [
                    'file_emp_bank' => 'required|mimes:jpg,jpeg,png|max:2048', // max:2048 specifies the maximum size in kilobytes (2MB)
                ],
                [
                    'file_emp_bank.required' => 'Error: Please select the  employee bank file.',
                    'file_emp_bank.mimes' => 'Error: Only jpg,jpeg,png files are allowed.',
                    'file_emp_bank.max' => 'Error: The file size must be within 2MB.',
                ]
            );
            if($validator1->fails()) { 
                $message = $validator1->errors()->first(); 
                Session::put('ALertMesage', $message); 
            }

            $message = NULL;
            $OrgFileName = $EmpBank->getClientOriginalName();
            $Extension   = $EmpBank->getClientOriginalExtension();

            $UploadTimeStr = date("YmdHis");
            $FileType = $EmpBank->getClientOriginalExtension();
            $FileName = "emp_".$EmpIcno."_bank_supp_doc_".$UploadTimeStr.".".$FileType; //dd($FileName);
            $IsUpload = NULL;
            try {
                if($EmpBank) {
                    $IsUpload = Helper::UploadFile($EmpBank,$FileName,'BANK','SUPDOC');
                }else{
                    $IsUpload = 'UE';
                }
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $IsUpload = 'UE';
            }
            if($IsUpload == "Y"){
                $UploadExe++;
            }
              // dd($IsUpload);
            if($UploadExe > 0){
                DB::beginTransaction();
                try {
                    $DocumentTypeData = $this->DocumentsType->ShowDocumentTypeByCode('BANK'); 
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
                   // dd( $SaveEmployee);
                    DB::commit();
                    $message = "Document Uploaded Successfully";
                    
                }catch (\Exception $e){ dd($e); 
                    DB::rollback();
                    $message = "Error : Sorry transaction not fully completed";
                }
            
            }
        }
    }
    public function DocumentUploadRequest(Request $request)
    {   
            /* if(((session('WcmsRoleGroupCode') == "ADMUSER")||(session('WcmsRoleGroupCode') == "SUPUSER"))){
            $Empdata = NULL;
            $UserData = $this->Employee->ShowEmployees(NULL,NULL);
            }
            else{
            $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo(); 
            $UserData = NULL;
            }   */
           $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo(); 
            return view('change-request.document-upload-request')->with('data',compact('Empdata')); 
    }
    public function NomineeUpdateRequest(Request $request)
    {   
        $EmpNo = $request->txt_emp_icno;
        if(isset($request->btn_save)){ 
            $ActiveTab    = $request->txt_tab;
            $NomineeName  = $request->cmb_nominee_name;
            $RelationShip = $request->txt_relation_ship;
            $ChangeRequestId = $request->hid_change_id;
         
            $rules = [
				'NomineeName'  => 'required|max:50',
				'RelationShip' => 'required|max:50',
                
			];
			$ValidateData = [
                'NomineeName'  => $NomineeName,
				'RelationShip' => $RelationShip,
                				
			];
            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($NomineeName == "NomineeName"){
                       
                        $ErrArr[] = "Error : Invalid Nominee Name.";
                    }
                    if($RelationShip == "RelationShip"){
                      
                        $ErrArr[] = "Error : Invalid RelationShip Name.";
                    }
                    
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('change-request.empaddr-change-request');
            }
            DB::beginTransaction();
            try { 
                $SaveArr1['nominee_name'] = $request->cmb_nominee_name;
                $SaveArr1['relationship_name'] = $request->txt_relation_ship;
                $SaveData = json_encode($SaveArr1);
               
                // $SaveData2 = json_encode($SaveArr2);
                $SaveArr['module_code'] =  'NOMINEE';
                $SaveArr['emp_no']      =   $EmpNo;
                // $SaveArr['old_value']   =   $SaveData2;
                $SaveArr['new_value']   =   $SaveData;
                $SaveArr['request_date']=   NOW();
                $SaveArr['status']      =   'PENDING';
                $SaveArr['active'] = 1;
                $SaveArr['created_at'] = NOW();
                $SaveArr['created_by'] = session('WcmsEmpNo');
                if($ChangeRequestId != NULL){ 
                    $SaveArr['updated_at'] = NOW();
                    $SaveArr['updated_by'] = session('WcmsEmpNo');
                    $SaveEmployee = $this->ChangeRequest->updateChangeRequest($SaveArr,$ChangeRequestId);
                }
                else{
                    $SaveArr['created_at']              = NOW();
                    $SaveArr['created_by']              = session('WcmsEmpNo'); 
                    $SaveEmployee = $this->ChangeRequest->CreateChangeRequest($SaveArr);
                }
                DB::commit();
                $message = "Nominee Update Request Form Data Saved Successfully";
            }catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            $message = NULL;
            if(($EmpNo != NULL)&&($ActiveTab != NULL)){
                  $this->SaveEmpAddressDetails($request);
            }
            else{
                $message = "Error : Invalid ICNO & Check your ICNO"; 
            }
            Session::put('ALertMesage', $message); 
            return redirect()->route('all-request-update.nominee-update');
        }
        $EditClaimData=NULL; $Page = NULL;
        if(isset($request->id)){ 
            try {
                $EditId = decrypt($request->id); 
                $Page   = decrypt($request->Page);
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $data = "Error : Sorry Invalid Attempt";
                return redirect()->back();
            }
            $EditClaimData=$this->ChangeRequest->ShowEmpRequest(NULL,$EditId); 
        }
        if(filled($EditClaimData)){ 
            $EmpNo = $EditClaimData->emp_no; 
            $Empdata     = $this->Employee->ShowEmployees(NULL,$EmpNo);
            $Nomineedata = $this->familydetails->ShowFamilyDetailsByEmpNo($EmpNo); 
        }else{
            $Empdata  = $this->Employee->ShowEmployeeBySessionEmpNo();
            $Nomineedata = $this->familydetails->ShowFamilyDetailsByEmpNo(session('WcmsEmpNo')); 
        }
        //dd($Nomineedata);
        return view('change-request.nominee-update-request')->with('data',compact('Empdata','EditClaimData','Page','Nomineedata')); 
    }  
    public function FamilyDetailUpdateRequest(Request $request)
    {   
           /*  if(((session('WcmsRoleGroupCode') == "ADMUSER")||(session('WcmsRoleGroupCode') == "SUPUSER"))){
            $Empdata = NULL;
            $UserData = $this->Employee->ShowEmployees(NULL,NULL);
            }
            else{
            $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo(); 
            $UserData = NULL;
            } */
        if(isset($request->btn_save)){  
            //dd($request);
            $EmpNo             = $request->txt_emp_icno;
            $ChangeRequestId   = $request->hid_change_id;
            $ActiveTab         = $request->txt_tab;
            $DependentNameArr     = $request->txt_dependant_name;
            $DependentIdArr       = $request->hid_dependant_id;
            $RelationShipNameArr  = $request->txt_relationship_name;
            $RelationshipIdArr    = $request->txt_relationship;
            $RelNameArr           = $request->txt_rel_name;
            $DOBArr               = $request->txt_dob_rel;
            $ErrArr = [];
          
            $rules = [
				'EmpNo'            => 'required|max:10',
				'DependentName'    => 'required|max:50',
                'RelationShipName' => 'required|max:10',
				'RelName'          => 'required|max:50',
                'DOB'              => 'required|max:10',
			];
            DB::beginTransaction();
            try { 
               /*  $SaveArr1['dependant_name'] = $request->txt_dis_detail;
                $SaveArr1['relationship_name'] = $request->txt_perc;
                $SaveArr1['rel_name'] = $request->txt_dis_detail;
                $SaveArr1['dob_rel'] = $request->txt_perc;
                $SaveData = json_encode($SaveArr1); */
                /*$ValidateData = [
                    'EmpNo'            => $EmpNo,
                    'DependentName'    => $DependentName,
                    'RelationShipName' => $RelationShipName,
                    'RelName'          => $RelName,
                    'DOB'              => $DOB,
                ];

                $Validate = Validator::make($ValidateData, $rules); 
            
                if($Validate->fails())
                {
                    //$date = NULL;
                    $ValidateFields = $Validate->failed();
                    foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                    {
                        if($EmpNo == "EmpNo"){
                            $ErrArr[] = "Error : Invalid Employee No.";
                        }
                        if($DependentName == "DependentName"){
                            $ErrArr[] = "Error : Invalid Employee Address.";
                        }
                        if($RelationShipName == "RelationShipName"){
                            $ErrArr[] = "Error : Invalid Employee No.";
                        }
                        if($RelName == "RelName"){
                            $ErrArr[] = "Error : Invalid Employee Address.";
                        }
                        if($DOB == "DOB"){
                            $ErrArr[] = "Error : Invalid Employee No.";
                        }
                    }
                }*/
           
                if(filled($ErrArr))
                {
                    $ErrorStr = implode(",",$ErrArr);
                    Session::put('ALertMesage', $ErrorStr);
                    return redirect()->route('');
                }
                $SaveArr2 = [];
                foreach($DependentNameArr as $DependentKey => $DependentNameValue){
                    $TempArr = [];
                    $TempArr['dependant_id']       =  $DependentIdArr[$DependentKey];
                    $TempArr['dependant_name']     =  $DependentNameValue; /// It is not array. $DependentNameValue or $DependentNameArr[$DependentKey]
                    $TempArr['relationship_name']  =  $RelationShipNameArr[$DependentKey];
                    $TempArr['relationship_id']    =  $RelationshipIdArr[$DependentKey];
                    $TempArr['rel_name']           =  $RelNameArr[$DependentKey];
                    $TempArr['dob_rel']            =  $DOBArr[$DependentKey];
                    $SaveArr2[]                    =  $TempArr;
                }
                $SaveDatanew = json_encode($SaveArr2);
                $SaveArr['module_code'] =  'FAMILY';
                $SaveArr['emp_no']      =   $EmpNo;
                // $SaveArr['old_value']   =   $SaveDataold;
                $SaveArr['new_value']   =   $SaveDatanew;
                $SaveArr['request_date']=   NOW();
                $SaveArr['status']      =   'PENDING';
                $SaveArr['active'] = 1;
                $SaveArr['created_at'] = NOW();
                $SaveArr['created_by'] = session('WcmsEmpNo');
                    if($ChangeRequestId != NULL){
                    $SaveArr['updated_at'] = NOW();
                    $SaveArr['updated_by'] = session('WcmsEmpNo');
                    $SaveEmployee = $this->ChangeRequest->updateChangeRequest($SaveArr,$ChangeRequestId);
                }
                else{
                    $SaveArr['created_at']              = NOW();
                    $SaveArr['created_by']              = session('WcmsEmpNo'); 
                    $SaveEmployee = $this->ChangeRequest->CreateChangeRequest($SaveArr);
                }
                DB::commit();
                $message = "Family Member  Update Request Form Data Saved Successfully";
            }catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            $message = NULL;
            if(($EmpNo != NULL)&&($ActiveTab != NULL)){
                  $this->SaveEmpPhysicalDisabilityDetails($request);
            }
            else{
                $message = "Error : Invalid ICNO & Check your ICNO"; 
            }
            Session::put('ALertMesage', $message); 
            return redirect()->route('change-request.empfamilydetails-change-request');
        }
        $EditCliamData=NULL;  $Page = NULL;
        if(isset($request->id)){ 
            try {
                $EditId = decrypt($request->id);
                $Page   = decrypt($request->Page); 

            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {dd($e);
                $data = "Error : Sorry Invalid Attempt";
                return redirect()->back();
            }
            $EditCliamData=$this->ChangeRequest->ShowEmpRequest(NULL,$EditId);
        }  
        if(filled($EditCliamData)){ 
            $EmpNo = $EditCliamData->emp_no; 
            $Empdata    = $this->Employee->ShowEmployees(NULL,$EmpNo);
            $Familydata = $this->familydetails->ShowFamilyDetailsByEmpNo($EmpNo);
        }else{
            $Empdata    = $this->Employee->ShowEmployeeBySessionEmpNo(); 
            $Familydata = $this->familydetails->ShowFamilyDetailsByEmpNo(session('WcmsEmpNo')); 
        } 
        $DependentData = $this->DependentMaster->ShowDependent(NULL);
        //dd($Familydata);
        return view('change-request.empfamilydetails-change-request')->with('data',compact('Empdata','DependentData','EditCliamData','Page','Familydata')); 
    }

    public function PhysicalDisabilityRequest(Request $request)
    {   
        /* if(((session('WcmsRoleGroupCode') == "ADMUSER")||(session('WcmsRoleGroupCode') == "SUPUSER"))){
                $Empdata = NULL;
                $UserData = $this->Employee->ShowEmployees(NULL,NULL);
        }
        else{
                $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo(); 
                $UserData = NULL;
        } */
       if(isset($request->btn_save)){  
            $EmpNo = $request->txt_emp_icno;
            $ActiveTab = $request->txt_tab;
            $EmpPhysicalDetail = $request->txt_dis_detail;
            $ChangeRequestId = $request->hid_change_id;
            $rules = [
				'EmpNo' => 'required|max:10',
				'EmpPhysicalDetail' => 'required|max:50',
			];

			$ValidateData = [
                'EmpNo'      => $EmpNo,
				'EmpPhysicalDetail' => $EmpPhysicalDetail,
			];

            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($EmpNo == "EmpNo"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Employee No.";
                    }
                    if($EmpPhysicalDetail == "EmpPhysicalDetail"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid Employee Address.";
                    }
                    
                }
            }
           
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('');
            }
            DB::beginTransaction();
            try { 
                $SaveArr1['phy_challange_type'] = $request->txt_dis_detail;
                $SaveArr1['phy_challange_perc'] = $request->txt_perc;
                $SaveData = json_encode($SaveArr1);
                $SaveArr2['phy_challange_type'] = $request->txt_dis_exdetail;
                $SaveArr2['phy_challange_perc'] = $request->txt_perc_old;
                $SaveDataold = json_encode($SaveArr2);
                $SaveArr['module_code'] =  'DISABILITY';
                $SaveArr['emp_no']      =   $EmpNo;
                $SaveArr['old_value']   =   $SaveDataold;
                $SaveArr['new_value']   =   $SaveData;
                $SaveArr['request_date']=   NOW();
                $SaveArr['status']      =   'PENDING';
                $SaveArr['active'] = 1;
                $SaveArr['created_at'] = NOW();
                $SaveArr['created_by'] = session('WcmsEmpNo');
               if($ChangeRequestId != NULL){
                   
                    $SaveArr['updated_at'] = NOW();
                    $SaveArr['updated_by'] = session('WcmsEmpNo');
                    $SaveEmployee = $this->ChangeRequest->updateChangeRequest($SaveArr,$ChangeRequestId);
                   
                }
                else{
                    $SaveArr['created_at']              = NOW();
                    $SaveArr['created_by']              = session('WcmsEmpNo'); 
                    $SaveEmployee = $this->ChangeRequest->CreateChangeRequest($SaveArr); 
                }
            //dd($SaveEmployee);
                DB::commit();
                $message = "Physical Update Request Form Data Saved Successfully";
            }catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            $message = NULL;
            if(($EmpNo != NULL)&&($ActiveTab != NULL)){
                  $this->SaveEmpPhysicalDisabilityDetails($request);
            }
            else{
                $message = "Error : Invalid ICNO & Check your ICNO"; 
            }
            Session::put('ALertMesage', $message); 
            return redirect()->route('change-request.physicaldisability-change-request');
        }
        $EditCliamData=NULL; $Page = NULL;
        if(isset($request->id)){ 
            try { 
                $EditId = decrypt($request->id); 
                $Page   = decrypt($request->Page);
                
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $data = "Error : Sorry Invalid Attempt";
                return redirect()->back();
            }
            $EditCliamData=$this->ChangeRequest->ShowEmpRequest(NULL,$EditId);
        }  
         if(filled($EditCliamData)){ 
            $EmpNo = $EditCliamData->emp_no; 
            $Empdata = $this->Employee->ShowEmployees(NULL,$EmpNo);
        }else{
            $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo(); 
        } 
        return view('change-request.physicaldisability-change-request')->with('data',compact('Empdata','EditCliamData','Page')); 
    }
    public function SaveEmpPhysicalDisabilityDetails($request){
        if($request->hasfile('file_emp_disability')){
            $EmpDisability    = $request->file('file_emp_disability');
            $EmpIcno  = $request->txt_emp_icno;
            $UploadExe = 0;

            $validator1 = Validator::make(
                $request->all(),
                [
                    'file_emp_disability' => 'required|mimes:jpg,jpeg,png|max:2048', // max:2048 specifies the maximum size in kilobytes (2MB)
                ],
                [
                    'file_emp_disability.required' => 'Error: Please select the  employee bank file.',
                    'file_emp_disability.mimes' => 'Error: Only jpg,jpeg,png files are allowed.',
                    'file_emp_disability.max' => 'Error: The file size must be within 2MB.',
                ]
            );
            if($validator1->fails()) { 
                $message = $validator1->errors()->first(); 
                Session::put('ALertMesage', $message); 
            }

            $message = NULL;
            $OrgFileName = $EmpDisability->getClientOriginalName();
            $Extension   = $EmpDisability->getClientOriginalExtension();
            $UploadTimeStr = date("YmdHis");
            $FileType = $EmpDisability->getClientOriginalExtension();
            $FileName = "emp_".$EmpIcno."_dis_supp_doc_".$UploadTimeStr.".".$FileType; //dd($FileName);
            $IsUpload = NULL;
            try {
                if($EmpDisability) {
                    $IsUpload = Helper::UploadFile($EmpDisability,$FileName,'DISABILITY','SUPDOC');
                    //dd($IsUpload);
                }else{
                    $IsUpload = 'UE';
                }
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $IsUpload = 'UE';
            }
            if($IsUpload == "Y"){
                $UploadExe++;
            }
             //dd($IsUpload); 
            if($UploadExe > 0){
                DB::beginTransaction();
                try {
                    $DocumentTypeData = $this->DocumentsType->ShowDocumentTypeByCode('DISABILITY'); 
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
                   // dd( $SaveEmployee);
                    DB::commit();
                    $message = "Document Uploaded Successfully";
                    
                }catch (\Exception $e){ dd($e); 
                    DB::rollback();
                    $message = "Error : Sorry transaction not fully completed";
                }
            
            }
        }
    }
    public function IDCardRequest(Request $request)
    {   
        $EmpNo = $request->txt_emp_icno;
        if(isset($request->btn_save)){  
            $ActiveTab     = $request->txt_tab;
            $IdReason      = $request->cmb_id_reason;
            $IdAmount      = $request->txt_amt;
            $ChangeRequestId = $request->hid_change_id;

            $rules = [
				'IdReason' => 'required|max:30',
				'IdAmount' => 'required|max:5',
			];

			$ValidateData = [
                'IdReason' => $IdReason,
				'IdAmount' => $IdAmount,
			];

            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($IdReason == "IdReason"){
                        $ErrArr[] = "Error : Invalid Id Reason.";
                    }
                    if($IdAmount == "IdAmount"){
                        $ErrArr[] = "Error : Invalid Id Amount.";
                    }
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('change-request.empaddr-change-request');
            }
            DB::beginTransaction();
            try {
                $SaveArr1['id_reason'] = $request->cmb_id_reason;
                $SaveArr1['id_amt']    = $request->txt_amt;
                $SaveData = json_encode($SaveArr1);
                // $SaveArr2['emp_address'] = $request->txt_cont_oldaddress;
                // $SaveData2 = json_encode($SaveArr2);
                $SaveArr['module_code'] =  'IDCARD';
                $SaveArr['emp_no']      =   $EmpNo;
                // $SaveArr['old_value']   =   $SaveData2;
                $SaveArr['new_value']   =   $SaveData;
                $SaveArr['request_date']=   NOW();
                $SaveArr['status']      =   'PENDING';
                $SaveArr['active'] = 1;
                $SaveArr['created_at'] = NOW();
                $SaveArr['created_by'] = session('WcmsEmpNo');
                if($ChangeRequestId != NULL){ 
                    $SaveArr['updated_at'] = NOW();
                    $SaveArr['updated_by'] = session('WcmsEmpNo');
                    $SaveEmployee= $this->ChangeRequest->updateChangeRequest($SaveArr,$ChangeRequestId);
                }
                else{
                    $SaveArr['created_at']              = NOW();
                    $SaveArr['created_by']              = session('WcmsEmpNo'); 
                    $SaveEmployee = $this->ChangeRequest->CreateChangeRequest($SaveArr); 
                }

                DB::commit();
                $message = "ID Card Update Request Form Data Saved Successfully";
            }catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            // $message = NULL;
            // if(($EmpNo != NULL)&&($ActiveTab != NULL)){
            //       $this->SaveEmpAddressDetails($request);
            // }
            // else{
            //     $message = "Error : Invalid ICNO & Check your ICNO"; 
            // }
            Session::put('ALertMesage', $message); 
            return redirect()->route('change-request.id-card-request');
        }
        $EditClaimData=NULL; $Page = NULL;
        if(isset($request->id)){ 
            try {
                $EditId = decrypt($request->id); 
                $Page   = decrypt($request->Page);
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $data = "Error : Sorry Invalid Attempt";
                return redirect()->back();
            }
            $EditClaimData=$this->ChangeRequest->ShowEmpRequest(NULL,$EditId); 
        }
        if(filled($EditClaimData)){ 
            $EmpNo = $EditClaimData->emp_no; 
            $Empdata = $this->Employee->ShowEmployees(NULL,$EmpNo);
        }else{
            $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo(); 
        } 
        return view('change-request.id-card-request')->with('data',compact('Empdata','EditClaimData','Page')); //ID Card Application
    }   
    public function MaritalStatusUpdateRequest(Request $request)
    {   
        /*  if(isset($request->btn_save)){
            
         $EmpNo = $request->txt_emp_icno; 
         $SpouseName = $request->txt_spouse_name;
                DB::beginTransaction();
                try {
                 
                    $EmpGen = $request->hid_emp_gender;
                        $RelationIdData = $this->relationshipMas->ShowEmployeeRelatonshipCode($EmpGen); 
                                          
                        $UserMariStaUpdtArr['emp_no'] = $request->txt_emp_icno;
                        $UserMariStaUpdtArr['fam_member_name'] = $request->txt_spouse_name;
                        $UserMariStaUpdtArr['fam_member_dob'] = $request->txt_dob;
                        $UserMariStaUpdtArr['fam_relationship_id'] = $RelationIdData;
                        $UserMariStaUpdtArr['active'] = 1;
                        $UserMariStaUpdtArr['created_at'] = now();
                        $SaveEmployee= $this->familydetails->CreateFamilyDetails($UserMariStaUpdtArr);
                        
                        if($EmpNo != NULL){
                                $SaveData['emp_marital_status'] = "M";
                                $SaveEmployee= $this->Employee->UpdateEmployee($SaveData,$EmpNo);
                        }                  
                        DB::commit();
                        $message = "Employee Marital Status Saved Successfully";
                }catch (\Exception $e) {dd($e);
                        DB::rollback();
                        $message = "Error : Sorry transaction not fully completed";
                }
                Session::put('ALertMesage', $message);
               // return redirect()->route('change-request.maritalstatus-change-request');
        }        */ 
       /*  if(((session('WcmsRoleGroupCode') == "ADMUSER")||(session('WcmsRoleGroupCode') == "SUPUSER"))){
            $Empdata = NULL;
            $UserData = $this->Employee->ShowEmployees(NULL,NULL);
        }else{
            $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo(); 
            $UserData = NULL;
        } */
         if(isset($request->btn_save)){ 
            $EmpNo = $request->txt_emp_icno;
            $ActiveTab  = $request->txt_tab;
            $EmpSpouseName = $request->txt_spouse_name;
            $EmpSpouseDoB = $request->txt_spouse_dob;
            $ChangeRequestId = $request->hid_change_id;        
            $rules = [
				'EmpSpouseName' => 'required|max:50',
				'EmpSpouseDoB' => 'required|max:20',
			];
			$ValidateData = [
                'EmpSpouseName' => $EmpSpouseName,
				'EmpSpouseDoB'   => $EmpSpouseDoB,
			];
            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($EmpSpouseName == "EmpSpouseName"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Employee Spouse Name.";
                    }
                    if($EmpSpouseDoB == "EmpSpouseDoB"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid Employee Employee DOB.";
                    }
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('change-request.empbankdetails-change-request');
            }
            DB::beginTransaction();
            try {
                $SaveArr1['Spouse_name'] = $request->txt_spouse_name;
                $SaveArr1['Spouse_dob'] = $request->txt_spouse_dob;
                $SaveData = json_encode($SaveArr1);

                //$SaveArr2['emp_address'] = $request->txt_cont_address;
                //$SaveData = json_encode($SaveArr1);

                $SaveArr['module_code'] =  'MARRIAGE_CERT';
                $SaveArr['emp_no']      =   $EmpNo;
                $SaveArr['old_value']   =   NULL;
                $SaveArr['new_value']   =   $SaveData;
                $SaveArr['request_date']=   NOW();
                $SaveArr['status']      =   'PENDING';
                $SaveArr['active'] = 1;
                $SaveArr['created_at'] = NOW();
                $SaveArr['created_by'] = session('WcmsEmpNo');
                if($ChangeRequestId != NULL){ 
                    $SaveArr['updated_at'] = NOW();
                    $SaveArr['updated_by'] = session('WcmsEmpNo');
                    $SaveEmployee = $this->ChangeRequest->updateChangeRequest($SaveArr,$ChangeRequestId);
                }
                else{
                    $SaveArr['created_at']              = NOW();
                    $SaveArr['created_by']              = session('WcmsEmpNo'); 
                    $SaveEmployee = $this->ChangeRequest->CreateChangeRequest($SaveArr); 
                }
                DB::commit();
                $message = "Address Update Request Form Data Saved Successfully";
            }catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            $message = NULL;
            if(($EmpNo != NULL)&&($ActiveTab != NULL)){
                  $this->SaveEmpMaritalDocument($request);
            }
            else{
                $message = "Error : Invalid ICNO & Check your ICNO"; 
            }
            Session::put('ALertMesage', $message); 
            return redirect()->route('change-request.maritalstatus-change-request');
        }
        $Page = NULL;
        $EditCliamData=NULL;
        if(isset($request->id)){  
            try {
                $EditId = decrypt($request->id); 
                $Page   = decrypt($request->Page);
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $data = "Error : Sorry Invalid Attempt";
                return redirect()->back();
            }
            $EditCliamData=$this->ChangeRequest->ShowEmpRequest(NULL,$EditId);
            //dd($EditCliamData); 
        }  
        if(filled($EditCliamData)){ 
            $EmpNo = $EditCliamData->emp_no; 
            $Empdata = $this->Employee->ShowEmployees(NULL,$EmpNo);
        }else{
            $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo(); 
        } 
        $MaritalData = $this->Employee->ShowEmployeesByMaritalStatus(NULL,NULL); 
        return view('change-request.maritalstatus-change-request')->with('data',compact('Empdata','MaritalData','EditCliamData','Page')); //ID Card Application
    }
    public function SaveEmpMaritalDocument($request){
        if($request->hasfile('file_emp_marriage')){
            $EmpMarriage = $request->file('file_emp_marriage');
            $EmpIcno     = $request->txt_emp_icno;
            $UploadExe = 0;

            $validator1 = Validator::make(
                $request->all(),
                [
                    'file_emp_marriage' => 'required|mimes:jpg,jpeg,png|max:2048', // max:2048 specifies the maximum size in kilobytes (2MB)
                ],
                [
                    'file_emp_marriage.required' => 'Error: Please select the  Marriage Certificate.',
                    'file_emp_marriage.mimes' => 'Error: Only jpg,jpeg,png files are allowed.',
                    'file_emp_marriage.max' => 'Error: The file size must be within 2MB.',
                ]
            );
            if($validator1->fails()) { 
                $message = $validator1->errors()->first(); 
                Session::put('ALertMesage', $message); 
            }

            $message = NULL;
            $OrgFileName = $EmpMarriage->getClientOriginalName();
            $Extension   = $EmpMarriage->getClientOriginalExtension();

            $UploadTimeStr = date("YmdHis");
            $FileType = $EmpMarriage->getClientOriginalExtension();
            $FileName = "emp_".$EmpIcno."_marriage_supp_doc_".$UploadTimeStr.".".$FileType; //dd($FileName);
            $IsUpload = NULL;
            try {
                if($EmpMarriage) {
                    $IsUpload = Helper::UploadFile($EmpMarriage,$FileName,'MARRIAGE_CERT','SUPDOC');
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
                    $DocumentTypeData = $this->DocumentsType->ShowDocumentTypeByCode('MARRIAGE_CERT'); 
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
                   // dd( $SaveEmployee);
                    DB::commit();
                    $message = "Document Uploaded Successfully";
                    
                }catch (\Exception $e){ dd($e); 
                    DB::rollback();
                    $message = "Error : Sorry transaction not fully completed";
                }
            }
        }
    }
    public function MedicalCardRequest(Request $request)
    {   
        $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo();
        $FamilyDetails = $this->familydetails->ShowFamilyDetailsByEmpNo(session('WcmsEmpNo'));
        return view('change-request.medical-card-request')->with('data',compact('Empdata','FamilyDetails')); //Medical Card Application
    } 
    public function LeaveJoiningRequest(Request $request)
    {   
        $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo();
        return view('change-request.leave-join-request')->with('data',compact('Empdata'));//Leave Joining Application / Report 
    }
    public function LeaveRequest(Request $request)
    {   
        $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo();
        return view('change-request.leave-request')->with('data',compact('Empdata'));//Leave Joining Application / Report 
    }
    public function HRAClaimRequest(Request $request)
    {   
        $Empdata   = $this->Employee->ShowEmployeeBySessionEmpNo();
        $Housedata = $this->House->ShowHouseMaster(NULL,session('WcmsEmpNo')); 
        return view('change-request.hra-claim-request')->with('data',compact('Empdata','Housedata')); //HRA Claim Application
    } 
    public function DataCardMobPhonChrgClaimRequest(Request $request)
    {   
        $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo();
        return view('change-request.datcrd-mobphn-chrg-clm-request')->with('data',compact('Empdata')); //Data Card / Mobile Phone Charge Claim Application
    } 
    public function CPFGPFAdvanceRequest(Request $request)
    {   
        $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo();
        $Cpfdata = $this->CpfAllowance->ShowCpfAllowance();
        return view('change-request.cpf-gpf-advan-request')->with('data',compact('Empdata','Cpfdata')); //CPF/GPF Advance Application 
    } 
    public function WitDrawFrCPFGPFRequest(Request $request)
    {   
             $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo();
             $Cpfdata = $this->CpfWithdraw->ShowCpfWithdraw();
            return view('change-request.witdraw-fr-cpf-gpf-request')->with('data',compact('Empdata','Cpfdata')); //WIthdraw from CPF/GPF Application
    }
    public function PFAddiSubscriRequest(Request $request)
    {   
          if(isset($request->btn_save)){ 
           //dd($request);
            $EmpNo           = $request->txt_emp_icno;
            $ExPfAmount      = $request->txt_ex_pf_amount;
            $NewPfAmount     = $request->txt_new_pf_amount;
            $ApplicableMonth = $request->cmb_applicable_month;
            $ApplicableYear = $request->txt_applicable_year;
             DB::beginTransaction();
            try {
                $SaveArr1['Existing_pf-amount'] = $request->txt_ex_pf_amount;
                $SaveData = json_encode($SaveArr1);

                $SaveArr2['New_pf-amount'] = $request->txt_new_pf_amount;
                $SaveData1 = json_encode($SaveArr2);

                $SaveArr['module_code'] =  'PF_ADD';
                $SaveArr['emp_no']      =   $EmpNo;
                $SaveArr['old_value']   =   $SaveData;
                $SaveArr['new_value']   =   $SaveData1;
                $SaveArr['request_date']=   NOW();
                $SaveArr['status']      =   'PENDING';
                $SaveArr['active'] = 1;
                $SaveArr['created_at'] = NOW();
                $SaveArr['created_by'] = session('WcmsEmpNo');
                $SaveEmployee= $this->ChangeRequest->CreateChangeRequest($SaveArr);
               // dd($SaveEmployee);
                DB::commit();
                $message = "PF Amount Update Request Form Data Saved Successfully";
            }catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
        }
        $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo();
        return view('change-request.pf-addi-subcr-request')->with('data',compact('Empdata')); //PF Additional Subscription Request
    } 
    public function FixOfPayPromoAppRequest(Request $request)
    {   
         $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo();
         return view('change-request.fix-of-pay-promo-app-request')->with('data',compact('Empdata')); //Fixation of Pay on Promation Application Request
    } 
    public function ReimburBokAllowRequest(Request $request)
    {   
        $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo();
        return view('change-request.reimbur-book-allow-request')->with('data',compact('Empdata')); //Reimbursement of Book Allowance Application
    } 
    public function ClmHonoUdrTeachAssiRequest(Request $request)
    {   
        $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo();
        return view('change-request.clm-honrm-ur-teach-assi-request')->with('data',compact('Empdata')); //Claim of Honorarium Under Teaching Assistanship - Request
    } 
    public function ELEncashLTCRequest(Request $request)
    {   
             $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo();
            return view('change-request.el-encash-ltc-request')->with('data',compact('Empdata')); //EL Encashment along with LTC Request
    }
    public function AdvClaimLTCRequest(Request $request)
    {   
            if(isset($request->btn_save)){  
            $EmpNo            = $request->txt_emp_icno;
            //dd($EmpNo);
            $SpouseEmployed   = $request->rad_spouse_employed;
            $EntitledLTC      = $request->txt_entitle_LTC;
            $VisitingHome     = $request->rad_visiting;
            $BlockYear        = $request->Year_LTC;
           // dd($BlockYear);
            $FromPlace        = $request->place_visited;
            $TravelMode       = $request->rad_travel;
            $ToPlace          = $request->txt_from_place;
            $VisitingFromDate = $request->txt_from_place;
            $VistingToDate    = $request->txt_to_place;
            $JourneyFromDate  = $request->txt_journey_from_date;
            $JourneyToDate    = $request->txt_journey_to_date;
            $AdvanceAmount    = $request->txt_adv_amount;
            //dd($AdvanceAmount);
         
            $rules = [
				'EmpNo' => 'required|max:10',
				'BlockYear' => 'required|max:10',
			];
			$ValidateData = [
                'EmpNo'      => $EmpNo,
				'BlockYear' => $BlockYear,
			];
            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($EmpNo == "EmpNo"){
                        $ErrArr[] = "Error : Invalid Employee No.";
                    }
                    if($BlockYear == "BlockYear"){
                        $ErrArr[] = "Error : Invalid Emp Contact.";
                    }
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('change-request.adv-claim-ltc-request');
            }
            DB::beginTransaction();
            try {
                $SaveArr['emp_no']        =   $EmpNo;
                $SaveArr['block_year']   =   $BlockYear;
                $SaveArr['advance_amount']=   $AdvanceAmount;
                $SaveArr['active'] = 1;
                $SaveArr['created_at'] = NOW();
                $SaveArr['created_by'] = session('WcmsEmpNo');
                $SaveEmployee = $this->LtcAdv->createLtcAdvances($SaveArr);
               // dd($SaveEmployee);
                DB::commit();
                $message = "LTC Advanced  Request Form Data Saved Successfully";
            }catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
        }
        $Empdata       = $this->Employee->ShowEmployeeBySessionEmpNo();
        $Payleveldata  = $this->PayLevel->ShowEmployeePayLevelByEmpno(session('WcmsEmpNo')); 
        return view('change-request.adv-claim-ltc-request')->with('data',compact('Empdata','Payleveldata')); //EL Encashment along with LTC Request
    }
    public function SettClaimLTCRequest(Request $request)
    {   
        $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo();
        return view('change-request.sett-claim-ltc-request')->with('data',compact('Empdata')); //EL Encashment along with LTC Request
    }
    public function HomeTownRequest(Request $request)
    {   
        if(isset($request->btn_save)){ 
            $EmpNo           = $request->txt_emp_icno;
            $ActiveTab       = $request->txt_tab;
            $OldHomeTown     = $request->txt_old_hometown;
            $NewHomeTown     = $request->txt_new_hometown;
            $ChangeRequestId = $request->hid_change_id;
           // dd($ChangeRequestId);
            $rules = [
				'OldHomeTown' => 'required|max:50',
				'NewHomeTown' => 'required|max:50',
			];
			$ValidateData = [
                'OldHomeTown' => $OldHomeTown,
				'NewHomeTown' => $NewHomeTown,
			];
            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($OldHomeTown == "OldHomeTown"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Existing Home Town.";
                    }
                    if($NewHomeTown == "NewHomeTown"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid New Home Town.";
                    }
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('change-request.empcontact-change-request');
            }
            DB::beginTransaction();
            try { 
                $SaveArr1['emp_hometown'] = $request->txt_new_hometown;
                $SaveData  = json_encode($SaveArr1);
                $SaveArr2['emp_hometown'] = $request->txt_old_hometown;
                $SaveDataOld = json_encode($SaveArr2);
                $SaveArr['module_code']  =   'HOMETOWN';
                $SaveArr['emp_no']       =   $EmpNo;
                $SaveArr['old_value']    =   $SaveDataOld;
                $SaveArr['new_value']    =   $SaveData;
                $SaveArr['request_date'] =   NOW();
                $SaveArr['status']       =   'PENDING';
                $SaveArr['active'] = 1;
                $SaveArr['created_at'] = NOW();
                $SaveArr['created_by'] = session('WcmsEmpNo');
                if($ChangeRequestId != NULL){ 
                    $SaveArr['updated_at'] = NOW();
                    $SaveArr['updated_by'] = session('WcmsEmpNo');
                    $SaveEmployee = $this->ChangeRequest->updateChangeRequest($SaveArr,$ChangeRequestId);
                }
                else{
                    $SaveArr['created_at']              = NOW();
                    $SaveArr['created_by']              = session('WcmsEmpNo'); 
                    $SaveEmployee = $this->ChangeRequest->CreateChangeRequest($SaveArr); 
                }
                DB::commit();
                $message = "Home Town Update Request Form Data Saved Successfully";
                Session::put('ALertMesage', $message); 
                return redirect()->route('change-request.home-town-request');
            }catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
        }
        /* if(((session('WcmsRoleGroupCode') == "ADMUSER")||(session('WcmsRoleGroupCode') == "SUPUSER"))){

            $Empdata = NULL;
            $UserData = $this->Employee->ShowEmployees(NULL,NULL);

        }else{
            $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo(); 
            $UserData = NULL;
        }   */
        $EditCliamData=NULL; $Page = NULL;
        if(isset($request->id)){ 
            try {
                $EditId = decrypt($request->id); 
                $Page   = decrypt($request->Page);
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $data = "Error : Sorry Invalid Attempt";
                return redirect()->back();
            }
            $EditCliamData=$this->ChangeRequest->ShowEmpRequest(NULL,$EditId); 
        }
        if(filled($EditCliamData)){ 
            $EmpNo = $EditCliamData->emp_no; 
            $Empdata = $this->Employee->ShowEmployees(NULL,$EmpNo);
        }else{
            $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo(); 
        }  
       
        return view('change-request.home-town-change-request')->with('data',compact('Empdata','EditCliamData','Page'));
    } 
    public function ExportIdCardRequestPdf(Request $request)
    { 
        $EmpNo = decrypt($request->id);
        $IdData = $this->ChangeRequest->ShowEmpPendingChangeRequest(NULL,$EmpNo,'IDCARD');
        $data = ['IdData'=>$IdData];
        $pdf = PDF::loadView('change-request.export-id-pdf', $data);
        return $pdf->download('My_Profile_'.$EmpNo.'.pdf');
    }
    
}
