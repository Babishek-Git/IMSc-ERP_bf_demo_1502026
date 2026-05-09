<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Helper;
use DB;

class Unit extends Model
{
    use HasFactory;
    protected $table = 'erp_item_unit';
    public $timestamps = false;
    protected $primaryKey = 'unitid';
    protected $fillable = [
        'unit_name',
        'unit_fname',
        'meas_format',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'unit_code',
        'active',
        'is_non_decimal_unit'
    ];

    public function CreateUnit($request, $UnitArr){
        return Unit::create($UnitArr);
    }
    
    public function UpdateUnit($UnitArr, $UnitId){
        return Unit::where('unitid', $UnitId)->update($UnitArr);
    }
    public function CheckUnit($UnitArr){
        return Unit::select('unit_name','unit_fname')
            ->whereRaw("REGEXP_REPLACE(REGEXP_REPLACE(unit_name, '[^a-zA-Z0-9]+', '', 'g'), ' ', '', 'g') ILIKE ?", [$UnitArr['unit_name']])  
            ->orWhereRaw("REGEXP_REPLACE(REGEXP_REPLACE(unit_fname, '[^a-zA-Z0-9]+', '', 'g'), ' ', '', 'g') ILIKE ?", [$UnitArr['unit_fname']])  
            ->get();
    }
    public function ShowUnit($UnitId){
        if($UnitId != NULL){
            $UnitData = Unit::where('unitid', $UnitId)->orderby('unitid','ASC')->get();
        }else{
            $UnitData = Unit::orderby('unitid','ASC')->get();
        }
        return $UnitData;        
    }
    public function CheckUnitUpdate($UnitArr, $HidUnitId) {
        return Unit::select('unit_name','unit_fname')
            ->where('unitid', '!=', $HidUnitId)
            ->where(function ($query) use ($UnitArr) {
                $query->whereRaw("REGEXP_REPLACE(REGEXP_REPLACE(unit_name, '[^a-zA-Z0-9]+', '', 'g'), ' ', '', 'g') ILIKE ?", [$UnitArr['unit_name']])
                    ->orWhereRaw("REGEXP_REPLACE(REGEXP_REPLACE(unit_fname, '[^a-zA-Z0-9]+', '', 'g'), ' ', '', 'g') ILIKE ?", [$UnitArr['unit_fname']]);
            })
            ->get();
    }
}
