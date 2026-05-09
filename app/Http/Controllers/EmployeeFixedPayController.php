<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Helper;
class EmployeeFixedPayController extends Controller
{
    public function EmployeeFixedPay(Request $request)
    {
        return view('payroll.emp-pay-component.employee-pay-structure');//->with('data', compact('OrganizationList'));
    }
}
