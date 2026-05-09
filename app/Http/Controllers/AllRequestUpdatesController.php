<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Helper;
use App\Models\EmpChangeRequest;
use App\Models\AemEmployee;

class AllRequestUpdatesController extends Controller
{
    public function __construct(){ 
        $this->ChangeRequest = new EmpChangeRequest();
        $this->Employee = new AemEmployee();
    }
    public function AddressUpdate(Request $request)
    {
        $Page = 'ALLREQ';
        $AddressData = $this->ChangeRequest->ShowEmpChangeRequests(NULL,'ADDRESS');
        return view('all-request-update.addr-update')->with('data', compact('AddressData','Page'));
    }
    public function ContactUpdate(Request $request)
    {
        $Page = 'ALLREQ';
        $ContactData = $this->ChangeRequest->ShowEmpChangeRequests(NULL,'MOBILE');
        return view('all-request-update.contact-no-update')->with('data', compact('ContactData','Page'));
    }
    public function BankDetailsUpdate(Request $request)
    {
        $Page = 'ALLREQ';
        $BankData = $this->ChangeRequest->ShowEmpChangeRequests(NULL,'BANK');
        return view('all-request-update.bank-details-update')->with('data', compact('BankData','Page'));
    }
    public function FamilyMembersUpdate(Request $request)
    {
        $Page = 'ALLREQ';
        $FamilyData = $this->ChangeRequest->ShowEmpChangeRequests(NULL,'FAMILY');
        return view('all-request-update.family-members-update')->with('data', compact('FamilyData','Page'));
    }
    public function MaritalStatusUpdate(Request $request)
    {
        $Page = 'ALLREQ';
        $MaritalData = $this->ChangeRequest->ShowEmpChangeRequests(NULL,'MARRIAGE_CERT');
        return view('all-request-update.martial-status-update')->with('data', compact('MaritalData','Page'));
    }
    public function NomineeUpdate(Request $request)
    {
        $Page = 'ALLREQ';
        $NomineeData = $this->ChangeRequest->ShowEmpChangeRequests(NULL,'NOMINEE');
        return view('all-request-update.nominee-update')->with('data', compact('NomineeData'));
    }
    public function PhysicalDisabilityUpdate(Request $request)
    {
        $Page = 'ALLREQ';
        $PhysicalData = $this->ChangeRequest->ShowEmpChangeRequests(NULL,'DISABILITY');
        return view('all-request-update.physical-disability-update')->with('data', compact('PhysicalData','Page'));
    }
    public function IdCardUpdate(Request $request)
    {
        $Page = 'ALLREQ';
        $IdData = $this->ChangeRequest->ShowEmpChangeRequests(NULL,'IDCARD');
        return view('all-request-update.id-card-update')->with('data', compact('IdData','Page'));
    }
    public function MedicalCardUpdate(Request $request)
    {
        $Page = 'ALLREQ';
        $MedicalData = $this->ChangeRequest->ShowEmpChangeRequests(NULL,'MEDICALCARD');
        return view('all-request-update.id-card-update')->with('data', compact('MedicalData','Page'));
    }
     public function CeaReimbursementUpdate(Request $request)
    {
        $Page = 'ALLREQ';
        $MedicalData = $this->ChangeRequest->ShowEmpChangeRequests(NULL,'MEDICALCARD');
        return view('all-request-update.cea-application-update')->with('data', compact('MedicalData','Page'));
    }
    public function HRAClaimRequest(Request $request)
    {
        /* $Page = 'REQ';
        $EmpNo       = session('WcmsEmpNo');
        $ceaData = $this->Reimbursement->ShowReimbursementMasterCEA(NULL,$EmpNo,'CEA'); */
        return view('all-request-update.hra-claim-request');
    }
    public function AdvClaimLTCRequest(Request $request)
    {
       /*  $Page = 'REQ'; */
       /*  $EmpNo       = session('WcmsEmpNo'); */
       /*  $MedicalData = $this->ChangeRequest->ShowEmpyChangeRequest(NULL,$EmpNo,'MEDICALCARD'); */
        return view('all-request-update.adv-claim-ltc-request');
    }
    public function DataCardMobPhonChrgClaimRequest(Request $request)
    {
       /*  $Page = 'REQ'; */
       /*  $EmpNo       = session('WcmsEmpNo'); */
       /*  $MedicalData = $this->ChangeRequest->ShowEmpyChangeRequest(NULL,$EmpNo,'MEDICALCARD'); */
        return view('all-request-update.datcrd-mobphn-chrg-clm-request');
    }
    public function CPFGPFAdvanceRequest(Request $request)
    {
       /*  $Page = 'REQ'; */
       /*  $EmpNo       = session('WcmsEmpNo'); */
       /*  $MedicalData = $this->ChangeRequest->ShowEmpyChangeRequest(NULL,$EmpNo,'MEDICALCARD'); */
        return view('all-request-update.cpf-gpf-advan-request');
    }
    public function WitDrawFrCPFGPFRequest(Request $request)
    {
       /*  $Page = 'REQ'; */
       /*  $EmpNo       = session('WcmsEmpNo'); */
       /*  $MedicalData = $this->ChangeRequest->ShowEmpyChangeRequest(NULL,$EmpNo,'MEDICALCARD'); */
        return view('all-request-update.witdraw-fr-cpf-gpf-request');
    }
    public function PFAddiSubscriRequest(Request $request)
    {
       /*  $Page = 'REQ'; */
       /*  $EmpNo       = session('WcmsEmpNo'); */
       /*  $MedicalData = $this->ChangeRequest->ShowEmpyChangeRequest(NULL,$EmpNo,'MEDICALCARD'); */
        return view('all-request-update.pf-addi-subcr-request');
    }
    public function TADAExpClaimList(Request $request){ 
        $Claimdata = $this->Employee->ShowEmployeesByReimbursementDetail();
        //dd($Claimdata);
        return view('all-request-update.ta-exp-claim-list')->with('data',compact('Claimdata'));
    }
    public function MedicalCardRequest(Request $request)
    {
       /*  $Page = 'REQ'; */
       /*  $EmpNo       = session('WcmsEmpNo'); */
       /*  $MedicalData = $this->ChangeRequest->ShowEmpyChangeRequest(NULL,$EmpNo,'MEDICALCARD'); */
        return view('all-request-update.medical-card-update');
    }
    public function HomeTownRequest(Request $request)
    {
        $Page = 'ALLREQ';
        $HomeTownData = $this->ChangeRequest->ShowEmpChangeRequests(NULL,'HOMETOWN');
        return view('all-request-update.home-town-update')->with('data',compact('HomeTownData'));
    }
    
}
