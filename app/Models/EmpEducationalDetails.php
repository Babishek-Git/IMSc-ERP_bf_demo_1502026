<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpEducationalDetails extends Model
{
    use HasFactory;
    protected $table = 'erp_emp_educational_det';
    public $timestamps = false;
    protected $primaryKey = 'emp_education_id';
    protected $fillable = [
        'emp_no',
        'education_level',
        'qualification',
        'institute_name',
        'board_university',
        'year_passing',
        'study_mode',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    
    public function ShowEmployeeEducation($EmpNo)
    {
        return self::where('emp_no',$EmpNo)->get();
    }
    public function CreateEmpEducationDetails($EmpEduDetailsArr){
        return self::create($EmpEduDetailsArr);
    }
    public function DeleteEmpEducationDetails($EmpNo){
        return self::where('emp_no',$EmpNo)->delete();
    }
}
