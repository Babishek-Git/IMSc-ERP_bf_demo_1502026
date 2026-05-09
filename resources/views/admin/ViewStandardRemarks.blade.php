@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php 
if(isset($data['StRemarkData'])){	
	$StRemarkData = $data['StRemarkData']; 
}
$ModuleOptions = [
    'DEU'    => 'Tender Estimate',
    'TS'     => 'Technical Sanction',
    'RTS'    => 'Revised Technical Sanction',
    'NIT'    => 'Notice Inviting Tender',
    'CST'    => 'Comparative Statement',
    'NCST'   => 'Negotiate Comparative Statement',
    'LOI'    => 'LOA',
    'PGU'    => 'Performance Guarantee (User)',
    'WO'     => 'Work Order',
    'RABUC'  => 'BILL FORWARD TO CHECK & APPROVE',
    'BILLV'  => 'Bill Verification',
    'GSTRU'  => 'GST Reimbursement (User)',
    'GSTRA'  => 'GST Reimbursement (Accounts)',
];
@endphp
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
						<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> View Standard Remarks </div></div></div>
						<div class="row innerdiv">
							<div class="row">
								<table class="table-bordered table1 dataTable" id="dataTable">
									<thead>
										<tr class="note heading">
											<th class="colhead" style="text-align:center">Sno.</th>
											<th class="colhead" style="text-align:center">Remarks</th>
											<th class="colhead" style="text-align:center">Module</th>
											<th class="colhead" style="text-align:center"></th>
											<th class="colhead" style="text-align:center">Action</th>
											<th class="colhead" style="text-align:center"></th>
										</tr>
									</thead>
									<tbody>
										@php $Sno = 1; @endphp
										@foreach($StRemarkData as $Data)
										@if((session('WcmsRoleGroupCode') == 'ADMUSER' && $Data->office_id == session('WcmsEmpDiv')) || (session('WcmsRoleGroupCode') == 'ACCADMUSER' && $Data->office_id == session('WcmsEmpDiv')) || (session('WcmsRoleGroupCode') == 'SUPUSER'))
										<tr>
											<td>{{ $Sno++ }}</td>
											<td class="remarkcont">{{ $Data->remark }}</td>
											<td class="remarkcont">{{ $ModuleOptions[$Data->module_code] }}</td>
											@if($Data->active == 1)
												<td align="center" style="width:100px">
													<button type="button" name="btn_edit" id="btn_edit" class="btn btn-default teditbtn RemEdit"  title="Click here to Edit" style="cursor: pointer;" onclick="window.location='{{ route('admin.StandardRemarkEntry', ['id' => encrypt($Data->stremid),'Type' => 'EDIT']) }}'"><i class="fa fa-edit pt2"></i></button>
												</td>
											@else
												<td align="center" style="width:100px">
													<button type="button" disabled name="btn_edit" id="btn_edit" class="btn btn-default  RemEdit" style="cursor: pointer;"><i class="fa fa-edit pt2"></i></button>
												</td>
											@endif
											<td align="center" style="width:100px">
												@if($Data->active == 1)
													<button type="button" name = "btn_delete" id = "btn_delete" class="btn btn-default tdelbtn Delete" title="Click here to delete" style="cursor: pointer;" onclick="window.location='{{ route('admin.ViewStandardRemarks', ['id' => encrypt($Data->stremid),'Type' => 'DEL']) }}'"><i class="fa fa-trash-o pt2"></i></button>												
													@else
													<button type="button" disabled name = "btn_delete" id = "btn_delete" class="btn btn-default  Delete" style="cursor: pointer;"><i class="fa fa-trash-o pt2"></i></button>											
												@endif
											</td>
											<td align="center" style="width:100px">
												@if($Data->active == 0)
													<button type="button" name = "btn_undo_delete" id = "btn_undo_delete" class="btn btn-default tdelbtn  UndoDelete" title="Click here to activate" style="cursor: pointer;" onclick="window.location='{{ route('admin.ViewStandardRemarks', ['id' => encrypt($Data->stremid),'Type' => 'ACT']) }}'"><i class="fa fa-recycle"></i></button>												
												@else
													<button type="button" disabled name = "btn_undo_delete" id = "btn_undo_delete" class="btn btn-default UndoDelete" style="cursor: pointer;"><i class="fa fa-recycle"></i></button>
												@endif
											</td>
										</tr>
										@endif
										@endforeach
									</tbody>
								</table>	
							</div>
							@php $AddUrl = 'admin.StandardRemarkEntry'; @endphp 
							<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
								<div class="buttonsection">
									<input type="button" name="back" value="Back" class="backbutton" onClick="window.location='{{route($AddUrl)}}'" >
								</div>								
								<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
								</div>
							</div>
						</div>
					</div>
					<div class="div1 "></div>
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
					if((colIdx == 3)){
							$(cell).html('Edit');
					}
					if((colIdx == 4)){
						$(cell).html('Delete');
					}
					if((colIdx == 5)){
						$(cell).html('Activate');
					}
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
		
    });    
</script>    
@endsection	

