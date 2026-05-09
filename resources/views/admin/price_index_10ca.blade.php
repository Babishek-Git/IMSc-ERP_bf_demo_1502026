@extends('layouts.dashboard-master')
@section('content')   
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
    <form action="" method="post" enctype="multipart/form-data" name="form">
            <div class="content">
                <div class="title">Price Index - 10CA</div>
					<div class="container_12">
						<div class="grid_12">
							<blockquote class="bq1" style="overflow:auto">
								<div align="right"><a href="PriceIndexView_10CA.php">View</a>&nbsp;&nbsp;&nbsp;</div>
									<input type="hidden" name="hid_sheetid" id="hid_sheetid" value="">
									<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="color1">
										<tr><td width="22%">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
										<tr>
											<td>&nbsp;</td>
											<td class="label">Work Short Name</td> 
											<td>
												<select name="cmb_shortname" id="cmb_shortname" class="textboxdisplay" style="width:465px" onChange="workorderdetail();getrbn();ClearRow();">
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
											<td>&nbsp;</td>
											<td class="label">RAB</td>
											<td>
												<input type="text" name='txt_rbn' id='txt_rbn' class="textboxdisplay" value="" style="width: 100px;">
												&emsp;&emsp;&emsp;&nbsp;
												<label class="label">Quarter</label>
												&emsp;
												<input type="text" name='txt_quarter' id='txt_quarter' class="textboxdisplay" value="" style="width: 40px;">
												&emsp;&nbsp:&nbsp;
												<label class="label">No.of Month</label>
												&emsp;
												<input type="text" name='txt_no_of_month' id='txt_no_of_month' class="textboxdisplay" value="" style="width: 40px;" onBlur="SetMonthField();">
											</td>
										</tr>
										<tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_no_of_month" style="color:red" colspan="">&nbsp;</td></tr>
										<tr>
											<td colspan="3" align="center">
												<div style="width:85%;" class="label gradientbg" align="center">Price Index</div>
												<div style="width:85%; height:auto;" align="center">
													<table width="100%" class="table1" id="table1">
														<!--<tr class="label" style="background-color:#EAEAEA; height:35px;">
															<td align="center" rowspan="2" valign="middle" nowrap="nowrap">&nbsp;Description&nbsp;</td>
															<td align="center" colspan="2" valign="middle" nowrap="nowrap">Base Index</td>
															<td align="center" colspan="2" valign="middle">Base Price</td>
															<td align="center" valign="middle">
																Month - 1
															</td>
															<td align="center" valign="middle">
																Month - 2
															</td>
															<td align="center" valign="middle">
																Month - 3
															</td>
															<td align="center" rowspan="2" valign="middle" nowrap="nowrap">
																Price <br/>Index Code
															</td>
														</tr>
														<tr class="label" style="background-color:#EAEAEA; height:35px;">
															<td align="center" valign="middle" nowrap="nowrap">
																Code
															</td>
															<td align="center" valign="middle" nowrap="nowrap">
																Rate <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i>
															</td>
															<td align="center" valign="middle" nowrap="nowrap">
																Code
															</td>
															<td align="center" valign="middle" nowrap="nowrap">
																Rate <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i>
															</td>
															<td align="center" valign="middle">
																<input type="text" class="extraItemTextbox date-picker" name="txt_month[]" id="txt_month1">
															</td>
															<td align="center" valign="middle">
																<input type="text" class="extraItemTextbox date-picker" readonly="" name="txt_month[]" id="txt_month2">
															</td>
															<td align="center" valign="middle">
																<input type="text" class="extraItemTextbox date-picker" readonly="" name="txt_month[]" id="txt_month3">
															</td>
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