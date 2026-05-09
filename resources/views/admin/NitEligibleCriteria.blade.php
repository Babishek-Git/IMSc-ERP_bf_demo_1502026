@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<form action="{{ route('admin.NitEligibleCriteria') }}" method="post" enctype="multipart/form-data" name="form">
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1" style="overflow:auto">
					<div class="container">
						<div class="row ">
							<div class="div2">&nbsp;</div>
							<div class="div8 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">NIT Eligible Criteria</div></div></div>
								<div class="divrowbox innerdiv pt-2">
									<div class="row smclearrow"></div>
									<div class="row">
										<div class="div3 label">
											Description <span class="reqindi">*</span>
										</div>
										<div class="div7">
											<input type="text" name='txt_description' id='txt_description' class="tboxclass" maxlength="250" value="@if(isset($data['NitEligibleData'])){{ $data['NitEligibleData']->description }}@endif"></td>
											<input type="hidden" name = "hid_niteligibleid" id = "hid_niteligibleid" value = "@if(isset($data['NitEligibleData'])){{ encrypt($data['NitEligibleData']->tnieid) }}@endif">
										</div>
									</div>
									<div class="row">
										<div class="div3 label">
											Description Code <span class="reqindi">*</span>
										</div>
										<div class="div7">
											<input type="text" name='txt_desc_code' id='txt_desc_code' class="tboxclass" maxlength="5" value="@if(isset($data['NitEligibleData'])){{ $data['NitEligibleData']->description_code }}@endif"></td>
										</div>
									</div>
									<div class="row smclearrow"></div>
									<div class="row">
										<div class="div3 label">
											Mode <span class="reqindi">*</span>
										</div>
										<div class="div7">
										<select name="cmb_mode" id ="cmb_mode" class="tboxsmclass">  
											<option value="">---- Select ---- </option>
											<option value="DAY" name = "cmb_mode" id = "cmb_mode" @if(isset($data['NitEligibleData']) && $data['NitEligibleData']->mode == "DAY"){{ 'selected = "selected"' }}@endif>Day</option>
											<option value="NO" name = "cmb_mode" id = "cmb_mode" @if(isset($data['NitEligibleData']) && $data['NitEligibleData']->mode == "NO"){{ 'selected = "selected"' }}@endif>No</option>
											<option value="AMT" name = "cmb_mode" id = "cmb_mode" @if(isset($data['NitEligibleData']) && $data['NitEligibleData']->mode == "AMT"){{ 'selected = "selected"' }}@endif>Amount</option>
											<option value="PERC" name = "cmb_mode" id = "cmb_mode" @if(isset($data['NitEligibleData']) && $data['NitEligibleData']->mode == "PERC"){{ 'selected = "selected"' }}@endif>Percentage</option>
										</select>
										</div>
									</div>
									<div class="row smclearrow"></div>
									<div class="row">
										<div class="div3 label">
											Value <span class="reqindi">*</span>
										</div>
										<div class="div7">
											<input type="text" name='txt_value' id='txt_value' class="tboxsmclass" value="@if(isset($data['NitEligibleData'])){{ $data['NitEligibleData']->elig_value }}@endif"></td>
										</div>
									</div>
								</div>
								<div class="row smclearrow"></div>												
								@php $AddUrl = 'admin.ViewNitEligibleCriteria'; @endphp
								<div class="row">
									<div class="div12" align="center">
										<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" View " onClick="window.location='{{route($AddUrl)}}'" />
										<input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />									
										<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
									</div>		
								</div>
								<div class="div12"></div>
							</div>
							<div class="div2">&nbsp;</div>
						</div>                          
					</div>	
				</blockquote>
			</div>
		</div>					
	</div>
</form>

<script>
$(document).ready(function(){
	$("body").on("click","#btn_save", function(event){
		var Descripiton = $('#txt_description').val();
		var DescCode = $('#txt_desc_code').val();
		var Mode = $('#cmb_mode').val();
		var value = $('#txt_value').val();
		if(Descripiton == ""){
			BootstrapDialog.alert("Please Enter the Description!");
			event.preventDefault();
			event.returnValue = false;
		}
		else if(DescCode == "") {
			BootstrapDialog.alert("Please Enter the Description Code!");
			event.preventDefault();
			event.returnValue = false;
		}
		else if(Mode == "") {
			BootstrapDialog.alert("Please Select the Mode!");
			event.preventDefault();
			event.returnValue = false;
		}
		else if(value == "") {
			BootstrapDialog.alert("Please Enter the Value!");
			event.preventDefault();
			event.returnValue = false;
		}
	});
	$('body').on('change', "#txt_value",function(evt){
		var Value = $(this).val();
		var Mode = $("#cmb_mode").val();
		if(Mode == "PERC"){
			if(Number(Value) > 100){
				BootstrapDialog.alert('Invalid Percentage');
				$(this).val('');
			}
		}
	});
	$('body').on('keypress', "#txt_value",function(evt){
		var result = $(this).val();	
		var charCode = (evt.which) ? evt.which : event.keyCode;
		var dot1 	 = result.indexOf('.');
		var dot2 	 = result.lastIndexOf('.'); 
		var val 	 = result;
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
			//Recovery = 'x';
			return false;
		}else if(isNaN(SplitVal[1]) && Number(fractLen) > 0){
			//Recovery = 'x';
			return false;
		}else if (fractLen > 1){
			return false;
		}else{
			return true;
		}
	});
	$('body').on("change", ".tboxclass" ,function(event){
		var Desc     = $('#txt_description').val();
		var DescCode = $('#txt_desc_code').val();
		var HidId    = $('#hid_niteligibleid').val();
		$.ajax({
			type: 'POST',
			url: "{{ route('ajax.DuplicateNitEligible') }}",
			data: {'_token': '{{ csrf_token() }}', 'Desc': Desc, 'DescCode': DescCode },
			success: function(data){ 
				if(HidId == null){
					if(data>0) { alert(1);
                		BootstrapDialog.alert("Nit Eligible Criteria already exists!");
					}
				}
			}
		});
	});
});	

</script>
@endsection


