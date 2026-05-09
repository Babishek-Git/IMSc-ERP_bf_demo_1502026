<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateMaster extends Model
{
    use HasFactory;
    protected $table = 'erp_state_master';
    public $timestamps = false;
    protected $primaryKey = 'state_id';
    protected $fillable = [
        'state_code',
        'state_name',
        'active'
    ];
    public function ShowStateList($StateId){
        if($StateId != NULL){
            $StateData = StateMaster::where('state_id',$StateId)->get();
        }else{
            $StateData = StateMaster::get();
        }
        return $StateData;        
    }
    public function CreateState($StateArr){
        return StateMaster::create($StateArr);
    }
    public function UpdateState($StateArr,$StateId){
        return StateMaster::where('state_id', $StateId)->Update($StateArr);
    }

    
    /*public function CheckDesign($AAIISDesign){
        if($AAIISDesign != NULL){
            return designation::select('designation_name')->where('designation_name',$AAIISDesign)->get();
        }else{
            return designation::select('designation_name')->get();
        }
    }*/
}
