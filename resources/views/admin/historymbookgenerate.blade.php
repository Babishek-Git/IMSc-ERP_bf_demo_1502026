@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')


<form name="form" method="get" action="HistoryMBook.php">
<div class="content">
	<div class="title"></div>
	<div class="container_12">
		<div class="grid_12">
			<blockquote class="bq1" style="overflow:auto">
				<div class="container">
					<div class="row ">
						<div class="div2"></div>
						<div class="div8 mbtable">
							<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> MBook History </div></div></div>
							<div class="card-body padding-1 ChartCard" id="CourseChart">
								<div class="divrowbox innerdiv pt-2">

										<div class="row">
											<div class="row">
												<div class="div3 label">	
													Work Short Name
												</div> 
												<div class="div9">
													<select id="cmb_work_no" name="cmb_work_no" onChange="func_items();find_workname();" class="textboxdisplay" style="width:470px;height:22px;" tabindex="7">
														<option value=""> -------------------- Select Work Name ------------------ </option>
													</select>
												</div>
											</div>
											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div3 label">
													Work Order No.
												</div>
												<div class="div9">
													<input type="text" name="txt_workorder_no" id="txt_workorder_no" class="textboxdisplay" style="width:465px;" disabled="disabled">
												</div>
											</div>
											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div3 label">
													Name of Work
												</div>
												<div class="div9">
													<textarea name="workname" class="textboxdisplay txtarea_style" style="width: 468px;" rows="5" disabled="disabled"></textarea>
												</div>
											</div>	
											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div3 label">
													Running Account Bill No.
												</div>
												<div class="div9">
													<select name="cmb_rbn" id="cmb_rbn" class="textboxdisplay" style="width:183px;height:22px;" size="" tabindex="7" onChange="cmb_runningbilltext()">
														<option value = "">---- Select RAB ----</option>
                                       </select>
												</div>
											</div>	
											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div3 label">
													MBook Type
												</div>
												<div class="div9">
													<input type="radio" name="rad_measurementtype" id="rad_others" value="G">&nbsp;&nbsp;<label class="label">General</label>
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<input type="radio" name="rad_measurementtype" id="rad_steel" value="S">&nbsp;&nbsp;<label class="label">Steel</label>
												</div>
											</div>	
											<div class="row smclearrow"></div>
											<!--	<div class="row">
												<div class="div3 label">
													Zone Name
												</div>
												<div class="div9">
													<select name='cmb_zone_name' id='cmb_zone_name' class="textboxdisplay" style="width:470px; visibility:hidden">
														<option value="all"> ------------------------------- All --------------------------------- </option>
													</select>
													<span id="val_zone_name" style="color:red"></span>
												</div>
											</div>	-->

										</div>
										<input type="hidden" name="txt_view_type" id="txt_view_type">

										<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
											<div class="buttonsection" style="display:inline-table">
												<input type="button" onClick="goBack()" class="backbutton" name="back" id="back" value="Back">
											</div>
											<div class="buttonsection" style="display:inline-table">
												<input type="submit" class="btn" data-type="submit" value=" View " name="submit" id="submit"   />
											</div>
										</div>

								</div>
							</div>
						</div>
						<div class="div2"></div>
					</div>
				</div>
			</blockquote>
		</div>
	</div>
</div>
</form>          

@endsection
