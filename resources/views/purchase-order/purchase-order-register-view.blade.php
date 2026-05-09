@extends('layouts.dashboard-master')
@section('content')
@include('layouts.partials.messages')
@php
if(isset($data['Contractordata'])){
	$ContractorData = $data['Contractordata'];
}
if(isset($data['OfficeDetails'])){
	$OfficeData = $data['OfficeDetails'];
}
if(isset($data['PORegisterData'])){
	$PurchaseEditData   = $data['PORegisterData'];
	$PurchaseNo         = collect($PurchaseEditData)->pluck('work_order_no')->first();
	$PurchaseName       = collect($PurchaseEditData)->pluck('work_name')->first();
	$ContId             = collect($PurchaseEditData)->pluck('contid')->first();
	$PoDate             = collect($PurchaseEditData)->pluck('work_order_date')->first();
	$IndentId           = collect($PurchaseEditData)->pluck('indent_id')->first();
	$PoCost             = collect($PurchaseEditData)->pluck('work_order_cost')->first();
	$WorkDur            = collect($PurchaseEditData)->pluck('work_duration')->first();
	$DateOfComp         = collect($PurchaseEditData)->pluck('date_of_completion')->first();
	$WrkStartDate       = collect($PurchaseEditData)->pluck('work_commence_date')->first();
	$PoId              = collect($PurchaseEditData)->pluck('work_order_id')->first();
	$MatSectionId      = collect($PurchaseEditData)->pluck('mat_cert_sect_id')->first();
	$PComValue        = collect($PurchaseEditData)->pluck('pcom_status')->first();
	$TrNO              = collect($PurchaseEditData)->pluck('tr_no')->first();
	$QUDate            = collect($PurchaseEditData)->pluck('quotation_date')->first();
	$ContName          = $ContractorData[$ContId];
	$MatCertBy         = $OfficeData[$MatSectionId];
}
if(isset($data['Indentdata'])){
	$Indentdata   = $data['Indentdata'];
	$IndentTittle = collect($Indentdata)->pluck('indent_descripton')->first();
	$IndentNo     = collect($Indentdata)->pluck('indent_no')->first();
	$IndentDate   = collect($Indentdata)->pluck('indent_date')->first();
	$IndentNoDate = 'No. ' . $IndentNo . ', Date: ' . Helper::DisplayDateFormat($IndentDate);
}
if(isset($data['FromPage'])){
	$ActionStatus = $data['FromPage'] ?? '';
}

