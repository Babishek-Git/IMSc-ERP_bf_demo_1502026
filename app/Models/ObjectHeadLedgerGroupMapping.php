<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectHeadLedgerGroupMapping extends Model
{
    use HasFactory;
    protected $table = 'erp_object_head_ledger_group_mapping';
    public $timestamps = false;
    protected $primaryKey = 'ohl_mapping_id';
    protected $fillable = [
        'ledger_id',
        'ledger_group_id',
        'object_head_id',
        'object_head_sub_cata_id',
        'project_id',
        'gia_id',
        'oh_gia_mapp_id',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'applicable_emp_group'
    ];
    public static function CreateOBHledgerGroupMapping($request,$SaveDtData,$OhMpId){
        /*$RetSaveData = NULL;
        if(filled($OhMpId) && filled($SaveDtData)){
            $RetSaveData = ObjectHeadLedgerGroupMapping::where('object_head_grouop_id',$OhMpId)->update($SaveDtData);
        }else if(filled($SaveDtData)){
            $RetSaveData = ObjectHeadLedgerGroupMapping::create($SaveDtData);
        }*/
        return self::create($SaveDtData);
    }
    public static function ShowOBHLegerData(){
        return self::where('active',1)->get();
    }
    public static function DeleteOBHledgerGroupMapping(){
        return self:: where('active',1)->delete();
    }

}
