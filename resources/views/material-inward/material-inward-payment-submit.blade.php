@extends('layouts.dashboard-master')
@section('content')
@include('layouts.partials.messages')
@php
$FromPage           = isset($data['FromPage']) ? $data['FromPage'] : null;
$WorkFlowActionData = isset($data['WorkFlowActionData']) ? $data['WorkFlowActionData'] : null;
$VendorArr          = isset($data['VendorData']) ? $data['VendorData'] : null;
if(isset($data['ShowMatrialInwardSubmitData'])){
	$PoMatData     = $data['ShowMatrialInwardSubmitData'];
	$MatInwardId   = collect($PoMatData)->pluck('master_inward_id')->first();
	$PoNo          = collect($PoMatData)->pluck('work_order_no')->first();
	$PoName        = collect($PoMatData)->pluck('work_name')->first();
	$PoDate        = collect($PoMatData)->pluck('work_order_date')->first();
	$ContId        = collect($PoMatData)->pluck('contid')->first();
	$ReceiptNo     = collect($PoMatData)->pluck('receiptno')->first();
	$ReceiptDate   = collect($PoMatData)->pluck('receipt_date')->first();
	$InvoiceDate   = collect($PoMatData)->pluck('invoice_date')->first();
	$InvoiceNos    = collect($PoMatData)->pluck('invoice_no')->first();
	$CurrentStatus = collect($PoMatData)->pluck('status')->first();
	$IndentId      = collect($PoMatData)->pluck('indent_id')->first();
	$POId          = collect($PoMatData)->pluck('po_id')->first();
    $invoiceArray  = json_decode($InvoiceNos, true);
    $InvoiceString = is_array($invoiceArray) ? implode(', ', $invoiceArray) : $InvoiceNos;
    $VendorName    = $VendorArr[$ContId];
}
$BackUrl       = 'material.material-inward-submission';
$ActionStatus  = $FromPage;
$Action        = $FromPage;
$PaymentPercFieldAccess = $data['SessionWiseFiledAcessData']  ?? [];
$HasPaymentPercAccess   = (count($PaymentPercFieldAccess) > 0) ? 'Y' : '';
$IsPaymentEdit          = collect($PaymentPercFieldAccess)->contains('is_editable', true) ? 'Y' : '';
$InvoicesDocArr         = $data['InvoicesDocData'] ?? [];
$IndentCreateEmpNameArr = $data['IndentCreateEmpName'] ?? [];
$IndentCreateEmpName    = $IndentCreateEmpNameArr[$IndentId] ?? '';
$DeliveryChallDocArr    = $data['DeliveryChallanWithDocs'] ?? [];

