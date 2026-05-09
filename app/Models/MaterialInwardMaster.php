<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class MaterialInwardMaster extends Model
{
    use HasFactory;
    protected $table = 'erp_material_inward_master';
    public $timestamps = false;
    protected $primaryKey = 'master_inward_id';
    protected $fillable = [
        'receipt_id',
        'receipt_date',
        'po_id',
        'intent_id',
        'vendor_id',
        'stored_location_id',
        'sheet_id',
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
        'mat_inward_submit'
    ];
    public static function ShowMaxReceipNo($request){
        return MaterialInwardMaster::max('receipt_suffix_no');
    }
    public static function CreateMaterialInwardDeatils ($request,$SaveData,$MaterialInwardId){
        $MatSaveData = NULL;
        if(filled($MaterialInwardId) && $MaterialInwardId !=NULL){
            $MatSaveData = MaterialInwardMaster::where('master_inward_id')->update($SaveData);
        }else{
            $MatSaveData = MaterialInwardMaster::create($SaveData);
        }
        return $MatSaveData;
    }
    public static function showMaterialInwardData ($request,$MatId){
        $ReturnData = NULL;
        if(filled($MatId)){
            $ReturnData = MaterialInwardMaster::where('master_inward_id',$MatId)->get();
        }else{
            $ReturnData = MaterialInwardMaster::where('active',1)->orderby('master_inward_id','DESC')->get();
        }
        return $ReturnData;
    }
    public static function GetMaterialInwardByPoId($PoId){
        $MatData = NULL;
        if(filled($PoId)){
            $MatData = MaterialInwardMaster::where('po_id',$PoId)->where('active',1)->get();
        }
        return $MatData;
    }
    public static function SumbitMaterialInWardDetails($MatId){
        if(filled($MatId)){
            return MaterialInwardMaster::where('master_inward_id', $MatId)->update(['mat_inward_submit' => true]);
        }
    }
    public static function GetMatInwardSubmitData($request,$MatId) {
        if(filled($MatId)){
             $RetData = DB::table('erp_material_inward_master as mi')
            ->join('erp_po_order as po', 'mi.po_id', '=', 'po.work_order_id')
            ->select(
                'mi.*', 
                'po.work_name', 
                'po.po_issued',
                'po.work_order_no',
                'po.work_order_date',
                'po.contid'
            )
            ->where('mi.master_inward_id', $MatId) 
            ->where('mi.active', '1') 
            ->where('po.po_issued', 'true')
            ->where('mi.mat_inward_submit', 'true')
            ->get();
        }else{
            $RetData = DB::table('erp_material_inward_master as mi')
            ->join('erp_po_order as po', 'mi.po_id', '=', 'po.work_order_id')
            ->select(
                'mi.*', 
                'po.work_name', 
                'po.po_issued',
                'po.work_order_no',
                'po.work_order_date',
                'po.contid'
            )
            ->where('mi.active', '1') 
            ->where('po.po_issued', 'true')
            ->where('mi.mat_inward_submit', 'true')
            ->get();
        }
       

        return $RetData;
    }
    public static function showMaterialInwardPendingPaymentData(){
        $data = DB::table('erp_material_inward_master as mi')
            ->join('erp_material_inward_detail as md', 'mi.master_inward_id', '=', 'md.master_inward_id')
            ->select(
                'mi.master_inward_id',
                'mi.po_id',
                'mi.receipt_id',
                'mi.receipt_date',
                'mi.vendor_id',
                'mi.mat_inward_submit',
                'mi.is_pending_payment',
                'mi.po_id'
            )
            ->where('mi.active', 1)
            ->where(function($query){
                $query->where('md.payment_perc', '!=', 100)
                    ->orWhere('md.acc_payment_perc', '!=', 100)
                    ->orWhere('md.balance_qty', '!=', 0);
            })
            ->distinct()
            ->orderBy('mi.master_inward_id', 'DESC')
            ->get();

        return $data;
    }
}
