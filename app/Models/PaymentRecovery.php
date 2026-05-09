<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentRecovery extends Model
{
    use HasFactory;
    protected $table = 'erp_payment_recovery';
    public $timestamps = false;
    protected $primaryKey = 'payment_recovery_id';
    protected $fillable = [
        'payment_id',
        'recovery_code',
        'recovery_amount',
        'ledger_id',
        'object_head_id',
        'ohl_mapping_id',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'recovery_flag'
    ];
    public static function CreatePaymentRecovery($SaveData){
        return self::create($SaveData);
    }
    public static function UpdatePaymentRecovery($SaveData,$PaymentRecoveryId){
        return self::where('payment_recovery_id',$PaymentRecoveryId)->update($SaveData);
    }
    public static function DeletePaymentRecovery($PaymentId){
        return self::where('payment_id',$PaymentId)->delete();
    }
    
    public static function ShowPaymentRecovery($PaymentId){
        if($PaymentId != NULL){
            return self::where('active',1)->where('payment_id',$PaymentId)->get();
        }else{
            return self::where('active',1)->get();
        }
    }
}
