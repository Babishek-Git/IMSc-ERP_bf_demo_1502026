@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
	$EmpDataArr   = $data['EmpDetails'] ?? [];
	$EmpDesignArr = $data['EmpDesigDetails'] ?? [];
	$RoleDataArr  = $data['RoleDetails'] ?? [];
	$ProjectDetails = $data['ProjectDetailsDataArray'] ?? [];
	if(isset($data['LTCData'])){
		$LTCDetails     = $data['LTCData']; //dd($LTCDetails);
		$LTCEmpNo       = collect($LTCDetails)->pluck('emp_no')->first();
		$ToRole 	    = collect($LTCDetails)->pluck('to_role')->first();
		$FromRole 	    = collect($LTCDetails)->pluck('from_role')->first();
		$FromEmpNo      = collect($LTCDetails)->pluck('from_emp_no')->first();
		$ToEmpNo        = collect($LTCDetails)->pluck('to_emp_no')->first();
		$LTCId          = collect($LTCDetails)->pluck('ltc_advance_id')->first();
		$visitPlace     = collect($LTCDetails)->pluck('place_visited')->first();
		$LtcAdvstatus   = collect($LTCDetails)->pluck('status')->first();
		$LtcAdvAmt      = collect($LTCDetails)->pluck('advance_amount')->first();
		$EmpName        = $EmpDataArr[$LTCEmpNo] ?? '';
		$EmpDesignation = $EmpDesignArr[$LTCEmpNo] ?? '';
	}
	if(isset($EmpDataArr[$ToEmpNo])) {
		$ToEmpName = $EmpDataArr[$ToEmpNo];
	}
	if(isset($EmpDataArr[$FromEmpNo])) {
		$FromEmpName = $EmpDataArr[$FromEmpNo];
	}
	if(isset($data['WorkTransData'])){	
		$WorkMoveData = $data['WorkTransData'];
		$RolePosition = collect($WorkMoveData)->pluck('role_po')->last();
		$ActionFlag   = collect($WorkMoveData)->pluck('action_flag')->last();
		$WFTargetRole = collect($WorkMoveData)->pluck('target_role')->last();
	}else{
		$WorkMoveData	= array();
	}
	$UnitArr    = array();
	$ActionFlag =  'SU';
	if(isset($data['FromPage'])){
		$BackUrl ='indent.indent-all-staus';
	}else{
		$BackUrl ='ltc-adv.ltc-adv-status-list';
	}	
