@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.library.binddata') 
@include('layouts.library.common')
@include('layouts.library.sysdate')
@include('layouts.header')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
        <form action="" method="post" enctype="multipart/form-data" name="phuploader">
             @include('admin.menu')
            <!--==============================Content=================================-->
            <div class="content">
               <div class="title">View Measurement Entry List</div>
                <div class="container_12">
                    <div class="grid_12" align="center">
					<!--<div align="right" style="color:#0000cd; font-weight:bold; font-size:13px; width:90%"><b> <font color="#E6061D" style="font-size:20px; font-weight:bold;">*</font> To Edit click Item No. &nbsp; &nbsp;&nbsp;</b></div>-->
                        <blockquote class="bq1" style="overflow:auto;">
                            <div class="container" >
								<table id="example" class="display" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th><input type="checkbox" name="check_all" id="check_all"></th>
											<th>S.No.</th>
											<th>Date</th>
											<th nowrap="nowrap">Item No</th>
											<th>Description</th>
											<th>Dia</th>
											<th>No</th>
											<th>No</th>
											<th>Length</th>
											<th nowrap="nowrap">Contents of Area</th>
											<th>Unit</th>
										</tr>
									</thead><tbody>
                                    <!--<div class="heading">
											<div class="col labelcontenthead"><input type="checkbox" name="check_all" id="check_all" <?php //echo ModuleRights('MSTD'); ?>></div>
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
                                    </div>-->
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
								<table id="example" class="display" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th><input type="checkbox" name="check_all" id="check_all"></th>
											<th>S.No.</th>
											<th>Date</th>
											<th nowrap="nowrap">Item No</th>
											<th>Description</th>
											<th>No</th>
											<th>Length</th>
											<th>Breadth</th>
											<th>Depth</th>
											<th nowrap="nowrap">Contents of Area</th>
											<th>Unit</th>
										</tr>
									</thead><tbody>
									<!--<div class="heading">
											<div class="col labelcontenthead"><input type="checkbox" name="check_all" id="check_all" ></div>
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
                                    </div>-->
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
													</div>-->
            											<tr>
															<td>
															<input type="checkbox" class="chbox-style" name="ch_deleteid[]" id="ch_deleteid" value=""  />
															</td>
															<td></td>
															<td></td>
															<td>
																<a href="Measurement_Edit.php?mbdetail_id=&type=S&sheetid=" class="tooltip" title="Click here to edit" ><u></u> 
																</a>
				
																<a class="tooltip" title="Measurements already generated for this date. Unable to Edit."> 
																</a>
															</td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
														</tr>
													<!--<div class="table-row">
															<div class="col labelhead" style="text-align:center">
															<input type="checkbox" class="chbox-style" name="ch_deleteid[]" id="ch_deleteid" value="" />
															</div>
															<div class="col labelhead" style="text-align:center">
															</div>
															<div class="col labelhead" style="text-align:center"></div>
															<div class="col labelhead" style="width:80px; color:#0000cd; text-align:center;">
																<a href="Measurement_Edit.php?mbdetail_id=&type=S&sheetid=" class="tooltip" title="Click here to edit" ><u></u> 
																</a>
																<a class="tooltip" title="Measurements already generated for this date. Unable to Edit."><?php //echo $List->subdiv_name; ?> 
																</a>
															</div>
															<div class="col labelhead"></div>
															<div class="col labelhead" style="text-align:center"></div>
															<div class="col labelhead" style="text-align:center"></div>
															<div class="col labelhead" style="text-align:center"></div>
															<div class="col labelhead" style="text-align:right"></div>
															<div class="col labelhead" style="text-align:right"></div>
															<div class="col labelhead" style="text-align:center"></div>
													</div>-->
														<tr>
															<td>
															<input type="checkbox" class="chbox-style" name="ch_deleteid[]" id="ch_deleteid" value=""  />
						
															</td>
															<td></td>
															<td></td>
															<td>
																<a href="Measurement_Edit.php?mbdetail_id=&type=G&sheetid=" class="tooltip" title="Click here to edit" ><u></u> 
																</a>
																<a class="tooltip" title="Measurements already generated for this date. Unable to Edit."> 
																</a>
															</td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
														</tr>
													<!--<div class="table-row">
															<div class="col labelhead" style="text-align:center">
															<input type="checkbox" class="chbox-style" name="ch_deleteid[]" id="ch_deleteid" value=""  />
															</div>
															<div class="col labelhead" style="text-align:center">
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
													</div>-->
												
									</tbody>
								</table>
                            </div>
                            <div class="col2">
                            </div>
							<input type="hidden" name="txt_measurementtype" id="txt_measurementtype" value="">
							<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
								<div class="buttonsection">
								<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
								</div>
								<div class="buttonsection">
								<input type="submit" name="edit" id="edit" value=" Edit " />
								</div>
								<div class="buttonsection">
								<input type="submit" name="delete" id="delete" value=" Delete " />
								</div>
							</div>
                        </blockquote>
						
                        <!--<div><center>
						<table align="centre">
						<tr><td height="5px"></td></tr>
						<tr><td height="27px">
						   <input type="submit" name="back" id="back" value=" Back " />&nbsp;&nbsp;&nbsp;
						   <input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
						   <input type="submit" name="delete" id="delete" value=" Delete " />
						</td></tr>
						</table></center></div>-->  
                    </div>
                </div>
            </div>
            
             <!--==============================footer=================================-->
          @include('layouts.footer')
        </form>
    </body>
</html>
<link rel="stylesheet" type="text/css" media="screen" href="dataTable/jquery.dataTables.min.css" />
<script type="text/javascript" src="dataTable/jquery.dataTables.min.js"></script>
