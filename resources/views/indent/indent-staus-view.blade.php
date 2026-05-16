@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php
    $ProcessTrancationData = $data['ProcessTrancationData'] ?? [];
	$EmpDataArr = []; $EmpDesignArr = [];
	if(isset($data['Empdata'])){
		$EmpData = $data['Empdata'];
		foreach($EmpData as $Empvalue){
			$EmpDataArr[$Empvalue->emp_no]   = $Empvalue->emp_name_payslip;
			$EmpDesignArr[$Empvalue->emp_no] = $Empvalue->designation_name;
		}
	}
	$RoleDataArr = [];
	if(isset($data['RoleData'])){
		$RoleData = $data['RoleData'];
		foreach($RoleData as $EmpRolevalue){
			$RoleDataArr[$EmpRolevalue->roleid] = $EmpRolevalue->role_name;
		}
	}
	$ProjectDetails = $data['ProjectDetailsDataArray'] ?? [];
	if(isset($data['EditIndentData'])){
		$IndentDetails  = $data['EditIndentData']; //dd($IndentDetails);
		$IndentNo       = collect($IndentDetails)->pluck('indent_no')->first();
		$IndentDate     = collect($IndentDetails)->pluck('indent_date')->first();
		$IndentTittle   = collect($IndentDetails)->pluck('indent_descripton')->first();
		$IndentEmpNo    = collect($IndentDetails)->pluck('emp_no')->first();
		$IndentProjId   = collect($IndentDetails)->pluck('project_id')->first();
		$IndentProjName = $ProjectDetails[$IndentProjId] ?? 'NA';
		$ToRole 	    = collect($IndentDetails)->pluck('to_role')->first();
		$FromRole 	    = collect($IndentDetails)->pluck('from_role')->first();
		$IndentSatus    = collect($IndentDetails)->pluck('status')->first();
		$FromEmpNo      = collect($IndentDetails)->pluck('from_emp_no')->first();
		$ToEmpNo        = collect($IndentDetails)->pluck('to_emp_no')->first();
		$IndentId       = collect($IndentDetails)->pluck('indent_id')->first();
		$EmpName        = $EmpDataArr[$IndentEmpNo];
		$EmpDesignation = $EmpDesignArr[$IndentEmpNo];
	}
	if(isset($data['GetMatInwardData'])){
		$MatInwardDetails       = $data['GetMatInwardData']; //dd($MatInwardDetails);
		$MatInwardToRole 	    = collect($MatInwardDetails)->pluck('to_role')->first();
		$MatInwardFromRole 	    = collect($MatInwardDetails)->pluck('from_role')->first();
		$MatInwardSatus         = collect($MatInwardDetails)->pluck('status')->first();
		$MatInwardFromEmpNo     = collect($MatInwardDetails)->pluck('from_emp_no')->first();
		$MatInwardToEmpNo       = collect($MatInwardDetails)->pluck('to_emp_no')->first();
		$IsMatInwardSubmit      = collect($MatInwardDetails)->pluck('mat_inward_submit')->first();
	}
	
	if(isset($EmpDataArr[$ToEmpNo])) {
		$ToEmpName = $EmpDataArr[$ToEmpNo];
	}
	if(isset($EmpDataArr[$FromEmpNo])) {
		$FromEmpName = $EmpDataArr[$FromEmpNo];
	}
	if(isset($data['WorkTransData'])){	
		$WorkMoveData= $data['WorkTransData'];
		$RolePosition = collect($WorkMoveData)->pluck('role_po')->last();
		$ActionFlag = collect($WorkMoveData)->pluck('action_flag')->last();
		$WFTargetRole = collect($WorkMoveData)->pluck('target_role')->last();
	}else{
		$WorkMoveData	= array();
	}
	if(isset($data['RoleData'])){	
		$RoleData	= $data['RoleData'];
	}else{
		$RoleData	= array();
	}
	$UnitArr = array();
	$ActionFlag =  'SU';
	if(isset($data['FromPage'])){
		$BackUrl ='indent.indent-all-staus';
	}else{
		$BackUrl ='indent.indent-staus';
	}	
	$MatInwardWorkTransArr = $data['MatInwardWorkTransData'] ?? [];
	$GetPoDataArr          = $data['GetPoData'] ?? [];
    $PoExists              = count($GetPoDataArr); 
	$poIssued 	           = collect($GetPoDataArr)->pluck('po_issued')->first();
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
	/* .blink {
		animation: blinker 1s linear infinite;
	}
	.blinkslow {
		animation: blinker 1s linear infinite;
	}
	@keyframes blinker {
		50% {
			opacity: 0;
		}
	} */
	.blink {
		animation: blinker 2s infinite ease-in-out;
	}
	.blinkslow {
		animation: blinker 1s linear infinite;
	}
	@keyframes blinker {
		0% {
			opacity: 1;
		}
		50% {
			opacity: 0.3;
		}
		100% {
			opacity: 1;
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
	/* @property --angle {
    syntax: '<angle>';
    initial-value: 0deg;
    inherits: false;
}

	@keyframes rotate-gradient {
		0%   { --angle: 0deg; }
		100% { --angle: 360deg; }
	}

	.approved-rainbow {
		border: 3px solid transparent;
		background-image: linear-gradient(#4a5bbf, #4a5bbf), 
						conic-gradient(from var(--angle), #ff0000, #ff7700, #ffff00, #00ff00, #0000ff, #8b00ff, #ff0000);
		background-origin: border-box;
		background-clip: padding-box, border-box;
		animation: rotate-gradient 2s linear infinite;
		color: #fff;
		text-align: center;
	} */
	@property --angle {
		syntax: '<angle>';
		initial-value: 0deg;
		inherits: false;
	}

	@keyframes rotate-gradient {
		0%   { --angle: 0deg; }
		100% { --angle: 360deg; }
	}

	/* Default - no border */
	.approved-rainbow {
		border: 3px solid transparent;
		color: #fff;
		text-align: center;
	}

	/* Only rainbow border on hover */
	/* .approved-rainbow{
		background-image: linear-gradient(#25A5E6, #114F99), 
						conic-gradient(from var(--angle), 
							#4285f4, #ea4335, #fbbc05, #34a853, #4285f4);
		background-origin: border-box;
		background-clip: padding-box, border-box;
		animation: rotate-gradient 3s linear infinite;
	} */
	.approved-rainbow:hover {
		background-image: linear-gradient(#25A5E6, #114F99), 
						conic-gradient(from var(--angle), 
							#4285f4, #ea4335, #fbbc05, #34a853, #4285f4);
		background-origin: border-box;
		background-clip: padding-box, border-box;
		animation: rotate-gradient 3s linear infinite;
	}
	.approved-rainbow {
    background-color: #114F99; /* your chosen color */
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
								
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="left">&emsp;Indent Status</div></div></div>
									<div class="card-body padding-1 ChartCard">
										<div class="divrowbox innerdiv pad-0-top">
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>    								
											<!-- <div class="btn-group floatr">
												<button type="button" class="btn btn-default btnprimary" title="Back" name="back" id="back" value=" BACK " onclick="window.location='{{ route($BackUrl) }}'"><i class="fa fa-arrow-circle-o-left pt2"></i> Back</button>
											</div> -->
											<div class="row" align="left">
												<b>
													<div class="row namebox">
														<table class="nborder" width="100%">
															<tr>
																<td nowrap="nowrap" class="lboxlabel">Indent No.</td>
																<td class="lboxlabel">:  {{ isset($IndentNo) ? ($IndentNo) : '-' }}</td>
																<td nowrap="nowrap" class="lboxlabel">Indent Date</td>
																<td class="lboxlabel">: {{ isset($IndentDate) ? Helper::DisplayDateFormat($IndentDate) : '-'  }}</td>
																<td nowrap="nowrap" class="rboxlabel" >Indent Created By (IC No. / Designation )</td>
																<td class="lboxlabel">: {{ isset($EmpName) ? $EmpName . ' (' . $IndentEmpNo . ' / ' . $EmpDesignation . ')' : '-' }} </td>
															</tr>
															<!-- <tr>
																<td nowrap="nowrap" class="lboxlabel" width="105px">Indent No. </td>
																<td class="lboxlabel" colspan="9" nowrap="">: {{ isset($IndentNo) ? ($IndentNo) : '-' }}</td>
															</tr>
															<tr>
																<td nowrap="nowrap" class="lboxlabel" width="130px">Indent Date</td>
																<td class="lboxlabel" colspan="9">: {{ isset($IndentDate) ? Helper::DisplayDateFormat($IndentDate) : '-'  }}</td>
															</tr> -->
															<tr>
																<td nowrap="nowrap" class="lboxlabel" width="130px">Indent Title</td>
																<td class="lboxlabel" colspan="9">: {{ isset($IndentTittle) ? ($IndentTittle) : '-' }}</td>
															</tr>
															<tr>
																<td nowrap="nowrap" class="lboxlabel" width="130px">Project Name</td>
																<td class="lboxlabel" colspan="9">: {{ isset($IndentProjName) ? ($IndentProjName) : 'NA' }}</td>
															</tr>
															<tr>
																<td nowrap="nowrap" class="lboxlabel" style="color: red;"> Click here to View Indent item details &nbsp;</td>
																<td class="lboxlabel">
																	<div class="btn-group" align="center">
																		<button type="button" class="btn btn-default btnprimary ViewHistory" data-id="{{$IndentId}}"  title="View" style="cursor: pointer;"><i class="fa fa-tv pt2"></i></button>
																	</div>
																</td>
															</tr>
														</table>
													</div>

													<!-- <div class="row namebox">
														<table class="nborder" width="100%" >
															<div class ="grid-3col">
																<div class ='indent-card2'>
																	<div class="lboxlabel">Indent No. : {{ isset($IndentNo) ? ($IndentNo) : '-' }}</div>
																</div>
																<div class ='indent-card2'>
																	<div class="lboxlabel">Indent Date : {{ isset($IndentDate) ? Helper::DisplayDateFormat($IndentDate) : '-'  }}</div>
																</div>
																<div class='indent-card2'>
																	<div class="lboxlabel">Indent Created By (IC No. / Designation ): {{ isset($EmpName) ? $EmpName . ' (' . $IndentEmpNo . ' / ' . $EmpDesignation . ')' : '-' }}</div>
																	<div class="lboxlabel">Indent Created By / Designation : {{ isset($EmpName) ? $EmpName . ' / (' . $EmpDesignation . ')' : '-' }}</div>
																</div>

															</div>
															<div class="grid-2col">
																<div class='indent-card1'>
																	<div class="lboxlabel">Indent No. : {{ isset($IndentNo) ? ($IndentNo) : '-' }}</div>
																</div>
																<div class='indent-card1'>
																	<div class="lboxlabel">Indent Date : {{ isset($IndentDate) ? Helper::DisplayDateFormat($IndentDate) : '-' }}</div>
																</div> 
																<div class='indent-card1'>
																	<div class="lboxlabel">Indent Title : {{ isset($IndentTittle) ? ($IndentTittle) : '-' }}</div>
																</div>
																<div class='indent-card1'>
																	<div class="lboxlabel">Project Name :  {{ isset($IndentProjName) ? ($IndentProjName) : '-' }}</div>
																</div>

															</div>
															<div class ="grid-3col">
																<div class ='indent-card2'>
																	<div class="lboxlabel">IC No. : {{ isset($IndentEmpNo) ? ($IndentEmpNo) : '-' }}</div>
																</div>
																<div class ='indent-card2'>
																	<div class="lboxlabel">Indent Created By : {{ isset($EmpName) ? ($EmpName) : '-' }}</div>
																</div>
																<div class='indent-card2'>
																	<div class="lboxlabel">Designation : {{ isset($EmpDesignation) ? ($EmpDesignation) : '-' }}</div>
																</div>
															</div> -->
															<!-- <div class="indent-status">
																<span class ="lboxlabel">Current Status : </span>
																@php
																	if(isset($IndentSatus)){
																		if($IndentSatus == "FZ"){
																			echo '<span class="blink indent-status-value">Indent Freezed</span>';
																		} else if($IndentSatus == "SU"){
																			if(isset($ToRole) && isset($RoleDataArr[$ToRole])){
																				$Roles = $RoleDataArr[$ToRole];
																				$ToEmpNameStr = isset($ToEmpName) ? '('.$ToEmpName.')' : '';
																				if(isset($Roles)){
																					echo '<span class="blink indent-status-value" >  Waiting in '.$Roles.' Desk '.$ToEmpNameStr.'</span>';
																				}
																			} else if(isset($FromRole) && $FromRole != ''){
																				if(isset($RoleDataArr[$FromRole])){
																					$Roles = $RoleDataArr[$FromRole];
																					$FromEmpNameStr = isset($FromEmpName) ? '('.$FromEmpName.')' : '';
																					echo '<span class="blink indent-status-value" >  Waiting in '.$Roles.' Desk '.$FromEmpNameStr.'</span>';
																				}
																			}
																		}
																	}
																@endphp
															</div> 
														</table>
													</div> -->
												</b> 
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- <div class="div12" style="padding:2px; margin-top:8px;">
								<div class="mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="left">&emsp;Work Flow Information ( Target Roles )</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pad-0-top">
											<div class="row" align="left">
												<b>
													<div class="row namebox">
														<table class="nborder" width="100%">
															<tr>
																<td class="lboxlabel">
																@php 
																	if(isset($data['WorkFlowData'])){
																		$WorkFlowData = collect($data['WorkFlowData'])->pluck('target_roles')->toArray();//dd($WorkFlowData);
																		$i=1; $j=0; $WorkFlowRoles = explode(',', $WorkFlowData[0]);
																		foreach($WorkFlowRoles as $RoleKey => $RoleValue){ 
																			if(isset($RoleDataArr[$RoleValue])){
																				$Roles = $RoleDataArr[$RoleValue];
																				//if(isset($ToRole)){ 
																					if(isset($Roles)){;
																						if(isset($WorkFlowData)){
																							if(isset($IndentSatus)){
																								if(isset($ActionFlag)){
																									if(isset($RolePosition)){
																										if($RolePosition == $j && $ActionFlag == "FW" && $IndentSatus != "FZ"){
																											echo '<span class="SpanBox blinkslow" style="background-color:#6dedc0"><span class="SpanBoxTag">'.$i.'</span> '.$Roles.'</span>';
																											$j++;
																										}
																										else if($RolePosition == $j && $ActionFlag == "BW" && $IndentSatus != "FZ"){
																											echo '<span class="SpanBox blinkslow" style="background-color:#6dedc0"><span class="SpanBoxTag">'.$i.'</span> '.$Roles.'</span>';
																											$j--;
																										}
																										else if($RolePosition == $j && $ActionFlag == "FW" && $IndentSatus == "FZ"){
																											echo '<span class="SpanBox"><span class="SpanBoxTag">'.$i.'</span> '.$Roles.'</span>';
																										}
																										else{
																											if($RolePosition != $j && $ActionFlag == "FW" &&  $IndentSatus != "FZ"){
																												echo '<span class="SpanBox"><span class="SpanBoxTag">'.$i.'</span> '.$Roles.'</span>';
																												$j--;
																											}
																											else if($RolePosition != $j && $ActionFlag == "BW" && $IndentSatus != "FZ"){
																												echo '<span class="SpanBox"><span class="SpanBoxTag">'.$i.'</span> '.$Roles.'</span>';
																												$j--;
																											}
																											
																											else if($RolePosition != $j && $ActionFlag == "FW" && $IndentSatus == "FZ"){
																												echo '<span class="SpanBox"><span class="SpanBoxTag">'.$i.'</span> '.$Roles.'</span>';
																											}
																										}
																									}
																									$j++;
																								}else{
																									if(isset($RolePosition)){
																										if($RolePosition == $j && $ActionFlag == NULL && $IndentSatus != "FZ"){ //pull back
																											echo '<span class="SpanBox blinkslow" style="background-color:#6dedc0"><span class="SpanBoxTag">'.$i.'</span> '.$Roles.'</span>';
																											$j++;
																										}
																										else{
																											if($RolePosition != $j && $ActionFlag == NULL && $IndentSatus != "FZ"){
																												echo '<span class="SpanBox"><span class="SpanBoxTag">'.$i.'</span> '.$Roles.'</span>';
																												$j++;
																											}
																											else{
																												echo '<span class="SpanBox"><span class="SpanBoxTag">'.$i.'</span> '.$Roles.'</span>';
																											}
																										}
																										$j--;
																									}
																								}
																							}	
																						}
																					}
																					$j++;
																					$i++;
																				//}
																			}
																		}
																	}
																	@endphp
																</td>
															</tr>
														</table>
													</div>
												</b> 
											</div>
										</div>
									</div>
								</div>
							</div> -->
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
																				@endphp <div style="background-color:#4F63D8; border:1px solid #151e26"> @php echo "Approved"; @endphp </div> @php
																			}else if(($WorkMoveDataValue->action_flag == NULL) && ($WorkMoveDataValue->status != "AP")){
																				echo "Pulled Back";
																			}else if($WorkMoveDataValue->status == "approved"){
																				@endphp <div class="rm-new-emp-btn pill-header-btn approved-rainbow"> @php echo "Approved"; @endphp </div> @php
																			}else{
																				echo "";
																			}
																		}
																		else{
																			echo "Pulled Back";
																		}
																	@endphp
																</td>
																<!-- <td class="lboxlabel">
																	@php
																	if(isset($EmpArr[$WorkMoveDataValue->created_by])) {
																		echo $EmpArr[$WorkMoveDataValue->created_by];
																	}else if($WorkMoveDataValue->created_by != NULL){
																		echo $WorkMoveDataValue->created_by;
																	}
																	@endphp
																</td> -->
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
																<!-- <td align="center">
																	<div class="btn-group" align="center">
																		<button type="button" class="btn btn-default btnprimary ViewHistory" data-id="{{$IndentId}}"  title="View" style="cursor: pointer;"><i class="fa fa-tv pt2"></i></button>
																	</div>
																</td> -->
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
														<!-- <div class="row" align="center">
                                        					<input type="button" class="backbutton" name="back" id="back" value=" Back " onClick="window.location='{{route($BackUrl)}}'" />
                                  						</div> -->
													</div>
												</b> 
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="div12" style="padding:2px; margin-top:8px;">
								<div class="mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="left">&emsp;PO Processing & Material Inward Certification Status
									</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pad-0-top"> 
											<div class="row" align="left">
												<b>
													<div class="row namebox">
														<div class="row smclearrow"></div>
														{{-- STEPPER BODY --}}
														<div style="padding:24px 20px; display:flex; align-items:flex-start; justify-content:center;">
															@if(isset($IndentSatus))
																@if($IndentSatus == "approved")
																	{{-- APPROVED: Green --}}
																	<div style="text-align:center; flex:1; max-width:130px;">
																		<div style="width:40px; height:40px; border-radius:50%;
																			background:#1d9e75; color:#fff;
																			display:flex; align-items:center; justify-content:center;
																			font-size:18px; margin:auto;">&#10003;</div>
																		<div style="margin-top:8px; font-size:12px; font-weight:600; color:#0f6e56;">Indent Approved</div>
																		<div style="font-size:11px; color:#999; margin-top:3px;">Completed</div>
																	</div>
																@else
																	{{-- NOT APPROVED: Grey --}}
																	<div style="text-align:center; flex:1; max-width:130px;">
																		<div style="width:40px; height:40px; border-radius:50%;
																			background:#eee; color:#aaa;
																			border:1.5px solid #ccc;
																			display:flex; align-items:center; justify-content:center;
																			font-size:14px; font-weight:600; margin:auto;">1</div>
																		<div style="margin-top:8px; font-size:12px; font-weight:600; color:#aaa;">Indent Approved</div>
																		<div style="font-size:11px; color:#999; margin-top:3px;">Pending</div>
																	</div>
																@endif
															@endif
															{{-- CONNECTOR 1→2 --}}
															<div style="flex:1; height:2px; margin-top:19px;
																background:{{ $ProcessTrancationData ? '#1d9e75' : '#ddd' }};"></div>
															{{-- STEP 2: Sanction Process --}}
															<div style="text-align:center; flex:1; max-width:130px;">
																@if($ProcessTrancationData->isNotEmpty() && $PoExists)
																	{{-- COMPLETED: Green --}}
																	<div style="width:40px; height:40px; border-radius:50%;
																		background:#1d9e75; color:#fff;
																		display:flex; align-items:center; justify-content:center;
																		font-size:18px; margin:auto;">&#10003;</div>
																	<div style="margin-top:8px; font-size:12px; font-weight:600; color:#0f6e56;">Sanction Process</div>
																	<div style="font-size:11px; color:#999; margin-top:3px;">Completed</div>
																@else
																	{{-- PENDING: Grey --}}
																	<div style="width:40px; height:40px; border-radius:50%;
																		background:#eee; color:#aaa;
																		border:1.5px solid #ccc;
																		display:flex; align-items:center; justify-content:center;
																		font-size:14px; font-weight:600; margin:auto;">2</div>
																	<div style="margin-top:8px; font-size:12px; font-weight:600; color:#aaa;">Sanction Process</div>
																	<div style="font-size:11px; color:#999; margin-top:3px;">Pending</div>
																@endif
															</div>
															{{-- CONNECTOR 2→3 --}}
															<div style="flex:1; height:2px; margin-top:19px;
																background:{{ $PoExists ? '#1d9e75' : '#ddd' }};"></div>
															{{-- STEP 3: PO Created --}}
															<div style="text-align:center; flex:1; max-width:130px;">
																<div style="width:40px; height:40px; border-radius:50%;
																	background:{{ $PoExists ? '#1d9e75' : '#eee' }};
																	color:{{ $PoExists ? '#fff' : '#aaa' }};
																	border:{{ $PoExists ? 'none' : '1.5px solid #ccc' }};
																	display:flex; align-items:center; justify-content:center;
																	font-size:{{ $PoExists ? '18px' : '14px' }}; font-weight:600; margin:auto;">
																	{{ $PoExists ? '✔' : '3' }}
																</div>
																<div style="margin-top:8px; font-size:12px; font-weight:600;
																	color:{{ $PoExists ? '#0f6e56' : '#aaa' }};">PO Created</div>
																<div style="font-size:11px; color:#999; margin-top:3px;">
																	{{ $PoExists ? 'Completed' : 'Pending' }}
																</div>
															</div>
															{{-- CONNECTOR 3→4 --}}
															<div style="flex:1; height:2px; margin-top:19px;
																background:{{ $poIssued ? '#1d9e75' : '#ddd' }};"></div>
															{{-- STEP 4: PO Issued --}}
															<div style="text-align:center; flex:1; max-width:130px;">
																<div style="width:40px; height:40px; border-radius:50%;
																	background:{{ $poIssued ? '#1d9e75' : '#eee' }};
																	color:{{ $poIssued ? '#fff' : '#aaa' }};
																	border:{{ $poIssued ? 'none' : '1.5px solid #ccc' }};
																	display:flex; align-items:center; justify-content:center;
																	font-size:{{ $poIssued ? '18px' : '14px' }}; font-weight:600; margin:auto;">
																	{{ $poIssued ? '✔' : '4' }}
																</div>
																<div style="margin-top:8px; font-size:12px; font-weight:600;
																	color:{{ $poIssued ? '#0f6e56' : '#aaa' }};">PO Issued</div>
																<div style="font-size:11px; color:#999; margin-top:3px;">
																	{{ $poIssued ? 'Completed' : 'Pending' }}
																</div>
															</div>
															{{-- CONNECTOR 4→5 --}}
															<div style="flex:1; height:2px; margin-top:19px; background:{{ $IsMatInwardSubmit ? '#1d9e75' : '#ddd' }};"></div>
															{{-- STEP 5: Material Inward Certification --}}
															<div style="text-align:center; flex:1; max-width:130px;">
																@if($IsMatInwardSubmit)
																	{{-- SUBMITTED: Green --}}
																	<div style="width:40px; height:40px; border-radius:50%;
																		background:#1d9e75; color:#fff;
																		display:flex; align-items:center; justify-content:center;
																		font-size:18px; margin:auto;">&#10003;</div>
																	<div style="margin-top:8px; font-size:12px; font-weight:600; color:#0f6e56;">Material Inward Certification</div>
																	<div style="font-size:11px; color:#999; margin-top:3px;">Submitted</div>
																@else
																	{{-- NOT SUBMITTED: Grey --}}
																	<div style="width:40px; height:40px; border-radius:50%;
																		background:#eee; color:#aaa;
																		border:1.5px solid #ccc;
																		display:flex; align-items:center; justify-content:center;
																		font-size:14px; font-weight:600; margin:auto;">5</div>
																	<div style="margin-top:8px; font-size:12px; font-weight:600; color:#aaa;">Material Inward Certification</div>
																	<div style="font-size:11px; color:#999; margin-top:3px;">Pending</div>
																@endif
															</div>
														</div>
														<div class="row smclearrow"></div>
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
																<th class="lboxlabel" nowrap="">Status Update By </th>
																<th class="lboxlabel" nowrap="">Remarks / Status</th>
																<th class="lboxlabel" nowrap="">Action Done On</th>
															</tr>
															@if(isset($ProcessTrancationData))
															@foreach($ProcessTrancationData as $ProcessDataKey => $ProcessDataValue)
															<tr>
																<td class="cboxlabel unitarr" >{{$loop->iteration}}</td>
																<td class="lboxlabel">
																	@php
																	if($ProcessDataValue->wf_from_role != NULL){
																		if(isset($RoleDataArr[$ProcessDataValue->wf_from_role])){
																			$Roles = $RoleDataArr[$ProcessDataValue->wf_from_role];
																			if(isset($Roles)){
																				echo $Roles;
																			}
																		}
																	}
																	if(isset($EmpDataArr[$ProcessDataValue->wf_from_emp_no])) {
																		echo "<div style='color:green; font-weight:bold; bottom:0px;'>(" . $EmpDataArr[$ProcessDataValue->wf_from_emp_no] . ")</div>";
																	}
																	@endphp
																</td>
																<td class="lboxlabel">
																	@php
																	if($ProcessDataValue->remarks != NULL){
																		echo $ProcessDataValue->remarks;
																	}
																	@endphp
																</td>
																<td class="cboxlabel">
																	@php
																	if($ProcessDataValue->created_at != NULL){
																		$CreatedAt = explode(" ", $ProcessDataValue->created_at);
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
														<div class="row smclearrow"></div>
                                    					<div class="row smclearrow"></div>
														<!-- <div class="row" align="center">
                                        					<input type="button" class="backbutton" name="back" id="back" value=" Back " onClick="window.location='{{route($BackUrl)}}'" />
                                  						</div> -->
													</div>
												</b> 
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row smclearrow"></div>
							<div class="row smclearrow"></div>
							<div class="div12" style="padding:2px; margin-top:8px;">
								<div class="mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="left">&emsp;Material Inward  Certification File Transaction</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pad-0-top"> 
											<div class="row" align="left">
												<b>
													<div class="row namebox">
														<div class="row smclearrow"></div>
														<table class="formtable" width="100%">
															<tr>
																<th class="lboxlabel">SNo.</th>
																<th class="lboxlabel" nowrap="">File From </th>
																<th class="lboxlabel" nowrap="">File  To </th>
																<th class="lboxlabel">Action</th>
																<!-- <th class="lboxlabel">Action Done By</th> -->
																<th class="lboxlabel" nowrap="">Action Done On</th>
																<th class="lboxlabel">Remarks</th>
																<!-- <th class="lboxlabel"></th> -->
															</tr>
															@if(isset($MatInwardWorkTransArr) && $MatInwardWorkTransArr !=NULL)
															@foreach($MatInwardWorkTransArr as $WorkMoveDataKey => $WorkMoveDataValue)
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
																				@endphp <div style="background-color:#66D42B; border:1px solid #151e26"> @php echo "Approved"; @endphp </div> @php
																			}else{
																				echo "";
																			}
																		}
																		else{
																			echo "Pulled Back";
																		}
																	@endphp
																</td>
																<!-- <td class="lboxlabel">
																	@php
																	if(isset($EmpArr[$WorkMoveDataValue->created_by])) {
																		echo $EmpArr[$WorkMoveDataValue->created_by];
																	}else if($WorkMoveDataValue->created_by != NULL){
																		echo $WorkMoveDataValue->created_by;
																	}
																	@endphp
																</td> -->
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
																<!-- <td align="center">
																	<div class="btn-group" align="center">
																		<button type="button" class="btn btn-default btnprimary ViewHistory" data-id="{{$IndentId}}"  title="View" style="cursor: pointer;"><i class="fa fa-tv pt2"></i></button>
																	</div>
																</td> -->
															</tr>
															@endforeach
															@endif
														</table>
														<div class="row smclearrow"></div>
																<div class="indent-status">
																<span class ="lboxlabel">Current Status : </span>
																@php
																	if(isset($MatInwardSatus)){
																		if($MatInwardSatus == "approved"){
																			echo '<span class="blink indent-status-value">Material Inward Certification approved</span>';
																		} else if($MatInwardSatus == "submitted" ||  $MatInwardSatus  =='recommended'){
																			if(isset($MatInwardToRole) && isset($RoleDataArr[$MatInwardToRole])){
																				$Roles = $RoleDataArr[$MatInwardToRole];
																				$ToEmpNameStr = isset($ToEmpName) ? '('.$ToEmpName.')' : '';
																				if(isset($Roles)){
																					echo '<span class="blink indent-status-value" >  Waiting in '.$Roles.' Desk </span>';
																				}
																			} else if(isset($MatInwardFromRole) && $MatInwardFromRole != ''){
																				if(isset($RoleDataArr[$MatInwardFromRole])){
																					$Roles = $RoleDataArr[$MatInwardFromRole];
																					$FromEmpNameStr = isset($FromEmpName) ? '('.$FromEmpName.')' : '';
																					echo '<span class="blink indent-status-value" >  Waiting in '.$Roles.' Desk </span>';
																				}
																			}
																		}else if($MatInwardSatus == "rejected"){
																			if(isset($MatInwardFromRole) && isset($RoleDataArr[$MatInwardFromRole])){
																				$RejRoles = $RoleDataArr[$MatInwardFromRole];
																				$ToEmpNameStr = isset($ToEmpName) ? '('.$ToEmpName.')' : '';
																				if(isset($RejRoles)){
																					echo '<span class="blink indent-status-value" > Material Inward Certification Return Back by '.$RejRoles.' Desk </span>';
																				}
																			} 
																		}else{
																			echo '<span class="blink indent-status-value" >Not yet submitted</span>';
																		}
																	}
																@endphp
															</div>
                                    					<div class="row smclearrow"></div>
														<div class="row" align="center">
                                        					<input type="button" class="backbutton" name="back" id="back" value=" Back " onClick="window.location='{{route($BackUrl)}}'" />
                                  						</div>
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
		var ModuleCode    = 'INDENT';
        var ModuleSubCode = 'SUPDOC';
		window.open("{{ route('indent.sanction-document-download') }}?id=" + SuppDocId + "&module_code=" + ModuleCode + "&module_sub_code=" + ModuleSubCode, "_blank");
	}
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