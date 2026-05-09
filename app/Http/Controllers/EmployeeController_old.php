<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\AemEmployee;
use App\Models\AgmOffice;
use App\Models\DesignationMaster;
use App\Models\organization;
use App\Models\EmployeeCategory;
use App\Models\EmployeeSalute;
use App\Models\EmployeeMaritalStatus;
use App\Models\EmployeeGroupMaster;
use App\Models\Role;
use App\Models\PayComponent;
use App\Models\PayComponentRuleType;
use App\Models\PayLevel;
use App\Models\EmployeePayLevel;
use App\Models\EmployeePayComponent;
use App\Models\EmployeePayBank;
use App\Models\EmpFamilyDetails;
use App\Models\EmpFamilyMaster;
use App\Models\EmployeeInsurance;
use App\Models\AemBank;
use App\Models\EmpRelationshipMaster;
use App\Models\DependentMaster;
use App\Models\BankBranchMaster;
use App\Models\EmpEducationalDetails;
use App\Models\HouseMaster;
use App\Models\ProjectMaster;
use App\Models\SubProjectMaster;
use App\Models\ProjectStaff;
use App\Models\EmpDocuments;
use App\Models\DocumentsType;
use App\Models\FormFieldLabel;
use App\Models\UIConfig;
use App\Models\VisitorCatagory;
use App\Models\VisitorDetails;
use Helper;
use DB;
use Session;
use PDF;

class EmployeeController extends Controller
{   
    public function __construct(){ 
        $this->Employee = new AemEmployee();
        $this->Office = new AgmOffice();
        $this->desigination = new DesignationMaster();
        $this->organization = new organization();
        $this->EmployeeSalute = new EmployeeSalute();
        $this->EmployeeMaritalStatus = new EmployeeMaritalStatus();
        $this->Category = new EmployeeCategory();
        $this->EmployeeGroupMaster = new EmployeeGroupMaster();
        $this->role  = new Role();
        $this->PayLevel  = new PayLevel();
        $this->EmployeePayLevel  = new EmployeePayLevel();
        $this->EmployeePayComponent  = new EmployeePayComponent();
        $this->EmployeePayBank  = new EmployeePayBank();
        $this->empfamilydetails  = new EmpFamilyDetails();
        $this->insurance  = new EmployeeInsurance();
        $this->bankdetail  = new AemBank();
        $this->EmpRelationshipMaster = new EmpRelationshipMaster();
        $this->DependentMaster = new DependentMaster();
        $this->BankBranchMaster = new BankBranchMaster();
        $this->EmpEducationalDetails = new EmpEducationalDetails();
        $this->HouseMaster = new HouseMaster();
        $this->ProjectMaster = new ProjectMaster();
        $this->SubProjectMaster = new SubProjectMaster();
        $this->ProjectStaff = new ProjectStaff();
        $this->EmpDocuments = new EmpDocuments(); 
        $this->DocumentsType = new DocumentsType(); 
        $this->FormFieldLabel = new FormFieldLabel(); 
        $this->UIConfig = new UIConfig(); 
        $this->VisitorCatagory = new VisitorCatagory(); 
        $this->VisitorDetails = new VisitorDetails(); 
    }
    public function CreateEmployee(Request $request)
    {   
        if(isset($request->SaveDraft)){  
            $EmpNo = $request->txt_emp_icno;
            $ActiveTab = $request->txt_tab;
            if(($EmpNo != NULL)&&($ActiveTab != NULL)){
                /*if($ActiveTab == 0){
                    $this->SaveEmpBasicDetails($request);
                }else if($ActiveTab == 1){
                    $this->SaveEmpPayDetails($request);
                }else if($ActiveTab == 2){
                    $this->SaveEmpBankDetails($request);
                    $this->SaveEmpEducationalDetails($request);
                }else if($ActiveTab == 3){
                    $this->SaveEmpFamilyDetails($request);
                }else if($ActiveTab == 4){
                    $this->SaveEmpInsuranceDetails($request);
                }else if($ActiveTab == 5){
                    $this->SaveEmpDocumentDetails($request);
                    $this->SaveEmpPhysicallyChallangeDetails($request);
                }else{
                    $message = "Error : Invalid Access & Access Restricted"; 
                    Session::put('ALertMesage', $message);
                    return redirect()->route('employee.createEmployee');
                }*/
                $this->SaveEmpBasicDetails($request);
                // $this->SaveEmpPayDetails($request);
                $this->SaveEmpBankDetails($request);
                $this->SaveEmpEducationalDetails($request);
                $this->SaveEmpFamilyDetails($request);
                $this->SaveEmpInsuranceDetails($request);
                $this->SaveEmpPhotoDetails($request);
                $this->SaveEmpAadharDetails($request);
                $this->SaveEmpPanDetails($request);
                // $this->SaveEmpDocumentDetails($request);
                $this->SaveEmpPhysicallyChallangeDetails($request);
                $message = "Employee information saved successfully"; 
            }else{
                $message = "Error : Invalid ICNO & Check your ICNO"; 
            }
            //dd($message);
            Session::put('ALertMesage', $message); 
            return redirect()->route('employee.createEmployee');
        }
        $IsRegisterForm = 0;
        $EditEmpBasicData      =  NULL;
        $EditEmpBankData       =  NULL;
        $EditEmpEducationData  =  NULL;
        $EditEmpFamliyData     =  NULL;
        $EditLicEmpInsuranceData  =  NULL;
        $EditPliEmpInsuranceData  =  NULL;
        if(isset($request->id)){
            $Page = "EDIT_REG";
            $IsRegisterForm = 1;
            try {
                $EmpNo = decrypt($request->id);
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) { 
                $message = "Error : Sorry Invalid Attempt";
                Session::put('ALertMesage', $message);
                return redirect()->route('employee.view-employee-list');
            }
            $EditEmpBasicData     = $this->Employee->ShowEmployees($request,$EmpNo); 
            $EditEmpBankData      = $this->EmployeePayBank->employeePayBank($EmpNo); 
            $EditEmpEducationData = $this->EmpEducationalDetails->ShowEmployeeEducation($EmpNo);
            $EditEmpFamliyData    = $this->empfamilydetails->ShowFamilyDetails($request,$EmpNo); 
            $EditEmpInsuranceData = $this->insurance->ShowEmployeeInsurance($EmpNo);
            $EditLicEmpInsuranceData = collect($EditEmpInsuranceData)->where('policy_for','LIC');
            $EditPliEmpInsuranceData = collect($EditEmpInsuranceData)->where('policy_for','PLI');
            //dd($EditPliEmpInsuranceData);
            $EmpGroupId = $EditEmpBasicData->pluck('employee_group_type')->first(); 
        }
        if(isset($request->btn_initiate)){  
            $EmpGroupId = $request->rad_emp_group;
            $IsRegisterForm = 1;
            $Page = "NEW_REG";
        }
        if($IsRegisterForm == 1){ 
            $componentFilterArr = array("DEDU","EARN");
            $payComponents      = PayComponent::withType()->active()
                                    ->whereHas('componentType', function ($q) use ($componentFilterArr) {
                                    $q->whereIn('component_type_code', $componentFilterArr);
                                })
                                ->get();  
            $employeeGroupMaster= $this->EmployeeGroupMaster->ShowEmployeeGroup($EmpGroupId); 
            $officeList         = $this->Office->ShowOfficeWithGroup('G',$EmpGroupId); 
            //dd($officeList);  
            $desiginationList   = $this->desigination->ShowDesignationWithGroup($EmpGroupId);  
            $categoryList       = $this->Category->ShowEmployeeCategory(NULL);
            $showGrandParent    = $this->organization->ShowGrandParent($request); 
            $employeeSalute     = $this->EmployeeSalute->ShowSalute(NULL);
            $PayLevelData       = $this->PayLevel->getActive(NULL);
            //$RelationShipData   = $this->EmpRelationshipMaster->ShowRelatonship(NULL); 
            $DependentData      = $this->DependentMaster->ShowDependent(NULL);
            $EmpInsurData       = $this->insurance->ShowEmployeeInsurance(NULL);
            $IfscData           = $this->BankBranchMaster->ShowAllIfsc();
            $HouseMaster        = $this->HouseMaster->ShowVacantHouse(); 
            $ProjectMaster      = $this->ProjectMaster->ShowAllParentChild(NULL);
            $employeeMaritalStatus  = $this->EmployeeMaritalStatus->ShowMaritalStatus(NULL); 
            $fieldLabelLists    = $this->FormFieldLabel->getAllFieldLabel($EmpGroupId); 
            $UIConfigs          = $this->UIConfig->getAllUIConfig($EmpGroupId);
            $menuCodes          = $UIConfigs->pluck('menu_module_code')->toArray();
            $VisitorCatagory    = $this->VisitorCatagory->ShowVisitorCatagory();
            $FacultyLists       = $this->Employee->ShowEmployeeNames();
            $GuideLists         = $this->Employee->ShowEmployeeGuideNames(10);
            
            return view('employee.CreateEmployee')->with('data',compact('officeList','desiginationList','showGrandParent',
            'categoryList','employeeSalute','employeeMaritalStatus','employeeGroupMaster','payComponents','PayLevelData',
            'DependentData','EmpInsurData','IfscData','HouseMaster','ProjectMaster','fieldLabelLists',
            'menuCodes','VisitorCatagory','FacultyLists','EditEmpBasicData','EditEmpBankData','EditEmpEducationData','EditEmpFamliyData','EditLicEmpInsuranceData',
            'EditPliEmpInsuranceData','GuideLists'));  
        }  
        $employeeGroupMaster = collect($this->EmployeeGroupMaster->ShowEmployeeGroup(NULL))->groupBy('employment_type_code');
     
        return view('employee.EmployeeRegistrationInitiate')->with('data',compact('employeeGroupMaster'));  
    }

