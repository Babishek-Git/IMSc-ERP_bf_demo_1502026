<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaReimbursementDeatil extends Model
{
    use HasFactory;
    protected $table = 'erp_ta_reimbursement_dt';
    public $timestamps = false;
    protected $primaryKey = 'ta_reimbursement_dt_id';
    protected $fillable = [
        'reimbursement_id',
        'visit_purpose',
        'visit_institute_name',
        'depart_date_from_imsc',
        'arrive_date_visit_place',
        'depart_date_visit_place',
        'travel_mode',
        'travel_fare',
        'reimbursement_status',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
     public function ShowTaReimbursementDetail($ReimbursementId){
        if($ReimbursementId!= NULL){
            $claimData = self :: where('ta_reimbursement_dt_id',$ReimbursementId)->get();
        }
        else{
            $claimData = self :: get();
        }
        return $claimData;    
    } 
    public function createTaReimbursementDetail($EmployeeArr){
        return self::create($EmployeeArr);
    }
    public function updateReimbursemetDetail($TAArr,$ReimbursementdtId){
        return self::where('ta_reimbursement_dt_id', $ReimbursementdtId)->Update($TAArr);
    } 
    /*public function CheckDesign($AAIISDesign){
        if($AAIISDesign != NULL){
            return designation::select('designation_name')->where('designation_name',$AAIISDesign)->get();
        }else{
            return designation::select('designation_name')->get();
        }
    }*/
}
