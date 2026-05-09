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
											<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Hostel Master</div></div></div>
												<div class="card-body padding-1 ChartCard" id="CourseChart">
													<div class="divrowbox innerdiv pt-2">
																				
														<div class="row smclearrow"></div>                                                                                											
														<div class="div3 label">Hostel Code <span class="reqindi">*</span></div>
														<div class="div9"><input type="text" name="txt_hostel_code" id="txt_hostel_code" class="tboxclass" value=""></div>
														<div class="row smclearrow"></div>

														<div class="row smclearrow"></div>                                                                                											
														<div class="div3 label">Hostel Address <span class="reqindi">*</span></div>
														<div class="div9"><input type="text" name="txt_hostel_addr" id="txt_hostel_addr" class="tboxclass" value=""></div>
														<div class="row smclearrow"></div>

														<div class="row smclearrow"></div>                                                                                											
														<div class="div3 label">Hostel Type <span class="reqindi">*</span></div>
														<div class="div9"><input type="text" name="txt_hostel_type" id="txt_hostel_type" class="tboxclass" value=""></div>
														<div class="row smclearrow"></div>

														<!-- <div class="row smclearrow"></div>                                                                                											
														<div class="div3 label">House Status <span class="reqindi">*</span></div>
														<div class="div9"><input type="text" name="txt_house_status" id="txt_house_status" class="tboxclass" value=""></div>
														<div class="row smclearrow"></div>

														<div class="row smclearrow"></div>                                                                                											
														<div class="div3 label">Employee No <span class="reqindi">*</span></div>
														<div class="div9"><input type="text" name="txt_emp_no" id="txt_emp_no" class="tboxclass" value=""></div>
														<div class="row smclearrow"></div> -->
														
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
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row table-divhead" align="center">Hostel Master List</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<table class="table-bordered table1" width="99%" align="center" id="dataTable">
													<thead>
														<tr class="note heading">
															<th  style="text-align:center">SNo.</th>
															<th  style="text-align:center">Hostel Code</th>
															<th  style="text-align:center">Hostel Address</th>
															<!-- <th  style="text-align:center">Hostel Status</th>
															<th  style="text-align:center">Employee No</th> -->
														</tr>
													</thead>
													<tbody>
													@if(isset($data['HostelData']))
														@foreach($data['HostelData'] as $HostelData)
															<tr>
																<td align="center">{{ $loop->iteration }} </td>
																<td align="center">{{ $HostelData->house_code}} </td>
																<td align="left">{{ $HostelData->house_address}}</td>
																<!-- <td align="left">{{ $HostelData->house_status }}</td>
																<td align="left">{{ $HostelData->emp_no }}</td> -->
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
					message: 'Are you sure want to save Hostel Master ?',
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
