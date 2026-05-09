<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\AemEmployee;
use App\Models\Indent;
use App\Models\IndentDetail;
use App\Models\PurchaseOrder;
use App\Models\Contractor;
use App\Models\ReceiptNoSequence;
use App\Models\MaterialInwardMaster;
use App\Models\MaterialInwardDetails;
use App\Models\PurchaseOrderSoq;
use App\Models\MaterialUnit;
use App\Models\LocationMaster;
use App\Models\DocumentsType;
use App\Models\FieldAccesMaster;
use App\Models\Payment;





// New services
use App\Services\WorkFlowProcessService;

use Helper;
use DB;
use Session;

use Illuminate\Http\Request;

class MaterialInwardController extends Controller
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
        $this->ReceiptNoSequence      = new ReceiptNoSequence();
        $this->MaterialInwardMaster   = new MaterialInwardMaster();
        $this->MaterialInwardDetails  = new MaterialInwardDetails();
        $this->PurchaseOrderSoqDetails= new PurchaseOrderSoq();
        $this->LocationMaster         = new LocationMaster();
        $this->DocumentsType          = new DocumentsType();
        $this->FieldAccesMaster       = new FieldAccesMaster();
        $this->PaymentMaster          = new Payment();


        $this->WorkFlowService = $WorkFlowService;
    }
    public function MaterialInwardPendingPaymentList(Request $request){
        if(isset($request->EditId)){
            try{
                $MatInwardId            = decrypt($request->EditId);
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
                return view('material-inward.material-inward-pending-payment-creation')->with('data',compact('IndentMasterData','UnitDataArray','Contractordata','ShowMaterialUnit','ShowMaterialInwardData','MaterialInwardDetailData','ShowPurchaseOrderData','VendorData','Empdata','MaxReceiptNo','ShowPoSoqData','ShowLoacationMasterData'));
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message = "Error: Sorry, invalid attempt.";
            }
            if(filled($message)){
                Session::put('ALertMesage', $message);
                return redirect()->route('material.material-inward-creation');
            }
        }
        $Contractordata           = $this->Contractor->ShowContractor();
        $showPurchaseOredrData    = $this->PurchaseOrder->showPurchaseOredrIssuedData($request,NULL);
        $ShowSessionEmpdata       = $this->Employee->ShowEmployeeBySessionEmpNo(); 
        $SessionEmpSectionId      = collect($ShowSessionEmpdata)->pluck('section_id')->first();
        $Vocherdata               = $this->PaymentMaster->ShowPendingPayment();
        $VocherDetails           = collect($Vocherdata)->where('module_code','MAT_INWARD');
        $ShowMaterialInwardData   = $this->MaterialInwardMaster->showMaterialInwardPendingPaymentData(); 
        return view('material-inward.material-inward-pending-payment-list')->with('data',compact('SessionEmpSectionId','showPurchaseOredrData','Contractordata','ShowMaterialInwardData','VocherDetails'));
    }
    public function MaterialInwardCreation(Request $request){
        if($request->SubmitId){
            if(isset($request->SubmitApplication)){
                try {
                    $TransactionId = decrypt($request->txt_application_id);
                }catch (\Illuminate\Contracts\Encryption\DecryptException $e) { dd($e);
                    $message = "Error : Sorry Invalid Attempt";
                    Session::put('ALertMesage', $message);
                    return redirect()->route('material.material-inward-creation');
                }
                $SumbitMaterialInWardDetails = $this->MaterialInwardMaster->SumbitMaterialInWardDetails($TransactionId);
                if($SumbitMaterialInWardDetails == TRUE){
                    $message = 'Material Inward Submited Successfully';
                }else{
                    $message ='Error : Sorry Invalid Attempt';
                }
                Session::put('ALertMesage', $message);
                return redirect()->route('material.material-inward-creation');
            }
            try{
                $MatInwardId               = decrypt($request->SubmitId);
                $Contractordata            = $this->Contractor->ShowContractor();
                $Empdata                   = $this->Employee->ShowEmployees($request,NULL); 
                $MaterialInwardData        = $this->MaterialInwardMaster->showMaterialInwardData(NULL,$MatInwardId); 
                $MaterialInwardDetailData  = $this->MaterialInwardDetails->showMaterialInwardDetailsData(NULL,$MatInwardId); 
                $GetPoId                   = collect($MaterialInwardData)->pluck('po_id')->first();
                $showPurchaseOredrData     = $this->PurchaseOrder->showPurchaseOredrData(NULL,$GetPoId);
                $GetIndentId               = collect($showPurchaseOredrData)->pluck('indent_id')->first();
                $ShowMaterialUnit          = $this->UnitMaster->ShowMaterialUnit(NULL);
                $UnitDataArray             = collect($ShowMaterialUnit)->pluck('uom_name', 'uom_id')->toArray();
                $MaterialInwardApplicationData = $MaterialInwardData;
                $EmpNo          = collect($MaterialInwardApplicationData)->pluck('emp_no')->first() ?? NULL;
                $EmpData        = $this->Employee->ShowEmployees($request,$EmpNo);
                $WorkFlowAction = NULL;
                $TargetRoles    = collect($MaterialInwardApplicationData)->pluck('target_roles')->first() ?? NULL;
                $IsCompleted    = collect($MaterialInwardApplicationData)->pluck('is_completed')->first();
                $ApprAuthRole   = collect($MaterialInwardApplicationData)->pluck('approve_auth_role')->first() ?? NULL;
                $GetIndentData  = $this->Indent->ShowIndent(NULL,$GetIndentId);
                $IndentCreateName = collect($GetIndentData)->pluck('emp_name_payslip')->first();
                $WorkFlowActionData = [];
                if(($IsCompleted == NULL)||($IsCompleted == false)){
                    if(($TargetRoles == '')||($TargetRoles == NULL)){
                        $WorkFlowAction = 'SU'; // Submit
                        $WorkFlowActionData = ['WorkFlowAction' => $WorkFlowAction];
                    }else{
                        $WorkFlowActionData = $this->WorkFlowService->CheckForwardAndBackward('MAT_INWARD',$MatInwardId,$TargetRoles,$ApprAuthRole);
                    }
                }
                return view('material-inward.material-view-submit')->with('data',compact('MaterialInwardData','IndentCreateName','UnitDataArray','Empdata','showPurchaseOredrData','MaterialInwardDetailData','Contractordata','Empdata','WorkFlowActionData'));
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message = "Error: Sorry, invalid attempt."; dd($e);
            }
        }
        if(isset($request->btn_save)){ 
            return $this->MaterialInwardDetailsSave($request);
        }
        if(isset($request->ViewId)){
            if(isset($request->btn_save)){ 
                return $this->MaterialInwardDetailsSave($request);
            }
            try{
                $PurchaseId            = decrypt($request->ViewId);
                $Contractordata        = $this->Contractor->ShowContractor();
                $Empdata               = $this->Employee->ShowEmployees($request,NULL); 
              //  $showPurchaseOredrData = $this->PurchaseOrder->showPurchaseOredrIndentData(NULL,$PurchaseId); //dd($showPurchaseOredrData);
                $ShowPurchaseOrderData = $this->PurchaseOrder->showPurchaseOredrData(NULL,$PurchaseId); //dd($showPurchaseOredrData);
                $ShowPoSoqData         = $this->PurchaseOrderSoqDetails->showPurchaseOredrSoqData(NULL,$PurchaseId); //dd($showPurchaseOredrData);
                $MaxReceiptNo          = $this->MaterialInwardMaster->ShowMaxReceipNo($request);
                $ShowMaterialUnit      = $this->UnitMaster->ShowMaterialUnit(NULL);
                $UnitDataArray         = collect($ShowMaterialUnit)->pluck('uom_name', 'uom_id')->toArray();
                $ShowLoacationMasterData   = $this->LocationMaster->ShowLocationMaster();
                $ShowMaterialInwardData    = $this->MaterialInwardMaster->GetMaterialInwardByPoId($PurchaseId);
                $GetMaterialId             = collect($ShowMaterialInwardData)->pluck('master_inward_id')->first();
                $MaterialInwardDetailData  = $this->MaterialInwardDetails->showMaterialInwardDetailsData(NULL,$GetMaterialId); 
                $IndentMasterData          = $this->Indent->ShowIndentDetails($request);
                return view('material-inward.material-inward-creation')->with('data',compact('UnitDataArray','IndentMasterData','ShowMaterialInwardData','MaterialInwardDetailData','ShowPurchaseOrderData','Contractordata','Empdata','MaxReceiptNo','ShowPoSoqData','ShowLoacationMasterData'));
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message = "Error: Sorry, invalid attempt.";
            }
            if(filled($message)){
                Session::put('ALertMesage', $message);
                return redirect()->route('material.material-inward-creation');
            }
        }
        $Contractordata           = $this->Contractor->ShowContractor();
        // $showPurchaseOredrData = $this->PurchaseOrder->showPurchaseOredrData($request,NULL);
        $showPurchaseOredrData    = $this->PurchaseOrder->showPurchaseOredrIssuedData($request,NULL);
        $ShowSessionEmpdata       = $this->Employee->ShowEmployeeBySessionEmpNo(); 
        $SessionEmpSectionId      = collect($ShowSessionEmpdata)->pluck('section_id')->first();
        $ShowMaterialInwardData   = $this->MaterialInwardMaster->showMaterialInwardData($request,NULL);
        return view('material-inward.material-inward-list')->with('data',compact('showPurchaseOredrData','Contractordata' ,'SessionEmpSectionId','ShowMaterialInwardData'));
    }
    public function MaterialInwardSubmission (Request $request){
        if(isset($request->EditId)){
            if(isset($request->btn_save)){
                return $this->MaterialInwardPaymentDetailsSave($request);
            }
            try {            
                $MatInwardId = decrypt($request->EditId);
                $FromPage    = decrypt($request->page);
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) { dd($e);
                $message = "Error : Sorry Invalid Attempt";
                Session::put('ALertMesage', $message);
                return redirect()->route('material.material-inward-submission');
            }
            $Contractordata                = $this->Contractor->ShowContractor();
            $VendorData                    = collect($Contractordata)->pluck('name_contractor', 'contid')->toArray();
            $ShowMatrialInwardSubmitData   = $this->MaterialInwardMaster->GetMatInwardSubmitData(NULL,$MatInwardId);
            $MaterialInwardDetailData      = $this->MaterialInwardDetails->showMaterialInwardDetailsData(NULL,$MatInwardId); 
            $ShowMaterialUnit              = $this->UnitMaster->ShowMaterialUnit(NULL);
            $ShowLoacationMasterData       = $this->LocationMaster->ShowLocationMaster();
            $MaterialInwardApplicationData = $ShowMatrialInwardSubmitData;
            $EmpNo          = collect($MaterialInwardApplicationData)->pluck('emp_no')->first() ?? NULL;
            $EmpData        = $this->Employee->ShowEmployees($request,$EmpNo);
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
            return view('material-inward.material-inward-paymet-creation')->with('data',compact('ShowMatrialInwardSubmitData','FromPage','VendorData','MaterialInwardDetailData','WorkFlowActionData','ShowMaterialUnit','ShowLoacationMasterData'));
        }
        if(isset($request->Id)){
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
                $MatInwardId               = decrypt($request->Id);
                $FromPage                  = decrypt($request->page);
                $Contractordata            = $this->Contractor->ShowContractor();
                $Empdata                   = $this->Employee->ShowEmployees($request,NULL); 
                $MaterialInwardData        = $this->MaterialInwardMaster->showMaterialInwardData(NULL,$MatInwardId); 
                $MaterialInwardDetailData  = $this->MaterialInwardDetails->showMaterialInwardDetailsData(NULL,$MatInwardId); 
                $showPurchaseOredrData     = $this->PurchaseOrder->showPurchaseOredrData($request,NULL);

                $MaterialInwardApplicationData = $MaterialInwardData;
                $EmpNo          = collect($MaterialInwardApplicationData)->pluck('emp_no')->first() ?? NULL;
                $EmpData        = $this->Employee->ShowEmployees($request,$EmpNo);
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
                return view('material-inward.material-view-submit')->with('data',compact('MaterialInwardData','showPurchaseOredrData','MaterialInwardDetailData','Contractordata','Empdata','FromPage','WorkFlowActionData'));
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message = "Error: Sorry, invalid attempt.";
            }
            if(filled($message)){
                Session::put('ALertMesage', $message);
                return redirect()->route('material.material-inward-submission');
            }
        }
        // dd($request);
        $Contractordata              = $this->Contractor->ShowContractor();
        $showPurchaseOredrData       = $this->PurchaseOrder->showPurchaseOredrData($request,NULL);
        $showMaterialInwardData      = $this->MaterialInwardMaster->showMaterialInwardData($request,NULL);
        $VendorArr                   = collect($Contractordata)->pluck('name_contractor', 'contid')->toArray();
        $ShowMatrialInwardSubmitData = $this->MaterialInwardMaster->GetMatInwardSubmitData($request,NULL);
        return view('material-inward.material-inward-submission-list')->with('data',compact('showPurchaseOredrData','VendorArr','ShowMatrialInwardSubmitData'));
    }
    public function MaterialInwardPaymentSubmission (Request $request){
        if(isset($request->EditId)){
            if(isset($request->SubmitApplication)){
                $IsPaymentEditAccess         = $request->input('hidd_ispayemt_edit'); 
                if($IsPaymentEditAccess == 'Y'){
                    $IsSaved =  $this->MaterialInwardPaymentDetailsSave($request);
                    if(!$IsSaved){
                        $message = "Error : Sorry transaction not fully completed";
                        Session::put('ALertMesage', $message);
                    }
                }
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
                    if($WorkFlowAction == "AP"){
                        $PaymentDetArray    = [];
                        $ModuleCode         = 'MAT_INWARD';
                        $TransactionTable   = 'erp_material_inward_master';
                        $ContId             = $request->hidd_cont_id;
                        $ContName           = $request->hidd_cont_name;
                        $TotalCost          = $request->hidd_total_cost;
                        $TotalPayAmout      = $request->hidd_total_pay_amout;
                        $BalanceTotalAmout  = $request->hidd_balance_amount;
                        $PaymentDetArray    = [
                            'vendorId'      => $ContId,
                            'vendorName'    => $ContName,
                            'GrossTotal'    => $TotalPayAmout,
                            'TotalPayAmout' => $TotalPayAmout,
                            'BalanceAmout'  => $TotalPayAmout
                        ];
                        $SavePaymentDetails = Helper::SavePaymentDetails(NULL,$TransactionId,$TransactionTable,$ModuleCode,$PaymentDetArray);
                    }
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
                $WorkFlowMessage = $this->WorkFlowService->WorkFlowMovementProcess($TransactionId,$ModuleCode,$WorkFlowData);
                Session::put('ALertMesage', $WorkFlowMessage);
                return redirect()->route('material.material-inward-submission');
            }
            try {            
                $MatInwardId = decrypt($request->EditId);
                $FromPage    = decrypt($request->page);
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) { dd($e);
                $message = "Error : Sorry Invalid Attempt";
                Session::put('ALertMesage', $message);
                return redirect()->route('material.material-inward-submission');
            }
            $Contractordata                = $this->Contractor->ShowContractor();
            $VendorData                    = collect($Contractordata)->pluck('name_contractor', 'contid')->toArray();
            $ShowMatrialInwardSubmitData   = $this->MaterialInwardMaster->GetMatInwardSubmitData(NULL,$MatInwardId);
            $MaterialInwardDetailData      = $this->MaterialInwardDetails->showMaterialInwardDetailsData(NULL,$MatInwardId); 
            $ShowMaterialUnit              = $this->UnitMaster->ShowMaterialUnit(NULL);
            $UnitDataArray                 = collect($ShowMaterialUnit)->pluck('uom_name', 'uom_id')->toArray();
            $ShowLoacationMasterData       = $this->LocationMaster->ShowLocationMaster();
            $SessionWiseFiledAcessData     = $this->FieldAccesMaster->ShowSessionRoleWiseFieldData(NULL,'MAT_INWARD','PAY_PERC_DET');
           // $SessionWiseFiledAcessData     = collect($SessionWiseFiledAcessData)->where('is_editable',true);
            // $PaymentPercFieldAccess        = (count($SessionWiseFiledAcessData) > 0) ? 'Y' : '';
            $MaterialInwardApplicationData = $ShowMatrialInwardSubmitData;
            $EmpNo          = collect($MaterialInwardApplicationData)->pluck('emp_no')->first() ?? NULL;
            $EmpData        = $this->Employee->ShowEmployees($request,$EmpNo);
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
            return view('material-inward.material-inward-payment-submit')->with('data',compact('SessionWiseFiledAcessData','ShowMatrialInwardSubmitData','UnitDataArray','FromPage','VendorData','MaterialInwardDetailData','WorkFlowActionData','ShowMaterialUnit','ShowLoacationMasterData'));
        }
    }
    public  function MaterialInwardDetailsSave(Request $request){
        $ButtonValue      = $request->input('btn_save');
        $MaterialInwardId = $request->input('hid_master_inward_id'); 
        $IndentId         = $request->input('hid_indent_id');
        $WorkOrderId      = $request->input('hid_work_order_id');
        $PurchaseOrNo     = $request->input('txt_purchase_order_no');
        $PurchaseOrDate   = $request->input('txt_purchase_order_date');
        $RecpNo           = $request->input('txt_receipt_no');
        $RecpDate         = $request->input('txt_receipt_date');
        $InvoiceDate      = $request->input('txt_invoice_date');
        $ReciptSuffixNo   = $request->input('hid_recipt_suffix_id');
        $InvoiceNosArray  = $request->input('invoice_nos');
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
            $IsUpload = NULL;
            if($request->hasfile('file_invoce_upload')){
                $IsUpload = $this->MaterialInvoiceUpload($request);
            }
            if($IsUpload >0){
                foreach ($InvoiceNosArray as $InvoId ) {
                    $FinalInvoiceArray[$InvoiceStr.$InvoiceCount] = $InvoId;
                    $InvoiceCount ++;
                }
                $FinalINvoicesJsonData = json_encode($FinalInvoiceArray);
                $GroupId    = session('WcmsEmpGroup') ?? NULL;
                $DivisionId = session('EmpDivCode') ?? NULL;
                $SectionId  = session('EmpSecCode') ?? NULL;

                $SaveData['receiptno']            = $RecpNo;
                $SaveData['receipt_date']         = Helper::DBDateFormat($RecpDate);
                $SaveData['invoice_date']         = Helper::DBDateFormat($InvoiceDate);
                $SaveData['invoice_no']           = $FinalINvoicesJsonData;

                // $SaveData['grn_status']        = $ButtonValue;
                $SaveData['sheet_id']             = $WorkOrderId;
                $SaveData['po_id']                = $WorkOrderId;
                $SaveData['active']               = 1;
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
                return redirect()->route('material.material-inward-creation');
            }else{
                $message = 'Error : Sorry transaction not fully completed';
            }
        }catch (\Exception $e) { dd($e);
            DB::rollback();
            $message = "Error : Sorry transaction not fully completed";
            Session::put('ALertMesage', $message);
        }
        if(filled($message)){
            Session::put('ALertMesage', $message);
            return redirect()->route('material.material-inward-creation');
        }
    }
    public function MaterialInvoiceUpload (Request $request){
        $InvoiceFile    = $request->file('file_invoce_upload');
        $UploadExe      = 0;
        $validator = Validator::make(
            $request->all(),
            [
                'file_invoce_upload' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',// max:2048 specifies the maximum size in kilobytes (2MB)
            ],
            [
                'file_invoce_upload.required' => 'Error: Please select an invoice file to upload.',
                'file_invoce_upload.file'     => 'Error: The upload must be a valid file.',
                'file_invoce_upload.mimes'    => 'Error: Only JPG, PNG, and PDF files are allowed.',
                'file_invoce_upload.max'      => 'Error: The invoice size must not exceed 2MB.',
            ]
        );
        if($validator->fails()) { 
            $message = $validator->errors()->first(); 
            Session::put('ALertMesage', $message); 
        }

        $message     = NULL;
        $OrgFileName = $InvoiceFile->getClientOriginalName();
        $Extension   = $InvoiceFile->getClientOriginalExtension();

        $UploadTimeStr = date("YmdHis");
        $FileType = $InvoiceFile->getClientOriginalExtension();
        $FileName = "Mat_invoice_doc_".$UploadTimeStr.".".$FileType; //dd($FileName);
        $IsUpload = NULL;
        try {
            if($InvoiceFile) {
                $IsUpload = Helper::UploadFile($InvoiceFile,$FileName,'MAT_INWARD','INVOICE');
            }else{
                $IsUpload = 'UE';
            }
        }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $IsUpload = 'UE';
        }
        if($IsUpload == "Y"){
            $UploadExe++;
        }
        return $UploadExe;
    }
    public function MaterialInwardPaymentDetailsSave(Request $request){
        try {            
            $MaterialInwardId  = decrypt($request->hidden_mat_id);
        }catch (\Illuminate\Contracts\Encryption\DecryptException $e) { dd($e);
            $message = "Error : Sorry Invalid Attempt";
            Session::put('ALertMesage', $message);
            return redirect()->route('material.material-inward-submission');
        }
        $ItemNoArr         = $request->input('txt_item_no'); 
        $ItemDescArr       = $request->input('txt_item_desc'); 
        $ItemUnitArr       = $request->input('txt_unit'); 
        $PoQtyArr          = $request->input('txt_po_qty'); 
        $PrevRecdQtyArr    = $request->input('txt_prev_recd_qty'); 
        $RecdNowQtyArr     = $request->input('txt_recd_now_qty'); 
        $BalanceQtyArr     = $request->input('txt_balan_qty'); 
        $RatePerUniArr     = $request->input('txt_rate_per_unit'); 
        $ItemCheckCertiArr = $request->input('check_certified'); 
        $TotalCostArr      = $request->input('txt_total_cost'); 
        $PaypercArr        = $request->input('txt_item_pay_perc'); 
        $PayAMoutArr       = $request->input('txt_item_payment_amt'); 
        $LocationArr       = $request->input('cmb_location'); 
        $AccPaymentPerc    = $request->input('txt_acc_item_pay_perc'); 
        $AccPaymentPercAmt = $request->input('txt_acc_item_payment_amt'); 
        $RemarksArr        = $request->input('item_remarks'); 
        $AccRemarksArr     = $request->input('txt_acc_remarks'); 
        DB::beginTransaction();
        try {
            if(filled($MaterialInwardId)){
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
                    $PayPerc             =  $PaypercArr[$MatInwardDeatilsKey];
                    $PayAmout            =  $PayAMoutArr[$MatInwardDeatilsKey];
                    $LocationId          =  $LocationArr[$MatInwardDeatilsKey];
                    $ItemRemarks         =  $RemarksArr[$MatInwardDeatilsKey];
                    $AccPayPerc          =  $AccPaymentPerc[$MatInwardDeatilsKey];
                    $AccPayAmout         =  $AccPaymentPercAmt[$MatInwardDeatilsKey];
                    $AccRemarks          =  $AccRemarksArr[$MatInwardDeatilsKey];

                    $SaveDtData['master_inward_id']        = $MaterialInwardId;
                    $SaveDtData['item_no']                 = $ItemNo;
                    $SaveDtData['item_description']        = $ItemDesc;
                    $SaveDtData['item_unit']               = $ItemUnit;
                    $SaveDtData['po_quantity']             = $ItemPoQty;
                    $SaveDtData['previously_received_qty'] = $ItemPrevRecQty;
                    $SaveDtData['received_qty']            = $ItemRecQty;
                    $SaveDtData['balance_qty']             = $ItemBalQty;
                    $SaveDtData['unit_rate']               = $ItemRatePerUnit;
                    $SaveDtData['acc_payment_perc']        = $AccPayPerc;
                    $SaveDtData['acc_total_payment_amt']   = $AccPayAmout;
                    $SaveDtData['qty_certified']           = $Certified;
                    $SaveDtData['total_cost']              = $ItemTotalCost;
                    $SaveDtData['payment_perc']            = $PayPerc;
                    $SaveDtData['total_payment_amout']     = $PayAmout;
                    $SaveDtData['location_id']             = $LocationId;
                    $SaveDtData['item_remarks']            = $ItemRemarks;
                    $SaveDtData['acc_remarks']            = $AccRemarks;
                    $SaveDtData['active']                  = 1;
                    $SaveDtData['created_at']              = NOW();
                    $SaveDtData['created_by']              = session('WcmsEmpNo');//dd($SaveDtData);
                    $SaveIndent = $this->MaterialInwardDetails->CreateIMaterialInwardDetails(NULL,$SaveDtData);
                }
            }
            DB::commit();
            return true;
        }catch (\Exception $e) { dd($e);
            DB::rollback();
            $message = "Error : Sorry transaction not fully completed";
            Session::put('ALertMesage', $message);
        }
    }
}
