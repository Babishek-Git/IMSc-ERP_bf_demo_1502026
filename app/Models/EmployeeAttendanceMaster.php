<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttendanceMaster extends Model
{
    use HasFactory;
    protected $table = 'erp_emp_attendance_master';
    public $timestamps = false;
    protected $primaryKey = 'attendance_master_id';
    protected $fillable = [
        'payroll_year',
        'payroll_month',
        'payroll_month_year',
        'attendance_generate_dt',
        'attendance_generate_by',
        'total_working_days',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'emp_group_type'
    ];
    public function employeeAttendanceMaster($PayYear,$PayMonth){
        if($PayYear != NULL){
            return self::where('payroll_year',$PayYear)->where('payroll_month',$PayMonth)->where('active', 1)->get();
        }else{
            return self::where('active', 1)->get();
        }
    }
    public function createEmployeeAttendanceMaster($AttendanceArr){
        return self::create($AttendanceArr);
    }
    public function updateEmployeeAttendanceMaster($UpdateArr,$AttendMasterId){
        return self::where('attendance_master_id', $AttendMasterId)->Update($UpdateArr);
    }
}
