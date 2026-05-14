<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\RcItemGroup;
use App\Models\RcItemRateMaster;
use Session;
use Helper;
use DB;

class RcItemController extends Controller
{
    public function __construct(){
        $this->ItemGroup        = new RcItemGroup();
        $this->RcItemRateMaster = new RcItemRateMaster();
    }
    public function ItemGroupcreation(Request $request){
        $message = NULL;
        if(isset($request->btn_save)){ 
            if($request->input('btn_save') == "Save"){
                $ParGroupArr 	= $request->input('cmb_group');
                $NewGroup 	    = $request->input('txt_new_group');
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
                $InsertArr['rc_item_name']     = $NewGroup;
                $InsertArr['rc_item_parentid'] = $ParentId;
                $InsertArr['active']                = 1;
                if($CataOrLedger == 'L'){
                    //$InsertArr['ledger_group_type']     = $GroupType;
                    //$InsertArr['credit_debit']          = $CreditDebit;
                    //$InsertArr['dp_order']              = $DpOrder;
                }
                $InsertedData = $this->ItemGroup->CreateItemGroup($InsertArr);
                //dd($InsertedData);
                if($InsertedData != NULL)
                {
                    $LogMessage = "RcItemController || New Item Created  )";
                    Helper::CreateLog($request,$LogMessage);       
                    $message = ("New Items Created !");
                }
            }   
        }  
        $ShowGrandParent = $this->ItemGroup->ShowGrandParent($request);
        return view('rc-item-master.rc-item-master')->with('data',compact('ShowGrandParent'))->with('ALertMesage',$message);
    }
    public function ItemGroupFind(Request $request){ 
        $GroupId 	= $request->input('groupid');
        $ItemData =  $this->ItemGroup->GetItemGroup($GroupId);
        return $ItemData;
    }
    public function ViewItemMaster(Request $request) {
        if(isset($request->btn_save)){
            $ItemRcId         = $request->txt_rc_item_id;
            $ItemUnitPrice    = $request->txt_unit_price;
            $ItemGstPerc      = $request->txt_gst_prec;
            $ItemTotalAmount  = $request->txt_total_price;
            $EffectFrom       = $request->tx_effect_from_date;
            $EffectTo         = $request->tx_effect_to_date;
            if(($ItemRcId != NULL)&&($ItemRcId != "")){
                $ItemRcIdList = json_decode($ItemRcId);
            }else{
                $ItemRcIdList = [];
            }
            if(($ItemUnitPrice != NULL)&&($ItemUnitPrice != "")){
                $ItemUnitPriceList = json_decode($ItemUnitPrice);
            }else{
                $ItemUnitPriceList = [];
            }
             if(($ItemGstPerc != NULL)&&($ItemGstPerc != "")){
                $ItemGstPercList = json_decode($ItemGstPerc);
            }else{
                $ItemGstPercList = [];
            }
             if(($ItemTotalAmount != NULL)&&($ItemTotalAmount != "")){
                $ItemTotalAmountList = json_decode($ItemTotalAmount);
            }else{
                $ItemTotalAmountList = [];
            }
            DB::beginTransaction();
            try {//dd($ItemUnitPriceList);
                if(filled($ItemUnitPriceList) && $ItemUnitPriceList !=NULL && $ItemUnitPriceList !=''){
                    foreach($ItemUnitPriceList as $SaveKey => $SaveValue){
                        $RcItemId    = $ItemRcIdList[$SaveKey];
                        $UnitRate    = $ItemUnitPriceList[$SaveKey];
                        $GstPerc     = $ItemGstPercList[$SaveKey];
                        $TotalAmout  = $ItemTotalAmountList[$SaveKey];
                        $SaveArr['rc_item_id']           = $RcItemId;
                        $SaveArr['rate_per_unit']        = $UnitRate;
                        $SaveArr['gst']                  = $GstPerc;
                        $SaveArr['total_price']          = $TotalAmout;
                        $SaveArr['effective_from_date']  = $EffectFrom;
                        $SaveArr['effective_to_date']    = $EffectTo;
                        $SaveArr['active']               = 1;
                        $SaveArr['created_at']           = NOW();
                        $SaveArr['created_by']          = session('WcmsEmpNo');
                        if($UnitRate != NULL && $UnitRate != ''){
                            $this->RcItemRateMaster->DeleteRcRateRecord($RcItemId,$EffectFrom,$EffectTo);
                            $this->RcItemRateMaster->CreateRcItemRateDt($SaveArr);
                        }  
                    }
                }
                DB::commit();
                $message = "Rate Contract details saved successfully"; 
            } catch (\Exception $e) {  dd($e);
                $message = "Error : Rate Contract not saved. Please try again"; 
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('rc-item-master.view-rc-item-master');
        }
        $ItemGroupData = $this->ItemGroup->ShowAllParentChild();
        return view('rc-item-master.view-rc-item-master')->with('data',compact('ItemGroupData'));
    }
    public function RCItemRate(Request $request) {
        $ItemGroupData = $this->ItemGroup->ShowAllParentChild();
        return view('rc-item-master.view-rc-item-master')->with('data',compact('ItemGroupData'));
    }
   
    
}
