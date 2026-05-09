<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\VisitStaffCategory;

use Helper;
use DB;
use Session;
class VisitorsIdCardController extends Controller
{
    public function __construct(){
          $this->visitcategory  = new VisitStaffCategory();
    }
    public function VisitordIdCard(Request $request) {
         $VisitData = $this->visitcategory->ShowVistStaffCategory();
        return view('visting-id-card.visting-id-card')->with('data',compact('VisitData'));//->with('data', compact('OrganizationList'));
    }
}
