<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class ItemMaster extends Model
{
    use HasFactory;
    protected $table = 'erp_material_master';
    public $timestamps = false;
    protected $primaryKey = 'material_id';
    protected $fillable = [
        'material_code',
        'material_name',
        'material_description',
        'material_type_id',
        'material_type_code',
        'material_category_id',
        'uom_id',
        'hsn_sac_code',
        'gst_rate',
        'standard_rate',
        'reorder_level',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'opening_stock'
    ];
    public function ShowItemMaster(){
        return self ::join('erp_material_unit', 'erp_material_unit.uom_id', '=', 'erp_material_master.uom_id')
                    -> join('erp_material_type', 'erp_material_type.material_type_id', '=', 'erp_material_master.material_type_id')->get();        
    }
    public function CreateItemMaster($ItemArr){
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
        