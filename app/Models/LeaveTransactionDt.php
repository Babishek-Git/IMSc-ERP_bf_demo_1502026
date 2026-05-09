<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;  

class LeaveTransactionDt extends Model
{
    use HasFactory;
    protected $table = 'erp_emp_leave_transaction_dt';
    public $timestamps = false;
    protected $primaryKey = 'leave_transaction_dt_id';
    protected $fillable = [
        'leave_transaction_id',
        'leave_type_id',
        'leave_type_code',
        'from_date',
        'to_date',
        'no_of_days',
        'reason',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public function ShowLeaveTransactionDt()
    {
        return self::where('active',1)->orderBy('leave_transaction_id','ASC')->get();
    }
    public function CreateLeaveTransactionDt($EmpLeaveDtData){
        return self::create($EmpLeaveDtData);
    }
    
}
