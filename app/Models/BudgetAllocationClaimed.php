<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class BudgetAllocationClaimed extends Model
{
    use HasFactory;
    protected $table = 'erp_budget_allocation_claimed';
    public $timestamps = false;
    protected $primaryKey = 'budget_claimed_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'budget_allocation_id',
        'claimed_amount',
        'claimed_date',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'claim_period',
        'active'
    ];

    public function ShowBudegetClaimAll(){
        return self::where('active', 1)->get();     
    }

    public function ShowBudegetClaimByAllocation($BudgetAllocationId){
        return self::where('active', 1)->where('budget_allocation_id',$BudgetAllocationId)->get();     
    }
   
    public function CreateBudgetClaim($SaveArr){
        return self::create($SaveArr);
    }
    public static function GetClaimDataByAllocatedIds($AllObjAllocatedIds,$ClaimMode_Type){
        if(filled($AllObjAllocatedIds) && filled($ClaimMode_Type)){
            return self::whereIn('budget_allocation_id',$AllObjAllocatedIds)->where('claim_period',$ClaimMode_Type)->where('active', 1)->get();
        }else{
            return self::whereIn('budget_allocation_id',$AllObjAllocatedIds)->where('active', 1)->get();
        }
    }
    public static function DeleteClaimData($AllocationId){
        return self::whereIn('budget_allocation_id',$AllocationId)->delete();
    }
}