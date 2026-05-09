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
													<select class="group tboxclass" name="cmb_division" id="cmb_division">
														<option value="">---------- Select ----------</option>
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
												<div class="div2 label">Module Name <span class="reqindi">*</span></div>
												<div class="div4">
													<select class="group tboxclass" name="cmb_module" id="cmb_module">
														<option value="">---------- Select ----------</option>
													</select>
												</div>
												<!-- <div class="div1 label">&nbsp;<input type="button" class="backbutton" name="" id="" value="NEXT"/></div> -->
											</div>
											<div class="row clearrow"></div>
											<div class="row">
												<table class="dataTable etable " align="center" width="100%" id="RoleTable">
													<tr class="label" style="background-color:#FFF">
														<th align="center">Start Range</th>
														<th align="center">End Range</th>
														<th align="center">Maximum Approving Authority</th>
														<th align="center">Initiate Role</th>
														<th align="center" colspan="2">Target Roles</th>
														<th align="center">&nbsp;</th>
													</tr>
													<tr class="label" style="background-color:#FFF">
														<td align="center"><input type="text" name="txt_start_range_0" id="txt_start_range_0" class="tboxclass" maxlength="19" ></td>
														<td align="center"><input type="text" name="txt_end_range_0" id="txt_end_range_0" class="tboxclass" maxlength="19" ></td>
														<td align="center">
															<select class="group tboxclass" name="cmb_appr_auth_0" id="cmb_appr_auth_0" style="width:160px;">
																<option value=""> --- Select ----</option>
																@if(isset($data['RoleData'])) 
																@foreach($data['RoleData'] as $Roles)
																@if($Roles->active == 1)
																<option value="{{ $Roles->roleid }}">{{ $Roles->role_name }}</option>
																@endif
																@endforeach
																@endif
															</select>
															<input type="hidden" name="txt_mapped_role_0" id="txt_mapped_role_0" value="">
														</td>
														<td align="center"  style="width:200px;">
															<select class="group tboxclass" name="cmb_init_role_0" id="cmb_init_role_0" style="width:160px;">
																<option value=""> --- Select ----</option>
																@if(isset($data['RoleData'])) 
																@foreach($data['RoleData'] as $Roles)
																@if($Roles->active == 1)
																<option value="{{ $Roles->roleid }}">{{ $Roles->role_name }}</option>
																@endif
																@endforeach
																@endif
															</select>
														</td>
														<td align="center"  style="width:200px;">
															<select class="group tboxclass" name="cmb_role_0" id="cmb_role_0">
																<option value=""> --- Select ----</option>
																@if(isset($data['RoleData'])) 
																@foreach($data['RoleData'] as $Roles)
																@if($Roles->active == 1)
																<option value="{{ $Roles->roleid }}">{{ $Roles->role_name }}</option>
																@endif
																@endforeach
																@endif
															</select>
														</td>
														<td align="left" style="width:450px;"><div class="MappedRole" id="MappedRole"></div></td>
														<td align="center"><i class="fa fa-plus-square sqadd ptr inp disable" id="AddRole" style="font-size:24px; color:#029339"></i></td>
													</tr>
													
													

												</table>
											</div>
											
											
											<div class="row">
												<div class="div12" align="center">
													<input type="submit" class="backbutton" name="btn_save" id="btn_save" value="Save" />									
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
</style>
<script type="text/javascript" language="javascript">

$('#cmb_division').chosen();

