@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
        <form action="" method="post" enctype="multipart/form-data" name="phuploader">
             
		<div class="content">
			<div class="title">Work Extension List</div>
           <div class="container_12">
				<div class="grid_12">
                   	<!--<div align="right"><a href="AgreementMBookAllotment.php?page=engineer" >AddNew</a></div>-->
					<blockquote class="bq1" id="bq1" style="overflow:auto">
					<div class="container" align="center">
						<table width="99%" class="table1 table2" id="example">
							<thead>
								<tr>
									<th align="left">CCNO.</th>
									<th align="left">Name of Work</th>
									<th align="left">Work Order No.</th>
									<th align="left">Schedule Completion Date</th>
									<th align="left">Extension No.</th>
									<th align="left">Extension Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td rowspan="" align="center"></td>
									<td rowspan=""></td>
									<td rowspan="" align="center"></td>
									<td rowspan="" align="center"></td>
									<td align="center"></td>
									<td align="center"></td>
									<td nowrap="nowrap" align="center">
										<a class="btn3 btn3-default btn3-sm Delete" data-id='' href="WorkExtensionList.php?Extid=&ExtSid=">
											<i class="fa fa-times" style="font-size:12px; padding-top:4px"></i> Delete
										</a>
										<!--<a class="btn3 btn3-default btn3-sm Delete">
											<i class="fa fa-times" style="font-size:13px; padding-top:3px"></i> Remove
										</a>-->
										<!--<a class="btn3 btn3-default btn3-sm" style="pointer-events:none; color:#666666">
											<i class="fa fa-times" style="font-size:12px; padding-top:4px"></i> Delete
										</a>-->
									</td>
								</tr>
							</tbody>
						</table>		
                    	</div>
						<table width="100%">
							<tr>
								<td align="center">&nbsp;
									
								</td>
							</tr>
							<tr>
								<td align="center">
									<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
									<!--<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBackUser();"/>-->
								</td>
							</tr>
						</table>
						<div class="smediv"></div>
                 	</blockquote>
				</div>
            </div>
		</div>
	<link rel="stylesheet" type="text/css" media="screen" href="dataTable/jquery.dataTables.min.css" />
	<script type="text/javascript" src="dataTable/jquery.dataTables.min.js"></script>
	<script src="dataTable/dataTables.rowsGroup.js"></script>
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
