<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Models\Ledger;
use App\Models\LedgerGroup;
use App\Models\GiaBudgetHeadGroupMapping;
use App\Models\BudgetHeadLedgerGroupMapping;
use App\Models\ObjectHeadSubCategory;
use App\Models\ObjectHeadGiaMapping;
use App\Models\ProjectMaster;
use App\Models\ObjectHead;
use App\Models\Gia;
use App\Models\ObjectHeadGroup;
use App\Models\BudgetAllocation;
use App\Models\BudgetAllocationClaimed;
use App\Models\BudgetAllocationReceived;
use App\Models\BudgetSanctionExpenditureMaster;
use App\Models\PaymentObjectHead;

use Carbon\Carbon;
use Illuminate\Support\Str;
//use Exception;
use DB;
use Helper;

class TransactionMappingService
{
    
    public function __construct() {
    }


    public function GetTransactionMappingData($TransactionId,$TransactionType,$TransactionGroup){
        $RetData = [];
        /*if($TransactionGroup == 'L'){
            $LedgerData = $this->GetLedgerGroupId($TransactionId);
            $LedgerGroupId = $LedgerData->ledger_group_id; //--------(1)
        }else{
            $LedgerGroupId = $TransactionId; //--------(1)
        }
        $LedgerData = $this->GetLedgerGroup($LedgerGroupId); 
        $LedgerGroupId = $LedgerData->ledger_group_id; //--------(1)
        $LedgerGroupName = $LedgerData->ledger_group_name; //--------(1-A)
        $RetData['LedgerGroupId'] = $LedgerGroupId;
        $RetData['LedgerGroupName'] = $LedgerGroupName;*/
        $LedgerData = $this->GetLedgerGroupId($TransactionId); 
        $LedgerName = $LedgerData->ledger_acc_name;
        $RetData['LedgerId']            = $TransactionId;
        $RetData['LedgerName']            = $LedgerName;

        $LedgerObjHeadMapData   = $this->GetLegderObjectHeadMapByLedgerId($TransactionId); 
        if($LedgerObjHeadMapData->isEmpty()) {
            // collection has no records
            return NULL;
        }
        $ObjectHeadLedgerMapId  = $LedgerObjHeadMapData->pluck('ohl_mapping_id')->first();
        $LedgerGroupId          = $LedgerObjHeadMapData->pluck('ledger_group_id')->first();
        $ObjectHeadId           = $LedgerObjHeadMapData->pluck('object_head_id')->first();
        $ObjectHeadSubCataId    = $LedgerObjHeadMapData->pluck('object_head_sub_cata_id')->first();
<<<<<<< Updated upstream
        $ProjectId              = $LedgerObjHeadMapData->pluck('project_id')->first();
=======
        $ProjectId              = $LedgerObjHeadMapData->pluck('project_id')->first(); // Actually this is Project parent Id
        $ProjectParentId        = $ProjectId;
>>>>>>> Stashed changes
        $GiaId                  = $LedgerObjHeadMapData->pluck('gia_id')->first();
        $ObjectHeadGiaMappId    = $LedgerObjHeadMapData->pluck('oh_gia_mapp_id')->first();
        $RetData['ObjectHeadLedgerMapId'] = $ObjectHeadLedgerMapId;

        $LedgerGrpData              = $this->GetLedgerGroup($LedgerGroupId); 
        $LedgerGroupId              = $LedgerGrpData->ledger_group_id; 
        $LedgerGroupName            = $LedgerGrpData->ledger_group_name;
        
        $RetData['LedgerGroupId']   = $LedgerGroupId;
        $RetData['LedgerGroupName'] = $LedgerGroupName;

        
        $RetData['ObjectHeadId']        = $ObjectHeadId;
        $RetData['ObjectHeadSubCataId'] = $ObjectHeadSubCataId;
        $RetData['ProjectId']           = $ProjectId;
        $RetData['GiaId']               = $GiaId;

        $ObjectHeadData         = $this->GetObjectHead($ObjectHeadId);
        $ObjectHeadSubCataData  = $this->GetObjectHeadSubCategory($ObjectHeadSubCataId);
        $GiaData                = $this->GetGrantInAid($GiaId);
        $GiaName                = $GiaData?->gia_name;
        $ObjectHeadName         = $ObjectHeadData?->object_head_name;
        $ObjectHeadSubCataName  = $ObjectHeadSubCataData?->oh_sub_cata_name;

        $RetData['GiaName']                 = $GiaName;
        $RetData['ObjectHeadName']          = $ObjectHeadName;
        $RetData['ObjectHeadSubCataName']   = $ObjectHeadSubCataName;

        $CurrentFinYear = Helper::GetCurrentFinYear(NULL);
<<<<<<< Updated upstream
        $BudgetAllocationData = $this->ShowBudegetAllocationFinYear($CurrentFinYear,$ObjectHeadSubCataId,$ObjectHeadId,$ProjectId,$GiaId); 
        $BudgetSanctionedAmt = $BudgetAllocationData->pluck('sanctioned_amount')->first();
        $BudgetAllocationId = $BudgetAllocationData->pluck('budget_allocation_id')->first();
        $BudgetClaimAmount = $this->GetBudgetClaimAmountByAllocation($BudgetAllocationId);
        $BudgetClaimData = $this->ShowBudegetClaimByAllocation($BudgetAllocationId);
        $BudgetClaimIdList = $BudgetClaimData->pluck('budget_claimed_id')->toArray();
        $BudgetReceivedAmount = $this->GetBudegetReceivedAmountByMultipleClaim($BudgetClaimIdList);
=======
        $BudgetAllocationData = $this->ShowBudegetAllocationFinYear($CurrentFinYear,$ObjectHeadSubCataId,$ObjectHeadId,$ProjectId,$ProjectParentId,$GiaId); 
        $BudgetSanctionedAmt = $BudgetAllocationData->pluck('sanctioned_amount')->first();
        if(isset($BudgetSanctionedAmt)){
            $BudgetSanctionedAmt = $BudgetSanctionedAmt * 100000;
        }
        $BudgetAllocationId = $BudgetAllocationData->pluck('budget_allocation_id')->first();
        $BudgetClaimAmount = $this->GetBudgetClaimAmountByAllocation($BudgetAllocationId);
        if(isset($BudgetClaimAmount)){
            $BudgetClaimAmount = $BudgetClaimAmount * 100000;
        }
        $BudgetClaimData = $this->ShowBudegetClaimByAllocation($BudgetAllocationId);
        $BudgetClaimIdList = $BudgetClaimData->pluck('budget_claimed_id')->toArray();
        $BudgetReceivedAmount = $this->GetBudegetReceivedAmountByMultipleClaim($BudgetClaimIdList);
        if(isset($BudgetReceivedAmount)){
            $BudgetReceivedAmount = $BudgetReceivedAmount * 100000;
        }
>>>>>>> Stashed changes
        $RetData['BudgetSanctionedAmt'] = $BudgetSanctionedAmt;
        $RetData['BudgetClaimAmount'] = $BudgetClaimAmount;
        $RetData['BudgetReceivedAmount'] = $BudgetReceivedAmount;
        $UptoDateExpenditureAmt = $this->ShowBudegetActualExpenditure(NULL,$ObjectHeadSubCataId,$ObjectHeadId,$ProjectId,$GiaId);
        $RetData['UptoDtExpenditureAmt'] = $UptoDateExpenditureAmt;
<<<<<<< Updated upstream
=======
        
>>>>>>> Stashed changes

        


        /*if(filled($LedgerGroupId)){ 
            $BudgetHeadData = $this->GetBudgetGroupId($LedgerGroupId); 
            if(filled($BudgetHeadData)){
                $BudgetHeadGroupId = $BudgetHeadData->pluck('object_head_group_id')->first(); //--------(2)
                $BudgetHeadGroupData = $this->GetBudgetGroup($BudgetHeadGroupId);
                $BudgetHeadGroupName = $BudgetHeadGroupData->object_head_name; //--------(2-A)
                $RetData['BudgetHeadGroupId'] = $BudgetHeadGroupId;
                $RetData['BudgetHeadGroupName'] = $BudgetHeadGroupName;
                if(filled($BudgetHeadGroupId)){
                    $BidgetGiaData = $this->GetGrantInAidId($BudgetHeadGroupId);
                    if(filled($BidgetGiaData)){
                        $GiaId = $BidgetGiaData->pluck('gia_id')->first(); //--------(3)
                        $GiaData = $this->GetGrantInAid($GiaId); 
                        $GiaName = $GiaData->gia_name; //--------(3-A)
                        $RetData['GiaId'] = $GiaId;
                        $RetData['GiaName'] = $GiaName;
                    }
                }
            }
        }*/
        return $RetData;
    }
    
