@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.library.binddata') 
@include('layouts.library.common')
@include('layouts.header')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
@include('admin.menu')
<div class="content">
	<div class="title">Check Measurements - Measurement Details</div>
	<div class="container_12">
		<div class="grid_12" align="center">
			<blockquote class="bq1" style="overflow:auto">
				<form name="form" method="post" action="">
					<div class="container">
						<div align="center">
								<div class="col-sm-12" id="divbox1">
									<a href="#demoA0" class="btn btn-info" data-toggle="collapse" style="width:92%;">
										<div class="col-sm-12" style="text-align:left; line-height:40px;">
										Name of Work : <?php echo $WorkShortName; ?>
										&emsp;<span class="rspan">RAB : </span>
										</div>
									</a>
									<span style="padding:8px;">&nbsp;</span>
								</div>
								<div class="col-sm-12">
									<!--<br/>-->
									<a href="#demo0" class="btn btn-info title btn1" data-toggle="collapse" style="width:92%;">
										<div class="col-sm-1" style="text-align:center; line-height:40px;">Item No</div>
										<div class="col-sm-5" style="line-height:40px;">
											Item Description / Shortnotes
										</div>
										<div class="col-sm-2" style="line-height:40px;text-align:right">Since Last Qty.</div>
										<div class="col-sm-1" style="line-height:40px;">Unit</div>
										<div class="col-sm-1" style="line-height:40px;">Rate (Rs)</div>
										<div class="col-sm-1" style="line-height:40px;">Amount (Rs)</div>
										<!--<div class="col-sm-2" style="text-align:center">
											<div class="col-sm-12" style="text-align:center">Status</div>
											<div class="col-sm-1">&nbsp;</div>
											<div class="col-sm-4" style="text-align:center">100%</div>
											<div class="col-sm-4" style="text-align:center">40%</div>
											<div class="col-sm-3" style="text-align:center">10%</div>
										</div>-->
										<div class="col-sm-1" style="line-height:40px;text-align:center">
											MB/Page
										</div>
									</a>
									<span class="SpanCheck"><input type="checkbox" name="ch_item_all" id="ch_item_all" ></span>
										<a href="#demo" class="btn btn-info title" data-toggle="collapse" style="width:92%;">
											<div class="col-sm-1" style="text-align:center">	
											</div>
											<div class="col-sm-5">	
											</div>
											<div class="col-sm-2" style="text-align:right"></div>
											<div class="col-sm-1"></div>
											<div class="col-sm-1"></div>
											<div class="col-sm-1" style="text-align:right"></div>
											<div class="col-sm-1">
											<!--<div class="col-sm-1">&nbsp;</div>
												<div class="col-sm-4" style="text-align:center">
													<span class="badge" style="background-color:#07A968">
														<i class="fa fa-check green" aria-hidden="true"></i>
													</span>
												</div>
											<div class="col-sm-4" style="text-align:center">
												<span class="badge" style="background-color:#f24d76">
													<i class="fa fa-times red" aria-hidden="true"></i>
												</span>
											</div>
											<div class="col-sm-3" style="text-align:center">
												<span class="badge" style="background-color:#f24d76">
													<i class="fa fa-times red" aria-hidden="true"></i>
												</span>
											</div>-->
										</div>
										</a>
										<span class="SpanCheck" >
											<input type="checkbox" name="ch_item[]" id="ch_item" class="CheckItem" value="" >
											<input type="hidden" name="txt_item_amount[]" id="txt_item_amount" value="">
											<input type="hidden" name="txt_detail_str" id="txt_detail_str" value="">
										</span>
										<div id="demo" class="collapse" style="width:100%">
											<div class="test" style="width:92%">
												<div class="col-sm-12">
													<div class="inst-content">
														<div class="commentBoxSection">
															<textarea name="txt_remarks" id="txt_remarks" rows="1" class="textboxdisplay commentBox" placeholder="Enter your remarks here"></textarea>
														<!--&nbsp;&nbsp;<input type="checkbox" name="ch_clear">&nbsp;Clear-->
														</div>
														<table class="table1" width="100%">
															<tr class="boldfont">
																<td align="center" style="background:#F0F0F0" nowrap="nowrap">Item No</td>
																<td align="center" style="background:#F0F0F0">Date</td>
																<td width="30%" style="background:#F0F0F0">Description</td>
																<td align="center" style="background:#F0F0F0">No.1</td>
																<td align="center" style="background:#F0F0F0">No.2</td>
																<td align="center" style="background:#F0F0F0">Dia</td>
																<td align="center" style="background:#F0F0F0">L</td>
																<td align="center" style="background:#F0F0F0">8</td>
																<td align="center" style="background:#F0F0F0">10</td>
																<td align="center" style="background:#F0F0F0">12</td>
																<td align="center" style="background:#F0F0F0">16</td>
																<td align="center" style="background:#F0F0F0">20</td>
																<td align="center" style="background:#F0F0F0">25</td>
																<td align="center" style="background:#F0F0F0">28</td>
																<td align="center" style="background:#F0F0F0">32</td>
																<td align="center" style="background:#F0F0F0">36</td>
																<td align="center" style="background:#F0F0F0">Per</td>
																<td align="center" style="background:#F0F0F0">&nbsp;<!--<input type="checkbox" name="ch_item_wise" id="ch_item_wise">--></td>
															</tr>
															<tr class="boldfont">
																<td align="center" style="background:#F0F0F0">Item No</td>
																<td align="center" style="background:#F0F0F0">Date</td>
																<td width="30%" style="background:#F0F0F0">Description</td>
																<td align="center" style="background:#F0F0F0">No.</td>
																<td align="center" style="background:#F0F0F0">L.</td>
																<td align="center" style="background:#F0F0F0">B.</td>
																<td align="center" style="background:#F0F0F0">D.</td>
																<td align="center" style="background:#F0F0F0">Contents of Area</td>
																<td align="center" style="background:#F0F0F0">Per</td>
																<td align="center" style="background:#F0F0F0">&nbsp;<!--<input type="checkbox" name="ch_item_wise" id="ch_item_wise">--></td>
															</tr>
															<tr>
																<td align="center"></td>
																<td align="center"></td>
																<td></td>
																<td align="center"></td>
																<td align="center"></td>
																<td align="center"></td>
																<td align="right"></td>
																<td width='7%' class='' align="right"></td>
																<td width='7%' class=''></td> 
																<td width='7%' class='' align="right"></td>    
																<td width='7%' class=''></td>           
																<td width='7%' class='' align="right"></td>                
																<td width='7%' class=''></td>          
																<td width='7%' class='' align="right"></td>  
																<td width='7%' class=''></td>  
																<td width='7%' class='' align="right"></td>     
																<td width='7%' class=''></td>      
																<td width='7%' class='' align="right"></td>    
																<td width='7%' class=''></td> 
																<td width='7%' class='' align="right"></td>    
																<td width='7%' class=''></td>   
																<td width='7%' class='' align="right"></td>            
																<td width='7%' class=''></td> 
																<td width='6%' class='' align="right"></td>            
																<td width='6%' class=''></td>              
																<td align="center">&nbsp;</td>
																<td align="center" style="background:#F0F0F0" valign="middle"> 
																<input type="checkbox" name="ch_item_wise[]" id="ch_item_wise" class="ch_itemCheckItemRow" value="">
																</td>
															</tr>
															<tr>
																<td align="center"></td>
																<td align="center"></td>
																<td></td>
																<td align="right"></td>
																<td align="right"></td>
																<td align="right"></td>
																<td align="right"></td>
																<td align="right">
																</td>
																<td align="center"></td>
																<td align="center" style="background:#F0F0F0" valign="middle"> 
																<input type="checkbox" name="ch_item_wise[]" id="ch_item_wise" class="ch_item CheckItemRow" value=""  >
																</td>
															</tr>
																<input type="hidden" name="txt_row_wise_amt" id="txt_row_wise_amt" value="">
																<input type="hidden" name="txt_row_detail_str" id="txt_row_detail_str" value="">
															<tr class="boldfont">
																<td align="center" colspan="7" style="background:#F0F0F0">Total</td>
																<td align="left" style="background:#F0F0F0"></td>
																<td align="left" style="background:#F0F0F0"> </td>
																<td align="left" style="background:#F0F0F0"></td>
																<td align="left" style="background:#F0F0F0"></td>
																<td align="left" style="background:#F0F0F0"></td>
																<td align="left" style="background:#F0F0F0"></td>
																<td align="left" style="background:#F0F0F0"></td>
																<td align="left" style="background:#F0F0F0"></td>
																<td align="left" style="background:#F0F0F0"></td>
																<td align="center" style="background:#F0F0F0">&nbsp;</td>
																<td align="center" style="background:#F0F0F0">&nbsp;</td>
															</tr>
															<tr>
																<td align="center" colspan="7">Unit Weight</td>
																<td align="left">0.395</td>
																<td align="left">0.617</td>
																<td align="left">0.888</td>
																<td align="left">1.58</td>
																<td align="left">2.47</td>
																<td align="left">3.85</td>
																<td align="left">4.83</td>
																<td align="left">6.31</td>
																<td align="left">7.990</td>
																<td align="center">&nbsp;</td>
																<td align="center">&nbsp;</td>
															</tr>
															<tr class="boldfont">
																<td align="center" colspan="7" style="background:#F0F0F0">Sub Total</td>
																<td align="left" style="background:#F0F0F0"></td>
																<td align="left" style="background:#F0F0F0"></td>
																<td align="left" style="background:#F0F0F0"></td>
																<td align="left" style="background:#F0F0F0"></td>
																<td align="left" style="background:#F0F0F0"></td>
																<td align="left" style="background:#F0F0F0"></td>
																<td align="left" style="background:#F0F0F0"></td>
																<td align="left" style="background:#F0F0F0"></td>
																<td align="left" style="background:#F0F0F0"></td>
																<td align="center" style="background:#F0F0F0">&nbsp;</td>
																<td align="center" style="background:#F0F0F0">&nbsp;</td>
															</tr>
															<tr>
																<td align="center" colspan="7">Total in kgs</td>
																<td align="center" colspan="9"></td>
																<td align="center">kg</td>
																<td align="center">&nbsp;</td>
															</tr>
															<tr class="boldfont">
																<td align="center" colspan="7" style="background:#F0F0F0">Total in MT</td>
																<td align="center" colspan="9" style="background:#F0F0F0"></td>
																<td align="center" style="background:#F0F0F0">MT</td>
																<td align="center" style="background:#F0F0F0">&nbsp;</td>
															</tr>
															<tr class="boldfont">
																<td align="right" colspan="7" style="background:#F0F0F0">Total</td>
																<td align="right" style="background:#F0F0F0"></td>
																<td align="center" style="background:#F0F0F0"></td>
																<td align="center" style="background:#F0F0F0">&nbsp;</td>
															</tr>
															<tr class="boldfont">
																<td align="right" colspan="7" style="background:#F0F0F0">Total in (MT)</td>
																<td align="right" style="background:#F0F0F0"></td>
																<td align="center" style="background:#F0F0F0"></td>
																<td align="center" style="background:#F0F0F0">&nbsp;</td>
															</tr>
														</table>
														</div>
													</div>
													</div>&nbsp;&nbsp;&nbsp;&nbsp;&emsp;
												</div>
											</div>
										</div>	
										<br/>&nbsp;<br/>
										<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
										<div class="buttonsection">
											<input type="submit" class="backbutton" name="btn_reject" id="btn_reject" value="Send Back to "/>
										</div>
								<div class="buttonsection">
									<input type="hidden" name="txt_gen_staff" id="txt_gen_staff" value="">
									<input type="hidden" name="txt_gen_level" id="txt_gen_level" value="">
									<input type="submit" class="backbutton" name="btn_reject" id="btn_reject" value="Send Back to "/>
								</div>
								<div class="buttonsection">
									<input type="submit" class="backbutton" name="btn_save" id="btn_save" value="Send to "/>
								</div>
								<div class="buttonsection">
									<input type="submit" class="backbutton" name="btn_save" id="btn_save" value="Save"/>
								</div>
								<div class="buttonsection">
									<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
								</div>
							</div>
					</div>
					<input type="hidden" name="txt_sheetid" id="txt_sheetid" value="">
					<input type="hidden" name="txt_rbn" id="txt_rbn" value="">
					<input type="hidden" name="txt_status" id="txt_status" value="">
					<input type="hidden" name="txt_fromdate" id="txt_fromdate" value="">
					<input type="hidden" name="txt_todate" id="txt_todate" value="">
					<input type="hidden" name="txt_page" id="txt_page" value="">
					<input type="text" name="txt_amount_label" id="txt_amount_label" class="BottomContent3" readonly="" value="Total Amount (Rs.)">
					<input type="text" name="txt_total_amount" id="txt_total_amount" class="BottomContent2" value="">
					<input type="text" name="txt_checkperc_label" id="txt_checkperc_label" class="BottomContent4" readonly="" value="Checked %">
					<input type="text" name="txt_total_percent" id="txt_total_percent" class="BottomContent1" value="" readonly="">
				</form>
			</blockquote>
		</div>
	</div>
</div>
@include('layouts.footer')
</body>
</html>
