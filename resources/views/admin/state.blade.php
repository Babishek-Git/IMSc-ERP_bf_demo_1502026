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
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">State Entry</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
																	
											<div class="row smclearrow"></div>                                                                                											
											<div class="row">
												<div class="div3 label">
													State Name <span class="reqindi">*</span>
												</div>
												<div class="div7">
													<input type="text" name='state_name' id='state_name' class="tboxclass" value="@if(isset($data['StateData'])){{ $data['StateData']->state_name }}@endif">
													<input type="hidden" name = "state_id" id = "state_id" value = "@if(isset($data['StateData'])){{ encrypt($data['StateData']->state_id) }}@endif">
												</div>
											</div>
											<div class="row">
												<div class="div3 label">
													State Code <span class="reqindi">*</span>
												</div>
												<div class="div7">
													<input type="text" name='txt_state_code' id='txt_state_code' class="tboxclass" maxlength="2"  value="@if(isset($data['StateData'])){{ $data['StateData']->state_code }}@endif">
													<span class="validation-message" style="color: red; font-size: 12px;">(MH,TN,AP)</span>
												</div>
											</div>
											<div class="row">
												<div class="div3 label">
													State GST Code <span class="reqindi">*</span>
												</div>
												<div class="div7">
													<input type="text" name='txt_state_gst_code' id='txt_state_gst_code' class="tboxclass" maxlength="3" value="@if(isset($data['StateData'])){{ $data['StateData']->gst_code }}@endif">
													<span class="validation-message" style="color: red; font-size: 12px;">(First two digit of GST No.)</span>
												</div>
											</div>
											<div class="row smclearrow"></div>  
											@php $AddUrl = 'admin.viewstate'; @endphp
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
		$(".tboxclass").next(".validation-message").hide();
		$(".tboxclass").on("focus", function() {
			$(this).next(".validation-message").show();
		});
		$(".tboxclass").on("blur", function() {
			$(this).next(".validation-message").hide(); 
		});
	});

	$(document).ready(function() {
		$("#txt_state_code").on("input", function() {
			$(this).val($(this).val().toUpperCase());
		});
	});

	$("body").on("change","#txt_state_gst_code", function(event){
		var GstCode = $('#txt_state_gst_code').val(); 
		$.ajax({ 
			type: 'POST', 
			url: "{{ route('ajax.StateGSTCode') }}",
			data: ({'_token': '{{ csrf_token() }}','GstCode': GstCode}), 
			success: function (data) { 		
				if (data > 0 ) {
					BootstrapDialog.alert("Sorry.. State GST Code Already Exists");
					$("#txt_state_gst_code").val('');
				}else {
					return false;
				}
			}
		});
	});
	var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var StateName   	= $("#state_name").val();
			var StateCode  		= $("#txt_state_code").val();
			var StateGstCode 	= $("#txt_state_gst_code").val();

			if(StateName == ''){
				BootstrapDialog.alert("State Name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(StateCode == ''){
				BootstrapDialog.alert("State Code should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(StateGstCode == ''){
				BootstrapDialog.alert("State GST Code should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure want to save State Details ?',
					closable: false, 
					draggable: false,
					btnCancelLabel: 'Cancel', 
					btnOKLabel: 'Ok', 
					callback: function(result) {
						if(result){
							KillEvent = 1;
							$("#btn_save").trigger( "click" );
						}else {
							KillEvent = 0;
						}
					}
				});
			}
		}
	});

</script>

@endsection
