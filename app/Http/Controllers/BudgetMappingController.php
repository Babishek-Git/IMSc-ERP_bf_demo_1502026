<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Gia;
use App\Models\ObjectHead;
use App\Models\ObjectHeadSubCategory;
use App\Models\ObjectHeadGiaMapping;
use App\Models\ObjectHeadLedgerGroupMapping;
use App\Models\Ledger;
use App\Models\LedgerGroup;
use App\Models\ProjectMaster;
use Exception;
use Helper;
use DB;
use Session;
use App\Services\TransactionMappingService;

class BudgetMappingController extends Controller
{
    public function __construct(){
        $this->Gia = new Gia();
        $this->ObjectHead = new ObjectHead();
        $this->ObjectHeadSubCategory = new ObjectHeadSubCategory();
        $this->ObjectHeadGiaMapping = new ObjectHeadGiaMapping();
        $this->ProjectMaster = new ProjectMaster();
        $this->Ledger       = new Ledger();
        $this->LedgerGroup       = new LedgerGroup();
        $this->ObjectHeadLedgerGroupMapping = new ObjectHeadLedgerGroupMapping();
    }

    public function GiaObjectHeadMapping(Request $request){
        if(isset($request->btn_save_mapping)){
            $SaveGiaList        = $request->txt_float_gia;
            $SaveObjectHeadList = $request->txt_float_object_head;
            $SaveProjectList    = $request->txt_float_project;
            $SaveIsSubCataList  = $request->txt_float_is_sub_cata;
            if(($SaveGiaList != NULL)&&($SaveGiaList != "")){
                $SaveGiaList = json_decode($SaveGiaList);
            }else{
                $SaveGiaList = [];
            }
            if(($SaveObjectHeadList != NULL)&&($SaveObjectHeadList != "")){
                $SaveObjectHeadList = json_decode($SaveObjectHeadList);
            }else{
                $SaveObjectHeadList = [];
            }
            if(($SaveProjectList != NULL)&&($SaveProjectList != "")){
                $SaveProjectList = json_decode($SaveProjectList);
            }else{
                $SaveProjectList = [];
            }
            if(($SaveIsSubCataList != NULL)&&($SaveIsSubCataList != "")){
                $SaveIsSubCataList = json_decode($SaveIsSubCataList);
            }else{
                $SaveIsSubCataList = [];
            }
            DB::beginTransaction();
            try {
                $CurrFinYear = Helper::GetCurrentFinYear(NULL);
                ObjectHeadGiaMapping::where('fin_year',$CurrFinYear)->delete();
                foreach($SaveGiaList as $SaveGiaKey => $SaveGia){
                    $ObjectHead  = $SaveObjectHeadList[$SaveGiaKey];
                    $ProjectId   = $SaveProjectList[$SaveGiaKey];
                    $IsSubCata   = $SaveIsSubCataList[$SaveGiaKey];
                    if($ProjectId == ''){
                        $ProjectId = NULL;
                    }
                    $SaveArr['gia_id']                  = $SaveGia;
                    $SaveArr['object_head_id']          = $ObjectHead;
                    $SaveArr['fin_year']                = $CurrFinYear;
                    $SaveArr['project_id']              = $ProjectId;
                    $SaveArr['is_sup_cata_applicable']  = $IsSubCata ?? false;
                    $SaveArr['active']                  = 1;
                    $SaveArr['created_at']              = NOW();
                    $SaveArr['created_by']              = session('WcmsEmpNo');
                    $this->ObjectHeadGiaMapping->CreateObjectHeadGiaMapping($SaveArr);
                }
                DB::commit();
                $message = "GIA - Object Head mapping saved successfully"; 
            
            } catch (Exception $e) { //dd($e);
                $message = "Error : GIA - Object Head mapping not saved. Please try again"; 
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('budget-mapping.gia-object-head-mapping');
        }
        $GiaData = $this->Gia->ShowGia();
        //$GiaData = $GiaData->where('gia_code','REG');
        $ObjectHeadData = $this->ObjectHead->ShowObjectHead(NULL);
        $ObjectHeadGiaMapData = $this->ObjectHeadGiaMapping->ShowObjectHeadGiaMapping(NULL);
        $ObjectHeadGiaMapgrpData = collect($ObjectHeadGiaMapData)->groupBy('gia_id');
        $ObjectHeadSubCataData = $this->ObjectHeadSubCategory->ShowObjectHeadSubCata(NULL);
        $ObjectHeadSubCataGrpData = collect($ObjectHeadSubCataData)->groupBy('object_head_id');
        $ParentProjectData = $this->ProjectMaster->GetAllParentProjectData('INT');
        return view('budget-mapping.gia-object-head-mapping', compact('GiaData','ObjectHeadData','ObjectHeadSubCataGrpData','ObjectHeadGiaMapgrpData','ParentProjectData'));
    }

    public function LedgerObjectHeadMapping(Request $request){
        if(isset($request->btn_save_mapping)){
            $SaveLedgerList                 = $request->txt_float_ledger;
            $SaveLedgerGroupList            = $request->txt_float_ledger_group;
            $SaveGiaList                    = $request->txt_float_gia;
            $SaveObjectHeadList             = $request->txt_float_object_head;
            $SaveProjectList                = $request->txt_float_project;
            $SaveObjectHeadSubCataList      = $request->txt_float_object_head_sub_cata;
            $SaveObjectHeadGiaMappDataList  = $request->txt_float_object_head_gia_map_id;
            if(($SaveLedgerList != NULL)&&($SaveLedgerList != "")){
                $SaveLedgerList = json_decode($SaveLedgerList);
            }else{
                $SaveLedgerList = [];
            }
            if(($SaveLedgerGroupList != NULL)&&($SaveLedgerGroupList != "")){
                $SaveLedgerGroupList = json_decode($SaveLedgerGroupList);
            }else{
                $SaveLedgerGroupList = [];
            }
            if(($SaveGiaList != NULL)&&($SaveGiaList != "")){
                $SaveGiaList = json_decode($SaveGiaList);
            }else{
                $SaveGiaList = [];
            }
            if(($SaveObjectHeadList != NULL)&&($SaveObjectHeadList != "")){
                $SaveObjectHeadList = json_decode($SaveObjectHeadList);
            }else{
                $SaveObjectHeadList = [];
            }
            if(($SaveProjectList != NULL)&&($SaveProjectList != "")){
                $SaveProjectList = json_decode($SaveProjectList);
            }else{
                $SaveProjectList = [];
            }
            if(($SaveObjectHeadSubCataList != NULL)&&($SaveObjectHeadSubCataList != "")){
                $SaveObjectHeadSubCataList = json_decode($SaveObjectHeadSubCataList);
            }else{
                $SaveObjectHeadSubCataList = [];
            }
            if(($SaveObjectHeadGiaMappDataList != NULL)&&($SaveObjectHeadGiaMappDataList != "")){
                $SaveObjectHeadGiaMappDataList = json_decode($SaveObjectHeadGiaMappDataList);
            }else{
                $SaveObjectHeadGiaMappDataList = [];
            }
            DB::beginTransaction();
            try {
                $CurrFinYear = Helper::GetCurrentFinYear(NULL);
                ObjectHeadLedgerGroupMapping::truncate();
                foreach($SaveGiaList as $SaveGiaKey => $SaveGia){
                    $Ledger                 = $SaveLedgerList[$SaveGiaKey];
                    $LedgerGroupId          = $SaveLedgerGroupList[$SaveGiaKey];
                    $ObjectHead             = $SaveObjectHeadList[$SaveGiaKey];
                    $ProjectId              = $SaveProjectList[$SaveGiaKey];
                    $ObjectHeadSubCata      = $SaveObjectHeadSubCataList[$SaveGiaKey];
                    $ObjectHeadGiaMappId    = $SaveObjectHeadGiaMappDataList[$SaveGiaKey];
                    if($ProjectId == ''){
                        $ProjectId = NULL;
                    }
                    if($ObjectHeadSubCata == ''){
                        $ObjectHeadSubCata = NULL;
                    }
                    $SaveArr['ledger_id']               = $Ledger;
                    $SaveArr['ledger_group_id']         = $LedgerGroupId;
                    $SaveArr['gia_id']                  = $SaveGia;
                    $SaveArr['object_head_id']          = $ObjectHead;
                    $SaveArr['object_head_sub_cata_id'] = $ObjectHeadSubCata;
                    $SaveArr['project_id']              = $ProjectId;
                    $SaveArr['oh_gia_mapp_id']          = $ObjectHeadGiaMappId;
                    $SaveArr['active']                  = 1;
                    $SaveArr['created_at']              = NOW();
                    $SaveArr['created_by']              = session('WcmsEmpNo');
                    $this->ObjectHeadLedgerGroupMapping->CreateOBHledgerGroupMapping(NULL,$SaveArr,NULL);
                }
                DB::commit();
                $message = "Ledger - Object Head mapping saved successfully"; 
            
            } catch (Exception $e) {  dd($e);
                $message = "Error : Ledger - Object Head mapping not saved. Please try again"; 
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('budget-mapping.object-head-ledger-mapping');
        }
        $GiaData = $this->Gia->ShowGia();
        //$GiaData = $GiaData->where('gia_code','CRA');
        $ObjectHeadData = $this->ObjectHead->ShowObjectHead(NULL);
        $ObjectHeadGiaMapData = $this->ObjectHeadGiaMapping->ShowObjectHeadGiaMapping(NULL);
        $ObjectHeadGiaMapgrpData = collect($ObjectHeadGiaMapData)->groupBy('gia_id'); 
        $ObjectHeadSubCataData = $this->ObjectHeadSubCategory->ShowObjectHeadSubCata(NULL);
        $ObjectHeadSubCataGrpData = collect($ObjectHeadSubCataData)->groupBy('object_head_id');
        $ParentProjectData = $this->ProjectMaster->GetAllParentProjectData('INT');
        $Ledger     = $this->Ledger->ShowLedger(); 
        $LedgerGroup  = $this->LedgerGroup->AllLeafNodesOnly();
        if(filled($Ledger)){
            $LedgerData = $Ledger->groupBy('ledger_group_id');
        }else{
            $LedgerData = [];
        } 
        $OBHLegerMappData = $this->ObjectHeadLedgerGroupMapping->ShowOBHLegerData();
        return view('budget-mapping.object-head-ledger-mapping',  compact('GiaData','ObjectHeadData','ObjectHeadSubCataGrpData','ObjectHeadGiaMapgrpData','ParentProjectData','Ledger','LedgerGroup','LedgerData','OBHLegerMappData'));
    }

    public function LedgerObjectHeadMappingView(Request $request){
        $GiaData = $this->Gia->ShowGia();
        //$GiaData = $GiaData->where('gia_code','CRA');
        $ObjectHeadData = $this->ObjectHead->ShowObjectHead(NULL);
        $ObjectHeadGiaMapData = $this->ObjectHeadGiaMapping->ShowObjectHeadGiaMapping(NULL);
        $ObjectHeadGiaMapgrpData = collect($ObjectHeadGiaMapData)->groupBy('gia_id'); 
        $ObjectHeadSubCataData = $this->ObjectHeadSubCategory->ShowObjectHeadSubCata(NULL);
        $ObjectHeadSubCataGrpData = collect($ObjectHeadSubCataData)->groupBy('object_head_id');
        $ParentProjectData = $this->ProjectMaster->GetAllParentProjectData('INT');
        $Ledger     = $this->Ledger->ShowLedger(); 
        $LedgerGroup  = $this->LedgerGroup->AllLeafNodesOnly();
        if(filled($Ledger)){
            $LedgerData = $Ledger->groupBy('ledger_group_id');
        }else{
            $LedgerData = [];
        } 
        $OBHLegerMappData = $this->ObjectHeadLedgerGroupMapping->ShowOBHLegerData();
        return view('budget-mapping.object-head-ledger-mapping-view',  compact('GiaData','ObjectHeadData','ObjectHeadSubCataGrpData','ObjectHeadGiaMapgrpData','ParentProjectData','Ledger','LedgerGroup','LedgerData','OBHLegerMappData'));
    }
    
}