<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttendanceDt extends Model
{
    use HasFactory;
    protected $table = 'erp_emp_attendance_dt';
    public $timestamps = false;
    protected $primaryKey = 'attendance_dt_id';
    protected $fillable = [
        'attendance_master_id',
        'emp_no',
        'days_present',
        'days_absent',
        'days_leave',
        'leave_type',
        'days_half',
        'days_pay_calc',
        'remarks',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'emp_working_days',
        'leave_data'

    ];
    public function employeeAttendanceDt($EmpNo){
        if($EmpNo != NULL){
            return self::where('emp_no',$EmpNo)->where('active', 1)->get();
        }else{
            return self::where('active', 1)->get();
        }
    }
    public function employeeAttendanceDtAll($AttMastId){
        return self::where('attendance_master_id',$AttMastId)->where('active', 1)->get();
    }
    public function createEmployeeAttendanceDt($AttendanceArr){
        return self::create($AttendanceArr);
    }
    public function multipleEmployeeAttendance($EmpNoArr,$PayMonth,$PayYear)
    {
        //return self::whereIn('emp_no',$TypeCodeArr)->get();
        return self::join('erp_emp_attendance_master', 'erp_emp_attendance_master.attendance_master_id', '=', 'erp_emp_attendance_dt.attendance_master_id')->where('erp_emp_attendance_master.payroll_year',$PayYear)->where('erp_emp_attendance_master.payroll_month',$PayMonth)->where('erp_emp_attendance_dt.emp_no',$EmpNoArr)->get();
    }
}
