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
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Employees</div></div></div>
								<div class="card-body padding-1 ChartCard" id="CourseChart">
									<div class="divrowbox innerdiv pt-2">
										<table class="table-bordered table1" align="center" id="dataTable">
											<thead>
												<tr>
													<th class="colhead">SNo.</th>
													<th class="colhead">Employee No.</th>
													<th class="colhead">Employee Name</th>
													<th class="colhead">Designation</th>
													<th class="colhead">Group</th>
													<th class="colhead">Division</th>
													<th class="colhead">Section</th>
													<th class="colhead">Sub-Section</th>
													<th class="colhead">Role</th>
												</tr>
											</thead>
											<tbody>
											@if(isset($data['StaffData']))
												@foreach($data['StaffData'] as $StaffList)
													<tr>
														<td align="center">{{ $loop->iteration }}</td>
														<td align="center">{{ $StaffList->emp_no }}</td>
														<td align="left">{{ $StaffList->emp_known_as }}</td>
														<td align="left">{{ $StaffList->designation_name }}</td>
														<td align="center">{{ $StaffList->group }}</td>
														<td align="center">{{ $StaffList->division }}</td>
														<td align="center">{{ $StaffList->section }}</td>
														<td align="center">{{ $StaffList->subsection }}</td>
														<td align="left">
															@php
																if(isset($RoleMapData)){
																	if(isset($RoleMapData[$StaffList->emp_no])){
																		if(count($RoleMapData[$StaffList->emp_no]) > 0){
																			foreach($RoleMapData[$StaffList->emp_no] as $RoleMapRow){
																				if($RoleMapRow == end($RoleMapData[$StaffList->emp_no])){
																					$StyleStr = "";
																				}else{
																					$StyleStr = "border-bottom:1px solid #ddd;";
																				}
																				echo '<div style="'.$StyleStr.'">'.$RoleMapRow->role_name.' <br/><div style="color:#565B5F">('.$RoleMapRow->group.'/'.$RoleMapRow->division.'/'.$RoleMapRow->section.'/'.$RoleMapRow->subsection.')</div></div>';
																			}
																		}
																	}
																}
															@endphp
														</td>
													</tr>
												@endforeach
											@endif
											</tbody>
										</table>
										@php $AddUrl = 'admin.createstaff'; @endphp	
										<div class="row" align="center">
											<!-- <div class="buttonsection"><input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/></div> -->
											<!-- <div class="buttonsection"><input type="button" class="backbutton"  name="AddNew" id="AddNew" value="AddNew" onClick="window.location='{{ route($AddUrl) }}'"/></div> -->
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
					if((colIdx == 1)||(colIdx == 2)||(colIdx == 3)||(colIdx == 4)||(colIdx == 5)||(colIdx == 6)||(colIdx == 7)){
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
<style>
	.colhead > input[type="text"] {
		width:80px;
	}
</style>
@endsection	
			
