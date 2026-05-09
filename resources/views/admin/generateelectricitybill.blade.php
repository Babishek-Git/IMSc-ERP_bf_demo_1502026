@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
 	if(isset($data2)){
		foreach($data2 as $sdata){
			$WorkId = $sdata->sheetid;
			$WorkName = $sdata->work_name;
			$WorkNo = $sdata->work_order_no;
		}
	}
	if(isset($data4)){
			$RBN = $data4;
	}
	if(isset($data5)){
		foreach($data5 as $Mdata){
			$MeterNo= $Mdata->meter_no;
		}
	}
	if(isset($data6)){
			$EbillNo = $data6;
	}
@endphp
    <!-- <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload=""> -->
<form action="{{ route('admin.generateelectricitybillsave') }}" method="post" enctype="multipart/form-data" name="form">





	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1" style="overflow:auto">
					<div class="container">
						<div class="row ">
							<div class="div1">&nbsp;</div>
							<div class="div10 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> Generate - Electricity Bill </div></div></div>
								<div class="card-body padding-1 ChartCard" id="CourseChart">
									<div class="divrowbox innerdiv pt-2">




										<input type="hidden" name="hid_sheetid" id="hid_sheetid" value="">
										<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="color1">
											<tr><td width="24%">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
											<tr>
												<td>&nbsp;</td>
												<td class="label">Work Short Name</td> 
												<td class="labeldisplay">
													<select name="cmb_work_sname" id="cmb_work_sname" class="textboxdisplay" style="width:465px" onChange="">
														<option value="">------------- Select Work Short Name --------------</option>
															@if(isset($data1))
																@foreach($data1 as $Pin)
																		@php
																		if((isset($WorkId))&&($WorkId== $Pin->sheetid)){
																			$SelStr = 'selected="selected"';
																		}else{
																			$SelStr = '';
																		}
																		@endphp
																		<option value="{{ $Pin->sheetid }}" {{ $SelStr }}> {{ $Pin->short_name }} </option>
																@endforeach
															@endif
													</select>
												</td>
											</tr>
											<tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_shortname" style="color:red" colspan="">&nbsp;</td></tr>
											<tr>
												<td>&nbsp;</td>
												<td class="label">Name of Work</td>
												<td><textarea name='txt_workname' id='txt_workname' class="textboxdisplay" readonly="readonly" rows="6" style="width: 465px;">@if(isset($WorkName)) {{ $WorkName }} @endif</textarea></td>
											</tr>
											<tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_wname" style="color:red" colspan="">&nbsp;</td></tr>
											<tr>
												<td>&nbsp;</td>
												<td class="label">Work Order No.</td>
												<td><input type="text" name='txt_workorder' id='txt_workorder' class="textboxdisplay" readonly="" value="@if(isset($WorkNo)) {{ $WorkNo }} @endif" style="width: 465px;"></td>
											</tr>
											<tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_workorder" style="color:red" colspan="" value="">&nbsp;</td></tr>
											<tr>
												<td>&nbsp;</td>
												<td class="label">RAB No.</td>
												<td>
													<input type="text" name='txt_rbn' id='txt_rbn' class="textboxdisplay" readonly=""  value="@if(isset($RBN)) {{ $RBN }} @endif" style="width: 120px;">
													<input type="hidden" name='hid_rbn' id='hid_rbn' class="textboxdisplay"  value="@if(isset($RBN)) {{ $RBN }} @endif" readonly="" style="width: 120px;">
													<label class="label">
													&emsp;&emsp;&emsp;
													Electricity Bill No.
													&emsp;&emsp;&emsp;
													</label>
													<input type="text" name='txt_ebill_no' id='txt_ebill_no' class="textboxdisplay" value="@if(isset($EbillNo)) {{ $EbillNo }} @endif" style="width: 120px;">
												</td>
											</tr>
											<tr>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td align="center" class="labeldisplay" colspan="">
													<div class="labeldisplay" style="width:345px;float:left;color:red;" id="val_rbn">&nbsp;</div>
													<div class="labeldisplay" style="float:right;color:red; width:380px;" id="val_ebill_no"></div>
												</td>
											</tr>
											<tr>
												<td colspan="3" align="center">
													<div class="row divhead" style="width:89%; color:white;" align="center">Meter Details</div>
													<div clss="" style="width:90%; height:auto;" align="center">
														<table width="100%" class="table1 mbtable" id="table1">
															<tr class="label" style="background-color:#EAEAEA">
																<td align="center">Meter No.</td>
																<td align="center">IMR</td>
																<td align="center">IMR Date</td>
																<td align="center">FMR</td>
																<td align="center">FMR Date</td>
																<td align="center">Rate/unit <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i></td>
																<td align="center">Meter Rent <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i></td>
																<td align="center">Unit </td>
																<td align="center">Factor </td>
																<td align="center">Amount <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i></td>
																<td align="center" colspan="2">Action</td>
															</tr>
															<tr>
																<td align="center" style="vertical-align:middle">
																	<select name="cmb_meter_no_0" id="cmb_meter_no_0" class="extraItemTextbox" style="text-align:center; width:80px;" onChange="meter_details();ClearOldData();">
																		<option value="">-Select-</option>
																		@if(isset($data5))
																		@foreach($data5 as $Meter)
																			@php
																			if((isset($MeterNo))&&($MeterNo== $Meter->wid)){
																				$SelStr = 'selected="selected"';
																			}else{
																				$SelStr = '';
																			}
																			@endphp
																			<option value="{{ $Meter->wid }}"data-imr="{{$Meter->imr }}"data-imr_date="{{ $Meter->imr_date }}"data-rate="{{ $Meter->rate }}"data-meter_rent="{{ $Meter->meter_rent }}"data-factor="{{ $Meter->factor }}" {{ $SelStr }}> {{ $Meter->meter_no }} </option>

																		@endforeach
																	@endif
																</select>
																	<input type="hidden" name="cmb_meterhidden_0" class="textbox-new" value="">
																</td>
																<td align="center"><input type="text" class="extraItemTextbox" name="txt_imr_0" id="txt_imr_0"  style="text-align:center" onBlur="change();"></td>
																<td align="center"><input type="text" class="extraItemTextbox" name="txt_imr_date_0" id="txt_imr_date_0"  style="background-color:#D7D2D5; text-align:center" readonly=""></td>
																<td align="center"><input type="text" class="extraItemTextbox" name="txt_fmr_0" id="txt_fmr_0" onBlur="change();"></td>
																<td align="center"><input type="text" class="extraItemTextbox" name="txt_fmr_date_0" id="txt_fmr_date_0" placeholder="dd-mm-yyyy"></td>
																<td align="center"><input type="text" class="extraItemTextbox" name="txt_rate_unit_0" id="txt_rate_unit_0" style="background-color:#D7D2D5; text-align:center" readonly=""></td>
																<td align="center"><input type="text" class="extraItemTextbox" name="txt_rent_0" id="txt_rent_0" style="background-color:#D7D2D5; text-align:center" readonly=""></td>
																<td align="center"><input type="text" class="extraItemTextbox" name="txt_unit_0" id="txt_unit_0" style="background-color:#D7D2D5; text-align:center" readonly=""></td>
																<td align="center"><input type="text" class="extraItemTextbox" name="txt_factor_0" id="txt_factor_0" style="background-color:#D7D2D5; text-align:center" readonly=""></td>
																<td align="center"><input type="text" class="extraItemTextbox" name="txt_amount_0" id="txt_amount_0" readonly="" style="background-color:#D7D2D5; text-align:center"></td>
																<td align="center" colspan="2" valign="middle"><input type="button" class="buttonstyle" name="btn_add" id="btn_add" value="Add" onClick="total_unit_amount_consumption()"></td>
															</tr>
															
															@php
															$Totalamt = 0;
															$Totalunit = 0;
															@endphp
															@if(isset($data3))
															@foreach($data3 as $EbDisplay)
															<tr>
																@php
																$Totalamt=$Totalamt+$EbDisplay->electricity_cost;
																$Totalunit=$Totalunit+$EbDisplay->unit_consum;
																@endphp
																<td align="center" style="vertical-align:middle">
																	<input type='text' name="cmb_meter_no[]" id="cmb_meter_no[]" class="extraItemTextbox" style="text-align:center; width:80px;" value="{{ $EbDisplay->meter_no }}" readonly="">   
																	<input type="hidden" name="cmb_meter_hidden_no[]" class="textbox-new" value="@if(isset($EbDisplay->wid)){{ $EbDisplay->wid }}@endif">
																</td>
																<td align="center"><input type="text" class="extraItemTextbox" name="txt_imr[]" id="txt_imr"value="{{ $EbDisplay->imr }}" style="text-align:center"  style="text-align:center" onBlur="change();"></td>
																<td align="center"><input type="text" class="extraItemTextbox" name="txt_imr_date[]" id="txt_imr_date" value="{{ $EbDisplay->imr_date }}" style="text-align:center"  style="background-color:#D7D2D5; text-align:center" readonly=""></td>
																<td align="center"><input type="text" class="extraItemTextbox" name="txt_fmr[]" id="txt_fmr" value="{{ $EbDisplay->fmr }}" style="text-align:center" onBlur="change();"></td>
																<td align="center"><input type="text" class="extraItemTextbox" name="txt_fmr_date[]" id="txt_fmr_date"value="{{ $EbDisplay->fmr_date }}" style="text-align:center" placeholder="dd-mm-yyyy"></td>
																<td align="center"><input type="text" class="extraItemTextbox" name="txt_rate_unit[]" id="txt_rate_unit"value="{{ $EbDisplay->rate }}" style="text-align:center" style="background-color:#D7D2D5; text-align:center" readonly=""></td>
																<td align="center"><input type="text" class="extraItemTextbox" name="txt_rent[]" id="txt_rent"value="{{ $EbDisplay->meter_rent }}" style="text-align:center"style="background-color:#D7D2D5; text-align:center" readonly=""></td>
																<td align="center"><input type="text" class="extraItemTextbox EmUnit" name="txt_unit[]" id="txt_unit"value="{{ $EbDisplay->unit_consum}}" style="text-align:center" style="background-color:#D7D2D5; text-align:center" readonly=""></td>
																<td align="center"><input type="text" class="extraItemTextbox" name="txt_factor[]" id="txt_factor"value="{{ $EbDisplay->factor }}" style="text-align:center" style="background-color:#D7D2D5; text-align:center" readonly=""></td>
																<td align="center"><input type="text" class="extraItemTextbox EmAmt" name="txt_amount[]" id="txt_amount"value="{{ $EbDisplay->electricity_cost }}" style="text-align:center" readonly="" style="background-color:#D7D2D5; text-align:center"></td>
																<td align="center" colspan="2" valign="middle"><input type="button" class="backbutton delete" name="btn_delete" id="btn_delete" value="Delete" onClick="total_unit_amount_consumption()"></td>
															</tr>
															@endforeach
															@endif
														</table>
													</div>
													<div class="div1"></div>
												</td>
											</tr>
											<tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_electricity_row" style="color:red" colspan="">&nbsp;</td></tr>
											<tr>
												<!--<td>&nbsp;</td>-->
												<td class="label" colspan="2" align="right">Total Unit consumption&emsp;&emsp;</td>
												<td>
													<input type="text" name='txt_electricity_unit' readonly="" id='txt_electricity_unit' class="textboxdisplay" value="@if(isset($Totalunit)){{ $Totalunit }}@endif" style="width: 120px;">
												</td>
											</tr>
											<tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_electricity_cost" style="color:red" colspan="">&nbsp;</td></tr>
											<tr>
												<!--<td>&nbsp;</td>-->
												<td class="label" colspan="2" align="right">Total Amount <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i>&emsp;&emsp;</td>
												<td>
													<input type="text" name='txt_electricity_cost' readonly="" id='txt_electricity_cost' class="textboxdisplay" value="@if(isset($Totalamt)){{ $Totalamt }}@endif" style="width: 120px;">
												</td>
											</tr>
											<tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_electricity_cost" style="color:red" colspan="">&nbsp;</td></tr>
										</table>
										



									</div>
									<div class="row">
										<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
											<div class="buttonsection">
												<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
											</div>
											<div class="buttonsection">
												<input type="submit" name="submit" id="submit" value=" Submit " />
												<input type="hidden" name='wid' id='wid' class="textboxdisplay"  value="@if(isset($WId)){{ $WId }}@endif" size="40" >
												<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="div1">&nbsp;</div>
						</div>
					</div>
				</blockquote>
			</div>
		</div>
	</div>
