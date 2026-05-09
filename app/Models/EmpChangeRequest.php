<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpChangeRequest extends Model
{
    use HasFactory;
    protected $table = 'erp_emp_change_request';
    public $timestamps = false;
    protected $primaryKey = 'change_req_id';
    protected $fillable = [
        'module_code',
        'old_value',
        'new_value',
        'request_date',
        'emp_no',
        'approved_date',
        'approved_by',
        'status',
        'remarks',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'rejected_by',
        'rejected_dt',
        'from_emp_no',
        'from_role',
        'to_emp_no',
        'to_role',
        'is_approved',
        'target_roles',
        'is_completed',
        'approve_auth_role'
    ];
    public function ShowEmpyChangeRequest($request,$EmpNo,$ModuleCode){
         $RequsetData = EmpChangeRequest::leftjoin('erp_employee','erp_employee.emp_no', '=', 'erp_emp_change_request.emp_no')
         ->join('erp_emp_designation','erp_employee.emp_designation_id','=','erp_emp_designation.designation_id')->where('erp_emp_change_request.emp_no',$EmpNo)->where('module_code',$ModuleCode)->get();
         return $RequsetData;
    }
    public function ShowEmpPendingChangeRequest($request,$EmpNo,$ModuleCode){
         $RequsetData = EmpChangeRequest::leftjoin('erp_employee','erp_employee.emp_no', '=', 'erp_emp_change_request.emp_no')
         ->join('erp_emp_designation','erp_employee.emp_designation_id','=','erp_emp_designation.designation_id')
         ->when($EmpNo, function ($query) use ($EmpNo) {
            return $query->where('erp_emp_change_request.emp_no', $EmpNo);
        })
         ->where('module_code',$ModuleCode) 
         ->where(function ($query) {  
            $query->where(function ($q) {
                $q->where('erp_emp_change_request.created_by', session('WcmsEmpNo'))
                ->where(function ($q) {
                    $q->where('erp_emp_change_request.status', 'submitted')
                    ->orWhere('erp_emp_change_request.status', 'pending');
                })
                ->whereNull('erp_emp_change_request.to_emp_no')
                ->whereNull('erp_emp_change_request.from_emp_no')
                ->where(function ($sub) {
                  $sub->where('erp_emp_change_request.is_approved', false)
                      ->orWhereNull('erp_emp_change_request.is_approved');
                });
            })
            ->orWhere(function ($q) {
                $q->where('erp_emp_change_request.to_emp_no', session('WcmsEmpNo'))
                ->Where(function ($q) {
                    $q->where('erp_emp_change_request.status', 'submitted')
                    ->orWhere('erp_emp_change_request.status', 'recommended');
                });
            });
        })->get();
        //dd($RequsetData);
         return $RequsetData;
    }
    public function CreateChangeRequest($EmployeeArr){
        return EmpChangeRequest::create($EmployeeArr);
    }
    public function ShowEmpRequest($request,$ChangeId){
        $RequestData = NULL;
        if($ChangeId!= NULL){
           $RequestData = EmpChangeRequest::where('change_req_id',$ChangeId)->where('active',1)->first();
        }
        return $RequestData;
    }
    public function updateChangeRequest($EmpArr,$ChangeId){
        return self::where('change_req_id', $ChangeId)->Update($EmpArr);
    }
     public function ShowEmpChangeRequests($request,$ModuleCode){
         $RequsetData = EmpChangeRequest::leftjoin('erp_employee','erp_employee.emp_no', '=', 'erp_emp_change_request.emp_no')
         ->join('erp_emp_designation','erp_employee.emp_designation_id','=','erp_emp_designation.designation_id')->where('module_code',$ModuleCode)->get();
         return $RequsetData;
    } 
}
