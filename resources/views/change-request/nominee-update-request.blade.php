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
	$FamilyId = collect($Empdata)->pluck('family_det_id')->first();

}
if(((session('WcmsRoleGroupCode') == "ADMUSER")||(session('WcmsRoleGroupCode') == "SUPUSER"))){
	$IsAdmin = 1;
}else{
	$IsAdmin = 0;
}
if(isset($data['Nomineedata']))
{
	$Nomineedata = $data['Nomineedata'];
	$FamilyId    = collect($Nomineedata)->pluck('family_det_id')->first();
	$FamilyName    = collect($Nomineedata)->pluck('family_det_name')->first();
}
if(isset($data['EditClaimData']))
{
	$EditClaimData      = $data['EditClaimData'];
	$NewNominee         = optional(json_decode($EditClaimData->new_value))->nominee_name ?? '';
	$NewRelationShip    = optional(json_decode($EditClaimData->new_value))->relationship_name ?? '';
	$OldPercentage      = optional(json_decode($EditClaimData->old_value))->phy_challange_perc ?? '';
	$OldPhysicalType    = optional(json_decode($EditClaimData->old_value))->phy_challange_type ?? '';
	$ChangeRequestId = $EditClaimData->change_req_id;
	
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
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Nominee Update -  Request Form</div></div></div>
								<div class="row innerdiv">
									<div class="row"> 
										 <!-- Form Steps --> 
										<div class="form-step active"> 
											
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Basic information</legend>
												<div class="fieldbox-div">
													<!-- @if($IsAdmin == 1)
													<div class="div2 label label">Select Employee</div>
													<div class="div3">
														<select name="txt_emp_icno" id="txt_emp_icno" class="tboxsmclass ChosenInput">
															<option value="">-------- Select------</option>
															@if(isset($data['UserData']))
															@foreach($data['UserData'] as $UserData)
																	<option value="{{$UserData->emp_no}}">{{$UserData->emp_first_name}} (IC No.{{$UserData->emp_no}}, {{$UserData->designation_name}})</option>
															@endforeach
															@endif
														</select>
													</div>
													@else
													<div class="div2 label label">IC No</div>
													<div class="div2"><input type="text" name="txt_emp_icno" id="txt_emp_icno" class="tboxsmclass" value="@if((isset($ICNo))&&($IsAdmin == 0)){{$ICNo}}@endif" readonly></div>
													@endif -->
													<div class="row smclearrow"></div>
													<div class="div2 label">IC No.</div> 
													<div class="div2"><input type="text" name="txt_emp_icno" id="txt_emp_icno" class="tboxsmclass" value="@if(isset($ICNo)){{$ICNo}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Name</div>
													<div class="div2">
													<input type="text" name="txt_payslip_name" id="txt_payslip_name" class="tboxsmclass" value="@if(isset($EmpName)){{$EmpName}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Designation</div>
													<div class="div2"><input type="text" name="txt_designation" id="txt_designation" class="tboxsmclass" value="@if(isset($Desig)){{$Desig}}@endif" readonly></div>
													<div class="div2 label">Date of Birth</div>
													<div class="div2"><input type="text" name="txt_dob" id="txt_dob" class="tboxsmclass" value="@if(isset($EmpDOB)){{Helper::DisplayDateFormat($EmpDOB)}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Date of Joining</div>
													<div class="div2"><input type="text" name="txt_doj" id="txt_doj" class="tboxsmclass" value="@if(isset($EmpDOJ)){{Helper::DisplayDateFormat($EmpDOJ)}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Date of Retirement</div>
													<div class="div2"><input type="text" name="txt_date_retire" id="txt_date_retire" class="tboxsmclass" value="@if(isset($EmpRET)){{Helper::DisplayDateFormat($EmpRET)}}@endif" readonly></div>
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
											<div class="row smclearrow"></div>
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend"> Nominee Details  Information</legend>
												<div class="fieldbox-div">
													<div class="div2 label label"> Choose Nominee Name</div>
													<div class="div2">
														<select name="cmb_nominee_name" id="cmb_nominee_name" class="tboxsmclass ChosenInput" readonly>
															<option value="">-------- Select------</option>
															 @if(isset($data['Nomineedata']))
                                                            	@foreach($data['Nomineedata'] as $Nomineedata)
																	@php
																		$selstr= "";
																		if(isset($FamilyId)){ 
																			if($FamilyId == $Nomineedata->family_det_id)
																			{
																				$selstr='selected="selected"';
																			}
																		}
																	@endphp
                                                                	<option value="{{ $Nomineedata->family_det_id }}" {{$selstr}}>{{ $Nomineedata->fam_member_name }}</option>
                                                           		 @endforeach
                                                      		  @endif
														</select>
													</div>
													<div class="div2 label pd-l-20">RelationShip</div> 
													<div class="div2"><input type="text" name="txt_relation_ship" id="txt_relation_ship" class="tboxsmclass" value="@if(isset($NewRelationShip)){{$NewRelationShip}}@endif"  readonly></div>
													<div class="div2 label pd-l-20">Supporting Document</div>
													<div class="div2"><input type="file" id="file" name="file" class="step-btn" value="FILE" style="width:95%"></button></div>
													<!-- <div id="NomineeData"></div> -->
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
												@php 
												if($Page == 'ALLREQ'){
													$BackUrl = 'all-request-update.martial-status-update'; 
												}else{
													$BackUrl = 'request-updates.martial-status-update'; 
												}
												@endphp
											</fieldset>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
										</div>
									<div class="row" align="center">
										<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" Back " onClick="window.location='{{route($BackUrl)}}'" />
										<button type="submit" id="btn_save" name="btn_save" class="step-btn" value="Save">SAVE</button> 
										<input type  ="hidden" name="hid_change_id" id="hid_change_id" value="@if(isset($ChangeRequestId)){{$ChangeRequestId}}@endif" />
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
	var selectedValue = "";
/*$("body").on("change", "#rad_nominee", function (event) {
	alert();
    selectedValue = $(this).val();
	$("#hid_nominee_id").val(selectedValue);
	alert($("#hid_nominee_id").val());   // store in variable
});*/

/* $("body").on("change", "#txt_emp_icno", function (event) {
	//alert();
	$(".ChosenInput").chosen();	
    var EmpNo = $(this).val();
    if ((EmpNo!='') && (EmpNo!=null)) {
		$("#cmb_nominee_name").chosen('destroy');
		$.ajax({
			type: 'POST',
			url: "{{ route('employee.GetEmployeeData') }}",
			data: { "_token": "{{ csrf_token() }}", 'EmpNo': EmpNo },
			// dataType: 'json',
			success: function (data) {
				if (data != '') {
					let EmpData = data['EmpData']; console.log(EmpData);
					let FamilyData = data['FamilyData']; console.log(FamilyData);
					if ((EmpData != '') && (EmpData != null)) {
						$.each(EmpData, function (index, element) {
							var Dob = GlobalFormatDateDDMMYYYY(element.emp_dob);
							var Doj = GlobalFormatDateDDMMYYYY(element.emp_doj);
							var Dor = GlobalFormatDateDDMMYYYY(element.emp_retirement_dt);
							$("#txt_icno").val(element.emp_no);
							$("#txt_payslip_name").val(element.emp_name_payslip);
							$("#txt_designation").val(element.designation_name);
							$("#txt_dob").val(Dob);         
							$("#txt_doj").val(Doj);
							$("#txt_date_retire").val(Dor);
							$("#txt_group").val(element.group);
							$("#txt_div").val(element.division_short_name);
							$("#txt_sec").val(element.section);
						});
					}
					if((FamilyData != '') && (FamilyData != null)){
						
						$.each(FamilyData, function (index, element) {
							$("#cmb_nominee_name").append('<option data-relationship="'+element.fam_relationship_id+'" value="'+element.family_det_id+'">'+element.fam_member_name+'</option>');
						}); 
					}else{
						BootstrapDialog.alert("Please enter the family Details in the  family  Members Add module");
						$("#txt_emp_no").val(''); 
					}
					$("#cmb_nominee_name").chosen();
				}
			}
		});
    }
	
}); */
$("body").on("change", "#cmb_nominee_name", function (event) {
	let FamilyDetId = $(this).val();
	let RelationShipId = $('#cmb_nominee_name option:selected').attr('data-relationship'); //$(this).find(':selected').data('relationship');
	$("#txt_relation_ship").val('');
	$.ajax({
		type: 'POST',
		url: "{{ route('relationship.get-relationship-relationid') }}",
		data: { "_token": "{{ csrf_token() }}", 'RelationshipId': RelationShipId },
		// dataType: 'json',
		success: function (data) {
			if(data != ''){
				let RelData = data['RelData'];
				$.each(RelData, function (index, element) {
					$("#txt_relation_ship").val(element.relationship_name);
				}); 
			}
		}
	});
});
var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var NomineeName  = $("#cmb_nominee_name").val();
			if(NomineeName == ""){
				BootstrapDialog.alert("Nominee Name  should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure want to Employee Nominee Update ?',
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
	});
</script>
@endsection
