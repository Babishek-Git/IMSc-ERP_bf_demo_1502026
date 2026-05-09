@extends('layouts.dashboard-master')
	
@section('content')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
    <div class="content">
        <div class="title">View Electricity Recovery</div>
            <div class="container_12">
                <div class="grid_12">
                    <blockquote class="bq1">
                        <form name="form" method="post" action="ViewElectricityRecoveryList.php">
                            <div class="container">
							<br/>
							<table width="100%"  bgcolor="#E8E8E8" border="0" cellpadding="0" cellspacing="0" align="center" >
								<tr><td width="22%">&nbsp;</td></tr>
									<tr>
										<td>&nbsp;</td> 
										<td  class="label">Work Short Name</td>
										<td  class="labeldisplay">
											<select name="cmb_shortname" id="cmb_shortname" onChange="find_workname()" class="textboxdisplay" style="width:400px;height:22px;" tabindex="7">
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
									<tr><td>&nbsp;</td><td></td><td id="val_workorder" style="color:red"></td></tr>
									<tr>
										<td>&nbsp;&nbsp;</td>
										<td class="label"> Choose  </td>
										<td class="label">
											<input type="radio" name="rad_type" id="rad_all" value="ALL" onClick="func_rab();"/>ALL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<input type="radio" name="rad_type" id="rad_rbn" value="RBN" onClick="func_rab();"/>RAB&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr><td>&nbsp;</td><td></td><td id="val_work" style="color:red"></td></tr>
									<tr id="rab" style="display:none">
										<td>&nbsp;</td>
										<td  class="label">RAB </td>
										<td  class="labeldisplay">
											<select class="textboxdisplay" name="cmb_rbn" id="cmb_rbn" style="width:150px">
												<option value="">--- RAB ---</option>
											</select>
										</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr><td>&nbsp;</td><td></td><td id="val_work" style="color:red"></td></tr>
									<tr>
										<td colspan="6">
											<center>
												<input type="hidden" class="text" name="submit" value="true" />
												<input  type="hidden" class="text" name="runningbilltext" id="runningbilltext" value=""/>
											</center>	    
										</td>
									</tr>
									<tr><td></td></tr>
								</table>
							</div>
							<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
								<div class="buttonsection">
									<input type="button" name="back" value="Back" id="back" class="backbutton" onClick="goBack();" /> 
								</div>
								<div class="buttonsection">
									<input type="submit" class="btn" data-type="submit" value=" View " name="btn_view" id="btn_view"   />
								</div>
							</div>
						</form>
					</blockquote>
				</div>
			</div>
		</div>
	</body>
</html>
@endsection
