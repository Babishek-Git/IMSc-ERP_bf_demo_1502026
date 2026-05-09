@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<script type="text/javascript">
	window.history.forward();
	function noBack() { window.history.forward(); }
</script>
<style>
	.bboxdiv{
		box-sizing: border-box !important;
	}
	#chartdiv {
		/*width: 99%;*/
		height: 365px;
		font-size: 11px;
	}
	.list-group-item{
	 	padding: 5px 15px;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		font-size:12px;
		color:#0270DD;
	}.panel{
		font-family:Verdana, Arial, Helvetica, sans-serif;
		font-size:13px;
		/*box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);*/
		box-shadow: 0 4px 7px 1px rgba(0, 0, 0, 0.2);
		background-color:#fff;
		margin-bottom: 10px;
	}.panel-primary {
	  	border-color: #e3e3f7;
	}.well{
		margin:0px;
		margin-top:5px;
		margin-bottom:5px;
		padding: 5px;
	}.well-content{
		padding-top:2px;
		padding-bottom:2px;
		border:1px solid #EEF1F2;/*#F1F3F4;*/
		text-align:left;
		color:#0253A4;
		padding-left:10px;
		font-weight:500;
		margin:2px 0px;
		background:#fff;
		border-radius:0px;
	}.well-content:hover{
		background-color:#10478A;
		color:#FFFFFF;
		cursor:pointer;
		border-radius:0px;
	}.well-content2{
		padding-top:4px;
		padding-bottom:4px;
		text-align:left;
		color:#0253A4;
		padding-left:10px;
		font-size:14px;
		font-weight:500;
	}.well-content-head{
		background-color:#10478A;
		color:#FFFFFF;
		padding-left:5px;
		cursor:default !important;
	}
	.bwelal{
		border:1px solid #0B86D0;
	}
	.box1 {
	  width: 98%;
	  /*min-width: 150px;*/
	  display: block;
	  min-height: 50px;
	  position: relative;
	  border-radius: 5px;
	  background: linear-gradient(to right, #035BB4 35%, #0A7BEF 100%);
	  /*background: linear-gradient(to right, #abbd73 35%, #d6e2ad 100%);*/
	  margin-top: 8px;
	  margin-bottom: 5px;
	  padding: 6px 0px 6px 0px;
	  color: darkslategray;
	  box-shadow: 1px 2px 1px -1px #777;
	  transition: background 200ms ease-in-out;
	  color:#FFFFFF;
	  cursor:pointer;
	  font-size:13px;
	  font-weight:500;
	}
	
	.shadow1 {
	  position: relative;
	}
	.shadow1:before {
	  z-index: -1;
	  position: absolute;
	  content: "";
	  bottom: 13px;
	  right: 7px;
	  width: 75%;
	  top: 0;
	  box-shadow: 0 15px 10px #777;
	  -webkit-transform: rotate(4deg);
			  transform: rotate(4deg);
	  transition: all 150ms ease-in-out;
	}
	
	.box1:hover {
	  background: linear-gradient(to right, #0A7BEF 0%, #035BB4 100%);
	}
	
	.shadow1:hover::before {
	  -webkit-transform: rotate(0deg);
			  transform: rotate(0deg);
	  bottom: 20px;
	  z-index: -10;
	}
	
	.circle1 {
	  /*position: absolute;*/
	  margin-top: 7px;
	  left: 15px;
	  border-radius: 50%;
	  box-shadow: inset 1px 1px 1px 0px rgba(0, 0, 0, 0.5), inset 0 0 0 25px antiquewhite;
	  width: 20px;
	  height: 20px;
	  display: inline-block;
	}
	.box2{
		background: linear-gradient(to right, #CC1C4C 35%, #F647DB 100%);
	}
	.box2:hover{
		background: linear-gradient(to right, #F647DB 0%, #CC1C4C 100%);
	}
	.panel-body {
 		padding: 4px;
	}
	.p-5{
		padding:5px;
	}
	.panel-primary > .panel-heading{
		background-color:#035a85;
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
	.badge-p1{
		background:#035BCC; 
		font-size:11px;
	}
	.badge-p2{
		background:#03CC98; 
		font-size:11px;
	}
	.badge-p3{
		background:#6135D9; 
		font-size:11px;
	}
	.badge-p4{
		background:#D31F54; 
		font-size:11px;
	}
	.badge-p5{
		background:#069145; 
		font-size:11px;
	}
	.badge-p6{
		background:#AD9902; 
		font-size:11px;
	}
	.badge-box{
		float:right; 
		margin-right:8px; 
	}
	
	
	.3dCheck {
  opacity: 0;
  position: absolute;
}

.ChLable {
  position: relative;
  display: block;
  background: #fff;/*#f8f8f8;*/
  border: 1px solid #f0f0f0;
  border-radius: 2em;
  padding: 0.8em 1em 0.8em 1em;
  box-shadow: 0 1px 2px rgba(100, 100, 100, 0.5) inset, 0 0 10px rgba(100, 100, 100, 0.1) inset;
  cursor: pointer;
  text-shadow: 0 2px 2px #fff;
  font-family:Verdana, Arial, Helvetica, sans-serif;
  font-size:13px;
  font-weight:500;
  box-shadow: 0 4px 7px 1px rgba(0, 0, 0, 0.2);
  border: 0.5px solid #00bcd4 !important;
  border-bottom: 2px solid #00bcd4 !important;
}
.ChLable::before {
  content: "";
  position: absolute;
  top: 50%;
  right: 0.7em;
  width: 3em;
  height: 1.2em;
  border-radius: 0.6em;
  background: #eee;
  transform: translateY(-50%);
  box-shadow: 0 1px 3px rgba(100, 100, 100, 0.5) inset, 0 0 10px rgba(100, 100, 100, 0.2) inset;
}
.ChLable::after {
  content: "";
  position: absolute;
  top: 48%;
  right: 2.6em;
  width: 1.4em;
  height: 1.4em;
  border: 0.25em solid #fafafa;
  border-radius: 50%;
  box-sizing: border-box;
  background-color: #ddd;
  background-image: linear-gradient(to top, #fff 0%, #fff 40%, transparent 100%);
  transform: translateY(-50%);
  box-shadow: 0 3px 3px rgba(0, 0, 0, 0.5);
}
.ChLable, .ChLable::before, .ChLable::after {
  transition: all 0.2s cubic-bezier(0.165, 0.84, 0.44, 1);
}

.ChLable:hover, input:focus + .ChLable {
  color: black;
}
.ChLable:hover::after, input:focus + .ChLable::after {
  background-color: #ccc;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
}

input:checked {
  counter-increment: total;
}
input:checked + .ChLable::before {
  background: #1CE;
}
input:checked + .ChLable::after {
  transform: translateX(2em) translateY(-50%);
}
.Btn-3Check{
  margin: 1em 0;
  /*font: 1.5em/1.4 "Open Sans Condensed", sans-serif;*/
  font-family:Verdana, Arial, Helvetica, sans-serif;
  font-size:17px;
  font-weight:400;
  color: #2F373E;
  width:100%;
  text-align:left;
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
									<div class="div4 p-5 bboxdiv">
										<div class="grid_12" align="center">
											<div class="panel panel-default">
												<!--<div class="panel-heading" align="left">
													Notifications for verifications & approval
												</div>-->
												<div class="panel-body border">
													@php $MarginStr = 'margin-top:2px;'; @endphp
													<a data-url="{{route('accounts.WorksCSTList')}}">
													<div class="box1 shadow1" style=" @php echo $MarginStr; @endphp">
														<div class="grid_2" align="center">
															<div class="circle1"></div>
														</div>
														<div class="grid_10" align="left">
															<span style="margin-top:25px; line-height:30px;">CCNO. assign & CST Confirm - <span id="DboardCSTWaitingCount"></span> nos.</span>
														</div>
													</div>
													</a>
													<a data-url="{{route('accounts.WorksNegoCSTList')}}">
													<div class="box1 shadow1" style="">
														<div class="grid_2" align="center">
															<div class="circle1"></div>
														</div>
														<div class="grid_10" align="left">
															<span style="margin-top:25px; line-height:30px;">Negotiation CST Confirm - <span id="DboardNEGOCSTWaitingCount"></span> nos.</span>
														</div>
													</div>
													</a>
													@php // if($_SESSION['levelid'] == 1){ @endphp
													<a data-url="{{route('accountsworks.WorkRegistration')}}">
													<div class="box1 shadow1" style="">
														<div class="grid_2" align="center">
															<div class="circle1"></div>
														</div>
														<div class="grid_10" align="left">
															<span style="margin-top:25px; line-height:30px;">Bill waiting for Registration - <span id="DboardBILLRCount"></span> nos.</span>
														</div>
													</div>
													</a>
													@php // } @endphp
													<a data-url="{{route('accountsworks.MBookVerification')}}" id="mb_waiting_list">
													<div class="box1 shadow1">
														<div class="grid_2" align="center">
															<div class="circle1"></div>
														</div>
														<div class="grid_10" align="left">
															<span style="margin-top:25px; line-height:14px;">RAB waiting for verification - @php // echo count($SheetWaitArr); @endphp nos.</span>
															<div class="repstext">(with/without Secured advance & Escalation)</div>
														</div>
													</div>
													</a>
													<a data-url="{{route('accounts.BiddersBankWaitfrConfList')}}">
														<div class="box1 shadow1">
															<div class="grid_2" align="center">
																<div class="circle1"></div>
															</div>
															<div class="grid_10" align="left">
																<span style="margin-top:25px; line-height:30px;">Vendor Bank Detail's Entry/Confirm - <span id="DboardVENDORLISTCount"></span> nos.</span>
															</div>
														</div>
													</a>
													<a data-url="{{route('accounts.DashBGExpiredRemainder')}}">
													<div class="box1 shadow1" style="">
														<div class="grid_2" align="center">
															<div class="circle1"></div>
														</div>
														<div class="grid_10" align="left">
															<span style="margin-top:25px; line-height:30px;">BG Expiry List (PG/SD/MOB.ADV.) - <span id="DboardBGEXPLISTCount"></span> nos.</span>
														</div>
													</div>
													</a>
													<a data-url="{{route('accounts.DashFDRExpiredRemainder')}}">
													<div class="box1 shadow1" style="">
														<div class="grid_2" align="center">
															<div class="circle1"></div>
														</div>
														<div class="grid_10" align="left">
															<span style="margin-top:25px; line-height:30px;">FDR Expiry List (PG/SD/MOB.ADV.) - <span id="DboardFDREXPLISTCount"></span> nos.</span>
														</div>
													</div>
													</a>
													<a data-url="{{route('accounts.PGregisterReleaseList')}}">
													<div class="box1 shadow1" style="">
														<div class="grid_2" align="center">
															<div class="circle1"></div>
														</div>
														<div class="grid_10" align="left">
															<span style="margin-top:25px; line-height:30px;">PG Release Reminder List - <span id="DboardPGRELEASELISTCount"></span> nos.</span>
														</div>
													</div>
													</a>
													<a data-url="{{route('accounts.SDregisterReleaseListStatement')}}">
													<div class="box1 shadow1" style="">
														<div class="grid_2" align="center">
															<div class="circle1"></div>
														</div>
														<div class="grid_10" align="left">
															<span style="margin-top:25px; line-height:30px;">SD Release Reminder List - <span id="DboardSDRELEASELISTCount"></span> nos.</span>
														</div>
													</div>
													</a>
													<a data-url="{{route('accounts.EMDReturnRemainder')}}">
													<div class="box1 shadow1" style="">
														<div class="grid_2" align="center">
															<div class="circle1"></div>
														</div>
														<div class="grid_10" align="left">
															<span style="margin-top:25px; line-height:30px;">EMD Release Reminder List - <span id="DboardEMDDDRETURNLISTCount"></span> nos.</span>
														</div>
													</div>
													</a>
												</div>
											</div>
										</div>
									</div>
									<div class="div4 p-5 bboxdiv">
										<div class="grid_12" align="center">
											<div class="Btn-3Check" style="margin-top:2px;">
												<input name="PriorAppln[]" id="ITSTMT" type="checkbox" class="3dCheck Stmt" style="display:none" value="IT"  checked="checked"/>
												<label class="ChLable" for="ITSTMT">Monthly (@php echo date('M-Y', strtotime('-1 month')); @endphp) IT Statement<!-- <span style='font-size:17px;' id="PriorApplnTk">&#10004;</span>--></label>
											</div>
											<div class="Btn-3Check">
												<input name="PriorAppln[]" id="GSTSTMT" type="checkbox" class="3dCheck Stmt" style="display:none" value="GST"  checked="checked"/>
												<label class="ChLable" for="GSTSTMT">Monthly (@php echo date('M-Y', strtotime('-1 month')); @endphp) TDS On GST Statement<!-- <span style='font-size:17px;' id="PriorApplnTk">&#10004;</span>--></label>
											</div>
											<div class="Btn-3Check">
												<input name="PriorAppln[]" id="LCESSSTMT" type="checkbox" class="3dCheck Stmt" style="display:none" value="LCESS"  checked="checked"/>
												<label class="ChLable" for="LCESSSTMT">Monthly (@php echo date('M-Y', strtotime('-1 month')); @endphp) LCESS Statement<!-- <span style='font-size:17px;' id="PriorApplnTk">&#10004;</span>--></label>
											</div>
											<div class="Btn-3Check">
												<input name="PriorAppln[]" id="SDRCSTMT" type="checkbox" class="3dCheck Stmt" style="display:none" value="SDREC"  checked="checked"/>
												<label class="ChLable" for="SDRCSTMT">Monthly (@php echo date('M-Y', strtotime('-1 month')); @endphp) SD REC. Statement<!-- <span style='font-size:17px;' id="PriorApplnTk">&#10004;</span>--></label>
											</div>
											<div class="Btn-3Check">
												<input name="PriorAppln[]" id="PSDBRSH" type="checkbox" class="3dCheck Stmt" style="display:none" value="PSD"  checked="checked"/>
												<label class="ChLable" for="PSDBRSH">Monthly (@php echo date('M-Y', strtotime('-1 month')); @endphp) PSD Broad Sheet<!-- <span style='font-size:17px;' id="PriorApplnTk">&#10004;</span>--></label>
											</div>
											<div class="Btn-3Check">
												<input name="PriorAppln[]" id="SDBRSH" type="checkbox" class="3dCheck Stmt" style="display:none" value="SDBS"  checked="checked"/>
												<label class="ChLable" for="SDBRSH">Monthly (@php echo date('M-Y', strtotime('-1 month')); @endphp) SD Broad Sheet<!-- <span style='font-size:17px;' id="PriorApplnTk">&#10004;</span>--></label>
											</div>
											<div class="Btn-3Check">
												<input name="PriorAppln[]" id="VOUCH" type="checkbox" class="3dCheck Stmt" style="display:none" value="VOUCH"  checked="checked"/>
												<label class="ChLable" for="VOUCH">Monthly (@php echo date('M-Y', strtotime('-1 month')); @endphp) Vouchers</label>
											</div>
											<!-- <div class="Btn-3Check">
												<input name="PriorAppln[]" id="BILLST" type="checkbox" class="3dCheck" style="display:none" value="BILLS"  checked="checked"/>
												<label class="ChLable" for="BILLST">Bill Status</label>
											</div>
											<div class="Btn-3Check">
												<input name="PriorAppln[]" id="WORKST" type="checkbox" class="3dCheck" style="display:none" value="WORKS"  checked="checked"/>
												<label class="ChLable" for="WORKST">Work Status<</label>
											</div> -->
										</div>
									</div>
									<div class="div4 p-5 bboxdiv">
										<div class="grid_12" align="center">
											<div class="panel panel-primary">
												<div class="panel-heading">
													Accounts Work Flow (Click below steps to view details)
												</div>
												<div class="panel-body border fchart">
													@php // include("WorkFlowChart.php"); @endphp
													@include('layouts.partials.flowchart')
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
            <!--<script src="js/jquery.hoverdir.js"></script>-->
        </form>
<link href="{!! url('assets/FlowChart/flow-chart.css') !!}">
<script src="{!! url('assets/FlowChart/flow-chart.js') !!}"></script>


 
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