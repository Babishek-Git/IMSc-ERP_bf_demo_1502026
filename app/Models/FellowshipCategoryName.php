<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FellowshipCategoryName extends Model
{
    use HasFactory;
    protected $table = 'erp_fellowship_category';
    public $timestamps = false;
    protected $primaryKey = 'fellowship_category_id';
    public $incrementing = false;   
    protected $keyType = 'string'; 
    protected $fillable = [
        'fellowship_category_name',
        'fellowship_category_code',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'period_of_year',
        'period_for',
        'description',
        'group_id',
        'fellowship_amount'
    ];
    public function ShowFellowshipCategory(){
       return self::get();
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