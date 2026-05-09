@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
									
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="{{ route('admin.MailTransactionView') }}" method="post" enctype="multipart/form-data" name="form">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row plr">
								<div class="div12 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">MAIL TRANSACTION</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
											<div class="div2 pd-lr-1" id="YearRow">
												<div class="label">&nbsp;Select Year</div>
												<div>
													<select name='txt_year' id='txt_year' class='tboxclass'>
														<option value="">---Select---</option>
														@php
															$StartYear = 2013;
															$CurrYear = date('Y');
															for($i=$StartYear; $i<=$CurrYear; $i++){
																$FinYear = $i;
														@endphp
																<option value="{{ $FinYear }}">{{ $FinYear }}</option>
														@php
															}
														@endphp
														<?php// echo $objBind->BindYear(0); ?>
													</select>
												</div>
											</div>
											<div class="div2 pd-lr-1" id="MonthRow">
												<div class="label">&nbsp;Select Month</div>
												<div>
													<select name="cmb_mon" id="cmb_mon" class="tboxclass">
														<option value="">---Select---</option>
														<option value="ALL">ALL Months</option>
														<option value="01">JAN</option>
														<option value="02">FEB</option>
														<option value="03">MAR</option>
														<option value="04">APR</option>
														<option value="05">MAY</option>
														<option value="06">JUN</option>
														<option value="07">JUL</option>
														<option value="08">AUG</option>
														<option value="09">SEP</option>
														<option value="10">OCT</option>
														<option value="11">NOV</option>
														<option value="12">DEC</option>
													</select>
												</div>
											</div>
											<div class="div2" id="PeriodRow1">
												<div class="label-sm">&nbsp;</div>
												<div class="label">
													(OR Select Period)
												</div>
											</div>
											<div class="div2 pd-lr-1" id="PeriodRow1">
												<div class="label">&nbsp;From Date</div>
												<div>
													<input type="text" value="" readonly="" name="txt_fromdt" id="txt_fromdt" class="tboxclass datepicker" />
												</div>
											</div>
											<div class="div2 pd-lr-1" id="PeriodRow2">
												<div class="label">&nbsp;To Date</div>
												<div>
													<input type="text" value="" readonly="" name="txt_todt" id="txt_todt" class="tboxclass datepicker" />
												</div>
											</div>
											
											<div class="div2 pd-lr-1">
												<div class="label">&nbsp;</div>
												<div>
													<input type="submit" name="btn_view" id="btn_view" class="btn btn-info" value="View">
												</div>
											</div>
											</div>
											<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
											<div class="row clearrow">&nbsp;</div>
											<div class="div12 mbtable">
												<div class="row divhead" style="text-align:left">&nbsp;Mail Transaction @php if(isset($heading)){ echo $heading; } @endphp</div>
                                                <div class="row clearrow"></div>
												<table class="table dataTable rtable" border="1" width="100%" align="center">
													@php
													if($NoDetails == 0){ 
														@endphp
														<tr>
															<th class="colhead"><b>S.No</b></th>
															<th class="colhead"><b>To</b></th>
															<th class="colhead"><b>Content</b></th>
															<th class="colhead"><b>Status</b></th>
															<th class="colhead"><b>Date & Time</b></th>
															
														</tr>
														@php
														    if($NoRecVal == 1){	
															$sno=1;
															$ToMail = 0;
															$Content = "";
															$Status = "";
															$DateTime = "";
															$AN = "AM";
															$FN = "PM";
															if($MailTransaction != null){ 
																foreach($MailTransaction as $List){
																	$ToMail 	= $List->mail_to;
																	$Content 	= $List->mail_content;
																	$Status = $List->mail_status;
																	$DateTime = \Carbon\Carbon::parse($List->created_at)->format('d.m.Y H:i');	
																	$Time = \Carbon\Carbon::parse($List->created_at)->format('H');
																	echo "<tr>";	
																	echo "<td class='labelcenter'>" . $sno . '.' . "</td>";
																	echo "<td class='labelcenter'>" . $ToMail . "</td>";
																	echo "<td class='labelleft'>" . $Content . "</td>";
																	echo "<td class='labelleft'>" .  $Status . "</td>";
																	if($Time <= 11){
																		echo "<td class='labelleft'>". $DateTime ."". $AN ."</td>";
																	}
																	else{
																		echo "<td class='labelleft'>". $DateTime ."". $FN ."</td>";
																	}
																	echo "</tr>";
																	$sno++;
																}
																	
															}
														}
													}
													@endphp
													@php 
														if(($NoDetails == 1)||($MailTransaction == null)){
															echo"<td class='label' align='center' colspan='9'>No Records Found</td>";
														} 
													@endphp
													</table>
												</div>
                                                <div class="row clearrow"></div>
												
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
	</form>
