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
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Claim of Honorarium Under Teaching Assistanship - Request</div></div></div>
								<div class="row innerdiv">
									<div class="row"> 
										 <!-- Form Steps --> 
										<div class="form-step active"> 
											
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Basic information</legend>
												<div class="fieldbox-div">
													
													<div class="div2 label label">IC No</div>
													<div class="div2"><input type="text" name="txt_emp_icno" id="txt_emp_icno" class="tboxsmclass disable" value="@if(isset($ICNo)){{$ICNo}}@endif"></div>
													<div class="div2 label pd-l-20">Name</div>
													<div class="div2"><input type="text" name="txt_payslip_name" id="txt_payslip_name" class="tboxsmclass disable" value="@if(isset($EmpName)){{$EmpName}}@endif"></div>
													<div class="div2 label pd-l-20">Designation</div>
													<div class="div2">
														<select name="cmb_designation" id="cmb_designation" class="tboxsmclass ChosenInput disable">
															<option value="">------ Select -----</option>
															@if(isset($data['DesiginationList']))
																@foreach($data['DesiginationList'] as $DesiginationList)
																	<option value="{{$DesiginationList->designation_id}}">{{$DesiginationList->designation_name}}</option>
																@endforeach
															@endif
															
														</select>
													</div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="div2 label">Date of Birth</div>
													<div class="div2"><input type="text" name="txt_dob" id="txt_dob" class="tboxsmclass disable" value="@if(isset($EmpDOB)){{Helper::DisplayDateFormat($EmpDOB)}}@endif"></div>
													<div class="div2 label pd-l-20">Date of Joining</div>
													<div class="div2"><input type="text" name="txt_doj" id="txt_doj" class="tboxsmclass disable" value="@if(isset($EmpDOJ)){{Helper::DisplayDateFormat($EmpDOJ)}}@endif"></div>
													<div class="div2 label pd-l-20">Date of Retirement</div>
													<div class="div2"><input type="text" name="txt_date_retire" id="txt_date_retire" class="tboxsmclass disable" value="@if(isset($EmpDOJ)){{Helper::DisplayDateFormat($EmpDOJ)}}@endif"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="div2 label">Group</div>
													<div class="div2">
														<select name="cmb_group" id="cmb_group" class="tboxsmclass ChosenInput disable">
															<option value="">------ Select------</option>
															@if(isset($data['OfficeList']))
															@foreach($data['OfficeList'] as $Group)
																<option value="{{$Group->office_id}}">{{$Group->office_name}}</option>
															@endforeach
															@endif
															
														</select>
													</div>
													<div class="div2 label pd-l-20">Divison</div>
													<div class="div2">
														<select name="cmb_division" id="cmb_division" class="tboxsmclass ChosenInput disable">
															<option value="">------ Select -----</option>
														</select>
													</div>
													<div class="div2 label pd-l-20">Section</div>
													<div class="div2">
														<select name="cmb_section" id="cmb_section" class="tboxsmclass ChosenInput disable">
															<option value="">------ Select ------</option>
														</select>
													</div>
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
												<legend class="fieldbox-legend">Claim of Honorarium Under Teaching Assistanship Information</legend>
												<div class="fieldbox-div">
													<div class="div2 label">
														Claim of Honorarium details <span class="reqindi">*</span>
													</div>
													<div class="div10">
														<textarea name="txt_cont_address" id="txt_cont_address" rows="4" class="tboxsmclass alphanumeric"></textarea>
													</div>
													
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>

											                                                                               											
										</div>
											
											
										
									<div class="row" align="center">
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
