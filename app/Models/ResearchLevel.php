<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchLevel extends Model
{
    use HasFactory;
    protected $table = 'erp_emp_research_level';
    public $timestamps = false;
    protected $primaryKey = 'research_level_code';
    protected $fillable = [
        'research_level_code',
        'research_level_short_name',
        'research_level_name',
        'tenure',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public function ShowResearchLevelMaster()
    {
         $ResearchData = ResearchLevel::get();
        return $ResearchData;        
    }
    public function createResearchLevelMaster($EmployeeArr){
        return ResearchLevel::create($EmployeeArr);
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
