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
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Modules</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
																	
											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Module Name</div>											
											<div class="div9"><input type="text" name="module_name" id="module_name" maxlength="50" class="tboxclass" value="@if(isset($data['ModuleData'])){{ $data['ModuleData']->module_name }}@endif" autocomplete="off"></div>
											<input type="hidden" name = "module_id" id = "module_id" value = "@if(isset($data['ModuleData'])){{ encrypt($data['ModuleData']->moduleid) }}@endif">
											<div class="row smclearrow"></div>  
											@php $AddUrl = 'admin.ModulesView'; @endphp
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
	var UnitName = $('#txt_bankinstrument_name').val();
	if(UnitName == ""){
		BootstrapDialog.alert("Please enter the Bank Instrument Name!");
		event.preventDefault();
		event.returnValue = false;
	}
});
$('body').on("change", ".tboxclass" ,function(event){
		var UnitName = $('#txt_bankinstrument_name').val();
		var HidId = $('#hid_unitid').val();	
		$.ajax({
			type: 'PODT',
			url: "{{ route('ajax.DuplicateUnit') }}",
			data: {'_token': '{{ csrf_token() }}', 'UnitName': UnitName},
			success: function(data){ 
				if(HidId == null){
					if(data>0) {
                		BootstrapDialog.alert("Bank Instrument already exists!");
            		}
				}
			}
		});
	});


</script>

@endsection
