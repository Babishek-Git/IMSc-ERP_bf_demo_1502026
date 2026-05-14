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
use App\Models\BankMaster;
use App\Models\EmpRelationshipMaster;
use App\Models\EmpFamilyDetails;
use App\Models\EmpDocuments;
use App\Models\DocumentsType;
use App\Models\EmpChangeRequest;
use App\Models\HouseMaster;
use App\Models\LtcAdvances;
use App\Models\DependentMaster;
use App\Models\AemBank;
use App\Models\BankBranchMaster;
use App\Models\CeaReimbursementDeatil;
use App\Models\ReimbursementMaster;
use App\Models\ReimbursementType;
use App\Models\CpfWithdraw;
use App\Models\CpfAllowance;
use App\Models\EmployeePayLevel;
use App\Models\LtcAdvanceDetails;
use App\Models\LeaveType;
use App\Models\LeaveApplicationDt;
use App\Models\WorkFlowMovement;
use App\Models\WorkFlow;


use App\Services\WorkFlowProcessService;
use Helper;
use DB;
use Session;
use Carbon\Carbon;
use PDF;

class ChangeLTCAdvClaimController extends Controller
{   
    public function __construct(
        WorkFlowProcessService $WorkFlowService,
    ){ 
        $this->Employee = new AemEmployee();
        $this->Office = new AgmOffice();
        $this->desigination = new DesignationMaster();
        $this->organization = new organization();
        $this->EmployeeSalute = new EmployeeSalute();
        $this->EmployeeMaritalStatus = new EmployeeMaritalStatus();
        $this->Category = new EmployeeCategory();
        $this->EmployeeGroupMaster = new EmployeeGroupMaster();
        $this->role  = new Role();
        $this->bank  = new BankMaster();
        $this->relationshipMas  = new EmpRelationshipMaster();
        $this->familydetails  = new EmpFamilyDetails();
        $this->EmpDocuments = new EmpDocuments(); 
        $this->DocumentsType = new DocumentsType(); 
        $this->ChangeRequest = new EmpChangeRequest(); 
        $this->House = new HouseMaster(); 
        $this->LtcAdv = new LtcAdvances(); 
        $this->DependentMaster = new DependentMaster();
        $this->bankdetail  = new AemBank();
        $this->BankBranch  = new BankBranchMaster();
        $this->ReimbursementDetail  = new CeaReimbursementDeatil();
        $this->Reimbursement  = new ReimbursementMaster();
        $this->ReimbursementType  = new ReimbursementType();
        $this->CpfWithdraw  = new CpfWithdraw();
        $this->CpfAllowance  = new CpfAllowance();
        $this->PayLevel  = new EmployeePayLevel();
        $this->LtcAdvDetails = new LtcAdvanceDetails(); 
        $this->leavetype = new LeaveType(); 
        $this->LeaveApplied = new LeaveApplicationDt();
        $this->WorkFlowMovementDet = new WorkFlowMovement();
        $this->ModuleWorkFlow      = new WorkFlow();
        $this->WorkFlowService = $WorkFlowService;
    }

    public function CheckLTCLeaveApply(Request $request)
    {
        $empNo      = $request->emp_no;
        $travelData = $request->travel;
        if (!is_array($travelData)) {
            return response()->json(['applied' => false]);
        }

        foreach ($travelData as $travel) {
            $from = $travel['from_date'] ?? null;
            $to   = $travel['to_date'] ?? null;

            if (empty($from) || empty($to)) {
                return response()->json(['applied' => false]);
            }

            $fromDate = Carbon::createFromFormat('d/m/Y', $from)->format('Y-m-d');
            $toDate   = Carbon::createFromFormat('d/m/Y', $to)->format('Y-m-d');

            $exists = $this->LeaveApplied->CheckLTCAppliedLeave($fromDate,$toDate,$empNo);

            if (!$exists && $exists->isEmpty()) {
                return response()->json(['applied' => false]);
            }else{
                return response()->json(['applied' => true]);
            }
        }
    }
    
