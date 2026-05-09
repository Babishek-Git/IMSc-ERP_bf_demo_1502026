@extends('layouts.dashboard-master')
@section('content') 
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
        <form action="" method="post" enctype="multipart/form-data" name="phuploader">
            <!--==============================Content=================================-->
			<div class="content">
				<div class="title">View Designation</div>
				<input type="hidden" name="txtdescid" id="txtdescid" value=""/>
				<div class="container_12">
					<div class="grid_12" align="center">
						<blockquote class="bq1" id="bq1" style="overflow:auto">
								<table class="table-bordered table1" align="center" id="dataTable" width="85%">
									<thead>
										<tr>
											<th>SNo.</th>
											<th>Designation Name</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td align="center"></td>
											<td></td>
											<td align="center">
												
												@foreach($data as $Orders)
												{{ $Orders['dish_name'] }}
												{{ $Orders->Customers->full_name }}
												@endforeach
											</td>
										</tr>
									</tbody>
								</table>
							<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
								<div class="buttonsection"><input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/></div>
								<div class="buttonsection"><input type="button" class="backbutton" name="AddNew" id="AddNew" value="AddNew" onClick="Add_New();"/></div>
							</div>
						</blockquote>
					</div>
				</div>
			</div>
            <!--==============================footer=================================-->
        </form>
    </body>
</html>
<script>
	$(document).ready(function() {
		$('#dataTable').DataTable({
			responsive: true,
			paging: true, 
		});
	});
</script>
<style>
	.dataTables_wrapper{
		width:70% !important;
	}
</style>
@endsection	
