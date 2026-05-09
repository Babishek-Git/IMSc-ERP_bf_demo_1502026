<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialType extends Model
{
    use HasFactory;
    protected $table = 'erp_material_type';
    public $timestamps = false;
    protected $primaryKey = 'material_type_id';
    protected $fillable = [
        'material_type_code',
        'material_type_name',
        'description',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'Applicable_to'
    ];
     public function ShowMaterialType($MaterialId){
        if($MaterialId != NULL){
            $MaterialData = MaterialType::where('material_type_id', $MaterialId)->get();
        }else{
            $MaterialData = MaterialType::orderBy('material_type_id', 'asc')->get();
        }
             return $MaterialData;
    }
    public function createMaterialType($EmployeeArr){
        return MaterialType::create($EmployeeArr);
     }
    public function updateMaterialType($MaterialArr,$MaterialId){
        return MaterialType::where('material_type_id', $MaterialId)->Update($MaterialArr);
    }
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
