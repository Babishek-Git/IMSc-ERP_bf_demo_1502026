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
								<div class="div2"></div>
								<div class="div8">
									<div class="form-box">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Grant In Aid - Object Head Mapping </div></div></div>
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
																						<table class="attTable ObjHeadTable">
																							<thead>
																								<tr>
																									<th colspan="4" style="text-align:left;background-color:#1babd3; color:#fff;">Project Name : {{ $ParentProject->project_name }}</th>
																								</tr>
																								<tr>
																									<th></th>
																									<th>SNo.</th>
																									<th>Object Head</th>
																									<th>Is Sub Category ?</th>
																								</tr>
																							</thead> 
																							@if(isset($ObjectHeadData))
																							@foreach($ObjectHeadData as $ObjectHead)
																							<tbody>
																								<tr>
																									<td width="50px" align="center">
																										@php
																										$IsSubCataApplicable = false; 
																										$CheckedStr = ''; $MappedProjectId = '';
																										if(isset($GiaObjectHeadGrpData[$ObjectHead->object_head_id])){
																											$GiaObjectHeadMapData = $GiaObjectHeadGrpData[$ObjectHead->object_head_id];
																											$GiaObjectHeadMapData = collect($GiaObjectHeadMapData)->where('project_id',$ParentProject->project_id);
																											if(filled($GiaObjectHeadMapData)){ 
																												$IsSubCataApplicable = $GiaObjectHeadMapData->pluck('is_sup_cata_applicable')->first();
																												$MappedProjectId = $GiaObjectHeadMapData->pluck('project_id')->first();
																												if($MappedProjectId == $ParentProject->project_id){
																													$CheckedStr = 'checked';
																												}
																											}
																										}
																										if($IsSubCataApplicable == true){
																											$SubCataCheckedStr = 'checked';
																										}else{
																											$SubCataCheckedStr = '';
																										}
																										@endphp
																										<input type="checkbox" name="ch_object_head[]" id="ch_object_head" data-gia="{{ $Gia->gia_id }}" data-project="{{ $ParentProject->project_id }}" value="{{ $ObjectHead->object_head_id }}" {{ $CheckedStr }}>
																									</td>
																									<td width="80px" align="center">{{ $loop->iteration }}</td>
																									<td>
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

																										@if($SubCataDataCount > 0)
																										<div class="acc-item" style="margin-bottom:0px">
																											<input type="checkbox" id="acc-toggle-oh-{{ $ParentProject->project_id }}-{{ $Gia->gia_id }}-{{ $ObjectHead->object_head_id }}" class="acc-checkbox">
																											<label for="acc-toggle-oh-{{ $ParentProject->project_id }}-{{ $Gia->gia_id }}-{{ $ObjectHead->object_head_id }}" class="acc-header" style="padding: 0px 14px;">
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
																										</div>
																										@else
																										{{ $ObjectHead->object_head_name }}
																										@endif

																									
																									</td>
																									<td width="140px" align="center">
																										@if($SubCataDataCount > 0)
																										<input type="checkbox" name="ch_is_sub_cata[]" id="ch_is_sub_cata" value="{{ $ObjectHead->object_head_id }}" {{ $SubCataCheckedStr }}>
																										@endif
																									</td>
																								</tr>
																							</tbody>
																							@endforeach
																							@endif
																						</table>
																						@endforeach
																						@endif
																					@else

																					<table class="attTable ObjHeadTable">
																						<thead>
																							<tr>
																								<th></th>
																								<th>SNo.</th>
																								<th>Object Head</th>
																								<th>Is Sub Category ?</th>
																							</tr>
																						</thead> 
																						@if(isset($ObjectHeadData))
																						@foreach($ObjectHeadData as $ObjectHead)
																						<tbody>
																							<tr>
																								<td width="50px" align="center">
																									@php
																									$IsSubCataApplicable = false;
																									if(isset($GiaObjectHeadGrpData[$ObjectHead->object_head_id])){
																										$GiaObjectHeadMapData = $GiaObjectHeadGrpData[$ObjectHead->object_head_id];
																										if(filled($GiaObjectHeadMapData)){ 
																											$IsSubCataApplicable = $GiaObjectHeadMapData->pluck('is_sup_cata_applicable')->first();
																										}
																										$CheckedStr = 'checked';
																									}else{
																										$CheckedStr = '';
																									}
																									if($IsSubCataApplicable == true){
																										$SubCataCheckedStr = 'checked';
																									}else{
																										$SubCataCheckedStr = '';
																									}
																									@endphp
																									<input type="checkbox" name="ch_object_head[]" id="ch_object_head" data-gia="{{ $Gia->gia_id }}" data-project="" value="{{ $ObjectHead->object_head_id }}" {{ $CheckedStr }}>
																								</td>
																								<td width="80px" align="center">{{ $loop->iteration }}</td>
																								<td>
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

																									@if($SubCataDataCount > 0)
																									<div class="acc-item" style="margin-bottom:0px">
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
																									</div>
																									@else
																									{{ $ObjectHead->object_head_name }}
																									@endif

																								
																								</td>
																								<td width="140px" align="center">
																									@if($SubCataDataCount > 0)
																									<input type="checkbox" name="ch_is_sub_cata[]" id="ch_is_sub_cata" value="{{ $ObjectHead->object_head_id }}" {{ $SubCataCheckedStr }}>
																									@endif
																								</td>
																							</tr>
																						</tbody>
																						@endforeach
																						@endif
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
								<div class="div2"></div>
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
						let SaveGiaArr = []; 
						let SaveObjectHeadArr = []; 
						let SaveProjectIdArr = []; 
						let SaveIsSubCataArr = []; 

						$('.ObjHeadTable').each(function () {
							const table = $(this);
							table.find('tbody tr').each(function () {
								const row = $(this);
								const firstCheckbox = row.find('td:first input[type="checkbox"]');
								if (firstCheckbox.is(':checked')) {
									let Gia = firstCheckbox.attr("data-gia");
									let ObjectHead = firstCheckbox.val();
									let ProjectId = firstCheckbox.attr("data-project");
									let IsSubCata = false;
									const lastCheckbox = row.find('td:last input[type="checkbox"]');
									if(lastCheckbox.length > 0) {
										if(lastCheckbox.is(':checked')) {
											console.log('Both checked');
											IsSubCata = true;
										}
									}
									SaveGiaArr.push(Gia);
									SaveObjectHeadArr.push(ObjectHead);
									SaveProjectIdArr.push(ProjectId);
									SaveIsSubCataArr.push(IsSubCata);
								}
							});
						});
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
						if(SaveProjectIdArr.length === 0){
							var SaveProjectIdStr = "";
						}else{
							var SaveProjectIdStr = JSON.stringify(SaveProjectIdArr);
						}
						if(SaveIsSubCataArr.length === 0){
							var SaveIsSubCataStr = "";
						}else{
							var SaveIsSubCataStr = JSON.stringify(SaveIsSubCataArr);
						}
						var form = document.createElement("form");
							form.method = "POST"; 
							form.action = "{{ route('budget-mapping.gia-object-head-mapping') }}";
							form.name = "mappingform"; 
							document.body.appendChild(form); 
						var csrfToken = document.createElement("input"); 
							csrfToken.type = "hidden";
							csrfToken.name = "_token"; 
							csrfToken.value = "{{ Session::token() }}"; 
							form.appendChild(csrfToken);

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
							FloatingPageIp1.name 	= "txt_float_is_sub_cata";
							FloatingPageIp1.value 	= SaveIsSubCataStr; 
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
