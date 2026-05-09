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
						<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> Bank Instrument - View </div></div></div>
						<div class="row innerdiv">
							<div class="row">
								<table class="table-bordered table1" width="99%" align="center" id="dataTable">
									<thead>
										<tr class="note heading">
											<th class="colhead" style="text-align:center">SNo.</th>
											<th class="colhead" style="text-align:center">Bank Instrument Name</th>
											<th class="colhead" style="text-align:center">Bank Instrument Code</th>
											<th class="colhead" style="text-align:center">Status</th>
											<th class="colhead" style="text-align:center"></th>
											<th class="colhead" style="text-align:center">Action</th>
											<th class="colhead" style="text-align:center"></th>
										</tr>
									</thead>
									<tbody>
									@foreach($data['ShowBankinstruments'] as $bank_instrument)
										<tr>
											<td align="center">{{ $loop->iteration }}</td>
											<td align="left">{{ $bank_instrument->bank_inst_name }}</td>
											<td align="left">{{ $bank_instrument->inst_code }}</td>
											@if($bank_instrument->active == 1)
												<td align="left" style="width:100px">Active</td>
											@else
												<td align="left" style="width:100px">Deleted</td>
											@endif
											@if($bank_instrument->active == 1)
												<td align="center" style="width:100px">
													<button type="button" name="btn_edit" id="btn_edit" class="btn btn-default teditbtn estEdit" onclick="edit('{{ route('admin.bankinstrument', ['id' => encrypt($bank_instrument->bank_inst_id)]) }}')" title="Click here to Edit" style="cursor: pointer;"><i class="fa fa-edit pt2"></i></button>
												</td>
											@else
												<td align="center" style="width:100px">
													<button type="button" disabled name="btn_edit" id="btn_edit" class="btn btn-default estEdit" style="cursor: pointer;"><i class="fa fa-edit pt2"></i></button>
												</td>
											@endif
											<td align="center" style="width:100px">
												@if($bank_instrument->active == 1)
													<button type="button" name = "btn_delete" id = "btn_delete" class="btn btn-default tdelbtn Delete" title="Click here to delete"  data-id = "({{ encrypt($bank_instrument->bank_inst_id) }})" style="cursor: pointer;"><i class="fa fa-trash-o pt2"></i></button>												
												@else
													<button type="button" disabled name = "btn_delete" id = "btn_delete" class="btn btn-default Delete" style="cursor: pointer;"><i class="fa fa-trash-o pt2"></i></button>											
												@endif
											</td>
											<td align="center" style="width:100px">
												@if($bank_instrument->active == 0)
													<button type="button" name = "btn_undo_delete" id = "btn_undo_delete" class="btn btn-default tdelbtn  UndoDelete" title="Click here to activate" data-id = "({{ encrypt($bank_instrument->bank_inst_id) }})" style="cursor: pointer;"><i class="fa fa-recycle"></i></button>												
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
						@php $AddUrl = 'admin.bankinstrument'; @endphp 
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
					var title = $(cell).text(); //  here we have to write based on colindex for display search & Hide colummn text
					if((colIdx == 1)){
						$(cell).html('<input type="text" placeholder="' + title + '" />');
					}else{
						$(cell).html('');
					}
					if((colIdx == 4)){
					$(cell).html('Edit');
					}
					if((colIdx == 5)){
						$(cell).html('Delete');
					}
					if((colIdx == 6)){
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
				message: 'Are you sure you want to Delete the Bank Instrument?',
				closable: false, 
				draggable: false, 
				btnCancelLabel: 'Cancel', 
				btnOKLabel: 'Ok', 
				callback: function(result) {
					if(result){
						$.ajax({ 
							type: 'POST', 
							url: "{{ route('ajax.DeleteBankInstrument') }}", 
							data: {'_token': '{{ csrf_token() }}','Id': Id }, 
							success: function (data){ 
								if(data != null){
									var message = "Bank Instrument Deleted Successfully";
								}else{
									var message = "Bank Instrument is not deleted. Please try again";
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
			var Type = 'BankInstrument';
			BootstrapDialog.confirm({
				title: 'Confirmation Message',
				message: 'Are you sure you want to Activate the Bank Instrument?',
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
									var message = "Bank Instrument Activated Successfully";
								}else{
									var message = "Bank Instrument is not activated. Please try again";
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

