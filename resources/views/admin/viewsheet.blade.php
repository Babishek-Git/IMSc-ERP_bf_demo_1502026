@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@foreach($data['works'] as $work)
	@php
	$WorkName 	=  $work->work_name;
	$CCno 		=  $work->computer_code_no;
	$WorkId 	=  $work->sheetid;
	$RebatePerc =  $work->rebate_percent;
	@endphp
@endforeach
@if(isset($data['Action'])) 
	@php 
	$Action = $data['Action']; 
	$ItemNoArr = array(); 
	$DuplicateArr = array(); 
	$DuplicateCnt = 0;
	@endphp 
@endif
<form name="form" method="post" action="{{ route('admin.Soq') }}">
	<!--==============================Content=================================-->
	<div class="content">  
		<div class="title"></div>
		<div class="container_12">  
			<div class="grid_12" align="center"> 
				<blockquote class="bq1" id="bq1" style="overflow:auto;">
					<div class="container" align="center">
						<div class="row">
							<div class="div1">&nbsp;</div>
							<div class="div10 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">BOQ - View</div></div></div>
								<div class="card-body padding-1 ChartCard" id="CourseChart">										
									<div class="divrowbox innerdiv pt-2">
										<div align="left" style="font-family:Verdana, Arial, Helvetica, sans-serif; color:#007BB7; font-size:11px; font-weight:bold;">
											<!--<span class="general">&nbsp;&nbsp;&nbsp;&nbsp;</span> General &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
											<span class="steel">&nbsp;&nbsp;&nbsp;&nbsp;</span> Steel &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<span class="st-steel">&nbsp;&nbsp;&nbsp;&nbsp;</span> Structural Steel 
										</div>
										<div class="titlesec">
											<b>Name of Work</b> :  {{ $WorkName }} <font style="color:#DF0979; font-weight:bold; background:#edeaea; border-radius:7px; padding:2px;">CCNo. {{ $CCno }}</font>
										</div>
										<div class="row smclearrow"></div>
										<table width="100%" class="table1 table2" id="xlTable">
											<tr class="heading">
												<th class="colhead" nowrap="nowrap">Item No.</th>
												<th class="colhead">Description</th>
												<th class="colhead" nowrap="nowrap">Total Qty.</th>
												<th class="colhead">Unit</th>
												<th class="colhead">Rate &#x20B9;</th>
												<th class="colhead" nowrap="nowrap">Total Amt &#x20B9;</th>
											</tr>
											
											@php $TotalAmount = 0; @endphp
											@foreach($data['items'] as $item)
												@php
												$Duplicate = 0; $DuplClass = '';
												if((isset($Action))&&($Action == 'CONF')){
													if(($item['sno'] != '')&&($item['sno'] != 0)){
														if(in_array($item['sno'],$ItemNoArr)){
															array_push($DuplicateArr,$item['sno']);
															$Duplicate = 1;
															$DuplClass = 'background:red; color:#ffffff;';
															$DuplicateCnt++;
														}else{
															array_push($ItemNoArr,$item['sno']);
														}

													}
												}
												if(($item['total_quantity'] != '')&&($item['total_quantity'] != 0)){
													$Amount =  round(((float)$item['total_quantity'] *  (float)$item['rate']),2);
													$TotalAmount = $TotalAmount + $Amount;
													$AmountStr = \Helper::IndianRupeesFormat($Amount);
												}else{
													$AmountStr = "";
												}
												
												@endphp
											<tr>
												<td class="col" align="center" nowrap="nowrap" style="{{ $DuplClass }}">{{ $item['sno'] }}</td>
												<td class="col labelprint" align="justify" style="{{ $DuplClass }}">{{ $item['description'] }}</td>
												<td class="col" align="right" style="{{ $DuplClass }}">{{ $item['total_quantity'] }}</td>
												<td class="col" align="center" style="{{ $DuplClass }}">{{ $item['per'] }}</td>
												<td class="col" align="right" style="{{ $DuplClass }}">{{ $item['rate'] }}</td>
												<td class="col" align="right" style="{{ $DuplClass }}">{{ $AmountStr }}</td>
											</tr>
											@php 

											@endphp
											@endforeach
											@php 
											$TotalAmountStr = \Helper::IndianRupeesFormat($TotalAmount);
											$RebateAmt = round(((float)$RebatePerc * (float)$TotalAmount / 100),2);
											$TotalAMtAfterRebate = round(($TotalAmount - $RebateAmt),2);
											@endphp
											<tr>
												<td class="col" align="center" nowrap="nowrap">
												<span class="">
													
												</span>
												</td>
												<td class="col labelprint" align="justify"></td>
												<td class="col" align="right">&nbsp;</td>
												<td class="col">&nbsp;&nbsp;</td>
												<td class="col" align="right">&nbsp;</td>
												<td class="col" align="right">&nbsp;</td>
											</tr>
											<tr>
												<td class="col"></td>
												<td class="col label" align="right">Over All Total Amount</td>
												<td class="col"></td>
												<td class="col"></td>
												<td class="col"></td>
												<td class="col label" nowrap="nowrap" align="right">{{ $TotalAmountStr }}</td>
											</tr>
											<tr>
												<td class="col"></td>
												<td class="col label" align="right">Over All Rebate&nbsp;&nbsp;(%)</td>
												<td class="col"></td>
												<td class="col"></td>
												<td class="col"></td>
												<td class="col label" nowrap="nowrap" align="right"> @if(isset($RebatePerc)){{ \Helper::IndianRupeesFormat($RebatePerc) }}@endif</td>
											</tr>
											<tr>
												<td class="col"></td>
												<td class="col label" align="right">Work Order Cost</td>
												<td class="col"></td>
												<td class="col"></td>
												<td class="col"></td>
												<td class="col label" nowrap="nowrap" align="right">{{ Helper::IndianRupeesFormat($TotalAMtAfterRebate) }}</td>
											</tr>
										</table>
										<div class="row smclearrow"></div>

										<div class="row">
											<div class="div12">
												@if(isset($data['Action']))
												@if($data['Action'] == 'CONF')
												<input type="hidden" name="txt_work" id="txt_work" value="@if($WorkId){{ $WorkId }}@endif" class="backbutton">
												@if($DuplicateCnt > 0)
													<input type="submit" name="action" id="delete" value="Delete" class="backbutton">
												@else
													<input type="submit" name="action" id="confirm" value="Confirm" class="backbutton">
												@endif
												@endif
												<input type="button" name="back" id="back" value="Back" data-backurl="{{ route('admin.soqupload') }}" class="backbutton">
												@else
												<input type="button" name="back" id="back" value="Back" data-backurl="{{ route('admin.viewsoq') }}" class="backbutton">
												@endif
												<!-- <input type="button" name="exportToExcel" id="exportToExcel" value="Export To Excel" class="backbutton"> -->
												<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
											</div>
											<div class="row smclearrow"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="div1">&nbsp;</div>
						</div>
					</div>
				</blockquote>
			</div>
		</div>    
	</div> 
</form>

@endsection	
