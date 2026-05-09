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
						<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> Bank Branch List - View </div></div></div>
						<div class="row innerdiv">
							<div class="row">
								<table class="table-bordered table1" width="99%" align="center" id="dataTable">
									<thead>
										<tr class="note heading">
											<th style="text-align:center">SNo.</th>
											<th style="text-align:center">Bank Name</th>
											<th style="text-align:center">IFSC Code</th>
											<th style="text-align:center">Branch Address</th>
											<th style="text-align:center">City</th>
											<th style="text-align:center">State</th>
											<th style="text-align:center">Status</th>
											<th colspan = "2"  style="text-align:center">Action</th>
										</tr>
									</thead>
									<tbody>
									@foreach($data['BankList'] as $bank)
										<tr>
											<td align="center">{{ $loop->iteration }}</td>
											<td align="center">{{ $bank->bank_name }}</td>
											<td align="center">{{ $bank->ifsc_code }}</td>
											<td align="center">{{ $bank->branch_addr1 }}</td>
											<td align="center">{{ $bank->branch_city }}</td>
											<td align="center">{{ $bank->state_name }}</td>
											@if($bank->active == 1)
												<td align="center">Active</td>
											@else
												<td align="center">Deleted</td>
											@endif
											<td align="center"><a href="{{ route('admin.bankbranch', ['id' => encrypt($bank->branch_id)]) }}" name = "btn_edit" id = "btn_edit">edit</a></td>
											<td align="center"><button  name = "btn_delete" id = "btn_delete" class = "Delete" data-id = "({{ encrypt($bank->branch_id) }})">Delete</button></td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>


					<div class="div1 "></div>
					</div>
						@php $AddUrl = 'admin.bankbranch'; @endphp 
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
				url: "{{ route('ajax.DeleteBankBranch') }}", 
				data: {'_token': '{{ csrf_token() }}', 'Id': Id }, 
				success: function (data){ 
					if(data != null){
						BootstrapDialog.alert("Success: Bank Branch Deleted!");
					}
				}
			});
		});
	
    });

	
</script>

@endsection	

