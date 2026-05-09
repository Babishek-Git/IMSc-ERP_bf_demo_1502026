<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;  

class Holiday extends Model
{
    
    protected $fillable = [
        'holiday_date', 'holiday_name', 'holiday_type', 'year',
        'active', 'created_at', 'created_by', 'updated_at', 'updated_by',
    ];

    protected $table = 'erp_holidays';
    public $timestamps = false;
    protected $primaryKey = 'holiday_id';

    public function ShowHolidaysByYear($Year){
        return self::where('year',$Year)->where('active',1)->get();
    }
    public function ShowHolidaysPeriod($StartDate,$EndDate){
         return self::whereBetween('holiday_date', [$StartDate, $EndDate])
               ->where('active', 1)
               ->get();
    }

}
