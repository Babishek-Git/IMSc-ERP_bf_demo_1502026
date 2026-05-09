<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectStaff extends Model
{
    use HasFactory;
    protected $table = 'erp_project_staff';
    public $timestamps = false;
    protected $primaryKey = 'project_id';
    protected $fillable = [
        'project_staff_id',
        'project_id',
        'emp_no',
        'is_head',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'emp_group_id',
        'project_investigator'
    ];
    public function ShowProjectHead()
    {
        $ProjectstaffData = self::join('erp_project','erp_project.project_id', '=', 'erp_project_staff.project_id')
                            ->leftjoin('erp_employee','erp_employee.emp_no', '=', 'erp_project_staff.emp_no')->get();
        return $ProjectstaffData;        
    }
    public function createProjectHead($ProjectArr){
        return self::create($ProjectArr);
    }
    public function CheckProjectStaff($EmpNo,$ProjectId){
        return self::select('project_id')->where('emp_no',$EmpNo)->where('project_id',$ProjectId)->get();
    }
    public static function ShowSessionWiseCurrentProject($request){
        return self::join('erp_project', 'erp_project_staff.project_id', '=', 'erp_project.project_id')
            ->where('erp_project_staff.active', 1)
            ->where('erp_project_staff.emp_no', session('WcmsEmpNo'))
            ->select(
            'erp_project_staff.*', 
            'erp_project.*'
            )
            ->get();
    }
    public static function StaffProjectByProjectId($ProjectId){
        if(filled($ProjectId)){
            return self::where('project_id', $ProjectId)->where('active','1')->get();
        }
    }
    public static function DeactivateStaffProject($ProjectId){
        if (filled($ProjectId)) {
            return self::where('project_id', $ProjectId)->update(['active' => 0]);
        }
    }
   /* public function updateProjectMaster($ProArr,$ProjectId){
        return ProjectMaster::where('project_id', $ProjectId)->Update($ProArr);
    }   */
    
    /*public function CheckDesign($AAIISDesign){
        if($AAIISDesign != NULL){
            return designation::select('designation_name')->where('designation_name',$AAIISDesign)->get();
        }else{
            return designation::select('designation_name')->get();
        }
    }*/
}
