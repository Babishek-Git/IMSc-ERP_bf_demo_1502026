@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.library.binddata') 
@include('layouts.library.common')
@include('layouts.header') 
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
    <form action="" method="post" enctype="multipart/form-data" name="form">
            <!--==============================Content=================================-->
		@include('admin.menu')
        <div class="content">
            <div class="title">Price Index - 10CA</div>
                <div class="container_12">
                    <div class="grid_12">
                        <blockquote class="bq1" style="overflow:auto">
							<div class="smediv">&nbsp;</div>
									<div class="accordion">
										<dl>
											<dt>
												<a href="#accordion" aria-expanded="false" aria-controls="accordion" class="accordion-title accordionTitle js-accordionTrigger blue-bg"></a>											
											</dt>
											 <dd class="accordion-content accordionItem is-collapsed" id="accordion" aria-hidden="true">
											 	<div align="center">
													<table width="90%" class="dataTable" id="table1">
														<tr>
															<th align="center" rowspan="2">Quarter</th>
															<th align="center" rowspan="2">Month</th>
															<th align="center" colspan="2">Index</th>
															<th align="center" rowspan="2" colspan="3" width="12%">Action</th>
														</tr>
														<tr>
															<th align="center">Cement</th>
															<th align="center">Steel</th>
															<!--<th align="center">Labour</th>
															<th align="center">Material</th>-->
														</tr>
															<td align="center">
																<span class="" id="span_month_year"></span>
																<input type="text" name="txt_month_year" id="txt_month_year" class="extraItemTextbox T" value="" style="display:none">
															</td>
															<td align="center">
																<span class="" id="span_pi_rate"></span>
																<input type="text" name="txt_pi_rate" id="txt_pi_rate" class="extraItemTextbox T" value="" style="display:none">
															</td>
															<td align="center">
																<span class="" id="span_pi_rate"></span>
																<input type="text" name="txt_pi_rate" id="txt_pi_rate" class="extraItemTextbox T" value="" style="display:none">
															</td>
															<td align="center"><button type="button" class="" data-cpdtid="" data-spdtid="">Edit</button></td>
															<td align="center"><button type="button" class="" data-cpdtid="" data-spdtid="">Delete</button></td>
															<td align="center"><button type="button" class="" data-cpdtid="" data-spdtid="">Accept</button></td>
															<!--<td align="center">$LabourArr[$i][1]</td>
															<td align="center">$MaterialArr[$i][1]</td>-->
														</tr>
														<!--<tr>
															<td>&nbsp;</td>
															<td style="color:#058ADA" align="right"><b>Average Index</b></td>
															<td style="color:#058ADA"></td>
															<td style="color:#058ADA"></td>
															<td colspan="3"></td>
														</tr>-->
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
										<input type="submit" name="view" id="view" value=" View "/>
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
