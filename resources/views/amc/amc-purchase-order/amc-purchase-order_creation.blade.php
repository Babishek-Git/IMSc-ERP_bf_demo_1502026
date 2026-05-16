@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
$ShowAMCPoMasterData        = $data['AMCPoMasterEditData'] ?? [];
$ShowAMCPoDetailsData       = $data['AMCPoDetailEditData'] ?? [];
if(isset($ShowAMCPoMasterData)){
	foreach($ShowAMCPoMasterData as $AMCPOMastData){
		$AMCPOId          = $AMCPOMastData->amc_po_order_id;
		$AMCDiscipId      = $AMCPOMastData->discipline_id;
		$AMCTypeId        = $AMCPOMastData->amc_type_id;
		$AMCBasesonId     = $AMCPOMastData->amc_baseson_id;
		$AMCFileName      = $AMCPOMastData->amc_file_name;
		$AMCEqupdesc      = $AMCPOMastData->equip_desc;
		$AMCPOContId      = $AMCPOMastData->contid;
		$AMCCost          = $AMCPOMastData->amc_cost;
		$AMCGstPerc       = $AMCPOMastData->gst_perc;
		$AMCPoTotalAmt    = $AMCPOMastData->amc_po_total_amt;
		$AMCTaxType       = $AMCPOMastData->cost_tax;
		$WrkDuration      = $AMCPOMastData->work_duration;
		$WrkDurationMode  = $AMCPOMastData->work_duration_mode;
		$WrkStartDate     = $AMCPOMastData->work_starting_date;
		$WrkEndDate       = $AMCPOMastData->work_completion_date;
		$AMCLocIds        = json_decode($AMCPOMastData->location_id, true);
		$AMCPOBillPayMode = $AMCPOMastData->bill_pay_mode;
		$SelectedLocIds   = array_values(array_filter($AMCLocIds));
	}
}
$BackUrl     = 'amc-purchase-order.amc-purchase-order-submission';
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
								<div class="div12 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">AMC Purchase Order Form </div></div></div>
									<div class="row innerdiv">
										<div class="row">
											<div class="row row-fluid line-control-menu-bar formtitlebar" style="border:none">
												@if(isset($data['AMCPoMasterEditData']) )
													<div class="btn-group floatr">
														<input type="button" class="backbutton" name="back" id="back" value=" Back " onClick="window.location='{{route($BackUrl)}}'" />
													</div>
													<div class="btn-group floatr">
														<button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Update">Update</button>	
								    					<input type="hidden" name="hid_amc_po_id" id="hid_amc_po_id" value="@if(isset($AMCPOId)){{$AMCPOId}}@endif" />
													</div>
												@else
													<div class="btn-group floatr">
														<button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Save">Save</button>
													</div>
												@endif
                                        	</div>   
											<!-- Form Steps --> 
											<div class="form-step active"> 
													<fieldset class="fieldbox">
														<legend class="fieldbox-legend">AMC Purchase Order  Details</legend>
														<div class="fieldbox-div">
															<div class="div3"><div class="lboxlabel ">Discipline<span class="reqindi">*</span></div>
																<select name="cmb_discipline" id="cmb_discipline" class="tboxsmclass ChosenInput">
																	<option value="">-------------- Select -------------</option>
																	@if(isset($data['MaterialCertifySecData']))
																		@foreach($data['MaterialCertifySecData'] as $MaterialCertifySec)
																			<option value="{{$MaterialCertifySec->office_id}}"{{ ($AMCDiscipId ?? '') == $MaterialCertifySec->office_id ? 'selected' : '' }}>
																				{{$MaterialCertifySec->office_name }}
																			</option>
																		@endforeach
																	@endif
																</select>
															</div>
															<div class="div3"><div class="lboxlabel ">AMC Type<span class="reqindi">*</span></div>
																<select name="cmb_amc_type" id="cmb_amc_type" class="tboxsmclass ChosenInput">
																	<option value="">--Select --</option>
																	@if(isset($data['AMCTypeData']))
																		@foreach($data['AMCTypeData'] as $AMCType)
																			<option value="{{$AMCType->amctypeid}}"{{ ($AMCTypeId ?? '') == $AMCType->amctypeid ? 'selected' : '' }}>
																				{{$AMCType->amc_type_name }}
																			</option>
																		@endforeach
																	@endif
																</select>
															</div>
															<div class="div3"><div class="lboxlabel ">AMC Bases On<span class="reqindi">*</span></div>
																<select name="cmb_bases_on" id="cmb_bases_on" class="tboxsmclass ChosenInput">
																	<option value="">-------------- Select -------------</option>
																	@if(isset($data['AMCprovidedBaseOnData']))
																		@foreach($data['AMCprovidedBaseOnData'] as $AMCProvBasData)
																			<option value="{{$AMCProvBasData->amc_prov_base_id}}"{{ ($AMCBasesonId ?? '') == $AMCProvBasData->amc_prov_base_id ? 'selected' : '' }}>
																				{{$AMCProvBasData->amc_prov_base_name }}
																			</option>
																		@endforeach
																	@endif
																</select>
															</div>
															<div class="div3"><div class="lboxlabel ">AMC File Name<span class="reqindi">*</span></div><textarea name="txt_amc_file_name" id="txt_amc_file_name" width:100% class="tboxsmclass" rows="1" value="{{$AMCFileName ?? ''}}">{{$AMCFileName ?? ''}}</textarea></div>
															<div class="row smclearrow"></div>
															<div class="div3"><div class="lboxlabel ">Description of Equipment<span class="reqindi">*</span></div><textarea name="txt_desc_equip" id="txt_desc_equip" class="tboxsmclass" rows="1" width:100% value="{{$AMCEqupdesc ?? ''}}">{{$AMCEqupdesc ?? ''}}</textarea></div>
															<div class="div2"><div class="lboxlabel">AMC Cost &#8377;<span class="reqindi">*</span></div><input type="text" name="txt_amsc_cost" id="txt_amsc_cost" class="tboxsmclass" value="{{$AMCCost ?? ''}}"></div>
															<div class="div1"><div class="lboxlabel ">GST %<span class="reqindi">*</span></div><input type="text" name="txt_amsc_gst" id="txt_amsc_gst" class="tboxsmclass " value="{{$AMCGstPerc ?? ''}} "></div>
															<div class="div3"><div class="lboxlabel ">Tax on Cost<span class="reqindi">*</span></div>
																<div class="div5 no-margin">
																	<div class="inputGroup paddlr2">
																		<input id="rad_inc" name="rad_tax_inc" type="radio" value="INC" {{isset($AMCTaxType) && $AMCTaxType == 'INC' ? 'checked' : ''}}/>
																		<label for="rad_inc" style="padding:3px 0px; width:100%"> &nbsp;Including</label>
																	</div>
																</div>
																<div class="div5 no-margin">
																	<div class="inputGroup paddlr2">
																		<input id="rad_exc" name="rad_tax_inc" type="radio" value="EXC" {{isset($AMCTaxType) && $AMCTaxType == 'EXC' ? 'checked' : ''}}/>
																		<label for="rad_exc" style="padding:3px 0px; width:100%"> &nbsp;Excluding</label>
																	</div>
																</div>
															</div>
															<div class="div3"><div class="lboxlabel">Total AMC Po Cost &#8377;<span class="reqindi">*</span></div><input type="text" name="hidden_total_po_amt" id="hidden_total_po_amt" class="tboxsmclass"readonly value="{{$AMCPoTotalAmt ?? ''}}"></div>
															<input type='hidden' id='hidden_total_po_amt'  value =''>
															<div class="row smclearrow"></div>
															<div class="div3"><div class="lboxlabel ">Vendor Name<span class="reqindi">*</span></div>
																<div style="display:flex; align-items:center; gap:8px;">
																	<select name="cmb_vendor_name" id="cmb_vendor_name" class="tboxsmclass ChosenInput">
																		<option value="">-------------- Select -------------</option>
																		@if(isset($data['Contractordata']))
																			@foreach($data['Contractordata'] as $Contractordata)
																				<option value="{{$Contractordata->contid}}"{{ ($AMCPOContId ?? '') == $Contractordata->contid ? 'selected' : '' }}>
																					{{$Contractordata->name_contractor }}
																				</option>
																			@endforeach
																		@endif
																	</select>
																	<i class="fa fa-plus-square sqadd  " id="AddNewVend"  style="font-size:24px; cursor:pointer; color:#10478A;"></i>
																</div>
															</div>
															<div class="div3">
																<div class="lboxlabel">Work Duration<span class="reqindi">*</span></div>
																<div style="display:flex; gap:5px;">
																	<input type="text" name="txt_work_duration" id="txt_work_duration" class="tboxsmclass" value="{{$WrkDuration ?? ''}}">
																	<select name="cmb_work_duration" id="cmb_work_duration" class="tboxsmclass ChosenInput">
																		<option value="">-- Select --</option>
																		<option value="MONTH" {{isset($WrkDurationMode) && $WrkDurationMode == 'MONTH' ? 'selected' : ''}}>MONTH</option>
																		<option value="YEAR" {{isset($WrkDurationMode) && $WrkDurationMode == 'YEAR' ? 'selected' : ''}}>YEAR</option>
																		<option value="DAYS" {{isset($WrkDurationMode) && $WrkDurationMode == 'DAYS' ? 'selected' : ''}}>DAYS</option>
																	</select>
																</div>
															</div>
															<div class="div3"><div class="lboxlabel ">Work Starting Date<span class="reqindi">*</span></div><input type="text" name="txt_start_date" id="txt_start_date" class="tboxsmclass datepicker" value="{{ Helper::DisplayDateFormat($WrkStartDate ?? null) }}"></div>
															<div class="div3"><div class="lboxlabel ">Work Completion Date<span class="reqindi">*</span></div><input type="text" name="txt_end_date" id="txt_end_date" class="tboxsmclass " value="{{Helper::DisplayDateFormat($WrkEndDate ?? null) }}" readonly></div>
															<div class="row smclearrow"></div>
															<div class="div3"><div class="lboxlabel ">Location<span class="reqindi">*</span></div>
																<select name="cmb_loc_name[]" id="cmb_loc_name" class="tboxsmclass ChosenInput" multiple width:100%>
																	<option value="0">-- Nil --</option>
																	@if(isset($data['ShowLoacationMasterData']))
																		@foreach($data['ShowLoacationMasterData'] as $locationdata)
																			<option value="{{$locationdata->location_id}}" {{ in_array($locationdata->location_id, $SelectedLocIds ?? []) ? 'selected' : '' }}>
																				{{$locationdata->location_name }}
																			</option>
																		@endforeach
																	@endif
																</select>
															</div>
															<div class="div2"><div class="lboxlabel ">Payment Mode<span class="reqindi">*</span></div>
																<select name="cmb_bill_pay_mode" id="cmb_bill_pay_mode" class="tboxsmclass ChosenInput">
																	<option value="">---------- Select ----------</option>
																	@if(isset($data['BillpaymodeData']))
																		@foreach($data['BillpaymodeData'] as $BillpaymodeData)
																			<option value="{{$BillpaymodeData->pay_mode_id}}" {{ ($AMCPOBillPayMode ?? '') == $BillpaymodeData->pay_mode_id ? 'selected' : '' }}>{{$BillpaymodeData->pay_mode_name}}  </option>
																		@endforeach
																	@endif
																</select>
															</div>
															<div class="row smclearrow"></div>
														</div>
													</fieldset>                                                        											
												</div>
												<fieldset class="fieldbox" >
													<legend class="fieldbox-legend">Item Details of Required Items </legend>
													<div class="fieldbox-div">
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
														<table class="formtable" align="center" id="RelationshipTable" width="100%">
															<thead> 
																<tr>
																	<th style="width: 20px;" >S.No.</th>
																	<th>A complete description of Goods/Services intended to be procured</th>
																	<th  style="width: 80px;">Qty</th>
																	<th style="width: 100px;">Unit</th>
																	<th style="width: 100px;">Unit <br>Price <br> Rs.</th>
																	<th style="width: 80px;">Amount <br> Rs.</th>
																	<!-- <th style="width: 100px;">Tax Type</th> -->
																	<th style="width: 120px;">Total cost <br> with tax (Approx.) <br> Rs.</th>
																	<th style="width: 20px;">Action</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td><input type="text"  style="width:100%" name="txt_sno_0" id="txt_sno_0" class="tboxsmclass itemno decimalnum" data-index = '0' value="1"></td>
																	<td><textarea name="txt_item_goods_service_name_0" id="txt_item_goods_service_name_0" data-index = '0' class="tboxsmclass"></textarea></td>
																	<td><input type="text" style="width:100%" name="txt_item_quantity_req_name_0"data-index = '0'  id="txt_item_quantity_req_name_0" class="tboxsmclass decimalnum itemqty" value=""></td>
																	<td>
																		<select  style="width:100%" name="txt_unit_0" id="txt_unit_0" class="tboxsmclass ChosenInput" data-index = "0" >
																			<option value="">--Select--</option>
																			@if(isset($data['ShowMaterialUnit']))
																				@foreach($data['ShowMaterialUnit'] as $MaterialUnitData)
																					<option value="{{$MaterialUnitData->uom_id}}">{{$MaterialUnitData->uom_name}}</option>
																				@endforeach
																			@endif
																		</select>
																	</td>
																	<td><input type="text" style="width:100%" name="txt_item_estimate_no_0" id="txt_item_estimate_no_0"  data-index = '0' class="tboxsmclass decimalnum unitprice" value=""></td>
																	<td><input type="text" style="width:100%" name="txt_item_amout_0" id="txt_item_amout_0" data-index = '0' class="tboxsmclass decimalnum itemamout" readonly value=""></td>
																	<!-- <td>
																		<select name="cmb_tax_type_0" id="cmb_tax_type_0" data-index = '0' class="tboxsmclass taxtype">
																			<option value=""> ----Select ---</option>
																			<option value="INC">Inclusive</option>
																			<option value="EXCL">Exclusive</option>
																				
																		</select>
																	</td> -->
																	<td ><input type="text"   style="width:100%;text-align: Right;" data-index = '0' name="txt_item_total_cost_0" id="txt_item_total_cost_0" class="tboxsmclass decimalnum" value=""></td>
																	<td align="center"><i class="fa fa-plus-square sqadd ptr inp disable" id="AddTechRec" style="font-size:24px;"></i></td>
																</tr>
																@php $Sno = 0; $GrandTotal = 0; @endphp
																@if(isset($ShowAMCPoDetailsData))
																	@foreach($ShowAMCPoDetailsData as $AMCPoDetailsData)
																		<tr>
																			<td><input type="text"  style="width:100%" name="txt_sno" id="txt_sno_{{$Sno}}" class="tboxsmclass itemno decimalnum" data-index = '{{$Sno}}' value="{{$AMCPoDetailsData->item_no ?? ''}}"></td>
																			<td><textarea name="txt_item_goods_service_name_{{$Sno}}" id="txt_item_goods_service_name_{{$Sno}}" data-index = '{{$Sno}}' value = "{{$AMCPoDetailsData->item_description ?? ''}}"class="tboxsmclass">{{$AMCPoDetailsData->item_description ?? ''}}</textarea></td>
																			<td><input type="text" style="width:100%" name="txt_item_quantity_req_name_{{$Sno}}"data-index = '{{$Sno}}'  id="txt_item_quantity_req_name_{{$Sno}}" class="tboxsmclass decimalnum itemqty" value="{{$AMCPoDetailsData->quantity ?? ''}}"></td>
																			<td>
																				<select  style="width:100%" name="cmb_unit" id="cmb_unit" class="tboxsmclass data-index = '{{$Sno}}' ChosenInput">
																					<option value=""> ----Select ---</option>
																					@if(isset($data['ShowMaterialUnit']))
																							@foreach($data['ShowMaterialUnit'] as $MaterialUnitData)
																								<option value="{{$MaterialUnitData->uom_id}}" {{($MaterialUnitData->uom_id) == $AMCPoDetailsData->unit_id ? 'selected="selected"' : ''}}>{{$MaterialUnitData->uom_name}}</option>
																							@endforeach
																						@endif
																				</select>
																			</td>
																			<td><input type="text" style="width:100%" name="txt_item_estimate_no_0" id="txt_item_estimate_no_0"  data-index = '{{$Sno}}' class="tboxsmclass decimalnum unitprice" value="{{$AMCPoDetailsData->estimated_unit_price ?? ''}}"></td>
																			<td><input type="text" style="width:100%" name="txt_item_amout_0" id="txt_item_amout_0" data-index = '{{$Sno}}' class="tboxsmclass decimalnum itemamout" readonly value="{{$AMCPoDetailsData->total_cost ?? ''}}"></td>
																			<!-- <td>
																				<select name="cmb_tax_type_0" id="cmb_tax_type_{{$Sno}}" data-index = '{{$Sno}}' class="tboxsmclass taxtype">
																					<option value=""> ----Select ---</option>
																					<option value="INC" {{ $AMCPoDetailsData->tax_type == 'INC' ? 'selected' : '' }}>Inclusive</option>
																					<option value="EXCL"{{ $AMCPoDetailsData->tax_type == 'EXCL' ? 'selected' : '' }}>Exclusive</option>
																						
																				</select>
																			</td> -->
																			<td ><input type="text"   style="width:100%;text-align: Right;" data-index = '{{$Sno}}' name="txt_item_total_cost_{{$Sno}}" id="txt_item_total_cost_0" class="tboxsmclass decimalnum" value="{{$AMCPoDetailsData->total_cost ?? ''}}"></td>
																			<td align="center"><i class='fa fa-times-circle sqdel ptr disable DeleteRow'  id ='btn_delete' id='DelIndentDetails' style='font-size:24px' data-index="{{$Sno}}"></td>
																		</tr>
																		<?php $Sno ++; $GrandTotal +=$AMCPoDetailsData->total_cost; ?>
																	@endforeach	
																	<input type="hidden" id ="hidden_total_sno" name ='hidden_total_sno' value ='{{$Sno}}'>
																	<input type='hidden' id='hidden_indent_total_det_index'  value ='{{$Sno}}'>
																@endif
															</tbody>
															<tfoot>
																<tr>
																	<td colspan ='6' align="right">Total Cost</td>
																	<td id ='dispaly_total_amout' align="right">{{$GrandTotal ?? ""}}</td>
																	<input type="hidden" name="txt_total_amout" id="txt_total_amout" value='{{$GrandTotal ?? ""}}'>
																	<td></td>
																</tr>
															</tfoot>
														</table>
													</div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</fieldset>
											</div>	
										</div>
									</div>
								</div>
								<div class="div12" align="center">
									<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
								</div>	
							</div>
						</div>
					</blockquote>
				</div>
			</div>
		</div>
	</form>
