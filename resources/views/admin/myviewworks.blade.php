@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

        <form action="" method="post" enctype="multipart/form-data" name="form">
			<div class="content">
				<div class="title">Dashboard</div>
				<div class="container_12">
					<div class="grid_12" align="center">
						<blockquote class="bq1" style="overflow:auto; padding-left:10px; padding-right:10px">
							<div align="center">
								<div class="col-md-12 no-padding-lr" align="center">&nbsp;</div>
								<!--<div class="col-md-2 no-padding-lr" align="center">&nbsp;</div>-->
								<div class="col-md-12 no-padding-lr" align="center">
									<div class="col-status" data-id='A'><div class="well well-sm well-A Total Work List</span></div></div>
									<div class="col-status" data-id='1'><div class="well well-sm well-A <span class="rlable-pink">Major Construction</span></div></div>
									<div class="col-status" data-id='2'><div class="well well-sm well-A<span class="rlable-pink">Major Maintenance</span></div></div>
									<div class="col-status" data-id='3'><div class="well well-sm well-A "><span class="rlable-pink">Minor Construction</span></div></div>
									<div class="col-status" data-id='4'><div class="well well-sm well-A  active "><span class="rlable-pink">Minor Maintenance</span></div></div>
								</div>
							</div>	
							<div class="col-md-12 no-padding-lr" align="center">
								<div class="accordion">
									<dl>
										<dt>
											<a href="#accordion" id="sheet-" aria-expanded="false" aria-controls="accordion" class="accordion-title accordionTitle js-accordionTrigger blue-bg  is-collapsed is-expanded ">
												<span class="round-slno"></span>
												&nbsp;&nbsp;<font style="color:#DF0979; font-weight:bold; background:#edeaea; border-radius:7px; padding:2px;">CCNo. : </font>
												&nbsp;&nbsp;&nbsp;&nbsp;
												<font style="color:#DF0979; font-weight:bold; background:#edeaea; border-radius:7px; padding:2px;" class="Chart" data-id="" data-content="">
													&nbsp; <i class="fa fa-bar-chart" style="font-size:15px; padding-top:2px;"></i>&nbsp; Charts &nbsp;
												</font>
											</a>
										</dt>
										<dd class="accordion-content accordionItem  is-expanded animateIn  is-collapsed " id="accordion" aria-hidden="true" style="overflow:auto;">
											<div align="left" style="padding:5px 5px; background:#fff;">
											   	<span class="rlable-pink1">Work Order No : </span>
											   	<span class="rlable-pink1">Agreement No : </span>
												<span class="rlable-pink1">Work Order Date : </span>
											   	<span class="rlable-pink1">Work Order Cost : </span>
											   	<span></br></span>
												<span class="rlable-pink1">Schedule D.O.C. : </span>
											   	<span class="rlable-pink1">Work Duration : </span>
											   	<span class="rlable-pink1">Completed RAB : RAB -</span>
											   	<span class="rlable-pink1">Upto Paid Amount : </span>
											  	<span class="rlable-pink1">Balance Amount : </span>
												<span></br></span>	
												<span class="rlable-pink1">Contractor Name :</span>
												<span class="rlable-pink1">Engg. Inc. : </span>
											</div>
										</dd>
									</dl>
								</div>
							</div>
							<div class="col-md-12 no-padding-lr" align="center">&nbsp;</div>
							<div class="col-md-12 no-padding-lr" align="center">
								<input type="button" name="back" id="back" value="Back" class="backbutton">
							</div>
							
						</blockquote>
					</div>
				</div>
			</div>
        </form>
    
@endsection