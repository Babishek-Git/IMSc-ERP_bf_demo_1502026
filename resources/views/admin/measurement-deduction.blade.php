@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
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
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Measurement Deduction</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
																	
											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Deduction Keyword <span class="reqindi">*</span> </div>											
											<div class="div9"><input type="text" name="txt_ded_key" id="txt_ded_key" maxlength="25" autocomplete="off" class="tboxclass" value="@if(isset($data['MeasurementDedData'])){{ $data['MeasurementDedData']->ded_desc }}@endif"></div>
											<input type="hidden" name = "hid_mkdid" id = "hid_mkdid" value = "@if(isset($data['MeasurementDedData'])){{ encrypt($data['MeasurementDedData']->mdkid) }}@endif">
											<div class="row smclearrow"></div>  
											@php $AddUrl = 'admin.ViewMeasurementDeduction'; @endphp
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

$("body").on("click","#btn_save", function(event){
	var DedKeyWord = $('#txt_ded_key').val();
	if(DedKeyWord == ""){
		BootstrapDialog.alert("Please enter the Deduction Description!");
		event.preventDefault();
		event.returnValue = false;
	}
});

$('body').on('keypress', ".textonly", function(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (!(charCode >= 65 && charCode <= 90) &&   
        !(charCode >= 97 && charCode <= 122) && 
        charCode !== 32) {                     
        return false;
    } else {
        return true;
    }
});




</script>

@endsection
