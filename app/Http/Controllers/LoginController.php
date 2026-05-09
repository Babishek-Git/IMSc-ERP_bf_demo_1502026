<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\Login\RememberMeExpiration;
use App\Models\AemEmployee;
use App\Models\Role;
use App\Models\RoleMapping;
use App\Models\modules;
use App\Models\User;
use App\Models\office_mapping;
use Illuminate\Support\Facades\Log;
use Helper;
class LoginController extends Controller
{
    use RememberMeExpiration;
    public function __construct(){
        $this->emp = new AemEmployee();
        $this->role = new Role();
        $this->rolemapp = new RoleMapping();
        $this->officemapp = new office_mapping();
    }
    /**
     * Display login page.
     * 
     * @return Renderable
     */
    public function show(Request $request)
    { 
        /// Call SSO if user enter login page page in WCMS
        return view('auth.login');
    }
    
    
    
    
    public function CheckUserInfo($ssoReturn){ 
      $username = $ssoReturn; 
      $user = User::where('username', $username)->first();  //dd($user);
      if ($user){
          Auth::login($user);
          session(['user' => $user]);
          $this->setUserSession($user);
          return redirect()->to('/home');
      }else{
          //return view('auth.UnAuthorized');
           $RoleGrpArr = array('SUPUSER','ADMUSER');
           $AdminEmpData = $this->rolemapp->ShowRoleGroupEmpDetails($RoleGrpArr); 
           return view('auth.UnAuthorized')->with('data',compact('AdminEmpData'));
      }
    }
    


    /**
     * Handle account login request
     * 
     * @param LoginRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    { 
        $credentials = $request->getCredentials(); 
        if(!Auth::validate($credentials)):
            return redirect()->to('/login')->withErrors(trans('auth.failed'));
        endif;
       
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        
        Auth::login($user, $request->get('remember'));
        
        /*if($request->get('remember')):
            $this->setRememberMeExpiration($user);
        endif;*/
        
        return $this->authenticated($request, $user);
    }

    /**
     * Handle response after user authenticated
     * 
     * @param Request $request
     * @param Auth $user
     * 
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user) 
    {
        
		$this->setUserSession($user);
        //return redirect()->intended('/');
        $LogMessage = "LoginController || Logged in successfully";
        Helper::CreateLog($request,$LogMessage);
        
        return redirect()->to('/home');//redirect()->intended();
    }
	protected function setUserSession($user)
	{
        $EmployeeNo = $user['emp_no'];//$user['username'];
        $IcNo = $user['ic_no'];
        $EmpData = $this->emp->ShowEmployees(NULL,$EmployeeNo); 
        $RoleData = $this->rolemapp->ShowEmpRole(NULL,$EmployeeNo); 
        if($RoleData != NULL){
            $RoleDataDp = $RoleData->map(function ($Roles) {
                if ($Roles->role_dp_order === null) {
                    $Roles->role_dp_order = 0;
                }
                return $Roles;
            });
            $RoleDataDp = $RoleDataDp->where('role_dp_order', $RoleDataDp->min('role_dp_order'))->first();
            $RoleData = collect($RoleData)->toArray();
        }else{
            $RoleData = NULL;
            $RoleDataDp = NULL;
        }
        //dd($RoleDataDp);
        
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
            $EmpDivShName = NULL;
            $EmpSecShName = NULL;
            $WcmsEmpName   = NULL;
	        $WcmsEmpPaoCode = NULL;
        } 
        $WcmsEmpRoleId = NULL; $WcmsEmpRoleMapId = NULL; $WcmsEmpRoleName = NULL; $ModuleAccess = NULL; $RoleGroupCode = NULL; $ModuleAccessArr = array();
        if($RoleDataDp != NULL){ 
            $RoleValue = $RoleDataDp;
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
        if($ModuleAccess != NULL){
            $ModuleAccessArr = explode(",",$ModuleAccess);
        } 
        $Menus = new modules();
        $MenuList = $Menus->ShowModules(NULL,$ModuleAccessArr);//modules::where('active',1)->orderBy('dp_order','ASC')->get();//$Menus->ShowModules(NULL,$ModuleAccessArr);
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
        /*if($RoleGroupCode == "ACCUSER"){
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
        }*/
        
        //$RoleGroupCode = "SUPUSER";
		session(
			[
				'isadmin' => $user['isadmin'],
                'WcmsEmpName' => $WcmsEmpName,
                'WcmsIcNo' => $IcNo,
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
