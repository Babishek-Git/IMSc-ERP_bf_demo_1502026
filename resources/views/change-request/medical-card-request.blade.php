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

if(isset($data['Page'])){
	$Page = $data['Page'];
	
}else{
	$Page = NULL;
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
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Medical Card Application Request Form</div></div></div>
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
												<legend class="fieldbox-legend">Family Details Information</legend>
												<div class="fieldbox-div">
													<div class="row smclearrow"></div>                                                                                											
													<table class="formtable" width="99%" align="center">
														<thead>
															<tr class="note heading">
																<th  style="text-align:center">Select</th>
																<th  style="text-align:center">SNo.</th>
																<th  style="text-align:center">Name of the person</th>
																<th  style="text-align:center">Date of Birth</th>
																<th  style="text-align:center">RelationShip</th>
																<th  style="text-align:center">Age</th>
																<th  style="text-align:center">Blood Group</th>
																<th  style="text-align:center">Aadhar No.</th>
																<th  style="text-align:center">Income & Occupation, indicate pension per </br>month for parents and fulfill the conditions </br>of (*) below</th>
															</tr>
														</thead>
														<tbody>
														@if(isset($data['FamilyDetails']))
															@foreach($data['FamilyDetails'] as $FamilyData)
																<tr>
																	<td align="center"><input type="checkbox" name="ch_fam_mem" id="ch_fam_mem"><input type="hidden" name="family_det_id" id="family_det_id" value=" {{$FamilyData->family_det_id}}"></td>
																	<td align="center">{{ $loop->iteration }}</td>
																	<td align="left"> {{$FamilyData->fam_member_name}}</td>
																	<td align="center">{{Helper::DisplayDateFormat( $FamilyData->fam_member_dob )}}</td>
																	<td align="left">{{ $FamilyData->relationship_name }}</td>
																	<td align="center">{{ \Carbon\Carbon::parse($FamilyData->fam_member_dob)->age }} </td>
																	<td align="left"></td>
																	<td align="left">{{ $FamilyData->fam_member_aadhar }}</td>
																	<td align="center"><input type="text" name="txt_income_occupation" id="txt_income_occupation" class="tboxsmclass" value=""></td>
																</tr>
															@endforeach
														@endif
														</tbody>
													</table>
												</div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											</fieldset>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											@php 
											if($Page == 'ALLREQ'){
												$BackUrl = 'all-request-update.family-members-update'; 
											}else{
												$BackUrl = 'request-updates.family-members-update'; 
											}
											@endphp
										</div>
									<div class="row" align="center">
									<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" Back " onClick="window.location='{{route($BackUrl)}}'" />
										<button type="submit" id="btn_save" name="btn_save" class="step-btn" value="Save">SAVE</button> 
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
