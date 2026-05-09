@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.library.binddata') 
@include('layouts.library.common')
@include('layouts.header')
<link rel="stylesheet" href="sweetalert2/dist/sweetalert2.min.css">
<link rel="stylesheet" href="sweetalert2/dist/sweetalert2.css">
<script src="sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="sweetalert2/dist/sweetalert2.common.js"></script>
<script src="sweetalert2/dist/sweetalert2.js"></script>
<script src="sweetalert2/dist/sweetalert2.min.js"></script>
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
 @include('admin.menu')
    <div class="content">
        <div class="title">Check Measurement - Level Assign</div>
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
											<select name="cmb_shortname" id="cmb_shortname" onChange="workorderdetail(); CheckMeasureLevel();" class="textboxdisplay" style="width:470px;height:22px;" tabindex="7">
												<option value="">-------------- Select Work Short Name ---------------</option>
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
									   	<td  class="labeldisplay"><input type="text" name="txt_workorder" id="txt_workorder" readonly="" rows="6" class="textboxdisplay" style="width: 465px;"></td>
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
									   	<td  class="labeldisplay"><textarea name="txt_workname" id="txt_workname" readonly="" rows="6" class="textboxdisplay" style="width: 465px;"></textarea></td>
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
									   	<td  class="label">Select Level</td>
									   	<td  class="labeldisplay">
											<!--<select name="cmb_staff[]" id="cmb_staff" multiple="multiple" style="width:465px;height:150px;" class="textboxdisplay"  onChange="func_mbook()">
											</select>-->
											<div class="label labelDiv"><input type="checkbox" name="level_check[]" id="level_check1" value="1">&nbsp;&nbsp;Scientific Assistant</div>
											<div class="label labelDiv"><input type="checkbox" name="level_check[]" id="level_check2" value="2">&nbsp;&nbsp;Site Engineer</div>
											<div class="label labelDiv"><input type="checkbox" name="level_check[]" id="level_check3" value="3">&nbsp;&nbsp;Engineer Incharge</div>
											<div class="label labelDiv"><input type="checkbox" name="level_check[]" id="level_check4" value="4">&nbsp;&nbsp;Superindent Engineer</div>
										</td>
									   	<td>&nbsp;</td>
									   	<td>&nbsp;</td>
									</tr>
                                    <tr>
										<td>&nbsp;</td>
										<td></td>
										<td id="val_staff" style="color:red" colspan="3"></td>
									</tr>
									<tr>
										<td>&nbsp;&nbsp;</td>
										<td width="" class="label"></td>
										<td id="val_rbn" style="color:red" colspan="3"></td>
									</tr>
                                    <tr>
                                       <td colspan="5">
										</td>
                                   </tr>
                                </table>
                            </div>
							<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
								<div class="buttonsection">
									<input type="submit" data-type="submit" value=" Save " name="submit" id="submit"/>
								</div>
								<div class="buttonsection">
									<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
								</div>
							</div>
                        	<input type="hidden" name="txt_rbn" id="txt_rbn">	
                        </form>
                    </blockquote>
                </div>

            </div>
        </div>
        @include('layouts.footer')
    </body>
</html>