    public function EmpChangeLTCReqSelfService(Request $request)
    {  
        $EditClaimData = NULL;
        $LtcAdvData = NULL;
        $Page = "REQ_APPLY";
        $message = NULL;
        $Leaveexits = NULL;
        $selectedFamilyIds = [];
        if(isset($request->id)){ 
            try {
                $EditId = decrypt($request->id); 
                $Page   = decrypt($request->Page);
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $data = "Error : Sorry Invalid Attempt";
                return redirect()->back();
            }
            $EditClaimData = $this->LtcAdv->ShowLtcRequest(NULL,$EditId); 
            $LtcAdvId      = !empty($EditClaimData->application_no) ? explode(',', $EditClaimData->application_no) : [];
	        $LtcAdvData    = $this->LtcAdvDetails->GetLtcAdvDetails($LtcAdvId);
            foreach ($LtcAdvData as $travel) {
                $from       = $travel['departure_dt'] ?? null;
                $to         = $travel['arraival_dt'] ?? null;
                $Leaveexits = $this->LeaveApplied->CheckLTCAppliedLeave($from,$to,$EditClaimData->emp_no);
            }
            $selectedFamilyIds = [];
            if (!empty($EditClaimData->family_ids)) {
                $selectedFamilyIds = explode(',', $EditClaimData->family_ids);
            }
        }
        if(isset($request->btn_save)) {

            $EmpNo            = $request->txt_emp_icno;
            $SpouseEmployed   = $request->rad_spouse_employed;
            $EntitledLTC      = $request->rad_entitle_LTC;
            $VisitingHome     = $request->rad_visiting;
            $YearLTC          = $request->year_ltc;
            $Visitedindia     = $request->rad_india;
            $PlaceVisited     = $request->place_visited;
            $totalAdvAmount   = $request->total_adv_amount ?: null;
            $sanctioned       = $request->total_90_percent ?: null;
            $leaveenhance     = $request->rad_leaveenhance;
            $ElDays           = $request->el_days;

            $checkeFamilydIds = $request->chk_cout_rel ?? [];
            $FamilyIds        = !empty($checkeFamilydIds) ? implode(',', $checkeFamilydIds) : null;

            $AdvanceAmountArr = $request->input('txt_adv_amount');
            $DepatureDtArr    = $request->input('txt_departure_dt');
            $DepatureTimeArr  = $request->input('txt_departure_time');
            $DepatureFromArr  = $request->input('txt_departure_from');
            $ArraivalDtArr    = $request->input('txt_arraival_dt');
            $ArraivalTimeArr  = $request->input('txt_arraival_time');
            $ArraivalFromArr  = $request->input('txt_arraival_from');
            $DistanceArr      = $request->input('txt_distance');
            $TravelModeArr    = $request->input('cmb_travel_mode');
            $AccomodUsedArr   = $request->input('txt_accomod_used');
            $NoOfFaresArr     = $request->input('txt_no_of_amount');
            $DetailIdsArr     = $request->input('detail_id') ?? [];
            DB::beginTransaction();
            try {
                $SaveArr = [];
                $SaveArr['emp_no']            = $EmpNo;
                $SaveArr['spouse_employed']   = $SpouseEmployed;
                $SaveArr['entitle_ltc']       = $EntitledLTC;
                $SaveArr['visiting_home']     = $VisitingHome;
                $SaveArr['year_ltc']          = $YearLTC;
                $SaveArr['visiting_india']    = $Visitedindia;
                $SaveArr['place_visited']     = $PlaceVisited;
                $SaveArr['advance_amount']    = $totalAdvAmount;
                $SaveArr['sanctioned_amount'] = $sanctioned;
                $SaveArr['module_code']       = 'LTCADV';
                $SaveArr['active']            = 1;
                $SaveArr['family_ids']        = $FamilyIds;
                $SaveArr['leave_enhancement'] = $leaveenhance;
                $SaveArr['el_days']           = $ElDays;
                if ($sanctioned) {
                    $SaveArr['sanctioned_by'] = session('WcmsEmpNo');
                    $SaveArr['sanctioned_at'] = now();
                }
                if (!empty($request->id)) {
                    $EditId = decrypt($request->id);
                    $this->LtcAdv->updateLtcAdvance($EditId, $SaveArr);
                    $MasterId = $EditId;
                }else {
                    $SaveArr['status']     = 'pending';
                    $SaveArr['created_at'] = now();
                    $SaveArr['created_by'] = session('WcmsEmpNo');
                    $SaveLtcAdv = $this->LtcAdv->createLtcAdvances($SaveArr);
                    $MasterId = $SaveLtcAdv->ltc_advance_id;
                }
                $LtcadvIds = [];
                foreach ($DepatureDtArr as $key => $DepatureDt) {
                    $SaveData = [];
                    $SaveData['emp_no']         = $EmpNo;
                    $SaveData['departure_dt']   = !empty($DepatureDt) ? Helper::DBDateFormat($DepatureDt) : null;
                    $SaveData['departure_time'] = $DepatureTimeArr[$key] ?? null;
                    $SaveData['departure_from'] = $DepatureFromArr[$key] ?? null;
                    $SaveData['arraival_dt']    = !empty($ArraivalDtArr[$key]) ? Helper::DBDateFormat($ArraivalDtArr[$key]) : null;
                    $SaveData['arraival_time']  = $ArraivalTimeArr[$key] ?? null;
                    $SaveData['arraival_from']  = $ArraivalFromArr[$key] ?? null;
                    $SaveData['distance']       = $DistanceArr[$key] ?? null;
                    $SaveData['travel_mode']    = $TravelModeArr[$key] ?? null;
                    $SaveData['accomod_used']   = $AccomodUsedArr[$key] ?? null;
                    $SaveData['no_of_fares']    = $NoOfFaresArr[$key] ?? null;
                    $SaveData['advance_amount'] = $AdvanceAmountArr[$key] ?? null;
                    if (!empty($DetailIdsArr[$key])) {
                        $SaveData['updated_at'] = now();
                        $SaveData['updated_by'] = session('WcmsEmpNo');
                        $this->LtcAdvDetails->updateLtcAdvDetails($DetailIdsArr[$key], $SaveData);
                        $LtcadvIds[] = $DetailIdsArr[$key];
                    }else {
                        $SaveData['ltc_advance_id'] = $MasterId;
                        $SaveData['active']         = 1;
                        $SaveData['created_at']     = now();
                        $SaveData['created_by']     = session('WcmsEmpNo');
                        $SaveValues = $this->LtcAdvDetails->CreateLtcAdvDetails($SaveData);
                        $LtcadvIds[] = $SaveValues->ltc_detail_id;
                    }
                }

                if (!empty($LtcadvIds)) {
                    $this->LtcAdv->UpdateAdvances($MasterId, implode(',', $LtcadvIds));
                }
                DB::commit();
                Session::put('ALertMesage', 'LTC Advance Details Saved Successfully');
                if($EmpNo != session('WcmsEmpNo')){
                    return redirect()->route('change-request.ltc-adv-change-request-pending-list');
                }else{
                    return redirect()->route('change-request.ltc-adv-change-request-list');
                }
                

            } catch (\Exception $e) {
                DB::rollback();
                dd($e);
                Session::put('ALertMesage', 'Error: Sorry Details not Saved');
                return redirect()->route('change-request.ltc-adv-change-request');
            }
        }

        if(isset($request->id)){
            $Empdata       = $this->Employee->ShowEmployees($request,$EditClaimData->emp_no);
            $Payleveldata  = $this->PayLevel->ShowEmployeePayLevelByEmpno($EditClaimData->emp_no); 
            $Familydata    = $this->familydetails->ShowFamilyDetailsByEmpNo($EditClaimData->emp_no); 
            $existingFamilyIds = $this->LtcAdv->where('emp_no', $EditClaimData->emp_no)
                                ->whereBetween('created_at', [date('Y') . '-01-01 00:00:00',date('Y') . '-12-31 23:59:59'
                                ])->pluck('family_ids')->toArray();
        }else{
            $Empdata       = $this->Employee->ShowEmployeeBySessionEmpNo();
            $Payleveldata  = $this->PayLevel->ShowEmployeePayLevelByEmpno(session('WcmsEmpNo')); 
            $Familydata    = $this->familydetails->ShowFamilyDetailsByEmpNo(session('WcmsEmpNo')); 
            $existingFamilyIds = $this->LtcAdv->where('emp_no', session('WcmsEmpNo'))
                                ->whereBetween('created_at', [date('Y') . '-01-01 00:00:00',date('Y') . '-12-31 23:59:59'
                                ])->pluck('family_ids')->toArray();
            
        }
        $LeaveTypeData = $this->leavetype->ShowLeaveType();
    
        return view('change-request.ltcadvclaim.emp-ltc-adv-change-request')->with('data',compact('Empdata','EditClaimData',
            'Page','Payleveldata','Familydata','LtcAdvData','LeaveTypeData','Leaveexits','selectedFamilyIds','existingFamilyIds'));
    } 

