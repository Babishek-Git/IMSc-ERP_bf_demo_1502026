<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\PayComponent;
use App\Models\PayComponentRuleType;
use App\Models\PayComponentRule;
use Helper;
class PayComponentRulesController extends Controller
{
    public function PayComponentRule(Request $request)
    {
        //Here withType calls scopeWithType function and active calls scopeActive in PayComponent Model (It is a laravel  features)
        $components = PayComponent::withType()->active()->get(); 
        $ruleType = PayComponentRuleType::active()->get(); 

        $input = "If [CHSS == Y] THEN [((TA + (TA * DA %)) * 2)] ELSE [(TA + (TA * DA %))]";
        //$input = "If [CHSS == Y] THEN [((TA + (TA * DA %) + (TA + (TA/2)) * 2))] ELSE [(TA + (TA/3) + ((TA*4) + TA) + (TA * DA %))]";
        $steps = $this->compileFormula($input);
        //dd($steps);
        if(isset($request->btn_view))
        { 
           $RuleData = PayComponentRule::ShowPaycomponentType()->get(); 
           return view('payroll.pay-component-master.pay-component-rule.pay-component-rule-view')->with('data', compact('RuleData'));
        }
         if(isset($request->btn_back))
        { 
             return redirect()->back();
        }
        return view('payroll.pay-component-master.pay-component-rule.pay-component-rule')->with('data', compact('components','ruleType'));
    }

    public function tokenize(string $expr): array{
        $expr = str_replace(['[', ']'], '', $expr);
        preg_match_all(
            '/\d+|\w+|==|!=|>=|<=|[()+\-*\/%]/',
            $expr,
            $matches
        );
        return $matches[0];
    }

    public function normalizePercent(array $tokens): array{
        $out = [];
        for ($i = 0; $i < count($tokens); $i++) {
            if ($tokens[$i] === '%') {
                $out[] = '/';
                $out[] = '100';
            } else {
                $out[] = $tokens[$i];
            }
        }
        return $out;
    }

    public function toPostfix(array $tokens): array{
        $prec = ['+' => 1, '-' => 1, '*' => 2, '/' => 2];
        $out = [];
        $stack = [];

        foreach ($tokens as $t) {
            if (is_numeric($t) || preg_match('/^[A-Z]+$/', $t)) {
                $out[] = $t;
            } elseif ($t === '(') {
                $stack[] = $t;
            } elseif ($t === ')') {
                while (($op = array_pop($stack)) !== '(') {
                    $out[] = $op;
                }
            } else {
                while (
                    !empty($stack) &&
                    end($stack) !== '(' &&
                    $prec[end($stack)] >= $prec[$t]
                ) {
                    $out[] = array_pop($stack);
                }
                $stack[] = $t;
            }
        }

        while ($stack) {
            $out[] = array_pop($stack);
        }

        return $out;
    }

    public function postfixToSteps(array $postfix, int &$counter, array &$steps): string{
        $stack = [];

        foreach ($postfix as $t) {
            if (is_numeric($t) || preg_match('/^[A-Z]+$/', $t)) {
                $stack[] = $t;
            } else {
                $b = array_pop($stack);
                $a = array_pop($stack);

                $x = 'X' . $counter++;
                $steps[] = "$x = $a $t $b";
                $stack[] = $x;
            }
        }

        return array_pop($stack);
    }

    public function compileFormula(string $input): array{
        preg_match(
            '/IF \[(.+?)\] THEN \[(.+?)\] ELSE \[(.+?)\]/i',
            $input,
            $m
        );

        $counter = 1;
        $steps = [];

        foreach (['then', 'else'] as $idx => $key) {
            $expr = $m[$idx + 2];

            $tokens = $this->tokenize($expr);
            $tokens = $this->normalizePercent($tokens);
            $postfix = $this->toPostfix($tokens);

            ${$key} = $this->postfixToSteps($postfix, $counter, $steps);
        }

        $steps[] = "IF {$m[1]} THEN $then ELSE $else";
        return $steps;
    }






