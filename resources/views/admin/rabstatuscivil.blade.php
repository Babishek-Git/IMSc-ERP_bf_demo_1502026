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
						<div class="div1"></div>
						<div class="div10 mbtable">
							<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> Bill - MBook Status </div></div></div>
							<div class="card-body padding-1 ChartCard" id="CourseChart">
								<div class="divrowbox innerdiv pt-2">


								<div class="label">Work Name - List</div>	
								<div class="hide">
									<div id="">
										<div class="well well-sm">Name of Work :</div>
										<div class="well well-sm">
											<span class="rlable-pink">Work Order No : </span>
											<span class="rlable-pink">Agreement No : </span>
											<span class="rlable-pink">CC No : </span>
											<span class="rlable-pink">Bill No : RAB </span>
											<span class="rlable-pink">Received from Civil on : ]</span>
										</div>
										<table class="table table-bordered">
											<thead>
												<!--<tr>
													<th colspan="17" style="text-align:left">
														
													</th>
												</tr>
												<tr>
													<th colspan="17">
														
													</th>
												</tr>
												<tr>
													<th colspan="17" style="text-align:left">&nbsp;</th>
												</tr>-->
												<tr>
													<th rowspan="2">MBook No.</th>
													<th rowspan="2">MBook Type</th>
													<th colspan="3">Dealing Assistant</th>
													<th colspan="3">Accountant</th>
													<th colspan="3">AAO</th>
													<th colspan="3">AO</th>
													<th colspan="3">DCA</th>
												</tr>
												<tr>
													<th>Rec. Date</th>
													<th>Comp. Date</th>
													<th>Status</th>
													
													<th>Rec. Date</th>
													<th>Comp. Date</th>
													<th>Status</th>
													
													<th>Rec. Date</th>
													<th>Comp. Date</th>
													<th>Status</th>
													
													<th>Rec. Date</th>
													<th>Comp. Date</th>
													<th>Status</th>
													
													<th>Rec. Date</th>
													<th>Comp. Date</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
											
											</tbody>
										</table>
									</div>
								</div>


								</div>
								<div style="text-align:center; height:45px;" class="printbutton">
									<!-- <div class="buttonsection">
										<input type="button" class="backbutton" value=" Back " name="back" id="back"   />
									</div> -->
								</div>
							</div>
						</div>
						<div class="div1"></div>
					</div>
				</div>
			</blockquote>
		</div>
	</div>
</div>
</form>  






							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
	<div class="grid_1 no-padding-lr">&nbsp;</div>
</div>
<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
	<!-- <div class="buttonsection">
		<input type="button" class="backbutton" value=" Back " name="back" id="back"   />
	</div> -->
</div>
</form>
</blockquote>
</div>
</div>
</div>

@endsection