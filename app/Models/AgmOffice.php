<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class AgmOffice extends Model
{
    use HasFactory;
    protected $table = 'erp_office';
    public $timestamps = false;
    protected $primaryKey = 'office_id';
    protected $fillable = [
        'del_flag',
        'office_type',
        'del_flag',
        'repoting_to_office',
        'office_name',
        'office_short_name',
        'head',
        'created_at',
        'created_by',
        'updated_by',
        'updated_at',
        'active',
        'group_id'
    ];
    /*public static function ShowEmpOfficeForRole($request){ //dd($request->EmpNo);
        $OfficeData = AgmOffice::where('head',$request->EmpNo)->get();
        return $OfficeData;
    }*/
    public function ShowGrandParent($request){
        return AgmOffice::where('repoting_to_office', 0)->where('active', 1)->orderBy('office_id', 'asc')->get();
    }

    public function ParentOffice()
    {
        return $this->hasMany('App\Models\AgmOffice', 'office_id', 'repoting_to_office');
    }
    public function AllParentOffice()
    {
        return $this->ParentOffice()->with('AllParentOffice');
    }
    public function ShowOfficeWithType($Type,$OfficeId){
        if($OfficeId != NULL){
            $OfficeData = AgmOffice::where('office_id', $OfficeId)->where('office_type', $Type)->orderby('office_id','ASC')->get();
        }else{
            $OfficeData = AgmOffice::where('active', 1)->where('office_type', $Type)->orderby('office_name','ASC')->get();
        }
        return $OfficeData;        
    }

    public function ShowOfficeWithGroup($Type,$GroupId){
        if($GroupId != NULL){
            $GroupData = AgmOffice::whereRaw("? = ANY(string_to_array(group_id, ','))", [$GroupId])
            ->where('office_type', $Type)->orderby('office_id','ASC')->get();
        }else{
            $GroupData = AgmOffice::where('active', 1)->where('office_type', $Type)->orderby('office_name','ASC')->get();
        }
       
        return $GroupData;        
    }

    public function CreateOfficeData($OfficeArr){
        return AgmOffice::create($OfficeArr);
    }
    public function CheckOfficeData($OfficeArr){
        return AgmOffice::select('office_name')
                    ->whereRaw("REGEXP_REPLACE(REGEXP_REPLACE(office_name, '[^a-zA-Z0-9]+', '', 'g'), ' ', '', 'g') ILIKE ?", [$OfficeArr['office_name']])  
                    ->where('repoting_to_office', $OfficeArr['repoting_to_office'])
                    ->get();
    }
    public function UpdateOfficeList($OfficeArr, $OfficeId){
        return AgmOffice::where('office_id', $OfficeId)->update($OfficeArr);
    }

    public function ShowOfficeWithRepToOffice($OfficeId){
        if($OfficeId != NULL){
            $OfficeData = AgmOffice::where('repoting_to_office', $OfficeId)->where('active',1)->get();
        }else{
            $OfficeData = AgmOffice::orderby('repoting_to_office','ASC')->where('active', 1)->get();
        }
        return $OfficeData;        
    }
    public function ShowMultipleOfficeWithRepToOffice($OfficeIdList,$Type){
        return AgmOffice::whereIn('repoting_to_office', $OfficeIdList)->where('office_type', $Type)->where('active',1)->get();
    }
    public function ShowOfficeData($office_id){ 
        /*if($office_id != NULL){
            $OfficeData = AgmOffice::where('office_id', $office_id)->orderby('office_id','ASC')->get();
        }else{
            $OfficeData = AgmOffice::orderby('office_id','ASC')->where('active', 1)->get();
        }*/
        if($office_id != NULL){
            $OfficeData = AgmOffice::select('erp_office.*', 'erp_organization.org_name')
                    ->leftJoin('erp_organization', 'erp_office.office_type', '=', 'erp_organization.org_code')
                    ->where('erp_office.office_id', $office_id)
                    ->where('erp_office.active', 1)
                    ->orderBy('erp_office.office_id', 'ASC')
                    ->get();
        }else{
            $OfficeData = AgmOffice::select('erp_office.*', 'erp_organization.org_name')
                ->leftJoin('erp_organization', 'erp_office.office_type', '=', 'erp_organization.org_code')
                ->where('erp_office.active', 1)
                ->orderBy('erp_office.office_id', 'ASC')
                ->get();
        } 
        return $OfficeData;        
    }
    public function ShowAllOfficeData($office_id){
        if($office_id != NULL){
            $OfficeData = AgmOffice::where('office_id', $office_id)->orderby('office_id','ASC')->get();
        }else{
            $OfficeData = AgmOffice::orderby('office_id','ASC')->get();
        }
        return $OfficeData;        
    }
    
    public function ShowOfficeChildData($ParentId){ 
        $result = DB::select("
            WITH RECURSIVE cte AS (
                SELECT 
                    o.*,
                    r.office_name AS reporting_to_office_name,
                    r.office_short_name AS reporting_to_office_short_name
                FROM 
                    erp_office o
                LEFT JOIN 
                    erp_office r ON o.repoting_to_office = r.office_id
                WHERE 
                    o.office_id = :ParentId
                UNION ALL
                SELECT 
                    t.*,
                    r.office_name AS reporting_to_office_name,
                    r.office_short_name AS reporting_to_office_short_name
                FROM 
                    erp_office t
                JOIN 
                    cte ON t.repoting_to_office = cte.office_id 
                LEFT JOIN 
                    erp_office r ON t.repoting_to_office = r.office_id
            )
            SELECT 
                *
            FROM 
                cte
            WHERE 
                office_id != :ParentId;
            ", ['ParentId' => $ParentId]);
        
        return $result;
    }
    public function ShowReportingToOfficeData($Officeid) {
        if ($Officeid != NULL) {
            $OfficeData = AgmOffice::select('erp_office.*', 'reporting_to.office_name as reporting_to_office_name', 'reporting_to.office_short_name as reporting_to_office_short_name')
                ->leftJoin('erp_office as reporting_to', 'erp_office.repoting_to_office', '=', 'reporting_to.office_id')
                ->where('erp_office.office_id', $Officeid)
                ->orderBy('erp_office.office_id', 'ASC')
                ->get();
        } else {
            $OfficeData = AgmOffice::select('erp_office.*', 'reporting_to.office_name as reporting_to_office_name', 'reporting_to.office_short_name as reporting_to_office_short_name')
                ->leftJoin('erp_office as reporting_to', 'erp_office.repoting_to_office', '=', 'reporting_to.office_id')
                ->where('erp_office.active', 1)
                ->orderBy('erp_office.office_id', 'ASC')
                ->get();
        }
        return $OfficeData;        
    }
    public function ShowReportingToOfficeDataWOActive($Officeid) {
        if ($Officeid != NULL) {
            $OfficeData = AgmOffice::select('erp_office.*', 'reporting_to.office_name as reporting_to_office_name', 'reporting_to.office_short_name as reporting_to_office_short_name')
                ->leftJoin('erp_office as reporting_to', 'erp_office.repoting_to_office', '=', 'reporting_to.office_id')
                ->where('erp_office.office_id', $Officeid)
                ->orderBy('erp_office.office_id', 'ASC')
                ->get();
        } else {
            $OfficeData = AgmOffice::select('erp_office.*', 'reporting_to.office_name as reporting_to_office_name', 'reporting_to.office_short_name as reporting_to_office_short_name')
                ->leftJoin('erp_office as reporting_to', 'erp_office.repoting_to_office', '=', 'reporting_to.office_id')
                ->orderBy('erp_office.office_id', 'ASC')
                ->get();
        }
        return $OfficeData;        
    }
    public function ShowEmpHead($request,$EmpNo) { 
        $OfficeData = NULL;
        if($EmpNo != NULL){
            $OfficeData = AgmOffice::where('head',$EmpNo)->where('active',1)->get();
        }
        return $OfficeData; 

    }
     public function ShowAllParentChild(){
        $officeHeads = DB::select("
            WITH RECURSIVE category_tree AS (
                SELECT 
                    office_id,
                    repoting_to_office,
                    office_name,
                    office_name::text AS full_heads
                FROM erp_office
                WHERE repoting_to_office = 0

                UNION ALL

                SELECT 
                    c.office_id,
                    c.repoting_to_office,
                    c.office_name,
                    ct.full_heads || ' / ' || c.office_name
                FROM erp_office c
                JOIN category_tree ct 
                ON c.repoting_to_office = ct.office_id
            )

            SELECT ct.office_id, ct.full_heads
            FROM category_tree ct
            WHERE NOT EXISTS (
                SELECT 1 
                FROM erp_office c
                WHERE c.repoting_to_office = ct.office_id
            )
            ORDER BY ct.full_heads
        ");

        return $officeHeads;
    }


}
