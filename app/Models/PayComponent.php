<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayComponent extends Model
{
    use HasFactory;
    protected $table = 'erp_pay_component';
    protected $primaryKey = 'component_id';
    public $timestamps = false;
    protected $fillable = [       
        'component_code',
        'component_name',
        'component_type_id',
        'is_taxable',
        'is_percentage',
        'with_effect_from',
        'component_name_on_payslip',
        'dp_order',
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
    public function ShowComponentTypeName()
    {
        $TypeData = PayComponent::join('erp_pay_component_type','erp_pay_component.component_id','=','erp_pay_component_type.component_type_id')->get();
        return $TypeData;
    }
}