</body>	

<!-- <script src="{{ url('assets/table2excel/jquery.table2excel.js') }}"></script> -->
<script src="js/CommonJSLibrary.js"></script>
<script type="text/javascript" language="javascript">
$(function(){
	var msg = "<?php// echo $msg; ?>";
	document.querySelector('#top').onload = function(){
		/* if(msg != ""){
			//BootstrapDialog.alert(msg);
			BootstrapDialog.show({
				title: 'Information',
				closable: false,
				message: msg,
				buttons: [{
					label: '&nbsp; OK &nbsp;',
					action: function(dialog) {
						$(location).attr("href","VouchersList.php");
					}
				}]
			});
		} */
	};
});

// });

/*$("#txt_todt").datepicker({
	dateFormat: "dd/mm/yy",
	changeMonth: true,
	changeYear: true,
});*/

if(window.history.replaceState ) {
	window.history.replaceState( null, null, window.location.href );
}

$("body").on("click","#btn_view", function(event){
	var SelYear		= $("#txt_year").val();
	var SelMonth	= $("#cmb_mon").val();                  
	var SelFrDate	= $("#txt_fromdt").val();
	var SelToDate	= $("#txt_todt").val();

	switch(true) {
		case ((SelYear == "") && (SelMonth == "") && (SelFrDate == "") && (SelToDate == "")) :
			BootstrapDialog.alert("Please select atleast one period..!!");
			event.preventDefault();
			event.returnValue = false;
			break;
		case ((SelYear != "") && (SelMonth != "") && (SelFrDate != "") && (SelToDate != "")) :
			BootstrapDialog.alert("Please select (Year - Month) or (From Date - To Date) any one period..!!");
			event.preventDefault();
			event.returnValue = false;
			break;
		case ((SelYear == "") && (SelMonth == "") && (SelFrDate == "") && (SelToDate != "")) :
			BootstrapDialog.alert("Please select Valid From Date - To Date period..!!");
			event.preventDefault();
			event.returnValue = false;
			break;
		case ((SelYear == "") && (SelMonth == "") && (SelFrDate != "") && (SelToDate == "")) :
			BootstrapDialog.alert("Please select Valid From Date - To Date period..!!");
			event.preventDefault();
			event.returnValue = false;
			break;
		case ((SelYear != "") && (SelMonth == "") && (SelFrDate == "") && (SelToDate == "")) :
			BootstrapDialog.alert("Please select Valid Month..!!");
			event.preventDefault();
			event.returnValue = false;
			break;
		case ((SelYear != "") && (SelMonth == "") && (SelFrDate == "") && (SelToDate != "")) :
			BootstrapDialog.alert("Please select Valid period..!!");
			event.preventDefault();
			event.returnValue = false;
			break;
		case ((SelYear != "") && (SelMonth == "") && (SelFrDate != "") && (SelToDate == "")) :
			BootstrapDialog.alert("Please select Valid period..!!");
			event.preventDefault();
			event.returnValue = false;
			break;		
		case ((SelYear == "") && (SelMonth != "") && (SelFrDate == "") && (SelToDate == "")) :
			BootstrapDialog.alert("Please Enter Valid Year..!!");
			event.preventDefault();
			event.returnValue = false;
			break;		
		case ((SelYear == "") && (SelMonth != "") && (SelFrDate == "") && (SelToDate != "")) :
			BootstrapDialog.alert("Please select Valid period..!!");
			event.preventDefault();
			event.returnValue = false;
			break;
		case ((SelYear == "") && (SelMonth != "") && (SelFrDate != "") && (SelToDate == "")) :
			BootstrapDialog.alert("Please select Valid period..!!");
			event.preventDefault();
			event.returnValue = false;
			break;
		case ((SelYear != "") && (SelMonth == "") && (SelFrDate != "") && (SelToDate != "")) :
			BootstrapDialog.alert("Please select Valid period..!");
			event.preventDefault();
			event.returnValue = false;
			break;
		case ((SelYear == "") && (SelMonth != "") && (SelFrDate != "") && (SelToDate != "")) :
			BootstrapDialog.alert("Please select Valid period..!");
			event.preventDefault();
			event.returnValue = false;
	}
});


</script>
<style>
	.tboxclass{
		width:99%;
	}
	table.dataTable thead > tr > th.sorting::before{
		bottom: 0%;
		content: "";
	}
	table.dataTable thead > tr > th.sorting::after{
		top: 0%;
		content: "";
	}
	th.tabtitle{
		text-align:left !important;
	}
	.mgtb-8 td{
		padding:2px !important;
		font-size:10px !important;
		font-weight:500;
	}
	.mgtb-8 th{
		background-color:#F2F3F4 !important;
		font-size:10px !important;
		padding:2px !important;
	}
</style>
@endsection