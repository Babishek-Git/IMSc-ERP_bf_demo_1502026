<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\ChildEducationAllowance;
use Helper;
use DB;
use Session;
class ChildEducationAllowanceController extends Controller
{
    public function cearate(Request $request) {
                  $this->ChildEducationAllowance  = new ChildEducationAllowance();

        if(isset($request->btn_save))
        {
           
            $ceaMode = $request->txt_mode_0;
            //($MaterialCode);
            $cearate= $request->txt_rate;
            $cearateper = $request->txt_rate_per;
            $ceawitheffect = $request->txt_effect_from;
             $MaterialId   = $request->hid_cea_id;



            
            $rules = [
				'ceaMode' => 'required|max:5',
				'cearate' => 'required|max:25',
                'cearateper' => 'required|max:5',
				'ceawitheffect' => 'required|max:5',

			];
			$ValidateData = [
                'ceaMode' => $ceaMode,
				'cearate' =>  $cearate,
                'cearateper' => $cearateper,
				'ceawitheffect' => $ceawitheffect,
				
			];
            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($ceaMode == "ceaMode"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid cea Mode.";
                    }
                    if($cearate == "cearate"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid CEA Rate.";
                    }
                      if($cearateper == "cearateper"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid CEA Rate Per.";
                    }
                      if($ceawitheffect == "ceawitheffect"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid CEA with effect.";
                    }
                    
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('cea.cea-rate');
            }
            DB::beginTransaction();
            try {
              // dd(123);
                $SaveData['cea_rate_mode'] = $ceaMode;
                $SaveData['cea_rate'] = $cearate;
                $SaveData['cea_rate_unit'] = $cearateper;
                $SaveData['is_current'] = 'TRUE';
                $SaveData['with_effect_from'] = $ceawitheffect;
                $SaveData['active'] = 1;
                $SaveData['created_at'] = NOW();
                $SaveData['created_by'] = session('WcmsEmpNo');
                  if($MaterialId != NULL){ 
                    $SaveData['updated_at'] = NOW();
                    $SaveData['updated_by'] = session('WcmsEmpNo');
                    $SaveEmployment= $this->ChildEducationAllowance->updateChildEducationAllowance($SaveData,$MaterialId);
                }else{
                    $SaveData['created_at'] = NOW();
                    $SaveData['created_by'] = session('WcmsEmpNo');
                $SaveEmployment= $this->ChildEducationAllowance->createChildEducationAllowance($SaveData);
                }
                
                //dd($SaveEmployment);
                DB::commit();
                $message = "ChildEducationAllowance Data Saved Successfully";
            }catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('cea.cea-rate');
        }
          $EditChildEducationAllowanceData=NULL;
        if(isset($request->id)){ 
            try {
              
                $EditId = decrypt($request->id); 
                //dd($EditId); 
                      
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $data = "Error : Sorry Invalid Attempt";
                return redirect()->back();
            }
            $EditChildEducationAllowanceData=$this->ChildEducationAllowance->ShowChildEducationAllowance($EditId); 
            //dd($EditChildEducationAllowanceData);
            //return view('designation-master.designation-master')->with('data', compact('EmployeeData'));
        }
        $ChildEducationAllowanceData=$this->ChildEducationAllowance->ShowChildEducationAllowance(null);
        return view('cea.cea-rate')->with('data', compact('ChildEducationAllowanceData','EditChildEducationAllowanceData'));//->with('data', compact('OrganizationList'));
    
        
        //return view('cea.cea-rate');//->with('data', compact('OrganizationList'));
    }
}
