@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.library.binddata') 
@include('layouts.library.common')
@include('layouts.library.spellnumber')
@include('layouts.header')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
  <!--==============================header=================================-->
  @include('admin.menu')
  <link rel="stylesheet" href="css/timeline.css">
  <!--==============================Content=================================-->
	<div class="content">
    	<div class="title">Page Generation for Other Supporting Statements</div>
        <div class="container_12">
        	<div class="grid_12">
            	<blockquote class="bq1" style="overflow:auto">
                	<form name="form" method="post" action="">
                    	<div class="container">
							
							<div class="container-fluid">
								<div data-wizard-init>
								  <ul class="steps">
									<li data-step="1">MBook - General</li>
									<li data-step="2">MBook - Steel</li>
									<li data-step="3" class="active">Sub Abstract</li>
									<li data-step="4">Abstract</li>
								  </ul>
								  <div class="steps-content" align="center">
									<div data-step="3">
										
										<div class="timeline__post">
											<div class="timeline__content">
												<p><span class='badge'>Name of Work</span>&nbsp; : </p>
											 </div>
										</div>
										<div class="timeline__post">
											<div class="timeline__content">
												<p><span class='badge'>Work Order No</span> : </p>
											 </div>
										</div>
										<div class="timeline__post">
											<div class="timeline__content">
												<p><span class='badge'>RAB</span>&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp; &emsp;: </p>
											 </div>
										</div>
										<div class="timeline__post">
											<!--<div class="timeline__content" style="width:40%">
												From Date
											 </div>-->
											 
											 <table width="60%">
												<tr>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
												</tr>
											 	<tr>
													<td class="labelbold">From Date</td>
													<td>
														<input type="text" name="txt_fromdate" id="txt_fromdate" class="textboxdisplay" onChange="return ValidateForm('txt_fromdate');" value=""/>
													</td>
													<td class="labelbold">To Date</td>
													<td>
														<input type="text" name="txt_todate" id="txt_todate" class="textboxdisplay" onChange="return ValidateForm('txt_todate');" value=""/>
													</td>
												</tr>
												<tr>
													<td>&nbsp;</td>
													<td id="val_fromdate" style="color:red"></td>
													<td>&nbsp;</td>
													<td id="val_todate" style="color:red"></td>
												</tr>
												<tr>
													<td class="labelbold">MBook No</td>
													<td>
														<select name="currentmbookno" id="currentmbookno" class="labeldisplay">
															<option value="">---------- Select----------</option>
														</select>
													</td>
													<td class="labelbold">MBook Page</td>
													<td>
														<input type="hidden" name="currentmbook" id="currentmbook" />
														<input type="text" name="bookpageno1" id="bookpageno1" class="textboxdisplay labeldisplay" readonly=""/>
														<input type="hidden" name="bookpageno" id="bookpageno" />
														<input type="hidden" name="count" id="count" />
														
														<input type="hidden" name="txt_sheetid" id="txt_sheetid" value="">
														<input type="hidden" name="txt_staffid" id="txt_staffid" value="">
														<input type="hidden" name="txt_rbn" id="txt_rbn" value="">
													</td>
												</tr>
												<tr>
													<td>&nbsp;</td>
													<td id="val_mbook" style="color:red">&nbsp;</td>
													<td>&nbsp;</td>
													<td id="val_mbookpage" style="color:red">&nbsp;</td>
												</tr>
												<tr>
													<td class="labelbold">Abstract MB No</td>
													<td>
														<select name="currentmbookno_abs" id="currentmbookno_abs" class="labeldisplay">
															<option value="">---------- Select----------</option>
														</select>
													</td>
													<td class="labelbold">MBook Page</td>
													<td>
														<input type="hidden" name="currentmbook_abs" id="currentmbook_abs" />
														<input type="text" name="bookpageno_abs_1" id="bookpageno_abs_1" readonly="" class="textboxdisplay"  size="15"/>
														<input type="hidden" name="bookpageno_abs" id="bookpageno_abs" />
														
														<input type="hidden" name="txt_sheetid" id="txt_sheetid" value="">
														<input type="hidden" name="txt_staffid" id="txt_staffid" value="">
														<input type="hidden" name="txt_rbn" id="txt_rbn" value="">
													</td>
												</tr>
												<tr>
													<td>&nbsp;</td>
													<td id="val_abstmbook" style="color:red">&nbsp;</td>
													<td>&nbsp;</td>
													<td id="val_abstmbookpage" style="color:red">&nbsp;</td>
												</tr>
												<tr>
													<td>&nbsp;</td>
													<td colspan="3">
													<span id="val_date" style="color:red"></span>
													<span id="check_date" style="color:red"></span>
													</td>
												</tr>
											 </table>
										</div>
									</div>
								  </div>
								</div>
							</div>
                 
     					</div>
						<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
							<div class="buttonsection">
								<!--<input type="hidden" name="txt_page" id="txt_page" value="0">-->
								<!--<input type="button" name="back" value="Back" id="back" class="backbutton" onClick="goBack();" />-->
							</div>
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

