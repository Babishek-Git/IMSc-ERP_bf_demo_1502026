@extends('layouts.dashboard-master')

@section('content') 

@include('layouts.partials.messages')

@php
$showPurchaseOredrData = $data['showPurchaseOredrData'] ?? [];
$SessionEmpSectionId   = $data['SessionEmpSectionId'] ?? [];
$VendorArr = [];
if(isset($data['Contractordata'])){
	$ContData = $data['Contractordata'];
	foreach($ContData as $Contvalue){
		$VendorArr[$Contvalue->contid] = $Contvalue->name_contractor;
	}
}
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
								<span class="rm-with-selected-btn" id="rm-withSelectedBtn">Material Inward Pending Payment - Waiting For Certification List</span>
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
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Purchase Order No.<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Purchase Order Name <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Purchase Order Date<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Vendor Name<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Action<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<!-- <th style="width:80px; text-align:center;">Delete</th> -->
										<!-- <th style="width:80px; text-align:center;" class="rm-sortable" data-col="status"><div class="rm-th-inner">Status <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th> -->
										</tr>
									</thead>
									<tbody id="rm-tableBody">
										@if(isset($data['VocherDetails']) && count($data['VocherDetails']) > 0)
											@foreach($data['VocherDetails'] as $voucherData)
												@php $MatInwardData = collect($data['ShowMaterialInwardData'] ?? [])->firstWhere('master_inward_id', $voucherData->transaction_id); @endphp
												@if($MatInwardData) 
													@php $PurchaseOredrData = collect($data['showPurchaseOredrData'] ?? [])->firstWhere('work_order_id', $MatInwardData->po_id);@endphp
													@if($PurchaseOredrData && $PurchaseOredrData->po_issued == 'true')
														@if($SessionEmpSectionId == $PurchaseOredrData->mat_cert_sect_id)
															<tr>
																<td></td>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $PurchaseOredrData->work_order_no }}</td>
																<td>{{ $PurchaseOredrData->work_name }}</td>
																<td>{{ Helper::DisplayDateFormat($PurchaseOredrData->work_order_date) }}</td>
																<td>{{ $VendorArr[$PurchaseOredrData->contid] ?? '' }}</td>
																<td align="center">
																	<button type="button" class="btn btn-default tuploadbtn"onclick="window.location='{{ route('material.material-inward-pending-payment', ['EditId' => encrypt($MatInwardData->master_inward_id)]) }}'"><i class='fa fa-edit'></i> Edit</button>
																	@if($MatInwardData->is_pending_payment == true)
																		<button type="button" class="xlbtndownload m-btm1"onclick="window.location='{{ route('material.material-inward-pending-payment', ['SubmitId' => encrypt($MatInwardData->master_inward_id)]) }}'"> <i class='fa fa-check'></i> View & Submit </button>
																	@endif
																</td>
															</tr>
														@endif
													@endif
												@endif
											@endforeach
										@else
											<div class="rm-empty" id="rm-emptyMsg" style="display:none">No records found.</div>
										@endif
									</tbody>
								</table>
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