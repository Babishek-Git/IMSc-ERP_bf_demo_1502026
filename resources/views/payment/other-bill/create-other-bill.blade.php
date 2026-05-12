@extends('layouts.dashboard-master')
@section('content')
@include('layouts.partials.messages')

@php 
if(isset($PaymentData)){ 
    $PaymentId      = collect($PaymentData)->pluck('payment_id')->first();
    $BillAmount     = collect($PaymentData)->pluck('gross_amount')->first();
    $RecoveryAmount = collect($PaymentData)->pluck('recovery_amount')->first();
    $NetAmount      = collect($PaymentData)->pluck('net_amount')->first();
} 
if(isset($EmpBankData)){
    $EmpBankAccNo        = collect($EmpBankData)->pluck('account_no')->first();
    $EmpBankId           = collect($EmpBankData)->pluck('bank_id')->first();
    $EmpBankBranchId     = collect($EmpBankData)->pluck('branch_id')->first();
    $EmpBankIfsc         = collect($EmpBankData)->pluck('ifsc_code')->first();
    $EmpBankBranchAddr   = collect($EmpBankData)->pluck('branch_addr1')->first();
    $EmpBankName         = collect($EmpBankData)->pluck('bank_name')->first();
}
if(isset($EmpData)){ 
    $EmpName        = collect($EmpData)->pluck('emp_name_payslip')->first();
    $EmpGroupType   = collect($EmpData)->pluck('emp_group_name')->first();
    $EmpGroup       = collect($EmpData)->pluck('group')->first();
    $EmpDivision    = collect($EmpData)->pluck('division')->first();
    $EmpSection     = collect($EmpData)->pluck('section')->first();
    $EmpDesignation = collect($EmpData)->pluck('designation_name')->first();
    $EmpNo          = collect($EmpData)->pluck('emp_no')->first();
    $EmpIcNo        = collect($EmpData)->pluck('ic_no')->first();
    $EmpPanNo       = collect($EmpData)->pluck('emp_pan_no')->first();
}
if(isset($ModuleData)){ 
    $PaymentFor      = collect($ModuleData)->pluck('wf_module_name')->first();
}



$TotalGrossAmount = 0; $TotalDeductions = 0; $TotalNetAmount = 0;

$UptoDtExpenditureAmt = 0;
if(isset($BudgetObjectHeadData)){
    $LedgerId               = $BudgetObjectHeadData['LedgerId'] ?? NULL;
    $LedgerName             = $BudgetObjectHeadData['LedgerName'] ?? NULL;
    $LedgerGroupId          = $BudgetObjectHeadData['LedgerGroupId'] ?? NULL;
    $LedgerGroupName        = $BudgetObjectHeadData['LedgerGroupName'] ?? NULL;
    $ObjectHeadId           = $BudgetObjectHeadData['ObjectHeadId'] ?? NULL;
    $ObjectHeadSubCataId    = $BudgetObjectHeadData['ObjectHeadSubCataId'] ?? NULL;
    $ProjectId              = $BudgetObjectHeadData['ProjectId'] ?? NULL;
    $GiaId                  = $BudgetObjectHeadData['GiaId'] ?? NULL;
    $GiaName                = $BudgetObjectHeadData['GiaName'] ?? NULL;
    $ObjectHeadName         = $BudgetObjectHeadData['ObjectHeadName'] ?? NULL;
    $ObjectHeadSubCataName  = $BudgetObjectHeadData['ObjectHeadSubCataName'] ?? NULL;
    $BudgetSanctionedAmt    = $BudgetObjectHeadData['BudgetSanctionedAmt'] ?? NULL;
    $BudgetClaimAmount      = $BudgetObjectHeadData['BudgetClaimAmount'] ?? NULL;
    $BudgetReceivedAmount   = $BudgetObjectHeadData['BudgetReceivedAmount'] ?? NULL;
    $ObjectHeadLedgerMapId  = $BudgetObjectHeadData['ObjectHeadLedgerMapId'] ?? NULL;
    $UptoDtExpenditureAmt   = $BudgetObjectHeadData['UptoDtExpenditureAmt'] ?? NULL;
}
$OptionStr = '';
if(isset($AllObectHead)){
    $ObectHeadSubCataGrpData = $AllObectHeadSubCataGrpData ?? [];
    if(count($AllObectHead) > 0){
        foreach($AllObectHead as $AllObectHeadKey => $AllObectHeadValue){
            $IsSubCata = 0;
            if(isset($ObectHeadSubCataGrpData[$AllObectHeadValue->object_head_id])){
                $ObjectHeadSubCata = $ObectHeadSubCataGrpData[$AllObectHeadValue->object_head_id];
                if(filled($ObjectHeadSubCata)){
                    if(count($ObjectHeadSubCata) > 0){
                        $IsSubCata = 1;
                        foreach($ObjectHeadSubCata as $ObjectHeadSubCataKey => $ObjectHeadSubCataValue){
                            $OptionStr .= '<option value="'.$ObjectHeadSubCataValue->oh_sub_cata_id.'" data-mode="OHSC" data-ohid="'.$ObjectHeadSubCataValue->object_head_id.'" data-subcata="'.$ObjectHeadSubCataValue->oh_sub_cata_id.'">'.$ObjectHeadSubCataValue->oh_sub_cata_name.'</option>';
                        }
                    }
                }
            }
            if($IsSubCata == 0){
                $OptionStr .= '<option value="'.$AllObectHeadValue->object_head_id.'" data-mode="OH" data-ohid="'.$AllObectHeadValue->object_head_id.'" data-subcata="">'.$AllObectHeadValue->object_head_name.'</option>';
            }
        }
    }
}
//dd($OptionStr);
$DeductionArr = [];
$ExeTotalGrossAmount = 0;
$ExeTotalNetAmount = 0;
@endphp

