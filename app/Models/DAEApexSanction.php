<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class DAEApexSanction extends Model
{
    use HasFactory;
    protected $table = 'erp_dae_apex_sanction_master';
    public $timestamps = false;
    protected $primaryKey = 'dae_apex_sanction_id';
    protected $fillable = [
        'dae_apex_sanction_amount',
        'dae_apex_sanction_date',
        'dae_apex_sanction_no',
        'rbi_date',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public function ShowDAEApexSanction(){
        return self :: get();        
    }
    public function CreateDAEApexSanction($SancArr){
        return self::create($SancArr);
    }
   
}
        