@extends('layouts.dashboard-master')
@section('content')
@include('layouts.partials.messages')
@php
$EmpDetails               = $data['Empdata'] ?? [];
$MatTypeArr               = $data['MaterialTypeDrtailsArray'] ?? [];
$ProjectDetailsArray      = $data['ProjectDetails'] ?? [];
$EmpProjectData           = $data['EmpProjectDetails'] ?? [];
$AllObectHeadData         = $data['AllObectHeadDetails'] ?? [];
$AllObectHeadSubCataData  = $data['AllObectHeadSubDetails'] ?? [];
$GetMatCategoryDetails    = $data['GetMatCategoryData'] ?? [];
$ProcessTrancationDetails = $data['ProcessTrancationData'] ?? [];
$RoleDataArr              = $data['RoleDetails'] ?? [];
$EmpDataArr               = $data['EmpNameDetails'] ?? [];
$EmpDesignArr             = $data['EmpDesigiDetails'] ?? [];
$SancationDocArr          = $data['SancationDocData'] ?? [];
$WorkMoveData             = $data['WorkTransData'] ??[];
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
	$IndentSatus        = collect($IndentData)->pluck('status')->first();
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
$BackUrl ='indent.approved-indent-status';
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
	.nborder td{
		border-bottom:1px solid #D8DADD !important;
	}
	.SpanBox{
		border:1px solid #000;
		padding:4px 8px;
		border-radius:8px;
		margin:2px;
		display: inline-block;
	}
	.SpanBoxTag{
		background-color:#CD066C;
		padding:2px 5px;
		border-radius:8px;
		color:#fff;
	}
	.blink {
		animation: blinker 1s linear infinite;
	}
	.blinkslow {
		animation: blinker 1s linear infinite;
	}
	@keyframes blinker {
		50% {
			opacity: 0;
		}
	}
	.indent-wrapper {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        padding: 20px;
        margin: 10px;
    }
	.grid-2col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 15px;
    }
	.grid-3col {
		display: grid;
		grid-template-columns: 1fr 1fr 1fr;
		gap: 12px;
		margin-bottom: 15px;
	}
	.indent-card1 {
        background: #f5f7fa;
        padding: 10px 14px;
        border-left: 4px solid #1a3c6e;
        border-radius: 4px;
        height: 30px;
        display: flex;
        align-items: center;
    }
	.indent-card2 {
        background: #f5f7fa;
        padding: 10px 14px;
        border-left:4px solid #f0a500;
        border-radius: 4px;
        height: 30px;
        display: flex;
        align-items: center;
    }
	.indent-status {
		background: #fff;
		border: 1px solid #ffcccc;
		border-radius: 6px;
		padding: 12px 15px;
        height: 35px;
	}
	.indent-status-value {
		color: #D80958;
		font-weight:bold;
		font-weight:bold;"
		
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
                                        <div class="row divhead" align="center">Indent Status Update Details</div>
                                    </div>
                                </div>
                                <div class="row innerdiv">
									<div class="row row-fluid line-control-menu-bar formtitlebar" style="border:none">
										<div class="btn-group floatr">
											<button type="button" class="btn btn-default btnprimary" title="Back" name="back" id="back" value=" BACK "   onclick="window.location='{{ route($BackUrl) }}'"><i class="fa fa-arrow-circle-o-left pt2"></i> Back</button>
										</div>
										<div class="btn-group floatr">
											<button type="submit" id="btn_save" name="btn_save" data-flag="SU"  class="btn btn-default btninfo " value="SUBMIT" data-flag="SU"><i class="fa fa-arrow-circle-right pt2"></i> Update </button>
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
											<div class="div12" style="padding:2px; margin-top:8px;">
												<div class="mbtable">
													<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="left">&emsp;Indent File Transaction</div></div></div>
													<div class="card-body padding-1 ChartCard" id="CourseChart">
														<div class="divrowbox innerdiv pad-0-top"> 
															<div class="row" align="left">
																<b>
																	<div class="row namebox">
																		<div class="row smclearrow"></div>
																		<table class="formtable" width="100%">
																			<tr>
																				<th class="lboxlabel">SNo.</th>
																				<th class="lboxlabel" nowrap="">Indent file From </th>
																				<th class="lboxlabel" nowrap="">Indent file  To </th>
																				<th class="lboxlabel">Action</th>
																				<!-- <th class="lboxlabel">Action Done By</th> -->
																				<th class="lboxlabel" nowrap="">Action Done On</th>
																				<th class="lboxlabel">Remarks</th>
																				<!-- <th class="lboxlabel"></th> -->
																			</tr>
																			@if(isset($WorkMoveData))
																			@foreach($WorkMoveData as $WorkMoveDataKey => $WorkMoveDataValue)
																			<tr>
																				<td class="cboxlabel unitarr" >{{$loop->iteration}}</td>
																				<td class="lboxlabel">
																					@php
																					if($WorkMoveDataValue->wf_from_role != NULL){
																						if(isset($RoleDataArr[$WorkMoveDataValue->wf_from_role])){
																							$Roles = $RoleDataArr[$WorkMoveDataValue->wf_from_role];
																							if(isset($Roles)){
																								echo $Roles;
																							}
																						}
																					}
																					if(isset($EmpDataArr[$WorkMoveDataValue->wf_from_emp_no])) {
																						echo "<div style='color:green; font-weight:bold; bottom:0px;'>(" . $EmpDataArr[$WorkMoveDataValue->wf_from_emp_no] . ")</div>";
																					}
																					@endphp
																				</td>
																				<td class="lboxlabel">
																					@php
																					if($WorkMoveDataValue->wf_to_role != NULL){
																						if(isset($RoleDataArr[$WorkMoveDataValue->wf_to_role])){
																							$ToRoles = $RoleDataArr[$WorkMoveDataValue->wf_to_role];
																							if(isset($Roles)){
																								echo $ToRoles;
																							}
																						}
																					}
																					if(isset($EmpDataArr[$WorkMoveDataValue->wf_to_emp_no])) {
																						echo "<div style='color:green; font-weight:bold; vertical-align:bottom;'>(" . $EmpDataArr[$WorkMoveDataValue->wf_to_emp_no] . ")</div>";
																					}
																					@endphp
																				</td>
																				<td class="lboxlabel" style="text-align:center">
																					@php
																						if($WorkMoveDataValue->action_flag != NULL){
																							if(($WorkMoveDataValue->action_flag == "SU") && ($WorkMoveDataValue->status != "AP")){
																								echo "File Forwarded to " . ($ToRoles ?? '');
																							}else if(($WorkMoveDataValue->action_flag == "FW") && ($WorkMoveDataValue->status != "AP")){
																								echo "File Forwarded to " . ($ToRoles ?? '');
																							}else if(($WorkMoveDataValue->action_flag == "RJ") && ($WorkMoveDataValue->status != "AP")){
																								echo "Indent Return Back With Reason" ;
																							}else if(($WorkMoveDataValue->action_flag == "FW") && ($WorkMoveDataValue->status == "approved")){
																								@endphp <div style="background-color:#7bd19f; border:1px solid #151e26"> @php echo "Approved"; @endphp </div> @php
																							}else if(($WorkMoveDataValue->action_flag == NULL) && ($WorkMoveDataValue->status != "AP")){
																								echo "Pulled Back";
																							}else if($WorkMoveDataValue->status == "approved"){
																								@endphp <div style="background-color:#7bd19f; border:1px solid #151e26"> @php echo "Approved"; @endphp </div> @php
																							}else{
																								echo "";
																							}
																						}
																						else{
																							echo "Pulled Back";
																						}
																					@endphp
																				</td>
																				<td class="cboxlabel">
																					@php
																					if($WorkMoveDataValue->created_at != NULL){
																						$CreatedAt = explode(" ", $WorkMoveDataValue->created_at);
																						$CreatedAt[0] = Helper::DisplayDateFormat($CreatedAt[0]);
																						$CreatedAt = implode(" ", $CreatedAt);
																						echo $CreatedAt;
																					}
																					@endphp
																				</td>
																				<td class="lboxlabel">
																					@php
																					if($WorkMoveDataValue->remarks != NULL){
																						echo $WorkMoveDataValue->remarks;
																					}
																					@endphp
																				</td>
																			</tr>
																			@endforeach
																			@endif
																		</table>
																		<div class="row smclearrow"></div>
																				<div class="indent-status">
																				<span class ="lboxlabel">Current Status : </span>
																				@php
																					if(isset($IndentSatus)){
																						if($IndentSatus == "approved"){
																							echo '<span class="blink indent-status-value">Indent approved</span>';
																						} else if($IndentSatus == "submitted" ||  $IndentSatus  =='recommended'){
																							if(isset($ToRole) && isset($RoleDataArr[$ToRole])){
																								$Roles = $RoleDataArr[$ToRole];
																								$ToEmpNameStr = isset($ToEmpName) ? '('.$ToEmpName.')' : '';
																								if(isset($Roles)){
																									echo '<span class="blink indent-status-value" >  Waiting in '.$Roles.' Desk </span>';
																								}
																							} else if(isset($FromRole) && $FromRole != ''){
																								if(isset($RoleDataArr[$FromRole])){
																									$Roles = $RoleDataArr[$FromRole];
																									$FromEmpNameStr = isset($FromEmpName) ? '('.$FromEmpName.')' : '';
																									echo '<span class="blink indent-status-value" >  Waiting in '.$Roles.' Desk </span>';
																								}
																							}
																						}else if($IndentSatus == "rejected"){
																							if(isset($FromRole) && isset($RoleDataArr[$FromRole])){
																								$RejRoles = $RoleDataArr[$FromRole];
																								$ToEmpNameStr = isset($ToEmpName) ? '('.$ToEmpName.')' : '';
																								if(isset($RejRoles)){
																									echo '<span class="blink indent-status-value" >  Indent Return Back by '.$RejRoles.' Desk </span>';
																								}
																							} 
																						}else{
																							echo '<span class="blink indent-status-value" >Not yet submitted</span>';
																						}
																					}
																				@endphp
																			</div>
																		<div class="row smclearrow"></div>
																	</div>
																</b> 
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="div12" style="padding:2px; margin-top:8px;">
												<div class="mbtable">
													<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="left">&emsp;Indent Sanction Processing 
														<button align="right" type="button" id='btn_supp_doc' data-id="{{$IndentId}}" class="rm-new-emp-btn" >Sanction Supporting Documents</button>
													</div></div></div>
													<div class="card-body padding-1 ChartCard" id="CourseChart">
														<div class="divrowbox innerdiv pad-0-top"> 
															<div class="row" align="left">
																<b>
																	<div class="row namebox">
																		<div class="row smclearrow"></div>
																		<table class="formtable" width="100%">
																			<tr>
																				<th class="lboxlabel">SNo.</th>
																				<th class="lboxlabel" nowrap="">Status Update By</th>
																				<!-- <th class="lboxlabel" nowrap="">Indent file  To </th> -->
																				<th class="lboxlabel">Status Description</th>
																				<!-- <th class="lboxlabel">Action</th> -->
																				<!-- <th class="lboxlabel">Action Done By</th> -->
																				<th class="lboxlabel" nowrap="">Action Done On</th>
																				<!-- <th class="lboxlabel"></th> -->
																			</tr>
																			@if(isset($ProcessTrancationDetails))
																			@foreach($ProcessTrancationDetails as $WorkMoveDataKey => $StatusDataValue)
																			<tr>
																				<td class="cboxlabel unitarr" >{{$loop->iteration}}</td>
																				<td class="lboxlabel">
																					@php
																					if($StatusDataValue->wf_from_role != NULL){
																						if(isset($RoleDataArr[$StatusDataValue->wf_from_role])){
																							$Roles = $RoleDataArr[$StatusDataValue->wf_from_role];
																							if(isset($Roles)){
																								echo $Roles;
																							}
																						}
																					}
																					if(isset($EmpDataArr[$StatusDataValue->wf_from_emp_no])) {
																						echo "<div style='color:green; font-weight:bold; bottom:0px;'>(" . $EmpDataArr[$StatusDataValue->wf_from_emp_no] . ")</div>";
																					}
																					@endphp
																				</td>
																				<td class="lboxlabel">
																					@php
																					if($StatusDataValue->remarks != NULL){
																						echo $StatusDataValue->remarks;
																					}
																					@endphp
																				</td>
																				<td class="cboxlabel">
																					@php
																					if($StatusDataValue->created_at != NULL){
																						$CreatedAt = explode(" ", $StatusDataValue->created_at);
																						$CreatedAt[0] = Helper::DisplayDateFormat($CreatedAt[0]);
																						$CreatedAt = implode(" ", $CreatedAt);
																						echo $CreatedAt;
																					}
																					@endphp
																				</td>
																			</tr>
																			@endforeach
																			@endif
																		</table>
																	</div>
																</b> 
															</div>
														</div>
													</div>
												</div>
											</div>   
											<div class="div12" style="padding:2px; margin-top:8px;">
												<div class="mbtable">
													<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="left">&emsp;Indent Status Update
													</div></div></div>
													<div class="card-body padding-1 ChartCard" id="CourseChart">
														<div class="divrowbox innerdiv pad-0-top"> 
															<div class="row" align="left">
																<b>
																	<div class="row namebox">
																		<div class="row smclearrow"></div>
																		<table class="formtable" disabled width="100%">
																			<thead>
																				<tr>
																					<th style="text-align:center; width:60%">Status Description</th>  
																					<th style="text-align:center; width:30%">Status Update Date</th>  
																				</tr>
																			</thead>
																				<tbody id="supp_doc_tbody">	
																					<tr>
																						<td>
																							<input type="text"  style="width:100%" name="txt_status_desc" id="txt_status_desc" class="tboxsmclass  "  value="">
																						</td>
																						<td>
																							<input type="text" name="txt_status_upt_date" id="txt_status_upt_date" class="tboxsmclass datepicker" value="" >
																						</td>
																					</tr>
																			</tbody>
																		</table>
																	</div>
																</b> 
															</div>
														</div>
													</div>
												</div>
											</div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
					<input type="hidden" name="txt_application_id" id="txt_application_id" value="{{$IndentId ?? '' }}" />
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
	$("body").on("click","#btn_supp_doc", function(event){
		var IndentId = $(this).attr('data-id'); 
		$.ajax({
			type: 'POST',
			url: "{{ route('indent.sanction-SupportingDoc') }}",
			data: {'_token': '{{ csrf_token() }}','IndentId': IndentId},
			success: function(data) {
				if (data != null) {
					var SancDocArr = data['SANCDOCDETAILS'];
					var Sno = 1;
					var SupportingDataStr = '';
					SupportingDataStr += '<table class="formtable" width="100%">';
					SupportingDataStr += '<tr>';
					SupportingDataStr += '<th class="lboxlabel">S.No.</th>';
					SupportingDataStr += '<th class="lboxlabel">Document Description</th>';
					SupportingDataStr += '<th class="lboxlabel">Download</th>';
					SupportingDataStr += '</tr>';
					if(SancDocArr.length > 0){
						SancDocArr.forEach(function(item) {
							SupportingDataStr += '<tr>' +
								'<td class="lboxlabel" style="text-align:center;">'+Sno+'</td>' +
								'<td class="lboxlabel">'+item.doc_desc+'</td>' +
								'<td class="lboxlabel" style="text-align:center;">' +
									'<button type="button" ' +'data-fileid="'+item.enc_sup_doc_id+'" ' +
									'class="btn btn-default tuploadbtn btn_download" ' +
									'title="Click here to Download the File" ' +
									'style="cursor:pointer;">' +
									'<i class="fa fa-download"></i> Download File' +
									'</button>' +
								'</td>' +
							'</tr>';
							Sno++;
						});
					}else{
						SupportingDataStr += '<tr>' +
							'<td colspan="3" class="lboxlabel" style="text-align:center;">No Records Found</td>' +
						'</tr>';
					}
					SupportingDataStr += '</table>';
					BootstrapDialog.show({
						title: 'Indent Sanction Supporting Documents',
						message: SupportingDataStr,
						buttons: [{
							label: 'OK',
							action: function(dialog) {
								dialog.close();
							}
						}]
					});
				}
			}
		});
	});
	$("body").on("click",".btn_download", function(){
		var SuppDocId = $(this).attr("data-fileid");
		DownloadFile(SuppDocId);
	});
	function DownloadFile(SuppDocId) {
		window.open("{{ route('indent.sanction-document-download') }}?id=" + SuppDocId, "_blank");
	}
	$(document).on('click','.DeleteRow',function(){
		$(this).closest("tr").remove();
	}); 
	var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var Remarks   	= $("#txt_status_desc").val();
			var Date   	    = $("#txt_status_upt_date").val();
			if(Remarks == ""){
				BootstrapDialog.alert("Status Description should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(Date == ""){
				BootstrapDialog.alert("Status Update Date should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;	
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure want to save..?',
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
</script>
@endsection