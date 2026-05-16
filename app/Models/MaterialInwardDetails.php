<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialInwardDetails extends Model
{
    use HasFactory;
    protected $table = 'erp_material_inward_detail';
    public $timestamps = false;
    protected $primaryKey = 'master_inward_detail_id';
    protected $fillable = [
        'master_inward_id',
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
        'emp_no',
        'updated_by ',
        'acc_payment_perc',
        'acc_total_payment_amt',
        'acc_remarks',
        'updated_at'
    ];
    public static function DeleteMaterialInwardDetails($MaterialInwardId){
        $DelData = NULL;
        if(filled($MaterialInwardId)){
            $DelData = MaterialInwardDetails::where('master_inward_id', $MaterialInwardId)->delete();
        }
        return $DelData;
    }
    public static function CreateIMaterialInwardDetails($request,$SaveDtData){
        $SaveData = NULL;
        if(filled($SaveDtData)){
            $SaveData = MaterialInwardDetails::create($SaveDtData);
        }
        return $SaveData;
    }
    public static function showMaterialInwardDetailsData($request,$MatId){
        $MatData = NULL;
        if(filled($MatId)){
            $MatData = MaterialInwardDetails::where('master_inward_id',$MatId)->where('active',1)->get();
        }
        return $MatData;
    }
    public static function ShowMaterialInwardData($MatId){
        if(filled($MatId)){
            return self::whereIn('master_inward_id',$MatId)->where('active',1)->get();
        }
    }
}
