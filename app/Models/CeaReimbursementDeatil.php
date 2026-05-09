<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CeaReimbursementDeatil extends Model
{
    use HasFactory;
    protected $table = 'erp_cea_reimbursement_dt';
    public $timestamps = false;
    protected $primaryKey = 'cea_reimbursement_dt_id';
    protected $fillable = [
        'reimbursement_id',
        'family_det_id',
        'children_name',
        'academic_year',
        'cea_rate',
        'cea_rate_mode',
        'cea_amount',
        'hostel_distance',
        'is_diabled_child',
        'is_bonafide_cert',
        'is_bonafide_cert_hostel',
        'remarks',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public function ShowCeaReimbursementDetail($request,$ReimbursementId)
    {
         $CeaReimbursementData = self::join('erp_reimbursement_master as r1','r1.reimbursement_id','=','erp_cea_reimbursement_dt.reimbursement_id')
         ->where('erp_cea_reimbursement_dt.reimbursement_id',$ReimbursementId)->get();
        return $CeaReimbursementData;        
    }
    public function createCeaReimbursementDetail($EmployeeArr){
        return self::create($EmployeeArr);
    }
    public function UpdateCeaReimbursementDetail($CeaArr,$ReimbursementTypeId){
        return self::where('cea_reimbursement_dt_id', $ReimbursementTypeId)->Update($CeaArr);
    } 
 
    
    /*public function CheckDesign($AAIISDesign){
        if($AAIISDesign != NULL){
            return designation::select('designation_name')->where('designation_name',$AAIISDesign)->get();
        }else{
            return designation::select('designation_name')->get();
        }
    }*/
}
