@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
if(isset($data['AddressData']))
{
	$AddressData = $data['AddressData'];
	$AddressCount = Count($AddressData);
}
$Page = $data['Page'] ?? NULL;
@endphp
<style>

  
</style>
<form action="" method="post" enctype="multipart/form-data" name="form"> 
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<div align="right"></div>
				<blockquote class="bq1" style="overflow:auto">
					<div class="container" align="center">

					 	<div class="div12 no-margin">
							<div class="rm-toolbar">
								<span class="rm-with-selected-btn" id="rm-withSelectedBtn">Address Update Request List</span>
								<input type="number" id="rm-perPage" value="15" min="1" max="100">
								<select id="rm-filterStatus">
								<option value="all">All</option>
								<option value="active">Active</option>
								<option value="inactive">Inactive</option>
								</select>
								<input type="text" id="rm-searchInput" placeholder="🔍  Search…">
								<div class="rm-toolbar-right">
									@foreach($data['AddressData'] as $Address)
									<div class="rm-icon-btn" title="Print" onClick="window.location='{{ route('change-request.address.export-address-pdf',['id'=>encrypt($Address->emp_no)]) }}'">
									<i class="fa fa-print" style="font-size:15px; color:red; font-weight:600;"></i>
									</div>
									@endforeach
									<div class="rm-icon-btn" title="Export CSV" onclick="exportCSV()">
										 <i class="fa fa-file-excel-o" style="font-size:15px; color:#18D977; font-weight:600;"></i>
									</div>
									<div class="rm-icon-btn" title="Copy" onclick="copyTable()">
										 <i class="fa fa-clone" style="font-size:15px; color:blue;; font-weight:600;"></i>
									</div>
									@php $AddUrl = 'change-request.address-change-request'; @endphp 
									@php $BackUrl = 'change-request.address-change-request-list'; @endphp 
									@if($Page == 'REQ_APPLY')
									@if(isset($AddressData) && $AddressData->count() > 0)
										<button type="button" class="rm-new-emp-disable-btn readonly">+ New Request</button>
									@else
										<button type="button" class="rm-new-emp-btn" onClick="window.location='{{route($AddUrl)}}'">+ New Request</button>
									@endif
									@endif
								</div>
							</div>

							<div class="rm-table-wrap">
								<table id="rm-empTable">
									<thead>
										<tr>
										<th style="width:40px">#</th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">S.No. <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">IC No. <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Name <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Designation <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Particular <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
<!-- 										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">New Address <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
 -->										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Created By<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Action<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th style="width:80px; text-align:center;">Delete</th>
										<th style="width:80px; text-align:center;" class="rm-sortable" data-col="status"><div class="rm-th-inner">Status <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										</tr>
									</thead>
									<tbody id="rm-tableBody">
										@if(isset($data['AddressData']))
											@foreach($data['AddressData'] as $AddressData)
												@php
													$ExistingAddress = optional(json_decode($AddressData->old_value))->emp_address ?? '';
													$NewAddress      = optional(json_decode($AddressData->new_value))->emp_address ?? '';
												@endphp
												<tr data-name="{{ $AddressData->emp_no }}" data-status="{{ $AddressData->active == 1 ? 'active' : 'inactive' }}">
													<td></td>
													<td>{{ $loop->iteration }}</td>
													<td>{{ $AddressData->ic_no }}</td>
													<td>{{ $AddressData->emp_name_payslip }}</td>
													<td>{{ $AddressData->designation_name }}</td>
													<td>Address Update Request</td>
													<!-- <td>{{ $ExistingAddress }}</td>
													<td>{{ $NewAddress }}</td> -->
													<td>{{ $AddressData->created_by }}</td>
													<td align="center">
														@if($Page == 'REQ_APPLY')
														<button type="button" name="btn_edit" class="btn btn-default tuploadbtn" id="btn_edit" value="Edit" onclick="window.location='{{ route('change-request.address-change-request',['id'=>encrypt($AddressData->change_req_id),'Page'=>encrypt('REQ_APPLY')]) }}'"> <i class='fa fa-edit'></i> View & Edit</button>
														@endif
														<button type="button" name="btn_submit" class="xlbtndownload m-btm1" id="btn_submit" value="Submit" onclick="window.location='{{ route('change-request.address-change-request-process',['Page'=>encrypt($Page),'Application'=>encrypt($AddressData->change_req_id),'action'=>encrypt('REQ_PROCESS')]) }}'"> <i class='fa fa-check'></i> View & Submit</button>
													</td>
													<td align="center">
														@if($Page == 'REQ_APPLY')
														<button type="button" name="btn_delete" id="btn_delete" class="btn btn-default tdelbtn Delete" title="Click here to delete" style="cursor: pointer;"><i class="fa fa-trash-o pt2"></i></button>												
														@else
														<button type="button" name="btn_delete" id="btn_delete" class="btn btn-default tdelbtn" title="Click here to delete" style="cursor: pointer; color: grey;"><i class="fa fa-trash-o pt2"></i></button>												
														@endif

													</td>
													<td align="center"><label class="rm-toggle"><input type="checkbox" {{ $AddressData->active == 1 ? 'checked' : '' }}><span class="rm-slider"></span></label></td>
												</tr>
											@endforeach
										@endif
										
									</tbody>
								</table>
								<div class="rm-empty" id="rm-emptyMsg" style="display:none">No records found.</div>
							</div>
							<div class="rm-pagination">
								<span class="rm-info" id="rm-pageInfo"></span>
								<div class="rm-pages" id="rm-pagesContainer"></div>
							</div>
						</div>
					</div>
					<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
				</blockquote>
			</div>
		</div>
	</div>
</form>
<script>

</script>
@endsection