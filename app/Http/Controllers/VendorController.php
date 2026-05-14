<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Contractor;
use App\Models\ContractorDetail;
use App\Models\ContractorGST;
use Exception;
use Helper;
use Session;
class VendorController extends Controller
{
    protected $role;
    public function __construct(){
       $this->Contractor       = new Contractor();
       $this->ContractorDetail = new ContractorDetail();
       $this->ContractorGSt    = new ContractorGST();
    }
    public function VenodorEntryForm(Request $request){

        $IsSave = 0; $IsModal = ''; $IsReload = '';
        if(isset($request->btn_save)){
            $IsSave = 1;
        }
        if(isset($request->ModalSave)){
            $IsSave = 1;
            $IsModal = $request->is_modal;
            $IsReload = $request->is_reload;
        }
        if($IsSave = 1){
             //dd($request);
            $VendorName    = $request->txt_vendor_name;
            $VendorAddress = $request->txt_addr;
            $GStNo         = $request->txt_gst_no;
            $Panno         = $request->txt_pan_no;
            $ContactNo     = $request->txt_contact_no;
            $BankAccountNo = $request->txt_bank_account_no;
            $IfscCode      = $request->txt_ifsc_code;
            $BankName      = $request->txt_bank_name;
            $BranchAddr    = $request->txt_branc_addr;
            $BankId        = $request->txt_bank_id;
            $BranchId      = $request->txt_branch_id;

            $rules = [
				'VendorName'    => 'required|max:100',
				'VendorAddress' => 'required|max:100',
                'GStNo'         => 'required|max:15',
				'Panno'         => 'required|max:15',
                'ContactNo'     => 'required|max:10',
				'BankAccountNo' => 'required|max:25',
                'BankName'      => 'required|max:50',
				'BranchAddr'    => 'required|max:100',
			];

			$ValidateData = [
                'VendorName'   => $VendorName,
				'VendorAddress'=> $VendorAddress,
                'GStNo'        => $GStNo,
				'Panno'        => $Panno,
                'ContactNo'    => $ContactNo,
				'BankAccountNo'=> $BankAccountNo,
                'BankName'     => $BankName,
				'BranchAddr'   => $BranchAddr,
                				
			];
            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($VendorName == "VendorName"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Vendor Name.";
                    }
                    if($VendorAddress == "VendorAddress"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid Vendor Address.";
                    }
                    if($GStNo == "GStNo"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid GSt No.";
                    }
                    if($Panno == "Panno"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid Pan no.";
                    }
                    if($ContactNo == "ContactNo"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : InvalidContact No.";
                    }
                    if($BankAccountNo == "BankAccountNo"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Bank AccountNo.";
                    }
                    if($BankName == "BankName"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid Bank Name.";
                    }
                    if($BranchAddr == "BranchAddr"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid Branch Address.";
                    }
                    
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                if($IsModal != 'Y'){
                    Session::put('ALertMesage', $ErrorStr);
                    return redirect()->route('vendor.vendor-entry-form');
                }
            }
            DB::beginTransaction();
            try { 
                $SaveData['name_contractor'] = $VendorName;
                $SaveData['addr_contractor'] = $VendorAddress;
                $SaveData['pan_no']          = $Panno;
                $SaveData['active']          = 1;
                $SaveData['created_at']      = NOW();
                $SaveData['created_by']      = session('WcmsEmpNo');
                $SaveEmployee= $this->Contractor->CreateContractor($SaveData);
                $ContId   = $SaveEmployee->contid;
              
                $SaveDataGst['contid']          = $ContId;
                $SaveDataGst['gst_no']          = $GStNo;
                $SaveDataGst['active']          = 1;
                $SaveDataGst['created_at']      = NOW();
                $SaveDataGst['created_by']      = session('WcmsEmpNo');
                $SaveEmployee= $this->ContractorGSt->CreateContractorGSt($SaveDataGst);
               

                $SaveDatadt['contid']       = $ContId;
                $SaveDatadt['bank_acc_no']  = $BankAccountNo;
                $SaveDatadt['bank_id']      = $BankId;
                $SaveDatadt['branch_id']    = $BranchId;
                $SaveDatadt['ifsc_code']    = $IfscCode;
                $SaveDatadt['active']       = 1;
                $SaveDatadt['created_at']   = NOW();
                $SaveDatadt['created_by']   = session('WcmsEmpNo');
                $SaveEmployee= $this->ContractorDetail->CreateContractorDetail($SaveDatadt);
                 //dd($SaveEmployee);
                DB::commit();
                $message = "Contractor Data Saved ";
            }catch (\Exception $e) {dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            if($IsModal != 'Y'){
                Session::put('ALertMesage', $message);
                return redirect()->route('vendor.vendor-entry-form');
            }
        }  
        $ContractorData=$this->Contractor->ShowContractor(); 
        $ContractorDetailData=$this->ContractorDetail->ShowContractorDetail(); 
        $ContractorGSTData=$this->ContractorGSt->ShowContractorGSt(); 
        if($IsModal == 'Y'){
            return ['Message'=>$message,'ContractorData'=>$ContractorData,'ContractorDetailData'=>$ContractorDetailData,'ContractorGSTData'=>$ContractorGSTData];
        }else{ 
            return view('vendor.vendor-entry-form'); //EL Encashment along with LTC Request
        }
    }
}