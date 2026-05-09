<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use Carbon\Carbon;
use Helper;
use DB;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(){
     
        $this->role = new Role();
    }
    public function index() 
    {   
        $Circular = NULL;$Rotator = NULL;
        if(session('WcmsRoleGroupCode') == "SUPUSER"){
            return view('dashboard.IndexUser')->with('data', compact('Circular','Rotator'));
            //return view('dashboard.IndexAdmin')->with('data', compact('Circular','Rotator'));
        }else if(session('WcmsRoleGroupCode') == "ADMUSER"){
            return view('dashboard.IndexAdmin')->with('data', compact('Circular','Rotator'));
        }else if(session('WcmsRoleGroupCode') == "ACCADMUSER"){
            return view('dashboard.IndexAdmin')->with('data', compact('Circular','Rotator'));
        }else if(session('WcmsRoleGroupCode') == "ACCUSER"){
            return view('dashboard.IndexAccUser')->with('data', compact('Circular','Rotator'));
        }else{ 
            return view('dashboard.IndexUser')->with('data', compact('Circular','Rotator'));
        }
        
    }
}
