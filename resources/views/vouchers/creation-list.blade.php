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
								<span class="rm-with-selected-btn" id="rm-withSelectedBtn">Voucher Creation List</span>
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
                                    <!-- <button type="button" data-id="{{ encrypt('NEW') }}" data-mode="{{ encrypt('MANUAL') }}" class="rm-new-emp-btn ViewSubmit"><i class="fa fa-inr" style="padding-top: 2px;"></i> Create Manual Voucher</button> -->
                                    <button type="submit" name="btnSave" id="btnSave" class="rm-new-emp-btn ViewSubmit" value="SaveVoucher"><i class="fa fa-check" style="padding-top: 2px;"></i> Save</button>
								</div>
							</div>

							<div class="rm-table-wrap">
								<table id="rm-empTable" class="VoucherTable">
									<thead>
										<tr>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">S.No. <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Payment For <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Gross Amount <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Total recovery <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Net Amount<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Voucher No.</tbody> <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Voucher Date</tbody> <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
                                            <th class="rm-sortable" data-col="name"><div class="rm-th-inner">Voucher Amount<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px"><path d="M7 8l5-5 5 5M7 16l5 5 5-5"/></svg></div></th>
										</tr>
									</thead>
									<tbody>
                                        @if(isset($PaymentList))
                                        @if(count($PaymentList) > 0)
                                        @foreach($PaymentList as $Payment)
                                        @php
										$ModuleName = '';
										if(isset($ModuleDataList)){
											if(isset($ModuleDataList[$Payment->module_code])){
												$Module = $ModuleDataList[$Payment->module_code]; 
												$ModuleName = $Module->wf_module_name; 
											}
										}
                                            
                                        @endphp
                                        <tr data-name="{{ $Payment->payment_id }}" data-status="{{ $Payment->active == 1 ? 'active' : 'inactive' }}">
                                            <td align="center">{{ $loop->iteration }}</td>
                                            <td>{{ $ModuleName ?? '' }} <input type="hidden" name="txt_payment_id[]" id="txt_payment_id" class="tboxsmclass" value="{{ $Payment->payment_id }}"></td>
                                            <td align="right">{{ $Payment->gross_amount ?? '' }}</td>
                                            <td align="right">{{ $Payment->recovery_amount ?? '' }}</td>
                                            <td align="right">{{ $Payment->net_amount ?? '' }}</td>
                                            <td width="50"><input type="text" name="txt_voucher_no[]" id="txt_voucher_no" class="tboxsmclass VoucherNo" value=""></td>
                                            <td width="50"><input type="text" name="txt_voucher_date[]" id="txt_voucher_date" class="tboxsmclass datepicker VoucherDt" value=""></td>
                                            <td width="50"><input type="text" name="txt_voucher_amt[]" id="txt_voucher_amt" class="tboxsmclass VoucherAmt" value=""></td>
                                        </tr>
										<tr style="border-bottom:2px solid #045261" data-name="oh-{{ $Payment->payment_id }}" data-status="{{ $Payment->active == 1 ? 'active' : 'inactive' }}">
											<td colspan="8">
											@php
											if(isset($PaymentObjectHeadList)){ 
												if(isset($PaymentObjectHeadList[$Payment->payment_id])){
													$PayementOHData = $PaymentObjectHeadList[$Payment->payment_id];
													if(filled($PayementOHData)){
														foreach($PayementOHData as $PaymentObjectHead){  
															$ObjectHeadId = $PaymentObjectHead->object_head_id;
															$ObjectHeadSubCataId = $PaymentObjectHead->object_head_sub_cata_id;
															$LedgerId = $PaymentObjectHead->ledger_id;
															$LedgerGroupId = $PaymentObjectHead->ledger_group_id;
															$GiaId = $PaymentObjectHead->gia_id;
															$ProjectId = $PaymentObjectHead->project_id;
															
															if(isset($ObjectHeadList)){
																if(isset($ObjectHeadList[$ObjectHeadId])){
																	$ObjectHead = $ObjectHeadList[$ObjectHeadId];
																	$ObjectHeadName = $ObjectHead->object_head_name; 
																}
															}
															//$ObjectHeadSubCataName = '';
															if(isset($ObjectHeadSubCataList)){
																if(isset($ObjectHeadSubCataList[$ObjectHeadSubCataId])){
																	$ObjectHeadSubCata = $ObjectHeadSubCataList[$ObjectHeadSubCataId];
																	$ObjectHeadSubCataName = $ObjectHeadSubCata->oh_sub_cata_name;
																}
															}
															if(isset($LedgerList)){
																if(isset($LedgerList[$LedgerId])){
																	$Ledger = $LedgerList[$LedgerId];
																	$LedgerName = $Ledger->ledger_acc_name;
																}
															}
															if(isset($GiaList)){
																if(isset($GiaList[$GiaId])){
																	$Gia = $GiaList[$GiaId];
																	$GiaName = $Gia->gia_name;
																}
															}
															if(isset($ProjectList)){
																if(isset($ProjectList[$ProjectId])){
																	$Project = $ProjectList[$ProjectId];
																	$ProjectName = $Gia->project_name;
																}
															}
															echo '<div class="row">';
															if(isset($LedgerName)){
																echo '<span class="data-info"><label>Ledger</label> : '.$LedgerName.'</span>';
															}
															if(isset($ObjectHeadName)){ 
																if(isset($ObjectHeadSubCataName)){
																	echo '<span class="data-info"><label>Object Head</label> : '.$ObjectHeadName.' / '.$ObjectHeadSubCataName.'</span>';
																}else{
																	echo '<span class="data-info"><label>Object Head</label> : '.$ObjectHeadName.'</span>';
																}
															}
															if(isset($Gia)){
																echo '<span class="data-info"><label>Grant In Aid</label> : '.$GiaName.'</span>';
															}
															if(isset($ProjectName)){
																echo '<span class="data-info"><label>Project Name</label> : '.$ProjectName.'</span>';
															}
															echo '</div>';
															echo '<div class="row smclearrow"></div>';
														}
													}
												}
											}
											@endphp
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
	#rm-empTable td {
  		padding: 2px 2px;
	}
	.data-info{
		border: 2px solid #17B3A1;
		padding: 2px 4px;
		border-radius: 8px;
		margin-right: 3px;
		font-size: 12px;
	}
	.data-info label{
		font-weight: 600;
		font-size: 12px;
		color: #8917B3;
	}
