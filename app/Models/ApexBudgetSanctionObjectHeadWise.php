<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class ApexBudgetSanctionObjectHeadWise extends Model
{
    use HasFactory;
    protected $table = 'erp_apex_budget_sanction_object_head_wise';
    public $timestamps = false;
    protected $primaryKey = 'budget_sanction_dt_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'budget_sanction_id',
        'apex_project_id',
        'object_head_id',
        'object_head_sub_cata_id',
        'gia_id',
        'oh_sanctioned_amount',
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
    public function DeleteApexSanctionByProjectId($ApexProjectId){
        return self::where('apex_project_id', $ApexProjectId)->delete();     
    }
    public function ShowMultipleApexSanctionObjectHeadWise($ApexProjectIdList){
        return self::whereIn('apex_project_id', $ApexProjectIdList)->get();    
    }
}