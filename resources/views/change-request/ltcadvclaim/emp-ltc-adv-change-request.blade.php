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
<<<<<<< Updated upstream
	dd($Paylevel);
=======
>>>>>>> Stashed changes
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
@endphp
<style>
<<<<<<< Updated upstream
	
=======
	.leaveType{
		background-color:#ffe5e5;
		border-left:5px solid #d9534f;
		padding:10px 15px;
		color:#a94442;
		margin:10px 0;
	}
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">LTC Advance Claim Request Form</div></div></div>
=======
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">LTC Advance Request Form</div></div></div>
>>>>>>> Stashed changes
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
											</div>
<<<<<<< Updated upstream
=======
											@if(isset($data['Leaveexits']))
												@foreach($data['Leaveexits'] as $Leaveexits)
													@if($EditClaimData->leave_enhancement == "Y" && $Leaveexits->leave_type_code != 'EL')
													<div class="leaveType">
														Applied leave is {{$Leaveexits->leave_type_code}}. You have selected Leave Encashment for 10 days of EL. Please apply for EL leave and submit the request.
													</div>
													@endif
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
																		<td>{{ $loop->iteration }}</td>
																		<td>{{ $Leaveexits->leave_type_code}}</td>
																		<td>{{ \Carbon\Carbon::parse($Leaveexits->from_date)->format('d/m/Y') }}</td>
																		<td>{{ \Carbon\Carbon::parse($Leaveexits->to_date)->format('d/m/Y') }}</td>
																		<td>{{ $Leaveexits->applied_days}}</td>
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
>>>>>>> Stashed changes
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
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Spouse Details</legend>
												<div class="fieldbox-div">
													<div class="div4 label label">
														Whether spouse is employed ? <span class="reqindi">*</span>
													</div>
													<div class="div2 label">
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input {{!empty($EditClaimData) ? $EditClaimData->spouse_employed == "Y" ? "checked" : "" : ""}} id="rad_spouse_employed_yes" name="rad_spouse_employed" type="radio" value="Y"/>
																<label for="rad_spouse_employed_yes" style="padding:3px 0px; width:100%"> &nbsp;Yes</label>
															</div>
														</div>
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_spouse_employed_no" name="rad_spouse_employed" type="radio" value="N" {{!empty($EditClaimData) ? $EditClaimData->spouse_employed == "N" ? "checked" : "" : ""}}/>
																<label for="rad_spouse_employed_no" style="padding:3px 0px; width:100%"> &nbsp;No</label>
															</div>
														</div>
													</div>
													<div class="div3 label SpouseLtc hide">Whether spouse entitled to LTC </div> 
													<div class="div3 SpouseLtc hide">
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_entitle_LTC_yes" name="rad_entitle_LTC" type="radio" value="Y" {{!empty($EditClaimData) ? $EditClaimData->entitle_ltc == "Y" ? "checked" : "" : ""}}/>
																<label for="rad_entitle_LTC_yes" style="padding:3px 0px; width:100%"> &nbsp;Yes</label>
															</div>
														</div>
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_entitle_LTC_no" name="rad_entitle_LTC" type="radio" value="N" {{!empty($EditClaimData) ? $EditClaimData->entitle_ltc == "N" ? "checked" : "" : ""}}/>
																<label for="rad_entitle_LTC_no" style="padding:3px 0px; width:100%"> &nbsp;No</label>
															</div>
														</div>
													</div>
<<<<<<< Updated upstream
=======
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
												<div class="fieldbox-div">
