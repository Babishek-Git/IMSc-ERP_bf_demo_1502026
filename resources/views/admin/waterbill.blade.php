@extends('layouts.dashboard-master')	
@section('content')
@include('layouts.partials.messages')
<form action="{{ route('admin.waterbillsave') }}" method="post" enctype="multipart/form-data" name="form">
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1" style="overflow-y:auto">
					<input type="hidden" name="hid_sheetid" id="hid_sheetid" value="">
					<div class="div1"></div>
					<div class="div10 mbtable">
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="color1">
						<tr><td width="18%">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
						<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Create New Meter And Details For Water</div></div></div>
						<tr>
							<td>&nbsp;</td>
							<td class="label">Work Short Name</td> 
							<td>
								<select name="cmb_shortname" id="cmb_shortname" class="textboxdisplay" style="width:465px">
								<option value="">------------- Select Work Short Name --------------</option>
									@if(isset($data))
										@foreach($data as $Pin)
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
						<tr>
							<td>&nbsp;</td>
							<td class="label">Name of Work</td>
							<td><textarea name='txt_workname' id='txt_workname' readonly="" class="textboxdisplay" rows="6" style="width: 465px;"></textarea></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td class="label">Work Order No.</td>
							<td><input type="text" name='txt_workorder' id='txt_workorder' readonly="" class="textboxdisplay" value="" style="width: 465px;"></td>
						</tr>
						<tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_workorder" style="color:red" colspan="">&nbsp;</td></tr>
						<tr>
							<td colspan="3" align="center">
							<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Meter Details</div></div></div>
								<div style="width:100%; height:auto; overflow:auto" align="center">
									<table width="100%" class="table1" id="table1">
										<tr class="label" style="background-color:#EAEAEA">
											<td align="center">Meter No.</td>
											<td align="center">IMR</td>
											<td align="center">IMR Date</td>
											<td align="center">Rate/litre <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i></td>
											<td align="center">Meter Rent <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i></td>
											<td align="center">Factor</td>
											<td align="center" colspan="2">Action</td>
										</tr>
										<tr>
											<td align="center"><input type="text" class="extraItemTextbox" name="txt_meter_no_0" id="txt_meter_no_0"></td>
											<td align="center"><input type="number" class="extraItemTextbox" name="txt_imr_0" id="txt_imr_0"></td>
											<td align="center"><input type="text" placeholder="DD-MM-YYYY" class="extraItemTextbox" name="txt_imr_date_0" id="txt_imr_date_0"></td>
											<td align="center"><input type="number" class="extraItemTextbox" name="txt_rate_unit_0" id="txt_rate_unit_0" ></td>
											<td align="center"><input type="number" class="extraItemTextbox" name="txt_rent_0" id="txt_rent_0" ></td>
											<td align="center"><input type="number" class="extraItemTextbox" name="txt_factor_0" id="txt_factor_0"></td>
											<td align="center" colspan="2" valign="middle"><input type="button" class="buttonstyle" name="btn_add" id="btn_add" value="Add" onClick="addrow(); clearrow();" ></td>
										</tr>
									</table>
									</div>
									<div class="div1"></div>	
									<input type="hidden" value="" name="add_set_a1" id="add_set_a1"/>
								</div>
							</td>
						</tr>
					</table>
					<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
						<!-- <div class="buttonsection">
						<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
						</div> -->
						<div class="buttonsection">
							<input type="submit" name="submit" id="submit" value=" Save " />
							<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
						</div>
					</div>
				</blockquote>
			</div>
		</div>
	</div>
</form>
<script>
$(document).ready(function(){
	$("body").on("click", "#btn_add", function(event){ 
		var MeterNum 	 = $("#txt_meter_no_0").val();
		var Imr 		 = $("#txt_imr_0").val();
		var ImrDate 	 = $("#txt_imr_date_0").val(); 
		var Rate 		 = $("#txt_rate_unit_0").val();
		var MeterRent    = $("#txt_rent_0").val();
		var Factor  	 = $("#txt_factor_0").val(); 
		var RowStr = '<tr><td><input type="text" name="txt_meter_no[]" class="textbox-new" value="'+MeterNum+'"></td><td><input type="text" name="txt_imr[]" class="textbox-new" value="'+Imr+'"></td><td><input type="text" name="txt_imr_date[]" class="textbox-new" value="'+ImrDate+'"></td><td><input type="text" name="txt_rate_unit[]" class="textbox-new" value="'+Rate+'"></td><td><input type="text" name="txt_rent[]" class="textbox-new" value="'+MeterRent+'"></td><td><input type="text" name="txt_factor[]" class="textbox-new" value="'+Factor+'"></td><td><input type="button" class="delete fa buttonstyle" name="emp_delete" id="emp_delete" value="DELETE"></td></tr>'; 
		if(MeterNum == 0){
			alert("Meter Number should not be empty");
			return false;
		}else if(Imr == 0){
			alert("IMR should not be empty");
			return false;
		}else if(ImrDate == 0){
			alert("ImrDate should not be empty");
			return false;
		}else if(Rate == 0){
			alert("Rate/litre should not be empty");
			return false;
		}else if(MeterRent == 0){
			alert("Meter Rent should not be empty");
			return false;
		}else if(Factor == 0){
			alert("Factor should not be empty");
			return false;
		}else{
			$("#table1").append(RowStr);
			$("#txt_meter_no_0").val('');
			$("#txt_imr_0").val('');
			$("#txt_imr_date_0").val('');
			$("#txt_rate_unit_0").val('');
			$("#txt_rent_0").val('');
			$("#txt_factor_0").val('');
		}
	});
	$("body").on("click", ".delete", function() {
		$(this).closest("tr").remove();
	});

	$('#cmb_shortname').chosen();
	$('#cmb_shortname').change(function(){
		var work = $(this).val();
		$("#txt_workname").val('');
		$("#txt_workorder").val('');
		$.ajax({
		type:'GET',
		url:"{{ route('posts.getwork') }}",
		data:{'work':work},
			success:function(data){ 
				if(data){ 
					$.each(data, function(key, value) { 
						$("#txt_workname").val(value.work_name);
						$("#txt_workorder").val(value.work_order_no);
					});
				}
			}
		});
	});
});


</script>
@endsection