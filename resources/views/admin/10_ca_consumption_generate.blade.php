@extends('layouts.dashboard-master')
@section('content') 
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
    <form action="PriceBidUpload.php" method="post" enctype="multipart/form-data" name="form">
        <div class="content">
            <div class="title">10CA - Consumption</div>
                <div class="container_12">
                    <div class="grid_12">
                        <blockquote class="bq1" style="overflow:auto">
							<!--<div align="right">
								<font style="font-size:12px; font-weight:bold; color:#0066FF">
									Upload File Format :&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="" onClick="OpenInNewTabWinBrowser('AgreementUpload_File_Sample.php');"><u>Agreement Sheet</u>&nbsp;&nbsp;&nbsp;&nbsp;</a>
								</font>
							</div>-->
							<div class="container">
								<div class="row ">
									<div class="div2">&nbsp;</div>
									<div class="div8">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">10 CA Material Consumption Generate</div></div></div>
										<div class="row innerdiv">
											<div class="row">
												<div class="div4">
													<label for="fname">Work Short Name</label>
												</div>
												<div class="div8">
													<select id="cmb_shortname" name="cmb_shortname" class="tboxclass" onChange="workorderdetail();">
														<option value="">--------------- Select --------------- </option>
													</select>
												</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">Work Order No.</label>
												</div>
												<div class="div8">
													<input type="text" name='txt_workorder' id='txt_workorder' class="DispSelectBox" readonly="" value="">
												</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">Material</label>
												</div>
												<div class="div3">
													<select name="cmb_material_type" id="cmb_material_type" class="DispSelectBox">
														<option value=""> ---- Select ------</option>
													</select>
												</div>
												<div class="div5" align="left">&nbsp;</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">Year</label>
												</div>
												<div class="div3">
													<select name="cmb_year" id="cmb_year" class="DispSelectBox">
														<option value=""> ---- Select ------</option>
													</select>
												</div>
												<div class="div5" align="left">&nbsp;</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">Month</label>
												</div>
												<div class="div3">
													<select name="cmb_month" id="cmb_month" class="DispSelectBox">
														<option value=""> ---- Select ------</option>
													</select>
												</div>
												<div class="div5" align="left">&nbsp;</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">MBook No.</label>
												</div>
												<div class="div3">
													<select name="cmb_mbookno" id="cmb_mbookno" class="DispSelectBox">
														<option value=""> ---- Select ------</option>
													</select>
												</div>
												<div class="div5" align="left">&nbsp;</div>
											</div>
											<div class="smediv">&nbsp;</div>
										</div>
										<div class="smediv">&nbsp;</div>
									</div>
									<div class="div2">&nbsp;</div>
								</div>
								<div class="row">
									<div class="div12" align="center">
										<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
										<input type="submit" class="btn" data-type="submit" name="generate" id="generate" value="Generate" />
									</div>
								</div>                           
                            </div>
                        </blockquote>
                    </div>
                </div>
            </div>
    </body>
</html>
@endsection
