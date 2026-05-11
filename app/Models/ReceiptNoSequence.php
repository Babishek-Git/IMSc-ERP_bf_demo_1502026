<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class  DeliveryChallanDetails extends Model
{
    use HasFactory;
    protected $table      = 'erp_delivery_challan_qty_details';
    public $timestamps    = false;
    protected $primaryKey = 'receiptno_id';
    protected $fillable   = [
        'receiptno',
        'group_code',
        'division_code',
        'section_code',
        'active',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'starts_on',
        'closed_on',
        'action',
        'po_order_soq_id',
        'quantity',
        'delivery_challan_id'
    ];
    public static function ReceiptNoSeq($request){
        return DeliveryChallanDetails::where('active','1')->where('status','ACTIVE')->get();

    } 
    public static function CreateDeliveryChallanDetails($DelChallanId,$SaveDtData){
        if($DelChallanId != ''){
            return self::create($SaveDtData);
        }else{
            return self::where('delivery_challan_id',$DelChallanId)->update($SaveDtData);

        }
    }
}
