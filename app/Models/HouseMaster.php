<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseMaster extends Model
{
    use HasFactory;
    protected $table = 'erp_house_master';
    public $timestamps = false;
    protected $primaryKey = 'house_id';
    protected $fillable = [
        'house_code',
        'house_address',
        'house_type_id',
        'house_status',
        'emp_no',
        'occupied_on',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'alloted_on',
        'vacated_on',
        'is-hostel',
        'charge_month'
    ];
    public function ShowHouseMaster($request,$EmpNo)
    {
         $EmpQuery = HouseMaster::leftjoin('erp_house_type','erp_house_type.house_type_id','=','erp_house_master.house_type_id')
                                    ->leftjoin('erp_employee','erp_employee.emp_no','=','erp_house_master.emp_no')
                                    ->select('erp_house_master.*','erp_house_type.*','erp_employee.*')
                                    ->orderBy('erp_house_master.house_id', 'asc');
        if($EmpNo != NULL){
            $EmpQuery->where('erp_house_master.emp_no',$EmpNo);
        }
        $EmpData = $EmpQuery->get(); 
        return $EmpData;
    }
    public function ShowHostelMaster(){
        return self::where('is-hostel','true')->get();
    }
    public function createHouseMaster($EmployeeArr){
        return HouseMaster::create($EmployeeArr);
    }
    public function updateHouseMaster($HouseArr,$HouseId){
        return HouseMaster::where('house_id', $HouseId)->Update($HouseArr);
    }
    public function ShowVacantHouse()
    {
        return self::whereNull('occupied_on')->whereNull('emp_no')->where('active',1)->get();
    }
    public function updateOccupation($HouseArr,$HouseId){
        return HouseMaster::where('house_id', $HouseId)->Update($HouseArr);
    }
    public function ShowHouseMasterrForAllocate()
    {
         $HouseData = HouseMaster::where('emp_no',null)->orderBy('house_id', 'asc')->get();
        return $HouseData; 
    }
    public function ShowHouseMasterForStayedEmp($EmpNoArr)
    {
         $EmpData = HouseMaster::join('erp_house_type','erp_house_type.house_type_id','=','erp_house_master.house_type_id')
                                ->join('erp_license_water_tariff','erp_house_type.house_type_id','=','erp_license_water_tariff.house_type_id')
                                ->whereIn('erp_house_master.emp_no',$EmpNoArr)
                                ->orderBy('erp_house_master.house_id', 'asc')->get();
        return $EmpData;
    }

}
