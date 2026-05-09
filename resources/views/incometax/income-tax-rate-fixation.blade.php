@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
$IndentDate = date('Y-m-d');
 if(isset($data['ShowEmpSessiondata'])){
	$Empdata  = $data['ShowEmpSessiondata'];
	$ICNo     = collect($Empdata)->pluck('emp_no')->first();
	$EmpName  = collect($Empdata)->pluck('emp_first_name')->first();
	$EmpDOB   = collect($Empdata)->pluck('emp_dob')->first();
	$EmpDOJ   = collect($Empdata)->pluck('emp_doj')->first();
	$EmpRET   = collect($Empdata)->pluck('emp_retirement_dt')->first();
	$Desig    = collect($Empdata)->pluck('designation_name')->first();
	$GroupId  = collect($Empdata)->pluck('group')->first();
	$DivId    = collect($Empdata)->pluck('division_short_name')->first();
	$SecId    = collect($Empdata)->pluck('section')->first();
}
if(isset($data['EditIndentData'])){
	$EditIndentData     = $data['EditIndentData'];
	$IndentNo           = collect($EditIndentData)->pluck('indent_no')->first();
	$IndentDescription  = collect($EditIndentData)->pluck('indent_descripton')->first();
	$IndentProjId       = collect($EditIndentData)->pluck('project_id')->first();
	$IndentProjName     = collect($EditIndentData)->pluck('indent_pro_name')->first();
	$CreatedBy          = collect($EditIndentData)->pluck('created_by')->first();
	$IndentDate         = collect($EditIndentData)->pluck('indent_date')->first();
	$IndentId           = collect($EditIndentData)->pluck('indent_id')->first();
	$ICNo               = collect($EditIndentData)->pluck('emp_no')->first();
}
if(isset($data['Empdata']) && isset($data['EditIndentData'])){
	$ShowEmpData = $data['Empdata'];
	$EmpName     = collect($ShowEmpData)->where('emp_no', $ICNo)->pluck('emp_first_name')->first();
	$Desig       = collect($ShowEmpData)->where('emp_no', $ICNo)->pluck('designation_name')->first();
}
if(isset($data['ShowIndentEditDetails'])){
	$EditIndentDetailsData     = $data['ShowIndentEditDetails'];
}
$Action   = 'PROCESS';
if(isset($data['Flag'])){
	$IndentFlagData     = $data['Flag'];
}
if(isset($data['FromPage'])){
	$FromPage  = $data['FromPage'];
}else{
	$FromPage ='';
}
if(isset($data['ShowMaxIndentSuffNo'])){
	$IndentMaxSufNo = $data['ShowMaxIndentSuffNo'];
}else{
	$IndentMaxSufNo = '';
}
if($IndentMaxSufNo == '' || $IndentMaxSufNo ==  NULL){
	$SuffixNo = '0001';
}else{
	$NextValue = $IndentMaxSufNo + 1;
	$SuffixNo  = str_pad($NextValue, 4, '0', STR_PAD_LEFT);
}
$FinYear     = Helper::GetCurrentFinYear(NULL);
$NewIndentNo = "IMS/P&S/" . $FinYear . "/" . $SuffixNo . "";
$BackUrl     = 'indent.indent-view';
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
								<div class="div12 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Income Tax Rate Fixation</div></div></div>
								<div class="row innerdiv">
									<div class="row"> 
										 <!-- Form Steps --> 
										<div class="form-step active"> 
											<div class="row smclearrow"></div>
												<fieldset class="fieldbox">
													<legend class="fieldbox-legend">Income Tax Rate Fixation</legend>
													<div class="fieldbox-div">
														<div class="div2 label cboxlabel">Financial Year</div>
														<div class="div2">
															<select name="cmb_fin_year" id="cmb_fin_year" class="tboxsmclass ChosenInput">
																<option value=""> -- Select -- </option>
																@if(isset($data['AllFinancialYear']))
																@foreach($data['AllFinancialYear'] as $FinancialYear)
																	<option value="{{$FinancialYear}}">{{$FinancialYear}}</option>
																@endforeach
																@endif
															</select>
														</div>
														<div class="row smclearrow"></div>
													    <div class="div2 cboxlabel">Select the Regime</div>											
														<div class="div2 lboxlabel"><input type="radio"name="rad_regime" id="radrad_old_regime_alw" value="OLD">  &emsp; Old Regime</div>
														<div class="div2 lboxlabel"><input type="radio" name="rad_regime"  id="rad_new_regime" value="NEW"> &emsp; New Regime</div>
												</fieldset>                                                           											
                                            </div>
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend"><span id="TypeCode">Old</span> Regime</span></legend>
												<div class="fieldbox-div">
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<table class="formtable" align="center" id="RelationshipTable" width="100%">
														<thead>
															<tr></tr> 
															<tr>
																<th>Min Income</th>
																<th>Max Income</th>
																<th>Tax Rate</th>
																<th>Action</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td><input type="text"  style="width:100%" name="txt_min_income_0" id="txt_min_income_0" class="tboxsmclass itemno decimalnum" data-index = '0' value=""></td>
																<td><input type="text"  style="width:100%" name="txt_max_income_0" id="txt_max_income_0" class="tboxsmclass itemno decimalnum" data-index = '0' value=""></td>
																<td><input type="text"  style="width:100%" name="txt_tax_rate_0" id="txt_tax_rate_0" class="tboxsmclass itemno decimalnum" data-index = '0' value=""></td>
																<td align="center"><i class="fa fa-plus-square sqadd ptr inp disable" id="AddTechRec" style="font-size:24px;"></i></td>
															</tr>
														</tbody>
													</table>
												</div>
												<div class="row smclearrow"></div>
												<div class="row smclearrow"></div>
											</fieldset>
											@php $AddUrl = 'roles.ViewRoleMaster'; @endphp										
											<div class="row">
												<div class="div12" align="center">
													<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" Back " onClick="window.location='{{route($AddUrl)}}'" />
													<input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />									
													<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
													<input type="hidden" name="hid_roleid" id="hid_roleid" value="@if(isset($data['RoleData'])){{ encrypt($data['RoleData']->roleid) }}@endif" />
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
@include('common-workflow.workflow-process')
<script type="text/javascript" language="javascript">
	$(document).on('click','input[name="rad_regime"]',function(){
		let Type = $(this).val();
		if(Type == 'OLD'){
			$('#TypeCode').text('Old');
		}else if(Type == 'NEW'){
			$('#TypeCode').text('New');
		}else{
			$('#TypeCode').text('Old');
			
		}
	});

	var RelIndex = 1;
	var TotIndex = $("#hidden_total_sno").val();
	var RelIndex = (TotIndex != '') ? TotIndex : RelIndex;
	$(document).on('click','#AddTechRec',function(){
		var MinIncome = $('#txt_min_income_0 ').val();
		var MaxIncome = $('#txt_max_income_0').val();
		var TaxRate   = $('#txt_tax_rate_0').val();
		let tablestr = "";
		if(MinIncome == ''){
			BootstrapDialog.alert("Min Income. should not be empty ..!!");
			event.returnValue = false;
		}else if(MaxIncome == ''){
			BootstrapDialog.alert("Max Income. should not be empty ..!!");
			event.returnValue = false;
		}else if(TaxRate == ''){	
			BootstrapDialog.alert("Tax Rate should not be empty ..!!");
			event.returnValue = false;
		}else{
			tablestr += "<tr>";
			tablestr += "<td><input type='text' style='width:100%' name='txt_min_income[]' id='txt_min_income_"+RelIndex+"' class='tboxsmclass decimalnum' data-index='" + RelIndex + "' value='" +MinIncome+ "'></td>";
			tablestr += "<td><input type='text' style='width:100%' name='txt_max_income[]' id='txt_max_income_"+RelIndex+"' class='tboxsmclass decimalnum' data-index='" + RelIndex + "' value='" +MaxIncome+ "'></td>";
			tablestr += "<td><input type='text' style='width:100%' name='txt_tax_rate[]' id='txt_tax_rate_"+RelIndex+"' class='tboxsmclass decimalnum' data-index='" + RelIndex + "' value='" +TaxRate+ "'></td>";
			tablestr += "<td align='center'><i class='fa fa-times-circle sqdel ptr disable DeleteRow' id='DelIndentDetails' style='font-size:24px'></i></i></td>";
			$("#RelationshipTable").append(tablestr);
			$('#txt_min_income_0').val('');
			$('#txt_max_income_0').val('');
			$('#txt_tax_rate_0').val('');
			RelIndex++;
		}
	});
	$(document).on('click','.DeleteRow',function(){
		$(this).closest("tr").remove();
	}); 
	var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var EmployeeTypeCode   	= $("#txt_emptype_code").val();
			var EmployeeTypeName   	= $("#txt_emptype_name").val();
			//var RoleGroup 		= $("#txt_role_group").val();
			var IndentDate 		    = $("#txt_indent_date").val();
			var IndentTittle 		= $("#txt_intent_det").val();
			// var IndentProjName 		= $("#txt_project_name").val();
			var IndentProjName 		= $("#cmb_project_id").val();
		

			if(EmployeeTypeCode == ""){
				BootstrapDialog.alert("Employee Type Code should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(EmployeeTypeName == ""){
				BootstrapDialog.alert("Employee Type Code should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			/*} else if(RoleGroup == ""){
				BootstrapDialog.alert("User Group Name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			} */
			}else if(IndentDate == ''){
				BootstrapDialog.alert("Indent Date should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(IndentTittle == ''){
				BootstrapDialog.alert("Indent Title should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(IndentProjName == ''){
				BootstrapDialog.alert("Project Name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(RelIndex == 1){
				BootstrapDialog.alert("At least add one item details..!");
				event.preventDefault();
				event.returnValue = false;	
				
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure you want to save the Income Tax Rate Fixation?',
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
