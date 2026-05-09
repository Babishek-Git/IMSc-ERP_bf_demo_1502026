<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\ResearchLevel;

use Helper;
use DB;
use Session;
class ResearchLevelController extends Controller
{
        public function __construct(){
         
            $this->research  = new ResearchLevel();
         }
        public function ResearchLevel(Request $request)
    {
        if(isset($request->btn_save))
        {
          // dd ($request);
            $ResearchLevelCode      = $request->txt_level_code;
            $ResearchShortName      = $request->txt_level_shortName;
            $ResearchName = $request->txt_level_Name;
            $ResearchTenure= $request->txt_tenure;
            // $ResearchLevelId
            $rules = [
				'ResearchLevelCode' => 'required|max:10',
				'ResearchShortName' => 'required|max:50',
                'ResearchName' => 'required|max:100',
				'ResearchTenure' => 'required|max:25',
                                
			];
			$ValidateData = [
                'ResearchLevelCode' =>$ResearchLevelCode,
				'ResearchShortName' =>$ResearchShortName,
                'ResearchName' =>$ResearchName,
				'ResearchTenure' => $ResearchTenure,
                				
			];
            $Validate = Validator::make($ValidateData, $rules); 
            $ErrArr = [];
            if($Validate->fails())
             {
                //$date = NULL;
                $ValidateFields = $Validate->failed();
                foreach ($ValidateFields as $ValidFieldName => $ValidRules) 
                {
                    if($ResearchLevelCode == "ResearchLevelCode"){
                        //$ItemNo = '';
                        $ErrArr[] = "Error : Invalid Research Level Code.";
                    }
                    if($ResearchShortName == "ResearchShortName"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid Research Short Name.";
                    }
                    if($ResearchName == "ResearchName"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid Research Name.";
                    }
                    if($ResearchTenure == "ResearchTenure"){
                        //$ItemDesc = '';
                        $ErrArr[] = "Error : Invalid Research Tenure.";
                    }
                    
                }
            }
            if(filled($ErrArr))
            {
                $ErrorStr = implode(",",$ErrArr);
                Session::put('ALertMesage', $ErrorStr);
                return redirect()->route('ResearchLevel.ResearchLevel');
            }
            DB::beginTransaction();
            try {
                $SaveData['research_level_code'] =   $ResearchLevelCode;
                $SaveData['research_level_short_name'] = $ResearchShortName;
                $SaveData['research_level_name'] = $ResearchName;
                $SaveData['tenure'] = $ResearchTenure;
                $SaveData['active'] = 1;
                $SaveData['created_at'] = NOW();
                $SaveData['created_by'] = session('WcmsEmpNo');
                // if $ResearchLevelId != NULL 
                    // $SaveData['updated_at'] = NOW();
                    // $SaveData['updated_by'] = session('WcmsEmpNo');
                    // $SaveReseachLevel= $this->research->UpdateResearchLevelMaster($SaveData);
                // }else{
                    $SaveReseachLevel= $this->research->createResearchLevelMaster($SaveData);
                // }
                DB::commit();
                $message = "Research Master Data Saved Successfully";
            }catch (\Exception $e) {
            //dd($e);
                DB::rollback();
                $message = "Error : Sorry transaction not fully completed";
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('ResearchLevel.ResearchLevel');
        }
      
         $ResearchData=$this->research->ShowResearchLevelMaster();
        //  dd($ResearchData);
        return view('research-level.research-level')->with('data', compact('ResearchData'));    } 
}

