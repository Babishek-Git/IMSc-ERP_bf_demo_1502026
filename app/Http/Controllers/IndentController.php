<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\MaterialType;
use App\Models\AemEmployee;
use App\Models\Indent;
use App\Models\IndentDetail;
use App\Models\MaterialUnit;
use App\Models\Role;
use App\Models\Gia;
use App\Models\WorkFlow;
use App\Models\WorkFlowMovement;
use App\Models\ProjectMaster;
use App\Models\ProjectStaff;
use App\Models\FieldAccesMaster;
//use App\Models\BudgetSanction;
use App\Models\BudgetSanctionExpenditureMaster;
use App\Models\EmployeeGroupMaster;
use App\Models\RcItemRateMaster;
use App\Models\RoleBasedFormTitle;
use App\Models\BudgetAllocation;
use App\Models\PurchaseOrder;
use App\Models\ObjectHead;
use App\Models\ObjectHeadSubCategory;
use App\Models\ObjectHeadGiaMapping;
use App\Models\BudgetAllocationClaimed;
use App\Models\BudgetAllocationReceived;
use App\Models\Materialgroup;
use App\Models\IndentProcessTransaction;
use App\Models\SupportingDocument;





// New services
use App\Services\LeaveCalculationService;
use App\Services\LeaveApplicationService;
use App\Services\WorkFlowProcessService;
use Helper;
use DB;
use Session;
class IndentController extends Controller
{
    protected LeaveCalculationService $calcService;
    protected LeaveApplicationService $appService;
    protected WorkFlowProcessService $WorkFlowService;

