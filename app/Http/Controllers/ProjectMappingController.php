<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\BudgetEstimate;
use App\Models\ObjectHeadGroup;
use App\Models\LedgerGroup;
use App\Models\ObjectHeadLedgerGroupMapping;
use App\Models\GiaMaster;
use App\Models\ProjectHeadGroupMapping;
use Helper;
use DB;
use Session;

class ProjectMappingController extends Controller
{
    public function __construct(){
        $this->BudgetEstimate  = new BudgetEstimate();
        $this->ObjectHeadGroup = new ObjectHeadGroup();
        $this->LedgerGroup     = new LedgerGroup();
        $this->OBHledgerGroupMapp      = new ObjectHeadLedgerGroupMapping();
        $this->ProjectHeadGroupMapping = new ProjectHeadGroupMapping();
        $this->GiaMaster               = new GiaMaster();
    }
    public function projectHeadMapping(Request $request) {
        if(isset($request->btn_save)){
            $GruopIdArr                    = $request->input('hidden_gia_id'); 
            $SelectedObjectHeadGroupIdArr  = $request->input('cmb_oh_id_'); 
            DB::beginTransaction();
                try {
                    if(filled($SelectedObjectHeadGroupIdArr)){
                        $DeleteProjectHeadMapping = $this->ProjectHeadGroupMapping->DeleteProjectHeadMapping($request);
                       foreach($SelectedObjectHeadGroupIdArr as $rowKey => $ProjectHeadIds){
                            $ObjHeadIdString = implode(',', $ProjectHeadIds ?? []);
                            $SaveDtData = [];
                            $SaveDtData['gia_id']                = $GruopIdArr[$rowKey]; 
                            $SaveDtData['object_head_grouop_id'] = $ObjHeadIdString;     
                            $SaveDtData['active']                = 1;
                            $SaveDtData['created_at']            = NOW();
                            $SaveDtData['created_by']            = session('WcmsEmpNo');

                            if(filled($ObjHeadIdString)){
                                $SaveIndent = $this->ProjectHeadGroupMapping
                                                ->CreateProjectHeadGroupMapping(Null, $SaveDtData, NULL);
                            }
                        }
                    }
                    DB::commit();
                    $message = "Project Heads  Mapping  Details Save Successfully";
                    Session::put('ALertMesage', $message);
                    return redirect()->route('project-mapping.project-mapping-create');
                }catch (\Exception $e) { dd($e);
                    DB::rollback();
                    $message = "Error : Sorry transaction not fully completed";
                    Session::put('ALertMesage', $message);
                }
        }
        $ObjectHeadGroupData = $this->ObjectHeadGroup->ShowAllParentChild();
        $LedgerGroupData     = $this->LedgerGroup->AllLeafNodesOnly();
        $projectHeadData     = $this->ProjectHeadGroupMapping->ShowProjectHeadData($request);
        $GiaMasterData       = $this->GiaMaster->showGiaMasterData($request);
        return view('project-mapping.project-head-mapping-create', compact('ObjectHeadGroupData','LedgerGroupData','projectHeadData','GiaMasterData'));
    }
}
