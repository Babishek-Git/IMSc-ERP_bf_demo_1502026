<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class bank_master extends Model
{
    use HasFactory;
    protected $table = 'erp_bank_master';
    public $timestamps = false;
    protected $primaryKey = 'bank_id';
    protected $fillable = [
        'bank_name',
        'bank_short_name',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public static function ShowBankDetails($request,$BankId,$IfscCode){                            /////////////           Function Created by Godwin -> 29-08-2023
        $BankData = DB::table('erp_bank_master')
            ->select('erp_bank_master.*','erp_bank_branch_master.*','erp_state_master.*')
            ->join('erp_bank_branch_master','erp_bank_master.bank_id','=','erp_bank_branch_master.bank_id')  
            ->join('erp_state_master','erp_bank_branch_master.state_id','=','erp_state_master.state_id');
        if($BankId != NULL){             
            $BankData = $BankData->where('erp_bank_master.bank_id',$BankId);
        }
        if($IfscCode != NULL){
            $BankData = $BankData->where('erp_bank_branch_master.ifsc_code',$IfscCode);
        }
        $BankData = $BankData->where('erp_bank_master.active',1)->orderby('erp_bank_master.bank_name','ASC')->get(); 
        return $BankData;
    }
    public function CreateBank($request, $BankArr){
        return bank_master::create($BankArr);
    }

    public function CheckBank($BankArr){
        return bank_master::select('bank_name')
                    ->whereRaw("REGEXP_REPLACE(REGEXP_REPLACE(bank_name, '[^a-zA-Z0-9]+', '', 'g'), ' ', '', 'g') ILIKE ?", [$BankArr['bank_name']])  
                    ->get();
    }

    public function UpdateBank($BankArr, $bank_id){
        return bank_master::where('bank_id', $bank_id)->update($BankArr);
    }
    public function ShowBankList($bank_id){
        if($bank_id != NULL){
            $BankData = bank_master::where('bank_id', $bank_id)->orderby('bank_name','ASC')->get();
        }else{
            $BankData = bank_master::orderby('bank_name','ASC')->get();
        }
        return $BankData;        
    }
    public function CheckBankUpdate($BankArr,$HidBankId){
        return bank_master::select('bank_name')
                    ->where('bank_id','!=',$HidBankId)
                    ->whereRaw("REGEXP_REPLACE(REGEXP_REPLACE(bank_name, '[^a-zA-Z0-9]+', '', 'g'), ' ', '', 'g') ILIKE ?", [$BankArr['bank_name']])  
                    ->get();
    }
}
        