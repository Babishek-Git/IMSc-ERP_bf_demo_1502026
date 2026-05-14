<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\EmployeeType;
use App\Models\EmployeeGroupMaster;
use App\Models\EmploymentType;
use Helper;
use DB;
use Session;
class EmployeeGroupController extends Controller
{
     public function __construct(){
        $this->empgroupdata  = new EmployeeGroupMaster();
        $this->employeetype  = new EmployeeType();  
        $this->employmenttype= new EmploymentType();       

    }
    public function EmployeeGroupMaster (Request $request)
    {
        if(isset($request->btn_save))
        {
           // dd($request);
            $EmployeeTypeName = $request->cmb_emp_type;
            $EmploymentTypeName = $request->cmb_employ_type;
            $GroupCode = $request->txt_group_code;
            $GroupName = $request->txt_group_name;
            $PortalAccess = NULL;
            $GrpId = $request->hid_grp_id;

            if(isset($request->ch_portal_access)){
                $PortalAccess= $request->ch_portal_access;
            }
            //$PortalAccess = $request->ch_portal_access;
        
                                   
            $rules = [
				'EmployeeTypeName' => 'required|max:50',
                'EmploymentTypeName' => 'required|max:5',
                'GroupCode' => 'required|max:10',
				'GroupName' => 'required|max:50',
               
			];
			$ValidateData = [
                'EmployeeTypeName' =>$EmployeeTypeName,
                'EmploymentTypeName'=>$EmploymentTypeName,
                'GroupCode'        =>$GroupCode,
				'GroupName'        => $GroupName,
                             				
			];
            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($EmployeeTypeName == "EmployeeTypeName"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Employee Type Name.";
                    }
                    if($EmploymentTypeName == "EmploymentTypeName"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Employment Type Name.";
                    }
                    if($GroupCode == "GroupCode"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Group Code.";
                    }
                    if($GroupName == "GroupName"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid Group Name.";
                    }                                           
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('EmployeeGroup.EmployeeGroupMaster');
                // return redirect()->route('employee-group.employee-group');
            }
            DB::beginTransaction();
            try {
                $SaveData['emp_type_code'] = $EmployeeTypeName;
                $SaveData['employment_type_code'] = $EmploymentTypeName;
                $SaveData['emp_group_code'] = $GroupCode;
                $SaveData['emp_group_name'] = $GroupName;
                $SaveData['active'] = 1;
                $SaveData['created_at'] = NOW();
                $SaveData['created_by'] = session('WcmsEmpNo');
                $SaveData['portal_access'] = $PortalAccess;
                
                if($GrpId != NULL){ 
                    $SaveGroup= $this->empgroupdata->updateEmployeeGroup($SaveData,$GrpId);
                }
                else{
                     $SaveGroup= $this->empgroupdata->createEmployeeGroup($SaveData);
                }
                //dd($SaveGroup);
                           
                DB::commit();
                $message = "Group Master  Data Saved ";
            }catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message); 
            return redirect()->route('EmployeeGroup.EmployeeGroupMaster');
            // return redirect()->route('employee-group.employee-group');
        }
        $EditGroupData=NULL;
        if(isset($request->id)){ 
            try {
              
                $EditId = decrypt($request->id); 
                      
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $data = "Error : Sorry Invalid Attempt";
                return redirect()->back();
            }
            $EditGroupData=$this->empgroupdata->ShowEmployeeGroup($EditId); 
            //return view('EmployeeType.EmployeeType')->with('data', compact('EmployeeData'));
        }
        $EmployeeData=$this->employeetype->ShowEmployeeType(NULL);
        $EmploymentData=$this->employmenttype->ShowEmploymentType();
        $EmpgroupData=$this->empgroupdata->ShowEmployeeGroup(NULL);

        return view('employee-group.employee-group')->with('data', compact('EmployeeData','EmploymentData','EmpgroupData','EditGroupData'));
    }
}
