@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php 
	/*if(isset($data['RoleData'])){
		$RoleEditData = $data['RoleData'];
		if(filled($RoleEditData)){
			$RoleName = $RoleEditData->role_name;
			$RoleId = $RoleEditData->roleid;
			$RoleGroupCode = $RoleEditData->role_group_code;
			$RoleSectionId = $RoleEditData->section_id;
		}
	}*/
@endphp

<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="" method="post" enctype="multipart/form-data" name="form">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row">
								<div class="div3"></div>
								<div class="div6">
									<div class="form-box">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Staff & Trainees Leave</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<div class="row smclearrow"></div>
												<div class="row smclearrow"></div>
												
												<div class="div3 label">
													Project Staff Total Leave (Per Year)<span class="reqindi">*</span>
												</div>
												<div class="div4"><input type="text" name="txt_staff_leave" id="txt_staff_leave" class="tboxsmclass" value="@if(isset($data['RoleData'])){{ $data['RoleData']->role_name }}@endif"></div>&emsp;
                                                 
												<div class="div3">
													<select name="cmb_section" id="cmb_section" class="tboxsmclass">
														<option value="">-------- Select -------</option>
														<option value=""> Days</option>
							
													</select>
												</div>
												<div class="row smclearrow"></div>
												<div class="row smclearrow"></div>
												<div class="div3 label">
													Project Trainee Total Leave (Per Year)<span class="reqindi">*</span>
												</div>
												<div class="div4"><input type="text" name="txt_traine_leave" id="txt_traine_leave" class="tboxsmclass" value="@if(isset($data['RoleData'])){{ $data['RoleData']->role_name }}@endif"></div>

												<div class="div3">
													<select name="cmb_section" id="cmb_section" class="tboxsmclass">
														<option value="">-------- Select -------</option>
														<option value=""> Days</option>
							
													</select>
												</div>
												@php $AddUrl = 'staff-trainees.staff-trainees'; @endphp										
												<div class="row">
													<div class="div12" align="center">
														<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" Back " onClick="window.location='{{route($AddUrl)}}'" />
														<input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />									
														<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
														<input type="hidden" name="hid_roleid" id="hid_roleid" value="@if(isset($data['RoleData'])){{ encrypt($data['RoleData']->roleid) }}@endif" />
													</div>		
												</div>
												<div class="row smclearrow"></div>  
											</div>
										</div>										
									</div>
								</div>
								<div class="div3"></div>
								
							</div>                           
						</div>
					</blockquote>
				</div>
			</div>
		</div>
	</form>
</body>	
<script type="text/javascript" language="javascript">
	$("#txt_role_group").chosen();
	$("#cmb_section").chosen();
	$('#dataTable').DataTable({
		responsive: true,
		paging: true, 
	});														
	var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var RoleName   		= $("#txt_role_name").val();
			var RoleGroup 		= $("#txt_role_group").val();

			if(RoleName == ""){
				BootstrapDialog.alert("Role Name should not be empty..!!");
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
