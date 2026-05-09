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
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Compliance Master</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
																	
											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Compliance <span class="reqindi">*</span></div>											
											<div class="div9"><input type="text" name="txt_compliance" id="txt_compliance" maxlength="3000" class="tboxclass textonly" value="@if(isset($data['ComplianceData'])){{ $data['ComplianceData']->compliance_content }}@endif"></div>
                                            <div class="row smclearrow"></div>  
                                            <div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Compliance for <span class="reqindi">*</span></div>											
											<div class="div9">
											<select name="opt_compliance_for" id="opt_compliance_for" class="textboxdisplay" style="width:500px;height:30px">
												<option value="">--------------- Select ---------------</option>
												@php
												$SelStr1 = NULL;
												$SelStr2 = NULL;
												if(isset($data['ComplianceData'])){
													$ComplianceData = $data['ComplianceData'];
													if($ComplianceData->compliance_for == "ACCO"){
														$SelStr1 = 'selected="selected"';
													}
													else if($ComplianceData->compliance_for == "USER"){
														$SelStr2 = 'selected="selected"';
													}
												}
												@endphp
												<option value="ACCO" {{$SelStr1}}>Accounts</option>
												<option value="USER" {{$SelStr2}}>User</option>
											</select>
											</div>
											<input type="hidden" name = "compliance_id" id = "compliance_id" value = "@if(isset($data['ComplianceData'])){{ encrypt($data['ComplianceData']->comasid) }}@endif">																														
											@php $AddUrl = 'admin.ComplianceMasterView'; @endphp
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

$(document).ready(function() {
	$("#opt_compliance_for").chosen();
});
$("body").on("click","#btn_save", function(event){
	var Compliance = $('#txt_compliance').val();
	var ComplianceFor = $('#opt_compliance_for').val();
	if(Compliance == ""){
		BootstrapDialog.alert("Please enter the Compliance!");
		event.preventDefault();
		event.returnValue = false;
	}
    else if(ComplianceFor == ""){
		BootstrapDialog.alert("Please select the Compliance for!");
		event.preventDefault();
		event.returnValue = false;
	}
});

</script>

@endsection
