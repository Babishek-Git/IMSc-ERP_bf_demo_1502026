@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.library.binddata') 
@include('layouts.library.common')
@include('layouts.header')   
 <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
    <form action="" method="post" enctype="multipart/form-data" name="form">
         @include('admin.menu')
            <!--==============================Content=================================-->
            <div class="content">
                <div class="title">Base Index - 10CC View</div>
                <div class="container_12">
					<div class="grid_12">
						<blockquote class="bq1" style="overflow:auto">
							<div class="smediv">&nbsp;</div>
							<input type="hidden" name="hid_sheetid" id="hid_sheetid" value="">
									<div class="accordion">
										<dl>
											<dt>
												<a href="#accordion" aria-expanded="false" aria-controls="accordion" class="accordion-title accordionTitle js-accordionTrigger blue-bg"></a>
											</dt>
											 <dd class="accordion-content accordionItem is-collapsed" id="accordion" aria-hidden="true">
											 	<div align="center">
													<table width="90%" class="dataTable">
														<tr>
															<th align="center" rowspan="2" valign="middle" nowrap="nowrap">
																&nbsp;Description
															</th>
															<th align="center" valign="middle" colspan="2">
																Base Index
															</th>
															<th align="center" valign="middle" colspan="2">
																Escalation Breakup
															</th>
															<th rowspan="2" colspan="3" width="12%" align="center" valign="middle">
																Action
															</th>
														</tr>
														<tr>
															<th align="center" valign="middle" nowrap="nowrap">
																Code
															</th>
															<th align="center" valign="middle" nowrap="nowrap">
																Rate <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i>
															</th>
															<th align="center" valign="middle">
																Code
															</th>
															<th align="center" valign="middle">
																( % )
															</th>
														</tr>
															<tr class="label">
																<!---td align="center" valign="middle" nowrap="nowrap" width="20%">
																	<!---select name="txt_base_index_item" id="txt_base_index_item" class="extraItemTextbox T" style="display:none" onChange="AssignCode(this,)">
																		<option value="Material" >Material</option>
																		<option value="Labour" >Labour</option>
																	</select>
																</td--->
																<td align="center" valign="middle" nowrap="nowrap">
																	<span class="" id="span_base_index_code"></span>
																	<input type="text" name="txt_base_index_code" id="txt_base_index_code" class="extraItemTextbox T" value="" style="display:none">
																</td>
																<td align="center" valign="middle">
																	<span class="" id="span_base_index_rate"></span>
																	<input type="text" name="txt_base_index_rate" id="txt_base_index_rate" class="extraItemTextbox T" value="" style="display:none">
																</td>
																<td align="center" valign="middle">
																	<span class="" id="span_base_breakup_code"></span>
																	<input type="text" name="txt_base_breakup_code" id="txt_base_breakup_code" class="extraItemTextbox T" value="" style="display:none">
																</td>
																<td align="center" valign="middle">
																	<span class="" id="span_base_breakup_perc"></span>
																	<input type="text" name="txt_base_breakup_perc" id="txt_base_breakup_perc" class="extraItemTextbox T" value="" style="display:none">
																</td>
																<td align="center" valign="middle">
																	<button type="button" class="" data-bid="">Edit</button>
																</td>
																<td align="center" valign="middle">
																	<button type="button" class="" data-bid="">Delete</button>
																</td>
																<td align="center" valign="middle">
																	<button type="button" class="" data-bid="">Accept</button>
																</td>
															</tr>
															<table width="90%" class="dataTable">
																<tr><td colspan="8" align="center" valign="middle" style="color:red">.......... No Index Assigned for this Work ..........</td></tr>
														</table>
													</div>
												 </dd>
											</dl>
										</div>							
										<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
											<div class="buttonsection">
												<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
											</div>
										<!--<div class="buttonsection">
												<input type="submit" name="update" id="update" value=" Update "/>
											</div>-->
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
