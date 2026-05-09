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
if(isset($data['FinancialYear'])){
	$FinancialYear = $data['FinancialYear'];
}else{
	$FinancialYear = '';
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
if(isset($data['CalculatedPayData'])){
	$CalculatedPayData = $data['CalculatedPayData'];
}else{
	$CalculatedPayData = [];
}
if(isset($data['groupedPayComponents'])){
	$groupedPayComponents = $data['groupedPayComponents'];
}else{
	$groupedPayComponents = [];
}
if(isset($data['otherPayComponents'])){
	$otherPayComponents = $data['otherPayComponents'];
}else{
	$otherPayComponents = [];
}
if(isset($data['homePayComponents'])){
	$homePayComponents = $data['homePayComponents'];
}else{
	$homePayComponents = [];
}
if(isset($data['investPayComponents'])){
	$investPayComponents = $data['investPayComponents'];
}else{
	$investPayComponents = [];
}

$AttIndex = 0;
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
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Projected IT Calculation</div></div></div>
								<div class="row innerdiv">
									<div class="row"> 
										 <!-- Form Steps --> 
										<div class="form-step active"> 
											<fieldset class="fieldbox" style="padding-bottom:3px;">
												<div class="fieldbox-div">
													<div class="div1 no-margin label lboxlabel">Financial Year</div>
													<div class="div2 no-margin"><input type="text" name="txt_financial_year" id="txt_financial_year" class="tboxsmclass disable" value="@if(isset($FinancialYear)){{$FinancialYear}}@endif" readonly></div>
												</div>
											</fieldset>
											<div class="row smclearrow"></div>
										</div>
										
											
											
										
									
									<div class="table-container" style="scroll:auto">
										<div class="table-wrapper">
											<div class="section-header">
												<span>Employee Tax Information</span>
											</div>
										<!-- Attendance Table -->
										<table class="attTable">
											<thead>
												<tr>
													<th nowrap="">IC No.</th>
													<th nowrap="">Employee Name</th>
													<th style="width: 100px;">BASIC</th>
													@if(isset($groupedPayComponents['ADD']))
													@foreach($groupedPayComponents['ADD'] as $PayComponentList)
														<th style="width: 180px;">{{ $PayComponentList->component_code }}</th>
													@endforeach
													@endif
													<th style="width: 130px;">GROSS</th>
													@if(isset($groupedPayComponents['DEDUCT']))
													@foreach($groupedPayComponents['DEDUCT'] as $PayComponentList)
														<th style="width: 180px;">{{ $PayComponentList->component_code }}</th>
													@endforeach
													@endif
													

													@if(isset($investPayComponents))
													@foreach($investPayComponents as $investPayComponentsList)
														<th style="width: 180px;">{{ $investPayComponentsList->component_code }}</th>
													@endforeach
													@endif

													@if(isset($homePayComponents))
													@foreach($homePayComponents as $homePayComponentsList)
														<th style="width: 180px;">{{ $homePayComponentsList->component_code }}</th>
													@endforeach
													@endif

													@if(isset($otherPayComponents))
													@foreach($otherPayComponents as $otherPayComponentsList)
														<th style="width: 180px;">{{ $otherPayComponentsList->component_code }}</th>
													@endforeach
													@endif

													<th style="width: 110px;">Regime</th>
													<th style="width: 110px;">Total IT</th>
													<th style="width: 110px;">IT Deduct/Month</th>
													<th nowrap="">NET SAL.</th>
													<!-- <th style="width: 150px;">HRA</th>
													<th style="width: 120px;">TA</th>
													<th style="width: 100px;">GPF</th>
													<th style="width: 140px;">CHSS</th>
													<th style="width: 140px;">LIC</th>
													<th style="width: 140px;">IT</th> -->
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

												$EmpCalculatedPayData = []; $EmpCalcComponentData = []; $EmpGrossSalary = 0; $EmpNetSalary = 0; 
												$EmpTaxData = []; $EmpTaxRegime = 'NEW'; $EmpTaxAmount = 0;
												if(isset($CalculatedPayData[$EmployeeList->emp_no])){
													$EmpCalculatedPayData = $CalculatedPayData[$EmployeeList->emp_no]; 
													if($EmpCalculatedPayData['calculated_components']){
														$EmpCalcComponentData = $EmpCalculatedPayData['calculated_components'];
														$EmpGrossSalary = $EmpCalculatedPayData['gross_earnings'];
														$EmpNetSalary = $EmpCalculatedPayData['net_salary'];
														$EmpTaxRegime = $EmpCalculatedPayData['tax_regime'] ?? '';
														$EmpTaxAmount = $EmpCalculatedPayData['tax_amount'] ?? 0;
														$EmpTaxData = $EmpCalculatedPayData['tax_data'] ?? [];
														$EmpTaxAmount = round($EmpTaxAmount);
													}
												}
												$TotalDeduction = 0;
												

												
												@endphp
												<tr>
													
													<td align="center">
														{{ $EmployeeList->emp_no }}<input type="hidden" class="tboxsmclass" name="txt_icno[]" id="txt_icno_{{$AttIndex}}" data-index="{{$AttIndex}}" value="{{ $EmployeeList->emp_no }}" readonly>
													</td>
													<td>{{ $EmployeeList->emp_name_payslip }}</td>
													
													<td align="right">
														{{\Helper::IndianRupeesFormatWithoutPise($BasicPay)}}
														<input type="hidden" class="tboxsmclass" name="txt_basic[]" id="txt_basic_{{$AttIndex}}" data-index="{{$AttIndex}}" value="{{ $BasicPay }}">
													</td>
													@if(filled($groupedPayComponents['ADD']))
													@foreach($groupedPayComponents['ADD'] as $PayComponentList)
													@php 
														if(isset($EmpCalcComponentData[$PayComponentList->component_code])){
															$ComponentCalcAmount = $EmpCalcComponentData[$PayComponentList->component_code];
														}else{
															$ComponentCalcAmount = 0;
														}
													@endphp
														<td align="right">
															{{\Helper::IndianRupeesFormatWithoutPise($ComponentCalcAmount)}}
															<input type="hidden" class="tboxsmclass" name="txt_pay_component_{{ $EmployeeList->emp_no }}[]" id="txt_pay_component_{{$AttIndex}}" min="0" max="31" value="{{$ComponentCalcAmount}}" data-index="{{$AttIndex}}">
															<input type="hidden" class="tboxsmclass" name="txt_pay_component_id_{{ $EmployeeList->emp_no }}[]" id="txt_pay_component_id_{{$AttIndex}}" min="0" max="31" value="{{$PayComponentList->component_id}}" data-index="{{$AttIndex}}">
															<input type="hidden" class="tboxsmclass" name="txt_pay_component_code_{{ $EmployeeList->emp_no }}[]" id="txt_pay_component_code_{{$AttIndex}}" min="0" max="31" value="{{$PayComponentList->component_code}}" data-index="{{$AttIndex}}">
														</td>
													@endforeach
													@endif
													<td align="right">
														{{\Helper::IndianRupeesFormatWithoutPise($EmpGrossSalary)}}
														<input type="hidden" class="tboxsmclass" name="txt_gross_salary[]" id="txt_gross_salary_{{$AttIndex}}" min="0" max="31" value="{{$EmpGrossSalary}}" data-index="{{$AttIndex}}">
													</td>
													@if(filled($groupedPayComponents['DEDUCT']))
													@foreach($groupedPayComponents['DEDUCT'] as $PayComponentList)
													@php 
														if(isset($EmpCalcComponentData[$PayComponentList->component_code])){
															$ComponentCalcAmount = $EmpCalcComponentData[$PayComponentList->component_code];
														}else{
															$ComponentCalcAmount = 0;
														}
														$TotalDeduction = $TotalDeduction + $ComponentCalcAmount;
													@endphp
														<td align="right">
															{{\Helper::IndianRupeesFormatWithoutPise($ComponentCalcAmount)}}
															<input type="hidden" class="tboxsmclass" name="txt_pay_component_{{ $EmployeeList->emp_no }}[]" id="txt_pay_component_{{$AttIndex}}" min="0" max="31" value="{{$ComponentCalcAmount}}" data-index="{{$AttIndex}}">
															<input type="hidden" class="tboxsmclass" name="txt_pay_component_id_{{ $EmployeeList->emp_no }}[]" id="txt_pay_component_id_{{$AttIndex}}" min="0" max="31" value="{{$PayComponentList->component_id}}" data-index="{{$AttIndex}}">
															<input type="hidden" class="tboxsmclass" name="txt_pay_component_code_{{ $EmployeeList->emp_no }}[]" id="txt_pay_component_code_{{$AttIndex}}" min="0" max="31" value="{{$PayComponentList->component_code}}" data-index="{{$AttIndex}}">
														</td>
													@endforeach
													@endif

													@if(filled($investPayComponents))
													@foreach($investPayComponents as $investPayComponentsList)
														@php 
														if(isset($EmpCalcComponentData[$investPayComponentsList->component_code])){
															$ComponentCalcAmount = $EmpCalcComponentData[$investPayComponentsList->component_code];
														}else{
															$ComponentCalcAmount = 0;
														}
														$TotalDeduction = $TotalDeduction + $ComponentCalcAmount;
														@endphp
														<td align="right">
															{{\Helper::IndianRupeesFormatWithoutPise($ComponentCalcAmount)}}
															<input type="hidden" class="tboxsmclass" name="txt_pay_component_{{ $EmployeeList->emp_no }}[]" id="txt_pay_component_{{$AttIndex}}" min="0" max="31" value="{{$ComponentCalcAmount}}" data-index="{{$AttIndex}}">
															<input type="hidden" class="tboxsmclass" name="txt_pay_component_id_{{ $EmployeeList->emp_no }}[]" id="txt_pay_component_id_{{$AttIndex}}" min="0" max="31" value="{{$investPayComponentsList->component_id}}" data-index="{{$AttIndex}}">
															<input type="hidden" class="tboxsmclass" name="txt_pay_component_code_{{ $EmployeeList->emp_no }}[]" id="txt_pay_component_code_{{$AttIndex}}" min="0" max="31" value="{{$investPayComponentsList->component_code}}" data-index="{{$AttIndex}}">
														</td>
													@endforeach
													@endif

													@if(filled($homePayComponents))
													@foreach($homePayComponents as $homePayComponentsList)
														@php 
														if(isset($EmpCalcComponentData[$homePayComponentsList->component_code])){
															$ComponentCalcAmount = $EmpCalcComponentData[$homePayComponentsList->component_code];
														}else{
															$ComponentCalcAmount = 0;
														}
														$TotalDeduction = $TotalDeduction + $ComponentCalcAmount;
														@endphp
														<td align="right">
															{{\Helper::IndianRupeesFormatWithoutPise($ComponentCalcAmount)}}
															<input type="hidden" class="tboxsmclass" name="txt_pay_component_{{ $EmployeeList->emp_no }}[]" id="txt_pay_component_{{$AttIndex}}" min="0" max="31" value="{{$ComponentCalcAmount}}" data-index="{{$AttIndex}}">
															<input type="hidden" class="tboxsmclass" name="txt_pay_component_id_{{ $EmployeeList->emp_no }}[]" id="txt_pay_component_id_{{$AttIndex}}" min="0" max="31" value="{{$homePayComponentsList->component_id}}" data-index="{{$AttIndex}}">
															<input type="hidden" class="tboxsmclass" name="txt_pay_component_code_{{ $EmployeeList->emp_no }}[]" id="txt_pay_component_code_{{$AttIndex}}" min="0" max="31" value="{{$homePayComponentsList->component_code}}" data-index="{{$AttIndex}}">
														</td>
													@endforeach
													@endif

													
													
													@if(isset($otherPayComponents))
													@foreach($otherPayComponents as $otherPayComponentsList)
														@php 
														if(isset($EmpCalcComponentData[$otherPayComponentsList->component_code])){
															$ComponentCalcAmount = $EmpCalcComponentData[$otherPayComponentsList->component_code];
														}else{
															$ComponentCalcAmount = 0;
														}
														$TotalDeduction = $TotalDeduction + $ComponentCalcAmount;
														@endphp
														<td align="right">
															{{\Helper::IndianRupeesFormatWithoutPise($ComponentCalcAmount)}}
															<input type="hidden" class="tboxsmclass" name="txt_pay_component_{{ $EmployeeList->emp_no }}[]" id="txt_pay_component_{{$AttIndex}}" min="0" max="31" value="{{$ComponentCalcAmount}}" data-index="{{$AttIndex}}">
															<input type="hidden" class="tboxsmclass" name="txt_pay_component_id_{{ $EmployeeList->emp_no }}[]" id="txt_pay_component_id_{{$AttIndex}}" min="0" max="31" value="{{$otherPayComponentsList->component_id}}" data-index="{{$AttIndex}}">
															<input type="hidden" class="tboxsmclass" name="txt_pay_component_code_{{ $EmployeeList->emp_no }}[]" id="txt_pay_component_code_{{$AttIndex}}" min="0" max="31" value="{{$otherPayComponentsList->component_code}}" data-index="{{$AttIndex}}">
														</td>
													@endforeach
													@endif
													<td align="center" style="width: 100px;">
														{{ $EmpTaxRegime }}
														<input type="hidden" class="tboxsmclass" name="txt_tax_regime[]" id="txt_tax_regime_{{$AttIndex}}" value="{{$EmpTaxRegime}}" data-index="{{$AttIndex}}">
													</td>
													<td align="right" style="width: 100px;">
														<span class="info-action-span ViewTaxInfo" data-id="{{$EmployeeList->emp_no}}" data-empgroup="{{$EmployeeList->employee_group_type}}">{{\Helper::IndianRupeesFormatWithoutPise($EmpTaxAmount)}}</span>
														<input type="hidden" class="tboxsmclass" name="txt_total_tax[]" id="txt_total_tax_{{$AttIndex}}" value="{{$EmpTaxAmount}}" data-index="{{$AttIndex}}">
													</td>
													<td align="right" style="width: 100px;">
														@php 
														$MonthlyTax = round($EmpTaxAmount / 12);
														@endphp
														{{\Helper::IndianRupeesFormatWithoutPise($MonthlyTax)}}
														<input type="hidden" class="tboxsmclass" name="txt_month_tax[]" id="txt_month_tax_{{$AttIndex}}" value="{{$MonthlyTax}}" data-index="{{$AttIndex}}">
													</td>

													<td align="right">
														{{\Helper::IndianRupeesFormatWithoutPise($EmpNetSalary)}}
														<input type="hidden" class="tboxsmclass" name="txt_total_deductions[]" id="txt_total_deductions_{{$AttIndex}}" min="0" max="31" value="{{$TotalDeduction}}" data-index="{{$AttIndex}}">
														<input type="hidden" class="tboxsmclass" name="txt_net_salary[]" id="txt_net_salary_{{$AttIndex}}" min="0" max="31" value="{{$EmpNetSalary}}" data-index="{{$AttIndex}}">
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
	$("body").on("click", ".ViewTaxInfo", function(event){
		let $btnEvent 	= $(this);
		let EmpNo   	= $btnEvent.attr('data-id');
		let EmpGroup   	= $btnEvent.attr('data-empgroup');
		let FinYear 	= $("#txt_financial_year").val();
		$.ajax({
			type: 'GET',
			url: '{{ route("incometax.projected-it-calculation-info") }}',
			//data: { "_token": "{{ csrf_token() }}", EmpNo: EmpNo, FinYear: FinYear, Page: 'Info', EmpGroup: EmpGroup },
			data: { EmpNo: EmpNo, FinYear: FinYear, Page: 'Info', EmpGroup: EmpGroup },
			dataType: 'json',
			success: function (data) {
				if(data) {
					//$.each(data, function(key, value){
						//$("#cmb_relationship_0").append('<option value="' + value.relationship_id + '">' + value.relationship_name + '</option>');
						//$("#xHtml").html(data)
					//});
					BootstrapDialog.show({
						title: 'Income Tax Information',
						message: $('<div>').html(data.HtmlData),
						buttons: [{
							label: 'OK',
							action: function(dialog) {
								dialog.close();
							}
						}],
						onshow: function(dialogRef){
							dialogRef.$modalDialog.css({
								'width': '80%',
								'max-width': 'none'
							});
						}
					});
				}
			}
		});
		/*let $btnEvent = $(this);
		BootstrapDialog.show({
           	title: 'Income Tax Information',
            message: '<div id="xTest"></div>',
            buttons: [{
                label: 'OK',
                action: function(dialog) {
                    dialog.close();
                }
            }],
			onshow: function(dialogRef){
                dialogRef.$modalDialog.css({
					'width': '80%',
					'max-width': 'none'
				});
            },
            onshown: function(dialogRef){ 
				let EmpNo   	= $btnEvent.attr('data-id');
				let EmpGroup   	= $btnEvent.attr('data-empgroup');
				let FinYear 	= $("#txt_financial_year").val();
				$.ajax({
					type: 'POST',
					url: '{{ route("incometax.projected-it-calculation-info") }}',
					data: { "_token": "{{ csrf_token() }}", EmpNo: EmpNo, FinYear: FinYear, Page: 'Info', EmpGroup: EmpGroup },
					dataType: 'json',
					success: function (data) {
						if(data) {
							//$.each(data, function(key, value){
								//$("#cmb_relationship_0").append('<option value="' + value.relationship_id + '">' + value.relationship_name + '</option>');
								$("#xHtml").html(data)
							//});
						}
						$("#cmb_relationship_0").chosen(); 
					}
				});
            },
        });*/
	});
	/*$("body").on("change", "#txt_total_working_days", function(event){
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
	});*/
	/*$("body").on("change", ".CalcAttendance", function(event){
		$(this).CalculateWOrkingDays(event);
	});*/

	/*$.fn.CalculateWOrkingDays = function(event) {
		let $row = $(this).closest('tr');
		let PresentDays = parseInt($row.find('.CalcAttendance').val()) || 0;
		let AbsentDays  = parseInt($row.find('.InpAbsentDays').val()) || 0;
		let Leaves      = parseInt($row.find('.InpLeaves').val()) || 0;
		let HalfDays    = parseInt($row.find('.InpHalfDays').val()) || 0;

		let PayCalcDays = PresentDays + Leaves - AbsentDays;
		$row.find('.InpPayCalcDays').val(PayCalcDays)
	}*/

	$("body").on("click", "#SaveDraft", function(event){
		
		let SaveIcNoArr = []; let components = {};
		$('input[name="txt_icno[]"]').each(function() {
			SaveIcNoArr.push($(this).val());
			let IcNo = $(this).val();
			if (!components[IcNo]) {
				components[IcNo] = {
					payComponents: [],
					payComponentIds: [],
					payComponentCodes: []
				};
			}
			$('input[name="txt_pay_component_'+IcNo+'[]"]').each(function() {
				//console.log(IcNo+" = "+$(this).val());
				components[IcNo].payComponents.push($(this).val());
			});
			$('input[name="txt_pay_component_id_'+IcNo+'[]"]').each(function() {
				//console.log(IcNo+" = "+$(this).val());
				components[IcNo].payComponentIds.push($(this).val());
			});
			$('input[name="txt_pay_component_code_'+IcNo+'[]"]').each(function() {
				//console.log(IcNo+" = "+$(this).val());
				components[IcNo].payComponentCodes.push($(this).val());
			});
		});
		
		if(SaveIcNoArr.length === 0){
			var SaveIcNoStr = "";
		}else{
			var SaveIcNoStr = JSON.stringify(SaveIcNoArr);
		} 
		if(components.length === 0){
			var ComponentsStr = "";
		}else{
			var ComponentsStr = JSON.stringify(components);
		} 
		//console.log(ComponentsStr);
		let SavePresentDaysArr = []; 
		$('input[name="txt_present[]"]').each(function() {
			SavePresentDaysArr.push($(this).val());
		});
		if(SavePresentDaysArr.length === 0){
			var SavePresentDaysStr = "";
		}else{
			var SavePresentDaysStr = JSON.stringify(SavePresentDaysArr);
		}

		let SaveBasicArr = []; 
		$('input[name="txt_basic[]"]').each(function() {
			SaveBasicArr.push($(this).val());
		});
		if(SaveBasicArr.length === 0){
			var SaveBasicStr = "";
		}else{
			var SaveBasicStr = JSON.stringify(SaveBasicArr);
		}

		let SaveGrossSalaryArr = []; 
		$('input[name="txt_gross_salary[]"]').each(function() {
			SaveGrossSalaryArr.push($(this).val());
		});
		if(SaveGrossSalaryArr.length === 0){
			var SaveGrossSalaryStr = "";
		}else{
			var SaveGrossSalaryStr = JSON.stringify(SaveGrossSalaryArr);
		}

		let SaveTotalDeductionsArr = []; 
		$('input[name="txt_total_deductions[]"]').each(function() {
			SaveTotalDeductionsArr.push($(this).val());
		});
		if(SaveTotalDeductionsArr.length === 0){
			var SaveTotalDeductionsStr = "";
		}else{
			var SaveTotalDeductionsStr = JSON.stringify(SaveTotalDeductionsArr);
		}

		let SaveNetSalaryArr = []; 
		$('input[name="txt_net_salary[]"]').each(function() {
			SaveNetSalaryArr.push($(this).val());
		});
		if(SaveNetSalaryArr.length === 0){
			var SaveNetSalaryStr = "";
		}else{
			var SaveNetSalaryStr = JSON.stringify(SaveNetSalaryArr);
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

		let SaveProcessedArr = []; 
		$('input[name="ch_process[]"]').each(function() {
			if($(this).is(':checked')){
				SaveProcessedArr.push($(this).val());
			}
		});
		if(SaveProcessedArr.length === 0){
			var SaveProcessedStr = "";
		}else{
			var SaveProcessedStr = JSON.stringify(SaveProcessedArr);
		}

		let SaveTaxRegimeArr = []; 
		$('input[name="txt_tax_regime[]"]').each(function() {
			SaveTaxRegimeArr.push($(this).val());
		});
		if(SaveTaxRegimeArr.length === 0){
			var SaveTaxRegimeStr = "";
		}else{
			var SaveTaxRegimeStr = JSON.stringify(SaveTaxRegimeArr);
		}

		let SaveMonthTaxArr = []; 
		$('input[name="txt_month_tax[]"]').each(function() {
			SaveMonthTaxArr.push($(this).val());
		});
		if(SaveMonthTaxArr.length === 0){
			var SaveMonthTaxStr = "";
		}else{
			var SaveMonthTaxStr = JSON.stringify(SaveMonthTaxArr);
		}

		let SaveTotalTaxArr = []; 
		$('input[name="txt_total_tax[]"]').each(function() {
			SaveTotalTaxArr.push($(this).val());
		});
		if(SaveTotalTaxArr.length === 0){
			var SaveTotalTaxStr = "";
		}else{
			var SaveTotalTaxStr = JSON.stringify(SaveTotalTaxArr);
		}

		

		let FinYear = $("#txt_financial_year").val();

		var form = document.createElement("form");
			form.method = "POST"; 
			form.action = "{{ route('incometax.projected-it-calculation') }}";
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
		var FloatingPageIp1 		= document.createElement("textarea");
			FloatingPageIp1.type 	= "hidden";
			FloatingPageIp1.name 	= "txt_float_component";
			FloatingPageIp1.value 	= ComponentsStr; 
			form.appendChild(FloatingPageIp1);
		var FloatingPageIp1 		= document.createElement("input");
			FloatingPageIp1.type 	= "hidden";
			FloatingPageIp1.name 	= "txt_float_basic";
			FloatingPageIp1.value 	= SaveBasicStr; 
			form.appendChild(FloatingPageIp1);
		var FloatingPageIp1 		= document.createElement("input");
			FloatingPageIp1.type 	= "hidden";
			FloatingPageIp1.name 	= "txt_float_gross_salary";
			FloatingPageIp1.value 	= SaveGrossSalaryStr; 
			form.appendChild(FloatingPageIp1); 

		var FloatingPageIp1 		= document.createElement("input");
			FloatingPageIp1.type 	= "hidden";
			FloatingPageIp1.name 	= "txt_float_total_deduction";
			FloatingPageIp1.value 	= SaveTotalDeductionsStr; 
			form.appendChild(FloatingPageIp1);

		var FloatingPageIp1 		= document.createElement("input");
			FloatingPageIp1.type 	= "hidden";
			FloatingPageIp1.name 	= "txt_float_net_salary";
			FloatingPageIp1.value 	= SaveNetSalaryStr; 
			form.appendChild(FloatingPageIp1);
		var FloatingPageIp1 		= document.createElement("input");
			FloatingPageIp1.type 	= "hidden";
			FloatingPageIp1.name 	= "txt_float_remarks";
			FloatingPageIp1.value 	= SaveRemarksStr; 
			form.appendChild(FloatingPageIp1);
		var FloatingPageIp1 		= document.createElement("input");
			FloatingPageIp1.type 	= "hidden";
			FloatingPageIp1.name 	= "txt_float_processed";
			FloatingPageIp1.value 	= SaveProcessedStr; 
			form.appendChild(FloatingPageIp1);

		var FloatingPageIp1 		= document.createElement("input");
			FloatingPageIp1.type 	= "hidden";
			FloatingPageIp1.name 	= "txt_float_month_tax";
			FloatingPageIp1.value 	= SaveMonthTaxStr; 
			form.appendChild(FloatingPageIp1);
		var FloatingPageIp1 		= document.createElement("input");
			FloatingPageIp1.type 	= "hidden";
			FloatingPageIp1.name 	= "txt_float_total_tax";
			FloatingPageIp1.value 	= SaveTotalTaxStr; 
			form.appendChild(FloatingPageIp1);
		var FloatingPageIp1 		= document.createElement("input");
			FloatingPageIp1.type 	= "hidden";
			FloatingPageIp1.name 	= "txt_float_tax_regime";
			FloatingPageIp1.value 	= SaveTaxRegimeStr; 
			form.appendChild(FloatingPageIp1);

		var FloatingPageIp1 		= document.createElement("input");
			FloatingPageIp1.type 	= "hidden";
			FloatingPageIp1.name 	= "txt_float_fin_year";
			FloatingPageIp1.value 	= FinYear; 
			form.appendChild(FloatingPageIp1);

		var FloatingSubmitBtn 		= document.createElement("input");
			FloatingSubmitBtn.type 	= "submit";
			FloatingSubmitBtn.name 	= "btn_save_tax";
			FloatingSubmitBtn.id 	= "btn_save_tax";
			form.appendChild(FloatingSubmitBtn);

			$("#btn_save_tax").trigger("click");
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
