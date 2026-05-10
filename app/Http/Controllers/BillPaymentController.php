<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PaymentObjectHead;
use App\Models\PaymentRecovery;
use App\Models\PayrollMaster;
use App\Models\PayRollEmployee;
use App\Models\PayRollComponent;
use App\Models\PayComponent;
use App\Models\PaymentType;
use App\Models\ObjectHead;
use App\Models\ObjectHeadSubCategory;
use App\Models\Indent;
use App\Models\Recovery;
use App\Models\ContractorDetail;
use App\Models\ContractorGST;
use App\Models\Ledger;
use App\Models\LedgerGroup;
use Exception;
use Helper;
use Session;
use App\Services\TransactionMappingService;
use App\Services\PaymentService;

class BillPaymentController extends Controller
{
    protected TransactionMappingService $TransactionMappService;
    protected PaymentService $PaymentService;
    public function __construct(
        TransactionMappingService $TransactionMappService,
        PaymentService $PaymentService,
    ){
        $this->Payment = new Payment();
        $this->PayrollMaster = new PayrollMaster();
        $this->PayRollEmployee = new PayRollEmployee();
        $this->PayRollComponent = new PayRollComponent();
        $this->PayComponent = new PayComponent();
        $this->PaymentType = new PaymentType();
        $this->ObjectHead = new ObjectHead();
        $this->ObjectHeadSubCategory = new ObjectHeadSubCategory();
        $this->PaymentObjectHead = new PaymentObjectHead();
        $this->PaymentRecovery = new PaymentRecovery();
        $this->Indent = new Indent();
        $this->Recovery = new Recovery();
        $this->ContractorDetail = new ContractorDetail();
        $this->ContractorGST = new ContractorGST();
        $this->Ledger       = new Ledger();
        $this->LedgerGroup  = new LedgerGroup();
       
        $this->TransactionMappService = $TransactionMappService;
        $this->PaymentService = $PaymentService;
    }

    public function BillPaymentCreationList(Request $request){
        $AmcModuleCodeList = ['AMC_MAT_IW'];
        $PoModuleCodeList = ['MAT_INWARD'];
        $AmcPoData = $this->PaymentService->GetMultipleAmcPoData($AmcModuleCodeList);  
        $WorksPoData = $this->PaymentService->GetMultiplePoData($PoModuleCodeList);  
        return view('payment.po-amc-bill.creation-list', compact('AmcPoData','WorksPoData'));
    }

