<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWorkLoad extends Model
{
    use HasFactory;
	protected $table = 'erp_user_work_load';
    public $timestamps = false;
    protected $primaryKey = 'work_load_id';
    protected $fillable = [
        'wf_moduleid',
        'start_range',
        'end_range',
        'target_roles',
        'appr_auth',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'wf_module_code',
        'initiate_role',
        'division_code',
        'bill_type',
        'budget_type',
        'section_code',
        'sub_section_code'
    ];
    public static function GetModuleRole($request,$ModuleId,$Amount){ /// This funvtion is called in all submit form
        $ReturnData = NULL;
        if(($ModuleId != NULL)&&($ModuleId != '')){ 
            if($Amount != NULL){
                if(($Amount != NULL)&&($Amount != 0)){
                    $Amount = round($Amount);
                }
                $ReturnData = UserWorkLoad::where('wf_module_code',$ModuleId)->where('division_code',session('WcmsEmpDiv'))->where('initiate_role',session('WcmsEmpRoleId'))->where('active',1)->where('start_range','<=',$Amount)->where('end_range','>=',$Amount)->get();
            }else{
                $ReturnData = UserWorkLoad::where('wf_module_code',$ModuleId)->where('division_code',session('WcmsEmpDiv'))->where('initiate_role',session('WcmsEmpRoleId'))->where('active',1)->get();
            }
            $TempData1 = collect($ReturnData)->where('section_code',session('WcmsEmpSec'))->where('sub_section_code',session('WcmsEmpSubSec')); 
            $TempData2 = collect($ReturnData)->where('section_code',session('WcmsEmpSec'))->whereNull('sub_section_code'); 
            $TempData3 = collect($ReturnData)->whereNull('section_code')->whereNull('sub_section_code'); 
            if(filled($TempData1)){ 
                $ReturnData = $TempData1; 
            }else if(filled($TempData2)){ 
                $ReturnData = $TempData2; 
            }else if(filled($TempData3)){ 
                $ReturnData = $TempData3; 
            }else{
                $ReturnData = $ReturnData; 
            }
            //dd(session('EmpSecShName')." = ".session('EmpSubSecShName')." = ".session('WcmsEmpSec')." = ".session('WcmsEmpSubSec'));
        }else{
            $ReturnData = UserWorkLoad::where('active',1)->where('initiate_role',session('WcmsEmpRoleId'))->get();
        }
        return $ReturnData;
    }
    public static function GetModuleRoleData($request,$ModuleId,$Amount){
        if(($ModuleId != NULL)&&($ModuleId != '')){
            if($Amount != NULL){
                if(($Amount != NULL)&&($Amount != 0)){
                    $Amount = round($Amount);
                }
                return UserWorkLoad::where('wf_module_code',$ModuleId)->where('active',1)->where('start_range','<=',$Amount)->where('end_range','>=',$Amount)->get();
            }else{
                return UserWorkLoad::where('wf_module_code',$ModuleId)->where('active',1)->get();
            }
        }else{
            return UserWorkLoad::where('active',1)->get();
        }
    }
    public static function GetModuleRoleById($request,$ModuleId,$DivisionId){
        if(($ModuleId != NULL)&&($ModuleId != '')){
            return UserWorkLoad::where('wf_moduleid',$ModuleId)->where('division_code',$DivisionId)->where('active',1)->get();
        }else{
            return NULL;
        }
    }
    public static function SaveModuleRoles($SaveDataArr){
        $role = UserWorkLoad::create($SaveDataArr);
        return $role;
    }
    public static function UpdateModuleRoles($SaveDataArr,$ModTransId){
        $role = UserWorkLoad::where('work_load_id',$ModTransId)->update($SaveDataArr);
        return $role;
    }
    public static function DeleteModuleRoles($ModTransId){
        $role = UserWorkLoad::where('work_load_id',$ModTransId)->update([
            'active' => 0,
            'updated_by' => session('WcmsEmpNo'),
            'updated_at' => NOW()
        ]);
        return $role;
    }
    public static function GetModuleRoleForBillVerify($request,$ModuleId,$Amount,$InitRoleId,$BillType,$AccountSecId = NULL,$AccDivId = NULL){ 
        if(($ModuleId != NULL)&&($ModuleId != '')){ 
            if($Amount != NULL){
                if(($Amount != NULL)&&($Amount != 0)){
                    $Amount = round($Amount);
                }
                $ReturnData = UserWorkLoad::where('wf_module_code',$ModuleId)->where('initiate_role',$InitRoleId)->where('bill_type',$BillType)->where('active',1)->where('start_range','<=',$Amount)->where('end_range','>=',$Amount);
                if(isset($AccountSecId)){
                    $ReturnData = $ReturnData->where('section_code',$AccountSecId);
                }elseif(isset($AccDivId)){
                    $ReturnData = $ReturnData->where('division_code',$AccDivId);
                }
                $ReturnData = $ReturnData->get();
                return $ReturnData;
            }else{
                return UserWorkLoad::where('wf_module_code',$ModuleId)->where('initiate_role',$InitRoleId)->where('bill_type',$BillType)->where('active',1)->get();
            }
        }else{
            return UserWorkLoad::where('active',1)->where('initiate_role',$InitRoleId)->get();
        }
    }
    public static function GetModuleRoleBySectionId($request,$ModuleId,$DivisionId,$SectionId,$SubsectionId){
        if($SubsectionId != NULL){
            if(($ModuleId != NULL)&&($ModuleId != '')){
                return UserWorkLoad::where('wf_moduleid',$ModuleId)->where('division_code',$DivisionId)->where('section_code',$SectionId)->where('sub_section_code',$SubsectionId)->where('active',1)->get();
            }else{
                return NULL;
            }
        }else{
            if(($ModuleId != NULL)&&($ModuleId != '')){
                return UserWorkLoad::where('wf_moduleid',$ModuleId)->where('division_code',$DivisionId)->where('section_code',$SectionId)->where('sub_section_code',$SubsectionId)->where('active',1)->get();
            }else{
                return NULL;
            }
        }
    }  
    public static function ShowFlowByModTransId($request, $ModTransId){
        $DataArr = UserWorkLoad::where('work_load_id',$ModTransId)->where('active',1)->get();
        return $DataArr;
    }
}
