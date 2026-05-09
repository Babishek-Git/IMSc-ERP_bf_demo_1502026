@extends('layouts.dashboard-master')
@section('content')
@include('layouts.partials.messages')
@php
$VendorDataArray            = $data['VendorData'] ?? [];
$AMCTypeDataArray           = $data['AMCTypeDetials'] ?? [];
$AMCProvdedBaseOnArray      = $data['AMCProvdedBaseData'] ?? [];
$DesciplineDataArray        = $data['DesciplineData'] ?? [];
$BillpaymodeDettailsArray   = $data['BillpaymodeDettails'] ?? [];
$LocationDataArray          = $data['LocationDetails'] ?? [];
if(isset($data['ShowAMCMatrialInwardSubmitData'])){
	foreach($data['ShowAMCMatrialInwardSubmitData'] as $AMCMatInwadData){
		$AMCMatInwardId   = $AMCMatInwadData->amc_master_inward_id;
		$AMCPOId          = $AMCMatInwadData->amc_po_id;
		$AMCDiscipName    = $DesciplineDataArray[$AMCMatInwadData->discipline_id];
		$AMCTypeName      = $AMCTypeDataArray[$AMCMatInwadData->amc_type_id];
		$AMCBasesonName   = $AMCProvdedBaseOnArray[$AMCMatInwadData->amc_baseson_id];
		$AMCFileName      = $AMCMatInwadData->amc_file_name;
		$AMCEqupdesc      = $AMCMatInwadData->equip_desc;
		$AMCPOContName    = $VendorDataArray[$AMCMatInwadData->contid];
		$AMCCost          = $AMCMatInwadData->amc_cost;
		$AMCGstPerc       = $AMCMatInwadData->gst_perc;
		$AMCTaxType       = $AMCMatInwadData->cost_tax;
		$AMCLocIds        = json_decode($AMCMatInwadData->location_id, true);
		$AMCPOBillPayMode = $BillpaymodeDettailsArray[$AMCMatInwadData->bill_pay_mode];
		$SelectedLocIds   = array_values(array_filter($AMCLocIds));
        $TaxTypeName      = ($AMCTaxType == 'INC') ? 'Including' : 'Excluding';
        $LocationString   = collect($SelectedLocIds)->map(fn($id) => $LocationDataArray[$id] ?? null)->filter()->implode(', ');
        $ReceiptNo        = $AMCMatInwadData->receiptno;
        $ReceiptDate      = $AMCMatInwadData->receipt_date;
        $InvoiceDate      = $AMCMatInwadData->invoice_date;
        $InvoiceNos       = $AMCMatInwadData->invoice_no;
        $CurrentStatus    = $AMCMatInwadData->status;
        $invoiceArray     = json_decode($InvoiceNos, true);
        $InvoiceString    = is_array($invoiceArray) ? implode(', ', $invoiceArray) : $InvoiceNos;
	}
}
$BackUrl      = 'amc-material-payment.amc-material-inward-payment-submission';
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
                                        <div class="row divhead" align="center">AMC Material Inward Payment </div>
                                    </div>
                                </div>
                                <div class="row innerdiv">
                                    <div class="row">
                                        <div class="row row-fluid line-control-menu-bar formtitlebar" style="border:none">
                                            <div class="btn-group floatr">
                                                <input type="button" class="backbutton" name="back" id="back" value=" Back " onClick="window.location='{{route($BackUrl)}}'" />
                                            </div>
                                            <div class="btn-group floatr">
		                                        <button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Update">Update</button>	
                                            </div>
                                        </div>  
                                        <div class="form-step active">
                                            {{-- ── Purchase / Receipt Information Fieldset ── --}}
                                        	<div class="row smclearrow"></div>
												<fieldset class="fieldbox"  >
													<legend class="fieldbox-legend" style ='top-padding : 10%'>AMC - Purchase / Receipt Details</legend>
													<div class="fieldbox-div">
                                                        <div class="div2"><div class="lboxlabel ">Discipline</div><input type="text" name="txt_purchase_order_no" id="txt_purchase_order_no" class="tboxsmclass " readonly value="{{ $AMCDiscipName ??  '' }}" ></div>
                                                        <div class="div2"><div class="lboxlabel ">AMC Type</div><input type="text" name="txt_purchase_order_no" id="txt_purchase_order_no" class="tboxsmclass " readonly value="{{ $AMCTypeName ??  '' }}" ></div>
                                                        <div class="div1"><div class="lboxlabel ">AMC Bases On</div><input type="text" name="txt_purchase_order_date" id="txt_purchase_order_date" class="tboxsmclass " readonly value="{{ $AMCBasesonName ?? ''}}" ></div>
                                                        <div class="div2"><div class="lboxlabel ">AMC File Name</div><input type="text" name="txt_indent_created_by" id="txt_indent_created_by" class="tboxsmclass " readonly value="{{$AMCFileName ?? ''}}" ></div>
                                                        <div class="div2"><div class="lboxlabel ">Description of Equipment</div><input type="text" name="txt_indent_created_by" id="txt_indent_created_by" class="tboxsmclass " readonly value="{{$AMCDiscipName ?? ''}}" ></div>
                                                        <div class="div2"><div class="lboxlabel ">Vendor Name</div><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="{{$AMCPOContName ??  ''}}" ></div>
                                                        <div class="div2"><div class="lboxlabel ">AMC Cost</div><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="{{$AMCCost ?? ''}}" ></div>
                                                        <div class="div2"><div class="lboxlabel ">GST %</div><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="{{$AMCGstPerc ??  ''}}" ></div>
                                                        <div class="div2"><div class="lboxlabel ">Tax On Cost</div><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="{{$TaxTypeName ?? ''}}" ></div>
                                                        <div class="div2"><div class="lboxlabel ">Location</div><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="{{$LocationString ?? ''}}" ></div>
                                                        <div class="div2"><div class="lboxlabel ">Payment Mode</div><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="{{$AMCPOBillPayMode ??  ''}}" ></div>
                                                        <div class="row smclearrow"></div>
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
                                                                    <th width="8%">Total Payment<br>Amount <br>(Rs.)</th>
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
                                                                            <input type="hidden" name ='txt_item_no[]' id="txt_item_no_{{$Sno}}" data-index ='{{$Sno}}' value ='{{$MatValue->item_no}}'>
																			<td>{{$MatValue->item_description}}</td>
                                                                            <input type="hidden" name ='txt_item_desc[]' id="txt_item_desc_{{$Sno}}" data-index ='{{$Sno}}' value ='{{$MatValue->item_description}}'>
                                                                            <td align="center">
																				@foreach($data['ShowMaterialUnit'] as $MaterialUnitData)
																					@if($MaterialUnitData->uom_id == $MatValue->item_unit)
																						{{$MaterialUnitData->uom_name}}
																					@endif
																				@endforeach
																			</td>
                                                                            <input type="hidden" name ='txt_unit[]' id="txt_unit_{{$Sno}}" data-index ='{{$Sno}}' value ='{{$MatValue->item_unit}}'>
																			<td align="center">{{$MatValue->po_quantity}}</td>
                                                                            <input type="hidden" name ='txt_po_qty[]' id="txt_po_qty_{{$Sno}}" data-index ='{{$Sno}}' value ='{{$MatValue->po_quantity}}'>
																			<td align="center">{{$MatValue->previously_received_qty}}</td>
                                                                            <input type="hidden" name ='txt_prev_recd_qty[]' id="txt_prev_recd_qty_{{$Sno}}" data-index ='{{$Sno}}' value ='{{$MatValue->previously_received_qty}}'>
																			<td align="center">{{$MatValue->received_qty}}</td>
                                                                            <input type="hidden" name ='txt_recd_now_qty[]' id="txt_recd_now_qty_{{$Sno}}" data-index ='{{$Sno}}' value ='{{$MatValue->received_qty}}'>
																			<td align="right">{{$MatValue->balance_qty}}</td>
                                                                            <input type="hidden" name ='txt_balan_qty[]' id="txt_balan_qty_{{$Sno}}" data-index ='{{$Sno}}' value ='{{$MatValue->balance_qty}}'>
																			<td align="right">{{$MatValue->unit_rate}}</td>
                                                                            <input type="hidden" name ='txt_rate_per_unit[]' id="txt_rate_per_unit_{{$Sno}}" data-index ='{{$Sno}}' value ='{{$MatValue->unit_rate}}'>
																			<td align="right">{{$MatValue->total_cost}}</td>
                                                                            <input type="hidden" name ='txt_total_cost[]' id="txt_total_cost_{{$Sno}}" data-index ='{{$Sno}}' value ='{{$MatValue->total_cost}}'>
																			<td><input type="text" name="txt_item_pay_perc[]" id="txt_item_pay_perc_{{$Sno}}" data-index ='{{$Sno}}' class="tboxsmclass decimalnum percvalue" style="width:100%; text-align:right"  value="{{ $MatValue->payment_perc ? $MatValue->payment_perc : '' }}" ></td>
																			<td><input type="text" name="txt_item_payment_amt[]" id="txt_item_payment_amt_{{$Sno}}" data-index ='{{$Sno}}' class="tboxsmclass payamount" style="width:100%; text-align:right" readonly value="{{ $MatValue->total_payment_amout ? $MatValue->total_payment_amout : '' }}" ></td>
																			<td>
                                                                                <select style="width:100%" name="cmb_location[]" id="cmb_location" class="tboxsmclass ChosenInput" >
                                                                                    <option value="0"> ----Nil ---</option>
                                                                                    @if(isset($data['ShowLoacationMasterData']))
                                                                                        @foreach($data['ShowLoacationMasterData'] as $LocationData)
                                                                                            <option value="{{ $LocationData->location_id }}"
                                                                                                {{ $LocationData->location_id == $MatValue->location_id ? 'selected' : '' }}>
                                                                                                {{ $LocationData->location_name }} / {{ $LocationData->location_sname }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </select>
                                                                            </td> 
																			<td align="center">{{$MatValue->qty_certified}}</td>
                                                                            <input type="hidden" name ='check_certified[]' id="check_certified_{{$Sno}}" data-index ='{{$Sno}}' value ='{{$MatValue->qty_certified}}'>
                                                                            <input type="hidden" name ='txt_remarks[]' id="txt_remarks_{{$Sno}}" data-index ='{{$Sno}}' value ="{{$MatValue->item_remarks}}">																			
																			<td align="right">{{$MatValue->item_remarks}}</td>
																		@php $Sno  ++; $TotPayAmout +=$MatValue->total_payment_amout; @endphp
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
											<div class="row smclearrow"></div>
                                              <div class="row">
                                                <div class="div12" align="center">
					                                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                                    <input type="hidden" name="hid_current_status" id="hid_current_status" value="@if(isset($CurrStatus)){{$CurrStatus}}@endif" />
                                                    <input type="hidden" name="hidden_amc_mat_id" id="hidden_amc_mat_id" value="@if(isset($AMCMatInwardId)){{ encrypt($AMCMatInwardId) }}@endif">
                                                </div>		
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
<!-- @include('common-workflow.workflow-process') -->
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
        $('body').on('keyup', '.percvalue', function(event) {
            var Index         = $(this).data('index');
            var TotalCost     = Number($('#txt_total_cost_'+ Index).val()) || 0;
            var PayPerc       = Number($('#txt_item_pay_perc_'+ Index).val()) || 0;
            var PayAmount     = (TotalCost * PayPerc) / 100;
            $("#txt_item_payment_amt_" + Index).val(PayAmount);
            CalPayTotalAmout();
        });
        function CalPayTotalAmout(){
            var PayTotal = 0;
            $('.payamount').each(function() {
                PayTotal += Number($(this).val()) || 0;
            });
            $('#total_pay_amount').text(PayTotal.toFixed(2)); 
        }
    });
 </script>
@endsection
