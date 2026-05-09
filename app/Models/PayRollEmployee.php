<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class PayRollEmployee extends Model
{
    use HasFactory;
    protected $table = 'erp_payroll_employee';
    protected $primaryKey = 'payroll_employee_id';
    public $timestamps = false;
    protected $fillable = [       
        'payroll_master_id',
        'emp_no',
        'emp_name',
        'designation',
        'department',
        'employee_group',
        'total_working_days',
        'present_days',
        'absent_days',
        'leave_days',
        'holidays',
        'paid_days',
        'basic_salary',
        'gross_salary',
        'total_earnings',
        'total_deductions',
        'net_salary',
        'payment_mode',
        'bank_name',
        'account_number',
        'ifsc_code',
        'status',
        'payment_date',
        'payment_reference',
        'calculation_date',
        'remarks',
        'group_id',
        'group_name',
        'division_id',
        'division_name',
        'section_id',
        'section_name',
        'emp_group_code',
        'emp_group_name',
        'emp_type_code',
        'emp_type_name',
        'emp_marital_status',
        'emp_salute',
        'pay_level',
        'pay_in_level',
        'next_incr_dt',
        'bank_id',
        'branch_id',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'payment_id'
    ];
    // Relationship: Component belongs to one Component Type
    public function componentType()
    {
        return $this->belongsTo(PayComponentType::class, 'component_type_id');
    }
    // Scope to filter only active components
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    // Static helper: Get all active components
    public static function getActive($request){
        return self::where('active', 1)->get();
    }
    // Static helper: Get all active components with their type
    public static function scopeWithType($query)
    {
        //return self::with('componentType')->where('active', 1)->get();
        return $query->with('componentType');
    }

    public function calculationRules(): HasMany
    {
        return $this->hasMany(ComponentCalculationRule::class, 'component_id');
    }
    public function createEmployeePayroll($PayrollArr){
        return self::create($PayrollArr);
    }
    public function updateEmployeePayroll($PayrollEmpId,$SaveData){
        return self::where('payroll_employee_id',$PayrollEmpId)->update($SaveData);;
    }
    public function updateMultipleEmployeePayroll($PayrollMasterId,$SaveData){
        return self::where('payroll_master_id',$PayrollMasterId)->where('status','PENDING')->update($SaveData);;
    }
    
    public static function getPayrollEmployeeData($PayMasterId){
        return self::where('active', 1)->where('payroll_master_id', $PayMasterId)->get();
    }
    public static function getPendingPayrollDataByMultipleId($PayrollIdList){
        return self::select('payroll_master_id', DB::raw('SUM(net_salary) as total_amount'))
            ->where('active', 1)
            ->where('status', 'PENDING')
            ->whereIn('payroll_master_id', $PayrollIdList)
            ->groupBy('payroll_master_id')
            ->get();
    }
    public static function getPendingPayrollDataByMultipleIdEmpGroup($PayrollIdList,$EmpGroupCodeList){
        return self::select('payroll_master_id', DB::raw('SUM(net_salary) as total_amount'))
            ->where('active', 1)
            ->where('status', 'PENDING')
            ->whereIn('payroll_master_id', $PayrollIdList)
            ->whereIn('emp_group_code', $EmpGroupCodeList)
            ->groupBy('payroll_master_id')
            ->get();
    }
    public static function getHoldPayrollEmployeeData(){
        $EmpData = self::join('erp_payroll_master', 'erp_payroll_employee.payroll_master_id', '=', 'erp_payroll_master.payroll_master_id') 
                    ->where('erp_payroll_master.active',1)
                    ->where('erp_payroll_employee.active',1)
                    ->where('erp_payroll_employee.status','ON_HOLD')
                    ->whereNull('erp_payroll_employee.payment_id')
                    ->get();
        return $EmpData;
    }
    public static function getPayrollEmployeeDataById($PayMasterId){
        return self::where('active', 1)->where('payroll_master_id', $PayMasterId)->where('status', '!=', 'ON_HOLD')->get();
    }
    public static function getPayrollEmployeeDataByPayEmpId($PayRollEmpId){
        return self::where('active', 1)->where('payroll_employee_id', $PayRollEmpId)->get();
    }
    
    
}
