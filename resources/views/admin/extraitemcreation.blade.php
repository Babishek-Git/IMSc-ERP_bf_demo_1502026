@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<form action="" method="post" enctype="multipart/form-data" name="form" id="top">

            <!--==============================Content=================================-->
    <div class="content">
         <div class="title">Additional Qty Beyond the Deviation Limit <?php //print_r($MbHead); ?> </div>		
            <div class="container_12">
                <div class="grid_12">
                     <blockquote class="bq1" style="overflow-y:auto;">
                        <input type="hidden" name="txt_item_no" id="txt_item_no" value="">
                         <input type="hidden" name="txt_work_no" id="txt_work_no" value="">
                            <div class="container">
                                <table width="100%" border="1" cellpadding="0" cellspacing="0" align="center">
                                    <tr><td width="24%">&nbsp;</td></tr>	
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td  class="label" width="14%" nowrap="nowrap">Work Short Name</td>
                                        <td class="labeldisplay">
											<select id="workorderno" name="workorderno" onChange="func_item_no();cls(this)" class="textboxdisplay" style="width:505px;height:22px;" tabindex="7">
                                                <option value="">--------------- Select ---------------</option>
                                                @if(isset($sheetquery))
                                                    @foreach($sheetquery as $row)
                                                    @php
                                                        $assigned_staff = $row->assigned_staff;
                                                        $AssignStaff = explode(",",$assigned_staff);
                                                        $sel = "";
                                                        if((in_array(session('WcmsStaffId'),$AssignStaff)) || (session('isadmin') == 1))
                                                        {
                                                            /*if($workordernolistvalue == $row->sheetid)
                                                            {
                                                                $sel = "selected";
                                                            }
                                                            else
                                                            {
                                                                $sel = "";
                                                            }*/
                                                    @endphp
                                                    <option value="{{ $row->sheetid }}" {{ $sel }}>{{ $row->short_name }}</option>
                                                    @php
                                                        }
                                                    @endphp
                                                    @endforeach
                                                @endif
											</select>     
                                        </td>
                                         <td class="label">&nbsp;</td>
                                         <td>&nbsp;</td>
									</tr>
                                    <tr><td>&nbsp;</td><td></td><td colspan="3" id="val_work" style="color:red"></tr>
										<tr>
                                           <td>&nbsp;</td>
                                           <td class="label">Work Order No</td>
                                           <td class="labeldisplay">
                                              <input type="text" name='txt_workorder_no' id='txt_workorder_no' class="textboxdisplay" value="" style="width:500px;"/>
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
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td  class="label" nowrap="nowrap">Item No.</td>
                                            <td class="label"  colspan="3">
                                                <select onBlur="display();" name="itemno" id="itemno" class="textboxdisplay" onChange="cls(this);func_subitem_no(this);item_description(this);" style="width:100px;height:22px;" tabindex="7">
                                                    <option value="0">Item No</option>
                                                </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	

                                           <!-- &nbsp;&nbsp;&nbsp;&nbsp;Sub Item No.-->
                                            
                                                <select onBlur="display();" name="subitemno" id="subitemno" class="textboxdisplay" style="width:100px;height:22px;" onChange="cls(this);find_subsubitem(this); item_description(this);">
                                                    <option value="0">Sub Item 1</option>
                                                </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                           
                                                <select onBlur="display();" name="subsubitemno" id="subsubitemno" class="textboxdisplay" style="width:100px;height:22px;"  onChange="cls(this);find_subsubsubitem(this); item_description(this);">
                                                    <option value="0">Sub Item 2</option>
                                                </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<select onBlur="display();" name="subsubsubitemno" id="subsubsubitemno" class="textboxdisplay" style="width:100px;height:22px;"  onChange="item_description(this);">
                                                    <option value="0">Sub Item 3</option>
                                                </select>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td style="color:red">
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
                                                <textarea name="descriptionnotes" id="descriptionnotes" class="textboxdisplay txtarea_style" style="width: 505px;" rows="8"></textarea>
                                            </td>
                                            <td class="label">&nbsp;</td> 
                                            <td width="20%">
<!--                                                <input type="text" name="remarks" id="remarks" class="textboxdisplay" size="10" readonly="" />-->
                                                
                                            </td>
											
										</tr>
                                        <tr><td colspan="5">&nbsp;&nbsp;</td></tr>
										<tr id="subitem_1_desc" class="hide">
                                            <td>&nbsp;</td>
                                            <td  class="label">Sub Level 1 Desc.</td>
                                            <td  class="labeldisplay">
                                               <!-- <input type="text" name='descriptionnotes' id='descriptionnotes' class="textboxdisplay" value="" size="55"/> -->
                                                <textarea name="subitem_1_desc" id="subitem_1_desc" class="textboxdisplay txtarea_style" style="width: 505px;" rows="3"></textarea>
                                            </td>
                                            <td class="label">&nbsp;</td> 
                                            <td width="20%">
