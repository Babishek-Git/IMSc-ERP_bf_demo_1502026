<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;  

class LeaveTransaction extends Model
{
    use HasFactory;
    protected $table = 'erp_emp_leave_transactions';
    public $timestamps = false;
    protected $primaryKey = 'leave_transactions_id';
    protected $fillable = [
        'emp_no',
        'leave_type_id',
        'leave_application_id',
        'transaction_type',
        'amount',
        'balance_before',
        'balance_after',
        'remarks',
        'reference_no',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'        
    ];
    public function ShowLeaveTransaction()
    {
        return self::where('active',1)->orderBy('applied_date','ASC')->get();
    }
    public function CreateLeaveTransaction($EmpLeaveData){
        return self::create($EmpLeaveData);
    }
    
}
