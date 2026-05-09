@extends('layouts.dashboard-master')
@section('content')
@include('layouts.partials.messages')
@php
    if (isset($data['Empdata'])) {
        $Empdata = $data['Empdata'];
        $ICNo    = collect($Empdata)->pluck('emp_no')->first();
        $EmpName = collect($Empdata)->pluck('emp_name_payslip')->first();
        $EmpDOB  = collect($Empdata)->pluck('emp_dob')->first();
        $EmpDOJ  = collect($Empdata)->pluck('emp_doj')->first();
        $EmpRET  = collect($Empdata)->pluck('emp_retirement_dt')->first();
        $Desig   = collect($Empdata)->pluck('designation_name')->first();
        $GroupId = collect($Empdata)->pluck('group')->first();
        $DivId   = collect($Empdata)->pluck('division_short_name')->first();
        $SecId   = collect($Empdata)->pluck('section')->first();
    }

    //$IsAdmin = in_array(session('WcmsRoleGroupCode'), ['ADMUSER', 'SUPUSER']) ? 1 : 0;
    $Page = $data['Page'] ?? NULL;
    $ApplyBy = $data['ApplyBy'] ?? NULL;
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
                                        <div class="row divhead" align="center">Leave Request Application Form</div>
                                    </div>
                                </div>

                                <div class="row innerdiv">
                                    <div class="row">
                                        <div class="form-step active">

                                            {{-- ── Basic Information Fieldset ── --}}
                                            <fieldset class="fieldbox">
                                                <legend class="fieldbox-legend">Basic Information</legend>
                                                <div class="fieldbox-div">

                                                    @if($ApplyBy == 'REQ_ADMIN')
                                                        <div class="div2 label">Employee</div>
                                                        <div class="div2">
                                                            <select name="txt_emp_icno" id="txt_emp_icno"
                                                                    class="tboxsmclass ChosenInput">
                                                                <option value="">-------- Select --------</option>
                                                                @foreach($data['UserData'] ?? [] as $u)
                                                                    <option value="{{ $u->emp_no }}">
                                                                        {{ $u->emp_first_name }} -- {{ $u->emp_no }} -- {{ $u->designation_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @else
                                                        <div class="div2 label">IC No</div>
                                                        <div class="div2">
                                                            <input type="text" name="txt_emp_icno" id="txt_emp_icno"
                                                                   class="tboxsmclass disable"
                                                                   value="{{ $ICNo ?? '' }}" readonly>
                                                        </div>
                                                    @endif

                                                    <div class="div2 label pd-l-20">Name</div>
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
                                                               value="{{ $EmpDOB ?? '' }}" readonly>
                                                    </div>
                                                    <div class="div2 label pd-l-20">Date of Joining</div>
                                                    <div class="div2">
                                                        <input type="text" id="txt_doj"
                                                               class="tboxsmclass disable"
                                                               value="{{ $EmpDOJ ?? '' }}" readonly>
                                                    </div>
                                                    <div class="div2 label pd-l-20">Date of Retirement</div>
                                                    <div class="div2">
                                                        <input type="text" id="txt_date_retire"
                                                               class="tboxsmclass disable"
                                                               value="{{ $EmpRET ?? '' }}" readonly>
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
                                                                         style="height:auto; z-index:9999; min-width:320px;">
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
                                                                <th style="width:220px;">Leave Type</th>
                                                                <th style="width:200px;">Balance</th>
                                                                <th style="width:140px;">From Date</th>
                                                                <th style="width:140px;">To Date</th>
                                                                <th style="width:130px;">
                                                                    No. of Days
                                                                    <span id="dayCalcNote"
                                                                          style="font-size:10px; font-weight:normal; color:#888;"></span>
                                                                </th>
                                                                <th>Reason</th>
                                                                <th style="width:30px;">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="attendanceTableBody">
                                                            <tr id="inputRow">
                                                                <td>
                                                                    <select class="tboxsmclass ChosenInput"
                                                                            name="cmb_leave_type_0"
                                                                            id="cmb_leave_type_0">
                                                                        <option value="">-- Select --</option>
                                                                        @foreach($data['LeaveTypeData'] ?? [] as $lt)
                                                                            <option value="{{ $lt->leave_type_id }}"
                                                                                    data-code="{{ $lt->leave_type_code }}">
                                                                                {{ $lt->leave_type_name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <div class="inp-form-group">
                                                                        <span id="leave_bal_text_0">&emsp;&emsp;&emsp;</span>
                                                                        <input type="text" class="tboxsmclass"
                                                                               id="txt_balance_leave_0"
                                                                               name="txt_balance_leave_0"
                                                                               value="" readonly>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="tboxsmclass datepicker"
                                                                           id="txt_from_date_0"
                                                                           name="txt_from_date_0" value="">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="tboxsmclass datepicker"
                                                                           id="txt_to_date_0"
                                                                           name="txt_to_date_0" value="">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="tboxsmclass"
                                                                           id="txt_no_of_days_0"
                                                                           name="txt_no_of_days_0" value="" readonly>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="tboxsmclass"
                                                                           id="txt_reason_0"
                                                                           name="txt_reason_0" value="">
                                                                </td>
                                                                <td align="center">
                                                                    <i class="fa fa-plus-square sqadd ptr"
                                                                       id="AddLeave"
                                                                       style="font-size:24px;" title="Add Leave Row"></i>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                    {{-- Eligibility warning panel --}}
                                                    <div id="eligibilityWarning"
                                                         style="display:none; color:#c0392b; padding:8px; margin-top:6px; background:#fdecea; border-radius:4px;">
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="row smclearrow"></div>
                                            <div class="row smclearrow"></div>

                                        </div>{{-- /form-step --}}
                                    </div>

                                    <div class="row" align="center">
                                        <button type="submit" id="SaveApplication"
                                                name="SaveApplication" class="step-btn" value="Save">
                                            SAVE
                                        </button>
                                        @php 
                                        if($Page == "REQ_APPLY"){
                                            if($ApplyBy == "REQ_ADMIN"){
                                                $BackUrl = "LeaveApplication.LeaveApplicationPendingAdminList";
                                            }else{
                                                $BackUrl = "LeaveApplication.LeaveApplicationPendingSelfList";
                                            }
                                        }
                                        @endphp
                                        <button type="button" id="Back" name="Back" onclick="window.location='{{ route($BackUrl)}}'" class="backbutton">Back</button>
                                    </div>
                                </div>{{-- /innerdiv --}}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="div12" align="center">
                            <input type="hidden" name="txt_tab"   id="txt_tab"    value="1">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}">
                            <input type="hidden" name="txt_page" id="txt_page" value="{{ encrypt($Page)}}">
                            <input type="hidden" name="txt_apply_by" id="txt_apply_by" value="{{ encrypt($ApplyBy)}}">
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
    .tooltiptext {
        position: fixed;
        z-index: 9999; /* 🔥 increase */
    }
    .table-container {
        overflow: visible !important;
    }
</style>

<script>
// ─────────────────────────────────────────────────────────────────────────────
// Init
// ─────────────────────────────────────────────────────────────────────────────
$(".ChosenInput").chosen();

var LeaveIndex = 1; // counter for saved rows

// ─────────────────────────────────────────────────────────────────────────────
// Admin: Employee change → populate fields + load all balances for tooltip
// ─────────────────────────────────────────────────────────────────────────────
$("body").on("change", "#txt_emp_icno", function () {
    var EmpNo = $(this).val();
    if (!EmpNo) return;

    $.ajax({
        type: 'POST',
        url: "{{ route('employee.GetEmployeeData') }}",
        data: { "_token": "{{ csrf_token() }}", 'EmpNo': EmpNo },
        success: function (data) {
            if (data && data['EmpData']) {
                $.each(data['EmpData'], function (i, el) {
                    $("#txt_payslip_name").val(el.emp_name_payslip);
                    $("#txt_designation").val(el.designation_name);
                    $("#txt_dob").val(el.emp_dob);
                    $("#txt_doj").val(el.emp_doj);
                    $("#txt_date_retire").val(el.emp_retirement_dt);
                    $("#txt_group").val(el.group);
                    $("#txt_div").val(el.division_short_name);
                    $("#txt_sec").val(el.section);
                });
                // Load all leave balances for tooltip
                loadAllLeaveBalances(EmpNo);
            } else {
                BootstrapDialog.alert("Employee not found. Please verify the Employee No.");
            }
        }
    });
});

// ─────────────────────────────────────────────────────────────────────────────
// Leave Type change → fetch balance for selected type
// ─────────────────────────────────────────────────────────────────────────────
$("body").on("change", "#cmb_leave_type_0", function () {
	var EmpNo = $("#txt_emp_icno").val();
    
    var LeaveTypeId = $(this).val();
    var EmpNo       = $("#txt_emp_icno").val();
    var leaveCode   = $(this).find("option:selected").data("code") || '';

    // Reset days and balance
    $("#txt_no_of_days_0").val('');
    $("#txt_balance_leave_0").val('');
    $("#leave_bal_text_0").html('&emsp;&emsp;&emsp;');
    $("#dayCalcNote").text('');
    $("#eligibilityWarning").hide().html('');

	if (EmpNo) { loadAllLeaveBalances(EmpNo); }

    /*if (!LeaveTypeId || !EmpNo) return;

    $.ajax({
        type: 'POST',
        url: "{{ route('LeaveBalance.GetEmpLeaveBalance') }}",
        data: {
            "_token": "{{ csrf_token() }}",
            'EmpNo': EmpNo,
            'LeaveType': LeaveTypeId,
            'LeaveTypeMode': 'SINGLE'
        },
        success: function (data) {
            if (data && data['not_eligible']) {
                showEligibilityWarning(data['message']);
                return;
            }
            if (data && data['LeaveBalData']) {
                $.each(data['LeaveBalData'], function (i, el) {
                    if (el.leave_bal_in_year !== null && el.leave_bal_in_year !== undefined) {
                        $("#txt_balance_leave_0").val(el.leave_bal_in_year);
                        $("#leave_bal_text_0").text('per year:');
                    } else if (el.leave_bal_in_service !== null && el.leave_bal_in_service !== undefined) {
                        $("#txt_balance_leave_0").val(el.leave_bal_in_service);
                        $("#leave_bal_text_0").text('in service:');
                    }
                });
                // Recalculate days if dates are already filled
                recalculateDays();
            } else {
                BootstrapDialog.alert("Could not retrieve leave balance.");
                $("#txt_balance_leave_0").val('');
            }
        }
    });*/
});

// ─────────────────────────────────────────────────────────────────────────────
// Date change → trigger server-side day calculation
// ─────────────────────────────────────────────────────────────────────────────
$(document).on('change', '#txt_from_date_0, #txt_to_date_0', function () {
    recalculateDays();
});

function recalculateDays() {
    var FromDate    = $("#txt_from_date_0").val();
    var ToDate      = $("#txt_to_date_0").val();
    var LeaveTypeId = $("#cmb_leave_type_0").val();
    var BalanceRaw  = $("#txt_balance_leave_0").val().trim();
    var Balance     = BalanceRaw !== '' ? parseFloat(BalanceRaw) : null; // null = unknown, skip check

    $("#txt_no_of_days_0").val('');

    if (!FromDate || !ToDate || !LeaveTypeId) return;

    $.ajax({
        type: 'POST',
        url: "{{ route('leave.calculateDays') }}",
        data: {
            "_token": "{{ csrf_token() }}",
            'leave_type_id': LeaveTypeId,
            'from_date': FromDate,   // already dd/mm/yyyy — controller now handles it
            'to_date': ToDate
        },
        success: function (data) {
            if (!data.success) {
                BootstrapDialog.alert("Error calculating days: " + data.message);
                return;
            }

            var Days = data.days;
            $("#dayCalcNote").text(data.note ? '(' + data.note + ')' : '');

            if (Days <= 0) {
                BootstrapDialog.alert("The selected date range results in 0 working days after applying leave rules.");
                $("#txt_from_date_0, #txt_to_date_0").val('');
                return;
            }

            // Only check balance if we actually have a balance value
            if (Balance !== null && Balance > 0 && Days > Balance) {
                var BalanceLabel = $("#leave_bal_text_0").text().trim();
                BootstrapDialog.alert(
                    "Insufficient balance.\nRequired: " + Days + " days | Available: " + Balance + " days (" + BalanceLabel + ")"
                );
                $("#txt_to_date_0").val('');
                $("#txt_no_of_days_0").val('');
                return;
            }

            $("#txt_no_of_days_0").val(Days);
        },
        error: function (xhr) {
            var msg = xhr.responseJSON && xhr.responseJSON.message
                ? xhr.responseJSON.message
                : 'Unable to calculate leave days.';
            BootstrapDialog.alert(msg);
        }
    });
}

// ─────────────────────────────────────────────────────────────────────────────
// Add Leave Row ("+") button
// ─────────────────────────────────────────────────────────────────────────────
$(document).on('click', '#AddLeave', function () {
    var LeaveTypeId   = $('#cmb_leave_type_0').val();
    var LeaveTypeName = $('#cmb_leave_type_0 option:selected').text().trim();
    var BalanceLeave  = $('#txt_balance_leave_0').val();
    var FromDate      = $('#txt_from_date_0').val();
    var ToDate        = $('#txt_to_date_0').val();
    var NoOfDays      = $('#txt_no_of_days_0').val();
    var Reason        = $('#txt_reason_0').val();
    var LeaveBalText  = $('#leave_bal_text_0').text();

    // Validation before adding
    if (!LeaveTypeId) {
        BootstrapDialog.alert('Please select a Leave Type.'); return;
    }
    if (!FromDate || !ToDate) {
        BootstrapDialog.alert('Please select From Date and To Date.'); return;
    }
    if (!NoOfDays || parseInt(NoOfDays) <= 0) {
        BootstrapDialog.alert('No. of Days is 0 or not calculated. Please re-select the dates.'); return;
    }

    // Check for duplicate leave type in already-added rows
    var duplicate = false;
    $('#attendanceTableBody input[name="txt_leave_type_id[]"]').each(function () {
        if ($(this).val() == LeaveTypeId) { duplicate = true; }
    });
    if (duplicate) {
        BootstrapDialog.alert('This leave type has already been added. Please edit or remove the existing row.');
        return;
    }

    var row = `
        <tr>
            <td>
                <input type="text"   class="tboxsmclass" value="${escHtml(LeaveTypeName)}" readonly>
                <input type="hidden" name="txt_leave_type_id[]" value="${escHtml(LeaveTypeId)}">
            </td>
            <td>
                <div class="inp-form-group">
                    <span class="balLabel">${escHtml(LeaveBalText)}</span>
                    <input type="text" class="tboxsmclass" name="txt_balance_leave[]"
                           value="${escHtml(BalanceLeave)}" readonly>
                </div>
            </td>
            <td><input type="text" name="txt_from_date[]" class="tboxsmclass" value="${escHtml(FromDate)}" readonly></td>
            <td><input type="text" name="txt_to_date[]"   class="tboxsmclass" value="${escHtml(ToDate)}"   readonly></td>
            <td><input type="text" name="txt_no_of_days[]" class="tboxsmclass" value="${escHtml(NoOfDays)}" readonly></td>
            <td><input type="text" name="txt_reason[]"    class="tboxsmclass" value="${escHtml(Reason)}"   readonly></td>
            <td align="center">
                <i class="fa fa-times-circle sqdel ptr DeleteRow" style="font-size:24px;"
                   title="Remove this row"></i>
            </td>
        </tr>`;

    $("#attendanceTableBody").append(row);

    // Reset input row
    $('#cmb_leave_type_0').val('').trigger("chosen:updated");
    $('#txt_balance_leave_0').val('');
    $('#txt_from_date_0').val('');
    $('#txt_to_date_0').val('');
    $('#txt_no_of_days_0').val('');
    $('#txt_reason_0').val('');
    $('#leave_bal_text_0').html('&emsp;&emsp;&emsp;');
    $('#dayCalcNote').text('');
    $('#eligibilityWarning').hide().html('');

    LeaveIndex++;
});

// ─────────────────────────────────────────────────────────────────────────────
// Delete added row
// ─────────────────────────────────────────────────────────────────────────────
$(document).on('click', '.DeleteRow', function () {
    $(this).closest('tr').remove();
});

// ─────────────────────────────────────────────────────────────────────────────
// Load all leave balances into tooltip table
// ─────────────────────────────────────────────────────────────────────────────
function loadAllLeaveBalances(EmpNo) {
    $("#leaveBalanceTooltipContent").html('<em>Loading...</em>');
	var leaveCode   = $('#cmb_leave_type_0').find("option:selected").data("code") || '';

    $.ajax({
        type: 'POST',
        url: "{{ route('leave.allBalances') }}",
        data: { "_token": "{{ csrf_token() }}", 'EmpNo': EmpNo },
        success: function (data) {
            var rows = data['AllLeaveBalData'] || [];
            if (!rows.length) {
                $("#leaveBalanceTooltipContent").html('<em>No leave data found.</em>');
                return;
            }
            var html = '<table style="width:100%; font-size:12px;">' +
                       '<thead><tr><th>Leave</th><th>Total</th><th>Balance</th><th>Basis</th></tr></thead><tbody>';
            $.each(rows, function (i, r) {
                html += '<tr>' +
                        '<td>' + escHtml(r.leave_type_code) + '</td>' +
                        '<td>' + r.total + '</td>' +
                        '<td>' + r.balance + '</td>' +
                        '<td>' + escHtml(r.label) + '</td>' +
                        '</tr>';
						console.log(leaveCode+" = "+r.leave_type_code)
						if(leaveCode == r.leave_type_code){
							$("#txt_balance_leave_0").val(r.balance);
                        	//$("#leave_bal_text_0").text('in service:');
						}
            });
            html += '</tbody></table>';
            $("#leaveBalanceTooltipContent").html(html);
        },
        error: function () {
            $("#leaveBalanceTooltipContent").html('<em>Could not load balances.</em>');
        }
    });
}

// For non-admin users: load balances on page load
@if($ApplyBy == 'REQ_SELF')
$(document).ready(function () {
    var EmpNo = $("#txt_emp_icno").val();
    if (EmpNo) { loadAllLeaveBalances(EmpNo); }
});
@endif

// ─────────────────────────────────────────────────────────────────────────────
// Helpers
// ─────────────────────────────────────────────────────────────────────────────
function showEligibilityWarning(msg) {
    $("#eligibilityWarning")
        .html('<strong>Not eligible:</strong> ' + escHtml(msg))
        .show();
}

function escHtml(str) {
    if (str === null || str === undefined) return '';
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}
</script>
@endsection