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
							<div class="row plr ">
									<div class="div5">
										<div class="form-box">
											<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Pay Component  Master</div></div></div>
											<div class="card-body padding-1 ChartCard" id="CourseChart">
												<div class="divrowbox innerdiv pt-2">
																			
													
													<div class="div4 label">
														Component Type <span class="reqindi">*</span>
													</div>
													<div class="div8">
														<select name="cmb_component_type" id="cmb_component_type" class="tboxclass">
															<option value="">------------- Select ------------</option>
															@if(isset($data['paycomponentTypeData']))
																@foreach($data['paycomponentTypeData'] as $paycomponentTypeData)
																	<option value="{{$paycomponentTypeData->component_type_id}}">{{$paycomponentTypeData->component_type_name}}</option>
																@endforeach
															@endif
																
														</select>
													</div>
													<div class="row smclearrow"></div>                                                                                											
													<div class="div4 label">Component Code <span class="reqindi">*</span></div>
													<div class="div8"><input type="text" name="txt_comp_code" id="txt_comp_code" class="tboxclass" value=""></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>                                                                                											
													<div class="div4 label">Component Name <span class="reqindi">*</span></div>
													<div class="div8"><input type="text" name="txt_comp_name" id="txt_comp_name" class="tboxclass" value=""></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>                                                                                											
													<div class="div4 label">With Effect From<span class="reqindi">*</span></div>
													<div class="div8"><input type="text" name="txt_comp_name" id="txt_comp_name" class="tboxclass datepicker" value=""></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>                                                                                											
													<div class="div4" align="right"><input type="checkbox" name="ch_is_tax" id="ch_is_tax" class="tboxclass" value="True"></div>
													<div class="div8 label" align="left">Is Taxable<span class="reqindi">*</span></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>                                                                                											
													<div class="div4" align="right"><input type="checkbox" name="ch_is_perc" id="ch_is_perc" class="tboxclass" value="True"></div>
													<div class="div8 label" align="left">Is Percentage<span class="reqindi">*</span></div>
													<div class="row smclearrow"></div>
													@php $AddUrl = 'roles.ViewRoleMaster'; @endphp										
													<div class="row">
														<div class="div12" align="center">
															<button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Save">Save</button>								
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
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row table-divhead" align="center">Pay Component List</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<table class="table-bordered table1" width="99%" align="center" id="dataTable">
													<thead>
														<tr class="note heading">
															<th  style="text-align:center">SNo.</th>
															<th  style="text-align:center">Pay Component Type</th>
															<th  style="text-align:center">Pay Component Code</th>
															<th  style="text-align:center">Pay Component Name</th>
															<th  style="text-align:center">Is Taxable</th>
															<th  style="text-align:center">Is Percentage</th>
															<th  style="text-align:center">With Effect From</th>
															<th  style="text-align:center">Edit</th>

														</tr>
													</thead>
													<tbody>
													@if(isset($data['paycomponentData']))
														@foreach($data['paycomponentData'] as $paycomponentData)
															<tr>
																<td align="center">{{ $loop->iteration }} </td>
																<td align="left">{{ $paycomponentData->component_type_name }}</td>
																<td align="left">{{ $paycomponentData->component_code }}</td>
																<td align="left">{{ $paycomponentData->component_name }}</td>
																@if($paycomponentData->is_taxable == 1)
																<td align="left">Taxable</td>
																@else
																<td align="left">Not Taxable</td>
																@endif
																@if($paycomponentData->is_percentage == 1)
																<td align="left">Percentage</td>
																@else
																<td align="left">Not Percentage</td>
																@endif
																<td align="left">{{Helper::DisplayDateFormat($paycomponentData->with_effect_from )}}</td>
																<td><button type="button" name="btn_edit" class="btn btn-default tuploadbtn" id="btn_edit" value=" Edit" onclick="window.location='{{ route('PayComponent.PayComponent',['id'=>encrypt($paycomponentData->component_id)]) }}'"> <i class='fa fa-edit'></i> Edit </button></td>

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
	$("#txt_division").chosen();
	$("#txt_role_group").chosen();
	$('#dataTable').DataTable({
		responsive: true,
		paging: true, 
	});	

	var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var RoleName   		= $("#txt_role_name").val();
			var RoleDivision   	= $("#txt_division").val();
			var RoleGroup 		= $("#txt_role_group").val();

			if(RoleName == ""){
				BootstrapDialog.alert("Role Name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(RoleDivision == ""){
				BootstrapDialog.alert("Division Name should not be empty..!!");
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
					message: 'Are you sure want to save Role ?',
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
