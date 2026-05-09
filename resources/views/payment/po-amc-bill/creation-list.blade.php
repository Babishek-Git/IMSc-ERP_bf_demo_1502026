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
								<span class="rm-with-selected-btn" id="rm-withSelectedBtn">Purchase Order Payment List</span>
							</div>
							<div class="rm-table-wrap">
								<table id="rm-empTable">
									<thead>
										<tr>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">S.No. <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">PO No. <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Work Name <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Vendor Name <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">PO Date</tbody> <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">PO Cost</tbody> <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Bill Amount <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Action<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										</tr>
									</thead>
									<tbody id="rm-tableBody"> 
                                        @if(isset($WorksPoData))
                                        @if(count($WorksPoData) > 0)
                                        @foreach($WorksPoData as $WorksPo)
                                        <tr data-name="{{ $WorksPo->master_inward_id }}" data-status="{{ $WorksPo->active == 1 ? 'active' : 'inactive' }}">
                                            <td align="center">{{ $loop->iteration }}</td>
                                            <td>{{ $WorksPo->work_order_no }}</td>
                                            <td align="center">{{ $WorksPo->work_name }}</td>
                                            <td>{{ $WorksPo->name_contractor }}</td>
                                            <td>{{ $WorksPo->work_order_date }}</td>
                                            <td align="center">{{ $WorksPo->work_order_cost }}</td>
                                            <td align="right">{{ $WorksPo->gross_amount }}</td>
                                            <td width="110px" align="center">
                                                <button type="button" data-id="{{ encrypt($WorksPo->payment_id) }}" data-poid="{{ encrypt($WorksPo->po_id) }}" data-mode="{{ encrypt('PO') }}" data-mastid="{{ encrypt($WorksPo->master_inward_id) }}" class="btn btn-default tuploadbtn ViewSubmit"><i class="fa fa-inr"></i> Make Payment</button>
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

                        <div class="div12 no-margin">
							<div class="rm-toolbar">
								<span class="rm-with-selected-btn" id="rm-withSelectedBtn">AMC Purchase Order Payment List</span>
							</div>
							<div class="rm-table-wrap">
								<table id="rm-empTable">
									<thead>
										<tr>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">S.No. <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">AMC File Name. <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Description <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Vendor Name <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Work Order Date</tbody> <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Work Order Cost</tbody> <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Bill Amount <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Action<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										</tr>
									</thead>
									<tbody id="rm-tableBody">
                                        @if(isset($AmcPoData))
                                        @if(count($AmcPoData) > 0)
                                        @foreach($AmcPoData as $AmcPo)
                                        <tr data-name="{{ $AmcPo->amc_master_inward_id }}" data-status="{{ $AmcPo->active == 1 ? 'active' : 'inactive' }}">
                                            <td align="center">{{ $loop->iteration }}</td>
                                            <td>{{ $AmcPo->amc_file_name }}</td>
                                            <td align="center">{{ $AmcPo->equip_desc }}</td>
                                            <td>{{ $AmcPo->name_contractor }}</td>
                                            <td>{{ $AmcPo->work_order_date }}</td>
                                            <td align="center">{{ $AmcPo->grand_total }}</td>
                                            <td align="right">{{ $AmcPo->gross_amount }}</td>
                                            <td width="110px" align="center">  
                                                <button type="button" data-id="{{ encrypt($AmcPo->payment_id) }}" data-poid="{{ encrypt($AmcPo->amc_po_id) }}" data-mode="{{ encrypt('AMC') }}" data-mastid="{{ encrypt($AmcPo->amc_master_inward_id) }}" class="btn btn-default tuploadbtn ViewSubmit"><i class="fa fa-inr"></i> Make Payment</button>
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
    let ApplicationPoId = $(this).attr('data-poid');
    let ApplicationMastId = $(this).attr('data-mastid');
    let ProcessMode = $(this).attr('data-mode');
    let Action  = $("#txt_action").val();
    let Page    = $("#txt_page").val();
    var form = document.createElement("form");
        form.method = "POST"; 
        form.action = "{{ route('payment.indent-bill-payment-create') }}";
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
        FloatingPageIp1.name 	= "txt_float_application_poid";
        FloatingPageIp1.value 	= ApplicationPoId; 
        form.appendChild(FloatingPageIp1);
    var FloatingPageIp1 		= document.createElement("input");
        FloatingPageIp1.type 	= "hidden";
        FloatingPageIp1.name 	= "txt_float_application_mastid";
        FloatingPageIp1.value 	= ApplicationMastId; 
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