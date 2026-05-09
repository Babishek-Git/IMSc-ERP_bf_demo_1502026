<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class ObjectHeadGroup extends Model
{
    use HasFactory;
    protected $table = 'erp_object_head_group';
    public $timestamps = false;
    protected $primaryKey = 'object_head_group_id';
    protected $fillable = [
        'object_head_group_code',
        'object_head_group_name',
        'object_head_group_parentid',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'credit_or_debit'
    ];
    public function ShowObjectHeadGroup($ObjHeadGroupId){
        return self::where('active',1)->orderBy('transaction_group_id','ASC')->get();  
    } 
    public function CreateObjectHeadGroup($ObjHeadGroupArr){
        return self::create($ObjHeadGroupArr);
    }
    public function UpdateObjectHeadGroup($ObjHeadGroupArr, $ObjHeadGroupId){
        return self::where('transaction_group_id', $ObjHeadGroupId)->update($ObjHeadGroupArr);
    }
    public function ShowAllParentChild(){
        $ObjectHeads = DB::select("
            WITH RECURSIVE category_tree AS (
                SELECT 
                    object_head_group_id,
                    object_head_group_parentid,
                    object_head_group_name,
                    object_head_group_name::text AS full_heads
                FROM erp_object_head_group
                WHERE object_head_group_parentid = 0

                UNION ALL

                SELECT 
                    c.object_head_group_id,
                    c.object_head_group_parentid,
                    c.object_head_group_name,
                    ct.full_heads || ' / ' || c.object_head_group_name
                FROM erp_object_head_group c
                JOIN category_tree ct 
                ON c.object_head_group_parentid = ct.object_head_group_id
            )

            SELECT ct.object_head_group_id, ct.full_heads
            FROM category_tree ct
            WHERE NOT EXISTS (
                SELECT 1 
                FROM erp_object_head_group c
                WHERE c.object_head_group_parentid = ct.object_head_group_id
            )
            ORDER BY ct.object_head_group_id
        ");

        return $ObjectHeads;
    }
}
        