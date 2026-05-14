<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'erp_payment';
    public $timestamps = false;
    protected $primaryKey = 'payment_id';
    protected $fillable = [
        'transaction_id',
        'transaction_table',
        'module_code',
        'gross_amount',
        'recovery_amount',
        'net_amount',
        'payment_to',
        'pay_vendor_id',
        'pay_emp_no',
        'bill_no',
        'bill_date',
        'bill_ref_no',
        'bank_id',
        'bank_name',
        'branch_id',
        'branch_name',
        'account_no',
        'ifsc_code',
        'pan_no',
        'gst_no',
        'status',
        'approved_by',
        'approved_dt',
        'rejected_by',
        'rejected_dt',
        'is_completed',
        'is_approved',
        'payment_description',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'pay_emp_group_type',
        'voucher_no',
        'voucher_dt',
        'voucher_amt',
        'is_final_bill'
    ];
    public static function CreatePayment($SaveData){
        return self::create($SaveData);
    }
    public static function UpdatePayment($SaveData,$PaymentId){
        return self::where('payment_id',$PaymentId)->update($SaveData);
    }
    public static function ShowSalaryPayment($PaymentId){
        if($PaymentId != NULL){
            return self::select('erp_payment.*','erp_emp_group.emp_group_name','erp_emp_group.emp_group_code')
            ->join('erp_emp_group','erp_emp_group.emp_group_id', '=', 'erp_payment.pay_emp_group_type')
            ->where('erp_payment.active',1)
            ->where('erp_payment.payment_id',$PaymentId)
            ->get();
        }else{
            return self::select('erp_payment.*','erp_emp_group.emp_group_name','erp_emp_group.emp_group_code')
            ->join('erp_emp_group','erp_emp_group.emp_group_id', '=', 'erp_payment.pay_emp_group_type')
            ->where('erp_payment.active',1)
            ->get();
        }
    }
    public static function ShowPendingSalaryPaymentForCreation($PaymentId){
        if($PaymentId != NULL){
            return self::select('erp_payment.*','erp_emp_group.emp_group_name','erp_emp_group.emp_group_code')
            ->join('erp_emp_group','erp_emp_group.emp_group_id', '=', 'erp_payment.pay_emp_group_type')
            ->where('erp_payment.active',1)
            ->where('erp_payment.payment_id',$PaymentId)
            ->whereNull('erp_payment.status')
            ->get();
        }else{
            return self::select('erp_payment.*','erp_emp_group.emp_group_name','erp_emp_group.emp_group_code')
            ->join('erp_emp_group','erp_emp_group.emp_group_id', '=', 'erp_payment.pay_emp_group_type')
            ->where('erp_payment.active',1)
            ->whereNull('erp_payment.status')
            ->get();
        }
    }
    public static function ShowPendingBillPaymentForCreation($PaymentId,$ModuleCodeList){
        if($PaymentId != NULL){
            return self::where('active',1)->where('payment_id',$PaymentId)->whereNull('erp_payment.status')->whereIn('module_code',$ModuleCodeList)->get();
        }else{
            return self::where('erp_payment.active',1)->whereNull('erp_payment.status')->whereIn('module_code',$ModuleCodeList)->get();
        }
    }
    public function ShowPaymentById($PaymentId){
        if($PaymentId != NULL){
            return self::where('active',1)->where('payment_id',$PaymentId)->get();
        }else{
            return NULL;
        }
    }
    public static function ShowPendingOtherBillPaymentForCreation($PaymentId,$PaymentWorFlowModuleList){
        if($PaymentId != NULL){
            return self::where('active',1)->where('payment_id',$PaymentId)->whereNull('erp_payment.status')->whereIn('module_code',$PaymentWorFlowModuleList)->get();
        }else{
            return self::where('erp_payment.active',1)->whereNull('erp_payment.status')->whereIn('module_code',$PaymentWorFlowModuleList)->get();
        }
    }
    public function ShowPaymentForVoucherCreate(){
        return self::where('active',1)->where('status','pending')->whereNull('voucher_no')->whereNull('voucher_dt')->whereNull('voucher_amt')->get();
    }
    public static function ShowCompletedPayment(){
       return self::where('active',1)->whereNotNull('voucher_no')->whereNotNull('voucher_dt')->whereNotNull('voucher_amt')->get();
    }
    public static function GetCompletedPaymentsWithoutFinalBill(){
      return self::where('active',1)
            ->whereNotNull('voucher_no')
            ->whereNotNull('voucher_dt')
            ->whereNotNull('voucher_amt')
            ->where(function($query){
                $query->whereNull('is_final_bill')
                    ->orWhere('is_final_bill', false);
            })
            ->get();
    }
    
}
