<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkFlow extends Model
{
    use HasFactory;
	protected $table = 'erp_work_flow';
    public $timestamps = false;
    protected $primaryKey = 'work_flow_id';
    protected $fillable = [
        'wf_moduleid',
        'wf_module_code',
        'initiate_role',
        'start_range',
        'end_range',
        'target_roles',
        'appr_auth',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        
    ];
    public static function GetModuleRole($request,$ModuleId,$Amount){ /// This funvtion is called in all submit form
        $ReturnData = NULL;
        if(($ModuleId != NULL)&&($ModuleId != '')){ 
            $ReturnData = self::where('wf_module_code',$ModuleId)->where('active',1)->where('initiate_role',session('WcmsEmpRoleId'))->get();
        }else{
            $ReturnData = self::where('active',1)->where('initiate_role',session('WcmsEmpRoleId'))->get();
        }
        return $ReturnData;
    }
    public static function GetModuleRoleData($request,$ModuleId,$Amount){
        if(($ModuleId != NULL)&&($ModuleId != '')){
            return self::where('wf_module_code',$ModuleId)->where('active',1)->get();
        }else{
            return self::where('active',1)->get();
        }
    }
    public static function GetModuleRoleById($request,$ModuleId,$DivisionId){
        if(($ModuleId != NULL)&&($ModuleId != '')){
            return self::where('wf_moduleid',$ModuleId)->where('active',1)->get();
        }else{
            return NULL;
        }
    }
    public static function SaveModuleRoles($SaveDataArr){
        $role = self::create($SaveDataArr);
        return $role;
    }
    public static function UpdateModuleRoles($SaveDataArr,$WorkFlowId){
        $role = self::where('work_flow_id',$WorkFlowId)->update($SaveDataArr);
        return $role;
    }
    public static function DeleteModuleRoles($WorkFlowId){
        $role = self::where('work_flow_id',$WorkFlowId)->update([
            'active' => 0,
            'updated_by' => session('WcmsEmpNo'),
            'updated_at' => NOW()
        ]);
        return $role;
    }
    public static function ShowFlowByModTransId($request, $WorkFlowId){
        $DataArr = self::where('work_flow_id',$WorkFlowId)->where('active',1)->get();
        return $DataArr;
    }
    public static function ShowWorKFlowBYModuleCode($request,$ModuleCode){
        $RetModuleData = NULL;
        if(filled($ModuleCode)){
            $RetModuleData = self::where('wf_module_code',$ModuleCode)->where('active',1)->get();
        }
        return $RetModuleData;
    }
    public static function ShowWorkFlow(){
        return self::leftjoin('erp_work_flow_modules', 'erp_work_flow.wf_moduleid', '=', 'erp_work_flow_modules.wf_moduleid')->where('erp_work_flow.active',1)->get();
    }
    public static function DeactivateWrkFlow ($ModuleId, $InitRole){
        if(filled($ModuleId) && filled($InitRole)){
            return self::where('wf_moduleid',$ModuleId)->where('initiate_role',$InitRole) ->update(['active' => 0]);
        }
    }
}
