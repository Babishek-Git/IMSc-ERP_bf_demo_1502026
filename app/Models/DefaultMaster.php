<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultMaster extends Model
{
    use HasFactory;
    protected $table = 'erp_default_master';
    public $timestamps = false;
    protected $primaryKey = 'def_mast_code';
    public $incrementing = false;   
    protected $keyType = 'string'; 
    protected $fillable = [
        'def_mast_code',
        'def_mast_name',
        'active'
    ];
    public function ShowDefaultMaster(){
        $DefaultData = DefaultMaster::get();
        return $DefaultData;  
     }
            
    public function CreateDefaultMaster($DefaultArr){
        return DefaultMaster::create($DefaultArr);
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