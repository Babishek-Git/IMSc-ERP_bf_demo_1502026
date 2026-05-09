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
								<div class="div12 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Manage Work Flow of Modules</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div2 label">Division <span class="reqindi">*</span></div>
												<div class="div4">
													<select class="OrgType module tboxclass" data-OrgType="D" name="cmb_division" id="cmb_division">
														<option value="">----------------------- Select ------------------------</option>
														@if(isset($data['OfficeList']))
															@foreach($data['OfficeList'] as $key => $value)
																@if((session('WcmsRoleGroupCode') == 'ADMUSER' && $value->office_id == session('WcmsEmpDiv') && $value->active == 1) || (session('WcmsRoleGroupCode') == 'ACCADMUSER' && $value->office_id == session('WcmsEmpDiv') && $value->active == 1) || (session('WcmsRoleGroupCode') == 'SUPUSER' && $value->active == 1))
																	@if($value->active == 1)
																		<option value="{{$value->office_id}}">{{$value->office_name}}</option>
																	@endif
																@endif
															@endforeach
														@endif
													</select>
												</div>
											</div>   
											<div class="row smclearrow"></div>                                                                              											
											<div class="row">
												<div class="div2 label">Section </div>
												<div class="div4">
													<select class="OrgType module tboxclass" data-OrgType="S" name="cmb_section" id="cmb_section">
														<option value="">----------------------- Select ------------------------</option>
													</select>
												</div>
											</div>  
											<div class="row smclearrow"></div>                                                                              											
											<div class="row">
												<div class="div2 label">Sub-Section </div>
												<div class="div4">
													<select class="module tboxclass" data-OrgType="SS" name="cmb_sub_section" id="cmb_sub_section">
														<option value="">----------------------- Select ------------------------</option>
													</select>
												</div>
											</div>  
											<div class="row smclearrow"></div>                                                                              											
											
											<div class="row">
												<div class="div2 label">Module Name <span class="reqindi">*</span></div>
												<div class="div4">
													<select class="module tboxclass" name="cmb_module" id="cmb_module">
														<option value="">----------------------- Select ------------------------</option>
													</select>
												</div>
												<!-- <div class="div1 label">&nbsp;<input type="button" class="backbutton" name="" id="" value="NEXT"/></div> -->
											</div>
											<div class="row clearrow"></div>
											<div class="row">
												<table class="dataTable etable " align="center" width="100%" id="RoleTable">
													<tr class="label" style="background-color:#FFF">
														<th align="center" style="width:80px">Start Range</th>
														<th align="center" style="width:80px">End Range</th>
														<th align="center">Maximum Approving Authority</th>
														<th align="center">Initiate Role</th>
														<th align="center" colspan="2">Target Roles</th>
														<th align="center" style="width:80px">&nbsp;</th>
													</tr>
													<tr class="label" style="background-color:#FFF">
														<input type="hidden" name="txt_mapped_role_0" id="txt_mapped_role_0" value="">
														<div class="MappedRole" id="MappedRole">
													</tr>
												</table>
											</div>
											<div class="row">
												<div class="div12" align="center">
													<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
												</div>		
											</div>
											<div class="row smclearrow"></div>  
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
<style>
	.role-span{
		padding:3px 6px;
		border:1px solid #767F83;
		border-radius:8px;
		display: inline-block;
		margin:1px 1px;
	}
	.role-span-tag{
		background-color:#0B8EC7;
		color:#fff;
		padding:2px 6px 3px 6px;
		border-radius:15px;
	}
	.role-span-close{
		background-color:#D0D2D4;
		color:#000;
		padding:1px 6px 2px 5px;
		border-radius:15px;
		cursor:pointer;
		font-weight:500;
	}
	.role-span-close:hover{
		background-color:#000;
		color:#fff;
	}
	.no-border {
	    border: none !important;
	}
	.rbadge1{
		margin-right:2px;
	}
	.tooltip-l {
		position: relative;
		display: inline;
	}
	#RoleTable {
	  	table-layout: fixed;
	  	width: 100%;
	}

  	.checkbox-wrapper-31:hover .check {
  	  	stroke-dashoffset: 0;
  	}

  	.checkbox-wrapper-31 {
  	  	position: relative;
  	  	display: inline-block;
  	  	width: 23px;
  	  	height: 23px;
  	}
  	.checkbox-wrapper-31 .background {
  	  	fill: #ccc;
  	  	transition: ease all 0.6s;
  	  	-webkit-transition: ease all 0.6s;
  	}
  	.checkbox-wrapper-31 .stroke {
  	  	fill: none;
  	  	stroke: #fff;
  	  	stroke-miterlimit: 10;
  	  	stroke-width: 2px;
  	  	stroke-dashoffset: 100;
  	  	stroke-dasharray: 100;
  	  	transition: ease all 0.6s;
  	  	-webkit-transition: ease all 0.6s;
  	}
  	.checkbox-wrapper-31 .check {
  	  	fill: none;
  	  	stroke: #fff;
  	  	stroke-linecap: round;
  	  	stroke-linejoin: round;
  	  	stroke-width: 2px;
  	  	stroke-dashoffset: 22;
  	  	stroke-dasharray: 22;
  	  	transition: ease all 0.6s;
  	  	-webkit-transition: ease all 0.6s;
  	}
  	.checkbox-wrapper-31 input[type=checkbox] {
  	  	position: absolute;
  	  	width: 100%;
  	  	height: 100%;
  	  	left: 0;
  	  	top: 0;
  	  	margin: 0;
  	  	opacity: 0;
  	  	-appearance: none;
  	  	-webkit-appearance: none;
  	}
  	.checkbox-wrapper-31 input[type=checkbox]:hover {
  	 	cursor: pointer;
  	}
  	.checkbox-wrapper-31 input[type=checkbox]:checked + svg .background {
  	  	fill: #6cbe45;
  	}
  	.checkbox-wrapper-31 input[type=checkbox]:checked + svg .stroke {
  	  	stroke-dashoffset: 0;
  	}
  	.checkbox-wrapper-31 input[type=checkbox]:checked + svg .check {
  	  	stroke-dashoffset: 0;
  	}
	.role-span-appr{
		background-color:#b8f2d1;
		border : 1px solid #3c5245;
	}