>>>>>>> Stashed changes
													<div class="row smclearrow"></div>
													<div class="div4 label label">
														Whether the concession is to be availed for home town ? <span class="reqindi">*</span>
													</div>
													<div class="div2 label">
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_visiting_yes" name="rad_visiting" type="radio" value="Y" {{!empty($EditClaimData) ? $EditClaimData->visiting_home == "Y" ? "checked" : "" : ""}}/>
																<label for="rad_visiting_yes" style="padding:3px 0px; width:100%"> &nbsp;Yes</label>
															</div>
														</div>
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_visiting_no" name="rad_visiting" type="radio" value="N" {{!empty($EditClaimData) ? $EditClaimData->visiting_home == "N" ? "checked" : "" : ""}}/>
																<label for="rad_visiting_no" style="padding:3px 0px; width:100%"> &nbsp;No</label>
															</div>
														</div>
													</div>
													<div class="div3 label YearLtc hide">Block for Which LTC is to be availed Year </div> 
													<div class="div3 YearLtc hide"><input type="text" name="year_ltc"  id="year_ltc" class="tboxsmclass" value="{{!empty($EditClaimData) ? $EditClaimData->year_ltc ? $EditClaimData->year_ltc : '' : ''}}"></div>
													<div class="row smclearrow"></div>
													<div id="visiting_home"></div>
												   <div class="div4 label label">
														"Anywhere in India" the place to visited <span class="reqindi">*</span>
													</div>
													<div class="div2 label">
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_india_yes" name="rad_india" type="radio" value="Y" {{!empty($EditClaimData) ? $EditClaimData->visiting_india == "Y" ? "checked" : "" : ""}}/>
																<label for="rad_india_yes" style="padding:3px 0px; width:100%"> &nbsp;Yes</label>
															</div>
														</div>
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_india_no" name="rad_india" type="radio" value="N" {{!empty($EditClaimData) ? $EditClaimData->visiting_india == "N" ? "checked" : "" : ""}}/>
																<label for="rad_india_no" style="padding:3px 0px; width:100%"> &nbsp;No</label>
															</div>
														</div>
													</div>
													<div class="div3 label Place hide">Block for which to be availed.</div> 
													<div class="div3 Place hide"><input type="text" name="place_visited"  id="place_visited" class="tboxsmclass" value="{{!empty($EditClaimData) ? $EditClaimData->place_visited ? $EditClaimData->place_visited : '' : ''}}"></div>
													<div class="row smclearrow"></div>
													<div id="Visiting-hometown"></div>
													<div class="row smclearrow"></div>
													<div class="div4 label label">
														Leave Enhancement for 10 days of EL<span class="reqindi">*</span>
													</div>
													<div class="div2 label">
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input id="leave_enhancement_yes" name="rad_leaveenhance" type="radio" value="Y" {{!empty($EditClaimData) ? $EditClaimData->leave_enhancement == "Y" ? "checked" : "" : ""}}/>
																<label for="leave_enhancement_yes" style="padding:3px 0px; width:100%"> &nbsp;Yes</label>
															</div>
														</div>
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input id="leave_enhancement_no" name="rad_leaveenhance" type="radio" value="N" {{!empty($EditClaimData) ? $EditClaimData->leave_enhancement == "N" ? "checked" : "" : ""}}/>
																<label for="leave_enhancement_no" style="padding:3px 0px; width:100%"> &nbsp;No</label>
															</div>
														</div>
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
<<<<<<< Updated upstream
												<legend class="fieldbox-legend">Concessions Details</legend>
												<div class="fieldbox-div">

												</div>
											</fieldset>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<fieldset class="fieldbox">
=======
>>>>>>> Stashed changes
												<legend class="fieldbox-legend">Family Details</legend>
												<div class="fieldbox-div">
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="fieldbox-div">
														<table class="formtable" align="center" id="family_table" width="100%">
															<thead> 
																<tr>
																	<th>#</th>
																	<th>Name</th>
																	<th>Relationship</th>
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
											</fieldset>
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
<<<<<<< Updated upstream
																	<td><input type="text" name="txt_travel_mode_0" id="txt_travel_mode_0" class="tboxsmclass" value=""></td>
=======
																	<td>
																		<!-- <input type="text" name="txt_travel_mode_0" id="txt_travel_mode_0" class="tboxsmclass" value=""> -->
																		<select name="cmb_travel_mode_0" id="cmb_travel_mode_0" class="tboxsmclass ChosenInput">
																			<option value="">Select</option>
																			<option value="Air">Air</option>
																			<option value="Bus">Bus</option>
																			<option value="Train">Train</option>
																		</select>
																	</td>
>>>>>>> Stashed changes
																	<td><input type="text" name="txt_accomod_used_0" id="txt_accomod_used_0" class="tboxsmclass" value=""></td>
																	<td><input type="text" name="txt_no_of_amount_0" id="txt_no_of_amount_0" class="tboxsmclass" value=""></td>
																	<td><input type="text" name="txt_adv_amount_0" id="txt_adv_amount_0" class="tboxsmclass" value=""></td>
																	<td align="center"><i class="fa fa-plus-square sqadd ptr inp disable" id="travel_add_record" style="font-size:24px;"></i></td>
																</tr>
																@if(!empty($LtcAdvData))
    																@foreach($LtcAdvData as $key => $data)
																		<tr>
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
<<<<<<< Updated upstream
																			<td><input type="text" name="txt_travel_mode[]" id="txt_travel_mode_{{$key+1}}" class="tboxsmclass" 
