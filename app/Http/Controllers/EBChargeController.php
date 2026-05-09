<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\EBCharges;
use App\Models\HouseMaster;
use Helper;
use DB;
use Session;
class EBChargeController extends Controller
{
    public function __construct(){
        $this->Eb     = new EBCharges();
        $this->house  = new HouseMaster();
    }
    public function EBCharge (Request $request)
    {
       if(isset($request->btn_save))
        {
            //dd($request);
            $Month         = $request->cmb_month;
            $Year          = $request->cmb_year;
            $EmpNameArr    = $request->txt_emp_name_payslip;
            $EmpNoArr      = $request->txt_emp_no;
            $DesignationArr= $request->txt_designation;
            $EBUnitArr     = $request->txt_eb_unit; //dd(Helper::DisplayDateFormat($DateVariable)); to Display in blade file
            $EBChargeArr   = $request->txt_eb_charge;
            $ErrArr = [];    

            $rules = [
				'EmpNameArr'     => 'required|max:50',
				'EmpNoArr'       => 'required|max:50',
                'DesignationArr' => 'required|max:50',
				'EBUnitArr'      => 'required|max:50',
                'EBChargeArr'    => 'required|max:50',
				
                
			];
			
            DB::beginTransaction();
            try {
                foreach($EmpNameArr as $EmpNameKey => $EmpNameId){
                    $EmpName       = $EmpNameArr[$EmpNameKey];
                    $EmpNo         = $EmpNoArr[$EmpNameKey];
                    $Designation   = $DesignationArr[$EmpNameKey];
                    $EbUnit        = $EBUnitArr[$EmpNameKey];
                    $EbCharge      = $EBChargeArr[$EmpNameKey];


                    $ValidateData = [
                        'EmpName'     =>$EmpNameArr,
                        'EmpNo'       => $EmpNoArr,
                        'Designation' =>$DesignationArr,
                        'EbUnit'      => $EBUnitArr,
                        'EbCharge'    =>$EBChargeArr,
                                        
                    ];

                    $Validate = Validator::make($ValidateData, $rules); 
                
                    if($Validate->fails())
                    {
                        //$date = NULL;
                        $ValidateFields = $Validate->failed();
                        foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                        {
                            if($EmpName == "EmpName"){
                                //$ItemNo = '';
                                $ErrArr[] = "Error : Invalid Employee Name.";
                            }
                            if($EmpNo == "EmpNo"){
                                //$ItemDesc = '';
                                $ErrArr[] = "Error : Invalid Employee No.";
                            }
                            if($Designation == "Designation"){
                                //$ItemNo = '';
                                $ErrArr[] = "Error : Invalid Designation.";
                            }
                            if($EbUnit == "EbUnit"){
                                //$ItemDesc = '';
                                $ErrArr[] = "Error : Invalid EB Unit.";
                            }
                            if($EbCharge == "EbCharge"){
                                //$ItemDesc = '';
                                $ErrArr[] = "Error : Invalid EB Charge.";
                            }
                            
                        }
                    }
                    if(filled($ErrArr)){
                        $ErrorStr = implode(",",$ErrArr);
                        Session::put('ALertMesage', $ErrorStr);
                        return redirect()->route('eb-charge.eb-charge');
                    }
                    $SaveData['pay_month'] = $Month;
                    $SaveData['pay_year'] = $Year;
                    $SaveData['emp_no'] = $EmpNo;
                    $SaveData['eb_amount'] = $EbCharge;
                    $SaveData['eb_consump_unit'] = $EbUnit;
                    $SaveData['active'] = 1;
                    $SaveData['created_at'] = NOW();
                    $SaveData['created_by'] = session('WcmsEmpNo');
                    //$SaveData['updated_at'] = NOW();
                   //$SaveData['updated_by'] = session('WcmsEmpNo');
                    
                    $SaveFees= $this->Eb->createEBCharges($SaveData);
                }
                DB::commit();
                $message = "Eb Charges  Data Saved Successfully";
            }catch (\Exception $e) { 
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('eb-charge.eb-charge');
        }
      
        $HouseData = $this->house->ShowHouseMaster(null,null);
        $EbData    = $this->Eb->ShowCharges();
        //dd($EbData);
        return view('eb-charge.eb-charge')->with('data', compact('EbData','HouseData'));
    }
    

}
