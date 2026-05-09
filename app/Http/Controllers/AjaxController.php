<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\RoleMapping;

use DB;
use Helper;
use PartRateHelper;
use Illuminate\Support\Facades\Auth;


class AjaxController extends Controller
{
    //
    protected $role, $emp;
    public function __construct(){
        $this->role  = new Role();
        $this->RoleMapping = new RoleMapping();
    }

    public function FindActiveEmployeeByRole(Request $request) { //Created On 27/07/2024 WF
        try {
            $GlobID = decrypt($request->GlobId);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $data = "Error: Sorry, Invalid Attempt";
            return view('error.PayLoadError')->with('data', $data);
        }
        $Workstage      = $request->Stage;
        $RoleName       = $request->input('RoleName');
        $Role           = Role::where('role_name', $RoleName)->first();
        $RoleId         = $Role->roleid;
        $WorksData      = works::where('globid', $GlobID)->get();
        if($Workstage == 'BILLV'){
            $DivisionCode = 66;
        }else{
            $DivisionCode = $WorksData->pluck("division_code")->first();
        }        
        $RoleData       = $this->RoleMapping->ShowActiveEmpDetails($RoleId,$DivisionCode);
        return $RoleData;
    }
}