<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\SdPgRates;
use App\Models\SdAndPo;

use Helper;
use DB;
use Session;

class SdAndPgEntryController extends Controller
{   
    public function __construct(){ 
        $this->PurchaseOrder = new PurchaseOrder();
        $this->SdPgRates     = new SdPgRates();
        $this->SdAndPo       = new SdAndPo();
    }

    public function SDentyForm(Request $request){ 
        $EditSDData=NULL;
        $PODetails=NULL;
        if(isset($request->id)){ 
            try {
                $EditId = decrypt($request->id);
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $data = "Error : Sorry Invalid Attempt";
                return redirect()->back();
            }
            $EditSDData   = $this->SdAndPo->ShowPgSdData($EditId);
            $PODetails    = $this->PurchaseOrder->showPurchaseOredrData(NULL,$EditSDData[0]->po_id);
            $PODatas  = $this->PurchaseOrder->showSdRecievedData(NULL,$EditSDData[0]->po_id);
            
        }
        if(isset($request->btn_save)){  
            $SdPo               = $request->sd_po;
            $PoId               = $request->cmb_po_id;
            // dd($PoId);
            $PoDate             = $request->txt_po_date;
            $PoAmount           = $request->txt_po_amount;
            $SdPercent          = $request->txt_sd_percentage;
            $SdAmount           = $request->txt_sd_amount;
            $SdDate             = $request->txt_sd_date;
            $SdMode             = $request->cmb_sd_mode;
            $InstrumentDate     = $request->txt_instrument_date;
            $InstrumentNo       = $request->txt_instrument_no;
            $InstrumentAmt      = $request->txt_instrument_amount;
            $InstrumentBank     = $request->txt_instrument_bank;
            $InstrumentValidity = $request->txt_instrument_date;
            
            DB::beginTransaction();
            try {
                $SaveData['sd_po']               = $SdPo;
                $SaveData['po_id']               = $PoId;
                $SaveData['sd_po_percentage']    = $SdPercent;
                $SaveData['sd_po_amount']        = $SdAmount;
                $SaveData['sdpo_received_date']  = $SdDate ? Helper::DBDateFormat($SdDate) : null;
                $SaveData['sd_po_mode']          = $SdMode;
                $SaveData['instrument_date']     = $InstrumentDate ? Helper::DBDateFormat($InstrumentDate) : null;
                $SaveData['instrument_no']       = $InstrumentNo;
                $SaveData['instrument_amount']   = $InstrumentAmt;
                $SaveData['instrument_bank']     = $InstrumentBank;
                $SaveData['instrument_validity'] = $InstrumentValidity ? Helper::DBDateFormat($InstrumentValidity) : null;
                $SaveData['active']              = 1;
                $SaveData['created_by']          = session('WcmsEmpNo');
                $SaveData['created_at']          = NOW();
                $SaveData['updated_at']          = NOW();
                $SaveData['updated_by']          = session('WcmsEmpNo');
                if(isset($request->id)){ 
                    $SaveData = $this->SdAndPo->CreateSdPo($SaveData,$EditId);
                }else{
                    $SaveData = $this->SdAndPo->CreateSdPo($SaveData,NULL);
                }
                // $PoId=$SaveData->po_id;
                $SaveData1 = $this->PurchaseOrder->SavesdIssued($PoId,'SD');
                DB::commit();
                $message = "SD Entry Saved ";
                Session::put('ALertMesage', $message); 
            }catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
                Session::put('ALertMesage', $message); 
            }
        }
        
        if(!isset($request->id)){ 
            $PODatas  = $this->PurchaseOrder->showSdRecievedData($request,NULL);
        }
       
