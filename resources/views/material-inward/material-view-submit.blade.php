@extends('layouts.dashboard-master')
@section('content')
@include('layouts.partials.messages')

@php
$EmpDataArr = [];
if(isset($data['Empdata'])){
	$EmpData = $data['Empdata'];
	foreach($EmpData as $Empvalue){
		$EmpDataArr[$Empvalue->emp_no] = $Empvalue->emp_name_payslip;
	}
}
$VendorArr = [];
if(isset($data['Contractordata'])){
	$ContData = $data['Contractordata'];
	foreach($ContData as $Contvalue){
		$VendorArr[$Contvalue->contid] = $Contvalue->name_contractor;
	}
}
if(isset($data['UnitDataArray'])){
	$UnitArray = $data['UnitDataArray'];
}else{
	$UnitArray = [];
}
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
if(isset($data['MaterialInwardDetailData'])){
	$MaterialInwardDetails     = $data['MaterialInwardDetailData'];
}
if(isset($data['FromPage'])){
	$ActionStatus = $data['FromPage'] ?? '';
	$Action       = $data['FromPage'] ?? '';
}else{
    $ActionStatus = '';
    $Action       = '';
}
if(isset($data['WorkFlowActionData'])){
	$WorkFlowActionData = $data['WorkFlowActionData'];
}
$IndentCreateName    = $data['IndentCreateName'] ?? '';
$BackUrl             ='material.material-inward-creation';
$GrandTotal          = 0;
$PayAmt              = 0;
$InvoicesDocArr      = $data['InvoicesDocData'] ?? [];
$DeliveryChallDocArr = $data['DeliveryChallanWithDocs'] ?? [];
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
                                        <div class="row divhead" align="center">Material Inward Application - View / Submit</div>
                                    </div>
                                </div>
                                <div class="row innerdiv">
                                    <div class="row">
                                       <div class="row row-fluid line-control-menu-bar formtitlebar" style="border:none">
                                            <div class="btn-group floatr">
                                                <button type="button" class="btn btn-default btnprimary" title="Back" name="back" id="back" value=" BACK " onclick="window.location='{{ route($BackUrl) }}'" ><i class="fa fa-arrow-circle-o-left pt2"></i> Back</button>
                                            </div>
                                            <div class="btn-group floatr">
                                                <button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="SU"  class="btn btn-default btninfo" value="SUBMIT" data-flag="SU"><i class="fa fa-arrow-circle-right pt2"></i> Submit Application </button>
                                            </div>
                                        </div>
                                        <div class="form-step active">
                                                {{-- ── Purchase order Information Fieldset ── --}}
                                        	    <div class="row smclearrow"></div>
												<fieldset class="fieldbox">
                                                    <legend class="fieldbox-legend">Purchase order</legend>
                                                    <div class="fieldbox-div">
                                                        <div class="div3"><div class="lboxlabel ">Purchase order No.</div><input type="text" name="txt_purchase_order_no" id="txt_purchase_order_no" class="tboxsmclass " readonly value="@php if(isset($PoNo)){ echo $PoNo; } @endphp" ></div>
                                                        <div class="div3"><div class="lboxlabel ">Purchase order Date</div><input type="text" name="txt_purchase_order_date" id="txt_purchase_order_date" class="tboxsmclass " readonly value="@php if(isset($PoDate)){ echo Helper::DisplayDateFormat($PoDate);} @endphp" ></div>
                                                        <div class="div3"><div class="lboxlabel ">Indent Creation By</div><input type="text" name="txt_indent_created_by" id="txt_indent_created_by" class="tboxsmclass " readonly value="@php if(isset($IndentCreateName)){ echo $IndentCreateName; } @endphp" ></div>
                                                        <div class="div3"><div class="lboxlabel ">Vendor Name</div><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="@php if(isset($PoContName)){ echo $PoContName; } @endphp" ></div>
                                                        <!-- <div class="div3"><div class="lboxlabel ">Receipt No.</div><input type="text" name="txt_purchase_order_no" id="txt_purchase_order_no" class="tboxsmclass " readonly value="@php if(isset($ReceiptNo)){ echo $ReceiptNo; } @endphp" ></div> -->
                                                        <!-- <div class="div3"><div class="lboxlabel ">Receipt Date</div><input type="text" name="txt_purchase_order_date" id="txt_purchase_order_date" class="tboxsmclass " readonly value="@php if(isset($ReceiptDate)){ echo Helper::DisplayDateFormat($ReceiptDate);} @endphp" ></div> -->
                                                        <div class="row smclearrow"></div>
                                                        <div class="row smclearrow"></div>
                                                        <div class="row smclearrow"></div>
                                                    </div>
                                                </fieldset>                                                           											
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
                                                    <div class="section-header"><span>Invoice Documents Details</span></div>
                                                    <table class="formtable" disabled width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align:center; width:60%">Invoice Description</th>  
                                                                <th style="text-align:center; width:30%">Date</th>  
                                                                <th style="text-align:center; width:30%">Download</th>  
                                                            </tr>
                                                        </thead>
                                                        <tbody id="supp_doc_tbody">	
                                                            @if(isset($InvoicesDocArr))
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
																<th>Po Qty</th>
																<th>Previous <br>Received <br>Qty</th>
																<th>Received <br>now <br>Qty</th>
																<th>Balance <br>Qty</th>
																<th>Po Rate <br>(Rs.)</th>
																<th>Total cost <br>(Rs.)</th>
                                                                <th>Payment<br>(%)</th>
                                                                <th>Total Payment<br>Amount <br>(Rs.)</th>
																<th>Whether <br> Certified </th>
																<th>Remarks</th>
															</tr>
                                                        </thead>
                                                        <tbody >
															@if(isset($MaterialInwardDetails))
																@foreach($MaterialInwardDetails as $MatValue)
																	<tr>
																		<td align="center" >{{$MatValue->item_no}}</td>
																		<td>{{$MatValue->item_description}}</td>
																		<td>{{$UnitArray[$MatValue->item_unit]}}</td>
																		<td align="center">{{$MatValue->po_quantity}}</td>
																		<td align="center">{{$MatValue->previously_received_qty}}</td>
																		<td align="center">{{$MatValue->received_qty}}</td>
																		<td align="center">{{$MatValue->balance_qty}}</td>
																		<td align="center">{{$MatValue->unit_rate}}</td>
																		<td align="right">{{$MatValue->total_cost}}</td>
																		<td align="center">{{$MatValue->payment_perc}}</td>
																		<td align="right">{{$MatValue->total_payment_amout}}</td>
																		<td align="center">{{$MatValue->qty_certified}}</td>
																		<td align="left">{{$MatValue->item_remarks}}</td>
                                                                        @php $GrandTotal +=$MatValue->total_cost; $PayAmt +=$MatValue->total_payment_amout; @endphp
																@endforeach
                                                                <tr>
                                                                    <td colspan="8" align="right">Grand Total (Rs.)</td>
                                                                    <td align="right" id ="txt_grand_total" name ='txt_grand_total' value = "">{{$GrandTotal}}</td>
                                                                    <td align="right">Total Pay (Rs.)</td>
                                                                    <td align="right">{{$PayAmt}}</td>
                                                                    <td colspan="2"></td>
                                                                </tr>
															@else
																<tr>
																	<td align="center" colspan="11">No records found</td>
																</tr>
															@endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
											<div class="row smclearrow"></div>
                                            <div class="row smclearrow"></div>
                                            {{-- ── INDENT Forward Table ── --}}
                                            <div class="table-container">
                                                <div class="table-wrapper">
                                                    <table class="attTable" disabled>
                                                        <tbody >
															 @if($ActionStatus == 'PROCESS')
																<tr>
																	<td colspan="9">
																		<div class="label">Enter Your Feedback / Remarks Here</div>
																		<textarea name="txt_action_remarks" id="txt_action_remarks" class="tboxsmclass" rows="4"></textarea>
																	</td>
																</tr>
															@endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>{{-- /form-step --}}
                                    </div>
									<div class="row" align="center">
                                        @if($ActionStatus == 'PROCESS')
                                        @php 
                                        $IsApprove  = $WorkFlowActionData['IsApprove'] ?? NULL;
                                        $IsNext     = $WorkFlowActionData['IsNext'] ?? NULL;
                                        $IsPrevious = $WorkFlowActionData['IsPrevious'] ?? NULL;
                                        @endphp
                                        @if($IsPrevious == 'Y')
                                        <button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="RJ" class="step-btn WorkFlowAction" value="REJECT">Reject</button>
                                        <!-- <button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="BW" class="step-btn WorkFlowAction" value="RETURN">Return Back</button> -->
                                        @endif
                                        @if($IsApprove == 'Y')
                                        <button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="AP" class="step-btn WorkFlowAction" value="APPROVE">Approve</button>
                                        @endif

                                        @if(($IsApprove == NULL) && ($IsNext == 'Y'))
                                        <button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="FW" class="step-btn WorkFlowAction" value="FORWARD">Recommend / Forward</button>
                                        @endif

                                        <!-- @if(($IsApprove == 'Y') && ($IsNext == 'Y'))
                                        <button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="AP_FW" class="step-btn WorkFlowAction" value="APPROVE_FORWARD">Approve & Forward</button>
                                        @elseif(($IsApprove == 'Y') && ($IsNext == NULL))
                                        <button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="AP" class="step-btn" value="APPROVE">Approve</button>
                                        @elseif(($IsApprove == NULL) && ($IsNext == 'Y'))
                                        <button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="FW" class="step-btn WorkFlowAction" value="FORWARD">Recommend / Forward</button>
                                        @endif -->
										

                                        @if(($WorkFlowActionData['WorkFlowAction'] ?? null) === 'SU')
                                        	<input type="button" class="backbutton" name="back" id="back" value=" Back " onClick="window.location='{{route($BackUrl)}}'" />
                                        	<input type="button" class="backbutton"  name="btn_edit" id="btn_edit" value=" Edit "onclick="window.location='{{ route('material.material-inward-creation', ['page'=>encrypt('EDIT'),'EditId'=>encrypt($MatInwardId)]) }}'" />
                                       	 	<button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="SU" class="step-btn WorkFlowAction" value="SUBMIT">Submit</button>
                                        @endif

                                        @endif
                                    </div>
                                    <div class="row smclearrow"></div>
                                    <div class="row smclearrow"></div>
                                </div>{{-- /innerdiv --}}
                            </div>
                        </div>
                    </div>
                  <div class="row">
						<div class="div12" align="center">
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
</script>
@endsection