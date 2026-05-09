<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Helper;
use App\Models\DependentMaster;

class DependentController extends Controller
{
    public function __construct(){ 
        $this->DependentMaster = new DependentMaster();
    }
    public function GetDependent(Request $request)
    {
       return $this->DependentMaster->ShowDependent($request->dependent);
    }
}
