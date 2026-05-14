<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\modules;
use App\Models\Role;
use App\Models\UserWorkLoad;
use App\Models\work_flow_modules;
use App\Models\AgmOffice;
use Helper;
use DB;
use Session;

class WorkFlowController extends Controller
{
    public function __construct(){
        $this->Office = new AgmOffice();
        $this->workflowmodules = new work_flow_modules();
    }
    public function ModuleWorkFLow(Request $request)
    {
        $data = NULL; $message = NULL;  
        $WfModule = new work_flow_modules(); 
        $ModuleData = $WfModule->ShowWorkFlowModules($request,NULL);  
        $Role = new Role();
        if (session('WcmsRoleGroupCode') == 'ACCADMUSER') {
            $RoleData = $Role->ShowRoles($request,NULL)->where('role_group_code', 'ACCUSER');
        }else if (session('WcmsRoleGroupCode') == 'SUPUSER' || session('WcmsRoleGroupCode') == 'ADMUSER') {
            $RoleData = $Role->ShowRoles($request,NULL);
        }else{
            $RoleData = NULL;
        }
        $ModTrans = new UserWorkLoad(); 
        if(isset($request->btn_save)){ 
            if($request->input('btn_save') == "Save"){
                $DivisionId     = $request->input('cmb_division');
                $ModuleId       = $request->input('cmb_module');
                $StartRangeArr  = $request->input('txt_start_range');
                $EndRangeArr    = $request->input('txt_end_range');
                $ApprAuthArr    = $request->input('cmb_appr_auth');
                $MappedRoleArr  = $request->input('txt_mapped_role');
                $ModTransIdArr  = $request->input('txt_mod_trans_id');
                $InitRoleIdArr  = $request->input('cmb_init_role');
                $BillTypeArr    = $request->input('bill_type');
                $BudgetTypeArr  = $request->input('budget_type');
                $ModuleCodeData = $WfModule->ShowWorkFlowModulesByModuleId($ModuleId); 
                if(($ModuleCodeData != NULL)&&(count($ModuleCodeData) > 0)){
                    $ModuleCode = collect($ModuleCodeData)->pluck('wf_module_code')->first();
                }else{
                    $ModuleCode = NULL;
                }
                $ModTransData = $ModTrans->GetModuleRoleData($request,$ModuleCode,NULL); 
                $ModuleTranIdArr = $ModTransData->where('division_code',$DivisionId)->pluck('work_load_id')->toArray();
                $DelModTransArr = array_diff($ModuleTranIdArr,$ModTransIdArr);
                if($MappedRoleArr != NULL){
                    if(count($MappedRoleArr) > 0){
                        foreach($MappedRoleArr as $RoleMapKey => $RoleMapValue){
                            $ModTransId = $ModTransIdArr[$RoleMapKey];
                            $SaveDataArr = array();
                            $SaveDataArr['division_code'] = $DivisionId;
                            $SaveDataArr['wf_moduleid'] = $ModuleId;
                            $SaveDataArr['start_range'] = $StartRangeArr[$RoleMapKey];
                            $SaveDataArr['end_range'] = $EndRangeArr[$RoleMapKey];
                            $SaveDataArr['appr_auth'] = $ApprAuthArr[$RoleMapKey];
                            $SaveDataArr['target_roles'] = $MappedRoleArr[$RoleMapKey];
                            $SaveDataArr['initiate_role'] = $InitRoleIdArr[$RoleMapKey];
                            $SaveDataArr['active'] = 1;
                            $SaveDataArr['created_by'] = session('WcmsEmpNo');
                            $SaveDataArr['created_at'] = NOW();
                            $SaveDataArr['wf_module_code'] = $ModuleCode;
                            $BillType = $BillTypeArr[$RoleMapKey];
                            if($BillType == ""){
                                $BillType = NULL;
                            }
                            $BudgetType = $BudgetTypeArr[$RoleMapKey];
                            if($BudgetType == ""){
                                $BudgetType = NULL;
                            }
                            if($BudgetType == "NA"){
                                $BudgetType = NULL;
                            }
                            $SaveDataArr['bill_type'] = $BillType;
                            $SaveDataArr['budget_type'] = $BudgetType;
                            if(in_array($ModTransId, $ModuleTranIdArr)){
                                $ModTrans->UpdateModuleRoles($SaveDataArr,$ModTransId);
                                if($ModTrans == true){
                                    $LogMessage = "ModuleController || Work Flow Module Updated Sucessfully )";
                                    Helper::CreateLog($request,$LogMessage);                       
                                    $message = ("Work Flow Module Updated Sucessfully!");
                                }
                            }else{
                                $ModTrans->SaveModuleRoles($SaveDataArr);
                                if($ModTrans == true){
                                    $LogMessage = "ModuleController || Work Flow Module Saved Sucessfully )";
                                    Helper::CreateLog($request,$LogMessage);                       
                                    $message = ("Work Flow Module Saved Sucessfully!");
                                }
                            }
                        }
                    }
                }
                if($DelModTransArr != NULL){
                    if(count($DelModTransArr) > 0){
                        foreach($DelModTransArr as $DelKey => $DelValue){
                            $ModTrans->DeleteModuleRoles($DelValue);
                        }
                    }
                }
            }
        }
        $OfficeList = $this->Office->ShowOfficeWithType('D',NULL);
        return view('workflow.ModuleWorkFlow')->with('data',compact('ModuleData','RoleData','OfficeList'))->with('ALertMesage',$message);
    }
    public function ModuleWorkFlowSectionWise(Request $request)
    {
        $data = NULL; $message = NULL;  
        $WfModule = new work_flow_modules(); 
        $ModuleData = $WfModule->ShowWorkFlowModules($request,NULL);  
        $Role = new Role();
        if (session('WcmsRoleGroupCode') == 'ACCADMUSER') {
            $RoleData = $Role->ShowRoles($request,NULL)->where('role_group_code', 'ACCUSER');
        }else if (session('WcmsRoleGroupCode') == 'SUPUSER' || session('WcmsRoleGroupCode') == 'ADMUSER') {
            $RoleData = $Role->ShowRoles($request,NULL);
        }else{
            $RoleData = NULL;
        }
        $ModTrans = new UserWorkLoad(); 
        if(isset($request->btn_save)){ 
            if($request->input('btn_save') == "Save"){
                $DivisionId     = $request->input('cmb_division');
                $SectionId      = $request->input('cmb_section');
                $SubSectionId   = $request->input('cmb_sub_section');
                $ModuleId       = $request->input('cmb_module');
                $StartRangeArr  = $request->input('txt_start_range');
                $EndRangeArr    = $request->input('txt_end_range');
                $ApprAuthArr    = $request->input('cmb_appr_auth');
                $MappedRoleArr  = $request->input('txt_mapped_role');
                $ModTransIdArr  = $request->input('txt_mod_trans_id');
                $InitRoleIdArr  = $request->input('cmb_init_role');
                $BillTypeArr    = $request->input('bill_type');
                $BudgetTypeArr  = $request->input('budget_type');
                $ModuleCodeData = $WfModule->ShowWorkFlowModulesByModuleId($ModuleId); 
                if(($ModuleCodeData != NULL)&&(count($ModuleCodeData) > 0)){
                    $ModuleCode = collect($ModuleCodeData)->pluck('wf_module_code')->first();
                }else{
                    $ModuleCode = NULL;
                }
                $ModTransData = $ModTrans->GetModuleRoleData($request,$ModuleCode,NULL); 
                $ModuleTranIdArr = $ModTransData->where('division_code',$DivisionId)->where('section_code',$SectionId)->where('sub_section_code',$SubSectionId)->pluck('work_load_id')->toArray();
                $DelModTransArr = array_diff($ModuleTranIdArr,$ModTransIdArr);
                if($MappedRoleArr != NULL){
                    if(count($MappedRoleArr) > 0){
                        foreach($MappedRoleArr as $RoleMapKey => $RoleMapValue){
                            $ModTransId = $ModTransIdArr[$RoleMapKey];
                            $SaveDataArr = array();
                            $SaveDataArr['division_code'] = $DivisionId;
                            $SaveDataArr['section_code'] = $SectionId;
                            $SaveDataArr['sub_section_code'] = $SubSectionId;
                            $SaveDataArr['wf_moduleid'] = $ModuleId;
                            $SaveDataArr['start_range'] = $StartRangeArr[$RoleMapKey];
                            $SaveDataArr['end_range'] = $EndRangeArr[$RoleMapKey];
                            $SaveDataArr['appr_auth'] = $ApprAuthArr[$RoleMapKey];
                            $SaveDataArr['target_roles'] = $MappedRoleArr[$RoleMapKey];
                            $SaveDataArr['initiate_role'] = $InitRoleIdArr[$RoleMapKey];
                            $SaveDataArr['active'] = 1;
                            $SaveDataArr['created_by'] = session('WcmsEmpNo');
                            $SaveDataArr['created_at'] = NOW();
                            $SaveDataArr['wf_module_code'] = $ModuleCode;
                            $BillType = $BillTypeArr[$RoleMapKey];
                            if($BillType == ""){
                                $BillType = NULL;
                            }
                            $BudgetType = $BudgetTypeArr[$RoleMapKey];
                            if($BudgetType == ""){
                                $BudgetType = NULL;
                            }
                            if($BudgetType == "NA"){
                                $BudgetType = NULL;
                            }
                            $SaveDataArr['bill_type'] = $BillType;
                            $SaveDataArr['budget_type'] = $BudgetType;
                            if(in_array($ModTransId, $ModuleTranIdArr)){
                                $ModTrans->UpdateModuleRoles($SaveDataArr,$ModTransId);
                                if($ModTrans == true){
                                    $LogMessage = "ModuleController || Work Flow Module Updated Sucessfully )";
                                    Helper::CreateLog($request,$LogMessage);                       
                                    $message = ("Work Flow Module Updated Sucessfully!");
                                }
                            }else{
                                $ModTrans->SaveModuleRoles($SaveDataArr);
                                if($ModTrans == true){
                                    $LogMessage = "ModuleController || Work Flow Module Saved Sucessfully )";
                                    Helper::CreateLog($request,$LogMessage);                       
                                    $message = ("Work Flow Module Saved Sucessfully!");
                                }
                            }
                        }
                    }
                }
                if($DelModTransArr != NULL){
                    if(count($DelModTransArr) > 0){
                        foreach($DelModTransArr as $DelKey => $DelValue){
                            $ModTrans->DeleteModuleRoles($DelValue);
                        }
                    }
                }
            }
        }
        $OfficeList = $this->Office->ShowOfficeWithType('D',NULL);
        return view('workflow.ModuleWorkFlowSectionWise')->with('data',compact('ModuleData','RoleData','OfficeList'))->with('ALertMesage',$message);
    }
    
