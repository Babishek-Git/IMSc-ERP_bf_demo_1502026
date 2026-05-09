@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.header')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
    <form action="" method="post" enctype="multipart/form-data" name="form">
		@include('admin.menu')
            <!--==============================Content=================================-->
		<div class="content">
			<div class="title">Dashboard</div>
			<div class="container_12">
				<div class="grid_12" align="center">
					<blockquote class="bq1" style="overflow:auto">
						<div class="grid_12 no-padding-lr">&nbsp;</div>
						<div class="grid_4 no-padding-lr">
							<div class="grid_12" align="center">
								<div class="panel panel-body border no-padding-lr">
									<div class="client-title">
										Notifications & Alerts<br/><br/>
									</div>
									<!--<div class="client"><span class="logo"><br/>DEALING ASSISTANT</span></div>
									<div class="client"><span class="logo"><br/>ACCOUNTANT</span></div>
									<div class="client"><span class="logo"><br/>ASSISTANT ACCOUNTS OFFICER</span></div>
									<div class="client"><span class="logo"><br/>ACCOUNTS OFFICER</span></div>
									<div class="client"><span class="logo"><br/>DEPUTY CONTROLLER OF ACCOUNTS</span></div>-->
									<div class="well">
										<a href="RABStatusAccounts.php">
											<div class="box1 box2 shadow1">
												<div class="grid_2" align="center">
													<div class="circle1"></div>
												</div>
												 <div class="grid_10" align="left">
													<span style="margin-top:25px; line-height:30px;">MBook / Bill Status</span>
												 </div>
											</div>
										</a>
										<a href="javascript:void(0)" id="mb_waiting_list">
											<div class="box1 shadow1">
												<div class="grid_2" align="center">
											  		<div class="circle1"></div>
											 	</div>
											 	<div class="grid_10" align="left">
											  		<span style="margin-top:25px; line-height:30px;">Mbooks Waiting List - nos.</span>
											  	</div>
											</div>
											</a>
											<a href="MeasurementBookPrint_staff_Accounts.php?view=r">
												<div class="box1 shadow1">
													<div class="grid_2" align="center">
														<div class="circle1"></div>
													</div>
													<div class="grid_10" align="left">
														<span style="margin-top:25px; line-height:30px;">Mbook Returned to Civil - nos.</span>
													</div>
												</div>
											</a>
											<a href="PGEntryViewAccounts.php">
												<div class="box1 shadow1">
													<div class="grid_2" align="center">
														<div class="circle1"></div>
													</div>
													<div class="grid_10" align="left">
														<span style="margin-top:25px; line-height:30px;">PG Release List -  nos.</span>
													</div>
												</div>
											</a>
											<div class="box1 shadow1">
												<div class="grid_2" align="center">
											  		<div class="circle1"></div>
											 	</div>
											 	<div class="grid_10" align="left">
											  		<span style="margin-top:25px; line-height:30px;">Security Deposit Release List nos.</span>
											  	</div>
											</div>
											<div class="box1 shadow1">
												<!--<div class="circle1" style="left:5px; top:5px; left:5px; right:5px; float:right; margin-top:-19px; margin-right:-4px; background-color:#FF0000; color:#FFFFFF">dfdf</div>-->
												<div class="grid_2" align="center">
											  		<div class="circle1"></div>
											 	</div>
											 	<div class="grid_10" align="left">
											  		<span style="margin-top:25px; line-height:30px;">Mobilization Advance Release List nos.</span>
											  	</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="grid_3 no-padding-lr">
								<div class="grid_12" align="center">
									<div class="panel panel-body border no-padding-lr">
										<div class="client-title">
											Working Arrangements in Accounts <br/>Division w.e.f.  08.09.2016<br/>
										</div>
										<div class="well">
											<div class="well-content well-content-head">RA Bills</div>
											<div class="well-content">Dealing Assistant</div>
											<div class="well-content">Accountant</div>
											<div class="well-content">AAO - Upto <i class="fa fa-inr" aria-hidden="true" style="padding-top:5px;"></i> 25.00 Lakhs</div>
											<div class="well-content">AO - Above <i class="fa fa-inr" aria-hidden="true" style="padding-top:5px;"></i> 25.00 & Upto <i class="fa fa-inr" aria-hidden="true" style="padding-top:5px;"></i> 50.00 Lakhs</div>
											<div class="well-content">DCA - Above <i class="fa fa-inr" aria-hidden="true" style="padding-top:5px;"></i> 50.00 Lakhs</div>
										</div>
										<div class="well">
											<div class="well-content well-content-head">Final Bills</div>
											<div class="well-content">Dealing Assistant</div>
											<div class="well-content">Accountant</div>
											<div class="well-content">AAO - Upto <i class="fa fa-inr" aria-hidden="true" style="padding-top:5px;"></i> 15.00 Lakhs</div>
											<div class="well-content">AO - Above <i class="fa fa-inr" aria-hidden="true" style="padding-top:5px;"></i> 15.00 & Upto <i class="fa fa-inr" aria-hidden="true" style="padding-top:5px;"></i> 25.00 Lakhs</div>
											<div class="well-content">DCA - Above <i class="fa fa-inr" aria-hidden="true" style="padding-top:5px;"></i> 25.00 Lakhs</div>
										</div>
									</div>
								</div>
							</div>
							<div class="grid_5 no-padding-lr">
								<div class="grid_12" align="center">
									<div class="panel panel-body border">
										<div class="client-title">
											MBOOK Verified Chart for the Year of 
										</div>
										<div class="well" id="chartdiv" style="margin:0px; margin-top:25px;"></div>
									</div>
								</div>
							</div>
						</blockquote>
					</div>
				</div>
			</div>
			<div style="display:none" id="mb_waiting_list_modal">
				<a href="MeasurementBookPrint_staff_Accounts.php" class="active-well"><div class="well"><div class="well-content2"><i style="font-size:24px" class="fa">&#xf058;</i> MBooks waiting in <?php //echo $LevelName; ?> level <span class="badge badge-danger"><?php //echo $MBCount; ?> nos.</span></div></div></a>
				<div class="well"><div class="well-content2"><i style="font-size:24px; color:#CDCDCD" class="fa">&#xf058;</i> MBooks waiting in <?php //echo $LevelName; ?> level <span class="badge badge-danger"><?php //echo $MBCount; ?> nos.</span></div></div>
				<div class="well"><div class="well-content2">No MBook Waiting for Accounts Approval</div></div>
			</div>
            <!--==============================footer=================================-->
           @include('layouts.footer')
            <!--<script src="js/jquery.hoverdir.js"></script>-->
        </form>
    </body>
</html>