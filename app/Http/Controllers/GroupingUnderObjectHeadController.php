<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materialgroup;
use App\Models\GroupingUnderObjectHead;


class GroupingUnderObjectHeadController extends Controller
{
     public function __construct(){
        $this->GroupingUnderObjectHead     = new GroupingUnderObjectHead();
    }
    public function GroupingUnderObjectHead(Request $request){
        $message = NULL;
    if(isset($request->btn_save)){
            if($request->input('btn_save') == "Save"){
                $ParGroupArr 	= $request->input('cmb_group');
                $NewGroup 	= $request->input('txt_new_group');
                //$GroupType 	= $request->input('txt_ledger_group_type');
                //$CreditDebit 	= $request->input('rad_credit_debit');
                //$DpOrder 	= $request->input('txt_dp_order');
                $CataOrLedger 	= $request->input('txt_type');
                $ParCount 	 	= count($ParGroupArr);
                $ParentId 	 	= $ParGroupArr[$ParCount-1];
                if(($ParentId == "NEW")||($ParentId == "NEW")){
                    if($ParCount == 1){
                        $ParentId = 0;
                    }else{
                        $ParentId = $ParGroupArr[$ParCount-2];
                    }
                }
                $InsertArr = array();
                $InsertArr['object_head_group_name']     = $NewGroup;
                $InsertArr['object_head_group_code']     = NULL;
                $InsertArr['object_head_group_parentid'] = $ParentId;
                $InsertArr['active']                = 1;
                if($CataOrLedger == 'L'){
                    //$InsertArr['ledger_group_type']     = $GroupType;
                    //$InsertArr['credit_debit']          = $CreditDebit;
                    //$InsertArr['dp_order']              = $DpOrder;
                }
                $InsertedData = $this->GroupingUnderObjectHead->CreateGroupingUnderObjectHead($InsertArr);
                if($InsertedData != NULL)
                {
                    $LogMessage = "LedgerController || New Leder Created Successfully )";
                    Helper::CreateLog($request,$LogMessage);       
                    $message = ("New Ledger Created Successfully!");
                }
            }   
        }
        $ShowGrandParent = $this->GroupingUnderObjectHead->ShowGrandParent($request);
        return view('grouping-under-object.grouping-under-object')->with('data',compact('ShowGrandParent'))->with('ALertMesage',$message);
    }
}
