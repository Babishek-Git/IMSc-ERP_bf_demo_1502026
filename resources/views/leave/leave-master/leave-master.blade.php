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
								<div class="div5 mbtable">
									<!-- <div class="form-box"> -->
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Leave Master</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<div class="div3 label">Leave Code<span class="reqindi">*</span></div>
												<div class="div9"><input type="text" name="txt_leave_code" id="txt_leave_code" class="tboxclass" value=""></div>
												<div class="row smclearrow"></div>

												<div class="row smclearrow"></div>                                                                                											
												<div class="div3 label">Leave Name<span class="reqindi">*</span></div>
												<div class="div9"><input type="text" name="txt_leave_name" id="txt_leave_name" class="tboxclass" value=""></div>
												<div class="row smclearrow"></div>

												<div class="row smclearrow"></div>                                                                                											
												<div class="div3 label">Total Leave per Year<span class="reqindi">*</span></div>
												<div class="div9"><input type="text" name="txt_lea_year" id="txt_lea_year" class="tboxclass" value=""></div>
												<div class="row smclearrow"></div>

												<div class="row smclearrow"></div>                                                                                											
												<div class="div3 label">Total Leave per Service<span class="reqindi">*</span></div>
												<div class="div9"><input type="text" name="txt_lea_ser" id="txt_lea_ser" class="tboxclass" value=""></div>
												<div class="row smclearrow"></div>

												<div class="row smclearrow"></div>                                                                                											
												<div class="div3" align="right"><input type="checkbox" name="ch_is_debit" id="ch_is_debit" class="tboxclass" value="True"></div>
												<div class="div9 label" align="left">Is Debited<span class="reqindi">*</span></div>
												<div class="row smclearrow"></div>
												
												
												
												@php $AddUrl = 'roles.ViewRoleMaster'; @endphp										
												<div class="row">
													<div class="div12" align="center">
														<input type="submit" class="step-btn" name="btn_save" id="btn_save" value=" Save " />									
														<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
													</div>		
												</div>
												<div class="row smclearrow"></div>  
											<!-- </div> -->
										</div>
									</div>								
								</div>
								<div class="div7">
									<div class="table-box">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row table-divhead" align="center">Leave Master List</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<table class="table-bordered table1" width="99%" align="center" id="dataTable">
													<thead>
														<tr class="note heading">
															<th  style="text-align:center">SNo.</th>
															<th  style="text-align:center">Leave Code</th>
															<th  style="text-align:center">Leave Name</th>
															<th  style="text-align:center">Total Leave </br>per Year</th>
															<th  style="text-align:center">Total Leave </br>per Service</th>
															<th  style="text-align:center">Is Debit</th>
															<th  style="text-align:center">Action</th>
														</tr>
													</thead>
													<tbody>
													@if(isset($data['LeaveData']))
														@foreach($data['LeaveData'] as $LeaveData)  
															<tr>
																<td align="center">{{ $loop->iteration }} </td>
																<td align="left">{{ $LeaveData->leave_type_code }}</td>
																<td align="left">{{ $LeaveData->leave_type_name }}</td>
																<td align="left">{{ $LeaveData->tot_leave_per_year }}</td>
																<td align="left">{{ $LeaveData->tot_leave_per_service }}</td>
																@if($LeaveData->is_debt == 1)
																<td align="left">Debited</td>
																@else
																<td align="left">Not Debited</td>
																@endif
																		
																<td><input type="button" class="backbutton" name="btn_edit" id="btn_edit" value=" Edit" onclick="window.location='{{ route('LeaveMaster.LeaveMaster',['id'=>encrypt($LeaveData->leave_id)]) }}'"/>	</td>

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
//	$("#txt_division").chosen();
//	$("#txt_role_group").chosen();
	$('#dataTable').DataTable({
		responsive: true,
		paging: true, 
	});
	
	var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var LeaveCode   		= $("#txt_leave_code").val();
			var LeaveName   	= $("#txt_leave_name").val();
			var LeaveYear 		= $("#txt_lea_year").val();
			var LeaveService 		= $("#txt_lea_ser").val();

			if(LeaveCode == ""){
				BootstrapDialog.alert("Leave Code  should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(LeaveName == ""){
				BootstrapDialog.alert("Leave Name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(LeaveYear == ""){
				BootstrapDialog.alert("Leave Year Name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}
			else if(LeaveService == ""){
				BootstrapDialog.alert("Leave Service should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure want to Leave Master ?',
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
