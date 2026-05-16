<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;
class DeliveryChallanQtyMaster extends Model
{
    use HasFactory;
    protected $table      = 'erp_delivery_challan_qty_master';
    public $timestamps    = false;
    protected $primaryKey = 'delivery_challan_id';
    protected $fillable = [
        'po_id',
        'receipt_no',
        'receipt_date',
        'created_by',
        'active',
        'created_at',
        'updated_by',
        'receipt_suffix_no',
        'updated_at'
    ];
    public static function CreateDeliveryChallanData ($request,$SaveData,$DelChallanId){
        $MatSaveData = NULL;
        if(filled($DelChallanId) && $DelChallanId !=NULL){
            $MatSaveData = DeliveryChallanQtyMaster::where('delivery_challan_id',$DelChallanId)->update($SaveData);
        }else{
            $MatSaveData = DeliveryChallanQtyMaster::create($SaveData);
        }
        return $MatSaveData;
    }
    public static function GetDeliveryChallanDataByPoId($PoId){
        if(filled($PoId)){
            return self::where('po_id',$PoId)->where('active',1)->get();
        }else{
            return self::where('active',1)->get();
        }
    }
    public static function ShowMaxReceipNo($request){
        return self::max('receipt_suffix_no');
    }
    public static function DeliveryChallanQtyDetails($DelChallanId){
        if(filled($DelChallanId)){
            return self::select(
                'erp_delivery_challan_qty_master.*',
                'erp_delivery_challan_qty_detials.po_order_soq_id',
                'erp_delivery_challan_qty_detials.quantity'
            )
            ->join(
                'erp_delivery_challan_qty_detials',
                'erp_delivery_challan_qty_master.delivery_challan_id',
                '=',
                'erp_delivery_challan_qty_detials.delivery_challan_id'
            )
            ->where('erp_delivery_challan_qty_master.delivery_challan_id',$DelChallanId)
            ->where('erp_delivery_challan_qty_master.active',1)->get();
        }
    }
    public static function GetDeliveryChallanWithDocuments($DeliveryChallanId){
        if(filled($DeliveryChallanId)){
            return DB::table('erp_delivery_challan_qty_master as dcm')
        ->leftJoin(
            'erp_supp_doc as sdm',
            'sdm.transaction_id',
            '=',
            'dcm.delivery_challan_id'
        )
        ->select(
            'dcm.receipt_no',
            'dcm.receipt_date',
            'sdm.sup_doc_id'
        )
        ->where('dcm.delivery_challan_id', $DeliveryChallanId)
        ->where('sdm.module_code', 'MAT_INWARD')
        ->where('sdm.module_sub_code', 'DEL_CHALLAN')
        ->get();
        }
    }
}