    public function SaveEmpBasicDetails($request){ 
        $EmpGroupType       = $request->cmb_employment_group;
        $employeeGroupMaster= $this->EmployeeGroupMaster->ShowEmployeeGroup($EmpGroupType);
        $EmploymentTypeCode = filled($employeeGroupMaster) ? collect($employeeGroupMaster)->pluck('employment_type_code')->first() : NULL;
        $EmpIcno            = $request->txt_emp_icno;
        $EmpSalute          = $request->cmb_emp_salute;
        $EmpFatherName       = $request->txt_emp_father_name;
        $EmpMotherName      = $request->txt_emp_mother_name;
        // if($EmpMiddleName == ''){
        //     $EmpMiddleName = NULL;
        // }
        // $EmpLastName        = $request->txt_emp_last_name;
        // if($EmpLastName == ''){
        //     $EmpLastName = NULL;
        // }
        $EmpPaySlipName     = $request->txt_payslip_name;
        $EmpGender          = $request->rad_gender;
        $EmpDesignation     = $request->cmb_designation;
        $EmpCasteCategory   = $request->cmb_category;
        $EmpMaritalStatus   = $request->cmb_marital_status;
        $EmpDob             = $request->txt_dob;
        $EmpDoj               = $request->txt_doj;
        $EmpDor               = $request->txt_date_retire;
        $EmpAddhaarNo         = $request->txt_aadhaar;
        $EmpPanNo             = $request->txt_pan_no;
        $EmpGroup             = $request->cmb_group;
        $EmpDivision          = $request->cmb_division;
        $EmpSection           = $request->cmb_section;
        $EmpIntercom          = $request->txt_intercom_no;
        $EmpMobile            = $request->txt_mobile;
        $EmpPassportNo        = $request->txt_passport_no;
        $EmpCountry           = $request->txt_country_name;
        $EmpNationality       = $request->cmb_nationality;
        $EmpHometown          = $request->txt_home_town;
        $Empproject           = $request->cmb_emp_project;
        $Empprojectguide      = $request->cmb_project_guide;
        $EmpprojectApplicable = $request->is_project_applicable;
        $PDForIPDF            = $request->cmb_pdforipdf;
        $SingleORdual         = $request->cmb_singleordual;
        $VisitorCatagory      = $request->cmb_visitor_catagory;
        $PermanentAddr        = $request->txt_perm_address;
        $PersonalMailId       = $request->txt_perm_mailid;
        $PersonalMobno        = $request->txt_perm_mobno;
        $EmpHometownState     = $request->txt_home_town_state;
        $EmpHometownRailway   = $request->txt_near_railway;
        $EmpHometownAddress   = $request->txt_addr_hometown;
        $EmpPresentAddress    = $request->txt_pers_address;
        $EmpOfficeMail        = $request->txt_office_mailid;
        $EmpBloodGroup        = $request->txt_blood_group;
        $EmpHeight            = $request->txt_height_measurement;
        $EmpIdentityMarks     = $request->txt_identification_marks;

        DB::beginTransaction();
        try {
            $CheckEmployee = $this->Employee->CheckEmployee($EmpIcno);
            $SaveData['ic_no']                          = $EmpIcno;
            $SaveData['emp_no']                         = $EmpIcno;
            $SaveData['emp_father_name']                = $EmpFatherName;
            $SaveData['emp_mother_name']                = $EmpMotherName;
           // $SaveData['emp_last_name']                  = $EmpLastName;
            $SaveData['emp_name_payslip']               = $EmpPaySlipName;
            $SaveData['employee_type']                  = NULL;//$Group;
            $SaveData['employee_group_type']            = $EmpGroupType;
            $SaveData['employment_type']                = $EmploymentTypeCode;//$MobNo;
            $SaveData['emp_dob']                        = $EmpDob ? Helper::DBDateFormat($EmpDob) : null;
            $SaveData['emp_doj']                        = $EmpDoj ? Helper::DBDateFormat($EmpDoj) : null;
            $SaveData['emp_retirement_dt']              = $EmpDor ? Helper::DBDateFormat($EmpDor) : null;
            $SaveData['group_id']                       = $EmpGroup;
            $SaveData['division_id']                    = $EmpDivision;
            $SaveData['section_id']                     = $EmpSection;
            $SaveData['emp_designation_id']             = $EmpDesignation;
            $SaveData['emp_gender']                     = $EmpGender;
            $SaveData['emp_category']                   = $EmpCasteCategory;
            $SaveData['emp_marital_status']             = $EmpMaritalStatus;
            $SaveData['emp_salute']                     = $EmpSalute;
            $SaveData['emp_off_ext_no']                 = $EmpIntercom;
            $SaveData['emp_mobile']                     = $EmpMobile;
            $SaveData['emp_off_email']                  = $EmpOfficeMail;
            $SaveData['emp_aadhaar_no']                 = $EmpAddhaarNo;
            $SaveData['emp_pan_no']                     = $EmpPanNo;
            $SaveData['emp_passport_no']                = $EmpPassportNo;
            $SaveData['emp_country']                    = $EmpCountry;
            $SaveData['emp_nationality']                = $EmpNationality;
            $SaveData['emp_hometown']                   = $EmpHometown;
            $SaveData['emp_main_project_id']            = $Empproject;
            $SaveData['emp_build_loc']                  = NULL;
            $SaveData['active']                         = 1;
            $SaveData['created_at']                     = NOW();
            $SaveData['created_by']                     = 1;  
            $SaveData['is_register']                    = 1; 
            $SaveData['is_project_applicable']          = $EmpprojectApplicable; 
            $SaveData['pdf_ipdf']                       = $PDForIPDF; 
            $SaveData['single_dual']                    = $SingleORdual; 
            $SaveData['visitor_catagory_id']            = $VisitorCatagory; 
            $SaveData['emp_permanent_addres']           = $PermanentAddr; 
            $SaveData['emp_personal_mail_id']           = $PersonalMailId; 
            $SaveData['emp_personal_mobile_no']         = $PersonalMobno; 
            $SaveData['emp_home_town_state']            = $EmpHometownState; 
            $SaveData['emp_home_town_address']          = $EmpHometownAddress; 
            $SaveData['emp_home_town_near_rail_station']= $EmpHometownRailway; 
            $SaveData['emp_address']                    = $EmpPresentAddress;  
            $SaveData['emp_blood_group']                = $EmpBloodGroup;  
            $SaveData['emp_height']                     = $EmpHeight;  
            $SaveData['emp_identity_mark']              = $EmpIdentityMarks;  

            if(filled($CheckEmployee)){
                $SaveEmployee = $this->Employee->UpdateEmployee($SaveData,$EmpIcno);
               
            }else{
                $SaveEmployee = $this->Employee->CreateEmployee($SaveData);
               // dd($SaveEmployee);
            }
            if($request->filled('cmb_project')){ 
                $CheckEmployee = $this->ProjectStaff->CheckProjectStaff($EmpIcno,$request->cmb_project);
                if($CheckEmployee->isEmpty()){
                    $projectSaveData['project_id']      = $request->cmb_emp_project;
                    $projectSaveData['emp_no']          = $EmpIcno;
                    $projectSaveData['emp_group_id']    = $EmpGroup;
                    $projectSaveData['active']          = 1;
                    $projectSaveData['created_at']      = NOW();
                    $projectSaveData['created_by']      = session('WcmsEmpNo'); 
                    $SaveProject= $this->ProjectStaff->createProjectHead($projectSaveData);
                }
            }
            if($request->filled('cmb_visitor_catagory')){ 
                $visitorFromDate     = $request->txt_visit_from_date;
                $visitorToDate       = $request->txt_visit_to_date;

                $visitorSaveData['visitor_catagory_id'] = $request->cmb_visitor_catagory;
                $visitorSaveData['visitor_emp_no']      = $EmpIcno;
                $visitorSaveData['visitor_institue']    = $request->txt_visitor_institue;
                $visitorSaveData['visitor_purpose']     = $request->txt_visitor_purpose;
                $visitorSaveData['inviting_faculty_id'] = $request->cmb_inviting_faculty_id;
                $visitorSaveData['visit_from_date']     = $visitorFromDate ? Helper::DBDateFormat($visitorFromDate) : null;
                $visitorSaveData['visit_to_date']       = $visitorToDate ? Helper::DBDateFormat($visitorToDate) : null;
                $visitorSaveData['active']              = 1;
                $visitorSaveData['creat$ed_at']         = NOW();
                $visitorSaveData['created_by']          = session('WcmsEmpNo'); 
                $SaveVisitor= $this->VisitorDetails->createVisitor($visitorSaveData);
            }
            DB::commit();
            $message = "Employee Basic Details Saved Successfully";
        }catch (\Exception $e) { dd($e);
            DB::rollback();
            $message = "Error : Sorry transaction not fully completed";
            Session::put('ALertMesage', $message); 
            return redirect()->route('employee.createEmployee');
        }
        //Session::put('ALertMesage', $message); 
        //return redirect()->route('employee.createEmployee');
    }
 
