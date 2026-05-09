include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.header')
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
        <form action="" method="post" enctype="multipart/form-data" name="phuploader">
            @include('admin.menu')
            <!--==============================Content=================================-->
            <div class="content"> 
                <div class="title">Item Type Edit</div>
                <div class="container_12"> 
                    <div class="grid_12" align="center">
                        <blockquote class="bq1" style="height:1px; overflow:auto;">
                            <div class="container" > 
								<div class="smediv">&nbsp;</div>
								<!--<div class="titlesec" style="width:89%">
									<b>Name of Work</b> :  <font style="color:#DF0979; font-weight:bold; background:#edeaea; border-radius:7px; padding:2px;">CCNo. <?php echo $CCNO; ?></font>
								</div>-->
								<div class="smediv">&nbsp;</div>
								<table width="90%" class="table1 table2">
									<tr class="heading">
										<th class="colhead" nowrap="nowrap">Item No.</th>
										<th class="colhead">Description</th>
										<th class="colhead">Unit</th>
										<th class="colhead">Item Type</th>
									</tr> 
									<tr class="table-row">
										<td class="col" align="center" nowrap="nowrap"></td>
										<td class="col" id=""></td>
										<td class="col"></td>
										<td class="col">
										<input type="text" class="textboxdisplay textboxstyle"  style="color:#003399; width:65px" name="txt_measure_type" id="txt_measure_type" value="" onKeyPress="return IsAlphaNumeric(event,this);"  onBlur="get_item_type(,,this);"  >
										
										<select name="txt_measure_type"  class="textboxdisplay textboxstyle MTypeBox "  id="txt_measure_type" data-rowid="" data-schid="" data-itemno="">
										
										</select>
										
										<input type="hidden" name="hide_result[]" id="hide_result" value="" >
										<input type="hidden" id="hid_subdivid" name="hid_subdivid" value="">
										<input type="hidden" name="hide_prev[]" id="hide_prev
										
										
										
										" value="" >
											
										</td>
									</tr> 
									 
								</table>
                            </div>
							<input type="hidden" name="hid_txtboxcount" id="hid_txtboxcount" value="" >
							<input type="hidden" name="hid_sheetid" id="hid_sheetid" value="" >
							<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
								<div class="buttonsection">
								<input type="submit" name="back" value=" Back ">
								</div>
								<div class="buttonsection">
								<input type="submit" name="update" value=" Update ">
								</div>
								
							</div>
                        </blockquote>
						
						
						
                        <!--<div style="width:1074px;">
							<center>
								<table align="centre" width="1074px">
								   <tr>
								   <td align="center" width="57%" height="27px">
									  <input type="submit" name="back" value=" Back ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									  <input type="submit" name="update" value=" Update ">
								   </td>
								   </tr>
								</table>
							</center>
						</div>-->
                    </div>

                </div>
                
            </div>
            
             <!--==============================footer=================================-->
            @include('layouts.footer')
		   		
        </form>
    </body>
</html>
