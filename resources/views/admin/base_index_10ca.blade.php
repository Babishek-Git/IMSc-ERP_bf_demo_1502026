@extends('layouts.dashboard-master')
@section('content')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
    <form action="" method="post" enctype="multipart/form-data" name="form">
        <div class="content">
            <div class="title">Base Index - 10CA</div>
            <div class="container_12">
                <div class="grid_12">
                    <blockquote class="bq1" style="overflow:auto;">
						<div align="right"><a href="BaseIndexView_10CA.php">View</a>&nbsp;&nbsp;&nbsp;</div>
						<input type="hidden" name="hid_sheetid" id="hid_sheetid" value="">
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="color1">
							<tr><td width="22%">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
							<tr>
								<td>&nbsp;</td>
								<td class="label">Work Short Name</td> 
								<td>
									<select name="cmb_shortname" id="cmb_shortname" class="textboxdisplay" style="width:465px" onChange="workorderdetail();find_baseindex();">
										<option value="">--------------- Select ---------------</option>
									</select>
								</td>
							</tr>
							<tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_shortname" style="color:red" colspan="">&nbsp;</td></tr>
							<tr>
								<td>&nbsp;</td>
								<td class="label">Name of Work</td>
								<td><textarea name='txt_workname' id='txt_workname' class="textboxdisplay" rows="6" style="width: 465px;"></textarea></td>
							</tr>
							<tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_wname" style="color:red" colspan="">&nbsp;</td></tr>
							<tr>
								<td>&nbsp;</td>
								<td class="label">Work Order No.</td>
								<td><input type="text" name='txt_workorder' id='txt_workorder' class="textboxdisplay" value="" style="width: 465px;"></td>
							</tr>
							<tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_workorder" style="color:red" colspan="">&nbsp;</td></tr>
							<tr>
								<td colspan="3" align="center">
									<div style="width:70%;" class="label gradientbg" align="center">Base Index</div>
									<div style="width:70%; height:auto;" align="center">
									<table width="100%" class="table1" id="table1">
										<tr class="label" style="background-color:#EAEAEA; height:35px;">
											<td align="center" rowspan="2" valign="middle" nowrap="nowrap">
												&nbsp;Description
											</td>
											<td align="center" valign="middle" colspan="2">
												Base Index <!--<i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i>-->
											</td>
											<td align="center" valign="middle" colspan="2">
												Base Price <!--<i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i>-->
											</td>
											<td rowspan="2" align="center" valign="middle">
												<input type="button" class="buttonstyle" name="btn_add" id="btn_add" value="ADD" onClick="addrow()">
											</td>
										</tr>
										<tr class="label" style="background-color:#EAEAEA; height:35px;">
											<td align="center" valign="middle" nowrap="nowrap">
												Code
											</td>
											<td align="center" valign="middle" nowrap="nowrap">
												Index <!--<i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i>-->
											</td>
											<td align="center" valign="middle">
												Code
											</td>
											<td align="center" valign="middle">
												Rate <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i>
											</td>
											</tr>
											<!--<tr class="labeldisplay" style="background-color:#EAEAEA">
												<td align="left" valign="middle" nowrap="nowrap">
												&nbsp;Cement 
												<input type="hidden" name="base_index_item" id="base_index_item1" value="Cement">
												</td>
												<td align="center" valign="middle">
													&emsp;CI<sub>O</sub>&emsp;
												<input type="hidden" name="base_index_code" id="base_index_code1" value="MIo">
												</td>
												<td align="center">
													<input type="text" class="extraItemTextbox" name="base_index_rate" id="base_index_rate1">
												</td>
												<td align="center" valign="middle">
												&emsp;P<sub>C</sub>&emsp;
												<input type="hidden" name="base_price_code" id="base_price_code1" value="Pc">
												</td>
												<td align="center">
													<input type="text" class="extraItemTextbox" name="base_price_rate" id="base_price_rate1">
												</td>
												<td align="center" valign="middle">&nbsp;</td>
												</tr>
												<tr class="labeldisplay" style="background-color:#EAEAEA">
													<td align="left" valign="middle" nowrap="nowrap">
													&nbsp;Steel 
													<input type="hidden" name="base_index_item" id="base_index_item2" value="Steel">
													</td>
													<td align="center" valign="middle">
														&emsp;SI<sub>O</sub>&emsp;
														<input type="hidden" name="base_index_code" id="base_index_code2" value="SIo">
													</td>
													<td align="center">
														<input type="text" class="extraItemTextbox" name="base_index_rate" id="base_index_rate2">
													</td>
													<td align="center" valign="middle">
														&emsp;P<sub>S</sub>&emsp;
													<input type="hidden" name="base_price_code" id="base_price_code2" value="Ps">
													</td>
													<td align="center">
														<input type="text" class="extraItemTextbox" name="base_price_rate" id="base_price_rate2">
													</td>
													<td align="center" valign="middle">&nbsp;</td>
												</tr>-->
											</table>
											 <input type="hidden" value="" name="add_set_a1" id="add_set_a1"/>
										</div>
									</td>
								</tr>
							</table>
							<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
								<div class="buttonsection">
									<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
								</div>
								<div class="buttonsection">
									<input type="submit" name="update" id="update" value=" Update "/>
									<input type="submit" name="submit" id="submit" value=" Submit "/>
								</div>
							</div>
                        </blockquote>
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>
@endsection