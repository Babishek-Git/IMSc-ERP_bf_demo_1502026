@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
<form action="" method="post" enctype="multipart/form-data" name="form">
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<div align="right"></div>
				<blockquote class="bq1" style="overflow:auto">
				<div class="container" align="center">
					<div class="div1 "></div>
					<div class="div10 mbtable" align="center">
						<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> Upload File Directory - View </div></div></div>
						<div class="row innerdiv">
							<div class="row">
								<table class="table-bordered table1" width="99%" align="center" id="dataTable">
									<thead>
										<tr class="note heading">
											<th class="colhead" style="text-align:center">SNo.</th>
											<th class="colhead" style="text-align:center">Module Name</th>
											<th class="colhead" style="text-align:center">Module Sub Code</th>
                                            <th class="colhead" style="text-align:center">Directory</th>
											<th class="colhead" style="text-align:center">Status</th>
											<th class="colhead" style="text-align:center"></th>
											<th class="colhead" style="text-align:center">Action</th>
											<th class="colhead" style="text-align:center"></th>
										</tr>
									</thead>
									<tbody>
									@foreach($data['ShowUploadFileDirect'] as $UpFileDir)
										<tr>
											<td align="center">{{ $loop->iteration }}</td>
											@php
											$UploadFilDir = $UpFileDir->module_code;
											if(isset($data['ShowModuleList'])){
												$UploadFilDir = $UpFileDir->module_code;
												$ShowModules = NULL;
												foreach($data['ShowModuleList'] as $List){
													$ShowModule = collect($data['ShowModuleList'])->where('wf_moduleid', $List->wf_moduleid)->pluck('wf_module_code')->first();
													$ShowModuleName = collect($data['ShowModuleList'])->where('wf_moduleid', $List->wf_moduleid)->pluck('wf_module_name')->first();
													if($List->wf_module_code == $UpFileDir->module_code){
														$ShowModules = $List->wf_module_name;	
													}
													else{	
														switch($UploadFilDir){
															case 'AGMT':
																if($UploadFilDir == 'AGMT'){
																	$ShowModules = 'Agreement';
																	break;
																}
															case 'EST':
																if($UploadFilDir == 'EST'){
																	$ShowModules = 'Tender Estimate';
																	break;
																}
															case 'DEU':
																if($UploadFilDir == 'DEU'){
																	$ShowModules = 'Tender Estimate';
																	break;
																}
															case 'DES':
																if($UploadFilDir == 'DES'){
																	$ShowModules = 'Tender Estimate';
																	break;
																}
															case 'DOWNLOAD':
																if($UploadFilDir == 'DOWNLOAD'){
																	$ShowModules = 'DOWNLOAD';
																	break;
																}
															case 'UPLOAD':
																if($UploadFilDir == 'UPLOAD'){
																	$ShowModules = 'UPLOAD';
																	break;
																}
															case 'TEVAL':
																if($UploadFilDir == 'TEVAL'){
																	$ShowModules = 'Technical Bid Evaluation';
																	break;
																}
															case 'USRMAN':
																if($UploadFilDir == 'USRMAN'){
																	$ShowModules = 'User Manual';
																	break;
																}
															case 'RAB':
																if($UploadFilDir == 'RAB'){
																	$ShowModules = 'Running Account Bill';
																	break;
																}
														}	
													}		
												}	
											}
											@endphp
											<td align="left">{{ $ShowModules }}</td>	
											<td align="left">{{ $UpFileDir->module_sub_code }}</td>
											<td align="left">{{ $UpFileDir->directory_name }}</td>
											@if($UpFileDir->active == 1)
												<td align="center" style="width:50px">Active</td>
											@else
												<td align="center" style="width:50px">Deleted</td>
											@endif
											@if($UpFileDir->active == 1)
												<td align="center" style="width:50px">
													<button type="button" name="btn_edit" id="btn_edit" class="btn btn-default teditbtn estEdit" onclick="edit('{{ route('admin.UploadFileDir', ['id' => encrypt($UpFileDir->updirid)]) }}')" title="Click here to Edit" style="cursor: pointer;"><i class="fa fa-edit pt2"></i></button>
												</td>
											@else
												<td align="center" style="width:50px">
													<button type="button" disabled name="btn_edit" id="btn_edit" class="btn btn-default estEdit" style="cursor: pointer;"><i class="fa fa-edit pt2"></i></button>
												</td>
											@endif
											<td align="center" style="width:50px">
												@if($UpFileDir->active == 1)
													<button type="button" name = "btn_delete" id = "btn_delete" class="btn btn-default tdelbtn Delete" title="Click here to delete"  data-id = "({{ encrypt($UpFileDir->updirid) }})" style="cursor: pointer;"><i class="fa fa-trash-o pt2"></i></button>												
												@else
													<button type="button" disabled name = "btn_delete" id = "btn_delete" class="btn btn-default Delete" style="cursor: pointer;"><i class="fa fa-trash-o pt2"></i></button>											
												@endif
											</td>
											<td align="center" style="width:50px">
												@if($UpFileDir->active == 0)
													<button type="button" name = "btn_undo_delete" id = "btn_undo_delete" class="btn btn-default tdelbtn UndoDelete" title="Click here to activate" data-id = "({{ encrypt($UpFileDir->updirid) }})" style="cursor: pointer;"><i class="fa fa-recycle"></i></button>												
												@else
													<button type="button" disabled name = "btn_undo_delete" id = "btn_undo_delete" class="btn btn-default UndoDelete" style="cursor: pointer;"><i class="fa fa-recycle"></i></button>
												@endif
											</td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="div1 "></div>
					</div>
						@php $AddUrl = 'admin.UploadFileDir'; @endphp 
					<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
						<div class="buttonsection">
							<input type="button" name="back" value="Back" class="backbutton" onClick="window.location='{{route($AddUrl)}}'" >
						</div>								
						<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
						</div>
					</div>
				</blockquote>
			</div>
		</div>
	</div>