    public function SaveEmpPayDetails($request){  
        $EmpIcno            = $request->txt_emp_icno;
        if($request->filled('cmb_pay_level')) {
            $EmpPayLevel    = $request->cmb_pay_level;
        }else{
            $EmpPayLevel    = NULL;
        }
        $EmpBasicPay        = $request->txt_basic_pay;
        if($request->filled('txt_next_incr_dt')) {
            $EmpNextIncrDate    = Helper::DBDateFormat($request->txt_next_incr_dt);
        }else{
            $EmpNextIncrDate    = NULL;
        }
        $EmpPayComponentArr = $request->input('ch_pay_components');
        
        DB::beginTransaction();
        try {
            $SaveData = [];
            $this->EmployeePayLevel->deleteEmployeePayLevel($EmpIcno);
            $SaveData['emp_no']             = $EmpIcno;
            $SaveData['pay_level']          = $EmpPayLevel;
            $SaveData['basic_salary']       = $EmpBasicPay;
            $SaveData['next_increment_dt']  = $EmpNextIncrDate;
            $SaveData['is_current']         = true;
            $SaveData['active']             = 1;
            $SaveData['created_at']         = NOW();
            $SaveData['created_by']         =session('WcmsEmpNo'); 
            $SaveEmpPayLevel = $this->EmployeePayLevel->createEmployeeCurrentPayLevel($SaveData);
            $StatutoryArr = [];
            $this->EmployeePayComponent->deleteEmployeePayComonent($EmpIcno);
            if(filled($EmpPayComponentArr)){
                foreach($EmpPayComponentArr as $EmpPayComponentKey => $EmpPayComponentValue){
                    $SaveData = [];
                    $SaveData['emp_no']             = $EmpIcno;
                    $SaveData['component_id']       = $EmpPayComponentKey;
                    $SaveData['is_current']         = true;
                    $SaveData['active']             = 1;
                    $SaveData['created_at']         = NOW();
                    $SaveData['created_by']         = session('WcmsEmpNo'); 
                    $SaveEmpPayComponent = $this->EmployeePayComponent->createEmployeePayComonent($SaveData);
                    $StatutoryArr[] = $EmpPayComponentValue;
                }
            }
            $SaveStatutoryArr = [];
            if(in_array("GPF", $StatutoryArr)){
                $SaveStatutoryArr['is_pf_applicable']   = true;
                $SaveStatutoryArr['pf_number']          = $request->txt_pf_no;
            }else{
                $SaveStatutoryArr['is_pf_applicable']   = NULL;
            }
            if(in_array("ESI", $StatutoryArr)){
                $SaveStatutoryArr['is_esi_applicable']  = true;
                $SaveStatutoryArr['esi_number']         = $request->txt_esi_no;
            }else{
                $SaveStatutoryArr['is_esi_applicable']   = NULL;
            }
            if(in_array("NPS", $StatutoryArr)){
                $SaveStatutoryArr['is_nps_applicable']  = true;
                $SaveStatutoryArr['pran_number']        = $request->txt_pran_no;
            }else{
                $SaveStatutoryArr['is_nps_applicable']   = NULL;
            }
            //if($request->has(['txt_house_no', 'txt_occupied_date'])) {
            if ($request->filled('txt_house_no') && $request->filled('txt_occupied_date')){
                $HouseId    = $request->txt_house_no;
                $OccupiedDate = $request->txt_occupied_date;
                $HouseOccupyArr['emp_no']       = $EmpIcno;
                $HouseOccupyArr['occupied_on']  = $OccupiedDate ? Helper::DBDateFormat($OccupiedDate) : null; 
                $this->HouseMaster->updateOccupation($HouseOccupyArr,$HouseId); //dd($HouseOccupyArr);
            }
            $SaveEmpStatuArr = $this->Employee->UpdateEmployee($SaveStatutoryArr,$EmpIcno);
            DB::commit();
            $message = "Employee Pay Details Saved Successfully";
        }catch (\Exception $e) { dd($e);
            DB::rollback();
            $message = "Error : Sorry transaction not fully completed";
            // Session::put('ALertMesage', $message); 
            // return redirect()->route('employee.create-pay');
        }
        Session::put('ALertMesage', $message); 
        return redirect()->route('employee.view-pay');
    }

