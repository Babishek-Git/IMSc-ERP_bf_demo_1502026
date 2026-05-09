@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
$IndentDate = date('Y-m-d');
 if(isset($data['ShowEmpSessiondata'])){
	$Empdata  = $data['ShowEmpSessiondata'];
	$ICNo     = collect($Empdata)->pluck('emp_no')->first();
	$EmpName  = collect($Empdata)->pluck('emp_name_payslip')->first();
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
	$IndentProjId       = collect($EditIndentData)->pluck('project_id')->first();
	$IndentProjName     = collect($EditIndentData)->pluck('indent_pro_name')->first();
	$CreatedBy          = collect($EditIndentData)->pluck('created_by')->first();
	$IndentDate         = collect($EditIndentData)->pluck('indent_date')->first();
	$IndentId           = collect($EditIndentData)->pluck('indent_id')->first();
	$ICNo               = collect($EditIndentData)->pluck('emp_no')->first();
	$MatTypeId          = collect($EditIndentData)->pluck('mat_type_id')->first();
	$RegKit             = collect($EditIndentData)->pluck('reg_kit')->first();
	$ObjHeadId          = collect($EditIndentData)->pluck('object_head_id')->first();
	$OhSubCataId        = collect($EditIndentData)->pluck('oh_sub_cata_id')->first();
	$MatCataId          = collect($EditIndentData)->pluck('mat_categ_id')->first();
	$ICNo               =  $CreatedBy;
}
if(isset($data['Empdata']) && isset($data['EditIndentData'])){
	$ShowEmpData = $data['Empdata'];
	$EmpName     = collect($ShowEmpData)->where('emp_no', $ICNo)->pluck('emp_name_payslip')->first();
	$Desig       = collect($ShowEmpData)->where('emp_no', $ICNo)->pluck('designation_name')->first();
}
if(isset($data['ShowIndentEditDetails'])){
	$EditIndentDetailsData     = $data['ShowIndentEditDetails'];
}
$Action   = 'PROCESS';
if(isset($data['Flag'])){
	$IndentFlagData     = $data['Flag'];
}
if(isset($data['FromPage'])){
	$FromPage  = $data['FromPage'];
}else{
	$FromPage ='';
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
$FinYear      = Helper::GetCurrentFinYear(NULL);
$NewIndentNo  = "IMS/P&S/" . $FinYear . "/" . $SuffixNo . "";
$BackUrl      = 'indent.indent-view';
$OHMappData   = $data['OHMappData'] ??  [];
$AllObectHead = $data['AllObectHead'] ?? [];
$AllObectHeadSubCata = $data['AllObectHeadSubCata'] ?? [];
$AllObectHeadSubCataGrpData = $data['AllObectHeadSubCataGrpData'] ?? [];
$OptionStr   = '';
if(isset($OHMappData)){
	foreach($OHMappData as $mappitem){
		if(isset($AllObectHead)){
			foreach($AllObectHead as $AllObectHeadValue){
				if($AllObectHeadValue->object_head_id == $mappitem->object_head_id){
					if($mappitem->is_sup_cata_applicable == true){
						$IsSubCata = 0;
						if(isset($AllObectHeadSubCataGrpData[$AllObectHeadValue->object_head_id])){
							$ObjectHeadSubCata = $AllObectHeadSubCataGrpData[$AllObectHeadValue->object_head_id];
							if(filled($ObjectHeadSubCata)){
								if(count($ObjectHeadSubCata) > 0){
									$IsSubCata = 1;
									foreach($ObjectHeadSubCata as $ObjectHeadSubCataValue){
										$isSelected = ($AllObectHeadValue->oh_sub_cata_id == ($ObjHeadId ?? '')) ? 'selected' : '';
										$OptionStr .= '<option value="'.$ObjectHeadSubCataValue->object_head_id.'" data-mode="OHSC" data-ohid="'.$ObjectHeadSubCataValue->object_head_id.'" data-subcat="'.$ObjectHeadSubCataValue->oh_sub_cata_id.'" '.$isSelected.'>'.$ObjectHeadSubCataValue->oh_sub_cata_name.'</option>';
									}
								}

							}
						}
						if($IsSubCata == 0){
							$isSelected = ($AllObectHeadValue->object_head_id == ($ObjHeadId ?? '')) ? 'selected' : '';
							$OptionStr .= '<option value="'.$AllObectHeadValue->object_head_id.'" data-mode="OH" data-ohid="'.$AllObectHeadValue->object_head_id.'" data-subcat="" '.$isSelected.'>'.$AllObectHeadValue->object_head_name.'</option>';
						}
					}else{
						$isSelected = ($AllObectHeadValue->object_head_id == ($ObjHeadId ?? '')) ? 'selected' : '';
						$OptionStr .= '<option value="'.$AllObectHeadValue->object_head_id.'" data-mode="OH" data-ohid="'.$AllObectHeadValue->object_head_id.'" data-subcat="" '.$isSelected.'>'.$AllObectHeadValue->object_head_name.'</option>';
					}
				}
			}		
		}
	}	
}

@endphp
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="" method="post" enctype="multipart/form-data" name="form">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row plr">
								<!-- <div class="div2">&nbsp;</div> -->
								<div class="div12 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Indent Creation Form</div></div></div>
								<div class="row innerdiv">
									<div class="row"> 
										<div class="row row-fluid line-control-menu-bar formtitlebar" style="border:none">
											@if(isset($data['ShowIndentEditDetails']) && isset($IndentFlagData) && $IndentFlagData == 'FORWARDACC')
												<button type="submit" class="step-btn WorkFlowAction" data-flag="SU" name="SaveApplication"  id="SaveApplication" value="Update">Forward to Accounts</button>	
								    			<input type="hidden" name="hid_indent_id" id="hid_indent_id" value="@if(isset($IndentId)){{$IndentId}}@endif" />
											@elseif(isset($data['ShowIndentEditDetails']))
												<div class="btn-group floatr">
													<input type="hidden" name="hid_indent_id" id="hid_indent_id" value="@if(isset($IndentId)){{$IndentId}}@endif" />
													<button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Save">Update</button>
													<input type="button" class="backbutton" name="back" id="back" value=" Back " onClick="window.location='{{route($BackUrl)}}'" />
												</div>
											@else
												<div class="btn-group floatr">
                                                    <button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Save">Save</button>
													<input type="button" class="backbutton" name="home" id="home" value=" Home " onclick="window.location='{{ route('dashboard.index') }}'" />
								    				<input type="hidden" name="hid_indent_suff_no" id="hid_indent_suff_no" value="@if(isset($SuffixNo)){{$SuffixNo}}@endif" />
                                                </div>
											@endif
										</div>
										 <!-- Form Steps --> 
										<div class="form-step active"> 
											<!-- <fieldset class="fieldbox">
												<legend class="fieldbox-legend">Indent Creator</legend>
												<div class="fieldbox-div">
													<div class="div2 label label">IC No</div>
													<div class="div2"><input type="text" name="txt_emp_icno" id="txt_emp_icno" class="tboxsmclass" value="@if(isset($ICNo)){{$ICNo}}@endif"readonly ></div>
													<div class="div2 label pd-l-20">Name</div>
													<div class="div2"><input type="text" name="txt_payslip_name" id="txt_payslip_name" class="tboxsmclass" value="@if(isset($EmpName)){{$EmpName}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Designation</div>
													<div class="div2"><input type="text" name="txt_designation" id="txt_designation" class="tboxsmclass" value="@if(isset($Desig)){{$Desig}}@endif" readonly></div>
													<div class="div2 label label">Group</div>
													<div class="div2"><input type="text" name="txt_group" id="txt_group_id" class="tboxsmclass" value="@if(isset($GroupId)){{$GroupId}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Divison</div>
													 <div class="div2"><input type="text" name="txt_div" id="txt_div_id" class="tboxsmclass" value="@if(isset($DivId)){{$DivId}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Section</div>
														<div class="div2"><input type="text" name="txt_sec" id="txt_sec_id" class="tboxsmclass" value="@if(isset($SecId)){{$SecId}}@endif" readonly></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset> -->
											<div class="row smclearrow"></div>
												<fieldset class="fieldbox" {{ (isset($IndentFlagData) && $IndentFlagData == 'FORWARDACC') ? 'disabled' : '' }}>
													<legend class="fieldbox-legend">Indent Details</legend>
													<div class="fieldbox-div">
														<div class="div2 label label">Indent No.</div>
														<div class="div2"><input type="text" name="txt_intent_no" id="txt_indent_no" class="tboxsmclass" value="@if(isset($IndentNo)){{$IndentNo}}@else {{$NewIndentNo}}@endif" readonly></div>  
														<div class="div1 label pd-l-20">Indent Date </div>
														<div class="div1"><input type="text" name="txt_intent_date" id="txt_indent_date" class="tboxsmclass datepicker" value="@if(isset($IndentDate)){{Helper::DisplayDateFormat($IndentDate)}}@endif" ></div>
														<div class="div3 label pd-l-20">Indent Created By (IC No / Designation)</div>
        												<div class="div3"><textarea name="txt_indent_created_by" id="txt_indent_created_by" class="tboxsmclass" rows="2" style="resize:none;" readonly>@if(isset($EmpName)){{ $EmpName }}  ({{ isset($ICNo) ? $ICNo : '' }} / {{ isset($Desig) ? $Desig : '' }})@endif</textarea></div>
														<div class="row smclearrow"></div>
														<div class="div2 label label">Indent Title</div>
														<div class="div4">
															<textarea name="txt_intent_det" id="txt_intent_det" class="tboxsmclass">@if(isset($IndentDescription)){{$IndentDescription}}@endif</textarea>
														</div>
														<div class="div3  label pd-l-20"> Type of Material</div>
														<div class="div3 label">
															@if(isset($data['MaterialTypeData']))
																@foreach($data['MaterialTypeData'] as $MaterialTypeData)
																	<input type="radio" name="rad_indent_mat_type"  value="{{ $MaterialTypeData->material_type_id }}"{{ isset($MatTypeId) && $MatTypeId == $MaterialTypeData->material_type_id ? 'checked' : '' }}> 
																		{{ $MaterialTypeData->material_type_name }}
																@endforeach
															@endif
														</div>
														
														<div class="row smclearrow"></div>
														<div class="div2 label">Material Category</div>
														<div class="div4">
															<select  style="width:100%" name="cmb_mat_cat" id="cmb_mat_cat"  class="tboxsmclass ChosenInput">
																<option value=""> ----Select ---</option>
																@if(isset($data['GetMatCategoryData'])) 
																	@foreach($data['GetMatCategoryData'] as $MatCatData)
																		<option value="{{ $MatCatData->material_group_id }}" {{ $MatCatData->material_group_id == ($MatCataId ?? null) ? 'selected' : '' }}>{{ $MatCatData->full_heads }}</option>
																	@endforeach
																@endif
															</select>
														</div>
														<div class="div3 label pd-l-20 ">Indent For Registration Kit</div>
														<div class="div3 label">
															<input type="radio" name="rad_regist_kit"  value="YES" {{ ($RegKit ?? '') == 'YES' ? 'checked' : '' }}> Yes 
															<input type="radio" name="rad_regist_kit"  value="NO" {{ ($RegKit ?? '') == 'NO' ? 'checked' : '' }}> No
														</div>
														<div class="row smclearrow"></div>
														@if(isset($data['IsProjApplicable']) && $data['IsProjApplicable'] == 'Y')
															<input type="hidden" name ="is_proj_applicable" id ='is_proj_applicable' value="@if(isset($data['IsProjApplicable'])){{ $data['IsProjApplicable'] }}@endif">
															<div class="div2 label ">Project / Sub Project Name</div>
															<div class="div4">
																<select  style="width:100%" name="cmb_project_id" id="cmb_project_id"  class="tboxsmclass ChosenInput">
																	<option value=""> ----Select ---</option>
																	@if(isset($data['EmpProjectDetails'])) 
																		@foreach($data['EmpProjectDetails'] as $EmpProjectData)
																			<option value="{{ $EmpProjectData->project_id }}" {{ $EmpProjectData->project_id == ($IndentProjId ?? null) ? 'selected' : '' }}>{{ $EmpProjectData->full_heads }}</option>
																		@endforeach
																	@endif
																</select>
															</div>
															<div class="div3 label pd-l-20">Object Head</div>
															<div class="div3">
																<select style="width:100%" name="cmb_obj_head_id" id="cmb_obj_head_id" class="tboxsmclass ChosenInput">
																	<option value=""> ----Select ---</option>
																	@if(isset($OhSubCataId) && isset($data['AllObectHeadSubCata']))
																		@foreach($data['AllObectHeadSubCata'] as $item)
																			<option value="{{ $item->object_head_id }}"data-subcat="{{ $item->oh_sub_cata_id }}"data-mode="OHSC"{{ $item->oh_sub_cata_id == ($OhSubCataId ?? null) ? 'selected' : '' }}>{{ $item->oh_sub_cata_name }}</option>
																		@endforeach
																	@elseif(isset($ObjHeadId) && isset($data['AllObectHead']))
																		@foreach($data['AllObectHead'] as $item)
																			<option value="{{ $item->object_head_id }}"	data-subcat="" data-mode="OH"{{ $item->object_head_id == ($ObjHeadId ?? null) ? 'selected' : '' }}>{{ $item->object_head_name }}</option>
																		@endforeach
																	@endif
																</select>
																<input type="hidden" name="obj_head_mode" id="obj_head_mode" value="">
																<input type="hidden" name="obj_sub_proj_id" id="obj_sub_proj_id" value="">
															</div>
														@elseif(isset($data['OHMappData']))	
															<div class="div2 label ">Object Head</div>
															<div class="div4">
																<select style="width:100%" name="cmb_obj_head_id" id="cmb_obj_head_id" class="tboxsmclass ChosenInput">
																	<option value=""> ----Select ---</option>
																	{!! $OptionStr ?? '' !!}
																</select>
																<input type="hidden" name="obj_head_mode" id="obj_head_mode" value="">
																<input type="hidden" name="obj_sub_proj_id" id="obj_sub_proj_id" value="">
															</div>
														@endif
														<div class="row smclearrow"></div>
														
														
														<!-- <div class="div4">
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
											<fieldset class="fieldbox" {{ (isset($IndentFlagData) && $IndentFlagData == 'FORWARDACC') ? 'disabled' : '' }}>
												<legend class="fieldbox-legend">Item Details of Required Items </legend>
												<div class="fieldbox-div">
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
													<table class="formtable" align="center" id="RelationshipTable" width="100%">
														<thead> 
															<tr>
																<th style="width: 20px;" >S.No.</th>
																<!-- <th style="width: 150px;">Type Of Material</th> -->
																<th>A complete description of Goods/Services intended to be procured</th>
																<th  style="width: 80px;">Qty</th>
																<th style="width: 80px;">Unit</th>
																<th style="width: 100px;">Unit <br>Price <br> Rs.</th>
																<th style="width: 80px;">Amount <br> Rs.</th>
																<!-- <th style="width: 80px;">GST %</th> -->
																<th style="width: 100px;">Tax Type</th>
																<th style="width: 120px;">Total cost <br> with tax (Approx.) <br> Rs.</th>
																<th style="width: 80px;">Action</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td><input type="text"  style="width:100%" name="txt_sno_0" id="txt_sno_0" class="tboxsmclass itemno decimalnum" data-index = '0' value="1"></td>
																<!-- <td>
																	<select  style="width:100%" name="cmb_material_type" id="cmb_material_type" data-index = '0' class="tboxsmclass ChosenInput">
																		<option value=""> ----Select ---</option>
																		@if(isset($data['MaterialTypeData']))
																				@foreach($data['MaterialTypeData'] as $MaterialTypeData)
																					<option value="{{$MaterialTypeData->material_type_id}}">{{$MaterialTypeData->material_type_name}}</option>
																				@endforeach
																			@endif
																	</select>
																</td> -->
																<td><textarea name="txt_item_goods_service_name_0" id="txt_item_goods_service_name_0" data-index = '0' class="tboxsmclass"></textarea></td>
																<!-- <td><input type="text" name="txt_item_goods_service_name_0" id="txt_item_goods_service_name_0" class="tboxsmclass " value=""></td> -->
																<td><input type="text" style="width:100%" name="txt_item_quantity_req_name_0"data-index = '0'  id="txt_item_quantity_req_name_0" class="tboxsmclass decimalnum itemqty" value=""></td>
																<td>
																	<select  style="width:100%" name="cmb_unit" id="cmb_unit" class="tboxsmclass data-index = '0' ChosenInput">
																		<option value=""> ----Select ---</option>
																		@if(isset($data['ShowMaterialUnit']))
																				@foreach($data['ShowMaterialUnit'] as $MaterialUnitData)
																					<option value="{{$MaterialUnitData->uom_id}}">{{$MaterialUnitData->uom_name}}</option>
																				@endforeach
																			@endif
																	</select>
																</td>
																<td><input type="text" style="width:100%" name="txt_item_estimate_no_0" id="txt_item_estimate_no_0"  data-index = '0' class="tboxsmclass decimalnum unitprice" value=""></td>
																
																<!-- <td><input type="text" style="width:100%" name="txt_item_gst_rate_0" id="txt_item_gst_rate_0" data-index = '0' class="tboxsmclass decimalnum gstperc" value=""></td> -->
																<td><input type="text" style="width:100%" name="txt_item_amout_0" id="txt_item_amout_0" data-index = '0' class="tboxsmclass decimalnum itemamout" readonly value=""></td>
																<td>
																	<select name="cmb_tax_type_0" id="cmb_tax_type_0" data-index = '0' class="tboxsmclass taxtype">
																		<option value=""> ----Select ---</option>
																		<option value="INC">Inclusive</option>
																		<option value="EXCL">Exclusive</option>
																			
																	</select>
																</td>
																<td ><input type="text"   style="width:100%;text-align: Right;" data-index = '0' name="txt_item_total_cost_0" id="txt_item_total_cost_0" class="tboxsmclass decimalnum totalcost" value=""></td>
																<td align="center"><i class="fa fa-plus-square sqadd ptr inp disable" id="AddTechRec" style="font-size:24px;"></i></td>
															</tr>
															@if(isset($data['ShowIndentEditDetails']))
																@php 
																	$EditIndentDetailsData = $data['ShowIndentEditDetails']; 
																	$IndentId              = collect($EditIndentDetailsData)->pluck('indent_id')->first();
																	$Sno = 1;
																	$GrandTotal = 0;
																@endphp
																@foreach($EditIndentDetailsData as $EditValue)
																	<tr data-index='{{$Sno}}'>
																		<td><input type="text"  style="width:100%" name="txt_sno[]" id="txt_sno_{{$Sno}}" class="tboxsmclass decimalnum itemno" data-index="{{$Sno}}" value="{{$EditValue->item_no}}"></td>
																		<!-- <td>
																			<select name="txt_material_type_id[]" id="cmb_material_type_{{$Sno}}" data-index="{{$Sno}}" class="tboxsmclass">
																				<option value=""> ----Select ---</option>
																				@if(isset($data['MaterialTypeData']))
																						@foreach($data['MaterialTypeData'] as $MaterialTypeData)
																							<option value="{{$MaterialTypeData->material_type_id}}"{{($MaterialTypeData->material_type_id) == $EditValue->material_type_id ? 'selected="selected"' : ''}}>{{$MaterialTypeData->material_type_name}}</option>
																						@endforeach
																					@endif
																			</select>
																		</td> -->
																		<td><textarea name="txt_item_goods_service_name[]" id="txt_item_goods_service_name_{{$Sno}}" data-index="{{$Sno}}" class="tboxsmclass" value="{{$EditValue->item_description}}">{{$EditValue->item_description}}</textarea></td>
																		<td><input type="text" style="width:100%" name="txt_item_quantity_req_name[]" id="txt_item_quantity_req_name_{{$Sno}}" data-index="{{$Sno}}"  class="tboxsmclass decimalnum itemqty" value="{{$EditValue->quantity}}"></td>
																		<td>
																			<select  style="width:100%" name="txt_unit[]" id="cmb_unit_{{$Sno}}" class="tboxsmclass  ChosenInput"  data-index="{{$Sno}}">
																				<option value=""> ----Select ---</option>
																				@if(isset($data['ShowMaterialUnit']))
																						@foreach($data['ShowMaterialUnit'] as $MaterialUnitData)
																							<option value="{{$MaterialUnitData->uom_id}}"{{($MaterialUnitData->uom_id) == $EditValue->unit_id ? 'selected="selected"' : ''}}>{{$MaterialUnitData->uom_name}}</option>
																						@endforeach
																					@endif
																			</select>
																		</td>
																		<td><input type="text" style="width:100%" name="txt_item_estimate_no[]" id="txt_item_estimate_no_{{$Sno}}" data-index="{{$Sno}}" class="tboxsmclass decimalnum unitprice" value="{{$EditValue->estimated_unit_price}}"></td>
																		<!-- <td><input type="text" style="width:100%" name="txt_item_gst_rate[]" id="txt_item_gst_rate_{{$Sno}}" data-index="{{$Sno}}" class="tboxsmclass decimalnum gstperc" value="{{$EditValue->gst_rate}}"></td> -->
																		<td><input type="text" style="width:100%" name="txt_item_amout[]" id="txt_item_amout_{{$Sno}}" data-index = '{{$Sno}}' class="tboxsmclass decimalnum itemamout" readonly value="{{$EditValue->item_amount}}"></td>
																		<td>
																			<select name="cmb_tax_type[]" id="cmb_tax_type_{{$Sno}}" data-index="{{$Sno}}" class="tboxsmclass taxtype">
																				<option value=""> ----Select ---</option>
																				<option value="INC"{{ $EditValue->tax_type == 'INC' ? 'selected' : '' }}>Inclusive</option>
																				<option value="EXCL"{{ $EditValue->tax_type == 'EXCL' ? 'selected' : '' }}>Exclusive</option>
																			</select>
																		</td>
						
																		@php $IsReadOnly = ($EditValue->tax_type == 'INC') ? 'readonly' : ''; @endphp
																		<td><input type="text" style="width:100%;text-align: Right" name="txt_item_total_cost[]" {{ $IsReadOnly }} id="txt_item_total_cost_{{$Sno}}" data-index="{{$Sno}}" class="tboxsmclass decimalnum IsReadOnly totalcost" value="{{$EditValue->total_cost}}"></td>
																		<td align="center">
																			<i class='fa fa-times-circle sqdel ptr disable DeleteRow'  id ='btn_delete' id='DelIndentDetails' style='font-size:24px' data-index="{{$Sno}}">
    																		<!-- <i class="fa fa-pencil-square edit-record" id='btn_edit'title="Edit" style="font-size:24px; color: #2196F3;"  data-index="{{$Sno}}"></i>
																			<i class="fa fa-trash delete-record ptr inp" id ='btn_delete' title="Delete" style="font-size:24px; color: #f44336; margin-left: 10px;" data-index="{{$Sno}}"></i> -->
																		</td>
																	@php $Sno  ++; $GrandTotal +=$EditValue->total_cost @endphp
																@endforeach
																<input type="hidden" id ="hidden_total_sno" name ='hidden_total_sno' value ='{{$Sno}}'>
															@endif
														<!-- 	@if(isset($data['EditIndentDetailData']))
																@foreach($data['EditIndentDetailData'] as $EditIndentDetailData)
																	<tr>
																		<td align="center">{{ $loop->iteration }} </td>
																		<td align="left">{{ $EditIndentDetailData->indent_no}}</td>
																		<td align="left">{{ $EditIndentDetailData->material_type_id}}</td>
																		<td align="left">{{ $EditIndentDetailData->indent_descripton }}</td>
																		<td align="left">{{ $EditIndentDetailData->quantity }}</td>
																		<td align="left">{{ $EditIndentDetailData->quantity }}</td>
																		<td align="left">{{ $EditIndentDetailData->estimated_unit_price }}</td>
																		<td align="left">{{ $EditIndentDetailData->gst_rate }}</td>
																		<td align="left">{{ $EditIndentDetailData->gst_price }}</td>
																		<td align="left">{{ $EditIndentDetailData->total_cost }}</td>
																	</tr>
																@endforeach
															@endif -->
														</tbody>
														<tfoot>
															<tr>
																<td colspan ='7' align="right">Total Estimated Cost (Approx.)</td>
																<td id ='dispaly_total_amout' align="right">{{$GrandTotal ?? ""}}</td>
																<input type="hidden" name="txt_total_amout" id="txt_total_amout" value='{{$GrandTotal ?? ""}}'>
																<td></td>
															</tr>
														</tfoot>
													</table>
												</div>
												<div class="row smclearrow"></div>
												<div class="row smclearrow"></div>
											</fieldset>
											
											<!-- <div class="row smclearrow"></div>
												<fieldset class="fieldbox">
													<legend class="fieldbox-legend">Supplier & Payment Term</legend>
													<div class="fieldbox-div">
														<div class="div2 label label">Suggested Supplier</div>
														<div class="div2"><input type="text" name="txt_suggest_supplier" id="txt_suggest_supplier" class="tboxsmclass" value=""  ></div>
														<div class="div2 label pd-l-20">Payment Term</div>
														<div class="div2"><input type="text" name="txt_payment_term" id="txt_payment_term" class="tboxsmclass" value=""  ></div>  
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>
													</div>
												</fieldset>                                                           											
                                            </div> -->
									<!-- </div > -->
								</div>
								<!-- ================ -->
								<!-- ================ -->
								</div>
								
								<!-- ================== -->
							</div>
							<div class="row">
								<div class="div12" align="center">
									<!-- @if(isset($data['ShowIndentEditDetails']) && isset($IndentFlagData) && $IndentFlagData == 'FORWARDACC')
										<button type="submit" class="step-btn WorkFlowAction" data-flag="SU" name="SaveApplication"  id="SaveApplication" value="Update">Forward to Accounts</button>	
								    	<input type="hidden" name="hid_indent_id" id="hid_indent_id" value="@if(isset($IndentId)){{$IndentId}}@endif" />
									@elseif(isset($data['ShowIndentEditDetails']))
										<button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Update">Update</button>	
                                        <input type="button" class="backbutton" name="back" id="back" value=" Back " onClick="window.location='{{route($BackUrl)}}'" />
								    	<input type="hidden" name="hid_indent_id" id="hid_indent_id" value="@if(isset($IndentId)){{$IndentId}}@endif" />
									@else
										<button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Save">Save</button>	
								    	<input type="hidden" name="hid_indent_suff_no" id="hid_indent_suff_no" value="@if(isset($SuffixNo)){{$SuffixNo}}@endif" />
									@endif -->
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
						</div>
					</blockquote>
				</div>
			</div>
		</div>
	</form>
</body>	
@include('common-workflow.workflow-process')
<script type="text/javascript" language="javascript">
	$('[name="cmb_tax_type"]').chosen();
	$('[name="cmb_material_type"]').chosen();
	$('[name="cmb_unit_0"]').chosen();
	$('[name="cmb_project_id"]').chosen();
	$('[name="cmb_obj_head_id"]').chosen();
	$('[name="cmb_mat_cat"]').chosen();
	//$(".ChosenInput").chosen();
	//$("#txt_division").chosen();
	//$("#txt_role_group").chosen();
	// function calculateGrandTotal() {
	// 	var GrandTotal = 0;
	// 	$('.itemamout').each(function () {
	// 		var val = parseFloat($(this).val()) || 0;
	// 		GrandTotal += val;
	// 	});
	// 	$('#dispaly_total_amout').text(GrandTotal.toFixed(2));
	// 	$('#txt_total_amout').val(GrandTotal.toFixed(2));
	// }totalcost
	function calculateGrandTotal() {
		var GrandTotal = 0;
		$('.totalcost').each(function () {
			var val = parseFloat($(this).val()) || 0;
			GrandTotal += val;
		});
		$('#dispaly_total_amout').text(GrandTotal.toFixed(2));
		$('#txt_total_amout').val(GrandTotal.toFixed(2));
	}
	$(".decimalnum").on("input", function() {
		this.value = this.value.replace(/[^0-9.]/g, ''); //
	});
	$('body').on('change', '.itemqty,.unitprice', function() {
		var Index         = $(this).data('index');
		var ItemQty       = Number($('#txt_item_quantity_req_name_'+ Index).val()) || 0;
		var ItemUnitPrice = Number($('#txt_item_estimate_no_'+ Index).val()) || 0;
		var Amount        = 0;
		var Amount        = ItemQty * ItemUnitPrice;

		$("#txt_item_amout_" + Index).val(Amount);
		$("#txt_item_total_cost_" + Index).val(Amount);
		calculateGrandTotal();
	});
	$('body').on('change', '#cmb_obj_head_id', function() {
		$("#obj_head_mode").val('');
		$("#obj_sub_proj_id").val('');
		var selected  = $(this).find('option:selected'); 
		var Subcat_id = selected.data("subcat") ?? '';
		var Objmode   = selected.data("mode") ?? '';
		$("#obj_head_mode").val(Objmode);
		$("#obj_sub_proj_id").val(Subcat_id);
	});
	$('body').on('change', '#cmb_project_id', function () {
   		var IndentProjId = $("#cmb_project_id").val();
		$.ajax({
			type: 'POST',
			url: '{{ route("indent.GetObjectHeadData") }}',
			data: {"_token": "{{ csrf_token() }}",ProjectId: IndentProjId},
			success: function (data) {
				var AllObectHead               = data.AllObjHeadData ?? [];
				var AllObjHeadSubCatGroupByData = data.AllObjHeadSubCatGroupByData ?? [];
				var ObjHeadGiaMappData          = data.ObjHeadGiaMappData ?? [];
				$("#cmb_obj_head_id").html('<option value=""> ----Select ---</option>');
				if (ObjHeadGiaMappData.length > 0) {
					$.each(ObjHeadGiaMappData, function (key, mappelement) {
						var element = AllObectHead.find(e => e.object_head_id == mappelement.object_head_id);
						if(!element) return;
						if(mappelement.is_sup_cata_applicable == true) {
							var IsSubCata = 0;
							if (AllObjHeadSubCatGroupByData[element.object_head_id] !== undefined) {
								var ObjectHeadSubCata = AllObjHeadSubCatGroupByData[element.object_head_id] ?? [];
								if(ObjectHeadSubCata.length > 0) {
									var IsSubCata = 1;
									$.each(ObjectHeadSubCata, function (key, val) {
										$("#cmb_obj_head_id").append(
											'<option value="' + val.object_head_id +'" data-subcat="' + (val.oh_sub_cata_id || '') +'" data-mode="OHSC">' +(val.oh_sub_cata_name || '') +'</option>'
										);
									});
								}	
							}
							if (IsSubCata == 0) {
								$("#cmb_obj_head_id").append(
									'<option value="' + element.object_head_id +'" data-subcat="" data-mode="OH">' +(element.object_head_name || '') +'</option>'
								);
							}
						}else{
							$("#cmb_obj_head_id").append(
								'<option value="' + element.object_head_id +'" data-subcat="" data-mode="OH">' +(element.object_head_name || '') +'</option>'
							);
						}
					});
				}
				$("#cmb_obj_head_id").trigger("chosen:updated");
			}
		});
	});
	// $('body').on('change', '.taxtype, .itemqty, .gstperc, .unitprice', function() {
	// 	var Index         = $(this).data('index');
	// 	var TaxValue      = $('#cmb_tax_type_'+ Index).val();
	// 	var ItemQty       = Number($('#txt_item_quantity_req_name_'+ Index).val()) || 0;
	// 	var ItemUnitPrice = Number($('#txt_item_estimate_no_'+ Index).val()) || 0;
	// 	var GstPerc       = Number($('#txt_item_gst_rate_'+ Index).val()) || 0;
	// 	var GstPerc       = Number($('#txt_item_gst_rate_'+ Index).val()) || 0;
	// 	var BaseAmount    = ItemQty * ItemUnitPrice;
	// 	var TotalAmt      = 0;
	// 	//console.log(TaxValue);
		
		
	// 	if (TaxValue == 'INC') {
	// 		var TaxAmount = (BaseAmount * GstPerc) / 100;
	// 		TotalAmt      = BaseAmount + TaxAmount;
	// 		//console.log(ItemUnitPrice);
			
	// 		$("#txt_item_total_cost_" + Index).prop('readonly', true);
	// 	}else if(TaxValue == 'EXCL') {
	// 		var TaxAmount = (BaseAmount * GstPerc) / 100;
	// 		TotalAmt      = BaseAmount + TaxAmount;
	// 		$("#txt_item_total_cost_" + Index).prop('readonly', false);
	// 	}
	// 	$("#txt_item_total_cost_" + Index).val(TotalAmt);
	// });
	$('body').on('change', '.taxtype, .itemqty, .gstperc, .unitprice', function() {
		var Index         = $(this).data('index');
		var TaxValue      = $('#cmb_tax_type_'+ Index).val();
		var ItemQty       = Number($('#txt_item_quantity_req_name_'+ Index).val()) || 0;
		var ItemUnitPrice = Number($('#txt_item_estimate_no_'+ Index).val()) || 0;
		var BaseAmount    = ItemQty * ItemUnitPrice;
		//console.log(TaxValue);
		if (TaxValue == 'INC') {
			$("#txt_item_total_cost_" + Index).prop('readonly', true);
		}else if(TaxValue == 'EXCL') {
			$("#txt_item_total_cost_" + Index).prop('readonly', false);
		}
		$("#txt_item_total_cost_" + Index).val(BaseAmount);
	});
	$('body').on('change', '.totalcost', function() {
		calculateGrandTotal();
	});
	
	var RelIndex = 1;
	var TotIndex = $("#hidden_total_sno").val();
	var RelIndex = (TotIndex != '') ? TotIndex : RelIndex;
	$(document).on('click','#AddTechRec',function(){
		var SNo              = $('#txt_sno_0 ').val();
		var MaterialType     = $('#cmb_material_type option:selected').text();
		var MaterialId       = $('#cmb_material_type option:selected').val();
		var GoodsserviceName = $('#txt_item_goods_service_name_0').val();
		var QuanityRequired  = $('#txt_item_quantity_req_name_0').val();
		var EstimatedPrice   = $('#txt_item_estimate_no_0').val();
		var GSTRate          = $('#txt_item_gst_rate_0').val();
		var TotalCost        = $('#txt_item_total_cost_0').val();
		var Unit             = $('#txt_unit_0').val();
		var TaxType         = $('#cmb_tax_type_0 option:selected').text();
		var TaxValue        = $('#cmb_tax_type_0 option:selected').val();
		var UnitName        = $('#cmb_unit option:selected').text();
		var UnitId          = $('#cmb_unit option:selected').val();
		var ItemAmout       = $('#txt_item_amout_0').val();
		calculateGrandTotal();

		
		let tablestr = "";
		if(SNo == ''){
			BootstrapDialog.alert("S.No. should not be empty ..!!");
			event.returnValue = false;
		// }else if(MaterialId == ''){
		// 	BootstrapDialog.alert("Select the Type Of Material Type ..!!");
		// 	event.returnValue = false;
		}else if(GoodsserviceName == ''){	
			BootstrapDialog.alert("A complete description of Goods/Services intended to be procured should not be in empty ..!!");
			event.returnValue = false;
		}else if(QuanityRequired == ''){	
			BootstrapDialog.alert("Qty Should not be in empty..!!");
			event.returnValue = false;
		}else if(UnitId == ''){	
			BootstrapDialog.alert("Select the Unit..!!");
			event.returnValue = false;
		}else if(EstimatedPrice ==''){	
			BootstrapDialog.alert("Unit Price Should not be in empty..!!");
			event.returnValue = false;
		// }else if(GSTRate == ''){	
		// 	BootstrapDialog.alert("GST %  Should not be in empty..!!");
		// 	event.returnValue = false;
		}else if(TaxValue == ''){
			BootstrapDialog.alert("Select the Tax Type...!!");
			event.returnValue = false;
		}else if(TotalCost == ''){	
			BootstrapDialog.alert("Total cost with (Approx.) Should not be in empty ..!!");
			event.returnValue = false;			
		}else{
			$.ajax({
				type: 'POST',
				url: "{{ route('indent.GetIndentAjaxData') }}",
				data: { '_token': '{{ csrf_token() }}' },
				success: function(data) {
					if (data != null) {
						var MaterialType = data.MaterialType;
        				var UnitData     = data.MaterialUnit;
						tablestr += "<tr>";
						tablestr += "<td><input type='text' style='width:100%' name='txt_sno[]' id='txt_sno_"+RelIndex+"' class='tboxsmclass decimalnum' data-index='" + RelIndex + "' value='" +SNo+ "'></td>";
						//tablestr += "<td><input type='hidden' name='txt_material_type_id[]' id='txt_material_type_id_"+RelIndex+"' class='tboxsmclass' value='" +MaterialId+ "' data-index='" + RelIndex + "'>";
						// tablestr +=  "<select name='txt_material_type[]' id='txt_material_type_"+RelIndex+"' class='tboxsmclass' data-index='" + RelIndex + "'>";
						// tablestr += "<option value=''>----Select ---</option>";
						// 	MaterialType.forEach(function(item) {
						// 		var isSelected = (item.material_type_id == MaterialId) ? 'selected="selected"' : '';
						// 		tablestr += '<option value="' + item.material_type_id + '" ' + isSelected + '>';
						// 		tablestr += item.material_type_name;
						// 		tablestr += '</option>';
						// 	});
						// tablestr += "</select>";
						tablestr += "<td><textarea style='width:100%'name='txt_item_goods_service_name[]'data-index='" + RelIndex + "' id='txt_item_goods_service_name_"+RelIndex+"'class='tboxsmclass' value='" +GoodsserviceName+ "'>" + GoodsserviceName + "</textarea></td>";
						tablestr += "<td><input type='text'style='width:100%' name='txt_item_quantity_req_name[]' data-index='" + RelIndex + "' id='txt_item_quantity_req_name_"+RelIndex+"' class='tboxsmclass decimalnum itemqty' value='"+QuanityRequired+"'></td>";
						tablestr += "<td>";
							tablestr +=  "<select name='txt_unit[]' id='txt_unit_"+RelIndex+"'data-index='" + RelIndex + "' class='tboxsmclass'>";
							tablestr += "<option value=''>----Select ---</option>";
							UnitData.forEach(function(item) {
								var isSelected = (item.uom_id == UnitId) ? 'selected="selected"' : '';
								tablestr += '<option value="' + item.uom_id + '" ' + isSelected + '>';
								tablestr += item.uom_name;
								tablestr += '</option>';
							});
							tablestr += "</select>";
						tablestr += "</td>";
						tablestr += "<td><input type='text'style='width:100%' name='txt_item_estimate_no[]'data-index='" + RelIndex + "' id='txt_item_estimate_no_"+RelIndex+"' class='tboxsmclass decimalnum unitprice' value='"+EstimatedPrice+"'></td>";
						tablestr += "<td><input type='text'style='width:100%' name='txt_item_amout[]' data-index='" + RelIndex + "'id='txt_item_amout_"+RelIndex+"' class='tboxsmclass decimalnum itemamout'readonly value='"+ItemAmout+"'></td>";
						// tablestr += "<td><input type='text'style='width:100%' name='txt_item_gst_rate[]' data-index='" + RelIndex + "'id='txt_item_gst_rate_"+RelIndex+"' class='tboxsmclass decimalnum gstperc' value='"+GSTRate+"'></td>";
						tablestr += "<td>";
							tablestr +=  "<select name='cmb_tax_type[]' id='cmb_tax_type_"+RelIndex+"' data-index='" + RelIndex + "' class='tboxsmclass taxtype'>";
								tablestr += "<option value=''>----Select ---</option>";
								tablestr += '<option value="INC" ' + (TaxValue == "INC" ? "selected" : "") + '>Inclusive</option>';
							    tablestr += '<option value="EXCL" ' + (TaxValue == "EXCL" ? "selected" : "") + '>Exclusive</option>';
							tablestr += "</select>";
						tablestr += "</td>";
						var isReadOnly = (TaxValue == 'INC') ? 'readonly' : '';
						tablestr += "<td><input type='text'style='width:100%;text-align: Right' name='txt_item_total_cost[]'data-index='" + RelIndex + "' id='txt_item_total_cost_"+RelIndex+"' class='tboxsmclass decimalnum totalcost' value='"+TotalCost+"'"+isReadOnly+"></td>";
						//tablestr += "<td><input type='text'style='width:100%;text-align: Right' name='txt_item_total_cost[]'data-index='" + RelIndex + "' id='txt_item_total_cost_"+RelIndex+"' class='tboxsmclass decimalnum ' value='"+TotalCost+"'></td>";
						tablestr += "<td align='center'><i class='fa fa-times-circle sqdel ptr disable DeleteRow' id='DelIndentDetails' style='font-size:24px'></i></i></td>";
						tablestr += "</tr>";
						$("#RelationshipTable").append(tablestr);
						SNo++;
						$('#txt_sno_0').val(SNo);
						//$('.itemno').val('');
						$('#cmb_material_type').chosen('destroy');
						$('#cmb_material_type').val('');
						$('#cmb_material_type').chosen();
						$('#txt_item_goods_service_name_0').val('');
						$('#txt_item_quantity_req_name_0').val('');
						$('#txt_item_estimate_no_0').val('');
						$('#txt_item_gst_rate_0').val('');
						$('#txt_item_total_cost_0').val('');
						$('#txt_item_total_cost_0').val('');
						$('#txt_unit_0').val('');
						$('#txt_item_amout_0').val('');
						$('#cmb_tax_type_0').val('');
						$('#cmb_unit').val('');
						RelIndex++;
					}
				}
			});
			
		}
	});
	$(document).on('click','.DeleteRow',function(){
		$(this).closest("tr").remove();
	}); 
	var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var EmployeeTypeCode   	= $("#txt_emptype_code").val();
			var EmployeeTypeName   	= $("#txt_emptype_name").val();
			//var RoleGroup 		= $("#txt_role_group").val();
			var IndentDate 		    = $("#txt_indent_date").val();
			var IndentTittle 		= $("#txt_intent_det").val();
			// var IndentProjName 	= $("#txt_project_name").val();
			var IndentProjName 		= $("#cmb_project_id").val();
			var IsProjApplicable    = $("#is_proj_applicable").val();
			var CheckMatType        = $("input[name='rad_indent_mat_type']:checked").val();
			var RegsttKit           = $("input[name='rad_regist_kit']:checked").val();
			
			if(EmployeeTypeCode == ""){
				BootstrapDialog.alert("Employee Type Code should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(EmployeeTypeName == ""){
				BootstrapDialog.alert("Employee Type Code should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(IsProjApplicable == 'Y' &&  IndentProjName =='' ){
				BootstrapDialog.alert(" Select the Project Name ..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(CheckMatType === undefined || CheckMatType === ''){
				BootstrapDialog.alert("Material Type should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;	
			}else if(RegsttKit === undefined || RegsttKit === ''){
				BootstrapDialog.alert("Slect the Indent For Registration Kit ...!!");
				event.preventDefault();
				event.returnValue = false;
			/*} else if(RoleGroup == ""){
				BootstrapDialog.alert("User Group Name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			} */
			}else if(IndentDate == ''){
				BootstrapDialog.alert("Indent Date should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(IndentTittle == ''){
				BootstrapDialog.alert("Indent Title should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			// }else if(IndentProjName == ''){
			// 	BootstrapDialog.alert("Project Name should not be empty..!!");
			// 	event.preventDefault();
			// 	event.returnValue = false;
			}else if(RelIndex == 1){
				BootstrapDialog.alert("At least add one item details..!");
				event.preventDefault();
				event.returnValue = false;	
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure you want to save the Indent Details?',
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
