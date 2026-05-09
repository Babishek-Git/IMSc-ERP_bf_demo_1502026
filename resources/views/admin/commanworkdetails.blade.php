@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')



<form name="form" method="get" action="CommanWorkDetailsTable.php">
<div class="content">
	<div class="title"></div>
	<div class="container_12">
		<div class="grid_12">
			<blockquote class="bq1" style="overflow:auto">
				<div class="container">
					<div class="row ">
						<div class="div3"></div>
						<div class="div6 mbtable">
							<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> Work Report </div></div></div>
							<div class="card-body padding-1 ChartCard" id="CourseChart">
								<div class="divrowbox innerdiv pt-2">

										<div class="row">
											<div class="row">
											<div class="div1">&nbsp;</div>
												<div class="div3 label" style="text-align:center;">
													Computer Code No.
												</div>
												<div class="div4">
													<select name="cmb_work_no" id="cmb_work_no" onChange="find_workname();find_rbn();" class="textboxdisplay" style="width:100%;" tabindex="7">
														<option value=""> --- Select CCNO --- </option>
													</select>
												</div>
											</div>
											<div class="row smclearrow"></div>
										</div>



								</div>
								<div style="text-align:center; height:45px;" class="printbutton">
									<!-- <div class="buttonsection">
										<input type="button" name="back" value="Back" id="back" class="backbutton" onClick="goBack();" />
									</div> -->
									<div class="buttonsection" id="view_btn_section">
										<input type="submit" class="btn" value=" GO " name="btn_go" id="btn_go"/>
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
</form>  

<script>
	$('#cmb_work_no').chosen();
</script>
@endsection
