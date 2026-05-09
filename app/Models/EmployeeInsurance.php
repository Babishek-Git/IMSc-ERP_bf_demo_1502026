<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeInsurance extends Model
{
    use HasFactory;
    protected $table = 'erp_emp_insurance_details';
    public $timestamps = false;
    protected $primaryKey = 'ins_policy_det_id';//(Auto Increment)
    protected $fillable = [
        'emp_no',
        'insurance_type',// LIC/PLI   (combo box)
        'policy_holder_name',// Combo box (Emp name(emp_no), Dependant names(dependent_id))
        'policy_for',// (not displayed in UI - if policyholder's name is employees name then this will be "S" otherwise "D")
        'policy_no',  
        'premium_amount',
        'expiry_date', //
        'date_of_maturity',
        'active', // default 1
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public function ShowEmployeeInsurance($EmpNo)
    {
        $EmpInsuranceData = EmployeeInsurance::where('emp_no',$EmpNo)->get();
        return $EmpInsuranceData;  
    }
    public function CreateEmployeeInsurance($EmpInsuranceArr){
        return EmployeeInsurance::create($EmpInsuranceArr);
    }
    public function DeleteEmpInsuranceDetails($EmpNo,$PolicyFor){
        return self::where('emp_no',$EmpNo)->where('policy_for',$PolicyFor)->delete();
    }
    public function ShowMultipleEmployeeInsurance($EmpArr,$CheckDate)
    {
        $EmpInsuranceData = self::where('active',1)->whereIn('emp_no',$EmpArr)->where('expiry_date','>=',$CheckDate)->get();
        return $EmpInsuranceData;  
    }
 
}
