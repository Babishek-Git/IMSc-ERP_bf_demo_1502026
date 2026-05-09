@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php
if(isset($data['OfficeMappingData'])){  
	$IsMappAcc = $data['OfficeMappingData']->is_accounts_mapping;
}
@endphp
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="" method="post" enctype="multipart/form-data" name="form">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row ">
								<div class="div2">&nbsp;</div>
								<div class="div8 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Office Mapping</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
																	
											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">From Office Name <span class="reqindi">*</span></div>											
											<div class="div9">
												<input type="hidden" name = "hid_ofc_mapid" id = "hid_ofc_mapid" value = "@if(isset($data['OfficeMappingData'])){{ encrypt($data['OfficeMappingData']->omapid) }}@endif">
												<select name="cmb_from_office" id="cmb_from_office" class="textboxdisplay" style="width:500px;height:30px">
													<option value="">--------------- Select ---------------</option>
													@if(isset ($data['OfficeList']))
														@foreach($data['OfficeList'] as $key => $value)
															@if($value->active == 1)
																@php 
																$SelStr = "";
																if(isset($data['OfficeMappingData'])){
																	if($data['OfficeMappingData']->office_id == $value->office_id){
																		$SelStr = 'selected="selected"';
																	} 
																}
																@endphp
																<option value="{{$value->office_id}}" {{$SelStr}}>{{$value->office_name}} - ( {{$value->org_name}} )</option>
															@endif
														@endforeach
													@endif
												</select>
											</div>
											<div class="row smclearrow"></div>  
											<div class="div3 label">Office Map to <span class="reqindi">*</span></div>											
											<div class="div9">
												<select name="cmb_office_map_to" id="cmb_office_map_to" class="textboxdisplay" style="width:500px;height:30px">
													<option value="">--------------- Select ---------------</option>
													@if(isset ($data['OfficeList']))
														@foreach($data['OfficeList'] as $key => $value)
															@if($value->active == 1)
																@php 
																$SelStr = "";
																if(isset($data['OfficeMappingData'])){
																	if($data['OfficeMappingData']->office_map_to == $value->office_id){
																		$SelStr = 'selected="selected"';
																	} 
																}
																@endphp
																<option value="{{$value->office_id}}" {{$SelStr}}>{{$value->office_name}} - ({{$value->org_name}})</option>
															@endif
														@endforeach
													@endif
												</select>
											</div>
											<div class="row smclearrow"></div>  
											<div class="div3 label">Is Mapping With Accounts?</div>											
											<div class="div9 label">
												<input type="checkbox" name="chk_is_map_acc" id="chk_is_map_acc" value="Y" @if(isset($IsMappAcc)){{ ($IsMappAcc =="Y")? "checked" : "" }}@endif/>
												<label for="chk_is_map_acc">Click here if office map to accounts section</label>	
											</div>
											<div class="row smclearrow"></div> 
											@php $AddUrl = 'admin.ViewOfficeMapping'; @endphp
											<div class="row">
												<div class="div12" align="center">
												<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" View " onClick="window.location='{{route($AddUrl)}}'" />
												<input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />									
												<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
												</div>		
											</div>
											<div class="row smclearrow"></div>  
										</div>
									</div>										
								</div>
							</div>                           
						</div>
					</blockquote>
				</div>
			</div>
		</div>
	</form>
</body>


<script>
	$("#cmb_from_office").chosen();
	$("#cmb_office_map_to").chosen();
	$(document).ready(function() {
        $('#cmb_from_office, #cmb_office_map_to').change(function() {
            var SelectedFromOffice = $('#cmb_from_office').val();
            var SelectedOfficeMapTo = $('#cmb_office_map_to').val();
            if (SelectedFromOffice !== '' && SelectedOfficeMapTo !== '' && SelectedFromOffice === SelectedOfficeMapTo) {
				BootstrapDialog.alert("Sorry..Cannot choose the same office for both 'From Office Name' and 'Office Map to Name'");
				event.preventDefault();
				event.returnValue = false;
                $('#cmb_office_map_to').val('');
            }
        });
    });
	$("body").on("click","#btn_save", function(event){
		var FromOffice = $('#cmb_from_office').val();
		var ToOffice = $('#cmb_office_map_to').val();
		if(FromOffice == ""){
			BootstrapDialog.alert("Please Select From Office Name!");
			event.preventDefault();
			event.returnValue = false;
		}else if(ToOffice == ""){
			BootstrapDialog.alert("Please Select Office Map to!");
			event.preventDefault();
			event.returnValue = false;
		}
	});
</script>

@endsection