    public function GetObjectHeadCode($ObjectHeadSubCataId,$ObjectHeadId){
        if($ObjectHeadSubCataId != NULL){
            $OHSubCataData = $this->GetObjectHeadSubCategory($ObjectHeadSubCataId);
            $ObjectHeadCode = $OHSubCataData->oh_sub_cata_code;
        }else{
            $OHCataData = $this->GetObjectHead($ObjectHeadId);
            $ObjectHeadCode = $OHCataData->object_head_code;
        }
        return $ObjectHeadCode;
    }

    public function GetLedgerGroupId($TransactionId){ 
        return Ledger::find($TransactionId);
    }
    public function GetBudgetGroupId($LedgerGroupId){
        return BudgetHeadLedgerGroupMapping::where('ledger_group_id', $LedgerGroupId)->get();
    }
    public function GetBudgetGroup($BudgetHeadGroupId){
        return ObjectHeadGroup::find($BudgetHeadGroupId);
    }
    public function GetGrantInAidId($BudgetHeadGroupId){
        return GiaBudgetHeadGroupMapping::whereRaw("? = ANY(string_to_array(object_head_grouop_id, ','))", [$BudgetHeadGroupId])->get();
    }


    public function GetLegderObjectHeadMapByLedgerId($LedgerId){
        return BudgetHeadLedgerGroupMapping::where('ledger_id', $LedgerId)->get();
    }
    public function GetGrantInAid($GiaId){
        return Gia::find($GiaId);
    }
    public function GetObjectHeadSubCategory($OHSubCataId){
        return ObjectHeadSubCategory::find($OHSubCataId);
    }
    public function GetObjectHeadGiaMapping($OHGiaMappId){
        return ObjectHeadGiaMapping::find($OHGiaMappId);
    }
    public function GetProject($ProjectId){
        return ProjectMaster::find($ProjectId);
    }
    public function GetObjectHead($ObjectHeadId){
        return ObjectHead::find($ObjectHeadId);
    }
    public function GetLedgerGroup($LedgerGroupId){
        return LedgerGroup::find($LedgerGroupId);
    }
    public function GetLedger($LedgerId){
        return Ledger::find($LedgerId);
    }


