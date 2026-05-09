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
                <div class="title">Water Bill New</div>
                <div class="container_12">
                    <div class="grid_12">
						<!--<div align="right"><a href="AgreementEntryView.php">View</a>&nbsp;&nbsp;&nbsp;</div>-->
                        <blockquote class="bq1">
							<input type="hidden" name="hid_sheetid" id="hid_sheetid" value="">
                        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="color1">
                                <tr><td width="22%">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Work Short Name</td> 
                                    <td>
										<select name="cmb_shortname" id="cmb_shortname" class="textboxdisplay" style="width:465px" onChange="workorderdetail();recoverydetail();WaterMeterDetail();">
											<option value="">----------------------- Select Work Short Name ------------------------</option>
										</select>
									</td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_shortname" style="color:red" colspan="">&nbsp;</td></tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Name of Work</td>
                                    <td><textarea name='txt_workname' id='txt_workname' readonly="" class="textboxdisplay" rows="6" style="width: 465px;"></textarea></td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_wname" style="color:red" colspan="">&nbsp;</td></tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Work Order No.</td>
                                    <td><input type="text" name='txt_workorder' id='txt_workorder' readonly="" class="textboxdisplay" value="" style="width: 465px;"></td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_workorder" style="color:red" colspan="">&nbsp;</td></tr>
								<tr>
									<td colspan="3" align="center">
										<div class="label gradientbg" align="center">Meter Details</div>
										<div style="width:90%; height:auto;" align="center">
											<table width="100%" class="table1" id="table1">
												<tr class="label" style="background-color:#EAEAEA">
													<td align="center">Meter No.</td>
													<td align="center">IMR</td>
													<td align="center">IMR Date</td>
													<td align="center">Rate <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i><b id="water_limit"> / 1000 Liters</b></td>
													<td align="center">Meter Rent <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i></td>
													<td align="center">Factor</td>
													<td align="center" colspan="2">Action</td>
												</tr>
												<tr>
													<td align="center"><input type="text" class="extraItemTextbox" name="txt_meter_no" id="txt_meter_no"></td>
													<td align="center"><input type="number" class="extraItemTextbox" name="txt_imr" id="txt_imr" onKeyPress="return isNumberKey(event,this)"></td>
													<td align="center"><input type="text" placeholder="DD-MM-YYYY" class="extraItemTextbox" name="txt_imr_date" id="txt_imr_date"></td>
													<td align="center"><input type="number" class="extraItemTextbox" name="txt_rate_unit" id="txt_rate_unit" onKeyPress="return isNumberKey(event,this)"></td>
													<td align="center"><input type="number" class="extraItemTextbox" name="txt_rent" id="txt_rent" onKeyPress="return isNumberKey(event,this)"></td>
													<td align="center"><input type="number" class="extraItemTextbox" name="txt_factor" id="txt_factor" onKeyPress="return isNumberKey(event,this)"></td>
													<td align="center" colspan="2" valign="middle"><input type="button" class="buttonstyle" name="btn_add" id="btn_add" value="Add" onClick="addrow(); clearrow();"></td>
												</tr>
												<tr>
                                                    <span id="add_hidden"></span>
												</tr>
											</table>
                                             <input type="hidden" value="" name="add_set_a1" id="add_set_a1"/>
											 <input type="hidden" name="txt_w_limit" id="txt_w_limit">
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
            <!--==============================footer=================================-->
           @include('layouts.footer')
        </form>
    </body>
</html>
