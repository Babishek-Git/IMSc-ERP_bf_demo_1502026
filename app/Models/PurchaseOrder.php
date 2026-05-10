<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $table = 'erp_po_order';
    public $timestamps = false;
    protected $primaryKey = 'work_order_id';
    protected $fillable = [
        'quotation_date',
        'pcom_status',
        'tr_no',
        'work_order_no',
        'work_name',
        'short_name',
        'contid',
        'cbdtid',
        'rebate_percent',
        'work_order_date',
        'work_order_cost',
        'work_commence_date',
        'work_duration',
        'date_of_completion',
        'work_orders_ext',
        'act_doc',
        'comp_cert_desc',
        'assigned_staff',
        'under_civil_sheetid',
        'rbn',
        'is_gst_appl',
        'gst_inc_exc',
        'gst_perc_rate',
        'it_perc_rate',
        'lbcess_rate',
        'is_less_appl',
        'work_status',
        'safety_observer',
        'reference',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'target_roles',
        'from_roleid',
        'to_roleid',
        'wo_signedcopy',
        'gstid',
        'eic',
        'pe',
        'se',
        'from_emp_no',
        'to_emp_no',
        'action',
        'appr_auth_role',
        'rebate_profit',
        'auto_save_common_remarks',
        'indent_id',
        'po_suffix_no',
        'mat_cert_sect_id',
        'po_issued',
        'bill_pay_mode',
        'work_duration_mode',
        'sd_received',
        'pg_received',
        'gst_perc',
        'cost_tax',
        'is_gem_portal',
        'tax_with_po_amt',
        'gem_po_no',
    ];
    public function showPurchaseOredrData($request,$PurchaseId){
        $ReturnData = NULL;
        if(filled($PurchaseId)){
            $ReturnData = PurchaseOrder::where('active',1)->where('work_order_id',$PurchaseId)->get();      
        }else{
           $ReturnData = PurchaseOrder::where('active', 1)->whereNotNull('indent_id')->where(function($q) {
                $q->where('po_issued', false)->orWhereNull('po_issued');
            })
            ->orderBy('work_order_id', 'DESC')->get();    
        }
        return $ReturnData;
    }
    public static function showPurchaseOredrIndentData($request,$PurchaseId){
        $ReturnData = NULL;

        if(filled($PurchaseId)){
            $ReturnData = PurchaseOrder::where('imsc_workorder.active',1)
                ->where('imsc_workorder.work_order_id',$PurchaseId)
                ->join('erp_indent','imsc_workorder.indent_id','=','erp_indent.indent_id')
                ->join('erp_indent_dtl','erp_indent.indent_id','=','erp_indent_dtl.indent_id')
                ->select(
                    'imsc_workorder.*',
                    'erp_indent.*',
                    'erp_indent_dtl.*'
                )
                ->get();   
        }

        return $ReturnData;
    }
    public function CreatePurchaseOrder($OrderArr,$PoId){
        if(filled($PoId)){
            return self:: where('work_order_id', $PoId)->update($OrderArr);
        }else{
            return self::create($OrderArr);
        }
    }
    public static function POMaxSuffixNo($request){
        return PurchaseOrder::max('po_suffix_no');
    }
    public static function SavePoIssued($PoId){
        if(filled($PoId)){
            return PurchaseOrder::where('work_order_id', $PoId)->update(['po_issued' => true]);
        }
    }
    public static function showPurchaseOredrIssuedData($request){
        return PurchaseOrder::where('po_issued',true)->where('active',1)->get();
    }
    public  static function GetPoIssuedByProjId($projectId){
        if(filled($projectId)){
            return self::whereIn('indent_id', function ($query) use ($projectId) {
                $query->select('indent_id')
                    ->from('erp_indent')
                    ->where('project_id', $projectId);
            })
            ->where('po_issued', true)
            ->where('active', 1)
            ->get();
        }
    }

    public static function showSdRecievedData(){
        return PurchaseOrder::where(function ($query) {
            $query->where('sd_received', false)->orWhereNull('sd_received');
        })->where('active', 1)->get();
    }

    public static function showPoRecievedData(){
        return PurchaseOrder::where(function ($query) {
            $query->where('pg_received', false)->orWhereNull('pg_received');
        })->where('active', 1)->get();
    }
    
   /*  public function CheckBank($BankArr){
        return BankMaster::select('bank_name')
                    ->whereRaw("REGEXP_REPLACE(REGEXP_REPLACE(bank_name, '[^a-zA-Z0-9]+', '', 'g'), ' ', '', 'g') ILIKE ?", [$BankArr['bank_name']])  
                    ->get();
    }

    public function UpdateBank($BankArr, $bank_id){
        return BankMaster::where('bank_id', $bank_id)->update($BankArr);
    }
    public function ShowBankList($bank_id){
        if($bank_id != NULL){
            $BankData = BankMaster::where('bank_id', $bank_id)->orderby('bank_name','ASC')->get();
        }else{
            $BankData = BankMaster::orderby('bank_name','ASC')->get();
        }
        return $BankData;        
    }
    public function CheckBankUpdate($BankArr,$HidBankId){
        return BankMaster::select('bank_name')
                    ->where('bank_id','!=',$HidBankId)
                    ->whereRaw("REGEXP_REPLACE(REGEXP_REPLACE(bank_name, '[^a-zA-Z0-9]+', '', 'g'), ' ', '', 'g') ILIKE ?", [$BankArr['bank_name']])  
                    ->get();
    }
    public function multipleBank($BankIdArr){
        return self::where('active',1)->whereIn('bank_id',$BankIdArr)->get();
    } */
}
        