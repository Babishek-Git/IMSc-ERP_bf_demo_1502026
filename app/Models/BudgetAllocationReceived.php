<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class BudgetAllocationReceived extends Model
{
    use HasFactory;
    protected $table = 'erp_budget_allocation_received';
    public $timestamps = false;
    protected $primaryKey = 'budget_received_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'budget_claimed_id',
        'received_amount',
        'received_date',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'active'
    ];

    public function ShowBudegetReceivedAll(){
        return self::where('active', 1)->get();     
    }

    public function ShowBudegetReceivedByClaim($BudgetClaimId){
        return self::where('active', 1)->whereIn('budget_claimed_id', $BudgetClaimId)->get();     
    }
    
    public function CreateBudgetAllocationRecived($SaveArr){
        return self::create($SaveArr);
    }
    public static function DeleteRecivedData($BudgetClaimId){
        return self::whereIn('budget_claimed_id',$BudgetClaimId)->delete();
    }
    public static function CheckPeriviousData($AllClaimIds,$GetPeriviousMonth){
        return self::whereIn('budget_claimed_id',$AllClaimIds)->count();
    }

}