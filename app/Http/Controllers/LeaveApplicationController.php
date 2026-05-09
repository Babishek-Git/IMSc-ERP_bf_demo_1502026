<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

// Original models (keep your existing ones)
use App\Models\AemEmployee;
use App\Models\Role;
//use App\Models\LeaveTransaction;
//use App\Models\LeaveTransactionDt;

// New models from the leave module design
use App\Models\LeaveType;
use App\Models\LeaveBalance;
use App\Models\LeaveApplication;
use App\Models\LeaveApplicationDt;
//use App\Models\Employee;

// New services
use App\Services\LeaveCalculationService;
use App\Services\LeaveApplicationService;
use App\Services\WorkFlowProcessService;

use Carbon\Carbon;
use DB;
use Session;

class LeaveApplicationController extends Controller
{
    protected LeaveCalculationService $calcService;
    protected LeaveApplicationService $appService;
    protected WorkFlowProcessService $WorkFlowService;

    public function __construct(
        LeaveCalculationService $calcService,
        LeaveApplicationService $appService,
        WorkFlowProcessService $WorkFlowService,
    ) {
        $this->Employee         = new AemEmployee();
        $this->role             = new Role();
        $this->LeaveApplication = new LeaveApplication();
        $this->LeaveApplicationDt = new LeaveApplicationDt();
        //$this->LeaveTransaction = new LeaveTransaction();
        //$this->LeaveTransactionDt = new LeaveTransactionDt();

        $this->calcService = $calcService;
        $this->appService  = $appService;
        $this->WorkFlowService = $WorkFlowService;
    }

    // --------------------------------
    // MAIN PAGE (GET + POST)
    // --------------------------------

    public function LeaveApplicationAdmin(Request $request){ 
        $request->merge([
            'ApplyBy' => 'REQ_ADMIN',
            'Page' => 'REQ_APPLY'
        ]);
        return $this->LeaveApplication($request);
    }
    public function LeaveApplicationSelf(Request $request){
        $request->merge([
            'ApplyBy' => 'REQ_SELF',
            'Page' => 'REQ_APPLY'
        ]);
        return $this->LeaveApplication($request);
    }

    public function LeaveApplication($request)
    {
        $ApplyBy = $request->ApplyBy;  
        $Page = $request->Page; 
        // ── POST: Save Application --------------------------------
        if ($request->isMethod('POST') && $request->has('SaveApplication')) {
            return $this->saveLeaveApplication($request);
        }

        // ── GET: Load Form -----------------------------------------------
        if ($ApplyBy == 'REQ_ADMIN') {
            $Empdata  = null;
            $UserData = $this->Employee->ShowEmployees(null, null);
        } else {
            $Empdata  = $this->Employee->ShowEmployeeBySessionEmpNo();
            $UserData = null;
        }

        // Only active, non-special leave types for the dropdown
        $LeaveTypeData = LeaveType::where('active', 1)
            ->orderBy('leave_type_code')
            ->get(['leave_type_id', 'leave_type_name', 'leave_type_code']);

        return view('leave.leave-application.leave-application')
            ->with('data', compact('Empdata', 'UserData', 'LeaveTypeData','ApplyBy','Page'));
    }

    // --------------------------------
    // SAVE APPLICATION (extracted for clarity)
    // --------------------------------

    private function saveLeaveApplication(Request $request): \Illuminate\Http\RedirectResponse
    {
        $empNo          = $request->txt_emp_icno;
        
        $leaveTypeIds   = $request->input('txt_leave_type_id', []);
        $fromDates      = $request->input('txt_from_date', []);
        $toDates        = $request->input('txt_to_date', []);
        $noOfDaysArr    = $request->input('txt_no_of_days', []);
        $reasons        = $request->input('txt_reason', []);
        try {
            $Page   = decrypt($request->txt_page);
            $ApplyBy   = decrypt($request->txt_apply_by);
        }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $data = "Error : Sorry Invalid Attempt";
            return redirect()->back();
        }

        if (empty($leaveTypeIds)) {
            Session::put('ALertMesage', 'Error: Add at least one leave record before saving.');
            return redirect()->route('LeaveApplication.LeaveApplication');
        }

