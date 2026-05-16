<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseType extends Model
{
    use HasFactory;
    protected $table = 'erp_house_type';
    public $timestamps = false;
    protected $primaryKey = 'house_type_id';
    protected $fillable = [
        'house_type_code',
        'house_type_name',
        'eb_amount',
        'lf_amount',
        'wc_amount',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public function ShowHouseType()
    {
         $HouseTypeData = HouseType::get();
        return $HouseTypeData;        
    }
    public function createHouseTypeMaster($EmployeeArr){
        return HouseType::create($EmployeeArr);
    }
    
 
    
    /*public function CheckDesign($AAIISDesign){
        if($AAIISDesign != NULL){
            return designation::select('designation_name')->where('designation_name',$AAIISDesign)->get();
        }else{
            return designation::select('designation_name')->get();
        }
    }*/
}
