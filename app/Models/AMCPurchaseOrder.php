<?php

namespace App\Models;
use DB;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AMCPurchaseOrder extends Model
{
    use HasFactory;
    protected $table      = 'erp_amc_po_order';
    public $timestamps    = false;
    protected $primaryKey = 'amc_po_order_id';
    protected $fillable   = [
        'discipline_id',
        'amc_type_id',
        'amc_baseson_id',
        'amc_file_name',
        'equip_desc',
        'contid',
        'amc_cost',
        'gst_perc',
        'cost_tax',
        'location_id',
        'bill_pay_mode',
        'work_order_date',
        'work_commence_date',
        'work_duration',
        'work_duration_mode',
        'amc_po_issued',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'target_roles',
        'from_roleid',
        'to_roleid',
        'from_emp_no',
        'to_emp_no',
        'action',
        'appr_auth_role',
        'grand_total',
        'auto_save_common_remarks',
        'amc_po_total_amt'
    ];

    public static function showElectricalAMCPoDetails($AMCPoId){
        $query = AMCPurchaseOrder::query()
            ->join('erp_contractor', 'erp_amc_po_order.contid', '=', 'erp_contractor.contid')
             ->join('erp_amc_provided_basis', 'erp_amc_po_order.amc_baseson_id', '=', 'erp_amc_provided_basis.amc_prov_base_id')
            ->where('erp_amc_po_order.active', '1')
            ->where('discipline_id',292);

        if (filled($AMCPoId)) {
            $query->where('erp_amc_po_order.amc_po_order_id', $AMCPoId);
        }

        return $query->select(
            'erp_amc_po_order.*',
            'erp_contractor.name_contractor',
            'erp_amc_provided_basis.amc_prov_base_name'
        )->get();
    }

    public static function showLibraryAMCPoDetails($AMCPoId){
        $query = AMCPurchaseOrder::query()
            ->join('erp_contractor', 'erp_amc_po_order.contid', '=', 'erp_contractor.contid')
             ->join('erp_amc_provided_basis', 'erp_amc_po_order.amc_baseson_id', '=', 'erp_amc_provided_basis.amc_prov_base_id')
            ->where('erp_amc_po_order.active', '1')
            ->where('discipline_id',293);

        if (filled($AMCPoId)) {
            $query->where('erp_amc_po_order.amc_po_order_id', $AMCPoId);
        }

        return $query->select(
            'erp_amc_po_order.*',
            'erp_contractor.name_contractor',
            'erp_amc_provided_basis.amc_prov_base_name'
        )->get();
    }
    
    public function CreateAMCPurchaseOrder($OrderArr,$AMCPoId){
        if(filled($AMCPoId)){
            return self::where('amc_po_order_id',$AMCPoId)->update($OrderArr);
        }else{
            return self::create($OrderArr);
        }
    }
    public static function GetAMCPoDetails($AMCPoId){
        $RetDetails = NULL;
        if(filled($AMCPoId)){
            $RetDetails = AMCPurchaseOrder::where('amc_po_order_id',$AMCPoId)->where('active','1')->get();
        }else{
            $RetDetails = AMCPurchaseOrder::where('active','1')->get();
        }
        return $RetDetails;
    }
    public static function DeletAMCPOData($AMCPoId){
        if (filled($AMCPoId)) {
            DB::table('erp_amc_po_order_soq')
                ->where('amc_po_order_id', $AMCPoId)
                ->update(['active' => 0]);
            return AMCPurchaseOrder::where('amc_po_order_id', $AMCPoId)
                ->update(['active' => 0]);
        }
    }
    public static function GetAMCPOEditData($AMCPoId){
        if(filled($AMCPoId)){
            return AMCPurchaseOrder::where('amc_po_order_id',$AMCPoId)->where('active','1')->get();
        }
    }
    public static function SubmitApplication($SubmitId){
        if(filled($SubmitId)){
            return self::where('amc_po_order_id',$SubmitId)->update(['amc_po_issued' => true]);
        }
    }
    public static function GetAMCPoIssuedList(){
        return self::where('amc_po_issued','true')->orderBy('amc_po_order_id', 'DESC')->get();
    }
    // public static function GetAMCPOEditData($AMCPoId){
    //     if (filled($AMCPoId)) {
    //         return DB::table('erp_amc_po_order as po')
    //             ->leftJoin('erp_amc_po_order_soq as soq', 'po.amc_po_order_id', '=', 'soq.amc_po_order_id')
    //             ->where('po.amc_po_order_id', $AMCPoId)
    //             ->where('po.active', 1)
    //             ->where('soq.active', 1)
    //             ->select('po.*', 'soq.*')
    //             ->get();
    //     }
    // }
}
