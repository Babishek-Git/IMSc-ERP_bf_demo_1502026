<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\HouseMaster;
use App\Models\HouseType;
use App\Models\AemEmployee;

use Helper;
use DB;
use Session;

class PFMRUniqueIdController extends Controller
{   
    public function __construct(){
        $this->house     = new HouseMaster();
        $this->housetype = new HouseType();
        $this->employee  = new AemEmployee();
    }
    public function PFMRUniqueId(Request $request)
    {
        $message = NULL;
        $EmpData    = $this->employee->ShowEmployeeswithNoPFMRId(NULL,NULL);
        if(isset($request->btn_save))
        {
            
            $EmployeeICNoArr  = $request->input('hidden_emp_id');
            if(filled($EmployeeICNoArr)){
                $PfmrIdArr  = $request->input('txt_pfmr_id');
                $ErrArr         = [];
                DB::beginTransaction();
                try {
                    foreach($EmployeeICNoArr as $EmployeeICNoKey => $EmpIcno){
                        $PFMRId = $PfmrIdArr[$EmployeeICNoKey];
                        $SaveData = [];
                        $SaveData['pfmr_id'] = $PFMRId;
                        $SaveEmployee = $this->employee->UpdateEmployee($SaveData,$EmpIcno);
                    }
                    DB::commit();
                    $message = "PFMR Insurance Details Saved Successfully";
                }
                catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry Details not Saved";
                Session::put('ALertMesage', $message); 
                return redirect()->route('pfmr_unique_id.pfmr_unique_id');
                }
            }
        }
      return view('pfmr_unique_id.pfmr_unique_id')->with('data', compact('EmpData'));
    }
    public function ViewPFMRUniqueId(Request $request)
    {
          $EmpData    = $this->employee->ShowEmployeeswithPFMRId(NULL,NULL);
        return view('pfmr_unique_id.view-pfmr_unique_id')->with('data', compact('EmpData'));
    }
}
