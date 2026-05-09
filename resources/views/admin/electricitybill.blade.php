@extends('layouts.dashboard-master')
@section('content')
@include('layouts.partials.messages')

<form action="{{ route('admin.electricitysave') }}" method="post" enctype="multipart/form-data" name="form">
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
						<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Create New Meter And Details For Electricity</div></div></div>
						<tr>
							<td>&nbsp;</td>
							<td class="label">Work Short Name</td> 
							<td>
							<select name="cmb_work_sname" id="cmb_work_sname" class="textboxdisplay" style="width:437px;">
							<option value="">--------------- Select ---------------</option>
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
							</td>
						</tr>
						<tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_shortname" style="color:red" colspan="">&nbsp;</td></tr>
						<tr>
							<td>&nbsp;</td>
							<td class="label">Name of Work</td>
							<td><textarea name='txt_workname' id='txt_workname' readonly="" class="textboxdisplay" rows="6" style="width: 465px;"></textarea></td>
						</tr>
						<tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_wname" style="color:red" colspan="">&nbsp;</td></tr>
						<tr>
							<td>&nbsp;</td>
							<td class="label">Work Order No.</td>
							<td><input type="text" name='txt_workorder_no' id='txt_workorder_no' readonly="" class="textboxdisplay" value="" style="width: 465px;"></td>
						</tr>
						<tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_workorder" style="color:red" colspan="">&nbsp;</td></tr>
						<tr>
							<td colspan="3" align="center">
							<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Meter Details</div></div></div>
								<div style="width:100%; height:auto; overflow:scroll" align="center">
									<table width="100%" class="table1" id="table1" name="table1"> 
										<tr class="label" style="background-color:#EAEAEA">
											<td align="center">Meter No.</td>
											<td align="center">IMR</td>
											<td align="center">IMR Date</td>
											<td align="center">Rate/unit <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i></td>
											<td align="center">Meter Rent <i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i></td>
											<td align="center">Factor</td>
											<td align="center" colspan="2">Action</td>
										</tr>
										<tr>
											<td align="center"><input type="text" class="extraItemTextbox" name="txt_meter_no_0" id="txt_meter_no_0" value=""></td>
											<td align="center"><input type="number" class="extraItemTextbox" name="txt_imr_0" id="txt_imr_0" onKeyPress="return isNumberKey(event,this)" value=""></td>
											<td align="center"><input type="text" placeholder="DD-MM-YYYY" class="extraItemTextbox" name="txt_imr_date_0" id="txt_imr_date_0" value=""></td>
											<td align="center"><input type="number" class="extraItemTextbox" name="txt_rate_unit_0" id="txt_rate_unit_0" onKeyPress="return isNumberKey(event,this)" value=""></td>
											<td align="center"><input type="number" class="extraItemTextbox" name="txt_rent_0" id="txt_rent_0" onKeyPress="return isNumberKey(event,this)" value=""></td>
											<td align="center"><input type="number" class="extraItemTextbox" name="txt_factor_0" id="txt_factor_0" onKeyPress="return isNumberKey(event,this)" value=""></td>
											<td align="center" colspan="2" ><input type="button" class="buttonstyle" name="btn_add" id="btn_add" value="Add" onClick="addrow(); clearrow();"></td>
										</tr>
									</table>
									</div>
									<div class="div1"></div>
								</div>
							</td>
						</tr>
					</table>
					<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
						<!-- <div class="buttonsection">
							<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
						</div> -->
						<div class="buttonsection">
							<input type="submit" name="submit" id="submit" value=" Submit " />
							<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />									
							<input type="hidden" name='contid' id='contid' class="textboxdisplay"  value="" size="40" >
							<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
						</div>
					</div>
				</blockquote>
			</div>
		</div>
	</div>
</form>
<script>
	$(document).ready(function() {
		$('#dataTable').DataTable({
			responsive: true,
			paging: true, 
		});
		$("body").on("click", "#btn_add", function(event) {
			var MeterNo = $("#txt_meter_no_0").val();
			var Imr = $("#txt_imr_0").val();
			var ImrDate = $("#txt_imr_date_0").val();
			var RateUnit = $("#txt_rate_unit_0").val();
			var Rent = $("#txt_rent_0").val();
			var Factor = $("#txt_factor_0").val();
			var RowStr = '<tr><td align="center"><input type="text" class="extraItemTextbox" name="txt_meter_no[]" id="txt_meter_no" value="'+MeterNo+'"></td><td align="center"><input type="number" class="extraItemTextbox" name="txt_imr[]" id="txt_imr" onKeyPress="return isNumberKey(event,this)" value="'+Imr+'"></td><td align="center"><input type="text" placeholder="DD-MM-YYYY" class="extraItemTextbox" name="txt_imr_date[]" id="txt_imr_date" value="'+ImrDate+'"></td><td align="center"><input type="number" class="extraItemTextbox" name="txt_rate_unit[]" id="txt_rate_unit" onKeyPress="return isNumberKey(event,this)" value="'+RateUnit+'"></td><td align="center"><input type="number" class="extraItemTextbox" name="txt_rent[]" id="txt_rent" onKeyPress="return isNumberKey(event,this)" value="'+Rent+'"></td><td align="center"><input type="number" class="extraItemTextbox" name="txt_factor[]" id="txt_factor" onKeyPress="return isNumberKey(event,this)" value="'+Factor+'"></td><td align="center" colspan="2" valign="middle"><input type="button" class="buttonstyle delete" name="btn_delete" id="btn_delete" value="Delete" ></td></tr>'
			if(MeterNo == ""){
				alert("Please enter MeterNo");
				event.preventDefault();
				return false;
			}else if(Imr ==""){
				alert("Please enter Imr");
				event.preventDefault();
				return false;
			}else if(ImrDate ==""){
				alert("Please enter ImrDate");
				event.preventDefault();
				return false;
			}else if(RateUnit ==""){
				alert("Please enter RateUnit");
				event.preventDefault();
				return false;
			}else if(Rent ==""){
				alert("Please enter Rent");
				event.preventDefault();
				return false;
			}else if(Factor ==""){
				alert("Please enter Factor");
				event.preventDefault();
				return false;
			}else {
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

		$("body").on("click", "#submit", function(event) {
			var count = $('#table1 tr').length;
			if (count < 2){
				alert("Please Add Meter Detailss");
				event.preventDefault();
				return false;
			}
		});
	});
	$('#cmb_work_sname').chosen();
	$('#cmb_work_sname').change(function() {
		var work = $(this).val();
		$("#txt_workorder_no").val('');
		$("#txt_workname").val('');
		$.ajax({
			type:'GET',
			url:"{{ route('posts.getwork') }}",
			data:{'work':work},
			success:function(data){ 
				if(data){ 
					$.each(data, function(key, value) { 
						$("#txt_workorder_no").val(value.work_order_no);
						$("#txt_workname").val(value.work_name);
					});
				}
			}
		});
	});
</script>
@endsection