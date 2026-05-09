@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.library.binddata')
@include('layouts.library.sysdate')
@include('layouts.header')
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
       @include('admin.menu')
        <!--==============================Content=================================-->
        <div class="content">
            <div class="title">RAB Initiation </div>
            <div class="container_12">
                <div class="grid_12">
                    <blockquote class="bq1" style="overflow:auto">
                        <form name="form" method="post" action="" >
                            <div class="container">
                                <table width="100%"  bgcolor="#E8E8E8" border="0" cellpadding="0" cellspacing="0" align="center" >
                                    <tr><td>&nbsp;</td></tr>
                                    <tr> 
                                        <td width="20%">&nbsp;</td> 
                                        <td  class="label">Date</td>

                                        <td><input type="text" name="txt_date" disabled="disabled" id="txt_date" class="textboxdisplay" value="<?php //echo date('d/m/Y') ?>" size="15"/>				                 
                                            </td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr><td>&nbsp;</td></tr>
                                    <tr> 
                                        <td>&nbsp;</td> 
                                        <td  class="label">Work Order No </td>
                                        <td  class="labeldisplay">
                                            <select name="wordorderno" id="wordorderno"  class="textboxdisplay" tabindex="1" onChange="func_find_rbn();" style="width:502px;height:22px;">
                                        		<option value=""> --------------- Select --------------- </option>
                                            </select></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr><td>&nbsp;</td><td></td><td colspan="3" id="val_work" style="color:red"></td></tr>
									<tr>
                                        <td>&nbsp;</td>
                                        <td  class="label">Work Order No.</td>
                                        <td  class="labeldisplay">
										<input type="text" name="txt_workorder_no" id="txt_workorder_no" class="textboxdisplay" style="width: 496px;" readonly="">
										</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td  class="label">Name of the Work </td>
                                        <td  class="labeldisplay">
										<textarea name="workname" class="textboxdisplay txtarea_style" id="workname" rows="4" style="width: 500px;" disabled="disabled"></textarea>
										</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr> 
                                        <td>&nbsp;</td> 
                                        <td  class="label">Running Account Bill No </td>

                                        <td  class="labeldisplay">
										<input type="number" name="rbnno" id="rbnno" class="textboxdisplay" style="width:123px" tabindex="5"/>
										&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
										<input type="checkbox" name="ch_final_bill" id="ch_final_bill" class="textboxdisplay" value="Y" >
										&nbsp; <span class="label">Is Final Bill</span>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>

                                    <tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td colspan="3"><span id="rbn_error" style="color:red; font-weight:bold"></span></td>
									</tr>
									<!--<tr> 
                                        <td>&nbsp;</td> 
                                        <td  class="label">&nbsp;</td>
                                        <td  class="labeldisplay">
										<input type="checkbox" name="ch_final_bill" id="ch_final_bill" class="textboxdisplay" value="Y" >
										&nbsp; <span class="label">Is Final Bill</span>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
									
									<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>-->
                                    <tr class="hide fbrow" id="hide_row1"> 
                                        <td>&nbsp;</td> 
                                        <td  class="label">Actual Completion Date</td>

                                        <td  class="labeldisplay">
										<input type="text" name="txt_act_doc" id="txt_act_doc" class="textboxdisplay" style="width:123px" tabindex="5"/>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
									<tr class="hide fbrow" id="hide_row2">
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td><span id="val_act_doc" style="color:red; font-weight:bold"></span></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<!--<tr class="hide fbrow"> 
                                        <td>&nbsp;</td> 
                                        <td  class="label">Completion Certificate </td>

                                        <td  class="labeldisplay">
										<textarea name="txt_comp_cert" id="txt_comp_cert" class="textboxdisplay" style="width:402px" rows="7" tabindex="6"><?php echo $Content; ?></textarea>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>-->
                                </table>
								<?php 
									$Content = " Certified that the work has been physically completed within the date due according to the contract i.e. <span id='compCertDate' style='font-weight:bold'></span> and that no defects are apparent and the contractor has removed from the premises on which the work was being executed all the scaffolding, surplus materials and rubbish and cleaned all the dirt from all woodwork, doors, windows, walls floors or other parts of the building, in upon or about which the work was to be executed or of which he had possession for the purpose of execution thereof. This is however, subject to the measurement being recorded and quality being checked by the competent authority.";
								?>					
								<table width="100%"  bgcolor="#E8E8E8" border="0" cellpadding="0" cellspacing="0" align="center" class="hide fbrow">
									<tr><td class="label" align="center"><div style="white-space:normal; text-align:justify; width:60%; padding:5px;">Completion Certificate</div></td></tr>
									<tr>
										<td class="label" align="center"><div contenteditable="true" style="white-space:normal; text-align:justify; width:60%; border:1px solid #78C5FE; border-radius:5px; padding:5px; font-weight:500" id="CompCertContent"><?php //echo $Content; ?></div></td>
									</tr>
								</table>
                            </div>
							<input type="hidden" name="txt_rbn_list" id="txt_rbn_list">
							<input type="hidden" name="txt_rbn_list2" id="txt_rbn_list2">
							<input type="hidden" name="txt_comp_cert_content" id="txt_comp_cert_content">
							<input type="hidden" name="txt_comp_cert_content_static" id="txt_comp_cert_content_static" value="">
							<input type="hidden" name="txt_work_commence_dt" id="txt_work_commence_dt">
							<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
								<div class="buttonsection">
								<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
								</div>
								<div class="buttonsection" style="width:110px">
								<input type="submit" class="btn" data-type="submit" value="Next" name="btn_generate" id="btn_generate" onMouseOver="checkmeasurement();"/>
								</div>
							</div>
                    	</form>
                    </blockquote>
                </div>

            </div>
        </div>
<!--==============================footer=================================-->
@include('layouts.footer')
</body>
</html>

