@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
if(isset($data['AddressData']))
{
	$Address = $data['AddressData'];
	$AddressCount = Count($Address);
}
if(isset($data['EmpGrpArr'])){
	$EmpGroupData = $data['EmpGrpArr'];
}else{
	$EmpGroupData = [];
}
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
								<span class="rm-with-selected-btn" id="rm-withSelectedBtn">Allowance, Advance, Loan List</span>
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
									@php $AddUrl  = 'AllowanceAdvanceMaster.AllowanceAdvanceMaster'; @endphp 
									@php $BackUrl = 'AllowanceAdvanceMaster.ViewAllowanceAdvanceMaster'; @endphp 
										<button type="button" class="rm-new-emp-btn" onClick="window.location='{{route($AddUrl)}}'">+ New Creation</button>
								</div>
							</div>
							<div class="rm-table-wrap">
								<table id="rm-empTable">
									<thead>
										<tr>
										<th style="width:40px">#</th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">S.No. <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Component Type<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Component Name <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Is Taxable<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Is Percentage <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">With Effect from <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
 										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Applicable For<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Action<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th style="width:80px; text-align:center;">Delete</th>
										<th style="width:80px; text-align:center;" class="rm-sortable" data-col="status"><div class="rm-th-inner">Status <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										</tr>
									</thead>
									<tbody id="rm-tableBody">
										@if(isset($data['ComponentData']))
											@foreach($data['ComponentData'] as $ComponentData)
												<tr data-name="{{ $ComponentData->emp_no }}" data-status="{{ $ComponentData->active == 1 ? 'active' : 'inactive' }}">
													<td></td>
													<td>{{ $loop->iteration }}</td>
													<td>{{ $ComponentData->component_type_name }}</td>
													<td>{{ $ComponentData->component_name }}</td>
													@if($ComponentData->is_taxable == 1)
														<td align="left">Taxable</td>
													@else
														<td align="left">Not Taxable</td>
													@endif
													@if($ComponentData->is_percentage == 1)
														<td align="left">Is Percentage</td>
													@else
														<td align="left">Not Percentage</td>
													@endif
													<td>{{ Helper::DisplayDateFormat($ComponentData->with_effect_from) }}</td>
													<td> 
														@php
														$ApplicableList = explode(',',$ComponentData->applicable_emp_group); 
														foreach($ApplicableList as $ApplicableValue){
															if(isset($EmpGroupData[$ApplicableValue])){ 
																$GroupName = $EmpGroupData[$ApplicableValue];
																echo $GroupName."<br>";
															}
														}	
														@endphp
													</td>
													<td align="center"><button type="button" name="btn_edit" class="btn btn-default tuploadbtn" id="btn_edit" value=" Edit" onclick="window.location='{{ route('AllowanceAdvanceMaster.AllowanceAdvanceMaster',['id'=>encrypt($ComponentData->component_id),'Page'=>encrypt('REQ')]) }}'"> <i class='fa fa-edit'></i> View & Edit</button></td>
													<td align="center">
														<button type="button" name="btn_delete" id="btn_delete" class="btn btn-default tdelbtn Delete" title="Click here to delete" style="cursor: pointer;"><i class="fa fa-trash-o pt2"></i></button>												
													</td>
													<td align="center"><label class="rm-toggle"><input type="checkbox" {{ $ComponentData->active == 1 ? 'checked' : '' }}><span class="rm-slider"></span></label></td>
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