@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php 
$EmpDataArr = []; $EmpDesignArr = [];
if(isset($data['Empdata'])){
	$EmpData = $data['Empdata'];
	foreach($EmpData as $Empvalue){
		$EmpDataArr[$Empvalue->emp_no]   = $Empvalue->emp_first_name;
		$EmpDesignArr[$Empvalue->emp_no] = $Empvalue->designation_name;
	}
}
if(isset($data['EditIndentData'])){
	$IndentDetails  = $data['EditIndentData'];
	$IndentNo       = collect($IndentDetails)->pluck('indent_no')->first();
	$IndentDate     = collect($IndentDetails)->pluck('indent_date')->first();
	$IndentTittle   = collect($IndentDetails)->pluck('indent_descripton')->first();
	$IndentEmpNo    = collect($IndentDetails)->pluck('emp_no')->first();
	$IndentProjName = collect($IndentDetails)->pluck('indent_pro_name')->first();
	$EmpName        = $EmpDataArr[$IndentEmpNo];
	$EmpDesignation = $EmpDesignArr[$IndentEmpNo];
}
@endphp
<style>
	.SpanBoxCheckInfo{
		width:100%;
		font-size:15px;
		border:2px solid #000000;
		border-radius:40px;
		padding-left:8px;
		background:#0490d5;
	}
	.SpanBoxWrongInfo{
		width:100%;
		font-size:15px;
		border:2px solid #000000;
		border-radius:10px;
		padding-left:8px;
		background:#ae1963;
	}
	.SpanBoxInfo{
		width:100%;
		font-size:15px;
		border:2px solid #000000;
		border-radius:10px;
		padding-left:8px;
		background:#cccccc;
	}

	.SpanBoxCheck{
		width:100%;
		margin:0px;
		font-size:13px;
		font-weight:600;
		border:1px solid #025984;
		border-radius:10px;
		padding-left:4px;
		background:#0490d5;
	}
	.SpanBoxCheck:hover .downSpanCheck {
		color: #fff;
		background-color: #8eb6ea;
		border:1px solid #fff;
	}
	.downSpanCheck{
		padding:8px;
		border:1px solid #fff;
		border-radius:50px;
		float:right;
		font-size:13px;
		color: #fff;
		box-shadow: inset 0 0 5px rgba(33, 98, 183, 0.5);
	}
	.downSpanTextCheck{
		top: 8px;
		float:left;
  		position: relative;
		color: #fff;
	}
	.tuploadbtnCheck {
		border: 1px solid #025984;
		font-size: 12px;
		padding: 3px 4px 4px 4px;
		line-height: 12px;
	}
	.tuploadbtnCheck:hover {
		color: #fff !important;
		background-color: #025984 !important;
		border: 1px solid #025984 !important;
	}




	.SpanBoxWrong{
		width:100%;
		margin:0px;
		font-size:13px;
		font-weight:600;
		border:1px solid #860244;
		border-radius:10px;
		padding-left:4px;
		background:#ae1963;
	}
	.SpanBoxWrong:hover .downSpanWrong {
		color: #fff;
		background-color: #F44;
		border:1px solid #fff;
	}
	.downSpanWrong{
		padding:8px;
		border:1px solid #fff;
		border-radius:50px;
		float:right;
		font-size:13px;
		color: #fff;
		box-shadow: inset 0 0 5px rgba(33, 98, 183, 0.5);
	}
	.downSpanTextWrong{
		top: 8px;
		float:left;
  		position: relative;
		color: #fff;
	}
	.tuploadbtnWrong {
		border: 1px solid #860244;
		font-size: 12px;
		padding: 3px 4px 4px 4px;
		line-height: 12px;
	}
	.tuploadbtnWrong:hover {
		color: #fff !important;
		background-color: #860244 !important;
		border: 1px solid #860244 !important;
	}




	.SpanBox{
		width:100%;
		margin:0px;
		font-size:13px;
		font-weight:600;
		border:1px solid #c8cbd1;
		padding-left:4px;
		background:#d8dce5;
	}
	.SpanBox:hover .downSpan {
		color: #fff;
		background-color: #808080;
		border:1px solid #fff;
	}
	.downSpan{
		padding:8px;
		border:1px solid #fff;
		border-radius:50px;
		float:right;
		font-size:13px;
		color:#333333;
		box-shadow: inset 0 0 5px rgba(33, 98, 183, 0.5);
	}
	.downSpanText{
		top: 8px;
		float:left;
  		position: relative;
		color: #333333;
	}
	.tuploadbtn {
		border: 1px solid #b9bfcc;
		font-size: 12px;
		padding: 3px 4px 4px 4px;
		line-height: 12px;
	}
	.tuploadbtn:hover {
		color: #000000 !important;
		background-color: #808080 !important;
		border: 1px solid #808080 !important;
	}



	.tooltip-l {
		position: relative;
		display: inline;
	}
	.panel-body {
 		padding: 4px;
	}
	.ovalBtn.reqindi:hover{
		color:#fff;
	}
	.rbadge1{
		margin-right:2px;
	}
	.border-b{
		border-bottom:1px solid #A9ABAF;
		padding-bottom:6px;
		box-shadow: 0 10px 12px 0px #e1e1e1;
		padding-left:5px;
	}
	.custom-dialog {
		width: 95% !important; /* Set your desired width */
		max-width: none; /* Remove max-width */
	}
	.ftable2 td, table.ftable2{
		border: 1px solid #d2d3d7 !important;
		border-top:none !important;
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
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">
										Indent  - Status 
								</div></div></div>
								<div class="row innerdiv">
									<div class="row">
										<table class="table-bordered dataTable no-footer" align="center" id="dataTable">
											<thead>
												<tr>
													<th class="colhead" colspan="3" nowrap="nowrap">
														<div class="row">
															<div class="div2 lboxlabel" style="margin-top:0px">
																Indent Information <span class="rbadge1 rbadgeH">Indent No. : {{$IndentNo}} </span>
															</div>
															<div class="div10 rboxlabel" style="margin-top:0px">
																<div class="row row-fluid line-control-menu-bar formtitlebar" style="border:none;padding-top:0px; background:none;">
																	@php $BackUrl ='indent.indent-staus'; @endphp
																	&nbsp;
																	<div class="btn-group floatr" style="margin-left:5px">
																		<button type="button" class="btn btn-default btnprimary" title="Back" name="back" id="back" value=" BACK " onclick="window.location='{{ route($BackUrl) }}'"><i class="fa fa-arrow-circle-o-left pt2"></i> Back</button>
																	</div>
																</div>
															</div>
														</div>
													</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td class="colhead" style="vertical-align: text-top;width:50%">
														<div class="row border-b">
															<div class="div3 lboxlabel no-margin">Indent No.</div>
															<div class="div9 lboxlabel no-margin">: {{$IndentNo}}  </div>
														</div>
														<div class="row border-b">
															<div class="div3 lboxlabel">Indent Date</div>
															<div class="div9 lboxlabel">:   {{ \Helper::DisplayDateFormat($IndentDate) }} </div>
														</div>
														<div class="row border-b">
															<div class="div3 lboxlabel">Indent Title</div>
															<div class="div9 lboxlabel">:  {{$IndentTittle}}</div>
														</div>
														<div class="row border-b">
															<div class="div3 lboxlabel">Project Name</div>
															<div class="div9 lboxlabel">:  {{$IndentProjName}}</div>
														</div>
														<div class="row border-b">
															<div class="div3 lboxlabel">Indent Created By</div>
															<div class="div9 lboxlabel">: {{$EmpName}}</div>
														</div>
														<div class="row border-b">
															<div class="div3 lboxlabel">Indent Created Designation</div>
															<div class="div9 lboxlabel">:  {{$EmpDesignation}}</div>
														</div>
														<div class="row border-b">
															<div class="div3 lboxlabel">IC No</div>
															<div class="div9 lboxlabel">:  {{$IndentEmpNo}}</div>
														</div>
														
													</td>
													
													<td style="vertical-align:top; padding-top:2px;" colspan="1">
														<div class="row">
															<div class="div12 lboxlabel">
																<span class="rbadge rbadge-gray">Indent  Stage </span>&nbsp; : @if(isset($StatusWorkStage)){{ \Helper::GetWorkStage($StatusWorkStage) }}@endif
															</div>
														</div>
														<div class="row">
															<div class="div12 lboxlabel">
																<span class="rbadge rbadge-gray">Indent Sent to Accounts On </span>&nbsp; : @if(isset($BillSendToAccDt)){{ \Carbon\Carbon::parse($BillSendToAccDt)->format('d/m/Y') }}@endif
															</div>
														</div>
														<div class="row">
															<div class="div12 lboxlabel reqindi">
																<span class="rbadge rbadge-gray">Current Status </span>&nbsp; : 
															</div>
														</div>
														<div class="row smclearrow"></div>
														<div class="row smclearrow"></div>

														<div class="btn-group floatl" style="margin-left:5px; margin-bottom:2px;">
															<button type="button" class="btn btn-default btnsuccess" title="Back" value=" Add Document ">Attach Document to Accounts</button>
														</div>	
														<table class="formtable" width="100%">
															<tr><th>SNo.</th><th>Document Description</th><th>Document</th><th></th><th></th></tr>
															@if(isset($SuppDocData))
																@if(filled($SuppDocData))
																	@foreach($SuppDocData as $SuppDocDataKey => $SuppDocDataValue)
																		<tr>
																			<td align="center">{{$loop->iteration}}</td>
																			<td>{{$SuppDocDataValue->doc_desc}}</td>
																			<td>{{$SuppDocDataValue->doc_name}}</td>
																			<td align="center" nowrap="">
																				<a class="pdfbtn PreviewRABSuppDoc"  data-type="{{encrypt('PDF')}}" data-id="{{encrypt($SuppDocDataValue->sasdid)}}" style="cursor:pointer" >
																					<i class="fa fa-file-pdf-o"></i> 
																					View PDF &nbsp;
																				</a>
																			</td>
																			<td align="center" nowrap="">
																				@if($Frpage == NULL)	
																				<a type="button" class="pdfbtn DelRABSuppDoc" data-type="{{encrypt('PDF')}}" data-id="{{encrypt($SuppDocDataValue->sasdid)}}" style="cursor:pointer">
																					<i class="fa fa-trash"></i> 
																					Delete &nbsp;
																				</a>
																				@else 
																				<a type="button" class="pdfbtn disable" style="background:#E0E2E4; color:grey">
																					<i class="fa fa-trash" style="color:grey"></i> 
																					Delete &nbsp;
																				</a>
																				@endif
																			</td>
																		</tr>
																	@endforeach
																@endif
															@endif
														</table>
													</td>

														</div>
													</td>
												<tr>
													<td class="colhead" nowrap="nowrap">
														<div class="lboxlabel">
															<div class="btn-group">
																<button type="button" class="btn btn-default btndanger" title="Remarks" name="txt_oth_remarks" id="txt_oth_remarks" data-othrem="@if(isset($WorkMovement)){{json_encode($WorkMovement)}}@endif"><i class="fa fa-list pt2"></i> Click here to view all remarks</button>
															</div>
														</div>
													</td>
												</tr>
											</tbody>
										</table>

									</div>
									<div class="row smclearrow"></div>
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="left">&emsp;Work Flow Transaction</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pad-0-top" style="border:1px solid #ddd"> 
											<div class="row" align="left">
												<div class="row namebox">
													<div class="row smclearrow"></div>
													<table class="formtable" width="100%">
														<tr>
															<th class="lboxlabel">SNo.</th>
															<th class="lboxlabel">From Role</th>
															<th class="lboxlabel">To Role</th>
															<th class="lboxlabel">Action</th>
															<th class="lboxlabel">Action Done By</th>
															<th class="lboxlabel">Action Done On</th>
															<th class="lboxlabel">Remarks</th>
														</tr>
														@if(isset($WorkMovementWithUserAndAccData))
														@php 
														$WorkMovementWithUserAndAccData = collect($WorkMovementWithUserAndAccData)->sortBy('created_at');
														@endphp
														@foreach($WorkMovementWithUserAndAccData as $WorkMoveDataKey => $WorkMoveDataValue)
														<tr>
															<td class="cboxlabel">{{$loop->iteration}}</td>
															<td class="lboxlabel">
																@php
																	if($WorkMoveDataValue->initiate_role != NULL){ 
																		if(isset($StatusRoleData[$WorkMoveDataValue->initiate_role])){ 
																			$Roles = $StatusRoleData[$WorkMoveDataValue->initiate_role]; 
																			$Roles = collect($Roles)->first();
																			if(isset($Roles->role_name)){
																				echo $Roles->role_name;
																			}
																		}
																	}
																	if(isset($EmpArr[$WorkMoveDataValue->created_by])) {
																		echo " (" . $EmpArr[$WorkMoveDataValue->created_by] . ")";
																	}
																	
																@endphp
															</td>
															<td class="lboxlabel">
																@php
																	if($WorkMoveDataValue->target_role != NULL){
																		if(isset($StatusRoleData[$WorkMoveDataValue->target_role])){
																			$Roles = $StatusRoleData[$WorkMoveDataValue->target_role];
																			$Roles = collect($Roles)->first();
																			if(isset($Roles['role_name'])){
																				echo $Roles['role_name'];
																			}
																		}
																	}
																	if(isset($EmpArr[$WorkMoveDataValue->to_emp_no])) {
																		echo " (" . $EmpArr[$WorkMoveDataValue->to_emp_no] . ")";
																	}
																	@endphp
															</td>
															<td class="lboxlabel">
																@php
																if($WorkMoveDataValue->status != NULL){
																	if($WorkMoveDataValue->status == "AP"){
																		echo "Approved";
																	}else if($WorkMoveDataValue->status == "RE"){
																		echo "Returned Back";
																	}else if($WorkMoveDataValue->status == "FW"){
																			echo "Forwarded";
																	}else if($WorkMoveDataValue->status == "BW"){
																		echo "Returned Back";
																	}else{
																		echo "";
																	}
																}else{
																	if($WorkMoveDataValue->action_flag != NULL){
																		if($WorkMoveDataValue->action_flag == "FW"){
																			echo "Forwarded";
																		}else if($WorkMoveDataValue->action_flag == "BW"){
																			echo "Returned Back";
																		}else{
																			echo "";
																		}
																	}
																}
																@endphp
															</td>
															<td class="lboxlabel">
																@php
																if(isset($EmpArr)){
																	if(isset($EmpArr[$WorkMoveDataValue->created_by])) {
																		echo $EmpArr[$WorkMoveDataValue->created_by];
																	}else if($WorkMoveDataValue->created_by != NULL){
																		echo $WorkMoveDataValue->created_by;
																	}
																}
																@endphp
															</td>
															<td class="lboxlabel">
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
												</div>
											</div>
										</div>
									</div>
								</div>
					     	</div>
							<input type="hidden" name="cmb_check_sub" id="cmb_check_sub" value="" data-msg="@if(isset($MsgStr)){{$MsgStr}}@endif" data-cansub="@if(isset($CanSubmit)){{$CanSubmit}}@endif"/>
							<input type="hidden" name="cmb_work_no" id="cmb_work_no" value="@if(isset($WorkData->sheetid)){{ encrypt($WorkData->sheetid)}}@endif"/>
							<input type="hidden" name="txt_rab" id="txt_rab" value="@if(isset($AbstData->rbn)){{ encrypt($AbstData->rbn) }}@endif">
							<input type="hidden" name="txt_tot_amount" id="txt_tot_amount" value="@if(isset($TotAmount)){{ encrypt($TotAmount) }}@endif"/>
							<input type="hidden" name="txt_rbn_chid" id="txt_rbn_chid" value="@if(isset($RabChkID)){{ encrypt($RabChkID) }}@endif">
							<input type="hidden" name="txt_globid" id="txt_globid" value="@if(isset($GlobID)){{ encrypt($GlobID) }}@endif">
							<input type="hidden" name="wf_module_code" id="wf_module_code" value="{{ encrypt('RABUC') }}" />
							<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
							<input type="hidden" name="txt_wf_mode" id="txt_wf_mode" />
							<input type="hidden" name="txt_actual_emp" id="txt_actual_emp" />
							<input type="hidden" name="txt_wf_remark" id="txt_wf_remark" />
							<div class="div12">&nbsp;</div> 
						</div>
					</div>
				</blockquote>
			</div>
		</div>
	</div>
</form>
<script>
	//BootstrapDialog.alert("You need to select next MBook to generate General MBook");
	$(document).ready(function(){

		$("body").on("click",".delete_compliance", function(event){
			var DeleteIndex = $(this).attr("data-deleteindex");
			$("#compdiv_" + DeleteIndex).remove();
		});

		$("body").on("click","#txt_oth_comp_remarks", function(event){ 
			let othrem = $("#txt_oth_comp_remarks").attr("data-othrem");
			let othrem1 = $.parseJSON(othrem);
			let Rspappndstr = '';
			let appndstr = '';
			let snorem = 1;
			var LetterContCompl = '';
			var LetterContReply = '';
			appndstr += '<table width="100%" align="center" class="formtable">';
			appndstr += '<thead><tr><th nowrap="" style="text-align:center;">S No.</th><th style="text-align:left;">Remarks Done By</th><th style="text-align:center;">Compliance & Compliance Reply</th><th style="text-align:center;">Remarks Date</th><th style="text-align:center;">Download</th></tr></thead><tbody>';
			Object.entries(othrem1).forEach(([key1, value1]) => {
				Rspappndstr = '';
				appndstr += '<tr class="label">';
				var Employee = value1.EmpName;
				if(value1.Remark == null || value1.Remark == ""){
					value1.Remark = " - ";
				}
				if(value1.CreatedOn == null || value1.CreatedOn == ""){
					value1.CreatedOn = " - ";
				}
				var ComplianceArr = value1.Compliance;
				if((ComplianceArr['C'] != null)&&(ComplianceArr['C'] != null)){
					var LetterContComplArr = ComplianceArr['C'] || [];
					var LetterContReplyArr = ComplianceArr['R'] || [];
					var ContComplincLength = LetterContComplArr.length;
					if(Number(ContComplincLength) > 0){
						Rspappndstr += '<table width="100%" align="center" class="formtable"><thead><tr><th>Compliance Remarks</th><th>Compliance Reply</th></tr></thead><tbody>';
						Object.entries(LetterContComplArr).forEach(([key2, value2]) => {
							LetterContCompl = value2;
							LetterContReply = '';
							if(LetterContReplyArr[key2]){
								LetterContReply = LetterContReplyArr[key2];
							}
							//Rspappndstr += '<table width="100%" align="center" class="formtable ftable2"><tbody><td width="450px" align="left">'+LetterContCompl+'</td><td width="450px" align="left">'+LetterContReply+'</td></tbody></table>';
							Rspappndstr += '<tr><td width="450px" align="left">'+LetterContCompl+'</td><td width="450px" align="left">'+LetterContReply+'</td></tr>';
						});
						Rspappndstr += '</tbody></table>';
					}
				}else{
					Rspappndstr += ComplianceArr;
				}
				var downloadLink = $('<a>', {
					class: 'pdfbtn',
					title: 'Click here to Download PDF',
					style: 'cursor: pointer;'
				}).append($('<i>', { class: 'fa fa-file-pdf-o' })," Download PDF");
				downloadLink = downloadLink.prop('outerHTML');
				appndstr += '<td align="center">'+snorem+'</td><td align="justify">'+value1.EmpName+'<br/>('+value1.RoleName+')</td><td align="left">'+Rspappndstr+'</td><td align="left">'+value1.CreatedOn+'</td><td align="center" style="vertical-align:middle" nowrap="">'+downloadLink+'</td>';
				appndstr += '</tr>';
				snorem++;
			});
			appndstr += '</tbody></table>';
			BootstrapDialog.alert({
				title: 'All Compliance',
				message: appndstr,
				closable: true, // <-- Default value is false
				draggable: false, // <-- Default value is false
				btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
				btnOKLabel: 'Ok', // <-- Default value is 'OK',
				onshown: function(dialog) {
					dialog.getModal().find('.modal-dialog').addClass('custom-dialog');
				}
			});
		});
		//////////////////   FOR COMPLIANCE LETTER   //////////////////




		////////////////	FOR WORKFLOW UPDATED 14/09/2024	- STARTS HERE    ////////////////
		$("body").on("click",".WorkFlowAction", function(event){
			if(KillEvent == 0){
				//event.preventDefault();
				var ActionRem = $('#txt_remarks').val();
				let flag = $(this).attr("data-flag"); 
				if(flag == 'BK'){
					if(ActionRem == ''){
						BootstrapDialog.alert("Remarks should not be empty");
						event.preventDefault();
						return false;
						exit();
					}
				}
				var Role = $(this).attr('data-role');
				let TriggerBtn = $(this).attr("id"); 
				var ActionRem = $('#txt_remarks').val();
				var UserCnt = 0; var EmpNo = "";
				$("#txt_wf_mode").val('');
				$('#txt_wf_remark').val('');
				var RemarkLabel = 'higher';
				if((flag == "SU")||(flag == "FW")||(flag == "BK")){
					var UserCnt = $(this).attr("data-usercnt");
					if(flag == "SU"){
						EmpNo = $("#txt_fw_emp_no").val();
						if($("#FwUser").length){
							var UserData = $("#FwUser").attr("data-user");
						}else{
							var UserData = [];
						}
						RemarkLabel = 'higher';
					}else if(flag == "FW"){
						EmpNo = $("#txt_fw_emp_no").val(); 
						if($("#FwUser").length){
							var UserData = $("#FwUser").attr("data-user");
						}else{
							var UserData = [];
						}
						RemarkLabel = 'higher';
					}else if(flag == "BK"){
						EmpNo = $("#txt_bw_emp_no").val();
						if($("#BwUser").length){
							var UserData = $("#BwUser").attr("data-user");
						}else{
							var UserData = [];
						}
						RemarkLabel = 'lower';
					}else{
						var UserData = [];
					}  
					let Users;
					if(UserData != ''){ 
						Users = $.parseJSON(UserData); 
					}else{ 
						Users = {}; 
					}
					var PersoanlNotesStr = '';

					let EmpStr = '<div class="lboxlabel">Select Employee <span id="RoleLabel"></span></div>';
					EmpStr += '<div class="row smclearrow"></div>';
					EmpStr += '<select class="tboxsmclass" name="modal_emp" id="modal_emp">';
					EmpStr += '<option value=""> --- Select --- </option>';
					/*Object.entries(Users).forEach(([key1, value1]) => {
						EmpStr += '<option value="'+value1.emp_no+'">'+value1.emp_known_as+'</option>';
					});*/
					EmpStr += '</select>';
					let SkipEmpStr = '<div class="row smclearrow"><input type="hidden" name="modal_action_flag" id="modal_action_flag" value="'+flag+'"></div>';
					SkipEmpStr += '<div class="row">&nbsp;</div>';
					SkipEmpStr += '<div class="row lboxlabel rgtext"><input type="checkbox" class="SkipEmployee" name="modal_skip_employee" id="modal_skip_employee" value=""> &nbsp;Click here to skip the above role if the person mentioned is on leave or unavailable</div>';
					SkipEmpStr += '<div class="row smclearrow"></div>';
					SkipEmpStr += '<div class="row hide SkipEmpRow">';
					SkipEmpStr += '<div class="lboxlabel">Select Employee <span id="RoleLabelSkip"></span></div>';
					SkipEmpStr += '<div class="row smclearrow"></div>';
					SkipEmpStr += '<select class="tboxsmclass" name="modal_skip_emp" id="modal_skip_emp">';
					SkipEmpStr += '<option value=""> --- Select --- </option>';
					SkipEmpStr += '</select>';
					SkipEmpStr += '</div>';
					SkipEmpStr += '<div class="row smclearrow hide SkipEmpRow"></div>';
					SkipEmpStr += '<div class="row hide SkipEmpRow">';
					SkipEmpStr += '<div class="row smclearrow"></div>';
					SkipEmpStr += '<div class="lboxlabel">Remarks for skipping to the next '+RemarkLabel+' level</div>';
					SkipEmpStr += '<div class="row"><textarea class="tboxsmclass" rows="5" name="modal_skip_remarks" id="modal_skip_remarks" maxlength="1000"></textarea></div>';
					SkipEmpStr += '</div>';

					let OthOrgEmpStr = '<div class="row smclearrow"></div>';
					OthOrgEmpStr += '<div class="row smclearrow"></div>';
					OthOrgEmpStr += '<div class="row lboxlabel rgtext"><input type="checkbox" class="OthOrgEmployee" name="modal_oth_org_employee" id="modal_oth_org_employee" value=""> &nbsp;Click here to select an employee from another organization if the employee from the same organization is on leave or unavailable (applicable for the same role)</div>';
					OthOrgEmpStr += '<div class="row smclearrow"></div>';
					OthOrgEmpStr += '<div class="row hide OthOrgEmpRow">';
					OthOrgEmpStr += '<div class="lboxlabel">Select Employee (Approving Authority)</div>';
					OthOrgEmpStr += '<select class="tboxsmclass" name="modal_oth_org_emp" id="modal_oth_org_emp" style="font-weight:500">';
					OthOrgEmpStr += '<option value=""> --- Select --- </option>';
					OthOrgEmpStr += '</select>';
					OthOrgEmpStr += '</div>';
					OthOrgEmpStr += '<div class="row smclearrow hide OthOrgEmpRow"></div>';
					OthOrgEmpStr += '<div class="row hide OthOrgEmpRow">';
					OthOrgEmpStr += '<div class="row smclearrow"></div>';
					OthOrgEmpStr += '<div class="lboxlabel">Remarks for choosing other organization employee</div>';
					OthOrgEmpStr += '<div class="row"><textarea class="tboxsmclass" rows="5" name="modal_oth_org_emp_remarks" id="modal_oth_org_emp_remarks" maxlength="1000"></textarea></div>';
					OthOrgEmpStr += '</div>';
					OthOrgEmpStr += '<div class="row"></div>';
					if(PersoanlNotesStr != ''){
						OthOrgEmpStr += '<div class="row">'+PersoanlNotesStr+'</div>';
					}
					OthOrgEmpStr += '<div class="row"></div>';
					event.preventDefault();
					BootstrapDialog.show({
						title: 'Work Flow Information',
						message: EmpStr+SkipEmpStr+OthOrgEmpStr,
						buttons: [{
							label: 'OK Proceed',
							action: function(dialog) {
								var Err = 0;
								var WorkFlowMode = $("#txt_wf_mode").val();
								if($("#modal_emp").val() == ''){
									BootstrapDialog.alert('Please select employee..!!');
									Err++;
								}else{
									if(WorkFlowMode == "SKIP"){
										var SkipEmp = $("#modal_skip_emp").val();
										var SkipRemarks = $("#modal_skip_remarks").val();
										if(SkipEmp == ""){
											BootstrapDialog.alert("Skip to Employee name should not be empty");
											Err++;
										}else if(SkipRemarks == ""){
											BootstrapDialog.alert("Skip to Employee remarks should not be empty");
											Err++;
										}
									}else if(WorkFlowMode == "OTHORG"){
										var OthOrgEmp = $("#modal_oth_org_emp").val();
										var OthOrgRemark = $("#modal_oth_emp_remarks").val();
										if(OthOrgEmp == ""){
											BootstrapDialog.alert("Other Organization Employee name should not be empty");
											Err++;
										}else if(OthOrgRemark == ""){
											BootstrapDialog.alert("Other Organization Employee remarks should not be empty");
											Err++;
										}
									}
								}
								if(Err == 0){
									var PersNotes = $('#txt_est_pers_note').val();
									if(WorkFlowMode == "SKIP"){
										var EmployeeNo 	= $("#modal_skip_emp").val();
										var WflowRemarks = $("#modal_skip_remarks").val();
									}else if(WorkFlowMode == "OTHORG"){
										var EmployeeNo 	= $("#modal_oth_org_emp").val();
										var ActualEmpNo = $("#modal_emp").val();
										var WflowRemarks = $("#modal_oth_org_emp_remarks").val();
										$("#txt_actual_emp").val(ActualEmpNo);
									}else{
										var EmployeeNo = $("#modal_emp").val();
										$("#txt_actual_emp").val('');
										var WflowRemarks = '';
									}
									$('#txt_pers_note').val(PersNotes);
									$('#txt_wf_remark').val(WflowRemarks);
									if((flag == "SU")||(flag == "FW")){
										$("#txt_fw_emp_no").val(EmployeeNo);
									}
									if(flag == "BK"){
										$("#txt_bw_emp_no").val(EmployeeNo);
									}
									if(flag == "SU"){
										var ConfirmMessage = "Are you sure want to submit ?";
									}else if(flag == "FW"){
										var ConfirmMessage = "Are you sure want to forward ?";
									}else if(flag == "BK"){
										var ConfirmMessage = "Are you sure want to return back ?";
									}else{
										var ConfirmMessage = "";
									}
									if(ConfirmMessage != ""){
										event.preventDefault();
										BootstrapDialog.confirm({
											title: 'Confirmation Message',
											message: ConfirmMessage,
											closable: false, // <-- Default value is false
											draggable: false, // <-- Default value is false
											btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
											btnOKLabel: 'Ok', // <-- Default value is 'OK',
											callback: function(result) {
												if(result){
													
													if((TriggerBtn != '')&&(TriggerBtn !== 'undefined')){
														KillEvent = 1; 
														$("#"+TriggerBtn).trigger( "click" );
													}
												}else {
													KillEvent = 0;
												}
											}
										});
										dialog.close();
									}
								}
							}
						},{
							label: 'Cancel',
							action: function(dialog) {
								dialog.close();
							}
						}],
						onshown: function(dialogRef){ 
							
							$(this).GetWorkFlowEmployeeData(event,Role,flag);
						}
					});
				}else if(flag == "FZ"){
					event.preventDefault();
					BootstrapDialog.confirm({
						title: 'Confirmation Message',
						message: "Are you sure you want to Approve RA Bill ?",
						closable: false, // <-- Default value is false
						draggable: false, // <-- Default value is false
						btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
						btnOKLabel: 'Ok', // <-- Default value is 'OK',
						callback: function(result) {
							if(result){
								if((TriggerBtn != '')&&(TriggerBtn !== 'undefined')){
									KillEvent = 1; 
									$("#"+TriggerBtn).trigger( "click" );
								}
							}else {
								KillEvent = 0;
							}
						}
					});
				}
			}
		});
		$("body").on("click",".SkipEmployee", function(event,Role,flag){
			if($(this).is(':checked')){
				$(".SkipEmpRow").removeClass("hide");
				$(".OthOrgEmployee").prop('checked',false);
				$(".OthOrgEmpRow").addClass("hide");
				$("#modal_oth_org_employee").val('');
				$("#modal_oth_emp_remarks").val('');
				$("#txt_actual_emp").val('');
				$(this).GetSkipEmployeeData(event);
				$("#txt_wf_mode").val('SKIP');
			}else{
				$(".SkipEmpRow").addClass("hide");
				$("#modal_skip_employee").val('');
				$("#modal_skip_remarks").val('');
				$("#txt_wf_mode").val('');
				$("#txt_actual_emp").val('');
			}
		});
		$("body").on("click",".OthOrgEmployee", function(event,Role,flag){
			if($(this).is(':checked')){
				$(".OthOrgEmpRow").removeClass("hide");
				$(".SkipEmployee").prop('checked',false);
				$(".SkipEmpRow").addClass("hide");
				$("#modal_skip_employee").val('');
				$("#modal_skip_remarks").val('');
				$(this).GetOthEmployeeData(event);
				$("#txt_wf_mode").val('OTHORG');
				$("#txt_actual_emp").val('');
			}else{
				$(".OthOrgEmpRow").addClass("hide");
				$("#modal_oth_org_employee").val('');
				$("#modal_oth_emp_remarks").val('');
				$("#txt_wf_mode").val('');
				$("#txt_actual_emp").val('');
			}
		});
		$.fn.GetWorkFlowEmployeeData = function(event,Role,flag) {
			let GlobId 		= $("#txt_globid").val();
			let WflowModule = $("#wf_module_code").val();
			let MastId 		= $("#txt_rbn_chid").val();
			let ActionFlag  = $("#modal_action_flag").val();
			let SheetID 	= $("#cmb_work_no").val();
			let Rab   		= $("#txt_rab").val();
			let TotAmount   = $("#txt_tot_amount").val();
			var OtherDataJson = {
				MastId: MastId,
				SheetID: SheetID,
				Role: Role,
				Rab: Rab,
				TotAmount: TotAmount
			};
			var OtherData = JSON.stringify(OtherDataJson);
			$("#RoleLabel").html('');
			$("#modal_emp").chosen("destroy");
			$("#modal_emp").find('option:not(:first)').remove();
			$.ajax({ 
				type: 'POST',
				url: "{{ route('ajax.GetWorkFlowEmployees') }}",
				data : { "_token": "{{ csrf_token() }}", GlobId: GlobId, WflowModule: WflowModule, ActionFlag: ActionFlag, Page: 'WORKFLOW', OtherData: OtherData },
				dataType: 'json',
				success: function (data) {
					if(data != null){	
						var EmpData = data['EmpData'];
						var SelEmp = data['SelEmp'];
						var RoleName = data['RoleName'];
						if((RoleName != null)&&(RoleName != '')){
							$("#RoleLabel").html('<span class="rbadge1 rbadgeA">Role : '+RoleName+'</span>');
						}
						if(EmpData != null){
							var EmpLength = EmpData.length;
							$.each(EmpData, function(index, element) {
								if((SelEmp == element.emp_no)||(EmpLength == 1)){
									var SelectStr = 'selected="selected"';
								}else{
									var SelectStr = '';
								}
								$("#modal_emp").append('<option value="'+element.emp_no+'" '+SelectStr+'><span class="testing">'+element.emp_known_as+'</option>');
							});
						}
						$("#modal_emp").chosen();
						$('.chosen-container').css('font-weight',500);
					}
				}
			});
		}
		$.fn.GetSkipEmployeeData = function(event) {
			let GlobId 		= $("#txt_globid").val();
			let WflowModule = $("#wf_module_code").val();
			let MastId 		= $("#txt_rbn_chid").val();
			let ActionFlag  = $("#modal_action_flag").val();
			let SheetID 	= $("#cmb_work_no").val();
			let Rab   		= $("#txt_rab").val();
			let TotAmount   = $("#txt_tot_amount").val();
			var OtherDataJson = {
				MastId: MastId,
				SheetID: SheetID,
				Rab: Rab,
				TotAmount: TotAmount
			};
			var OtherData = JSON.stringify(OtherDataJson);
			$("#modal_skip_emp").chosen("destroy");
			$("#modal_skip_emp").find('option:not(:first)').remove();
			$("#RoleLabelSkip").html('');
			$.ajax({ 
				type: 'POST',
				url: "{{ route('ajax.GetWorkFlowEmployees') }}",
				data : { "_token": "{{ csrf_token() }}", GlobId: GlobId, WflowModule: WflowModule, ActionFlag: ActionFlag, Page: 'SKIP', OtherData: OtherData },
				dataType: 'json',
				success: function (data) {
					if(data != null){	
						var EmpData = data['EmpData'];
						var RoleName = data['RoleName'];
						if((RoleName != null)&&(RoleName != '')){
							$("#RoleLabelSkip").html('<span class="rbadge1 rbadgeA">Role : '+RoleName+'</span>');
						}
						$.each(EmpData, function(index, element) {
							$("#modal_skip_emp").append('<option value="'+element.emp_no+'"><span class="testing">'+element.emp_known_as+'</option>');
						});
						$("#modal_skip_emp").chosen();
						$('.chosen-container').css('font-weight',500);
					}
				}
			});
		}
		$.fn.GetOthEmployeeData = function(event) {
			let GlobId 		= $("#txt_globid").val();
			let WflowModule = $("#wf_module_code").val();
			let MastId 		= $("#txt_rbn_chid").val();
			let ActionFlag  = $("#modal_action_flag").val();
			let SheetID 	= $("#cmb_work_no").val();
			let Rab   		= $("#txt_rab").val();
			let TotAmount   = $("#txt_tot_amount").val();
			var OtherDataJson = {
				MastId: MastId,
				SheetID: SheetID,
				Rab: Rab,
				TotAmount: TotAmount
			};
			var OtherData = JSON.stringify(OtherDataJson);
			$("#modal_oth_org_emp").chosen("destroy");
			$("#modal_oth_org_emp").find('option:not(:first)').remove();
			$.ajax({ 
				type: 'POST',
				url: "{{ route('ajax.GetWorkFlowEmployees') }}",
				data : { "_token": "{{ csrf_token() }}", GlobId: GlobId, WflowModule: WflowModule, ActionFlag: ActionFlag, Page: 'OTHORG', OtherData: OtherData },
				dataType: 'json',
				success: function (data) {
					if(data != null){	
						var EmpData = data['EmpData'];
						var ErrMsg  = data['ErrMsg']; 
						if((ErrMsg != null)&&(ErrMsg != '')){ 
							BootstrapDialog.alert(ErrMsg);
							$(".OthOrgEmployee").prop('checked',false);
							$(".OthOrgEmpRow").addClass("hide");
							$("#modal_oth_org_employee").val('');
							$("#modal_oth_emp_remarks").val('');
							$("#txt_wf_mode").val('');
							$("#txt_actual_emp").val('');
						}else{
							if(EmpData != null){
								$.each(EmpData, function(index, element) {
									var OrgGroup 		= element.group;
									var OrgDivision 	= element.division_short_name;
									var OrgSection 		= element.section_short_name;
									var OrgSubSection 	= element.sub_section_short_name;
									var OrgArr = [];
									if((OrgGroup != '')&&(OrgGroup != 'null')&&(OrgGroup != null)){
										OrgArr.push("Group :  "+OrgGroup);
									}
									if((OrgDivision != '')&&(OrgDivision != 'null')&&(OrgDivision != null)){
										OrgArr.push("Division :  "+OrgDivision);
									}
									if((OrgSection != '')&&(OrgSection != 'null')&&(OrgSection != null)){
										OrgArr.push("Section :  "+OrgSection);
									}
									if((OrgSubSection != '')&&(OrgSubSection != 'null')&&(OrgSubSection != null)){
										OrgArr.push("Sub Section :  "+OrgSubSection);
									}
									var OrgString = OrgArr.join('; ');

									if((element.emp_known_as == '')||(element.emp_known_as == null)||(element.emp_known_as == 'null')){
										var NameArr = [];
										var EmpFName 	= element.emp_firstname;
										var EmpMName 	= element.emp_middlename;
										var EmpLName 	= element.emp_lastname;

										if((EmpFName != '')&&(EmpFName != 'null')&&(EmpFName != null)){
											NameArr.push(EmpFName);
										}
										if((EmpMName != '')&&(EmpMName != 'null')&&(EmpMName != null)){
											NameArr.push(EmpMName);
										}
										if((EmpLName != '')&&(EmpLName != 'null')&&(EmpLName != null)){
											NameArr.push(EmpLName);
										}
										var EmpName = NameArr.join(' ');
									}else{
										var EmpName = element.emp_known_as;
									}
									var ExistInWorkFLowEmp = $('#modal_emp option[value="' + element.employee_no + '"]').length > 0;
									if(!ExistInWorkFLowEmp){
										$("#modal_oth_org_emp").append('<option value="'+element.employee_no+'"><span class="testing">'+element.employee_no+' - '+EmpName+' - '+OrgString+'</option>');
									}
								});
							}
						}
						$("#modal_oth_org_emp").chosen();
						$('.chosen-container').css('font-weight',500);
					}
				}
			});
		}

		////////////////	FOR WORKFLOW UPDATED 14/09/2024	- ENDS HERE    ////////////////


















		var KillEvent = 0;
		$("body").on("change","#txt_supp_doc_file", function(event){ 
			var SuDocFile = $(this).val();
			var fileExtension = ['pdf'];
			if($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
					BootstrapDialog.alert("Only formats are allowed : "+fileExtension.join(', '));
					$(this).val('');
					event.preventDefault();
					event.returnValue = false;
			}else if(this.files[0].size > 5048576){  //5242880
				$(this).val('');
				BootstrapDialog.alert("Upload file size should be less than 5MB!");
				event.preventDefault();
				event.returnValue = false;
			}
		});
		$("body").on("click","#AddDocument", function(event){ 
			
			var FormStr = '<div class="row smclearrow"></div>';
			FormStr += '<form name="SuppDocForm" id="SuppDocForm" method="post" enctype="multipart/form-data" name="form">';
			FormStr += '<div class="row">';
			FormStr += '<div class="div3 lboxlabel">Document Description <span class="reqindi">*</span></div>';
			FormStr += '<div class="div7"><input type="text" name="txt_supp_doc_desc" id="txt_supp_doc_desc" value="" class="tboxsmclass"></div>';
			FormStr += '</div>';
			FormStr += '<div class="row smclearrow"></div>';
			FormStr += '<div class="row">';
			FormStr += '<div class="div3 lboxlabel">Upload File <span class="reqindi">*</span></div>';
			FormStr += '<div class="div7"><input type="file" name="txt_supp_doc_file" id="txt_supp_doc_file" class="tboxsmclass"></div>';
			FormStr += '</div>';
			FormStr += '<div class="row smclearrow"></div>';
			FormStr += '<div class="row">';
			FormStr += '<div class="div3 lboxlabel">&nbsp;</div>';
			FormStr += '<div class="div7 lboxlabel no-margin">(Allows only .pdf files)</div>';
			FormStr += '</div>';
			FormStr += '<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" /></form>';
			FormStr += '<div class="row smclearrow"></div>';
			BootstrapDialog.show({
				title: 'Upload Supporting Documents',
				message: FormStr,
				closable: false, // <-- Default value is false
				draggable: false,
				buttons: [{
					label: 'Close',
					action: function(dialog) {
						dialog.close();
					}
				},{
					label: 'Upload',
					action: function(dialog) {
						var DocDesc = $("#txt_supp_doc_desc").val();
						var DocFile = $("#txt_supp_doc_file").val();
						var SheetId = $("#cmb_work_no").val();
						var Rbn = $("#txt_rab").val();
						
						if(DocDesc.trim() == ""){
							BootstrapDialog.alert("Document description should not be empty");
							event.preventDefault();
						}else if(DocFile == ""){
							BootstrapDialog.alert("Upload file should not be empty");
							event.preventDefault();
						}else{
							//var form = $('#SuppDocForm')[0]; // You need to use standart javascript object here	
							//var formData = new FormData(form.get(0));
							var formData = new FormData($('#SuppDocForm')[0]);
							formData.append('SheetId', SheetId);
							formData.append('Rbn', Rbn);
							$.ajax({ 
								type: 'POST',
								data : formData,//{ "_token": "{{ csrf_token() }}", SheetId: SheetId, Rbn: Rbn, formData: formData },
								dataType: 'json',
								contentType	:  false,       // The content type used when sending data to the server.
								cache		:  false,             // To unable request pages to be cached
								processData	:  false,
								success: function (data) {
									if(data != null){
										var Status = 0;
										var Message = "";
										if(data){
											Status = data['status'];
											Message = data['message'];
										}
										if(Message == ""){
											Message = "Supporting Document not uploaded. Please try again.";
										}
										BootstrapDialog.show({
											title: 'Information',
											message: Message,
											closable: false, // <-- Default value is false
											draggable: false,
											buttons: [{
												label: 'Close',
												action: function(dialog) {
													dialog.close();
													location.reload();
												}
											}]
										});
									}
								}
							});
							dialog.close();
						}
					}
				}]
			});
		});
		$("body").on("click",".DelRABSuppDoc", function(event){
			var DocId = $(this).attr("data-id");
			var DocType = $(this).attr("data-type");
			BootstrapDialog.confirm({
				title: 'Confirmation Message',
				message: 'Are you sure want to delete this document ?',
				closable: false, // <-- Default value is false
				draggable: false, // <-- Default value is false
				btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
				btnOKLabel: 'Ok', // <-- Default value is 'OK',
				callback: function(result) {
					if(result){
						$.ajax({
							type: 'POST',
							data : { "_token": "{{ csrf_token() }}", DocId: DocId, DocType: DocType },
							success: function(data) {
								if(data != null){
									if(data == 1){
										var Message = "Document deleted successfully";
									}else{
										var Message = "Document not deleted. Please try again.";
									}
								}else{
									var Message = "Document not deleted. Please try again.";
								}
								BootstrapDialog.show({
									title: 'Information',
									message: Message,
									closable: false, // <-- Default value is false
									draggable: false,
									buttons: [{
										label: 'Close',
										action: function(dialog) {
											//dialog.close();
											location.reload();
										}
									}]
								});
							}
						});
					}
				}
			});
		});
		
		/*$("body").on("click",".PreviewRABSuppDoc", function(event){
			var FormStr = '<div class="row smclearrow"></div>';
			FormStr += '<form name="SuppDocForm" id="SuppDocForm" method="post" enctype="multipart/form-data" name="form">';
			FormStr += '<div class="row">';
			FormStr += '<div class="div12"><iframe id="filePreviewFrame" src="" style="width: 100%; height: 500px;"></iframe>';
			FormStr += '</div>';
			FormStr += '<div class="row smclearrow"></div>';
			FormStr += '<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" /></form>';
			FormStr += '<div class="row smclearrow"></div>';
			var DocId = $(this).attr("data-id");
			var DocType = $(this).attr("data-type");
			BootstrapDialog.show({
				title: 'Upload Supporting Documents',
				message: FormStr,
				closable: false, // <-- Default value is false
				draggable: false,
				onshown: function(dialogRef){ 
					$.ajax({
						type: 'POST',
						data : { "_token": "{{ csrf_token() }}", DocId: DocId, DocType: DocType },
						//dataType: 'binary', // Use binary dataType to handle binary data
						responseType: 'arraybuffer', // Set responseType to 'arraybuffer' to receive binary data
						dataType: 'text',
						//headers: {'Content-Type': 'application/x-www-form-urlencoded'},
						success: function(data) {
							var blob = new Blob([data], { type: 'application/pdf' });
							var url = URL.createObjectURL(blob);
							$('#filePreviewFrame').attr('src', url);
						},
						error: function(xhr, status, error) {
							console.log('Error fetching file:', error);
						}
					});
				},
				buttons: [{
					label: 'OK',
					action: function(dialog) {
						dialog.close();
					}
				}]
			});
		});*/
		/*
		$("body").on("click",".actionbutton", function(event){ 
			if(KillEvent == 0){ 
				var MsgStr = $("#cmb_check_sub").attr("data-msg");
				var CanSub = $("#cmb_check_sub").attr("data-cansub");
				if(CanSub == 0){
					var Id = $(this).attr("data-flag");
					var Name = $(this).attr("data-name");
					var Remark = $("#txt_remarks").val();
					var Err = 0;
					var message = "";
					if(Id == "FW"){
						message = "Are you sure want to Forward ?"
					}else if(Id == "BK"){
						message = "Are you sure want to Backward ?"
						if(Remark == ""){
							Err++;
						}
					}else if(Id == "FZ"){
						message = "Are you sure want to Approve ?"
					}else if(Id == "SU"){
						message = "Are you sure want to Submit ?"
					}
					var chkpoint = 0;
					var UserCnt = 0; var EmpNo = "";
					if((Id == "FW")||(Id == "BK")||(Id == "SU")){
						var UserCnt = $(this).attr("data-usercnt");
						if(Id == "FW"){
							EmpNo = $("#txt_fw_emp_no").val();
						}
						if(Id == "SU"){
							EmpNo = $("#txt_fw_emp_no").val();
						}
						if(Id == "BK"){
							EmpNo = $("#txt_bw_emp_no").val();
						}
					}
					if((UserCnt > 0)&&(EmpNo == "")){
						let chkpointTemp = chkpoint;
						chkpoint = 3;
						event.preventDefault();
						if(Id == "FW"){ 
							var UserData = $("#FwUser").attr("data-user");
						}else if(Id == "SU"){  
							var UserData = $("#FwUser").attr("data-user");
						}else if(Id == "BK"){  
							var UserData = $("#BwUser").attr("data-user");
						}else{ 
							var UserData = [];
						} 
						let Users = $.parseJSON(UserData);
						let EmpStr = '<div>Select Employee</div>';
						EmpStr += '<select class="tboxclass" name="modal_emp" id="modal_emp">';
						EmpStr += '<option value=""> --- Select --- </option>';
						Object.entries(Users).forEach(([key1, value1]) => {
							EmpStr += '<option value="'+value1.emp_no+'">'+value1.emp_known_as+'</option>';
						});
						EmpStr += '</select>';
						BootstrapDialog.show({
							title: 'Default Title',
							message: EmpStr,
							buttons: [{
								label: 'OK',
								action: function(dialog) {
									if($("#modal_emp").val() == ''){
										BootstrapDialog.alert('Please select employee..!!');
									}else{
										if(Id == "FW"){
											BootstrapDialog.alert('Now you can click forward button to proceed further');
											$("#txt_fw_emp_no").val($("#modal_emp").val());
										}
										if(Id == "SU"){
											BootstrapDialog.alert('Now you can click submit button to proceed further');
											$("#txt_fw_emp_no").val($("#modal_emp").val());
										}
										if(Id == "BK"){
											BootstrapDialog.alert('Now you can click backward button to proceed further');
											$("#txt_bw_emp_no").val($("#modal_emp").val());
										}
										dialog.close();
									}
								}
							}]
						});
					}

					if((message != "")&&(Err == 0)&&(chkpoint == 0)){
						event.preventDefault();
						BootstrapDialog.confirm({
							title: 'Confirmation Message',
							message: message,
							closable: false, // <-- Default value is false
							draggable: false, // <-- Default value is false
							btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
							btnOKLabel: 'Ok', // <-- Default value is 'OK',
							callback: function(result) {
								if(result){
									KillEvent = 1;
									if(Id == "FW"){
										$("#btn_forward").trigger("click");
									}else if(Id == "BK"){
										$("#btn_backward").trigger("click");
									}else if(Id == "FZ"){
										$("#btn_freeze").trigger("click");
									}else if(Id == "SU"){
										$("#btn_submit").trigger("click");
									}
								}else {
									KillEvent = 0;
								}
							}
						});
					}else{
						event.preventDefault();
						if(message == ""){
							BootstrapDialog.alert("Error : Sorry Invalid Action");
						}else if(Err > 0){
							BootstrapDialog.alert("Error : Please enter remarks.. !");
						}
					}
				}else{
					event.preventDefault();
					BootstrapDialog.alert(MsgStr);
					KillEvent = 0;
				}
			}
		});
		*/

		$("body").on("click","#txt_oth_remarks", function(event){
			let othrem = $("#txt_oth_remarks").attr("data-othrem");
			let othrem1 = $.parseJSON(othrem);
			let appndstr = '';
			let snorem = 1;
			appndstr += '<table width="100%" align="center" class="formtable">';
			appndstr += '<thead><tr><th style="text-align:center;">S No.</th><th style="text-align:left;">Remarks Done By</th><th style="text-align:center;">Remarks</th><th style="text-align:center;">Remarks Date</th></tr><thead>';
			Object.entries(othrem1).forEach(([key1, value1]) => {
				if(value1.Remark == null || value1.Remark == ""){
					value1.Remark = " - ";
				}
				if(value1.CreatedOn == null || value1.CreatedOn == ""){
					value1.CreatedOn = " - ";
				}
				appndstr += '<tr class="label"><td align="center">'+snorem+'</td><td align="left">'+value1.EmpName+'</td><td align="left">'+value1.Remark+'</td><td align="left">'+value1.CreatedOn+'</td></tr>';
				snorem++;
			});
			appndstr += '</table>';
			BootstrapDialog.alert({
				title: 'All Remarks',
				message: appndstr,
				closable: false, // <-- Default value is false
				draggable: false, // <-- Default value is false
				btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
				btnOKLabel: 'Ok', // <-- Default value is 'OK',
			});
		});
		$("body").on("click",".DocDownload", function(event){
			BootstrapDialog.alert("No document available to download / Document not yet prepared");
		});
		

	});
</script>

@endsection