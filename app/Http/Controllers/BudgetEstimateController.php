<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\BudgetEstimate;
use App\Models\ObjectHeadGroup;
use App\Models\LedgerGroup;
use App\Models\ObjectHeadLedgerGroupMapping;
use Helper;
use DB;
use Session;
class BudgetEstimateController extends Controller
{   
    public function __construct(){
        $this->BudgetEstimate  = new BudgetEstimate();
        $this->ObjectHeadGroup = new ObjectHeadGroup();
        $this->LedgerGroup = new LedgerGroup();
        $this->OBHledgerGroupMapp = new ObjectHeadLedgerGroupMapping();
    }
    public function BudgetEstimate(Request $request) {
        if(isset($request->btn_save)){
            $ObjectHeadGroupIdArr  = $request->input('hidden_oh_id'); 
            $SelectedLederidArr    = $request->input('cmb_ledger'); 
            DB::beginTransaction();
                try {
                    if(filled($SelectedLederidArr)){
                        $DeleteOBHledgerGroupMapping = $this->OBHledgerGroupMapp->DeleteOBHledgerGroupMapping($request);
                        foreach($ObjectHeadGroupIdArr as $rowKey => $ObjHeadId){
                            $LedgerIds     = $SelectedLederidArr[$rowKey] ?? [];
                            $LederIdString = implode(',', $LedgerIds); 
                            $SaveDtData = [];
                            $SaveDtData['object_head_grouop_id'] = $ObjHeadId;
                            $SaveDtData['ledger_group_id']       = $LederIdString;
                            $SaveDtData['active']                = 1;
                            $SaveDtData['created_at']            = NOW();
                            $SaveDtData['created_by']            = session('WcmsEmpNo');
                            if(filled($LederIdString)){
                                $SaveIndent = $this->OBHledgerGroupMapp->CreateOBHledgerGroupMapping(Null, $SaveDtData, NULL);
                            }
                        }
                    }
                    DB::commit();
                    $message = "Object Heads - Ledger Mapping  Details Save Successfully";
                    Session::put('ALertMesage', $message);
                    return redirect()->route('budget-estimate.budget-estimate');
                }catch (\Exception $e) { dd($e);
                    DB::rollback();
                    $message = "Error : Sorry transaction not fully completed";
                    Session::put('ALertMesage', $message);
                }
        }
        $ObjectHeadGroupData = $this->ObjectHeadGroup->ShowAllParentChild();
        $LedgerGroupData     = $this->LedgerGroup->AllLeafNodesOnly();
        $OBHLegerData        = $this->OBHledgerGroupMapp->ShowOBHLegerData($request);
        return view('budget-estimate.budget-estimate-ledger-mapping', compact('ObjectHeadGroupData','LedgerGroupData','OBHLegerData'));
    }
    
}
