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
											<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">License Fee & Water Charge Update</div></div></div>
											<div class="card-body padding-1 ChartCard" id="CourseChart">
												<div class="divrowbox innerdiv pt-2">
																			
														<div class="row">     
														<div class="div12">                                                                        											
															<table class="formtable" align="center" id="dataTable" width="100%">
																<thead>
																	<tr>
																		<th class="colhead" nowrap="nowrap">SNo</th>
																		<th class="colhead">Type Name</th>
																		<th class="colhead">LF (Rs.)</th>
																		<th class="colhead">LF </br>(With Effect From)</th>
																		<th class="colhead">WC(Rs.)</th>
																		<th class="colhead">WC <br>(With Effect From)</th>
																	</tr>
																</thead>
																<tbody>
																<tr>
																@if(isset($data['HouseTypeData']))
																	@foreach($data['HouseTypeData'] as $HouseTypeData)
																	<tr>
																		<td align="center">{{$loop->iteration}}</td>
																		<td>
																			{{$HouseTypeData->house_type_name}}
																			<input type="hidden" name="txt_house_type_id[]" id="txt_house_type_id{{$HouseTypeData->house_type_id}}" class="tboxclass" value="{{$HouseTypeData->house_type_id}}">
																		</td>
																		<td><input type="text" name="txt_lic_fee[]" id="txt_lic_fee_{{$HouseTypeData->house_type_id}}" class="tboxclass" value=""></td>
																		<td><input type="text" name="txt_lic_feewef[]" id="txt_lic_feewef_{{$HouseTypeData->house_type_id}}" class="tboxclass datepicker" value=""></td>
																		<td><input type="text" name="txt_water_charge[]" id="txt_water_charge_{{$HouseTypeData->house_type_id}}" class="tboxclass" value=""></td>
																		<td><input type="text" name="txt_water_chargewef[]" id="txt_water_chargewef_{{$HouseTypeData->house_type_id}}" class="tboxclass datepicker" value=""></td>												
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
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row table-divhead" align="center">Licence Fee Water Charge</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<table class="formtable" width="99%" align="center" id="dataTable">
													<thead>
														<tr>
															<th  style="text-align:center">SNo.</th>
															<th  style="text-align:center">Type Name</th>
															<th  style="text-align:center">Licence Fee</br>( &#8377; )</th>
															<th  style="text-align:center">Licence Fee </br>With Effect From</th>
															<th  style="text-align:center">Water Charge</br>( &#8377; )</th>
															<th  style="text-align:center">Water Charge </br>With Effect From</th>
															<th  style="text-align:center">Water Charge </br>Action</th>
														</tr>
													</thead>
													<tbody>
													@if(isset($data['FeesData']))
														@foreach($data['FeesData'] as $FeesData)
															<tr>
																<td align="center">{{ $loop->iteration }} </td>
																<td align="left">{{ $FeesData->house_type_name }}</td>
																<td align="right">{{ Helper::IndianRupeesFormat($FeesData->licence_fee) }}</td>
																<td align="center">{{Helper::DisplayDateFormat($FeesData->licence_fee_wef)}}</td>
																<td align="right">{{ Helper::IndianRupeesFormat($FeesData->water_charge) }}</td>
																<td align="center">{{Helper::DisplayDateFormat($FeesData->water_charge_wef)}}</td>
															    <td><button type="button" name="btn_edit" class="btn btn-default tuploadbtn" id="btn_edit" value=" Edit" onclick="window.location='{{ route('LicenceFeeWaterTariff.LicenceFeeWaterCharge',['id'=>encrypt($FeesData->tariff_id)]) }}'"> <i class='fa fa-edit'></i> Edit </button></td>

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
		//alert();
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
