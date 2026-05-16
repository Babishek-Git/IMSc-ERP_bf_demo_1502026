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

class HouseMasterController extends Controller
{   
    public function __construct(){
         $this->house     = new HouseMaster();
         $this->housetype = new HouseType();
         $this->employee  = new AemEmployee();
     }
    public function HouseMaster(Request $request)
    {
        if(isset($request->btn_save))
        {
            //dd($request);end;
            $HouseCode    = $request->txt_house_code;
            $HouseAddress = $request->txt_house_addr;
            $HouseType    = $request->cmb_house_type;
            $HouseStatus  = $request->txt_house_status;
            $Employeeno   = $request->txt_emp_no;
            $OccupiedOn   = $request->txt_occ_on;
            
            $rules = [
				'HouseCode' => 'required|max:20',
				'HouseAddress' => 'required|max:50',
                'HouseType' => 'required|max:10',
				'HouseStatus' => 'required|max:20',
                'Employeeno' => 'required|max:150',
				'OccupiedOn' => 'required|max:100',
                
			];
			$ValidateData = [
                'HouseCode' =>$HouseCode,
				'HouseAddress' => $HouseAddress,
                'HouseType' =>$HouseType,
				'HouseStatus' => $HouseStatus,
                'Employeeno' =>$Employeeno,
				'OccupiedOn' => $OccupiedOn,
                				
			];
            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($HouseCode == "HouseCode"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid House Name.";
                    }
                    if($HouseAddress == "HouseAddress"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid House Address.";
                    }
                    if($HouseType == "HouseType"){
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
                $SaveData['house_code'] = $HouseCode;
                $SaveData['house_address'] = $HouseAddress;
                $SaveData['house_type_id'] = $HouseType;
                $SaveData['house_status'] = $HouseStatus;
                $SaveData['emp_no'] = $Employeeno;
                $SaveData['occupied_on'] = $OccupiedOn;
                $SaveData['active'] = 1;
                $SaveData['created_at'] = NOW();
                $SaveData['created_by'] = session('WcmsEmpNo');
                
                $SaveHouse= $this->house->createHouseMaster($SaveData);
            
                DB::commit();
                $message = "House Master Data Saved ";
            }catch (\Exception $e) { dd($e);end;
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('HouseMaster.HouseMaster');
        }
        $HouseData=$this->house->ShowHouseMaster(null,null);
        $HouseType= $this->housetype->ShowHouseType();
        return view('house.house-master')->with('data', compact('HouseData','HouseType'));
    }
    public function HouseAllotment(Request $request)
    {
         if(isset($request->btn_save))
        {
            //dd($request);end;
            $HousList  = $request->cmb_house_list;
            $EmpName   = $request->cmb_emp_name;
            $AllotOn = $request->txt_allot_date;
            $OccupiedOn   = $request->txt_occ_date;
                      
            $rules = [
				'HousList' => 'required|max:50',
				'EmpName' => 'required|max:50',
                'AllotOn' => 'required|max:20',
				'OccupiedOn' => 'required|max:20',
                
			];
			$ValidateData = [
                'HousList' =>$HousList,
				'EmpName' => $EmpName,
                'AllotOn' =>$AllotOn,
				'OccupiedOn' => $OccupiedOn,
            				
			];
            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($HousList == "HousList"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid House List.";
                    }
                    if($EmpName == "EmpName"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid Emp Name.";
                    }
                    if($AllotOn == "AllotOn"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Allot Date.";
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
                return redirect()->route('HouseMaster.HouseAllotment');
            }
            DB::beginTransaction();
            try {
                
                $SaveData['emp_no']     = $EmpName;
                $SaveData['alloted_on'] = $AllotOn;
                $SaveData['occupied_on'] = $OccupiedOn;
                $SaveData['updated_at'] = NOW();
                $SaveData['updated_by'] = session('WcmsEmpNo');
                               
                $SaveHouse= $this->house->updateHouseMaster($SaveData,$HousList);
            
                DB::commit();
                $message = "House Master Data Saved ";
            }catch (\Exception $e) { dd($e);end;
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('HouseMaster.HouseAllotment');
        }
        $AllocateData=$this->house->ShowHouseMasterrForAllocate();
        $EmpData=$this->employee->ShowEmployeeForAllotment();
        $HouseData=$this->house->ShowHouseMaster(null,null);
        return view('house.house-allotment')->with('data', compact('AllocateData','EmpData','HouseData'));

    }
    public function HouseVacation(Request $request)
    {
         if(isset($request->btn_save))
        {
            //dd($request);end;
            $EmpNo       = $request->txt_emp_no;
            $HouseAddr   = $request->txt_house_addr;
            $HouseVacant = $request->txt_vacated_on;
           // dd($HouseVacant);
                                 
            $rules = [
				'EmpNo' => 'required|max:10',
				'HouseAddr' => 'required|max:50',
                'HouseVacant' => 'required|max:20',
			           
			];
			$ValidateData = [
                'EmpNo'     =>$EmpNo,
				'HouseAddr' => $HouseAddr,
                'HouseVacant' => $HouseVacant,
            				
			];
            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($EmpNo == "EmpNo"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Emp No.";
                    }
                    if($HouseAddr == "HouseAddr"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid House Address.";
                    }
                    if($HouseVacant == "HouseVacant"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid House Vacant.";
                    }
                    
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('house.house-vacation');
            }
            DB::beginTransaction();
            try {
                $SaveData['vacated_on'] = $HouseVacant;
                $SaveData['updated_at'] = NOW();
                $SaveData['updated_by'] = session('WcmsEmpNo');
                if($EmpNo != NULL){ 
                $SaveHouse= $this->house->updateHouseMaster($SaveData,$EmpNo);
                }
                DB::commit();
                $message = "House Master Data Saved ";
            }catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('house.house-vacation');
        }
        return view('house.house-vacation');

    }
    public function GetHouseData(Request $request){ 
        $HouseData = $this->house->ShowHouseMaster($request,$request->EmpNo);
        $OutputArr = array('HouseData' => $HouseData);
        return $OutputArr; 
    }
}
