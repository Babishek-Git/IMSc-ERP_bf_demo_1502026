@extends('layouts.dashboard-master')
@section('content')
@include('layouts.partials.messages')
@php
if(isset($EmpData)) {
    $ICNo    = collect($EmpData)->pluck('emp_no')->first();
    $EmpName = collect($EmpData)->pluck('emp_name_payslip')->first();
    $EmpDOB  = collect($EmpData)->pluck('emp_dob')->first();
    $EmpDOJ  = collect($EmpData)->pluck('emp_doj')->first();
    $EmpRET  = collect($EmpData)->pluck('emp_retirement_dt')->first();
    $Desig   = collect($EmpData)->pluck('designation_name')->first();
    $GroupId = collect($EmpData)->pluck('group')->first();
    $DivId   = collect($EmpData)->pluck('division_short_name')->first();
    $SecId   = collect($EmpData)->pluck('section')->first();
}
$ActionStatus = $Action ?? '';
$ApplyBy = $ApplyBy ?? '';
$Page = $Page ?? '';
@endphp

<form action="" method="post" enctype="multipart/form-data" name="form">
    <div class="content">
        <div class="title"></div>
        <div class="container_12">
            <div class="grid_12">
                <blockquote class="bq1" style="overflow:auto">
                    <div class="container">
                        <div class="row plr">
                            <div class="div12 mbtable">

                                {{-- ── Page Title ── --}}
                                <div class="row">
                                    <div class="div12" style="margin-top:0px;">
                                        <div class="row divhead" align="center">Leave Application - Submit, Recommendation & Approval</div>
                                    </div>
                                </div>

                                <div class="row innerdiv">
                                    <div class="row" align="right">
                                        @if($ActionStatus == 'PROCESS')

                                        @php 
                                        $IsApprove = $WorkFlowActionData['IsApprove'] ?? NULL;
                                        $IsNext = $WorkFlowActionData['IsNext'] ?? NULL;
                                        $IsPrevious = $WorkFlowActionData['IsPrevious'] ?? NULL;
                                        @endphp

                                        @if($IsPrevious == 'Y')
                                        <button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="RJ" class="step-btn WorkFlowAction" value="REJECT">Return Back to User</button>
                                        <!-- <button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="BW" class="step-btn WorkFlowAction" value="RETURN">Return Back</button> -->
                                        @endif

                                        @if($IsApprove == 'Y')
                                        <button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="AP" class="step-btn WorkFlowAction" value="APPROVE">Approve</button>
                                        @endif

                                        @if(($IsApprove == NULL) && ($IsNext == 'Y'))
                                        <button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="FW" class="step-btn WorkFlowAction" value="FORWARD">Recommend / Forward</button>
                                        @endif

                                        <!-- @if(($IsApprove == 'Y') && ($IsNext == 'Y'))
                                        <button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="AP_FW" class="step-btn WorkFlowAction" value="APPROVE_FORWARD">Approve & Forward</button>
                                        @elseif(($IsApprove == 'Y') && ($IsNext == NULL))
                                        <button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="AP" class="step-btn" value="APPROVE">Approve</button>
                                        @elseif(($IsApprove == NULL) && ($IsNext == 'Y'))
                                        <button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="FW" class="step-btn WorkFlowAction" value="FORWARD">Recommend / Forward</button>
                                        @endif -->

                                        @if(($WorkFlowActionData['WorkFlowAction'] ?? null) === 'SU')
                                        <button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="SU" class="step-btn WorkFlowAction" value="SUBMIT">Submit</button>
                                        @endif

                                        @endif
                                        @php 
                                        if($Page == "REQ_APPLY"){
                                            if($ApplyBy == "REQ_ADMIN"){
                                                $BackUrl = "LeaveApplication.LeaveApplicationPendingAdminList";
                                            }else{
                                                $BackUrl = "LeaveApplication.LeaveApplicationPendingSelfList";
                                            }
                                        }
                                        @endphp
                                        <button type="button" id="Back" name="Back" onclick="window.location='{{ route($BackUrl)}}'" class="step-btn">Back</button>
                                    </div>
                                    <div class="row">
                                        <div class="form-step active">

                                            {{-- ── Basic Information Fieldset ── --}}
                                            <fieldset class="fieldbox">
                                                <legend class="fieldbox-legend">Basic Information</legend>
                                                <div class="fieldbox-div">

                                                    <div class="div2 label">ICNO. </div>
                                                    <div class="div2">
                                                        <input type="text" name="txt_emp_icno" id="txt_emp_icno"
                                                                class="tboxsmclass disable"
                                                                value="{{ $ICNo ?? '' }}" readonly>
                                                    </div>

                                                    <div class="div2 label pd-l-20">Name of Applicant</div>
                                                    <div class="div2">
                                                        <input type="text" id="txt_payslip_name"
                                                               class="tboxsmclass disable"
                                                               value="{{ $EmpName ?? '' }}" readonly>
                                                    </div>
                                                    <div class="div2 label pd-l-20">Designation</div>
                                                    <div class="div2">
                                                        <input type="text" id="txt_designation"
                                                               class="tboxsmclass disable"
                                                               value="{{ $Desig ?? '' }}" readonly>
                                                    </div>

                                                    <div class="row smclearrow"></div>

                                                    <div class="div2 label">Date of Birth</div>
                                                    <div class="div2">
                                                        <input type="text" id="txt_dob"
                                                               class="tboxsmclass disable"
                                                               value="{{ Helper::DisplayDateFormat($EmpDOB) ?? '' }}" readonly>
                                                    </div>
                                                    <div class="div2 label pd-l-20">Date of Joining</div>
                                                    <div class="div2">
                                                        <input type="text" id="txt_doj"
                                                               class="tboxsmclass disable"
                                                               value="{{ Helper::DisplayDateFormat($EmpDOJ) ?? '' }}" readonly>
                                                    </div>
                                                    <div class="div2 label pd-l-20">Date of Retirement</div>
                                                    <div class="div2">
                                                        <input type="text" id="txt_date_retire"
                                                               class="tboxsmclass disable"
                                                               value="{{ Helper::DisplayDateFormat($EmpRET) ?? '' }}" readonly>
                                                    </div>

                                                    <div class="row smclearrow"></div>

                                                    <div class="div2 label">Group</div>
                                                    <div class="div2">
                                                        <input type="text" id="txt_group"
                                                               class="tboxsmclass disable"
                                                               value="{{ $GroupId ?? '' }}" readonly>
                                                    </div>
                                                    <div class="div2 label pd-l-20">Division</div>
                                                    <div class="div2">
                                                        <input type="text" id="txt_div"
                                                               class="tboxsmclass disable"
                                                               value="{{ $DivId ?? '' }}" readonly>
                                                    </div>
                                                    <div class="div2 label pd-l-20">Section</div>
                                                    <div class="div2">
                                                        <input type="text" id="txt_sec"
                                                               class="tboxsmclass disable"
                                                               value="{{ $SecId ?? '' }}" readonly>
                                                    </div>

                                                    <div class="row smclearrow"></div>
                                                </div>
                                            </fieldset>

                                            <div class="row smclearrow"></div>
                                            <div class="row smclearrow"></div>

                                            {{-- ── Leave Information Table ── --}}
                                            <div class="table-container">
                                                <div class="table-wrapper">
                                                    <div class="section-header">
                                                        <span>Leave Information</span>
                                                        <div class="quick-fill">
                                                            {{-- Tooltip button: balances loaded dynamically via AJAX --}}
                                                            <button type="button" id="ViewLeaveDetails">
                                                                <div class="infoText bxcolor5 tooltip-l">
                                                                    View Leave Balance
                                                                    <div class="tooltiptext"
                                                                         style="height:auto; z-index:2; min-width:320px;">
                                                                        <div id="leaveBalanceTooltipContent">
                                                                            <em>Select an employee to view balances.</em>
                                                                        </div>
                                                                        <div class="row smclearrow">&nbsp;</div>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    {{-- Leave entry row (row 0 — the input row) --}}
                                                    <table class="attTable">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:120px;">Leave Type</th>
                                                                <th style="width:140px;">From Date</th>
                                                                <th style="width:140px;">To Date</th>
                                                                <th style="width:140px;">Applied Days</th>
                                                                <th style="width:140px;">Actual Days</th>
                                                                <th>Reason</th>
                                                                <th style="width:140px;">Action</th>
                                                                <th>Remarks</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if(isset($LeaveApplicationDetails))
                                                            @foreach($LeaveApplicationDetails as $LeaveApplication)
                                                            <tr>
                                                                <td align="center">
                                                                    <input type="hidden" class="tboxsmclass"
                                                                               id="txt_leave_type"
                                                                               name="txt_leave_type[]"
                                                                               value="{{ $LeaveApplication->leave_type_id }}" readonly>
                                                                    <input type="hidden" class="tboxsmclass"
                                                                               id="txt_leave_app_dt_id"
                                                                               name="txt_leave_app_dt_id[]"
                                                                               value="{{ $LeaveApplication->leave_application_dt_id }}" readonly>
                                                                    {{ $LeaveApplication->leaveType->leave_type_short_name }}
                                                                </td>
                                                                
                                                                <td nowrap="">{{ \Carbon\Carbon::parse($LeaveApplication->from_date)->format('d/m/Y H:i:s') }}</td>
                                                                <td nowrap="">{{ \Carbon\Carbon::parse($LeaveApplication->to_date)->format('d/m/Y H:i:s') }}</td>
                                                                <td nowrap="" align="center">{{ $LeaveApplication->applied_days }}</td>
                                                                <td nowrap="" align="center">{{ $LeaveApplication->actual_days }}</td>
                                                                <td>{{ $LeaveApplication->reason }}</td>
                                                                <td>
                                                                    <select name="cmb_action[]" id="cmb_action" class="tboxsmclass">
                                                                        
                                                                        @if(session('WcmsEmpNo') == $LeaveApplication->created_by)
                                                                            <option value="SUBMIT">Submit</option>
                                                                        @else
                                                                            <option value=""> -- Select --</option>
                                                                            <option value="APPROVE">Approve</option>
                                                                            <option value="REJECT">Reject</option>
                                                                        @endif
                                                                        
                                                                    </select>
                                                                </td>
                                                                <td><input type="text" class="tboxsmclass"
                                                                               id="txt_remarks"
                                                                               name="txt_remarks[]"
                                                                               value=""></td>
                                                               
                                                            </tr>
                                                            @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                    

                                                </div>
                                            </div>


                                            <div class="table-container">
                                                <div class="table-wrapper">
                                                    <div class="section-header">
                                                        <span>Leave Workflow Transaction</span>
                                                        
                                                    </div>

                                                    <table class="attTable">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:200px;">From</th>
                                                                <th style="width:200px;">To</th>
                                                                <th style="width:140px;">Action</th>
                                                                <th style="width:140px; text-align: center;">Action Done On</th>
                                                                <th>Remarks</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td align="center" colspan="5">No transaction found</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="5">
                                                                    <div class="label">Enter Your Remarks Here</div>
                                                                    <textarea name="txt_action_remarks" id="txt_action_remarks" class="tboxsmclass" rows="4"></textarea>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>



                                        </div>{{-- /form-step --}}
                                    </div>

                                    
                                </div>{{-- /innerdiv --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="div12" align="center">
                            <input type="hidden" name="txt_application_id" id="txt_application_id" value="@if(isset($ApplicationId)){{ encrypt($ApplicationId) }}@endif">
                            <input type="hidden" name="txt_action" id="txt_action" value="@if(isset($Action)){{ encrypt($Action) }}@endif">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}">
                            <input type="hidden" name="txt_page" id="txt_page" value="@if(isset($Page)){{ encrypt($Page) }}@endif">
                            <input type="hidden" name="txt_apply_by" id="txt_apply_by" value="@if(isset($ApplyBy)){{ encrypt($ApplyBy) }}@endif">

                            <input type="hidden" name="wf_module_code" id="wf_module_code" value="{{ encrypt('LEAVE') }}" />
                            <input type="hidden" name="txt_wf_mode" id="txt_wf_mode" />
                            <input type="hidden" name="txt_actual_emp" id="txt_actual_emp" />
                            <input type="hidden" name="txt_wf_remark" id="txt_wf_remark" />
                            <input type="hidden" name="txt_wf_emp_no" id="txt_wf_emp_no" />
                            <input type="hidden" name="txt_wf_role" id="txt_wf_role" />
                            <input type="hidden" name="txt_wf_action" id="txt_wf_action" />
                            <input type="hidden" name="txt_role_position" id="txt_role_position" />

                        </div>
                    </div>
                </blockquote>
            </div>
        </div>
    </div>
</form>

<style>
    .chosen-drop { width: 500px !important; }
    #eligibilityWarning ul { margin: 4px 0 0 16px; padding: 0; }
</style>
@include('common-workflow.workflow-process')

@endsection