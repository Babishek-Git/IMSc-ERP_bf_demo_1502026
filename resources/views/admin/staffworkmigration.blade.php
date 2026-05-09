@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
        <!--==============================header=================================-->
        <!--==============================Content=================================-->
        <div class="content">
            <div class="title">Staff - Work Migration</div>
            <div class="container_12">
                <div class="grid_12">
                    <blockquote class="bq1">
                        <form name="form" method="post" action="">
                            <div class="container">
                                <table width="100%" align="center" >
                                    <tr>
										<td width="23%">&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>&nbsp;</td> 
									 	<td class="label">Work Short Name </td>
									 	<td class="labeldisplay">
											<select name="cmb_shortname" id="cmb_shortname" onChange="workorderdetail();GetStaffNames();CheckMeasureLevel();" class="textboxdisplay" style="width:470px;height:22px;" tabindex="7">
												<option value="">--------------- Select ---------------</option>
											</select>
										</td>
									 	<td>&nbsp;</td>
										<td>&nbsp;</td>
								 	</tr>
								 	<tr>
										<td>&nbsp;</td>
										<td></td>
										<td id="val_work" style="color:red" colspan="3"></td>
									</tr>
									<tr>
									   	<td>&nbsp;</td>
									   	<td class="label">Work Order No. </td>
									   	<td class="labeldisplay"><input type="text" name="txt_workorder" id="txt_workorder" readonly="" rows="6" class="textboxdisplay" style="width: 465px;"></td>
									   	<td>&nbsp;</td>
									   	<td>&nbsp;</td>
									</tr>
                                    <tr>
										<td>&nbsp;</td>
										<td></td>
										<td id="val_work" style="color:red" colspan="3"></td>
									</tr>
								 	<tr>
									   	<td>&nbsp;</td>
									   	<td class="label">Name of the Work </td>
									   	<td class="labeldisplay"><textarea name="txt_workname" id="txt_workname" readonly="" rows="6" class="textboxdisplay" style="width: 465px;"></textarea></td>
									   	<td>&nbsp;</td>
									   	<td>&nbsp;</td>
									</tr>
                                    <tr>
										<td>&nbsp;</td>
										<td></td>
										<td id="val_work" style="color:red" colspan="3"></td>
									</tr>
									<tr>
										<td>&nbsp;</td> 
									 	<td class="label">Existing Staff</td>
									 	<td class="labeldisplay">
											<select name="cmb_ext_staff" id="cmb_ext_staff"  class="textboxdisplay" style="width:250px;height:22px;" tabindex="7">
												<option value="">--------- Select ---------</option>
											</select>
										</td>
									 	<td>&nbsp;</td>
										<td>&nbsp;</td>
								 	</tr>
									 <tr>
										<td>&nbsp;</td>
										<td></td>
										<td id="val_ext" style="color:red" colspan="3"></td>
									</tr>
									<tr>
										<td>&nbsp;</td> 
									 	<td class="label">Migrate to </td>
									 	<td class="labeldisplay">
											<select name="cmb_change_staff" id="cmb_change_staff"  class="textboxdisplay" style="width:250px;height:22px;" tabindex="7" >
												<option value="">--------- Select ---------</option>
											</select>
										</td>
									 	<td>&nbsp;</td>
										<td>&nbsp;</td>
								 	</tr>
									 <tr>
										<td>&nbsp;</td>
										<td></td>
										<td id="val_new" style="color:red" colspan="3"></td>
									</tr>
									<!--<tr>
										<td>&nbsp;</td>
										<td colspan="4">
											<div class="col-md-3">&nbsp;</div>
											<div class="col-md-3 well-A active" align="center" id="AssignStaff">Click here to assign staff </div>
											<div class="col-md-4">&nbsp;</div>
										</td>
									</tr>-->
									<tr>
										<td colspan="5">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="5">&nbsp;</td>
									</tr>
									<!--<tr>
										<td>&nbsp;</td>
										<td colspan="4">
											<div class="col-md-2 well-A level" id="level_check1" data-level='1' data-check='N' align="left"><i class='fa fa-check-circle' style='font-size:20px; color:#CACACA'></i> Scientific Assistant </div>
											<div class="col-md-2 well-A level" id="level_check2" data-level='2' data-check='N' align="left"><i class='fa fa-check-circle' style='font-size:20px; color:#CACACA'></i> Site Engineer</div>
											<div class="col-md-2 well-A level" id="level_check3" data-level='3' data-check='N' align="left"><i class='fa fa-check-circle' style='font-size:20px; color:#CACACA'></i> Engineer Incharge</div>
											<div class="col-md-3 well-A level" id="level_check4" data-level='4' data-check='N' align="left"><i class='fa fa-check-circle' style='font-size:20px; color:#CACACA'></i> Superintendent Engineer</div>
										</td>
									</tr>-->
									<tr>
										<td colspan="5">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="5" align="center">
											<div class="col-md-12" align="center">
											<input type="submit" data-type="submit" value=" Save " name="submit" id="submit"/> 
											<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
											</div>
										</td>
									</tr>
                                </table>
                            </div>
							<input type="hidden" name="txt_ext_staffid" id="txt_ext_staffid">
							<input type="hidden" name="txt_multi_staff" id="txt_multi_staff" value="">
							<input type="hidden" name="txt_multi_section" id="txt_multi_section" value="">
							<input type="hidden" name="txt_level" id="txt_level" value="">
					</form>
          		</blockquote>
			</div>
		</div>
	</div>
<div id="staff_list" style="display:none">
	<div class="blank-page-content">
		<div class="outer-w3-agile mt-3 margin-t1">
			<p class="paragraph-agileits-w3layouts">
				<div class="card-body" align="right" style="padding-top:0px;">
					<div class="list-group">
						<div class="row staff_list">
							<div class="col-md-12 padding-1">
								<div class="col-md-12 padding-1" style="text-align:left">
									<input type="text" name="txt_search" id="txt_search" class="searchbox" placeholder=' Search Name here...' value=""/>
									<span style="height:10px; font-size:12px;;">
										<span class="smallbox1">Selected</span>
										<span class="smallbox2">Highlighted</span>
									</span>
								</div>
							</div>
							<div class="col-md-2 padding-1 multi-mark" align="left">
								<a class="list-group-item media d-flex justify-content-between align-items-center outer-w3-agile col no-box-shaddow font-1" style="padding:5px;">
									<div class="media-body d-flex justify-content-between align-items-center">
										<div class="lg-item-heading">
											<input type="checkbox" id="IC" class='staff_icno' value="" style="display:none" name="checkbox[]" data-section="" data-sname="" data-desig=""/>
											<i style="font-size:16px; color:#E2E2E2; padding-top:3px;" class="fa">&#xf058;</i>
											<br/>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</p>
		</div>
	</div>
</div>	
@endsection
<!--==============================footer=================================-->

<link rel="stylesheet" href="../bootstrap-dialog/css/bootstrap-dialog.min.css">
<script src="../bootstrap-dialog/js/bootstrap.min.js"></script> <!---IMP-->
<script src="../bootstrap-dialog/js/bootstrap-dialog.min.js"></script>
<script src="../bootstrap-dialog/js/run_prettify.min.js"></script>