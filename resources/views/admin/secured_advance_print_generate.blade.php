@extends('layouts.dashboard-master')
@section('content')
<form name="form" method="get" action="">
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1" style="overflow:auto">
					<div class="container">
						<div class="row ">
							<div class="div1"></div>
							<div class="div10 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> Secured Advance Print </div></div></div>
								<div class="card-body padding-1 ChartCard" id="CourseChart">
									<div class="divrowbox innerdiv pt-2">
											<br/>
										<table width="100%"  bgcolor="#E8E8E8" border="0" cellpadding="0" cellspacing="0" align="center" >
											<tr><td width="22%">&nbsp;</td></tr>
											<tr>
												<td>&nbsp;</td> 
												<td  class="label">Work Short Name</td>
												<td  class="labeldisplay">
												<select name="cmb_shortname" id="cmb_shortname" onChange="find_workname();GetSecAdvRAB();" class="textboxdisplay" style="width:400px;height:22px;" tabindex="7">
												<option value="">-------------------- Select --------------------</option>
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
												<input type="text" name="txt_workorder_no" id="txt_workorder_no" class="textboxdisplay" style="width:397px;" disabled="disabled">
												</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
											<tr><td>&nbsp;</td><td></td><td id="val_workorder" style="color:red"></td></tr>			
											<tr>
												<td>&nbsp;</td>
												<td  class="label">Name of the Work </td>
												<td  class="labeldisplay">
												<textarea name="workname" class="textboxdisplay txtarea_style" style="width: 400px;" rows="5" disabled="disabled"></textarea>
												</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
											<tr><td>&nbsp;</td><td></td><td id="val_work" style="color:red"></td></tr>
											<tr>
												<td>&nbsp;</td>
												<td class="label">RAB</td>
												<td class="">
													<select name="cmb_rbn" id="cmb_rbn" style="width:210px;" class="textboxdisplay">
														<option value="">------ Select ------</option>
													</select>
												</td>
											</tr>
											<tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_rbn" style="color:red" colspan="">&nbsp;</td></tr>
										</table>
										<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
											<!-- <div class="buttonsection">
												<input type="button" name="back" value="Back" id="back" class="backbutton" onClick="goBack();" />
											</div> -->
											<div class="buttonsection" id="view_btn_section">
												<input type="submit" class="btn" value=" View " name="btn_view" id="btn_view"/>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="div1"></div>
						</div>
					</div>
				</blockquote>
			</div>
		</div>
	</div>
</form>  
@endsection
