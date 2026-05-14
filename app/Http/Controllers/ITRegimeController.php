<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\AemEmployee;
use App\Models\EmployeeGroupMaster;
use Helper;
use DB;
use Session;
class ITRegimeController extends Controller
{   
    public function __construct(){
        $this->Employee  = new AemEmployee();
        $this->EmployeeGroupMaster = new EmployeeGroupMaster();
    }
    public function TaxRegimeSelection(Request $request)
    {
        if(isset($request->btn_save_regime))
        {
            $FinancialYear  = $request->txt_float_finance_year;
            $SaveIcNoList   = $request->txt_float_icno; 
            $SaveRegimeList = $request->txt_float_tax_regime; 
            if(($SaveIcNoList != NULL)&&($SaveIcNoList != "")){
                $SaveIcNoList = json_decode($SaveIcNoList);
            }else{
                $SaveIcNoList = [];
            }
            if(($SaveRegimeList != NULL)&&($SaveRegimeList != "")){
                $SaveRegimeList = json_decode($SaveRegimeList);
            }else{
                $SaveRegimeList = [];
            }
            DB::beginTransaction();
            try {
                foreach($SaveIcNoList as $SaveIcNoKey => $SaveIcNo){ 
                    $SaveData['tax_regime']  = $SaveRegimeList[$SaveIcNoKey];
                    $SaveRegime = $this->Employee->UpdateEmployee($SaveData,$SaveIcNo);
                }
                DB::commit();
                $message = "Income Tax Regime Saved ";
            }catch (\Exception $e) { dd($e);
                DB::rollback(); 
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('incometax.tax-regime-selection');
        }
        if(isset($request->btn_initiate)){
            $EmpGroupIdArr  = $request->ch_emp_group; 
            $FinancialYear  = $request->cmb_fin_year; 
            $employeeGroupMaster = $this->EmployeeGroupMaster->ShowEmployeeGroupByGrpIdArr($EmpGroupIdArr);  
            $EmployeeList = $this->Employee->ShowMultipleEmployeesWithEmpGroup($EmpGroupIdArr); 
            return view('incometax.tax-regime.tax-regime-manual-entry', compact('EmployeeList','employeeGroupMaster','FinancialYear'));
        }
        $employeeGroupMaster= $this->EmployeeGroupMaster->ShowEmployeeGroup(NULL); 
        $AllFinancialYear = Helper::GetAllFinancialYear(NULL);
        return view('incometax.tax-regime.tax-regime-manual-entry-initiate')->with('data', compact('employeeGroupMaster','AllFinancialYear'));
    }
    public function ViewLocationMaster(Request $request)
    {
        $LocationData = $this->location->ShowLocationMaster();
        return view('location.ViewLocationMaster')->with('data', compact('LocationData'));
    }

}
