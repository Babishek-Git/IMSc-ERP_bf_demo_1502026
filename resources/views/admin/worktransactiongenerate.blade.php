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
							<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> Work Transaction Generate </div></div></div>
							<div class="card-body padding-1 ChartCard" id="CourseChart">
								<div class="divrowbox innerdiv pt-2">

										<div class="row">
											<div class="row">
												<div class="div3 label">	
													Work Short Name
												</div> 
												<div class="div9">
													<select id="cmb_work_no" name="cmb_work_no" onChange="find_workname()" class="textboxdisplay" style="width:400px;" tabindex="1">
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
													<input type="text" name="txt_workorder_no" id="txt_workorder_no" class="textboxdisplay" style="width:395px;" disabled="disabled">
												</div>
											</div>
											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div3 label">
													Name of Work
												</div>
												<div class="div9">
													<textarea name="workname" class="textboxdisplay txtarea_style" style="width:400px; height:60px;" rows="5" disabled="disabled"></textarea>
												</div>
											</div>	
											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div3 label">&nbsp;</div>
												<div class="div4 label">
													<a class="btn3 btn3-default btn3-sm TransType" data-id="W">
														<i class="fa fa-check-circle" style="font-size:15px; padding-top:2px"></i> View Work Transaction
													</a>
												</div>
												<div class="div5">
													<a class="btn3 btn3-default btn3-sm TransType" data-id="R">
														<i class="fa fa-check-circle" style="font-size:15px; padding-top:2px"></i> View RAB Transaction
													</a>
												</div>
											</div>


										</div>
										<input type="hidden" name="txt_view_type" id="txt_view_type">

										<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
											<!-- <div class="buttonsection" style="display:inline-table">
												<input type="button" onClick="goBack()" class="backbutton" name="back" id="back" value="Back">
											</div> -->
											<div class="buttonsection" style="display:inline-table">
												<input type="submit" class="btn" data-type="submit" value=" View " name="submit" id="submit"   />
											</div>
										</div>

								</div>
							</div>
						</div>
						<div class="div3"></div>
					</div>
				</div>					
			</blockquote>
		</div>
	</div>
</div>


@endsection