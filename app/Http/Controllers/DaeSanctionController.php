<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\BudgetSanction;
use App\Models\Gia;
use Exception;
use Helper;
use Session;

class DaeSanctionController extends Controller
{
    protected $role;
    public function __construct(){
       $this->budgetsanction = new BudgetSanction();
       $this->gia         = new Gia();
    }

    public function BudgetSanction(Request $request)
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
    }
    
}