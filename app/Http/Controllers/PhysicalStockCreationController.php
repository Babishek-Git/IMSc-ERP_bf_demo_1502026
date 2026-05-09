<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Materialgroup;
use App\Models\Ledger;
use App\Models\TaxRate;
use Session;
use Helper;
use DB;

class PhysicalStockCreationController extends Controller
{
    public function __construct(){
        $this->Materialgroup = new Materialgroup();
        $this->Ledger        = new Ledger();
        $this->Tax           = new TaxRate();
    }
    public function PhysicalStockCreation(Request $request){
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
                $InsertArr['material_group_name']     = $NewGroup;
                $InsertArr['material_group_code']     = NULL;
                $InsertArr['material_group_parentid'] = $ParentId;
                $InsertArr['active']                = 1;
                if($CataOrLedger == 'L'){
                    //$InsertArr['ledger_group_type']     = $GroupType;
                    //$InsertArr['credit_debit']          = $CreditDebit;
                    //$InsertArr['dp_order']              = $DpOrder;
                }
                $InsertedData = $this->Materialgroup->CreateMaterialgroup($InsertArr);
                if($InsertedData != NULL)
                {
                    $LogMessage = "PhysicalStockCreationController || New Leder Created Successfully )";
                    Helper::CreateLog($request,$LogMessage);       
                    $message = ("New Physical Stock Created ** Successfully!");
                }
            }   
        }  
        $ShowGrandParent = $this->Materialgroup->ShowGrandParent($request);
        return view('physical-stock.Physical-Stock-Creation')->with('data',compact('ShowGrandParent'))->with('ALertMesage',$message);
    }

    public function MaterialGroupFind(Request $request){ 
        
        $GroupId 	= $request->input('groupid');
        $MaterialData =  $this->Materialgroup->GetMaterialGroup($GroupId);

        return $MaterialData;
    }

    public function PhysicalStockview(Request $request){

        $PhysicalStock   = $this->Materialgroup->ShowMaterialGroup($request,NULL);
        $grouped         = $PhysicalStock->groupBy('material_group_parentid');

        return view('physical-stock.physical-stock-view')->with('data',compact('grouped'));
    }

    //  public function Ledgercreation(Request $request){
    //     if(isset($request->btn_save))
    //     {
    //         $AccountName   = $request->txt_led_acc_name;
    //         $ParentCategory= $request->txt_para_cate;
    //         $OpeningBalance= $request->txt_open_bal;
    //         $DebitCredit    = $request->rad_deb_crd;
    //         $AsOfDate      = $request->txt_as_of_date;
    //         $AssociatedTax = $request->txt_assoc_tax;
            
    //         $rules = [
	// 			'AccountName' => 'required|max:50',
	// 			'ParentCategory' => 'required|max:25',
    //             'OpeningBalance' => 'required|max:20',
	// 			'DebitCredit' => 'required|max:50',
    //             'AsOfDate' => 'required|max:30',
    //             'AssociatedTax' => 'required|max:30',
	// 		];
	// 		$ValidateData = [
    //             'AccountName'    =>$AccountName,
	// 			'ParentCategory' => $ParentCategory,
    //             'OpeningBalance' =>$OpeningBalance,
	// 			'DebitCredit'     => $DebitCredit,
    //             'AsOfDate'       =>$AsOfDate,
	// 			'AssociatedTax'  => $AssociatedTax,
	// 		];
    //         $Validate = Validator::make($ValidateData, $rules); 
    //         $ErrArr = [];
    //         if($Validate->fails())
    //          {
    //             //$date = NULL;
    //             $ValidateFields = $Validate->failed();
    //             foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
    //             {
    //                 if($AccountName == "AccountName"){
    //                     $ErrArr[] = "Error : Invalid  Account Name.";
    //                 }
    //                 if($ParentCategory == "ParentCategory"){
    //                     $ErrArr[] = "Error : Invalid Parent Category.";
    //                 }
    //                 if($OpeningBalance == "OpeningBalance"){
    //                     $ErrArr[] = "Error : Invalid  Opening Balance.";
    //                 }
    //                 if($DebitCredit == "DebitCredit"){
    //                     $ErrArr[] = "Error : Invalid Ledger Type.";
    //                 }
    //                 if($AsOfDate == "AsOfDate"){
    //                     $ErrArr[] = "Error : Invalid  Opening Balance.";
    //                 }
    //                 if($AssociatedTax == "AssociatedTax"){
    //                     $ErrArr[] = "Error : Invalid Associated Tax.";
    //                 }
                    
    //             }
    //         }
    //         if(filled($ErrArr))
    //         {
    //             $ErrorStr = implode(",",$ErrArr);
    //             Session::put('ALertMesage', $ErrorStr);
    //             return redirect()->route('ledger.ledger-creation');
    //         }
    //         DB::beginTransaction();
    //         try {
    //             if($AssociatedTax == 'NONE'){ $AssociatedTax = NULL; }
    //             $SaveData['ledger_acc_name'] = $AccountName;
    //             $SaveData['ledger_group_id'] = $ParentCategory;
    //             $SaveData['opening_balance'] = $OpeningBalance;
    //             $SaveData['debit_credit']    = $DebitCredit;
    //             $SaveData['ledger_date']     = $AsOfDate;
    //             $SaveData['tax_id']          = $AssociatedTax;
    //             $SaveData['active']          = 1;
    //             $SaveData['created_at']      = NOW();
    //             $SaveData['created_by']      = session('WcmsEmpNo');
    //             $SaveEmployment= $this->Ledger->CreateLedger($SaveData);
    //             //dd($SaveEmployment);
    //             DB::commit();
    //             $message = "Ledger Saved Successfully";
    //         }catch (\Exception $e) {dd($e); 
    //             DB::rollback();
    //             $message = "Error : Sorry transaction not fully completed";
    //         }
    //         Session::put('ALertMesage', $message);
    //         return redirect()->route('ledger.ledger-creation');
    //     }
    //     $LeafNode = $this->Materialgroup->AllLeafNodesOnly();
    //     $TaxRate = $this->Tax->ShowTaxRate();
    //     $Ledger  = $this->Ledger->ShowLedger();
    //     //dd($Ledger);
    //     return view('ledger.ledger-creation')->with('data',compact('LeafNode','TaxRate','Ledger'));
    // }
    
}
