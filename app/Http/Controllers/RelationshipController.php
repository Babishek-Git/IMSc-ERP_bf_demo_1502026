<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Helper;
use App\Models\EmpRelationshipMaster;

class RelationshipController extends Controller
{
    public function __construct(){ 
        $this->EmpRelationshipMaster = new EmpRelationshipMaster();
    }
    public function GetRelationShip(Request $request)
    {
       return $this->EmpRelationshipMaster->ShowRelatonshipByDependent($request->Dependent);
    }
    public function GetRelationShipByRelationId(Request $request)
    {
       $RelData = $this->EmpRelationshipMaster->ShowRelatonship($request->RelationshipId);
       $ReturnArr = array('RelData' => $RelData);
       return $ReturnArr;
    }
}
