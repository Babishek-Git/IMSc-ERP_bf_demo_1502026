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
                <div class="container_12">
                    <div class="grid_12">
						<div align="right"><a href="AgreementEntryView.php">View</a>&nbsp;&nbsp;&nbsp;</div>
                        <blockquote class="bq1">
                            <div class="title">Water Bill</div>
							<input type="hidden" name="hid_sheetid" id="hid_sheetid" value="">
                        <table width="1078px" border="0" align="center" cellpadding="0" cellspacing="0" class="color1">
                                <tr><td width="18%">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
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
                                    <td class="label">Meter No.</td>
                                    <td><input type="text" name='txt_meterno' id='txt_meterno' class="textboxdisplay" value="" style="width: 465px;"></td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_meterno" style="color:red" colspan="">&nbsp;</td></tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Initial Meter Reading (IMR)</td>
                                    <td>
									<input type="text" name='txt_initial' id='txt_initial' class="textboxdisplay" value="" style="width: 120px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<label class="label">IMR Date </label>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="text" name='txt_initial_date' id='txt_initial_date' class="textboxdisplay" value="" style="width: 120px;">
									</td>
                                </tr>
                                <tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td align="center" class="labeldisplay" id="" style="color:red" colspan="">
									<span id="val_initial"></span>
									<span id="val_initialdate"></span>
									&nbsp;
									</td>
								</tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Rate of Water ( Rs.)</td>
                                    <td>
									<input type="text" name='txt_rate' id='txt_rate' class="textboxdisplay" value="" style="width: 120px;">
									&nbsp;&nbsp;
									<label class="label"> /&nbsp;&nbsp; </label>
									<input type="text" name='txt_limit' id='txt_limit' class="textboxdisplay" value="" style="width: 120px;">
									<label class="label"> &nbsp;&nbsp;Liters </label>
									</td>
                                </tr>
                                <tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td align="center" class="labeldisplay" id="" style="color:red" colspan="">
									<span id="val_rate" style="padding-right:44px"></span>
									<span id="val_limit"></span>
									&nbsp;
									</td>
								</tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Rent for Meter ( Rs.)</td>
                                    <td>
									<input type="text" name='txt_meter_rent' id='txt_meter_rent' class="textboxdisplay" value="" style="width: 120px;">
									</td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_meter_rent" style="color:red" colspan="">&nbsp;</td></tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Date</td>
                                    <td><input type="text" name="txt_date" id='txt_date' class="textboxdisplay" style="width: 120px;"></td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_date" style="color:red" colspan="">&nbsp;</td></tr>
							</table>
                            
									<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
										<div class="buttonsection">
											<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
										</div>
										<div class="buttonsection">
											<input type="submit" name="submit" id="submit" value=" Save "/>
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
