@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
if(isset($data['ActionArr'])){
	foreach($data['ActionArr'] as $ActionArr){

	}
}
@endphp
<form action="{{ route('admin.CreateUnitWeightSectionThick') }}" method="post" enctype="multipart/form-data" name="form">
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1" style="overflow:auto">
					<div class="container">
						<div class="row ">
							<div class="div2">&nbsp;</div>
							<div class="div8 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Steel/Struc. Weight Master</div></div></div>
								<div class="divrowbox innerdiv pt-2">
									<div class="row smclearrow"></div>
									<div class="row">
										<div class="div3 label">
											Material Group <span class="reqindi">*</span>
										</div>
										<div class="div7">
										<select name="txt_material_grp" id="txt_material_grp" class="tboxsmclass" align="left">
											<option value="">--------------- Select ---------------</option>
											@if(isset ($data['UnitWtDescData']))
											@foreach($data['UnitWtDescData'] as $key => $value)
											@if($value->active == 1)
											@php 
											$SelStr = "";
											if(isset($data['UnitWtSecThickData'])){
													if($data['UnitWtSecThickData']->uwdmid == $value->uwdmid){
													$SelStr = 'selected="selected"';
													} 
											}
											@endphp
											<option value="{{$value->uwdmid}}" {{$SelStr}}>{{$value->unit_wt_desc}}</option>
											@endif
											@endforeach
											@endif
										</select>
											<input type="hidden" name = "hid_uwstmid" id = "hid_uwstmid" value = "@if(isset($data['UnitWtSecThickData'])){{ encrypt($data['UnitWtSecThickData']->uwstmid) }}@endif">
										</div>
									</div>
									<div class="row">
										<div class="div3 label">
											Material Code <span class="reqindi">*</span>
										</div>
										<div class="div7">
											<input type="text" name='txt_mat_code' id='txt_mat_code' maxlength="50" class="tboxclass" value="@if(isset($data['UnitWtSecThickData'])){{ $data['UnitWtSecThickData']->material_code }}@endif"></td>
										</div>
									</div>
									
									<div class="row">
										<div class="div3 label">
											Material Name <span class="reqindi">*</span>
										</div>
										<div class="div7">
											<input type="text" name='txt_mat_name' id='txt_mat_name' maxlength="100" class="tboxclass" value="@if(isset($data['UnitWtSecThickData'])){{ $data['UnitWtSecThickData']->sec_thickness }}@endif"></td>
										</div>
									</div>
									<div class="row smclearrow"></div>
									<div class="row">
										<div class="div3 label">
											Weight <span class="reqindi">*</span>
										</div>
										<div class="div7">
											<input type="text" name='txt_weight' id='txt_weight' class="tboxclass numberonly" onKeyPress="return isNumberKey(event,this)" value="@if(isset($data['UnitWtSecThickData'])){{ $data['UnitWtSecThickData']->weight }}@endif"></td>
										</div>
									</div>
									</div>

									<div class="row smclearrow"></div>
								</div>
								<div class="row smclearrow"></div>												
								@php $AddUrl = 'admin.viewUnitThickness'; @endphp
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
	$(document).ready(function() {
		$("#txt_material_grp").chosen();
	});
	$("body").on("click","#btn_save", function(event){
		var MaterialGroup	    = $('#txt_material_grp').val();
		var MaterialName 		= $('#txt_mat_name').val();
		var Weight 				= $('#txt_weight').val();
		var MaterialCode 		= $('#txt_mat_code').val();
		if(MaterialGroup == ""){
			BootstrapDialog.alert("Please Select Material Group!");
			event.preventDefault();
			event.returnValue = false;
		}
		else if(MaterialCode == "") {
			BootstrapDialog.alert("Please Enter Material Code!");
			event.preventDefault();
			event.returnValue = false;
		}
		else if(MaterialName == "") {
			BootstrapDialog.alert("Please Enter the Material Name!");
			event.preventDefault();
			event.returnValue = false;
		}else if(Weight == "") {
			BootstrapDialog.alert("Please Enter Weight!");
			event.preventDefault();
			event.returnValue = false;
		}
	});

	$('body').on('keypress', ".numberonly",function(evt){
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
		}else if (fractLen > 2){
			return false;
		}else{
			return true;
		}
	});


</script>
@endsection


