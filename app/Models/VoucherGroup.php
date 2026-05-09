<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class VoucherGroup extends Model
{
    use HasFactory;
    protected $table = 'erp_voucher_group';
    public $timestamps = false;
    protected $primaryKey = 'voucher_group_id';
    protected $fillable = [
        'voucher_group_code',
        'voucher_group_name',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'credit_or_debit'
    ];
    public function ShowVoucherGroup($VrGroupId){
        return self::where('active',1)->orderBy('voucher_group_id','ASC')->get();  
    } 
    public function CreateVoucherGroup($VrGroupArr){
        return self::create($VrGroupArr);
    }
    public function UpdateVoucherGroup($VrGroupArr, $VrGroupId){
        return self::where('voucher_group_id', $VrGroupId)->update($VrGroupArr);
    }
}
        