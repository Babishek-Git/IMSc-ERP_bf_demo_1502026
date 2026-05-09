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
									@include('dashboard.CircularBar')
									<div class="div4 p-5 bboxdiv">
										<div class="grid_12" align="center">
											<div class="panel panel-default">
												<!--<div class="panel-heading" align="left">
													Notifications for verifications & approval
												</div>-->
												<div class="panel-body border">
													@php $MarginStr = 'margin-top:2px;'; @endphp

													@php
													$RegRole = \Helper::AccRetRole(NULL,session('WcmsEmpRoleId'),'BILLR');
													if((filled($RegRole))&&($RegRole != NULL)){
														$IsRegisterProv = 1;
													}else{
														$IsRegisterProv = 0;
													}
													$InwdRole = \Helper::AccRetRole(NULL,session('WcmsEmpRoleId'),'INWD');
													if((filled($InwdRole))&&($InwdRole != NULL)){
														$IsInwardSection = 1;
													}else{
														$IsInwardSection = 0;
													}
													@endphp
													@if($IsInwardSection == 1)
													<a data-url="{{route('inward.InwardSection')}}">
													<div class="box1 shadow1" style=" @php echo $MarginStr; @endphp">
														<div class="grid_2" align="center">
															<div class="circle1"></div>
														</div>
														<div class="grid_10" align="left">
															<span style="margin-top:25px; line-height:30px;">Click here to go to Inward Section</span>
														</div>
													</div>
													</a>
													@php $MarginStr = ""; @endphp
													@endif

													<a data-url="{{route('cst.WorksCSTList')}}">
													<div class="box1 shadow1" style=" @php echo $MarginStr; @endphp">
														<div class="grid_2" align="center">
															<div class="circle1"></div>
														</div>
														<div class="grid_10" align="left">
															<span style="margin-top:25px; line-height:30px;"> CST Confirm & Freeze - <span id="DboardCSTWaitingCount"></span> nos.</span>
														</div>
													</div>
													</a>
													<a data-url="{{route('cst.WorksNegoCSTList')}}">
													<div class="box1 shadow1" style="">
														<div class="grid_2" align="center">
															<div class="circle1"></div>
														</div>
														<div class="grid_10" align="left">
															<span style="margin-top:25px; line-height:30px;">Negotiation CST Confirm - <span id="DboardNEGOCSTWaitingCount"></span> nos.</span>
														</div>
													</div>
													</a>
													<!-- <a data-url="{{route('cst.WorksCSTListUser')}}">
													<div class="box1 shadow1" style=" @php echo $MarginStr; @endphp">
														<div class="grid_2" align="center">
															<div class="circle1"></div>
														</div>
														<div class="grid_10" align="left">
															<span style="margin-top:25px; line-height:30px;"> CST Confirm & Freeze User - <span id="DboardCSTUserWaitingCount"></span> nos.</span>
														</div>
													</div>
													</a> -->
													<!-- <a data-url="{{route('cst.WorksNegoCSTListUser')}}">
													<div class="box1 shadow1" style="">
														<div class="grid_2" align="center">
															<div class="circle1"></div>
														</div>
														<div class="grid_10" align="left">
															<span style="margin-top:25px; line-height:30px;">Negotiation CST Confirm User - <span id="DboardNEGOCSTUserWaitingCount"></span> nos.</span>
														</div>
													</div>
													</a> -->
													@php
													$RegRole = \Helper::AccRetRole(NULL,session('WcmsEmpRoleId'),'BILLR');
													if((filled($RegRole))&&($RegRole != NULL)){
														$IsRegisterProv = 1;
													}else{
														$IsRegisterProv = 0;
													}
													$InwdRole = \Helper::AccRetRole(NULL,session('WcmsEmpRoleId'),'INWD');
													if((filled($InwdRole))&&($InwdRole != NULL)){
														$IsInwardSection = 1;
													}else{
														$IsInwardSection = 0;
													}
													@endphp
													@if($IsRegisterProv == 1)
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
													@endif
													<a data-url="{{route('accountsworks.MBookVerification')}}" id="mb_waiting_list">
													<div class="box1 shadow1">
														<div class="grid_2" align="center">
															<div class="circle1"></div>
														</div>
														<div class="grid_10" align="left">
															<span style="margin-top:25px; line-height:14px;">RAB waiting for verification - <span id="DboardRABCount"></span> @php // echo count($SheetWaitArr); @endphp nos.</span>
															<div class="repstext">(with/without Secured advance & Escalation)</div>
														</div>
													</div>
													</a>
													<a data-url="{{route('gst.GstReimbursementVerificationList')}}" id="mb_waiting_list">
													<div class="box1 shadow1">
														<div class="grid_2" align="center">
															<div class="circle1"></div>
														</div>
														<div class="grid_10" align="left">
															<span style="margin-top:25px; line-height:30px;">GST Reimbursement waiting for verification - <span id="DboardRABCount"></span> @php // echo count($SheetWaitArr); @endphp nos.</span>
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
													<a data-url="{{route('reports.SDregisterReleaseListStatement', ['type' => encrypt('DashSd')])}}">
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
													<a data-url="{{route('pg.WorksPGList')}}">
													<div class="box1 shadow1" style="">
														<div class="grid_2" align="center">
															<div class="circle1"></div>
														</div>
														<div class="grid_10" align="left">
															<span style="margin-top:25px; line-height:30px;">PG Confirm - <span id="DboardPGTWaitingCount"></span> nos.</span>
														</div>
													</div>
													</a>
													<a data-url="{{route('sd.WorksSDList')}}">
													<div class="box1 shadow1" style="">
														<div class="grid_2" align="center">
															<div class="circle1"></div>
														</div>
														<div class="grid_10" align="left">
															<span style="margin-top:25px; line-height:30px;">SD Confirm - <span id="DboardSDTWaitingCount"></span> nos.</span>
														</div>
													</div>
													</a>
													<a data-url="{{route('item.WorksBDESAList')}}">
													<div class="box1 shadow1" style="">
														<div class="grid_2" align="center">
															<div class="circle1"></div>
														</div>
														<div class="grid_10" align="left">
															<span style="margin-top:25px; line-height:30px;">Additional Qty./Extra/Substitute Item Approval - <span id="DboardBDESAWaitingCount"></span> nos.</span>
														</div>
													</div>
													</a>
													<a data-url="{{route('recommend.WorksEMDLOneAList')}}">
														<div class="box1 shadow1" style="">
															<div class="grid_2" align="center">
																<div class="circle1"></div>
															</div>
															<div class="grid_10" align="left">
																<span style="margin-top:25px; line-height:30px;">EMD Release for L1 Approval - <span id="DboardEMDLOneAccWaitingCount"></span> nos.</span>
															</div>
														</div>
													</a>
													<a data-url="{{route('recommend.WorksPSDRELAList')}}">
														<div class="box1 shadow1" style="">
															<div class="grid_2" align="center">
																<div class="circle1"></div>
															</div>
															<div class="grid_10" align="left">
																<span style="margin-top:25px; line-height:30px;">PSD Release Approval - <span id="DboardPSDRealeaseAccWaitingCount"></span> nos.</span>
															</div>
														</div>
													</a>
													<a data-url="{{route('recommend.WorksSDRELAList')}}">
														<div class="box1 shadow1" style="">
															<div class="grid_2" align="center">
																<div class="circle1"></div>
															</div>
															<div class="grid_10" align="left">
																<span style="margin-top:25px; line-height:30px;">SD Release Approval - <span id="DboardSDRealeaseAccWaitingCount"></span> nos.</span>
															</div>
														</div>
													</a>
													<a data-url="{{route('recommend.WorksDDRELAList')}}">
														<div class="box1 shadow1" style="">
															<div class="grid_2" align="center">
																<div class="circle1"></div>
															</div>
															<div class="grid_10" align="left">
																<span style="margin-top:25px; line-height:30px;">DD Release Approval - <span id="DboardDDRealeaseAccWaitingCount"></span> nos.</span>
															</div>
														</div>
													</a>
													<a data-url="{{route('loi.WorkLOIList')}}">														
														<div class="box1 shadow1" style="">															
															<div class="grid_2" align="center">																
																<div class="circle1"></div>															
															</div>															

															<div class="grid_10" align="left">
																<span style="margin-top:25px; line-height:30px;">LOI Confirm - <span id="DboardLoiWaitingCount"></span> nos.</span>															
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
        </form>