@endphp
<form action="" method="post" enctype="multipart/form-data" name="form">
    <div class="content">
        <div class="title"></div>
        <div class="container_12">
            <div class="grid_12">
                <blockquote class="bq1" style="overflow:auto">
                    <div class="container">
                        <div class="row plr">
                            <div class="div12 mbtable">
                                {{-- ── Page Title ── --}}
                                <div class="row">
                                    <div class="div12" style="margin-top:0px;">
                                        <div class="row divhead" align="center">Material Inward Payment</div>
                                    </div>
                                </div>
                                <div class="row innerdiv">
                                    <div class="row">
                                        @php
											$RouteUrl      = 'material.material-inward-submission';
											$ModuleCode    = 'MAT_INWARD';
                                            $SubmitBtnName = 'Submit Material Certification';
											$ForwRejApprButtonComponentArr = \Helper::Forward_Reject_Approve_Button(NULL,$SubmitBtnName,$WorkFlowActionData,$BackUrl,$MatInwardId,$RouteUrl,$ActionStatus,$ModuleCode);
											$ButtonDetailsHTML = $ForwRejApprButtonComponentArr['HTMLSTR'];
										@endphp
											{!!$ButtonDetailsHTML!!}
                                        <div class="form-step active">
                                            {{-- ── Purchase / Receipt Information Fieldset ── --}}
                                        	<div class="row smclearrow"></div>
												<fieldset class="fieldbox"  >
													<legend class="fieldbox-legend" style ='top-padding : 10%'>Purchase</legend>
													<div class="fieldbox-div">
                                                        <div class="div2"><div class="lboxlabel ">Purchase order No.</div><input type="text" name="txt_purchase_order_no" id="txt_purchase_order_no" class="tboxsmclass " readonly value="{{ $PoNo ?? $PoNo ?? '' }}" ></div>
                                                        <div class="div2"><div class="lboxlabel ">Purchase order Date</div><input type="text" name="txt_purchase_order_date" id="txt_purchase_order_date" class="tboxsmclass " readonly value="{{ Helper::DisplayDateFormat($PoDate ?? $PoDate ?? '') }}" ></div>
                                                        <div class="div2"><div class="lboxlabel ">Indent Created By</div><input type="text" name="txt_indent_created_by" id="txt_indent_created_by" class="tboxsmclass " readonly value="{{$IndentCreateEmpName}}" ></div>
                                                        <div class="div2"><div class="lboxlabel ">Vendor Name</div><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="{{$VendorName ?? $VendorName ?? ''}}" ></div>
                                                        <!-- <div class="div2"><div class="lboxlabel ">Receipt No. / GRN No.</div><input type="text" name="txt_receipt_no" id="txt_receipt_no" class="tboxsmclass" readonly value="{{ $ReceiptNo ?? $NewReceiptNo ?? '' }}"></div> -->
                                                        <!-- <div class="div1"><div class="lboxlabel ">Receipt Date</div><input type="text" name="txt_receipt_date" id="txt_receipt_date" class="tboxsmclass datepicker" value="{{ Helper::DisplayDateFormat($ReceiptDate ?? $ReceiptDate ?? '') }}" ></div> -->
                                                         <!-- <div class="div1"><div class="lboxlabel ">Invoice No.</div><input type="text" name="txt_purchase_order_date" id="txt_purchase_order_date" class="tboxsmclass " readonly value="@php if(isset($InvoiceString)){ echo $InvoiceString; } @endphp" ></div> -->
                                                        <!-- <div class="div1"><div class="lboxlabel ">Invoice Date</div><input type="text" name="txt_purchase_order_date" id="txt_purchase_order_date" class="tboxsmclass " readonly value="@php if(isset($InvoiceDate)){ echo Helper::DisplayDateFormat($InvoiceDate);} @endphp" ></div> -->
                                                        <div class="row smclearrow"></div>
                                                    </div>
												</fieldset>                                                           											
                                            </div>
                                            <div class="row smclearrow"></div>
                                            <div class="row smclearrow"></div>
                                            <div class="row smclearrow"></div>
                                               {{-- ── MATERILA INWARD  DELIVERY CHALLAN DOCUMENTS TABLE  ── --}}
                                            <div class="table-container">
                                                <div class="table-wrapper">
                                                    <div class="section-header"><span>Delivery Challan Documents / Receipt Details</span></div>
                                                    <table class="formtable" disabled width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align:center; width:60%">Receipt No. / GRN No.</th>  
                                                                <th style="text-align:center; width:30%">Receipt Date</th>  
                                                                <th style="text-align:center; width:30%">Download</th>  
                                                            </tr>
                                                        </thead>
                                                        <tbody id="supp_doc_tbody">	
                                                            @if(isset($DeliveryChallDocArr))
                                                                @foreach($DeliveryChallDocArr as $DocValue)
                                                                <tr>
                                                                    <td>
                                                                        <input type="text"  style="width:100%" name="txt_supp_doc_desc[]" id="txt_sno" class="tboxsmclass" readonly value="{{$DocValue->receipt_no ?? ''}}">
                                                                    </td>
                                                                    <td><input type="text" name="txt_supp_doc_date[]" id="txt_supp_doc_date" class="tboxsmclass "  readonly value="{{ Helper::DisplayDateFormat($DocValue->receipt_date ?? $DocValue->receipt_date ?? '') }}"></td>
                                                                    <td class="labelcenter" style="text-align:center;">
                                                                        <button type="button"  id="btn_recpt_download" data-fileid="{{ encrypt($DocValue->sup_doc_id) }}" class="btn btn-default tuploadbtn" title="Click here to Download the File" style="cursor: pointer;"><i class="fa fa-download"></i> Download File</button>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td colspan='3'style="text-align:center;">No Records Found ..!</td>
                                                                </tr> 
                                                            @endif	
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row smclearrow"></div>
                                            <div class="row smclearrow"></div>
                                            <div class="row smclearrow"></div>
                                            {{-- ── MATERILA INWARD  SUPPORTING DOCUMENTS TABLE  ── --}}
                                            <div class="table-container">
                                                <div class="table-wrapper">
                                                    <div class="section-header">
                                                    <span>Invoice Documents Details</span>
                                                    <div style="display:flex; gap:8px; align-items:center;">
                                                        <button type="button" id='btn_supp_doc' data-id="{{$IndentId}}" class="rm-new-emp-btn pill-header-btn">Sanction Supporting Documents</button>
                                                        <button type="button" id='btn_Pg_Fd' data-id="{{$POId}}" class="rm-new-emp-btn pill-header-btn">SD & PBG Details</button>
                                                    </div>
                                                </div>
                                                <table class="formtable" disabled width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align:center; width:60%">Invoice Description</th>  
                                                            <th style="text-align:center; width:30%">Date</th>  
                                                            <th style="text-align:center; width:30%">Download</th>  
                                                        </tr>
                                                    </thead>
                                                    <tbody id="supp_doc_tbody">	
                                                        @if(isset($InvoicesDocArr) && !empty($InvoicesDocArr) && $InvoicesDocArr->count() > 0)
                                                            @foreach($InvoicesDocArr as $DocValue)
                                                            <tr>
                                                                <td>
                                                                    <input type="text"  style="width:100%" name="txt_supp_doc_desc[]" id="txt_sno" class="tboxsmclass" readonly value="{{$DocValue->doc_desc ?? ''}}">
                                                                </td>
                                                                <td><input type="text" name="txt_supp_doc_date[]" id="txt_supp_doc_date" class="tboxsmclass "  readonly value="{{ Helper::DisplayDateFormat($DocValue->doc_date ?? $DocValue->doc_date ?? '') }}"></td>
                                                                <td class="labelcenter" style="text-align:center;">
                                                                    <button type="button"  id="btn_download" data-fileid="{{ encrypt($DocValue->sup_doc_id) }}" class="btn btn-default tuploadbtn" title="Click here to Download the File" style="cursor: pointer;"><i class="fa fa-download"></i> Download File</button>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan='3'style="text-align:center;">No Records Found ..!</td>
                                                            </tr>    
                                                        @endif	
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="row smclearrow"></div>
                                            <div class="row smclearrow"></div>
                                            <div class="row smclearrow"></div>
                                            {{-- ── Material Inward  Information Table ── --}}
                                            @if($HasPaymentPercAccess == 'Y')
                                                <input type="hidden" id= 'hidd_ispayemt_edit' name ='hidd_ispayemt_edit' value='{{$IsPaymentEdit ?? ""}}'>
                                                <div class="table-container">
													<div class="table-wrapper">
														<div class="section-header"><span>Item Details of Required Items </span></div>
														<table class="formtable"  width="100%">
															<thead>
																<tr>
                                                                    <th width="3%">S.No.</th>
                                                                    <th width="25%" style="text-align: center;">Item Description</th>
                                                                    <th width="3%">Unit</th>
                                                                    <th width="3%">Po Qty</th>
                                                                    <th width="3%">Previous<br>Received<br>Qty</th>
                                                                    <th width="3%">Received<br>Now<br>Qty</th>
                                                                    <th width="3%">Balance<br>Qty</th>
                                                                    <th width="3%">Po Rate<br>(Rs.)</th>
                                                                    <th width="3%">Total Cost<br>(Rs.)</th>
                                                                    <th width="3%">Payment<br>(%)</th>
                                                                    <th width="4%">Total Payment<br>Amount</th>
                                                                    <th width="5%">DCA Certified Payment<br>(%)</th>
                                                                    <th width="8%">DCA Certified Total Payment<br>Amount</th>
                                                                    <th width="4%">Location</th>
                                                                    <th width="3%">Whether<br>Certified</th>
                                                                    <th width="10%">Q.C Remarks</th>
                                                                    <th width="25%">DCA Certified <br>Remarks</th>
                                                                </tr>
															</thead>
															<tbody >
																@if(isset($data['MaterialInwardDetailData']))
																	@php $Sno = 1; $TotPayAmout = 0;@endphp
																	@foreach($data['MaterialInwardDetailData'] as $MatValue)
																		<tr>
                                                                            <input type="hidden" name ='txt_item_no[]' id="txt_item_no_{{$Sno}}" data-index ='{{$Sno}}' value ='{{$MatValue->item_no}}'>
																			<td align="center" >{{$MatValue->item_no}}</td>
                                                                            <input type="hidden" name ='txt_item_desc[]' id="txt_item_desc_{{$Sno}}" data-index ='{{$Sno}}' value ='{{$MatValue->item_description}}'>
																			<td>{{$MatValue->item_description}}</td>
                                                                            <input type="hidden" name ='txt_unit[]' id="txt_unit_{{$Sno}}" data-index ='{{$Sno}}' value ='{{$MatValue->item_unit}}'>
                                                                            <td align="center">
																				@foreach($data['ShowMaterialUnit'] as $MaterialUnitData)
																					@if($MaterialUnitData->uom_id == $MatValue->item_unit)
																						{{$MaterialUnitData->uom_name}}
																					@endif
																				@endforeach
																			</td>
                                                                            <input type="hidden" name ='txt_po_qty[]' id="txt_po_qty_{{$Sno}}" data-index ='{{$Sno}}' value ='{{$MatValue->po_quantity}}'>
																			<td align="center">{{$MatValue->po_quantity}}</td>
                                                                            <input type="hidden" name ='txt_prev_recd_qty[]' id="txt_prev_recd_qty_{{$Sno}}" data-index ='{{$Sno}}' value ='{{$MatValue->previously_received_qty}}'>
																			<td align="center">{{$MatValue->previously_received_qty}}</td>
                                                                            <input type="hidden" name ='txt_recd_now_qty[]' id="txt_recd_now_qty_{{$Sno}}" data-index ='{{$Sno}}' value ='{{$MatValue->received_qty}}'>
																			<td align="center">{{$MatValue->received_qty}}</td>
                                                                            <input type="hidden" name ='txt_balan_qty[]' id="txt_balan_qty_{{$Sno}}" data-index ='{{$Sno}}' value ='{{$MatValue->balance_qty}}'>
																			<td align="right">{{$MatValue->balance_qty}}</td>
                                                                            <input type="hidden" name ='txt_rate_per_unit[]' id="txt_rate_per_unit_{{$Sno}}" data-index ='{{$Sno}}' value ='{{$MatValue->unit_rate}}'>
																			<td align="right">{{$MatValue->unit_rate}}</td>
                                                                            <input type="hidden" name ='txt_total_cost[]' id="txt_total_cost_{{$Sno}}" data-index ='{{$Sno}}' value ='{{$MatValue->total_cost}}'>
																			<td align="right">{{$MatValue->total_cost}}</td>
                                                                            <input type="hidden" name="txt_item_pay_perc[]" id="txt_item_pay_perc_{{$Sno}}" data-index ='{{$Sno}}' class="tboxsmclass decimalnum " style="width:100%; text-align:right"  value="{{ $MatValue->payment_perc ? $MatValue->payment_perc : '' }}" >
																			<td align="right">{{$MatValue->payment_perc}}</td>
																			<input type="hidden" name="txt_item_payment_amt[]" id="txt_item_payment_amt_{{$Sno}}" data-index ='{{$Sno}}' class="tboxsmclass payamount" style="width:100%; text-align:right" readonly value="{{ $MatValue->total_payment_amout ? $MatValue->total_payment_amout : '' }}" >
																			<td align="right">{{$MatValue->total_payment_amout}}</td>
                                                                            @if($IsPaymentEdit == 'Y')
                                                                            	<td align="right"><input type="text" name="txt_acc_item_pay_perc[]" id="txt_acc_item_pay_perc_{{$Sno}}" data-index ='{{$Sno}}' class="tboxsmclass decimalnum accpercvalue" style="width:100%; text-align:right"  value="{{ $MatValue->acc_payment_perc ? $MatValue->acc_payment_perc : '' }}" ></td>
																			    <td align="right"><input type="text" name="txt_acc_item_payment_amt[]" id="txt_acc_item_payment_amt_{{$Sno}}" data-index ='{{$Sno}}' class="tboxsmclass accpayamount" style="width:100%; text-align:right" readonly value="{{ $MatValue->acc_total_payment_amt ? $MatValue->acc_total_payment_amt : '' }}" ></td>
                                                                            @else
                                                                            	<td align="right">{{ $MatValue->acc_payment_perc ? $MatValue->acc_payment_perc : '' }}</td>
																			    <td align="right">{{ $MatValue->acc_total_payment_amt ? $MatValue->acc_total_payment_amt : '' }}</td>
                                                                            @endif
																			<input type="hidden" name="cmb_location[]" id="cmb_location_{{$Sno}}" data-index ='{{$Sno}}'   value="{{ $MatValue->location_id ? $MatValue->location_id : '' }}" ></td>
                                                                            <td>
                                                                                @php $found = false; @endphp
                                                                                @if(isset($data['ShowLoacationMasterData']))
                                                                                    @foreach($data['ShowLoacationMasterData'] as $LocationData)
                                                                                        @if($LocationData->location_id == $MatValue->location_id)
                                                                                            {{ $LocationData->location_name }} / {{ $LocationData->location_sname }}
                                                                                            @php $found = true; @endphp
                                                                                            @break 
                                                                                        @endif
                                                                                    @endforeach
                                                                                @endif
                                                                                @if(!$found)
                                                                                    Nil
                                                                                @endif
                                                                            </td>
																			<input type="hidden" name="check_certified[]" id="check_certified_{{$Sno}}" data-index ='{{$Sno}}'   value="{{ $MatValue->qty_certified ? $MatValue->qty_certified : '' }}" ></td>
																			<td align="center">{{$MatValue->qty_certified}}</td>
																			<input type="hidden" name="item_remarks[]" id="item_remarks_{{$Sno}}" data-index ='{{$Sno}}'   value="{{ $MatValue->item_remarks ? $MatValue->item_remarks : '' }}" ></td>
																			<td align="center">{{$MatValue->item_remarks}}</td>
                                                                             @if($IsPaymentEdit == 'Y')
                                                                            	<td align="center"><input type="text" name="txt_acc_remarks[]" id="txt_acc_remarks_{{$Sno}}" data-index ='{{$Sno}}' class="tboxsmclass accremarks" style="width:100%;"  value="{{ $MatValue->acc_remarks ? $MatValue->acc_remarks : '' }}" ></td>
                                                                            @else
                                                                            	<td align="center">{{ $MatValue->acc_remarks ? $MatValue->acc_remarks : '' }}</td>
                                                                            @endif
																		@php $Sno  ++; $TotPayAmout +=$MatValue->acc_total_payment_amt;@endphp
																	@endforeach
																	<tr>
																		<td colspan="12" align="right">Total Payment Amount</td>
																		<td align="right" id ="total_pay_amount" name ="total_pay_amount">{{$TotPayAmout}}</td>
																		<td colspan="5" align="right"></td>
																	</tr>
																@else
																	<tr>
																		<td align="center" colspan="14">No records found</td>
																	</tr>
																@endif
															</tbody>
														</table>
													</div>
                                            	</div>
                                            @else
												<div class="table-container">
													<div class="table-wrapper">
														<div class="section-header"><span>Item Details of Required Items </span></div>
														<table class="formtable"  width="100%">
															<thead>
																<tr>
                                                                    <th width="3%">S.No.</th>
                                                                    <th width="18%" style="text-align: center;">Item Description</th>
                                                                    <th width="5%">Unit</th>
                                                                    <th width="6%">Po Qty</th>
                                                                    <th width="7%">Previous<br>Received<br>Qty</th>
                                                                    <th width="7%">Received<br>Now<br>Qty</th>
                                                                    <th width="7%">Balance<br>Qty</th>
                                                                    <th width="6%">Po Rate<br>(Rs.)</th>
                                                                    <th width="8%">Total Cost<br>(Rs.)</th>
                                                                    <th width="5%">Payment<br>(%)</th>
                                                                    <th width="8%">Total Payment<br>Amount</th>
                                                                    <th width="8%">Location</th>
                                                                    <th width="6%">Whether<br>Certified</th>
                                                                    <th width="6%">Remarks</th>
                                                                </tr>
															</thead>
															<tbody >
																@if(isset($data['MaterialInwardDetailData']))
																	@php $Sno = 1; $TotPayAmout = 0;@endphp
																	@foreach($data['MaterialInwardDetailData'] as $MatValue)
																		<tr>
																			<td align="center" >{{$MatValue->item_no}}</td>
																			<td>{{$MatValue->item_description}}</td>
                                                                            <td align="center">
																				@foreach($data['ShowMaterialUnit'] as $MaterialUnitData)
																					@if($MaterialUnitData->uom_id == $MatValue->item_unit)
																						{{$MaterialUnitData->uom_name}}
																					@endif
																				@endforeach
																			</td>
																			<td align="center">{{$MatValue->po_quantity}}</td>
																			<td align="center">{{$MatValue->previously_received_qty}}</td>
																			<td align="center">{{$MatValue->received_qty}}</td>
																			<td align="right">{{$MatValue->balance_qty}}</td>
																			<td align="right">{{$MatValue->unit_rate}}</td>
																			<td align="right">{{$MatValue->total_cost}}</td>
																			<td align="right">{{$MatValue->payment_perc}}</td>
																			<td align="right">{{$MatValue->total_payment_amout}}</td>
                                                                            <td>
                                                                                @php $found = false; @endphp
                                                                                @if(isset($data['ShowLoacationMasterData']))
                                                                                    @foreach($data['ShowLoacationMasterData'] as $LocationData)
                                                                                        @if($LocationData->location_id == $MatValue->location_id)
                                                                                            {{ $LocationData->location_name }} / {{ $LocationData->location_sname }}
                                                                                            @php $found = true; @endphp
                                                                                            @break 
                                                                                        @endif
                                                                                    @endforeach
                                                                                @endif
                                                                                @if(!$found)
                                                                                    Nil
                                                                                @endif
                                                                            </td>
																			<td align="center">{{$MatValue->qty_certified}}</td>
																			<td align="right">{{$MatValue->item_remarks}}</td>
																		@php $Sno  ++; $TotPayAmout +=$MatValue->total_payment_amout;@endphp
																	@endforeach
																	<tr>
																		<td colspan="10" align="right">Total Payment Amount</td>
																		<td align="right" id ="total_pay_amount" name ="total_pay_amount">{{$TotPayAmout}}</td>
																		<td colspan="3" align="right"></td>
																	</tr>
																@else
																	<tr>
																		<td align="center" colspan="14">No records found</td>
																	</tr>
																@endif
															</tbody>
														</table>
													</div>
                                            	</div>
                                            @endif    
                                            <fieldset class="fieldbox">
                                                <legend class="fieldbox-legend"> Remarks </legend>
                                                <div class="fieldbox-div">
                                                    <tr>
                                                    <td colspan="9">
                                                        <div class="label">Enter Your  Remarks Here</div>
                                                        <textarea name="txt_action_remarks" id="txt_action_remarks" class="tboxsmclass" rows="4"></textarea>
                                                    </td>
                                                </tr>
                                                </div>
                                            </fieldset>                                                           											
											<div class="row smclearrow"></div>
                                              <div class="row">
                                                <div class="div12" align="center">
                                                    <input type="hidden" name="hid_current_status" id="hid_current_status" value="@if(isset($CurrStatus)){{$CurrStatus}}@endif" />
                                                    <input type="hidden" name="txt_application_id" id="txt_application_id" value="@if(isset($MatInwardId)){{ encrypt($MatInwardId) }}@endif">
                                                    <input type="hidden" name="txt_action" id="txt_action" value="@if(isset($Action)){{ encrypt($Action) }}@endif">
                                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                                    <input type="hidden" name="wf_module_code" id="wf_module_code" value="{{ encrypt('MAT_INWARD') }}" />
                                                    <input type="hidden" name="txt_wf_mode" id="txt_wf_mode" />
                                                    <input type="hidden" name="txt_actual_emp" id="txt_actual_emp" />
                                                    <input type="hidden" name="txt_wf_remark" id="txt_wf_remark" />
                                                    <input type="hidden" name="txt_wf_emp_no" id="txt_wf_emp_no" />
                                                    <input type="hidden" name="txt_wf_role" id="txt_wf_role" />
                                                    <input type="hidden" name="txt_wf_action" id="txt_wf_action" />
                                                    <input type="hidden" name="txt_role_position" id="txt_role_position" />
                                                </div>		
                                            </div>  
                                            <div>
                                                <?php $AMCCost =0;$BalanceAmout = $AMCCost - $TotPayAmout; ?>
                                                <input type="hidden" name ='hidd_cont_id' value ="{{$ContId ?? ''}}">
                                                <input type="hidden" name = 'hidd_cont_name' value ="{{$VendorName ?? ''}}">
                                                <input type="hidden" name = 'hidd_total_cost' value ="{{$AMCCost ?? ''}}">
                                                <input type="hidden" name ='hidd_total_pay_amout' value ="{{$TotPayAmout ?? ''}}">
                                                <input type="hidden" name ='hidd_balance_amount' value ="{{$BalanceAmout ?? ''}}">
                                                <input type="hidden" name="hidden_mat_id" id="hidden_mat_id" value="@if(isset($MatInwardId)){{ encrypt($MatInwardId) }}@endif">
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="row smclearrow"></div>
                                    <div class="row smclearrow"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </blockquote>
            </div>
        </div>
    </div>
