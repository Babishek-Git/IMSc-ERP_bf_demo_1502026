<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\MaterialUnit;
use App\Models\MaterialType;
use App\Models\ItemMaster;
use Exception;
use Helper;
use Session;
class ItemController extends Controller
{
    protected $role;
    public function __construct(){
       $this->MaterialUnit = new MaterialUnit();
       $this->MaterialType = new MaterialType();
       $this->ItemMaster   = new ItemMaster();
    }
    public function ItemMaster(Request $request)
    {   
        if(isset($request->btn_save))
        { //dd($request);
            $MaterialType     = $request->cmb_material_type;
            $ItemNo           = $request->txt_item_no;
            $ItemName         = $request->txt_item_name;
            $ItemUnit         = $request->item_unit;
            $OpeningBalance   = $request->txt_open_balance;
            
            $rules = [
				'MaterialType'    => 'required|max:25',
				'ItemNo'          => 'required|max:5',
                'ItemName'        => 'required|max:50',
				'ItemUnit'        => 'required|max:5',
                'OpeningBalance'  => 'required|max:5',
			];
			$ValidateData = [
                'MaterialType'    => $MaterialType,
				'ItemNo'          => $ItemNo,
                'ItemName'        => $ItemName,
				'ItemUnit'        => $ItemUnit,
                'OpeningBalance'  => $OpeningBalance,
                				
			];
            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($MaterialType == "MaterialType"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Material Type.";
                    }
                    if($ItemNo == "ItemNo"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid Item No.";
                    }
                    if($ItemName == "ItemName"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Item Description.";
                    }
                    if($OpeningBalance == "OpeningBalance"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid Opening Balance.";
                    }
                    
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('item-master.item-master');
            }
            DB::beginTransaction();
            try {
                $SaveData['material_code']    = $ItemNo;
                $SaveData['material_name']    = $ItemName;
                $SaveData['material_type_id'] = $MaterialType;
                $SaveData['uom_id']           = $ItemUnit;
                $SaveData['opening_stock']    = $OpeningBalance;
                $SaveData['active']           = 1;
                $SaveData['created_at']       = NOW();
                $SaveData['created_by']       = session('WcmsEmpNo');
                
                $SaveEmployment= $this->ItemMaster->CreateItemMaster($SaveData);
                //dd($SaveEmployment);
                DB::commit();
                $message = "Item Master Data Saved ";
            }catch (\Exception $e) {dd($e); 
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('item-master.item-master');
        }
        $MaterialUnitData=$this->MaterialUnit->ShowMaterialUnit(null);
        $MaterialTypeData=$this->MaterialType->ShowMaterialType(null);
        $ItemData=$this->ItemMaster->ShowItemMaster();
        return view('item.item-master')->with('data', compact('MaterialUnitData','MaterialTypeData','ItemData')); //EL Encashment along with LTC Request
    }
     public function GetItemData(Request $request){ 
        $EmpData = $this->Employee->ShowEmployees($request,$request->EmpNo);
       // dd($EmpData);
        $BankDetail = $this->bankdetail->ShowBankDetails($request,$request->EmpNo);
        //$SectionId = collect($EmpData)->pluck('section_id')->first();
        $GroupId = collect($EmpData)->pluck('group_id')->first();
        $GroupRoleData = $this->role->ShowRoleListByGroup($GroupId); 
        $FamilyData = $this->empfamilydetails->ShowFamilyDetails($request,$request->EmpNo);
        $OutputArr = array('EmpData' => $EmpData, 'GroupRoleData' => $GroupRoleData, 'BankDetail' => $BankDetail, 'FamilyData' => $FamilyData);
       
        return $OutputArr; 
    }
    
}