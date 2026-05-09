<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSalute extends Model
{
    use HasFactory;
    protected $table = 'erp_salute';
    public $timestamps = false;
    protected $primaryKey = 'salute_id';
    protected $fillable = [
        'salute_name',
        'active'
    ];
    public function ShowSalute($SaluteId)
    {
        if($SaluteId != NULL){
            return EmployeeSalute::where('salute_id',$SaluteId)->get();
        }else{
            return EmployeeSalute::orderBy('salute_id', 'asc')->get();
        }
    }
    public function CreateSalute($SaluteArr){
        return EmployeeSalute::create($SaluteArr);
    }
    public function UpdateSalute($SaluteArr,$SaluteId){
        return EmployeeSalute::where('salute_id', $SaluteId)->Update($SaluteArr);
    } 
}
