@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.library.common')
@include('layouts.header')
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->

        @include('admin.menu')
        <!--==============================Content=================================-->
        <div class="content">
            <div class="title">Measurement - Edit</div>
            <div class="container_12">
                <div class="grid_12">
                    <blockquote class="bq1" style="overflow:auto">
                        <form name="form" method="post" action="">
                            <div class="container">
                 <table width="100%"  bgcolor="#E8E8E8" border="0" class="label" cellpadding="0" cellspacing="0" align="center" >
                 	<tr><td width="23%">&nbsp;</td></tr>
					
									<tr>
										<td></td><td>Item No</td>
										<td>
										
										</td>
									</tr>
									<tr><td>&nbsp;</td><td colspan="2">&nbsp;</td> </tr>
									<tr>
										<td></td><td>Description of Work</td>
										<td>
										<textarea name="txt_desc_work_steel" id="txt_desc_work_steel" class="textboxdisplay" rows="5" style="width:390px;" ></textarea>
										</td>
									</tr>
									<tr><td>&nbsp;</td><td colspan="2">&nbsp;</td> </tr>
									<tr>
										<td></td><td>Dia od Rod</td>
										<td>
										<input type="text" name="txt_dia_steel" id="txt_dia_steel" onBlur="content_area_steel();" class="textboxdisplay" value="" onKeyPress="return isNumber(event)">
										</td>
									</tr>
									<tr><td>&nbsp;</td><td colspan="2">&nbsp;</td> </tr>
									<tr>
										<td></td><td>No.</td>
										<td>
										<input type="text" name="txt_no_steel" id="txt_no_steel" onBlur="content_area_steel();" class="textboxdisplay" value="" onKeyPress="return isNumber(event)">
										</td>
									</tr>
									<tr><td>&nbsp;</td><td colspan="2">&nbsp;</td> </tr>
									<tr>
										<td></td><td>No.</td>
										<td>
										<input type="text" name="txt_no2_steel" id="txt_no2_steel" onBlur="content_area_steel();" class="textboxdisplay" value="" onKeyPress="return isNumber(event)">
										</td>
									</tr>
									<tr><td>&nbsp;</td><td colspan="2">&nbsp;</td> </tr>
									
									<tr>
										<td></td><td>Length</td>
										<td>
										<input type="text" name="txt_length_steel" id="txt_length_steel" onBlur="content_area_steel();" class="textboxdisplay" value="" onKeyPress="return isNumber(event)">
										</td>
									</tr>
									<tr><td>&nbsp;</td><td colspan="2">&nbsp;</td> </tr>
									<tr>
										<td></td><td>Contents of Area</td>
										<td> 
										<input type="text" name="txt_content_area_steel" id="txt_content_area_steel" class="textboxdisplay" value="" onKeyPress="return isNumber(event)">
										</td>
									</tr>
									<tr><td>&nbsp;</td><td colspan="2">&nbsp;</td> </tr>
									<tr>
										<td></td><td>Unit</td>
										<td>
										
										</td>
									</tr>
									<tr><td>&nbsp;</td><td colspan="2">&nbsp;</td> </tr>
								
									<tr>
										<td></td><td>Item No</td><td></td>
									</tr>
									<tr><td>&nbsp;</td><td colspan="2">&nbsp;</td> </tr>
									<tr>
										<td></td><td>Description of Work</td>
										<td>
										<textarea name="txt_desc_work_gen" id="txt_desc_work_gen" rows="5" style="width:390px;" class="textboxdisplay"></textarea>
										</td>
									</tr>
									<tr><td>&nbsp;</td><td colspan="2">&nbsp;</td> </tr>
									<tr>
										<td></td><td>No.</td>
										<td>
										<input type="text" name="txt_no_gen" id="txt_no_gen" onBlur="content_area_gen();" class="textboxdisplay" value="" onKeyPress="return isNumber(event)">
										</td>
									</tr>
									<tr><td>&nbsp;</td><td colspan="2">&nbsp;</td> </tr>
									<tr>
										<td></td><td>Length</td>
										<td>
										<input type="text" name="txt_length_gen" id="txt_length_gen" onBlur="content_area_gen();" class="textboxdisplay" value="" onKeyPress="return isNumber(event)">
										</td>
									</tr>
									<tr><td>&nbsp;</td><td colspan="2">&nbsp;</td> </tr>
									<tr>
										<td></td><td>Breadth</td>
										<td>
										<input type="text" name="txt_breadth_gen" id="txt_breadth_gen" onBlur="content_area_gen();" class="textboxdisplay" value="" onKeyPress="return isNumber(event)">
										</td>
									</tr>
									<tr><td>&nbsp;</td><td colspan="2">&nbsp;</td> </tr>
									<tr>
										<td></td><td>Depth</td>
										<td>
										<input type="text" name="txt_depth_gen" id="txt_depth_gen" onBlur="content_area_gen();" class="textboxdisplay" value="" onKeyPress="return isNumber(event)">
										</td>
									</tr>
									<tr><td>&nbsp;</td><td colspan="2">&nbsp;</td> </tr>
									<tr>
										<td></td><td>Contents of Area</td>
										<td>
										<input type="text" name="txt_content_area_gen" id="txt_content_area_gen" readonly="" class="textboxdisplay" value="" onKeyPress="return isNumber(event)">
										</td>
									</tr>
									<tr><td>&nbsp;</td><td colspan="2">&nbsp;</td> </tr>
									<tr>
										<td></td><td>Unit</td><td><?php echo $remarks; ?></td>
									</tr>
								<?php
							}
						}
					?>
         		</table>
				<input type="hidden" name="txt_mbdetail_id" id="txt_mbdetail_id" value="">
				<input type="hidden" name="txt_type" id="txt_type" value="">
				<input type="hidden" name="txt_decimal" id="txt_decimal" value="">
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

