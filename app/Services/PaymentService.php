<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Models\MaterialInwardMaster;
use App\Models\MaterialInwardDetails;
use App\Models\AMCMaterialInwardMaster;
use App\Models\AMCMaterialInwardDetails;
use App\Models\AMCPurchaseOrder;
use App\Models\AMCPurchaseOrderSoq;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderSoq;
use App\Models\Contractor;
use App\Models\Payment;
use App\Models\Indent;
use Carbon\Carbon;
use Illuminate\Support\Str;
//use Exception;
use DB;
use Helper;

class PaymentService
{
    
    public function __construct() {
    }


    public function GetMultiplePoData($PoModuleCodeList){
        $PoData = Payment::select('erp_material_inward_master.*','erp_po_order.work_order_no','erp_po_order.work_name','erp_po_order.contid','erp_po_order.cbdtid','erp_po_order.work_order_date','erp_po_order.work_order_cost','erp_po_order.work_commence_date','erp_po_order.work_duration','erp_po_order.date_of_completion','erp_po_order.work_orders_ext','erp_po_order.act_doc','erp_contractor.name_contractor','erp_contractor.addr_contractor','erp_contractor.pan_no','erp_payment.gross_amount','erp_payment.recovery_amount','erp_payment.net_amount','erp_payment.payment_id')
        ->join('erp_material_inward_master','erp_material_inward_master.master_inward_id', '=', 'erp_payment.transaction_id')
        ->join('erp_po_order','erp_po_order.work_order_id', '=', 'erp_material_inward_master.po_id')
        ->join('erp_contractor','erp_contractor.contid', '=', 'erp_po_order.contid')
        ->whereIn('erp_payment.module_code',$PoModuleCodeList)
        ->whereNull('erp_payment.status')
        ->get();
        return $PoData;
    }
    public function GetPoPaymentData($PaymentId){
        $PoData = Payment::select('erp_material_inward_master.*','erp_po_order.work_order_no','erp_po_order.work_name','erp_po_order.contid','erp_po_order.cbdtid','erp_po_order.work_order_date','erp_po_order.work_order_cost','erp_po_order.work_commence_date','erp_po_order.work_duration','erp_po_order.date_of_completion','erp_po_order.work_orders_ext','erp_po_order.act_doc','erp_contractor.name_contractor','erp_contractor.addr_contractor','erp_contractor.pan_no','erp_payment.gross_amount','erp_payment.recovery_amount','erp_payment.net_amount','erp_payment.payment_id')
        ->join('erp_material_inward_master','erp_material_inward_master.master_inward_id', '=', 'erp_payment.transaction_id')
        ->join('erp_po_order','erp_po_order.work_order_id', '=', 'erp_material_inward_master.po_id')
        ->join('erp_contractor','erp_contractor.contid', '=', 'erp_po_order.contid')
        ->where('erp_payment.payment_id',$PaymentId)
        ->get();
        return $PoData;
    }

    public function GetMultipleAmcPoData($AmcModuleCodeList){
        $PoData = Payment::select('erp_amc_material_inward_master.*','erp_amc_po_order.amc_file_name','erp_amc_po_order.equip_desc','erp_amc_po_order.contid','erp_amc_po_order.amc_cost','erp_amc_po_order.grand_total','erp_amc_po_order.gst_perc','erp_amc_po_order.cost_tax','erp_amc_po_order.bill_pay_mode','erp_amc_po_order.work_order_date','erp_amc_po_order.work_commence_date','erp_amc_po_order.work_duration','erp_amc_po_order.work_duration_mode','erp_contractor.name_contractor','erp_contractor.addr_contractor','erp_contractor.pan_no','erp_payment.gross_amount','erp_payment.recovery_amount','erp_payment.net_amount','erp_payment.payment_id')
        ->join('erp_amc_material_inward_master','erp_amc_material_inward_master.amc_master_inward_id', '=', 'erp_payment.transaction_id')
        ->join('erp_amc_po_order','erp_amc_po_order.amc_po_order_id', '=', 'erp_amc_material_inward_master.amc_po_id')
        ->join('erp_contractor','erp_contractor.contid', '=', 'erp_amc_po_order.contid')
        ->whereIn('erp_payment.module_code',$AmcModuleCodeList)
        ->whereNull('erp_payment.status')
        ->get();
        return $PoData;
    }
    public function GetAmcPoData($PaymentId){
        $PoData = Payment::select('erp_amc_material_inward_master.*','erp_amc_po_order.amc_file_name','erp_amc_po_order.equip_desc','erp_amc_po_order.contid','erp_amc_po_order.amc_cost','erp_amc_po_order.grand_total','erp_amc_po_order.gst_perc','erp_amc_po_order.cost_tax','erp_amc_po_order.bill_pay_mode','erp_amc_po_order.work_order_date','erp_amc_po_order.work_commence_date','erp_amc_po_order.work_duration','erp_amc_po_order.work_duration_mode','erp_contractor.name_contractor','erp_contractor.addr_contractor','erp_contractor.pan_no','erp_payment.gross_amount','erp_payment.recovery_amount','erp_payment.net_amount','erp_payment.payment_id')
        ->join('erp_amc_material_inward_master','erp_amc_material_inward_master.amc_master_inward_id', '=', 'erp_payment.transaction_id')
        ->join('erp_amc_po_order','erp_amc_po_order.amc_po_order_id', '=', 'erp_amc_material_inward_master.amc_po_id')
        ->join('erp_contractor','erp_contractor.contid', '=', 'erp_amc_po_order.contid')
        ->where('erp_payment.payment_id',$PaymentId)
        ->get();
        return $PoData;
    }
    
    public function GetIndentData($IndentId){
        return Indent::where('indent_id',$IndentId)->get();
    }
    
    public static function GetMaterialInwardDetailsData($paymentId){
        return DB::table('erp_payment as p')
            ->join('erp_material_inward_master as mi', 'mi.master_inward_id', '=', 'p.transaction_id')
            ->join('erp_material_inward_detail as mid', 'mid.master_inward_id', '=', 'mi.master_inward_id')
            ->where('p.payment_id', $paymentId)
            ->select(
                'mid.*',
                'mi.po_id',
                'mi.master_inward_id'
            )
            ->get();
    }
}