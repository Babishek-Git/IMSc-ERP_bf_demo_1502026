@include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.library.binddata') 
@include('layouts.library.spreadsheet-reader')
@include('layouts.header')
 <form action="PriceBidView.php" method="post" enctype="multipart/form-data" name="form">
    @include('admin.menu')
        <div class="content">
		    <div class="title">Price Bid View</div>
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
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Bidder's Price Bid View</div></div></div>
										<div class="row innerdiv">
											<div class="row">
												<div class="div4">
													<label for="fname">Estimate Name</label>
												</div>
												<div class="div8">
													<select id="cmb_shortname" name="cmb_shortname" class="tboxclass">
														<option value="">--------------- Select --------------- </option>
														<?php echo $objBind->BindTenderEstimate('');?>
													</select>
												</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">Tender No.</label>
												</div>
												<div class="div8">
													<input type="text" name='txt_workorder' id='txt_workorder' class="tboxclass" readonly="" value="">
												</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">Bidder's Name</label>
												</div>
												<div class="div8">
													<select id="cmb_bidder" name="cmb_bidder" class="tboxclass">
														<option value="">--------------- Select --------------- </option>
													</select>
												</div>
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
										<input type="submit" class="btn" data-type="submit" name="View" id="View" value=" View " />
									</div>
								</div>                           
                            </div>
                        </blockquote>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </form>
    </body>
</html>
 

