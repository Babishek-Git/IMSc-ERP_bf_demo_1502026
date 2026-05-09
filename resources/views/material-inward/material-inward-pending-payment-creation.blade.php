@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
$VendorArr = [];
if(isset($data['Contractordata'])){
	$ContData = $data['Contractordata'];
	foreach($ContData as $Contvalue){
		$VendorArr[$Contvalue->contid] = $Contvalue->name_contractor;
	}
}
$EmpDataArr = [];
if(isset($data['Empdata'])){
	$EmpData = $data['Empdata'];
	foreach($EmpData as $Empvalue){
		$EmpDataArr[$Empvalue->emp_no] = $Empvalue->emp_name_payslip;
	}
}
$showPurchaseOredrData    = $data['ShowPurchaseOrderData'] ?? [];
$ShowUnitDataArray        = $data['UnitDataArray'] ?? [];
$ShowIndentMasterData     = $data['IndentMasterData'] ?? [];

if(isset($data['ShowPurchaseOrderData'])){
	foreach($data['ShowPurchaseOrderData'] as $purchadeData){
	    $PurchaseOrderNo   =  $purchadeData->work_order_no;
	    $IndentId          =  $purchadeData->indent_id;
	    $PoId              =  $purchadeData->work_order_id;
	    $PurchaseOrderDate =  $purchadeData->work_order_date;
        $VendorName        =  $VendorArr[$purchadeData->contid];
    }
}
$IndentCreateId    = collect($ShowIndentMasterData)->where('indent_id',$IndentId)->pluck('created_by')->first();
$IndentCreateName  = $EmpDataArr[$IndentCreateId];
$InvoiceNosArray         = [];
$data['InvoiceNosArray'] = [];
if(isset($data['ShowMaterialInwardData'])){
	foreach($data['ShowMaterialInwardData'] as $MaterialInwardData){
	    $ReceiptNo   =  $MaterialInwardData->receiptno;
	    $ReceiptDate =  $MaterialInwardData->receipt_date;
	    $PoId        =  $MaterialInwardData->po_id;
	    $InvoiceNos  =  $MaterialInwardData->invoice_no;
	    $InvoiceDate =  $MaterialInwardData->invoice_date;
        $InvoiceNosArray = json_decode($MaterialInwardData->invoice_no, true);
        $data['InvoiceNosArray'] = $InvoiceNosArray;
    }
}
if(isset($data['MaxReceiptNo'])){
	$RecptMaxSufNo = $data['MaxReceiptNo'];
}else{
	$RecptMaxSufNo = '';
}
if($RecptMaxSufNo == '' || $RecptMaxSufNo ==  NULL){
	$SuffixNo = '0001';
}else{
	$NextValue = $RecptMaxSufNo + 1;
	$SuffixNo  = str_pad($NextValue, 4, '0', STR_PAD_LEFT);
}
$FinYear          = Helper::GetCurrentFinYear(NULL);
$NewReceiptNo     = "IMS/P&S/" . $FinYear . "/" . $SuffixNo . "";
$BackUrl          = 'material.material-inward-creation';
@endphp
<style>
    .invoice-tag-strip {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        gap: 6px;
        margin-top: 8px;
        padding: 6px 10px;
        border: 1px solid #ddd;
        border-radius: 20px;
        min-height: 36px;
        align-items: center;
        scrollbar-width: thin;
    }
    .input-error {
        border-color: red !important;
    }
    .invoice-span {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: 1.5px solid #1a56a0;
        border-radius: 20px;
        padding: 3px 10px 3px 6px;
        font-size: 12px;
        white-space: nowrap;
        flex-shrink: 0;
        color: #1a56a0;
        font-weight: 500;
    }

    .invoice-span-tag {
        background: #1a56a0;
        color: #fff;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        font-size: 11px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .invoice-span-close {
        cursor: pointer;
        font-size: 14px;
        opacity: 0.7;
        color: #1a56a0;
    }

    .invoice-span-close:hover {
        color: red;
        opacity: 1;
    }
