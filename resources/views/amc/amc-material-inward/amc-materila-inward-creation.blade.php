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
if(isset($data['AMCPOData'])){
	foreach($data['AMCPOData'] as $AMCPOMastData){
		$AMCPOId          = $AMCPOMastData->amc_po_order_id;
		$AMCDiscipName    = $DesciplineDataArray[$AMCPOMastData->discipline_id];
		$AMCTypeName      = $AMCTypeDataArray[$AMCPOMastData->amc_type_id];
		$AMCBasesonName   = $AMCProvdedBaseOnArray[$AMCPOMastData->amc_baseson_id];
		$AMCFileName      = $AMCPOMastData->amc_file_name;
		$AMCEqupdesc      = $AMCPOMastData->equip_desc;
		$AMCPOContName    = $VendorDataArray[$AMCPOMastData->contid];
		$AMCCost          = $AMCPOMastData->amc_cost;
		$AMCGstPerc       = $AMCPOMastData->gst_perc;
		$AMCTaxType       = $AMCPOMastData->cost_tax;
		$AMCLocIds        = json_decode($AMCPOMastData->location_id, true);
		$AMCPOBillPayMode = $BillpaymodeDettailsArray[$AMCPOMastData->bill_pay_mode];
		$SelectedLocIds   = array_values(array_filter($AMCLocIds));
        $TaxTypeName      = ($AMCTaxType == 'INC') ? 'Including' : 'Excluding';
        $LocationDetails  = $LocationDataArray;
        $LocationString   = collect($SelectedLocIds)->map(fn($id) => $LocationDataArray[$id] ?? null)->filter()->implode(', ');
	}
}

$showPurchaseOredrData    = $data['ShowPurchaseOrderData'] ?? [];
$ShowUnitDataArray        = $data['UnitDataArray'] ?? [];

