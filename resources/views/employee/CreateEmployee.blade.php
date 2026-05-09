@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php 
$EmpGroupId = NULL; $EmpGroupCode  = NULL;
if(isset($data['employeeGroupMaster'])){
	$employeeGroupMaster = $data['employeeGroupMaster'];
	if(filled($employeeGroupMaster)){
		$EmpGroupId = collect($employeeGroupMaster)->pluck('emp_group_id')->first();
		$EmpGroupCode = collect($employeeGroupMaster)->pluck('emp_group_code')->first();
		$EmpGroupName = collect($employeeGroupMaster)->pluck('emp_group_name')->first();
	}
}
$RetirementLabelArr = [];
$RetirementLabelArr['STAFF'] 		 = 'Date of Retirement';
$RetirementLabelArr['PROFESSOR'] 	 = 'Date of Retirement';
$RetirementLabelArr['TRAINEE'] 		 = 'End of Tenure';
$RetirementLabelArr['RESEARCH_SCH']  = 'End of Tenure';
$RetirementLabelArr['PROJECT_STAFF'] = 'End of Tenure';

$LevelVisible = 0;
$LevelApplicableGrpArr = array('STAFF','PROFESSOR');
if(in_array($EmpGroupCode, $LevelApplicableGrpArr)){
	$LevelVisible = 1;
}

$ProjectVisible = 0;
$ProjectVisibleGrpArr = array('PROJECT_STAFF');
if(in_array($EmpGroupCode, $ProjectVisibleGrpArr)){
	$ProjectVisible = 1;
}

$DORLabel      = "Date of Retirement";
$EMPLabel      = "Employee";  
$DivisionLable = "Division";
$SecLabel      = "Section";
$designation   = "Designation";
if(isset($data['fieldLabelLists'])){
    foreach($data['fieldLabelLists'] as $fieldLabelList){
        if($fieldLabelList->field_code == "DOR"){
            $DORLabel = $fieldLabelList->field_label_display ?: $DORLabel;
        }

        if($fieldLabelList->field_code == "EMP"){ 
            $EMPLabel = $fieldLabelList->field_label_display ?: $EMPLabel;
        }

		if($fieldLabelList->field_code == "DIVISION"){
            $DivisionLable = $fieldLabelList->field_label_display ?: $DivisionLable;
		}

		if($fieldLabelList->field_code == "SEC"){
            $SecLabel = $fieldLabelList->field_label_display ?: $SecLabel;
		}

		if($fieldLabelList->field_code == "DESG"){
            $designation = $fieldLabelList->field_label_display ?: $designation;
		}
		
    }
}

if(isset($data['EditEmpBasicData'])){
	$EditEmpBasicData   = $data['EditEmpBasicData'];
	$EmpNo              = collect($EditEmpBasicData)->pluck('emp_no')->first();
	$EmpFirstName       = collect($EditEmpBasicData)->pluck('emp_first_name')->first();
	$EmpMiddleName      = collect($EditEmpBasicData)->pluck('emp_middle_name')->first();
	$EmpLastName        = collect($EditEmpBasicData)->pluck('emp_last_name')->first();
	$PayslipName        = collect($EditEmpBasicData)->pluck('emp_name_payslip')->first();
	$EmpDOB             = collect($EditEmpBasicData)->pluck('emp_dob')->first();
	$EmpCategory        = collect($EditEmpBasicData)->pluck('emp_category')->first();
	$EmpGender        = collect($EditEmpBasicData)->pluck('emp_gender')->first();
	$EmpSalute        = collect($EditEmpBasicData)->pluck('emp_salute')->first();
	$EmpDOJ        = collect($EditEmpBasicData)->pluck('emp_doj')->first();
	$EmpRET        = collect($EditEmpBasicData)->pluck('emp_retirement_dt')->first();
	$Desig         = collect($EditEmpBasicData)->pluck('designation_name')->first();
	$DescId        = collect($EditEmpBasicData)->pluck('emp_designation_id')->first();
	$GroupId       = collect($EditEmpBasicData)->pluck('group_id')->first();
	$DivId         = collect($EditEmpBasicData)->pluck('division_id')->first();
	$SecId         = collect($EditEmpBasicData)->pluck('section_id')->first();
	$Maritalstaus  = collect($EditEmpBasicData)->pluck('emp_marital_status')->first();
	$MobileNo      = collect($EditEmpBasicData)->pluck('emp_mobile')->first();
	$MailId        = collect($EditEmpBasicData)->pluck('emp_off_email')->first();
	$Address       = collect($EditEmpBasicData)->pluck('emp_address')->first();
	$PersonalMobileNo = collect($EditEmpBasicData)->pluck('emp_personal_mobile_no')->first();
	$PersonalMailId   = collect($EditEmpBasicData)->pluck('emp_personal_mail_id')->first();
	$PersonalAddress  = collect($EditEmpBasicData)->pluck('emp_permanent_addres')->first();
	$Aadhar        = collect($EditEmpBasicData)->pluck('emp_aadhaar_no')->first();
	$PanNo         = collect($EditEmpBasicData)->pluck('emp_pan_no')->first();
	$ExtenNo       = collect($EditEmpBasicData)->pluck('emp_off_ext_no')->first();
	$IsPhysical    = collect($EditEmpBasicData)->pluck('is_phy_challange')->first();
	$PhysicalType  = collect($EditEmpBasicData)->pluck('phy_challange_type')->first();
	$PhysicalPerc  = collect($EditEmpBasicData)->pluck('phy_challange_perc')->first();
	
	$EmpNatioanlity= collect($EditEmpBasicData)->pluck('emp_nationality')->first();
	$EmpHometown   = collect($EditEmpBasicData)->pluck('emp_hometown')->first();
	$EmpHometownState   = collect($EditEmpBasicData)->pluck('emp_home_town_state')->first();
	$EmpHometownRailStation   = collect($EditEmpBasicData)->pluck('emp_home_town_near_rail_station')->first();
	$EmpHometownAddr   = collect($EditEmpBasicData)->pluck('emp_home_town_address')->first();

	$EmpCountry    = collect($EditEmpBasicData)->pluck('emp_country')->first();
	$EmpPassportNo = collect($EditEmpBasicData)->pluck('emp_passport_no')->first();
	$VisitorCatagory    = collect($EditEmpBasicData)->pluck('visitor_catagory_id')->first();
	$FatherName    = collect($EditEmpBasicData)->pluck('emp_father_name')->first();
	$MotherName    = collect($EditEmpBasicData)->pluck('emp_mother_name')->first();

	$BloodGroup    = collect($EditEmpBasicData)->pluck('emp_blood_group')->first();
	$Height    = collect($EditEmpBasicData)->pluck('emp_height')->first();
	$IdentityMark    = collect($EditEmpBasicData)->pluck('emp_identity_mark')->first();
	$pdfname         = collect($EditEmpBasicData)->pluck('emp_pdf_name')->first();
	$phdriphf        = collect($EditEmpBasicData)->pluck('cmb_pdforipdf')->first();
}

if(isset($data['EditEmpBankData'])){
	$EditEmpBankData  = $data['EditEmpBankData'];
	$ICNo             = collect($EditEmpBankData)->pluck('emp_no')->first();
	$BankId           = collect($EditEmpBankData)->pluck('bank_id')->first(); 
	$BranchId         = collect($EditEmpBankData)->pluck('branch_id')->first();
	$AccountNo        = collect($EditEmpBankData)->pluck('account_no')->first();
	$BankName         = collect($EditEmpBankData)->pluck('bank_name')->first();
	$BranchName       = collect($EditEmpBankData)->pluck('branch_addr1')->first();
	$AccountName      = collect($EditEmpBankData)->pluck('account_holder_name')->first();
	$IfscCode         = collect($EditEmpBankData)->pluck('ifsc_code')->first();
}
if(isset($data['EditEmpEducationData'])){
	$EditEmpEducationData  = $data['EditEmpEducationData'];
	$ICNo             = collect($EditEmpEducationData)->pluck('emp_no')->first();
	$EducationLevel   = collect($EditEmpEducationData)->pluck('education_level')->first();
	$Qualification    = collect($EditEmpEducationData)->pluck('qualification')->first();
	$InstitudeName    = collect($EditEmpEducationData)->pluck('institute_name')->first();
	$BoardUniversity  = collect($EditEmpEducationData)->pluck('board_university')->first();
	$YearPassing      = collect($EditEmpEducationData)->pluck('year_passing')->first();
}
if(isset($data['EditEmpEducationData'])){
$EmpPay          = $data['Editpaydetail'];
}

if(isset($data['Page'])){
	$Page = $data['Page'];
}else{
	$Page = '';
}

