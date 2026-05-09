<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenceFeeWaterCharge extends Model
{
    use HasFactory;
    protected $table = 'erp_license_water_tariff';
    public $timestamps = false;
    protected $primaryKey = 'tariff_id';
    protected $fillable = [
        'house_type_id',
        'licence_fee',
        'licence_fee_wef',
        'water_charge',
        'water_charge_wef',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public function ShowLicenceFeeWaterCharge()
    {
         $FeesData = LicenceFeeWaterCharge::get();
        return $FeesData;        
    }
    public function createLicenceFeeWaterCharge($EmployeeArr){
        return LicenceFeeWaterCharge::create($EmployeeArr);
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
