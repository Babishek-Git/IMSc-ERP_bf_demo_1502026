<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryChallanDetails extends Model
{
    use HasFactory;
     protected $table     = 'erp_delivery_challan_qty_detials';
    public $timestamps    = false;
    protected $primaryKey = 'delivery_challan_det_id';
    protected $fillable   = [
        'delivery_challan_id',
        'po_order_soq_id',
        'quantity',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'active'
    ];
    public static function GetDeliveryChallanDetailData($DeliverId){
        if(filled($DeliverId)){
            return self::where('delivery_challan_id',$DeliverId)->where('active',1)->get();
        }
    }
    public static function CreateDeliveryChallanDetails($SaveDtData){
        return self::create($SaveDtData);
    }
}