    /*public function splitFormula(string $input): array
    {
        preg_match(
            '/IF \[(.+?)\] THEN \[(.+?)\] ELSE \[(.+?)\]/i',
            $input,
            $m
        );

        return [
            'condition' => trim($m[1]),
            'then' => trim($m[2]),
            'else' => trim($m[3]),
        ];
    }

    public function splitTopLevel(string $expr, string $operator): ?array{
        $depth = 0;
        $len = strlen($expr);

        for ($i = 0; $i < $len; $i++) {
            if ($expr[$i] === '(') $depth++;
            if ($expr[$i] === ')') $depth--;

            if ($depth === 0 && $expr[$i] === $operator) {
                return [
                    substr($expr, 0, $i),
                    substr($expr, $i + 1),
                ];
            }
        }

        return null;
    }


    public function expressionToSteps(string $expr, int &$counter, array &$steps): string{
        $expr = trim($expr);

        // Remove outer parentheses safely
        if (
            $expr[0] === '(' &&
            substr($expr, -1) === ')' &&
            $this->balancedParentheses(substr($expr, 1, -1))
        ) {
            return $this->expressionToSteps(substr($expr, 1, -1), $counter, $steps);
        }

        // Percentage
        if (str_ends_with($expr, '%')) {
            $x = 'X' . $counter++;
            $steps[] = "$x = " . rtrim($expr);
            return $x;
        }

        // Multiplication (top-level only)
        if ($parts = $this->splitTopLevel($expr, '*')) {
            [$l, $r] = $parts;

            $left  = $this->expressionToSteps($l, $counter, $steps);
            $right = $this->expressionToSteps($r, $counter, $steps);

            $x = 'X' . $counter++;
            $steps[] = "$x = $left * $right";
            return $x;
        }

        // Addition (top-level only)
        if ($parts = $this->splitTopLevel($expr, '+')) {
            [$l, $r] = $parts;

            $left  = $this->expressionToSteps($l, $counter, $steps);
            $right = $this->expressionToSteps($r, $counter, $steps);

            $x = 'X' . $counter++;
            $steps[] = "$x = $left + $right";
            return $x;
        }

        return $expr;
    }

    public function balancedParentheses(string $expr): bool{
        $depth = 0;
        foreach (str_split($expr) as $c) {
            if ($c === '(') $depth++;
            if ($c === ')') $depth--;
            if ($depth < 0) return false;
        }
        return $depth === 0;
    }*/



    /*public function parseCondition(string $condition): array{
        preg_match('/(\w+)\s*(==|!=|>=|<=|>|<)\s*(\w+)/', $condition, $m);

        return [
            'field'    => $m[1],
            'operator' => $m[2],
            'value'    => $m[3],
        ];
    }
    public function parseExpression(string $expr){
        $expr = trim($expr);

        // Remove outer parentheses
        if ($expr[0] === '(' && substr($expr, -1) === ')') {
            return $this->parseExpression(substr($expr, 1, -1));
        }

        // Multiplication
        if (strpos($expr, '*') !== false) {
            [$left, $right] = explode('*', $expr, 2);

            return [
                'operator' => '*',
                'left'  =>  $this->parseExpression($left),
                'right' =>  $this->parseExpression($right),
            ];
        }

        // Addition
        if (strpos($expr, '+') !== false) {
            [$left, $right] = explode('+', $expr, 2);

            return [
                'operator' => '+',
                'left'  =>  $this->parseExpression($left),
                'right' =>  $this->parseExpression($right),
            ];
        }

        // Percentage (DA % → DA / 100)
        if (str_ends_with($expr, '%')) {
            return [
                'operator' => '/',
                'left'  => rtrim($expr, '%'),
                'right' => 100,
            ];
        }

        // Number
        if (is_numeric($expr)) {
            return (float) $expr;
        }

        // Variable
        return $expr;
    }*/

}
