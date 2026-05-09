<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePayBank extends Model
{
    use HasFactory;
    protected $table = 'erp_employee_bank_acc_dt';
    public $timestamps = false;
    protected $primaryKey = 'emp_bank_dt_id';
    protected $fillable = [
        'emp_no',
        'bank_id',
        'branch_id',
        'account_no',
        'account_holder_name',
        'is_current',
        'effective_date',
        'end_date',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'


    ];
    public function employeePayBank($EmpNo){
        if($EmpNo != NULL){
            return self::join('erp_bank_master','erp_bank_master.bank_id', '=', 'erp_employee_bank_acc_dt.bank_id')->join('erp_bank_branch_master','erp_bank_branch_master.branch_id', '=', 'erp_employee_bank_acc_dt.branch_id')->where('emp_no',$EmpNo)->get();
        }else{
            return self::where('active', 1)->get();
        }
    }
    public function createEmployeePayBank($EmployArr){
        return self::create($EmployArr);
    }
    public function multipleEmployeeBank($EmpNoArr){
        return filled($EmpNoArr) ? self::whereIn('emp_no',$EmpNoArr)->where('active', 1)->where('is_current', true)->get() : NULL;
    }
    public function deleteEmployeePayBank($EmpNo){
        return self::where('emp_no',$EmpNo)->delete();
    }
}
