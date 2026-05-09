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
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Object Heads - Ledger Mapping </div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
												<div class="table-container">
                                                <div class="table-wrapper">
                                                    
                                                    {{-- Leave entry row (row 0 — the input row) --}}
                                                    <table class="attTable">
                                                        <thead>
                                                            <tr>
                                                                <th>SNo.</th>
                                                                <th>Budget Heads</th>
																<th>Ledger Name</th>
                                                                <!-- <th>BE Proposed</th>
                                                                <th>BE Approved</th>
                                                                <th>RE Proposed</th>
                                                                <th>RE Approved</th> -->
                                                            </tr>
                                                        </thead>
                                                        <tbody> 
                                                            @if(isset($ObjectHeadGroupData))
                                                            @foreach($ObjectHeadGroupData as $ObjectHeadGroup)
                                                            <tr>
                                                                <td align="center">{{ $loop->iteration }}</td>
                                                                <td>{{ $ObjectHeadGroup->full_heads }}
																	<input type="hidden" id ='hidden_oh_id' name ='hidden_oh_id[]' value = '{{ $ObjectHeadGroup->object_head_group_id }}'>
																</td>
                                                                <td width="50%">
																	 @php
																	 $GroupedData = $OBHLegerData->groupBy('object_head_grouop_id');
																		$savedLedgerIds = [];
																		if(isset($GroupedData) && isset($GroupedData[$ObjectHeadGroup->object_head_group_id])){
																			$RawIds  = $GroupedData[$ObjectHeadGroup->object_head_group_id]->pluck('ledger_group_id')->toArray();
																			if(filled($RawIds)){
																					foreach($RawIds as $id){
																					$exploded = explode(',', $id);
																					$savedLedgerIds = array_merge($savedLedgerIds, $exploded);
																				}
																			}
																		}

																		
																	@endphp
																	<select name="cmb_ledger[{{ $loop->index }}][]" id="cmb_ledger_{{ $loop->index }}" class="tboxsmclass ChosenInput" multiple>
																		<option value="">---- Select ---</option>
																		@if(isset($LedgerGroupData))
																			@foreach($LedgerGroupData as $LedgerGroup)
																				<option value="{{ $LedgerGroup->ledger_group_id }}"
																					{{ in_array($LedgerGroup->ledger_group_id, $savedLedgerIds) ? 'selected' : '' }}>
																					{{ $LedgerGroup->ledger_group_name }}
																				</option>
																			@endforeach
																		@endif
																	</select>
																</td>
                                                                <!-- <td><input type="text" class="tboxsmclass" name="txt_be_propose_amt[]" id="txt_be_propose_amt" value="" /></td>
                                                                <td><input type="text" class="tboxsmclass" name="txt_be_approved_amt[]" id="txt_be_approved_amt" value="" /></td>
                                                                <td><input type="text" class="tboxsmclass" name="txt_re_propose_amt[]" id="txt_re_propose_amt" value="" /></td>
                                                                <td><input type="text" class="tboxsmclass" name="txt_re_approved_amt[]" id="txt_re_approved_amt" value="" /></td> -->
                                                            </tr>
                                                            @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>

                                                    {{-- Eligibility warning panel --}}
                                                    <div id="eligibilityWarning"
                                                         style="display:none; color:#c0392b; padding:8px; margin-top:6px; background:#fdecea; border-radius:4px;">
                                                    </div>

                                                </div>
                                            </div>
												@php $AddUrl = 'roles.ViewRoleMaster'; @endphp										
												<div class="row">
													<div class="div12" align="center">
														<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" Back " onClick="window.location='{{route($AddUrl)}}'" />
														<input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />									
														<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
														<input type="hidden" name="hid_roleid" id="hid_roleid" value="@if(isset($data['RoleData'])){{ encrypt($data['RoleData']->roleid) }}@endif" />
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
<script type="text/javascript" language="javascript">
	$(".ChosenInput").chosen();
	var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var RoleName   		= $("#txt_role_name").val();
			var RoleGroup 		= $("#txt_role_group").val();

			if(RoleName == ""){
				BootstrapDialog.alert("Role Name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(RoleGroup == ""){
				BootstrapDialog.alert("User Group Name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else{
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
