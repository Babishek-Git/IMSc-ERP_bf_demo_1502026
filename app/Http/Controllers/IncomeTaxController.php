<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Helper;
use App\Models\emp_payroll_transactions;
use App\Models\emp_pris_transactions;
class IncomeTaxController extends Controller
{
    public function ITCalculation(Request $request)
    {
        
        $payRollTransData = emp_payroll_transactions::get();
        $prisTransData = emp_pris_transactions::get();
        return view('incometax.IncomeTaxCalculation')->with('data', compact('payRollTransData','prisTransData'));
    }
}
