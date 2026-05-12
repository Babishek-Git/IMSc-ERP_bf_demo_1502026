<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\DesignationMaster;
use App\Models\EmployeeGroupMaster;
use Helper;
use DB;
use Session;
class DesignationMasterController extends Controller
{

    public function __construct(){
            $this->Designation  = new DesignationMaster();
            $this->Group  = new EmployeeGroupMaster();
    }
    public function DesignationMaster(Request $request)
    {
     if(isset($request->btn_save))
        {
            
            $DesignationShortName= $request->txt_desig_shortname;
            $DesignationFullName = $request->txt_desig_name;
            $DesgId = $request->hid_desg_id;
            $GroupId = $request->cmb_emp_grp;       
            
            $rules = [
				
				'DesignationShortName' => 'required|max:250',
                'DesignationFullName' => 'required|max:250',
                
			];
			$ValidateData = [
                
				'DesignationShortName' => $DesignationShortName,
                'DesignationFullName' => $DesignationFullName,
                				
			];
            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($DesignationShortName == "DesignationShortName"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Designation Short Name.";
                    }
                    if($DesignationFullName == "DesignationFullName"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid Designation Full Name.";
                    }
                    
                    
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('DesignationMaster.DesignationMaster');
            }
            DB::beginTransaction();
            try {
               $SaveData['emp_group_id'] =   $GroupId;  
                $SaveData['designation_short_name'] =   $DesignationShortName;
                $SaveData['designation_name'] =   $DesignationFullName;
                $SaveData['active'] = 1;
                // $SaveData['created_at'] = NOW();
                if($DesgId != NULL){ 
                        $SaveData['updated_at'] = NOW();
                        $SaveData['updated_by'] = session('WcmsEmpNo');
                }else{
                        $SaveData['created_at'] = NOW();
                        $SaveData['created_by'] = session('WcmsEmpNo');
                }
                if($DesgId != NULL){ 
                    $SaveDesignation= $this->Designation->updateDesignationMaster($SaveData,$DesgId);
                }
                else{
                    $SaveDesignation= $this->Designation->createDesignationMaster($SaveData);
                }
                            
                DB::commit();
                $message = "Designation  Data Saved Successfully";
            }catch (\Exception $e) {
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('DesignationMaster.DesignationMaster');
        } 
        $EditDesignationData=NULL;
        if(isset($request->id)){ 
            try {
              
                $EditId = decrypt($request->id);  
                      
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $data = "Error : Sorry Invalid Attempt";
                return redirect()->back();
            }
            $EditDesignationData=$this->Designation->ShowDesignationMaster($EditId); 
            //return view('designation-master.designation-master')->with('data', compact('EmployeeData'));
        }
        
        //$OfficeData=$this->office->ShowOfficeMaster();
        $DesignationData=$this->Designation->ShowDesignationMaster(NULL);
        $GroupData = $this->Group->ShowEmployeeGroup(NULL);
        $EmpGroupData = $this->Designation->ShowDesignationWithGroup(NULL);
        return view('designation-master.designation-master')->with('data', compact('DesignationData','EditDesignationData','GroupData','EmpGroupData'));
    }
    public function ViewDesignationMaster(Request $request)
    {
        $DesignationData=$this->Designation->ShowDesignationMaster(NULL);
        return view('designation-master.view-designationmaster')->with('data', compact('DesignationData'));
    }
}
