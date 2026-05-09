@extends('layouts.dashboard-master')

@section('content') 

@include('layouts.partials.messages')

@php
    $VendorData                 = $data['VendorData'] ?? NULL;
    $AMCTypeArray               = $data['AMCTypeDetials'] ?? NULL;
    $AMCProvdedBaseONArray      = $data['AMCProvdedBaseData'] ?? NULL;
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
								<span class="rm-with-selected-btn" id="rm-withSelectedBtn">AMC Work Waiting For payment - List</span>
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
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">AMC Type <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">AMC Bases On <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">AMC File Name <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Description of Equipment <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Vendor Name <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<th class="rm-sortable" data-col="name"><div class="rm-th-inner">Action<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										<!-- <th style="width:80px; text-align:center;">Delete</th> -->
										<!-- <th style="width:80px; text-align:center;" class="rm-sortable" data-col="status"><div class="rm-th-inner">Status <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th> -->
										</tr>
									</thead>
									<tbody id="rm-tableBody">
										@if(isset($data['ShowAMCMatInwardDetails']))
											@foreach($data['ShowAMCMatInwardDetails'] as $AMCMatData)
												@if($AMCMatData->amc_mat_inward_submit ==  'true' )
													@if($AMCMatData->from_emp_no == NULL && ($AMCMatData->status  =="SU") && $AMCMatData->created_by == session('WcmsEmpNo') || $AMCMatData->to_emp_no == session('WcmsEmpNo'))
														<tr data-name="{{ $AMCMatData->created_by }}" data-status="{{ $AMCMatData->active == 1 ? 'active' : 'inactive' }}">
															<td></td>
															<td>{{ $loop->iteration }}</td>
															<td>{{ $AMCTypeArray[$AMCMatData->amc_type_id] }}</td>
															<td>{{ $AMCProvdedBaseONArray[$AMCMatData->amc_baseson_id] }}</td>
															<td>{{ $AMCMatData->amc_file_name }}</td>
															<td>{{ $AMCMatData->equip_desc }}</td>
															<td>{{ $VendorData[$AMCMatData->contid] }}</td>
															@if($AMCMatData->from_emp_no == NULL && ($AMCMatData->status  =="SU") && $AMCMatData->created_by == session('WcmsEmpNo'))
																<td align="center">
																	<button type="button" name="btn_edit" class="btn btn-default tuploadbtn" id="btn_edit" value="Edit" onclick="window.location='{{ route('amc-material-payment.amc-material-inward-payment-submission',['EditId'=>encrypt($AMCMatData->amc_master_inward_id),'page'=>encrypt('EDIT')]) }}'"> <i class='fa fa-edit'></i> View & Edit</button>
																	<button type="button" name="btn_submit" class="xlbtndownload m-btm1" id="btn_submit" value="Submit" onclick="window.location='{{ route('amc-material-payment.amc-material-inward-payment-submission', ['EditId'=>encrypt($AMCMatData->amc_master_inward_id),'page'=>encrypt('PROCESS')]) }}'"> <i class='fa fa-check'></i> View & Submit</button>
																</td>
															@elseif($AMCMatData->to_emp_no == session('WcmsEmpNo'))
																<td align="center">
																	<button type="button" name="btn_submit" class="xlbtndownload m-btm1" id="btn_submit" value="Submit" onclick="window.location='{{ route('amc-material-payment.amc-material-inward-payment-submission', ['EditId'=>encrypt($AMCMatData->amc_master_inward_id),'page'=>encrypt('PROCESS')]) }}'"> <i class='fa fa-check'></i> View & Submit</button>
																</td>
															@endif
															
															<!-- <td align="center">
																<button type="button" name="btn_del" id="btn_del"  data-page="{{encrypt('DELETE')}}" data-deltid="{{encrypt($AMCMatData->amc_master_inward_id)}}" class="btn btn-default tdelbtn tooltip-l Delete" title="Click here to Delete" style="cursor: pointer;"><i class="fa fa-trash-o pt2"></i></button>
															</td> -->
															<!-- <td align="center"><label class="rm-toggle"><input type="checkbox" @if($AMCMatData->active == 1) checked @endif><span class="rm-slider"></span></label></td> -->
														</tr>
													@endif
												@endif
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
	$(document).ready(function(){
		var KillEvent = 0;
		$('body').on("click","#btn_del", function(event){
			if(KillEvent == 0){
				var deltid = $(this).attr("data-deltid");
				var page   = $(this).attr("data-page");
				event.preventDefault();
				BootstrapDialog.show({
					title: 'Confirmation Message',
					message: 'Are you sure want to Delete AMC  Purchase Order Details?',
					closable: false, 				// <-- Default value is false,
					draggable: false, 				// <-- Default value is false,
					buttons: [
						{
							label: 'Ok',
							cssClass: 'btn-primary',
							action: function(dialog) {
								dialog.close();
								KillEvent = 1;
								var url = '{{ route("amc-purchase-order.amc-purchase-order-submission") }}'+'?page='+page+'&DeleteId='+deltid;
								window.location.href = url;
							}
						},
						{
							label: 'Cancel',
							cssClass: 'btn-secondary',
							action: function(dialog) {
								dialog.close();
								KillEvent = 0;
							}
						}
					]
				});
			}
		});
	});
</script>
@endsection