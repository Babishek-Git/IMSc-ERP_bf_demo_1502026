<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankBranchMaster extends Model
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
        return BankBranchMaster::create($BankBranchArr);
    }
    public function CheckBankBranch($BankBranchArr){
        return BankBranchMaster::select('branch_id')
                    ->whereRaw("REGEXP_REPLACE(REGEXP_REPLACE(branch_addr1, '[^a-zA-Z0-9]+', '', 'g'), ' ', '', 'g') ILIKE ?", [$BankBranchArr['branch_addr1']])  
                    ->get();
    }
    public function CheckBankBranchIFSCCode($BankBranchArr){
        return BankBranchMaster::select('branch_id')
                    ->where('ifsc_code',$BankBranchArr['ifsc_code'])
                    ->get();
    }
    public function ShowBankBranchList($branch_id){
        if($branch_id != NULL){
            //$BankBranchData = bank_branch::where('branch_id', $branch_id)->orderby('branch_id','ASC')->get();
            $BankBranchData = BankBranchMaster::join('erp_bank_master', 'erp_bank_master.bank_id', '=', 'erp_bank_branch_master.bank_id')->join('erp_state_master', 'erp_bank_branch_master.state_id', '=', 'erp_state_master.state_id')->where('erp_bank_branch_master.branch_id',$branch_id)->orderBy('erp_bank_master.bank_id','ASC')->get();
        }else{
            //$BankBranchData = bank_branch::orderby('branch_id','ASC')->get();
            $BankBranchData = BankBranchMaster::select('erp_bank_master.bank_id','erp_bank_master.bank_name','erp_state_master.state_id','erp_state_master.state_name','erp_bank_branch_master.*')->join('erp_bank_master', 'erp_bank_master.bank_id', '=', 'erp_bank_branch_master.bank_id')->join('erp_state_master', 'erp_bank_branch_master.state_id', '=', 'erp_state_master.state_id')->orderBy('erp_bank_master.bank_id','ASC')->get();
        }
        return $BankBranchData;        
    }
    public function ShowBankStateName(){
        $BankStateName = BankBranchMaster::join('erp_state_master', 'erp_state_master.state_id', '=', 'erp_bank_branch_master.state_id')->get();
        return $BankStateName;        
    }
    public function ShowBankName(){
        $BankName = BankBranchMaster::join('erp_bank_master', 'erp_bank_master.bank_id', '=', 'erp_bank_branch_master.bank_id')->get();
        return $BankName;        
    }

    public function UpdateBankBranch($BankBranchArr, $branch_id){
        return BankBranchMaster::where('branch_id', $branch_id)->update($BankBranchArr);
    }
    public function CheckBankBranchUpdate($BankBranchArr,$HidBranchId){ 
        return BankBranchMaster::select('branch_id')
                    ->where('branch_id','!=',$HidBranchId)
                    ->whereRaw("REGEXP_REPLACE(REGEXP_REPLACE(branch_addr1, '[^a-zA-Z0-9]+', '', 'g'), ' ', '', 'g') ILIKE ?", [$BankBranchArr['branch_addr1']])  
                    ->get();
    }
    public function multipleBranch($BranchIdArr){
        return self::where('active',1)->whereIn('branch_id',$BranchIdArr)->get();
    }
    public function ShowAllIfsc(){
        return self::select('branch_id','ifsc_code','bank_id')->where('active',1)->get();
    }
}
