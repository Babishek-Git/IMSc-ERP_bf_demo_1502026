@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
 if(isset($data['Empdata'])){
	
	$Empdata  = $data['Empdata'];
	$ICNo     = collect($Empdata)->pluck('emp_no')->first();
	$EmpName  = collect($Empdata)->pluck('emp_first_name')->first();
	$EmpDOB   = collect($Empdata)->pluck('emp_dob')->first();
	$EmpDOJ    = collect($Empdata)->pluck('emp_doj')->first();
	$EmpRET    = collect($Empdata)->pluck('emp_retirement_dt')->first();
	$Desig    = collect($Empdata)->pluck('designation_name')->first();
	$GroupId   = collect($Empdata)->pluck('group')->first();
	$DivId   = collect($Empdata)->pluck('division_short_name')->first();
	$SecId   = collect($Empdata)->pluck('section')->first();
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
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Data Card / Mobile Phone Charge Claim Application Form</div></div></div>
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
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Data Card/Mobile Details</legend>
												<div class="fieldbox-div">
													<div class="div2 label">
													From Month Onwards<span class="reqindi">*</span>
													</div>
													<div class= "div2 padl">
														<select  name="cmb_applicable_month" id="cmb_applicable_month" class="tboxsmclass ChosenInput alphanumeric">	
															<option value="">---- Select ----</option>
															<option value="Jan">January</option>
															<option value="Feb">February</option>
															<option value="Mar">March</option>
															<option value="April">April</option>
															<option value="May">May</option>
															<option value="June">June</option>
															<option value="July">July</option>
															<option value="Aug">August</option>
															<option value="Sep">September</option>
															<option value="Oct">October</option>
															<option value="Nov">November</option>
															<option value="Dec">December</option>
														</select>
													</div>
													@php
													$Claimyear = date('Y');
													@endphp
													<div class="div2 label pd-l-20 "><input type="text" name="txt_applicable_year" id="txt_applicable_year" class="tboxsmclass" value="@if(isset($Claimyear)){{$Claimyear}}@endif" readonly ></div>
													<div class="row smclearrow"></div>
													<div class="div2 label">
														Basis Understanding which claimed<span class="reqindi">*</span>
													</div>
													<div class="div2 no-margin">
														<div class="inputGroup paddlr2">
															<input id="rad_air" name="rad_mode_travel" type="radio" value="Entitle"/>
															<label for="rad_air" style="padding:3px 0px; width:100%"> &nbsp;Entitlement Basis</label>
														</div>
													</div>
													<div class="div2 no-margin">
														<div class="inputGroup paddlr2">
															<input id="rad_train" name="rad_mode_travel" type="radio" value="Functional"/>
															<label for="rad_train" style="padding:3px 0px; width:100%"> &nbsp;Functional Basis</label>
														</div>
													</div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<table class="formtable" width="99%" align="center">
														<thead>
															<tr class="note heading">
																<th  style="text-align:center">SNo.</th>
																<th  style="text-align:center">Type of </br> Communication</th>
																<th  style="text-align:center">Bill No</th>
																<th  style="text-align:center">Bill Date</th>
																<th  style="text-align:center">From Date</th>
																<th  style="text-align:center">To Date</th>
																<th  style="text-align:center">Whether bills are settled & </br> Original bills/receipts are enclosed here with</th>
																<th  style="text-align:center">Total Bill Amount  &#8377;</th>
																<th  style="text-align:center">Amount Admissible & </br>payment Passes For  &#8377;</th>
															</tr>
														</thead>
														<tbody>
															<td align="left"><input type="text" name="txt_sno" id="txt_sno" class="tboxsmclass" value="" ></td>
															<td align="left"><input type="text" name="txt_type_communication" id="txt_type_communication" class="tboxsmclass" value="" ></td>
															<td align="left"><input type="text" name="txt_bill_no" id="txt_bill_no" class="tboxsmclass" value="" ></td>
															<td align="left"><input type="text" name="txt_bill_date" id="txt_bill_date" class="tboxsmclass datepicker" value="" ></td>
															<td align="left"><input type="text" name="txt_bill_from_date" id="txt_bill_from_date" class="tboxsmclass datepicker" value="" ></td>
															<td align="left"><input type="text" name="txt_bill_to_date" id="txt_bill_from_date" class="tboxsmclass datepicker" value="" ></td>
															<td>
																<div class="div5 no-margin">
																	<div class="inputGroup paddlr2">
																		<input id="rad_yes" name="rad_Basis" type="radio" value="yes"/>
																		<label for="rad_yes" style="padding:3px 0px; width:100%"> &nbsp;Yes</label>
																	</div>
																</div>
																<div class="div5 no-margin">
																	<div class="inputGroup paddlr2">
																		<input id="rad_no" name="rad_Basis" type="radio" value="No"/>
																		<label for="rad_no" style="padding:3px 0px; width:100%"> &nbsp;No</label>
																	</div>
																</div>
															</td>
															<td align="left"><input type="text" name="txt_bill_amt" id="txt_bill_amt" class="tboxsmclass" value="" ></td>
															<td align="left"><input type="text" name="txt_amt_admissible" id="txt_amt_admissible" class="tboxsmclass" value="" ></td>
														</tbody>
													</table>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="div2 label">
														Residential Landline<span class="reqindi">*</span>
													</div>
													<div class="div2 no-margin">
														<div class="inputGroup paddlr2">
															<input id="rad_broad" name="rad_mode_travel" type="radio" value="Entitle"/>
															<label for="rad_broad" style="padding:3px 0px; width:100%"> &nbsp;Entitlement Basis</label>
														</div>
													</div>
													<div class="div2 no-margin">
														<div class="inputGroup paddlr2">
															<input id="rad_train" name="rad_mode_travel" type="radio" value="Functional"/>
															<label for="rad_train" style="padding:3px 0px; width:100%"> &nbsp;Functional Basis</label>
														</div>
													</div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											@php $BackUrl = 'request-updates.datcrd-mobphn-chrg-clm-request'; @endphp
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
</script>
@endsection
