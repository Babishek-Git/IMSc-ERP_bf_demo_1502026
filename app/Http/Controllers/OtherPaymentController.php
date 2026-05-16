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
use App\Models\PaymentModule;
use App\Models\AemEmployee;
use App\Models\EmployeePayBank;
use App\Models\work_flow_modules;
use App\Models\Ledger;
use App\Models\LedgerGroup;
use App\Models\SequenceNo;
use Exception;
use Helper;
use Session;
use App\Services\TransactionMappingService;

class OtherPaymentController extends Controller
{
    protected TransactionMappingService $TransactionMappService;
    public function __construct(
        TransactionMappingService $TransactionMappService,
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
        $this->PaymentModule = new PaymentModule();
        $this->Employee = new AemEmployee();
        $this->EmployeePayBank = new EmployeePayBank();
        $this->WorkFlowModule = new work_flow_modules();
        $this->Ledger       = new Ledger();
        $this->LedgerGroup  = new LedgerGroup();
        $this->SequenceNo = new SequenceNo();
        $this->TransactionMappService = $TransactionMappService;
    }

    public function OtherPaymentCreationList(Request $request){
        $PaymentModule = $this->PaymentModule->ShowPaymentModuleByCode('OTHER_BILL_PAYMENT');
        $PaymentWorFlowModuleList = collect($PaymentModule)->pluck('wf_module_code')->toArray(); 
        $OtherPaymentList = $this->Payment->ShowPendingOtherBillPaymentForCreation(NULL,$PaymentWorFlowModuleList);  
        $TransactionIdList = filled($OtherPaymentList) ? collect($OtherPaymentList)->pluck('transaction_id')->toArray() : [];
        $EmpNoList = filled($OtherPaymentList) ? collect($OtherPaymentList)->pluck('pay_emp_no')->toArray() : [];
        $EmployeeData = $this->Employee->ShowMultipleEmployees($EmpNoList);
        $EmpData = filled($EmployeeData) ? collect($EmployeeData)->groupBy('emp_no') : []; 
        $ModuleData = $this->WorkFlowModule->ShowMultipleWorkFlowModulesByModuleCode($PaymentWorFlowModuleList);
        $ModuleDataList = filled($ModuleData) ? collect($ModuleData)->keyBy('wf_module_code') : [];  
        return view('payment.other-bill.creation-list', compact('OtherPaymentList','EmpData','ModuleDataList'));
    }

