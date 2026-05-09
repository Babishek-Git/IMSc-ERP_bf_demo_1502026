<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\EmployeeType;
use App\Models\AllowanceAdvanceMaster;
use App\Models\PayComponentType;
use App\Models\EmployeeGroupMaster;
use Helper;
use DB;
use Session;

class AllowanceAdvanceController extends Controller
{   
    public function __construct(){
        $this->allowance     = new AllowanceAdvanceMaster();
        $this->employeetype  = new EmployeeType();
        $this->ComponentType  = new PayComponentType();
        $this->empgroup = new EmployeeGroupMaster();
    }
    public function AllowanceAdvanceMaster(Request $request)
    {
        if(isset($request->btn_save))
        {
           // dd($request);
            $ComponentTypeCode      = $request->rad_alw_adv;
            $ApplicableTo = $request->txt_allowance_to;
            $SaveApplicableTo = implode(',',$ApplicableTo); 
            $WithEffectFrom = Helper::DBDateFormat($request->txt_witheffect); 
            $AllowanceAdvanceName = $request->txt_alw_adv_name;
            $AllowanceAdvanceCode = $request->txt_alw_adv_code;
            $Amount               = $request->txt_fix_amt;
            $PercentRate          = $request->percente_rate;
            $RateType             = $request->rate_type;
            $Tax                  = $request->rad_tax;
            $PercentAmount        =  $request->rad_perc_amt;
            //dd($PercentAmount );
            $RateType             =  $request->rate_type;
            $FixedAmount          =  $request->txt_fix_amt;
            $IsPerc               = False;
            if(isset($request->ch_perc_app)){
                $IsPerc = $request->ch_perc_app;
            }
            if($ApplicableTo == 'ST'){
                $EmploymentType = 'p';
            }else{
                $EmploymentType = 'S'; 
            }
             if($PercentAmount == 'PERC'){
                $IsPercentage = 'True';
            }else{
                $IsPercentage = 'False'; 
            }
            $rules = [
				'AllowanceAdvanceName' => 'required|max:50',
				'WithEffectFrom'       => 'required|max:50',
                'AllowanceAdvanceFrom' => 'required|max:50',
               
			];

			$ValidateData = [
                'AllowanceAdvanceName' => $AllowanceAdvanceName,
				'WithEffectFrom'       => $WithEffectFrom,
                'AllowanceAdvanceName' => $AllowanceAdvanceName,
                
			];

            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($AllowanceAdvanceName == "AllowanceAdvanceName"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Type.";
                    }
                    if($WithEffectFrom == "WithEffectFrom"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid With Effect From.";
                    }
                    if($AllowanceAdvanceName == "AllowanceAdvanceName"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Name.";
                    }
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('AllowanceAdvanceMaster.AllowanceAdvanceMaster');
            }
            DB::beginTransaction();
            try {
                $ComponentData=$this->ComponentType->ShowPayComponentByCode(NULL,$ComponentTypeCode);
                $componentTypeId =collect( $ComponentData)->pluck('component_type_id')->first();
               
                $SaveData['component_code']       = $ComponentTypeCode;
                $SaveData['component_name']       = $AllowanceAdvanceName;
                $SaveData['component_type_id']    = $componentTypeId;
                $SaveData['is_taxable']           = $Tax;
                $SaveData['is_percentage']        = $IsPercentage;
                $SaveData['applicable_emp_group'] = $SaveApplicableTo;
                $SaveData['with_effect_from']     = $WithEffectFrom;
                $SaveData['active']               = 1;
                $SaveData['created_at']           = NOW();
                $SaveData['created_by']           = session('WcmsEmpNo');
                // $SaveData['updated_at'] = NOW();
                // $SaveData['updated_by'] = session('WcmsEmpNo');
                $SaveComponent  = $this->allowance->createAllowanceAdvanceMaster($SaveData);
                //dd($SaveComponent);
                DB::commit();
                $message = "Allowance/Advance Master  Data Saved Successfully";
            }catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('AllowanceAdvanceMaster.AllowanceAdvanceMaster');
        }
        $EmployeeGroupData = $this->empgroup->ShowEmployeeGroupForAllowance(NULL);  
       
        return view('allowance-advance-loan.allowance-advance-loan')->with('data', compact('EmployeeGroupData'));//->with('data', compact('OrganizationList'));
    }
    public function ViewAllowanceAdvanceMaster(Request $request)
    {
        /* $Page = 'REQ';
        $EmpNo       = session('WcmsEmpNo');
        $ceaData = $this->Reimbursement->ShowReimbursementMasterCEA(NULL,$EmpNo,'CEA'); */
        $ComponentData   = $this->allowance->ShowAllowanceAdvanceMaster(NULL);
        $EmpGroupData    = $this->empgroup->ShowEmployeeGroupForAllowance(NULL);
        // dd($EmpGroupData);
        // $GroupedEmpGroup = $EmpGroupData->keyBy('emp_group_id');
        // dd($GroupedEmpGroup);
        $EmpGrpArr = [];
        if(filled($EmpGroupData)){
            foreach($EmpGroupData as $Empvalue){
                $EmpGrpArr[$Empvalue->emp_group_id] = $Empvalue->emp_group_name;
            }
        }
        return view('allowance-advance-loan.view-allowance-advance-loan')->with('data', compact('ComponentData','EmpGroupData','EmpGrpArr'));;
    }
}
