@php 
$OtherParamForTaxCalc = [];
if(isset($data)){
    $EmpGroupIdArr              = $data['EmpGroupIdArr'];
    $FinancialYear              = $data['FinancialYear'];
    $PayGenYear                 = $data['PayGenYear'];
    $PayGenMonth                = $data['PayGenMonth'];
    $payComponents              = $data['payComponents'];
    $employeeGroupMaster        = $data['employeeGroupMaster'];
    $EmployeeList               = $data['EmployeeList'];
    $EmployeePayComponentList   = $data['EmployeePayComponentList'];
    $EmployeePayLevelGrpData    = $data['EmployeePayLevelGrpData'];
    $EmpAttendanceGrpData       = $data['EmpAttendanceGrpData'];
    $EmpPayComponentData        = $data['EmpPayComponentData'];
    $CalculatedPayData          = $data['CalculatedPayData'];
    $groupedPayComponents       = $data['groupedPayComponents'];
    $otherPayComponents         = $data['otherPayComponents'];
    $homePayComponents          = $data['homePayComponents'];
    $investPayComponents        = $data['investPayComponents'];
    $EmpNo = $EmployeeList->pluck('emp_no')->first();
    if(isset($CalculatedPayData[$EmpNo])){
        $EmpCalculatedPayData = $CalculatedPayData[$EmpNo];
        if(isset($EmpCalculatedPayData['tax_data'])){
            $EmpTaxData = $EmpCalculatedPayData['tax_data'];
            if(isset($EmpTaxData['OtherParamForTaxCalc'])){
                $OtherParamForTaxCalc = $EmpTaxData['OtherParamForTaxCalc'];
            }
        }
    }
}
$MonthArr = [4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nev',12=>'Dec',1=>'Jan',2=>'Feb',3=>'Mar'];
$Month = date('m');
if($Month < 4){
    $StartYear  = date('Y')-1;
    $EndYear    = date('Y');
}else{
    $StartYear  = date('Y');
    $EndYear    = date('Y')+1;
}
$Colspan1 = 0; $Colspan2 = 0; $Colspan3 = 0; $Colspan4 = 0; $Colspan5 = 0;
if(isset($groupedPayComponents['ADD'])){
    $Colspan1 = count($groupedPayComponents['ADD']);
}
if(isset($groupedPayComponents['DEDUCT'])){
    $Colspan2 = count($groupedPayComponents['DEDUCT']);
}
if(isset($investPayComponents)){
    $Colspan3 = count($investPayComponents);
}
if(isset($homePayComponents)){
    $Colspan4 = count($homePayComponents);
}
if(isset($otherPayComponentsList)){
    $Colspan5 = count($otherPayComponentsList);
}
$TotalGross = 0; $TotalEpf = 0; $TotalNps = 0; $TotalLic = 0; $TotalPli = 0; $TotalIt = 0; $TotalPTax = 0;
$Colspan = $Colspan1+$Colspan2+$Colspan3+$Colspan4+$Colspan5;
@endphp

<style>
    table.attTable td{
        font-weight: 500;
    }
    .tax-box{
        padding: 2px 10px 10px 10px;
    }
</style>
<div class="table-container" style="scroll:auto">
    <div class="table-wrapper">
        <div class="section-header">
            <span>Employee Tax Information</span>
        </div>
    <!-- Attendance Table -->
    <table class="attTable">
        <thead>
            <tr>
                <th nowrap="">Month</th>
                <th style="width: 100px;">BASIC</th>
                @if(isset($groupedPayComponents['ADD']))
                @foreach($groupedPayComponents['ADD'] as $PayComponentList)
                    <th style="width: 180px;">{{ $PayComponentList->component_code }}</th>
                @endforeach
                @endif
                <th style="width: 130px;">GROSS</th>
                @if(isset($groupedPayComponents['DEDUCT']))
                @foreach($groupedPayComponents['DEDUCT'] as $PayComponentList)
                    <th style="width: 180px;">{{ $PayComponentList->component_code }}</th>
                @endforeach
                @endif
                

                @if(isset($investPayComponents))
                @foreach($investPayComponents as $investPayComponentsList)
                    <th style="width: 180px;">{{ $investPayComponentsList->component_code }}</th>
                @endforeach
                @endif

                @if(isset($homePayComponents))
                @foreach($homePayComponents as $homePayComponentsList)
                    <th style="width: 180px;">{{ $homePayComponentsList->component_code }}</th>
                @endforeach
                @endif

                @if(isset($otherPayComponents))
                @foreach($otherPayComponents as $otherPayComponentsList)
                    <th style="width: 180px;">{{ $otherPayComponentsList->component_code }}</th>
                @endforeach
                @endif

                <th style="width: 110px;">Regime</th>
                <!-- <th style="width: 110px;">IT</th> -->
                <th nowrap="">NET SAL.</th>
            </tr>
        </thead>
        <tbody id="attendanceTableBody">
        @if(isset($data['EmployeeList']))
            @foreach($data['EmployeeList'] as $EmployeeListKey => $EmployeeList)

            @php
            $BasicPay = 0;
            if(isset($EmployeePayLevelGrpData[$EmployeeList->emp_no])){
                $EmpPayLevelData = $EmployeePayLevelGrpData[$EmployeeList->emp_no];
                if(isset($EmpPayLevelData['basic_salary'])){
                    $BasicPay = $EmpPayLevelData['basic_salary'];
                }
            }
            $PayCalcDays = 0;
            if(isset($EmpAttendanceGrpData[$EmployeeList->emp_no])){
                $EmpAttendanceData = $EmpAttendanceGrpData[$EmployeeList->emp_no];
                if(isset($EmpAttendanceData['days_pay_calc'])){
                    $PayCalcDays = $EmpAttendanceData['days_pay_calc'];
                }
            }

            $EmpCalculatedPayData = []; $EmpCalcComponentData = []; $EmpGrossSalary = 0; $EmpNetSalary = 0; 
            $EmpTaxData = []; $EmpTaxRegime = 'NEW'; $EmpTaxAmount = 0;
            if(isset($CalculatedPayData[$EmployeeList->emp_no])){
                $EmpCalculatedPayData = $CalculatedPayData[$EmployeeList->emp_no]; 
                if($EmpCalculatedPayData['calculated_components']){
                    $EmpCalcComponentData = $EmpCalculatedPayData['calculated_components'];
                    $EmpGrossSalary = $EmpCalculatedPayData['gross_earnings'];
                    $EmpNetSalary = $EmpCalculatedPayData['net_salary'];
                    $EmpTaxRegime = $EmpCalculatedPayData['tax_regime'] ?? '';
                    $EmpTaxAmount = $EmpCalculatedPayData['tax_amount'] ?? 0;
                    $EmpTaxData = $EmpCalculatedPayData['tax_data'] ?? [];
                }
            }
            $TotalDeduction = 0;
            @endphp

            @foreach($MonthArr as $MonthKey => $MonthValue)
            @php 
                if($MonthKey < 4){
                    $TaxYear = $EndYear;
                }else{
                    $TaxYear = $StartYear;
                }
            @endphp
            <tr>
                
                
                <td>{{ $MonthValue }}-{{ $TaxYear }}</td>
                
                <td align="right">
                    {{\Helper::IndianRupeesFormatWithoutPise($BasicPay)}}
                </td>
                @if(filled($groupedPayComponents['ADD']))
                @foreach($groupedPayComponents['ADD'] as $PayComponentList)
                @php 
                    if(isset($EmpCalcComponentData[$PayComponentList->component_code])){
                        $ComponentCalcAmount = $EmpCalcComponentData[$PayComponentList->component_code];
                    }else{
                        $ComponentCalcAmount = 0;
                    }
                @endphp
                    <td align="right">
                        {{\Helper::IndianRupeesFormatWithoutPise($ComponentCalcAmount)}}
                    </td>
                @endforeach
                @endif
                <td align="right">
                    {{\Helper::IndianRupeesFormatWithoutPise($EmpGrossSalary)}}
                    @php $TotalGross = $TotalGross + $EmpGrossSalary; @endphp
                </td>
                @if(filled($groupedPayComponents['DEDUCT']))
                @foreach($groupedPayComponents['DEDUCT'] as $PayComponentList)
                @php 
                    if(isset($EmpCalcComponentData[$PayComponentList->component_code])){
                        $ComponentCalcAmount = $EmpCalcComponentData[$PayComponentList->component_code];
                    }else{
                        $ComponentCalcAmount = 0;
                    }
                    $TotalDeduction = $TotalDeduction + $ComponentCalcAmount;
                    if($PayComponentList->component_code == 'GPF'){
                        $TotalEpf = $TotalEpf + $ComponentCalcAmount;
                    }
                    if($PayComponentList->component_code == 'NPS'){
                        $TotalNps = $TotalNps + $ComponentCalcAmount;
                    }
                    if($PayComponentList->component_code == 'PT'){
                        $TotalPTax = $TotalPTax + $ComponentCalcAmount;
                    }
                @endphp
                    <td align="right">
                        {{\Helper::IndianRupeesFormatWithoutPise($ComponentCalcAmount)}}
                    </td>
                @endforeach
                @endif

                @if(filled($investPayComponents))
                @foreach($investPayComponents as $investPayComponentsList)
                    @php 
                    if(isset($EmpCalcComponentData[$investPayComponentsList->component_code])){
                        $ComponentCalcAmount = $EmpCalcComponentData[$investPayComponentsList->component_code];
                    }else{
                        $ComponentCalcAmount = 0;
                    }
                    $TotalDeduction = $TotalDeduction + $ComponentCalcAmount;
                    if($PayComponentList->component_code == 'LIC'){
                        $TotalLic = $TotalLic + $ComponentCalcAmount;
                    }
                    if($PayComponentList->component_code == 'PLI'){
                        $TotalPli = $TotalPli + $ComponentCalcAmount;
                    }
                    @endphp
                    <td align="right">
                        {{\Helper::IndianRupeesFormatWithoutPise($ComponentCalcAmount)}}
                    </td>
                @endforeach
                @endif

                @if(filled($homePayComponents))
                @foreach($homePayComponents as $homePayComponentsList)
                    @php 
                    if(isset($EmpCalcComponentData[$homePayComponentsList->component_code])){
                        $ComponentCalcAmount = $EmpCalcComponentData[$homePayComponentsList->component_code];
                    }else{
                        $ComponentCalcAmount = 0;
                    }
                    $TotalDeduction = $TotalDeduction + $ComponentCalcAmount;
                    @endphp
                    <td align="right">
                        {{\Helper::IndianRupeesFormatWithoutPise($ComponentCalcAmount)}}
                    </td>
                @endforeach
                @endif

                
                
                @if(isset($otherPayComponents))
                @foreach($otherPayComponents as $otherPayComponentsList)
                    @php 
                    if(isset($EmpCalcComponentData[$otherPayComponentsList->component_code])){
                        $ComponentCalcAmount = $EmpCalcComponentData[$otherPayComponentsList->component_code];
                    }else{
                        $ComponentCalcAmount = 0;
                    }
                    $TotalDeduction = $TotalDeduction + $ComponentCalcAmount;
                    @endphp
                    <td align="right">
                        {{\Helper::IndianRupeesFormatWithoutPise($ComponentCalcAmount)}}
                    </td>
                @endforeach
                @endif
                <td align="center" style="width: 100px;">{{ $EmpTaxRegime }}</td>
                <!-- <td align="right" style="width: 100px;">
                    {{\Helper::IndianRupeesFormatWithoutPise($EmpTaxAmount)}}
                    @php 
                    $TotalIt = $TotalIt + round($EmpTaxAmount);
                    @endphp
                </td> -->

                <td align="right">
                    {{\Helper::IndianRupeesFormatWithoutPise($EmpNetSalary)}}
                </td>
            </tr>
            @endforeach
            
            @endforeach
        @endif
            
        </tbody>
        <tr>
            <th style="text-align:right">TOTAL</th>
            <th></th>
            @if(isset($groupedPayComponents['ADD']))
            @foreach($groupedPayComponents['ADD'] as $PayComponentList)
                <th></th>
            @endforeach
            @endif
            <th>{{ $TotalGross }}</th>
            @if(isset($groupedPayComponents['DEDUCT']))
            @foreach($groupedPayComponents['DEDUCT'] as $PayComponentList)
                @if($PayComponentList->component_code == 'GPF')
                    <th style="text-align:right">{{ $TotalEpf }}</th>
                @elseif($PayComponentList->component_code == 'NPS')
                    <th style="text-align:right">{{ $TotalNps }}</th>
                @elseif($PayComponentList->component_code == 'PT')
                    <th style="text-align:right">{{ round($TotalPTax) }}</th>
                @else
                    <th></th>
                @endif
            @endforeach
            @endif

            @if(isset($investPayComponents))
            @foreach($investPayComponents as $investPayComponentsList)
                @if($PayComponentList->component_code == 'LIC')
                    <th style="text-align:right">{{ $TotalLic }}</th>
                @elseif($PayComponentList->component_code == 'PLI')
                    <th style="text-align:right">{{ $TotalPli }}</th>
                @else
                    <th></th>
                @endif
            @endforeach
            @endif

            @if(isset($homePayComponents))
            @foreach($homePayComponents as $homePayComponentsList)
                <th></th>
            @endforeach
            @endif

            @if(isset($otherPayComponents))
            @foreach($otherPayComponents as $otherPayComponentsList)
                <th></th>
            @endforeach
            @endif

            <th></th>
            <!-- <th style="text-align:right">{{ $TotalIt }}</th> -->
            <th></th>
        </tr>
    </table>
    <div class="row smclearrow"></div>
    <div class="row smclearrow"></div>
    <div class="row"> 
        <div class="div6 tax-box">
            <table class="attTable">
                <tr>
                    <th colspan="4">Income Tax Calculation as per Old Regime</th>
                </tr>
                <tr>
                    <td colspan="3">Gross Salary  Income</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['TotalGross']) ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="3">Less: Standard Deduction</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['OldStdDeduction']) ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="2">Standard Deduction</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['OldStdDedValue']) ?? '' }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2">Professional Tax</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['ProfTax']) ?? '' }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2">Net salary Income</td>
                    <td></td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['OldNetSalaryIncome']) ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="3">Income from House Property </td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3" align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['OldHomeLoanInterest']) ?? '' }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3" align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['OldGrossTotalIncome']) ?? '' }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>LESS</td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td colspan="3">Deductions Under Chapter-VI A </td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['TotalDedcutionUnderVIA']) ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="2">80 CCE</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['TotalAmount80CCE']) ?? '' }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>80 C</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['InvestmentUnder80CAmt']) ?? '' }}</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>80 CCC</td>
                    <td>{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['InvestmentUnder80CCCAmt']) ?? '' }}</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>80 CCD(1)</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['DeductUnder80CCD1Amt']) ?? '' }}</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>80 CCD(1B)</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['DeductUnder80CCD1BAmt']) ?? '' }}</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['DeductUnder80CCD1BFinalAmt']) ?? '' }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>80 CCD(2)</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['DeductUnder80CCD2Amt']) ?? '' }}</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['DeductUnder80CCD2FinalAmt']) ?? '' }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>80 D</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['InvestmentUnder80DAmt']) ?? '' }}</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['InvestmentUnder80DFinalAmt']) ?? '' }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>80 U</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['PhysicallyDisabled80UAmt']) ?? '' }}</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['PhysicallyDisabled80UAmt']) ?? '' }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>80 DD</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['PhysicallyDisabled80DDAmt']) ?? '' }}</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['PhysicallyDisabled80DDAmt']) ?? '' }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>80 G</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['DeductUnder80GAmt']) ?? '' }}</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['DeductUnder80GFinalAmt']) ?? '' }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3">Net Taxable Salary Income </td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['NetTaxableSalaryIncomeOld']) ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="3">Tax on Salary Income</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['TaxOnSalaryIncomeOld']) ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="3">Less: Rebate u/s 87A</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['Limit87AOld']) ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="3">Tax Payable after rebate</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['TaxOnSalaryIncomeAfterRebateOld']) ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="3">Add: Surchage @ {{ $OtherParamForTaxCalc['SurchargePercOld'] ?? '' }}%</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['SurchargeAmtOld']) ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="3">Health & Education Cess {{ $OtherParamForTaxCalc['HECessPercOld'] ?? '' }}%</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['HECessAmtOld']) ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="3">Tax plus cess</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['TaxPlusCessOld']) ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="3">Less: Tax Paid</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['AlreadyTaxPaidOld']) ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="3">Balance Tax to be Paid</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['BalanceTaxToBepaidOld']) ?? '' }}</td>
                </tr>

            </table>
        </div>

        <div class="div6 tax-box">
            <table class="attTable">
                <tr>
                    <th colspan="4">Income Tax Calculation as per New Regime</th>
                </tr>
                <tr>
                    <td colspan="2">Gross Salary  Income</td>
                    <td></td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['TotalGross']) ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="3">Less Standard Deduction</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['NewStdDeduction']) ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="2">Less Standard Deduction</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['NewStdDeduction']) ?? '' }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2">Professional Tax</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2">Net Salary Income</td>
                    <td></td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['NewNetSalaryIncome']) ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="3">&nbsp;</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3">&nbsp;</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3">Gross Total Income </td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['NewGrossTotalIncome']) ?? '' }}</td>
                </tr>
                <tr>
                    <td>LESS</td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td colspan="3">Deductions Under Chapter-VI A </td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['NpsEmployerContributeAmount']) ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="2">80 CCD(2)</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['NpsEmployerContributeAmount']) ?? '' }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3">Net Taxable Salary Income </td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['NetTaxableSalaryIncomeNew']) ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="3">Tax on Salary Income</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['TaxOnSalaryIncomeNew']) ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="3">Less: Rebate u/s 87A</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['RebateNew']) ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="3">Tax Payable after rebate</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['TaxOnSalaryIncomeAfterRebateNew']) ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="3">Add: Surchage @ {{ $OtherParamForTaxCalc['SurchargePercNew'] ?? '' }}%</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['SurchargeAmtNew']) ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="3">Health & Education Cess {{ $OtherParamForTaxCalc['HECessPercNew'] ?? '' }}%</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['HECessAmtNew']) ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="3">Tax plus cess</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['TaxPlusCessNew']) ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="3">Less: Tax Paid</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['AlreadyTaxPaidNew']) ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="3">Balance Tax to be Paid</td>
                    <td align="right">{{ \Helper::IndianRupeesFormatWithoutPise($OtherParamForTaxCalc['BalanceTaxToBepaidNew']) ?? '' }}</td>
                </tr>

            </table>
        </div>
    </div>
</div>
