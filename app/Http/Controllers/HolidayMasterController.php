<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\BankMaster;
use App\Models\BankBranchMaster;
use App\Models\HolidayMaster;
use App\Models\ImscAccount;
use Exception;
use Helper;
use Session;
class HolidayMasterController extends Controller
{
    protected $role;
    public function __construct(){
    //    $this->bankbranch     = new BankBranchMaster();
    //    $this->imscaccount = new ImscAccount();
          $this->HolidayMaster = new HolidayMaster();
    }
    public function HolidayMaster(Request $request)
    {   
        if(isset($request->btn_save))
        {
            $HolidayName = $request->txt_holi_name;
            $HolidayDate = $request->txt_holi_date;
            $HolidayType = $request->cmb_holi;
            $Year = date('Y', strtotime($HolidayDate));
            $rules = [
				'HolidayName' => 'required|max:25',
                 'HolidayType' => 'required'
				 //'RBIAmount' => 'required|max:5',
			];
			$ValidateData = [
                'HolidayName' =>$HolidayName,
                'HolidayType' =>$HolidayType
				//'RBIAmount' => $RBIAmount,
                				
			];
            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($HolidayName == "HolidayName"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Holiday Name.";
                    }
                    // if($RBIAmount == "RBIAmount"){
                    //     //$ItemDesc = '';
                    //     $ErrArr[] = "Error : Invalid RBI Amout.";
                    // }
                    
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('holiday-master.holiday-master');
            }
            DB::beginTransaction();
            try {
                $SaveData['holiday_name']   = $HolidayName;
                $SaveData['holiday_type'] =   $HolidayType;
                $SaveData['holiday_date'] =   $HolidayDate;
                $SaveData['year'] = $Year;
                $SaveData['active'] = 1;
                $SaveData['created_at'] = NOW();
                $SaveData['created_by'] = session('WcmsEmpNo');
                
                $SaveEmployment= $this->HolidayMaster->CreateHolidayMaster($SaveData);
            
                DB::commit();
                $message = "Holiday Master Data Saved ";
            }catch (\Exception $e) {dd($e); 
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('holiday-master.holiday-master');
        }
        $HolidayData=$this->HolidayMaster->ShowHolidayMaster();
        return view('holiday-master.holiday-master')->with('data', compact('HolidayData')); //EL Encashment along with LTC Request
    }
//     public function ImscAccountEntry(Request $request){ 
//          if(isset($request->btn_save))
//         {
//             $AccountName = $request->txt_acc_name;
//             $AccountNo   = $request->txt_acc_no;
//             $BankName    = $request->txt_bank_id;
//             $BranchAddr  = $request->txt_branch_id;
//           // dd($BankName,$BranchAddr);
//             $rules = [
// 				'AccountName' => 'required|max:25',
// 				'AccountNo' => 'required|max:5',
//                 'BankName' => 'required|max:50',
//                 'BranchAddr' => 'required|max:100',
                
// 			];
// 			$ValidateData = [
//                 'AccountName' =>$AccountName,
// 				'AccountNo' => $AccountNo,
//                 'BankName'  => $BankName,
// 				'BranchAddr' => $BranchAddr,
                				
// 			];
//             $Validate = Validator::make($ValidateData, $rules); 
//             $ErrArr = [];
//             if($Validate->fails())
//              {
//                 //$date = NULL;
//                 $ValidateFields = $Validate->failed();
//                 foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
//                 {
//                     if($AccountNo == "AccountNo"){
//                         //$ItemNo = '';
//                         $ErrArr[] = "Error : Invalid Accout No.";
//                     }
//                     if($AccountName == "AccountName"){
//                         //$ItemDesc = '';
//                         $ErrArr[] = "Error : Invalid Account Name.";
//                     }
//                     if($BankName == "BankName"){
//                         //$ItemNo = '';
//                         $ErrArr[] = "Error : Invalid Accout No.";
//                     }
//                     if($BranchAddr == "BranchAddr"){
//                         //$ItemDesc = '';
//                         $ErrArr[] = "Error : Invalid RBI Amout.";
//                     }
                    
                    
//                 }
//             }
//             if(filled($ErrArr))
//             {
//                 $ErrorStr = implode(",",$ErrArr);
//                 Session::put('ALertMesage', $ErrorStr);
//                 return redirect()->route('bank.imsc-account-entry');
//             }
//             DB::beginTransaction();
//             try {
//                 $SaveData['account_no']   = $AccountNo;
//                 $SaveData['account_name'] =   $AccountName;
//                 $SaveData['bank_id']      =   $BankName;
//                 $SaveData['branch_id']    =   $BranchAddr;
//                 $SaveData['active'] = 1;
//                 $SaveData['created_at'] = NOW();
//                 $SaveData['created_by'] = session('WcmsEmpNo');
                
//                 $SaveEmployment= $this->imscaccount->CreateImscAccount($SaveData);
//                 //dd($SaveEmployment);
//                 DB::commit();
//                 $message = "Imsc Data Saved ";
//             }catch (\Exception $e) {dd($e); 
//                 DB::rollback();
//                 $message = "Error : Sorry transaction not fully completed";
//             }
//             Session::put('ALertMesage', $message);
//             return redirect()->route('bank.imsc-account-entry');
//         }
//         $BankBranchData = $this->bankbranch->ShowBankBranchList(null);
//         $ImscAccountData = $this->imscaccount->ShowImscAccount();
//         return view('imsc-bank.imsc-account-entry')->with('data', compact('BankBranchData','ImscAccountData')); ;
//    }
}