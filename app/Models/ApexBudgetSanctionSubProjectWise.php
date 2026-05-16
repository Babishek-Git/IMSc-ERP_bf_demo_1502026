<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class ApexBudgetSanctionSubProjectWise extends Model
{
    use HasFactory;
    protected $table = 'erp_apex_budget_sanction_sub_project_wise';
    public $timestamps = false;
    protected $primaryKey = 'budget_sanction_sub_proj_dt_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'budget_sanction_id',
        'apex_project_id',
        'project_id',
        'object_head_id',
        'object_head_sub_cata_id',
        'gia_id',
        'sub_proj_sanctioned_amount',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'active'
    ];

    public function ShowApexSanction(){
        return self::where('active', 1)->get();     
    }
    public function CreateApexBudgetSanction($SancDataArr){
        return self::create($SancDataArr);
    }
    public function MultipleDeleteApexSanctionByProjectId($ApexProjectId){
        return self::whereIn('apex_project_id', $ApexProjectId)->delete();     
    }
    public function ShowMultipleApexSanctionSubProjectWise($ApexProjectIdList){
        return self::whereIn('apex_project_id', $ApexProjectIdList)->get();    
    }
    public function ShowApexSanctionByProjectSubProjectWise($GiaId,$ProjectId,$ParentProjectId){
        return self::where('gia_id', $GiaId)->where('apex_project_id', $ParentProjectId)->where('project_id', $ProjectId)->get();    
    }

}