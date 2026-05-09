@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.library.binddata') 
@include('layouts.library.common')
@include('layouts.header')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
    @include('admin.menu')
        <!--==============================Content=================================-->
    <div class="content">
        <div class="title">Bidder's Price Bid Details</div>
            <div class="container_12">
                <div class="grid_12">
                    <blockquote class="bq1" style="overflow:auto">
                        <form name="form" method="post" enctype="multipart/form-data" action="">
                            <div class="container">
								<div class="row ">
									<div class="div12">
										<div class="row">
											<table class="DispTable" width="100%">
												<thead>
													<tr>
														<th nowrap="nowrap">Item No</th>
														<th>Item Description</th>
														<th>Quantity </th>
														<th nowrap="nowrap">Rate ( &#8377; )</th>
														<th>Unit</th>
														<th nowrap="nowrap">Amount ( &#8377; )</th>
													</tr>
												</thead>
												<tbody>
												<tr>
													<td align="center" style=" "><input type="hidden" name="txt_item_no[]" value=""></td>
													<td align="justify"><input type="hidden" name="txt_item_desc[]" value=""></td>
													<td align="right"><input type="hidden" name="txt_item_qty[]" value=""></td><td align="right"><input type="hidden" name="txt_item_rate[]" value=""></td>
													<td align="center"><input type="hidden" name="txt_item_unit[]" value=""></td>
													<td align="right"><input type="hidden" name="txt_item_amt[]" value=""></td>
												</tr>
													<tr class="label">
														<td align="center">&nbsp;</td>
														<td align="right">TOTAL AMOUNT ( &#8377; )&nbsp;</td>
														<td align="center">&nbsp;</td>
														<td align="center">&nbsp;</td>
														<td align="center">&nbsp;</td>
														<td align="right"><input type="hidden" name="txt_total_amt" id="txt_total_amt" value=""></td>
													</tr>
													<tr class="label">
														<td align="center">&nbsp;</td>
														<td align="right" valign="middle">REBATE ( % )&nbsp;</td>
														<td align="center">&nbsp;</td>
														<td align="center">&nbsp;</td>
														<td align="center">&nbsp;</td>
														<td align="right"><input type="text" name="txt_rebate_perc" id="txt_rebate_perc" class="tboxclass" value="0.00" style="border:2px solid #7D2C9E; text-align:right; font-weight:bold; padding-left:1px;; padding-right:1px;" maxlength="4"></td>
													</tr>
													<tr class="label">
														<td align="center">&nbsp;</td>
														<td align="right" valign="middle">TOTAL AMOUNT AFTER REBATE ( &#8377; )&nbsp;</td>
														<td align="center">&nbsp;</td>
														<td align="center">&nbsp;</td>
														<td align="center">&nbsp;</td>
														<td align="right"><input type="text" name="txt_total_with_rebate" id="txt_total_with_rebate" disabled="disabled" class="tboxclass" value="" style="border:2px solid #7D2C9E; text-align:right; font-weight:bold; padding-left:1px; padding-right:1px;"></td>
													</tr>
													</tbody>
												</table>
											</div>
											<div class="smediv">&nbsp;</div>
										</div>
									</div>
									<div class="row">
										<div class="div12" align="center">
											<input type="hidden" name="txt_mastid" id="txt_mastid" value="">
											<input type="hidden" name="txt_bidderid" id="txt_bidderid" value="">
											<input type="button" class="backbutton" name="back" id="back" value=" BACK " onClick="goBack();"/>
											<input type="submit" class="backbutton" name="confirm" id="confirm" value=" CONFIRM "/>
										</div>
									</div>  
									<div class="row">&nbsp;</div>                         
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

