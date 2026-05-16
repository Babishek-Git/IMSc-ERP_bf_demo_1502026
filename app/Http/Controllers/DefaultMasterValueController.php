<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\AemEmployee;
use App\Models\AgmOffice;
use App\Models\DefaultMaster;
use App\Models\DefaultMasterValue;


use Helper;
use DB;
use Session;

class DefaultMasterValueController extends Controller
{   
     public function __construct(){
        $this->default  = new DefaultMaster();
        $this->defaultvalue  = new DefaultMasterValue();
     }
     public function DefaultMasterValue (Request $request)
    {
         if(isset($request->btn_save))
        {

          // dd($request);
            $CodeArr=$request->txt_master_code;  
            $ValueArr = $request->txt_value;
            $WithEffectFromArr = $request->txt_eff_from;
            $ErrArr = [];
           // dd($CodeArr);

            $rules = [
                    //'Mode' => 'required|max:5',
                    'ValueArr' => 'required|max:3',
                    'WithEffectFromArr' => 'required|max:50',
				   	]; 
                                            
             
            DB::beginTransaction();
            try {
                foreach($CodeArr as $CodeKey => $CodeValue){
                    
                    $MasterValue = $ValueArr[$CodeKey];
                    $WithEffectFrom = $WithEffectFromArr[$CodeKey];
                    $ModeValue=$request->input('rad_mode_'.$CodeValue);

                     $ValidateData = [
                        'ModeValue' =>$ModeValue,
                        'MasterValue' => $MasterValue,
                        'WithEffectFrom' =>$WithEffectFrom,
                                                
                    ]; 
                    
                    $Validate = Validator::make($ValidateData, $rules); 
                    
                    if($Validate->fails())
                    {
                        //$date = NULL;
                        $ValidateFields = $Validate->failed();
                        foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                        {
                            if($ModeValue == "ModeValue"){
                                //$ItemNo = '';
                                $ErrArr[] = "Error : Invalid Mode.";
                            }
                            if($MasterValue == "MasterValue"){
                                //$ItemDesc = '';
                                $ErrArr[] = "Error : Invalid Value.";
                            }
                            if($WithEffectFrom == "WithEffectFrom"){
                                //$ItemNo = '';
                                $ErrArr[] = "Error : Invalid WithEffectFrom.";
                            }
                                            
                        }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('default-master-value.default-master-value');
            } 
                   // dd($WithEffectFrom);
                    $SaveData['def_mast_code']   =  $CodeValue;
                    $SaveData['def_mast_mode']   =  $ModeValue;
                    $SaveData['def_mast_value']   = $MasterValue;
                    $SaveData['with_effect_from'] = $WithEffectFrom;
                    $SaveData['active'] = 1;
                    $SaveData['created_at'] = NOW();
                    
                    $SaveValues= $this->defaultvalue->CreateDefaultMaster($SaveData);
                    //dd($SaveValues);
                        
                }
                //$SaveData['def_mast_mode'] = $Mode;
                
            
                DB::commit();
                $message = " Default Master  Data Saved";
            }catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('default-master-value.default-master-value');
        }

        $DefaultData=$this->default->ShowDefaultMaster();
        $DefaultValueData=$this->defaultvalue->ShowDefaultMasterValue();
        return view('default-master-value.default-master-value')->with('data', compact('DefaultData','DefaultValueData'));
    }
}
