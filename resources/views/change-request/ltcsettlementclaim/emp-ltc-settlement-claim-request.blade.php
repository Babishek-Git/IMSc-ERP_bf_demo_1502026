@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
 if(isset($data['Empdata'])){
	$Empdata     = $data['Empdata'];
	$ICNo        = collect($Empdata)->pluck('emp_no')->first();
	$EmpName     = collect($Empdata)->pluck('emp_name_payslip')->first();
	$EmpDOB      = collect($Empdata)->pluck('emp_dob')->first();
	$EmpDOJ      = collect($Empdata)->pluck('emp_doj')->first();
	$EmpRET      = collect($Empdata)->pluck('emp_retirement_dt')->first();
	$Desig       = collect($Empdata)->pluck('designation_name')->first();
	$GroupId     = collect($Empdata)->pluck('group')->first();
	$DivId       = collect($Empdata)->pluck('division_short_name')->first();
	$SecId       = collect($Empdata)->pluck('section')->first();
	$homeTown    = collect($Empdata)->pluck('emp_hometown')->first();
}
if(isset($data['Payleveldata'])){
	$Payleveldata  = $data['Payleveldata'];
	$Paylevel      = collect($Payleveldata)->pluck('pay_level')->first();
	$BasicSalary   = collect($Payleveldata)->pluck('basic_salary')->first();
}

if(isset($data['Familydata'])){
	$Familydata  	= $data['Familydata'];
}

if(isset($data['Page'])){
	$Page = $data['Page'];
	
}else{
	$Page = NULL;
}

if(isset($data['EditClaimData']))
{
	$EditClaimData  	= $data['EditClaimData'];
	$LtcAdvData     	= $data['LtcAdvData'];
	$Leaveexits     	= $data['Leaveexits'];
	$selectedFamilyIds  = $data['selectedFamilyIds'];
}else{
	$EditClaimData 		= NULL;
	$LtcAdvData    		= NULL;
	$Leaveexits    		= NULL;
	$selectedFamilyIds  = NULL;
}

$isReadOnly = ($ICNo != session('WcmsEmpNo'));

@endphp
<style>
	.leaveType{
		background-color:#ffe5e5;
		border-left:5px solid #d9534f;
		padding:10px 15px;
		color:#a94442;
		margin:10px 0;
	}
	.form-readonly {
		pointer-events: none;
		opacity: 0.9;
	}

	.form-readonly input,
	.form-readonly select,
	.form-readonly textarea {
		background-color: #f5f5f5 !important;
		cursor: not-allowed;
	}
</style>

