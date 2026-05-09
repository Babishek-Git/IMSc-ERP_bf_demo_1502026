@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<form action="" method="post" enctype="multipart/form-data" name="form">
<!--==============================Content=================================-->
	<div class="content">
		<div class="title">Contractor Details</div>
		<div class="container_12">
			<div class="grid_12">
				<div align="right"></div>
				<blockquote class="bq1" style="overflow:auto">
					<div class="container" align="center">
					</br>
					  <div class="div1 "></div>
						 <div class="div10 mbtable">
								<table class="table-bordered table1" align="center" id="dataTable">
									<thead>
									<tr class="note" style="background-color:#E5E5E5;">
										<th colspan="10" style="text-align:center">Bidder's / Contractor's Details - View </th>
                                      </tr>
									  <tr class="note heading">
										  <th rowspan=2 style="text-align:center">SNo.</th> 
										  <th rowspan=2 style="text-align:center">ContractorName</th>
										  <th  rowspan=2 style="text-align:center">ContractorAddress</th>
										  <th rowspan=2  style="text-align:center">GST No.</th>
										  <th rowspan=2 style="text-align:center">PAN No.</th>
										  <th colspan=5 style="text-align:center">Bank Details</th>
                                       </tr>
									   <tr class="note heading">
									      <th style="text-align:center">BankName</th>
										  <th style="text-align:center">Acc.No.</th>
										  <th style="text-align:center">BranchName</th>
										  <th style="text-align:center">IfscCode</th>
										  <th style="text-align:center">Action</th>
										</tr>
									 </thead>
								 <tbody>
											<!-- this is for alignment-rowspan -->
										@php 
										$BidderCountArr = array_count_values(array_column($data, 'contid')); 
										if(isset($data)){
											$x = 0; $y = 0; $Sno = 1;
											foreach($data as $ContractorList){
												$ContId = $ContractorList->contid;
												$Rowspan = $BidderCountArr[$ContId];
										@endphp
												<tr>
													@php if($x == 0){ @endphp
													<td align="center" rowspan="{{ $Rowspan }}">{{ $Sno }}</td>
													<td align="left" rowspan="{{ $Rowspan }}">{{ $ContractorList->name_contractor }}</td>
													<td align="left" rowspan="{{ $Rowspan }}">{{ $ContractorList->addr_contractor }}</td>
													<td align="left" rowspan="{{ $Rowspan }}">{{ $ContractorList->gst_no }}</td>
													<td align="left" rowspan="{{ $Rowspan }}">{{ $ContractorList->pan_no }}</td>
													@php $Sno++;} @endphp 
													<td align="left">{{ $ContractorList->bank_name }}</td>
													<td align="left">{{ $ContractorList->acc_no }}</td>
													<td align="left">{{ $ContractorList->branch_name}}</td>
													<td align="left">{{ $ContractorList->ifsc_code }}</td>
													@php 
													if($x == 0){
													@endphp													
													<td align="center"  rowspan="{{ $Rowspan }}">
													&nbsp;&nbsp;&nbsp;<a href="{{ route('admin.updatebidderentry', ['id'=>encrypt($ContractorList->contid)]) }}" class="oval-btn-edit">
															<i style="font-size:12px; padding-top:5px;" class="fa">&#xf044;</i> Edit	
														</a>
														&nbsp;&nbsp;&nbsp;
														<!-- <a href="javascript:Delete()" class="oval-btn-delete">
															<i style="font-size:12px; padding-top:5px; font-weight:100" class="fa">&#xf00d;</i> Delete
														</a> -->
													</td>  
													@php } @endphp	
												</tr>
										@php
											 $x++; $y++; if($y == $Rowspan){ $x = 0; $y = 0; }
											}	
										}
										@endphp
										</tbody>
										<tr>
									     <td></td>	
								      </tr>
									</table>
								  </div>
					              <div class="div1 "></div>
				                </div>
									<input type="hidden" name="hid_delete_flag" id="hid_delete_flag">
									@php $AddUrl = 'admin.bidderscreation'; @endphp	
									<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
										<div class="buttonsection"><input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/></div>
										<div class="buttonsection"><input type="button" class="backbutton"  name="AddNew" id="AddNew" value="AddNew" onClick="window.location='{{ route($AddUrl) }}'"/></div>
										<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
									</div>
								</div>
							</blockquote>
						</div>
					</div>
				</div>
<script>
	$(document).ready(function() {
		$('#dataTable').DataTable({
			responsive: true,
			paging: true, 
		});
	});
</script>
@endsection	
			
