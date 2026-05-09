@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

        <!--==============================header=================================-->
        <form action="" method="post" enctype="multipart/form-data" name="form" action="{{ route('admin.saveuser') }}">
       <!--==============================Content=================================-->
            <div class="content" align="center">
                <div class="title">Create User</div>
                <div class="container_12">
                    <div class="grid_12">
					<div align="right"><!--<a href="UsersList.php">View&nbsp;&nbsp;</a>-->&nbsp;</div>
                        <blockquote class="bq1">
                            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="color1">
                                <tr><td width="25%">&nbsp;</td></tr>
								<tr>
								    <td>&nbsp;</td>
                                    <td class="label">Staff Name</td>
									<td>
									
									
									 <select name="cmb_engname" id="cmb_engname" style="width:298px;height:22px;" class="textboxdisplay">
										<option value="">-------------- Select --------------</option>
										
												<option value=""></option>
												
									 </select>
									
									 </td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td class="labeldisplay" id="val_engname" style="color:red">&nbsp;</td>
								</tr>
								<!--<tr>
								    <td>&nbsp;</td>
								    <td colspan="2"  class="labelhead"><u>Account Detail</u> </td>
								</tr>
								<tr><td>&nbsp;</td></tr>-->
								<tr> 
								    <td>&nbsp;</td>
								    <td  class="label">Is Admin</td>
									<td><input type="checkbox" name='ch_is_admin' id='ch_is_admin' class="textboxdisplay" value="1" size="40" <?php //if($isadmin == 1){ echo 'checked="checked"'; } ?>></td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								
								<tr><td>&nbsp;</td></tr>
								
								<tr> 
								    <td>&nbsp;</td>
									<td></td>
								    <td  class="label" style="color:#E80207">* Username and Password will be staff&nbsp;&nbsp;&nbsp;'ICNO'</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								
								<!--<tr> 
								    <td>&nbsp;</td>
								    <td  class="label">User Name</td>
									<td><input type="text" name='username' id='username' class="textboxdisplay" value="<?php //if($_GET['userid'] != ""){ echo $username; } ?>" size="40" onBlur="func_check_username();"></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td class="labeldisplay"><span id="val_uname" style="color:red"></span><span id="val_check_uname" style="color:red"></span>&nbsp;</td>
								</tr>
								<tr>
								    <td>&nbsp;</td>
								    <td  class="label">Password</td>
									
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td class="labeldisplay" id="val_pwd" style="color:red">&nbsp;</td>
								</tr>
                                <tr>
								    <td>&nbsp;</td>
                                    <td  class="label">Confirm Password</td> 
                                    
                                </tr>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td class="labeldisplay" id="val_conf_pwd" style="color:red">&nbsp;</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td class="labeldisplay" id="val_check_pwd" style="color:red">&nbsp;</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td class="labeldisplay">&nbsp;</td>
								</tr>-->
                                <!--<tr>
                                    <td colspan="3" height="40px;">
									    <center>
										  <input type="submit" data-type="submit" value="Submit" name="submit" id="submit" onClick="func_check_username();"/>&nbsp;&nbsp;&nbsp;
										  <input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>&nbsp;&nbsp;&nbsp;
										</center>
									</td>
								</tr>
								
								<tr><td>&nbsp;&nbsp;</td></tr>-->
                            </table>
							<input type="hidden" name="txt_username_check" id="txt_username_check">

							<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
								<div class="buttonsection">
									<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
								</div>
								@php $AddUrl = 'admin.viewuser'; @endphp 
								<div class="buttonsection"><input type="button" class="backbutton" name="View" id="View" value="View" onClick="window.location='{{ route($AddUrl) }}'"/></div>
								<div class="buttonsection">
								
									<input type="submit" value="Update" name="btn_update" id="btn_update"/>
								
									<input type="submit" value="Create" name="btn_save" id="btn_save"/>
								
								<input type="hidden" name="txt_userid" id="txt_userid" value="">
								</div>
							</div>
                        </blockquote>
                    </div>
                </div>
            </div>
            <!--==============================footer=================================-->
            
        </form>
@endsection