@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<form action="{{ route('admin.deleteagreementsheetentry') }}" method="post" enctype="multipart/form-data" name="form">
	<div class="content">
		<div class="title"> Work Orders - View</div>
		<div class="container_12">
			<div class="grid_12">
				<div align="right"></div>
				<blockquote class="bq1" style="overflow:auto">
					<div class="container" align="center">
						<div class="row">
							<div class="div1 "></div>
							<div class="div10 mbtable" align="center">
								<table class="table-bordered table1" width="99%" align="center" id="dataTable">
									<thead>
										<tr class="note" style="background-color:#E5E5E5;">
											<th colspan="9" style="text-align:center">List of Works </th>
										</tr>
										<tr class="note heading">
											<th  style="text-align:center">Action</th>
											<th  style="text-align:center">SNo.</th>
											<th  style="text-align:center">C.C.No.</th>
											<th  style="text-align:center">W.O.Date</th>
											<th  style="text-align:center">Work Order No.</th>
											<th  style="text-align:center">Name of Work</th>
											<th  style="text-align:center">T.S. No.</th>
											<th  style="text-align:center" nowrap="nowrap">Name of Contractor</th>
											<th  style="text-align:center">Agreement No.</th>
										</tr>
									</thead>
									<tbody>
										@foreach($data['workdata'] as $Work)
											<tr>
												<td align="center"><input type="checkbox" id="ch_action" name="ch_action[]" value="{{ $Work->sheetid }}"> </input>&nbsp;</td>
												<td align="center">{{ $loop->iteration }}</td>
												<td align="center">{{ $Work->computer_code_no }}</td>
												<td align="center">{{ Helper::DisplayDateFormat($Work->work_order_date) }}</td>
												<td align="center">{{ $Work->work_order_no }}</td>
												<td align="center">{{ $Work->work_name }}</td>
												<td align="center">{{ $Work->tech_sanction }}</td>
												<!-- <td align="center">{{ $Work->name_contractor }}</td> -->
												<td align="center">{{ $Work->cont_name }}</td>
												<td align="center">{{ $Work->agree_no }}</td>
											</tr>
										@endforeach
									</tbody>
								</table>
								<div class="div1 "></div>
							</div>
						</div>
					</div>
					@php $AddUrl = 'admin.agreementsheetentry'; @endphp 
					<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
						<div class="buttonsection">
							<input type="button" name="back" value="Back" class="backbutton" onClick="window.location='{{route($AddUrl)}}'" >
						</div>
						<!--	<div class="buttonsection">
							<input type="submit" name="submit" id="submit" data-type="submit" value="Delete"/>
						</div>	-->
						<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
					</div>
				</blockquote>
			</div>
		</div>
	</div>
</form>
<script>
	 $(document).ready(function(){

		$('#dataTable').DataTable({
			responsive: true,
			paging: true, 
		});

	
    });
</script>
@endsection	

