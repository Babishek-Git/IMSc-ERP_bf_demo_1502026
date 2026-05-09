<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class ContractorGST extends Model
{
    use HasFactory;
    protected $table = 'erp_contractor_gst';
    public $timestamps = false;
    protected $primaryKey = 'gstid';
    protected $fillable = [
        'contid',
        'gst_no',
        'state_id',
        'addr_contractor',
        'state_id',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
    public function ShowContractorGSt(){
        return self ::get();        
    }
    public function CreateContractorGSt($ItemArr){
        return self::create($ItemArr);
    }
    public function ShowContractorGstByContId($ContId){
        return self::where('active',1)->where('contid',$ContId)->get();
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
        