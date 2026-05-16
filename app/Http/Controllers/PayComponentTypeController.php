<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\PayComponentType;
use Helper;
class PayComponentTypeController extends Controller
{
     public function __construct(){ 
         $this->paycomponent = new PayComponentType();
     }
    public function PayComponentType(Request $request)
    {
        if(isset($request->btn_save))
    {
        $ComponentName = $request->txt_comp_name;
        $ComponentCode = $request->txt_comp_code;
        $PayEffect     = $request->txt_pay_effect;
               
        $rules = [
            'ComponentName' => 'required|max:25',
            'ComponentCode' => 'required|max:5',
            'PayEffect'     => 'required|max:10',
            
        ];

        $ValidateData = [
            'ComponentName' => $ComponentName,
            'ComponentCode' => $ComponentCode,
            'PayEffect'     => $PayEffect,
                            
        ];
        $Validate = Validator::make($ValidateData, $rules); 
        $ErrArr = [];
        if($Validate->fails())
        {
            //$date = NULL;
            $ValidateFields = $Validate->failed();
            foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
            {
                if($ComponentName == "ComponentName"){
                    //$ItemNo = '';
                    $ErrArr[] = "Error : Invalid Component Name.";
                }
                if($ComponentCode == "ComponentCode"){
                    //$ItemDesc = '';
                    $ErrArr[] = "Error : Invalid Component Code.";
                }
                if($PayEffect == "PayEffect"){
                    //$ItemDesc = '';
                    $ErrArr[] = "Error : Invalid Pay Effect.";
                }
                
            }
        }
        if(filled($ErrArr))
        {
            $ErrorStr = implode(",",$ErrArr);
            Session::put('ALertMesage', $ErrorStr);
            return redirect()->route('payroll.pay-component-master.pay-component-type.pay-component-type');
        }
        DB::beginTransaction();
        try {
            $SaveData['component_type_name'] = $EmpCode;
            $SaveData['component_type_code'] =    $TypeName;
            $SaveData['pay_effect'] =    $TypeName;
            $SaveData['active'] = 1;
            $SaveData['created_at'] = NOW();
        if($EditEmpCode != NULL){ 
                $SaveEmployee= $this->employeetype->updateEmploymentType($SaveData,$EditEmpCode);
            }
            else{
                $SaveEmployee= $this->employeetype->createEmployeeType($SaveData);
            }
                    
            DB::commit();
            $message = "Employee Type Data Saved ";
        }catch (\Exception $e) {dd($e);
            DB::rollback();
            $message = "Error : Sorry transaction not fully completed";
        }
        Session::put('ALertMesage', $message);
        return redirect()->route('EmployeeType.EmployeeType');
     }
        $paycomponentData = $this->paycomponent->getWithComponent();
        return view('payroll.pay-component-master.pay-component-type.pay-component-type')->with('data', compact('paycomponentData'));//->with('data', compact('OrganizationList'));
    }
}