        return view('sdpo-entry.sd-entry')->with('data',compact('PODatas','EditSDData','PODetails'));  
    }

    public function POentyForm(Request $request){ 
        $EditPGData=NULL;
        $PODetails=NULL;
        if(isset($request->id)){ 
            try {
                $EditId = decrypt($request->id);
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $data = "Error : Sorry Invalid Attempt";
                return redirect()->back();
            }
            $EditPGData   = $this->SdAndPo->ShowPgSdData($EditId);
            $PODetails    = $this->PurchaseOrder->showPurchaseOredrData(NULL,$EditId);

            $EditPGData   = $this->SdAndPo->ShowPgSdData($EditId);
            $PODetails    = $this->PurchaseOrder->showPurchaseOredrData(NULL,$EditPGData[0]->po_id);
            $PODatas  = $this->PurchaseOrder->showPgRecievedData(NULL,$EditPGData[0]->po_id);
            
        }
        if(isset($request->btn_save)){  
            $SdPo               = $request->sd_po;
            $PoId               = $request->cmb_po_id;
            $PoDate             = $request->txt_po_date;
            $PoAmount           = $request->txt_po_amount;
            $PgPercent          = $request->txt_pg_percentage;
            $PgAmount           = $request->txt_pg_amount;
            $PgDate             = $request->txt_pg_date;
            $PgMode             = $request->cmb_pg_mode;
            $InstrumentDate     = $request->txt_instrument_date;
            $InstrumentNo       = $request->txt_instrument_no;
            $InstrumentAmt      = $request->txt_instrument_amount;
            $InstrumentBank     = $request->txt_instrument_bank;
            $InstrumentValidity = $request->txt_instrument_date;
            
            DB::beginTransaction();
            try {
                $SaveData['sd_po']               = $SdPo;
                $SaveData['po_id']               = $PoId;
                $SaveData['sd_po_percentage']    = $PgPercent;
                $SaveData['sd_po_amount']        = $PgAmount;
                $SaveData['sdpo_received_date']  = $PgDate ? Helper::DBDateFormat($PgDate) : null;
                $SaveData['sd_po_mode']          = $PgMode;
                $SaveData['instrument_date']     = $InstrumentDate ? Helper::DBDateFormat($InstrumentDate) : null;
                $SaveData['instrument_no']       = $InstrumentNo;
                $SaveData['instrument_amount']   = $InstrumentAmt;
                $SaveData['instrument_bank']     = $InstrumentBank;
                $SaveData['instrument_validity'] = $InstrumentValidity ? Helper::DBDateFormat($InstrumentValidity) : null;
                $SaveData['active']              = 1;
                $SaveData['created_by']          = session('WcmsEmpNo');
                $SaveData['created_at']          = NOW();
                $SaveData['updated_at']          = NOW();
                $SaveData['updated_by']          = session('WcmsEmpNo');
                if(isset($request->id)){ 
                    $SaveData = $this->SdAndPo->CreateSdPo($SaveData,$EditId);
                }else{
                    $SaveData = $this->SdAndPo->CreateSdPo($SaveData,NULL);
                }
                // $PoId=$SaveData->po_id;
                $SaveData1 = $this->PurchaseOrder->SavesdIssued($PoId,'PG');
                DB::commit();
                $message = "PG Entry Saved ";
                Session::put('ALertMesage', $message); 
            }catch (\Exception $e) {
                DB::rollback();
                dd($e);
                $message = "Error : Sorry transaction not fully completed";
                Session::put('ALertMesage', $message); 
            }
        }
        
        if(!isset($request->id)){ 
            $PODatas  = $this->PurchaseOrder->showPgRecievedData($request,NULL);
        }

        return view('sdpo-entry.po-entry')->with('data',compact('PODatas','EditPGData','PODetails'));  
    }

    public function getSdPercentage(Request $request)
    {
        $amount = $request->amount;
        $SDrPO  = $request->SDrPO;
        $percentage = SdPgRates::where('from_value', '<=', $amount)
            ->where('to_value', '>=', $amount)->where('sd_po', $SDrPO)->where('active', 1)->value('percentage');

        return response()->json([
            'percentage' => $percentage
        ]);
    }
    public function PoSDPGData(Request $request){
        $POId                   = $request->POId;
        $PurchaseOrderPgSdData  = $this->SdAndPo->ShowPgSdData($POId);
        $OutputArr              = array('PGSDVALUES' => $PurchaseOrderPgSdData);
        return $OutputArr;
    }
       
}