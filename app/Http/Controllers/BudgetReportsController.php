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
use App\Models\PaymentObjectHead;


use Helper;
use DB;
use Session;



class BudgetReportsController extends Controller
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
        $this->PaymentObjectHead = new PaymentObjectHead();
    }
    public function BudgetReportsInitiate(Request $request){
        return view('budget-reports.budget-reports-initiate');
    }
    public function ApexProjectObjectHeadConsolidated(Request $request){
        $ToDate = date('Y-m-d');
        $GiaData = $this->Gia->ShowGia();
        $GiaData = $GiaData->where('gia_code','CRA');
        $ObjectHeadData = $this->ObjectHead->ShowObjectHead(NULL);
        $ObjectHeadGiaMapData = $this->ObjectHeadGiaMapping->ShowObjectHeadGiaMapping(NULL);
        $ObjectHeadGiaMapgrpData = collect($ObjectHeadGiaMapData)->groupBy('gia_id'); 
        $ObjectHeadSubCataData = $this->ObjectHeadSubCategory->ShowObjectHeadSubCata(NULL);
        $ObjectHeadSubCataGrpData = collect($ObjectHeadSubCataData)->groupBy('object_head_id');
        $ParentProjectData = $this->ProjectMaster->GetAllParentProjectData('INT');
        $OBHLegerMappData = $this->ObjectHeadLedgerGroupMapping->ShowOBHLegerData();
        $ApexSanctionData = $this->ApexBudgetSanction->ShowApexSanctionWithActiveProject(); 
        $ApexSanctionGrpData = filled($ApexSanctionData) ? $ApexSanctionData->groupBy('apex_project_id') : [];
        $ApexProjectIdList = filled($ApexSanctionData) ? $ApexSanctionData->pluck('apex_project_id')->toArray() : [];
        $ApexObjectHeadSanctionData = $this->ApexBudgetSanctionObjectHeadWise->ShowMultipleApexSanctionObjectHeadWise($ApexProjectIdList); 
        $PaymentData = $this->PaymentObjectHead->ShowAPexProjectObjectHeadExpenditure(NULL,$ToDate); 
        return view('budget-reports.apex-project-object-head-consolidated',  compact('ToDate','ApexSanctionGrpData','ApexObjectHeadSanctionData','PaymentData','GiaData','ObjectHeadData','ObjectHeadSubCataGrpData','ObjectHeadGiaMapgrpData','ParentProjectData','OBHLegerMappData'));
    }
    public function SubProjectObjectHeadConsolidated(Request $request){
        $ToDate = date('Y-m-d');
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
        $PaymentData = $this->PaymentObjectHead->ShowSubProjectObjectHeadExpenditure(NULL,$ToDate); 
        $PaymentIndexed = [];
        if(filled($PaymentData)){
            foreach ($PaymentData as $row){
                $key = ($row->gia_id ?? 0) . '_' .
                    ($row->object_head_id ?? 0) . '_' .
                    ($row->object_head_sub_cata_id ?? 0) . '_' .
                    ($row->project_id ?? 0) . '_' .
                    ($row->parent_project_id ?? 0);
                $PaymentIndexed[$key] = $row->total_amount;
            }
        }
        //dd($PaymentIndexed);
        return view('budget-reports.sub-project-object-head-consolidated',compact('SanctionIndexed','PaymentIndexed','ApexSanctionData','ApexObjectHeadSanctionData','Projects','GiaData','ObjectHeadData','ObjectHeadGrpData','ObjectHeadSubCataGrpData','ObjectHeadGiaMapgrpData'));
    }

    public function RevenueObjectHeadConsolidated(Request $request){
        $ToDate = date('Y-m-d');
        $GiaData = $this->Gia->ShowGia();
        $RevenueGiaArr = ['REG','RES'];
        $GiaData = $GiaData->whereIn('gia_code',$RevenueGiaArr);
        $ObjectHeadData = $this->ObjectHead->ShowObjectHead(NULL);
        $ObjectHeadGiaMapData = $this->ObjectHeadGiaMapping->ShowObjectHeadGiaMapping(NULL);
        $ObjectHeadGiaMapgrpData = collect($ObjectHeadGiaMapData)->groupBy('gia_id'); 
        $ObjectHeadSubCataData = $this->ObjectHeadSubCategory->ShowObjectHeadSubCata(NULL);
        $ObjectHeadSubCataGrpData = collect($ObjectHeadSubCataData)->groupBy('object_head_id');
        $ApexObjectHeadSanctionData = $this->ApexBudgetSanctionObjectHeadWise->ShowMultipleApexSanctionObjectHeadWise($ApexProjectIdList); 
        $PaymentData = $this->PaymentObjectHead->ShowAPexProjectObjectHeadExpenditure(NULL,$ToDate); 
        return view('budget-reports.apex-project-object-head-consolidated',  compact('ToDate','ApexSanctionGrpData','ApexObjectHeadSanctionData','PaymentData','GiaData','ObjectHeadData','ObjectHeadSubCataGrpData','ObjectHeadGiaMapgrpData','ParentProjectData','OBHLegerMappData'));
    }
    
    
}
