<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpDependantDetails extends Model
{
    use HasFactory;
    protected $table = 'erp_emp_family_details';
    public $timestamps = false;
    protected $primaryKey = 'relationship-code';
    public $incrementing = false;   
    protected $keyType = 'string'; 
    protected $fillable = [
        'relationship-code',
        'Name',
        'age',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    
    public function ShowEmployeeType()
    {
        $TestFamilyDetails = EmpDependantDetails::get();//modelname::get
        return $TestFamilyDetails;
    }
    public function CreateFamilyDetails($EmpDependantDetailsArr){
        return EmpDependantDetails::create($EmpDependantDetailsArr);//modelname::create
    }
}
