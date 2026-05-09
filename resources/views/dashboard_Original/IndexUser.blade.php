@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<script type="text/javascript">
	window.history.forward();
	function noBack() { window.history.forward(); }
</script>
<style>
	
	
	
	
	.panel-body {
 		padding: 4px;
	}
	.p-5{
		padding:5px;
	}
	.panel-primary > .panel-heading{
		background-color:#1babd3;/*#078dd4;*/
		color:#fff;
		font-weight:600;
		border-bottom:0px solid #EBEDF1;
		padding: 4px 15px;
		font-size:11px;
	}
	.panel-default > .panel-heading{
		background-color:#fff;
		color:#10478A;
		font-weight:600;
		border-bottom:0px solid #EBEDF1;
		padding: 4px 15px;
		font-size:11px;
	}
	
	
	
	



	

</style>


<script>

function DownloadExcel(FileType) {
}
function RouteRedirect(Page) {
	
}
</script>
	
<style>
.SpanBox{
	width:100%;
	margin:0px;
	font-size:12px;
	font-weight:500;
	border:1px solid #02bdbc;
	border-bottom:3px solid #02bdbc;
	padding-left:4px;
	background:#fff;
}
.SpanBox:hover{
	background:#02bdbc;
	border:1px solid #02bdbc;
	border-bottom:3px solid #02bdbc;
}
.downSpan{
	padding:8px;
	border:1px solid #8eb6ea;
	border-radius:50px;
	float:left;
	font-size:13px;
	color:#045acb;
	box-shadow: inset 0 0 5px rgba(33, 98, 183, 0.5);
}
.downSpanText{
	top: 8px;
	position: relative;
}
.SpanBox:hover .downSpan {
	color: #fff;
	background-color: #02bdbc;
	border:1px solid #fff;
}
.tooltip-l {
	position: relative;
	display: block;
}
	
/* cards */
.color-block-wrapper {
  margin-top: 15px;
  -webkit-box-shadow: 0px 15px 30px 0px rgba(124, 124, 124, 0.15);
  -moz-box-shadow: 0px 15px 30px 0px rgba(124, 124, 124, 0.15);
  box-shadow: 0px 15px 30px 0px rgba(124, 124, 124, 0.15);
}

.color-block {
  color: #fff;
  border-radius: 4px 4px 4px 4px;
  padding: 15px 8px 13px;
  height: 100px;
  /* margin-top: 75px; */
  position: relative;
}
.color-block:before {
  content: "";
  border-radius: 2px 2px 0 0;
  width: calc(100% - 12px);
  height: 6px;
  position: absolute;
  top: -6px;
  left: 6px;
  opacity: 0.4;
  z-index: 20;
}
.color-block:after {
  content: "";
  border-radius: 2px 2px 0 0;
  width: calc(100% - 24px);
  height: 12px;
  position: absolute;
  top: -12px;
  left: 12px;
  opacity: 0.3;
  z-index: 10;
}

.color-block-head {
  /* opacity: 0.5; */
  text-transform: uppercase;
  font-size: 12px;
  line-height: 18px;
  margin-bottom: 10px;
}
.color-block-head > .fa{
	position: relative;
	top: 3px;
}

.color-block-bottom {
  background: #fff;
  padding: 30px 40px;
}

.color-block-text {
  width: 200px;
  letter-spacing: 0.5px;
  font-size: 11px;
}

/* cards colors */
.color-block-lblue {
  /* background: #005bb7; */
  z-index: 30;
  border:2px solid #005bb7;
  color:#005bb7;
}
.color-block-lblue:before {
  background: #0064ca;
}
.color-block-lblue:after {
  background: #007fff;
}

.color-block-dblue {
  background: #004387;
}
.color-block-dblue:before {
  background: #0c457e;
}
.color-block-dblue:after {
  background: #135ba5;
}

.color-block-green {
  /* background: #49ac01; */
  border:1px solid #17a2b6;
  color:#005bb7;
  border-bottom:1px solid #17a2b6;
  box-shadow: inset 0 -10px 10px -10px rgba(23, 162, 182, 0.5);
}


