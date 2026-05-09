@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<script type="text/javascript">
	window.history.forward();
	function noBack() { window.history.forward(); }
</script>


<script>

function DownloadExcel(FileType) {
	window.location = "{{ route('reports.DownloadExcel') }}?type=" + FileType;
}
function RouteRedirect(Page) {
	if(Page == "DEU"){
		window.location = "{{ route('estimate.TenderEstimateDraftSubmitList') }}";
	}else if(Page == "TS"){
		window.location = "{{ route('Ts.ViewAndSubmitTS') }}";
	}else if(Page == "NIT"){
		window.location = "{{ route('tender.ViewAndSubmitNIT') }}";
	}else if(Page == "CST"){
		window.location = "{{ route('cst.WorksCSTListUser') }}";
	}else if(Page == "NCST"){
		window.location = "{{ route('cst.WorksNegoCSTListUser') }}";
	}else if(Page == "WO"){
		window.location = "{{ route('workorder.WorkOrderDraftList') }}";
	}else if(Page == "RAB"){
		window.location = "{{ route('rab.RABUserVerificationList') }}";
	}else if(Page == "DES"){
		window.location = "{{ route('item.ViewAdditionalQuantity') }}";
	}
}
</script>
	
<style>
.SpanBox{
	width:100%;
	margin:0px;
	font-size:13px;
	font-weight:500;
	padding:8px 4px;
}
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
  height: 280px;
  /* margin-top: 75px; */
  position: relative;
  margin-top:10px;
  background:#EAEBED;
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
  font-size: 13px;
  line-height: 1;
  margin-bottom: 20px;
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
  z-index: 30;
  color:#005bb7;
}
/* .color-block-lblue:before {
  background: #0064ca;
}
.color-block-lblue:after {
  background: #007fff;
} */

.color-block-dblue {
  background: #004387;
}
/* .color-block-dblue:before {
  background: #0c457e;
}
.color-block-dblue:after {
  background: #135ba5;
} */

.color-block-green {
  /* background: #49ac01; */
  /* border:2px solid #9ABEB9; */
  color:#005bb7;
}
/* .color-block-green:before {
  background: #03FCD6;
}
.color-block-green:after {
  background: #C1F6EE;
  opacity: 0.4;
} */
.infoText{
	border:1px solid #3E565F;
	border-radius:4px;
	padding:2px 4px;
	cursor: pointer !important;
}
.infoText:hover{
	color:#000;
	background-color:#D4D7D9;
}


