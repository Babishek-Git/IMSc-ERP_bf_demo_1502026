<?php

namespace App\Services;

use App\Models\ItComponent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ItCalculationService
{
    
    public function CalculateIncomeTax($empNo, $employeeData, $calculatedComponents, $EmpFinalData,$OtherParam)
    {
        $ItCalcMode = $employeeData['it_calc_mode'] ?? NULL; 
        if($ItCalcMode == 'PROJECTED'){
            return $this->ProjectedITCalculation($empNo,$employeeData,$calculatedComponents,$EmpFinalData,$OtherParam);
        }else if($ItCalcMode == 'FINAL'){
            return $this->ProjectedITCalculation($empNo,$employeeData,$calculatedComponents,$EmpFinalData,$OtherParam);
        }else{
            return NULL;
        }
        
    }
    public function ProjectedITCalculation($empNo,$employeeData,$calculatedComponents,$EmpFinalData,$OtherParam)
    {
        $EmpData    = $employeeData['emp_data'];
        $Basic      = $calculatedComponents['BASIC'] ?? 0;
        $Ta         = $calculatedComponents['TA'] ?? 0;
        $Hra        = $calculatedComponents['HRA'] ?? 0;
        $Da         = $calculatedComponents['DA'] ?? 0;
        $Gross      = $calculatedComponents['GROSS'] ?? 0;
        $Chss       = $calculatedComponents['CHSS'] ?? 0;
        $Gpf        = $calculatedComponents['GPF'] ?? 0;
        $Nps        = $calculatedComponents['NPS'] ?? 0;
        $ProfTax    = $calculatedComponents['PT'] ?? 0;
        $Page = $OtherParam['Page'];

        $OtherParamForTaxCalc = [];

        $ItComponent = $OtherParam['it_component']; //ItComponent::where('active',1)->get();
        $OldItComponent = $ItComponent->where('it_regime','OLD'); 
        $NewItComponent = $ItComponent->where('it_regime','NEW');
        if(filled($OldItComponent)){ 
            $OldStdDeductionData = $OldItComponent->where('it_component_code','STDDED')->first();  
            $OldStdDedCode  = $OldStdDeductionData->it_component_code;  
            $OldStdDedMode  = $OldStdDeductionData->it_component_mode;
            $OldStdDedValue = $OldStdDeductionData->it_component_value;
        }
        if(filled($NewItComponent)){ 
            $NewStdDeductionData = $NewItComponent->where('it_component_code','STDDED')->first(); 
            $NewStdDedCode  = $NewStdDeductionData->it_component_code;
            $NewStdDedMode  = $NewStdDeductionData->it_component_mode;
            $NewStdDedValue = $NewStdDeductionData->it_component_value;
        }

        /*$GrossSalaryForItCalc = $Gross;
        $OldStdDeduction = $OldStdDedValue + $ProfTax;
        $NewStdDeduction = $NewStdDedValue;

        $OldNetSalaryIncome = $GrossSalaryForItCalc - $OldStdDeduction;
        $NewNetSalaryIncome = $GrossSalaryForItCalc - $NewStdDeduction;

        $OldHomeLoanInterest = 0; // Need to get it from table
        $NewHomeLoanInterest = 0;

        $OldGrossTotalIncome = $OldNetSalaryIncome - $OldHomeLoanInterest;
        $NewGrossTotalIncome = $NewNetSalaryIncome - $NewHomeLoanInterest;*/ 
        
        /*if($Page == 'Info'){
            $TotalGross = $Gross * 12;// * 10;
        }else{
            $TotalGross = $Gross;
        }*/
        $TotalGross = $Gross * 12;// * 10;
        $OtherParamForTaxCalc['Gross'] = $Gross;
        $OtherParamForTaxCalc['TotalGross'] = $TotalGross;
        $OtherParamForTaxCalc['OldStdDedValue'] = $OldStdDedValue;
        $OtherParamForTaxCalc['ProfTax'] = $ProfTax;

        $InvestmentUnder80CAmt = $this->Investment80CCalculation($empNo, $employeeData, $calculatedComponents, $EmpFinalData,$OtherParam);
        $InvestmentUnder80DAmt = $this->Investment80DCalculation($empNo, $employeeData, $calculatedComponents, $EmpFinalData,$OtherParam);
        $PhysicallyDisabled80UAmt = $this->PhysicallyDisabled80UCalculation($empNo, $employeeData, $calculatedComponents, $EmpFinalData,$OtherParam);
        $PhysicallyDisabled80DDAmt = $this->PhysicallyDisabled80DDCalculation($empNo, $employeeData, $calculatedComponents, $EmpFinalData,$OtherParam);
        $RetirementBenefitAmount = $this->RetirementBenefitCalculation($empNo, $employeeData, $calculatedComponents, $EmpFinalData,$OtherParam);
        $NpsEmployerContributeAmount = $this->NpsEmployerContributionCalculation($empNo, $employeeData, $calculatedComponents, $EmpFinalData,$OtherParam);
        $DeductionUnder10Amt = $this->DeductionUnder10Calculation($empNo, $employeeData, $calculatedComponents, $EmpFinalData,$OtherParam);
        $DeductUnder80CCD1Amt = $this->DeductUnder80CCD1($empNo, $employeeData, $calculatedComponents, $EmpFinalData,$OtherParam);
        $DeductUnder80CCD1BAmt = $this->DeductUnder80CCD1B($empNo, $employeeData, $calculatedComponents, $EmpFinalData,$OtherParam);
        $DeductUnder80GAmt = $this->DeductUnder80G($empNo, $employeeData, $calculatedComponents, $EmpFinalData,$OtherParam);
        $InvestmentUnder80CCCAmt = 0;
        $DeductUnder80CCD2Amt = $NpsEmployerContributeAmount;
        $GrossSalaryForItCalc = $TotalGross + $DeductionUnder10Amt + $NpsEmployerContributeAmount; 
        $OtherParamForTaxCalc['InvestmentUnder80CAmt'] = $InvestmentUnder80CAmt;
        $OtherParamForTaxCalc['InvestmentUnder80DAmt'] = $InvestmentUnder80DAmt;
        $OtherParamForTaxCalc['PhysicallyDisabled80UAmt'] = $PhysicallyDisabled80UAmt;
        $OtherParamForTaxCalc['PhysicallyDisabled80DDAmt'] = $PhysicallyDisabled80DDAmt;
        $OtherParamForTaxCalc['RetirementBenefitAmount'] = $RetirementBenefitAmount;
        $OtherParamForTaxCalc['NpsEmployerContributeAmount'] = $NpsEmployerContributeAmount;
        $OtherParamForTaxCalc['DeductionUnder10Amt'] = $DeductionUnder10Amt;
        $OtherParamForTaxCalc['DeductUnder80CCD1Amt'] = $DeductUnder80CCD1Amt;
        $OtherParamForTaxCalc['DeductUnder80CCD1BAmt'] = $DeductUnder80CCD1BAmt;
        $OtherParamForTaxCalc['DeductUnder80GAmt'] = $DeductUnder80GAmt;
        $OtherParamForTaxCalc['InvestmentUnder80CCCAmt'] = $InvestmentUnder80CCCAmt;
        $OtherParamForTaxCalc['DeductUnder80CCD2Amt'] = $DeductUnder80CCD2Amt;
        $OtherParamForTaxCalc['GrossSalaryForItCalc'] = $GrossSalaryForItCalc;

        // Here we have added ((retirement Benefit & $DeductionUnder10Amt are equal) $DeductionUnder10Amt = Gratuity+EL Encashment+Commuted Pension)

        $GrossSalaryIncomeForIT = $GrossSalaryForItCalc - $DeductionUnder10Amt;  /// Amount for OLD and NEW tax Gross Income Salary

         $OtherParamForTaxCalc['GrossSalaryIncomeForIT'] = $GrossSalaryIncomeForIT;


        $OldStdDeduction = $OldStdDedValue + $ProfTax; // Here we need to calculate professional tax as per deducted
        $OldNetSalaryIncome = $GrossSalaryIncomeForIT - $OldStdDeduction;
        $OldHomeLoanInterest = 0;
        $OldGrossTotalIncome = $OldNetSalaryIncome - $OldHomeLoanInterest; ///// (A)

        $OtherParamForTaxCalc['OldStdDeduction'] = $OldStdDeduction;
        $OtherParamForTaxCalc['OldNetSalaryIncome'] = $OldNetSalaryIncome;
        $OtherParamForTaxCalc['OldHomeLoanInterest'] = $OldHomeLoanInterest;
        $OtherParamForTaxCalc['OldGrossTotalIncome'] = $OldGrossTotalIncome;

        //LESS:
        $TotalAmount80CCE = $InvestmentUnder80CAmt + $InvestmentUnder80CCCAmt + $DeductUnder80CCD1Amt;
        $Limit80CCEData = $ItComponent->where('it_component_code','80CCE')->where('it_regime','OLD'); 
        $Limit80CCE = $Limit80CCEData->pluck('it_component_value')->first(); 
        if($TotalAmount80CCE >= $Limit80CCE){
            $Deduction80CCEAmt = $Limit80CCE;
        }else{
            $Deduction80CCEAmt = $TotalAmount80CCE;
        }
        $OtherParamForTaxCalc['TotalAmount80CCE'] = $TotalAmount80CCE;
        $OtherParamForTaxCalc['Limit80CCE'] = $Limit80CCE;
        $OtherParamForTaxCalc['Deduction80CCEAmt'] = $Deduction80CCEAmt;

        $Limit80CCD1BData = $ItComponent->where('it_component_code','NPS80CCD1BCALC')->where('it_regime','OLD');
        $Limit80CCD1B = $Limit80CCD1BData->pluck('it_component_value')->first(); 
        if($DeductUnder80CCD1BAmt >= $Limit80CCD1B){
            $DeductUnder80CCD1BFinalAmt = $Limit80CCD1B;
        }else{
            $DeductUnder80CCD1BFinalAmt = $DeductUnder80CCD1BAmt;
        }
        $OtherParamForTaxCalc['Limit80CCD1B'] = $Limit80CCD1B;
        $OtherParamForTaxCalc['DeductUnder80CCD1BAmt'] = $DeductUnder80CCD1BAmt;
        $OtherParamForTaxCalc['DeductUnder80CCD1BFinalAmt'] = $DeductUnder80CCD1BFinalAmt;

        $DeductUnder80CCD2FinalAmt = $DeductUnder80CCD2Amt;
        $LimitInsurance80DData = $ItComponent->where('it_component_code','INSURANCE80D')->where('it_regime','OLD');
        $LimitInsurance80D = $LimitInsurance80DData->pluck('it_component_value')->first(); 
        if($InvestmentUnder80DAmt >= $LimitInsurance80D){
            $InvestmentUnder80DFinalAmt = $LimitInsurance80D;
        }else{
            $InvestmentUnder80DFinalAmt = $InvestmentUnder80DAmt;
        }
        $OtherParamForTaxCalc['DeductUnder80CCD2FinalAmt'] = $DeductUnder80CCD2FinalAmt;
        $OtherParamForTaxCalc['LimitInsurance80D'] = $LimitInsurance80D;
        $OtherParamForTaxCalc['InvestmentUnder80DAmt'] = $InvestmentUnder80DAmt;
        $OtherParamForTaxCalc['InvestmentUnder80DFinalAmt'] = $InvestmentUnder80DFinalAmt;

        $DeductUnder80GFinalAmt = $DeductUnder80GAmt;
        $TotalDedcutionUnderVIA = $Deduction80CCEAmt + $DeductUnder80CCD1BFinalAmt + $DeductUnder80CCD2FinalAmt + $InvestmentUnder80DFinalAmt + $PhysicallyDisabled80UAmt + $PhysicallyDisabled80DDAmt + $DeductUnder80GFinalAmt;
        $NetTaxableSalaryIncomeOld = $OldGrossTotalIncome - $TotalDedcutionUnderVIA;
        $OtherParamForTaxCalc['DeductUnder80GFinalAmt'] = $DeductUnder80GFinalAmt;
        $OtherParamForTaxCalc['TotalDedcutionUnderVIA'] = $TotalDedcutionUnderVIA;
        $OtherParamForTaxCalc['NetTaxableSalaryIncomeOld'] = $NetTaxableSalaryIncomeOld;

        $ItSlab = $OtherParam['it_slab']; 
        $OldItSlab = $ItSlab->where('tax_regime','OLD');
        $NewItSlab = $ItSlab->where('tax_regime','NEW'); 
        if($empNo == 101){ 
           //dd($NewItSlab); 
        }
        // Old Slab calculation

        $OldTaxCalcData = $this->IncomeTaxSlabCalculation($NetTaxableSalaryIncomeOld,$OldItSlab);
        $TaxOnSalaryIncomeOld = $OldTaxCalcData['total_tax'];
        $Rebate87ADataOld = $ItComponent->where('it_component_code','REBATE87A')->where('it_regime','OLD');
        $Limit87AOld = $Rebate87ADataOld->pluck('it_component_value')->first(); 
        if($TaxOnSalaryIncomeOld > $Limit87AOld){
            $RebateOld = 0;
        }else{
            $RebateOld = $TaxOnSalaryIncomeOld;
        }
        $OtherParamForTaxCalc['OldTaxCalcData'] = $OldTaxCalcData;
        $OtherParamForTaxCalc['TaxOnSalaryIncomeOld'] = $TaxOnSalaryIncomeOld;
        $OtherParamForTaxCalc['Limit87AOld'] = $Limit87AOld;
        $OtherParamForTaxCalc['RebateOld'] = $RebateOld;

        $TaxOnSalaryIncomeAfterRebateOld = $TaxOnSalaryIncomeOld - $RebateOld;
        $SurchargePercDataOld = $ItComponent->where('it_component_code','SURCHARGEPERC')->where('it_regime','OLD');
        $SurchargePercOld = $SurchargePercDataOld->pluck('it_component_value')->first(); 
        $SurchargeLimitDataOld = $ItComponent->where('it_component_code','SURCHARGELIMIT')->where('it_regime','OLD');
        $SurchargeLimitOld = $SurchargeLimitDataOld->pluck('it_component_value')->first(); 
        if($TaxOnSalaryIncomeOld <= $SurchargeLimitOld){
            $SurchargeAmtOld = 0;
        }else{
            $SurchargeAmtOld = round($TaxOnSalaryIncomeAfterRebateOld * $SurchargePercOld / 100);
        }
        $OtherParamForTaxCalc['TaxOnSalaryIncomeAfterRebateOld'] = $TaxOnSalaryIncomeAfterRebateOld;
        $OtherParamForTaxCalc['SurchargePercOld'] = $SurchargePercOld;
        $OtherParamForTaxCalc['SurchargeLimitOld'] = $SurchargeLimitOld;
        $OtherParamForTaxCalc['SurchargeAmtOld'] = $SurchargeAmtOld;


        $HECessPercDataOld = $ItComponent->where('it_component_code','HECESS')->where('it_regime','OLD');
        $HECessPercOld = $HECessPercDataOld->pluck('it_component_value')->first();
        $HECessAmtOld = round(($TaxOnSalaryIncomeAfterRebateOld + $SurchargeAmtOld) * $HECessPercOld / 100);
        $TaxPlusCessOld = $TaxOnSalaryIncomeAfterRebateOld + $SurchargeAmtOld + $HECessAmtOld;
        $AlreadyTaxPaidOld = 0;
        $BalanceTaxToBepaidOld = $TaxPlusCessOld - $AlreadyTaxPaidOld;    ///-------------Final Tax 1 (OLD TAX AMOUNT)
        $OtherParamForTaxCalc['HECessPercOld'] = $HECessPercOld;
        $OtherParamForTaxCalc['HECessAmtOld'] = $HECessAmtOld;
        $OtherParamForTaxCalc['TaxPlusCessOld'] = $TaxPlusCessOld;
        $OtherParamForTaxCalc['AlreadyTaxPaidOld'] = $AlreadyTaxPaidOld;
        $OtherParamForTaxCalc['BalanceTaxToBepaidOld'] = $BalanceTaxToBepaidOld;


        /// For New Tax Calculation
        $NewStdDeduction = $NewStdDedValue;
        $NewNetSalaryIncome = $GrossSalaryIncomeForIT - $NewStdDeduction;
        $NewGrossTotalIncome = $NewNetSalaryIncome;
        $NetTaxableSalaryIncomeNew = $NewGrossTotalIncome - $NpsEmployerContributeAmount; ///// (B)
        $OtherParamForTaxCalc['NewStdDeduction'] = $NewStdDeduction;
        $OtherParamForTaxCalc['NewNetSalaryIncome'] = $NewNetSalaryIncome;
        $OtherParamForTaxCalc['NewGrossTotalIncome'] = $NewGrossTotalIncome;
        $OtherParamForTaxCalc['NetTaxableSalaryIncomeNew'] = $NetTaxableSalaryIncomeNew;
        // New Slab calculation
        $NewTaxCalcData = $this->IncomeTaxSlabCalculation($NetTaxableSalaryIncomeNew,$NewItSlab);  //dd($NewTaxCalcData);
        $TaxOnSalaryIncomeNew = $NewTaxCalcData['total_tax']; 
        $Rebate87ADataNew = $ItComponent->where('it_component_code','REBATE87A')->where('it_regime','NEW');
        $Limit87ANew = $Rebate87ADataNew->pluck('it_component_value')->first(); 
        if($TaxOnSalaryIncomeNew < $Limit87ANew){
            $RebateNew = 0;
        }else{
            $RebateNew = $TaxOnSalaryIncomeNew;
        }
        $OtherParamForTaxCalc['NewTaxCalcData'] = $NewTaxCalcData;
        $OtherParamForTaxCalc['TaxOnSalaryIncomeNew'] = $TaxOnSalaryIncomeNew;
        $OtherParamForTaxCalc['Limit87ANew'] = $Limit87ANew;
        $OtherParamForTaxCalc['RebateNew'] = $RebateNew;


        $TaxOnSalaryIncomeAfterRebateNew = $TaxOnSalaryIncomeNew - $RebateNew;
        $SurchargePercDataNew = $ItComponent->where('it_component_code','SURCHARGEPERC')->where('it_regime','NEW');
        $SurchargePercNew = $SurchargePercDataNew->pluck('it_component_value')->first(); 
        $SurchargeLimitDataNew = $ItComponent->where('it_component_code','SURCHARGELIMIT')->where('it_regime','NEW');
        $SurchargeLimitNew = $SurchargeLimitDataNew->pluck('it_component_value')->first(); 
        if($TaxOnSalaryIncomeNew <= $SurchargeLimitNew){
            $SurchargeAmtNew = 0;
        }else{
            $SurchargeAmtNew = round($TaxOnSalaryIncomeAfterRebateNew * $SurchargePercOld / 100);
        }
        $OtherParamForTaxCalc['TaxOnSalaryIncomeAfterRebateNew'] = $TaxOnSalaryIncomeAfterRebateNew;
        $OtherParamForTaxCalc['SurchargePercNew'] = $SurchargePercNew;
        $OtherParamForTaxCalc['SurchargeLimitNew'] = $SurchargeLimitNew;
        $OtherParamForTaxCalc['SurchargeAmtNew'] = $SurchargeAmtNew;

        $HECessPercDataNew = $ItComponent->where('it_component_code','HECESS')->where('it_regime','NEW');
        $HECessPercNew = $HECessPercDataNew->pluck('it_component_value')->first();
        $HECessAmtNew = round(($TaxOnSalaryIncomeAfterRebateNew + $SurchargeAmtNew) * $HECessPercNew / 100);
        $TaxPlusCessNew = $TaxOnSalaryIncomeAfterRebateNew + $SurchargeAmtNew + $HECessAmtNew;
        $AlreadyTaxPaidNew = 0;
        $BalanceTaxToBepaidNew = $TaxPlusCessNew - $AlreadyTaxPaidNew;    ///-------------Final Tax 2 (NEW TAX AMOUNT)
        $OtherParamForTaxCalc['HECessPercNew'] = $HECessPercNew;
        $OtherParamForTaxCalc['HECessAmtNew'] = $HECessAmtNew;
        $OtherParamForTaxCalc['TaxPlusCessNew'] = $TaxPlusCessNew;
        $OtherParamForTaxCalc['AlreadyTaxPaidNew'] = $AlreadyTaxPaidNew;
        $OtherParamForTaxCalc['BalanceTaxToBepaidNew'] = $BalanceTaxToBepaidNew;
        if($empNo == 101){ 
            //dd(['tax_amount_old_regime' => $BalanceTaxToBepaidOld,'tax_amount_new_regime' => $BalanceTaxToBepaidNew, 'OtherParamForTaxCalc' => $OtherParamForTaxCalc]);
        }
        return ['tax_amount_old_regime' => $BalanceTaxToBepaidOld,'tax_amount_new_regime' => $BalanceTaxToBepaidNew, 'OtherParamForTaxCalc' => $OtherParamForTaxCalc];
    }
    public function Investment80CCalculation($empNo, $employeeData, $calculatedComponents, $EmpFinalData,$OtherParam){
        $InvestmentUnder80CAmount = 0;
        if(isset($EmpFinalData['insurance_amount'])){
            $InvestmentUnder80CAmount = $InvestmentUnder80CAmount + $EmpFinalData['insurance_amount'];
        }
        return $InvestmentUnder80CAmount;
    }
    public function Investment80DCalculation($empNo,$employeeData,$calculatedComponents,$EmpFinalData,$OtherParam){
        $InvestmentUnder80DAmount = 0; 
        if(isset($calculatedComponents['CHSS'])){ 
            $InvestmentUnder80DAmount = $InvestmentUnder80DAmount + $calculatedComponents['CHSS'];
        } 
        return $InvestmentUnder80DAmount;
    }
    public function PhysicallyDisabled80UCalculation($empNo,$employeeData,$calculatedComponents,$EmpFinalData,$OtherParam){
        $PhyDisableUnder80UAmount = 0; 
        $EmpData = $employeeData['emp_data']; 
        $PhyDisableType = $EmpData->phy_challange_type ?? NULL;
        $PhyDisablePerc = $EmpData->phy_challange_perc ?? 40;
        $PhyDisableType = 'SELF';
        if($PhyDisableType == 'SELF'){ 
            $ItComponent = $OtherParam['it_component']; 
            $DisablityData = $ItComponent->where('it_component_code','DISABLESELF')->where('start_range','<=',$PhyDisablePerc)->where('end_range','>=',$PhyDisablePerc); 
            $DisabilityAmount =  $DisablityData->pluck('it_component_value')->first(); 
            $PhyDisableUnder80UAmount = $PhyDisableUnder80UAmount + $DisabilityAmount;
        } 
        return $PhyDisableUnder80UAmount;
    }
    public function PhysicallyDisabled80DDCalculation($empNo,$employeeData,$calculatedComponents,$EmpFinalData,$OtherParam){
        $PhyDisableUnder80DDAmount = 0; 
        $EmpData = $employeeData['emp_data']; 
        $PhyDisableType = $EmpData->phy_challange_type ?? NULL;
        $PhyDisablePerc = $EmpData->phy_challange_perc ?? 40;
        $PhyDisableType = 'DEPEND';
        if($PhyDisableType == 'DEPEND'){ 
            $ItComponent = $OtherParam['it_component']; 
            $DisablityData = $ItComponent->where('it_component_code','DISABLEDEP')->where('start_range','<=',$PhyDisablePerc)->where('end_range','>=',$PhyDisablePerc); 
            $DisabilityAmount =  $DisablityData->pluck('it_component_value')->first(); 
            $PhyDisableUnder80DDAmount = $PhyDisableUnder80DDAmount + $DisabilityAmount;
        } 
        return $PhyDisableUnder80DDAmount;
    }
    public function RetirementBenefitCalculation($empNo,$employeeData,$calculatedComponents,$EmpFinalData,$OtherParam){
        $RetirementBenefitAmount = 0;  
        /*if(isset($calculatedComponents['NPS'])){ 
            $RetirementBenefitAmount = $RetirementBenefitAmount + $calculatedComponents['NPS'];
        }*/ 
        return $RetirementBenefitAmount;
    }
    public function NpsEmployerContributionCalculation($empNo,$employeeData,$calculatedComponents,$EmpFinalData,$OtherParam){
        $NpsAmount = 0;  //dd($calculatedComponents);
        if(isset($calculatedComponents['NPS'])){ 
            $NpsAmount =  $calculatedComponents['NPS'];
            $ItComponent = $OtherParam['it_component']; 
            $NpsEmployerPercData = $ItComponent->where('it_component_code','NPSEMPLR')->where('it_regime','OLD'); 
            $NpsEmployerPerc = $NpsEmployerPercData->pluck('it_component_value')->first(); 
            $NpsAmount = round($NpsAmount * $NpsEmployerPerc);
        } 
        return $NpsAmount;
    }
    public function DeductionUnder10Calculation($empNo,$employeeData,$calculatedComponents,$EmpFinalData,$OtherParam){
        $DeductionUnder10Amount = 0;  
        $GratuityAmount = 0;
        $ElEncashmentAmount = 0;
        $CommutedPension = 0;
        $DeductionUnder10Amount = $GratuityAmount + $ElEncashmentAmount + $CommutedPension;
        return $DeductionUnder10Amount;
    }
    public function DeductUnder80CCD1($empNo,$employeeData,$calculatedComponents,$EmpFinalData,$OtherParam){
        $Deduction80CCDAmt = 0;  //dd($calculatedComponents);
        if(isset($calculatedComponents['NPS'])){ 
            $NpsAmount =  $calculatedComponents['NPS'];
            $ItComponent = $OtherParam['it_component']; 
            $NpsLimitData = $ItComponent->where('it_component_code','NPS80CCD1')->where('it_regime','OLD'); 
            $NpsLimit = $NpsLimitData->pluck('it_component_value')->first(); 
            if($NpsAmount >= $NpsLimit){
                $Deduction80CCDAmt = $NpsLimit;
            }else{
                $Deduction80CCDAmt = $NpsAmount;
            }
        } 
        return $Deduction80CCDAmt;
    }
    public function DeductUnder80CCD1B($empNo,$employeeData,$calculatedComponents,$EmpFinalData,$OtherParam){
        $Deduction80CCDAmt = 0;  
        if(isset($calculatedComponents['NPS'])){ 
            $NpsAmount =  $calculatedComponents['NPS'];
            $ItComponent = $OtherParam['it_component']; 
            $NpsLimitData = $ItComponent->where('it_component_code','NPS80CCD1B')->where('it_regime','OLD'); 
            $NpsLimit = $NpsLimitData->pluck('it_component_value')->first(); 
            if($NpsAmount >= $NpsLimit){
                $Deduction80CCDAmt = $NpsAmount - $NpsLimit;
            }else{
                $Deduction80CCDAmt = 0;
            }
        } 
        return $Deduction80CCDAmt;
    }
    public function DeductUnder80G($empNo,$employeeData,$calculatedComponents,$EmpFinalData,$OtherParam){
        $HouseLoanInterestAmt = 0;  
        /*if(isset($calculatedComponents['NPS'])){ 
            $RetirementBenefitAmount = $RetirementBenefitAmount + $calculatedComponents['NPS'];
        }*/ 
        return $HouseLoanInterestAmt;
    }
    public function IncomeTaxSlabCalculation($income, $slabs)
    {
        $slabs = $slabs->sortBy('min_income')->values(); // ensure order

        $totalTax = 0;
        $breakup = [];

        foreach ($slabs as $slab) {
            $min = (float) $slab->min_income;
            $max = is_null($slab->max_income) ? null : (float) $slab->max_income;
            $rate = (float) $slab->tax_rate;

            // Skip if income doesn't reach this slab
            if ($income <= $min) {
                continue;
            }

            // Calculate taxable income in this slab
            $upperLimit = $max ?? $income;

            $taxable = min($income, $upperLimit) - $min;

            if ($taxable <= 0) {
                continue;
            }

            $tax = ($taxable * $rate) / 100;

            $breakup[] = [
                'slab_range' => $min . ' - ' . ($max ?? 'Above'),
                'taxable_amount' => $taxable,
                'tax_rate' => $rate,
                'tax_amount' => $tax,
            ];

            $totalTax += $tax;
        }

        return [
            'total_tax' => $totalTax,
            'breakup' => $breakup
        ];
    }

}