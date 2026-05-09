@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php
 if(isset($data['EditProjectData'])){
	
	$EditProjectData = $data['EditProjectData'];
	$ProjectName     = collect($EditProjectData)->pluck('project_name')->first();
	$ProjectDuration = collect($EditProjectData)->pluck('project_duration')->first();
	$ProjectMode = collect($EditProjectData)->pluck('project_duration_mode')->first();
	$ProjectStart    = collect($EditProjectData)->pluck('project_start_at')->first();
	$ProjectId    = collect($EditProjectData)->pluck('project_id')->first();
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
								<div class="div5">
								<div class="form-box">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Project Head Master</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
																	
											<div class="row smclearrow"></div>                                                                                											
											<div class="div4 label">
													Project Name<span class="reqindi">*</span>
												</div>
												<div class="div8">
													<select name="cmb_pro_name" id="cmb_pro_name" class="tboxsmclass">
														<option value="">---------- Select ----------</option>
														@if(isset($data['ProjectData']))
																@foreach($data['ProjectData'] as $ProjectData)
																	<option value="{{$ProjectData->project_id}}" >{{$ProjectData->project_name}}</option>
																@endforeach
															@endif
														
													</select>
												</div>

												<div class="row smclearrow"></div>                                                                                											
												<div class="div4 label">
													Principle Co-Ordinator<span class="reqindi">*</span>
												</div>
												<div class="div8">
													<select name="cmb_pro_head" id="cmb_pro_head" class="tboxsmclass">
														<option value="">---------- Select ----------</option>
														@if(isset($data['EmployeeData']))
															@foreach($data['EmployeeData'] as $EmployeeData)
																<option value="{{$EmployeeData->emp_no}}">{{$EmployeeData->emp_name_payslip}},  ICNo. {{$EmployeeData->emp_no}}</option>
															@endforeach
														@endif
													</select>
												</div>
																					
																							
									        <div class="row smclearrow"></div>
											@php $AddUrl = 'roles.ViewRoleMaster'; @endphp										
											<div class="row">
												<div class="div12" align="center">
													<button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Save">Save</button>
													<input type="hidden" name="hid_pro_id" id="csrf-hid_pro_id" value="@if(isset($ProjectId)){{$ProjectId}}@endif" />
													<input type="hidden" name="hid_del_id" id="hid_del_id" value="" />
													<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
												</div>		
											</div>
											<div class="row smclearrow"></div>  
										</div>
									</div>										
								</div>
								<!-- ================ -->
								<!-- ================ -->
								</div>
								<!-- ============== -->
								<div class="div7">
									<div class="table-box">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row table-divhead" align="center">Project Master List</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<table class="table-bordered table1" width="99%" align="center" id="dataTable">
													<thead>
														<tr class="note heading">
															<th style="text-align:center">SNo.</th>
															<th style="text-align:center">Project Name</th>
															<th style="text-align:center">Principle Co-Ordinator</th>
															<th style="text-align:center"></th>
															<th style="text-align:center"></th>
														</tr>
													</thead>
													<tbody>
														@if(isset($data['ProjectHeadView']))
															@foreach($data['ProjectHeadView'] as $ProjectHeadView)
																<tr>
																	<td align="center">{{ $loop->iteration }} </td>
																	<td align="left">{{ $ProjectHeadView->project_name}}</td>
																	<td align="left">{{ $ProjectHeadView->emp_name_payslip}}</td>
																	<td>
																		<button type="button" name="btn_edit" class="btn btn-default tuploadbtn" id="btn_edit" value=" Edit" onclick="window.location='{{ route('Project.project-head',['id'=>encrypt($ProjectHeadView->project_staff_id),'action'=>encrypt('EDIT')]) }}'"> <i class='fa fa-edit'></i> Edit </button>
																	</td>
																	<td>
																		<button type="button" name="btn_delete" class="btn btn-default tuploadbtn" id="btn_delete" value=" Delete" onclick="window.location='{{ route('Project.project-head',['id'=>encrypt($ProjectHeadView->project_staff_id),'action'=>encrypt('DEL')]) }}'"> <i class='fa fa-edit'></i> Delete</button>
																	</td>
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
	$("#cmb_pro_name").chosen();
	$("#cmb_pro_head").chosen();
	$('#dataTable').DataTable({
		responsive: true,
		paging: true, 
	});
	var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var ProjectName   	= $("#cmb_pro_name").val();
			var ProjectHead   	= $("#cmb_pro_head").val();
			if(ProjectName == ""){
				BootstrapDialog.alert("Please select project name..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(ProjectHead == ""){
				BootstrapDialog.alert("Please select project Head..!!");
				event.preventDefault();
				event.returnValue = false;
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure want to Project Head ?',
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
