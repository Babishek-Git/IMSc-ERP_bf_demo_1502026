@extends('layouts.dashboard-master')
@section('content')
@include('layouts.partials.messages')
@php
if(isset($EmpData)) {
    $ICNo    = collect($EmpData)->pluck('emp_no')->first();
    $EmpName = collect($EmpData)->pluck('emp_first_name')->first();
    $EmpDOB  = collect($EmpData)->pluck('emp_dob')->first();
    $EmpDOJ  = collect($EmpData)->pluck('emp_doj')->first();
    $EmpRET  = collect($EmpData)->pluck('emp_retirement_dt')->first();
    $Desig   = collect($EmpData)->pluck('designation_name')->first();
    $GroupId = collect($EmpData)->pluck('group')->first();
    $DivId   = collect($EmpData)->pluck('division_short_name')->first();
    $SecId   = collect($EmpData)->pluck('section')->first();
}
@endphp

@php
$MatTypeArr = [];
if (isset($data['MaterialTypeData'])) {
    $MaterialTypeData = $data['MaterialTypeData'];
    $MatTypeArr       = collect($MaterialTypeData)->pluck('material_type_name', 'material_type_id')->toArray();
}
if(isset($data['ProjectDetails'])){
	$ProjectDetailsArray = $data['ProjectDetails'];
}else{
	$ProjectDetailsArray = '';
}

$EmpProjectData          = $data['EmpProjectDetails'] ?? [];
$AllObectHeadData        = $data['AllObectHeadDetails'] ?? [];
$AllObectHeadSubCataData = $data['AllObectHeadSubDetails'] ?? [];
$GetMatCategoryData      = $data['GetMatCategoryData'] ?? [];

if(isset($data['ShowBudgetSanactionData'])){
	$BudgetSandata  = $data['ShowBudgetSanactionData']; 
	$SanNo          = $BudgetSandata['SANCTIONNO'] ?? '';
    $SanAmount      = $BudgetSandata['TOTSANCTIONAMT'] ?? 0;
    $TotalProjUtilAmt          = $BudgetSandata['UPTO_DATE_PROJ_UTILIZED_AMT'] ?? 0;
    $TotalProjBalanAmount      = $BudgetSandata['PROJ_BALANCE_AMT'] ?? 0;
    $OHSanAmt                  = $BudgetSandata['TOT_OH_SANCTION_AMT'] ?? 0;
    $TotalOHUtilAmt            = $BudgetSandata['UPTO_DATE_OH_UTILIZED_AMT'] ?? 0;
    $TotalOHBalanAmount        = $BudgetSandata['OH_BALANCE_AMT'] ?? 0;
    $GiaName                   = $BudgetSandata['GIA_NAME'] ?? '';
}else{
	$SanNo                  = '';
	$SanAmount              = 0;
	$TotalProjUtilAmt       = 0;
	$TotalProjBalanAmount   = 0;
	$OHSanAmt               = 0;
	$TotalOHUtilAmt         = 0;
	$TotalOHBalanAmount     = 0;
	$GiaName                = '';
}
 if(isset($data['Empdata'])){
	$Empdata  = $data['Empdata'];
	$ICNo     = collect($Empdata)->pluck('emp_no')->first();
	$EmpName  = collect($Empdata)->pluck('emp_first_name')->first();
	$EmpDOB   = collect($Empdata)->pluck('emp_dob')->first();
	$EmpDOJ   = collect($Empdata)->pluck('emp_doj')->first();
	$EmpRET   = collect($Empdata)->pluck('emp_retirement_dt')->first();
	$Desig    = collect($Empdata)->pluck('designation_name')->first();
	$GroupId  = collect($Empdata)->pluck('group')->first();
	$DivId    = collect($Empdata)->pluck('division_short_name')->first();
	$SecId    = collect($Empdata)->pluck('section')->first();
}
if(isset($data['EditIndentData'])){
	$EditIndentData     = $data['EditIndentData'];
	$IndentNo           = collect($EditIndentData)->pluck('indent_no')->first();
	$IndentDescription  = collect($EditIndentData)->pluck('indent_descripton')->first();
	//$IndentProjName     = collect($EditIndentData)->pluck('indent_pro_name')->first();
	$CreatedBy          = collect($EditIndentData)->pluck('created_by')->first();
	$IndentDate         = collect($EditIndentData)->pluck('indent_date')->first();
	$IndentId           = collect($EditIndentData)->pluck('indent_id')->first();
	$ICNo               = collect($EditIndentData)->pluck('created_by')->first();
	$ToEmpNo            = collect($EditIndentData)->pluck('to_emp_no')->first();
	$IndentProjId       = collect($EditIndentData)->pluck('project_id')->first();
	// $IndentProjName  = $ProjectDetailsArray[$IndentProjId] ?? '';
	$IndentProjName     = collect($EmpProjectData)->where('project_id', $IndentProjId)->pluck('full_heads')->first() ?? '';
	$IndentMatId        = collect($EditIndentData)->pluck('mat_type_id')->first();
	$IndentMatName      = $MatTypeArr[$IndentMatId] ?? '';
	$IsFundAvaiable     = collect($EditIndentData)->pluck('is_fund_availabile')->first();
	$CurrStatus         = collect($EditIndentData)->pluck('status')->first();
	$RegKit             = collect($EditIndentData)->pluck('reg_kit')->first();
	$ObjHeadId          = collect($EditIndentData)->pluck('object_head_id')->first();
	$ObjHeadCataId      = collect($EditIndentData)->pluck('oh_sub_cata_id')->first();
	$MatCataId          = collect($EditIndentData)->pluck('mat_categ_id')->first();
	$ObjHeadName        = $AllObectHeadData[$ObjHeadId] ?? '';
	$ObjSubCatName      = $AllObectHeadSubCataData[$ObjHeadCataId] ?? '';
	$DisplayObjName     = $ObjHeadName ?? $ObjSubCatName ?? ''; 
	$MatCatName         = collect($GetMatCategoryData)->where('material_group_id', $MatCataId)->pluck('full_heads')->first() ?? '';
	if($IsFundAvaiable === true){
		$FundYesStr = "checked";
		$FundNoStr 	= "";
	}else if($IsFundAvaiable === false){
		$FundYesStr = "";
		$FundNoStr 	= "checked";
	}else{
		$FundYesStr = "";
		$FundNoStr 	= "";
	}
}
if(isset($Empdata) && isset($data['EditIndentData'])){
	$EmpName = collect($Empdata)->where('emp_no', $ICNo)->pluck('emp_name_payslip')->first();
}
if(isset($data['ShowIndentEditDetails'])){
	$EditIndentDetailsData     = $data['ShowIndentEditDetails'];
}
$Action   = 'PROCESS';
if(isset($data['Flag'])){
	$IndentFlagData     = $data['Flag'];
}
if(isset($data['ShowMaxIndentSuffNo'])){
	$IndentMaxSufNo = $data['ShowMaxIndentSuffNo'];
}else{
	$IndentMaxSufNo = '';
}
if($IndentMaxSufNo == '' || $IndentMaxSufNo ==  NULL){
	$SuffixNo = '0001';
}else{
	$NextValue = $IndentMaxSufNo + 1;
	$SuffixNo  = str_pad($NextValue, 4, '0', STR_PAD_LEFT);
}
$FinYear     = Helper::GetCurrentFinYear(NULL);
$NewIndentNo = "IMS/P&S/" . $FinYear . "/" . $SuffixNo . "";

