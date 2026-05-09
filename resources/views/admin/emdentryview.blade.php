@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<form action="" method="post" enctype="multipart/form-data" name="form">
<!--==============================Content=================================-->
	<div class="content">
		<div class="title">EMD Details</div>
		<div class="container_12">
			<div class="grid_12">
				<div align="right"></div>
				<blockquote class="bq1" style="overflow:auto">
					<div class="container" align="center">
					</br>
					<div class="div1"></div>
						<div class="div10 mbtable">
							<table class="table-bordered table1" align="center" id="dataTable">
								<thead>
									<tr>
										<th rowspan="2">SNo.</th>
										<th rowspan="2">Name Of Work</th>
										<th rowspan="2">EMD Amount</th>
										<th colspan="2">Contractor List and Detail</th>
										<th rowspan="2">Action</th>
									</tr>
									<tr>
										<th>Contractor Name</th>	
										<th>Instrument Type</th>	
									</tr>
								</thead>
								<tbody>
									@php 
									$EMDCountArr = array_count_values(array_column($data, 'sheetid')); 
									if(isset($data)){
										$x = 0; $y = 0; $Sno = 1;
										foreach($data as $ContractorList){
											$EmdId = $ContractorList->sheetid;
											$Rowspan = $EMDCountArr[$EmdId];
									@endphp
									<tr>@php if($x == 0){ @endphp
										<td align="center"  rowspan="{{ $Rowspan }}">{{ $Sno }}</td>
										<td align="center" rowspan="{{ $Rowspan }}">{{ $ContractorList->work_name }}</td>
										<td align="left" rowspan="{{ $Rowspan }}" >{{ $ContractorList->emdamt }}</td>
										@php } @endphp 
										<td align="left" > {{ $ContractorList->name_contractor  }} </td>
										<td align="left" > {{  $ContractorList->emd_mode }} </td>
										@php 
										if($x == 0){
										@endphp	
										<td align="center" rowspan="{{ $Rowspan }}">
											<a href="{{ route('admin.emdentry', ['id'=>encrypt($ContractorList->emdid)]) }}" class="oval-btn-delete">
												<i style="font-size:12px; padding-top:5px;" class="fa">&#xf044;</i> Edit	
											</a>
											&nbsp;
											<a href="javascript:Delete()" class="oval-btn-delete">
												<i style="font-size:12px; padding-top:5px; font-weight:100" class="fa">&#xf00d;</i> Delete
											</a>
										</td> 
										@php } @endphp
									</tr>
									@php
										$Sno++; $x++; $y++; if($y == $Rowspan){ $x = 0; $y = 0; }
										}	
									}
									@endphp
								</tbody>
								<tr>
									<td></td>	
								</tr>
							</table>
						</div>
					<div class="div1"></div>
					</div>
					<input type="hidden" name="hid_delete_flag" id="hid_delete_flag">
					@php $AddUrl ='admin.emdentry'; @endphp	
					<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
						<div class="buttonsection"><input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/></div>
						<div class="buttonsection"><input type="button" class="backbutton"  name="AddNew" id="AddNew" value="AddNew" onClick="window.location='{{ route($AddUrl) }}'"/></div>
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
			