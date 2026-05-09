@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
if(isset($data['Empdata'])){
	$Empdata    = $data['Empdata'];
	$ICNo       = collect($Empdata)->pluck('emp_no')->first();
	$EmpName    = collect($Empdata)->pluck('emp_first_name')->first();
	$EmpDOB     = collect($Empdata)->pluck('emp_dob')->first();
	$EmpDOJ     = collect($Empdata)->pluck('emp_doj')->first();
	$EmpRET     = collect($Empdata)->pluck('emp_retirement_dt')->first();
	$Desig      = collect($Empdata)->pluck('designation_name')->first();
	$GroupId    = collect($Empdata)->pluck('group')->first();
	$DivId      = collect($Empdata)->pluck('division_short_name')->first();
}
if(isset($data['Housedata'])){
	$Housedata  = $data['Housedata'];
	$HouseAddr  = collect($Housedata)->pluck('house_address')->first();
	$AllotedOn  = collect($Housedata)->pluck('alloted_on')->first();
	$VacatedOn  = collect($Housedata)->pluck('vacated_on')->first();
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
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">HRA Claim Application Form</div></div></div>
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
												<legend class="fieldbox-legend">House Stayed Details</legend>
												<div class="fieldbox-div">
													<div class="row smclearrow"></div>
													<table class="formtable" width="99%" align="center">
														<div class="row smclearrow"></div>
													    <div class="div3 label label">Whether Stayed in IMSc Accomadatation</div>											
														<div class="div2 label"><input type="radio"name="rad_stay" id="rad_stay_yes" value="YES">  &emsp; Yes</div>
														<div class="div2 label"><input type="radio" name="rad_stay"  id="rad_stay_no" value="No"> &emsp; No</div>
														<thead class="house hide">
															<tr class="note heading">
																<th  style="text-align:center">S.No.</th>
																<th  style="text-align:center">House Address</th>
																<th  style="text-align:center">Occupied On</th>
																<th  style="text-align:center">Vacated On</th>
															</tr>
														</thead>
														<tbody class="house hide">
															@if(isset($data['Empdata']))
															@foreach($data['Empdata'] as $Empdata)
																<tr>
																	<td align="center">{{ $loop->iteration }} </td>
																	<td align="left"><input type="text" name="txt_house_addr" id="txt_house_addr" class="tboxsmclass" value="@if(isset($HouseAddr)){{$HouseAddr}}@endif" readonly></td>
																	<td align="left"><input type="text" name="txt_occ_date" id="txt_occ_date" class="tboxsmclass" value="@if(isset($AllotedOn)){{Helper::DisplayDateFormat($AllotedOn)}}@endif" readonly></td>
																	<td align="left"><input type="text" name="txt_vac_date" id="txt_vac_date" class="tboxsmclass" value="@if(isset($VacatedOn)){{Helper::DisplayDateFormat($VacatedOn)}}@endif" readonly></td>
																</tr>
															@endforeach
															@endif
																<!-- <tr>
																	<td align="center"><input type="text" name="txt_sn" id="txt_sn" class="tboxsmclass" value="@if(isset($SecId)){{$SecId}}@endif" readonly> </td>
																	<td align="left"><input type="text" name="txt_house_addr" id="txt_house_addr" class="tboxsmclass" value="@if(isset($SecId)){{$SecId}}@endif" readonly> </td>
																	<td align="left"><input type="text" name="txt_occ_date" id="txt_occ_date" class="tboxsmclass" value="@if(isset($SecId)){{$SecId}}@endif" readonly></td>
																	<td align="left"><input type="text" name="txt_vac_date" id="txt_vac_date" class="tboxsmclass" value="@if(isset($SecId)){{$SecId}}@endif" readonly></td>
																	<td align="left"> </td>
																</tr> -->
														</tbody>
													</table>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>
											
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">HRA Claim Information</legend>
												<div class="fieldbox-div">
													<div class="div2 label">
														HRA Claim Details <span class="reqindi">*</span>
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
										</div>
									@php  $BackUrl = 'request-updates.hra-claim-request'; @endphp
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
$("input[name='rad_stay']").change(function() {
        if($(this).val() == 'YES') {
            $(".house").removeClass('hide');
        }else if($(this).val() == 'N0'){
            $(".house").addClass('hide');
        }
    });
var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		var radval = $("input[name='rad_stay']:checked").val();
		if(radval == 'YES'){
			if(KillEvent == 0){
				var HouseAddress  = $("#txt_house_addr").val();
				var OccupiedDate  = $("#txt_occ_date").val();
				var VacationDate  = $("#txt_vac_date").val();

				if(HouseAddress == ""){
					BootstrapDialog.alert("House Address should not be empty..!!");
					event.preventDefault();
					event.returnValue = false;
				}else if(OccupiedDate == ""){
					BootstrapDialog.alert("Occupied Date Code should not be empty..!!");
					event.preventDefault();
					event.returnValue = false;
				} else if(VacationDate == ""){
					BootstrapDialog.alert("Please Vacate the House and apply for the House Rent Allowance");
					event.preventDefault();
					event.returnValue = false;
				} else{
					event.preventDefault();
					BootstrapDialog.confirm({
						title: 'Confirmation Message',
						message: 'Are you sure want to HRA Claim Request ?',
						closable: false, // <-- Default value is false
						draggable: false, // <-- Default value is false
						btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
						btnOKLabel: 'Ok', // <-- Default value is 'OK',
						callback: function(result) {
							if(result){
								KillEvent = 1;
								$("#btn_save").trigger( "click" );
							}else {
								KillEvent = 0;
							}
						}
					});
				}
			}
		}
	});
</script>
@endsection
