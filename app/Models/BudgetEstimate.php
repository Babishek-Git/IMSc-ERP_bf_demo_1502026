<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class BudgetEstimate extends Model
{
    use HasFactory;
	protected $table = 'erp_budget_estimate';
	public $timestamps = false;
    protected $primaryKey = 'budget_estimate_id';
    protected $fillable = [
        'fin_year',
        'hoa_id',
        'hoa',
        'object_head_group_id',
        'ledger_group_id',
        'be_re_type',
        'stage',
        'amount',
        'remarks',
        'is_current',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public function CreateBudgetEstimate($InsertArr){
        return self::create($InsertArr);
    }
    public function ShowBudgetEstimate() {
        return self::get() ;
    } 
}
