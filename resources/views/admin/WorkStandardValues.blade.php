@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')


<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="{{ route('admin.WorkStandardValues') }}" method="post" enctype="multipart/form-data" name="form">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row ">
								<div class="div1">&nbsp;</div>
								<div class="div10 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Work Standard Values</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>									
											<div class="row">
												<div class="div4 label">
													Default Value Description <span class="reqindi">*</span>
												</div>
												<div class="div6">					
													<input type='text' name='txt_def_val_desc' id='txt_def_val_desc' maxlength="150" class="tboxsmclass" value="@if(isset($data['WdValData'])){{ $data['WdValData']->wd_val_desc }}@endif">
													<input type="hidden" name = "hid_WdValId" id = "hid_WdValId" value = "@if(isset($data['WdValData'])){{ encrypt($data['WdValData']->wdvalid) }}@endif" readonly ="">
												</div>
											</div>
											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div4 label">
													Default Value Code <span class="reqindi">*</span>
												</div>
												<div class="div6">					
													<input type='text' name='txt_def_val_code' id='txt_def_val_code' maxlength="10" class="tboxsmclass" value="@if(isset($data['WdValData'])){{ $data['WdValData']->wd_val_code }}@endif">
												</div>
											</div>
											<div class="row smclearrow isappcheck" style="display-none"></div>
											<div class="row smclearrow"></div>
											<table class="dataTable etable " align="center" width="100%" id="defvaltable1">
												<tr class="label" style="background-color:#FFF">
													<th align="center">Start Range</th>
													<th align="center">End Range</th>
													<th align="center">Default Value Mode</th>
													<th align="center">Percent/Amount/Days</th>
													<th align="center">Action</th>
												</tr>
												<tr>
												<td align="center"><input type="text" class="tboxsmclass" name="txt_st_range_0" id="txt_st_range_0" value= "@if(isset($data['WdValData'])){{ $data['WdValData']->wd_val_start_range }}@endif"></td>
													<td align="center"><input type="text" class="tboxsmclass" name="txt_end_range_0" id="txt_end_range_0" value= "@if(isset($data['WdValData'])){{ $data['WdValData']->wd_val_end_range }}@endif"></td>
													<td align="center">
														<select name="cmb_def_mode_0" id ="cmb_def_mode_0" class="tboxsmclass">  
															<option name="cmb_def_mode_0" id ="cmb_def_mode_0" value="">- Select - </option>
															<option name="cmb_def_mode_0" id ="cmb_def_mode_0" value="PERC" @if(isset($data['WdValData']) && ($data['WdValData']->wd_val_mode == "PERC")){{ 'selected = "selected"'; }}@endif>Percent</option>
															<option name="cmb_def_mode_0" id ="cmb_def_mode_0" value="AMT" @if(isset($data['WdValData']) && ($data['WdValData']->wd_val_mode == "AMT")){{ 'selected = "selected"'; }}@endif>Amount</option>
															<option name="cmb_def_mode_0" id ="cmb_def_mode_0" value="DAYS" @if(isset($data['WdValData']) && ($data['WdValData']->wd_val_mode == "DAYS")){{ 'selected = "selected"'; }}@endif>Days</option>
															<option name="cmb_def_mode_0" id ="cmb_def_mode_0" value="MON" @if(isset($data['WdValData']) && ($data['WdValData']->wd_val_mode == "MON")){{ 'selected = "selected"'; }}@endif>Months</option>
															<option name="cmb_def_mode_0" id ="cmb_def_mode_0" value="YEAR" @if(isset($data['WdValData']) && ($data['WdValData']->wd_val_mode == "YEAR")){{ 'selected = "selected"'; }}@endif>Years</option>
														</select>
													</td>										
													<td align="center"><input type="text" class="tboxsmclass"  name="txt_per_amt_0" id="txt_per_amt_0" value= "@if(isset($data['WdValData'])){{ $data['WdValData']->wd_val }}@endif"></td>
													<td align="center"><input type="button"  name="btn_add" id="btn_add"  value=" ADD " class="btn btn-info" style="margin-top:0px;"></td>
													<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}"/>
												</tr>
						
											</table>
											<div class="row smclearrow"></div>
											
											@php $AddUrl = 'admin.ViewWorkStandardValues'; @endphp
											<div class="div12" align="center">
												<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" View " onClick="window.location='{{route($AddUrl)}}'" />
												<input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />									
												<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />												
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

