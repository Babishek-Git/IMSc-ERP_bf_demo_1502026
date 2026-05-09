@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
        <!--==============================Content=================================-->
        <div class="content">
          <div class="title">MBook Page Change</div>
            <div class="container_12">
                <div class="grid_12">
                    <blockquote class="bq1">
                        <form name="form" method="post" action="">
                        <div class="container">
							<table width="100%"  bgcolor="#E8E8E8" border="0" cellpadding="0" cellspacing="0" align="center" >
								<tr><td width="22%">&nbsp;</td></tr>
							   	<tr>
									<td>&nbsp;</td> 
								  	<td  class="label">Work Short Name</td>
								  	<td  class="labeldisplay">
									<select name="cmb_work_no" id="cmb_work_no" onChange="find_workname();" class="textboxdisplay" style="width:400px;height:22px;" tabindex="7">
										 <option value="">--------------- Select ---------------</option>
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
								  	<td class="label">&nbsp;</td>
								  	<td class="labeldisplay">
										<span class="label">MB No</span>&nbsp;&nbsp;
										<select name="cmb_MBook_no" id="cmb_MBook_no" class="textboxdisplay" style="width:160px;">
										   <option value="">--- Select ---</option>
										</select>
										&emsp;&nbsp;
										<span class="label">MB Page No</span>&nbsp;&nbsp;
										<input type="text" name="txt_page_no" id="txt_page_no" class="textboxdisplay" style="width:50px;"/>
										&emsp;&emsp;
								  	</td>
								  	<td>&nbsp;</td>
								  	<td>&nbsp;</td>
							   	</tr>
								<tr><td>&nbsp;</td><td></td><td class="labeldisplay" style="color:#797979; font-size:12px">* Please enter previous page number of your starting page no.</td></tr>
							    <tr><td>&nbsp;</td><td></td><td id="val_page" style="color:red; text-align:center;"></td></tr>
							 </table>
                        </div>
						<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
							<div class="buttonsection">
							   <input type="button" name="back" value="Back" id="back" class="backbutton" onClick="goBack();" />
							</div>
							<div class="buttonsection" id="view_btn_section">
							  <input type="submit" class="btn" data-type="submit" value=" Update " name="submit" id="submit"/>
							</div>
						</div>
                        </form>
                    </blockquote>
                </div>
            </div>
        </div>
</form>
@endsection
