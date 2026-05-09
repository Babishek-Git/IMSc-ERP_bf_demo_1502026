@extends('layouts.dashboard-master')
@section('content')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
    <form action="EscalationItem.php" method="post" enctype="multipart/form-data" name="form" id="top">
         <div class="content">
            <div class="title">Escalation Item Assign</div>
             <div class="container_12">
                <div class="grid_12">
                    <blockquote class="bq1" style="overflow-y:auto;">
                        <div class="container">
                            <table width="100%" border="1" cellpadding="0" cellspacing="0" align="center">
                                <tr><td width="20%">&nbsp;</td>
                                     </tr>	
                                        <tr><td colspan="5">&nbsp;&nbsp;</td></tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td  class="label" width="14%" nowrap="nowrap">Work Short Name</td>
                                            <td class="">
                                                <select id="workorderno" name="workorderno" onChange="workorderdetail();" class="textboxdisplay" style="width:505px;height:22px;" tabindex="7">
                                                    <option value=""> --------------- Select --------------- </option>
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
                                            <td class="label">Name of Work</td>
                                            <td class="labeldisplay">
                                                <textarea name='txt_workname' id='txt_workname' class="textboxdisplay" rows="6" style="width: 501px;"></textarea>
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
                                       <!-- <tr>
                                            <td>&nbsp;</td>
                                            <td  class="label" width="25%" nowrap="nowrap">Supplementary Work Short Name</td>
                                            <td class="label">
                                                <select id="workorderno_supp" name="workorderno_supp" onChange="GetSupplementaryWorkOrderDetails()" class="textboxdisplay" style="width:505px;height:22px;" tabindex="7">
                                                   <option value=""> -------------------------- Select Supplementary Work Name ------------------------- </option>
                                                </select>     
                                            </td>
                                            <td class="label">&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr><td>&nbsp;</td><td></td><td colspan="3" id="val_work_supp" style="color:red"></tr>
										<tr>
                                            <td>&nbsp;</td>
                                            <td class="label">Supplementary Work Order No</td>
                                            <td class="labeldisplay">
                                                <input type="text" name='txt_workorder_no_supp' id='txt_workorder_no_supp' class="textboxdisplay" value="" style="width:500px;"/>
                                            </td>
                                            <td class="label">&nbsp;</td>
                                            <td class="label">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td></td>
                                            <td id="val_workorderno_supp" colspan="2" style="color:red"></td>
                                            <td></td>
                                        </tr>-->
                                  </table>
								 <input type="hidden" name="txt_mbheader_id_str" id="txt_mbheader_id_str" value="<?php //echo $MbhMbdIDStr; ?>">
                            		<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
										<div class="buttonsection">
										<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
										</div>
										<div class="buttonsection">
										<input type="submit" name="submit" value=" View " id="submit"/>
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