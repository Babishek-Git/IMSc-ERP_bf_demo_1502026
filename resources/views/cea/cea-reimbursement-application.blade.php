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
 if(isset($data['EditCliamData'])){
	
	$EditCliamData  = $data['EditCliamData'];
	
	$AcadamicYear         = collect($EditCliamData)->pluck('academic_year')->first();
	$HostelDistance       = collect($EditCliamData)->pluck('hostel_distance')->first();
	$DisableChild         = collect($EditCliamData)->pluck('is_diabled_child')->first();
	$BonofideCert         = collect($EditCliamData)->pluck('is_bonafide_cert')->first();
	$BonofideCertHostel   = collect($EditCliamData)->pluck('is_bonafide_cert_hostel')->first();
	$ClaimDate            = collect($EditCliamData)->pluck('claim_date')->first();
	$ClaimedAmount        = collect($EditCliamData)->pluck('total_claimed_amount')->first();
	$ApprovedAmount       = collect($EditCliamData)->pluck('total_approved_amount')->first();
	$CreatedBy            = collect($EditCliamData)->pluck('created_by')->first();
	$ReimbursementdtId  = collect($EditCliamData)->pluck('reimbursement_type_id')->first();
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
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Reimbursement of CEA Application Form</div></div></div>
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
													<div class="row smclearrow"></div>
													<div class="div2 label">Date of Birth</div>
													<div class="div2"><input type="text" name="txt_dob" id="txt_dob" class="tboxsmclass" value="@if(isset($EmpDOB)){{Helper::DisplayDateFormat($EmpDOB)}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Date of Joining</div>
													<div class="div2"><input type="text" name="txt_doj" id="txt_doj" class="tboxsmclass" value="@if(isset($EmpDOJ)){{Helper::DisplayDateFormat($EmpDOJ)}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Date of Retirement</div>
													<div class="div2"><input type="text" name="txt_date_retire" id="txt_date_retire" class="tboxsmclass" value="@if(isset($EmpDOJ)){{Helper::DisplayDateFormat($EmpDOJ)}}@endif" readonly></div>
													<div class="row smclearrow"></div>
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
												<legend class="fieldbox-legend">Details of Child</legend>
												<div class="fieldbox-div">
													<div class="row smclearrow"></div>
													<table class="formtable" width="99%" align="center">
														<thead>
															<tr class="note heading">
																<th  style="text-align:center">S.No.</th>
																<th  style="text-align:center">Children Name</th>
																<th  style="text-align:center">Children Relationship</th>
																<th  style="text-align:center">Date Of Birth</th>
															</tr>
														</thead>
														<tbody>
															@if(isset($data['ChildrenData']))
																@foreach($data['ChildrenData'] as $ChildrenData)
																	<tr>
																		<td align="center">{{ $loop->iteration }} </td>
																		<!-- <td align="left"><input type="checkbox" name="fam_member_name[]" id="fam_member_id">&emsp; {{ $ChildrenData->fam_member_name}} 
																		<input type="hidden" name="fam_member_name[]" id="fam_member_name"  value="{{ $ChildrenData->family_det_id}}" >&emsp; </td> -->
																		<td align="left"><input type="text" name="fam_member_name" id="fam_member_name" class="tboxsmclass" value="{{ $ChildrenData->fam_member_name}}" readonly></td>
																		<td align="left"><input type="text" name="txt_child_rel" id="txt_child_rel" class="tboxsmclass" value="{{ $ChildrenData->relationship_name }}" readonly></td>
																		<td align="left"><input type="text" name="txt_dob" id="txt_dob" class="tboxsmclass" value="{{ Helper::DisplayDateFormat($ChildrenData->fam_member_dob) }}" ></td>
																	</tr>
																@endforeach
															@endif
														</tbody>
													</table>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>
											<div class="row smclearrow"></div>
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Reimbursement of Expenditure</legend>
												<div class="fieldbox-div">
													<div class="row smclearrow"></div>
													<table class="formtable" width="99%" align="center">
														<thead>
															<tr class="note heading">
																<th  style="text-align:center">S.No.</th>
																<th  style="text-align:center">Sequence (1st child / 2nd child)</th>
																<th  style="text-align:center">Acadamic Year</th>
																<th  style="text-align:center">Rate Of CEA </br>(Rs.) per month</th>
																<th  style="text-align:center">Amount </br>(Rs.)</th>
																<th  style="text-align:center">Remarks</th>
																<th  style="text-align:center">Hostel</br> Distance</th>
																<th  style="text-align:center">Is Disable Child?</th>
																<th  style="text-align:center">Disability Nature</th>
																<th  style="text-align:center">Certification Date</th>
																<th  style="text-align:center">Percentage of Disability</th>
																<th  style="text-align:center">Bonofide Certificate</th>
																<th  style="text-align:center">Bonofide Certificate (Hostel)</th>
																<th  style="text-align:center">Bonofide Certificate  Amount (Hostel)</th>
															</tr>
														</thead>
														<tbody>
															@if(isset($data['ChildrenData']))
																@php $TwoChildrenData = collect($data['ChildrenData'])->take(2); @endphp
																@foreach($TwoChildrenData as $ChildrenData)
																	<!-- @php 
																	//$Rate = collect($CeaRateData)->pluck('')->first();
																	//$Amount = $Rate * 12;
																	@endphp -->
																	<tr>
																		<td align="center">{{ $loop->iteration }} </td>
																		<td align="left">
																			<input type="text" name="txt_child_name_{{ $ChildrenData->family_det_id }}" id="txt_child_name_{{ $ChildrenData->family_det_id }}" class="tboxsmclass" value="{{ $ChildrenData->fam_member_name }}" readonly>
																			<input type="hidden" name="txt_child_id[]" id="txt_child_id" class="tboxsmclass" value="{{ $ChildrenData->family_det_id }}" readonly>
																		</td>
																		<td align="left" style="width:90px" ><input type="text" name="txt_academic_year_{{ $ChildrenData->family_det_id }}" id="txt_academic_year_{{ $ChildrenData->family_det_id }}" class="tboxsmclass" value="@if(isset($AcadamicYear)){{$AcadamicYear}}@endif"></td>
																		<td align="left" style="width:90px" ><input type="text" name="txt_rate_cea_{{ $ChildrenData->family_det_id }}" id="txt_rate_cea_{{ $ChildrenData->family_det_id }}" class="tboxsmclass" value="2250"></td>
																		<td align="left" style="width:90px" ><input type="text" name="txt_amt_{{ $ChildrenData->family_det_id }}" id="txt_amt_{{ $ChildrenData->family_det_id }}" class="tboxsmclass" value="27000"></td>
																		<td align="left" style="width:110px"><input type="text" name="txt_remarks_{{ $ChildrenData->family_det_id }}" id="txt_remarks_{{ $ChildrenData->family_det_id }}" class="tboxsmclass" value="Fixed amount"></td>
																		<td align="left" style="width:50px"><input type="text" name="txt_distance_{{ $ChildrenData->family_det_id }}" id="txt_distance_{{ $ChildrenData->family_det_id }}" class="tboxsmclass" value="@if(isset($HostelDistance)){{$HostelDistance}}@endif" ></td>
																		<td align="left" style="width:50px"><input type="checkbox" name="ch_is_disable_{{ $ChildrenData->family_det_id }}" id="ch_is_disable_{{ $ChildrenData->family_det_id }}" class="tboxsmclass" value="@if(isset($DisableChild)){{$DisableChild}}@endif" ></td>
																		<td align="left" style="width:50px"><input type="text" name="txt_disable_nature_{{ $ChildrenData->family_det_id }}" id="ch_disable_nature_{{ $ChildrenData->family_det_id }}" class="tboxsmclass" value="@if(isset($DisableChild)){{$DisableChild}}@endif" >
																		<td align="left" style="width:50px"><input type="text" name="txt_certi_date_{{ $ChildrenData->family_det_id }}" id="txt_certi_date_{{ $ChildrenData->family_det_id }}" class="tboxsmclass datepicker" value="@if(isset($DisableChild)){{$DisableChild}}@endif" ></td>
																		<td align="left" style="width:50px"><input type="text" name="txt_perc_{{ $ChildrenData->family_det_id }}" id="txt_perc_{{ $ChildrenData->family_det_id }}" class="tboxsmclass" value="@if(isset($BonofideCert)){{$BonofideCert}}@endif" ></td>
																		<td align="left" style="width:50px"><input type="checkbox" name="ch_bonofide_{{ $ChildrenData->family_det_id }}" id="ch_bonofide_{{ $ChildrenData->family_det_id }}" class="tboxsmclass" value="@if(isset($BonofideCert)){{$BonofideCert}}@endif" >
																		<td align="left" style="width:50px"><input type="checkbox" name="ch_bonofide_hostel_{{ $ChildrenData->family_det_id }}" id="ch_bonofide_hostel_{{ $ChildrenData->family_det_id }}" class="tboxsmclass" value="@if(isset($BonofideCertHostel)){{$BonofideCertHostel}}@endif" ></td>
																		<td align="left" style="width:50px"><input type="text" name="txt_bonofide_hostel_amt_{{ $ChildrenData->family_det_id }}" id="txt_bonofide_hostel_amt_{{ $ChildrenData->family_det_id }}" class="tboxsmclass" value="@if(isset($BonofideCertHostel)){{$BonofideCertHostel}}@endif" ></td>
																	</tr>
																@endforeach
															@endif
														</tbody>
													</table>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>
										</div>
										<div class="row smclearrow"></div>
										<div class="row smclearrow"></div>
										<div class="row smclearrow"></div>
										<div class="row smclearrow"></div>
										@php $BackUrl = 'request-updates.cea-application-update'; @endphp
									<div class="row" align="center">
										<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" Back " onClick="window.location='{{route($BackUrl)}}'" />
										<button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Save">Save</button>
										<input type  ="hidden" name="hid_reimbursement_dt_id" id="hid_reimbursement_dt_id" value="@if(isset($ReimbursementdtId)){{$ReimbursementdtId}}@endif" />
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
$("input[name='ch_is_disable']").change(function() {
        if($(this).val() == 'Y') {
            $(".childcea").removeClass('hide');
        }else if($(this).val() == 'N'){
            $(".childcea").addClass('hide');
        }else{
			$(".childcea").addClass('hide');
		}
    });
$("input[name='ch_bonofide_hostel']").change(function() {
        if($(this).val() == 'Y') {
            $(".BonofideAmount").removeClass('hide');
        }else if($(this).val() == 'N'){
            $(".BonofideAmount").addClass('hide');
        }else{
			$(".BonofideAmount").addClass('hide');
		}
    });
</script>
@endsection
