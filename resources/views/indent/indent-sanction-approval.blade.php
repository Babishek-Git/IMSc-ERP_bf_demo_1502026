@extends('layouts.dashboard-master')
@section('content')
@include('layouts.partials.messages')
@php
$EmpDetails = $data['Empdata'] ?? [];
$MatTypeArr = $data['MaterialTypeDrtailsArray'] ?? [];
$ProjectDetailsArray     = $data['ProjectDetails'] ?? [];
$EmpProjectData          = $data['EmpProjectDetails'] ?? [];
$AllObectHeadData        = $data['AllObectHeadDetails'] ?? [];
$AllObectHeadSubCataData = $data['AllObectHeadSubDetails'] ?? [];
$GetMatCategoryDetails   = $data['GetMatCategoryData'] ?? [];

if(isset($data['ShowBudgetSanactionData'])){
	$BudgetSandata  = $data['ShowBudgetSanactionData']; 
	$SanNo          = $BudgetSandata['SANCTIONNO'] ?? '';
    $SanAmount      = $BudgetSandata['TOTSANCTIONAMT'] ?? 0;
    $TotalProjUtilAmt          = $BudgetSandata['UPTO_DATE_PROJ_UTILIZED_AMT'] ?? 0;
    $TotalProjBalanAmount      = $BudgetSandata['PROJ_BALANCE_AMT'] ?? 0;
    $OHSanAmt                  = $BudgetSandata['TOT_OH_SANCTION_AMT'] ?? 0;
    $TotalOHUtilAmt            = $BudgetSandata['UPTO_DATE_OH_UTILIZED_AMT'] ?? 0;
    $TotalOHBalanAmount        = $BudgetSandata['OH_BALANCE_AMT'] ?? 0;
}else{
	$SanNo              = '';
	$SanAmount          = 0;
	$TotalProjUtilAmt   = 0;
	$TotalProjBalanAmount   = 0;
	$OHSanAmt               = 0;
	$TotalOHUtilAmt         = 0;
	$TotalOHBalanAmount     = 0;
}
if(isset($data['IndentDetails'])){
	$IndentData     = $data['IndentDetails'];
	$IndentNo           = collect($IndentData)->pluck('indent_no')->first();
	$IndentDescription  = collect($IndentData)->pluck('indent_descripton')->first();
	$CreatedBy          = collect($IndentData)->pluck('created_by')->first();
	$IndentDate         = collect($IndentData)->pluck('indent_date')->first();
	$IndentId           = collect($IndentData)->pluck('indent_id')->first();
	$ICNo               = collect($IndentData)->pluck('created_by')->first();
	$ToEmpNo            = collect($IndentData)->pluck('to_emp_no')->first();
	$IndentProjId       = collect($IndentData)->pluck('project_id')->first();
	$IndentProjName     = $EmpProjectData[$IndentProjId] ?? '';
	$IndentMatId        = collect($IndentData)->pluck('mat_type_id')->first();
	$IndentMatName      = $MatTypeArr[$IndentMatId] ?? '';
	$IsFundAvaiable     = collect($IndentData)->pluck('is_fund_availabile')->first();
	$CurrStatus         = collect($IndentData)->pluck('status')->first();
	$RegKit             = collect($IndentData)->pluck('reg_kit')->first();
	$ObjHeadId          = collect($IndentData)->pluck('object_head_id')->first();
	$ObjHeadCataId      = collect($IndentData)->pluck('oh_sub_cata_id')->first();
	$MatCataId          = collect($IndentData)->pluck('mat_categ_id')->first();
	$ObjHeadName        = $AllObectHeadData[$ObjHeadId] ?? '';
	$ObjSubCatName      = $AllObectHeadSubCataData[$ObjHeadCataId] ?? '';
	$DisplayObjName     = $ObjHeadName ?? $ObjSubCatName ?? ''; 
	$MatCatName         = collect($GetMatCategoryDetails)->where('material_group_id', $MatCataId)->pluck('full_heads')->first() ?? '';
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
if(isset($EmpDetails) && isset($data['IndentDetails'])){
    $EmpData = collect($EmpDetails)->where('emp_no', $CreatedBy)->first();
    $ICNo    = $EmpData->emp_no ?? '';
    $Desig   = $EmpData->designation_name ?? '';
    $EmpName = $EmpData->emp_name_payslip ?? '';
}
$BackUrl ='indent.approved-indent-sanction-list';
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
                                        <div class="row divhead" align="center">Indent Details</div>
                                    </div>
                                </div>
                                <div class="row innerdiv">
									<div class="row row-fluid line-control-menu-bar formtitlebar" style="border:none">
										<div class="btn-group floatr">
											<button type="button" class="btn btn-default btnprimary" title="Back" name="back" id="back" value=" BACK "   onclick="window.location='{{ route($BackUrl) }}'"><i class="fa fa-arrow-circle-o-left pt2"></i> Back</button>
										</div>
										<div class="btn-group floatr">
											<button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="SU"  class="btn btn-default btninfo " value="SUBMIT" data-flag="SU"><i class="fa fa-arrow-circle-right pt2"></i> Submit for Processing </button>
               							</div>
               						</div>
                                    <div class="row">
										
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
															@if(isset($data['ItemRateFieldAccess']) && $data['ItemRateFieldAccess'] == 'Y')
																<span class="SearchItemMenu Search"> <i class="fa fa-search"></i> Search </span>
															@endif
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
															@if(isset($data['ShowIndentDetials']))
																@php 
																	$IndentDetailsData = $data['ShowIndentDetials']; 
																	$IndentId              = collect($IndentDetailsData)->pluck('indent_id')->first();
																	$Sno        = 1;
																	$GrandTotal = 0;
																@endphp
																@foreach($IndentDetailsData as $EditValue)
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
											 {{-- ── INDENT Budget Information Table ── --}}
											 @if(isset($data['BudegtFieldAccess']) && $data['BudegtFieldAccess'] == 'Y')
											 <input type="hidden" name ='hidd_buget_apr' id ='hidd_buget_apr' value='{{$data["BudegtFieldAccess"]}}'>
												<div class="table-container">
													<div class="table-wrapper">
														<div class="section-header">
															<span>Budget Details</span>
														</div>
														<table class="formtable" disabled width="100%">
															<thead>
																<tr>
																	<th rowspan="2">Project Name / (Object Head name)</th>  
																	<th colspan="4" style="text-align:center;">Projectwise Budget Sanction Details</th>  
																	<th colspan="3" style="text-align:center;">ObjectHead Wise Sanction Details</th>  
																	<th rowspan="2" style="text-align:center;">Fund Availability</th>
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
																<?php 
																	// $Total       = $IndentApprTotalAmt + $POIssudeTotalAmt;
																	// $BalanceAmt  = $SanAmount - $Total;
																	$BalanceAmt      = $TotalOHBalanAmount;
																	if ($BalanceAmt >= $GrandTotal) {
																		$FundStatus = true;
																	} else {
																		$FundStatus = false;
																	}
																?>
																<tr>
																	<td>{{ $IndentProjName }} <br><strong>{{ $DisplayObjName }}</strong></td>
																	<td>@if(isset($SanNo)){{$SanNo}}@endif</td>
																	<td style="text-align: Right;">@if(isset($SanAmount)){{$SanAmount}}@endif</td>
																	<td style="text-align: Right;">@if(isset($TotalProjUtilAmt)){{$TotalProjUtilAmt}}@endif</td>
																	<td style="text-align: Right;">@if(isset($TotalProjBalanAmount)){{$TotalProjBalanAmount}}@endif</td>
																	<td style="text-align: Right;">@if(isset($OHSanAmt)){{$OHSanAmt}}@endif</td>
																	<td style="text-align: Right;">@if(isset($TotalOHUtilAmt)){{$TotalOHUtilAmt}}@endif</td>
																	<td style="text-align: Right;">@if(isset($TotalOHBalanAmount)){{$TotalOHBalanAmount}}@endif</td>
																	<!-- <td >{{$GrandTotal}}</td> -->
																	<td style="text-align: center;">
																		@if($FundStatus)
																			<button class="btn btn-success btn-sm"><i class="fa fa-check"></i> Available</button>
																		@else
																			<button class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Not Available</button>
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
													</div>
												</div>
											@endif	
                                            {{-- ── INDENT Forward Table ── --}}
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
												<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
												<input type="hidden" name="txt_application_id" id="txt_application_id" value="{{$IndentId ?? ''}}">
											</fieldset>                                                           											
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

<style>
    .chosen-drop { width: 500px !important; }
    #eligibilityWarning ul { margin: 4px 0 0 16px; padding: 0; }
</style>
<script>
var KillEvent = 0;
	$("body").on("click","#SubmitApplication", function(event){
		if(KillEvent == 0){
			var Remarks   	= $("#txt_action_remarks").val();
			if(Remarks == ""){
				BootstrapDialog.alert("Remarks should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure you want to submit this indent for processing..?',
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
</script>
@endsection