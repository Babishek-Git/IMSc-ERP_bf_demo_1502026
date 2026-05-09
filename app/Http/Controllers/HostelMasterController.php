<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\HouseMaster;


use Helper;
use DB;
use Session;

class HostelMasterController extends Controller
{   
     public function __construct(){
         $this->house  = new HouseMaster();
     }
     public function HostelMaster(Request $request)
    {
        if(isset($request->btn_save))
        {
            $HostelCode   = $request->txt_hostel_code;
            $HostelAddress= $request->txt_hostel_addr;
            $HostelType = $request->txt_hostel_type;
            $HostelStatus= $request->txt_house_status;
            $Employeeno = $request->txt_emp_no;
            $OccupiedOn= $request->txt_occ_on;
            
            $rules = [
				'HostelCode'    => 'required|max:20',
				'HostelAddress' => 'required|max:50',
                'HostelType'    => 'required|max:10',
				'HostelStatus'  => 'required|max:20',
                'Employeeno'    => 'required|max:150',
				'OccupiedOn'    => 'required|max:100',
                
			];
			$ValidateData = [
                'HostelCode'    => $HostelCode,
				'HostelAddress' => $HostelAddress,
                'HostelType'    => $HostelType,
				'HostelStatus'  => $HostelStatus,
                'Employeeno'    => $Employeeno,
				'OccupiedOn'    => $OccupiedOn,
                				
			];
            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($HostelCode == "HostelCode"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid House Name.";
                    }
                    if($HostelAddress == "HostelAddress"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid House Address.";
                    }
                    if($HostelType == "HostelType"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid House Type.";
                    }
                    if($OccupiedOn == "OccupiedOn"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid occupied on.";
                    }
                    
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('HouseMaster.HouseMaster');
            }
            DB::beginTransaction();
            try {
                $SaveData['house_code']    = $HostelCode;
                $SaveData['house_address'] = $HostelAddress;
                $SaveData['house_type']    = $HostelType;
                $SaveData['house_status']  = $HostelStatus;
                $SaveData['is-hostel']     = 'true';
                $SaveData['emp_no']        = $Employeeno;
                $SaveData['occupied_on']   = $OccupiedOn;
                $SaveData['active']        = 1;
                $SaveData['created_at']    = NOW();
                $SaveData['created_by']    = session('WcmsEmpNo');
                $SaveHouse= $this->house->createHouseMaster($SaveData);
                dd($SaveHouse);
            
                DB::commit();
                $message = "House Master Data Saved Successfully";
            }catch (\Exception $e) { dd($e);end;
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('HostelMaster.HostelMaster');
        }
        $HostelData = $this->house->ShowHostelMaster();
        return view('hostel.hostel-master')->with('data', compact('HostelData'));;
    }
    public function HostelAllotment(Request $request)
    {
        return view('hostel.hostel-alotment');

    }
     public function HostelVacation(Request $request)
    {
        return view('hostel.hostel-vacation');

    }

}
