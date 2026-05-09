<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Role extends Model
{
    use HasFactory;
    protected $table = 'erp_role';
    public $timestamps = false;
    protected $primaryKey = 'roleid';
    protected $fillable = [
        'role_name',
        'module_access',
        'active',
        'division_code',
        'role_group_code',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'role_code',
        'role_short_name',
        'role_dp_order',
        'group_id'
    ];
    public static function ShowRoles($request,$RoleId){
        if(isset($request->UserRoleWise)){
            $role = $request->UserRoleWise;
            if($role != NULL){
                return Role::where('role_group_code',$role)->where('active',1)->get();
            }
        }
        if($RoleId != NULL){
            return Role::where('roleid',$RoleId)->get();
        }else{
            return Role::get();
        }
    }
    // public static function CreateRoles($request){
    //     $role = Role::create([
    //         'role_name' => $request->input('txt_role_name'),
    //         'active' => 1
    //     ]);
    //     return $role;
    // }

    public function CreateRoles($request, $RoleAccessArr){
        return Role::create($RoleAccessArr);
    }


    public function ShowRoleWithDivision($request,$RoleId)
    {
       
        $RoleData = DB::table('erp_role')
            ->select('erp_role.*', 'erp_office.*', 'erp_role_group.*') 
            ->leftjoin('erp_office', 'erp_role.division_code', '=', 'erp_office.office_id')
            ->leftjoin('erp_role_group', 'erp_role.role_group_code', '=', 'erp_role_group.role_group_code');
            if($RoleId != NULL){
                $RoleData->where('erp_role.roleid', '=', $RoleId);
            } 
            $RoleData->where('erp_role.division_code', '=', session('WcmsEmpDiv'));
        $RoleData = $RoleData->get();
          
        return $RoleData;
       
    }
    

    public static function ShowEmpName($request,$RoleId)
    {
        $RoleData = DB::table('erp_role')
        ->select('erp_role.*','erp_role_mapping.*','erp_employee.*')
        ->join('erp_role_mapping','erp_role_mapping.role_id','=','erp_role.roleid')
        ->join('erp_employee','erp_employee.emp_no','=','erp_role_mapping.employee_no')
        ->where('erp_role_mapping.role_id','=',$RoleId)
        ->where('erp_employee.active',1)
        ->get();                                  
        return $RoleData;
    }

    public function ShowRoleList($roleid){
        if($roleid != NULL){
            $RoleData = Role::where('roleid', $roleid)->orderby('roleid','ASC')->get();
        }else{
            $RoleData = Role::where('active',1)->orderby('roleid','ASC')->get();
        }
        return $RoleData;        
    }

    public function UpdateRoleAccess($RoleAccessArr, $roleid){
        return Role::where('roleid', $roleid)->update($RoleAccessArr);
    }

    public function CheckRole($RoleAccessArr){
        return Role::select('role_name')
                    ->whereRaw("REGEXP_REPLACE(REGEXP_REPLACE(role_name, '[^a-zA-Z0-9]+', '', 'g'), ' ', '', 'g') ILIKE ?", [$RoleAccessArr['role_name']])  
                    ->get();
    }
    public function ShowRoleWithRoleGrp($request,$RoleId)
    {
        $RoleData = DB::table('erp_role')
            ->select('erp_role.*', 'erp_role_group.*','erp_role.active as active') 
            ->leftjoin('erp_role_group', 'erp_role.role_group_code', '=', 'erp_role_group.role_group_code');
            if($RoleId != NULL){
                $RoleData->where('erp_role.roleid', '=', $RoleId);
            } 
        $RoleData = $RoleData->orderby('erp_role.role_name','ASC')->get();
          
        return $RoleData;
       
    }
    public function ShowRoleListByRoleIdArr($RoleIdArr){
        if(filled($RoleIdArr)){
            $RoleData = Role::whereIn('roleid', $RoleIdArr)->get();
        }else{
            $RoleData = NULL;  
        }
        return $RoleData;        
    }
    /*public function ShowRoleListBySection($SectionId){
        $RoleData = Role::where('section_id', $SectionId)->whereNotNull('section_id')->where('active',1)->get();
        return $RoleData;
    }*/
    public function ShowRoleListByGroup($GroupId){
        return Role::where('group_id', $GroupId)->whereNotNull('group_id')->where('active',1)->get();
    }
    public function ShowRoleByRoleCode($RoleCode){
        return Role::where('role_code',$RoleCode)->get();
    }

}
