<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class ProjectMaster extends Model
{
    use HasFactory;
    protected $table = 'erp_project';
    public $timestamps = false;
    protected $primaryKey = 'project_id';
    protected $fillable = [
        'project_name',
        'project_duration',
        'project_duration_mode',
        'project_start_at',
        'project_end_at',
        'project_status',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'project_for',
        'project_type',
        'project_parentid'
    ];
    public function ShowGrandParent($request){
        return self::where('project_parentid', 0)->orderBy('project_parentid', 'asc')->get();
    }
    public function GetProjectGroup($ProjectGroupId){
        return self::where('project_parentid', $ProjectGroupId)->where('active', 1)->orderBy('project_parentid', 'asc')->get();
    }
    public function ShowProjectMaster($ProjectId)
    {
        if($ProjectId != NULL){
            $ProjectData = self::where('project_id',$ProjectId)->where('project_parentid', 0)->get();
        }else{
            $ProjectData = self::where('active',1)->where('project_parentid', 0)->orderBy('project_id', 'asc')->get();
        }
        return $ProjectData;        
    }

    public function ShowSubProjectMaster($ProjectId)
    {
        if($ProjectId != NULL){
            $SubProjectData = self::where('project_id',$ProjectId)->where('project_parentid', '!=', 0)->get();
        }else{
            $SubProjectData = self::where('active',1)->where('project_parentid', '!=', 0)->get();
        }
        return $SubProjectData;        
    }

    public function createProjectMaster($ProjectArr){
        return self::create($ProjectArr);
    }
    public function updateProjectMaster($ProArr,$ProjectId){
        return self::where('project_id', $ProjectId)->Update($ProArr);
    }  
    public function getProjectTypeLabelAttribute()
    {
        return [
            'INT' => 'Internal',
            'EXT' => 'External'
        ][$this->project_type] ?? '-';
    }
    public function ShowProjectMasterWithProjectType(){
       return self::where('project_type','EXT')->get();
    }
    public function ShowAllParentChild(){
        $ProjectHeads = DB::select("
            WITH RECURSIVE category_tree AS (
                SELECT 
                    project_id,
                    project_parentid,
                    project_name,
                    project_name::text AS full_heads
                FROM erp_project
                WHERE project_parentid = 0

                UNION ALL

                SELECT 
                    c.project_id,
                    c.project_parentid,
                    c.project_name,
                    ct.full_heads || ' / ' || c.project_name
                FROM erp_project c
                JOIN category_tree ct 
                ON c.project_parentid = ct.project_id
            )

            SELECT ct.project_id, ct.full_heads
            FROM category_tree ct
            WHERE NOT EXISTS (
                SELECT 1 
                FROM erp_project c
                WHERE c.project_parentid = ct.project_id
            )
            ORDER BY ct.full_heads
        ");

        return $ProjectHeads;
    }
    public static function GetAllProjectData($request){
        return self::where('active',1)->orderBy('project_id', 'asc')->get();
    }
    public function AllLeafNodesOnly(){
        $LeafNodes = DB::table('erp_project as e')
                    ->whereNotExists(function ($query) {
                        $query->select(DB::raw(1))
                            ->from('erp_project as child')
                            ->whereColumn('child.project_parentid', 'e.project_id');
                    })
                    ->select('e.*')
                    ->get();
        return $LeafNodes;
    }
    // public function getGrandParentData($LeafNodeId){
    //     $ProjectData = DB::select("
    //         WITH RECURSIVE hierarchy AS (
    //             SELECT * FROM erp_project WHERE project_id = ?
                
    //             UNION ALL

    //             SELECT t.* FROM erp_project t
    //             INNER JOIN hierarchy h ON t.project_id = h.project_parentid
    //         )
    //         SELECT * FROM hierarchy WHERE project_parentid = 0
    //     ", [$LeafNodeId]);

    //     if(!empty($ProjectData)) {
    //         $GrandParData = $ProjectData[0]; 
    //     }else{
    //         $GrandParData = NULL;
    //     }
    //     return $GrandParData;
    // }
    public function parent(){
        return $this->belongsTo(ProjectMaster::class, 'project_parentid');
    }
    public function getGrandParentData($ChildId){
        $node      = $this->find($ChildId);
        $parentIds = [];
        if(isset($node->parent)){
            while ($node->parent) {
                $parentIds[] = $node->parent->project_id;
                $node        = $node->parent;
            }
        }
        return ($parentIds);
    }
    public static function GetAllParentProjectData($ProjectType){
        return self::where('active',1)->where('project_parentid',0)->where('project_type',$ProjectType)->orderBy('project_id', 'asc')->get();
    }

    public function ShowMultipleProjectById($ProjectIdArr)
    {
        return self::whereIn('project_id',$ProjectIdArr)->get();
    }

    public function GetRootParent($ProjectId){
        $Project = self::find($ProjectId);
        while ($Project && $Project->parent) {
            $Project = $Project->parent;
        }
        return $Project;
    }
   
}
