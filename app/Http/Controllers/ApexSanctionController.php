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

class ApexSanctionController extends Controller
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
            $SanctionNo  = $request->txt_sanction_no;
            $SanctionAmt  = $request->txt_sanction_amount;
            $SanctionDt    = $request->txt_sanction_date;
            $Gia        = $request->cmb_gia;
            $FinYear    = $request->cmb_fin_year;
            $Category  = $request->txt_section_category;
            $InternalExternal  = $request->txt_internal_external;
            
            $rules = [
				'AccountNo' => 'required|max:25',
				'RBIAmount' => 'required|max:5',
			];
			$ValidateData = [
                'AccountNo' =>$SanctionNo,
				'RBIAmount' => $SanctionAmt,
                				
			];
            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($SanctionNo == "AccountNo"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Accout No.";
                    }
                    if($SanctionAmt == "RBIAmount"){
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
                $SaveData['budget_sanction_no']     = $SanctionNo;
                $SaveData['budget_sanction_amt'] =   $SanctionAmt;
                $SaveData['budget_sanction_date'] =   $SanctionDt;
                $SaveData['sanction_category'] =   $Category;
                $SaveData['internal_external'] =   $InternalExternal;
                $SaveData['fin_year'] =   $FinYear;
                $SaveData['gia_id'] =   $Gia;
                $SaveData['active'] =   1;
                $SaveData['created_at'] = NOW();
                $SaveData['created_by'] = session('WcmsEmpNo');
                
                $SaveEmployment= $this->budgetsanction->CreateBudgetSanction($SaveData);
            
                DB::commit();
                $message = "APEX Sanction Data Saved Successfully";
            }catch (\Exception $e) {dd($e); 
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('bank.dae-apex-sanction');
        }
        $SanctionData=$this->budgetsanction->ShowApexSanction();
        $GiaData=$this->gia->ShowGiaForSanction('APEX');
        return view('imsc-bank.dae-apex-sanction')->with('data', compact('SanctionData','GiaData'));
    }
    
}