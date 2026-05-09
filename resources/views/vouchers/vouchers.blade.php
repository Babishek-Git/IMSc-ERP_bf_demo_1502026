@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php

if(isset($data['EditEmployeeData'])){
	$EditEmployeeData = $data['EditEmployeeData'];
	$EmpCode = collect($EditEmployeeData)->pluck('emp_type_code')->first();
	$EmpType = collect($EditEmployeeData)->pluck('emp_type')->first();
}
if(isset($data['LedgerGroup'])){
	$LedgerGroupData = $data['LedgerGroup'];
}else{
	$LedgerGroupData = [];
}
if(isset($data['LedgerData'])){
	$LedgerData = $data['LedgerData'];
}else{
	$LedgerData = [];
}
@endphp
<style>
	.emp-checkbox-tile{
		width: 10rem;
  		min-height: 5rem;
	}
	.emp-checkbox-label {
  		color: #444 !important;
	}
</style>
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="" method="post" enctype="multipart/form-data" name="form">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row plr">
								<!-- <div class="div2">&nbsp;</div> -->
								<div class="div12 mbtable box-md">
								<!-- <div class="form-box"> -->
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Accounting Transaction</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
																	
											<fieldset class="emp-checkbox-group-legend" style="margin-bottom:2px">
															
												<div class="status-indicator pending"></div>
													<div class="div10 no-margin" style="text-align:left">
														<div class="emp-checkbox">
													
															<!-- <label class="emp-checkbox-wrapper">
																<input type="radio" class="emp-checkbox-input" name="ch_transaction_type" id="ch_transaction_type_payment" value="PAYMENT" />
																<span class="emp-checkbox-tile">	
																	<img src="{{asset('assets/images/employee2.png')}}" alt="emp" width="40" height="40">
																	<span class="emp-checkbox-label">Payment</span>
																</span>																		
															</label>
															<label class="emp-checkbox-wrapper">
																<input type="radio" class="emp-checkbox-input" name="ch_transaction_type" id="ch_transaction_type_receipt" value="RECEIPT" />
																<span class="emp-checkbox-tile">	
																	<img src="{{asset('assets/images/employee2.png')}}" alt="emp" width="40" height="40">
																	<span class="emp-checkbox-label">Receipt</span>
																</span>																		
															</label>
															<label class="emp-checkbox-wrapper">
																<input type="radio" class="emp-checkbox-input" name="ch_transaction_type" id="ch_transaction_type_journal" value="JOURNAL" />
																<span class="emp-checkbox-tile">	
																	<img src="{{asset('assets/images/employee2.png')}}" alt="emp" width="40" height="40">
																	<span class="emp-checkbox-label">Journal</span>
																</span>																		
															</label> -->
															
															@if(isset($data['TransactionGroup']))
															@foreach($data['TransactionGroup'] as $TransactionGroup)
															<label class="emp-checkbox-wrapper">
																<input type="radio" class="emp-checkbox-input TransactionGroup" name="ch_transaction_type" id="ch_transaction_type_{{ $TransactionGroup->transaction_group_id }}" data-crde="{{ $TransactionGroup->credit_or_debit }}" value="{{ $TransactionGroup->transaction_group_code }}" />
																<span class="emp-checkbox-tile">	
																	<img src="{{asset('assets/images/employee2.png')}}" alt="emp" width="40" height="40">
																	<span class="emp-checkbox-label">{{$TransactionGroup->transaction_group_name}}</span>
																</span>																		
															</label>
															@endforeach
															@endif

																															
														</div>
													</div>
													<div class="div2 no-margin" style="text-align:right">
														<div class="row">
															<div class="div12 no-margin" align="right">
																<input type="submit" class="backbutton" name="btn_refresh" id="btn_refresh" value=" Refresh " />&emsp;
																<input type="submit" class="step-btn" name="btn_save" id="btn_save" value=" Save " />&emsp;
															</div>		
														</div>
													</div>
												</fieldset>
												<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Voucher Details</legend>
												<div class="fieldbox-div">
													<div class="row smclearrow"></div>
													<div class="div1 lboxlabel VrLabel1">Vr. No.</div> 
													<div class="div1"><input type="text" name="txt_icno" id="txt_icno" class="tboxsmclass" value="@if(isset($ICNo)){{$ICNo}}@endif" readonly></div>
													<div class="div1 cboxlabel VrLabel2">Vr. Date</div>
													<div class="div1"><input type="text" name="txt_payslip_name" id="txt_payslip_name" class="tboxsmclass" value="@if(isset($EmpName)){{$EmpName}}@endif" readonly></div>
													<div class="div1 cboxlabel BankBox">Bank Name <span class="reqindi">*</span></div>
													<div class="div2 BankBox">
														<select name="cmb_bank_name" id="cmb_bank_name" class="tboxsmclass ChosenInput">
															<option value="">---------- Select ----------</option>
															@if(isset($data['IMScData']))
																	@foreach($data['IMScData'] as $IMScData)
																		<option value="{{$IMScData->erp_imsc_account}}">{{$IMScData->account_name}} </option>
																	@endforeach
																@endif
														</select>
													</div>
													<div class="div3 cboxlabel RbiSanctBox"> 
														DAE/Apex/External Sanction No. <span class="reqindi">*</span>
													</div>
													<div class="div2 RbiSanctBox">
														<select name="cmb_rbi_sanction" id="cmb_rbi_sanction" class="tboxsmclass ChosenInput">
															<option value="">---------- Select ----------</option>
															@if(isset($data['RBIData']))
																	@foreach($data['RBIData'] as $RBIData)
																		<option value="{{$RBIData->rbi_sanction_id}}">{{$RBIData->rbi_sanction_no}} Dated: {{Helper::DisplayDateFormat($RBIData->rbi_date)}}</option>
																	@endforeach
																@endif
														</select>
													</div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>
											</fieldset>
												<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Transaction Details</legend>
												<div class="fieldbox-div">
													
													<div class="row smclearrow"></div>
													
													<table class="formtable" align="center" id="transaction_record_table" width="100%">
														<thead> 
															<tr>
																<th>Dr / Cr</th>
																<th>Transaction Details</th>
																<th>Debit (Rs.)</th>
																<th>Credit (Rs.)</th>
																<th>Narration</th>
																<th>Action</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td width="100px">
																	<select name="cmb_drcr_0" id="cmb_drcr_0" class="tboxsmclass ChosenInput">
																		<option value="">--Sel--</option>
																	</select>
																</td>
																<td width="420px">
																	<select name="cmb_trans_details_0" id="cmb_trans_details_0" class="tboxsmclass ChosenInput" style="width:100%">
																		<option value=""> -- Select --</option>
																		@if(isset($LedgerGroupData))
																		@foreach($LedgerGroupData as $LedgerGroup)

																		@if(isset($LedgerData[$LedgerGroup->ledger_group_id]))
																			@php
																			$Ledgers = $LedgerData[$LedgerGroup->ledger_group_id];
																			@endphp
																			@foreach($Ledgers as $AllLedgers)
																			<option value="{{ $AllLedgers->ledger_id }}" data-ledgergroup="{{ $AllLedgers->ledger_group_id }}" data-type="L">{{ $AllLedgers->ledger_acc_name }} - {{ $AllLedgers->ledger_group_name }}</option>
																			@endforeach
																		@else
																			<option value="{{ $LedgerGroup->ledger_group_id }}" data-ledgergroup="{{ $LedgerGroup->ledger_group_id }}" data-type="LG">{{ $LedgerGroup->ledger_group_name }}</option>
																		@endif

																		@endforeach
																		@endif

																		
																	</select>
																</td>
																<td width="150px"><input type="text" name="txt_debit_0" id="txt_debit_0" class="tboxsmclass" value=""></td>
																<td width="150px"><input type="text" name="txt_credit_0" id="txt_credit_0" class="tboxsmclass" value=""></td>
																<td><input type="text" name="txt_narration_0" id="txt_narration_0" class="tboxsmclass" value=""></td>
																
																<td align="center" width="50px"><i class="fa fa-plus-square sqadd ptr inp disable" id="transaction_add_record" style="font-size:24px;"></i></td>
															</tr>
														</tbody>
														<tfoot>
															<tr>
																<th colspan="2" style="text-align:right">Total Amount &emsp;</th>
																<td width="150px"><input type="text" name="txt_debit_total" id="txt_debit_total" class="tboxsmclass disable" value="" readonly></td>
																<td width="150px"><input type="text" name="txt_credit_total" id="txt_credit_total" class="tboxsmclass disable" value="" readonly></td>
																<th></th>
																<th></th>
															</tr>
														</tfoot>
													</table>	
													<!-- <fieldset class="fieldbox">
														<legend class="fieldbox-legend">Narration/Remarks</legend>
														<div class="fieldbox-div">
															
															<div class="row smclearrow"></div>
															<div class="div3 label">Narration/Remarks</div> 
															<textarea > </textarea>
																<textarea name="txt_cont_address" id="txt_cont_address" rows="4" class="tboxsmclass alphanumeric"></textarea>
																
															<div class="row smclearrow"></div>
															<div class="row smclearrow"></div>
														</div>
													</fieldset>	 -->
													

													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>

											<!-- <fieldset class="fieldbox">
												<legend class="fieldbox-legend">Budget Selection</legend>
												<div class="fieldbox-div">
													
													<div class="div1 cboxlabel BankBox">Object Head <span class="reqindi">*</span></div>
													<div class="div6 BankBox">
														<select name="cmb_object_head" id="cmb_object_head" class="tboxsmclass ChosenInput">
															<option value="">---------- Select ----------</option>
															@if(isset($data['ObjectHeads']))
																	@foreach($data['ObjectHeads'] as $ObjectHeads)
																		<option value="{{$ObjectHeads->object_head_group_id}}">{{$ObjectHeads->full_heads}} </option>
																	@endforeach
																@endif
														</select>
													</div>
													
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset> -->
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="table-container">
                                                <div class="table-wrapper">
                                                    <div class="section-header">
                                                        <span>Selected Budget Information</span>
                                                    </div>

                                                    <table class="attTable" id="BudgetInfoTable">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:200px;">Ledger Group</th>
                                                                <th style="width:200px;">Grant in Aid</th>
                                                                <th style="width:140px;">Object Head</th>
                                                                <th style="text-align: center;">Sanctioned Cost (&#8377;)</th>
																<th style="text-align: center;">Upto Date Claimed Amount (&#8377;)</th>
																<th style="text-align: center;">Upto Date Received Amount (&#8377;)</th>
																<th style="text-align: center;">Upto date Expenditure (&#8377;)</th>
																<th style="text-align: center;">Current Expenditure (&#8377;)</th>
																<th style="text-align: center;">Total Expenditure (&#8377;)</th>
																<th style="text-align: center;">Balance (&#8377;)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
											@php $AddUrl = 'roles.ViewRoleMaster'; @endphp										
											<div class="row">
												<div class="div12" align="center">
													<input type="hidden" name="hid_emptype_code" id="csrf-hid_emptype_code" value="@if(isset($EmpCode)){{$EmpCode}}@endif" />
													<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
												</div>		
											</div>
											<div class="row smclearrow"></div>  
										</div>
									<!-- </div >										 -->
								</div>
								<!-- ================ -->
								<!-- ================ -->
								</div>
								<!-- ============== -->
								
								<!-- ================== -->
							</div>                           
						</div>
					</blockquote>
				</div>
			</div>
		</div>
	</form>
</body>	
<script type="text/javascript" language="javascript">
	$(".ChosenInput").chosen();	
	//$("#txt_division").chosen();
	//$("#txt_role_group").chosen();
	$('#dataTable').DataTable({
		responsive: true,
		paging: true, 
	});
	var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var EmployeeTypeCode   	= $("#txt_emptype_code").val();
			var EmployeeTypeName   	= $("#txt_emptype_name").val();
			//var RoleGroup 		= $("#txt_role_group").val();

			if(EmployeeTypeCode == ""){
				BootstrapDialog.alert("Employee Type Code should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(EmployeeTypeName == ""){
				BootstrapDialog.alert("Employee Type Code should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}/* else if(RoleGroup == ""){
				BootstrapDialog.alert("User Group Name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			} */else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure want to Employee Type ?',
					closable: false, // <-- Default value is false
					draggable: false, // <-- Default value is false
					btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
					btnOKLabel: 'Ok', // <-- Default value is 'OK',
					callback: function(result) {
						if(result){
							KillEvent = 1;
							$("#btn_save").trigger( "click" );
						}else {
							KillEvent = 0;
						}
					}
				});
			}
		}
	});
	$('input[name="ch_transaction_type"]').change(function () {
		var VoucherType = $(this).val();
		var CreditOrDebit = $(this).attr('data-crde'); 
		$('#cmb_drcr_0').chosen('destroy');
		$('#cmb_drcr_0').children('option').remove();
		$('#txt_credit_0').prop('readonly', false).css('cursor', 'text');
		$('#txt_debit_0').prop('readonly', false).css('cursor', 'text');
		$('#txt_credit_0').removeClass('disable');
		$('#txt_debit_0').removeClass('disable');
		$('.BankBox').removeClass('hide');
		$('.RbiSanctBox').removeClass('hide');
		if(CreditOrDebit == 'DR'){
			$("#cmb_drcr_0").append('<option value="DR" selected>Dr</option>');
			$('#txt_credit_0').prop('readonly', true).css('cursor', 'not-allowed');
			$('#txt_credit_0').addClass('disable');
		}else if(CreditOrDebit == 'CR'){
			$("#cmb_drcr_0").append('<option value="CR" selected>Cr</option>');
			$('#txt_debit_0').prop('readonly', true).css('cursor', 'not-allowed');
			$('#txt_debit_0').addClass('disable');
		}else{
			$("#cmb_drcr_0").append('<option value="">--Sel--</option>');
			$("#cmb_drcr_0").append('<option value="CR">Cr</option>');
			$("#cmb_drcr_0").append('<option value="DR">Dr</option>');
		}

		if(VoucherType == 'RECEIPT'){
			$('.VrLabel1').text('Receipt No.');
			$('.VrLabel2').text('Receipt Date');
		}else{
			$('.VrLabel1').text('Vr. No.');
			$('.VrLabel2').text('Vr. Date');
			if(VoucherType == 'JOURNAL'){
				$('.BankBox').addClass('hide');
				$('.RbiSanctBox').addClass('hide');
			}else if(VoucherType == 'CONTRA'){
				$('.RbiSanctBox').addClass('hide');
			}
		}
		$('#cmb_drcr_0').chosen();
		
		//GetTransactionData(VoucherType);
		
		
	});
	var EduIndex = 1;
	$(document).on('click','#transaction_add_record',function(){ 
		var DebitCreditText 	= $('#cmb_drcr_0 option:selected').text();
		var DebitCreditValue 	= $('#cmb_drcr_0 option:selected').val();
		var TransDetText 		= $('#cmb_trans_details_0 option:selected').text();
		var TransDetId 			= $('#cmb_trans_details_0 option:selected').val();
		var DebitAmount 		= $('#txt_debit_0').val();
		var CreditAmount 		= $('#txt_credit_0').val();
		var Narration 			= $('#txt_narration_0').val();
		if(DebitCreditValue == "CR"){
			var CreditDisableClass 	= "";
			var DebitDisableClass 	= " disable";
			var CreditReadOnly 		= "";
			var DebitReadOnly 		= " readonly";
		}else if(DebitCreditValue == "DR"){
			var CreditDisableClass 	= " disable";
			var DebitDisableClass 	= "";
			var CreditReadOnly 		= " readonly";
			var DebitReadOnly 		= "";
		}else{
			var CreditDisableClass 	= "";
			var DebitDisableClass 	= "";
			var CreditReadOnly 		= "";
			var DebitReadOnly 		= "";
		}
		let tablestr = "";
		tablestr += "<tr>";
		tablestr += "<td><input type='hidden' name='txt_drcr_id[]' id='txt_drcr_id_id"+EduIndex+"' class='tboxsmclass' value='" +DebitCreditValue+ "'><input type='text' name='txt_drcr[]' id='txt_drcr_"+EduIndex+"' class='tboxsmclass' value='"+DebitCreditText+"'></td>";
		tablestr += "<td><input type='hidden' name='cmb_trans_details_id[]' id='cmb_trans_details_id_"+EduIndex+"' class='tboxsmclass' value='"+TransDetId+"'><input type='text' name='cmb_trans_details[]' id='cmb_trans_details_"+EduIndex+"' class='tboxsmclass' value='"+TransDetText+"'></td>";
		tablestr += "<td><input type='text' name='txt_debit[]' id='txt_debit_"+EduIndex+"' class='tboxsmclass"+DebitDisableClass+" CreditAmt' "+DebitReadOnly+" value='"+DebitAmount+"'></td>";
		tablestr += "<td><input type='text' name='txt_credit[]' id='txt_credit_"+EduIndex+"' class='tboxsmclass"+CreditDisableClass+" DebitAmt' "+CreditReadOnly+" value='"+CreditAmount+"'></td>";
		tablestr += "<td><input type='text' name='txt_narration[]' id='txt_narration_"+EduIndex+"' class='tboxsmclass' value='"+Narration+"'></td>";
		tablestr += "<td align='center'><i class='fa fa-times-circle sqdel ptr disable DeleteRow' id='DelRelationshipDetails' style='font-size:24px'></i></i></td>";
		tablestr += "</tr>";
		$("#transaction_record_table tbody").append(tablestr);
		GetBudgetData();
		//$('#cmb_drcr_0').chosen('destroy');
		//$('#cmb_drcr_0').val('');
		//$('#cmb_drcr_0').chosen();
		$('#txt_debit_0').val('');
		$('#txt_credit_0').val('');
		$('#cmb_trans_details_0').chosen('destroy');
		$('#cmb_trans_details_0').val('');
		$('#cmb_trans_details_0').chosen();
		$('#txt_narration_0').val('');

		//$('#txt_credit_0').prop('readonly', false).css('cursor', 'text');
		//$('#txt_debit_0').prop('readonly', false).css('cursor', 'text');
		//$('#txt_credit_0').removeClass('disable');
		//$('#txt_debit_0').removeClass('disable');
		
		FindTotalCreditDebit();
		EduIndex++;
	});
	$(document).on('click','.DeleteRow',function(){
		$(this).closest("tr").remove();
		FindTotalCreditDebit();
	}); 
	function FindTotalCreditDebit(){
		let TotalDebitAmt = 0;
		$("[name='txt_debit[]']").each(function() {
			TotalDebitAmt += parseFloat($(this).val()) || 0;
		});
		let TotalCreditAmt = 0;
		$("[name='txt_credit[]']").each(function() {
			TotalCreditAmt += parseFloat($(this).val()) || 0;
		});
		$("#txt_debit_total").val(TotalDebitAmt.toFixed(2));
		$("#txt_credit_total").val(TotalCreditAmt.toFixed(2));
	}
	function GetTransactionData(TransType){
		let TransactionType = $("input[name='ch_transaction_type']:checked").val();
		$("#cmb_trans_details_0").chosen("destroy");
		$('#cmb_trans_details_0').children('option:not(:first)').remove();
		$.ajax({
			type: 'POST', 
			url: "{{ route('Voucher.get-transaction-data') }}",
			data: { "_token": "{{ csrf_token() }}", 'TransactionType':TransactionType}, 
			success: function (data) {  
				if(data != ''){ 
					
					if(TransactionType == 'SALARY'){
						$.each(data, function(key, value){
							$("#cmb_trans_details_0").append('<option value="'+value.PayRollId+'" data-amount="'+value.PayRollAmt+'" data-masterid="'+value.PayRollId+'">Net Salary for the month of '+value.PayRollMonthYear+'</option>');
						});
					}else if(TransactionType == 'INTSALARY'){
						$.each(data, function(key, value){
							$("#cmb_trans_details_0").append('<option value="'+value.payroll_employee_id+'" data-amount="'+value.net_salary+'" data-masterid="'+value.payroll_master_id+'">ICNO. : '+value.emp_no+' || Name : '+value.emp_name+' (Salary for the month of '+value.payroll_month_year+')'+'</option>');
						});
					}
				}
				$("#cmb_trans_details_0").chosen();
			}
		});
	}

	$(document).on('change','#cmb_trans_details_0',function(){
		let TransactionType = $("input[name='ch_transaction_type']:checked").val();
		let TransactionGroup = $('#cmb_trans_details_0 option:selected').attr('data-type');
		let LedgerGroup = $('#cmb_trans_details_0 option:selected').attr('data-ledgergroup');
		
		let TransactionId = $(this).val();
		$.ajax({
			//type: 'POST', 
			type: 'GET', 
			url: "{{ route('Voucher.get-paydata-ledger-group') }}",
			//data: { "_token": "{{ csrf_token() }}", 'TransactionType':TransactionType, 'TransactionId':TransactionId, 'TransactionGroup': TransactionGroup, 'LedgerGroup': LedgerGroup}, 
			data: { 'TransactionType':TransactionType, 'TransactionId':TransactionId, 'TransactionGroup': TransactionGroup, 'LedgerGroup': LedgerGroup}, 
			success: function (data) {  
				if(data != ''){ 
					let MessageStr = '';
					if(TransactionType == 'SALARY'){
						
							MessageStr += '<div class="table-container">';
							MessageStr += '<div class="table-wrapper">';
							MessageStr += '<div class="section-header">';
							MessageStr += '<span>Selected Budget Information</span>';
							MessageStr += '</div>';

							MessageStr += '<table class="attTable" id="BudgetInfoTable">';
							MessageStr += '<thead>';
							MessageStr += '<tr>';
							MessageStr += '<th style="width:100px;"></th>';
							MessageStr += '<th style="width:100px;">SNo.</th>';
							MessageStr += '<th>Particulars</th>';
							MessageStr += '<th>Amount</th>';
							MessageStr += '</tr>';
							MessageStr += '</thead>';
							MessageStr += '<tbody>';

						let Sno = 1;
						$.each(data, function(key, value){
							MessageStr += '<tr>';
							MessageStr += '<td align="center"><input type="checkbox" name="ch_particulars_modal[]" id="ch_particulars_modal" data-amount="'+value.PayRollAmt+'" value="'+value.PayRollId+'"></td>';
							MessageStr += '<td align="center">'+Sno+'</td>';
							MessageStr += '<td>Net Salary for the month of '+value.PayRollMonthYear+'</td>';
							MessageStr += '<td>'+value.PayRollAmt+'</td>';
							MessageStr += '</tr>';
							//$("#cmb_trans_details_0").append('<option value="'+value.PayRollId+'" data-amount="'+value.PayRollAmt+'" data-masterid="'+value.PayRollId+'">Net Salary for the month of '+value.PayRollMonthYear+'</option>');
							Sno++;
						});
						
						MessageStr += '</tbody>';
						MessageStr += '</table>';
						MessageStr += '</div>';
						MessageStr += '</div>';
					}
					if(TransactionType == 'INTSALARY'){
							MessageStr += '<div class="table-container">';
							MessageStr += '<div class="table-wrapper">';
							MessageStr += '<div class="section-header">';
							MessageStr += '<span>Selected Budget Information</span>';
							MessageStr += '</div>';

							MessageStr += '<table class="attTable" id="BudgetInfoTable">';
							MessageStr += '<thead>';
							MessageStr += '<tr>';
							MessageStr += '<th style="width:100px;"></th>';
							MessageStr += '<th style="width:100px;">SNo.</th>';
							MessageStr += '<th>ICNO.</th>';
							MessageStr += '<th>Employee Name</th>';
							MessageStr += '<th>Designation</th>';
							MessageStr += '<th>Net Salary</th>';
							MessageStr += '</tr>';
							MessageStr += '</thead>';
							MessageStr += '<tbody>';

						let Sno = 1;
						$.each(data, function(key, value){
							MessageStr += '<tr>';
							MessageStr += '<td align="center"><input type="checkbox" name="ch_particulars_modal[]" id="ch_particulars_modal" data-amount="'+value.net_salary+'" value="'+value.payroll_employee_id+'"></td>';
							MessageStr += '<td align="center">'+Sno+'</td>';
							MessageStr += '<td>'+value.emp_no+'</td>';
							MessageStr += '<td>'+value.emp_name+'</td>';
							MessageStr += '<td>'+value.designation+'</td>';
							MessageStr += '<td>'+value.net_salary+'</td>';
							MessageStr += '</tr>';
							//$("#cmb_trans_details_0").append('<option value="'+value.PayRollId+'" data-amount="'+value.PayRollAmt+'" data-masterid="'+value.PayRollId+'">Net Salary for the month of '+value.PayRollMonthYear+'</option>');
							Sno++;
						});
						
						MessageStr += '</tbody>';
						MessageStr += '</table>';
						MessageStr += '</div>';
						MessageStr += '</div>';
					}
					if(MessageStr != ''){
						BootstrapDialog.show({
							title: 'Particulars Information for Salary',
							message: MessageStr,
							buttons: [{
								label: 'OK',
								action: function(dialog) {
									let TotalDebitAmt = 0;
									$("[name='ch_particulars_modal[]']").each(function() {
										if($(this).is(':checked')){
											TotalDebitAmt += parseFloat($(this).attr('data-amount')) || 0;
										}
									});
									$("#txt_debit_0").val(TotalDebitAmt.toFixed(2));
									dialog.close();
								}
							}, {
								label: 'Cancel',
								action: function(dialog) {
									dialog.close();
								}
							}]
						});
					}
				}
			}
		});
	});

	function GetBudgetData(){
		let TransactionType = $("input[name='ch_transaction_type']:checked").val();
		let TransactionGroup = $('#cmb_trans_details_0 option:selected').attr('data-type');
		
		let TransactionId = $('#cmb_trans_details_0').val();
		$.ajax({
			//type: 'POST', 
			type: 'GET',
			url: "{{ route('Voucher.get-transaction-mapping-data') }}",
			//data: { "_token": "{{ csrf_token() }}", 'TransactionType':TransactionType, 'TransactionId':TransactionId, 'TransactionGroup': TransactionGroup}, 
			data: { 'TransactionType':TransactionType, 'TransactionId':TransactionId, 'TransactionGroup': TransactionGroup, 'Page': 'VOUCHER'}, 
			success: function (data) {  
				if(data != ''){ 
					//BudgetInfoTable
					//$.each(data, function(key, value){
					let ObjectHeadStr = '';
					ObjectHeadStr = data.ObjectHeadName;
					if((data.ObjectHeadSubCataName != '')&&(data.ObjectHeadSubCataName != null)){
						ObjectHeadStr = data.ObjectHeadSubCataName+"/"+data.ObjectHeadName;
					}
					let UptoDateExpenditure = 0;
					let CurrentExpenditure = $("#txt_debit_total").val();
					let TotalExpenditure = Number(UptoDateExpenditure) + Number(CurrentExpenditure);
					let BalanceInReceivedAmt = Number(data.BudgetReceivedAmount) - Number(TotalExpenditure);
					if(Number(BalanceInReceivedAmt) < 0){
						var RowStyle = 'style="background:#F5496C; color:#000; font-weight:600"';
					}else{
						var RowStyle = '';
					}
					let TableStr = '<tr '+RowStyle+'>';
						TableStr += '<td '+RowStyle+'>'+data.LedgerGroupName+'</td>';
						TableStr += '<td '+RowStyle+'>'+data.GiaName+'</td>';
						TableStr += '<td '+RowStyle+'>'+ObjectHeadStr+'</td>';
						TableStr += '<td '+RowStyle+' align="right">'+data.BudgetSanctionedAmt+'</td>';
						TableStr += '<td '+RowStyle+' align="right">'+data.BudgetClaimAmount+'</td>';
						TableStr += '<td '+RowStyle+' align="right">'+data.BudgetReceivedAmount+'</td>';
						TableStr += '<td '+RowStyle+' align="right">'+UptoDateExpenditure+'</td>';
						TableStr += '<td '+RowStyle+' align="right">'+CurrentExpenditure+'</td>';
						TableStr += '<td '+RowStyle+' align="right">'+TotalExpenditure+'</td>';
						TableStr += '<td '+RowStyle+' align="right">'+BalanceInReceivedAmt+'</td>';
						TableStr += '</tr>'; 
						$("#BudgetInfoTable tbody").append(TableStr);
					//});
				}
			}
		});
	}

	/*$(document).on('change','#cmb_trans_details_0',function(){
		let TransactionType = $("input[name='ch_transaction_type']:checked").val();
		let TransactionGroup = $('#cmb_trans_details_0 option:selected').attr('data-type');
		
		let TransactionId = $(this).val();
		$.ajax({
			type: 'POST', 
			url: "{{ route('Voucher.get-transaction-mapping-data') }}",
			data: { "_token": "{{ csrf_token() }}", 'TransactionType':TransactionType, 'TransactionId':TransactionId, 'TransactionGroup': TransactionGroup}, 
			success: function (data) {  
				if(data != ''){ 
					//BudgetInfoTable
					//$.each(data, function(key, value){
					let TableStr = '<tr>';
						TableStr += '<td>'+data.LedgerGroupName+'</td>';
						TableStr += '<td>'+data.GiaName+'</td>';
						TableStr += '<td>'+data.BudgetHeadGroupName+'</td>';
						TableStr += '<td></td>';
						TableStr += '<td></td>';
						TableStr += '<td></td>';
						TableStr += '<td></td>';
						TableStr += '<td></td>';
						TableStr += '</tr>'; alert(TableStr);
						$("#BudgetInfoTable tbody").append(TableStr);
					//});
				}
			}
		});
	})*/

	$(document).on('change','#cmb_trans_details_0',function(){
		$("#txt_debit_0").val('');
		let TransactionType = $("input[name='ch_transaction_type']:checked").val();
		if((TransactionType == 'SALARY')||(TransactionType == 'INTSALARY')){
			var NetAmount = $('#cmb_trans_details_0 option:selected').attr('data-amount');
			$("#txt_debit_0").val(NetAmount);
		}
	});

</script>
@endsection