$RelIndex = 1;
$EduIndex = 1;
$LicIndex = 1;
$PliIndex = 1;
@endphp
<style>
    .checkbox{
		margin-top: 5px;
  		margin-bottom: 5px;
	}
	
	.checkbox-group h2 {
		color: #667eea;
		margin-bottom: 15px;
		font-weight: 600;
	}
	input[type="checkbox"] {
		display: none;
	}
	.checkbox-wrapper-2 {
		display: flex;
		align-items: center;
		perspective: 1000px;
	}

	.checkbox-wrapper-2 label {
		display: flex;
		align-items: center;
		cursor: pointer;
		font-size: 12px;
		color: #0000CD;
		font-weight: bold;
	}

	.checkbox-wrapper-2 .checkbox {
		width: 25px;
		height: 25px;
		margin-right: 15px;
		position: relative;
		transform-style: preserve-3d;
		transition: transform 0.6s;
	}

	.checkbox-wrapper-2 .checkbox-front,
	.checkbox-wrapper-2 .checkbox-back {
		width: 100%;
		height: 100%;
		position: absolute;
		backface-visibility: hidden;
		border-radius: 12px;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 15px;
		font-weight: bold;
	}

	.checkbox-wrapper-2 .checkbox-front {
		background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
		color: white;
	}

	.checkbox-wrapper-2 .checkbox-back {
		background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
		transform: rotateY(180deg);
		color: white;
	}

	.checkbox-wrapper-2 input:checked + label .checkbox {
		transform: rotateY(180deg);
	}
	.bottom-border {
		position: relative;
		padding: 1px 0;
		margin-bottom: 10px;
	}

	.bottom-border::after {
		content: '';
		position: absolute;
		bottom: 0;
		left: 50%;
		transform: translateX(-50%);
		width: 100%;
		height: 1px;
		background: linear-gradient(90deg, 
			transparent 0%, 
			#ccc 20%, 
			#ccc 50%, 
			#ccc 80%, 
			transparent 100%
		);
	}

	.upload-box-3 {
		border: 1px solid #e0e0e0;
		border-radius: 15px;
		padding: 25px;
		background: white;
	}

	.upload-box-3 h3 {
		color: #333;
		margin-bottom: 20px;
		font-size: 18px;
	}

	.image-grid {
		display: grid;
		grid-template-columns: repeat(3, 1fr);
		gap: 10px;
		margin-bottom: 15px;
	}

	.image-item {
		aspect-ratio: 1;
		border: 2px dashed #ddd;
		border-radius: 10px;
		display: flex;
		align-items: center;
		justify-content: center;
		cursor: pointer;
		overflow: hidden;
		position: relative;
		background: #f9f9f9;
		transition: all 0.3s ease;
	}

	.image-item:hover {
		border-color: #667eea;
		background: #f0f2ff;
	}

	.image-item img {
		width: 100%;
		height: 100%;
		object-fit: cover;
		display: none;
	}

	.image-item.has-image {
		border-style: solid;
		border-color: #667eea;
	}

	.image-item.has-image img {
		display: block;
	}

	.image-item .plus-icon {
		font-size: 20px;
		color: #ccc;
	}

	.image-item.has-image .plus-icon {
		display: none;
	}

	.image-item .remove-btn {
		position: absolute;
		top: 5px;
		right: 5px;
		background: rgba(255, 0, 0, 0.8);
		color: white;
		border: none;
		border-radius: 50%;
		width: 25px;
		height: 25px;
		font-size: 16px;
		cursor: pointer;
		display: none;
		align-items: center;
		justify-content: center;
	}

	.image-item.has-image .remove-btn {
		display: flex;
	}

	.upload-box-3 input[type="file"] {
		display: none;
	}
	.instruction-list {
		list-style: none;
		padding: 0;
		margin: 0;
	}

	.instruction-list li {
		position: relative;
		padding: 5px 15px 5px 50px;
		margin-bottom: 7px;
		background: linear-gradient(135deg, #f8f9ff 0%, #e8eeff 100%);
		border-left: 2px solid #667eea;
		border-radius: 8px;
		font-size: 11px;
		color: #333;
		transition: all 0.3s ease;
		box-shadow: 0 2px 5px rgba(0,0,0,0.05);
	}

	.instruction-list li:hover {
		transform: translateX(5px);
		box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15);
		background: linear-gradient(135deg, #e8eeff 0%, #d8e5ff 100%);
	}

	.instruction-list li::before {
		content: "✓";
		position: absolute;
		left: 15px;
		top: 50%;
		transform: translateY(-50%);
		width: 24px;
		height: 24px;
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		color: white;
		border-radius: 50%;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 14px;
		font-weight: bold;
		box-shadow: 0 2px 5px rgba(102, 126, 234, 0.3);
	}
	.div2{
		margin-top: 2px;
	}
	.emp-notes{
		color: #000;
		font-style: italic;
		margin-left: 20px;
		font-size: small;
	}
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
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">{{$EmpGroupName}} Registration</div></div></div>
								<div class="row innerdiv">
									<div class="row"> 
										<!-- Step Panels --> 
										 <div class="step-panels"> 
											@php $step = 1; @endphp
											<div class="step active"> <span class="step-span step-span-active">{{ $step++ }}</span> Personal Details</div> 
											<div class="step" style="white-space: nowrap;"><span class="step-span">{{ $step++ }}</span> Education & Bank Details &nbsp;</div> 
											@if(in_array('EFAMD', $data['menuCodes']))
												<div class="step"><span class="step-span">{{ $step++ }}</span> Family Details</div> 
											@endif
											@if(in_array('EINSD', $data['menuCodes']))
												<div class="step"><span class="step-span">{{ $step++ }}</span> Insurance Details</div> 
											@endif
											<div class="step"><span class="step-span">{{ $step++ }}</span> Others</div> 
										</div> 
										<div class="row smclearrow">
											<!-- Navigation Buttons --> 
											<div class="" style="padding-left:20px; padding-right:20px;"> 
												<div class="row smclearrow"></div> 
												<div class="row smclearrow"></div> 
												<div class="row smclearrow"></div> 
												@php 
													if($Page == 'EDIT_REG'){
														$BackUrl = 'employee.view-employee-list'; 
													}else{
														$BackUrl = 'employee.createEmployee'; 
													}
												@endphp
												<button type="button" class="backbutton" id="btn_view" onClick="window.location='{{route($BackUrl)}}'">Back</button>
												<button type="button" id="prevBtn" class="step-btn step-btn-next">Previous</button> 
												<span style="float:right; display:block !important">
													<button type="submit" id="SaveDraft" name="SaveDraft" class="step-btn SaveDraft hide" value="Save and Continue">Save</button> 
													<button type="button" name="nextBtn" id="nextBtn" class="step-btn step-btn-prev">Next</button> 
												</span>
											</div> 
											<!-- Step Indicator --> 
											<div class="step-indicator" id="step-indicator">Step 1 of 5</div> 
										</div>
										<!-- Form Steps --> 
										<div class="form-step"> 
											<input type="hidden" id="is_project_applicable" name="is_project_applicable" value="{{in_array('EPROJECT', $data['menuCodes']) ? 1 : 0}}">
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Basic information</legend>
												<div class="fieldbox-div">
													@if(in_array('ICNO', $data['menuCodes']))
													<input type="hidden" name="txt_emp_icno" id="txt_emp_icno" class="tboxsmclass pd-l-20" 
														value="{{$EmpNo ? $EmpNo : ''}}">
													@endif
													@if(!in_array('EMP', $data['menuCodes']))
													<div class="div2 label">{{$EMPLabel}} <span class="reqindi">*</span></div>
													<div class="div2">
														<select name="cmb_employment_group" id="cmb_employment_group" class="tboxsmclass ChosenInput">
															@if(isset($data['employeeGroupMaster']))
																@foreach($data['employeeGroupMaster'] as $EmployeeGroupMasterList)
																	<option value="{{$EmployeeGroupMasterList->emp_group_id}}">{{$EmployeeGroupMasterList->emp_group_name}}</option>
																@endforeach
															@endif
														</select>
													</div>
													@endif
													@if(in_array('EMP', $data['menuCodes']))
													<div class="div2 label">Visitor Category <span class="reqindi">*</span></div>
													<div class="div2">
														<select name="cmb_visitor_catagory" id="cmb_visitor_catagory" class="tboxsmclass ChosenInput">
															<option value="">----- Select -----</option>	
															@if(isset($data['VisitorCatagory']))
																@foreach($data['VisitorCatagory'] as $VisitorCatagory)
																	<option value="{{$VisitorCatagory->visitor_cata_id}}"
																	{{$VisitorCatagory ==  $VisitorCatagory->visitor_cata_id ? 'selected' : ''}}>
																	{{$VisitorCatagory->visit_cata_name}}</option>
																@endforeach
															@endif
														</select>
													</div>
													@endif
												 	<div class="div2 label label pd-l-20">IC No <span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_emp_icno" id="txt_emp_icno" class="tboxsmclass" value="@if(isset($EmpNo)){{$EmpNo}}@endif"></div>
													<div class="div2 label label pd-l-20">Salutation</div>
													<div class="div2">
														<select name="cmb_emp_salute" id="cmb_emp_salute" class="tboxsmclass ChosenInput">
															<option value="">----- Select -----</option>
															@if(isset($data['employeeSalute']))
																@foreach($data['employeeSalute'] as $EmployeeSaluteList)
																	@php 
																		$SelStr = '';
																		if(isset($EmpSalute)){
																			if($EmpSalute == $EmployeeSaluteList->salute_id){
																				$SelStr = 'selected="selected"';
																			}
																		}
																	@endphp
																	<option value="{{$EmployeeSaluteList->salute_id}}" {{ $SelStr }}>{{$EmployeeSaluteList->salute_name}}</option>
																@endforeach
															@endif
														</select>
													</div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>	
													<div class="div2 label">{{$EMPLabel}} Name <span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_emp_first_name" id="txt_emp_first_name" class="tboxsmclass" 
														value="@if(isset($EmpFirstName)){{$EmpFirstName}}@endif"></div>
													<div class="div2 label pd-l-20">Father Name</div>
													<div class="div2"><input type="text" name="txt_emp_father_name" id="txt_emp_father_name" class="tboxsmclass" 
														value="@if(isset($FatherName)){{$FatherName}}@endif"></div>
													<div class="div2 label label pd-l-20">Mother Name</div>
													<div class="div2"><input type="text" name="txt_emp_mother_name" id="txt_emp_mother_name" class="tboxsmclass" 
														value="@if(isset($MotherName)){{$MotherName}}@endif"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>	
													<div class="div2 label">Name in Payslip <span class="reqindi">*</span></div>
													<div class="div6"><input type="text" name="txt_payslip_name" id="txt_payslip_name" class="tboxsmclass" 
														value="@if(isset($PayslipName)){{$PayslipName}}@endif"></div>
													<div class="div2 label pd-l-20">
														Gender <span class="reqindi">*</span>
													</div>
													<div class="div2 label"> 
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2"> 
																<input id="rad_gender_male" name="rad_gender" type="radio" value="M" {{ isset($EmpGender) && $EmpGender == 'M' ? 'checked' : '' }} />
																<label for="rad_gender_male" style="padding:3px 0px; width:100%"> &nbsp;Male</label>
															</div>
														</div>
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_gender_female" name="rad_gender" type="radio" value="F" {{ isset($EmpGender) && $EmpGender == 'F' ? 'checked' : '' }} />
																<label for="rad_gender_female" style="padding:3px 0px; width:100%"> &nbsp;Female</label>
															</div>
														</div>
													</div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													@if(!in_array('VISSTAFF', $data['menuCodes']))
														<div class="div2 label">
															{{$designation}} <span class="reqindi">*</span>
														</div>
														<div class="div2">
															<select name="cmb_designation" id="cmb_designation" class="tboxsmclass ChosenInput">
																@if($EMPLabel != "Research Scholar")
																<option value="">------ Select -----</option>
																@endif
																@if(isset($data['desiginationList']))
																	@foreach($data['desiginationList'] as $DesiginationList)
																	@php
																	$selstr= "";
																	if(isset($DescId)){
																		if($DescId == $DesiginationList->designation_id)
																		{
																			$selstr='selected="selected"';
																		}
																	}
																	@endphp
																		<option value="{{$DesiginationList->designation_id}}" {{$selstr}}>{{$DesiginationList->designation_name}}</option>
																	@endforeach
																@endif
																
															</select>
														</div>
														@if(in_array('PDFrIPDF', $data['menuCodes']))
															@if(in_array('PDF', $data['menuCodes']))
																<div class="div2 label pd-l-20">
																	PDF/NPDF <span class="reqindi">*</span>
																</div>
																<div class="div2">
																	<select name="cmb_pdfrnpdf" id="cmb_pdfrnpdf" class="tboxsmclass ChosenInput">
																		<option value="">------ Select -----</option>
																		@if(isset($data['PdfLists']))
																		@foreach($data['PdfLists'] as $PdfList)
																		@php
																			$SelPdfStr = '';
																			if(isset($pdfname)){
																				if($pdfname == $PdfList->emp_pdf_name){
																					$SelPdfStr = 'selected="selected"';
																				}
																			}
																			@endphp
																		<option value="{{$PdfList->emp_pdf_name}}" {{ $SelPdfStr }}>{{$PdfList->emp_pdf_name}}</option>
																		@endforeach
																		@endif
																		<option value="Others">Others</option>
																	</select>
																	<input type="text" name="txt_other_pdf_name" id="txt_other_pdf_name" style="margin-top:4px;display:none;" class="tboxsmclass">
																</div>
																
															@else
															<div class="div2 label pd-l-20">
																Ph.D/I. Ph.D <span class="reqindi">*</span>
															</div>
															<div class="div2">
																<select name="cmb_pdforipdf" id="cmb_pdforipdf" class="tboxsmclass ChosenInput">
																	<option value="">------ Select -----</option>
																	<option value="ph.D">Ph.D</option>
																	<option value="Integrated Ph.D">Integrated Ph.D</option>
																</select>
															</div>
															@endif
															<div class="div2 label pd-l-20">
																{{$DivisionLable}}<span class="reqindi">*</span>
															</div>
															<div class="div2">
																<select name="cmb_division" id="cmb_division" class="tboxsmclass ChosenInput">
																	<option value="">------ Select -----</option>
																	@if(isset($data['OfficeDivisonList']))
																	@foreach($data['OfficeDivisonList'] as $Division)
																		@php
																		$SelDivStr = '';
																		if(isset($DivId)){
																			if($DivId == $Division->office_id){
																				$SelDivStr = 'selected="selected"';
																			}
																		}
																		@endphp
																		<option value="{{$Division->office_id}}" {{ $SelDivStr }}>{{$Division->office_name}}</option>
																	@endforeach
																	@endif
																</select>
															</div>
															<!-- <div class="div2 label pd-l-20">
																Single/Dual <span class="reqindi">*</span>
															</div>
															<div class="div2">
																<select name="cmb_singleordual" id="cmb_singleordual" class="tboxsmclass ChosenInput">
																	<option value="">------ Select -----</option>
																	<option value="5 Years">5 Years</option>
																	<option value="6 Years">6 Years</option>
																</select>
															</div> -->
														@endif
														@if(!in_array('PDFrIPDF', $data['menuCodes']))
															<div class="div2 label pd-l-20">
																Category <span class="reqindi">*</span>
															</div>
															<div class="div2">
																<select name="cmb_category" id="cmb_category" class="tboxsmclass ChosenInput">
																	<option value="">------ Select -----</option>
																	@if(isset($data['categoryList']))
																		@foreach($data['categoryList'] as $CategoryList)
																			@php
																			$selstr= "";
																			if(isset($EmpCategory)){
																				if($EmpCategory == $CategoryList->emp_category_code)
																				{
																					$selstr='selected="selected"';
																				}
																			}
																			@endphp
																			<option value="{{$CategoryList->emp_category_code}}" {{$selstr}}>{{$CategoryList->emp_category}}</option>
																		@endforeach
																	@endif
																	
																</select>
															</div>
															<div class="div2 label pd-l-20">
																Marital Status <span class="reqindi">*</span>
															</div>
															<div class="div2"> 
																<select name="cmb_marital_status" id="cmb_marital_status" class="tboxsmclass ChosenInput">
																	<option value="">------ Select -----</option>
																	@if(isset($data['employeeMaritalStatus'])) 
																		@foreach($data['employeeMaritalStatus'] as $EmployeeMaritalStatusList) 
																		@php
																			$selstr= "";
																			if(isset($Maritalstaus)){
																				if($Maritalstaus == $EmployeeMaritalStatusList->mar_status_code)
																				{
																					$selstr='selected="selected"';
																				}
																			}
																			@endphp
																			<option value="{{$EmployeeMaritalStatusList->mar_status_code}}" {{$selstr}}>{{$EmployeeMaritalStatusList->mar_status}}</option>
																		@endforeach
																	@endif
																	
																</select>
															</div>
														@endif
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
														<div class="div2 label">Date of Birth <span class="reqindi">*</span></div>
														<div class="div2"><input type="text" name="txt_dob" id="txt_dob" class="tboxsmclass  datepicker" value="@if(isset($EmpDOB)){{Helper::DisplayDateFormat($EmpDOB)}}@endif"></div>
														<div class="div2 label pd-l-20">Date of Joining <span class="reqindi">*</span></div>
														<div class="div2"><input type="text" name="txt_doj" id="txt_doj" class="tboxsmclass datepicker" value="@if(isset($EmpDOJ)){{Helper::DisplayDateFormat($EmpDOJ)}}@endif" onchange="getFellowshipAmount()">
														</div>
														<div class="div2 label pd-l-20">
															{{$DORLabel}} <span class="reqindi">*</span>
															<input type="hidden" id="dor_label" value="{{ $DORLabel }}">
														</div>
														<div class="div2"><input type="text" name="txt_date_retire" id="txt_date_retire" class="tboxsmclass  datepicker" value="@if(isset($EmpRET)){{Helper::DisplayDateFormat($EmpRET)}}@endif"></div>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
													@endif
													<div class="div2 label">Aadhaar No.</div>
													<div class="div2"><input type="text" name="txt_aadhaar" id="txt_aadhaar" class="tboxsmclass" value="@if(isset($Aadhar)){{$Aadhar}}@endif"></div>
													<div class="div2 label pd-l-20">PAN No.</div>
													<div class="div2"><input type="text" name="txt_pan_no" id="txt_pan_no" class="tboxsmclass" value="@if(isset($PanNo)){{$PanNo}}@endif"></div>
													<div class="div2 label pd-l-20">
														Nationality<span class="reqindi">*</span>
													</div>
													<div class="div2"> 
														@php 
															$IndSelStr = ''; $OthSelStr = '';
															if(isset($EmpNatioanlity)){
																if($EmpNatioanlity == 'I'){
																	$IndSelStr = 'selected="selected"';
																}
																if($EmpNatioanlity == 'O'){
																	$OthSelStr = 'selected="selected"';
																}
															}
														@endphp
														<select name="cmb_nationality" id="cmb_nationality" class="boxsmclass ChosenInput">
															<option value="">----Select----</option>
															<option value="I" {{ $IndSelStr }}>Indian</option>
															<option value="O" {{ $OthSelStr }}>Others</option>
														</select>
													</div>
													<div class="row smclearrow" id="passport_section" style="display:none;">
														<div class="div2 label">Country Name</div>
														<div class="div2"><input type="text" name="txt_country_name" id="txt_country_name" class="tboxsmclass" value="@if(isset($EmpCountry)){{$EmpCountry}}@endif"></div>
														<div class="div2 label pd-l-20">Passport No.</div>
														<div class="div2"><input type="text" name="txt_passport_no" id="txt_passport_no" class="tboxsmclass" value="@if(isset($EmpPassportNo)){{$EmpPassportNo}}@endif"></div>
													</div>

													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											@if(in_array('EPROJECT', $data['menuCodes']))
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Project Information</legend>
												<div class="fieldbox-div">
													<div class="div2 label pd-l-20">Project/Sub Project</div>
													<div class="div10"> 
														<select name="cmb_emp_project" id="cmb_emp_project" class="tboxsmclass ChosenInput"> 
															<option value=""> ---- Select ---- </option> 
															@if(isset($data['ProjectMaster']))
															@foreach($data['ProjectMaster'] as $project)
															<option value="{{ $project->project_id }}">{{ $project->full_heads }}</option> 
															@endforeach
															@endif
														</select>
													</div>
													<div class="row smclearrow"></div>
													<div class="div2 label pd-l-20">
														Name Of PI<span class="reqindi">*</span>
													</div>
													<div class="div4">
														<select name="cmb_project_guide" id="cmb_project_guide" class="tboxsmclass ChosenInput">
															<option value="">------ Select ------</option>	
															@if(isset($data['GuideLists']))
															@foreach($data['GuideLists'] as $GuideList)
																<option value="{{$GuideList->emp_no}}">{{$GuideList->emp_name_payslip}}</option>
															@endforeach
															@endif
														</select>
													</div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>	
											@endif
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											@if(in_array('EORGINFO', $data['menuCodes']))
												<fieldset class="fieldbox">
													<legend class="fieldbox-legend">Organizational Information</legend>
													<div class="fieldbox-div">
														<div class="div2 label pd-l-20">
															Group <span class="reqindi">*</span>
														</div>
														<div class="div2">
															<select name="cmb_group" id="cmb_group" class="tboxsmclass ChosenInput">
																@if(isset($data['officeList']))
																@foreach($data['officeList'] as $Group)
																	@php
																	$SelGrpStr = '';
																	if(isset($GroupId)){
																		if($GroupId == $Group->office_id){
																			$SelGrpStr = 'selected="selected"';
																		}
																	}
																	@endphp
																	<option value="{{$Group->office_id}}" {{ $SelGrpStr }}>{{$Group->office_name}}</option>
																@endforeach
																@endif
															</select>
														</div>
														<div class="div2 label pd-l-20">
															{{$DivisionLable}}<span class="reqindi">*</span>
														</div>
														<div class="div2">
															<select name="cmb_division" id="cmb_division" class="tboxsmclass ChosenInput">
																<option value="">------ Select -----</option>
																@if(isset($data['OfficeDivisonList']))
																@foreach($data['OfficeDivisonList'] as $Division)
																	@php
																	$SelDivStr = '';
																	if(isset($DivId)){
																		if($DivId == $Division->office_id){
																			$SelDivStr = 'selected="selected"';
																		}
																	}
																	@endphp
																	<option value="{{$Division->office_id}}" {{ $SelDivStr }}>{{$Division->office_name}}</option>
																@endforeach
																@endif
															</select>
														</div>
														<div class="div2 label pd-l-20">
															{{$SecLabel}} <span class="reqindi">*</span>
														</div>
														<div class="div2"> 
															<select name="cmb_section" id="cmb_section" class="tboxsmclass ChosenInput">
																<option value="">------ Select ------</option>
																@if(isset($data['OfficeSectionList']))
																@foreach($data['OfficeSectionList'] as $Section)
																	@php
																	$SelSecStr = '';
																	if(isset($SecId)){
																		if($SecId == $Section->office_id){
																			$SelSecStr = 'selected="selected"';
																		}
																	}
																	@endphp
																	<option value="{{$Section->office_id}}" {{ $SelSecStr }}>{{$Section->office_name}}</option>
																@endforeach
																@endif
															</select>
														</div>

														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
													</div>
												</fieldset>
											@endif
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											@if(in_array('VISITOR', $data['menuCodes']))
												<fieldset class="fieldbox">
													<legend class="fieldbox-legend">Visitor Details</legend>
													<div class="fieldbox-div">
														<div class="div2 label">Institute Name<span class="reqindi">*</span></div>
														<div class="div2"><input type="text" name="txt_visitor_institue" id="txt_visitor_institue" 
															class="tboxsmclass" value=""></div>
														<div class="div2 label pd-l-20">Purpose Of Visit<span class="reqindi">*</span></div>
														<div class="div2"><input type="text" name="txt_visitor_purpose" id="txt_visitor_purpose" 
															class="tboxsmclass" value=""></div>
														<div class="div2 label pd-l-20">
															Inviting Faculty Name  <span class="reqindi">*</span>
														</div>
														<div class="div2">
															<select name="cmb_inviting_faculty_id" id="cmb_inviting_faculty_id" class="tboxsmclass ChosenInput">
																<option value="">------ Select ------</option>	
																@if(isset($data['FacultyLists']))
																@foreach($data['FacultyLists'] as $FacultyList)
																	<option value="{{$FacultyList->emp_no}}">{{$FacultyList->emp_name_payslip}}</option>
																@endforeach
																@endif
															</select>
														</div>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
														<div class="div2 label">
															Period Of Visits <span class="reqindi">*</span>
														</div>
														<div class="div2" style="display: flex; gap: 10px; align-items: center;">
															<div style="display: flex; flex-direction: column;">
																<label style="font-size: 12px;">From Date</label>
																<input type="text" 
																	name="txt_visit_from_date" 
																	id="txt_visit_from_date" 
																	class="tboxsmclass datepicker" 
																	placeholder="From Date"
																	value="">
															</div>
															<div style="display: flex; flex-direction: column;">
																<label style="font-size: 12px;">To Date</label>
																<input type="text" 
																	name="txt_visit_to_date" 
																	id="txt_visit_to_date" 
																	class="tboxsmclass datepicker" 
																	placeholder="To Date"
																	value="">
															</div>
														</div>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
													</div>
												</fieldset>
											@endif
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<!-- <fieldset class="fieldbox">
												<legend class="fieldbox-legend">Contact Information</legend>
												<div class="fieldbox-div">
													@if(!in_array('VISITOR', $data['menuCodes']))
													<div class="div2 label pd-l-20">Intercom No. <span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_intercom_no" id="txt_intercom_no" class="tboxsmclass" value="@if(isset($ExtenNo)){{$ExtenNo}}@endif"></div>
													@endif
													<div class="div2 label pd-l-20">Mobile No. <span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_mobile" id="txt_mobile" class="tboxsmclass" value="@if(isset($MobileNo)){{$MobileNo}}@endif"></div>
													<div class="div2 label pd-l-20">Official Email <span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_office_email" id="txt_office_email" class="tboxsmclass" value="@if(isset($MailId)){{$MailId}}@endif"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													@if(!in_array('VISITOR', $data['menuCodes']))
													<div class="div2 label pd-l-20">Home Town</div>
													<div class="div2"><input type="text" name="txt_home_town" id="txt_home_town" class="tboxsmclass" value="@if(isset($EmpHometown)){{$EmpHometown}}@endif"></div>
													@endif
													<div class="div2 lboxlabel pd-l-20">Address <span class="reqindi">*</span></div>											
													<div class="div6"><textarea name="txt_cont_address" id="txt_cont_address" rows="4" class="tboxsmclass alphanumeric">@if(isset($Address)){{$Address}}@endif</textarea></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset> -->
											<fieldset class="fieldbox">
													<legend class="fieldbox-legend">Permanent Communication Detail</legend>
													<div class="fieldbox-div">
														<div class="div2 label">Address<span class="reqindi">*</span></div>											
														<div class="div2"><textarea name="txt_perm_address" id="txt_perm_address" rows="2" class="tboxsmclass alphanumeric">@if(isset($PersonalAddress)){{$PersonalAddress}}@endif</textarea></div>
														<div class="div2 label pd-l-20">E-Mail Address(personal)</div>
														<div class="div2"><input type="text" name="txt_perm_mailid" id="txt_perm_mailid" class="tboxsmclass" value="@if(isset($PersonalMailId)){{$PersonalMailId}}@endif"></div>
														<div class="div2 label pd-l-20">Mobile No</div>
														<div class="div2"><input type="text" name="txt_perm_mobno" id="txt_perm_mobno" class="tboxsmclass" value="@if(isset($MobileNo)){{$MobileNo}}@endif"></div>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
													</div>
												</fieldset> 
												<div class="row smclearrow"></div>
												<div class="row smclearrow"></div>
												<fieldset class="fieldbox">
													<legend class="fieldbox-legend">Present Communication Detail</legend>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
														<div class="div2 label pd-l-20">Address<span class="reqindi">*</span></div>											
														<div class="div2"><textarea name="txt_pers_address" id="txt_pers_address" rows="2" class="tboxsmclass alphanumeric">@if(isset($Address)){{$Address}}@endif</textarea></div>
														<div class="div2 label pd-l-20">Office Mail Id</div>
														<div class="div2"><input type="text" name="txt_office_mailid" id="txt_office_mailid" class="tboxsmclass" value="@if(isset($MailId)){{$MailId}}@endif"></div>
														<div class="div2 label pd-l-20">Office Intercom</div>
														<div class="div2"><input type="text" name="txt_office_mobno" id="txt_office_mobno" class="tboxsmclass" value="@if(isset($ExtenNo)){{$ExtenNo}}@endif"></div>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
													</div>
												</fieldset>                                                                                 											
										</div>
										
										<div class="form-step"> 
											<div class="row smclearrow"></div>
											@if(!in_array('VISITOR', $data['menuCodes']))
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Educational Information </legend>
												<div class="fieldbox-div">
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<table class="formtable" align="center" id="edu_qual_table" width="100%">
														<thead> 
															<tr>
																<th>Education Level</th>
																<th>Details of Qualification</th>
																<th>Institution Name</th>
																<th>University / Board</th>
																<th>Date of Acquiring Degree</th>
																@if(!in_array('PDFrIPDF', $data['menuCodes']))
																	<th>Mode of Study</th>
																@else
																	@if(in_array('PDF', $data['menuCodes']))
																		<th>Experience</th>
																	@else
																		<th>Mode of Study</th>
																	@endif
																@endif
																<th>Action</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>
																	<select name="cmb_education_level_0" id="cmb_education_level_0" class="tboxsmclass ChosenInput">
																		<option value=""> -- Select --</option>
																		@if(!in_array('PDFrIPDF', $data['menuCodes']))
																			<option value="Diploma">Diploma</option>
																			<option value="Graduate">Graduate</option>
																			<option value="Post Graduate">Post Graduate</option>
																			<option value="Doctorate">Doctorate</option>
																		@else
																			@if(in_array('PDF', $data['menuCodes']))
																				<option value="Obtained Degree">Obtained Degree</option>
																				<option value="Thesis Defense">Thesis Defense</option>
																				<option value="Submission of Thesis">Submission of Thesis</option>
																			@else
																				<option value="Doctorate">Doctorate</option>
																			@endif
																		@endif
																	</select>
																</td>
																<td><input type="text" name="txt_qualification_0" id="txt_qualification_0" class="tboxsmclass" value=""></td>
																<td><input type="text" name="txt_institute_name_0" id="txt_institute_name_0" class="tboxsmclass" value=""></td>
																<td><input type="text" name="txt_university_name_0" id="txt_university_name_0" class="tboxsmclass" value=""></td>
																<td><input type="number" name="txt_year_passing_0" id="txt_year_passing_0" class="tboxsmclass" value=""></td>
																@if(!in_array('PDFrIPDF', $data['menuCodes']))
																	<td>
																		<select name="cmb_study_mode_0" id="cmb_study_mode_0" class="tboxsmclass ChosenInput">
																			<option value=""> -- Select --</option>
																			<option value="Full-time">Full-time</option>
																			<option value="Part-time">Part-time</option>
																			<option value="Distance">Distance</option>
																		</select>
																	</td>
																@else
																	@if(in_array('PDF', $data['menuCodes']))
																		<td>
																			<select name="cmb_study_mode_0" id="cmb_study_mode_0" class="tboxsmclass ChosenInput" onchange="getFellowshipByExperience(this)">
																				<option value=""> -- Select --</option>
																				<option value="0">0 Years</option>
																				<option value="1">1 Years</option>
																				<option value="2">2 Or More Years</option>
																			</select>
																		</td>
																	@else
																		<td>
																			<select name="cmb_study_mode_0" id="cmb_study_mode_0" class="tboxsmclass ChosenInput">
																				<option value=""> -- Select --</option>
																				<option value="Full-time">Full-time</option>
																				<option value="Part-time">Part-time</option>
																			</select>
																		</td>
																	@endif
																@endif
																<td align="center"><i class="fa fa-plus-square sqadd ptr inp disable" id="eduqual_add_record" style="font-size:24px;"></i></td>
															</tr>
															@if(isset($data['EditEmpEducationData']))
																@foreach($data['EditEmpEducationData'] as $EditEmpEducationData)
																	<tr>
																		<td>
																			<input type='text' name='txt_education_level[]' id='txt_education_level_{{$EduIndex}}' class='tboxsmclass' value='{{$EditEmpEducationData->education_level}}'>
																			<input type='hidden' name='txt_education_level_id[]' id='txt_education_level_id_{{$EduIndex}}' class='tboxsmclass' value=' {{$EditEmpEducationData->emp_education_id}}'>
																		</td>
																		<td><input type='text' name='txt_qualification[]' id='txt_qualification__{{$EduIndex}}' class='tboxsmclass' value='{{$EditEmpEducationData->qualification}}'></td>
																		<td><input type='text' name='txt_institute_name[]' id='txt_institute_name_{{$EduIndex}}' class='tboxsmclass' value='{{$EditEmpEducationData->institute_name}}'></td>
																		<td><input type='text' name='txt_university_name[]' id='txt_university_name_{{$EduIndex}}' class='tboxsmclass' value='{{$EditEmpEducationData->board_university}}'></td>
																		<td><input type='text' name='txt_year_passing[]' id='txt_year_passing_{{$EduIndex}}' class='tboxsmclass' value='{{$EditEmpEducationData->year_passing}}'></td></td>
																		<td>
																			<input type='text' name='txt_study_mode[]' id='txt_study_mode_{{$EduIndex}}' class='tboxsmclass' value='{{$EditEmpEducationData->study_mode}}'>
																			<input type='hidden' name='txt_study_mode_id[]' id='txt_study_mode_id_{{$EduIndex}}'class='tboxsmclass' value=''>
																		</td>
																		<td align='center'>
																			<i class='fa fa-times-circle sqdel ptr disable DeleteRow' id='DelRelationshipDetails' style='font-size:24px'></i></i>
																		</td>
																	</tr>
																	@php $EduIndex++; @endphp
																@endforeach
															@endif
														</tbody>
													</table>
												</div>
												<div class="emp-notes">Note: Enter the educational qualifications as they were at the time of joining.</div>
												<div class="row smclearrow"></div> 
												<div class="row smclearrow"></div> 
												<div class="row smclearrow"></div> 
											</fieldset>
											@endif
											@if(in_array('PDFrIPDF', $data['menuCodes']) || in_array('EPROJECT', $data['menuCodes']))
												<div class="row smclearrow"></div> 
												<div class="row smclearrow"></div> 
												<div class="row smclearrow"></div> 
												<fieldset class="fieldbox">
													<div class="row smclearrow"></div> 
													<div class="row smclearrow"></div> 
													<div class="row smclearrow"></div> 
													<legend class="fieldbox-legend">Pay Details</legend>
													<div class="fieldbox-div">
														@if(in_array('EPROJECT', $data['menuCodes']))
															<div class="div2 label label pd-l-20">Consolidate Pay<span class="reqindi">*</span></div>
														@else
															<div class="div2 label label pd-l-20">Fellowship Amount<span class="reqindi">*</span></div>
														@endif
														<div class="div2"><input type="text" name="txt_pay_amount" id="txt_pay_amount" class="tboxsmclass" value="{{ $EmpPay->basic_salary ?? '' }}">
														@php
															$payComponentId = null;
															if(isset($data['payComponents'])){
																foreach($data['payComponents'] as $component){
																	if ($component->component_code == 'CHSS') {
																		$payComponentId = $component->component_id;
																		break;
																	}
																}
															}
														@endphp
														<input type="hidden" name="txt_pay_component" id="txt_pay_component" value="{{ in_array('EPROJECT', $data['menuCodes']) ? '' : $payComponentId }}">
														<div class="row smclearrow"></div> 
														<div class="row smclearrow"></div> 
														<div class="row smclearrow"></div> 	
												</fieldset>
												<div class="row smclearrow"></div> 
												<div class="row smclearrow"></div> 
												<div class="row smclearrow"></div> 	
											@endif
											<div class="row smclearrow"></div> 
											<div class="row smclearrow"></div> 
											<fieldset class="fieldbox">
												<div class="row smclearrow"></div> 
												<div class="row smclearrow"></div> 
												<div class="row smclearrow"></div> 
												<legend class="fieldbox-legend">Bank Account Information</legend>
												<div class="fieldbox-div">
													<div class="div2 label pd-l-20">Account Holder Name </br>(As per Passbook)<span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_acc_holder_name" id="txt_acc_holder_name" class="tboxsmclass" value="@if(isset($AccountName)){{$AccountName}}@endif"></div>
													<div class="div2 label pd-l-20">Bank Account No <span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_account_no" id="txt_account_no" class="tboxsmclass" value="@if(isset($AccountNo)){{$AccountNo}}@endif"></div>
													<div class="div1 label pd-l-20 no-margin">IFSC Code <span class="reqindi">*</span></div>
													<div class="div2">
														<input list="IfscList" type="text" name="txt_ifsc_code" id="txt_ifsc_code" class="tboxsmclass" value="@if(isset($IfscCode)){{$IfscCode}}@endif">
														<datalist id="IfscList" style="color:#C80B5B; font-size:16px">
															@if(isset($data['IfscData']))
															@foreach($data['IfscData'] as $IfscData)
																<option data-bankid="{{$IfscData->bank_id}}" value="{{$IfscData->ifsc_code}}">
															@endforeach
															@endif
														</datalist>
														<!-- <div class="div2 pd-l-20"><i class="fa fa-plus-square sqadd ptr inp disable" id="AddNewIFScCode" style="font-size:24px;"></i></div> -->
													</div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="div2 label pd-l-20">Bank Name <span class="reqindi">*</span></div>
													<div class="div2">
														<input type="text" name="txt_bank_name" id="txt_bank_name" class="tboxsmclass" value="@if(isset($BankName)){{$BankName}}@endif">
														<input type="hidden" name="txt_bank_id" id="txt_bank_id" class="tboxsmclass" value="@if(isset($BankId)){{$BankId}}@endif">
													</div>
													<div class="div2 label pd-l-20">Branch Address <span class="reqindi">*</span></div>
													<div class="div6 no-margin">
														<input type="hidden" name="txt_branch_id" id="txt_branch_id" class="tboxsmclass" value="@if(isset($BranchId)){{$BranchId}}@endif">
														<input type="text" name="txt_branch_address" id="txt_branch_address" class="tboxsmclass" value="@if(isset($BranchName)){{$BranchName}}@endif">
													</div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>	
										</div> 

										@if(in_array('EFAMD', $data['menuCodes']))
											<div class="form-step"> 
												<div class="row smclearrow"></div>
												<fieldset class="fieldbox">
													<legend class="fieldbox-legend">Family Details </legend>
													<div class="fieldbox-div">
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>                                                                    											
														<table class="formtable" align="center" id="RelationshipTable" width="100%">
															<thead>
																<tr>
																	<th style="width:250px">Dependent Name</th>
																	<th style="width:250px">Relationship Name</th>
																	<th>Name</th>
																	<th>Date of Birth</th>
																	<th>Aadhaar No.</th>
																	<th>Income & Occupation, Indicate Pension Per Month</th>
																	<th>Blood Group</th>
																	<th>Is Nominee</th>
																	<th>Action</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>
																		<select name="hid_dependant_id_0" id="hid_dependant_id_0" class="tboxsmclass ChosenInput"> 
																			<option value=""> ---- Select ---- </option> 
																			@if(isset($data['DependentData']))
																			@foreach($data['DependentData'] as $Row)
																			<option value="{{ $Row->dependant_id }}">{{ $Row->dependant_name }}</option> 
																			@endforeach
																			@endif
																		</select>		
																	</td>
																	<td>
																		<select name="txt_relationship_0" id="txt_relationship_0" class="tboxsmclass ChosenInput"> 
																			<option value=""> ---- Select ---- </option> 
																		</select>
																	</td>
																	<td>
																		<input type="text" name="txt_rel_name_0" id="txt_rel_name_0" class="tboxsmclass" value="">
																	</td>
																	<td>
																		<input type="text" name="txt_dob_rel_0" id="txt_dob_rel_0" class="tboxsmclass datepicker" value="">
																	</td>
																	<td>
																		<input type="text" name="txt_aadhar_rel_0" id="txt_aadhar_rel_0" class="tboxsmclass" value="">
																	</td>
																	<td>
																		<input type="text" name="txt_income_rel_0" id="txt_income_rel_0" class="tboxsmclass" value="">
																	</td>
																	<td>
																		<input type="text" name="txt_blood_group_rel_0" id="txt_blood_group_rel_0" class="tboxsmclass" value="">
																	</td>
																	<td align='center'>
																		<input type="radio" name="rad_is_nominee_0" id="rad_is_nominee_0" value="0">
																	</td>
																	<td align='center'>
																		<i class="fa fa-plus-square sqadd ptr inp disable" id="AddTechRec" style="font-size:24px;"></i>
																	</td>
																</tr>
																@php 
																$DependentData = $data['DependentData'];
																@endphp
																@if(isset($data['EditEmpFamliyData']))
																	@foreach($data['EditEmpFamliyData'] as $EditEmpFamliyData)
																		<tr>
																			<td>
																				<input type='hidden' name='hid_dependant_id[]' id='hid_dependant_id_{{$RelIndex}}' class='tboxsmclass' value='{{$EditEmpFamliyData->dependant_id}}'>
																				<input type='text' name='txt_dependant_name[]' id='txt_dependant_name_{{$RelIndex}}' class='tboxsmclass' value='{{$EditEmpFamliyData->dependant_name}}'>
																				<input type="hidden" name="txt_index[]" id="txt_index_{{$RelIndex}}" value="{{$RelIndex}}">
																			</td>
																			<td>
																				<input type='hidden' name='txt_relationship[]' id='txt_relationship_{{$RelIndex}}' class='tboxsmclass' value='{{$EditEmpFamliyData->relationship_id}}'>
																				<input type='text' name='txt_relationship_name[]' id='txt_relationship_name_{{$RelIndex}}' class='tboxsmclass' value='{{$EditEmpFamliyData->relationship_name}}'>
																			</td>
																			</td>
																			<td><input type='text' name='txt_rel_name[]' id='txt_rel_name_{{$RelIndex}}' class='tboxsmclass' value='{{$EditEmpFamliyData->fam_member_name}}'></td>
																			<td><input type='text' name='txt_dob_rel[]' id='txt_dob_rel_{{$RelIndex}}' class='tboxsmclass datepicker' value='{{Helper::DisplayDateFormat($EditEmpFamliyData->fam_member_dob)}}'></td>
																			<td><input type='text' name='txt_aadhar_rel[]' id='txt_aadhar_rel_{{$RelIndex}}' class='tboxsmclass' value='{{$EditEmpFamliyData->fam_member_aadhar}}'></td>
																			<td><input type='text' name='txt_income_rel[]' id='txt_income_rel_{{$RelIndex}}' class='tboxsmclass' value='{{$EditEmpFamliyData->fam_member_aadhar}}'></td>
																			<td><input type='text' name='txt_blood_group_rel[]' id='txt_blood_group_rel_{{$RelIndex}}' class='tboxsmclass' value='{{$EditEmpFamliyData->fam_member_blood_group}}'></td>
																			<td align="center">
																				<input type='radio' name='rad_is_nominee' id='rad_is_nominee_{{$RelIndex}}' value='{{$RelIndex}}' @if($EditEmpFamliyData->is_nominee == 'YES'){{'checked'}} @endif> 
																			</td>
																			<td align='center'>
																				<i class='fa fa-times-circle sqdel ptr disable DeleteRow' id='DelRelationshipDetails' style='font-size:24px'></i></i>
																			</td>
																		</tr>
																		@php $RelIndex++; @endphp
																	@endforeach
																@endif
															</tbody>
														</table>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
													</div>
												</fieldset>		
												<div class="row smclearrow"></div>
												<div class="row smclearrow"></div>
												<fieldset class="fieldbox">
													<legend class="fieldbox-legend">HomeTown Detail</legend>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="div2 lboxlabel pd-l-20">HomeTown<span class="reqindi">*</span></div>											
													<div class="div2"><input type="text" name="txt_home_town" id="txt_home_town" class="tboxsmclass alphanumeric" value="@if(isset($EmpHometown)){{$EmpHometown}}@endif"></div>
													<div class="div2 label pd-l-20">State in which Situated</div>
													<div class="div2"><input type="text" name="txt_home_town_state" id="txt_home_town_state" class="tboxsmclass" value="@if(isset($EmpHometownState)){{$EmpHometownState}}@endif"></div>
													
													<div class="div2 label pd-l-20">Nearest Railway Station</div>
													<div class="div2"><input type="text" name="txt_near_railway" id="txt_near_railway" class="tboxsmclass" value="@if(isset($EmpHometownRailStation)){{$EmpHometownRailStation}}@endif" /></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="div2 label pd-l-20"><br>Address at hometown</div>
													<div class="div10"><textarea name="txt_addr_hometown" id="txt_addr_hometown" class="tboxsmclass">@if(isset($EmpHometownAddr)){{$EmpHometownAddr}}@endif</textarea></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</fieldset>
											</div>	
										@endif	
										@if(in_array('EINSD', $data['menuCodes']))
											<div class="form-step"> 
												<div class="row smclearrow"></div>
												<div class="emp-notes">Note: Please indicate here if you wish to have insurance premiums deducted from your salary.</div> 
												<fieldset class="fieldbox">
													<legend class="fieldbox-legend">LIC Policy Details </legend>
													<div class="fieldbox-div">
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>   
														<table class="formtable" align="center" id="lic_insur_table" width="100%">
															<thead> 
																<tr>
																	<th>Policy Holder Name</th>
																	<th>Policy No</th>
																	<th>Premium Amount</th>
																	<th>Date of Expiry</th>
																	<th>Action</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td><input type="text" name="txt_lic_pol_hold_name_0" id="txt_lic_pol_hold_name_0" class="tboxsmclass" value=""></td>
																	<td><input type="text" name="txt_lic_pol_no_0" id="txt_lic_pol_no_0" class="tboxsmclass" value=""></td>
																	<td><input type="text" name="txt_lic_premium_amt_0" id="txt_lic_premium_amt_0" class="tboxsmclass" value=""></td>
																	<td><input type="text" name="txt_lic_date_of_expiry_0" id="txt_lic_date_of_expiry_0" class="tboxsmclass datepicker" value=""></td>
																	<td align="center"><i class="fa fa-plus-square sqadd ptr inp disable" id="lic_add_record" style="font-size:24px;"></i></td>
																</tr>
																@if(isset($data['EditLicEmpInsuranceData']))
																@foreach($data['EditLicEmpInsuranceData'] as $EditLicEmpInsuranceData)
																	<tr>
																		<td><input type='text' name='txt_lic_pol_hold_name[]' id='txt_lic_pol_hold_name_{{$LicIndex}}'class='tboxsmclass' value='{{$EditLicEmpInsuranceData->policy_holder_name}}' ></td>
																		<td><input type='text' name='txt_lic_pol_no[]' id='txt_lic_pol_no_{{$LicIndex}}' class='tboxsmclass' value='{{$EditLicEmpInsuranceData->policy_no}}'></td>
																		<td><input type='text' name='txt_lic_premium_amt[]' id='txt_lic_premium_amt_{{$LicIndex}}' class='tboxsmclass' value='{{$EditLicEmpInsuranceData->premium_amount}}'></td>
																		<td><input type='text' name='txt_lic_date_of_expiry[]' id='txt_lic_date_of_expiry_{{$LicIndex}}' class='tboxsmclass datepicker' value='{{Helper::DisplayDateFormat($EditLicEmpInsuranceData->expiry_date)}}' readonly></td>
																		<td align='center'>
																			<i class='fa fa-times-circle sqdel ptr disable DeleteRow' id='DelRelationshipDetails' style='font-size:24px'></i></i>
																		</td>
																	</tr>
																	@php $LicIndex++; @endphp
																@endforeach
															@endif
															</tbody>
														</table>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
													</div>
												</fieldset>
												<div class="row smclearrow"></div>
												<div class="row smclearrow"></div>
												<div class="row smclearrow"></div>
												<fieldset class="fieldbox">
													<legend class="fieldbox-legend">Postal Insurance Details</legend>
													<div class="fieldbox-div">
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>	
														<table class="formtable" align="center" id="pli_insur_table" width="100%">
															<thead>
																<tr>
																	<th>Policy Holder Name</th>
																	<th>Policy No</th>
																	<th>Premium Amount</th>
																	<th>Date of Expiry</th>
																	<th>Action</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td><input type="text" name="txt_pli_pol_hold_name_0" id="txt_pli_pol_hold_name_0" class="tboxsmclass" value=""></td>
																	<td><input type="text" name="txt_pli_pol_no_0" id="txt_pli_pol_no_0" class="tboxsmclass" value=""></td>
																	<td><input type="text" name="txt_pli_premium_amt_0" id="txt_pli_premium_amt_0" class="tboxsmclass" value=""></td>
																	<td><input type="text" name="txt_pli_date_of_expiry_0" id="txt_pli_date_of_expiry_0" class="tboxsmclass datepicker" value=""></td>
																	<td align="center"><i class="fa fa-plus-square sqadd ptr inp disable" id="pli_add_record" style="font-size:24px;"></i></td>
																</tr>
																	@if(isset($data['EditPliEmpInsuranceData']))
																@foreach($data['EditPliEmpInsuranceData'] as $EditPliEmpInsuranceData)
																	<tr>
																		<td><input type='text' name='txt_pli_pol_hold_name[]' id='txt_pli_pol_hold_name_{{$PliIndex}}' class='tboxsmclass' value='{{$EditPliEmpInsuranceData->policy_holder_name}}' ></td>
																		<td><input type='text' name='txt_pli_pol_no[]' id='txt_pli_pol_no_{{$PliIndex}}' class='tboxsmclass' value='{{$EditPliEmpInsuranceData->policy_no}}'></td>
																		<td><input type='text' name='txt_pli_premium_amt[]' id='txt_pli_premium_amt_{{$PliIndex}}' class='tboxsmclass' value='{{$EditPliEmpInsuranceData->premium_amount}}' ></td>
																		<td><input type='text' name='txt_pli_date_of_expiry[]' id='txt_pli_date_of_expiry_{{$PliIndex}}' class='tboxsmclass datepicker' value='{{Helper::DisplayDateFormat($EditPliEmpInsuranceData->expiry_date)}}'></td>
																		<td align='center'>
																			<i class='fa fa-times-circle sqdel ptr disable DeleteRow' id='DelRelationshipDetails' style='font-size:24px'></i></i>
																		</td>
																	</tr>
																	@php $PliIndex++; @endphp
																@endforeach
															@endif
															</tbody>
														</table>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
													</div>
												</fieldset>
											</div> 
										@endif
										<div class="form-step"> 
											@if(!in_array('VISITOR', $data['menuCodes']))
												<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Personal Information</legend>
													<div class="fieldbox-div">
														@if(!in_array('VISITOR', $data['menuCodes']))
														<div class="div3 label pd-l-20 no-margin">Exact height measurement(in Meters) <span class="reqindi">*</span></div>
														<div class="div2"><input type="text" name="txt_height_measurement" id="txt_height_measurement" class="tboxsmclass" value="@if(isset($Height)){{$Height}}@endif"></div>
														@endif
														<div class="div2 label pd-l-20">Blood Group <span class="reqindi">*</span></div>
														<div class="div2"><input type="text" name="txt_blood_group" id="txt_blood_group" class="tboxsmclass" value="@if(isset($BloodGroup)){{$BloodGroup}}@endif"></div>
														<div class="row smclearrow"></div>
														<div class="div3 label pd-l-20">Personal marks of Identification <span class="reqindi">*</span></div>											
														<div class="div6"><textarea name="txt_identification_marks" id="txt_identification_marks" rows="4" class="tboxsmclass alphanumeric">@if(isset($IdentityMark)){{$IdentityMark}}@endif</textarea></div>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
													</div>
												</fieldset>
												<div class="row smclearrow"></div>
												<div class="row smclearrow"></div>
												<fieldset class="fieldbox">
													<legend class="fieldbox-legend">Other Information</legend>
													<div class="fieldbox-div">
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
														<div class="div2 label pd-l-20">Physically Challanged ? <span class="reqindi">*</span></div>
														@php 
														$SelfStr = ''; $DependStr = ''; $NoStr = '';
														if(isset($IsPhysical)){
															if($IsPhysical == true){
																if($PhysicalType == 'SELF'){
																	$SelfStr = 'checked';
																}
																if($PhysicalType == 'DEPEND'){
																	$DependStr = 'checked';
																}
															}else{
																$NoStr = 'checked';
															}
														}
														@endphp
														
														<div class="div6 no-margin">
															<div class="div4 no-margin">
																<div class="inputGroup paddlr2">
																	<input id="rad_phy_handicapped_self" name="rad_phy_handicapped" type="radio" value="SELF" {{ $SelfStr }}/>
																	<label for="rad_phy_handicapped_self" style="padding:3px 0px; width:100%"> &nbsp;YES (Self)</label>
																</div>
															</div>
															<div class="div4 no-margin">
																<div class="inputGroup paddlr2">
																	<input id="rad_phy_handicapped_depend" name="rad_phy_handicapped" type="radio" value="DEPEND" {{ $DependStr }}/>
																	<label for="rad_phy_handicapped_depend" style="padding:3px 0px; width:100%"> &nbsp;YES (Dependent)</label>
																</div>
															</div>
															<div class="div4 no-margin">
																<div class="inputGroup paddlr2">
																	<input id="rad_phy_handicapped_no" name="rad_phy_handicapped" type="radio" value="NO" {{ $NoStr }}/>
																	<label for="rad_phy_handicapped_no" style="padding:3px 0px; width:100%"> &nbsp;NO</label>
																</div>
															</div>
														</div>
														<div class="div2 cboxlabel pd-l-20">Percentage (%) <span class="reqindi">*</span></div>
														<div class="div2">
															<input type="text" name="txt_phy_handicapp_perc" id="txt_phy_handicapp_perc" class="tboxsmclass" value="@if(isset($PhysicalPerc)){{$PhysicalPerc}}@endif">
														</div>
														
														
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
													</div>
												</fieldset>	
											@endif
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Photo / Document Upload</legend>
												<div class="fieldbox-div">
													<div class="div8 label">
														
														<div class="upload-box-3" style="padding:5px">
															
															<div class="image-grid">
																<div class="div12">
																	Photo (jpg/jpeg/png)<span class="reqindi">*</span>
																	<div class="image-item" onclick="document.getElementById('file_emp_photo').click()">
																		<span class="plus-icon">Photo [+]</span>
																		<img id="img1" src="" alt="">
																		<button type="button" class="remove-btn" onclick="removeImage(event, 'img1')">×</button>
																	</div>
																</div>
																<div class="div12">
																	Aadhaar Card Copy (pdf)<span class="reqindi">*</span>
																	<div class="image-item" onclick="document.getElementById('file_emp_aadhaar').click()">
																		<span class="plus-icon">Aadhaar [+]</span>
																		<img id="img2" src="" alt="">
																		<button type="button" class="remove-btn" onclick="removeImage(event, 'img2')">×</button>
																	</div>
																</div>
																<div class="div12">
																	PAN Card Copy (pdf)<span class="reqindi">*</span>
																	<div class="image-item" onclick="document.getElementById('file_emp_pan').click()">
																		<span class="plus-icon">PAN [+]</span>
																		<img id="img3" src="" alt="">
																		<button type="button" class="remove-btn" onclick="removeImage(event, 'img3')">×</button>
																	</div>
																</div>
															</div>
															<input type="file" name="file_emp_photo"   id="file_emp_photo" accept="image/*">
															<input type="file" name="file_emp_aadhaar" id="file_emp_aadhaar" accept="image/*">
															<input type="file" name="file_emp_pan" id="file_emp_pan" accept="image/*">
														</div>
													</div>
													<div class="div4 label pd-l-20">
														<div>
															Instructions to Upload Photo / Documents :
															<ul class="instruction-list">
																<li>Please upload a recent Employee Photograph in JPG / JPEG / PNG format only.</li>
																<li>Please upload PAN Card in PDF format only.</li>
																<li>Please upload Aadhaar Card in PDF format only.</li>
																<li>The maximum file size allowed for each document is 3 MB.</li>
																<li>Ensure that all documents are clear, readable, and not password-protected.</li>
																<li>All documents must be uploaded at the same time.</li>
															</ul>
														</div>
													</div>
													<!-- <div class="div4 label pd-l-20">
														Aadhaar Card <span class="reqindi">*</span>
													</div>
													<div class="div4 label pd-l-20">
														PAN Card <span class="reqindi">*</span>
													</div> -->
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>
										</div> 
										
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="div12" align="center">
								@php $CurrentTab = 0; @endphp
								<input type="hidden" name="txt_tab" id="txt_tab" value="{{ $CurrentTab }}" />
								<input type="hidden" name="txt_page" id="txt_page" value="{{ encrypt($Page) }}" />
								<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
							</div>
						</div>
               		</div>		                      
				</blockquote>
			</div>
		</div>
	</div>
</form>
<script>
	$(".ChosenInput").chosen({width: "100%"});
	const steps = document.querySelectorAll(".form-step"); 
	const stepPanels = document.querySelectorAll(".step"); 
	const stepSpans = document.querySelectorAll(".step-span"); 
	const stepIndicator = document.getElementById("step-indicator"); 
	const prevBtn = document.getElementById("prevBtn"); 
	const nextBtn = document.getElementById("nextBtn"); 
	let currentStep = 0; 
	const totalSteps = steps.length; 
	function updateForm() { 
		steps.forEach((step, index) => { 
			step.classList.toggle("active", index === currentStep); 
			stepPanels[index].classList.toggle("active", index === currentStep); 
		}); 
		stepSpans.forEach((step, index) => { 
			step.classList.toggle("step-span-active", index === currentStep); 
		}); 
		stepIndicator.textContent = `Step ${currentStep + 1} of ${totalSteps}`; 
		prevBtn.disabled = currentStep === 0; 
		nextBtn.textContent = currentStep === totalSteps - 1 ? "Next" : "Next"; 
		nextBtn.disabled = currentStep === totalSteps - 1; 
	} 
	nextBtn.addEventListener("click", () => { 
		if(currentStep < totalSteps - 1){ 
			currentStep++; updateForm(); 
			$("#txt_tab").val(currentStep);
		}else{ 
			document.getElementById("multiStepForm").submit(); 
			$("#txt_tab").val(0);
		} 
		if(currentStep == totalSteps - 1){
			$("#SaveDraft").removeClass('hide');
		}else{
			$("#SaveDraft").addClass('hide');
		}
	}); 
	prevBtn.addEventListener("click", () => { 
		if (currentStep > 0) { 
			currentStep--; 
			updateForm(); 
			$("#txt_tab").val(currentStep);
		} 
		if(currentStep == totalSteps - 1){
			$("#SaveDraft").removeClass('hide');
		}else{
			$("#SaveDraft").addClass('hide');
		}
	}); 
	window.addEventListener('load', function() {
		document.getElementById('txt_tab').value = '0'; // or '0' depending on your starting tab
		currentStep = 0; // Reset to first step
		updateForm(); // Update the form display
		//$('#cmb_group').trigger('change');
	});
	updateForm();

	// document.body.addEventListener('click', function(e) {
	// 	if (e.target && e.target.classList.contains('readonly-checkbox')) {
	// 		e.preventDefault(); // prevent user from toggling
	// 	}
	// });
	$('body').on('click', '.readonly-checkbox', function(e){
		e.preventDefault();
		e.stopPropagation();
		return false;
	});
	
	$('body').on('change', 'input[name^="ch_pay_components["]', function(event){
		let componentCode = $(this).attr("data-code"); 
		
		// Prevent change if readonly
		if($(this).hasClass('readonly-checkbox')){
			event.preventDefault();
			return false;
		}
		
		if(componentCode == "HRA"){
			if($(this).is(':checked')){
				$(".HraBox").addClass("hide");
			}else{
				$(".HraBox").removeClass("hide");
			}
		}

		if(componentCode == "ESI"){
			if($(this).is(':checked')){
				$(".EsiBox").removeClass("hide");
			}else{
				$(".EsiBox").addClass("hide");
			}
		}
		
		if(componentCode == "GPF"){
			if($(this).is(':checked')){
				$(".GpfBox").removeClass("hide");
				
				// Find and uncheck NPS checkbox
				$('input[name^="ch_pay_components["][data-code="NPS"]').each(function(){
					$(this).prop('checked', false);
					$(this).addClass("readonly-checkbox");
				});
				$(".NpsBox").addClass("hide");
			}else{
				$(".GpfBox").addClass("hide");
				
				// Enable NPS checkbox
				$('input[name^="ch_pay_components["][data-code="NPS"]').each(function(){
					$(this).removeClass("readonly-checkbox");
				});
			}
		}
		
		if(componentCode == "NPS"){
			if($(this).is(':checked')){
				$(".NpsBox").removeClass("hide");
				
				// Find and uncheck GPF checkbox
				$('input[name^="ch_pay_components["][data-code="GPF"]').each(function(){
					$(this).prop('checked', false);
					$(this).addClass("readonly-checkbox");
				});
				$(".GpfBox").addClass("hide");
			}else{
				$(".NpsBox").addClass("hide");
				
				// Enable GPF checkbox
				$('input[name^="ch_pay_components["][data-code="GPF"]').each(function(){
					$(this).removeClass("readonly-checkbox");
				});
			}
		}
	});

	$("body").on("change", "#cmb_group, #cmb_division, #cmb_section", function(event){
		var Id = $(this).val();
		var cmbDivision = $("#cmb_division");
		var cmbSection = $("#cmb_section");

		if (Id != "") {
			$.ajax({
				type: 'POST',
				url: '{{ route("organization.Reporttooffice") }}',
				data: { "_token": "{{ csrf_token() }}", Id: Id },
				dataType: 'json',
				success: function (data) {
					if ($(event.target).is("#cmb_group")) {
						cmbDivision.empty();
						cmbDivision.append('<option value="">----- Select ----</option>');
						cmbSection.empty();
						cmbSection.append('<option value="">----- Select ----</option>');
						if (data && data['GetOfficeRepoToOffice']) {
							$.each(data['GetOfficeRepoToOffice'], function(key, value){
								/*if (
									(data['WcmsRoleGroupCode'] == 'ADMUSER' && value.office_id == data['WcmsEmpDiv'] && value.active == 1) ||
									(data['WcmsRoleGroupCode'] == 'ACCADMUSER' && value.office_id == data['WcmsEmpDiv'] && value.active == 1) ||
									(data['WcmsRoleGroupCode'] == 'ACCUSER' && value.office_id == data['WcmsEmpDiv'] && value.active == 1) ||
									(data['WcmsRoleGroupCode'] == 'SUPUSER' && value.active == 1)
								) {
									cmbDivision.append('<option value="' + value.office_id + '">' + value.office_name + '</option>');
								}*/
								cmbDivision.append('<option value="' + value.office_id + '">' + value.office_name + '</option>');
							});
						}
					} else if ($(event.target).is("#cmb_division")) {
						cmbSection.empty();
						cmbSection.append('<option value="">----- Select ----</option>');
						if (data && data['GetOfficeRepoToOffice']) {
							$.each(data['GetOfficeRepoToOffice'], function(key, value){
								cmbSection.append('<option value="' + value.office_id + '">' + value.office_name + '</option>');
							});
						}
					}
					cmbDivision.trigger("chosen:updated");
                	cmbSection.trigger("chosen:updated");
				}
			});
		} else {
			if ($(event.target).is("#cmb_group")) {
				cmbDivision.empty();
				cmbDivision.append('<option value="">----- Select ----</option>');
			} else if ($(event.target).is("#cmb_division")) {
				cmbSection.empty();
				cmbSection.append('<option value="">----- Select ----</option>');
			}
			cmbDivision.trigger("chosen:updated");
            cmbSection.trigger("chosen:updated");
		}
	});
	var RelIndex = {{$RelIndex}};
	$(document).on('click','#AddTechRec',function(){
		var DependentName = $('#hid_dependant_id_0 option:selected').text();
		var DependentId = $('#hid_dependant_id_0 option:selected').val();
		var RelationshipName = $('#txt_relationship_0 option:selected').text();
		var RelationshipId = $('#txt_relationship_0 option:selected').val();
		var RelName = $('#txt_rel_name_0').val();
		var RelDob = $('#txt_dob_rel_0').val();
		var Relaadhar = $('#txt_aadhar_rel_0').val();
		var Relincome = $('#txt_income_rel_0').val();
		var Relbloodgroup = $('#txt_blood_group_rel_0').val();
		var Relisnominee = $('#rad_is_nominee_0').val();// === 'Yes' ? 1 : '';
		if($('#rad_is_nominee_0').is(':checked')) {
			//var IsNominee = 'YES';
			var CheckedStr = "checked";
		}else{
			//var IsNominee = 'NO';
			var CheckedStr = "";
		}	
		let tablestr = "";
		tablestr += "<tr>";
		tablestr += "<td><input type='hidden' name='hid_dependant_id[]' id='hid_dependant_id_"+RelIndex+"' class='tboxsmclass' value='" +DependentId+ "'><input type='text' name='txt_dependant_name[]' id='txt_dependant_name' class='tboxsmclass' value='"+DependentName+"'><input type='hidden' name='txt_index[]' id='txt_index_"+RelIndex+"' value='"+RelIndex+"'></td>";
		tablestr += "<td><input type='hidden' name='txt_relationship[]' id='txt_relationship_"+RelIndex+"'class='tboxsmclass' value='" +RelationshipId+ "'><input type='text' name='txt_relationship_name[]' id='txt_relationship_name' class='tboxsmclass' value='"+RelationshipName+"'></td>";
		tablestr += "<td><input type='text' name='txt_rel_name[]' id='txt_rel_name_"+RelIndex+"' class='tboxsmclass' value='"+RelName+"'></td>";
		tablestr += "<td><input type='text' name='txt_dob_rel[]' id='txt_dob_rel_"+RelIndex+"' class='tboxsmclass datepicker' value='"+RelDob+"'></td>";
		tablestr += "<td><input type='text' name='txt_aadhar_rel[]' id='txt_aadhar_rel_"+RelIndex+"' class='tboxsmclass' value='"+Relaadhar+"'></td>";
		tablestr += "<td><input type='text' name='txt_income_rel[]' id='txt_income_rel_"+RelIndex+"' class='tboxsmclass' value='"+Relincome+"'></td>";
		tablestr += "<td><input type='text' name='txt_blood_group_rel[]' id='txt_blood_group_rel_"+RelIndex+"' class='tboxsmclass' value='"+Relbloodgroup+"'></td>";
		tablestr +=  "<td align='center'><input type='radio' name='rad_is_nominee' id='rad_is_nominee_"+RelIndex+"' value='"+RelIndex+"' "+CheckedStr+"></td>";
		tablestr += "<td align='center'><i class='fa fa-times-circle sqdel ptr disable DeleteRow' id='DelRelationshipDetails' style='font-size:24px'></i></i></td>";
		tablestr += "</tr>";
		$("#RelationshipTable").append(tablestr);
		$('#hid_dependant_id_0').chosen('destroy');
		$('#hid_dependant_id_0').val('');
		$('#hid_dependant_id_0').chosen();
		$('#txt_relationship_0').chosen('destroy');
		$('#txt_relationship_0').val('');
		$('#txt_relationship_0').chosen();
		$('#txt_rel_name_0').val('');
		$('#txt_dob_rel_0').val('');
		$('#txt_aadhar_rel_0').val('');
		$('#txt_income_rel_0').val('');
		$('#txt_blood_group_rel_0').val('');
		//$('input[name="rad_is_nominee[0]"]').prop('checked', false);
		$('#rad_is_nominee_0').prop('checked', false);
		RelIndex++;
	});
	var LicIndex = {{$LicIndex}};
	$(document).on('click','#lic_add_record',function(){
		var LICPolHolName 	= $('#txt_lic_pol_hold_name_0').val();
		var LICPolNo 		= $('#txt_lic_pol_no_0').val();
		var LICPremiumAmt 	= $('#txt_lic_premium_amt_0').val();
		var LICDOE 			= $('#txt_lic_date_of_expiry_0').val();
		let tablestr = "";
		tablestr += "<tr>";
		tablestr += "<td><input type='text' name='txt_lic_pol_hold_name[]' id='txt_lic_pol_hold_name_"+LicIndex+"'class='tboxsmclass' value='" +LICPolHolName+ "' readonly></td>";
		tablestr += "<td><input type='text' name='txt_lic_pol_no[]' id='txt_lic_pol_no_"+LicIndex+"' class='tboxsmclass' value='" +LICPolNo+ "' readonly></td>";
		tablestr += "<td><input type='text' name='txt_lic_premium_amt[]' id='txt_lic_premium_amt_"+LicIndex+"' class='tboxsmclass' value='" +LICPremiumAmt+ "' readonly></td>";
		tablestr += "<td><input type='text' name='txt_lic_date_of_expiry[]' id='txt_lic_date_of_expiry_"+LicIndex+"' class='tboxsmclass datepicker' value='" +LICDOE+ "' readonly></td>";
		tablestr += "<td align='center'><i class='fa fa-times-circle sqdel ptr disable DeleteRow' id='DelRelationshipDetails' style='font-size:24px'></i></i></td>";
		tablestr += "</tr>";
		$("#lic_insur_table").append(tablestr);
		$('#txt_lic_pol_hold_name_0').val('');
		$('#txt_lic_pol_no_0').val('');
		$('#txt_lic_premium_amt_0').val('');
		$('#txt_lic_date_of_expiry_0').val('');
		LicIndex++;
	});
	
	var PliIndex = {{$PliIndex}};
	$(document).on('click','#pli_add_record',function(){
		var PLIPolHolName 	= $('#txt_pli_pol_hold_name_0').val();
		var PLIPolNo 		= $('#txt_pli_pol_no_0').val();
		var PLIPremiumAmt 	= $('#txt_pli_premium_amt_0').val();
		var PLIDOE 			= $('#txt_pli_date_of_expiry_0').val();
		let tablestr = "";
		tablestr += "<tr>";
		tablestr += "<td><input type='text' name='txt_pli_pol_hold_name[]' id='txt_pli_pol_hold_name_"+PliIndex+"' class='tboxsmclass' value='" +PLIPolHolName+ "' readonly></td>";
		tablestr += "<td><input type='text' name='txt_pli_pol_no[]' id='txt_pli_pol_no_"+PliIndex+"' class='tboxsmclass' value='" +PLIPolNo+ "' readonly></td>";
		tablestr += "<td><input type='text' name='txt_pli_premium_amt[]' id='txt_pli_premium_amt_"+PliIndex+"' class='tboxsmclass' value='" +PLIPremiumAmt+ "' readonly></td>";
		tablestr += "<td><input type='text' name='txt_pli_date_of_expiry[]' id='txt_pli_date_of_expiry_"+PliIndex+"' class='tboxsmclass datepicker' value='" +PLIDOE+ "' readonly></td>";
		tablestr += "<td align='center'><i class='fa fa-times-circle sqdel ptr disable DeleteRow' id='DelRelationshipDetails' style='font-size:24px'></i></i></td>";
		tablestr += "</tr>";
		$("#pli_insur_table").append(tablestr);
		$('#txt_pli_pol_hold_name_0').val('');
		$('#txt_pli_pol_no_0').val('');
		$('#txt_pli_premium_amt_0').val('');
		$('#txt_pli_date_of_expiry_0').val('');
		PliIndex++;
	});
	
	var EduIndex = {{$EduIndex}};
	$(document).on('click','#eduqual_add_record',function(){
		var EducationLevel 		= $('#cmb_education_level_0 option:selected').text();
		var EducationLevelId 	= $('#cmb_education_level_0 option:selected').val();
		var StudyMode 			= $('#cmb_study_mode_0 option:selected').text();
		var StudyModeId 		= $('#cmb_study_mode_0 option:selected').val();
		var Qualification 		= $('#txt_qualification_0').val();
		var InstituteName 		= $('#txt_institute_name_0').val();
		var University 			= $('#txt_university_name_0').val();
		var YearPassing 		= $('#txt_year_passing_0').val();
		let tablestr = "";
		tablestr += "<tr>";
		tablestr += "<td><input type='hidden' name='txt_education_level_id[]' id='txt_education_level_id_"+EduIndex+"' class='tboxsmclass' value='" +EducationLevelId+ "'><input type='text' name='txt_education_level[]' id='txt_education_level_"+EduIndex+"' class='tboxsmclass' value='"+EducationLevel+"'></td>";
		tablestr += "<td><input type='text' name='txt_qualification[]' id='txt_qualification_"+EduIndex+"' class='tboxsmclass' value='"+Qualification+"'></td>";
		tablestr += "<td><input type='text' name='txt_institute_name[]' id='txt_institute_name_"+EduIndex+"' class='tboxsmclass' value='"+InstituteName+"'></td>";
		tablestr += "<td><input type='text' name='txt_university_name[]' id='txt_university_name_"+EduIndex+"' class='tboxsmclass' value='"+University+"'></td>";
		tablestr += "<td><input type='text' name='txt_year_passing[]' id='txt_year_passing"+EduIndex+"' class='tboxsmclass' value='"+YearPassing+"'></td>";
		tablestr += "<td><input type='hidden' name='txt_study_mode_id[]' id='txt_study_mode_id_"+EduIndex+"'class='tboxsmclass' value='" +StudyModeId+ "'><input type='text' name='txt_study_mode[]' id='txt_study_mode_"+EduIndex+"' class='tboxsmclass' value='"+StudyMode+"'></td>";
		tablestr += "<td align='center'><i class='fa fa-times-circle sqdel ptr disable DeleteRow' id='DelRelationshipDetails' style='font-size:24px'></i></i></td>";
		tablestr += "</tr>";
		$("#edu_qual_table").append(tablestr);
		$('#cmb_education_level_0').chosen('destroy');
		$('#cmb_education_level_0').val('');
		$('#cmb_education_level_0').chosen();
		$('#txt_qualification_0').val('');
		$('#txt_institute_name_0').val('');
		$('#txt_university_name_0').val('');
		$('#txt_year_passing_0').val('');
		$('#cmb_study_mode_0').chosen('destroy');
		$('#cmb_study_mode_0').val('');
		$('#cmb_study_mode_0').chosen();
		EduIndex++;
	});
	$(document).on('click','.DeleteRow',function(){
		$(this).closest("tr").remove();
	}); 
	$("body").on("change","#hid_dependant_id_0", function(event){
		let Dependent = $(this).val();
		$("#txt_relationship_0").chosen('destroy'); 
		$('#txt_relationship_0').children('option:not(:first)').remove();
		$.ajax({
			type: 'POST',
			url: '{{ route("relationship.get-relationship") }}',
			data: { "_token": "{{ csrf_token() }}", Dependent: Dependent },
			dataType: 'json',
			success: function (data) {
				if(data) {
					$.each(data, function(key, value){
						$("#txt_relationship_0").append('<option value="' + value.relationship_id + '">' + value.relationship_name + '</option>');
					});
				}
				$("#txt_relationship_0").chosen(); 
			}
		});
	});

	$("body").on("change","#txt_ifsc_code", function(event){
		$("#txt_bank_name").val('');
		$("#txt_bank_id").val('');
		$("#txt_branch_address").val('');
		$("#txt_branch_id").val('');
		let IfscCode = $(this).val();	
		var SelOption = $('#IfscList option[value="'+IfscCode+'"]');
		let BankId = SelOption.data('bankid');
		$.ajax({
			type: 'POST', 
			url: "{{ route('bank.GetBankData') }}",
			data: { "_token": "{{ csrf_token() }}", 'IfscCode':IfscCode}, 
			success: function (data) {  
				if(data != ''){ 
					let BankData = data['BankData'];
					$.each(BankData, function(key, value){
						let BankName  	= value.bank_name; 
						let BranchAddr  = value.branch_addr1;
						let BranchId 	= value.branch_id;
						let BankId 		= value.bank_id;
						$("#txt_bank_name").val(BankName);
						$("#txt_bank_id").val(BankId);
						$("#txt_branch_address").val(BranchAddr);
						$("#txt_branch_id").val(BranchId);
					});
				}
			}
		});
	});
	// Style 3: Multiple Images
	document.getElementById('file_emp_photo').addEventListener('change', function(e) {
		handleImageUpload(e, 'img1');
	});
	document.getElementById('file_emp_aadhaar').addEventListener('change', function(e) {
		handleImageUpload(e, 'img2');
	});
	document.getElementById('file_emp_pan').addEventListener('change', function(e) {
		handleImageUpload(e, 'img3');
	});

	function handleImageUpload(e, imgId) {
		const file = e.target.files[0];
		if (file) {
			const reader = new FileReader();
			reader.onload = function(event) {
				const img = document.getElementById(imgId);
				img.src = event.target.result;
				img.parentElement.classList.add('has-image');
			};
			reader.readAsDataURL(file);
		}
	}

	function removeImage(e, imgId) {
		e.stopPropagation();
		const img = document.getElementById(imgId);
		img.src = '';
		img.parentElement.classList.remove('has-image');
	}

	
    $('#cmb_nationality').on('change', function () {
        if ($(this).val() === 'O') {
            $('#passport_section').show();
        } else {
            $('#passport_section').hide();
        }
    });

	$('#txt_payslip_name').on('input', function() {
    	$('#txt_acc_holder_name').val($(this).val());
	});

	$('input[name="rad_phy_handicapped"]').on('change', function () {
		if ($(this).val() === 'SELF' || $(this).val() === 'DEPEND') {
			$('#txt_phy_handicapp_perc').prop('readonly', false);
		} else {
			$('#txt_phy_handicapp_perc').prop('readonly', true).val('');
		}
	});

	
	/* var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var EmployeeType   		= $("#cmb_emp_type").val();
			var EmploymentType   	= $("#cmb_employment_type").val();
			var Icno		        = $("#txt_ic_no").val();
			var FirsteName   		= $("#txt_first_name").val();
			var LastName        	= $("#txt_last_name").val();
			var Designation 	    = $("#cmb_designation").val();
			var DOB   				= $("#txt_dob").val();
			var DOJ				   	= $("#txt_doj").val();
			var DateofRet		    = $("#txt_date_retire").val();
			var Category	   		= $("#txt_category").val();
			var Group			   	= $("#cmb_group").val();
			var Diviosn				= $("#cmb_div").val();
			var Section				= $("#cmb_sec").val();
			var Aadhar				= $("#txt_aadhar").val();
			var Panno				= $("#txt_pan_no").val();
			var Email				= $("#txt_email").val();
			var Mobile				= $("#txt_mobile").val();
			var Address				= $("#txt_cont_addr").val();


			if(EmployeeType == ""){
				BootstrapDialog.alert("Employee Type should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(EmploymentType == ""){
				BootstrapDialog.alert("Employement Type should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(Icno == ""){
				BootstrapDialog.alert("Ic No should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}
			else if(FirsteName == ""){
				BootstrapDialog.alert("Firste Nameshould not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(LastName == ""){
				BootstrapDialog.alert("Last Nameshould not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(DOJ == ""){
				BootstrapDialog.alert("DOJ should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}
			else if(DOB == ""){
				BootstrapDialog.alert("DOB not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(DateofRet == ""){
				BootstrapDialog.alert("Date of Retirement not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(Category == ""){
				BootstrapDialog.alert("Category should not be empty..!!");
			}	
			else if(Diviosn == ""){
				BootstrapDialog.alert("Diviosn not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(Section == ""){
				BootstrapDialog.alert("Section not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(Aadhar == ""){
				BootstrapDialog.alert("Aadhar should not be empty..!!");
			}
			else if(Panno == ""){
				BootstrapDialog.alert("Panno not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(Email == ""){
				BootstrapDialog.alert("Email not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}
			else if(Mobile == ""){
				BootstrapDialog.alert("Mobile not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(Address == ""){
				BootstrapDialog.alert("Address not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure want to Employee Details?',
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
	}); */

	var BankBranchDialog;
$("body").on("click","#AddNewIFScCode", function(event){

	/*$.ajax({
		type: 'POST', 
		url: "{{ route('bank.GetBankData') }}",
		data: { "_token": "{{ csrf_token() }}", 'IfscCode':IfscCode}, 
		success: function (data) {  
			if(data != ''){ 
				let BankData = data['BankData'];
				var BankOptionStr = "";
				$.each(BankData, function(key, value){
					let BankName  	= value.bank_name; 
					let BankId 		= value.bank_id;
					BankOptionStr += '<option value="'+BankId+'">'+BankName+'</option>'
				});

				

			}
		}
	});*/
	$("body").on("click","#AddNewIFScCode", function(event){
		var BankDataStr = '';
		BankDataStr += '<form name="model_bank_branch" id="model_bank_branch" method="post" enctype="multipart/form-data">';
		BankDataStr += '<table class="formtable" width="100%">';
		BankDataStr += '<div class="div3 label">Bank Name <span class="reqindi">*</span></div>';
		BankDataStr += '<div class="div9"><select name="bank_name" id="bank_name" class="tboxsmclass"><option value=""> ---- Select ---- </option></select></div>';
		BankDataStr += '<div class="div3 label">State Name <span class="reqindi">*</span></div>';
		BankDataStr += '<div class="div9"><select name="state_name" id="state_name" class="tboxsmclass"><option value=""> ---- Select ---- </option></select></div>';
		BankDataStr += '<div class="div3 label">IFSC Code <span class="reqindi">*</span> </div>';
		BankDataStr += '';
		BankDataStr += '';
		BankDataStr += '';
		BankDataStr += '<div class="row smclearrow"></div>';
		BankDataStr += '<div class="div12" align="center"><input type="button" class="backbutton" name="ModalSave" id="ModalSave" value="Save"  /><input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" /></div>';
		BankDataStr += '<div class="row smclearrow"></div>';
		BankDataStr += '</table>';
		BankDataStr += '</form>';
		BankBranchDialog = BootstrapDialog.show({
            title: 'Bank IFScCode Information',
			message: BankDataStr,
            onshown: function(dialogRef){
                //alert('Dialog is popped up.');
				$.ajax({
					type: 'POST', 
					url: "{{ route('bank.GetBankData') }}",
					data: { "_token": "{{ csrf_token() }}", 'IfscCode':IfscCode}, 
					success: function (data) {  
						if(data != ''){ 
							let BankData = data['BankData'];
							var BankOptionStr = "";
							$("#bank_name option:not(:first)").remove();
							$.each(BankData, function(index, element) {
								$("#bank_name").append('<option value="'+element.bank_id+'">'+element.bank_name+'</option>');
							});
						}
					}
				});

				$.ajax({
					type: 'POST', 
					url: "{{ route('bank.GetBankData') }}",
					data: { "_token": "{{ csrf_token() }}", 'IfscCode':IfscCode}, 
					success: function (data) {  
						if(data != ''){ 
							let BankData = data['BankData'];
							var BankOptionStr = "";
							$("#state_name option:not(:first)").remove();
							$.each(BankData, function(index, element) {
								$("#state_name").append('<option value="'+element.contid+'">'+element.name_contractor+'</option>');
							});
						}
					}
				});


            }
        });
	});
});

	$('#txt_dob').on('change', function () {
		let label = $('#dor_label').val();
		if (label !== 'Date of Retirement') {
			return;
		}
		let dob = $(this).val();
		if (!dob) return;
    	let parts = dob.split('/');
    	if (parts.length !== 3) return;
		let day = parseInt(parts[0]);
		let month = parseInt(parts[1]) - 1;
		let year = parseInt(parts[2]);
    	let dobDate = new Date(year, month, day);
		if (isNaN(dobDate.getTime())) {
			console.log("Invalid date:", dob);
			return;
		}
    	let retirementYear = year + 60;
    	let lastDay = new Date(retirementYear, month + 1, 0);

    	let formattedDate =
        String(lastDay.getDate()).padStart(2, '0') + '/' +
        String(lastDay.getMonth() + 1).padStart(2, '0') + '/' +
        lastDay.getFullYear();

    	$('#txt_date_retire').val(formattedDate);
	});

	$('#cmb_pdfrnpdf').change(function () {
        if ($(this).val() === 'Others') {
            $('#txt_other_pdf_name').show();
        } else {
            $('#txt_other_pdf_name').hide().val('');
        }
    });

	function getFellowshipAmount() {
    	let doj = $('#txt_doj').val();
    	let groupId = $('#cmb_employment_group').val();
		let phdriphd = $('#cmb_pdforipdf').val();
		let pdf = $('#cmb_pdfrnpdf').val();
		if(phdriphd != ""){
			let	code = phdriphd;
			if (doj && groupId) {
				$.ajax({
					url: '{{route("employee.get-fellowship-amount")}}',
					type: 'GET',
					data: {
						date_of_joining: doj,
						group_id: groupId,
						code:code
					},
					success: function(response) {
						$('#txt_pay_amount').val(response.amount);
					}
				});
			}
		}
		
	}

	function getFellowshipByExperience(element) {

		let row = $(element).closest('tr');
		let experience = $(element).val();
		let groupId = $('#cmb_employment_group').val();
		let	code = 'PDF';

		if (experience && groupId) {
			$.ajax({
				url: '{{route("employee.get-fellowship-by-experience")}}',
				type: 'GET',
				data: {
					experience: experience,
					group_id: groupId,
					code: code
				},
				success: function(response) {
					$('#txt_pay_amount').val(response.amount);
				}
			});
		}
	}

// $("#txt_pers_address").empty();
// $("#txt_office_mailid").empty();
// $("#txt_office_mobno").empty();
// $("input[name='rad_present_addr']").change(function() {
// if($(this).val() == 'Y') {
// 		var Address = $("#txt_perm_address").val();
// 		$("#txt_pers_address").val(Address);
// 	}else if($(this).val() == 'N'){
// 		$("#txt_pers_address").empty();
// 	}
// });
</script>
@endsection