    public function BillPaymentCreate(Request $request){
        if(isset($request->SaveApplication)){  
            try { 
                $ProcessMode = decrypt($request->txt_process_mode);  
                $PaymentId = decrypt($request->txt_payment_id);
                $ObjectHeadLedgerMapId = $request->txt_oh_ledger_map_id;
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) { 
                $message = 'Invalid Access'; //dd($e);
                Session::put('ALertMesage', $message); 
                return redirect()->route('payment.indent-bill-payment-creation-list');
            }

            $GrossAmount            = $request->txt_bill_gross_amount;
            $TotalDeduction         = $request->txt_bill_deduction_amount;
            $NetAmount              = $request->txt_bill_net_amount;
            $LedgerId               = $request->txt_ledger_id;
            $ObjectHeadId           = $request->txt_object_head_id;
            $ObjectHeadSubCataId    = $request->txt_object_head_subcata_id;
            $LedgerGroupId          = $request->txt_ledger_group_id;
            $ProjectId              = $request->txt_project_id;
            $GiaId                  = $request->txt_gia_id;
            $ExpenditureAmt         = $request->txt_expenditure_amt;

            $VendorId               = $request->txt_vendor_id;
            $VendorBankName         = $request->txt_vendor_bank_name;
            $VendorBankId           = $request->txt_vendor_bank_id;
            $VendorBranchName       = $request->txt_vendor_bank_branch_name;
            $VendorBranchId         = $request->txt_vendor_bank_branch_id;
            $VendorBankIfsc         = $request->txt_vendor_bank_ifsc;
            $VendorBankAccNo        = $request->txt_vendor_bank_acc_no;
            $VendorPanNo            = $request->txt_vendor_pan_no;
            $VendorGstNo            = $request->txt_vendor_gst_no;
            $BillNo                 = $request->txt_bill_no;
            $BillDate               = $request->txt_bill_date;
            if($BillDate != NULL){
                $BillDate = Helper::DBDateFormat($BillDate);
            }
            DB::beginTransaction();
            try {
                $UpdateArr['gross_amount']      = $GrossAmount;
                $UpdateArr['recovery_amount']   = $TotalDeduction;
                $UpdateArr['net_amount']        = $NetAmount;
                $UpdateArr['status']            = 'pending';
                $UpdateArr['payment_to']        = 'VENDOR';
                $UpdateArr['pay_vendor_id']     = $VendorId;
                $UpdateArr['bill_no']           = $BillNo;
                $UpdateArr['bill_date']         = $BillDate;
                $UpdateArr['bank_id']           = $VendorBankId;
                $UpdateArr['bank_name']         = $VendorBankName;
                $UpdateArr['branch_id']         = $VendorBranchId;
                $UpdateArr['branch_name']       = $VendorBranchName;
                $UpdateArr['account_no']        = $VendorBankAccNo;
                $UpdateArr['ifsc_code']         = $VendorBankIfsc;
                $UpdateArr['pan_no']            = $VendorPanNo;
                $UpdateArr['gst_no']            = $VendorGstNo;
                $UpdateArr['active']            = 1;
                $UpdateArr['created_at']        = NOW();
                $UpdateArr['created_by']        = session('WcmsEmpNo');
                $this->Payment->UpdatePayment($UpdateArr,$PaymentId);

                $SaveArr['payment_id']          = $PaymentId;
                $SaveArr['ledger_id']           = $LedgerId;
                $SaveArr['ledger_group_id']     = $LedgerGroupId;
                $SaveArr['gia_id']              = $GiaId;
                $SaveArr['project_id']          = $ProjectId;
                $SaveArr['object_head_id']      = $ObjectHeadId;
                $SaveArr['object_head_sub_cata_id']  = $ObjectHeadSubCataId;
                $SaveArr['ohl_mapping_id']      = $ObjectHeadLedgerMapId;
                $SaveArr['payment_oh_amount']   = $ExpenditureAmt;
                $SaveArr['active']              = 1;
                $SaveArr['created_at']          = NOW();
                $SaveArr['created_by']          = session('WcmsEmpNo');
                $this->PaymentObjectHead->CreatePaymentObjectHead($SaveArr);

                $RecoveryCodeList    = $request->input('txt_recovery');
                $RecoveryAmountList      = $request->input('txt_deduction_amt');
                $RecoveryObjHeadList = $request->input('txt_object_head'); 
                $RecoverySubCataList           = $request->input('txt_object_head_sub_cata');
                if(filled($RecoveryCodeList)){
                    if(count($RecoveryCodeList) > 0){
                        foreach($RecoveryCodeList as $DeductKey => $DeductValue){
                            $RecoveryCode    = $RecoveryCodeList[$DeductKey];
                            $RecoveryObjHead = $RecoveryObjHeadList[$DeductKey];
                            $RecoveryAmount  = $RecoveryAmountList[$DeductKey];
                            $RecoverySubCata = $RecoverySubCataList[$DeductKey];
                            $SaveDedArr['payment_id']       = $PaymentId;
                            $SaveDedArr['recovery_code']    = $RecoveryCode;
                            $SaveDedArr['recovery_amount']  = $RecoveryAmount;
                            //$SaveDedArr['object_head_id']   = $RecoveryObjHead;
                            $SaveDedArr['ledger_id']   = $RecoveryObjHead;
                            $SaveDedArr['recovery_flag']    = 'REC';
                            $this->PaymentRecovery->CreatePaymentRecovery($SaveDedArr);
                        }
                    }
                }

                DB::commit();
                $message = "Payment data saved successfully"; 
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message = "Error : Payment data not saved. Please try again"; 
            }
            Session::put('ALertMesage', $message); 
            return redirect()->route('payment.indent-bill-payment-creation-list');
        }
        //dd(234);
        try {
            $ProcessMode = decrypt($request->txt_process_mode); 
            $ApplicationId = decrypt($request->txt_float_application); // payment_id - From payment table
            $PoId = decrypt($request->txt_float_application_poid); // PO Id , AMC Id - From purchase_order, amc_purchase order table
            $PoMastId = decrypt($request->txt_float_application_mastid); // Inward Master Id - From Inward Master Table (PO & AMC)
            $Action = decrypt($request->txt_float_action); 
        }catch (\Illuminate\Contracts\Encryption\DecryptException $e) { 
            $message = 'Invalid Access'; 
            Session::put('ALertMesage', $message);
            return redirect()->route('payment.indent-bill-payment-creation-list');
        }
        $BudgetObjectHeadData = []; 
        /*$PaymentTypeData = $this->PaymentType->ShowPaymentTypeByEmpGroupTypeCode($EmpGroupTypeId);  
        if(filled($PaymentTypeData)){
            $LedgerId = collect($PaymentTypeData)->pluck('ledger_id')->first();
            $BudgetObjectHeadData = $this->TransactionMappService->GetTransactionMappingData($LedgerId,NULL,NULL);
        }*/
        $LedgerIdList = [];
        if($PoId != NULL){
            $PoAmcBudgetData = $this->TransactionMappService->GetBudgetDetailsForAmcPo($PoId,$ProcessMode,$ApplicationId);
            if(filled($PoAmcBudgetData)){
                if(isset($PoAmcBudgetData['LedgerIdList'])){
                    $LedgerIdList = $PoAmcBudgetData['LedgerIdList'];
                }
            }
        }else{
            $PoAmcBudgetData = [];
        }

        $AllObectHead = $this->ObjectHead->ShowObjectHead(NULL);
        $AllObectHeadSubCata = $this->ObjectHeadSubCategory->ShowObjectHeadSubCata(NULL);
        $AllObectHeadSubCataGrpData = filled($AllObectHeadSubCata) ? collect($AllObectHeadSubCata)->groupBy('object_head_id') : [];
        $RecoveryData = $this->Recovery->ShowRecovery();
        
        $Ledger  = $this->Ledger->ShowOtherThanDeductionLedger(); 
        if(filled($LedgerIdList)){ 

            $Ledger = $Ledger->whereIn('ledger_id',$LedgerIdList);
        }

        $DeductionLedger  = $this->Ledger->ShowDeductionLedger();
        $LedgerGroupList  = $this->LedgerGroup->AllLeafNodesOnly();
        if(filled($Ledger)){
            $LedgerData = $Ledger->groupBy('ledger_group_id');
        }else{
            $LedgerData = [];
        } 

        if($ProcessMode == "AMC"){
            $PoPaymentData = $this->PaymentService->GetAmcPoData($ApplicationId); 
            $VendorId = $PoPaymentData->pluck('contid')->first();
            $VendorBankData = $this->ContractorDetail->ShowContractorBank($VendorId);
            $VendorGstData = $this->ContractorGST->ShowContractorGstByContId($VendorId);

            return view('payment.po-amc-bill.create-amc-bill', compact('PoAmcBudgetData','Ledger','DeductionLedger','LedgerGroupList','LedgerData','PoPaymentData','RecoveryData','VendorBankData','VendorGstData','BudgetObjectHeadData','AllObectHead','AllObectHeadSubCataGrpData','ProcessMode'));
        }else if($ProcessMode == "PO"){
            $PoPaymentData = $this->PaymentService->GetPoPaymentData($ApplicationId);  
            $VendorId = $PoPaymentData->pluck('contid')->first();
            $IndentId = $PoPaymentData->pluck('intent_id')->first(); 
            if($IndentId != NULL){
                $IndentData = $this->PaymentService->GetIndentData($IndentId);
                if(filled($IndentData)){
                    $MaterialTypeId = $PoPaymentData->pluck('mat_type_id')->first(); 
                }
            }
            $VendorBankData = $this->ContractorDetail->ShowContractorBank($VendorId); 
            $VendorGstData = $this->ContractorGST->ShowContractorGstByContId($VendorId); //dd($PoPaymentData);
            return view('payment.po-amc-bill.create-po-bill', compact('PoAmcBudgetData','Ledger','DeductionLedger','LedgerGroupList','LedgerData','PoPaymentData','RecoveryData','VendorBankData','VendorGstData','BudgetObjectHeadData','AllObectHead','AllObectHeadSubCataGrpData','ProcessMode'));
        }else{
            return redirect()->route('payment.indent-bill-payment-creation-list');
        }

        /*if(isset($request->SaveApplication)){ 
            try { 
                $ProcessMode = decrypt($request->txt_process_mode);  
                $EmpGroupTypeId = decrypt($request->txt_emp_group_type); 
                if($ProcessMode == 'MULTIPLE'){
                    $PaymentId = decrypt($request->txt_payment_id);
                }
                if($ProcessMode == 'SINGLE'){ 
                    $PayRollEmpId = decrypt($request->txt_payroll_emp_id);
                    $PayRollEmpNo = decrypt($request->txt_payroll_emp_no);
                } 
                $ObjectHeadLedgerMapId = decrypt($request->txt_oh_ledger_map_id);
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) { 
                $message = 'Invalid Access'; dd($e);
                Session::put('ALertMesage', $message); 
                return redirect()->route('payment.salary-payment-creation-list');
            }
            $GrossAmount                = $request->txt_gross_amount;
            $TotalDeduction             = $request->txt_total_deduction;
            $NetAmount                  = $request->txt_net_amount;
            $LedgerId                   = $request->txt_ledger_id;
            $ObjectHeadId               = $request->txt_object_head_id;
            $ObjectHeadSubCataId        = $request->txt_object_head_subcata_id;
            $ExpenditureAmt             = $request->txt_expenditure_amt;
            DB::beginTransaction();
            try {
                if(isset($PaymentId)){
                    $this->PaymentObjectHead->DeletePaymentObjectHead($PaymentId);
                    $this->PaymentRecovery->DeletePaymentRecovery($PaymentId);
                }
                $UpdateArr['gross_amount']  = $GrossAmount;
                $UpdateArr['recovery_amount'] = $TotalDeduction;
                $UpdateArr['net_amount']    = $NetAmount;
                $UpdateArr['status']        = 'pending';
                $UpdateArr['active']        = 1;
                $UpdateArr['created_at']    = NOW();
                $UpdateArr['created_by']    = session('WcmsEmpNo');
                if((isset($PaymentId))&&($ProcessMode == 'MULTIPLE')){
                    $PaymentData = $this->Payment->ShowPaymentById($PaymentId);
                    $PayrollMasterId = $PaymentData->pluck('transaction_id')->first();
                    $UpdateArr2['payment_id'] = $PaymentId; 
                    $this->PayRollEmployee->updateMultipleEmployeePayroll($PayrollMasterId,$UpdateArr2);
                    $this->Payment->UpdatePayment($UpdateArr,$PaymentId);
                }else{
                    $UpdateArr['transaction_id']        = $PayRollEmpId;
                    $UpdateArr['transaction_table']     = 'erp_payroll_employee';
                    $UpdateArr['module_code']           = 'PAYROLL';
                    $UpdateArr['payment_to']            = 'EMPLOYEE';
                    $UpdateArr['pay_emp_no']            = $PayRollEmpNo;
                    $UpdateArr['pay_emp_group_type']    = $EmpGroupTypeId;
                    $PaymentSaveData = $this->Payment->CreatePayment($UpdateArr);
                    $PaymentId = $PaymentSaveData->payment_id;
                    $UpdateArr2['payment_id']            = $PaymentId;
                    $this->PayRollEmployee->updateEmployeePayroll($PayRollEmpId,$UpdateArr2);
                    
                }

                $SaveArr['payment_id']          = $PaymentId;
                $SaveArr['ledger_id']           = $LedgerId;
                $SaveArr['object_head_id']      = $ObjectHeadId;
                $SaveArr['ohl_mapping_id']      = $ObjectHeadLedgerMapId;
                $SaveArr['payment_oh_amount']   = $ExpenditureAmt;
                $SaveArr['active']              = 1;
                $SaveArr['created_at']          = NOW();
                $SaveArr['created_by']          = session('WcmsEmpNo');
                $this->PaymentObjectHead->CreatePaymentObjectHead($SaveArr);

                $DeductComponentCodeList    = $request->input('txt_deduct_component_code');
                $DeductComponentIdList      = $request->input('txt_deduct_component_id');
                $DeductComponentObjHeadList = $request->input('cmb_deduct_object_head');
                $DeductAmountList           = $request->input('txt_deduction_amt');
                if(filled($DeductComponentCodeList)){
                    if(count($DeductComponentCodeList) > 0){
                        foreach($DeductComponentCodeList as $DeductKey => $DeductValue){
                            $DeductComponentCode    = $DeductComponentCodeList[$DeductKey];
                            $DeductComponentId      = $DeductComponentIdList[$DeductKey];
                            $DeductComponentObjHead = $DeductComponentObjHeadList[$DeductKey];
                            $DeductAmount           = $DeductAmountList[$DeductKey];
                            $SaveDedArr['payment_id'] = $PaymentId;
                            $SaveDedArr['recovery_code'] = $DeductComponentCode;
                            $SaveDedArr['recovery_amount'] = $DeductAmount;
                            $SaveDedArr['object_head_id'] = $DeductComponentObjHead;
                            $this->PaymentRecovery->CreatePaymentRecovery($SaveDedArr);
                        }
                    }
                }
                DB::commit();
                $message = "Payment data saved successfully"; 
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message = "Error : Payment data not saved. Please try again"; 
            }
            Session::put('ALertMesage', $message); 
            return redirect()->route('payment.salary-payment-creation-list');

        }
        try {
            $ProcessMode = decrypt($request->txt_process_mode); 
            if($ProcessMode == "MULTIPLE"){
                $PaymentId = decrypt($request->txt_float_application);
            }else if($ProcessMode == "SINGLE"){
               $PayRollEmpId = decrypt($request->txt_float_application); 
            }else{
                $PaymentId = NULL; 
            }
            $Action = decrypt($request->txt_float_action); 
        }catch (\Illuminate\Contracts\Encryption\DecryptException $e) { 
            $message = 'Invalid Access';
            Session::put('ALertMesage', $message);
            return redirect()->route('payment.salary-payment-creation-list');
        }
        $PayrollData = NULL; $PayEmployeeData = NULL; $EmpPayComponentGrpData = NULL; $EmpGroupTypeId = NULL;
        if($ProcessMode == "SINGLE"){
             $PaymentData = NULL;
             $PayEmployeeData = $this->PayRollEmployee->getPayrollEmployeeDataByPayEmpId($PayRollEmpId); 
             $TransactionId = $PayEmployeeData->pluck('payroll_master_id')->first();
             if(filled($TransactionId)){
                $PayrollData = $this->PayrollMaster->getPayrollDataById($TransactionId); 
                $EmpGroupTypeId = $PayrollData->pluck('emp_group_type')->first(); 
             }
             $EmpPayComponentData = $this->PayRollComponent->getPayrollComponentDataByPayEmpId($PayRollEmpId);
             $EmpPayComponentGrpData = collect($EmpPayComponentData)->groupBy('payroll_employee_id');
        }else{
            $PaymentData = $this->Payment->ShowPayment($PaymentId);
            if(filled($PaymentData)){ 
                $TransactionId = $PaymentData->pluck('transaction_id')->first(); /// Here Transaction Id is PayRollMaster ID
                $EmpGroupTypeId = $PaymentData->pluck('pay_emp_group_type')->first();
                if(filled($TransactionId)){
                    $PayrollData = $this->PayrollMaster->getPayrollDataById($TransactionId);
                }
                $PayEmployeeData = $this->PayRollEmployee->getPayrollEmployeeDataById($TransactionId);
                $EmpPayComponentData = $this->PayRollComponent->getPayrollComponentData($TransactionId);
                $EmpPayComponentGrpData = collect($EmpPayComponentData)->groupBy('payroll_employee_id');
            }
        }


        $componentFilterArr = array("DEDU","EARN");
        $payComponents      = PayComponent::withType()->active()
                                ->whereHas('componentType', function ($q) use ($componentFilterArr) {
                                $q->whereIn('component_type_code', $componentFilterArr)->where('component_code','!=','BASIC');
                            })
                            ->orderBy('dp_order','ASC')->get(); 
        if(filled($payComponents)){
            $GroupedPayComponents = $payComponents->groupBy(function ($item) {
                return $item['componentType']['pay_effect'];
            });
        }else{
            $GroupedPayComponents = [];
        } 
        $BudgetObjectHeadData = []; 
        $PaymentTypeData = $this->PaymentType->ShowPaymentTypeByEmpGroupTypeCode($EmpGroupTypeId);  
        if(filled($PaymentTypeData)){
            $LedgerId = collect($PaymentTypeData)->pluck('ledger_id')->first();
            $BudgetObjectHeadData = $this->TransactionMappService->GetTransactionMappingData($LedgerId,NULL,NULL);
        }
        $AllObectHead = $this->ObjectHead->ShowObjectHead(NULL);
        $AllObectHeadSubCata = $this->ObjectHeadSubCategory->ShowObjectHeadSubCata(NULL);
        $AllObectHeadSubCataGrpData = filled($AllObectHeadSubCata) ? collect($AllObectHeadSubCata)->groupBy('object_head_id') : [];
        if($ProcessMode == "SINGLE"){
            return view('payment.salary.create-single', compact('PaymentData','PayrollData','GroupedPayComponents','EmpPayComponentGrpData','PayEmployeeData','BudgetObjectHeadData','AllObectHead','AllObectHeadSubCataGrpData','ProcessMode'));
        }else{
            return view('payment.salary.create', compact('PaymentData','PayrollData','GroupedPayComponents','EmpPayComponentGrpData','PayEmployeeData','BudgetObjectHeadData','AllObectHead','AllObectHeadSubCataGrpData','ProcessMode'));
        }*/
    }

