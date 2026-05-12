@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
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
								<span class="rm-with-selected-btn" id="rm-withSelectedBtn">PG List</span>
								<input type="number" id="rm-perPage" value="15" min="1" max="100">
								<select id="rm-filterStatus">
								<option value="all">All</option>
								<option value="active">Active</option>
								<option value="inactive">Inactive</option>
								</select>
								<input type="text" id="rm-searchInput" placeholder="🔍  Search…">

								<div class="rm-toolbar-right">
									<div class="rm-icon-btn" title="Print" onclick="window.print()">
										 <i class="fa fa-print" style="font-size:15px; color:red; font-weight:600;"></i>
									</div>
									<div class="rm-icon-btn" title="Export CSV" onclick="exportCSV()">
										 <i class="fa fa-file-excel-o" style="font-size:15px; color:#18D977; font-weight:600;"></i>
									</div>
									<div class="rm-icon-btn" title="Copy" onclick="copyTable()">
										 <i class="fa fa-clone" style="font-size:15px; color:blue;; font-weight:600;"></i>
									</div>
									@php $AddUrl  = 'sdpo-entry.pg-entry'; @endphp 
									@php $BackUrl = 'sdpo-entry.view-pg'; @endphp 
									<button type="button" class="rm-new-emp-btn" onClick="window.location='{{route($AddUrl)}}'">+ NEW PG ENTRY</button>
								</div>
							</div>
							<div class="rm-table-wrap">
								<table id="rm-empTable">
									<thead>
										<tr>
										<th style="width:40px">#</th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Purchase Order Name<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Purchase Order Date<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Purchase Order Cost<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<!-- <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Is Employee Portal Access <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th> -->
										<th style="width:80px; text-align:center;">Edit</th>
										<th style="width:80px; text-align:center;">Delete</th>
										<th style="width:80px; text-align:center;" class="rm-sortable" data-col="status"><div class="rm-th-inner">Status <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										</tr>
									</thead>
									<tbody id="rm-tableBody">
										@if(isset($data['ShowPoItemDetailsData']))
											@foreach($data['ShowPoItemDetailsData'] as $ShowPoItemDetailsData)
												<tr data-name="{{ $ShowPoItemDetailsData->work_order_no }}" data-status="{{ $ShowPoItemDetailsData->active == 1 ? 'active' : 'inactive' }}">
													<td>{{ $loop->iteration }}</td>
													<td>{{ $ShowPoItemDetailsData->work_name }}</td>
													<td>{{Helper::DisplayDateFormat($ShowPoItemDetailsData->work_order_date)}}</td>
													<td>{{ $ShowPoItemDetailsData->work_order_cost }}</td>
													<td align="center">
														<button type="button" name="btn_edit" id="btn_edit" class="btn btn-default teditbtn estEdit" onClick="window.location='{{route('bank.Bank', ['id' => encrypt($ShowPoItemDetailsData->id)])}}'" title="Click here to Edit" style="cursor: pointer;"><i class="fa fa-edit pt2"></i></button>
													</td>
													<td align="center">
														<button type="button" name="btn_delete" id="btn_delete" class="btn btn-default tdelbtn Delete" title="Click here to delete" style="cursor: pointer;"><i class="fa fa-trash-o pt2"></i></button>												
													</td>
													<td align="center"><label class="rm-toggle"><input type="checkbox" {{ $ShowPoItemDetailsData->active == 1 ? 'checked' : '' }}><span class="rm-slider"></span></label></td>
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