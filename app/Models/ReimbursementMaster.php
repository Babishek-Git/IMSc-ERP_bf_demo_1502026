<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReimbursementMaster extends Model
{
    use HasFactory;
    protected $table = 'erp_reimbursement_master';
    public $timestamps = false;
    protected $primaryKey = 'reimbursement_id';
    protected $fillable = [
        'emp_no',
        'reimbursement_type_id',
        'reimbursement_type_code',
        'claim_date',
        'total_claimed_amount',
        'total_approved_amount',
        'status',
        'remarks',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public function ShowEmployeesReimbursementMaster($request,$EmpNo)
    {
     return self::from('erp_ta_reimbursement_dt as t')
                ->join('erp_reimbursement_master as r1','r1.reimbursement_id','=','t.reimbursement_id')
                ->leftJoin('erp_employee as e','e.emp_no','=','r1.emp_no')
                ->leftJoin('erp_emp_designation as d','d.designation_id','=','e.emp_designation_id')
                ->where('reimbursement_type_code','TA')->where('r1.emp_no',$EmpNo)
                ->select('t.*','r1.*','e.*','d.*')
                ->get();  
    }
    public function createReimbursementMaster($EmployeeArr){
        return ReimbursementMaster::create($EmployeeArr);
    }
   /*  public function updateEmploymentType($StateArr,$StateId){
        return EmploymentType::where('state_id', $StateId)->Update($StateArr);
    } */
    public function ShowReimbursementMasterCEA($request,$EmpNo,$ModuleCode)
    {
     return self::leftJoin('erp_employee as e','e.emp_no','=','erp_reimbursement_master.emp_no')
                ->where('erp_reimbursement_master.emp_no',$EmpNo)
                ->where('reimbursement_type_code',$ModuleCode)
                ->select('erp_reimbursement_master.*','e.*')
                ->get();  
    }
    
    /*public function CheckDesign($AAIISDesign){
        if($AAIISDesign != NULL){
            return designation::select('designation_name')->where('designation_name',$AAIISDesign)->get();
        }else{
            return designation::select('designation_name')->get();
        }
    }*/
}
