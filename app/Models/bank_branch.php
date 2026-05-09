<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bank_branch extends Model
{
    use HasFactory;
    protected $table = 'erp_bank_branch_master';
    public $timestamps = false;
    protected $primaryKey = 'branch_id';
    protected $fillable = [
        'branch_city',
        'ifsc_code',
        'branch_addr1',
        'state_id',
        'bank_id',
        'created_at',
        'created_by',
        'updated_by',
        'updated_at',
        'active'
    ];

    public function CreateBankBranch($request, $BankBranchArr){
        return bank_branch::create($BankBranchArr);
    }

    public function CheckBankBranch($BankBranchArr){
        return bank_branch::select('branch_id')
                    ->whereRaw("REGEXP_REPLACE(REGEXP_REPLACE(branch_addr1, '[^a-zA-Z0-9]+', '', 'g'), ' ', '', 'g') ILIKE ?", [$BankBranchArr['branch_addr1']])  
                    ->get();
    }
    public function CheckBankBranchIFSCCode($BankBranchArr){
        return bank_branch::select('branch_id')
                    ->where('ifsc_code',$BankBranchArr['ifsc_code'])
                    ->get();
    }
    public function ShowBankBranchList($branch_id){
        if($branch_id != NULL){
            //$BankBranchData = bank_branch::where('branch_id', $branch_id)->orderby('branch_id','ASC')->get();
            $BankBranchData = bank_branch::join('erp_bank_master', 'erp_bank_master.bank_id', '=', 'erp_bank_branch_master.bank_id')->join('erp_state_master', 'erp_bank_branch_master.state_id', '=', 'erp_state_master.state_id')->where('erp_bank_branch_master.branch_id',$branch_id)->orderBy('erp_bank_master.bank_id','ASC')->get();
        }else{
            //$BankBranchData = bank_branch::orderby('branch_id','ASC')->get();
            $BankBranchData = bank_branch::select('erp_bank_master.bank_id','erp_bank_master.bank_name','erp_state_master.state_id','erp_state_master.state_name','erp_bank_branch_master.*')->join('erp_bank_master', 'erp_bank_master.bank_id', '=', 'erp_bank_branch_master.bank_id')->join('erp_state_master', 'erp_bank_branch_master.state_id', '=', 'erp_state_master.state_id')->orderBy('erp_bank_master.bank_id','ASC')->get();
        }
        return $BankBranchData;        
    }

    public function UpdateBankBranch($BankBranchArr, $branch_id){
        return bank_branch::where('branch_id', $branch_id)->update($BankBranchArr);
    }
    public function CheckBankBranchUpdate($BankBranchArr,$HidBranchId){ 
        return bank_branch::select('branch_id')
                    ->where('branch_id','!=',$HidBranchId)
                    ->whereRaw("REGEXP_REPLACE(REGEXP_REPLACE(branch_addr1, '[^a-zA-Z0-9]+', '', 'g'), ' ', '', 'g') ILIKE ?", [$BankBranchArr['branch_addr1']])  
                    ->get();
    }
}
