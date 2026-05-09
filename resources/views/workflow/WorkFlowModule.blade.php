@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

	<form action="" method="post" enctype="multipart/form-data" name="form" >
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row ">
								<div class="div2">&nbsp;</div>
								<div class="div8 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Work Flow Module</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
																	
											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Work Flow Code <span class="reqindi">*</span></div>											
											<div class="div9"><input type="text" name="work_flow_code" id="work_flow_code" maxlength="50" class="tboxclass textonly" value="@if(isset($data['WorkFlowData'])){{ $data['WorkFlowData']->wf_module_code }}@endif"></div>
											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Work Flow Module Name <span class="reqindi">*</span></div>											
											<div class="div9"><input type="text" name="work_flow_module_name" id="work_flow_module_name" maxlength="50" class="tboxclass" value="@if(isset($data['WorkFlowData'])){{ $data['WorkFlowData']->wf_module_name }}@endif"></div>
											<input type="hidden" name = "wf_moduleid" id = "wf_moduleid" value = "@if(isset($data['WorkFlowData'])){{ encrypt($data['WorkFlowData']->wf_moduleid) }}@endif">
											<div class="row smclearrow"></div> 
											<div class="div3 label">
												Work Flow Module Group Code <span class="reqindi">*</span>
											</div>
											<div class="div9">
												<select name="work_flow_group_code" id="work_flow_group_code" class="textboxdisplay" style="width: 250px; height: 30px">
													<option value="">--------- Select ------</option>
														@php
															$selUserModule = '';
															$selAccountModule = '';

															if (isset($data['WorkFlowData'])) {
																if ($data['WorkFlowData']->wf_module_group_code == 'USRMOD') {
																	$selUserModule = 'selected="selected"';
																} elseif ($data['WorkFlowData']->wf_module_group_code == 'ACCMOD') {
																	$selAccountModule = 'selected="selected"';
																}
															}
														@endphp
														@if(session('WcmsRoleGroupCode') == 'SUPUSER')
															<option value="USRMOD" {{ $selUserModule }}>User Module</option>
															<option value="ACCMOD" {{ $selAccountModule }}>Account Module</option>
														@else
															@if(session('WcmsRoleGroupCode') == 'ADMUSER')
																<option value="USRMOD" {{ $selUserModule }}>User Module</option>
															@elseif(session('WcmsRoleGroupCode') == 'ACCADMUSER')
																<option value="ACCMOD" {{ $selAccountModule }}>Account Module</option>
															@endif
														@endif
												</select>
											</div>


											<!-- <div class="div3 label">
												Division <span class="reqindi">*</span>
											</div>
											<div class="div9">
												<select name="txt_division" id="txt_division" class="textboxdisplay" style="width:250px;height:30px">
													<option value="">--------- Select ------</option>
													@if(isset($data['OfficeList']))
														@foreach($data['OfficeList'] as $key => $value)
															@if((session('WcmsRoleGroupCode') == 'ADMUSER' && $value->office_id == session('WcmsEmpDiv') && $value->active == 1) || (session('WcmsRoleGroupCode') == 'ACCUSER' && $value->office_id == session('WcmsEmpDiv') && $value->active == 1) || (session('WcmsRoleGroupCode') == 'SUPUSER' && $value->active == 1))
																@php
																	$SelStr = '';
																	if(isset($data['WorkFlowData']) && $data['WorkFlowData']->division_code == $value->office_id) {
																		$SelStr = 'selected="selected"';
																	}
																@endphp
																<option value="{{ $value->office_id }}" {{ $SelStr }}>{{ $value->office_name }}</option>
															@endif
														@endforeach
													@endif
												</select>
											</div> -->

											<div class="row smclearrow"></div> 
											@php $AddUrl = 'workflow.ViewWorkFlow'; @endphp
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

<script>

$('#work_flow_group_code').chosen();

$(document).ready(function(){
	$("#work_flow_code").on("input", function() {
		var inputValue = $(this).val().toUpperCase();
		$(this).val(inputValue);
	});
	$("#workflow-form").on("submit", function(event) {
		var inputValue = $("#work_flow_code").val().toUpperCase();
		$("#work_flow_code").val(inputValue);
	});
	$("body").on("click","#btn_save", function(event){
		var WorkFlowCode	    = $('#work_flow_code').val();
		var WorkFlowName 		= $('#work_flow_module_name').val();
		if(WorkFlowCode == ""){
			BootstrapDialog.alert("Please Enter the Work Flow Code!");
			event.preventDefault();
			event.returnValue = false;
		}
		else if(WorkFlowName == "") {
			BootstrapDialog.alert("Please Enter Work Flow Name!");
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
});

</script>

@endsection
