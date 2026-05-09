<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class ImscAccount extends Model
{
    use HasFactory;
    protected $table = 'erp_imsc_account';
    public $timestamps = false;
    protected $primaryKey = 'account_id';
    protected $fillable = [
        'account_no',
        'account_name',
        'bank_id',
        'branch_id',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public function ShowImscAccount(){
        $ImscData = ImscAccount::join('erp_bank_master', 'erp_imsc_account.bank_id', '=', 'erp_bank_master.bank_id')
        ->join('erp_bank_branch_master', 'erp_imsc_account.branch_id', '=', 'erp_bank_branch_master.branch_id')
        ->get();
        return $ImscData;  
     }
   
    public function CreateImscAccount($BankArr){
        return ImscAccount::create($BankArr);
    }

    
}
        