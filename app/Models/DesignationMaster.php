<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignationMaster extends Model
{
    use HasFactory;
    protected $table = 'erp_emp_designation';
    public $timestamps = false;
    protected $primaryKey = 'designation_id';
    protected $fillable = [
        'designation_short_name',
        'designation_name',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'emp_group_id'
    ];
    public function ShowDesignationMaster($DesgId)
    {
        if($DesgId != NULL){
             $DesignationData = DesignationMaster::where ('designation_id',$DesgId)->get();
        }
        else{
            $DesignationData = DesignationMaster::orderBy('designation_id', 'asc')->get();
        }
        return $DesignationData; 
             
    }
    
    public function createDesignationMaster($EmployeeArr){
        return DesignationMaster::create($EmployeeArr);
    }
    public function updateDesignationMaster($DescArr,$DesgId){
        return DesignationMaster::where('designation_id', $DesgId)->Update($DescArr);
    }
    public function ShowDesignationWithGroup($GroupId){
        if($GroupId != NULL){
            return DesignationMaster::join('erp_emp_group', 'erp_emp_group.emp_group_id', '=', 'erp_emp_designation.emp_group_id')->where('erp_emp_group.emp_group_id',$GroupId)->get();
        }else{
            return DesignationMaster::join('erp_emp_group', 'erp_emp_group.emp_group_id', '=', 'erp_emp_designation.emp_group_id')->get();
        }
    }
    
    /*public function CheckDesign($AAIISDesign){
        if($AAIISDesign != NULL){
            return designation::select('designation_name')->where('designation_name',$AAIISDesign)->get();
        }else{
            return designation::select('designation_name')->get();
        }
    }*/
}
