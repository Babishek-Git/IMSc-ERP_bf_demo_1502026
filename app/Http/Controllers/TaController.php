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
use App\Models\TaReimbursementDeatil;
use Helper;
use DB;
use Session;
class TaController extends Controller
{   
    public function __construct(){ 
        $this->Employee             = new AemEmployee();
        $this->familydetails        = new EmpFamilyDetails();
        $this->EmpDocuments         = new EmpDocuments(); 
        $this->DocumentsType        = new DocumentsType(); 
        $this->ChangeRequest        = new EmpChangeRequest(); 
        $this->DependentMaster      = new DependentMaster();
        $this->ReimbursementDetail  = new CeaReimbursementDeatil();
        $this->Reimbursement        = new ReimbursementMaster();
        $this->ReimbursementType    = new ReimbursementType();
        $this->TaReimbursement      = new TaReimbursementDeatil();
    }
   public function TADAExpClaimRequest(Request $request){   
    if(isset($request->btn_save)){ 
        //dd($request);
        $EmpNo              = $request->txt_emp_icno;
        $ActiveTab          = $request->txt_tab;
        $PurposeVisit       = $request->txt_purpose_visit;
        $VistingInstitude   = $request->txt_visiting_institudename;
        $Departtime         = $request->txt_depart_time;
        $Arrivaltime        = $request->txt_arrival_institude;
        $departInstitude    = $request->txt_depart_institude;
        $Travelmode         = $request->rad_mode_travel;
        if($Travelmode == 'Air'){
            $TravelFare     = $request->txt_air_fare;
        }else if($Travelmode == 'Train'){
            $TravelFare     = $request->txt_train_fare;
        }else if($Travelmode == 'Taxi'){
            $TravelFare     = $request->txt_taxi_fare;
        }else{
            $TravelFare     = NULL;
        }
       
        $ReimbursementdtId  = $request->hid_rem_id;
        $ActiveTab          = $request->txt_tab;
        DB::beginTransaction();
        try {
            $ReimbursementTypeData = $this->ReimbursementType->ShowReimbursementMasterByCode('TA'); 
            $ReimbursementTypeId = NULL;
            if(filled($ReimbursementTypeData)){
                $ReimbursementTypeId = collect($ReimbursementTypeData)->pluck('reimbursement_type_id')->first();
            }
            $SaveArr['emp_no']                  = $EmpNo;
            $SaveArr['reimbursement_type_id']   = $ReimbursementTypeId;
            $SaveArr['reimbursement_type_code'] ='TA';
            $SaveArr['claim_date']              = NOW();
            $SaveArr['total_claimed_amount']    = $TravelFare;
            $SaveArr['total_approved_amount']   = NULL;
            $SaveArr['status']                  ='submitted';
            $SaveArr['remarks']                 = NULL;
            $SaveArr['active']                  = 1;
            $SaveArr['created_at']              = NOW();
            $SaveArr['created_by']              = session('WcmsEmpNo'); 
            $SaveEmployee = $this->Reimbursement->createReimbursementMaster($SaveArr); 
            $ReimbursementId = $SaveEmployee->reimbursement_id;
           
            $SaveDtArr['reimbursement_id']        = $ReimbursementId;
            $SaveDtArr['visit_purpose']           = $PurposeVisit;
            $SaveDtArr['visit_institute_name']    = $VistingInstitude;
            $SaveDtArr['depart_date_from_imsc']   = $Departtime;
            $SaveDtArr['arrive_date_visit_place'] = $Arrivaltime;
            $SaveDtArr['depart_date_visit_place'] = $departInstitude;
            $SaveDtArr['travel_mode']             = $Travelmode;
            $SaveDtArr['travel_fare']             = $TravelFare;
            $SaveDtArr['reimbursement_status']    = 'submitted';
            $SaveDtArr['active']                  = 1;
            if($ReimbursementdtId != NULL){ 
                $SaveDtArr['updated_at'] = NOW();
                $SaveDtArr['updated_by'] = session('WcmsEmpNo');
                $SaveDtEmployee= $this->TaReimbursement->updateReimbursemetDetail($SaveDtArr,$ReimbursementdtId);
                //dd($SaveDtEmployee);
            }
            else{
            $SaveDtArr['created_at']              = NOW();
            $SaveDtArr['created_by']              = session('WcmsEmpNo'); 
            $SaveDtEmployee = $this->TaReimbursement->createTaReimbursementDetail($SaveDtArr); 
            }
            $message = NULL;
            if(($EmpNo != NULL)&&($ActiveTab != NULL)){
                $this->SaveTAClaimDetails($request);
            }
            else{
                $message = "Error : Invalid ICNO & Check your ICNO"; 
            } 
            DB::commit();
            $message = "TA Expenses Claim deatil Request Form Data Saved Successfully";
            Session::put('ALertMesage', $message);
            return redirect()->route('ta.tada-exp-claim-request');
        }catch (\Exception $e) { dd($e);
            DB::rollback();
            $message = "Error : Sorry transaction not fully completed";
            Session::put('ALertMesage', $message);
        }
         
    }
    $EditclaimData=NULL;
        if(isset($request->id)){ 
            try {
                $EditId = decrypt($request->id); 
                //dd($EditId);
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $data = "Error : Sorry Invalid Attempt";
                return redirect()->back();
            }
            $EditclaimData=$this->TaReimbursement->ShowTaReimbursementDetail($EditId); 
        }
    $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo();
    return view('ta.tada-exp-claim-request')->with('data',compact('Empdata','EditclaimData')); //TA/DA Expenses Claim Application
    }
     public function SaveTAClaimDetails($request){
        if($request->hasfile('file_ta_docu')){
            $TAClaim  = $request->file('file_ta_docu');
            $EmpIcno  = $request->txt_emp_icno;
            $UploadExe = 0;

            $validator1 = Validator::make(
                $request->all(),
                [
                    'file_ta_docu' => 'required|mimes:jpg,jpeg,png|max:2048', // max:2048 specifies the maximum size in kilobytes (2MB)
                ],
                [
                    'file_ta_docu.required' => 'Error: Please select the  TA Claim.',
                    'file_ta_docu.mimes'    => 'Error: Only jpg,jpeg,png files are allowed.',
                    'file_ta_docu.max'      => 'Error: The file size must be within 2MB.',
                ]
            );
            if($validator1->fails()) { 
                $message = $validator1->errors()->first(); 
                Session::put('ALertMesage', $message); 
            }

            $message = NULL;
            $OrgFileName = $TAClaim->getClientOriginalName();
            $Extension   = $TAClaim->getClientOriginalExtension();

            $UploadTimeStr = date("YmdHis");
            $FileType = $TAClaim->getClientOriginalExtension();
            $FileName = "emp_".$EmpIcno."_ta_supp_doc_".$UploadTimeStr.".".$FileType; //dd($FileName);
            $IsUpload = NULL;
            try {
                if($TAClaim) {
                    $IsUpload = Helper::UploadFile($TAClaim,$FileName,'TA','SUPDOC');
                }else{
                    $IsUpload = 'UE';
                }
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $IsUpload = 'UE';
            }
            if($IsUpload == "Y"){
                $UploadExe++;
            }
              //dd($IsUpload); 
            if($UploadExe > 0){
                DB::beginTransaction();
                try {
                    $DocumentTypeData = $this->DocumentsType->ShowDocumentTypeByCode('TA'); 
                    $DocumentTypeId = NULL;
                    if(filled($DocumentTypeData)){
                        $DocumentTypeId = collect($DocumentTypeData)->pluck('document_type_id')->first();
                    }
                    //dd($DocumentTypeId);
                    $this->EmpDocuments->DeleteDocuments($EmpIcno,$DocumentTypeId);
                    $SaveData['emp_document_type_id']   = $DocumentTypeId;
                    $SaveData['doc_file_name']          = $FileName;
                    $SaveData['doc_file_name_actual']   = $OrgFileName;
                    $SaveData['active']                 = 1;
                    $SaveData['emp_no']                 = $EmpIcno;
                    $SaveData['created_at']             = NOW();
                    $SaveData['created_by']             = session('WcmsEmpNo');
                    $SaveEmployee= $this->EmpDocuments->createDocuments($SaveData);
                    //dd( $SaveEmployee);
                    DB::commit();
                    $message = "Document Uploaded Successfully";
                }catch (\Exception $e){ dd($e); 
                    DB::rollback();
                    $message = "Error : Sorry transaction not fully completed";
                }
            }
        }
    }  
    public function ViewTADAExpClaimList(Request $request){ 
        $Claimdata = $this->Reimbursement->ShowEmployeesReimbursementMaster(NULL,session('WcmsEmpNo'));
        return view('ta.view-ta-exp-claim-list')->with('data',compact('Claimdata'));;
    }
    
}
