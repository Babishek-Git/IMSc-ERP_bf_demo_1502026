@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
 if(isset($data['Empdata'])){
	$Empdata  = $data['Empdata'];
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
	$IndentProjName     = collect($EditIndentData)->pluck('indent_pro_name')->first();
	$CreatedBy          = collect($EditIndentData)->pluck('created_by')->first();
	$IndentDate         = collect($EditIndentData)->pluck('indent_date')->first();
	$IndentId           = collect($EditIndentData)->pluck('indent_id')->first();
	$ICNo               = collect($EditIndentData)->pluck('emp_no')->first();
	$ToEmpNo            = collect($EditIndentData)->pluck('to_emp_no')->first();
}

if(isset($data['ShowIndentEditDetails'])){
	$EditIndentDetailsData     = $data['ShowIndentEditDetails'];
}
$Action   = 'PROCESS';
if(isset($data['Flag'])){
	$IndentFlagData     = $data['Flag'];
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

if(isset($data['FromPage'])){
	$FromPage     = $data['FromPage'];
}
if($FromPage == 'FORWARD'){
	$BackUrl ='indent.indent-forward-to-accounts';
}else{
	$BackUrl ='indent.indent-view';
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
								<div class="div12 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Indent Details</div></div></div>
								<div class="row innerdiv">
									<div class="row"> 
										@if($FromPage == 'FORWARD')
											<div class="row row-fluid line-control-menu-bar formtitlebar" style="border:none">
												<div class="btn-group floatr">
													<button type="button" class="btn btn-default btnprimary" title="Back" name="back" id="back" value=" BACK " onclick="window.location='{{ route($BackUrl) }}'"><i class="fa fa-arrow-circle-o-left pt2"></i> Back</button>
												</div> 
												<div class="btn-group floatr">
													<button type="submit" class="btn btn-default btninfo actionbutton WorkFlowAction"  name="SaveApplication" id="SaveApplication" value=" Forward to Engineer-In-Charge " data-name="btn_forward" data-action="forward this Estimate to Engineer-In-Charge" data-flag="FW"><i class="fa fa-arrow-circle-right pt2"></i> Submit Application </button>
												</div>
												<!-- <div class="btn-group floatr">
													<button type="button" class="btn btn-default btnprimary"  name="btn_edit" id="btn_edit" value=" Edit "onclick="window.location='{{ route('indent.indent-creation', ['page'=>encrypt('EDIT'),'EditId'=>encrypt($IndentId),'modulecode'=>encrypt('INDENT')])}}'" ><i class="fa fa-edit pt2"></i> Edit</button>
												</div> -->
											</div>
										@else
											<div class="row row-fluid line-control-menu-bar formtitlebar" style="border:none">
												<div class="btn-group floatr">
													<button type="button" class="btn btn-default btnprimary" title="Back" name="back" id="back" value=" BACK " onclick="window.location='{{ route($BackUrl) }}'"><i class="fa fa-arrow-circle-o-left pt2"></i> Back</button>
												</div> 
												@if($ToEmpNo == '')
													<div class="btn-group floatr">
														<button type="submit" class="btn btn-default btninfo actionbutton WorkFlowAction"  name="SaveApplication" id="SaveApplication" value=" Forward to Engineer-In-Charge " data-name="btn_forward" data-action="forward this Estimate to Engineer-In-Charge" data-flag="FW"><i class="fa fa-arrow-circle-right pt2"></i> Submit Application </button>
													</div>
													<div class="btn-group floatr">
														<button type="button" class="btn btn-default 	btnprimary"  name="btn_edit" id="btn_edit" value=" Edit "onclick="window.location='{{ route('indent.indent-creation', ['page'=>encrypt('EDIT'),'EditId'=>encrypt($IndentId),'modulecode'=>encrypt('INDENT')])}}'" ><i class="fa fa-edit pt2"></i> Edit</button>
													</div>
												@endif
											</div>
										@endif
										
										 <!-- Form Steps --> 
										<div class="form-step active"> 
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Indent Creator</legend>
												<div class="fieldbox-div">
													<div class="div2 label label">IC No</div>
													<div class="div2"><input type="text" name="txt_emp_icno" id="txt_emp_icno" class="tboxsmclass" value="@if(isset($ICNo)){{$ICNo}}@endif"readonly ></div>
													<div class="div2 label pd-l-20">Name</div>
													<div class="div2"><input type="text" name="txt_payslip_name" id="txt_payslip_name" class="tboxsmclass" value="@if(isset($EmpName)){{$EmpName}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Designation</div>
													<div class="div2"><input type="text" name="txt_designation" id="txt_designation" class="tboxsmclass" value="@if(isset($Desig)){{$Desig}}@endif" readonly></div>
													<!-- <div class="div2 label label">Group</div> -->
													<!-- <div class="div2"><input type="text" name="txt_group" id="txt_group_id" class="tboxsmclass" value="@if(isset($GroupId)){{$GroupId}}@endif" readonly></div> -->
													<!-- <div class="div2 label pd-l-20">Divison</div> -->
													<!-- <div class="div2"><input type="text" name="txt_div" id="txt_div_id" class="tboxsmclass" value="@if(isset($DivId)){{$DivId}}@endif" readonly></div> -->
													<!-- <div class="div2 label pd-l-20">Section</div> -->
													<!-- /	<div class="div2"><input type="text" name="txt_sec" id="txt_sec_id" class="tboxsmclass" value="@if(isset($SecId)){{$SecId}}@endif" readonly></div> -->
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>
											<div class="row smclearrow"></div>
												<fieldset class="fieldbox" disabled >
													<legend class="fieldbox-legend">Indent Details</legend>
													<div class="fieldbox-div">
														<div class="div2 label label">Indent No.</div>
														<div class="div2"><input type="text" name="txt_intent_no" id="txt_indent_no" class="tboxsmclass" value="@if(isset($IndentNo)){{$IndentNo}}@else {{$NewIndentNo}}@endif" readonly></div>  
														<div class="div2 label pd-l-20">Indent Date </div>
														<div class="div2"><input type="text" name="txt_intent_date" id="txt_indent_date" class="tboxsmclass datepicker" value="@if(isset($IndentDate)){{Helper::DisplayDateFormat($IndentDate)}}@endif" ></div>
														<div class="row smclearrow"></div>
														<div class="div2 label label">Indent Title</div>
														<div class="div2"><input type="text" style="width:625px" name="txt_intent_det" id="txt_intent_det" class="tboxsmclass" value="@if(isset($IndentDescription)){{$IndentDescription}}@endif" ></div>
														<div class="row smclearrow"></div>
														<div class="div2 label label">Project Name</div>
														<div class="div2"><input type="text" style="width:625px" name="txt_project_name" id="txt_project_name" class="tboxsmclass" value="@if(isset($IndentProjName)){{$IndentProjName}}@endif" ></div>
														<div class="row smclearrow"></div>
														
														<div class="row smclearrow"></div>
													</div>
												</fieldset>                                                           											
                                            </div>
											<fieldset class="fieldbox"disabled>
												<legend class="fieldbox-legend">Item Details of Required Items </legend>
												<div class="fieldbox-div">
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<table class="formtable" align="center" id="RelationshipTable" width="100%">
														<thead> 
															<tr>
																<th>S.No.</th>
																<th>Type Of Material</th>
																<th>A complete description of Goods/Services intended to be procured</th>
																<th>Qty</th>
																<th>Unit</th>
																<th>Unit Price<br>Rs.</th>
																<th>GST %</th>
																<th>Tax Type</th>
																<th>Total cost (Approx.)</th>
															</tr>
														</thead>
														<tbody>
															@if(isset($data['ShowIndentEditDetails']))
																@php 
																	$EditIndentDetailsData = $data['ShowIndentEditDetails']; 
																	$IndentId              = collect($EditIndentDetailsData)->pluck('indent_id')->first();
																	$Sno = 1;
																@endphp
																@foreach($EditIndentDetailsData as $EditValue)
																	<tr data-index='{{$Sno}}'>
																		<td><input type="text"  style="width:100%" name="txt_sno[]" id="txt_sno_0" class="tboxsmclass decimalnum"  value="{{$EditValue->item_no}}"></td>
																		<td>
																			<select name="txt_material_type_id[]" id="cmb_material_type" class="tboxsmclass">
																				<option value=""> ----Select ---</option>
																				@if(isset($data['MaterialTypeData']))
																						@foreach($data['MaterialTypeData'] as $MaterialTypeData)
																							<option value="{{$MaterialTypeData->material_type_id}}"{{($MaterialTypeData->material_type_id) == $EditValue->material_type_id ? 'selected="selected"' : ''}}>{{$MaterialTypeData->material_type_name}}</option>
																						@endforeach
																					@endif
																			</select>
																		</td>
																		<td><textarea name="txt_item_goods_service_name[]" id="txt_item_goods_service_name_0" class="tboxsmclass" value="{{$EditValue->item_description}}">{{$EditValue->item_description}}</textarea></td>
																		<td><input type="text" style="width:100%" name="txt_item_quantity_req_name[]" id="txt_item_quantity_req_name_0 decimalnum" class="tboxsmclass" value="{{$EditValue->quantity}}"></td>
																		<td>
																			<select  style="width:100%" name="txt_unit[]" id="cmb_unit" class="tboxsmclass data-index = '0' ChosenInput">
																				<option value=""> ----Select ---</option>
																				@if(isset($data['ShowMaterialUnit']))
																						@foreach($data['ShowMaterialUnit'] as $MaterialUnitData)
																							<option value="{{$MaterialUnitData->uom_id}}"{{($MaterialUnitData->uom_id) == $EditValue->unit_id ? 'selected="selected"' : ''}}>{{$MaterialUnitData->uom_name}}</option>
																						@endforeach
																					@endif
																			</select>
																		</td>
																		<td><input type="text" style="width:100%" name="txt_item_estimate_no[]" id="txt_item_estimate_no_0" class="tboxsmclass decimalnum" value="{{$EditValue->estimated_unit_price}}"></td>
																		<td><input type="text" style="width:100%" name="txt_item_gst_rate[]" id="txt_item_gst_rate_0" class="tboxsmclass decimalnum" value="{{$EditValue->gst_rate}}"></td>
																		<td>
																			<select name="cmb_tax_type[]" id="cmb_tax_type_0" data-index = '0' class="tboxsmclass taxtype">
																				<option value=""> ----Select ---</option>
																				<option value="INC"{{ $EditValue->tax_type == 'INC' ? 'selected' : '' }}>Inclusive</option>
																				<option value="EXCL"{{ $EditValue->tax_type == 'EXCL' ? 'selected' : '' }}>Exclusive</option>
																			</select>
																		</td>
																		<td><input type="text" style="width:100%" name="txt_item_total_cost[]" id="txt_item_total_cost_0" class="tboxsmclass decimalnum" value="{{$EditValue->total_cost}}"></td>
																	@php $Sno  ++; @endphp
																@endforeach
																
															@endif
															
														<!-- 	@if(isset($data['EditIndentDetailData']))
																@foreach($data['EditIndentDetailData'] as $EditIndentDetailData)
																	<tr>
																		<td align="center">{{ $loop->iteration }} </td>
																		<td align="left">{{ $EditIndentDetailData->indent_no}}</td>
																		<td align="left">{{ $EditIndentDetailData->material_type_id}}</td>
																		<td align="left">{{ $EditIndentDetailData->indent_descripton }}</td>
																		<td align="left">{{ $EditIndentDetailData->quantity }}</td>
																		<td align="left">{{ $EditIndentDetailData->quantity }}</td>
																		<td align="left">{{ $EditIndentDetailData->estimated_unit_price }}</td>
																		<td align="left">{{ $EditIndentDetailData->gst_rate }}</td>
																		<td align="left">{{ $EditIndentDetailData->gst_price }}</td>
																		<td align="left">{{ $EditIndentDetailData->total_cost }}</td>
																	</tr>
																@endforeach
															@endif -->
														</tbody>
													</table>
												</div>
												<div class="row smclearrow"></div>
												<div class="row smclearrow"></div>
											</fieldset>
											
											<!-- <div class="row smclearrow"></div>
												<fieldset class="fieldbox">
													<legend class="fieldbox-legend">Supplier & Payment Term</legend>
													<div class="fieldbox-div">
														<div class="div2 label label">Suggested Supplier</div>
														<div class="div2"><input type="text" name="txt_suggest_supplier" id="txt_suggest_supplier" class="tboxsmclass" value=""  ></div>
														<div class="div2 label pd-l-20">Payment Term</div>
														<div class="div2"><input type="text" name="txt_payment_term" id="txt_payment_term" class="tboxsmclass" value=""  ></div>  
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
													</div>
												</fieldset>                                                           											
                                            </div> -->
									<!-- </div > -->
								</div>
								<!-- ================ -->
								<!-- ================ -->
								</div>
								
								<!-- ================== -->
							</div>
							<div class="row">
								<div class="div12" align="center">
								    <input type="hidden" name="hid_indent_id" id="hid_indent_id" value="@if(isset($IndentId)){{$IndentId}}@endif" />
									<input type="hidden" name="txt_application_id" id="txt_application_id" value="@if(isset($IndentId)){{ encrypt($IndentId) }}@endif">
                            		<input type="hidden" name="txt_action" id="txt_action" value="@if(isset($Action)){{ encrypt($Action) }}@endif">
									<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
									<input type="hidden" name="wf_module_code" id="wf_module_code" value="{{ encrypt('INDENT') }}" />
									<input type="hidden" name="txt_wf_mode" id="txt_wf_mode" />
									<input type="hidden" name="txt_actual_emp" id="txt_actual_emp" />
									<input type="hidden" name="txt_wf_remark" id="txt_wf_remark" />
									<input type="hidden" name="txt_wf_emp_no" id="txt_wf_emp_no" />
									<input type="hidden" name="txt_wf_role" id="txt_wf_role" />
									<input type="hidden" name="txt_wf_action" id="txt_wf_action" />
									<input type="hidden" name="txt_role_position" id="txt_role_position" />
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
	$('[name="cmb_tax_type"]').chosen();
	$('[name="cmb_material_type"]').chosen();
	$('[name="cmb_unit_0"]').chosen();
	//$(".ChosenInput").chosen();
	//$("#txt_division").chosen();
	//$("#txt_role_group").chosen();
	$('#dataTable').DataTable({
		responsive: true,
		paging: true, 
	});
	$(".decimalnum").on("input", function() {
		this.value = this.value.replace(/[^0-9.]/g, ''); //
	});
	$('body').on('change', '.taxtype, .itemqty, .gstperc, .unitprice', function() {
		var Index         = $(this).data('index');
		var TaxValue      = $('#cmb_tax_type_'+ Index).val();
		var ItemQty       = Number($('#txt_item_quantity_req_name_'+ Index).val()) || 0;
		var ItemUnitPrice = Number($('#txt_item_estimate_no_'+ Index).val()) || 0;
		var GstPerc       = Number($('#txt_item_gst_rate_'+ Index).val()) || 0;
		var BaseAmount    = ItemQty * ItemUnitPrice;
		var TotalAmt      = 0;
		if (TaxValue == 'INC') {
			var TaxAmount = (BaseAmount * GstPerc) / 100;
			TotalAmt      = BaseAmount + TaxAmount;
			$("#txt_item_total_cost_" + Index).prop('readonly', true);
		}else if(TaxValue == 'EXCL') {
			var TaxAmount = (BaseAmount * GstPerc) / 100;
			TotalAmt      = BaseAmount + TaxAmount;
			$("#txt_item_total_cost_" + Index).prop('readonly', false);
		}
		$("#txt_item_total_cost_" + Index).val(TotalAmt);
	});
	var RelIndex = 1;
	$(document).on('click','#AddTechRec',function(){
		var SNo              = $('.itemno').val();
		var MaterialType     = $('#cmb_material_type option:selected').text();
		var MaterialId       = $('#cmb_material_type option:selected').val();
		var GoodsserviceName = $('#txt_item_goods_service_name_0').val();
		var QuanityRequired  = $('#txt_item_quantity_req_name_0').val();
		var EstimatedPrice   = $('#txt_item_estimate_no_0').val();
		var GSTRate          = $('#txt_item_gst_rate_0').val();
		var TotalCost        = $('#txt_item_total_cost_0').val();
		var Unit             = $('#txt_unit_0').val();
		var TaxType         = $('#cmb_tax_type_0 option:selected').text();
		var TaxValue        = $('#cmb_tax_type_0 option:selected').val();
		var UnitName         = $('#cmb_unit option:selected').text();
		var UnitId           = $('#cmb_unit option:selected').val();
		let tablestr = "";
		if(SNo == ''){
			BootstrapDialog.alert("S.No. should not be empty ..!!");
			event.returnValue = false;
		}else if(MaterialId == ''){
			BootstrapDialog.alert("Select the Type Of Material Type ..!!");
			event.returnValue = false;
		}else if(GoodsserviceName == ''){	
			BootstrapDialog.alert("A complete description of Goods/Services intended to be procured should not be in empty ..!!");
			event.returnValue = false;
		}else if(QuanityRequired == ''){	
			BootstrapDialog.alert("Qty Should not be in empty..!!");
			event.returnValue = false;
		}else if(UnitId == ''){	
			BootstrapDialog.alert("Select the Unit..!!");
			event.returnValue = false;
		}else if(EstimatedPrice ==''){	
			BootstrapDialog.alert("Unit Price Should not be in empty..!!");
			event.returnValue = false;
		}else if(GSTRate == ''){	
			BootstrapDialog.alert("GST %  Should not be in empty..!!");
			event.returnValue = false;
		}else if(TaxValue == ''){
			BootstrapDialog.alert("Select the Tax Type...!!");
			event.returnValue = false;
		}else if(TotalCost == ''){	
			BootstrapDialog.alert("Total cost with (Approx.) Should not be in empty ..!!");
			event.returnValue = false;			
		}else{
			$.ajax({
				type: 'POST',
				url: "{{ route('indent.GetIndentAjaxData') }}",
				data: { '_token': '{{ csrf_token() }}' },
				success: function(data) {
					if (data != null) {
						var MaterialType = data.MaterialType;
        				var UnitData     = data.MaterialUnit;
						tablestr += "<tr>";
						tablestr += "<td><input type='text' style='width:100%' name='txt_sno[]' id='txt_sno_"+RelIndex+"' class='tboxsmclass decimalnum' data-index='" + RelIndex + "' value='" +SNo+ "'></td>";
						tablestr += "<td><input type='hidden' name='txt_material_type_id[]' id='txt_material_type_id_"+RelIndex+"' class='tboxsmclass' value='" +MaterialId+ "' data-index='" + RelIndex + "'>";
						tablestr +=  "<select name='txt_material_type[]' id='txt_material_type_"+RelIndex+"' class='tboxsmclass' data-index='" + RelIndex + "'>";
						tablestr += "<option value=''>----Select ---</option>";
							MaterialType.forEach(function(item) {
								var isSelected = (item.material_type_id == MaterialId) ? 'selected="selected"' : '';
								tablestr += '<option value="' + item.material_type_id + '" ' + isSelected + '>';
								tablestr += item.material_type_name;
								tablestr += '</option>';
							});
						tablestr += "</select>";
						tablestr += "<td><textarea style='width:100%'name='txt_item_goods_service_name[]'data-index='" + RelIndex + "' id='txt_item_goods_service_name_"+RelIndex+"'class='tboxsmclass' value='" +GoodsserviceName+ "'>" + GoodsserviceName + "</textarea></td>";
						tablestr += "<td><input type='text'style='width:100%' name='txt_item_quantity_req_name[]' data-index='" + RelIndex + "' id='txt_item_quantity_req_name_"+RelIndex+"' class='tboxsmclass decimalnum itemqty' value='"+QuanityRequired+"'></td>";
						tablestr += "<td>";
							tablestr +=  "<select name='txt_unit[]' id='txt_unit_"+RelIndex+"'data-index='" + RelIndex + "' class='tboxsmclass'>";
							tablestr += "<option value=''>----Select ---</option>";
							UnitData.forEach(function(item) {
								var isSelected = (item.uom_id == UnitId) ? 'selected="selected"' : '';
								tablestr += '<option value="' + item.uom_id + '" ' + isSelected + '>';
								tablestr += item.uom_name;
								tablestr += '</option>';
							});
							tablestr += "</select>";
						tablestr += "</td>";
						tablestr += "<td><input type='text'style='width:100%' name='txt_item_estimate_no[]'data-index='" + RelIndex + "' id='txt_item_estimate_no_"+RelIndex+"' class='tboxsmclass decimalnum unitprice' value='"+EstimatedPrice+"'></td>";
						tablestr += "<td><input type='text'style='width:100%' name='txt_item_gst_rate[]' data-index='" + RelIndex + "'id='txt_item_gst_rate_"+RelIndex+"' class='tboxsmclass decimalnum gstperc' value='"+GSTRate+"'></td>";
						tablestr += "<td>";
							tablestr +=  "<select name='cmb_tax_type[]' id='cmb_tax_type_"+RelIndex+"' data-index='" + RelIndex + "' class='tboxsmclass taxtype'>";
								tablestr += "<option value=''>----Select ---</option>";
								tablestr += '<option value="INC" ' + (TaxValue == "INC" ? "selected" : "") + '>Inclusive</option>';
							    tablestr += '<option value="EXCL" ' + (TaxValue == "EXCL" ? "selected" : "") + '>Exclusive</option>';
							tablestr += "</select>";
						tablestr += "</td>";
						var isReadOnly = (TaxValue == 'INC') ? 'readonly' : '';
						tablestr += "<td><input type='text'style='width:100%' name='txt_item_total_cost[]'data-index='" + RelIndex + "' id='txt_item_total_cost_"+RelIndex+"' class='tboxsmclass decimalnum' value='"+TotalCost+"'"+isReadOnly+"></td>";
						tablestr += "<td align='center'><i class='fa fa-times-circle sqdel ptr disable DeleteRow' id='DelIndentDetails' style='font-size:24px'></i></i></td>";
						tablestr += "</tr>";
						$("#RelationshipTable").append(tablestr);
						//$('#txt_sno_0').val('');
						$('.itemno').val('');
						$('#cmb_material_type').chosen('destroy');
						$('#cmb_material_type').val('');
						$('#cmb_material_type').chosen();
						$('#txt_item_goods_service_name_0').val('');
						$('#txt_item_quantity_req_name_0').val('');
						$('#txt_item_estimate_no_0').val('');
						$('#txt_item_gst_rate_0').val('');
						$('#txt_item_total_cost_0').val('');
						$('#txt_unit_0').val('');
						$('#cmb_tax_type_0').val('');
						$('#cmb_unit').val('');
						RelIndex++;
					}
				}
			});
			
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
			var IndentProjName 		= $("#txt_project_name").val();
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
					message: 'Are you sure want to Indent Creation ?',
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
