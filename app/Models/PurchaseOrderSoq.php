<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderSoq extends Model
{
    use HasFactory;
    protected $table = 'erp_po_order_soq';
    public $timestamps = false;
    protected $primaryKey = 'po_order_soq_id';
    protected $fillable = [
        'po_id',
        'indent_det_id',
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
    public static function CreatePoSoqDetail($PoSoqDtArr){
        return self::create($PoSoqDtArr);
    }
    public static function showPurchaseOredrSoqData($request,$PoId){
        $PoData = NULL;
        if(filled($PoId)){
            $PoData = PurchaseOrderSoq::where('po_id',$PoId)->where('active',1)->get();
        }
        return $PoData;

    }
    public static  function DeletePoDetails($PoId){
        if(filled($PoId)){
            return self::where('po_id',$PoId)->delete();
        }
    }
}
