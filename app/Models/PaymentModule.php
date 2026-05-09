<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentModule extends Model
{
    use HasFactory;
    protected $table = 'erp_payment_module';
    public $timestamps = false;
    protected $primaryKey = 'payment_module_id';
    protected $fillable = [
        'payment_module_code',
        'wf_module_code',
        'active'
    ];
    
    public static function ShowPaymentModuleByCode($PaymentModuleCode){
        if($PaymentModuleCode != NULL){
            return self::where('active',1)->where('payment_module_code',$PaymentModuleCode)->get();
        }else{
            return self::where('active',1)->get();
        }
    }

}
