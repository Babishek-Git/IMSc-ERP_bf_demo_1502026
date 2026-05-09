@extends('layouts.dashboard-master')
@section('content')
@include('layouts.partials.messages')

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
                                        <div class="row divhead" align="center">Leave Approval</div>
                                    </div>
                                </div>

                                <div class="row innerdiv">
                                    <div class="row">
                                        <div class="form-step active">

                                            

                                            {{-- ── Leave Information Table ── --}}
                                            <div class="table-container">
                                                <div class="table-wrapper">
                                                    <div class="section-header">
                                                        <span>Leave Application Waiting for Approval</span>
                                                        
                                                    </div>

                                                    {{-- Leave entry row (row 0 — the input row) --}}
                                                    <table class="attTable">
                                                        <thead>
                                                            <tr>
                                                                <th>ICNO.</th>
                                                                <th>Employee Name</th>
                                                                <th>Application No.</th>
                                                                <th>Total Days</th>
                                                                <th>Applied On</th>
                                                                <th>Reason</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if(isset($LeaveApplicationList))
                                                            @foreach($LeaveApplicationList as $LeaveApplication)
                                                            <tr>
                                                                <td>{{ $LeaveApplication->emp_no }}</td>
                                                                <td>{{ $LeaveApplication->employee->emp_name_payslip }}</td>
                                                                <td>{{ $LeaveApplication->leave_application_no }}</td>
                                                                <td>{{ $LeaveApplication->total_days }}</td>
                                                                <td>{{ $LeaveApplication->created_at }}</td>
                                                                <td></td>
                                                                <td width="110px" align="center">
                                                                    <button type="button" onclick="window.location='{{ route('leave.ViewLeaveApplication', ['action'=>encrypt('PROCESS'),'Application'=>encrypt($LeaveApplication->leave_application_id)])}}'" class="btn btn-default tuploadbtn"><i class="fa fa-eye"></i> View Details</button>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            @endif
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
                                    </div>
                                </div>{{-- /innerdiv --}}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="div12" align="center">
                            <input type="hidden" name="txt_tab"   id="txt_tab"    value="1">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}">
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

<script>
// ─────────────────────────────────────────────────────────────────────────────
// Init
// ─────────────────────────────────────────────────────────────────────────────
$(".ChosenInput").chosen();

</script>
@endsection