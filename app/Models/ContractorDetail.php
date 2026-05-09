<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class ContractorDetail extends Model
{
    use HasFactory;
    protected $table = 'erp_contractor_bank_detail';
    public $timestamps = false;
    protected $primaryKey = 'cbdtid';
    protected $fillable = [
        'contid',
        'bank_acc_hold_name',
        'bank_acc_no',
        'bank_id',
        'branch_id',
        'ifsc_code',
        'bank_doc',
        'status',
        'active',
        'created_at',
        'created_by',
        'updated_at',
    ];
    public function ShowContractorDetail(){
        return self ::join('erp_contractor','erp_contractor.contid','=','erp_contractor_bank_detail.contid')->get();        
    }
    public function CreateContractorDetail($ContArr){
        return self::create($ContArr);
    }
    public function ShowContractorBank($ContId){
        return self::select('erp_contractor_bank_detail.*','erp_bank_branch_master.branch_addr1','erp_bank_branch_master.branch_id','erp_bank_branch_master.ifsc_code','erp_bank_master.bank_name','erp_bank_master.bank_short_name')
        ->join('erp_bank_master','erp_bank_master.bank_id', '=', 'erp_contractor_bank_detail.bank_id')
        ->join('erp_bank_branch_master','erp_bank_branch_master.branch_id', '=', 'erp_contractor_bank_detail.branch_id')
        ->where('erp_contractor_bank_detail.active',1)->where('erp_contractor_bank_detail.contid',$ContId)->get();
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
        