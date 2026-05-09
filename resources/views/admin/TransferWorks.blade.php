@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
	if(isset($data['EmpArr'])){
        $EmpArr = $data['EmpArr'];
    }
	if(isset($data['Type'])){
        $Type = $data['Type'];
    }
	if(isset($data['EmpNo'])){
        $EmpNo = $data['EmpNo'];
    }
	if(isset($data['Status'])){
        $Status = $data['Status'];
    }
	if(isset($data['WorkData'])){
        $WorkData = $data['WorkData']; 
    }
	if(isset($data['WorkStatus'])){
        $WorkStatus = $data['WorkStatus']; 
    }
	if(isset($data['EmpRoles'])){
        $EmpRoles = $data['EmpRoles']; 
    }
	if(isset($data['RoleWithEmpArr'])){
        $RoleWithEmpArr = $data['RoleWithEmpArr']; 
    }
	$WorkStages = [
		'DEU'  => 'Tender Estimate',
		'TS'   => 'Technical Sanction',
		'NIT'  => 'Notice Inviting Tender',
		'CST'  => 'Comparative Statement',
		'NCST' => 'Negotiate Comparative Statement',
		'LOI'  => 'Letter of Acceptance(LOA)',
		'PSD'  => 'Performance Guarantee',
		'WO'   => 'Work Order',
		'RABUC'=> 'Bill Forward to Check & Approve',
		'BILLV'=> 'Bill Verification',
		'GSTR' => 'GST Reimbursement',
		'CEXP' => 'Committed Expenditure',
		'BDES' => 'Additional Quantity,Extra,Substitute',
		'RECOMM' => 'EMD,PSD and SD Release',
		'SD' => 'Security Deposit'
	];	
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
								<div class="div12 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Employee Pending Works</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">																	
											<div class="row smclearrow"></div>   
											<div class="row">
												<table class="table-bordered dataTable no-footer" align="center" id="dataTable">
													<thead>
														<tr>
															<th class="colhead" colspan="2" nowrap="nowrap">
																
															</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td class="colhead" style="vertical-align:top; width:15%;">
																<div class="form">
																	
																	<div class="label" align="left">Employee Name <span class="reqindi">*</span></div>
																	<div class="row smclearrow"></div>											
																	<div>
																		<select name="cmb_emp_no" id="cmb_emp_no" class="textboxdisplay">
																			<option value="">--------------- Select ---------------</option>
                                            							    @if(isset($EmpArr))
																				@foreach($EmpArr as $key => $value)
																				@php 
																					if((isset($EmpNo))&&($EmpNo == $key)){
																						$Str = "selected='selected'";																				
																					}else{
																						$Str = "";
																					}
																				@endphp
																				    <option {{$Str}} value="{{$key}}">{{$key}} - {{$value}}</option>
																				@endforeach
                                            							    @endif
																		</select>                                            
																	</div>																	
																	<div class="row smclearrow"></div>																																
																	
																	<div class="label" align="left">Select the Modules <span class="reqindi">*</span></div>	
																	<div class="row smclearrow"></div>										
																	<div align="center">
																		<div class="inputGroup paddlr2 row"> 
																			<input id="ch_est" class="role_checkbox" name="module_name[]" type="checkbox" @if(in_array('DEU',$WorkStatus)) checked @endif value="DEU"/>
																			<label for="ch_est" style="padding:3px 0px;"> &nbsp;Estimate</label> 
																		</div>
																		<div class="row smclearrow"></div>
																		<div class="inputGroup paddlr2 row"> 
																			<input id="ch_tech_sanc" class="role_checkbox" name="module_name[]" type="checkbox" @if(in_array('TS',$WorkStatus)) checked @endif value="TS"/>
																			<label for="ch_tech_sanc" style="padding:3px 0px;"> &nbsp;Technical Sanction</label> 
																		</div> 
																		<div class="row smclearrow"></div>
																		<div class="inputGroup paddlr2 row"> 
																			<input id="ch_nit" class="role_checkbox" name="module_name[]" type="checkbox"  @if(in_array('NIT',$WorkStatus)) checked @endif value="NIT"/>
																			<label for="ch_nit" style="padding:3px 0px;"> &nbsp; NIT</label> 
																		</div>
																		<div class="row smclearrow"></div>
																		<div class="inputGroup paddlr2 row"> 
																			<input id="ch_cst" class="role_checkbox" name="module_name[]" type="checkbox" @if(in_array('CST',$WorkStatus)) checked @endif value="CST"/>
																			<label for="ch_cst" style="padding:3px 0px;"> &nbsp; CST</label> 
																		</div>
																		<div class="row smclearrow"></div>
																		<div class="inputGroup paddlr2 row"> 
																			<input id="ch_ncst" class="role_checkbox" name="module_name[]" type="checkbox" @if(in_array('NCST',$WorkStatus)) checked @endif value="NCST"/>
																			<label for="ch_ncst" style="padding:3px 0px;"> &nbsp; Negotiation CST</label> 
																		</div>
																		<div class="row smclearrow"></div>
																		<div class="inputGroup paddlr2 row"> 
																			<input id="ch_loa" class="role_checkbox" name="module_name[]" type="checkbox" @if(in_array('LOI',$WorkStatus)) checked @endif value="LOI"/>
																			<label for="ch_loa" style="padding:3px 0px;"> &nbsp; LOA</label> 
																		</div>
																		<div class="row smclearrow"></div>
																		<div class="inputGroup paddlr2 row"> 
																			<input id="ch_psd" class="role_checkbox" name="module_name[]" type="checkbox" @if(in_array('PSD',$WorkStatus)) checked @endif value="PSD"/>
																			<label for="ch_psd" style="padding:3px 0px;"> &nbsp; PSD</label> 
																		</div>
																		<div class="row smclearrow"></div>
																		<div class="inputGroup paddlr2 row"> 
																			<input id="ch_Work_order" class="role_checkbox" name="module_name[]" type="checkbox" @if(in_array('WO',$WorkStatus)) checked @endif value="WO"/>
																			<label for="ch_Work_order" style="padding:3px 0px;"> &nbsp; Work Order</label> 
																		</div>
																		<div class="row smclearrow"></div>
																		<div class="inputGroup paddlr2 row"> 
																			<input id="ch_rab_check_app" class="role_checkbox" name="module_name[]" type="checkbox" @if(in_array('RABUC',$WorkStatus)) checked @endif value="RABUC"/>
																			<label for="ch_rab_check_app" style="padding:3px 0px;"> &nbsp; Bill Forward to Check & Approve</label> 
																		</div>
																		<div class="row smclearrow"></div>
																		<div class="inputGroup paddlr2 row"> 
																			<input id="ch_billv" class="role_checkbox" name="module_name[]" type="checkbox" @if(in_array('BILLV',$WorkStatus)) checked @endif value="BILLV"/>
																			<label for="ch_billv" style="padding:3px 0px;"> &nbsp; Bill Verification</label> 
																		</div>     
																		<div class="row smclearrow"></div>
																		<div class="inputGroup paddlr2 row"> 
																			<input id="ch_gst_re" class="role_checkbox" name="module_name[]" type="checkbox" @if(in_array('GSTR',$WorkStatus)) checked @endif value="GSTR"/>
																			<label for="ch_gst_re" style="padding:3px 0px;"> &nbsp; GST Reimbursement</label> 
																		</div>
																		<div class="row smclearrow"></div>
																		<div class="inputGroup paddlr2 row"> 
																			<input id="ch_comm_exp" class="role_checkbox" name="module_name[]" type="checkbox" @if(in_array('CEXP',$WorkStatus)) checked @endif value="CEXP"/>
																			<label for="ch_comm_exp" style="padding:3px 0px;"> &nbsp; Committed Expenditure</label> 
																		</div>
																		<div class="row smclearrow"></div>
																		<div class="inputGroup paddlr2 row"> 
																			<input id="ch_add_ext_sub" class="role_checkbox" name="module_name[]" type="checkbox" @if(in_array('BDES',$WorkStatus)) checked @endif value="BDES"/>
																			<label for="ch_add_ext_sub" style="padding:3px 0px;"> &nbsp; Additional Quantity,Extra,Substitute</label> 
																		</div>
																		<div class="row smclearrow"></div>
																		<div class="inputGroup paddlr2 row"> 
																			<input id="ch_recomm_rel" class="role_checkbox" name="module_name[]" type="checkbox" @if(in_array('RECOMM',$WorkStatus)) checked @endif value="RECOMM"/>
																			<label for="ch_recomm_rel" style="padding:3px 0px;"> &nbsp; EMD,PSD and SD Release</label> 
																		</div>
																		<div class="row smclearrow"></div>
																		<div class="inputGroup paddlr2 row"> 
																			<input id="ch_sec_dep" class="role_checkbox" name="module_name[]" type="checkbox" @if(in_array('RECOMM',$WorkStatus)) checked @endif value="SD"/>
																			<label for="ch_sec_dep" style="padding:3px 0px;"> &nbsp; Security Deposit</label> 
																		</div>                                                                           
																	</div>	
																	
																	<div class="row smclearrow"></div>
																	<div>
																		<div class="label" align="left">Status <span class="reqindi">*</span></div>
																		
																		<div align="center">
																			<select name="cmb_status" id="cmb_status" class="textboxdisplay"  style="width: 70%;">
																				<option value="">-------------- Select ---------------</option>
																				@php 
																					$SdStr = "";
																					$SuStr = "selected='selected'";
																					if((isset($Status))&&($Status == 'SD')){
																						$SdStr = "selected='selected'";
																					}
																				@endphp
                                            								    <option {{$SuStr}} value="SU">Pending Files</option>
                                            								    <!-- <option {{$SdStr}} value="SD">Save as Draft Files</option> -->
																			</select> 
																		</div>																	
																	</div>
																	<div class="row smclearrow"></div>
																	<div class="row smclearrow"></div>
																	<div align="center">
																		<input type="submit" name="btn_next" id="btn_next" class="backbutton" value=" Get Work " />
																	</div>
																</div>
															</td>
															<td class="colhead" style="vertical-align:top;width:50%;">
																@if(isset($Type) && $Type == "VIEW")
																	@foreach($EmpRoles as $Role)
																	<div class='widget'>
																		<div id='TAB{{ $Role->role_id; }}-{{$Role->division_id}}-{{$Role->section_id}}-{{$Role->sub_section_id}}' data-title='{{ $Role->role_name; }} (@if($Role->role_group_code == "ACCUSER")@if(isset($Role->section)){{$Role->section}}@else{{$Role->division_short_name}} @endif @else{{$Role->division_short_name}}@endif)' class="tab-content">
																			<table class="div12 group-table itemtable formtable" width="99%">
																				@foreach($data['WorkStatus'] as $ModCode)	
																					<thead>
																						<tr align="center" style="border-left: 1px solid white; border-right: 1px solid white;">
																							<td colspan="7">
																								<span class="rbadge1 rbadgeC tooltip-l"><b>{{$WorkStages[$ModCode]}}</b></span>
																								<!-- <button > Transfer all</button> -->
																							</td>													
																						</tr>
                            															<tr>
																							<th class="lboxlabel" style="text-align:center;">SNo.</th>
																							<th class="cboxlabel" style="text-align:center;">Ref No.</th>																																														
																							@if(($ModCode == 'RABUC') || ($ModCode == 'BILLV') || ($ModCode == 'GSTR') || ($ModCode == 'RECOMM'))
																								<th class="cboxlabel" style="text-align:center;">Work Name</th>
																								<th class="cboxlabel" style="text-align:center;">@if($ModCode == 'RECOMM')Contractor Name @else Rab @endif</th>
																								@php $Rowspan = 1;@endphp
																							@else
																								<th class="cboxlabel" style="text-align:center;" colspan="2">Work Name</th>
																								@php $Rowspan = 2;@endphp
																							@endif																							
																							<th class="cboxlabel" style="text-align:center;" >Select Work</th>
																							<th class="cboxlabel" style="text-align:center;" nowrap="">Transfer To</th>
																							<th class="cboxlabel" style="text-align:center;"> Action </th>
																						</tr>
																					</thead>
																					<tbody>
																						@php $RoleWiseData = array(); @endphp
																						@if(isset($WorkData[$ModCode]) && count($WorkData[$ModCode]) > 0)
																						@php 
																							$WorkCount = 0;
																							$RoleId = $Role->role_id;																							
																							$RoleGroupCode = $Role->role_group_code;
																							if($RoleGroupCode == 'ACCUSER'){ 
																								$RoleDivId = $Role->section_id;
																								if($RoleDivId == NULL){
																									$RoleDivId = $Role->division_id; 
																								}
																								if($ModCode == 'BILLV'){
																									$RoleWiseData = collect($WorkData[$ModCode])->where('to_role',$RoleId)->where('accounts_section_id',$RoleDivId);
																								}else{																									
																									$RoleWiseData = collect($WorkData[$ModCode])->where('to_roleid',$RoleId)->where('accounts_section_id',$RoleDivId);  
																								}
																								if(!filled($RoleWiseData)){
																									$RoleWiseData = collect($WorkData[$ModCode])->where('to_roleid',$RoleId);
																								}
																							}else{
																								$RoleDivId = $Role->division_id;
																								if($ModCode == 'RECOMM'){
																									$InstPurpose = array_keys($WorkData[$ModCode]->toArray());
																									foreach($InstPurpose as $Type){ 
																										$RoleWiseData = collect($WorkData[$ModCode][$Type])->where('to_roleid',$RoleId)->where('division_code',$RoleDivId);																										
																									}
																									$RoleWiseData = $RoleWiseData->unique('recommendid');
																								}else{ 
																									if(isset($RoleDivId)){
																										$RoleWiseData = collect($WorkData[$ModCode])->where('to_roleid',$RoleId)->where('division_code',$RoleDivId);
																									}
																									if(!filled($RoleWiseData)){
																										$RoleWiseData = collect($WorkData[$ModCode])->where('to_roleid',$RoleId);
																									}
																								}																	
																							}
																							$RoleWiseEmp = $RoleWithEmpArr[$RoleDivId.'-'.$RoleId]; 
																							$WorkCount = count($RoleWiseData); 
																						@endphp
																							@if(isset($RoleWiseData) &&  $WorkCount > 0)
																								@foreach($RoleWiseData as $Value)																								
																									@if($ModCode == 'DEU')
																									<tr>
																										<td class="lboxlabel" style="text-align:center;background-color:white">{{$loop->iteration}}.</td>
																										<td style="text-align:justify;background-color:white">{{$Value->ref_no}}</td>
																										<td style="text-align:justify;background-color:white" colspan="{{$Rowspan}}">{{$Value->cr_work_name}}</td>
																										<td style="text-align:justify;background-color:white">
																											<div class="checkbox-wrapper-19" align="middle">
																											  	<input type="checkbox" id="cb_select_work-{{$Value->globid}}" class="workcheckbox{{$ModCode}}{{$RoleId}}{{$RoleDivId}}" value="@if(isset($Value->globid)){{encrypt($Value->globid)}}@endif"/>
																											  	<label for="cb_select_work-{{$Value->globid}}" class="check-box">
																											</div>
																										</td>																										
																										@if ($loop->first)
																											<td style="background-color:white;width:15%; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<select name="cmb_transfer_to" id="cmb_transfer_to_{{$ModCode}}{{$RoleId}}{{$RoleDivId}}"  class="textboxdisplay transferemp"  style="width: 100%;">
																													<option value="">------- Select -------</option>																												
																													@foreach($RoleWiseEmp as $Emp)
                                            																	    	<option value="{{$Emp->employee_no}}">{{$Emp->emp_known_as}}</option>
																													@endforeach
																												</select>
																											</td>
																											<td style="background-color:white; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<button type="button"  class="btn btn-default tuploadbtn btn_transfer" title="Click here to Transfer Work" style="cursor: pointer;" data-code="{{$ModCode}}"  value="{{$RoleId}}{{$RoleDivId}}"><i class="fa fa-check"></i> Transfer</button>
																											</td>
																										@endif
																									</tr>
																									@elseif($ModCode == 'TS')
																									<tr>
																										<td class="lboxlabel" style="text-align:center;background-color:white">{{$loop->iteration}}.</td>
																										<td style="text-align:justify;background-color:white">{{$Value->ts_no}}</td>
																										<td style="text-align:justify;background-color:white" colspan="{{$Rowspan}}">{{$Value->ts_work_name}}</td>
																										<td style="text-align:justify;background-color:white">
																											<div class="checkbox-wrapper-19" align="middle">
																											  	<input type="checkbox" id="cb_select_work-{{$Value->globid}}" class="workcheckbox{{$ModCode}}{{$RoleId}}{{$RoleDivId}}" value="@if(isset($Value->globid)){{encrypt($Value->globid)}}@endif"/>
																											  	<label for="cb_select_work-{{$Value->globid}}" class="check-box">
																											</div>
																										</td>																										
																										@if ($loop->first)
																											<td style="background-color:white;width:15%; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<select name="cmb_transfer_to" id="cmb_transfer_to_{{$ModCode}}{{$RoleId}}{{$RoleDivId}}"  class="textboxdisplay transferemp"  style="width: 100%;">
																													<option value="">------- Select -------</option>																												
																													@foreach($RoleWiseEmp as $Emp)
                                            																	    	<option value="{{$Emp->employee_no}}">{{$Emp->emp_known_as}}</option>
																													@endforeach
																												</select>
																											</td>
																											<td style="background-color:white; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<button type="button"  class="btn btn-default tuploadbtn btn_transfer" title="Click here to Transfer Work" style="cursor: pointer;" data-code="{{$ModCode}}"   value="{{$RoleId}}{{$RoleDivId}}"><i class="fa fa-check"></i> Transfer</button>
																											</td>
																										@endif
																									</tr>
																									@elseif($ModCode == 'NIT')
																									<tr>
																										<td class="lboxlabel" style="text-align:center;background-color:white">{{$loop->iteration}}.</td>
																										<td style="text-align:justify;background-color:white">{{$Value->tr_no}}</td>
																										<td style="text-align:justify;background-color:white" colspan="{{$Rowspan}}">{{$Value->tr_work_name}}</td>
																										<td style="text-align:justify;background-color:white">
																											<div class="checkbox-wrapper-19" align="middle">
																											  	<input type="checkbox" id="cb_select_work-{{$Value->globid}}" class="workcheckbox{{$ModCode}}{{$RoleId}}{{$RoleDivId}}" value="@if(isset($Value->globid)){{encrypt($Value->globid)}}@endif"/>
																											  	<label for="cb_select_work-{{$Value->globid}}" class="check-box">
																											</div>
																										</td>																										
																										@if ($loop->first)
																											<td style="background-color:white;width:15%; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<select name="cmb_transfer_to" id="cmb_transfer_to_{{$ModCode}}{{$RoleId}}{{$RoleDivId}}"  class="textboxdisplay transferemp"  style="width: 100%;">
																													<option value="">------- Select -------</option>																												
																													@foreach($RoleWiseEmp as $Emp)
                                            																	    	<option value="{{$Emp->employee_no}}">{{$Emp->emp_known_as}}</option>
																													@endforeach
																												</select>
																											</td>
																											<td style="background-color:white; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<button type="button"  class="btn btn-default tuploadbtn btn_transfer" title="Click here to Transfer Work" style="cursor: pointer;" data-code="{{$ModCode}}"   value="{{$RoleId}}{{$RoleDivId}}"><i class="fa fa-check"></i> Transfer</button>
																											</td>
																										@endif
																									</tr>
																									@elseif($ModCode == 'CST')
																									<tr>
																										<td class="lboxlabel" style="text-align:center;background-color:white">{{$loop->iteration}}.</td>
																										<td style="text-align:justify;background-color:white">{{$Value->tr_no}}</td>
																										<td style="text-align:justify;background-color:white" colspan="{{$Rowspan}}">{{$Value->tr_work_name}}</td>
																										<td style="text-align:justify;background-color:white">
																											<div class="checkbox-wrapper-19" align="middle">
																											  	<input type="checkbox" id="cb_select_work-{{$Value->globid}}" class="workcheckbox{{$ModCode}}{{$RoleId}}{{$RoleDivId}}" value="@if(isset($Value->globid)){{encrypt($Value->globid)}}@endif"/>
																											  	<label for="cb_select_work-{{$Value->globid}}" class="check-box">
																											</div>
																										</td>																										
																										@if ($loop->first)
																											<td style="background-color:white;width:15%; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<select name="cmb_transfer_to" id="cmb_transfer_to_{{$ModCode}}{{$RoleId}}{{$RoleDivId}}"  class="textboxdisplay transferemp"  style="width: 100%;">
																													<option value="">------- Select -------</option>																												
																													@foreach($RoleWiseEmp as $Emp)
                                            																	    	<option value="{{$Emp->employee_no}}">{{$Emp->emp_known_as}}</option>
																													@endforeach
																												</select>
																											</td>
																											<td style="background-color:white; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<button type="button"  class="btn btn-default tuploadbtn btn_transfer" title="Click here to Transfer Work" style="cursor: pointer;" data-code="{{$ModCode}}"   value="{{$RoleId}}{{$RoleDivId}}"><i class="fa fa-check"></i> Transfer</button>
																											</td>
																										@endif
																									</tr>
																									@elseif($ModCode == 'NCST')
																									<tr>
																										<td class="lboxlabel" style="text-align:center;background-color:white">{{$loop->iteration}}.</td>
																										<td style="text-align:justify;background-color:white">{{$Value->tr_no}}</td>
																										<td style="text-align:justify;background-color:white" colspan="{{$Rowspan}}">{{$Value->tr_work_name}}</td>
																										<td style="text-align:justify;background-color:white">
																											<div class="checkbox-wrapper-19" align="middle">
																											  	<input type="checkbox" id="cb_select_work-{{$Value->globid}}" class="workcheckbox{{$ModCode}}{{$RoleId}}{{$RoleDivId}}" value="@if(isset($Value->globid)){{encrypt($Value->globid)}}@endif"/>
																											  	<label for="cb_select_work-{{$Value->globid}}" class="check-box">
																											</div>
																										</td>																										
																										@if ($loop->first)
																											<td style="background-color:white;width:15%; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<select name="cmb_transfer_to" id="cmb_transfer_to_{{$ModCode}}{{$RoleId}}{{$RoleDivId}}"  class="textboxdisplay transferemp"  style="width: 100%;">
																													<option value="">------- Select -------</option>																												
																													@foreach($RoleWiseEmp as $Emp)
                                            																	    	<option value="{{$Emp->employee_no}}">{{$Emp->emp_known_as}}</option>
																													@endforeach
																												</select>
																											</td>
																											<td style="background-color:white; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<button type="button"  class="btn btn-default tuploadbtn btn_transfer" title="Click here to Transfer Work" style="cursor: pointer;" data-code="{{$ModCode}}"   value="{{$RoleId}}{{$RoleDivId}}"><i class="fa fa-check"></i> Transfer</button>
																											</td>
																										@endif
																									</tr>
																									@elseif($ModCode == 'LOI')
																									<tr>
																										<td class="lboxlabel" style="text-align:center;background-color:white">{{$loop->iteration}}.</td>
																										<td style="text-align:justify;background-color:white">{{$Value->loa_no}}</td>
																										<td style="text-align:justify;background-color:white" colspan="{{$Rowspan}}">{{$Value->tr_work_name}}</td>
																										<td style="text-align:justify;background-color:white">
																											<div class="checkbox-wrapper-19" align="middle">
																											  	<input type="checkbox" id="cb_select_work-{{$Value->globid}}" class="workcheckbox{{$ModCode}}{{$RoleId}}{{$RoleDivId}}" value="@if(isset($Value->globid)){{encrypt($Value->globid)}}@endif"/>
																											  	<label for="cb_select_work-{{$Value->globid}}" class="check-box">
																											</div>
																										</td>																										
																										@if ($loop->first)
																											<td style="background-color:white;width:15%; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<select name="cmb_transfer_to" id="cmb_transfer_to_{{$ModCode}}{{$RoleId}}{{$RoleDivId}}"  class="textboxdisplay transferemp"  style="width: 100%;">
																													<option value="">------- Select -------</option>																												
																													@foreach($RoleWiseEmp as $Emp)
                                            																	    	<option value="{{$Emp->employee_no}}">{{$Emp->emp_known_as}}</option>
																													@endforeach
																												</select>
																											</td>
																											<td style="background-color:white; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<button type="button"  class="btn btn-default tuploadbtn btn_transfer" title="Click here to Transfer Work" style="cursor: pointer;" data-code="{{$ModCode}}"   value="{{$RoleId}}{{$RoleDivId}}"><i class="fa fa-check"></i> Transfer</button>
																											</td>
																										@endif
																									</tr>
																									@elseif($ModCode == 'PSD')
																									<tr>
																										<td class="lboxlabel" style="text-align:center;background-color:white">{{$loop->iteration}}.</td>
																										<td style="text-align:justify;background-color:white">{{$Value->tr_no}}</td>
																										<td style="text-align:justify;background-color:white" colspan="{{$Rowspan}}">{{$Value->tr_work_name}}</td>
																										<td style="text-align:justify;background-color:white">
																											<div class="checkbox-wrapper-19" style="vertical-align:middle;" align="middle">
																											  	<input type="checkbox" id="cb_select_work-{{$Value->globid}}" class="workcheckbox{{$ModCode}}{{$RoleId}}{{$RoleDivId}}" value="@if(isset($Value->globid)){{encrypt($Value->globid)}}@endif"/>
																											  	<label for="cb_select_work-{{$Value->globid}}" class="check-box">
																											</div>
																										</td>																										
																										@if ($loop->first)
																											<td style="background-color:white;width:15%; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<select name="cmb_transfer_to" id="cmb_transfer_to_{{$ModCode}}{{$RoleId}}{{$RoleDivId}}"  class="textboxdisplay transferemp"  style="width: 100%;">
																													<option value="">------- Select -------</option>																												
																													@foreach($RoleWiseEmp as $Emp)
                                            																	    	<option value="{{$Emp->employee_no}}">{{$Emp->emp_known_as}}</option>
																													@endforeach
																												</select>
																											</td>
																											<td style="background-color:white; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<button type="button"  class="btn btn-default tuploadbtn btn_transfer" title="Click here to Transfer Work" style="cursor: pointer;" data-code="{{$ModCode}}"   value="{{$RoleId}}{{$RoleDivId}}"><i class="fa fa-check"></i> Transfer</button>
																											</td>
																										@endif
																									</tr>																									
																									@elseif($ModCode == 'WO')
																									<tr>
																										<td class="lboxlabel" style="text-align:center;background-color:white">{{$loop->iteration}}.</td>
																										<td style="text-align:justify;background-color:white">{{$Value->work_order_no}}</td>
																										<td style="text-align:justify;background-color:white" colspan="{{$Rowspan}}">{{$Value->work_name}}</td>
																										<td style="text-align:justify;background-color:white">
																											<div class="checkbox-wrapper-19" align="middle">
																											  	<input type="checkbox" id="cb_select_work-{{$Value->sheetid}}" class="workcheckbox{{$ModCode}}{{$RoleId}}{{$RoleDivId}}" value="@if(isset($Value->sheetid)){{encrypt($Value->sheetid)}}@endif"/>
																											  	<label for="cb_select_work-{{$Value->sheetid}}" class="check-box">
																											</div>
																										</td>																										
																										@if ($loop->first)
																											<td style="background-color:white;width:15%; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<select name="cmb_transfer_to" id="cmb_transfer_to_{{$ModCode}}{{$RoleId}}{{$RoleDivId}}"  class="textboxdisplay transferemp"  style="width: 100%;">
																													<option value="">------- Select -------</option>																												
																													@foreach($RoleWiseEmp as $Emp)
                                            																	    	<option value="{{$Emp->employee_no}}">{{$Emp->emp_known_as}}</option>
																													@endforeach
																												</select>
																											</td>
																											<td style="background-color:white; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<button type="button"  class="btn btn-default tuploadbtn btn_transfer" title="Click here to Transfer Work" style="cursor: pointer;" data-code="{{$ModCode}}"   value="{{$RoleId}}{{$RoleDivId}}"><i class="fa fa-check"></i> Transfer</button>
																											</td>
																										@endif
																									</tr>
																									@elseif($ModCode == 'RABUC')
																									<tr>
																										<td class="lboxlabel" style="text-align:center;background-color:white">{{$loop->iteration}}.</td>
																										<td style="text-align:justify;background-color:white">{{$Value->work_order_no}}</td>
																										<td style="text-align:justify;background-color:white">{{$Value->work_name}}</td>
																										<td style="vertical-align:middle;background-color:white">{{$Value->rbn}}</td>
																										<td style="text-align:justify;background-color:white" style="vertical-align:middle;">
																											<div class="checkbox-wrapper-19" align="middle">
																											  	<input type="checkbox" id="cb_select_work-{{$Value->sheetid}}" class="workcheckbox{{$ModCode}}{{$RoleId}}{{$RoleDivId}}" value="@if(isset($Value->rbnchid)){{encrypt($Value->rbnchid)}}@endif"/>
																											  	<label for="cb_select_work-{{$Value->sheetid}}" class="check-box">
																											</div>
																										</td>																										
																										@if($loop->first)
																											<td style="background-color:white;width:15%; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<select name="cmb_transfer_to" id="cmb_transfer_to_{{$ModCode}}{{$RoleId}}{{$RoleDivId}}"  class="textboxdisplay transferemp"  style="width: 100%;">
																													<option value="">------- Select -------</option>																												
																													@foreach($RoleWiseEmp as $Emp)
                                            																	    	<option value="{{$Emp->employee_no}}">{{$Emp->emp_known_as}}</option>
																													@endforeach
																												</select>
																											</td>
																											<td style="background-color:white; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<button type="button"  class="btn btn-default tuploadbtn btn_transfer" title="Click here to Transfer Work" style="cursor: pointer;" data-code="{{$ModCode}}"   value="{{$RoleId}}{{$RoleDivId}}"><i class="fa fa-check"></i> Transfer</button>
																											</td>
																										@endif
																									</tr>
																									@elseif($ModCode == 'BILLV')
																									<tr>
																										<td class="lboxlabel" style="text-align:center;background-color:white">{{$loop->iteration}}.</td>
																										<td style="text-align:justify;background-color:white">{{$Value->work_order_no}}</td>
																										<td style="text-align:justify;background-color:white">{{$Value->work_name}}</td>
																										<td style="vertical-align:middle;background-color:white">{{$Value->rbn}}</td>
																										<td style="text-align:justify;background-color:white" style="vertical-align:middle;">
																											<div class="checkbox-wrapper-19" align="middle">
																											  	<input type="checkbox" id="cb_select_work-{{$Value->sheetid}}" class="workcheckbox{{$ModCode}}{{$RoleId}}{{$RoleDivId}}" value="@if(isset($Value->sheetid)){{encrypt($Value->sheetid.'-'.$Value->rbn)}}@endif"/>
																											  	<label for="cb_select_work-{{$Value->sheetid}}" class="check-box">
																											</div>
																										</td>																										
																										@if ($loop->first)
																											<td style="background-color:white;width:15%; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<select name="cmb_transfer_to" id="cmb_transfer_to_{{$ModCode}}{{$RoleId}}{{$RoleDivId}}"  class="textboxdisplay transferemp"  style="width: 100%;">
																													<option value="">------- Select -------</option>																												
																													@foreach($RoleWiseEmp as $Emp)
                                            																	    	<option value="{{$Emp->employee_no}}">{{$Emp->emp_known_as}}</option>
																													@endforeach
																												</select>
																											</td>
																											<td style="background-color:white; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<button type="button"  class="btn btn-default tuploadbtn btn_transfer" title="Click here to Transfer Work" style="cursor: pointer;" data-code="{{$ModCode}}"  data-role="{{encrypt($RoleId)}}" value="{{$RoleId}}{{$RoleDivId}}"><i class="fa fa-check"></i> Transfer</button>
																											</td>
																										@endif
																									</tr>
																									@elseif($ModCode == 'GSTR')
																									<tr>
																										<td class="lboxlabel" style="text-align:center;background-color:white">{{$loop->iteration}}.</td>
																										<td style="text-align:justify;background-color:white">{{$Value->work_order_no}}</td>
																										<td style="text-align:justify;background-color:white">{{$Value->work_name}}</td>
																										<td style="vertical-align:middle;background-color:white">{{$Value->gst_reimb_for_rbn}}</td>
																										<td style="text-align:justify;background-color:white" style="vertical-align:middle;">
																											<div class="checkbox-wrapper-19" align="middle">
																											  	<input type="checkbox" id="cb_select_work-{{$Value->grimbid}}" class="workcheckbox{{$ModCode}}{{$RoleId}}{{$RoleDivId}}" value="@if(isset($Value->grimbid)){{encrypt($Value->grimbid)}}@endif"/>
																											  	<label for="cb_select_work-{{$Value->grimbid}}" class="check-box">
																											</div>
																										</td>																										
																										@if ($loop->first)
																											<td style="background-color:white;width:15%; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<select name="cmb_transfer_to" id="cmb_transfer_to_{{$ModCode}}{{$RoleId}}{{$RoleDivId}}"  class="textboxdisplay transferemp"  style="width: 100%;">
																													<option value="">------- Select -------</option>																												
																													@foreach($RoleWiseEmp as $Emp)
                                            																	    	<option value="{{$Emp->employee_no}}">{{$Emp->emp_known_as}}</option>
																													@endforeach
																												</select>
																											</td>
																											<td style="background-color:white; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<button type="button"  class="btn btn-default tuploadbtn btn_transfer" title="Click here to Transfer Work" style="cursor: pointer;" data-code="{{$ModCode}}"   value="{{$RoleId}}{{$RoleDivId}}"><i class="fa fa-check"></i> Transfer</button>
																											</td>
																										@endif
																									</tr>
																									@elseif($ModCode == 'CEXP')
																									<tr>
																										<td class="lboxlabel" style="text-align:center;background-color:white">{{$loop->iteration}}.</td>
																										<td style="text-align:justify;background-color:white">{{$Value->work_order_no}}</td>
																										<td style="text-align:justify;background-color:white" colspan="{{$Rowspan}}">{{$Value->work_name}}</td>																										
																										<td style="text-align:justify;background-color:white" style="vertical-align:middle;">
																											<div class="checkbox-wrapper-19" align="middle">
																											  	<input type="checkbox" id="cb_select_work-{{$Value->cexpid}}" class="workcheckbox{{$ModCode}}{{$RoleId}}{{$RoleDivId}}" value="@if(isset($Value->cexpid)){{encrypt($Value->cexpid)}}@endif"/>
																											  	<label for="cb_select_work-{{$Value->cexpid}}" class="check-box">
																											</div>
																										</td>																										
																										@if ($loop->first)
																											<td style="background-color:white;width:15%; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<select name="cmb_transfer_to" id="cmb_transfer_to_{{$ModCode}}{{$RoleId}}{{$RoleDivId}}"  class="textboxdisplay transferemp"  style="width: 100%;">
																													<option value="">------- Select -------</option>																												
																													@foreach($RoleWiseEmp as $Emp)
                                            																	    	<option value="{{$Emp->employee_no}}">{{$Emp->emp_known_as}}</option>
																													@endforeach
																												</select>
																											</td>
																											<td style="background-color:white; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<button type="button"  class="btn btn-default tuploadbtn btn_transfer" title="Click here to Transfer Work" style="cursor: pointer;" data-code="{{$ModCode}}"   value="{{$RoleId}}{{$RoleDivId}}"><i class="fa fa-check"></i> Transfer</button>
																											</td>
																										@endif
																									</tr>
																									@elseif($ModCode == 'BDES')
																									<tr>
																										<td class="lboxlabel" style="text-align:center;background-color:white">{{$loop->iteration}}.</td>
																										<td style="text-align:justify;background-color:white">{{$Value->work_order_no}}</td>
																										<td style="text-align:justify;background-color:white" colspan="{{$Rowspan}}">{{$Value->work_name}}</td>																										
																										<td style="text-align:justify;background-color:white" style="vertical-align:middle;">
																											<div class="checkbox-wrapper-19" align="middle">
																											  	<input type="checkbox" id="cb_select_work-{{$Value->globid}}" class="workcheckbox{{$ModCode}}{{$RoleId}}{{$RoleDivId}}" value="@if(isset($Value->desid)){{encrypt($Value->desid)}}@endif"/>
																											  	<label for="cb_select_work-{{$Value->globid}}" class="check-box">
																											</div>
																										</td>																										
																										@if ($loop->first)
																											<td style="background-color:white;width:15%; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<select name="cmb_transfer_to" id="cmb_transfer_to_{{$ModCode}}{{$RoleId}}{{$RoleDivId}}"  class="textboxdisplay transferemp"  style="width: 100%;">
																													<option value="">------- Select -------</option>																												
																													@foreach($RoleWiseEmp as $Emp)
                                            																	    	<option value="{{$Emp->employee_no}}">{{$Emp->emp_known_as}}</option>
																													@endforeach
																												</select>
																											</td>
																											<td style="background-color:white; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<button type="button"  class="btn btn-default tuploadbtn btn_transfer" title="Click here to Transfer Work" style="cursor: pointer;" data-code="{{$ModCode}}"   value="{{$RoleId}}{{$RoleDivId}}"><i class="fa fa-check"></i> Transfer</button>
																											</td>
																										@endif
																									</tr>
																									@elseif($ModCode == 'RECOMM')
																									<tr>
																										<td class="lboxlabel" style="text-align:center;background-color:white">{{$loop->iteration}}.</td>
																										<td style="text-align:justify;background-color:white">{{$Value->tr_no}}</td>
																										<td style="text-align:justify;background-color:white" >{{$Value->tr_work_name}}</td>
																										@php
																										$Flagstr = '';
																										if($Value->inst_purpose == 'EMD'){																											
																											if($Value->bidder_flag == 'OL1'){
																												$Flagstr = 'EMD Release for Other than L1';
																											}
																											elseif($Value->bidder_flag == 'L1'){
																												$Flagstr = 'EMD Release for L1';
																											}
																										}elseif($Value->inst_purpose == 'PSD'){
																											$Flagstr = "PSD Release";
																										}elseif($Value->inst_purpose == 'SD'){
																											$Flagstr = "SD Release";
																										}
																										@endphp
																										<td style="text-align:left;background-color:white"><span style="color:red;font-weight:bold;">{{$Value->contractor_title}} {{$Value->name_contractor}}</span><br>({{$Flagstr}})</td>																										
																										<td style="text-align:justify;background-color:white" style="vertical-align:middle;">
																											<div class="checkbox-wrapper-19" align="middle">
																											  	<input type="checkbox" id="cb_select_work-{{$Value->recommendid}}" class="workcheckbox{{$ModCode}}{{$RoleId}}{{$RoleDivId}}" value="@if(isset($Value->recommendid)){{encrypt($Value->recommendid)}}@endif"/>
																											  	<label for="cb_select_work-{{$Value->recommendid}}" class="check-box">
																											</div>
																										</td>																										
																										@if ($loop->first)
																											<td style="background-color:white;width:15%; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<select name="cmb_transfer_to" id="cmb_transfer_to_{{$ModCode}}{{$RoleId}}{{$RoleDivId}}"  class="textboxdisplay transferemp"  style="width: 100%;">
																													<option value="">------- Select -------</option>																												
																													@foreach($RoleWiseEmp as $Emp)
                                            																	    	<option value="{{$Emp->employee_no}}">{{$Emp->emp_known_as}}</option>
																													@endforeach
																												</select>
																											</td>
																											<td style="background-color:white; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<button type="button"  class="btn btn-default tuploadbtn btn_transfer" title="Click here to Transfer Work" style="cursor: pointer;" data-code="{{$ModCode}}"   value="{{$RoleId}}{{$RoleDivId}}"><i class="fa fa-check"></i> Transfer</button>
																											</td>
																										@endif
																									</tr>
																									@elseif($ModCode == 'SD')
																									<tr>
																										<td class="lboxlabel" style="text-align:center;background-color:white">{{$loop->iteration}}.</td>
																										<td style="text-align:justify;background-color:white">{{$Value->work_order_no}}</td>
																										<td style="text-align:justify;background-color:white" colspan="{{$Rowspan}}">{{$Value->work_name}}</td>																										
																										<td style="text-align:justify;background-color:white" style="vertical-align:middle;">
																											<div class="checkbox-wrapper-19" align="middle">
																											  	<input type="checkbox" id="cb_select_work-{{$Value->worksdid}}" class="workcheckbox{{$ModCode}}{{$RoleId}}{{$RoleDivId}}" value="@if(isset($Value->worksdid)){{encrypt($Value->worksdid)}}@endif"/>
																											  	<label for="cb_select_work-{{$Value->worksdid}}" class="check-box">
																											</div>
																										</td>																										
																										@if ($loop->first)
																											<td style="background-color:white;width:15%; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<select name="cmb_transfer_to" id="cmb_transfer_to_{{$ModCode}}{{$RoleId}}{{$RoleDivId}}"  class="textboxdisplay transferemp"  style="width: 100%;">
																													<option value="">------- Select -------</option>																												
																													@foreach($RoleWiseEmp as $Emp)
                                            																	    	<option value="{{$Emp->employee_no}}">{{$Emp->emp_known_as}}</option>
																													@endforeach
																												</select>
																											</td>
																											<td style="background-color:white; vertical-align:middle;" rowspan="{{$WorkCount}}">
																												<button type="button"  class="btn btn-default tuploadbtn btn_transfer" title="Click here to Transfer Work" style="cursor: pointer;" data-code="{{$ModCode}}"   value="{{$RoleId}}{{$RoleDivId}}"><i class="fa fa-check"></i> Transfer</button>
																											</td>
																										@endif
																									</tr>
																									@endif																							
																								@endforeach
																							@else
																								<tr>
																									<td style="text-align:center;background-color:white" colspan="6">No Pending Files.</td>
																								</tr>
																							@endif
																						@else
																							<tr>
																								<td style="text-align:center;background-color:white" colspan="6">No Pending Files.</td>
																							</tr>
																						@endif
																					</tbody>
																				@endforeach
																			</table>
																		</div>
																	</div>	
																	@endforeach
																@endif
															</td>
														</tr>
													</tbody>
												</table>												
											</div>                                                                            																						
											<div class="row clearrow"></div>
											<div id="EmpWorksData"></div>																													
											<div class="row smclearrow"></div> 
											<div class="row">

												<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
												</div>		
											</div>
											<div class="row smclearrow"></div>  
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
</body>
<script>
	$(document).ready(function() {
		$("#cmb_emp_no").chosen({width: "100%"});
		$("#cmb_status").chosen({width: "100%"});
		$(".transferemp").chosen();

		var newWidget="<div class='widget-wrapper'> <ul class='tab-wrapper'></ul> <div class='new-widget'></div></div>";
    	$(".widget").hide();
    	$(".widget:first").before(newWidget);
    	$(".widget > div").each(function(){
			var title = $(this).attr("data-title");
    	    $(".tab-wrapper").append("<li class='tab' id='"+this.id+"'><b>"+title+"</b></li>");
    	    $(this).appendTo(".new-widget");
    	});
    	$(".tab").click(function(){
    	    $(".new-widget > div").hide();
			var liId = $(this).attr('id');
    	    $('.new-widget #'+liId).show();//alert(liId);
    	    $(".tab").removeClass("active-tab");
    	    $(this).addClass("active-tab");
    	});
    	$(".tab:first").click();
		$("body").on("click",".btn_transfer", function(event){
			var Role = null;
			var BtnData = $(this).val();			
			var ModuleCode = $(this).attr('data-code');
			var DataWork = ModuleCode + BtnData;
			var TransferTo = $("#cmb_transfer_to_"+DataWork).val();
			var TransferFrom = $("#cmb_emp_no").val();
			if(ModuleCode == 'BILLV'){
				Role = $(this).attr('data-role');
			}
			if($(".workcheckbox"+DataWork+":checked").length == 0){
				BootstrapDialog.alert("Please select Work to transfer...!");
				event.preventDefault();
				event.returnValue = false;
			}else if(TransferTo == ''){
				BootstrapDialog.alert("Please select the employee to transfer to...!");
    			event.preventDefault();
    			event.returnValue = false;
			}else{
				var SelectedWorks = []; 
				$('.workcheckbox'+DataWork+':checked').each(function() {
    			    var DataWork = $(this).val();
    			        SelectedWorks.push(DataWork);
    			});		
				// console.log("Selected Works:", SelectedWorks);
				$.ajax({
					type:'POST',
					url:"{{ route('ajax.TransferEmpWorks') }}",
					data: { '_token': '{{ csrf_token() }}', 'SelectedWorks': SelectedWorks,'ModuleCode': ModuleCode,'EmpNo': TransferTo ,'FromEmpNo':TransferFrom,'Role':Role}, 
					success: function (data) {
						if(data){
							BootstrapDialog.alert({
								message: data,
								callback: function() {
									var Form1 = $('form');
    								var FormDataArray = Form1.serializeArray();
    								var PostForm = $('<form>', {
    								    action: "{{ route('admin.TransferWorks') }}",
    								    method: 'POST'
    								});
    								PostForm.append($('<input>', {
    								    type: 'hidden',
    								    name: '_token',
    								    value: '{{ csrf_token() }}'
    								}));
    								$.each(FormDataArray, function(index, field) {
    								    PostForm.append($('<input>', {
    								        name: field.name,
    								        value: field.value
    								    }));
    								});
    								$('body').append(PostForm);
    								PostForm.submit(); 
								}
							});
						}
					}
				});
			}		
		});
	});

    $("body").on("click","#btn_next", function(event){
    	var EmpNo = $('#cmb_emp_no').val();
    	var Status = $('#cmb_status').val();
    	if(EmpNo == ""){
    		BootstrapDialog.alert("Please select the Employee Name..!");
    		event.preventDefault();
    		event.returnValue = false;
    	}else if($("[name='module_name[]']:checked").length == 0){
			BootstrapDialog.alert("Please select atleast one Module Name..!");
			event.preventDefault();
			event.returnValue = false;
		}else if(Status == ""){
    		BootstrapDialog.alert("Please select the Status..!");
    		event.preventDefault();
    		event.returnValue = false;
    	}

    });
