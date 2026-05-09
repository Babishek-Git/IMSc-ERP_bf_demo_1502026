@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.library.binddata') 
@include('layouts.library.common')
@include('layouts.header')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="" method="post" enctype="multipart/form-data" name="phuploader">
		@include('admin.menu')
		<div class="content">
			<div class="title">My Works</div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container" align="center">
							<table class="table-bordered table1" align="center" id="dataTable">
								<thead>
									<tr>
										<th align="center" valign="middle">SlNo.</th>
										<th align="left" valign="middle" nowrap="nowrap">Pin No.</th>
										<th align="center" valign="middle" nowrap="nowrap">CC No.</th>
										<th align="left" valign="middle">WO No.</th>
										<th align="center" valign="middle" style="width:15%">Name Of Work</th>
										<th align="center" valign="middle" nowrap="nowrap">Cost of Work &#x20B9;</th>
										<th align="center" valign="middle" nowrap="nowrap">Contractor Name</th>
										<th align="center" valign="middle" nowrap="nowrap">Work Commence Date</th>
										<th align="center" valign="middle" nowrap="nowrap">Schedule D.O.C</th>
										<th align="center" valign="middle" nowrap="nowrap">Work Duration</th>
										<th align="center" valign="middle">Current RAB</th>
										<!--<th align="center" valign="middle">Status</th>-->
									</tr>
								</thead>
								<tbody>
									<tr>
										<td align="center"></td>
										<td align="left"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="left" valign="middle" style="text-align: justify; text-justify: inter-word; width:15%"></td>
										<td align="right" valign="middle"></td>
										<td align="left" valign="middle" style="text-align: justify; text-justify: inter-word;"></td>
										<td align="center" valign="middle"></td>
										<td align="center" valign="middle"></td>
										<td align="center" valign="middle"></td>
										<td align="center" style="width:12%;"></td>
										<!--<td align="center" style="width:10%;" nowrap="nowrap">
									       <a href="CurrentRabStatus.php?SheetId=&&CRBN=" class="circle">View Status</a>
										</td>-->
									</tr>
								</tbody>
							</table>
						</div>
						<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
							<div class="buttonsection"><input type="button" name="back" id="back" value="Back" class="backbutton"></div>
						</div>
					</blockquote>
				</div>
			</div>
		</div>
		@include('layouts.footer')
	</form>
</body>
</html>