    public function WorkFlowModuleEdit(Request $request){
        $data = NULL; $message = NULL;  
        $WfModule = new work_flow_modules(); 
        $ModuleData = $WfModule->ShowWorkFlowModules($request,NULL);  
        $Role = new Role();
        if (session('WcmsRoleGroupCode') == 'ADMUSER') {
            $RoleData = $Role->ShowRoles($request,NULL)->where('role_group_code', 'ENDUSER');
        }else if (session('WcmsRoleGroupCode') == 'ACCADMUSER') {
            $RoleData = $Role->ShowRoles($request,NULL)->where('role_group_code', 'ACCUSER');
        }else if (session('WcmsRoleGroupCode') == 'SUPUSER') {
            $RoleData = $Role->ShowRoles($request,NULL);
        }else{
            $RoleData = NULL;
        }
        $ModTrans = new UserWorkLoad(); 
        $OfficeList = $this->Office->ShowOfficeWithType('D',NULL);
        return view('workflow.EditWorkFlowModule')->with('data',compact('ModuleData','RoleData','OfficeList'))->with('ALertMesage',$message);;
    }
    public function SaveEditModuleWorkFlow(Request $request) {
        $WfModuleArr = array(); $UpdateWfModuleData = NULL;
        $message = "No valid request data found."; // Default message
        $Id = $request->WorkLoadId;
        $ModuleName = $request->ModuleName;
        if ($Id != NULL) {
            $StartRange = $request->StartRange;
            $EndRange = $request->EndRange;
            $ApprAuthRole = $request->ApprAuthId;
            $InitRole = $request->InitRoleId;
            $TargetRoles = $request->TargetRoleId;
            $BudgetType = $request->BudgType;
            $BillType = $request->BillType;
            $WfModuleArr['start_range'] = $StartRange;
            $WfModuleArr['end_range'] = $EndRange;
            $WfModuleArr['appr_auth'] = $ApprAuthRole;
            $WfModuleArr['initiate_role'] = $InitRole;
            $WfModuleArr['target_roles'] = $TargetRoles; 
            if($ModuleName == "TS" || $ModuleName == "RTS"){
                $WfModuleArr['budget_type'] = $BudgetType;
            }
            else if($ModuleName == "BILLV"){
                $WfModuleArr['bill_type'] = $BillType;
            }
            $ModTrans = new UserWorkLoad(); 
            $UpdateWfModuleData = $ModTrans->UpdateModuleRoles($WfModuleArr, $Id);    
            if($UpdateWfModuleData != NULL) {
                Helper::CreateLog($request, "ModuleController || Work Flow Updated ");
                $message = "Work Flow Updated !";
            }else{
                $message = "Failed to update workflow.";
            }
        }
        return response()->json(['message' => $message]);
    }
    public function SaveEditModuleTargetRoles(Request $request){
        $WfModuleArr = array();
        $message = "No valid request data found."; // Default message
        $Id = $request->WfLoadId;
        if ($Id != NULL) {
            $TargetRoles = $request->TargetRoleId; //ApprAuthRole
            $APAuthRole = $request->ApprAuthRole;
            $WfModuleArr['target_roles'] = $TargetRoles;
            $WfModuleArr['appr_auth'] = $APAuthRole;
            $ModTrans = new UserWorkLoad(); 
            $UpdateWfModuleData = $ModTrans->UpdateModuleRoles($WfModuleArr, $Id);
    
            if ($UpdateWfModuleData != NULL) {
                Helper::CreateLog($request, "ModuleController || Work Flow Target Roles Updated ");
                $message = "Work Flow Target Roles Updated !";
            } else {
                $message = "Failed to update workflow.";
            }
        }
        return response()->json(['message' => $message]);
    }