</style>
<script type="text/javascript" language="javascript">
$(document).ready(function() {
	$('#cmb_division').chosen();
	$('#cmb_section').chosen();
	$('#cmb_sub_section').chosen();
	$('#cmb_role_name').chosen();
});


$("body").on("change","#cmb_role_0", function(event){
	let Role = $(this).val();
	let RoleName = $("option:selected", this).text();
	let leng = $("#MappedRole > .MapSpan").length;
	leng++;
	let SpanStr = '<span class="MapSpan role-span" data-role="'+Role+'"><span class="MapTag role-span-tag">'+leng+'</span> '+RoleName+' <span class="role-span-close MapClose">x</span></span>';
	$("#MappedRole").append(SpanStr);
	$(this).val('');
	let MappedRole = $("#txt_mapped_role_0").val();
	if(MappedRole != ''){
		var RoleArr = MappedRole.split(',')
	}else{
		var RoleArr = [];
	}
	RoleArr.push(Role);
	$("#txt_mapped_role_0").val(RoleArr.join(","));
});

var Index = 1;
$("body").on("click",".DelRole", function(event){
	$(this).closest('tr').remove();
});
function ClearRow(){
	$("#txt_start_range_0").val('');
	$("#txt_end_range_0").val('');
	$("#cmb_appr_auth_0").val('');
	$("#txt_mapped_role_0").val('');
	$("#cmb_init_role_0").val('');
	$("#MappedRole").html('');
	$('#cmb_appr_auth_0').chosen('destroy').chosen();
	$('#cmb_init_role_0').chosen('destroy').chosen();
	$('#cmb_role_0').chosen('destroy').chosen();
}
$("body").on("change",".module", function(event){
	let ModuleId = $('#cmb_module').val();
	let DivisionId = $('#cmb_division').val();
	let SectionId = $('#cmb_section').val();
	let SubSectionId = $('#cmb_sub_section').val();

	
	$("#RoleTable tr:gt(1)").remove();
	$.ajax({ 
		type: 'POST', 
		url: "{{ route('ajax.GetDivSubSecModuleWorkFlow') }}",
		data: {'_token': '{{ csrf_token() }}',  'ModuleId':ModuleId, 'DivisionId':DivisionId, 'SectionId':SectionId, 'SubSectionId':SubSectionId}, 
		//dataType: 'json',
		success: function (data) {  
			if((data != '')&&(data != null)){
				let ModuleData 	= data['ModuleData'];
				let RoleData 	= data['RoleData'];
				if((ModuleData != null)&&(ModuleData != '')){
					$.each(ModuleData, function(index, element) { 
						let TargetRoles = element.target_roles;
						if(TargetRoles != null){
							var SplitTargetRoles = TargetRoles.split(",");
						}else{
							var SplitTargetRoles = [];
						}
						//SplitTargetRoles = TargetRoles.split(",");
						var RoleNameArr = []; 
						if(SplitTargetRoles.length > 0){
							let leng = 1;
							$.each(SplitTargetRoles, function(index, element) { 
								if(RoleData[element] != null){
									let RoleStr = RoleData[element].role_name;
									let SpanStr = '<span class="MapSpan role-span" data-role="'+element+'"><span class="MapTag role-span-tag">'+leng+'</span> '+RoleStr+' <span class="role-span-close MapClose">x</span></span>';
									RoleNameArr.push(SpanStr);
									leng++;
								}
							});
						}
						if(element.bill_type == "FB"){
							var BillTypeText = '<label style="padding-top:4px;"><span style="background:red; color:white; font-weight:bold; padding:5px 4px;">Final Bill</span></label>&nbsp;&nbsp;';
						}else if(element.bill_type == "RAB"){
							var BillTypeText = '<label style="padding-top:4px;"><span style="background:green; color:white; font-weight:bold; padding:5px 4px;">RAB</span></label>&nbsp;&nbsp;';
						}else{
							var BillTypeText = "";
						}
						if(element.budget_type == "C"){
							var BudgetTypeText = '<label style="padding-top:4px;"><span style="background:red; color:white; font-weight:bold; padding:5px 4px;">Capital</span></label>&nbsp;&nbsp;';
						}else if(element.budget_type == "R"){
							var BudgetTypeText = '<label style="padding-top:4px;"><span style="background:green; color:white; font-weight:bold; padding:5px 4px;">Revenue</span></label>&nbsp;&nbsp;';
						}else if(element.budget_type == "CR"){
							var BudgetTypeText = '<label style="padding-top:4px;"><span style="background:green; color:white; font-weight:bold; padding:5px 4px;">Capital & Revenue</span></label>&nbsp;&nbsp;';
						}else{
							var BudgetTypeText = "";
						}
						let RoleName = RoleNameArr.join("")
						let RowStr = '<tr class="label" style="background-color:#FFF">';
							RowStr += '<td align="center" style="width:80px;"><input type="text" name="txt_start_range[]" id="txt_start_range_'+Index+'" class="tboxclass disable" readonly="" value="'+element.start_range+'"></td>';
							RowStr += '<td align="center" style="width:80px;"><input type="text" name="txt_end_range[]" id="txt_end_range_'+Index+'" class="tboxclass disable" readonly="" value="'+element.end_range+'"></td>';
							RowStr += '<td align="center" style="width:200px;"><select class="group tboxclass cmb_appr_auth" name="cmb_appr_auth[]" id="cmb_appr_auth_'+Index+'">';
							RowStr += '<option value="'+element.appr_auth+'">'+RoleData[element.appr_auth].role_name+'</option>';
							RowStr += '</select><input type="hidden" name="txt_mapped_role[]" id="txt_mapped_role_'+Index+'" value="'+element.target_roles+'"><input type="hidden" name="txt_mod_trans_id[]" id="txt_mod_trans_id_'+Index+'" value="'+element.work_load_id+'"></td>';
							RowStr += '<td align="center" style="width:200px;"><select class="group tboxclass" name="cmb_init_role[]" id="cmb_init_role'+Index+'">';
							RowStr += '<option value="'+element.initiate_role+'">'+RoleData[element.initiate_role].role_name+'</option>';
							RowStr += '</select></td>';
							RowStr += '<td align="left" colspan="2" style="width:450px;"><input type="hidden" name="bill_type[]" id="bill_type'+Index+'" value="'+element.bill_type+'"><input type="hidden" name="budget_type[]" id="budget_type'+Index+'" value="'+element.budget_type+'">'+BudgetTypeText+BillTypeText+RoleName+'</td>';
							RowStr += '<td align="center"><button type="button" data-id="'+Index+'" data-flow-id="'+element.work_load_id+'" class="btn btn-default btn_edit teditbtn" title="Click here to Edit" style="cursor: pointer; width:70px;"><i class="fa fa-edit pt2"></i></button><br><br>';
							RowStr += '<button type="button" name="btn_add_role" dataid="'+Index+'" data-flowid="'+element.work_load_id+'" class="backbutton btn_add_role" style="width: 70px; display: flex; justify-content: center; align-items: center; text-align: center;" title="Click here to add new target role">New Target Roles</button></td></tr>';
						$("#RoleTable").find('tr:last').after(RowStr);
						Index++;
						
					});
				}
			}
		}
	});
});

