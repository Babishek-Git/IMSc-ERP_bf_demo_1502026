@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.header')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
    <form action="" method="post" enctype="multipart/form-data" name="phuploader">
        @include('admin.menu')
            <!--==============================Content=================================-->
        <div class="content"> 
            <div class="title">Theoritical Cement Value - Assign</div>
                <div class="container_12">  
                    <div class="grid_12" align="center"> 
                        <blockquote class="bq1" id="bq1" style="overflow:auto;">
                            <div class="container">
							<div class="smediv">&nbsp;</div>
							<div class="titlesec" style="width:89%">
								<b>Name of Work</b> :  <font style="color:#DF0979; font-weight:bold; background:#edeaea; border-radius:7px; padding:2px;">CCNo. <?php echo $CCNO; ?></font>
							</div>
							<div class="smediv">&nbsp;</div>
							<table width="90%" class="table1 table2">
								<tr class="heading">
									<th class="colhead" nowrap="nowrap">Item No.</th>
									<th class="colhead">Description</th>
									<th class="colhead">Total Qty.</th>
									<th class="colhead">Unit</th>
									<th class="colhead">Rate <i class="fa fa-inr" style="padding-top:7px;"></i></th>
									<th class="colhead" nowrap="nowrap">Total Amt <i class="fa fa-inr" style="padding-top:7px;"></i></th>
									<th class="colhead">Theoritical Cement in kg</th>
								</tr>  
                               <!-- <div class="heading" style="position:fixed; top:139px; width:1062px">
                                    <div class="col labelcontenthead" style="width:60px; height:35px; vertical-align:middle" align="center">Item No.</div>
                                    <div class="col labelcontenthead" style="width:600px; vertical-align:middle">Description</div>
									<div class="col labelcontenthead" style="width:77px; vertical-align:middle">Total Qty</div>
                                    <div class="col labelcontenthead" style="width:50px; vertical-align:middle">Unit </div>
									<div class="col labelcontenthead" style="width:85px; vertical-align:middle">Rate </div>
									<div class="col labelcontenthead" style="width:106px; vertical-align:middle">Amount </div>
									<div class="col labelcontenthead" style="width:76px; vertical-align:middle">Theoritical Cement in kg </div>
                                </div>-->
                             	<!--<div style=" padding-top:95px;">-->
									<tr>
										<td class="col" align="center" nowrap="nowrap" valign="middle"></td>
										<td class="col labelprint" valign="middle" id=""> </td>
										<td class="col" valign="middle" align="right"></td>
										<td class="col" valign="middle">
										</td>
										<td class="col" align="right" valign="middle"></td>
										<td class="col" align="right" valign="middle">
										</td>
										<td valign="middle">
											<input type="text" class="textboxdisplay textboxstyle" style="color:#003399; width:72px" name="txt_decimal_placed" id="txt_decimal_placed<?php //echo $divid_incr; ?>" value="<?php //echo $List->tc_unit; ?>"  onkeypress="return isDecimalNumber(event,this);" onBlur="get_decimal_val(<?php echo $x1; ?>,<?php echo $List->sch_id; ?>,this);"  >
											<input type="hidden" name="hide_result[]" id="hide_result" value="" >
											<input type="hidden" id="hid_subdivid" name="hid_subdivid" value="">
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
                    </div>
                </div>
            </div>
             <!--==============================footer=================================-->
            @include('layouts.footer')
        </form>
    </body>
</html>