@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
<form action="" method="post" enctype="multipart/form-data" name="form">
<!--==============================Content=================================-->
	<div class="content">
		<div class="title">Water Recovery Details</div>
		<div class="container_12">
			<div class="grid_12">
				<div align="right"></div>
				<blockquote class="bq1" style="overflow:auto">
					<div class="container" align="center">
						<div> </br> </div>
						<div class="div1"></div>
						<div class="div10 mbtable">
						<table class="table-bordered table1" align="center" id="dataTable">
							<thead>
								<tr>
									<th>RAB No.</th>
									<th>Bill No.</th>
									<th>Meter No</th>
									<th>I.M.R</th>
									<th>I.M.R Date</th>
									<th>F.M.R</th>
									<th>F.M.R Date</th>
									<th>Unit Consumed</th>
									<th>Rate</th>
									<th>Meter Rent</th>
									<th>Amount</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							@php 
							$WatViewCountArr = array_count_values(array_column($data, 'rbn')); 
							if(isset($data)){
								$x = 0; $y = 0;
								foreach($data as $WaterList){
									$WId = $WaterList->rbn;
									$Rowspan = $WatViewCountArr[$WId];
							@endphp
								<tr>@php if($x == 0){ @endphp
									<td align="center" rowspan="{{ $Rowspan }}">{{ $WaterList->rbn }}</td>
									<td align="left" rowspan="{{ $Rowspan }}">{{ $WaterList->wbill_no }}</td>
									@php } @endphp 
									<td align="left" >{{ $WaterList->meter_no }}</td>
									<td align="left" >{{ $WaterList->imr }}</td>
									<td align="center" >{{ $WaterList->imr_date }}</td>
									<td align="center" >{{ $WaterList->fmr }}</td>
									<td align="center" >{{ $WaterList->fmr_date }}</td>
									<td align="center" >{{ $WaterList->unit_consum }}</td>
									<td align="center" >{{ $WaterList->rate }}</td>
									<td align="center" >{{ $WaterList->meter_rent }}</td>
									<td align="center" >{{ $WaterList->water_cost }}</td>
									@php 
									if($x == 0){
									@endphp	
									<td align="center" rowspan="{{ $Rowspan }}">
										<a href="{{ route('admin.generatewatermeterwise', ['sheetid'=>encrypt($WaterList->sheetid),'rab'=>encrypt($WaterList->rbn)]) }}" class="oval-btn-delete">
											<i style="font-size:12px; padding-top:5px;" class="fa">&#xf044;</i> Edit	
										</a>
									</td> 
									@php } @endphp
								</tr>
								@php
									$x++; $y++; if($y == $Rowspan){ $x = 0; $y = 0; }
								}	
							}
							@endphp
							</tbody>
						</table>
						</div>
						<div class="div1"></div>
						<input type="hidden" name="hid_delete_flag" id="hid_delete_flag">
						@php $AddUrl ='admin.editwaterrecovery'; @endphp
					</div>
					<div class="row">
						<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
							<div class="buttonsection">
								<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
							</div>
						</div>
					</div>
				</blockquote>
			</div>
		</div>
	</div>
</form>
<script>
	$(document).ready(function() {
		$('#dataTable').DataTable({
			responsive: true,
			paging: true, 
		});
	});
</script>
@endsection	
			