var KillEvent = 0;
$("body").on("click","#btn_save", function(event){
	if(KillEvent == 0){
		var Division   		= $("#cmb_division").val();
		var ModuleName   	= $("#cmb_module").val();
		var rowCount		= $('#RoleTable tr').length;

		if(Division == ''){
			BootstrapDialog.alert("Please Select the Division..!!");
			event.preventDefault();
			event.returnValue = false;
		}else if(ModuleName == ""){
			BootstrapDialog.alert("Please Select the Module Name..!!");
			event.preventDefault();
			event.returnValue = false;
		}else if(rowCount <= 2 ) {
			BootstrapDialog.alert("Please Add Atleast One Work Flow Details..!!");
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
						$("#btn_save").trigger( "click" );
					}else {
						KillEvent = 0;
					}
				}
			});
		}
	}
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
$("body").on("click",".MapClose", function(event){
	var MappedRole = $(this).closest('.MappedRole');
	$(this).closest('.MapSpan').remove();
	let i = 1;
	var RoleArr = [];
	MappedRole.each(function(){
		$(this).children('.MapSpan').each(function(){
			var Role = $(this).attr("data-role");
			$(this).children('.MapTag').text(i);
			i++;
			RoleArr.push(Role);
		});
	});
	$("#txt_mapped_role_0").val(RoleArr.join(","));
});
var Index = 1;
$("body").on("click","#AddRole", function(event){
	let StartRange = $("#txt_start_range_0").val();
	let EndRange = $("#txt_end_range_0").val();
	let ApprAuth = $("#cmb_appr_auth_0").val();
	let ApprAuthText = $("#cmb_appr_auth_0 option:selected").text();
	let InitRole = $("#cmb_init_role_0").val();
	let InitRoleText = $("#cmb_init_role_0 option:selected").text();
	let MappedRole = $("#txt_mapped_role_0").val();
	let MappedRoleNames = $("#MappedRole").html();
	let ModuleCode = $('#cmb_module option:selected').attr('data-mcode'); 
	var BillType = ""; var BudgetType = "";
	var x = 0;
	if(StartRange == ""){
		BootstrapDialog.alert("Start Range Should not be empty...!!");
		e.preventDefault();
		e.returnValue = false;
	}
	let StartRg = parseFloat(StartRange);
	let EndRg = parseFloat(EndRange);
	if(StartRg >= EndRg){
		BootstrapDialog.alert("End Range Should be greater than Start Range...!!");
		e.preventDefault();
		e.returnValue = false;
	}
	else if(EndRange == ""){
		BootstrapDialog.alert("End Range Should not be empty...!!");
		e.preventDefault();
		e.returnValue = false;
	}
	else if(ApprAuth == ""){
		BootstrapDialog.alert("Please select Approving Authority...!!");
		e.preventDefault();
		e.returnValue = false;
	}
	else if(InitRole == ""){
		BootstrapDialog.alert("Please select Initial Role...!!");
		e.preventDefault();
		e.returnValue = false;
	}
	else if(MappedRole == ""){
		BootstrapDialog.alert("Please select Target Roles...!!");
		e.preventDefault();
		e.returnValue = false;
	}
	else{
		if(ModuleCode == "BILLV"){
			x = 1;
			var BillTypeStr  = '<div class="label">Bill Type - (RAB / Final Bill)<div>';
				BillTypeStr += '<div class="label">&nbsp;&nbsp;<div>';
				BillTypeStr += '<div class="label">&nbsp;&nbsp;<div>';
			 	BillTypeStr += '<div class="label"><input type="radio" name="modal_bill_type" id="modal_bill_type_rab" value="RAB"> &nbsp;&nbsp;RAB<div>';
			 	BillTypeStr += '<div class="label">&nbsp;&nbsp;<div>';
				BillTypeStr += '<div class="label"><input type="radio" name="modal_bill_type" id="modal_bill_type_fb" value="FB"> &nbsp;&nbsp;Final Bill<div>';

			BootstrapDialog.show({
	            title: 'Bill Type Information',
	            message: BillTypeStr,
	            buttons: [{
	                label: ' OK ',
	                cssClass: 'btn-primary',
	                action: function(dialogref) {
	                    if ($('input[name=modal_bill_type]:checked').length <= 0) {  
							BootstrapDialog.alert("Please select Bill Type");
						}else{
							x = 0;
							BillType = $('input[name=modal_bill_type]:checked').val();
							if(BillType == "FB"){
								var BillTypeText = '<label style="padding-top:4px;"><span style="background:red; color:white; font-weight:bold; padding:5px 4px;">Final Bill</span></label>&nbsp;&nbsp;';
							}else if(BillType == "RAB"){
								var BillTypeText = '<label style="padding-top:4px;"><span style="background:green; color:white; font-weight:bold; padding:5px 4px;">RAB</span></label>&nbsp;&nbsp;';
							}else{
								var BillTypeText = "";
							}
							let RowStr = '<tr class="label" style="background-color:#FFF">';
								RowStr += '<td align="center"><input type="text" name="txt_start_range[]" id="txt_start_range_'+Index+'" class="tboxclass" value="'+StartRange+'"></td>';
								RowStr += '<td align="center"><input type="text" name="txt_end_range[]" id="txt_end_range_'+Index+'" class="tboxclass" value="'+EndRange+'"></td>';
								RowStr += '<td align="center"><select class="group tboxclass" name="cmb_appr_auth[]" id="cmb_appr_auth_'+Index+'">';
								RowStr += '<option value="'+ApprAuth+'">'+ApprAuthText+'</option>';
								RowStr += '</select><input type="hidden" name="txt_mapped_role[]" id="txt_mapped_role_'+Index+'" value="'+MappedRole+'"><input type="hidden" name="txt_mod_trans_id[]" id="txt_mod_trans_id_'+Index+'"></td>';
								RowStr += '<td align="center"><select class="group tboxclass" name="cmb_init_role[]" id="cmb_init_role'+Index+'">';
								RowStr += '<option value="'+InitRole+'">'+InitRoleText+'</option>';
								RowStr += '</select></td>';
								RowStr += '<td align="left" colspan="2"><input type="hidden" name="bill_type[]" id="bill_type'+Index+'" value="'+BillType+'"><input type="hidden" name="budget_type[]" id="budget_type'+Index+'" value="'+BudgetType+'">'+BillTypeText+MappedRoleNames+'</td>';
								RowStr += '<td align="center"><i class="fa fa-times-circle sqdel ptr DelRole" data-index="'+Index+'" style="font-size:24px; color:#D10B37"></i></td>';
								RowStr += '</tr>';
							$("#RoleTable").find('tr:last').after(RowStr);
							ClearRow();
							Index++;
							dialogref.close();
						}
	                }
	            }]
	        });
		}else if((ModuleCode == "TS")||(ModuleCode == "RTS")){
			x = 1;
			var BudgetTypeStr  = '<div class="label">Budget Type - (Capital / Revenue)<div>';
				BudgetTypeStr += '<div class="label">&nbsp;&nbsp;<div>';
				BudgetTypeStr += '<div class="label">&nbsp;&nbsp;<div>';
				BudgetTypeStr += '<div class="label"><input type="radio" name="modal_budget_type" id="modal_budget_type_c" value="C"> &nbsp;&nbsp;Capital<div>';
				BudgetTypeStr += '<div class="label">&nbsp;&nbsp;<div>';
				BudgetTypeStr += '<div class="label"><input type="radio" name="modal_budget_type" id="modal_budget_type_r" value="R"> &nbsp;&nbsp;Revenue<div>';
				BudgetTypeStr += '<div class="label">&nbsp;&nbsp;<div>';
				BudgetTypeStr += '<div class="label"><input type="radio" name="modal_budget_type" id="modal_budget_type_cr" value="CR"> &nbsp;&nbsp;Both Capital & Revenue<div>';
				BudgetTypeStr += '<div class="label">&nbsp;&nbsp;<div>';
				BudgetTypeStr += '<div class="label"><input type="radio" name="modal_budget_type" id="modal_budget_type_na" value=""> &nbsp;&nbsp;Not Applicable<div>';
			BootstrapDialog.show({
	            title: 'Budget Type Information',
	            message: BudgetTypeStr,
	            buttons: [{
	                label: ' OK ',
	                cssClass: 'btn-primary',
	                action: function(dialogref) {
	                    if ($('input[name=modal_budget_type]:checked').length <= 0) {  
							BootstrapDialog.alert("Please select Budget Type");
						}else{
							x = 0;
							BudgetType = $('input[name=modal_budget_type]:checked').val();
							if(BudgetType == "C"){
								var BudgetTypeText = '<label style="padding-top:4px;"><span style="background:red; color:white; font-weight:bold; padding:5px 4px;">Capital</span></label>&nbsp;&nbsp;';
							}else if(BudgetType == "R"){
								var BudgetTypeText = '<label style="padding-top:4px;"><span style="background:green; color:white; font-weight:bold; padding:5px 4px;">Revenue</span></label>&nbsp;&nbsp;';
							}else if(BudgetType == "CR"){
								var BudgetTypeText = '<label style="padding-top:4px;"><span style="background:green; color:white; font-weight:bold; padding:5px 4px;">Both Capital & Revenue</span></label>&nbsp;&nbsp;';
							}else{
								var BudgetTypeText = "";
							}
							let RowStr = '<tr class="label" style="background-color:#FFF">';
								RowStr += '<td align="center"><input type="text" name="txt_start_range[]" id="txt_start_range_'+Index+'" class="tboxclass" value="'+StartRange+'"></td>';
								RowStr += '<td align="center"><input type="text" name="txt_end_range[]" id="txt_end_range_'+Index+'" class="tboxclass" value="'+EndRange+'"></td>';
								RowStr += '<td align="center"><select class="group tboxclass" name="cmb_appr_auth[]" id="cmb_appr_auth_'+Index+'">';
								RowStr += '<option value="'+ApprAuth+'">'+ApprAuthText+'</option>';
								RowStr += '</select><input type="hidden" name="txt_mapped_role[]" id="txt_mapped_role_'+Index+'" value="'+MappedRole+'"><input type="hidden" name="txt_mod_trans_id[]" id="txt_mod_trans_id_'+Index+'"></td>';
								RowStr += '<td align="center"><select class="group tboxclass" name="cmb_init_role[]" id="cmb_init_role'+Index+'">';
								RowStr += '<option value="'+InitRole+'">'+InitRoleText+'</option>';
								RowStr += '</select></td>';
								RowStr += '<td align="left" colspan="2"><input type="hidden" name="bill_type[]" id="bill_type'+Index+'" value="'+BillType+'"><input type="hidden" name="budget_type[]" id="budget_type'+Index+'" value="'+BudgetType+'">'+BudgetTypeText+MappedRoleNames+'</td>';
								RowStr += '<td align="center"><i class="fa fa-times-circle sqdel ptr DelRole" data-index="'+Index+'" style="font-size:24px; color:#D10B37"></i></td>';
								RowStr += '</tr>';
							$("#RoleTable").find('tr:last').after(RowStr);
							ClearRow();
							Index++;
							dialogref.close();
						}
	                }
	            }]
	        });
		}else{
			let RowStr = '<tr class="label" style="background-color:#FFF">';
				RowStr += '<td align="center"><input type="text" name="txt_start_range[]" id="txt_start_range_'+Index+'" class="tboxclass" value="'+StartRange+'"></td>';
				RowStr += '<td align="center"><input type="text" name="txt_end_range[]" id="txt_end_range_'+Index+'" class="tboxclass" value="'+EndRange+'"></td>';
				RowStr += '<td align="center"><select class="group tboxclass" name="cmb_appr_auth[]" id="cmb_appr_auth_'+Index+'">';
				RowStr += '<option value="'+ApprAuth+'">'+ApprAuthText+'</option>';
				RowStr += '</select><input type="hidden" name="txt_mapped_role[]" id="txt_mapped_role_'+Index+'" value="'+MappedRole+'"><input type="hidden" name="txt_mod_trans_id[]" id="txt_mod_trans_id_'+Index+'"></td>';
				RowStr += '<td align="center"><select class="group tboxclass" name="cmb_init_role[]" id="cmb_init_role'+Index+'">';
				RowStr += '<option value="'+InitRole+'">'+InitRoleText+'</option>';
				RowStr += '</select></td>';
				RowStr += '<td align="left" colspan="2"><input type="hidden" name="bill_type[]" id="bill_type'+Index+'" value="'+BillType+'"><input type="hidden" name="budget_type[]" id="budget_type'+Index+'" value="'+BudgetType+'">'+MappedRoleNames+'</td>';
				RowStr += '<td align="center"><i class="fa fa-times-circle sqdel ptr DelRole" data-index="'+Index+'" style="font-size:24px; color:#D10B37"></i></td>';
				RowStr += '</tr>';
			$("#RoleTable").find('tr:last').after(RowStr);
			ClearRow();
			Index++;
		}
	}
	
});
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
$("body").on("change","#cmb_module", function(event){
	let ModuleId = $(this).val();
	let DivisionId = $('#cmb_division').val();
	$("#RoleTable tr:gt(1)").remove();
	$.ajax({ 
		type: 'POST', 
		url: "{{ route('ajax.GetModuleWorkFlow') }}",
		data: {'_token': '{{ csrf_token() }}',  'ModuleId':ModuleId, 'DivisionId':DivisionId}, 
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
							RowStr += '<td align="center"><input type="text" name="txt_start_range[]" id="txt_start_range_'+Index+'" class="tboxclass" value="'+element.start_range+'"></td>';
							RowStr += '<td align="center"><input type="text" name="txt_end_range[]" id="txt_end_range_'+Index+'" class="tboxclass" value="'+element.end_range+'"></td>';
							RowStr += '<td align="center"><select class="group tboxclass" name="cmb_appr_auth[]" id="cmb_appr_auth_'+Index+'">';
							RowStr += '<option value="'+element.appr_auth+'">'+RoleData[element.appr_auth].role_name+'</option>';
							RowStr += '</select><input type="hidden" name="txt_mapped_role[]" id="txt_mapped_role_'+Index+'" value="'+element.target_roles+'"><input type="hidden" name="txt_mod_trans_id[]" id="txt_mod_trans_id_'+Index+'" value="'+element.work_load_id+'"></td>';
							RowStr += '<td align="center"><select class="group tboxclass" name="cmb_init_role[]" id="cmb_init_role'+Index+'">';
							RowStr += '<option value="'+element.initiate_role+'">'+RoleData[element.initiate_role].role_name+'</option>';
							RowStr += '</select></td>';
							RowStr += '<td align="left" colspan="2"><input type="hidden" name="bill_type[]" id="bill_type'+Index+'" value="'+element.bill_type+'"><input type="hidden" name="budget_type[]" id="budget_type'+Index+'" value="'+element.budget_type+'">'+BudgetTypeText+BillTypeText+RoleName+'</td>';
							RowStr += '<td align="center"><i class="fa fa-times-circle sqdel ptr DelRole" data-index="'+Index+'" style="font-size:24px; color:#D10B37"></i></td>';
							RowStr += '</tr>';
						$("#RoleTable").find('tr:last').after(RowStr);
						Index++;
					});
				}
			}
		}
	});
});


