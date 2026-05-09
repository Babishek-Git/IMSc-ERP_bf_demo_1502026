@extends('layouts.dashboard-master')
	
@section('content')
    <div class="content">
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1">
					<div class="title">Abstract  Generate </div>
						<form name="form" method="post">
							<div class="content">
								<table width="1000"  bgcolor="#E8E8E8" border="0" cellpadding="0" cellspacing="0" align="center" >
									<tr><td>&nbsp;</td></tr>
									<tr> 
										<td>&nbsp;</td> 
										<td  class="label">Date</td>
										<td><input type="text" readonly="" name="txt_date" id="txt_date" class="textboxdisplay" value="<?php echo date('d/m/y') ?>" size="8"/>				                 
										</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr><td>&nbsp;</td></tr>
									<tr> 
										<td>&nbsp;</td> 
										<td  class="label">Work Order No </td>
										<td  class="labeldisplay">
											<select name="cmb_work_no" id="cmb_work_no" onChange="find_workname(); func_abshead_date();" class="textboxdisplay" style="width:400px;height:22px;" tabindex="7">
												<option value="">Select</option>
												<option value=""></option>
											</select></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
    `								 </tr>
									<tr><td>&nbsp;</td><td></td><td colspan="3" id="val_work" style="color:red"></td></tr>
									<tr>
										<td>&nbsp;</td>
										<td  class="label">Name of the Work </td>
										<td  class="labeldisplay"><textarea name="workname" cols="48" rows="5" class="textboxdisplay"></textarea></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td  class="label">&nbsp;</td>
										<td  class="labeldisplay">&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr> 
										<td>&nbsp;</td> 
										<td  class="label">From Date </td>
										<td  class="labeldisplay"><input type="text" readonly="" name="txt_fromdate" id="txt_date2" class="textboxdisplay" value="" size="8"/>
										</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr><td>&nbsp;</td></tr>
									<tr> 
										<td>&nbsp;</td> 
										<td  class="label">To Date </td>
										<td  class="labeldisplay"><input type="text" readonly="" name="txt_todate" id="txt_date3" class="textboxdisplay" value="" size="8"/>
										</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr><td>&nbsp;</td></tr>
									<tr> 
                                        <td>&nbsp;</td> 
                                        <td  class="label">M Book  No</td>
                                        <td  class="labeldisplay">
                                            <select name="currentmbookno" id="currentmbookno" class="textboxdisplay" style="width:400px;height:22px;" tabindex="7">
                                                <option value="0"> -- Select MBook No -- </option>
                                            </select>
                                            <input type="hidden" name="currentmbook" id="currentmbook" />
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
									<tr><td>&nbsp;</td><td></td><td id="val_mbook" style="color:red"></td></tr>
                                    <tr> 
                                        <td>&nbsp;</td> 
                                        <td  class="label">M Book Page </td>
                                        <td  class="labeldisplay"><input type="text" name="bookpageno1" id="bookpageno1" class="textboxdisplay"  size="40" tabindex="5"/>
                                            <input type="hidden" name="bookpageno" id="bookpageno" />
                                            <input type="hidden" name="count" id="count" />
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr><td>&nbsp;</td></tr>
									<tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>
									<tr>
										<td colspan="6">
										<center>
											<input type="hidden" class="text" name="submit" value="true" />
											<input type="submit" class="btn" data-type="submit" value="Generate" name="html" id="html"   />&nbsp;&nbsp;&nbsp;&nbsp;
											<input type="submit" class="btn"   data-type="submit" value="Excel Format" name="xcel" id="xcel"  style="display: none;" /> 
										</center>	    </td>
									<!--  style="display: none;"-->
									</tr>
									<tr><td>&nbsp;</td></tr>
								</table>
							</div>
						</form>
						<div class="col2"><?php //if($msg != '') { echo $msg; } ?></div>
					</blockquote>
				</div>
			</div>
		</div>
@endsection