<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class RoleMapping extends Model
{
    use HasFactory;
    protected $table = 'erp_role_mapping';
    public $timestamps = false;
    protected $primaryKey = 'role_mapping_id';
    protected $fillable = [
        'del_flag',
        'employee_no',
        'role_id',
        'division_id',
        'group_id',
        'section_id',
        'created_at',
        'created_by',
        'updated_by',
        'updated_at',
        'active',
        'sub_section_id'
    ];
    public static function SaveRoleMapping($request,$RoleMappArr){ //dd($RoleMappArr);
        //RoleMapping::insert($RoleMappArr);
        return RoleMapping::create($RoleMappArr);
    }
    public static function ShowEmpRole($request,$EmpNo,$RoleId = NULL){
        $EmpQuery = DB::table('erp_role_mapping AS t1')
            ->select('t1.*','t2.office_name AS group','t3.office_name AS division','t3.office_short_name AS division_short_name','t4.office_name AS section','t4.office_short_name AS section_short_name','t5.role_name','t5.module_access','t5.role_group_code','t5.role_dp_order')
            ->join('erp_role AS t5','t1.role_id','=','t5.roleid')
            ->leftJoin("erp_office AS t2",function($join){
                $join->on('t1.group_id', '=', 't2.office_id');
            })
            ->leftJoin("erp_office AS t3",function($join){
                $join->on('t1.division_id', '=', 't3.office_id');
            })
            ->leftJoin("erp_office AS t4",function($join){
                $join->on('t1.section_id', '=', 't4.office_id');
            });
        if($EmpNo != NULL){
            $EmpQuery->where('t1.employee_no',$EmpNo);
        }
        if($RoleId != NULL){
            $EmpQuery->where('t1.role_id','!=',$RoleId);
        }
        $EmpData = $EmpQuery->where('t1.active',1)->get();
        return $EmpData;
    }
    public function ShowRoleMappingByRoleMapId($RoleMapId){
        return RoleMapping::where('role_mapping_id',$RoleMapId)->get();
    }
    public function CheckRoleMapping($RoleMappArr)
    {
        /*return RoleMapping::select('employee_no', 'role_id')
            ->where([
                'employee_no'    => $RoleMappArr['employee_no'],
                'role_id'        => $RoleMappArr['role_id'],
                ])
            ->where('active',1)
            ->get();
            */
        $RoleMappDataArr = array_map(function ($value) {
            return ($value === '') ? null : $value;
        }, $RoleMappArr);
        $RoleData = $this->where($RoleMappDataArr)->get();
        if ($RoleData && is_countable($RoleData) && count($RoleData) > 0) {
            return $RoleData;
        }
        return $RoleData;
    }
    public static function ShowEmployeeByRole($request,$RoleId){
        $RetData = NULL;
        if($RoleId != NULL){
            $RetData = RoleMapping::where('role_id',$RoleId)->where('active',1)->get();
        }
        return $RetData;
    }
    public static function ShowEmployeeByEmpNoRole($EmpNo,$RoleId){
        $RetData = NULL;
        if(($EmpNo != NULL)&&($RoleId != NULL)){
            $RetData = RoleMapping::where('role_id',$RoleId)->where('employee_no',$EmpNo)->where('active',1)->get();
        }
        return $RetData;
    }
    public static function ShowEmpDetails($RoleId,$DivisionId){
        $RoleData = DB::table('erp_role_mapping')
            ->select('erp_role_mapping.*', 'erp_employee.*') 
            ->leftjoin('erp_employee', 'erp_role_mapping.employee_no', '=', 'erp_employee.emp_no');
            if($RoleId && $DivisionId!= NULL){
                $RoleData->where('erp_role_mapping.role_id', '=', $RoleId)->where('erp_role_mapping.division_id', '=', $DivisionId);
            } 
        $RoleData = $RoleData->get();
        return $RoleData;
    }

    public function UpdateRoleMapping($RoleMappArr, $RoleMappId){
        return RoleMapping::where('role_mapping_id', $RoleMappId)->update($RoleMappArr);
    }

    public static function ShowRoleGroupEmpDetails($RoleGroupCodeArr){
        // Here $RoleGroupCodeArr must be an Array
        $EmpData = DB::table('erp_role_mapping AS t1')
            ->select('t1.*','t7.emp_known_as','t7.o_email','t7.o_ext_no','t2.office_name AS group','t2.office_short_name AS group_short_name','t3.office_name AS division','t3.office_short_name AS division_short_name','t4.office_name AS section','t4.office_short_name AS section_short_name','t5.role_name','t5.module_access','t5.role_group_code','t6.office_name AS subsection','t6.office_short_name AS sub_section_short_name')
            ->join('erp_role AS t5','t1.role_id','=','t5.roleid')
            ->join('erp_employee AS t7','t1.employee_no','=','t7.emp_no')
            ->leftJoin("erp_office AS t2",function($join){
                $join->on('t1.group_id', '=', 't2.office_id');
            })
            ->leftJoin("erp_office AS t3",function($join){
                $join->on('t1.division_id', '=', 't3.office_id');
            })
            ->leftJoin("erp_office AS t4",function($join){
                $join->on('t1.section_id', '=', 't4.office_id');
            })
            ->leftJoin("erp_office AS t6",function($join){
                $join->on('t1.sub_section_id', '=', 't6.office_id');
            })
            ->where('t1.active',1)
            ->whereIn('t5.role_group_code',$RoleGroupCodeArr)
            ->get();
        return $EmpData;
    }
    public static function ShowEmpRoleWOActive($request,$EmpNo,$RoleId = NULL){
        $EmpQuery = DB::table('erp_role_mapping AS t1')
            ->select('t1.*','t2.office_name AS group','t3.office_name AS division','t3.office_short_name AS division_short_name','t4.office_name AS section','t4.office_short_name AS section_short_name','t5.role_name','t5.module_access','t5.role_group_code','t5.role_dp_order','t6.office_name AS subsection','t6.office_short_name AS sub_section_short_name')
            ->join('erp_role AS t5','t1.role_id','=','t5.roleid')
            ->leftJoin("erp_office AS t2",function($join){
                $join->on('t1.group_id', '=', 't2.office_id');
            })
            ->leftJoin("erp_office AS t3",function($join){
                $join->on('t1.division_id', '=', 't3.office_id');
            })
            ->leftJoin("erp_office AS t4",function($join){
                $join->on('t1.section_id', '=', 't4.office_id');
            })
            ->leftJoin("erp_office AS t6",function($join){
                $join->on('t1.sub_section_id', '=', 't6.office_id');
            });
        if($EmpNo != NULL){
            $EmpQuery->where('t1.employee_no',$EmpNo);
        }
        if($RoleId != NULL){
            $EmpQuery->where('t1.role_id','!=',$RoleId);
        }
        $EmpData = $EmpQuery->get();
        return $EmpData;
    }
    public static function ShowAllEmpRoleId($request,$EmpNo,$RoleId = NULL){
        $EmpData = DB::table('erp_role_mapping AS t1')
            ->select('t1.*','t2.office_name AS group','t3.office_name AS division','t3.office_short_name AS division_short_name','t4.office_name AS section','t4.office_short_name AS section_short_name','t5.role_name','t5.module_access','t5.role_group_code','t5.role_dp_order','t6.office_name AS subsection','t6.office_short_name AS sub_section_short_name','erp_employee.emp_firstname','erp_employee.emp_lastname','erp_employee.emp_middlename','erp_employee.emp_known_as')
            ->join('erp_role AS t5','t1.role_id','=','t5.roleid')
            ->leftJoin("erp_office AS t2",function($join){
                $join->on('t1.group_id', '=', 't2.office_id');
            })
            ->leftJoin("erp_office AS t3",function($join){
                $join->on('t1.division_id', '=', 't3.office_id');
            })
            ->leftJoin("erp_office AS t4",function($join){
                $join->on('t1.section_id', '=', 't4.office_id');
            })
            ->leftJoin("erp_office AS t6",function($join){
                $join->on('t1.sub_section_id', '=', 't6.office_id');
            })
            ->leftjoin('erp_employee', 't1.employee_no', '=', 'erp_employee.emp_no')
            ->where('t1.role_id',$RoleId)->where('t1.active',1)
            ->orderBy('t1.employee_no','ASC')->get();
        return $EmpData;
    }
    public static function ShowActiveEmpDetails($RoleId,$DivisionId,$Section=NULL){ // created On 30/10/2024
        $RoleData = DB::table('erp_role_mapping AS t1')
        ->select('t1.*','t2.office_name AS group','t3.office_name AS division','t3.office_short_name AS division_short_name','t4.office_name AS section','t4.office_short_name AS section_short_name','t5.role_name','t5.module_access','t5.role_group_code','t5.role_dp_order','t6.office_name AS subsection','t6.office_short_name AS sub_section_short_name','erp_employee.emp_firstname','erp_employee.emp_lastname','erp_employee.emp_middlename','erp_employee.emp_known_as')
        ->join('erp_role AS t5','t1.role_id','=','t5.roleid')
        ->leftJoin("erp_office AS t2",function($join){
            $join->on('t1.group_id', '=', 't2.office_id');
        })
        ->leftJoin("erp_office AS t3",function($join){
            $join->on('t1.division_id', '=', 't3.office_id');
        })
        ->leftJoin("erp_office AS t4",function($join){
            $join->on('t1.section_id', '=', 't4.office_id');
        })
        ->leftJoin("erp_office AS t6",function($join){
            $join->on('t1.sub_section_id', '=', 't6.office_id');
        })
        ->leftjoin('erp_employee', 't1.employee_no', '=', 'erp_employee.emp_no')
        ->where('t1.role_id',$RoleId)->where('t1.active',1);
        if($DivisionId != NULL){
            $RoleData = $RoleData->where('t1.division_id',$DivisionId);
        }
         if($Section != NULL){
            $RoleData = $RoleData->where('t1.section_id',$Section);
        }
        $RoleData = $RoleData->get();
        return $RoleData;
    }
    public static function ShowEmpHeadWise($request,$OfficeId){ //CR 12-03-2025
        $RoleData = DB::table('erp_role_mapping')
        ->select('erp_role_mapping.*')
        ->where(function($query) use ($OfficeId) {
            $query->whereIn('sub_section_id', $OfficeId)
                  ->orWhereIn('section_id', $OfficeId)
                  ->orWhereIn('division_id', $OfficeId)
                  ->orWhereIn('group_id', $OfficeId);
        })
        ->where('active', 1)
        ->orderBy('employee_no', 'ASC')
        ->get();
        return $RoleData;
    }
    public static function ShowRoleNameByEmpNo($request,$EmpNo){
        $ReturnData = NULL;
        if(filled($EmpNo)){
            $ReturnData = RoleMapping::where('erp_role_mapping.active',1)
                ->where('erp_role_mapping.employee_no',$EmpNo)
                ->join('erp_role','erp_role_mapping.role_id','=','erp_role.roleid')
                ->select(
                    'erp_role.*'
                )
                ->get();   
        }
        return $ReturnData;
    }
}
