<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\AemEmployee;
use App\Models\Indent;
use App\Models\IndentDetail;
use App\Models\PurchaseOrder;
use App\Models\Contractor;
use App\Models\MaterialInwardMaster;
use App\Models\MaterialInwardDetails;
use App\Models\PurchaseOrderSoq;
use App\Models\MaterialUnit;
use App\Models\LocationMaster;
use App\Models\DocumentsType;
use App\Models\FieldAccesMaster;
use App\Models\SupportingDocument;
use App\Models\Payment;
use App\Models\DeliveryChallanQtyMaster;
use App\Models\DeliveryChallanDetails;

// New services
use App\Services\WorkFlowProcessService;

use Helper;
use DB;
use Session;
use Illuminate\Http\Request;

class MaterialInwardPendingPaymentController extends Controller
{
    protected WorkFlowProcessService $WorkFlowService;
       public function __construct(
        WorkFlowProcessService $WorkFlowService,
    ) {
        $this->Employee      = new AemEmployee();
        $this->Indent        = new Indent();
        $this->IndentDetail  = new IndentDetail();
        $this->PurchaseOrder = new PurchaseOrder();
        $this->Contractor    = new Contractor();
        $this->UnitMaster    = new MaterialUnit();
        $this->MaterialInwardMaster   = new MaterialInwardMaster();
        $this->MaterialInwardDetails  = new MaterialInwardDetails();
        $this->PurchaseOrderSoqDetails= new PurchaseOrderSoq();
        $this->LocationMaster         = new LocationMaster();
        $this->DocumentsType          = new DocumentsType();
        $this->FieldAccesMaster       = new FieldAccesMaster();
        $this->PaymentMaster          = new Payment();
        $this->SupportingDocMaster    = new SupportingDocument();
        $this->DeliveryChallanMaster  = new DeliveryChallanQtyMaster();
        $this->DeliveryChallanDetails = new DeliveryChallanDetails();


        $this->WorkFlowService = $WorkFlowService;
    }
    public function MaterialInwardPendingPaymentSubmit(Request $request){
        if(isset($request->SubmitId)){
            if(isset($request->Submit)){
                return $this->PendingPaymentSubmit($request);
            }
            if(isset($request->SubmitApplication)){
                try {
                    $TransactionId = decrypt($request->txt_application_id);
                    $ModuleCode    = decrypt($request->wf_module_code);
                    $PageAction    = decrypt($request->txt_action);
                    
                    $WorkFlowMode   = $request->txt_wf_mode;
                    $ActualEmpNo    = $request->txt_actual_emp;
                    $WorkFlowRemark = $request->txt_wf_remark;
                    $WorkFlowEmpNo  = $request->txt_wf_emp_no;
                    $WorkFlowRole   = $request->txt_wf_role;
                    $WorkFlowAction = $request->txt_wf_action;
                    $RolePosition   = $request->txt_role_position;
                    //dd($WorkFlowAction);
                }catch (\Illuminate\Contracts\Encryption\DecryptException $e) { dd($e);
                    $message = "Error : Sorry Invalid Attempt";
                    Session::put('ALertMesage', $message);
                    return redirect()->route('material.material-inward-submission');
                }
                if(($request->SubmitApplication == 'RJ')||($request->SubmitApplication == 'AP')){
                    $WorkFlowData = (object)['TransactionId'=>$TransactionId,'WflowModule'=>$ModuleCode,'WorkFlowMode'=>$WorkFlowMode,'ActualEmpNo'=>NULL,'WorkFlowRemark'=>$WorkFlowRemark,'WorkFlowEmpNo'=>NULL,'WorkFlowRole'=>NULL,'WorkFlowAction'=>$request->SubmitApplication,'RolePosition'=>NULL];
                }else{
                    $WorkFlowData = (object)['TransactionId'=>$TransactionId,'WflowModule'=>$ModuleCode,'WorkFlowMode'=>$WorkFlowMode,'ActualEmpNo'=>$ActualEmpNo,'WorkFlowRemark'=>$WorkFlowRemark,'WorkFlowEmpNo'=>$WorkFlowEmpNo,'WorkFlowRole'=>$WorkFlowRole,'WorkFlowAction'=>$WorkFlowAction,'RolePosition'=>$RolePosition];
                }
                $WorkFlowMessage = $this->WorkFlowService->WorkFlowMovementProcess(
                    $TransactionId,
                    $ModuleCode,
                    $WorkFlowData
                );
                Session::put('ALertMesage', $WorkFlowMessage);
                return redirect()->route('material.material-inward-submission');
            }
            try{
                $MatInwardId                   = decrypt($request->SubmitId);
                $FromPage                      = decrypt($request->page);
                $Contractordata                = $this->Contractor->ShowContractor();
                $Empdata                       = $this->Employee->ShowEmployees($request,NULL); 
                $MaterialInwardData            = $this->MaterialInwardMaster->showMaterialInwardData(NULL,$MatInwardId); 
                $MaterialInwardDetailData      = $this->MaterialInwardDetails->showMaterialInwardDetailsData(NULL,$MatInwardId); 
                $GetPoId                       = collect($MaterialInwardData)->pluck('po_id')->first();
                $showPurchaseOredrData         = $this->PurchaseOrder->showPurchaseOredrData(NULL,$GetPoId);
                $GetIndentId                   = collect($showPurchaseOredrData)->pluck('indent_id')->first();
                $ShowMaterialUnit              = $this->UnitMaster->ShowMaterialUnit(NULL);
                $UnitDataArray                 = collect($ShowMaterialUnit)->pluck('uom_name', 'uom_id')->toArray();
                $GetIndentData                 = $this->Indent->ShowIndent(NULL,$GetIndentId);
                $IndentCreateName              = collect($GetIndentData)->pluck('emp_name_payslip')->first();

                $MaterialInwardApplicationData = $MaterialInwardData;
                $WorkFlowAction = NULL;
                $TargetRoles    = collect($MaterialInwardApplicationData)->pluck('target_roles')->first() ?? NULL;
                $IsCompleted    = collect($MaterialInwardApplicationData)->pluck('is_completed')->first();
                $ApprAuthRole   = collect($MaterialInwardApplicationData)->pluck('approve_auth_role')->first() ?? NULL;
                $WorkFlowActionData = [];
                if(($IsCompleted == NULL)||($IsCompleted == false)){
                    if(($TargetRoles == '')||($TargetRoles == NULL)){
                        $WorkFlowAction = 'SU'; // Submit
                        $WorkFlowActionData = ['WorkFlowAction' => $WorkFlowAction];
                    }else{
                        $WorkFlowActionData = $this->WorkFlowService->CheckForwardAndBackward('MAT_INWARD',$MatInwardId,$TargetRoles,$ApprAuthRole);
                    }
                }
                $InvoicesDocData           = $this->SupportingDocMaster->GetSancationDocData($MatInwardId,'MAT_INWARD');
                $EmpDetails                = collect($Empdata)->pluck('emp_name_payslip','emp_no')->toArray();
                return view('material-inward.pending-payment.material-pending-payment-view-submit')->with('data',compact('InvoicesDocData','IndentCreateName','UnitDataArray','MaterialInwardData','showPurchaseOredrData','MaterialInwardDetailData','Contractordata','EmpDetails','FromPage','WorkFlowActionData'));
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message = "Error: Sorry, invalid attempt.";
            }
            if(filled($message)){
                Session::put('ALertMesage', $message);
                return redirect()->route('material.material-inward-submission');
            }
        }
    }
    public function MaterialInwardPendingPaymentList(Request $request){
        if(isset($request->EditId)){
            if(isset($request->btn_save)){
                return $this->MaterialInwardDetailsSave($request);
            }
            try{
                $MatInwardId            = decrypt($request->EditId);
                $FromPage               = decrypt($request->page);
                $MaterialInwardData     = $this->MaterialInwardMaster->showMaterialInwardData(NULL,$MatInwardId);
                $PurchaseId             = collect($MaterialInwardData)->pluck('po_id')->first();
                $Contractordata        = $this->Contractor->ShowContractor();
                $Empdata               = $this->Employee->ShowEmployees($request,NULL); 
                $ShowPurchaseOrderData = $this->PurchaseOrder->showPurchaseOredrData(NULL,$PurchaseId); //dd($showPurchaseOredrData);
                $ShowPoSoqData         = $this->PurchaseOrderSoqDetails->showPurchaseOredrSoqData(NULL,$PurchaseId); //dd($showPurchaseOredrData);
                $MaxReceiptNo          = $this->MaterialInwardMaster->ShowMaxReceipNo($request);
                $ShowMaterialUnit      = $this->UnitMaster->ShowMaterialUnit(NULL);
                $ShowLoacationMasterData   = $this->LocationMaster->ShowLocationMaster();
                $ShowMaterialInwardData    = $this->MaterialInwardMaster->GetMaterialInwardByPoId($PurchaseId);
                $GetMaterialId             = collect($ShowMaterialInwardData)->pluck('master_inward_id')->first();
                $MaterialInwardDetailData  = $this->MaterialInwardDetails->showMaterialInwardDetailsData(NULL,$MatInwardId); 
                $VendorData                = collect($Contractordata)->pluck('name_contractor', 'contid')->toArray();
                $UnitDataArray             = collect($ShowMaterialUnit)->pluck('uom_name', 'uom_id')->toArray();
                $IndentMasterData          = $this->Indent->ShowIndentDetails($request);
                return view('material-inward.pending-payment.material-inward-pending-payment-creation')->with('data',compact('FromPage','IndentMasterData','UnitDataArray','Contractordata','ShowMaterialUnit','ShowMaterialInwardData','MaterialInwardDetailData','ShowPurchaseOrderData','VendorData','Empdata','MaxReceiptNo','ShowPoSoqData','ShowLoacationMasterData'));
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message = "Error: Sorry, invalid attempt.";
            }
            if(filled($message)){
                Session::put('ALertMesage', $message);
                return redirect()->route('material.material-inward-creation');
            }
        }
        $PendingPaymentList        = [];
        $Contractordata            = $this->Contractor->ShowContractor();
        $showPurchaseOredrData     = $this->PurchaseOrder->showPurchaseOredrIssuedData($request,NULL);
        $ShowSessionEmpdata        = $this->Employee->ShowEmployeeBySessionEmpNo(); 
        $SessionEmpSectionId       = collect($ShowSessionEmpdata)->pluck('section_id')->first();
        $Vocherdata                = $this->PaymentMaster->GetCompletedPaymentsWithoutFinalBill();
        $VocherDetails             = collect($Vocherdata)->where('module_code','MAT_INWARD');
        $ShowMaterialInwardData    = $this->MaterialInwardMaster->SubmittedPendingPaymentData(); 
        $VendorArr                 = collect($Contractordata)->pluck('name_contractor','contid')->toArray();
        $MasterInwardIds           = $this->CheckPendingPaymentAllowed($request);
        $ShowAllMaterialInwardData = $this->MaterialInwardMaster->showMaterialInwardData($request,NULL);
        $ShowSubmitMatData         = collect($ShowAllMaterialInwardData)->where('mat_inward_submit', true)->pluck('master_inward_id')->toArray();
        foreach ($Vocherdata as $voucherData) {
            $OldMatInwardData = collect($ShowMaterialInwardData)->firstWhere('master_inward_id', $voucherData->transaction_id);
            if (!$OldMatInwardData) {
                continue;
            }
            $MatInwardData = collect($ShowMaterialInwardData)
                ->where('po_id', $OldMatInwardData->po_id)
                ->sortByDesc('master_inward_id')
                ->first();
            if (!$MatInwardData) {
                continue;
            }
            if (!in_array($MatInwardData->master_inward_id, $MasterInwardIds)) {
                continue;
            }
            $PurchaseOrderData = collect($showPurchaseOredrData)->firstWhere('work_order_id', $MatInwardData->po_id);
            if ($PurchaseOrderData && $PurchaseOrderData->po_issued == 'true' && $SessionEmpSectionId == $PurchaseOrderData->mat_cert_sect_id) {
                $PendingPaymentList[] = (object)[
                    'master_inward_id'   => $MatInwardData->master_inward_id,
                    'work_order_no'      => $PurchaseOrderData->work_order_no,
                    'work_name'          => $PurchaseOrderData->work_name,
                    'work_order_date'    => $PurchaseOrderData->work_order_date,
                    'vendor_name'        => $VendorArr[$PurchaseOrderData->contid] ?? '',
                    'is_pending_payment' => $MatInwardData->is_pending_payment,
                ];
            }
        }
        // foreach ($Vocherdata as $voucherData) {
        //     if (!in_array($voucherData->transaction_id, $MasterInwardIds)) {
        //         continue;
        //     }
        //     $MatInwardData = collect($ShowMaterialInwardData)->firstWhere('master_inward_id', $voucherData->transaction_id);
        //     if (!$MatInwardData) {
        //         continue;
        //     }
        //     $PurchaseOrderData = collect($showPurchaseOredrData)->firstWhere('work_order_id', $MatInwardData->po_id);
        //     if (
        //         $PurchaseOrderData &&
        //         $PurchaseOrderData->po_issued == 'true' &&
        //         $SessionEmpSectionId == $PurchaseOrderData->mat_cert_sect_id
        //     ) {
        //         $PendingPaymentList[] = (object)[
        //             'master_inward_id'   => $MatInwardData->master_inward_id,
        //             'work_order_no'      => $PurchaseOrderData->work_order_no,
        //             'work_name'          => $PurchaseOrderData->work_name,
        //             'work_order_date'    => $PurchaseOrderData->work_order_date,
        //             'vendor_name'        => $VendorArr[$PurchaseOrderData->contid] ?? '',
        //             'is_pending_payment' => $MatInwardData->is_pending_payment,
        //         ];
        //     }
        // }
        return view('material-inward.pending-payment.material-inward-pending-payment-list')->with('data',compact('PendingPaymentList','ShowAllMaterialInwardData'));
    }
    public function PendingPaymentSubmit(Request $request){
        try {
            $TransactionId = decrypt($request->txt_application_id);
        }catch (\Illuminate\Contracts\Encryption\DecryptException $e) { dd($e);
            $message = "Error : Sorry Invalid Attempt";
            Session::put('ALertMesage', $message);
            return redirect()->route('material.material-inward-pending-payment');
        }
        $SumbitMaterialInWardDetails = $this->MaterialInwardMaster->SumbitMaterialInWardDetails($TransactionId);
        if($SumbitMaterialInWardDetails == TRUE){
            $message = 'Material Inward Submited Successfully';
        }else{
            $message ='Error : Sorry Invalid Attempt';
        }
        Session::put('ALertMesage', $message);
        return redirect()->route('material.material-inward-pending-payment');
    }
    public  function MaterialInwardDetailsSave(Request $request){
        $MaterialInwardId = $request->input('hid_master_inward_id'); 
        $WorkOrderId      = $request->input('hid_work_order_id');
        $PurchaseOrNo     = $request->input('txt_purchase_order_no');
        $PurchaseOrDate   = $request->input('txt_purchase_order_date');
        $RecpNo           = $request->input('txt_receipt_no');
        $RecpDate         = $request->input('txt_receipt_date');
        $InvoiceDate      = $request->input('txt_invoice_date');
        $InvoiceNosArray  = $request->input('invoice_nos');
        $DelChallanReciptId   = $request->input('cmb_receipt_no');

        $InvoiceStr       = "INV";
        $InvoiceCount     = 1;
        $FinalInvoiceArray = [];
        // MATERIAL INWARD DETAILS //
        $ItemNoArr        = $request->input('txt_item_no'); 
        $ItemDescArr      = $request->input('txt_item_desc'); 
        $ItemUnitArr      = $request->input('txt_unit'); 
        $PoQtyArr         = $request->input('txt_po_qty'); 
        $PrevRecdQtyArr   = $request->input('txt_prev_recd_qty'); 
        $RecdNowQtyArr    = $request->input('txt_recd_now_qty'); 
        $BalanceQtyArr    = $request->input('txt_balan_qty'); 
        $RatePerUniArr    = $request->input('txt_rate_per_unit'); 
        // $GstPercArr       = $request->input('txt_gst_perc'); 
        // $GstAmtArr        = $request->input('txt_gst_amt'); 
        $ItemCheckCertiArr  = $request->input('check_certified'); 
        $TotalCostArr       = $request->input('txt_total_cost'); 
        $LocationArr        = $request->input('cmb_location'); 
        $RemarksArr         = $request->input('txt_remarks'); 
        $PaypercArr        = $request->input('txt_item_pay_perc'); 
        $PayAMoutArr       = $request->input('txt_item_payment_amt'); 
        $EmpNoArr          = $request->input('cmb_emp'); 
        DB::beginTransaction();
        try {
            // foreach ($InvoiceNosArray as $InvoId ) {
            //     $FinalInvoiceArray[$InvoiceStr.$InvoiceCount] = $InvoId;
            //     $InvoiceCount ++;
            // }
            // $FinalINvoicesJsonData = json_encode($FinalInvoiceArray);
            $GroupId    = session('WcmsEmpGroup') ?? NULL;
            $DivisionId = session('EmpDivCode') ?? NULL;
            $SectionId  = session('EmpSecCode') ?? NULL;

            $SaveData['delivery_challan_id']  = $DelChallanReciptId;
           $SaveData['receipt_date'] = NOW();
            $SaveData['invoice_date'] = NOW();
            // $SaveData['invoice_no']           = $FinalINvoicesJsonData;

            // $SaveData['grn_status']        = $ButtonValue;
            $SaveData['sheet_id']             = $WorkOrderId;
            $SaveData['po_id']                = $WorkOrderId;
            $SaveData['active']               = 1;
            $SaveData['is_pending_payment']   = true;
            if(filled($MaterialInwardId)){
                $SaveData['updated_at']           = NOW();
                $SaveData['updated_by']           = session('WcmsEmpNo');
                $SaveMaterial = $this->MaterialInwardMaster->CreateMaterialInwardDeatils(NULL,$SaveData,$MaterialInwardId);
            }else{
                $SaveData['created_at']           = NOW();
                $SaveData['created_by']           = session('WcmsEmpNo'); //dd($SaveData);
                $SaveMaterial      = $this->MaterialInwardMaster->CreateMaterialInwardDeatils(NULL,$SaveData,NULL);
                $MaterialInwardId  = $SaveMaterial->master_inward_id;
            }
            if(filled($MaterialInwardId)){ 
                if($request->hasfile('file_upload')){
                    $this->MaterialInvoiceUpload($request,$MaterialInwardId,'MAT_INWARD','INVOICE');
                }   
                $DeleteIntentDetails = $this->MaterialInwardDetails->DeleteMaterialInwardDetails($MaterialInwardId);
            }
            if(filled($PoQtyArr)){
                foreach($PoQtyArr as $MatInwardDeatilsKey => $Povalue){
                    $ItemNo              =  $ItemNoArr[$MatInwardDeatilsKey];
                    $ItemDesc            =  $ItemDescArr[$MatInwardDeatilsKey];
                    $ItemUnit            =  $ItemUnitArr[$MatInwardDeatilsKey];
                    $ItemPoQty           =  $PoQtyArr[$MatInwardDeatilsKey];
                    $ItemPrevRecQty      =  $PrevRecdQtyArr[$MatInwardDeatilsKey];
                    $ItemRecQty          =  $RecdNowQtyArr[$MatInwardDeatilsKey];
                    $ItemBalQty          =  $BalanceQtyArr[$MatInwardDeatilsKey];
                    $ItemRatePerUnit     =  $RatePerUniArr[$MatInwardDeatilsKey];
                    //$ItemGstPerc       =  $GstPercArr[$MatInwardDeatilsKey];
                    $Certified           =  $ItemCheckCertiArr[$MatInwardDeatilsKey];
                    $ItemTotalCost       =  $TotalCostArr[$MatInwardDeatilsKey];
                    $LocationId          =  $LocationArr[$MatInwardDeatilsKey];
                    $Remarks             =  $RemarksArr[$MatInwardDeatilsKey];
                    $PayPerc             =  $PaypercArr[$MatInwardDeatilsKey];
                    $PayAmout            =  $PayAMoutArr[$MatInwardDeatilsKey];
                    $EmpNo               =  $EmpNoArr[$MatInwardDeatilsKey];

                    $SaveDtData['master_inward_id']        = $MaterialInwardId;
                    $SaveDtData['item_no']                 = $ItemNo;
                    $SaveDtData['item_description']        = $ItemDesc;
                    $SaveDtData['item_unit']               = $ItemUnit;
                    $SaveDtData['po_quantity']             = $ItemPoQty;
                    $SaveDtData['previously_received_qty'] = $ItemPrevRecQty;
                    $SaveDtData['received_qty']            = $ItemRecQty;
                    $SaveDtData['balance_qty']             = $ItemBalQty;
                    $SaveDtData['unit_rate']               = $ItemRatePerUnit;
                    // $SaveDtData['gst_perc']             = $ItemGstPerc;
                    // $SaveDtData['gst_amt']              = $ItemGstAmt;
                    $SaveDtData['qty_certified']           = $Certified;
                    $SaveDtData['total_cost']              = $ItemTotalCost;
                    $SaveDtData['location_id']             = $LocationId;
                    $SaveDtData['payment_perc']            = $PayPerc;
                    $SaveDtData['total_payment_amout']     = $PayAmout;
                    $SaveDtData['emp_no']                  = $EmpNo;
                    $SaveDtData['item_remarks']            = $Remarks;
                    $SaveDtData['active']                  = 1;
                    $SaveDtData['created_at']              = NOW();
                    $SaveDtData['created_by']              = session('WcmsEmpNo'); //dd($SaveDtData);
                    $SaveIndent = $this->MaterialInwardDetails->CreateIMaterialInwardDetails(NULL,$SaveDtData);
                }
            }
            DB::commit();
            $message = "Material Inward Details updated Successfully";
            Session::put('ALertMesage', $message);
            return redirect()->route('material.material-inward-pending-payment');
        }catch (\Exception $e) { dd($e);
            DB::rollback();
            $message = "Error : Sorry transaction not fully completed";
            Session::put('ALertMesage', $message);
        }
        if(filled($message)){
            Session::put('ALertMesage', $message);
            return redirect()->route('material.material-inward-pending-payment');
        }
    }
    public function CheckPendingPaymentAllowed($request){
        $ShowMaterialInwardSubmitedData = $this->MaterialInwardMaster->SubmittedPendingPaymentData($request, NULL);
        //$ShowMaterialInwardSubmitedData = $this->MaterialInwardMaster->GetPendingPaymentData();
        $GetMaterialInwardSubmitedPoId  = collect($ShowMaterialInwardSubmitedData)->pluck('po_id');
        $GetMaterialInwardSubmitedId    = collect($ShowMaterialInwardSubmitedData)->pluck('master_inward_id');
        $MaterialData                   = $this->MaterialInwardDetails->ShowMaterialInwardData($GetMaterialInwardSubmitedId);
        $MaterialQty                    = $MaterialData->mapWithKeys(function ($item) {return [$item->item_no => $item->received_qty];});
        $PoQty = $this->PurchaseOrderSoqDetails
            ->GetPoSoqData($GetMaterialInwardSubmitedPoId)
            ->mapWithKeys(function ($item) {
                return [$item->item_no => $item->quantity];
            });
        $MatchedItems = true;
        foreach ($MaterialQty as $ItemNo => $ReceivedQty) {
            $PoQuantity = $PoQty[$ItemNo] ?? 0;
            if ($ReceivedQty != $PoQuantity) {
                $MatchedItems = false;
                break;
            }
        }
        if ($MatchedItems) {
            $TotalAccPayPerc = $MaterialData->sum('acc_payment_perc');
            if ($TotalAccPayPerc < 100) {
                return $MaterialData->pluck('master_inward_id')->unique()->values()->toArray();
            }else{
                return [];
            }
        } else {
            return $MaterialData->pluck('master_inward_id')->unique()->values()->toArray();
        }
    }
}