if(isset($data['FromPage'])){
	$FromPage     = $data['FromPage'];
}

if(isset($data['FromPage'])){
	$ActionStatus = $data['FromPage'] ?? '';
}
if(isset($data['WorkFlowActionData'])){
	$WorkFlowActionData = $data['WorkFlowActionData'];
}
if(isset($data['RetArr'])){
	$BudgetData = $data['RetArr'];
}
if($CurrStatus == 'SU'){
	$BackUrl ='indent.indent-view';
}else if($CurrStatus == 'submitted'){
	$BackUrl ='indent.indent-forward-to-accounts';
}else if($CurrStatus == 'recommended'){
	$BackUrl ='indent.indent-forward-to-accounts';
}
if(isset($data['IndentSubmitFormTittel'])){
	$FormTittel   = $data['IndentSubmitFormTittel'] ?? '';
	$PageTittle   = collect($FormTittel)->pluck('tittel_name')->first();
}else{
	$PageTittle = '';
}
$BudgetFiledAcessData  = $data['SessionWiseFiledAcessData'] ?? [];
if(isset($BudgetFiledAcessData)){
	$IsBudgetEditable  = collect($BudgetFiledAcessData)->pluck('is_editable')->first() ?? '';
}
@endphp
<style>
	/* .SearchItemMenu {
		background: rgba(255, 255, 255, 0.2);
		backdrop-filter: blur(5px);
		border: 1px solid rgba(204, 93, 7, 0.5);
		color: #007bff;
		border-radius: 12px;
		padding: 3px 10px;
		font-size: 11px;
		cursor: pointer;
		display: inline-block; 
	} */
	 /* .SearchItemMenu {
  display: inline-flex; align-items: center; gap: 5px;
  background: #185FA5; color: #fff;
  border: none; border-radius: 6px;
  padding: 3px 10px; font-size: 11px; cursor: pointer; font-weight: 500;
}
.SearchItemMenu:hover { background: #0C447C; } */
	.SearchItemMenu {
		display: inline-flex;
		align-items: center;
		gap: 6px;

		background: #FFF4E5;              /* light warm background */
		color: #B26A00;                   /* amber text */

		border: 1px solid #F2C27B;        /* soft amber border */
		border-radius: 20px;              /* pill shape */

		padding: 4px 12px;
		font-size: 12px;
		font-weight: 500;

		cursor: pointer;
		transition: all 0.2s ease;
	}

	.SearchItemMenu:hover {
		background: #FFE8CC;              /* slightly darker hover */
		border-color: #E0A95C;
		color: #8A4F00;
	}
	
