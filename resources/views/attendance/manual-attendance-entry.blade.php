@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php

if(isset($data['PayGenMonth'])){
	$PayGenMonth = $data['PayGenMonth'];
}else{
	$PayGenMonth = '';
}
if(isset($data['PayGenYear'])){
	$PayGenYear = $data['PayGenYear'];
}else{
	$PayGenYear = '';
}
if(isset($data['EmpAttendanceLeaveData'])){
	$EmpAttendanceLeaveData = $data['EmpAttendanceLeaveData'];
}else{
	$EmpAttendanceLeaveData = '';
}
if(isset($data['LeaveTypeData'])){
	$LeaveTypeData = $data['LeaveTypeData'];
}else{
	$LeaveTypeData = '';
}
$TotalWorkingDays = 0;
if(isset($data['WorkingDayData'])){
	$WorkingDayData = $data['WorkingDayData'];
	if(isset($WorkingDayData['WorkingDays'])){
		$TotalWorkingDays = $WorkingDayData['WorkingDays'];
	}
}
if(isset($data['EmpGroupStr'])){
	$EmpGroupStr = $data['EmpGroupStr'];
}else{
	$EmpGroupStr = '';
}




if(($PayGenYear != NULL)&&($PayGenYear != '')&&($PayGenMonth != NULL)&&($PayGenMonth != '')){
	$CurrentMonthStr = \Carbon\Carbon::create($PayGenYear, $PayGenMonth, 1)->format('M-Y');
}else{
	$CurrentMonthStr = '';
}

$NoOfWorkingDays 	= \Carbon\Carbon::create($PayGenYear, $PayGenMonth, 1)->daysInMonth;
$TotalWorkingDays = $NoOfWorkingDays;
if($TotalWorkingDays < 30){ $TotalWorkingDays = 30; }
$CurrentMonth 		= $PayGenMonth;//date("m");
//$CurrentMonthStr 	= strtoupper(date("M-Y"));
$CurrenYear 		= $PayGenYear;//date("Y"); 
$AttIndex = 0;
@endphp

