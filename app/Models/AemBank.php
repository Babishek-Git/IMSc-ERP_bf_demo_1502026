<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class AemBank extends Model
{
    use HasFactory;
	protected $table = 'erp_employee_bank_acc_dt';
    public $timestamps = false;
    protected $primaryKey = 'emp_bank_dt_id';
    protected $fillable = [
        'emp_no',
        'bank_id',
        'branch_id',
        'account_no',
        'account_holder_name',
        'is_current',
        'effective_date',
        'end_date',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];

   public function ShowBankDetails($request,$EmpNo){
            $BankData = AemBank::join('erp_bank_master', 'erp_employee_bank_acc_dt.bank_id', '=', 'erp_bank_master.bank_id') 
                                ->join('erp_bank_branch_master','erp_employee_bank_acc_dt.branch_id','=','erp_bank_branch_master.branch_id')
                                ->join('erp_employee','erp_employee.emp_no','=','emp_bank_dt_id.emp_no')
                                ->where('erp_employee_bank_acc_dt.emp_no',$EmpNo); 
            return $BankData;
    }
    public function CreateBankDetails($BankArr){
        return AemBank::create($BankArr);
    }
   /*  public function UpdateBankDetails($BankArr, $EmpNo){
        return AemBank::where('emp_no', $EmpNo)->update($BankArr);
    } */
   /*  $EmpQuery->where('t1.emp_no',$EmployeeNo);
    $EmpData = $EmpQuery->get(); 
    return $EmpData; */
    public function ShowBankDetailsByEmpNo($EmpNo){
        $BankData    = AemBank::join('erp_bank_master','erp_bank_master.bank_id','=','erp_employee_bank_acc_dt.bank_id')->join('erp_bank_branch_master','erp_bank_branch_master.branch_id','=','erp_employee_bank_acc_dt.branch_id')->where('erp_employee_bank_acc_dt.emp_no',$EmpNo)->where('erp_employee_bank_acc_dt.active',1)->get();
        return $BankData;
    }
}