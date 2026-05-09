<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\modules;
use App\Models\Role;
use App\Models\WorkFlow;
use App\Models\work_flow_modules;
use App\Models\AgmOffice;
use App\Services\WorkFlowProcessService;
use Helper;
use DB;
use Session;

class CommonWorkFlowController extends Controller
{
    protected WorkFlowProcessService $WorkFlowService;
    public function __construct(
         WorkFlowProcessService $WorkFlowService,
    ){
        $this->Office = new AgmOffice();
        $this->workflowmodules = new work_flow_modules();
        $this->WorkFlow = new WorkFlow();

        $this->WorkFlowService = $WorkFlowService;
    }
    public function GetWorkFlowEmployee(Request $request)
    {
        $data = NULL; $message = NULL;  
        
        $WorkFlowData = $request->WorkFlowData;
        if(($WorkFlowData != NULL)&&($WorkFlowData != "")){
            $WorkFlowData = json_decode($WorkFlowData);
        }else{
            $WorkFlowData = [];
        }
        $TransactionId      = $WorkFlowData->TransactionId ?? NULL;
        $WorkFlowModuleCode = $WorkFlowData->WflowModule ?? NULL;

        try {
            $TransactionId = decrypt($TransactionId);
            $WorkFlowModuleCode = decrypt($WorkFlowModuleCode);
        }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return NULL;
        }

        $RetEmpData = $this->WorkFlowService->GetEmployee(
            $TransactionId,
            $WorkFlowModuleCode,
            $WorkFlowData
        );
        //$RetArr = ['EmpData' => $EmpData, 'SelEmp' => NULL, 'RoleName' => NULL];
        return $RetEmpData;
    }
    
}