     public function __construct(
        LeaveCalculationService $calcService,
        LeaveApplicationService $appService,
        WorkFlowProcessService $WorkFlowService,
     ){ 
        $this->MaterialType = new MaterialType();
        $this->Employee     = new AemEmployee();
        $this->Indent       = new Indent();
        $this->IndentDetail = new IndentDetail();
        $this->UnitMaster   = new MaterialUnit();
        $this->EmpRole      = new Role();
        $this->ModuleWorkFlow      = new WorkFlow();
        $this->WorkFlowMovementDet = new WorkFlowMovement();
        $this->ProjectMaster       = new ProjectMaster();
        $this->StaffProjectMaster  = new ProjectStaff();
        $this->FieldAccesMaster    = new FieldAccesMaster();
      //  $this->BudgetSanction      = new BudgetSanction();
        $this->BudSanExpMaster     = new BudgetSanctionExpenditureMaster();
        $this->EmpGroupMaster      = new EmployeeGroupMaster();
        $this->RcItemRateMaster    = new RcItemRateMaster();
        $this->RoleBasedFormTitle  = new RoleBasedFormTitle();
        $this->BudgetAllocationMaster    = new BudgetAllocation();
        $this->PurchaseOrderMaster       = new PurchaseOrder();
        $this->ObjHeadGiaMappingMaster   = new ObjectHeadGiaMapping();
        $this->ObjectHead                = new ObjectHead();
        $this->ObjectHeadSubCategory     = new ObjectHeadSubCategory();
        $this->BudgetClaimMaster         = new BudgetAllocationClaimed();
        $this->BudgetRecivedMaster       = new BudgetAllocationReceived();
        $this->GiaMaster                 = new Gia();
        $this->MaterialgroupMaster       = new Materialgroup();
        $this->IndentProcessMaster       = new IndentProcessTransaction();
        $this->SupportingDocMaster       = new SupportingDocument();



        $this->calcService = $calcService;
        $this->appService  = $appService;
        $this->WorkFlowService = $WorkFlowService;
     }
    public function IndentCreation(Request $request) {
        if(isset($request->SubmitApplication)){
            try {
                $ConsumablesItemsAvabile = $request->input('hidd_cous_item_avable');
                if(filled($ConsumablesItemsAvabile) && $ConsumablesItemsAvabile == 'Y'){
                    $IsSaved = $this->ConsumableIndentDetailsSave($request);
                    if(!$IsSaved){
                        Session::put('ALertMesage', 'Error while saving consumable items');
                        return redirect()->back();
                    }
                }
                $TransactionId  = decrypt($request->txt_application_id);
                $ModuleCode     = decrypt($request->wf_module_code);
                $PageAction     = decrypt($request->txt_action);
                $WorkFlowMode   = $request->txt_wf_mode;
                $CurrStatus     = $request->hid_current_status;
                $ActualEmpNo    = $request->txt_actual_emp;
                $WorkFlowRemark = $request->txt_action_remarks;
                $WorkFlowEmpNo  = $request->txt_wf_emp_no;
                $WorkFlowRole   = $request->txt_wf_role;
                $WorkFlowAction = $request->txt_wf_action;
                $RolePosition   = $request->txt_role_position;
                $TotaIndentCost = $request->hidd_total_amt;
                if ($WorkFlowAction !="") {
                    $CurrentStage      = ($WorkFlowAction == 'AP') ? 'IA' : 'IC';
                    $FromPage          = 'WRKFLOW';
                    $SaveBudgetExpData = $this->SaveBudgetExpenditureDetails($request, $TransactionId,$CurrentStage,$FromPage,$TotaIndentCost);
                }
                $GetExpData            = $this->BudSanExpMaster->ShowBudgetExpData($TransactionId,$ModuleCode);
                $IndetBudGetExpDetails = collect($GetExpData)->where('is_current',true)->first();
                $GetSancationId        = $IndetBudGetExpDetails->budget_sanction_id ?? NULL;
                $GetGiaId              = $IndetBudGetExpDetails->gia_id ?? NULL;
                $IndentProjId          = $IndetBudGetExpDetails->project_id ?? NULL;
                $ParentProjId          = $IndetBudGetExpDetails->project_parent_id ?? NULL;
                $ObjHeadId             = $IndetBudGetExpDetails->object_head_id ?? NULL;
                $ObjSubCatId           = $IndetBudGetExpDetails->oh_sub_cata_id ?? NULL;
                $ProjUptoUtilizedAmt   = $IndetBudGetExpDetails->proj_upto_dt_utilized_amt ?? NULL;
                $ProjBalanceAmt        = $IndetBudGetExpDetails->proj_balance_amt ?? NULL;
                $OHUptoUtilizedAmt     = $IndetBudGetExpDetails->oh_upto_dt_utilized_amt ?? NULL;
                $OHBalanceAmt          = $IndetBudGetExpDetails->oh_balance_amt ?? NULL;
                $IndentTotalCost       = $TotaIndentCost ?? '';
                $Data = [
                    'budget_sanction_id'      => $GetSancationId,
                    'gia_id'                  => $GetGiaId,
                    'project_id'              => $IndentProjId,
                    'project_parent_id'       => $ParentProjId,
                    'object_head_id'          => $ObjHeadId,
                    'oh_sub_cata_id'          => $ObjSubCatId,
                    'proj_upto_utilized_amt'  => $ProjUptoUtilizedAmt,
                    'proj_balance_amt'        => $ProjBalanceAmt,
                    'oh_upto_utilized_amt'    => $OHUptoUtilizedAmt,
                    'oh_balance_amt'          => $OHBalanceAmt,
                    'indent_total_cost'       => $IndentTotalCost
                ];
                $BudgetJsonData = json_encode($Data);
                if($CurrStatus == 'submitted'){
                    $RoutUrl = 'indent.indent-forward-to-accounts';
                }else if($CurrStatus == 'SU'){
                    $RoutUrl = 'indent.indent-view';
                }else if($CurrStatus == 'recommended'){
                    $RoutUrl = 'indent.indent-forward-to-accounts';
                }else{
                    $RoutUrl = 'indent.indent-view';
                }
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) { dd($e);
                $message = "Error : Sorry Invalid Attempt";
                Session::put('ALertMesage', $message);
                return redirect()->route($RoutUrl);
            }
            if(isset($request->rad_Basis)){
                $IsFundAvailable = $request->rad_Basis;
                if($IsFundAvailable == 'yes'){
                    $UpdateArr['is_fund_availabile'] = true;
                }else if($IsFundAvailable == 'No'){
                    $UpdateArr['is_fund_availabile'] = false;
                }else{
                    $UpdateArr['is_fund_availabile'] = NULL;
                }
                $SaveIndent   = $this->Indent->UpdateIndent($UpdateArr,$TransactionId);
            }
            $WorkFlowData    = (object)['BudgetExpData'=>$BudgetJsonData,'TransactionId'=>$TransactionId,'WflowModule'=>$ModuleCode,'WorkFlowMode'=>$WorkFlowMode,'ActualEmpNo'=>$ActualEmpNo,'WorkFlowRemark'=>$WorkFlowRemark,'WorkFlowEmpNo'=>$WorkFlowEmpNo,'WorkFlowRole'=>$WorkFlowRole,'WorkFlowAction'=>$WorkFlowAction,'RolePosition'=>$RolePosition];
            $WorkFlowMessage = $this->WorkFlowService->WorkFlowMovementProcess($TransactionId,$ModuleCode,$WorkFlowData);
            Session::put('ALertMesage', $WorkFlowMessage);
            return redirect()->route($RoutUrl);
        }
        if(isset($request->EditId)){ 
            if(isset($request->btn_save)){ 
                return $this->SaveIndentDetails($request);
            }
            try{
                $ProjApplicableArray   = [];
                $IndentEditId          = decrypt($request->EditId);
                $FromPage              = decrypt($request->page);
                $Flag                  = !empty($request->FLAG) ? decrypt($request->FLAG) : '';
                $ShowIndentEditDetails = $this->IndentDetail->ShowIndentDetails(NULL,$IndentEditId);
                $MaterialTypeData      = $this->MaterialType->ShowMaterialType(NULL);
                $ShowSessionEmpdata    = $this->Employee->ShowEmployeeBySessionEmpNo(); 
                $EditIndentData        = $this->Indent->IndentApplicationData(null,$IndentEditId); 
                $ShowMaterialUnit      = $this->UnitMaster->ShowMaterialUnit(NULL);
                $Empdata               = $this->Employee->ShowEmployees($request,NULL);
                $IndentApplicationData = $this->Indent->IndentApplicationData(NULL,$IndentEditId);
                $ProjectId             = $this->Indent->IndentApplicationData(NULL,$IndentEditId)->pluck('project_id')->first();
                $ProjectDataView       = $this->ProjectMaster->ShowAllParentChild();
                $ProjectDetailsData    = $this->ProjectMaster->GetAllProjectData(NULL);
                //$ProjectDetails        = collect($ProjectDetailsData)->pluck('project_name', 'project_id')->toArray();
                $EmpProjectDetails       = collect($ProjectDataView)->whereIn('project_id', $ProjectId)->values() ?? '';
                $SessionWiseCurrentData      = $this->StaffProjectMaster->ShowSessionWiseCurrentProject($request);
                $SessionWiseFiledAcessData   = $this->FieldAccesMaster->ShowSessionRoleWiseFieldData(NULL,'INDENT','BUD_DET');
                $AllObectHead                = $this->ObjectHead->ShowObjectHead(NULL);
                $AllObectHeadSubCata         = $this->ObjectHeadSubCategory->ShowObjectHeadSubCata(NULL);
                $GetMatCategoryData          = $this->MaterialgroupMaster->ShowMatCategoryAllParentChild();
                $GetGiaData                  = $this->GiaMaster->ShowGia();
                $GetGiaId                    = collect($GetGiaData)->where('gia_code','REG')->pluck('gia_id')->first();
                $OHMappData                  = $this->ObjHeadGiaMappingMaster->ShowObjectHeadDataByGiaId($GetGiaId);
                
                $EmpNo                  = collect($IndentApplicationData)->pluck('created_by')->first() ?? NULL;
                $EmpDataByEmpNo         = $this->Employee->ShowEmployeesBYEmpNo(NULL,$EmpNo);
                $ProjApplicable         = $this->EmpGroupMaster->ShowIsProjApplicable($request);
                $ProjApplicableArray    = collect($ProjApplicable)->pluck('emp_group_name', 'emp_group_id')->toArray();
                $EmpGroupTypeId         = collect($EmpDataByEmpNo)->pluck('employee_group_type')->first();
                $IsProjApplicable       = isset($ProjApplicableArray[$EmpGroupTypeId]) && $ProjApplicableArray[$EmpGroupTypeId] ? 'Y' : '';
                // $ProjectDetails               = $this->ProjectMaster->ShowProjectMaster(NULL);
                $MatTypeId                       = collect($EditIndentData)->pluck('mat_type_id')->first();
                $SessionWiseIndentRateAcessData  = $this->FieldAccesMaster->GetSessionWiseItemviewAccess(NULL,'INDENT','IND_ITEM_DET',$MatTypeId);
                $ConsumablesItemsData            = $this->RcItemRateMaster->ShowConsumablesItemsData($request);
                $IndentSubmitFormTittel          = $this->RoleBasedFormTitle->GetRoleBaseTittel(NULL,'INDENT');
                $WorkFlowAction = NULL;
                $TargetRoles    = collect($IndentApplicationData)->pluck('target_roles')->first() ?? NULL;
                $IsCompleted    = collect($IndentApplicationData)->pluck('is_completed')->first();
                $ApprAuthRole   = collect($IndentApplicationData)->pluck('approve_auth_role')->first() ?? NULL;
                $WorkFlowActionData = [];
                if(($IsCompleted == NULL)||($IsCompleted == false)){
                    if(($TargetRoles == '')||($TargetRoles == NULL)){
                        $WorkFlowAction = 'SU'; // Submit
                        $WorkFlowActionData = ['WorkFlowAction' => $WorkFlowAction];
                    }else{
                        $WorkFlowActionData = $this->WorkFlowService->CheckForwardAndBackward('INDENT',$IndentEditId,$TargetRoles,$ApprAuthRole);
                    }
                }
                $OHId                 = collect($IndentApplicationData)->pluck('object_head_id')->first() ?? NULL;
                $OHSubCataId          = collect($IndentApplicationData)->pluck('oh_sub_cata_id')->first() ?? NULL;
                $BudegtFieldAccess    = (count($SessionWiseFiledAcessData) > 0) ? 'Y' : '';
                $ItemRateFieldAccess  = (count($SessionWiseIndentRateAcessData) > 0) ? 'Y' : '';
                if($BudegtFieldAccess =="Y"){ 
                   $ShowBudgetSanactionData  = $this->GetBudgetSanctionByProject($ProjectId,$OHId,$OHSubCataId);
                }else{
                    $ShowBudgetSanactionData ='';
                }
                if($FromPage == 'EDIT'){
                    return view('indent.indent-creation')->with('data',compact('OHMappData','AllObectHead','GetMatCategoryData','AllObectHeadSubCata','ShowIndentEditDetails','MaterialTypeData','Empdata','EditIndentData','FromPage','ShowMaterialUnit','EmpProjectDetails','SessionWiseCurrentData','IsProjApplicable'));
                }else{
                    $AllObectHeadDetails    = collect($AllObectHead)->pluck('object_head_name','object_head_id')->toArray();
                    $AllObectHeadSubDetails = collect($AllObectHeadSubCata)->pluck('oh_sub_cata_name','AllObectHeadSubCata')->toArray();
                    return view('indent.indent-view-submit')->with('data',compact('GetMatCategoryData','SessionWiseFiledAcessData','AllObectHeadDetails','AllObectHeadSubDetails','ShowIndentEditDetails','MaterialTypeData','Empdata','EditIndentData','FromPage','ShowMaterialUnit','WorkFlowActionData','WorkFlowAction','EmpProjectDetails','BudegtFieldAccess','ShowBudgetSanactionData','IsProjApplicable','ItemRateFieldAccess','IndentSubmitFormTittel'));
                }
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) { dd($e);
                $message = "Error: Sorry, invalid attempt.";
            }
            if(filled($message)){
                Session::put('ALertMesage', $message);
                return redirect()->route('indent.indent-view');
            }
        }
        if(isset($request->btn_save)){ 
            return $this->SaveIndentDetails($request);
        }
        $ProjApplicableArray    = [];
        $MaterialTypeData       = $this->MaterialType->ShowMaterialType(NULL);
        $ShowEmpSessiondata     = $this->Employee->ShowEmployeeBySessionEmpNo(); 
        $ShowMaterialUnit       = $this->UnitMaster->ShowMaterialUnit(NULL);
        $ShowMaxIndentSuffNo    = $this->Indent->IndentMaxSuffixNo($request);
        $SessionWiseCurrentData = $this->StaffProjectMaster->ShowSessionWiseCurrentProject($request); 
        $ProjApplicable         = $this->EmpGroupMaster->ShowIsProjApplicable($request);
        $ProjApplicableArray    = collect($ProjApplicable)->pluck('emp_group_name', 'emp_group_id')->toArray();
        $SessionEmpGroupTypeId  = collect($ShowEmpSessiondata)->pluck('employee_group_type')->first();
        // $IsProjApplicable    = isset($ProjApplicableArray[$SessionEmpGroupTypeId]) && $ProjApplicableArray[$SessionEmpGroupTypeId] ? 'Y' : '';
        $IsProjApplicable       = (count($SessionWiseCurrentData) > 0) ? 'Y' : '';
        $ProjectDataView        = $this->ProjectMaster->ShowAllParentChild();
        $StaffProjectId         = collect($SessionWiseCurrentData)->pluck('project_id') ?? '';
        $EmpProjectDetails      = collect($ProjectDataView)->whereIn('project_id', $StaffProjectId)->values() ?? '';
        // $ObjHeadGiaMappDetails  = $this->ObjHeadGiaMappingMaster->ShowObjectHeadDataByGiaIdAndProjId(NULL,$StaffProjectId);
        $GetGiaData             = $this->GiaMaster->ShowGia();
        $GetGiaId               = collect($GetGiaData)->where('gia_code','REG')->pluck('gia_id')->first();
        $AllObectHead           = $this->ObjectHead->ShowObjectHead(NULL);
        $AllObectHeadSubCata    = $this->ObjectHeadSubCategory->ShowObjectHeadSubCata(NULL);
        $AllObectHeadSubCataGrpData  = filled($AllObectHeadSubCata) ? collect($AllObectHeadSubCata)->groupBy('object_head_id') : [];
        $OHMappData                  = $this->ObjHeadGiaMappingMaster->ShowObjectHeadDataByGiaId($GetGiaId);
        $GetMatCategoryData          = $this->MaterialgroupMaster->ShowMatCategoryAllParentChild();
        return view('indent.indent-creation')->with('data',compact('OHMappData','AllObectHead','GetMatCategoryData','AllObectHeadSubCata','AllObectHeadSubCataGrpData','MaterialTypeData','ShowEmpSessiondata','ShowMaterialUnit','ShowMaxIndentSuffNo','EmpProjectDetails','IsProjApplicable'));
    }
     public function IndentView(Request $request) {
        $Indentdata = $this->Indent->ShowIndent(null,null); 
        return view('indent.indent-view')->with('data',compact('Indentdata'));
    }
    // public function IndentForward(Request $request) {
    //     if(isset($request->id)){ 
    //         $FamilyMemberArr    = $request->txt_family_name;
    //         $FamilyMemberDobArr = $request->txt_dob;
    //         $FamilyMemberAgeArr = $request->txt_age;
    //         DB::beginTransaction();
    //         try {
    //              foreach($FamilyMemberArr as $FamilyMemberKey => $FamilyMemberId){
    //                 $FamilyMemeber    = $FamilyMemberArr[$FamilyMemberKey];
    //                 $FamilyMemberDob  = $FamilyMemberDobArr[$FamilyMemberKey];
    //                 $FamilyMemberAge  = $FamilyMemberAgeArr[$FamilyMemberKey];

