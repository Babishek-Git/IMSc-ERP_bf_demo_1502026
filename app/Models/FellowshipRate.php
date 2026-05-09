<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FellowshipRate extends Model
{
    use HasFactory;
    protected $table = 'erp_fellowship_rate';
    public $timestamps = false;
    protected $primaryKey = 'fellowship_rate_id';
    public $incrementing = false;   
    protected $keyType = 'string'; 
    protected $fillable = [
        'fellowship_rate',
        'with_effect_from',
        'is_current',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public function ShowFellowshipRate(){
       return self::join('erp_fellowship_category','erp_fellowship_category.fellowship_category_id','=','erp_fellowship_rate.fellowship_rate_id')->get();
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