@extends('layouts.dashboard-master')

@section('content') 

@include('layouts.partials.messages')

@php
    $Page = $data['Page'] ?? NULL;
@endphp
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
								<span class="rm-with-selected-btn" id="rm-withSelectedBtn">Indent Application Waiting List</span>
								<input type="number" id="rm-perPage" value="15" min="1" max="100">
								<select id="rm-filterStatus">
								<option value="all">All</option>
								<option value="active">Active</option>
								<option value="inactive">Inactive</option>
								</select>
								<input type="text" id="rm-searchInput" placeholder="🔍  Search…">
								<div class="rm-toolbar-right">
									<!-- <div class="rm-icon-btn" title="Print" onclick="window.print()">
										 <i class="fa fa-print" style="font-size:15px; color:red; font-weight:600;"></i>
									</div>
									<div class="rm-icon-btn" title="Export CSV" onclick="exportCSV()">
										 <i class="fa fa-file-excel-o" style="font-size:15px; color:#18D977; font-weight:600;"></i>
									</div>
									<div class="rm-icon-btn" title="Copy" onclick="copyTable()">
										 <i class="fa fa-clone" style="font-size:15px; color:blue;; font-weight:600;"></i>
									</div> -->
									<!-- @php $AddUrl = 'change-request.address-change-request'; @endphp 
									@php $BackUrl = 'change-request.address-change-request-list'; @endphp 
									@if($Page == 'REQ_APPLY')
									@if($AddressCount>0)
										<button type="button" class="rm-new-emp-disable-btn readonly">+ New Request</button>
									@else
										<button type="button" class="rm-new-emp-btn" onClick="window.location='{{route($AddUrl)}}'">+ New Request</button>
									@endif
									@endif -->
									<div class="btn-group floatr">
                                        <button type="button" class="btn btn-default btnprimary" title="Home" name="back" id="back" value=" Home " onclick="window.location='{{ route('dashboard.index') }}'" ><i class="fa fa-home pt2"></i> Home</button>
                                    </div>
								</div>
							</div>

							<div class="rm-table-wrap">
								<table id="rm-empTable">
									<thead>
										<tr>
										<th style="width:40px">#</th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">S.No. <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Indent No. <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Indent Description <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Indent Created By <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Indent Date <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Action<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th style="width:80px; text-align:center;">Delete</th>
										<!-- <th style="width:80px; text-align:center;" class="rm-sortable" data-col="status"><div class="rm-th-inner">Status <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th> -->
										</tr>
									</thead>
									<tbody id="rm-tableBody">
										@if(isset($data['Indentdata']))
											@php $EmpCreateIndents = collect($data['Indentdata'])->where('emp_no', session('WcmsEmpNo'))->where('status', 'SU'); @endphp
											@foreach($EmpCreateIndents as $Indentdata)
												<tr data-name="{{ $Indentdata->emp_no }}" data-status="{{ $Indentdata->active == 1 ? 'active' : 'inactive' }}">
													<td></td>
													<td>{{ $loop->iteration }}</td>
													<td>{{ $Indentdata->indent_no }}</td>
													<td>{{ $Indentdata->indent_descripton }}</td>
													<td>{{ $Indentdata->emp_name_payslip }}</td>
													<td>{{ Helper::DisplayDateFormat($Indentdata->indent_date) }}</td>
													<td align="center">
														@if($Indentdata->status == 'SU')
															<button type="button" name="btn_edit" class="btn btn-default tuploadbtn" id="btn_edit" value="Edit" onclick="window.location='{{ route('indent.indent-creation',['EditId'=>encrypt($Indentdata->indent_id),'page'=>encrypt('EDIT')]) }}'"> <i class='fa fa-edit'></i> Edit </button>
														@endif
															<button type="button" name="btn_submit" class="xlbtndownload m-btm1" id="btn_submit" value="Submit" onclick="window.location='{{ route('indent.indent-creation', ['EditId'=>encrypt($Indentdata->indent_id),'page'=>encrypt('PROCESS')]) }}'"> <i class='fa fa-check'></i> View & Submit</button>
													</td>
													<td align="center">
														@if($Indentdata->status == 'SU')
															<button type="button" name="btn_delete" id="btn_delete" class="btn btn-default tdelbtn Delete" title="Click here to delete" style="cursor: pointer;"><i class="fa fa-trash-o pt2"></i></button>												
														@else
															<button type="button" name="btn_delete" id="btn_delete" class="btn btn-default tdelbtn" title="Click here to delete" style="cursor: pointer; color: grey;"><i class="fa fa-trash-o pt2"></i></button>												
														@endif
													</td>
													<!-- <td align="center"><label class="rm-toggle"><input type="checkbox" @if($Indentdata->active == 1) checked @endif><span class="rm-slider"></span></label></td> -->
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