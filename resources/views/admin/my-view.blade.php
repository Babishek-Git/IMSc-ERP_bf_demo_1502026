@include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.library.common')
@include('layouts.header')
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
        <form action="" method="post" enctype="multipart/form-data" name="form">
            @include('admin.menu') 
            <!--==============================Content=================================-->
			<div class="content">
				<div class="title">My View</div>
				<div class="container_12">
					<div class="grid_12" align="center">
						<blockquote class="bq1" style="overflow:auto; padding-left:10px; padding-right:10px">
							<div align="center">
								<div class="col-md-12 no-padding-lr" align="center">&nbsp;</div>
								<!--<div class="col-md-2 no-padding-lr" align="center">&nbsp;</div>-->
								<div class="col-md-12 no-padding-lr" align="center">
									<!--<div class="col-status" data-url=''><div class="well well-sm well-A active"><span class="rlable-pink">Check Measurements List</span></div></div>-->
									<div class="col-status" data-url='CurrentRabStatusList'><div class="well well-sm well-A"><span class="rlable-pink">My Works</span></div></div>
									<div class="col-status" data-url='MyViewWorks'><div class="well well-sm well-A"><span class="rlable-pink">Total Work List</span></div></div>
									<div class="col-status" data-url='CommanWorkDetails'><div class="well well-sm well-A"><span class="rlable-pink">Work Report</span></div></div>
									<div class="col-status" data-url='RABStatusTableCivil'><div class="well well-sm well-A"><span class="rlable-pink">Accounts All Bill Status</span></div></div>
									<div class="col-status" data-url='RABStatusCivil'><div class="well well-sm well-A"><span class="rlable-pink">Bill / MBook Accounts Status</span></div></div>
									<div class="col-status" data-url='PassOrderStatusCivil'><div class="well well-sm well-A"><span class="rlable-pink">Pass Order Notification List</span></div></div>
									<!--<div class="col-status" data-url='PassOrderStatusCivil'><div class="well well-sm well-A"><span class="rlable-pink">Graphical Representation</span></div></div>-->
								</div>
								<!--<div class="col-md-2 no-padding-lr" align="center">&nbsp;</div>-->
								<div></div>
								<table border="0" align="center" class="table table-bordered">
									<tr class="note" style="background-color:#0270BD;"><!--035a85-->
										<th class="" colspan="3">Check Measurement Notification &nbsp; <!--<img src="images/new1.gif" width="50" height="50">--></th>
									</tr>
									<tr>
										<td></td>
										<td> - <a href="CheckMeasurementTransaction.php?sheetid=&rbn=&Page=MyView" style="text-decoration:none; color:#DE013E"></a></td>
										<td></td>
									</tr>
									<tr><td align="center">No Records Found</td></tr>
								</table>
								<div></div>
								<table border="0" align="center" class="table table-bordered">
									<tr class="note" style="background-color:#0270BD;"><!--035a85-->
										<th class="" colspan="6">Accounts Returned Mbook - Notification &nbsp; <!--<img src="images/new1.gif" width="50" height="50">--></th>
									</tr>
									<tr>
										<td style="vertical-align:middle"></td>
										<td style="vertical-align:middle"> :<td>
										<td style="vertical-align:middle" nowrap="nowrap"></td>
										<td style="vertical-align:middle" nowrap="nowrap">
											<select name="cmb_forward_staff" id="cmb_forward_staff" class="textboxdisplay FWStaff" style="width:200px"  disabled="disabled" >
												<option value=""> ---Forward To--- </option>
												<option value="">  </option>
											</select>
										</td>
										<td style="vertical-align:middle">
											<a class="btn4 btn4-default btn4-smbtn3 btn3-default btn3-sm forward" data-sheetid="" data-rbn="" >
												<i class="fa fa-check-circle" style="font-size:15px;"></i>
												FORWARD
											</a>
										</td>
									</tr>
									<tr><td align="center" colspan="5">No Records Found</td></tr>
								</table>
								<br/>
							</div>
						</blockquote>
					</div>
				</div>
			</div>
            <!--==============================footer=================================-->
           @include('layouts.footer')
        </form>
    </body>
</html>