@endphp
<style>
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
<form name="form" method="post" action="{{ route('indent.indent-staus') }}">
<!--==============================Content=================================-->
<div class="content">
	<div class="title"></div>
	<div class="container_12">
		<div class="grid_12">
			<blockquote class="bq1" style="overflow:auto">
				<div class="container">
					<div class="row plr">
						<div class="div12" style="margin-top:0px;">
							<div class="div12" style="padding:2px; margin-top:8px;">
								<div class="mbtable">
								
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="left">&emsp;LTC Advance Request Status</div></div></div>
									<div class="card-body padding-1 ChartCard">
										<div class="divrowbox innerdiv pad-0-top">
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>    								
											<div class="btn-group floatr">
												<input type="button" class="backbutton" name="back" id="back" value=" Back " onClick="window.location='{{route($BackUrl)}}'" />
											</div>
											<div class="row" align="left">
												<b>
													<div class="row namebox">
														<table class="nborder" width="100%">
															<tr>
																<td nowrap="nowrap" class="lboxlabel">Name</td>
																<td class="lboxlabel">:  {{ isset($EmpName) ? ($EmpName) : '-' }}</td>
																<td nowrap="nowrap" class="lboxlabel">IC No. </td>
																<td class="lboxlabel">: {{ isset($LTCEmpNo) ? ($LTCEmpNo) : '-' }}</td>
																<td nowrap="nowrap" class="rboxlabel" >Designation </td>
																<td class="lboxlabel">: {{ isset($EmpDesignation) ? ($EmpDesignation) : '-' }} </td>
															</tr>
															<tr>
																<td nowrap="nowrap" class="lboxlabel" width="130px">Advance Amount (Rs.)</td>
																<td class="lboxlabel" colspan="9">: {{ isset($LtcAdvAmt) ? ($LtcAdvAmt) : '-' }}</td>
															</tr>
															<!-- <tr>
																<td nowrap="nowrap" class="lboxlabel" width="130px">Project Name</td>
																<td class="lboxlabel" colspan="9">: {{ isset($IndentProjName) ? ($IndentProjName) : 'NA' }}</td>
															</tr> -->
															<!-- <tr>
																<td nowrap="nowrap" class="lboxlabel" style="color: red;"> Click here to View LTC Advance details &nbsp;</td>
																<td class="lboxlabel">
																	<div class="btn-group" align="center">
																		<button type="button" class="btn btn-default btnprimary ViewHistory" data-id="{{$LTCId}}"  title="View" style="cursor: pointer;"><i class="fa fa-tv pt2"></i></button>
																	</div>
																</td>
															</tr> -->
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
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="left">&emsp;LTC Advance Request File Transaction</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pad-0-top"> 
											<div class="row" align="left">
												<b>
													<div class="row namebox">
														<div class="row smclearrow"></div>
														<table class="formtable" width="100%">
															<tr>
																<th class="lboxlabel">SNo.</th>
																<th class="lboxlabel" nowrap="">LTC Advance file From </th>
																<th class="lboxlabel" nowrap="">LTC Advance file  To </th>
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
																				echo "LTC Advance Declined " ;
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
																	if(isset($LtcAdvstatus)){ //dd($LtcAdvstatus);
																		if($LtcAdvstatus == "approved"){
																			echo '<span class="blink indent-status-value">LTC Advance approved</span>';
																		} else if($LtcAdvstatus == "submitted" ||  $LtcAdvstatus  =='recommended'){
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
																		}else if($LtcAdvstatus == "rejected"){
																			if(isset($FromRole) && isset($RoleDataArr[$FromRole])){
																				$RejRoles = $RoleDataArr[$FromRole];
																				$ToEmpNameStr = isset($ToEmpName) ? '('.$ToEmpName.')' : '';
																				if(isset($RejRoles)){
																					echo '<span class="blink indent-status-value" >  LTC Advance Declined by '.$RejRoles.' Desk </span>';
																				}
																			} 
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
						</div>
					</div>
				</div>
			</blockquote>
		</div>    
	</div> 
</form>
<style>
	.modal-dialog {
		width: 90%;
	}
</style>
<script>
	$(document).ready(function(){ 
		$("body").on("click",".ViewHistory", function(event){
			var IndentId = $(this).attr('data-id'); 
			$.ajax({
				type: 'POST',
				url: "{{ route('indent.GetIndentAjaxData') }}",
				data: { '_token': '{{ csrf_token() }}','IndentId': IndentId  },
				success: function(data) {
					if (data != null) {
						var UnitArr          = data['MaterialUnit'];
						var MaterialTypeArr  = data['MaterialType'];
						var IndentDetailsArr = data['IndentDetails'];
						var MaterialTypeMap  = {};
						var UnitMap          = {};
						MaterialTypeArr.forEach(function(mat) {
							MaterialTypeMap[mat.material_type_id] = mat.material_type_name;
						});
						UnitArr.forEach(function(unit) {
							UnitMap[unit.uom_id] = unit.uom_name;
						});
						if(data != null) {
							var IndentDetailsDataStr = '';
							IndentDetailsDataStr += '<table class="formtable" width="100%">';
							IndentDetailsDataStr += '<tr><th colspan="9">Indent Information</th></tr>';
							// IndentDetailsDataStr += '<tr><th class="lboxlabel">S.No.</th><th class="lboxlabel">Type Of Material</th><th class="lboxlabel">A complete description of Goods/Services intended to be procured</th><th class="lboxlabel">Qty.</th><th class="lboxlabel">Unit</th><th class="lboxlabel">Unit Price</th><th class="lboxlabel">GST %</th><th class="lboxlabel">Tax Type</th><th class="lboxlabel">Total cost (Approx.)</th></tr>';
							IndentDetailsDataStr += '<tr><th class="lboxlabel">S.No.</th><th class="lboxlabel">A complete description of Goods/Services intended to be procured</th><th class="lboxlabel">Qty.</th><th class="lboxlabel">Unit</th><th class="lboxlabel">Unit Price</th><th class="lboxlabel">Amout (Rs.)</th><th class="lboxlabel">Tax Type</th><th class="lboxlabel">Total cost with tax (Approx.)</th></tr>';
							IndentDetailsArr.forEach(function(item) {
								var MateritypeId = item.material_type_id;
								var UnitId       = item.unit_id;
								var TaxType      = item.tax_type;
								var RateContAmt  = item.rate_cont_amt;
								var EstAmt       = item.estimated_unit_price;
								var MaterialName = MaterialTypeMap[MateritypeId] || '';
								var UnitName     = UnitMap[UnitId] || '';
								if (TaxType == 'INC') {
									var TaxTypeName = 'Inclusive';
								} else if (TaxType == 'EXCL') {
									var TaxTypeName = 'Exclusive';
								} else {
									var TaxTypeName = '';
								}
								if(RateContAmt >0){
									var ItemRate = RateContAmt;
								}else{
									var ItemRate = EstAmt;
								}
			        			IndentDetailsDataStr += '<tr><td class="lboxlabel" style="text-align: center;">'+item.item_no+'</td><td class="lboxlabel">'+item.item_description+'</td><td class="lboxlabel" style="text-align: center;">'+item.quantity+'</td><td class="lboxlabel"style="text-align: center;">'+UnitName+'</td><td class="lboxlabel"style="text-align: center;">'+ItemRate+'</td><td class="lboxlabel" style="text-align: center;">'+item.item_amount+'</td><td class="lboxlabel" style="text-align: center;">'+TaxTypeName+'</td><td class="lboxlabel" style="text-align: Right;">'+item.total_cost+'</td></tr>';
			        			// IndentDetailsDataStr += '<tr><td class="lboxlabel" style="text-align: center;">'+item.item_no+'</td><td class="lboxlabel" style="text-align: center;">'+MaterialName+'</td><td class="lboxlabel">'+item.item_description+'</td><td class="lboxlabel" style="text-align: center;">'+item.quantity+'</td><td class="lboxlabel"style="text-align: center;">'+UnitName+'</td><td class="lboxlabel"style="text-align: center;">'+item.estimated_unit_price+'</td><td class="lboxlabel" style="text-align: center;">'+item.gst_rate+'</td><td class="lboxlabel" style="text-align: center;">'+TaxTypeName+'</td><td class="lboxlabel" style="text-align: Right;">'+item.total_cost+'</td></tr>';
							});
							IndentDetailsDataStr += '</table>';
						}
						BootstrapDialog.show({
							title: 'Indent Information',
							message: IndentDetailsDataStr,
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
	});
</script>	
@endsection	