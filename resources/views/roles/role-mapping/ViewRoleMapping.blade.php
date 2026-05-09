@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@if(isset($data['RoleMapData']))
	@php
	$RoleMapData = $data['RoleMapData'];
	@endphp
@endif
<form action="" method="post" enctype="multipart/form-data" name="form">
<!--==============================Content=================================-->
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<div align="right"></div>
				<blockquote class="bq1" style="overflow:auto">
					<div class="container" align="center">
						<div class="row ">
							<div class="div1">&nbsp;</div>
							<div class="div10 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Employee Role Mapping - View</div></div></div>
								<div class="card-body padding-1 ChartCard" id="CourseChart">
									<div class="divrowbox innerdiv pt-2">
										<table class="table-bordered table1" align="center" id="dataTable">
											<thead>
												<tr>
													<th class="colhead">SNo.</th>
													<th class="colhead">Employee No.</th>
													<th class="colhead">Employee Name</th>
													<th class="colhead">Role</th>
													<!-- <th>Action</th> -->
												</tr>
											</thead>
											<tbody>
											@if(isset($data['StaffData']))
												@foreach($data['StaffData'] as $StaffList)
													<tr>
														<td align="center">{{ $loop->iteration }}</td>
														<td align="center">{{ $StaffList->emp_no }}</td>
														<td align="left">{{ $StaffList->emp_known_as }}</td>
														<td align="left">
															@php
																if(isset($RoleMapData) && isset($RoleMapData[$StaffList->emp_no]) && count($RoleMapData[$StaffList->emp_no]) > 0){
																	foreach($RoleMapData[$StaffList->emp_no] as $RoleMapRow){
																		if($RoleMapRow == end($RoleMapData[$StaffList->emp_no])){
																			$StyleStr = "";
																		} else {
																			$StyleStr = "border-bottom:1px solid #ddd;";
																		}
																		$roleMappingId = isset($RoleMapRow->role_mapping_id) ? encrypt($RoleMapRow->role_mapping_id) : '';
																		if ($RoleMapRow->active == 0) {
																			echo '<button type="button" name = "btn_undo_delete" id = "btn_undo_delete" class="btn btn-default tdelbtn UndoDelete" title="Click here to Activate the RoleMapping" data-id="'.$roleMappingId.'"  style="cursor: pointer; float: right; margin-top: 5px;"><i class="fa fa-recycle"></i></button>';
																		} else {
																			echo '<button type="button" disabled name = "btn_undo_delete" id = "btn_undo_delete" class="btn btn-default  UndoDelete"  style="cursor: pointer; float: right; margin-top: 5px;"><i class="fa fa-recycle"></i></button>';
																		}
																		if ($RoleMapRow->active == 1) {
																			echo '<button type="button" name="btn_delete" class="btn btn-default tdelbtn Delete" title="Click here to delete" data-id="'.$roleMappingId.'" style="cursor: pointer; float: right; margin-top: 5px;"><i class="fa fa-trash-o pt2"></i></button>';
																		} else {
																			echo '<button type="button" disabled name="btn_delete" id="btn_delete" class="btn btn-default Delete" style="cursor: pointer; float: right; margin-top: 5px;"><i class="fa fa-trash-o pt2"></i></button>';
																		}
																		
																		echo '<div style="'.$StyleStr.'">'.$RoleMapRow->role_name.' <br/><div style="color:#565B5F">('.$RoleMapRow->group.'/'.$RoleMapRow->division.'/'.$RoleMapRow->section.'/'.$RoleMapRow->subsection.')</div></div>';
																	}
																}
															@endphp
														</td>
														<!-- <td align="center" style="width:100px">
															<button type="button" name = "btn_delete" id = "btn_delete" class="btn btn-default tdelbtn Delete" title="Click here to delete" style="cursor: pointer;"><i class="fa fa-trash-o pt2"></i></button>												
														</td> -->
													</tr>
												@endforeach
											@endif
											</tbody>
										</table>
										@php $AddUrl = 'roles.RoleMapping'; @endphp	
										<div class="row" align="center">
											<!-- <div class="buttonsection"><input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/></div> -->
											<div class="buttonsection"><input type="button" class="backbutton"  name="back" id="back" value="Back" onClick="window.location='{{ route($AddUrl) }}'"/></div>
										</div>
									</div>
								</div>
							</div>
							<div class="div1">&nbsp;</div>
						</div>
					</div>
				</blockquote>
			</div>
		</div>
	</div>