<form action="" method="post" enctype="multipart/form-data" name="form" id="LTCForm">
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1" style="overflow:auto">
					<div class="container">
						<div class="row plr">
              				<!-- <div class="div1"></div> -->
							<div class="div12 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">LTC Final Claim Request Form</div></div></div>
								<div class="row innerdiv">
									<div class="row"> 
										<div class="form-step active"> 
											<div class="row" align="right">
												@if(!empty($selectedFamilyIds) && in_array($ICNo, $selectedFamilyIds))
													@if($Leaveexits != null && $Leaveexits->isNotEmpty())
														<button type="buttom" class="rm-new-emp-btn" style="background-color: green;">Leave Applied</button>
													@else
														@if($Leaveexits)
														<button type="buttom" class="rm-new-emp-btn" style="background-color: red;">Leave Not Applied</button>
														@endif
													@endif
												@endif
												@php 
													if(session('WcmsEmpNo') != $ICNo){
														$BackUrl = 'change-request.ltc-settlement-change-request-pending-list'; 
													}else{
														$BackUrl = 'change-request.ltc-settlement-change-request-list'; 
													}
												@endphp
												<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" Back " onClick="window.location='{{route($BackUrl)}}'" />
												<button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Save">Save</button>
											</div>
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Basic information</legend>
												<div class="fieldbox-div">
													<div class="div1 label label">IC No</div>
													<div class="div1"><input type="text" name="txt_emp_icno" id="txt_emp_icno" class="tboxsmclass" value="@if(isset($ICNo)){{$ICNo}}@endif" readonly></div>
													<div class="div1 label pd-l-20">Name</div>
													<div class="div1"><input type="text" name="txt_payslip_name" id="txt_payslip_name" class="tboxsmclass" value="@if(isset($EmpName)){{$EmpName}}@endif" readonly></div>
													<div class="div1 label pd-l-20">Designation</div>
													<div class="div2"><input type="text" name="txt_designation" id="txt_designation" class="tboxsmclass" value="@if(isset($Desig)){{$Desig}}@endif" readonly></div>
													<div class="div1 label pd-l-20">Date of Birth</div>
													<div class="div1"><input type="text" name="txt_dob" id="txt_dob" class="tboxsmclass" value="@if(isset($EmpDOB)){{Helper::DisplayDateFormat($EmpDOB)}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Date of Joining</div>
													<div class="div1"><input type="text" name="txt_doj" id="txt_doj" class="tboxsmclass" value="@if(isset($EmpDOJ)){{Helper::DisplayDateFormat($EmpDOJ)}}@endif" readonly></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="div1 label label">Date of Retirement</div>
													<div class="div1"><input type="text" name="txt_date_retire" id="txt_date_retire" class="tboxsmclass" value="@if(isset($EmpDOJ)){{Helper::DisplayDateFormat($EmpDOJ)}}@endif" readonly></div>
													<div class="div1 label pd-l-20">Level</div>
													<div class="div1"><input type="text" name="txt_level" id="txt_level" class="tboxsmclass" value="@if(isset($Paylevel)){{$Paylevel}}@endif" readonly></div>
													<div class="div1 label pd-l-20">Basic Pay <span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_basic_pay" id="txt_basic_pay" class="tboxsmclass" value="@if(isset($BasicSalary)){{$BasicSalary}}@endif"></div>
													<div class="div2 label pd-l-20">Home Town (AS Per Recorded In Service Book)<span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_next_incr_dt" id="txt_next_incr_dt" class="tboxsmclass" value="@if(isset($homeTown)){{$homeTown}}@endif"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											@if(isset($data['Leaveexits']))
												@foreach($data['Leaveexits'] as $Leaveexits)
													<fieldset class="fieldbox">
														<legend class="fieldbox-legend">Leave Details</legend>
														<div class="fieldbox-div">
															<div class="row smclearrow"></div>
															<div class="row smclearrow"></div>
															<div class="row smclearrow"></div>
															<div class="fieldbox-div">
																<table class="formtable" align="center" id="family_table" width="100%">
																	<thead> 
																		<tr>
																			<th>#</th>
																			<th>Leave type</th>
																			<th>From</th>
																			<th>To</th>
																			<th>No of days</th>
																		</tr>
																	</thead>
																	<tbody>
																		<td>{{ $loop->iteration + 1}}</td>
																		<td>{{ $Leaveexits->leave_type_code}}</td>
																		<td>{{ \Carbon\Carbon::parse($Leaveexits->from_date)->format('d/m/Y') }}</td>
																		<td>{{ \Carbon\Carbon::parse($Leaveexits->to_date)->format('d/m/Y') }}</td>
																		<td>{{ $Leaveexits->actual_days}}</td>
																	</tbody>
																</table>
																<div class="row smclearrow"></div>
																<div class="row smclearrow"></div>
																<div class="row smclearrow"></div>
															</div>
														</div>
													</fieldset>
												@endforeach
											@endif
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Spouse Details</legend>
												<div class="fieldbox-div {{ $isReadOnly ? 'form-readonly' : '' }}">
													<div class="div4 label label">
														Whether spouse is employed ? <span class="reqindi">*</span>
													</div>
													<div class="div2 label">
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input {{!empty($EditClaimData) ? $EditClaimData->spouse_employed == "Y" ? "checked" : "" : ""}} 
																	id="rad_spouse_employed_yes" name="rad_spouse_employed" type="radio" value="Y"/>
																<label for="rad_spouse_employed_yes" style="padding:3px 0px; width:100%"> &nbsp;Yes</label>
															</div>
														</div>
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_spouse_employed_no" name="rad_spouse_employed" type="radio" value="N" 
																	{{!empty($EditClaimData) ? $EditClaimData->spouse_employed == "N" ? "checked" : "" : ""}}/>
																<label for="rad_spouse_employed_no" style="padding:3px 0px; width:100%"> &nbsp;No</label>
															</div>
														</div>
													</div>
													<div class="div3 label SpouseLtc hide">Whether spouse entitled to LTC </div> 
													<div class="div3 SpouseLtc hide">
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_entitle_LTC_yes" name="rad_entitle_LTC" type="radio" value="Y" 
																	{{!empty($EditClaimData) ? $EditClaimData->entitle_ltc == "Y" ? "checked" : "" : ""}}/>
																<label for="rad_entitle_LTC_yes" style="padding:3px 0px; width:100%"> &nbsp;Yes</label>
															</div>
														</div>
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_entitle_LTC_no" name="rad_entitle_LTC" type="radio" value="N" 
																	{{!empty($EditClaimData) ? $EditClaimData->entitle_ltc == "N" ? "checked" : "" : ""}}/>
																<label for="rad_entitle_LTC_no" style="padding:3px 0px; width:100%"> &nbsp;No</label>
															</div>
														</div>
													</div>
												</div>
												<div class="row smclearrow"></div>
												<div class="row smclearrow"></div>
												<div class="row smclearrow"></div>
											</fieldset>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Concessions Details</legend>
												<div class="fieldbox-div {{ $isReadOnly ? 'form-readonly' : '' }}">
													<div class="row smclearrow"></div>
													<div class="div4 label label">
														Whether the concession is to be availed for home town ? <span class="reqindi">*</span>
													</div>
													<div class="div2 label">
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_visiting_yes" name="rad_visiting" type="radio" value="Y" 
																	{{!empty($EditClaimData) ? $EditClaimData->visiting_home == "Y" ? "checked" : "" : ""}}/>
																<label for="rad_visiting_yes" style="padding:3px 0px; width:100%"> &nbsp;Yes</label>
															</div>
														</div>
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_visiting_no" name="rad_visiting" type="radio" value="N" 
																	{{!empty($EditClaimData) ? $EditClaimData->visiting_home == "N" ? "checked" : "" : ""}}/>
																<label for="rad_visiting_no" style="padding:3px 0px; width:100%"> &nbsp;No</label>
															</div>
														</div>
													</div>
													<div class="div3 label YearLtc hide">Block for Which LTC is to be availed Year </div> 
													<div class="div3 YearLtc hide"><input type="text" name="year_ltc"  id="year_ltc" class="tboxsmclass" 
														value="{{!empty($EditClaimData) ? $EditClaimData->year_ltc ? $EditClaimData->year_ltc : '' : ''}}">
													</div>
													<div class="row smclearrow"></div>
													<div id="visiting_home"></div>
												   <div class="div4 label label">
														"Anywhere in India" the place to visited <span class="reqindi">*</span>
													</div>
													<div class="div2 label">
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_india_yes" name="rad_india" type="radio" value="Y" 
																 {{!empty($EditClaimData) ? $EditClaimData->visiting_india == "Y" ? "checked" : "" : ""}}/>
																<label for="rad_india_yes" style="padding:3px 0px; width:100%"> &nbsp;Yes</label>
															</div>
														</div>
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_india_no" name="rad_india" type="radio" value="N" 
																	{{!empty($EditClaimData) ? $EditClaimData->visiting_india == "N" ? "checked" : "" : ""}}/>
																<label for="rad_india_no" style="padding:3px 0px; width:100%"> &nbsp;No</label>
															</div>
														</div>
													</div>
													<div class="div3 label Place hide">Block for which to be availed.</div> 
													<div class="div3 Place hide">
														<input type="text" name="place_visited"  id="place_visited" class="tboxsmclass" 
														value="{{!empty($EditClaimData) ? $EditClaimData->place_visited ? $EditClaimData->place_visited : '' : ''}}">
													</div>
													<div class="row smclearrow"></div>
													<div id="Visiting-hometown"></div>
													<div class="row smclearrow"></div>
													<div class="div4 label label">
														Leave Enhancement for 10 days of EL<span class="reqindi">*</span>
													</div>
													<div class="div2 label">
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input id="leave_enhancement_yes" name="rad_leaveenhance" type="radio" value="Y" 
																	{{!empty($EditClaimData) ? $EditClaimData->leave_enhancement == "Y" ? "checked" : "" : ""}}/>
																<label for="leave_enhancement_yes" style="padding:3px 0px; width:100%"> &nbsp;Yes</label>
															</div>
														</div>
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input id="leave_enhancement_no" name="rad_leaveenhance" type="radio" value="N" 
																	{{!empty($EditClaimData) ? $EditClaimData->leave_enhancement == "N" ? "checked" : "" : ""}}/>
																<label for="leave_enhancement_no" style="padding:3px 0px; width:100%"> &nbsp;No</label>
															</div>
														</div>
													</div>
													<div class="div3 label ELdays hide">No of EL days</div> 
													<div class="div3 ELdays hide">
														<input type="number" name="el_days" id="el_days" class="tboxsmclass" 
															value="{{!empty($EditClaimData) ? $EditClaimData->el_days ? $EditClaimData->el_days : '' : ''}}">
													</div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Family Details</legend>
												<div class="fieldbox-div {{ $isReadOnly ? 'form-readonly' : '' }}">
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="fieldbox-div">
														<table class="formtable" align="center" id="family_table" width="100%">
															<thead> 
																<tr>
																	<th>#</th>
																	<th>Name</th>
																	<th>RelationShip</th>
																	<th>Age</th>
																	<th>Select</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>1</td>
																	<td>{{ $EmpName}}</td>
																	<td>Self</td>
																	<td>{{ $EmpDOB ? \Carbon\Carbon::parse($EmpDOB)->age : '' }}</td>
																	<td>
																		<input type="checkbox" style="display: block;" name="chk_cout_rel[]" id="chk_cout_rel_self" class='chk_rel' value="{{$ICNo}}"
																		{{ in_array($ICNo, $selectedFamilyIds ?? []) ? 'checked' : '' }}>
																	</td>
																</tr>
																@if(isset($data['Familydata']))
																	@foreach($data['Familydata'] as $Familydata)
																		<tr>
																			<td>{{ $loop->iteration + 1}}</td>
																			<td>{{ $Familydata->fam_member_name }}</td>
																			<td>{{ $Familydata->ShowRelationship($Familydata->fam_relationship_id) }}</td>
																			<td>{{ $Familydata->fam_member_dob ? \Carbon\Carbon::parse($Familydata->fam_member_dob)->age : '' }}</td>
																			<td>
																				<input type="checkbox" name="chk_cout_rel[]" id="chk_cout_rel" class="chk_rel" value="{{$Familydata->family_det_id}}"
																				{{ in_array($Familydata->family_det_id, $selectedFamilyIds ?? []) ? 'checked' : '' }}>
																			</td>
																		</tr>
																	@endforeach
																@endif
															</tbody>
														</table>
														<div class="rm-empty" id="rm-emptyMsg" style="display:none">No records found.</div>
													</div>
												</div>
												<div class="row smclearrow"></div>
												<iv class="row smclearrow"></div>
												<div class="row smclearrow"></div>
											</fieldset
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Travel Details</legend>
												<div class="fieldbox-div">
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="fieldbox-div">
														<table class="formtable" align="center" id="travel_table" width="100%">
															<thead> 
																<tr>
																	<th colspan="3">Departure</th>
																	<th colspan="3">Arrival</th>
																	<th rowspan="2">Distance</th>
																	<th rowspan="2">Mode Of Travel</th>
																	<th rowspan="2">Class Of Accommodation Used</th>
																	<th rowspan="2">No. Of Fares</th>
																	<th rowspan="2">Fare Paid</th>
																	<th rowspan="2">Action</th>
																</tr>
																<tr>
																	<th>Date</th>
																	<th>Time</th>
																	<th>From Place</th>
																	<th>Date</th>
																	<th>Time</th>
																	<th>To Place</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td><input type="text" name="txt_departure_dt_0" id="txt_departure_dt_0" class="tboxsmclass datepicker" value=""></td>
																	<td><input type="time" name="txt_departure_time_0" id="txt_departure_time_0" class="tboxsmclass" value=""></td>
																	<td><input type="text" name="txt_departure_from_0" id="txt_departure_from_0" class="tboxsmclass" value=""></td>
																	<td><input type="text" name="txt_arraival_dt_0" id="txt_arraival_dt_0" class="tboxsmclass datepicker" value=""></td>
																	<td><input type="time" name="txt_arraival_time_0" id="txt_arraival_time_0" class="tboxsmclass" value=""></td>
																	<td><input type="text" name="txt_arraival_from_0" id="txt_arraival_from_0" class="tboxsmclass" value=""></td>
																	<td><input type="text" name="txt_distance_0" id="txt_distance_0" class="tboxsmclass" value=""></td>
																	<td>
																		<!-- <input type="text" name="txt_travel_mode_0" id="txt_travel_mode_0" class="tboxsmclass" value=""> -->
																		<select name="cmb_travel_mode_0" id="cmb_travel_mode_0" class="tboxsmclass ChosenInput">
																			<option value="">Select</option>
																			<option value="Air">Air</option>
																			<option value="Bus">Bus</option>
																			<option value="Train">Train</option>
																		</select>
																	</td>
																	<td><input type="text" name="txt_accomod_used_0" id="txt_accomod_used_0" class="tboxsmclass" value=""></td>
																	<td><input type="text" name="txt_no_of_amount_0" id="txt_no_of_amount_0" class="tboxsmclass" value=""></td>
																	<td><input type="text" name="txt_adv_amount_0" id="txt_adv_amount_0" class="tboxsmclass" value=""></td>
																	<td align="center"><i class="fa fa-plus-square sqadd ptr inp disable" id="travel_add_record" style="font-size:24px;"></i></td>
																</tr>
																@if(!empty($LtcAdvData))
    																@foreach($LtcAdvData as $key => $data)
																		<tr>
																			<input type="hidden" name="detail_id[]" value="{{ $data->ltc_detail_id ?? '' }}">
																			<td><input type="text" name="txt_departure_dt[]" id="txt_departure_dt_{{$key+1}}" class="tboxsmclass datepicker" 
																				value="{{ !empty($data->departure_dt) ? \Carbon\Carbon::parse($data->departure_dt)->format('d/m/Y') : '' }}"></td>
																			<td><input type="time" name="txt_departure_time[]" id="txt_departure_time_{{$key+1}}" class="tboxsmclass" 
																				value="{{!empty($data->departure_time) ? $data->departure_time : ''}}"></td>
																			<td><input type="text" name="txt_departure_from[]" id="txt_departure_from_{{$key+1}}" class="tboxsmclass" 
																				value="{{!empty($data->departure_from) ? $data->departure_from : ''}}"></td>
																			<td><input type="text" name="txt_arraival_dt[]" id="txt_arraival_dt_0" class="tboxsmclass datepicker" 
																				value="{{ !empty($data->arraival_dt) ? \Carbon\Carbon::parse($data->arraival_dt)->format('d/m/Y') : '' }}"></td>
																			<td><input type="time" name="txt_arraival_time[]" id="txt_arraival_time_{{$key+1}}" class="tboxsmclass" 
																				value="{{!empty($data->arraival_time) ? $data->arraival_time : ''}}"></td>
																			<td><input type="text" name="txt_arraival_from[]" id="txt_arraival_from_{{$key+1}}" class="tboxsmclass" 
																				value="{{!empty($data->arraival_from) ? $data->arraival_from : ''}}"></td>
																			<td><input type="text" name="txt_distance[]" id="txt_distance_{{$key+1}}" class="tboxsmclass" 
																				value="{{!empty($data->distance) ? $data->distance : ''}}"></td>
																			<td><input type="text" name="cmb_travel_mode[]" id="cmb_travel_mode_{{$key+1}}" class="tboxsmclass" 
																				value="{{!empty($data->travel_mode) ? $data->travel_mode : ''}}"></td>
																			<td><input type="text" name="txt_accomod_used[]" id="txt_accomod_used_{{$key+1}}" class="tboxsmclass" 
																				value="{{!empty($data->accomod_used) ? $data->accomod_used : ''}}"></td>
																			<td><input type="text" name="txt_no_of_amount[]" id="txt_no_of_amount_{{$key+1}}" class="tboxsmclass" 
																				value="{{!empty($data->no_of_fares) ? $data->no_of_fares : ''}}"></td>
																			<td><input type="text" name="txt_adv_amount[]" id="txt_adv_amount_{{$key+1}}" class="tboxsmclass" 
																				value="{{!empty($data->advance_amount) ? $data->advance_amount : ''}}"></td>
																			<td align='center'><i class='fa fa-times-circle sqdel ptr disable DeleteRow' id='DelRelationshipDetails' style='font-size:24px'></i></i></td>
																		</tr>
																	@endforeach
																@endif
															</tbody>
															@php
																$totalAmount = 0;
																$sanctionedAmount = 0;
																$balance = 0;
																$totalClaim = 0;

																if (!empty($EditClaimData)) {

																	$totalAmount = $EditClaimData->advance_amount ?? 0;

																	if ($EditClaimData->is_adv_completed) {
																		$sanctionedAmount = $EditClaimData->sanctioned_amount ?? 0;
																		$balance = $totalAmount - $sanctionedAmount;
																		$totalClaim = $EditClaimData->claim_sanctioned_amount ?? $balance;
																	}
																}
															@endphp
															<tfoot>
																<tr>
																	<td colspan="10" style="text-align:right;"><b>Total (A) In Rs.</b></td>
																	<td>
																		<input type="text" name="total_adv_amount" id="total_adv_amount"
																			class="tboxsmclass" value="{{ $totalAmount }}" readonly>
																	</td>
																	<td></td>
																</tr>

																<tr>
																	<td colspan="10" style="text-align:right;"><b>Sanctioned Amount (90% of advance request Rs. {{$totalAmount}})(B) Rs.</b>{{$sanctionedAmount}}</td>
																	<td>
																		<input type="text" name="sanctioned_amount" id="sanctioned_amount"
																			class="tboxsmclass" value="{{ $sanctionedAmount }}" readonly>
																	</td>
																	<td></td>
																</tr>

																<!-- <tr>
																	<td colspan="10" style="text-align:right;"><b>Balance Amount (A) In Rupees</b></td>
																	<td>
																		<input type="text" name="balance_amount" id="balance_amount"
																			class="tboxsmclass" value="{{ $balance }}" readonly>
																	</td>
																	<td></td>
																</tr> -->

																<tr>
																	<td colspan="10" style="text-align:right;"><b>Total Claim Amount (A-B) In Rs.</b></td>
																	<td>
																		<input type="text" name="total_claim_amount" id="total_claim_amount"
																			class="tboxsmclass" value="{{ $totalClaim }}" readonly>
																	</td>
																	<td></td>
																</tr>
															</tfoot>
														</table>
													</div>
												</div>
												<div class="row smclearrow"></div>
												<div class="row smclearrow"></div>
											</fieldset>
											
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="div12" align="center">
							<input type="hidden" name="txt_tab" id="txt_tab" value="1" />
							<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
						</div>
					</div>
				</blockquote>
			</div>
		</div>
	</div>
