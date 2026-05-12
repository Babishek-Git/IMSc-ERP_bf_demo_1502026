<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class LtcAdvances extends Model
{
    use HasFactory;
    protected $table = 'erp_emp_ltc_advances';
    public $timestamps = false;
    protected $primaryKey = 'ltc_advance_id';
    protected $fillable = [
        'application_no',
        'emp_no',
        'block_year',
        'advance_amount',
        'sanctioned_amount',
        'sanctioned_by',
        'sanctioned_at',
        'status',
        'remarks',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'spouse_employed',
        'entitle_ltc',
        'visiting_home',
        'year_ltc',
        'visiting_india',
        'place_visited',
        'module_code',
        'rejected_by',
        'rejected_dt',
        'from_emp_no',
        'from_role',
        'to_emp_no',
        'to_role',
        'is_approved',
        'target_roles',
        'is_completed',
        'approve_auth_role',
        'approved_by',
        'approved_dt',
        'family_ids',
        'claim_amount',
        'claim_sanctioned_amount',
        'claim_sanctioned_by',
        'claim_sanctioned_at',
        'target_roles_adv',
        'target_roles_claim',
        'advance_or_claim',
        'is_adv_completed',
        'is_claim_completed',
        'leave_enhancement',
        'el_days'
    ];

    public function ShowLtcAdvances()
    {
        $LtcData = LtcAdvances::get();
        return $LtcData;        
    }

    public function createLtcAdvances($EmpArr){
        return LtcAdvances::create($EmpArr);
    }

    public function updateLtcAdvance($id, $data)
    {
        return self::where('ltc_advance_id', $id)->update($data);
    }

    public function getLtcAdvanceById($id)
    {
        return self::where('ltc_advance_id', $id)->first();
    }

    public function ShowEmpAppiledLtcAdv($request,$EmpNo,$ModuleCode){
        $RequsetData = LtcAdvances::leftjoin('erp_employee','erp_employee.emp_no', '=', 'erp_emp_ltc_advances.emp_no')
        ->join('erp_emp_designation','erp_employee.emp_designation_id','=','erp_emp_designation.designation_id')
        ->when($EmpNo, function ($query) use ($EmpNo) {
            return $query->where('erp_emp_ltc_advances.emp_no', $EmpNo);
        })->where('module_code',$ModuleCode) 
        ->where(function ($query) {  
            $query->where(function ($q) {
                $q->where('erp_emp_ltc_advances.created_by', session('WcmsEmpNo'))
                ->where(function ($q) {
                    $q->where('erp_emp_ltc_advances.status', 'submitted')
                    ->orWhere('erp_emp_ltc_advances.status', 'pending');
                })
                ->whereNull('erp_emp_ltc_advances.to_emp_no')
                ->whereNull('erp_emp_ltc_advances.from_emp_no')
                ->where(function ($sub) {
                  $sub->where('erp_emp_ltc_advances.is_approved', false)
                      ->orWhereNull('erp_emp_ltc_advances.is_approved');
                });
            })
            ->orWhere(function ($q) {
                $q->where('erp_emp_ltc_advances.to_emp_no', session('WcmsEmpNo'))
                ->Where(function ($q) {
                    $q->where('erp_emp_ltc_advances.status', 'submitted')
                    ->orWhere('erp_emp_ltc_advances.status', 'recommended');
                });
            });
        })->get();
        // dd($RequsetData);
        return $RequsetData;
    }

    public function ShowLtcRequest($request,$RequestId){
        $RequestData = NULL;
        if($RequestId!= NULL){
           $RequestData = LtcAdvances::where('ltc_advance_id',$RequestId)->where('active',1)->first();
        }
        return $RequestData;
    }

    public function DeleteLtcAdv($LtcId){
        return self::where('ltc_advance_id',$LtcId)->delete();
    }


    public function ShowEmpClaimedLtc($request,$EmpNo,$ModuleCode){
        $RequsetData = LtcAdvances::leftjoin('erp_employee','erp_employee.emp_no', '=', 'erp_emp_ltc_advances.emp_no')
        ->join('erp_emp_designation','erp_employee.emp_designation_id','=','erp_emp_designation.designation_id')
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))->from('erp_payment')
            ->whereColumn('erp_payment.pay_emp_no', 'erp_emp_ltc_advances.emp_no')->where('erp_payment.module_code', 'LTCADV')
            ->whereNotNull('erp_payment.voucher_no')->whereNotNull('erp_payment.bill_no')
            ->where('erp_payment.is_completed', true);
        })->when($EmpNo, function ($query) use ($EmpNo) {
            return $query->where('erp_emp_ltc_advances.emp_no', $EmpNo);
        })->where('erp_emp_ltc_advances.module_code',$ModuleCode) 
        ->where(function ($query) {  
            $query->where(function ($q) {
                $q->where('erp_emp_ltc_advances.created_by', session('WcmsEmpNo'))
                ->where(function ($q) {
                    $q->where('erp_emp_ltc_advances.status', 'submitted')
                    ->orWhere('erp_emp_ltc_advances.status', 'pending');
                })
                ->whereNull('erp_emp_ltc_advances.to_emp_no')
                ->whereNull('erp_emp_ltc_advances.from_emp_no')
                ->where(function ($sub) {
                  $sub->where('erp_emp_ltc_advances.is_adv_completed', true)
                      ->orWhereNull('erp_emp_ltc_advances.is_adv_completed');
                });
            })
            ->orWhere(function ($q) {
                $q->where('erp_emp_ltc_advances.to_emp_no', session('WcmsEmpNo'))
                ->Where(function ($q) {
                    $q->where('erp_emp_ltc_advances.status', 'submitted')
                    ->orWhere('erp_emp_ltc_advances.status', 'recommended');
                });
            });
        })->distinct()->get();

        return $RequsetData;
    }

    public function UpdateAdvances($advId, $LtcdetailsIds)
    {
        return self::where('ltc_advance_id', $advId)->update([
            'application_no' => $LtcdetailsIds,        
        ]);
    }

    public function updateSanctionedAmount($advId, $sanctionedAmount)
    {
        return self::where('ltc_advance_id', $advId)->update([
            'sanctioned_amount' => $sanctionedAmount,
            'sanctioned_by'     => session('WcmsEmpNo'),
            'sanctioned_at'     => now(),
        ]);
    }

    public function updateClaimSanctionedAmount($advId, $sanctionedAmount)
    {
        return self::where('ltc_advance_id', $advId)->update([
            'claim_sanctioned_amount' => $sanctionedAmount,
            'claim_sanctioned_by'     => session('WcmsEmpNo'),
            'claim_sanctioned_at'     => now(),
        ]);
    }

    public function ShowLtcDetails($request,$RequestId){
        $RequestData = NULL;
        if($RequestId!= NULL){
           $RequestData = LtcAdvances::where('ltc_advance_id',$RequestId)->where('active',1)->get();
        }else{
           $RequestData = LtcAdvances::where('active',1)->get();

        }
        return $RequestData;
    }
    public static function ShowLtcDetailsByModuleCode($request,$ModuleCode){
        if(filled($ModuleCode)){
            return self::where('module_code',$ModuleCode)->where('active',1)->get();
        }
    }
}