$("body").on("click", ".btn_add_role", function(event) {
	let DataId = $(this).attr("dataid");
	let WorkLoadId = $(this).attr("data-flowid");
	let ModuleCode = $('#cmb_module option:selected').attr('data-mcode');
	let ModuleName = $('#cmb_module option:selected').attr('data-mname');
	$.ajax({ 
		type: 'POST', 
		url: "{{ route('ajax.ShowModuleWorkFlowById') }}",
		data: {'_token': '{{ csrf_token() }}',  'wfloadid':WorkLoadId }, 
		//dataType: 'json',
		success: function (data) {
			if((data != '')&&(data != null)){
				var TableStr = '&nbsp;&nbsp;&nbsp;&nbsp;<table class="table dataTable rtable table2excel example" id="StmtTable" border="1" style="width:100%" align="center">';
				TableStr += '<tr><td class="no-border" colspan="7" align="center"><span class="rbadge1 rbadgeA tooltip-l"><b>'+ModuleName+'</b></span></td></tr>';
				let ModuleData 	= data['WfData'];
				let RoleData 	= data['RoleData'];
				if((ModuleData != null)&&(ModuleData != '')){
					$.each(ModuleData, function(index, element) { 
						let TargetRoles = element.target_roles;
						if(TargetRoles != null){
							var SplitTargetRoles = TargetRoles.split(",");
						}else{
							var SplitTargetRoles = [];
						}
						//SplitTargetRoles = TargetRoles.split(",");
						var RoleNameArr = []; 
						if(SplitTargetRoles.length > 0){
							let leng = 1;
							$.each(SplitTargetRoles, function(index, element) { 
								if(RoleData[element] != null){
									let RoleStr = RoleData[element].role_name;
									let SpanStr = '<span class="MapSpan role-span" data-role="'+element+'"><span class="MapTag role-span-tag">'+leng+'</span> '+RoleStr+' </span>';
									RoleNameArr.push(SpanStr);
									leng++;
								}
							});
						}
						if(element.bill_type == "FB"){
							var BillTypeText = '<label style="padding-top:4px;"><span style="background:red; color:white; font-weight:bold; padding:5px 4px;">Final Bill</span></label>&nbsp;&nbsp;';
						}else if(element.bill_type == "RAB"){
							var BillTypeText = '<label style="padding-top:4px;"><span style="background:green; color:white; font-weight:bold; padding:5px 4px;">RAB</span></label>&nbsp;&nbsp;';
						}else{
							var BillTypeText = "";
						}
						if(element.budget_type == "C"){
							var BudgetTypeText = '<label style="padding-top:4px;"><span style="background:red; color:white; font-weight:bold; padding:5px 4px;">Capital</span></label>&nbsp;&nbsp;';
						}else if(element.budget_type == "R"){
							var BudgetTypeText = '<label style="padding-top:4px;"><span style="background:green; color:white; font-weight:bold; padding:5px 4px;">Revenue</span></label>&nbsp;&nbsp;';
						}else if(element.budget_type == "CR"){
							var BudgetTypeText = '<label style="padding-top:4px;"><span style="background:green; color:white; font-weight:bold; padding:5px 4px;">Capital & Revenue</span></label>&nbsp;&nbsp;';
						}else{
							var BudgetTypeText = "";
						}
						let RoleName = RoleNameArr.join("")
						TableStr += '<tr class="label" style="background-color:#FFF">';
						TableStr += '<td align="left" colspan="2"><input type="hidden" name="bill_type[]" id="bill_type'+Index+'" value="'+element.bill_type+'"><input type="hidden" name="budget_type[]" id="budget_type'+Index+'" value="'+element.budget_type+'">'+BudgetTypeText+BillTypeText+RoleName+'</td>';							
						TableStr += '</tr>';
						TableStr += '<th align="center">Is Approving Authority ?</th>';
						TableStr += '<th align="center">Role<span class="reqindi">*</span> </th>';
						TableStr += '<tr class="label" style="background-color:#FFF">';
						TableStr += '<td align="center">';
						TableStr += '<input type="checkbox" id="chk_appr_auth" name="chk_appr_auth" value="">';
						TableStr += '<input type="hidden" name="txt_appr_role" id="txt_appr_role" value="">';
						TableStr += '</td>';
						TableStr += '<td align="center">';
						TableStr += '<select class="group tboxclass" name="cmb_roles" id="cmb_roles">';
						TableStr += '<option value=""> --- Select ----</option>';
						$.each(RoleData, function(key, value) {
							TableStr += '<option value="'+value.roleid+'" data-apprauth-role="'+value.role_name+'">'+value.role_name+'</option>';
						});
						TableStr += '</select>';
						TableStr += '<input type="hidden" name="txt_mapped_roles" id="txt_mapped_roles" value="">';
						TableStr += '</td>';
						TableStr += '<tr>';
						TableStr += '<td align="left" colspan="3"><div class="MappedRoles" id="MappedRoles"></div></td></tr>';
						TableStr += '</table>';
						TableStr += '<input type="hidden" name="hid_workloadid" id="hid_workloadid" value="'+element.work_load_id+'">';
						TableStr += '<div align="center"><input type="button" name="btn_save_targetrole" class="backbutton btn_save_targetrole" value=" Save "></div>';
					});
				}
			}
			BootstrapDialog.show({
				message: TableStr,
				title: 'Work Flow',
				size: 'large',
				onshown: function (dialogRef) {
					$(".modal-dialog").css('width', '65%');
					$('#cmb_roles').chosen({width: "200px"});
				}
			});
		}

	});
});
$("body").on("change","#cmb_roles", function(event){
	let Role = $('#cmb_roles').val();
	let IsApprAuth = $('#chk_appr_auth').is(':checked');
	let RoleName = $('#cmb_roles option:selected').text();
	let leng = $("#MappedRoles > .MapSpan").length;
	chk_appr_auth
	leng++; 
	if(IsApprAuth){
		var ApprRole = $("#txt_appr_role").val();
		if(ApprRole != ''){
			BootstrapDialog.alert("Already Approving Authority is selected");
			event.preventDefault();
			event.returnValue = false;
		}else{
			let SpanStr = '<span class="MapSpan role-span role-span-appr" data-role="'+Role+'"><span class="MapTag role-span-tag">'+leng+'</span>&nbsp;<span style="color:#de4531">'+RoleName+' </span><span class="role-span-close MapClose" align="right">x</span></span>';
			$("#MappedRoles").append(SpanStr);
			$("#txt_appr_role").val(Role);
			$('#chk_appr_auth').prop('checked', false);
		}			
	}else{
		let SpanStr = '<span class="MapSpan role-span" data-role="'+Role+'"><span class="MapTag role-span-tag">'+leng+'</span>&nbsp;'+RoleName+' <span class="role-span-close MapClose" align="right">x</span></span>';
		$("#MappedRoles").append(SpanStr);			
	}
	$(this).val('');
	let MappedRole = $("#txt_mapped_roles").val();
	if(MappedRole != ''){
		var RoleArr = MappedRole.split(',');
	}else{
		var RoleArr = []; 
	}
	RoleArr.push(Role); 
	$("#txt_mapped_roles").val(RoleArr.join(","));
	
});
$("body").on("click", ".MapClose", function(event) {
    var MappedRole = $(this).closest('.MappedRoles');
    var MapSpan = $(this).closest('.MapSpan'); // Get the element to be removed
    var DeleteRole = MapSpan.attr("data-role");
    var ApprRole = $("#txt_appr_role").val();

    if (DeleteRole == ApprRole) {
        $("#txt_appr_role").val('');
    }

    MapSpan.remove(); // Correct way to remove the element

    // Re-indexing and updating the hidden field
    let i = 1;
    var RoleArr = [];

    MappedRole.children('.MapSpan').each(function() {
        var Role = $(this).attr("data-role");
        $(this).children('.MapTag').text(i); // Update number label
        i++;
        RoleArr.push(Role);
    });

    $("#txt_mapped_roles").val(RoleArr.join(","));
});


