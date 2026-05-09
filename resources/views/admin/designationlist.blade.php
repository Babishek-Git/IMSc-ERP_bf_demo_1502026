@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
<!--==============================header=================================-->
<form action="" method="post" enctype="multipart/form-data" name="phuploader">
<!--==============================Content=================================-->
	<div class="content">
		<div class="title">View Designation</div>
		<div class="container_12">
			<div class="grid_12" align="center">
				<blockquote class="bq1" id="bq1" style="overflow:auto">
					<div class="div12 div-p">
						<table class="table-bordered table1" align="center" id="dataTable">
							<thead>
								<tr>
									<th>SNo.</th>
									<th>Designation Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							@foreach($data as $Designation)
								<tr>
									<td align="center">{{$loop->iteration}}</td>
									<td>{{ decrypt($Designation['designationname']) }}</td>
									<td align="center">
										<a href="{{ route('admin.createdesignation', ['id'=>encrypt($Designation['designationid'])]) }}" class="oval-btn-edit">
											<i style="font-size:12px; padding-top:5px;" class="fa">&#xf044;</i> Edit	
										</a>
										<a href="{{ route('admin.deletedesignation', ['id'=>encrypt($Designation['designationid'])]) }}" class="oval-btn-delete">
											<i style="font-size:12px; padding-top:5px; font-weight:100" class="fa">&#xf00d;</i> Delete
										</a>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
					@php $AddUrl = 'admin.createdesignation'; @endphp
					<div class="div12 div-p">
						<div class="buttonsection"><input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/></div>
						<div class="buttonsection"><input type="button" class="backbutton" name="AddNew" id="AddNew" value="AddNew" onclick="window.location='{{ route($AddUrl) }}'"/></div>
					</div>
				</blockquote>
			</div>
		</div>
	</div>
<!--==============================footer=================================-->
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
