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
		$Desig    = collect($Empdata)->pluck('designation_name')->first();
		$GroupId   = collect($Empdata)->pluck('group')->first();
		$DivId   = collect($Empdata)->pluck('division_short_name')->first();
		$SecId   = collect($Empdata)->pluck('section')->first();
	}
	if(isset($data['Branchdata'])){
		$Branchdata  = $data['Branchdata'];
		$BankName    = collect($Branchdata)->pluck('bank_name')->first();
		$BranchName  = collect($Branchdata)->pluck('branch_addr1')->first();
		$IfscCode    = collect($Branchdata)->pluck('ifsc_code')->first();
	}
	if(isset($data['Bankdata'])){
		$Bankdata          = $data['Bankdata'];
		$BankName          = collect($Bankdata)->pluck('bank_name')->first();
		$BranchName        = collect($Bankdata)->pluck('branch_addr1')->first();
		$AccountNo         = collect($Bankdata)->pluck('account_no')->first();
		$AccountHolderName = collect($Bankdata)->pluck('account_holder_name')->first();
		$IfscCode          = collect($Bankdata)->pluck('ifsc_code')->first();
	}

	if(((session('WcmsRoleGroupCode') == "ADMUSER")||(session('WcmsRoleGroupCode') == "SUPUSER"))){
		$IsAdmin = 1;
	}else{
		$IsAdmin = 0;
	}
	if(isset($data['EditClaimData']))
	{
		$EditClaimData      = $data['EditClaimData'];
		
		$ExistingBankName   = optional(json_decode($EditClaimData->old_value))->bank_name ?? '';
		$ExistingIfscCode   = optional(json_decode($EditClaimData->old_value))->ifsc_code ?? '';
		$ExistingAccNo      = optional(json_decode($EditClaimData->old_value))->account_no ?? '';
		$ExistingBranchAddr = optional(json_decode($EditClaimData->old_value))->branch_addr1 ?? '';
		$ExistingHolderName = optional(json_decode($EditClaimData->old_value))->account_holder_name ?? '';
		$ExistingBankId 	= optional(json_decode($EditClaimData->old_value))->bank_id ?? '';
		$ExistingBranchId   = optional(json_decode($EditClaimData->old_value))->branch_id ?? '';

		$NewBankName   = optional(json_decode($EditClaimData->new_value))->bank_name ?? '';
		$NewIfscCode   = optional(json_decode($EditClaimData->new_value))->ifsc_code ?? '';
		$NewAccNo      = optional(json_decode($EditClaimData->new_value))->account_no ?? '';
		$NewBranchAddr = optional(json_decode($EditClaimData->new_value))->branch_addr1 ?? '';
		$NewHolderName = optional(json_decode($EditClaimData->new_value))->account_holder_name ?? '';
		$NewBankId 	   = optional(json_decode($EditClaimData->new_value))->bank_id ?? '';
		$NewBranchId   = optional(json_decode($EditClaimData->new_value))->branch_id ?? '';
		$ChangeRequestId    = $EditClaimData->change_req_id;
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
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Bank Details Update -  Request Form</div></div></div>
								<div class="row innerdiv">
									<div class="row"> 
										 <!-- Form Steps --> 
										<div class="form-step active"> 
											<div class="row" align="right">
												@php 
													if($Page == 'REQ_APPLY'){
														$BackUrl = 'change-request.bank-details-change-request-list'; 
													}else if($Page == 'REQ_PROCESS'){
														$BackUrl = 'change-request.bank-details-change-request-pending-list'; 
													}else{
														$BackUrl = 'change-request.bank-details-change-request-list'; 
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
													<div class="div2"><input type="text" name="txt_emp_icno" id="txt_emp_icno" class="tboxsmclass" value="@if((isset($ICNo))&&($IsAdmin == 0)){{$ICNo}}@endif" readonly></div>
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
											<div class="row smclearrow"></div>

											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Existing Bank Information</legend>
												<div class="fieldbox-div">
													<div class="div2 label label"> Account Holder Name </br>(In Bank PassBook) <span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_account_oldname" id="txt_account_oldname" class="tboxsmclass" value="@if(isset($ExistingHolderName)){{$ExistingHolderName}}@elseif(isset($AccountHolderName)){{$AccountHolderName}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Bank Account No <span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_account_oldno" id="txt_account_oldno" class="tboxsmclass"  value="@if(isset($ExistingAccNo)){{$ExistingAccNo}}@elseif(isset($AccountNo)){{$AccountNo}}@endif" readonly></div>
													<div class="div2 label pd-l-20">IFSC Code <span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_ifsc_oldcode" id="txt_ifsc_oldcode" class="tboxsmclass" value="@if(isset($ExistingIfscCode)){{$ExistingIfscCode}}@elseif(isset($IfscCode)){{$IfscCode}}@endif"></div>
													<div class="row smclearrow"></div>
													<div class="div2 label label">Bank Name</div>
													<div class="div2"><input type="text" name="txt_bank_oldname" id="txt_bank_oldname" class="tboxsmclass" value="@if(isset($ExistingBankName)){{$ExistingBankName}}@elseif(isset($BankName)){{$BankName}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Bank Branch Address</div>
													<div class="div2"><input type="text" name="txt_branc_oldaddr" id="txt_branc_oldaddr" class="tboxsmclass" value="@if(isset($ExistingBranchAddr)){{$ExistingBranchAddr}}@elseif(isset($BranchName)){{$BranchName}}@endif" readonly></div>
													<input type="hidden" name="txt_oldbank_id" id="txt_oldbank_id" class="tboxsmclass" value="@if(isset($ExistingBankId)){{$ExistingBankId}}@endif" readonly>
													<input type="hidden" name="txt_oldbranch_id" id="txt_oldbranch_id" class="tboxsmclass" value="@if(isset($ExistingBranchId)){{$ExistingBranchId}}@endif" readonly>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>
											
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">New Bank Information</legend>
												<div class="fieldbox-div">
													<div class="div2 label label"> Account Holder Name </br>(In Bank PassBook) <span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_account_name" id="txt_account_name" class="tboxsmclass" value="@if(isset($NewHolderName)){{$NewHolderName}}@elseif(isset($AccountHolderName)){{$AccountHolderName}}@endif"></div>
													<div class="div2 label pd-l-20">Bank Account No. <span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_account_no" id="txt_account_no" class="tboxsmclass" value="@if(isset($NewAccNo)){{$NewAccNo}}@endif"></div>
													<div class="div2 label pd-l-20">IFSC Code <span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_ifsc_code" id="txt_ifsc_code" class="tboxsmclass" value="@if(isset($NewIfscCode)){{$NewIfscCode}}@endif"></div>
													<div class="row smclearrow"></div>
													<div class="div2 label label">Bank Name</div>
													<div class="div2"><input type="text" name="txt_bank_name" id="txt_bank_name" class="tboxsmclass" value="@if(isset($NewBankName)){{$NewBankName}}@endif" readonly></div>

													<div class="div2 label pd-l-20">Bank Branch Address</div>
													<div class="div2"><input type="text" name="txt_branc_addr" id="txt_branc_addr" class="tboxsmclass" value="@if(isset($NewBranchAddr)){{$NewBranchAddr}}@endif" readonly></div>
													<input type="hidden" name="txt_bank_id" id="txt_bank_id" class="tboxsmclass" value="@if(isset($NewBankId)){{$NewBankId}}@endif" readonly>
													<input type="hidden" name="txt_branch_id" id="txt_branch_id" class="tboxsmclass" value="@if(isset($NewBranchId)){{$NewBranchId}}@endif" readonly>
													<div class="div2 label pd-l-20">Supporting Document</div>
													<div class="div2"><input type="file"style="width:220px" id="file_emp_bank" name="file_emp_bank" class="step-btn" value="FILE"></button>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
										</div>
										
										<!-- <div class="row" align="center">
											<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" Back " onClick="window.location='{{route($BackUrl)}}'" />
											<button type="submit" id="btn_save" name="btn_save" class="step-btn" value="Save">SAVE</button>
										</div> -->
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="div12" align="center">
							<input type  ="hidden" name="hid_change_id" id="hid_change_id" value="@if(isset($ChangeRequestId)){{$ChangeRequestId}}@endif" />
							<input type="hidden" name="txt_tab" id="txt_tab" value="1" />
							<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
							<input type="hidden" name="txt_application_id" id="txt_application_id" value="@if(isset($ChangeRequestId)){{ encrypt($ChangeRequestId) }}@endif">
                            <input type="hidden" name="txt_action" id="txt_action" value="@if(isset($Action)){{ encrypt($Action) }}@endif">
							<input type="hidden" name="txt_page" id="txt_page" value="@if(isset($Action)){{ encrypt($Page) }}@endif">

							<input type="hidden" name="wf_module_code" id="wf_module_code" value="{{ encrypt('BANK') }}" />
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
					let BankDetail = data['BankDetail']; console.log(BankDetail);
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
						                              
                        });
						$.each(BankDetail, function (index, element) {
						   $("#txt_account_name").val(element.account_holder_name);
                           $("#txt_account_oldno").val(element.account_no);
                           $("#txt_ifsc_oldcode").val(element.ifsc_code);
						   $("#txt_bank_oldname").val(element.bank_name);
						   $("#txt_branc_oldaddr").val(element.branch_addr1);
						   $("#txt_account_oldname").val(element.account_holder_name);
						});
                    }else{
						BootstrapDialog.alert("Please Enter the Correct Employee Number");
						$("#txt_emp_no").val(''); 
					}
                }
            }
        });
    }
	
}); */

