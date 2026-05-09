<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllowanceAdvanceMaster extends Model
{
    use HasFactory;
    protected $table = 'erp_pay_component';
    public $timestamps = false;
    protected $primaryKey = 'component_id';
    protected $fillable = [
        'component_code',
        'component_name',
        'component_type_id',
        'is_taxable',
        'is_percentage',
        'with_effect_from',
        'component_name_on_payslip',
        'dp_order',
        'applicable_emp_group',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public function ShowAllowanceAdvanceMaster()
    {
        return self::join('erp_pay_component_type','erp_pay_component_type.component_type_id', '=', 'erp_pay_component.component_type_id')->get();
    }
    public function createAllowanceAdvanceMaster($EmployeeArr){
        return self::create($EmployeeArr);
    }
   /*  public function updateEmploymentType($StateArr,$StateId){
        return EmploymentType::where('state_id', $StateId)->Update($StateArr);
    } */
 
    
    /*public function CheckDesign($AAIISDesign){
        if($AAIISDesign != NULL){
            return designation::select('designation_name')->where('designation_name',$AAIISDesign)->get();
        }else{
            return designation::select('designation_name')->get();
        }
    }*/
}
