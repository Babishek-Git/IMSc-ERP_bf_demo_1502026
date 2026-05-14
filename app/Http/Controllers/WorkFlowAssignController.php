<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\modules;
use App\Models\Role;
use App\Models\WorkFlow;
use App\Models\work_flow_modules;
use App\Models\AgmOffice;
use Helper;
use DB;
use Session;

class WorkFlowAssignController extends Controller
{
    public function __construct(){
        $this->Office = new AgmOffice();
        $this->workflowmodules = new work_flow_modules();
        $this->WorkFlow = new WorkFlow();
         $this->role = new Role();
    }
    public function ModuleWorkFLow(Request $request)
    {
        $data = NULL; $message = NULL;  
        $ModuleData = $this->workflowmodules->ShowWorkFlowModules($request,NULL);  
        $Role = new Role();
        if (session('WcmsRoleGroupCode') == 'ACCADMUSER') {
            $RoleData = $Role->ShowRoles($request,NULL)->where('role_group_code', 'ACCUSER');
        }else if (session('WcmsRoleGroupCode') == 'SUPUSER' || session('WcmsRoleGroupCode') == 'ADMUSER') {
            $RoleData = $Role->ShowRoles($request,NULL);
        }else{
            $RoleData = NULL;
        }
        //$ModTrans = new UserWorkLoad(); 
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
                $ModuleCodeData = $this->workflowmodules->ShowWorkFlowModulesByModuleId($ModuleId); 
                if(($ModuleCodeData != NULL)&&(count($ModuleCodeData) > 0)){
                    $ModuleCode = collect($ModuleCodeData)->pluck('wf_module_code')->first();
                }else{
                    $ModuleCode = NULL;
                }
                $ModTransData = $this->WorkFlow->GetModuleRoleData($request,$ModuleCode,NULL);  
                //$ModuleTranIdArr = $ModTransData->where('division_code',$DivisionId)->pluck('work_flow_id')->toArray();
                $ModuleTranIdArr = $ModTransData->pluck('work_flow_id')->toArray(); 
                $DelModTransArr = array_diff($ModuleTranIdArr,$ModTransIdArr);
                if($MappedRoleArr != NULL){
                    if(count($MappedRoleArr) > 0){
                        foreach($MappedRoleArr as $RoleMapKey => $RoleMapValue){
                            $ModTransId = $ModTransIdArr[$RoleMapKey];
                            $SaveDataArr = array();
                            //$SaveDataArr['division_code'] = $DivisionId;
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
                            /*$BillType = $BillTypeArr[$RoleMapKey];
                            if($BillType == ""){
                                $BillType = NULL;
                            }
                            $BudgetType = $BudgetTypeArr[$RoleMapKey];
                            if($BudgetType == ""){
                                $BudgetType = NULL;
                            }
                            if($BudgetType == "NA"){
                                $BudgetType = NULL;
                            }*/
                            //$SaveDataArr['bill_type'] = $BillType;
                            //$SaveDataArr['budget_type'] = $BudgetType;
                            $InitRole = $InitRoleIdArr[$RoleMapKey] ?? null;
                            $this->WorkFlow->DeactivateWrkFlow($ModuleId, $InitRole);
                            if(in_array($ModTransId, $ModuleTranIdArr)){
                                $this->WorkFlow->UpdateModuleRoles($SaveDataArr,$ModTransId); 
                                if(filled($ModTransData)){
                                    $LogMessage = "ModuleController || Work Flow Module Updated Sucessfully )";
                                    Helper::CreateLog($request,$LogMessage);                       
                                    $message = ("Work Flow Module Updated Sucessfully!");
                                }
                            }else{
                                $this->WorkFlow->SaveModuleRoles($SaveDataArr);
                                if(filled($ModTransData)){
                                    $LogMessage = "ModuleController || Work Flow Module Saved Sucessfully )";
                                    Helper::CreateLog($request,$LogMessage);                       
                                    $message = ("Work Flow Module Saved Sucessfully!");
                                }
                            }
                        }
                    }
                }
                // if($DelModTransArr != NULL){
                //     if(count($DelModTransArr) > 0){
                //         foreach($DelModTransArr as $DelKey => $DelValue){
                //             $this->WorkFlow->DeleteModuleRoles($DelValue);
                //         }
                //     }
                // }
            }
        }
        $OfficeList = $this->Office->ShowOfficeWithType('D',NULL);
        return view('workflow.ModuleWorkFlow')->with('data',compact('ModuleData','RoleData','OfficeList'))->with('ALertMesage',$message);
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
            

            $UpdateWfModuleData = $this->WorkFlow->UpdateModuleRoles($WfModuleArr, $Id);    
            if($UpdateWfModuleData != NULL) {
                Helper::CreateLog($request, "ModuleController || Work Flow Updated ");
                $message = "Work Flow Updated !";
            }else{
                $message = "Failed to update workflow.";
            }
        }
        return response()->json(['message' => $message]);
    }
    public function ViewModuleWorkFlow(Request $request)
    {
        $WorkFlowData = $this->WorkFlow->ShowWorkFlow(); 
        $RoleData     = $this->role->ShowRoles(NULL,NULL); 
        /*if(filled($RoleData)){
            $RoleGroupData = collect($RoleData)->keyBy('roleid');
        }*/
        $RoleGroupData = filled($RoleData) ? collect($RoleData)->keyBy('roleid') : NULL;
        //dd($WorkFlowData);
        return view('workflow.ViewWorkFlow')->with('data',compact('WorkFlowData','RoleGroupData'));
    }

    

    

    
    
}
