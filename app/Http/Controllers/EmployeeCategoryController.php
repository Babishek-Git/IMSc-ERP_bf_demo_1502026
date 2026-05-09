<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\EmployeeCategory;

use Helper;
use DB;
use Session;
class EmployeeCategoryController extends Controller
{

    public function __construct(){
         $this->employeecategory  = new EmployeeCategory();
    }
    public function EmployeeCategory(Request $request)
    {
       if(isset($request->btn_save))
        {
            $CategoryCode = $request->txt_cate_code;
            $CategoryName= $request->txt_cate_name;
            $CategoryId = $request->hid_cate_id;
            $rules = [
				'CategoryCode' => 'required|max:10',
				'CategoryName' => 'required|max:25',
                
			];
			$ValidateData = [
                'CategoryCode' =>$CategoryCode,
				'CategoryName' =>$CategoryName,
                				
			];
            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($CategoryCode == "CategoryCode"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Category Code.";
                    }
                    if($CategoryName == "CategoryName"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid Category Name.";
                    }
                    
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('EmployeeCategory.EmployeeCategory');
            }
            DB::beginTransaction();
            try {
                $SaveData['emp_category_code'] =  $CategoryCode;
                $SaveData['emp_category'] =   $CategoryName;
                $SaveData['active'] = 1;
                if($CategoryId != NULL){ 
                    $SaveData['updated_at'] = NOW();
                    $SaveData['updated_by'] = session('WcmsEmpNo');
                    $SaveGroup= $this->employeecategory->updateEmployeeCategory($SaveData,$CategoryId);
                }
                else{
                    $SaveData['created_at'] = NOW();
                    $SaveData['created_by'] = session('WcmsEmpNo');
                    $SaveEmployee= $this->employeecategory->createEmployeeCategory($SaveData);
                }
                DB::commit();
                $message = "Employee Category Type Data Saved Successfully";
            }catch (\Exception $e) {
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('EmployeeCategory.EmployeeCategory');
        }
        $EditCategoryData=NULL;
        if(isset($request->id)){ 
            try {
              
                $EditId = decrypt($request->id); 
                      
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $data = "Error : Sorry Invalid Attempt";
                return redirect()->back();
            }
            $EditCategoryData=$this->employeecategory->ShowEmployeeCategory($EditId); 
            //return view('employee-category.employee-category')->with('data', compact('EmployeeData'));
        }
      
       $EmployeecateData=$this->employeecategory->ShowEmployeeCategory(NULL);
        return view('employee-category.employee-category')->with('data', compact('EmployeecateData','EditCategoryData'));
    }
}