</script>
<style>
	.assigned-role {
        display: flex;
        flex-direction: row;
    }
    .tooltip-l {
		position: relative;
		display: inline;
	}
    .rbadge1{
		margin-right:2px;
	}
	.formtable{
		font-family:Verdana, sans-serif;
		border:1px solid #DBDBDB;
		border-collapse:collapse;
		color:#00509F;
		font-size:50px;
	}
	.formtable td{
		padding:4px;
		font-size:50px !important;
	}


	.tab-wrapper{
	/*  margin-left: 1px; */
		width: 100%;
	  	padding: 0;
	/*  height: 0px; */
	/*  background: #1abc9c;  */
	}


	.tab{
	/* width: 100px;*/
		padding: 4px 10px;
	  	margin-right: 2px;
	  	font-size: 13px;
	/*   border: 1px solid red; */
	    border-radius: 6px 6px 0 0;
	/* height: 33px; */
	    float: left;
	    background: #fff;
	    text-transform: capitalize;
	    color: #092F66;
	    text-align: center;
	    /* line-height: 2.0em; */
	    cursor: pointer;
	    list-style: none!important;
	  	transition: all 200ms;
	/*   border-right: 0.125rem solid #16a085; */
	    border-top: 1px solid #092F66;
	    border-right: 1px solid #092F66;
	    border-left: 1px solid #092F66;
		border-bottom: 1px solid #092F66;
		font-family:Verdana;
	}

	.tab:hover {
		background:#092F66;
		color: #fff;
		border:1px solid #092F66;
	}

	.active-tab{
		background:#092F66;
		color: #fff;
		border:1px solid #092F66;
		font-weight:500;
		font-family:Verdana;
	}

	.active-tab:hover {
		background:#092F66;
		border:1px solid #092F66;
	}

	.tab-content {
		padding: 0 0;
	}

	.group-table caption {
		background:#02497E;
	  	color: #fff;
	  	padding: 8px;
	  	font-size: 1.0em;
	}

	.group-table {
		border-top: 1px solid #ddd; 
	  	width:100%;
	    /*  border:1px solid #ddd; */
		/*  border-top: none;  */
	    border-collapse:collapse;
	    padding:5px;
	    text-align: center;
	}
	.group-table th {
	    /*  border:1px solid #ddd;
	    border-top: none; */
		padding: 10px 5px;
	    font-weight: 600;
		background:#EDF5FD;
	    color: #37404B;
	}
	.group-table td {
	    /*  border:1px solid #ddd; */
		padding:10px 2px;
	}

	td:nth-child(3) {
	    /* min-width: 90px; */
	}

	.group-table th, .group-table td {
		border-right: 1px solid #ddd;
		font-size:13px !important;
		color:#04498E;
		border:1px solid #B9B9BA;
		font-weight:bold;
	}
	.group-table.table > thead > tr > th{
		border:1px solid #B9B9BA;
		color:#383E43;
	}

	.group-table th:last-child, .group-table td:last-child {
		border-right: none;
	}

	.group-table tr:nth-child(odd) {
	  	background: #fff;
	}

	#morning .group-table td:nth-child(3) {
	  	background: #fff;
	}

	.group-table td.align-bottom {
	  	vertical-align: bottom;
	  	padding: 0;
	}

	.group-table td.align-top {
	  	vertical-align: top;
	  	padding: 0;  
	}

	.checkbox-wrapper-19 {
	  box-sizing: border-box;
	  --background-color: #fff;
	  --checkbox-height: 20px;
	}

	@-moz-keyframes dothabottomcheck-19 {
	  0% {
	    height: 0;
	  }
	  100% {
	    height: calc(var(--checkbox-height) / 2);
	  }
	}
  	@-webkit-keyframes dothabottomcheck-19 {
	  0% {
	    height: 0;
	  }
	  100% {
	    height: calc(var(--checkbox-height) / 2);
	  }
	}
  	@keyframes dothabottomcheck-19 {
	  0% {
	    height: 0;
	  }
	  100% {
	    height: calc(var(--checkbox-height) / 2);
	  }
	}
  	@keyframes dothatopcheck-19 {
	  0% {
	    height: 0;
	  }
	  50% {
	    height: 0;
	  }
	  100% {
	    height: calc(var(--checkbox-height) * 1.2);
	  }
	}
  	@-webkit-keyframes dothatopcheck-19 {
	  0% {
	    height: 0;
	  }
	  50% {
	    height: 0;
	  }
	  100% {
	    height: calc(var(--checkbox-height) * 1.2);
	  }
	}
  	@-moz-keyframes dothatopcheck-19 {
	  0% {
	    height: 0;
	  }
	  50% {
	    height: 0;
	  }
	  100% {
	    height: calc(var(--checkbox-height) * 1.2);
	  }
	}
  	.checkbox-wrapper-19 input[type=checkbox] {
	  display: none;
	  align:center;
	}
  	.checkbox-wrapper-19 .check-box {
	  height: var(--checkbox-height);
	  width: var(--checkbox-height);
	  background-color: transparent;
	  border: calc(var(--checkbox-height) * .1) solid #000;
	  border-radius: 5px;
	  position: relative;
	  display: inline-block;
	  -moz-box-sizing: border-box;
	  -webkit-box-sizing: border-box;
	  box-sizing: border-box;
	  -moz-transition: border-color ease 0.2s;
	  -o-transition: border-color ease 0.2s;
	  -webkit-transition: border-color ease 0.2s;
	  transition: border-color ease 0.2s;
	  cursor: pointer;
	}
	.checkbox-wrapper-19 .check-box::before,
	.checkbox-wrapper-19 .check-box::after {
	  -moz-box-sizing: border-box;
	  -webkit-box-sizing: border-box;
	  box-sizing: border-box;
	  position: absolute;
	  height: 0;
	  width: calc(var(--checkbox-height) * .2);
	  background-color: #34b93d;
	  display: inline-block;
	  -moz-transform-origin: left top;
	  -ms-transform-origin: left top;
	  -o-transform-origin: left top;
	  -webkit-transform-origin: left top;
	  transform-origin: left top;
	  border-radius: 5px;
	  content: " ";
	  -webkit-transition: opacity ease 0.5;
	  -moz-transition: opacity ease 0.5;
	  transition: opacity ease 0.5;
	}
	.checkbox-wrapper-19 .check-box::before {
	  top: calc(var(--checkbox-height) * .72);
	  left: calc(var(--checkbox-height) * .41);
	  box-shadow: 0 0 0 calc(var(--checkbox-height) * .05) var(--background-color);
	  -moz-transform: rotate(-135deg);
	  -ms-transform: rotate(-135deg);
	  -o-transform: rotate(-135deg);
	  -webkit-transform: rotate(-135deg);
	  transform: rotate(-135deg);
	}
	.checkbox-wrapper-19 .check-box::after {
	  top: calc(var(--checkbox-height) * .37);
	  left: calc(var(--checkbox-height) * .05);
	  -moz-transform: rotate(-45deg);
	  -ms-transform: rotate(-45deg);
	  -o-transform: rotate(-45deg);
	  -webkit-transform: rotate(-45deg);
	  transform: rotate(-45deg);
	}
  	.checkbox-wrapper-19 input[type=checkbox]:checked + .check-box,
	.checkbox-wrapper-19 .check-box.checked {
	  border-color: #34b93d;
	}
	.checkbox-wrapper-19 input[type=checkbox]:checked + .check-box::after,
	.checkbox-wrapper-19 .check-box.checked::after {
	  height: calc(var(--checkbox-height) / 2);
	  -moz-animation: dothabottomcheck-19 0.2s ease 0s forwards;
	  -o-animation: dothabottomcheck-19 0.2s ease 0s forwards;
	  -webkit-animation: dothabottomcheck-19 0.2s ease 0s forwards;
	  animation: dothabottomcheck-19 0.2s ease 0s forwards;
	}
	.checkbox-wrapper-19 input[type=checkbox]:checked + .check-box::before,
	.checkbox-wrapper-19 .check-box.checked::before {
	  height: calc(var(--checkbox-height) * 1.2);
	  -moz-animation: dothatopcheck-19 0.4s ease 0s forwards;
	  -o-animation: dothatopcheck-19 0.4s ease 0s forwards;
	  -webkit-animation: dothatopcheck-19 0.4s ease 0s forwards;
	  animation: dothatopcheck-19 0.4s ease 0s forwards;
	}
</style>

@endsection
