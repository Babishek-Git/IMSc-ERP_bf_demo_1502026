<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emp_payroll_transactions extends Model
{
    use HasFactory;
    protected $table = 'emp_payroll_transactions';
    public $timestamps = false;
    protected $primaryKey = 'pay_id';
    protected $fillable = [
        'basic_pay',
        'da',
        'hra',
        'ta',
        'basic_arrear',
        'da_arrear',
        'hra_arrear',
        'ta_arrear',
        'others',
        'gross_pay',
        'chs',
        'gpf',
        'additional_gpf',
        'gpf_advance',
        'nps',
        'lic',
        'pt',
        'pli',
        'hba',
        'other_advance',
        'lic_fee',
        'water_charge',
        'eb_charge',
        'it',
        'total_deduction',
        'net_salary',
        'emp_no',
        'da_perc',
        'pay_year',
        'pay_month'
    ];
    
}
