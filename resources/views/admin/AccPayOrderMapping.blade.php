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
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Accounts Section Pay Order Mapping</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
                                            <div class="div3 label">Account Section <span class="reqindi">*</span></div>											
											<div class="div9">
											<select name="account_sec" id="account_sec" class="textboxdisplay" style="width:500px;height:30px">
												<option value="">--------------- Select ---------------</option>
                                                @php
                                                    if(isset($data['results'])){
														foreach($data['results'] as $key=>$value){
															$SelStr = "";
															if(isset($data['ShowAccSecPayOrderData'])){
																if($data['ShowAccSecPayOrderData']->office_id == $value->office_id){
																	$SelStr = 'selected="selected"';
																}
															}
                                                    	@endphp
												    		<option value="{{ $value->office_id }}"  data-office-name="{{ $value->office_name }}" data-office-short-name="{{ $value->office_short_name }}" {{$SelStr}}>{{ $value->office_name }}</option>
                                                    	@php
														}
                                                    } 
                                                @endphp
											</select>
								
											</div>
                                            <div class="div3 label">Project Code </div>											
											<div class="div9"><input type="text" name="project_code" id="project_code" maxlength="10" class="tboxclass alphanumeric" value="@if(isset($data['ShowAccSecPayOrderData'])){{$data['ShowAccSecPayOrderData']->cov_doc_proj_code }} @endif" style="width:500px"></div>
											<div class="row smclearrow"></div>                                                                                											
											
											<div class="div3 label">Division Code </div>											
											<div class="div9"><input type="text" name="division_code" id="division_code" maxlength="10" class="tboxclass" value="@if(isset($data['ShowAccSecPayOrderData'])){{ $data['ShowAccSecPayOrderData']->cov_doc_div_code }} @endif" style="width:500px" ></div>
											
											<input type="hidden" name="accountsecid" id="accountsecid" value="@if(isset($data['ShowAccSecPayOrderData'])){{ $data['ShowAccSecPayOrderData']->acc_sec_id }} @endif">																														
											<div class="row smclearrow"></div>
											
											<input type="hidden" name="acc_office_name" id="acc_office_name" value="@if(isset($data['ShowAccSecPayOrderData'])){{$data['ShowAccSecPayOrderData']->section_full_name }} @endif">
											<input type="hidden" name="acc_office_short_name" id="acc_office_short_name" value="@if(isset($data['ShowAccSecPayOrderData'])){{$data['ShowAccSecPayOrderData']->section_name }} @endif">
											@php $AddUrl = 'admin.ViewAccPayOrderMapping';  @endphp
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
		$("#account_sec").chosen();
	});

	$('body').on("change","#account_sec", function(event){
		var selectedOption = $(this).find('option:selected');
		var AccSecOffName = $(selectedOption).attr("data-office-name");
		var AccSecShortName = $(selectedOption).attr("data-office-short-name");
		$("#acc_office_name").val(AccSecOffName);
		$("#acc_office_short_name").val(AccSecShortName);
	});

$("body").on("click","#btn_save", function(event){
	var AccSecName = $('#account_sec').val();
	var ProjCode = $('#project_code').val();
	var DiviCode = $('#division_code').val();
	if(AccSecName == ""){
		BootstrapDialog.alert("Please select the Account Section Name!");
		event.preventDefault();
		event.returnValue = false;
	}
});


</script>

@endsection