<!--                                                <input type="text" name="remarks" id="remarks" class="textboxdisplay" size="10" readonly="" />-->
                                                
                                            </td>
											
										</tr>
                                        <tr id="subitem_1" class="hide"><td colspan="5">&nbsp;&nbsp;</td></tr>
										<tr id="subitem_2_desc" class="hide">
                                            <td>&nbsp;</td>
                                            <td  class="label">Sub Level 2 Desc.</td>
                                            <td  class="labeldisplay">
                                               <!-- <input type="text" name='descriptionnotes' id='descriptionnotes' class="textboxdisplay" value="" size="55"/> -->
                                                <textarea name="subitem_2_desc" id="subitem_2_desc" class="textboxdisplay txtarea_style" style="width: 505px;" rows="3"></textarea>
                                            </td>
                                            <td class="label">&nbsp;</td> 
                                            <td width="20%">
<!--                                                <input type="text" name="remarks" id="remarks" class="textboxdisplay" size="10" readonly="" />-->
                                                
                                            </td>
											
										</tr>
                                        <tr id="subitem_2" class="hide"><td colspan="5">&nbsp;&nbsp;</td></tr>
										<tr id='subitem_3_desc' class="hide">
                                            <td>&nbsp;</td>
                                            <td  class="label">Sub Level 3 Desc.</td>
                                            <td  class="labeldisplay">
                                               <!-- <input type="text" name='descriptionnotes' id='descriptionnotes' class="textboxdisplay" value="" size="55"/> -->
                                                <textarea name="subitem_3_desc" id="subitem_3_desc" class="textboxdisplay txtarea_style" style="width: 505px;" rows="3"></textarea>
                                            </td>
                                            <td class="label">&nbsp;</td> 
                                            <td width="20%">
<!--                                                <input type="text" name="remarks" id="remarks" class="textboxdisplay" size="10" readonly="" />-->
                                                
                                            </td>
											
										</tr>
                                        <tr id="subitem_3" class="hide"><td colspan="5">&nbsp;&nbsp;</td></tr>
                                        <!--<tr>
                                            <td>&nbsp;</td>
                                            <td class="label">Short Notes</td>
                                            <td class="labeldisplay">
												<textarea name="shortnotes" id="shortnotes" class="textboxdisplay" style="width:500px;" rows="4"></textarea>
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
											<td>&nbsp;</td>
											<td colspan="2" align="center">
												 <div style=" background-color:#EEEEEE; border:1px solid #D4D4D4" id="extra_item_div">
								  					<table width="100%" class="label">
														<tr style="background-color:#F0F0F0; height:25px; color:#FFFFFF; vertical-align:middle"><td align="center" colspan="4" class="gradientbg">Additional Qty Beyond the Deviation Limit </td></tr>
														<tr>
															<td align="center">Item No</td>
															<td align="center">Qty</td>
															<td align="center">Rate</td>
															<td align="center">Unit</td>
														</tr>
														<tr>
															<td align="center"><input type="text" class="extraItemTextbox" name="txt_extra_item_no" id="txt_extra_item_no" readonly="" onBlur="ExtraItemNo_Validation();"></td>
															<td align="center"><input type="text" class="extraItemTextbox" name="txt_extra_item_qty" id="txt_extra_item_qty"></td>
															<td align="center"><input type="text" class="extraItemTextbox" name="txt_extra_item_rate" id="txt_extra_item_rate"></td>
															<td align="center"><input type="text" class="extraItemTextbox" name="txt_extra_item_unit" id="txt_extra_item_unit"></td>
														</tr>
														<tr>
															<td align="left" colspan="4" id="val_extra_item" style="color:red"></td>
														</tr>
														<tr>
															<td align="center" colspan="4">Item Description</td>
														</tr>
														<tr>
															<td align="center" colspan="4">
																<textarea class="extraItemTextArea" name="txt_extra_item_desc" id="txt_extra_item_desc" rows="3" cols="100"></textarea>
															</td>
														</tr>
														<tr id="extra_item_desc">
															<td align="left" colspan="4" id="val_extra_item_desc" style="color:red;"></td>
														</tr>
													</table>
								  				</div>
											</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
                                            <td colspan="5">
                                                <center>
                                                    <input type="hidden" class="text" name="submit" value="true" />
                                                    <input type="hidden"  id="sno_hide" name="sno_hide">
                                                </center>
                                            </td>
                                     	</tr>
                                  </table>
								 <input type="hidden" name="txt_mbheader_id_str" id="txt_mbheader_id_str" value="">
                            		<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
										<div class="buttonsection">
										<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
										</div>
										<div class="buttonsection">
										<input type="submit" name="submit" value=" Submit " id="submit"/>
										</div>
									</div>
                         		</div>
                        </blockquote>
                    </div>

                </div>
            </div>
    </form>
<!--==============================footer=================================-->
@endsection