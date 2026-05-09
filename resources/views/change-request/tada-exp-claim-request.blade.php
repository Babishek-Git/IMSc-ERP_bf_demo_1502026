@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
 if(isset($data['Empdata'])){
	
	$Empdata  = $data['Empdata'];
	$ICNo     = collect($Empdata)->pluck('emp_no')->first();
	$EmpName  = collect($Empdata)->pluck('emp_first_name')->first();
	$EmpDOB   = collect($Empdata)->pluck('emp_dob')->first();
	$EmpDOJ   = collect($Empdata)->pluck('emp_doj')->first();
	$EmpRET   = collect($Empdata)->pluck('emp_retirement_dt')->first();
	$Desig    = collect($Empdata)->pluck('designation_name')->first();
	$GroupId  = collect($Empdata)->pluck('group')->first();
	$DivId    = collect($Empdata)->pluck('division_short_name')->first();
	$SecId    = collect($Empdata)->pluck('section')->first();
}
@endphp
<style>
    
	
</style>

<form action="" method="post" enctype="multipart/form-data" name="form">
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1" style="overflow:auto">
					<div class="container">
						<div class="row plr">
              				<!-- <div class="div1"></div> -->
							<div class="div12 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">TA/DA Expenses Claim Application Form</div></div></div>
								<div class="row innerdiv">
									<div class="row"> 
										 <!-- Form Steps --> 
										<div class="form-step active"> 
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Basic information</legend>
												<div class="fieldbox-div">
													<div class="div2 label label">IC No</div>
													<div class="div2"><input type="text" name="txt_emp_icno" id="txt_emp_icno" class="tboxsmclass" value="@if(isset($ICNo)){{$ICNo}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Name</div>
													<div class="div2"><input type="text" name="txt_payslip_name" id="txt_payslip_name" class="tboxsmclass" value="@if(isset($EmpName)){{$EmpName}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Designation</div>
													<div class="div2"><input type="text" name="txt_designation" id="txt_designation" class="tboxsmclass" value="@if(isset($Desig)){{$Desig}}@endif" readonly></div>
													<div class="div2 label">Date of Birth</div>
													<div class="div2"><input type="text" name="txt_dob" id="txt_dob" class="tboxsmclass" value="@if(isset($EmpDOB)){{Helper::DisplayDateFormat($EmpDOB)}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Date of Joining</div>
													<div class="div2"><input type="text" name="txt_doj" id="txt_doj" class="tboxsmclass" value="@if(isset($EmpDOJ)){{Helper::DisplayDateFormat($EmpDOJ)}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Date of Retirement</div>
													<div class="div2"><input type="text" name="txt_date_retire" id="txt_date_retire" class="tboxsmclass" value="@if(isset($EmpDOJ)){{Helper::DisplayDateFormat($EmpDOJ)}}@endif" readonly></div>
													<div class="div2 label label">Group</div>
													<div class="div2"><input type="text" name="txt_group" id="txt_group" class="tboxsmclass" value="@if(isset($GroupId)){{$GroupId}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Divison</div>
													<div class="div2"><input type="text" name="txt_div" id="txt_div" class="tboxsmclass" value="@if(isset($DivId)){{$DivId}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Section</div>
													<div class="div2"><input type="text" name="txt_sec" id="txt_sec" class="tboxsmclass" value="@if(isset($SecId)){{$SecId}}@endif" readonly></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>
											<div class="row smclearrow"></div>
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">TA/DA Claim</legend>
												<div class="fieldbox-div">
													<div class="div3 label">Purpose of Visit<span class="reqindi">*</span></div>
													<div class="div9"><input type="text" name="txt_purpose_visit" id="txt_purpose_visit" class="tboxsmclass" value="" ></div>
													<div class="row smclearrow"></div>
													<div class="div3 label">Visting Institute Name<span class="reqindi">*</span></div>
													<div class="div3"><input type="text" name="txt_visiting-institudename" id="txt_visiting-institudename" class="tboxsmclass" value=""></div>
													<div class="div3 label pd-l-20">Date and Time of  Departure from IMSc<span class="reqindi">*</span></div>
													<div class="div3"><input type="text" name="txt_depart-time" id="txt_depart" class="tboxsmclass datepicker" value=""></div>
													<div class="div3 label">Date and Time of Arrival to Visting place<span class="reqindi">*</span></div>
													<div class="div3"><input type="text" name="txt_arrival-institude" id="txt_arrival-institude" class="tboxsmclass datepicker" value=""></div>
													<div class="div3 label pd-l-20">Date and Time of Departure from Visting place<span class="reqindi">*</span></div>
													<div class="div3"><input type="text" name="txt_depart-institude" id="txt_depart-institude" class="tboxsmclass datepicker" value=""></div>
													<div class="row smclearrow"></div>
													<div class="div2 label label">
														Mode of Travel <span class="reqindi">*</span>
													</div>
													<div class="div1 no-margin">
														<div class="inputGroup paddlr2">
															<input id="rad_air" name="rad_mode_travel" type="radio" value="Air"/>
															<label for="rad_air" style="padding:3px 0px; width:100%"> &nbsp;Air</label>
														</div>
													</div>
													<div class="div1 no-margin">
														<div class="inputGroup paddlr2">
															<input id="rad_train" name="rad_mode_travel" type="radio" value="Train"/>
															<label for="rad_train" style="padding:3px 0px; width:100%"> &nbsp;Train</label>
														</div>
													</div>
													<div class="div1 no-margin">
														<div class="inputGroup paddlr2">
															<input id="rad_taxi" name="rad_mode_travel" type="radio" value="Taxi"/>
															<label for="rad_taxi" style="padding:3px 0px; width:100%"> &nbsp;Taxi</label>
														</div>
													</div>
												</div>
												<div class="div4 label pd-l-20  air hide">Air Fare (Rs.)</div>
												<div class="div2 air hide"><input type="text" name="txt_air_fare" id="txt_air_fare" class="tboxsmclass" value=""></div>
												<div class="div4 label pd-l-20 train hide">Train Fare (including Reservation Amount) (Rs.)</div>
												<div class="div2 train hide"><input type="text" name="txt_air_fare" id="txt_air_fare" class="tboxsmclass" value=""></div>
												<div class="div4 label pd-l-20 taxi hide">Taxi Fare (Rs.)</div>
												<div class="div2 taxi hide"><input type="text" name="txt_air_fare" id="txt_air_fare" class="tboxsmclass" value=""></div>
												<div class="row smclearrow"></div>
												<div class="row smclearrow"></div>
											</fieldset>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Supporting Documents</legend>
												<div class="fieldbox-div">
													<div class="div3 label pd-l-20">Attach all the Documents</div>
													<div class="div2"><input type="file"style="width:220px" id="file_emp_docu" name="file_emp_docu" class="step-btn" value="FILE"></button>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
										</div>
										
									<div class="row" align="center">
										<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" Back " onClick="window.location='{{route($BackUrl)}}'" />
										<button type="submit" id="SaveDraft" name="SaveDraft" class="step-btn" value="Save">SAVE</button> 
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
$(".ChosenInput").chosen();
$(document).on('click','input[name="rad_mode_travel"]',function(){
	let Type = $(this).val();
	if(Type == 'Air'){ 
		$(".air").removeClass('hide');
		$(".train").addClass('hide');
		$(".taxi").addClass('hide');
    }else if(Type == 'Train'){ 
		$(".train").removeClass('hide');
		$(".taxi").addClass('hide');
		$(".air").addClass('hide');

    }else{
		$(".taxi").removeClass('hide');
		$(".train").addClass('hide');
		$(".air").addClass('hide');
	}
 });
</script>
@endsection
