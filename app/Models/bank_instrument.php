<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bank_instrument extends Model
{
    use HasFactory;
    protected $table = 'erp_bank_instrument';
    public $timestamps = false;
    protected $primaryKey = 'bank_inst_id';
    protected $fillable = [
        'bank_inst_name',
        'bank_inst_fname',
        'inst_code',
        'created_at',
        'created_by',
        'updated_by',
        'updated_at',
        'active'
    ];

    public function CreateBankInst($request, $BankInstArr){
        return bank_instrument::create($BankInstArr);
    }

    public function CheckBankInst($BankInstArr){
        return bank_instrument::select('bank_inst_name','inst_code')
                    ->whereRaw("REGEXP_REPLACE(REGEXP_REPLACE(bank_inst_name, '[^a-zA-Z0-9]+', '', 'g'), ' ', '', 'g') ILIKE ?", [$BankInstArr['bank_inst_name']])  
                    ->orWhereRaw("REGEXP_REPLACE(REGEXP_REPLACE(inst_code, '[^a-zA-Z0-9]+', '', 'g'), ' ', '', 'g') ILIKE ?", [$BankInstArr['inst_code']])
                    ->get();
    }
    public function ShowBankinstrument($bank_inst_id){
        if($bank_inst_id != NULL){
            $BankInstrumentData = bank_instrument::where('bank_inst_id', $bank_inst_id)->where('active',1)->orderby('bank_inst_id','ASC')->get();
        }else{
            $BankInstrumentData = bank_instrument::where('active',1)->orderby('bank_inst_id','ASC')->get();
        }
        return $BankInstrumentData;        
    }

    public function UpdateBankInstrument($BankInstArr, $bank_inst_id){
        return bank_instrument::where('bank_inst_id', $bank_inst_id)->update($BankInstArr);
    }
    public function ShowAllBankInstrument($bank_inst_id){
        if($bank_inst_id != NULL){
            $BankInstrumentData = bank_instrument::where('bank_inst_id', $bank_inst_id)->orderby('bank_inst_id','ASC')->get();
        }else{
            $BankInstrumentData = bank_instrument::orderby('bank_inst_id','ASC')->get();
        }
        return $BankInstrumentData;        
    }
    public function CheckBankInstUpdate($BankInstArr, $HidBankInstId) {
        return bank_instrument::select('bank_inst_name', 'inst_code')
            ->where('bank_inst_id', '!=', $HidBankInstId)
            ->where(function ($query) use ($BankInstArr) {
                $query->whereRaw("REGEXP_REPLACE(REGEXP_REPLACE(bank_inst_name, '[^a-zA-Z0-9]+', '', 'g'), ' ', '', 'g') ILIKE ?", [$BankInstArr['bank_inst_name']])
                    ->orWhereRaw("REGEXP_REPLACE(REGEXP_REPLACE(inst_code, '[^a-zA-Z0-9]+', '', 'g'), ' ', '', 'g') ILIKE ?", [$BankInstArr['inst_code']]);
            })
            ->get();
    }    
}