</form>
<script>
	function edit(url) {
		window.location.href = url;
	}

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
					if((colIdx == 1)||(colIdx == 2)||(colIdx == 3)){
						$(cell).html('<input type="text" placeholder="' + title + '" />');
					}else{
						$(cell).html('');
					}
					if((colIdx == 5)){
					$(cell).html('Edit');
					}
					if((colIdx == 6)){
						$(cell).html('Delete');
					}
					if((colIdx == 7)){
						$(cell).html('Activate');
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
				message: 'Are you sure you want to Delete the Upload File Directory?',
				closable: false, 
				draggable: false, 
				btnCancelLabel: 'Cancel', 
				btnOKLabel: 'Ok', 
				callback: function(result) {
					if(result){
						$.ajax({ 
							type: 'POST', 
							url: "{{ route('ajax.DeleteUploadFileDirect') }}", 
							data: {'_token': '{{ csrf_token() }}','Id': Id },  
							success: function (data){ 
								if(data != null){
									var message = "Upload File Directory Deleted Successfully";
								}else{
									var message = "Upload File Directory is not deleted. Please try again";
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
		
		$("body").on("click",".UndoDelete", function(event){
			var Id = $(this).attr("data-id");
			var Type = 'UploadFileDir';
			BootstrapDialog.confirm({
				title: 'Confirmation Message',
				message: 'Are you sure you want to Activate the Upload File Directory?',
				closable: false, 
				draggable: false, 
				btnCancelLabel: 'Cancel', 
				btnOKLabel: 'Ok', 
				callback: function(result) {
					if(result){
						$.ajax({ 
							type: 'POST', 
							url: "{{ route('ajax.UndoDelete') }}", 
							data: {'_token': '{{ csrf_token() }}','Id': Id ,'Type': Type},
							success: function (data){ 
								if(data != null){
									var message = "Upload File Directory Activated Successfully";
								}else{
									var message = "Upload File Directory is not activated. Please try again";
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

<style>
	.colhead > input[type="text"] {
		width:80px;
	}
</style>
@endsection	