.infoText{
	border-radius:4px;
	padding:2px 4px;
	cursor: pointer !important;
	font-size:12px;
	font-weight:600;
}
/*.infoText:hover{
	color:#fff;
	background-color:#ae1963;
}*/
.bxcolor1{
	color:#fff;
	background-color:#ae1963;
	border:1px solid #ae1963;
}
.bxcolor1:hover{
	background:#860244;
	border:1px solid #860244;
	color:#fff;
}
.bxcolor2{
	color:#fff;
	background-color:#0490d5;
	border:1px solid #0490d5;
}
.bxcolor2:hover{
	background:#025984;
	border:1px solid #025984;
	color:#fff;
}
.bxcolor3{
	color:#fff;
	background-color:#1ea85e;
	border:1px solid #1ea85e;
}
.bxcolor3:hover{
	background:#02622e;
	border:1px solid #02622e;
	color:#fff;
}
.bxcolor4{
	color:#fff;
	background-color:#bc8e0d;
	border:1px solid #bc8e0d;
}
.bxcolor4:hover{
	background:#846202;
	border:1px solid #846202;
	color:#fff;
}
.bxcolor5{
	color:#fff;
	background-color:#a83785;
	border:1px solid #a83785;
}
.bxcolor5:hover{
	background:#8b0963;
	border:1px solid #8b0963;
	color:#fff;
}
.bxcolor6{
	color:#fff;
	background-color:#2b3e9b;
	border:1px solid #2b3e9b;
}
.bxcolor6:hover{
	background:#071b80;
	border:1px solid #071b80;
	color:#fff;
}
.bxcolor7{
	color:#fff;
	background-color:#02c2a4;
	border:1px solid #02c2a4;
}
.bxcolor7:hover{
	background:#027664;
	border:1px solid #027664;
	color:#fff;
}
.bxcolor8{
	color:#fff;
	background-color:#c25f02;
	border:1px solid #c25f02;
}
.bxcolor8:hover{
	background:#7d3e02;
	border:1px solid #7d3e02;
	color:#fff;
}
.bxcolor9{
	color:#fff;
	background-color:#8333bf;
	border:1px solid #8333bf;
}
.bxcolor9:hover{
	background:#4f0686;
	border:1px solid #4f0686;
	color:#fff;
}




