<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Helper;
use App\Models\EmpChangeRequest;
use App\Models\AemEmployee;
use App\Models\AMCPurchaseOrder;

class AMCElectricalRegisterController extends Controller
{
    public function __construct(){ 
        $this->ChangeRequest = new EmpChangeRequest();
        $this->Employee = new AemEmployee();
        $this->AMCPurchaseOrder = new AMCPurchaseOrder();
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
    public function AMCElectricalRegister(Request $request)
    {
        $AmcElectricalData = Null;
        $AmcElectricalData = $this->AMCPurchaseOrder->showElectricalAMCPoDetails(NULL);
        
        return view('register.amc-electrical-register')->with('data', compact('AmcElectricalData'));
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
