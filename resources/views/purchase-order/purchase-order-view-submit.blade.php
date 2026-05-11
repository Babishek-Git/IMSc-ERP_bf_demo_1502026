@extends('layouts.dashboard-master')
@section('content')
@include('layouts.partials.messages')
@php
if(isset($data['ContractorDetails'])){
	$ContractorData = $data['ContractorDetails'];
}
if(isset($data['OfficeDetails'])){
	$OfficeData = $data['OfficeDetails'];
}
if(isset($data['ShowPurchaseEditData'])){
	$PurchaseEditData   = $data['ShowPurchaseEditData'];
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
	$PComValue         = collect($PurchaseEditData)->pluck('pcom_status')->first();
	$TrNO              = collect($PurchaseEditData)->pluck('tr_no')->first();
	$QUDate            = collect($PurchaseEditData)->pluck('quotation_date')->first();
	$WorkDurMode       = collect($PurchaseEditData)->pluck('work_duration_mode')->first();
	$GstPerc           = collect($PurchaseEditData)->pluck('gst_perc')->first();
	$PoTaxType         = collect($PurchaseEditData)->pluck('cost_tax')->first();
	$IsGemPortal       = collect($PurchaseEditData)->pluck('is_gem_portal')->first();
	$GemPoNo           = collect($PurchaseEditData)->pluck('gem_po_no')->first();
	$PoTotalAmt        = collect($PurchaseEditData)->pluck('tax_with_po_amt')->first();
	$ContName          = $ContractorData[$ContId];
	$MatCertBy         = $OfficeData[$MatSectionId];
	if($PoTaxType == 'INC'){
		$TaxName  = 'Including';
	}else{
		$TaxName  = 'Excluding';
	}
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
if(isset($data['WorkFlowActionData'])){
	$WorkFlowActionData = $data['WorkFlowActionData'];
}
if(isset($data['IndentEmpdata'])){
	$IndentEmpdata   = $data['IndentEmpdata'];
	$EmpName         = collect($IndentEmpdata)->pluck('emp_name_payslip')->first();
	$EmpIcno         = collect($IndentEmpdata)->pluck('ic_no')->first();
	$EmpDesi         = collect($IndentEmpdata)->pluck('designation_name')->first();
	$IndentEmpTittle = (isset($EmpName) && isset($EmpIcno) && isset($EmpDesi)) ? $EmpName . ' (' . $EmpIcno . '/' . $EmpDesi . ')' : '';
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
                                        <div class="row divhead" align="center">Purchase Order - Details</div>
                                    </div>
                                </div>
                                <div class="row innerdiv">
                                    <div class="row">
										@php
											$RouteUrl   = 'purchase-order.purchase-order_form';
											$ModuleCode = 'PO_ORDER';
											$ForwRejApprButtonComponentArr = \Helper::Forward_Reject_Approve_Button(NULL,$WorkFlowActionData,$BackUrl,$IndentId,$RouteUrl,$ActionStatus,$ModuleCode);
											$ButtonDetailsHTML = $ForwRejApprButtonComponentArr['HTMLSTR'];
										@endphp
											{!!$ButtonDetailsHTML!!}
                                        <div class="form-step active">
                                            {{-- ── Indent Information Fieldset ── --}}
                                        	<div class="row smclearrow"></div>
												<fieldset class="fieldbox"  >
													<legend class="fieldbox-legend">Indent Details</legend>
													<div class="fieldbox-div">
														<div class="div1 label label">Indent No./ Date</div>
														<div class="div3"><textarea name="txt_indent_created_by" id="txt_indent_created_by" class="tboxsmclass" rows="2" style="resize:none;" readonly>{{$IndentNoDate ?? ''}}</textarea></div>
														<div class="div1 label pd-l-20">Indent Title</div>
        												<div class="div3"><textarea name="txt_indent_created_by" id="txt_indent_created_by" class="tboxsmclass" rows="2" style="resize:none;" readonly>{{$IndentTittle}}</textarea></div>
														<div class="div2 label">Indent Created By  <br>(IC No / Designation)</div>
														<div class="div2"><textarea name="txt_indent_created_by" id="txt_indent_created_by" class="tboxsmclass" rows="2" style="resize:none;" readonly>{{$IndentEmpTittle ?? ''}}</textarea></div>
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
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Purchase Order  Details</legend>
												<div class="fieldbox-div">
													<div class="row smclearrow"></div>
													<div class="div4"><div class="lboxlabel">Whether the indent is processed through the GeM Portal</div>
														<input type="text" style="width:100px" name="txt_intent_no" id="txt_indent_no" class="tboxsmclass" value="{{$IsGemPortal ?? ''}}" readonly>
													</div>
													<div class="div3"><div class="lboxlabel ">PO. No. / WO. No.</div><input type="text" style="width:250px" name="txt_pur_order_no" id="txt_pur_order_no" class="tboxsmclass " value="{{$PurchaseNo ?? ''}}" readonly></div>
													<div class="div3"><div class="lboxlabel">PO. Name</div><textarea name="txt_pur_order_name" style="width:250px" id="txt_pur_order_name" class="tboxsmclass" rows="1" value ='{{$PurchaseName ?? ""}}' readonly>{{$PurchaseName ?? ''}}</textarea></div>
													<div class="div1"><div class="lboxlabel">PO. Date</div><input type="text" style="width:200px" name="txt_pur_order_date" id="txt_pur_order_date" class="tboxsmclass datepicker" value="{{ Helper::DisplayDateFormat($PoDate ?? null) }}" readonly></div>
													<div class="row smclearrow"></div>
													<div class="div2"><div class="lboxlabel ">PO. Amount</div><input type="text"style="width:100px" name="txt_pur_amt" id="txt_pur_amt" class="tboxsmclass passorderamt" value="{{$PoCost ?? ''}}" readonly></div>
													<div class="div2"><div class="lboxlabel ">GST %</div><input type="text" style="width:100px" name="txt_po_gst" id="txt_po_gst" class="tboxsmclass" value="{{$GstPerc ?? ''}}" readonly></div>
													<div class="div3"><div class="lboxlabel ">Tax on Cost</div>
														<input type="text" name="txt_intent_no" id="txt_indent_no" class="tboxsmclass"style="width:250px" value="{{$TaxName}}" readonly>
													</div>
													<div class="div3"><div class="lboxlabel">Po.cost With GST  &#8377;</div><input type="text"style="width:250px"name="hidden_total_po_amt" id="hidden_total_po_amt" class="tboxsmclass"readonly value="{{$PoTotalAmt ?? ''}}"></div>
													<div class="div2"><div class="lboxlabel ">Vendor Name</div>
														<input type="text" style="width:200px" class="tboxsmclass" value="@if(isset($ContName)){{$ContName}}@endif" readonly>
													</div>
													<div class="row smclearrow"></div>
													<div class="div2">
														<div class="lboxlabel">Work Duration</div>
														<div style="display:flex; gap:5px;">
															<input type="text" name="txt_work_duration" style="width:100px"  id="txt_work_duration" class="tboxsmclass" value="{{$WorkDur ?? ''}}"readonly>
															<input type="text" style="width:100px" class="tboxsmclass" value="{{$WorkDurMode}}" readonly>
														</div>
													</div>
													<div class="div2"><div class="lboxlabel ">Work Starting Date</div><input type="text" style="width:100px" name="txt_start_date" id="txt_start_date" class="tboxsmclass datepicker" value="{{ Helper::DisplayDateFormat($WrkStartDate ?? null) }}"readonly></div>
													<div class="div3"><div class="lboxlabel ">Work Completion Date</div><input type="text" name="txt_end_date" style="width:250px" id="txt_end_date" class="tboxsmclass " value="{{Helper::DisplayDateFormat($DateOfComp ?? null) }}" readonly></div>
													<div class="div3"><div class="lboxlabel ">Payment Mode</div>
														<input type="text" style="width:250px" class="tboxsmclass" style="width:250px" value="@if(isset($MatCertBy)){{$MatCertBy}}@endif" readonly>
													</div>
													@if(!empty($TrNO))
														<div class="div2 editpage"><div class="lboxlabel tenderlabel" >Tender No.</div><input type="text" name="txt_tender_no"style="width:200px" id="txt_tender_no" class="tboxsmclass tenderlabel" value="{{$TrNO ?? ''}}"></div> 
													@elseif(!empty($QUDate))
														<div class="div2 editpage"><div class="lboxlabel quotationlable" >Quotation Date</div><input type="text" name="txt_quotation_date" style="width:200px"id="txt_quotation_date" class="tboxsmclass datepicker quotationlable" value="{{ Helper::DisplayDateFormat($QUDate ?? null) }}"></div>
													@endif
													<div class="row smclearrow"></div>
													<div class="div4"><div class="lboxlabel" >Material Cert. By</div>
														<input type="text" name="txt_intent_no" id="txt_indent_no" class="tboxsmclass" style="width:330px"value="{{$MatCertBy}}" readonly>
													</div>
													@if(!empty($GemPoNo))
														<div class="div5 gemport"><div class="lboxlabel">GeM Po.No.</div><input type="text" name="txt_gem_po_no" style="width:250px" id="txt_gem_po_no" class="tboxsmclass " value="{{$GemPoNo ?? ''}}" ></div>
													@endif
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
																<!-- <th>Tax Type</th> -->
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
																		<!-- <td align="center">
																			@if($EditValue->tax_type == 'INC')
																				Inclusive
																			@elseif($EditValue->tax_type == 'EXCL')
																				Exclusive
																			@endif
																		</td> -->
																		<td align="right">{{$EditValue->total_cost}}</td>
																	@php $Sno  ++; 
																		$GrandTotal += $EditValue->total_cost;
																	@endphp
																@endforeach
																<tr>
																	<td colspan="6" align="right">Total Estimated Cost (Approx.)</td>
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
							<input type="hidden" name="hid_indent_id" id="hid_indent_id" value="@if(isset($IndentId)){{$IndentId}}@endif" />
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