@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php

 if(isset($data['EditEmployeeData'])){
	
	$EditEmployeeData = $data['EditEmployeeData'];
	$EmpCode = collect($EditEmployeeData)->pluck('emp_type_code')->first();
	$EmpType = collect($EditEmployeeData)->pluck('emp_type')->first();
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
								<div class="div5 mbtable">
								<!-- <div class="form-box"> -->
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Employee Type</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
																	
											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Employee Type Code<span class="reqindi">*</span></div>
											<div class="div9"><input type="text" name="txt_emptype_code" id="txt_emptype_code" class="tboxclass" value="@if(isset($EmpCode)){{$EmpCode}}@endif"></div>
											<div class="row smclearrow"></div>

											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Employee Type<span class="reqindi">*</span></div>
											<div class="div9"><input type="text" name="txt_emptype_name" id="txt_emptype_name" class="tboxclass" value="@if(isset($EmpType)){{$EmpType}}@endif"></div>
											<div class="row smclearrow"></div>
											
											
											
											@php $AddUrl = 'roles.ViewRoleMaster'; @endphp										
											<div class="row">
												<div class="div12" align="center">
													<input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />
													<input type="hidden" name="hid_emptype_code" id="csrf-hid_emptype_code" value="@if(isset($EmpCode)){{$EmpCode}}@endif" />
													<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
												
												</div>		
											</div>
											<div class="row smclearrow"></div>  
										</div>
									<!-- </div >										 -->
								</div>
								<!-- ================ -->
								<!-- ================ -->
								</div>
								<!-- ============== -->
								<div class="div7">
									<div class="table-box">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row table-divhead" align="center">Employee Type List</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<table class="table-bordered table1" width="99%" align="center" id="dataTable">
													<thead>
														<tr class="note heading">
															<th  style="text-align:center">SNo.</th>
															<th  style="text-align:center">Employee Type Code</th>
															<th  style="text-align:center">Employee Type</th>
															<th  style="text-align:center">Action</th>
														</tr>
													</thead>
													<tbody>
													@if(isset($data['EmployeeData']))
														@foreach($data['EmployeeData'] as $EmployeeData)
															<tr>
																<td align="center">{{ $loop->iteration }} </td>
																<td align="left">{{ $EmployeeData->emp_type_code}}</td>
																<td align="left">{{ $EmployeeData->emp_type}}</td>
<!-- 																<td><input type="button" class="backbutton" name="btn_edit" id="btn_edit" value="Edit" onclick="window.location='{{ route('EmployeeType.EmployeeType',['id'=>encrypt($EmployeeData->emp_type_code)])}}'"/></td>
 -->																<td><input type="button" class="backbutton" name="btn_edit" id="btn_edit" value=" Edit" onclick="window.location='{{ route('EmployeeType.EmployeeType',['id'=>encrypt($EmployeeData->emp_type_code)]) }}'"/>	</td>
															</tr>
														@endforeach
													@endif
													</tbody>
												</table>
												
											</div>
										</div>	
									</div>									
								</div> 
								<!-- ================== -->
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
			var EmployeeTypeCode   	= $("#txt_emptype_code").val();
			var EmployeeTypeName   	= $("#txt_emptype_name").val();
			//var RoleGroup 		= $("#txt_role_group").val();

			if(EmployeeTypeCode == ""){
				BootstrapDialog.alert("Employee Type Code should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(EmployeeTypeName == ""){
				BootstrapDialog.alert("Employee Type Code should not be empty..!!");
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
					message: 'Are you sure want to Employee Type ?',
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
