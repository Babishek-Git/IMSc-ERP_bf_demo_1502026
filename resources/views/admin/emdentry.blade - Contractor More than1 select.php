@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')


<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="{{ route('admin.emdsave') }}" method="post" enctype="multipart/form-data" name="form">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row ">
								<div class="div1">&nbsp;</div>
								<div class="div10 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">EMD-Entry</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>									
											<div class="row">
												<div class="div4 label"> 	
													Tender Number
												</div>
												<div class="div6">
													<select id="cmb_tnder_no" name="cmb_tnder_no" class="tboxsmclass">
														<option value="">--------------- Select --------------- </option>
														@php if(isset($data['sheetquery'] )){ @endphp
														@foreach($data['sheetquery'] as $Projects)
															@php
																if((isset($TechProject))&&($TechProject== $Projects->tr_id)){
																	$SelStr = 'selected="selected"';
																}else{
																	$SelStr = '';
																}
															@endphp
														<option value="{{ $Projects->tr_id }}"{{$SelStr;}}> {{ $Projects->tr_no }} </option>
														@endforeach
														@php } @endphp
													</select>
												</div>
												@php 
												//if($RowCount==1){
												@endphp
												<!-- <div class="div3 label " id="complete">
													&emsp;<i class="fa fa-check-circle-o" style="font-size:20px; color:#EA253C;"></i> <span style="color:EA253C; top:-4px; position:relative;">Financial Bid Uploaded</span>
												</div> -->
												@php 
												//}
												@endphp
											</div>
											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div4 label">
													Name of Work
												</div>
												<div class="div6">
													<textarea name='txt_work_name' id='txt_work_name' class="tboxsmclass" readonly="">@php // if(isset($_GET['id']) != ""){ echo $WorkName; } @endphp</textarea>
												</div>
											</div>
											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div4 label">
													EMD Amount ( &#8377; )
												</div>
												<div class="div6">
													<input type='hidden' readonly="" name='txt_full_emd_amt' id='txt_full_emd_amt' class="tboxsmclass" value="@php // if(isset($_GET['id']) != ""){ echo $EMdamtt; } @endphp">
													<input type='text' readonly="" name='txt_full_emd_amt_indform' id='txt_full_emd_amt_indform' class="tboxsmclass" value="@php // if(isset($_GET['id']) != ""){ echo IndianMoneyFormat($EMdamtt); } @endphp">
													<input type="hidden" name="txt_tender_id" id="txt_tender_id" maxlength="50" class="tboxsmclass" style="width:99%" value="@php // if(isset($_GET['id']) != ""){ echo $TRId; } @endphp">
													<input type="hidden" name="txt_emdmas_id" id="txt_emdmas_id" maxlength="50" class="tboxsmclass" style="width:99%" value="@php // if(isset($_GET['id']) != ""){ echo $Emdid; } @endphp">
												</div>
											</div>
											<div class="row smclearrow isappcheck" style="display-none"></div>
											<div class="row smclearrow"></div>
											<!--    2nd Div Starts Here   -->
											<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="left">BG / FDR Details</div></div></div>
											<table class="dataTable etable " align="center" width="100%" id="emdtable1">
												<tr class="label" style="background-color:#FFF">
													<th align="center">Bidder's Name</th>
													<th align="center">Instrument <br>Type</th>
													<th align="center">Instrument <br> Number</th>
													<th align="center"> Bank Name </th>
													<th align="center">Branch </th>
													<th align="center">Date of <br> Issued</th>
													<th align="center">Date of <br> Expiry</th>
													<th align="center">Amount ( &#8377; )</th>
													<th align="center">Action</th>
												</tr>
												<tr>
													<td align="center">
														<select id="cmb_bidder_0" name="cmb_bidder_0" class="tboxsmclass">
															<option value="">---- Select ----</option>
															@php if(isset($data['mbookquerys'] )){ @endphp
															@foreach($data['mbookquerys'] as $Projects)
																@php
																	if((isset($TechProject))&&($TechProject== $Projects->contid)){
																		$SelStr = 'selected="selected"';
																	}else{
																		$SelStr = '';
																	}
																@endphp
															<option value="{{ $Projects->contid }}"{{$SelStr;}}> {{ $Projects->name_contractor }} </option>
															@endforeach
															@php } @endphp
														</select>
													</td>
													<td align="center">
														<select name="cmd_instype_0" id ="cmd_instype_0" class="tboxsmclass">  
															<option value="">- Select - </option>
															<option value="BG">BG</option>
															<option value="FDR">FDR</option>
														</select>
													</td>
													<td align="center">
														<input type="text" name="instrunum_0" id ="instrunum_0"  maxlength="100" class="tboxsmclass">
													</td>
													<td align="center"><input type="text" class="tboxsmclass"  maxlength="50" name="txt_bankname_pg_0" id="txt_bankname_pg_0"></td>
													<td align="center"><input type="text" class="tboxsmclass" maxlength="100" name="txt_sno_pg_0" id="txt_sno_pg_0"></td>
													<td align="center"><input type="text" placeholder="DD/MM/YYYY" readonly="" data-index = '0' class="tboxsmclass date EmdDt" name="txt_date_pg_0" id="txt_date_pg_0"></td>
													<td align="center"><input type="text" placeholder="DD/MM/YYYY" readonly="" data-index = '0' class="tboxsmclass expdate ExpDt ValDate" name="txt_expir_date_pg_0" id="txt_expir_date_pg_0"></td>
													<td align="center"><input type="text" style="text-align:right;" maxlength="12" class="tboxsmclass" onKeyPress="return isNumberWithTwoDecimal(event,this);" onpaste="return false" name="txt_part_amt_0" id="txt_part_amt_0"></td>
													<td align="center"><input type="button"  name="emp_add" id="emp_add"  value="ADD" class="btn btn-info" style="margin-top:0px;"></td>
													<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}"/>
												</tr>
												<!-- For Update Function -->

												<!-- End for Update Function -->
											</table>
											<div class="row smclearrow"></div>
											<!-- <div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="left">DD / Banker's Cheque Details</div></div></div> -->
											<!-- <table class="dataTable etable table-responsive " align="center" width="100%" id="emdtable2">
												<tr class="label" style="background-color:#FFF">
													<th align="center">Bidder's Name</th>
													<th align="center">DD <br> Number</th>
													<th align="center"> Bank Name </th>
													<th align="center">Branch </th>
													<th align="center">Date of <br> Issued</th>
													<th align="center">Date of <br> Expiry</th>
													<th align="center">Amount <br>( &#8377; )</th>
													<th align="center">Challan<br>No. </th>
													<th align="center"> Challan <br> Date</th>
													<th align="center">Challan <br> Realisation<br>Date</th>
													<th align="center">Drawee <br> Bank<br>Details</th>
													<th align="center">Action</th>
												</tr>
												<tr>
													<td align="center">
														<select id="cmb_bidder_DD_0" name="cmb_bidder_DD_0" class="tboxsmclass">
															<option value="">---- Select ----</option>
															@php if(isset($data['mbookquerys'] )){ @endphp
															@foreach($data['mbookquerys'] as $Projects)
																@php
																	if((isset($TechProject))&&($TechProject== $Projects->contid)){
																		$SelStr = 'selected="selected"';
																	}else{
																		$SelStr = '';
																	}
																@endphp
															<option value="{{ $Projects->contid }}"{{$SelStr;}}> {{ $Projects->name_contractor }} </option>
															@endforeach
															@php } @endphp
														</select>	
													</td>
													<td align="center">
														<input type="text" name="instrunum_DD_0" id ="instrunum_DD_0"  maxlength="100" class="tboxsmclass">
													</td>
													<td align="center"><input type="text" class="tboxsmclass"  maxlength="50" name="txt_bankname_pg_DD_0" id="txt_bankname_pg_DD_0"></td>
													<td align="center"><input type="text" class="tboxsmclass" maxlength="100" name="txt_sno_pg_DD_0" id="txt_sno_pg_DD_0"></td>
													<td align="center"><input type="text" placeholder="DD/MM/YYYY" readonly="" data-DDindex = '0' class="tboxsmclass date EmdDDt ValDDDate" name="txt_date_pg_DD_0" id="txt_date_pg_DD_0"></td>
													<td align="center"><input type="text" placeholder="DD/MM/YYYY" readonly="" data-DDindex = '0' class="tboxsmclass expdate ExpDDt ValDDDate" name="txt_expir_date_pg_DD_0" id="txt_expir_date_pg_DD_0"></td>
													<td align="center"><input type="text" style="text-align:right;" maxlength="12" class="tboxsmclass" onpaste="return false" onKeyPress="return isNumberWithTwoDecimal(event,this);" name="txt_part_amt_DD_0" id="txt_part_amt_DD_0"></td>
													<td align="center"><input type="text" class="tboxsmclass" maxlength="100" name="txt_challNo_pg_DD_0" id="txt_challNo_pg_DD_0"></td>
													<td align="center"><input type="text" placeholder="DD/MM/YYYY" readonly="" data-DDindex = '0' class="tboxsmclass chdate  chdatval EmdDDt" name="txt_challandate_pg_DD_0" id="txt_challandate_pg_DD_0"></td>
													<td align="center"><input type="text" placeholder="DD/MM/YYYY" readonly="" data-DDindex = '0' class="tboxsmclass chdate  readatval ExpDDt " name="txt_Challanrealdate_pg_DD_0" id="txt_Challanrealdate_pg_DD_0"></td>
													<td align="center"><input type="text"  class="tboxsmclass" name="txt_draweebank_DD_0" id="txt_draweebank_DD_0"></td>
													<td align="center"><input type="button"  name="emp_DD_add" id="emp_DD_add"  value="ADD" class="btn btn-info" style="margin-top:0px;"></td>
												</tr>
											</table> -->
										
											<div class="div12" align="center">
												<!-- <input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/> -->
												@php 
												//if($RowCount==1){
												//@endphp
												@php 
												//}else if(($RowCount==0)&&(isset($_GET['id']) != "")){
												@endphp
												<!-- <input type="submit" class="btn btn-info" name="submit" id="submit" value=" Update " /> -->
												@php 
												//}else{
													@endphp
													<input type="submit" class="btn btn-info" name="submit" id="submit" value=" Save " />
												@php 
												//}
												@endphp
												<!-- <input type="button" class="btn btn-info" name="btn_view" id="btn_view" value="View" onClick="ViewTSList();"/> -->
											</div>
											<div class="row smclearrow"></div>
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
</body>	


			<!--==============================footer=================================-->
		
			<script src="js/jquery.hoverdir.js"></script>
		</form>
</body>
</html>
<script>
	$("#cmb_shortname").chosen();
	$("#cmb_engineer").chosen();
	$("#cmb_tnder_no").chosen();
	$("#cmb_bidder_0").chosen();
	$("#cmb_bidder_DD_0").chosen();
	var Index = "@php // echo $Index; @endphp"		
	var DDIndex = "@php // echo $DDIndex; @endphp"		

	var msg = "@php // echo $msg; @endphp";
    document.querySelector('#top').onload = function(){
	if(msg != ""){
			BootstrapDialog.show({
				message: msg,
				buttons: [{
					label: ' OK ',
					action: function(dialog) {
						dialog.close();
						window.location.replace('EMDEntry.php');
					}
				}]
			});
		}
};
$( ".date" ).datepicker({  
	changeMonth: true,
	changeYear: true,
	dateFormat: "dd/mm/yy",
	yearRange: "2000:+15",
	maxDate: new Date,
	defaultDate: new Date,
	});
	$( ".expdate" ).datepicker({  
		changeMonth: true,
		changeYear: true,
		dateFormat: "dd/mm/yy",
		yearRange: "2000:+25",
		defaultDate: new Date,
	});
	$( ".chdate" ).datepicker({  
		changeMonth: true,
		changeYear: true,
		dateFormat: "dd/mm/yy",
		yearRange: "2000:+25",
		defaultDate: new Date,
	});


	var KillEvent = 0;		
	$(document).ready(function(){ 
		
		$("body").on("change","#cmb_tnder_no", function(event){
			var MastId = $(this).val();
			var Id = $(this).val();
			$("#txt_work_name").val('');
			$("#txt_full_emd_amt").val('');
			$("#txt_full_emd_amt_indform").val('');
			$("#cmb_bidder_0").chosen('destroy');
			$("#cmb_bidder_0").val('');
			$("#cmb_bidder_0").chosen();
			$("#cmd_instype_0").val('');
			$("#instrunum_0").val('');
			$("#txt_bankname_pg_0").val('');
			$("#txt_sno_pg_0").val('');
			$("#txt_date_pg_0").val('');
			$("#txt_expir_date_pg_0").val('');
			$("#txt_part_amt").val('');
			$("#txt_work_name").val('');
			$("#cmb_bidder_DD_0").chosen('destroy');
			$("#cmb_bidder_DD_0").val('');
			$("#cmb_bidder_DD_0").chosen();
			$("#cmd_instype_DD_0").val('');
			$("#instrunum_DD_0").val('');
			$("#txt_bankname_pg_DD_0").val('');
			$("#txt_sno_pg_DD_0").val('');
			$("#txt_date_pg_DD_0").val('');
			$("#txt_expir_date_pg_DD_0").val('');
			$("#txt_part_amt_DD_0").val('');
			$("#txt_challNo_pg_DD_0").val('');
			$("#txt_challandate_pg_DD_0").val('');
			$("#txt_Challanrealdate_pg_DD_0").val('');
			$("#txt_draweebank_DD_0").val('');
			$.ajax({ 
				type: 'GET', 
				url: "{{ route('ajax.FindEstTsTrName') }}",
				data: { 'Id':Id, 'Page':'TR'}, 
				success: function (data) {  
					if(data != ''){ //alert(data)
						var EmdAmout = Math.round(data.emd);

						var EmdAmoutIndForm = (EmdAmout).toLocaleString('en-IN')
						$("#txt_work_name").val(data.work_name);	//alert(EmdAmout)
						$("#txt_full_emd_amt_indform").val(EmdAmoutIndForm);
						$("#txt_full_emd_amt").val(EmdAmout);
					}
				}
			});
		});

		$("body").on("change", ".ValDate", function(event){ //alert(1);
			var DateIndex = $(this).attr("data-index");
			var DateofIssue  = $("#txt_date_pg_"+DateIndex).val(); // alert(DateofIssue);
			var DateofExpiry = $("#txt_expir_date_pg_"+DateIndex).val(); //alert(DateofExpiry);
			if((DateofIssue != "") && (DateofExpiry != "") ){  
				var d1 = DateofExpiry.split("/");
				var d2 = DateofIssue.split("/");
				var emdexpdate = new Date(d1[2], d1[1]-1, d1[0]); //alert(emdexpdate);
				var emddate = new Date(d2[2], d2[1]-1, d2[0]); //alert(emddate);
				if(emdexpdate<emddate){
					var a="EMD Expiry date should be greater than EMD Date";
					BootstrapDialog.alert(a);
					$(this).val('');
					event.preventDefault();
					event.returnValue = false;
					//CheckVal = 1;
				}
			}
		});
		$("body").on("change", ".ValDDDate", function(event){ 
			var DateDDIndex = $(this).attr("data-DDindex");
			var DateofIssue  = $("#txt_date_pg_DD_"+DateDDIndex).val();  //alert(DateofIssue);
			var DateofExpiry = $("#txt_expir_date_pg_DD_"+DateDDIndex).val();
			if((DateofIssue != "") && (DateofExpiry != "") ){  
				var d1 = DateofExpiry.split("/");
				var d2 = DateofIssue.split("/");
				var emdexpdate = new Date(d1[2], d1[1]-1, d1[0]); //alert(emdexpdate);
				var emddate = new Date(d2[2], d2[1]-1, d2[0]); //alert(emddate);
				if(emdexpdate<emddate){
					var a="DD Expiry date should be greater than DD Date";
					BootstrapDialog.alert(a);
					$(this).val('');
					event.preventDefault();
					event.returnValue = false;
					//CheckVal = 1;
				}
			}
		});
		$("body").on("change", ".chdatval", function(event){ 
			var DateDDIndex = $(this).attr("data-DDindex"); //alert(DateDDIndex);
			var DateofIssue  = $("#txt_date_pg_DD_"+DateDDIndex).val(); 
			var DateofCheallan= $("#txt_challandate_pg_DD_"+DateDDIndex).val();
			if((DateofIssue != "") && (DateofCheallan != "") ){  
				var d1 = DateofCheallan.split("/");
				var d2 = DateofIssue.split("/");
				var challandate = new Date(d1[2], d1[1]-1, d1[0]); //alert(challandate);
				var emddate = new Date(d2[2], d2[1]-1, d2[0]); //alert(emddate);
				if(challandate<emddate){
					var a="DD Challan date should be greater than DD Date";
					BootstrapDialog.alert(a);
					$(this).val('');
					event.preventDefault();
					event.returnValue = false;
					//CheckVal = 1;
				}
			}
		});
		$("body").on("change", ".readatval", function(event){ 
			var DateDDIndex = $(this).attr("data-DDindex"); //alert(DateDDIndex);
			var DateofIssue  = $("#txt_challandate_pg_DD_"+DateDDIndex).val();  alert(DateofIssue);
			var DateofCheallan= $("#txt_Challanrealdate_pg_DD_"+DateDDIndex).val(); alert(DateofCheallan);
			if((DateofIssue != "") && (DateofCheallan != "") ){  
				var d1 = DateofCheallan.split("/");
				var d2 = DateofIssue.split("/");
				var challandate = new Date(d1[2], d1[1]-1, d1[0]); //alert(challandate);
				var emddate = new Date(d2[2], d2[1]-1, d2[0]); //alert(emddate);
				if(challandate<emddate){
					var a="DD Realisation date should be greater than or equal DD Challan Date";
					BootstrapDialog.alert(a);
					$(this).val('');
					event.preventDefault();
					event.returnValue = false;
					//CheckVal = 1;
				}
			}
		});

		$("body").on("click", "#emp_add", function(event){ 
			var CheckVal = 0;
			var ContName   	 = $("#cmb_bidder_0 option:selected").text(); 
			var EmdTotAmt 	 = $("#txt_full_emd_amt").val(); 
			var ContId 	     = $("#cmb_bidder_0").val(); 
			var InstType 	 = $("#cmd_instype_0").val();
			var InstNum 	 = $("#instrunum_0").val();
			var BankName   	 = $("#txt_bankname_pg_0").val();
			var BankAddress  = $("#txt_sno_pg_0").val();
			var DateofIssue  = $("#txt_date_pg_0").val(); 
			var DateofExpiry = $("#txt_expir_date_pg_0").val();
			var AmtDetail	 = $("#txt_part_amt_0").val(); //alert(AmtDetail);
			var TotalAmt     = AmtDetail; 

			// if(EmdTotAmt > TotalAmt){
			// 	       BootstrapDialog.alert("Total Amount EMD Amount is lesser than Bidder's EMD amount");
			// 		    event.preventDefault();
			// 			event.returnValue = false;
					
					//}
			// $(".EmAmt"+ContId).each(function(){
			// 	var Amt = $(this).val(); //alert(Amt);
			// 	TotalAmt =  parseFloat(TotalAmt) + parseFloat(Amt);
			// 	if(EmdTotAmt > TotalAmt){
			// 		BootstrapDialog.alert("Total Amount EMD Amount is lesser than Bidder's EMD amount");
			// 		event.preventDefault();
			// 		event.returnValue = false;
				
			// 	}
			// });
			/*if((DateofIssue != "") && (DateofExpiry != "") ){  
				var d1 = DateofExpiry.split("/");
				var d2 = DateofIssue.split("/");
				var emdexpdate = new Date(d1[2], d1[1]-1, d1[0]); //alert(emdexpdate);
				var emddate = new Date(d2[2], d2[1]-1, d2[0]); //alert(emddate);
				if(emdexpdate<emddate){ 
					//var a="EMD Expiry date  should be greater than EMD  Date";
					//BootstrapDialog.alert(a);
					event.preventDefault();
					event.returnValue = false;
					CheckVal = 1;
					//$("#txt_date_pg").val(''); 
					//$("#txt_expir_date_pg").val(''); 
				}else{
					var a="";
					CheckVal = 0;
					//$('#val_date').text(a);
				}
			}*/

		

			var RowStr = '<tr id="'+Index+'"><td><input type="hidden" name="cmd_contid[]" id="cmd_contid_'+Index+'" data-index="'+Index+'" class="tboxsmclass" readonly value="'+ContId+'"><input type="text" name="cmb_bidder[]" id="cmb_bidder_'+Index+'" data-index="'+Index+'" class="tboxsmclass" readonly value="'+ContName+'"><td><input type="text" name="cmd_instype[]" data-index="'+Index+'" id="cmd_instype_'+Index+'"  readonly class="tboxsmclass" value="'+InstType+'"></td><td><input type="text" name="instrunum[]" data-index="'+Index+'" id="instrunum_'+Index+'" readonly class="tboxsmclass" value="'+InstNum+'"></td><td><input type="text" name="txt_bankname_pg[]" data-index="'+Index+'" id="txt_bankname_pg_'+Index+'" readonly class="tboxsmclass"  value="'+BankName+'"></td><td><input type="text" readonly name="txt_sno_pg[]" data-index="'+Index+'" id="txt_sno_pg_'+Index+'" class="tboxsmclass" value="'+BankAddress+'"></td><td><input type="text" readonly name="txt_date_pg[]" data-index="'+Index+'" id="txt_date_pg_'+Index+'" class="tboxsmclass EmdDt " value="'+DateofIssue+'"></td><td><input type="text" readonly name="txt_expir_date_pg[]" data-index="'+Index+'" id="txt_expir_date_pg_'+Index+'" class="tboxsmclass ExpDt" value="'+DateofExpiry+'"></td><td><input type="number" data-index="'+Index+'" readonly onKeyPress="return isNumberWithTwoDecimal(event,this);" name="txt_part_amt[]" id="txt_part_amt_'+Index+'" class="tboxsmclass EmAmt'+ContId+'" data-id="'+ContId+'" style="text-align:right;" value="'+AmtDetail+'"></td><td align="center"><input type="button" data-index="'+Index+'" class="delete btn btn-info" name="emp_delete" id="emp_delete" value="DELETE"></td></tr>'; 

			if(InstType == 0){
				BootstrapDialog.alert("Instrument Type should not be empty");
				return false;
			}else if(InstNum == 0){
				BootstrapDialog.alert("Instrument Number should not be empty");
				return false;
			}else if(BankName == 0){
				BootstrapDialog.alert("Bank Name should not be empty");
				return false;
			}else if(BankAddress == 0){
				BootstrapDialog.alert("Bank Address should not be empty");
				return false;
			}else if(DateofIssue == 0){
				BootstrapDialog.alert("Date of Issue should not be empty");
				return false;
			}else if(DateofExpiry == 0){
				BootstrapDialog.alert("Date of Expiry should not be empty");
				return false;
			}/*else if(AmtDetail == 0){
				BootstrapDialog.alert("Amount should not be empty");
				return false;
			}*/else if(CheckVal ==  1){
				BootstrapDialog.alert("EMD Expiry date is lesser than EMD Date..Please Change..!!");
				return false;
			}else{
				$("#emdtable1").append(RowStr);
				$("#cmb_bidder_0").chosen('destroy');
				$("#cmb_bidder_0").val('');
				$("#cmb_bidder_0").chosen();
				$("#cmd_instype_0").val('');
				$("#instrunum_0").val('');
				$("#txt_bankname_pg_0").val('');
				$("#txt_sno_pg_0").val('');
				$("#txt_date_pg_0").val('');
				$("#txt_expir_date_pg_0").val('');
				$("#txt_part_amt_0").val('');
				//$("#text_totalamt").val('');
				Index++;
			}

			
		});
		$("body").on("click", ".delete", function(){
			$(this).closest("tr").remove();
			///$("#text_totalamt").val('');
			//TotalUnitAmountCalc();
			//DateValidation();
		});
		$("body").on("click", "#emp_DD_add", function(event){ 
			var CheckVal = 0;
			var ContName   	 = $("#cmb_bidder_DD_0 option:selected").text(); 
			var ContId 	     = $("#cmb_bidder_DD_0").val(); 
			//var InstType 	 = $("#cmd_instype_0").val();
			var InstNum 	 = $("#instrunum_DD_0").val();
			var BankName   	 = $("#txt_bankname_pg_DD_0").val();
			var BankAddress  = $("#txt_sno_pg_DD_0").val();
			var DateofIssue  = $("#txt_date_pg_DD_0").val(); 
			var DateofExpiry = $("#txt_expir_date_pg_DD_0").val();
			var AmtDetail	 = $("#txt_part_amt_DD_0").val();
			var ChallanNum 	 = $("#txt_challNo_pg_DD_0").val();
			var ChallanDate  = $("#txt_challandate_pg_DD_0").val(); 
			var RealisatDate = $("#txt_Challanrealdate_pg_DD_0").val();
			var DraweeBank   = $("#txt_draweebank_DD_0").val();
			var TotalAmt     = AmtDetail; 


		

			var RowStr = '<tr id="'+DDIndex+'"><td><input type="hidden" name="cmd_contid_DD[]" id="cmd_contid_DD_'+DDIndex+'" data-DDindex="'+DDIndex+'" class="tboxsmclass" readonly value="'+ContId+'"><input type="text" name="cmb_bidder_DD[]" id="cmb_bidder_DD'+DDIndex+'" data-DDindex="'+DDIndex+'" class="tboxsmclass" readonly value="'+ContName+'"></td>';
			   // RowStr +='<td><input type="text" name="cmd_instype[]" data-DDindex="'+DDIndex+'" id="cmd_instype_'+DDIndex+'"  readonly class="tboxsmclass" value="'+InstType+'"></td>';
				RowStr +='<td><input type="text" name="instrunum_DD[]" data-DDindex="'+DDIndex+'" id="instrunum_DD_'+DDIndex+'" readonly class="tboxsmclass" value="'+InstNum+'"></td>';
				RowStr +='<td><input type="text" name="txt_bankname_pg_DD[]" data-DDindex="'+DDIndex+'" id="txt_bankname_pg_DD_'+DDIndex+'" readonly class="tboxsmclass"  value="'+BankName+'"></td>';
				RowStr +='<td><input type="text" readonly name="txt_sno_pg_DD[]" data-DDindex="'+DDIndex+'" id="txt_sno_pg_DD_'+DDIndex+'" class="tboxsmclass" value="'+BankAddress+'"></td>';
				RowStr +='<td><input type="text" readonly name="txt_date_pg_DD[]" data-DDindex="'+DDIndex+'" id="txt_date_pg_DD_'+DDIndex+'" class="tboxsmclass EmdDt" value="'+DateofIssue+'"></td>';
				RowStr +='<td><input type="text" readonly name="txt_expir_date_pg_DD[]" data-DDindex="'+DDIndex+'" id="txt_expir_date_pg_DD_'+DDIndex+'" class="tboxsmclass ExpDt ValDate" value="'+DateofExpiry+'"></td>';
				RowStr +='<td><input type="number" data-DDindex="'+DDIndex+'" readonly onKeyPress="return isNumberWithTwoDecimal(event,this);" name="txt_part_amt_DD[]" id="txt_part_amt_DD_'+DDIndex+'" class="tboxsmclass EmdAmt'+ContId+'" data-id="'+ContId+'" style="text-align:right;" value="'+AmtDetail+'"></td>';
				RowStr +='<td><input type="text" data-DDindex="'+DDIndex+'" readonly  name="txt_challNo_pg_DD[]" id="txt_challNo_pg_DD_'+DDIndex+'" class="tboxsmclass" data-id="'+ContId+'" style="text-align:right;" value="'+ChallanNum+'"></td>';
				RowStr +='<td><input type="text" readonly name="txt_challandate_pg_DD[]" data-DDindex="'+DDIndex+'" id="txt_challandate_pg_DD_'+DDIndex+'" class="tboxsmclass EmdDDt ValDDDate" value="'+ChallanDate+'"></td>';
				RowStr +='<td><input type="text" readonly name="txt_Challanrealdate_pg_DD[]" data-DDindex="'+DDIndex+'" id="txt_Challanrealdate_pg_DD_'+DDIndex+'" class="tboxsmclass expdate ExpDDt ValDDDate" value="'+RealisatDate+'"></td>';
				RowStr +='<td><input type="text" data-DDindex="'+DDIndex+'" readonly  name="txt_draweebank_DD[]" id="txt_draweebank_DD_'+DDIndex+'" class="tboxsmclass" data-id="'+ContId+'" style="text-align:right;" value="'+DraweeBank+'"></td>';
				RowStr +='<td align="center"><input type="button" data-DDindex="'+DDIndex+'" class="DDdelete btn btn-info" name="emp_DD_delete" id="emp_DD_delete" value="DELETE"></td></tr>'; 

			// if(InstType == 0){
			// 	BootstrapDialog.alert("Instrument Type should not be empty");
			// 	return false;
			// }else
			 if(InstNum == 0){
				BootstrapDialog.alert("DD Number should not be empty");
				return false;
			}else if(BankName == 0){
				BootstrapDialog.alert("Bank Name should not be empty");
				return false;
			}else if(BankAddress == 0){
				BootstrapDialog.alert("Bank Address should not be empty");
				return false;
			}else if(DateofIssue == 0){
				BootstrapDialog.alert("Date of Issue should not be empty");
				return false;
			}else if(DateofExpiry == 0){
				BootstrapDialog.alert("Date of Expiry should not be empty");
				return false;
			}else if(AmtDetail == 0){
				BootstrapDialog.alert("Amount should not be empty");
				return false;
			}else if(ChallanNum == 0){
				BootstrapDialog.alert("Amount should not be empty");
				return false;
			}else if(ChallanDate == 0){
				BootstrapDialog.alert("Amount should not be empty");
				return false;
			// }else if(DraweeBank == 0){
			// 	BootstrapDialog.alert("Amount should not be empty");
			// 	return false;
			}else{
				$("#emdtable2").append(RowStr);
				$("#cmb_bidder_DD_0").chosen('destroy');
				$("#cmb_bidder_DD_0").val('');
				$("#cmb_bidder_DD_0").chosen();
				$("#cmd_instype_DD_0").val('');
				$("#instrunum_DD_0").val('');
				$("#txt_bankname_pg_DD_0").val('');
				$("#txt_sno_pg_DD_0").val('');
				$("#txt_date_pg_DD_0").val('');
				$("#txt_expir_date_pg_DD_0").val('');
				$("#txt_part_amt_DD_0").val('');
				$("#txt_challNo_pg_DD_0").val('');
				$("#txt_challandate_pg_DD_0").val('');
				$("#txt_Challanrealdate_pg_DD_0").val('');
				$("#txt_draweebank_DD_0").val('');
				//$("#text_totalamt").val('');
				DDIndex++;
			}

			
		});
		$("body").on("click", ".DDdelete", function(){
			$(this).closest("tr").remove();
			///$("#text_totalamt").val('');
			//TotalUnitAmountCalc();
			//DateValidation();
		});
		function TotalUnitAmountCalc(){
			var TotalAmt = 0; 
			$(".Amt").each(function(){
				var Amt = $(this).val(); 
				//TotalAmt = parseFloat(TotalAmt) + parseFloat(Amt);
				//$("#text_totalamt").val(TotalAmt);
			
			});
		}
		$('#cmb_tr_no').chosen();
		$("body").on("click","#submit", function(event){ 
			var TotalAmt =0;

			if(KillEvent == 0){
				var partamt1 =       $("#txt_part_amt").val();
				var ShortName 	  = $("#cmb_tnder_no").val(); 
				var WorkName 	  = $("#txt_work_name").val();
				//var EnginnerName 	= $("#cmb_engineer").val();
				//var BidderName 	  = $("#cmb_bidder").val();
				var EmdAmount 	  = $("#txt_full_emd_amt").val();
				var EmdContractor = $("#instrunum").val(); 
				var rowCount      = $('#emdtable1 tr').length; 
				var AllCont = [];
				var DDCont = [];

				$("input[name='cmd_contid[]']").each(function(){  
					AllCont.push($(this).val());
				});
				// $("input[name='cmd_contid_DD[]']").each(function(){
				// 	DDCont.push($(this).val());
				// });
				var ContArr = Array.from(new Set(AllCont)); 
				//var ContDDArr = Array.from(new Set(DDCont));
				var ContErr = 0; var ErrContName = "";
				for (var i = 0; i < ContArr.length; i++) {
					var ContEmdTotAmt = 0;
					var EmdContId = ContArr[i];
					//var DDContId = ContDDArr[i];
					$(".EmAmt"+EmdContId).each(function(){
						var EmdAmt = $(this).val();  
						ContEmdTotAmt = parseFloat(ContEmdTotAmt) + parseFloat(EmdAmt); 
					});
					// $(".DDAmt"+DDContId).each(function(){
					// 	var DDAmt = $(this).val(); 
					// 	ContDDTotAmt = parseFloat(ContEmdTotAmt) + parseFloat(DDAmt); 
					// });
					//var contamt = ContEmdTotAmt + ContDDTotAmt; // alert(contamt);
					if(parseFloat(contamt) < parseFloat(EmdAmount)){ 
						ErrContName = $("#cmb_bidder_0 option[value='"+EmdContId+"']").text(); 
						ContErr = 1;
					}
					//console.log(parseFloat(ContEmdTotAmt));
					//console.log(parseFloat(EmdAmount));
				}
				// for (var i = 0; i < ContArr.length; i++) {
				// 	var ContEmdTotAmt = 0;
				// 	var EmdContId = ContArr[i];
				// 	var DDContId = ContDDArr[i];
				// 	$(".EmAmt"+EmdContId).each(function(){
				// 		var EmdAmt = $(this).val();  
				// 		ContEmdTotAmt = parseFloat(ContEmdTotAmt) + parseFloat(EmdAmt); 
				// 	});
				// 	$(".DDAmt"+DDContId).each(function(){
				// 		var DDAmt = $(this).val(); 
				// 		ContDDTotAmt = parseFloat(ContEmdTotAmt) + parseFloat(DDAmt); 
				// 	});
				// 	var contamt = ContEmdTotAmt + ContDDTotAmt;  alert(contamt);
				// 	if(parseFloat(contamt) < parseFloat(EmdAmount)){ 
				// 		ErrContName = $("#cmb_bidder_0 option[value='"+EmdContId+"']").text(); 
				// 		ContErr = 1;
				// 	}
				// 	//console.log(parseFloat(ContEmdTotAmt));
				// 	//console.log(parseFloat(EmdAmount));
				// }
				

				if(ShortName == ""){
					BootstrapDialog.alert("Please select Tender Number..!!");
					event.preventDefault();
					event.returnValue = false;
				}else if(WorkName == ""){
					BootstrapDialog.alert("Please Enter Name of work..!!");
					event.preventDefault();
					event.returnValue = false;

				}else if(rowCount <= 2 ) {
					BootstrapDialog.alert(" Please Add Atleast One EMD Detail..!!");
					event.preventDefault();
					event.returnValue = false;
				}else if(ContErr == 1){
					BootstrapDialog.alert(" Total EMD Amount should be greater than or equal to "+EmdAmount+" for the bidder "+ErrContName);
					event.preventDefault();
					event.returnValue = false;
				}else{
					event.preventDefault();
					BootstrapDialog.confirm({
						title: 'Confirmation Message',
						message: 'Are you sure want to save this EMD Detail ?',
						closable: false, // <-- Default value is false
						draggable: false, // <-- Default value is false
						btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
						btnOKLabel: 'Ok', // <-- Default value is 'OK',
						callback: function(result) {
							if(result){
								KillEvent = 1;
								$("#submit").trigger( "click" );
							}else {
								KillEvent = 0;
							}
						}
					});
				}
			}
		});
		$('body').on("change",".ddselapp", function(e){ 
		var checkval = $('input[name="gstapplicable"]:checked').val();
		if(checkval == 'Y'){
			$(".gstapplicab").show();
		}else if(checkval == 'N'){
			$(".gstapplicab").hide();
		}
	});
	
});
</script>
<style>
	.chosen-container .chosen-results{
		max-height:150px !important;
	}
</style>
@endsection


