<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayRollComponent extends Model
{
    use HasFactory;
    protected $table = 'erp_payroll_component_detail';
    protected $primaryKey = 'payroll_component_detail_id';
    public $timestamps = false;
    protected $fillable = [       
        'payroll_master_id',
        'payroll_employee_id',
        'component_id',
        'component_code',
        'component_name',
        'component_type',
        'calculation_type',
        'base_amount',
        'calculation_rate',
        'calculated_amount',
        'adjustment_amount',
        'final_amount',
        'is_taxable',
        'is_statutory',
        'formula_used',
        'pay_effect',
        'remarks',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
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
    public function createEmployeePayrollComponent($PayrollArr){
        return self::create($PayrollArr);
    }
    public static function getPayrollComponentData($PayMasterId){
        return self::where('active', 1)->where('payroll_master_id', $PayMasterId)->orderBy('payroll_component_detail_id','ASC')->get();
    }
    public static function getPayrollComponentDataByPayEmpId($PayRollEmpId){
        return self::where('active', 1)->where('payroll_employee_id', $PayRollEmpId)->orderBy('payroll_component_detail_id','ASC')->get();
    }
    public static function getMultiplePayrollComponentDataByPayEmpId($PayRollEmpIdList){
        return self::where('active', 1)->whereIn('payroll_employee_id', $PayRollEmpIdList)->orderBy('payroll_component_detail_id','ASC')->get();
    }
}
