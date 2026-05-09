<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectHead extends Model
{
    use HasFactory;
    protected $table = 'erp_object_head';
    public $timestamps = false;
    protected $primaryKey = 'object_head_id';
    protected $fillable = [
        'object_head_name',
        'object_head_code',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public static function CreateObjectHead($SaveData){
        return ObjectHead::create($SaveData);
    }
    public static function UpdateObjectHead($SaveData,$ObjectHeadId){
        return ObjectHead::where('object_head_id',$ObjectHeadId)->update($SaveData);
    }
    public static function ShowObjectHead($ObjectHeadId){
        if($ObjectHeadId != NULL){
            return ObjectHead::where('object_head_id',$ObjectHeadId)->get();
        }else{
            return ObjectHead::get();
        }
    }
    public function ShowMultipleObjectHeadById($ObjectHeadIdArr)
    {
        return self::whereIn('object_head_id',$ObjectHeadIdArr)->get();
    }
}