        // Resolve the Employee model (needed by services)
        $employee = AemEmployee::where('emp_no', $empNo)->first();
        if (!$employee) {
            Session::put('ALertMesage', 'Error: Employee not found.');
            return redirect()->route('LeaveApplication.LeaveApplication');
        }

        DB::beginTransaction();
        try {
            $savedApplications = [];
            $errors            = [];

            $ApplicationNo = $this->appService->generateApplicationNo();
            $SaveData = ['emp_no'=>$employee->emp_no, 'leave_application_no'=>$ApplicationNo, 'total_days'=>count($noOfDaysArr), 'status'=>'submitted', 'active'=>1, 'created_by'=>session('WcmsEmpNo'), 'created_at'=>NOW()];
            $LeaveApp = $this->LeaveApplication->CreateLeaveApplication($SaveData);
            $LeaveApplicationId = $LeaveApp->leave_application_id;
            $savedApplications[] = $ApplicationNo;

            foreach ($leaveTypeIds as $i => $leaveTypeId) {
                $leaveType = LeaveType::find($leaveTypeId);
                if (!$leaveType) {
                    $errors[] = "Row " . ($i + 1) . ": Invalid leave type.";
                    continue;
                }

                $fromDate = Carbon::createFromFormat('d/m/Y', $fromDates[$i])->startOfDay();
                $toDate   = Carbon::createFromFormat('d/m/Y', $toDates[$i])->startOfDay();

                // Server-side recalculation (never trust client-submitted days)
                $actualDays = $this->calcService->calculateLeaveDays(
                    $leaveType->leave_type_code,
                    $fromDate,
                    $toDate
                );

                

                // Build application payload
                $appData = [
                    'leave_type_id'  => $leaveTypeId,
                    'from_date'      => $fromDate->toDateString(),
                    'to_date'        => $toDate->toDateString(),
                    'reason'         => $reasons[$i] ?? null,
                    'status'         => 'submitted',
                    'leave_application_id' => $LeaveApplicationId,
                    'application_no' => $ApplicationNo,
                    'active' => 1,
                    'created_by' => session('WcmsEmpNo'),
                    'created_at' => NOW(),
                ];

                // Delegate to LeaveApplicationService (runs eligibility + saves)
                try { 
                    $application = $this->appService->apply($employee, $appData);
                     //dd($savedApplications);
                } catch (\Exception $e) {
                    $errors[] = "[{$leaveType->leave_type_code}] " . $e->getMessage();
                }
            }

            if (!empty($errors)) { dd($errors);
                DB::rollBack();
                Session::put('ALertMesage', 'Error: ' . implode(' | ', $errors));
                if($ApplyBy == 'REQ_ADMIN'){
                    return redirect()->route('LeaveApplication.LeaveApplicationPendingAdminList');
                }else{
                    return redirect()->route('LeaveApplication.LeaveApplicationPendingSelfList');
                }
            }
            //dd(1);
            DB::commit();
            $appNos  = implode(', ', $savedApplications);
            $message = "Leave application(s) saved successfully. Application No(s): {$appNos}";

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('LeaveApplication save failed: ' . $e->getMessage());
            $message = 'Error: Transaction could not be completed. Please try again.';
        }

