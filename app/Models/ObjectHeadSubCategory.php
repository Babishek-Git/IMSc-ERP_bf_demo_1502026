<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectHeadSubCategory extends Model
{
    use HasFactory;
    protected $table = 'erp_object_head_sub_cata';
    public $timestamps = false;
    protected $primaryKey = 'oh_sub_cata_id';
    protected $fillable = [
        'oh_sub_cata_code',
        'oh_sub_cata_name',
        'object_head_id',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
    public static function CreateObjectHeadSubCata($SaveData){
        return self::create($SaveData);
    }
    public static function UpdateObjectHeadSubCata($SaveData,$OHSubCataId){
        return self::where('oh_sub_cata_id',$OHSubCataId)->update($SaveData);
    }
    public static function ShowObjectHeadSubCata($OHSubCataId){
        if($OHSubCataId != NULL){
            return self::where('oh_sub_cata_id',$OHSubCataId)->get();
        }else{
            return self::get();
        }
    }
    public function ShowMultipleObjectHeadSubCataById($OHSubCataIdArr)
    {
        return self::whereIn('oh_sub_cata_id',$OHSubCataIdArr)->get();
    }
}
