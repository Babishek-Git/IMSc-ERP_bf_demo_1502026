<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeGroupMaster extends Model
{
    use HasFactory;
    protected $table = 'erp_emp_group';
    public $timestamps = false;
    protected $primaryKey = 'emp_group_id';
    public $incrementing = false;   
    protected $keyType = 'string'; 
    protected $fillable = [
        'emp_group_code',
        'emp_group_name',
        'emp_type_code',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'employment_type_code',
        'portal_access',
        'is_project_applicable',
        'dp_order'
    
    ];
    public function ShowEmployeeGroup($GrpId)
    {
        if($GrpId != NULL){
            $GroupData = EmployeeGroupMaster::where('emp_group_id',$GrpId)->where('active',1)->where('parent_group_id',0)->get();
        }else{
            $GroupData = EmployeeGroupMaster::where('active',1)->where('parent_group_id',0)->orderBy('dp_order', 'asc')->get();
        }
        return $GroupData;        
    }
    public function ShowGroupByType($EmpTypeCode){
        $GroupData = EmployeeGroupMaster::where('emp_type_code',$EmpTypeCode)->get();
        return  $GroupData;        
    }
    
    public function createEmployeeGroup($EmployeeArr){
        return EmployeeGroupMaster::create($EmployeeArr);
    }
 
    public function updateEmployeeGroup($GroupArr,$GroupCode){
        return EmployeeGroupMaster::where('emp_group_id', $GroupCode)->Update($GroupArr);
    } 
    public function ShowEmployeeGroupMaster($GrpId)
    {
        $GroupData = EmployeeGroupMaster::where('employment_type_code','P',$GrpId)->get();
        return $GroupData;        
    }
   
    /*public function CheckDesign($AAIISDesign){
        if($AAIISDesign != NULL){
            return designation::select('designation_name')->where('designation_name',$AAIISDesign)->get();
        }else{
            return designation::select('designation_name')->get();
        }
    }*/
    public function ShowEmployeeGroupByGrpIdArr($GrpIdArr)
    {
        $GroupData = EmployeeGroupMaster::whereIn('emp_group_id',$GrpIdArr)->get();
        return $GroupData;        
    }
    public function ShowEmployeeGroupForAllowance($GrpId)
    {
        if($GrpId != NULL){
            $GroupData = EmployeeGroupMaster::where('emp_group_id',$GrpId)->where('active',1)->where('parent_group_id',0)->get();
        }else{
            $GroupData = EmployeeGroupMaster::where('active',1)->where('parent_group_id',0)->where('emp_type_code','ST')->orderBy('dp_order', 'asc')->get();
        }
        return $GroupData;        
    }
    public static function ShowIsProjApplicable($request){
        return EmployeeGroupMaster::where('active',1)->where('is_project_applicable', true)->get();
    }
}
