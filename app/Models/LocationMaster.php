<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationMaster extends Model
{
    use HasFactory;
    protected $table = 'erp_location_master';
    public $timestamps = false;
    protected $primaryKey = 'location_id';
    protected $fillable = [
        'location_name',
        'location_sname',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
    public function ShowLocationMaster(){
        return self::get();       
    }
    public function createLocationMaster($EmployeeArr){
        return Self::create($EmployeeArr);
    }
}
