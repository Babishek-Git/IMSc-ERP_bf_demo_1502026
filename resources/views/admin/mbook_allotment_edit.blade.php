@extends('layouts.dashboard-master')
	
@section('content')
 <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
    <form action="" method="post" enctype="multipart/form-data" name="phuploader">
		<div class="content">
    		<div class="title">Staff - Wise MBook Allotment List</div>
          	<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
              		<div align="right"><a href="MBookAllotment.php?" >AddNew</a>&nbsp;&nbsp;</div>
                    	<div class="container" align="center" >
							<table width="99%" class="table1 table2" id="example">
								<thead>
									<tr>
										<th>S.No</th>
										<th>Work Order No.</th>
										<th>Work Name</th>
										<th>Engineer Name</th>
										<th>General MBook</th>
										<th>Steel MBook</th>
										<th>Abstract MBook</th>
										<th>Escalation MBook</th>
										<th>Operation</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td align="center"></td>
										<td align="center"></td>
										<td></td>
										<td nowrap="nowrap"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center">
											<a href='MBookAllotmentEditPage.php?sheetid=&staffid='  class="oval-btn-delete">Remove</a>
										</td>
									</tr>
									<tr><td colspan="9">No Records Found</td></tr>
								</tbody>
							</table>
						</div>
						<table width="100%">
							<tr>
								<td align="center">&nbsp;</td>
							</tr>
							<tr>
								<td align="center">
										<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
								</td>
							</tr>
						</table>
						<div class="smediv"></div>
				  	</blockquote>
				</div>
			</div>
   		</div>
        </form>
    </body>
</html>
@endsection