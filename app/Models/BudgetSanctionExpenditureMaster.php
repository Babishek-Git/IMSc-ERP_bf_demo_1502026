<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetSanctionExpenditureMaster extends Model
{
    use HasFactory;
     protected $table = 'erp_budget_sanction_expenditure';
    public $timestamps = false;
    protected $primaryKey = 'budget_exp_id';
    protected $fillable = [
        'transaction_id',
        'budget_sanction_id',
        'current_stage',
        'total_sanction_amt',
        'upto_sanction_amt',
        'current_sanction_amt',
        'balance_amt',
        'upto_prev_sanction_amt',
        'module_code',
        'upto_sanction_amt',
        'upto_sanction_amt',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'project_to',
        'project_type',
        'gia_id',
        'project_id',
        'project_parent_id',
        'object_head_id',
        'oh_sub_cata_id',
        'budget_allocation_id',
        'proj_upto_dt_utilized_amt',
        'proj_balance_amt',
        'oh_upto_dt_utilized_amt',
        'oh_balance_amt',
        'current_utilized_amt',
        'is_current'
    ];
    public static function BudgetExpDetatilsCreate($SaveArr){
        return self::create($SaveArr);
    }
    public static function BudSanExpsBYSanIdAndModCodeData($request,$BudgetSanctionId,$ModuleCode,$StageCode){
        $RetData = NULL;
        if(filled($BudgetSanctionId)){
            $RetData = BudgetSanctionExpenditureMaster::where('module_code',$ModuleCode)->where('budget_sanction_id',$BudgetSanctionId)->where('current_stage',$StageCode)->where('active',1)->get();
        }
        return $RetData;
    }
    public static function GetBudgetExpDataBYProjIds($ProjId,$GetParentData){
        if(filled($ProjId) && filled($GetParentData)){
            return self::where('project_id',$ProjId)->where('project_parent_id',$GetParentData)->where('active','1')->get();
        }
    }
    public static function GetBudgetExpDataBYOHIds($ObjHeadId, $ObjSubCatId){
        return self::where('object_head_id', $ObjHeadId)
            ->when($ObjSubCatId, function ($query) use ($ObjSubCatId) {
                $query->where('oh_sub_cata_id', $ObjSubCatId);
            })
            ->where('active', '1')
            ->where('is_current', true)
            ->get();
    }
    public static function ShowBudgetExpData($TransactionId,$ModuleCode){
        if(filled($TransactionId)){
            return self::where('module_code',$ModuleCode)->where('transaction_id',$TransactionId)->where('active','1')->get();
        }
    }
    public static function DeleteBudgetExp($TransactionId,$ModuleCode){
        if(filled($TransactionId)){
            return self::where('module_code',$ModuleCode)->where('transaction_id',$TransactionId)->delete();
        }
    }
    // public static function GetBudgetExpDataBYOHIds($ObjHeadId,$ObjSubCatId){
    //     if(filled($ObjHeadId) && filled($ObjSubCatId)){
    //         return self::where('object_head_id',$ObjHeadId)->where('oh_sub_cata_id',$ObjSubCatId)->where('active','1')->get();
    //     }else{
    //         return self::where('object_head_id',$ObjHeadId)->where('active','1')->get();
    //     }
    // }
}
