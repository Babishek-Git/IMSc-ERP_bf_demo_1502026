<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class Contractor extends Model
{
    use HasFactory;
    protected $table = 'erp_contractor';
    public $timestamps = false;
    protected $primaryKey = 'contid';
    protected $fillable = [
        'cont_code',
        'contractor_title',
        'name_contractor',
        'addr_contractor',
        'state_id',
        'pan_no',
        'gst_id',
        'pan_type',
        'gst_type',
        'is_ldc_appl',
        'ldc_certi_no',
        'ldc_validty_from',
        'ldc_max_amt',
        'ldc_validity',
        'ldc_rate',
        'contact_no',
        'contact_no_alt',
        'email_id',
        'fax_no',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'opening_stock'
    ];
    public function ShowContractor(){
        return self ::get();        
    }
    public function CreateContractor($ItemArr){
        return self::create($ItemArr);
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
        