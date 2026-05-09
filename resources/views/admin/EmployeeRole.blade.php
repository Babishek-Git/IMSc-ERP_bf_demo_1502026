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
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Employee List</div></div></div>
								<div class="card-body padding-1 ChartCard" id="CourseChart">
								<div class="row clearrow"></div>
									<div class="label" style="font-size:19px; color:#025fa4" align="center">( @php if(isset($EmpRole) != NULL){ echo $EmpRole; } @endphp )</div>
									<div class="divrowbox innerdiv pt-2">
										<table class="table-bordered table1" align="center" id="dataTable">
											<thead>
												<tr>
													<th class="colhead">Employee No.</th>
													<th class="colhead">Employee Name</th>
													<th class="colhead">Role</th>
												</tr>
											</thead>
											<tbody>
											@php
											$Index = 0;
											$loop = 1;
											if(isset($data['StaffData'])){
												if(isset($data['RoleMapCollect'])){
													if($EmpRole != NULL){
														foreach($data['RoleMapCollect'] as $Key=>$datas){
															foreach($data['StaffData'] as $List=>$value){		
																if($datas->role_name == $EmpRole){
																	if($datas->employee_no == $value->emp_no){
																		if($datas->active == 1){
																			echo '<tr>';
																			echo '<td align="center">'.$value->emp_no.'</td>';	
																			echo '<td align="left">'.$value->emp_known_as.'</td>';
																			if(($datas->group != NULL) && ($datas->division == NULL) && ($datas->section == NULL) && ($datas->subsection == NULL)){
																				echo '<td align="left">'.$datas->group.'</td>';
																			}
																			elseif(($datas->group != NULL) && ($datas->division != NULL) && ($datas->section == NULL) && ($datas->subsection == NULL)){
																				echo '<td align="left">'.$datas->group.'&nbsp;/&nbsp;'.$datas->division.'</td>';
																			}
																			elseif(($datas->group != NULL) && ($datas->division != NULL) && ($datas->section != NULL) && ($datas->subsection == NULL)){
																				echo '<td align="left">'.$datas->group.'&nbsp;/&nbsp;'.$datas->division.'&nbsp;/&nbsp;'.$datas->section.'</td>';
																			}
																			else{
																				echo '<td align="left">'.$datas->group.'&nbsp;/&nbsp;'.$datas->division.'&nbsp;/&nbsp;'.$datas->section.'&nbsp;/&nbsp;'.$datas->subsection.'</td>';
																			}
																			echo '</tr>';
																		}
																	}
																	$loop++;
																}	
															}
															$Index++;
														}
													}
												}
											}
											@endphp
											</tbody>
										</table>
										@php $AddUrl = 'admin.CheckEmpRole'; @endphp	
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
					if((colIdx == 0)||(colIdx == 1)||(colIdx == 2)){
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
			
