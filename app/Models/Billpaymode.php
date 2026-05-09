<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class Billpaymode extends Model
{
    use HasFactory;
    protected $table = 'erp_bill_payment_mode';
    public $timestamps = false;
    protected $primaryKey = 'pay_mode_id';
    protected $fillable = [
        'pay_mode_name',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
        
    ];
    public function ShowBillpaymode()
    {
       
        return self :: get();
    }
    // public static function showPurchaseOredrIndentData($request,$PurchaseId){
    //     $ReturnData = NULL;

    //     if(filled($PurchaseId)){
    //         $ReturnData = PurchaseOrder::where('imsc_workorder.active',1)
    //             ->where('imsc_workorder.work_order_id',$PurchaseId)
    //             ->join('erp_indent','imsc_workorder.indent_id','=','erp_indent.indent_id')
    //             ->join('erp_indent_dtl','erp_indent.indent_id','=','erp_indent_dtl.indent_id')
    //             ->select(
    //                 'imsc_workorder.*',
    //                 'erp_indent.*',
    //                 'erp_indent_dtl.*'
    //             )
    //             ->get();   
    //     }

    //     return $ReturnData;
    // }
    // public function CreatePurchaseOrder($OrderArr,$PoId){
    //     return self::create($OrderArr);
    // }
    // public static function POMaxSuffixNo($request){
    //     return PurchaseOrder::max('po_suffix_no');
    // }
   /*  public function CheckBank($BankArr){
        return BankMaster::select('bank_name')
                    ->whereRaw("REGEXP_REPLACE(REGEXP_REPLACE(bank_name, '[^a-zA-Z0-9]+', '', 'g'), ' ', '', 'g') ILIKE ?", [$BankArr['bank_name']])  
                    ->get();
    }

    public function UpdateBank($BankArr, $bank_id){
        return BankMaster::where('bank_id', $bank_id)->update($BankArr);
    }
    public function ShowBankList($bank_id){
        if($bank_id != NULL){
            $BankData = BankMaster::where('bank_id', $bank_id)->orderby('bank_name','ASC')->get();
        }else{
            $BankData = BankMaster::orderby('bank_name','ASC')->get();
        }
        return $BankData;        
    }
    public function CheckBankUpdate($BankArr,$HidBankId){
        return BankMaster::select('bank_name')
                    ->where('bank_id','!=',$HidBankId)
                    ->whereRaw("REGEXP_REPLACE(REGEXP_REPLACE(bank_name, '[^a-zA-Z0-9]+', '', 'g'), ' ', '', 'g') ILIKE ?", [$BankArr['bank_name']])  
                    ->get();
    }
    public function multipleBank($BankIdArr){
        return self::where('active',1)->whereIn('bank_id',$BankIdArr)->get();
    } */
}
        