@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.library.common')
@include('layouts.library.binddata') 
@include('layouts.header')
 <body  class="page1" id="top" oncontextmenu="return false" onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
        <form action="" method="post" name="form">
            @include('admin.menu')
            <!--==============================Content=================================-->
            <div class="content">
                <div class="title">View Measurement Entry List</div>
                <div class="container_12">
                    <div class="grid_12" align="center">
                        <blockquote class="bq1" style="overflow:auto;">
							<div align="right" style="color:#0000cd; font-weight:bold; font-size:11px; width:90%; font-family: verdana;"><b> <font color="#E6061D" style="font-size:12px; font-weight:bold;">*</font> To Edit click Item No. &nbsp; &nbsp;&nbsp;</b></div>
                            <div class="container" >
							
                                    <div class="heading">
											<div class="col labelcontenthead"><input type="checkbox" name="check_all" id="check_all"></div>
                                      		<div class="col labelcontenthead">S.No.</div>
                                            <div class="col labelcontenthead">Date</div>
                                            <div class="col labelcontenthead">Item</div>
                                            <div class="col labelcontenthead" style=" width: 40%;">Description</div>
                                            <div class="col labelcontenthead">Dia</div>
                                            <div class="col labelcontenthead">No</div>
											<div class="col labelcontenthead">No</div>
                                            <div class="col labelcontenthead">Length</div>
                                            <div class="col labelcontenthead" style=" line-height: 90%;">Contents<br/>of<br/>Area</div>
                                            <div class="col labelcontenthead">Unit</div>
                                    </div>
                                    <!--<div class="table-row">
                                            <div class="col"></div>
                                            <div class="col"></div>
                                            <div class="col"></div>
                                            <div class="col"></div>
                                            <div class="col"></div>
											<div class="col"></div>
                                            <div class="col"></div>
                                            <div class="col"></div>
                                            <div class="col"></div>
                                            <div class="col"></div>
											<div class="col"></div>
                                    </div>-->
	
									<div class="heading">
											<div class="col labelcontenthead"><input type="checkbox" name="check_all" id="check_all"></div>
                                      		<div class="col labelcontenthead">S.No.</div>
                                            <div class="col labelcontenthead">Date</div>
                                            <div class="col labelcontenthead">Item No</div>
                                            <div class="col labelcontenthead" style=" width: 40%;">Description</div>
                                            <div class="col labelcontenthead">No</div>
                                            <div class="col labelcontenthead">Length</div>
                                            <div class="col labelcontenthead">Breadth</div>
                                            <div class="col labelcontenthead">Depth</div>
                                            <div class="col labelcontenthead" style=" line-height: 90%;">Contents<br/>of<br/>Area</div>
                                            <div class="col labelcontenthead">Unit</div>
                                    </div>
                                   <!-- <div class="table-row">
                                            <div class="col"></div>
                                            <div class="col"></div>
                                            <div class="col"></div>
                                            <div class="col"></div>
                                            <div class="col"></div>
                                            <div class="col"></div>
                                            <div class="col"></div>
                                            <div class="col"></div>
                                            <div class="col"></div>
                                            <div class="col"></div>
											<div class="col"></div>
                                    </div>-->
											<div class="table-row">
											<div class="col labelhead" style="text-align:center">
												<input type="checkbox" class="chbox-style" name="ch_deleteid[]" id="ch_deleteid" value="" /> 
															
															</div>
															<div class="col labelhead" style="text-align:center">
															<!--<input type="checkbox" class="chbox-style" name="ch_deleteid[]" id="ch_deleteid" value=""/>-->
															
															</div>
															<div class="col labelhead" style="text-align:center"></div>
															<div class="col labelhead" style="width:80px; color:#0000cd; text-align:center;">
															
																<a href="Measurement_Edit.php?mbdetail_id=&type=S&sheetid=" class="tooltip" title="Click here to edit" ><u></u> 
																</a>
															
																<a class="tooltip" title="Previous RAB Measurements. Unable to Edit."> 
																</a>
															
															</div>
															<div class="col labelhead"></div>
															<div class="col labelhead" style="text-align:center"></div>
															<div class="col labelhead" style="text-align:center"></div>
															<div class="col labelhead" style="text-align:center"></div>
															<div class="col labelhead" style="text-align:right"></div>
															<div class="col labelhead" style="text-align:right"></div>
															<div class="col labelhead" style="text-align:center"></div>
													</div>
													<div class="table-row">
															<div class="col labelhead" style="text-align:center">
															<input type="checkbox" class="chbox-style" name="ch_deleteid[]" id="ch_deleteid" value="" />
															</div>
															<div class="col labelhead" style="text-align:center">
															<!--<input type="checkbox" class="chbox-style" name="ch_deleteid[]" id="ch_deleteid" value=""/>-->
															
															</div>
															<div class="col labelhead" style="text-align:center"></div>
															<div class="col labelhead" style="width:80px; color:#0000cd; text-align:center;">
															
																<a href="Measurement_Edit.php?mbdetail_id=&type=G&sheetid=" class="tooltip" title="Click here to edit" ><u></u> 
																</a>
															
																<a class="tooltip" title="Measurements already generated for this date. Unable to Edit."> 
																</a>
															
															</div> 
															<div class="col labelhead"></div>
															<div class="col labelhead" style="text-align:center"></div>
															<div class="col labelhead" style="text-align:right"></div>
															<div class="col labelhead" style="text-align:right"></div>
															<div class="col labelhead" style="text-align:right"></div>
															<div class="col labelhead" style="text-align:right"></div>
															<div class="col labelhead" style="text-align:center"></div>
													</div>
												</div>
										<div class="col2">
      
                            </div>
							<input type="hidden" name="txt_measurementtype" id="txt_measurementtype" value="">
							<!--<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
								<div class="buttonsection">
								<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
								</div>
								
								<div class="buttonsection">
								<input type="submit" name="edit" id="edit" value=" Edit " />
								</div>
							
								<div class="buttonsection">
								<input type="submit" name="delete" id="delete" value=" Delete " />
								</div>
								
							</div>-->
							
							<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
								<div class="buttonsection">
								<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
								</div>
								<div class="buttonsection">
								<input type="button" class="backbutton" name="btn_edit" id="btn_edit" value=" Edit " />
								</div>
								<div class="buttonsection">
								<input type="button" class="backbutton" name="btn_delete" id="btn_delete" value=" Delete " />
								</div>
							</div>
							<div id="basic-modal-content1" style="display:none">
								<div align="center" class="popuptitle gradientbgR">Delete Measurements Instructions</div>
								<div align="center" style="padding-top:10px;">
									<table class="table2" width="99%" cellpadding="3" cellspacing="3" id="table1">
										<tr><td align="left"> Are you sure want to DELETE selected Measurement/s.</td></tr>
										
										<tr><td align="left"> Already MBook Generated for this Measurement/s. If you DELETE once again need to generate MBook, Sub-Abstract and Abstract.</td></tr>
										<tr><td align="center">If you want to DELETE Click Confirm or CLick Cancel to exit.</td></tr>
									</table>
								</div>
								<div class="bottomsection" align="center">
									<div class="buttonsection" align="center"><input type="submit" name="confirm_delete" id="confirm_delete" value=" Confirm "/></div>
									<div class="buttonsection" align="center"><input type="submit" name="cancel_delete" id="cancel_delete" value=" Cancel "/></div>
								</div>
							</div>	
							
							<div id="basic-modal-content2" style="display:none">
								<div align="center" class="popuptitle gradientbgB">Edit Measurements Instructions</div>
								<div align="center" style="padding-top:10px;">
									<table class="table2" width="99%" cellpadding="3" cellspacing="3" id="table2">
										<tr><td align="left"> Are you sure want to EDIT selected Measurement/s.</td></tr>
										<tr><td align="left"> Already MBook Generated for this Measurement/s. If you EDIT once again need to generate MBook, Sub-Abstract and Abstract.</td></tr>
										<tr><td align="center">If you want to EDIT Click Confirm or CLick Cancel to exit.</td></tr>
						
									</table>
								</div>
								<div class="bottomsection" align="center">
									<div class="buttonsection" align="center"><input type="submit" name="confirm_edit" id="confirm_edit" value=" Confirm "/></div>
									<div class="buttonsection" align="center"><input type="submit" name="cancel_edit" id="cancel_edit" value=" Cancel "/></div>
								</div>
							</div>
							
							
							<div id="basic-modal-content3" style="display:none">
								<div align="center" class="popuptitle gradientbgB">Edit Measurements Instructions</div>
								<div align="center" style="padding-top:10px;">
									<table class="table2" width="99%" cellpadding="3" cellspacing="3" id="table3">
										<tr><td align="left"> Are you sure want to EDIT selected Measurement/s.</td></tr>
										<tr><td align="left"> Already MBook Generated for this Measurement/s. If you EDIT once again need to generate MBook, Sub-Abstract and Abstract.</td></tr>
										<tr><td align="center">If you want to EDIT Click Confirm or CLick Cancel to exit.</td></tr>
									</table>
								</div>
								<div class="bottomsection" align="center">
									<div class="buttonsection" align="center"><input type="button" class="backbutton" name="btn_confirm" id="btn_confirm" value=" Confirm "/></div>
									<div class="buttonsection" align="center"><input type="button" class="backbutton" name="btn_cancel" id="btn_cancel" value=" Cancel "/></div>
								</div>
								<input type="hidden" name="txt_edit_url" id="txt_edit_url">
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
