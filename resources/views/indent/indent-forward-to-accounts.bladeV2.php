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
                                        <div class="row divhead" align="center">Indent Application Waiting for Approval</div>
                                    </div>
                                </div>

                                <div class="row innerdiv">
                                    <div class="row">
                                        <div class="form-step active">

                                            

                                            {{-- ── Indent Information Table ── --}}
                                            <div class="table-container">
                                                <div class="table-wrapper">
                                                    <div class="section-header">
                                                        <span>Indent Application Waiting for Approval</span>
                                                        
                                                    </div>

                                                    {{-- Indent entry row (row 0 — the input row) --}}
                                                    <table class="attTable">
                                                        <thead>
                                                            <tr>
                                                                <th>SNo.</th>
                                                                <th>Indent No.</th>
                                                                <th>Indent Description</th>
                                                                <th>Indent Created By</th>
                                                                <th>Indent Date</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if(isset($data['Indentdata']))
																@foreach($data['Indentdata'] as $Indentdata)
																	@if($Indentdata ->to_emp_no == session('WcmsEmpNo'))
																		<tr>
																			<td>{{ $loop->iteration  }}</td>
																			<td>{{ $Indentdata->indent_no}}</td>
																			<td>{{ $Indentdata->indent_descripton }}</td>
																			<td>{{ $Indentdata->emp_name_payslip }}</td>
																			<td>{{ Helper::DisplayDateFormat($Indentdata->indent_date) }}</td>
																			<td width="110px" align="center">
																				<button type="button" id="btn_edit" value=" Edit" onclick="window.location='{{ route('indent.indent-creation',['EditId' => encrypt($Indentdata->indent_id),'page' => encrypt('PROCESS')]) }}'" class="btn btn-default tuploadbtn"><i class="fa fa-eye"></i> View Details</button>
																			</td>
																		</tr>
																	@endif	
																@endforeach
															@else	
																<tr><td colspan="7">No data found...</td></tr>
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