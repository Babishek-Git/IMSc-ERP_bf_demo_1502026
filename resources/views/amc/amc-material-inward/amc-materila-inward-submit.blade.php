@extends('layouts.dashboard-master')
@section('content')
@include('layouts.partials.messages')
@php
$ShowAMCMatInwardDetailsData       = $data['GetAMCMatInwardDetailsData'] ?? [];
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
$InvoiceNosArray         = [];
if(isset($data['GetAMCMatInwardData'])){
	foreach($data['GetAMCMatInwardData'] as $MaterialInwardData){
	    $AMCMatInwardId   =  $MaterialInwardData->amc_master_inward_id;
	    $ReceiptNo        =  $MaterialInwardData->receiptno;
	    $ReceiptDate      =  $MaterialInwardData->receipt_date;
	    $PoId             =  $MaterialInwardData->po_id;
	    $InvoiceNos       =  $MaterialInwardData->invoice_no;
	    $InvoiceDate      =  $MaterialInwardData->invoice_date;
        $InvoiceNosArray  = json_decode($MaterialInwardData->invoice_no, true);
        $InvoiceString    = is_array($InvoiceNosArray) ? implode(', ', $InvoiceNosArray) : $InvoiceNos;
    }
}
$BackUrl    ='amc-material.amc-material-inward-list';
$GrandTotal = 0;
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
                                        <div class="row divhead" align="center">AMC Material Inward Application - View / Submit</div>
                                    </div>
                                </div>
                                <div class="row innerdiv">
                                    <div class="row">
                                       <div class="row row-fluid line-control-menu-bar formtitlebar" style="border:none">
                                            <div class="btn-group floatr">
                                                <button type="button" class="btn btn-default btnprimary" title="Back" name="back" id="back" value=" BACK " onclick="window.location='{{ route($BackUrl) }}'" ><i class="fa fa-arrow-circle-o-left pt2"></i> Back</button>
                                            </div>
                                            <div class="btn-group floatr">
                                                <button type="submit" id="SubmitApplication" name="SubmitApplication"  data-page="{{encrypt('SUBMIT')}}"  data-submitid="{{encrypt($AMCMatInwardId)}}" class="btn btn-default btninfo" value="SUBMIT" data-flag="SU"><i class="fa fa-arrow-circle-right pt2"></i> Submit Application </button>
                                            </div>
                                        </div>
                                        <div class="form-step active">
                                                {{-- ── Purchase order Information Fieldset ── --}}
                                        	    <div class="row smclearrow"></div>
												<fieldset class="fieldbox">
                                                    <legend class="fieldbox-legend">AMC Purchase order</legend>
                                                    <div class="fieldbox-div">
                                                        <div class="div2"><div class="lboxlabel ">Discipline</div><input type="text" name="txt_purchase_order_no" id="txt_purchase_order_no" class="tboxsmclass " readonly value="{{$AMCDiscipName ?? ''}}" ></div>
                                                        <div class="div2"><div class="lboxlabel ">AMC Type</div><input type="text" name="txt_purchase_order_date" id="txt_purchase_order_date" class="tboxsmclass " readonly value="{{$AMCTypeName ?? ''}}" ></div>
                                                        <div class="div2"><div class="lboxlabel ">AMC Based On</div><input type="text" name="txt_indent_created_by" id="txt_indent_created_by" class="tboxsmclass " readonly value="{{$AMCBasesonName ?? ''}}" ></div>
                                                        <div class="div3"><div class="lboxlabel ">AMC File Name</div><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="{{$AMCFileName ?? '' }}" ></div>
                                                        <div class="div3"><div class="lboxlabel ">Description of Equipment</div><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="{{$AMCEqupdesc ?? ''}}" ></div>
                                                        <div class="row smclearrow"></div>
                                                        <div class="div2"><div class="lboxlabel ">Vendor Name</div><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="{{$AMCPOContName ?? ''}}" ></div>
                                                        <div class="div1"><div class="lboxlabel ">AMC Cost</div><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="{{$AMCCost ?? ''}}" ></div>
                                                        <div class="div1"><div class="lboxlabel ">GST %</div><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="{{$AMCGstPerc ?? ''}}" ></div>
                                                        <div class="div1"><div class="lboxlabel ">Tax on Cost</div><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="{{$TaxTypeName ?? ''}}" ></div>
                                                        <div class="div3"><div class="lboxlabel ">Location</div><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="{{$LocationString ?? ''}}" ></div>
                                                        <div class="div2"><div class="lboxlabel ">Payment Mode<input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="{{$AMCPOBillPayMode ?? ''}}" ></div>
                                                        <div class="row smclearrow"></div>
                                                        <div class="row smclearrow"></div>
                                                    </div>
                                                </fieldset>       
                                                {{-- ── Purchase order Information Fieldset ── --}}
                                        	    <div class="row smclearrow"></div>
												<fieldset class="fieldbox">
                                                    <legend class="fieldbox-legend">Receipt Details</legend>
                                                    <div class="fieldbox-div">
                                                        <div class="div2"><div class="lboxlabel ">Receipt No. / GRN No.</div><input type="text" name="txt_purchase_order_no" id="txt_purchase_order_no" class="tboxsmclass " readonly value="{{$ReceiptNo ?? ''}}" ></div>
                                                        <div class="div2"><div class="lboxlabel ">Receipt Date</div><input type="text" name="txt_purchase_order_date" id="txt_purchase_order_date" class="tboxsmclass " readonly value="{{ Helper::DisplayDateFormat($ReceiptDate ?? $ReceiptDate ?? '') }}" ></div>
                                                        <div class="div2"><div class="lboxlabel ">Invoice No.</div><input type="text" name="txt_indent_created_by" id="txt_indent_created_by" class="tboxsmclass " readonly value="{{$InvoiceString ?? ''}}" ></div>
                                                        <div class="div3"><div class="lboxlabel ">Invoice Date</div><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass " readonly value="{{ Helper::DisplayDateFormat($InvoiceDate ?? $InvoiceDate ?? '') }}" ></div>
                                                        <div class="row smclearrow"></div>
                                                        <div class="row smclearrow"></div>
                                                    </div>
                                                </fieldset>                                                     											
                                            <div class="row smclearrow"></div>
                                            {{-- ── AMC Purchase order Information Table ── --}}
                                            <div class="table-container">
                                                <div class="table-wrapper">
                                                    <div class="section-header">
                                                        <span>Item Details of Required Items  </span>
                                                    </div>
                                                    <table class="formtable" disabled width="100%">
                                                        <thead>
                                                            <tr>
																<th>S.No.</th>
																<th style="text-align: center;">Item Description</th>
																<th>Unit</th>
																<th>Po Qty</th>
																<th>Previous  <br>Received <br>Qty</th>
																<th>Received  <br>Now <br>Qty</th>
																<th>Balance <br> Qty</th>
																<th>Po Rate  <br>(Rs.)</th>
																<th>Total Cost  <br>(Rs.)</th>
																<th>Whether  <br>Certified </th>
																<th>Remarks</th>
															</tr>
                                                        </thead>
                                                        <tbody >
															@if(isset($ShowAMCMatInwardDetailsData))
																@foreach($ShowAMCMatInwardDetailsData as $AMCMatInward)
																	<tr>
																		<td align="center" >{{$AMCMatInward->item_no}}</td>
																		<td>{{$AMCMatInward->item_description}}</td>
																		<td>{{$AMCMatInward->item_unit}}</td>
																		<td align="center">{{$AMCMatInward->po_quantity}}</td>
																		<td align="center">{{$AMCMatInward->previously_received_qty}}</td>
																		<td align="center">{{$AMCMatInward->received_qty}}</td>
																		<td align="center">{{$AMCMatInward->balance_qty}}</td>
																		<td align="center">{{$AMCMatInward->unit_rate}}</td>
																		<td align="center">{{$AMCMatInward->total_cost}}</td>
																		<td align="center">{{$AMCMatInward->qty_certified}}</td>
																		<td align="center">{{$AMCMatInward->item_remarks}}</td>
                                                                        @php $GrandTotal +=$AMCMatInward->total_cost; @endphp
																@endforeach
                                                                <tr>
                                                                    <td colspan="8" align="right">Grand Total (Rs.)</td>
                                                                    <td align="right" id ="txt_grand_total" name ='txt_grand_total' value = "">{{$GrandTotal}}</td>
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
		var KillEvent = 0;
		$('body').on("click","#SubmitApplication", function(event){
			if(KillEvent == 0){
				var SubmitId = $(this).attr("data-submitid");
				var page    = $(this).attr("data-page");
				event.preventDefault();
				BootstrapDialog.show({
					title: 'Confirmation Message',
					message: "Are you sure you want to submit your AMC Work Certification Details ..?<br><span style='color:red; font-size:12px; font-style:italic;'>(Note:If you submit your application, you can't edit further.)</span>",
					closable: false, 				// <-- Default value is false,
					draggable: false, 				// <-- Default value is false,
					buttons: [
						{
							label: 'Ok',
							cssClass: 'btn-primary',
							action: function(dialog) {
								dialog.close();
								KillEvent = 1;
								var url = '{{ route("amc-material.amc-material-inward-submit") }}'+'?page='+page+'&EditId='+SubmitId;
								window.location.href = url;
							}
						},
						{
							label: 'Cancel',
							cssClass: 'btn-secondary',
							action: function(dialog) {
								dialog.close();
								KillEvent = 0;
							}
						}
					]
				});
			}
		});
	});
</script>
@endsection