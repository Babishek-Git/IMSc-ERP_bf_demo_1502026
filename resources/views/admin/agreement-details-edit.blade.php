@include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.library.binddata') 
@include('layouts.library.common')
@include('layouts.library.spreadsheet-reader')
@include('layouts.header')
       <form action="" method="post" enctype="multipart/form-data" name="phuploader">
            @include('admin.menu')
            <div class="content">
                <div class="title">Agreement Sheet</div>
                <div class="container_12">
                    <div class="grid_12">

                        <blockquote class="bq1" style="overflow:auto">
                        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="color1">
                                <tr>
									<td width="20%">&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Work Order No.</td> 
                                    <td><input type="text"  name='workorderno' id='workorderno' readonly="" class="textboxdisplay" style="width: 465px;" value=""/></td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_woredrno" style="color:red" colspan="">&nbsp;</td></tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Work Short Name</td>
                                    <td>
									<input type="text" name='workshortname' id='workshortname' readonly="" class="textboxdisplay" value="" style="width: 465px;">
									<!--<input type="text" name='workname' id='workname' class="textboxdisplay" value="" size="60">-->
									</td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_wshortname" style="color:red" colspan="">&nbsp;</td></tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Name of Work</td>
                                    <td>
									<textarea name='workname' id='workname' class="textboxdisplay" readonly="" value="" rows="6" style="width: 465px;"></textarea>
									<!--<input type="text" name='workname' id='workname' class="textboxdisplay" value="" size="60">-->
									</td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_wname" style="color:red" colspan="">&nbsp;</td></tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Technical Sanction No. </td>
                                    <td><input type="text" name='techsanctionno' id='techsanctionno' readonly="" class="textboxdisplay" value="" style="width: 465px;"></td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_techsno" style="color:red" colspan="">&nbsp;</td></tr>
                                <tr> 
                                    <td>&nbsp;</td>
                                    <td class="label">Name of contractor</td>
                                    <td><input type="text" name='contractorname' id='contractorname' readonly="" class="textboxdisplay" value="<?php if($_GET['sheetid'] != ""){ echo $contractor_name; } ?>" style="width: 465px;"></td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_conname" style="color:red" colspan="">&nbsp;</td></tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Agreement No.</td>
                                    <td> <input type="text" name='agreementno' id='agreementno' readonly="" class="textboxdisplay" value="<?php if($_GET['sheetid'] != ""){ echo $agreemnt_no; } ?>" style="width: 465px;"></td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_aggno" style="color:red" colspan="">&nbsp;</td></tr>
                                
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">CC No.</td> 
                                    <td><input type="text"  name='computercodeno' id='computercodeno' readonly="" class="textboxdisplay" style="width: 465px;" value="<?php if($_GET['sheetid'] != ""){ echo $ccno; } ?>"/></td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_computercodeno" style="color:red" colspan="">&nbsp;</td></tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Work Type </td>
                                    <td class="label">
										<select name='worktype' id='worktype' class="textboxdisplay" style="width: 468px;">
											<option value="">--------------------------- Select ---------------------------</option>
											<option value="1">Major Construction</option>
											<option value="2">Minor Construction</option>
											<option value="3">Major Maintenance</option>
											<option value="4">Minor Maintenance</option>
										</select>
										<input type="hidden" name="txt_worktype" id="txt_worktype" value="">
									</td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_worktype" style="color:red" colspan="">&nbsp;</td></tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Work Order Date</td> 
                                    <td><input type="text"  name='workorderdate' id='workorderdate' readonly="" class="textboxdisplay" size="15" value=""/></td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_workorderdate" style="color:red" colspan="">&nbsp;</td></tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Work Commencement Date</td> 
                                    <td><input type="text"  name='workcommencedate' id='workcommencedate' readonly="" class="textboxdisplay" size="15" value=""/></td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_workcommencedate" style="color:red" colspan="">&nbsp;</td></tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Work Duration </td>
                                    <td><input type="text" name='workduration' id='workduration' class="textboxdisplay" value="" readonly="" size="15">&nbsp;&nbsp;( Months )</td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_workduration" style="color:red" colspan="">&nbsp;</td></tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Scheduled Date of Completion </td>
                                    <td><input type="text" name='dateofcompletion' id='dateofcompletion' class="textboxdisplay" value="" readonly="" size="15"></td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_dateofcompletion" style="color:red" colspan="">&nbsp;</td></tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Rebate Percentage</td> 
                                    <td><input type="text"  name='rebatepercent' id='rebatepercent' readonly="" class="textboxdisplay" size="6" value=""/>&nbsp;&nbsp;( % )</td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_rebatepercent" style="color:red" colspan="">&nbsp;</td></tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Sheet Name</td> 
                                    <td><input type="text"  name='txt_sheetname' id='txt_sheetname' class="textboxdisplay" value="" style="width: 430px;"/>&nbsp;<i class="fa fa-info-circle" aria-hidden="true" style="padding-top:1px; color:#0078F0; cursor:pointer; font-size:22px" id="sheet_name_info" title="Click here to View Sample"></i></td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_sheetname" style="color:red" colspan="">&nbsp;</td></tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Upload File</td>
                                    <td>
									<input type="file" class="text" name="file" size="44" style="height:23px; width: 79px;" onChange="this.style.width = '71%';" onBlur="upload_file()" />
									<span id="sheetname" style="display:"></span></td>
									<input type="file" class="text" name="file" size="44" style="height:23px;" />
									<input type="file" class="text" name="file" size="44" style="height:23px;" />
									</td>
                                </tr>
                                <tr><td>&nbsp;
								<input type="hidden" name="sheetid" id="sheetid" value="">
								<input type="hidden" name="sheetname" id="sheetname" value="">
								</td></tr>
                                <tr>
                                    <td colspan="3" align="center" class="smalllabcss">Upload files allow the file formats of : .xls  , .xlsx</td>
                                </tr>
                                <!--<tr><td>&nbsp;</td></tr>-->
                                <tr>
                                    <td colspan="3">
									<center>
									<input type="submit" class="btn" name="submit" id="submit" value="Upload File" />&nbsp;&nbsp;&nbsp;
									<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
									</center>
                                	</td>
                                </tr>
								<tr><td colspan="3">&nbsp;</td></tr>
                            </table>
							<div id="basic-modal-content">
								<img src="images/sheet_name.png">
							</div>
                           <!-- </td>
                            </tr>
                            <tr><td colspan="4">&nbsp;</td></tr>
                            <tr><td width="500" colspan="5" class="green">
                                </td></tr>
                            <tr><td colspan="4">&nbsp;</td></tr>
                            <tr class="labelcenter">
                                <td colspan="5" align="center">&nbsp;

                                </td>
                            </tr>
                            <tr><td colspan="5">&nbsp;</td></tr>
                            </table>-->
                            <!--<div class="col2"></div>-->
                        </blockquote>
                    </div>

                </div>
            </div>
           @include('layouts.footer')
        </form>
    </body>
</html>
