@extends('layouts.dashboard-master')
	
@section('content')
<body class="page1" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
    <form action="" method="post" enctype="multipart/form-data" name="form" id="top">
            <div class="content">
                <div class="title">View Measurement Entry</div>		
                <div class="container_12">
                    <div class="grid_12">
                        <blockquote class="bq1">
                          
                                <input type="hidden" name="txt_item_no" id="txt_item_no" value="">
                                <input type="hidden" name="txt_work_no" id="txt_work_no" value="">
								<input type="hidden" name="hid_length" id="hid_length" value="">
                                <div class="container">
                                    <table width="100%" border="1" cellpadding="0" cellspacing="0" align="center" >
                                        <tr><td width="17%">&nbsp;</td>
											<td colspan="4">&nbsp;</td>
                                        </tr>	
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td  class="label" width="17%" nowrap="nowrap">Work Short Name</td>
                                            <td class="">
                                                <select id="workorderno" name="workorderno" onChange="func_item_no();cls(this);" class="textboxdisplay" style="width:593px;height:22px;" tabindex="7">
                                                        <option value=""> --------------- Select --------------- </option>
                                                        
                                              </select>     
                                            </td>
                                            <td class="label">&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr><td>&nbsp;</td><td>&nbsp;</td><td colspan="3" id="val_work" style="color:red"></td></tr>
										<tr>
                                            <td>&nbsp;</td>
                                            <td class="label">Work Order No</td>
                                            <td class="labeldisplay">
                                                <input type="text" name='txt_workorder_no' id='txt_workorder_no' readonly="" class="textboxdisplay" value="" style="width:588px;"/>
                                            </td>
                                            <td class="label">&nbsp;</td>
                                            <td class="label">&nbsp;</td>
                                        </tr>

                                        <tr>
                                            <td>&nbsp;</td>
                                            <td></td>
                                            <td id="val_workorderno" colspan="2" style="color:red"></td>
                                            <td></td>
                                            
                                        </tr>
										<!--<tr>
                                            <td>&nbsp;</td>
                                            <td class="label">Zone Name</td>
                                            <td class="labeldisplay">-->
                                                <select name='cmb_zone_name' id='cmb_zone_name' class="textboxdisplay" value="" style="width:588px; visibility:hidden;" >
													<!--<option value=""> ------------------------ Select Zone Name -------------------------- </option>-->
													<option value="all"> --------------------------------------------- All -------------------------------------------</option>
												</select>
                                            <!--</td>
                                            <td class="label">&nbsp;</td>
                                            <td class="label">&nbsp;</td>
                                        </tr>-->

                                        <!--<tr>
                                            <td>&nbsp;</td>
                                            <td></td>
                                            <td id="val_zone_name" colspan="2" style="color:red"></td>
                                            <td></td>
                                            
                                        </tr>-->

                                        <tr>
                                            <td>&nbsp;</td>
                                            <td  class="label" width="18%" nowrap="nowrap">Measurement Type</td>
                                            <td class="label">
                                                <input type="radio" name="rad_measurementtype" id="rad_steel" value="S" onClick="func_item_no();">Steel&nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="rad_measurementtype" id="rad_others" value="G" onClick="func_item_no();">General 
                                           		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												From Date
												&nbsp;&nbsp;
											    <input type="text" name='fromdate' id='fromdate' placeholder='dd-mm-yyyy' class="textboxdisplay" value="" style="width:95px; text-align:center"/>
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                To Date
												&nbsp;&nbsp;
                                                <input type="text" name='todate' id='todate' placeholder='dd-mm-yyyy' class="textboxdisplay" value="" style="width:95px; text-align:center"/>
											</td>
                                            <td>&nbsp;</td>
											<td>&nbsp;</td>
                                        </tr>
                                        <tr><td>&nbsp;</td><td>&nbsp;</td><td colspan="3" id="val_measuretype" style="color:red"></td></tr>


                                        <tr>
                                            <td>&nbsp;</td>
                                            <td  class="label" nowrap="nowrap">Item No.</td>
                                            <td class="label"  colspan="3">
                                                <select onBlur="display();" name="itemno" id="itemno" class="textboxdisplay" onChange="cls(this);func_subitem_no(); item_description(this);" style="width:120px;height:22px;" tabindex="7">
                                                    <option value="0">Item No</option>
                                                </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                           <!-- &nbsp;&nbsp;&nbsp;&nbsp;Sub Item No.-->
                                            
                                                <select onBlur="display();" name="subitemno" id="subitemno" class="textboxdisplay" style="width:120px;height:22px;" onChange="cls(this);find_subsubitem(this); item_description(this);">
                                                    <option value="0">Sub Item 1</option>
                                                </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                           
                                                <select onBlur="display();" name="subsubitemno" id="subsubitemno" class="textboxdisplay" style="width:120px;height:22px;"  onChange="cls(this); find_subsubsubitem(this); item_description(this);">
                                                    <option value="0">Sub Item 2</option>
                                                </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<select onBlur="display();" name="subsubsubitemno" id="subsubsubitemno" class="textboxdisplay" style="width:120px;height:22px;"  onChange="cls(this); item_description(this);">
                                                    <option value="0">Sub Item 3</option>
                                                </select>
                                            </td>
                                        </tr>

                                         <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td style="color:red" colspan="3">
											<span id="val_item"></span>
											<span id="val_sub"></span>
											<span id="val_subsub"></span>
											<span id="val_subsubsub"></span>
											</td>
                                        </tr>

                    
										<tr>
                                            <td>&nbsp;</td>
                                            <td  class="label">Item Level Desc.</td>
                                            <td  class="labeldisplay">
                                               <!-- <input type="text" name='descriptionnotes' id='descriptionnotes' class="textboxdisplay" value="" size="55"/> -->
                                                <textarea name="descriptionnotes" id="descriptionnotes" readonly="" class="textboxdisplay txtarea_style" style="width: 591px;" rows="5"></textarea>
                                            </td>
                                            <td class="label">&nbsp;</td> 
                                            <td width="12%">&nbsp;
