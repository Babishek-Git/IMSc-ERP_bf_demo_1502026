<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\bank_instrument;
use App\Models\BankMaster;
use App\Models\StateMaster;
use App\Models\BankBranchMaster;
use App\Models\AemBank;
use App\Models\RbiSanction;
use App\Models\ImscAccount;
use Exception;
use Helper;
use Session;
class BankController extends Controller
{
    protected $role;
    public function __construct(){
       $this->bankinstrument = new bank_instrument(); 
       $this->bankbranch     = new BankBranchMaster();
       $this->state          = new StateMaster();
       $this->bank          = new BankMaster();
       $this->bankdetail = new AemBank();
       $this->imscaccount = new ImscAccount();
       $this->rbisanction = new RbiSanction();
    }
    
    public function BankInstrument(Request $request){
        $message = NULL;   $BankInstrumentData = NULL;   $ValMsg = '';
        if(isset($request->id))
        { 
            try {
                $BankInstId = decrypt($request->id);
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $data = "Error : Sorry Invalid Attempt";
                return view('error.PayLoadError')->with('data',$data);
            }
            $BankInstrumentData = $this->bankinstrument->ShowBankinstrument($BankInstId);
            $BankInstrumentData = $BankInstrumentData->first(); 
        }
        if($request->btn_save){   
            $ValMsg = $this->ValidateBankInstrument($request);
            if(!filled($ValMsg)){  
                if($request->bank_inst_id != NULL){   
                    $UpdateBankInstrument = NULL;
                    try {
                        $HidBankInstId = decrypt($request->bank_inst_id);
                    }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                        $data = "Error : Sorry Invalid Attempt";
                        return view('error.PayLoadError')->with('data',$data);
                    }
                    $BankInstArr['bank_inst_name']  = $request->txt_bankinstrument_name;
                    $BankInstArr['inst_code']       = $request->txt_bankinstrument_code;
                    $BankInstArr['updated_by']      = session('WcmsEmpNo');
                    $BankInstArr['updated_at']      = NOW();

                    $BankDataArr['bank_inst_name']  = trim($BankInstArr['bank_inst_name']); //removes spaces
                    $BankDataArr['inst_code']       = trim($BankInstArr['inst_code']); //removes spaces
                    $BankDataArr['bank_inst_name']  = preg_replace("/[^a-zA-Z0-9]+/", "", $BankDataArr['bank_inst_name']); //removes special characters
                    $BankDataArr['inst_code']       = preg_replace("/[^a-zA-Z0-9]+/", "", $BankDataArr['inst_code']); //removes special characters
                    $CheckBankInst = $this->bankinstrument->CheckBankInstUpdate($BankDataArr,$HidBankInstId);
                    if(count($CheckBankInst)>0){
                        $LogMessage = "AdminController || Bank Instrument already exists! )";
                        Helper::CreateLog($request,$LogMessage);       

                        $message = ("Failed: Bank Instrument already exists");
                    }else{
                        $UpdateBankInstrument = $this->bankinstrument->UpdateBankInstrument($BankInstArr,$HidBankInstId);
                    }
                    if($UpdateBankInstrument == true){
                        $LogMessage = "AdminController || Bank Instrument Updated Sucessfully, updated by ".session('WcmsEmpNo')." )";
                        Helper::CreateLog($request,$LogMessage);       
                        $message = ("Bank Instrument Updated Sucessfully!");
                    }
                    $BankInstrumentData = NULL;
                }else{  
                    $BankInstrumentName = $request->txt_bankinstrument_name;
                    $BankInstrumentCode = $request->txt_bankinstrument_code;
                   
                    $BankInstArr['bank_inst_name'] = $request->txt_bankinstrument_name;
                    $BankInstArr['inst_code'] = $request->txt_bankinstrument_code;
                    $BankInstArr['created_by'] = session('WcmsEmpNo');
                    $BankInstArr['created_at'] = NOW();
                    $BankInstArr['active'] = 1;

                    $BankDataArr['bank_inst_name'] = trim($BankInstArr['bank_inst_name']); //removes spaces
                    $BankDataArr['inst_code'] = trim($BankInstArr['inst_code']); //removes spaces
                    $BankDataArr['bank_inst_name'] = preg_replace("/[^a-zA-Z0-9]+/", "", $BankDataArr['bank_inst_name']); //removes special characters
                    $BankDataArr['inst_code'] = preg_replace("/[^a-zA-Z0-9]+/", "", $BankDataArr['inst_code']); //removes special characters
                    $CheckBankInst = $this->bankinstrument->CheckBankInst($BankDataArr);
                    if(count($CheckBankInst)>0){
                        $LogMessage = "AdminController || Bank Instrument already exists! )";
                        Helper::CreateLog($request,$LogMessage);       

                        $message = ("Failed: Bank Instrument already exists");
                    }else{
                        $CreateBankInstData = $this->bankinstrument->CreateBankInst($request, $BankInstArr);
                        if($CreateBankInstData != NULL)
                        {
                            $LogMessage = "AdminController || Bank Instrument Saved Sucessfully, created by ".session('WcmsEmpNo')." )";
                            Helper::CreateLog($request,$LogMessage);       
                            $message = ("Bank Instrument Saved successfully!");
                        }
                    }  
                }
            }else{
                $message = " Sorry : ".$ValMsg." Bank Instrument Not Saved..Please try again..!! ";
            }
        }
        return view('bank.BankInstrument')->with('data',compact('BankInstrumentData')) ->with('ALertMesage',$message);
    }


    public function ValidateBankInstrument($request){  //validation part for Bank Instrument
        $message = '';
        $Rules = [ 'BANK_REQ' => 'required|max:50',
                   'BANK_CODE_REQ' => 'required|max:5', ];
        $ValidateData = [
            'BANK_REQ' => $request->input('txt_bankinstrument_name'),
            'BANK_CODE_REQ' => $request->input('txt_bankinstrument_code'),
        ];
        if($message == ''){
            $Validate = Validator::make($ValidateData, $Rules);
            if($Validate->fails()) {
                $ValidateFields = $Validate->failed();
                foreach($ValidateFields as $ValidFieldName => $ValidRules){
                    if($ValidFieldName == "BANK_REQ"){
                        $message = 'Error : Invalid Bank Instrument Name..!!';
                    }else if($ValidFieldName == "BANK_CODE_REQ"){
                        $message = 'Error : Invalid Bank Instrument Code..!!';
                    }
                }
            }
        }
        return $message;
    }
    public function ViewBankInstruments(Request $request){
        $ShowBankinstruments = $this->bankinstrument->ShowAllBankInstrument(NULL);
        return view('bank.ViewBankInstruments')->with('data', compact('ShowBankinstruments'));
    }

    public function BankMaster(Request $request){
        $message = NULL;   $BankData = NULL;   $ValMsg = '';
        $BankShortName = $request->bank_sh_name;
        if(isset($request->id))
        { 
            //$BankId =$request->hid_bank_id;
            try {
                $EditId = decrypt($request->id);
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $data = "Error : Sorry Invalid Attempt";
                return view('bank.bank-branch-master')->with('data',$data);
            }
            $BankData = $this->bank->ShowBankList($EditId);
            $BankData = $BankData->first(); 
        }
        if($request->btn_save){   
            $ValMsg = $this->ValidateBank($request);  
            if(!filled($ValMsg)){  
                if($request->bank_id != NULL){    
                   
                    $UpdateBank = NULL;
                    try {
                        $EditId = decrypt($request->bank_id);
                    }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                        $data = "Error : Sorry Invalid Attempt";
                        return view('bank.bank-branch-master')->with('data',$data);
                    }
                    $BankArr['bank_name'] = $request->input('bank_name');
                    $BankArr['bank_short_name'] = $request->input('bank_sh_name');
                    $BankArr['updated_by'] = session('WcmsEmpNo');
                    $BankArr['updated_at'] = NOW();

                    $BankDataArr['bank_name'] = trim($BankArr['bank_name']);                //removes spaces
                    $BankDataArr['bank_name'] = preg_replace("/[^a-zA-Z0-9]+/", "", $BankDataArr['bank_name']);     //removes special characters
                    $CheckBank = $this->bank->CheckBankUpdate($BankDataArr,$EditId);
                    if(count($CheckBank)>0){
                        $LogMessage = "AdminController || Bank already exists! )";
                        Helper::CreateLog($request,$LogMessage);       
                        $message = ("Failed: Bank Name already exists");
                    }else{
                        $UpdateBank = $this->bank->UpdateBank($BankArr,$EditId);
                    }
                    if($UpdateBank == true){
                        $LogMessage = "AdminController || Bank Updated Sucessfully, updated by ".session('WcmsEmpNo')." )";
                        Helper::CreateLog($request,$LogMessage);       
                        $message = ("Bank Updated Sucessfully!");
                    }
                    $BankData = NULL;
                                  
                }else{  
                    $BankName = $request->input('bank_name');
                    $BankShortName= $request->input('bank_sh_name');
                    
                    $BankArr['bank_name'] = $BankName;
                    $BankArr['bank_short_name'] = $BankShortName; 
                    $BankArr['created_by'] = session('WcmsEmpNo');
                    $BankArr['created_at'] = NOW();
                    $BankArr['active'] = 1;
                    $BankDataArr['bank_name'] = trim($BankArr['bank_name']);                //removes spaces
                    $BankDataArr['bank_name'] = preg_replace("/[^a-zA-Z0-9]+/", "", $BankDataArr['bank_name']);     //removes special characters
                    $CheckBank = $this->bank->CheckBank($BankDataArr);
                    if(count($CheckBank)>0){
                        $LogMessage = "AdminController || Bank already exists! )";
                        Helper::CreateLog($request,$LogMessage);       
                        $message = ("Failed: Bank already exists");
                    }else{
                        $CreateBankData = $this->bank->CreateBank($request, $BankArr);
                        if($CreateBankData != NULL){
                            $LogMessage = "AdminController || Bank created successfully, created by ".session('WcmsEmpNo')."";
                            Helper::CreateLog($request,$LogMessage);       
                            $message = ("Bank Saved successfully");
                        }
                    }
                }
            }else{
                $message = " Sorry : ".$ValMsg." Bank Name Not Saved..Please try again..!! ";
            }
        }
        $BankDataView = $this->bank->ShowBankList(null);
        // dd($BankData);
        return view('bank.bank-master')->with('data',compact('BankData', 'BankDataView')) ->with('ALertMesage',$message);
    }

    public function ValidateBank($request){                     //  Validation part for Bank
        $message = '';
        $Rules = [ 'BANK_REQ' => 'required' ];
        $ValidateData = [ 'BANK_REQ' => $request->input('bank_name') ];
        if($message == ''){
            $Validate = Validator::make($ValidateData, $Rules);
            if($Validate->fails()) {
                $ValidateFields = $Validate->failed();
                foreach($ValidateFields as $ValidFieldName => $ValidRules){
                    if($ValidFieldName == "BANK_REQ"){
                        $message = 'Error : Please Enter Bank Name..!!';
                    }
                }
            }
        }
        return $message;
    }

    public function BankBranchMaster(Request $request){
        $message = NULL;
        $BankBranchData = NULL;
        $ValMsg = '';
        if(isset($request->id))
        { 
            try {
                $BankBranchId = decrypt($request->id);
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $data = "Error : Sorry Invalid Attempt";
                return view('error.PayLoadError')->with('data',$data);
            }
            $BankBranchData = $this->bankbranch->ShowBankBranchList($BankBranchId);
            $BankBranchData = $BankBranchData->first(); 
        }

        if($request->btn_save){   
            $ValMsg = $this->ValidateBankBranch($request);  
            if(!filled($ValMsg)){
                if($request->branch_id != NULL){    
                    try {
                        $HidBankBranchId = decrypt($request->branch_id);
                    }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                        $data = "Error : Sorry Invalid Attempt";
                        return view('error.PayLoadError')->with('data',$data);
                    }
                    $BankBranchArr['bank_id'] = $request->bank_name;
                    $BankBranchArr['ifsc_code'] = $request->ifsc_code;
                    $BankBranchArr['branch_addr1'] = $request->branch_Address;
                    $BankBranchArr['state_id'] = $request->state_name;
                    $BankBranchArr['branch_city'] = $request->city_name; 
                    $BankBranchArr['updated_by'] = session('WcmsEmpNo');
                    $BankBranchArr['updated_at'] = NOW();
                    $UpdateBankBranch = $this->bankbranch->UpdateBankBranch($BankBranchArr, $HidBankBranchId);
                    if($UpdateBankBranch == true){
                        $LogMessage = "AdminController || Bank Branch Updated Sucessfully, updated by ".session('WcmsEmpNo')." )";
                        Helper::CreateLog($request,$LogMessage);       
                        $message = ("Bank Branch  Updated Sucessfully!");
                    }
                    $BankBranchData = NULL;
                }else{  
                    $BankName = $request->bank_name;
                   
                    $BankBranchArr['bank_id'] = $request->bank_name;
                    $BankBranchArr['ifsc_code'] = $request->ifsc_code;
                    $BankBranchArr['branch_addr1'] = $request->branch_Address;
                    $BankBranchArr['state_id'] = $request->state_name;
                    $BankBranchArr['branch_city'] = $request->city_name;
                    $BankBranchArr['created_by'] = session('WcmsEmpNo');
                    $BankBranchArr['created_at'] = NOW();
                    $BankBranchArr['active'] = 1;

                    $BankBranchDataArr['ifsc_code'] = trim($BankBranchArr['ifsc_code']); //removes spaces 
                    $CheckBank = $this->bankbranch->CheckBankBranchIFSCCode($BankBranchDataArr);
                    if(count($CheckBank)>0){
                        $LogMessage = "AdminController ||  Bank Branch already exists ! )";
                        Helper::CreateLog($request,$LogMessage);       
                        $message = ("Failed: Bank Branch already exists");
                    }else{
                        $CreateBankData = $this->bankbranch->CreateBankBranch($request, $BankBranchArr);
                        if($CreateBankData != NULL)
                        {
                            $LogMessage = "AdminController || Bank Branch Saved successfully, created by ".session('WcmsEmpNo')." )";
                            Helper::CreateLog($request,$LogMessage);       
                            $message = ("Bank Branch Saved successfully!");
                        }
                    }  
                }
            }else{
                $message = " Sorry : ".$ValMsg." Bank Branch Details Not Saved..Please try again..!! ";
            }
        }
        $BankList = $this->bank->ShowBankList(NULL);
        $StateList = $this->state->ShowStateList(NULL);
        $BankBranchView = $this->bankbranch->ShowBankBranchList(NULL);
        $BankStateName = $this->bankbranch->ShowBankStateName(NULL);
        return view('bank.bank-branch-master')->with('data', compact('BankList','StateList','BankBranchData','BankBranchView','BankStateName'))->with('ALertMesage',$message);
        }


    public function ValidateBankBranch($request){                   //validation part for Bank Branch
        $message = '';
        $Rules = [
            'BANK_REQ' => 'required',
            'IFSC_MAX_REQ' => 'required|max:20',
            'ADD_MAX_REQ' => 'required|max:150',
            'STATE_REQ' => 'required',
            'CITY_MAX_REQ' => 'required|max:150',
        ];
        $ValidateData = [
            'BANK_REQ' => $request->input('bank_name'),
            'IFSC_MAX_REQ' => $request->input('ifsc_code'),
            'ADD_MAX_REQ' => $request->input('branch_Address'),
            'STATE_REQ' => $request->input('state_name'),
            'CITY_MAX_REQ' => $request->input('city_name'),
        ];
        if($message == ''){
            $Validate = Validator::make($ValidateData, $Rules);
            if($Validate->fails()) {
                $ValidateFields = $Validate->failed();
                foreach($ValidateFields as $ValidFieldName => $ValidRules){
                    if($ValidFieldName == "BANK_REQ"){
                        $message = 'Error : Please Select Bank Name..!!';
                    }else if($ValidFieldName == "IFSC_MAX_REQ"){
                        $message = 'Error : Invalid IFSC Code..!!';
                    }else if($ValidFieldName == "ADD_MAX_REQ"){
                        $message = 'Error : Invalid Bank Address..!!';
                    }else if($ValidFieldName == "STATE_REQ"){
                        $message = 'Error : Please Select State Name..!!';
                    }else if($ValidFieldName == "CITY_MAX_REQ"){
                        $message = 'Error : Invalid City Name..!!';
                    }
                    if($message != ''){
                        return $message;
                    }
                }
            }
        }
        return $message;
    }
    public function BankList(Request $request){
        $BankList = $this->bank->ShowBankList(NULL);
        return view('bank.ViewBankList')->with('data', compact('BankList'));
    }
    public function BankBranchList(Request $request){
        $BankList = $this->bankbranch->ShowBankBranchList(NULL);
        return view('bank.ViewBankBranchList')->with('data', compact('BankList'));
    }
    public function DeleteBankInstrument(Request $request){
        $BankInstArr = array();
        $BankInstArr['active'] = 0;
        $BankInstrumentData = $this->bankinstrument->UpdateBankInstrument($BankInstArr, decrypt($request->Id));
        $LogMessage = "AjaxController || Bank Instrument Deleted successfully ";
        Helper::CreateLog($request,$LogMessage);   
        return $BankInstrumentData;
    }
    public function DeleteBank(Request $request){
        $BankArr = array();
        $BankArr['active'] = 0;
        $BankData = $this->bank->UpdateBank($BankArr, decrypt($request->Id));
        $LogMessage = "AjaxController || Bank Deleted successfully ";
        Helper::CreateLog($request,$LogMessage);   
        return $BankData;
    }
    public function DeleteBankBranch(Request $request){
        $BankBranchArr = array();
        $BankBranchArr['active'] = 0;
        $BankBranchData = $this->bankbranch->UpdateBankBranch($BankBranchArr, decrypt($request->Id));
        $LogMessage = "AjaxController ||Bank Branch  Deleted successfully ";
        Helper::CreateLog($request,$LogMessage);   
        return $BankBranchData;
    }

    public function UndoDelete(Request $request){
        $Id = decrypt($request->input('Id'));
        $Type = $request->input('Type');
        $UndoDeleteArr = ['active' => 1];
        switch ($Type) {
            case 'Bank':
                $UndoDeleteData = $this->bank->UpdateBank($UndoDeleteArr, $Id);
                $LogMessage = "AjaxController ||Bank Activated successfully ";
                Helper::CreateLog($request,$LogMessage);           
                break;
            case 'BankBranch':
                $UndoDeleteData = $this->bankbranch->UpdateBankBranch($UndoDeleteArr, $Id);
                $LogMessage = "AjaxController || Bank Branch  Activated successfully ";
                Helper::CreateLog($request,$LogMessage);   
                break;
            case 'BankInstrument':
                $UndoDeleteData = $this->bankinstrument->UpdateBankInstrument($UndoDeleteArr, $Id);
                $LogMessage = "AjaxController || Bank Instrument Activated successfully ";
                Helper::CreateLog($request,$LogMessage);   
                break;
            default:
                return response()->json(['error' => 'Invalid type'], 400);
        }
        return $UndoDeleteData;
    }
     public function GetBankData(Request $request){ 
        $BankData = $this->bank->ShowBankDetails(NULL,NULL,$request->IfscCode); 
        $OutputArr = array('BankData' => $BankData);
       
        return $OutputArr; 
    }
    public function RBISanction(Request $request)
    {   
        if(isset($request->btn_save))
        {
            $AccountNo = $request->txt_acc_no;
            $RBIAmount = $request->txt_rbi_amount;
            $RBIDate   = $request->txt_rbi_date;
            
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
                $SaveData['rbi_sanction_no']     = $AccountNo;
                $SaveData['rbi_sanction_amount'] =   $RBIAmount;
                $SaveData['rbi_date'] =   $RBIDate;
                $SaveData['active'] = 1;
                $SaveData['created_at'] = NOW();
                $SaveData['created_by'] = session('WcmsEmpNo');
                
                $SaveEmployment= $this->rbisanction->CreateRBISanction($SaveData);
            
                DB::commit();
                $message = "RBI Sanction Data Saved Successfully";
            }catch (\Exception $e) {dd($e); 
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('bank.rbi-sanction');
        }
        $SanctionData=$this->rbisanction->ShowRBISanction();
        return view('bank.rbi-sanction')->with('data', compact('SanctionData')); //EL Encashment along with LTC Request
    }
    public function ImscAccountEntry(Request $request){ 
         if(isset($request->btn_save))
        {
            $AccountName = $request->txt_acc_name;
            $AccountNo   = $request->txt_acc_no;
            $BankName    = $request->txt_bank_id;
            $BranchAddr  = $request->txt_branch_id;
          // dd($BankName,$BranchAddr);
            $rules = [
				'AccountName' => 'required|max:25',
				'AccountNo' => 'required|max:5',
                'BankName' => 'required|max:50',
                'BranchAddr' => 'required|max:100',
                
			];
			$ValidateData = [
                'AccountName' =>$AccountName,
				'AccountNo' => $AccountNo,
                'BankName'  => $BankName,
				'BranchAddr' => $BranchAddr,
                				
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
                    if($AccountName == "AccountName"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid Account Name.";
                    }
                    if($BankName == "BankName"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Accout No.";
                    }
                    if($BranchAddr == "BranchAddr"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid RBI Amout.";
                    }
                    
                    
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('bank.imsc-account-entry');
            }
            DB::beginTransaction();
            try {
                $SaveData['account_no']   = $AccountNo;
                $SaveData['account_name'] =   $AccountName;
                $SaveData['bank_id']      =   $BankName;
                $SaveData['branch_id']    =   $BranchAddr;
                $SaveData['active'] = 1;
                $SaveData['created_at'] = NOW();
                $SaveData['created_by'] = session('WcmsEmpNo');
                
                $SaveEmployment= $this->imscaccount->CreateImscAccount($SaveData);
                //dd($SaveEmployment);
                DB::commit();
                $message = "Imsc Data Saved Successfully";
            }catch (\Exception $e) {dd($e); 
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('bank.imsc-account-entry');
        }
        $BankBranchData = $this->bankbranch->ShowBankBranchList(null);
        $ImscAccountData = $this->imscaccount->ShowImscAccount();
        return view('bank.imsc-account-entry')->with('data', compact('BankBranchData','ImscAccountData')); ;
   }
}