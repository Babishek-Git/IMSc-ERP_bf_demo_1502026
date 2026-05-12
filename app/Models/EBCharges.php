<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EBCharges extends Model
{
    use HasFactory;
    protected $table = 'erp_emp_eb_charges';
    public $timestamps = false;
    protected $primaryKey = 'eb_charge_id';
    protected $fillable = [
        'emp_no',
        'pay_year',
        'pay_month',
        'eb_charge',
        'lf_charge',
        'wc_charge',
        'eb_consump_unit',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public function ShowCharges()
    {
        /*  $EbData = EBCharges::join('erp_employee','erp_house_master.emp_no','=','erp_employee.emp_no')
                            ->leftjoin('erp_emp_designation','erp_employee.emp_designation_id','=','erp_emp_designation.designation_id')
                            ->select('erp_emp_eb_charges.*','erp_employee.emp_name_payslip','erp_emp_designation.designation_name')->get(); */
        $EbData = self::leftjoin('erp_employee','erp_emp_eb_charges.emp_no','=','erp_employee.emp_no')
                            ->leftjoin('erp_emp_designation','erp_employee.emp_designation_id','=','erp_emp_designation.designation_id')
                            ->select('erp_emp_eb_charges.*','erp_employee.*','erp_emp_designation.*')->get();
       
        return $EbData;        
    }
    public function createEBCharges($EmployeeArr){
        return self::create($EmployeeArr);
    }
    public function ShowEbChargesForPayRoll($PayMonth,$PayYear,$EmpNoList){
        return self::where('active',1)->where('pay_month',$PayMonth)->where('pay_year',$PayYear)->whereIn('emp_no',$EmpNoList)->get();
    }
}
