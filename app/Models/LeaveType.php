<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;  

class LeaveType extends Model
{
    const CL  = 'CL';
    const SCL = 'SCL';
    const EL  = 'EL';
    const HPL = 'HPL';
    const CML = 'CML'; // Commuted Leave
    const LND = 'LND'; // Leave Not Due
    const EOL = 'EOL'; // Extra Ordinary Leave
    const AL  = 'AL';  // Academic Leave
    const SBL = 'SBL'; // Sabbatical Leave
    const ML  = 'ML';  // Maternity Leave
    const PL  = 'PL';  // Paternity Leave
    const CCL = 'CCL'; // Child Care Leave
    const STL = 'STL'; // Study Leave

    protected $fillable = [
        'leave_type_code', 'leave_type_name', 'leave_type_short_name', 'is_debited_to_account',
        'is_paid', 'is_special', 'requires_medical_cert',
        'auto_credit', 'credit_per_half_year', 'max_accumulation',
        'max_at_one_time', 'max_per_year', 'max_entire_service',
        'carry_forward', 'max_carry_forward',
        'applicable_staff_types', 'applicable_genders', 'rules_notes',
        'active', 'created_at', 'created_by', 'updated_at', 'updated_by',
    ];

    protected $casts = [
        'applicable_staff_types' => 'array',
        'applicable_genders'     => 'array',
        'is_debited_to_account'  => 'boolean',
        'is_paid'                => 'boolean',
        'is_special'             => 'boolean',
        'requires_medical_cert'  => 'boolean',
        'auto_credit'            => 'boolean',
        'carry_forward'          => 'boolean',
    ];
    protected $table = 'erp_leave_types';
    public $timestamps = false;
    protected $primaryKey = 'leave_type_id';

    public function leaveBalances()
    {
        return $this->hasMany(LeaveBalance::class);
    }
    public function ShowLeaveType(){
        return self::where('active',1)->get();
    }
    public function ShowMultipleLeaveType($leaveTypeIdArr){
        return self::whereIn('leave_type_id',$leaveTypeIdArr)->where('active',1)->get();
    }
}
