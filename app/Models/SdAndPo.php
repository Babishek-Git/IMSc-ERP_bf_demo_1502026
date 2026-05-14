<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class SdAndPo extends Model
{
    use HasFactory;
    protected $table = 'erp_sd_po';
    public $timestamps = false;
    protected $primaryKey = 'sd_po_id';
    protected $fillable = [
        'sd_po',
        'po_id',
        'sd_po_percentage',
        'sd_po_amount',
        'sd_received_date',
        'sd_po_mode',
        'instrument_date',
        'instrument_no',
        'instrument_amount',
        'instrument_bank',
        'instrument_validity',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'sdpo_received_date'
    ];
    public function CreateSdPo($SdpoArr,$SdPgId){
        if(filled($SdPgId)){
            return self:: where('sd_po_id', $SdPgId)->update($SdpoArr);
        }else{
            return self::create($SdpoArr);
        }
    }
    public static function ShowPgSdData($PoId){
        return self::where('sd_po_id',$PoId)->where('active',1)->get();
    }
}
        