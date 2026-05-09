@extends('layouts.dashboard-master')

@section('content')  
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
    <form action="" method="post" enctype="multipart/form-data" name="form">
		<div class="content">
              <div class="title">Escalation Caluculation - 10 CA</div>
                <div class="container_12">
                    <div class="grid_12">
						<!--<div align="right"><a href="AgreementEntryView.php">View</a>&nbsp;&nbsp;&nbsp;</div>-->
                        <blockquote class="bq1" style="overflow:auto">
							<input type="hidden" name="hid_sheetid" id="hid_sheetid" value="">
								<div style="width:100%;" align="center" id="myDiv1">
									<table width="100%" class="color1 label" id="table1">
										<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td align="center" valign="middle" nowrap="nowrap">
												Work Short Name
											</td>
											<td align="center" valign="middle">
												<select name="cmb_shortname" id="cmb_shortname" class="textboxdisplay" style="width:350px;" onChange="workorderdetail();GetEscQuarterRBN();getEscalationItem();">
													<option value="">--------------- Select ---------------</option>
												</select>
											</td>
											<td align="center" valign="middle">
												Work Order No.
											</td>
											<td align="center" valign="middle">
												<input type="text" name='txt_workorder' id='txt_workorder' class="textboxdisplay" style="width:350px;">
											</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td align="center">RAB</td>
											<td align="">
											&emsp;&emsp;&nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;
												<input type="text" name='txt_rbn' id='txt_rbn' class="textboxdisplay" style="width:100px;">
											&nbsp;&emsp;&nbsp;
											<label class="label">Quarter</label>
											&emsp;
											<select name="cmb_quarter" id="cmb_quarter" style="width:143px;" class="textboxdisplay" onChange="find_priceindex_period();">
												<option value="">------- Select -------</option>
											</select>
											<input type="hidden" name='txt_esc_id' id='txt_esc_id' class="textboxdisplay" style="width:60px;">
											</td>
											<td align="center" valign="middle">
												From Date
											</td>
											<td align="center" valign="middle">
												<input type="text" name='txt_from_date' id='txt_from_date' class="textboxdisplay date-picker" style="width:115px;">
												&emsp;&emsp;&nbsp;To Date &emsp;
												<input type="text" name='txt_to_date' id='txt_to_date' class="textboxdisplay date-picker" style="width:115px;">
											</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td align="center" valign="middle" nowrap="nowrap">
												Select For
											</td>
											<td align="center" valign="middle" nowrap="nowrap">
												<select name='cmb_10CA' id='cmb_10CA' class="textboxdisplay" style="width: 350px;">
													<option value="">-------------------------- Select -----------------------------</option>
												</select>
											</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
									</table>
								</div>
								<!--<div style="width:100%; height:100px;" align="center" id="myDiv2">
									<table width="80%" class="table1" id="table1">
										<tr class="label" style="background-color:#CECECE; height:30px;">
											<td align="center" valign="middle" nowrap="nowrap">Sl.No.</td>
											<td align="center" valign="middle" nowrap="nowrap">Mar-2016</td>
											<td align="center" valign="middle" nowrap="nowrap">Apr-2016</td>
											<td align="center" valign="middle" nowrap="nowrap">May-2016</td>
										</tr>
										<tr class="labelsmall" id="tr_cement">
											<td align="center" valign="middle" nowrap="nowrap">Cement Consumption (Qc)</td>
											<td align="center" valign="middle" nowrap="nowrap">60.900</td>
											<td align="center" valign="middle" nowrap="nowrap">39.000</td>
											<td align="center" valign="middle" nowrap="nowrap">42.000</td>
										</tr>
										<tr class="labelsmall hide" id="tr_steel">
											<td align="center" valign="middle" nowrap="nowrap">Steel Consumption (Qs)</td>
											<td align="center" valign="middle" nowrap="nowrap">60.900</td>
											<td align="center" valign="middle" nowrap="nowrap">39.000</td>
											<td align="center" valign="middle" nowrap="nowrap">42.000</td>
										</tr>
										<tr class="labelsmall hide" id="tr_ssteel">
											<td align="center" valign="middle" nowrap="nowrap">Structural Steel Consumption (Qst)</td>
											<td align="center" valign="middle" nowrap="nowrap">1.000</td>
											<td align="center" valign="middle" nowrap="nowrap">2.000</td>
											<td align="center" valign="middle" nowrap="nowrap">3.000</td>
										</tr>
									</table>
								</div>-->
								<div style="width:100%; height:50px;" align="center" id="myDiv3">
									<table width="80%" class="color1 label" id="table1">
										<tr>
											<td colspan="4" align="center" height="35px" valign="middle">
											<input type="button" class="backbutton" name="calculate" id="calculate" value="Calculate" onClick="get10CA_data();"/></td>
										</tr>
								`	</table>
								</div>
								<div style="width:100%;" align="center" id="myDiv">
									<table width="100%" class="table1" id="table2">
										<tr class="label gradientbg" style=" height:35px;">
										<!--<td align="center" valign="middle" nowrap="nowrap">Sl.No.</td>-->
											<td align="center" valign="middle" nowrap="nowrap">Description</td>
											<td align="center" valign="middle" nowrap="nowrap">Month</td>
											<td align="center" valign="middle" nowrap="nowrap"> Qty.<br/>in mt. </td>
											<td align="center" valign="middle">Base <br/>Index</td>
											<td align="center" valign="middle">Base <br/>Price</td>
											<td align="center" valign="middle">Price <br/>Index</td>
											<td align="center" valign="middle">Formula</td>
											<td align="center" valign="middle">Formula with Values</td>
											<td align="center" valign="middle" nowrap="nowrap">Amount &nbsp;<i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i></td>
										</tr>
										<tr>
											<span id="add_hidden"></span>
										</tr>
									</table>
								</div>
								<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
									<div class="buttonsection">
										<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
									</div>
									<div class="buttonsection">
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