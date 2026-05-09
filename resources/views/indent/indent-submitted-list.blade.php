@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php 
$EmpDataArr = [];
if(isset($data['Empdata'])){
	$EmpData = $data['Empdata'];
	foreach($EmpData as $Empvalue){
		$EmpDataArr[$Empvalue->emp_no] = $Empvalue->emp_first_name;
	}
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
							<div class="div12 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> Indent Submitted List - View </div></div></div>
								<div class="row innerdiv">
									<div class="row">
										<table class="table-bordered dataTable no-footer" align="center" id="dataTable">
											<thead>
												<tr>
													<th class="colhead" nowrap="nowrap">SNo.</th>
													<th class="colhead">Indent No.</th>
													<th class="colhead">Indent Description</th>													
													<th class="colhead">Indent Created By</th>
													<th class="colhead">Indent Date</th>
													<th class="colhead">Action</th>
												</tr>
											</thead>
										<tbody>
											@if(isset($data['ShowIndentSubmittedData']))
												@php
													$EmpCreateIndents = collect($data['ShowIndentSubmittedData'])->where('emp_no', session('WcmsEmpNo'));
												@endphp
												@if(count($EmpCreateIndents) > 0)
													@php $Snumber = 1; @endphp
													@foreach($EmpCreateIndents as $Indetdata)
														<tr>
															<td align="center">{{ $Snumber }}</td>
															<td align="left">{{ $Indetdata->indent_no ?? '' }}</td>
															<td align="left">{{ $Indetdata->indent_descripton ?? '' }}</td>
															<td align="left">{{ $EmpDataArr[$Indetdata->emp_no ?? ''] }}</td>
															<td align="left">{{ isset($Indetdata->indent_date) ? Helper::DisplayDateFormat($Indetdata->indent_date) : '' }}</td>
															<td align="center">
																<button type="button"onclick="window.location='{{ route('indent.indent-creation', ['page'=>encrypt('VIEW'),'EditId'=>encrypt($Indetdata->indent_id)])}}'"class="btn btn-default tuploadbtn"title="Click here to View"><i class="fa fa-tv"></i> View</button>
															</td>
														</tr>
														@php $Snumber++; @endphp
													@endforeach
												@else
													<tr>
														<td colspan="6" align="center">No Indents found.</td>
													</tr>
												@endif
											@endif
										</tbody>
										</table>
									</div>
								</div>
					     	</div> 
							<div class="div12">&nbsp;</div> 
						</div>
					</div>
				</blockquote>
			</div>
		</div>
	</div>
</form>
<style>
	.blink {
		animation: blinker 1.5s linear infinite;
	}
	.blinkslow {
		animation: blinker 1.5s linear infinite;
	}
	@keyframes blinker {
		50% {
			opacity: 0;
		}
	}
</style>
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
					var title = $(cell).text(); 
					if((colIdx == 1)||(colIdx == 2)||(colIdx == 3)||(colIdx == 4)){
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
