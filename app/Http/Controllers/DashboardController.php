<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use App\Models\AemEmployee;
use App\Models\DashboardContent;
use Carbon\Carbon;
use Helper;
use DB;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(){
     
        $this->role = new Role();
        $this->Employee = new AemEmployee(); //Added by Jemi
        $this->DashboardContent = new DashboardContent();
    }
    public function index() 
    {   
        $DashboardContent = $this->DashboardContent->ShowDashboardContentBySessionRole();
        $DashboardContentData = $DashboardContent->groupBy('content_code'); 
        $EmpData = $this->Employee->ShowEmployeeBySessionEmpNo();//Added line
        $Circular = NULL;$Rotator = NULL; 
        if(session('WcmsRoleGroupCode') == "SUPUSER"){ 
            return view('dashboard.IndexUser')->with('data', compact('Circular','Rotator','EmpData','DashboardContentData'));
            //return view('dashboard.IndexAdmin')->with('data', compact('Circular','Rotator'));
        }else if(session('WcmsRoleGroupCode') == "ADMUSER"){ 
            //return view('dashboard.IndexAdmin')->with('data', compact('Circular','Rotator','DashboardContentData'));
            return view('dashboard.IndexUser')->with('data', compact('Circular','Rotator','EmpData','DashboardContentData'));
        }else if(session('WcmsRoleGroupCode') == "ACCADMUSER"){ 
            //return view('dashboard.IndexAdmin')->with('data', compact('Circular','Rotator','DashboardContentData'));
            return view('dashboard.IndexUser')->with('data', compact('Circular','Rotator','EmpData','DashboardContentData'));
        }else if(session('WcmsRoleGroupCode') == "ACCUSER"){ 
            //return view('dashboard.IndexAccUser')->with('data', compact('Circular','Rotator','DashboardContentData'));
            return view('dashboard.IndexUser')->with('data', compact('Circular','Rotator','EmpData','DashboardContentData'));
        }else{ 
            return view('dashboard.IndexUser')->with('data', compact('Circular','Rotator','EmpData','DashboardContentData'));
        }
        
    }
}
