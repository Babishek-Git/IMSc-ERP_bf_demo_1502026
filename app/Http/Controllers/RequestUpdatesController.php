<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Helper;
use App\Models\EmpChangeRequest;
use App\Models\AemEmployee;
use App\Models\ReimbursementMaster;

class RequestUpdatesController extends Controller
{
    public function __construct(){ 
        $this->ChangeRequest = new EmpChangeRequest();
        $this->Employee      = new AemEmployee();
        $this->Reimbursement = new ReimbursementMaster();
    }
    public function AddressUpdate(Request $request)
    { dd(123);
        $Page = 'REQ_PROCESS'; 
        $EmpNo       = session('WcmsEmpNo'); 
        $AddressData = $this->ChangeRequest->ShowEmpPendingChangeRequest(NULL,$EmpNo,'ADDRESS');
        return view('request-updates.addr-update')->with('data', compact('AddressData','Page'));
    }
    public function ContactUpdate(Request $request)
    {
        $Page = 'REQ';
        $EmpNo       = session('WcmsEmpNo');
        $ContactData = $this->ChangeRequest->ShowEmpyChangeRequest(NULL,$EmpNo,'MOBILE');
        return view('request-updates.contact-no-update')->with('data', compact('ContactData','Page'));
    }
    public function BankDetailsUpdate(Request $request)
    {
        $Page = 'REQ';
        $EmpNo       = session('WcmsEmpNo');
        $BankData = $this->ChangeRequest->ShowEmpyChangeRequest(NULL,$EmpNo,'BANK');
        $EmpGroupedData = NULL;
        return view('request-updates.bank-details-update')->with('data', compact('BankData','Page'));
    }
    public function FamilyMembersUpdate(Request $request)
    {
        $Page = 'REQ';
        $EmpNo       = session('WcmsEmpNo');
        $FamilyData = $this->ChangeRequest->ShowEmpyChangeRequest(NULL,$EmpNo,'FAMILY');
        return view('request-updates.family-members-update')->with('data', compact('FamilyData','Page'));
    }
    public function MaritalStatusUpdate(Request $request)
    {
        $Page = 'REQ';
        $EmpNo       = session('WcmsEmpNo');
        $MaritalData = $this->ChangeRequest->ShowEmpyChangeRequest(NULL,$EmpNo,'MARRIAGE_CERT');
        return view('request-updates.martial-status-update')->with('data', compact('MaritalData','Page'));
    }
    public function NomineeUpdate(Request $request)
    {
        $Page = 'REQ';
        $EmpNo       = session('WcmsEmpNo');
        $NomineeData = $this->ChangeRequest->ShowEmpyChangeRequest(NULL,$EmpNo,'NOMINEE');
        return view('request-updates.nominee-update')->with('data', compact('NomineeData','Page'));
    }
    public function PhysicalDisabilityUpdate(Request $request)
    {
        $Page = 'REQ';
        $EmpNo       = session('WcmsEmpNo');
        $PhysicalData = $this->ChangeRequest->ShowEmpyChangeRequest(NULL,$EmpNo,'DISABILITY');
        return view('request-updates.physical-disability-update')->with('data', compact('PhysicalData','Page'));
    }
     public function IdCardUpdate(Request $request)
    {
        $Page = 'REQ';
        $EmpNo       = session('WcmsEmpNo');
        $IdData = $this->ChangeRequest->ShowEmpyChangeRequest(NULL,$EmpNo,'IDCARD');
        return view('request-updates.id-card-update')->with('data', compact('IdData','Page'));
    }
    public function MedicalCardUpdate(Request $request)
    {
        $Page = 'REQ';
        $EmpNo       = session('WcmsEmpNo');
        $MedicalData = $this->ChangeRequest->ShowEmpyChangeRequest(NULL,$EmpNo,'MEDICALCARD');
        return view('request-updates.medical-card-update')->with('data', compact('MedicalData','Page'));
    }
    public function HRAClaimRequest(Request $request)
    {
        /* $Page = 'REQ';
        $EmpNo       = session('WcmsEmpNo');
        $ceaData = $this->Reimbursement->ShowReimbursementMasterCEA(NULL,$EmpNo,'CEA'); */
        return view('request-updates.hra-claim-request');
    }
    public function AdvClaimLTCRequest(Request $request)
    {
       /*  $Page = 'REQ'; */
       /*  $EmpNo       = session('WcmsEmpNo'); */
       /*  $MedicalData = $this->ChangeRequest->ShowEmpyChangeRequest(NULL,$EmpNo,'MEDICALCARD'); */
        return view('request-updates.adv-claim-ltc-request');
    }
    public function DataCardMobPhonChrgClaimRequest(Request $request)
    {
       /*  $Page = 'REQ'; */
       /*  $EmpNo       = session('WcmsEmpNo'); */
       /*  $MedicalData = $this->ChangeRequest->ShowEmpyChangeRequest(NULL,$EmpNo,'MEDICALCARD'); */
        return view('request-updates.datcrd-mobphn-chrg-clm-request');
    }
    public function CPFGPFAdvanceRequest(Request $request)
    {
       /*  $Page = 'REQ'; */
       /*  $EmpNo       = session('WcmsEmpNo'); */
       /*  $MedicalData = $this->ChangeRequest->ShowEmpyChangeRequest(NULL,$EmpNo,'MEDICALCARD'); */
        return view('request-updates.cpf-gpf-advan-request');
    }
    public function WitDrawFrCPFGPFRequest(Request $request)
    {
       /*  $Page = 'REQ'; */
       /*  $EmpNo       = session('WcmsEmpNo'); */
       /*  $MedicalData = $this->ChangeRequest->ShowEmpyChangeRequest(NULL,$EmpNo,'MEDICALCARD'); */
        return view('request-updates.witdraw-fr-cpf-gpf-request');
    }
    public function PFAddiSubscriRequest(Request $request)
    {
       /*  $Page = 'REQ'; */
       /*  $EmpNo       = session('WcmsEmpNo'); */
       /*  $MedicalData = $this->ChangeRequest->ShowEmpyChangeRequest(NULL,$EmpNo,'MEDICALCARD'); */
        return view('request-updates.pf-addi-subcr-request');
    }
    public function CeaReimbursementUpdate(Request $request)
    {
       /*  $Page = 'REQ'; */
       /*  $EmpNo       = session('WcmsEmpNo'); */
       /*  $MedicalData = $this->ChangeRequest->ShowEmpyChangeRequest(NULL,$EmpNo,'MEDICALCARD'); */
        return view('request-updates.cea-application-update');
    }
    public function HomeTownRequest(Request $request)
    {
        $Page = 'REQ';
        $EmpNo        = session('WcmsEmpNo');
        $HomeTownData = $this->ChangeRequest->ShowEmpyChangeRequest(NULL,$EmpNo,'HOMETOWN');
        return view('request-updates.home-town-update')->with('data', compact('HomeTownData','Page'));
    }
}
