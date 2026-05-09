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
						<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> Work Standard Values - View </div></div></div>
						<div class="row innerdiv">
							<div class="row">
								<table class="table-bordered table1" width="99%" align="center" id="dataTable">
									<thead>
										<tr class="note heading">
											<th class="colhead" style="text-align:center">SNo.</th>
											<th class="colhead" style="text-align:center">Default Value Description</th>
											<th class="colhead" style="text-align:center">Default Value Code</th>
											<th class="colhead" style="text-align:center">Start Range</th>
											<th class="colhead" style="text-align:center">End Range</th>
											<th class="colhead" style="text-align:center">Default Value Mode</th>
											<th class="colhead" style="text-align:center">Percent/Amount/Days</th>
											<th class="colhead" style="text-align:center"></th>
											<th class="colhead" style="text-align:center">Action</th>
											<th class="colhead" style="text-align:center"></th>
										</tr>
									</thead>
									<tbody>
									@foreach($data['WdValData'] as $WdValData)
										<tr>
											<td align="center">{{ $loop->iteration }}</td>
											<td align="center">{{ $WdValData->wd_val_desc }}</td>
											<td align="center">{{ $WdValData->wd_val_code }}</td>
											<td align="left">{{ $WdValData->wd_val_start_range }}</td>
											<td align="left">{{ $WdValData->wd_val_end_range }}</td>
											@if($WdValData->wd_val_mode == "PERC")
                                                <td>Percentage</td>
                                            @elseif($WdValData->wd_val_mode == "AMT")
                                                <td>Amount</td>
											@elseif($WdValData->wd_val_mode == "DAYS")
											<td>Days</td>
											@elseif($WdValData->wd_val_mode == "MON")
											<td>Months</td>
											@elseif($WdValData->wd_val_mode == "YEAR")
											<td>Year</td>
                                            @endif
											<td align="left">{{ $WdValData->wd_val }}</td>
											@if($WdValData->active == 1)
												<td align="center" style="width:100px">
													<button type="button" name="btn_edit" id="btn_edit" class="btn btn-default teditbtn estEdit" onclick="edit('{{ route('admin.WorkStandardValues', ['id' => encrypt($WdValData->wdvalid)]) }}')" title="Click here to Edit" style="cursor: pointer;"><i class="fa fa-edit pt2"></i></button>
												</td>

											@else
												<td align="center" style="width:100px">
													<button type="button" disabled name="btn_edit" id="btn_edit" class="btn btn-default  estEdit" style="cursor: pointer;"><i class="fa fa-edit pt2"></i></button>
												</td>

											@endif
											<td align="center" style="width:100px">
												@if($WdValData->active == 1)
													<button type="button" name = "btn_delete" id = "btn_delete" class="btn btn-default tdelbtn Delete" title="Click here to delete" data-id =" {{ encrypt($WdValData->wdvalid) }} " style="cursor: pointer;"><i class="fa fa-trash-o pt2"></i></button>												
												@else
													<button type="button" disabled name = "btn_delete" id = "btn_delete" class="btn btn-default  Delete" style="cursor: pointer;"><i class="fa fa-trash-o pt2"></i></button>											
												@endif
											</td>
											<td align="center" style="width:100px">
												@if($WdValData->active == 0)
													<button type="button" name = "btn_undo_delete" id = "btn_undo_delete" class="btn btn-default tdelbtn  UndoDelete" title="Click here to activate" data-id = "({{ encrypt($WdValData->wdvalid) }})" style="cursor: pointer;"><i class="fa fa-recycle"></i></button>												
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
						@php $AddUrl = 'admin.WorkStandardValues'; @endphp 
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

				// For each column
				api
				.columns()
				.eq(0)
				.each(function (colIdx) {
					// Set the header cell to contain the input element
					var cell = $('.filters th').eq(
						$(api.column(colIdx).header()).index()
					);
					var title = $(cell).text(); //  here we have to write based on colindex for display search & Hide colummn text
					if((colIdx == 1)||(colIdx == 2)||(colIdx == 3)||(colIdx == 4)||(colIdx == 5)){
						$(cell).html('<input type="text" placeholder="' + title + '" />');
					}else{
						$(cell).html('');
					}
					if((colIdx == 7)){
						$(cell).html('Edit');
					}
					if((colIdx == 8)){
						$(cell).html('Delete');
					}
					if((colIdx == 9)){
						$(cell).html('Activate');
					}

					// On every keypress in this input
					$(
						'input',
						$('.filters th').eq($(api.column(colIdx).header()).index())
					)
					.off('keyup change')
					.on('change', function (e) {
						// Get the search value
						$(this).attr('title', $(this).val());
						var regexr = '({search})'; //$(this).parents('th').find('select').val();

						var cursorPosition = this.selectionStart;
						// Search the column for that value
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
				message: 'Are you sure you want to Delete the Work Standard Values?',
				closable: false, 
				draggable: false, 
				btnCancelLabel: 'Cancel', 
				btnOKLabel: 'Ok', 
				callback: function(result) {
					if(result){
						$.ajax({ 
							type: 'POST', 
							url: "{{ route('ajax.DeleteWorkDefaultValues') }}", 
							data: { '_token': '{{ csrf_token() }}', 'Id': Id },
							success: function (data){ 
								if(data != null){
									var message = "Work Standard Values Deleted Successfully";
								}else{
									var message = "Work Standard Values is not deleted. Please try again";
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
			var Type = 'WorkStandardValue';
			BootstrapDialog.confirm({
				title: 'Confirmation Message',
				message: 'Are you sure you want to Activate the Work Standard Values?',
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
									var message = "Work Standard Values Activated Successfully";
								}else{
									var message = "Work Standard Values is not activated. Please try again";
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

