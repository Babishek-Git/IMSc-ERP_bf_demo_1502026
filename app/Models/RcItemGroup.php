<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class RcItemGroup extends Model
{
    use HasFactory;
	protected $table = 'erp_rc_item_master';
	public $timestamps = false;
    protected $primaryKey = 'rc_item_id';
    protected $fillable = [
        'rc_item_name',
        'rc_item_parentid',
        'active',
        'ledger_group_type',
        'credit_debit',
        'dp_order'
    ];
    // public function childs() {
    //     return $this->hasMany('App\Models\LedgerGroup','rc_item_parentid','ledger_group_id') ;
    // }
	// public function ShowLedgerGroup($request,$LedgerGroupIdArr){
    //     if($LedgerGroupIdArr != NULL){
    //         return self::where('active',1)->whereIn('ledger_group_id', $LedgerGroupIdArr)->orderBy('rc_item_parentid','asc')->orderBy('dp_order','asc')->get();
    //     }else{
    //         return self::where('active',1)->orderBy('rc_item_parentid','asc')->orderBy('dp_order','asc')->get();
    //     }
    // }
    public function ShowGrandParent($request){
        return self::where('rc_item_parentid', 0)->orderBy('rc_item_id', 'asc')->get();
    }
     public function GetItemGroup($ItemGroupId){
        return self::where('rc_item_parentid', $ItemGroupId)->where('active', 1)->orderBy('rc_item_id', 'asc')->get();
    }
     public function CreateItemGroup($InsertArr){
            return self::create($InsertArr);
    }
    // public function ShowLedgerGroupList($LedgerGroupId){
    //     if($LedgerGroupId != NULL){
    //         $LedgerGroupData = self::where('ledger_group_id', $LedgerGroupId)->orderby('ledger_group_id','ASC')->get();
    //     }else{
    //         $LedgerGroupData = self::orderby('ledger_group_id','ASC')->where('active', 1)->get();
    //     }
    //     return $LedgerGroupData;        
    // }
    // public function UpdateLedgerGroup($LedgerGroupArr, $LedgerGroupId){
    //     return self::where('ledger_group_id', $LedgerGroupId)->update($LedgerGroupArr);
    // }
    // public function AllLeafNodesOnly(){
    //     $LeafNodes = DB::table('erp_ledger_group as e')
    //                 ->whereNotExists(function ($query) {
    //                     $query->select(DB::raw(1))
    //                         ->from('erp_ledger_group as child')
    //                         ->whereColumn('child.ledger_group_parentid', 'e.ledger_group_id');
    //                 })
    //                 ->select('e.*')
    //                 ->get();
    //     return $LeafNodes;
    // }
     public function ShowAllParentChild(){
        $ItemHeads = DB::select("
            WITH RECURSIVE category_tree AS (
                SELECT 
                    rc_item_id,
                    rc_item_parentid,
                    rc_item_name,
                    rc_item_name::text AS full_heads
                FROM erp_rc_item_master
                WHERE rc_item_parentid = 0

                UNION ALL

                SELECT 
                    c.rc_item_id,
                    c.rc_item_parentid,
                    c.rc_item_name,
                    ct.full_heads || ' / ' || c.rc_item_name
                FROM erp_rc_item_master c
                JOIN category_tree ct 
                ON c.rc_item_parentid = ct.rc_item_id
            )

            SELECT ct.rc_item_id, ct.full_heads
            FROM category_tree ct
            WHERE NOT EXISTS (
                SELECT 1 
                FROM erp_rc_item_master c
                WHERE c.rc_item_parentid = ct.rc_item_id
            )
            ORDER BY ct.full_heads
        ");

        return $ItemHeads;
    }
}
