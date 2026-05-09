@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php 

$MaxWorkMoveDataArr = [];
if(isset($data['MaxWorkMoveData'])){
	$MaxWorkMove = $data['MaxWorkMoveData'];
	foreach($MaxWorkMove as $MaxMovevalue){
		$MaxWorkMoveDataArr[$MaxMovevalue->transaction_id] = $MaxMovevalue->created_at;
	}
}
$EmpDataArr = [];
if(isset($data['Empdata'])){
	$EmpData = $data['Empdata'];
	foreach($EmpData as $Empvalue){ 
		$EmpDataArr[$Empvalue->emp_no] = $Empvalue->emp_name_payslip;
	}
}
$RoleDataArr = [];
if(isset($data['RoleData'])){
	$RoleData = $data['RoleData'];
	foreach($RoleData as $EmpRolevalue){
		$RoleDataArr[$EmpRolevalue->roleid] = $EmpRolevalue->role_name;
	}
}
@endphp
<form action="" method="post" enctype="multipart/form-data" name="form">
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1" style="overflow:auto">
					<div class="container">
						<div class="row plr">
							<div class="div12 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> Indent Status List</div></div></div>
								<div class="row innerdiv">
									<div class="row">
										<table class="table-bordered dataTable no-footer" align="center" id="dataTable">
											<thead>
												<tr>
													<th class="colhead" nowrap="nowrap">SNo.</th>
													<th class="colhead">Indent No.</th>
													<th class="colhead">Indent Title</th>													
													<th class="colhead" nowrap="nowrap">Indent Created By</th>
													<th class="colhead" nowrap="nowrap">Indent Date</th> 
													<!-- <th class="colhead">Sent By</th> -->
													<th class="colhead">Current Status</th>
													<th class="colhead">Detailed Status</th>
												</tr>
											</thead>
											<tbody>
												@php
													if(isset($data['Indentdata'])){
														$Snumber = 1;
														foreach($data['Indentdata'] as $Indentdata){
																$EmpName  = $EmpDataArr[$Indentdata->created_by];
												@endphp
												<tr>
													@php 
													if(isset($Indentdata->created_date)){ 
														$CreatedDate = explode(" ",$Indentdata->created_date);
														$DataBaseDate = $CreatedDate[0];
														$DisplayDate = Helper::DisplayDateFormat($DataBaseDate);
													} 
													@endphp
													<td style="text-align:center" align="center">@php if(isset($Snumber)){ echo $Snumber; } @endphp</td>
													<td style="text-align:left" align="left">@php if(isset($Indentdata->indent_no)){ echo $Indentdata->indent_no; } @endphp</td>
													<td style="text-align:left" align="left">@php if(isset($Indentdata->indent_descripton)){ echo $Indentdata->indent_descripton; } @endphp</td>
													<td class="col" align="center">@php if(isset($EmpName)){ echo $EmpName; }@endphp</td>
													<td class="col" align="center">@php if(isset($Indentdata->indent_date)){ echo Helper::DisplayDateFormat($Indentdata->indent_date);} @endphp</td>
													@php 
													$Indentstatus = $Indentdata->status;
													$FromEmpNo = $Indentdata->from_emp_no;
													$FromRole  = $Indentdata->from_role;
													$ToEmpNo   = $Indentdata->to_emp_no;
													$ToRole    = $Indentdata->to_role;
													if(isset($EmpDataArr[$FromEmpNo])) {
														$FromEmpName = $EmpDataArr[$FromEmpNo];
													}													
													if(isset($EmpDataArr[$ToEmpNo])) {
														$ToEmpName = $EmpDataArr[$ToEmpNo];
													}
													$SentOnStr = '';													
													if(isset($MaxWorkMoveDataArr)){
														if(isset($MaxWorkMoveDataArr[$Indentdata->indent_id])){
															$MaxWorkData = $MaxWorkMoveDataArr[$Indentdata->indent_id];
															if(filled($MaxWorkData)){
																$SentOnStr = \Carbon\Carbon::parse($MaxWorkData)->format('d/m/Y H:i:s A');
															}
														}
													}								
													@endphp
													<!-- <td style="text-align:center" align="left">
													@php 										
														if(isset($Indentstatus)){
															if($Indentstatus == "SU" && $ToRole !=''){
																if(isset($FromRole)){
																	if(isset($RoleDataArr[$FromRole])){
																		$Roles = $RoleDataArr[$FromRole];
																		if(isset($Roles)){
																			if(isset($FromEmpName)){
																				$FromEmpNameStr = '('.$FromEmpName.')';
																			}else{
																				$FromEmpNameStr = '';
																			}
																			echo '<span style="font-size:12px;"><span style="color:red;">'.$Roles.'</span><br>'.$FromEmpNameStr.'<br/>(Sent On : '.$SentOnStr.')</span>';
																		}
																	}
																}
															}else{
																echo '-';
															}
														}
													@endphp
													</td> -->
													<td style="text-align:center" align="left">
													@php														
														if(isset($Indentstatus)){
															if($Indentstatus == "approved"){
																echo '<span style="font-size:12px;" >Indent Freezed</span>';
																 // FOR NEW CREATE INDENT //
															}else if($Indentstatus == "SU" && $ToRole == ''){
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
															}else if($Indentstatus == "submitted" || $Indentstatus  =='recommended'){
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
															}else if($Indentstatus == "rejected"){
																if(isset($FromRole)){
																	if(isset($RoleDataArr[$FromRole])){
																		$RejRoles = $RoleDataArr[$FromRole];
																		if(isset($RejRoles)){
																			if(isset($FromEmpName)){
																				$RejEmpName = '('.$FromEmpName.')';
																			}else{
																				$RejEmpName = '';
																			}
																			echo '<span  style="font-size:12px;"><span style="color:red;"> Indent Return Back by '.$RejRoles.'</span><br>'.$RejEmpName.'</span>';
																		}
																	}
																}
															}
															/* }else if($Indentstatus == "SU"){
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
															} */
														}
													@endphp
													</td>
													
													<td class="col" align="center">
														<button type="button" onclick="window.location='{{ route('indent.indent-all-staus', ['page'=>encrypt('SUBMITED'),'id'=>encrypt($Indentdata->indent_id),'modulecode'=>encrypt('INDENT')])}}'" class="btn btn-default tuploadbtn" title="Click here to View" style="cursor: pointer;"><i class="fa fa-hand-o-right"></i> View Detailed Status</button>
													</td>
												</tr>
												@php
														$Snumber++;
															}
													}
												@endphp
											</tbody>
										</table>
									</div>
								</div>
					     	</div> 
							<div class="div12">&nbsp;</div> 
						</div>
					</div>
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
		$(document).ready(function(){
		$('#dataTable thead tr')
        .clone(true)
        .addClass('filters filterhead')
        .insertBefore('#dataTable thead');
		var table = $('#dataTable').DataTable({
			orderCellsTop: false,
			fixedHeader: false,
			initComplete: function () {
				var api = this.api();
				api
				.columns()
				.eq(0)
				.each(function (colIdx) {
					var cell = $('.filters th').eq(
						$(api.column(colIdx).header()).index()
					);
					var title = $(cell).text(); 
					if((colIdx == 1)||(colIdx == 2)||(colIdx == 3)||(colIdx == 4)){
						$(cell).html('<input type="text" placeholder="' + title + '" />');
					}else{
						$(cell).html('');
					}
					$(
						'input',
						$('.filters th').eq($(api.column(colIdx).header()).index())
					)
					.off('keyup change')
					.on('change', function (e) {
						$(this).attr('title', $(this).val());
						var regexr = '({search})'; //$(this).parents('th').find('select').val();
						var cursorPosition = this.selectionStart;
						api
						.column(colIdx)
						.search(
							this.value != ''
								? regexr.replace('{search}', '(((' + this.value + ')))')
								: '',
							this.value != '',
							this.value == ''
						)
						.draw();
					})
					.on('keyup', function (e) {
						e.stopPropagation();

						$(this).trigger('change');
						$(this)
							.focus()[0]
							.setSelectionRange(cursorPosition, cursorPosition);
					});
				});
			},
		});
	});
</script>
@endsection
