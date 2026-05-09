<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

use App\Models\Role;
use App\Models\RoleMapping;
use App\Models\AemEmployee;
use App\Models\modules;
use App\Models\AgmOffice;
use App\Models\role_group;
use App\Models\office_mapping;
use Exception;

class RoleMappingController extends Controller
{
    protected $role;
    public function __construct(){
        $this->role = new Role();
        $this->rolemapp = new RoleMapping();
        $this->emp = new AemEmployee();
        $this->Office = new AgmOffice();
        $this->rolegroup = new role_group();
        $this->officemapp = new office_mapping();
    }
    public function RoleMapping(Request $request)
    {
        $msg = NULL;
        if(isset($request->btn_save)){
            if($request->btn_save == 'Save'){
                $GroupArr   = $request->has('cmb_group_id') ?  $request->input('cmb_group_id') : null;
                $DivArr     = $request->has('cmb_division_id') ? $request->input('cmb_division_id') : null;
                $SecArr     = $request->has('cmb_section_id') ? $request->input('cmb_section_id') : null;
                //$SubSecArr  = $request->has('cmb_sub_section_id') ? $request->input('cmb_sub_section_id') : null;
                
                /*$SubSecArr = array_map(function($value) {
                    return ($value === "null") ? null : $value;
                }, $SubSecArr);*/

                $RoleArr    = $request->input('cmb_role_id');
                if(isset($RoleArr)){
                    if(count($RoleArr) > 0){
                        foreach($RoleArr as $RoleKey => $RoleId){
                            $RoleMappArr   = array();
                            $RoleMappArr['employee_no']         = $request->input('txt_emp_no');
                            $RoleMappArr['role_id']             = $RoleId;
                            $RoleMappArr['division_id']         = $DivArr[$RoleKey] ?? null;
                            $RoleMappArr['group_id']            = $GroupArr[$RoleKey] ?? null;
                            $RoleMappArr['section_id']          = $SecArr[$RoleKey] ?? null;
                            $RoleMappArr['sub_section_id']      = NULL;//$SubSecArr[$RoleKey] ?? null;
                            $RoleMappArr['created_by']          = session('WcmsEmpNo');
                            $RoleMappArr['created_at']          = NOW();
                            $RoleMappArr['active']              = 1;

                            $RoleMappDataArr['employee_no']     = trim($RoleMappArr['employee_no']);
                            $RoleMappDataArr['role_id']         = trim($RoleMappArr['role_id']); 
                            $RoleMappDataArr['division_id']     = trim($RoleMappArr['division_id']); 
                            $RoleMappDataArr['group_id']        = trim($RoleMappArr['group_id']); 
                            $RoleMappDataArr['section_id']      = trim($RoleMappArr['section_id']); 
                            $RoleMappDataArr['sub_section_id']  = NULL;//trim($RoleMappArr['sub_section_id']); 

                            $CheckRoleData = $this->rolemapp->CheckRoleMapping($RoleMappDataArr);
                            if(count($CheckRoleData)>0){
                                $msg = ("Failed: Role Mapping already exists with these RoleID");
                            }else{
                                $data = $this->rolemapp->SaveRoleMapping($request,$RoleMappArr);
                                if($data != NULL)
                                {
                                    $msg = ("Role Mapping  Saved successfully!");
                                }
                            }  
                        }
                    }
                }
            }
        }
        $ShowGrandParent = $this->Office->ShowGrandParent($request);
        
        $data = $this->role->ShowRoles($request,NULL);
        if(session('WcmsRoleGroupCode') == "ACCADMUSER"){
            $data = collect($data)->where('role_group_code','ACCUSER');
        }else if(session('WcmsRoleGroupCode') == "ADMUSER"){
            $data = collect($data)->where('role_group_code','ENDUSER');
        }else if(session('WcmsRoleGroupCode') == "SUPUSER"){
            $data = collect($data);
        }else{
            $data = NULL;
        }
        return view('roles.role-mapping.RoleMapping')->with('data',compact('data','ShowGrandParent'))->with('ALertMesage',$msg);
    } 
    public function ViewRoleMapping(Request $request)
    {
        if (session('WcmsRoleGroupCode') == 'ADMUSER') {
            $StaffData = $this->emp->ShowEmployees($request,NULL)->where('division_code', session('WcmsEmpDiv'));
        }else if (session('WcmsRoleGroupCode') == 'ACCADMUSER') {
            $StaffData = $this->emp->ShowEmployees($request,NULL)->where('division_code', session('WcmsEmpDiv'))->where('section_code', session('WcmsEmpSec'));
        }else if (session('WcmsRoleGroupCode') == 'SUPUSER') {
            $StaffData = $this->emp->ShowEmployees($request,NULL);
        }else{
            $StaffData = NULL;
        }
        $RoleMapCollect = $this->rolemapp->ShowEmpRoleWOActive($request,NULL); 
        $RoleMapData = $RoleMapCollect->groupBy('employee_no')->toArray();
        return view('roles.role-mapping.ViewRoleMapping')->with('data',compact('StaffData','RoleMapData'));
    }
    public function RoleMenuMapping(Request $request)
    {
        $msg = NUll;
        if(isset($request->btn_save)){
            $msg =  $this->savaRoleAccess($request);
        }else{
            $msg = NULL;
        }
        $Categorys = modules::where('parentid', '=', 0)->get();
        $tree = '<ul id="browser" class="filetree"><li class="tree-view"></li>';
        foreach ($Categorys as $Category) {
            $tree .= '<li id="j1_'.$Category->moduleid.'" class="tree-view closed"><a class="tree-name">'.$Category->module_name.'</a>';
            if ($Category->childs !== null && count($Category->childs)) {
                $html = '<ul>';
                    foreach ($Category->childs as $arr) {
                        if (count($arr->childs)) {
                            $html .= '<li id="j1_'.$arr->moduleid.'" class="tree-view closed"><a class="tree-name">'.$arr->module_name.'</a>';
                            
                            $nestedHtml = '<ul>';
                            foreach ($arr->childs as $child) {
                                $nestedHtml .= '<li  id="j1_'.$child->moduleid.'"  class="tree-view closed"><a class="tree-name">'.$child->module_name.'</a>';
                                $childNestedHtml = '<ul>';
                                foreach ($child->childs as $leafChild) {
                                    $childNestedHtml .= '<li  id="j1_'.$leafChild->moduleid.'"  class="tree-view"><a class="tree-name">'.$leafChild->module_name.'</a></li>';
                                }
                                $childNestedHtml .= '</ul>';
                                $nestedHtml .= $childNestedHtml;
                                $nestedHtml .= '</li>';
                            }
                            $nestedHtml .= '</ul>';
                            
                            $html .= $nestedHtml;
                            $html .= "</li>";
                        } else {
                            $html .= '<li id="j1_'.$arr->moduleid.'"  class="tree-view"><a class="tree-name">'.$arr->module_name.'</a></li>';
                        }
                    }
                $html .= "</ul>";
                $tree .= $html;
            }
            $tree .= "</li>";
        }
        $tree .= '</ul>';
        $RoleList = $this->role->ShowRoleList(NULL);
        return view('roles.role-menu-mapping.RoleMenuMapping')->with('data',compact('Categorys', 'tree','RoleList'))->with('ALertMesage',$msg);
    }
    public function savaRoleAccess($request)
    { 
        $request->validate([
            'role_type' => 'required',
        ]);
        $roleName = $request->input('role_type');
        $msg = NULL;
        if($roleName == NULL){
            $msg = "Please enter the Role Name";
        }else{
            $RoleAccessArr['module_access'] = $request->input('selected_modules');
            $UpdateRoleAccess = $this->role->UpdateRoleAccess($RoleAccessArr,$roleName);
            if($UpdateRoleAccess == true){
                $msg = "Role Access Updated Sucessfully";
            }
        }  
        return $msg;
    } 
    public function SwitchRole(Request $request)
    { 
        $RoleMapId = $request->input('RoleMapId');
        $EmpNo = $request->input('EmpNo');
        $RoleMapping = RoleMapping::where('role_mapping_id', $RoleMapId)->where('employee_no', $EmpNo)->first();

        if($RoleMapping){
            $EmployeeNo = $RoleMapping->employee_no; 
            if($EmployeeNo !== NULL){
                $EmpData = $this->emp->ShowEmployees(NULL,$EmployeeNo); 
                $RoleData = $this->rolemapp->ShowEmpRole(NULL,$EmployeeNo); 
                if($RoleData != NULL){
                    $RoleData = collect($RoleData)->toArray();
                }else{
                    $RoleData = NULL;
                }
            }else{
                $EmpData = NULL;
                $RoleData = NULL;
                $WcmsEmpName = 'Admin';
            }
            if(($EmpData != NULL)&&(count($EmpData) > 0)){
                $EmpGroupCode = $EmpData->pluck('group_id')->first();
                $EmpDivCode = $EmpData->pluck('division_id')->first();
                $EmpSecCode = $EmpData->pluck('section_id')->first();
                $EmpDivShName = $EmpData->pluck('division_short_name')->first();
                $EmpSecShName = $EmpData->pluck('section_short_name')->first();
                $WcmsEmpName = $EmpData->pluck('emp_name_payslip')->first();
                $WcmsEmpPaoCode = $EmpData->pluck('pao_code')->first();

            }else{
                $EmpGroupCode = NULL;
                $EmpDivCode = NULL;
                $EmpSecCode = NULL;
                $EmpSubSecCode = NULL;
                $EmpDivShName = NULL;
                $EmpSecShName = NULL;
                $EmpSubSecShName = NULL;
                $WcmsEmpName = NULL;
                $WcmsEmpPaoCode = NULL;
            }
            $WcmsEmpRoleId = NULL; $WcmsEmpRoleMapId = NULL; $WcmsEmpRoleName = NULL; $ModuleAccess = NULL; $RoleGroupCode = NULL; $ModuleAccessArr = array();
            if(($RoleData != NULL)&&(count($RoleData)>0)){
                foreach($RoleData as $RoleKey => $RoleValue){
                    //if(($EmpData->pluck('group_code')->first() == $RoleValue->group_id)&&($EmpData->pluck('division_code')->first() == $RoleValue->division_id)&&($EmpData->pluck('section_code')->first() == $RoleValue->section_id)){
                    if($RoleMapId == $RoleValue->role_mapping_id){    
                        $WcmsEmpRoleId = $RoleValue->role_id;
                        $WcmsEmpRoleMapId = $RoleValue->role_mapping_id;
                        $WcmsEmpRoleName  = $RoleValue->role_name;
                        $ModuleAccess = $RoleValue->module_access;
                        $RoleGroupCode = $RoleValue->role_group_code;
                        
                        $EmpGroupCode = $RoleValue->group_id;
                        $EmpDivCode = $RoleValue->division_id;
                        $EmpSecCode = $RoleValue->section_id;
                        $EmpDivShName = $RoleValue->division_short_name;
                        $EmpSecShName = $RoleValue->section_short_name;
                    }
                }
            }
            if($ModuleAccess != NULL){
                $ModuleAccessArr = explode(",",$ModuleAccess);
            }
            $Menus = new modules();
            $MenuList = $Menus->ShowModules(NULL,$ModuleAccessArr); 
            $MenuArr = array(
                'categories' => array(),
                'parent_cats' => array()
            );
            if(($ModuleAccessArr != NULL)&&(count($ModuleAccessArr) > 0)){
                foreach($MenuList as $MenuValue) {
                    $MenuArr['categories'][$MenuValue->moduleid] = $MenuValue;
                    $MenuArr['parent_cats'][$MenuValue->parentid][] = $MenuValue->moduleid;
                }
            }
            $AccOffMappArr = array();
            if($RoleGroupCode == "ACCUSER"){
                if($EmpSecCode != NULL){
                    $OfficeMapId = $EmpSecCode;
                }else if($EmpDivCode != NULL){
                    $OfficeMapId = $EmpDivCode;
                }else if($EmpGroupCode != NULL){
                    $OfficeMapId = $EmpGroupCode;
                }else{
                    $OfficeMapId = NULL;
                }
                if($OfficeMapId != NULL){
                    $OfficeMappList = $this->officemapp->ShowAccountsMappedOffice($OfficeMapId);
                    if(($OfficeMappList != NULL)&&(count($OfficeMappList) > 0)){
                        $AccOffMappArr = collect($OfficeMappList)->pluck('office_id')->toArray();
                    }
                }
            }

            session(
                [
                    'isadmin' => $RoleMapping->isadmin,
                    'WcmsEmpName' => $WcmsEmpName,
                    'WcmsEmpNo' => $EmployeeNo,
                    'WcmsEmpRoleId' => $WcmsEmpRoleId,
                    'WcmsEmpRoleMapId' => $WcmsEmpRoleMapId,
                    'WcmsEmpRoleName' => $WcmsEmpRoleName,
                    'WcmsRoleGroupCode' => $RoleGroupCode,
                    'WcmsEmpRoles' => $RoleData,
                    'WcmsEmpGroup' => $EmpGroupCode,
                    'WcmsEmpDiv' => $EmpDivCode,
                    'WcmsEmpSec' => $EmpSecCode,
                    'EmpDivShName' => $EmpDivShName,
                    'EmpSecShName' => $EmpSecShName,
                    'WcmsAccOffMappArr' => $AccOffMappArr,
                    'Menus' => $MenuArr
                ]
            );
            
        }
        
    }
    public function getModuleAccess(Request $request)
    {
        $selectedRoleName = $request->input('selectedRoleName');
        $role = Role::where('roleid', $selectedRoleName)->first();
        if (!$role) {
            return response()->json(['error' => 'Role not found'], 404);
        }
        $moduleAccessText = $role->module_access;
        $moduleAccessData = explode(',', $moduleAccessText);
        $moduleAccessData = array_map('trim', $moduleAccessData);
        return implode(',', $moduleAccessData);
    }
    public function SwitchEmployeeRole(Request $request){ 
        $OutputArr = array();
        $EmpData = $this->rolemapp->ShowEmpRole($request,session('WcmsEmpNo'))->where('active',1);
        $EmpName = session('WcmsEmpName');
        $EmpRoleMapId = session('WcmsEmpRoleMapId');
        $OutputArr['EmpName'] = $EmpName;
        $OutputArr['EmpData'] = $EmpData;
        $OutputArr['EmpRoleMapId'] = $EmpRoleMapId;
        return $OutputArr;
    }
}