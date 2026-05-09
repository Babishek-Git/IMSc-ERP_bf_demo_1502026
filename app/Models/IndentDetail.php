<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class IndentDetail extends Model
{
    use HasFactory;
    protected $table = 'erp_indent_dtl';
    public $timestamps = false;
    protected $primaryKey = 'indent_dt_id';
    protected $fillable = [
        'indent_id',
        'item_no',
        'item_description',
        'quantity',
        'estimated_unit_price',
        'gst_rate',
        'gst_price',
        'gst_mode',
        'total_cost',    
        'item_unit',
        'suggested_supplier',
        'payment_term',
        'total_estimated_cost',
        'status',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'tax_type',
        'unit_id',
        'item_amount',
        'rate_cont_amt',
        'material_type_id'
    ];
/*     public function ShowImscAccount(){
        $ImscData = ImscAccount::join('erp_bank_master', 'erp_imsc_account.bank_id', '=', 'erp_bank_master.bank_id')
        ->join('erp_bank_branch_master', 'erp_imsc_account.branch_id', '=', 'erp_bank_branch_master.branch_id')
        ->get();
        return $ImscData;  
     } */
   
    public function CreateIndentDetail($IndentDtArr){
        return self::create($IndentDtArr);
    }
    public static function ShowIndentDetails($request,$IndentEditId){
        $ShowData = NULL;
        if(filled($IndentEditId)){
            $ShowData = IndentDetail::where('indent_id',$IndentEditId)->where('active',1)->get();
        }
        return $ShowData;
    }
    public static function DeleteIntentDetails($request,$IndentId){
        $DeletData  = NULL;
        if(filled($IndentId)){
            $DeletData = IndentDetail::where('indent_id',$IndentId)->delete();

        }
        return $DeletData;
    }
}
        