=======
																			<td><input type="text" name="cmb_travel_mode[]" id="cmb_travel_mode_{{$key+1}}" class="tboxsmclass" 
>>>>>>> Stashed changes
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
															<tfoot>
																<tr>
<<<<<<< Updated upstream
																	<td colspan="10" style="text-align:right;"><b>Total</b></td>
=======
																	<td colspan="10" style="text-align:right;"><b>Total (A)</b></td>
>>>>>>> Stashed changes
																	<td>
																		<input type="text" name="total_adv_amount" id="total_adv_amount" class="tboxsmclass" value="{{!empty($EditClaimData) ? $EditClaimData->advance_amount : '' }}" readonly>
																	</td>
																	<td></td>
																</tr>
<<<<<<< Updated upstream
=======
																@if(session('WcmsEmpNo') != $ICNo)
																<tr>
																	<td colspan="10" style="text-align:right;">
																		<b>90% Amount Of A</b>
																	</td>
																	<td>
																		<input type="text"
																			name="total_90_percent"
																			id="total_90_percent"
																			class="tboxsmclass"
																			value="{{ !empty($EditClaimData) ? ($EditClaimData->advance_amount * 90 / 100) : '' }}"
																			readonly>
																	</td>
																	<td></td>
																</tr>
																@endif
>>>>>>> Stashed changes
															</tfoot>
														</table>
													</div>
												</div>
												<div class="row smclearrow"></div>
												<div class="row smclearrow"></div>
<<<<<<< Updated upstream
												<!-- <div class="fieldbox-div">
													<div class="div4 label label">
														Visit Travel Mode<span class="reqindi">*</span>
													</div>
													<div class="div3 label">
														<div class="div4 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_travel_bus" name="rad_travel" type="radio" value="Y"/>
																<label for="rad_travel_bus" style="padding:3px 0px; width:100%"> &nbsp;Bus</label>
															</div>
														</div>
														<div class="div4 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_travel_rail" name="rad_travel" type="radio" value="N"/>
																<label for="rad_travel_rail" style="padding:3px 0px; width:100%"> &nbsp;Rail</label>
															</div>
														</div>
														<div class="div4 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_travel_train" name="rad_travel" type="radio" value="N"/>
																<label for="rad_travel_train" style="padding:3px 0px; width:100%"> &nbsp;Train</label>
															</div>
														</div>
													</div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="div2 label label">
														LTC Visiting Place<span class="reqindi">*</span>
													</div>
													<div class="div2 label">From Place</div>
													<div class="div1"><input type="text" name="txt_from_place" id="txt_from_place" class="tboxsmclass" value="" ></div>
													<div class="div2 label">To Place:</div>
													<div class="div1"><input type="text" name="txt_to_place" id="txt_to_place" class="tboxsmclass" value="" ></div>
													<div class="row smclearrow"></div>
													<div class="div2 label label">Probable date of journey<span class="reqindi">*</span></div>
													<div class="div2 label">From Date:</div>
													<div class="div1"><input type="text" name="txt_journey_from_date" id="txt_journey_from_date" class="tboxsmclass datepicker" value="" ></div>
													<div class="div2 label">To Date:</div>
													<div class="div1"><input type="text" name="txt_journey_to_date" id="txt_journey_to_date" class="tboxsmclass datepicker" value="" ></div>
													<div class="row smclearrow"></div>
													<div class="div2 label">About Advance Required</div>
													<div class="div2"><input type="text" name="txt_adv_amount" id="txt_adv_amount" class="tboxsmclass" value="" ></div>
													<div class="row smclearrow"></div>
												</div>  -->
