@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
if(isset($data['ShowPurchaseEditData'])){
	$PurchaseEditData   = $data['ShowPurchaseEditData'];
	$PurchaseNo         = collect($PurchaseEditData)->pluck('work_order_no')->first();
	$PurchaseName       = collect($PurchaseEditData)->pluck('work_name')->first();
	$ContId             = collect($PurchaseEditData)->pluck('contid')->first();
	$PoDate             = collect($PurchaseEditData)->pluck('work_order_date')->first();
	$IndentId           = collect($PurchaseEditData)->pluck('indent_id')->first();
	$PoCost             = collect($PurchaseEditData)->pluck('work_order_cost')->first();
	$WorkDur            = collect($PurchaseEditData)->pluck('work_duration')->first();
	$DateOfComp         = collect($PurchaseEditData)->pluck('date_of_completion')->first();
	$WrkStartDate       = collect($PurchaseEditData)->pluck('work_commence_date')->first();
	$PoId               = collect($PurchaseEditData)->pluck('work_order_id')->first();
	$MatSectionId       = collect($PurchaseEditData)->pluck('mat_cert_sect_id')->first();
	$PComValue          = collect($PurchaseEditData)->pluck('pcom_status')->first();
	$TrNO               = collect($PurchaseEditData)->pluck('tr_no')->first();
	$QUDate             = collect($PurchaseEditData)->pluck('quotation_date')->first();
	$ProjectMode        = collect($PurchaseEditData)->pluck('work_duration_mode')->first();
	$BillPayMode        = collect($PurchaseEditData)->pluck('bill_pay_mode')->first();
	$GstPerc            = collect($PurchaseEditData)->pluck('gst_perc')->first();
	$PoTaxType          = collect($PurchaseEditData)->pluck('cost_tax')->first();
	$IsGemPortal        = collect($PurchaseEditData)->pluck('is_gem_portal')->first();
	$GemPoNo            = collect($PurchaseEditData)->pluck('gem_po_no')->first();
	$PoTotalAmt         = collect($PurchaseEditData)->pluck('tax_with_po_amt')->first();
}
if(isset($data['POIndentData'])){
	$ShowPOIndentData  = $data['POIndentData'];
	$IndentNo          = collect($ShowPOIndentData)->pluck('indent_no')->first();
	$IndentDate        = collect($ShowPOIndentData)->pluck('indent_date')->first();
	$IndentTittle      = collect($ShowPOIndentData)->pluck('indent_descripton')->first();
	$IndentNoDateStr   = (isset($IndentNo) && isset($IndentDate))  ? 'No. '.$IndentNo.', Date '.Helper::DisplayDateFormat($IndentDate) : '';
}
if(isset($data['IndentEmpdata'])){
	$IndentEmpdata   = $data['IndentEmpdata'];
	$EmpName         = collect($IndentEmpdata)->pluck('emp_name_payslip')->first();
	$EmpIcno         = collect($IndentEmpdata)->pluck('ic_no')->first();
	$EmpDesi         = collect($IndentEmpdata)->pluck('designation_name')->first();
	$IndentEmpTittle = (isset($EmpName) && isset($EmpIcno) && isset($EmpDesi)) ? $EmpName . ' (' . $EmpIcno . '/' . $EmpDesi . ')' : '';
}
if(isset($data['MaxPOSuffixNo'])){
	$PoMaxSufNo = $data['MaxPOSuffixNo'];
}else{
	$PoMaxSufNo = '';
}
if($PoMaxSufNo == '' || $PoMaxSufNo ==  NULL){
	$SuffixNo = '0001';
}else{
	$NextValue = $PoMaxSufNo + 1;
	$SuffixNo  = str_pad($NextValue, 4, '0', STR_PAD_LEFT);
}
$FinYear     = Helper::GetCurrentFinYear(NULL);
$NewPONo     = "IMS/P&S/" . $FinYear . "/" . $SuffixNo . "";
$BackUrl     = 'purchase-order.purchase-order_view';
$SancationIndentIds = $data['GetSancationIndentIds'] ?? [];
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
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Purchase Order Form </div></div></div>
									<div class="row innerdiv">
										<div class="row"> 
											<div class="row row-fluid line-control-menu-bar formtitlebar" style="border:none">
												@if(isset($data['ShowPurchaseEditData']))
													<div class="btn-group floatr">
														<input type="hidden" id ='hidd_po_id' name ='hidd_po_id' value='{{$PoId ?? ""}}'>
														<button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Save">Update</button>	
														<input type="button" class="backbutton" name="back" id="back" value=" Back " onClick="window.location='{{route($BackUrl)}}'" />
													</div>
												@else
													<div class="btn-group floatr">
														<button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Save">Save</button>	
														<input type="button" class="backbutton" name="home" id="home" value=" Home " onclick="window.location='{{ route('dashboard.index') }}'" />
													</div>
												@endif
											</div>
											<!-- Form Steps --> 
											<div class="form-step active"> 
													<fieldset class="fieldbox">
														<legend class="fieldbox-legend" style="margin-top:0px">Indent Details</legend>
														<div class="fieldbox-div">
															<div class="div1 label label">Indent No./ Date</div>
															<div class="div3">
																@if(isset($IndentNoDateStr))
																	<input type="text" name="txt_indent_title" id="txt_indent_title" class="tboxsmclass" value="{{$IndentNoDateStr ?? ''}}" readonly>
																	<input type="hidden" name ='cmb_indent_no_date' id ='cmb_indent_no_date' value='{{$IndentId ?? ""}}'>
																@else
																	<select name="cmb_indent_no_date" id="cmb_indent_no_date" class="tboxsmclass ChosenInput">
																		<option value="">---------- Select ----------</option>
																		@if(isset($data['Indentdata']))
																			@foreach($data['Indentdata'] as $Indentdata)
																				@if(in_array($Indentdata->indent_id, $SancationIndentIds))
																					<option value="{{$Indentdata->indent_id}}">No. {{$Indentdata->indent_no}} , Date:{{Helper::DisplayDateFormat($Indentdata->indent_date)}} </option>
																				@endif
																			@endforeach
																		@endif
																	</select>
																@endif
															</div>  
															<div class="div1 label pd-l-20">Indent Title</div>
															<div class="div3"><input type="text" name="txt_indent_title" id="txt_indent_title" class="tboxsmclass" value="{{$IndentTittle ?? ''}}" readonly></div>
															<div class="div2 label">Indent Created By  <br>(IC No / Designation)</div>
															<div class="div2"><textarea name="txt_indent_created_by" id="txt_indent_created_by" class="tboxsmclass" rows="2" style="resize:none;" readonly>{{$IndentEmpTittle ?? ''}}</textarea></div>
															<div class="row smclearrow"></div>
														</div>
													</fieldset>
													<fieldset class="fieldbox">
														<legend class="fieldbox-legend">Purchase Order  Details</legend>
														<div class="fieldbox-div">
															<div class="row smclearrow"></div>
															<div class="div4">
																<div class="lboxlabel ">Whether the indent is processed through the GeM Portal<span class="reqindi">*</span></div>
																<div class="div3 no-margin" >  
																	<div class="inputGroup paddlr2">
																		<input id="rad_yes" name="rad_Basis" type="radio" value="YES" {{ isset($IsGemPortal) && $IsGemPortal == 'YES' ? 'checked' : '' }}/>
																		<label for="rad_yes" style="padding:3px 0px; width:100%" > &nbsp;Yes</label>
																	</div>
																</div>
																<div class="div3 no-margin">
																	<div class="inputGroup paddlr2">
																		<input id="rad_no" name="rad_Basis" type="radio" value="NO" {{ isset($IsGemPortal) && $IsGemPortal == 'NO' ? 'checked' : '' }}/>
																		<label for="rad_no" style="padding:3px 0px; width:100%"> &nbsp;No</label>
																	</div>
																</div>
																<div class="div6  no-margin gemport" style="margin-top:1px"><input type="text" name="txt_gem_po_no" id="txt_gem_po_no" class="tboxsmclass" placeholder="GeM P.O. No." value="{{$GemPoNo ?? ''}}" ></div>

															</div>
															<div class="div3"><div class="lboxlabel ">PO. No. / WO. No.<span class="reqindi">*</span></div><input type="text" name="txt_pur_order_no" id="txt_pur_order_no" class="tboxsmclass " value="@if(isset($NewPONo)){{$NewPONo}}@endif" readonly></div>
															<div class="div4"><div class="lboxlabel ">PO. Name<span class="reqindi">*</span></div><textarea name="txt_pur_order_name" id="txt_pur_order_name" class="tboxsmclass" rows="1" value ='{{$PurchaseName ?? ""}}'>{{$PurchaseName ?? ''}}</textarea></div>
															<div class="div1"><div class="lboxlabel ">PO. Date<span class="reqindi">*</span></div><input type="text" name="txt_pur_order_date" id="txt_pur_order_date" class="tboxsmclass datepicker" value="{{ Helper::DisplayDateFormat($PoDate ?? null) }}"></div>
															<div class="row smclearrow"></div>
															<div class="div2"><div class="lboxlabel ">PO. Amount<span class="reqindi">*</span></div><input type="text" name="txt_pur_amt" id="txt_pur_amt" class="tboxsmclass passorderamt" value="{{$PoCost ?? ''}}"></div>
															<div class="div2"><div class="lboxlabel ">GST %<span class="reqindi">*</span></div><input type="text" name="txt_po_gst" id="txt_po_gst" class="tboxsmclass" value="{{$GstPerc ?? ''}} "></div>
															<div class="div3"><div class="lboxlabel ">Tax on Cost<span class="reqindi">*</span></div>
																<div class="div6 no-margin">
																	<div class="inputGroup paddlr2">
																		<input id="rad_inc" name="rad_tax_inc" type="radio" value="INC" {{isset($PoTaxType) && $PoTaxType == 'INC' ? 'checked' : ''}}/>
																		<label for="rad_inc" style="padding:3px 0px; width:100%"> &nbsp;Including</label>
																	</div>
																</div>
																<div class="div6 no-margin">
																	<div class="inputGroup paddlr2">
																		<input id="rad_exc" name="rad_tax_inc" type="radio" value="EXC" {{isset($PoTaxType) && $PoTaxType == 'EXC' ? 'checked' : ''}}/>
																		<label for="rad_exc" style="padding:3px 0px; width:100%"> &nbsp;Excluding</label>
																	</div>
																</div>
															</div>
															<div class="div2"><div class="lboxlabel">Po.cost With GST  &#8377;<span class="reqindi">*</span></div><input type="text" name="hidden_total_po_amt" id="hidden_total_po_amt" class="tboxsmclass"readonly value="{{$PoTotalAmt ?? ''}}"></div>
															<div class="div3"><div class="lboxlabel ">Vendor Name<span class="reqindi">*</span></div>
																<div style="display:flex; align-items:center; gap:8px;">
																	<select name="cmb_vendor_name" id="cmb_vendor_name" class="tboxsmclass ChosenInput">
																		<option value="">-------------- Select -------------</option>
																		@if(isset($data['Contractordata']))
																			@foreach($data['Contractordata'] as $ContractorValue)
																				<option value="{{ $ContractorValue->contid }}"
																					{{ isset($ContId) && $ContractorValue->contid == $ContId ? 'selected' : '' }}>
																					{{ $ContractorValue->name_contractor }}
																				</option>
																			@endforeach
																		@endif
																	</select>
																	<i class="fa fa-plus-square sqadd  " id="AddNewVend"  style="font-size:24px; cursor:pointer; color:#10478A;"></i>
																</div>
															</div>
															<div class="row smclearrow"></div>
															<div class="div2">
																<div class="lboxlabel">Work Duration<span class="reqindi">*</span></div>
																<div style="display:flex; gap:5px;">
																	<input type="text" name="txt_work_duration" id="txt_work_duration" class="tboxsmclass" value="{{$WorkDur ?? ''}}">
																	<select name="cmb_work_duration" id="cmb_work_duration" class="tboxsmclass ChosenInput">
																		<option value="">-- Select --</option>
																		<option value="MONTH" {{isset($ProjectMode) && $ProjectMode == 'MONTH' ? 'selected' : ''}}>MONTH</option>
																		<option value="YEAR" {{isset($ProjectMode) && $ProjectMode == 'YEAR' ? 'selected' : ''}}>YEAR</option>
																		<option value="DAYS" {{isset($ProjectMode) && $ProjectMode == 'DAYS' ? 'selected' : ''}}>DAYS</option>
																	</select>
																</div>
															</div>
															<div class="div2"><div class="lboxlabel ">Work Starting Date<span class="reqindi">*</span></div><input type="text" name="txt_start_date" id="txt_start_date" class="tboxsmclass datepicker" value="{{ Helper::DisplayDateFormat($WrkStartDate ?? null) }}"></div>
															<div class="div3"><div class="lboxlabel ">Work Completion Date<span class="reqindi">*</span></div><input type="text" name="txt_end_date" id="txt_end_date" class="tboxsmclass " value="{{Helper::DisplayDateFormat($DateOfComp ?? null) }}" readonly></div>
															<div class="div2"><div class="lboxlabel ">Payment Mode<span class="reqindi">*</span></div>
																<select name="cmb_bill_pay_mode" id="cmb_bill_pay_mode" class="tboxsmclass ChosenInput">
																	<option value="">---------- Select ----------</option>
																	@if(isset($data['BillpaymodeData']))
																		@foreach($data['BillpaymodeData'] as $BillpaymodeData)
																			<option value="{{ $BillpaymodeData->pay_mode_id }}" {{ isset($BillPayMode) && $BillpaymodeData->pay_mode_id == $BillPayMode ? 'selected' : '' }}>{{ $BillpaymodeData->pay_mode_name }}</option>
																		@endforeach
																	@endif
																</select>
															</div>
															@if(!empty($TrNO))
																<div class="div3 editpage"><div class="lboxlabel tenderlabel">Tender No.<span class="reqindi">*</span></div><input type="text" name="txt_tender_no" id="txt_tender_no" class="tboxsmclass tenderlabel" value="{{$TrNO ?? ''}}"></div> 
															@elseif(!empty($QUDate))
																<div class="div1 editpage"><div class="lboxlabel quotationlable">Quotation Date<span class="reqindi">*</span></div><input type="text" name="txt_quotation_date" id="txt_quotation_date" class="tboxsmclass datepicker quotationlable" value="{{ Helper::DisplayDateFormat($QUDate ?? null) }}"></div>
															@endif
															<div id="dynamic_section"></div>
															<div class="row smclearrow"></div>
															<div class="div2 label">Material Certified By <span class="reqindi">*</span></div>
															<div class="div4 label">
																@if(isset($data['MaterialCertifySecData']))
																	@foreach($data['MaterialCertifySecData'] as $MaterialCertifySec)
																		<input type="radio" name="rad_mat_cert_by" id="rad_mat_cert_by"  value="{{ $MaterialCertifySec->office_id }}"{{ isset($MatSectionId) && $MatSectionId == $MaterialCertifySec->office_id ? 'checked' : '' }}> 
																			{{ $MaterialCertifySec->office_name }} &emsp;
																	@endforeach
																@endif
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
																	<th style="width: 80px;">Unit</th>
																	<th style="width: 100px;">Unit <br>Price <br> Rs.</th>
																	<!-- <th style="width: 80px;">GST %</th> -->
																	<th style="width: 80px;">Amount <br> Rs.</th>
																	<!-- <th style="width: 100px;">Tax Type</th> -->
																	<th style="width: 120px;">Total cost <br> with tax (Approx.) <br> Rs.</th>
																</tr>
															</thead>
															@if(isset($data['ShowPoItemDetailsData']))
															<tbody>
																@php $Index = 0; $Grandtotal =0;@endphp
																@foreach(($data['ShowPoItemDetailsData']) as $PoValue)
																	<tr>
																		<td><input type='text' style='width:100%' name='txt_sno[]' id='txt_sno_{{ $Index }}' class='tboxsmclass decimalnum ' data-index='{{ $Index }}' value='{{$PoValue->item_no ?? ""}}'readonly></td>
																		<td><textarea style='width:100%'name='txt_item_goods_service_name[]'data-index='{{ $Index }}' id='txt_item_goods_service_name_{{ $Index }}'class='tboxsmclass ' value='{{$PoValue->item_description ?? ""}}'readonly>{{$PoValue->item_description ?? ""}}</textarea></td>
																		<td><input type='text'style='width:100%' name='txt_item_quantity_req_name[]' data-index='{{ $Index }}' id='txt_item_quantity_req_name_{{ $Index }}' class='tboxsmclass decimalnum  itemqty' value='{{$PoValue->quantity ?? ""}}'readonly></td>
																		<td>
																			<select name="txt_unit[]" id="txt_unit_{{ $Index }}" data-index="{{ $Index }}" class="tboxsmclass disabled">
																				<option value="">----Select----</option>
																				@if(isset($data['ShowMaterialUnit']))
																					@foreach($data['ShowMaterialUnit'] as $unit)
																						<option value="{{ $unit->uom_id }}"
																							{{ (isset($PoValue->unit_id) && $unit->uom_id == $PoValue->unit_id) ? 'selected' : '' }}>
																							{{ $unit->uom_name }}
																						</option>
																					@endforeach
																				@endif
																			</select>
																		</td>
																		<td><input type='text'style='width:100%' name='txt_item_estimate_no[]'data-index='{{ $Index }}' id='txt_item_estimate_no_{{ $Index }}' class='tboxsmclass decimalnum unitprice' value='{{$PoValue->estimated_unit_price ?? ""}}'></td>
																		<!-- <td><input type='text'style='width:100%' name='txt_item_gst_perc[]'data-index='{{ $Index }}' id='txt_item_gst_perc_{{ $Index }}' class='tboxsmclass decimalnum unitprice' value=''></td> -->
																		<td><input type='text'style='width:100%' name='txt_item_amout[]' data-index='{{ $Index }}'id='txt_item_amout_{{ $Index }}' class='tboxsmclass decimalnum itemamout'readonly value='{{$PoValue->total_cost ?? ""}}' readonly></td>
																		<!-- <td>
																			<select name='cmb_tax_type[]' id='cmb_tax_type_{{ $Index }}' data-index='{{ $Index }}' class='tboxsmclass taxtype '>
																			<option value="">----Select ---</option>
																			<option value="INC" {{ ($PoValue->tax_type ?? '') == "INC" ? 'selected' : '' }}>Inclusive</option>
																			<option value="EXCL" {{ ($PoValue->tax_type ?? '') == "EXCL" ? 'selected' : '' }}>Exclusive</option> -->
																		<td><input type='text'style='width:100%;text-align: Right' name='txt_item_total_cost[]'data-index='{{ $Index }}' id='txt_item_total_cost_{{ $Index }}' class='tboxsmclass decimalnum' value='{{$PoValue->item_amount ?? ""}}'readonly></td>
																		<input type='hidden' name='hidden_indent_det_id[]'data-index='{{ $Index }}' id='hidden_indent_det_id_{{ $Index }}'  value='{{$PoValue->indent_det_id ?? ""}}'>
																	</tr>
																@php $Index ++; $Grandtotal += $PoValue->item_amount;@endphp
																@endforeach
																<tr>
																	<input type="hidden" name="hidden_indent_total_det_index" id="hidden_indent_total_det_index" value ='{{$Index ?? "" }}'>
																	<td colspan='6' align='right'>Total Po. Cost </td>
																	<td align='right' id ='txt_grant_total' name ='txt_grant_total' value='{{$Grandtotal ?? ""}}'>{{$Grandtotal ?? ''}}</td>
																</tr>
															</tbody>
															@endif
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
								    <input type="hidden" name="hid_po_suff_no" id="hid_po_suff_no" value="@if(isset($SuffixNo)){{$SuffixNo}}@endif" />
									<div class="row smclearrow"></div>
									<div class="row smclearrow"></div>  
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
    $('.gemport').hide();
	var IsGemPortal = $('input[name="rad_Basis"]:checked').val();
	if (IsGemPortal == 'YES') {
        $('.gemport').show();
    } else {
        $('.gemport').hide();
    }
	$('.paddlr2 input[type=radio][name="rad_Basis"]').on('change', function () {
		$('.gemport').val('');
        if ($(this).val() === 'YES') {
            $('.gemport').show();
        } else {
            $('.gemport').hide();
        }
    });
	$(".decimalnum").on("input", function() {
		this.value = this.value.replace(/[^0-9.]/g, ''); //
	});
	$(".ChosenInput").chosen();
	$('input[name="rad_pg_collected"]').click(function(){
        var projectType = $(this).val();
        if(projectType == 'YES'){
            $("#internal_options").show();
        }else{
            $("#internal_options").hide();
        }
    });
	$('body').on('change', '.passorderamt', function () {
		$('.editpage').hide();
		var PassOrderAmount = parseFloat($(this).val()) || 0;
		var pocmHtml = ''; 
		if (PassOrderAmount >= 50000) {
			$("#pcom_2").prop("checked", true).trigger("change");
			pocmHtml += '<div class="div3">';
			pocmHtml +=	'<div class="lboxlabel tenderlabel">Tender No.<span class="reqindi">*</span></div>';
			pocmHtml +=	'<input type="text" name="txt_tender_no" class="tboxsmclass tenderlabel" value="">';
			pocmHtml += '</div>';
		} else {
			$("#pcom_1").prop("checked", true).trigger("change");
			pocmHtml += '<div class="div3">';
			pocmHtml += '<div class="lboxlabel quotationlable">Quotation Date<span class="reqindi">*</span></div>';
			pocmHtml += '<input type="text" name="txt_quotation_date" class="tboxsmclass datepicker quotationlable" value="">';
			pocmHtml += '</div>';
		}
		$('#dynamic_section').html(pocmHtml);
		$('.datepicker').datepicker();
	});
	// $("#txt_pur_amt").on("keyup change", function() {
	// 	var PassOrderAmount = parseFloat($(this).val()) || 0;
	// 	if (PassOrderAmount >= 500001){
	// 		$("#pcom_2").prop("checked", true).trigger("change");
	// 		$('.tenderlabel').show();
	// 		$('.quotationlable').hide();

	// 	}else if (PassOrderAmount <= 50000) {
	// 		$("#pcom_1").prop("checked", true).trigger("change");
	// 		$('.quotationlable').show();
	// 		$('.tenderlabel').hide();
	// 	}else {
	// 		$("input[name='rad_pcom']").prop("checked", false);
	// 	}
	// });
	// $("#txt_pur_amt").on("change keyup", function() {
	// 	var PassOrderAmount = parseFloat($(this).val()) || 0;

	// 	if (PassOrderAmount > 500000) {
	// 		// Tender
	// 		$("#pcom_2").prop("checked", true).trigger("change");
	// 		$('.tenderlabel').show();
	// 		$('.quotationlable').hide();

	// 	} else {
	// 		// Quotation (covers 0 to 500000)
	// 		$("#pcom_1").prop("checked", true).trigger("change");
	// 		$('.quotationlable').show();
	// 		$('.tenderlabel').hide();
	// 	}
	// });
	// $('body').on('change', 'input[name="rad_tax_inc"]', function () {
	// 	var TaxPercent       = $("#txt_po_gst").val();
    // 	var TaxType          = $('input[name="rad_tax_inc"]:checked').val();
	// 	var AmcTotalCost     = parseFloat($('#txt_pur_amt').val()) || 0;
	// 	var PoTaxValue       = 0;
    // 	var TotalPoAmt       = 0;
	// 	if(TaxType =='EXC'){
	// 		PoTaxValue  = (AmcTotalCost * TaxPercent) / (100);
    //     	TotalPoAmt  = AmcTotalCost + PoTaxValue;
	// 	}else{
	// 		var TotalPoAmt = AmcTotalCost ;
	// 	}
    // 	$('#hidden_total_po_amt').val(TotalPoAmt);
	// });
	$('body').on('change', '#rad_inc,#rad_exc,#txt_po_gst,#txt_pur_amt', function() {
		CalculateTotalPoAmount();
	});
	function CalculateTotalPoAmount(){
		var TaxPercent   = parseFloat($("#txt_po_gst").val()) || 0;
		var TaxType      = $('input[name="rad_tax_inc"]:checked').val();
		var AmcTotalCost = parseFloat($('#txt_pur_amt').val()) || 0;
		var PoTaxValue   = 0;
		var TotalPoAmt   = 0;
		if (TaxType == 'EXC') {
			PoTaxValue = (AmcTotalCost * TaxPercent) / 100;
			TotalPoAmt = AmcTotalCost + PoTaxValue;
		} else {
			TotalPoAmt = AmcTotalCost;
		}
		$('#hidden_total_po_amt').val(TotalPoAmt);
	}
	$('body').on('input change', '.pocmlable', function(event) {
		var PcomValue = $('input[name="rad_pcom"]:checked').val();
		if(PcomValue == 'YES'){
			$('.tenderlabel').show();
		}else if(PcomValue == 'NO'){
			$('.tenderlabel').hide();
		}
	});
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
	$("body").on("change", "#cmb_indent_no_date", function (event) {
		$("#RelationshipTable tbody").empty();
		var IndentId = $(this).val();
		var tablestr = "";
		var RelIndex = 0;
		var GrandTotal = 0;
		if ((IndentId!='') && (IndentId!=null)) {
			$.ajax({
				type: 'POST',
				url: "{{ route('indent.GetIndentData') }}",
				data: { "_token": "{{ csrf_token() }}", 'IndentId': IndentId },
				// dataType: 'json',
				success: function (data) { //console.log(data);
				
					if (data != '') {
						let IndentData        = data['IndentData']; 
						let IndentDetailsData = data['IndentDetailsData']; 
						var UnitData          = data['MaterialUnit'];
						var IndentCreEmpData  = data['IndentCreateEmpData'];

						$.each(IndentDetailsData, function(index, item) {
							var TaxValue      = item.tax_type;
							var UnitId        = item.unit_id;
							var ItemQty       = parseFloat(item.quantity) || 0;
							var ItemPrice     = parseFloat(item.estimated_unit_price) || 0;
							var ItemContPrice = item.rate_cont_amt;
							if(ItemContPrice > 0){
								ItemPrice = ItemContPrice;
							}else{
								ItemPrice = ItemPrice;
							}
							var Amt  = ItemQty * ItemPrice;
							tablestr += "<tr>";
							tablestr += "<td><input type='text' style='width:100%' name='txt_sno[]' id='txt_sno_"+RelIndex+"' class='tboxsmclass decimalnum ' data-index='" + RelIndex + "' value='" +item.item_no+ "'readonly></td>";
							tablestr += "<td><textarea style='width:100%'name='txt_item_goods_service_name[]'data-index='" + RelIndex + "' id='txt_item_goods_service_name_"+RelIndex+"'class='tboxsmclass ' value='" +item.item_description+ "'readonly>" + item.item_description + "</textarea></td>";
							tablestr += "<td><input type='text'style='width:100%' name='txt_item_quantity_req_name[]' data-index='" + RelIndex + "' id='txt_item_quantity_req_name_"+RelIndex+"' class='tboxsmclass decimalnum  itemqty' value='"+ItemQty+"'readonly></td>";
							tablestr += "<td>";
								tablestr +=  "<select name='txt_unit[]' id='txt_unit_"+RelIndex+"'data-index='" + RelIndex + "' class='tboxsmclass disabled'>";
								tablestr += "<option value=''>----Select ---</option>";
								UnitData.forEach(function(item) {
									var isSelected = (item.uom_id == UnitId) ? 'selected="selected"' : '';
									tablestr += '<option value="' + item.uom_id + '" ' + isSelected + '>';
									tablestr += item.uom_name;
									tablestr += '</option>';
								});
								tablestr += "</select>";
							tablestr += "</td>";
							tablestr += "<td><input type='text'style='width:100%' name='txt_item_estimate_no[]'data-index='" + RelIndex + "' id='txt_item_estimate_no_"+RelIndex+"' class='tboxsmclass decimalnum unitprice' value='"+ItemPrice+"'></td>";
							// tablestr += "<td><input type='text'style='width:100%' name='txt_item_gst_perc[]'data-index='" + RelIndex + "' id='txt_item_gst_perc_"+RelIndex+"' class='tboxsmclass decimalnum unitprice' value=''></td>";
							tablestr += "<td><input type='text'style='width:100%' name='txt_item_amout[]' data-index='" + RelIndex + "'id='txt_item_amout_"+RelIndex+"' class='tboxsmclass decimalnum itemamout'readonly value='"+Amt+"' readonly></td>";
							// tablestr += "<td>";
							// 	tablestr +=  "<select name='cmb_tax_type[]' id='cmb_tax_type_"+RelIndex+"' data-index='" + RelIndex + "' class='tboxsmclass taxtype '>";
							// 		tablestr += "<option value=''>----Select ---</option>";
							// 		tablestr += '<option value="INC" ' + (TaxValue == "INC" ? "selected" : "") + '>Inclusive</option>';
							// 		tablestr += '<option value="EXCL" ' + (TaxValue == "EXCL" ? "selected" : "") + '>Exclusive</option>';
							// 	tablestr += "</select>";
							// tablestr += "</td>";
							// var isReadOnly = (TaxValue == 'INC') ? 'readonly' : '';
							tablestr += "<td><input type='text'style='width:100%;text-align: Right' name='txt_item_total_cost[]'data-index='" + RelIndex + "' id='txt_item_total_cost_"+RelIndex+"' class='tboxsmclass decimalnum' value='"+Amt+"'readonly></td>";
							tablestr += "<input type='hidden' name='hidden_indent_det_id[]'data-index='" + RelIndex + "' id='hidden_indent_det_id_"+RelIndex+"' class='tboxsmclass decimalnum unitprice' value='"+item.indent_dt_id+"'>";
							tablestr += "<input type='hidden' name='hidden_indent_det_id[]'data-index='" + RelIndex + "' id='hidden_indent_total_det_index' class='tboxsmclass decimalnum unitprice' value='"+RelIndex+"'>";
							tablestr += "</tr>";
							// $("#RelationshipTable").append(tablestr);
							GrandTotal += Amt;
							RelIndex++;
						});
						tablestr += "<tr>";
						tablestr += "<td colspan='6' align='right'>Total Po. Cost</td>";
						tablestr += "<td align='right' id ='txt_grant_total' name ='txt_grant_total' value ='" + GrandTotal.toFixed(2) + "'>" + GrandTotal.toFixed(2) + "</td>";
						tablestr += "</tr>";
						$("#RelationshipTable").append(tablestr);
						if ((IndentCreEmpData != '') && (IndentCreEmpData != null)) { 
							$.each(IndentCreEmpData, function (index, element) {
								var IndStaffName    = element.emp_name_payslip;
								var IndStaffEmpNo   = element.emp_no;
								var IndStaffDesName = element.designation_name;
    							var DisplayText     = IndStaffName + " (" + IndStaffEmpNo + " / " + IndStaffDesName + ")";
							 	$("#txt_indent_created_by").val(DisplayText);
							});
						}	
						if ((IndentData != '') && (IndentData != null)) { 
							$.each(IndentData, function (index, element) {
							$("#txt_indent_title").val(element.indent_descripton);
							$("#txt_pur_order_name").val(element.indent_descripton);
							});
						}else{
							BootstrapDialog.alert("Please Enter the Correct Indent No");
							$("#cmb_indent_no_date").val(''); 
						}
					}
				}
			});
		}
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
$("#txt_work_duration, #cmb_work_duration, #txt_start_date")
.on("input change", function () {
    calculateEndDate();
});
	var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var IndetNoDate     	= $("#cmb_indent_no_date").val();
			var MatCertifyby        = $("input[name='rad_mat_cert_by']:checked").val();
			var WorkOrderDuration   = $("#cmb_work_duration_mode").val();
			var PoName       		= $("#txt_pur_order_name").val();
			var PoDate 		        = $("#txt_pur_order_date").val();
			// var PoAmt               = $("#txt_pur_amt").val();
			var PoAmt               = parseFloat($('#txt_pur_amt').val()) || 0;
			var VendorName          = $("#cmb_vendor_name").val();
			var WrkStartDate        = $("#txt_start_date").val();
			var WrkEndDate          = $("#txt_end_date").val();
			var PcomValue           = $("input[name='rad_pcom']:checked").val();
			var TrNo                = $("#txt_tender_no").val();
			var QuotationDate       = $("#txt_quotation_date").val();
			var IndentDetailsCount  = $("#hidden_indent_total_det_index").val();
			// var GrandTotal          = $("#txt_grant_total").text().trim();
			var GrandTotal          = parseFloat($('#txt_grant_total').text()) || 0;
			if(IndetNoDate == ""){
				BootstrapDialog.alert("Select the Indent No./ Date Details..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(MatCertifyby == "" || MatCertifyby == undefined || MatCertifyby == null){
				BootstrapDialog.alert("Check the Material Certify By Details..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(WorkOrderDuration =='' ){
				BootstrapDialog.alert(" Select the Work Duration ..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(PoName === ''){
				BootstrapDialog.alert("Purchase Order Name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;	
			}else if(PoDate == ''){
				BootstrapDialog.alert("Purchase Order Date should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(PoAmt == ''){
				BootstrapDialog.alert("Purchase Order Amount should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(PoAmt < 50000  && QuotationDate == ''){
				BootstrapDialog.alert("Quotation Date should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;	
			// }else if(PoAmt >= 50000 && PcomValue == '' || PcomValue == undefined ){
			// 	BootstrapDialog.alert(" Select the PCOM1/PCOM2  ..!!");
			// 	event.preventDefault();
			// 	event.returnValue = false;	
			// }else if(PcomValue == 'YES' && TrNo == '' && PoAmt >= 50000){
			}else if(TrNo == '' && PoAmt >= 50000){
				BootstrapDialog.alert(" Tender No should not be empty ..!!");
				event.preventDefault();
				event.returnValue = false;	
			}else if(VendorName == ''){
				BootstrapDialog.alert("Select the Vendor Name..!");
				event.preventDefault();
				event.returnValue = false;	
			}else if(WrkStartDate == ''){
				BootstrapDialog.alert("Work Starting Date should not be empty..!");
				event.preventDefault();
				event.returnValue = false;	
			}else if(WrkEndDate == ''){
				BootstrapDialog.alert("Work Completion Dateshould not be empty..!");
				event.preventDefault();
				event.returnValue = false;
			}else if(IndentDetailsCount == '' || IndentDetailsCount == undefined || IndentDetailsCount == null){
				BootstrapDialog.alert("At least one item detail is required...!");
				event.preventDefault();
				event.returnValue = false;	
			}else if(GrandTotal > PoAmt){
				BootstrapDialog.alert("Total Po. Cost should not be greater than the PO Amount!");
				event.preventDefault();
				event.returnValue = false;		
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure you want to save the Purchase Order  Details?',
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
    $('#txt_grant_total').text(GrandTotal.toFixed(2));
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
	VendorDetailsDataStr += '<div class="div12" align="center"><input type="button" class="step-btn" name="ModalSave" id="ModalSave" value="Save"  /><input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" /></div>';
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

	
</script>
@endsection