        Session::put('ALertMesage', $message);
        if($ApplyBy == 'REQ_ADMIN'){
            return redirect()->route('LeaveApplication.LeaveApplicationPendingAdminList');
        }else{
            return redirect()->route('LeaveApplication.LeaveApplicationPendingSelfList');
        }
    }

    // --------------------------------
    // AJAX: Calculate Leave Days (server-side, respects leave type rules)
    // Route: POST /leave/calculate-days
    // --------------------------------

    public function calculateLeaveDays(Request $request): JsonResponse
    { 
        $request->validate([
            'leave_type_id' => 'required|exists:erp_leave_types,leave_type_id',
            'from_date'     => 'required|date_format:d/m/Y',   // ← was 'date'
            'to_date'       => 'required|date_format:d/m/Y',   // ← was 'date|after_or_equal:from_date'
        ]);

        try {
            $leaveType = LeaveType::findOrFail($request->leave_type_id); 
            $fromDate = Carbon::createFromFormat('d/m/Y', $request->from_date)->startOfDay();
            $toDate   = Carbon::createFromFormat('d/m/Y', $request->to_date)->startOfDay();

            if ($toDate->lt($fromDate)) {
                return response()->json(['success' => false, 'message' => 'To Date must be on or after From Date.'], 422);
            }

            $days = $this->calcService->calculateLeaveDays(
                $leaveType->leave_type_code,
                $fromDate,
                $toDate
            );

            return response()->json([
                'success' => true,
                'days'    => $days,
                'note'    => $this->getLeaveDayNote($leaveType->leave_type_code),
            ]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }
    }

    // --------------------------------
    // AJAX: Get Single Leave Balance
    // Route: POST /leave/balance (replaces LeaveBalance.GetEmpLeaveBalance)
    // --------------------------------

    public function getEmpLeaveBalance(Request $request): JsonResponse
    {
        $empNo       = $request->EmpNo;
        $leaveTypeId = $request->LeaveType; // leave_type_id

        $employee = AemEmployee::where('emp_no', $empNo)->first();
        if (!$employee) {
            return response()->json(['LeaveBalData' => null]);
        }

        $leaveType = LeaveType::find($leaveTypeId);
        if (!$leaveType) {
            return response()->json(['LeaveBalData' => null]);
        }

        // Check staff type and gender eligibility before showing balance
        $eligible = true;
        if (!empty($leaveType->applicable_staff_types) &&
            !in_array($employee->staff_type, $leaveType->applicable_staff_types)) {
            $eligible = false;
        }
        if (!empty($leaveType->applicable_genders) &&
            !in_array($employee->emp_gender, $leaveType->applicable_genders) &&
            !in_array('all', $leaveType->applicable_genders)) {
            $eligible = false;
        }

        if (!$eligible) {
            return response()->json([
                'LeaveBalData'  => null,
                'not_eligible'  => true,
                'message'       => "{$leaveType->leave_type_name} is not applicable for this employee.",
            ]);
        }

        $balance = LeaveBalance::where('emp_no', $employee->emp_no)
            ->where('leave_type_id', $leaveType->leave_type_id)
            ->first();

        // Determine label and value based on leave type
        $balInYear    = null;
        $balInService = null;

        if ($leaveType->max_per_year) {
            // CL, AL — show remaining this year
            $used = $this->calcService->getUsedThisYear($employee, $leaveType->leave_type_code);
            $balInYear = ($leaveType->max_per_year - $used);
        } elseif ($leaveType->max_entire_service) {
            // ML, PL, CCL, STL, LND — show remaining in service
            $availed = $balance ? $balance->total_availed_service : 0;
            $balInService = max(0, $leaveType->max_entire_service - $availed);
        } else {
            // EL, HPL, CML — balance from leave_balances
            $balInYear = $balance ? round($balance->balance, 2) : 0;
        }

        return response()->json([
            'LeaveBalData' => [[
                'leave_bal_in_year'    => $balInYear,
                'leave_bal_in_service' => $balInService,
                'leave_type_code'      => $leaveType->leave_type_code,
            ]],
        ]);
    }

    // --------------------------------
    // AJAX: Get ALL Leave Balances for an employee (for tooltip)
    // Route: POST /leave/all-balances
    // --------------------------------

    public function getAllLeaveBalances(Request $request): JsonResponse
    {
        $empNo    = $request->EmpNo;
        $employee = AemEmployee::where('emp_no', $empNo)->first();

        if (!$employee) {
            return response()->json(['AllLeaveBalData' => []]);
        }
        
        $leaveTypes = LeaveType::where('active', 1)->get();
        $result     = [];

        foreach ($leaveTypes as $leaveType) {
            // Skip if not applicable to this employee
            if (!empty($leaveType->applicable_staff_types) &&
                !in_array($employee->staff_type, $leaveType->applicable_staff_types)) {
                continue;
            }
            if (!empty($leaveType->applicable_genders) &&
                !in_array($employee->emp_gender, $leaveType->applicable_genders) &&
                !in_array('all', $leaveType->applicable_genders)) {
                continue;
            }

            $balance = LeaveBalance::where('emp_no', $employee->emp_no)
                ->where('leave_type_id', $leaveType->leave_type_id)
                ->first();

            if ($leaveType->max_per_year) {
                $used    = $this->calcService->getUsedThisYear($employee, $leaveType->leave_type_code); 
                $total   = $leaveType->max_per_year;
                $current = $total - $used;
                $label   = 'per year';
            } elseif ($leaveType->max_entire_service) {
                $availed = $balance ? $balance->total_availed_service : 0;
                $total   = $leaveType->max_entire_service;
                $current = max(0, $total - $availed);
                $label   = 'in service';
            } else {
                $current = $balance ? round($balance->balance, 2) : 0;
                $total   = $leaveType->max_carry_forward ?? '—';
                $label   = 'balance';
            }

            $result[] = [
                'leave_type_code' => $leaveType->leave_type_code,
                'leave_type_name' => $leaveType->leave_type_name,
                'total'           => $total,
                'balance'         => $current,
                'label'           => $label,
            ];
        }

        return response()->json(['AllLeaveBalData' => $result]);
    }

    // --------------------------------
    // HELPERS
    // --------------------------------

    private function isAdmin(): bool
    {
        return in_array(session('WcmsRoleGroupCode'), ['ADMUSER', 'SUPUSER']);
    }

    /**
     * User-friendly note explaining why the day count might differ from calendar days.
     */
    private function getLeaveDayNote(string $code): string
    {
        return match ($code) {
            'CL'  => 'Saturdays, Sundays and holidays (prefix, suffix, and intervening) are excluded.',
            'EL',
            'CCL' => 'Sundays and holidays that immediately precede or follow the leave are excluded. Intervening holidays are counted.',
            'AL'  => 'Weekends and declared holidays that immediately precede or follow the leave are excluded.',
            default => 'All calendar days are counted.',
        };
    }
    public function LeaveApplicationPendingSelfList(Request $request){
        $Page    = 'REQ_APPLY';
        $ApplyBy = 'REQ_SELF';
        $EmpNo   = session('WcmsEmpNo'); 
        $LeaveApplicationList = $this->GetPendingList($EmpNo);
        return view('leave.leave-application.leave-pending-list', compact('LeaveApplicationList','Page','ApplyBy'));
    }
    public function LeaveApplicationPendingAdminList(Request $request){
        $Page    = 'REQ_APPLY';
        $ApplyBy = 'REQ_ADMIN';
        $EmpNo   = session('WcmsEmpNo'); 
        $LeaveApplicationList = $this->GetPendingList(NULL);
        return view('leave.leave-application.leave-pending-list', compact('LeaveApplicationList','Page','ApplyBy'));
    }
    public function GetPendingList($EmpNo){
        return LeaveApplication::with('employee')
            ->where('erp_emp_leave_application.active', 1)
            ->when($EmpNo, function ($query) use ($EmpNo) {
                return $query->where('erp_emp_leave_application.emp_no', $EmpNo);
            })
            ->where(function ($query) {  
                $query->where(function ($q) {
                    $q->where('erp_emp_leave_application.created_by', session('WcmsEmpNo'))
                    ->where(function ($q) {
                        $q->where('erp_emp_leave_application.status', 'submitted')
                        ->orWhere('erp_emp_leave_application.status', 'pending');
                    })
                    ->whereNull('erp_emp_leave_application.to_emp_no')
                    ->whereNull('erp_emp_leave_application.from_emp_no')
                    ->where(function ($sub) {
                    $sub->where('erp_emp_leave_application.is_approved', false)
                        ->orWhereNull('erp_emp_leave_application.is_approved');
                    });
                })
                ->orWhere(function ($q) {
                    $q->where('erp_emp_leave_application.to_emp_no', session('WcmsEmpNo'))
                    ->Where(function ($q) {
                        $q->where('erp_emp_leave_application.status', 'submitted')
                        ->orWhere('erp_emp_leave_application.status', 'recommended');
                    });
                });
            })->get();
    }
    public function LeaveApprovalList(Request $request){
        $LeaveApplicationList = LeaveApplication::with('employee')->where('status','submitted')->get(); 
        return view('leave.leave-application.leave-approval-list', compact('LeaveApplicationList'));
    }
    public function ViewLeaveApplication(Request $request){
        if(isset($request->SaveApplication)){
            return $this->ApplicationProcess($request);
        }
        if(isset($request->SubmitApplication)){
            try {
                $TransactionId = decrypt($request->txt_application_id);
                $ModuleCode = decrypt($request->wf_module_code);
                $PageAction = decrypt($request->txt_action);
                $Page = decrypt($request->txt_page);
                $ApplyBy = decrypt($request->txt_apply_by);
                
                $WorkFlowMode   = $request->txt_wf_mode;
                $ActualEmpNo    = $request->txt_actual_emp;
                $WorkFlowRemark = $request->txt_wf_remark;
                $WorkFlowEmpNo  = $request->txt_wf_emp_no;
                $WorkFlowRole   = $request->txt_wf_role;
                $WorkFlowAction = $request->txt_wf_action;
                $RolePosition = $request->txt_role_position;
                //dd($WorkFlowAction);
                
                
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) { dd($e);
                $message = "Error : Sorry Invalid Attempt";
                Session::put('ALertMesage', $message);
                if($Page == "REQ_APPLY"){
                    if($ApplyBy == "REQ_ADMIN"){
                        return redirect()->route('LeaveApplication.LeaveApplicationPendingAdminList');
                    }else{
                        return redirect()->route('LeaveApplication.LeaveApplicationPendingSelfList');
                    }
                }
            }
            if(($request->SubmitApplication == 'RJ')||($request->SubmitApplication == 'AP')){
                $ApplicationDtArr = $request->input('txt_leave_app_dt_id');
                $ApplicationActionArr = $request->input('cmb_action'); 

                $WorkFlowData = (object)['TransactionId'=>$TransactionId,'WflowModule'=>$ModuleCode,'WorkFlowMode'=>$WorkFlowMode,'ActualEmpNo'=>NULL,'WorkFlowRemark'=>$WorkFlowRemark,'WorkFlowEmpNo'=>NULL,'WorkFlowRole'=>NULL,'WorkFlowAction'=>$request->SubmitApplication,'RolePosition'=>NULL,'ApplicationDtArr'=>$ApplicationDtArr,'ApplicationActionArr'=>$ApplicationActionArr];
            }else{
                $WorkFlowData = (object)['TransactionId'=>$TransactionId,'WflowModule'=>$ModuleCode,'WorkFlowMode'=>$WorkFlowMode,'ActualEmpNo'=>$ActualEmpNo,'WorkFlowRemark'=>$WorkFlowRemark,'WorkFlowEmpNo'=>$WorkFlowEmpNo,'WorkFlowRole'=>$WorkFlowRole,'WorkFlowAction'=>$WorkFlowAction,'RolePosition'=>$RolePosition];
            }
            $WorkFlowMessage = $this->WorkFlowService->WorkFlowMovementProcess(
                $TransactionId,
                $ModuleCode,
                $WorkFlowData
            );
            Session::put('ALertMesage', $WorkFlowMessage);
            if($Page == "REQ_APPLY"){
                if($ApplyBy == "REQ_ADMIN"){
                    return redirect()->route('LeaveApplication.LeaveApplicationPendingAdminList');
                }else{
                    return redirect()->route('LeaveApplication.LeaveApplicationPendingSelfList');
                }
            }
        }
        if(isset($request->btn_view_application)){
            try {
                $ApplicationId = decrypt($request->txt_float_application);
                $Action = decrypt($request->txt_float_action);
                $ApplyBy = decrypt($request->txt_float_apply_by);
                $Page = decrypt($request->txt_page);
                if($Action != 'PROCESS'){
                    $message = "Error : Sorry Invalid Attempt";
                    Session::put('ALertMesage', $message);
                    if($Page == "REQ_APPLY"){
                        if($ApplyBy == "REQ_ADMIN"){
                            return redirect()->route('LeaveApplication.LeaveApplicationPendingAdminList');
                        }else{
                            return redirect()->route('LeaveApplication.LeaveApplicationPendingSelfList');
                        }
                    }
                }
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message = "Error : Sorry Invalid Attempt";
                Session::put('ALertMesage', $message);
                if($Page == "REQ_APPLY"){
                    if($ApplyBy == "REQ_ADMIN"){
                        return redirect()->route('LeaveApplication.LeaveApplicationPendingAdminList');
                    }else{
                        return redirect()->route('LeaveApplication.LeaveApplicationPendingSelfList');
                    }
                }
            }
            
            $LeaveApplicationData = $this->LeaveApplication->ShowApplicationById($ApplicationId);  
            $EmpNo = collect($LeaveApplicationData)->pluck('emp_no')->first() ?? NULL;
            $EmpData = $this->Employee->ShowEmployees($request,$EmpNo);

            $WorkFlowAction = NULL;
            $TargetRoles = collect($LeaveApplicationData)->pluck('target_roles')->first() ?? NULL;
            $IsCompleted = collect($LeaveApplicationData)->pluck('is_completed')->first();
            $ApprAuthRole = collect($LeaveApplicationData)->pluck('approve_auth_role')->first() ?? NULL;
            $WorkFlowActionData = [];
            if(($IsCompleted == NULL)||($IsCompleted == false)){
                if(($TargetRoles == '')||($TargetRoles == NULL)){
                    $WorkFlowAction = 'SU'; // Submit
                    $WorkFlowActionData = ['WorkFlowAction' => $WorkFlowAction];
                }else{
                    $WorkFlowActionData = $this->WorkFlowService->CheckForwardAndBackward('LEAVE',$ApplicationId,$TargetRoles,$ApprAuthRole);
                }
            }
            $LeaveApplicationDetails = LeaveApplicationDt::with('leaveType')->where('leave_application_id',$ApplicationId)->orderBy('leave_application_dt_id','ASC')->get(); 
            return view('leave.leave-application.leave-application-view', compact('ApplicationId','Action','EmpData','LeaveApplicationData','LeaveApplicationDetails','Action','WorkFlowActionData','Page','ApplyBy'));
        }
    }
    /*public function ApplicationProcess($request){
        try { dd(123);
            $ApplicationId = decrypt($request->input('txt_application_id'));
            $Action = decrypt($request->input('txt_action'));
            if($Action == 'PROCESS'){
                $ApplicationDtArr = $request->input('txt_leave_app_dt_id');
                $ApplicationActionArr = $request->input('cmb_action'); 
                $ApplicationData = $this->LeaveApplicationDt->ShowApplicationByArr($ApplicationDtArr); 
                if(filled($ApplicationData)){
                    DB::beginTransaction();
                    try {
                        $approver = AemEmployee::where('emp_no', session('WcmsEmpNo'))->firstOrFail();
                        foreach($ApplicationData as $Key => $Application){
                            $ApplicationAction = $ApplicationActionArr[$Key];
                            if($ApplicationAction == 'APPROVE'){ 
                                $this->appService->approve($Application, $approver);
                            }else if($ApplicationAction == 'REJECT'){ 
                                $this->appService->cancel($Application);
                            }
                        }
                        //$UpdateData = ['status'=>'completed','approved_by'=>session('WcmsEmpNo'),'approved_dt'=>NOW()];
                        //$EmpLeaveLastData = $this->LeaveApplication->UpdateLeaveApplication($UpdateData,$ApplicationId);
                        DB::commit();
                        $message = 'Application processed successfully.';
                        Session::put('ALertMesage', $message);
                    } catch (\Exception $e) {
                        DB::rollBack(); dd($e->getMessage());
                        Log::error('LeaveApplication save failed: ' . $e->getMessage());
                        $message = 'Error: Transaction could not be completed. Please try again.';
                        Session::put('ALertMesage', $message);
                    }
                }
            }else{
                 $message = 'Error: Invalid Access.';
                 Session::put('ALertMesage', $message);
            }
        }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $message = "Error : Sorry Invalid Attempt";
            Session::put('ALertMesage', $message);
        }
        return redirect()->route('LeaveApplication.LeaveApplicationPendingList');
    }*/
}