<style>
	.table-container {
		/* padding: 30px; */
		overflow-x: auto;
	}

	/*table.attTable {
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
	}*/

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
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Employee Attendance Entry</div></div></div>
								<div class="row innerdiv">
									<div class="row"> 
										 <!-- Form Steps --> 
										<div class="form-step active"> 
											
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Attendance information</legend>
												<div class="fieldbox-div">
													
													<div class="div1 label lboxlabel">Payroll Year</div>
													<div class="div1"><input type="text" name="txt_attendance_year" id="txt_attendance_year" class="tboxsmclass disable" value="@if(isset($CurrenYear)){{$CurrenYear}}@endif"></div>
													<div class="div1 label rboxlabel">Payroll Month</div>
													<div class="div1">
														<input type="text" name="txt_attendance_month_str" id="txt_attendance_month_str" class="tboxsmclass disable" value="@if(isset($CurrentMonthStr)){{$CurrentMonthStr}}@endif">
														<input type="hidden" name="txt_attendance_month" id="txt_attendance_month" class="tboxsmclass disable" value="@if(isset($CurrentMonth)){{$CurrentMonth}}@endif">
													</div>
													<div class="div2 rboxlabel pd-l-20">Total Days in Month</div>
													<div class="div1">
														<input type="number" name="txt_total_month_days" id="txt_total_month_days" class="tboxsmclass" value="@if(isset($NoOfWorkingDays)){{$NoOfWorkingDays}}@endif">
														
													</div>
													<div class="div2 rboxlabel pd-l-20 hide">No. of Working Days</div>
													<div class="div1 hide">
														<input type="number" name="txt_total_working_days" id="txt_total_working_days" class="tboxsmclass" value="@if(isset($TotalWorkingDays)){{$TotalWorkingDays}}@endif">
														
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
												<span>Employee Attendance</span>
												<div class="quick-fill">
													<label>⚡ Quick Fill:</label>
													<button type="button" id="FillAllPresent">Fill All Present</button>
													<!-- <button type="button" id="quickFillColumn('present', 22)">Fill Present Column</button> -->
													<button type="button" id="ClearAll">Clear All</button>
												</div>
											</div>

										<!-- Attendance Table -->
										<table class="attTable">
											<thead>
												<tr>
													<!-- <th style="width: 50px;">SNo.</th>
													<th style="width: 100px;">IC No.</th>
													<th style="width: 250px;">Employee Name</th>
													<th style="width: 100px;">Present</th>
													<th style="width: 100px;">Absent</th>
													<th style="width: 100px;">Leave</th>
													<th style="width: 150px;">Leave Type</th>
													<th style="width: 120px;">Leave Balance</th>
													<th style="width: 100px;">Half Day</th>
													<th style="width: 140px;">Days for Pay Calc.</th>
													<th>Remarks</th> -->
													<th rowspan="2" style="width:50px; vertical-align:middle;">SNo.</th>
													<th rowspan="2" style="width:100px; vertical-align:middle;">IC No.</th>
													<th rowspan="2" style="width:250px; vertical-align:middle;">Employee Name</th>
													<th rowspan="2" style="width:80px; vertical-align:middle; text-align:center;">Working<br/> Days</th>
													<th rowspan="2" style="width:80px; vertical-align:middle;text-align:center;">Leave<br/>Taken</th>
													<!-- <th rowspan="2" style="width:80px; vertical-align:middle;">Present</th> -->
													<th rowspan="2" style="width:80px; vertical-align:middle;text-align:center;">Pay Calc.<br/> Days</th>
													<th nowrap="" colspan="{{ count($LeaveTypeData) }}" style="vertical-align:middle; text-align:center;">Leave Details</th>
													<th rowspan="2" style="vertical-align:middle; text-align:center;">Remarks</th>
												</tr>
												<tr>
													@if(filled($LeaveTypeData))
													@foreach($LeaveTypeData as $LeaveType)
													<th style="width: 50px;">{{ $LeaveType->leave_type_code }}</th>
													@endforeach
													@else
													<th style="text-align:center;"> - </th>
													@endif
												</tr>
											</thead>
											<tbody id="attendanceTableBody">
											@if(isset($data['EmployeeList']))
												@foreach($data['EmployeeList'] as $EmployeeListKey => $EmployeeList)
												@php 
												$HalfPayLeaveData = NULL; $EmpHalfPayLeave = 0; $ExtraOrdinaryLeave = 0; $EmpAttendData = NULL; $TotalLeaves = 0;
												if(isset($EmpAttendanceLeaveData[$EmployeeList->emp_no])){ 
													$EmpAttendData 			= $EmpAttendanceLeaveData[$EmployeeList->emp_no];
													$TotalLeaves 			= $EmpAttendData->sum('actual_days_attend_calc');
													$HalfPayLeaveData 		= $EmpAttendData->where('leaveType.leave_type_code', 'HPL');
													$ExtraOrdinaryLeaveData = $EmpAttendData->where('leaveType.leave_type_code', 'EOL');
													$EmpHalfPayLeave 		= $HalfPayLeaveData->sum('actual_days_attend_calc');
													$ExtraOrdinaryLeave 	= $ExtraOrdinaryLeaveData->sum('actual_days_attend_calc');
												}
												$TotalPresent = $TotalWorkingDays - $TotalLeaves;
												$PayCalcDays = $TotalWorkingDays - $ExtraOrdinaryLeave - ($EmpHalfPayLeave / 2);
												$EmpLeaveData = [];
												@endphp
												<tr>
													<td align="center">{{ $loop->iteration }}</td>
													<td><input type="text" class="tboxsmclass" name="txt_icno[]" id="txt_icno_{{$AttIndex}}" data-index="{{$AttIndex}}" value="{{ $EmployeeList->emp_no }}" readonly></td>
													<td>{{ $EmployeeList->emp_name_payslip }}</td>
													<!-- <td>
														<input type="number" class="tboxsmclass InpPresentDays CalcAttendance" name="txt_present[]" id="txt_present_{{$AttIndex}}" min="0" max="31" value="@if(isset($NoOfWorkingDays)){{$NoOfWorkingDays}}@endif" data-index="{{$AttIndex}}">
													</td>
													<td>
														<input type="number" class="tboxsmclass InpAbsentDays CalcAttendance" name="txt_absent[]" id="txt_absent_{{$AttIndex}}" min="0" max="31" value="0" data-index="{{$AttIndex}}">
													</td>
													<td>
														<input type="number" class="tboxsmclass InpLeaves CalcAttendance" name="txt_leave[]" id="txt_leave_{{$AttIndex}}" min="0" max="31" value="0" data-index="{{$AttIndex}}">
													</td>
													<td>
														<select class="tboxsmclass InpLeaveType" name="cmb_leave_type[]" id="cmb_leave_type_{{$AttIndex}}" data-index="{{$AttIndex}}">
															<option value="">None</option>
															<option value="1">Sick Leave</option>
															<option value="2" selected>Casual Leave</option>
															<option value="3">Earned Leave</option>
															<option value="4">Unpaid Leave</option>
														</select>
													</td>
													<td nowrap="">
														<span class="leave-badge casual">CL: 8</span>
														<span class="leave-badge sick">SL: 6</span>
													</td>
													<td>
														<input type="number" class="tboxsmclass InpHalfDays CalcAttendance" name="txt_half_day[]" id="txt_half_day_{{$AttIndex}}" min="0" max="31" value="{{ $EmpHalfPayLeave }}" step="0.5" data-index="{{$AttIndex}}">
													</td>
													<td>
														<input type="number" class="tboxsmclass InpPayCalcDays" name="txt_pay_calc_days[]" id="txt_pay_calc_days_{{$AttIndex}}" data-index="{{$AttIndex}}">
													</td>
													<td>
														<input type="text" class="tboxsmclass InpAttendRemarks" name="txt_remarks[]" id="txt_remarks_{{$AttIndex}}" data-index="{{$AttIndex}}" placeholder="Add remarks...">
													</td> -->
													<td><input type="number" class="tboxsmclass InpEmpWorkDays CalcAttendance" name="txt_emp_work_days[]" id="txt_emp_work_days_{{$AttIndex}}" min="0" max="31" value="@if(isset($TotalWorkingDays)){{$TotalWorkingDays}}@endif" data-index="{{$AttIndex}}"></td>
													<td><input type="number" class="tboxsmclass InpLeaves CalcAttendance" name="txt_leave[]" id="txt_leave_{{$AttIndex}}" min="0" max="31" value="@if(isset($TotalLeaves)){{$TotalLeaves}}@endif" data-index="{{$AttIndex}}"></td>
													
														<input type="hidden" class="tboxsmclass InpPresentDays CalcAttendance" name="txt_present[]" id="txt_present_{{$AttIndex}}" min="0" max="31" value="@if(isset($TotalPresent)){{$TotalPresent}}@endif" data-index="{{$AttIndex}}">
													<td><input type="number" class="tboxsmclass InpPayCalcDays CalcAttendance" name="txt_pay_calc_days[]" id="txt_pay_calc_days_{{$AttIndex}}" min="0" max="31" value="@if(isset($PayCalcDays)){{$PayCalcDays}}@endif" data-index="{{$AttIndex}}"></td>
													@if(filled($LeaveTypeData)) 
													@foreach($LeaveTypeData as $LeaveType)
													<td align="center">
														@if(filled($EmpAttendData))
														@php 
														$EmpLeavesData = $EmpAttendData->where('leaveType.leave_type_code', $LeaveType->leave_type_code);
														$EmpLeaves = ($EmpLeavesData ?? collect())->sum('actual_days_attend_calc');
														$EmpLeaveData[$LeaveType->leave_type_code] = $EmpLeaves;
														@endphp
														{{ $EmpLeaves }}
														@endif
													</td>
													@endforeach
													@else
													<td align="center"> - </td>
													@endif
													<td>
														<input type="hidden" class="tboxsmclass InpLeaveData" name="txt_leave_data[]" id="txt_leave_data{{$AttIndex}}" data-index="{{$AttIndex}}" value="{{ json_encode($EmpLeaveData) }}" >
														<input type="text" class="tboxsmclass InpAttendRemarks" name="txt_remarks[]" id="txt_remarks_{{$AttIndex}}" data-index="{{$AttIndex}}" placeholder="Add remarks...">
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
							<input type="hidden" name="txt_emp_group_type" id="txt_emp_group_type" value="{{ encrypt($EmpGroupStr) }}" />
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
		let CurrentMonth = $("#txt_attendance_month").val();
		let CurrentYear = $("#txt_attendance_year").val();
		const TodayDate   = new Date();
		const DaysInMonth = new Date(CurrentYear, CurrentMonth, 0).getDate();//new Date(TodayDate.getFullYear(), TodayDate.getMonth() + 1, 0).getDate();
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
		/*$('input[name="txt_absent[]"]').each(function() {
			SaveAbsentDaysArr.push($(this).val());
		});*/
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
		/*$('select[name="cmb_leave_type[]"]').each(function() {
			SaveLeaveTypeArr.push($(this).val());
		});*/
		if(SaveLeaveTypeArr.length === 0){
			var SaveLeaveTypeStr = "";
		}else{
			var SaveLeaveTypeStr = JSON.stringify(SaveLeaveTypeArr);
		}

		let SaveHalfDaysArr = []; 
		/*$('input[name="txt_half_day[]"]').each(function() {
			SaveHalfDaysArr.push($(this).val());
		});*/
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

		let SaveWorkingDaysArr = []; 
		$('input[name="txt_emp_work_days[]"]').each(function() {
			SaveWorkingDaysArr.push($(this).val());
		});
		if(SaveWorkingDaysArr.length === 0){
			var SaveWorkingDaysStr = "";
		}else{
			var SaveWorkingDaysStr = JSON.stringify(SaveWorkingDaysArr);
		}
		let SaveLeaveDataArr = []; 
		$('input[name="txt_leave_data[]"]').each(function() {
			SaveLeaveDataArr.push(JSON.parse($(this).val()));
		});
		if(SaveLeaveDataArr.length === 0){
			var SaveLeaveDataStr = "";
		}else{
			var SaveLeaveDataStr = JSON.stringify(SaveLeaveDataArr);
		}
		console.log(SaveLeaveDataStr);
		

		let PayYear = $("#txt_attendance_year").val();
		let PayMonth = $("#txt_attendance_month").val(); 
		let PayMonthYr = $("#txt_attendance_month_str").val();
		let WorkingDays = $("#txt_total_working_days").val();
		let EmpGrouptype = $("#txt_emp_group_type").val();

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
		var FloatingPageIp1 		= document.createElement("input");
			FloatingPageIp1.type 	= "hidden";
			FloatingPageIp1.name 	= "txt_float_emp_working_days";
			FloatingPageIp1.value 	= SaveWorkingDaysStr; 
			form.appendChild(FloatingPageIp1);
		var FloatingPageIp1 		= document.createElement("input");
			FloatingPageIp1.type 	= "hidden";
			FloatingPageIp1.name 	= "txt_float_leave_data";
			FloatingPageIp1.value 	= SaveLeaveDataStr; 
			form.appendChild(FloatingPageIp1);
		var FloatingPageIp1 		= document.createElement("input");
			FloatingPageIp1.type 	= "hidden";
			FloatingPageIp1.name 	= "txt_float_emp_group_type";
			FloatingPageIp1.value 	= EmpGrouptype; 
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
