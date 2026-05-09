@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')









<form name="form" method="get" action="">
<div class="content">
	<div class="title"></div>
	<div class="container_12">
		<div class="grid_12">
			<blockquote class="bq1" style="overflow:auto">
				<div class="container">
					<div class="row ">
						<div class="div3"></div>
						<div class="div6 mbtable">
							<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> RAB Status </div></div></div>
							<div class="card-body padding-1 ChartCard" id="CourseChart">
								<div class="divrowbox innerdiv pt-2">

										<div class="row">
											<div class="row">
												<div class="div3 label">	
													Work Short Name
												</div> 
												<div class="div9">
													<select name="cmb_work_no" id="cmb_work_no" onChange="find_workname()" class="textboxdisplay" style="width:400px;height:22px;" tabindex="7">
														<option value="">---------------------- Select ----------------------</option>
													</select>
												</div>
											</div>
											
											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div3 label">
													Name of Work
												</div>
												<div class="div9">
													<textarea name="workname" class="textboxdisplay txtarea_style" style="width: 400px; pointer-events: none; background-color:#E8E8E8" rows="5" readonly="readonly"></textarea>
												</div>
											</div>	

											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div3 label">
													RAB
												</div>
												<div class="div9">
													<input type="text" name="txt_rbn" id="txt_rbn" class="textboxdisplay" style="width:396px; height:30px;" value="">
												</div>
											</div>
										</div>
										<input type="hidden" class="text" name="submit" value="true" />
										<input  type="hidden" class="text" name="runningbilltext" id="runningbilltext" value=""/>

										<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
											<div class="buttonsection">
												<input type="submit" class="btn" data-type="submit" value=" View " name="submit" id="submit"   />
											</div>
										</div>

										<div align="center"  style="display:none" >
											<table width="80%"  bgcolor="#E8E8E8" class="table1" align="center">
												<tr class="label">
													<td align="center">Slno.</td>
													<td align="left">Description</td>
													<td align="center">Reference</td>
													<td colspan="2" align="center">Status / Remarks</td>
												</tr>
												<tr>
													<td align="center" colspan="5" class="color1b"> ---------------- RAB Closed --------------</td>
												</tr>
												<tr>
													<td align="center">1</td>
													<td align="left">Abstract</td>
													<td align="center">
													</td>
													<td align="left">Already Generated</td>
													<td align="center" valign="middle"><i class="fa fa-check-circle" style="font-size:25px;color:green"></i></td>
													<td align="center">-- -- --</td>
													<td align="left" class="color1b">Not Generated</td>
													<td align="center"><i class="fa fa-times-circle" style="font-size:25px;color:red"></i></td>
												</tr>
												<tr>
													<td align="center">2</td>
													<td align="left">Sub Abstract</td>
													<td align="center">
													</td>
													<td align="left">Already Generated</td>
													<td align="center" valign="middle"><i class="fa fa-check-circle" style="font-size:25px;color:green"></i></td>
													<td align="center">-- -- --</td>
													<td align="left" class="color1b">Not Generated</td>
													<td align="center"><i class="fa fa-times-circle" style="font-size:25px;color:red"></i></td>
												</tr>
												<tr>
													<td align="center">3</td>
													<td align="left">General - MBook</td>
													<td align="center">
													</td>
													<td align="left">Already Generated</td>
													<td align="center" valign="middle"><i class="fa fa-check-circle" style="font-size:25px;color:green"></i></td>
													<td align="center">-- -- --</td>
													<td align="left" class="color1b">Not Generated</td>
													<td align="center"><i class="fa fa-times-circle" style="font-size:25px;color:red"></i></td>
												</tr>
												<tr>
													<td align="center">4</td>
													<td align="left">Steel - MBook</td>
													<td align="center">
													</td>
													<td align="left">Already Generated</td>
													<td align="center" valign="middle"><i class="fa fa-check-circle" style="font-size:25px;color:green"></i></td>
													<td align="center">-- -- --</td>
													<td align="left" class="color1b">Not Generated</td>
													<td align="center"><i class="fa fa-times-circle" style="font-size:25px;color:red"></i></td>
												</tr>
												<tr>
													<td align="center">5</td>
													<td align="left">Measurements</td>
													<td align="center"> -- -- --</td>
													<td align="left">Measurement Uploaded</td>
													<td align="center"><i class="fa fa-check-circle" style="font-size:25px;color:green"></i></td>
													<td align="left" class="color1b">Measurement Not Uploaded</td>
													<td align="center"><i class="fa fa-times-circle" style="font-size:25px;color:red"></i></td>
												</tr>
												<!----------------------------------------------uma checkmeasurement------------------------------------------------------------------>		
												<tr>
													<td align="center">6</td>
													<td align="left">Check Measurements</td>
													<td align="center"> -- -- --</td>
													<td align="left" class="color1b">Check Measurement Level Not Assigned</td>
													<td align="center"><i class="fa fa-times-circle" style="font-size:25px;color:red"></i></td>
													<td align="left"></td>
													<td align="center"><i class="fa fa-check-circle" style="font-size:25px;color:green"></i></td>
													<td align="left" class="color1b">Check Measurement Not Done</td>
													<td align="center"><i class="fa fa-times-circle" style="font-size:25px;color:red"></i></td>
												</tr>
												<!-----------------------------------------------------------------------uma-----------------------------------------------------------------------------------------------------------------------	-->	
												<tr>
													<td align="center" rowspan="" valign="middle">7</td>
													<td align="left" rowspan="" valign="middle">Accounts</td>
													<td align="center" rowspan="" valign="middle"> -- -- --</td>
													<td align="left" class="color1b"> RAB Not Sent to Accounts</td>
													<td align="center"><i class="fa fa-times-circle" style="font-size:25px;color:red"></i></td>
												</tr>
												<tr>
													<td align="left"><font class=""></font></td>
													<td align="center">
													<i class='fa fa-check-circle' style='font-size:25px;color:green'></i>
													<i class='fa fa-check-circle' style='font-size:25px;color:green'></i>
													<i class="fa fa-info-circle" style='font-size:25px;color:#F4AE0B'></i>
													<i class='fa fa-times-circle' style='font-size:25px;color:red'></i>
													<i class='fa fa-times-circle' style='font-size:25px;color:red'></i>
													</td>
												</tr>	
											</table>
										</div>


								</div>
							</div>
						</div>
						<div class="div3"></div>
					</div>
					
				</form>          
			</blockquote>
		</div>
	</div>
</div>



@endsection