    public function ValidateWorkFlowModules(Request $request){
        $message = NULL;
        $Rules = [ 'WFMCODE_F' => 'required|max:10', 'WFMODNAME_F' => 'required|max:100' ];
        $WFCode = $request->input('work_flow_code');
        $WFModName = $request->input('work_flow_module_name');
        $ValidateData = [
            'WFMCODE_F' => $WFCode,
            'WFMODNAME_F' => $WFModName
        ];
        $Validate = Validator::make($ValidateData, $Rules);
        if($Validate->fails()) {
            $ValidateFields = $Validate->failed();
            foreach($ValidateFields as $ValidFieldName => $ValidRules){
                if($ValidFieldName == "WFMCODE_F"){
                    $message = 'Error : Invalid WorkFlow Module Code..!!';
                }
                if($ValidFieldName == "WFMODNAME_F"){
                    $message = 'Error : Invalid WorkFlow Module Name..!!';
                }
            }
        }
        return $message;
    }

    public function SaveWorkFlowModules(Request $request){  
        $message = NULL;
        if($request->input('wf_moduleid') != NULL){
            if($request->input('work_flow_module_name') == NULL){
                $message = "Please enter the Work Flow Module Name..!!";
            }else{ 
                $UpdateWorkFlow = NULL;
                try {
                    $HidWfmId = decrypt($request->wf_moduleid);
                }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                    $data = "Error : Sorry Invalid Attempt";
                    return view('error.PayLoadError')->with('data',$data);
                }
                $UppCaseWFCode = strtoupper($request->input('work_flow_code'));
                $WorkFlowArr['wf_module_code'] = $UppCaseWFCode;
                $WorkFlowArr['wf_module_name'] = $request->input('work_flow_module_name');
                $WorkFlowArr['wf_module_group_code'] = $request->input('work_flow_group_code');
                $WorkFlowArr['updated_by'] = session('WcmsEmpNo');
                $WorkFlowArr['updated_at'] = NOW();

                // $WorkFlowArr['division_code'] = $request->input('txt_division'); 

                $WorkFlowDataArr['wf_module_name'] = trim($WorkFlowArr['wf_module_name']);
                $WorkFlowDataArr['wf_module_code'] = trim($WorkFlowArr['wf_module_code']);
                // $WorkFlowDataArr['division_code'] = trim($WorkFlowArr['division_code']);  
                $WorkFlowDataArr['wf_module_name'] = preg_replace("/[^a-zA-Z0-9]+/", "", $WorkFlowDataArr['wf_module_name']);  
                $WorkFlowDataArr['wf_module_code'] = preg_replace("/[^a-zA-Z0-9]+/", "", $WorkFlowDataArr['wf_module_code']);  
                $CheckWorkFlowModule = $this->workflowmodules->CheckWorkFlowModulesUpdate($WorkFlowDataArr,$HidWfmId);
                if(count($CheckWorkFlowModule) > 0){
                    $LogMessage = "AdminController || Module already exists";
                    Helper::CreateLog($request,$LogMessage);
                    $message = "Failed: Module already exists";
                }else{
                    $UpdateWorkFlow = $this->workflowmodules->UpdateWorkFlowModules($WorkFlowArr,$HidWfmId);
                }
                if($UpdateWorkFlow == true){
                    $LogMessage = "AdminController || Work Flow Module Updated Sucessfully, updated by ".session('WcmsEmpNo')." ";
                    Helper::CreateLog($request,$LogMessage);       
                    $message = "Work Flow Module Updated Sucessfully.!!";
                }
                $WorkFlowData = NULL;
            }
        }else{
            $WorkFlowName = $request->input('work_flow_module_name');
            if($WorkFlowName == NULL){
                $message = "Please enter the Work Flow Module Name.!!";
            }else{
                $UppCaseWFCode = strtoupper($request->input('work_flow_code'));
                $CheckFMod = $this->workflowmodules->ShowWorkFlowModulesByModuleId(NULL);
                $CheckFModExist = collect($CheckFMod)->where('wf_module_code',$UppCaseWFCode)->where('division_code',$request->input('txt_division'))->count();
                if($CheckFModExist == 0){
                    $WorkFlowArr['wf_module_code'] = $UppCaseWFCode;
                    $WorkFlowArr['wf_module_name'] = $request->input('work_flow_module_name');
                    // $WorkFlowArr['division_code'] = $request->input('txt_division');
                    $WorkFlowArr['wf_module_group_code'] = $request->input('work_flow_group_code');
                    $WorkFlowArr['created_by'] = session('WcmsEmpNo');
                    $WorkFlowArr['created_at'] = NOW();
                    $WorkFlowArr['active'] = 1;
                    $WorkFlowDataArr['wf_module_name'] = trim($WorkFlowArr['wf_module_name']);
                    $WorkFlowDataArr['wf_module_code'] = trim($WorkFlowArr['wf_module_code']);
                    // $WorkFlowDataArr['division_code'] = trim($WorkFlowArr['division_code']);  
                    $WorkFlowDataArr['wf_module_name'] = preg_replace("/[^a-zA-Z0-9]+/", "", $WorkFlowDataArr['wf_module_name']);  
                    $WorkFlowDataArr['wf_module_code'] = preg_replace("/[^a-zA-Z0-9]+/", "", $WorkFlowDataArr['wf_module_code']);
                    $CheckWorkFlowModule = $this->workflowmodules->CheckWorkFlowModules($WorkFlowDataArr);
                    if(count($CheckWorkFlowModule) > 0){
                        $LogMessage = "AdminController || Module already exists";
                        Helper::CreateLog($request,$LogMessage);
                        $message = "Failed: Module already exists";
                    }else{
                        $CreateWorkFlowModuleData = $this->workflowmodules->CreateWorkFlowModules($request, $WorkFlowArr);
                        if($CreateWorkFlowModuleData != NULL){
                            $LogMessage = "AdminController || Work Flow Module created successfully, created by ".session('WcmsEmpNo')." ";
                            Helper::CreateLog($request,$LogMessage);       
                            $message = "Work Flow Module Saved successfully..!!";
                        }
                    }
                }else{
                    $message = "Error : Unable to save, Work Flow Module already exist..!!";
                }
            }
        }
        Session::put('ALertMesage', $message);
        return redirect()->route('workflow.WorkFlow');
    }

    public function ViewWorkFlowModules(Request $request)
    {
        $ShowWorkFlow = $this->workflowmodules->ShowAllWorkFlowModules(NULL,NULL);
        if(session('WcmsRoleGroupCode') == "ACCADMUSER"){
            $ShowWorkFlow = collect($ShowWorkFlow)->where('wf_module_group_code','ACCMOD');
        }else if(session('WcmsRoleGroupCode') == "ADMUSER"){
            $ShowWorkFlow = collect($ShowWorkFlow)->where('wf_module_group_code','USRMOD');
        }else if(session('WcmsRoleGroupCode') == "SUPUSER"){
            //$ShowWorkFlow = collect($ShowWorkFlow)->where('wf_module_group_code','USRMOD');
        }else{
            $ShowWorkFlow = NULL;
        }
        return view('workflow.ViewWorkFlowModule')->with('data', compact('ShowWorkFlow'));
    }

    public function WorkFlowModules(Request $request)
    { 
        $message = NULL;   $WorkFlowData = NULL;
        if(isset($request->id)){ 
            try {
                $WFMId = decrypt($request->id);
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $data = "Error : Sorry Invalid Attempt";
                return view('error.PayLoadError')->with('data',$data);
            }
            $WorkFlowData = $this->workflowmodules->ShowWorkFlowModulesByModuleId($WFMId);
            $WorkFlowData = $WorkFlowData->first();
        }
        if($request->btn_save){
            $message = $this->ValidateWorkFlowModules($request);
            if(!filled($message)){
                return $this->SaveWorkFlowModules($request);
            }
        }
        $OfficeList = $this->Office->ShowOfficeWithType('D',NULL);
        return view('workflow.WorkFlowModule')->with('data', compact('WorkFlowData','OfficeList'))->with('ALertMesage',$message);
    }

    public function DeleteWorkFlowModule(Request $request){
        $WorkFlowArr = array();
        $WorkFlowArr['active'] = 0;
        $WorkFlowData = $this->workflowmodules->UpdateWorkFlowModules($WorkFlowArr, decrypt($request->Id));
        $LogMessage = "AjaxController || Work Flow Module  Deleted successfully ";
        Helper::CreateLog($request,$LogMessage);   
        return $WorkFlowData;
    }
    
}
