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
            <div class="title">Escalation Item Assign</div>
            <div class="container_12">  
                <div class="grid_12"> 
                    <blockquote class="bq1" id="bq1" style="overflow:auto;">
                        <div class="container" align="center">
							<div class="smediv">&nbsp;</div>
								<div class="titlesec" style="width:89%">
									<b>Name of Work</b> : <font style="color:#DF0979; font-weight:bold; background:#edeaea; border-radius:7px; padding:2px;">CCNo. </font>
								</div>
								<div class="smediv">&nbsp;</div>
								<table width="90%" class="table1">
									<tr class="label heading" style="color:#025fa4">
										<th align="center" style="vertical-align:middle" nowrap="nowrap">Item No.</th>
										<th align="center" style="vertical-align:middle" valign="middle">Description</th>
										<th align="center" style="vertical-align:middle" valign="middle" nowrap="nowrap">Total Qty.</th>
										<th align="center" style="vertical-align:middle" valign="middle">Unit</th>
										<th align="center" style="vertical-align:middle" valign="middle">Rate &#x20B9</th>
										<th align="center" style="vertical-align:middle" valign="middle" nowrap="nowrap">Escalation<br/>( YES / NO ) <br/> <input type="checkbox" name="check_all" id="check_all"></th>
									</tr>
								  	<tr class="labelhead">
										<td align="center" valign="middle"></td>
										<td>&nbsp;</td>
										<td align="right" valign="middle">&nbsp;</td>
										<td align="center" valign="middle"></td>
										<td align="right" valign="middle">&nbsp;</td>
										<td align="center" valign="middle"><input type="checkbox" name="ch_escalation[]" id="ch_escalation" value="" ></td>
									</tr>
								</table>
								<input type="hidden" name="txt_sheetid" id="txt_sheetid" value="">
								<input type="hidden" name="txt_supp_sheetid" id="txt_supp_sheetid" value="">
                            </div>
							<div style="text-align:center; height:30px; line-height:30px;" class="printbutton">
								<div class="buttonsection">
									<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();">
								</div>
								<div class="buttonsection">
									<input type="submit" class="backbutton" name="btn_save" id="btn_save" value="Save">
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