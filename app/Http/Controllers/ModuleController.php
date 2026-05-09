<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\modules;
use App\Models\AgmOffice;
use Helper;

class ModuleController extends Controller
{
    public function __construct(){
        $this->Office = new AgmOffice();
    }
    
    
    public function ModuleCreation(Request $request){
        $message = NULL;
        if(isset($request->btn_save)){
            if($request->input('btn_save') == "Save"){
                $InsertData = new modules();
                $ParGroupArr 	= $request->input('cmb_group');
                $NewGroupArr 	= $request->input('new_group');
                $ModCodeArr 	= $request->input('txt_module_code');
                $MenuIconArr 	= $request->input('txt_menu_icon');
                $MenuUrlArr 	= $request->input('txt_menu_url');
                $IsNavbarArr 	= $request->input('txt_is_navbar');
                $ActionsArr 	= $request->input('txt_actions');
                $MenuTypeArr 	= $request->input('txt_menu_type');
                $DpOrderArr 	= $request->input('txt_dp_order');
                $PageCodeArr 	= $request->input('txt_page_code');
                $ParCount 	 	= count($ParGroupArr);
                $ChiCount 	 	= count($NewGroupArr);
                $ParentId 	 	= $ParGroupArr[$ParCount-1];
                if($ParentId == "NEW"){
                    if($ParCount == 1){
                        $ParentId = 0;
                    }else{
                        $ParentId = $ParGroupArr[$ParCount-2];
                    }
                }
                $NewGroup  	 	= $NewGroupArr[$ChiCount-1];
                $ModCode  	 	= $ModCodeArr[$ChiCount-1];
                $MenuIcon  	 	= $MenuIconArr[$ChiCount-1];
                $MenuUrl  	 	= $MenuUrlArr[$ChiCount-1];
                $IsNavbar  	 	= $IsNavbarArr[$ChiCount-1];
                $Actions  	 	= $ActionsArr[$ChiCount-1];
                $MenuType  	 	= $MenuTypeArr[$ChiCount-1];
                $DpOrder  	 	= $DpOrderArr[$ChiCount-1];
                $PageCode  	 	= $PageCodeArr[$ChiCount-1];        
                $InsertArr = array();
                $InsertArr['module_name']   = $NewGroup;
                $InsertArr['parentid']      = $ParentId;
                $InsertArr['module_code']   = $ModCode;
                $InsertArr['menu_icon']     = $MenuIcon;
                $InsertArr['menu_url']      = $MenuUrl;
                $InsertArr['is_navibar']    = $IsNavbar;
                $InsertArr['actions']       = $Actions;
                $InsertArr['active']        = 1;
                $InsertArr['menu_type']     = $MenuType;
                $InsertArr['dp_order']      = $DpOrder;
                $InsertArr['page_code']     = $PageCode;
                $InsertedData = $InsertData->InsertData($InsertArr);
                if($InsertedData != NULL)
                {
                    $LogMessage = "ModuleController || New Menu Created Successfully )";
                    Helper::CreateLog($request,$LogMessage);       
                    $message = ("New Menu Created Successfully!");
                }
            }   
        }  
        $ModulesModel = new modules();
        $ShowGrandParent = $ModulesModel->ShowGrandParent($request);
        return view('module.ModuleCreation')->with('data',compact('ShowGrandParent'))->with('ALertMesage',$message);
    }
   
    
   

    public function ModuleFind(Request $request){ 
        $GroupId 	= $request->input('groupid');
        $GetModule = new modules();
        $GetModuleData = $GetModule->GetModule($GroupId);
        return $GetModuleData;
    }
}
