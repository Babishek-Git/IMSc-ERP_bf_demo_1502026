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
if(isset($data['EmployeePayLevelGrpData'])){
	$EmployeePayLevelGrpData = $data['EmployeePayLevelGrpData'];
}else{
	$EmployeePayLevelGrpData = [];
}
if(isset($data['EmpAttendanceGrpData'])){
	$EmpAttendanceGrpData = $data['EmpAttendanceGrpData'];
}else{
	$EmpAttendanceGrpData = [];
}

$NoOfWorkingDays 	= \Carbon\Carbon::now()->daysInMonth;
$CurrentMonth 		= date("m");
$CurrentMonthStr 	= strtoupper(date("M-Y"));
$CurrenYear 		= date("Y"); 
$AttIndex = 0;
@endphp

<style>
	.table-container {
		/* padding: 30px; */
		overflow-x: auto;
	}

	table.attTable {
		width: 100%;
		border-collapse: collapse;
		background: white;
	}

	table.attTable thead {
		background: #f8f9fa;
		position: sticky;
		top: 0;
		z-index: 2;
	}

	table.attTable th {
		padding: 4px 5px;
		text-align: left;
		font-weight: 600;
		font-size: 12px;
		color: #000;
		border: 1px solid #BEC2C2;
		border-bottom: 2px solid #BEC2C2;
	}

	table.attTable td {
		padding: 2px 5px;
		border: 1px solid #BEC2C2;
		font-size: 12px;
		color: #0000CD;
	}

	table.attTable tbody tr {
		transition: background 0.2s;
	}

	table.attTable tbody tr:hover {
		background: #f8f9fa;
	}

	.employee-info {
		display: flex;
		align-items: center;
		gap: 12px;
	}


	.leave-badge {
		display: inline-block;
		padding: 2px 6px;
		border-radius: 12px;
		font-size: 11px;
		font-weight: 600;
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}

	.leave-badge.sick {
		background: #fef3c7;
		color: #92400e;
	}

	.leave-badge.casual {
		background: #dbeafe;
		color: #1e40af;
	}

	.leave-badge.earned {
		background: #d1fae5;
		color: #065f46;
	}

	.leave-badge.unpaid {
		background: #fee2e2;
		color: #991b1b;
	}


	.quick-fill {
		display: flex;
		gap: 10px;
		align-items: center;
		margin-left: auto;
	}

	.quick-fill label {
		font-weight: 600;
		font-size: 12px;
		color: #fff;
	}

	.quick-fill button {
		padding: 3px 15px;
		background: #1babd3;
		color: #fff;
		border: none;
		border-radius: 4px;
		font-weight: 600;
		cursor: pointer;
		font-size: 11px;
	}

	.quick-fill button:hover {
		background: #e0a800;
	}

	.section-header {
		background: #1154A2;
		color: white;
		padding: 2px 20px;
		font-weight: 600;
		font-size: 13px;
		border-radius: 4px 4px 0 0;
		margin-bottom: 0;
		display: flex;
		align-items: center;
		justify-content: space-between;
	}

	.table-wrapper {
		border: 1px solid #ddd;
		border-radius: 4px;
		margin-bottom: 20px;
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
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Pay Generation</div></div></div>
								<div class="row innerdiv">
									<div class="row"> 
										 <!-- Form Steps --> 
										<div class="form-step active"> 
											
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Pay Generation information</legend>
												<div class="fieldbox-div">
													
													<div class="div1 label lboxlabel">Payroll Year</div>
													<div class="div1"><input type="text" name="txt_attendance_year" id="txt_attendance_year" class="tboxsmclass disable" value="@if(isset($CurrenYear)){{$CurrenYear}}@endif"></div>
													<div class="div1 label rboxlabel">Payroll Month</div>
													<div class="div1">
														<input type="text" name="txt_attendance_month_str" id="txt_attendance_month_str" class="tboxsmclass disable" value="@if(isset($CurrentMonthStr)){{$CurrentMonthStr}}@endif">
														<input type="hidden" name="txt_attendance_month" id="txt_attendance_month" class="tboxsmclass disable" value="@if(isset($CurrentMonth)){{$CurrentMonth}}@endif">
													</div>
													<div class="div2 rboxlabel pd-l-20">No. of Working Days</div>
													<div class="div1">
														<input type="number" name="txt_total_working_days" id="txt_total_working_days" class="tboxsmclass" value="@if(isset($NoOfWorkingDays)){{$NoOfWorkingDays}}@endif">
														
													</div>
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
										</div>
										
											
											
										
									
									<div class="table-container">
										<div class="table-wrapper">
											<div class="section-header">
												<span>Employee Pay Information</span>
											</div>

										<!-- Attendance Table -->
										<table class="attTable">
											<thead>
												<tr>
													<th style="width: 50px;">SNo.</th>
													<th style="width: 100px;">IC No.</th>
													<th style="width: 250px;">Employee Name</th>
													<th style="width: 100px;">No. of Days</th>
													<th style="width: 100px;">Basic</th>
													@if(filled($data['payComponents']))
													@foreach($data['payComponents'] as $PayComponentList)
														<th style="width: 100px;">{{ $PayComponentList->component_code }}</th>
													@endforeach
													@endif
													<!-- <th style="width: 150px;">HRA</th>
													<th style="width: 120px;">TA</th>
													<th style="width: 100px;">GPF</th>
													<th style="width: 140px;">CHSS</th>
													<th style="width: 140px;">LIC</th>
													<th style="width: 140px;">IT</th> -->
													<th>Remarks</th>
												</tr>
											</thead>
											<tbody id="attendanceTableBody">
											@if(isset($data['EmployeeList']))
												@foreach($data['EmployeeList'] as $EmployeeListKey => $EmployeeList)

												@php
												$BasicPay = 0;
												if(isset($EmployeePayLevelGrpData[$EmployeeList->emp_no])){
													$EmpPayLevelData = $EmployeePayLevelGrpData[$EmployeeList->emp_no];
													if(isset($EmpPayLevelData['basic_salary'])){
														$BasicPay = $EmpPayLevelData['basic_salary'];
													}
												}
												$PayCalcDays = 0;
												if(isset($EmpAttendanceGrpData[$EmployeeList->emp_no])){
													$EmpAttendanceData = $EmpAttendanceGrpData[$EmployeeList->emp_no];
													if(isset($EmpAttendanceData['days_pay_calc'])){
														$PayCalcDays = $EmpAttendanceData['days_pay_calc'];
													}
												}

												
												@endphp
												<tr>
													<td align="center">{{ $loop->iteration }}</td>
													<td>
														<input type="text" class="tboxsmclass" name="txt_icno[]" id="txt_icno_{{$AttIndex}}" data-index="{{$AttIndex}}" value="{{ $EmployeeList->emp_no }}" readonly>
													</td>
													<td>{{ $EmployeeList->emp_name_payslip }}</td>
													<td>
														<input type="text" class="tboxsmclass" name="txt_present[]" id="txt_present_{{$AttIndex}}" min="0" max="31" value="{{ $PayCalcDays }}" data-index="{{$AttIndex}}">
													</td>
													<td>
														<input type="text" class="tboxsmclass" name="txt_basic[]" id="txt_basic_{{$AttIndex}}" data-index="{{$AttIndex}}" value="{{ $BasicPay }}">
													</td>
													@if(filled($data['payComponents']))
													@foreach($data['payComponents'] as $PayComponentList)
														<td>
															<input type="text" class="tboxsmclass" name="txt_pay_component[]" id="txt_pay_component_{{$AttIndex}}" min="0" max="31" value="0" data-index="{{$AttIndex}}">
														</td>
													@endforeach
													@endif
													<td>
														<input type="text" class="tboxsmclass" name="txt_remarks[]" id="txt_remarks_{{$AttIndex}}" data-index="{{$AttIndex}}">
													</td>
												</tr>
												@endforeach
											@endif
												
											</tbody>
										</table>
									</div>
									<div class="row" align="center">
										<input type="button" id="SaveDraft" name="SaveDraft" class="step-btn" value="Save">
									</div>
									<!-- <div style="display: flex; align-items: center; gap: 8px;">
										<label for="username">Name:</label>
										<input type="text" id="username">
									</div> -->
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

	$("body").on("change", "#txt_total_working_days", function(event){
		let TotalWorkingDays = $(this).val();
		if(!TotalWorkingDays || isNaN(TotalWorkingDays)){
			BootstrapDialog.alert("Enter valid number of working days");
			$(this).val('');
			return;
		}
		const TodayDate   = new Date();
		const DaysInMonth = new Date(TodayDate.getFullYear(), TodayDate.getMonth() + 1, 0).getDate();
		if((TotalWorkingDays <= DaysInMonth)&&(TotalWorkingDays > 0)){
			$(".InpPresentDays").val(TotalWorkingDays);
			$('.InpPresentDays').trigger('change');
		}else if(TotalWorkingDays > DaysInMonth){
			BootstrapDialog.alert("No of working days should be less than or equal to "+DaysInMonth);
			$(this).val('');
		}else if(TotalWorkingDays <= 0){
			BootstrapDialog.alert("No of working days must be greater than 0");
			$(this).val('');
		}
	});
	$("body").on("change", ".CalcAttendance", function(event){
		$(this).CalculateWOrkingDays(event);
	});

	$.fn.CalculateWOrkingDays = function(event) {
		let $row = $(this).closest('tr');
		let PresentDays = parseInt($row.find('.CalcAttendance').val()) || 0;
		let AbsentDays  = parseInt($row.find('.InpAbsentDays').val()) || 0;
		let Leaves      = parseInt($row.find('.InpLeaves').val()) || 0;
		let HalfDays    = parseInt($row.find('.InpHalfDays').val()) || 0;

		let PayCalcDays = PresentDays + Leaves - AbsentDays;
		$row.find('.InpPayCalcDays').val(PayCalcDays)
	}

	$("body").on("click", "#SaveDraft", function(event){
		
		let SaveIcNoArr = []; 
		$('input[name="txt_icno[]"]').each(function() {
			SaveIcNoArr.push($(this).val());
		});
		if(SaveIcNoArr.length === 0){
			var SaveIcNoStr = "";
		}else{
			var SaveIcNoStr = JSON.stringify(SaveIcNoArr);
		} 

		let SavePresentDaysArr = []; 
		$('input[name="txt_present[]"]').each(function() {
			SavePresentDaysArr.push($(this).val());
		});
		if(SavePresentDaysArr.length === 0){
			var SavePresentDaysStr = "";
		}else{
			var SavePresentDaysStr = JSON.stringify(SavePresentDaysArr);
		}

		let SaveAbsentDaysArr = []; 
		$('input[name="txt_absent[]"]').each(function() {
			SaveAbsentDaysArr.push($(this).val());
		});
		if(SaveAbsentDaysArr.length === 0){
			var SaveAbsentDaysStr = "";
		}else{
			var SaveAbsentDaysStr = JSON.stringify(SaveAbsentDaysArr);
		}

		let SaveLeaveArr = []; 
		$('input[name="txt_leave[]"]').each(function() {
			SaveLeaveArr.push($(this).val());
		});
		if(SaveLeaveArr.length === 0){
			var SaveLeaveStr = "";
		}else{
			var SaveLeaveStr = JSON.stringify(SaveLeaveArr);
		}

		let SaveLeaveTypeArr = []; 
		$('select[name="cmb_leave_type[]"]').each(function() {
			SaveLeaveTypeArr.push($(this).val());
		});
		if(SaveLeaveTypeArr.length === 0){
			var SaveLeaveTypeStr = "";
		}else{
			var SaveLeaveTypeStr = JSON.stringify(SaveLeaveTypeArr);
		}

		let SaveHalfDaysArr = []; 
		$('input[name="txt_half_day[]"]').each(function() {
			SaveHalfDaysArr.push($(this).val());
		});
		if(SaveHalfDaysArr.length === 0){
			var SaveHalfDaysStr = "";
		}else{
			var SaveHalfDaysStr = JSON.stringify(SaveHalfDaysArr);
		}

		let SavePayCalcDaysArr = []; 
		$('input[name="txt_pay_calc_days[]"]').each(function() {
			SavePayCalcDaysArr.push($(this).val());
		});
		if(SavePayCalcDaysArr.length === 0){
			var SavePayCalcDaysStr = "";
		}else{
			var SavePayCalcDaysStr = JSON.stringify(SavePayCalcDaysArr);
		}

		let SaveRemarksArr = []; 
		$('input[name="txt_remarks[]"]').each(function() {
			SaveRemarksArr.push($(this).val());
		});
		if(SaveRemarksArr.length === 0){
			var SaveRemarksStr = "";
		}else{
			var SaveRemarksStr = JSON.stringify(SaveRemarksArr);
		}

		let PayYear = $("#txt_attendance_year").val();
		let PayMonth = $("#txt_attendance_month").val(); 
		let PayMonthYr = $("#txt_attendance_month_str").val();
		let WorkingDays = $("#txt_total_working_days").val();

		var form = document.createElement("form");
			form.method = "POST"; 
			form.action = "{{ route('attendance.ManualAttendance') }}";
			form.name = "attendanceform"; 
			document.body.appendChild(form); 
		var csrfToken = document.createElement("input"); 
			csrfToken.type = "hidden";
			csrfToken.name = "_token"; 
			csrfToken.value = "{{ Session::token() }}"; 
			form.appendChild(csrfToken);
		
		var FloatingPageIp1 		= document.createElement("input");
			FloatingPageIp1.type 	= "hidden";
			FloatingPageIp1.name 	= "txt_float_icno";
			FloatingPageIp1.value 	= SaveIcNoStr; 
			form.appendChild(FloatingPageIp1);
		var FloatingPageIp1 		= document.createElement("input");
			FloatingPageIp1.type 	= "hidden";
			FloatingPageIp1.name 	= "txt_float_present";
			FloatingPageIp1.value 	= SavePresentDaysStr; 
			form.appendChild(FloatingPageIp1);
		var FloatingPageIp1 		= document.createElement("input");
			FloatingPageIp1.type 	= "hidden";
			FloatingPageIp1.name 	= "txt_float_absent";
			FloatingPageIp1.value 	= SaveAbsentDaysStr; 
			form.appendChild(FloatingPageIp1);
		var FloatingPageIp1 		= document.createElement("input");
			FloatingPageIp1.type 	= "hidden";
			FloatingPageIp1.name 	= "txt_float_leave";
			FloatingPageIp1.value 	= SaveLeaveStr; 
			form.appendChild(FloatingPageIp1);
		var FloatingPageIp1 		= document.createElement("input");
			FloatingPageIp1.type 	= "hidden";
			FloatingPageIp1.name 	= "cmb_float_leave_type";
			FloatingPageIp1.value 	= SaveLeaveTypeStr; 
			form.appendChild(FloatingPageIp1);
		var FloatingPageIp1 		= document.createElement("input");
			FloatingPageIp1.type 	= "hidden";
			FloatingPageIp1.name 	= "txt_float_half_day";
			FloatingPageIp1.value 	= SaveHalfDaysStr; 
			form.appendChild(FloatingPageIp1);
		var FloatingPageIp1 		= document.createElement("input");
			FloatingPageIp1.type 	= "hidden";
			FloatingPageIp1.name 	= "txt_float_pay_calc_days";
			FloatingPageIp1.value 	= SavePayCalcDaysStr; 
			form.appendChild(FloatingPageIp1);
		var FloatingPageIp1 		= document.createElement("input");
			FloatingPageIp1.type 	= "hidden";
			FloatingPageIp1.name 	= "txt_float_remarks";
			FloatingPageIp1.value 	= SaveRemarksStr; 
			form.appendChild(FloatingPageIp1);
		var FloatingPageIp1 		= document.createElement("input");
			FloatingPageIp1.type 	= "hidden";
			FloatingPageIp1.name 	= "txt_float_pay_year";
			FloatingPageIp1.value 	= PayYear; 
			form.appendChild(FloatingPageIp1);
		var FloatingPageIp1 		= document.createElement("input");
			FloatingPageIp1.type 	= "hidden";
			FloatingPageIp1.name 	= "txt_float_pay_month";
			FloatingPageIp1.value 	= PayMonth; 
			form.appendChild(FloatingPageIp1);
		var FloatingPageIp1 		= document.createElement("input");
			FloatingPageIp1.type 	= "hidden";
			FloatingPageIp1.name 	= "txt_float_pay_month_yr";
			FloatingPageIp1.value 	= PayMonthYr; 
			form.appendChild(FloatingPageIp1);
		var FloatingPageIp1 		= document.createElement("input");
			FloatingPageIp1.type 	= "hidden";
			FloatingPageIp1.name 	= "txt_float_working_days";
			FloatingPageIp1.value 	= WorkingDays; 
			form.appendChild(FloatingPageIp1);

		var FloatingSubmitBtn 		= document.createElement("input");
			FloatingSubmitBtn.type 	= "submit";
			FloatingSubmitBtn.name 	= "btn_save_attendance";
			FloatingSubmitBtn.id 	= "btn_save_attendance";
			form.appendChild(FloatingSubmitBtn);

			$("#btn_save_attendance").trigger("click");
	});
	/*function calculateRow(input) {
		const row = input.closest('tr');
		const present = parseInt(row.querySelector('[name*="[present]"]').value) || 0;
		const absent = parseInt(row.querySelector('[name*="[absent]"]').value) || 0;
		const leave = parseInt(row.querySelector('[name*="[leave]"]').value) || 0;
		const total = present + absent + leave;
		
		// Validate total doesn't exceed working days
		if (total > 31) {
			alert('Total days cannot exceed 31!');
			input.value = 0;
		}
	}

	// Quick fill all present days
	function quickFillAll(days) {
		const inputs = document.querySelectorAll('[name*="[present]"]');
		inputs.forEach(input => {
			input.value = days;
		});
	}

	// Quick fill specific column
	function quickFillColumn(type, value) {
		const inputs = document.querySelectorAll(`[name*="[${type}]"]`);
		inputs.forEach(input => {
			input.value = value;
		});
	}

	// Clear all entries
	function clearAll() {
		if (confirm('Are you sure you want to clear all entries?')) {
			const inputs = document.querySelectorAll('.attendance-input, .remarks-input');
			inputs.forEach(input => {
				input.value = '';
			});
		}
	}*/

       
</script>
@endsection
