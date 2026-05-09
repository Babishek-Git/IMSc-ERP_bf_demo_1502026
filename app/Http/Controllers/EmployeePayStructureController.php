<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Helper;
class EmployeePayStructureController extends Controller
{
    public function EmployeePayStructure(Request $request)
    {
        return view('payroll.SamplePage');//->with('data', compact('OrganizationList'));
    }
}
