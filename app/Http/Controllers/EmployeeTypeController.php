<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\EmployeeType;
use Helper;
use DB;
use Session;
class EmployeeTypeController extends Controller
{

    public function __construct(){
          $this->employeetype  = new EmployeeType();
    }
    public function EmployeeType(Request $request)
    { 
           if(isset($request->btn_save))
           {
           // dd($request);
            $EmpCode = $request->txt_emptype_code;
            $TypeName = $request->txt_emptype_name;
            $EditEmpCode =$request->hid_emptype_code;
            
            $rules = [
				'EmpCode' => 'required|max:10',
				'TypeName' => 'required|max:25',
                
			];
			$ValidateData = [
                'EmpCode' => $EmpCode,
				'TypeName' =>$TypeName,
                				
			];
            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($EmpCode == "EmpCode"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Type Code.";
                    }
                    if($TypeName == "TypeName"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid Type Name.";
                    }
                    
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('EmployeeType.EmployeeType');
            }
            DB::beginTransaction();
            try {
                $SaveData['emp_type_code'] = $EmpCode;
                $SaveData['emp_type'] =    $TypeName;
                $SaveData['active'] = 1;
                if($EditEmpCode != NULL){ 
                    $SaveData['updated_at'] = NOW();
                    $SaveData['updated_by'] = session('WcmsEmpNo');
                }else{
                    $SaveData['created_at'] = NOW();
                    $SaveData['created_by'] = session('WcmsEmpNo');
                }
                if($EditEmpCode != NULL){ 
                    $SaveEmployee= $this->employeetype->updateEmploymentType($SaveData,$EditEmpCode);
                }
                else{
                    $SaveEmployee= $this->employeetype->createEmployeeType($SaveData);
                }
                          
                DB::commit();
                $message = "Employee Type Data Saved Successfully";
            }catch (\Exception $e) {dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('EmployeeType.EmployeeType');
        }
        $EditEmployeeData = NULL;
        if(isset($request->id)){ 
            try {
              
                $EditId = decrypt($request->id); 
                      
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $data = "Error : Sorry Invalid Attempt";
                return redirect()->back();
            }
            $EditEmployeeData=$this->employeetype->ShowEmployeeType($EditId); 
            //return view('employee-type.employee-type')->with('data', compact('EmployeeData'));
        }
          
        $EmployeeData = $this->employeetype->ShowEmployeeType(NULL); //dd($EditEmployeeData);
        return view('employee-type.employee-type')->with('data', compact('EmployeeData','EditEmployeeData'));
  }

}
