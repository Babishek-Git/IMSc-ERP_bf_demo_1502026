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
$WorkFlowActionData         = $data['WorkFlowActionData'] ?? []; 
$FromPage                   = $data['FromPage'] ?? NULL;
if(isset($data['ShowAMCMatrialInwardSubmitData'])){
	foreach($data['ShowAMCMatrialInwardSubmitData'] as $AMCMatInwadData){
		$AMCMatInwardId   = $AMCMatInwadData->amc_master_inward_id;
		$AMCPOId          = $AMCMatInwadData->amc_po_id;
		$AMCDiscipName    = $DesciplineDataArray[$AMCMatInwadData->discipline_id];
		$AMCTypeName      = $AMCTypeDataArray[$AMCMatInwadData->amc_type_id];
		$AMCBasesonName   = $AMCProvdedBaseOnArray[$AMCMatInwadData->amc_baseson_id];
		$AMCFileName      = $AMCMatInwadData->amc_file_name;
		$AMCEqupdesc      = $AMCMatInwadData->equip_desc;
		$AMCPOContId      = $AMCMatInwadData->contid;
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
$ActionStatus = $FromPage;
$Action       = $FromPage;
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
                                        <div class="row divhead" align="center">AMC material Inward Payment </div>
                                    </div>
                                </div>
                                <div class="row innerdiv">
                                    <div class="row">
                                        @php
											$RouteUrl   = 'amc-material-payment.amc-material-inward-payment-submission';
											$ModuleCode = 'AMC_MAT_IW';
											$ForwRejApprButtonComponentArr = \Helper::Forward_Reject_Approve_Button(NULL,$WorkFlowActionData,$BackUrl,$AMCMatInwardId,$RouteUrl,$ActionStatus,$ModuleCode);
											$ButtonDetailsHTML             = $ForwRejApprButtonComponentArr['HTMLSTR'];
										@endphp
											{!!$ButtonDetailsHTML!!}
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
                                                    <input type="hidden" name="txt_application_id" id="txt_application_id" value="@if(isset($AMCMatInwardId)){{ encrypt($AMCMatInwardId) }}@endif">
                                                    <input type="hidden" name="txt_action" id="txt_action" value="@if(isset($Action)){{ encrypt($Action) }}@endif">
                                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                                    <input type="hidden" name="wf_module_code" id="wf_module_code" value="{{ encrypt('AMC_MAT_IW') }}" />
                                                    <input type="hidden" name="txt_wf_mode" id="txt_wf_mode" />
                                                    <input type="hidden" name="txt_actual_emp" id="txt_actual_emp" />
                                                    <input type="hidden" name="txt_wf_remark" id="txt_wf_remark" />
                                                    <input type="hidden" name="txt_wf_emp_no" id="txt_wf_emp_no" />
                                                    <input type="hidden" name="txt_wf_role" id="txt_wf_role" />
                                                    <input type="hidden" name="txt_wf_action" id="txt_wf_action" />
                                                    <input type="hidden" name="txt_role_position" id="txt_role_position" />
                                                </div>		
                                            {{-- ── Material Inward  paymet details ── --}}
                                            <div>
                                                <?php $BalanceAmout = $AMCCost - $TotPayAmout; ?>
                                                <input type="hidden" name ='hidd_cont_id' value ="{{$AMCPOContId ?? ''}}">
                                                <input type="hidden" name = 'hidd_cont_name' value ="{{$AMCPOContName ?? ''}}">
                                                <input type="hidden" name = 'hidd_total_cost' value ="{{$AMCCost ?? ''}}">
                                                <input type="hidden" name ='hidd_total_pay_amout' value ="{{$TotPayAmout ?? ''}}">
                                                <input type="hidden" name ='hidd_balance_amount' value ="{{$BalanceAmout ?? ''}}">
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
@include('common-workflow.workflow-process')
@endsection
