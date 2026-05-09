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
	$DivId   = collect($Empdata)->pluck('division_short_name')->first();
	$SecId   = collect($Empdata)->pluck('section')->first();
	$oldTown = collect($Empdata)->pluck('emp_hometown')->first();
	
	
	
}

if(((session('WcmsRoleGroupCode') == "ADMUSER")||(session('WcmsRoleGroupCode') == "SUPUSER"))){
	$IsAdmin = 1;
}else{
	$IsAdmin = 0;
}

if(isset($data['EditClaimData']))
{
	$EditClaimData  = $data['EditClaimData'];
	$ExistingTown = optional(json_decode($EditClaimData->old_value))->emp_hometown ?? '';
	$NewTown      = optional(json_decode($EditClaimData->new_value))->emp_hometown ?? '';
	$ChangeRequestId = $EditClaimData->change_req_id;
	
}
if(isset($data['Page'])){
	$Page = $data['Page'];
	
}else{
	$Page = NULL;
}

$ActionStatus = $data['Action'] ?? '';
$ApplicationId = $data['ApplicationId'] ?? NULL;
$Action = $data['Action'] ?? '';
$WorkFlowActionData = $data['WorkFlowActionData'] ?? '';
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
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Home Town Update -  Request Form</div></div></div>
								<div class="row innerdiv">
									<div class="row"> 
										 <!-- Form Steps --> 
										<div class="form-step active"> 
											<div class="form-step active"> 
											<div class="row" align="right">
												@php 
												if($Page == 'REQ_APPLY'){
													$BackUrl = 'change-request.hometown-change-request-list'; 
												}else if($Page == 'REQ_PROCESS'){
													$BackUrl = 'change-request.hometown-change-request-pending-list'; 
												}else{
													$BackUrl = 'change-request.hometown-change-request-list'; 
												}
												@endphp
												<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" Back " onClick="window.location='{{route($BackUrl)}}'" />
												@if($ActionStatus == 'REQ_PROCESS')

												@php 
												$IsApprove = $WorkFlowActionData['IsApprove'] ?? NULL;
												
												$IsNext = $WorkFlowActionData['IsNext'] ?? NULL;
												$IsPrevious = $WorkFlowActionData['IsPrevious'] ?? NULL;
												@endphp

												@if($IsPrevious == 'Y')
												<button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="RJ" class="step-btn WorkFlowAction" value="REJECT">Return Back to Applicant</button>
												@endif

												@if($IsApprove == 'Y')
												<button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="AP" class="step-btn WorkFlowAction" value="APPROVE">Approve</button>
												@endif

												@if(($IsApprove == NULL) && ($IsNext == 'Y'))
												<button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="FW" class="step-btn WorkFlowAction" value="FORWARD">Recommend / Forward</button>
												@endif

												@if(($WorkFlowActionData['WorkFlowAction'] ?? null) === 'SU')
												<button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="SU" class="step-btn WorkFlowAction" value="SUBMIT">Submit</button>
												@endif

												@endif
											</div>
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Basic information</legend>
												<div class="fieldbox-div">
													<!-- @if($IsAdmin == 1)
													<div class="div2 label">Select Employee<span class="reqindi">*</span></div>
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
													<div class="div3"><input type="text" name="txt_emp_icno" id="txt_emp_icno" class="tboxsmclass" value="@if((isset($ICNo))&&($IsAdmin == 0)){{$ICNo}}@endif" readonly></div>
													@endif -->
													<div class="row smclearrow"></div>
													<div class="div2 label">IC No.</div> 
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
												<legend class="fieldbox-legend"> Existing Home Town </legend>
												<div class="fieldbox-div">
													<div class="div2 label">
														Existing Home Town<span class="reqindi">*</span>
													</div>
													<div class="div3">
														<textarea name="txt_old_hometown" id="txt_old_hometown" rows="4" class="tboxsmclass" readonly>@if(isset($oldTown)){{$oldTown}}@elseif(isset($ExistingTown)){{$ExistingTown}}@endif</textarea>
													</div>
																				
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>
											
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend"> New Home Town</legend>
												<div class="fieldbox-div">
													<div class="div2 label">
														New Home Town <span class="reqindi">*</span>
													</div>
													<div class="div3">
														<textarea name="txt_new_hometown" id="txt_new_hometown" rows="4" class="tboxsmclass alphanumeric">@if(isset($NewTown)){{$NewTown}}@endif</textarea>
													</div>
													<div class="div2 label">Supporting Document</div>
													<input type="file" id="file_emp_address" name="file_emp_address" class="step-btn"  accept="image/*"></button>
																							
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
										</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="div12" align="center">
							<input type="hidden" name="hid_change_id" id="hid_change_id" value="@if(isset($ChangeRequestId)){{$ChangeRequestId}}@endif" />
							<input type="hidden" name="txt_tab" id="txt_tab" value="1" />
							<input type="hidden" name="txt_application_id" id="txt_application_id" value="@if(isset($ChangeRequestId)){{ encrypt($ChangeRequestId) }}@endif">
                            <input type="hidden" name="txt_action" id="txt_action" value="@if(isset($Action)){{ encrypt($Action) }}@endif">
							<input type="hidden" name="txt_page" id="txt_page" value="@if(isset($Action)){{ encrypt($Page) }}@endif">
							<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

							<input type="hidden" name="wf_module_code" id="wf_module_code" value="{{ encrypt('HOMETOWN') }}" />
                            <input type="hidden" name="txt_wf_mode" id="txt_wf_mode" />
                            <input type="hidden" name="txt_actual_emp" id="txt_actual_emp" />
                            <input type="hidden" name="txt_wf_remark" id="txt_wf_remark" />
                            <input type="hidden" name="txt_wf_emp_no" id="txt_wf_emp_no" />
                            <input type="hidden" name="txt_wf_role" id="txt_wf_role" />
                            <input type="hidden" name="txt_wf_action" id="txt_wf_action" />
                            <input type="hidden" name="txt_role_position" id="txt_role_position" />
						</div>
					</div>
               				                      
				</blockquote>
			</div>
		</div>
	</div>
</form>
<script>
$(".ChosenInput").chosen();
/* $("body").on("change", "#txt_emp_icno", function (event) {
	
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
                        });
                $    }else{
						BootstrapDialog.alert("Please Enter the Correct Employee Number");
						$("#txt_emp_no").val(''); 
					}
                }
            }
        });
    }
	
}); */
</script>
@include('common-workflow.workflow-process')
@endsection
