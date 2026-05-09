<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultMasterValue extends Model
{
    use HasFactory;
    protected $table = 'erp_default_master_value';
    public $timestamps = false;
    protected $primaryKey = 'def_mast_id';
    public $incrementing = false;   
    protected $keyType = 'string'; 
    protected $fillable = [
        'def_mast_code',
        'def_mast_mode',
        'def_mast_value',
        'with_effect_from',
        'active'
    ];
    public function ShowDefaultMasterValue()
    {
            $DefaultValueData = DefaultMasterValue::get();
            return $DefaultValueData;  
     }
            

    public function CreateDefaultMaster($DefaultArr){
        return DefaultMasterValue::create($DefaultArr);
    }
   /*  public function UpdateState($StateArr,$StateId){
        return StateMaster::where('state_id', $StateId)->Update($StateArr);
    } */
 
    
    /*public function CheckDesign($AAIISDesign){
        if($AAIISDesign != NULL){
            return designation::select('designation_name')->where('designation_name',$AAIISDesign)->get();
        }else{
            return designation::select('designation_name')->get();
        }
    }*/

}