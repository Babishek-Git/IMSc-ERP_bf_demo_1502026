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
if(isset($data['EmpPayComponentData'])){
	$EmpPayComponentData = $data['EmpPayComponentData'];
}else{
	$EmpPayComponentData = '';
} 

if(isset($data['PayRollMasterData'])){
	$PayRollMasterData = $data['PayRollMasterData'];
}else{
	$PayRollMasterData = [];
}
if(isset($data['PayRollEmployeeData'])){
	$PayRollEmployeeData = $data['PayRollEmployeeData'];
}else{
	$PayRollEmployeeData = [];
}
if(isset($data['PayRollEmpCompGrpData'])){
	$PayRollEmpCompGrpData = $data['PayRollEmpCompGrpData'];
}else{
	$PayRollEmpCompGrpData = [];
}
if(isset($data['EmployeeGroupedData'])){
	$EmployeeGroupedData = $data['EmployeeGroupedData'];
}else{
	$EmployeeGroupedData = [];
}

if(($PayGenYear != NULL)&&($PayGenYear != '')&&($PayGenMonth != NULL)&&($PayGenMonth != '')){
	$CurrentMonthStr = \Carbon\Carbon::create($PayGenYear, $PayGenMonth, 1)->format('M-Y');
}else{
	$CurrentMonthStr = '';
}
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
	.payTable{
		width: 90%;
	}
	table.payTable .payslip-table td,
	table.payTable .payslip-table th {
		border: none;
		color: #000;
		
		font-size: 13px;
	}
	.payslip-table {
		border-collapse: separate !important;
		border-spacing: 4px; /* space between cells */
	}

	.payslip-content{
		border-radius: 10px;
		border: 2px solid #BEC2C2; 
		padding:10px 20px;
		box-shadow: rgba(0, 0, 0, 0.35) 0px 2px 8px;
		border-bottom: 3px solid #82accf !important;
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
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Pay Slip Generation</div></div></div>
								<div class="row innerdiv">
									<div class="row"> 
										<div class="form-step active"> 
											
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend" style="width:300px !important">Payslip for the month of {{ $CurrentMonthStr }}</legend>
												<div class="fieldbox-div">
													
													<div class="row smclearrow"></div>
													<div class="table-container">
														<div style="display:flex; justify-content:center;">
															
															<table class="payTable">
																<tbody id="attendanceTableBody">
																	<tr>
																		<td>
																			@if(filled($PayRollEmployeeData))
																			@foreach($PayRollEmployeeData as $PayRollEmployee)
																			@php 
																			$EmpData = $EmployeeGroupedData[$PayRollEmployee->emp_no] ?? [];
																			if(isset($PayRollEmpCompGrpData[$PayRollEmployee->payroll_employee_id])){
																				$PayCompData = $PayRollEmpCompGrpData[$PayRollEmployee->payroll_employee_id];
																				$EntilementData = array_values(collect($PayCompData)->where('pay_effect','ADD')->toArray());
																				$DeductionData = array_values(collect($PayCompData)->where('pay_effect','DEDUCT')->toArray());
																				if(isset($EmpPayComponentData[$PayRollEmployee->emp_no])){
																					$ActualComponents = $EmpPayComponentData[$PayRollEmployee->emp_no];
																				}else{
																					$ActualComponents = [];
																				}

																				$EntilementData = collect($EntilementData)
																						->reject(function ($item) use ($ActualComponents) {
																							return !in_array($item['component_id'], $ActualComponents)
																								&& (float)$item['final_amount'] == 0;
																						})
																						->values()   // reindex array
																						->toArray();
																				$DeductionData = collect($DeductionData)
																						->reject(function ($item) use ($ActualComponents) {
																							return !in_array($item['component_id'], $ActualComponents)
																								&& (float)$item['final_amount'] == 0;
																						})
																						->values()   // reindex array
																						->toArray();
																			}else{
																				$EntilementData = [];
																				$DeductionData = [];
																			} 
																			$BasicArray = [
																				'component_code' => 'BASIC',
																				'component_name' => 'PAY',
																				'component_type' => 'EARN',
																				'final_amount' => $PayRollEmployee->basic_salary,
																				'pay_effect' => 'ADD'
																				// ... other fields
																			];
																			array_unshift($EntilementData, $BasicArray);
																			$MaxRows = max(count($EntilementData), count($DeductionData));
																			@endphp
																			<table class="payslip-table" width="100%">
																				<tr>
																					<td class="payslip-content">
																		
																						<table style="border:0px solid black; width:100%; margin:auto; text-align:center;">
																							<tr><td aligh="center"><b><br/>THE INSTITUTE OF MATHEMATICAL SCIENCES</b></td></tr>
																							<tr><td aligh="center">Pay Slip for the month of {{ $CurrentMonthStr }}</td></tr>
																							<tr style="border-bottom:2px solid black;">	
																								<td style="text-align:right">{{date('d/m/Y')}}</td>
																							</tr>
																						</table>
																						<table style="border:opx solid black; width:100%; margin:auto; text-align:center;">
																							<tr style="border-bottom:2px solid black;">	
																								<td><table><tr><td>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table></td>
																								<td>
																									<br>
																									<table style="border:0px solid black; width:100%;">
																										<tr><td style="text-align:left;"><b>IC No</b></td><td>:</td><td style="text-align:left;">{{ $PayRollEmployee->emp_no }}</td></tr>
																										<tr><td style="text-align:left;"><b>Name</b></td><td>:</td><td style="text-align:left;">{{ $PayRollEmployee->emp_name }}</td></tr>
																										<tr><td style="text-align:left;"><b>Designation</b></td><td>:</td><td style="text-align:left;">{{ $PayRollEmployee->designation }}</td></tr>
																										<tr><td style="text-align:left;"><b>Level</b></td><td>:</td><td style="text-align:left;">{{ $PayRollEmployee->pay_level }}</td></tr>
																										<tr><td style="text-align:left;"><b>Pay in Level</b></td><td>:</td><td style="text-align:left;">{{ $PayRollEmployee->pay_in_level }}</td></tr>
																									</table>
																								</td>
																								<td>
																									<br>
																									<table style="border:0px solid black; width:100%;">
																										<tr><td style="text-align:left;"><b>Division</td><td>:</td><td style="text-align:left;">{{ $PayRollEmployee->division_name ?? '' }}</td></tr>
																										<tr><td style="text-align:left;"><b>PAN</td><td>:</td><td style="text-align:left;">{{ $EmpData->emp_pan_no ?? '' }}</td></tr>
																										<tr><td style="text-align:left;"><b>PF Number</td><td>:</td><td style="text-align:left;">{{ $EmpData->pf_number ?? '' }}</td></tr>
																										<tr><td style="text-align:left;"><b>Bank Account No.</td><td>:</td><td style="text-align:left;">{{ $PayRollEmployee->account_number ?? '' }}</td></tr>
																										<tr><td style="text-align:left;"><b>DNI</td><td>:</td><td style="text-align:left;">{{ Helper::DisplayDateFormat($PayRollEmployee->next_incr_dt) }}</td></tr>
																									</table>
																								</td>
																								<td><table><tr><td>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table></td>
																							</tr>
																						</table>
																						<table style="border:0px solid black; width:100%; margin:auto; text-align:center;">

																							<tr>
																								<td align="center">
																									<table border="1" style="solid black; width:100%;">
																										<tr style="border-bottom:2px solid black;">	
																											<td style="text-align:left;"><b>Entitlements</b></td>
																											<td style="text-align:right;"><b>Rs.</b></td>
																											<td width="80px">&nbsp;</td>
																											<td style="text-align:left;"><b>Deductions</b></td>
																											<td style="text-align:center;"><b>Rs.</b></td>
																											<td style="text-align:right;"><b>Instal.</b></td>
																											<td style="text-align:right;"><b>Advance</b></td>
																											<td style="text-align:right;"><b>Balance</b></td>
																										</tr>
																										@for($i = 0; $i < $MaxRows; $i++)
																										<tr>
																											<td style="text-align:left;"><b>@if(isset($EntilementData[$i])){{ $EntilementData[$i]['component_name'] }}@endif</b></td>
																											<td style="text-align:right;">@if(isset($EntilementData[$i])){{ Helper::IndianMoneyFormat($EntilementData[$i]['final_amount']) }}@endif</td>
																											<td>&nbsp;</td>
																											<td style="text-align:left;"><b>@if(isset($DeductionData[$i])){{ $DeductionData[$i]['component_name'] }}@endif</b></td>
																											<td style="text-align:right;">@if(isset($DeductionData[$i])){{ Helper::IndianMoneyFormat($DeductionData[$i]['final_amount']) }}@endif</td>
																											<td style="text-align:right;"></td>
																											<td style="text-align:right;"></td>
																											<td style="text-align:right;"></td>
																										</tr>
																										@endfor

																										
																										<tr style="border-top:2px solid #000; border-bottom:2px solid #000;">
																											<td style="text-align:left; padding:8px 0px;"><b>Total Gross</b></td>
																											<td style="text-align:right; padding:8px 0px;">{{ Helper::IndianMoneyFormat($PayRollEmployee->gross_salary) }}</td>
																											<td>&nbsp;</td>
																											<td style="text-align:left; padding:8px 0px;"><b>Total Deductions</b></td>
																											<td style="text-align:right; padding:8px 0px;">{{ Helper::IndianMoneyFormat($PayRollEmployee->total_deductions) }}</td>
																											<td style="text-align:right; padding:8px 0px;"><b>Total P.B.R Net</td>
																											<td style="text-align:right; padding:8px 0px;"></td>
																											<td style="text-align:right; padding:8px 0px;">{{ Helper::IndianMoneyFormat($PayRollEmployee->net_salary) }}</td>
																										</tr>
																									</table>
																								</td>
																							</tr>
																						</table>
																						<div class="row smclearrow"></div>
																						<div class="row smclearrow"></div>
																						<div class="row smclearrow"></div>

																					</td>
																				</tr>
																			</table>

																			@endforeach
																			@endif
																			
																		</td>
																	</tr>
																	
																</tbody>
															</table>
														</div>
														<div class="row" align="center">
															@php 
															$BackUrl ='payslip.payslip-generate';
															@endphp
															<input type="button" id="BtnBack" name="BtnBack" class="backbutton" value="Back" onclick="window.location='{{ route($BackUrl) }}'">
														</div>
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
									</div>
								</div> <!--- ..-->
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
	

       
</script>
@endsection
