<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Helper;
use App\Models\EmpChangeRequest;
use App\Models\AemEmployee;

class WaitingApprovalController extends Controller
{
    public function __construct(){ 
        $this->ChangeRequest = new EmpChangeRequest();
        $this->Employee = new AemEmployee();
    }
    public function AddressApproval(Request $request)
    {
        $AddressData = $this->ChangeRequest->ShowEmpyChangeRequest('ADDRESS');
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
        $ContactData = $this->ChangeRequest->ShowEmpyChangeRequest('MOBILE');
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
    public function BankDetailsApproval(Request $request)
    {
        $BankData = $this->ChangeRequest->ShowEmpyChangeRequest('BANK');
       // dd($BankData);
        $EmpGroupedData = NULL;
        if(filled($BankData)){
            $EmpNoArr = collect($BankData)->pluck('emp_no')->toArray();
            $EmpData = $this->Employee->ShowMultipleEmployees($EmpNoArr);
            if(filled($EmpData)){
                $EmpGroupedData = collect($EmpData)->keyBy('emp_no');
            }
        }
        return view('wating-for-approval.bank-details-update-approval')->with('data', compact('BankData','EmpGroupedData'));
    }
    public function MaritalStatusUpdateApproval(Request $request)
    {
        $MaritalData = $this->ChangeRequest->ShowEmpyChangeRequest('MARRIAGE_CERT');
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
        $PhysicalData = $this->ChangeRequest->ShowEmpyChangeRequest('DISABILITY');
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
