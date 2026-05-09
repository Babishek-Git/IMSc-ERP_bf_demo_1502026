<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeCategory extends Model
{
    use HasFactory;
    protected $table = 'erp_emp_category';
    public $timestamps = false;
    protected $primaryKey = 'emp_category_code';
    public $incrementing = false;   
    protected $keyType = 'string'; 
    protected $fillable = [
        'emp_category_code',
        'emp_category',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'


    ];
    /* public function ShowEmployeeCategory(){
        $EmployeecateData = EmployeeCategory::get();
        return $EmployeecateData;        
    } */
    public function ShowEmployeeCategory($CategoryId)
    {
        if($CategoryId != NULL){
            $CategoryData = EmployeeCategory::where('emp_category_code',$CategoryId)->get();
        }else{
            $CategoryData = EmployeeCategory::orderBy('emp_category_code', 'asc')->get();
        }
            return $CategoryData;        
    }
    public function createEmployeeCategory($EmployArr){
        return EmployeeCategory::create($EmployArr);
    }
    public function updateEmployeeCategory($CategoryArr,$CategoryCode){
        return EmployeeCategory::where('emp_category_code', $CategoryCode)->Update($CategoryArr);
    }
}
