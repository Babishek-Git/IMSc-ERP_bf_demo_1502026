@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
 if(isset($data['Empdata'])){
	$Empdata     = $data['Empdata'];
	$ICNo        = collect($Empdata)->pluck('emp_no')->first();
	$EmpName     = collect($Empdata)->pluck('emp_first_name')->first();
	$EmpDOB      = collect($Empdata)->pluck('emp_dob')->first();
	$EmpDOJ      = collect($Empdata)->pluck('emp_doj')->first();
	$EmpRET      = collect($Empdata)->pluck('emp_retirement_dt')->first();
	$Desig       = collect($Empdata)->pluck('designation_name')->first();
	$GroupId     = collect($Empdata)->pluck('group')->first();
	$DivId       = collect($Empdata)->pluck('division_short_name')->first();
	$SecId       = collect($Empdata)->pluck('section')->first();
}
 if(isset($data['Payleveldata'])){
	$Payleveldata  = $data['Payleveldata'];
	$Paylevel      = collect($Payleveldata)->pluck('pay_level')->first();
	$BasicSalary   = collect($Payleveldata)->pluck('basic_salary')->first();
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
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">LTC Advance Claim Request Form</div></div></div>
								<div class="row innerdiv">
									<div class="row"> 
										 <div class="step-panels"> 
											<div class="step active"> <span class="step-span step-span-active">1</span> Personal Details</div> 
											<div class="step"><span class="step-span">2</span> Pay Details</div> 
											<div class="step" style="white-space: nowrap;"><span class="step-span">3</span> Education & Bank Details &nbsp;</div> 
											<div class="step"><span class="step-span">4</span> Family Details</div> 
											<div class="step"><span class="step-span">5</span> Insurance Details</div> 
											<div class="step"><span class="step-span">6</span> Others</div> 
										</div> 
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
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="div2 label">Date of Birth</div>
													<div class="div2"><input type="text" name="txt_dob" id="txt_dob" class="tboxsmclass" value="@if(isset($EmpDOB)){{Helper::DisplayDateFormat($EmpDOB)}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Date of Joining</div>
													<div class="div2"><input type="text" name="txt_doj" id="txt_doj" class="tboxsmclass" value="@if(isset($EmpDOJ)){{Helper::DisplayDateFormat($EmpDOJ)}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Date of Retirement</div>
													<div class="div2"><input type="text" name="txt_date_retire" id="txt_date_retire" class="tboxsmclass" value="@if(isset($EmpDOJ)){{Helper::DisplayDateFormat($EmpDOJ)}}@endif" readonly></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
 												    <div class="div2 label label">Group</div>
													<div class="div2"><input type="text" name="txt_group" id="txt_group" class="tboxsmclass" value="@if(isset($GroupId)){{$GroupId}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Divison</div>
													<div class="div2"><input type="text" name="txt_div" id="txt_div" class="tboxsmclass" value="@if(isset($DivId)){{$DivId}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Section</div>
													<div class="div2"><input type="text" name="txt_sec" id="txt_sec" class="tboxsmclass" value="@if(isset($SecId)){{$SecId}}@endif" readonly></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Pay Information</legend>
												<div class="fieldbox-div">
													<div class="div2 label label">Level</div>
													<div class="div1"><input type="text" name="txt_level" id="txt_level" class="tboxsmclass" value="@if(isset($Paylevel)){{$Paylevel}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Basic Pay <span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_basic_pay" id="txt_basic_pay" class="tboxsmclass" value="@if(isset($BasicSalary)){{$BasicSalary}}@endif"></div>
													<div class="div3 label pd-l-20">Home Town<br>(AS Recorded in the service book)<span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_next_incr_dt" id="txt_next_incr_dt" class="tboxsmclass datepicker" value=""></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Spouse & concessions Details</legend>
												<div class="fieldbox-div">
													<div class="div4 label label">
														Whether spouse is employed ? <span class="reqindi">*</span>
													</div>
													<div class="div2 label">
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_spouse_employed_yes" name="rad_spouse_employed" type="radio" value="Y"/>
																<label for="rad_spouse_employed_yes" style="padding:3px 0px; width:100%"> &nbsp;Yes</label>
															</div>
														</div>
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_spouse_employed_no" name="rad_spouse_employed" type="radio" value="N"/>
																<label for="rad_spouse_employed_no" style="padding:3px 0px; width:100%"> &nbsp;No</label>
															</div>
														</div>
													</div>
													<div class="div3 label SpouseLtc hide">Whether spouse entitled to LTC </div> 
													<div class="div3 SpouseLtc hide"><input type="text" name="txt_entitle_LTC"  id="txt_entitle_LTC" class="tboxsmclass" value=""></div>
													<div class="row smclearrow"></div>
													<div class="div4 label label">
														Whether the concession is to be availed for visiting home town ? <span class="reqindi">*</span>
													</div>
													<div class="div2 label">
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_visiting_yes" name="rad_visiting" type="radio" value="Y"/>
																<label for="rad_visiting_yes" style="padding:3px 0px; width:100%"> &nbsp;Yes</label>
															</div>
														</div>
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_visiting_no" name="rad_visiting" type="radio" value="N"/>
																<label for="rad_visiting_no" style="padding:3px 0px; width:100%"> &nbsp;No</label>
															</div>
														</div>
													</div>
													<div class="div3 label YearLtc hide">Block for Which LTC is to be availed Year </div> 
													<div class="div3 YearLtc hide"><input type="text" name="Year_LTC"  id="Year_LTC" class="tboxsmclass" value=""></div>
													<div class="row smclearrow"></div>
													<div id="visiting_home"></div>
												   <div class="div4 label label">
														Anywhere in India" the place to visited <span class="reqindi">*</span>
													</div>
													<div class="div2 label">
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_india_yes" name="rad_india" type="radio" value="Y"/>
																<label for="rad_india_yes" style="padding:3px 0px; width:100%"> &nbsp;Yes</label>
															</div>
														</div>
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_india_no" name="rad_india" type="radio" value="N"/>
																<label for="rad_india_no" style="padding:3px 0px; width:100%"> &nbsp;No</label>
															</div>
														</div>
													</div>
													<div class="div3 label Place hide">Block for which to be availed.</div> 
													<div class="div3 Place hide"><input type="text" name="place_visited"  id="place_visited" class="tboxsmclass" value=""></div>
													<div class="row smclearrow"></div>
												<div id="Visiting-hometown"></div>
												</div>
											</fieldset>
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Travel Details</legend>
												<div class="fieldbox-div">
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
												</div> 
												</div>
											</fieldset>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
										</div>
										@php $BackUrl = 'request-updates.adv-claim-ltc-request'; @endphp
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
	$(".ChosenInput").chosen();
	$("#entitle_ltc").empty();
	$("#visiting_home").empty();
	$("input[name='rad_spouse_employed']").change(function() {
        if($(this).val() == 'Y') {
            $(".SpouseLtc").removeClass('hide');
        }else if($(this).val() == 'N'){
            $(".SpouseLtc").addClass('hide');
        }else{
			$(".SpouseLtc").addClass('hide');
		}
    });
	$("input[name='rad_visiting']").change(function() {
        if($(this).val() == 'Y') {
            $(".YearLtc").removeClass('hide');
        }else if($(this).val() == 'N'){
            $(".YearLtc").addClass('hide');
        }else{
			$(".YearLtc").addClass('hide');
		}
    });
	$("input[name='rad_india']").change(function() {
        if($(this).val() == 'Y') {
            $(".Place").removeClass('hide');
        }else if($(this).val() == 'N'){
            $(".Place").addClass('hide');
        }else{
			$(".Place").addClass('hide');
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
