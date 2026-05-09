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
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Item Unit</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div3">
													<label for="">Unit Full Name <span class="reqindi">*</span></label>
												</div>
												<div class="div9">
													<input type="text" name="txt_unit_fullname" id="txt_unit_fullname" maxlength="50" class="tboxclass" value="@if(isset($data['UnitData'])){{ $data['UnitData']->unit_fname }}@endif">                                                                               											
												</div>
												<div class="div3">
													<label for="">Unit Short Name <span class="reqindi">*</span></label>
												</div>
												<div class="div9">
													<input type="text" name="txt_unit_name" id="txt_unit_name" maxlength="50" class="tboxclass" value="@if(isset($data['UnitData'])){{ $data['UnitData']->unit_name }}@endif">												</div>
													<input type="hidden" name = "hid_unitid" id = "hid_unitid" value = "@if(isset($data['UnitData'])){{ encrypt($data['UnitData']->unitid) }}@endif">
												</div>
												<div class="div3">
													<label for="">Measurement Format</label>
												</div>
												<div class="div9">
													<input type="checkbox" name="measurement_format[]" id="lbd" value="LBD" @if(isset($data['UnitData']) && in_array('LBD', explode(',', $data['UnitData']->meas_format))) checked @endif>&nbsp;<label for="lbd">LBD</label>&emsp;&emsp;
													<input type="checkbox" name="measurement_format[]" id="lb" 	value="LB" @if(isset($data['UnitData']) && in_array('LB', explode(',', $data['UnitData']->meas_format))) checked @endif>&nbsp;<label for="lb">LB</label>&emsp;&emsp;
													<input type="checkbox" name="measurement_format[]" id="bd" 	value="BD" @if(isset($data['UnitData']) && in_array('BD', explode(',', $data['UnitData']->meas_format))) checked @endif>&nbsp;<label for="bd">BD</label>&emsp;&emsp;
													<input type="checkbox" name="measurement_format[]" id="ld" 	value="LD" @if(isset($data['UnitData']) && in_array('LD', explode(',', $data['UnitData']->meas_format))) checked @endif>&nbsp;<label for="ld">LD</label>&emsp;&emsp;
													<input type="checkbox" name="measurement_format[]" id="l" 	value="L" @if(isset($data['UnitData']) && in_array('L', explode(',', $data['UnitData']->meas_format))) checked @endif>&nbsp;<label for="l">L</label>&emsp;&emsp;
													<input type="checkbox" name="measurement_format[]" id="b" 	value="B" @if(isset($data['UnitData']) && in_array('B', explode(',', $data['UnitData']->meas_format))) checked @endif>&nbsp;<label for="b">B</label>&emsp;&emsp;
													<input type="checkbox" name="measurement_format[]" id="d" 	value="D" @if(isset($data['UnitData']) && in_array('D', explode(',', $data['UnitData']->meas_format))) checked @endif>&nbsp;<label for="d">D</label>&emsp;&emsp;
													<input type="checkbox" name="measurement_format[]" id="we" value="WE" @if(isset($data['UnitData']) && in_array('WE', explode(',', $data['UnitData']->meas_format))) checked @endif>&nbsp;<label for="we">WE</label>&emsp;&emsp;
													<input type="checkbox" name="measurement_format[]" id="lwe" value="LWE" @if(isset($data['UnitData']) && in_array('LWE', explode(',', $data['UnitData']->meas_format))) checked @endif>&nbsp;<label for="lwe">LWE</label>&emsp;&emsp;
													<input type="checkbox" name="measurement_format[]" id="bwe" value="BWE" @if(isset($data['UnitData']) && in_array('BWE', explode(',', $data['UnitData']->meas_format))) checked @endif>&nbsp;<label for="bwe">BWE</label>&emsp;&emsp;
													<input type="checkbox" name="measurement_format[]" id="lbwe" value="LBWE" @if(isset($data['UnitData']) && in_array('LBWE', explode(',', $data['UnitData']->meas_format))) checked @endif>&nbsp;<label for="lbwe">LBWE</label>
												</div>
											</div>
											<div class="row smclearrow"></div> 
											<div class="row">
												<div class="div3">&nbsp;</div>
												<div class="div9">
													<div>L = Length, B = Breadth, D = Depth, WE = Weight</div>
												</div>
											</div> 
											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div3">
												&nbsp;&nbsp;<label>Non-decimal Unit <br>(Example : Nos, Each,...,etc.)</label>
												</div>
												<div class="div9">
												&nbsp;<input type="checkbox" name="is_non_decimal_unit" id="is_non_decimal_unit" value="Y" @if(isset($data['UnitData']) && $data['UnitData']->is_non_decimal_unit == "Y") checked @endif>&nbsp;<label for="is_non_decimal_unit"></label>&emsp;&emsp;
												</div> 
											</div> 
											<div class="row">
											@php $AddUrl = 'admin.ViewUnits'; @endphp
											<div class="row">
												<div class="div12" align="center">
												<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" View " onClick="window.location='{{route($AddUrl)}}'" />
												<input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />									
												<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
												</div>		
											</div>
											
											<div class="row smclearrow">&nbsp;</div>  
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
	var UnitSName = $('#txt_unit_name').val();
	var UnitFName = $('#txt_unit_fullname').val();
	if(UnitFName == ""){
		BootstrapDialog.alert("Please enter the Unit Full Name!");
		event.preventDefault();
		event.returnValue = false;
	}else if(UnitSName == ""){
		BootstrapDialog.alert("Please enter the Unit Short Name!");
		event.preventDefault();
		event.returnValue = false;
	}
});
$('body').on("change", ".tboxclass" ,function(event){
		var UnitName = $('#txt_unit_name').val();
		var HidId = $('#hid_unitid').val();	
		$.ajax({
			type: 'POST',
			url: "{{ route('ajax.DuplicateUnit') }}",
			data: {'_token': '{{ csrf_token() }}', 'UnitName': UnitName},
			success: function(data){ 
				if(HidId == null){
					if(data>0) {
                		BootstrapDialog.alert("Unit already exists!");
            		}
				}
			}
		});
	});


</script>

@endsection
