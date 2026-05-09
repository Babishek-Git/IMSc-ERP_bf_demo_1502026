<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class designation extends Model
{
    use HasFactory;
    protected $table = 'erp_designation';
    public $timestamps = false;
    protected $primaryKey = 'designationid';
    protected $fillable = [
        'designationid',
        'designation_name',
        'sectionid',
        'userlevel',
        'active',
        'userid'
    ];
    public function ShowDesiginationData($designationid){
        if($designationid != NULL){
            $DesiginationData = designation::where('designationid', $designationid)->orderby('designationid','ASC')->get();
        }else{
            $DesiginationData = designation::orderby('designationid','ASC')->get();
        }
        return $DesiginationData;        
    }
    public function CreateDesigination($request, $DesgArr){
        return designation::create($DesgArr);
    }
    public function CheckDesign($AAIISDesign){
        if($AAIISDesign != NULL){
            return designation::select('designation_name')->where('designation_name',$AAIISDesign)->get();
        }else{
            return designation::select('designation_name')->get();
        }
    }
}