</body>	
<!-- @include('common-workflow.workflow-process') -->
<script type="text/javascript" language="javascript">
$(document).ready(function(){
	$('body').on('change', 'input[name="rad_tax_inc"]', function () {
		var TaxPercent       = $("#txt_amsc_gst").val();
    	var TaxType          = $('input[name="rad_tax_inc"]:checked').val();
		var AmcTotalCost     = parseFloat($('#txt_amsc_cost').val()) || 0;
		var PoTaxValue       = 0;
    	var TotalPoAmt       = 0;
		if(TaxType =='EXC'){
			PoTaxValue  = (AmcTotalCost * TaxPercent) / (100);
        	TotalPoAmt  = AmcTotalCost + PoTaxValue;
		}else{
			var TotalPoAmt = AmcTotalCost ;
		}
    	$('#hidden_total_po_amt').val(TotalPoAmt);
	});
	$(".decimalnum").on("input", function() {
		this.value = this.value.replace(/[^0-9.]/g, ''); //
	});
	var RelIndex = 0;
	var TotIndex = $("#hidden_total_sno").val();
	var NewSno   = Number(TotIndex) + 1;
    $('#txt_sno_0').val(NewSno);

	var RelIndex = (TotIndex != '' || TotIndex == NaN) ? TotIndex : RelIndex;
	$(document).on('click','#AddTechRec',function(){
		calculateGrandTotal();
		var GrandTotalCost   = parseFloat($('#txt_total_amout').val()) || 0;
		// var AmcTotalCost     = parseFloat($('#txt_amsc_cost').val()) || 0;
		var AmcPoAmt         = parseFloat($('#hidden_total_po_amt').val()) || 0;
		var SNo              = $('#txt_sno_0 ').val();
		var MaterialType     = $('#cmb_material_type option:selected').text();
		var MaterialId       = $('#cmb_material_type option:selected').val();
		var GoodsserviceName = $('#txt_item_goods_service_name_0').val();
		var QuanityRequired  = $('#txt_item_quantity_req_name_0').val();
		var EstimatedPrice   = $('#txt_item_estimate_no_0').val();
		var GSTRate          = $('#txt_item_gst_rate_0').val();
		var TotalCost        = $('#txt_item_total_cost_0').val();
		var Unit             = $('#cmb_unit_0').val();
		var TaxType         = $('#cmb_tax_type_0 option:selected').text();
		var TaxValue        = $('#cmb_tax_type_0 option:selected').val();
		var UnitName        = $('#txt_unit_0 option:selected').text();
		var UnitId          = $('#txt_unit_0 option:selected').val();
		var ItemAmout       = $('#txt_item_amout_0').val();
		calculateGrandTotal();
		let tablestr = "";
		if(GrandTotalCost > AmcPoAmt){
			BootstrapDialog.alert("Total Cost is greater than the Total AMC Po Cost...!!");
			event.returnValue = false;
		}else if(SNo == ''){
			BootstrapDialog.alert("S.No. should not be empty ..!!");
			event.returnValue = false;
		// }else if(MaterialId == ''){
		// 	BootstrapDialog.alert("Select the Type Of Material Type ..!!");
		// 	event.returnValue = false;
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
		// }else if(GSTRate == ''){	
		// 	BootstrapDialog.alert("GST %  Should not be in empty..!!");
		// 	event.returnValue = false;
		// }else if(TaxValue == ''){
		// 	BootstrapDialog.alert("Select the Tax Type...!!");
		// 	event.returnValue = false;
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
        				var UnitData     = data.MaterialUnit;  //console.log(UnitData);
						tablestr += "<tr>";
						tablestr += "<td><input type='text' style='width:100%' name='txt_sno[]' id='txt_sno_"+RelIndex+"' class='tboxsmclass decimalnum' data-index='" + RelIndex + "' value='" +SNo+ "'></td>";
						//tablestr += "<td><input type='hidden' name='txt_material_type_id[]' id='txt_material_type_id_"+RelIndex+"' class='tboxsmclass' value='" +MaterialId+ "' data-index='" + RelIndex + "'>";
						// tablestr +=  "<select name='txt_material_type[]' id='txt_material_type_"+RelIndex+"' class='tboxsmclass' data-index='" + RelIndex + "'>";
						// tablestr += "<option value=''>----Select ---</option>";
						// 	MaterialType.forEach(function(item) {
						// 		var isSelected = (item.material_type_id == MaterialId) ? 'selected="selected"' : '';
						// 		tablestr += '<option value="' + item.material_type_id + '" ' + isSelected + '>';
						// 		tablestr += item.material_type_name;
						// 		tablestr += '</option>';
						// 	});
						// tablestr += "</select>";
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
						tablestr += "<td><input type='text'style='width:100%' name='txt_item_amout[]' data-index='" + RelIndex + "'id='txt_item_amout_"+RelIndex+"' class='tboxsmclass decimalnum itemamout'readonly value='"+ItemAmout+"'></td>";
						// tablestr += "<td><input type='text'style='width:100%' name='txt_item_gst_rate[]' data-index='" + RelIndex + "'id='txt_item_gst_rate_"+RelIndex+"' class='tboxsmclass decimalnum gstperc' value='"+GSTRate+"'></td>";
						// tablestr += "<td>";
						// 	tablestr +=  "<select name='cmb_tax_type[]' id='cmb_tax_type_"+RelIndex+"' data-index='" + RelIndex + "' class='tboxsmclass taxtype'>";
						// 		tablestr += "<option value=''>----Select ---</option>";
						// 		tablestr += '<option value="INC" ' + (TaxValue == "INC" ? "selected" : "") + '>Inclusive</option>';
						// 	    tablestr += '<option value="EXCL" ' + (TaxValue == "EXCL" ? "selected" : "") + '>Exclusive</option>';
						// 	tablestr += "</select>";
						// tablestr += "</td>";
						var isReadOnly = (TaxValue == 'INC') ? 'readonly' : '';
						//tablestr += "<td><input type='text'style='width:100%;text-align: Right' name='txt_item_total_cost[]'data-index='" + RelIndex + "' id='txt_item_total_cost_"+RelIndex+"' class='tboxsmclass decimalnum' value='"+TotalCost+"'"+isReadOnly+"></td>";
						tablestr += "<td><input type='text'style='width:100%;text-align: Right' name='txt_item_total_cost[]'data-index='" + RelIndex + "' id='txt_item_total_cost_"+RelIndex+"' class='tboxsmclass decimalnum totalamout' value='"+TotalCost+"'></td>";
						tablestr += "<td align='center'><i class='fa fa-times-circle sqdel ptr disable DeleteRow' id='DelIndentDetails' style='font-size:24px'></i></i></td>";
						tablestr += "<input type='hidden' name='hidden_indent_det_id'data-index='" + RelIndex + "' id='hidden_indent_total_det_index' class='tboxsmclass decimalnum unitprice' value='"+RelIndex+"'>";
						tablestr += "</tr>";
						$("#RelationshipTable").append(tablestr);
						SNo++;
						$('#txt_sno_0').val(SNo);
						//$('.itemno').val('');
						$('#cmb_material_type').chosen('destroy');
						$('#cmb_material_type').val('');
						$('#cmb_material_type').chosen();
						$('#txt_item_goods_service_name_0').val('');
						$('#txt_item_quantity_req_name_0').val('');
						$('#txt_item_estimate_no_0').val('');
						$('#txt_item_gst_rate_0').val('');
						$('#txt_item_total_cost_0').val('');
						$('#txt_item_total_cost_0').val('');
						$('#txt_unit_0').val('');
						$('#txt_item_amout_0').val('');
						$('#cmb_tax_type_0').val('');
						$('#txt_unit_0').val('').trigger('chosen:updated');
						RelIndex++;
					}
				}
			});
			
		}
	});
	$(document).on('click','.DeleteRow',function(){
		$(this).closest("tr").remove();
	}); 
	$(".ChosenInput").chosen();
	$('body').on('change', '.itemqty,.unitprice', function() {
		var Index         = $(this).data('index');
		var ItemQty       = Number($('#txt_item_quantity_req_name_'+ Index).val()) || 0;
		var ItemUnitPrice = Number($('#txt_item_estimate_no_'+ Index).val()) || 0;
		var Amount        = 0;
		var Amount        = ItemQty * ItemUnitPrice;

		$("#txt_item_amout_" + Index).val(Amount);
		$("#txt_item_total_cost_" + Index).val(Amount);
		calculateGrandTotal();
	});

		var KillEvent = 0;
		$("body").on("click","#btn_save", function(event){
			if(KillEvent == 0){
			calculateGrandTotal();
			var Discipline          = $("#cmb_discipline").val();
			var AMCType       		= $("#cmb_amc_type").val();
			var AMCBaseOn 		    = $("#cmb_bases_on").val();
			var AMCFileName         = $("#txt_amc_file_name").val();
			var EquipDesc           = $("#txt_desc_equip").val();
			var VendorName          = $("#cmb_vendor_name").val();
			var AMCCost             = parseFloat($('#txt_amsc_cost').val()) || 0;
			var GSTPerc             = $("#txt_amsc_gst").val();
			var TaxOnCost           = $("input[name='rad_tax_inc']:checked").val();
			var Location            = $("#cmb_loc_name").val();
			var PaymentMode         = $("#cmb_bill_pay_mode").val();
			var IndentDetailsCount  = $("#hidden_indent_total_det_index").val();
		    var GrandTotalCost      = parseFloat($('#txt_total_amout').val()) || 0;
			var AmcTotalPoAmt       = parseFloat($('#hidden_total_po_amt').val()) || 0;

			if(Discipline == "" ){
				BootstrapDialog.alert("Select the Discipline..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(AMCType =='' ){
				BootstrapDialog.alert("Select the AMC Type ..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(AMCBaseOn === ''){
				BootstrapDialog.alert("Select the AMC Bases On..!!");
				event.preventDefault();
				event.returnValue = false;	
			}else if(AMCFileName == ''){
				BootstrapDialog.alert("AMC File Name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(EquipDesc == ''){
				BootstrapDialog.alert("Description of Equipment should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(VendorName == ''){
				BootstrapDialog.alert("Select the Vendor Name..!");
				event.preventDefault();
				event.returnValue = false;	
			}else if(AMCCost == ''){
				BootstrapDialog.alert("AMC Cost should not be empty..!");
				event.preventDefault();
				event.returnValue = false;	
			}else if(GSTPerc == ''){
				BootstrapDialog.alert("GST Percentage not be empty..!");
				event.preventDefault();
				event.returnValue = false;
			}else if(TaxOnCost == ''){
				BootstrapDialog.alert("Tax on Cost not be empty..!");
				event.preventDefault();
				event.returnValue = false;
			}else if(Location == ''){
				BootstrapDialog.alert("Select the Location..!");
				event.preventDefault();
				event.returnValue = false;
			}else if(PaymentMode == ''){
				BootstrapDialog.alert("Select the Payment Mode..!");
				event.preventDefault();
				event.returnValue = false;	
			// }else if(GrandTotalCost > AMCCost){
			// 	BootstrapDialog.alert("Total Cost is grater then the AMC cost ..!!");
			// 	event.preventDefault();
			// 	event.returnValue = false;	
			}else if(GrandTotalCost != AmcTotalPoAmt){
				BootstrapDialog.alert("Total Cost and Total AMC Po Cost should be equal..!!");
				event.preventDefault();
				event.returnValue = false;	
			}else if(IndentDetailsCount == '' || IndentDetailsCount == undefined || IndentDetailsCount == null){
				BootstrapDialog.alert("At least one item detail is required...!");
				event.preventDefault();
				event.returnValue = false;		
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure you want to save the AMC Purchase Order  Details?',
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
});	
function calculateGrandTotal() {
    var GrandTotal = 0;
    $('.itemamout').each(function () {
        var val = parseFloat($(this).val()) || 0;
        GrandTotal += val;
    });
    $('#dispaly_total_amout').text(GrandTotal.toFixed(2));
    $('#txt_total_amout').val(GrandTotal.toFixed(2));
}
var vendorDialog;
$("body").on("click","#AddNewVend", function(event){
	var VendorDetailsDataStr = '';
	VendorDetailsDataStr += '<form name="modal_form_vendor" id="modal_form_vendor" method="post" enctype="multipart/form-data">';
	VendorDetailsDataStr += '<table class="formtable" width="100%">';
	VendorDetailsDataStr += '<div class="div3 label">Vendor Name <span class="reqindi">*</span></div>';
	VendorDetailsDataStr += '<div class="div9"><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass" value="@if(isset($data['RoleData'])){{ $data['RoleData']->role_name }}@endif"></div>';
	VendorDetailsDataStr += '<div class="div3 label">Vendor Address <span class="reqindi">*</span></div>';
	VendorDetailsDataStr += '<div class="div9"><textarea name="txt_addr" id="txt_addr" class="tboxsmclass" value=""></textarea></div>';
	VendorDetailsDataStr += '<div class="div3 label">GST No.</div>';
	VendorDetailsDataStr += '<div class="div9"><input type="text" name="txt_gst_no" id="txt_gst_no" class="tboxsmclass" value="" ></div>';
	VendorDetailsDataStr += '<div class="div3 label">Pan No.</div>';
	VendorDetailsDataStr += '<div class="div9"><input type="text" name="txt_pan_no" id="txt_pan_no" class="tboxsmclass" value="" ></div>';
	VendorDetailsDataStr += '<div class="div3 label">Contact No.</div>';
	VendorDetailsDataStr += '<div class="div9"><input type="text" name="txt_contact_no" id="txt_contact_no" class="tboxsmclass" value="" ></div>';
	VendorDetailsDataStr += '<div class="div3 label">Bank Account No</br>(As of now)<span class="reqindi">*</span></div><br>';
	VendorDetailsDataStr += '<div class="div9"><input type="text" name="txt_bank_account_no" id="txt_bank_account_no" class="tboxsmclass" value="@if(isset($data['RoleData'])){{ $data['RoleData']->role_name }}@endif"></div>';
	VendorDetailsDataStr += '<div class="row smclearrow"></div>';
	VendorDetailsDataStr += '<div class="div3 label">IFSC Code <span class="reqindi">*</span></div>';
	VendorDetailsDataStr += '<div class="div9"><input type="text" name="txt_ifsc_code" id="txt_ifsc_code" class="tboxsmclass" value=""></div>';
	VendorDetailsDataStr += '<div class="div3 label">Bank Name</div>';
	VendorDetailsDataStr += '<div class="div9"><input type="text" name="txt_bank_name" id="txt_bank_name" class="tboxsmclass" value="" readonly><input type="hidden" name="txt_bank_id" id="txt_bank_id" class="tboxsmclass" value=""></div>';
	VendorDetailsDataStr += '<div class="div3 label">Bank Branch Address</div>';
	VendorDetailsDataStr += '<div class="div9"><input type="text" name="txt_branch_address" id="txt_branch_address" class="tboxsmclass" value="" readonly><input type="hidden" name="txt_branch_id" id="txt_branch_id" class="tboxsmclass" value=""></div>';
	VendorDetailsDataStr += '<div class="row smclearrow"></div>';
	VendorDetailsDataStr += '<div class="div12" align="center"><input type="button" class="backbutton" name="ModalSave" id="ModalSave" value="Save"  /><input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" /></div>';
	VendorDetailsDataStr += '<div class="row smclearrow"></div>';
	VendorDetailsDataStr += '</table>';
	VendorDetailsDataStr += '</form>';
	vendorDialog = BootstrapDialog.show({
		title: 'Vendor Information',
		message: VendorDetailsDataStr,
	});
});
$("body").on("change","#txt_ifsc_code", function(event){
	$("#txt_bank_name").val('');
	$("#txt_bank_id").val('');
	$("#txt_branch_address").val('');
	$("#txt_branch_id").val('');
	let IfscCode = $(this).val();	
	var SelOption = $('#IfscList option[value="'+IfscCode+'"]');
	let BankId = SelOption.data('bankid');
	$.ajax({
		type: 'POST', 
		url: "{{ route('bank.GetBankData') }}",
		data: { "_token": "{{ csrf_token() }}", 'IfscCode':IfscCode}, 
		success: function (data) {  
			if(data != ''){ 
				let BankData = data['BankData'];
				$.each(BankData, function(key, value){
					let BankName  	= value.bank_name; 
					let BranchAddr  = value.branch_addr1;
					let BranchId 	= value.branch_id;
					let BankId 		= value.bank_id;
					$("#txt_bank_name").val(BankName);
					$("#txt_bank_id").val(BankId);
					$("#txt_branch_address").val(BranchAddr);
					$("#txt_branch_id").val(BranchId);
				});
			}
		}
	});
});

$("body").on("click","#ModalSave", function(event){
	var form = $('#modal_form_vendor')[0]; // You need to use standart javascript object here 
	var formData = new FormData(form);
	formData.append('is_reload','Y');
	formData.append('is_modal','Y');
	formData.append('ModalSave','Y');
	$.ajax({
		type: 'POST', 
		url: "{{ route('vendor.vendor-entry-form') }}",
		data: formData, 
		contentType :  false,               // The content type used when sending data to the server.
		cache       :  false,               // To unable request pages to be cached
		processData :  false,
		dataType: 'json',
		success: function (data) {  
			if(data != ''){ 
				let Message = data['Message']; 
				let ContractorData = data['ContractorData']; 
				let ContractorDetailData = data['ContractorDetailData']; 
				$("#cmb_vendor_name").chosen('destroy');
				$("#cmb_vendor_name option:not(:first)").remove();
				$.each(ContractorData, function(index, element) {
					$("#cmb_vendor_name").append('<option value="'+element.contid+'">'+element.name_contractor+'</option>');
				});
				$("#cmb_vendor_name").chosen();
				if (vendorDialog) {
                    vendorDialog.close();
                }
			}
		}
	});
});
function calculateEndDate() {
    var duration = parseInt($("#txt_work_duration").val());
    var type = $("#cmb_work_duration").val();
    var startDate = $("#txt_start_date").val();

    if (!duration || !type || !startDate) return;

    // 👉 convert DD/MM/YYYY to proper Date
    var parts = startDate.split("/"); 
    var date = new Date(parts[2], parts[1] - 1, parts[0]); // YYYY, MM, DD

    if (type === "DAYS") {
        date.setDate(date.getDate() + duration);
    } else if (type === "MONTH") {
        date.setMonth(date.getMonth() + duration);
    } else if (type === "YEAR") {
        date.setFullYear(date.getFullYear() + duration);
    }

    // 👉 format back to DD/MM/YYYY
    var day = ("0" + date.getDate()).slice(-2);
    var month = ("0" + (date.getMonth() + 1)).slice(-2);
    var year = date.getFullYear();

    $("#txt_end_date").val(day + "/" + month + "/" + year);
}

// trigger
$("#txt_work_duration, #cmb_work_duration, #txt_start_date").on("input change", function () {
    calculateEndDate();
});
	
</script>
@endsection