.profile-body {
  font-family: verdana;/*"Segoe UI", Tahoma, Geneva, Verdana, sans-serif;*/
  background: #143966;/*linear-gradient(135deg, #667eea 0%, #764ba2 100%);*/
  min-height: 500px;
}
.profile-card-container {
  width: 100%;
  max-width: 420px;
  padding-top: 10px;
  padding-bottom: 10px;
}
.profile-card {
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(10px);
  border-radius: 20px;
  padding: 10px 30px;
  box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
  border: 1px solid rgba(255, 255, 255, 0.18);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

/*.profile-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 48px 0 rgba(31, 38, 135, 0.5);
}*/

.profile-card-header {
  text-align: center;
  position: relative;
  margin-bottom: 20px;
}

.profile-img {
  width: 120px;
  height: 120px;
  margin: 0 auto 15px;
  border-radius: 50%;
  overflow: hidden;
  border: 4px solid rgba(255, 255, 255, 0.3);
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.profile-img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.status-badge {
  display: inline-block;
  background: #1EE5F7;
  color: #000;
  padding: 6px 16px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 600;
  box-shadow: 0 2px 10px rgba(16, 185, 129, 0.4);
}

.profile-card-body {
  text-align: center;
  color: white;
}

.profile-name {
  font-size: 18px;
  font-weight: 700;
  margin-bottom: 8px;
  color: #fff;
}

.profile-title {
  font-size: 16px;
  color: #000;
  margin-bottom: 15px;
  font-weight: 500;
}

.profile-bio {
  font-size: 14px;
  line-height: 1.6;
  color: #000;
  margin-bottom: 25px;
}

.stats {
  display: flex;
  justify-content: space-around;
  margin-bottom: 25px;
  padding: 20px 0;
  background: rgba(255, 255, 255, 0.05);
  border-radius: 15px;
}

.stat-item h3 {
  font-size: 24px;
  font-weight: 700;
  color: #000;
  margin-bottom: 5px;
}

.stat-item p {
  font-size: 12px;
  color: #000;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.social-links {
  display: flex;
  gap: 10px;
  margin-bottom: 20px;
  justify-content: center;
}

.social-btn {
  flex: 1;
  padding: 10px;
  background: rgba(255, 255, 255, 0.15);
  color: white;
  text-decoration: none;
  border-radius: 10px;
  font-size: 13px;
  font-weight: 600;
  transition: all 0.3s ease;
  border: 1px solid rgba(255, 255, 255, 0.2);
}

.social-btn:hover {
  background: rgba(255, 255, 255, 0.25);
  transform: translateY(-2px);
}

.follow-btn {
  width: 100%;
  padding: 14px;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  border: none;
  border-radius: 12px;
  font-size: 16px;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

.follow-btn:hover {
  transform: scale(1.02);
  box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
}

@media (max-width: 480px) {
  .profile-card {
    padding: 20px;
  }
  
  .stats {
    flex-direction: column;
    gap: 15px;
  }
}


</style>
        <!--==============================header=================================-->
        <form action="" method="post" enctype="multipart/form-data" name="form">
            <!--==============================Content=================================-->
			<div class="content">
				<div class="title"></div>
				<div class="container_12">
					<div class="grid_12" align="center">
						<blockquote class="bq1" style="overflow:auto">
							<!--<div class="grid_12 no-padding-lr">&nbsp;</div>-->
								<div style="padding-left:40px">
									@include('dashboard.CircularBar')
									<div class="div4 p-5 bboxdiv">
										<div class="grid_12" align="center">
											<div class="panel panel-default" style="border:none;">
												<!--<div class="panel-heading" align="left">
													Notifications for verifications & approval
												</div>-->
												<div class="panel-body border">
													
														<div class="profile-body">
															<div class="profile-card-container">
																<div class="profile-card">
																	<div class="profile-card-header">
																	<div class="profile-img">
																		<img src="{{asset('images/staff/Jayanthi.png')}}" alt="Profile">
																	</div>
																	<div class="status-badge">Active</div>
																	</div>
																	
																	<div class="profile-card-body">
																	<h2 class="profile-name">Jayanthi S</h2>
																	
																	<!-- <div class="stats">
																		<div class="stat-item">
																		<h3>1.2K</h3>
																		<p>Followers</p>
																		</div>
																		<div class="stat-item">
																		<h3>847</h3>
																		<p>Following</p>
																		</div>
																		<div class="stat-item">
																		<h3>42</h3>
																		<p>Projects</p>
																		</div>
																	</div> -->
																	
																	<div class="social-links">
																		<a href="#" class="social-btn">Junior Administrative Officer <br/> (Administrative Staff)</a>
																		<!-- <a href="#" class="social-btn">Twitter</a> -->
																	</div>
																	<div class="social-links">
																		<a href="#" class="social-btn"><i class="fa fa-phone" style="font-size:18px"></i> <br/>044-2254 3155</a>
																		<a href="#" class="social-btn"><i class="fa fa-envelope" style="font-size:15px"></i> <br/>jayanthi@imsc.res.in</a>
																	</div>
																	<div class="social-links">
																		<a href="#" class="social-btn"><i class="fa fa-map-marker" style="font-size:18px"></i> &emsp;C03 Main Building</a>
																	</div>
																	
																	<!-- <button class="follow-btn">Follow</button> -->
																	</div>
																</div>
																</div>
															</div>
													
													
												</div>
											</div>
										</div>
									</div>
									<div class="div8 p-5 bboxdiv">
										<div class="grid_12" align="center">
											<div class="panel panel-primary">
												<div class="panel-heading">
													My Dashboard
												</div>
												<div class="panel-body border" style="min-height:50px">
													<div class="div3" style="padding:2px; margin-top:2px;">
														<button type="button" class="tooltip-l tuploadbtn SpanBox" style="cursor: pointer;"><i class="fa fa-download downSpan"></i><span class="downSpanText">Upcoming Seminar</span><span class="tooltiptext" data-html="true">Click here to view upcoming Seminar</span></button>
													</div>
													<div class="div3" style="padding:2px; margin-top:2px;">
														<button type="button" class="tooltip-l tuploadbtn SpanBox" style="cursor: pointer;"><i class="fa fa-download downSpan"></i><span class="downSpanText">Upcoming Conference</span><span class="tooltiptext" data-html="true">Click here to view upcoming Conference</span></button>
													</div>
													<div class="div2" style="padding:2px; margin-top:2px;">
														<button type="button" class="tooltip-l tuploadbtn SpanBox" style="cursor: pointer;"><i class="fa fa-download downSpan"></i><span class="downSpanText">Circular</span><span class="tooltiptext" data-html="true">Click here to view Circular</span></button>
													</div>
													<div class="div2" style="padding:2px; margin-top:2px;">
														<button type="button" class="tooltip-l tuploadbtn SpanBox" style="cursor: pointer;"><i class="fa fa-download downSpan"></i><span class="downSpanText">Notice Board</span><span class="tooltiptext" data-html="true">Click here to view Notice Board</span></button>
													</div>
													<div class="div2" style="padding:2px; margin-top:2px;">
														<button type="button" class="tooltip-l tuploadbtn SpanBox" style="cursor: pointer;"><i class="fa fa-download downSpan"></i><span class="downSpanText">Forms</span><span class="tooltiptext" data-html="true">Click here to view Forms & Downloads</span></button>
													</div>
													
												</div>
											</div>
										</div>
										<div class="div12 p-5 bboxdiv">
											<div class="grid_12" align="center">
												<div class="panel panel-primary">
													<div class="panel-heading">
													<i class="fa fa-tasks" style="font-size:16px; padding-top:3px;"></i> My Desk (Pending Files)
													</div>
													<div class="panel-body border" style="min-height:350px">
														@php
															$EmpWrkCount = [];//Helper::GetEmpWorkDetails(NULL,session('WcmsEmpNo'));
															if(isset($EmpWrkCount['EST'])){
																$ESTCount = $EmpWrkCount['EST'];
															}else{
																$ESTCount = 0;
															}
															if(isset($EmpWrkCount['TS'])){
																$TSCount  = $EmpWrkCount['TS'];
															}else{
																$TSCount  = 0;
															}
															if(isset($EmpWrkCount['NIT'])){
																$NITCount = $EmpWrkCount['NIT'];
															}else{
																$NITCount = 0;
															}
															if(isset($EmpWrkCount['CST'])){
																$CSTCount = $EmpWrkCount['CST'];
															}else{
																$CSTCount = 0;
															}
															if(isset($EmpWrkCount['NCST'])){
																$NCSTCount = $EmpWrkCount['NCST'];
															}else{
																$NCSTCount = 0;
															}
															if(isset($EmpWrkCount['WO'])){
																$WOCount = $EmpWrkCount['WO'];
															}else{
																$WOCount = 0;
															}
															if(isset($EmpWrkCount['RAB'])){
																$RABCount = $EmpWrkCount['RAB'];
															}else{
																$RABCount = 0;
															}
															if(isset($EmpWrkCount['DES'])){
																$DESCount = $EmpWrkCount['DES'];
															}else{
																$DESCount = 0;
															}
															if(isset($EmpWrkCount['GSTRU'])){
																$GSTReimbCount = $EmpWrkCount['GSTRU'];
															}else{
																$GSTReimbCount = 0;
															}
														@endphp


														<div class="row">
															<div class="col-xs-12 col-md-4">
																<div class="color-block-wrapper">
																	<div class="color-block color-block-green color-block-icon-list">
																		<div class="color-block-head">
																		<i class="fa fa-calculator"></i> Leave Request
																		</div>
																		<div class="color-block-text">
																			<div class="infoText bxcolor1 tooltip-l" onclick="RouteRedirect('DEU')">Total Pending Files : {{$ESTCount}} <span class="tooltiptext" data-html="true">Click here to view pending files <div class="row smclearrow"></div></span></div>
																		</div>
																	</div>
																	
																</div>
															</div>
															<div class="col-xs-12 col-md-4">
																<div class="color-block-wrapper">
																	<div class="color-block color-block-green color-block-icon-person">
																		<div class="color-block-head">
																		<i class="fa fa-check-square-o"></i> LTC Advance
																		</div>
																		<div class="color-block-text">
																			<div class="infoText bxcolor2 tooltip-l" onclick="RouteRedirect('TS')">Total Pending Files : {{$TSCount}} <span class="tooltiptext" data-html="true">Click here to view pending files <div class="row smclearrow"></div></span></div>
																		</div>
																	</div>
																	
																</div>
															</div>
															<div class="col-xs-12 col-md-4">
																<div class="color-block-wrapper">
																	<div class="color-block color-block-green color-block-icon-lock">
																		<div class="color-block-head">
																			<i class="fa fa-newspaper-o"></i> LTC Claim Settlement
																		</div>
																		<div class="color-block-text">
																			<div class="infoText bxcolor3 tooltip-l" onclick="RouteRedirect('NIT')">Total Pending Files : {{$NITCount}} <span class="tooltiptext" data-html="true">Click here to view pending files <div class="row smclearrow"></div></span></div>
																		</div>
																	</div>
																	
																</div>
															</div>
															<div class="col-xs-12 col-md-4">
																<div class="color-block-wrapper">
																	<div class="color-block color-block-green color-block-icon-lock">
																		<div class="color-block-head">
																		<i class="fa fa-balance-scale"></i> LTC Advance Clarification (Accounts)
																		</div>
																		<div class="color-block-text">
																			<div class="infoText bxcolor4 tooltip-l" onclick="RouteRedirect('CST')">Total Pending Files : {{$CSTCount}} <span class="tooltiptext" data-html="true">Click here to view pending files <div class="row smclearrow"></div></span></div>
																		</div>
																	</div>
																	
																</div>
															</div>
															<div class="col-xs-12 col-md-4">
																<div class="color-block-wrapper">
																	<div class="color-block color-block-green color-block-icon-lock">
																		<div class="color-block-head">
																		<i class="fa fa-balance-scale"></i> LTC Claim Settlement Clarification (Accounts)
																		</div>
																		<div class="color-block-text">
																			<div class="infoText bxcolor5 tooltip-l" onclick="RouteRedirect('NCST')">Total Pending Files : {{$NCSTCount}} <span class="tooltiptext" data-html="true">Click here to view pending files <div class="row smclearrow"></div></span></div>
																		</div>
																	</div>
																	
																</div>
															</div>
															<div class="col-xs-12 col-md-4">
																<div class="color-block-wrapper">
																	<div class="color-block color-block-green color-block-icon-lock">
																		<div class="color-block-head">
																		<i class="fa fa-file-word-o"></i> Pay Clarification (Accounts)
																		</div>
																		<div class="color-block-text">
																			<div class="infoText bxcolor6 tooltip-l" onclick="RouteRedirect('WO')">Total Pending Files : {{$WOCount}} <span class="tooltiptext" data-html="true">Click here to view pending files <div class="row smclearrow"></div></span></div>
																		</div>
																	</div>
																	
																</div>
															</div>
															<div class="col-xs-12 col-md-4">
																<div class="color-block-wrapper">
																	<div class="color-block color-block-green color-block-icon-lock">
																		<div class="color-block-head">
																		<i class="fa fa-money"></i> Indent Approval request
																		</div>
																		<div class="color-block-text">
																			<div class="infoText bxcolor7 tooltip-l" onclick="RouteRedirect('RAB')">Total Pending Files : {{$RABCount}} <span class="tooltiptext" data-html="true">Click here to view pending files <div class="row smclearrow"></div></span></div>
																		</div>
																	</div>
																	
																</div>
															</div>
															<div class="col-xs-12 col-md-4">
																<div class="color-block-wrapper">
																	<div class="color-block color-block-green color-block-icon-lock">
																		<div class="color-block-head">
																		<i class="fa fa-plus-square-o"></i> Purchase Order Request
																		</div>
																		<div class="color-block-text">
																			<div class="infoText bxcolor8 tooltip-l" onclick="RouteRedirect('DES')">Total Pending Files : {{$DESCount}} <span class="tooltiptext" data-html="true">Click here to view pending files <div class="row smclearrow"></div></span></div>
																		</div>
																	</div>
																	
																</div>
															</div>
															<div class="col-xs-12 col-md-4">
																<div class="color-block-wrapper">
																	<div class="color-block color-block-green color-block-icon-lock">
																		<div class="color-block-head">
																		<i class="fa fa-folder-o"></i> AMC Approval Request
																		</div>
																		<div class="color-block-text">
																			<div class="infoText bxcolor1 tooltip-l" onclick="RouteRedirect('GSTRU')">Total Pending Files : {{$GSTReimbCount}} <span class="tooltiptext" data-html="true">Click here to view pending files <div class="row smclearrow"></div></span></div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row smclearrow">&nbsp;</div>
														</div>





													</div>
												</div>
												
											</div>
										</div>
									</div>


									<!-- <div class="div4 p-5 bboxdiv">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="left">&emsp;Download Excel Templates</div></div></div>
											<div class="card-body padding-1 ChartCard">
												<div class="divrowbox innerdiv pad-0-top">
													<div class="row" align="left">
														<b>
															<div class="row namebox">
																<table class="nborder" width="100%">
																	<tr>
																		<td class="lboxlabel">
																			<button type="button" class="btn btn-default tuploadbtn SpanBox" title="Click here to Download Estimate Excel Files style="cursor: pointer;" onclick="DownloadExcel('estimate')"><i class="fa fa-download"></i><br>Estimate</button>
																		</td>
																		<td class="lboxlabel">
																			<button type="button" class="btn btn-default tuploadbtn SpanBox" title="Click here to Download Estimate Measurements Files" style="cursor: pointer;" onclick="DownloadExcel('measurement')"><i class="fa fa-download"></i><br>Estimate <br> Measurement</button>
																		</td>
																		<td class="lboxlabel">
																			<button type="button" class="btn btn-default tuploadbtn SpanBox" title="Click here to Download Steel Measurement (Billing) Excel Files" style="cursor: pointer;" onclick="DownloadExcel('steel')"><i class="fa fa-download"></i><br>Steel <br> Measurement</button>
																		</td>
																		<td class="lboxlabel">
																			<button type="button" class="btn btn-default tuploadbtn SpanBox" title="Click here to Download Standard Measurement (Billing) Excel Files" style="cursor: pointer;" onclick="DownloadExcel('standard')"><i class="fa fa-download"></i><br>Standard <br> Measurement</button>
																		</td>
																	</tr>
																	<tr>
																		<td class="lboxlabel" colspan="4">
																			<button type="button" class="btn btn5 btn-default tuploadbtn SpanBox" title="Click here to Download Combined Excel Files" style="cursor: pointer;" onclick="DownloadExcel('combined')"><i class="fa fa-download"></i><br>Click here to download all template in single Excel file</button>
																		</td>
																	</tr>
																</table>
															</div>
														</b> 
													</div>
												</div>
											</div>
											<div class="grid_12" align="center">
											<div class="Btn-3Check" style="margin-top:2px;">
												<input name="PriorAppln[]" id="DeptEstFormat" type="checkbox" class="3dCheck FileFormat" style="display:none" value="DEST" data-url="DeptEstimateSampleFileFormat" checked="checked"/>
												<label class="ChLable" for="DeptEstFormat">Click here to view Dept. Estimate file format</label>
											</div>
											
											<div class="Btn-3Check">
												<input name="PriorAppln[]" id="DeptEstExcel" type="checkbox" class="3dCheck" style="display:none" value="PA" disabled="disabled" checked="checked"/>
												<label class="ChLable" for="DeptEstExcel">
													<a href="#" style="color:#2F373E" title="Click here to download Department Estimate template file">
														Click here to download Dept. Estimate template
													</a>
												</label>
											</div>
											
											<div class="Btn-3Check">
												<input name="PriorAppln[]" id="FinBidFormat" type="checkbox" class="3dCheck FileFormat" style="display:none" value="FBID" data-url="FinancialBidSampleFileFormat" checked="checked"/>
												<label class="ChLable" for="FinBidFormat">Click here to view Financial Bid file format</label>
											</div>
											
											<div class="Btn-3Check">
												<input name="PriorAppln[]" id="FinBidExcel" type="checkbox" class="3dCheck" style="display:none" value="PA" disabled="disabled" checked="checked"/>
												<label class="ChLable" for="FinBidExcel">
													<a href="#" style="color:#2F373E" title="Click here to download Financial Bid template file">
														Click here to download Financial Bid template
													</a>
												</label>
											</div>
											
											<div class="Btn-3Check" style="margin-top:2px;">
												<input name="PriorAppln[]" id="GenMeasFormat" type="checkbox" class="3dCheck FileFormat" style="display:none" value="GNL" data-url="GeneralMeasSampleFormat" checked="checked"/>
												<label class="ChLable" for="GenMeasFormat">Click here to view Gen. Measurement file format</label>
											</div>
											
											<div class="Btn-3Check">
												<input name="PriorAppln[]" id="GenMeasExcel" type="checkbox" class="3dCheck" style="display:none" value="PA" disabled="disabled" checked="checked"/>
												<label class="ChLable" for="GenMeasExcel">
													<a href="#" style="color:#2F373E" title="Click here to download Department Estimate template file">
														Click here to download Gen. Measure. template
													</a>
												</label>
											</div>
											
											<div class="Btn-3Check">
												<input name="PriorAppln[]" id="StlMeasFormat" type="checkbox" class="3dCheck FileFormat" style="display:none" value="STL" data-url="SteelMeasSampleFormat" checked="checked"/>
												<label class="ChLable" for="StlMeasFormat">Click here to view Steel Measurement file format</label>
											</div>
											
											<div class="Btn-3Check">
												<input name="PriorAppln[]" id="StlMeasExcel" type="checkbox" class="3dCheck" style="display:none" value="PA" disabled="disabled" checked="checked"/>
												<label class="ChLable" for="StlMeasExcel">
													<a href="#" style="color:#2F373E" title="Click here to download Financial Bid template file">
														Click here to download Steel Measure. template
													</a>
												</label>
											</div>
											
										</div>
									</div> -->

								</div>



						</blockquote>
					</div>
				</div>
			</div>
			
			
			
			
            <!--==============================footer=================================-->
        </form>
<link href="{!! url('assets/FlowChart/flow-chart.css') !!}">
<script src="{!! url('assets/FlowChart/flow-chart.js') !!}"></script>

<script> 
$(function(){
	var ep = new Vue({
		el: "#ep-flowchart",
		data: {
			selected: ""
		},
		methods: {}
	});

	//$(window).load(function() {
		/*$.ajax({
			type:'POST',
			url: "{{ route('dashboard.GetDashboardDetails') }}",
			data: {'_token': '{{ csrf_token() }}','page': 'CSTUSERWAITINGLIST'},
			success:function(data){
				if(data){ 
					if(data != null){ 
						//$("#DboardCSTUserWaitingCount").text(data);
					}else{
						$("#DboardCSTUserWaitingCount").text('0');
					}
				}
			}
		});*/
	//});
	//$(window).load(function() {
		/*$.ajax({
			type:'POST',
			url: "{{ route('dashboard.GetDashboardDetails') }}",
			data: {'_token': '{{ csrf_token() }}','page': 'NEGOCSTUSERWAITINGLIST'},
			success:function(data){
				if(data){ 
					if(data != null){ 
						$("#DboardNEGOCSTUserWaitingCount").text(data);
					}else{
						$("#DboardNEGOCSTUserWaitingCount").text('0');
					}
				}
			}
		});*/
	//});
	/*
	//$(window).load(function() {
		$.ajax({
			type:'POST',
			url: "{{ route('dashboard.GetDashboardDetails') }}",
			data: {'_token': '{{ csrf_token() }}','page': 'CSTACCWAITINGLIST'},
			success:function(data){
				if(data){ 
					if(data != null){ 
						$("#DboardCSTUserWaitingCount").text(data);
					}else{
						$("#DboardCSTUserWaitingCount").text('0');
					}
				}
			}
		});
	//});
	//$(window).load(function() {
		$.ajax({
			type:'POST',
			url: "{{ route('dashboard.GetDashboardDetails') }}",
			data: {'_token': '{{ csrf_token() }}','page': 'RABACCWAITINGLIST'},
			success:function(data){
				if(data){ 
					if(data != null){ 
						$("#DboardRABAccWaitingCount").text(data);
					}else{
						$("#DboardRABAccWaitingCount").text('0');
					}
				}
			}
		});
	//});
	//$(window).load(function() {
		$.ajax({
			type:'POST',
			url: "{{ route('dashboard.GetDashboardDetails') }}",
			data: {'_token': '{{ csrf_token() }}','page': 'BGEXPLIST'},
			success:function(data){
				if(data){// alert(data);
					if(data != null){
						$("#DboardBGEXPLISTCount").text(data);
					}else{
						$("#DboardBGEXPLISTCount").text('0');
					}
				}
			}
		});
	//});
	//$(window).load(function() {
		$.ajax({
			type:'POST',
			url: "{{ route('dashboard.GetDashboardDetails') }}",
			data: {'_token': '{{ csrf_token() }}','page': 'FDREXPLIST'},
			success:function(data){
				if(data){ //alert(data);
					if(data != null){
						$("#DboardFDREXPLISTCount").text(data);
					}else{
						$("#DboardFDREXPLISTCount").text('0');
					}
				}
			}
		});
	//});
	//$(window).load(function() {
		$.ajax({
			type:'POST',
			url: "{{ route('dashboard.GetDashboardDetails') }}",
			data: {'_token': '{{ csrf_token() }}','page': 'PGRELEASELIST'},
			success:function(data){
				if(data){ //alert(data);
					if(data != null){
						$("#DboardPGRELEASELISTCount").text(data);
					}else{
						$("#DboardPGRELEASELISTCount").text('0');
					}
				}
			}
		});
	//});
	//$(window).load(function() {
		$.ajax({
			type:'POST',
			url: "{{ route('dashboard.GetDashboardDetails') }}",
			data: {'_token': '{{ csrf_token() }}','page': 'SDRELEASELIST'},
			success:function(data){
				if(data){ //alert(data);
					if(data != null){
						$("#DboardSDRELEASELISTCount").text(data);
					}else{
						$("#DboardSDRELEASELISTCount").text('0');
					}
				}
			}
		});
	//});
	//$(window).load(function() {
		$.ajax({
			type:'POST',
			url: "{{ route('dashboard.GetDashboardDetails') }}",
			data: {'_token': '{{ csrf_token() }}','page': 'COMPLETTRLIST'},
			success:function(data){
				if(data){ 
					if(data != null){
						$("#DboardCOMPLIANCELETTERCount").text(data);
					}else{
						$("#DboardCOMPLIANCELETTERCount").text('0');
					}
				}
			}
		});
	//});
	//$(window).load(function() {
		$.ajax({
			type:'POST',
			url: "{{ route('dashboard.GetDashboardDetails') }}",
			data: {'_token': '{{ csrf_token() }}','page': 'EMDRETURNLIST'},
			success:function(data){
				if(data){ //alert(data);
					if(data != null){
						$("#DboardEMDDDRETURNLISTCount").text(data);
					}else{
						$("#DboardEMDDDRETURNLISTCount").text('0');
					}
				}
			}
		});
	//});

	//$(window).load(function() {
		$.ajax({
			type:'POST',
			url: "{{ route('dashboard.GetDashboardDetails') }}",
			data: {'_token': '{{ csrf_token() }}','page': 'REVISEDTSLIST'},
			success:function(data){
				if(data){ 
					if(data != null){ 
						$("#DboardRevTsUserWaitingCount").text(data);
					}else{
						$("#DboardRevTsUserWaitingCount").text('0');
					}
				}
			}
		});
	//});	

	//$(window).load(function() {
		$.ajax({
			type:'POST',
			url: "{{ route('dashboard.GetDashboardDetails') }}",
			data: {'_token': '{{ csrf_token() }}','page': 'LOALIST'},
			success:function(data){
				if(data){ 
					if(data != null){ 
						$("#DboardLOACount").text(data);
					}else{
						$("#DboardLOACount").text('0');
					}
				}
			}
		});
	//});

	//$(window).load(function() {
		$.ajax({
			type:'POST',
			url: "{{ route('dashboard.GetDashboardDetails') }}",
			data: {'_token': '{{ csrf_token() }}','page': 'PSDUSERLIST'},
			success:function(data){
				if(data){ 
					if(data != null){ 
						$("#DboardPSDCount").text(data);
					}else{
						$("#DboardPSDCount").text('0');
					}
				}
			}
		});
	//});
	*/
	function ConvertIndianRsFormat(Amount){
		var AmountStr = Number(Amount).toLocaleString('en-IN');
		var AmountStrSplit = AmountStr.split(".");
		if(AmountStrSplit.length == 2){Stmt
			var Rupees = AmountStrSplit[0];
			var Paise  = AmountStrSplit[1];
			if(Paise.length == 0){
				var PaiseStr = "00";
			}else if(Paise.length == 1){
				var PaiseStr = Paise+"0";
			}else{
				var PaiseStr = Paise;
			}
			Amount = Rupees+"."+PaiseStr;
		}else{
			Amount = AmountStr+".00";
		}
		return Amount;
		
	}
	
});	
</script>
 
<style>
.bootstrap-dialog .bootstrap-dialog-title{
	font-size:12px;
}
.modal-header {
  	min-height: 16.43px;
  	padding: 8px 15px 8px 15px;
	border-bottom: 1px solid #e5e5e5;
}
.modal-body{
	padding: 8px 15px 15px 15px;
}
.bootstrap-dialog .bootstrap-dialog-title, .modal-body{
	font-family:Verdana, Arial, Helvetica, sans-serif;
}
</style>
@endsection