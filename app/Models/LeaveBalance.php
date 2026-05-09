<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveBalance extends Model
{
    use HasFactory;
    protected $table = 'erp_emp_leave_balances';
    public $timestamps = false;
    protected $primaryKey = 'emp_leave_bal_id';
    protected $fillable = [
        'emp_no',
        'leave_type_id',
        'balance',
        'total_availed_service',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'year'
    ];
    protected $attributes = [
        'balance'               => 0,   // ← default so it's never null
        'total_availed_service' => 0,
    ];
    public function ShowLeaveMaster(){
        return self::get();
    }
    public function ShowEmpLeaveBalanceByYear($EmpNo,$LeaveTypeArr,$LeaveYear){
        if((filled($LeaveTypeArr))&&(filled($EmpNo))){
            return self::where('emp_no',$EmpNo)->whereIn('leave_type_id',$LeaveTypeArr)->where('leave_year',$LeaveYear)->get();
        }else{
            return NULL;
        }
    }
    public function CreateLeaveBalance($EmployeeArr){
        return self::create($EmployeeArr);
    }
    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id'); // adjust FK if needed
    }

    public function deleteLeaveBalance($EmpNo, $year){
        return self::where('emp_no',$EmpNo)->where('year',$year)->delete();
    }
  
}
