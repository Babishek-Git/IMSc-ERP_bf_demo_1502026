<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\LeaveType;

use Helper;
use DB;
use Session;
class LeaveMasterController extends Controller
{
        public function __construct(){
         $this->leave  = new LeaveType();
        }
        public function LeaveMaster(Request $request)
        {
         if(isset($request->btn_save))
        {
          
            $LeaveCode      = $request->txt_leave_code;
            $LeaveName      = $request->txt_leave_name;
            $LeaveperYear   = $request->txt_lea_year;
            $LeaveperService= $request->txt_lea_ser;
            $IsDebit=False;

            if(isset($request->ch_is_debit)){
                $IsDebit= $request->ch_is_debit;
            }
            
            
            
            $rules = [
				'LeaveCode' => 'required|max:50',
				'LeaveName' => 'required|max:100',
                'LeaveperYear' => 'required|max:10',
				'LeaveperService' => 'required|max:25',
                                
			];
			$ValidateData = [
                'LeaveCode' =>$LeaveCode,
				'LeaveName' =>$LeaveName,
                'LeaveperYear' =>$LeaveperYear,
				'LeaveperService' => $LeaveperService,
                				
			];
            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($LeaveCode == "LeaveCode"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Leave Code.";
                    }
                    if($LeaveName == "LeaveName"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid Leave Name.";
                    }
                    if($LeaveperYear == "LeaveperYear"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid Leave per Year.";
                    }
                    if($LeaveperService == "LeaveperService"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid Leave per service.";
                    }
                    
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('LeaveMaster.LeaveMaster');
            }
            DB::beginTransaction();
            try {
                $SaveData['leave_type_code'] =   $LeaveCode;
                $SaveData['leave_type_name'] =   $LeaveName;
                $SaveData['tot_leave_per_year'] = $LeaveperYear;
                $SaveData['tot_leave_per_service'] = $LeaveperService;
                $SaveData['is_debt'] = $IsDebit;
                $SaveData['active'] = 1;
                $SaveData['created_at'] = NOW();
                
                $SaveLeave= $this->leave->createLeaveMaster($SaveData);
                
                DB::commit();
                $message = "Leave Master Data Saved Successfully";
            }catch (\Exception $e) {
            //dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('LeaveMaster.LeaveMaster');
        }
      
         $LeaveData=$this->leave->ShowLeaveType();
         //dd($LeaveData);
        return view('leave.leave-master.leave-master')->with('data', compact('LeaveData'));
     }
        //return view('LeaveMaster.LeaveMaster');//->with('data', compact('OrganizationList'));
}

