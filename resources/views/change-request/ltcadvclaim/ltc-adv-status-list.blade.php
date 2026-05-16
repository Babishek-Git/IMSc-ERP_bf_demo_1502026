@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
$EmpDataArr         = $data['EmpDetails'] ?? [];
$RoleDataArr        = $data['RoleDetails'] ?? [];
$MaxWorkMoveDataArr = $data['MaxWorkMoveDetails'] ?? [];
@endphp
<form action="" method="post" enctype="multipart/form-data" name="form"> 
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<div align="right"></div>
				<blockquote class="bq1" style="overflow:auto">
					<div class="container" align="center">

					 	<div class="div12 no-margin">
							<div class="rm-toolbar">
								<span class="rm-with-selected-btn" id="rm-withSelectedBtn">LTC Advance Request Status List</span>
								<input type="number" id="rm-perPage" value="15" min="1" max="100">
								<select id="rm-filterStatus">
								<option value="all">All</option>
								<option value="active">Active</option>
								<option value="inactive">Inactive</option>
								</select>
								<input type="text" id="rm-searchInput" placeholder="🔍  Search…">
								<div class="rm-toolbar-right">
									<div class="btn-group floatr">
                                        <button type="button" class="btn btn-default btnprimary" title="Home" name="back" id="back" value=" Home " onclick="window.location='{{ route('dashboard.index') }}'" ><i class="fa fa-home pt2"></i> Home</button>
                                    </div>
								</div>
							</div>
							<div class="rm-table-wrap">
								<table id="rm-empTable">
									<thead>
										<tr>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">S.No. <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">IC No. <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Name <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Particular <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Current Status<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Detailed Status<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										</tr>
									</thead>
									<tbody id="rm-tableBody">
										@php $Sno = 1; @endphp
										@if(isset($data['LTCData']))
											@foreach($data['LTCData'] as $LTCData)
												@if($LTCData->created_by == session('WcmsEmpNo'))
													<tr data-name="{{ $LTCData->emp_no }}" data-status="{{ $LTCData->active == 1 ? 'active' : 'inactive' }}">
														<td>{{ $Sno }}</td>
														<td>{{ $LTCData->emp_no }}</td>
														<td>{{ $EmpDataArr[$LTCData->emp_no] ?? '' }}</td>
														<td>LTC Advance Request</td>
														@php
														$LtcAdvstatus = $LTCData->status;
														$FromEmpNo    = $LTCData->from_emp_no;
														$FromRole     = $LTCData->from_role;
														$ToEmpNo      = $LTCData->to_emp_no;
														$ToRole       = $LTCData->to_role;

														$FromEmpName = $EmpDataArr[$FromEmpNo] ?? '';
														$ToEmpName   = $EmpDataArr[$ToEmpNo] ?? '';
														$MaxWorkData = $MaxWorkMoveDataArr[$LTCData->ltc_advance_id] ?? '';
														if(filled($MaxWorkData)){
															$SentOnStr = \Carbon\Carbon::parse($MaxWorkData)->format('d/m/Y H:i:s A');
														}else{
															$SentOnStr ='';
														}
														@endphp
														<td style="text-align:center" align="left">
															@php
																if(isset($LtcAdvstatus)){
																	if($LtcAdvstatus == 'approved'){
																		//echo '<span style="font-size:12px;" >LTC Advance Request Freezed </span>';
																		echo '<span class="blink" style="font-size:12px; color:green;">LTC Advance Request Freezed</span>';
																	}else if($LtcAdvstatus == "SU" || $LtcAdvstatus=='pending' && $ToRole == ''){
																		if(isset($FromRole)){
																			if(isset($RoleDataArr[$FromRole])){
																				$Roles = $RoleDataArr[$FromRole];
																				if(isset($Roles)){
																					if(isset($FromEmpName)){
																						$EmpNameStr = '('.$FromEmpName.')';
																					}else{
																						$EmpNameStr = '';
																					}
																					echo '<span class="blink" style="font-size:12px;"><span style="color:red;">'.$Roles.'</span><br>'.$EmpNameStr.'</span>';
																				}
																			}
																		}else{
																			echo '<span class="blink indent-status-value" >Not yet submitted</span>';
																		}
																	}else if($LtcAdvstatus == "submitted" || $LtcAdvstatus  =='recommended'){
																		if(isset($ToRole)){
																			if(isset($RoleDataArr[$ToRole])){
																				$Roles = $RoleDataArr[$ToRole];
																				if(isset($Roles)){
																					if(isset($ToEmpName)){
																						$ToEmpNameStr = '('.$ToEmpName.')';
																					}else{
																						$ToEmpNameStr = '';
																					}
																					echo '<span class="blink" style="font-size:12px;"><span style="color:red;">'.$Roles.'</span><br>'.$ToEmpNameStr.'</span>';
																				}
																			}
																		}
																	}else if($LtcAdvstatus == "rejected"){
																		if(isset($FromRole)){
																			if(isset($RoleDataArr[$FromRole])){
																				$RejRoles = $RoleDataArr[$FromRole];
																				if(isset($RejRoles)){
																					if(isset($FromEmpName)){
																						$RejEmpName = '('.$FromEmpName.')';
																					}else{
																						$RejEmpName = '';
																					}
																					echo '<span  style="font-size:12px;"><span style="color:red;"> Indent Declined by '.$RejRoles.'</span><br>'.$RejEmpName.'</span>';
																				}
																			}
																		}
																	}else{
																		echo '<span class="blink indent-status-value" >Not yet submitted</span>';
																	}	
																}
															@endphp
														</td>
														<td class="col" align="center">
															<button type="button" onclick="window.location='{{ route('ltc-adv.ltc-adv-status-list', ['id'=>encrypt($LTCData->ltc_advance_id),'modulecode'=>encrypt('LTCADV')])}}'" class="btn btn-default tuploadbtn" title="Click here to View" style="cursor: pointer;"><i class="fa fa-hand-o-right"></i> View Detailed Status</button>
														</td>
													</tr>
													@php $Sno++; @endphp
												@endif
											@endforeach
										@endif
									</tbody>
								</table>
								<div class="rm-empty" id="rm-emptyMsg" style="display:none">No records found.</div>
							</div>
							<div class="rm-pagination">
								<span class="rm-info" id="rm-pageInfo"></span>
								<div class="rm-pages" id="rm-pagesContainer"></div>
							</div>
						</div>
					</div>
					<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
				</blockquote>
			</div>
		</div>
	</div>
</form>
<style>
	.blink {
		animation: blinker 1.5s linear infinite;
	}
	.blinkslow {
		animation: blinker 1.5s linear infinite;
	}
	@keyframes blinker {
		50% {
			opacity: 0;
		}
	}
</style>
<script>

</script>
@endsection