    public function EmpChangeLTCReqSelfServiceList(){
        $Page        = 'REQ_APPLY'; 
        $EmpNo       = session('WcmsEmpNo'); 
        $LTCData     = $this->LtcAdv->ShowEmpAppiledLtcAdv(NULL,$EmpNo,'LTCADV');

        return view('change-request.ltcadvclaim.emp-ltc-adv-change-request-list')->with('data', compact('LTCData','Page'));
    }
    public function EmpChangeLTCReqPendingList(){
        $Page        = 'REQ_PROCESS'; 
        $EmpNo       = session('WcmsEmpNo'); 
        $LTCData     = $this->LtcAdv->ShowEmpAppiledLtcAdv(NULL,NULL,'LTCADV'); 
        
        return view('change-request.ltcadvclaim.emp-ltc-adv-change-request-list')->with('data', compact('LTCData','Page'));
    }

    public function EmpChangeLTCReqProcess(Request $request)
    {  
        if(isset($request->SubmitApplication)){
            try {
                $TransactionId = decrypt($request->txt_application_id);
                $ModuleCode = decrypt($request->wf_module_code);
                $PageAction = decrypt($request->txt_action);
                $Page = decrypt($request->txt_page);
                
                $WorkFlowMode   = $request->txt_wf_mode;
                $ActualEmpNo    = $request->txt_actual_emp;
                $WorkFlowRemark = $request->txt_wf_remark;
                $WorkFlowEmpNo  = $request->txt_wf_emp_no;
                $WorkFlowRole   = $request->txt_wf_role;
                $WorkFlowAction = $request->txt_wf_action;
                $RolePosition = $request->txt_role_position;
                
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) { 
                $message = "Error : Sorry Invalid Attempt";
                Session::put('ALertMesage', $message);
                if($Page == "REQ_PROCESS"){
                    return redirect()->route('change-request.ltc-adv-change-request-pending-list');
                }else{
                    return redirect()->route('change-request.ltc-adv-change-request-list');
                }
            }
            $sanctionedAmt = $request->total_90_percent ?? null;

            if (!empty($sanctionedAmt)) {
                $advId = decrypt($request->Application);
                $this->LtcAdv->updateSanctionedAmount($advId, $sanctionedAmt);
            }

            if(($request->SubmitApplication == 'RJ')||($request->SubmitApplication == 'AP')){
                $WorkFlowData = (object)['TransactionId'=>$TransactionId,'WflowModule'=>$ModuleCode,'WorkFlowMode'=>$WorkFlowMode,'ActualEmpNo'=>NULL,'WorkFlowRemark'=>$WorkFlowRemark,'WorkFlowEmpNo'=>NULL,'WorkFlowRole'=>NULL,'WorkFlowAction'=>$request->SubmitApplication,'RolePosition'=>NULL,'SubModule'=>'LTC_REQ'];
            }else{
                $WorkFlowData = (object)['TransactionId'=>$TransactionId,'WflowModule'=>$ModuleCode,'WorkFlowMode'=>$WorkFlowMode,'ActualEmpNo'=>$ActualEmpNo,'WorkFlowRemark'=>$WorkFlowRemark,'WorkFlowEmpNo'=>$WorkFlowEmpNo,'WorkFlowRole'=>$WorkFlowRole,'WorkFlowAction'=>$WorkFlowAction,'RolePosition'=>$RolePosition,'SubModule'=>'LTC_REQ'];
            }
            $WorkFlowMessage = $this->WorkFlowService->WorkFlowMovementProcess(
                $TransactionId,
                $ModuleCode,
                $WorkFlowData
            );
            Session::put('ALertMesage', $WorkFlowMessage);
            if($Page == "REQ_PROCESS"){
                return redirect()->route('change-request.ltc-adv-change-request-pending-list');
            }else{
                return redirect()->route('change-request.ltc-adv-change-request-list');
            }
        }

        $EditClaimData     =NULL; 
        $Page              =NULL;
        $LtcAdvData        =NULL;
        $Leaveexits        =NULL;
        $selectedFamilyIds = [];
        if(isset($request->Application)){ 
            try {
                $ApplicationId = decrypt($request->Application); 
                $Page   = decrypt($request->Page);
                $Action = decrypt($request->action);
                if($Action != 'REQ_PROCESS'){
                    $message = "Error : Sorry Invalid Attempt";
                    Session::put('ALertMesage', $message);
                    if($Page == "REQ_PROCESS"){
                        return redirect()->route('change-request.ltc-adv-change-request-pending-list');
                    }else{
                        return redirect()->route('change-request.ltc-adv-change-request-list');
                    }
                }
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) { 
                $data = "Error : Sorry Invalid Attempt";
                return redirect()->back();
            }
            
        }
       
        $EditClaimData = $this->LtcAdv->ShowLtcRequest(NULL,$ApplicationId); 
        $EmpNo         = $EditClaimData->emp_no;
        $LtcAdvId      = !empty($EditClaimData->application_no) ? explode(',', $EditClaimData->application_no) : [];
        $LtcAdvData    = $this->LtcAdvDetails->GetLtcAdvDetails($LtcAdvId);
        foreach ($LtcAdvData as $travel) {
            $from       = $travel['departure_dt'] ?? null;
            $to         = $travel['arraival_dt'] ?? null;
            $Leaveexits = $this->LeaveApplied->CheckLTCAppliedLeave($from,$to,$EmpNo);
        }
        $selectedFamilyIds = [];
        if (!empty($EditClaimData->family_ids)) {
            $selectedFamilyIds = explode(',', $EditClaimData->family_ids);
        }
        $Empdata       = $this->Employee->ShowEmployees($request,$EmpNo);
        $Payleveldata  = $this->PayLevel->ShowEmployeePayLevelByEmpno($EmpNo); 
        $Familydata    = $this->familydetails->ShowFamilyDetailsByEmpNo($EmpNo); 
        $existingFamilyIds = $this->LtcAdv->where('emp_no', $EmpNo)
                            ->whereBetween('created_at', [date('Y') . '-01-01 00:00:00',date('Y') . '-12-31 23:59:59'
                            ])->pluck('family_ids')->toArray();
        $WorkFlowAction = NULL;
        $TargetRoles = $EditClaimData->target_roles;//collect($EditClaimData)->pluck('target_roles')->first() ?? NULL;
        $IsCompleted = $EditClaimData->is_completed;//collect($EditClaimData)->pluck('is_completed')->first();
        $ApprAuthRole = $EditClaimData->approve_auth_role;//collect($EditClaimData)->pluck('approve_auth_role')->first() ?? NULL;
        $WorkFlowActionData = [];
        if(($IsCompleted == NULL)||($IsCompleted == false)){
            if(($TargetRoles == '')||($TargetRoles == NULL)){
                $WorkFlowAction = 'SU'; // Submit
                $WorkFlowActionData = ['WorkFlowAction' => $WorkFlowAction];
            }else{
                $WorkFlowActionData = $this->WorkFlowService->CheckForwardAndBackward('LTCADV',$ApplicationId,$TargetRoles,$ApprAuthRole);
            }
        }
        //dd($WorkFlowActionData);
        return view('change-request.ltcadvclaim.emp-ltc-adv-change-request-view')->with('data',compact('ApplicationId','Action','EditClaimData',
            'Page','WorkFlowActionData','LtcAdvData','Empdata','Payleveldata','Familydata','Leaveexits','selectedFamilyIds','existingFamilyIds'));  

    }

