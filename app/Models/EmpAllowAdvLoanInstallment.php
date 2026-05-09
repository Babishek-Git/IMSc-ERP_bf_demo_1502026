<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class EmpAllowAdvLoanInstallment extends Model
{
    use HasFactory;
	protected $table = 'erp_emp_allow_adv_loan_installment';
	public $timestamps = false;
    protected $primaryKey = 'emp_aal_installment_id';
    protected $fillable = [
        'emp_allow_adv_load_id',
        'installment_no',
        'due_date',
        'principal_amount',
        'interest_amount',
        'total_amount',
        'paid_status',
        'paid_in_salary_month_yr',
        'payroll_master_id',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public function CreateEmpAllowAdvLoanInstallment($InsertArr){
        return self::create($InsertArr);
    }
    public function ShowEmpAllowAdvLoanPayInstallmentMultiple($AllowAdvLoanIdArr,$PayDate) {
        return self::where('active', 1)
                ->whereIn('emp_allow_adv_load_id', $AllowAdvLoanIdArr)
                ->where(function ($query) {
                    $query->where('paid_status', 'hold')
                        ->orWhereNull('paid_status');
                })
                ->where('due_date', '<=', $PayDate)
                ->get();
    } 
}