.outer-w3-agile {
  padding: 1em 1em;
  padding: 2em 1em;
  -webkit-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0.25) !important;
  -moz-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0.25) !important;
  box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0.25) !important;
  background: #fff;
}
.card-columns .card {
  margin-bottom: 0px;
}
.counter{
    text-align: center;
    height: 150px;
    width: 285px;
    padding: 7px 4px 0;
    margin: 0 auto;
    position: relative;
    z-index: 1;
    cursor: pointer;
}
.counter:before{
    content: '';
    background-color: #fff;
    height: 200px;
    width: 200px;
    border-radius: 15px;
    border: 5px solid #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1) inset;
    transform: translateX(-50%) translateY(-50%) rotate(45deg);
    position: absolute;
    left: 50%;
    top: 61%;
    z-index: -1;
}
.counter:hover::before {
    content: '';
    background-color: #DEE4EA;
}
.counter .counter-icon{
    color: #fff;
    background: linear-gradient(#F83F83,#E2056F);
    line-height: 36px;
    font-size: 15px;
    height: 37px;
    width: 37px;
    margin: 0 auto 8px;
    border-radius: 19px 0 50px;
    transform: rotate(45deg);
	top: -42px;
  	position: relative;
}
.counter .counter-icon i{ transform: rotate(-45deg); }
.counter .counter-value{
    font-size: 18px;
    font-weight: bold;
    letter-spacing: 1px;
    margin: 0 0 11px 0;
    display: block;
    font-family:'Open Sans', sans-serif;
    padding-top:6px;
}
.counter h3{
    color: #fff;
    background: linear-gradient(#F83F83,#E2056F);
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: capitalize;
    padding: 4px 5px;
    margin: 0;
    border-radius: 0 0 20px 20px;
    position: relative;
	top:22px;
}
.counter h3:before,
.counter h3:after{
    content: "";
    background: linear-gradient(to right bottom, transparent 49%,#c90460 50%);
    width: 20px;
    height: 20px;
    position: absolute;
    top: -20px;
    left: 0;
    z-index: -2;
}
.counter h3:after{
    transform: rotateY(180deg);
    left: auto;
    right: 0;
}
.counter.purple .counter-icon,
.counter.purple h3{
    background: linear-gradient(#B05FDF,#7B26DD);
}
.counter.purple h3:before,
.counter.purple h3:after{
    background: linear-gradient(to right bottom,transparent 49%,#5a07bf 50%);
}
.counter.blue .counter-icon,
.counter.blue h3{
    background: linear-gradient(#00BCF9,#027AF6);
}
.counter.blue h3:before,
.counter.blue h3:after{
    background: linear-gradient(to right bottom,transparent 49%,#0466c9 50%);
}
.counter.green .counter-icon,
.counter.green h3{
    background: linear-gradient(#aff400,#6cc425);
}
.counter.green h3:before,
.counter.green h3:after{
    background: linear-gradient(to right bottom,transparent 49%,#489e03 50%);
}


.counter.navy .counter-icon,
.counter.navy h3{
    background: linear-gradient(#1047c6,#0441ce);
}
.counter.navy h3:before,
.counter.navy h3:after{
    background: linear-gradient(to right bottom,transparent 49%,#03246e 50%);
}

.counter.gold .counter-icon,
.counter.gold h3{
    background: linear-gradient(#a59a11,#c4b503);
}
.counter.gold h3:before,
.counter.gold h3:after{
    background: linear-gradient(to right bottom,transparent 49%,#857c05 50%);
}


.counter.seagreen .counter-icon,
.counter.seagreen h3{
    background: linear-gradient(#1ab1b2,#05a1a2);
}
.counter.seagreen h3:before,
.counter.seagreen h3:after{
    background: linear-gradient(to right bottom,transparent 49%,#018889 50%);
}

.counter.darkpink .counter-icon,
.counter.darkpink h3{
    background: linear-gradient(#97097d,#b11e96);
}
.counter.darkpink h3:before,
.counter.darkpink h3:after{
    background: linear-gradient(to right bottom,transparent 49%,#70045c 50%);
}




@media screen and (max-width:990px){
    .counter{ margin-bottom: 40px; }
}


.counter2{
    color: #fff;
    font-family: 'Open Sans', sans-serif;
    text-align: center;
    width: 100%;
    min-height: 150px;
    padding: 25px 0 0;
    margin: 0 auto;
    position: relative;
    z-index: 1;
    cursor: pointer;
}
.counter2:after{
    content: '';
    background:linear-gradient(to right, #eff0f2, #ffffff);/*#fefefe*/
    height: 93px;
    width: 93px;
    border-radius: 15px;
    border: 3px solid #fff;
    box-shadow: 5px 0 8px rgba(0, 0, 0, 0.2);
    transform: translateX(-50%) rotate(45deg);
    position: absolute;
    top: 22px;
    left: 50%;
    z-index: -1;
}
.counter2:hover::after {
    content: '';
    background: #DEE4EA;
}

.counter2 .counter2-value{
    background:#E2056F;
    font-size: 14px;
    font-weight: 600;
    /*letter-spacing: 2px;*/
    width: 100%;
    padding: 0px 0 0px;
    border-radius: 10px;
    box-shadow: inset 0 0 6px rgba(0,0,0,0.6),0 0 0 2px #fff;
    position: absolute;
    left: 0;
    bottom: 0;
    z-index: -1;
}
.counter2 .counter2-icon{
    background: linear-gradient(to right,#D50256,#F30261);
    font-size: 13px;
    line-height: 27px;
    width: 30px;
    height: 30px;
    margin: 0 auto 20px;
    border-radius: 50%;
    border: 2px solid #fff;
    box-shadow: 4px 4px 4px rgba(0,0,0,0.4);
}
.counter2 h3{
    color: #f83600;
    font-size: 17px;
    font-weight: bold;
    text-transform: capitalize;
    line-height: 10px;
    padding: 0 30px;
    margin: 0 0 15px;
}
.counter2.green .counter2-value{ background: #05A1B5; }
.counter2.green .counter2-icon{ background: linear-gradient(to right,#05A1B5,#036C79); }
.counter2.green h3{ color: #019b01; }
.counter2.blue .counter2-value{ background: #027AF6; }
.counter2.blue .counter2-icon{ background: linear-gradient(to right,#28a9e2,#0057c5); }
.counter2.blue h3{ color: #0057c5; }
.counter2.gray .counter2-value{ background: #36474f; }
.counter2.gray .counter2-icon{ background: linear-gradient(to right,#36474f,#0d0e10); }
.counter2.gray h3{ color: #0d0e10; }
@media screen and (max-width:990px){
    .counter2{ margin-bottom: 40px; }
}   
#sidebar {
  background: #fff;
}
.navbar{
    padding: 5px 10px 0px 10px;  
}
.navbar-btn{
    margin:0px 1px;
}
.counter-icon .fa-home::before,
.counter-icon .fa-university::before,
.counter-icon .fa-inr::before,
.counter-icon .fa-check-square-o::before,
.counter-icon .fa-handshake-o::before,
.counter-icon .fa-tasks::before{
    top: 2px;
  	position: relative;
  	left: -7px;
	font-size:16px;
}
#myModal{
    box-sizing:border-box;
    padding:0px !important;
}
.login-modal{
    width:400px !important;
    border-radius:5px;
}
.login-bradius{
    border-radius:0px 0px 0px 0px;
}
.modal-backdrop.in {
  filter: alpha(opacity=50);
  opacity: 0.8;
}


.login-wrap {
  position: relative;
  background: #000232;
  border-radius: 5px;
  padding-left: 30px;
  padding-right: 30px;
  padding-top: 20px !important;
  -webkit-box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 0.24);
  -moz-box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 0.24);
  box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 0.24);
}
.login-wrap .img {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  margin: 0 auto;
    margin-bottom: 0px;
  margin-bottom: 20px;
  background-size: cover;
background-repeat: no-repeat;
background-position: center center;
margin-top:12px;

}

.form-control {
  height: 48px;
  background: rgba(0, 0, 0, 0.05);
  color: #fff !important;
  font-size: 16px;
  -webkit-box-shadow: none;
  box-shadow: none;
  border-radius: 0;
  border: none;
    border-bottom-color: currentcolor;
    border-bottom-style: none;
    border-bottom-width: medium;
  border-bottom: 1px solid #00bcd4;
  padding-left: 30px;
  padding-right: 0;
  letter-spacing: 1px;
  -webkit-transition: all 0.2s ease-in-out;
  -o-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
  font-family: 'Poiret One', cursive;
}

.form-group {
  position: relative;
}

.form-group .icon span {
  color: #fff;
}
*, ::before, ::after {
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}
.d-flex {
  display: -webkit-box !important;
  display: -ms-flexbox !important;
  display: flex !important;
}
.justify-content-center {
  -webkit-box-pack: center !important;
  -ms-flex-pack: center !important;
  justify-content: center !important;
}
.align-items-center {
  -webkit-box-align: center !important;
  -ms-flex-align: center !important;
  align-items: center !important;
}
.form-group .icon {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  width: 20px;
  height: 48px;
  background: transparent;
  font-size: 18px;
}
.login-wrap h3 {
  font-weight: 600;
  font-size: 28px;
  color: #fff;
  text-transform: uppercase;
  letter-spacing: 1px;
}
.login-wrap p {
  color: #fff;
  font-family: "Lato", Arial, sans-serif;
  font-size: 12px;
  margin-top:4px;
  margin-bottom:20px;
  font-style:italic;
}
.text-center {
  text-align: center !important;
}
.ibtn{
    color:#000232 !important;
}
.form-control:focus, .form-control:active{
    color:#fff !important;
    background: rgba(0, 0, 0, 0.05);
}
.logo-font{
    font-size:14px !important;
    margin-bottom:10px !important;
}
.modal-dialog {
  width: 70%;
}
.bootstrap-dialog .bootstrap-dialog-message {
  font-size: 11px;
  color: #1844C4;
  font-family: verdana;/*'Open Sans', sans-serif;*/
  font-weight:600;
}
.tooltip {
    z-index: 1090; 
}
ul.list-unstyled li {
    letter-spacing: 0px;
}


.tooltip-new {
    position: relative;
    /*display: inline-block;*/
    /*border-bottom: 1px dotted black;*/
}

.tooltip-new .tooltiptext {
    /*visibility: hidden;*/
	display:none;
    width:450px;
    background-color:#000;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding:10px;
    position: absolute;
    z-index: 1;
    top: 125%;
    left: 6%;
    margin-left: 0px;
}

.tooltip-new .tooltiptext::after {
    content: "";
    position: absolute;
    bottom: 100%;
    left: 10px;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: transparent transparent black transparent;
}

.tooltip-new:hover .tooltiptext {
    visibility: visible;  display:block;
	letter-spacing:0px;
}
.tooltipcontent{
    text-align:left;
    font-size:12px;
    font-family: 'Open Sans', sans-serif;
}
.tooltipcontent2{
    text-align:left;
    font-size:13px;
    font-family: 'Open Sans', sans-serif;
}
.tab-btn{
    background-color: #ffffff !important;
    color:#1844C4 !important;
    text-shadow:none;
    border:1px solid #215AC6;
    box-shadow: 0 2px 2px 0 rgba(33,90,198,.14),0 3px 1px -2px rgba(33,90,198,.2),0 1px 5px 0 rgba(33,90,198,.12) !important;
}
.tab-btn-active{
    background-color: #215AC6 !important;
    color:#fff !important;
    text-shadow:none;
    border:1px solid #215AC6;
}
.scrollbar-1 {
	scrollbar-width: thin;
	scrollbar-color: #ff7f00 #b0b7c4;
  }
  .scrollbar-1::-webkit-scrollbar {
	width: 8px;
	height: 8px;
  }
  .scrollbar-1::-webkit-scrollbar-track {
	background-clip: content-box;
	border: 2px solid transparent;
  }
  .scrollbar-1::-webkit-scrollbar-thumb {
	background-color: #ff7f00;
  }
  .scrollbar-1::-webkit-scrollbar-thumb:hover {
	background-color: #e67200;
  }
  .scrollbar-1::-webkit-scrollbar-corner, .scrollbar-1::-webkit-scrollbar-track {
	background-color: #b0b7c4;
  }
  
  .scrollbar-2 {
	scrollbar-width: thin;
	scrollbar-color: #EFEFF0 #fff;
  }
  .scrollbar-2::-webkit-scrollbar {
	width: 5px;
	height: 5px;
  }
  .scrollbar-2::-webkit-scrollbar-track {
	background-color: #bbb;
  }
  .scrollbar-2::-webkit-scrollbar-thumb {
	background-color: #676D6D;
  }
  .scrollbar-2::-webkit-scrollbar-track, .scrollbar-2::-webkit-scrollbar-thumb {
	border-radius: 12px;
  }
  div.ganttview {
    border: 1px solid #E4E5E7 !important;
  }
  div.ganttview-slide-container{
    border-left: 1px solid #E4E5E7 !important;
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
									<div class="div12 p-5 bboxdiv">
										<!-- <div class="grid_12" align="center">
											<div class="panel panel-primary">
												<div class="panel-heading">
													Download Excel Templates
												</div>
												<div class="panel-body border" style="min-height:50px">
													<div class="div2" style="padding:2px; margin-top:2px;">
														<button type="button" class="btn btn-default tuploadbtn SpanBox" title="Click here to Download Estimate Excel Files" style="cursor: pointer;" onclick="DownloadExcel('estimate')"><i class="fa fa-download"></i> Estimate</button>
													</div>
													<div class="div2" style="padding:2px; margin-top:2px;">
														<button type="button" class="btn btn-default tuploadbtn SpanBox" title="Click here to Download Estimate Measurements Files" style="cursor: pointer;" onclick="DownloadExcel('measurement')"><i class="fa fa-download"></i> Estimate Measurement</button>
													</div>
													<div class="div2" style="padding:2px; margin-top:2px;">
														<button type="button" class="btn btn-default tuploadbtn SpanBox" title="Click here to Download Steel Measurement (Billing) Excel Files" style="cursor: pointer;" onclick="DownloadExcel('steel')"><i class="fa fa-download"></i> Steel Measurement</button>
													</div>
													<div class="div2" style="padding:2px; margin-top:2px;">
														<button type="button" class="btn btn-default tuploadbtn SpanBox" title="Click here to Download Standard Measurement (Billing) Excel Files" style="cursor: pointer;" onclick="DownloadExcel('standard')"><i class="fa fa-download"></i> Standard Measurement</button>
													</div>
													<div class="div4" style="padding:2px; margin-top:2px;">
														<button type="button" class="btn btn btn-default tuploadbtn SpanBox" title="Click here to Download Combined Excel Files" style="cursor: pointer;" onclick="DownloadExcel('combined')"><i class="fa fa-download"></i> Click here to download all template in single Excel file</button>
													</div>
												</div>
											</div>
										</div> -->
										<div class="div12 p-5 bboxdiv" style="margin-top:2px">
											<div class="grid_12" align="center">
												<div class="panel panel-primary" style="border-radius:9px">
													<div class="divhead">
														My Dashboard (Work Information) 
													</div>
													<div class="panel-body border no-padding" style="min-height:350px;">
														@php
															$WorkData = Helper::AdminDashBoardData(NULL); //dd($WorkData);
															if(isset($WorkData['TotExeWork'])){
																$TotExeWork = $WorkData['TotExeWork'];
															}else{
																$TotExeWork = 0;
															}
															if(isset($WorkData['TotWorderIssued'])){
																$TotWorderIssued  = $WorkData['TotWorderIssued'];
															}else{
																$TotWorderIssued  = 0;
															}
															if(isset($WorkData['TotLiveWork'])){
																$TotLiveWork = $WorkData['TotLiveWork'];
															}else{
																$TotLiveWork = 0;
															}
															if(isset($WorkData['TotPassedAmt'])){
																$TotPassedAmt = $WorkData['TotPassedAmt'];
															}else{
																$TotPassedAmt = 0;
															}
                              if(isset($WorkData['EST'])){
																$EstimatePrepared = $WorkData['EST'];
															}else{
																$EstimatePrepared = 0;
															}
                              if(isset($WorkData['TS'])){
																$TSPrepared = $WorkData['TS'];
															}else{
																$TSPrepared = 0;
															}
                              if(isset($WorkData['NIT'])){
																$NITPrepared = $WorkData['NIT'];
															}else{
																$NITPrepared = 0;
															}
                              if(isset($WorkData['BILL'])){
																$BillPrepared = $WorkData['BILL'];
															}else{
																$BillPrepared = 0;
															}
                              if(isset($WorkData['WO'])){
																$WorkOrderIssued = $WorkData['WO'];
															}else{
																$WorkOrderIssued = 0;
															}
                              if(isset($WorkData['WORK'])){
																$WorkCreated = $WorkData['WORK'];
															}else{
																$WorkCreated = 0;
															}
                              if(isset($WorkData['PAID'])){
																$TotalPaidAmount = $WorkData['PAID'];
															}else{
																$TotalPaidAmount = 0;
															}	
                              if(isset($WorkData['LIVE'])){
																$TotalLiveWorks = $WorkData['LIVE'];
															}else{
																$TotalLiveWorks = 0;
															}														
														@endphp



                            

														<div class="row no-padding">

                              <div class="col-xs-12 col-md-3 " onclick="window.location='{{ route('reports.WorkPrepared', ['TYPE' => encrypt('WORK')]) }}'">
																<div class="color-block-wrapper">
																	<div class="color-block color-block-green color-block-icon-list">
																		<div class="color-block-head">
																			&nbsp;
																		</div>
																		<div class="">
																			<div class="counter purple Upcoming" data-id="SIRD">
																				<div class="counter-icon">
																					<i class="fa fa-tasks"></i>
																				</div>
																				<span class="counter-value" id="SIRDUpcomingCnt">{{$WorkCreated}} Nos.</span>
																				<h3>Total Work Created</h3>
																			</div>
																		</div>
																	</div>
																	
																</div>
															</div>



															<div class="col-xs-12 col-md-3" id="estmiate" onclick="window.location='{{ route('reports.WorkPrepared', ['TYPE' => encrypt('EST')]) }}'">
																<div class="color-block-wrapper">
																	<div class="color-block color-block-green color-block-icon-list">
																		<div class="color-block-head">
																			&nbsp;
																		</div>
																		<div class="">
																			<div class="counter navy Upcoming" data-id="SIRD">
																				<div class="counter-icon">
																					<i class="fa fa-tasks"></i>
																				</div>
																				<span class="counter-value" id="SIRDUpcomingCnt">{{$EstimatePrepared}} Nos. </span>
																				<h3>No. of Estimate Prepared</h3>
																			</div>
																		</div>
																	</div>
																	
																</div>
															</div>


															<div class="col-xs-12 col-md-3" onclick="window.location='{{ route('reports.WorkPrepared', ['TYPE' => encrypt('TS')]) }}'">
																<div class="color-block-wrapper">
																	<div class="color-block color-block-green color-block-icon-person">
																		<div class="color-block-head">
																			&nbsp;
																		</div>
																		<div class="">
																			<div class="counter gold Upcoming" data-id="SIRD">
																				<div class="counter-icon">
																					<i class="fa fa-handshake-o"></i>
																				</div>
																				<span class="counter-value" id="SIRDUpcomingCnt">{{$TSPrepared}} Nos.</span>
																				<h3>No. of TS Prepared</h3>
																			</div>
																		</div>
																	</div>
																	
																</div>
															</div>

                              <div class="col-xs-12 col-md-3" onclick="window.location='{{ route('reports.WorkPrepared', ['TYPE' => encrypt('NIT')]) }}'">
																<div class="color-block-wrapper">
																	<div class="color-block color-block-green color-block-icon-lock">
																		<div class="color-block-head">
																			&nbsp;
																		</div>
																		<div class="">
																			<div class="counter seagreen Upcoming" data-id="SIRD">
																				<div class="counter-icon">
																					<i class="fa fa-inr" aria-hidden="true"></i>
																				</div>
																				<span class="counter-value" id="SIRDUpcomingCnt">{{$NITPrepared}} Nos.</span>
																				<h3>No. of NIT Prepared</h3>
																			</div>
																		</div>
																	</div>
																</div>
															</div>

                            </div>

                            <div class="row">

                              <div class="col-xs-12 col-md-3" onclick="window.location='{{ route('reports.WorkPrepared', ['TYPE' => encrypt('WO')]) }}'">
																<div class="color-block-wrapper">
																	<div class="color-block color-block-green color-block-icon-person">
																		<div class="color-block-head">
																			&nbsp;
																		</div>
																		<div class="">
																			<div class="counter blue Upcoming" data-id="SIRD">
																				<div class="counter-icon">
																					<i class="fa fa-handshake-o"></i>
																				</div>
																				<span class="counter-value" id="SIRDUpcomingCnt">{{$WorkOrderIssued}} Nos.</span>
																				<h3>Total Work Order Issued</h3>
																			</div>
																		</div>
																	</div>
																	
																</div>
															</div>


															<div class="col-xs-12 col-md-3" onclick="window.location='{{ route('reports.WorkPrepared', ['TYPE' => encrypt('BILL')]) }}'">
																<div class="color-block-wrapper">
																	<div class="color-block color-block-green color-block-icon-lock">
																		<div class="color-block-head">
                                      &nbsp;
																		</div>
																		<div class="">
																			<div class="counter darkpink Upcoming" data-id="SIRD">
																				<div class="counter-icon">
																					<i class="fa fa-check-square-o"></i>
																				</div>
																				<span class="counter-value" id="SIRDUpcomingCnt">{{$BillPrepared}} Nos.</span>
																				<h3>No. of Bill executed</h3>
																			</div>
																		</div>
																	</div>
																</div>
															</div>

															

															<div class="col-xs-12 col-md-3" onclick="window.location='{{ route('reports.WorkPrepared', ['TYPE' => encrypt('PAID')]) }}'">
																<div class="color-block-wrapper">
																	<div class="color-block color-block-green color-block-icon-lock">
																		<div class="color-block-head">
																			&nbsp;
																		</div>
																		<div class="">
																			<div class="counter green Upcoming" data-id="SIRD">
																				<div class="counter-icon">
																					<i class="fa fa-inr" aria-hidden="true"></i>
																				</div>
																				<span class="counter-value" id="SIRDUpcomingCnt">{{round(($TotalPaidAmount/100000),2)}} Lakhs</span>
																				<h3>Total Paid Amount</h3>
																			</div>
																		</div>
																	</div>
																</div>
															</div>

															<div class="col-xs-12 col-md-3" onclick="window.location='{{ route('reports.WorkPrepared', ['TYPE' => encrypt('LIVE')]) }}'">
																<div class="color-block-wrapper">
																	<div class="color-block color-block-green color-block-icon-lock">
																		<div class="color-block-head">
                                    &nbsp;
																		</div>
																		<div class="">
																			<div class="counter Upcoming" data-id="SIRD">
																				<div class="counter-icon">
																					<i class="fa fa-check-square-o"></i>
																				</div>
																				<span class="counter-value" id="SIRDUpcomingCnt">{{$TotalLiveWorks}} Nos.</span>
																				<h3>Total Number Work in Progress</h3>
																			</div>
																		</div>
																	</div>
																</div>
															</div>

														</div>


													</div>
												</div>
											</div>
										</div>
									</div>
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