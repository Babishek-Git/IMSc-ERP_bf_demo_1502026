@extends('layouts.dashboard-master')
@section('content')
@include('layouts.partials.messages')
@php
$VendorArr          = $data['VendorData'] ?? [];
$EmpDataArr         = $data['EmpDetails'] ?? [];
$ShowPoSoqArr       = $data['ShowPoSoqData'] ?? [];
$UnitArray          = $data['UnitData'] ?? [];
$DataByPoDetIsArray = $data['DeliveryChallanQtyBySoqId'] ?? [];
$DelivChallanDocArr = $data['DeliveryChallanDocData'] ?? [];
if(isset($data['MaterialInwardData']) && isset($data['showPurchaseOredrData'])){
	$MaterialInwardData     = $data['MaterialInwardData'];
	$MatInwardId            = collect($MaterialInwardData)->pluck('master_inward_id')->first();
	$WorkId                 = collect($MaterialInwardData)->pluck('po_id')->first();
	$ReceiptDate            = collect($MaterialInwardData)->pluck('receipt_date')->first();
	$ReceiptNo              = collect($MaterialInwardData)->pluck('receiptno')->first();
	$InvoiceNos             = collect($MaterialInwardData)->pluck('invoice_no')->first();
	$InvoiceDate            = collect($MaterialInwardData)->pluck('invoice_date')->first();
    $invoiceArray           = json_decode($InvoiceNos, true);
    $InvoiceString          = is_array($invoiceArray) ? implode(', ', $invoiceArray) : $InvoiceNos;
}
if(isset($data['showPurchaseOredrData'])){
	$PoData             = $data['showPurchaseOredrData'];
	$PoNo               = collect($PoData)->pluck('work_order_no')->first();
	$PoDate             = collect($PoData)->pluck('work_order_date')->first();
	$PoName             = collect($PoData)->pluck('work_name')->first();
	$Pocontid           = collect($PoData)->pluck('contid')->first();
	$CreatedBy          = collect($PoData)->pluck('created_by')->first();
	$EmpName            = $EmpDataArr[$CreatedBy];
	$PoContName         = $VendorArr[$Pocontid];
}
$IndentCreateName = $data['IndentCreateName'] ?? '';
$BackUrl          ='material.material-inward-delivery-Challan-upload';
$GrandTotal       = 0;
$PayAmt           = 0;
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
                                        <div class="row divhead" align="center">Material Inward Delivey Challan Upload</div>
                                    </div>
                                </div>
                                <div class="row innerdiv">
                                    <div class="row">
                                       <div class="row row-fluid line-control-menu-bar formtitlebar" style="border:none">
                                            <div class="btn-group floatr">
                                                <button type="button" class="btn btn-default btnprimary" title="Back" name="back" id="back" value=" BACK " onclick="window.location='{{ route($BackUrl) }}'" ><i class="fa fa-arrow-circle-o-left pt2"></i> Back</button>
                                            </div>
                                            <div class="btn-group floatr">
                                                <button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="SU"  class="btn btn-default btninfo" value="SUBMIT" data-flag="SU"><i class="fa fa-upload"></i></i> Upload </button>
                                            </div>
                                        </div>
                                        <div class="form-step active">
                                                {{-- ── Purchase order Information Fieldset ── --}}
                                        	    <div class="row smclearrow"></div>
												<fieldset class="fieldbox">
                                                    <legend class="fieldbox-legend">Purchase order Details</legend>
                                                    <div class="fieldbox-div">
                                                        <div class="div3"><div class="lboxlabel ">Purchase order No.</div><input type="text" name="txt_purchase_order_no" id="txt_purchase_order_no" class="tboxsmclass " readonly value="@php if(isset($PoNo)){ echo $PoNo; } @endphp" ></div>
                                                        <div class="div3"><div class="lboxlabel ">Purchase order Date</div><input type="text" name="txt_purchase_order_date" id="txt_purchase_order_date" class="tboxsmclass " readonly value="@php if(isset($PoDate)){ echo Helper::DisplayDateFormat($PoDate);} @endphp" ></div>
                                                        <div class="div3"><div class="lboxlabel ">Indent Creation By</div><input type="text" name="txt_indent_created_by" id="txt_indent_created_by" class="tboxsmclass " readonly value="@php if(isset($IndentCreateName)){ echo $IndentCreateName; } @endphp" ></div>
                                                        <div class="div3"><div class="lboxlabel ">Vendor Name</div><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="@php if(isset($PoContName)){ echo $PoContName; } @endphp" ></div>
                                                        <div class="row smclearrow"></div>
                                                        <div class="row smclearrow"></div>
                                                        <div class="row smclearrow"></div>
                                                    </div>
                                                </fieldset>                                                           											
                                            <div class="row smclearrow"></div>
                                            <div class="row smclearrow"></div>
                                            <div class="row smclearrow"></div>
                                            <div class="table-container">
                                                <div class="table-wrapper">
                                                    <div class="section-header">
                                                        <span>Delivery Challan Documents Details</span>
                                                        <!-- <button align="right" type="button" id='btn_add_new' class="rm-new-emp-btn" >+ Add New Row</button> -->
                                                    </div>
                                                    <table class="formtable" disabled width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align:center; width:60%">Receipt No.</th>  
                                                                <th style="text-align:center; width:30%">Receipt Date</th>  
                                                                <th style="text-align:center; width:30%">Upload</th>  
                                                                <!-- <th style="text-align:center; width:10%"> Action</th>   -->
                                                            </tr>
                                                        </thead>
                                                        <tbody id="supp_doc_tbody">	
                                                            @if(isset($DelivChallanDocArr))
                                                                @foreach($DelivChallanDocArr as $DocValue)
                                                                <tr>
                                                                    <td>
                                                                        <input type="text"  style="width:100%" name="txt_supp_doc_desc[]" id="txt_sno" class="tboxsmclass" readonly value="{{$DocValue->doc_desc ?? ''}}">
                                                                    </td>
                                                                    <td><input type="text" name="txt_supp_doc_date[]" id="txt_supp_doc_date" class="tboxsmclass" readonly value="{{ Helper::DisplayDateFormat($DocValue->doc_date ?? $DocValue->doc_date ?? '') }}"></td>
                                                                    <td class="labelcenter" style="text-align:center;">
                                                                        <button type="button"  id="btn_download" data-fileid="{{ encrypt($DocValue->sup_doc_id) }}" class="btn btn-default tuploadbtn" title="Click here to Download the File" style="cursor: pointer;"><i class="fa fa-download"></i> Download File</button>
                                                                    </td>
                                                                    <!-- <td align='center'><i class='fa fa-times-circle sqdel ptr disable DeleteRow' id='DelIndentDetails' style='font-size:24px'></i></td> -->
                                                                </tr>
                                                                @endforeach
                                                            @endif	
                                                            <tr>
                                                                <td><input type="text"  style="width:100%" name="txt_receipt_no" id="txt_receipt_no" class="tboxsmclass" readonly value="{{$NewReceiptNo ?? ''}}"></td>
                                                                <td><input type="text" name="txt_receipt_date" id="txt_receipt_date" class="tboxsmclass datepicker"  value="{{ Helper::DisplayDateFormat($InvoiceDate ?? $InvoiceDate ?? '') }}"></td>
                                                                <td><input type="file" id="file_upload" name="file_upload" class="step-btn"></td>
                                                                <!-- <td align='center'><i class='fa fa-times-circle sqdel ptr disable DeleteRow' id='DelIndentDetails' style='font-size:24px'></i></i></td> -->
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row smclearrow"></div>
                                            {{-- ── Purchase order Information Table ── --}}
                                            <div class="table-container">
                                                <div class="table-wrapper">
                                                    <div class="section-header">
                                                        <span>Item Details of Required Items </span>
                                                    </div>
                                                    <table class="formtable" disabled width="100%">
                                                        <thead>
                                                            <tr>
																<th>S.No.</th>
																<th style="text-align: center;">Item Description</th>
																<th>Unit</th>
																<th>PO. Qty</th>
																<th>Previous Received Qty</th>
																<th>Received now Qty</th>
																<th>Balance Qty</th>
															</tr>
                                                        </thead>
                                                        <tbody >
                                                            @php $Sno=0; @endphp
															@if(isset($ShowPoSoqArr)) 
																@foreach($ShowPoSoqArr as $PoValue)
                                                                    @php
                                                                        $ReceivedQty = $DataByPoDetIsArray[$PoValue->po_order_soq_id] ?? '';
                                                                        $BalanceQty  = ($ReceivedQty != '') ? ($PoValue->quantity - $ReceivedQty): '';
                                                                    @endphp
																	<tr>
                                                                        <input type="hidden" name ='txt_item_no[]' id="txt_item_no_{{$Sno}}" data-index ='{{$Sno}}' value ='{{$PoValue->item_no}}'>
																		<td align="center">{{$PoValue->item_no}}</td>
                                                                        <input type="hidden" name ='txt_item_desc[]' id="txt_item_desc_{{$Sno}}" data-index ='{{$Sno}}' value ='{{$PoValue->item_description}}'>
																		<td>{{$PoValue->item_description}}</td>
                                                                        <input type="hidden" name ='txt_unit[]' id="txt_unit_{{$Sno}}" data-index ='{{$Sno}}' value ='{{$PoValue->unit_id}}'>
																		<td align="center">{{$UnitArray[$PoValue->unit_id]}}</td>
                                                                        <input type="hidden" name ='txt_po_qty[]' id="txt_po_qty_{{$Sno}}" data-index ='{{$Sno}}' value ='{{$PoValue->quantity}}'>
																		<td align="center">{{$PoValue->quantity}}</td>
																		<td align="center"></td>
																		<td align="center"><input type="text" name="txt_recd_now_qty[]" id="txt_recd_now_qty_{{$Sno}}" data-index ='{{$Sno}}' class="tboxsmclass  decimalnum QtyRecived" style="width:100%; text-align:right"  value="{{$ReceivedQty ?? ''}}" ></td>
																		<td align="center"><input type="text" name ='txt_balan_qty[]' id="txt_balan_qty_{{$Sno}}"readonly class="tboxsmclass" style="width:100%; text-align:right" data-index ='{{$Sno}}' value ='{{$BalanceQty ?? ""}}'></td>
                                                                        <input type="hidden" name ='hid_work_order_id' id='hid_work_order_id' value ='{{$PoValue->po_id ?? "" }}'>
                                                                        <input type="hidden" name ='hid_indent_id' id='hid_indent_id' value ='{{$PoValue->indent_id ?? "" }}'>
                                                                        <input type="hidden" name ='txt_rate_per_unit[]' id="txt_rate_per_unit_{{$Sno}}" data-index ='{{$Sno}}' value ='{{$PoValue->item_amount}}'>
                                                                        <input type="hidden" name="txt_total_cost[]" id="txt_total_cost_{{$Sno}}" data-index ='{{$Sno}}' class="tboxsmclass totalcost" style="width:100%; text-align:right;" readonly value =''>
                                                                        <input type="hidden" name="txt_po_soq_id[]" id="txt_po_soq_id_{{$Sno}}" data-index ='{{$Sno}}' class="tboxsmclass totalcost" style="width:100%; text-align:right;" readonly value ='{{$PoValue->po_order_soq_id}}'>
                                                                    </tr>
                                                                    @php $Sno++; @endphp
																@endforeach
															@else
                                                            <tr>
                                                                <td align="center" colspan="11">No records found</td>
                                                            </tr>
															@endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name ='hid_recipt_suffix_id' id='hid_recipt_suffix_id' value ='{{$SuffixNo}}'>
                                    <input type="hidden" name ='hid_mat_inward_id' id='hid_mat_inward_id' value =''>
                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                    <div class="row smclearrow"></div>
                                    <div class="row smclearrow"></div>
                                </div>{{-- /innerdiv --}}
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
    $('document').ready(function(){
        $(".decimalnum").on("input", function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
        $(document).on("click", "#btn_download", function(event) {
            var SuppDocId = $(this).attr("data-fileid");
            DownloadFile(SuppDocId);
        });
        function DownloadFile(SuppDocId) {
            var ModuleCode    = 'MAT_INWARD';
            var ModuleSubCode = 'DEL_CHALLAN';
            window.open("{{ route('indent.sanction-document-download') }}?id=" + SuppDocId + "&module_code=" + ModuleCode + "&module_sub_code=" + ModuleSubCode, "_blank");
        }
        $('body').on('change', '.QtyRecived', function() {
            var Index           = $(this).data('index');
            var ItemOverAllQty  = Number($('#txt_po_qty_' + Index).val()) || 0;
            var ItemReceivedQty = Number($('#txt_recd_now_qty_' + Index).val()) || 0;
             var ItemUnitPrice  = Number($('#txt_rate_per_unit_' + Index).val()) || 0;
            if (ItemReceivedQty > ItemOverAllQty) {
                $('#txt_recd_now_qty_' + Index).val('');
                $('#txt_balan_qty_' + Index).val('');
                BootstrapDialog.alert('Received Qty cannot be greater than PO Qty');
                event.returnValue = false;
            }else{
                var BalanceQty = ItemOverAllQty - ItemReceivedQty;
                $('#txt_balan_qty_' + Index).val(BalanceQty);
                var Amount = ItemReceivedQty * ItemUnitPrice;
                $('#txt_total_cost_' + Index).val(Amount);
            }
        });
        var KillEvent = 0;
	    $("body").on("click","#SubmitApplication", function(event){
            if(KillEvent == 0){
                var ReceiptNo   	= $("#txt_receipt_no").val();
                var ReceiptDate   	= $("#txt_receipt_date").val();
                var FileUpload   	= $("#file_upload").val();
                var RecQtyErr       = 0;
                $('.QtyRecived').css('background-color', '#FAFDFE');
		        $('.QtyRecived').css('color', '#001BC6');
                $('.QtyRecived').each(function() {
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
                }else if(ReceiptDate == ''){
                    BootstrapDialog.alert("Receipt Date should not be empty..!!");
                    event.preventDefault();
                    event.returnValue = false;
                }else if(FileUpload == ''){
                    BootstrapDialog.alert("Upload File should not be empty..!!");
                    event.preventDefault();
                    event.returnValue = false;  
                }else if(RecQtyErr >0){
                    BootstrapDialog.alert("Received Qty should not be empty. Otherwise, enter 0.");
                    event.preventDefault();
                    event.returnValue = false;       
                }else{
                    event.preventDefault();
                    BootstrapDialog.confirm({
                        title: 'Confirmation Message',
                        message: 'Are you sure want to Upload..?',
                        closable: false, // <-- Default value is false
                        draggable: false, // <-- Default value is false
                        btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
                        btnOKLabel: 'Ok', // <-- Default value is 'OK',
                        callback: function(result) {
                            if(result){
                                KillEvent = 1;
                                $("#SubmitApplication").trigger( "click" );
                            }else {
                                KillEvent = 0;
                            }
                        }
                    });
                }
            }
        });
    });
</script>
@endsection