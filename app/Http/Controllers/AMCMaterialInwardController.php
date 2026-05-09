<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AemEmployee;
use App\Models\Contractor;
use App\Models\MaterialUnit;
use App\Models\Billpaymode;
use App\Models\AMCPurchaseOrder;
use App\Models\MaterialCertifySection;
use App\Models\AMCPurchaseOrderSoq;
use App\Models\AMCTypeMaster;
use App\Models\AMCProvidesBaseMaster;
use App\Models\LocationMaster;
use App\Models\AMCMaterialInwardMaster;
use App\Models\AMCMaterialInwardDetails;

// New services
use App\Services\WorkFlowProcessService;

use Helper;
use DB;
use Session;
use Validator;


class AMCMaterialInwardController extends Controller
{
     protected WorkFlowProcessService $WorkFlowService;
       public function __construct(
        WorkFlowProcessService $WorkFlowService,
    ) {
        $this->Employee                = new AemEmployee();
        $this->Contractor              = new Contractor();
        $this->UnitMaster              = new MaterialUnit();
        $this->Billpaymode             = new Billpaymode();
        $this->MaterialCertifySection  = new MaterialCertifySection();
        $this->AMCPurchaseOrderMaster  = new AMCPurchaseOrder();
        $this->AMCPurchaseSoq          = new AMCPurchaseOrderSoq();
        $this->AMCType                 = new AMCTypeMaster();
        $this->AMCProvidesBase         = new AMCProvidesBaseMaster();
        $this->LocationMaster          = new LocationMaster();
        $this->AMCMaterialInwardMaster  = new AMCMaterialInwardMaster();
        $this->AMCMaterialInwardDetails = new AMCMaterialInwardDetails();
        $this->WorkFlowService          = $WorkFlowService;
    }
    public function AMCMaterialInwardEntry(Request $request){
        $GetAMCMatInwardData        = NULL;
        $GetAMCMatInwardDetailsData = NULL;
        if($request ->EditId){
            if($request->btn_save){
                return $this->AMCMaterialInwardDetailsSave($request);
            }
            try{
                $EditAMCPoId        = decrypt($request->EditId);
                $FROMPage           = decrypt($request->page);
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message = "Error: Sorry, invalid attempt.";
            }
        }
        if($FROMPage != "EDIT"){
            $AMCMatInWardId              = $EditAMCPoId;
            $GetAMCMatInwardData         = $this->AMCMaterialInwardMaster->GetAMCMaterialInwardData($AMCMatInWardId);
            $EditAMCPoId                 = collect($GetAMCMatInwardData)->pluck('amc_po_id')->first();
            $GetAMCMatInwardDetailsData  = $this->AMCMaterialInwardDetails->showAMCMaterialInwardDetailsData(NULL,$AMCMatInWardId);
        }
        // if($FROMPage == 'MAT_INWAD_EDIT' || $FROMPage =='SUBMIT'){
        //     $AMCMatInWardId          = $EditAMCPoId;
        //     $GetAMCMatInwardData     = $this->AMCMaterialInwardMaster->GetAMCMaterialInwardData($AMCMatInWardId);
        //     $EditAMCPoId             = collect($GetAMCMatInwardData)->pluck('amc_po_id')->first();
        //     $AMCMatInwardDetailsData = $this->AMCMaterialInwardDetails->showAMCMaterialInwardDetailsData(NULL,$AMCMatInWardId);
        // }
        $AMCPOSoqData               = $this->AMCPurchaseSoq->GetAMCPODetialEditData($EditAMCPoId);
        $AMCPOData                  = $this->AMCPurchaseOrderMaster->GetAMCPoDetails($EditAMCPoId);
        $ShowMaterialUnit           = $this->UnitMaster->ShowMaterialUnit(NULL);
        $Contractordata             = $this->Contractor->ShowContractor();
        $AMCTypeData                = $this->AMCType->GetAMCType();
        $AMCprovidedBaseOnData      = $this->AMCProvidesBase->GetAMCprovidedBaseOn();
        $MaterialCertifySecData     = $this->MaterialCertifySection->ShowMaterialCertifySection();
        $BillpaymodeData            = $this->Billpaymode->ShowBillpaymode();
        $ShowLoacationMasterData    = $this->LocationMaster->ShowLocationMaster();
        $DesciplineData             = collect($MaterialCertifySecData)->pluck('office_name', 'office_id')->toArray();
        $AMCTypeDetials             = collect($AMCTypeData)->pluck('amc_type_name', 'amctypeid')->toArray();
        $VendorData                 = collect($Contractordata)->pluck('name_contractor', 'contid')->toArray();
        $AMCProvdedBaseData         = collect($AMCprovidedBaseOnData)->pluck('amc_prov_base_name', 'amc_prov_base_id')->toArray();
        $BillpaymodeDettails        = collect($BillpaymodeData)->pluck('pay_mode_name', 'pay_mode_id')->toArray();
        $LocationDetails            = collect($ShowLoacationMasterData)->pluck('location_name', 'location_id')->toArray();
        $UnitDataArray              = collect($ShowMaterialUnit)->pluck('uom_name', 'uom_id')->toArray();
        if($FROMPage == 'EDIT' || $FROMPage == 'MAT_INWAD_EDIT'){
            return view('amc.amc-material-inward.amc-materila-inward-creation')->with('data',compact('AMCPOSoqData','GetAMCMatInwardData','GetAMCMatInwardDetailsData','AMCPOData','AMCTypeDetials','VendorData','AMCProvdedBaseData','DesciplineData','BillpaymodeDettails','LocationDetails','UnitDataArray'));
        }else{
            return view('amc.amc-material-inward.amc-materila-inward-submit')->with('data',compact('AMCPOSoqData','GetAMCMatInwardData','GetAMCMatInwardDetailsData','AMCPOData','AMCTypeDetials','VendorData','AMCProvdedBaseData','DesciplineData','BillpaymodeDettails','LocationDetails','UnitDataArray'));
        }
    }
    public function AMCMaterialInwardList(Request $request){
        $AMCMaterialInwardMsterData = $this->AMCMaterialInwardMaster->GetMaterialInwards();
        $AmcPoIssudeData            = $this->AMCPurchaseOrderMaster->GetAMCPoIssuedList();
        $Contractordata             = $this->Contractor->ShowContractor();
        $AMCTypeData                = $this->AMCType->GetAMCType();
        $AMCprovidedBaseOnData      = $this->AMCProvidesBase->GetAMCprovidedBaseOn();
        $ShowSessionEmpdata         = $this->Employee->ShowEmployeeBySessionEmpNo(); 
        $SessionEmpSectionId        = collect($ShowSessionEmpdata)->pluck('section_id')->first();
        $AMCTypeDetials             = collect($AMCTypeData)->pluck('amc_type_name', 'amctypeid')->toArray();
        $VendorData                 = collect($Contractordata)->pluck('name_contractor', 'contid')->toArray();
        $AMCProvdedBaseData         = collect($AMCprovidedBaseOnData)->pluck('amc_prov_base_name', 'amc_prov_base_id')->toArray();
        return view('amc.amc-material-inward.amc-materila-inward-entry-submit-list')->with('data',compact('SessionEmpSectionId','AmcPoIssudeData','AMCTypeDetials','AMCProvdedBaseData','VendorData','AMCMaterialInwardMsterData'));
    }
    public function AMCMaterialInwardSubmission(Request $request){
        if($request ->EditId){
            try{
                $SubmitAMCMatId     = decrypt($request->EditId);
                $FROMPage           = decrypt($request->page);
                if(filled($SubmitAMCMatId)){
                    $IssueAMCMatInwardApplication = $this->AMCMaterialInwardMaster->IssueAMCMatInwardApplication($SubmitAMCMatId);
                }
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message = "Error: Sorry, invalid attempt.";
            }
            if(filled($IssueAMCMatInwardApplication)){
                $message   = 'AMC Work Certification submitted successfully';
                return redirect()->route('amc-material.amc-material-inward-list')->with('ALertMesage', $message);
            }else{
                $message   = 'Error: Sorry, invalid attempt.';
                return redirect()->route('amc-material.amc-material-inward-list')->with('ALertMesage', $message);
            }
        }
    }
    public function AMCMaterialInwardPaymentSubmission(Request $request){
        if(isset($request->EditId)){
            if(isset($request->btn_save)){
                return $this->AMCMaterialInwardPaymentDetailsSave($request);
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
                    if($WorkFlowAction == "AP"){
                        $PaymentDetArray    = [];
                        $ModuleCode         = 'AMC_MAT_IW';
                        $TransactionTable   = 'erp_amc_material_inward_master';
                        $ContId             = $request->hidd_cont_id;
                        $ContName           = $request->hidd_cont_name;
                        $TotalCost          = $request->hidd_total_cost;
                        $TotalPayAmout      = $request->hidd_total_pay_amout;
                        $BalanceTotalAmout  = $request->hidd_balance_amount;
                        $PaymentDetArray    = [
                            'vendorId'      => $ContId,
                            'vendorName'    => $ContName,
                            'GrossTotal'    => $TotalCost,
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
                return redirect()->route('amc-material-payment.amc-material-inward-payment-submission');
            }
            try {            
                $AMCMatInwardId = decrypt($request->EditId);
                $FromPage       = decrypt($request->page);
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) { dd($e);
                $message = "Error : Sorry Invalid Attempt";
                Session::put('ALertMesage', $message);
                return redirect()->route('amc-material-payment.amc-material-inward-payment-submission');
            }
            $Contractordata                   = $this->Contractor->ShowContractor();
            $VendorData                       = collect($Contractordata)->pluck('name_contractor', 'contid')->toArray();
            $ShowAMCMatrialInwardSubmitData   = $this->AMCMaterialInwardMaster->ShowAMCMatInwardSubmitedData(NULL,$AMCMatInwardId);
            $MaterialInwardDetailData         = $this->AMCMaterialInwardDetails->showAMCMaterialInwardDetailsData(NULL,$AMCMatInwardId); 
            $ShowMaterialUnit                 = $this->UnitMaster->ShowMaterialUnit(NULL);
            $UnitDataArray                    = collect($ShowMaterialUnit)->pluck('uom_name', 'uom_id')->toArray();
            $ShowLoacationMasterData          = $this->LocationMaster->ShowLocationMaster();
            $AMCTypeData                      = $this->AMCType->GetAMCType();
            $Contractordata                   = $this->Contractor->ShowContractor();
            $AMCprovidedBaseOnData            = $this->AMCProvidesBase->GetAMCprovidedBaseOn();
            $MaterialCertifySecData           = $this->MaterialCertifySection->ShowMaterialCertifySection();
            $BillpaymodeData                  = $this->Billpaymode->ShowBillpaymode();
            $VendorData                       = collect($Contractordata)->pluck('name_contractor', 'contid')->toArray();
            $AMCTypeDetials                   = collect($AMCTypeData)->pluck('amc_type_name', 'amctypeid')->toArray();
            $AMCProvdedBaseData               = collect($AMCprovidedBaseOnData)->pluck('amc_prov_base_name', 'amc_prov_base_id')->toArray();
            $DesciplineData                   = collect($MaterialCertifySecData)->pluck('office_name', 'office_id')->toArray();
            $BillpaymodeDettails              = collect($BillpaymodeData)->pluck('pay_mode_name', 'pay_mode_id')->toArray();
            $LocationDetails                  = collect($ShowLoacationMasterData)->pluck('location_name', 'location_id')->toArray();
            $AMCMaterialInwardApplicationData = $ShowAMCMatrialInwardSubmitData;
            $EmpNo                            = collect($AMCMaterialInwardApplicationData)->pluck('emp_no')->first() ?? NULL;
            $EmpData                          = $this->Employee->ShowEmployees($request,$EmpNo);
            $WorkFlowAction                   = NULL;
            $TargetRoles                      = collect($AMCMaterialInwardApplicationData)->pluck('target_roles')->first() ?? NULL;
            $IsCompleted                      = collect($AMCMaterialInwardApplicationData)->pluck('is_completed')->first();
            $ApprAuthRole                     = collect($AMCMaterialInwardApplicationData)->pluck('approve_auth_role')->first() ?? NULL;
            $WorkFlowActionData               = [];
            if(($IsCompleted == NULL)||($IsCompleted == false)){
                if(($TargetRoles == '')||($TargetRoles == NULL)){
                    $WorkFlowAction = 'SU'; // Submit
                    $WorkFlowActionData = ['WorkFlowAction' => $WorkFlowAction];
                }else{
                    $WorkFlowActionData = $this->WorkFlowService->CheckForwardAndBackward('AMC_MAT_IW',$AMCMatInwardId,$TargetRoles,$ApprAuthRole);
                }
            }
            if($FromPage == 'EDIT'){
                return view('amc.amc-material-inward.amc-material-inward-paymet-creation')->with('data',compact('ShowAMCMatrialInwardSubmitData','UnitDataArray','FromPage','VendorData','MaterialInwardDetailData','ShowMaterialUnit','ShowLoacationMasterData','DesciplineData','AMCTypeDetials','AMCProvdedBaseData','BillpaymodeDettails','LocationDetails'));
            }else{
                return view('amc.amc-material-inward.amc-material-inward-payment-submit')->with('data',compact('ShowAMCMatrialInwardSubmitData','UnitDataArray','FromPage','VendorData','MaterialInwardDetailData','ShowMaterialUnit','ShowLoacationMasterData','DesciplineData','AMCTypeDetials','AMCProvdedBaseData','BillpaymodeDettails','LocationDetails','WorkFlowActionData'));
            }
        }
        $ShowAMCMatInwardDetails    = $this->AMCMaterialInwardMaster->ShowAMCMatInwardSubmitedData($request,NULL);
        $AMCTypeData                = $this->AMCType->GetAMCType();
        $Contractordata             = $this->Contractor->ShowContractor();
        $AMCprovidedBaseOnData      = $this->AMCProvidesBase->GetAMCprovidedBaseOn();
        $VendorData                 = collect($Contractordata)->pluck('name_contractor', 'contid')->toArray();
        $AMCTypeDetials             = collect($AMCTypeData)->pluck('amc_type_name', 'amctypeid')->toArray();
        $AMCProvdedBaseData         = collect($AMCprovidedBaseOnData)->pluck('amc_prov_base_name', 'amc_prov_base_id')->toArray();
        return view('amc.amc-material-inward.amc-material-inward-payment-submit-list')->with('data',compact('VendorData','AMCTypeDetials','AMCProvdedBaseData','ShowAMCMatInwardDetails'));
    }
    public  function AMCMaterialInwardDetailsSave(Request $request){
        $AMCMaterialInwardId = NULL;
        $AMCMaterialInwardId = $request->input('hid_master_inward_id');
        $AMCPOId           = $request->input('hid_amc_po_id');
        $RecpNo            = $request->input('txt_receipt_no');
        $RecpDate          = $request->input('txt_receipt_date');
        $InvoiceDate       = $request->input('txt_invoice_date');
        $ReciptSuffixNo    = $request->input('hid_recipt_suffix_id');
        $InvoiceNosArray   = $request->input('invoice_nos');
        $InvoiceStr        = "INV";
        $InvoiceCount      = 1;
        $FinalInvoiceArray = [];
        // AMC MATERIAL INWARD DETAILS //
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
        // $LocationArr        = $request->input('cmb_location'); 
        $RemarksArr         = $request->input('txt_remarks'); 
        DB::beginTransaction();
        try {
            $IsUpload = NULL;
            if($request->hasfile('file_invoce_upload')){
                $IsUpload = $this->AMCMaterialInvoiceUpload($request);
            }
            // if($IsUpload >0){
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

                $SaveData['amc_po_id']            = $AMCPOId;
                $SaveData['active']               = 1;
                if(filled($AMCMaterialInwardId)){
                    $SaveData['updated_at']           = NOW();
                    $SaveData['updated_by']           = session('WcmsEmpNo');
                    $SaveMaterial = $this->AMCMaterialInwardMaster->CreateAMCMaterialInwardDeatils(NULL,$SaveData,$AMCMaterialInwardId);
                }else{
                    $SaveData['created_at']           = NOW();
                    $SaveData['created_by']           = session('WcmsEmpNo'); //dd($SaveData);
                    $SaveMaterial         = $this->AMCMaterialInwardMaster->CreateAMCMaterialInwardDeatils(NULL,$SaveData,NULL);
                    $AMCMaterialInwardId  = $SaveMaterial->amc_master_inward_id;
                }
                if(filled($AMCMaterialInwardId)){ 
                    $DeleteIntentDetails = $this->AMCMaterialInwardDetails->DeleteMaterialInwardDetails($AMCMaterialInwardId);
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
                        // $LocationId       =  $LocationArr[$MatInwardDeatilsKey];
                        $Remarks             =  $RemarksArr[$MatInwardDeatilsKey];

                        $SaveDtData['amc_master_inward_id']    = $AMCMaterialInwardId;
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
                        // $SaveDtData['location_id']          = $LocationId;
                        $SaveDtData['item_remarks']            = $Remarks;
                        $SaveDtData['active']                  = 1;
                        $SaveDtData['created_at']              = NOW();
                        $SaveDtData['created_by']              = session('WcmsEmpNo'); //dd($SaveDtData);
                        $SaveIndent = $this->AMCMaterialInwardDetails->CreateAMCMaterialInwardDetails(NULL,$SaveDtData);
                    }
                }
                DB::commit();
                $message = "AMC Work Certification Details updated successfully";
                Session::put('ALertMesage', $message);
                return redirect()->route('amc-material.amc-material-inward-list');
            // }else{
            //     $message = 'Error : Sorry transaction not fully completed';
            // }
        }catch (\Exception $e) { dd($e);
            DB::rollback();
            $message = "Error : Sorry transaction not fully completed";
            Session::put('ALertMesage', $message);
        }
        if(filled($message)){
            Session::put('ALertMesage', $message);
            return redirect()->route('amc-material.amc-material-inward-list');
        }
    }
    public function AMCMaterialInvoiceUpload (Request $request){
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
        $FileName = "Amc_Mat_invoice_doc_".$UploadTimeStr.".".$FileType; //dd($FileName);
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
      public function AMCMaterialInwardPaymentDetailsSave(Request $request){
        try {            
            $AMCMaterialInwardId  = decrypt($request->hidden_amc_mat_id);
        }catch (\Illuminate\Contracts\Encryption\DecryptException $e) { dd($e);
            $message = "Error : Sorry Invalid Attempt";
            Session::put('ALertMesage', $message);
            return redirect()->route('amc-material-payment.amc-material-inward-payment-submission');
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
        $RemarksArr        = $request->input('txt_remarks'); 
        DB::beginTransaction();
        try {
            if(filled($AMCMaterialInwardId)){
                $AMCMaterialInwardDetlet = $this->AMCMaterialInwardDetails->DeleteMaterialInwardDetails($AMCMaterialInwardId);
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
                    $Remarks             =  $RemarksArr[$MatInwardDeatilsKey];

                    $SaveDtData['amc_master_inward_id']    = $AMCMaterialInwardId;
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
                    $SaveDtData['payment_perc']            = $PayPerc;
                    $SaveDtData['total_payment_amout']     = $PayAmout;
                    $SaveDtData['location_id']             = $LocationId;
                    $SaveDtData['item_remarks']            = $Remarks;
                    $SaveDtData['active']                  = 1;
                    $SaveDtData['created_at']              = NOW();
                    $SaveDtData['created_by']              = session('WcmsEmpNo');//dd($SaveDtData);
                    $SaveIndent = $this->AMCMaterialInwardDetails->CreateAMCMaterialInwardDetails(NULL,$SaveDtData);
                }
            }
            DB::commit();
            $message = "AMC Work Certification payment Details updated Successfully";
            Session::put('ALertMesage', $message);
            return redirect()->route('amc-material-payment.amc-material-inward-payment-submission');
        }catch (\Exception $e) { dd($e);
            DB::rollback();
            $message = "Error : Sorry transaction not fully completed";
            Session::put('ALertMesage', $message);
        }
    }
}
