<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\MaterialType;
use Helper;
use DB;
use Session;
class MaterialtypeController extends Controller
{
    public function __construct(){
          $this->Materialtype  = new MaterialType();
    }
    public function Materialtype(Request $request) {
        if(isset($request->btn_save))
        {
           
            $MaterialCode = $request->txt_material_code;
            $MaterialType = $request->txt_material_type;
            $MaterialId   = $request->hid_material_id;
            
            $rules = [
				'MaterialCode' => 'required|max:5',
				'MaterialType' => 'required|max:25',
                
			];
			$ValidateData = [
                'MaterialCode' =>$MaterialCode,
				'MaterialType' => $MaterialType,
                				
			];
            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($MaterialCode == "MaterialCode"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Material Code.";
                    }
                    if($MaterialType == "MaterialType"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid Material Type.";
                    }
                    
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('material-type.material-type');
            }
            DB::beginTransaction();
            try {
               
                $SaveData['material_type_code'] = $MaterialCode;
                $SaveData['material_type_name'] = $MaterialType;
                $SaveData['active'] = 1;
                $SaveData['created_at'] = NOW();
                $SaveData['created_by'] = session('WcmsEmpNo');
                 if($MaterialId != NULL){ 
                    $SaveData['updated_at'] = NOW();
                    $SaveData['updated_by'] = session('WcmsEmpNo');
                    $SaveEmployment= $this->Materialtype->updateMaterialType($SaveData,$MaterialId);
                }else{
                    $SaveData['created_at'] = NOW();
                    $SaveData['created_by'] = session('WcmsEmpNo');
                    $SaveEmployment= $this->Materialtype->createMaterialType($SaveData);
                }
                
                //dd($SaveEmployment);
                DB::commit();
                $message = "Material Type  Data Saved ";
            }catch (\Exception $e) { dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('material-type.material-type');
        }
        $EditMaterialTypeData=NULL;
        if(isset($request->id)){ 
            try {
              
                $EditId = decrypt($request->id); 
                //dd($EditId); 
                      
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $data = "Error : Sorry Invalid Attempt";
                return redirect()->back();
            }
            $EditMaterialTypeData=$this->Materialtype->ShowMaterialType($EditId); 
            //dd($EditMaterialTypeData);
            //return view('designation-master.designation-master')->with('data', compact('EmployeeData'));
        }
       $MaterialtypeData=$this->Materialtype->ShowMaterialtype(null);
       //dd($MaterialtypeData);
        return view('material-type.material-type')->with('data', compact('MaterialtypeData','EditMaterialTypeData'));//->with('data', compact('OrganizationList'));
    }
}
