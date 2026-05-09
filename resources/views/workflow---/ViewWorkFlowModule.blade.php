@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<form action="" method="post" enctype="multipart/form-data" name="form">
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1" style="overflow:auto">
				<div class="container" align="center">
					<div class="div1 "></div>
					<div class="div10 mbtable" align="center">
						<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> Work Flow Module - View </div></div></div>
						<div class="row innerdiv">
							<div class="row">
								<table class="table-bordered table1" width="99%" align="center" id="dataTable">
									<thead>
										<tr class="note heading">
											<th class="colhead" style="text-align:center">SNo.</th>
											<th class="colhead" style="text-align:center">Work Flow Code</th>
											<th class="colhead" style="text-align:center">Work Flow Module Name</th>
											<!-- <th class="colhead" style="text-align:center">Division</th> -->
											<th class="colhead" style="text-align:center">Status</th>
											<th class="colhead" style="text-align:center">Action</th>
											<!-- <th class="colhead" style="text-align:center"></th> -->
										</tr>
									</thead>
									<tbody>
									@if(isset($data['ShowWorkFlow']))
										@foreach($data['ShowWorkFlow'] as $WorkFlow)
											<tr>
												<td align="center">{{ $loop->iteration }}</td>
												<td align="left">{{ $WorkFlow->wf_module_code }}</td>
												<td align="left">{{ $WorkFlow->wf_module_name }}</td>
												<!-- <td align="left">{{ $WorkFlow->office_name }}</td> -->
												@if($WorkFlow->wfmactive == 1)
													<td align="left" style="width:50px">Active</td>
												@else
													<td align="left" style="width:50px">Deleted</td>
												@endif
												<td align="center" style="width:50px">
													<button type="button" name="btn_edit" id="btn_edit" class="btn btn-default teditbtn estEdit" onclick="edit('{{ route('workflow.WorkFlow', ['id' => encrypt($WorkFlow->wf_moduleid)]) }}')" title="Click here to Edit" style="cursor: pointer;"><i class="fa fa-edit pt2"></i></button>
												</td>
												<!-- <td align="center" style="width:50px">
													<button type="button" name = "btn_delete" id = "btn_delete" class="btn btn-default tdelbtn Delete" title="Click here to delete" data-id = "{{ encrypt($WorkFlow->wf_moduleid) }}" style="cursor: pointer;"><i class="fa fa-trash-o pt2"></i></button>												
												</td> -->
											</tr>
										@endforeach
									@endif
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="div1 "></div>
					</div>
						@php $AddUrl = 'workflow.WorkFlow'; @endphp 
					<div clas="row" align="center">
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
					if((colIdx == 1)||(colIdx == 2)){
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
		var KillEvent = 0;
		$("body").on("click",".Delete", function(event){
			if(KillEvent == 0){
				var Id = $(this).attr("data-id");
				$.ajax({ 
					type: 'POST', 
					url: "{{ route('ajax.DeleteWorkFlow') }}", 
					data: {'_token': '{{ csrf_token() }}','Id': Id }, 
					success: function (data){ 
						if(data != null){
							event.preventDefault();
							BootstrapDialog.confirm({
								title: 'Confirmation Message',
								message: 'Success: Are you sure you want to Delete the Work Flow !',
								closable: false, 
								draggable: false, 
								btnCancelLabel: 'Cancel', 
								btnOKLabel: 'Ok', 
								callback: function(result) {
									if(result){
										KillEvent = 1;
										location.reload();
									}else {
										KillEvent = 0;
									}
								}
							});
						}
					}
				});
			}
		});
    });

	
</script>

@endsection	

