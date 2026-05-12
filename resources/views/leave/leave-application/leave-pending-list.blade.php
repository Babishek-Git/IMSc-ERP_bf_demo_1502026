@extends('layouts.dashboard-master')
@section('content')
@include('layouts.partials.messages')

@php 
$Page = $Page ?? NULL;
$ApplyBy = $ApplyBy ?? NULL;
@endphp

<form action="" method="post" enctype="multipart/form-data" name="form">
    <div class="content">
        <div class="title"></div>
        <div class="container_12">
            <div class="grid_12">
                <blockquote class="bq1" style="overflow:auto">
                    <div class="container">
                        <div class="div12 no-margin">
							<div class="rm-toolbar">
								<span class="rm-with-selected-btn" id="rm-withSelectedBtn">Leave Application List</span>
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
									@php 
                                    if($ApplyBy == "REQ_ADMIN"){
                                        $AddUrl = 'LeaveApplication.LeaveApplicationAdmin'; 
                                    }else{
                                        $AddUrl = 'LeaveApplication.LeaveApplicationSelf'; 
                                    }
                                    $LeaveAppCount = count($LeaveApplicationList);
                                    @endphp 
									@if($Page == 'REQ_APPLY')
										<button type="button" class="rm-new-emp-btn" onClick="window.location='{{route($AddUrl)}}'">+ New Request</button>
									@endif
								</div>
							</div>

							<div class="rm-table-wrap">
								<table id="rm-empTable">
									<thead>
										<tr>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">S.No. <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">IC No. <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Name <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Application No. <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Total Days <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Applied On<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Reason<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Action<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th style="width:80px; text-align:center;">Delete</th>
                                            <th style="width:80px; text-align:center;" class="rm-sortable" data-col="status"><div class="rm-th-inner">Status <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										</tr>
									</thead>
									<tbody id="rm-tableBody">
                                        @if(isset($LeaveApplicationList))
                                        @foreach($LeaveApplicationList as $LeaveApplication)
                                        <tr data-name="{{ $LeaveApplication->emp_no }}" data-status="{{ $LeaveApplication->active == 1 ? 'active' : 'inactive' }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $LeaveApplication->emp_no }}</td>
                                            <td>{{ $LeaveApplication->employee->emp_name_payslip }}</td>
                                            <td>{{ $LeaveApplication->leave_application_no }}</td>
                                            <td>{{ $LeaveApplication->total_days }}</td>
                                            <td>{{ $LeaveApplication->created_at }}</td>
                                            <td></td>
                                            <td width="110px" align="center">
                                                <button type="button" data-id="{{ encrypt($LeaveApplication->leave_application_id) }}"  class="btn btn-default tuploadbtn ViewSubmit"><i class="fa fa-eye"></i> View & Submit</button>
                                            </td>
                                            <td align="center">
                                                @if($Page == 'REQ_APPLY')
                                                <button type="button" name="btn_delete" id="btn_delete" class="btn btn-default tdelbtn Delete" title="Click here to delete" style="cursor: pointer;"><i class="fa fa-trash-o pt2"></i></button>												
                                                @else
                                                <button type="button" name="btn_delete" id="btn_delete" class="btn btn-default tdelbtn" title="Click here to delete" style="cursor: pointer; color: grey;"><i class="fa fa-trash-o pt2"></i></button>												
                                                @endif

                                            </td>
                                            <td align="center"><label class="rm-toggle"><input type="checkbox" {{ $LeaveApplication->active == 1 ? 'checked' : '' }}><span class="rm-slider"></span></label></td>
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

                    <div class="row">
                        <div class="div12" align="center">
                            <input type="hidden" name="txt_page" id="txt_page" value="{{ encrypt($Page) }}">
                            <input type="hidden" name="txt_apply_by" id="txt_apply_by" value="{{ encrypt($ApplyBy) }}">
                            <input type="hidden" name="txt_action" id="txt_action" value="{{ encrypt('PROCESS') }}">
                            <input type="hidden" name="txt_tab" id="txt_tab" value="1">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}">
                        </div>
                    </div>
                </blockquote>
            </div>
        </div>
    </div>
</form>

<style>
    .chosen-drop { width: 500px !important; }
    #eligibilityWarning ul { margin: 4px 0 0 16px; padding: 0; }
</style>

<script>
// ─────────────────────────────────────────────────────────────────────────────
// Init
// ─────────────────────────────────────────────────────────────────────────────
$(".ChosenInput").chosen();

$("body").on("click", ".ViewSubmit", function () {
    let ApplicationId = $(this).attr('data-id');
    let ApplyBy = $("#txt_apply_by").val();
    let Action  = $("#txt_action").val();
    let Page    = $("#txt_page").val();
    var form = document.createElement("form");
        form.method = "POST"; 
        form.action = "{{ route('leave.ViewLeaveApplication') }}";
        form.name = "attendanceform"; 
        document.body.appendChild(form); 
    var csrfToken = document.createElement("input"); 
        csrfToken.type = "hidden";
        csrfToken.name = "_token"; 
        csrfToken.value = "{{ Session::token() }}"; 
        form.appendChild(csrfToken);
    var FloatingPageIp1 		= document.createElement("input");
        FloatingPageIp1.type 	= "hidden";
        FloatingPageIp1.name 	= "txt_float_application";
        FloatingPageIp1.value 	= ApplicationId; 
        form.appendChild(FloatingPageIp1);
    var FloatingPageIp1 		= document.createElement("input");
        FloatingPageIp1.type 	= "hidden";
        FloatingPageIp1.name 	= "txt_float_apply_by";
        FloatingPageIp1.value 	= ApplyBy; 
        form.appendChild(FloatingPageIp1);
    var FloatingPageIp1 		= document.createElement("input");
        FloatingPageIp1.type 	= "hidden";
        FloatingPageIp1.name 	= "txt_float_action";
        FloatingPageIp1.value 	= Action; 
        form.appendChild(FloatingPageIp1);
    var FloatingPageIp1 		= document.createElement("input");
        FloatingPageIp1.type 	= "hidden";
        FloatingPageIp1.name 	= "txt_page";
        FloatingPageIp1.value 	= Page; 
        form.appendChild(FloatingPageIp1);
    var FloatingSubmitBtn 		= document.createElement("input");
        FloatingSubmitBtn.type 	= "submit";
        FloatingSubmitBtn.name 	= "btn_view_application";
        FloatingSubmitBtn.id 	= "btn_view_application";
        form.appendChild(FloatingSubmitBtn);
        $("#btn_view_application").trigger("click");
});

</script>
@endsection