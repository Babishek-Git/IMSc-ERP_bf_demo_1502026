<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class role_group extends Model
{
    use HasFactory;
    protected $table = 'erp_role_group';
    public $timestamps = false;
    protected $primaryKey = 'role_group_id';
    protected $fillable = [
        'role_group_code',
        'role_group_name',
        'active'
    ];
    public static function ShowRoleGroup($request,$RoleGroupCode){
        if($RoleGroupCode != NULL){
            return role_group::where('role_group_code',$RoleGroupCode)->get();
        }else{
            return role_group::get();
        }
    }
   
}
