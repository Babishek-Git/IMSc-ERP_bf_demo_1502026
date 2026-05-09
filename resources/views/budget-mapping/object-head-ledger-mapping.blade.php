@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')


<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="" method="post" enctype="multipart/form-data" name="form">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row">
								<div class="div12">
									<div class="form-box">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Ledger - Object Head Mapping </div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
												<div class="table-container">
													<div class="table-wrapper">
														
														<table class="attTable">
                                                        <thead>
                                                            <tr>
                                                                
                                                                <th>
                                                                    {{-- Pure CSS Accordion --}}
                                                                    <div class="acc-wrapper">
																		@if(isset($GiaData))
																		@foreach($GiaData as $Gia)
                                                                        <div class="acc-item">
                                                                            <input type="checkbox" id="acc-toggle-{{ $Gia->gia_id }}" class="acc-checkbox">
                                                                            <label for="acc-toggle-{{ $Gia->gia_id }}" class="acc-header">
                                                                                {{ $Gia->gia_name }}
																				@php 
																				$GiaObjectHeadGrpData = [];
																				if(isset($ObjectHeadGiaMapgrpData[$Gia->gia_id])){
																					$GiaObjectHeadData = $ObjectHeadGiaMapgrpData[$Gia->gia_id];
																					if(filled($GiaObjectHeadData)){
																						$GiaObjectHeadGrpData = collect($GiaObjectHeadData)->groupBy('object_head_id');
																					}
																				}
																				$ApplicableTo = $Gia->applicable_to;
																				@endphp
                                                                                <span class="acc-icon"></span>
                                                                            </label>
                                                                            <div class="acc-body">
                                                                                <div class="acc-content">
																					@if($ApplicableTo == 'PROJECT')
																						@if(isset($ParentProjectData))
																						@foreach($ParentProjectData as $ParentProject)
																						@php $Sno = 1; @endphp
																						<table class="attTable MappingTable">
																							<thead>
																								<tr>
																									<th colspan="3" style="text-align:left;background-color:#1babd3; color:#fff;">Project Name : {{ $ParentProject->project_name }}</th>
																								</tr>
																								<tr>
																									<th>SNo.</th>
																									<th>Object Head</th>
																									<th>Ledger Name</th>
																								</tr>
																							</thead> 
																							<tbody>
																							@if(isset($ObjectHeadData))
																							@foreach($ObjectHeadData as $ObjectHead)
																							
																								@php
																								$IsMapped = 0; $CheckedStr = '';
																								$IsSubCataApplicable = false; $MappedProjectId = ''; $GiaObjectHeadMapId = '';
																								if(isset($GiaObjectHeadGrpData[$ObjectHead->object_head_id])){
																									$GiaObjectHeadMapData = $GiaObjectHeadGrpData[$ObjectHead->object_head_id];
																									$GiaObjectHeadMapData = collect($GiaObjectHeadMapData)->where('project_id',$ParentProject->project_id);
																									if(filled($GiaObjectHeadMapData)){ 
																										$IsSubCataApplicable = $GiaObjectHeadMapData->pluck('is_sup_cata_applicable')->first();
																										$MappedProjectId = $GiaObjectHeadMapData->pluck('project_id')->first();
																										$GiaObjectHeadMapId = $GiaObjectHeadMapData->pluck('oh_gia_mapp_id')->first();
																										$CheckedStr = 'checked';
																										$IsMapped = 1;
																									}
																								}
																								if($IsSubCataApplicable == true){
																									$SubCataCheckedStr = 'checked';
																								}else{
																									$SubCataCheckedStr = '';
																								}
																								@endphp

																								@if($IsMapped == 1)
																								@php 
																									$SubCataDataCount = 0;
																									if(isset($ObjectHeadSubCataGrpData)){
																										if(isset($ObjectHeadSubCataGrpData[$ObjectHead->object_head_id])){
																											$SubCataData = $ObjectHeadSubCataGrpData[$ObjectHead->object_head_id];
																											$SubCataDataCount = count($SubCataData);
																										}
																									}
																								@endphp

																								@if(($SubCataDataCount > 0)&&($IsSubCataApplicable == true))
																								<tr>
																									<td width="80px" align="center">{{ $Sno }}</td>
																									<td>{{ $ObjectHead->object_head_name }}</td>
																									<td width="140px" align="center"></td>
																								</tr>
																								@php $i = 1; @endphp
																								@foreach($SubCataData as $ObjectHeadSubCata)
																								<tr>
																									<td width="80px" align="right" style="color:green">({{ Helper::toRoman($i) }})</td>
																									<td>{{ $ObjectHeadSubCata->oh_sub_cata_name }}</td>
																									<td width="540px" align="center">
																										@php 
																										$LedgerIdList = [];
																										if(isset($OBHLegerMappData)){
																											$LedgerMapData = $OBHLegerMappData->where('gia_id',$Gia->gia_id)->where('object_head_id',$ObjectHead->object_head_id)->where('object_head_sub_cata_id',$ObjectHeadSubCata->oh_sub_cata_id)->where('project_id',$ParentProject->project_id);
																											if(filled($LedgerMapData)){
																												$LedgerIdList = collect($LedgerMapData)->pluck('ledger_id')->toArray();
																											}
																										}
																										@endphp
																										<select name="cmb_ledger[]" id="cmb_ledger" class="tboxsmclass ChosenInput" multiple>
																											@if(isset($Ledger))
																											@foreach($Ledger as $AllLedgers)
																											@php
																											if(in_array($AllLedgers->ledger_id, $LedgerIdList)){
																												$SelStr = 'selected="selected"';
																											}else{
																												$SelStr = '';
																											}
																											@endphp
																											<option value="{{ $AllLedgers->ledger_id }}" {{ $SelStr }} data-ledgergroup="{{ $AllLedgers->ledger_group_id }}" data-type="L">{{ $AllLedgers->ledger_acc_name }}</option>
																											@endforeach
																											@endif
																										</select>
																										<input type="hidden" name="txt_gia[]" id="txt_gia" class="tboxsmclass" value="{{ $Gia->gia_id }}">
																										<input type="hidden" name="txt_object_head[]" id="txt_object_head" class="tboxsmclass" value="{{ $ObjectHead->object_head_id }}">
																										<input type="hidden" name="txt_object_head_sub_cata[]" id="txt_object_head_sub_cata" class="tboxsmclass" value="{{ $ObjectHeadSubCata->oh_sub_cata_id }}">
																										<input type="hidden" name="txt_project[]" id="txt_project" class="tboxsmclass" value="{{ $ParentProject->project_id }}">
																										<input type="hidden" name="txt_oh_gia_mapp_id[]" id="txt_oh_gia_mapp_id" class="tboxsmclass" value="{{ $GiaObjectHeadMapId }}">
																									</td>
																								</tr>
																								@php $i++; @endphp
																								@endforeach
																								@else
																								<tr>
																									<td width="80px" align="center">{{ $Sno }}</td>
																									<td>{{ $ObjectHead->object_head_name }}</td>
																									<td width="540px" align="center">
																										@php 
																										$LedgerIdList = [];
																										if(isset($OBHLegerMappData)){
																											$LedgerMapData = $OBHLegerMappData->where('gia_id',$Gia->gia_id)->where('object_head_id',$ObjectHead->object_head_id)->where('project_id',$ParentProject->project_id);
																											if(filled($LedgerMapData)){
																												$LedgerIdList = collect($LedgerMapData)->pluck('ledger_id')->toArray();
																											}
																										}
																										@endphp
																										<select name="cmb_ledger[]" id="cmb_ledger" class="tboxsmclass ChosenInput" multiple>
																											@if(isset($Ledger))
																											@foreach($Ledger as $AllLedgers)
																											@php
																											if(in_array($AllLedgers->ledger_id, $LedgerIdList)){
																												$SelStr = 'selected="selected"';
																											}else{
																												$SelStr = '';
																											}
																											@endphp
																											<option value="{{ $AllLedgers->ledger_id }}" {{ $SelStr }} data-ledgergroup="{{ $AllLedgers->ledger_group_id }}" data-type="L">{{ $AllLedgers->ledger_acc_name }}</option>
																											@endforeach
																											@endif
																										</select>
																										<input type="hidden" name="txt_gia[]" id="txt_gia" class="tboxsmclass" value="{{ $Gia->gia_id }}">
																										<input type="hidden" name="txt_object_head[]" id="txt_object_head" class="tboxsmclass" value="{{ $ObjectHead->object_head_id }}">
																										<input type="hidden" name="txt_object_head_sub_cata[]" id="txt_object_head_sub_cata" class="tboxsmclass" value="">
																										<input type="hidden" name="txt_project[]" id="txt_project" class="tboxsmclass" value="{{ $ParentProject->project_id }}">
																										<input type="hidden" name="txt_oh_gia_mapp_id[]" id="txt_oh_gia_mapp_id" class="tboxsmclass" value="{{ $GiaObjectHeadMapId }}">
																									</td>
																								</tr>
																								@endif
																								@php $Sno++; @endphp

																								<!-- <tr>
																									<td width="80px" align="center">{{ $loop->iteration }}</td>
																									<td>
																										@if($SubCataDataCount > 0)
																										@foreach($SubCataData as $ObjectHeadSubCata)
																										<div style="padding: 4px 5px; border:1px solid #CDD0D4; margin-bottom:2px; border-radius:3px;">
																											{{ $ObjectHeadSubCata->oh_sub_cata_name }}
																										</div>
																										@endforeach
																										@else
																										{{ $ObjectHead->object_head_name }}
																										@endif
																									</td>
																									<td width="140px" align="center">
																										@if($SubCataDataCount > 0)
																										<input type="checkbox" name="ch_is_sub_cata[]" id="ch_is_sub_cata" value="{{ $ObjectHead->object_head_id }}" {{ $SubCataCheckedStr }}>
																										@endif
																									</td>
																								</tr>  -->
																								@endif
																								
																								

																							
																							@endforeach
																							@endif
																							</tbody>
																						</table>
																						@endforeach
																						@endif
																					@else

																					<table class="attTable MappingTable">
																						<thead>
																							<tr>
																								<th style="text-align:center">SNo.</th>
																								<th>Object Head</th>
																								<th>Ledger Name</th>
																							</tr>
																						</thead> 
																						<tbody>
																						@php $Sno2 = 1; @endphp
																						@if(isset($ObjectHeadData))
																						@foreach($ObjectHeadData as $ObjectHead)
																						
																							@php
																							$IsMapped = 0;
																							$IsSubCataApplicable = false;
																							$GiaObjectHeadMapId = '';
																							if(isset($GiaObjectHeadGrpData[$ObjectHead->object_head_id])){
																								$GiaObjectHeadMapData = $GiaObjectHeadGrpData[$ObjectHead->object_head_id];
																								if(filled($GiaObjectHeadMapData)){ 
																									$IsSubCataApplicable = $GiaObjectHeadMapData->pluck('is_sup_cata_applicable')->first();
																									$GiaObjectHeadMapId = $GiaObjectHeadMapData->pluck('oh_gia_mapp_id')->first();
																								}
																								$CheckedStr = 'checked';
																								$IsMapped = 1;
																							}else{
																								$CheckedStr = '';
																							}
																							if($IsSubCataApplicable == true){
																								$SubCataCheckedStr = 'checked';
																							}else{
																								$SubCataCheckedStr = '';
																							}
																							@endphp
																							@if($IsMapped == 1)


																							<!-- <tr>
																								<td width="50px" align="center">
																									<input type="checkbox" name="ch_object_head[]" id="ch_object_head" value="{{ $ObjectHead->object_head_id }}" {{ $CheckedStr }}>
																								</td>
																								<td width="80px" align="center">{{ $loop->iteration }}</td>
																								<td> -->
																									@php 
																										$SubCataDataCount = 0;
																										if(isset($ObjectHeadSubCataGrpData)){
																											if(isset($ObjectHeadSubCataGrpData[$ObjectHead->object_head_id])){
																												$SubCataData = $ObjectHeadSubCataGrpData[$ObjectHead->object_head_id];
																												$SubCataDataCount = count($SubCataData);
																											}
																										}
																										if(isset($GiaObjectHeadGrpData))
																									@endphp

																									@if(($SubCataDataCount > 0)&&($IsSubCataApplicable == true))


																									<!-- <div class="acc-item" style="margin-bottom:0px">
																										<input type="checkbox" id="acc-toggle-oh-{{ $Gia->gia_id }}-{{ $ObjectHead->object_head_id }}" class="acc-checkbox">
																										<label for="acc-toggle-oh-{{ $Gia->gia_id }}-{{ $ObjectHead->object_head_id }}" class="acc-header" style="padding: 0px 14px;">
																											{{ $ObjectHead->object_head_name }}
																											<span class="acc-icon"></span>
																										</label>
																										<div class="acc-body">
																											<div class="acc-content" style="padding:1px">
																												@foreach($SubCataData as $ObjectHeadSubCata)
																												<div style="padding: 4px 5px; border:1px solid #CDD0D4; margin-bottom:2px; border-radius:3px;">
																													{{ $ObjectHeadSubCata->oh_sub_cata_name }}
																												</div>
																												@endforeach
																											</div>
																										</div>
																									</div> -->
																									<tr>
																										
																										<td width="80px" align="center">{{ $Sno2 }}</td>
																										<td>{{ $ObjectHead->object_head_name }}</td>
																										<td></td>
																									</tr>
																									@php $i = 1; @endphp
																									@foreach($SubCataData as $ObjectHeadSubCata)
																									<tr>
																										
																										<td width="80px" align="right" style="color:green">({{ Helper::toRoman($i) }})</td>
																										<td>{{ $ObjectHeadSubCata->oh_sub_cata_name }}</td>
																										<td width="540px" align="center">
																										@php 
																										$LedgerIdList = [];
																										if(isset($OBHLegerMappData)){
																											$LedgerMapData = $OBHLegerMappData->where('gia_id',$Gia->gia_id)->where('object_head_id',$ObjectHead->object_head_id)->where('object_head_sub_cata_id',$ObjectHeadSubCata->oh_sub_cata_id);
																											if(filled($LedgerMapData)){
																												$LedgerIdList = collect($LedgerMapData)->pluck('ledger_id')->toArray();
																											}
																										}
																										@endphp
																										<select name="cmb_ledger[]" id="cmb_ledger" class="tboxsmclass ChosenInput" multiple>
																											@if(isset($Ledger))
																											@foreach($Ledger as $AllLedgers)
																											@php
																											if(in_array($AllLedgers->ledger_id, $LedgerIdList)){
																												$SelStr = 'selected="selected"';
																											}else{
																												$SelStr = '';
																											}
																											@endphp
																											<option value="{{ $AllLedgers->ledger_id }}" {{ $SelStr }} data-ledgergroup="{{ $AllLedgers->ledger_group_id }}" data-type="L">{{ $AllLedgers->ledger_acc_name }}</option>
																											@endforeach
																											@endif
																										</select>
																										<input type="hidden" name="txt_gia[]" id="txt_gia" class="tboxsmclass" value="{{ $Gia->gia_id }}">
																										<input type="hidden" name="txt_object_head[]" id="txt_object_head" class="tboxsmclass" value="{{ $ObjectHead->object_head_id }}">
																										<input type="hidden" name="txt_object_head_sub_cata[]" id="txt_object_head_sub_cata" class="tboxsmclass" value="{{ $ObjectHeadSubCata->oh_sub_cata_id }}">
																										<input type="hidden" name="txt_project[]" id="txt_project" class="tboxsmclass" value="">
																										<input type="hidden" name="txt_oh_gia_mapp_id[]" id="txt_oh_gia_mapp_id" class="tboxsmclass" value="{{ $GiaObjectHeadMapId }}">
																									</td>
																									</tr>
																									@php $i++; @endphp
																									@endforeach



																									@else
																									<tr>
																										
																										<td width="80px" align="center">{{ $Sno2 }}</td>
																										<td>{{ $ObjectHead->object_head_name }}</td>
																										<td width="540px" align="center">
																										@php 
																										$LedgerIdList = [];
																										if(isset($OBHLegerMappData)){
																											$LedgerMapData = $OBHLegerMappData->where('gia_id',$Gia->gia_id)->where('object_head_id',$ObjectHead->object_head_id);
																											if(filled($LedgerMapData)){
																												$LedgerIdList = collect($LedgerMapData)->pluck('ledger_id')->toArray();
																											}
																										}
																										@endphp
																										<select name="cmb_ledger[]" id="cmb_ledger" class="tboxsmclass ChosenInput" multiple>
																											@if(isset($Ledger))
																											@foreach($Ledger as $AllLedgers)
																											@php
																											if(in_array($AllLedgers->ledger_id, $LedgerIdList)){
																												$SelStr = 'selected="selected"';
																											}else{
																												$SelStr = '';
																											}
																											@endphp
																											<option value="{{ $AllLedgers->ledger_id }}" {{ $SelStr }} data-ledgergroup="{{ $AllLedgers->ledger_group_id }}" data-type="L">{{ $AllLedgers->ledger_acc_name }}</option>
																											@endforeach
																											@endif
																										</select>
																										<input type="hidden" name="txt_gia[]" id="txt_gia" class="tboxsmclass" value="{{ $Gia->gia_id }}">
																										<input type="hidden" name="txt_object_head[]" id="txt_object_head" class="tboxsmclass" value="{{ $ObjectHead->object_head_id }}">
																										<input type="hidden" name="txt_object_head_sub_cata[]" id="txt_object_head_sub_cata" class="tboxsmclass" value="">
																										<input type="hidden" name="txt_project[]" id="txt_project" class="tboxsmclass" value="">
																										<input type="hidden" name="txt_oh_gia_mapp_id[]" id="txt_oh_gia_mapp_id" class="tboxsmclass" value="{{ $GiaObjectHeadMapId }}">
																									</td>
																									</tr>
																									@endif
																									@php $Sno2++; @endphp

																								
																								<!-- </td>
																								<td width="140px" align="center">
																									@if($SubCataDataCount > 0)
																									<input type="checkbox" name="ch_is_sub_cata[]" id="ch_is_sub_cata" value="{{ $ObjectHead->object_head_id }}" {{ $SubCataCheckedStr }}>
																									@endif
																								</td>
																							</tr> -->
																							@endif
																						
																						@endforeach
																						@endif
																						</tbody>
																					</table>

																					@endif


                                                                                </div>
                                                                            </div>
                                                                        </div>
																		@endforeach
																		@endif


                                                                    </div>

                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        
                                                    </table>

													</div>
                                            	</div>
												@php $AddUrl = 'roles.ViewRoleMaster'; @endphp										
												<div class="row">
													<div class="div12" align="center">
														<input type="submit" class="step-btn" name="btn_save" id="btn_save" value=" Save " />									
														<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
													</div>		
												</div>
												<div class="row smclearrow"></div>  
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
</body>	
<style>
	.acc-item {
		overflow: auto;
	}
	.acc-checkbox:checked + .acc-header + .acc-body {
		max-height: auto;
	}
	.acc-body {
		overflow: auto;
	}
	table.attTable td {
		vertical-align: middle;
	}
	.chosen-container .chosen-drop,
	.chosen-container-multi .chosen-choices li.search-choice{
		font-weight:500;
	}
