<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeType extends Model
{
    use HasFactory;
    protected $table = 'erp_emp_type';
    public $timestamps = false;
    protected $primaryKey = 'emp_type_code';
    public $incrementing = false;   
    protected $keyType = 'string'; 
    protected $fillable = [
        'emp_type_code',
        'emp_type',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public function ShowEmployeeType($EmpCode)
    {
        if($EmpCode != NULL){
            $EmployeeData = EmployeeType::where('emp_type_code',$EmpCode)->get();
        }else{
            $EmployeeData = EmployeeType::orderBy('emp_type', 'asc')->get();
        }
        return $EmployeeData;        
    }
    
    public function createEmployeeType($EmployeeArr){
        return EmployeeType::create($EmployeeArr);
    }
    public function updateEmploymentType($EmpArr,$EmpCode){
        return EmployeeType::where('emp_type_code', $EmpCode)->Update($EmpArr);
    } 
 
    
    /*public function CheckDesign($AAIISDesign){
        if($AAIISDesign != NULL){
            return designation::select('designation_name')->where('designation_name',$AAIISDesign)->get();
        }else{
            return designation::select('designation_name')->get();
        }
    }*/
        public function ShowEmployeeTypeByCodeArr($TypeCodeArr)
    {
        return self::whereIn('emp_type_code',$TypeCodeArr)->get();
    }
}
