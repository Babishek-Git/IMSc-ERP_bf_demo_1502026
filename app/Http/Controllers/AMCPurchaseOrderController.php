<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
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

use Illuminate\Http\Request;
// New services
use App\Services\WorkFlowProcessService;

use Helper;
use DB;
use Session;

class AMCPurchaseOrderController extends Controller
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
        $this->UnitMaster              = new MaterialUnit();
        $this->AMCPurchaseSoq          = new AMCPurchaseOrderSoq();
        $this->AMCType                 = new AMCTypeMaster();
        $this->AMCProvidesBase         = new AMCProvidesBaseMaster();
        $this->LocationMaster          = new LocationMaster();
        $this->WorkFlowService         = $WorkFlowService;
    }
    public function AMCPurchaseOrderCreation(Request $request){
        $EditAMCPoId = NULL;
        $FROMPage    = NULL;
        if($request ->btn_save){
            return $this->SaveAMCPurchaseOrderDetails($request);
        }
        if($request ->EditId){
            try{
                $EditAMCPoId        = decrypt($request->EditId);
                $FROMPage           = decrypt($request->page);
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message = "Error: Sorry, invalid attempt.";
            }
            if($FROMPage == 'SUBMIT'){
                $SubmitAMCPOApplication = $this->AMCPurchaseOrderMaster->SubmitApplication($EditAMCPoId);
                if($SubmitAMCPOApplication == TRUE){
                    $message = 'AMC Purchase Order submitted ';
                    return redirect()->route('amc-purchase-order.amc-purchase-order-submission')->with('ALertMesage', $message);
                }else{
                    $message = 'AMC Purchase Order Details could not be submitted';
                    return redirect()->route('amc-purchase-order.amc-purchase-order-submission')->with('ALertMesage', $message);
                }
            }
        }
        $Empdata                   = $this->Employee->ShowEmployees($request,NULL); 
        $Contractordata            = $this->Contractor->ShowContractor();
        $BillpaymodeData           = $this->Billpaymode->ShowBillpaymode();
        $MaterialCertifySecData    = $this->MaterialCertifySection->ShowMaterialCertifySection();
        $ShowMaterialUnit          = $this->UnitMaster->ShowMaterialUnit(NULL);
        $AMCPoMasterEditData       = $this->AMCPurchaseOrderMaster->GetAMCPOEditData($EditAMCPoId);
        $AMCPoDetailEditData       = $this->AMCPurchaseSoq->GetAMCPODetialEditData($EditAMCPoId);
        $AMCTypeData               = $this->AMCType->GetAMCType();
        $AMCprovidedBaseOnData     = $this->AMCProvidesBase->GetAMCprovidedBaseOn();
        $ShowLoacationMasterData   = $this->LocationMaster->ShowLocationMaster();
        $DesciplineData            = collect($MaterialCertifySecData)->pluck('office_name', 'office_id')->toArray();
        $AMCTypeDetials            = collect($AMCTypeData)->pluck('amc_type_name', 'amctypeid')->toArray();
        $AMCProvdedBaseData        = collect($AMCprovidedBaseOnData)->pluck('amc_prov_base_name', 'amc_prov_base_id')->toArray();
        $VendorData                = collect($Contractordata)->pluck('name_contractor', 'contid')->toArray();
        $BillpaymodeDettails       = collect($BillpaymodeData)->pluck('pay_mode_name', 'pay_mode_id')->toArray();
        $LocationDetails           = collect($ShowLoacationMasterData)->pluck('location_name', 'location_id')->toArray();
        if($FROMPage =='SUBMISSION_VIEW'){
            return view('amc.amc-purchase-order.amc-purchase-order-submit')->with('data',compact('DesciplineData','BillpaymodeDettails','AMCTypeDetials','AMCProvdedBaseData','VendorData','LocationDetails','AMCTypeData','AMCprovidedBaseOnData','Contractordata','BillpaymodeData','MaterialCertifySecData','ShowMaterialUnit','AMCPoMasterEditData','AMCPoDetailEditData'));
        }else{
            return view('amc.amc-purchase-order.amc-purchase-order_creation')->with('data',compact('Empdata','ShowLoacationMasterData','AMCTypeData','AMCprovidedBaseOnData','Contractordata','BillpaymodeData','MaterialCertifySecData','ShowMaterialUnit','AMCPoMasterEditData','AMCPoDetailEditData'));
        }
    }
    public function AMCPurchaseOrderEditSubmit(Request $request){
        if($request ->DeleteId){
            try{
                $AMCPoId            = decrypt($request->DeleteId);
                $FROMPage           = decrypt($request->page);
                $DeleteAmcPoDetails = $this->AMCPurchaseOrderMaster->DeletAMCPOData($AMCPoId);
                if($DeleteAmcPoDetails == TRUE){
                    $message = 'AMC Purchase Order Details Deleted';
                    return redirect()->route('amc-purchase-order.amc-purchase-order-submission')->with('ALertMesage', $message);
                }else{
                    $message = 'Sorry, try again ....!';
                    return redirect()->route('amc-purchase-order.amc-purchase-order-submission')->with('ALertMesage', $message);
                }
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message = "Error: Sorry, invalid attempt.";
            }
        }
        $ShowAMCPOData             = $this->AMCPurchaseOrderMaster->GetAMCPoDetails(NULL);
        $AMCTypeData               = $this->AMCType->GetAMCType();
        $AMCprovidedBaseOnData     = $this->AMCProvidesBase->GetAMCprovidedBaseOn();
        $Contractordata            = $this->Contractor->ShowContractor();
        $AMCTypeData               = collect($AMCTypeData)->pluck('amc_type_name', 'amctypeid')->toArray();
        $AMCProvdedBaseData        = collect($AMCprovidedBaseOnData)->pluck('amc_prov_base_name', 'amc_prov_base_id')->toArray();
        $VendorData                = collect($Contractordata)->pluck('name_contractor', 'contid')->toArray();
        return view('amc.amc-purchase-order.amc-purchase-order-edit-submit-list')->with('data',compact('ShowAMCPOData','VendorData','AMCTypeData','AMCProvdedBaseData'));
    }
    public function AMCPurchaseOrderRegister(Request $request){
        $FROMPage = NULL;
         if($request ->ViewId){
            try{
                $EditAMCPoId        = decrypt($request->ViewId);
                $FROMPage           = decrypt($request->page);
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message = "Error: Sorry, invalid attempt.";
            }
        }
        if($FROMPage == 'VIEW'){
            $AMCPORegisterData         = $this->AMCPurchaseOrderMaster->GetAMCPoDetails($EditAMCPoId);
            $AMCPoDetailEditData       = $this->AMCPurchaseSoq->GetAMCPODetialEditData($EditAMCPoId);
        }
        $AMCPORegisterData         = $this->AMCPurchaseOrderMaster->GetAMCPoIssuedList();
        $AMCTypeData               = $this->AMCType->GetAMCType();
        $AMCprovidedBaseOnData     = $this->AMCProvidesBase->GetAMCprovidedBaseOn();
        $Contractordata            = $this->Contractor->ShowContractor();
        $MaterialCertifySecData    = $this->MaterialCertifySection->ShowMaterialCertifySection();
        $BillpaymodeData           = $this->Billpaymode->ShowBillpaymode();
        $ShowLoacationMasterData   = $this->LocationMaster->ShowLocationMaster();
        $AMCTypeData               = collect($AMCTypeData)->pluck('amc_type_name', 'amctypeid')->toArray();
        $AMCProvdedBaseData        = collect($AMCprovidedBaseOnData)->pluck('amc_prov_base_name', 'amc_prov_base_id')->toArray();
        $VendorData                = collect($Contractordata)->pluck('name_contractor', 'contid')->toArray();
        $DesciplineData            = collect($MaterialCertifySecData)->pluck('office_name', 'office_id')->toArray();
        $BillpaymodeDettails       = collect($BillpaymodeData)->pluck('pay_mode_name', 'pay_mode_id')->toArray();
        $LocationDetails           = collect($ShowLoacationMasterData)->pluck('location_name', 'location_id')->toArray();
        if($FROMPage == 'VIEW'){
            return view('amc.amc-purchase-order.amc-purchase-order-register-view')->with('data',compact('DesciplineData','BillpaymodeDettails','LocationDetails','AMCPORegisterData','AMCPoDetailEditData','VendorData','AMCTypeData','AMCProvdedBaseData'));
        }else{
            return view('amc.amc-purchase-order.amc-purchase-order-register-list')->with('data',compact('AMCPORegisterData','VendorData','AMCTypeData','AMCProvdedBaseData'));
        }
    }
    public function SaveAMCPurchaseOrderDetails(Request $request){
        $PoEditId             = NULL;      
        $DesciplineId         =  $request->cmb_discipline;
        $AmcTypeId            =  $request->cmb_amc_type;
        $BaseOnId             =  $request->cmb_bases_on;
        $AmcFileName          =  $request->txt_amc_file_name;
        $EquiDesc             =  $request->txt_desc_equip;
        $VendorId             =  $request->cmb_vendor_name;
        $AmcCost              =  $request->txt_amsc_cost;
        $AmcGstPerc           =  $request->txt_amsc_gst;
        $TaxType              =  $request->rad_tax_inc;
        $LocationIdArray      =  $request->cmb_loc_name;
        $BillPayMode          =  $request->cmb_bill_pay_mode;
        $GrandTotal           =  $request->txt_total_amout;
        $PoEditId             =  $request->hid_amc_po_id;
        $TotalAmcPoAmt        =  $request->hidden_total_po_amt;
        $WrkDuration          =  $request->txt_work_duration;
        $WrkMode              =  $request->cmb_work_duration;
        $WrkStartDate         =  $request->txt_start_date;
        $WrkEndDate           =  $request->txt_end_date;
        $LocationStr          = "LOC";
        $LocationCount        = 1;
        $FinalLocationIdArray = [];
        //SOQ ITEM DETAILS //////////
        $ItemNoArr             = $request->input('txt_sno');
        $ServiceNameArr        = $request->input('txt_item_goods_service_name');
        $QuantityArr           = $request->input('txt_item_quantity_req_name');
        $ItemUnitIdArr         = $request->input('txt_unit');
        $EstimatedPriceArr     = $request->input('txt_item_estimate_no');
        $ItemAmoutArr          = $request->input('txt_item_amout');
        $ItemTaxTypeArr        = $request->input('cmb_tax_type');
        $TotalCostArr          = $request->input('txt_item_total_cost');
        DB::beginTransaction();
        try {
            if(filled($LocationIdArray)){
                foreach ($LocationIdArray as $LocId ) {
                    $FinalLocationIdArray[$LocationStr.$LocationCount] = $LocId;
                    $LocationCount ++;
                }
            }
            $FinalLocationJsonData = json_encode($FinalLocationIdArray);
            $SaveData['discipline_id']  = $DesciplineId;
            $SaveData['amc_type_id']    = $AmcTypeId;
            $SaveData['amc_baseson_id'] = $BaseOnId;
            $SaveData['amc_file_name']  = $AmcFileName;
            $SaveData['equip_desc']     = $EquiDesc;
            $SaveData['contid']         = $VendorId;
            $SaveData['amc_cost']       = $AmcCost;
            $SaveData['gst_perc']       = $AmcGstPerc;
            $SaveData['cost_tax']       = $TaxType;
            $SaveData['location_id']    = $FinalLocationJsonData;
            $SaveData['bill_pay_mode']  = $BillPayMode;
            $SaveData['grand_total']    = $GrandTotal;
            $SaveData['work_duration']        = $WrkDuration;
            $SaveData['work_duration_mode']   = $WrkMode;
            $SaveData['work_starting_date']   = $WrkStartDate;
            $SaveData['work_completion_date'] = $WrkEndDate;
            $SaveData['active']         = 1;
            if(filled($PoEditId)){
                $SaveData['created_at']         = NOW();
                $SaveData['created_by']         = session('WcmsEmpNo'); 
                $SavePurchase = $this->AMCPurchaseOrderMaster->CreateAMCPurchaseOrder($SaveData,$PoEditId);
                $AMC_Po_Wo_Id = $PoEditId;
            }else{
                $SaveData['created_at']         = NOW();
                $SaveData['created_by']         = session('WcmsEmpNo'); 
                $SavePurchase = $this->AMCPurchaseOrderMaster->CreateAMCPurchaseOrder($SaveData,NULL);
                $AMC_Po_Wo_Id = $SavePurchase->amc_po_order_id;
            }
             if(filled($QuantityArr)){
                foreach($QuantityArr as $QtyKey => $MaterialType){
                    $ItemNo              =  $ItemNoArr[$QtyKey];
                    $ServiceName         =  $ServiceNameArr[$QtyKey];
                    $Quanitity           =  $QuantityArr[$QtyKey];
                    $EstimatedPrice      =  $EstimatedPriceArr[$QtyKey];
                    $TotalCost           =  $TotalCostArr[$QtyKey];
                    $ItemUnitId          =  $ItemUnitIdArr[$QtyKey];
                    // $ItemTaxType         =  $ItemTaxTypeArr[$QtyKey];
                    $ItemAmout           =  $ItemAmoutArr[$QtyKey];
                    $SaveDtData['amc_po_order_id']      = $AMC_Po_Wo_Id;
                    $SaveDtData['item_description']     = $ServiceName;
                    $SaveDtData['quantity']             = $Quanitity;
                    $SaveDtData['estimated_unit_price'] = $EstimatedPrice;
                    $SaveDtData['item_no']              = $ItemNo;
                    // $SaveDtData['tax_type']             = $ItemTaxType;
                    $SaveDtData['tax_type']             = null;
                    $SaveDtData['unit_id']              = $ItemUnitId;
                    $SaveDtData['item_amount']          = $ItemAmout;
                    $SaveDtData['gst_price']            = null;
                    $SaveDtData['gst_mode']             = null;
                    $SaveDtData['indent_det_id']        = null;
                    $SaveDtData['total_cost']           = $TotalCost;
                    $SaveDtData['active']               = 1;
                    $SaveDtData['created_at']           = NOW();
                    $SaveDtData['created_by']           = session('WcmsEmpNo');//dd($SaveDtData);
                    $SaveIndent = $this->AMCPurchaseSoq->CreateMAMCPoSoqDetail($SaveDtData);
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
            $message   = 'Purchase Order Details Update';
            return redirect()->route('amc-purchase-order.amc-purchase-order-submission')->with('ALertMesage', $message);
        }else{
            $message   = 'AMC Purchase Order Details Saved';
            return redirect()->route('amc-purchase-order.amc-purchase-order-creation')->with('ALertMesage', $message);
        }
    }
}
