<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayLevel extends Model
{
    use HasFactory;
    protected $table = 'erp_pay_level';
    protected $primaryKey = 'pay_level';
    public $timestamps = false;
    protected $fillable = [       
        'pay_level',
        'pay_level_name',
        'active'
    ];
    // Static helper: Get all active components
    public static function getActive($request){
        return self::where('active', 1)->orderBy('pay_level','ASC')->get();
    }
    
}
