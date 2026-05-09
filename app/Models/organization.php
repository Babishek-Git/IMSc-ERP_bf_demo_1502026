<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class organization extends Model
{
    use HasFactory;
    protected $table = 'erp_organization';
    public $timestamps = false;
    protected $primaryKey = 'orgid';
    protected $fillable = [
        'org_name',
        'org_code',
        'parent_id',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'           
    ];

    public function GetOrganization($GroupId){
        return organization::where('parent_id', $GroupId)->where('active', 1)->orderBy('orgid', 'asc')->get();
    }

	public function ShowGrandParent($request){
        return organization::where('parent_id', 0)->where('active', 1)->orderBy('orgid', 'asc')->get();
    }
    public function InsertData($InsertArr){
        return organization::create($InsertArr);
    }
    public function CheckOrganization($InsertArr){
        return organization::select('org_name')
                    ->whereRaw("REGEXP_REPLACE(REGEXP_REPLACE(org_name, '[^a-zA-Z0-9]+', '', 'g'), ' ', '', 'g') ILIKE ?", [$InsertArr['org_name']])  
                    ->get();
    }
    public function ShowOrganizationList($Orgid){
        if($Orgid != NULL){
            $OrganizationData = organization::where('orgid', $Orgid)->orderby('orgid','ASC')->get();
        }else{
            $OrganizationData = organization::orderby('orgid','ASC')->get();
        }
        return $OrganizationData;        
    }
    public function UpdateOrganizationList($InsertArr, $Orgid){
        return organization::where('orgid', $Orgid)->update($InsertArr);
    }
    public static function ShowOrganizationByParentId($request, $Orgid)
    {
        $RetData = null;
        if($Orgid != null) {
            $RetData = DB::table('erp_organization')
            ->select('erp_organization.*','erp_office.*')
            ->join('erp_office','erp_office.office_type','=','erp_organization.org_code')
            ->where('erp_organization.orgid',$Orgid)
            ->where('erp_organization.active', 1) 
            ->where('erp_office.active', 1) 
            ->get();
        }
        return $RetData;
    }

   public static function ShowOrganization($request)
    {
        $RetData = null;   
        $RetData = DB::table('erp_organization')
        ->select('erp_organization.*','erp_office.*')
        ->leftJoin('erp_office','erp_office.office_type','=','erp_organization.org_code')
        ->where('erp_organization.active', 1)
        ->where('erp_office.active', 1)  
        ->get();        
        return $RetData;
    }
}
