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
class CeaController extends Controller
{   
    public function __construct(){ 
        $this->Employee = new AemEmployee();
        $this->familydetails  = new EmpFamilyDetails();
        $this->EmpDocuments   = new EmpDocuments(); 
        $this->DocumentsType  = new DocumentsType(); 
        $this->ChangeRequest   = new EmpChangeRequest(); 
        $this->DependentMaster = new DependentMaster();
        $this->ReimbursementDetail  = new CeaReimbursementDeatil();
        $this->Reimbursement  = new ReimbursementMaster();
        $this->ReimbursementType  = new ReimbursementType();
    }
    public function CeaReimbursementRequest(Request $request)
    {   
        if(isset($request->btn_save)){ 
           //dd($request);
            $EmpNo                = $request->txt_emp_icno;
            $ChildIdArr           = $request->txt_child_id;
            $ReimbursementdtId    = $request->hid_reimbursement_dt_id;
            if(filled($ChildIdArr)){
                DB::beginTransaction();
                try {
                    $ReimbursementTypeData = $this->ReimbursementType->ShowReimbursementMasterByCode('CEA'); 
                    $ReimbursementTypeId = NULL;
                    if(filled($ReimbursementTypeData)){
                        $ReimbursementTypeId = collect($ReimbursementTypeData)->pluck('reimbursement_type_id')->first();
                    }
                    $SaveArr['emp_no']                  = $EmpNo;
                    $SaveArr['reimbursement_type_id']   = $ReimbursementTypeId;
                    $SaveArr['reimbursement_type_code'] ='CEA';
                    $SaveArr['claim_date']              = NOW();
                    $SaveArr['total_claimed_amount']    = NULL;
                    $SaveArr['total_approved_amount']   = NULL;
                    $SaveArr['status']                  ='submitted';
                    $SaveArr['remarks']                 = NULL;
                    $SaveArr['active']                  = 1;
                    $SaveArr['created_at']              = NOW();
                    $SaveArr['created_by']              = session('WcmsEmpNo'); //dd($SaveArr);
                    $SaveEmployee = $this->Reimbursement->createReimbursementMaster($SaveArr); //dd($SaveEmployee);
                    $MasterId = $SaveEmployee->reimbursement_id;

                    foreach($ChildIdArr as $ChildId){
                        $ChildName      = $request->input('txt_child_name_'.$ChildId);
                        $AcademicYear   = $request->input('txt_academic_year_'.$ChildId);
                        $RateCea        = $request->input('txt_rate_cea_'.$ChildId);
                        $Amount         = $request->input('txt_amt_'.$ChildId);
                        $Remarks        = $request->input('txt_remarks_'.$ChildId);
                        $Distance       = $request->input('txt_distance_'.$ChildId);
                        $IsDisable      = $request->input('ch_is_disable_'.$ChildId);
                        $DisableNature  = $request->input('txt_disable_nature_'.$ChildId);
                        $CerificateDate = $request->input('txt_certi_date_'.$ChildId);
                        $Percentage     = $request->input('txt_perc_'.$ChildId);
                        $Bonofide       = $request->input('ch_bonofide_'.$ChildId);
                        $BonofideHostel = $request->input('ch_bonofide_hostel_'.$ChildId);
                        $BonofideAmt    = $request->input('txt_bonofide_hostel_amt_'.$ChildId);

                        $SaveDtArr['reimbursement_id']          = $MasterId;
                        $SaveDtArr['family_det_id']             = $ChildId;
                        $SaveDtArr['children_name']             = $ChildName;
                        $SaveDtArr['academic_year']             = $AcademicYear;
                        $SaveDtArr['cea_rate']                  = $RateCea;
                        $SaveDtArr['cea_rate_mode']             = NULL;
                        $SaveDtArr['cea_amount']                = $Amount;
                        $SaveDtArr['hostel_distance']           = $Distance;
                        $SaveDtArr['is_diabled_child']          = $IsDisable;
                        $SaveDtArr['is_bonafide_cert']          = $Bonofide;
                        $SaveDtArr['is_bonafide_cert_hostel']   = $BonofideHostel;
                        $SaveDtArr['remarks']                   = $Remarks;
                        $SaveDtArr['active']                    = 1;
                        $SaveDtArr['created_at']                = NOW();
                        $SaveDtArr['created_by']                = session('WcmsEmpNo');
                        if($ReimbursementdtId != NULL){ 
                            $SaveArr['updated_at'] = NOW();
                            $SaveArr['updated_by'] = session('WcmsEmpNo');
                            $SaveEmployee= $this->ReimbursementDetail->UpdateCeaReimbursementDetail($SaveArr,$ReimbursementTypeId);
                        }
                        else{
                            $SaveArr['created_at']              = NOW();
                            $SaveArr['created_by']              = session('WcmsEmpNo'); 
                            $SaveEmployee = $this->ReimbursementDetail->createCeaReimbursementDetail($SaveArr); 
                        }
                        $SaveEmployee= $this->ReimbursementDetail->createCeaReimbursementDetail($SaveDtArr);
                    }
                    DB::commit();
                    $message = "Reimbursement deatil Request Form Data Saved Successfully";
                    Session::put('ALertMesage', $message);
                }catch (\Exception $e) { dd($e);
                    DB::rollback();
                    $message = "Error : Sorry transaction not fully completed";
                    Session::put('ALertMesage', $message);
                }
            }
        }
        $EditCliamData=NULL;  $Page = NULL;
        if(isset($request->id)){ 
            try {
                $EditId = decrypt($request->id);
                $Page   = decrypt($request->Page); 

            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {dd($e);
                $data = "Error : Sorry Invalid Attempt";
                return redirect()->back();
            }
            $EditCliamData=$this->ReimbursementDetail->ShowCeaReimbursementDetail(NULL,$EditId);
           
        }  
/*         if(filled($EditCliamData)){ 
            //$EmpNo = $EditCliamData->emp_no; 
            $Empdata = $this->Employee->ShowEmployeesFamilyDetails(NULL,$EmpNo);
        }else{
            $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo(); 
        }  */
        $Empdata = $this->Employee->ShowEmployeeBySessionEmpNo(); 
        $ChildrenData = $this->familydetails->ShowChildrens();
        return view('cea.cea-reimbursement-application')->with('data',compact('Empdata','ChildrenData','Page','EditCliamData')); //Reimbursement of CEA Application
    }
    public function ViewCeaReimbursementRequest(Request $request)
    { 
     return view('cea.view-cea-reimbursement-application');
    }
    
}
