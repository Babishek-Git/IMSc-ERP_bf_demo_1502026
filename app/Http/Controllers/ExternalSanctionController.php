<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\BudgetSanction;
use App\Models\ProjectMaster;
use Exception;
use Helper;
use Session;

class ExternalSanctionController extends Controller
{
    protected $role;
    public function __construct(){
       $this->budgetsanction = new BudgetSanction();
       $this->project     = new ProjectMaster();
    }

    public function BudgetSanction(Request $request)
    {   
        if(isset($request->btn_save))
        {
            $AccountNo = $request->txt_sanction_no;
            $RBIAmount = $request->txt_sanction_amount;
            $RBIDate   = $request->txt_sanction_date;
            $Category  = $request->txt_section_category;
            $InternalExternal  = $request->txt_internal_external;
            $SanctionType  = $request->txt_sanction_type;
            $Gia = $request->cmb_gia;
            $ProjectName = $request->cmb_project_name;
            $FinYear = $request->cmb_fin_year;
            
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
                return redirect()->route('bank.external-sanction');
            }
            DB::beginTransaction();
            try {
                $SaveData['budget_sanction_no']     = $AccountNo;
                $SaveData['budget_sanction_amt'] =   $RBIAmount;
                $SaveData['budget_sanction_date'] =   $RBIDate;
                $SaveData['sanction_category'] =   $Category;
                $SaveData['internal_external'] =   $InternalExternal;
                $SaveData['sanction_type'] =   $SanctionType;
                $SaveData['active'] =   1;
                $SaveData['fin_year'] =   $FinYear;
                $SaveData['project_id'] =   $ProjectName;
                $SaveData['created_at'] = NOW();
                $SaveData['created_by'] = session('WcmsEmpNo');
                
                $SaveEmployment= $this->budgetsanction->CreateBudgetSanction($SaveData);
            
                DB::commit();
                $message = "External Sanction Data Saved Successfully";
            }catch (\Exception $e) {dd($e); 
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('bank.external-sanction');
        }
        $SanctionData=$this->budgetsanction->ShowExternalSanction();
        $ProjectData = $this->project->ShowProjectMasterWithProjectType();  
        //$ExternalSanctionData = $this->ExternalSanction->ShowExternalSanction(); 
        return view('imsc-bank.external-sanction')->with('data', compact('SanctionData','ProjectData'));
    }
    
}