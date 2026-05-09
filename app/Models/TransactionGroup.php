<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class TransactionGroup extends Model
{
    use HasFactory;
    protected $table = 'erp_transaction_group';
    public $timestamps = false;
    protected $primaryKey = 'transaction_group_id';
    protected $fillable = [
        'transaction_group_code',
        'transaction_group_name',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'credit_or_debit'
    ];
    public function ShowTransactionGroup($TransGroupId){
        return self::where('active',1)->orderBy('transaction_group_id','ASC')->get();  
    } 
    public function CreateTransactionGroup($TransGroupArr){
        return self::create($TransGroupArr);
    }
    public function UpdateTransactionGroup($TransGroupArr, $TransGroupId){
        return self::where('transaction_group_id', $TransGroupId)->update($TransGroupArr);
    }
}
        