$("body").on("click", ".btn_edit", function(event) {
	let DataId = $(this).attr("data-id");
	let WorkLoadId = $(this).attr("data-flow-id");
	let ModuleCode = $('#cmb_module option:selected').attr('data-mcode');
	let ModuleName = $('#cmb_module option:selected').attr('data-mname');
	$.ajax({ 
		type: 'POST', 
		url: "{{ route('ajax.ShowModuleWorkFlowById') }}",
		data: {'_token': '{{ csrf_token() }}',  'wfloadid':WorkLoadId }, 
		//dataType: 'json',
		success: function (data) {
			let WfLoadData = data['WfData'];
			let RoleData = data['RoleData'];
			if(DataId != ''){
				var TableStr = '&nbsp;&nbsp;&nbsp;&nbsp;<table class="table dataTable rtable table2excel example" id="StmtTable" style="border:1px solid black" style="width:70%" align="center">';
				TableStr += '<tr><td class="no-border" colspan="7" align="center"><span class="rbadge1 rbadgeA tooltip-l"><b>'+ModuleName+'</b></span></td></tr>';
				TableStr += '<thead>';
				TableStr += '</thead>';
				TableStr += '<tbody>';
				TableStr += '<tr>';
				$.each(WfLoadData, function(index, element) {
					TableStr += '<td class="no-border" style="width:15%"></td>';
					TableStr += '<td class="no-border" style="width:25%" align="left"><div class="label">Start Range<span class="reqindi">*</span></div></td>';
					TableStr += '<td class="no-border" style="width:75%"><input type="text" id="txt_start_range" class="tboxclass numberonly restrictpaste" style="width:200px" value="'+element.start_range+'"></td>';
					TableStr += '</tr>';
					TableStr += '<tr>';
					TableStr += '<td class="no-border" style="width:15%"></td>';
					TableStr += '<td class="no-border" name="" align="left"><div class="label">End Range<span class="reqindi">*</span></div></td>';
					TableStr += '<td class="no-border"><input type="text" name="" id="txt_end_range" class="tboxclass numberonly restrictpaste" style="width:200px" value="'+element.end_range+'"></td>';
					TableStr += '</tr>';
					TableStr += '<tr>';
					TableStr += '<td class="no-border" style="width:15%"></td>';
					TableStr += '<td class="no-border" name="" align="left"><div class="label">Approving Authority<span class="reqindi">*</span></div></td>';
					TableStr += '<td class="no-border"><select name="cmb_appr_auth" id="cmb_appr_auth" class="tboxclass" style="width:200px">';
					TableStr += '<option value="">---------Select--------</option>';
					let selectedApprAuth = element.appr_auth; 
					let selectedInitRole = element.initiate_role;
					let selectedBudgetType = element.budget_type;
					$.each(RoleData, function(key, value) {
						let ApprAuth = (value.roleid == selectedApprAuth) ? ' selected' : '';
						TableStr += '<option value="'+value.roleid+'" data-apprauth-role="'+value.role_name+'" '+ApprAuth+'>'+value.role_name+'</option>';
					});
					TableStr += '</select></td>';
					TableStr += '</tr>';
					TableStr += '<tr>';
					TableStr += '<td class="no-border" style="width:15%"></td>';
					TableStr += '<td class="no-border" name="" align="left"><div class="label">Initiate Role<span class="reqindi">*</span></div></td>';
					TableStr += '<td class="no-border"><select name="cmb_Init_role" id="cmb_Init_role" class="tboxclass" style="width:200px">';
					TableStr += '<option value="">---------Select--------</option>';
					$.each(RoleData, function(key, value) { 
						let InitRole = (value.roleid == selectedInitRole) ? ' selected' : '';
						TableStr += '<option value="'+value.roleid+'" data-init-role="'+value.role_name+'" '+InitRole+'>'+value.role_name+'</option>';
					});
					TableStr += '</select></td>';
					TableStr += '</tr>';
					let BugetType = '';
					if(ModuleCode == "TS" || ModuleCode == "RTS"){
						TableStr += '<tr>';
						TableStr += '<td class="no-border" style="width:15%"></td>';
						TableStr += '<td class="no-border" name="" align="left"><div class="label">Budget Type<span class="reqindi">*</span></div></td>';
						TableStr += '<td class="no-border"><select name="cmb_budg_type" id="cmb_budg_type" class="tboxclass" style="width:200px">';
						TableStr += '<option value="">---------Select--------</option>';
						// Capital
						TableStr += '<option value="C"' + (element.budget_type == "C" ? ' selected' : '') + '>Capital</option>';
						// Revenue
						TableStr += '<option value="R"' + (element.budget_type == "R" ? ' selected' : '') + '>Revenue</option>';
						// Integrated Capital
						TableStr += '<option value="CR"' + (element.budget_type == "CR" ? ' selected' : '') + '>Integrated Capital</option>';

						TableStr += '</select></td>';
						TableStr += '</tr>';
					}
					if(ModuleCode == "BILLV"){
						TableStr += '<tr>';
						TableStr += '<td class="no-border" style="width:15%"></td>';
						TableStr += '<td class="no-border" name="" align="left"><div class="label">Budget Type<span class="reqindi">*</span></div></td>';
						TableStr += '<td class="no-border"><select name="cmb_bill_type" id="cmb_bill_type" class="tboxclass" style="width:200px">';
						TableStr += '<option value="">---------Select--------</option>';
						TableStr += '<option value="FB"'+(element.bill_type == "FB" ? 'selected':'') + '>Final Bill</option>';
						TableStr += '<option value="RAB"'+(element.bill_type == "RAB" ? 'selected':'') + '>RAB</option>';
						TableStr += '</select></td>';
						TableStr += '</tr>';
					}
					TableStr += '<tr>';
					TableStr += '<td class="no-border" style="width:15%"></td>';
					TableStr += '<td class="no-border" align="left"><div class="label">Tartget Roles<span class="reqindi">*</span></div></td>';
					TableStr += '<td class="no-border">';
					let TargetRoles = element.target_roles;
					if(TargetRoles != null){
						var SplitTargetRoles = TargetRoles.split(",");
					}else{
						var SplitTargetRoles = [];
					}
					//SplitTargetRoles = TargetRoles.split(",");
					var RoleNameArr = []; 
					if(SplitTargetRoles.length > 0){
						let leng = 1;
						$.each(SplitTargetRoles, function(index, element) {
						if (RoleData[element] != null) {
							let RoleStr = RoleData[element].role_name;
							TableStr += '<div class="role-block" style="margin-bottom:10px;">';
							TableStr += '<span class="MapTag role-span-tag">'+leng+'</span> <input type="text" name="txt_role_name[]" id="txt_role_name" class="tboxclass disable txt-role-name" value="'+RoleStr+'" style="width:180px" readonly>';
							TableStr += '<input type="hidden" name="txt_role_id_'+index+'" id="txt_role_id_'+index+'" class="tboxclass disable txt-role-id" value="'+element+'">';
							TableStr += '&nbsp;&nbsp; <div class="checkbox-wrapper-31"><input type="checkbox" class="cmb_role" data-index="'+index+'"/><svg viewBox="0 0 35.6 35.6"><circle class="background" cx="17.8" cy="17.8" r="17.8"></circle><circle class="stroke" cx="17.8" cy="17.8" r="14.37"></circle><polyline class="check" points="11.78 18.12 15.55 22.23 25.17 12.87"></polyline></svg></div>';
							TableStr += '&nbsp;&nbsp;<select name="cmb_role_name" id="cmb_role_name" class="tboxclass role-select" style="display:none; width:180px">';
							TableStr += '<option value="">------Select------</option>';
							TableStr += '<option value="">Remove Role</option>';
							$.each(RoleData, function(key, value) { 
								TableStr += '<option value="'+value.roleid+'" data-role="'+value.role_name+'">'+value.role_name+'</option>';
							});
							TableStr += '</select>';
							TableStr += '</div>';
							leng++;
							}
						});
						TableStr += '<input type="hidden" name="hid_role_name" id="hid_role_name" value="">';
					}
					TableStr += '<input type="hidden" name="hid_work_loadid" id="hid_work_loadid" value="'+element.work_load_id+'">';
					TableStr += '<input type="hidden" name="hid_module_name" id="hid_module_name" value="'+ModuleCode+'">';
				});
				TableStr += '</td>';
				TableStr += '</tr>';
				TableStr += '</tbody>';
				TableStr += '</table>';
				TableStr += '<br><div align="center"><input type="button" name="btn_save" class="backbutton btn_save" value=" Save "></div>';
				BootstrapDialog.show({
					message: TableStr,
					title: 'Edit Work Flow',
					size: 'large',
					onshown: function (dialogRef) {
						$(".modal-dialog").css('width', '60%');
						// Initialize Chosen on dynamically added select boxes
						$('#cmb_appr_auth').chosen({width: "200px"});
						$('#cmb_Init_role').chosen({width: "200px"});
						$('#cmb_budg_type').chosen({width: "200px"});
					}
				});
			}
		}
	});	
});
$("body").on("click", ".cmb_role", function() {
	let currentRoleBlock = $(this).closest(".role-block");
	let selectBox = currentRoleBlock.find(".role-select");

	// Destroy any previously initialized Chosen inside this block only
	if (selectBox.data('chosen')) {
		selectBox.chosen('destroy');
	}

	// Hide all dropdowns and reset value
	$(".role-select").hide().val("");

	// Show and re-initialize only the currently toggled select
	if ($(this).is(":checked")) {
		selectBox.show().chosen({width: "180px"});
	}
});
$("body").on("change", ".role-select", function() {
	// Get current checkbox's parent role block
	let selectedOption = $(this).find("option:selected");
	let roleid = $(this).val();
	let roleName = selectedOption.data("role");
	let $block = $(this).closest('.role-block');
	$block.find(".txt-role-name").val(roleName);
	$block.find(".txt-role-id").val(roleid);

});
let TargetRoleIds = [];