$("body").on("change","#txt_emp_no", function(event){
	var EmpNo = $(this).val();
	if((EmpNo != '')&&(EmpNo != null)){
		$.ajax({ 
			type: 'POST', 
			url: "{{ route('ajax.GetEmployeeRoles') }}",
			data: {'_token': '{{ csrf_token() }}',  'EmpNo':EmpNo}, 
			//dataType: 'json',
			success: function (data) {  console.log(data);
				if(data != ''){ 
					let RowStr = '';
					let GrpStr = '<select class="group tboxclass" name="cmb_group[]" id="cmb_group_0"><option value="">NA</option></select>';
					let DivStr = '<select class="group tboxclass" name="cmb_division[]" id="cmb_division_0"><option value="">NA</option></select>';
					let SecStr = '<select class="group tboxclass" name="cmb_section[]" id="cmb_section_0"><option value="">NA</option></select>';
					let OfficeData 	= data['OfficeData'];
					let RoleData 	= data['RoleData'];
					let EmpData 	= data['EmpData'];
					if((OfficeData != null)&&(OfficeData.length > 0)){
						var IsOffice = 1;
					}else{
						var IsOffice = 0;
					}
					let RoleoptionStr 	= '<option value="">--- Select ---</option>';
					if(RoleData != null){
						$.each(RoleData, function(index, element) { 
							RoleoptionStr += '<option value="'+element.roleid+'">'+element.role_name+'</option>';
						});
					}
					if((EmpData != '')&&(EmpData != null)){
						$.each(EmpData, function(index, element) { 
							$("#txt_emp_name").val(element.emp_known_as);
							$("#txt_emp_design").val(element.designationname);
							if(IsOffice == 0){
								if(element.group_code != null){
									GrpStr = '<select class="group tboxclass" name="cmb_group[]" id="cmb_group_0"><option value="'+element.group_code+'">'+element.group+'</option></select>';
								}
								if(element.division_code != null){
									DivStr = '<select class="group tboxclass" name="cmb_division[]" id="cmb_division_0"><option value="'+element.division_code+'">'+element.division+'</option></select>';
								}
								if(element.section_code != null){
									SecStr = '<select class="group tboxclass" name="cmb_section[]" id="cmb_section_0"><option value="'+element.section_code+'">'+element.section+'</option></select>';
								}
							}
						});
						let RoleStr = '<select class="group tboxclass" name="cmb_role[]" id="cmb_role_0">'+RoleoptionStr+'</select>';
						RowStr += '<tr><td>'+GrpStr+'</td><td>'+DivStr+'</td><td>'+SecStr+'</td><td>'+RoleStr+'</td></tr>';
					}
					
					if(IsOffice == 1){
						$.each(OfficeData, function(index, element) { 
							$.each(element, function(index2, element2) {
								if(element2.office_type == "G"){
									GrpStr = '<select class="group tboxclass" name="cmb_group[]" id="cmb_group_0"><option value="'+element2.office_id+'">'+element2.office_name+'</option></select>';
								}
								if(element2.office_type == "D"){
									DivStr = '<select class="group tboxclass" name="cmb_division[]" id="cmb_division_0"><option value="'+element2.office_id+'">'+element2.office_name+'</option></select>';
								}
								if(element2.office_type == "S"){
									SecStr = '<select class="group tboxclass" name="cmb_section[]" id="cmb_section_0"><option value="'+element2.office_id+'">'+element2.office_name+'</option></select>';
								}
							});
							let RoleStr = '<select class="group tboxclass" name="cmb_role[]" id="cmb_role_0">'+RoleoptionStr+'</select>';
							RowStr += '<tr><td>'+GrpStr+'</td><td>'+DivStr+'</td><td>'+SecStr+'</td><td>'+RoleStr+'</td></tr>';
						});
					}
					$("#RoleTable").find('tr:last').after(RowStr);
				}
			}
		});
	}
});
$(document).ready(function() {
    $('#cmb_module').chosen();
	$('#cmb_appr_auth_0').chosen();
	$('#cmb_init_role_0').chosen();
	$('#cmb_role_0').chosen();

});
$("body").on("change", "#cmb_division", function(event) {
    $.ajax({
        type: 'POST',
        url: "{{ route('ajax.GetModulesByDivision') }}", 
        data: {"_token": "{{ csrf_token() }}"},
        success: function(data) {
            if (data != null) {
                var moduleSelect = $("#cmb_module");
                moduleSelect.empty();
                moduleSelect.append($('<option>', {
                    value: '',
                    text: '----- Select -----'
                }));
                $.each(data, function(index, module) {
                    moduleSelect.append($('<option>', {
                        value: module.wf_moduleid,
                        text: module.wf_module_name,
                        'data-mcode': module.wf_module_code
                    }));
                });
				$('#cmb_module').chosen('destroy').chosen();
            }
        }
    });
});


</script>
@endsection