    //                 $SaveData['fam_mem_name'] = $FamilyMemeber;
    //                 $SaveData['fam_mem_dt']   = $FamilyMemberDob;
    //                 $SaveData['fam_mem_age']  = $FamilyMemberAge;
    //                 $SaveEmployee= $this->Pratice->createFamilyMember($SaveData);
    //              }
    //             DB::commit();
    //             $message = "Family Member  Data Saved ";
    //         }catch (\Exception $e) { dd($e);
    //             DB::rollback();
    //             $message = "Error : Sorry transaction not fully completed";
    //         }
    //     }
    //     $Indentdata = $this->Indent->ShowIndent(null,null); 
    //     return view('indent.indent-forward-to-accounts')->with('data',compact('Indentdata'));
    // }
    
    public function IndentForward(Request $request) {
        $Indentdata = $this->Indent->ShowIndent(null,null); 
        $PageFlag   = 'FWINDENT';
        return view('indent.indent-forward-to-accounts')->with('data',compact('Indentdata','PageFlag'));
    }
    public function IndentStatus(Request $request) {
        if(isset($request->id)){
            try{
                $IndentId        = decrypt($request->id);
                $ModuleCode      = decrypt($request->modulecode);
                $Empdata         = $this->Employee->ShowEmployees($request,NULL); 
                $EditIndentData  = $this->Indent->ShowIndent(null,$IndentId);
                $RoleData        = $this->EmpRole->ShowRoles($request,NULL);
                $WorkFlowData    = $this->ModuleWorkFlow->ShowWorKFlowBYModuleCode(NULL,$ModuleCode);
                $WorkTransData   = $this->WorkFlowMovementDet->ShowWorkMovement(NULL,$IndentId,$ModuleCode);
                $LastWorkTransData       = $this->WorkFlowMovementDet->ShowLatestWorkMovement(NULL,$IndentId,$ModuleCode);
                $ProjectDetailsData      = $this->ProjectMaster->GetAllProjectData(NULL);
                $ProjectDetailsDataArray = collect($ProjectDetailsData)->pluck('project_name','project_id')->toArray();
                $GetMatCategoryData      = $this->MaterialgroupMaster->ShowMatCategoryAllParentChild();
                $ProcessTrancationData    = $this->IndentProcessMaster->GetIndentTranscationData($IndentId);
                return view('indent.indent-staus-view')->with('data',compact('ProcessTrancationData','IndentId','Empdata','EditIndentData','RoleData','WorkFlowData','WorkTransData','LastWorkTransData','ProjectDetailsDataArray'));
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message = "Error: Sorry, invalid attempt.";
            }
            if(filled($message)){
                Session::put('ALertMesage', $message);
                return redirect()->route('indent-staus-list');
            }
        }
        $ModuleCode      = 'INDENT';
        $Indentdata      = $this->Indent->ShowIndentDetails($request); 
        $Empdata         = $this->Employee->ShowEmployees($request,NULL); 
        $RoleData        = $this->EmpRole->ShowRoles($request,NULL);
        $MaxWorkMoveData = $this->WorkFlowMovementDet->ShowAllMaxWorkMovement($request,$ModuleCode);
        return view('indent.indent-staus-list')->with('data',compact('Indentdata','Empdata','RoleData','MaxWorkMoveData'));
    }
    public function SanctionApproval(Request $request){
        if(isset($request->ViewId)){
            if(isset($request->SubmitApplication)){
                $IndentId        = $request->txt_application_id;
                $Remarks         = $request->txt_action_remarks;
                DB::beginTransaction();
                try {   
                    $SaveData['transaction_id']       = $IndentId;
                    $SaveData['wf_module_code']       = 'INDENT';
                    $SaveData['wf_from_emp_no']       = session('WcmsEmpNo');
                    $SaveData['wf_from_role']         = session('WcmsEmpRoleId');
                    $SaveData['remarks']               = $Remarks;
                    $SaveData['status']               = 'process';
                    $SaveData['action_flag']          = 'IP';
                    $SaveData['active']               = 1;
                    $SaveData['created_at']           = NOW();
                    $SaveData['created_by']           = session('WcmsEmpNo');
                    $this->IndentProcessMaster->CreateProcessData($SaveData);
                    DB::commit();
                    $message = "Indent submitted successfully for processing.";
                    Session::put('ALertMesage', $message);
                    return redirect()->route('indent.approved-indent-sanction-list');
                }
                catch (\Exception $e) { dd($e);
                    DB::rollback();
                    $message = "Error : Sorry transaction not fully completed";
                    Session::put('ALertMesage', $message);
                }
            }    
            try{
                $IndentId                 = decrypt($request->ViewId);
                $GetIndentData            = $this->Indent->IndentApplicationData(NULL,$IndentId);
                $Empdata                  = $this->Employee->ShowEmployees($request,NULL); 
                $IndentDetails            = $this->Indent->IndentApplicationData(null,$IndentId);
                $ShowIndentDetials        = $this->IndentDetail->ShowIndentDetails(NULL,$IndentId);
                $AllObectHead             = $this->ObjectHead->ShowObjectHead(NULL);
                $AllObectHeadSubCata      = $this->ObjectHeadSubCategory->ShowObjectHeadSubCata(NULL);
                $ProjectDetailsData       = $this->ProjectMaster->GetAllProjectData(NULL);
                $ProjectDetailsDataArray  = collect($ProjectDetailsData)->pluck('project_name','project_id')->toArray();
                $MaterialTypeData         = $this->MaterialType->ShowMaterialType(NULL);
                $MaterialTypeDrtailsArray = collect($MaterialTypeData)->pluck('material_type_name','material_type_id')->toArray();
                $GetMatCategoryData       = $this->MaterialgroupMaster->ShowMatCategoryAllParentChild();
                $AllObectHeadDetails      = collect($AllObectHead)->pluck('object_head_name','object_head_id')->toArray();
                $AllObectHeadSubDetails   = collect($AllObectHeadSubCata)->pluck('oh_sub_cata_name','AllObectHeadSubCata')->toArray();
                $ProjectDataView          = $this->ProjectMaster->ShowAllParentChild();
                $EmpProjectDetails        = collect($ProjectDataView)->pluck('full_heads', 'project_id')->toArray() ?? [];
                $ShowMaterialUnit         = $this->UnitMaster->ShowMaterialUnit(NULL);
                $ShowMaterialUnit         = $this->UnitMaster->ShowMaterialUnit(NULL);
                return view('indent.indent-sanction-approval')->with('data',compact('EmpProjectDetails','ShowMaterialUnit','ShowIndentDetials','GetMatCategoryData','AllObectHeadSubDetails','AllObectHeadDetails','GetIndentData','Empdata','IndentDetails','ProjectDetailsDataArray','MaterialTypeDrtailsArray'));
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message = "Error: Sorry, invalid attempt.";
            }
            if(filled($message)){
                Session::put('ALertMesage', $message);
                return redirect()->route('indent-staus-list');
            }
        }
        $GetProcessData  = $this->IndentProcessMaster->GetIndentProceesData();
        $Indentdata      = $this->Indent->IndentApprovedData($request);
        $Empdata         = $this->Employee->ShowEmployees($request,NULL); 
        $Empdetails      = collect($Empdata)->pluck('emp_name_payslip','emp_no')->toArray();
        $GetProcessArray = collect($GetProcessData)->pluck('transaction_id')->toArray();
        return view('indent.approved-indent-sanction-list')->with('data',compact('Indentdata','Empdetails','GetProcessArray'));
    }
    public function SanctionDocumentUpload(Request $request){
         if(isset($request->ViewId)){
            if(isset($request->SubmitApplication)){
                $ButtonValue     = $request->SubmitApplication;
                $IndentId        = $request->txt_application_id;
                $Remarks         = $request->txt_action_remarks;
                if($request->hasfile('file_upload')){
                    $IsUpload = $this->IndentSanctionUpload($request);
                }
                if($IsUpload >0){
                    $message = "Indent sanction documents uploaded successfully.";
                    Session::put('ALertMesage', $message);
                    return redirect()->route('indent.sanction-document-upload');
                }else{
                    $message = "Failed to upload indent sanction documents.";
                    Session::put('ALertMesage', $message);
                    return redirect()->route('indent.sanction-document-upload');
                }
            }    
            try{
                $IndentId                 = decrypt($request->ViewId);
                $GetIndentData            = $this->Indent->IndentApplicationData(NULL,$IndentId);
                $Empdata                  = $this->Employee->ShowEmployees($request,NULL); 
                $IndentDetails            = $this->Indent->IndentApplicationData(null,$IndentId);
                $ShowIndentDetials        = $this->IndentDetail->ShowIndentDetails(NULL,$IndentId);
                $AllObectHead             = $this->ObjectHead->ShowObjectHead(NULL);
                $AllObectHeadSubCata      = $this->ObjectHeadSubCategory->ShowObjectHeadSubCata(NULL);
                $ProjectDetailsData       = $this->ProjectMaster->GetAllProjectData(NULL);
                $ProjectDetailsDataArray  = collect($ProjectDetailsData)->pluck('project_name','project_id')->toArray();
                $MaterialTypeData         = $this->MaterialType->ShowMaterialType(NULL);
                $MaterialTypeDrtailsArray = collect($MaterialTypeData)->pluck('material_type_name','material_type_id')->toArray();
                $GetMatCategoryData       = $this->MaterialgroupMaster->ShowMatCategoryAllParentChild();
                $AllObectHeadDetails      = collect($AllObectHead)->pluck('object_head_name','object_head_id')->toArray();
                $AllObectHeadSubDetails   = collect($AllObectHeadSubCata)->pluck('oh_sub_cata_name','AllObectHeadSubCata')->toArray();
                $ProjectDataView          = $this->ProjectMaster->ShowAllParentChild();
                $EmpProjectDetails        = collect($ProjectDataView)->pluck('full_heads', 'project_id')->toArray() ?? [];
                $ShowMaterialUnit         = $this->UnitMaster->ShowMaterialUnit(NULL);
                $ProcessTrancationData    = $this->IndentProcessMaster->GetIndentTranscationData($IndentId);
                $RoleData                 = $this->EmpRole->ShowRoles($request,NULL);
                $RoleDetails              = collect($RoleData)->pluck('role_name','roleid')->toArray();
                $EmpNameDetails           = collect($Empdata)->pluck('emp_name_payslip','emp_no')->toArray();
                $EmpDesigiDetails         = collect($Empdata)->pluck('designation_name','emp_no')->toArray();
                $SancationDocData         = $this->SupportingDocMaster->GetSancationDocData($IndentId,'INDENT');
                return view('indent.indent-sanction-upload')->with('data',compact('SancationDocData','EmpProjectDetails','RoleDetails','EmpNameDetails','EmpDesigiDetails','ProcessTrancationData','ShowMaterialUnit','ShowIndentDetials','GetMatCategoryData','AllObectHeadSubDetails','AllObectHeadDetails','GetIndentData','Empdata','IndentDetails','ProjectDetailsDataArray','MaterialTypeDrtailsArray'));
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message = "Error: Sorry, invalid attempt.";
            }
            if(filled($message)){
                Session::put('ALertMesage', $message);
                return redirect()->route('indent-staus-list');
            }
        }
        $GetProcessData  = $this->IndentProcessMaster->GetIndentProceesData();
        $Indentdata      = $this->Indent->IndentApprovedData($request);
        $Empdata         = $this->Employee->ShowEmployees($request,NULL); 
        $Empdetails      = collect($Empdata)->pluck('emp_name_payslip','emp_no')->toArray();
        $GetProcessArray = collect($GetProcessData)->pluck('transaction_id')->toArray();
        return view('indent.indent-sanction-upload-list')->with('data',compact('Indentdata','Empdetails','GetProcessArray'));
    }
    public function IndentStatusUpdate(Request $request){ 
        if(isset($request->ViewId)){
               if(isset($request->btn_save)){
                $IndentId        = $request->txt_application_id;
                $Remarks         = $request->txt_status_desc;
                $StatusDate      = $request->txt_status_upt_date;
                DB::beginTransaction();
                try {   
                    $SaveData['transaction_id']       = $IndentId;
                    $SaveData['wf_module_code']       = 'INDENT';
                    $SaveData['wf_from_emp_no']       = session('WcmsEmpNo');
                    $SaveData['wf_from_role']         = session('WcmsEmpRoleId');
                    $SaveData['remarks']              = $Remarks;
                    $SaveData['status']               = 'UP';
                    $SaveData['action_flag']          = 'SD';
                    $SaveData['active']               = 1;
                    $SaveData['created_at']           = NOW();
                    $SaveData['created_by']           = session('WcmsEmpNo');
                    $this->IndentProcessMaster->CreateProcessData($SaveData);
                    DB::commit();
                    $message = "Indent status details save successfully..!";
                    Session::put('ALertMesage', $message);
                    return redirect()->route('indent.approved-indent-status');
                }
                catch (\Exception $e) { dd($e);
                    DB::rollback();
                    $message = "Error : Sorry transaction not fully completed";
                    Session::put('ALertMesage', $message);
                }
            } 
            try{
                $IndentId                 = decrypt($request->ViewId);
                $GetIndentData            = $this->Indent->IndentApplicationData(NULL,$IndentId);
                $Empdata                  = $this->Employee->ShowEmployees($request,NULL); 
                $IndentDetails            = $this->Indent->IndentApplicationData(null,$IndentId);
                $ShowIndentDetials        = $this->IndentDetail->ShowIndentDetails(NULL,$IndentId);
                $AllObectHead             = $this->ObjectHead->ShowObjectHead(NULL);
                $AllObectHeadSubCata      = $this->ObjectHeadSubCategory->ShowObjectHeadSubCata(NULL);
                $ProjectDetailsData       = $this->ProjectMaster->GetAllProjectData(NULL);
                $ProjectDetailsDataArray  = collect($ProjectDetailsData)->pluck('project_name','project_id')->toArray();
                $MaterialTypeData         = $this->MaterialType->ShowMaterialType(NULL);
                $MaterialTypeDrtailsArray = collect($MaterialTypeData)->pluck('material_type_name','material_type_id')->toArray();
                $GetMatCategoryData       = $this->MaterialgroupMaster->ShowMatCategoryAllParentChild();
                $AllObectHeadDetails      = collect($AllObectHead)->pluck('object_head_name','object_head_id')->toArray();
                $AllObectHeadSubDetails   = collect($AllObectHeadSubCata)->pluck('oh_sub_cata_name','AllObectHeadSubCata')->toArray();
                $ProjectDataView          = $this->ProjectMaster->ShowAllParentChild();
                $EmpProjectDetails        = collect($ProjectDataView)->pluck('full_heads', 'project_id')->toArray() ?? [];
                $ShowMaterialUnit         = $this->UnitMaster->ShowMaterialUnit(NULL);
                $ProcessTrancationData    = $this->IndentProcessMaster->GetIndentTranscationData($IndentId);
                $RoleData                 = $this->EmpRole->ShowRoles($request,NULL);
                $RoleDetails              = collect($RoleData)->pluck('role_name','roleid')->toArray();
                $EmpNameDetails           = collect($Empdata)->pluck('emp_name_payslip','emp_no')->toArray();
                $EmpDesigiDetails         = collect($Empdata)->pluck('designation_name','emp_no')->toArray();
                $SancationDocData         = $this->SupportingDocMaster->GetSancationDocData($IndentId,'INDENT');
                $WorkTransData            = $this->WorkFlowMovementDet->ShowWorkMovement(NULL,$IndentId,'INDENT');
                return view('indent.indent-sanction-status-update')->with('data',compact('SancationDocData','WorkTransData','EmpProjectDetails','RoleDetails','EmpNameDetails','EmpDesigiDetails','ProcessTrancationData','ShowMaterialUnit','ShowIndentDetials','GetMatCategoryData','AllObectHeadSubDetails','AllObectHeadDetails','GetIndentData','Empdata','IndentDetails','ProjectDetailsDataArray','MaterialTypeDrtailsArray'));
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message = "Error: Sorry, invalid attempt.";
            }
            if(filled($message)){
                Session::put('ALertMesage', $message);
                return redirect()->route(' indent.approved-indent-status');
            }
        }
        $GetProcessData  = $this->IndentProcessMaster->GetIndentProceesData();
        $Indentdata      = $this->Indent->IndentApprovedData($request);
        $Empdata         = $this->Employee->ShowEmployees($request,NULL); 
        $Empdetails      = collect($Empdata)->pluck('emp_name_payslip','emp_no')->toArray();
        $GetProcessArray = collect($GetProcessData)->pluck('transaction_id')->toArray();
        return view('indent.indent-status-update-list')->with('data',compact('Indentdata','Empdetails','GetProcessArray'));
    }
    public function IndentAllStatus(Request $request) {
        if(isset($request->id)){
            try{
                $IndentId        = decrypt($request->id);
                $ModuleCode      = decrypt($request->modulecode);
                $Empdata         = $this->Employee->ShowEmployees($request,NULL); 
                $EditIndentData  = $this->Indent->ShowIndent(null,$IndentId);
                $RoleData        = $this->EmpRole->ShowRoles($request,NULL);
                $WorkFlowData    = $this->ModuleWorkFlow->ShowWorKFlowBYModuleCode(NULL,$ModuleCode);
                $WorkTransData   = $this->WorkFlowMovementDet->ShowWorkMovement(NULL,$IndentId,$ModuleCode);
                $LastWorkTransData       = $this->WorkFlowMovementDet->ShowLatestWorkMovement(NULL,$IndentId,$ModuleCode);
                $ProjectDetailsData      = $this->ProjectMaster->GetAllProjectData(NULL);
                $ProjectDetailsDataArray = collect($ProjectDetailsData)->pluck('project_name','project_id')->toArray();
                $FromPage                ='ALLSTATUSVIEW';//dd($FromPage);
                $ProcessTrancationData   = $this->IndentProcessMaster->GetIndentTranscationData($IndentId);
                return view('indent.indent-staus-view')->with('data',compact('IndentId','Empdata','ProcessTrancationData','EditIndentData','RoleData','WorkFlowData','WorkTransData','LastWorkTransData','ProjectDetailsDataArray','FromPage'));
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message = "Error: Sorry, invalid attempt.";
            }
            if(filled($message)){
                Session::put('ALertMesage', $message);
                return redirect()->route('indent-staus-list');
            }
        }
        $ModuleCode      = 'INDENT';
        $Indentdata      = $this->Indent->ShowIndentDetails($request); 
        $Empdata         = $this->Employee->ShowEmployees($request,NULL); 
        $RoleData        = $this->EmpRole->ShowRoles($request,NULL);
        $MaxWorkMoveData = $this->WorkFlowMovementDet->ShowAllMaxWorkMovement($request,$ModuleCode);
        return view('indent.indent-all-staus-list')->with('data',compact('Indentdata','Empdata','RoleData','MaxWorkMoveData'));
    }
    public function GetIndentData(Request $request){ 
        $IndentData         = $this->Indent->ShowIndent(NULL,$request->IndentId);
        $ShowIndentDetials  = $this->IndentDetail->ShowIndentDetails(NULL,$request->IndentId);
        $ShowMaterialUnit   = $this->UnitMaster->ShowMaterialUnit(NULL);
        $IndetCreateIcNo    = collect($IndentData)->pluck('emp_no')->first();
        $Empdata            = $this->Employee->ShowEmployees(NULL,$IndetCreateIcNo); 
        $OutputArr = array('IndentData' => $IndentData,'IndentDetailsData' => $ShowIndentDetials,'MaterialUnit' => $ShowMaterialUnit,'IndentCreateEmpData' =>$Empdata);
        return $OutputArr; 
    }
    public function GetIndentAjaxData(Request $request){
        if($request->IndentId){
            $ShowIndentDetials = $this->IndentDetail->ShowIndentDetails(NULL,$request->IndentId);
            $MaterialTypeData  = $this->MaterialType->ShowMaterialType(NULL);
            $ShowMaterialUnit  = $this->UnitMaster->ShowMaterialUnit(NULL);
            $OutputArr         = array('MaterialType' => $MaterialTypeData,'MaterialUnit' => $ShowMaterialUnit,'IndentDetails' => $ShowIndentDetials);
        }else{
            $MaterialTypeData = $this->MaterialType->ShowMaterialType(NULL);
            $ShowMaterialUnit = $this->UnitMaster->ShowMaterialUnit(NULL);
            $OutputArr        = array('MaterialType' => $MaterialTypeData,'MaterialUnit' => $ShowMaterialUnit);
        }
        return $OutputArr;
    }
    public function IndentsubmittedView(Request $request){
        $ShowIndentSubmittedData = $this->Indent->ShowIndentSubmittedData($request);
        $Empdata                 = $this->Employee->ShowEmployees($request,NULL); 
        return view('indent.indent-submitted-list')->with('data',compact('ShowIndentSubmittedData','Empdata'));
    }
    public function GetIndentConsumableData(Request $request){
        $OutputArr = [];
        $MaterialTypeId        = $request->MatTypeId;
        $ConsumablesItemsData  = $this->RcItemRateMaster->ShowConsumablesItemsData($request);
        $OutputArr             = array('ConsumablesData' => $ConsumablesItemsData);
        return $OutputArr;
    }
    public function SancationSupportingDoc(Request $request){
        $OutputArr        = [];
        $IndentId         = $request->IndentId;
        $SancationDocData = $this->SupportingDocMaster->GetSancationDocData($IndentId,'INDENT');
        if(isset($SancationDocData) && count($SancationDocData) > 0){
            foreach($SancationDocData as $item){
                $item->enc_sup_doc_id = encrypt($item->sup_doc_id);
            }
        }
        $OutputArr = array('SANCDOCDETAILS' => $SancationDocData);
        return $OutputArr;
    }
    public function GetObjectHeadData(Request $request){
        $OutputArr                   = [];
        $ProjectId                   = $request->ProjectId;
        $GetParentData               = $this->ProjectMaster->GetRootParent($ProjectId);
        $ParentProjId                = $GetParentData->project_id ?? null;
        $AllObectHead                = $this->ObjectHead->ShowObjectHead(NULL);
        $AllObectHeadSubCata         = $this->ObjectHeadSubCategory->ShowObjectHeadSubCata(NULL);
        $AllObectHeadSubCataGrpData  = filled($AllObectHeadSubCata) ? collect($AllObectHeadSubCata)->groupBy('object_head_id') : [];
        $ObjHeadGiaMappDetails       = $this->ObjHeadGiaMappingMaster->ShowObjectHeadDataByGiaIdAndProjId(NULL,$ParentProjId);
        $OutputArr                   = array('AllObjHeadData'=>$AllObectHead,'AllObjSubCatData'=>$AllObectHeadSubCata,'AllObjHeadSubCatGroupByData'=>$AllObectHeadSubCataGrpData,'ObjHeadGiaMappData'=>$ObjHeadGiaMappDetails);
        return $OutputArr;
    }
    
