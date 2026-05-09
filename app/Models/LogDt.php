<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;  

class LogDt extends Model
{
    use HasFactory;
    protected $table = 'erp_log_dt';
    public $timestamps = false;
    protected $primaryKey = 'log_id';
    protected $fillable = [
        'module_code',
        'table_name',
        'model_name',
        'old_value',
        'new_value',
        'transaction_id',
        'action',
        'remarks',
        'action_done_by',
        'action_done_on',
        'ip_address',
        'cont_fuc_name'
    ];
    public function ShowLog()
    {
        return self::orderBy('action_done_on','ASC')->get();
    }
    public function CreateLogDt($LogData){
        return self::create($LogData);
    }
    
}
