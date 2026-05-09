<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pao_code extends Model
{
    use HasFactory;
    protected $table = 'erp_pao_code';
    public $timestamps = false;
    protected $primaryKey = 'pao_code_id';
    protected $fillable = [       
        'pao_code',
        'pao_code_full',
        'active'
    ];

    public static function GetAllPAOCode($request){
        $RetDet = pao_code::where('active', 1)->get();
        return $RetDet;
    }

}
