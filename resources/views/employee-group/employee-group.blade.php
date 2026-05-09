@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php

 if(isset($data['EditGroupData'])){
	
	$EditGroupData = $data['EditGroupData'];
	$GroupCode	   = collect($EditGroupData)->pluck('emp_group_code')->first();
	$GroupName     = collect($EditGroupData)->pluck('emp_group_name')->first();
	$EmpCode       = collect($EditGroupData)->pluck('emp_type_code')->first();
	$Employcode    = collect($EditGroupData)->pluck('employment_type_code')->first();
	$GrpId         = collect($EditGroupData)->pluck('emp_group_id')->first();
	$Desig         = collect($EditGroupData)->pluck('emp_designation_id')->first();
	
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
								<!-- <div class="div3">&nbsp;</div> -->
								<div class="div5">
									<div class="form-box">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Employee Group Master</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="div4 label">
													Employee Type<span class="reqindi">*</span>
												</div>
												<div class="div8">
													<select name="cmb_emp_type" id="cmb_emp_type" class="tboxsmclass ChosenInput">
														<option value="">---------- Select ----------</option>
														@if(isset($data['EmployeeData']))
																@foreach($data['EmployeeData'] as $EmployeeData)
																	@php
																	$selstr= "";
																	if(isset($EmpCode)){
																		if($EmpCode == $EmployeeData->emp_type_code)
																		{
																			$selstr='selected="selected"';
																		}
																	}
																	@endphp
																	<option value="{{$EmployeeData->emp_type_code}}" {{$selstr}}>{{$EmployeeData->emp_type}}</option>
																@endforeach
															@endif
														
													</select>
												</div>

												<div class="div4 label">
													Employment Type<span class="reqindi">*</span>
												</div>
												<div class="div8">
													<select name="cmb_employ_type" id="cmb_employ_type" class="tboxclass">
														<option value="">---------- Select ----------</option>
														@if(isset($data['EmploymentData']))
																@foreach($data['EmploymentData'] as $EmploymentData)
																	@php
																	$selstr= "";
																	if(isset($Employcode)){
																		if($Employcode == $EmploymentData->employment_type_code)
																		{
																			$selstr='selected="selected"';
																		}
																	}
																	@endphp
																	<option value="{{$EmploymentData->employment_type_code}}" {{$selstr}}>{{$EmploymentData->employment_type}}</option>
																@endforeach
															@endif
													</select>
												</div>

												<div class="row smclearrow"></div>                                                                                											
												<div class="div4 label">Employee Group Code <span class="reqindi">*</span></div>
												<div class="div8"><input type="text" name="txt_group_code" id="txt_group_code" class="tboxclass" value="@if(isset($GroupCode)){{$GroupCode}}@endif"></div>
												<div class="row smclearrow"></div>

												<div class="row smclearrow"></div>                                                                                											
												<div class="div4 label">Employee Group Name<span class="reqindi">*</span></div>
												<div class="div8"><input type="text" name="txt_group_name" id="txt_group_name" class="tboxclass" value="@if(isset($GroupName)){{$GroupName}}@endif"></div>
												<div class="row smclearrow"></div>

												<div class="div4 lboxlabel"></div>	
												<div class="div8">
													<div class="div8 lboxlabel"><input type="checkbox"name="ch_portal_access" id="ch_portal_access"value="Y" {{ (isset($EditGroupData) && $EditGroupData->first()->portal_access == 'Y') ? 'checked' : '' }} > &emsp; Allow Portal Access</div>
												</div>
																					
												
												@php $AddUrl = 'roles.ViewRoleMaster'; @endphp										
												<div class="row">
													<div class="div12" align="center">
														<input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save "/>	
														<input type="hidden" name="hid_grp_id" id="csrf-hid_grp_id" value="@if(isset($GrpId)){{$GrpId}}@endif" />								
														<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
													</div>	
												</div>
											</div>
										</div>	
									</div>								
								</div>
								<!-- ============= -->
								<div class="div7">
									<div class="table-box">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row table-divhead" align="center">Employee Group List</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<table class="table-bordered table1" width="99%" align="center" id="dataTable">
													<thead>
														<tr class="note heading">
															<th  style="text-align:center">SNo.</th>
															<th  style="text-align:center">Employee Type</th>
															<th  style="text-align:center">Employment Type</th>
															<th  style="text-align:center">Employee Group Code</th>
															<th  style="text-align:center">Employee Group Name</th>
															<th  style="text-align:center">Portal Access</th>
															<th  style="text-align:center">Action</th>
														</tr>
													</thead>
													<tbody>
													@if(isset($data['EmpgroupData']))
														@foreach($data['EmpgroupData'] as $EmpgroupData)
															<tr>
																<td align="center">{{ $loop->iteration }} </td>
																<td align="left">{{ $EmpgroupData->emp_type_code}}</td>
																<td align="left">{{ $EmpgroupData->employment_type_code}}</td>
																<td align="left">{{ $EmpgroupData->emp_group_code}}</td>
																<td align="left">{{ $EmpgroupData->emp_group_name}}</td>
																<td align="left">{{ $EmpgroupData->portal_access}}</td>
																<td><input type="button" class="backbutton" name="btn_edit" id="btn_edit" value=" Edit" onclick="window.location='{{ route('EmployeeGroup.EmployeeGroupMaster',['id'=>encrypt($EmpgroupData->emp_group_id)]) }}'"/>	</td>

															</tr>
														@endforeach
													@endif
													</tbody>
												</table>
												
											</div>
										</div>	
									</div>									
								</div>
								<!-- ============= -->
								<!-- <div class="div7">
									<div class="table-box">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row table-divhead" align="center">Employee Group List</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<table class="table-bordered table1" width="99%" align="center" id="dataTable">
													<thead>
														<tr class="note heading">
															<th  style="text-align:center">SNo.</th>
															<th  style="text-align:center">Employee Type</th>
															<th  style="text-align:center">Employment Type</th>
															<th  style="text-align:center">Employee Group Code</th>
															<th  style="text-align:center">Employee Group Name</th>
															<th  style="text-align:center">Portal Access</th>
														</tr>
													</thead>
													<tbody>
													@if(isset($data['EmpgroupData']))
														@foreach($data['EmpgroupData'] as $SingleRecord)
															<tr>
																<td align="center">{{ $loop->iteration }} </td>
																<td align="left">{{ $SingleRecord->emp_type_code}}</td>
																<td align="left">{{ $SingleRecord->employment_type_code}}</td>
																<td align="left">{{ $SingleRecord->emp_group_code}}</td>
																<td align="left">{{ $SingleRecord->emp_group_name}}</td>
																<td align="left">{{ $SingleRecord->portal_access}}</td>
															</tr>
														@endforeach
													@endif
													</tbody>
												</table>
												
											</div>
										</div>	
									</div>									
								</div> -->
								<!-- =================== -->
								<!-- <div class="div3">&nbsp;</div>	 -->
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
			var EmployeeType = $("#cmb_emp_type").val();
			var GroupCode	 = $("#txt_group_code").val();
			var GroupName 	 = $("#txt_group_name").val();

			if(EmployeeType == ""){
				BootstrapDialog.alert("Employee Type Code should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(GroupCode == ""){
				BootstrapDialog.alert("Group Code should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			} else if(GroupName == ""){
				BootstrapDialog.alert("Group Name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			} else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure want to Employment Group Master ?',
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
