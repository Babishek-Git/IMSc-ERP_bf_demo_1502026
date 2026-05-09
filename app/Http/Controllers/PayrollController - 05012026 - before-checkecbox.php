<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Helper;
class PayrollController extends Controller
{
    public function SamplePage(Request $request)
    {
        return view('payroll.SamplePage');//->with('data', compact('OrganizationList'));
    }
}
