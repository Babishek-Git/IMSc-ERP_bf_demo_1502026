<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayComponentRuleType extends Model
{
    use HasFactory;
    protected $table = 'erp_pay_component_rule_type';
    protected $primaryKey = 'rule_type_id';
    public $timestamps = false;
    protected $fillable = [       
        'rule_type_code',
        'rule_type_name',
        'active'
    ];
    // Scope to filter only active components
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
