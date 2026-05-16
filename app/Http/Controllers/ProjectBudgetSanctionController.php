<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gia;
use App\Models\ObjectHead;
use App\Models\ObjectHeadSubCategory;
use App\Models\ObjectHeadGiaMapping;
use App\Models\ObjectHeadLedgerGroupMapping;
use App\Models\Ledger;
use App\Models\LedgerGroup;
use App\Models\ProjectMaster;
use App\Models\ApexBudgetSanction;
use App\Models\ApexBudgetSanctionObjectHeadWise;
use App\Models\ApexBudgetSanctionSubProjectWise;
use App\Models\ApexBudgetSanctionObjectHeadFinYearWise;


use Helper;
use DB;
use Session;



class ProjectBudgetSanctionController extends Controller
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
        $this->ApexBudgetSanction = new ApexBudgetSanction();
        $this->ApexBudgetSanctionObjectHeadWise = new ApexBudgetSanctionObjectHeadWise();
        $this->ApexBudgetSanctionSubProjectWise = new ApexBudgetSanctionSubProjectWise();
        $this->ApexBudgetSanctionObjectHeadFinYearWise = new ApexBudgetSanctionObjectHeadFinYearWise();
    }
    public function ProjectBudgetSanctionInitiate(Request $request){
        return view('budget-allocation.project-budget-sanction-initiate');
    }
    public function ProjectBudgetSanction(Request $request){
        if(isset($request->btnSave)){ //dd($request);
            $SanctionNoList         = $request->input('txt_sanction_no');
            $SanctionDateList       = $request->input('txt_sanction_date');
            $SanctionAmountList     = $request->input('txt_sanction_amount');
            $ApexProjectList        = $request->input('txt_apex_project_id');
            DB::beginTransaction();
            try {
                if(filled($ApexProjectList)){
                    foreach($ApexProjectList as $ApexProjectKey => $ApexProjectId){
                        $SanctionNo     = $SanctionNoList[$ApexProjectKey]; 
                        $SanctionDate   = $SanctionDateList[$ApexProjectKey];
                        $SanctionAmount = $SanctionAmountList[$ApexProjectKey]; 
                        if(($SanctionDate != '')&&($SanctionDate != NULL)){
                            $SanctionDate = Helper::DBDateFormat($SanctionDate);
                        }
                        $this->ApexBudgetSanction->DeleteApexSanctionByProjectId($ApexProjectId);
                        $this->ApexBudgetSanctionObjectHeadWise->DeleteApexSanctionByProjectId($ApexProjectId);

                        $OHSanctionAmountList         = $request->input('txt_oh_sanction_amount_'.$ApexProjectId); 
                        $ProjectGrParentList        = $request->input('txt_project_grant_parent_id_'.$ApexProjectId);
                        $GiaIdList                  = $request->input('txt_gia_id_'.$ApexProjectId);
                        $ObjectHeadIdList           = $request->input('txt_object_head_id_'.$ApexProjectId);
                        $ObjectHeadSubCataIdList    = $request->input('txt_object_head_subcata_id_'.$ApexProjectId);
                        $SaveArr1['apex_project_id']        = $ApexProjectId;
                        $SaveArr1['budget_sanction_no']     = $SanctionNo;
                        $SaveArr1['budget_sanction_date']   = $SanctionDate;
                        $SaveArr1['budget_sanction_amt']    = $SanctionAmount;
                        $SaveArr1['active']                 = 1;
                        $SaveArr1['created_at']             = NOW();
                        $SaveArr1['created_by']             = session('WcmsEmpNo');  //print_r($SaveArr1); echo "<br>";
                        $SaveApexSanctionData = $this->ApexBudgetSanction->CreateApexBudgetSanction($SaveArr1);
                        $BudgetSanctionId = $SaveApexSanctionData->budget_sanction_id;

                        if(filled($ObjectHeadIdList)){
                            foreach($ObjectHeadIdList as $ObjectHeadIdKey => $ObjectHeadId){
                                $SanctionAmount      = $OHSanctionAmountList[$ObjectHeadIdKey];
                                $ProjectGrParentId   = $ProjectGrParentList[$ObjectHeadIdKey];
                                $GiaId               = $GiaIdList[$ObjectHeadIdKey];
                                $ObjectHeadId        = $ObjectHeadIdList[$ObjectHeadIdKey];
                                $ObjectHeadSubCataId = $ObjectHeadSubCataIdList[$ObjectHeadIdKey];
                                $SaveArr2['sanction_id']             = $BudgetSanctionId;
                                $SaveArr2['apex_project_id']         = $ProjectGrParentId;
                                $SaveArr2['object_head_id']          = $ObjectHeadId;
                                $SaveArr2['object_head_sub_cata_id'] = $ObjectHeadSubCataId;
                                $SaveArr2['gia_id']                  = $GiaId;
                                $SaveArr2['oh_sanctioned_amount']    = $SanctionAmount;
                                $SaveArr2['active']                  = 1;
                                $SaveArr2['created_at']              = NOW();
                                $SaveArr2['created_by']              = session('WcmsEmpNo');
                                $SaveApexSanctionData = $this->ApexBudgetSanctionObjectHeadWise->CreateApexBudgetSanction($SaveArr2);
                            }
                        }
                    }
                }
                DB::commit();
                $message = "Budget Sanction data saved successfully"; 
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message = "Error : Budget Sanction data not saved. Please try again"; 
            }
            Session::put('ALertMesage', $message); 
            return redirect()->route('budget.project-budget-sanction-initiate');
        }
        $GiaData = $this->Gia->ShowGia();
        $GiaData = $GiaData->where('gia_code','CRA');
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
        $ApexSanctionData = $this->ApexBudgetSanction->ShowApexSanctionWithActiveProject(); 
        $ApexSanctionGrpData = filled($ApexSanctionData) ? $ApexSanctionData->groupBy('apex_project_id') : [];
        $ApexProjectIdList = filled($ApexSanctionData) ? $ApexSanctionData->pluck('apex_project_id')->toArray() : [];
        $ApexObjectHeadSanctionData = $this->ApexBudgetSanctionObjectHeadWise->ShowMultipleApexSanctionObjectHeadWise($ApexProjectIdList);
        
        return view('budget-allocation.over-all.project-wise-entry',  compact('ApexSanctionGrpData','ApexObjectHeadSanctionData','GiaData','ObjectHeadData','ObjectHeadSubCataGrpData','ObjectHeadGiaMapgrpData','ParentProjectData','Ledger','LedgerGroup','LedgerData','OBHLegerMappData'));
    }
    public function ProjectBudgetSanctionFinanceYear(Request $request){
        if(isset($request->btn_next)){
            $FinYear = $request->txt_float_financial_year;
        }else{
            $FinYear = Helper::GetCurrentFinYear(NULL);
        } 
        if(isset($request->btnSave)){ //dd($request);
            $SanctionNoList         = $request->input('txt_sanction_no');
            $SanctionDateList       = $request->input('txt_sanction_date');
            $SanctionAmountList     = $request->input('txt_sanction_amount');
            $ApexProjectList        = $request->input('txt_apex_project_id');
            $FinYearList            = $request->input('cmb_finance_year');
            DB::beginTransaction();
            try {
                if(filled($ApexProjectList)){
                    foreach($ApexProjectList as $ApexProjectKey => $ApexProjectId){
                        $SanctionNo     = $SanctionNoList[$ApexProjectKey]; 
                        $SanctionDate   = $SanctionDateList[$ApexProjectKey];
                        $SanctionAmount = $SanctionAmountList[$ApexProjectKey]; 
                        $FinYear        = $FinYearList[$ApexProjectKey];
                        if(($SanctionDate != '')&&($SanctionDate != NULL)){
                            $SanctionDate = Helper::DBDateFormat($SanctionDate);
                        }
                        //$this->ApexBudgetSanction->DeleteApexSanctionByProjectId($ApexProjectId);
                        $this->ApexBudgetSanctionObjectHeadFinYearWise->DeleteApexSanctionByProjectId($ApexProjectId,$FinYear);

                        $OHSanctionAmountList         = $request->input('txt_oh_sanction_amount_fy_'.$ApexProjectId); 
                        $ProjectGrParentList        = $request->input('txt_project_grant_parent_id_'.$ApexProjectId);
                        $GiaIdList                  = $request->input('txt_gia_id_'.$ApexProjectId);
                        $ObjectHeadIdList           = $request->input('txt_object_head_id_'.$ApexProjectId);
                        $ObjectHeadSubCataIdList    = $request->input('txt_object_head_subcata_id_'.$ApexProjectId);
                        $SaveArr1['apex_project_id']        = $ApexProjectId;
                        $SaveArr1['budget_sanction_no']     = $SanctionNo;
                        $SaveArr1['budget_sanction_date']   = $SanctionDate;
                        $SaveArr1['budget_sanction_amt']    = $SanctionAmount;
                        $SaveArr1['active']                 = 1;
                        $SaveArr1['created_at']             = NOW();
                        $SaveArr1['created_by']             = session('WcmsEmpNo');  //print_r($SaveArr1); echo "<br>";
                        /// Master table not available so save part is not required

                        if(filled($ObjectHeadIdList)){
                            foreach($ObjectHeadIdList as $ObjectHeadIdKey => $ObjectHeadId){
                                $SanctionAmount      = $OHSanctionAmountList[$ObjectHeadIdKey];
                                $ProjectGrParentId   = $ProjectGrParentList[$ObjectHeadIdKey];
                                $GiaId               = $GiaIdList[$ObjectHeadIdKey];
                                $ObjectHeadId        = $ObjectHeadIdList[$ObjectHeadIdKey];
                                $ObjectHeadSubCataId = $ObjectHeadSubCataIdList[$ObjectHeadIdKey];
                                $SaveArr2['sanction_id']             = NULL;//$BudgetSanctionId;
                                $SaveArr2['apex_project_id']         = $ProjectGrParentId;
                                $SaveArr2['object_head_id']          = $ObjectHeadId;
                                $SaveArr2['object_head_sub_cata_id'] = $ObjectHeadSubCataId;
                                $SaveArr2['gia_id']                  = $GiaId;
                                $SaveArr2['oh_fy_sanctioned_amount'] = $SanctionAmount;
                                $SaveArr2['fin_year']                = $FinYear;
                                $SaveArr2['active']                  = 1;
                                $SaveArr2['created_at']              = NOW();
                                $SaveArr2['created_by']              = session('WcmsEmpNo');
                                $SaveApexSanctionData = $this->ApexBudgetSanctionObjectHeadFinYearWise->CreateApexBudgetSanction($SaveArr2);
                            }
                        }
                    }
                }
                DB::commit();
                $message = "Budget Sanction data saved successfully"; 
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message = "Error : Budget Sanction data not saved. Please try again"; 
            }
            Session::put('ALertMesage', $message); 
            return redirect()->route('budget.project-budget-sanction-initiate');
        }
        $GiaData = $this->Gia->ShowGia();
        $GiaData = $GiaData->where('gia_code','CRA');
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
        $ApexSanctionData = $this->ApexBudgetSanction->ShowApexSanctionWithActiveProject(); 
        $ApexSanctionGrpData = filled($ApexSanctionData) ? $ApexSanctionData->groupBy('apex_project_id') : [];
        $ApexProjectIdList = filled($ApexSanctionData) ? $ApexSanctionData->pluck('apex_project_id')->toArray() : [];
        $ApexObjectHeadSanctionData = $this->ApexBudgetSanctionObjectHeadWise->ShowMultipleApexSanctionObjectHeadWise($ApexProjectIdList);
        $ApexObjectHeadSanctionDataFy = $this->ApexBudgetSanctionObjectHeadFinYearWise->ShowMultipleApexSanctionObjectHeadWise($ApexProjectIdList,$FinYear);
        
        return view('budget-allocation.finance-year.project-wise-entry',  compact('FinYear','ApexSanctionGrpData','ApexObjectHeadSanctionData','ApexObjectHeadSanctionDataFy','GiaData','ObjectHeadData','ObjectHeadSubCataGrpData','ObjectHeadGiaMapgrpData','ParentProjectData','Ledger','LedgerGroup','LedgerData','OBHLegerMappData'));
    }
    public function SubProjectBudgetSanction(Request $request){
        if(isset($request->btn_save_budget)){
            $ObjectHeadSanctionAmtList  = $request->txt_float_sanction_amt; 
            $GiaIdList                  = $request->txt_float_gia;
            $ObjectHeadIdList           = $request->txt_float_object_head;
            $ObjectHeadSubCataList      = $request->txt_float_object_head_sub_cata;
            $ApexProjectIdList          = $request->txt_float_apex_project_id;
            $ProjectIdList              = $request->txt_float_project_id; 
            if(($ObjectHeadSanctionAmtList != NULL)&&($ObjectHeadSanctionAmtList != "")){
                $ObjectHeadSanctionAmtList = json_decode($ObjectHeadSanctionAmtList);
            }else{
                $ObjectHeadSanctionAmtList = [];
            }
            if(($GiaIdList != NULL)&&($GiaIdList != "")){
                $GiaIdList = json_decode($GiaIdList);
            }else{
                $GiaIdList = [];
            }
            if(($ObjectHeadIdList != NULL)&&($ObjectHeadIdList != "")){
                $ObjectHeadIdList = json_decode($ObjectHeadIdList);
            }else{
                $ObjectHeadIdList = [];
            }
            if(($ObjectHeadSubCataList != NULL)&&($ObjectHeadSubCataList != "")){
                $ObjectHeadSubCataList = json_decode($ObjectHeadSubCataList);
            }else{
                $ObjectHeadSubCataList = [];
            }
            if(($ApexProjectIdList != NULL)&&($ApexProjectIdList != "")){
                $ApexProjectIdList = json_decode($ApexProjectIdList);
            }else{
                $ApexProjectIdList = [];
            }
            if(($ProjectIdList != NULL)&&($ProjectIdList != "")){
                $ProjectIdList = json_decode($ProjectIdList);
            }else{
                $ProjectIdList = [];
            }
            DB::beginTransaction();
            try {
                if(filled($ObjectHeadIdList)){
                    $this->ApexBudgetSanctionSubProjectWise->MultipleDeleteApexSanctionByProjectId($ApexProjectIdList);
                    foreach($ObjectHeadIdList as $ObjectHeadIdKey => $ObjectHeadId){
                        $ObjectHeadSanctionAmt  = $ObjectHeadSanctionAmtList[$ObjectHeadIdKey];
                        $GiaId                  = $GiaIdList[$ObjectHeadIdKey];
                        $ObjectHeadId           = $ObjectHeadIdList[$ObjectHeadIdKey];
                        $ObjectHeadSubCata      = $ObjectHeadSubCataList[$ObjectHeadIdKey];
                        $ApexProjectId          = $ApexProjectIdList[$ObjectHeadIdKey];
                        $ProjectId              = $ProjectIdList[$ObjectHeadIdKey];
                        if($ObjectHeadSanctionAmt == ""){
                            $ObjectHeadSanctionAmt = NULL;
                        }
                        if($ObjectHeadId == ""){
                            $ObjectHeadId = NULL;
                        }
                        if($ObjectHeadSubCata == ""){
                            $ObjectHeadSubCata = NULL;
                        }
                        if($ProjectId == ""){
                            $ProjectId = NULL;
                        }
                        if($ApexProjectId == ""){
                            $ApexProjectId = NULL;
                        }

                        $SaveArr1['budget_sanction_id']         = NULL;//$ObjectHeadSanctionAmt;
                        $SaveArr1['gia_id']                     = $GiaId;
                        $SaveArr1['object_head_id']             = $ObjectHeadId;
                        $SaveArr1['object_head_sub_cata_id']    = $ObjectHeadSubCata;
                        $SaveArr1['project_id']                 = $ProjectId;
                        $SaveArr1['apex_project_id']            = $ApexProjectId;
                        $SaveArr1['sub_proj_sanctioned_amount'] = $ObjectHeadSanctionAmt;
                        $SaveArr1['active']                     = 1;
                        //$SaveArr1['created_at']                 = NOW();
                        $SaveArr1['created_by']                 = session('WcmsEmpNo'); 
                        $this->ApexBudgetSanctionSubProjectWise->CreateApexBudgetSanction($SaveArr1);
                    }
                }
                DB::commit();
                $message = "Sub-Project Budget Sanction data saved successfully"; 
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message = "Error : Sub-Project Budget Sanction data not saved. Please try again"; 
            }
            Session::put('ALertMesage', $message); 
            return redirect()->route('budget.project-budget-sanction-initiate');
        }
        $GiaData = $this->Gia->ShowGia();
        $GiaData = $GiaData->where('gia_code','CRA');
        $ObjectHeadData = $this->ObjectHead->ShowObjectHead(NULL);
        $ObjectHeadGrpData = collect($ObjectHeadData)->keyBy('object_head_id');
        $ObjectHeadGiaMapData = $this->ObjectHeadGiaMapping->ShowObjectHeadGiaMapping(NULL);
        $ObjectHeadGiaMapgrpData = collect($ObjectHeadGiaMapData)->whereNotNull('project_id')->groupBy('project_id');  
        $ObjectHeadSubCataData = $this->ObjectHeadSubCategory->ShowObjectHeadSubCata(NULL);
        $ObjectHeadSubCataGrpData = collect($ObjectHeadSubCataData)->groupBy('object_head_id');
        $Projects = $this->ProjectMaster->GetAllProjectData(NULL);

        $ApexSanctionData = $this->ApexBudgetSanction->ShowApexSanctionWithActiveProject(); 
        $ApexSanctionGrpData = filled($ApexSanctionData) ? $ApexSanctionData->groupBy('apex_project_id') : [];
        $ApexProjectIdList = filled($ApexSanctionData) ? $ApexSanctionData->pluck('apex_project_id')->toArray() : [];
        $ApexObjectHeadSanctionData = $this->ApexBudgetSanctionSubProjectWise->ShowMultipleApexSanctionSubProjectWise($ApexProjectIdList);
        $SanctionIndexed = [];
        if(filled($ApexObjectHeadSanctionData)){
            foreach ($ApexObjectHeadSanctionData as $row){
                $key = ($row->gia_id ?? 0) . '_' .
                    ($row->object_head_id ?? 0) . '_' .
                    ($row->object_head_sub_cata_id ?? 0) . '_' .
                    ($row->project_id ?? 0) . '_' .
                    ($row->apex_project_id ?? 0);
                $SanctionIndexed[$key] = $row->sub_proj_sanctioned_amount;
            }
        }

        return view('budget-allocation.over-all.sub-project-wise-entry',compact('SanctionIndexed','ApexSanctionData','ApexObjectHeadSanctionData','Projects','GiaData','ObjectHeadData','ObjectHeadGrpData','ObjectHeadSubCataGrpData','ObjectHeadGiaMapgrpData'));
        //return view('budget-allocation.sub-project-budget-sanction-entry',  compact('GiaData','ObjectHeadData','ObjectHeadSubCataGrpData','ObjectHeadGiaMapgrpData','ParentProjectData','Ledger','LedgerGroup','LedgerData','OBHLegerMappData'));
    }
    /*public function SubProjectBudgetSanctionFinanceYear(Request $request){
        if(isset($request->btn_save_budget)){
            $ObjectHeadSanctionAmtList  = $request->txt_float_sanction_amt; 
            $GiaIdList                  = $request->txt_float_gia;
            $ObjectHeadIdList           = $request->txt_float_object_head;
            $ObjectHeadSubCataList      = $request->txt_float_object_head_sub_cata;
            $ApexProjectIdList          = $request->txt_float_apex_project_id;
            $ProjectIdList              = $request->txt_float_project_id; 
            if(($ObjectHeadSanctionAmtList != NULL)&&($ObjectHeadSanctionAmtList != "")){
                $ObjectHeadSanctionAmtList = json_decode($ObjectHeadSanctionAmtList);
            }else{
                $ObjectHeadSanctionAmtList = [];
            }
            if(($GiaIdList != NULL)&&($GiaIdList != "")){
                $GiaIdList = json_decode($GiaIdList);
            }else{
                $GiaIdList = [];
            }
            if(($ObjectHeadIdList != NULL)&&($ObjectHeadIdList != "")){
                $ObjectHeadIdList = json_decode($ObjectHeadIdList);
            }else{
                $ObjectHeadIdList = [];
            }
            if(($ObjectHeadSubCataList != NULL)&&($ObjectHeadSubCataList != "")){
                $ObjectHeadSubCataList = json_decode($ObjectHeadSubCataList);
            }else{
                $ObjectHeadSubCataList = [];
            }
            if(($ApexProjectIdList != NULL)&&($ApexProjectIdList != "")){
                $ApexProjectIdList = json_decode($ApexProjectIdList);
            }else{
                $ApexProjectIdList = [];
            }
            if(($ProjectIdList != NULL)&&($ProjectIdList != "")){
                $ProjectIdList = json_decode($ProjectIdList);
            }else{
                $ProjectIdList = [];
            }
            DB::beginTransaction();
            try {
                if(filled($ObjectHeadIdList)){
                    $this->ApexBudgetSanctionSubProjectWise->MultipleDeleteApexSanctionByProjectId($ApexProjectIdList);
                    foreach($ObjectHeadIdList as $ObjectHeadIdKey => $ObjectHeadId){
                        $ObjectHeadSanctionAmt  = $ObjectHeadSanctionAmtList[$ObjectHeadIdKey];
                        $GiaId                  = $GiaIdList[$ObjectHeadIdKey];
                        $ObjectHeadId           = $ObjectHeadIdList[$ObjectHeadIdKey];
                        $ObjectHeadSubCata      = $ObjectHeadSubCataList[$ObjectHeadIdKey];
                        $ApexProjectId          = $ApexProjectIdList[$ObjectHeadIdKey];
                        $ProjectId              = $ProjectIdList[$ObjectHeadIdKey];
                        if($ObjectHeadSanctionAmt == ""){
                            $ObjectHeadSanctionAmt = NULL;
                        }
                        if($ObjectHeadId == ""){
                            $ObjectHeadId = NULL;
                        }
                        if($ObjectHeadSubCata == ""){
                            $ObjectHeadSubCata = NULL;
                        }
                        if($ProjectId == ""){
                            $ProjectId = NULL;
                        }
                        if($ApexProjectId == ""){
                            $ApexProjectId = NULL;
                        }

                        $SaveArr1['budget_sanction_id']         = NULL;//$ObjectHeadSanctionAmt;
                        $SaveArr1['gia_id']                     = $GiaId;
                        $SaveArr1['object_head_id']             = $ObjectHeadId;
                        $SaveArr1['object_head_sub_cata_id']    = $ObjectHeadSubCata;
                        $SaveArr1['project_id']                 = $ProjectId;
                        $SaveArr1['apex_project_id']            = $ApexProjectId;
                        $SaveArr1['sub_proj_sanctioned_amount'] = $ObjectHeadSanctionAmt;
                        $SaveArr1['active']                     = 1;
                        //$SaveArr1['created_at']                 = NOW();
                        $SaveArr1['created_by']                 = session('WcmsEmpNo'); 
                        $this->ApexBudgetSanctionSubProjectWise->CreateApexBudgetSanction($SaveArr1);
                    }
                }
                DB::commit();
                $message = "Sub-Project Budget Sanction data saved successfully"; 
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message = "Error : Sub-Project Budget Sanction data not saved. Please try again"; 
            }
            Session::put('ALertMesage', $message); 
            return redirect()->route('budget.project-budget-sanction-initiate');
        }
        $GiaData = $this->Gia->ShowGia();
        $GiaData = $GiaData->where('gia_code','CRA');
        $ObjectHeadData = $this->ObjectHead->ShowObjectHead(NULL);
        $ObjectHeadGrpData = collect($ObjectHeadData)->keyBy('object_head_id');
        $ObjectHeadGiaMapData = $this->ObjectHeadGiaMapping->ShowObjectHeadGiaMapping(NULL);
        $ObjectHeadGiaMapgrpData = collect($ObjectHeadGiaMapData)->whereNotNull('project_id')->groupBy('project_id');  
        $ObjectHeadSubCataData = $this->ObjectHeadSubCategory->ShowObjectHeadSubCata(NULL);
        $ObjectHeadSubCataGrpData = collect($ObjectHeadSubCataData)->groupBy('object_head_id');
        $Projects = $this->ProjectMaster->GetAllProjectData(NULL);
        return view('budget-allocation.finance-year.sub-project-wise-entry',compact('Projects','GiaData','ObjectHeadData','ObjectHeadGrpData','ObjectHeadSubCataGrpData','ObjectHeadGiaMapgrpData'));
        //return view('budget-allocation.sub-project-budget-sanction-entry',  compact('GiaData','ObjectHeadData','ObjectHeadSubCataGrpData','ObjectHeadGiaMapgrpData','ParentProjectData','Ledger','LedgerGroup','LedgerData','OBHLegerMappData'));
    }*/
    
}
