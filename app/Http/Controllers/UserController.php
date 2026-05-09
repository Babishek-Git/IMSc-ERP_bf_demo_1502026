<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AemEmployee;
use App\Models\RoleMapping;
use App\Models\Role;
use App\Models\EmployeeGroupMaster;
use App\Models\designation;

use DB;
use Session;
use Helper;

class Usercontroller extends Controller
    {
        public function __construct(){
            $this->user = new User();
            $this->employee = new AemEmployee();
            $this->rolemapping = new RoleMapping();
            $this->role = new Role();
            $this->empgroup = new EmployeeGroupMaster();
            $this->designation = new designation();
        }
        /*public function index() 
        {
            return view('admin.index');
        }
        public function show(Request $request)
        {
            
            return view('admin.userslist')->with('data',User::where('active', 1)->get());
        }
        public function create(Request $request)
        {
            $data = NULL;
           
            if(isset($request->id)){
                $data = User::where('userid',decrypt($request->id))->get();//user::get($request->id);
            }
            //dd($data); exit;
            return view('admin.createuser')->with('data',$data);
        }
        public function save(Request $request)
        {
            if($request->input('username') == null){
                return view('admin.userslist')->with('ALertMesage','Username should not be empty');
                exit;
            }
            $request->validate([
                'username' => 'required'
            ]);
            
    
            if($request->userid == null){
                User::create([
                    'username' => encrypt($request->input('username')),
                    'sectionid' => 1,
                    'sectionid' => 1,
                    'userlevel' => 1,
                    'active' => 1,
                    'userid' => 1
                ]);
                $messge = 'User has been created successfully.';
            }else{
                $design = User::find(decrypt($request->userid));
                $design->username = encrypt($request->username);
                $design->save();
                $messge = 'User has been updated successfully.';
            }
            return view('admin.userslist')->with('ALertMesage',$messge);
        }
        public function delete(Request $request)
        {
            if($request->id != null){
                $design = User::find(decrypt($request->id));
                $design->active = 0;
                $design->save();
                $messge = 'User has been deleted successfully.';
            }
            return view('admin.user')->with('ALertMesage',$messge)->with('data',User::all());
        }*/
        public function UserCreation(Request $request)
        {
            $message = NULL;
            $UserData = NULL;
            if(isset($request->id))
            { 
                $EmpData = $this->employee->ShowEmployees(NULL,NULL);
                $UserData    = $this->user->ShowUserList(decrypt($request->id));
                $EmpNo       = collect($UserData)->pluck('emp_no')->first();
                $EmpDe       = collect($UserData)->pluck('division')->first();
                $UpdateData  = $this->employee->ShowEmployeesBYEmpNo(NULL,$EmpNo);
                $UpdateData    = $this->employee->ShowEmployees(NULL,$EmpNo);
                $RoleBaseMapping = $this->rolemapping->ShowRoleNameByEmpNo(null,$EmpNo);

                // ShowDesiginationData
                //dd($RoleBaseMapping);
                return view('users.UserCreation')->with('data', compact('UpdateData','EmpData','RoleBaseMapping'));

            }
            if($request->btn_save){  
                 DB::beginTransaction();
                try {
                    $UserData = User::where('emp_no',$request->cmb_emp_name)->get();
                    $UserId = NULL;
                    if(filled($UserData)){
                        $UserId = collect($UserData)->pluck('id')->first();
                    }  
                    if($UserId != NULL){   //for Update records
                        $UserArr['username']        = $request->txt_username;
                        //$UserArr['password']        = $request->txt_username;  //bcrypt($request->password);
                        $UserArr['isadmin']         = $request->is_admin;
                        $UserArr['issuperadmin']    = $request->is_superadmin;
                        $UserArr['userrole']        = $request->user_role;
                        $UpdateUser = $this->user->UpdateUser($UserArr, $UserId);
                        if($UpdateUser == true){
                            $LogMessage = "Usercontroller || User Details Updated Sucessfully )";
                            Helper::CreateLog($request,$LogMessage);       
                            $message = ("User Updated Sucessfully!");
                        }else{
                            $message = "Error : User details not updated !";
                        }
                        $UserData = NULL;
                    }else{  //for Create record
                        $VrEmpNo = $request->cmb_emp_name;
                        $UserArr['username']        = $request->txt_username;
                        $UserArr['password']        = $request->txt_username;
                        $UserArr['emp_no']          = $request->cmb_emp_name;
                        $UserArr['ic_no']          = $request->txt_emp_icno;
                        $UserArr['is_portal']       = $request->is_portal_acces_allow;
                        $UserArr['created_by']      = session('WcmsEmpNo');
                        $UserArr['created_at']      = NOW();
                        $UserArr['active']          = 1;
                        $CreateUser = $this->user->CreateUser($request, $UserArr);
                       
                        $EmpData = $this->employee->ShowEmployees($request,$request->cmb_emp_name); 
                        $GroupId = collect($EmpData)->pluck('group_id')->first();
                        $DivisionId = collect($EmpData)->pluck('division_id')->first();
                        $SectionId = collect($EmpData)->pluck('section_id')->first();
                       
                        // Here we are inserting the Record when the check box(Is Admin(in "User creation UI")) is selected
                        if($request->is_section_admin != NULL && $request->is_section_admin != ""){ 
                            $AdminRoleData = $this->role->ShowRoleByRoleCode("ADM");
                            $AdminRoleId = collect($AdminRoleData)->pluck('roleid')->first();
                            $CheckRoleData1 = $this->rolemapping->ShowEmployeeByEmpNoRole($request->cmb_emp_name,$AdminRoleId);
                            if(!filled($CheckRoleData1)){
                                $RoleMappArr1['employee_no']     = $request->cmb_emp_name;
                                $RoleMappArr1['role_id']         = $AdminRoleId;
                                $RoleMappArr1['group_id']        = $GroupId;
                                $RoleMappArr1['division_id']     = $DivisionId;
                                $RoleMappArr1['section_id']      = $SectionId;
                                $RoleMappArr1['created_at']      = NOW();
                                $RoleMappArr1['created_by']      = session('WcmsEmpNo');
                                $RoleMappArr1['active']          = 1;
                                $this->rolemapping->SaveRoleMapping(NULL,$RoleMappArr1);
                            }
                        }
                        //dd($request->cmb_role_name);
                        // Here we are inserting the Record with the role id from the dropdown(in "User creation UI")
                        if($request->cmb_role_name != NULL && $request->cmb_role_name != ""){
                        // dd($request->cmb_role_name); // where we have pass this  value show me the blade file .............
                            $CheckRoleData2 = $this->rolemapping->ShowEmployeeByEmpNoRole($request->cmb_emp_name,$request->cmb_role_name);
                            if(!filled($CheckRoleData2)){
                                $RoleMappArr2['employee_no']     = $request->cmb_emp_name;
                                $RoleMappArr2['role_id']         = $request->cmb_role_name;
                                $RoleMappArr2['group_id']        = $GroupId;
                                $RoleMappArr2['division_id']     = $DivisionId;
                                $RoleMappArr2['section_id']      = $SectionId;
                                $RoleMappArr2['created_at']      = NOW();
                                $RoleMappArr2['created_by']      = session('WcmsEmpNo');
                                $RoleMappArr2['active']          = 1;
                                $this->rolemapping->SaveRoleMapping(NULL,$RoleMappArr2);
                            }
                        }
                        if($CreateUser != NULL){
                            $LogMessage = "Usercontroller || User Details Saved Sucessfully )";
                            Helper::CreateLog($request,$LogMessage);           
                            $message = "User created successfully !";
                        }else{
                            $message = "Error : User not created !";
                        }
                     
                    }
                    DB::commit();
                }
                catch (\Exception $e) { dd($e);
                    DB::rollback();
                    $message = "Error : Sorry Details not Saved";
                }
                Session::put('ALertMesage', $message); 
                return redirect()->route('user.UserCreation');
            }
            $EmpNo   =  $request->txt_emp_no;
            $EmpData = $this->employee->ShowEmployees(NULL,NULL);
            $UserListData = $this->user->ShowAllUserWithRoleList(NULL); //dd($EditEmployeeData);
            //dd($UserListData);
            return view('users.UserCreation')->with('data', compact('UserData','EmpData','UserListData'))->with('ALertMesage',$message);
        }
        public function ViewUser(Request $request)
        { 
          /*   $message = NULL;
            if (session('WcmsRoleGroupCode') == 'ADMUSER') { 
                $UserData = $this->user->ShowAllUserList()->where('division_id', session('WcmsEmpDiv'));
            }else if (session('WcmsRoleGroupCode') == 'ACCADMUSER') {
                $UserData = $this->user->ShowAllUserList()->where('division_id', session('WcmsEmpDiv'));
            }else if (session('WcmsRoleGroupCode') == 'SUPUSER') {
                $UserData = $this->user->ShowAllUserList();
            }else{
                $UserData = NULL;
            } */
            $UserListData = $this->user->ShowAllUserWithRoleList(NULL);
           // dd($UserListData);
            return view('users.ViewUser')->with('data', compact('UserListData'));
        }
        
    }
    





   