</style>
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
                                        <div class="row divhead" align="center">{{$PageTittle}}</div>
                                    </div>
                                </div>
                                <div class="row innerdiv">
                                    <div class="row">
										@php
											$RouteUrl   = 'indent.indent-creation';
											$ModuleCode = 'INDENT';
											$ForwRejApprButtonComponentArr = \Helper::Forward_Reject_Approve_Button(NULL,$WorkFlowActionData,$BackUrl,$IndentId,$RouteUrl,$ActionStatus,$ModuleCode);
											$ButtonDetailsHTML = $ForwRejApprButtonComponentArr['HTMLSTR'];
										@endphp
											{!!$ButtonDetailsHTML!!}
                                        <div class="form-step active">
                                            {{-- ── Indent Information Fieldset ── --}}
                                        	<div class="row smclearrow"></div>
												<fieldset class="fieldbox"  >
													<legend class="fieldbox-legend" style ='top-padding : 10%'>Indent Details</legend>
													<div class="fieldbox-div">
														<div class="div2 label label">Indent No.</div>
														<div class="div2"><input type="text" name="txt_intent_no" id="txt_indent_no" class="tboxsmclass" value="@if(isset($IndentNo)){{$IndentNo}}@else {{$NewIndentNo}}@endif" readonly></div>  
														<div class="div2 label pd-l-20">Indent Date </div>
														<div class="div2"><input type="text" name="txt_intent_date" id="txt_indent_date" class="tboxsmclass " value="@if(isset($IndentDate)){{Helper::DisplayDateFormat($IndentDate)}}@endif" readonly></div>
														<div class="div2 label pd-l-20">Indent Created By  <br>(IC No / Designation)</div>
        												<div class="div2"><textarea name="txt_indent_created_by" id="txt_indent_created_by" class="tboxsmclass" rows="2" style="resize:none;" readonly>@if(isset($EmpName)){{ $EmpName }}  ({{ isset($ICNo) ? $ICNo : '' }} / {{ isset($Desig) ? $Desig : '' }})@endif</textarea></div>
														<div class="row smclearrow"></div>
														<div class="div2 label label">Indent Title</div>
														<div class="div2 ">
															<textarea name="txt_intent_det" id="txt_intent_det" class="tboxsmclass"readonly>@if(isset($IndentDescription)){{$IndentDescription}}@endif </textarea>
														</div>
														<div class="div2 label pd-l-20">Material Type</div>
														<div class="div2" style="display:flex; align-items:center; gap:10px;">
															<input type="text" style="width:250px" class="tboxsmclass" value="{{ $IndentMatName ?? '' }}" readonly>
														</div>
														<input type="hidden" id ='hidd_mat_typ_id' name ='hidd_mat_typ_id' value="@if(isset($IndentMatId)){{$IndentMatId}}@endif" >
														<div class="div2 label pd-l-20">Indent For Registration Kit</div>
														<div class="div1"><input type="text" class="tboxsmclass" value="{{ $RegKit ?? '' }}" readonly></div>
														<div class="row smclearrow"></div>
														@if(filled($IndentProjName) && $IndentProjName !=NULL)
															<div class="div2 label ">Project Name</div>
															<div class="div2">
																<textarea name="txt_indent_created_by" id="txt_indent_created_by" class="tboxsmclass" rows="4" style="resize:none;"  readonly>{{$IndentProjName ?? ''}}</textarea>
															</div>
															@if(filled($DisplayObjName))
																<div class="div2 label pd-l-20">Object Head Select by Faculty</div>
																<div class="div2"><input type="text" style="width:100%" class="tboxsmclass" value="{{ $DisplayObjName }}" readonly></div>
															@endif
															<div class="div2 label  pd-l-20">Material Category</div>
															<div class="div2">
																<textarea name="txt_indent_created_by" id="txt_indent_created_by" class="tboxsmclass" rows="4" style="resize:none;"  readonly>{{$MatCatName}}</textarea>
															</div>
															@if(isset($data['ItemRateFieldAccess']) && $data['ItemRateFieldAccess'] == 'Y')
															<div class="div2 label ">Consumable Item Search</div>
																<div class="div2">
																	<span class="SearchItemMenu Search"> <i class="fa fa-search"></i> Search </span>
																</div>
																
															@endif
														@else
															<div class="row smclearrow"></div>
															@if(filled($DisplayObjName))
																<div class="div2 label ">Object Head Select by Faculty</div>
																<div class="div2"><input type="text" style="width:100%" class="tboxsmclass" value="{{ $DisplayObjName }}" readonly></div>
															@endif
															<div class="div2 label  pd-l-20">Material Category</div>
															<div class="div2">
																<textarea name="txt_indent_created_by" id="txt_indent_created_by" class="tboxsmclass" rows="4" style="resize:none;"  readonly>{{$MatCatName}}</textarea>
															</div>
															@if(isset($data['ItemRateFieldAccess']) && $data['ItemRateFieldAccess'] == 'Y')
															<div class="div2 label pd-l-20">Consumable Item Search</div>
																<div class="div2">
																	<span class="SearchItemMenu Search"> <i class="fa fa-search"></i> Search </span>
																</div>
																
															@endif
														@endif
														<!-- <div class="div2">
															<textarea name="txt_project_name" id="txt_project_name" class="tboxsmclass">@if(isset($IndentProjName)){{$IndentProjName}}@endif</textarea>
														</div> -->
														<!-- <div class="div2 label label">Indent Title</div>
														<div class="div2"><input type="text" style="width:625px" name="txt_intent_det" id="txt_intent_det" class="tboxsmclass" value="@if(isset($IndentDescription)){{$IndentDescription}}@endif" ></div>
														<div class="row smclearrow"></div>
														<div class="div2 label label">Project Name</div>
														<div class="div2"><input type="text" style="width:625px" name="txt_project_name" id="txt_project_name" class="tboxsmclass" value="@if(isset($IndentProjName)){{$IndentProjName}}@endif" ></div> -->
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
													</div>
												</fieldset>                                                           											
                                            </div>
                                            <div class="row smclearrow"></div>
                                            <div class="row smclearrow"></div>
                                            {{-- ── INDENT Information Table ── --}}
											@if(isset($data['ItemRateFieldAccess']) && $data['ItemRateFieldAccess'] == 'Y')
												<div class="table-container">
													<div class="table-wrapper">
														<div class="section-header">
															<span>Item Details of Required Items </span>
														</div>
														<table class="formtable" disabled width="100%">
															<thead>
																<tr>
																	<th rowspan="2">S.No.</th>
																	<!-- <th rowspan="2">Type Of Material</th> -->
																	<th rowspan="2" style="text-align: center;">
																		A complete description of Goods/Services intended to be procured
																	</th>
																	<th rowspan="2">Qty <br> (Q1)</th>
																	<th rowspan="2">Unit</th>
																	<th colspan="2" style="text-align:center;">
																		Unit Price <br>(Rs.)
																		<!-- <span style="float:right;">
																			<span class="SearchItemMenu">
																				<i class="fa fa-search"></i> Search
																			</span>
																		</span> -->
																	</th>
																	<th rowspan="2"> Amount (A)<br> Rs. <br> A = Q1 × (R1 / R2)</th>
																	<!-- <th rowspan="2">GST %</th> -->
																	<th rowspan="2">Tax Type</th>
																	<th rowspan="2">Total cost <br>with tax <br> (Approx.)</th>
																</tr>
																<tr>
																	<th style="text-align:center;">Rate <br> (Indentor  Entered Rate)  <br>(R1) </th>
																	<th style="text-align:center;">Rate <br> (As per the rate contract) <br>(R2)</th>
																</tr>
																</thead>
															<tbody >
																@if(isset($data['ShowIndentEditDetails']))
																	@php 
																		$EditIndentDetailsData = $data['ShowIndentEditDetails']; 
																		$IndentId              = collect($EditIndentDetailsData)->pluck('indent_id')->first();
																		$Sno        = 1;
																		$GrandTotal = 0;
																	@endphp
																	@foreach($EditIndentDetailsData as $EditValue)
																		<tr>
																			<td align="center">{{$EditValue->item_no}}</td>
																			<input type="hidden" id='txt_sno{{$Sno}}' name = "txt_sno[]" value ='{{$EditValue->item_no}}' >
																			<input type="hidden" id="hidd_cous_item_avable" name="hidd_cous_item_avable" value="{{ $data['ItemRateFieldAccess'] }}">
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
																			<input type="hidden" id='txt_item_goods_service_name_{{$Sno}}' name = "txt_item_goods_service_name[]" value ='{{$EditValue->item_description}}'>
																			<td align="center">{{$EditValue->quantity}}</td>
																			<input type="hidden"  name="txt_item_quantity_req_name[]" id="txt_item_quantity_req_name_{{$Sno}}" data-index="{{$Sno}}" value ='{{$EditValue->quantity}}'>
																			<td align="center">
																				<input type="hidden" name="txt_unit[]" id="txt_unit" value ='{{$EditValue->unit_id}}'>
																				@foreach($data['ShowMaterialUnit'] as $MaterialUnitData)
																					@if($MaterialUnitData->uom_id == $EditValue->unit_id)
																						{{$MaterialUnitData->uom_name}}
																					@endif
																				@endforeach
																			</td>
																			<td align="center" >{{$EditValue->estimated_unit_price}}</td>
																			<input type="hidden" name="txt_item_estimate_no[]" id="txt_item_rate{{$Sno}}" data-index="{{$Sno}}"   value="{{$EditValue->estimated_unit_price}}">
																			<td><input type="text" style="width:100%" name="txt_cont_item_rate[]" id="txt_cont_item_rate_{{$Sno}}" data-index="{{$Sno}}"  class="tboxsmclass decimalnum contrate" value="0"></td>
																			<!-- <td align="center">{{$EditValue->estimated_unit_price}}</td> -->
																			 <!-- <td <input type="text" style="width:50%" name="txt_item_quantity_req_name[]" id="txt_item_quantity_req_name_{{$Sno}}" data-index="{{$Sno}}"  class="tboxsmclass decimalnum itemqty" value="{{$EditValue->estimated_unit_price}}"></td> -->
																			<!-- <td align="center">{{$EditValue->gst_rate}}</td> -->
																			<td align="center" class ='row-amount' id="txt_display_item_amount_{{$Sno}}">{{$EditValue->item_amount}}</td>
																			<input type="hidden" name="txt_item_amout[]" id="txt_item_amount_{{$Sno}}" data-index="{{$Sno}}" value ='{{$EditValue->item_amount}}'>
																			<td align="center"name="tax_display_type_text[]"  id="tax_display_type_text_{{$Sno}}" value ='{{$EditValue->tax_type}}'>
																				@if($EditValue->tax_type == 'INC')
																					Inclusive
																				@elseif($EditValue->tax_type == 'EXCL')
																					Exclusive
																				@endif
																			</td>
																			<input type="hidden" name="cmb_tax_type[]"  id="tax_type_text_{{$Sno}}" value ='{{$EditValue->tax_type}}'>
																			<td align="right" name="txt_display_total_amount_[]" id="txt_display_total_amount_{{$Sno}}" data-index="{{$Sno}}" value =''>{{$EditValue->total_cost}}</td>
																			<input type="hidden" name="txt_item_total_cost[]" id="txt_total_amount_{{$Sno}}" data-index="{{$Sno}}" value ='{{$EditValue->total_cost}}'>
																		@php $Sno  ++; 
																			$GrandTotal += $EditValue->total_cost;
																		@endphp
																	@endforeach
																	<tr>
																		<td colspan="8" align="right">Total Estimated Cost (Approx.)</td>
																		<td align="right" id ='grand_total_display'>{{$GrandTotal}}</td>
																		<input type="hidden" name="hidd_total_amt" id="hidd_total_amt" value ='{{$GrandTotal}}'>
																	</tr>
																	

																@else
																	<tr>
																		<td align="center" colspan="8">No records found</td>
																	</tr>
																	
																@endif
																<!-- @if(($FromPage == 'FORWARD') || $ToEmpNo == '')
																	<tr>
																		<td colspan="9">
																			<div class="label">Enter Your Feedback / Remarks Here</div>
																			<textarea name="txt_action_remarks" id="txt_action_remarks" class="tboxsmclass" rows="4"></textarea>
																		</td>
																	</tr>
																	<tr>
																		<td colspan="9">
																			<div class="div1 label "> Action</div>
																			<div class="div2">
																				<select name="cmb_action[]" id="cmb_action" class="tboxsmclass">
																					@if(session('WcmsEmpNo') == $ICNo)
																						<option value="SUBMIT">Submit</option>
																					@else
																						<option value=""> -- Select --</option>
																						<option value="APPROVE">Approve</option>
																						<option value="REJECT">Reject</option>
																					@endif
																				</select>
																			</div>
																		</td>
																	</tr>
																@endif	 -->
															</tbody>
														</table>
														<div style="margin-top:5px;" class ='label'>
															<span class="reqindi"><strong>Note:</strong></span>
															Amount (A) is calculated based on applicable rate (R1 or R2).
														</div>
													</div>
                                            	</div>
											@else
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
																	<th>Qty <br>(Q1)</th>
																	<th>Unit</th>
																	<th>Unit Price<br>Rs. <br>(R1)</th>
																	<th>Amount (A)<br> Rs. <br> (A = Q1 * R1)</th>
																	<!-- <th>GST %</th> -->
																	<th>Tax Type</th>
																	<th>Total cost <br>with tax <br> (Approx.)</th>
																</tr>
															</thead>
															<tbody >
																@if(isset($data['ShowIndentEditDetails']))
																	@php 
																		$EditIndentDetailsData = $data['ShowIndentEditDetails']; 
																		$IndentId              = collect($EditIndentDetailsData)->pluck('indent_id')->first();
																		$Sno        = 1;
																		$GrandTotal = 0;
																	@endphp
																	@foreach($EditIndentDetailsData as $EditValue)
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
																		<input type="hidden" name="hidd_total_amt" id="hidd_total_amt" value ='{{$GrandTotal}}'>
																	</tr>
																@else
																	<tr>
																		<td align="center" colspan="8">No records found</td>
																	</tr>
																@endif
																<!-- @if(($FromPage == 'FORWARD') || $ToEmpNo == '')
																	<tr>
																		<td colspan="9">
																			<div class="label">Enter Your Feedback / Remarks Here</div>
																			<textarea name="txt_action_remarks" id="txt_action_remarks" class="tboxsmclass" rows="4"></textarea>
																		</td>
																	</tr>
																	<tr>
																		<td colspan="9">
																			<div class="div1 label "> Action</div>
																			<div class="div2">
																				<select name="cmb_action[]" id="cmb_action" class="tboxsmclass">
																					@if(session('WcmsEmpNo') == $ICNo)
																						<option value="SUBMIT">Submit</option>
																					@else
																						<option value=""> -- Select --</option>
																						<option value="APPROVE">Approve</option>
																						<option value="REJECT">Reject</option>
																					@endif
																				</select>
																			</div>
																		</td>
																	</tr>
																@endif	 -->
															</tbody>
														</table>
													</div>
                                            	</div>
											@endif
											<div class="row smclearrow"></div>
											 {{-- ── INDENT Budget Information Table ── --}}
											 @if(isset($data['BudegtFieldAccess']) && $data['BudegtFieldAccess'] == 'Y')
											 	<?php 
													// $Total       = $IndentApprTotalAmt + $POIssudeTotalAmt;
													// $BalanceAmt  = $SanAmount - $Total;
													$ProjBalanAmt    = $TotalProjBalanAmount;
													$BalanceAmt      = $TotalOHBalanAmount;
													if ($BalanceAmt >= $GrandTotal) {
														$OBHeadFundStatus = true;
													} else {
														$OBHeadFundStatus = false;
													}
													if ($ProjBalanAmt >= $GrandTotal) {
														$ProjFundStatus = true;
													} else {
														$ProjFundStatus = false;
													}
													if ($OBHeadFundStatus == false && $ProjFundStatus == false) {
														$FundStatus = 'NO';
													} else {
														$FundStatus = 'YES';
													}
													if($IndentProjName == ''){
														$TableHeadTittel = 'Gia Name / (Object Head name)';
														  $ProjOhGiaName = $GiaName .'<br><strong>' . $DisplayObjName . '</strong>';
													}else{
														$TableHeadTittel = 'Project Name / (Object Head name)';
														$ProjOhGiaName = $IndentProjName .'<br><strong>' . $DisplayObjName . '</strong>';
													}
												?>
											 <input type="hidden" name ='hidd_buget_apr' id ='hidd_buget_apr' value='{{$data["BudegtFieldAccess"]}}'>
											 <input type="hidden" name ='hidd_fund_avable' id ='hidd_buget_apr' value='{{$FundStatus}}'>
												<div class="table-container">
													<div class="table-wrapper">
														<div class="section-header">
															<span>Budget Details</span>
														</div>
														@if($OBHeadFundStatus)
															<table class="formtable" disabled width="100%">
																<thead>
																	<tr>
																		<th rowspan="2">{{$TableHeadTittel ?? ''}}</th>  
																		<th colspan="4" style="text-align:center;">Projectwise Budget Sanction Details</th>  
																		<th colspan="3" style="text-align:center;">Object Head Wise Sanction Details</th>  
																		<th rowspan="2" style="text-align:center;">Object Head Wise<br>Fund Availability</th>
																	</tr>
																	<tr>
																		<th style="text-align:center;">Sanction No.</th>
																		<th style="text-align:center;">Sanction Amount <br>Rs.</th>
																		<th style="text-align:center;">Up to date utilized Amount <br>Rs.</th>
																		<th style="text-align:center;">Balance Amount <br>Rs.</th>
																		<th style="text-align:center;">Sanction Amount <br>Rs.</th>
																		<th style="text-align:center;">Up to date utilized Amount <br>Rs.</th>
																		<th style="text-align:center;">Balance Amount <br>Rs.</th>
																	</tr>
																</thead>
																<tbody>		
																	<tr>
																		<td>{!! $ProjOhGiaName ?? '' !!}</td>
																		<td>@if(isset($SanNo)){{$SanNo}}@endif</td>
																		<td style="text-align: Right;">@if(isset($SanAmount)){{$SanAmount}}@endif</td>
																		<td style="text-align: Right;">@if(isset($TotalProjUtilAmt)){{$TotalProjUtilAmt}}@endif</td>
																		<td style="text-align: Right;">@if(isset($TotalProjBalanAmount)){{$TotalProjBalanAmount}}@endif</td>
																		<td style="text-align: Right;">@if(isset($OHSanAmt)){{$OHSanAmt}}@endif</td>
																		<td style="text-align: Right;">@if(isset($TotalOHUtilAmt)){{$TotalOHUtilAmt}}@endif</td>
																		<td style="text-align: Right;">@if(isset($TotalOHBalanAmount)){{$TotalOHBalanAmount}}@endif</td>
																		<!-- <td >{{$GrandTotal}}</td> -->
																		<td style="text-align: center;">
																			@if($OBHeadFundStatus)
																				<button class="btn btn-success btn-sm"><i class="fa fa-check"></i>YES</button>
																			@else
																				<button class="btn btn-danger btn-sm"><i class="fa fa-times"></i>NO</button>
																			@endif
																		</td>
																	</tr>
																	<tr>
																		<td align="left" colspan="1" >Whether DCA Certified that the Allocation exists for the above Amount <span class="reqindi">*</span> </td>
																		<!-- <td align="left" colspan="1" style="font-weight:bold; color:red;">Whether DCA Certified that the Allocation exists for the above Amount * </td> -->
																		<td colspan="2">
																			<div class="div5 no-margin" style="margin-right: 10px;">  
																				<div class="inputGroup paddlr2">
																					<input id="rad_yes" name="rad_Basis" type="radio" value="yes" @if(isset($FundYesStr)){{ $FundYesStr }}@endif @if(!$IsBudgetEditable) disabled @endif/>
																					<label for="rad_yes" style="padding:3px 0px; width:100%"> &nbsp;Yes</label>
																				</div>
																			</div>
																			<div class="div5 no-margin">
																				<div class="inputGroup paddlr2">
																					<input id="rad_no" name="rad_Basis" type="radio" value="No" @if(isset($FundNoStr)){{ $FundNoStr }}@endif @if(!$IsBudgetEditable) disabled @endif/>
																					<label for="rad_no" style="padding:3px 0px; width:100%"> &nbsp;No</label>
																				</div>
																			</div>
																		</td>
																		<td colspan="6"></td>
																	</tr>
																</tbody>
															</table>
														@else
															<table class="formtable" disabled width="100%">
																<thead>
																	<tr>
																		<th rowspan="2">{{$TableHeadTittel ?? ''}}</th>  
																		<th colspan="4" style="text-align:center;">Projectwise Budget Sanction Details</th>  
																		<th colspan="3" style="text-align:center;">Object Head Wise Sanction Details</th>  
																		<th rowspan="2" style="text-align:center;">Object Head Wise<br>Fund Availability</th>
																		<th rowspan="2" style="text-align:center;">Project wise<br>Fund Availability</th>
																	</tr>
																	<tr>
																		<th style="text-align:center;">Sanction No.</th>
																		<th style="text-align:center;">Sanction Amount <br>Rs.</th>
																		<th style="text-align:center;">Up to date utilized Amount <br>Rs.</th>
																		<th style="text-align:center;">Balance Amount <br>Rs.</th>
																		<th style="text-align:center;">Sanction Amount <br>Rs.</th>
																		<th style="text-align:center;">Up to date utilized Amount <br>Rs.</th>
																		<th style="text-align:center;">Balance Amount <br>Rs.</th>
																	</tr>
																</thead>
																<tbody>		
																	<tr>
																		<td>{!! $ProjOhGiaName ?? '' !!}</td>
																		<td>@if(isset($SanNo)){{$SanNo}}@endif</td>
																		<td style="text-align: Right;">@if(isset($SanAmount)){{$SanAmount}}@endif</td>
																		<td style="text-align: Right;">@if(isset($TotalProjUtilAmt)){{$TotalProjUtilAmt}}@endif</td>
																		<td style="text-align: Right;">@if(isset($TotalProjBalanAmount)){{$TotalProjBalanAmount}}@endif</td>
																		<td style="text-align: Right;">@if(isset($OHSanAmt)){{$OHSanAmt}}@endif</td>
																		<td style="text-align: Right;">@if(isset($TotalOHUtilAmt)){{$TotalOHUtilAmt}}@endif</td>
																		<td style="text-align: Right;">@if(isset($TotalOHBalanAmount)){{$TotalOHBalanAmount}}@endif</td>
																		<!-- <td >{{$GrandTotal}}</td> -->
																		<td style="text-align: center;">
																			@if($OBHeadFundStatus)
																				<button class="btn btn-success btn-sm"><i class="fa fa-check"></i>YES</button>
																			@else
																				<button class="btn btn-danger btn-sm"><i class="fa fa-times"></i>NO</button>
																			@endif
																		</td>
																		<td style="text-align: center;">
																			@if($ProjFundStatus)
																				<button class="btn btn-success btn-sm"><i class="fa fa-check"></i>YES</button>
																			@else
																				<button class="btn btn-danger btn-sm"><i class="fa fa-times"></i>NO</button>
																			@endif
																		</td>
																	</tr>
																	<tr>
																		<td align="left" colspan="1" >Whether DCA Certified that the Allocation exists for the above Amount <span class="reqindi">*</span> </td>
																		<!-- <td align="left" colspan="1" style="font-weight:bold; color:red;">Whether DCA Certified that the Allocation exists for the above Amount * </td> -->
																		<td colspan="3">
																			<div class="div5 no-margin" style="margin-right: 10px;">  
																				<div class="inputGroup paddlr2">
																					<input id="rad_yes" name="rad_Basis" type="radio" value="yes" @if(isset($FundYesStr)){{ $FundYesStr }}@endif @if(!$IsBudgetEditable) disabled @endif/>
																					<label for="rad_yes" style="padding:3px 0px; width:100%"> &nbsp;Yes</label>
																				</div>
																			</div>
																			<div class="div5 no-margin">
																				<div class="inputGroup paddlr2">
																					<input id="rad_no" name="rad_Basis" type="radio" value="No" @if(isset($FundNoStr)){{ $FundNoStr }}@endif @if(!$IsBudgetEditable) disabled @endif/>
																					<label for="rad_no" style="padding:3px 0px; width:100%"> &nbsp;No</label>
																				</div>
																			</div>
																		</td>
																		<td colspan="6"></td>
																	</tr>
																</tbody>
															</table>
														@endif
														
													</div>
												</div>
											@endif	
                                            {{-- ── INDENT Forward Table ── --}}
											@if($ActionStatus == 'PROCESS' && count($WorkFlowActionData) > 0)
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
												<!-- <div class="table-container">
													<div class="table-wrapper">
														<table class="attTable" disabled>
															<tbody >
																@if(($FromPage == 'FORWARD') || $ToEmpNo == '' )
																	<tr>
																		<td colspan="9">
																			<div class="div1 label "> Action :  </div>
																			<div class="div2">
																				<select name="cmb_action[]" id="cmb_action" class="tboxsmclass">
																					@if(session('WcmsEmpNo') == $ICNo)
																						<option value="SU">Submit</option>
																					@else
																						@if($SessionRoleName == 'Purchase & Stores administrator')
																							<option value=""> -- Select --</option>
																							<option value="FW">Forward to Accounts Section for Budget Approval</option>
																							<option value="BW">Decline / Return Back with Reason</option>
																						@elseif($SessionRoleName == 'Registrar')
																							<option value=""> -- Select --</option>
																							<option value="FW">Approved & Freezed</option>
																							<option value="BW">Reject</option>
																						@else
																							<option value=""> -- Select --</option>
																							<option value="FW">Approve</option>
																							<option value="BW">Reject</option>
																						@endif
																					@endif
																				</select>
																			</div>
																		</td>
																	</tr>
																	<tr>
																		<td colspan="9">
																			<div class="label">Enter Your Feedback / Remarks Here</div>
																			<textarea name="txt_action_remarks" id="txt_action_remarks" class="tboxsmclass" rows="4"></textarea>
																		</td>
																	</tr>
																@endif	
																	<tr>
																		<td colspan="9">
																			<div class="label">Enter Your Feedback / Remarks Here</div>
																			<textarea name="txt_action_remarks" id="txt_action_remarks" class="tboxsmclass" rows="4"></textarea>
																		</td>
																	</tr>
															</tbody>
														</table>
													</div>
												</div> -->
											@endif
                                        </div>{{-- /form-step --}}
                                    </div>
									<!-- <div class="row" align="center">
                                        @if($ActionStatus == 'PROCESS')
                                        @php 
                                        $IsApprove  = $WorkFlowActionData['IsApprove'] ?? NULL;
                                        $IsNext     = $WorkFlowActionData['IsNext'] ?? NULL;
                                        $IsPrevious = $WorkFlowActionData['IsPrevious'] ?? NULL;
                                        @endphp
                                        @if($IsPrevious == 'Y')
                                        <button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="RJ" class="step-btn WorkFlowAction" value="REJECT">Reject</button> -->
                                        <!-- <button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="BW" class="step-btn WorkFlowAction" value="RETURN">Return Back</button> -->
                                        <!-- @endif
                                        @if($IsApprove == 'Y')
                                        <button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="AP" class="step-btn WorkFlowAction" value="APPROVE">Approve</button>
                                        @endif

                                        @if(($IsApprove == NULL) && ($IsNext == 'Y'))
                                        <button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="FW" class="step-btn WorkFlowAction" value="FORWARD">Recommend / Forward</button>
                                        @endif -->

                                        <!-- @if(($IsApprove == 'Y') && ($IsNext == 'Y'))
                                        <button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="AP_FW" class="step-btn WorkFlowAction" value="APPROVE_FORWARD">Approve & Forward</button>
                                        @elseif(($IsApprove == 'Y') && ($IsNext == NULL))
                                        <button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="AP" class="step-btn" value="APPROVE">Approve</button>
                                        @elseif(($IsApprove == NULL) && ($IsNext == 'Y'))
                                        <button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="FW" class="step-btn WorkFlowAction" value="FORWARD">Recommend / Forward</button>
                                        @endif -->
										
                                        <!-- @if(($WorkFlowActionData['WorkFlowAction'] ?? null) === 'SU')
                                        	<input type="button" class="backbutton"  name="btn_edit" id="btn_edit" value=" Edit "onclick="window.location='{{ route('indent.indent-creation', ['page'=>encrypt('EDIT'),'EditId'=>encrypt($IndentId),'modulecode'=>encrypt('INDENT')])}}'" />
                                       	 	<button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="SU" class="step-btn WorkFlowAction" value="SUBMIT">Submit</button>
                                        @endif

                                        @endif
                                        <input type="button" class="backbutton" name="back" id="back" value=" Back " onClick="window.location='{{route($BackUrl)}}'" />
                                    </div> -->

                                    <!-- <div class="row" align="center">
                                       @if($FromPage == 'FORWARD')
                                        	 <button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="SU" class="step-btn WorkFlowAction" value="Save">Submit</button>
                                        	<input type="button" class="backbutton" name="back" id="back" value=" Back " onClick="window.location='{{route($BackUrl)}}'" />
										@else
											@if($ToEmpNo == '')
												<button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="SU" class="step-btn WorkFlowAction" value="Save">Submit</button>
                                        		<input type="button" class="backbutton"  name="btn_edit" id="btn_edit" value=" Edit "onclick="window.location='{{ route('indent.indent-creation', ['page'=>encrypt('EDIT'),'EditId'=>encrypt($IndentId),'modulecode'=>encrypt('INDENT')])}}'" />
											@endif
                                        		<input type="button" class="backbutton" name="back" id="back" value=" Back " onClick="window.location='{{route($BackUrl)}}'" />
                                        @endif
                                    </div> -->
                                    <div class="row smclearrow"></div>
                                    <div class="row smclearrow"></div>
                                </div>{{-- /innerdiv --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
						<div class="div12" align="center">
							<input type="hidden" name="hid_current_status" id="hid_current_status" value="@if(isset($CurrStatus)){{$CurrStatus}}@endif" />
							<input type="hidden" name="hid_indent_id" id="hid_indent_id" value="@if(isset($IndentId)){{$IndentId}}@endif" />
							<input type="hidden" name="txt_application_id" id="txt_application_id" value="@if(isset($IndentId)){{ encrypt($IndentId) }}@endif">
							<input type="hidden" name="txt_action" id="txt_action" value="@if(isset($Action)){{ encrypt($Action) }}@endif">
							<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
							<input type="hidden" name="wf_module_code" id="wf_module_code" value="{{ encrypt('INDENT') }}" />
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
@include('common-workflow.workflow-process')

@endsection