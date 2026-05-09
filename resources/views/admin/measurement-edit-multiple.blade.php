@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.library.common')
@include('layouts.library.binddata') 
@include('layouts.header')
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->

         @include('admin.menu')
        <!--==============================Content=================================-->
        <div class="content">
            <div class="title">Measurement - Edit</div>
            <div class="container_12">
                <div class="grid_12" align="center">
                    <blockquote class="bq1" style="overflow:auto">
                        <form name="form" method="post" action="">
                        <div class="container">
						<br/>
							<table width="100%"  bgcolor="#E8E8E8" class="table1 table2" cellpadding="0" cellspacing="0" align="center">
								<!--<tr><td colspan="8">&nbsp;</td></tr>-->
								<tr class="heading" style="">
									<!--<td align="center">Date</td>-->
									<td align="center" class="colhead" width="10%">Item No.</td>
									<td align="center" class="colhead" width="40%">Description</td>
									<td align="center" class="colhead">No.</td>
									<td align="center" class="colhead">Length</td>
									<td align="center" class="colhead">Depth</td>
									<td align="center" class="colhead">Breadth</td>
									<td align="center" class="colhead">Contents of Area</td>
									<td align="center" class="colhead">Unit</td>
								</tr>
												<tr>
													<td align="center"></td>
													<td align="center">
														<input type="text" class="textboxnewl" tabindex="" name="txt_description_" 	id="txt_description_"  	value="" style="width:99%;">
													</td>
													<td align="center">
														<input type="text" class="textboxnewr" tabindex="" name="txt_no_" 			id="txt_no_" 	value="" onChange="content_area_gen(); isMultipleDot(this,);" onKeyPress="return isNumber(event)">
													</td>
													<td align="center">
														<input type="text" class="textboxnewr" tabindex="" name="txt_length_" 		id="txt_length_" 		value="" onChange="content_area_gen(); isMultipleDot(this,);" onKeyPress="return isNumber(event)">
													</td>
													<td align="center">
														<input type="text" class="textboxnewr" tabindex="" name="txt_breadth_" 		id="txt_breadth_" 	 	value="" onChange="content_area_gen(); isMultipleDot(this,);" onKeyPress="return isNumber(event)">
													</td>
													<td align="center">
														<input type="text" class="textboxnewr" tabindex="" name="txt_depth_" 		id="txt_depth_" 		 	value="" onChange="content_area_gen(); isMultipleDot(this,);" onKeyPress="return isNumber(event)">
													</td>
													<td align="center">
														<input type="text" class="textboxnewr" tabindex="" name="txt_content_area_" 	id="txt_content_area_" 	value="" style="width:97%;" readonly="">
													</td>
													<td align="center">&nbsp;&nbsp;</td>
												</tr>
											
								<tr class="heading" style="">
									<!--<td align="center">Date</td>-->
									<td align="center" class="colhead" width="10%">Item No.</td>
									<td align="center" class="colhead" width="40%">Description</td>
									<td align="center" class="colhead">Dia</td>
									<td align="center" class="colhead">Nos.</td>
									<td align="center" class="colhead">Nos.</td>
									<td align="center" class="colhead">Length</td>
									<td align="center" class="colhead">Contents of Area</td>
									<td align="center" class="colhead">Unit</td>
								</tr>
												<tr>
													<td align="center"></td>
													<td align="center">
														<!--<input type="text" class="textboxnewl" tabindex="" tabindex="<?php //echo ($i+1); ?>" name="txt_description_<?php //echo $mbdetail_id; ?>" 	id="txt_description_<?php //echo $mbdetail_id; ?>"  	value="<?php //echo $description; ?>" style="width:99%;<?php //echo $font; ?>">-->
														<input type="text" class="textboxnewl" tabindex="" name="txt_description_" 	id="txt_description_"  	value="" style="width:99%;" onChange="content_area_steel()">
													</td>
													<td align="center">
														<input type="text" class="textboxnewr" tabindex="" name="txt_dia_" 			id="txt_dia_" 	 	value="" onChange="content_area_steel(); isMultipleDot(this,);" onKeyPress="return isNumber(event);">
													</td>
													<td align="center">
														<input type="text" class="textboxnewr" tabindex="" name="txt_no2_" 			id="txt_no2_" 			value="" onChange="content_area_steel(); isMultipleDot(this,);" onKeyPress="return isNumber(event)">
													</td>
													<td align="center">
														<input type="text" class="textboxnewr" tabindex="" name="txt_no_" 			id="txt_no_" 			value="" onChange="content_area_steel(); isMultipleDot(this,);" onKeyPress="return isNumber(event)">
													</td>
													<td align="center">
														<input type="text" class="textboxnewr" tabindex="" name="txt_length_" 		id="txt_length_" 		value="" onChange="content_area_steel(); isMultipleDot(this,);" onKeyPress="return isNumber(event)">
													</td>
													<td align="center">
														<input type="text" class="textboxnewr" tabindex="" name="txt_content_area_" 	id="txt_content_area_" 	value="" style="width:97%;" onChange="content_area_steel()" readonly="">
													</td>
													<td align="center">&nbsp;&nbsp;</td>
												</tr>

							</table>
							<input type="hidden" name="txt_mbdetail_id" id="txt_mbdetail_id" value="">
							<input type="hidden" name="txt_type" id="txt_type" value="">
				 		</div>
						<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
							<div class="buttonsection">
							<input type="button" name="back" value="Back" id="back" class="backbutton" onClick="goBack();" />
							</div>
							
							<div class="buttonsection">
							<input type="submit" class="btn" data-type="submit" value=" Update " name="submit" id="submit"   />
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

