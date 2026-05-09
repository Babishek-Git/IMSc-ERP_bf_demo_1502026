@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
if(isset($data['UpdateData'])){
	foreach($data['UpdateData'] as $UpdateData){
		$EmpIcNo   = $UpdateData->ic_no;
		$EmpName   = $UpdateData->emp_name_payslip;
		$Desig     = $UpdateData->designation_name;
		$EmpDOB    = $UpdateData->emp_doj;
		$EmpDOJ    = $UpdateData->emp_doj;
		$EmpDOR    = $UpdateData->emp_retirement_dt;
		$GroupName = $UpdateData->group;
		$DivName   = $UpdateData->division;
		$SecName   = $UpdateData->section;
	}
}
if(isset($data['RoleBaseMapping'])){
	foreach($data['RoleBaseMapping'] as $RoleBaseMapping){
		$RoleId   = $RoleBaseMapping->roleid;
	}
}	

if(isset($data['UserListData'])){
	$UserListData = $data['UserListData'];
	$UserList = collect($UserListData)->pluck('emp_no')->toArray();
}else{
	$UserList = [];
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
							<div class="row">
								<div class="div2"></div>
								<div class="div8">
									<div class="form-box">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">User Creation</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
												<div class="row smclearrow"></div>                                                                                											
												<div class="div2 label">Employee Name</div>
												<div class="div5">
													<select name="cmb_emp_name" id="cmb_emp_name" class="tboxsmclass ChosenInput">
														<option value="">-------- Select------</option>
														@if(isset($data['EmpData']))
														@foreach($data['EmpData'] as $EmpData)
															
															<option value="{{$EmpData->emp_no}}"{{ $EmpData->emp_no == ($EmpIcNo ?? null) ? 'selected' : '' }}>{{$EmpData->emp_name_payslip}}--{{$EmpData->ic_no}}--{{$EmpData->designation_name}}</option>
															
														@endforeach
														@endif
													</select>
												</div>
												<div class="div2 cboxlabel">User Name</div>
												<div class="div3">
													<input type="text" name="txt_username" id="txt_username" readonly class="tboxsmclass" value="@if(isset($EmpIcNo)){{$EmpIcNo}}@endif">
												</div>
												<div class="row smclearrow"></div> 
												<div class="row smclearrow"></div> 
												<fieldset class="fieldbox">
													<legend class="fieldbox-legend">Basic information</legend>
													<div class="fieldbox-div">
														<div class="div2 label label">IC No</div>
														<div class="div2"><input type="text" name="txt_emp_icno" id="txt_emp_icno" readonly class="tboxsmclass" value="@if(isset($EmpIcNo)){{$EmpIcNo}}@endif"></div>
														<div class="div2 label pd-l-20">Name</div>
														<div class="div2"><input type="text" name="txt_emp_name" id="txt_emp_name" readonly class="tboxsmclass" value="@if(isset($EmpName)){{$EmpName}}@endif"></div>
														<div class="div2 label pd-l-20">Designation</div>
														<div class="div2"><input type="text" name="txt_designation" id="txt_designation" class="tboxsmclass " value="@if(isset($Desig)){{$Desig}}@endif"></div>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
														<div class="div2 label">Date of Birth</div>
														<div class="div2"><input type="text" name="txt_dob" id="txt_dob" readonly class="tboxsmclass" value="@if(isset($EmpDOB)){{Helper::DisplayDateFormat($EmpDOB)}}@endif"></div>
														<div class="div2 label pd-l-20">Date of Joining</div>
														<div class="div2"><input type="text" name="txt_doj" id="txt_doj" readonly class="tboxsmclass" value="@if(isset($EmpDOJ)){{Helper::DisplayDateFormat($EmpDOJ)}}@endif"></div>
														<div class="div2 label pd-l-20">Date of Retirement</div>
														<div class="div2"><input type="text" name="txt_date_retire" id="txt_date_retire" class="tboxsmclass" value="@if(isset($EmpDOR)){{Helper::DisplayDateFormat($EmpDOR)}}@endif"></div>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
														<div class="div2 label">Group</div>
														<div class="div2"><input type="text" name="txt_group" id="txt_group" readonly class="tboxsmclass" value="@if(isset($GroupName)){{$GroupName}}@endif"></div>
														<div class="div2 label pd-l-20">Divison</div>
														<div class="div2"><input type="text" name="txt_div" id="txt_div" readonly class="tboxsmclass" value="@if(isset($DivName)){{$DivName}}@endif"></div>
														<div class="div2 label pd-l-20">Section</div>
														<div class="div2"><input type="text" name="txt_sec" id="txt_sec" readonly class="tboxsmclass" value="@if(isset($SecName)){{$SecName}}@endif"></div>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
													</div>
												</fieldset> 
												<fieldset class="fieldbox">
													<legend class="fieldbox-legend">Choose Your Options</legend>
													<div class="fieldbox-div">
														<div>
															<div class="div1 label"><input type="checkbox" name="is_portal_acces_allow"  class="tboxsmclass" value="Y"></div> 
															<div class="div6 label padl">Is Employee Portal Access Allowed</div>
															<!-- <label><input type="checkbox" name="is_portal_acces_allow" value="Y"> Is Employee Portal Access Allowed</label><br> -->
														</div>
														<div id="AdminSection">
														</div>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
													</div>
												</fieldset>
												<fieldset class="fieldbox">
													<legend class="fieldbox-legend">Choose Role</legend>
													<div class="fieldbox-div">
														<div>
															<div class="div2 label">Roles</div>
												<div class="div6">
													<select name="cmb_role_name" id="cmb_role_name" class="tboxsmclass ChosenInput">
														<option value="">-------- Select------</option>
														@if(isset($data['RoleBaseMapping']))
														@foreach($data['RoleBaseMapping'] as $RoleBaseMapping)
															<option value="{{$RoleBaseMapping->roleid}}"{{ $RoleBaseMapping->roleid == ($RoleId ?? null) ? 'selected' : '' }}>{{$RoleBaseMapping->role_name}}</option>
														@endforeach
														@endif
													</select>
												</div>	
													</div>
													<div id="AdminSection">
													</div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
												</fieldset>
											</div>
											@php
												$BackUrl = 'user.ViewUser'; 
											@endphp
											<div class="row" align="center">
												<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" Back " onClick="window.location='{{route($BackUrl)}}'" />
												<button type="submit" id="btn_save" name="btn_save" class="step-btn" value="Save">SAVE</button> 
												<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
												<div class="row smclearrow"></div>
												<div class="row smclearrow"></div>
												<div class="row smclearrow"></div>
												<div class="row smclearrow"></div>
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
	$(".ChosenInput").chosen();
	$('#dataTable').DataTable({
		responsive: true,
		paging: true, 
	});
	var IsSecAdminChkBoxThr="";
	var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var EMPNo   	= $("#txt_emp_no").val();
			var UserName   	= $("#txt_username").val();
			if(EMPNo == ''){
				BootstrapDialog.alert("Please Enter the Employee No..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(UserName == ''){
				BootstrapDialog.alert("User Name should not be blank..!!");
				event.preventDefault();
				event.returnValue = false;
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure want to save the User ?',
					closable: false,
					draggable: false, 
					btnCancelLabel: 'Cancel', 
					btnOKLabel: 'Ok', 
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

	$("body").on("change", "#cmb_emp_name", function (event) {
		if (IsSecAdminChkBoxThr= "YES"){
			$("#AdminSection").empty(); 
		}
		if (RoleAlreadyAdded= "YES"){
			$("#AdminSection").empty(); 
			//$("#cmb_role_name").empty(); 
		}
		$("#cmb_role_name").chosen("destroy");
		$("#cmb_role_name").find("option:not(:first)").remove();
		var EmpNo = $(this).val();
		if ((EmpNo != '') && (EmpNo != null)) {
			$.ajax({
				type: 'POST',
				url: "{{ route('employee.GetEmployeeData') }}",//this 'employee.GetEmployeeData' is 'obj created in the controller.funName'
				data: { "_token": "{{ csrf_token() }}", 'EmpNo': EmpNo },
				// dataType: 'json',
				success: function (data) {
					console.log(data); 
					if (data != '') {
						let EmpData = data['EmpData']; 
						let GroupRoleData = data['GroupRoleData']; console.log(EmpData);
						if ((EmpData != '') && (EmpData != null)) {
							$.each(EmpData, function (index, element) { 
								var Dob = GlobalFormatDateDDMMYYYY(element.emp_dob);
								var Doj = GlobalFormatDateDDMMYYYY(element.emp_doj);
								var Dor = GlobalFormatDateDDMMYYYY(element.emp_retirement_dt);
								$("#txt_emp_icno").val(element.ic_no);
								$("#txt_emp_name").val(element.emp_name_payslip);
								$("#txt_designation").val(element.designation_name);
								$("#txt_dob").val(Dob);         
								$("#txt_doj").val(Doj);
								$("#txt_date_retire").val(Dor);
								$("#txt_group").val(element.group);
								$("#txt_div").val(element.division_short_name);
								$("#txt_sec").val(element.section);
								let OfficeEmail = element.emp_off_email;
								if((OfficeEmail != '')&&(OfficeEmail != null)){
									let UserName = OfficeEmail.includes("@") ? OfficeEmail.split("@")[0] : "";
									if(UserName != ""){
										$("#txt_username").val(UserName.toLowerCase());
									}else{
										BootstrapDialog.alert('Error : Invalid office email id.')
									}
								}else{
									BootstrapDialog.alert('Error : The office email ID should be available to create a user.')
								}
								if(element.section_id && element.section) {
									//$("#AdminSection").append( '<label><input type="checkbox" name="is_section_admin" value="' + element.section_id + '"> Is He/She ' + element.section + ' Administrator</label><br>' );
									// $("#AdminSection").append( '<label class="tboxsmclass"><input type="checkbox" name="is_section_admin" value="' + element.section_id + '"> Is He/She ' + element.section + ' Administrator</label><br>' );
									//IsSecAdminChkBoxThr= "YES";
								}
							});
						}
						if(GroupRoleData != null){
							$.each(GroupRoleData, function (index, element) { 
								$("#cmb_role_name").append('<option value="'+element.roleid+'">'+element.role_name+'</option>');
								RoleAlreadyAdded= "YES";
							});
						}
					}
					$("#cmb_role_name").chosen();
				}
			});
		}
	});


</script>
@endsection