</form>
	<script>
		
		$('#cmb_work_sname').chosen();
		$('#cmb_work_sname').change(function() {
			var work = $(this).val(); 
			$("#txt_workorder").val('');
			$("#txt_workname").val('');
			$("#txt_rbn").val('');
			$.ajax({
				type:'GET',
				url:"{{ route('posts.getwork') }}",
				data:{'work':work},
				success:function(data){ 
					if(data){ 
						$.each(data, function(key, value) { 
							$("#txt_workorder").val(value.work_order_no);
							$("#txt_workname").val(value.work_name);
						});
					}
				}
			});
		});
		$('#cmb_work_sname').change(function() { 
			var work = $(this).val(); 
			$.ajax({
				type:'GET',
				url:"{{ route('ajax.Rab') }}",
				data:{'work':work},
				success:function(data){ //alert(data);
					if(data){ 
						$.each(data, function(key, value) { 
							$("#txt_rbn").val(value.rbn);
						});
					}
				}
			});
		});
		$('#cmb_work_sname').change(function() { 
			var work = $(this).val(); 
			$.ajax({
				type:'GET',
				url:"{{ route('ajax.Meter') }}",
				data:{'work':work },
				success:function(data){ //alert(data);
					if(data){ 
						$.each(data, function(index, element) { //data- is the inbuilt syntax like date should not change it. data-imr_date="'+element.imr_date+'"(name from database table)
							$("#cmb_meter_no_0").append('<option value="'+element.erecoverid+'" data-imr="'+element.imr+'" data-imr_date="'+element.imr_date+'" data-rate="'+element.rate+'" data-meter_rent="'+element.meter_rent+'" data-factor="'+element.factor+'">'+element.meter_no+'</option>');
					    });
					}
				}
			});
		});

		$('body').on("change","#cmb_meter_no_0", function(event){
			var Imr       = $('#cmb_meter_no_0 option:selected').attr('data-imr');
			var ImrDate   = $('#cmb_meter_no_0 option:selected').attr('data-imr_date');
			var Rate      = $('#cmb_meter_no_0 option:selected').attr('data-rate');
			var Rent      = $('#cmb_meter_no_0 option:selected').attr('data-meter_rent');
			var Factor    = $('#cmb_meter_no_0 option:selected').attr('data-factor');
			$("#txt_imr_0").val(Imr);
			$("#txt_imr_date_0").val(ImrDate);
			$("#txt_rate_unit_0").val(Rate);
			$("#txt_rent_0").val(Rent);
			$("#txt_factor_0").val(Factor);

		});
		$('body').on("change","#txt_fmr_0", function(event){
			var meter_no = $(this).val();
			//var meter_no = Number(document.form.cmb_meter_no.value);
			//if(meter_no != "")
			//{
				var imr 	=Number($('#txt_imr_0').val());
				var fmr 	=Number($('#txt_fmr_0').val());
				if(fmr != "")
				{
					if(fmr>imr)
					{
						var unitrate 	= Number($('#txt_rate_unit_0').val());
						var meterrent 	= Number($('#txt_rent_0').val());
						var factor 		= Number($('#txt_factor_0').val());
						var usedunit 	= Number(fmr)-Number(imr);
						//alert(usedunit);
						var usedamount 	= (Number(unitrate)*Number(usedunit)*Number(factor))+Number(meterrent);
						//alert(usedamount);
						//var used_unit 	= Number(fmr)-Number(imr);
						$('#txt_amount_0').val(usedamount); 
						$('#txt_unit_0').val(usedunit);
						//	= usedamount.toFixed(2);
						//$('#txt_unit_0').val() 	= usedunit.toFixed(2);
					}
					else
					{
						swal("FMR should be greater than IMR", "", "");
						event.preventDefault();
						event.returnValue = false;
					}
				}
		});
		$("body").on("click", "#btn_add", function(event) {
			var MeterNo	 = $("#cmb_meter_no_0 option:selected").text();
			var Meter   = $("#cmb_meterhidden_0").val();
			var Imr = $("#txt_imr_0").val();
			var ImrDate = $("#txt_imr_date_0").val();
			var Fmr = $("#txt_fmr_0").val();
			var FmrDate = $("#txt_fmr_date_0").val();
			var RateUnit = $("#txt_rate_unit_0").val();
			var Rent = $("#txt_rent_0").val();
			var Unit = $("#txt_unit_0").val();
			var Factor = $("#txt_factor_0").val();
			var Amt = $("#txt_amount_0").val();
			var RowStr = '<tr><td><input type="hidden" name="cmb_meterhidden_0[]" class="extraItemTextbox" value="'+Meter+'"><input type="text" name="cmb_meter_no[]"class="extraItemTextbox" value="'+MeterNo+'"></td><td align="center"><input type="text" class="extraItemTextbox" name="txt_imr[]" id="txt_imr_0"  style="text-align:center" onBlur="change();" value="'+Imr+'"></td><td align="center"><input type="text" class="extraItemTextbox" name="txt_imr_date[]" id="txt_imr_date[]"  style="background-color:#D7D2D5; text-align:center" readonly="" value="'+ImrDate+'"></td><td align="center"><input type="text" class="extraItemTextbox" name="txt_fmr[]" id="txt_fmr[]" onBlur="change();"value="'+Fmr+'"></td><td align="center"><input type="text" class="extraItemTextbox" name="txt_fmr_date[]" id="txt_fmr_date[]" placeholder="dd-mm-yyyy" value="'+FmrDate+'"></td><td align="center"><input type="text" class="extraItemTextbox" name="txt_rate_unit[]" id="txt_rate_unit[]" style="background-color:#D7D2D5; text-align:center" readonly="" value="'+RateUnit+'"></td><td align="center"><input type="text" class="extraItemTextbox" name="txt_rent[]" id="txt_rent[]" style="background-color:#D7D2D5; text-align:center" readonly="" value="'+Rent+'"></td><td align="center"><input type="text" class="extraItemTextbox EmUnit" name="txt_unit[]" id="txt_unit[]" style="background-color:#D7D2D5; text-align:center" readonly="" value="'+Unit+'"></td><td align="center"><input type="text" class="extraItemTextbox" name="txt_factor[]" id="txt_factor[]" style="background-color:#D7D2D5; text-align:center" readonly="" value="'+Factor+'"></td><td align="center"><input type="text" class="extraItemTextbox EmAmt" name="txt_amount[]" id="txt_amount[]" readonly="" style="background-color:#D7D2D5; text-align:center" value="'+Amt+'"></td><td align="center" colspan="2" valign="middle"><input type="button" class="backbutton delete" name="btn_delete" id="btn_delete" value="Delete"></td></tr>';
		    if(Meter == 0){
				BootstrapDialog.alert("Name should not be empty");
				return false;
			}else if(Fmr ==""){
				BootstrapDialog.alert("Please enter Fmr");
				event.preventDefault();
				return false;
			}else if(FmrDate ==""){
				BootstrapDialog.alert("Please enter Fmr Date");
				event.preventDefault();
				return false;
			}else{
				$("#table1").append(RowStr);
				$("#cmb_meter_no_0").val('');
				$("#cmb_meterhidden_0").val('');
				$("#txt_imr_0").val('');
				$("#txt_imr_date_0").val('');
				$("#txt_fmr_0").val('');
				$("#txt_fmr_date_0").val('');
				$("#txt_rate_unit_0").val('');
				$("#txt_rent_0").val('');
				$("#txt_unit_0").val('');
				$("#txt_factor_0").val('');
				$("#txt_amount_0").val('');
			}
			TotalUnitAmountCalc();
		});

		$("body").on("click", ".delete", function() { 	
			$(this).closest("tr").remove();
			TotalUnitAmountCalc();
    	});
		function TotalUnitAmountCalc(){
			var TotalAmt = 0;
			var TotalUnit = 0;
			$(".EmAmt").each(function(){
				var Amt = $(this).val();
				TotalAmt = parseFloat(TotalAmt) + parseFloat(Amt);
				$("#txt_electricity_cost").val(TotalAmt);
			});
			$(".EmUnit").each(function(){
				var Unit = $(this).val();
				TotalUnit = parseFloat(TotalUnit) + parseFloat(Unit);
				$("#txt_electricity_unit").val(TotalUnit);
			});
		}
	</script>

@endsection
            