@include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.library.binddata') 
@include('layouts.library.spreadsheet-reader')
@include('layouts.header')
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <form action="PriceBidUpload.php" method="post" enctype="multipart/form-data" name="form">
           @include('admin.menu')
            <div class="content">
                <div class="title">Price Bid Upload</div>
                <div class="container_12">
                    <div class="grid_12">
                        <blockquote class="bq1" style="overflow:auto">
							<div class="container">
								<div class="row ">
									<div class="div2">&nbsp;</div>
									<div class="div8">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Bidder's Price Bid Upoad</div></div></div>
										<div class="row innerdiv">
											<div class="row">
												<div class="div4">
													<label for="fname">Estimate Name</label>
												</div>
												<div class="div8">
													<select id="cmb_shortname" name="cmb_shortname" class="tboxclass">
														<option value="">--------------- Select --------------- </option>
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
											<div class="row">
												<div class="div4">
													<label for="fname">Sheet Name</label>
												</div>
												<div class="div3">
													<input type="text" name='txt_sheetname' id='txt_sheetname' class="tboxclass">
												</div>
												<div class="div5" align="left">
													&nbsp;&nbsp;<i class="fa fa-info-circle" aria-hidden="true" style="padding-top:3px; color:#0078F0; cursor:pointer; font-size:25px" id="sheet_name_info" title="Click here to View Sample"></i>
												</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">Starting Row</label>
												</div>
												<div class="div3">
													<input type="text" name='txt_start_row' id='txt_start_row' class="tboxclass">
												</div>
												<div class="div5" align="left">&nbsp;</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">Ending Row</label>
												</div>
												<div class="div3">
													<input type="text" name='txt_end_row' id='txt_end_row' class="tboxclass">
												</div>
												<div class="div5" align="left">&nbsp;</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">Upload File</label>
												</div>
												<div class="div8">
													<input type="file" class="text" name="file" id="file" size="44" style="height:23px;" />
												</div>
											</div>
											<div class="row">
												<div class="div4">&nbsp;</div>
												<div class="div8 smalllabcss">
													File should be in the formats of : .xls , .xlsx
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
										<input type="submit" class="btn" data-type="submit" name="upload" id="upload" value="Upload File" />
										<!--<input type="button" class="backbutton" name="View" id="View" value="View" onClick="View_page();"/>-->
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


