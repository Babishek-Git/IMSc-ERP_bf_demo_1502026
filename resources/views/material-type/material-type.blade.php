@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php

 if(isset($data['EditMaterialTypeData'])){
	
	$EditMaterialTypeData = $data['EditMaterialTypeData'];
	$MaterialTypeCode     = collect($EditMaterialTypeData)->pluck('material_type_code')->first();
	$MaterialTypeName     = collect($EditMaterialTypeData)->pluck('material_type_name')->first();
	$Description          = collect($EditMaterialTypeData)->pluck('description')->first();
	$MaterialId 		  = collect($EditMaterialTypeData)->pluck('material_type_id')->first();
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
							<div class="row plr">
								<div class="div5">
									<div class="form-box">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Material Type Master</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<div class="div3 label">Material Code <span class="reqindi">*</span></div>
												<div class="div9"><input type="text" name="txt_material_code" id="txt_material_code" class="tboxclass" value="@if(isset($MaterialTypeCode)){{$MaterialTypeCode}}@endif"></div>
												<div class="row smclearrow"></div>
												<div class="div3 label">MaterialType <span class="reqindi">*</span> </div>
												<div class="div9"><input type="text" name="txt_material_type" id="txt_material_type" class="tboxclass" value="@if(isset($MaterialTypeName)){{$MaterialTypeName}}@endif"></div>
												@php $AddUrl = 'roles.ViewRoleMaster'; @endphp										
												<div class="row">
													<div class="div12" align="center">
														<!-- <input type="button" class="backbutton" name="btn_view" id="btn_view" value=" View " onClick="window.location='{{route($AddUrl)}}'" /> -->
														<input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />	
														<input type="hidden" name="hid_material_id" id="csrf-hid_material_id" value="@if(isset($MaterialId)){{$MaterialId}}@endif" />
														<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
													</div>		
												</div>
												<div class="row smclearrow"></div>  
											</div>
										</div>										
									</div>
								</div>

								<div class="div7">
									<div class="table-box">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row table-divhead" align="center">Material Type Master</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<table class="table-bordered table1" width="99%" align="center" id="dataTable">
													<thead>
														<tr class="note heading">
															<th  style="text-align:center">SNo.</th>
															<th  style="text-align:center">Material Code</th>
															<th  style="text-align:center">MaterialType </th>
															<th  style="text-align:center">Action</th>
														</tr>
													</thead>
													<tbody>
													@if(isset($data['MaterialtypeData']))
														@foreach($data['MaterialtypeData'] as $MaterialtypeData)
														
															<tr>
																<td align="center">{{$loop->iteration }} </td>
																<td align="left">{{ $MaterialtypeData->material_type_code }}</td>
																<td align="left">{{ $MaterialtypeData->material_type_name }}</td>
																<td><button type="button" name="btn_edit" class="btn btn-default tuploadbtn" id="btn_edit" value=" Edit" onclick="window.location='{{ route('material-type.material-type',['id'=>encrypt($MaterialtypeData->material_type_id)]) }}'"> <i class='fa fa-edit'></i> Edit </button></td>

															</tr>
														@endforeach
													@endif
													</tbody>
												</table>
												
											</div>
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
<script type="text/javascript" language="javascript">
	$("#txt_role_group").chosen();
	$('#dataTable').DataTable({
		responsive: true,
		paging: true, 
	});														
	var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var RoleName   		= $("#txt_role_name").val();
			var RoleGroup 		= $("#txt_role_group").val();

			if(RoleName == ""){
				BootstrapDialog.alert("Role Name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(RoleGroup == ""){
				BootstrapDialog.alert("User Group Name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure want to Save Material Master ?',
					closable: false, // <-- Default value is false
					draggable: false, // <-- Default value is false
					btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
					btnOKLabel: 'Ok', // <-- Default value is 'OK',
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