    public function ShowBudegetActualExpenditure($PaymentId,$ObjectHeadSubCataId,$ObjectHeadId,$ProjectId,$GiaId){
        return PaymentObjectHead::where('active',1)
        ->when($PaymentId, fn($q) => $q->where('payment_id', '!=', $PaymentId))
        ->when($GiaId, fn($q) => $q->where('gia_id', $GiaId))
        ->when($ObjectHeadSubCataId, fn($q) => $q->where('object_head_sub_cata_id', $ObjectHeadSubCataId))
        ->when($ObjectHeadId, fn($q) => $q->where('object_head_id', $ObjectHeadId))
        ->when($ProjectId, fn($q) => $q->where('project_id', $ProjectId))
        ->sum('payment_oh_amount');  
    }
<<<<<<< Updated upstream
    public function ShowLedgerForObjectHead($ObjectHeadSubCataId,$ObjectHeadId,$ProjectId,$GiaId){
=======
    public function ShowLedgerForObjectHead($ObjectHeadSubCataId,$ObjectHeadId,$ProjectId,$ProjectParentId,$GiaId){
>>>>>>> Stashed changes
        return BudgetHeadLedgerGroupMapping::where('active',1)
        ->when($GiaId, fn($q) => $q->where('gia_id', $GiaId))
        ->when($ObjectHeadSubCataId, fn($q) => $q->where('object_head_sub_cata_id', $ObjectHeadSubCataId))
        ->when($ObjectHeadId, fn($q) => $q->where('object_head_id', $ObjectHeadId))
<<<<<<< Updated upstream
        ->when($ProjectId, fn($q) => $q->where('project_id', $ProjectId))
=======
        ->when($ProjectParentId, fn($q) => $q->where('project_id', $ProjectParentId))
>>>>>>> Stashed changes
        ->get();  
    }
    public function ShowBudegetClaimByAllocation($BudgetAllocationId){
        return BudgetAllocationClaimed::where('active', 1)->where('budget_allocation_id',$BudgetAllocationId)->get();     
    }
    public function GetBudgetClaimAmountByAllocation($BudgetAllocationId){
        return BudgetAllocationClaimed::where('active', 1)->where('budget_allocation_id',$BudgetAllocationId)->sum('claimed_amount');     
    }

    public function ShowBudegetReceivedByMultipleClaim($BudgetClaimId){
        return BudgetAllocationReceived::where('active', 1)->whereIn('budget_claimed_id',$BudgetClaimId)->get();     
    }
    public function GetBudegetReceivedAmountByMultipleClaim($BudgetClaimId){
        return BudgetAllocationReceived::where('active', 1)->whereIn('budget_claimed_id',$BudgetClaimId)->sum('received_amount');     
    }
<<<<<<< Updated upstream
    public function ShowBudegetAllocationFinYear($FinYear,$ObjectHeadSubCataId,$ObjectHeadId,$ProjectId,$GiaId){
=======
    public function ShowBudegetAllocationFinYear($FinYear,$ObjectHeadSubCataId,$ObjectHeadId,$ProjectId,$ProjectParentId,$GiaId){
>>>>>>> Stashed changes
        return BudgetAllocation::where('fin_year', $FinYear)->where('active',1)
        ->when($GiaId, fn($q) => $q->where('gia_id', $GiaId))
        ->when($ObjectHeadSubCataId, fn($q) => $q->where('oh_sub_cata_id', $ObjectHeadSubCataId))
        ->when($ObjectHeadId, fn($q) => $q->where('object_head_id', $ObjectHeadId))
<<<<<<< Updated upstream
        ->when($ProjectId, fn($q) => $q->where('project_parent_id', $ProjectId))
=======
        ->when($ProjectParentId, fn($q) => $q->where('project_parent_id', $ProjectParentId))
>>>>>>> Stashed changes
        ->get();  
    }

    public function GetBudgetDetailsForAmcPo($TransactionId,$ModuleCode,$PaymentId){
        $BudgetData = BudgetSanctionExpenditureMaster::where('active', 1)->where('transaction_id',$TransactionId)->where('module_code',$ModuleCode)->where('current_stage','PO')->get(); 
        //$ObjectHeadLedgerMapId  = $BudgetData->pluck('ohl_mapping_id')->first();
        //$LedgerGroupId          = $BudgetData->pluck('ledger_group_id')->first();
<<<<<<< Updated upstream
        $ObjectHeadId           = $BudgetData->pluck('object_head_id')->first();
=======
        $ObjectHeadId           = $BudgetData->pluck('object_head_id')->first(); 
>>>>>>> Stashed changes
        $ObjectHeadSubCataId    = $BudgetData->pluck('oh_sub_cata_id')->first();
        $ProjectId              = $BudgetData->pluck('project_id')->first();
        $GiaId                  = $BudgetData->pluck('gia_id')->first();
        $BudgetAllocationId     = $BudgetData->pluck('budget_allocation_id')->first();
<<<<<<< Updated upstream
        $CurrentSanctionAmt     = $BudgetData->pluck('current_sanction_amt')->first();
=======
        $CurrentSanctionAmt     = $BudgetData->pluck('current_utilized_amt')->first();
        $ProjectParentId        = $BudgetData->pluck('project_parent_id')->first();
>>>>>>> Stashed changes
        $RetData['CurrentSanctionAmt']        = $CurrentSanctionAmt;
        $RetData['BudgetAllocationId']        = $BudgetAllocationId;
        //$ObjectHeadGiaMappId    = $BudgetData->pluck('oh_gia_mapp_id')->first();
        //$RetData['ObjectHeadLedgerMapId'] = $ObjectHeadLedgerMapId;

        //$LedgerGrpData              = $this->GetLedgerGroup($LedgerGroupId); 
        //$LedgerGroupId              = $LedgerGrpData->ledger_group_id; 
        //$LedgerGroupName            = $LedgerGrpData->ledger_group_name;
        
        //$RetData['LedgerGroupId']   = $LedgerGroupId;
        //$RetData['LedgerGroupName'] = $LedgerGroupName;

        
        $RetData['ObjectHeadId']        = $ObjectHeadId;
        $RetData['ObjectHeadSubCataId'] = $ObjectHeadSubCataId;
        $RetData['ProjectId']           = $ProjectId;
        $RetData['GiaId']               = $GiaId;

        $ObjectHeadData         = $this->GetObjectHead($ObjectHeadId);
        $ObjectHeadSubCataData  = $this->GetObjectHeadSubCategory($ObjectHeadSubCataId);
        $GiaData                = $this->GetGrantInAid($GiaId);
        $GiaName                = $GiaData?->gia_name;
        $ObjectHeadName         = $ObjectHeadData?->object_head_name;
        $ObjectHeadSubCataName  = $ObjectHeadSubCataData?->oh_sub_cata_name;

        $RetData['GiaName']                 = $GiaName;
        $RetData['ObjectHeadName']          = $ObjectHeadName;
        $RetData['ObjectHeadSubCataName']   = $ObjectHeadSubCataName;

        $CurrentFinYear = Helper::GetCurrentFinYear(NULL);
<<<<<<< Updated upstream
        $BudgetAllocationData = $this->ShowBudegetAllocationFinYear($CurrentFinYear,$ObjectHeadSubCataId,$ObjectHeadId,$ProjectId,$GiaId); 
        $BudgetSanctionedAmt = $BudgetAllocationData->pluck('sanctioned_amount')->first();
        $BudgetAllocationId = $BudgetAllocationData->pluck('budget_allocation_id')->first();
        $BudgetClaimAmount = $this->GetBudgetClaimAmountByAllocation($BudgetAllocationId);
        $BudgetClaimData = $this->ShowBudegetClaimByAllocation($BudgetAllocationId);
        $BudgetClaimIdList = $BudgetClaimData->pluck('budget_claimed_id')->toArray();
        $BudgetReceivedAmount = $this->GetBudegetReceivedAmountByMultipleClaim($BudgetClaimIdList);
=======
        $BudgetAllocationData = $this->ShowBudegetAllocationFinYear($CurrentFinYear,$ObjectHeadSubCataId,$ObjectHeadId,$ProjectId,$ProjectParentId,$GiaId);  
        $BudgetSanctionedAmt = $BudgetAllocationData->pluck('sanctioned_amount')->first();
        if(isset($BudgetSanctionedAmt)){
            $BudgetSanctionedAmt = $BudgetSanctionedAmt * 100000;
        }
        $BudgetAllocationId = $BudgetAllocationData->pluck('budget_allocation_id')->first();
        $BudgetClaimAmount = $this->GetBudgetClaimAmountByAllocation($BudgetAllocationId);
        if(isset($BudgetClaimAmount)){
            $BudgetClaimAmount = $BudgetClaimAmount * 100000;
        }
        $BudgetClaimData = $this->ShowBudegetClaimByAllocation($BudgetAllocationId);
        $BudgetClaimIdList = $BudgetClaimData->pluck('budget_claimed_id')->toArray();
        $BudgetReceivedAmount = $this->GetBudegetReceivedAmountByMultipleClaim($BudgetClaimIdList);
        if(isset($BudgetReceivedAmount)){
            $BudgetReceivedAmount = $BudgetReceivedAmount * 100000;
        }
>>>>>>> Stashed changes
        $RetData['BudgetSanctionedAmt'] = $BudgetSanctionedAmt;
        $RetData['BudgetClaimAmount'] = $BudgetClaimAmount;
        $RetData['BudgetReceivedAmount'] = $BudgetReceivedAmount;
        $UptoDateExpenditureAmt = $this->ShowBudegetActualExpenditure($PaymentId,$ObjectHeadSubCataId,$ObjectHeadId,$ProjectId,$GiaId);
        $RetData['UptoDtExpenditureAmt'] = $UptoDateExpenditureAmt;

<<<<<<< Updated upstream
        $LedgerData = $this->ShowLedgerForObjectHead($ObjectHeadSubCataId,$ObjectHeadId,$ProjectId,$GiaId);
=======
        $LedgerData = $this->ShowLedgerForObjectHead($ObjectHeadSubCataId,$ObjectHeadId,$ProjectId,$ProjectParentId,$GiaId); 
>>>>>>> Stashed changes
        if(filled($LedgerData)){
            $LedgerIdList = $LedgerData->pluck('ledger_id')->toArray();
        }else{
            $LedgerIdList = [];
        }
        $RetData['LedgerIdList'] = $LedgerIdList; 
        return $RetData;
    }
    

}