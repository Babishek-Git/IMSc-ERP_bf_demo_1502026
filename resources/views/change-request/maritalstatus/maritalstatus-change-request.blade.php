@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php

 if(isset($data['Empdata'])){
	
	$Empdata  = $data['Empdata'];
	$ICNo     = collect($Empdata)->pluck('ic_no')->first();
	$EmpName  = collect($Empdata)->pluck('emp_first_name')->first();
	$EmpDOB   = collect($Empdata)->pluck('emp_dob')->first();
	$EmpDOJ   = collect($Empdata)->pluck('emp_doj')->first();
	$EmpRET   = collect($Empdata)->pluck('emp_retirement_dt')->first();
	$Desig    = collect($Empdata)->pluck('designation_name')->first();
	$GroupId   = collect($Empdata)->pluck('group')->first();
	$DivId   = collect($Empdata)->pluck('division_short_name')->first();
	$SecId   = collect($Empdata)->pluck('section')->first();
}
if(((session('WcmsRoleGroupCode') == "ADMUSER")||(session('WcmsRoleGroupCode') == "SUPUSER"))){
	$IsAdmin = 1;
}else{
	$IsAdmin = 0;
}
if(isset($data['EditClaimData']))
{
	$EditCliamData = $data['EditClaimData'];
	
	$NewSpouseDob      = optional(json_decode($EditCliamData->new_value))->Spouse_dob ?? '';
	$NewSpouseName     = optional(json_decode($EditCliamData->new_value))->Spouse_name ?? '';
	$NewSpouseIncome   = optional(json_decode($EditCliamData->new_value))->Spouse_income ?? '';
	$NewSpouseAadhar   = optional(json_decode($EditCliamData->new_value))->Spouse_aadhar ?? '';
	$NewSpouseBloodGrp = optional(json_decode($EditCliamData->new_value))->Spouse_bloodgrp ?? '';


	$OldSpouseDob   = optional(json_decode($EditCliamData->old_value))->Spouse_dob ?? '';
	$OldSpouseName = optional(json_decode($EditCliamData->old_value))->Spouse_name ?? '';
	$ChangeRequestId = $EditCliamData->change_req_id;
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
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Marital Update -  Request Form</div></div></div>
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
															@if(isset($data['MaritalData']))
															@foreach($data['MaritalData'] as $MaritalData)
																	<option value="{{$MaritalData->emp_no}}">{{$MaritalData->emp_first_name}} (IC No.{{$MaritalData->emp_no}}, {{$MaritalData->designation_name}})</option>
															@endforeach
															@endif
														</select>
													</div>
													@else
													<div class="div2 label label">IC No</div>
													<div class="div2"><input type="text" name="txt_emp_icno" id="txt_emp_icno" class="tboxsmclass" value="@if((isset($ICNo))&&($IsAdmin == 0)){{$ICNo}}@endif"></div>
													@endif -->
													<div class="row smclearrow"></div>
													<div class="div2 label">IC No.</div> 
													<div class="div2"><input type="text" name="txt_emp_icno" id="txt_emp_icno" class="tboxsmclass" value="@if(isset($ICNo)){{$ICNo}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Name</div>
													<div class="div2"><input type="text" name="txt_payslip_name" id="txt_payslip_name" class="tboxsmclass" value="@if(isset($EmpName)){{$EmpName}}@endif"></div>
													<div class="div2 label pd-l-20">Designation</div>
													<div class="div2"><input type="text" name="txt_designation" id="txt_designation" class="tboxsmclass" value="@if(isset($Desig)){{$Desig}}@endif"></div>
													<div class="div2 label">Date of Birth</div>
													<div class="div2"><input type="text" name="txt_dob" id="txt_dob" class="tboxsmclass" value="@if(isset($EmpDOB)){{Helper::DisplayDateFormat($EmpDOB)}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Date of Joining</div>
													<div class="div2"><input type="text" name="txt_doj" id="txt_doj" class="tboxsmclass" value="@if(isset($EmpDOJ)){{Helper::DisplayDateFormat($EmpDOJ)}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Date of Retirement</div>
													<div class="div2"><input type="text" name="txt_date_retire" id="txt_date_retire" class="tboxsmclass" value="@if(isset($EmpRET)){{Helper::DisplayDateFormat($EmpRET)}}@endif" readonly></div>
													<div class="div2 label label">Group</div>
													<div class="div2"><input type="text" name="txt_group" id="txt_group" class="tboxsmclass" value="@if(isset($GroupId)){{$GroupId}}@endif"></div>
													<div class="div2 label pd-l-20">Divison</div>
													<div class="div2"><input type="text" name="txt_div" id="txt_div" class="tboxsmclass" value="@if(isset($DivId)){{$DivId}}@endif"></div>
													<div class="div2 label pd-l-20">Section</div>
   												    <div class="div2"><input type="text" name="txt_sec" id="txt_sec" class="tboxsmclass" value="@if(isset($SecId)){{$SecId}}@endif"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend"> Marital Status Information</legend>
												<div class="fieldbox-div">
													<!-- <div class="div2 label label">Employee Name</div>
													<div class="div2">
														<select name="cmb_emp_name" id="cmb_emp_name" class="tboxsmclass ChosenInput disable">
															<option value="">-------- Select------</option>
															@if(isset($data['MaritalData']))
															@foreach($data['MaritalData'] as $MaritalData)
																<option value="{{$MaritalData->emp_no}}">{{$MaritalData->emp_first_name}}</option>
															@endforeach
															@endif
														</select>
													</div> -->
													                                                                               											
													<div class="div2  marital label label">Spouse Name </span>
														<input type="hidden" name="hid_emp_gender" id="hid_emp_gender" class="tboxsmclass " value="">
													</div>
													<div class="div2  marital"><input type="text" name="txt_spouse_name" id="txt_spouse_name" class="tboxsmclass" value="@if(isset($NewSpouseName)){{$NewSpouseName}}@endif"></div> 
													<div class="div2  marital label pd-l-20">Date of Birth</div>
													<div class="div2  marital"><input type="text" name="txt_spouse_dob" id="txt_spouse_dob" class="tboxsmclass  datepicker" value="@if(isset($NewSpouseDob)){{$NewSpouseDob}}@endif"></div>
													<div class="div2 label pd-l-20">Spouse Income</div>
													<div class="div2"><input type="text" name="txt_spouse_income" id="txt_spouse_income" class="tboxsmclass" value="@if(isset($NewSpouseIncome)){{$NewSpouseIncome}}@endif"></div>
													<div class="div2 label label">Spouse Aadhar No</div>
													<div class="div2"><input type="text" name="txt_spouse_aadhar" id="txt_spouse_aadhar" class="tboxsmclass" value="@if(isset($NewSpouseAadhar)){{$NewSpouseAadhar}}@endif"></div>
													<div class="div2 label pd-l-20">Spouse Blood Group</div>
													<div class="div2"><input type="text" name="txt_blood_group" id="txt_blood_group" class="tboxsmclass" value="@if(isset($NewSpouseBloodGrp)){{$NewSpouseBloodGrp}}@endif"></div>
													<div class="div2 label pd-l-20">Supporting Document</div>
											     	<div class="div2"><input type="file" id="file_emp_marriage" name="file_emp_marriage" class="step-btn" value="FILE"></button></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
										</div>
										@php 
									if($Page == 'REQ_APPLY'){
										$BackUrl = 'change-request.marital-change-request-list'; 
									}else{
										$BackUrl = 'change-request.marital-change-request-list'; 
									}
									@endphp
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
/* $("body").on("change", "#txt_emp_icno", function (event) {
	//alert();
    var EmpNo = $(this).val();
    if ((EmpNo!='') && (EmpNo!=null)) {

        $.ajax({
            type: 'POST',
            url: "{{ route('employee.GetEmployeeData') }}",
            data: { "_token": "{{ csrf_token() }}", 'EmpNo': EmpNo },
            // dataType: 'json',
            success: function (data) {
                if (data != '') {
                    let EmpData = data['EmpData']; console.log(EmpData);
                    if ((EmpData != '') && (EmpData != null)) {
                        //$("#section_name").empty();
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
                           $("#txt_cont_oldaddress").val(element.emp_address);
                           $("#hid_emp_gender").val(element.emp_gender);
						   
                        });
                    }else{
						BootstrapDialog.alert("Please Enter the Correct Employee Number");
						$("#txt_emp_no").val(''); 
					}
                }
            }
        });
    }
	
});
 */var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var SpouseName = $("#txt_spouse_name").val();
			var SpouseDob   = $("#txt_spouse_dob").val();
						
			if(SpouseName == ""){
				BootstrapDialog.alert("Spouse Name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(SpouseDob == ""){
				BootstrapDialog.alert("Spouse Dob should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure want to Employee Marital Status Update ?',
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
