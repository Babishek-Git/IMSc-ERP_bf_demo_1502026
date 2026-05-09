<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dae_units extends Model
{
    use HasFactory;
    protected $table = 'erp_dae_units';
    public $timestamps = false;
    protected $primaryKey = 'unitid';
    protected $fillable = [
        'unit_name',
        'active'        
    ];
}
