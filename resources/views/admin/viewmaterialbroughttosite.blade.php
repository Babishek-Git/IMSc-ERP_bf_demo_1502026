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
						<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> Material Brought to Site Details Entry - View </div></div></div>
						<div class="row innerdiv">
							<div class="row">
								<table class="table-bordered table1" width="99%" align="center" id="dataTable">
									<thead>
										<tr class="note heading">
											<th style="text-align:center">SNo.</th>
											<th style="text-align:center">Work Short Name</th>
											<th style="text-align:center">Work Order No</th>
											<th style="text-align:center">Material Type</th>
											<th style="text-align:center">Invoice Date</th>
											<th style="text-align:center">Quantity</th>
											<th style="text-align:center">Quantity Unit</th>
											<th style="text-align:center">Reference No</th>
											<th style="text-align:center">Status</th>
											<th colspan = "2"  style="text-align:center">Action</th>
										</tr>
									</thead>
									<tbody>
									@foreach($data['ShowMaterialBought'] as $materialBought)
										<tr>
											<td align="center">{{ $loop->iteration }}</td>
											<td align="center">{{ $materialBought->short_name }}</td>
											<td align="center">{{ $materialBought->work_order_no }}</td>
											<td align="center">{{ $materialBought->mat_type }}</td>
											<td align="center">{{ $materialBought->invoice_dt }}</td>
											<td align="center">{{ $materialBought->qty }}</td>
											<td align="center">{{ $materialBought->unit_name }}</td>
											<td align="center">{{ $materialBought->invoice_no }}</td>
											@if($materialBought->active == 1)
												<td align="center">Active</td>
											@else
												<td align="center">Deleted</td>
											@endif
											<td align="center"><a href="{{ route('admin.materialbroughttosite', ['id' => encrypt($materialBought->invoiceid)]) }}" name = "btn_edit" id = "btn_edit">edit</a></td>
											<td align="center"><button  name = "btn_delete" id = "btn_delete" class = "Delete" data-id = "({{ encrypt($materialBought->invoiceid) }})">Delete</button></td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>


					<div class="div1 "></div>
					</div>
						@php $AddUrl = 'admin.materialbroughttosite'; @endphp 
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

		/*$('#dataTable').DataTable({
			responsive: true,
			paging: true, 
		});*/
		$("body").on("click",".Delete", function(event){
			var Id = $(this).attr("data-id");
			$.ajax({ 
				type: 'POST', 
				url: "{{ route('ajax.DeleteMaterialBought') }}", 
				data: {'_token': '{{ csrf_token() }}', 'Id': Id }, 
				success: function (data){ 
					if(data != null){
						BootstrapDialog.alert("Success: Material Bought  Deleted!");
					}
				}
			});
		});
	
    });

	
</script>

@endsection	