</form>

<style>
    .chosen-drop { width: 500px !important; }
    #eligibilityWarning ul { margin: 4px 0 0 16px; padding: 0; }
    .pill-header-btn {
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 20px;
        padding: 5px 14px;
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
        white-space: nowrap;
    }

    
    .pg-sd-section-block {
    border: 1px solid #c5d4ee;
    border-radius: 6px;
    overflow: hidden;
    margin-bottom: 16px;
    }
    .pg-sd-section-title {
        background: #1a3a8f;
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        padding: 8px 14px;
    }
    .pg-sd-scroll-wrap {
        overflow-x: auto;
    }
    .pg-sd-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
    }
    .pg-sd-table thead tr {
        background: #dce6f8;
    }
    .pg-sd-table th {
        color: #1a3a8f;
        font-weight: 600;
        padding: 8px 10px;
        text-align: center;
        border: 1px solid #b8c9e8;
        white-space: nowrap;
        font-size: 11.5px;
    }
    .pg-sd-table td {
        padding: 7px 10px;
        text-align: center;
        border: 1px solid #dce3ef;
        color: #333;
    }
   
    .pg-sd-summary-row {
        display: flex;
        gap: 10px;
        margin-bottom: 16px;
        flex-wrap: wrap;
    }
    .pg-sd-summary-card {
        flex: 1;
        min-width: 120px;
        background: #f0f4ff;
        border: 1px solid #c5d4ee;
        border-radius: 6px;
        padding: 10px 14px;
    }
    .pg-sd-summary-card .s-label {
        font-size: 11px;
        color: #5a6a8a;
        margin-bottom: 4px;
    }
    .pg-sd-summary-card .s-value {
        font-size: 16px;
        font-weight: 600;
        color: #1a3a8f;
    }
    .pg-sd-no-record {
        text-align: center;
        color: #888;
        font-style: italic;
        padding: 14px;
        font-size: 12px;
    }
    .status-badge-active {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 500;
        background: #e6f4ea;
        color: #2d6a35;
    }
    .status-badge-pending {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 500;
        background: #fff4e0;
        color: #8a5700;
    }
    .pg-sd-scroll-wrap {
    overflow-x: visible; /* changed from auto to visible */
    width: 100%;
    }
    .pg-sd-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 11px; /* slightly smaller to fit all columns */
        table-layout: fixed; /* forces columns to share space equally */
    }
    .pg-sd-table th {
        color: #1a3a8f;
        font-weight: 600;
        padding: 6px 4px; /* reduced padding */
        text-align: center;
        border: 1px solid #b8c9e8;
        white-space: normal; /* allow text wrap in headers */
        font-size: 11px;
        word-break: break-word;
    }
    .pg-sd-table td {
        padding: 6px 4px; /* reduced padding */
        text-align: center;
        border: 1px solid #dce3ef;
        color: #333;
        font-size: 11px;
        word-break: break-word;
    }
    .pg-sd-dialog .modal-dialog {
    width: 96% !important;
    max-width: 1300px !important;
    margin: 15px auto !important;
    }

    .boot-formtable {
        border-radius: 8px !important;
        border-collapse: separate !important;
        border-spacing: 0 !important;
        overflow: hidden !important;
    }

    .boot-formtable tr:first-child th:first-child {
        border-radius: 8px 0 0 0 !important;
    }

    .boot-formtable tr:first-child th:last-child {
        border-radius: 0 8px 0 0 !important;
    }

    .boot-formtable tr:last-child td:first-child {
        border-radius: 0 0 0 8px !important;
    }

    .boot-formtable tr:last-child td:last-child {
        border-radius: 0 0 8px 0 !important;
    }
