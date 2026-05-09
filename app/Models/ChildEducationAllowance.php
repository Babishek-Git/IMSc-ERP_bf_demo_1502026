<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildEducationAllowance extends Model
{
    use HasFactory;
    protected $table = 'erp_cea_rate_master';
    public $timestamps = false;
    protected $primaryKey = 'cea_rate_id';
    protected $fillable = [
        'cea_rate',
        'cea_rate_mode',
        'cea_rate_unit',
        'is_current',
        'active',
        'created_by',
        'created_at',
        'updated_bt',
        'updated_at',
        'with_effect_from'
    ];
    // public function ShowDesignationMaster($DesgId)
    // {
    //     if($DesgId != NULL){
    //          $DesignationData = DesignationMaster::where ('designation_id',$DesgId)->get();
    //     }
    //     else{
    //         $DesignationData = DesignationMaster::orderBy('designation_id', 'asc')->get();
    //     }
    //     return $DesignationData; 
             
    // }
     public function ShowChildEducationAllowance($MaterialId){
         if($MaterialId != NULL){
            $MaterialData = ChildEducationAllowance::where('cea_rate_id', $MaterialId)->get();
        }else{
            $MaterialData = ChildEducationAllowance::orderBy('cea_rate_id', 'asc')->get();
        }
             return $MaterialData;
    }
    public function createChildEducationAllowance($EmployeeArr){
        return ChildEducationAllowance::create($EmployeeArr);
     }
      public function updateChildEducationAllowance($MaterialArr,$MaterialId){
        return ChildEducationAllowance::where('cea_rate_id', $MaterialId)->Update($MaterialArr);
    }
    // public function updateDesignationMaster($DescArr,$DesgId){
    //     return DesignationMaster::where('designation_id', $DesgId)->Update($DescArr);
    // }
    // public function ShowDesignationWithGroup($GroupId){
    //     if($GroupId != NULL){
    //         return DesignationMaster::join('erp_emp_group', 'erp_emp_group.emp_group_id', '=', 'erp_emp_designation.emp_group_id')->where('erp_emp_group.emp_group_id',$GroupId)->get();
    //     }else{
    //         return DesignationMaster::join('erp_emp_group', 'erp_emp_group.emp_group_id', '=', 'erp_emp_designation.emp_group_id')->get();
    //     }
    // }
    
    /*public function CheckDesign($AAIISDesign){
        if($AAIISDesign != NULL){
            return designation::select('designation_name')->where('designation_name',$AAIISDesign)->get();
        }else{
            return designation::select('designation_name')->get();
        }
    }*/
}