    public function EmpChangeLTCClaimSelfService(Request $request)
    {  
        $EditClaimData = NULL;
        $LtcAdvData = NULL;
        $Page = "REQ_APPLY";
        $message = NULL;
        $Leaveexits = NULL;
        $selectedFamilyIds = [];
        if(isset($request->id)){ 
            try {
                $EditId = decrypt($request->id); 
                $Page   = decrypt($request->Page);
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $data = "Error : Sorry Invalid Attempt";
                return redirect()->back();
            }
            $EditClaimData = $this->LtcAdv->ShowLtcRequest(NULL,$EditId); 
            $LtcAdvId      = !empty($EditClaimData->application_no) ? explode(',', $EditClaimData->application_no) : [];
	        $LtcAdvData    = $this->LtcAdvDetails->GetLtcAdvDetails($LtcAdvId);
            foreach ($LtcAdvData as $travel) {
                $from       = $travel['departure_dt'] ?? null;
                $to         = $travel['arraival_dt'] ?? null;
                $Leaveexits = $this->LeaveApplied->CheckLTCAppliedLeave($from,$to,$EditClaimData->emp_no);
            }
            $selectedFamilyIds = [];
            if (!empty($EditClaimData->family_ids)) {
                $selectedFamilyIds = explode(',', $EditClaimData->family_ids);
            }
        }
        if(isset($request->btn_save)){  
            $EmpNo            = $request->txt_emp_icno;
            $SpouseEmployed   = $request->rad_spouse_employed;
            $EntitledLTC      = $request->rad_entitle_LTC;
            $VisitingHome     = $request->rad_visiting;
            $YearLTC          = $request->year_ltc;
            $Visitedindia     = $request->rad_india;
            $PlaceVisited     = $request->place_visited;
            $totalAdvAmount   = $request->total_adv_amount ?: null;
            $sanctioned       = $request->total_claim_amount ?: null;
            $leaveenhance     = $request->rad_leaveenhance;
            $ElDays           = $request->el_days;

            $checkeFamilydIds = $request->chk_cout_rel ?? [];
            $FamilyIds        = !empty($checkeFamilydIds) ? implode(',', $checkeFamilydIds) : null;

            $AdvanceAmountArr = $request->input('txt_adv_amount');
            $DepatureDtArr    = $request->input('txt_departure_dt');
            $DepatureTimeArr  = $request->input('txt_departure_time');
            $DepatureFromArr  = $request->input('txt_departure_from');
            $ArraivalDtArr    = $request->input('txt_arraival_dt');
            $ArraivalTimeArr  = $request->input('txt_arraival_time');
            $ArraivalFromArr  = $request->input('txt_arraival_from');
            $DistanceArr      = $request->input('txt_distance');
            $TravelModeArr    = $request->input('cmb_travel_mode');
            $AccomodUsedArr   = $request->input('txt_accomod_used');
            $NoOfFaresArr     = $request->input('txt_no_of_amount');
            $DetailIdsArr     = $request->input('detail_id') ?? [];

            DB::beginTransaction();
            try {
                $SaveArr = [];
                $SaveArr['emp_no']            = $EmpNo;
                $SaveArr['spouse_employed']   = $SpouseEmployed;
                $SaveArr['entitle_ltc']       = $EntitledLTC;
                $SaveArr['visiting_home']     = $VisitingHome;
                $SaveArr['year_ltc']          = $YearLTC;
                $SaveArr['visiting_india']    = $Visitedindia;
                $SaveArr['place_visited']     = $PlaceVisited;
                $SaveArr['claim_amount']      = $totalAdvAmount;
                $SaveArr['claim_sanctioned_amount'] = $sanctioned;
                $SaveArr['module_code']       = 'LTCCLAIM';
                $SaveArr['is_claim_completed']= false;
                $SaveArr['is_adv_completed']  = true;
                $SaveArr['active']            = 1;
                $SaveArr['family_ids']        = $FamilyIds;
                $SaveArr['leave_enhancement'] = $leaveenhance;
                $SaveArr['el_days']            = $ElDays;
                if ($sanctioned) {
                    $SaveArr['claim_sanctioned_by'] = session('WcmsEmpNo');
                    $SaveArr['claim_sanctioned_at'] = now();
                }
                if (!empty($request->id)) {
                    $EditId = decrypt($request->id);
                    $SaveArr['status']     = 'submitted';
                    $this->LtcAdv->updateLtcAdvance($EditId, $SaveArr);
                    $MasterId = $EditId;
                }else {
                    $SaveArr['status']     = 'submitted';
                    $SaveArr['created_at'] = now();
                    $SaveArr['created_by'] = session('WcmsEmpNo');
                    $SaveLtcAdv = $this->LtcAdv->createLtcAdvances($SaveArr);
                    $MasterId = $SaveLtcAdv->ltc_advance_id;
                }
                $LtcadvIds = [];
                foreach ($DepatureDtArr as $key => $DepatureDt) {
                    $SaveData = [];
                    $SaveData['emp_no']         = $EmpNo;
                    $SaveData['departure_dt']   = !empty($DepatureDt) ? Helper::DBDateFormat($DepatureDt) : null;
                    $SaveData['departure_time'] = $DepatureTimeArr[$key] ?? null;
                    $SaveData['departure_from'] = $DepatureFromArr[$key] ?? null;
                    $SaveData['arraival_dt']    = !empty($ArraivalDtArr[$key]) ? Helper::DBDateFormat($ArraivalDtArr[$key]) : null;
                    $SaveData['arraival_time']  = $ArraivalTimeArr[$key] ?? null;
                    $SaveData['arraival_from']  = $ArraivalFromArr[$key] ?? null;
                    $SaveData['distance']       = $DistanceArr[$key] ?? null;
                    $SaveData['travel_mode']    = $TravelModeArr[$key] ?? null;
                    $SaveData['accomod_used']   = $AccomodUsedArr[$key] ?? null;
                    $SaveData['no_of_fares']    = $NoOfFaresArr[$key] ?? null;
                    $SaveData['advance_amount'] = $AdvanceAmountArr[$key] ?? null;
                    if (!empty($DetailIdsArr[$key])) {
                        $SaveData['updated_at'] = now();
                        $SaveData['updated_by'] = session('WcmsEmpNo');
                        $this->LtcAdvDetails->updateLtcAdvDetails($DetailIdsArr[$key], $SaveData);
                        $LtcadvIds[] = $DetailIdsArr[$key];
                    }else {
                        $SaveData['ltc_advance_id'] = $MasterId;
                        $SaveData['active']         = 1;
                        $SaveData['created_at']     = now();
                        $SaveData['created_by']     = session('WcmsEmpNo');
                        $SaveValues = $this->LtcAdvDetails->CreateLtcAdvDetails($SaveData);
                        $LtcadvIds[] = $SaveValues->ltc_detail_id;
                    }
                }

                if (!empty($LtcadvIds)) {
                    $this->LtcAdv->UpdateAdvances($MasterId, implode(',', $LtcadvIds));
                }
                DB::commit();
                Session::put('ALertMesage', 'LTC Advance Details Saved Successfully');
                if($EmpNo != session('WcmsEmpNo')){
                    return redirect()->route('change-request.ltc-settlement-change-request-pending-list');
                }else{
                    return redirect()->route('change-request.ltc-settlement-change-request-list');
                }

            } catch (\Exception $e) {
                DB::rollback();
                Session::put('ALertMesage', 'Error: Sorry Details not Saved');
                return redirect()->route('change-request.ltc-adv-change-request');
            }

        }
        if(isset($request->id)){
            $Empdata       = $this->Employee->ShowEmployees($request,$EditClaimData->emp_no);
            $Payleveldata  = $this->PayLevel->ShowEmployeePayLevelByEmpno($EditClaimData->emp_no); 
            $Familydata    = $this->familydetails->ShowFamilyDetailsByEmpNo($EditClaimData->emp_no); 
            $existingFamilyIds = $this->LtcAdv->where('emp_no', $EditClaimData->emp_no)
                                ->whereBetween('created_at', [date('Y') . '-01-01 00:00:00',date('Y') . '-12-31 23:59:59'
                                ])->pluck('family_ids')->toArray();
        }else{
            $Empdata       = $this->Employee->ShowEmployeeBySessionEmpNo();
            $Payleveldata  = $this->PayLevel->ShowEmployeePayLevelByEmpno(session('WcmsEmpNo')); 
            $Familydata    = $this->familydetails->ShowFamilyDetailsByEmpNo(session('WcmsEmpNo')); 
            $existingFamilyIds = $this->LtcAdv->where('emp_no', session('WcmsEmpNo'))
                                ->whereBetween('created_at', [date('Y') . '-01-01 00:00:00',date('Y') . '-12-31 23:59:59'
                                ])->pluck('family_ids')->toArray();
        }
        $LeaveTypeData = $this->leavetype->ShowLeaveType(); 
    
        return view('change-request.ltcsettlementclaim.emp-ltc-settlement-claim-request')->with('data',compact('Empdata','EditClaimData',
        'Page','Payleveldata','Familydata','LtcAdvData','LeaveTypeData','Leaveexits','selectedFamilyIds','existingFamilyIds'));
    } 

