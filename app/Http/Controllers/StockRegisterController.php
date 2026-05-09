<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Helper;
use App\Models\EmpChangeRequest;
use App\Models\AemEmployee;

class StockRegisterController  extends Controller
{
    public function __construct(){ 
        $this->ChangeRequest = new EmpChangeRequest();
        $this->Employee = new AemEmployee();
    }
    public function AddressApproval(Request $request)
    {
        $AddressData = $this->ChangeRequest->ShowEmpyChangeRequest(NULL,NULL,'ADDRESS');
        $EmpGroupedData = NULL;
        if(filled($AddressData)){
            $EmpNoArr = collect($AddressData)->pluck('emp_no')->toArray();
            $EmpData = $this->Employee->ShowMultipleEmployees($EmpNoArr);
            if(filled($EmpData)){
                $EmpGroupedData = collect($EmpData)->keyBy('emp_no');
            }
        }
        return view('wating-for-approval.addr-update-approval')->with('data', compact('AddressData','EmpGroupedData'));
    }
    public function ContactApproval(Request $request)
    {
        $ContactData = $this->ChangeRequest->ShowEmpyChangeRequest(NULL,NULL,'MOBILE');
        $EmpGroupedData = NULL;
        if(filled($ContactData)){
            $EmpNoArr = collect($ContactData)->pluck('emp_no')->toArray();
            $EmpData = $this->Employee->ShowMultipleEmployees($EmpNoArr);
            if(filled($EmpData)){
                $EmpGroupedData = collect($EmpData)->keyBy('emp_no');
            }
        }
        return view('wating-for-approval.contact-update-approval')->with('data', compact('ContactData','EmpGroupedData'));
    }
    public function StockRegister(Request $request)
    {
        $BankData = $this->ChangeRequest->ShowEmpyChangeRequest(NULL,NULL,'BANK');
       // dd($BankData);
        $EmpGroupedData = NULL;
        if(filled($BankData)){
            $EmpNoArr = collect($BankData)->pluck('emp_no')->toArray();
            $EmpData = $this->Employee->ShowMultipleEmployees($EmpNoArr);
            if(filled($EmpData)){
                $EmpGroupedData = collect($EmpData)->keyBy('emp_no');
            }
        }
        return view('register.stock-register')->with('data', compact('BankData'));
    }
    public function MaritalStatusUpdateApproval(Request $request)
    {
        $MaritalData = $this->ChangeRequest->ShowEmpyChangeRequest(NULL,NULL,'MARRIAGE_CERT');
        $EmpGroupedData = NULL;
        if(filled($MaritalData)){
            $EmpNoArr = collect($MaritalData)->pluck('emp_no')->toArray();
            $EmpData = $this->Employee->ShowMultipleEmployees($EmpNoArr);
            if(filled($EmpData)){
                $EmpGroupedData = collect($EmpData)->keyBy('emp_no');
            }
        }
        return view('wating-for-approval.marital-status-update-approval')->with('data', compact('MaritalData','EmpGroupedData'));
    }
    public function PhysicalUpdateApproval(Request $request)
    {
        $PhysicalData = $this->ChangeRequest->ShowEmpyChangeRequest(NULL,NULL,'DISABILITY');
        $EmpGroupedData = NULL;
        if(filled($PhysicalData)){
            $EmpNoArr = collect($PhysicalData)->pluck('emp_no')->toArray();
            $EmpData = $this->Employee->ShowMultipleEmployees($EmpNoArr);
            if(filled($EmpData)){
                $EmpGroupedData = collect($EmpData)->keyBy('emp_no');
            }
        }
        return view('wating-for-approval.physical-disability-update-approval')->with('data', compact('PhysicalData','EmpGroupedData'));
    }
}
