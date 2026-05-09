@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
$AttIndex = 0;
@endphp



<form action="" method="post" enctype="multipart/form-data" name="form">
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1" style="overflow:auto">
					<div class="container">
						<div class="row">
              				<div class="div2"></div>
							<div class="div8 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Income Tax Regime Selection</div></div></div>
								<div class="row innerdiv">
									<div class="row"> 
										 <!-- Form Steps --> 
										<div class="form-step active"> 
											
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Financial Year Information</legend>
												<div class="fieldbox-div">
													
													<div class="div2 label lboxlabel">Financial Year</div>
													<div class="div3"><input type="text" name="txt_financial_year" id="txt_financial_year" class="tboxsmclass disable" value="@if(isset($FinancialYear)){{$FinancialYear}}@endif"></div>
													
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
												<span>Employee Information</span>
												<!-- <div class="quick-fill">
													<label>⚡ Quick Fill:</label>
													<button type="button" id="FillAllPresent">Fill All Present</button>
													<button type="button" id="ClearAll">Clear All</button>
												</div> -->
											</div>

										<table class="attTable">
											<thead>
												<tr>
													<th style="width:50px; vertical-align:middle;">SNo.</th>
													<th style="width:100px; vertical-align:middle;">IC No.</th>
													<th>Employee Name</th>
													<th>Designation</th>
													<th style="width:200px; vertical-align:middle; text-align:center;">Regime</th>
												</tr>
												
											</thead>
											<tbody id="attendanceTableBody">
											@if(isset($EmployeeList))
												@foreach($EmployeeList as $EmployeeListKey => $Employees)
												
												<tr>
													<td align="center">{{ $loop->iteration }}</td>
													<td><input type="text" class="tboxsmclass" name="txt_icno[]" id="txt_icno_{{$AttIndex}}" data-index="{{$AttIndex}}" value="{{ $Employees->emp_no }}" readonly></td>
													<td>{{ $Employees->emp_name_payslip }}</td>
													<td>{{ $Employees->designation_name }}</td>
													<td>
														<select name="cmb_tax_regime[]" id="cmb_tax_regime" class="tboxsmclass ChosenInput">
															<option value="NEW" @if($Employees->tax_regime == 'NEW'){{ 'selected' }}@endif>New Regime</option>
															<option value="OLD" @if($Employees->tax_regime == 'OLD'){{ 'selected' }}@endif>Old Regime</option>
														</select>
													</td>
												</tr>
												@endforeach
											@endif
												
											</tbody>
										</table>
									</div>
									<div class="row" align="center">
										<input type="button" id="SubmitApplication" name="SubmitApplication" class="step-btn" value="Save">
									</div>
								</div>
							</div>
							<div class="div3"></div>
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

	
	
	
	$("body").on("click", "#SubmitApplication", function(event){
		let SaveIcNoArr = []; 
		$('input[name="txt_icno[]"]').each(function() {
			SaveIcNoArr.push($(this).val());
		});
		if(SaveIcNoArr.length === 0){
			var SaveIcNoStr = "";
		}else{
			var SaveIcNoStr = JSON.stringify(SaveIcNoArr);
		} 

		let TaxRegimeArr = []; 
		$('select[name="cmb_tax_regime[]"]').each(function() {
			TaxRegimeArr.push($(this).val());
		});
		if(TaxRegimeArr.length === 0){
			var TaxRegimeStr = "";
		}else{
			var TaxRegimeStr = JSON.stringify(TaxRegimeArr);
		}
		console.log(TaxRegimeStr);
		let FinanceYear = $("#txt_financial_year").val();
		var form = document.createElement("form");
			form.method = "POST"; 
			form.action = "{{ route('incometax.tax-regime-selection') }}";
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
			FloatingPageIp1.name 	= "txt_float_tax_regime";
			FloatingPageIp1.value 	= TaxRegimeStr; 
			form.appendChild(FloatingPageIp1);
		var FloatingPageIp1 		= document.createElement("input");
			FloatingPageIp1.type 	= "hidden";
			FloatingPageIp1.name 	= "txt_float_finance_year";
			FloatingPageIp1.value 	= FinanceYear; 
			form.appendChild(FloatingPageIp1);
		var FloatingSubmitBtn 		= document.createElement("input");
			FloatingSubmitBtn.type 	= "submit";
			FloatingSubmitBtn.name 	= "btn_save_regime";
			FloatingSubmitBtn.id 	= "btn_save_regime";
			form.appendChild(FloatingSubmitBtn);
			$("#btn_save_regime").trigger("click");
	});
      
</script>
@endsection
