<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpProjectedTax extends Model
{
    use HasFactory;
    protected $table = 'erp_emp_projected_tax';
    public $timestamps = false;
    protected $primaryKey = 'projected_tax_id';
    protected $fillable = [
        'fin_year',
        'emp_no',
        'tax_regime',
        'total_tax_amt',
        'month_tax_amt',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public static function showProjectedTaxForMultipleEmp($FinYear,$EmpList){
        return self::where('active',1)->where('fin_year',$FinYear)->whereIn('emp_no',$EmpList)->get();
    }
    public static function createProjectedTax($TaxArr){
        return self::create($TaxArr);
    }
}
