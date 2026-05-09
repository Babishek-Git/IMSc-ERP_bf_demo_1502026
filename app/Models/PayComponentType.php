<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayComponentType extends Model
{
    use HasFactory;
    protected $table = 'erp_pay_component_type';
    public $timestamps = false;
    protected $primaryKey = 'component_type_id';
    protected $fillable = [       
        'component_type_code',
        'component_type_name',
        'pay_effect',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    // Relationship: Component Type has many Pay Components
    public function components(){
        return $this->hasMany(PayComponent::class, 'component_type_id');
    }
    // Scope to filter only active components
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
    // Static helper: Get all active records
    public static function getActive($request){
        return self::where('active', 1)->get();
    }
    // Static helper: Get all active component types with their components
    public static function getWithComponent()
    {
        return self::with('components')->where('active', 1)->get();
    }
       public function ShowPayComponentByCode($requset,$ComponentTypeCode)
    {
        return self::where('component_type_code',$ComponentTypeCode)->get();
    }
}
