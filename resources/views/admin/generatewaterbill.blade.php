@extends('layouts.dashboard-master')
	
@section('content')
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <form action="" method="post" enctype="multipart/form-data" name="form">
            <div class="content">
                <div class="title">Generate - Water Bill</div>
                <div class="container_12">
                    <div class="grid_12">
						<!--<div align="right"><a href="View_Electricity_generate_Bill.php">View</a>&nbsp;&nbsp;&nbsp;</div>-->
                        <blockquote class="bq1" style="overflow:auto">
							<input type="hidden" name="hid_sheetid" id="hid_sheetid" value="">
                        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="color1">
                                <tr><td width="24%">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Work Short Name</td> 
                                    <td class="labeldisplay">
										<select name="cmb_work_sname" id="cmb_work_sname" class="textboxdisplay" style="width:465px" onChange="workorderdetail();getrbn();ElectricityMeterDetail();recovery();">
											<option value="">------------- Select Work Short Name --------------</option>
                                            @if(isset($data1))
                                                @foreach($data1 as $Pin)
                                                    @php
                                                    if((isset($PIN))&&($PIN == $Pin->sheetid)){
                                                        $SelStr = 'selected="selected"';
                                                    }else{
                                                        $SelStr = '';
                                                    }
                                                    @endphp
                                                    <option value="{{ $Pin->sheetid; }}" {{ $SelStr; }}> {{ $Pin->short_name; }} </option>
                                                @endforeach
                                            @endif
								     </select>
									</td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_shortname" style="color:red" colspan="">&nbsp;</td></tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Name of Work</td>
                                    <td><textarea name='txt_workname' id='txt_workname' class="textboxdisplay" readonly="readonly" rows="6" style="width: 465px;"></textarea></td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_wname" style="color:red" colspan="">&nbsp;</td></tr>
                                
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Work Order No.</td>
                                    <td><input type="text" name='txt_workorder' id='txt_workorder' class="textboxdisplay" readonly="" value="" style="width: 465px;"></td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_workorder" style="color:red" colspan="">&nbsp;</td></tr>
								
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">RAB No.</td>
                                    <td>
									<input type="text" name='txt_rbn' id='txt_rbn' class="textboxdisplay" readonly="" value="" style="width: 120px;">
									<label class="label">
									&emsp;&emsp;&emsp;
									Electricity Bill No.
									&emsp;&emsp;&emsp;
									</label>
									<input type="text" name='txt_ebill_no' id='txt_ebill_no' class="textboxdisplay" value="" style="width: 120px;">
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
										<div class="label gradientbg" align="center">Meter Details</div>
										<div style="width:95%; height:auto;" align="center">
											<table width="100%" class="table1" id="table1">
												<tr class="label" style="background-color:#EAEAEA">
													<td align="center">Meter No.</td>
													<td align="center">IMR</td>
													<td align="center">IMR Date</td>
													<td align="center">FMR</td>
													<td align="center">FMR Date</td>
													<td align="center">Rate/litre <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i></td>
													<!-- Change Rate/unit into Rate/litre -->
													<td align="center">Meter Rent <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i></td>
													<td align="center">Unit </td>
													<td align="center">Factor </td>
													<td align="center">Amount <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i></td>
													<td align="center" colspan="2">Action</td>
												</tr>
												<tr>
													<td align="center" style="vertical-align:middle">
														<select name="cmb_meter_no_0" id="cmb_meter_no_0" class="extraItemTextbox" style="text-align:center; width:80px;" onChange="meter_details();ClearOldData();">
															<option value="">--Select--</option>
														</select>
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
												<!-- <tr>
                                                    <span id="add_hidden"></span>
												</tr> -->
											</table>
											<!-- <input type="hidden" value="" name="add_set_a1" id="add_set_a1"/> -->
										</div>
									</td>
								</tr>
								<tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_electricity_row" style="color:red" colspan="">&nbsp;</td></tr>
								<tr>
									<!--<td>&nbsp;</td>-->
									<td class="label" colspan="2" align="right">Total Unit consumption&emsp;&emsp;</td>
									<td>
										<input type="text" name='txt_electricity_unit' readonly="" id='txt_electricity_unit' class="textboxdisplay" value="" style="width: 120px;">
									</td>
								</tr>
								<tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_electricity_cost" style="color:red" colspan="">&nbsp;</td></tr>
								<tr>
									<!--<td>&nbsp;</td>-->
									<td class="label" colspan="2" align="right">Total Amount <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i>&emsp;&emsp;</td>
									<td>
										<input type="text" name='txt_electricity_cost' readonly="" id='txt_electricity_cost' class="textboxdisplay" value="" style="width: 120px;">
									</td>
								</tr>
								<tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_electricity_cost" style="color:red" colspan="">&nbsp;</td></tr>
								
								
							</table>
									<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
										<div class="buttonsection">
										<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
										</div>
										<div class="buttonsection">
											<input type="submit" name="update" id="update" value=" Update "/>
											<input type="submit" name="submit" id="submit" value=" Submit "/>
											<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
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
							$("#cmb_meter_no_0").append('<option value="'+element.erecoverid+'" data-imr="'+element.imr+'" data-imr_date="'+element.imr_date+'" data-rate="'+element.rate+'" data-meter_rent="'+element.meter_rent+'" data-factor="'+element.factor+'">'+element.meter_no+'</option>');
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
		// $('#cmb_work_sname').change(function() { 
		// 	var work = $(this).val(); 
		// 	$.ajax({
		// 		type:'GET',
		// 		url:"{{ route('ajax.Meter') }}",
		// 		data:{'work':work},
		// 		success:function(data){ //alert(data);
		// 			if(data){ 
		// 				$.each(data, function(index, element) {
		// 					var MeterNo = element.MeterNo;
		// 				}
		// 				$("#cmb_meter_no_0").append('<option value="'+element.MeterNo+'">'+element.Meter No+'</option>');
		// 				});
		// 			}
		// 		}
		// 	});
		// });
		// 	$(document).ready(function() {
		// 	$('#dataTable').DataTable({
		// 		responsive: true,
		// 		paging: true, 
		// 	});
		// 	$("body").on("click", "#btn_add", function(event) {
		// 		var Imr = $("#txt_imr_0").val();
		// 		var ImrDate = $("#txt_imr_date_0").val();
		// 		var Fmr = $("#txt_fmr_0").val();
		// 		var FmrDate = $("#txt_fmr_date_0").val();
		// 		var RateUnit = $("#txt_rate_unit_0").val();
		// 		var Rent = $("#txt_rent_0").val();
		// 		var Unit = $("#txt_unit_0").val();
		// 		var Factor = $("#txt_factor_0").val();
		// 		var Amt = $("#txt_amount_0").val();
		// 		var RowStr = '<td align="center"><input type="text" class="extraItemTextbox" name="txt_imr[]" id="txt_imr[]" value="'+Imr+'"  style="text-align:center" onBlur="calculateEBamount();"></td><td align="center"><input type="text" class="extraItemTextbox" name="txt_imr_date[]" id="txt_imr_date[]" value="'+Imr+'" style="background-color:#D7D2D5; text-align:center" Value="'++'"></td><td align="center"><input type="text" class="extraItemTextbox" name="txt_fmr[]" id="txt_fmr[]" Value="'+Fmr+'" onBlur="calculateEBamount();"></td><td align="center"><input type="text" class="extraItemTextbox" name="txt_fmr_date[]" id="txt_fmr_date[]" Value="'+FmrDate+'" placeholder="dd-mm-yyyy"></td><td align="center"><input type="text" class="extraItemTextbox" name="txt_rate_unit[]" id="txt_rate_unit[]" style="background-color:#D7D2D5; text-align:center" Value="'++'"></td><td align="center"><input type="text" class="extraItemTextbox" name="txt_rent[]" id="txt_rent[]" style="background-color:#D7D2D5; text-align:center" Value="'+RateUnit+'"></td><td align="center"><input type="text" class="extraItemTextbox" name="txt_unit[]" id="txt_unit[]" style="background-color:#D7D2D5; text-align:center" Value="'+Rent+'"></td>					<td align="center"><input type="text" class="extraItemTextbox" name="txt_factor[]" id="txt_factor[]" style="background-color:#D7D2D5; text-align:center" Value="'+Unit+'"></td><td align="center"><input type="text" class="extraItemTextbox" name="txt_amount[]" id="txt_amount[]" readonly="" style="background-color:#D7D2D5; text-align:center"Value="'+Factor+'"></td><td align="center" colspan="2" valign="middle"><input type="button" class="buttonstyle delete" name="btn_delete" id="btn_delete" value="Delete" onClick="addrow();total_unit_amount_consumption();"></td></tr>'
		// 		if(ImrDate == ""){
		// 			alert("Please enter ImrDate");
		// 			event.preventDefault();
		// 			return false;
		// 		}else if(Fmr ==""){
		// 			alert("Please enter Fmr");
		// 			event.preventDefault();
		// 			return false;
		// 		}else if(FmrDate ==""){
		// 			alert("Please enter FmrDate");
		// 			event.preventDefault();
		// 			return false;
		// 		}else if(RateUnit ==""){
		// 			alert("Please enter RateUnit");
		// 			event.preventDefault();
		// 			return false;
		// 		}else if(Rent ==""){
		// 			alert("Please enter Rent");
		// 			event.preventDefault();
		// 			return false;
		// 		}else if(Unit ==""){
		// 			alert("Please enter Factor");
		// 			event.preventDefault();
		// 			return false;
		// 		}else if(Factor ==""){
		// 			alert("Please enter Factor");
		// 			event.preventDefault();
		// 			return false;
		// 		}else if(Amt ==""){
		// 			alert("Please enter Amount");
		// 			event.preventDefault();
		// 			return false;
		// 		}else {
		// 			$("#table1").append(RowStr);
		// 			$("#txt_imr_date_0").val('');
		// 			$("#txt_fmr_0").val('');
		// 			$("#txt_fmr_date_0").val('');
		// 			$("#txt_rate_unit_0").val('');
		// 			$("#txt_rent_0").val('');
		// 			$("#txt_unit_0").val('');
		// 			$("#txt_unit_0").val('');
		// 		}
		// 	});
		// 	$("body").on("click", ".delete", function() { 	
		// 		$(this).closest("tr").remove();
    	// 	});

	    // 	 $("body").on("click", "#submit", function(event) {
		// 	 	var count = $('#table1 tr').length;
		// 	      if (count < 2){
		// 			alert("Please Add Meter Detailss");
		// 			event.preventDefault();
		// 	 		return false;
		// 	 	}
		//    });
		// });
	
</script>
@endsection