<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePayLevel extends Model
{
    use HasFactory;
    protected $table = 'erp_employee_pay_level';
    public $timestamps = false;
    protected $primaryKey = 'emp_pay_level_id';
    protected $fillable = [
        'emp_no',
        'pay_level',
        'basic_salary',
        'effective_date',
        'end_date',
        'is_current',
        'next_increment_dt',
        'prev_increment_dt',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public function ShowEmployeePayLevelByEmpno($EmpNo){ 
    $Payleveldata = self::from('erp_employee_pay_level as p1')
                    ->leftJoin('erp_employee','erp_employee.emp_no','=','p1.emp_no')
                    ->where('p1.emp_no',$EmpNo)
                    ->get();
    return $Payleveldata;
    }
    public function employeeCurrentPayLevel(){
        return self::where('is_current', true)->get();
    }
    public function createEmployeeCurrentPayLevel($EmployArr){
        return self::create($EmployArr);
    }
    public function multipleEmployeePayLevel($EmpNoArr){
        return filled($EmpNoArr) ? self::whereIn('emp_no',$EmpNoArr)->where('active', 1)->where('is_current', true)->get() : NULL;
    }
    public function deleteEmployeePayLevel($EmpNo){
        return self::where('emp_no',$EmpNo)->delete();
    }
    public function showEmployeeCurrentPayLevel($EmpNo){
        return self::where('emp_no', $EmpNo)->where('is_current', true)->first();
    }
}