$InvoiceNosArray         = [];
$data['InvoiceNosArray'] = [];
if(isset($data['GetAMCMatInwardData'])){
	foreach($data['GetAMCMatInwardData'] as $AMCMaterialInwardData){
	    $ReceiptNo   =  $AMCMaterialInwardData->receiptno;
	    $ReceiptDate =  $AMCMaterialInwardData->receipt_date;
	    $AmcPoId     =  $AMCMaterialInwardData->amc_po_id;
	    $InvoiceNos  =  $AMCMaterialInwardData->invoice_no;
	    $InvoiceDate =  $AMCMaterialInwardData->invoice_date;
        $InvoiceNosArray = json_decode($AMCMaterialInwardData->invoice_no, true);
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
$BackUrl          = 'amc-material.amc-material-inward-list';
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
								<div class="div1">&nbsp;</div>
							    <!-- <div class="div10 mbtable"> -->
							    <div class="div12 mbtable">
								    <div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">AMC Material Inward Entry</div></div></div>
                                    <div class="row innerdiv">
                                        <div class="row">
                                            <div class="row row-fluid line-control-menu-bar formtitlebar" style="border:none">
                                                <div class="btn-group floatr">
                                                    <input type="button" class="backbutton" name="back" id="back" value=" Back " onClick="window.location='{{route($BackUrl)}}'" />
                                                </div>
                                                @if(isset($data['GetAMCMatInwardDetailsData']))
                                                     <div class="btn-group floatr">
                                                        <button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Save">Update</button>
                                                    </div>
                                                @else
                                                    <div class="btn-group floatr">
                                                        <button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Save">Save</button>
                                                    </div>
                                                @endif
                                                
                                        	</div>   
                                            <div class="form-step active"> 
                                                <fieldset class="fieldbox">
                                                    <legend class="fieldbox-legend">AMC Purchase order</legend>
                                                    <div class="fieldbox-div">
                                                        <div class="div2"><div class="lboxlabel ">Discipline</div><input type="text" name="txt_purchase_order_no" id="txt_purchase_order_no" class="tboxsmclass " readonly value="{{ $AMCDiscipName ?? ''}}" ></div>
                                                        <div class="div2"><div class="lboxlabel ">AMC Type</div><input type="text" name="txt_purchase_order_date" id="txt_purchase_order_date" class="tboxsmclass " readonly value="{{$AMCTypeName ?? ''}}" ></div>
                                                        <div class="div2"><div class="lboxlabel ">AMC Bases On</div><input type="text" name="txt_indent_created_by" id="txt_indent_created_by" class="tboxsmclass " readonly value="{{$AMCBasesonName ?? ''}}" ></div>
                                                        <div class="div3"><div class="lboxlabel ">AMC File Name</div><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="{{$AMCFileName ?? ''}}" ></div>
                                                        <div class="div3"><div class="lboxlabel ">Description of Equipment</div><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="{{$AMCEqupdesc ?? ''}}" ></div>
                                                        <div class="row smclearrow"></div>
                                                        <div class="div2"><div class="lboxlabel ">Vendor Name</div><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="{{$AMCPOContName ?? ''}}" ></div>
                                                        <div class="div1"><div class="lboxlabel ">AMC Cost</div><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="{{$AMCCost ?? ''}}" ></div>
                                                        <div class="div1"><div class="lboxlabel ">GST %</div><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="{{$AMCGstPerc ?? ''}}" ></div>
                                                        <div class="div1"><div class="lboxlabel ">Tax on Cost</div><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="{{$TaxTypeName ?? ''}}" ></div>
                                                        <div class="div3"><div class="lboxlabel ">Location</div><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="{{$LocationString ?? ''}}" ></div>
                                                        <div class="div2"><div class="lboxlabel ">Payment Mode</div><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="{{$AMCPOBillPayMode ?? ''}}" ></div>
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
                                                                <th width="5%">Po Qty</th>
                                                                <th width="5%">Previous <br>Received <br>Qty</th>
                                                                <th width="5%">Received <br>Now <br>Qty</th>
                                                                <th width="7%">Balance  <br>Qty</th>
                                                                <th width="7%">Po Rate <br> (Rs.)</th>
                                                                <th width="8%">Total Cost <br>(Rs.)</th>
                                                                <!-- <th width="5%">GST %</th> -->
                                                                <!-- <th width="7%">GST <br>Amount</th> -->
                                                                <!-- <th width="8%">Tax <br>Total Cost</th> -->
                                                                <th width="1%">Whether<br>Certified <br><input type="checkbox" id="check_all_certified"></th>
                                                                <!-- <th width="10%">Location</th> -->
                                                                <th width="10%">Remarks</th>
                                                            </tr>
														</thead>
                                                         <tbody>
                                                            @php $Index = 0; $GrantTotal = 0;@endphp
                                                            @if(isset($data['GetAMCMatInwardDetailsData']))
                                                                @foreach($data['GetAMCMatInwardDetailsData'] as $MatInwardData)
                                                                    <tr>
                                                                        <td><input type="text" name="txt_item_no[]" id="txt_item_no_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass" style="width:100%;" readonly value="{{ $MatInwardData->item_no ?? ''}}" ></td>
                                                                        <td><textarea name="txt_item_desc[]" id="txt_item_desc_{{$Index}}"  class="tboxsmclass" data-index ='{{$Index}}' data-index ='{{$Index}}'style="width:100%;" readonlyvalue ='{{ $MatInwardData->item_description ?? ""}}' >{{ $MatInwardData->item_description}}</textarea></td>
                                                                        <td><input type="text" name="txt_unit_name[]" id="txt_unit_name_{{$Index}}" class="tboxsmclass" data-index ='{{$Index}}' style="width:100%;" readonly value ="{{$ShowUnitDataArray[$MatInwardData->item_unit] ?? ''}}"></td>
                                                                        <input type="hidden" name="txt_unit[]" id="txt_unit_{{$Index}}" class="tboxsmclass" data-index ='{{$Index}}' style="width:100%;" readonly value ='{{ $MatInwardData->item_unit ?? ""}}'>
                                                                        <td><input type="text" name="txt_po_qty[]" id="txt_po_qty_{{$Index}}" class="tboxsmclass"data-index ='{{$Index}}' style="width:100%;" readonly value ='{{ $MatInwardData->po_quantity ?? ""}}'></td>
                                                                        <td><input type="text" name="txt_prev_recd_qty[]" id="txt_prev_recd_qty_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass" style="width:100%;" readonly value ='{{ $MatInwardData->previously_received_qty ?? ""}}'></td>
                                                                        <td><input type="text" name="txt_recd_now_qty[]" id="txt_recd_now_qty_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass decimalnum receivedqty " style="width:100%;" value ='{{ $MatInwardData->received_qty ?? ""}}'></td>
                                                                        <td><input type="text" name="txt_balan_qty[]" id="txt_balan_qty_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass" style="width:100%;" readonly value ='{{ $MatInwardData->balance_qty ?? ""}}'></td>
                                                                        <td><input type="text" name="txt_rate_per_unit[]" id="txt_rate_per_unit_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass" style="width:100%; text-align:right;" readonly value="{{ $MatInwardData->unit_rate ?? '' }}"></td>
                                                                        <td><input type="text" name="txt_total_cost[]" id="txt_total_cost_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass totalcost" style="width:100%; text-align:right;" readonly value ='{{ $MatInwardData->total_cost ?? "" }}'></td>
                                                                        <!-- <td><input type="text" name="txt_gst_amt[]" id="txt_gst_amt" class="tboxsmclass" style="width:100%;" value =''></td> -->
                                                                        <td><input type="checkbox"  name="check_certified[]" id="check_certified_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass cert-checkbox" style="width:100%;" value="YES" {{ $MatInwardData->qty_certified == 'YES' ? 'checked' : '' }}></td>
                                                                        <!-- <td>
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
                                                                        </td> -->
                                                                        <input type="hidden" name ='hid_master_inward_id' id='hid_master_inward_id' value ='{{$MatInwardData->amc_master_inward_id}}'>
                                                                        <td><input type="text" name="txt_remarks[]" id="txt_remarks_{{$Index}}"data-index ='{{$Index}}'  class="tboxsmclass" style="width:100%;" value ='{{ $MatInwardData->item_remarks }}'></td>
                                                                    </tr>
                                                                    @php $Index++;
                                                                         $GrantTotal += $MatInwardData->total_cost;
                                                                    @endphp
                                                                @endforeach
                                                                <tr>
                                                                    <td colspan="8" align="right">Grand Total (Rs.)</td>
                                                                    <td align="right" id ="txt_grand_total" name ='txt_grand_total' value = "">{{ $GrantTotal }}</td>
                                                                    <td colspan="3"></td>
                                                                </tr>
                                                            @else
                                                                @if(isset($data['AMCPOSoqData']))
                                                                    @foreach($data['AMCPOSoqData'] as $purchadeData)
                                                                        <tr>
                                                                            <td><input type="text" name="txt_item_no[]" id="txt_item_no_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass" style="width:100%;" readonly value="{{ $purchadeData->item_no ?? ''}}" ></td>
                                                                            <td><textarea name="txt_item_desc[]" id="txt_item_desc_{{$Index}}"  class="tboxsmclass" data-index ='{{$Index}}' data-index ='{{$Index}}'style="width:100%;" readonlyvalue ="{{ $purchadeData->item_description ?? ''}}" >{{ $purchadeData->item_description}}</textarea></td>
                                                                            <td><input type="text" name="txt_unit_name[]" id="txt_unit_name_{{$Index}}" class="tboxsmclass" data-index ='{{$Index}}' style="width:100%;" readonly value="{{ $ShowUnitDataArray[$purchadeData->unit_id] ?? '' }}"></td>
                                                                            <input type="hidden" name="txt_unit[]" id="txt_unit_{{$Index}}" class="tboxsmclass" data-index ='{{$Index}}' style="width:100%;" readonly value ="{{ $purchadeData->unit_id ?? ''}}">
                                                                            <td><input type="text" name="txt_po_qty[]" id="txt_po_qty_{{$Index}}" class="tboxsmclass"data-index ='{{$Index}}' style="width:100%;" readonly value ='{{ $purchadeData->quantity ?? ""}}'></td>
                                                                            <td><input type="text" name="txt_prev_recd_qty[]" id="txt_prev_recd_qty_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass" style="width:100%;" readonly value ='0'></td>
                                                                            <td><input type="text" name="txt_recd_now_qty[]" id="txt_recd_now_qty_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass decimalnum receivedqty " style="width:100%;" value =''></td>
                                                                            <td><input type="text" name="txt_balan_qty[]" id="txt_balan_qty_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass" style="width:100%;" readonly value =''></td>
                                                                            <td><input type="text" name="txt_rate_per_unit[]" id="txt_rate_per_unit_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass" style="width:100%; text-align:right;" readonly value="{{ $purchadeData->estimated_unit_price ?? '' }}"></td>
                                                                            <td><input type="text" name="txt_total_cost[]" id="txt_total_cost_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass totalcost" style="width:100%; text-align:right;" readonly value =''></td>
                                                                            <!-- <td><input type="text" name="txt_gst_amt[]" id="txt_gst_amt" class="tboxsmclass" style="width:100%;" value =''></td> -->
                                                                            <td><input type="checkbox"  name="check_certified[]" id="check_certified_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass cert-checkbox" style="width:100%;" value="YES"></td>
                                                                            <!-- <td>
                                                                                <select  style="width:100%" name="cmb_location[]" id="cmb_location" class="tboxsmclass data-index = '{{$Index}}' ChosenInput">
                                                                                    <option value="0"> ----Nil ---</option>
                                                                                    @if(isset($data['ShowLoacationMasterData']))
                                                                                            @foreach($data['ShowLoacationMasterData'] as $LocationData)
                                                                                                <option value="{{$LocationData->location_id}}">{{$LocationData->location_name}} / {{$LocationData->location_sname}}</option>
                                                                                            @endforeach
                                                                                        @endif
                                                                                </select>
                                                                            </td> -->
                                                                            <td><input type="text" name="txt_remarks[]" id="txt_remarks_{{$Index}}"data-index ='{{$Index}}'  class="tboxsmclass" style="width:100%;" value =''></td>
                                                                        </tr>
                                                                        @php $Index++ ;@endphp
                                                                    @endforeach
                                                                    <tr>
                                                                        <td colspan="8" align="right">Grand Total (Rs.)</td>
                                                                        <td align="right" id ="txt_grand_total" name ='txt_grand_total' value = ""></td>
                                                                        <td colspan="3"></td>
                                                                    </tr>
                                                                @endif
                                                            @endif
                                                            
                                                         </tbody>
													</table>
												</div>
												<div class="row smclearrow"></div>
												<div class="row smclearrow"></div>
											</fieldset>
                                             <div class="row smclearrow"></div>
                                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                            <input type="hidden" name ='hid_amc_po_id' id ='hid_amc_po_id' value ="{{$AMCPOId ?? ''}}">
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
	$('[name="cmb_location"]').chosen();
    
$('document').ready(function(){
    var oldInvoices = @json($data['InvoiceNosArray']);
    var invoiceList = [];
    if (oldInvoices) {
        $.each(oldInvoices, function(key, val) {
            invoiceList.push(val); // push only value (invoice no)
        });
    }
    renderTags();
    $(".decimalnum").on("input", function() {
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
            var CertErr   = 0;
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
                    message: 'Are you sure want to  save the AMC Work Certification Details..?',
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

