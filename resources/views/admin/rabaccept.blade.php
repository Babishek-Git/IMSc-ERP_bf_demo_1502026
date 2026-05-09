@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<!--==============================Content=================================-->
	<div class="content">
		<div class="title">RAB Accept</div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1" style="overflow:auto">
					<form name="form" method="post" action="">
						<div class="container">
							<table width="100%"  bgcolor="#E8E8E8" border="0" cellpadding="0" cellspacing="0" align="center" >
								<tr><td width="22%">&nbsp;</td></tr>
								<tr>
									<td>&nbsp;</td> 
									<td  class="label">Work Short Name</td>
									<td  class="labeldisplay">
										<select name="cmb_work_no" id="cmb_work_no" onChange="find_workname();check_bill_confirm();" class="textboxdisplay" style="width:400px;height:22px;" tabindex="7">
											<option value="">---------------------- Select ----------------------</option>
										</select>
									</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr><td>&nbsp;</td><td></td><td id="val_work" style="color:red"></td></tr>
								<tr>
									<td>&nbsp;</td>
									<td  class="label">Work Order No.</td>
									<td  class="labeldisplay">
										<input type="text" name="txt_workorder_no" id="txt_workorder_no" class="textboxdisplay" style="width:397px;" value="">
									</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr><td>&nbsp;</td><td></td><td id="val_workorder" style="color:red"></td></tr>		
								<tr>
									<td>&nbsp;</td>
									<td  class="label">Name of the Work </td>
									<td  class="labeldisplay">
										<textarea name="workname" class="textboxdisplay txtarea_style" style="width: 400px; pointer-events: none; background-color:#E8E8E8" rows="5" readonly="readonly"></textarea>
									</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr><td>&nbsp;</td><td></td><td id="val_work" style="color:red"></td></tr>
								<tr>
									<td>&nbsp;</td>
									<td  class="label">RAB </td>
									<td  class="labeldisplay">
										<input type="text" name="txt_rbn" id="txt_rbn" value="" class="textboxdisplay" readonly="" style="width:50px;"/>
									</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr><td>&nbsp;</td><td></td><td id="val_rbn" style="color:red"></td></tr>
									<input type="hidden" name="txt_empty_page" id="txt_empty_page" value="" class="textboxdisplay" style="width:100px;"/>
							</table>
						</div>
						<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
							<div class="buttonsection">
								<input type="submit" class="btn" data-type="submit" value=" View " name="submit" id="submit"   />
							</div>
						</div>
						<div align="center" style="display:none" >
							<br/>
							<table width="80%"  bgcolor="#E8E8E8" class="table1" align="center">
								<tr class="label">
									<td align="center">Slno.</td>
									<td align="left">Description</td>
									<td align="center">Reference</td>
									<td colspan="2" align="center">Status / Remarks</td>
								</tr>
								<tr>
									<td align="center" colspan="5" class="color1b"> ---------------- RAB Closed --------------</td>
								</tr>
								<tr>
									<td align="center">1</td>
									<td align="left">Abstract</td>
									<td align="center"></td>
									<td align="left">Already Generated</td>
									<td align="center" valign="middle"><i class="fa fa-check-circle" style="font-size:25px;color:green"></i></td>
									<td align="center">-- -- --</td>
									<td align="left" class="color1b">Not Generated</td>
									<td align="center"><i class="fa fa-times-circle" style="font-size:25px;color:red"></i></td>
								</tr>
								<tr>
									<td align="center">2</td>
									<td align="left">Sub Abstract</td>
									<td align="center"></td>
									<td align="left">Already Generated</td>
									<td align="center" valign="middle"><i class="fa fa-check-circle" style="font-size:25px;color:green"></i></td>
									<td align="center">-- -- --</td>
									<td align="left" class="color1b">Not Generated</td>
									<td align="center"><i class="fa fa-times-circle" style="font-size:25px;color:red"></i></td>
								</tr>
								<tr>
									<td align="center">3</td>
									<td align="left">General - MBook</td>
									<td align="center"></td>
									<td align="left">Already Generated</td>
									<td align="center" valign="middle"><i class="fa fa-check-circle" style="font-size:25px;color:green"></i></td>
									<td align="center">-- -- --</td>
									<td align="left" class="color1b">Not Generated</td>
									<td align="center"><i class="fa fa-times-circle" style="font-size:25px;color:red"></i></td>
								</tr>
								<tr>
									<td align="center">4</td>
									<td align="left">Steel - MBook</td>
									<td align="center"></td>
									<td align="left">Already Generated</td>
									<td align="center" valign="middle"><i class="fa fa-check-circle" style="font-size:25px;color:green"></i></td>
									<td align="center">-- -- --</td>
									<td align="left" class="color1b">Not Generated</td>
									<td align="center"><i class="fa fa-times-circle" style="font-size:25px;color:red"></i></td>
								</tr>
								<tr>
									<td align="center">5</td>
									<td align="left">Measurements</td>
									<td align="center"> -- -- --</td>
									<td align="left">Measurement Uploaded</td>
									<td align="center"><i class="fa fa-check-circle" style="font-size:25px;color:green"></i></td>
									<td align="left" class="color1b">Measurement Not Uploaded</td>
									<td align="center"><i class="fa fa-times-circle" style="font-size:25px;color:red"></i></td>
								</tr>
								<tr>
									<td align="center" rowspan="" valign="middle">6</td>
									<td align="left" rowspan="" valign="middle">Accounts</td>
									<td align="center" rowspan="" valign="middle"> -- -- --</td>
									<td align="left" class="color1b"> RAB Not Sent to Accounts</td>
									<td align="center"><i class="fa fa-times-circle" style="font-size:25px;color:red"></i></td>
								</tr>
								<tr>
									<td align="left"><font class=""></font></td>
									<td align="center">
										<i class='fa fa-check-circle' style='font-size:25px;color:green'></i>
										<i class='fa fa-check-circle' style='font-size:25px;color:green'></i>
										<i class="fa fa-info-circle" style='font-size:25px;color:#F4AE0B'></i>
										<i class='fa fa-times-circle' style='font-size:25px;color:red'></i>
										<i class='fa fa-times-circle' style='font-size:25px;color:red'></i>
									</td>
								</tr>	
							</table>
							<br/>
							<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
								<div class="buttonsection">
									<input type="submit" class="btn" value=" Accept RAB " name="submit_rbn" id="submit_rbn"/>
								</div>
							</div>
						</div>
					</form>
				</blockquote>
			</div>
		</div>
	</div>
@endsection

