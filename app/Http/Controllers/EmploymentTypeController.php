<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\EmploymentType;
use Helper;
use DB;
use Session;
class EmploymentTypeController extends Controller
{

    public function __construct(){
          $this->employmenttype  = new EmploymentType();
    }
     public function EmploymentType(Request $request)
     {
        if(isset($request->btn_save))
        {
            $TypeCode = $request->txt_type_code;
            $EmploymentType= $request->txt_emp_type;
            
            $rules = [
				'TypeCode' => 'required|max:10',
				'EmploymentType' => 'required|max:25',
                
			];
			$ValidateData = [
                'TypeCode' =>$TypeCode,
				'EmploymentType' => $EmploymentType,
                				
			];
            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($TypeCode == "TypeCode"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Type Code.";
                    }
                    if($EmploymentType == "EmploymentType"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid Employment Type.";
                    }
                    
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('employment-type.employment-type');
            }
            DB::beginTransaction();
            try {
                $SaveData['employment_type_code'] = $TypeCode;
                $SaveData['employment_type'] =   $EmploymentType;
                $SaveData['active'] = 1;
                $SaveData['created_at'] = NOW();
                $SaveData['created_by'] = session('WcmsEmpNo');
                
                $SaveEmployment= $this->employmenttype->createEmploymentType($SaveData);
            
                DB::commit();
                $message = "Employment Type Data Saved ";
            }catch (\Exception $e) { 
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('employment-type.employment-type');
        }
      
        $EmploymentData=$this->employmenttype->ShowEmploymentType();
        return view('employment-type.employment-type')->with('data', compact('EmploymentData'));//->with('data', compact('OrganizationList'));
    }
}
