<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetHeadLedgerGroupMapping extends Model
{
    use HasFactory;
    protected $table = 'erp_object_head_ledger_group_mapping';
    public $timestamps = false;
    protected $primaryKey = 'ohl_mapping_id';
    protected $fillable = [
        'object_head_grouop_id',
        'ledger_group_id',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
    public static function CreateOBHledgerGroupMapping($request,$SaveDtData,$OhMpId){
        $RetSaveData = NULL;
        if(filled($OhMpId) && filled($SaveDtData)){
            $RetSaveData = ObjectHeadLedgerGroupMapping::where('object_head_grouop_id',$OhMpId)->update($SaveDtData);
        }else if(filled($SaveDtData)){
            $RetSaveData = ObjectHeadLedgerGroupMapping::create($SaveDtData);
        }
        return $RetSaveData;
    }
    public static function ShowOBHLegerData($request){
        return ObjectHeadLedgerGroupMapping::where('active',1)->get();
    }
    public static function DeleteOBHledgerGroupMapping($request){
        return ObjectHeadLedgerGroupMapping:: where('active',1)->delete();
    }

}
