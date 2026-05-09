<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AMCPurchaseOrderSoq extends Model
{
    use HasFactory;
    protected $table      = 'erp_amc_po_order_soq';
    public $timestamps    = false;
    protected $primaryKey = 'amc_po_order_soq_id';
    protected $fillable   = [
        'amc_po_order_id',
        'item_no',
        'item_description',
        'quantity',
        'estimated_unit_price',
        'gst_rate',
        'gst_price',
        'gst_mode',
        'total_cost',    
        'item_unit',
        'suggested_supplier',
        'payment_term',
        'total_estimated_cost',
        'status',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'tax_type',
        'unit_id',
        'item_amount',
        'material_type_id'
    ];
    public static function CreateMAMCPoSoqDetail($AMCPODetailsDataArr){
        return self::create($AMCPODetailsDataArr);
    }
    public static function GetAMCPODetialEditData($EditAMCPoId){
        if(filled($EditAMCPoId)){
            return AMCPurchaseOrderSoq::where('amc_po_order_id',$EditAMCPoId)->where('active','1')->get();
        }
    }
}
