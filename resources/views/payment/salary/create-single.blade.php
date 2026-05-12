@extends('layouts.dashboard-master')
@section('content')
@include('layouts.partials.messages')

@php 
/*if(isset($PaymentData)){
    $EmpGroupTypeName   = collect($PaymentData)->pluck('emp_group_name')->first();
    $EmpGroupTypeCode   = collect($PaymentData)->pluck('emp_group_code')->first();
    $EmpGroupTypeId     = collect($PaymentData)->pluck('pay_emp_group_type')->first();
    $PaymentId          = collect($PaymentData)->pluck('payment_id')->first();
}*/

if(isset($PayrollData)){
    $PayMonthYear       = collect($PayrollData)->pluck('payroll_month_year')->first();
    $PayrollMasterId    = collect($PayrollData)->pluck('payroll_master_id')->first();
    $TotalEmployees     = collect($PayrollData)->pluck('total_employees')->first();
    $EmpGroupTypeName   = collect($PayrollData)->pluck('emp_group_name')->first();
    $EmpGroupTypeCode   = collect($PayrollData)->pluck('emp_group_code')->first();
    $EmpGroupTypeId     = collect($PayrollData)->pluck('emp_group_type')->first();
}
$TotalGrossAmount = 0; $TotalDeductions = 0; $TotalNetAmount = 0;
if(isset($PayEmployeeData)){
    $TotalGrossAmount   = collect($PayEmployeeData)->sum('gross_salary');
    $TotalDeductions    = collect($PayEmployeeData)->sum('total_deductions');
    $TotalNetAmount     = collect($PayEmployeeData)->sum('net_salary');
    $PayrollEmpId       = collect($PayEmployeeData)->pluck('payroll_employee_id')->first(); 
    $PayrollEmpNo       = collect($PayEmployeeData)->pluck('emp_no')->first(); 
}

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
    $UptoDtExpenditureAmt   = $BudgetObjectHeadData['UptoDtExpenditureAmt'] ?? 0;
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
                                        <div class="row divhead" align="center">Salary / Interim Salary Payment</div>
                                    </div>
                                </div>

                                <div class="row innerdiv">
                                    <div class="row" align="right">
                                        
                                        @php 
                                        $BackUrl = "payment.salary-payment-creation-list";
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
                                                <legend class="fieldbox-legend">Pay Information</legend>
                                                <div class="fieldbox-div">

                                                    
                                                    <div class="div2 label">Pay Salary For</div>
                                                    <div class="div2">
                                                        <input type="text" name="txt_emp_group_type_name" id="txt_emp_group_type_name" class="tboxsmclass disable" value="{{ $EmpGroupTypeName ?? '' }}" readonly>
                                                        <input type="hidden" name="txt_emp_group_type" id="txt_emp_group_type" class="tboxsmclass disable" value="{{ isset($EmpGroupTypeId) ? encrypt($EmpGroupTypeId) : '' }}" readonly>
                                                        <input type="hidden" name="txt_payroll_emp_id" id="txt_payroll_emp_id" class="tboxsmclass disable" value="{{ isset($PayrollEmpId) ? encrypt($PayrollEmpId) : '' }}" readonly>
                                                        <input type="hidden" name="txt_payroll_emp_no" id="txt_payroll_emp_no" class="tboxsmclass disable" value="{{ isset($PayrollEmpNo) ? encrypt($PayrollEmpNo) : '' }}" readonly>
                                                        <input type="hidden" name="txt_oh_ledger_map_id" id="txt_oh_ledger_map_id" class="tboxsmclass disable" value="{{ isset($ObjectHeadLedgerMapId) ? encrypt($ObjectHeadLedgerMapId) : '' }}" readonly>
                                                    </div>

                                                    <div class="div2 label pd-l-20">Pay Salary Month & Year</div>
                                                    <div class="div2">
                                                        <input type="text" name="txt_payslip_name" id="txt_payslip_name" class="tboxsmclass disable" value="{{ $PayMonthYear ?? '' }}" readonly>
                                                        <input type="hidden" name="txt_payslip_month" id="txt_payslip_month" class="tboxsmclass disable" value="{{ $PayMonthYear ?? '' }}" readonly>
                                                        <input type="hidden" name="txt_payslip_year" id="txt_payslip_year" class="tboxsmclass disable" value="{{ $PayMonthYear ?? '' }}" readonly>
                                                    </div>
                                                    <div class="div2 label pd-l-20">No. of Employees</div>
                                                    <div class="div2">
                                                        <input type="text" name="txt_no_of_employee" id="txt_no_of_employee" class="tboxsmclass disable" value="{{ $TotalEmployees ?? '' }}" readonly>
                                                    </div>

                                                    <div class="row smclearrow"></div>
                                                    <div class="div2 label">Gross Amount</div>
                                                    <div class="div2">
                                                        <input type="text" name="txt_gross_amount" id="txt_gross_amount" class="tboxsmclass disable" value="{{ $TotalGrossAmount ?? '' }}" readonly>
                                                    </div>

                                                    <div class="div2 label pd-l-20">Total Deductions</div>
                                                    <div class="div2">
                                                        <input type="text" name="txt_total_deduction" id="txt_total_deduction" class="tboxsmclass disable" value="{{ $TotalDeductions ?? '' }}" readonly>
                                                    </div>
                                                    <div class="div2 label pd-l-20">Total Net Amount</div>
                                                    <div class="div2">
                                                        <input type="text" name="txt_net_amount" id="txt_net_amount" class="tboxsmclass disable" value="{{ $TotalNetAmount ?? '' }}" readonly>
                                                    </div>
                                                    <div class="row smclearrow"></div>

                                                    <div class="div2 label">Bill Processing No.</div>
                                                    <div class="div2">
                                                        <input type="text" name="txt_bill_no" id="txt_bill_no" class="tboxsmclass disable" value="" readonly>
                                                        <input type="hidden" name="txt_bill_date" id="txt_bill_date" class="tboxsmclass datepicker disable" value="" readonly>
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
                                                        <span>Employee Salary / Pay Information</span>
                                                    </div>

                                                    <table class="attTable">
                                                        <thead>
                                                            <tr>
                                                                
                                                                <th>
                                                                    {{-- Pure CSS Accordion --}}
                                                                    <div class="acc-wrapper">

                                                                        <div class="acc-item">
                                                                            <input type="checkbox" id="acc-toggle-1" class="acc-checkbox">
                                                                            <label for="acc-toggle-1" class="acc-header">
                                                                                Click Here to view Employee Pay Information
                                                                                <span class="acc-icon"></span>
                                                                            </label>
                                                                            <div class="acc-body">
                                                                                <div class="acc-content">
                                                                                    <table class="attTable">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>SNo.</th>
                                                                                                <th nowrap="">IC NO.</th>
                                                                                                <th nowrap="">Employee Name</th>
                                                                                                <th>Designation</th>
                                                                                                <th>Group / Division / Section</th>
                                                                                                <th>Basic</th>
                                                                                                @if(isset($GroupedPayComponents['ADD']))
                                                                                                @foreach($GroupedPayComponents['ADD'] as $PayComponentList)
                                                                                                    <th>{{ $PayComponentList->component_code }}</th>
                                                                                                @endforeach
                                                                                                @endif
                                                                                                <th>GROSS</th>
                                                                                                @if(isset($GroupedPayComponents['DEDUCT']))
                                                                                                @foreach($GroupedPayComponents['DEDUCT'] as $PayComponentList)
                                                                                                    <th>{{ $PayComponentList->component_code }}</th>
                                                                                                @endforeach
                                                                                                @endif
                                                                                                <th nowrap="">NET SALARY</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody id="attendanceTableBody">
                                                                                            @if(isset($PayEmployeeData))
                                                                                            @foreach($PayEmployeeData as $PayEmployeeDataKey => $PayEmployeeDataValue)
                                                                                            @php 
                                                                                                $EmpPayLevelGrpData = [];  
                                                                                                if(isset($EmpPayComponentGrpData[$PayEmployeeDataValue->payroll_employee_id])){
                                                                                                    $EmpPayLevelData = $EmpPayComponentGrpData[$PayEmployeeDataValue->payroll_employee_id];
                                                                                                    if(filled($EmpPayLevelData)){
                                                                                                        $EmpPayLevelGrpData = collect($EmpPayLevelData)->keyBy('component_code');
                                                                                                    }
                                                                                                }
                                                                                            @endphp
                                                                                            <tr>
                                                                                                <td align="center">{{ $loop->iteration }}</td>
                                                                                                <td align="center">{{ $PayEmployeeDataValue->emp_no }}</td>
                                                                                                <td>{{ $PayEmployeeDataValue->emp_name }}</td>
                                                                                                <td>{{ $PayEmployeeDataValue->designation }}</td>
                                                                                                <td>
                                                                                                    @if($PayEmployeeDataValue->section_name != NULL)
                                                                                                        {{ $PayEmployeeDataValue->section_name }}
                                                                                                    @elseif($PayEmployeeDataValue->division_name != NULL)
                                                                                                        {{ $PayEmployeeDataValue->division_name }}
                                                                                                    @elseif($PayEmployeeDataValue->group_name != NULL)
                                                                                                        {{ $PayEmployeeDataValue->group_name }}
                                                                                                    @else

                                                                                                    @endif
                                                                                                
                                                                                                </td>
                                                                                                <td align="right">{{ $PayEmployeeDataValue->basic_salary }}</td>
                                                                                                @if(isset($GroupedPayComponents['ADD']))
                                                                                                @foreach($GroupedPayComponents['ADD'] as $PayComponentList)
                                                                                                    <td align="right">
                                                                                                    @php
                                                                                                    $PayComponentAmt = 0; 
                                                                                                    if(isset($EmpPayLevelGrpData[$PayComponentList->component_code])){ 
                                                                                                        $PayComponentData = $EmpPayLevelGrpData[$PayComponentList->component_code];
                                                                                                        $PayComponentAmt = $PayComponentData->final_amount;
                                                                                                    }
                                                                                                    if($PayComponentAmt != 0){ echo $PayComponentAmt; }
                                                                                                    @endphp
                                                                                                    </td>
                                                                                                @endforeach
                                                                                                @endif
                                                                                                <td align="right">
                                                                                                {{ $PayEmployeeDataValue->gross_salary }}
                                                                                                @php $ExeTotalGrossAmount = $ExeTotalGrossAmount + $PayEmployeeDataValue->gross_salary; @endphp
                                                                                                </td>
                                                                                                @if(isset($GroupedPayComponents['DEDUCT']))
                                                                                                @foreach($GroupedPayComponents['DEDUCT'] as $PayComponentList)
                                                                                                    <td align="right">
                                                                                                        @php
                                                                                                        $PayComponentAmt = 0;
                                                                                                        if(isset($EmpPayLevelGrpData[$PayComponentList->component_code])){
                                                                                                            $PayComponentData = $EmpPayLevelGrpData[$PayComponentList->component_code];
                                                                                                            $PayComponentAmt = $PayComponentData->final_amount;
                                                                                                        }
                                                                                                        if($PayComponentAmt != 0){ 
                                                                                                            echo $PayComponentAmt; 
                                                                                                            if(isset($DeductionArr[$PayComponentList->component_code])){
                                                                                                                $DeductionArr[$PayComponentList->component_code] = $DeductionArr[$PayComponentList->component_code] + $PayComponentAmt;
                                                                                                            }else{
                                                                                                                $DeductionArr[$PayComponentList->component_code] = $PayComponentAmt;
                                                                                                            }
                                                                                                            $DeductionArr[$PayComponentList->component_code] = ($DeductionArr[$PayComponentList->component_code] ?? 0) + $PayComponentAmt;
                                                                                                        }
                                                                                                        @endphp
                                                                                                    </td>
                                                                                                @endforeach
                                                                                                @endif
                                                                                                <td align="right">
                                                                                                {{ $PayEmployeeDataValue->net_salary }}
                                                                                                @php $ExeTotalNetAmount = $ExeTotalNetAmount + $PayEmployeeDataValue->net_salary; @endphp
                                                                                                
                                                                                                </td>
                                                                                            </tr>
                                                                                            @endforeach
                                                                                            @endif
                                                                                        </tbody>
                                                                                        <tr>
                                                                                            <th></th>
                                                                                            <th></th>
                                                                                            <th></th>
                                                                                            <th></th>
                                                                                            <th></th>
                                                                                            <th></th>
                                                                                            @if(isset($GroupedPayComponents['ADD']))
                                                                                            @foreach($GroupedPayComponents['ADD'] as $PayComponentList)
                                                                                                <th></th>
                                                                                            @endforeach
                                                                                            @endif
                                                                                            <th style="text-align:right">{{ $ExeTotalGrossAmount }}</th>
                                                                                            @if(isset($GroupedPayComponents['DEDUCT']))
                                                                                            @foreach($GroupedPayComponents['DEDUCT'] as $PayComponentList)
                                                                                                <th style="text-align:right">    
                                                                                                @if(isset($DeductionArr[$PayComponentList->component_code]))
                                                                                                {{ $DeductionArr[$PayComponentList->component_code] }}
                                                                                                @endif
                                                                                                </th>
                                                                                            @endforeach
                                                                                            @endif
                                                                                            <th style="text-align:right">{{ $ExeTotalNetAmount }}</th>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        
                                                    </table>

                                                    {{-- Eligibility warning panel --}}
                                                    <div id="eligibilityWarning"
                                                         style="display:none; color:#c0392b; padding:8px; margin-top:6px; background:#fdecea; border-radius:4px;">
                                                    </div>

                                                </div>
                                            </div>

                                            {{-- ── Object Head Information Table ── --}}
                                            <div class="table-container">
                                                <div class="table-wrapper" style="margin-bottom:10px;">
                                                    <div class="section-header">
                                                        <span>Gross Salary - Budget & Object Head Information</span>
                                                        <!-- <div class="quick-fill">
                                                            <button type="button" id="ViewLeaveDetails">
                                                                <div class="infoText bxcolor5 tooltip-l">
                                                                    View Budget Sanction Information
                                                                    <div class="tooltiptext"
                                                                         style="height:auto; z-index:9999; min-width:320px;">
                                                                        <div id="leaveBalanceTooltipContent">
                                                                            <em>Click here to view budget sanction & object head information.</em>
                                                                        </div>
                                                                        <div class="row smclearrow">&nbsp;</div>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </div> -->
                                                    </div>

                                                    <table class="attTable">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:140px;">Object Head</th>
                                                                <th style="width:200px;">Ledger Name</th>
                                                                <th nowrap="">Upto Date Received (&#8377;)</th>
                                                                <th nowrap="">Upto Date Expenditure (&#8377;)</th>
                                                                <th nowrap="">Current Expenditure (&#8377;)</th>
                                                                <th nowrap="">Balance (&#8377;)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="attendanceTableBody">
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
                                                                <td>
                                                                    <input type="text" class="tboxsmclass" id="txt_expenditure_amt" name="txt_expenditure_amt" value="{{ $TotalGrossAmount ?? '' }}" readonly>
                                                                </td>
                                                                <td>
                                                                    @php $BalanceAmt = $BudgetReceivedAmount - $UptoDtExpenditureAmt - $TotalGrossAmount; @endphp
                                                                    {{ $BalanceAmt }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                            {{-- ── Deductions Object Head Information Table ── --}}
                                            <div class="table-container">
                                                <div class="table-wrapper">
                                                    <div class="section-header">
                                                        <span>Deductions - Budget & Object Head Information</span>
                                                    </div>

                                                    <table class="attTable">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:60px;">SNo.</th>
                                                                <th style="width:300px;">Deduction Name</th>
                                                                <th style="width:200px;" nowrap="">Deduction Gross (&#8377;)</th>
                                                                <th>Ledger</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="attendanceTableBody">
                                                            
                                                            @php $DedSno = 1; @endphp
                                                            @if(isset($GroupedPayComponents['DEDUCT']))
                                                            @foreach($GroupedPayComponents['DEDUCT'] as $PayComponentList)
                                                                @if(isset($DeductionArr[$PayComponentList->component_code]))
                                                                <tr id="inputRow">
                                                                    <td align="center">{{ $DedSno }} @php $DedSno++; @endphp </td>
                                                                    <td>{{ $PayComponentList->component_name }}</td>
                                                                    <td align="right">
                                                                        {{ $DeductionArr[$PayComponentList->component_code] }}
                                                                        <input type="hidden" name="txt_deduction_amt[]" id="txt_deduction_amt" value="{{ $DeductionArr[$PayComponentList->component_code] }}">
                                                                    </td>
                                                                    <td>
                                                                        <select name="cmb_deduct_object_head[]" id="cmb_deduct_object_head" class="tboxsmclass ChosenInput">
                                                                            <option value=""> ---- Select ----</option>
                                                                            <!-- {!! $OptionStr ?? '' !!} -->
                                                                            @if(isset($Ledger))
                                                                            @foreach($Ledger as $AllLedgers)
                                                                            <option value="{{ $AllLedgers->ledger_id }}" data-ledgergroup="{{ $AllLedgers->ledger_group_id }}" data-type="L">{{ $AllLedgers->ledger_acc_name }}</option>
                                                                            @endforeach
                                                                            @endif
                                                                        </select>
                                                                        <input type="hidden" name="txt_deduct_component_id[]" id="txt_deduct_component_id" value="{{ $PayComponentList->component_id }}">
                                                                        <input type="hidden" name="txt_deduct_component_code[]" id="txt_deduct_component_code" value="{{ $PayComponentList->component_code }}">
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                                
                                                            @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>

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

</script>
@endsection