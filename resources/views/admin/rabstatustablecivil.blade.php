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
						<!-- <div class="div1"></div> -->
						<div class="div12 mbtable">
							<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> RAB - MBook Status in Accounts </div></div></div>
							<div class="card-body padding-1 ChartCard" id="CourseChart">
								<div class="divrowbox innerdiv pt-2">


									<table align="center" class="table table-bordered" style="border:0px">
										<!--<thead>
											<tr><th>TOTAL WORK LIST IN ACCOUNTS</th></tr>
										</thead>-->
										<thead>
											<tr>
												<td style="height:30px; vertical-align:middle; background:#8E99A8; color:#fff; font-weight:normal; font-size:12px;">
													Name of Work : <?php //echo $SheetDataArr[$sheetid][0]; ?>
												</td>
											</tr>
											<tr>
												<td>
													<!--<span class="rlable-pink">Work Order No : </span>
													<span class="rlable-pink">Agreement No : </span>
													<span class="rlable-pink">CC No : </span>
													<span class="rlable-pink">Bill No : RAB </span>
													<span class="rlable-pink">Sent To Accounts on :</span>
													<span></br></span>
													<span class="rlable-pink">Work Order Cost : </span>
													<span class="rlable-pink">Upto Paid Amount :</span>
													<span class="rlable-pink">This Bill Value :</span>
													<span class="rlable-pink">secured Advance Amount :</span>
													<span class="rlable-pink">Recovery amount  : </span>-->
												</td>  
											</tr>
										</thead>
										<tbody>
											<tr style="border:0px !important">
												<td style="padding:0px; border:0px !important">
													<table class="table table-bordered">
														<thead>
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
													</table>
												</td>
											</tr>
										</tbody>
									</table>


								</div>
								<div style="text-align:center; height:45px;" class="printbutton">
									<!-- <div class="buttonsection">
										<input type="button" class="backbutton" value=" Back " name="back" id="back"   />
									</div> -->
								</div>
							</div>
						</div>
						<!-- <div class="div1"></div> -->
					</div>
				</div>
			</blockquote>
		</div>
	</div>
</div>
</form>  


@endsection

