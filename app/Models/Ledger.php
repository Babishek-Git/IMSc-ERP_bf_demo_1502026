<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Ledger extends Model
{
    use HasFactory;
	protected $table = 'erp_ledger';
	public $timestamps = false;
    protected $primaryKey = 'ledger_id';
    protected $fillable = [
        'ledger_acc_name',
        'ledger_group_id',
        'opening_balance',
        'debit_credit',
        'ledger_date',
        'tax_id',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public function CreateLedger($InsertArr){
        return self::create($InsertArr);
    }
    public function ShowLedger() {
        return self::join('erp_ledger_group','erp_ledger_group.ledger_group_id', '=', 'erp_ledger.ledger_group_id')
                   ->leftjoin('erp_tax_rate','erp_tax_rate.tax_id', '=', 'erp_ledger.tax_id')->get() ;
    } 
    public function ShowMultipleLedgerById($LedgerIdArr)
    {
        return self::whereIn('ledger_id',$LedgerIdArr)->get();
    }
    public function ShowOtherThanDeductionLedger() {
<<<<<<< Updated upstream
        return self::join('erp_ledger_group','erp_ledger_group.ledger_group_id', '=', 'erp_ledger.ledger_group_id')
                   ->leftjoin('erp_tax_rate','erp_tax_rate.tax_id', '=', 'erp_ledger.tax_id')->where('erp_ledger.active',1)->where('erp_ledger.debit_credit','!=','Deduction')->get() ;
=======
        return self::join('erp_ledger_group', 'erp_ledger_group.ledger_group_id', '=', 'erp_ledger.ledger_group_id')
                ->leftJoin('erp_tax_rate', 'erp_tax_rate.tax_id', '=', 'erp_ledger.tax_id')
                ->where('erp_ledger.active', 1)
                ->where(function ($query) {
                    $query->where('erp_ledger.debit_credit', '!=', 'Deduction')
                        ->orWhereNull('erp_ledger.debit_credit');
                })
                ->get();
>>>>>>> Stashed changes
    } 
    public function ShowDeductionLedger() {
        return self::join('erp_ledger_group','erp_ledger_group.ledger_group_id', '=', 'erp_ledger.ledger_group_id')
                   ->leftjoin('erp_tax_rate','erp_tax_rate.tax_id', '=', 'erp_ledger.tax_id')->where('erp_ledger.active',1)->where('erp_ledger.debit_credit','Deduction')->get();
    } 
}
