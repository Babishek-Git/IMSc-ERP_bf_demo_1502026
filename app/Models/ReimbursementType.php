<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReimbursementType extends Model
{
    use HasFactory;
    protected $table = 'erp_reimbursement_type';
    public $timestamps = false;
    protected $primaryKey = 'reimbursement_type_id';
    protected $fillable = [
        'reimbursement_type_code',
        'reimbursement_type_name',
        'active',
        'created_by',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public static function ShowReimbursementMasterByCode($ReimbursementTypeId){
        return self::where('reimbursement_type_code',$ReimbursementTypeId)->get();
    }
    public function createReimbursementMaster($EmployeeArr){
        return ReimbursementType::create($EmployeeArr);
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