</style>
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
    	<form action="" method="post" enctype="multipart/form-data" name="form">
		<div class="content">
			<div class="title"></div>
			<div class="container_12" >
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row plr">
							    <!-- <div class="div10 mbtable"> -->
							    <div class="div12 mbtable">
								    <div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Material Inward Pending Payment Entry</div></div></div>
                                    <div class="row innerdiv">
                                        <div class="row">
                                            <div class="row row-fluid line-control-menu-bar formtitlebar" style="border:none">
												@if(isset($data['MaterialInwardDetailData']))
													<div class="btn-group floatr">
														<button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Save">Update</button>	
														<input type="button" class="backbutton" name="back" id="back" value=" Back " onClick="window.location='{{route($BackUrl)}}'" />
													</div>
												@else
													<div class="btn-group floatr">
														<button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Save">Save</button>	
														<input type="button" class="backbutton" name="back" id="back" value=" Back " onClick="window.location='{{route($BackUrl)}}'" />
													</div>
												@endif
											</div>
                                            <div class="form-step active"> 
                                                <fieldset class="fieldbox">
                                                    <legend class="fieldbox-legend">Purchase order</legend>
                                                    <div class="fieldbox-div">
                                                        <div class="div3"><div class="lboxlabel ">Purchase order No.</div><input type="text" name="txt_purchase_order_no" id="txt_purchase_order_no" class="tboxsmclass " readonly value="{{ $PurchaseOrderNo }}" ></div>
                                                        <div class="div3"><div class="lboxlabel ">Purchase order Date</div><input type="text" name="txt_purchase_order_date" id="txt_purchase_order_date" class="tboxsmclass " readonly value="{{ Helper::DisplayDateFormat($PurchaseOrderDate) }}" ></div>
                                                        <div class="div3"><div class="lboxlabel ">Indent Created By</div><input type="text" name="txt_indent_created_by" id="txt_indent_created_by" class="tboxsmclass " readonly value="{{$IndentCreateName}}" ></div>
                                                        <div class="div3"><div class="lboxlabel ">Vendor Name</div><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="{{$VendorName}}" ></div>
                                                        <div class="row smclearrow"></div>
                                                        <div class="row smclearrow"></div>
                                                        <div class="row smclearrow"></div>
                                                    </div>
                                                </fieldset>
                                                <fieldset class="fieldbox">
                                                    <legend class="fieldbox-legend">Receipt Details</legend>
                                                    <div class="fieldbox-div">
                                                        <div class="div3"><div class="lboxlabel ">Receipt No. / GRN No.</div><input type="text" name="txt_receipt_no" id="txt_receipt_no" class="tboxsmclass" readonly value="{{ $ReceiptNo ?? $NewReceiptNo ?? '' }}"></div>
                                                        <div class="div2"><div class="lboxlabel ">Receipt Date</div><input type="text" name="txt_receipt_date" id="txt_receipt_date" class="tboxsmclass datepicker" value="{{ Helper::DisplayDateFormat($ReceiptDate ?? $ReceiptDate ?? '') }}" ></div>
                                                        <!-- <div class="div3"><div class="lboxlabel ">Challan No. </div><input type="text" name="txt_emp_icno" id="txt_emp_icno" class="tboxsmclass" value="" ></div>
                                                        <div class="div3"><div class="lboxlabel ">Challan Date</div><input type="text" name="txt_emp_icno" id="txt_emp_icno" class="tboxsmclass" value="" ></div>
                                                        <div class="div6"><div class="lboxlabel ">Invoice No.</div><input type="text" name="txt_emp_icno" id="txt_emp_icno" class="tboxsmclass" value="" ></div> -->
                                                        <div class="div3">
                                                            <div class="lboxlabel">Invoice No.</div>
                                                            <div style="display:flex; align-items:center; gap:6px;"><input type="text" name="txt_invoice_input" id="txt_invoice_input" class="tboxsmclass" placeholder="Enter invoice number" value="">
                                                                <i class="fa fa-plus-square sqadd ptr inp" id="btn_add_invoice"  style="font-size:24px; color:#029339; cursor:pointer;"></i>
                                                            </div>
                                                            <div id="invoice_tag_strip" class="invoice-tag-strip"></div>
                                                            <div id="invoice_hidden_inputs"></div>
                                                        </div>
                                                        <div class="div2"><div class="lboxlabel">Invoice Date</div> <input type="text" name="txt_invoice_date" id="txt_invoice_date" class="tboxsmclass datepicker"  value="{{ Helper::DisplayDateFormat($InvoiceDate ?? $InvoiceDate ?? '') }}"></div>
                                                        <div class="div2"><div class="lboxlabel">Invoice Upload</div><input type="file" id="file_invoce_upload" name="file_invoce_upload" class="step-btn"></div>
                                                        <div class="row smclearrow"></div>
                                                        <!-- <div class="div3">
                                                            <div class="lboxlabel">Invoice No.</div>
                                                            <div style="display:flex; align-items:center; gap:6px;"><input type="text" name="txt_invoice_input" id="txt_invoice_input" class="tboxsmclass" placeholder="Enter invoice number" value="">
                                                                <i class="fa fa-plus-square sqadd ptr inp" id="btn_add_invoice"  style="font-size:24px; color:#029339; cursor:pointer;"></i>
                                                            </div>
                                                            <div id="invoice_tag_strip" class="invoice-tag-strip"></div>
                                                            <div id="invoice_hidden_inputs"></div>
                                                        </div>
                                                        <div class="div2"><div class="lboxlabel">Invoice Date</div> <input type="text" name="txt_invoice_date" id="txt_invoice_date" class="tboxsmclass datepicker"  value=""></div>
                                                        <div class="div2"><div class="lboxlabel">Invoice Upload</div><input type="file" id="file_invoce_upload" name="file_invoce_upload" class="step-btn"></div>
                                                        <div class="row smclearrow"></div> -->
                                                    </div>
                                                </fieldset>
                                                	<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Item Details of Required Items </legend>
												<div class="fieldbox-div">
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<table class="formtable" align="center" id="RelationshipTable" width="100%">
														<thead> 
															 <tr>
                                                                <th width="3%">S.No.</th>
                                                                <th width="26%">Item Description</th>
                                                                <th width="3%">Unit</th>
                                                                <th width="3%">Po Qty</th>
                                                                <th width="5%">Previous <br>Received <br>Qty</th>
                                                                <th width="5%">Received <br>Now <br>Qty</th>
                                                                <th width="7%">Balance  <br>Qty</th>
                                                                <th width="7%">Po Rate <br> (Rs.)</th>
                                                                <th width="8%">Total Cost <br>(Rs.)</th>
                                                                <th width="5%">Payment<br>(%)</th>
                                                                <th width="8%">Total Payment<br>Amount <br>(Rs.)</th>
                                                                <th width="1%">Whether<br>Certified <br><input type="checkbox" id="check_all_certified"></th>
                                                                <th width="10%">Location</th>
                                                                <th width="10%">Employee</th>
                                                                <th width="12%">Remarks</th>
                                                            </tr>
														</thead>
                                                         <tbody>
                                                            @php $Index = 0; $GrantTotal = 0; $PayAmout =0;@endphp
                                                            @if(isset($data['MaterialInwardDetailData']))
                                                                @foreach($data['MaterialInwardDetailData'] as $MatInwardData)
                                                                    <tr>
                                                                        <td><input type="text" name="txt_item_no[]" id="txt_item_no_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass" style="width:100%;" readonly value="{{ $MatInwardData->item_no}}" ></td>
                                                                        <td><textarea name="txt_item_desc[]" id="txt_item_desc_{{$Index}}"  class="tboxsmclass" data-index ='{{$Index}}' data-index ='{{$Index}}'style="width:100%;" readonlyvalue ='{{ $MatInwardData->item_description}}' >{{ $MatInwardData->item_description}}</textarea></td>
                                                                        <td><input type="text" name="txt_unit_name[]" id="txt_unit_name_{{$Index}}" class="tboxsmclass" data-index ='{{$Index}}' style="width:100%;" readonly value ='{{ $ShowUnitDataArray[$MatInwardData->item_unit]}}'></td>
                                                                        <input type="hidden" name="txt_unit[]" id="txt_unit_{{$Index}}" class="tboxsmclass" data-index ='{{$Index}}' style="width:100%;" readonly value ='{{ $MatInwardData->item_unit}}'>
                                                                        <td><input type="text" name="txt_po_qty[]" id="txt_po_qty_{{$Index}}" class="tboxsmclass"data-index ='{{$Index}}' style="width:100%;" readonly value ='{{ $MatInwardData->po_quantity}}'></td>
                                                                        <td><input type="text" name="txt_prev_recd_qty[]" id="txt_prev_recd_qty_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass" style="width:100%;" readonly value ='{{ $MatInwardData->previously_received_qty}}'></td>
                                                                        <td><input type="text" name="txt_recd_now_qty[]" id="txt_recd_now_qty_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass  receivedqty " style="width:100%;" value ='{{ $MatInwardData->received_qty}}'></td>
                                                                        <td><input type="text" name="txt_balan_qty[]" id="txt_balan_qty_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass" style="width:100%;" readonly value ='{{ $MatInwardData->balance_qty}}'></td>
                                                                        <td><input type="text" name="txt_rate_per_unit[]" id="txt_rate_per_unit_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass" style="width:100%; text-align:right;" readonly value="{{ $MatInwardData->unit_rate }}"></td>
                                                                        <td><input type="text" name="txt_total_cost[]" id="txt_total_cost_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass totalcost" style="width:100%; text-align:right;" readonly value ='{{ $MatInwardData->total_cost }}'></td>
                                                                        <!-- <td><input type="text" name="txt_gst_amt[]" id="txt_gst_amt" class="tboxsmclass" style="width:100%;" value =''></td> -->
                                                                         <td><input type="text" name="txt_item_pay_perc[]" id="txt_item_pay_perc_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass decimalnum percvalue" style="width:100%; text-align:right"  value="{{ $MatInwardData->payment_perc ? $MatInwardData->payment_perc : '' }}" ></td>
																			<td><input type="text" name="txt_item_payment_amt[]" id="txt_item_payment_amt_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass payamount" style="width:100%; text-align:right" readonly value="{{ $MatInwardData->total_payment_amout ? $MatInwardData->total_payment_amout : '' }}" ></td>
                                                                        <td><input type="checkbox"  name="check_certified[]" id="check_certified_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass cert-checkbox" style="width:100%;" value="YES" {{ $MatInwardData->qty_certified == 'YES' ? 'checked' : '' }}></td>
                                                                        <td>
                                                                            <select style="width:100%" name="cmb_location[]" id="cmb_location_{{$Index}}" class="tboxsmclass ChosenInput" data-index="{{$Index}}">
                                                                                <option value="0"> ----Nil ---</option>
                                                                                @if(isset($data['ShowLoacationMasterData']))
                                                                                    @foreach($data['ShowLoacationMasterData'] as $LocationData)
                                                                                        <option value="{{ $LocationData->location_id }}"
                                                                                            {{ $LocationData->location_id == $MatInwardData->location_id ? 'selected' : '' }}>
                                                                                            {{ $LocationData->location_name }} / {{ $LocationData->location_sname }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                @endif
                                                                            </select>
                                                                        </td>
                                                                        <td>
                                                                            <select style="width:100%" name="cmb_emp[]" id="cmb_emp_{{$Index}}" class="tboxsmclass ChosenInput" data-index="{{$Index}}">
                                                                                <option value="0"> ----Nil ---</option>
                                                                                @if(isset($data['Empdata']))
                                                                                    @foreach($data['Empdata'] as $EmpData)
                                                                                        <option value="{{ $EmpData->emp_no }}"
                                                                                            {{ $EmpData->emp_no == $MatInwardData->emp_no ? 'selected' : '' }}>
                                                                                            {{ $EmpData->emp_first_name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                @endif
                                                                            </select>
                                                                        </td>
                                                                        <input type="hidden" name ='hid_master_inward_id' id='hid_master_inward_id' value ='{{$MatInwardData->master_inward_id}}'>
                                                                        <td><input type="text" name="txt_remarks[]" id="txt_remarks_{{$Index}}"data-index ='{{$Index}}'  class="tboxsmclass" style="width:100%;" value ='{{ $MatInwardData->item_remarks }}'></td>
                                                                    </tr>
                                                                    @php $Index++;
                                                                        $GrantTotal += $MatInwardData->total_cost;
                                                                        $PayAmout   += $MatInwardData->total_payment_amout;
                                                                    @endphp
                                                                @endforeach
                                                                <tr>
                                                                    <td colspan="8" align="right">Grand Total (Rs.)</td>
                                                                    <td align="right" id ="txt_grand_total" name ='txt_grand_total' value = "">{{ $GrantTotal }}</td>
                                                                    <td align="right">Total Pay (Rs.)</td>
                                                                    <td align="right" id ="total_pay_amount" name ='total_pay_amount' value = "{{$PayAmout ?? ''}}">{{$PayAmout}}</td>
                                                                    <td colspan="2"></td>
                                                                </tr>
                                                            @endif
                                                         </tbody>
													</table>
												</div>
												<div class="row smclearrow"></div>
												<div class="row smclearrow"></div>
											</fieldset>
                                             <div class="row smclearrow"></div>
                                            </div>    
                                        </div>
                                    </div>
							    </div>
                                <div class="row">
                                    <div class="div12" align="center">
                                        <input type="hidden" name ='hid_work_order_id' id='hid_work_order_id' value ='{{$PoId}}'>
                                        <input type="hidden" name ='hid_recipt_suffix_id' id='hid_recipt_suffix_id' value ='{{$SuffixNo}}'>
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
	$('[name="cmb_location"]').chosen();
    $('.ChosenInput').chosen();
    
$('document').ready(function(){
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
    var oldInvoices = @json($data['InvoiceNosArray']);
    var invoiceList = [];
    if (oldInvoices) {
        $.each(oldInvoices, function(key, val) {
            invoiceList.push(val); // push only value (invoice no)
        });
    }
    renderTags();
    $(".receivedqty").on("input", function() {
		this.value = this.value.replace(/[^0-9.]/g, ''); //
	});
    $('body').on('change', '.receivedqty', function() {
        var Index           = $(this).data('index');
        var ItemOverAllQty  = Number($('#txt_po_qty_' + Index).val()) || 0;
        var ItemReceivedQty = Number($('#txt_recd_now_qty_' + Index).val()) || 0;
        var ItemUnitPrice   = Number($('#txt_rate_per_unit_' + Index).val()) || 0;
        if (ItemReceivedQty > ItemOverAllQty) {
            $('#txt_recd_now_qty_' + Index).val('');
            $('#txt_total_cost_' + Index).val('');
            $('#txt_balan_qty_' + Index).val('');
            // BootstrapDialog.alert('Received Qty cannot be greater than PO Qty (' + ItemOverAllQty + ')');
            BootstrapDialog.alert('Received Qty cannot be greater than PO Qty');
			event.returnValue = false;
        }else{
            var BalanceQty = ItemOverAllQty - ItemReceivedQty;
            $('#txt_balan_qty_' + Index).val(BalanceQty);
            var Amount = ItemReceivedQty * ItemUnitPrice;
            $('#txt_total_cost_' + Index).val(Amount);
            calcGrandTotal();
        }
    });
    function calcGrandTotal(){
        var grandTotal = 0;
        $('.totalcost').each(function() {
            grandTotal += Number($(this).val()) || 0;
            $('#txt_grand_total').val(grandTotal.toFixed(2));
            $('#txt_grand_total').text(grandTotal.toFixed(2));
        });
    }
    var invoiceList = [];
    $(document).on('click', '#btn_add_invoice', function () {
        var InvoiceData = $("#txt_invoice_input").val();
        if(InvoiceData == ""){
            BootstrapDialog.alert("Invoice  No. should not be empty..!!");
        }else{
            addInvoice();
        }        
    });
    function addInvoice() {
        var AddInvoice = $('#txt_invoice_input').val().trim();

        // if (invoiceList.includes(AddInvoice)) {
        //     $('#txt_invoice_input').addClass('input-error');
        //     return;
        // }

        invoiceList.push(AddInvoice);
        $('#txt_invoice_input').val('');
        renderTags();
    }

    function removeInvoice(index) {
        invoiceList.splice(index, 1);
        renderTags();
    }

    function renderTags() {
        var strip  = $('#invoice_tag_strip');
        var hidden = $('#invoice_hidden_inputs');

        strip.empty();
        hidden.empty();

        if (invoiceList.length === 0) {
            var emptyStr = '<span style="font-size:12px;color:#aaa;font-style:italic;">No invoices added yet.</span>';
            strip.append(emptyStr);
        } else {
            $.each(invoiceList, function(index, values) {
                var tagStr = '<span class="MapSpan invoice-span" data-invoice="' + values + '">' +
                                '<span class="MapTag invoice-span-tag">' + (index + 1) + '</span> ' +
                                values +
                                ' <span class="invoice-span-close MapClose remove-invoice" data-index="' + index + '">x</span>' +
                            '</span>';
                strip.append(tagStr);

                var hiddenStr = '<input type="hidden" name="invoice_nos[]" id ="invoice_nos" value="' + values + '">';
                hidden.append(hiddenStr);
            });
        }
    }
    $(document).on('click', '.remove-invoice', function () {
        var index = $(this).data('index');
        removeInvoice(index);
    });

    $(document).on('mouseenter', '.remove-invoice', function () {
        $(this).css('color', 'red');
    }).on('mouseleave', '.remove-invoice', function () {
        $(this).css('color', '#1a56a0');
    });
    renderTags();

    $('#check_all_certified').on('change', function() {
        $('.cert-checkbox').prop('checked', $(this).prop('checked'));
    });
     var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
            var CertErr   = 0;w
            var RecQtyErr = 0;
            $('.receivedqty').css('background-color', '#FAFDFE');
		    $('.receivedqty').css('color', '#001BC6');
            var ButtonValue    = $(this).val();
			var ReceiptNo   	= $("#txt_receipt_no").val();
			var ReceiptDate   	= $("#txt_receipt_date").val();
			var InvoiceNo   	= $("#invoice_nos").val();
			var InvoiceDate   	= $("#txt_invoice_date").val();
            $('.cert-checkbox').each(function() {
                if (!$(this).is(':checked')) {
                    CertErr++;
                }
            });
            $('.receivedqty').each(function() {
                var RecQty = $(this).val();
				if(RecQty == ''){
					RecQtyErr++;
                    $(this).css('background-color', 'red');
				    $(this).css('color', '#FFFFFF');
				}
            });
            if(ReceiptNo == ""){
                BootstrapDialog.alert("Receipt No. should not be empty..!!");
                event.preventDefault();
                event.returnValue = false;
            }else if(ReceiptDate == ""){
                BootstrapDialog.alert("Receipt Date should not be empty..!!");
                event.preventDefault();
                event.returnValue = false;
            }else if(InvoiceNo == "" || InvoiceNo == undefined || InvoiceNo == null){
                BootstrapDialog.alert("Atleast add one InvoiceNo ..!!");
                event.preventDefault();
                event.returnValue = false;
            }else if(InvoiceDate == ""){
                BootstrapDialog.alert("Invoice Date should not be empty..!!");
                event.preventDefault();
                event.returnValue = false;
            }else if(RecQtyErr >0){
                BootstrapDialog.alert("Received Now  Qty should not be empty ..!!");
                event.preventDefault();
                event.returnValue = false;      
            }else if(CertErr >0){
                BootstrapDialog.alert("Check all the item  Whether Certified ..!!");
                event.preventDefault();
                event.returnValue = false;      
            }else{
                event.preventDefault();
                BootstrapDialog.confirm({
                    title: 'Confirmation Message',
                    message: 'Are you want to Save Material Inward Entry Details?',
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

    // var KillEvent = 0;
	// $("body").on("click",".btn_save", function(event){
	// 	if(KillEvent == 0){
    //         var ButtonValue    = $(this).val();
	// 		var ReceiptNo   	= $("#txt_receipt_no").val();
	// 		var ReceiptDate   	= $("#txt_receipt_date").val();
    //         alert(ButtonValue);
    //         if( ButtonValue = 'SAVEDRAF'){
    //             event.preventDefault();
	// 			BootstrapDialog.confirm({
	// 				title: 'Confirmation Message',
	// 				message: 'Are you sure want to  Creation Material Inward Entry ?',
	// 				closable: false, // <-- Default value is false
	// 				draggable: false, // <-- Default value is false
	// 				btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
	// 				btnOKLabel: 'Ok', // <-- Default value is 'OK',
	// 				callback: function(result) {
	// 					if(result){
	// 						KillEvent = 1;
	// 						$("#btn_save").trigger( "click" );
	// 					}else {
	// 						KillEvent = 0;
	// 					}
	// 				}
	// 			});
    //         }else{
    //             if(ReceiptNo == ""){
    //                 BootstrapDialog.alert("Receipt No. should not be empty..!!");
    //                 event.preventDefault();
    //                 event.returnValue = false;
    //             }else if(ReceiptDate == ""){
    //                 BootstrapDialog.alert("Receipt Date should not be empty..!!");
    //                 event.preventDefault();
    //                 event.returnValue = false;
    //             }else{
    //                 event.preventDefault();
    //                 BootstrapDialog.confirm({
    //                     title: 'Confirmation Message',
    //                     message: 'Are you sure want to  Creation Material Inward Entry ?',
    //                     closable: false, // <-- Default value is false
    //                     draggable: false, // <-- Default value is false
    //                     btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
    //                     btnOKLabel: 'Ok', // <-- Default value is 'OK',
    //                     callback: function(result) {
    //                         if(result){
    //                             KillEvent = 1;
    //                             $("#btn_save").trigger( "click" );
    //                         }else {
    //                             KillEvent = 0;
    //                         }
    //                     }
    //                 });
    //             }
    //         }
			
	// 	}
	// });
});
</script>
@endsection

