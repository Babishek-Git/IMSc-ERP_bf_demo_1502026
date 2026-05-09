<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\work_flow_modules;
use App\Models\AgmOffice;
use Helper;
use DB;
use Session;

class WorkFlowModuleController extends Controller
{
    public function __construct(){
        $this->Office = new AgmOffice();
        $this->workflowmodules = new work_flow_modules();
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
        return view('workflow.workflow-module.workflow-module')->with('data', compact('WorkFlowData','OfficeList'))->with('ALertMesage',$message);
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
                $WorkFlowDataArr['wf_module_name'] = trim($WorkFlowArr['wf_module_name']);
                $WorkFlowDataArr['wf_module_code'] = trim($WorkFlowArr['wf_module_code']);
                $WorkFlowDataArr['wf_module_name'] = preg_replace("/[^a-zA-Z0-9]+/", "", $WorkFlowDataArr['wf_module_name']);  
                $WorkFlowDataArr['wf_module_code'] = preg_replace("/[^a-zA-Z0-9]+/", "", $WorkFlowDataArr['wf_module_code']);  
                $CheckWorkFlowModule = $this->workflowmodules->CheckWorkFlowModulesUpdate($WorkFlowDataArr,$HidWfmId);
                if(count($CheckWorkFlowModule) > 0){
                    $LogMessage = "WorkFlowModuleController || Module already exists";
                    Helper::CreateLog($request,$LogMessage);
                    $message = "Failed: Module already exists";
                }else{
                    $UpdateWorkFlow = $this->workflowmodules->UpdateWorkFlowModules($WorkFlowArr,$HidWfmId);
                }
                if($UpdateWorkFlow == true){
                    $LogMessage = "WorkFlowModuleController || Work Flow Module Updated Sucessfully, updated by ".session('WcmsEmpNo')." ";
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
                    $WorkFlowArr['wf_module_group_code'] = $request->input('work_flow_group_code');
                    $WorkFlowArr['created_by'] = session('WcmsEmpNo');
                    $WorkFlowArr['created_at'] = NOW();
                    $WorkFlowArr['active'] = 1;
                    $WorkFlowDataArr['wf_module_name'] = trim($WorkFlowArr['wf_module_name']);
                    $WorkFlowDataArr['wf_module_code'] = trim($WorkFlowArr['wf_module_code']);
                    $WorkFlowDataArr['wf_module_name'] = preg_replace("/[^a-zA-Z0-9]+/", "", $WorkFlowDataArr['wf_module_name']);  
                    $WorkFlowDataArr['wf_module_code'] = preg_replace("/[^a-zA-Z0-9]+/", "", $WorkFlowDataArr['wf_module_code']);
                    $CheckWorkFlowModule = $this->workflowmodules->CheckWorkFlowModules($WorkFlowDataArr);
                    if(count($CheckWorkFlowModule) > 0){
                        $LogMessage = "WorkFlowModuleController || Module already exists";
                        Helper::CreateLog($request,$LogMessage);
                        $message = "Failed: Module already exists";
                    }else{
                        $CreateWorkFlowModuleData = $this->workflowmodules->CreateWorkFlowModules($request, $WorkFlowArr);
                        if($CreateWorkFlowModuleData != NULL){
                            $LogMessage = "WorkFlowModuleController || Work Flow Module created successfully, created by ".session('WcmsEmpNo')." ";
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
        return redirect()->route('workflow.workflow-module');
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
        return view('workflow.workflow-module.workflow-module-view')->with('data', compact('ShowWorkFlow'));
    }

    public function DeleteWorkFlowModule(Request $request){
        $WorkFlowArr = array();
        $WorkFlowArr['active'] = 0;
        $WorkFlowData = $this->workflowmodules->UpdateWorkFlowModules($WorkFlowArr, decrypt($request->Id));
        $LogMessage = "AjaxController || Work Flow Module  Deleted successfully ";
        Helper::CreateLog($request,$LogMessage);   
        return $WorkFlowData;
    }

   
    /*public function WorkFlowModuleEdit(Request $request){
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
        $OfficeList = $this->Office->ShowOfficeWithType('D',NULL);
        return view('workflow.workflow-module.workflow-module-edit')->with('data',compact('ModuleData','RoleData','OfficeList'))->with('ALertMesage',$message);;
    }*/
    
}
