<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\EmployeeType;
use App\Models\LocationMaster;
use Helper;
use DB;
use Session;
class LocationController extends Controller
{   
    public function __construct(){
        $this->location  = new LocationMaster();
    }
    public function LocationMaster(Request $request)
    {
        if(isset($request->btn_save))
        {
            //dd($request);
            $LocationName      = $request->txt_loct_name;
            $LocationShortName = $request->txt_loct_shname;
            $rules = [
				'LocationName'      => 'required|max:100',
				'LocationShortName' => 'required|max:50',
			];
			$ValidateData = [
                'LocationName'      => $LocationName,
				'LocationShortName' => $LocationShortName,
			];
            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($LocationName == "LocationName"){
                        $ErrArr[] = "Error : Invalid Location Name.";
                    }
                    if($LocationShortName == "LocationShortName"){
                        $ErrArr[] = "Error : Invalid Location Short Name.";
                    }
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('location.location-master');
            }
            DB::beginTransaction();
            try {
                $SaveData['location_name']  = $LocationName;
                $SaveData['location_sname'] = $LocationShortName;
                $SaveData['active'] = 1;
                $SaveData['created_at'] = NOW();
                $SaveData['created_by'] = session('WcmsEmpNo');
                $SaveLocation = $this->location->createLocationMaster($SaveData);
                DB::commit();
                $message = "Location Master  Data Saved ";
            }catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('location.location-master');
        }
        $LocationData = $this->location->ShowLocationMaster();
        return view('location.location-master')->with('data', compact('LocationData'));//->with('data', compact('OrganizationList'));
    }
    public function ViewLocationMaster(Request $request)
    {
        $LocationData = $this->location->ShowLocationMaster();
        return view('location.ViewLocationMaster')->with('data', compact('LocationData'));
    }

}
