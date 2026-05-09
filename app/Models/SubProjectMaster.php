<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubProjectMaster extends Model
{
    use HasFactory;
    protected $table = 'erp_subproject';
    public $timestamps = false;
    protected $primaryKey = 'subproject_id';
    protected $fillable = [
        'project_id',
        'subproject_name',
        'subproject_duration',
        'subproject_duration_mode',
        'subproject_start_at',
        'subproject_end_at',
        'subproject_status',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        
    ];
    public function ShowSubProjectMaster($ProjectId)
    {
        if($ProjectId != NULL){
            $ProjectData = self::where('subproject_id',$ProjectId)->get();
        }else{
            $ProjectData = self::join('erp_project','erp_project.project_id', '=', 'erp_subproject.project_id')->get();
        }
        return $ProjectData;        
    }
    public function createSubProjectMaster($ProjectArr){
        return self::create($ProjectArr);
    }
    public function updateSubProjectMaster($ProArr,$ProjectId){
        return self::where('project_id', $ProjectId)->Update($ProArr);
    }  
    public function ShowSubProjectMasterwithProjectName($ProjectId)
    {
      return self::where('project_id',$ProjectId)->get();
    }
    
    // public function getProjectTypeLabelAttribute()
    // {
    //     return [
    //         'INT' => 'Internal',
    //         'EXT' => 'External'
    //     ][$this->project_type] ?? '-';
    // }
}
