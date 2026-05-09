<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AMCMaterialInwardDetails extends Model
{
    use HasFactory;
    protected $table      = 'erp_amc_material_inward_detail';
    public $timestamps    = false;
    protected $primaryKey = 'amc_inward_detail_id';
    protected $fillable = [
        'amc_master_inward_id',
        'item_no',
        'item_description',
        'item_unit',
        'po_quantity',
        'previously_received_qty',
        'received_qty',
        'balance_qty',
        'unit_rate',    
        'gst_perc',
        'gst_amt',
        'total_cost',
        'item_remarks',
        'active',
        'location_id',
        'qty_certified',
        'created_at',
        'payment_perc',
        'total_payment_amout',
        'updated_by ',
        'updated_at'
    ];
    public static function DeleteMaterialInwardDetails($AMCMatInwardId){
        $DelData = NULL;
        if(filled($AMCMatInwardId)){
            $DelData = AMCMaterialInwardDetails::where('amc_master_inward_id', $AMCMatInwardId)->delete();
        }
        return $DelData;
    }
    public static function CreateAMCMaterialInwardDetails($request,$SaveDtData){
        $SaveData = NULL;
        if(filled($SaveDtData)){
            $SaveData = AMCMaterialInwardDetails::create($SaveDtData);
        }
        return $SaveData;
    }
    public static function showAMCMaterialInwardDetailsData($request,$MatId){
        $MatData = NULL;
        if(filled($MatId)){
            $MatData = AMCMaterialInwardDetails::where('amc_master_inward_id',$MatId)->where('active',1)->get();
        }
        return $MatData;

    }
}
