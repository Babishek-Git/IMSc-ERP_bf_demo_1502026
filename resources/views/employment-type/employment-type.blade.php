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
							<div class="row plr">
									<div class="div5">
										<div class="form-box">
											<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Employment Type</div></div></div>
											<div class="card-body padding-1 ChartCard" id="CourseChart">
												<div class="divrowbox innerdiv pt-2">
																	
													<div class="row smclearrow"></div>                                                                                											
													<div class="div3 label">Type Code<span class="reqindi">*</span></div>
													<div class="div9"><input type="text" name="txt_type_code" id="txt_type_code" class="tboxclass" value=""></div>
													<div class="row smclearrow"></div>

													<div class="row smclearrow"></div>                                                                                											
													<div class="div3 label">Employment Type<span class="reqindi">*</span></div>
													<div class="div9"><input type="text" name="txt_emp_type" id="txt_emp_type" class="tboxclass" value=""></div>
													<div class="row smclearrow"></div>
																	
											
											@php $AddUrl = 'roles.ViewRoleMaster'; @endphp										
											<div class="row">
												<div class="div12" align="center">
													<input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />									
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
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row table-divhead" align="center">Employment List</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<table class="table-bordered table1" width="99%" align="center" id="dataTable">
													<thead>
														<tr class="note heading">
															<th  style="text-align:center">SNo.</th>
															<th  style="text-align:center">Type Code</th>
															<th  style="text-align:center">Employement Type</th>
															<th  style="text-align:center">Action</th>
														</tr>
													</thead>
													<tbody>
													@if(isset($data['EmploymentData']))
														@foreach($data['EmploymentData'] as $EmploymentData)
															<tr>
																<td align="center">{{ $loop->iteration }} </td>
																<td align="left">{{ $EmploymentData->employment_type_code }}</td>
																<td align="left">{{ $EmploymentData->employment_type }}</td>
																<td align="center"><input type="button" class="backbutton" name="btn_edit" id="btn_edit" value=" Edit" />	</td>
															</tr>
														@endforeach
													@endif
													</tbody>
												</table>
												
											</div>
										</div>	
									</div>									
								</div>
							<div>                          
						</div>
					</blockquote>
				</div>
			</div>
		</div>
	</form>
</body>	
<script type="text/javascript" language="javascript">
	/* $("#txt_type_code").chosen();
	$("#txt_emp_code").chosen(); */
	$('#dataTable').DataTable({
		responsive: true,
		paging: true, 
	});

	var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var TypeCode   	= $("#txt_type_code").val();
			var EmpType  	= $("#txt_emp_type").val();
			//var RoleGroup 		= $("#txt_role_group").val();

			if(TypeCode == ""){
				BootstrapDialog.alert("Type Code should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(EmpType == ""){
				BootstrapDialog.alert("Employee Type should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure want to EmploymentType ?',
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
