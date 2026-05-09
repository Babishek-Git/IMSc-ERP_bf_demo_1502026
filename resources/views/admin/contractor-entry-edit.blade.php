@include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.library.binddata') 
@include('layouts.library.common')
@include('layouts.header')
<link type='text/css' href='css/basic.css' rel='stylesheet' media='screen' />
<script type='text/javascript' src='js/basic_model_jquery.js'></script>
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">     
        <form action="" method="post" enctype="multipart/form-data" name="phuploader">
           @include('admin.menu')
            <div class="content">
               <div class="title">Contractor Entry</div>
                 <div class="container_12">
                    <div class="grid_12">
					   <div align="right">&nbsp;</div>
                          <blockquote class="bq1" style="overflow-y:scroll">
							 <input type="hidden" name="hid_sheetid" id="hid_sheetid" value="">
                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="color1">
                                  <tr><td width="18%">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
									<tr>
										<td>&nbsp;</td>
										<td class="label">Contractor Name</td> 
										<td><input type="text"  name='txt_cont_name' id='txt_cont_name' class="textboxdisplay" value="" style="width: 465px;"></td>
									</tr>
									<tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_woredrno" style="color:red" colspan="">&nbsp;</td></tr>
									<tr>
										<td>&nbsp;</td>
										<td class="label">Contractor Address</td>
										<td><textarea name='txt_cont_add' id='txt_cont_add' class="textboxdisplay" rows="4" style="width: 465px;"></textarea></td>
									</tr>
									<tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_wname" style="color:red" colspan="">&nbsp;</td></tr>
									<tr>
										<td>&nbsp;</td>
										<td class="label">Bank Account No.</td>
										<td><input type="text" name='txt_bank_acc_no' id='txt_bank_acc_no' class="textboxdisplay" value="" style="width: 465px;"></td>
									</tr>
									<tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_shortname" style="color:red" colspan="">&nbsp;</td></tr>
									<tr>
										<td>&nbsp;</td>
										<td class="label">Bank Name</td>
										<td><input type="text" name='txt_bank_name' id='txt_bank_name' class="textboxdisplay" value="" style="width: 465px;"></td>
									</tr>
									<tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_techsno" style="color:red" colspan="">&nbsp;</td></tr>
									<tr>
										<td>&nbsp;</td>
										<td class="label">Branch Name</td>
										<td> <input type="text" name='txt_branch_name' id='txt_branch_name' class="textboxdisplay"  value="" style="width: 465px;"></td>
									</tr>
									<tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_aggno" style="color:red" colspan="">&nbsp;</td></tr>
									<tr> 
										<td>&nbsp;</td>
										<td class="label">IFSC No.</td>
										<td><input type="text" name='txt_ifsc_no' id='txt_ifsc_no' class="textboxdisplay" value="" style="width: 465px;"></td>
									</tr>
									<tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_conname" style="color:red" colspan="">&nbsp;</td></tr>
									<tr> 
										<td>&nbsp;</td>
										<td class="label">PAN No.</td>
										<td><input type="text" name='txt_pan_no' id='txt_pan_no' class="textboxdisplay" value="" style="width: 465px;"></td>
									</tr>
									<tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_conname" style="color:red" colspan="">&nbsp;</td></tr>
									<tr> 
										<td>&nbsp;</td>
										<td class="label">GST No.</td>
										<td><input type="text" name='txt_gst_no' id='txt_gst_no' class="textboxdisplay" value="" style="width: 465px;"></td>
									</tr>
									<tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_conname" style="color:red" colspan="">&nbsp;</td></tr>
                                </table>
									<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
									<div class="buttonsection">
										<input type="hidden" class="textboxdisplay" name="cont_id" id="cont_id" value="">
										<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/></div>
									<div class="buttonsection"><input type="button" class="backbutton" name="View" id="View" value="View" onClick="View_page();"/></div>
									<div class="buttonsection">
										<input type="submit" name="update" id="update" value=" Update "/>
									</div>
								</div>
                          </blockquote>
                     </div>
                 </div>
            </div>
             @include('layouts.footer')
			
        </form>
    </body>
</html>