</style>
<script>
    $(document).ready(function(){
        $(".decimalnum").on("input", function () {
            let value = this.value.replace(/[^0-9]/g, ''); // allow only digits
            if (value !== '') {
                value = parseInt(value, 10);
                if (value > 100) value = 100;
                if (value < 1) value = '';
            }
            this.value = value;
        });
        $('body').on('keyup', '.accpercvalue', function(event) {
            var Index         = $(this).data('index');
            var TotalCost     = Number($('#txt_total_cost_'+ Index).val()) || 0;
            var PayPerc       = Number($('#txt_acc_item_pay_perc_'+ Index).val()) || 0;
            var PayAmount     = (TotalCost * PayPerc) / 100;
            $("#txt_acc_item_payment_amt_" + Index).val(PayAmount);
            CalPayTotalAmout();
        });
        function CalPayTotalAmout(){
            var PayTotal = 0;
            $('.accpayamount').each(function() {
                PayTotal += Number($(this).val()) || 0;
            });
            $('#total_pay_amount').text(PayTotal.toFixed(2)); 
        }
        $(document).on("click", ".btn_sup_doc_download", function(event) {
            var SuppDocId     = $(this).attr("data-fileid");
            var ModuleCode    = 'INDENT';
            var ModuleSubCode = 'SUPDOC';
            DownloadFile(SuppDocId,ModuleCode,ModuleSubCode);
        });
        $(document).on("click", "#btn_download", function(event) {
            var SuppDocId     = $(this).attr("data-fileid");
            var ModuleCode    = 'MAT_INWARD';
            var ModuleSubCode = 'INVOICE';
            DownloadFile(SuppDocId,ModuleCode,ModuleSubCode);
        });
        $(document).on("click", "#btn_recpt_download", function(event) {
            var SuppDocId     = $(this).attr("data-fileid");
            var ModuleCode    = 'MAT_INWARD';
            var ModuleSubCode = 'DEL_CHALLAN';
            DownloadFile(SuppDocId,ModuleCode,ModuleSubCode);
        });
        function DownloadFile(SuppDocId,ModuleCode,ModuleSubCode) {
            window.open("{{ route('indent.sanction-document-download') }}?id=" + SuppDocId + "&module_code=" + ModuleCode + "&module_sub_code=" + ModuleSubCode, "_blank");
        }
        
        $("body").on("click","#btn_supp_doc", function(event){
            var IndentId = $(this).attr('data-id'); 
            $.ajax({
                type: 'POST',
                url: "{{ route('indent.sanction-SupportingDoc') }}",
                data: {'_token': '{{ csrf_token() }}','IndentId': IndentId},
                success: function(data) {
                    if (data != null) { console.log(data);
                        var SancDocArr = data['SANCDOCDETAILS'];
                        var Sno = 1;
                        var SupportingDataStr = '';
                        SupportingDataStr += '<table class="formtable boot-formtable" width="100%">';
                        SupportingDataStr += '<tr>';
                        SupportingDataStr += '<th class="lboxlabel">S.No.</th>';
                        SupportingDataStr += '<th class="lboxlabel">Document Description</th>';
                        SupportingDataStr += '<th class="lboxlabel">Download</th>';
                        SupportingDataStr += '</tr>';
                        if(SancDocArr.length > 0){
                            SancDocArr.forEach(function(item) {
                                SupportingDataStr += '<tr>' +
                                    '<td class="lboxlabel" style="text-align:center;">'+Sno+'</td>' +
                                    '<td class="lboxlabel">'+item.doc_desc+'</td>' +
                                    '<td class="lboxlabel" style="text-align:center;">' +
                                        '<button type="button" ' +'data-fileid="'+item.enc_sup_doc_id+'" ' +
                                        'class="btn btn-default tuploadbtn btn_sup_doc_download" ' +
                                        'title="Click here to Download the File" ' +
                                        'style="cursor:pointer;">' +
                                        '<i class="fa fa-download"></i> Download File' +
                                        '</button>' +
                                    '</td>' +
                                '</tr>';
                                Sno++;
                            });
                        }else{
                            SupportingDataStr += '<tr>' +
                                '<td colspan="3" class="lboxlabel" style="text-align:center;">No Records Found</td>' +
                            '</tr>';
                        }
                        SupportingDataStr += '</table>';
                        BootstrapDialog.show({
                            title: 'Indent Sanction Supporting Documents',
                            message: SupportingDataStr,
                            buttons: [{
                                label: 'OK',
                                action: function(dialog) {
                                    dialog.close();
                                }
                            }]
                        });
                    }
                }
            });
        });
        // $("body").on("click", "#btn_Pg_Fd", function (event) {
        //     var PoId = $(this).attr('data-id');
        //     $.ajax({
        //         type: 'POST',
        //         url: "{{ route('sdpo.po-sd-pg') }}",
        //         data: { '_token': '{{ csrf_token() }}', 'POId': PoId },
        //         success: function (data) {
        //             if (data != null) {
        //                 var PgSdDataArr = data['PGSDVALUES'];

        //                 // --- Count & Summary Values ---
        //                 var pgCount = 0, sdCount = 0;
        //                 var sdTotalAmount = 0, sdMode = '-';
        //                 PgSdDataArr.forEach(function (item) {
        //                     if (item.sd_po == 'PG') pgCount++;
        //                     if (item.sd_po == 'SD') {
        //                         sdCount++;
        //                         sdTotalAmount += parseFloat(item.sd_po_amount || 0);
        //                         sdMode = item.sd_po_mode || '-';
        //                     }
        //                 });
        //                 var summaryHtml = '';
        //                 // --- Summary Cards ---
        //                 // var summaryHtml = '<div class="pg-sd-summary-row">';
        //                 // summaryHtml += '<div class="pg-sd-summary-card"><div class="s-label">PG Records</div><div class="s-value" style="color:#c0392b;">' + pgCount + '</div></div>';
        //                 // summaryHtml += '<div class="pg-sd-summary-card"><div class="s-label">SD Records</div><div class="s-value" style="color:#1a7a4a;">' + sdCount + '</div></div>';
        //                 // summaryHtml += '<div class="pg-sd-summary-card"><div class="s-label">SD Amount</div><div class="s-value">&#8377;' + sdTotalAmount.toLocaleString('en-IN') + '</div></div>';
        //                 // summaryHtml += '<div class="pg-sd-summary-card"><div class="s-label">SD Received Mode</div><div class="s-value" style="font-size:13px;">' + sdMode + '</div></div>';
        //                 // summaryHtml += '</div>';

        //                 // --- PG Table ---
        //                 var PbgDataStr = '<div class="pg-sd-section-block">';
        //                 PbgDataStr += '<div class="pg-sd-section-title">Performance Guarantee (PG)</div>';
        //                 PbgDataStr += '<div class="pg-sd-scroll-wrap"><table class="pg-sd-table">';
        //                 PbgDataStr += '<thead><tr>';
        //                 PbgDataStr += '<th>S.No.</th><th>PG %</th><th>PG Amount</th><th>PG Received Date</th>';
        //                 PbgDataStr += '<th>PG Received Mode</th><th>Instrument Date</th><th>Instrument No.</th>';
        //                 PbgDataStr += '<th>Instrument Amount</th><th>Instrument Bank</th><th>Instrument Valid Date</th><th>Status</th>';
        //                 PbgDataStr += '</tr></thead><tbody>';

        //                 var PgSno = 1;
        //                 PgSdDataArr.forEach(function (item) {
        //                     if (item.sd_po == 'PG') {
        //                         var ReceivedDate = new Date(item.sdpo_received_date).toLocaleDateString('en-GB');
        //                         PbgDataStr += '<tr>';
        //                         PbgDataStr += '<td>' + PgSno + '</td>';
        //                         PbgDataStr += '<td>' + (item.sd_po_percentage || '-') + '</td>';
        //                         PbgDataStr += '<td>' + (item.sd_po_amount || '-') + '</td>';
        //                         PbgDataStr += '<td>' + (ReceivedDate || '-') + '</td>';
        //                         PbgDataStr += '<td>' + (item.sd_po_mode || '-') + '</td>';
        //                         PbgDataStr += '<td>' + (item.instrument_date || '-') + '</td>';
        //                         PbgDataStr += '<td>' + (item.instrument_no || '-') + '</td>';
        //                         PbgDataStr += '<td>' + (item.instrument_amount || '-') + '</td>';
        //                         PbgDataStr += '<td>' + (item.instrument_bank || '-') + '</td>';
        //                         PbgDataStr += '<td>' + (item.instrument_validity || '-') + '</td>';
        //                         PbgDataStr += '<td><span class="status-badge-active">Active</span></td>';
        //                         PbgDataStr += '</tr>';
        //                         PgSno++;
        //                     }
        //                 });

        //                 if (PgSno == 1) {
        //                     PbgDataStr += '<tr><td colspan="11" class="pg-sd-no-record">No Records Found</td></tr>';
        //                 }
        //                 PbgDataStr += '</tbody></table></div></div>';

        //                 // --- SD Table ---
        //                 var SDDataStr = '<div class="pg-sd-section-block">';
        //                 SDDataStr += '<div class="pg-sd-section-title"> Security Deposit (SD)</div>';
        //                 SDDataStr += '<div class="pg-sd-scroll-wrap"><table class="pg-sd-table">';
        //                 SDDataStr += '<thead><tr>';
        //                 SDDataStr += '<th>S.No.</th><th>SD %</th><th>SD Amount</th><th>SD Received Date</th>';
        //                 SDDataStr += '<th>SD Received Mode</th><th>Date</th><th>BG No.</th>';
        //                 SDDataStr += '<th>BG Amount</th><th>BG Bank</th><th>BG Valid Date</th><th>Status</th>';
        //                 SDDataStr += '</tr></thead><tbody>';

        //                 var SdSno = 1;
        //                 PgSdDataArr.forEach(function (item) {
        //                     if (item.sd_po == 'SD') {
        //                         var SdReceivedDate = new Date(item.sdpo_received_date).toLocaleDateString('en-GB');
        //                         SDDataStr += '<tr>';
        //                         SDDataStr += '<td>' + SdSno + '</td>';
        //                         SDDataStr += '<td>' + (item.sd_po_percentage || '-') + '</td>';
        //                         SDDataStr += '<td>' + (item.sd_po_amount || '-') + '</td>';
        //                         SDDataStr += '<td>' + (SdReceivedDate || '-') + '</td>';
        //                         SDDataStr += '<td>' + (item.sd_po_mode || '-') + '</td>';
        //                         SDDataStr += '<td>' + (item.instrument_date || '-') + '</td>';
        //                         SDDataStr += '<td>' + (item.instrument_no || '-') + '</td>';
        //                         SDDataStr += '<td>' + (item.instrument_amount || '-') + '</td>';
        //                         SDDataStr += '<td>' + (item.instrument_bank || '-') + '</td>';
        //                         SDDataStr += '<td>' + (item.instrument_validity || '-') + '</td>';
        //                         // SDDataStr += '<td><span class="status-badge-active">Active</span></td>';
        //                         SDDataStr += '<td></td>';
        //                         SDDataStr += '</tr>';
        //                         SdSno++;
        //                     }
        //                 });

        //                 if (SdSno == 1) {
        //                     SDDataStr += '<tr><td colspan="11" class="pg-sd-no-record">No Records Found</td></tr>';
        //                 }
        //                 SDDataStr += '</tbody></table></div></div>';

        //                 // --- Show Dialog ---
        //                 BootstrapDialog.show({
        //                     title: ' PG / SD Details',
        //                     message: summaryHtml + PbgDataStr + SDDataStr,
        //                     // size: BootstrapDialog.SIZE_WIDE,
        //                     buttons: [{
        //                         label: 'OK',
        //                         // cssClass: 'btn btn-primary',
        //                         action: function (dialog) {
        //                             dialog.close();
        //                         }
        //                     }]
        //                 });
        //             }
        //         }
        //     });
        // });
        $("body").on("click", "#btn_Pg_Fd", function (event) {
            var PoId = $(this).attr('data-id');
            $.ajax({
                type: 'POST',
                url: "{{ route('sdpo.po-sd-pg') }}",
                data: { '_token': '{{ csrf_token() }}', 'POId': PoId },
                success: function (data) {
                    if (data != null) {
                        var PgSdDataArr = data['PGSDVALUES'];

                        // --- Summary Count ---
                        var pgCount = 0, sdCount = 0, sdTotalAmount = 0, sdMode = '-';
                        PgSdDataArr.forEach(function (item) {
                            if (item.sd_po == 'PG') pgCount++;
                            if (item.sd_po == 'SD') {
                                sdCount++;
                                sdTotalAmount += parseFloat(item.sd_po_amount || 0);
                                sdMode = item.sd_po_mode || '-';
                            }
                        });

                        // --- Summary Row using formtable ---
                        var summaryHtml = '';
                        // summaryHtml += '<table class="formtable boot-formtable" width="100%" style="margin-bottom:12px;">';
                        // summaryHtml += '<tr>';
                        // summaryHtml += '<th class="lboxlabel" style="text-align:center;background:#1a3a8f;color:#fff;">PG Records</th>';
                        // summaryHtml += '<th class="lboxlabel" style="text-align:center;background:#1a3a8f;color:#fff;">SD Records</th>';
                        // summaryHtml += '<th class="lboxlabel" style="text-align:center;background:#1a3a8f;color:#fff;">SD Total Amount</th>';
                        // summaryHtml += '<th class="lboxlabel" style="text-align:center;background:#1a3a8f;color:#fff;">SD Received Mode</th>';
                        // summaryHtml += '</tr>';
                        // summaryHtml += '<tr>';
                        // summaryHtml += '<td class="lboxlabel" style="text-align:center;font-size:16px;font-weight:600;color:#c0392b;">' + pgCount + '</td>';
                        // summaryHtml += '<td class="lboxlabel" style="text-align:center;font-size:16px;font-weight:600;color:#1a7a4a;">' + sdCount + '</td>';
                        // summaryHtml += '<td class="lboxlabel" style="text-align:center;font-size:16px;font-weight:600;color:#1a3a8f;">&#8377;' + sdTotalAmount.toLocaleString('en-IN') + '</td>';
                        // summaryHtml += '<td class="lboxlabel" style="text-align:center;font-size:16px;font-weight:600;color:#1a3a8f;">' + sdMode + '</td>';
                        // summaryHtml += '</tr>';
                        // summaryHtml += '</table>';

                        // --- PG Table ---
                        var PgSno = 1;
                        var PbgDataStr = '';
                        PbgDataStr += '<table class="formtable boot-formtable" width="100%" style="margin-bottom:12px;table-layout:fixed;">';
                        PbgDataStr += '<tr><th colspan="11" class="lboxlabel" style="text-align:center;background:#1a3a8f;color:#fff;padding:8px;">Performance Guarantee (PG)</th></tr>';
                        PbgDataStr += '<tr>';
                        PbgDataStr += '<th class="lboxlabel" style="text-align:center;width:4%;">S.No.</th>';
                        PbgDataStr += '<th class="lboxlabel" style="text-align:center;width:7%;">PG %</th>';
                        PbgDataStr += '<th class="lboxlabel" style="text-align:center;width:9%;">PG Amount</th>';
                        PbgDataStr += '<th class="lboxlabel" style="text-align:center;width:10%;">PG Received Date</th>';
                        PbgDataStr += '<th class="lboxlabel" style="text-align:center;width:10%;">PG Received Mode</th>';
                        PbgDataStr += '<th class="lboxlabel" style="text-align:center;width:10%;">Instrument Date</th>';
                        PbgDataStr += '<th class="lboxlabel" style="text-align:center;width:10%;">Instrument No.</th>';
                        PbgDataStr += '<th class="lboxlabel" style="text-align:center;width:10%;">Instrument Amount</th>';
                        PbgDataStr += '<th class="lboxlabel" style="text-align:center;width:10%;">Instrument Bank</th>';
                        PbgDataStr += '<th class="lboxlabel" style="text-align:center;width:12%;">Instrument Valid Date</th>';
                        PbgDataStr += '<th class="lboxlabel" style="text-align:center;width:8%;">Status</th>';
                        PbgDataStr += '</tr>';

                        if (PgSdDataArr.length > 0) {
                            PgSdDataArr.forEach(function (item) {
                                if (item.sd_po == 'PG') {
                                    if(item.sdpo_received_date){
                                        let parts = item.sdpo_received_date.split('-');
                                        ReceivedDate = `${parts[2]}-${parts[1]}-${parts[0]}`;
                                    }
                                    if(item.instrument_date){
                                        let parts = item.instrument_date.split('-');
                                        InstrumentDate = `${parts[2]}-${parts[1]}-${parts[0]}`;
                                    }
                                    if(item.instrument_validity){
                                        let parts = item.instrument_validity.split('-');
                                        InstrumentDateValidDate = `${parts[2]}-${parts[1]}-${parts[0]}`;
                                    }
                                    PbgDataStr += '<tr>';
                                    PbgDataStr += '<td class="lboxlabel" style="text-align:center;">' + PgSno + '</td>';
                                    PbgDataStr += '<td class="lboxlabel" style="text-align:center;">' + (item.sd_po_percentage || '-') + '</td>';
                                    PbgDataStr += '<td class="lboxlabel" style="text-align:center;">' + (item.sd_po_amount || '-') + '</td>';
                                    PbgDataStr += '<td class="lboxlabel" style="text-align:center;">' + (ReceivedDate || '-') + '</td>';
                                    PbgDataStr += '<td class="lboxlabel" style="text-align:center;">' + (item.sd_po_mode || '-') + '</td>';
                                    PbgDataStr += '<td class="lboxlabel" style="text-align:center;">' + (InstrumentDate || '-') + '</td>';
                                    PbgDataStr += '<td class="lboxlabel" style="text-align:center;">' + (item.instrument_no || '-') + '</td>';
                                    PbgDataStr += '<td class="lboxlabel" style="text-align:center;">' + (item.instrument_amount || '-') + '</td>';
                                    PbgDataStr += '<td class="lboxlabel" style="text-align:center;">' + (item.instrument_bank || '-') + '</td>';
                                    PbgDataStr += '<td class="lboxlabel" style="text-align:center;">' + (InstrumentDateValidDate || '-') + '</td>';
                                    PbgDataStr += '<td class="lboxlabel" style="text-align:center;">-</td>';
                                    PbgDataStr += '</tr>';
                                    PgSno++;
                                }
                            });
                        }
                        if (PgSno == 1) {
                            PbgDataStr += '<tr><td colspan="11" class="lboxlabel" style="text-align:center;">No Records Found</td></tr>';
                        }
                        PbgDataStr += '</table>';

                        // --- SD Table ---
                        var SdSno = 1;
                        var SDDataStr = '';
                        SDDataStr += '<table class="formtable boot-formtable" width="100%" style="table-layout:fixed;">';
                        SDDataStr += '<tr><th colspan="11" class="lboxlabel" style="text-align:center;background:#1a3a8f;color:#fff;padding:8px;">Security Deposit (SD)</th></tr>';
                        SDDataStr += '<tr>';
                        SDDataStr += '<th class="lboxlabel" style="text-align:center;width:4%;">S.No.</th>';
                        SDDataStr += '<th class="lboxlabel" style="text-align:center;width:7%;">SD %</th>';
                        SDDataStr += '<th class="lboxlabel" style="text-align:center;width:9%;">SD Amount</th>';
                        SDDataStr += '<th class="lboxlabel" style="text-align:center;width:10%;">SD Received Date</th>';
                        SDDataStr += '<th class="lboxlabel" style="text-align:center;width:10%;">SD Received Mode</th>';
                        SDDataStr += '<th class="lboxlabel" style="text-align:center;width:10%;">Date</th>';
                        SDDataStr += '<th class="lboxlabel" style="text-align:center;width:10%;">BG No.</th>';
                        SDDataStr += '<th class="lboxlabel" style="text-align:center;width:10%;">BG Amount</th>';
                        SDDataStr += '<th class="lboxlabel" style="text-align:center;width:10%;">BG Bank</th>';
                        SDDataStr += '<th class="lboxlabel" style="text-align:center;width:12%;">BG Valid Date</th>';
                        SDDataStr += '<th class="lboxlabel" style="text-align:center;width:8%;">Status</th>';
                        SDDataStr += '</tr>';

                        if (PgSdDataArr.length > 0) {
                            PgSdDataArr.forEach(function (item) {
                                if (item.sd_po == 'SD') {
                                    if(item.sdpo_received_date){
                                        let parts = item.sdpo_received_date.split('-');
                                        ReceivedDate = `${parts[2]}-${parts[1]}-${parts[0]}`;
                                    }
                                    if(item.instrument_date){
                                        let parts = item.sdpo_received_date.split('-');
                                        InstrumentDate = `${parts[2]}-${parts[1]}-${parts[0]}`;
                                    }
                                    if(item.instrument_validity){
                                        let parts = item.instrument_validity.split('-');
                                        InstrumentDateValidDate = `${parts[2]}-${parts[1]}-${parts[0]}`;
                                    }
                                    SDDataStr += '<tr>';
                                    SDDataStr += '<td class="lboxlabel" style="text-align:center;">' + SdSno + '</td>';
                                    SDDataStr += '<td class="lboxlabel" style="text-align:center;">' + (item.sd_po_percentage || '-') + '</td>';
                                    SDDataStr += '<td class="lboxlabel" style="text-align:center;">' + (item.sd_po_amount || '-') + '</td>';
                                    SDDataStr += '<td class="lboxlabel" style="text-align:center;">' + (ReceivedDate || '-') + '</td>';
                                    SDDataStr += '<td class="lboxlabel" style="text-align:center;">' + (item.sd_po_mode || '-') + '</td>';
                                    SDDataStr += '<td class="lboxlabel" style="text-align:center;">' + (InstrumentDate || '-') + '</td>';
                                    SDDataStr += '<td class="lboxlabel" style="text-align:center;">' + (item.instrument_no || '-') + '</td>';
                                    SDDataStr += '<td class="lboxlabel" style="text-align:center;">' + (item.instrument_amount || '-') + '</td>';
                                    SDDataStr += '<td class="lboxlabel" style="text-align:center;">' + (item.instrument_bank || '-') + '</td>';
                                    SDDataStr += '<td class="lboxlabel" style="text-align:center;">' + (InstrumentDateValidDate || '-') + '</td>';
                                    SDDataStr += '<td class="lboxlabel" style="text-align:center;"></td>';
                                    // SDDataStr += '<td class="lboxlabel" style="text-align:center;"><span class="status-badge-active">Active</span></td>';
                                    SDDataStr += '</tr>';
                                    SdSno++;
                                }
                            });
                        }
                        if (SdSno == 1) {
                            SDDataStr += '<tr><td colspan="11" class="lboxlabel" style="text-align:center;">No Records Found</td></tr>';
                        }
                        SDDataStr += '</table>';

                        // --- Show Dialog ---
                        BootstrapDialog.show({
                            title: 'PG / SD Details',
                            message: summaryHtml + PbgDataStr + SDDataStr,
                            size: BootstrapDialog.SIZE_LARGE,
                            cssClass: 'pg-sd-dialog',
                            buttons: [{
                                label: 'OK',
                                cssClass: 'btn btn-primary',
                                action: function (dialog) {
                                    dialog.close();
                                }
                            }]
                        });
                    }
                }
            });
        });
        // $("body").on("click","#btn_Pg_Fd", function(event){
        //     var PoId = $(this).attr('data-id'); 
        //     $.ajax({
        //         type: 'POST',
        //         url: "{{ route('sdpo.po-sd-pg') }}",
        //         data: {'_token': '{{ csrf_token() }}','POId': PoId},
        //         success: function(data) {
        //             if (data != null) { console.log(data);
        //                 var PgSdDataArr = data['PGSDVALUES'];
        //                 var PgSno = 1;
        //                 var PbgDataStr = '';
        //                 PbgDataStr += '<table class="formtable" width="100%">';
		// 				PbgDataStr += '<tr><th colspan="11">Performance Guarantee (PG)</th></tr>';
        //                 PbgDataStr += '<tr>';
        //                 PbgDataStr += '<th class="lboxlabel">S.No.</th>';
        //                 PbgDataStr += '<th class="lboxlabel">PG %</th>';
        //                 PbgDataStr += '<th class="lboxlabel">PG Amount</th>';
        //                 PbgDataStr += '<th class="lboxlabel">PG Received Date</th>';
        //                 PbgDataStr += '<th class="lboxlabel">PG Received Mode</th>';
        //                 PbgDataStr += '<th class="lboxlabel">Instrument Date</th>';
        //                 PbgDataStr += '<th class="lboxlabel">Instrument No.</th>';
        //                 PbgDataStr += '<th class="lboxlabel">Instrument Amount</th>';
        //                 PbgDataStr += '<th class="lboxlabel">Instrument Bank</th>';
        //                 PbgDataStr += '<th class="lboxlabel">Instrument Valid Date</th>';
        //                 PbgDataStr += '<th class="lboxlabel">Status</th>';
        //                 PbgDataStr += '</tr>';
        //                 if(PgSdDataArr.length > 0){
        //                     PgSdDataArr.forEach(function(item) {
        //                         if (item.sd_po == 'PG') {
        //                             PbgDataStr += '<tr>';
        //                             PbgDataStr += '<td class="lboxlabel" style="text-align:center;">'+PgSno+'</td>';
        //                             PbgDataStr += '<td class="lboxlabel" style="text-align:center;">'+item.sd_po_percentage+'</td>';
        //                             PbgDataStr += '<td class="lboxlabel" style="text-align:center;">'+item.sd_po_amount+'</td>';
        //                             PbgDataStr += '<td class="lboxlabel" style="text-align:center;">'+item.sdpo_received_date+'</td>';
        //                             PbgDataStr += '<td class="lboxlabel" style="text-align:center;">'+item.sd_po_mode+'</td>';
        //                             PbgDataStr += '<td class="lboxlabel" style="text-align:center;">'+item.instrument_date+'</td>';
        //                             PbgDataStr += '<td class="lboxlabel" style="text-align:center;">'+item.instrument_no+'</td>';
        //                             PbgDataStr += '<td class="lboxlabel" style="text-align:center;">'+item.instrument_amount+'</td>';
        //                             PbgDataStr += '<td class="lboxlabel" style="text-align:center;">'+item.instrument_bank+'</td>';
        //                             PbgDataStr += '<td class="lboxlabel" style="text-align:center;">'+item.instrument_validity+'</td>';
        //                             PbgDataStr += '<td class="lboxlabel" style="text-align:center;"></td>';
        //                             PbgDataStr += '</tr>';
        //                             PgSno++;
        //                         }
        //                     });
        //                 }
        //                 if(PgSno == 1){
        //                     PbgDataStr += '<tr>' +
        //                         '<td colspan="11" class="lboxlabel" style="text-align:center;">No Records Found</td>' +
        //                     '</tr>';
        //                 }
        //                 PbgDataStr += '</table>';
        //                  var SdSno = 1;
        //                 var SDDataStr = '';
        //                 SDDataStr += '<table class="formtable" width="100%">';
		// 				SDDataStr += '<tr><th colspan="11">Security Deposit (SD)</th></tr>';
        //                 SDDataStr += '<tr>';
        //                 SDDataStr += '<th class="lboxlabel">S.No.</th>';
        //                 SDDataStr += '<th class="lboxlabel">SD %</th>';
        //                 SDDataStr += '<th class="lboxlabel">Sd Amount</th>';
        //                 SDDataStr += '<th class="lboxlabel">SD Received Date</th>';
        //                 SDDataStr += '<th class="lboxlabel">SD Received Mode</th>';
        //                 SDDataStr += '<th class="lboxlabel"> Date</th>';
        //                 SDDataStr += '<th class="lboxlabel">BG  No.</th>';
        //                 SDDataStr += '<th class="lboxlabel">BG  Amount</th>';
        //                 SDDataStr += '<th class="lboxlabel">BG  Bank</th>';
        //                 SDDataStr += '<th class="lboxlabel">BG  Valid Date</th>';
        //                 SDDataStr += '<th class="lboxlabel">Status</th>';
        //                 SDDataStr += '</tr>';
        //                 if(PgSdDataArr.length > 0){
        //                     PgSdDataArr.forEach(function(item) {
        //                         if (item.sd_po == 'SD') {
        //                             SDDataStr += '<tr>';
        //                             SDDataStr += '<td class="lboxlabel" style="text-align:center;">'+SdSno+'</td>';
        //                             SDDataStr += '<td class="lboxlabel" style="text-align:center;">'+item.sd_po_percentage+'</td>';
        //                             SDDataStr += '<td class="lboxlabel" style="text-align:center;">'+item.sd_po_amount+'</td>';
        //                             SDDataStr += '<td class="lboxlabel" style="text-align:center;">'+item.sdpo_received_date+'</td>';
        //                             SDDataStr += '<td class="lboxlabel" style="text-align:center;">'+item.sd_po_mode+'</td>';
        //                             SDDataStr += '<td class="lboxlabel" style="text-align:center;">'+item.instrument_date+'</td>';
        //                             SDDataStr += '<td class="lboxlabel" style="text-align:center;">'+item.instrument_no+'</td>';
        //                             SDDataStr += '<td class="lboxlabel" style="text-align:center;">'+item.instrument_amount+'</td>';
        //                             SDDataStr += '<td class="lboxlabel" style="text-align:center;">'+item.instrument_bank+'</td>';
        //                             SDDataStr += '<td class="lboxlabel" style="text-align:center;">'+item.instrument_validity+'</td>';
        //                             SDDataStr += '<td class="lboxlabel" style="text-align:center;"></td>';
        //                             SDDataStr += '</tr>';
        //                             SdSno++;
        //                         }
        //                     });
        //                 }
        //                 if(SdSno == 1){
        //                     SDDataStr += '<tr>' +
        //                         '<td colspan="11" class="lboxlabel" style="text-align:center;">No Records Found</td>' +
        //                     '</tr>';
        //                 }
        //                 SDDataStr += '</table>';
        //                 BootstrapDialog.show({
        //                     title: 'PG / SD Details',
        //                     message: PbgDataStr + '<br><br>' + SDDataStr,
        //                     buttons: [{
        //                         label: 'OK',
        //                         action: function(dialog) {
        //                             dialog.close();
        //                         }
        //                     }]
        //                 });
        //             }
        //         }
        //     });
        // });
    });
</script>
@include('common-workflow.workflow-process')
@endsection
