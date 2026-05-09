<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class EmpFamilyDetails extends Model
{
    use HasFactory;
    protected $table = 'erp_emp_family_details';
    public $timestamps = false;
    protected $primaryKey = 'family_det_id';
    protected $fillable = [
        'emp_no',
        'fam_member_name',
        'fam_relationship_id',
        'fam_member_dob',
        'fam_member_income_source',
        'fam_income_amount',
        'fam_member_aadhar',
        'is_nominee',
        'nominee_effect_from',
        'fam_member_blood_group',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    
    public function ShowFamilyDetails($request,$EmpNo){
          $FamilyData = EmpFamilyDetails::leftjoin('erp_relationship_master','erp_relationship_master.relationship_id','=','erp_emp_family_details.fam_relationship_id')->leftjoin('erp_dependant_master','erp_dependant_master.dependant_id','=','erp_relationship_master.dependant_id')->where('erp_emp_family_details.emp_no',$EmpNo)->get();
        return $FamilyData;
    }
    public function ShowChildrens(){
        $RelationshipArr = ['SON','DAU'];
        $ChildrenData    = EmpFamilyDetails::join('erp_relationship_master','erp_relationship_master.relationship_id','=','erp_emp_family_details.fam_relationship_id')->whereIn('erp_relationship_master.relationship_code',$RelationshipArr)->where('erp_emp_family_details.active',1)->orderBy('erp_emp_family_details.fam_member_dob','ASC')->get();
        return $ChildrenData;
    }
    public function CreateFamilyDetails($EmpFamilyDetailsArr){
        return self::create($EmpFamilyDetailsArr);
    }
    public function DeleteEmpFamilyDetails($EmpNo){
        return self::where('emp_no',$EmpNo)->delete();
    }
    public function ShowFamilyDetailsByEmpNo($EmpNo){
        $FamilyData    = EmpFamilyDetails::join('erp_relationship_master','erp_relationship_master.relationship_id','=','erp_emp_family_details.fam_relationship_id')
        ->leftJoin('erp_dependant_master','erp_dependant_master.dependant_id','=','erp_relationship_master.dependant_id')->where('erp_emp_family_details.emp_no',$EmpNo)->where('erp_emp_family_details.active',1)->orderBy('erp_emp_family_details.fam_member_dob','ASC')->get();
        return $FamilyData;
    }
    public function ShowRelationship($relationshipcode){
        return DB::table('erp_relationship_master')->where('relationship_id', $relationshipcode)->value('relationship_name');
    }
}
