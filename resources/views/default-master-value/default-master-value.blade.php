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
											<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Default Value Master Value</div></div></div>
											<div class="card-body padding-1 ChartCard" id="CourseChart">
												<div class="divrowbox innerdiv pt-2">
																			
														<div class="row">     
														<div class="div12">                                                                        											
															<table class="formtable" align="center" id="dataTable" width="100%">
																<thead>
																	<tr>
																		<th class="colhead" nowrap="nowrap">SNo</th>
																		<th class="colhead">Description</th>
																		<th class="colhead">Mode</th>
																		<th class="colhead">Value</th>
																		<th class="colhead">With Effect From</th>															
																	</tr>
																</thead>
																<tbody>
																<tr>
																@if(isset($data['DefaultData']))
																	@foreach($data['DefaultData'] as $DefaultData)
																	<tr>
																		<td align="center">{{$loop->iteration}}</td>
																		<td>{{$DefaultData->def_mast_name}}</td>
																		<td>
																			<input type="radio" name="rad_mode_{{$DefaultData->def_mast_code}}" id="rad_mode_perc_{{$DefaultData->def_mast_code}}" value="P"> [ % ] &emsp;
																			<input type="radio" name="rad_mode_{{$DefaultData->def_mast_code}}" id="rad_mode_amt_{{$DefaultData->def_mast_code}}" value="A"> Amount
																			<input type="hidden" name="txt_master_code[]" id="txt_master_code" class="tboxclass" value="{{$DefaultData->def_mast_code}}">
																		</td>
																		<td>
																			<input type="text" name="txt_value[]" id="txt_value" class="tboxclass" value="">
																		</td>
																		<td>
																			<input type="text" name="txt_eff_from[]" id="txt_eff_from{{$DefaultData->def_mast_code}}" class="tboxclass datepicker" value="">
																		</td>
																	</tr>
																	@endforeach
																@endif
																</tr>
																</tbody>
															</table>
														</div>
													</div>  
															
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
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row table-divhead" align="center">Default Master Value</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<table class="table-bordered table1" width="99%" align="center" id="dataTable">
													<thead>
														<tr class="note heading">
															<th  style="text-align:center">SNo.</th>
															<th  style="text-align:center">Description</th>
															<th  style="text-align:center">Mode</th>
															<th  style="text-align:center">Value</th>
															<th  style="text-align:center">With Effect From</th>
														</tr>
													</thead>
													<tbody>
													@if(isset($data['DefaultValueData']))
														@foreach($data['DefaultValueData'] as $DefaultValueData)
															<tr>
																<td align="center">{{ $loop->iteration }} </td>
																<td align="left">{{ $DefaultValueData->def_mast_code }}</td>
																<td align="left">{{ $DefaultValueData->def_mast_mode }}</td>
																<td align="left">{{ $DefaultValueData->def_mast_value }}</td>
																<td align="left">{{ $DefaultValueData->with_effect_from }}</td>
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

	$(document).on('click','input[name="rad_alw_adv"]',function(){
		let Type = $(this).val();
		if(Type == 'ALW'){
			$('#TypeName').text('Allowance');
		}else if(Type == 'ADV'){
			$('#TypeName').text('Advance');
		}else{
			$('#TypeName').text('Allowance');
		}
	
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
