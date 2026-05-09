@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php

 if(isset($data['EditCategoryData'])){
	
	$EditCategoryData = $data['EditCategoryData'];
	$CategoryCode     = collect($EditCategoryData)->pluck('emp_category_code')->first();
	$CategoryType     = collect($EditCategoryData)->pluck('emp_category')->first();
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
								<!-- <div class="div2">&nbsp;</div> -->
								<div class="div5">
								<div class="form-box">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Employee Category</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
																	
											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Category Code <span class="reqindi">*</span></div>
											<div class="div9"><input type="text" name="txt_cate_code" id="txt_cate_code" class="tboxsmclass" value="@if(isset($CategoryCode)){{$CategoryCode}}@endif"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Category Name<span class="reqindi">*</span></div>
											<div class="div9"><input type="text" name="txt_cate_name" id="txt_cate_name" class="tboxsmclass" value="@if(isset($CategoryType)){{$CategoryType}}@endif"></div>
											<div class="row smclearrow"></div>
											
											
											
											@php $AddUrl = 'roles.ViewRoleMaster'; @endphp										
											<div class="row">
												<div class="div12" align="center">
													<button type="submit" class="step-btn" name="btn_save" id="btn_save" value=" Save">Save</button>		
													<input type="hidden" name="hid_cate_id" id="csrf-hid_cate_id" value="@if(isset($CategoryCode)){{$CategoryCode}}@endif" />								
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
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row table-divhead" align="center">Employee Category List</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<table class="table-bordered table1" width="99%" align="center" id="dataTable">
													<thead>
														<tr class="note heading">
															<th  style="text-align:center">SNo.</th>
															<th  style="text-align:center">Category Code</th>
															<th  style="text-align:center">Category Name</th>
															<th  style="text-align:center">Action</th>
														</tr>
													</thead>
													<tbody>
													@if(isset($data['EmployeecateData']))
														@foreach($data['EmployeecateData'] as $EmployeecateData)
															<tr>
																<td align="center">{{ $loop->iteration }} </td>
																<td align="left">{{ $EmployeecateData->emp_category_code }}</td>
    															<td align="left">{{ $EmployeecateData->emp_category }}</td>
																<td><button type="button" name="btn_edit" class="btn btn-default tuploadbtn" id="btn_edit" value=" Edit" onclick="window.location='{{ route('EmployeeCategory.EmployeeCategory',['id'=>encrypt($EmployeecateData->emp_category_code)]) }}'"> <i class='fa fa-edit'></i> Edit </button></td>
																<td align="center"></td>
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
	//$("#txt_division").chosen();
	//$("#txt_role_group").chosen();
	$('#dataTable').DataTable({
		responsive: true,
		paging: true, 
	});
	
	var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var CategoryCode  	= $("#txt_cate_code").val();
			var CategoryName   	= $("#txt_cate_name").val();
		//	var RoleGroup 		= $("#txt_role_group").val();

			if(CategoryCode == ""){
				BootstrapDialog.alert("Category Code  should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(CategoryName == ""){
				BootstrapDialog.alert("Category Code should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}/* else if(RoleGroup == ""){
				BootstrapDialog.alert("User Group Name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			} */else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure want to Employee Category ?',
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
