<?php

namespace App\Services;
use App\Services\ItCalculationService;
use App\Models\PayComponent;
use App\Models\PayComponentRule;
use App\Models\PayComponentType;
use App\Models\EmployeePayComponent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PayrollCalculationService
{
    protected $ItCalculationService;
    /**
     * Calculate payroll for an employee
     * 
     * @param int $empNo Employee number
     * @param array $employeeData Additional employee data (basic_salary, city_type, etc.)
     * @param string|null $effectiveDate Date for which to calculate (default: today)
     * @return array
     */
    public function __construct(ItCalculationService $ItCalculationService)
    {
        $this->ItCalculationService = $ItCalculationService;
    }
    public function calculatePayroll($empNo, array $employeeData = [], $effectiveDate = null, $OtherParam = [])
    {
        $effectiveDate = $effectiveDate ?? now()->format('Y-m-d');
        $Page = $OtherParam['Page'];
        // Initialize basic salary first
        $basicSalary = $employeeData['basic_salary'] ?? 0;
        $calculatedComponents = [];
        $earnings = [];
        $deductions = [];

        // Add basic salary to calculated components
        $calculatedComponents['BASIC'] = $basicSalary;
        $earnings['BASIC'] = [
            'component_id' => 0, // or null, or fetch from pay_components table if BASIC is stored there
            'component_name' => 'Basic Pay',
            'component_code' => 'BASIC',
            'amount' => $basicSalary,
            'is_taxable' => true,
        ];
        
        // Get employee's assigned components
        $employeeComponents = EmployeePayComponent::where('emp_no', $empNo)
            ->where('active', 1)
            ->where('active', 1)
            ->where('is_current', true)
            ->get();

        if ($employeeComponents->isEmpty()) { 
            //return $this->emptyPayrollResponse();
            return [
                'emp_no' => $empNo,
                'calculation_date' => $effectiveDate,
                'earnings' => $earnings,
                'gross_earnings' => $basicSalary,
                'deductions' => [],
                'total_deductions' => 0,
                'net_salary' => $basicSalary,
                'calculated_components' => $calculatedComponents,
            ];
        }

        //$earnings = [];
        //$deductions = [];
        //$calculatedComponents = [];
        
        // Add basic salary to calculated components
        //$calculatedComponents['BASIC'] = $employeeData['basic_salary'] ?? 0;

        //$basicSalary = $employeeData['basic_salary'] ?? 0;
        //$calculatedComponents['BASIC'] = $basicSalary;

        /*$earnings['BASIC'] = [
            'component_id' => 0, // or null, or fetch from pay_components table if BASIC is stored there
            'component_name' => 'Basic Pay',
            'component_code' => 'BASIC',
            'amount' => $basicSalary,
            'is_taxable' => true,
        ];*/

        // Get all component details with rules
        $componentIds = $employeeComponents->pluck('component_id')->toArray();
        $components = PayComponent::with(['componentType'])
            ->whereIn('component_id', $componentIds)
            ->where('active', 1)
            ->orderBy('component_id')
            ->get()
            ->keyBy('component_id');

        // STEP 1: Separate components into earnings and deductions
        $earningComponents = [];
        $deductionComponents = [];
        $grossDependentComponents = [];

        foreach ($employeeComponents as $empComponent) {
            $component = $components->get($empComponent->component_id);
            
            if (!$component) {
                continue;
            }

            // Get active rule for this component
            $rule = PayComponentRule::where('component_id', $component->component_id)
                ->where('active', 1)
                ->where('with_effect_from', '<=', $effectiveDate)
                ->orderBy('with_effect_from', 'desc')
                ->first();

            $componentData = [
                'component' => $component,
                'rule' => $rule,
                'empComponent' => $empComponent
            ];

            // Check if component depends on GROSS
            $dependsOnGross = $this->checkIfDependsOnGross($rule);

            if ($component->componentType->pay_effect === 'ADD') {
                if ($dependsOnGross) {
                    $grossDependentComponents[] = $componentData;
                } else {
                    $earningComponents[] = $componentData;
                }
            } elseif ($component->componentType->pay_effect === 'DEDUCT') {
                if ($dependsOnGross) {
                    $grossDependentComponents[] = $componentData;
                } else {
                    $deductionComponents[] = $componentData;
                }
            }
        }

        // STEP 2: Calculate earnings that don't depend on GROSS
        foreach ($earningComponents as $componentData) {
            $component = $componentData['component'];
            $rule = $componentData['rule'];
            $empComponent = $componentData['empComponent'];

            $amount = $this->calculateComponent(
                $component,
                $rule,
                $empComponent,
                $employeeData,
                $calculatedComponents,
                $effectiveDate
            );

            $componentCode = $component->component_code;
            $calculatedComponents[$componentCode] = $amount;

            $earnings[$componentCode] = [
                'component_id' => $component->component_id,
                'component_name' => $component->component_name,
                'component_code' => $componentCode,
                'amount' => $amount,
                'is_taxable' => $component->is_taxable ?? false,
            ];
        }

        // STEP 3: Calculate GROSS (sum of all earnings calculated so far)
        $grossEarnings = array_sum(array_column($earnings, 'amount'));
        $calculatedComponents['GROSS'] = $grossEarnings;

        Log::info("GROSS calculated", [
            'emp_no' => $empNo,
            'gross' => $grossEarnings,
            'earnings_breakdown' => $earnings
        ]);

        // STEP 4: Calculate components that depend on GROSS
        foreach ($grossDependentComponents as $componentData) {
            $component = $componentData['component'];
            $rule = $componentData['rule'];
            $empComponent = $componentData['empComponent'];

            $amount = $this->calculateComponent(
                $component,
                $rule,
                $empComponent,
                $employeeData,
                $calculatedComponents,
                $effectiveDate
            );

            $componentCode = $component->component_code;
            $calculatedComponents[$componentCode] = $amount;

            if ($component->componentType->pay_effect === 'ADD') {
                $earnings[$componentCode] = [
                    'component_id' => $component->component_id,
                    'component_name' => $component->component_name,
                    'component_code' => $componentCode,
                    'amount' => $amount,
                    'is_taxable' => $component->is_taxable ?? false,
                ];
                
                // Update GROSS to include this earning
                $grossEarnings += $amount;
                $calculatedComponents['GROSS'] = $grossEarnings;
            } elseif ($component->componentType->pay_effect === 'DEDUCT') {
                $deductions[$componentCode] = [
                    'component_id' => $component->component_id,
                    'component_name' => $component->component_name,
                    'component_code' => $componentCode,
                    'amount' => $amount,
                    'is_taxable' => $component->is_taxable ?? false,
                ];
            }
        }

        // STEP 5: Calculate deductions that don't depend on GROSS
        foreach ($deductionComponents as $componentData) {
            $component = $componentData['component'];
            $rule = $componentData['rule'];
            $empComponent = $componentData['empComponent'];

            $amount = $this->calculateComponent(
                $component,
                $rule,
                $empComponent,
                $employeeData,
                $calculatedComponents,
                $effectiveDate
            );

            $componentCode = $component->component_code;
            
            if($componentCode == 'IT'){
                $EmpProjectTaxAmt = 0;
                if (isset($OtherParam['Page']) && $OtherParam['Page'] === 'PAYGEN') {
                    $EmpProjTaxData = $OtherParam['projected_prev_calc_tax'];
                    if(filled($EmpProjTaxData)){
                        $EmpProjectTaxAmt = $EmpProjTaxData->pluck('month_tax_amt')->first();
                        /*if($empNo == 2345){
                            dd($EmpProjectTaxAmt);
                        }*/
                    }
                    $deductions[$componentCode] = [
                        'component_id' => $component->component_id,
                        'component_name' => $component->component_name,
                        'component_code' => $componentCode,
                        'amount' => $EmpProjectTaxAmt,
                        'is_taxable' => $component->is_taxable ?? false,
                    ];
                }
                $calculatedComponents[$componentCode] = $EmpProjectTaxAmt;
            }else{
                $deductions[$componentCode] = [
                    'component_id' => $component->component_id,
                    'component_name' => $component->component_name,
                    'component_code' => $componentCode,
                    'amount' => $amount,
                    'is_taxable' => $component->is_taxable ?? false,
                ];
                $calculatedComponents[$componentCode] = $amount;
            }
            
        }
        
        

        // Calculate final totals
        $totalDeductions = array_sum(array_column($deductions, 'amount'));
        
        $loanDeductions = 0; $loanDisbursement = 0;
        $ActiveLoan = $employeeData['active_loan'] ?? [];
        /*if($empNo == 68){
            dd($ActiveLoan);    
        }*/
        if(filled($ActiveLoan)){
            $loanDeductions = array_sum(array_column($ActiveLoan, 'loan_recovery_amt'));
            $loanDisbursement = array_sum(array_column($ActiveLoan, 'loan_disbursement_amt'));
            foreach($ActiveLoan as $ActiveLoanList){ 
                
                $AlLoanData = $ActiveLoanList['loan_data'];
                $AlInstallData = $ActiveLoanList['install_data'];
                $AlEmiAmount = array_sum(array_column($AlInstallData, 'total_amount'));  
                $deductions[$AlLoanData->component_code] = [
                    'component_id' => $AlLoanData->component_id ?? false,
                    'component_name' => $AlLoanData->component_code ?? false,
                    'component_code' => $AlLoanData->component_code,
                    'amount' => $AlEmiAmount ?? 0,
                    'is_taxable' => false,
                ];
                $calculatedComponents[$AlLoanData->component_code] = $AlEmiAmount ?? 0;
            }
                
        }
        
        $totalDeductions = $totalDeductions + $loanDeductions;
        $grossEarnings = $grossEarnings + $loanDisbursement;

        $OtherRecoveryAmt = 0; $insuranceDeductions = 0; $insuranceData = [];
        $OtherRecovery = $employeeData['other_recovery'] ?? [];
        if(filled($OtherRecovery)){
            $OtherRecoveryAmt += $OtherRecovery['eb_amount'] ?? 0;
            $OtherRecoveryAmt += $OtherRecovery['licence_fee'] ?? 0;
            $OtherRecoveryAmt += $OtherRecovery['water_charge'] ?? 0;

            $insuranceDeductions = $OtherRecovery['insurance_amount'] ?? 0;
            $insuranceData = $OtherRecovery['insurance_data'] ?? [];
        }
        $investPayComponents = $OtherParam['investPayComponents'];
        if(filled($investPayComponents)){
            foreach($investPayComponents as $investComponents){
                $InvestComponentId = $investComponents->component_id;
                $InvestComponentCode = $investComponents->component_code;
                $InvestComponentName = $investComponents->component_name;
                if(isset($insuranceData[$InvestComponentCode])){
                    $InvestAmount = $insuranceData[$InvestComponentCode]['premium_amount'] ?? 0;
                }else{
                    $InvestAmount = 0;
                }
                $deductions[$InvestComponentCode] = [
                    'component_id' => $InvestComponentId ?? false,
                    'component_name' => $InvestComponentName ?? false,
                    'component_code' => $InvestComponentCode,
                    'amount' => $InvestAmount ?? 0,
                    'is_taxable' => false,
                ];
                $calculatedComponents[$InvestComponentCode] = $InvestAmount ?? 0;
            }
        }


        $totalDeductions = $totalDeductions + $OtherRecoveryAmt + $insuranceDeductions;
        $netSalary = $grossEarnings - $totalDeductions;
        

        $homePayComponents = $OtherParam['homePayComponents'];
        if(isset($homePayComponents['EB'])){
            $EBComponentData = $homePayComponents['EB'];
            $EBComponentId = $EBComponentData->component_id;
            $EBComponentCode = $EBComponentData->component_code;
            $EBComponentName = $EBComponentData->component_name;
            $EBComponentTypeId = $EBComponentData->component_type_id;
            $EBComponentIsTaxable = $EBComponentData->is_taxable;
        }
        $deductions['EB'] = [
            'component_id' => $EBComponentId ?? false,
            'component_name' => $EBComponentName ?? false,
            'component_code' => 'EB',
            'amount' => $OtherRecovery['eb_amount'] ?? 0,
            'is_taxable' => $EBComponentIsTaxable ?? false,
        ];
        $calculatedComponents['EB'] = $OtherRecovery['eb_amount'] ?? 0;
        if(isset($homePayComponents['WC'])){
            $WCComponentData = $homePayComponents['WC'];
            $WCComponentId = $WCComponentData->component_id;
            $WCComponentCode = $WCComponentData->component_code;
            $WCComponentName = $WCComponentData->component_name;
            $WCComponentTypeId = $WCComponentData->component_type_id;
            $WCComponentIsTaxable = $WCComponentData->is_taxable;
        }
        $deductions['WC'] = [
            'component_id' => $WCComponentId ?? false,
            'component_name' => $WCComponentName ?? false,
            'component_code' => 'WC',
            'amount' => $OtherRecovery['water_charge'] ?? 0,
            'is_taxable' => $WCComponentIsTaxable ?? false,
        ];
        $calculatedComponents['WC'] = $OtherRecovery['water_charge'] ?? 0;
        if(isset($homePayComponents['LF'])){
            $LFComponentData = $homePayComponents['LF'];
            $LFComponentId = $LFComponentData->component_id;
            $LFComponentCode = $LFComponentData->component_code;
            $LFComponentName = $LFComponentData->component_name;
            $LFComponentTypeId = $LFComponentData->component_type_id;
            $LFComponentIsTaxable = $LFComponentData->is_taxable;
        }
        $deductions['LF'] = [
            'component_id' => $LFComponentId ?? false,
            'component_name' => $LFComponentName ?? false,
            'component_code' => 'LF',
            'amount' => $OtherRecovery['licence_fee'] ?? 0,
            'is_taxable' => $LFComponentIsTaxable ?? false,
        ];
        $calculatedComponents['LF'] = $OtherRecovery['licence_fee'] ?? 0;

        $EmpFinalData = [
            'emp_no' => $empNo,
            'calculation_date' => $effectiveDate,
            'earnings' => $earnings,
            'gross_earnings' => $grossEarnings,
            'deductions' => $deductions,
            'total_deductions' => $totalDeductions,
            'net_salary' => $netSalary,
            'calculated_components' => $calculatedComponents,
            'loan_data' => $ActiveLoan,
            'loan_deduction' => $loanDeductions,
            'other_deduction' => $OtherRecovery,
            'loan_disbursement' => $loanDisbursement,
            'insurance_amount' => $insuranceDeductions,
            'insurance_data' => $insuranceData,
        ]; 

        $ItCalcMode = $employeeData['it_calc_mode'] ?? NULL;
        if($ItCalcMode == 'PROJECTED'){
            $ItCalculateData = $this->ItCalculationService->CalculateIncomeTax($empNo, $employeeData, $calculatedComponents,$EmpFinalData, $OtherParam);
        }else{
            $ItCalculateData = $this->ItCalculationService->CalculateIncomeTax($empNo, $employeeData, $calculatedComponents,$EmpFinalData, $OtherParam);
        }
        $EmpFinalData['tax_data'] = $ItCalculateData;
        $EmpTaxRegime = $employeeData['tax_regime'] ?? 'NEW';
        $EmpFinalData['tax_regime'] = $EmpTaxRegime;
        if($EmpTaxRegime == "OLD"){
            $EmpFinalData['tax_amount'] = $ItCalculateData['tax_amount_old_regime'] ?? 0;
        }else if($EmpTaxRegime == "NEW"){
            $EmpFinalData['tax_amount'] = $ItCalculateData['tax_amount_new_regime'] ?? 0;
        }else{
            $EmpFinalData['tax_amount'] = 0;
        } 
        return $EmpFinalData;
    }

    /**
     * Check if a rule depends on GROSS
     */
    protected function checkIfDependsOnGross($rule)
    {
        if (!$rule) {
            return false;
        }

        // Check if formula contains GROSS
        if ($rule->formula && strpos($rule->formula, 'GROSS') !== false) {
            return true;
        }

        // Check if base_component is GROSS
        if ($rule->base_component === 'GROSS') {
            return true;
        }

        // Check formula_json for GROSS dependency
        if ($rule->formula_json) {
            $config = json_decode($rule->formula_json, true);
            
            // Check in conditions
            if (isset($config['conditions'])) {
                foreach ($config['conditions'] as $condition) {
                    if (isset($condition['formula']) && strpos($condition['formula'], 'GROSS') !== false) {
                        return true;
                    }
                }
            }

            // Check in default_formula
            if (isset($config['default_formula']) && strpos($config['default_formula'], 'GROSS') !== false) {
                return true;
            }

            // Check in slabs base
            if (isset($config['base']) && $config['base'] === 'GROSS') {
                return true;
            }
        }

        return false;
    }

    /**
     * Calculate individual component amount
     */
    protected function calculateComponent(
        $component,
        $rule,
        $empComponent,
        array $employeeData,
        array $calculatedComponents,
        $effectiveDate
    ) {
        // If no rule found, use employee component amount/percentage if exists
        if (!$rule) {
            if ($empComponent->amount !== null) {
                return floatval($empComponent->amount);
            }
            if ($empComponent->percentage !== null && isset($calculatedComponents['BASIC'])) {
                return ($calculatedComponents['BASIC'] * $empComponent->percentage) / 100;
            }
            return 0;
        }

        // Determine calculation based on rule_type_id
        $amount = 0;

        switch ($rule->rule_type_id) {
            case 1: // FIXED
                $amount = $this->calculateFixed($rule, $employeeData,$effectiveDate);
                break;
                
            case 2: // PERCENTAGE
                $amount = $this->calculatePercentage($rule, $employeeData, $calculatedComponents,$effectiveDate);
                break;
                
            case 3: // FORMULA
                $amount = $this->calculateFormula($rule, $employeeData, $calculatedComponents,$effectiveDate);
                break;
                
            case 4: // CONDITIONAL (based on formula_json)
                $amount = $this->calculateConditional($rule, $employeeData, $calculatedComponents,$effectiveDate);
                break;
                
            case 5: // SLAB_BASED (based on formula_json)
                $amount = $this->calculateSlabBased($rule, $employeeData, $calculatedComponents,$effectiveDate);
                break;
                
            default:
                $amount = 0;
        }
        $IsDisablity = $employeeData['emp_data']['is_phy_challange'] ?? false;
        // ── NEW: Double final TA amount if employee has disability ──
        if ($component->component_code === 'TA' && ($IsDisablity)) {
            Log::info("TA doubled due to disability", [
                'emp_no'    => $empComponent->emp_no,
                'original'  => $amount,
                'doubled'   => $amount * 2,
            ]);
            $amount = $amount * 2;
        }

        // Apply min/max limits
        if ($rule->min_amount !== null && $amount < $rule->min_amount) {
            $amount = $rule->min_amount;
        }
        if ($rule->max_amount !== null && $amount > $rule->max_amount) {
            $amount = $rule->max_amount;
        }

        return round($amount, 2);
    }

    /**
     * Calculate fixed amount
     */
    protected function calculateFixed($rule, array $employeeData,$effectiveDate)
    {
        if ($rule->fixed_amount !== null) {
            return floatval($rule->fixed_amount);
        }

        // Check formula_json for additional parameters
        if ($rule->formula_json) {
            $params = json_decode($rule->formula_json, true);
            
            // Support for disability multiplier
            if (isset($params['disability_multiplier']) && isset($employeeData['is_disabled']) && $employeeData['is_disabled']) {
                return floatval($rule->fixed_amount) * $params['disability_multiplier'];
            }
            
            // Support for variable fixed amount
            if (isset($params['variables']['TA_FIXED'])) {
                return floatval($params['variables']['TA_FIXED']);
            }
        }

        return 0;
    }

    /**
     * Calculate percentage-based amount
     */
    protected function calculatePercentage($rule, array $employeeData, array $calculatedComponents,$effectiveDate)
    {
        $percentage = $rule->fixed_percentage ?? 0;
        $baseComponent = $rule->base_component ?? 'BASIC';
        
        // Get base amount
        if ($baseComponent === 'BASIC') {
            $baseAmount = $calculatedComponents['BASIC'] ?? $employeeData['basic_salary'] ?? 0;
        } elseif (isset($calculatedComponents[$baseComponent])) {
            $baseAmount = $calculatedComponents[$baseComponent];
        } else {
            Log::warning("Base component not found", [
                'base_component' => $baseComponent,
                'available_components' => array_keys($calculatedComponents)
            ]);
            $baseAmount = 0;
        }

        return ($baseAmount * $percentage) / 100;
    }

    /**
     * Calculate formula-based amount
     * Example formulas:
     * - BASIC * 58 / 100
     * - TA_FIXED + (TA_FIXED * DA_PERC / 100)
     */
    protected function calculateFormula($rule, array $employeeData, array $calculatedComponents,$effectiveDate)
    {
        if (empty($rule->formula)) {
            return 0;
        }

        $formula = $rule->formula;
        
        // Get variables from formula_json
        $variables = [];
        if ($rule->formula_json) {
            $params = json_decode($rule->formula_json, true);
            if (isset($params['variables']) && is_array($params['variables'])) {
                $variables = $params['variables'];
            }
        }
        // ── NEW: Resolve TA_FIXED from erp_ta_fixed based on employee pay_level ──
        if (strpos($formula, 'TA_FIXED') !== false) {
            $payLevel = $employeeData['pay_level'] ?? null; 
            $taFixed = 0;

            if ($payLevel !== null) {
                $taRow = DB::table('erp_ta_fixed')
                    ->where('pay_level', $payLevel)
                    ->first(); 
                $taFixed = $taRow ? floatval($taRow->ta_amount) : 0;
            }

            $variables['TA_FIXED'] = $taFixed;
        }

        // ── NEW: Resolve DA_PERC from rule's fixed_percentage column ──
        if (strpos($formula, 'DA_PERC') !== false) {
            $daComponent = DB::table('erp_pay_component')
                ->where('component_code', 'DA')
                ->where('active', 1)
                ->first();

            $daPerc = 0;
            if ($daComponent) {
                $daRule = DB::table('erp_pay_component_rule')
                    ->where('component_id', $daComponent->component_id)
                    ->where('active', 1)
                    ->where('with_effect_from', '<=', $effectiveDate)
                    ->orderBy('with_effect_from', 'desc')
                    ->first(); 

                $daPerc = $daRule ? floatval($daRule->fixed_percentage ?? 0) : 0;
            }

            $variables['DA_PERC'] = $daPerc;
        }

        // Replace component codes with their values
        /*foreach ($calculatedComponents as $code => $value) {
            $formula = str_replace($code, $value, $formula);
        }

        // Replace variables
        foreach ($variables as $varName => $varValue) {
            $formula = str_replace($varName, $varValue, $formula);
        }

        // Replace from employee data (only numeric values)
        foreach ($employeeData as $key => $value) {
            if (is_numeric($value)) {
                $formula = str_replace($key, $value, $formula);
            }
        }*/


        // ── STEP 1: Replace variables FIRST (before component codes) ──
        // Sort by key length descending to avoid partial replacements
        uksort($variables, fn($a, $b) => strlen($b) - strlen($a));
        foreach ($variables as $varName => $varValue) {
            $formula = str_replace($varName, $varValue, $formula);
        }

        // ── STEP 2: Replace component codes (sort longest first to avoid partial matches) ──
        $sortedComponents = $calculatedComponents;
        uksort($sortedComponents, fn($a, $b) => strlen($b) - strlen($a));
        foreach ($sortedComponents as $code => $value) {
            $formula = str_replace($code, $value, $formula);
        }

        // ── STEP 3: Replace employee data numeric values ──
        foreach ($employeeData as $key => $value) {
            if (is_numeric($value)) {
                $formula = str_replace($key, $value, $formula);
            }
        }

        Log::debug("Formula evaluation", [
            'original'              => $rule->formula,
            'after_substitution'    => $formula,
            'ta_fixed'              => $variables['TA_FIXED'] ?? 'N/A',
            'da_perc'               => $variables['DA_PERC'] ?? 'N/A',
            'available_components'  => array_keys($calculatedComponents)
        ]);

        try {
            // Evaluate the formula safely
            $result = $this->evaluateFormula($formula);
            return is_numeric($result) ? floatval($result) : 0;
        } catch (\Exception $e) {
            Log::error("Formula calculation error: " . $e->getMessage(), [
                'formula' => $formula,
                'rule_id' => $rule->rule_id,
                'available_components' => array_keys($calculatedComponents)
            ]);
            return 0;
        }
    }

    /**
     * Calculate conditional amount
     * Based on conditions in formula_json
     */
    protected function calculateConditional($rule, array $employeeData, array $calculatedComponents,$effectiveDate)
    {
        if (empty($rule->formula_json)) {
            return 0;
        }

        $config = json_decode($rule->formula_json, true);
        
        if (!isset($config['conditions']) || !is_array($config['conditions'])) {
            return 0;
        }

        // Check each condition
        foreach ($config['conditions'] as $condition) {
            $field = $condition['field'] ?? null;
            $operator = $condition['operator'] ?? '=';
            $value = $condition['value'] ?? null;
            $formula = $condition['formula'] ?? null;

            if (!$field || !$formula) {
                continue;
            }

            // Get field value
            $fieldValue = $employeeData[$field] ?? $calculatedComponents[$field] ?? null;

            // Check condition
            if ($this->evaluateCondition($fieldValue, $operator, $value)) {
                return $this->evaluateFormulaWithVariables($formula, $calculatedComponents, $employeeData);
            }
        }

        // Return default formula if exists
        if (isset($config['default_formula'])) {
            return $this->evaluateFormulaWithVariables($config['default_formula'], $calculatedComponents, $employeeData);
        }

        return 0;
    }

    /**
     * Calculate slab-based amount
     */
    protected function calculateSlabBased($rule, array $employeeData, array $calculatedComponents,$effectiveDate)
    {
        if (empty($rule->formula_json)) {
            return 0;
        }

        $config = json_decode($rule->formula_json, true);
        
        if (!isset($config['slabs']) || !is_array($config['slabs'])) {
            return 0;
        }

        $base = $config['base'] ?? 'GROSS';
        
        // Get base amount
        if ($base === 'GROSS') {
            $baseAmount = $calculatedComponents['GROSS'] ?? 0;
        } elseif (isset($calculatedComponents[$base])) {
            $baseAmount = $calculatedComponents[$base];
        } else {
            $baseAmount = $employeeData[$base] ?? 0;
        }

        Log::debug("Slab calculation", [
            'base' => $base,
            'base_amount' => $baseAmount,
            'slabs' => $config['slabs']
        ]);

        // Find applicable slab
        foreach ($config['slabs'] as $slab) {
            $min = $slab['min'] ?? 0;
            $max = $slab['max'] ?? PHP_FLOAT_MAX;
            
            if ($baseAmount >= $min && ($max === null || $baseAmount <= $max)) {
                return floatval($slab['amount'] ?? 0);
            }
        }

        return 0;
    }

    /**
     * Evaluate a condition
     */
    protected function evaluateCondition($fieldValue, $operator, $value)
    {
        switch ($operator) {
            case '=':
            case '==':
                return $fieldValue == $value;
            case '!=':
                return $fieldValue != $value;
            case '>':
                return $fieldValue > $value;
            case '>=':
                return $fieldValue >= $value;
            case '<':
                return $fieldValue < $value;
            case '<=':
                return $fieldValue <= $value;
            default:
                return false;
        }
    }

    /**
     * Evaluate formula with variable substitution
     */
    protected function evaluateFormulaWithVariables($formula, array $calculatedComponents, array $employeeData)
    {
        // Replace component codes
        foreach ($calculatedComponents as $code => $value) {
            $formula = str_replace($code, $value, $formula);
        }

        // Replace employee data (only numeric values)
        foreach ($employeeData as $key => $value) {
            if (is_numeric($value)) {
                $formula = str_replace($key, $value, $formula);
            }
        }

        try {
            return $this->evaluateFormula($formula);
        } catch (\Exception $e) {
            Log::error("Formula evaluation error: " . $e->getMessage(), ['formula' => $formula]);
            return 0;
        }
    }

    /**
     * Safely evaluate a mathematical formula
     * FIXED: Improved formula sanitization and evaluation
     */
    protected function evaluateFormula($formula)
    {
        // Trim whitespace
        $formula = trim($formula);
        
        if (empty($formula)) {
            return 0;
        }

        // Remove spaces for easier parsing
        $formula = str_replace(' ', '', $formula);
        
        // Only allow numbers, operators, parentheses, and decimal points
        if (!preg_match('/^[0-9+\-*\/().]+$/', $formula)) {
            Log::warning("Invalid formula characters detected", ['formula' => $formula]);
            return 0;
        }
        
        // Check for balanced parentheses
        if (substr_count($formula, '(') !== substr_count($formula, ')')) {
            Log::warning("Unbalanced parentheses in formula", ['formula' => $formula]);
            return 0;
        }

        try {
            // Use a safer evaluation method
            $result = $this->safeEval($formula);
            return is_numeric($result) ? floatval($result) : 0;
        } catch (\Throwable $e) {
            Log::error("Formula evaluation error", [
                'formula' => $formula,
                'error' => $e->getMessage()
            ]);
            return 0;
        }
    }

    /**
     * Safe mathematical expression evaluator
     */
    protected function safeEval($expression)
    {
        // Remove any remaining whitespace
        $expression = trim($expression);
        
        if (empty($expression)) {
            return 0;
        }

        try {
            $result = eval("return ($expression);");
            
            if ($result === false || !is_numeric($result)) {
                return 0;
            }
            
            return $result;
            
        } catch (\ParseError $e) {
            Log::error("Parse error in formula", [
                'expression' => $expression,
                'error' => $e->getMessage()
            ]);
            return 0;
        } catch (\Throwable $e) {
            Log::error("Evaluation error in formula", [
                'expression' => $expression,
                'error' => $e->getMessage()
            ]);
            return 0;
        }
    }

    /**
     * Empty payroll response
     */
    protected function emptyPayrollResponse()
    {
        return [
            'emp_no' => null,
            'calculation_date' => now()->format('Y-m-d'),
            'earnings' => [],
            'gross_earnings' => 0,
            'deductions' => [],
            'total_deductions' => 0,
            'net_salary' => 0,
            'calculated_components' => [],
        ];
    }

    /**
     * Calculate payroll for multiple employees
     */
    public function calculateBulkPayroll(array $empNos, array $commonData = [], $effectiveDate = null)
    {
        $results = [];

        foreach ($empNos as $empNo) {
            // You can fetch employee-specific data from database here
            $employeeData = array_merge($commonData, [
                // Add employee-specific data fetched from employee master table
            ]);

            $results[$empNo] = $this->calculatePayroll($empNo, $employeeData, $effectiveDate);
        }

        return $results;
    }
}