    public function GetBudgetSanctionByProject($ProjectId,$OHId,$OHSubCataId){
        $ProjBalanceAmt = NULL;
        $ProjBalanceAmt = NULL;
        if(filled($ProjectId) && $ProjectId != NULL){
            $GetParentData               = $this->ProjectMaster->GetRootParent($ProjectId);
            $ParentProjId                = $GetParentData->project_id ?? null;
            $ObjHeadGiaMappDetails       = $this->ObjHeadGiaMappingMaster->ShowObjectHeadDataByGiaIdAndProjId(NULL,$ParentProjId);
            $GetGiaId                    = collect($ObjHeadGiaMappDetails)->where('object_head_id',$OHId)->pluck('gia_id')->first();
            $GetAllocationData           = $this->BudgetAllocationMaster->GetSanctionAmoutByProjId($ProjectId);
            $GetProjAllocationIds        = collect($GetAllocationData)->when('oh_sub_cata_id',$OHSubCataId)->where('object_head_id',$OHId)->pluck('budget_allocation_id')->toArray();
            $SancationNo                 = collect($GetAllocationData)->when('oh_sub_cata_id',$OHSubCataId)->where('object_head_id',$OHId)->pluck('budget_allocation_id')->pluck('budget_sanction_no')->first();
            $GetAllocationClaimData      = $this->BudgetClaimMaster->GetClaimDataByAllocatedIds($GetProjAllocationIds,NULL);
            $GetAllClaimIds              = collect($GetAllocationClaimData)->pluck('budget_claimed_id')->toArray();
            $GetAllocationRecivedData    = $this->BudgetRecivedMaster->ShowBudegetReceivedByClaim($GetAllClaimIds);
            $TotalSanctionAmount         = $GetAllocationRecivedData->sum('received_amount') * 100000;
            $GetProjectExpDetaials       = $this->BudSanExpMaster->GetBudgetExpDataBYProjIds($ProjectId,$ParentProjId);
            // $ProjUptoUtilizedAmt         = collect($GetProjectExpDetaials)
            //     ->groupBy('transaction_id')
            //     ->sum(function ($records) {
            //         $stages = $records->keyBy('current_stage'); 
            //         return $stages['PO']->current_utilized_amt
            //             ?? $stages['IA']->current_utilized_amt
            //             ?? $stages['IE']->current_utilized_amt
            //             ?? $stages['IC']->current_utilized_amt
            //             ?? 0;
            //     });
            $ProjUptoUtilizedAmt   = collect($GetProjectExpDetaials)->where('is_current',true)->sum(function ($item) {return $item['current_utilized_amt'] ?? 0;});
            $ProjBalanceAmt        = $TotalSanctionAmount - $ProjUptoUtilizedAmt ?? '';
        }
        $FinYear                     = Helper::GetCurrentFinYear(NULL);
        $ObjHeadGiaMappDetails       = $this->ObjHeadGiaMappingMaster->ShowObjectHeadDataByGiaIdAndOHId($OHId);
        $GetGiaId                    = collect($ObjHeadGiaMappDetails)->where('object_head_id',$OHId)->pluck('gia_id')->first();
        $ShowBudgetSanaction         = $this->BudgetAllocationMaster->GetSanctionDetiails(NULL,$OHId,$OHSubCataId,$GetGiaId,$FinYear);
        $SancationNo                 = collect($ShowBudgetSanaction)->when('oh_sub_cata_id',$OHSubCataId)->where('object_head_id',$OHId)->pluck('budget_sanction_no')->first();
        $GetOHAllocationIds          = collect($ShowBudgetSanaction)->pluck('budget_allocation_id')->toArray();
        $GetOHAllocationClaimData    = $this->BudgetClaimMaster->GetClaimDataByAllocatedIds($GetOHAllocationIds,NULL);
        $GetAllOHClaimIds            = collect($GetOHAllocationClaimData)->pluck('budget_claimed_id')->toArray();
        $GetOHAllocationRecivedData  = $this->BudgetRecivedMaster->ShowBudegetReceivedByClaim($GetAllOHClaimIds);
        $GetOHRecivedAmt             = $GetOHAllocationRecivedData->sum('received_amount') * 100000 ?? '';
        $GetOHExpDetaials            = $this->BudSanExpMaster->GetBudgetExpDataBYOHIds($OHId,$OHSubCataId);
        $GetGiaData                  = $this->GiaMaster->ShowGia();
        $GiaName                     = collect($GetGiaData)->where('gia_id',$GetGiaId)->pluck('gia_name')->first();
        // $OHUptoUtilizedAmt           = collect($GetOHExpDetaials)
        //     ->groupBy('transaction_id')
        //     ->sum(function ($records) {
        //         $stages = $records->keyBy('current_stage'); 
        //         return $stages['PO']->current_utilized_amt
        //             ?? $stages['IA']->current_utilized_amt
        //             ?? $stages['IE']->current_utilized_amt
        //             ?? $stages['IC']->current_utilized_amt
        //             ?? 0;
        //     });
        $OHUptoUtilizedAmt = collect($GetOHExpDetaials)->where('is_current',true)->sum(function ($item) {return $item['current_utilized_amt'] ?? 0;});
        $OHBalanceAmt      = $GetOHRecivedAmt   - $OHUptoUtilizedAmt ?? '';

        $RetArr = [
            'SANCTIONNO'                  => $SancationNo ?? '',
            'TOTSANCTIONAMT'              => $TotalSanctionAmount ?? '',
            'UPTO_DATE_PROJ_UTILIZED_AMT' => $ProjUptoUtilizedAmt ?? '',
            'PROJ_BALANCE_AMT'            => $ProjBalanceAmt ?? '',
            'TOT_OH_SANCTION_AMT'         => $GetOHRecivedAmt ?? '',
            'UPTO_DATE_OH_UTILIZED_AMT'   => $OHUptoUtilizedAmt ?? '',
            'OH_BALANCE_AMT'              => $OHBalanceAmt ?? '',
            'GIA_NAME'                    => $GiaName ?? '',
        ];
        return $RetArr;
    }
    public function SaveIndentDetails(Request $request){
        $EmpNo         = $request->txt_emp_icno;
        $GroupId       = $request->txt_group;
        $DivId         = $request->txt_div;
        $SecId         = $request->txt_sec;
        $Supplier      = $request->txt_suggest_supplier;
        $PaymentTerm   = $request->txt_payment_term;
        $IndentNo      = $request->txt_intent_no;
        $IndentDate    = $request->txt_intent_date; 
        $IndentDesc    = $request->txt_intent_det;
        $IndentProName = $request->txt_project_name;
        $IndentSuffNo  = $request->hid_indent_suff_no;
        $IndentEditId  = $request->hid_indent_id;
        $IndentProjId  = $request->cmb_project_id;
        $IndentMatId   = $request->rad_indent_mat_type;
        $IndentTotalCost   = $request->txt_total_amout;
        $RegistKit         = $request->rad_regist_kit;
        $ObjHeadMode       = $request->obj_head_mode;
        $ObjHeadId         = $request->cmb_obj_head_id;
        $ObjSubProjId      = $request->obj_sub_proj_id;
        $MatCataId         = $request->cmb_mat_cat;
        DB::beginTransaction();
        try {
            $GroupId    = session('WcmsEmpGroup') ?? NULL;
            $DivisionId = session('EmpDivCode') ?? NULL;
            $SectionId  = session('EmpSecCode') ?? NULL;

            $SaveData['indent_no']            = $IndentNo;
            $SaveData['indent_date']          = Helper::DBDateFormat($IndentDate);
            $SaveData['project_head']         = null;
            $SaveData['emp_no']               = $EmpNo;
            $SaveData['group_id']             = $GroupId;
            $SaveData['div_id']               = $DivisionId;
            $SaveData['sec_id']               = $SectionId;
            $SaveData['indent_descripton']    = $IndentDesc;
            $SaveData['suggested_supplier']   = $Supplier;
            $SaveData['payment_term']         = $PaymentTerm;
            $SaveData['indent_pro_name']      = $IndentProName;
            $SaveData['indent_suffix_no']     = $IndentSuffNo;
            $SaveData['project_id']           = $IndentProjId;
            $SaveData['mat_type_id']          = $IndentMatId;
            $SaveData['total_estimated_cost'] = $IndentTotalCost;
            $SaveData['reg_kit']              = $RegistKit;
            $SaveData['object_head_id']       = $ObjHeadId;
            $SaveData['oh_sub_cata_id']       = $ObjSubProjId;
            $SaveData['mat_categ_id']         = $MatCataId;
            $SaveData['status']               = 'SU';
            $SaveData['active']               = 1;
            if(filled($IndentEditId)){
                $CurrentStage                     ='IC';
                $IndentId                         = $IndentEditId;
                $SaveData['updated_at']           = NOW();
                $SaveData['updated_by']           = session('WcmsEmpNo');
                $SaveIndent          = $this->Indent->UpdateIndent($SaveData,$IndentId);
                $DeleteIntentDetails = $this->IndentDetail->DeleteIntentDetails(NULL,$IndentId);
            }else{
                $CurrentStage ='IC';
                $SaveData['created_at']           = NOW();
                $SaveData['created_by']           = session('WcmsEmpNo');
                $SaveIndent = $this->Indent->CreateIndent($SaveData);
                $IndentId   = $SaveIndent->indent_id;
            }
            if ($IndentId) {
                $this->SaveBudgetExpenditureDetails($request, $IndentId,$CurrentStage,NULL,NULL);
            }
            $MaterialTypeIdArr     = $request->input('txt_material_type_id'); 
            $MaterialTypeArr       = $request->input('txt_material_type');
            $ServiceNameArr        = $request->input('txt_item_goods_service_name');
            $QuantityArr           = $request->input('txt_item_quantity_req_name');
            $EstimatedPriceArr     = $request->input('txt_item_estimate_no');
            $GSTRateArr            = $request->input('txt_item_gst_rate');
            $TotalCostArr          = $request->input('txt_item_total_cost');
            $ItemNoArr             = $request->input('txt_sno');
            $ItemUnitIdArr         = $request->input('txt_unit');
            $ItemTaxTypeArr        = $request->input('cmb_tax_type');
            $ItemAmoutArr          = $request->input('txt_item_amout');
            $RateContAmoutArr      = $request->input('txt_cont_item_rate');
            if(filled($QuantityArr)){
                foreach($QuantityArr as $MaterialTypeKey => $ConsValue){
                    //$MaterialTypeId      =  $MaterialTypeIdArr[$MaterialTypeKey];
                    $ServiceName         =  $ServiceNameArr[$MaterialTypeKey];
                    $Quanitity           =  $QuantityArr[$MaterialTypeKey];
                    $EstimatedPrice      =  $EstimatedPriceArr[$MaterialTypeKey];
                    //$GSTRate             =  $GSTRateArr[$MaterialTypeKey];
                    $TotalCost           =  $TotalCostArr[$MaterialTypeKey];
                    $ItemNo              =  $ItemNoArr[$MaterialTypeKey];
                    $ItemUnitId          =  $ItemUnitIdArr[$MaterialTypeKey];
                    $ItemTaxType         =  $ItemTaxTypeArr[$MaterialTypeKey];
                    $ItemAmout           =  $ItemAmoutArr[$MaterialTypeKey];
                   // $RatContAmout        =  $RateContAmoutArr[$MaterialTypeKey];
                    $SaveDtData['indent_id']            = $IndentId;
                    $SaveDtData['tax_type']             = $ItemTaxType;
                    $SaveDtData['unit_id']              = $ItemUnitId;
                    $SaveDtData['item_no']              = $ItemNo;
                    //$SaveDtData['material_type_id']     = $MaterialTypeId;
                    $SaveDtData['item_description']     = $ServiceName;
                    $SaveDtData['quantity']             = $Quanitity;
                    $SaveDtData['estimated_unit_price'] = $EstimatedPrice;
                    //$SaveDtData['gst_rate']             = $GSTRate;
                    $SaveDtData['item_amount']          = $ItemAmout;
                    $SaveDtData['gst_price']            = null;
                    $SaveDtData['gst_mode']             = null;
                    $SaveDtData['total_cost']           = $TotalCost;
                   // $SaveDtData['rate_cont_amt']        = $RatContAmout;
                    $SaveDtData['active']               = 1;
                    $SaveDtData['created_at']           = NOW();
                    $SaveDtData['created_by']           = session('WcmsEmpNo');
                    $SaveIndent = $this->IndentDetail->CreateIndentDetail($SaveDtData);
                }
            }
            DB::commit();
            $message = "Indent Details Saved ";
            Session::put('ALertMesage', $message);
        }
        catch (\Exception $e) { dd($e);
            DB::rollback();
            $message = "Error : Sorry transaction not fully completed";
            Session::put('ALertMesage', $message);
        }
        if(filled($IndentEditId)){
            $message   = 'Indent Details Update ';
            return redirect()->route('indent.indent-view')->with('ALertMesage', $message);
        }else{
            $message   = 'Indent Details Saved ';
            return redirect()->route('indent.indent-creation')->with('ALertMesage', $message);
        }
    }
    public function ConsumableIndentDetailsSave(Request $request){
        DB::beginTransaction();
        try {
            $IndentId              = decrypt($request->txt_application_id);
            $IndentTotalAmt        = $request->input('hidd_total_amt');
            $ItemNoArr             = $request->input('txt_sno');
            $ServiceNameArr        = $request->input('txt_item_goods_service_name');
            $QuantityArr           = $request->input('txt_item_quantity_req_name');
            $ItemUnitIdArr         = $request->input('txt_unit');
            $EstimatedPriceArr     = $request->input('txt_item_estimate_no');
            $ContRateAmoutArr      = $request->input('txt_cont_item_rate');
            $ItemAmoutArr          = $request->input('txt_item_amout');
            $ItemTaxTypeArr        = $request->input('cmb_tax_type');
            $TotalCostArr          = $request->input('txt_item_total_cost');
            if(filled($IndentId)){
                if(filled($IndentTotalAmt)){
                    $UpdateArr['total_estimated_cost'] = $IndentTotalAmt;
                    $SaveIndent   = $this->Indent->UpdateIndent($UpdateArr,$IndentId);
                }
                $DeleteIntentDetails = $this->IndentDetail->DeleteIntentDetails(NULL,$IndentId);
            }
            if(filled($QuantityArr)){
                foreach($QuantityArr as $ConsKey => $ConsValue){
                    $SaveDtData          = [];
                    $ItemNo              =  $ItemNoArr[$ConsKey];
                    $ServiceName         =  $ServiceNameArr[$ConsKey];
                    $Quanitity           =  $QuantityArr[$ConsKey];
                    $ItemUnitId          =  $ItemUnitIdArr[$ConsKey];
                    $EstimatedPrice      =  $EstimatedPriceArr[$ConsKey];
                    $ContRateAmout       =  $ContRateAmoutArr[$ConsKey];
                    $ItemAmout           =  $ItemAmoutArr[$ConsKey];
                    $ItemTaxType         =  $ItemTaxTypeArr[$ConsKey];
                    $TotalCost           =  $TotalCostArr[$ConsKey];
                    $SaveDtData['indent_id']            = $IndentId;
                    $SaveDtData['tax_type']             = $ItemTaxType;
                    $SaveDtData['unit_id']              = $ItemUnitId;
                    $SaveDtData['item_no']              = $ItemNo;
                    $SaveDtData['item_description']     = $ServiceName;
                    $SaveDtData['quantity']             = $Quanitity;
                    $SaveDtData['estimated_unit_price'] = $EstimatedPrice;
                    $SaveDtData['item_amount']          = $ItemAmout;
                    $SaveDtData['total_cost']           = $ItemAmout;
                    $SaveDtData['gst_price']            = null;
                    $SaveDtData['gst_mode']             = null;
                    $SaveDtData['total_cost']           = $TotalCost;
                    $SaveDtData['rate_cont_amt']        = $ContRateAmout;
                    $SaveDtData['active']               = 1;
                    $SaveDtData['created_at']           = NOW();
                    $SaveDtData['created_by']           = session('WcmsEmpNo');
                    $SaveIndent = $this->IndentDetail->CreateIndentDetail($SaveDtData);
                }
            }
            DB::commit();
            return true;
        }
        catch (\Exception $e) { dd($e);
            DB::rollback();
            return false;
        }
    }
    public function SaveBudgetExpenditureDetails($request,$TransactionId,$CurrentStage,$FromPage,$TotaIndentCost){ 
        $ParentProjId        = NULL ;
        $ProjUptoUtilizedAmt = NULL;
        $ProjBalanceAmt      = NULL;
        DB::beginTransaction();
        try {
            if($FromPage == 'WRKFLOW'){
                $ModuleCode            = 'INDENT';
                $GetExpData            = $this->BudSanExpMaster->ShowBudgetExpData($TransactionId,$ModuleCode);
             // $IndetBudGetExpDetails = collect($GetExpData)->where('current_stage', ($CurrentStage == 'IE') ? 'IE' : 'IC')->first();
                $IndetBudGetExpDetails = collect($GetExpData)->where('is_current',true)->first();
                $GetSancationId        = $IndetBudGetExpDetails->budget_sanction_id ?? NULL;
                $GetGiaId              = $IndetBudGetExpDetails->gia_id ?? NULL;
                $IndentProjId          = $IndetBudGetExpDetails->project_id ?? NULL;
                $ParentProjId          = $IndetBudGetExpDetails->project_parent_id ?? NULL;
                $ObjHeadId             = $IndetBudGetExpDetails->object_head_id ?? NULL;
                $ObjSubCatId           = $IndetBudGetExpDetails->oh_sub_cata_id ?? NULL;
                $ProjUptoUtilizedAmt   = $IndetBudGetExpDetails->proj_upto_dt_utilized_amt ?? NULL;
                $ProjBalanceAmt        = $IndetBudGetExpDetails->proj_balance_amt ?? NULL;
                $OHUptoUtilizedAmt     = $IndetBudGetExpDetails->oh_upto_dt_utilized_amt ?? NULL;
                $OHBalanceAmt          = $IndetBudGetExpDetails->oh_balance_amt ?? NULL;
                $IndentTotalCost       = $TotaIndentCost ?? '';
            }else{
                $IndentProjId        = $request->cmb_project_id;
                $IndentTotalCost     = $request->txt_total_amout;
                $ObjHeadMode         = $request->obj_head_mode;
                $ObjHeadId           = $request->cmb_obj_head_id;
                $ObjSubCatId         = $request->obj_sub_proj_id;
                // $GetParentData               = $this->ProjectMaster->GetRootParent($IndentProjId);
                // $ParentProjId                = $GetParentData->project_id ?? null;
                // $ObjHeadGiaMappDetails       = $this->ObjHeadGiaMappingMaster->ShowObjectHeadDataByGiaIdAndProjId(NULL,$ParentProjId);
                // $GetGiaId                    = collect($ObjHeadGiaMappDetails)->pluck('gia_id')->first();
                // $ShowBudgetSanaction         = $this->BudgetAllocationMaster->GetSanctionDetiails($ObjHeadMode,$ObjHeadId,$ObjSubCatId,$GetGiaId);
                // $GetSancationId              = collect($ShowBudgetSanaction)->pluck('budget_allocation_id')->first();
                /// FOR PROJECT WISE ALLOCATION RECIVED DETAILS ///
                if(filled($IndentProjId) && $IndentProjId !=Null){ 
                    $GetParentData               = $this->ProjectMaster->GetRootParent($IndentProjId);
                    $ParentProjId                = $GetParentData->project_id ?? null;
                    $ObjHeadGiaMappDetails       = $this->ObjHeadGiaMappingMaster->ShowObjectHeadDataByGiaIdAndProjId(NULL,$ParentProjId);
                    $GetAllocationData           = $this->BudgetAllocationMaster->GetSanctionAmoutByProjId($IndentProjId);
                    $GetProjAllocationIds        = collect($GetAllocationData)->pluck('budget_allocation_id')->toArray();
                    $GetAllocationClaimData      = $this->BudgetClaimMaster->GetClaimDataByAllocatedIds($GetProjAllocationIds,NULL);
                    $GetAllClaimIds              = collect($GetAllocationClaimData)->pluck('budget_claimed_id')->toArray();
                    $GetAllocationRecivedData    = $this->BudgetRecivedMaster->ShowBudegetReceivedByClaim($GetAllClaimIds);
                    $GetProjRecivedAmt           = $GetAllocationRecivedData->sum('received_amount') ?? '';
                }else{
                    $ObjHeadGiaMappDetails = $this->ObjHeadGiaMappingMaster->ShowObjectHeadDataByGiaIdAndOHId($ObjHeadId);
                    
                }
                $FinYear                     = Helper::GetCurrentFinYear(NULL);
                $GetGiaId                    = collect($ObjHeadGiaMappDetails)->pluck('gia_id')->first();
                $ShowBudgetSanaction         = $this->BudgetAllocationMaster->GetSanctionDetiails($ObjHeadMode,$ObjHeadId,$ObjSubCatId,$GetGiaId,$FinYear);
                $GetSancationId              = collect($ShowBudgetSanaction)->pluck('budget_allocation_id')->first();
                // GET BY OBJECT HEAD //
                $GetOHAllocationIds          = collect($ShowBudgetSanaction)->pluck('budget_allocation_id')->toArray();
                $GetOHAllocationClaimData    = $this->BudgetClaimMaster->GetClaimDataByAllocatedIds($GetOHAllocationIds,NULL);
                $GetAllOHClaimIds            = collect($GetOHAllocationClaimData)->pluck('budget_claimed_id')->toArray();
                $GetOHAllocationRecivedData  = $this->BudgetRecivedMaster->ShowBudegetReceivedByClaim($GetAllOHClaimIds);
                $GetOHRecivedAmt             = $GetOHAllocationRecivedData->sum('received_amount') * 100000 ?? '';
                //USED EXPENDITURE DETAILS///
                if(filled($IndentProjId) && filled($ParentProjId)){
                    $GetProjectExpDetaials = $this->BudSanExpMaster->GetBudgetExpDataBYProjIds($IndentProjId,$ParentProjId);
                    $ProjUptoUtilizedAmt   = collect($GetProjectExpDetaials)->where('is_current',true)->sum(function ($item) {return $item['current_utilized_amt'] ?? 0;});
                    // $ProjUptoUtilizedAmt   = collect($GetProjectExpDetaials)
                    // ->groupBy('transaction_id')
                    // ->sum(function ($records) {
                    //     $stages = $records->keyBy('current_stage'); 
                    //     return $stages['PO']->current_utilized_amt
                    //         ?? $stages['IA']->current_utilized_amt
                    //         ?? $stages['IE']->current_utilized_amt
                    //         ?? $stages['IC']->current_utilized_amt
                    //         ?? 0;
                    // });
                $ProjBalanceAmt = $GetProjRecivedAmt - $ProjUptoUtilizedAmt ?? '';
                }
                if($ObjHeadMode == 'OHSC'){
                    $GetOHExpDetaials = $this->BudSanExpMaster->GetBudgetExpDataBYOHIds($ObjHeadId,$ObjSubCatId);
                }else{
                    $GetOHExpDetaials = $this->BudSanExpMaster->GetBudgetExpDataBYOHIds($ObjHeadId,NULL);
                }
                $OHUptoUtilizedAmt = collect($GetOHExpDetaials)->where('is_current',true)->sum(function ($item) {return $item['current_utilized_amt'] ?? 0;});
                // $OHUptoUtilizedAmt   = collect($GetOHExpDetaials)
                //     ->groupBy('transaction_id')
                //     ->sum(function ($records) {
                //         $stages = $records->keyBy('current_stage'); 
                //         return $stages['PO']->current_utilized_amt
                //             ?? $stages['IA']->current_utilized_amt
                //             ?? $stages['IE']->current_utilized_amt
                //             ?? $stages['IC']->current_utilized_amt
                //             ?? 0;
                //     });
                $OHBalanceAmt   = $GetOHRecivedAmt   - $OHUptoUtilizedAmt ?? '';
            }
            $SaveData['transaction_id']       = $TransactionId;
            $SaveData['budget_sanction_id']   = $GetSancationId;
            $SaveData['current_stage']        = $CurrentStage;
            $SaveData['module_code']          = 'INDENT';
            $SaveData['gia_id']               = $GetGiaId;
            $SaveData['project_id']           = $IndentProjId;
            $SaveData['project_parent_id']    = $ParentProjId;
            $SaveData['object_head_id']       = $ObjHeadId;
            $SaveData['oh_sub_cata_id']       = $ObjSubCatId;
            $SaveData['budget_allocation_id']      = $GetSancationId;
            $SaveData['proj_upto_dt_utilized_amt'] = $ProjUptoUtilizedAmt;
            $SaveData['proj_balance_amt']          = $ProjBalanceAmt;
            $SaveData['oh_upto_dt_utilized_amt']   = $OHUptoUtilizedAmt;
            $SaveData['oh_balance_amt']            = $OHBalanceAmt;
            $SaveData['current_utilized_amt']      = $IndentTotalCost;
            $SaveData['is_current']                = true;
            $SaveData['active']                    = 1;
            $SaveData['created_at']                = NOW();
            $SaveData['created_by']                = session('WcmsEmpNo');//dd($SaveData);
            $this->BudSanExpMaster->DeleteBudgetExp($TransactionId,'INDENT');
            $this->BudSanExpMaster->BudgetExpDetatilsCreate($SaveData);
            DB::commit();
            // $message = "Indent Details Saved ";
            // Session::put('ALertMesage', $message);
        }
        catch (\Exception $e) { dd($e);
            DB::rollback();
            $message = "Error : Sorry transaction not fully completed";
            Session::put('ALertMesage', $message);
        }
    }
    public function IndentSanctionUpload (Request $request){
        $TransactionId  = $request->input('txt_application_id');
        $InvoiceFile    = $request->file('file_upload');
        $DocSuppDescArr = $request->input('txt_supp_doc_desc');
        $UploadExe      = 0;
        $validator      = Validator::make(
            $request->all(),
            [
                'file_upload' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',// max:2048 specifies the maximum size in kilobytes (2MB)
            ],
            [
                'file_upload.required' => 'Error: Please select file to upload.',
                'file_upload.file'     => 'Error: The upload must be a valid file.',
                'file_upload.mimes'    => 'Error: Only JPG, PNG, and PDF files are allowed.',
                'file_upload.max'      => 'Error: The  size must not exceed 2MB.',
            ]
        );
        if($validator->fails()) { 
            $message = $validator->errors()->first(); 
            Session::put('ALertMesage', $message); 
        }
        DB::beginTransaction();
        try {
            if($request->hasFile('file_upload')){
                $InvoiceFiles = $request->file('file_upload');
                foreach($InvoiceFiles as $FileKey => $InvoiceFile){
                    $DocDesc       =  $DocSuppDescArr[$FileKey];
                    $OrgFileName   = $InvoiceFile->getClientOriginalName();
                    $Extension     = $InvoiceFile->getClientOriginalExtension();
                    $UploadTimeStr = date("YmdHis").$FileKey;
                    $FileName      = "INDENT_SANC_SUPP_doc_".$UploadTimeStr.".".$Extension;
                    try {
                        $IsUpload = Helper::UploadFile($InvoiceFile,$FileName,'INDENT','SUPDOC');
                    } catch (\Exception $e) {

                        $IsUpload = 'UE';
                    }
                    if($IsUpload == "Y"){
                        $SaveData['transaction_id']       = $TransactionId;
                        $SaveData['module_code']          = 'INDENT';
                        $SaveData['doc_desc']             = $DocDesc;
                        $SaveData['org_file_name']        = $OrgFileName;
                        $SaveData['file_name']            = $FileName;
                        $SaveData['active']               = 1;
                        $SaveData['created_at']           = NOW();
                        $SaveData['created_by']           = session('WcmsEmpNo');
                        $this->SupportingDocMaster->SupportingDocCreate($SaveData);
                        $UploadExe++;
                    }
                }
            }
        DB::commit();
        }
        catch (\Exception $e) { dd($e);
            DB::rollback();
            $message = "Error : Sorry transaction not fully completed";
            Session::put('ALertMesage', $message);
        }
        return $UploadExe;
    }
    public function DownloadFile(Request $request){
        $FileName       = NULL;          		    
        $DocSupId       = decrypt($request->id);
        $ModuleCode     = $request->module_code;
        $ModuleSubCode  = $request->module_sub_code;
        $ShowDocFiles = $this->SupportingDocMaster->GetSuppDocDownloadData($DocSupId,$ModuleCode);
        if(count($ShowDocFiles) > 0){
            $FileName = collect($ShowDocFiles)->pluck('file_name')->first();
        }
        if($FileName != NULL){
            $IsDownload = Helper::DownloadFile($FileName,$ModuleCode,$ModuleSubCode);
        }
        if($IsDownload != "Y"){
            DB::rollback();
            $message = "Error : Unable to download, please try again..!!";
            Session::put('ALertMesage', $message);
        }
    }
}
