<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpFamilyMaster extends Model
{
    use HasFactory;
    protected $table = 'emp_family_master';
    public $timestamps = false; 
    protected $primaryKey = 'emp_dependant_id';
    public $incrementing = false;   
    protected $keyType = 'string'; 
    protected $fillable = [
        'emp_dependant_id',
        'emp_dependant_name',
        'emp_depend_relationship',
        // 'active',
        // 'created_at',
        // 'created_by',
        // 'updated_at',
        // 'updated_by'
    ];
    public function ShowRelationName()
    {
        $RelationNameData = EmpFamilyMaster::select('emp_dependant_name')->distinct()->orderBy('emp_dependant_name')->get(); 
        return $RelationNameData;
    }
    public function ShowEmpFamilyMaster()
    {
        $EmpFamilyMaster = EmpFamilyMaster::get();//modelname::get
        return $EmpFamilyMaster;
    }
}
