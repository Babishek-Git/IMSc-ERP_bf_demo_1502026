@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
if(isset($data['DevLimData'])){
	foreach($data['DevLimData'] as $Data){
		$DeviationId = $Data->dqlid;
		$DivisionName = $Data->office_name;
		$DivisionId = $Data->division_code;
		$DeviationPer = $Data->dev_limit; 
	}
	
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
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Deviation Limit</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
																
											<div class="row smclearrow"></div> 
											<div class="div2">&nbsp;</div>                                                                              											
											<div class="div2 label">Division <span class="reqindi">*</span></div>
											<div class="div4">
												<select class="group tboxclass" name="cmb_division" id="cmb_division">
													<option value="">---------- Select ----------</option>													
													@if(isset($data['OfficeList']))
														@foreach($data['OfficeList'] as $key => $value)
															@if((session('WcmsRoleGroupCode') == 'ADMUSER' && $value->office_id == session('WcmsEmpDiv') && $value->active == 1) || (session('WcmsRoleGroupCode') == 'ACCADMUSER' && $value->office_id == session('WcmsEmpDiv') && $value->active == 1) || (session('WcmsRoleGroupCode') == 'SUPUSER' && $value->active == 1))
																@php
																if((isset($DivisionId))&&($DivisionId == $value->office_id)){
																	$SelStr = "selected='selected'";
																}else{
																	$SelStr = '';
																}
																@endphp
																@if($value->active == 1)
																	<option value="{{$value->office_id}}" {{ $SelStr }}>{{$value->office_name}}</option>
																@endif
															@endif
														@endforeach
													@endif													
												</select>
											</div> 
											<div class="row smclearrow"></div>
											<div class="div2">&nbsp;</div>
                                            <div class="div2 label">Percentage<span class="reqindi">*</span></div>											
											<div class="div4"><input type="text" name="txt_dev_per" id="txt_dev_per" class="tboxclass" value="@if(isset($DeviationPer)){{$DeviationPer}}@endif"></div>
											<div class="row smclearrow"></div>
											@php $AddUrl = 'admin.ViewDeviationLimit'; @endphp
											<div class="row">
												<div class="div12" align="center">
												<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" View " onClick="window.location='{{route($AddUrl)}}'" />
												<input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />
												<input type="hidden" name="hid_dev_id" id="hid_dev_id" value="@if(isset($DeviationId)){{$DeviationId}}@endif" />									
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
$('#cmb_division').chosen();	

$(document).ready(function(){
	$("body").on("click","#btn_save", function(event){
		var DivisionName = $('#cmb_division').val();
		var DeviationLimitPer = $('#txt_dev_per').val();
		if(DivisionName == ""){
			BootstrapDialog.alert("Please select the Division Name!");
			event.preventDefault();
			event.returnValue = false;
		}
		else if(DeviationLimitPer == "") {
			BootstrapDialog.alert("Please enter the Deviation Limit Percentage!");
			event.preventDefault();
			event.returnValue = false;
		}
	});
	$("body").on("change","#cmb_division", function(event){
		var DivisionName = $('#cmb_division').val();
		/// Commented because of route not found. after route created it should be enabled
		/*$.ajax({ 
			type: 'POST', 
			url: "{{-- route('ajax.DeviationCheck') --}}", 
			data: { '_token': '{{ csrf_token() }}', 'Division': DivisionName, }, 
			success: function (data) {  
				if(data == 1){					
					BootstrapDialog.alert("Deviation Limit already created");
					$('#cmb_division').val('').trigger('chosen:updated');					
				}
			}
		}); */
	});
	$('#txt_dev_per').on('keypress', function(event) {
        var keyCode = event.which;
        if (keyCode < 48 || keyCode > 57) {
            event.preventDefault();
        }
    });

    $('#txt_dev_per').on('input', function() {
        var value = $(this).val();
        if (value < 1 || value > 100) {
            $(this).val(value.slice(0, -1));
        }
    });
	
});

</script>

@endsection