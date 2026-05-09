@extends('layouts.dashboard-master')
@section('content')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<div class="content">
        <div class="title">Theoritical Cement Value - View</div>
		<div class="container_12">
            <div class="grid_12">
                <blockquote class="bq1">
                    <form name="form" method="post" action="">
                        <div class="container">
                            <table width="100%"  bgcolor="#E8E8E8" border="0" cellpadding="0" cellspacing="0" align="center" >
                                <tr>
									<td width="21%">&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>&nbsp;</td> 
									<td  class="label">Work Short Name </td>
									<td  class="labeldisplay">
										<select name="cmb_work_no" id="cmb_work_no" class="textboxdisplay" style="width:470px;height:22px;" tabindex="7" onChange="find_workname();">
											<option value="">--------------- Select ---------------</option>
										</select>
									</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								 </tr>
								 <tr>
									<td>&nbsp;</td>
									<td></td>
									<td id="val_work" style="color:red" colspan="3"></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td  class="label">Work Order No. </td>
									<td  class="labeldisplay"><input type="text" name="txt_workorder_no" id="txt_workorder_no" rows="6" class="textboxdisplay" style="width: 465px;"></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
                                <tr>
									<td>&nbsp;</td>
									<td></td>
									<td id="val_work" style="color:red" colspan="3"></td>
								</tr>
								 <tr>
									<td>&nbsp;</td>
									<td  class="label">Name of the Work </td>
									<td  class="labeldisplay"><textarea name="workname" rows="6" class="textboxdisplay" style="width: 465px;"></textarea></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
                                <tr>
									<td>&nbsp;</td>
									<td></td>
									<td id="val_work" style="color:red" colspan="3"></td>
								</tr>
								<tr>
									<td>&nbsp;&nbsp;</td>
									<td width="" class="label"></td>
									<td id="val_rbn" style="color:red" colspan="3"></td>
								</tr>
                                <tr>
                                    <td colspan="5">
										<input type="hidden" class="text" name="submit" value="true" />
										<input  type="hidden" class="text" name="runningbilltext" id="runningbilltext" value=""/>
									</td>
                                </tr>
                                <tr>
									<td colspan="5"></td>
							 </tr>
                          </table>
							<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
								<div class="buttonsection">
									<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
								</div>
								<div class="buttonsection">
									<input type="submit" data-type="submit" value=" View " name="submit" id="submit"/>
								</div>
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