<!--                                                <input type="text" name="remarks" id="remarks" class="textboxdisplay" size="10" readonly="" />-->
                                                
                                            </td>
											
										</tr>
                                        <tr><td colspan="5">&nbsp;&nbsp;</td></tr>
										<tr id="subitem_1_desc" class="hide">
                                            <td>&nbsp;</td>
                                            <td  class="label">Sub Level 1 Desc.</td>
                                            <td  class="labeldisplay">
                                               <!-- <input type="text" name='descriptionnotes' id='descriptionnotes' class="textboxdisplay" value="" size="55"/> -->
                                                <textarea name="subitem_1_desc" id="subitem_1_desc" readonly="" class="textboxdisplay txtarea_style" style="width: 591px;" rows="3"></textarea>
                                            </td>
                                            <td class="label">&nbsp;</td> 
                                            <td width="12%">&nbsp;
<!--                                                <input type="text" name="remarks" id="remarks" class="textboxdisplay" size="10" readonly="" />-->
                                                
                                            </td>
											
										</tr>
                                        <tr id="subitem_1" class="hide"><td colspan="5">&nbsp;&nbsp;</td></tr>
										<tr id="subitem_2_desc" class="hide">
                                            <td>&nbsp;</td>
                                            <td  class="label">Sub Level 2 Desc.</td>
                                            <td  class="labeldisplay">
                                               <!-- <input type="text" name='descriptionnotes' id='descriptionnotes' class="textboxdisplay" value="" size="55"/> -->
                                                <textarea name="subitem_2_desc" id="subitem_2_desc" readonly="" class="textboxdisplay txtarea_style" style="width: 591px;" rows="3"></textarea>
                                            </td>
                                            <td class="label">&nbsp;</td> 
                                            <td width="12%">&nbsp;
<!--                                                <input type="text" name="remarks" id="remarks" class="textboxdisplay" size="10" readonly="" />-->
                                                
                                            </td>
											
										</tr>
                                        <tr id="subitem_2" class="hide"><td colspan="5">&nbsp;&nbsp;</td></tr>
										<tr id='subitem_3_desc' class="hide">
                                            <td>&nbsp;</td>
                                            <td  class="label">Sub Level 3 Desc.</td>
                                            <td  class="labeldisplay">
                                               <!-- <input type="text" name='descriptionnotes' id='descriptionnotes' class="textboxdisplay" value="" size="55"/> -->
                                                <textarea name="subitem_3_desc" id="subitem_3_desc" readonly="" class="textboxdisplay txtarea_style" style="width: 591px;" rows="3"></textarea>
                                            </td>
                                            <td class="label">&nbsp;</td> 
                                            <td width="12%">&nbsp;
<!--                                                <input type="text" name="remarks" id="remarks" class="textboxdisplay" size="10" readonly="" />-->
                                                
                                            </td>
											
										</tr>
                                        <tr id="subitem_3" class="hide"><td colspan="5">&nbsp;&nbsp;</td></tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td class="label">Short Notes</td>
                                            <td class="labeldisplay">
                                                <input type="text" name='shortnotes' id='shortnotes' readonly="" class="textboxdisplay" value="" style="width:586px;height:22px;"/>
                                            </td>
                                            <td class="label">&nbsp;</td>
                                            <td class="label">&nbsp;</td>
                                        </tr>

                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td id="val_shortnotes" colspan="2" style="color:red"></td>
                                            <td>&nbsp;</td>
                                            
                                        </tr>
                                        <!--<tr>
                                            <td>&nbsp;</td>
                                            <td class="label">From Date</td>
                                            <td class="label">
                                                <input type="text" name='fromdate' id='fromdate' class="textboxdisplay" value="" style="width:150px;"/>
                                                <span class=""> &emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&emsp;&emsp;&emsp;To Date</span>
                                                &emsp;&emsp;&emsp;&nbsp;
                                                <input type="text" name='todate' id='todate' class="textboxdisplay" value="" style="width:150px;"/>
                                            </td>
                                            <td class="label">&nbsp;</td>
                                            <td class="label">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td></td>
                                            <td id="val_shortnotes" colspan="2" style="color:red"></td>
                                            <td></td>
                                            
                                        </tr>-->
                                        <tr>
                                            <td colspan="5">
                                                <center>
                                                    <input type="hidden" class="text" name="submit" value="true" />
                                                    <input type="hidden"  id="sno_hide" name="sno_hide">
                                                                                              <!--<button type="button" class="btn" id="submit" data-type="submit" value=" Submit ">Submit</button>-->
                                                       <!--<input type="submit" name="submit" value=" View " id="submit" onClick="getlength();"/>&nbsp;&nbsp;&nbsp;
													   <input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>-->
                                                </center>
                                            </td>
                                        </tr>	 
                                  </table>
								  <div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
									<div class="buttonsection">
									<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
									</div>
									<div class="buttonsection">
									<input type="submit" name="submit" value=" View " id="submit" onClick="getlength();"/>
									</div>
								</div>
                           </div>
                        </blockquote>
                    </div>
                </div>
            </div>
		</form>
</body>
</html>
@endsection