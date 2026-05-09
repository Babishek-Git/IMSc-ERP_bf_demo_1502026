<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkFlowMovement extends Model
{
    use HasFactory;
	protected $table = 'erp_work_flow_transaction'; 
    public $timestamps = false;
    protected $primaryKey = 'work_move_id';
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
        'updated_by',
        'current_data'
    ];
    public static function SaveWorkMovement($request,$SaveData){
        return self::create($SaveData);
    }
    public static function UpdateWorkMovement($WorkMoveId,$SaveData){
        return self::where('work_move_id',$WorkMoveId)->update($SaveData);
    }
    public static function ShowWorkMovement($request,$TransactionId,$ModuleCode){
        return self::where('active',1)->where('transaction_id',$TransactionId)->where('wf_module_code',$ModuleCode)->orderBy('created_at','ASC')->get();
    }
    public static function ShowLatestWorkMovement($request,$TransactionId,$ModuleCode){
        return self::where('active',1)->where('transaction_id',$TransactionId)->where('wf_module_code',$ModuleCode)->orderBy('work_move_id','DESC')->limit(1)->get();
    }
  public static function ShowAllMaxWorkMovement($request, $ModuleCode){
    if (filled($ModuleCode)) {
        return self::where('active', 1)
            ->whereIn('work_move_id', function ($query) use ($ModuleCode) {
                $query->selectRaw('MAX(work_move_id)')
                    ->from('erp_work_flow_transaction')
                    ->where('active', 1)
                    ->where('wf_module_code', $ModuleCode)
                    ->groupBy('transaction_id');
            })
            ->get();
    } else {
        return self::where('active', 1)
            ->whereIn('work_move_id', function ($query) {
                $query->selectRaw('MAX(work_move_id)')
                    ->from('erp_work_flow_transaction')
                    ->where('active', 1)
                    ->groupBy('transaction_id');
            })
            ->get();
    }
}
    
    
}
