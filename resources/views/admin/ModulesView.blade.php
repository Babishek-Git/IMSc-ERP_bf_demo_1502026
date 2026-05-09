@extends('layouts.dashboard-master')
@section('content')
@include('layouts.partials.messages')
@php 
if(isset($data['ModulesView'])){
	$ModulesView = $data['ModulesView'];
}
if(isset($data['RowspanArr'])){
	$RowspanArr = $data['RowspanArr'];
}
if((isset($data['ParentArr'])) && (count($data['ParentArr']) > 0)){
	$ParentArr = $data['ParentArr'];
}
@endphp

	<form action="" method="post" enctype="multipart/form-data" name="form" id="form1">
        <!--==============================header=================================-->
        <!--==============================Content=================================-->
        <div class="content">
			<div class="title"></div>
            <div class="container_12">
                <div class="grid_12">
						<blockquote class="bq1" style="overflow:auto">
							<div class="row clearrow"></div>
							<div class="row plr">
							<div class="box-container box-container-lg">
								<div class="row smclearrow"></div>
								<div class="row">
									<div class="box-container box-container-lg lg-box" align="center">
										<div class="row mbtable">
											<div class="card cabox" style="margin-bottom:1px;">
												<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> Modules - View</div></div></div>
												<div class="face-static">
													<div class="card-body padding-1 ChartCard" id="CourseChart">
														<div class="divrowbox" style="padding-top:0px; padding-bottom:0px;">
															<div class="row">
																<div class="div12" align="center">
																	<div class="innerdiv2" style="padding-top:0px;">
																		<div class="row" align="center">
																			<table width="100%" align="center" class="dataTable table2excel mgtb-8" id="dataTable">
																				<thead>
																					<tr>
																						<th class="colhead" valign="middle">SNo.</th>
																						<!-- <th valign="middle">Parent Name</th> -->
																						<th class="colhead" valign="middle">Module Name</th>
																						<!-- <th valign="middle">Module Code</th> -->
																						<th class="colhead" valign="middle">Module URL</th>
																						<!-- <th valign="middle">Module Order</th> -->
																						<th class="colhead" style="text-align:center">Action</th>
																					</tr>
																				</thead>
																				<tbody>
																					@php
																						$SNO = 1;
																						if((isset($ModulesView)) && (count($ModulesView) > 0)){
																							foreach($ModulesView as $List){
																								$HoaNameDisp = array();
																								$ModuleName = $List->module_name;
																								$ModuleCode = $List->module_code;
																								$ParentID = $List->parentid;
																								$MenuURL = $List->menu_url;
																								$DpOrder = $List->dp_order;
																								@endphp
																								<tr class='labeldisplay'>
																									<td class='tdrowbold' valign='middle' align='center'>{{ $SNO }}</td>
																									<!-- <td class='tdrowbold' valign='middle' align='left'>//$ParentName </td> -->
																									<td class='tdrowbold' valign='middle' align='left'>{{ $ModuleName }}</td>
																									<!-- <td valign='middle' class='tdrow' align = 'left'>//$ModuleCode</td> -->
																									<td valign='middle' class='tdrow' align = 'left'>{{ $MenuURL }}</td>
																									<!-- <td valign='middle' class='tdrow' align = 'center'>//$DpOrder }}</td> -->
																									<td align="center" style="width:50px">
																										<button type="button" name="btn_edit" id="btn_edit" class="btn btn-default teditbtn estEdit" onclick="edit('{{ route('admin.Modules', ['id' => encrypt($List->moduleid)]) }}')" title="Click here to Edit" style="cursor: pointer;"><i class="fa fa-edit pt2"></i></button>
																									</td>
																								</tr>
																								@php
																								$SNO++; 
																							} 
																						}else{ 
																							@endphp
																							<tr class='labeldisplay'>
																								<td colspan='3' class='tdrowbold' valign='middle' align='center'> No Records Found </td>
																							</tr>
																							@php 
																						} 
																					@endphp 
																				</tbody>
																			</table>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
                    </blockquote>
                </div>
            </div>
        </div>
    </form>
    <!--==============================footer=================================-->
<script>
	function edit(url) {
		window.location.href = url;
	}

	$(document).ready(function(){ 
		// $('.dataTable').DataTable({"paging":false,"ordering": false});
		// $("#exportToExcel").click(function(e){ 
		// 	var table = $('body').find('.table2excel');
		// 	if(table.length){ 
		// 		$(table).table2excel({
		// 			exclude: ".noExl",
		// 			name: "Excel Document Name",
		// 			filename: "SingleLineAbstract-" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
		// 			fileext: ".xls",
		// 			exclude_img: true,
		// 			exclude_links: true,
		// 			exclude_inputs: true
		// 			//preserveColors: preserveColors
		// 		});
		// 	}
		// });
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
						if((colIdx == 1)){
							$(cell).html('<input type="text" placeholder="' + title + '" />');
						}else{
							$(cell).html('');
						}
						if((colIdx == 3)){
						$(cell).html('Edit');
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
		$('body').on("click","#btnDelete", function(event){ 
			var MopId = $(this).attr("data-id");
			BootstrapDialog.confirm({
				title: 'Confirmation Message',
				message: 'Are you sure want to Delete ?',
				closable: false, // <-- Default value is false
				draggable: false, // <-- Default value is false
				btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
				btnOKLabel: 'Ok', // <-- Default value is 'OK',
				callback: function(result) {
					// result will be true if button was click, while it will be false if users close the dialog directly.
					if(result){
						
						$.ajax({ 
							type: 'POST', 
							url: 'ajax/DeleteMop.php', 
							data: { Page: 'MISC', MopId: MopId }, 
							dataType: 'json',
							success: function (data) {  // alert(data['computer_code_no']);
								if(data != null){
									var Msg = data['msg'];
									BootstrapDialog.show({
										title: 'Alert Information',
										message: Msg,
										buttons: [{
											label: 'OK',
											cssClass: 'btn btn-info',
											action: function(dialog) {
												window.location.href = 'MopMiscList.php';
											}
										}]
									});
								}
							}
						});
					}
				}
			});
		});
		
	});
</script>
@endsection
