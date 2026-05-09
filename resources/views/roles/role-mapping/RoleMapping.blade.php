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
							<div class="row ">
								<div class="div1">&nbsp;</div>
								<div class="div10 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Employee Role Mapping</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
											<div class="row smclearrow"></div>                                                                                											
											<div class="div2 label">Employee No.</div>
											<div class="div4"><input type="text" name="txt_emp_no" id="txt_emp_no" class="tboxclass" autocomplete="off"></div>
											<div class="row smclearrow"></div> 
											<div class="div2 label">Employee Name</div>
											<div class="div4"><input type="text" name="txt_emp_name" id="txt_emp_name" class="tboxclass disable" disabled=""></div>
											<div class="row smclearrow"></div>
											<div class="div2 label">Designation</div>
											<div class="div4"><input type="text" name="txt_emp_design" id="txt_emp_design" class="tboxclass disable" disabled=""></div>
											<div class="row smclearrow"></div>
											<div class="row clearrow"></div>
											<div class="row">
												<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="left">Mapped Roles</div></div></div>
												<table class="formtable" align="center" width="100%" id="RoleTable">
													<tr class="label" style="background-color:#FFF">
														<th align="center" width="200px">Group</th>
														<th align="center" width="200px">Division</th>
														<th align="center" width="200px">Section</th>
														<th align="center" width="200px">Role</th>
														<th align="center" width="100px">Action</th>
													</tr>
													<tr id="secondRow">
														<td align="center">
															<select class="tboxsmclass" name="cmb_group" id="cmb_group" style="width:100%;">
																	<option value="">----- Select ----</option>
																@if(isset($data['ShowGrandParent']))
																	@foreach($data['ShowGrandParent'] as $key => $value)
																		@if((session('WcmsRoleGroupCode') == 'ADMUSER' && $value->office_id == session('WcmsEmpGroup') && $value->active == 1) || (session('WcmsRoleGroupCode') == 'ACCADMUSER' && $value->office_id == session('WcmsEmpGroup') && $value->active == 1) || (session('WcmsRoleGroupCode') == 'ACCUSER' && $value->office_id == session('WcmsEmpGroup') && $value->active == 1) || (session('WcmsRoleGroupCode') == 'SUPUSER' && $value->active == 1))
																			<option value="{{$value->office_id}}">{{$value->office_name}}</option>
																		@endif
																	@endforeach
																@endif
															</select>
														</td>		
														<td align="center">
															<select class="tboxsmclass" name="cmb_division" id="cmb_division" style="width:100%;">
																	<option value="">----- Select ----</option>
															</select>
														</td>
														<td align="center">
															<select class="tboxsmclass" name="cmb_section" id="cmb_section" style="width:100%;">
																	<option value="">----- Select ----</option>
															</select>
														</td>
														
														<td align="center">
															<select class="tboxsmclass" name="cmb_role" id="cmb_role" style="width:100%;">
																	<option value="">----- Select ----</option>
																@if(isset($data['data']))
																@foreach($data['data'] as $key => $value)
																	<option value="{{$value->roleid}}">{{$value->role_name}}</option>
																@endforeach
																@endif
															</select>
														</td>
														<td align="center" style="vertical-align:middle;"><input type="button" name="role_add" id="role_add" value="ADD" class="btn btn-info" style="margin-top:0px;"></td>
													</tr>
												</table>
											</div>											
											@php $AddUrl = 'roles.ViewRoleMapping'; @endphp
											<div class="row">
												<div class="div12" align="center">
												<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" View " onClick="window.location='{{route($AddUrl)}}'" />
												<input type="submit" class="step-btn" name="btn_save" id="btn_save" value=" Save " />									
												<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
												</div>		
											</div>
											<div class="row smclearrow"></div>  
										</div>
									</div>										
								</div>
								<div class="div1">&nbsp;</div>
							</div>                           
						</div>
					</blockquote>
				</div>
			</div>
		</div>
	</form>
