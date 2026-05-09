<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeMaritalStatus extends Model
{
    use HasFactory;
    protected $table = 'emp_marital_status';
    public $timestamps = false;
    protected $primaryKey = 'mar_status_code';
    public $incrementing = false;   
    protected $keyType = 'string'; 
    protected $fillable = [
        'mar_status_code',
        'mar_status',
        'active'
    ];
    public function ShowMaritalStatus($MarStatusCode)
    {
        if($MarStatusCode != NULL){
            return EmployeeMaritalStatus::where('mar_status_code',$MarStatusCode)->get();
        }else{
            return EmployeeMaritalStatus::orderBy('mar_status_code', 'asc')->get();
        }
    }
    public function CreateEmployeeMaritalSatus($MarStatusArr){
        return EmployeeMaritalStatus::create($MarStatusArr);
    }
    public function UpdateEmployeeMaritalSatus($MarStatusArr,$MarStatusCode){
        return EmployeeMaritalStatus::where('mar_status_code', $MarStatusCode)->Update($MarStatusArr);
    } 
}