    /*public function BudgetSanction(Request $request)
    {   
        if(isset($request->btn_save))
        {
            $AccountNo = $request->txt_acc_no;
            $RBIAmount = $request->txt_rbi_amount;
            $RBIDate   = $request->txt_rbi_date;
            $Category  = $request->txt_section_category;
            $InternalExternal  = $request->txt_internal_external;
            $SanctionType  = $request->txt_sanction_type;
            $Gia = $request->cmb_gia;
            
            $rules = [
				'AccountNo' => 'required|max:25',
				'RBIAmount' => 'required|max:5',
			];
			$ValidateData = [
                'AccountNo' =>$AccountNo,
				'RBIAmount' => $RBIAmount,
                				
			];
            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($AccountNo == "AccountNo"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Accout No.";
                    }
                    if($RBIAmount == "RBIAmount"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid RBI Amout.";
                    }
                    
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('bank.rbi-sanction');
            }
            DB::beginTransaction();
            try {
                $SaveData['budget_sanction_no']     = $AccountNo;
                $SaveData['budget_sanction_amt'] =   $RBIAmount;
                $SaveData['budget_sanction_date'] =   $RBIDate;
                $SaveData['sanction_category'] =   $Category;
                $SaveData['internal_external'] =   $InternalExternal;
                $SaveData['sanction_type'] =   $SanctionType;
                $SaveData['gia_id'] =   $Gia;
                $SaveData['created_at'] = NOW();
                $SaveData['created_by'] = session('WcmsEmpNo');
                
                $SaveEmployment= $this->budgetsanction->CreateBudgetSanction($SaveData);
            
                DB::commit();
                $message = "DAE Sanction Data Saved Successfully";
            }catch (\Exception $e) {dd($e); 
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('bank.rbi-sanction');
        }
        $SanctionData=$this->budgetsanction->ShowDaeSanction();
        $GiaData=$this->gia->ShowGiaForSanction('DAE');
        return view('imsc-bank.rbi-sanction')->with('data', compact('SanctionData','GiaData')); //EL Encashment along with LTC Request
    }*/
    
}