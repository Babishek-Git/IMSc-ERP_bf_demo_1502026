<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class work_flow_modules extends Model
{
    use HasFactory;
	protected $table = 'erp_work_flow_modules';
    public $timestamps = false;
    protected $primaryKey = 'wf_moduleid';
    protected $fillable = [
        'wf_module_code',
        'wf_module_name',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'division_code',
        'wf_module_group_code'
    ];
    public function ShowWorkFlowModules($request,$WfModuleCode){
        /* if($WfModuleCode != NULL){
            return work_flow_modules::where('wf_module_code',$WfModuleCode)->orderBy('wf_module_name','asc')->get();
        }else{
            return work_flow_modules::orderBy('wf_module_name','asc')->get();
        }*/

        $RoleData = DB::table('erp_work_flow_modules')
            ->select('erp_work_flow_modules.*', 'erp_office.*','erp_work_flow_modules.active as wfmactive') 
            ->leftjoin('erp_office', 'erp_work_flow_modules.division_code', '=', 'erp_office.office_id');
            if($WfModuleCode != NULL){
                $RoleData->where('erp_work_flow_modules.wf_module_code', '=', $WfModuleCode);
            } 
            //$RoleData->where('erp_work_flow_modules.division_code', '=', session('WcmsEmpDiv'));
        $RoleData = $RoleData->get();
          
        return $RoleData;
    }
    public function CreateWorkFlowModules($request, $WorkFlowArr){
        return work_flow_modules::create($WorkFlowArr);
    }


    public function ShowWorkFlowModulesByModuleId($wf_moduleid){
        if($wf_moduleid != NULL){
            $WorkFlowData = work_flow_modules::where('wf_moduleid', $wf_moduleid)->orderby('wf_moduleid','ASC')->get();
        }else{
            $WorkFlowData = work_flow_modules::orderby('wf_moduleid','ASC')->get();
        }
        return $WorkFlowData;        
    }

    public function UpdateWorkFlowModules($WorkFlowArr, $wf_moduleid){
        return work_flow_modules::where('wf_moduleid', $wf_moduleid)->update($WorkFlowArr);
    }
    public function CheckWorkFlowModules($WorkFlowArr){
        return work_flow_modules::select('wf_module_name')
            // ->where('division_code',$WorkFlowArr['division_code'])
            ->where(function ($query) use ($WorkFlowArr) {
                $query->whereRaw("REGEXP_REPLACE(REGEXP_REPLACE(wf_module_name, '[^a-zA-Z0-9]+', '', 'g'), ' ', '', 'g') ILIKE ?", [$WorkFlowArr['wf_module_name']])
                    ->orWhereRaw("REGEXP_REPLACE(REGEXP_REPLACE(wf_module_code, '[^a-zA-Z0-9]+', '', 'g'), ' ', '', 'g') ILIKE ?", [$WorkFlowArr['wf_module_code']]);
            })
            ->get();
    }
    public function CheckWorkFlowModulesUpdate($WorkFlowArr, $HidWfmId) {
        return work_flow_modules::select('wf_module_name')
            ->where('wf_moduleid', '!=', $HidWfmId)
            // ->where('division_code', $WorkFlowArr['division_code'])
            ->where(function ($query) use ($WorkFlowArr) {
                $query->whereRaw("REGEXP_REPLACE(REGEXP_REPLACE(wf_module_name, '[^a-zA-Z0-9]+', '', 'g'), ' ', '', 'g') ILIKE ?", [$WorkFlowArr['wf_module_name']])
                    ->orWhereRaw("REGEXP_REPLACE(REGEXP_REPLACE(wf_module_code, '[^a-zA-Z0-9]+', '', 'g'), ' ', '', 'g') ILIKE ?", [$WorkFlowArr['wf_module_code']]);
            })
            ->get();
    }
    public function ShowAllWorkFlowModules($request,$WfModuleCode){
        $RoleData = DB::table('erp_work_flow_modules')
            ->select('erp_work_flow_modules.*', 'erp_office.*','erp_work_flow_modules.active as wfmactive') 
            ->leftjoin('erp_office', 'erp_work_flow_modules.division_code', '=', 'erp_office.office_id');
            if($WfModuleCode != NULL){
                $RoleData->where('erp_work_flow_modules.wf_module_code', '=', $WfModuleCode);
            } 
        $RoleData = $RoleData->orderby('erp_work_flow_modules.wf_moduleid','ASC')->get(); 
        return $RoleData;
    }
    public function ShowMultipleWorkFlowModulesByModuleCode($ModuleCodeArr){
        return work_flow_modules::whereIn('wf_module_code', $ModuleCodeArr)->orderby('wf_moduleid','ASC')->get();  
    }
}
