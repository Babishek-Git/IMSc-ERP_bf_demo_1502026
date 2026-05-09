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
								<span class="rm-with-selected-btn" id="rm-withSelectedBtn">Interim / Other Bill Payment List</span>
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
                                    <button type="button" data-id="{{ encrypt('NEW') }}" data-mode="{{ encrypt('MANUAL') }}" class="rm-new-emp-btn ViewSubmit"><i class="fa fa-inr" style="padding-top: 2px;"></i> Create Manual Payment</button>
								</div>
							</div>

							<div class="rm-table-wrap">
								<table id="rm-empTable">
									<thead>
										<tr>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">S.No. <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Employee Group Type <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">ICNO. <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Employee Name <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Designation<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Grp. / Div./Sec.</tbody> <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Payment For</tbody> <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Amount <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Action<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										</tr>
									</thead>
									<tbody id="rm-tableBody">
                                        @if(isset($OtherPaymentList))
                                        @if(count($OtherPaymentList) > 0)
                                        @foreach($OtherPaymentList as $OtherPayment)
                                        @php

                                            if(isset($EmpData)){  
                                                if(isset($EmpData[$OtherPayment->pay_emp_no])){ 
                                                    $EmployeeData = $EmpData[$OtherPayment->pay_emp_no];  
                                                    if(filled($EmployeeData)){
                                                        $EmpNo = $EmployeeData->pluck('emp_no')->first();
                                                        $IcNo = $EmployeeData->pluck('ic_no')->first();
                                                        $EmpName = $EmployeeData->pluck('emp_name_payslip')->first();
                                                        $EmpGroupType = $EmployeeData->pluck('emp_group_name')->first();
                                                        $Designation = $EmployeeData->pluck('designation_name')->first();
                                                        $GroupName = $EmployeeData->pluck('group')->first();
                                                        $DivisionName = $EmployeeData->pluck('division')->first();
                                                        $SectionName = $EmployeeData->pluck('section')->first();
                                                    }
                                                }
                                            }
                                        @endphp
                                        <tr data-name="{{ $OtherPayment->payment_id }}" data-status="{{ $OtherPayment->active == 1 ? 'active' : 'inactive' }}">
                                            <td align="center">{{ $loop->iteration }}</td>
                                            <td>{{ $EmpGroupType ?? '' }}</td>
                                            <td align="center">{{ $IcNo ?? '' }}</td>
                                            <td>{{ $EmpName ?? '' }}</td>
                                            <td align="center">{{ $Designation ?? '' }}</td>
                                            <td>
                                                @if($SectionName != NULL)
                                                    {{ $SectionName }}
                                                @elseif($DivisionName != NULL)
                                                    {{ $DivisionName }}
                                                @elseif($GroupName != NULL)
                                                    {{ $GroupName }}
                                                @endif
                                            </td>
                                            <td align="right">
                                                @php
                                                $ModuleName = '';
                                                if(isset($ModuleDataList)){
                                                    if(isset($ModuleDataList[$OtherPayment->module_code])){
                                                        $Module = $ModuleDataList[$OtherPayment->module_code]; 
                                                        $ModuleName = $Module->wf_module_name; 
                                                    }
                                                }
                                                @endphp
                                                {{ $ModuleName }}
                                            </td>
                                            <td align="right">{{ $OtherPayment->net_amount ?? '' }}</td>
                                            <td width="110px" align="center">
                                                <button type="button" data-id="{{ encrypt($OtherPayment->payment_id) }}" data-mode="{{ encrypt('MODULE') }}" class="btn btn-default tuploadbtn ViewSubmit"><i class="fa fa-inr"></i> Make Payment</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="10" align="center">No Records Found</td>
                                        </tr>
                                        @endif
                                        @endif
                                        
										
									</tbody>
								</table>
								<!-- <div class="rm-empty" id="rm-emptyMsg" style="display:none">No records found.</div> -->
							</div>
							<div class="rm-pagination">
								<span class="rm-info" id="rm-pageInfo"></span>
								<!-- <div class="rm-pages" id="rm-pagesContainer"></div> -->
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
    let ProcessMode = $(this).attr('data-mode');
    let Action  = $("#txt_action").val();
    let Page    = $("#txt_page").val();
    var form = document.createElement("form");
        form.method = "POST"; 
        form.action = "{{ route('payment.other-payment-creation') }}";
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
        FloatingPageIp1.name 	= "txt_float_action";
        FloatingPageIp1.value 	= Action; 
        form.appendChild(FloatingPageIp1);
    var FloatingPageIp1 		= document.createElement("input");
        FloatingPageIp1.type 	= "hidden";
        FloatingPageIp1.name 	= "txt_page";
        FloatingPageIp1.value 	= Page; 
     var FloatingPageIp1 		= document.createElement("input");
        FloatingPageIp1.type 	= "hidden";
        FloatingPageIp1.name 	= "txt_process_mode";
        FloatingPageIp1.value 	= ProcessMode; 
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