$BackUrl  = 'purchase-order.purchase-order_view';
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
                                        <div class="row divhead" align="center">Purchase Order - View, Edit & Issue</div>
                                    </div>
                                </div>
                                <div class="row innerdiv">
                                    <div class="row">
                                        <div class="form-step active">
                                            {{-- ── Indent Information Fieldset ── --}}
                                        	<div class="row smclearrow"></div>
												<fieldset class="fieldbox"  >
													<legend class="fieldbox-legend">Indent Details</legend>
													<div class="fieldbox-div">
														<div class="div2 label label">Indent No./ Date</div>
														<div class="div3"><input type="text" name="txt_intent_no" id="txt_indent_no" class="tboxsmclass" value="{{$IndentNoDate}}" readonly></div>  
														<div class="div2 label pd-l-20">Indent Title</div>
        												<div class="div3"><textarea name="txt_indent_created_by" id="txt_indent_created_by" class="tboxsmclass" rows="2" style="resize:none;" readonly>{{$IndentTittle}}</textarea></div>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
													</div>
												</fieldset>                                                           											
                                            </div>
											<div class="row smclearrow"></div>
                                            <div class="row smclearrow"></div>
											{{-- ── Purchase Order Information Fieldset ── --}}
                                        	<div class="row smclearrow"></div>
												<fieldset class="fieldbox"  >
													<legend class="fieldbox-legend">Purchase Order  Details</legend>
													<div class="fieldbox-div">
														<div class="div2 label label">Purchase Order No. / Work Order No.</div>
														<div class="div2"><input type="text" name="txt_intent_no" id="txt_indent_no" class="tboxsmclass" value="{{$PurchaseNo}}" readonly></div>  
														<div class="div2 label pd-l-20">Purchase Order Name </div>
														<div class="div3"><textarea name="txt_indent_created_by" id="txt_indent_created_by" class="tboxsmclass" rows="2" style="resize:none;" readonly>{{$PurchaseName}}</textarea></div>
														<div class="div1 label pd-l-20">Purchase Order Date</div>
        												<div class="div1"><input type="text" name="txt_intent_no" id="txt_indent_no" class="tboxsmclass" value="{{Helper::DisplayDateFormat($PoDate)}}" readonly></div>
														<div class="row smclearrow"></div>
														<div class="div2 label pd-l-18">Purchase Order Amount</div>
														<div class="div2"><input type="text" style="width:250px" class="tboxsmclass" value="{{$PoCost}}" readonly></div>
														<div class="div2 label pd-l-18">Vendor Name</div>
														<div class="div2"><input type="text" style="width:250px" class="tboxsmclass" value="@if(isset($ContName)){{$ContName}}@endif" readonly></div>
														<div class="div2 label pd-l-18">Material Certify By</div>
														<div class="div2"><input type="text" style="width:250px" class="tboxsmclass" value="{{$MatCertBy}}" readonly></div>
														<div class="row smclearrow"></div>
														<div class="div2 label pd-l-18">Work Duration Type</div>
														<div class="div2"><input type="text" style="width:250px" class="tboxsmclass" value="{{$WorkDur}}" readonly></div>
														<div class="div2 label pd-l-18">Work Duration</div>
														<div class="div2"><input type="text" style="width:250px" class="tboxsmclass" value="" readonly></div>
														<div class="div2 label pd-l-18">Work Starting Date</div>
														<div class="div2"><input type="text" style="width:250px" class="tboxsmclass" value="{{Helper::DisplayDateFormat($WrkStartDate)}}" readonly></div>
														<div class="div2 label pd-l-18">Work Completion Date</div>
														<div class="div2"><input type="text" style="width:250px" class="tboxsmclass" value="{{Helper::DisplayDateFormat($DateOfComp)}}" readonly></div>
														@if($PComValue == 'YES')
														<div class="div2 label pd-l-18">Tender No.</div>
														<div class="div2"><input type="text" style="width:250px" class="tboxsmclass" value="{{$TrNO}}" readonly></div>
														@else
														<div class="div2 label pd-l-18">Quotation Date</div>
														<div class="div2"><input type="text" style="width:250px" class="tboxsmclass" value="{{Helper::DisplayDateFormat($QUDate)}}" readonly></div>
														@endif
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
													</div>
												</fieldset>                                                           											
                                            </div>
                                            <div class="row smclearrow"></div>
                                            <div class="row smclearrow"></div>
                                            {{-- ── PO Information Table ── --}}
											<div class="table-container">
												<div class="table-wrapper">
													<div class="section-header">
														<span>Item Details of Required Items </span>
													</div>
													<table class="formtable" disabled width="100%">
														<thead>
															<tr>
																<th>S.No.</th>
																<!-- <th>Type Of Material</th> -->
																<th style="text-align: center;">A complete description of Goods/Services intended to be procured</th>
																<th>Qty</th>
																<th>Unit</th>
																<th>Unit Price<br>Rs.</th>
																<th>Amount<br> Rs.</th>
																<!-- <th>GST %</th> -->
																<th>Tax Type</th>
																<th>Total cost <br>with tax <br> (Approx.)</th>
															</tr>
														</thead>
														<tbody >
															@if(isset($data['ShowPoItemDetailsData']))
																@php 
																	$PoSoqDetailsData = $data['ShowPoItemDetailsData']; 
																	$PoId              = collect($PoSoqDetailsData)->pluck('po_id')->first();
																	$Sno        = 1;
																	$GrandTotal = 0;
																@endphp
																@foreach($PoSoqDetailsData as $EditValue)
																	<tr>
																		<td align="center" >{{$EditValue->item_no}}</td>
																		<!-- <td>
																			@if(isset($data['MaterialTypeData']))
																				@foreach($data['MaterialTypeData'] as $MaterialTypeData)
																					@if($MaterialTypeData->material_type_id == $EditValue->material_type_id)
																						{{$MaterialTypeData->material_type_name}}
																					@endif
																				@endforeach
																			@endif
																		</td> -->
																		<td>{{$EditValue->item_description}}</td>
																		<td align="center">{{$EditValue->quantity}}</td>
																		<td align="center">
																			@foreach($data['ShowMaterialUnit'] as $MaterialUnitData)
																				@if($MaterialUnitData->uom_id == $EditValue->unit_id)
																					{{$MaterialUnitData->uom_name}}
																				@endif
																			@endforeach
																		</td>
																		@php
																			if(filled($EditValue->rate_cont_amt) && $EditValue->rate_cont_amt >0){
																				$ItemRate = $EditValue->rate_cont_amt; 
																			}else{
																				$ItemRate = $EditValue->estimated_unit_price; 
																			}
																		@endphp
																		
																		<td align="center">{{$ItemRate}}</td>
																		<!-- <td align="center">{{$EditValue->gst_rate}}</td> -->
																		<td align="center">{{$EditValue->item_amount}}</td>
																		<td align="center">
																			@if($EditValue->tax_type == 'INC')
																				Inclusive
																			@elseif($EditValue->tax_type == 'EXCL')
																				Exclusive
																			@endif
																		</td>
																		<td align="right">{{$EditValue->total_cost}}</td>
																	@php $Sno  ++; 
																		$GrandTotal += $EditValue->total_cost;
																	@endphp
																@endforeach
																<tr>
																	<td colspan="7" align="right">Total Estimated Cost (Approx.)</td>
																	<td align="right">{{$GrandTotal}}</td>
																</tr>
															@else
																<tr>
																	<td align="center" colspan="8">No records found</td>
																</tr>
															@endif
														</tbody>
													</table>
												</div>
											</div>
											<div class="row smclearrow"></div>
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
                  <div class="row">
						<div class="div12" align="center">
							<input type="hidden" name="hid_po_id" id="hid_po_id" value="@if(isset($PoId)){{$PoId}}@endif" />
							<input type="hidden" name="txt_application_id" id="txt_application_id" value="@if(isset($PoId)){{ encrypt($PoId) }}@endif">
							<input type="hidden" name="txt_action" id="txt_action" value="@if(isset($Action)){{ encrypt($Action) }}@endif">
							<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
							<input type="hidden" name="wf_module_code" id="wf_module_code" value="{{ encrypt('PO_ORDER') }}" />
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
<!-- @include('common-workflow.workflow-process') -->

@endsection