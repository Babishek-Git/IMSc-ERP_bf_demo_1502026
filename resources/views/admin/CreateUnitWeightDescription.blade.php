@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<form action="{{ route('admin.CreateUnitWeightDescription') }}" method="post" enctype="multipart/form-data" name="form">
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1" style="overflow:auto">
					<div class="container">
						<div class="row ">
							<div class="div2">&nbsp;</div>
							<div class="div8 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Unit Weight Description Master</div></div></div>
								<div class="divrowbox innerdiv pt-2">
									<div class="row smclearrow"></div>
									<div class="row">
									</div>
									<div class="row">
										<div class="div3 label">
											Description <span class="reqindi">*</span>  
										</div>
										<div class="div7">
											<input type="text" name='txt_unit_wt_desc' id='txt_unit_wt_desc' maxlength="100" class="tboxclass" value="@if(isset($data['UnitWtDescData'])){{ $data['UnitWtDescData']->unit_wt_desc }}@endif"></td>
										</div>
									</div>
									<div class="row">
										<div class="div3 label">
											Measurement Unit <span class="reqindi">*</span>
										</div>
										<div class="div7">
										<select name="measure_unit" id="measure_unit" class="tboxsmclass" align="left">
											<option value="">--------------- Select ---------------</option>
											@if(isset ($data['UnitList']))
												@foreach($data['UnitList'] as $key => $value)
													@if($value->active == 1)
														@php 
														$SelStr = "";
														if(isset($data['UnitWtDescData'])){
																if($data['UnitWtDescData']->meas_unitid == $value->unitid){
																$SelStr = 'selected="selected"';
																} 
														}
														@endphp
														<option value="{{$value->unitid}}" {{$SelStr}}>{{$value->unit_name}}</option>
													@endif
												@endforeach
											@endif
										</select>
										</div>
									</div>
									<div class="row">
										<div class="div3 label">
											Standard Unit <span class="reqindi">*</span>
										</div>
										<div class="div7">
										<select name="std_unit" id="std_unit" class="tboxsmclass" align="left">
											<option value="">--------------- Select ---------------</option>
											@if(isset ($data['UnitList']))
												@foreach($data['UnitList'] as $key => $value)
													@if($value->active == 1)
														@php 
														$SelStr = "";
														if(isset($data['UnitWtDescData'])){
																if($data['UnitWtDescData']->std_unitid == $value->unitid){
																$SelStr = 'selected="selected"';
																} 
														}
														@endphp
														<option value="{{$value->unitid}}" {{$SelStr}}>{{$value->unit_name}}</option>
													@endif
												@endforeach
											@endif
										</select>
										</div>
									</div>
									<div class="row">
										<div class="div3 label">
											Reference
										</div>
										<div class="div7">
											<input type="text" name='reference' id='reference' class="tboxclass" maxlength="200" value="@if(isset($data['UnitWtDescData'])){{ $data['UnitWtDescData']->reference }}@endif"></td>
										</div>
									</div>
									<div class="row" >
										<div class="div3 label">
											Unit Conversion
										</div>
										<div class="div2" align="left">
											<div class="inputGroup">
												<input type="radio" class="isappcheck" name='unitcheck' id='unit_yes' Value="Y" @php if(isset($data['UnitWtDescData'])){if($data['UnitWtDescData']->is_unit_conv == 'Y'){ echo "checked=checked"; }} @endphp>
												<label for="unit_yes" style="padding:3px 0px; width:100%; font-size:11px;" class="cboxlabel">&nbsp; YES</label>
											</div>
										</div>
										<div class="div2" align="left" style="padding-left:10px;">
											<div class="inputGroup">
												<input type="radio" class="isappcheck" name='unitcheck' id='unit_no' Value="N" @php if(isset($data['UnitWtDescData'])){if($data['UnitWtDescData']->is_unit_conv == 'N'){ echo "checked=checked"; }} @endphp>
												<label for="unit_no" style="padding:3px 0px; width:100%; font-size:11px;" class="cboxlabel">&nbsp; NO</label>
											</div>
										</div>
									</div>
									@php $LdcExist = 'N'; if(isset($data['UnitWtDescData'])){ if($data['UnitWtDescData']->is_unit_conv == 'Y'){ $LdcExist = 'Y'; } }@endphp
									<div class="row clearrow LdcData @php if($LdcExist == "N"){ echo " hide"; } @endphp"></div>
									<div class="LdcData @php if($LdcExist == "N"){ echo " hide"; } @endphp">
										<div class="row">
											<div class="div3 label">
												Action <span class="reqindi">*</span>
											</div>
											<div class="div7">
												<select name="action" id="action" class="tboxsmclass" align="left">
													<option value="">--------------- Select ---------------</option>
													@if(isset ($data['ActionArr']))
													@foreach($data['ActionArr'] as $key => $value)
													@php 
													$SelStr = "";
													if(isset($data['UnitWtDescData'])){
														if($data['UnitWtDescData']->conv_action == $key){
															$SelStr = 'selected="selected"';
														} 
													}
													@endphp
													<option value="{{ $key }}" {{$SelStr}}>{{ $value }}</option>
													@endforeach
													@endif
												</select>
											</div>
										</div>
										<div class="row">
											<div class="div3 label">
												Factor <span class="reqindi">*</span>
											</div>
											<div class="div7">
												<input type="text" name='factor' id='factor' class="tboxclass numberonly" onKeyPress="return isNumberKey(event,this)" value="@if(isset($data['UnitWtDescData'])){{ $data['UnitWtDescData']->conv_factor }}@endif"></td>
											</div>
										</div>
									</div>
									<div class="row smclearrow"></div>
								</div>
								<div class="row smclearrow"></div>												
								@php $AddUrl = 'admin.ViewUnitWeightDescription'; @endphp
								<div class="row">
									<div class="div12" align="center">
										<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" View " onClick="window.location='{{route($AddUrl)}}'" />
										<input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />
										<input type="hidden" name = "hid_uwdmid" id = "hid_uwdmid" value = "@if(isset($data['UnitWtDescData'])){{ encrypt($data['UnitWtDescData']->uwdmid) }}@endif">									
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
	$("#measure_unit").chosen();
	$("#std_unit").chosen();
});
$(document).ready(function(){
	$("body").on("click","#btn_save", function(event){
		var Description 		= $('#txt_unit_wt_desc').val();
		var Measureweight 		= $('#measure_unit').val();
		var Standardweight		= $('#std_unit').val();
		if(Description == "") {
			BootstrapDialog.alert("Please Enter the Description!");
			event.preventDefault();
			event.returnValue = false;
		}else if(Measureweight == "") {
			BootstrapDialog.alert("Please Select the Measurement Unit!");
			event.preventDefault();
			event.returnValue = false;
		}else if(Standardweight == "") {
			BootstrapDialog.alert("Please Select the Standard Unit!");
			event.preventDefault();
			event.returnValue = false;
		}else if(Standardweight !== Measureweight) {
			var Factor 		= $('#factor').val();
			var Action		= $('#action').val();
			if(Factor == "") {
				BootstrapDialog.alert("Please Select the  Factor!");
				event.preventDefault();
				event.returnValue = false;
			}else if(Action == "") {
				BootstrapDialog.alert("Please Enter the Action!");
				event.preventDefault();
				event.returnValue = false;
			}
		}
	}); 

	$("#measure_unit, #std_unit").on("change", function() {
   	 	var measureUnit = $("#measure_unit").val();
    	var stdUnit = $("#std_unit").val();
		if (measureUnit !== stdUnit) {
			$("#unit_yes").prop("checked", true);
			$(".LdcData").removeClass('hide');
			$("#action").val('');
			$("#factor").val('');
		} else {
			$("#unit_no").prop("checked", true);    
			$(".LdcData").addClass('hide');
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
		}else if (fractLen > 1){
			return false;
		}else{
			return true;
		}
	});


	

	/* $('body').on("change", ".tboxclass" ,function(event){
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
	}); */
});	

</script>
@endsection


