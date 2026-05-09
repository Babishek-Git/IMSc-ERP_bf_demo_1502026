<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class AMCType extends Model
{
    use HasFactory;
	protected $table = 'erp_amc_type';
	public $timestamps = false;
    protected $primaryKey = 'amc_type_id';
    protected $fillable = [
        'amc_type',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public function CreateAMCType($InsertArr){
        return self::create($InsertArr);
    }
    public function ShowAMCType() {
        return self::get() ;
    } 
}