    public function OtherPaymentCreate(Request $request){
        if(isset($request->SaveApplication)){ 
            try { 
                $ProcessMode = decrypt($request->txt_process_mode);  
                $PaymentId = decrypt($request->txt_payment_id);
                $ObjectHeadLedgerMapId = decrypt($request->txt_oh_ledger_map_id);
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) { 
                $message = 'Invalid Access'; 
                Session::put('ALertMesage', $message); 
                return redirect()->route('payment.salary-payment-creation-list');
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

            $EmpNo                  = $request->txt_emp_no;
            $EmpBankName            = $request->txt_emp_bank_name;
            $EmpBankId              = $request->txt_emp_bank_id;
            $EmpBranchName          = $request->txt_emp_bank_branch_name;
            $EmpBranchId            = $request->txt_emp_bank_branch_id;
            $EmpBankIfsc            = $request->txt_emp_bank_ifsc;
            $EmpBankAccNo           = $request->txt_emp_bank_acc_no;
            $EmpPanNo               = $request->txt_emp_pan_no;
            $BillNo                 = $request->txt_bill_no;
            $BillDate               = $request->txt_bill_date;
            if($BillDate != NULL){
                $BillDate = Helper::DBDateFormat($BillDate);
            }

            DB::beginTransaction();
            try {
                $SeqIdData = Helper::GetAutoSequenceNo('BILL',$PaymentId,NULL); 
                $SeqId = $SeqIdData->seqid; 
                $SeqNoData = $this->SequenceNo->ShowSequenceNoBySeqId($SeqId); 
                $BillProcessNo = NULL; 
                if(filled($SeqNoData)){
                    $SeqNo           = collect($SeqNoData)->pluck('sequence_no')->first();
                    $FinYear         = collect($SeqNoData)->pluck('fin_year')->first();   
                    $BillProcessNo  = "IMSc/"."BILL/OTHER/".$SeqNo."/".$FinYear;
                }
                $UpdateArr['gross_amount']      = $GrossAmount;
                $UpdateArr['recovery_amount']   = $TotalDeduction;
                $UpdateArr['net_amount']        = $NetAmount;
                $UpdateArr['status']            = 'pending';
                $UpdateArr['payment_to']        = 'EMPLOYEE';
                $UpdateArr['bill_no']           = $BillProcessNo;
                $UpdateArr['bill_date']         = $BillDate;
                $UpdateArr['bank_id']           = $EmpBankId;
                $UpdateArr['bank_name']         = $EmpBankName;
                $UpdateArr['branch_id']         = $EmpBranchId;
                $UpdateArr['branch_name']       = $EmpBranchName;
                $UpdateArr['account_no']        = $EmpBankAccNo;
                $UpdateArr['ifsc_code']         = $EmpBankIfsc;
                $UpdateArr['pan_no']            = $EmpPanNo;
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

                $RecoveryCodeList               = $request->input('txt_recovery');
                $RecoveryAmountList             = $request->input('txt_deduction_amt');
                $RecoveryObjHeadList            = $request->input('txt_object_head');
                $RecoverySubCataList            = $request->input('txt_object_head_sub_cata');

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
                $message = "Payment data saved successfully. <br/>Bill Processing No. is : ".$BillProcessNo; 
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message = "Error : Payment data not saved. Please try again"; 
            }
            Session::put('ALertMesage', $message); 
            return redirect()->route('payment.other-payment-creation-list');

        }
        try {
            $ProcessMode = decrypt($request->txt_process_mode); 
            $PaymentId = decrypt($request->txt_float_application);
            $Action = decrypt($request->txt_float_action); 
        }catch (\Illuminate\Contracts\Encryption\DecryptException $e) { 
            $message = 'Invalid Access';
            Session::put('ALertMesage', $message);
            return redirect()->route('payment.other-payment-creation-list');
        }
        $BudgetObjectHeadData = [];
        $AllObectHead = $this->ObjectHead->ShowObjectHead(NULL);
        $AllObectHeadSubCata = $this->ObjectHeadSubCategory->ShowObjectHeadSubCata(NULL);
        $AllObectHeadSubCataGrpData = filled($AllObectHeadSubCata) ? collect($AllObectHeadSubCata)->groupBy('object_head_id') : [];
        $Ledger  = $this->Ledger->ShowOtherThanDeductionLedger(); 
        $DeductionLedger  = $this->Ledger->ShowDeductionLedger();
        $LedgerGroupList  = $this->LedgerGroup->AllLeafNodesOnly();
        if(filled($Ledger)){
            $LedgerData = $Ledger->groupBy('ledger_group_id');
        }else{
            $LedgerData = [];
        } 
        if($ProcessMode == 'MODULE'){
            $PaymentData = $this->Payment->ShowPaymentById($PaymentId); 
            $EmpNo = filled($PaymentData) ? collect($PaymentData)->pluck('pay_emp_no')->first() : NULL;
            $ModuleCode = filled($PaymentData) ? collect($PaymentData)->pluck('module_code')->first() : NULL;
            $EmpNoList = [$EmpNo];
            $EmpData = $this->Employee->ShowEmployees(NULL,$EmpNo);
            $EmpBankData = $this->EmployeePayBank->employeePayBank($EmpNo);
            $ModuleData = $this->WorkFlowModule->ShowWorkFlowModules(NULL,$ModuleCode); 

            $BudgetObjectHeadData = []; 
            $PaymentTypeData = $this->PaymentType->ShowPaymentTypeByModuleCode($ModuleCode);   
            if(filled($PaymentTypeData)){
                $LedgerId = collect($PaymentTypeData)->pluck('ledger_id')->first(); 
                $BudgetObjectHeadData = $this->TransactionMappService->GetTransactionMappingData($LedgerId,NULL,NULL); 
                if($BudgetObjectHeadData == NULL){
                    $message = 'Object Head and Ledger not mapped for this type of payment';
                    Session::put('ALertMesage', $message);
                    return redirect()->route('payment.salary-payment-creation-list');
                }
            }

            return view('payment.other-bill.create-other-bill', compact('Ledger','DeductionLedger','LedgerGroupList','LedgerData','PaymentData','EmpData','EmpBankData','ModuleData','BudgetObjectHeadData','AllObectHead','AllObectHeadSubCataGrpData','ProcessMode'));
        }else{
            $PaymentData    = [];
            $EmpData        = [];
            $EmpBankData    = [];
            $ModuleData     = [];
            return view('payment.other-bill.create-manual-bill', compact('Ledger','DeductionLedger','LedgerGroupList','LedgerData','PaymentData','EmpData','EmpBankData','ModuleData','BudgetObjectHeadData','AllObectHead','AllObectHeadSubCataGrpData','ProcessMode'));
        }
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
                $message = "DAE Sanction Data Saved ";
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