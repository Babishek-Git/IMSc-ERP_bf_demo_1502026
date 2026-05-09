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
                                        <div class="row divhead" align="center">Material Inward Payment </div>
                                    </div>
                                </div>
                                <div class="row innerdiv">
                                    <div class="row">
                                        @php
											$RouteUrl   = 'material.material-inward-submission';
											$ModuleCode = 'MAT_INWARD';
											$ForwRejApprButtonComponentArr = \Helper::Forward_Reject_Approve_Button(NULL,$WorkFlowActionData,$BackUrl,$MatInwardId,$RouteUrl,$ActionStatus,$ModuleCode);
											$ButtonDetailsHTML = $ForwRejApprButtonComponentArr['HTMLSTR'];
										@endphp
											{!!$ButtonDetailsHTML!!}
                                        <div class="form-step active">
                                            {{-- ── Purchase / Receipt Information Fieldset ── --}}
                                        	<div class="row smclearrow"></div>
												<fieldset class="fieldbox"  >
													<legend class="fieldbox-legend" style ='top-padding : 10%'>Purchase / Receipt Details</legend>
													<div class="fieldbox-div">
                                                        <div class="div2"><div class="lboxlabel ">Purchase order No.</div><input type="text" name="txt_purchase_order_no" id="txt_purchase_order_no" class="tboxsmclass " readonly value="{{ $PoNo ?? $PoNo ?? '' }}" ></div>
                                                        <div class="div1"><div class="lboxlabel ">Purchase order Date</div><input type="text" name="txt_purchase_order_date" id="txt_purchase_order_date" class="tboxsmclass " readonly value="{{ Helper::DisplayDateFormat($PoDate ?? $PoDate ?? '') }}" ></div>
                                                        <!-- <div class="div2"><div class="lboxlabel ">Indent Created By</div><input type="text" name="txt_indent_created_by" id="txt_indent_created_by" class="tboxsmclass " readonly value="" ></div> -->
                                                        <div class="div2"><div class="lboxlabel ">Vendor Name</div><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="{{$VendorName ?? $VendorName ?? ''}}" ></div>
                                                        <div class="div2"><div class="lboxlabel ">Receipt No. / GRN No.</div><input type="text" name="txt_receipt_no" id="txt_receipt_no" class="tboxsmclass" readonly value="{{ $ReceiptNo ?? $NewReceiptNo ?? '' }}"></div>
                                                        <div class="div1"><div class="lboxlabel ">Receipt Date</div><input type="text" name="txt_receipt_date" id="txt_receipt_date" class="tboxsmclass datepicker" value="{{ Helper::DisplayDateFormat($ReceiptDate ?? $ReceiptDate ?? '') }}" ></div>
                                                         <div class="div1"><div class="lboxlabel ">Invoice No.</div><input type="text" name="txt_purchase_order_date" id="txt_purchase_order_date" class="tboxsmclass " readonly value="@php if(isset($InvoiceString)){ echo $InvoiceString; } @endphp" ></div>
                                                        <div class="div1"><div class="lboxlabel ">Invoice Date</div><input type="text" name="txt_purchase_order_date" id="txt_purchase_order_date" class="tboxsmclass " readonly value="@php if(isset($InvoiceDate)){ echo Helper::DisplayDateFormat($InvoiceDate);} @endphp" ></div>
                                                        <div class="row smclearrow"></div>
                                                    </div>
												</fieldset>                                                           											
                                            </div>
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
    });
</script>
@include('common-workflow.workflow-process')
@endsection
