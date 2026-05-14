<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\MaterialUnit;
use Helper;
use DB;
use Session;
class MaterialUnitController extends Controller
{
    public function __construct(){
          $this->MaterialUnit  = new MaterialUnit();
    }
    public function MaterialUnit(Request $request) {
        if(isset($request->btn_save))
        {
          
            $MaterialUnitCode = $request->txt_unit_code;
            $MaterialUnitName = $request->txt_unit_name;
            $MaterialId      = $request->hid_material_id;
          
            $rules = [
				'MaterialUnitCode' => 'required|max:5',
				'MaterialUnitName' => 'required|max:25',
                
			];
			$ValidateData = [
                'MaterialUnitCode' =>$MaterialUnitCode,
				'MaterialUnitName' => $MaterialUnitName,
                				
			];
            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($MaterialUnitCode == "MaterialUnitCode"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Unit Code.";
                    }
                    if($MaterialUnitName == "MaterialUnitName"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid Unit Name.";
                    }
                    
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('material-unit-master.material-unit-master');
            }
            DB::beginTransaction();
            try {
              // dd(123);
                $SaveData['uom_code'] = $MaterialUnitCode;
                $SaveData['uom_name'] = $MaterialUnitName;
                $SaveData['active'] = 1;
                $SaveData['created_at'] = NOW();
                $SaveData['created_by'] = session('WcmsEmpNo');
                if($MaterialId != NULL){ 
                    $SaveData['updated_at'] = NOW();
                    $SaveData['updated_by'] = session('WcmsEmpNo');
                    $SaveEmployment= $this->MaterialUnit->updateMaterialUnit($SaveData,$MaterialId);
                }else{
                    $SaveData['created_at'] = NOW();
                    $SaveData['created_by'] = session('WcmsEmpNo');
                    $SaveEmployment= $this->MaterialUnit->createMaterialUnit($SaveData);
                }
              //dd($SaveEmployment);
                DB::commit();
                $message = "Unit Data Saved ";
            }catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('material-unit-master.material-unit-master');
        }
         $EditMaterialUnitData=NULL;
        if(isset($request->id)){ 
            try {
              
                $EditId = decrypt($request->id); 
                //dd($EditId); 
                      
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $data = "Error : Sorry Invalid Attempt";
                return redirect()->back();
            }
            $EditMaterialUnitData=$this->MaterialUnit->ShowMaterialUnit($EditId); 
            //dd($EditMaterialUnitData);
           // return view('designation-master.designation-master')->with('data', compact('EmployeeData'));
        }
        $MaterialUnitData=$this->MaterialUnit->ShowMaterialUnit(null);
        return view('material-unit-master.material-unit-master')->with('data', compact('MaterialUnitData','EditMaterialUnitData'));//->with('data', compact('OrganizationList'));
    }
}
