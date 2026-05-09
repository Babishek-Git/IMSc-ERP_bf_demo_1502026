<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;
    protected $table = 'erp_payment_types';
    public $timestamps = false;
    protected $primaryKey = 'payment_type_id';
    protected $fillable = [
        'payment_type_name',
        'payment_type_code',
        'ledger_id',
        'active',
        'payment_module_code',
        'applicable_emp_group_type'
    ];
    public static function CreatePaymentType($SaveData){
        return self::create($SaveData);
    }
    public static function UpdatePaymentType($SaveData,$PaymentTypeId){
        return self::where('payment_type_id',$PaymentTypeId)->update($SaveData);
    }
    
    public static function ShowPaymentTypeById($PaymentTypeId){
        if($PaymentTypeId != NULL){
            return self::where('active',1)->where('payment_type_id',$PaymentTypeId)->get();
        }else{
            return self::where('active',1)->get();
        }
    }

    public static function ShowPaymentTypeByCode($PaymentTypeCode){
        if($PaymentTypeCode != NULL){
            return self::where('active',1)->where('payment_type_code',$PaymentTypeCode)->get();
        }else{
            return self::where('active',1)->get();
        }
    }
    public static function ShowPaymentTypeByEmpGroupTypeCode($EmpGroupTypeCode){
        if($EmpGroupTypeCode != NULL){
            return self::where('active',1)->where('applicable_emp_group_type',$EmpGroupTypeCode)->get();
        }else{
            return NULL;
        }
    }
    public static function ShowPaymentTypeByModuleCode($ModuleCode){
        return self::where('active',1)->where('payment_module_code',$ModuleCode)->get();
    }
}
