<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
//use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
//use Spatie\Permission\Models\Permission;
use App\Models\ItSlab;
use App\Models\Role;
use App\Models\RoleMapping;
use App\Models\AemEmployee;
use App\Models\modules;
use App\Models\AgmOffice;
use App\Models\role_group;
use App\Models\office_mapping;
use Helper;
use Exception;
use Session;
class IncomeTaxRateFixationController extends Controller
{
    protected $role;
    public function __construct(){
        $this->role       = new Role();
        $this->rolemapp   = new RoleMapping();
        $this->emp        = new AemEmployee();
        $this->Office     = new AgmOffice();
        $this->rolegroup  = new role_group();
        $this->officemapp = new office_mapping();
        $this->Itslab     = new ItSlab();
    }
    public function IncomeTaxRateFixation(Request $request){
         if(isset($request->btn_save)){ 
            //dd($request);
            $FinYear      = $request->input('cmb_fin_year');
            $Regime       = $request->input('rad_regime');
            $MinIncomeArr = $request->input('txt_min_income');
            $MaxIncomeArr = $request->input('txt_max_income');
            $TaxRateArr   = $request->input('txt_tax_rate');
            $ErrArr         = [];
             if(filled($MinIncomeArr)){
                DB::beginTransaction();
                try {
                    foreach($MinIncomeArr as $MinIncomeKey => $MinIncome){
                        $MaxIncome  = $MaxIncomeArr[$MinIncomeKey];
                        $TaxRate    = $TaxRateArr[$MinIncomeKey];
                        $SaveData   = [];
                    }
                    $SaveData['fin_year']   = $FinYear;
                    $SaveData['tax_regime'] = $Regime;
                    $SaveData['min_income'] = $MinIncome;
                    $SaveData['max_income'] = $MaxIncome;
                    $SaveData['tax_rate']   = $TaxRate;
                    $SaveData['active']     = 1;
                    $SaveData['created_at'] = NOW();
                    $SaveData['created_by'] = session('WcmsEmpNo'); //dd($SaveArr);
                    $SaveIncomeRate = $this->Itslab->CreateItSlab($SaveData); //dd($SaveEmployee);
                    
                    DB::commit();
                    $message = "Income Tax Rate Request Form Data Saved Successfully";
                    Session::put('ALertMesage', $message);
                }catch (\Exception $e) { dd($e);
                    DB::rollback();
                    $message = "Error : Sorry transaction not fully completed";
                    Session::put('ALertMesage', $message);
                }
            }
                
         }
        $AllFinancialYear = Helper::GetAllFinancialYear(NULL);
        return view('incometax.income-tax-rate-fixation')->with('data', compact('AllFinancialYear'));
    }
}