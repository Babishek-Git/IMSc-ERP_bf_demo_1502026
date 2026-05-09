<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DependentMaster extends Model
{
    use HasFactory;
    protected $table = 'erp_dependant_master';
    public $timestamps = false; 
    protected $primaryKey = 'dependant_id';
    public $incrementing = false;   
    protected $keyType = 'string'; 
    protected $fillable = [
        'dependant_name',
        'dependant_code',
        'active'
    ];
    public function ShowDependent($Dependant)
    {
        if($Dependant != NULL){
            return self::where('dependant_id',$Dependant)->get(); 
        }else{
            return self::where('active',1)->get(); 
        }
    }
}
