<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldAccesMaster extends Model
{
    use HasFactory;
    protected $table = 'erp_field_access';
    public $timestamps = false;
    protected $primaryKey = 'field_access_id';
    protected $fillable = [
        'module_code',
        'field_name',
        'role_id',
        'mat_type_id',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public static function ShowSessionRoleWiseFieldData ($request,$ModuleCode,$FieldName){
        $RetFieldData = NULL;
        if(filled($ModuleCode) && filled($FieldName)){
            $RetFieldData = FieldAccesMaster::where('module_code',$ModuleCode)->where('field_name',$FieldName)->where('active',1)->where('role_id',session('WcmsEmpRoleId'))->get();
        }
        return $RetFieldData;
    }
    public static function GetSessionWiseItemviewAccess($request,$ModuleCode,$FieldName,$MatTypeId){
         $RetFieldData = NULL;
        if(filled($ModuleCode) && filled($FieldName) && filled($MatTypeId)){
            $RetFieldData = FieldAccesMaster::where('module_code',$ModuleCode)->where('mat_type_id',$MatTypeId)->where('field_name',$FieldName)->where('active',1)->where('role_id',session('WcmsEmpRoleId'))->get();
        }
        return $RetFieldData;
    }
}
