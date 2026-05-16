<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class ApexBudgetSanctionObjectHeadFinYearWise extends Model
{
    use HasFactory;
    protected $table = 'erp_apex_budget_sanction_object_head_fy_wise';
    public $timestamps = false;
    protected $primaryKey = 'budget_sanction_dt_fy_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'budget_sanction_id',
        'apex_project_id',
        'object_head_id',
        'object_head_sub_cata_id',
        'gia_id',
        'oh_fy_sanctioned_amount',
        'fin_year',
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
    public function DeleteApexSanctionByProjectId($ApexProjectId,$FinYear){
        return self::where('apex_project_id', $ApexProjectId)->where('fin_year', $FinYear)->delete();     
    }
    public function ShowMultipleApexSanctionObjectHeadWise($ApexProjectIdList,$FinYear){
        return self::whereIn('apex_project_id', $ApexProjectIdList)->where('fin_year', $FinYear)->get();    
    }
}