@include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.library.binddata') 
@include('layouts.header')
 <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
    <!--==============================header=================================-->
	<form action="" method="post" enctype="multipart/form-data" name="form">
		@include('admin.menu')
        <!--==============================Content=================================-->
        <div class="content">
		   <div class="title">Substitute Item Create</div>
            <div class="container_12">
                <div class="grid_12">
                    <blockquote class="bq1" style="overflow-y:scroll;">
						    <div class="container">
								<div class="row ">
									<div class="div2">&nbsp;</div>
									<div class="div8">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Work Order Details</div></div></div>
										<div class="row innerdiv">
											<div class="row">
												<div class="div4">
													<label for="fname">Work Short Name</label>
												</div>
												<div class="div8">
													<select name="cmb_work_no" id="cmb_work_no" onChange="find_workname();GetSupplementaryWorkOrder();Getexitemnos();" class="textboxdisplay" style="width:470px;height:22px;" tabindex="7">
														<option value="">--------------- Select ---------------</option>
													</select>
													<label id="val_work" style="color:#f10b0b"></label>
												</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">Work Order No.</label>
												</div>
												<div class="div8">
													<input type="text" name="txt_workorder_no" id="txt_workorder_no" readonly="" rows="6" class="textboxdisplay" style="width: 465px;" value="">
												</div>
											</div>
											<!--<div class="row">
												<div class="div4">
													<label for="fname">Name of Work</label>
												</div>
												<div class="div8">
													<textarea name="workname" readonly="" rows="6" class="textboxdisplay" style="width: 465px;"></textarea>
												</div>
											</div>-->
											<div class="row">
												<div class="div4">
													<label for="fname">Supplementary Work Short Name</label>
												</div>
												<div class="div8">
													<select id="workorderno_supp" name="workorderno_supp" onChange="GetSupplementaryWorkOrderDetails()" class="textboxdisplay" style="width:465px;height:22px;" tabindex="7">
													   <option value=""> </option>
													   <option value="">--------------- Select ---------------</option>
                                                    </select> 
													<label id="val_work_supp" style="color:#f10b0b"></label>
												</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">Supplementary Work Order No.</label>
												</div>
												<div class="div8">
													<input type="text" name='txt_workorder_no_supp' id='txt_workorder_no_supp' class="textboxdisplay" value="<?php //if($_GET['sch_id'] != ''){ echo $work_order_no; } ?>" style="width:465px;" readonly=""/>
												</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">Existing Item No</label>
												</div>
												<div class="div4" style="width:160px;">
													<select id="existing_Item" name="existing_Item"  class="textboxdisplay" onChange="item_description(this);" style="width:130px;height:52px;" tabindex="1">
													   <option value=""> </option>
													   <option value=""> --- Select --- </option>
											        </select> 
													<label id="val_ext_item" style="color:#f10b0b"></label>
												</div>
												<div class="div4">	
											       <textarea name="descriptionnotes" id="descriptionnotes" class="textboxdisplay txtarea_style" style="width:310px;height:52px;" rows="7" readonly="readonly" ></textarea>
												</div>
											</div>
											
										</div>
									</div>
								</div>
								<div class="row">
								   <div class="div2" align="center">&nbsp;</div>
									<div class="div8" align="center">
										<div class="innerdiv2">
											<div class="row divhead" align="center">Substitute Item Details</div>
												<div class="row innerdiv">
													<table width="100%" class="label">
														<tr>
															<td align="center" valign="middle">Item No</td>
															<td align="center" valign="middle">Qty</td>
															<td align="center" valign="middle">Rate</td>
															<td align="center" valign="middle">Unit</td>
															<td align="center" valign="middle">Measurement Type</td>
														</tr>
														<tr>
															<td align="center"><input type="text" class="extraItemTextbox" name="txt_sub_item_no" id="txt_sub_item_no"  onBlur="func_itemno(); ExtraItemNo_Validation();" value="<?php if($_GET['sch_id'] != ''){ echo $sno ; } ?>"></td>
															<td align="center"><input type="text" class="extraItemTextbox" name="txt_sub_item_qty" id="txt_sub_item_qty" value="<?php if($_GET['sch_id'] != ''){ echo $total_quantity; } ?>"></td>
															<td align="center"><input type="text" class="extraItemTextbox" name="txt_sub_item_rate" id="txt_sub_item_rate" value="<?php if($_GET['sch_id'] != ''){ echo $rate; } ?>"></td>
															<td align="center"><input type="text" class="extraItemTextbox" name="txt_sub_item_unit" id="txt_sub_item_unit" value=" <?php if($_GET['sch_id'] != ''){ echo $per; } ?>"></td>
															<td align="center">
																 <select id="cmb_sub_item_type" name="cmb_sub_item_type" class="textboxdisplay" style="width:165px;height:20px;" tabindex="3">
																	<option value=""> --- Select -- </option>
							
																		<option value="" > </option>
																	
																 </select>
															</td>
														</tr>
														<tr>
															<td align="left" colspan="5" id="val_sub_item" style="color:red"></td>
														</tr>
														<tr>
															<td align="center" colspan="5">&nbsp;</td>
															
														</tr>
														<tr>
															<td align="center" colspan="1" valign="middle">Item Description</td>
															<td align="center" colspan="4">
																<textarea class="extraItemTextArea" name="txt_sub_item_desc" id="txt_sub_item_desc" rows="3" cols="90"></textarea>
															</td>
														</tr>
														<!--<tr>
															<td align="center" colspan="5">
																<textarea class="extraItemTextArea" name="txt_sub_item_desc" id="txt_sub_item_desc" rows="3" cols="100"></textarea>
															</td>
														</tr>-->
														<tr id="sub_item_desc">
															<td align="left" colspan="5" id="val_sub_item_desc" style="color:red;"></td>
														</tr>
													</table>
												</div>
										</div>
									</div>
								</div>
						   </div>
						   <div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
								<div class="buttonsection">
									 <input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
								</div>
								<div class="buttonsection">
								
									<input type="submit" name="update" id="update" value=" Update "/>
									<input type="hidden" name="txt_sch_id" id="txt_sch_id" value=""/>
									<input type="hidden" name="txt_divid" id="txt_divid" value=""/>
									<input type="hidden" name="txt_sub_divid" id="txt_sub_divid" value=""/>
									<input type="hidden" name="sheetid" id="sheetid" value="/>
									<input type="submit" data-type="submit" value=" Save " name="save" id="save"/>
								
								</div>
						   </div> 
                     </blockquote>
                </div>

            </div>
        </div>
         <!--==============================footer=================================-->
     @include('layouts.footer') 
</form>
</body>
</html>

