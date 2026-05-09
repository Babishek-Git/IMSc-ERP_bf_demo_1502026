<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiaMaster extends Model
{
    use HasFactory;
    protected $table = 'erp_gia';
    public $timestamps = false;
    protected $primaryKey = 'gia_id';
    protected $fillable = [
        'gia_code',
        'gia_name',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public static function showGiaMasterData($request){
        return GiaMaster::where('active',1)->get();
    }
}
