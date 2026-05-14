<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;  

class LeaveApplicationDt extends Model
{
    //use SoftDeletes;

    protected $fillable = [
        'application_no', 'emp_no', 'leave_type_id',
        'from_date', 'to_date', 'applied_days', 'actual_days',
        'reason', 'address_during_leave', 'contact_during_leave',
        'medical_certificate_no', 'mc_date', 'mc_doctor_name',
        'purpose', 'invitation_ref', 'destination',
        'parent_application_id', 'status',
        'rejected_by', 'approved_by',
        'rejected_at', 'approved_at',
        'remarks', 'rejection_reason',
        'actual_join_date', 'joined',
        'active', 'created_at', 'created_by', 'updated_at', 'updated_by',
        'leave_application_id'
    ];

    protected $casts = [
        'from_date'        => 'date',
        'to_date'          => 'date',
        'mc_date'          => 'date',
        'actual_join_date' => 'date',
        'joined'           => 'boolean',
    ];
    protected $table = 'erp_emp_leave_application_dt';
    public $timestamps = false;
    protected $primaryKey = 'leave_application_dt_id';

    public function employee()   { return $this->belongsTo(AemEmployee::class, 'emp_no', 'emp_no'); }
    public function leaveType()  { return $this->belongsTo(LeaveType::class, 'leave_type_id', 'leave_type_id'); }
    public function approver()   { return $this->belongsTo(AemEmployee::class, 'approved_by', 'emp_no', 'emp_no'); }
    public function parent()     { return $this->belongsTo(self::class, 'parent_application_id'); }
    public function children()   { return $this->hasMany(self::class, 'parent_application_id'); }

    public function isPending(): bool
    {
        return in_array($this->status, ['submitted', 'recommended']);
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }
    public function scopePending($query)
    {
        return $query->whereIn('status', ['submitted', 'recommended']);
    }
    public function ShowApplicationByArr($AppDtArr){
        return self::whereIn('leave_application_dt_id',$AppDtArr)->orderBy('leave_application_dt_id','ASC')->get();
    }
    public function ShowLeaveForAttendance($FromDate,$ToDate){
        // Here in where clause date should be inter changed. (From Date should be given in to_date, To Date should be given in from_date)
        return self::with('leaveType')->where('status', 'approved')->where('from_date', '<=', $ToDate)->where('to_date', '>=', $FromDate)->get();
    }

     public function CheckLTCAppliedLeave($fromDate, $toDate, $empNo)
    {
        return LeaveApplicationDt::where('emp_no', $empNo)->where('reason', 'LTC')
            ->where(function ($query) use ($fromDate, $toDate) {
                $query->where('from_date', '<=', $fromDate)->where('to_date', '>=', $toDate);
            })
            ->join('erp_leave_types', 'erp_leave_types.leave_type_id', '=', 'erp_emp_leave_application_dt.leave_type_id')
            ->select('erp_emp_leave_application_dt.*', 'erp_leave_types.*')
            ->get();
    } 
    
}