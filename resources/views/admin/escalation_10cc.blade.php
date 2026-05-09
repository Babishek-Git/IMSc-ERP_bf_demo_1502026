@extends('layouts.dashboard-master')

@section('content') 
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <form action="" method="post" enctype="multipart/form-data" name="form">
            <div class="content">
                <div class="title">Escalation Caluculation - 10 CC</div>
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
										&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
											<input type="text" name='txt_rbn' id='txt_rbn' class="textboxdisplay" style="width:100px;">
										&nbsp;&emsp;&nbsp;
										<label class="label">Quarter</label>
										&emsp;
											<select name="cmb_quarter" id="cmb_quarter" style="width:140px;" class="textboxdisplay" onChange="find_priceindex_period();">
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
											<select name='cmb_10CC' id='cmb_10CC' class="textboxdisplay" style="width: 350px;">
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
							<div style="width:100%; height:50px;" align="center" id="myDiv2">
								<table width="80%" class="color1 label" id="table1">
									<tr>
										<td colspan="4" align="center" height="35px" valign="middle">
										<input type="button" class="backbutton" name="calculate" id="calculate" value="Calculate" onClick="get10CC_data();"/></td>
									</tr>
								</table>
							</div>
							<div style="width:100%; height:250px; overflow:scroll" align="center" id="myDiv3">
								<table width="100%" class="table1" id="table3">
									<tr class="labelsmall gradientbg" style="height:30px;">
										<!--<td align="center" valign="middle" nowrap="nowrap">Sl.No.</td>-->
										<td align="center" valign="middle" nowrap="nowrap">Month</td>
										<td align="center" valign="middle" nowrap="nowrap"> RAB. </td>
										<td align="center" valign="middle" nowrap="nowrap"> MB No. </td>
										<td align="center" valign="middle" nowrap="nowrap"> Page </td>
										<td align="center" valign="middle">RAB <br/>Value</td>
										<td align="center" valign="middle">Secured <br/>Advance</td>
										<td align="center" valign="middle">Total RAB<br/> Value </td>
										<td align="center" valign="middle">85 % of RAB <br/>Value</td>
										<td align="center" valign="middle">Total<br/> Recoveries</td>
										<td align="center" valign="middle" nowrap="nowrap">Amount &nbsp;<i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i></td>
									</tr>
									<tr>
                                       <span id="add_hidden_rab"></span>
									</tr>
								</table>
							</div>
							<div style="width:100%;" align="center" id="myDiv">
								<table width="100%" class="table1" id="table2">
									<tr class="labelsmall gradientbg" style="height:35px;">
										<!--<td align="center" valign="middle" nowrap="nowrap">Sl.No.</td>-->
										<td align="center" valign="middle" nowrap="nowrap">Desc.</td>
										<td align="center" valign="middle" nowrap="nowrap">Month</td>
										<td align="center" valign="middle">Total RAB<br/> Value (W)</td>
										<td align="center" valign="middle">Base <br/>Index</td>
										<td align="center" valign="middle">Esc <br/>Breakup</td>
										<td align="center" valign="middle">Price <br/>Index</td>
										<td align="center" valign="middle">Avg Price <br/>Index</td>
										<td align="center" valign="middle">Formula</td>
										<td align="center" valign="middle">Formula with Values</td>
										<td align="center" valign="middle" nowrap="nowrap">Amount &nbsp;<i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i></td>
									</tr>
									<tr>
                                       <span id="add_hidden_tcc"></span>
									</tr>
								</table>
							</div>
							<input type="hidden" name="txt_rbn_calc" id="txt_rbn_calc" value="0">
							<input type="hidden" name="txt_item_calc" id="txt_item_calc" value="">
							<input type="hidden" name="txt_netamt_for_esc" id="txt_netamt_for_esc" value="0">
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
<div id="basic-modal-content">
	<div align="center" class="popuptitle gradientbg_dialog">RAB Net Amount Details for Escalation - 10CC </div>
	<div style=" padding-top:4px; width:100%; height:100%;">
		<table width="100%" class="table1" id="tablex">
			<tr class="labelsmall" style="height:30px; background-color:#C9C9C9" id="det_row0">
				<td align="center" valign="middle" nowrap="nowrap">Sl.No.</td>
				<td align="center" valign="middle" nowrap="nowrap" width="30%">Description </td>
				<td align="center" valign="middle" nowrap="nowrap"> Formula </td>
			</tr>
			<tr class="labelsmall" style="height:30px;" id="det_row1">
				<td align="center" valign="middle" nowrap="nowrap">1</td>
				<td align="left" valign="middle" width="30%">Name of the Month </td>
				<td align="center" valign="middle" nowrap="nowrap">&nbsp;  </td>
			</tr>
			<tr class="labelsmall" style="height:30px;" id="det_row2">
				<td align="center" valign="middle" nowrap="nowrap">2</td>
				<td align="left" valign="middle" width="30%">RAB NO: </td>
				<td align="center" valign="middle" nowrap="nowrap">&nbsp;  </td>
			</tr>
			<tr class="labelsmall" style="height:30px;" id="det_row3">
				<td align="center" valign="middle" nowrap="nowrap">3</td>
				<td align="left" valign="middle" width="30%">MBook No: </td>
				<td align="center" valign="middle" nowrap="nowrap">&nbsp;  </td>
			</tr>
			<tr class="labelsmall" style="height:30px;" id="det_row4">
				<td align="center" valign="middle" nowrap="nowrap">4</td>
				<td align="left" valign="middle" width="30%">MBook Page No. </td>
				<td align="center" valign="middle" nowrap="nowrap">&nbsp;  </td>
			</tr>
			<tr class="labelsmall" style="height:30px;" id="det_row5">
				<td align="center" valign="middle" nowrap="nowrap">5</td>
				<td align="left" valign="middle" width="30%">gross value of work done upto <label class="pointout">this month.</label></td>
				<td align="center" valign="middle" nowrap="nowrap"> ( A ) </td>
			</tr>
			<tr class="labelsmall" style="height:30px;" id="det_row6">
				<td align="center" valign="middle" nowrap="nowrap">6</td>
				<td align="left" valign="middle" width="30%">gross value of work done upto <label class="pointout">last month</label>. </td>
				<td align="center" valign="middle" nowrap="nowrap"> ( B ) </td>
			</tr>
			<tr class="labelsmall" style="height:30px;" id="det_row7">
				<td align="center" valign="middle" nowrap="nowrap">7</td>
				<td align="left" valign="middle" width="30%">Gross value of work done since previous Month RAB. </td>
				<td align="center" valign="middle" nowrap="nowrap"> ( C ) = (A)-(B) </td>
			</tr>
			<tr class="labelsmall" style="height:30px;" id="det_row8">
				<td align="center" valign="middle" nowrap="nowrap">8</td>
				<td align="left" valign="middle" width="30%">
					Full assessed value of <label class="pointout">secured advance</label> (excluding materials covered under Cluase 10CA) fresh <label class="pointout">paid</label> in this month RAB.
				 </td>
				<td align="center" valign="middle" nowrap="nowrap"> ( D ) </td>
			</tr>
			<tr class="labelsmall" style="height:30px;" id="det_row9">
				<td align="center" valign="middle" nowrap="nowrap">9</td>
				<td align="left" valign="middle" width="30%">
				Full assessed value of <label class="pointout">secured advance</label> (excluding materials covered under Clause 10CA)<label class="pointout">recovered</label> in this  month RAB. 
				</td>
				<td align="center" valign="middle" nowrap="nowrap"> ( E ) </td>
			</tr>
			<tr class="labelsmall" style="height:30px;" id="det_row10">
				<td align="center" valign="middle" nowrap="nowrap">10</td>
				<td align="left" valign="middle" width="30%">Full assessed value of <label class="pointout">secured advance</label> for which <label class="pointout">escalation payable</label> in this month RAB. </td>
				<td align="center" valign="middle" nowrap="nowrap"> ( F ) = (D-E) </td>
			</tr>
			<tr class="labelsmall" style="height:30px;" id="det_row11">
				<td align="center" valign="middle" nowrap="nowrap">11</td>
				<td align="left" valign="middle" width="30%">Advance payment made during this month. </td>
				<td align="center" valign="middle" nowrap="nowrap"> ( G ) </td>
			</tr>
			<tr class="labelsmall" style="height:30px;" id="det_row12">
				<td align="center" valign="middle" nowrap="nowrap">12</td>
				<td align="left" valign="middle" width="30%">Advance payment recovered during this month. </td>
				<td align="center" valign="middle" nowrap="nowrap"> ( H ) </td>
			</tr>
			<tr class="labelsmall" style="height:30px;" id="det_row13">
				<td align="center" valign="middle" nowrap="nowrap">13</td>
				<td align="left" valign="middle" width="30%">Advance payment for which escalation is payable in this month. </td>
				<td align="center" valign="middle" nowrap="nowrap"> ( I ) = (G-H) </td>
			</tr>
			<tr class="labelsmall" style="height:30px;" id="det_row14">
				<td align="center" valign="middle" nowrap="nowrap">14</td>
				<td align="left" valign="middle" width="30%">Extra items/deviated quantities paid as per Clause 12 based on prevailing market rates in this month. </td>
				<td align="center" valign="middle" nowrap="nowrap"> ( J ) </td>
			</tr>
			<tr class="labelsmall" style="height:30px;" id="det_row15">
				<td align="center" valign="middle" nowrap="nowrap">15</td>
				<td align="left" valign="middle" width="30%">M = (C+F+I-J) </td>
				<td align="center" valign="middle" nowrap="nowrap"> ( M ) </td>
			</tr>
			<tr class="labelsmall" style="height:30px;" id="det_row16">
				<td align="center" valign="middle" nowrap="nowrap">16</td>
				<td align="left" valign="middle" width="30%">N = 0.85*M </td>
				<td align="center" valign="middle" nowrap="nowrap"> ( N ) </td>
			</tr>
			<tr class="labelsmall" style="height:30px;" id="det_row17">
				<td align="center" valign="middle" nowrap="nowrap">17</td>
				<td align="left" valign="middle" width="30%">Less cost of materials  supplied by the department as per Clause 10 and recovered during the month. </td>
				<td align="center" valign="middle" nowrap="nowrap"> ( K ) </td>
			</tr>
			<tr class="labelsmall" style="height:30px;" id="det_row18">
				<td align="center" valign="middle" nowrap="nowrap">18</td>
				<td align="left" valign="middle" width="30%">Less cost if servuces rebdered at fixed charges as per Clause 34 and recovered during this month. </td>
				<td align="center" valign="middle" nowrap="nowrap"> ( L ) </td>
			</tr>
			<tr class="labelsmall" style="height:30px;" id="det_row19">
				<td align="center" valign="middle" nowrap="nowrap">&nbsp;</td>
				<td align="left" valign="middle" width="30%">1) Water Charges </td>
				<td align="center" valign="middle" nowrap="nowrap"> ( L1 ) </td>
			</tr>
			<tr class="labelsmall" style="height:30px;" id="det_row20">
				<td align="center" valign="middle" nowrap="nowrap">&nbsp;</td>
				<td align="left" valign="middle" width="30%">2) Electricity charges</td>
				<td align="center" valign="middle" nowrap="nowrap"> ( L2 ) </td>
			</tr>
			<tr class="labelsmall" style="height:30px;" id="det_row21">
				<td align="center" valign="middle" nowrap="nowrap">19</td>
				<td align="left" valign="middle" width="30%">Cost of work for which escalation is applicable for this month. </td>
				<td align="center" valign="middle" nowrap="nowrap"> W = N - (K+L1+L2) </td>
			</tr>
			<tr class="labelsmall" style="height:30px;" id="det_row22">
				<td align="center" valign="middle" nowrap="nowrap">20</td>
				<td align="left" valign="middle" width="30%">Cost of work for which escalation is applicable for this quarter. </td>
				<td align="center" valign="middle" nowrap="nowrap">&nbsp;  </td>
			</tr>
			<tr>
                <span id="add_hidden_rab"></span>
			</tr>
		</table>
	</div>
	<div align="center" style=" width:100%; height:80px;">
		<div class="buttonsection" align="center">
			<input type="button" name="btn_back" id="btn_back" value=" Back " class="buttonstyle" onClick="CloseWindow()" />
		</div>
	</div>
</div>
</body>
</html>
@endsection		
