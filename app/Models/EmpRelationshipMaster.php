<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpRelationshipMaster extends Model
{
    use HasFactory;
    protected $table = 'erp_relationship_master';
    public $timestamps = false; 
    protected $primaryKey = 'relationship_id';
    public $incrementing = false;   
    protected $keyType = 'string'; 
    protected $fillable = [
        'relationship_name',
        'relationship_code',
        'dependant_id',
        'active'
        // 'created_at',
        // 'created_by',
        // 'updated_at',
        // 'updated_by'
    ];
    public function ShowRelatonshipByDependent($Dependant)
    {
        return EmpRelationshipMaster::where('dependant_id',$Dependant)->get(); 
    }
    public function ShowRelatonship($ReleationShipId)
    {
        if($ReleationShipId != NULL){
            return EmpRelationshipMaster::where('relationship_id',$ReleationShipId)->get(); 
        }else{
            return EmpRelationshipMaster::where('active',1)->get(); 
        }
    }
    

   public function ShowEmployeeRelatonshipCode($EmpGen)
    {
        if ($EmpGen == "M"){
            $EmpGenderCode = "WIF";
        }else if($EmpGen == "F"){
            $EmpGenderCode = "HUS";
        }else{
            $EmpGenderCode = Null;
        }
        $RelationIdData = EmpRelationshipMaster::where('relationship_code', $EmpGenderCode)->value('relationship_id');
        // $RelationIdData = EmpRelationshipMaster::where('relationship_code',$EmpGenderCode)->value('relationship_id')->get(); 
       /*  $RelationId = EmpRelationshipMaster::where('relationship_code', $EmpGender)
    ->value('relationship_id'); */

        return $RelationIdData;
    }

}
