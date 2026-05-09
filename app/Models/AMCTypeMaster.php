<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AMCTypeMaster extends Model
{
    use HasFactory;
    protected $table = 'erp_amc_type';
    public $timestamps = false;
    protected $primaryKey = 'amctypeid';
    protected $fillable = [
        'amc_type_name',
        'amc_type_code',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public static function GetAMCType(){
        return self::where('active',1)->get();
    }
}
