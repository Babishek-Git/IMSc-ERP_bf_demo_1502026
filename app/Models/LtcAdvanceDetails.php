<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LtcAdvanceDetails extends Model
{
    use HasFactory;
    protected $table = 'erp_emp_ltc_adv_details';
    public $timestamps = false;
    protected $primaryKey = 'ltc_detail_id';
    protected $fillable = [
        'emp_no',
        'departure_dt',
        'departure_time',
        'departure_from',
        'arraival_dt',
        'arraival_time',
        'arraival_from',
        'distance',
        'travel_mode',
        'accomod_used',
        'no_of_fares',
        'advance_amount',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'ltc_advance_id'
    ];

    public function CreateLtcAdvDetails($LtcAdvDetailsArr){
        return self::create($LtcAdvDetailsArr);
    }

    public function GetLtcAdvDetails($ids)
    {
        $LtcData = LtcAdvanceDetails::whereIn('ltc_detail_id', $ids)->get();
        return $LtcData;        
    }

    public function DeleteLtcAdvDetails($id){
        return self::where('ltc_advance_id',$id)->delete();
    }


}
