<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectMaster;
use App\Models\ObjectHead;
use App\Models\BudgetAllocation;
use App\Models\ObjectHeadSubCategory;
use App\Models\BudgetAllocationClaimed;
use App\Models\ObjectHeadGiaMapping;
use App\Models\BudgetAllocationReceived;
use App\Models\PaymentObjectHead;
use App\Models\Payment;


use App\Models\Gia;


use Helper;
use DB;
use Session;



class BudgetSanactionController extends Controller
{
    public function __construct(){
        $this->project                 = new ProjectMaster();
        $this->ObjectHead              = new ObjectHead();
        $this->BudgetAllocation        = new BudgetAllocation();
        $this->ObjectHeadSubCategory   = new ObjectHeadSubCategory();
        $this->BudgetAllocationClaimed = new BudgetAllocationClaimed();
        $this->ObjectHeadGiaMapping    = new ObjectHeadGiaMapping();
        $this->GiaMaster               = new Gia();
        $this->BudgetReceived          = new BudgetAllocationReceived();
        $this->PaymentObjectHead       = new PaymentObjectHead();
        $this->Payment                 = new Payment();
    }
    public function BudgetSanction(Request $request){
        if($request->btn_next_float){
            $BudgetType = $request->txt_budget_type;
        }else{
            $BudgetType = NULL;
        }
        if($request->btn_save){//dd($request);
            $GrantAidId           = $request->input('cmb_gia'); 
            $SanactionNo          = $request->input('sanction_no'); 
            $FinalYear            = $request->input('curr_final_year'); 
            $ClaimMode            = $request->input('cmb_claim_mode'); 
            $ProjectId            = $request->input('cmb_proj_name'); 
            $ObjectHeadModeArr    = $request->input('obj_head_data_mode'); 
            $ObjectHeadIdArr      = $request->input('obj_head_id'); 
            $ObjectSubCatIdArr    = $request->input('obj_head_sub_id'); 
            $ProposedAmoutArr     = $request->input('proposed_amount'); 
            $SanactionAmoutArr    = $request->input('sanction_amount'); 
            if($ProjectId != NULL){
                $ProjectGrParData = $this->project->GetRootParent($ProjectId);
                $ProjectGrParId = $ProjectGrParData->project_id ?? null;
            }else{
                $ProjectGrParId = NULL;
            }
            DB::beginTransaction();//dd($request);
            try { 
                if(filled($GrantAidId) && filled($FinalYear)){
                    $DeativeData = $this->BudgetAllocation->DeativeData($GrantAidId,$FinalYear);
                }
                if(filled($ProposedAmoutArr) && filled($SanactionAmoutArr)){
                    foreach($ProposedAmoutArr as $ObjKey => $Value){
                        $ObjHeadId           =  $ObjectHeadIdArr[$ObjKey];
                        $ProposedAmt         =  $ProposedAmoutArr[$ObjKey];
                        $SanactionAmout      =  $SanactionAmoutArr[$ObjKey];
                        $ObjHeadMode         =  $ObjectHeadModeArr[$ObjKey];
                        $ObjSubCatId         =  $ObjectSubCatIdArr[$ObjKey] ?? null;
                        $SaveDtData['object_head_id']    = $ObjHeadId;
                        $SaveDtData['gia_id']            = $GrantAidId;
                        $SaveDtData['budget_sanction_no']= $SanactionNo;
                        $SaveDtData['project_id']        = $ProjectId;
                        $SaveDtData['project_parent_id'] = $ProjectGrParId;
                        // $SaveDtData['claim_mode']        = $ClaimMode;
                        $SaveDtData['proposed_amount']   = $ProposedAmt;
                        $SaveDtData['proposed_date']     = NOW();
                        $SaveDtData['sanctioned_amount'] = $SanactionAmout;
                        $SaveDtData['sanctioned_date']   = NOW();
                        $SaveDtData['fin_year']          = $FinalYear;
                        $SaveDtData['active']            = 1;
                        $SaveDtData['created_at']        = NOW();
                        $SaveDtData['created_by']        = session('WcmsEmpNo'); 
                        if($ObjHeadMode == 'OHSC'){
                            $SaveDtData['oh_sub_cata_id']    = $ObjSubCatId;
                        }
                        if($SanactionAmout != NULL && $ProposedAmt != NULL){//dd($SaveDtData);
                            $SaveSanction = $this->BudgetAllocation->CreateBudgetAllocation($SaveDtData);
                        }
                    }
                }
                DB::commit();
                $message = "Budget Allocation Saved Successfully";
                Session::put('ALertMesage', $message);
            }
            catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
                Session::put('ALertMesage', $message);
            }
        }
        $ProjectHeadGroupData = $this->project->AllLeafNodesOnly();//$this->project->ShowAllParentChild(NULL); 
        $GrandDetails         = $this->GiaMaster->ShowGia();
        if(isset($BudgetType)){
            $GrandDetails = $GrandDetails->where('gia_code',$BudgetType);
        }else{
            $GrandDetails = $GrandDetails->where('gia_code','!=','CRA');
        }
        return view('budget-allocation.budget-sancation-entry')->with('data',compact('ProjectHeadGroupData','GrandDetails','BudgetType'));
    }
    public function BudgetSanctionEntryDetails(Request $request){
        $GetGiaId      = $request->GiaId;
        $GetGiaCode    = $request->Giacode;
        $FinancialYear = $request->FinancialYear;
        $ClaimMode_Type     = $request->ClaimTypeId;
        if($GetGiaCode =='CRA'){
            $ProjectId                   = $request->ProjectId;
            $ProjectParentId             = $request->ProjectParentId;
            $ParentIdParentIds           = $this->project->getGrandParentData($ProjectParentId);
            $ObjHeadProjectMappDataData  = $this->ObjectHeadGiaMapping->ShowObjectHeadDataByGiaIdAndProjId($GetGiaId,$ParentIdParentIds);
            $AllObectHead                = $this->ObjectHead->ShowObjectHead(NULL);
            $AllObectHeadSubCata         = $this->ObjectHeadSubCategory->ShowObjectHeadSubCata(NULL);
            $AllObectHeadSubCataGrpData  = filled($AllObectHeadSubCata) ? collect($AllObectHeadSubCata)->groupBy('object_head_id') : [];
            $BudgetAllocationData        = $this->BudgetAllocation->ShowBudgetAllocationData($GetGiaId,$FinancialYear);//dd($ObjHeadProjectMappDataData);
            $AllObjAllocatedIds          = collect($BudgetAllocationData)->pluck('budget_allocation_id')->toArray();
           $GetClaimDataByAllocatedIds  = $this->BudgetAllocationClaimed->GetClaimDataByAllocatedIds($AllObjAllocatedIds,$ClaimMode_Type);
            $RetunArr = array('ClaimData'=>$GetClaimDataByAllocatedIds,'AllObjHeadData'=>$AllObectHead,'AllObjSubCatData'=>$AllObectHeadSubCata,'AllObjHeadSubCatGroupByData'=>$AllObectHeadSubCataGrpData,'AllObectHeadGaiMappingData' => $ObjHeadProjectMappDataData,'BudgetAllocationData'=>$BudgetAllocationData);
            return $RetunArr;
        }else{
            $AllObectHead                = $this->ObjectHead->ShowObjectHead(NULL);
            $AllObectHeadSubCata         = $this->ObjectHeadSubCategory->ShowObjectHeadSubCata(NULL);
            $AllObectHeadSubCataGrpData  = filled($AllObectHeadSubCata) ? collect($AllObectHeadSubCata)->groupBy('object_head_id') : [];
            $ObjHeadSubCatoryData        = $this->ObjectHeadGiaMapping->ShowObjectHeadSubCategoryDataByGiaId($GetGiaId);
            $ObjHeadMappDataData         = $this->ObjectHeadGiaMapping->ShowObjectHeadDataByGiaId($GetGiaId);
            // $ObjHeadMappDataData         = $this->ObjectHeadGiaMapping->ShowObjectHeadDataByGiaId($GetGiaId);
            $BudgetAllocationData        = $this->BudgetAllocation->ShowBudgetAllocationData($GetGiaId,$FinancialYear);
            $AllObjAllocatedIds          = collect($BudgetAllocationData)->pluck('budget_allocation_id')->toArray();
            $GetClaimDataByAllocatedIds  = $this->BudgetAllocationClaimed->GetClaimDataByAllocatedIds($AllObjAllocatedIds,$ClaimMode_Type);
        }
        $RetunArr = array('ClaimData'=>$GetClaimDataByAllocatedIds,'AllObjHeadData'=>$AllObectHead,'AllObjSubCatData'=>$AllObectHeadSubCata,'AllObjHeadSubCatGroupByData'=>$AllObectHeadSubCataGrpData,'ObjectSubCategoryData' => $ObjHeadSubCatoryData,'AllObectHeadGaiMappingData'=>$ObjHeadMappDataData,'BudgetAllocationData'=>$BudgetAllocationData);
        return $RetunArr; 
    }
    public function BudgetSanctionClaimDetails(Request $request){
        $GetGiaId           = $request->GiaId;
        $GetGiaCode         = $request->Giacode;
        $FinancialYear      = $request->FinancialYear;
        $ClaimMode_Type     = $request->ClaimTypeId;
        if($GetGiaCode =='CRA'){
            $ProjectId                   = $request->ProjectId;
            $ProjectParentId             = $request->ProjectParentId;
            $ParentIdParentIds           = $this->project->getGrandParentData($ProjectParentId);
            $ObjHeadProjectMappDataData  = $this->ObjectHeadGiaMapping->ShowObjectHeadDataByGiaIdAndProjId($GetGiaId,$ParentIdParentIds);
            $AllObectHead                = $this->ObjectHead->ShowObjectHead(NULL);
            $AllObectHeadSubCata         = $this->ObjectHeadSubCategory->ShowObjectHeadSubCata(NULL);
            $AllObectHeadSubCataGrpData  = filled($AllObectHeadSubCata) ? collect($AllObectHeadSubCata)->groupBy('object_head_id') : [];
            $BudgetAllocationData        = $this->BudgetAllocation->ShowBudgetAllocationData($GetGiaId,$FinancialYear);//dd($ObjHeadProjectMappDataData);
            $AllObjAllocatedIds          = collect($BudgetAllocationData)->pluck('budget_allocation_id')->toArray();
            $GetClaimDataByAllocatedIds  = $this->BudgetAllocationClaimed->GetClaimDataByAllocatedIds($AllObjAllocatedIds,$ClaimMode_Type);
            $AllClaimIds                 = collect($GetClaimDataByAllocatedIds)->pluck('budget_claimed_id')->toArray();
            $GetRecivedData              = $this->BudgetReceived->ShowBudegetReceivedByClaim($AllClaimIds);
            $RetunArr = array('ClaimData'=>$GetClaimDataByAllocatedIds,'RecivedData'=>$GetRecivedData,'AllObjHeadData'=>$AllObectHead,'AllObjSubCatData'=>$AllObectHeadSubCata,'AllObjHeadSubCatGroupByData'=>$AllObectHeadSubCataGrpData,'AllObectHeadGaiMappingData' => $ObjHeadProjectMappDataData,'BudgetAllocationData'=>$BudgetAllocationData);
            return $RetunArr;
        }else{
            $GetPeriviousMonth           = str_pad($ClaimMode_Type - 1, 2, '0', STR_PAD_LEFT);
            $AllObectHead                = $this->ObjectHead->ShowObjectHead(NULL);
            $AllObectHeadSubCata         = $this->ObjectHeadSubCategory->ShowObjectHeadSubCata(NULL);
            $AllObectHeadSubCataGrpData  = filled($AllObectHeadSubCata) ? collect($AllObectHeadSubCata)->groupBy('object_head_id') : [];
            $ObjHeadSubCatoryData        = $this->ObjectHeadGiaMapping->ShowObjectHeadSubCategoryDataByGiaId($GetGiaId);
            $ObjHeadMappDataData         = $this->ObjectHeadGiaMapping->ShowObjectHeadDataByGiaId($GetGiaId);
            // $ObjHeadMappDataData         = $this->ObjectHeadGiaMapping->ShowObjectHeadDataByGiaId($GetGiaId);
            $BudgetAllocationData        = $this->BudgetAllocation->ShowBudgetAllocationData($GetGiaId,$FinancialYear);
            $AllObjAllocatedIds          = collect($BudgetAllocationData)->pluck('budget_allocation_id')->toArray();
            $GetClaimDataByAllocatedIds  = $this->BudgetAllocationClaimed->GetClaimDataByAllocatedIds($AllObjAllocatedIds,$ClaimMode_Type);
            $AllClaimIds                 = collect($GetClaimDataByAllocatedIds)->pluck('budget_claimed_id')->toArray();
            $IsPeriviousData             = $this->BudgetReceived->CheckPeriviousData($AllClaimIds,$GetPeriviousMonth);//dd($IsPeriviousData);
            $GetRecivedData              = $this->BudgetReceived->ShowBudegetReceivedByClaim($AllClaimIds);
        }
        $RetunArr = array('ClaimData'=>$GetClaimDataByAllocatedIds,'RecivedData'=>$GetRecivedData,'AllObjHeadData'=>$AllObectHead,'AllObjSubCatData'=>$AllObectHeadSubCata,'AllObjHeadSubCatGroupByData'=>$AllObectHeadSubCataGrpData,'ObjectSubCategoryData' => $ObjHeadSubCatoryData,'AllObectHeadGaiMappingData'=>$ObjHeadMappDataData,'BudgetAllocationData'=>$BudgetAllocationData);
        return $RetunArr; 
    }
    public function BudgetClaim(Request $request){
        if($request->btn_next_float){
            $BudgetType = $request->txt_budget_type;
        }else{
            $BudgetType = NULL;
        }
         if($request->btn_save){
            $ClaimDate               = $request->claim_date;
            $ClaimPeriod             = $request->cmb_month ?? $request->cmb_quarter;
            $BudgetAllocationIdArray = $request->input('bud_allocted_id'); 
            $ClaimAmountArray        = $request->input('claim_amount'); 
            DB::beginTransaction();
            try { 
                if(filled($BudgetAllocationIdArray)){
                    $DeleteClaimData  = $this->BudgetAllocationClaimed->DeleteClaimData($BudgetAllocationIdArray);
                }
                if(filled($ClaimAmountArray)){
                     foreach($ClaimAmountArray as $ObjKey => $Value){
                        $BudgetAllocatId     =  $BudgetAllocationIdArray[$ObjKey]  ?? null;
                        $ClaimAmt            =  $ClaimAmountArray[$ObjKey];
                        $SaveDtData['budget_allocation_id'] = $BudgetAllocatId;
                        $SaveDtData['claimed_amount']       = $ClaimAmt;
                        $SaveDtData['claimed_date']         = $ClaimDate;
                        $SaveDtData['claim_period']         = $ClaimPeriod;
                        $SaveDtData['active']               = 1;
                        $SaveDtData['created_at']           = now();
                        $SaveDtData['created_by']           = session('WcmsEmpNo');//dd($SaveDtData);
                        if(filled($ClaimAmt) && $ClaimAmt != NULL){
                           $SaveClaimData= $this->BudgetAllocationClaimed->CreateBudgetClaim($SaveDtData);
                        }    
                    }
                }
                DB::commit();
                $message = "Budget Claimed Details Saved Successfully";
                Session::put('ALertMesage', $message);
            }
            catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
                Session::put('ALertMesage', $message);
            }
        }
        $AllObectHead                    = $this->ObjectHead->ShowObjectHead(NULL);
        $AllObectHeadSubCata             = $this->ObjectHeadSubCategory->ShowObjectHeadSubCata(NULL);
        $AllObectHeadSubCataGrpData      = filled($AllObectHeadSubCata) ? collect($AllObectHeadSubCata)->groupBy('object_head_id') : [];
        $BudgetAllocationData            = $this->BudgetAllocation->ShowBudegetAllocationAll();
        $ProjectHeadGroupData            = $this->project->ShowAllParentChild();
        $ProjectHeadMapArray             = collect($ProjectHeadGroupData)->pluck('full_heads', 'project_id')->toArray();
        $ProjectHeadGroupData            = $this->project->AllLeafNodesOnly();
        $GrandDetails                    = $this->GiaMaster->ShowGia();
        if(isset($BudgetType)){
            $GrandDetails = $GrandDetails->where('gia_code',$BudgetType);
        }else{
            $GrandDetails = $GrandDetails->where('gia_code','!=','CRA');
        }
        return view('budget-allocation.budget-claim-entry')->with('data',compact('BudgetType','ProjectHeadGroupData','GrandDetails','BudgetAllocationData','ProjectHeadMapArray','AllObectHeadSubCataGrpData'));
    }
    public function BudgetRecived(Request $request){
        if($request->btn_next_float){
            $BudgetType = $request->txt_budget_type;
        }else{
            $BudgetType = NULL;
        }
        if($request->btn_save){
            $RecivedDate              = $request->rece_date;
            $BudgetClaimIdArray       = $request->input('bud_claim_id'); 
            $RecivedAmountArray       = $request->input('recived_amount'); 
            DB::beginTransaction();
            try { 
                if(filled($BudgetClaimIdArray)){
                    $DeleteRecivedData = $this->BudgetReceived->DeleteRecivedData($BudgetClaimIdArray);
                }
                if(filled($RecivedAmountArray)){
                     foreach($RecivedAmountArray as $ObjKey => $Value){
                        $BudgetClaimId     =  $BudgetClaimIdArray[$ObjKey]  ?? null;
                        $RecivedAmt        =  $RecivedAmountArray[$ObjKey];
                        $SaveDtData['budget_claimed_id'] = $BudgetClaimId;
                        $SaveDtData['received_amount']   = $RecivedAmt;
                        $SaveDtData['received_date']     = $RecivedDate;
                        $SaveDtData['active']            = 1;
                        $SaveDtData['created_at']        = now();
                        $SaveDtData['created_by']        = session('WcmsEmpNo');
                        if(filled($RecivedAmt) && $RecivedAmt != NULL){
                          $SaveRecivedData = $this->BudgetReceived->CreateBudgetAllocationRecived($SaveDtData);
                        }  
                    }
                }
                DB::commit();
                $message = "Budget Received Details Saved Successfully";
                Session::put('ALertMesage', $message);
            }
            catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
                Session::put('ALertMesage', $message);
            }
        }
        $AllObectHead                    = $this->ObjectHead->ShowObjectHead(NULL);
        $AllObectHeadSubCata             = $this->ObjectHeadSubCategory->ShowObjectHeadSubCata(NULL);
        $AllObectHeadSubCataGrpData      = filled($AllObectHeadSubCata) ? collect($AllObectHeadSubCata)->groupBy('object_head_id') : [];
        $BudgetAllocationData            = $this->BudgetAllocation->ShowBudegetAllocationAll();
        $ProjectHeadGroupData            = $this->project->ShowAllParentChild();
        $ProjectHeadMapArray             = collect($ProjectHeadGroupData)->pluck('full_heads', 'project_id')->toArray();
        $ProjectHeadGroupData            = $this->project->AllLeafNodesOnly();
        $GrandDetails                    = $this->GiaMaster->ShowGia();
        if(isset($BudgetType)){
            $GrandDetails = $GrandDetails->where('gia_code',$BudgetType);
        }else{
            $GrandDetails = $GrandDetails->where('gia_code','!=','CRA');
        }
        return view('budget-allocation.budget-received-entry')->with('data',compact('BudgetType','ProjectHeadGroupData','GrandDetails','BudgetAllocationData','ProjectHeadMapArray','AllObectHeadSubCataGrpData'));
    }

    public function BudgetBalance(Request $request){
        if($request->btn_save){//dd($request);
            $GrantAidId          = $request->input('cmb_gia'); 
            $ProjectId           = $request->input('txt_project_id'); 
            $ProjectParentId     = $request->input('txt_project_parent_id'); 
            $ObjectHeadId        = $request->input('txt_object_head_id'); 
            $ObjectHeadSubCataId = $request->input('txt_object_head_subcata_id'); 
            $ExpAmount           = $request->input('txt_exp_amount'); 
            $ExpDate             = $request->input('txt_exp_date'); 
            $Remarks             = $request->input('txt_exp_remarks'); 
            if($ObjectHeadSubCataId == ''){
                $ObjectHeadSubCataId = NULL;
            }
            if($ProjectId == ''){
                $ProjectId = NULL;
            }

            if($ProjectId != NULL){
                $ProjectGrParData = $this->project->GetRootParent($ProjectId);
                $ProjectGrParId = $ProjectGrParData->project_id ?? null;
            }else{
                $ProjectGrParId = NULL;
            }
            if(($ExpDate != '')&&($ExpDate != NULL)){
                $ExpDate = Helper::DBDateFormat($ExpDate);
            }
            if($Remarks == ''){
                $Remarks = NULL;
            }

            
            DB::beginTransaction();//dd($request);
            try { 

                $SaveDtData1['gross_amount']    = $ExpAmount;
                $SaveDtData1['net_amount']      = $ExpAmount;
                $SaveDtData1['status']          = 'completed';
                $SaveDtData1['is_approved']     = true;
                $SaveDtData1['is_completed']    = true;
                $SaveDtData1['voucher_dt']      = $ExpDate;
                $SaveDtData1['voucher_amt']     = $ExpAmount;
                $SaveDtData1['payment_description'] = $Remarks;
                $SaveDtData1['active']          = 1;
                $SaveDtData1['created_at']      = NOW();
                $SaveDtData1['created_by']      = session('WcmsEmpNo');
                $PaymentData = $this->Payment->CreatePayment($SaveDtData1);
                $PaymentId   = $PaymentData->payment_id;

                $SaveDtData['payment_id']               = $PaymentId;
                $SaveDtData['payment_oh_amount']        = $ExpAmount;
                $SaveDtData['gia_id']                   = $GrantAidId;
                $SaveDtData['project_id']               = $ProjectId;
                $SaveDtData['parent_project_id']        = $ProjectGrParId;
                $SaveDtData['object_head_id']           = $ObjectHeadId;
                $SaveDtData['object_head_sub_cata_id']  = $ObjectHeadSubCataId;
                $SaveDtData['active']                   = 1;
                $SaveDtData['created_at']               = NOW();
                $SaveDtData['created_by']               = session('WcmsEmpNo'); 
                $SaveSanction = $this->PaymentObjectHead->CreatePaymentObjectHead($SaveDtData);
                DB::commit();
                $message = "Budget Balance Details Saved Successfully";
                Session::put('ALertMesage', $message);
            }
            catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
                Session::put('ALertMesage', $message);
            }
            //dd($message);
            Session::put('ALertMesage', $message);
            return redirect()->route('budget.balance-entry');
        }
        $ProjectHeadGroupData = $this->project->AllLeafNodesOnly();//$this->project->ShowAllParentChild(NULL); 
        $GrandDetails         = $this->GiaMaster->ShowGia();
        return view('budget-allocation.budget-balance-entry')->with('data',compact('ProjectHeadGroupData','GrandDetails'));
    }
    public function BudgetBalanceView(Request $request){

    }
}
