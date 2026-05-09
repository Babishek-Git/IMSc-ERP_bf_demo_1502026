<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Materialgroup extends Model
{
    use HasFactory;
	protected $table = 'erp_material_group';
	public $timestamps = false;
    protected $primaryKey = 'material_group_id';
    protected $fillable = [
        'material_group_id',
        'material_group_name',
        'material_group_code',
        'material_group_parentid',
        'active',
        'material_group_type',
        'dp_order',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
    
    public function childs() {
        return $this->hasMany('App\Models\LedgerGroup','material_group_parentid','material_group_id') ;
    }
	public function ShowMaterialGroup($request,$LedgerGroupIdArr){
        if($LedgerGroupIdArr != NULL){
            return self::where('active',1)->whereIn('material_group_id', $LedgerGroupIdArr)->orderBy('material_group_parentid','asc')->orderBy('dp_order','asc')->get();
        }else{
            return self::where('active',1)->orderBy('material_group_parentid','asc')->orderBy('dp_order','asc')->get();
        }
    }
    public function ShowGrandParent($request){
        return self::where('material_group_parentid', 0)->orderBy('material_group_id', 'asc')->get();
    }
    public function GetMaterialGroup($LedgerGroupId){
        return self::where('material_group_parentid', $LedgerGroupId)->where('active', 1)->orderBy('material_group_id', 'asc')->get();
    }
    public function CreateMaterialgroup($InsertArr){
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
    public static function ShowMatCategoryAllParentChild(){
        $MaterialCatHead = DB::select("
            WITH RECURSIVE category_tree AS (
                SELECT 
                    material_group_id,
                    material_group_parentid,
                    material_group_name,
                    material_group_name::text AS full_heads
                FROM erp_material_group
                WHERE material_group_parentid = 0

                UNION ALL

                SELECT 
                    c.material_group_id,
                    c.material_group_parentid,
                    c.material_group_name,
                    ct.full_heads || ' / ' || c.material_group_name AS full_heads
                FROM erp_material_group c
                JOIN category_tree ct 
                    ON c.material_group_parentid = ct.material_group_id

            )

            SELECT 
                ct.material_group_id, 
                ct.full_heads
            FROM category_tree ct
            ORDER BY ct.full_heads
        ");
        return $MaterialCatHead;
    }
}
