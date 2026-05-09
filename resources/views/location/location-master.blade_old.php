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
											<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Location Master</div></div></div>
												<div class="card-body padding-1 ChartCard" id="CourseChart">
													<div class="divrowbox innerdiv pt-2">
														<div class="row smclearrow"></div>                                                                                											
														<div class="div3 label">Location Name<span class="reqindi">*</span></div>
														<div class="div9"><input type="text" name="txt_loct_name" id="txt_loct_name" class="tboxclass" value=""></div>
														<div class="div3 label">Location Short Name<span class="reqindi">*</span></div>
														<div class="div9"><input type="text" name="txt_loct_shname" id="txt_loct_shname" class="tboxclass" value=""></div>
														<div class="row smclearrow"></div>
														@php $AddUrl = 'roles.ViewRoleMaster'; @endphp										
														<div class="row">
														<div class="div12" align="center">
														<button type="submit" class="step-btn" name="btn_save" id="btn_save" value=" Save">Save</button>		
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
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row table-divhead" align="center">Location Master List</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<table class="table-bordered table1" width="99%" align="center" id="dataTable">
													<thead>
														<tr class="note heading">
															<th  style="text-align:center">SNo.</th>
															<th  style="text-align:center">Location Name</th>
															<th  style="text-align:center">Location Short Name</th>
															<th  style="text-align:center">Action</th>
 														</tr>
													</thead>
													<tbody>
													@if(isset($data['LocationData']))
														@foreach($data['LocationData'] as $LocationData)
															<tr>
																<td align="center">{{ $loop->iteration }} </td>
																<td align="left">{{ $LocationData->location_name}}</td>
																<td align="left">{{ $LocationData->location_sname }}</td>
																<td><button type="button" name="btn_edit" class="btn btn-default tuploadbtn" id="btn_edit" value=" Edit" onclick="window.location='{{ route('location.location-master',['id'=>encrypt($LocationData->location_id)]) }}'"> <i class='fa fa-edit'></i> Edit </button></td>
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
			var HouseName   	= $("#txt_house_code").val();
			var HouseType   	= $("#txt_house_type").val();
			var HouseStatus 	= $("#txt_house_status").val();
			var EmployeeNo 		= $("#txt_emp_no").val();
			var Occupiedon 		= $("#txt_occ_on").val();

			if(HouseName == ""){
				BootstrapDialog.alert("House Name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(HouseType == ""){
				BootstrapDialog.alert("House Type should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(HouseStatus == ""){
				BootstrapDialog.alert("House Status should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}
			else if(EmployeeNo == ""){
				BootstrapDialog.alert("Employee No should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}
			else if(Occupiedon == ""){
				BootstrapDialog.alert("Occupied On  should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure want to save Location Master ?',
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
