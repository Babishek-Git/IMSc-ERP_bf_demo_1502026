<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialUnit extends Model
{
    use HasFactory;
    protected $table = 'erp_material_unit';
    public $timestamps = false;
    protected $primaryKey = 'uom_id';
    protected $fillable = [
        'uom_code',
        'uom_name',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
    public function ShowMaterialUnit($MaterialId){
         if($MaterialId != NULL){
            $MaterialData = MaterialUnit::where('uom_id', $MaterialId)->get();
        }else{
            $MaterialData = MaterialUnit::orderBy('uom_id', 'asc')->get();
        }
             return $MaterialData;
    }
    public function createMaterialUnit($EmployeeArr){
        return MaterialUnit::create($EmployeeArr);
     }
    public function updateMaterialUnit($MaterialArr,$MaterialId){
        return MaterialUnit::where('uom_id', $MaterialId)->Update($MaterialArr);
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
