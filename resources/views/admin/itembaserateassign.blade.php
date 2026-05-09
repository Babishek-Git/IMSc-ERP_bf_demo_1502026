@extends('layouts.dashboard-master')
@section('content')
@include('layouts.partials.messages')


	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1">
					<form name="form" method="post" action="">
						<div class="container">
							<div class="row ">
								<div class="div3">&nbsp;</div>
								<div class="div6 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> Item Wise Base Rate - Assign </div></div></div>
									<div class="row innerdiv">

										<div class="row">
											<div class="row">
												<div class="div3 label">	
													Work Short Name
												</div> 
												<div class="div9">
													<select name="cmb_work_no" id="cmb_work_no" onChange="find_workname()" class="textboxdisplay" style="width:400px;" tabindex="7">
														<option value=""> ------- Select Work Short Name ------- </option>
													</select>
												</div>
											</div>
											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div3 label">
													Work Order No.
												</div>
												<div class="div9">
													<input type="text" name="txt_workorder_no" readonly="" id="txt_workorder_no" rows="6" class="textboxdisplay" style="width: 400px;">
												</div>
											</div>
											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div3 label">
													Name of Work
												</div>
												<div class="div9">
												<textarea name="workname" readonly="" rows="6" class="textboxdisplay" style="width:400px;height:60px;"></textarea>
												</div>
											</div>	
											<input type="hidden" class="text" name="submit" value="true" />
											<input  type="hidden" class="text" name="runningbilltext" id="runningbilltext" value=""/>
										</div>

									</div>
									<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
										<div class="buttonsection">
											<input type="submit" data-type="submit" value=" View " name="submit" id="submit"/>
										</div>
										<div class="buttonsection">
											<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
										</div>
									</div>
									<div class="smediv">&nbsp;</div>
								</div>
								<div class="div3">&nbsp;</div>
							</div> 
						</div>
					</form>
				</blockquote>
			</div>
		</div>
	</div>

<script>
	$('#cmb_work_no').chosen();
</script>

@endsection
