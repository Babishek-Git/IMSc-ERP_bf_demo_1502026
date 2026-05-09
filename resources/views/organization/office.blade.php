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
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Office Creation</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
																	
											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Office Name <span class="reqindi">*</span></div>											
											<div class="div9"><input type="text" name="txt_office_name" id="txt_office_name" maxlength="100" class="tboxclass" value="@if(isset($data['OfficeData'])){{ $data['OfficeData']->office_name }}@endif"></div>
											<div class="div3 label">Office Short Name <span class="reqindi">*</span></div>											
											<div class="div9"><input type="text" name="txt_off_short_name" id="txt_off_short_name" maxlength="40" class="tboxclass" value="@if(isset($data['OfficeData'])){{ $data['OfficeData']->office_short_name }}@endif"></div>
											<input type="hidden" name = "office_id" id = "office_id" value = "@if(isset($data['OfficeData'])){{ encrypt($data['OfficeData']->bank_id) }}@endif">
											<div class="row smclearrow"></div>  
											@php $AddUrl = 'organization.ViewOffice'; @endphp 										
											<div class="row">
												<div class="div12" align="center">
												<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" View " onClick="window.location='{{route($AddUrl)}}'" />
												<input type="submit" class="step-btn" name="btn_save" id="btn_save" value=" Save " />									
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
	var OfficeName = $('#txt_office_name').val();
	var OfficeshtName = $('#txt_off_short_name').val();
	if(OfficeName == ""){
		BootstrapDialog.alert("Please enter the Office  Name!");
		event.preventDefault();
		event.returnValue = false;
	}else if(OfficeshtName == ""){
		BootstrapDialog.alert("Please enter the Office Short Name!");
		event.preventDefault();
		event.returnValue = false;
	}
});





</script>

@endsection