</form>
<script>
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$(".ChosenInput").chosen();
	$("#entitle_ltc").empty();
	$("#visiting_home").empty();

    function toggleSpouseLtc(value) {
        if (value === 'Y') {
            $(".SpouseLtc").removeClass('hide');
        } else {
            $(".SpouseLtc").addClass('hide');
        }
    }

    function toggleYearLtc(value) {
        if (value === 'Y') {
            $(".YearLtc").removeClass('hide');
        } else {
            $(".YearLtc").addClass('hide');
        }
    }

	function toggleIndiaLtc(value) {
        if (value === 'Y') {
            $(".Place").removeClass('hide');
        }else if(value === 'N') {
            $(".Place").addClass('hide');
        }else{
			$(".Place").addClass('hide');
		}
    }

	function toggleElDays(value) {
        if (value === 'Y') {
            $(".ELdays").removeClass('hide');
        }else if(value === 'N') {
            $(".ELdays").addClass('hide');
        }else{
			$(".ELdays").addClass('hide');
		}
    }

    let spouseValue = $("input[name='rad_spouse_employed']:checked").val();
    toggleSpouseLtc(spouseValue);

    let visitingValue = $("input[name='rad_visiting']:checked").val();
    toggleYearLtc(visitingValue);

	let indiaValue = $("input[name='rad_india']:checked").val();
    toggleIndiaLtc(indiaValue);

	let eldaysValue = $("input[name='rad_leaveenhance']:checked").val();
    toggleElDays(eldaysValue);

    $("input[name='rad_spouse_employed']").change(function () {
        toggleSpouseLtc($(this).val());
    });

    $("input[name='rad_visiting']").change(function () {
        toggleYearLtc($(this).val());
    });	

	$("input[name='rad_india']").change(function () {
        toggleIndiaLtc($(this).val());
    });	

	$("input[name='rad_leaveenhance']").change(function () {
        toggleElDays($(this).val());
    });

    var TravelIndex = {{ !empty($LtcAdvData) ? (count($LtcAdvData) + 1)  : 1 }};
	$(document).on('click','#travel_add_record',function(){
		var DepartureDt 	= $('#txt_departure_dt_0').val();
		var DepartureTime 	= $('#txt_departure_time_0').val();
		var DepartureFrom 	= $('#txt_departure_from_0').val();
		var ArrivalDt 		= $('#txt_arraival_dt_0').val();
		var ArrivalTime 	= $('#txt_arraival_time_0').val();
		var ArrivalFrom 	= $('#txt_arraival_from_0').val();
		var Distance 		= $('#txt_distance_0').val();
		var TravelMode      = $('#cmb_travel_mode_0 option:selected').text();
		var AccomUsed 	    = $('#txt_accomod_used_0').val();
		var NoofAmount 	    = $('#txt_no_of_amount_0').val();
		var AdvAmount 	    = $('#txt_adv_amount_0').val();
		let tablestr = "";
		tablestr += '<tr>';
		tablestr += '<td><input type="text" name="txt_departure_dt[]" id="txt_departure_dt_'+TravelIndex+'" class="tboxsmclass datepicker" value="'+DepartureDt+'"></td>';
		tablestr += '<td><input type="time" name="txt_departure_time[]" id="txt_departure_time_'+TravelIndex+'" class="tboxsmclass" value="'+DepartureTime+'"></td>';
		tablestr += '<td><input type="text" name="txt_departure_from[]" id="txt_departure_from_'+TravelIndex+'" class="tboxsmclass" value="'+DepartureFrom+'"></td>';
		tablestr += '<td><input type="text" name="txt_arraival_dt[]" id="txt_arraival_dt_'+TravelIndex+'" class="tboxsmclass datepicker" value="'+ArrivalDt+'"></td>';
		tablestr += '<td><input type="time" name="txt_arraival_time[]" id="txt_arraival_time_'+TravelIndex+'" class="tboxsmclass" value="'+ArrivalTime+'"></td>';
		tablestr += '<td><input type="text" name="txt_arraival_from[]" id="txt_arraival_from_'+TravelIndex+'" class="tboxsmclass" value="'+ArrivalFrom+'"></td>';
		tablestr += '<td><input type="text" name="txt_distance[]" id="txt_distance_'+TravelIndex+'" class="tboxsmclass" value="'+Distance+'"></td>';
		tablestr += '<td><input type="text" name="cmb_travel_mode[]" id="cmb_travel_mode_'+TravelIndex+'" class="tboxsmclass" value="'+TravelMode+'"></td>';
		tablestr += '<td><input type="text" name="txt_accomod_used[]" id="txt_accomod_used_'+TravelIndex+'" class="tboxsmclass" value="'+AccomUsed+'"></td>';
		tablestr += '<td><input type="text" name="txt_no_of_amount[]" id="txt_no_of_amount_'+TravelIndex+'" class="tboxsmclass" value="'+NoofAmount+'"></td>';
		tablestr += '<td><input type="text" name="txt_adv_amount[]" id="txt_adv_amount_'+TravelIndex+'" class="tboxsmclass" value="'+AdvAmount+'"></td>';
		tablestr += "<td align='center'><i class='fa fa-times-circle sqdel ptr disable DeleteRow' id='DelRelationshipDetails' style='font-size:24px'></i></i></td>";
		tablestr += "</tr>";
		$("#travel_table").append(tablestr);
		$('#txt_departure_dt_0').val('');
		$('#txt_departure_time_0').val('');
		$('#txt_departure_from_0').val('');
		$('#txt_arraival_dt_0').val('');
		$('#txt_arraival_time_0').val('');
		$('#txt_arraival_from_0').val('');
		$('#txt_distance_0').val('');
		$('#cmb_travel_mode_0').chosen('destroy');
		$('#cmb_travel_mode_0').val('');
		$('#cmb_travel_mode_0').chosen();
		$('#txt_accomod_used_0').val('');
		$('#txt_no_of_amount_0').val('');
		$('#txt_adv_amount_0').val('');
		TravelIndex++;
	});

	$(document).on('click','.DeleteRow',function(){
		$(this).closest("tr").remove();
		calculateAmount();
	});

	$(document).on('keyup', '[id^="txt_adv_amount_"]', function() {
    	calculateAmount();
	});

	$(document).ready(function () {
    	calculateAmount();
	});

	function calculateAmount() {
		let total = 0;
		let totalClaim = 0;
		let sactioned = parseFloat($('#sanctioned_amount').val()) || 0;
		$('[id^="txt_adv_amount_"]').each(function () {
			let val = parseFloat($(this).val());
			if (!isNaN(val)) {
				total += val;
			}
		});
    	$('#total_adv_amount').val(total);
		totalClaim = total - sactioned;
		$('#total_claim_amount').val(totalClaim);

	}

	$(document).on('keyup', "input[name^='txt_no_of_amount_']", function () {
		let checkedCount = $(".chk_rel:checked").length;
		let filledCount = $("input[name^='txt_no_of_amount_']").val();
		if (filledCount != checkedCount) {
			BootstrapDialog.alert("Selected members (" + checkedCount + ") must match entered fares (" + filledCount + ")");
			$("input[name^='txt_no_of_amount_']").val('');
		} 
	});

	// var KillEvent = 0;
	// $("#btn_save").click(function (e) {
	// 	if(KillEvent == 0){
	// 		e.preventDefault();
	// 		let isChecked = $("#chk_cout_rel_self").is(":checked");
	// 		if (isChecked) {
	// 			let isValid = true;
	// 			let travelData = [];
	// 			$("input[name='txt_departure_dt[]']").each(function (index) {

	// 				let departure_dt = $("input[name='txt_departure_dt[]']").eq(index).val();
	// 				let arrival_dt   = $("input[name='txt_arraival_dt[]']").eq(index).val();

	// 				if (departure_dt === '' || arrival_dt === '') {
	// 					isValid = false;
	// 					return false;
	// 				}

	// 				travelData.push({
	// 					from_date: departure_dt,
	// 					to_date: arrival_dt
	// 				});
	// 			});

	// 			if (!isValid) {
	// 				alert("Please fill all travel details");
	// 				return false;
	// 			}

	// 			console.log(travelData);

	// 			$.ajax({
	// 				url: "{{ route('ajax.CheckLTCLeaveApply') }}",
	// 				type: "POST",
	// 				data: {
	// 					emp_no: "{{$ICNo}}",
	// 					travel: travelData
	// 				},
	// 				success: function (response) {
	// 					console.log(response);
	// 					if (response.applied) {
	// 						KillEvent = 1;
	// 						$("#btn_save").trigger( "click" );
	// 					} else {
	// 						BootstrapDialog.confirm({
	// 							title: 'Confirmation',
	// 							message: 'Leave not applied. Do you want to continue?',
	// 							type: BootstrapDialog.TYPE_PRIMARY,
	// 							callback: function(result) {
	// 								if (result) {
	// 									KillEvent = 1;
	// 									$("#btn_save").trigger( "click" );
	// 								}else{
	// 									KillEvent = 0;
	// 								}

	// 							}
	// 						});
	// 					}
	// 				},
	// 				error: function (xhr) {
	// 					console.log(xhr.status);  
	// 					console.log(xhr.responseText);
	// 				}
	// 			});
	// 		}else{
	// 			KillEvent = 1;
	// 			$("#btn_save").trigger( "click" );
	// 		}
	// 	}
	// });


	/*$(document).on('click','#rad_employed_yes',function(){
		
		$("#entitle_ltc").append( '<div class="div3 label">Whether wife/husband is employed and if so whether entitled to LTC </div> <div class="div3"> <input type="text" name="entitle_LTC"  id="entitle_LTC" class="tboxsmclass" value=""></div' );
	});*/
	/* $(document).on('click','#rad_visiting_yes',function(){
		$("#visiting_home").append( '<div class="div3 label">if so, block for which LTC is to be availed Year </div> <div class="div3"> <input type="text" name="visiting_year"  id="visiting_year" class="tboxsmclass" value=""></div' );
	}); */
</script>
@endsection
