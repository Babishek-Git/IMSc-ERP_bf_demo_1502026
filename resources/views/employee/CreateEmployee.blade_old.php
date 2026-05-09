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
	}
}
$RetirementLabelArr = [];
$RetirementLabelArr['STAFF'] 		 = 'Date of Retirement';
$RetirementLabelArr['PROFESSOR'] 	 = 'Date of Retirement';
$RetirementLabelArr['TRAINEE'] 		 = 'Date of Retirement';
$RetirementLabelArr['RESEARCH_SCH']  = 'Date of Tenure';
$RetirementLabelArr['PROJECT_STAFF'] = 'Date of Tenure';
$RetirementLabelArr['STUDENT'] 		 = 'Date of Tenure';
$RetirementLabelArr['STUDENT'] 		 = 'Date of Tenure';
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
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Employee Registration</div></div></div>
								<div class="row innerdiv">
									<div class="row"> 
										
										
										<!-- Step Panels --> 
										 <div class="step-panels"> 
											<div class="step active"> <span class="step-span step-span-active">1</span> Personal Details</div> 
											<div class="step"><span class="step-span">2</span> Pay Details</div> 
											<div class="step" style="white-space: nowrap;"><span class="step-span">3</span> Education & Bank Details &nbsp;</div> 
											<div class="step"><span class="step-span">4</span> Family Details</div> 
											<div class="step"><span class="step-span">5</span> Insurance Details</div> 
											<div class="step"><span class="step-span">6</span> Others</div> 
										</div> 
										
										 <!-- Form Steps --> 
										<div class="form-step"> 
											
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Basic information</legend>
												<div class="fieldbox-div">
													<div class="div2 label">Employee Group <span class="reqindi">*</span></div>
													<div class="div2">
														<select name="cmb_employment_group" id="cmb_employment_group" class="tboxsmclass ChosenInput">
															@if(isset($data['employeeGroupMaster']))
																@foreach($data['employeeGroupMaster'] as $EmployeeGroupMasterList)
																	<option value="{{$EmployeeGroupMasterList->emp_group_id}}">{{$EmployeeGroupMasterList->emp_group_name}}</option>
																@endforeach
															@endif
														</select>
													</div>
													<div class="div2 label label pd-l-20">IC No <span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_emp_icno" id="txt_emp_icno" class="tboxsmclass" value=""></div>
													<div class="div2 label pd-l-20">Salute <span class="reqindi">*</span></div>
													<div class="div2">
														<select name="cmb_emp_salute" id="cmb_emp_salute" class="tboxsmclass ChosenInput">
															<option value="">----- Select -----</option>
															@if(isset($data['employeeSalute']))
																@foreach($data['employeeSalute'] as $EmployeeSaluteList)
																	<option value="{{$EmployeeSaluteList->salute_id}}">{{$EmployeeSaluteList->salute_name}}</option>
																@endforeach
															@endif
														</select>
													</div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>	
													<div class="div2 label">First Name <span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_emp_first_name" id="txt_emp_first_name" class="tboxsmclass" value=""></div>
													<div class="div2 label pd-l-20">Middle Name</div>
													<div class="div2"><input type="text" name="txt_emp_middle_name" id="txt_emp_middle_name" class="tboxsmclass" value=""></div>
													<div class="div2 label label pd-l-20">Last Name</div>
													<div class="div2"><input type="text" name="txt_emp_last_name" id="txt_emp_last_name" class="tboxsmclass" value=""></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>	
													<div class="div2 label">Name in Payslip <span class="reqindi">*</span></div>
													<div class="div6"><input type="text" name="txt_payslip_name" id="txt_payslip_name" class="tboxsmclass" value=""></div>
													<div class="div2 label pd-l-20">
														Gender <span class="reqindi">*</span>
													</div>
													<div class="div2 label">
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_gender_male" name="rad_gender" type="radio" value="M"/>
																<label for="rad_gender_male" style="padding:3px 0px; width:100%"> &nbsp;Male</label>
															</div>
														</div>
														<div class="div6 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_gender_female" name="rad_gender" type="radio" value="F"/>
																<label for="rad_gender_female" style="padding:3px 0px; width:100%"> &nbsp;Female</label>
															</div>
														</div>
													</div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="div2 label">
														Designation <span class="reqindi">*</span>
													</div>
													<div class="div2">
														<select name="cmb_designation" id="cmb_designation" class="tboxsmclass ChosenInput">
															<option value="">------ Select -----</option>
															@if(isset($data['desiginationList']))
																@foreach($data['desiginationList'] as $DesiginationList)
																	<option value="{{$DesiginationList->designation_id}}">{{$DesiginationList->designation_name}}</option>
																@endforeach
															@endif
															
														</select>
													</div>
													<div class="div2 label pd-l-20">
														Category <span class="reqindi">*</span>
													</div>
													<div class="div2">
														<select name="cmb_category" id="cmb_category" class="tboxsmclass ChosenInput">
															<option value="">------ Select -----</option>
															@if(isset($data['categoryList']))
																@foreach($data['categoryList'] as $CategoryList)
																	<option value="{{$CategoryList->emp_category_code}}">{{$CategoryList->emp_category}}</option>
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
																	<option value="{{$EmployeeMaritalStatusList->mar_status_code}}">{{$EmployeeMaritalStatusList->mar_status}}</option>
																@endforeach
															@endif
															
														</select>
													</div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="div2 label">Date of Birth <span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_dob" id="txt_dob" class="tboxsmclass  datepicker" value=""></div>
													<div class="div2 label pd-l-20">Date of Joining <span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_doj" id="txt_doj" class="tboxsmclass datepicker" value=""></div>
													<div class="div2 label pd-l-20">{{ $RetirementLabelArr[$EmpGroupCode] }} <span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_date_retire" id="txt_date_retire" class="tboxsmclass  datepicker" value=""></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="div2 label">Aadhaar No. <span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_aadhaar" id="txt_aadhaar" class="tboxsmclass" value=""></div>
													<div class="div2 label pd-l-20">PAN No. <span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_pan_no" id="txt_pan_no" class="tboxsmclass" value=""></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											
											
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Organizational Information</legend>
												<div class="fieldbox-div">
													<div class="div2 label pd-l-20">
														Group <span class="reqindi">*</span>
													</div>
													<div class="div2">
														<select name="cmb_group" id="cmb_group" class="tboxsmclass ChosenInput">
															<option value="">------ Select------</option>
															@if(isset($data['officeList']))
															@foreach($data['officeList'] as $Group)
																<option value="{{$Group->office_id}}">{{$Group->office_name}}</option>
															@endforeach
															@endif
														</select>
													</div>
													<div class="div2 label pd-l-20">
														Divison <span class="reqindi">*</span>
													</div>
													<div class="div2">
														<select name="cmb_division" id="cmb_division" class="tboxsmclass ChosenInput">
															<option value="">------ Select -----</option>
														</select>
													</div>
													<div class="div2 label pd-l-20">
														Section <span class="reqindi">*</span>
													</div>
													<div class="div2">
														<select name="cmb_section" id="cmb_section" class="tboxsmclass ChosenInput">
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
											

											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Contact Information</legend>
												<div class="fieldbox-div">
													<div class="div2 label pd-l-20">Intercom No. <span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_intercom_no" id="txt_intercom_no" class="tboxsmclass" value=""></div>
													<div class="div2 label pd-l-20">Mobile No. <span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_mobile" id="txt_mobile" class="tboxsmclass" value=""></div>
													<div class="div2 label pd-l-20">Official Email <span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_office_email" id="txt_office_email" class="tboxsmclass" value=""></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="div2 lboxlabel pd-l-20">Address <span class="reqindi">*</span></div>											
													<div class="div10"><textarea name="txt_cont_address" id="txt_cont_address" rows="4" class="tboxsmclass alphanumeric"></textarea></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>
											<div class="row smclearrow"></div> 
											<div class="row smclearrow"></div>                                                                                											
										</div>
											
											
										<div class="form-step"> 
											<div class="row smclearrow"></div> 
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Pay Information</legend>
												<div class="fieldbox-div">
													<div class="div2 label pd-l-20">Level <span class="reqindi">*</span></div>
													<div class="div2"> 
														<select name="cmb_pay_level" id="cmb_pay_level" class="tboxsmclass ChosenInput">
															<option value="">------ Select ------</option>
															@if(isset($data['PayLevelData']))
															@foreach($data['PayLevelData'] as $PayLevelDt)
																<option value="{{$PayLevelDt->pay_level}}">{{$PayLevelDt->pay_level}}</option>
															@endforeach
															@endif
														</select>
													</div>
													<div class="div2 label pd-l-20">Pay In Level <span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_basic_pay" id="txt_basic_pay" class="tboxsmclass" value=""></div>
													<div class="div2 label pd-l-20">Date of Next Increment <span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_next_incr_dt" id="txt_next_incr_dt" class="tboxsmclass" value=""></div>
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
												<legend class="fieldbox-legend">Pay Structure Information</legend>
												<div class="fieldbox-div">
													
													@if(isset($data['payComponents']))
													@foreach($data['payComponents'] as $payComponents)
														@php 
														$ShowComponent = 0;
														$ApplicableEmpGroup = $payComponents->applicable_emp_group;
														if($ApplicableEmpGroup != NULL){
															$ApplicableEmpGroupArr = explode(',',$ApplicableEmpGroup);
															if (in_array($EmpGroupId, $ApplicableEmpGroupArr)) {
																$ShowComponent = 1;
															}
														}
														@endphp
														@if($ShowComponent == 1)
														<div class="div4 label pd-l-20 no-margin">
															<div class="checkbox-group">
																<div class="checkbox-wrapper-2">
																	@php 
																	if($payComponents->is_default){
																		$CheckedStr 	= 'checked="checked"';
																		$ChActiveClass 	= ' readonly-checkbox';
																	}else{
																		$CheckedStr 	= '';
																		$ChActiveClass 	= '';
																	}
																	@endphp
																	<input type="checkbox" class="{{$payComponents->component_code}}{{ $ChActiveClass }} PayComponent" data-code="{{$payComponents->component_code}}" name="ch_pay_components[{{$payComponents->component_id}}]" id="{{$payComponents->component_id}}" value="{{$payComponents->component_code}}" {{ $CheckedStr }}>
																	<label for="{{$payComponents->component_id}}">
																		<span class="checkbox">
																			<div class="checkbox-front">?</div>
																			<div class="checkbox-back">✓</div>
																		</span>
																		 Is&nbsp;<lable style="">{{$payComponents->component_name}}</lable>&nbsp;Applicable ?
																	</label>
																</div>
															</div>
														</div>
														@if($payComponents->component_code == 'HRA')
														<div class="div1 no-margin label pd-l-20 HraBox">House </div>
														<div class="div3 no-margin HraBox"><input type="text" name="txt_house_no" id="txt_house_no" class="tboxsmclass" value=""></div>
														<div class="div2 no-margin rboxlabel pd-l-20 HraBox">Occupied Date </div>
														<div class="div2 no-margin HraBox"><input type="text" name="txt_occupied_date" id="txt_occupied_date" class="tboxsmclass" value=""></div>
														@endif
														@if($payComponents->component_code == 'ESI')
														<div class="div1 no-margin label pd-l-20 EsiBox hide">ESI No. <span class="reqindi">*</span></div>
														<div class="div3 no-margin EsiBox hide"><input type="text" name="txt_esi_no" id="txt_esi_no" class="tboxsmclass" value=""></div>
														@endif 
														@if($payComponents->component_code == 'GPF')
														<div class="div1 no-margin label pd-l-20 GpfBox hide">PF No. <span class="reqindi">*</span></div>
														<div class="div3 no-margin GpfBox hide"><input type="text" name="txt_pf_no" id="txt_pf_no" class="tboxsmclass" value=""></div>
														@endif
														@if($payComponents->component_code == 'NPS')
														<div class="div1 no-margin label pd-l-20 NpsBox hide">PRAN No. <span class="reqindi">*</span></div>
														<div class="div3 no-margin NpsBox hide"><input type="text" name="txt_pran_no" id="txt_pran_no" class="tboxsmclass" value=""></div>
														@endif

														<div class="row smclearrow bottom-border"></div>
														<div class="row smclearrow"></div>
														@endif
													@endforeach
													@endif
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>
										</div> 
										<div class="form-step"> 
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
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
																<th>Qualification / Degree</th>
																<th>Institution Name</th>
																<th>University / Board</th>
																<th>Year of Passing</th>
																<th>Mode of Study</th>
																<th>Action</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>
																	<select name="cmb_education_level_0" id="cmb_education_level_0" class="tboxsmclass ChosenInput">
																		<option value=""> -- Select --</option>
																		<option value="Secondary">Secondary</option>
																		<option value="Diploma">Diploma</option>
																		<option value="Graduate">Graduate</option>
																		<option value="Post Graduate">Post Graduate</option>
																		<option value="Doctorate">Doctorate</option>
																	</select>
																</td>
																<td><input type="text" name="txt_qualification_0" id="txt_qualification_0" class="tboxsmclass" value=""></td>
																<td><input type="text" name="txt_institute_name_0" id="txt_institute_name_0" class="tboxsmclass" value=""></td>
																<td><input type="text" name="txt_university_name_0" id="txt_university_name_0" class="tboxsmclass" value=""></td>
																<td><input type="text" name="txt_year_passing_0" id="txt_year_passing_0" class="tboxsmclass datepicker" value=""></td>
																<td>
																	<select name="cmb_study_mode_0" id="cmb_study_mode_0" class="tboxsmclass ChosenInput">
																		<option value=""> -- Select --</option>
																		<option value="Full-time">Full-time</option>
																		<option value="Part-time">Part-time</option>
																		<option value="Distance">Distance</option>
																	</select>
																</td>
																<td align="center"><i class="fa fa-plus-square sqadd ptr inp disable" id="eduqual_add_record" style="font-size:24px;"></i></td>
															</tr>
														</tbody>
													</table>
												</div>
												<div class="row smclearrow"></div>
												<div class="row smclearrow"></div>
											</fieldset>
											<div class="row smclearrow">&nbsp;</div>
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Bank Account Information</legend>
												<div class="fieldbox-div">
													<div class="div2 label pd-l-20">Account Holder Name <span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_acc_holder_name" id="txt_acc_holder_name" class="tboxsmclass" value=""></div>
													<div class="div2 label pd-l-20">Bank Account No <span class="reqindi">*</span></div>
													<div class="div2"><input type="text" name="txt_account_no" id="txt_account_no" class="tboxsmclass" value=""></div>
													<div class="div2 label pd-l-20">IFSC Code <span class="reqindi">*</span></div>
													<div class="div2">
														<input list="IfscList" type="text" name="txt_ifsc_code" id="txt_ifsc_code" class="tboxsmclass" value="">
														<datalist id="IfscList" style="color:#C80B5B; font-size:16px">
															@if(isset($data['IfscData']))
															@foreach($data['IfscData'] as $IfscData)
																<option data-bankid="{{$IfscData->bank_id}}" value="{{$IfscData->ifsc_code}}">
															@endforeach
															@endif
														</datalist>
													</div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="div2 label pd-l-20">Bank Name <span class="reqindi">*</span></div>
													<div class="div2">
														<input type="text" name="txt_bank_name" id="txt_bank_name" class="tboxsmclass" value="">
														<input type="hidden" name="txt_bank_id" id="txt_bank_id" class="tboxsmclass" value="">
													</div>
													<div class="div2 label pd-l-20">Branch Address <span class="reqindi">*</span></div>
													<div class="div6">
														<input type="hidden" name="txt_branch_id" id="txt_branch_id" class="tboxsmclass" value="">
														<input type="text" name="txt_branch_address" id="txt_branch_address" class="tboxsmclass" value="">
													</div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>	
										
										</div> 
										<div class="form-step"> 
											
											<div class="div12">                                                                        											
												<table class="formtable" align="center" id="RelationshipTable" width="100%">
													<thead>
														<tr>
															<th style="width:250px">Dependent Name</th>
															<th style="width:250px">Relationship Name</th>
															<th>Name</th>
															<th>Date of Birth</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>
																<select name="cmb_dependent_0" id="cmb_dependent_0" class="tboxsmclass ChosenInput"> 
																	<option value=""> ---- Select ---- </option> 
																	@if(isset($data['DependentData']))
																	@foreach($data['DependentData'] as $Row)
																	<option value="{{ $Row->dependant_id }}">{{ $Row->dependant_name }}</option> 
																	@endforeach
																	@endif
																</select>		
															</td>
															<td>
																<select name="cmb_relationship_0" id="cmb_relationship_0" class="tboxsmclass ChosenInput"> 
																	<option value=""> ---- Select ---- </option> 
																</select>
															</td>
															<td>
																<input type="text" name="txt_rel_name_0" id="txt_rel_name_0" class="tboxsmclass" value="">
															</td>
															<td>
																<input type="text" name="txt_dob_rel_0" id="txt_dob_rel_0" class="tboxsmclass datepicker" value="">
															</td>
															<td align='center'>
																<i class="fa fa-plus-square sqadd ptr inp disable" id="AddTechRec" style="font-size:24px;"></i>
															</td>
														</tr>
													
													</tbody>
												</table>
											</div>
											<div class="row smclearrow">&nbsp;</div>
											<div class="row smclearrow">&nbsp;</div>
										</div> 	
										<div class="form-step"> 
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
														</tbody>
													</table>
												</div>
												<div class="row smclearrow"></div>
												<div class="row smclearrow"></div>
											</fieldset>
											<div class="row smclearrow">&nbsp;</div>

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
														</tbody>
													</table>
												</div>
												<div class="row smclearrow"></div>
												<div class="row smclearrow"></div>
											</fieldset>

											<div class="row smclearrow">&nbsp;</div>
											<div class="row smclearrow">&nbsp;</div>
										</div> 
										
										<div class="form-step"> 
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Other Information</legend>
												<div class="fieldbox-div">
													<div class="div2 label pd-l-20">Physically Challanged ? <span class="reqindi">*</span></div>
													
													<div class="div6">
														<div class="div4 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_phy_handicapped_self" name="rad_phy_handicapped" type="radio" value="SELF"/>
																<label for="rad_phy_handicapped_self" style="padding:3px 0px; width:100%"> &nbsp;YES (Self)</label>
															</div>
														</div>
														<div class="div4 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_phy_handicapped_depend" name="rad_phy_handicapped" type="radio" value="DEPEND"/>
																<label for="rad_phy_handicapped_depend" style="padding:3px 0px; width:100%"> &nbsp;YES (Dependent)</label>
															</div>
														</div>
														<div class="div4 no-margin">
															<div class="inputGroup paddlr2">
																<input id="rad_phy_handicapped_no" name="rad_phy_handicapped" type="radio" value="NO"/>
																<label for="rad_phy_handicapped_no" style="padding:3px 0px; width:100%"> &nbsp;NO</label>
															</div>
														</div>
													</div>
													<div class="div2 cboxlabel pd-l-20">Percentage (%) <span class="reqindi">*</span></div>
													<div class="div2">
														<input type="text" name="txt_phy_handicapp_perc" id="txt_phy_handicapp_perc" class="tboxsmclass" value="">
													</div>
													
													
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
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
															<input type="file" id="file_emp_photo" accept="image/*">
															<input type="file" id="file_emp_aadhaar" accept="image/*">
															<input type="file" id="file_emp_pan" accept="image/*">
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
										<div class="row smclearrow">
											<!-- Navigation Buttons --> 
											<div class=""> 
												<div class="row smclearrow"></div> 
												<div class="row smclearrow"></div> 
												<div class="row smclearrow"></div> 
												<button type="button" id="prevBtn" class="step-btn step-btn-next">Previous - Preview</button> 
												<span style="float:right; display:block !important">
													<button type="submit" id="SaveDraft" name="SaveDraft" class="step-btn" value="Save and Continue">Save and Continue</button> 
													<button type="button" name="nextBtn" id="nextBtn" class="step-btn step-btn-prev">Next - Preview</button> 
												</span>
												
											</div> 
											<!-- Step Indicator --> 
											<div class="step-indicator" id="step-indicator">Step 1 of 5</div> 
										</div>



											
									</div>
									
								</div>
							</div>
						</div>
						<div class="row">
							<div class="div12" align="center">
								@php $CurrentTab = 0; @endphp
								<input type="hidden" name="txt_tab" id="txt_tab" value="{{ $CurrentTab }}" />
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
		nextBtn.textContent = currentStep === totalSteps - 1 ? "Next" : "Next - Preview"; 
		nextBtn.disabled = currentStep === totalSteps - 1; 
	} 
	nextBtn.addEventListener("click", () => { 
		if (currentStep < totalSteps - 1) { 
			currentStep++; updateForm(); 
			$("#txt_tab").val(currentStep);
		} else { 
			document.getElementById("multiStepForm").submit(); 
			$("#txt_tab").val(0);
		} 
	}); 
	prevBtn.addEventListener("click", () => { 
		if (currentStep > 0) { 
			currentStep--; 
			updateForm(); 
			$("#txt_tab").val(currentStep);
		} 
	}); 
	window.addEventListener('load', function() {
		document.getElementById('txt_tab').value = '0'; // or '0' depending on your starting tab
		currentStep = 0; // Reset to first step
		updateForm(); // Update the form display
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
								if (
									(data['WcmsRoleGroupCode'] == 'ADMUSER' && value.office_id == data['WcmsEmpDiv'] && value.active == 1) ||
									(data['WcmsRoleGroupCode'] == 'ACCADMUSER' && value.office_id == data['WcmsEmpDiv'] && value.active == 1) ||
									(data['WcmsRoleGroupCode'] == 'ACCUSER' && value.office_id == data['WcmsEmpDiv'] && value.active == 1) ||
									(data['WcmsRoleGroupCode'] == 'SUPUSER' && value.active == 1)
								) {
									cmbDivision.append('<option value="' + value.office_id + '">' + value.office_name + '</option>');
								}							
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
	var RelIndex = 1;
	$(document).on('click','#AddTechRec',function(){
		var DependentName = $('#cmb_dependent_0 option:selected').text();
		var DependentId = $('#cmb_dependent_0 option:selected').val();
		var RelationshipName = $('#cmb_relationship_0 option:selected').text();
		var RelationshipId = $('#cmb_relationship_0 option:selected').val();
		var RelName = $('#txt_rel_name_0').val();
		var RelDob = $('#txt_dob_rel_0').val();
		let tablestr = "";
		tablestr += "<tr>";
		tablestr += "<td><input type='hidden' name='hid_dependant_id[]' id='hid_dependant_id_"+RelIndex+"' class='tboxsmclass' value='" +DependentId+ "'><input type='text' name='txt_dependant_name[]' id='txt_dependant_name' class='tboxsmclass' value='"+DependentName+"'></td>";
		tablestr += "<td><input type='hidden' name='txt_relationship[]' id='txt_relationship_"+RelIndex+"'class='tboxsmclass' value='" +RelationshipId+ "'><input type='text' name='txt_relationship_name[]' id='txt_relationship_name' class='tboxsmclass' value='"+RelationshipName+"'></td>";
		tablestr += "<td><input type='text' name='txt_rel_name[]' id='txt_rel_name_"+RelIndex+"' class='tboxsmclass' value='"+RelName+"'></td>";
		tablestr += "<td><input type='text' name='txt_dob_rel[]' id='txt_dob_rel_"+RelIndex+"' class='tboxsmclass datepicker' value='"+RelDob+"'></td>";
		tablestr += "<td align='center'><i class='fa fa-times-circle sqdel ptr disable DeleteRow' id='DelRelationshipDetails' style='font-size:24px'></i></i></td>";
		tablestr += "</tr>";
		$("#RelationshipTable").append(tablestr);
		$('#cmb_dependent_0').chosen('destroy');
		$('#cmb_dependent_0').val('');
		$('#cmb_dependent_0').chosen();
		$('#cmb_relationship_0').chosen('destroy');
		$('#cmb_relationship_0').val('');
		$('#cmb_relationship_0').chosen();
		$('#txt_rel_name_0').val('');
		$('#txt_dob_rel_0').val('');
		RelIndex++;
	});
	var LicIndex = 1;
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
	var PliIndex = 1;
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
	var EduIndex = 1;
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
	$("body").on("change","#cmb_dependent_0", function(event){
		let Dependent = $(this).val();
		$("#cmb_relationship_0").chosen('destroy'); 
		$('#cmb_relationship_0').children('option:not(:first)').remove();
		$.ajax({
			type: 'POST',
			url: '{{ route("relationship.get-relationship") }}',
			data: { "_token": "{{ csrf_token() }}", Dependent: Dependent },
			dataType: 'json',
			success: function (data) {
				if(data) {
					$.each(data, function(key, value){
						$("#cmb_relationship_0").append('<option value="' + value.relationship_id + '">' + value.relationship_name + '</option>');
					});
				}
				$("#cmb_relationship_0").chosen(); 
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


</script>
@endsection
