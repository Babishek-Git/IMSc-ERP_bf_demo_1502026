<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class BudgetAllocation extends Model
{
    use HasFactory;
    protected $table = 'erp_budget_allocation';
    public $timestamps = false;
    protected $primaryKey = 'budget_allocation_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'fin_year',
        'object_head_id',
        'project_id',
        'claim_mode',
        'proposed_amount',
        'proposed_date',
        'sanctioned_amount',
        'sanctioned_date',
        'oh_sub_cata_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'fin_year',
        'budget_sanction_no',
        'gia_id',
        'active',
        'project_parent_id'
    ];

    public function ShowBudegetAllocationAll(){
        return self::where('active', 1)->get();     
    }
    public function ShowBudegetAllocationFinYear($FinYear,$ObjectHeadSubCataId,$ObjectHeadId,$ProjectId){
        return self::where('fin_year', $FinYear)
        ->when($ObjectHeadSubCataId, fn($q) => $q->where('oh_sub_cata_id', $ObjectHeadSubCataId))
        ->when($ObjectHeadId, fn($q) => $q->where('object_head_id', $ObjectHeadId))
        ->when($ProjectId, fn($q) => $q->where('project_id', $ProjectId))
        ->get();  
    }
    public function CreateBudgetAllocation($SaveArr){
        return self::create($SaveArr);
    }
    public static function GetSanctionAmoutByProjId($ProjectId){
        if(filled($ProjectId)){
            return self::where('active', 1)->where('project_id',$ProjectId)->get();
        }
    }
    public static function ShowBudgetAllocationData($GetGiaId,$FinalYear){
        if(filled($FinalYear)){
            return self::where('fin_year', $FinalYear)->where('gia_id',$GetGiaId)->where('active', 1)->get();
        }
    }
    public static function DeativeData ($GetGiaId,$FinalYear){
        if(filled($GetGiaId) && filled($FinalYear)){
            return self::where('fin_year', $FinalYear)->where('gia_id',$GetGiaId)->update(['active' => 0]);
        }
    }
    public static function GetSanctionDetiails($ObjHeadMode, $ObjHeadId, $ObjSubProjId, $GetGiaId,$FinalYear){
        return self::where('gia_id', $GetGiaId)
            ->where('active', 1)
            ->when($ObjSubProjId, function ($query) use ($ObjSubProjId) {
                $query->where('oh_sub_cata_id', $ObjSubProjId);
            })
            ->where('object_head_id', $ObjHeadId)
            ->where('fin_year', $FinalYear)
            ->get();
    }
    
    // public static function GetSanctionDetiails($ObjHeadMode,$ObjHeadId,$ObjSubProjId,$GetGiaId){
    //     if(filled($ObjHeadMode) && $ObjHeadMode ='OHSC' && filled($ObjSubProjId)){
    //         return self::where('gia_id',$GetGiaId)->where('active', 1)->where('oh_sub_cata_id',$ObjSubProjId)->get();
    //     }else{
    //         return self::where('gia_id',$GetGiaId)->where('active', 1)->where('object_head_id',$ObjHeadId)->get();
    //     }
    // }
}