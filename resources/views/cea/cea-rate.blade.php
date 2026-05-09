@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php

  if(isset($data['EditChildEducationAllowanceData'])){

	$EditChildEducationAllowanceData = $data['EditChildEducationAllowanceData'];
	$ceaMode                         = collect($EditChildEducationAllowanceData)->pluck('cea_rate_mode')->first();
	$cearate     					 = collect($EditChildEducationAllowanceData)->pluck('cea_rate')->first();
	$cearateper        				 = collect($EditChildEducationAllowanceData)->pluck('cea_rate_unit')->first();
	$ceawitheffect  				 = collect($EditChildEducationAllowanceData)->pluck('with_effect_from')->first();
	$CeaRateId 				     = collect($EditChildEducationAllowanceData)->pluck('cea_rate_id')->first();
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
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Children Education Allowance</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
												
												<!-- <div class="div4 label">Ledger Account Name<span class="reqindi"> *</span></div>											
												<div class="div8"><input type="text" name="txt_led_acc_name" id="txt_led_acc_name"  class="tboxsmclass" value=""></div>																																																					 -->
												<div class="div4 label">Mode<span class="reqindi">*</span></div>
													<div class="div8">
														<select name="txt_mode_0" id="txt_mode_0" class="tboxsmclass ChosenInput">
														<option value="">-------- Select------</option>
															@if(isset($data['ChildEducationAllowanceData']))
																	@foreach($data['ChildEducationAllowanceData'] as $ChildEducationAllowanceData)
																		@php
																		$selstr= "";
																		if(isset($CeaRateId)){
																			if($CeaRateId == $ChildEducationAllowanceData->cea_rate_id)
																			{
																				$selstr='selected="selected"';
																			}
																		}
																		@endphp
																		<option value="{{$ChildEducationAllowanceData->cea_rate_id}}" {{$selstr}}>{{$ChildEducationAllowanceData->cea_rate_mode}}</option>
																	@endforeach
															@endif
														</select>
												</div>
												<div class="div4 label">Rate<span class="reqindi"> *</span></div>											
												<div class="div8"><input type="text" name="txt_rate" id="txt_rate"  class="tboxsmclass" value="@if(isset($cearate)){{$cearate}}@endif"></div>
												
												<div class="div4 label">Rate Per<span class="reqindi"> *</span></div>
													<div class="div8">
														<select name="txt_rate_per" id="txt_rate_per" class="tboxsmclass ChosenInput">
														<option value="">-------- Select------</option>
															@if(isset($data['ChildEducationAllowanceData']))
																	@foreach($data['ChildEducationAllowanceData'] as $ChildEducationAllowanceData)
																		@php
																		$selstr= "";
																		if(isset($CeaRateId)){
																			if($CeaRateId == $ChildEducationAllowanceData->cea_rate_id)
																			{
																				$selstr='selected="selected"';
																			}
																		}
																		@endphp
																		<option value="{{$ChildEducationAllowanceData->cea_rate_id}}" {{$selstr}}>{{$ChildEducationAllowanceData->cea_rate_unit}}</option>
																	@endforeach
															@endif
														</select>
												</div>
												<div class="row smclearrow"></div> 
												<div class="div4 label">With Effect From<span class="reqindi"> *</span></div>											
												<div class="div8"><input type="text" name="txt_effect_from" id="txt_effect_from"  class="tboxsmclass datepicker" value="@if(isset($ceawitheffect)){{$ceawitheffect}}@endif"></div>
												@php $AddUrl = 'bank.ViewBankBranchList'; @endphp
												<div class="row">
													<div class="div12" align="center">
													<button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Save">Save</button>
													<input type="hidden" name="hid_cea_id" id="csrf-hid_cea_id" value="@if(isset($CeaRateId)){{$CeaRateId}}@endif" />
													<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
													</div>		
												</div>
												<div class="row smclearrow"></div>  
											</div>
										</div>
									</div>										
								<!-- </div> -->
								<div class="div7">
									<div class="table-box">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row table-divhead" align="center">Children Education Allowance List (CEA)</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<table class="table-bordered table1" width="99%" align="center" id="dataTable">
													<thead>
														<tr class="note heading">
															<th  style="text-align:center">S.No</th>
															<th  style="text-align:center">CEA Rate</th>
															<th  style="text-align:center">CEA Rate Mode</th>
															<th  style="text-align:center">CEA Rate Unit</th>
															<th  style="text-align:center">Is Current</th>
															<th  style="text-align:center">With Effect From</th>
															<th  style="text-align:center">Action</th>

														</tr>
													</thead>
													<tbody>
													@if(isset($data['ChildEducationAllowanceData']))
														@foreach($data['ChildEducationAllowanceData'] as $ChildEducationAllowanceData)
															<tr>
																<td align="center">{{ $loop->iteration }} </td>
																<td align="left">{{ $ChildEducationAllowanceData->cea_rate}}</td>
																<td align="left">{{ $ChildEducationAllowanceData->cea_rate_mode }}</td>
																<td align="left">{{ $ChildEducationAllowanceData->cea_rate_unit }}</td>
																<td align="left">{{ $ChildEducationAllowanceData->is_current }}</td>
															    <td align="left">{{ Helper::DisplayDateFormat($ChildEducationAllowanceData->with_effect_from) }}</td>
																<td><button type="button" name="btn_edit" class="btn btn-default tuploadbtn" id="btn_edit" value=" Edit" onclick="window.location='{{ route('cea.cea-rate',['id'=>encrypt($ChildEducationAllowanceData->cea_rate_id)]) }}'"> <i class='fa fa-edit'></i> Edit </button></td>

															</tr>
														@endforeach
													@endif
													</tbody>
												</table>
												
											</div>
										</div>	
									</div>									
								</div>..								
							</div>                           
						</div>..
						
						
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
