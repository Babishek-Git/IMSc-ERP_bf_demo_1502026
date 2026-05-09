@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php 
	if(isset($data['Works'])){
		$Works = $data['Works']; 
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
							<div class="div1"></div>
							<div class="div10 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> Work/Tender Cancel </div></div></div>
								<div class="divrowbox innerdiv pad-0-top">
									<div class="formbox">
										<div class="row">
											<table class="table-bordered table1" width="99%" align="center" id="dataTable">
												<thead>
													<tr class="note heading">
														<th class="colhead" style="text-align:center"> SNo. </th>
														<th class="colhead" style="text-align:center"> Work Name </th>
														<th class="colhead" style="text-align:center"> Ref No. </th>
														<th class="colhead" style="width:150px;"> Work Stage </th>
														<!-- <th style="text-align:center"> Signed T.S. Copy Status </th> -->
														<th class="colhead" style="text-align:center" style="width:150px;"> Action </th>
													</tr>
												</thead>
												<tbody>
													@if(isset($Works))
														@foreach($Works as $Work) 
															<tr>
																<td align="center">{{ $loop->iteration }} </td>
																<td align="left">{{ $Work->work_name }}</td>
																<td align="left">{{ $Work->ref_no }}</td>
																<td align="center">{{ Helper::GetWorkStage($Work->work_stage) }}</td>																	
																<!-- <td align="left"></td> -->
																<td align="center" nowrap style="width:150px;"> 
																	<!-- <a href="{{ route('Ts.TechnicalSanction',['id'=>encrypt($Work->ts_id)] )}}" class="oval-btn-edit">
																		<i style="font-size:12px; padding-top:5px;" class="fa">&#xf044;</i> Edit 
																	</a>&nbsp;
																	<a href="{{ route('Ts.ViewTechnicalSanction',['delid'=>encrypt($Work->ts_id )] )}}" class="oval-btn-delete">
																		<i style="font-size:12px; padding-top:5px;" class="fa">&#xf044;</i> Delete 
																	</a>&nbsp;
																	<a href="{{ route('Ts.ViewTechnicalSanction',['delid'=>encrypt($Work->ts_id )] )}}" class="oval-btn-delete">
																		<i style="font-size:12px; padding-top:5px;" class="fa">&#xf044;</i> View & Submit 
																	</a> -->
																	@php 
																	//dump($Work->globid);
																	@endphp
																	<button type="button" onclick="window.location='{{ route('admin.WorkTenderCancel',['id'=>encrypt($Work->globid)] )}}'" class="btn btn-default tviewbtn" style="cursor: pointer;">Cancel Work</button>
																</td>
															</tr>
														@endforeach
													@endif
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="div1"></div>
						</div>
						@php $AddUrl = 'Ts.TechnicalSanction'; @endphp 
						<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
							<!-- <div class="buttonsection">
								<input type="button" name="back" value="Back" class="backbutton" onClick="window.location='{{route($AddUrl)}}'" >
							</div> -->
							
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
		$("body").on("click",".formtab", function(event){ 
			let id = $(this).attr("data-id");
			$(".formtab-panel").addClass("hide");
			$("#formtab-panel"+id).removeClass("hide");
			$(".formtab").removeClass("tab-active");
			$(this).addClass("tab-active");
			$(".ftc").removeClass("formtab-check");
			$(".ftc").addClass("formtab-uncheck");
			$("#formtab"+id+" > div > i").removeClass("formtab-uncheck");
			$("#formtab"+id+" > div > i").addClass("formtab-check");
			$('.chosen-container').css('width','100%');
		});
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

