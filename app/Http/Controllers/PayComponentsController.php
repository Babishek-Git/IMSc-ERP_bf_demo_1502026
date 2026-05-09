<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\PayComponent;
use App\Models\PayComponentType;
use Helper;
class PayComponentsController extends Controller
{
    public function __construct(){ 
         $this->paycomponenttype = new PayComponentType();
         $this->paycomponent = new PayComponent();
     }
    public function PayComponent(Request $request)
    {
        $paycomponentTypeData = $this->paycomponenttype->getWithComponent();
        $paycomponentData= $this->paycomponent->ShowComponentTypeName();
       // dd($paycomponentData);
        return view('payroll.pay-component-master.pay-component.pay-component')->with('data', compact('paycomponentTypeData','paycomponentData'));//->with('data', compact('OrganizationList'));
    }
}
