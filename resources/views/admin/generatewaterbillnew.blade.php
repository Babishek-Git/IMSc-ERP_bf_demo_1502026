@extends('layouts.dashboard-master')
	
@section('content')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="" method="post" enctype="multipart/form-data" name="form">
		

		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row ">
								<div class="div3">&nbsp;</div>
								<div class="div6 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> Generate - Water Bill </div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">

											<div class="row">
												<div class="row smclearrow"></div>
												<div class="row">
													<div class="div3 label">	
														Work Short Name
													</div> 
													<div class="div9">
														<select name="cmb_work_sname" id="cmb_work_sname" onChange="find_workname()" class="textboxdisplay" style="width:470px;height:22px;" tabindex="7">
																<option value="">--------------- Select ---------------</option>
																@foreach($works as $work)
															<option value="{{ $work['sheetid'] }}">{{ $work['short_name'] }}</option>
																@endforeach
														</select>
													</div>
												</div>
												<div class="row smclearrow"></div>
												<div class="row">
													<div class="div3 label">
														Name of Work
													</div>
													<div class="div9">
														<textarea name='txt_workname' id='txt_workname' class="textboxdisplay txtarea_style" style="width: 470px;" rows="5" disabled="disabled"></textarea>
													</div>
												</div>	
												<div class="row smclearrow"></div>
												
												<div class="row">
													<div class="div3 label">
														Work Order No.
													</div>
													<div class="div9">
														<input type="text" name='txt_workorder' id='txt_workorder' class="textboxdisplay" readonly="" value="" style="width: 465px;">
													</div>
												</div>
												<div class="row smclearrow"></div>

												<div class="row">
													<div class="div3 label">
														Abstract Net Amount
													</div>
													<div class="div9">
														<input type="text" name='txt_abstract_amt' id='txt_abstract_amt' readonly="" class="textboxdisplay textright" value="" style="width: 208px;">
													</div>
												</div>
												<div class="row smclearrow"></div>

												<div class="row">
													<div class="div3 label">
														RAB No.
													</div>
													<div class="div9">
														<input type="text" name='txt_rbn' id='txt_rbn' readonly="" class="textboxdisplay textright" value="" style="width: 120px;">
													</div>
												</div>
												<div class="row smclearrow"></div>

												<div class="row">
													<div class="div3 label">
														Water Charge
													</div>
													<div class="div8">
														<input type="text" name="txt_workorder_no" id="txt_workorder_no" value="1" class="textboxdisplay" disabled="disabled">
														<span class="label">( % of net Amount )</span>
													</div>
													
												</div>
												<div class="row smclearrow"></div>
											</div>


										</div>
										<div class="row">
											<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
												<div class="buttonsection">
													<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
												</div>
												<div class="buttonsection">
													<input type="submit" name="update" id="update" value=" Update "/>
												</div>
												<div class="buttonsection">
													<input type="submit" name="submit" id="submit" value=" Submit "/>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="div3">&nbsp;</div>
							</div>
						</div>
					</blockquote>
				</div>
			</div>
		</div>
















								
								<!--<tr>
									<td colspan="3" align="center">
										<div class="label gradientbg" align="center">Meter Details</div>
										<div style="width:90%; height:auto;" align="center">
											<table width="100%" class="table1" id="table1">
												<tr class="label" style="background-color:#EAEAEA">
													<td align="center">Meter No.</td>
													<td align="center">IMR</td>
													<td align="center">IMR Date</td>
													<td align="center">FMR</td>
													<td align="center">FMR Date</td>
													<td align="center">Rate <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i></td>
													<td align="center">Meter Rent <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i></td>
													<td align="center">Unit </td>
													<td align="center">Factor </td>
													<td align="center">Amount <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i></td>
													<td align="center" colspan="2">Action</td>
												</tr>
												<tr>
													<td align="center" style="vertical-align:middle">
														<select name="cmb_meter_no" id="cmb_meter_no" class="extraItemTextbox" style="text-align:center; width:80px;" onChange="meter_details();ClearOldData();">
															<option value="">-Select-</option>
														</select>
													</td>
													<td align="center"><input type="text" class="extraItemTextbox" name="txt_imr" id="txt_imr" style="background-color:#D7D2D5; text-align:center"></td>
													<td align="center"><input type="text" class="extraItemTextbox" name="txt_imr_date" id="txt_imr_date" style="background-color:#D7D2D5; text-align:center"></td>
													<td align="center"><input type="text" class="extraItemTextbox" name="txt_fmr" id="txt_fmr" onBlur="calculateEBamount();"></td>
													<td align="center"><input type="text" class="extraItemTextbox" name="txt_fmr_date" id="txt_fmr_date" placeholder="dd-mm-yyyy"></td>
													<td align="center"><input type="text" class="extraItemTextbox" name="txt_rate_unit" id="txt_rate_unit" style="background-color:#D7D2D5; text-align:center"></td>
													<td align="center"><input type="text" class="extraItemTextbox" name="txt_rent" id="txt_rent" style="background-color:#D7D2D5; text-align:center"></td>
													<td align="center"><input type="text" class="extraItemTextbox" name="txt_unit" id="txt_unit" style="background-color:#D7D2D5; text-align:center"></td>
													<td align="center"><input type="text" class="extraItemTextbox" name="txt_factor" id="txt_factor" style="background-color:#D7D2D5; text-align:center"></td>
													<td align="center"><input type="text" class="extraItemTextbox" name="txt_amount" id="txt_amount" readonly="" style="background-color:#D7D2D5; text-align:center"></td>
													<td align="center" colspan="2" valign="middle"><input type="button" class="buttonstyle" name="btn_add" id="btn_add" value="Add" onClick="addrow();total_unit_amount_consumption();"></td>
												</tr>
												<tr>
                                                    <span id="add_hidden"></span>
												</tr>
											</table>
											<input type="hidden" value="" name="add_set_a1" id="add_set_a1"/>
										</div>
									</td>
								</tr>-->
								<!--<tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_electricity_row" style="color:red" colspan="">&nbsp;</td></tr>
								<tr>
									<td class="label" colspan="2" align="right">Total Unit consumption&emsp;&emsp;</td>
									<td>
										<input type="text" name='txt_electricity_unit' readonly="" id='txt_electricity_unit' class="textboxdisplay" style="width: 120px;">
									</td>
								</tr>
								<tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_electricity_cost" style="color:red" colspan="">&nbsp;</td></tr>
								<tr>
									<td class="label" colspan="2" align="right">Total Amount <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i>&emsp;&emsp;</td>
									<td>
										<input type="text" name='txt_electricity_cost' readonly="" id='txt_electricity_cost' class="textboxdisplay" style="width: 120px;">
									</td>
								</tr>
								<tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_electricity_cost" style="color:red" colspan="">&nbsp;</td></tr>-->
        </form>
    </body>
</html>
@endsection