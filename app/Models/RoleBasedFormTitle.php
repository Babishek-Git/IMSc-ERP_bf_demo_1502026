<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleBasedFormTitle extends Model
{
    use HasFactory;
    protected $table      = 'erp_form_title';
    public $timestamps    = false;
    protected $primaryKey = 'form_titte_id';
    protected $fillable   = [
        'module_code',
        'tittel_name',
        'role_id',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public static function GetRoleBaseTittel($request,$ModuleCode){
        return RoleBasedFormTitle::where('active',1)->where('module_code',$ModuleCode)->where('role_id',session('WcmsEmpRoleId'))->get();
    }
}
