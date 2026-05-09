@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<form action="" method="post" enctype="multipart/form-data" name="form"> 
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<div align="right"></div>
				<blockquote class="bq1" style="overflow:auto">
				<div class="container" align="center">
					<div class="div1 "></div>
					<div class="div10 mbtable" align="center">
						<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> Role Master - View </div></div></div>
						<div class="row innerdiv">
							<div class="row">
								<table class="table-bordered table1" width="99%" align="center" id="dataTable">
									<thead>
										<tr class="note heading">
											<th  style="text-align:center">SNo.</th>
											<th  style="text-align:center">Role Name</th>
											<th  style="text-align:center">User Role Group</th>
										</tr>
									</thead>
									<tbody>
									@if(isset($data['data']))
										@foreach($data['data'] as $Role)
											<tr>
												<td align="center">{{ $loop->iteration }}</td>
												<td align="left">{{ $Role->role_name }}</td>
												<td align="left">{{ $Role->role_group_name }}</td>
											</tr>
										@endforeach
									@endif
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="div1 "></div>
					</div>
						@php $AddUrl = 'roles.RoleMaster'; @endphp 
					<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
						<div class="buttonsection">
							<input type="button" name="back" value="Back" class="backbutton" onClick="window.location='{{route($AddUrl)}}'" >
						</div>								
						<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
						</div>
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

