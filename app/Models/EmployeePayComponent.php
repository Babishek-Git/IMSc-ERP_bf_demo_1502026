<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePayComponent extends Model
{
    use HasFactory;
    protected $table = 'erp_employee_pay_components';
    public $timestamps = false;
    protected $primaryKey = 'emp_pay_comp_id';
    protected $fillable = [
        'emp_no',
        'component_id',
        'amount',
        'percentage',
        'effective_from',
        'effective_to',
        'is_current',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'


    ];
    public function employeePayComonent($EmpNo){
        if($EmpNo != NULL){
            return self::where('emp_no',$EmpNo)->where('active', 1)->get();
        }else{
            return self::where('active', 1)->get();
        }
    }
    public function createEmployeePayComonent($EmployArr){
        return self::create($EmployArr);
    }
    public function multipleEmployeePayComonent($EmpNoArr){
        return filled($EmpNoArr) ? self::whereIn('emp_no',$EmpNoArr)->where('active', 1)->where('is_current', true)->get() : NULL;
    }
    public function deleteEmployeePayComonent($EmpNo){
        return self::where('emp_no',$EmpNo)->delete();
    }
}
