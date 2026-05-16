<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\AemEmployee;
use App\Models\AgmOffice;
use App\Models\designation;
use App\Models\organization;
use App\Models\LicenceFeeWaterCharge;
use App\Models\HouseType;


use Helper;
use DB;
use Session;

class LicenceFeeWaterChargeController extends Controller
{   

     public function __construct(){
            $this->Fees  = new LicenceFeeWaterCharge();
            $this->housetype  = new HouseType();
     }
    public function LicenceFeeWaterCharge(Request $request)
    {
       
       if(isset($request->btn_save))
        {
            
            $HouseTypeIdArr = $request->txt_house_type_id;
            $LicenceFeeArr= $request->txt_lic_fee;
            $LicenseFeeWefArr = $request->txt_lic_feewef;
           // $LicenseFeeWefArr = $request->txt_lic_feewef;
            $WaterChargeArr= $request->txt_water_charge;
            $WaterChargeWefArr = $request->txt_water_chargewef; //dd(Helper::DisplayDateFormat($DateVariable)); to Display in blade file
            //$WaterChargeWefArr = $request->txt_water_chargewef;
            $ErrArr = [];    

            $rules = [
				'HouseTypeIdArr'   => 'required|max:50',
				'LicenceFeeArr'    => 'required|max:50',
                'LicenseFeeWefArr' => 'required|max:50',
				'WaterChargeArr'    => 'required|max:50',
                'WaterChargeWefArr' => 'required|max:50',
				
                
			];
			
            DB::beginTransaction();
            try {
                foreach($HouseTypeIdArr as $HouseTypeKey => $HouseTypeId){
                    $HouseType       = $HouseTypeIdArr[$HouseTypeKey];
                    $LicenceFee      = $LicenceFeeArr[$HouseTypeKey];
                    $LicenseFeeWef   = Helper::DataBaseDateFormat($LicenseFeeWefArr[$HouseTypeKey]);
                    $WaterCharge     = $WaterChargeArr[$HouseTypeKey];
                    $WaterChargeWef  = Helper::DataBaseDateFormat($WaterChargeWefArr[$HouseTypeKey]);


                    $ValidateData = [
                        'HouseType'     =>$HouseTypeIdArr,
                        'LicenceFee'    => $LicenceFeeArr,
                        'LicenseFeeWef' =>$LicenseFeeWefArr,
                        'WaterCharge'   => $WaterChargeArr,
                        'WaterChargeWef' =>$WaterChargeWefArr,
                                        
                    ];

                    $Validate = Validator::make($ValidateData, $rules); 
                
                    if($Validate->fails())
                    {
                        //$date = NULL;
                        $ValidateFields = $Validate->failed();
                        foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                        {
                            if($HouseType == "HouseType"){
                                //$ItemNo = '';
                                $ErrArr[] = "Error : Invalid HouseType.";
                            }
                            if($LicenceFee == "LicenceFee"){
                                //$ItemDesc = '';
                                $ErrArr[] = "Error : Invalid LicenceFee.";
                            }
                            if($LicenseFeeWef == "LicenseFeeWef"){
                                //$ItemNo = '';
                                $ErrArr[] = "Error : Invalid License FeeWef.";
                            }
                            if($WaterCharge == "WaterCharge"){
                                //$ItemDesc = '';
                                $ErrArr[] = "Error : Invalid Water Charge.";
                            }
                            if($WaterChargeWef == "WaterChargeWef"){
                                //$ItemDesc = '';
                                $ErrArr[] = "Error : Invalid WaterChargeWef.";
                            }
                            
                        }
                    }
                    if(filled($ErrArr)){
                        $ErrorStr = implode(",",$ErrArr);
                        Session::put('ALertMesage', $ErrorStr);
                        return redirect()->route('licencefee-watercharge.licencefee-watercharge');
                    }
                    $SaveData['house_type_id'] = $HouseTypeId;
                    $SaveData['house_type'] = $HouseType;
                    $SaveData['licence_fee'] = $LicenceFee;
                    $SaveData['licence_fee_wef'] = $LicenseFeeWef;
                    $SaveData['water_charge'] = $WaterCharge;
                    $SaveData['water_charge_wef'] = $WaterChargeWef;
                    $SaveData['active'] = 1;
                    $SaveData['created_at'] = NOW();
                    $SaveData['created_by'] = session('WcmsEmpNo');
                    //$SaveData['updated_at'] = NOW();
                   //$SaveData['updated_by'] = session('WcmsEmpNo');
                    
                    $SaveFees= $this->Fees->createLicenceFeeWaterCharge($SaveData);
                }
                DB::commit();
                $message = "Licence Fee Water Tariff  Data Saved ";
            }catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('licencefee-watercharge.licencefee-watercharge');
        }
      
        $FeesData=$this->Fees->ShowLicenceFeeWaterCharge();
        $HouseTypeData =$this->housetype->ShowHouseType();
        return view('licencefee-watercharge.licencefee-watercharge')->with('data', compact('FeesData','HouseTypeData'));
    }
}
