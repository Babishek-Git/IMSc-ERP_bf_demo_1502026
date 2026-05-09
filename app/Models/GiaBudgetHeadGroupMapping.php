<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiaBudgetHeadGroupMapping extends Model
{
    
    use HasFactory;
    protected $table = 'erp_gia_object_head_group_mapping';
    public $timestamps = false;
    protected $primaryKey = 'gohg_mapping_id';
    protected $fillable = [
        'gia_id',
        'object_head_grouop_id',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
    public static function CreateProjectHeadGroupMapping($request,$SaveDtData,$OhMpId){
        $RetSaveData = NULL;
        if(filled($OhMpId) && filled($SaveDtData)){
            $RetSaveData = ProjectHeadGroupMapping::where('gohg_mapping_id',$OhMpId)->update($SaveDtData);
        }else if(filled($SaveDtData)){
            $RetSaveData = ProjectHeadGroupMapping::create($SaveDtData);
        }
        return $RetSaveData;
    }
    public static function ShowProjectHeadData($request){
        return ProjectHeadGroupMapping::where('active',1)->get();
    }
    public static function DeleteProjectHeadMapping($request){
        return ProjectHeadGroupMapping:: where('active',1)->delete();
    }
    
}
