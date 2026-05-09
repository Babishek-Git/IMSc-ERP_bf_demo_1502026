@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
    <form action="" method="post" enctype="multipart/form-data" name="form">
		
         <div class="content">
             <div class="title">Work Extension</div>
             <div class="container_12">
                 <div class="grid_12">
                     <blockquote class="bq1" style="overflow:auto">
						<div align="right">
						</div>
                        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="color1">
                             <tr><td width="21%">&nbsp;</td></tr>
							<tr>
                                <td>&nbsp;</td>
                                <td class="label">Work Short Name</td> 
                                 <td  class="labeldisplay">
									<select name="txt_workshortname" id="txt_workshortname" class="textboxdisplay" style="width:437px;" onChange="workorderdetail();">
										<option value=""> --------------- Select --------------- </option>
									</select>
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_woredrno" style="color:red" colspan="">&nbsp;</td></tr>
							<tr>
                                 <td>&nbsp;</td>
                                 <td class="label">Work Order No.</td>
                                 <td><input type="text" name='txt_workorder_no' id='txt_workorder_no' readonly="" class="textboxdisplay" style="width:435px;" value=""></td>
                            </tr>
							<tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="" style="color:red" colspan="">&nbsp;</td></tr>
							<tr>
                                <td>&nbsp;</td>
                                <td class="label">Work Name</td>
                                <td><textarea name='txt_workname' id='txt_workname' readonly="" class="textboxdisplay" value="" rows="6" style="width:434px"></textarea></td>
                            </tr>
                            <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="" style="color:red" colspan="">&nbsp;</td></tr>
							<tr>
                                <td>&nbsp;</td>
                                <td class="label">Extension Date</td>
                                <td><input type="text" name='txt_ext_date' id='txt_ext_date' class="textboxdisplay" style="width:150px" value=""></td>
                            </tr>
                            <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_sheetname" style="color:red" colspan="">&nbsp;</td></tr>
                        </table>
						<input type="hidden" name="txt_ext_edit_id" id="txt_ext_edit_id" value="">
							<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
								<div class="buttonsection">
									<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/></div>
								<div class="buttonsection" style="width:115px">
									<input type="submit" class="btn" data-type="submit" name="submit" id="submit" value=" Save " />
								</div>
							</div>
                        </blockquote>
                    </div>
                </div>
            </div>
            <!--==============================footer=================================-->
         
        </form>
@endsection

