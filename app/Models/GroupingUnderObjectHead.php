<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class GroupingUnderObjectHead extends Model
{
    use HasFactory;
	protected $table = 'erp_object_head_group';
	public $timestamps = false;
    protected $primaryKey = 'object_head_group_id';
    protected $fillable = [
        'object_head_group_id',
        'object_head_group_name',
        'object_head_group_code',
        'object_head_group_parentid',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',

    ];
    public function childs() {
        return $this->hasMany('App\Models\LedgerGroup','object_head_group_parentid','object_head_group_id') ;
    }
	public function ShowLedgerGroup($request,$LedgerGroupIdArr){
        if($LedgerGroupIdArr != NULL){
            return self::where('active',1)->whereIn('material_group_id', $LedgerGroupIdArr)->orderBy('material_group_parentid','asc')->orderBy('dp_order','asc')->get();
        }else{
            return self::where('active',1)->orderBy('material_group_parentid','asc')->orderBy('dp_order','asc')->get();
        }
    }
    public function ShowGrandParent($request){
        return self::where('object_head_group_parentid', 0)->orderBy('object_head_group_id', 'asc')->get();
    }
    public function GetLedgerGroup($LedgerGroupId){
        return self::where('material_group_parentid', $LedgerGroupId)->where('active', 1)->orderBy('material_group_id', 'asc')->get();
    }
    public function CreateGroupingUnderObjectHead($InsertArr){
        return self::create($InsertArr);
    }
    public function ShowLedgerGroupList($LedgerGroupId){
        if($LedgerGroupId != NULL){
            $LedgerGroupData = self::where('material_group_id', $LedgerGroupId)->orderby('material_group_id','ASC')->get();
        }else{
            $LedgerGroupData = self::orderby('material_group_id','ASC')->where('active', 1)->get();
        }
        return $LedgerGroupData;        
    }
    public function UpdateLedgerGroup($LedgerGroupArr, $LedgerGroupId){
        return self::where('material_group_id', $LedgerGroupId)->update($LedgerGroupArr);
    }
    public function AllLeafNodesOnly(){
        $LeafNodes = DB::table('erp_material_group as e')
                    ->whereNotExists(function ($query) {
                        $query->select(DB::raw(1))
                            ->from('erp_material_group as child')
                            ->whereColumn('child.material_group_parentid', 'e.material_group_id');
                    })
                    ->select('e.*')
                    ->get();
        return $LeafNodes;
    }
}
