<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;  

class LeaveApplication extends Model
{
    //use SoftDeletes;

    protected $fillable = [
        'leave_application_no', 'emp_no', 'total_days',
        'status', 'approved_by', 'approved_dt', 'rejected_by',
        'rejected_dt', 'active', 'created_at', 'created_by', 'updated_at', 'updated_by',
        'from_emp_no', 'from_role', 'to_emp_no', 'to_role', 'is_approved', 'target_roles',
        'is_completed', 'approve_auth_role'
    ];

    
    protected $table = 'erp_emp_leave_application';
    public $timestamps = false;
    protected $primaryKey = 'leave_application_id';
    public function employee()   { return $this->belongsTo(AemEmployee::class, 'emp_no', 'emp_no'); }

    public function CreateLeaveApplication($LeaveApplicationArr){
        return self::create($LeaveApplicationArr);
    }
    public function scopePending($query)
    {
        return $query->whereIn('status', ['submitted', 'recommended']);
    }
    public function ShowApplicationById($ApplicationId)
    {
        return self::where('leave_application_id', $ApplicationId)->get();
    }
    
    public function UpdateLeaveApplication($UpdateData, $ApplicationId){
        return self::where('leave_application_id', $ApplicationId)->update($UpdateData);
    }

}