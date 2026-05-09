<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AMCProvidesBaseMaster extends Model
{
    use HasFactory;
    protected $table = 'erp_amc_provided_basis';
    public $timestamps = false;
    protected $primaryKey = 'amc_prov_base_id';
    protected $fillable = [
        'amc_prov_base_name',
        'amc_prov_base_code',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public static function GetAMCprovidedBaseOn(){
        return self::where('active',1)->get();
    }
}
