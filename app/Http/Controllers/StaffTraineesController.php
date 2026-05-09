<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
//use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
//use Spatie\Permission\Models\Permission;

use App\Models\Role;
use App\Models\RoleMapping;
use App\Models\AemEmployee;
use App\Models\modules;
use App\Models\AgmOffice;
use App\Models\role_group;
use App\Models\office_mapping;
use Helper;
use Exception;

class StaffTraineesController extends Controller
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
    
    public function StaffTrainees(Request $request){
        $message = NULL;
        $RoleData = NULL;
        if(isset($request->id))
        { 
            $RoleData = $this->role->ShowRoles(null,decrypt($request->id));
            $RoleData = $RoleData->first(); 
        }

        if($request->btn_save){   
            $LogData = [];
            $LogData['MODULE_CODE'] = 'ROLE';
            $LogData['TABLE_NAME']  = 'erp_role';
            $LogData['MODEL_NAME']  = 'Role';
            $LogData['CONT_FUNC_NAME'] = 'RolesController||RoleMaster';

            if($request->hid_roleid != NULL){  
                $LogData['ACTION']      = 'UPDATE';  
                if($request->txt_role_name == NULL){
                    $message = ("Please enter the Role  Name!");
                    $LogData['TRANSACTION_ID'] = decrypt($request->hid_roleid);
                    $LogData['REMARKS']     = 'Error: User with Employee No. '.session('WcmsEmpNo').' attempted to update a role. #:'.decrypt($request->hid_roleid);
                }else{
                    $ExistingData = Role::find(decrypt($request->hid_roleid));
                    $RoleAccessArr['role_name'] = $request->txt_role_name;
                    $RoleAccessArr['role_group_code'] = $request->txt_role_group;
                    $RoleAccessArr['section_id'] = $request->cmb_section;
                    $UpdateRole = $this->role->UpdateRoleAccess($RoleAccessArr, decrypt($request->hid_roleid));
                    $LogData['OLD_VALUE']   = json_encode($ExistingData->getOriginal());
                    $LogData['NEW_VALUE']   = json_encode($RoleAccessArr);
                    $LogData['TRANSACTION_ID'] = decrypt($request->hid_roleid);
                    $LogData['REMARKS']     = 'Role has been updated by '.session('WcmsEmpNo');

                    if($UpdateRole == true){
                        $message = ("Role  Updated Sucessfully!");
                    }
                    $RoleData = NULL;
                }                
            }else{  
                $LogData['ACTION']      = 'CREATE';
                $RoleName = $request->txt_role_name;
                $Division = $request->txt_division;
                if($RoleName == NULL){  
                    $message = ("Please enter the Role  Name!");
                    $LogData['REMARKS']     = 'Error: User with Employee No. '.session('WcmsEmpNo').' attempted to create a new role.';
                }else { 
                    $RoleAccessArr['role_name'] = $request->txt_role_name;
                    $RoleAccessArr['role_group_code'] = $request->txt_role_group;
                    $RoleAccessArr['section_id'] = $request->cmb_section;
                    $RoleAccessArr['created_by'] = session('WcmsEmpNo');
                    $RoleAccessArr['created_at'] = NOW();
                    $RoleAccessArr['active'] = 1;

                    $RoleAccessDataArr['role_name'] = trim($RoleAccessArr['role_name']); //removes spaces
                    $RoleAccessDataArr['role_name'] = preg_replace("/[^a-zA-Z0-9]+/", "", $RoleAccessDataArr['role_name']); //removes special characters
                    $CheckRole = $this->role->CheckRole($RoleAccessDataArr);
                    if(count($CheckRole)>0){
                        $message = ("Failed: Role already exists");
                        $LogData['REMARKS']     = 'Error: User with Employee No. '.session('WcmsEmpNo').' attempted to create a new role ('.$request->txt_role_name.').';
                    }else{
                        $CreateRole = $this->role->CreateRoles($request, $RoleAccessArr);
                        $LogData['OLD_VALUE']   = NULL;
                        $LogData['NEW_VALUE']   = json_encode($RoleAccessArr);
                        $LogData['TRANSACTION_ID'] = $CreateRole->roleid;
                        $LogData['REMARKS']     = 'New role created by '.session('WcmsEmpNo');
                        Helper::CreateLogInTable($request,$LogData);
                        if($CreateRole != NULL){
                            $message = ("Role Saved successfully!");
                        }
                    }  
                }
            }
        }
        $OfficeList = $this->Office->ShowOfficeWithType('G',NULL);
        $RoleDataView = $this->role->ShowRoleWithRoleGrp(NULL,NULL);

        if (session('WcmsRoleGroupCode') == 'ADMUSER') {
            $RoleGroup = $this->rolegroup->ShowRoleGroup(NULL,NULL)->where('role_group_code', 'ENDUSER');
            $RoleDataView = collect($RoleDataView)->where('role_group_code','ENDUSER');
        }else if (session('WcmsRoleGroupCode') == 'ACCADMUSER') {
            $RoleGroup = $this->rolegroup->ShowRoleGroup(NULL,NULL)->where('role_group_code', 'ACCUSER');
            $RoleDataView = collect($RoleDataView)->where('role_group_code','ACCUSER');
        }else if (session('WcmsRoleGroupCode') == 'SUPUSER') {
            $RoleGroup = $this->rolegroup->ShowRoleGroup(NULL,NULL); 
            $RoleDataView = collect($RoleDataView);
        }else{
            $RoleGroup = NULL;
            $RoleRoleDataViewData = NULL;
        }
        
        return view('staff-trainees.staff-trainees')->with('data',compact('RoleDataView','OfficeList','RoleGroup','RoleData')) ->with('ALertMesage',$message);
    }

    public function ViewStaffTrainees(Request $request)
    {
        $LogData = [];
        $LogData['MODULE_CODE'] = 'ROLE';
        $LogData['ACTION']      = 'VIEW';
        $LogData['CONT_FUNC_NAME'] = 'RolesController||ViewRoleMaster';
        $LogData['REMARKS']     = 'Role has been viewed by '.session('WcmsEmpNo');
        Helper::CreateLogInTable($request,$LogData);
        

        $data = $this->role->ShowRoleWithRoleGrp(NULL,NULL);
        if(session('WcmsRoleGroupCode') == "ACCADMUSER"){
            $data = collect($data)->where('role_group_code','ACCUSER');
        }else if(session('WcmsRoleGroupCode') == "ADMUSER"){
            $data = collect($data)->where('role_group_code','ENDUSER');
        }else if(session('WcmsRoleGroupCode') == "SUPUSER"){
            $data = collect($data);
        }else{
            $data = NULL;
        }
        return view('staff-trainees.Viewstaff-trainees')->with('data',compact('data'));
    }
}