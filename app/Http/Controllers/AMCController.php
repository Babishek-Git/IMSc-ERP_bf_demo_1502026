<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\AemEmployee;
use App\Models\EmpRelationshipMaster;
use App\Models\EmpFamilyDetails;
use App\Models\EmpDocuments;
use App\Models\DocumentsType;
use App\Models\EmpChangeRequest;
use App\Models\DependentMaster;
use App\Models\BankBranchMaster;
use App\Models\CeaReimbursementDeatil;
use App\Models\ReimbursementMaster;
use App\Models\ReimbursementType;
use Helper;
use DB;
use Session;
class AMCController extends Controller
{   
    public function __construct(){ 
        $this->Employee = new AemEmployee();
        $this->familydetails  = new EmpFamilyDetails();
        $this->EmpDocuments = new EmpDocuments(); 
        $this->DocumentsType = new DocumentsType(); 
        $this->ChangeRequest = new EmpChangeRequest(); 
        $this->DependentMaster = new DependentMaster();
        $this->ReimbursementDetail  = new CeaReimbursementDeatil();
        $this->Reimbursement  = new ReimbursementMaster();
        $this->ReimbursementType  = new ReimbursementType();
    }
    public function AmscLiveUpdate(Request $request) {   
        return view('amc.amsc-live-update.amsc-live-update'); //Reimbursement of CEA Application
    }
    public function ViewAmscLiveUpdate(Request $request) {   
        return view('amc.amsc-live-update.view-amc-live-update'); //Reimbursement of CEA Application
    }
}
