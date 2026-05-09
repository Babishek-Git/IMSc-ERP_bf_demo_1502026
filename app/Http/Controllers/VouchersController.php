<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\ImscAccount;
use App\Models\RbiSanction;
use App\Models\Ledger;
use App\Models\LedgerGroup;
use App\Models\TransactionGroup;
use App\Models\ObjectHeadGroup;
use App\models\PayRollMaster;
use App\models\PayRollEmployee;
use App\Services\TransactionMappingService;
use App\Models\EmployeeGroupMaster;
use App\Models\Payment;
use App\Models\PaymentObjectHead;
use App\Models\PaymentRecovery;
use App\Models\PayRollComponent;
use App\Models\PayComponent;
use App\Models\PaymentType;
use App\Models\ObjectHead;
use App\Models\ObjectHeadSubCategory;
use App\Models\Indent;
use App\Models\Recovery;
use App\Models\ContractorDetail;
use App\Models\ContractorGST;
use App\Models\PaymentModule;
use App\Models\AemEmployee;
use App\Models\EmployeePayBank;
use App\Models\work_flow_modules;
use App\Models\Gia;
use App\Models\ProjectMaster;
use Helper;
use DB;
use Session;
class VouchersController extends Controller
{
    protected TransactionMappingService $TransactionMappService;
    public function __construct(
        TransactionMappingService $TransactionMappService,
    ){
        $this->ImscAccount  = new ImscAccount();
        $this->RBI          = new RbiSanction();
        $this->Ledger       = new Ledger();
        $this->LedgerGroup       = new LedgerGroup();
        $this->TransactionGroup = new TransactionGroup();
        $this->ObjectHeadGroup = new ObjectHeadGroup();
        $this->PayRollMaster = new PayRollMaster();
        $this->PayRollEmployee = new PayRollEmployee();
        $this->EmployeeGroupMaster = new EmployeeGroupMaster();
        $this->Payment = new Payment();
        $this->PaymentObjectHead = new PaymentObjectHead();
        $this->PaymentRecovery = new PaymentRecovery();
        $this->PayRollComponent = new PayRollComponent();
        $this->PayComponent = new PayComponent();
        $this->PaymentType = new PaymentType();
        $this->ObjectHead = new ObjectHead();
        $this->ObjectHeadSubCategory = new ObjectHeadSubCategory();
        $this->Indent = new Indent();
        $this->Recovery = new Recovery();
        $this->ContractorDetail = new ContractorDetail();
        $this->ContractorGST = new ContractorGST();
        $this->PaymentModule = new PaymentModule();
        $this->Employee = new AemEmployee();
        $this->EmployeePayBank = new EmployeePayBank();
        $this->WorkFlowModule = new work_flow_modules();
        $this->ProjectMaster = new ProjectMaster();
        $this->Gia = new Gia();

        $this->TransactionMappService = $TransactionMappService;
    }
    public function VoucherCreationList(Request $request){ 
        if(isset($request->btnSave)){ 
            $SaveVoucherNoList   = $request->txt_voucher_no;
            $SaveVoucherDateList = $request->txt_voucher_date;
            $SaveVoucherAmtList  = $request->txt_voucher_amt;
            $SavePaymentIdList  = $request->txt_payment_id;
            DB::beginTransaction();
            try {
                if(isset($SaveVoucherNoList)){
                    foreach($SaveVoucherNoList as $SaveVoucherNokey => $SaveVoucherNo){
                        $SaveVoucherDate    = $SaveVoucherDateList[$SaveVoucherNokey];
                        if($SaveVoucherDate != ''){
                            $SaveVoucherDate = Helper::DBDateFormat($SaveVoucherDate);
                        }
                        $SaveVoucherAmount  = $SaveVoucherAmtList[$SaveVoucherNokey];
                        $SavePaymentId      = $SavePaymentIdList[$SaveVoucherNokey];
                        if(($SaveVoucherNo != '')&&($SaveVoucherNo != NULL)&&($SaveVoucherDate != '')&&($SaveVoucherDate != NULL)&&($SaveVoucherAmount != '')&&($SaveVoucherAmount != NULL)){
                            $SaveArr['voucher_no']  = $SaveVoucherNo;
                            $SaveArr['voucher_dt']  = $SaveVoucherDate;
                            $SaveArr['voucher_amt'] = $SaveVoucherAmount;
<<<<<<< Updated upstream
=======
                            $SaveArr['is_completed'] = true;
                            $SaveArr['is_approved'] = true;
                            $SaveArr['status']      = 'completed';
>>>>>>> Stashed changes
                            $PaymentList = $this->Payment->UpdatePayment($SaveArr,$SavePaymentId);
                        }
                    }
                }
            DB::commit();
                $message = "Voucher data saved successfully"; 
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message = "Error : Voucher data not saved. Please try again"; 
            }
            Session::put('ALertMesage', $message); 
            return redirect()->route('Voucher.voucher-creation-list');
        }
        $PaymentList = $this->Payment->ShowPaymentForVoucherCreate();  
        $ModuleCodeList = filled($PaymentList) ? collect($PaymentList)->pluck('module_code')->toArray() : [];  
        $PaymentIdList = filled($PaymentList) ? collect($PaymentList)->pluck('payment_id')->toArray() : [];
        $ModuleData = $this->WorkFlowModule->ShowMultipleWorkFlowModulesByModuleCode($ModuleCodeList);
        $PaymentObjectHeadData = $this->PaymentObjectHead->ShowMultiplePaymentObjectHead($PaymentIdList);
        $PaymentObjectHeadList = filled($PaymentObjectHeadData) ? collect($PaymentObjectHeadData)->groupBy('payment_id') : [];
        
        $ObjectHeadIdList = filled($PaymentObjectHeadData) ? collect($PaymentObjectHeadData)->pluck('object_head_id')->toArray() : [];
        $ObjectHeadSubCataIdList = filled($PaymentObjectHeadData) ? collect($PaymentObjectHeadData)->pluck('object_head_sub_cata_id')->toArray() : [];
        $ProjectIdList = filled($PaymentObjectHeadData) ? collect($PaymentObjectHeadData)->pluck('project_id')->toArray() : [];
        $GiaIdList = filled($PaymentObjectHeadData) ? collect($PaymentObjectHeadData)->pluck('gia_id')->toArray() : [];
        $LedgerIdList = filled($PaymentObjectHeadData) ? collect($PaymentObjectHeadData)->pluck('ledger_id')->toArray() : [];
        $LedgerGroupIdList = filled($PaymentObjectHeadData) ? collect($PaymentObjectHeadData)->pluck('ledger_group_id')->toArray() : [];

        $ObjectHeadData = $this->ObjectHead->ShowMultipleObjectHeadById($ObjectHeadIdList);
        $ObjectHeadSubCataData = $this->ObjectHeadSubCategory->ShowMultipleObjectHeadSubCataById($ObjectHeadSubCataIdList);
        $GiaData = $this->Gia->ShowMultipleGiaById($GiaIdList);
        $LedgerData = $this->Ledger->ShowMultipleLedgerById($LedgerIdList);
        $LedgerGroupData = $this->LedgerGroup->ShowLedgerGroup(NULL,$LedgerGroupIdList);
        $ProjectData = $this->ProjectMaster->ShowMultipleProjectById($ProjectIdList);

        $ObjectHeadList = filled($ObjectHeadData) ? collect($ObjectHeadData)->keyBy('object_head_id') : [];
        $ObjectHeadSubCataList = filled($ObjectHeadSubCataData) ? collect($ObjectHeadSubCataData)->keyBy('object_head_sub_cata_id') : [];
        $GiaList = filled($GiaData) ? collect($GiaData)->keyBy('gia_id') : [];
        $LedgerList = filled($LedgerData) ? collect($LedgerData)->keyBy('ledger_id') : [];
        $LedgerGroupList = filled($LedgerGroupData) ? collect($LedgerGroupData)->keyBy('ledger_group_id') : [];
        $ProjectList = filled($ProjectData) ? collect($ProjectData)->keyBy('project_id') : [];

        $ModuleDataList = filled($ModuleData) ? collect($ModuleData)->keyBy('wf_module_code') : [];  
        return view('vouchers.creation-list', compact('PaymentList','ModuleDataList','PaymentObjectHeadList','ObjectHeadList','ObjectHeadSubCataList','GiaList','LedgerList','LedgerGroupList','ProjectList'));
    }
    public function Vouchers(Request $request) {

        $IMScData   = $this->ImscAccount->ShowImscAccount();
        $RBIData    = $this->RBI->ShowRBISanction();
        $Ledger     = $this->Ledger->ShowLedger(); 
        $LedgerGroup  = $this->LedgerGroup->AllLeafNodesOnly();
        if(filled($Ledger)){
            $LedgerData = $Ledger->groupBy('ledger_group_id');
        }else{
            $LedgerData = [];
        } 
        $ledger1 = $request->pluck('id2');
        $TransactionGroup     = $this->TransactionGroup->ShowTransactionGroup(NULL);
        $ObjectHeads     = $this->ObjectHeadGroup->ShowAllParentChild();
        return view('vouchers.vouchers')->with('data', compact('IMScData','RBIData','Ledger','TransactionGroup','ObjectHeads','LedgerGroup','LedgerData'));//->with('data', compact('OrganizationList'));
    }
    public function GetTransactionData($request,$ParamData) {
        try {
            $TransactionType = $request->TransactionType;
        }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return NULL;
        }
        if($TransactionType != ''){
            if($TransactionType == 'SALARY'){
                $SalaryData = [];
                $PendingPayrollData = $this->PayRollMaster->getPendingPayrollData();  
                if(filled($PendingPayrollData)){
                    $PendingPayrollGroupedData = $PendingPayrollData->keyBy('payroll_master_id');
                    $PendingPayrollIdList = $PendingPayrollData->pluck('payroll_master_id')->toArray(); 
                    if(filled($PendingPayrollIdList)){

                        $PayRollEmpData = $this->PayRollEmployee->getPendingPayrollDataByMultipleIdEmpGroup($PendingPayrollIdList,$ParamData['EmpGroupCode']); 
                        
                        if(filled($PayRollEmpData)){
                            foreach($PayRollEmpData as $PayRollEmpDataKey => $PayRollEmpDataValue){
                                $TempArr = [];
                                $PayRollMonthYear = NULL;
                                $PayRollId = $PayRollEmpDataValue->payroll_master_id;
                                if(isset($PendingPayrollGroupedData[$PayRollId])){
                                    $PayRollMastData = $PendingPayrollGroupedData[$PayRollId];
                                    if(filled($PayRollMastData)){
                                        $PayRollMonthYear = $PayRollMastData->payroll_month_year;
                                    }
                                }
                                $TempArr['PayRollId'] = $PayRollEmpDataValue->payroll_master_id;
                                $TempArr['PayRollMonthYear'] = $PayRollMonthYear;
                                $TempArr['PayRollAmt'] = $PayRollEmpDataValue->total_amount;
                                $SalaryData[] = $TempArr;
                            }
                        }
                    }
                }
                return $SalaryData;
            }else if($TransactionType == 'INTSALARY'){
                $PayRollEmpData = $this->PayRollEmployee->getHoldPayrollEmployeeData();
                if(isset($ParamData['EmpGroupCode'])){
                    $PayRollEmpData = $PayRollEmpData->whereIn('emp_group_code',$ParamData['EmpGroupCode']);
                }
                return $PayRollEmpData;
            }
        }
    }
    public function GetTransactionMappingData(Request $request){
        try {
            $RequestPage = $request->Page;
            if($RequestPage == "VOUCHER"){
                $TransactionType = $request->TransactionType;
                $TransactionGroup = $request->TransactionGroup;
            }else{
                $TransactionType = NULL;
                $TransactionGroup = NULL;
            }
            $TransactionId = $request->TransactionId;
        }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return NULL;
        }
        $TransactionMappData = $this->TransactionMappService->GetTransactionMappingData($TransactionId,$TransactionType,$TransactionGroup);
        return $TransactionMappData;
    }
    public function GetLegderGroupPayData(Request $request){
        $RetData = NULL;
        //// Get Ledger and amount details from multiple table (payroll, ltc, etc.,) based on Ledger Group Id
        //// Get Ledger and amount details from multiple table (payroll, ltc, etc.,) based on Ledger Id
        try {
            $TransactionType = $request->TransactionType; // Payment / Receipt..etc
            $TransactionId = $request->TransactionId; // Ledger Id
            $TransactionGroup = $request->TransactionGroup; // Ledger or ledger Group
            $LedgerGroup = $request->LedgerGroup;
        }catch (\Illuminate\Contracts\Encryption\DecryptException $e) { 
            return NULL;
        } 
        $LedgerObjHeadMapData = $this->TransactionMappService->GetLegderObjectHeadMapByLedgerId($TransactionId);
        if(filled($LedgerObjHeadMapData)){ 
            $LedgerGroupId          = $LedgerObjHeadMapData->pluck('ledger_group_id')->first();
            $ObjectHeadId           = $LedgerObjHeadMapData->pluck('object_head_id')->first();
            $ObjectHeadSubCataId    = $LedgerObjHeadMapData->pluck('object_head_sub_cata_id')->first();
            $ProjectId              = $LedgerObjHeadMapData->pluck('project_id')->first();
            $GiaId                  = $LedgerObjHeadMapData->pluck('gia_id')->first();
            $ObjectHeadGiaMappId    = $LedgerObjHeadMapData->pluck('oh_gia_mapp_id')->first();
            $LedgerOHApplicableTo   = $LedgerObjHeadMapData->pluck('applicable_emp_group')->first();

            $ObjectHeadCode = $this->TransactionMappService->GetObjectHeadCode($ObjectHeadSubCataId,$ObjectHeadId);


            if($LedgerOHApplicableTo != NULL){ 
                $ExpLedgerOHApplicableTo = explode(",",$LedgerOHApplicableTo); 
                $EmpGroupData = $this->EmployeeGroupMaster->ShowEmployeeGroupByGrpIdArr($ExpLedgerOHApplicableTo); 
                if(filled($EmpGroupData)){
                    $EmpGroupCode = $EmpGroupData->pluck('emp_group_code')->toArray();  
                    $ParamData = ['EmpGroupCode'=>$EmpGroupCode,'ObjectHeadCode'=>$ObjectHeadCode]; 
                    $RetData = $this->GetTransactionData($request,$ParamData); 
                }
            }

        }
        return $RetData;
    }
}
