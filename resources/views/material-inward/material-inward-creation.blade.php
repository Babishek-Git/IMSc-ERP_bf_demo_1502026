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
$FinYear            = Helper::GetCurrentFinYear(NULL);
$NewReceiptNo       = "IMS/P&S/" . $FinYear . "/" . $SuffixNo . "";
$BackUrl            = 'material.material-inward-creation';
$InvoicesDocArr     = $data['InvoicesDocData'] ?? [];
$DeliveryChallanArr = $data['GetDeliveryChallanMasterData'] ?? [];
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
								    <div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Material Inward Entry</div></div></div>
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
                                                    <legend class="fieldbox-legend">Purchase order </legend>
                                                    <div class="fieldbox-div">
                                                        <div class="div3"><div class="lboxlabel">Purchase order No.</div><input type="text" name="txt_purchase_order_no" id="txt_purchase_order_no" class="tboxsmclass " readonly value="{{ $PurchaseOrderNo }}" ></div>
                                                        <div class="div3"><div class="lboxlabel">Purchase order Date</div><input type="text" name="txt_purchase_order_date" id="txt_purchase_order_date" class="tboxsmclass " readonly value="{{ Helper::DisplayDateFormat($PurchaseOrderDate) }}" ></div>
                                                        <div class="div3"><div class="lboxlabel">Indent Created By</div><input type="text" name="txt_indent_created_by" id="txt_indent_created_by" class="tboxsmclass " readonly value="{{$IndentCreateName}}" ></div>
                                                        <div class="div3"><div class="lboxlabel">Vendor Name</div><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="{{$VendorName}}" ></div>
                                                        <!-- <div class="div3"><div class="lboxlabel ">Receipt No. / GRN No.</div><input type="text" name="txt_receipt_no" id="txt_receipt_no" class="tboxsmclass" readonly value="{{ $ReceiptNo ?? $NewReceiptNo ?? '' }}"></div> -->
                                                        <!-- <div class="div2"><div class="lboxlabel ">Receipt Date</div><input type="text" name="txt_receipt_date" id="txt_receipt_date" class="tboxsmclass datepicker" value="{{ Helper::DisplayDateFormat($ReceiptDate ?? $ReceiptDate ?? '') }}" ></div> -->
                                                        <div class="row smclearrow"></div>
                                                    </div>
                                                </fieldset>
											    <div class="row smclearrow"></div>
											    <div class="row smclearrow"></div>
											    <div class="row smclearrow"></div>
                                                {{-- ── MATERILA INWARD  SUPPORTING DOCUMENTS TABLE  ── --}}
                                                <div class="table-container">
                                                    <div class="table-wrapper">
                                                        <div class="section-header">
                                                            <span>Receipt Details</span>
                                                        </div>
                                                        <table class="formtable" disabled width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th style="text-align:center; width:60%">Receipt No. / GRN No.</th>  
                                                                    <th style="text-align:center; width:30%">Receipt Date</th>  
                                                                    <th style="text-align:center; width:30%">Download</th>  
                                                                </tr>
                                                            </thead>
                                                            <tbody id="supp_doc_tbody">	
                                                                <tr>
                                                                    <td>
                                                                        <select  style="width:100%" name="cmb_receipt_no" id="cmb_receipt_no" class="tboxsmclass" >
                                                                            <option value=""> ----Select ---</option>
                                                                               @if(isset($DeliveryChallanArr))
                                                                                    @foreach($DeliveryChallanArr as $DeliVeryChallValue)
                                                                                        <option value="{{$DeliVeryChallValue->delivery_challan_id}}">{{$DeliVeryChallValue->receipt_no}}</option>
                                                                                    @endforeach
                                                                                @endif
                                                                        </select>
                                                                    </td>
                                                                    <td><input type="text" name="txt_supp_doc_date[]" id="txt_receipt_date" class="tboxsmclass datepicker"  value=""></td>
                                                                    <td class="labelcenter" style="text-align:center;">
                                                                        <button type="button"  id="btn_receipt_download" data-fileid="" class="btn btn-default tuploadbtn" title="Click here to Download the File" style="cursor: pointer;"><i class="fa fa-download"></i> Download File</button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                {{-- ── MATERILA INWARD  SUPPORTING DOCUMENTS TABLE  ── --}}
                                                <div class="table-container">
                                                    <div class="table-wrapper">
                                                        <div class="section-header">
                                                            <span>Invoice / Supporting Documents Details</span>
                                                            <button align="right" type="button" id='btn_add_new' class="rm-new-emp-btn" >+ Add New Row</button>
                                                        </div>
                                                        <table class="formtable" disabled width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th style="text-align:center; width:60%">Invoice / Supporting Document Description</th>  
                                                                    <th style="text-align:center; width:30%">Date</th>  
                                                                    <th style="text-align:center; width:30%">Upload</th>  
                                                                    <th style="text-align:center; width:10%"> Action</th>  
                                                                </tr>
                                                            </thead>
                                                            <tbody id="supp_doc_tbody">	
                                                                @if(isset($InvoicesDocArr))
                                                                    @foreach($InvoicesDocArr as $DocValue)
                                                                    <tr>
                                                                        <td>
                                                                            <input type="text"  style="width:100%" name="txt_supp_doc_desc[]" id="txt_sno" class="tboxsmclass"  value="{{$DocValue->doc_desc ?? ''}}">
                                                                        </td>
                                                                        <td><input type="text" name="txt_supp_doc_date[]" id="txt_supp_doc_date" class="tboxsmclass datepicker"  value="{{ Helper::DisplayDateFormat($DocValue->doc_date ?? $DocValue->doc_date ?? '') }}"></td>
                                                                        <td class="labelcenter" style="text-align:center;">
                                                                            <button type="button"  id="btn_download" data-fileid="{{ encrypt($DocValue->sup_doc_id) }}" class="btn btn-default tuploadbtn" title="Click here to Download the File" style="cursor: pointer;"><i class="fa fa-download"></i> Download File</button>
                                                                        </td>
                                                                        <td align='center'><i class='fa fa-times-circle sqdel ptr disable DeleteRow' id='DelIndentDetails' style='font-size:24px'></i></td>
                                                                    </tr>
                                                                    @endforeach
                                                                @endif	
                                                                <tr>
                                                                    <td><input type="text"  style="width:100%" name="txt_supp_doc_desc[]" id="txt_sno" class="tboxsmclass  "  value=""></td>
                                                                    <td><input type="text" name="txt_supp_doc_date[]" id="txt_supp_doc_date" class="tboxsmclass datepicker"  value="{{ Helper::DisplayDateFormat($InvoiceDate ?? $InvoiceDate ?? '') }}"></td>
                                                                    <td><input type="file" id="file_upload" name="file_upload[]" class="step-btn"></td>
                                                                    <td align='center'><i class='fa fa-times-circle sqdel ptr disable DeleteRow' id='DelIndentDetails' style='font-size:24px'></i></i></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
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
                                                                <th width="5%">Payment<br>(%)</th>
                                                                <th width="8%">Total Payment<br>Amount <br>(Rs.)</th>
                                                                <!-- <th width="5%">GST %</th> -->
                                                                <!-- <th width="7%">GST <br>Amount</th> -->
                                                                <!-- <th width="8%">Tax <br>Total Cost</th> -->
                                                                <th width="1%">Whether<br>Certified <br><input type="checkbox" id="check_all_certified"></th>
                                                                <th width="10%">Location</th>
                                                                <th width="10%">Employee</th>
                                                                <th width="10%">Remarks</th>
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
                                                                        <td><input type="text" name="txt_recd_now_qty[]" id="txt_recd_now_qty_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass  receivedqty"readonly style="width:100%;" value ='{{ $MatInwardData->received_qty}}'></td>
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
                                                                                            {{ $EmpData->emp_no == $MatInwardData->location_id ? 'selected' : '' }}>
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
                                                            @else
                                                                @if(isset($data['ShowPoSoqData']))
                                                                    @foreach($data['ShowPoSoqData'] as $purchadeData)
                                                                        <tr>
                                                                            <td><input type="text" name="txt_item_no[]" id="txt_item_no_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass" style="width:100%;" readonly value="{{ $purchadeData->item_no}}" ></td>
                                                                            <td><textarea name="txt_item_desc[]" id="txt_item_desc_{{$Index}}"  class="tboxsmclass" data-index ='{{$Index}}' data-index ='{{$Index}}'style="width:100%;" readonlyvalue ='{{ $purchadeData->item_description}}' >{{ $purchadeData->item_description}}</textarea></td>
                                                                            <td><input type="text" name="txt_unit_name[]" id="txt_unit_name_{{$Index}}" class="tboxsmclass" data-index ='{{$Index}}' style="width:100%;" readonly value ='{{ $ShowUnitDataArray[$purchadeData->unit_id]}}'></td>
                                                                            <input type="hidden" name="txt_unit[]" id="txt_unit_{{$Index}}" class="tboxsmclass" data-index ='{{$Index}}' style="width:100%;" readonly value ='{{ $purchadeData->unit_id}}'>
                                                                            <td><input type="text" name="txt_po_qty[]" id="txt_po_qty_{{$Index}}" class="tboxsmclass"data-index ='{{$Index}}' style="width:100%;" readonly value ='{{ $purchadeData->quantity}}'></td>
                                                                            <td><input type="text" name="txt_prev_recd_qty[]" id="txt_prev_recd_qty_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass" style="width:100%;" readonly value ='0'></td>
                                                                            <td><input type="text" name="txt_recd_now_qty[]" id="txt_recd_now_qty_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass  receivedqty" readonly style="width:100%;" value =''></td>
                                                                            <td><input type="text" name="txt_balan_qty[]" id="txt_balan_qty_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass" style="width:100%;" readonly value =''></td>
                                                                            <td><input type="text" name="txt_rate_per_unit[]" id="txt_rate_per_unit_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass" style="width:100%; text-align:right;" readonly value="{{ $purchadeData->estimated_unit_price }}"></td>
                                                                            <td><input type="text" name="txt_total_cost[]" id="txt_total_cost_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass totalcost" style="width:100%; text-align:right;" readonly value =''></td>
                                                                            <!-- <td><input type="text" name="txt_gst_amt[]" id="txt_gst_amt" class="tboxsmclass" style="width:100%;" value =''></td> -->
                                                                             <td><input type="text" name="txt_item_pay_perc[]" id="txt_item_pay_perc_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass decimalnum percvalue" style="width:100%; text-align:right"  value="" ></td>
																			<td><input type="text" name="txt_item_payment_amt[]" id="txt_item_payment_amt_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass payamount" style="width:100%; text-align:right" readonly value="" ></td>
                                                                            <td><input type="checkbox"  name="check_certified[]" id="check_certified_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass cert-checkbox" style="width:100%;" value="YES"></td>
                                                                            <td>
                                                                                <select  style="width:100%" name="cmb_location[]" id="cmb_location" class="tboxsmclass data-index = '{{$Index}}' ChosenInput">
                                                                                    <option value="0"> ----Nil ---</option>
                                                                                    @if(isset($data['ShowLoacationMasterData']))
                                                                                            @foreach($data['ShowLoacationMasterData'] as $LocationData)
                                                                                                <option value="{{$LocationData->location_id}}">{{$LocationData->location_name}} / {{$LocationData->location_sname}}</option>
                                                                                            @endforeach
                                                                                        @endif
                                                                                </select>
                                                                            </td>
                                                                            <td>
                                                                                <select style="width:100%" name="cmb_emp[]" id="cmb_emp_{{$Index}}" class="tboxsmclass ChosenInput" data-index="{{$Index}}">
                                                                                    <option value="0"> ----Nil ---</option>
                                                                                    @if(isset($data['Empdata']))
                                                                                        @foreach($data['Empdata'] as $EmpData)
                                                                                            <option value="{{ $EmpData->emp_no }}">
                                                                                                {{ $EmpData->emp_first_name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="txt_remarks[]" id="txt_remarks_{{$Index}}"data-index ='{{$Index}}'  class="tboxsmclass" style="width:100%;" value =''></td>
                                                                            <input type="hidden" name="po_soq_id" id="txt_po_soq_id_{{$Index}}" data-index ='{{$Index}}' class="tboxsmclass" style="width:100%; text-align:right;" readonly value ='{{$purchadeData->po_order_soq_id}}'>
                                                                        </tr>
                                                                        @php $Index++ ;@endphp
                                                                    @endforeach
                                                                    <tr>
                                                                        <td colspan="10" align="right">Grand Total (Rs.)</td>
                                                                        <td align="right" id ="total_pay_amount" name ='total_pay_amount' value = ""></td>
                                                                        <td colspan="4"></td>
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
                                            </div>    
                                        </div>
                                    </div>
							    </div>
                                <div class="row">
                                    <div class="div12" align="center">
                                        <!-- <button type="submit" class="step-btn btn_save" name="btn_save" id="btn_save" value="Save">Save</button>	 -->
                                        <!-- <button type="submit" class="step-btn btn_save" name="btn_save" id="btn_save" value="SAVEDRAF">Save</button>	 -->
                                        <!-- <button type="submit" class="step-btn btn_save" name="btn_save" id="btn_save" value="SENDACC">Send to Accounts</button>	 -->
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
$('document').ready(function(){
    $('[name="cmb_location"]').chosen();
    $('.ChosenInput').chosen();
    $(".decimalnum").on("input", function () {
        let value = this.value.replace(/[^0-9]/g, ''); // allow only digits
        if (value !== '') {
            value = parseInt(value, 10);
            if (value > 100) value = 100;
            if (value < 1) value = '';
        }
        this.value = value;
    });
    // $("body").on("change","#cmb_receipt_no", function(event){
    //     var DeliveryChallanId = $(this).val();
    //     alert(1);
    //     alert(DeliveryChallanId);
	// 	$.ajax({
	// 		type: 'POST',
	// 		url: '{{ route("material.material-inward-delivery-Challan-qty") }}',
	// 		data: {"_token": "{{ csrf_token() }}",DeliveryChallanId: DeliveryChallanId},
	// 		success: function (data) {
	// 			var DeliveryQtyData    = data.DeliveryChallanQtyData ?? [];
	// 			var DeliveryChallanDoc = data.DeliveryChallanDoc ?? [];
    //             console.log(DeliveryQtyData);
                
	// 		}
	// 	});
	// });
    $("body").on("change", "#cmb_receipt_no", function () {
        var DeliveryChallanId = $(this).val();
        $.ajax({
            type: 'POST',
            url: '{{ route("material.material-inward-delivery-Challan-qty") }}',
            data: {"_token": "{{ csrf_token() }}",DeliveryChallanId: DeliveryChallanId},
            success: function (data) {
                var DeliveryQtyData    = data.DeliveryChallanQtyData ?? [];
                var DeliveryChallanDoc = data.DeliveryChallanDoc ?? [];
                $('.receivedqty').val('');
                $('.totalcost').val('');
                $.each(DeliveryQtyData, function (Key, Value) {
                    var AjaxPoSoqId = Value.po_order_soq_id;
                    var AjaxQty     = Value.quantity;
                    $('input[name="po_soq_id"]').each(function () {
                        var Index = $(this).data('index');
                        var CurrentPoSoqId = $(this).val();
                        if (CurrentPoSoqId == AjaxPoSoqId) {
                            $('#txt_recd_now_qty_' + Index).val(AjaxQty);
                            var PoQty        = Number($('#txt_po_qty_' + Index).val()) || 0;
                            var PoRate       = Number($('#txt_rate_per_unit_' + Index).val()) || 0;
                            var BalanceQty   = PoQty - AjaxQty;
                            var ItemToalCost = PoQty * PoRate;
                            $('#txt_balan_qty_' + Index).val(BalanceQty);
                            $('#txt_total_cost_' + Index).val(ItemToalCost);
                        }
                    });
                });
                if (DeliveryChallanDoc.length > 0) {
                    var DocData = DeliveryChallanDoc[0];
                     if (DocData.doc_date) {
                        let parts   = DocData.doc_date.split('-'); // [yyyy, mm, dd]
                        let RecDate = `${parts[2]}/${parts[1]}/${parts[0]}`;
                        $('#txt_receipt_date').val(RecDate);
                    }
                    $('#btn_receipt_download').attr('data-fileid', DocData.sup_doc_id ?? '');
                }
            }
        });
    });
    $("body").on("click","#btn_add_new", function(event){
		var NewRow = '';
		NewRow += '<tr>';
		NewRow += '<td>';
		NewRow += '<input type="text"  style="width:100%" name="txt_supp_doc_desc[]" id="txt_sno" class="tboxsmclass  "  value="">';
		NewRow += '</td>';
        NewRow += '<td>';
		NewRow += '<input type="text" name="txt_supp_doc_date[]" id="txt_supp_doc_date" class="tboxsmclass datepicker"  value="">';
		NewRow += '</td>';
		NewRow += '<td>';
		NewRow += '<input type="file" id="file_upload" name="file_upload[]" class="step-btn">';
		NewRow += '</td>';
		NewRow += "<td align='center'><i class='fa fa-times-circle sqdel ptr disable DeleteRow' id='DelIndentDetails' style='font-size:24px'></i></i></td>";
		NewRow += '</tr>';
		// $("#supp_doc_tbody").append(NewRow);
		$("#supp_doc_tbody").prepend(NewRow);
        $('.datepicker').datepicker();
	});
	$(document).on('click','.DeleteRow',function(){
		$(this).closest("tr").remove();
	}); 
      $(document).on("click", "#btn_receipt_download", function(event) {
		var SuppDocId     = $(this).attr("data-fileid");
        var ModuleCode    = 'MAT_INWARD';
        var ModuleSubCode = 'DEL_CHALLAN'; 
        if(SuppDocId == ''){
            BootstrapDialog.alert("Select the Receipt No. / GRN No...!!");
            event.preventDefault();
            event.returnValue = false;  
        }else{
		    DownloadFile(SuppDocId,ModuleCode,ModuleSubCode);
            
        }
	});
    $(document).on("click", "#btn_download", function(event) {
		var SuppDocId     = $(this).attr("data-fileid");
        var ModuleCode    = 'MAT_INWARD';
        var ModuleSubCode = 'INVOICE'; 
		DownloadFile(SuppDocId,ModuleCode,ModuleSubCode);
	});
	function DownloadFile(SuppDocId,ModuleCode,ModuleSubCode) {
		window.open("{{ route('indent.sanction-document-download') }}?id=" + SuppDocId + "&module_code=" + ModuleCode + "&module_sub_code=" + ModuleSubCode, "_blank");
	}
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

