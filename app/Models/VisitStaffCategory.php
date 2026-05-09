<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitStaffCategory extends Model
{
    use HasFactory;
    protected $table = 'erp_visit_staff_category';
    public $timestamps = false;
    protected $primaryKey = 'visit_staff_id';
    protected $fillable = [
        'Visit_staff_category',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
    public function ShowVistStaffCategory(){
          return  self ::get();
    }
  /*   public function CreateState($StateArr){
        return self::create($StateArr);
    }
    public function UpdateState($StateArr,$StateId){
        return self::where('state_id', $StateId)->Update($StateArr);
    }
 */
    
    /*public function CheckDesign($AAIISDesign){
        if($AAIISDesign != NULL){
            return designation::select('designation_name')->where('designation_name',$AAIISDesign)->get();
        }else{
            return designation::select('designation_name')->get();
        }
    }*/
}