</style>
<script type="text/javascript" language="javascript">
	$(".ChosenInput").chosen();
	var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			event.preventDefault();
			BootstrapDialog.confirm({
				title: 'Confirmation Message',
				message: 'Are you sure want to save ?',
				closable: false, // <-- Default value is false
				draggable: false, // <-- Default value is false
				btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
				btnOKLabel: 'Ok', // <-- Default value is 'OK',
				callback: function(result) {
					if(result){
						KillEvent = 1;

						/*let SaveLedgerArr = []; 
						let SaveLedgerGroupArr = []; 
						$('select[name="cmb_ledger[]"]').each(function() {
							SaveLedgerArr.push($(this).val());
							var LedgerGroup =  $(this).find('option:selected').attr('data-ledgergroup');
							SaveLedgerGroupArr.push(LedgerGroup);
						});
						if(SaveLedgerArr.length === 0){
							var SaveLedgerStr = "";
						}else{
							var SaveLedgerStr = JSON.stringify(SaveLedgerArr);
						}
						if(SaveLedgerGroupArr.length === 0){
							var SaveLedgerGroupStr = "";
						}else{
							var SaveLedgerGroupStr = JSON.stringify(SaveLedgerGroupArr);
						}

						let SaveGiaArr = []; 
						$('input[name="txt_gia[]"]').each(function() {
							SaveGiaArr.push($(this).val());
						});
						if(SaveGiaArr.length === 0){
							var SaveGiaStr = "";
						}else{
							var SaveGiaStr = JSON.stringify(SaveGiaArr);
						}

						let SaveObjectHeadArr = []; 
						$('input[name="txt_object_head[]"]').each(function() {
							SaveObjectHeadArr.push($(this).val());
						});
						if(SaveObjectHeadArr.length === 0){
							var SaveObjectHeadStr = "";
						}else{
							var SaveObjectHeadStr = JSON.stringify(SaveObjectHeadArr);
						}

						let SaveObjectHeadSubCataArr = []; 
						$('input[name="txt_object_head_sub_cata[]"]').each(function() {
							SaveObjectHeadSubCataArr.push($(this).val());
						});
						if(SaveObjectHeadSubCataArr.length === 0){
							var SaveObjectHeadSubCataStr = "";
						}else{
							var SaveObjectHeadSubCataStr = JSON.stringify(SaveObjectHeadSubCataArr);
						}

						let SaveProjectArr = []; 
						$('input[name="txt_project[]"]').each(function() {
							SaveProjectArr.push($(this).val());
						});
						if(SaveProjectArr.length === 0){
							var SaveProjectIdStr = "";
						}else{
							var SaveProjectIdStr = JSON.stringify(SaveProjectArr);
						}

						let SaveGiaObjectHeadMappIdArr = []; 
						$('input[name="txt_oh_gia_mapp_id[]"]').each(function() {
							SaveGiaObjectHeadMappIdArr.push($(this).val());
						});
						if(SaveGiaObjectHeadMappIdArr.length === 0){
							var SaveGiaObjectHeadMappIdStr = "";
						}else{
							var SaveGiaObjectHeadMappIdStr = JSON.stringify(SaveGiaObjectHeadMappIdArr);
						}*/
						let SaveLedgerArr = [];
						let SaveLedgerGroupArr = [];
						let SaveGiaArr = [];
						let SaveObjectHeadArr = [];
						let SaveObjectHeadSubCataArr = [];
						let SaveProjectArr = [];
						let SaveGiaObjectHeadMappIdArr = [];
						$('.MappingTable tbody tr').each(function () {
							let row = $(this);
							let GiaId = row.find('input[name="txt_gia[]"]').val();
							let ObjectHead = row.find('input[name="txt_object_head[]"]').val();
							let ObjectHeadSubCata = row.find('input[name="txt_object_head_sub_cata[]"]').val();
							let ProjectId = row.find('input[name="txt_project[]"]').val();
							let ObjHeadGiaMappId = row.find('input[name="txt_oh_gia_mapp_id[]"]').val();
							row.find('select[name="cmb_ledger[]"] option:selected').each(function () {
								var LedgerGroup = $(this).data('ledgergroup');
								var Ledger = $(this).val();
								SaveLedgerArr.push(Ledger);
								SaveLedgerGroupArr.push(LedgerGroup);
								SaveGiaArr.push(GiaId);
								SaveObjectHeadArr.push(ObjectHead);
								SaveObjectHeadSubCataArr.push(ObjectHeadSubCata);
								SaveProjectArr.push(ProjectId);
								SaveGiaObjectHeadMappIdArr.push(ObjHeadGiaMappId);
							});
						});
						if(SaveLedgerArr.length === 0){
							var SaveLedgerStr = "";
						}else{
							var SaveLedgerStr = JSON.stringify(SaveLedgerArr);
						}
						if(SaveLedgerGroupArr.length === 0){
							var SaveLedgerGroupStr = "";
						}else{
							var SaveLedgerGroupStr = JSON.stringify(SaveLedgerGroupArr);
						}
						if(SaveGiaArr.length === 0){
							var SaveGiaStr = "";
						}else{
							var SaveGiaStr = JSON.stringify(SaveGiaArr);
						}
						if(SaveObjectHeadArr.length === 0){
							var SaveObjectHeadStr = "";
						}else{
							var SaveObjectHeadStr = JSON.stringify(SaveObjectHeadArr);
						}
						if(SaveObjectHeadSubCataArr.length === 0){
							var SaveObjectHeadSubCataStr = "";
						}else{
							var SaveObjectHeadSubCataStr = JSON.stringify(SaveObjectHeadSubCataArr);
						}
						if(SaveProjectArr.length === 0){
							var SaveProjectIdStr = "";
						}else{
							var SaveProjectIdStr = JSON.stringify(SaveProjectArr);
						}
						if(SaveGiaObjectHeadMappIdArr.length === 0){
							var SaveGiaObjectHeadMappIdStr = "";
						}else{
							var SaveGiaObjectHeadMappIdStr = JSON.stringify(SaveGiaObjectHeadMappIdArr);
						}
						var form = document.createElement("form");
							form.method = "POST"; 
							form.action = "{{ route('budget-mapping.object-head-ledger-mapping') }}";
							form.name = "mappingform"; 
							document.body.appendChild(form); 
						var csrfToken = document.createElement("input"); 
							csrfToken.type = "hidden";
							csrfToken.name = "_token"; 
							csrfToken.value = "{{ Session::token() }}"; 
							form.appendChild(csrfToken);

						var FloatingPageIp1 		= document.createElement("input");
							FloatingPageIp1.type 	= "hidden";
							FloatingPageIp1.name 	= "txt_float_ledger";
							FloatingPageIp1.value 	= SaveLedgerStr; 
							form.appendChild(FloatingPageIp1);
						var FloatingPageIp1 		= document.createElement("input");
							FloatingPageIp1.type 	= "hidden";
							FloatingPageIp1.name 	= "txt_float_ledger_group";
							FloatingPageIp1.value 	= SaveLedgerGroupStr; 
							form.appendChild(FloatingPageIp1);
						var FloatingPageIp1 		= document.createElement("input");
							FloatingPageIp1.type 	= "hidden";
							FloatingPageIp1.name 	= "txt_float_gia";
							FloatingPageIp1.value 	= SaveGiaStr; 
							form.appendChild(FloatingPageIp1);
						var FloatingPageIp1 		= document.createElement("input");
							FloatingPageIp1.type 	= "hidden";
							FloatingPageIp1.name 	= "txt_float_object_head";
							FloatingPageIp1.value 	= SaveObjectHeadStr; 
							form.appendChild(FloatingPageIp1);
						var FloatingPageIp1 		= document.createElement("input");
							FloatingPageIp1.type 	= "hidden";
							FloatingPageIp1.name 	= "txt_float_project";
							FloatingPageIp1.value 	= SaveProjectIdStr; 
							form.appendChild(FloatingPageIp1);
						var FloatingPageIp1 		= document.createElement("input");
							FloatingPageIp1.type 	= "hidden";
							FloatingPageIp1.name 	= "txt_float_object_head_sub_cata";
							FloatingPageIp1.value 	= SaveObjectHeadSubCataStr; 
							form.appendChild(FloatingPageIp1);
						var FloatingPageIp1 		= document.createElement("input");
							FloatingPageIp1.type 	= "hidden";
							FloatingPageIp1.name 	= "txt_float_object_head_gia_map_id";
							FloatingPageIp1.value 	= SaveGiaObjectHeadMappIdStr; 
							form.appendChild(FloatingPageIp1);
						var FloatingSubmitBtn 		= document.createElement("input");
							FloatingSubmitBtn.type 	= "submit";
							FloatingSubmitBtn.name 	= "btn_save_mapping";
							FloatingSubmitBtn.id 	= "btn_save_mapping";
							form.appendChild(FloatingSubmitBtn);
							$("#btn_save_mapping").trigger("click");
									
					}else {
						KillEvent = 0;
					}
				}
			});
		}
	});

</script>
@endsection
