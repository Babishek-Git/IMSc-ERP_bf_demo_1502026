<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentType extends Model
{
    use HasFactory;
    protected $table = 'erp_employment_type';
    public $timestamps = false;
    protected $primaryKey = 'employment_type_code';
     public $incrementing = false;   
    protected $keyType = 'string'; 
    protected $fillable = [
        'employment_type_code',
        'employment_type',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public function ShowEmploymentType(){
            $EmploymentData = EmploymentType::get();
                return $EmploymentData;        
    }
    public function createEmploymentType($EmployArr){
        return EmploymentType::create($EmployArr);
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