<form action="" method="post" enctype="multipart/form-data" name="form">
    <div class="content">
        <div class="title"></div>
        <div class="container_12">
            <div class="grid_12">
                <blockquote class="bq1" style="overflow:auto">
                    <div class="container">
                        <div class="row plr">
                            <div class="div12 mbtable">

                                {{-- ── Page Title ── --}}
                                <div class="row">
                                    <div class="div12" style="margin-top:0px;">
                                        <div class="row divhead" align="center">Interim / Other Bill Payment</div>
                                    </div>
                                </div>

                                <div class="row innerdiv">
                                    <div class="row" align="right">
                                        
                                        @php 
                                        $BackUrl = "payment.other-payment-creation-list";
                                        @endphp
                                        <button type="button" id="Back" name="Back" onclick="window.location='{{ route($BackUrl)}}'" class="backbutton">Back</button>
                                        <button type="submit" id="SaveApplication"
                                                name="SaveApplication" class="step-btn" value="Save">
                                            Save Payment
                                        </button>
                                    </div>
                                    <div class="row">
                                        <div class="form-step active">

                                            {{-- ── Basic Information Fieldset ── --}}
                                            <fieldset class="fieldbox">
                                                <legend class="fieldbox-legend" style="margin-top:0px">Payee Information</legend>
                                                <div class="fieldbox-div">

                                                    
                                                    <div class="div2 label">Payment For</div>
                                                    <div class="div6">
                                                        <input type="text" name="txt_payment_for" id="txt_payment_for" class="tboxsmclass disable" value="{{ $PaymentFor ?? '' }}" readonly>
                                                        <input type="hidden" name="txt_payment_id" id="txt_payment_id" class="tboxsmclass disable" value="{{ $PaymentId ? encrypt($PaymentId) : '' }}" readonly>
                                                        <input type="hidden" name="txt_oh_ledger_map_id" id="txt_oh_ledger_map_id" class="tboxsmclass disable" value="{{ $ObjectHeadLedgerMapId ? encrypt($ObjectHeadLedgerMapId) : '' }}" readonly>
                                                        
                                                    </div>

                                                    <div class="div2 label pd-l-20">ICNO.</div>
                                                    <div class="div2">
                                                        <input type="text" name="txt_emp_icno" id="txt_emp_icno" class="tboxsmclass disable" value="{{ $EmpNo ?? '' }}" readonly>
                                                    </div>

                                                    <div class="div2 label">Name of the Payee</div>
                                                    <div class="div6">
                                                        <input type="text" name="txt_emp_name" id="txt_emp_name" class="tboxsmclass disable" value="{{ $EmpName ?? '' }}" readonly>
                                                    </div>
                                                    <div class="div2 label pd-l-20">Designation</div>
                                                    <div class="div2">
                                                        <input type="text" name="txt_emp_designation" id="txt_emp_designation" class="tboxsmclass disable" value="{{ $EmpDesignation ?? '' }}" readonly>
                                                    </div>
                                                    

                                                    <div class="div2 label">Group</div>
                                                    <div class="div2">
                                                        <input type="text" name="txt_emp_group" id="txt_emp_group" class="tboxsmclass disable" value="{{ $EmpGroup ?? '' }}" readonly>
                                                    </div>
                                                    <div class="div2 label pd-l-20">Division</div>
                                                    <div class="div2">
                                                        <input type="text" name="txt_emp_division" id="txt_emp_division" class="tboxsmclass disable" value="{{ $EmpDivision ?? '' }}" readonly>
                                                    </div>
                                                    
                                                    <div class="div2 label pd-l-20">Section</div>
                                                    <div class="div2">
                                                        <input type="text" name="txt_emp_section" id="txt_emp_section" class="tboxsmclass disable" value="{{ $EmpSection ?? '' }}" readonly>
                                                    </div>
                                                    <div class="row smclearrow"></div>

                                                    
                                                    <!-- <div class="div2 label pd-l-20">Payment Mode</div>
                                                    <div class="div2">
                                                        <input type="text" name="txt_gross_amount" id="txt_gross_amount" class="tboxsmclass disable" value="{{ $TotalGrossAmount ?? '' }}" readonly>
                                                    </div> -->
                                                    

                                                    <div class="row smclearrow"></div>

                                                    
                                                    <div class="row smclearrow"></div>
                                                </div>
                                            </fieldset>

                                            <div class="row smclearrow"></div>
                                            <div class="row smclearrow"></div>

                                            <fieldset class="fieldbox">
                                                <legend class="fieldbox-legend">Bank Information</legend>
                                                <div class="fieldbox-div">
                                                    <div class="div2 label">Bank Name</div>
                                                    <div class="div2">
                                                        <input type="text" name="txt_emp_bank_name" id="txt_emp_bank_name" class="tboxsmclass disable" value="{{ $EmpBankName ?? '' }}" readonly>
                                                        <input type="hidden" name="txt_emp_bank_id" id="txt_emp_bank_id" class="tboxsmclass disable" value="{{ $EmpBankId ?? '' }}" readonly>
                                                    </div>
                                                    <div class="div2 label pd-l-20">Branch Name</div>
                                                    <div class="div2">
                                                        <input type="text" name="txt_emp_bank_branch_name" id="txt_emp_bank_branch_name" class="tboxsmclass disable" value="{{ $EmpBankBranchAddr ?? '' }}" readonly>
                                                        <input type="hidden" name="txt_emp_bank_branch_id" id="txt_emp_bank_branch_id" class="tboxsmclass disable" value="{{ $EmpBankBranchId ?? '' }}" readonly>
                                                    </div>
                                                    <div class="div2 label pd-l-20">IFSC Code</div>
                                                    <div class="div2">
                                                        <input type="text" name="txt_emp_bank_ifsc" id="txt_emp_bank_ifsc" class="tboxsmclass disable" value="{{ $EmpBankIfsc ?? '' }}" readonly>
                                                    </div>
                                                    
                                                    
                                                    <div class="row smclearrow"></div>

                                                    <div class="div2 label">Account No.</div>
                                                    <div class="div2">
                                                        <input type="text" name="txt_emp_bank_acc_no" id="txt_emp_bank_acc_no" class="tboxsmclass disable" value="{{ $EmpBankAccNo ?? '' }}" readonly>
                                                    </div>
                                                    <div class="div2 label pd-l-20">PAN No.</div>
                                                    <div class="div2">
                                                        <input type="text" name="txt_emp_pan_no" id="txt_emp_pan_no" class="tboxsmclass disable" value="{{ $EmpPanNo ?? '' }}" readonly>
                                                    </div>

                                                    <div class="row smclearrow"></div>

                                                    
                                                    <div class="row smclearrow"></div>
                                                </div>
                                            </fieldset>

                                            <div class="row smclearrow"></div>
                                            <div class="row smclearrow"></div>

                                            {{-- ── Object Head Information Table ── --}}
                                            <div class="table-container">
                                                <div class="table-wrapper" style="margin-bottom:10px;">
                                                    <div class="section-header">
                                                        <span>Bill & Budget Information</span>
                                                    </div>
                                                    <table class="attTable">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="6">
                                                                    <div class="row smclearrow"></div>
                                                                    <div class="div2 label no-margin">Bill Processing No.</div>
                                                                    <div class="div2 no-margin">
                                                                        <input type="text" name="txt_bill_no" id="txt_bill_no" class="tboxsmclass" value="">
                                                                        <input type="hidden" name="txt_bill_date" id="txt_bill_date" class="tboxsmclass datepicker" value="">
                                                                    </div>
                                                                    <div class="div2 label no-margin pd-l-20">Bill Gross Amount</div>
                                                                    <div class="div1 no-margin">
                                                                        <input type="text" name="txt_bill_gross_amount" id="txt_bill_gross_amount" class="tboxsmclass" value="{{ $BillAmount ?? '' }}">
                                                                    </div>
                                                                    <div class="div1 label no-margin pd-l-20">Deductions</div>
                                                                    <div class="div1 no-margin">
                                                                        <input type="text" name="txt_bill_deduction_amount" id="txt_bill_deduction_amount" class="tboxsmclass" value="0">
                                                                    </div>
                                                                    <div class="div1 label no-margin pd-l-20">Net Amount</div>
                                                                    <div class="div2 no-margin">
                                                                        <input type="text" name="txt_bill_net_amount" id="txt_bill_net_amount" class="tboxsmclass" value="{{ $BillAmount ?? '' }}">
                                                                    </div>
                                                                    <div class="row smclearrow"></div>
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th style="width:140px;">Object Head</th>
                                                                <th style="width:200px;">Ledger Name</th>
                                                                <th nowrap="">Upto Date Received (&#8377;)</th>
                                                                <th nowrap="">Upto Date Expenditure (&#8377;)</th>
                                                                <th nowrap="">Current Expenditure (&#8377;)</th>
                                                                <th nowrap="">Balance (&#8377;)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr id="inputRow">
                                                                <td width="350px">
                                                                    {{ collect([$ObjectHeadSubCataName, $ObjectHeadName])->filter()->implode(' / ') }}
                                                                    <input type="hidden" name="txt_object_head_id" id="txt_object_head_id" value="{{ isset($ObjectHeadId) ? $ObjectHeadId : '' }}">
                                                                    <input type="hidden" name="txt_object_head_subcata_id" id="txt_object_head_subcata_id" value="{{ isset($ObjectHeadSubCataId) ? $ObjectHeadSubCataId : '' }}">
                                                                    <input type="hidden" name="txt_project_id" id="txt_project_id" value="{{ isset($ProjectId) ? $ProjectId : '' }}">
                                                                    <input type="hidden" name="txt_gia_id" id="txt_gia_id" value="{{ isset($GiaId) ? $GiaId : '' }}">
                                                                </td>
                                                                <td>
                                                                    <!-- {{ collect([$LedgerName, $LedgerGroupName])->filter()->implode(' / ') }} -->
                                                                    {{ $LedgerName }}
                                                                    <input type="hidden" name="txt_ledger_id" id="txt_ledger_id" value="{{ isset($LedgerId) ? $LedgerId : '' }}">
                                                                    <input type="hidden" name="txt_ledger_group_id" id="txt_ledger_group_id" value="{{ isset($LedgerGroupId) ? $LedgerGroupId : '' }}">
                                                                </td>
                                                                
                                                                <td align="right">{{ $BudgetReceivedAmount ?? '' }}</td>
                                                                <td align="right">{{ $UptoDtExpenditureAmt ?? '' }}</td>
                                                                <td align="right">
                                                                     
                                                                    <input type="text" class="tboxsmclass" id="txt_expenditure_amt" name="txt_expenditure_amt" value="{{ $BillAmount ?? '' }}" readonly>
                                                                </td>
                                                                <td align="right">
                                                                    @php $BalanceAmt = round($BudgetReceivedAmount - $UptoDtExpenditureAmt - $BillAmount); @endphp
                                                                    {{ $BalanceAmt ?? '' }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        
                                                    </table>

                                                    {{-- Eligibility warning panel --}}
                                                    <div id="eligibilityWarning"
                                                         style="display:none; color:#c0392b; padding:8px; margin-top:6px; background:#fdecea; border-radius:4px;">
                                                    </div>

                                                </div>
                                            </div>

                                            
                                            {{-- ── Deductions Object Head Information Table ── --}}
                                            <!-- <div class="table-container">
                                                <div class="table-wrapper">
                                                    <div class="section-header">
                                                        <span>Deductions - Budget & Object Head Information</span>
                                                    </div>

                                                    <table class="attTable" id="deduction_table">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:300px;">Deduction Name</th>
                                                                <th style="width:200px;" nowrap="">Deduction Amount (&#8377;)</th>
                                                                <th>Object Head</th>
                                                                <th style="width:80px">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="attendanceTableBody">
                                                            <tr id="inputRow">
                                                                <td align="center">
                                                                    <select name="cmb_recovery_0" id="cmb_recovery_0" class="tboxsmclass ChosenInput">
                                                                        <option value=""> -- Select --</option>
                                                                        @if(isset($RecoveryData))
                                                                        @foreach($RecoveryData as $RecoveryDataKey => $RecoveryDataValue)
                                                                        <option value="{{ $RecoveryDataValue->recovery_code }}">{{ $RecoveryDataValue->recovery_name }}</option>
                                                                        @endforeach
                                                                        @endif
                                                                    </select>
                                                                </td>
                                                                <td align="center"><input type="text" class="tboxsmclass" id="txt_deduction_amt_0" name="txt_deduction_amt_0" value=""></td>
                                                                <td align="center">
                                                                    <select name="cmb_deduct_object_head_0" id="cmb_deduct_object_head_0" class="tboxsmclass ChosenInput">
                                                                        <option value=""> ---- Select ----</option>
                                                                        {!! $OptionStr ?? '' !!}
                                                                    </select>
                                                                </td>
																<td align="center"><i class="fa fa-plus-square sqadd ptr inp disable" id="deduction_add_record" style="font-size:24px;"></i></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div> -->

                                        </div>{{-- /form-step --}}
                                    </div>

                                    
                                </div>{{-- /innerdiv --}}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="div12" align="center">
                            <input type="hidden" name="txt_process_mode" id="txt_process_mode" value="{{ isset($ProcessMode) ? encrypt($ProcessMode) : '' }}">
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
    .tooltiptext {
        position: fixed;
        z-index: 9999; /* 🔥 increase */
    }
    .table-container {
        overflow: visible !important;
    }
    table.attTable td{
        font-weight:500;
    }
</style>

<script>

    $(".ChosenInput").chosen();
    var KillEvent = 0;
	$("body").on("click","#SaveApplication", function(event){
		if(KillEvent == 0){
			var ExpAmount  = $('#txt_expenditure_amt').val();//$('input[name="ch_emp_group[]"]:checked').length;
			if((ExpAmount == 0)||(ExpAmount == '')) {
				BootstrapDialog.alert("Invlaid Current Expenditure Amount");
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
							$("#SaveApplication").trigger( "click" );
						}else {
							KillEvent = 0;
						}
					}
				});
			}
		}
	});
    var ObjHeadIndex = 0;
    $(document).on('click','#deduction_add_record',function(){
		var RecoveryText 		= $('#cmb_recovery_0 option:selected').text();
		var RecoveryId 	        = $('#cmb_recovery_0 option:selected').val();
		var ObjectHeadtext 		= $('#cmb_deduct_object_head_0 option:selected').text();
		var ObjectHeadValue 	= $('#cmb_deduct_object_head_0 option:selected').val();
        var ObjectHeadMode 		= '';//$('#cmb_deduct_object_head_0 option:selected').attr('data-mode');
        var ObjectHeadId 		= ObjectHeadValue;//$('#cmb_deduct_object_head_0 option:selected').attr('data-ohid');
        var ObjectHeadSubCataId = '';//$('#cmb_deduct_object_head_0 option:selected').attr('data-subcata');
		var DeductionAmt 		= $('#txt_deduction_amt_0').val();
		let tablestr = "";
		tablestr += "<tr>";
		tablestr += "<td><input type='hidden' name='txt_recovery[]' id='txt_recovery_"+ObjHeadIndex+"' class='tboxsmclass' value='" +RecoveryId+ "'><input type='text' name='txt_recovery_name[]' id='txt_recovery_name_"+ObjHeadIndex+"' class='tboxsmclass' value='"+RecoveryText+"'></td>";
		tablestr += "<td><input type='text' name='txt_deduction_amt[]' id='txt_deduction_amt_"+ObjHeadIndex+"' class='tboxsmclass DeductionAmt' value='"+DeductionAmt+"'></td>";
        tablestr += "<td><input type='hidden' name='txt_object_head[]' id='txt_object_head_"+ObjHeadIndex+"' class='tboxsmclass' value='" +ObjectHeadId+ "'><input type='hidden' name='txt_object_head_sub_cata[]' id='txt_object_head_sub_cata_"+ObjHeadIndex+"' class='tboxsmclass' value='" +ObjectHeadSubCataId+ "'><input type='hidden' name='txt_object_head_mode[]' id='txt_object_head_mode_"+ObjHeadIndex+"' class='tboxsmclass' value='" +ObjectHeadMode+ "'><input type='text' name='txt_object_head_name[]' id='txt_object_head_name_"+ObjHeadIndex+"' class='tboxsmclass' value='"+ObjectHeadtext+"'></td>";
		tablestr += "<td align='center'><i class='fa fa-times-circle sqdel ptr disable DeleteRow' id='DelDeduction' style='font-size:24px'></i></i></td>";
        tablestr += "</tr>";
		$("#deduction_table").append(tablestr);
		$('#cmb_recovery_0').chosen('destroy');
		$('#cmb_recovery_0').val('');
		$('#cmb_recovery_0').chosen();
		$('#txt_deduction_amt_0').val('');
		$('#cmb_deduct_object_head_0').chosen('destroy');
		$('#cmb_deduct_object_head_0').val('');
		$('#cmb_deduct_object_head_0').chosen();
        CalculateDeduction();
		ObjHeadIndex++;
	});
    $(document).on('click','.DeleteRow',function(){
		$(this).closest("tr").remove();
        CalculateDeduction();
	}); 
    $(document).on('change','#txt_deduction_amt_0',function(){ 
		var DeductionAmt = $(this).val();
        var GrossAmount = $("#txt_bill_gross_amount").val();
        var TotalDeductionAmt = Number(DeductionAmt);
        $('.DeductionAmt').each(function() {
            //var val = parseFloat($(this).val()) || 0;
            var val = Number($(this).val());
            TotalDeductionAmt += val;
        });
        var NetAmount = Number(GrossAmount) - Number(TotalDeductionAmt); 
        if(NetAmount < 0){
            BootstrapDialog.alert('Net Amount should not be less than 0');
            $(this).val('');
        }
	}); 
    
    
    function CalculateDeduction(){
        var TotalDeductionAmt = 0;
        var GrossAmount = $("#txt_bill_gross_amount").val();
        $('.DeductionAmt').each(function() {
            //var val = parseFloat($(this).val()) || 0;
            var val = Number($(this).val());
            TotalDeductionAmt += val;
        });
        $("#txt_bill_deduction_amount").val(TotalDeductionAmt);
        var NetAmount = Number(GrossAmount) - Number(TotalDeductionAmt);
        $("#txt_bill_net_amount").val(NetAmount);
        
    }


    $(document).on('change','#cmb_bill_ledger',function(){
        let TransactionType = 'PO';
		let TransactionGroup = $('#cmb_bill_ledger option:selected').attr('data-type');
		let LedgerGroup = $('#cmb_bill_ledger option:selected').attr('data-ledgergroup');
		let TransactionId = $(this).val();
        $("#txt_ledger_id").val('');
        $("#txt_balance_amt").val('');
        $("#txt_oh_ledger_map_id").val('');
        $("#txt_upto_expenditure_amt").val('');
        $("#txt_received_amt").val('');
        $("#txt_object_head_id").val('');
        $("#cmb_bill_object_head").chosen('destroy');
        $("#cmb_bill_object_head").val('');
        $("#cmb_bill_object_head").chosen();
        $("#txt_ledger_group_id").val('');
        $("#txt_object_head_subcata_id").val('');
        $("#txt_project_id").val('');
        $("#txt_gia_id").val('');
		$.ajax({
			//type: 'POST', 
			type: 'GET',
			url: "{{ route('Voucher.get-transaction-mapping-data') }}",
			//data: { "_token": "{{ csrf_token() }}", 'TransactionType':TransactionType, 'TransactionId':TransactionId, 'TransactionGroup': TransactionGroup}, 
			data: { 'TransactionType':TransactionType, 'TransactionId':TransactionId, 'TransactionGroup': TransactionGroup, 'Page': 'VOUCHER'}, 
			success: function (data) {  
				if(data != ''){  console.log(data);
					let LedgerId = data.LedgerId;
                    let LedgerName = data.LedgerName;
                    let ObjectHeadLedgerMapId = data.ObjectHeadLedgerMapId;
                    let LedgerGroupId = data.LedgerGroupId;
                    let LedgerGroupName = data.LedgerGroupName;
                    let ObjectHeadId = data.ObjectHeadId;
                    let ObjectHeadSubCataId = data.ObjectHeadSubCataId;
                    let ProjectId = data.ProjectId;
                    let GiaId = data.GiaId;
                    let GiaName = data.GiaName;
                    let ObjectHeadName = data.ObjectHeadName;
                    let ObjectHeadSubCataName = data.ObjectHeadSubCataName;
                    let BudgetSanctionedAmt = data.BudgetSanctionedAmt;
                    let BudgetClaimAmount = data.BudgetClaimAmount;
                    let BudgetReceivedAmount = data.BudgetReceivedAmount;
                    $("#txt_ledger_id").val(LedgerId);
                    $("#txt_ledger_group_id").val(LedgerGroupId);
                    $("#txt_received_amt").val(BudgetReceivedAmount);
                    $("#txt_object_head_id").val(ObjectHeadId);
                    $("#txt_object_head_subcata_id").val(ObjectHeadSubCataId);
                    $("#txt_project_id").val(ProjectId);
                    $("#txt_gia_id").val(GiaId);
                    $("#cmb_bill_object_head").chosen('destroy');
                    $("#cmb_bill_object_head").val(ObjectHeadId);
                    $("#cmb_bill_object_head").chosen();
                    let UptoDateExpenditure = 0;
                    $("#txt_upto_expenditure_amt").val(UptoDateExpenditure);
                    let ExpenditureAmt = $("#txt_expenditure_amt").val();
                    let TotalExpenditure = Number(UptoDateExpenditure) + Number(ExpenditureAmt)
                    let BalanceAmt = Number(BudgetReceivedAmount) - Number(TotalExpenditure);
                    $("#txt_balance_amt").val(BalanceAmt);
                    $("#txt_oh_ledger_map_id").val(ObjectHeadLedgerMapId);
				}
			}
		});
	});

</script>
@endsection