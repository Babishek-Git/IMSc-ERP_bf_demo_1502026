<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;


class RcItemRateMaster extends Model
{
    use HasFactory;
    protected $table      = 'erp_rc_item_rate_master';
	public $timestamps    = false;
    protected $primaryKey = 'rc_item_rate_id';
    protected $fillable   = [
        'rc_item_id',
        'rate_per_unit',
        'gst',
        'effective_from_date',
        'effective_to_date',
        'total_price',
        'active',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
    public static function ShowConsumablesItemsData($request){
        return DB::table('erp_rc_item_master as m')
            ->join('erp_rc_item_rate_master as d', 'm.rc_item_id', '=', 'd.rc_item_id')
            ->where('d.active', 1)
            ->select(
                'm.rc_item_id',
                'm.rc_item_name',
                'd.rate_per_unit',
                'd.gst'
            )->get();
    }
    public static function CreateRcItemRateDt($SaveArr){
        return self::create($SaveArr);
    }
    public static function DeleteRcRateRecord($RcItemId,$EffectFrom,$EffectTo){
        return self::where('effective_from_date',$EffectFrom)->where('effective_to_date',$EffectTo)->where('rc_item_id',$RcItemId)->update(['active'=> 0]);
    }

}