</style>

<script>
// ─────────────────────────────────────────────────────────────────────────────
// Init
// ─────────────────────────────────────────────────────────────────────────────
$(".ChosenInput").chosen();
var KillEvent = 0;
$("body").on("click", "#btnSave", function () {
	if(KillEvent == 0){
		let VoucherCnt = 0;
		$(".VoucherTable tbody tr").each(function () {
			let VoucherNo  = $(this).find(".VoucherNo").val()  || "";
			let VoucherDt  = $(this).find(".VoucherDt").val()  || "";
			let VoucherAmt = $(this).find(".VoucherAmt").val() || "";

			VoucherNo  = VoucherNo.trim();
			VoucherDt  = VoucherDt.trim();
			VoucherAmt = VoucherAmt.trim();

			if (VoucherNo !== "" && VoucherDt !== "" && VoucherAmt !== "") {
				VoucherCnt++;
			}
		});

		
		if(VoucherCnt == 0){
			BootstrapDialog.alert("Please enter atleast one voucher record to proceed");
			event.preventDefault();
			event.returnValue = false;
		}else{
			event.preventDefault();
			BootstrapDialog.confirm({
				title: 'Confirmation Message',
				message: 'Are you sure want to save ?',
				closable: false, // <-- Default value is false
				draggable: false, // <-- Default value is false
				btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
				btnOKLabel: 'Ok', // <-- Default value is 'OK',
				callback: function(result) {
					if(result){
						KillEvent = 1;
						$("#btnSave").trigger( "click" );
					}else {
						KillEvent = 0;
					}
				}
			});
		}
		
	}
});

</script>
@endsection