@extends('layouts.dashboard-master')

@section('content') 
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
    <form action="" method="post" enctype="multipart/form-data" name="form">
    <div class="content">
        <div class="title">Escalation Generate</div>
       	<div class="container_12">
           	<div class="grid_12">
			<!--<div align="right"><a href="View_Electricity_generate_Bill.php">View</a>&nbsp;&nbsp;&nbsp;</div>-->
                 <blockquote class="bq1" style="overflow:auto">
						<input type="hidden" name="hid_sheetid" id="hid_sheetid" value="">
						<input type="hidden" name="hid_staffid" id="hid_staffid" value="">
                        	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="color1">
                                <tr><td width="20%">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Work Short Name</td> 
                                    <td>
										<select name="cmb_shortname" id="cmb_shortname" class="textboxdisplay" style="width:465px" onChange="workorderdetail();GetEscQuarterRBN();func_GenerateMBno();">
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
                                    <td class="label">
										<input type="text" name='txt_rbn' readonly="" id='txt_rbn' class="textboxdisplay" style="width: 210px;">
										<input type="hidden" name='txt_esc_id' readonly="" id='txt_esc_id' class="textboxdisplay" style="width: 210px;">
										&emsp;&nbsp;
										<label class="label">Quarter</label>&nbsp;&emsp;
										<select name="cmb_quarter" id="cmb_quarter" style="width:150px;" class="textboxdisplay" onChange="find_priceindex_period();">
											<option value="">------- Select -------</option>
										</select>
									</td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_rbn" style="color:red" colspan="">&nbsp;</td></tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Esacaltion Period (TCC)</td>
                                    <td class="label">
										From &emsp;
										<input type="text" name='txt_tccfrom_date' readonly="" id='txt_tccfrom_date' class="textboxdisplay date-picker" style="width: 150px;">
										&emsp;&emsp;&emsp;&emsp;&nbsp;
										To &emsp;
										<input type="text" name='txt_tccto_date' readonly="" id='txt_tccto_date' class="textboxdisplay date-picker" style="width: 150px;">
									</td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_tcc" style="color:red" colspan="">&nbsp;</td></tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Esacaltion Period (TCA)</td>
                                    <td class="label">
										From &emsp;
										<input type="text" name='txt_tcafrom_date' readonly="" id='txt_tcafrom_date' class="textboxdisplay date-picker" style="width: 150px;">
										&emsp;&emsp;&emsp;&emsp;&nbsp;
										To &emsp;
										<input type="text" name='txt_tcato_date' readonly="" id='txt_tcato_date' class="textboxdisplay date-picker" style="width: 150px;">
									</td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_tca" style="color:red" colspan="">&nbsp;</td></tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">MBook No.</td>
                                    <td class="label">
										<select name="currentmbookno" id="currentmbookno" class="textboxdisplay" tabindex="6" style="width:215px;height:22px;" tabindex="7">
                                             <option value="0" selected="selected"> ------------- Select -------------- </option>
                                        </select>
										&emsp;&emsp;
										<label class="label">Page No.</label>&nbsp;
										<input type="hidden" name='bookno' readonly="" id='bookno' class="textboxdisplay" style="width: 150px;">
										<input type="text" name='bookpageno' readonly="" id='bookpageno' class="textboxdisplay" style="width: 140px;">
									</td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_esc_mbook" style="color:red" colspan="">&nbsp;</td></tr>
							</table>
							<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
								<div class="buttonsection">
									<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
								</div>
								<div class="buttonsection">
									<input type="submit" name="submit" id="submit" value=" View "/>
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