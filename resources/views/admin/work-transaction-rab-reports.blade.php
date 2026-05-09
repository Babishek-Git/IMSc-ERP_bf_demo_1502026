@include('layouts.header')
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
          @include('admin.menu')
        <!--==============================Content=================================-->
        <div class="content">
            <div class="title">RAB Transaction Details</div>
            <div class="container_12">
                <div class="grid_12">
                    <blockquote class="bq1" style="overflow:auto"> 
                        <form name="form" method="post" action="">
                            <div class="container">
								<div class="row ">
									<div class="div1">&nbsp;</div>
									
									<div class="div10">
										<!--<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead rep-divhead" align="center">Work Details</div></div></div>
										<div class="row innerdiv">-->
											<div class="row">
												<div class="div12" style="margin-top:0px">
													<label for="fname" style="padding:0px">Name of Work&emsp;&emsp;: </label> <font class="rep-top-cont"> CCNO :  - </font>
												</div>
											</div>
											<div class="smline"></div>
											<div class="row">
												<div class="div12" style="margin-top:3px">
													<label for="fname" style="padding:0px">Contractor Name : </label> <font class="rep-top-cont"></font>
													&emsp;
													<label for="fname" style="padding:0px">Work Order Date : </label> <font class="rep-top-cont"></font>
													&emsp;
													<label for="fname" style="padding:0px">Schedule Comp. Date : </label> <font class="rep-top-cont"></font>
												</div>
											</div>
											<div class="row">
												<div class="div12" align="center" style="margin-top:0px;">
													<div class="innerdiv2">
														<div class="row divhead rep-divhead" align="left">&nbsp;RAB Transaction</div>
														<div class="row innerdiv" align="center" style="padding-top:0px;">
															<table class="table-bordered table1" align="center" id="dataTable">
															<thead>
																<tr>
																	<th>S.No.</th>
																	<th style="text-align:left !important">&nbsp;Work Transaction Description</th>
																	<th>Transaction Date</th>
																</tr>
															</thead>
															<tbody>
															</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										<!--</div>-->
									</div>
								  	<div class="div1">&nbsp;</div>
								</div>
							</div>
							<div class="smediv"></div>
							<div class="row">
								<div class="div12" align="center">
									<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
								</div>
								<div class="smediv">&nbsp;</div>
							</div>
                        </form>
                    </blockquote>
                </div>
            </div>
        </div>
         <!--==============================footer=================================-->
		@include('layouts.footer')
    </body>
</html>

