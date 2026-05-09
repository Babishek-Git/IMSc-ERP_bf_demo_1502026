<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\ProjectMaster;
use App\Models\AemEmployee;
use App\Models\ProjectStaff;
use App\Models\designation;
use App\Models\SubProjectMaster;
use Helper;
use DB;
use Session;
class ProjectMasterController extends Controller
{

    public function __construct(){
          $this->project  = new ProjectMaster();
          $this->employee = new AemEmployee();
          $this->ProjectStaff = new ProjectStaff();
          $this->desigination = new designation();
          $this->Subproject  = new SubProjectMaster();
    }
    public function ProjectHead(Request $request)
    {
        if(isset($request->btn_save))
        {
            // dd($request);
            $ProjectName = $request->cmb_pro_name;
            $ProjectHead = $request->cmb_pro_head;
                            
            $rules = [
                'ProjectName' => 'required|max:50',
                'ProjectHead' => 'required|max:50',
                    
            ];
            $ValidateData = [
                'ProjectName'     => $ProjectName,
                'ProjectHead'     => $ProjectHead,
                                
            ];
            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
            {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($ProjectName == "ProjectName"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Project Name.";
                    }
                    if($ProjectHead == "ProjectHead"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid Project Head.";
                    }
                                        
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('Project.project-head');
            }
                DB::beginTransaction();
            try {
                $SaveData['project_id'] = $ProjectName;
                $SaveData['emp_no']     = $ProjectHead;
                $SaveData['is_head']     = true;
                $SaveData['active']     = 1;
                $SaveData['created_at'] = NOW();
                $SaveProject= $this->ProjectStaff->createProjectHead($SaveData);
                            
                DB::commit();
                $message = "Project Head Master Data Saved Successfully";
            }catch (\Exception $e) {dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('Project.project-head');
        }
        $ProjectData     = $this->project->ShowProjectMaster(NULL); 
        $EmployeeData    = $this->employee->ShowEmployees(NULL,NULL);
        $ProjectHeadView = $this->ProjectStaff->ShowProjectHead();
        //dd($ProjectData);
        return view('project.project-head')->with('data',compact('ProjectData','EmployeeData','ProjectHeadView'));
    }
    public function SubProjectMaster(Request $request)
    {  
        if(isset($request->btn_save))
        {
            $SubProjectName        = $request->txt_sub_pro_name;
            $SubProjectDuration    = $request->txt_sub_pro_dur;
            $SubDurationMode       = $request->cmb_mode;
            $SubStartDate          = $request->sub_pro_start_date;
            $SubEndDate            = $request->sub_pro_end_date;
            $SubProjectId          = $request->cmb_main_pro_name;
            $ProjectId             = $request->hid_pro_id;
            //$ProjectType           = $request->rad_project_type;
              
            $rules = [
				'SubProjectName'       => 'required|max:500',
				'SubProjectDuration'   => 'required|max:5',
                'SubDurationMode'      => 'required',
				'SubStartDate'         => 'required|date_format:d/m/Y',
                'SubEndDate'           => 'required|date_format:d/m/Y',
                //'SubProjectType'       => 'required',
			];
			$ValidateData = [
                'SubProjectName'       => $SubProjectName,
				'SubProjectDuration'   => $SubProjectDuration,
                'SubDurationMode'      => $SubDurationMode,
				'SubStartDate'         => $SubStartDate,
                'SubEndDate'           => $SubEndDate,
                //'ProjectType'       => $ProjectType,				
			];
            $Validate   = Validator::make($ValidateData, $rules); 
            $ErrArr     = [];
            if($Validate->fails())
            {
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($ValidFieldName == "SubProjectName"){
                        $ErrArr[] = "Error : Invalid ProjectName.";
                    }
                    if($ValidFieldName == "SubProjectDuration"){
                        $ErrArr[] = "Error : Invalid Project Duration.";
                    }
                    if($ValidFieldName == "DurationMode"){
                        $ErrArr[] = "Error : Invalid Duration Mode.";
                    }
                    if($ValidFieldName == "StartDate"){
                        $ErrArr[] = "Error : Invalid Start Date.";
                    }
                    if($ValidFieldName == "EndDate"){
                        $ErrArr[] = "Error : Invalid Start Date.";
                    }
                   
                }
            }
        
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('Project.sub-project-master');
            }
            DB::beginTransaction();
            try {
                $SaveData['subproject_name']           = $SubProjectName;
                $SaveData['subproject_duration']       = $SubProjectDuration;
                $SaveData['project_duration_mode']     = $SubDurationMode;
                $SaveData['subproject_start_at']       = Helper::DBDateFormat($SubStartDate);
                $SaveData['subproject_end_at']         = Helper::DBDateFormat($SubEndDate);
                //$SaveData['project_type']           = $ProjectType;
                $SaveData['active']                   = 1;
                
                if($ProjectId != NULL){ 
                    $SaveData['updated_at']          = NOW();
                    $SaveData['updated_by']          = session('WcmsEmpNo');
                    $SaveProject= $this->Subproject->updateSubProjectMaster($SaveData,$ProjectId);
                }else{
                    $SaveData['created_at']          = NOW();
                    $SaveData['created_by']          = session('WcmsEmpNo'); 
                    $SaveProject= $this->Subproject->createSubProjectMaster($SaveData);
                }            
                DB::commit();
                $message = " SubProject Master Data Saved Successfully";
            }catch (\Exception $e) {dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('Project.sub-project-master');
        
        } 
        $EditSubProjectData = NULL;
        if(isset($request->id)) {
            try {
                $Action = decrypt($request->action);   
                $ProjectId = decrypt($request->id);  
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $data = "Error : Sorry Invalid Attempt";
                return redirect()->back();
            }
            if($Action == "EDIT"){
                $EditSubProjectData = $this->Subproject->ShowSubProjectMaster($ProjectId); 
            }
            if($Action == "DEL"){
                $SaveData['active'] = 0;
                if($ProjectId != NULL){
                    $SaveProject= $this->Subproject->updateSubProjectMaster($SaveData,$ProjectId);    
                }
            }
        } 
        $ProjectData = $this->project->ShowProjectMaster(null); 
        $SubProjectDataView = $this->Subproject->ShowSubProjectMaster(null); 

        return view('Project.sub-project-master')->with('data',compact('ProjectData','SubProjectDataView','EditSubProjectData'));
    }
    public function ProjectMaster(Request $request)
    {  
        if(isset($request->btn_save))
        {       //dd($request);
            $ProjectName        = $request->txt_pro_name;
            $ProjectDuration    = $request->txt_pro_dur;
            $DurationMode       = $request->cmb_mode;
            $StartDate          = $request->pro_start_date;
            $EndDate            = $request->pro_end_date;
            $ProjectId          = $request->hid_pro_id;
            $ProjectType        = $request->rad_project_type;
            $ProjectFor          = $request->rad_internal_type;
              //dd($ProjectTo);
            $rules = [
				'ProjectName'       => 'required|max:500',
				'ProjectDuration'   => 'required|max:5',
                'DurationMode'      => 'required',
				'StartDate'         => 'required|date_format:d/m/Y',
                'EndDate'           => 'required|date_format:d/m/Y',
                'ProjectType'       => 'required',
                'ProjectFor'         => 'required',
			];
			$ValidateData = [
                'ProjectName'       => $ProjectName,
				'ProjectDuration'   => $ProjectDuration,
                'DurationMode'      => $DurationMode,
				'StartDate'         => $StartDate,
                'EndDate'           => $EndDate,
                'ProjectType'       => $ProjectType,
                'ProjectFor'        => $ProjectFor,				
			];
            $Validate   = Validator::make($ValidateData, $rules); 
            $ErrArr     = [];
            if($Validate->fails())
             {
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($ValidFieldName == "ProjectName"){
                        $ErrArr[] = "Error : Invalid ProjectName.";
                    }
                    
                    if($ValidFieldName == "ProjectDuration"){
                        $ErrArr[] = "Error : Invalid Project Duration.";
                    }
                    if($ValidFieldName == "DurationMode"){
                        $ErrArr[] = "Error : Invalid Duration Mode.";
                    }
                    if($ValidFieldName == "StartDate"){
                        $ErrArr[] = "Error : Invalid Start Date.";
                    }
                    if($ValidFieldName == "EndDate"){
                        $ErrArr[] = "Error : Invalid Start Date.";
                    }
                    if($ProjectType == "EndDate"){
                        $ErrArr[] = "Error : Invalid Project Type.";
                    }
                    if($ProjectType == 'EXT'){
                        $ProjectTo = null;
}
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('Project.project-master');
            }
             DB::beginTransaction();
            try {
                $SaveData['project_name']           = $ProjectName;
                $SaveData['project_duration']       = $ProjectDuration;
                $SaveData['project_duration_mode']  = $DurationMode;
                $SaveData['project_start_at']       = Helper::DBDateFormat($StartDate);
                $SaveData['project_end_at']         = Helper::DBDateFormat($EndDate);
                $SaveData['project_type']           = $ProjectType;
                $SaveData['project_for']            = $ProjectFor;
                $SaveData['active']                 = 1;
                
                if($ProjectId != NULL){ 
                    $SaveData['updated_at']          = NOW();
                    $SaveData['updated_by']          = session('WcmsEmpNo');
                    $SaveProject= $this->project->updateProjectMaster($SaveData,$ProjectId);
                }else{
                    $SaveData['created_at']          = NOW();
                    $SaveData['created_by']          = session('WcmsEmpNo'); 
                    $SaveProject = $this->project->createProjectMaster($SaveData);
                }            
                DB::commit();
                $message = "Project Master Data Saved Successfully";
            }catch (\Exception $e) {dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('Project.project-master');
        }
        $EditProjectData = NULL;
        if(isset($request->id)) {
            try {
                $Action = decrypt($request->action);   
                $ProjectId = decrypt($request->id);  
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $data = "Error : Sorry Invalid Attempt";
                return redirect()->back();
            }
            if($Action == "EDIT"){
                $EditProjectData=$this->project->ShowProjectMaster($ProjectId); 
            }
            if($Action == "DEL"){
                $SaveData['active'] = 0;
                if($ProjectId != NULL){
                    $SaveProject= $this->project->updateProjectMaster($SaveData,$ProjectId);    
                }
            }
        }
        $ProjectDataView=$this->project->ShowProjectMaster(NULL);  
        return view('project.project-master')->with('data',compact('ProjectDataView','EditProjectData'));

    }
    public function ProjectStaff(Request $request){ 
         $ProjectDataView = $this->project->ShowProjectMaster(NULL);
         $EmployeeData    = $this->employee->ShowEmployees(NULL,NULL);
        // dd($EmployeeData);
        return view('project.project-staff')->with('data',compact('ProjectDataView','EmployeeData'));
    }
}


     
    




