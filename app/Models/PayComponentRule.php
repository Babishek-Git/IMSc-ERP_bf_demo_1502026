<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayComponentRule extends Model
{
    use HasFactory;
    protected $table = 'erp_pay_component_rule';
    protected $primaryKey = 'rule_id';
    public $timestamps = false;
    protected $fillable = [       
        'component_id',
        'with_effect_from',
        'formula_json',
        'min_amount',
        'max_amount',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'rule_type_id',
        'fixed_amount',
        'fixed_percentage',
        'base_component',
        'formula'
    ];
    // Scope to filter only active components
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
    public function scopeShowPaycomponentType($query)
    {
       return $query->join('erp_pay_component','erp_pay_component.component_id', '=', 'erp_pay_component_rule.component_id')
                    ->leftjoin('erp_pay_component_rule_type','erp_pay_component_rule_type.rule_type_id', '=', 'erp_pay_component_rule.rule_type_id');
    }

}