// Select all hidden inputs starting with id="txt_role_id_"

var KillEvent = 0;
$("body").on("click",".btn_save", function(event){ //btn_save_targetrole
	if(KillEvent == 0){
		TargetRoleIds = [];
		$("input[id^='txt_role_id_']").each(function() {
		    let val = $(this).val();
		    if (val !== '') {
		        TargetRoleIds.push(val);
		    }
			$("#hid_role_name").val(TargetRoleIds.join(","));
		});
		var ModuleName = $("#hid_module_name").val();
		var BudgType = $("#cmb_budg_type").val();
		var BillType = $("#cmb_bill_type").val();
		var TargetRoleId = $("#hid_role_name").val();
		var WorkLoadId = $("#hid_work_loadid").val();
		var ApprAuthId = $("#cmb_appr_auth").val();
		var InitRoleId = $("#cmb_Init_role").val();
		var StartRange = $("#txt_start_range").val();
		var EndRange   = $("#txt_end_range").val();
		var StartRg = parseFloat(StartRange);
		var EndRg   = parseFloat(EndRange);
		if(StartRange == ''){
			BootstrapDialog.alert("Please Enter the Start Range..!!");
			event.preventDefault();
			event.returnValue = false;
		}else if(EndRange == ''){
			BootstrapDialog.alert("Please Enter the End Range..!!");
			event.preventDefault();
			event.returnValue = false;
		}else if(EndRg <= StartRg){
			BootstrapDialog.alert("End Range Should be greater than Start Range...!!");
			event.preventDefault();
			event.returnValue = false;
		}else if(ApprAuthId == ''){
			BootstrapDialog.alert("Please Select the Approving Authority name..!!");
			event.preventDefault();
			event.returnValue = false;
		}else if((ModuleName == "TS" || ModuleName == "RTS") && BudgType == ''){
			BootstrapDialog.alert("Please Select the Budget Type..!!");
			event.preventDefault();
			event.returnValue = false;
		}else if(ModuleName == "BILLV" && BillType == ''){
			BootstrapDialog.alert("Please Select the Bill Type..!!");
			event.preventDefault();
			event.returnValue = false;
		}else if(TargetRoleId == ''){
			BootstrapDialog.alert("Please Select the Target Role..!!");
			event.preventDefault();
			event.returnValue = false;
		}else if(InitRoleId == ''){
			BootstrapDialog.alert("Please Select the Initiate Role..!!");
			event.preventDefault();
			event.returnValue = false;
		}else{
			event.preventDefault();
			BootstrapDialog.confirm({
				title: 'Confirmation Message',
				message: 'Are you sure want to Assign these Work Flow ?',
				closable: false, // <-- Default value is false
				draggable: false, // <-- Default value is false
				btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
				btnOKLabel: 'Ok', // <-- Default value is 'OK',
				callback: function(result) {
					if(result){
						KillEvent = 1;
						$.ajax({ 
							type: 'POST', 
							url: "{{ route('module.SaveEditModuleWorkFlow') }}",
							data: {'_token': '{{ csrf_token() }}','ModuleName':ModuleName,'BudgType':BudgType,'BillType':BillType,'WorkLoadId': WorkLoadId,'ApprAuthId': ApprAuthId,'InitRoleId': InitRoleId,'StartRange': StartRange,'EndRange': EndRange,'TargetRoleId':TargetRoleId }, 
							success: function (data) {
								if (data != null && data.message) {
									BootstrapDialog.alert({
										title: 'Success',
										message: data.message,
										type: BootstrapDialog.TYPE_SUCCESS,
										callback: function () {
											window.location.href = "{{ route('module.EditWorkFlowModule') }}";
										}
									});
								}
							}
						});
					}else {
						KillEvent = 0;
					}
				}
			});
		}
	}
});
$("body").on("click",".btn_save_targetrole", function(event){ //btn_save_targetrole
	if(KillEvent == 0){
		TargetRoleIds = [];
		$("input[id^='txt_mapped_roles']").each(function() {
		    let val = $(this).val();
		    if (val !== '') {
		        TargetRoleIds.push(val);
		    }
			$("#txt_mapped_roles").val(TargetRoleIds.join(","));
		});
		var ApprAuthRole = $("#txt_appr_role").val();
		var TargetRoleId = $("#txt_mapped_roles").val();
		var WfLoadId = $("#hid_workloadid").val();
		if(TargetRoleId == ''){
			BootstrapDialog.alert("Please Select the Role Name..!!");
			event.preventDefault();
			event.returnValue = false;
		}else if(ApprAuthRole == ''){
			BootstrapDialog.alert("Please Select the Approving Authority Role..!!");
			event.preventDefault();
			event.returnValue = false;
		}else{
			event.preventDefault();
			BootstrapDialog.confirm({
				title: 'Confirmation Message',
				message: 'Are you sure want to Update Work Flow ?',
				closable: false, // <-- Default value is false
				draggable: false, // <-- Default value is false
				btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
				btnOKLabel: 'Ok', // <-- Default value is 'OK',
				callback: function(result) {
					if(result){
						KillEvent = 1;
						$.ajax({ 
							type: 'POST', 
							url: "{{ route('module.SaveEditModuleTargetRoles') }}",
							data: {'_token': '{{ csrf_token() }}', 'ApprAuthRole':ApprAuthRole,'WfLoadId':WfLoadId,'TargetRoleId':TargetRoleId }, 
							success: function (data) {
								if (data != null && data.message) {
									BootstrapDialog.alert({
										title: 'Success',
										message: data.message,
										type: BootstrapDialog.TYPE_SUCCESS,
										callback: function () {
											window.location.href = "{{ route('module.EditWorkFlowModule') }}";
										}
									});
								}
							}
						});
					}else {
						KillEvent = 0;
					}
				}
			});
		}
	}
});
$(document).ready(function() {
    $('#cmb_module').chosen();
	$('#cmb_appr_auth_0').chosen();
	$('#cmb_init_role_0').chosen();
	$('#cmb_role_0').chosen();

});
$("body").on("change", "#cmb_division", function(event) {

	$("#cmb_module").chosen('destroy');
	$('#cmb_module').children('option:not(:first)').remove();
	$("#cmb_module").chosen();
	$("#cmb_section").chosen('destroy');
	$('#cmb_section').children('option:not(:first)').remove();
	$("#cmb_section").chosen();
	$("#cmb_sub_section").chosen('destroy');
	$('#cmb_sub_section').children('option:not(:first)').remove();
	$("#cmb_sub_section").chosen();

    $.ajax({
        type: 'POST',
        url: "{{ route('ajax.GetModulesByDivision') }}", 
        data: {"_token": "{{ csrf_token() }}"},
        success: function(data) {
            if (data != null) {
                var moduleSelect = $("#cmb_module");
				$("#cmb_module").chosen('destroy');
				$("#cmb_section").chosen('destroy');
				$("#cmb_sub_section").chosen('destroy');
                $.each(data, function(index, module) {
                    moduleSelect.append($('<option>', {
                        value: module.wf_moduleid,
                        text: module.wf_module_name,
                        'data-mcode': module.wf_module_code,
						'data-mname': module.wf_module_name
                    }));
                });
				$('#cmb_module').chosen();
				$('#cmb_section').chosen();
				$('#cmb_sub_section').chosen();
            }
        }
    });
});