    public function EmpChangeClaimReqSelfServiceList(){
        $Page        = 'REQ_APPLY'; 
        $EmpNo       = session('WcmsEmpNo'); 
        $LTCData     = $this->LtcAdv->ShowEmpClaimedLtc(NULL,$EmpNo,'LTCCLAIM');

        return view('change-request.ltcsettlementclaim.emp-ltc-settlement-claim-list')->with('data', compact('LTCData','Page'));
    }

    public function EmpChangeClaimReqPendingList(){
        $Page        = 'REQ_PROCESS'; 
        $EmpNo       = session('WcmsEmpNo'); 
        $LTCData     = $this->LtcAdv->ShowEmpClaimedLtc(NULL,NULL,'LTCCLAIM'); 
        
        return view('change-request.ltcsettlementclaim.emp-ltc-settlement-claim-list')->with('data', compact('LTCData','Page'));
    }

    public function EmpChangeClaimReqProcess(Request $request)
    {  
        if(isset($request->SubmitApplication)){
            try {
                $TransactionId = decrypt($request->txt_application_id);
                $ModuleCode = decrypt($request->wf_module_code);
                $PageAction = decrypt($request->txt_action);
                $Page = decrypt($request->txt_page);
                
                $WorkFlowMode   = $request->txt_wf_mode;
                $ActualEmpNo    = $request->txt_actual_emp;
                $WorkFlowRemark = $request->txt_wf_remark;
                $WorkFlowEmpNo  = $request->txt_wf_emp_no;
                $WorkFlowRole   = $request->txt_wf_role;
                $WorkFlowAction = $request->txt_wf_action;
                $RolePosition = $request->txt_role_position;
                
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) { 
                $message = "Error : Sorry Invalid Attempt";
                Session::put('ALertMesage', $message);
                if($Page == "REQ_PROCESS"){
                    return redirect()->route('change-request.ltc-settlement-change-request-pending-list');
                }else{
                    return redirect()->route('change-request.ltc-settlement-change-request-list');
                }
            }
            $sanctionedAmt = $request->total_claim_amount ?? null;
            if (!empty($sanctionedAmt)) {
                $advId = decrypt($request->Application);
                $this->LtcAdv->updateClaimSanctionedAmount($advId, $sanctionedAmt);
            }

            if(($request->SubmitApplication == 'RJ')||($request->SubmitApplication == 'AP')){
                $WorkFlowData = (object)['TransactionId'=>$TransactionId,'WflowModule'=>$ModuleCode,'WorkFlowMode'=>$WorkFlowMode,'ActualEmpNo'=>NULL,'WorkFlowRemark'=>$WorkFlowRemark,'WorkFlowEmpNo'=>NULL,'WorkFlowRole'=>NULL,'WorkFlowAction'=>$request->SubmitApplication,'RolePosition'=>NULL,'SubModule'=>'LTC_CLAIM'];
            }else{
                $WorkFlowData = (object)['TransactionId'=>$TransactionId,'WflowModule'=>$ModuleCode,'WorkFlowMode'=>$WorkFlowMode,'ActualEmpNo'=>$ActualEmpNo,'WorkFlowRemark'=>$WorkFlowRemark,'WorkFlowEmpNo'=>$WorkFlowEmpNo,'WorkFlowRole'=>$WorkFlowRole,'WorkFlowAction'=>$WorkFlowAction,'RolePosition'=>$RolePosition,'SubModule'=>'LTC_CLAIM'];
            }
            $WorkFlowMessage = $this->WorkFlowService->WorkFlowMovementProcess(
                $TransactionId,
                $ModuleCode,
                $WorkFlowData
            );
            Session::put('ALertMesage', $WorkFlowMessage);
            if($Page == "REQ_PROCESS"){
                return redirect()->route('change-request.ltc-settlement-change-request-pending-list');
            }else{
                return redirect()->route('change-request.ltc-settlement-change-request-list');
            }
        }

        $EditClaimData    = NULL; 
        $Page             = NULL;
        $LtcAdvData       = NULL;
        $Leaveexits       = NULL;
        $selectedFamilyIds = [];
        if(isset($request->Application)){ 
            try {
                $ApplicationId = decrypt($request->Application); 
                $Page   = decrypt($request->Page);
                $Action = decrypt($request->action);
                if($Action != 'REQ_PROCESS'){
                    $message = "Error : Sorry Invalid Attempt";
                    Session::put('ALertMesage', $message);
                    if($Page == "REQ_PROCESS"){
                        return redirect()->route('change-request.ltc-settlement-change-request-pending-list');
                    }else{
                        return redirect()->route('change-request.ltc-settlement-change-request-list');
                    }
                }
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) { 
                $data = "Error : Sorry Invalid Attempt";
                return redirect()->back();
            }
            
        }
       
        $EditClaimData = $this->LtcAdv->ShowLtcRequest(NULL,$ApplicationId); 
        $EmpNo         = $EditClaimData->emp_no;
        $LtcAdvId      = !empty($EditClaimData->application_no) ? explode(',', $EditClaimData->application_no) : [];
        $LtcAdvData    = $this->LtcAdvDetails->GetLtcAdvDetails($LtcAdvId);
        foreach ($LtcAdvData as $travel) {
            $from       = $travel['departure_dt'] ?? null;
            $to         = $travel['arraival_dt'] ?? null;
            $Leaveexits = $this->LeaveApplied->CheckLTCAppliedLeave($from,$to,$EmpNo);
        }
        $selectedFamilyIds = [];
        if (!empty($EditClaimData->family_ids)) {
            $selectedFamilyIds = explode(',', $EditClaimData->family_ids);
        }
        $Empdata       = $this->Employee->ShowEmployees($request,$EmpNo);
        $Payleveldata  = $this->PayLevel->ShowEmployeePayLevelByEmpno($EmpNo); 
        $Familydata    = $this->familydetails->ShowFamilyDetailsByEmpNo($EmpNo); 
        $existingFamilyIds = $this->LtcAdv->where('emp_no', $EmpNo)
                            ->whereBetween('created_at', [date('Y') . '-01-01 00:00:00',date('Y') . '-12-31 23:59:59'
                            ])->pluck('family_ids')->toArray();
        $WorkFlowAction = NULL;
        $TargetRoles = $EditClaimData->target_roles;//collect($EditClaimData)->pluck('target_roles')->first() ?? NULL;
        $IsCompleted = $EditClaimData->is_claim_completed;//collect($EditClaimData)->pluck('is_completed')->first();
        $ApprAuthRole = $EditClaimData->approve_auth_role;//collect($EditClaimData)->pluck('approve_auth_role')->first() ?? NULL;
        $WorkFlowActionData = [];
        if(($IsCompleted == NULL)||($IsCompleted == false)){
            if(($TargetRoles == '')||($TargetRoles == NULL)){
                $WorkFlowAction = 'SU'; // Submit
                $WorkFlowActionData = ['WorkFlowAction' => $WorkFlowAction];
            }else{
                $WorkFlowActionData = $this->WorkFlowService->CheckForwardAndBackward('LTCCLAIM',$ApplicationId,$TargetRoles,$ApprAuthRole);
            }
        }
        //dd($IsCompleted);
        return view('change-request.ltcsettlementclaim.emp-ltc-settlement-claim-view')->with('data',compact('ApplicationId','Action','EditClaimData',
            'Page','WorkFlowActionData','LtcAdvData','Empdata','Payleveldata','Familydata','Leaveexits','selectedFamilyIds','existingFamilyIds'));  
    }
    public function checkLtcStatus(){
        $Page        = 'REQ_STATUS'; 
        $EmpNo       = session('WcmsEmpNo'); 
        $LTCData     = $this->LtcAdv->ShowEmpAppiledLtcAdv(NULL,$EmpNo);

        return view('change-request.ltcadvclaim.emp-ltc-status-list')->with('data', compact('LTCData','Page'));
    }
    public function ExportEmployeeLtcAdvPdf(Request $request)
    { 
        $EmpNo = decrypt($request->id);
        $LTCData = $this->ChangeRequest->ShowEmpPendingChangeRequest(NULL,$EmpNo,'LTCCLAIM');
        $data = ['LTCData'=>$LTCData];
        $pdf = PDF::loadView('change-request.ltcadvclaim.export-ltc-adv-pdf', $data);
        return $pdf->download('My_Profile_'.$EmpNo.'.pdf');
    }
    public function LtcStatusList(Request $request){
         if(isset($request->id)){
            try{
                $LTCId           = decrypt($request->id);
                $ModuleCode      = decrypt($request->modulecode);
                $Empdata         = $this->Employee->ShowEmployees($request,NULL); 
                $LTCData         = $this->LtcAdv->ShowLtcDetails(NULL,$LTCId);
                $RoleData        = $this->role->ShowRoles($request,NULL);
                $WorkFlowData    = $this->ModuleWorkFlow->ShowWorKFlowBYModuleCode(NULL,$ModuleCode);
                $WorkTransData   = $this->WorkFlowMovementDet->ShowWorkMovement(NULL,$LTCId,$ModuleCode);
                $LastWorkTransData   = $this->WorkFlowMovementDet->ShowLatestWorkMovement(NULL,$LTCId,$ModuleCode);
                $EmpDetails          = collect($Empdata)->pluck('emp_name_payslip','emp_no')->toArray();
                $EmpDesigDetails     = collect($Empdata)->pluck('designation_name','emp_no')->toArray();
                $RoleDetails         = collect($RoleData)->pluck('role_name','roleid')->toArray();
                return view('change-request.ltcadvclaim.ltc-adv-status-view')->with('data',compact('LTCId','EmpDetails','EmpDesigDetails','LTCData','RoleDetails','WorkFlowData','WorkTransData','LastWorkTransData',));
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message = "Error: Sorry, invalid attempt.";
            }
            if(filled($message)){
                Session::put('ALertMesage', $message);
                return redirect()->route('ltc-adv.ltc-adv-status-list');
            }
        }
        $ModuleCode      = 'LTCADV';
        $LTCData         = $this->LtcAdv ->ShowLtcDetailsByModuleCode(NULL,$ModuleCode);
        $Empdata         = $this->Employee->ShowEmployees($request,NULL); 
        $RoleData        = $this->role->ShowRoles($request,NULL);
        $MaxWorkMoveData = $this->WorkFlowMovementDet->ShowAllMaxWorkMovement($request,$ModuleCode);
        $EmpDetails          = collect($Empdata)->pluck('emp_name_payslip','emp_no')->toArray();
        $RoleDetails         = collect($RoleData)->pluck('role_name','roleid')->toArray();
        $MaxWorkMoveDetails  = collect($MaxWorkMoveData)->pluck('created_at','transaction_id')->toArray();
        return view('change-request.ltcadvclaim.ltc-adv-status-list')->with('data', compact('LTCData','EmpDetails','RoleDetails','MaxWorkMoveDetails'));
    }
    public function LTCClaimStatusList(Request $request){
         if(isset($request->id)){
            try{
                $LTCId               = decrypt($request->id);
                $ModuleCode          = decrypt($request->modulecode);
                $Empdata             = $this->Employee->ShowEmployees($request,NULL); 
                $LTCData             = $this->LtcAdv->ShowLtcDetails(NULL,$LTCId);
                $RoleData            = $this->role->ShowRoles($request,NULL);
                $WorkFlowData        = $this->ModuleWorkFlow->ShowWorKFlowBYModuleCode(NULL,$ModuleCode);
                $WorkTransData       = $this->WorkFlowMovementDet->ShowWorkMovement(NULL,$LTCId,$ModuleCode);
                $LastWorkTransData   = $this->WorkFlowMovementDet->ShowLatestWorkMovement(NULL,$LTCId,$ModuleCode);
                $EmpDetails          = collect($Empdata)->pluck('emp_name_payslip','emp_no')->toArray();
                $EmpDesigDetails     = collect($Empdata)->pluck('designation_name','emp_no')->toArray();
                $RoleDetails         = collect($RoleData)->pluck('role_name','roleid')->toArray();
                return view('change-request.ltcsettlementclaim.ltc-claim-status-view')->with('data',compact('LTCId','EmpDetails','EmpDesigDetails','LTCData','RoleDetails','WorkFlowData','WorkTransData','LastWorkTransData',));
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message = "Error: Sorry, invalid attempt.";
            }
            if(filled($message)){
                Session::put('ALertMesage', $message);
                return redirect()->route('ltc-claim.ltc-claim-status-list');
            }
        }
        $ModuleCode          = 'LTCCLAIM';
        $LTCData             = $this->LtcAdv ->ShowLtcDetailsByModuleCode(NULL,$ModuleCode);
        $Empdata             = $this->Employee->ShowEmployees($request,NULL); 
        $RoleData            = $this->role->ShowRoles($request,NULL);
        $MaxWorkMoveData     = $this->WorkFlowMovementDet->ShowAllMaxWorkMovement($request,$ModuleCode);
        $EmpDetails          = collect($Empdata)->pluck('emp_name_payslip','emp_no')->toArray();
        $RoleDetails         = collect($RoleData)->pluck('role_name','roleid')->toArray();
        $MaxWorkMoveDetails  = collect($MaxWorkMoveData)->pluck('created_at','transaction_id')->toArray();
        return view('change-request.ltcsettlementclaim.ltc-claim-status-list')->with('data', compact('LTCData','EmpDetails','RoleDetails','MaxWorkMoveDetails'));
    }
}
