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
								<div class="div2"></div>
								<div class="div8">
									<div class="form-box">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">AMC Contract - Live Update</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
												<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">
													Discipline<span class="reqindi">*</span>
											</div>
											<div class="div9">
												<select name="cmb_discipline" id="cmb_discipline" class="tboxsmclass ChosenInput">
													<option value="">---------- Select ----------</option>
												</select>
											</div>
											<div class="div3 label">
													AMC Type<span class="reqindi">*</span>
											</div>
											<div class="div9">
												<select name="cmb_amc_type" id="cmb_amc_type" class="tboxsmclass ChosenInput">
													<option value="">---------- Select ----------</option>
												</select>
											</div>
											<div class="div3 label">
													AMC Bases On<span class="reqindi">*</span>
											</div>
											<div class="div9">
												<select name="cmb_bases_on" id="cmb_bases_on" class="tboxsmclass ChosenInput">
													<option value="">---------- Select ----------</option>
												</select>
											</div>
											<div class="div3 label">AMC File Name<span class="reqindi">*</span></div>
											<div class="div9"><textarea name="txt_amc_file_name" id="txt_amc_file_name" class="tboxsmclass" value=""></textarea></div>
											<div class="div3 label">Description of Equipment<span class="reqindi">*</span></div>
											<div class="div9"><textarea name="txt_desc_equip" id="txt_desc_equip" class="tboxsmclass" value=""></textarea></div>
											<div class="row smclearrow"></div>
											<div class="div3 label">
												Vendor Name<span class="reqindi">*</span>
											</div>
											<div class="div9">
												<select name="cmb_vendor_name" id="cmb_vendor_name" class="tboxsmclass ChosenInput">
													<option value="">---------- Select ----------</option>
												</select>
											</div>
											<div class="row smclearrow"></div>
											<div class="div3 label">AMC Cost &#8377;<span class="reqindi">*</span></div>
											<div class="div3"><input type="text" name="txt_amsc_cost" id="txt_amsc_from_date" class="tboxsmclass datepicker" value=""></div>
											<div class="div2 label pd-l-20">&emsp; &emsp;&emsp;GST &#37;<span class="reqindi">*</span></div>
											<div class="div2"><input type="text" name="txt_amsc_gst" id="txt_amsc_to_date" class="tboxsmclass datepicker" value=""></div>
											<div class="row smclearrow"></div>
											<div class="div3 label label">
												Tax on Cost<span class="reqindi">*</span>
											</div>
											<div class="div2 no-margin">
												<div class="inputGroup paddlr2">
													<input id="rad_inc" name="rad_tax_inc" type="radio" value="INC"/>
													<label for="rad_inc" style="padding:3px 0px; width:100%"> &nbsp;Including</label>
												</div>
											</div>
											<div class="div2 no-margin">
												<div class="inputGroup paddlr2">
													<input id="rad_exc" name="rad_tax_inc" type="radio" value="EXC"/>
													<label for="rad_exc" style="padding:3px 0px; width:100%"> &nbsp;Excluding</label>
												</div>
											</div>
											<div class="row smclearrow"></div>
											<div class="div3 label">
												Location Name<span class="reqindi">*</span>
											</div>
											<div class="div9">
												<select name="cmb_loc_name" id="cmb_loc_name" class="tboxsmclass ChosenInput" multiple>
													<option value="">---------- Select ----------</option>
												</select>
											</div>
											<div class="row smclearrow"></div>
											@php $AddUrl = 'roles.ViewRoleMaster'; @endphp										
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
	$(".ChosenInput").chosen();
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