<link href="{!! url('assets/FlowChart/flow-chart.css') !!}">
<script src="{!! url('assets/FlowChart/flow-chart.js') !!}"></script>
<script src="{{ url('assets/table2excel/jquery.table2excel.js') }}"></script>

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
		$.ajax({
			type:'POST',
			url: "{{ route('dashboard.GetDashboardDetails') }}",
			data: {'_token': '{{ csrf_token() }}','page': 'BILLR'},
			success:function(data){
				if(data){ 
					if(data != null){
						$("#DboardBILLRCount").text(data);
					}else{
						$("#DboardBILLRCount").text(0);
					}
				}
			}
		});
	//});	
	//$(window).load(function() {
		$.ajax({
			type:'POST',
			url: "{{ route('dashboard.GetDashboardDetails') }}",
			data: {'_token': '{{ csrf_token() }}','page': 'RABV'},
			success:function(data){
				if(data){ 
					if(data != null){
						$("#DboardRABCount").text(data);
					}else{
						$("#DboardRABCount").text(0);
					}
				}
			}
		});
	//});	
	//$(window).load(function() {
		$.ajax({
			type:'POST',
			url: "{{ route('dashboard.GetDashboardDetails') }}",
			data: {'_token': '{{ csrf_token() }}','page': 'CSTWAITINGLIST'},
			success:function(data){
				if(data){ 
					if(data != null){ //alert(data);
						$("#DboardCSTWaitingCount").text(data);
					}else{
						$("#DboardCSTWaitingCount").text('0');
					}
				}
			}
		});
	//});
	// $(window).load(function() {
	// 	$.ajax({
	// 		type:'POST',
	// 		url: "{{ route('dashboard.GetDashboardDetails') }}",
	// 		data: {'_token': '{{ csrf_token() }}','page': 'CSTUSERWAITINGLIST'},
	// 		success:function(data){
	// 			if(data){ 
	// 				if(data != null){ 
	// 					$("#DboardCSTUserWaitingCount").text(data);
	// 				}else{
	// 					$("#DboardCSTUserWaitingCount").text('0');
	// 				}
	// 			}
	// 		}
	// 	});
	// });
	//$(window).load(function() {
		$.ajax({
			type:'POST',
			url: "{{ route('dashboard.GetDashboardDetails') }}",
			data: {'_token': '{{ csrf_token() }}','page': 'NEGOCSTWAITINGLIST'},
			success:function(data){
				if(data){ //
					if(data != null){ //alert(data);
						$("#DboardNEGOCSTWaitingCount").text(data);
					}else{
						$("#DboardNEGOCSTWaitingCount").text('0');
					}
				}
			}
		});
	//});
	// $(window).load(function() {
	// 	$.ajax({
	// 		type:'POST',
	// 		url: "{{ route('dashboard.GetDashboardDetails') }}",
	// 		data: {'_token': '{{ csrf_token() }}','page': 'NEGOCSTUSERWAITINGLIST'},
	// 		success:function(data){
	// 			if(data){ 
	// 				if(data != null){ 
	// 					$("#DboardNEGOCSTUserWaitingCount").text(data);
	// 				}else{
	// 					$("#DboardNEGOCSTUserWaitingCount").text('0');
	// 				}
	// 			}
	// 		}
	// 	});
	// });
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
			data: {'_token': '{{ csrf_token() }}','page': 'VENDORLIST'},
			success:function(data){
				if(data){ //alert(data);
					if(data != null){
						$("#DboardVENDORLISTCount").text(data);
					}else{
						$("#DboardVENDORLISTCount").text('0');
					}
				}
			}
		});
	//});
	//$(window).load(function() {
		$.ajax({
			type:'POST',
			url: "{{ route('dashboard.GetDashboardDetails') }}",
			data: {'_token': '{{ csrf_token() }}','page': 'PGACCWAITINGLIST'},
			success:function(data){
				if(data){ 
					if(data != null){
						$("#DboardPGTWaitingCount").text(data);
					}else{
						$("#DboardPGTWaitingCount").text('0');
					}
				}
			}
		});
	//});
	//$(window).load(function() {
		$.ajax({
			type:'POST',
			url: "{{ route('dashboard.GetDashboardDetails') }}",
			data: {'_token': '{{ csrf_token() }}','page': 'SDACCWAITINGLIST'},
			success:function(data){
				if(data){ 
					if(data != null){
						$("#DboardSDTWaitingCount").text(data);
					}else{
						$("#DboardSDTWaitingCount").text('0');
					}
				}
			}
		});
	//});
	//$(window).load(function() {
		$.ajax({
			type:'POST',
			url: "{{ route('dashboard.GetDashboardDetails') }}",
			data: {'_token': '{{ csrf_token() }}','page': 'BDESACCWAITINGLIST'},
			success:function(data){
				if(data){ 
					if(data != null){
						$("#DboardBDESAWaitingCount").text(data);
					}else{
						$("#DboardBDESAWaitingCount").text('0');
					}
				}
			}
		});
	//});

	//$(window).load(function() {
		$.ajax({
			type:'POST',
			url: "{{ route('dashboard.GetDashboardDetails') }}",
			data: {'_token': '{{ csrf_token() }}','page': 'EMDLONEACCWAITINGLIST'},
			success:function(data){
				if(data){ 
					if(data != null){
						$("#DboardEMDLOneAccWaitingCount").text(data);
					}else{
						$("#DboardEMDLOneAccWaitingCount").text('0');
					}
				}
			}
		});
	//});
	//$(window).load(function() {
		$.ajax({
			type:'POST',
			url: "{{ route('dashboard.GetDashboardDetails') }}",
			data: {'_token': '{{ csrf_token() }}','page': 'PSDRELACCWAITINGLIST'},
			success:function(data){
				if(data){ 
					if(data != null){
						$("#DboardPSDRealeaseAccWaitingCount").text(data);
					}else{
						$("#DboardPSDRealeaseAccWaitingCount").text('0');
					}
				}
			}
		});
	//});
	//$(window).load(function() {
		$.ajax({
			type:'POST',
			url: "{{ route('dashboard.GetDashboardDetails') }}",
			data: {'_token': '{{ csrf_token() }}','page': 'SDRELACCWAITINGLIST'},
			success:function(data){
				if(data){ 
					if(data != null){
						$("#DboardSDRealeaseAccWaitingCount").text(data);
					}else{
						$("#DboardSDRealeaseAccWaitingCount").text('0');
					}
				}
			}
		});
	//});
	//$(window).load(function() {
		$.ajax({
			type:'POST',
			url: "{{ route('dashboard.GetDashboardDetails') }}",
			data: {'_token': '{{ csrf_token() }}','page': 'DDRELACCWAITINGLIST'},
			success:function(data){
				if(data){ 
					if(data != null){
						$("#DboardDDRealeaseAccWaitingCount").text(data);
					}else{
						$("#DboardDDRealeaseAccWaitingCount").text('0');
					}
				}
			}
		});
	//});

	//$(window).load(function() {
		$.ajax({
			type:'POST',
			url: "{{ route('dashboard.GetDashboardDetails') }}",
			data: {'_token': '{{ csrf_token() }}','page': 'LOIWAITINGLIST'},
			success:function(data){
				if(data){ 
					if(data != null){ //alert(data);
						$("#DboardLoiWaitingCount").text(data);
					}else{
						$("#DboardLoiWaitingCount").text('0');
					}
				}
			}
		});
	//});



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
	var TitlePart1;
	var StmtCode = "";
	$("body").on("click",".Stmt", function(event){ //alert(2);
		$(this).prop("checked", true);
		StmtCode = "";
		StmtCode = $(this).attr("id");
		let StartYr = 2013;
		const SysDate 	= new Date();
		let SysYear 	= SysDate.getFullYear();
		var OptionStr   = '';
		for(StartYr = 2013; StartYr <= SysYear; StartYr++){
			OptionStr += '<option value="'+StartYr+'">'+StartYr+'</option>';
		}
		if(StmtCode == "ITSTMT"){   //alert(2);
			TitlePart1 = "IT";
			var Colspan = 9;
		}else if(StmtCode == "GSTSTMT"){   //alert(3);
			TitlePart1 = "GST";
			var Colspan = 13;
		}else if(StmtCode == "LCESSSTMT"){
			TitlePart1 = "Labour CESS";
			var Colspan = 8;
		}else if(StmtCode == "SDRCSTMT"){
			TitlePart1 = "SD Recovery";
			var Colspan = 11;
		}else if(StmtCode == "PSDBRSH"){
			TitlePart1 = "Performance Guarantee BroadSheet";
			var Colspan = 12;
		}else if(StmtCode == "SDBRSH"){
			TitlePart1 = "SD BroadSheet";
			var Colspan = 10;
		}else if(StmtCode == "VOUCH"){
			TitlePart1 = "Voucher Expenditure";
			var Colspan = 8;
		}
		var DropDwnStr = '<select name="cmb_modal_yr" id="cmb_modal_yr" class="ModalYr">';
			DropDwnStr += OptionStr;
			DropDwnStr += '</select>&nbsp;';
		var ButtonStr  = '<div class="cat action"><label><input type="radio" name="month" class="ModMonth" id="ModMonth01" value="01"><span>Jan</span></label></div>';
			ButtonStr += '<div class="cat action"><label><input type="radio" name="month" class="ModMonth" id="ModMonth02" value="02"><span>Feb</span></label></div>';
			ButtonStr += '<div class="cat action"><label><input type="radio" name="month" class="ModMonth" id="ModMonth03" value="03"><span>Mar</span></label></div>';
			ButtonStr += '<div class="cat action"><label><input type="radio" name="month" class="ModMonth" id="ModMonth04" value="04"><span>Apr</span></label></div>';
			ButtonStr += '<div class="cat action"><label><input type="radio" name="month" class="ModMonth" id="ModMonth05" value="05"><span>May</span></label></div>';
			ButtonStr += '<div class="cat action"><label><input type="radio" name="month" class="ModMonth" id="ModMonth06" value="06"><span>Jun</span></label></div>';
			ButtonStr += '<div class="cat action"><label><input type="radio" name="month" class="ModMonth" id="ModMonth07" value="07"><span>Jul</span></label></div>';
			ButtonStr += '<div class="cat action"><label><input type="radio" name="month" class="ModMonth" id="ModMonth08" value="08"><span>Aug</span></label></div>';
			ButtonStr += '<div class="cat action"><label><input type="radio" name="month" class="ModMonth" id="ModMonth09" value="09"><span>Sep</span></label></div>';
			ButtonStr += '<div class="cat action"><label><input type="radio" name="month" class="ModMonth" id="ModMonth10" value="10"><span>Oct</span></label></div>';
			ButtonStr += '<div class="cat action"><label><input type="radio" name="month" class="ModMonth" id="ModMonth11" value="11"><span>Nov</span></label></div>';
			ButtonStr += '<div class="cat action"><label><input type="radio" name="month" class="ModMonth" id="ModMonth12" value="12"><span>Dec</span></label></div>';
			ButtonStr += '<div class="cat action btn btn-default floatr"><label><span class="xldownload xld2" id="exportToExcel"><i class="fa fa-arrow-down pt2"></i> Excel </span></label></div>';
			ButtonStr += '<div class="cat action btn btn-default floatr"><label><span class="pdfdownload pdfd2" id="exportToPdf"><i class="fa fa-arrow-down pt2"></i> PDF </span></label></div>';
		var TableStr   = '';
			TableStr += '<div id="testpdf"><table class="table dataTable rtable table2excel example prtable" id="StmtTable" border="1" width="100%" align="center">';
			TableStr += '<tr><td colspan="'+Colspan+'" style="text-align:left">'+DropDwnStr+ButtonStr+'</td></tr>';
			TableStr += '</table></div>';
			
		BootstrapDialog.show({ 
			message: TableStr,
			title:TitlePart1+' Statement for the Month of <span id="ModalTitle"></span>',
			size:'LARGE',
			onshown: function(dialogRef){
				$(".modal-dialog").css('width','90%');
				GetMonthlyData(StmtCode,"PREV") 
			}
		});
		
		
	});
	$("body").on("change","#cmb_modal_yr", function(event){
		$(".ModMonth").prop("checked", false);
	});
	$("body").on("click",".ModMonth", function(event){
		var ModMonth = $(this).val();
		var ModYear = $("#cmb_modal_yr").val();
		if((ModMonth != '')&&(ModYear != '')){
			var ModMonYr = ModYear+"-"+ModMonth+"-01";
			GetMonthlyData(StmtCode,ModMonYr)
		}
	});
	function IndianRupeeFormat(Amt){
		
		var Amount = parseFloat(Amt); 
		if (isNaN(Amount)) {
        	return " ";
	    }
    	var FormattedAmount = Amount.toLocaleString('en-IN', {
    	    maximumFractionDigits: 2,
			minimumFractionDigits: 2,
    	    currency: 'INR'
    	});
    	return FormattedAmount;
	}
	var MonthYrStr;	
	function GetMonthlyData(StmtCode,MonthYr){  
		$.ajax({              
			type: 'POST', 
			url: "{{route('dashboard.DataReports')}}",
			data: {'_token': '{{ csrf_token() }}', 'StmtCode': StmtCode, 'MonthYr': MonthYr }, 
			success: function (data) {   
				if(data != null){
					var TableStr = "";
					var Sno = 1; var TotalItAmt = 0;
					MonthYrStr = data['month_yr_dp'];
					var MonthStr = data['month_str'];
					var YearStr  = data['year_str'];
					
					$("#ModalTitle").html(MonthYrStr);
					$("#cmb_modal_yr").val(YearStr);
					$("#ModMonth"+MonthStr).prop("checked", true);
					
					if(StmtCode == "ITSTMT"){													////////////////////// ------ FOR IT STATEMENT ------ //////////////////////
						TableStr += '<tr>';
						TableStr += '<th class="colhead">S.No</th>';
						TableStr += '<th class="colhead">PAN</th>';
						TableStr += '<th class="colhead">Name of Contractor</th>';
						TableStr += '<th class="colhead">Bill Value (&#x20b9;)</th>';
						TableStr += '<th class="colhead">Bill Value For IT (&#x20b9;)</th>';
						TableStr += '<th class="colhead">Date of Payment</th>';
						TableStr += '<th class="colhead">Percent (%)</th>';
						TableStr += '<th class="colhead">IT Amount (&#x20b9;)</th>';
						TableStr += '<th class="colhead" style="font-weight:bold;">Remarks</th>';
						TableStr += '</tr>';
						var StmtData = data['MonthlyRecData'];  
						var PaymentDt = data['PaymentDtDisplay'];
						$.each(StmtData, function(index, element) { 
							var PaymentDate = PaymentDt[index];
							var AbstNetAmt  = element.abstract_net_amt;
							AbstNetAmt 		= Number(AbstNetAmt).toFixed(2);
							var SecAdvAmt 	= Number(element.sec_adv_amount).toFixed(2);
							var EscAmt 		= Number(element.esc_amt).toFixed(2);
							var MobAdvAmt 	= Number(element.mob_adv_amt).toFixed(2);
							var BillAmt		= Number(AbstNetAmt) + Number(SecAdvAmt) + Number(EscAmt) + Number(MobAdvAmt);
							var BillAmtIt 	= element.bill_amt_it;
							BillAmtIt 		= Number(BillAmtIt).toFixed(2);
							var ItAmt 		= element.rec_amt;
							ItAmt 			= Number(ItAmt).toFixed(2);    

							TotalItAmt = Number(TotalItAmt) + Number(ItAmt);
							TableStr += '<tr>';
							TableStr += '<td class="labelcenter" style="text-align: center;">'+Sno+'</td>';
							TableStr += '<td class="labelcenter" nowrap="nowrap">'+element.pan_no+'</td>';
							TableStr += '<td class="labelleft" nowrap="nowrap">'+element.name_contractor+'</td>';
							TableStr += '<td class="labelright" style="text-align: right;">'+IndianRupeeFormat(BillAmt)+'</td>';
							TableStr += '<td class="labelright" style="text-align: right;">'+IndianRupeeFormat(BillAmtIt)+'</td>';
							TableStr += '<td class="labelcenter" style="text-align: center;" nowrap="nowrap">'+PaymentDate+'</td>';
							TableStr += '<td class="labelright" style="text-align: center;" nowrap>'+element.rec_perc+'</td>';
							TableStr += '<td class="labelright" style="text-align: right;" nowrap="nowrap">'+IndianRupeeFormat(ItAmt)+'</td>';
							TableStr += '<td class="labelright" nowrap="nowrap"></td>';
							TableStr += '</tr>';
							Sno++;
						});
						if(TotalItAmt > 0){
							TotalItAmt 	= Number(TotalItAmt).toFixed(2);
							TableStr += '<tr>';
							TableStr += '<td class="labelright mod-totrow" colspan="7"><b> Total IT Amount (&#x20b9;)</b></td>';
							TableStr += '<td class="labelright mod-totrow" style="text-align: right;" nowrap="nowrap"><b>'+IndianRupeeFormat(TotalItAmt)+'</b></td>';
							TableStr += '<td class="labelright mod-totrow" nowrap="nowrap"></td>';
							TableStr += '</tr>';
						}else{
							TableStr += '<tr>';
							TableStr += '<td class="labelcenter" colspan="9">No Records Found</td>';
							TableStr += '</tr>';
						}
					}else if(StmtCode == "GSTSTMT"){									////////////////////// ------ FOR GST STATEMENT ------ //////////////////////
						TableStr += '<tr>';
						TableStr += '<th class="colhead">S.No</th>';
						TableStr += '<th class="colhead">RAB NO.</th>';
						TableStr += '<th class="colhead">Name of Contractor</th>';
						TableStr += '<th class="colhead">PAN NO.</th>';
						TableStr += '<th class="colhead">GST NO.</th>';
						TableStr += '<th class="colhead">Date of Payment</th>';
						TableStr += '<th class="colhead">Bill Value for GST (&#x20b9;)</th>';
						TableStr += '<th class="colhead">SGST (&#x20b9;)</th>';
						TableStr += '<th class="colhead">CGST (&#x20b9;)</th>';
						TableStr += '<th class="colhead">IGST (&#x20b9;)</th>';
						TableStr += '<th class="colhead">Total GST (&#x20b9;)</th>';
						TableStr += '<th class="colhead" style="font-weight:bold;">Remarks</th>';
						TableStr += '</tr>';
						var TotalBillAmt = 0;
						var TotalGstAmt = 0; 
						var CgstSgst = 0;         
						var StmtData = data['MonthlyRecData'];
						var ContGstData 	= data['contgstdata'];	
						var PaymentDt = data['PaymentDtDisplay'];
						$.each(StmtData, function(index, element) { 
							var PaymentDate = PaymentDt[index];  
						    var TotalGst = 0;
							var RbnVal = element.rbn;   
							var sheetidVal = element.sheetid;              
							var ContGst 	= ContGstData[sheetidVal];   
							var GstAmt 		= element.bill_amt_gst;               
							GstAmtMonForm 			= Number(GstAmt).toFixed(2);                 		                 
							var AbstNetAmt = element.abstract_net_amt;
							AbstNetAmtMonForm 		= Number(AbstNetAmt).toFixed(2);
							var AmtGst	= element.rec_amt;
							TotalGst = Number(TotalGst) + Number(AmtGst);
							CSgst = TotalGst/2;
							CgstSgst = Number(CSgst).toFixed(2);
							AmtGstMonForm 		= Number(AmtGst).toFixed(2);
							
							TotalGstAmt = Number(TotalGstAmt) + Number(TotalGst);
								TotalGst = Number(TotalGst).toFixed(2);
								var TotalGstMonForm = TotalGst;
							TotalBillAmt = Number(TotalBillAmt) + Number(AbstNetAmt);   
							//TotalGstAmt = Number(TotalGstAmt) + Number(GstAmt);
							if(ContGst.startsWith("27")){
								var CGst = IndianRupeeFormat(CgstSgst);
								var SGst = IndianRupeeFormat(CgstSgst);
								var IGst = "";
							}else{
								var CGst = "";
								var SGst = "";
								var IGst = IndianRupeeFormat(AmtGst);
							}
							TableStr += '<tr>';
							TableStr += '<td class="labelcenter" style="text-align: center;">'+Sno+'</td>';
							TableStr += '<td class="labelcenter" style="text-align: center;" nowrap="nowrap">'+RbnVal+'</td>';
							TableStr += '<td class="labelleft">'+element.name_contractor+'</td>';
							TableStr += '<td class="labelleft">'+element.pan_no+'</td>';
							TableStr += '<td class="labelleft" nowrap="nowrap">'+ContGst+'</td>';
							TableStr += '<td class="labelcenter" style="text-align: center;" nowrap>'+PaymentDate+'</td>';
							TableStr += '<td class="labelright" style="text-align: right;" nowrap="nowrap">'+IndianRupeeFormat(GstAmtMonForm)+'</td>';
							TableStr += '<td class="labelright" style="text-align: right;" nowrap="nowrap">'+SGst+'</td>';
							TableStr += '<td class="labelright" style="text-align: right;" nowrap="nowrap">'+CGst+'</td>';
							TableStr += '<td class="labelright" style="text-align: right;" nowrap="nowrap">'+IGst+'</td>';
							TableStr += '<td class="labelright" style="text-align: right;" nowrap="nowrap">'+IndianRupeeFormat(TotalGstMonForm)+'</td>';
							TableStr += '<td class="labelleft" nowrap="nowrap"> </td>';
							TableStr += '</tr>';
							Sno++;
						});
						if(TotalBillAmt > 0){ 
							TotalBillAmt 	= Number(TotalBillAmt).toFixed(2);
							var TotalBillAmtStr = TotalBillAmt;
							TotalGstAmt 	= Number(TotalGstAmt).toFixed(2);
							var TotalGstAmtStr = TotalGstAmt;
							TableStr += '<tr>';
							TableStr += '<td class="labelright mod-totrow" colspan="10"><b> Total GST Amount (&#x20b9;)</b></td>';
							TableStr += '<td class="labelright mod-totrow" style="text-align: right;" nowrap="nowrap"><b>'+IndianRupeeFormat(TotalGstAmtStr)+'</b></td>';
							TableStr += '<td class="labelright mod-totrow" nowrap="nowrap"></td>';
							TableStr += '</tr>';
						}else{ 
							TableStr += '<tr>';
							TableStr += '<td class="labelcenter" colspan="14">No Records Found</td>';
							TableStr += '</tr>';
						}
					}else if(StmtCode == "LCESSSTMT"){									////////////////////// ------ FOR LCESS STATEMENT ------ //////////////////////
						TableStr += '<tr>';
						TableStr += '<th class="colhead">S.No</th>';
						TableStr += '<th class="colhead">RAB NO.</th>';
						TableStr += '<th class="colhead">Name of Contractor</th>';
						TableStr += '<th class="colhead">Name of Work</th>';
						TableStr += '<th class="colhead">Date of Payment</th>';
						TableStr += '<th class="colhead">Bill Value (&#x20b9;)</th>';
						TableStr += '<th class="colhead">LCESS Amount (&#x20b9;)</th>';
						TableStr += '</tr>';
						var TotalBillAmt = 0;
						var TotalLcessAmt = 0;
						var StmtData = data['MonthlyRecData'];
						var PaymentDt = data['PaymentDtDisplay'];
						$.each(StmtData, function(index, element) {
							var PaymentDate = PaymentDt[index];
							var RbnVal 		= element.rbn;
							var sheetidVal = element.sheetid;
							var LcessAmt	= element.rec_amt;
								LcessAmt 	= Number(LcessAmt).toFixed(2);
							var AbstNetAmt = element.abstract_net_amt;
								AbstNetAmt 	= Number(AbstNetAmt).toFixed(2);			
							TotalBillAmt 	= Number(TotalBillAmt) + Number(AbstNetAmt);
							TotalLcessAmt 	= Number(TotalLcessAmt) + Number(LcessAmt);
							TableStr += '<tr>';
							TableStr += '<td class="labelcenter"  style="text-align: center;">'+Sno+'</td>';
							TableStr += '<td class="labelcenter" style="text-align: center;" nowrap="nowrap">'+RbnVal+'</td>';
							TableStr += '<td class="labelleft">'+element.name_contractor+'</td>';
							TableStr += '<td class="labelleft">'+element.work_name+'</td>';
							TableStr += '<td class="labelcenter" style="text-align: center;" nowrap>'+PaymentDate+'</td>';
							TableStr += '<td class="labelright" style="text-align: right;" nowrap="nowrap">'+IndianRupeeFormat(AbstNetAmt)+'</td>';
							TableStr += '<td class="labelright" style="text-align: right;" nowrap="nowrap">'+IndianRupeeFormat(LcessAmt)+'</td>';
							TableStr += '</tr>';
							Sno++;
						});
						if(TotalBillAmt > 0){
							TotalBillAmt 	= Number(TotalBillAmt).toFixed(2);
							var TotalBillAmtStr = TotalBillAmt;
							TotalLcessAmt 	= Number(TotalLcessAmt).toFixed(2);
							var TotalLcessAmtStr = TotalLcessAmt;
							TableStr += '<tr>';
							TableStr += '<td class="labelright mod-totrow" colspan="6"><b> Total LCESS Amount (&#x20b9;)</b></td>';
							TableStr += '<td class="labelright mod-totrow" style="text-align: right;" nowrap="nowrap"><b>'+IndianRupeeFormat(TotalLcessAmtStr)+'</b></td>';
							TableStr += '</tr>';
						}else{
							TableStr += '<tr>';
							TableStr += '<td class="labelcenter" colspan="8">No Records Found</td>';
							TableStr += '</tr>';
						}
					}else if(StmtCode == "SDRCSTMT"){									////////////////////// ------ FOR SD RECOVERY STATEMENT ------ //////////////////////
						TableStr += '<tr>';
						TableStr += '<th class="colhead">S.No</th>';
						TableStr += '<th class="colhead">Work Order No.</th>';
						TableStr += '<th class="colhead">Name of Contractor</th>';
						TableStr += '<th class="colhead">Name of Work</th>';
						TableStr += '<th class="colhead">Engineer In Charge</th>';
						TableStr += '<th class="colhead">RAB NO.</th>';
						TableStr += '<th class="colhead">Date of Payment</th>';
						TableStr += '<th class="colhead">Gross Bill Amount</br>(&#x20b9;)</th>';
						TableStr += '<th class="colhead">SD Recovery Amount</br>(&#x20b9;)</th>';
						TableStr += '<th class="colhead" style="font-weight:bold;">Remarks</th>';
						TableStr += '</tr>';
						var TotalBillAmt = 0;
						var TotalSDAmt = 0;
						var StmtData 	= data['MonthlyRecData'];	
						var EicNameData 	= data['eicnamedata']; 
						var PaymentDt = data['PaymentDtDisplay'];  
						$.each(StmtData, function(index, element) { 
							var PaymentDate = PaymentDt[index];
							var RbnVal 		= element.rbn;
							var sheetidVal = element.sheetid;
							var ContName 	= element.name_contractor;
							var WorkName 	= element.work_name;
							var EicName 	= element.sheetid;
							if(EicName == null){
								EicName = "";
							}else{
								EicName = EicName;
							}
							var WorkNumber	= element.work_order_no;
							var SDAmt		= element.rec_amt;                
							SDAmt 			= Number(SDAmt).toFixed(2);
							var SDAmtMonForm = SDAmt;
							var AbstNetAmt = element.abstract_net_amt;
							AbstNetAmt 		= Number(AbstNetAmt).toFixed(2);
							var AbstNetAmtMonForm = AbstNetAmt;
							
							TotalBillAmt = Number(TotalBillAmt) + Number(AbstNetAmt);
							TotalSDAmt = Number(TotalSDAmt) + Number(SDAmt);
							TableStr += '<tr>';
							TableStr += '<td class="labelcenter" style="text-align: center;">'+Sno+'</td>';
							TableStr += '<td class="labelleft" nowrap="nowrap">'+WorkNumber+'</td>';
							TableStr += '<td class="labelleft">'+ContName+'</td>';
							TableStr += '<td class="labelleft">'+WorkName+'</td>';
							TableStr += '<td class="labelleft"></td>';
							TableStr += '<td class="labelcenter" style="text-align: center;" nowrap="nowrap">'+RbnVal+'</td>';
							TableStr += '<td class="labelcenter" style="text-align: center;" nowrap>'+PaymentDate+'</td>';
							TableStr += '<td class="labelright" style="text-align: right;" nowrap="nowrap">'+IndianRupeeFormat(AbstNetAmtMonForm)+'</td>';
							TableStr += '<td class="labelright" style="text-align: right;" nowrap="nowrap">'+IndianRupeeFormat(SDAmtMonForm)+'</td>';
							TableStr += '<td class="labelleft" nowrap="nowrap"></td>';
							TableStr += '</tr>';
							Sno++;
						});
						if(TotalBillAmt > 0){
							TotalBillAmt 	= Number(TotalBillAmt).toFixed(2);
							var TotalBillAmtStr = TotalBillAmt;
							TotalSDAmt 	= Number(TotalSDAmt).toFixed(2);
							var TotalSDAmtStr = TotalSDAmt;
							TableStr += '<tr>';
							TableStr += '<td class="labelright mod-totrow" colspan="8"><b> Total SD Recovery Amount (&#x20b9;)</b></td>';
							TableStr += '<td class="labelright mod-totrow" style="text-align: right;" nowrap="nowrap"><b>'+IndianRupeeFormat(TotalSDAmtStr)+'</b></td>';
							TableStr += '<td class="labelright mod-totrow" nowrap="nowrap"><b></b></td>';
							TableStr += '</tr>';
						}else{
							TableStr += '<tr>';
							TableStr += '<td class="labelcenter" colspan="11">No Records Found</td>';
							TableStr += '</tr>';
						}
					}else if(StmtCode == "PSDBRSH"){									////////////////////// ------ FOR PG SD BROAD SHEET ------ //////////////////////
						TableStr += '<tr>';
						TableStr += '<th class="colhead">S.No</th>';
						TableStr += '<th class="colhead">Name of Contractor</th>';
						TableStr += '<th class="colhead">Name of Work</th>';
						TableStr += '<th class="colhead">Credit/Debit</br>Date</th>';
						TableStr += '<th class="colhead">Opening Balance</th>';
						TableStr += '<th class="colhead">Credit</br>( &#8377; )</th>';
						TableStr += '<th class="colhead">Debit</br>( &#8377; )</th>';
						//TableStr += '<th class="colhead">Total Of</th>';
						//TableStr += '<th class="colhead">PTA IN</th>';
						//TableStr += '<th class="colhead">PTA OUT</th>';
						TableStr += '<th class="colhead">Closing Balance</br>( &#8377; )</th>';
						TableStr += '<th class="colhead" style="font-weight:bold;">Remarks</th>';
						TableStr += '</tr>';
						var TotalDebAmt = 0;
						var TotalCreAmt = 0;
						var DebitAmt = 0;
						var CreditAmt = 0;
						var EchoDate = "";
						var StmtData = data['MonthlyRecData'];	
						$.each(StmtData, function(index, element) { 
							var CreatedDt	= element.createdon;
							var RelasedDt	= element.released_date;
							var InstStat	= element.inst_status;
							var InstAmt		= element.inst_amt;               
								InstAmt 		= Number(InstAmt).toFixed(2);
							var InstAmtMonForm = InstAmt; 
							if(InstStat == 'R'){
								EchoDate = RelasedDt;
								DebitAmt 	= InstAmt;
								CreditAmt 	= "";
							var DebitAmtRound = Number(DebitAmt).toFixed(2);
							var DebitAmtRoundMonForm = DebitAmtRound;
							var CreditAmtRoundMonForm = "";
							}else{
								EchoDate = CreatedDt;
								CreditAmt 	= InstAmt;
								DebitAmt 	= "";
							var CreditAmtRound = Number(CreditAmt).toFixed(2);
							var CreditAmtRoundMonForm = CreditAmtRound;
							var DebitAmtRoundMonForm = "";
							}

							TotalDebAmt = Number(TotalDebAmt) + Number(DebitAmt);
							TotalCreAmt = Number(TotalCreAmt) + Number(CreditAmt);
							TableStr += '<tr>';
							TableStr += '<td class="labelcenter" style="text-align: center;">'+Sno+'</td>';
							TableStr += '<td class="labelleft">'+element.name_contractor+'</td>';
							TableStr += '<td class="labelleft">'+element.work_name+'</td>';
							TableStr += '<td class="labelcenter" nowrap="nowrap">'+EchoDate+'</td>';
							TableStr += '<td class="labelcenter" nowrap="nowrap"> </td>';
							TableStr += '<td class="labelright" style="text-align: right;" nowrap="nowrap">'+IndianRupeeFormat(CreditAmtRoundMonForm)+'</td>';
							TableStr += '<td class="labelright" style="text-align: right;" nowrap="nowrap">'+IndianRupeeFormat(DebitAmtRoundMonForm)+'</td>';
							//TableStr += '<td class="labelcenter" nowrap> </td>';
							//TableStr += '<td class="labelright" nowrap="nowrap"> </td>';
							//TableStr += '<td class="labelright" nowrap="nowrap"> </td>';
							TableStr += '<td class="labelright" nowrap="nowrap"> </td>';
							TableStr += '<td class="labelleft" nowrap="nowrap"></td>';
							TableStr += '</tr>';
							Sno++;
						});
						if(Sno > 1){
							TotalDebAmt = Number(TotalDebAmt).toFixed(2);
							var TotalDebAmtStr = TotalDebAmt;
							TotalCreAmt = Number(TotalCreAmt).toFixed(2);
							var TotalCreAmtStr = TotalCreAmt;
							if(TotalDebAmtStr == 0){
								TotalDebAmtStr = "";
							}
							if(TotalCreAmtStr == 0){
								TotalCreAmtStr = "";
							}
							TableStr += '<tr>';
							TableStr += '<td class="labelright mod-totrow" colspan="4"><b> Total (&#x20b9;)</b></td>';
							TableStr += '<td class="labelright mod-totrow" nowrap="nowrap"><b> </b></td>'; 						//// Total Opening Balance
							TableStr += '<td class="labelright mod-totrow" style="text-align: right;" nowrap="nowrap"><b>'+IndianRupeeFormat(TotalCreAmtStr)+'</b></td>'; 	//// Total Credit Amount
							TableStr += '<td class="labelright mod-totrow" style="text-align: right;" nowrap="nowrap"><b>'+IndianRupeeFormat(TotalDebAmtStr)+'</b></td>'; 	//// Total Debit Amount
							//TableStr += '<td class="labelright mod-totrow" nowrap="nowrap"><b></b></td>';
							TableStr += '<td class="labelright mod-totrow" nowrap="nowrap"><b> </b></td>'; 						//// Total Closing Balance
							TableStr += '<td class="labelright mod-totrow" nowrap="nowrap"></td>';
							TableStr += '</tr>';
						}else{
							TableStr += '<tr>';
							TableStr += '<td class="labelcenter" colspan="11">No Records Found</td>';
							TableStr += '</tr>';
						}
					}else if(StmtCode == "SDBRSH"){									////////////////////// ------ FOR SD BROAD SHEET ------ //////////////////////    
						TableStr += '<tr>';
						TableStr += '<th class="colhead">S.No</th>';
						TableStr += '<th class="colhead">Work Order No.</th>';
						TableStr += '<th class="colhead">Name of Contractor</th>';
						TableStr += '<th class="colhead">Name of Work</th>';
						TableStr += '<th class="colhead">Opening Balance</th>';
						TableStr += '<th class="colhead">Credit</br>( &#8377; )</th>';
						TableStr += '<th class="colhead">Debit</br>( &#8377; )</th>';
						//TableStr += '<th class="colhead">Total Of</th>';
						//TableStr += '<th class="colhead">PTA IN</th>';
						//TableStr += '<th class="colhead">PTA OUT</th>';
						TableStr += '<th class="colhead">Closing Balance</br>( &#8377; )</th>';
						TableStr += '<th class="colhead" style="font-weight:bold;">Remarks</th>';
						TableStr += '</tr>';
						var TotalBillAmt = 0;
						var TotalSDAmt = 0;
						var TotalSDAmtDbt = 0;
						var StmtData 	= data['MonthlyRecData'];	
						$.each(StmtData, function(index, element) {
							var MopType = element.mop_type; 
							var RbnVal 		= element.rbn;
							var sheetidVal = element.sheetid;
							var ContName 	= element.name_contractor;
							var WoNumber 	= element.work_order_no;
							var WorkName 	= element.work_name;
							if(MopType == "RAB"){
								var SDAmt	= element.rec_amt;
								TotalSDAmt = Number(TotalSDAmt) + Number(SDAmt);
							}else if(MopType == "SDR"){
								var SDAmt	= element.net_payable_amt;
								TotalSDAmtDbt = Number(TotalSDAmtDbt) + Number(SDAmt);
							}else{
								var SDAmt	= 0;
							}
							
							SDAmt 			= Number(SDAmt).toFixed(2);
							var SDAmtMonForm = ""; var SDAmtMonFormDbt = "";
							if(MopType == "RAB"){
								SDAmtMonForm = SDAmt;
							}
							if(MopType == "SDR"){
								SDAmtMonFormDbt = SDAmt;
							}
							var AbstNetAmt = element.abstract_net_amt;
							AbstNetAmt 		= Number(AbstNetAmt).toFixed(2);
							var AbstNetAmtMonForm = AbstNetAmt;
							
							
							
							TotalBillAmt = Number(TotalBillAmt) + Number(AbstNetAmt);
							
							TableStr += '<tr>';
							TableStr += '<td class="labelcenter" style="text-align: center;">'+Sno+'</td>';
							TableStr += '<td class="labelleft" nowrap="nowrap">'+WoNumber+'</td>';
							TableStr += '<td class="labelleft">'+ContName+'</td>';
							TableStr += '<td class="labelleft">'+WorkName+'</td>';
							TableStr += '<td class="labelright" nowrap="nowrap"> </td>';
							TableStr += '<td class="labelright" style="text-align: right;" nowrap="nowrap">'+IndianRupeeFormat(SDAmtMonForm)+'</td>';
							TableStr += '<td class="labelright" style="text-align: right;" nowrap="nowrap">'+IndianRupeeFormat(SDAmtMonFormDbt)+'</td>';
							//TableStr += '<td class="labelcenter" nowrap> </td>';
							//TableStr += '<td class="labelright" nowrap="nowrap"> </td>';
							//TableStr += '<td class="labelright" nowrap="nowrap"> </td>';
							TableStr += '<td class="labelright" nowrap="nowrap"> </td>';
							TableStr += '<td class="labelleft" nowrap="nowrap"></td>';
							TableStr += '</tr>';
							Sno++;
						});
						if(Sno > 1){
							TotalSDAmt 	= Number(TotalSDAmt).toFixed(2);
							TotalSDAmtDbt 	= Number(TotalSDAmtDbt).toFixed(2);
							var TotalSDAmtStr = TotalSDAmt;
							var TotalSDAmtDbtStr = TotalSDAmtDbt;
							if(TotalSDAmtStr == 0){
								TotalSDAmtStr = "";
							}
							if(TotalSDAmtDbtStr == 0){
								TotalSDAmtDbtStr = "";
							}
							TableStr += '<tr>';
							TableStr += '<td class="labelright mod-totrow" colspan="4"><b> Total (&#x20b9;)</b></td>';
							TableStr += '<td class="labelright mod-totrow" nowrap="nowrap"><b> </b></td>'; 						//// Total Opening Balance
							TableStr += '<td class="labelright mod-totrow" style="text-align: right;" nowrap="nowrap"><b>'+IndianRupeeFormat(TotalSDAmtStr)+'</b></td>'; 	//// Total Credit Amount
							TableStr += '<td class="labelright mod-totrow" style="text-align: right;" nowrap="nowrap"><b>'+IndianRupeeFormat(TotalSDAmtDbtStr)+'</b></td>'; 						//// Total Debit Amount
							// TableStr += '<td class="labelright mod-totrow" nowrap="nowrap"><b></b></td>';
							TableStr += '<td class="labelright mod-totrow" nowrap="nowrap"><b> </b></td>'; 						//// Total Closing Balance
							TableStr += '<td class="labelright mod-totrow" nowrap="nowrap"></td>';
							TableStr += '</tr>';
						}else{
							TableStr += '<tr>';
							TableStr += '<td class="labelcenter" colspan="10">No Records Found</td>';
							TableStr += '</tr>';
						}
					}else if(StmtCode == "VOUCH"){									////////////////////// ------ FOR VOUCHER EXPENDITURE ------ //////////////////////
						TableStr += '<tr>';
						TableStr += '<th class="colhead">S.No</th>';
						TableStr += '<th class="colhead">Voucher No.</th>';
						TableStr += '<th class="colhead">Voucher Date</th>';
						TableStr += '<th class="colhead">Description of the Work</th>';
						TableStr += '<th class="colhead">Name of Contractor</th>';
						TableStr += '<th class="colhead">Voucher Amount</br>(&#x20b9;)</th>';
						TableStr += '<th class="colhead">CCNo.</th>';
						TableStr += '<th class="colhead">HOA</th>';
						TableStr += '</tr>';
						var TotalVouchAmt = 0;
						var StmtData = data['data'];		//alert(JSON.stringify(StmtData));
						$.each(StmtData, function(index, element) { 
							var VouchNum 		= element.vr_no;
							var VouchDate 		= element.vr_dt;
							var WorkName 		= element.item; 
							var ContName 		= element.indentor;
							var VouchAmt		= element.vr_amt;
							var VouchCCno		= element.ccno;
							var VouchHoa		= element.new_hoa;

							VouchAmt 			= Number(VouchAmt).toFixed(2);
							var VouchAmtMonForm = VouchAmt;
							
							TotalVouchAmt = Number(TotalVouchAmt) + Number(VouchAmt);
							TableStr += '<tr>';
							TableStr += '<td class="labelcenter" style="text-align: center;">'+Sno+'</td>';
							TableStr += '<td class="labelcenter" style="text-align: center;" nowrap="nowrap">'+VouchNum+'</td>';
							TableStr += '<td class="labelcenter" style="text-align: center;" nowrap="nowrap">'+VouchDate+'</td>';
							TableStr += '<td class="labelleft">'+WorkName+'</td>';
							TableStr += '<td class="labelleft">'+ContName+'</td>';
							TableStr += '<td class="labelright" style="text-align: right;" nowrap="nowrap">'+IndianRupeeFormat(VouchAmtMonForm)+'</td>';
							TableStr += '<td class="labelcenter" style="text-align: center;" nowrap="nowrap">'+VouchCCno+'</td>';
							TableStr += '<td class="labelleft" nowrap="nowrap">'+VouchHoa+'</td>';
							TableStr += '</tr>';
							Sno++;
						});
						if(Sno > 1){
							TotalVouchAmt 	= Number(TotalVouchAmt).toFixed(2);
							var TotalVouchAmtStr = TotalVouchAmt;	
							TableStr += '<tr>';
							TableStr += '<td class="labelright mod-totrow" colspan="5"><b> Total (&#x20b9;)</b></td>';
							TableStr += '<td class="labelright mod-totrow" style="text-align: right;" nowrap="nowrap"><b>'+IndianRupeeFormat(TotalVouchAmtStr)+'</b></td>'; 	//// Total Credit Amount
							TableStr += '<td class="labelright mod-totrow" nowrap="nowrap" colspan="2"><b></b></td>';
							TableStr += '</tr>';
						}else{
							TableStr += '<tr>';
							TableStr += '<td class="labelcenter" colspan="8">No Records Found</td>';
							TableStr += '</tr>';
						}
					}
										
					
					$("#StmtTable tr:gt(0)").remove();
					$("#StmtTable tr:last").after(TableStr);
				}
			}
		});
	}
	$("body").on("click","#exportToExcel", function(event){
		var table = $('body').find('.table2excel');
		if(table.length){ 
			var tableClone = table.clone();
			tableClone.find('tr:first').remove();
			var customHeader = `<tr>
				<th colspan="7" style="text-align:center;">
					<b>
						${TitlePart1}(${MonthYrStr})
					</b>
				</th>
			</tr>`;
			tableClone.find('tr:first').before(customHeader);
			tableClone.table2excel({
	        exclude: ".noExl",
	        name: "Excel Document Name",
	        filename: TitlePart1+"("+MonthYrStr+")"+".xls",
	        fileext: ".xls",
	        exclude_img: true,
	        exclude_links: true,
	        exclude_inputs: true
	    });
		}
	});
	$("body").on("click","#exportToPdf", function(event){ 
	var htmlContent = document.getElementById('testpdf').innerHTML;
	var parser = new DOMParser();
	var doc = parser.parseFromString(htmlContent, 'text/html');
	var table = doc.querySelector('.prtable');
	if (table && table.rows.length > 0) {2
	    table.deleteRow(0);
	}
	var ModifiedHtmlContent = doc.body.innerHTML;
	var PdfContent = `
                   <html>
                   <head>
					<meta charset="UTF-8">
					<style>
    				    body {
    				        font-family: 'DejaVu Sans', 'verdana', sans-serif;
    				        font-size: 10px;
    				        margin: 0;
    				        padding: 0;
    				    }
    				    .prtable {
    				        width: 100%;
    				        border-collapse: collapse;
    				    }
    				    .prtable th {
    				        border: 1px solid #C3C6C8;
    				        background-color: #f2f2f2;
    				    }
    				    .prtable td {
    				        border: 1px solid #C3C6C8;
    				        color: #0000CD;
    				        font-size: 10px;
    				        padding: 4px;
    				    }
    				    @page {
    				        size: A4;
    				        margin: 10mm;
    				    }
    				</style>
                   </head>
                   <body>
        				<div style="text-align:center"><b>GOVERNMENT OF INDIA</b></div>
        				<div style="text-align:center"><b>BHABHA ATOMIC RESEARCH CENTRE</b></div>
        				<div style="text-align:center; font-size:11px;"><b>@if(session('WcmsEmpSec')!= NULL){{collect(Helper::GetOfficeById(NULL,session('WcmsEmpSec')))->pluck('office_name')->first();}}@endif</b></div>
        				<div style="text-align:center; font-size:11px;"><b>( WCMS report )</b></div>
        				<div style="text-align:center; font-size:11px;"><b>${TitlePart1}(${MonthYrStr})</b></div></br>
                        ${ModifiedHtmlContent}
                   </body>
                   </html>
               `;			  
		$.ajax({
			url:"{{ route('ajax.GeneratePdf') }}",
			method: 'POST',
			data: {
				PdfContent: PdfContent,
				_token: '{{ csrf_token() }}'
			},
			xhrFields: {
				responseType: 'blob'
			},
			success: function(response) {
				var blob = new Blob([response], { type: 'application/pdf' });
				var link = document.createElement('a');
				link.href = window.URL.createObjectURL(blob);
				link.download = TitlePart1+'('+MonthYrStr+')'+'.pdf';
				link.click();
			},
			error: function(xhr, status, error) {
				console.error('Error generating PDF:', error);
			}
		});
	});
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