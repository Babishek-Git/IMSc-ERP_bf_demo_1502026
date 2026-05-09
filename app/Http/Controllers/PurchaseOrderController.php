<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\MaterialType;
use App\Models\AemEmployee;
use App\Models\Indent;
use App\Models\IndentDetail;
use App\Models\Contractor;
use App\Models\ContractorDetail;
use App\Models\PurchaseOrder;
use App\Models\WorkFlow;
use App\Models\WorkFlowMovement;
use App\Models\MaterialCertifySection;
use App\Models\PurchaseOrderSoq;
use App\Models\Billpaymode;
use App\Models\AgmOffice;
use App\Models\MaterialUnit;
use App\Models\BudgetSanctionExpenditureMaster;
use App\Models\SupportingDocument;


use Helper;
use DB;
use Session;
class PurchaseOrderController extends Controller
{
     public function __construct(){ 
        $this->Indent       = new Indent();
        $this->IndentDetail = new IndentDetail();
        $this->Contractor   = new Contractor();
        $this->PurchaseOrder  = new PurchaseOrder();
        $this->ContractDetail = new ContractorDetail();
        $this->Employee       = new AemEmployee();
        $this->MaterialCertifySection  = new MaterialCertifySection();
        $this->PurchaseOrderSoqDetails = new PurchaseOrderSoq();
        $this->Billpaymode             = new Billpaymode();
        $this->EmpOfficeData           = new AgmOffice();
        $this->UnitMaster              = new MaterialUnit();
        $this->BudSanExpMaster         = new BudgetSanctionExpenditureMaster();
        $this->SupportingDocMaster     = new SupportingDocument();

    }
    public function PurchaseOrderForm(Request $request) {
        if(isset($request->btn_save))
        {
            return $this->SavePurchaseOrderDetails($request);
        }
        $Indentdata              = $this->Indent->ShowApprovedIndent($request);
        $Contractordata          = $this->Contractor->ShowContractor();
        $MaterialCertifySecData  = $this->MaterialCertifySection->ShowMaterialCertifySection();
        $MaxPOSuffixNo           = $this->PurchaseOrder->POMaxSuffixNo($request);
        $BillpaymodeData         =   $this->Billpaymode->ShowBillpaymode();
        $IndetCreateIcNo         = collect($Indentdata)->pluck('created_by')->first();
        $Empdata                 = $this->Employee->ShowEmployees(NULL,$IndetCreateIcNo); 
        $GetSancationProcessData = $this ->SupportingDocMaster->GetSancationDocData(NULL,'INDENT');
        $GetSancationIndentIds   = collect($GetSancationProcessData)->pluck('transaction_id')->toArray();
        return view('purchase-order.purchase-order_form')->with('data',compact('Indentdata','GetSancationIndentIds','Contractordata','MaterialCertifySecData','MaxPOSuffixNo','BillpaymodeData','Empdata'));
    }
    public function PurchaseOrderView(Request $request){
        if(isset($request->EditId)){
            if(isset($request->btn_save)){
                return $this->SavePurchaseOrderDetails($request);
            }
            if(isset($request->SubmitApplication)){
                 try{
                    $PoId            = decrypt($request->txt_application_id);
                    $IndentId        = $request->hid_indent_id;
                    $IsssudePoOrder  = $this->PurchaseOrder->SavePoIssued($PoId);
                    $CurrentStage    = 'PO';
                    if($IsssudePoOrder == TRUE){
                        $TransactionId = $PoId;
                        $SaveBudgetExpData = $this->SaveBudgetExpenditureDetails($request,$TransactionId,$IndentId,$CurrentStage);
                        $message = 'Purchase Order Issue Successfully';
                    }else{
                        $message = 'Sorry, try again ....!';
                    }
                } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                    $message = "Error: Sorry, invalid attempt.";
                }
                if(filled($message)){
                    Session::put('ALertMesage', $message);
                    return redirect()->route('purchase-order.purchase-order_view');
                }
            }
            try{
                $PurchaseEditId         = decrypt($request->EditId);
                $FromPage               = decrypt($request->page);
                $Flag                   = !empty($request->FLAG) ? decrypt($request->FLAG) : '';
                $ShowPurchaseEditData   = $this->PurchaseOrder->showPurchaseOredrData(NULL,$PurchaseEditId);
                $PuchaseApplicationData = $ShowPurchaseEditData;
                $EmpNo                  = collect($PuchaseApplicationData)->pluck('emp_no')->first() ?? NULL;
                $EmpData                = $this->Employee->ShowEmployees($request,$EmpNo);
                $WorkFlowAction         = NULL;
                $TargetRoles            = collect($PuchaseApplicationData)->pluck('target_roles')->first() ?? NULL;
                $IsCompleted            = collect($PuchaseApplicationData)->pluck('is_completed')->first();
                $ApprAuthRole           = collect($PuchaseApplicationData)->pluck('approve_auth_role')->first() ?? NULL;
                $WorkFlowActionData     = [];
                if(($IsCompleted == NULL)||($IsCompleted == false)){
                    if(($TargetRoles == '')||($TargetRoles == NULL)){
                        $WorkFlowAction = 'SU'; // Submit
                        $WorkFlowActionData = ['WorkFlowAction' => $WorkFlowAction];
                    }else{
                        $WorkFlowActionData = $this->WorkFlowService->CheckForwardAndBackward('INDENT',$PurchaseEditId,$TargetRoles,$ApprAuthRole);
                    }
                }
                $OfficeData           = $this->EmpOfficeData->ShowOfficeWithRepToOffice(NULL);
                $Indentdata           = $this->Indent->ShowIndent(null,null);
                $Contractordata       = $this->Contractor->ShowContractor();
                $OfficeDetails        = collect($OfficeData)->pluck('office_name','office_id')->toArray(); 
                $ShowPoItemDetailsData  = $this->PurchaseOrderSoqDetails->showPurchaseOredrSoqData(NULL,$PurchaseEditId);
                $ShowMaterialUnit       = $this->UnitMaster->ShowMaterialUnit(NULL);
                $Empdata                = $this->Employee->ShowEmployees($request,NULL);
                $MaterialCertifySecData = $this->MaterialCertifySection->ShowMaterialCertifySection();
                $BillpaymodeData        = $this->Billpaymode->ShowBillpaymode();
                if($FromPage == 'EDIT'){
                    $GetIndentId        = collect($PuchaseApplicationData)->pluck('indent_id')->first();
                    $POIndentData       = $this->Indent->ShowIndent(NULL,$GetIndentId);
                    $IndetCreateIcNo    = collect($POIndentData)->pluck('emp_no')->first();
                    $IndentEmpdata      = $this->Employee->ShowEmployees(NULL,$IndetCreateIcNo);
                    return view('purchase-order.purchase-order_form')->with('data',compact('Contractordata','MaterialCertifySecData','BillpaymodeData','POIndentData','IndentEmpdata','FromPage','ShowMaterialUnit','ShowPoItemDetailsData','ShowPurchaseEditData'));
                }else{
                    $ContractorDetails  = collect($Contractordata)->pluck('name_contractor','contid')->toArray();
                    return view('purchase-order.purchase-order-view-submit')->with('data',compact('ContractorDetails','ShowPoItemDetailsData','ShowMaterialUnit','Indentdata','OfficeDetails','ShowPurchaseEditData','FromPage','WorkFlowActionData'));
                }
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message = "Error: Sorry, invalid attempt.";
            }
            if(filled($message)){
                Session::put('ALertMesage', $message);
                return redirect()->route('indent.indent-view');
            }
        }
        $Contractordata    = $this->Contractor->ShowContractor();
        $ShowPurchaseData  = $this->PurchaseOrder->showPurchaseOredrData($request,NULL);
        return view('purchase-order.purchase-order_view_list')->with('data',compact('ShowPurchaseData','Contractordata'));
    }
    public function PurchaseOrderRegister(Request $request){
        //  $FROMPage = NULL;
        //  if($request ->ViewId){
        //     try{
        //         $PoId        = decrypt($request->ViewId);
        //         $FROMPage           = decrypt($request->page);
        //     } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
        //         $message = "Error: Sorry, invalid attempt.";
        //     }
        // }
        // if($FROMPage == 'VIEW'){
        //     $PORegisterData         = $this->PurchaseOrder->showPurchaseOredrData(NULL,$PoId);
        //     $ShowPoItemDetailsData  = $this->PurchaseOrderSoqDetails->showPurchaseOredrSoqData(NULL,$PoId);
        // }
        // $OfficeData            = $this->EmpOfficeData->ShowOfficeWithRepToOffice(NULL);
        // $OfficeDetails          = collect($OfficeData)->pluck('office_name','office_id')->toArray(); 
        // $ShowMaterialUnit       = $this->UnitMaster->ShowMaterialUnit(NULL);
        // $Contractordata         = $this->Contractor->ShowContractor();
        // $ShowPurchaseIssueData  = $this->PurchaseOrder->showPurchaseOredrIssuedData($request);
        // if($FROMPage ='VIEW'){
        //     return view('purchase-order.purchase-order-register-view')->with('data',compact('Contractordata','PORegisterData','ShowPoItemDetailsData','ShowMaterialUnit','OfficeDetails'));
        // }else{
        //     return view('purchase-order.purchase-order-register-list')->with('data',compact('Contractordata','ShowPurchaseIssueData'));
        // }
        $OfficeData            = $this->EmpOfficeData->ShowOfficeWithRepToOffice(NULL);
        $OfficeDetails          = collect($OfficeData)->pluck('office_name','office_id')->toArray(); 
        $ShowMaterialUnit       = $this->UnitMaster->ShowMaterialUnit(NULL);
        $Contractordata         = $this->Contractor->ShowContractor();
        $ShowPurchaseIssueData  = $this->PurchaseOrder->showPurchaseOredrIssuedData($request);
        return view('purchase-order.purchase-order-register-list')->with('data',compact('Contractordata','ShowPurchaseIssueData'));

    }
    public function SavePurchaseOrderDetails(Request $request){
        $PoEditId           =  NULL;
        $IndentId           =  $request->cmb_indent_no_date;
        $IndentTitle        =  $request->txt_indent_title;
        $MateCertifyId      =  $request->rad_mat_cert_by;
        $WorkMode           =  $request->cmb_work_duration_mode;
        $PurchaseOrderNo    =  $request->txt_pur_order_no;
        $PurchaseOrderName  =  $request->txt_pur_order_name;
        $PurchaseOrderDate  =  $request->txt_pur_order_date;
        $PurchaseOrderAmount=  $request->txt_pur_amt;
        $VendorId           =  $request->cmb_vendor_name;
        $StartDate          =  $request->txt_start_date;
        $EndDate            =  $request->txt_end_date;
        $QuotationDate      =  $request->txt_quotation_date;
        $PcomStatus         =  $request->rad_pcom;
        $TrNo               =  $request->txt_tender_no;
        $PoSuffixNo         =  $request->hid_po_suff_no;
        $WorkDuration       =  $request->txt_work_duration;
        $WrkDurMode         =  $request->cmb_work_duration;
        $PaymentMode        =  $request->cmb_bill_pay_mode;
        $PoEditId           =  $request->hidd_po_id;
        DB::beginTransaction();
        try {
            // if($PcomStatus == 'YES' || $PcomStatus == 'NO' ){
            //     $QuotationDate = null;
            // }else if(filled($QuotationDate) || $QuotationDate != NULL){
            //     $PcomStatus = NULL;
            // }
            if($QuotationDate == NULL){
                $QuotationDate = null;
            }
            $SaveData['indent_id']          = $IndentId;
            $SaveData['mat_cert_sect_id']   = $MateCertifyId;
            $SaveData['work_order_no']      = $PurchaseOrderNo;
            $SaveData['work_name']          = $PurchaseOrderName;
            $SaveData['work_order_date']    = $PurchaseOrderDate;
            $SaveData['work_order_cost']    = $PurchaseOrderAmount;
            $SaveData['work_commence_date'] = $StartDate;
            $SaveData['work_duration']      = $WorkDuration;
            $SaveData['date_of_completion'] = $EndDate;
            $SaveData['contid']             = $VendorId;
            $SaveData['quotation_date']     = $QuotationDate;
            $SaveData['pcom_status']        = $PcomStatus;
            $SaveData['tr_no']              = $TrNo;
            $SaveData['po_suffix_no']       = $PoSuffixNo;
            $SaveData['work_duration_mode'] = $WrkDurMode;
            $SaveData['bill_pay_mode']      = $PaymentMode;
            $SaveData['active']             = 1;//dd($SaveData);
            if(filled($PoEditId)){
                $SaveData['updated_at']         = NOW();
                $SaveData['updated_by']         = session('WcmsEmpNo'); 
                $SavePurchase  = $this->PurchaseOrder->CreatePurchaseOrder($SaveData,$PoEditId);
                $DeletPoSoqDet = $this->PurchaseOrderSoqDetails->DeletePoDetails($PoEditId);
                $Po_Wo_Id      = $PoEditId;
            }else{
                $SaveData['created_at']         = NOW();
                $SaveData['created_by']         = session('WcmsEmpNo'); 
                $SavePurchase = $this->PurchaseOrder->CreatePurchaseOrder($SaveData,NULL);
                $Po_Wo_Id     = $SavePurchase->work_order_id;
            }
            $ItemNoArr             = $request->input('txt_sno');
            $ServiceNameArr        = $request->input('txt_item_goods_service_name');
            $QuantityArr           = $request->input('txt_item_quantity_req_name');
            $ItemUnitIdArr         = $request->input('txt_unit');
            $EstimatedPriceArr     = $request->input('txt_item_estimate_no');
            $ItemAmoutArr          = $request->input('txt_item_amout');
            $ItemTaxTypeArr        = $request->input('cmb_tax_type');
            $TotalCostArr          = $request->input('txt_item_total_cost');
            $IndentDetailsArr      = $request->input('hidden_indent_det_id');
             if(filled($QuantityArr)){
                foreach($QuantityArr as $QtyKey => $MaterialType){
                    $ItemNo              =  $ItemNoArr[$QtyKey];
                    $ServiceName         =  $ServiceNameArr[$QtyKey];
                    $Quanitity           =  $QuantityArr[$QtyKey];
                    $EstimatedPrice      =  $EstimatedPriceArr[$QtyKey];
                    $TotalCost           =  $TotalCostArr[$QtyKey];
                    $ItemUnitId          =  $ItemUnitIdArr[$QtyKey];
                    $ItemTaxType         =  $ItemTaxTypeArr[$QtyKey];
                    $ItemAmout           =  $ItemAmoutArr[$QtyKey];
                    $IndentDetId         =  $IndentDetailsArr[$QtyKey];
                    $SaveDtData['po_id']                = $Po_Wo_Id;
                    $SaveDtData['indent_det_id']        = $IndentDetId;
                    $SaveDtData['item_description']     = $ServiceName;
                    $SaveDtData['quantity']             = $Quanitity;
                    $SaveDtData['estimated_unit_price'] = $EstimatedPrice;
                    $SaveDtData['item_no']              = $ItemNo;
                    $SaveDtData['tax_type']             = $ItemTaxType;
                    $SaveDtData['unit_id']              = $ItemUnitId;
                    $SaveDtData['item_amount']          = $ItemAmout;
                    $SaveDtData['gst_price']            = null;
                    $SaveDtData['gst_mode']             = null;
                    $SaveDtData['total_cost']           = $TotalCost;
                    $SaveDtData['active']               = 1;
                    $SaveDtData['created_at']           = NOW();
                    $SaveDtData['created_by']           = session('WcmsEmpNo');//dd($SaveDtData);
                    $SaveIndent = $this->PurchaseOrderSoqDetails->CreatePoSoqDetail($SaveDtData);
                }
            }
            DB::commit();
            $message = "";
        }catch (\Exception $e) {dd($e);
            DB::rollback();
            $message = "Error : Sorry transaction not fully completed";
            Session::put('ALertMesage', $message);
        }
        if(filled($PoEditId)){
            $message   = 'Purchase Order Details Update Successfully';
            return redirect()->route('purchase-order.purchase-order_view')->with('ALertMesage', $message);
        }else{
            $message   = 'Purchase Order Details Saved Successfully';
            return redirect()->route('purchase-order.purchase-order_form')->with('ALertMesage', $message);
        }
    }
     public function SaveBudgetExpenditureDetails($request,$TransactionId,$IndentId,$CurrentStage){ 
        DB::beginTransaction();
        try {
            $ModuleCode            = 'INDENT';
            $GetExpData            = $this->BudSanExpMaster->ShowBudgetExpData($IndentId,$ModuleCode);
            $IndetBudGetExpDetails = collect($GetExpData)->where('current_stage', "IA")->first();
            $PORegisterData        = $this->PurchaseOrder->showPurchaseOredrData(NULL,$TransactionId);
            $PoCost                = collect($PORegisterData)->pluck('work_order_cost')->first();
            $GetSancationId        = $IndetBudGetExpDetails->budget_sanction_id ?? NULL;
            $GetGiaId              = $IndetBudGetExpDetails->gia_id ?? NULL;
            $IndentProjId          = $IndetBudGetExpDetails->project_id ?? NULL;
            $ParentProjId          = $IndetBudGetExpDetails->project_parent_id ?? NULL;
            $ObjHeadId             = $IndetBudGetExpDetails->object_head_id ?? NULL;
            $ObjSubCatId           = $IndetBudGetExpDetails->oh_sub_cata_id ?? NULL;
            $ProjUptoUtilizedAmt   = $IndetBudGetExpDetails->proj_upto_dt_utilized_amt ?? NULL;
            $ProjBalanceAmt        = $IndetBudGetExpDetails->proj_balance_amt ?? NULL;
            $OHUptoUtilizedAmt     = $IndetBudGetExpDetails->oh_upto_dt_utilized_amt ?? NULL;
            $OHBalanceAmt          = $IndetBudGetExpDetails->oh_balance_amt ?? NULL;
            $IndentTotalCost       = $IndetBudGetExpDetails->current_utilized_amt ?? NULL;
            $SaveData['transaction_id']       = $TransactionId;
            $SaveData['budget_sanction_id']   = $GetSancationId;
            $SaveData['current_stage']        = $CurrentStage;
            $SaveData['module_code']          = 'PO';
            $SaveData['gia_id']               = $GetGiaId;
            $SaveData['project_id']           = $IndentProjId;
            $SaveData['project_parent_id']    = $ParentProjId;
            $SaveData['object_head_id']       = $ObjHeadId;
            $SaveData['oh_sub_cata_id']       = $ObjSubCatId;
            $SaveData['budget_allocation_id']      = $GetSancationId;
            $SaveData['proj_upto_dt_utilized_amt'] = $ProjUptoUtilizedAmt;
            $SaveData['proj_balance_amt']          = $ProjBalanceAmt;
            $SaveData['oh_upto_dt_utilized_amt']   = $OHUptoUtilizedAmt;
            $SaveData['oh_balance_amt']            = $OHBalanceAmt;
            $SaveData['current_utilized_amt']      = $PoCost;
            $SaveData['active']                    = 1;
            $SaveData['created_at']                = NOW();
            $SaveData['created_by']                = session('WcmsEmpNo');//dd($SaveData);
            $this->BudSanExpMaster->BudgetExpDetatilsCreate($SaveData);
            DB::commit();
        }
        catch (\Exception $e) { dd($e);
            DB::rollback();
            $message = "Error : Sorry transaction not fully completed";
            Session::put('ALertMesage', $message);
        }
    }
}
