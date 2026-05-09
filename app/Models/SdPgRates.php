<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class SdPgRates extends Model
{
    use HasFactory;
    protected $table = 'erp_sd_pg_rates';
    public $timestamps = false;
    protected $primaryKey = 'sd_pg_rate_id';
    protected $fillable = [
        'sd_po',
        'from_value',
        'to_value',
        'percentage',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];

}
        