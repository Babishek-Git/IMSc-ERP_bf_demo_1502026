@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
<body class="page1" id="top">
	<form name="form" method="get" action="{{ route('admin.viewelectricityrecoverylist') }}">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row ">
								<div class="div1">&nbsp;</div>
								<div class="div10 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> Electricity Recovery List </div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
											<table width="100%" class="table-bordered table1" id="example">
												<thead>
													<tr>
														<th>RBA No.</th>
														<th>Bill No.</th>
														<th>Meter No.</th>
														<th>I.M.R</th>
														<th>I.M.R. Date</th>
														<th>F.M.R</th>
														<th>F.M.R. Date</th>
														<th>Unit Consumed</th>
														<th>Rate</th>
														<th>Meter Rent</th>
														<th>Amount</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
												@php 
													$RbaCountArr = array_count_values(array_column($data, 'rbn')); 
													if(isset($data)){
														$x = 0; $y = 0; 
														foreach($data as $MeterList){
																$RbnId = $MeterList->rbn;
																$Rowspan = $RbaCountArr[$RbnId];
												@endphp
													<tr>
													@php if($x == 0){ @endphp
														<td align="center"rowspan="{{ $Rowspan }}">{{ $MeterList->rbn}}</td>
														<td align="center"rowspan="{{ $Rowspan }}">{{ $MeterList->ebill_no }}</td>
														@php } @endphp
														<td align="center">{{ $MeterList->meter_no }}</td>
														<td align="center" >{{ $MeterList->imr }}</td>
														<td align="center">{{ $MeterList->imr_date }}</td>
														<td align="center">{{ $MeterList->fmr }}</td>
														<td align="center">{{ $MeterList->fmr_date }}</td>
														<td align="center">{{ $MeterList->unit_consum }}</td>
														<td align="center">{{ $MeterList->rate }}</td>
														<td align="center">{{ $MeterList->meter_rent }}</td>
														<td align="center">{{ $MeterList->electricity_cost }}</td>
														@php 
														if($x == 0){
														@endphp	
														<td align="center"rowspan="{{ $Rowspan }}"> 
														<a href="{{ route('admin.generateelectricitybill', ['sheetid'=>encrypt($MeterList->sheetid),'rab'=>encrypt($MeterList->rbn)]) }}" class="oval-btn-delete">
																	<i style="font-size:12px; padding-top:5px;" class="fa">&#xf044;</i> Edit</a>
														</td>
														@php } @endphp
													</tr>
													@php
													$x++; $y++; if($y == $Rowspan){ $x = 0; $y = 0; }
														}	
														}@endphp
												</tbody>
											</table>
											
											<input type="hidden" name="hid_delete_flag" id="hid_delete_flag">
											<div class="row">
											<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
												<div class="buttonsection">
													<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
												</div>
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
</body>
<script>
	$(document).ready(function() {
		$('#dataTable').DataTable({
			responsive: true,
			paging: true, 
		});
	});
</script>
@endsection