    public function SaveEmpBankDetails($request){ 
        $EmpIcno        = $request->txt_emp_icno;
        $EmpAccHoldName = $request->txt_acc_holder_name;
        $EmpAccountNo   = $request->txt_account_no;
        $EmpIfscCode    = $request->txt_ifsc_code;
        $EmpBank        = $request->txt_bank_id;
        $EmpBankBranch  = $request->txt_branch_id;
        if(($EmpAccountNo != NULL)&&($EmpBank != NULL)){
            DB::beginTransaction();
            try {
                $this->EmployeePayBank->deleteEmployeePayBank($EmpIcno);
                $SaveData = [];
                $SaveData['emp_no']             = $EmpIcno;
                $SaveData['bank_id']            = $EmpBank;
                $SaveData['branch_id']          = $EmpBankBranch;
                $SaveData['account_no']         = $EmpAccountNo;
                $SaveData['is_current']         = true;
                $SaveData['account_holder_name']= $EmpAccHoldName;
                $SaveData['active']             = 1;
                $SaveData['created_at']         = NOW();
                $SaveData['created_by']         = 1; 
                $SaveEmpBank = $this->EmployeePayBank->createEmployeePayBank($SaveData);
                DB::commit();
                $message = "Employee Bank Details Saved Successfully";
            }catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
                Session::put('ALertMesage', $message); 
                return redirect()->route('employee.createEmployee');
            }
            //Session::put('ALertMesage', $message); 
            //return redirect()->route('employee.createEmployee');
        }
    }
    public function SaveEmpEducationalDetails($request){ 
        $EducationLevelArr  = $request->input('txt_education_level_id');
        if(filled($EducationLevelArr)){
            $QualificationArr   = $request->input('txt_qualification');
            $InstituteArr       = $request->input('txt_institute_name');
            $UniversityArr      = $request->input('txt_university_name');
            $YearPassingArr     = $request->input('txt_year_passing');
            $StudyModeArr       = $request->input('txt_study_mode_id');
            $ErrArr             = [];
            DB::beginTransaction();
            try {
                $this->EmpEducationalDetails->DeleteEmpEducationDetails($request->txt_emp_icno);
                foreach($EducationLevelArr as $EducationLevelKey => $EducationLevel){
                    $Qualification  = $QualificationArr[$EducationLevelKey];
                    $Institute      = $InstituteArr[$EducationLevelKey];
                    $University     = $UniversityArr[$EducationLevelKey];
                    $YearOfPassing  = $YearPassingArr[$EducationLevelKey];
                    $StudyMode      = $StudyModeArr[$EducationLevelKey];

                    $SaveData = [];
                    $SaveData['emp_no']             = $request->txt_emp_icno;
                    $SaveData['education_level']    = $EducationLevel;
                    $SaveData['qualification']      = $Qualification;
                    $SaveData['institute_name']     = $Institute;
                    $SaveData['board_university']   = $University;
                    $SaveData['year_passing']       = $YearOfPassing;
                    $SaveData['study_mode']         = $StudyMode;
                    $SaveData['active']             = 1;
                    $SaveData['created_at']         = NOW();
                    $SaveData['created_by']         = session('WcmsEmpNo'); 
                    $SaveValues = $this->EmpEducationalDetails->CreateEmpEducationDetails($SaveData); 
                }
                DB::commit();
                $message = "Educational Details Saved Successfully";
            }
            catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry Details not Saved";
                Session::put('ALertMesage', $message); 
                return redirect()->route('employee.createEmployee');
            }
        }
        //Session::put('ALertMesage', $message);
        //return redirect()->route('employee.createEmployee');
    }

    public function SaveEmpPhysicallyChallangeDetails($request){ 
        $EmpIcno                = $request->txt_emp_icno;
        $EmpPhyHandicapped      = $request->rad_phy_handicapped;
        if($EmpPhyHandicapped != NULL){
            $EmpPhyHandicappPerc    = $request->txt_phy_handicapp_perc;
            if(($EmpPhyHandicapped == "SELF")||($EmpPhyHandicapped == "DEPEND")){
                $IsEmpPhyHandicapped = true;
                $EmpPhyHandicappedStr = $EmpPhyHandicapped;
            }else{
                $IsEmpPhyHandicapped  = false;
                $EmpPhyHandicappedStr = NULL;
            }
            
            DB::beginTransaction();
            try {
                $SaveData = [];
                $SaveData['is_phy_challange']   = $IsEmpPhyHandicapped;
                $SaveData['phy_challange_type'] = $EmpPhyHandicappedStr;
                $SaveData['phy_challange_perc'] = $EmpPhyHandicappPerc;
                $SaveEmpDiablityArr = $this->Employee->UpdateEmployee($SaveData,$EmpIcno);
                DB::commit();
                $message = "Employee Physically Challange Details Saved Successfully";
            }catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
                Session::put('ALertMesage', $message); 
                return redirect()->route('employee.createEmployee');
            }
            //Session::put('ALertMesage', $message); 
            //return redirect()->route('employee.createEmployee');
        }
    }
    // public function SaveEmpDocumentDetails($request){ 
    //     $EmpPhoto       = $request->file('file_emp_photo');
    //     $EmpAadhaar     = $request->file_emp_aadhaar;
    //     $EmpPhEmpPan    = $request->file_emp_pan;
    //     $EmpIcno        = $request->txt_emp_icno;
    //     $UploadExe = 0;

    //     $validator1 = Validator::make(
    //         $request->all(),
    //         [
    //             'file_emp_photo' => 'required|mimes:jpg,jpeg,png|max:2048', // max:2048 specifies the maximum size in kilobytes (2MB)
    //         ],
    //         [
    //             'file_emp_photo.required' => 'Error: Please select the  employee photo.',
    //             'file_emp_photo.mimes' => 'Error: Only jpg,jpeg,png files are allowed.',
    //             'file_emp_photo.max' => 'Error: The file size must be within 2MB.',
    //         ]
    //     );
    //     if($validator1->fails()) { 
    //         $message = $validator1->errors()->first(); 
    //         Session::put('ALertMesage', $message); 
    //         //return redirect()->route('employee.createEmployee');
    //     }

    //     $message = NULL;
    //     $OrgFileName = $EmpPhoto->getClientOriginalName();
    //     $Extension   = $EmpPhoto->getClientOriginalExtension();

    //     $UploadTimeStr = date("YmdHis");
    //     $FileType = $EmpPhoto->getClientOriginalExtension();
    //     $FileName = "emp_".$EmpIcno."_photo_supp_doc_".$UploadTimeStr.".".$FileType; //dd($FileName);
    //     $IsUpload = NULL;
    //     try {
    //         if($EmpPhoto) {
    //             $IsUpload = Helper::UploadFile($EmpPhoto,$FileName,'PHOTO','SUPDOC');
    //         }else{
    //             $IsUpload = 'UE';
    //         }
    //     }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
    //         $IsUpload = 'UE';
    //     }
    //     if($IsUpload == "Y"){
    //         $UploadExe++;
    //     }
       
    //     if($UploadExe > 0){
    //         DB::beginTransaction();
    //         try {
    //             $DocumentTypeData = $this->DocumentsType->ShowDocumentTypeByCode('PHOTO'); 
    //             //dd($DocumentTypeData);
    //             $DocumentTypeId = NULL;
    //             if(filled($DocumentTypeData)){
    //                 $DocumentTypeId = collect($DocumentTypeData)->pluck('document_type_id')->first();
    //             }
    //            // dd($DocumentTypeId);
    //             $SaveData['emp_document_type_id']   = $DocumentTypeId;
    //             $SaveData['doc_file_name']          = $FileName;
    //             $SaveData['doc_file_name_actual']   = $OrgFileName;
    //             $SaveData['active']                 = 1;
    //             $SaveData['emp_no']                 = $EmpIcno;
    //             $SaveData['created_at']             = NOW();
    //             $SaveData['created_by']             = session('WcmsEmpNo');
    //             $SaveEmployee= $this->EmpDocuments->createDocuments($SaveData);
    //             DB::commit();
    //             $message = "Document Uploaded Successfully";
                
    //         }catch (\Exception $e){ dd($e); 
    //             DB::rollback();
    //             $message = "Error : Sorry transaction not fully completed";
    //         }
          
    //     }
  
    // }
     public function SaveEmpPhotoDetails($request){ 
        if($request->hasfile('file_emp_photo')){
            $EmpPhoto       = $request->file('file_emp_photo');
            $EmpIcno        = $request->txt_emp_icno;
            $UploadExe = 0;

            $validator1 = Validator::make(
                $request->all(),
                [
                    'file_emp_photo' => 'required|mimes:jpg,jpeg,png|max:2048', // max:2048 specifies the maximum size in kilobytes (2MB)
                ],
                [
                    'file_emp_photo.required' => 'Error: Please select the  employee photo.',
                    'file_emp_photo.mimes' => 'Error: Only jpg,jpeg,png files are allowed.',
                    'file_emp_photo.max' => 'Error: The file size must be within 2MB.',
                ]
            );
            if($validator1->fails()) { 
                $message = $validator1->errors()->first(); 
                Session::put('ALertMesage', $message); 
                //return redirect()->route('employee.createEmployee');
            }

            $message = NULL;
            $OrgFileName = $EmpPhoto->getClientOriginalName();
            $Extension   = $EmpPhoto->getClientOriginalExtension();

            $UploadTimeStr = date("YmdHis");
            $FileType = $EmpPhoto->getClientOriginalExtension();
            $FileName = "emp_".$EmpIcno."_photo_supp_doc_".$UploadTimeStr.".".$FileType; //dd($FileName);
            $IsUpload = NULL;
            try {
                if($EmpPhoto) {
                    $IsUpload = Helper::UploadFile($EmpPhoto,$FileName,'PHOTO','SUPDOC');
                }else{
                    $IsUpload = 'UE';
                }
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $IsUpload = 'UE';
            }
            if($IsUpload == "Y"){
                $UploadExe++;
            }
        
            if($UploadExe > 0){
                DB::beginTransaction();
                try {
                
                    $DocumentTypeData = $this->DocumentsType->ShowDocumentTypeByCode('PHOTO'); 
                    $DocumentTypeId = NULL;
                    if(filled($DocumentTypeData)){
                        $DocumentTypeId = collect($DocumentTypeData)->pluck('document_type_id')->first();
                    }
                
                    $this->EmpDocuments->DeleteDocuments($EmpIcno,$DocumentTypeId);
                    $SaveData['emp_document_type_id']   = $DocumentTypeId;
                    $SaveData['doc_file_name']          = $FileName;
                    $SaveData['doc_file_name_actual']   = $OrgFileName;
                    $SaveData['active']                 = 1;
                    $SaveData['emp_no']                 = $EmpIcno;
                    $SaveData['created_at']             = NOW();
                    $SaveData['created_by']             = session('WcmsEmpNo');
                    $SaveEmployee= $this->EmpDocuments->createDocuments($SaveData);
                    DB::commit();
                    $message = "Document Uploaded Successfully";
                    
                }catch (\Exception $e){ dd($e); 
                    DB::rollback();
                    $message = "Error : Sorry transaction not fully completed";
                }
            
            }
        }
  
    }
    public function SaveEmpAadharDetails($request){
        if($request->hasfile('file_emp_aadhaar')){
            $EmpAadhaar    = $request->file('file_emp_aadhaar');
            $EmpIcno       = $request->txt_emp_icno;
            $UploadExe = 0;

            $validator1 = Validator::make(
                $request->all(),
                [
                    'file_emp_aadhaar' => 'required|mimes:jpg,jpeg,png|max:2048', // max:2048 specifies the maximum size in kilobytes (2MB)
                ],
                [
                    'file_emp_aadhaar.required' => 'Error: Please select the  employee aadhar.',
                    'file_emp_aadhaar.mimes' => 'Error: Only jpg,jpeg,png files are allowed.',
                    'file_emp_aadhaar.max' => 'Error: The file size must be within 2MB.',
                ]
            );
            if($validator1->fails()) { 
                $message = $validator1->errors()->first(); 
                Session::put('ALertMesage', $message); 
                //return redirect()->route('employee.createEmployee');
            }

            $message = NULL;
            $OrgFileName = $EmpAadhaar->getClientOriginalName();
            $Extension   = $EmpAadhaar->getClientOriginalExtension();

            $UploadTimeStr = date("YmdHis");
            $FileType = $EmpAadhaar->getClientOriginalExtension();
            $FileName = "emp_".$EmpIcno."_aadhar_supp_doc_".$UploadTimeStr.".".$FileType; //dd($FileName);
            $IsUpload = NULL;
            try {
                if($EmpAadhaar) {
                    $IsUpload = Helper::UploadFile($EmpAadhaar,$FileName,'AADHAAR','SUPDOC');
                }else{
                    $IsUpload = 'UE';
                }
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $IsUpload = 'UE';
            }
            if($IsUpload == "Y"){
                $UploadExe++;
            }
        
            if($UploadExe > 0){
                DB::beginTransaction();
                try {
                    $DocumentTypeData = $this->DocumentsType->ShowDocumentTypeByCode('AADHAAR'); 
                    $DocumentTypeId = NULL;
                    if(filled($DocumentTypeData)){
                        $DocumentTypeId = collect($DocumentTypeData)->pluck('document_type_id')->first();
                    }
                $this->EmpDocuments->DeleteDocuments($EmpIcno,$DocumentTypeId);
                    $SaveData['emp_document_type_id']   = $DocumentTypeId;
                    $SaveData['doc_file_name']          = $FileName;
                    $SaveData['doc_file_name_actual']   = $OrgFileName;
                    $SaveData['active']                 = 1;
                    $SaveData['emp_no']                 = $EmpIcno;
                    $SaveData['created_at']             = NOW();
                    $SaveData['created_by']             = session('WcmsEmpNo');
                    $SaveEmployee= $this->EmpDocuments->createDocuments($SaveData);
                    DB::commit();
                    $message = "Document Uploaded Successfully";
                    
                }catch (\Exception $e){ dd($e); 
                    DB::rollback();
                    $message = "Error : Sorry transaction not fully completed";
                }
            
            }
        }
    }
        public function SaveEmpPanDetails($request){
        if($request->hasfile('file_emp_pan')){
            $EmpPan    = $request->file('file_emp_pan');
            $EmpIcno  = $request->txt_emp_icno;
            $UploadExe = 0;

            $validator1 = Validator::make(
                $request->all(),
                [
                    'file_emp_pan' => 'required|mimes:jpg,jpeg,png|max:2048', // max:2048 specifies the maximum size in kilobytes (2MB)
                ],
                [
                    'file_emp_pan.required' => 'Error: Please select the  employee pan.',
                    'file_emp_pan.mimes' => 'Error: Only jpg,jpeg,png files are allowed.',
                    'file_emp_pan.max' => 'Error: The file size must be within 2MB.',
                ]
            );
            if($validator1->fails()) { 
                $message = $validator1->errors()->first(); 
                Session::put('ALertMesage', $message); 
                //return redirect()->route('employee.createEmployee');
            }

            $message = NULL;
            $OrgFileName = $EmpPan->getClientOriginalName();
            $Extension   = $EmpPan->getClientOriginalExtension();

            $UploadTimeStr = date("YmdHis");
            $FileType = $EmpPan->getClientOriginalExtension();
            $FileName = "emp_".$EmpIcno."_pan_supp_doc_".$UploadTimeStr.".".$FileType; //dd($FileName);
            $IsUpload = NULL;
            try {
                if($EmpPan) {
                    $IsUpload = Helper::UploadFile($EmpPan,$FileName,'PAN','SUPDOC');
                }else{
                    $IsUpload = 'UE';
                }
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $IsUpload = 'UE';
            }
            if($IsUpload == "Y"){
                $UploadExe++;
            }
        
            if($UploadExe > 0){
                DB::beginTransaction();
                try {
                    $DocumentTypeData = $this->DocumentsType->ShowDocumentTypeByCode('PAN'); 
                    $DocumentTypeId = NULL;
                    if(filled($DocumentTypeData)){
                        $DocumentTypeId = collect($DocumentTypeData)->pluck('document_type_id')->first();
                    }
                $this->EmpDocuments->DeleteDocuments($EmpIcno,$DocumentTypeId);
                    $SaveData['emp_document_type_id']   = $DocumentTypeId;
                    $SaveData['doc_file_name']          = $FileName;
                    $SaveData['doc_file_name_actual']   = $OrgFileName;
                    $SaveData['active']                 = 1;
                    $SaveData['emp_no']                 = $EmpIcno;
                    $SaveData['created_at']             = NOW();
                    $SaveData['created_by']             = session('WcmsEmpNo');
                    $SaveEmployee= $this->EmpDocuments->createDocuments($SaveData);
                    DB::commit();
                    $message = "Document Uploaded Successfully";
                    
                }catch (\Exception $e){ dd($e); 
                    DB::rollback();
                    $message = "Error : Sorry transaction not fully completed";
                }
            
            }
        }
    }
    public function SaveEmpFamilyDetails($request){ //dd($request);
        $DependentIdArr             = $request->input('hid_dependant_id');
        if(filled($DependentIdArr)){
            $ReleationShipIdArr     = $request->input('txt_relationship');
            $RelationIndexArr        = $request->input('txt_index');
            $RelationNameArr        = $request->input('txt_rel_name');
            $RelationDobArr         = $request->input('txt_dob_rel');  
            $RelationAadharArr      = $request->input('txt_aadhar_rel');  
            $RelationIncomeArr      = $request->input('txt_income_rel');  
            $RelationBloodgroupArr  = $request->input('txt_blood_group_rel');  
            $RelationIsnominee   = $request->input('rad_is_nominee');
            $ErrArr         = []; 
            DB::beginTransaction();
            try {
                $this->empfamilydetails->DeleteEmpFamilyDetails($request->txt_emp_icno);
                foreach($DependentIdArr as $DependentIdKey => $DependentId){
                    $RelationshipId  = $ReleationShipIdArr[$DependentIdKey];
                    $RelationName    = $RelationNameArr[$DependentIdKey];
                    $RelationDob     = $RelationDobArr[$DependentIdKey];
                    $RelationAadhar  = $RelationAadharArr[$DependentIdKey];
                    $RelationIncome  = $RelationIncomeArr[$DependentIdKey];
                    $RelationBloodgroup  = $RelationBloodgroupArr[$DependentIdKey];
                    $RelationIndex  = $RelationIndexArr[$DependentIdKey];
                    //$RelationIsnominee = $RelationIsnomineeArr[$DependentIdKey] ?? 'No';
                    if($RelationIndex == $RelationIsnominee){
                        $IsNominee = 'YES';
                    }else{
                        $IsNominee = NULL;
                    }
                    
                    $SaveData = [];
                    $SaveData['emp_no']                 = $request->txt_emp_icno;
                    $SaveData['fam_member_name']        = $RelationName;
                    $SaveData['fam_relationship_id']    = $RelationshipId;
                    $SaveData['fam_member_dob']         = $RelationDob ? Helper::DBDateFormat($RelationDob) : null;
                    $SaveData['fam_member_aadhar']      = $RelationAadhar;
                    $SaveData['fam_income_amount']      = $RelationIncome;
                    $SaveData['fam_member_blood_group'] = $RelationBloodgroup;
                    $SaveData['is_nominee']         = $IsNominee;
                    $SaveData['active']             = 1;
                    $SaveData['created_at']         = NOW();
                    $SaveData['created_by']         = session('WcmsEmpNo'); 
                    $SaveValues = $this->empfamilydetails->CreateFamilyDetails($SaveData); 
                    //print_r($SaveData);  echo "<br/>";echo $RelationIndex." = ".$RelationIsnominee." = ".$IsNominee; echo "<br/>"; echo "<br/>"; echo "<br/>";
                }
                //dd(123);
                DB::commit();
                $message = "Family Details Saved Successfully"; 
            }
            catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry Details not Saved";
                Session::put('ALertMesage', $message); 
                return redirect()->route('employee.createEmployee');
            }
            //Session::put('ALertMesage', $message);
            return redirect()->route('employee.createEmployee');
        }
    }
    public function SaveEmpInsuranceDetails($request){ 
        $LicPoicyHolderNameArr  = $request->input('txt_lic_pol_hold_name');
        if(filled($LicPoicyHolderNameArr)){
            $PolicyNoArr         = $request->input('txt_lic_pol_no');
            $PremiumAmountArr    = $request->input('txt_lic_premium_amt');  
            $DateOfExpiryArr     = $request->input('txt_lic_date_of_expiry');;
            $ErrArr         = [];
            DB::beginTransaction();
            try {
                $this->insurance->DeleteEmpInsuranceDetails($request->txt_emp_icno,'LIC');
                foreach($LicPoicyHolderNameArr as $PoicyHolderNameKey => $PoicyHolderName){
                    $PolicyNo       = $PolicyNoArr[$PoicyHolderNameKey];
                    $PremiumAmount  = $PremiumAmountArr[$PoicyHolderNameKey];
                    $DateOfExpiry   = $DateOfExpiryArr[$PoicyHolderNameKey];
                    $SaveData = [];
                    $SaveData['emp_no']             = $request->txt_emp_icno;
                    $SaveData['policy_holder_name'] = $PoicyHolderName;
                    $SaveData['policy_for']         = 'LIC';
                    $SaveData['policy_no']          = $PolicyNo;
                    $SaveData['premium_amount']     = $PremiumAmount;
                    $SaveData['expiry_date']        = Helper::DBDateFormat($DateOfExpiry);
                    $SaveData['active']             = 1;
                    $SaveData['created_at']         = NOW();
                    $SaveData['created_by']         = session('WcmsEmpNo');
                    $SaveValues = $this->insurance->CreateEmployeeInsurance($SaveData); 
                }
                DB::commit();
                $message = "LIC Insurance Details Saved Successfully";
            }
            catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry Details not Saved";
                Session::put('ALertMesage', $message); 
                return redirect()->route('employee.createEmployee');
            }
        }

        $PliPoicyHolderNameArr  = $request->input('txt_pli_pol_hold_name');
        if(filled($PliPoicyHolderNameArr)){
            $PolicyNoArr         = $request->input('txt_pli_pol_no');
            $PremiumAmountArr    = $request->input('txt_pli_premium_amt');;  
            $DateOfExpiryArr     = $request->input('txt_pli_date_of_expiry');;
            $ErrArr         = [];
            DB::beginTransaction();
            try {
                $this->insurance->DeleteEmpInsuranceDetails($request->txt_emp_icno,'PLI');
                foreach($PliPoicyHolderNameArr as $PoicyHolderNameKey => $PoicyHolderName){
                    $PolicyNo       = $PolicyNoArr[$PoicyHolderNameKey];
                    $PremiumAmount  = $PremiumAmountArr[$PoicyHolderNameKey];
                    $DateOfExpiry   = $DateOfExpiryArr[$PoicyHolderNameKey];
                    $SaveData = [];
                    $SaveData['emp_no']             = $request->txt_emp_icno;
                    $SaveData['policy_holder_name'] = $PoicyHolderName;
                    $SaveData['policy_for']         = 'PLI';
                    $SaveData['policy_no']          = $PolicyNo;
                    $SaveData['premium_amount']     = $PremiumAmount;
                    $SaveData['expiry_date']        = Helper::DBDateFormat($DateOfExpiry);
                    $SaveData['active']             = 1;
                    $SaveData['created_at']         = NOW();
                    $SaveData['created_by']         = session('WcmsEmpNo');
                    $SaveValues = $this->insurance->CreateEmployeeInsurance($SaveData); 
                }
                DB::commit();
                $message = "Postal Insurance Details Saved Successfully";
            }
            catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry Details not Saved";
                Session::put('ALertMesage', $message); 
                return redirect()->route('employee.createEmployee');
            }
        }
        //Session::put('ALertMesage', $message);
        //return redirect()->route('employee.createEmployee');
    }

    public function GetEmployeeRoles(Request $request){ 
        $EmpData = $this->Employee->ShowEmployees($request,$request->EmpNo); 
        $Office = AgmOffice::with('AllParentOffice')->where('head',$request->EmpNo)->get(); 
        $OfficeArr = array();
        foreach($Office as $OfficeRow){
            $TempArr = array(); $TempArr2 = array();
            //$Oro = $OfficeRow->remove('all_parent_office');
            $TempArr[$OfficeRow->office_type] = $OfficeRow;//->office_name;
            if($OfficeRow->AllParentOffice){
                $Lev1 =  $OfficeRow->AllParentOffice; 
            }else{
                $Lev1 = NULL;
            }
            while(count($Lev1) > 0){ 
                foreach($Lev1 as $Lev1Data){ 
                    $TempArr[$Lev1Data->office_type] = $Lev1Data;
                    if($Lev1Data->AllParentOffice){
                        $Lev2 = $Lev1Data->AllParentOffice;
                    }else{
                        $Lev2 = NULL;
                    }
                }
                $Lev1 = $Lev2;
            }
            if(count($TempArr) > 0){
                $OfficeArr[] = $TempArr;
            }
        }
        $RoleData = $this->role->ShowRoles($request,NULL); 
        $OutputArr = array('OfficeData'=>$OfficeArr, 'RoleData' => $RoleData, 'EmpData' => $EmpData);
        return $OutputArr;
    }
    public function GetEmployeeData(Request $request){ 
        $EmpData = $this->Employee->ShowEmployees($request,$request->EmpNo);
       // dd($EmpData);
        $BankDetail = $this->bankdetail->ShowBankDetails($request,$request->EmpNo);
        //$SectionId = collect($EmpData)->pluck('section_id')->first();
        $GroupId = collect($EmpData)->pluck('group_id')->first();
        $GroupRoleData = $this->role->ShowRoleListByGroup($GroupId); 
        $FamilyData = $this->empfamilydetails->ShowFamilyDetails($request,$request->EmpNo);
        $OutputArr = array('EmpData' => $EmpData, 'GroupRoleData' => $GroupRoleData, 'BankDetail' => $BankDetail, 'FamilyData' => $FamilyData);
        return $OutputArr; 
    }
    public function CreateBankDetail(Request $request)
    {   
        return view('employee.createEmployee')->with('data',compact('Empdata')); //EL Encashment along with LTC Request
    }

    public function ViewPay(Request $request)
    {   
        $RegEmpData = $this->Employee->showRegisteredEmp(null,null); 

        return view('employee.ViewPay')->with('data',compact('RegEmpData'));
    }

    public function CreatePay(Request $request)
    {   
        $PayLevelData       = $this->PayLevel->getActive(NULL);
        $RegEmpData         = $this->Employee->showRegisteredEmp(null,decrypt($request->id))->first();
        $employeeGroupMaster= $this->EmployeeGroupMaster->ShowEmployeeGroup($RegEmpData->employee_group_type);
        $paydetail          = $this->EmployeePayLevel->showEmployeeCurrentPayLevel(decrypt($request->id));
        $UIConfigs          = $this->UIConfig->getAllUIConfig($RegEmpData->employee_group_type);
        $menuCodes          = $UIConfigs->pluck('menu_module_code')->toArray();
        $componentFilterArr = array("DEDU","EARN");
        $payComponents = PayComponent::withType()->active()
            ->whereHas('componentType', function ($q) use ($componentFilterArr) {
                $q->whereIn('component_type_code', $componentFilterArr);
            })->get(); 
        $desiginationList   = $this->desigination->ShowDesignationWithGroup($RegEmpData->employee_group_type);  
        $categoryList       = $this->Category->ShowEmployeeCategory(NULL);
        if($request->btn_save){ 
            $this->SaveEmpPayDetails($request);
        }else{
            $message = "Error : Invalid Submission"; 
        }
        return view('employee.CreatePay')->with('data',compact('RegEmpData','PayLevelData','payComponents','employeeGroupMaster',
        'desiginationList','categoryList','paydetail','UIConfigs','menuCodes'));
    }
    public function ViewEmployeeList(Request $request)
    { 
        $Empdata = $this->Employee->ShowEmployees(null,null);
        return view('employee.view-employee-list')->with('data',compact('Empdata'));; 
    }
   public function ViewProfile(Request $request)
    { 
        $componentFilterArr = array("DEDU","EARN");
        $payComponents      = PayComponent::withType()->active()
                                ->whereHas('componentType', function ($q) use ($componentFilterArr) {
                                $q->whereIn('component_type_code', $componentFilterArr);
                            })
                            ->get();  
        $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo();
        $EmpNo = $Empdata->pluck('emp_no')->first(); 
        $EditEmpBasicData     = $this->Employee->ShowEmployees($request,$EmpNo); 
        $EditEmpBankData      = $this->EmployeePayBank->employeePayBank($EmpNo); 
        $EditEmpEducationData = $this->EmpEducationalDetails->ShowEmployeeEducation($EmpNo);
        $EditEmpFamliyData    = $this->empfamilydetails->ShowFamilyDetails($request,$EmpNo); 
        $EditEmpInsuranceData = $this->insurance->ShowEmployeeInsurance($EmpNo);
        $EditLicEmpInsuranceData = collect($EditEmpInsuranceData)->where('policy_for','LIC');
        $EditPliEmpInsuranceData = collect($EditEmpInsuranceData)->where('policy_for','PLI');
        //dd($EditPliEmpInsuranceData);
        $EmpGroupId = $EditEmpBasicData->pluck('employee_group_type')->first();
       
        $employeeGroupMaster= $this->EmployeeGroupMaster->ShowEmployeeGroup($EmpGroupId); 
        $officeList         = $this->Office->ShowOfficeWithGroup('G',$EmpGroupId); 
        //dd($officeList);  
        $desiginationList   = $this->desigination->ShowDesignationWithGroup($EmpGroupId);  
        $categoryList       = $this->Category->ShowEmployeeCategory(NULL);
        $showGrandParent    = $this->organization->ShowGrandParent($request); 
        $employeeSalute     = $this->EmployeeSalute->ShowSalute(NULL);
        $PayLevelData       = $this->PayLevel->getActive(NULL);
        //$RelationShipData   = $this->EmpRelationshipMaster->ShowRelatonship(NULL); 
        $DependentData      = $this->DependentMaster->ShowDependent(NULL);
        $EmpInsurData       = $this->insurance->ShowEmployeeInsurance(NULL);
        $IfscData           = $this->BankBranchMaster->ShowAllIfsc();
        $HouseMaster        = $this->HouseMaster->ShowVacantHouse(); 
        $ProjectMaster      = $this->ProjectMaster->ShowAllParentChild(NULL);
        $employeeMaritalStatus  = $this->EmployeeMaritalStatus->ShowMaritalStatus(NULL); 
        $fieldLabelLists    = $this->FormFieldLabel->getAllFieldLabel($EmpGroupId);
        $UIConfigs          = $this->UIConfig->getAllUIConfig($EmpGroupId);
        $menuCodes          = $UIConfigs->pluck('menu_module_code')->toArray();
        $VisitorCatagory    = $this->VisitorCatagory->ShowVisitorCatagory();
        $FacultyLists       = $this->Employee->ShowEmployeeNames();
        return view('employee.view-profile')->with('data',compact('officeList','desiginationList','showGrandParent',
            'categoryList','employeeSalute','employeeMaritalStatus','employeeGroupMaster','payComponents','PayLevelData',
            'DependentData','EmpInsurData','IfscData','HouseMaster','ProjectMaster','fieldLabelLists',
            'menuCodes','VisitorCatagory','FacultyLists','EditEmpBasicData','EditEmpBankData','EditEmpEducationData','EditEmpFamliyData','EditLicEmpInsuranceData','EditPliEmpInsuranceData')); 
        
    }

    public function ExportEmployeePdf(Request $request)
    { 
        $EmpData = $this->Employee->ShowEmployees(null,null); 
        $data = ['EmpData'=>$EmpData];
        $pdf = PDF::loadView('employee.export-employee-pdf', $data);
        return $pdf->download('Employee_List.pdf');
    }

}
