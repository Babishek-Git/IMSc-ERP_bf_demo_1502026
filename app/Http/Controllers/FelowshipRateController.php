<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\RcItemGroup;
use App\Models\Ledger;
use App\Models\FellowshipCategoryName;
use App\Models\FellowshipRate;
use Session;
use Helper;
use DB;

class FelowshipRateController extends Controller
{
    public function __construct(){
        $this->FellowshipCategory = new FellowshipCategoryName();
        $this->FellowshipRate     = new FellowshipRate();
    }
    public function FelowshipRate(Request $request){
        $FellowshipRate = $this->FellowshipRate->ShowFellowshipRate();
        return view('fellowship-rate.fellowship-rate')->with('data',compact('FellowshipRate'));;
    }
  
}
