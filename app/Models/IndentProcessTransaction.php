<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndentProcessTransaction extends Model
{
    use HasFactory;
    protected $table = 'erp_indent_process_transactions'; 
    public $timestamps = false;
    protected $primaryKey = 'process_move_id';
    protected $fillable = [
        'transaction_id',
        'wf_module_code',
        'wf_moduleid',
        'wf_from_emp_no',
        'wf_to_emp_no',
        'wf_from_role',
        'wf_to_role',
        'role_mapping_id',
        'status',
        'action_flag',
        'role_position',
        'remarks',
        'current_data',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public static function CreateProcessData($IndentArr){
        return self::create($IndentArr);
    }
    public static function GetIndentProceesData(){
        return self::where('active',1)->distinct('transaction_id')->get();
    }
    public static function GetIndentTranscationData($IndentId){
        if($IndentId != NULL){
        return self::where('active',1)->where('transaction_id',$IndentId)->orderby('process_move_id','DESC')->get();
        }
    }
}
