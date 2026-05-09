@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
<!-- {{ $data }}    -->
        <!--==============================header=================================-->
        <form action="" method="post" enctype="multipart/form-data" name="form">
            
            <!--==============================Content=================================-->
				<div class="content">
				  <div class="title">Users List</div>
					<div class="container_12">
						<div class="grid_12">
						<div align="right"><!--<a href="CreateUser.php">AddNew&nbsp;&nbsp;</a>&nbsp;--></div>
							<blockquote class="bq1" style="overflow-x:auto">
								<div class="container" align="center" >
								
								
									<table class="table-bordered table1" align="center" id="dataTable">
									<thead>
										<tr>
											<th>&nbsp;</th>
											<th>IC No.</th>
											<th>Staff Name</th>
											<th>User Name</th>
											<th>Designation</th>
											<th>Intercom No.</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									@if(isset($data))
										@foreach($data as $UserList)
											<tr>
												<td align="center">
												<img class="fancybox" title="" src="uploads/" width="30px" height="25px"/>
												</td>
												<td align="center">{{$UserList['staffid'] }}</td>
												<td align="left">{{ $UserList['username'] }}</td>
												<td align="left">{{ $UserList['username'] }}</td>
												<td align="center">{{ $UserList['email'] }}</td>
												<td align="center">{{ $UserList['email'] }}</td>
												<td align="center">
													&nbsp;&nbsp;
													<a href="CreateUser.php?userid="  class="oval-btn-edit">Edit
													</a>
													&nbsp;|&nbsp;
													<a href="javascript:Delete()"  class="oval-btn-delete">
														Delete
													</a>
												&nbsp;|&nbsp;
												<a href="javascript:ResetUser()"  class="oval-btn-edit">
														Reset Password
												</a>
												</td>
											</tr>
										@endforeach
									@endif
									</tbody>
								</table>
								<input type="hidden" name="hid_delete_flag" id="hid_delete_flag">
									</div>
									@php $AddUrl = 'admin.createuser'; @endphp
									<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
										<div class="buttonsection"><input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/></div>
										<div class="buttonsection"><input type="button" class="backbutton" name="AddNew" id="AddNew" value="AddNew" onClick="window.location='{{ route($AddUrl) }}'"/></div>
	
										
									</div>
							</blockquote>
						</div>
	
					</div>
				</div>
			
            <!--==============================footer=================================-->
<script>
	$(document).ready(function() {
		$('#dataTable').DataTable({
			responsive: true,
			paging: true, 
		});
	});
</script>
@endsection	
			