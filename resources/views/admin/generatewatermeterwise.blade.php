@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php
 	if(isset($data2)){
		foreach($data2 as $sdata){
			$WId = $sdata->wid;
			$WorkId = $sdata->sheetid;
			$WorkName = $sdata->work_name;
			$WorkNo = $sdata->work_order_no;
			$Watbillno = $sdata->wbill_no;
		}
	}
	if(isset($data4)){
		$Rab = $data4;
	}
	if(isset($data5)){
		foreach($data5 as $kdata){
			$MeterNum = $kdata->wid;
		}
	}
	if(isset($data6)){
		$WaterBillNo = $data6;
	}
@endphp

<form action="{{ route('admin.generatewatermeterwisesave') }}" method="post" enctype="multipart/form-data" name="form">





	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1" style="overflow:auto">
					<div class="container">
						<div class="row ">
							<div class="div1">&nbsp;</div>
							<div class="div10 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> Generate - Water Meter Wise </div></div></div>
								<div class="card-body padding-1 ChartCard" id="CourseChart">
									<div class="divrowbox innerdiv pt-2">
										<input type="hidden" name="hid_sheetid" id="hid_sheetid" value="">








										<div class="row">
											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div3 label">	
													Work Short Name
												</div> 
												<div class="div9">
													<select name="cmb_work_sname" id="cmb_work_sname" class="textboxdisplay" style="width:465px">
														<option value="">------------- Select Work Short Name --------------</option>
														@if(isset($data1))
															@foreach($data1 as $Pin)
																@php
																if((isset($WorkId))&&($WorkId == $Pin->sheetid)){
																	$SelStr = 'selected="selected"';
																}else{
																	$SelStr = '';
																}
																@endphp
																<option value="{{ $Pin->sheetid }}" {{ $SelStr }}> {{ $Pin->short_name }} </option>
															@endforeach
														@endif
													</select>
												</div>
											</div>
											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div3 label">
													Name of Work
												</div>
												<div class="div9">
													<textarea name='txt_workname' id='txt_workname' class="textboxdisplay" readonly="readonly" rows="6" style="width: 465px;">@if(isset($WorkName)) {{ $WorkName }} @endif</textarea>
												</div>
											</div>	
											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div3 label">
													Work Order No.
												</div>
												<div class="div9">
													<input type="text" name='txt_workorder' id='txt_workorder' class="textboxdisplay"  readonly="" value="@if(isset($WorkName)) {{ $WorkName }} @endif" style="width: 465px;">
												</div>
											</div>
											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div3 label">
													RAB No.
												</div>
												<div class="div9">
													<input type="text" name='txt_rbn' id='txt_rbn' class="textboxdisplay"  value="@if(isset($Rab)) {{ $Rab }} @endif" readonly="" style="width: 120px;">
													<label class="label">
													&emsp;&emsp;&emsp;
													Water Bill No.
													&emsp;&emsp;&emsp;
													</label>
													<input type="text" name='txt_ebill_no' id='txt_ebill_no' class="textboxdisplay" value="@if(isset($WaterBillNo)) {{ $WaterBillNo }}@endif" style="width: 120px;">
											
													<input type="hidden" name='hid_rbn' id='hid_rbn' class="textboxdisplay"  value="@if(isset($Rab)) {{ $Rab }} @endif" readonly="" style="width: 120px;">
												</div>
											</div>
											<div class="row smclearrow">&nbsp;</div>

											<div class="row">
												<div class="row divhead" style="width:99%; color:white;" align="center">Meter Details</div>
												<div style="width:100%; height:auto;" align="center">
												
													<table width="100%" class="table1" id="table1">
														<tr class="label" style="background-color:#EAEAEA">
															<td align="center">Meter No.</td>
															<td align="center">IMR</td>
															<td align="center">IMR Date</td>
															<td align="center">FMR</td>
															<td align="center">FMR Date</td>
															<td align="center">Rate/litre <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i></td>
															<td align="center">Meter Rent <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i></td>
															<td align="center">Unit </td>
															<td align="center">Factor </td>
															<td align="center">Amount <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i></td>
															<td align="center" colspan="2">Action</td>
														</tr>
														<tr>
															<td align="center" style="vertical-align:middle">
																<select name="cmb_meter_no_0" id="cmb_meter_no_0" class="extraItemTextbox" style="text-align:center;">
																	<option value="">-Select-</option> 
																	@if(isset($data5))
																	@foreach($data5 as $Metnum)
																		@php
																		if((isset($MeterNum))&&($MeterNum == $Metnum->sheetid)){
																			$SelStr = 'selected="selected"';
																		}else{
																			$SelStr = '';
																		}
																		@endphp
																	<option value="{{ $Metnum->wid }}" data-imr="{{ $Metnum->imr }}" data-imr_date="{{ $Metnum->imr_date }}" data-rate="{{ $Metnum->rate }}" data-meter_rent="{{ $Metnum->meter_rent }}" data-factor="{{ $Metnum->factor }}" {{ $SelStr }}> {{ $Metnum->meter_no }} </option>
																	@endforeach
																	@endif  
																</select>
																<input type="hidden" name="cmb_meter_hidden_no_0" class="textbox-new" value="">
															</td>
															<td align="center"><input type="text" class="extraItemTextbox" name="txt_imr_0" id="txt_imr_0"  style="text-align:center" onBlur="calculateEBamount();"></td>
															<td align="center"><input type="text" class="extraItemTextbox" name="txt_imr_date_0" id="txt_imr_date_0"  style="background-color:#D7D2D5; text-align:center" readonly=""></td>
															<td align="center"><input type="text" class="extraItemTextbox" name="txt_fmr_0" id="txt_fmr_0" onBlur="calculateEBamount();"></td>
															<td align="center"><input type="text" class="extraItemTextbox" name="txt_fmr_date_0" id="txt_fmr_date_0" placeholder="dd-mm-yyyy"></td>
															<td align="center"><input type="text" class="extraItemTextbox" name="txt_rate_unit_0" id="txt_rate_unit_0" style="background-color:#D7D2D5; text-align:center" readonly=""></td>
															<td align="center"><input type="text" class="extraItemTextbox" name="txt_rent_0" id="txt_rent_0" style="background-color:#D7D2D5; text-align:center" readonly=""></td>
															<td align="center"><input type="text" class="extraItemTextbox" name="txt_unit_0" id="txt_unit_0" style="background-color:#D7D2D5; text-align:center" readonly=""></td>
															<td align="center"><input type="text" class="extraItemTextbox" name="txt_factor_0" id="txt_factor_0" style="background-color:#D7D2D5; text-align:center" readonly=""></td>
															<td align="center"><input type="text" class="extraItemTextbox" name="txt_amount_0" id="txt_amount_0" readonly="" style="background-color:#D7D2D5; text-align:center"></td>
															<td align="center" colspan="2" valign="middle"><input type="button" class="buttonstyle" name="btn_add" id="btn_add" value="Add" onClick="addrow();total_unit_amount_consumption();"></td>
														</tr>

														@if(isset($data3))
														@foreach($data3 as $WaterDisplay)
														<tr>
															<td align="center" style="vertical-align: middle">
																<input type="text" name="cmb_meter_no[]" id="cmb_meter_no" value="{{ $WaterDisplay->meter_no }}" class="extraItemTextbox" style="text-align:center;" readonly=""> 	
																<input type="hidden" name="cmb_meter_hidden_no[]" class="textbox-new" value="@if(isset($WaterDisplay->wid)){{ $WaterDisplay->wid }}@endif">
															</td>
															<td align="center"><input type="text" class="extraItemTextbox" name="txt_imr[]" id="txt_imr" value="{{ $WaterDisplay->imr }}" style="text-align:center" onBlur="calculateEBamount();"></td>
															<td align="center"><input type="text" class="extraItemTextbox" name="txt_imr_date[]" id="txt_imr_date" value="{{ $WaterDisplay->imr_date }}" style="background-color:#D7D2D5; text-align:center" readonly=""></td>
															<td align="center"><input type="text" class="extraItemTextbox" name="txt_fmr[]" id="txt_fmr" value="{{ $WaterDisplay->fmr }}" onBlur="calculateEBamount();"></td>
															<td align="center"><input type="text" class="extraItemTextbox" name="txt_fmr_date[]" id="txt_fmr_date" value="{{ $WaterDisplay->fmr_date }}" placeholder="dd-mm-yyyy"></td>
															<td align="center"><input type="text" class="extraItemTextbox" name="txt_rate_unit[]" id="txt_rate_unit" value="{{ $WaterDisplay->rate }}" style="background-color:#D7D2D5; text-align:center" readonly=""></td>
															<td align="center"><input type="text" class="extraItemTextbox" name="txt_rent[]" id="txt_rent" value="{{ $WaterDisplay->meter_rent }}" style="background-color:#D7D2D5; text-align:center" readonly=""></td>
															<td align="center"><input type="text" class="extraItemTextbox" name="txt_unit[]" id="txt_unit" value="{{ $WaterDisplay->unit_consum }}" style="background-color:#D7D2D5; text-align:center" readonly=""></td>
															<td align="center"><input type="text" class="extraItemTextbox" name="txt_factor[]" id="txt_factor" value="{{ $WaterDisplay->factor }}" style="background-color:#D7D2D5; text-align:center" readonly=""></td>
															<td align="center"><input type="text" class="extraItemTextbox" name="txt_amount[]" id="txt_amount" value="{{ $WaterDisplay->water_cost }}" readonly="" style="background-color:#D7D2D5; text-align:center"></td>
															<td align="center" colspan="2" valign="middle"><input type="button" class="buttonstyle delete" name="btn_delete" id="btn_delete" value="Delete" ></td>
														</tr>
														@endforeach
														@endif
													</table>	
												</div>
											</div>							
											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div3 label">
													Total Unit consumption
												</div>
												<div class="div3">
													<input type="text" name='txt_electricity_unit' readonly="" id='txt_electricity_unit' class="textboxdisplay" value="" style="width: 120px;">
												</div>
											</div>
											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div3 label">
													Total Amount
												</div>
												<div class="div3">
													<input type="text" name='txt_electricity_cost' readonly="" id='txt_electricity_cost' class="textboxdisplay" value="" style="width: 120px;">
												</div>
											</div>


										</div>
										<div class="row">
											<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
												<div class="buttonsection">
													<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
												</div>
												<div class="buttonsection" >
													<input type="submit" name="submit" id="submit" value=" Submit "/>
													<input type="hidden" name='wid' id='wid' class="textboxdisplay"  value="@if(isset($WId)){{ $WId }}@endif" size="40" >
													<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
												</div>
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
						$("#cmb_meter_no_0").append('<option value="'+element.wrecoverid+'" data-imr="'+element.imr+'" data-imr_date="'+element.imr_date+'" data-rate="'+element.rate+'" data-meter_rent="'+element.meter_rent+'" data-factor="'+element.factor+'">'+element.meter_no+'</option>');
					});
				}
			}
		});
	}); 

	$('body').on("change","#cmb_meter_no_0", function(event){
		var Imr = $('#cmb_meter_no_0 option:selected').attr('data-imr');
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
					var usedamount 	= (Number(unitrate)*Number(usedunit)*Number(factor))+Number(meterrent);
					$('#txt_amount_0').val(usedamount); 
					$('#txt_unit_0').val(usedunit);
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
		var Meter   = $("#cmb_meter_hidden_no_0").val();
		var Imr = $("#txt_imr_0").val();
		var ImrDate = $("#txt_imr_date_0").val();
		var Fmr = $("#txt_fmr_0").val();
		var FmrDate = $("#txt_fmr_date_0").val();
		var RateUnit = $("#txt_rate_unit_0").val();
		var Rent = $("#txt_rent_0").val();
		var Unit = $("#txt_unit_0").val();
		var Factor = $("#txt_factor_0").val();
		var Amt = $("#txt_amount_0").val();
		var RowStr = '<tr><td><input type="hidden" name="cmb_meter_hidden_no_0[]" class="extraItemTextbox" value="'+Meter+'"><input type="text" name="cmb_meter_no[]"class="extraItemTextbox" value="'+MeterNo+'"></td><td align="center"><input type="text" class="extraItemTextbox" name="txt_imr[]" id="txt_imr_0"  style="text-align:center" onBlur="change();" value="'+Imr+'"></td><td align="center"><input type="text" class="extraItemTextbox" name="txt_imr_date[]" id="txt_imr_date[]"  style="background-color:#D7D2D5; text-align:center" readonly="" value="'+ImrDate+'"></td><td align="center"><input type="text" class="extraItemTextbox" name="txt_fmr[]" id="txt_fmr[]" onBlur="change();"value="'+Fmr+'"></td><td align="center"><input type="text" class="extraItemTextbox" name="txt_fmr_date[]" id="txt_fmr_date[]" placeholder="dd-mm-yyyy" value="'+FmrDate+'"></td><td align="center"><input type="text" class="extraItemTextbox" name="txt_rate_unit[]" id="txt_rate_unit[]" style="background-color:#D7D2D5; text-align:center" readonly="" value="'+RateUnit+'"></td><td align="center"><input type="text" class="extraItemTextbox" name="txt_rent[]" id="txt_rent[]" style="background-color:#D7D2D5; text-align:center" readonly="" value="'+Rent+'"></td><td align="center"><input type="text" class="extraItemTextbox EmUnit" name="txt_unit[]" id="txt_unit[]" style="background-color:#D7D2D5; text-align:center" readonly="" value="'+Unit+'"></td><td align="center"><input type="text" class="extraItemTextbox" name="txt_factor[]" id="txt_factor[]" style="background-color:#D7D2D5; text-align:center" readonly="" value="'+Factor+'"></td><td align="center"><input type="text" class="extraItemTextbox EmAmt" name="txt_amount[]" id="txt_amount[]" readonly="" style="background-color:#D7D2D5; text-align:center" value="'+Amt+'"></td><td align="center" colspan="2" valign="middle"><input type="button" class="buttonstyle delete" name="wat_delete" id="wat_delete" value="Delete"></td></tr>';
		if(Meter == 0){
			alert("Name should not be empty");
			return false;
		}else if(Fmr ==""){
			alert("Please enter Fmr");
			event.preventDefault();
			return false;
		}else if(FmrDate ==""){
			alert("Please enter Fmr Date");
			event.preventDefault();
			return false;
		}else{
			$("#table1").append(RowStr);
			$("#cmb_meter_no_0").val('');
			$("#cmb_meter_hidden_no_0").val('');
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
			$("#txt_electricity_unit").val(TotalAmt);
		});
	}
</script>
@endsection