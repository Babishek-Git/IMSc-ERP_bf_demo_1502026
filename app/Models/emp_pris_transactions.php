<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emp_pris_transactions extends Model
{
    use HasFactory;
    protected $table = 'emp_pris_transactions';
    public $timestamps = false;
    protected $primaryKey = 'pris_trans_id';
    protected $fillable = [
        'emp_no',
        'pris_amount',
        'pris_date',
        'pris_month',
        'pris_year',
        'active'
    ];
    
}
