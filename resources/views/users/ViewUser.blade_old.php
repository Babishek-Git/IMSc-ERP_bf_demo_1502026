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
					<div class="div2 "></div>
					<div class="div8 mbtable" align="center">
						<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> User List - View </div></div></div>
						<div class="row innerdiv">
							<div class="row">
								<table class="table-bordered table1" width="99%" align="center" id="dataTable">
									<thead>
										<tr class="note heading">
											<th class="colhead" style="text-align:center">SNo.</th>
											<th class="colhead" style="text-align:center">User Name</th>
											<th class="colhead" style="text-align:center">Employee Name</th>
											<th class="colhead" style="text-align:center">Email ID</th>
											<th class="colhead" style="text-align:center">Status</th>
											<th class="colhead" style="text-align:center">Delete</th>
										</tr>
									</thead>
									<tbody>
									@foreach($data['UserData'] as $user)
										<tr>
											<td align="center" style="width:100px">{{ $loop->iteration }}</td>
											<td align="left">{{ $user->username }}</td>
											<td align="left">
												{{ $user->emp_first_name }}
												@if($user->emp_middle_name)
													{{ ' ' . $user->emp_middle_name }}
												@endif
												{{ ' ' . $user->emp_last_name }}
											</td>		
											<td align="left">{{ $user->emp_off_email }}</td>	
											@if($user->usactive == 1)
												<td align="center" style="width:50px">Active</td>
											@else
												<td align="center" style="width:50px">Deleted</td>
											@endif								
											<td align="center" style="width:150px">
												<button type="button" name = "btn_delete" id = "btn_delete" class="btn btn-default tdelbtn Delete" title="Click here to delete"  data-id = "({{ encrypt($user->id) }})" style="cursor: pointer;"><i class="fa fa-trash-o pt2"></i></button>												
											</td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="div2"></div>
					</div>
						@php $AddUrl = 'user.UserCreation'; @endphp 
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
	});

	
	$("body").on("click",".Delete", function(event){
		var Id = $(this).attr("data-id");
		BootstrapDialog.confirm({
			title: 'Confirmation Message',
			message: 'Are you sure you want to Delete the User Details?',
			closable: false, 
			draggable: false, 
			btnCancelLabel: 'Cancel', 
			btnOKLabel: 'Ok', 
			callback: function(result) {
				if(result){
					$.ajax({ 
						type: 'POST', 
						url: "{{ route('ajax.Deleteuser') }}", 
						data: { "_token": "{{ csrf_token() }}", 'Id': Id }, 
						success: function (data){ 
							if(data != null){
								var message = "User Deleted Successfully";
							}else{
								var message = "User is not deleted. Please try again";
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
</script>

@endsection	