=======
>>>>>>> Stashed changes
											</fieldset>
											
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
										</div>
										@php 
											if($Page == 'REQ_APPLY'){
												$BackUrl = 'change-request.ltc-adv-change-request-list'; 
											}else{
												$BackUrl = 'change-request.ltc-adv-change-request-list'; 
											}
										@endphp
									<div class="row" align="center">
										<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" Back " onClick="window.location='{{route($BackUrl)}}'" />
										<button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Save">Save</button>
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

    let spouseValue = $("input[name='rad_spouse_employed']:checked").val();
    toggleSpouseLtc(spouseValue);

    let visitingValue = $("input[name='rad_visiting']:checked").val();
    toggleYearLtc(visitingValue);

	let indiaValue = $("input[name='rad_india']:checked").val();
    toggleIndiaLtc(indiaValue);

    $("input[name='rad_spouse_employed']").change(function () {
        toggleSpouseLtc($(this).val());
    });

    $("input[name='rad_visiting']").change(function () {
        toggleYearLtc($(this).val());
    });	

	$("input[name='rad_india']").change(function () {
        toggleIndiaLtc($(this).val());
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
<<<<<<< Updated upstream
		var TravelMode 	    = $('#txt_travel_mode_0').val();
=======
		var TravelMode 	    = $('#cmb_travel_mode_0 option:selected').val();
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
		tablestr += '<td><input type="text" name="txt_travel_mode[]" id="txt_travel_mode_'+TravelIndex+'" class="tboxsmclass" value="'+TravelMode+'"></td>';
=======
		tablestr += '<td><input type="text" name="cmb_travel_mode_0[]" id="cmb_travel_mode_'+TravelIndex+'" class="tboxsmclass" value="'+TravelMode+'"></td>';
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
		$('#txt_travel_mode_0').val('');
=======
		$('#cmb_travel_mode_0').chosen('destroy');
>>>>>>> Stashed changes
		$('#txt_accomod_used_0').val('');
		$('#txt_no_of_amount_0').val('');
		$('#txt_adv_amount_0').val('');
		TravelIndex++;
	});

	$(document).on('click','.DeleteRow',function(){
		$(this).closest("tr").remove();
	});

	$(document).on('keyup', '[id^="txt_adv_amount_"]', function() {
    	let total = 0;
		$('[id^="txt_adv_amount_"]').each(function() {
			let val = parseFloat($(this).val());
			if (!isNaN(val)) {
				total += val;
			}
		});
    	$('#total_adv_amount').val(total);
	});

	$(document).on('keyup', "input[name^='txt_no_of_amount_']", function () {
		let checkedCount = $(".chk_rel:checked").length;
		let filledCount = $("input[name^='txt_no_of_amount_']").val();
		if (filledCount != checkedCount) {
			BootstrapDialog.alert("Selected members (" + checkedCount + ") must match entered fares (" + filledCount + ")");
			$("input[name^='txt_no_of_amount_']").val('');
		} 
	});

	var KillEvent = 0;
	$("#btn_save").click(function (e) {
		if(KillEvent == 0){
			e.preventDefault();
			let isChecked = $("#chk_cout_rel_self").is(":checked");
			if (isChecked) {
				let isValid = true;
				let travelData = [];
				$("input[name='txt_departure_dt[]']").each(function (index) {

					let departure_dt = $("input[name='txt_departure_dt[]']").eq(index).val();
					let arrival_dt   = $("input[name='txt_arraival_dt[]']").eq(index).val();

					if (departure_dt === '' || arrival_dt === '') {
						isValid = false;
						return false;
					}

					travelData.push({
						from_date: departure_dt,
						to_date: arrival_dt
					});
				});

				if (!isValid) {
					alert("Please fill all travel details");
					return false;
				}

				console.log(travelData);

				$.ajax({
					url: "{{ route('ajax.CheckLTCLeaveApply') }}",
					type: "POST",
					data: {
						emp_no: "{{$ICNo}}",
						travel: travelData
					},
					success: function (response) {
						console.log(response);
						if (response.applied) {
							KillEvent = 1;
							$("#btn_save").trigger( "click" );
						} else {
							BootstrapDialog.confirm({
								title: 'Confirmation',
								message: 'Leave not applied. Do you want to continue?',
								type: BootstrapDialog.TYPE_PRIMARY,
								callback: function(result) {
									if (result) {
										KillEvent = 1;
										$("#btn_save").trigger( "click" );
									}else{
										KillEvent = 0;
									}

								}
							});
						}
					},
					error: function (xhr) {
						console.log(xhr.status);  
						console.log(xhr.responseText);
					}
				});
			}else{
				KillEvent = 1;
				$("#btn_save").trigger( "click" );
			}
		}
	});


	/*$(document).on('click','#rad_employed_yes',function(){
		
		$("#entitle_ltc").append( '<div class="div3 label">Whether wife/husband is employed and if so whether entitled to LTC </div> <div class="div3"> <input type="text" name="entitle_LTC"  id="entitle_LTC" class="tboxsmclass" value=""></div' );
	});*/
	/* $(document).on('click','#rad_visiting_yes',function(){
		$("#visiting_home").append( '<div class="div3 label">if so, block for which LTC is to be availed Year </div> <div class="div3"> <input type="text" name="visiting_year"  id="visiting_year" class="tboxsmclass" value=""></div' );
	}); */
</script>
@endsection
