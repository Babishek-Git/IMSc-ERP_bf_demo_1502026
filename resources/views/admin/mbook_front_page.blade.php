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
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> MBook Front Page - Generate </div></div></div>
								<div class="card-body padding-1 ChartCard" id="CourseChart">
									<div class="divrowbox innerdiv pt-2">
										<br/>
										<table width="100%"  bgcolor="#E8E8E8" border="0" cellpadding="0" cellspacing="0" align="center" >
											<tr><td width="22%">&nbsp;</td></tr>
											<tr>
												<td>&nbsp;</td> 
												<td  class="label">Work Short Name</td>
												<td  class="labeldisplay">
													<select name="cmb_work_no" id="cmb_work_no" onChange="find_workname()" class="textboxdisplay" style="width:465px;height:22px;" tabindex="7">
														<option value="">----------------------- Select ------------------------</option>
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
													<input type="text" name="txt_workorder_no" id="txt_workorder_no" class="textboxdisplay" style="width:465px;" disabled="disabled">
												</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
											<tr><td>&nbsp;</td><td></td><td id="val_workorder" style="color:red"></td></tr>
											<tr>
												<td>&nbsp;</td>
												<td  class="label">Name of the Work </td>
												<td  class="labeldisplay">
													<textarea name="workname" class="textboxdisplay txtarea_style" style="width: 465px;" rows="5" disabled="disabled"></textarea>
												</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
											<tr><td>&nbsp;</td><td></td><td id="val_workname" style="color:red"></td></tr>
											<tr> 
												<td>&nbsp;</td> 
												<td  class="label">Measurement Book Type </td>
												<td  class="labeldisplay">
													<select name="cmb_mbook_type" id="cmb_mbook_type" class="textboxdisplay" style="width:465px;height:22px;" tabindex="7">
														<option value="">----------------------- Select ------------------------</option>
														<!--option value="G">General M.Book</option>
														<option value="S">Steel M.Book</option>
														<option value="A">Abstract M.Book</option>
														<option value="E">Escalation M.Book</option--->
													</select>
												</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td>&nbsp;&nbsp;</td><td width="25%" class="label"></td>
												<td id="val_mbooktype" style="color:red">
											</tr>
											<tr> 
												<td>&nbsp;</td> 
												<td  class="label">Measurement Book No. </td>
												<td  class="labeldisplay">
													<input type="text" name="txt_mbook_name" id="txt_mbook_name" value="IGCAR/CIVIL/CEG/" class="textboxdisplay" style="width:300px;">
												<!--<input type="text" name="txt_mbook_no" id="txt_mbook_no" class="textboxdisplay" style="width:82px;" readonly="">-->
													<select name="txt_mbook_no" id="txt_mbook_no" class="textboxdisplay" style="width:152px;">
														<option value=""> -- Select -- </option>
													</select>
												</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td>&nbsp;&nbsp;</td><td width="25%" class="label"></td>
												<td id="val_mbookname" style="color:red">
											</tr>
											<tr> 
												<td>&nbsp;</td> 
												<td  class="label">Measurement Book Type </td>
												<td  class="labeldisplay">
													<select name="cmb_issue_authority" id="cmb_issue_authority" class="textboxdisplay" style="width:465px;height:22px;" tabindex="7">
														<option value="">----------------------- Select -----------------------</option>
														<!--option value="DH">N. Suresh. Head,CED</option--->
													</select>
												</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td>&nbsp;&nbsp;</td><td width="25%" class="label"></td>
												<td id="val_mbooktype" style="color:red">
											</tr>
											<tr>
												<td>&nbsp;</td>
												<td  class="label">MBook Date</td>
												<td  class="labeldisplay">
													<input type="text" name="txt_mbook_date" id="txt_mbook_date" class="textboxdisplay" style="width:120px;">
												</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
											<tr><td>&nbsp;</td><td></td><td id="val_workorder" style="color:red"></td></tr>
											<tr>
												<td colspan="6">
													<center>
														<input type="hidden" class="text" name="submit" value="true" />
														<input  type="hidden" class="text" name="runningbilltext" id="runningbilltext" value=""/>
													<!--<input type="submit" class="btn" data-type="submit" value=" View " name="submit" id="submit"   />&nbsp;&nbsp;&nbsp;
													<input type="button" name="back" value="Back" id="back" class="backbutton" onClick="goBack();" />--> 
													</center>	    
												</td>
											</tr>
										</table>
										<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
											<!-- <div class="buttonsection">
												<input type="button" name="back" value="Back" id="back" class="backbutton" onClick="goBack();" />
											</div> -->
											<div class="buttonsection">
												<input type="submit" class="btn" data-type="submit" value=" View " name="submit" id="submit"   />
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
</html>
@endsection
