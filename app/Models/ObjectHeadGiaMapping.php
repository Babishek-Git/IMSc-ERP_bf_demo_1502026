<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectHeadGiaMapping extends Model
{
    use HasFactory;
    protected $table = 'erp_object_head_gia_mapping';
    public $timestamps = false;
    protected $primaryKey = 'oh_gia_mapp_id';
    protected $fillable = [
        'gia_id',
        'object_head_id',
        'fin_year',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'project_id',
        'is_sup_cata_applicable'
    ];
    public static function CreateObjectHeadGiaMapping($SaveData){
        return ObjectHeadGiaMapping::create($SaveData);
    }
    public static function UpdateObjectHeadGiaMapping($SaveData,$OHGiaMappId){
        return ObjectHeadGiaMapping::where('oh_gia_mapp_id',$OHGiaMappId)->update($SaveData);
    }
    public static function ShowObjectHeadGiaMapping($OHGiaMappId){
        if($OHGiaMappId != NULL){
            return ObjectHeadGiaMapping::where('oh_gia_mapp_id',$OHGiaMappId)->get();
        }else{
            return ObjectHeadGiaMapping::get();
        }
    }
    public static function ShowObjectHeadSubCategoryDataByGiaId($GiandId){
        if (filled($GiandId)) {
            return ObjectHeadGiaMapping::query()
                ->leftJoin('erp_object_head_sub_cata as sub', function ($join) {
                    $join->on('sub.object_head_id', '=', 'erp_object_head_gia_mapping.object_head_id')
                        ->where('erp_object_head_gia_mapping.is_sup_cata_applicable', 'true');
                })
                ->where('erp_object_head_gia_mapping.gia_id', $GiandId)
                ->where('erp_object_head_gia_mapping.active', 1)
                ->select(
                    'erp_object_head_gia_mapping.*',
                    'sub.oh_sub_cata_id',
                    'sub.oh_sub_cata_name',
                    'sub.oh_sub_cata_code'
                )->get();
        }
    }
    public static function ShowObjectHeadDataByGiaId($GiandId){
        if (filled($GiandId)) {
            return self::where('gia_id',$GiandId)->where('active',1)->get();
        }
    }
    public static function ShowObjectHeadDataByGiaIdAndProjId($GiandId,$ProjId){
        if (filled($GiandId) && filled($ProjId)) {
            return self::where('gia_id',$GiandId)->where('active',1)->whereIn('project_id',$ProjId)->get();
        }else if(filled($ProjId)){
            return self::where('project_id',$ProjId)->where('active',1)->get();
        }
    }
    public static function ShowObjectHeadDataByGiaIdAndOHId($ObjHeadId){
        if(filled($ObjHeadId)){
            return self::where('object_head_id',$ObjHeadId)->where('active',1)->get();
        }
    }
    // public static function ShowObjectHeadDataByGiaId($GiandId){
    //     if (filled($GiandId)) {
    //         return ObjectHeadGiaMapping::query()
    //             ->leftJoin('erp_object_head as Objhead', function ($join) {
    //                 $join->on('Objhead.object_head_id', '=', 'erp_object_head_gia_mapping.object_head_id')
    //                     ->where('erp_object_head_gia_mapping.is_sup_cata_applicable', 'false');
    //             })
    //             ->where('erp_object_head_gia_mapping.gia_id', $GiandId)
    //             ->where('erp_object_head_gia_mapping.active', 1)
    //             ->select(
    //                 'erp_object_head_gia_mapping.*',
    //                 'Objhead.object_head_id',
    //                 'Objhead.object_head_name',
    //                 'Objhead.object_head_code'
    //             )->get();
    //     }

    // }
}
