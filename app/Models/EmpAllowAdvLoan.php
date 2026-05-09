<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class EmpAllowAdvLoan extends Model
{
    use HasFactory;
	protected $table = 'erp_emp_allow_adv_loan';
	public $timestamps = false;
    protected $primaryKey = 'emp_allow_adv_load_id';
    protected $fillable = [
        'emp_no',
        'component_id',
        'component_code',
        'aal_amount',
        'aal_interest_rate',
        'aal_date',
        'total_installment',
        'emi_amount',
        'start_month_year',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'aal_issue_date',
        'aal_issue_status',
        'aal_issue_pay_roll_id',
        'aal_status',
        'active'
    ];
    public function CreateEmpAllowAdvLoan($InsertArr){
        return self::create($InsertArr);
    }
    public function ShowEmpAllowAdvLoanPayMultiipleEmp($EmpList) {
        return self::where('active',1)->where('aal_status','active')->whereIn('emp_no',$EmpList)->get();
    } 
}
