<?php

namespace App\Models;
use DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AMCMaterialInwardMaster extends Model
{
    use HasFactory;
    protected $table = 'erp_amc_material_inward_master';
    public $timestamps = false;
    protected $primaryKey = 'amc_master_inward_id';
    protected $fillable = [
        'receipt_id',
        'receipt_date',
        'amc_po_id',
        'vendor_id',
        'stored_location_id',
        'delivery_challan_no',
        'challan_date',    
        'invoice_no',
        'invoice_date',
        'invoice_amount',
        'grn_type',
        'total_received_qty',
        'grn_value',
        'inspection_required',
        'qc_status',
        'grn_status',
        'remarks',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'from_emp_no',
        'from_role',
        'to_emp_no',
        'to_role',
        'is_approved',
        'receiptno',
        'target_roles',
        'approved_dt',
        'rejected_dt',
        'approve_auth_role',
        'status',
        'is_completed',
        'receipt_suffix_no',
        'approved_by',
        'amc_mat_inward_submit'
    ];
    public static function GetMaterialInwards(){
        return self::where('active', 1)->get();
    }
    public static function CreateAMCMaterialInwardDeatils ($request,$SaveData,$AMCMaterialInwardId){
        $MatSaveData = NULL;
        if(filled($AMCMaterialInwardId) && $AMCMaterialInwardId !=NULL){
            $MatSaveData = AMCMaterialInwardMaster::where('amc_master_inward_id',$AMCMaterialInwardId)->update($SaveData);
        }else{
            $MatSaveData = AMCMaterialInwardMaster::create($SaveData);
        }
        return $MatSaveData;
    }
    public static function GetAMCMaterialInwardData($AMCMatInWardId){
        if(filled($AMCMatInWardId)){
            return self::where('amc_master_inward_id',$AMCMatInWardId)->where('active', 1)->get();
        }
    }
    public static function IssueAMCMatInwardApplication($AMCMatInWardId){
        if(filled($AMCMatInWardId)){
            return self::where('amc_master_inward_id',$AMCMatInWardId)->update(['amc_mat_inward_submit' => true,'status' => 'SU']);
        }
    }
    public static function ShowAMCMatInwardSubmitedData($request,$AMCMatId) {
        if(filled($AMCMatId)){
             $RetData = DB::table('erp_amc_material_inward_master as mi')
            ->join('erp_amc_po_order as po', 'mi.amc_po_id', '=', 'po.amc_po_order_id')
            ->select(
                'mi.*', 
                'po.discipline_id', 
                'po.amc_type_id',
                'po.amc_baseson_id',
                'po.amc_file_name',
                'po.equip_desc',
                'po.amc_cost',
                'po.gst_perc',
                'po.cost_tax',
                'po.location_id',
                'po.bill_pay_mode',
                'po.created_by',
                'po.contid'
            )
            ->where('mi.amc_master_inward_id', $AMCMatId) 
            ->where('mi.active', '1') 
            ->where('po.amc_po_issued', 'true')
            ->where('mi.amc_mat_inward_submit', 'true')
            ->get();
        }else{
            $RetData = DB::table('erp_amc_material_inward_master as mi')
            ->join('erp_amc_po_order as po', 'mi.amc_po_id', '=', 'po.amc_po_order_id')
            ->select(
                'mi.*', 
                'po.discipline_id', 
                'po.amc_type_id',
                'po.amc_baseson_id',
                'po.amc_file_name',
                'po.equip_desc',
                'po.created_by',
                'po.contid'
            )
            ->where('mi.active', '1') 
            ->where('po.amc_po_issued', 'true')
            ->where('mi.amc_mat_inward_submit', 'true')
            ->get();
        }
        return $RetData;
    }
    
}
