<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayRollMaster extends Model
{
    use HasFactory;
    protected $table = 'erp_payroll_master';
    protected $primaryKey = 'payroll_master_id';
    public $timestamps = false;
    protected $fillable = [       
        'payroll_month',
        'payroll_year',
        'payroll_month_year',
        'generated_date',
        'generated_by',
        'generated_by_name',
        'total_employees',
        'total_gross_salary',
        'total_deductions',
        'total_net_salary',
        'status',
        'finalized_date',
        'finalized_by',
        'approved_date',
        'approved_by',
        'remarks',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'emp_group_type'
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
    public function createEmployeePayrollMaster($PayrollArr){
        return self::create($PayrollArr);
    }
    public static function getPayrollData($PayMonth,$PayYear){
        return self::where('active', 1)->where('payroll_month', $PayMonth)->where('payroll_year',$PayYear)->get();
    }
    public static function getPendingPayrollData(){
        return self::where('active', 1)
            ->where(function($query){
                $query->where('status', '!=', 'completed')
                    ->orWhereNull('status');
            })
            ->get();
    }
    public static function getMultiplePayrollData($TransactionIdList){
        return self::where('active', 1)
            ->whereIn('payroll_master_id',$TransactionIdList)
            ->get();
    }
    public static function getPayrollDataById($TransactionId){
        return self::select('erp_payroll_master.*','erp_emp_group.emp_group_name','erp_emp_group.emp_group_code')
            ->join('erp_emp_group','erp_emp_group.emp_group_id', '=', 'erp_payroll_master.emp_group_type')
            ->where('erp_payroll_master.active',1)
            ->where('erp_payroll_master.payroll_master_id',$TransactionId)
            ->get();
    }
    public static function getPayrollDataByEmpGroup($PayMonth,$PayYear,$EmpGroupType){
        return self::where('active', 1)->where('payroll_month', $PayMonth)->where('payroll_year',$PayYear)->where('emp_group_type',$EmpGroupType)->get();
    }
}