<script>
	$(document).ready(function(){
		$('body').on('click', '#btn_add', function(event){ 
			var WdValStrartRange = $("#txt_st_range_0").val();
			var WdValEndRange = $("#txt_end_range_0").val();
			var WdValMode = $("#cmb_def_mode_0").val();
			var WdValPerAmt = $("#txt_per_amt_0").val();
			if(WdValStrartRange == ""){
				BootstrapDialog.alert("Please enter the Start Range!");
				event.preventDefault();
				event.returnValue = false;
			}else if(WdValEndRange == ""){
				BootstrapDialog.alert("Please enter the End Range!");
				event.preventDefault();
				event.returnValue = false;
			}else if(WdValMode == ""){
				BootstrapDialog.alert("Please select the Default Value Mode!");
				event.preventDefault();
				event.returnValue = false;
			}else if(WdValPerAmt == ""){
				BootstrapDialog.alert("Please enter the Percentage/Amount!");
				event.preventDefault();
				event.returnValue = false;
			}else{
				var RowStr = '<tr class = "WdValRecord"><td align="center"><input type="text" class="tboxsmclass" name="txt_st_range[]" id="txt_st_range[]" value= "'+ WdValStrartRange +
							'"></td><td align="center"><input type="text" class="tboxsmclass" name="txt_end_range[]" id="txt_end_range[]" value = "'+ WdValEndRange +
							'"></td><td align="center"><input type="text" class="tboxsmclass" name="cmb_def_mode[]" id="cmb_def_mode[]" value= "'+ WdValMode +
							'"></td><td align="center"><input type="text" class="tboxsmclass" name="txt_per_amt[]" id="txt_per_amt[]" value= "'+ WdValPerAmt +
							'"></td><td align="center"><input type="button" name="btn_delete" id="btn_delete" value=" DELETE " class="btn btn-info" style="margin-top:0px;"></td></tr>'
				
				$("#defvaltable1").append(RowStr);
                $("#txt_st_range_0").val('');
                $("#txt_end_range_0").val('');
                $("#cmb_def_mode_0").val('');
                $("#txt_per_amt_0").val('');
			}
			
		});
		$('body').on('click', '#btn_delete', function(event){
			$(this).closest('tr').remove();
		});

		$('body').on('change', "#txt_per_amt_0",function(){
			var DefVal = $(this).val();
			var DefMode = $("#cmb_def_mode_0").val();
			if(DefMode == "PERC"){
				if(Number(DefVal) > 100){
					BootstrapDialog.alert('Invalid Percentage');
					$(this).val('');
				}
			}
		});

		$('body').on('keypress', "#txt_per_amt_0",function(evt){
			var DefMode = $("#cmb_def_mode_0").val();
			var DefVal = $(this).val();
			if(DefMode == "PERC"){
				var charCode = (evt.which) ? evt.which : event.keyCode;
				var dot1 	 = DefVal.indexOf('.');
				var dot2 	 = DefVal.lastIndexOf('.'); 
				var val 	 = DefVal;
				var SplitVal = val.split(".");
				var len 	 = SplitVal.length;
				var WholeNo = SplitVal[0];
				
				var Fraction = SplitVal[1];
				if(Fraction){
					var fractLen = Fraction.length;
				}else{
					var fractLen = 0;
				}
				if(charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)){
					return false;
				}else if (charCode == 46 && (dot1 == dot2) && dot1 != -1 && dot2 != -1){
					return false;
				}else if(isNaN(SplitVal[0])){
					//DefVal = 'x';
					return false;
				}else if(isNaN(SplitVal[1]) && Number(fractLen) > 0){
					//DefVal = 'x';
					return false;
				}else if (fractLen > 1){
					return false;
				}else{
					return true;
				}
			} 
			else if(DefMode == "AMT"){
				var charCode = (evt.which) ? evt.which : event.keyCode;
				var dot1 	 = DefVal.indexOf('.');
				var dot2 	 = DefVal.lastIndexOf('.'); 
				var val 	 = DefVal;
				var SplitVal = val.split(".");
				var len 	 = SplitVal.length;
				var Fraction = SplitVal[1];
				if(Fraction){
					var fractLen = Fraction.length;
				}else{
					var fractLen = 0;
				}
				if(charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)){
					return false;
				}else if (charCode == 46 && (dot1 == dot2) && dot1 != -1 && dot2 != -1){
					return false;
				}else if(isNaN(SplitVal[0])){
					//DefVal = 'x';
					return false;
				}else if(isNaN(SplitVal[1]) && Number(fractLen) > 0){
					//DefVal = 'x';
					return false;
				}else if (fractLen > 1){
					return false;
				}else{
					return true;
				}
			}
		});

		$('body').on("change", ".tboxsmclass" ,function(event){
			var WdValDesc = $('#txt_def_val_desc').val();
			var WdValCode = $('#txt_def_val_code').val();
			var HidId     = $('#hid_WdValId').val();
			$.ajax({
				type: 'POST',
				url: "{{ route('ajax.DuplicateWorkDefaultValues') }}",
				data: { '_token': '{{ csrf_token() }}','WdValDesc': WdValDesc, 'WdValCode': WdValCode },
				success: function(data){
					if(HidId == ""){
						if(data>0) {
							BootstrapDialog.alert("Work Default Value already exists!");
						}
					}
				}
			});
		});

		$('body').on('click', '#btn_save', function(event){
			var WdValRecord = $(".WdValRecord");
			var WdValDesc = $("#txt_def_val_desc").val();
			var WdValCode = $("#txt_def_val_code").val();

			if(WdValDesc == ""){
                BootstrapDialog.alert("Please enter Default Value Description!");
				event.preventDefault();
				event.returnValue();
            }else if(WdValCode == ""){
                BootstrapDialog.alert("Please enter Default Value Code!");
				event.preventDefault();
				event.returnValue();
            }else if(WdValRecord.length <= 0){
                BootstrapDialog.alert("Please enter atleast one Record!");
				event.preventDefault();
				event.returnValue();
            }
		});
		

	});
</script>



@endsection


