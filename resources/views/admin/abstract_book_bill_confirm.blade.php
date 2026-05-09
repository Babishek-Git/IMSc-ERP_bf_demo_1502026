@extends('layouts.dashboard-master')
	
@section('content')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
    <div class="content">
        <div class="title">Pass Order - Confirm</div>
            <div class="container_12">
                <div class="grid_12">
                    <blockquote class="bq1">
                        <form name="form" method="post" action="">
                            <div class="container">
								<br/>
								<div class="grid_2" align="center">&nbsp;</div>
								<div class="grid_8 grid-box" align="center">
									<div class="grid_12 grid-box-header" align="center">
										Pass Order Details
									</div>
									<div class="grid_12 grid-box-body" align="center">
										<div class="grid_12" align="center">&nbsp;</div>
										<div class="grid_3" align="left">&emsp;Work Short Name</div>
										<div class="grid_9" align="center" style="font-weight:200;">
											<select name="cmb_work_no" id="cmb_work_no" onChange="find_workname();check_bill_confirm();" class="textboxdisplay" style="width:95%;height:22px;text-align:left">
												<option value="">---------------------- Select ----------------------</option>
											</select>
										</div>
										<div class="grid_12" align="center">&nbsp;</div>
										
										<div class="grid_3" align="left">&emsp;Work Order No.</div>
										<div class="grid_9" align="center">
											<input type="text" name="txt_workorder_no" id="txt_workorder_no" class="textboxdisplay disable" style="width:95%;" disabled="disabled">
										</div>
										<div class="grid_12" align="center">&nbsp;</div>
										
										<div class="grid_3" align="left" style="line-height:30px;">&emsp;Name of the Work</div>
										<div class="grid_9" align="center">
											<textarea name="workname" class="textboxdisplay txtarea_style disable" style="width:95%;" rows="2" disabled="disabled"></textarea>
										</div>
										<div class="grid_12" align="center">&nbsp;</div>
										
										<div class="grid_3" align="left">&emsp;RAB</div>
										<div class="grid_3" align="center">
											<input type="text" name="txt_rbn" id="txt_rbn" value="" class="textboxdisplay disable" readonly="" style="width:85%;"/>
										</div>
										<div class="grid_3" align="left">&emsp;MBook No.</div>
										<div class="grid_3" align="center">
											<input type="text" name="txt_mbno" id="txt_mbno" value="" class="textboxdisplay disable" readonly="" style="width:85%;"/>
										</div>
										<div class="grid_12" align="center">&nbsp;</div>
										
										<div class="grid_3" align="left">&emsp;End Page</div>
										<div class="grid_3" align="center">
											<input type="text" name="txt_end_page" id="txt_end_page" value="" class="textboxdisplay disable" readonly="" style="width:85%;"/>
										</div>
										<div class="grid_3" align="left">&emsp;Abst. Last Page</div>
										<div class="grid_3" align="center">
											<input type="text" name="txt_abs_last_page" id="txt_abs_last_page" value="" class="textboxdisplay" style="width:85%;"/>
										</div>
										<div class="grid_12" align="center">&nbsp;</div>
										
										<div class="grid_3" align="left">&emsp;Pass Order Amount</div>
										<div class="grid_3" align="center">
											<input type="text" name="txt_po_amt" id="txt_po_amt" value="" class="textboxdisplay disable" style="width:85%;"/>
										</div>
										<div class="grid_3" align="left">&emsp;Pass Order Date</div>
										<div class="grid_3" align="center">
											<input type="text" name="txt_po_date" id="txt_po_date" value="" class="textboxdisplay" style="width:85%;"/>
										</div>
										<div class="grid_12" align="center">&nbsp;</div>
										<div class="PinDt" id="PinDt">
											<!--<div class="grid_3" align="left">&emsp;PIN No.</div>
											<div class="grid_3" align="center">
												<input type="text" name="txt_po_date" id="txt_po_date" value="" class="textboxdisplay" style="width:85%;"/>
											</div>
											<div class="grid_3" align="left">&emsp;Amount</div>
											<div class="grid_3" align="center">
												<input type="text" name="txt_po_date" id="txt_po_date" value="" class="textboxdisplay" style="width:85%;"/>
											</div>
											<div class="grid_12" align="center">&nbsp;</div>-->
										</div>
									</div>
								</div>
								<div class="grid_2" align="center">&nbsp;</div>
                 				<!--<table width="100%"  bgcolor="#E8E8E8" border="0" cellpadding="0" cellspacing="0" align="center" >
                 					<tr><td width="22%">&nbsp;</td></tr>
									<tr>
										<td>&nbsp;</td> 
										<td class="label">Work Short Name</td>
										<td class="labeldisplay">
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
										<td class="label">Work Order No.</td>
										<td class="labeldisplay">
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
										<td  class="label">RAB No.</td>
										<td  class="labeldisplay">
											<input type="text" name="txt_rbn" id="txt_rbn" value="" class="textboxdisplay" readonly="" style="width:50px;"/>
											&emsp;&nbsp;
											<span class="label">MB No.</span>
											<input type="text" name="txt_mbno" id="txt_mbno" value="" class="textboxdisplay" readonly="" style="width:100px;"/>
											&emsp;&emsp;
											<span class="label">End Page</span>
											<input type="text" name="txt_end_page" id="txt_end_page" value="" class="textboxdisplay" readonly="" style="width:50px;"/>
										</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
                					<tr><td>&nbsp;</td><td></td><td id="val_rbn" style="color:red"></td></tr>
									<tr>
										<td>&nbsp;</td>
										<td  class="label">Abstract Last Page</td>
										<td  class="labeldisplay">
											<input type="number" name="txt_abs_last_page" id="txt_abs_last_page" value="" class="textboxdisplay" style="width:100px;"/>
										</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
                					<tr><td>&nbsp;</td><td></td><td id="val_abs_last_page" style="color:red"></td></tr>
									<tr>
										<td>&nbsp;</td>
										<td  class="label">Pass Order Date</td>
										<td  class="labeldisplay">
											<input type="text" name="txt_po_date" id="txt_po_date" value="" class="textboxdisplay" style="width:100px;"/>
										</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
                					<tr><td>&nbsp;</td><td></td><td id="val_po_date" style="color:red"></td></tr>
									<tr>
									   <td colspan="6">
											<input type="hidden" class="text" name="submit" value="true" />
											<input type="hidden" class="text" name="runningbilltext" id="runningbilltext" value=""/>
										</td>
									</tr>
               						<tr><td></td></tr>
         						</table>-->
								<input type="hidden" class="text" name="submit" value="true" />
								<input type="hidden" class="text" name="runningbilltext" id="runningbilltext" value=""/>
                				<input type="hidden" name="txt_empty_page" id="txt_empty_page" value="" class="textboxdisplay" style="width:100px;"/>
								<div style="text-align:center; height:45px; line-height:45px;" class="grid_11 printbutton">
									<div class="buttonsection">
									<input type="button" name="back" value="Back" id="back" class="backbutton" onClick="goBack();" />
									</div>
									<div class="buttonsection" id="view_btn_section" style="display:none">
									<input type="submit" class="btn" data-type="submit" value=" View " name="submit" id="submit"/>
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