$("body").on("change", ".OrgType", function(event) {
	var DivisionID = $('#cmb_division').val();
	var SectionID = $('#cmb_section').val();
	var OrgType 	= $(this).attr("data-OrgType");

	if(OrgType = 'S'){ 
		$("#cmb_section").chosen('destroy');
		// $('#cmb_section').children('option:not(:first)').remove();
		$("#cmb_section").chosen();

	}
	if(OrgType === 'S' || OrgType === 'SS'){
		$("#cmb_sub_section").chosen('destroy');
		$('#cmb_sub_section').children('option:not(:first)').remove();
		$("#cmb_sub_section").chosen();
	}
    $.ajax({
        type: 'POST',
        url: "{{ route('ajax.GetModulesDataForSection') }}", 
        data: {"_token": "{{ csrf_token() }}",'DivisionID':DivisionID ,'SectionID':SectionID},
		success: function(data) {
			if (data != null) { 
				var Section = $("#cmb_section");
				var SubSection = $("#cmb_sub_section");
				if(OrgType = 'S'){
					if(data.length > 0 && data[0].office_type === 'S') { 
						$("#cmb_section").chosen('destroy');
						$.each(data, function(index, section) { 
							Section.append($('<option>', {
								value: section.office_id,
								text: section.office_name
							}));
						});
						$('#cmb_section').chosen();
					}
				}
				if(OrgType === 'S'||OrgType === 'SS'){
					if(data.length > 0 && data[0].office_type === 'SS') {
						$("#cmb_sub_section").chosen('destroy');
						SubSection.append($('<option>', {
							value: '',
							text: 'All Sub Section'
						}));
						$.each(data, function(index, subsection) {
							SubSection.append($('<option>', {
								value: subsection.office_id,
								text: subsection.office_name
							}));
						});
						$('#cmb_sub_section').chosen();
					}
				}
			}

		}
    });
});
$('body').on('keypress', ".numberonly",function(evt){
	var result = $(this).val();	
	var charCode = (evt.which) ? evt.which : event.keyCode;
	var dot1 	 = result.indexOf('.');
	var dot2 	 = result.lastIndexOf('.'); 
	var val 	 = result;
	var SplitVal = val.split(".");
	var len 	 = SplitVal.length;
	var Fraction = SplitVal[1];
	if(Fraction){
		var fractLen = Fraction.length;
	}else{
		var fractLen = 0;
	}
	if(charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)){
		return false;
	}else if (charCode == 46 && (dot1 == dot2) && dot1 != -1 && dot2 != -1){
		return false;
	}else if(isNaN(SplitVal[0])){
		//Recovery = 'x';
		return false;
	}else if(isNaN(SplitVal[1]) && Number(fractLen) > 0){
		//Recovery = 'x';
		return false;
	}else if (fractLen > 1){
		return false;
	}else{
		return true;
	}
});
$('.restrictpaste').on('paste', function(ev) {
	ev.preventDefault();
});
</script>
@endsection