$("body").on("change", "#txt_ifsc_code", function (event) {
	//alert();
    var IfscCode = $(this).val();
    if ((IfscCode!='') && (IfscCode!=null)) {

        $.ajax({
            type: 'POST',
            url: "{{ route('bank.GetBankData') }}",
            data: { "_token": "{{ csrf_token() }}", 'IfscCode': IfscCode },
            // dataType: 'json',
            success: function (data) {
                if (data != '') {
                    let BankData = data['BankData']; console.log(BankData);
                    if ((BankData != '') && (BankData != null)) {
                        //$("#section_name").empty();
                        $.each(BankData, function (index, element) {
						   	$("#txt_bank_name").val(element.bank_name);
                           	$("#txt_branc_addr").val(element.branch_addr1);
							$("#txt_bank_id").val(element.bank_id);
							$("#txt_branch_id").val(element.branch_id);
                           
                        });
                    }else{
						BootstrapDialog.alert("Please Enter the Correct IFSC Code");
						$("#txt_ifsc_code").val(''); 
					}
                }
            }
        });
    }
	
});
var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var AccountName = $("#txt_account_name").val();
			var AccountNo   = $("#txt_account_no").val();
			var IfscCode   	= $("#txt_ifsc_code").val();
			
			if(AccountName == ""){
				BootstrapDialog.alert("Account Holder Name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(AccountNo == ""){
				BootstrapDialog.alert("Account No. should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(IfscCode == ""){
				BootstrapDialog.alert("Ifsc Code should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure want to Employee Bank Details Update ?',
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
@include('common-workflow.workflow-process')
@endsection
