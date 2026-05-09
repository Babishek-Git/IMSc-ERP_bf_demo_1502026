<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpLeaveBalance extends Model
{
    use HasFactory;
    protected $table = 'erp_emp_leave_bal';
    public $timestamps = false;
    protected $primaryKey = 'leave_bal_id';
    protected $fillable = [
        'emp_no',
        'leave_type_id',
        'leave_bal_in_service',
        'leave_bal_in_year',
        'leave_year',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
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
  
}