</body>	
<script type="text/javascript" language="javascript">

	var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var EmpNo   = $("#txt_emp_no").val();
			var Group  	= $("#cmb_group").val();
			var Role 	= $("#cmb_role").val();
			var rowCount	= $('#RoleTable tr').length;

			if(EmpNo == ''){
				BootstrapDialog.alert("Employee Number should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(rowCount <= 2 ) {
				BootstrapDialog.alert(" Please Add Atleast One Role Mapping Details..!!");
				event.preventDefault();
				event.returnValue = false;
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure want to save Role Mapping Details ?',
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
	

	$(document).ready(function() {
		$("#cmb_group").chosen();
		$("#cmb_division").chosen();
		$("#cmb_section").chosen();
		$("#cmb_section").chosen();
		$("#cmb_role").chosen();
	});

	$("body").on("change", "#cmb_group, #cmb_division, #cmb_section", function(event){
		var Id = $(this).val();
		var cmbDivision = $("#cmb_division");
		var cmbSection = $("#cmb_section");

		if (Id != "") {
			$.ajax({
				type: 'POST',
				url: '{{ route("organization.Reporttooffice") }}',
				data: { "_token": "{{ csrf_token() }}", Id: Id },
				dataType: 'json',
				success: function (data) {
					if ($(event.target).is("#cmb_group")) {
						cmbDivision.empty();
						cmbDivision.append('<option value="">----- Select ----</option>');
						cmbSection.empty();
						cmbSection.append('<option value="">----- Select ----</option>');
						if (data && data['GetOfficeRepoToOffice']) {
							$.each(data['GetOfficeRepoToOffice'], function(key, value){
								if (
									(data['WcmsRoleGroupCode'] == 'ADMUSER' && value.office_id == data['WcmsEmpDiv'] && value.active == 1) ||
									(data['WcmsRoleGroupCode'] == 'ACCADMUSER' && value.office_id == data['WcmsEmpDiv'] && value.active == 1) ||
									(data['WcmsRoleGroupCode'] == 'ACCUSER' && value.office_id == data['WcmsEmpDiv'] && value.active == 1) ||
									(data['WcmsRoleGroupCode'] == 'SUPUSER' && value.active == 1)
								) {
									cmbDivision.append('<option value="' + value.office_id + '">' + value.office_name + '</option>');
								}							
							});
						}
					} else if ($(event.target).is("#cmb_division")) {
						cmbSection.empty();
						cmbSection.append('<option value="">----- Select ----</option>');
						if (data && data['GetOfficeRepoToOffice']) {
							$.each(data['GetOfficeRepoToOffice'], function(key, value){
								cmbSection.append('<option value="' + value.office_id + '">' + value.office_name + '</option>');
							});
						}
					}
					cmbDivision.trigger("chosen:updated");
                	cmbSection.trigger("chosen:updated");
				}
			});
		} else {
			if ($(event.target).is("#cmb_group")) {
				cmbDivision.empty();
				cmbDivision.append('<option value="">----- Select ----</option>');
			} else if ($(event.target).is("#cmb_division")) {
				cmbSection.empty();
				cmbSection.append('<option value="">----- Select ----</option>');
			}
			cmbDivision.trigger("chosen:updated");
            cmbSection.trigger("chosen:updated");
		}
	});
	$("body").on("change","#txt_emp_no", function(event){
		var EmpNo = $(this).val();
		if((EmpNo != '')&&(EmpNo != null)){
			$.ajax({ 
				type: 'POST', 
				url: "{{ route('employee.GetEmployeeRoles') }}",
				data: {'_token': '{{ csrf_token() }}', 'EmpNo':EmpNo}, 
				//dataType: 'json',
				success: function (data) {  
					if(data != ''){ 
						let EmpData 	= data['EmpData'];
						if((EmpData != '')&&(EmpData != null)){
							$.each(EmpData, function(index, element) { 
								$("#txt_emp_name").val(element.emp_name_payslip);
								$("#txt_emp_design").val(element.designation_name);
							});
						}else{
							BootstrapDialog.alert("Please Enter the Correct Employee Number");
							$('#txt_emp_no').val("");
						}
					}
				}
			});
		}
	});

	$("body").on("click", "#role_add", function(event){ 
		var Group 		= $("#cmb_group option:selected").text();
		var Division 	= $("#cmb_division option:selected").text();
		var Section 	= $("#cmb_section option:selected").text();
		var Role 		= $("#cmb_role option:selected").text();
		
		var GroupId 		= $("#cmb_group").val();
		var DivisionId 		= $("#cmb_division").val();
		var SectionId 		= $("#cmb_section").val();
		var RoleId 			= $("#cmb_role").val();

		GroupId 	 = (GroupId === undefined) ? '' 	: GroupId;
		DivisionId 	 = (DivisionId === undefined) ? '' 	: DivisionId;
		SectionId 	 = (SectionId === undefined) ? '' 	: SectionId;
		if (Division === "----- Select ----") {
			Division = '';  
		}
		if (Section === "----- Select ----") {
			Section = '';  
		}
		var RowStr ='<tr><td align="center"><input type="text" maxlength="20" name="cmb_group[]" class="tboxsmclass disable" readonly="" value="'+Group+'"></td><input type="hidden" maxlength="20" name="cmb_group_id[]" class="tboxsmclass disable" readonly="" value="'+GroupId+'"><td align="center"><input type="text" maxlength="20" name="cmb_division[]" class="tboxsmclass disable" readonly="" value="'+Division+'"></td><input type="hidden" maxlength="20" name="cmb_division_id[]" class="tboxsmclass disable" readonly="" value="'+DivisionId+'"><td align="center"><input type="text" maxlength="20" name="cmb_section[]" class="tboxsmclass disable" readonly="" value="'+Section+'"></td><input type="hidden" maxlength="20" name="cmb_section_id[]" class="tboxsmclass disable" readonly="" value="'+SectionId+'"><td align="center"><input type="text" maxlength="20" name="cmb_role[]" class="tboxsmclass disable" readonly="" value="'+Role+'"></td><input type="hidden" maxlength="20" name="cmb_role_id[]" class="tboxsmclass disable" readonly="" value="'+RoleId+'"><td align="center"><input type="button" class="delete fa btn btn-info" name="role_delete" id="role_delete" value="DELETE"></td></tr>'
		if(GroupId == 0){
			BootstrapDialog.alert("Group name should not be empty");
			return false;
		}else if(RoleId == 0){
			BootstrapDialog.alert("Role Name should not be empty");
			return false;
		}else{
			$("#RoleTable").append(RowStr);
			$("#cmb_group").val('');
			$("#cmb_division").empty('');
			$("#cmb_section").empty('');
			$("#cmb_role").val('');
			$('#cmb_group').chosen('destroy').chosen();
			$('#cmb_division').chosen('destroy').chosen();
			$('#cmb_section').chosen('destroy').chosen();
			$('#cmb_role').chosen('destroy').chosen();
		}
	});

	$("body").on("click", "#role_delete", function(){
		$(this).closest("tr").remove();
	});
</script>
@endsection