</form>
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
					var title = $(cell).text(); //  here we have to write based on colindex for display search & Hide colummn text
					if((colIdx == 1)||(colIdx == 2)||(colIdx == 3)){
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
		$("body").on("click",".Delete", function(event){
			var Id = $(this).attr("data-id");
			BootstrapDialog.confirm({
				title: 'Confirmation Message',
				message: 'Are you sure you want to Delete the RoleMapping?',
				closable: false, 
				draggable: false, 
				btnCancelLabel: 'Cancel', 
				btnOKLabel: 'Ok', 
				callback: function(result) {
					if(result){
						$.ajax({ 
							type: 'POST', 
							url: "{{ route('ajax.RoleMappingStatus') }}", 
							data: { '_token': '{{ csrf_token() }}','Id': Id }, 
							success: function (data){ 
								if(data != null){
									var TS = data['TS']; 
									var DEU = data['DEU'];
									var NIT = data['NIT'];
									var CST = data['CST'];
									var NCST = data['NCST'];
									var WO = data['WO'];
									var RABUC = data['RABUC'];
									var BDES = data['BDES'];
									var PG = data['PG'];
									var SD = data['SD'];
									var BILLV = data['BILLV'];
									var CSTA = data['CSTA'];
									var NCSTA = data['NCSTA'];

									var TableStr	= '';
									function generateTable(title, dataArray) {
										TableStr += '<table class="table dataTable rtable table2excel example" border="1" width="100%" align="center">';
										TableStr += '<thead><tr><th>' + title + '</th></tr></thead>';
										TableStr += '<tbody>';
										dataArray.forEach(function(innerArray, outerIndex) {
											innerArray.forEach(function(workItem, innerIndex) {
												TableStr += '<tr><td style="text-align:left">' + (outerIndex * innerArray.length + innerIndex + 1) + ' - ' + workItem.work_name + '</td></tr>';
											});
										});
										TableStr += '</tbody>';
										TableStr += '</table>';
									}
									var cnt = 0;
									if (DEU.length > 0) {
										generateTable('Tender Estimate', DEU);
										cnt++;
									}
									if (TS.length > 0) {
										generateTable('Technical Sanction', TS);
										cnt++;
									}
									if (NIT.length > 0) {
										generateTable('Notice Inviting Tender', NIT);
										cnt++;
									}
									if (CST.length > 0) {
										generateTable('Comparative Statement', CST);
										cnt++;
									}
									if (NCST.length > 0) {
										generateTable('Negotiate Comparative Statement', NCST);
										cnt++;
									}
									if (WO.length > 0) {
										generateTable('Work Order', WO);
										cnt++;
									}
									if (RABUC.length > 0) {
										generateTable('BILL FORWARD TO CHECK & APPROVE', RABUC);
										cnt++;
									}
									if (BDES.length > 0) {
										generateTable('Deviated,Extra,Substitute Item', BDES);
										cnt++;
									}
									if (PG.length > 0) {
										generateTable('Performance Guarantee', PG);
										cnt++;
									}
									if (SD.length > 0) {
										generateTable('Security Deposit', SD);
										cnt++;
									}
									if (BILLV.length > 0) {
										generateTable('Bill Verification', BILLV);
										cnt++;
									}
									if (CST.length > 0) {
										generateTable('Comparative Statement (Accounts)', CST);
										cnt++;
									}
									if (NCST.length > 0) {
										generateTable('Negotiate Comparative Statement (Accounts) ', NCST);
										cnt++;
									}
									if(cnt > 0){
										BootstrapDialog.confirm({
											message: TableStr,
											title:' Work Pending List  ',
											size:'LARGE',
											closable: false, 
											draggable: false, 
											btnCancelLabel: 'Cancel', 
											btnOKLabel: 'Ok',
											callback: function(result) {
												if(result){
													$.ajax({ 
														type: 'POST', 
														url: "{{ route('ajax.DeleteRoleMapping') }}", 
														data: { '_token': '{{ csrf_token() }}','Id': Id }, 
														success: function (data){ 
															if(data != null){
																var message = "RoleMapping Deleted Successfully";
															}else{
																var message = "RoleMapping is not Deleted. Please try again";
															}
															BootstrapDialog.show({
																title: 'Information',
																message: message,
																buttons: [{
																	label: 'OK',
																	action: function(dialog) {
																		dialog.close();
																		location.reload();
																	}
																}]
															});
														}
													});
												}				
											}
										});
									}else{
										$.ajax({ 
											type: 'POST', 
											url: "{{ route('ajax.DeleteRoleMapping') }}", 
											data: { '_token': '{{ csrf_token() }}','Id': Id }, 
											success: function (data){ 
												if(data != null){
													var message = "RoleMapping Deleted Successfully";
												}else{
													var message = "RoleMapping is not Deleted. Please try again";
												}
												BootstrapDialog.show({
													title: 'Information',
													message: message,
													buttons: [{
														label: 'OK',
														action: function(dialog) {
															dialog.close();
															location.reload();
														}
													}]
												});
											}
										});
									}
									
								}
							}
						});
					}
				}
			});
		});
		$("body").on("click",".UndoDelete", function(event){
			var Id = $(this).attr("data-id");
			var Type = 'RoleMapping';
			BootstrapDialog.confirm({
				title: 'Confirmation Message',
				message: 'Are you sure you want to Activate the RoleMapping?',
				closable: false, 
				draggable: false, 
				btnCancelLabel: 'Cancel', 
				btnOKLabel: 'Ok', 
				callback: function(result) {
					if(result){
						$.ajax({ 
							type: 'POST', 
							url: "{{ route('ajax.UndoDelete') }}", 
							data: { '_token': '{{ csrf_token() }}','Id': Id ,'Type': Type}, 
							success: function (data){ 
								if(data != null){
									var message = "RoleMapping Activated Successfully";
								}else{
									var message = "RoleMapping is not Activated. Please try again";
								}
								BootstrapDialog.show({
									title: 'Information',
									message: message,
									buttons: [{
										label: 'OK',
										action: function(dialog) {
											dialog.close();
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
    });
</script>
@endsection	
			
