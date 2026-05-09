@extends('layouts.dashboard-master')
	
@section('content')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="" method="post" enctype="multipart/form-data" name="form">
            <div class="content">
                <div class="title">Generate - Water Bill</div>
                <div class="container_12">
                    <div class="grid_12">
						<!--<div align="right"><a href="View_Electricity_generate_Bill.php">View</a>&nbsp;&nbsp;&nbsp;</div>-->
                        <blockquote class="bq1" style="overflow:auto">
							<input type="hidden" name="hid_sheetid" id="hid_sheetid" value="">
                        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="color1">
                                <tr><td width="24%">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Work Short Name</td> 
                                    <td class="labeldisplay">
										<select name="cmb_shortname" id="cmb_shortname" class="textboxdisplay" style="width:465px" onChange="workorderdetail();getabstractamount();">
											<option value="">------------ Select Work Short Name ------------</option>
										</select>
									</td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_shortname" style="color:red" colspan="">&nbsp;</td></tr>
                                
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Name of Work</td>
                                    <td><textarea name='txt_workname' id='txt_workname' class="textboxdisplay" readonly="readonly" rows="6" style="width: 465px;"></textarea></td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_wname" style="color:red" colspan="">&nbsp;</td></tr>
                                
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Work Order No.</td>
                                    <td><input type="text" name='txt_workorder' id='txt_workorder' class="textboxdisplay" readonly="" value="" style="width: 465px;"></td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_workorder" style="color:red" colspan="">&nbsp;</td></tr>
								
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Abstract Net Amount (<i class='fa fa-inr label' style='font-weight:normal; padding-top:7px;'></i>)</td>
                                    <td>
										<input type="text" name='txt_abstract_amt' id='txt_abstract_amt' readonly="" class="textboxdisplay textright" value="" style="width: 208px;">
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;
										<label class="label">RAB No. </label>
										<input type="text" name='txt_rbn' id='txt_rbn' readonly="" class="textboxdisplay textright" value="" style="width: 120px;">
									</td>
                                </tr>
                                <tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td align="center" class="labeldisplay" colspan="">
									<div class="labeldisplay" style="width:280px;float:left;color:red;" id="val_ebill_no">&nbsp;</div>
									<div class="labeldisplay" style="float:right;color:red; width:428px;" id="val_rbn"></div>
									</td>
								</tr>
								
								
								<!--<tr>
									<td colspan="3" align="center">
										<div class="label gradientbg" align="center">Meter Details</div>
										<div style="width:90%; height:auto;" align="center">
											<table width="100%" class="table1" id="table1">
												<tr class="label" style="background-color:#EAEAEA">
													<td align="center">Meter No.</td>
													<td align="center">IMR</td>
													<td align="center">IMR Date</td>
													<td align="center">FMR</td>
													<td align="center">FMR Date</td>
													<td align="center">Rate <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i></td>
													<td align="center">Meter Rent <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i></td>
													<td align="center">Unit </td>
													<td align="center">Factor </td>
													<td align="center">Amount <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i></td>
													<td align="center" colspan="2">Action</td>
												</tr>
												<tr>
													<td align="center" style="vertical-align:middle">
														<select name="cmb_meter_no" id="cmb_meter_no" class="extraItemTextbox" style="text-align:center; width:80px;" onChange="meter_details();ClearOldData();">
															<option value="">-Select-</option>
														</select>
													</td>
													<td align="center"><input type="text" class="extraItemTextbox" name="txt_imr" id="txt_imr" style="background-color:#D7D2D5; text-align:center"></td>
													<td align="center"><input type="text" class="extraItemTextbox" name="txt_imr_date" id="txt_imr_date" style="background-color:#D7D2D5; text-align:center"></td>
													<td align="center"><input type="text" class="extraItemTextbox" name="txt_fmr" id="txt_fmr" onBlur="calculateEBamount();"></td>
													<td align="center"><input type="text" class="extraItemTextbox" name="txt_fmr_date" id="txt_fmr_date" placeholder="dd-mm-yyyy"></td>
													<td align="center"><input type="text" class="extraItemTextbox" name="txt_rate_unit" id="txt_rate_unit" style="background-color:#D7D2D5; text-align:center"></td>
													<td align="center"><input type="text" class="extraItemTextbox" name="txt_rent" id="txt_rent" style="background-color:#D7D2D5; text-align:center"></td>
													<td align="center"><input type="text" class="extraItemTextbox" name="txt_unit" id="txt_unit" style="background-color:#D7D2D5; text-align:center"></td>
													<td align="center"><input type="text" class="extraItemTextbox" name="txt_factor" id="txt_factor" style="background-color:#D7D2D5; text-align:center"></td>
													<td align="center"><input type="text" class="extraItemTextbox" name="txt_amount" id="txt_amount" readonly="" style="background-color:#D7D2D5; text-align:center"></td>
													<td align="center" colspan="2" valign="middle"><input type="button" class="buttonstyle" name="btn_add" id="btn_add" value="Add" onClick="addrow();total_unit_amount_consumption();"></td>
												</tr>
												<tr>
                                                    <span id="add_hidden"></span>
												</tr>
											</table>
											<input type="hidden" value="" name="add_set_a1" id="add_set_a1"/>
										</div>
									</td>
								</tr>-->
								<!--<tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_electricity_row" style="color:red" colspan="">&nbsp;</td></tr>
								<tr>
									<td class="label" colspan="2" align="right">Total Unit consumption&emsp;&emsp;</td>
									<td>
										<input type="text" name='txt_electricity_unit' readonly="" id='txt_electricity_unit' class="textboxdisplay" style="width: 120px;">
									</td>
								</tr>
								<tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_electricity_cost" style="color:red" colspan="">&nbsp;</td></tr>
								<tr>
									<td class="label" colspan="2" align="right">Total Amount <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i>&emsp;&emsp;</td>
									<td>
										<input type="text" name='txt_electricity_cost' readonly="" id='txt_electricity_cost' class="textboxdisplay" style="width: 120px;">
									</td>
								</tr>
								<tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_electricity_cost" style="color:red" colspan="">&nbsp;</td></tr>-->
								<tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_electricity_cost" style="color:red" colspan="">&nbsp;</td></tr>
								<tr>
									<td>&nbsp;</td>
									<td class="label" align="left">Water Charge&nbsp; </td>
									<td>
									<input type="text" name='txt_water_charge_perc' id='txt_water_charge_perc' class="textboxdisplay" value="1" style="width: 40px; text-align:center">
									<label class="label">
									
									( % of net Amount )
									&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
									( <i class='fa fa-inr label' style='font-weight:normal; padding-top:7px;'></i> )
									</label>
									<input type="text" name='txt_water_charge_cost' id='txt_water_charge_cost' readonly="" class="textboxdisplay" style="width: 120px;">
									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td align="center" class="labeldisplay" colspan="">
									<div class="labeldisplay" style="width:300px;float:left;color:red;" id="val_water_charge_perc">&nbsp;</div>
									<div class="labeldisplay" style="float:right;color:red; width:460px;" id="val_water_charge_cost"></div>
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