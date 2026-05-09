<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class LedgerGroup extends Model
{
    use HasFactory;
	protected $table = 'erp_ledger_group';
	public $timestamps = false;
    protected $primaryKey = 'ledger_group_id';
    protected $fillable = [
        'ledger_group_name',
        'ledger_group_code',
        'ledger_group_parentid',
        'active',
        'ledger_group_type',
        'credit_debit',
        'dp_order'
    ];
    public function childs() {
        return $this->hasMany('App\Models\LedgerGroup','ledger_group_parentid','ledger_group_id') ;
    }
	public function ShowLedgerGroup($request,$LedgerGroupIdArr){
        if($LedgerGroupIdArr != NULL){
            return self::where('active',1)->whereIn('ledger_group_id', $LedgerGroupIdArr)->orderBy('ledger_group_parentid','asc')->orderBy('dp_order','asc')->get();
        }else{
            return self::where('active',1)->orderBy('ledger_group_parentid','asc')->orderBy('dp_order','asc')->get();
        }
    }
    public function ShowGrandParent($request){
        return self::where('ledger_group_parentid', 0)->orderBy('ledger_group_id', 'asc')->get();
    }
    public function GetLedgerGroup($LedgerGroupId){
        return self::where('ledger_group_parentid', $LedgerGroupId)->where('active', 1)->orderBy('ledger_group_id', 'asc')->get();
    }
    public function CreateLedgerGroup($InsertArr){
        return self::create($InsertArr);
    }
    public function ShowLedgerGroupList($LedgerGroupId){
        if($LedgerGroupId != NULL){
            $LedgerGroupData = self::where('ledger_group_id', $LedgerGroupId)->orderby('ledger_group_id','ASC')->get();
        }else{
            $LedgerGroupData = self::orderby('ledger_group_id','ASC')->where('active', 1)->get();
        }
        return $LedgerGroupData;        
    }
    public function UpdateLedgerGroup($LedgerGroupArr, $LedgerGroupId){
        return self::where('ledger_group_id', $LedgerGroupId)->update($LedgerGroupArr);
    }
    public function AllLeafNodesOnly(){
        $LeafNodes = DB::table('erp_ledger_group as e')
                    ->whereNotExists(function ($query) {
                        $query->select(DB::raw(1))
                            ->from('erp_ledger_group as child')
                            ->whereColumn('child.ledger_group_parentid', 'e.ledger_group_id');
                    })
                    ->select('e.*')
                    ->get();
        return $LeafNodes;
    }
}
