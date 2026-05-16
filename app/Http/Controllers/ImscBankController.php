<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\BankMaster;
use App\Models\BankBranchMaster;
use App\Models\RbiSanction;
use App\Models\ImscAccount;
use App\Models\ProjectMaster;
use App\Models\DAEApexSanction;
use App\Models\Gia;
use App\Models\ExternalSanction;
use Exception;
use Helper;
use Session;
class ImscBankController extends Controller
{
    protected $role;
    public function __construct(){
       $this->bankbranch  = new BankBranchMaster();
       $this->imscaccount = new ImscAccount();
       $this->rbisanction = new RbiSanction();
       $this->project     = new ProjectMaster();
       $this->daeapex     = new DAEApexSanction();
       $this->gia         = new Gia();
       $this->ExternalSanction = new ExternalSanction();
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
                $message = "RBI Sanction Data Saved ";
            }catch (\Exception $e) {dd($e); 
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('bank.rbi-sanction');
        }
        $SanctionData=$this->rbisanction->ShowRBISanction();
        //$GiaData=$this->gia->ShowGia();
        $GiaData=$this->gia->ShowGiaForSanction('DAE');
        return view('imsc-bank.rbi-sanction')->with('data', compact('SanctionData','GiaData')); //EL Encashment along with LTC Request
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
                $message = "Imsc Data Saved ";
            }catch (\Exception $e) {dd($e); 
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('bank.imsc-account-entry');
        }
        $BankBranchData = $this->bankbranch->ShowBankBranchList(null);
        $ImscAccountData = $this->imscaccount->ShowImscAccount();
        return view('imsc-bank.imsc-account-entry')->with('data', compact('BankBranchData','ImscAccountData')); ;
   }
    public function DAEApexSanction(Request $request)
    {
        if(isset($request->btn_save))
        {
            //dd($request);
            $FinYear     = $request->cmb_fin_year;
            $GIA         = $request->cmb_gia;
            $AccountNo   = $request->txt_acc_no;
            $ApexAmount  = $request->txt_dae_apex_amount;
            $ApexDate    = $request->txt_dae_apex_date;
       
            $rules = [
				'FinYear'     => 'required|max:20',
				'GIA'         => 'required|max:5',
                'AccountNo'   => 'required|max:50',
                'ApexAmount'  => 'required|max:100',
                
			];
			$ValidateData = [
                'FinYear'     =>$FinYear,
				'GIA'         => $GIA,
                'AccountNo'   => $AccountNo,
				'ApexAmount'  => $ApexAmount,
                				
			];
            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($FinYear == "FinYear"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Accout No.";
                    }
                    if($GIA == "GIA"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid Account Name.";
                    }
                    if($AccountNo == "AccountNo"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Accout No.";
                    }
                    if($ApexAmount == "ApexAmount"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid RBI Amout.";
                    }
                    
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('bank.dae-apex-sanction');
            }
            DB::beginTransaction();
            try {
                $SaveData['dae_apex_sanction_no']      = $AccountNo;
                $SaveData['dae_apex_sanction_amount']  = $ApexAmount;
                $SaveData['dae_apex_sanction_date']    = $ApexDate;
                $SaveData['active'] = 1;
                $SaveData['created_at'] = NOW();
                $SaveData['created_by'] = session('WcmsEmpNo');
                
                $SaveEmployment= $this->daeapex->CreateDAEApexSanction($SaveData);
                //dd($SaveEmployment);
                DB::commit();
                $message = "DAE Apex Saved ";
            }catch (\Exception $e) {dd($e); 
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('bank.dae-apex-sanction');
        }
        $GiaData=$this->gia->ShowGiaForSanction('APEX');
        $DaeApexSanctionData = $this->daeapex->ShowDAEApexSanction();
        return view('imsc-bank.dae-apex-sanction')->with('data', compact('GiaData','DaeApexSanctionData')); ; 
    }
    public function ExternalApexSanction(Request $request)    {
        $ProjectData = $this->project->ShowProjectMasterWithProjectType();  
        $ExternalSanctionData = $this->ExternalSanction->ShowExternalSanction(); 
        return view('imsc-bank.external-sanction')->with('data', compact('ProjectData','ExternalSanctionData'));
    }
}