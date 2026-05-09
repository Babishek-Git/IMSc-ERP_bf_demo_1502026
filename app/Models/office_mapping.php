<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class office_mapping extends Model
{
    use HasFactory;
    protected $table = 'erp_office_mapping';
    public $timestamps = false;
    protected $primaryKey = 'omapid';
    protected $fillable = [
        'office_id',
        'office_type',
        'office_map_to',
        'office_type_map_to',
        'is_accounts_mapping',
        'active',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
    public function ShowMappingOffice($OfficeId,$OfficeMapToId){
        $OfficeData = NULL;
        $OfficeData = office_mapping::where('active',1)->orderby('omapid','ASC')->get();
        return $OfficeData;
    }
    public function ShowMappingOfficeData($OfficeId, $OfficeMapToId) {
        $OfficeData = NULL;
        
        $OfficeData = office_mapping::where(function ($query) {
            $query->where('active', 1)
                  ->orWhere('active', 0);
        });
    
        if ($OfficeMapToId != NULL) {
            $OfficeData->where('omapid', $OfficeMapToId);
        }
    
        $ReturnData = $OfficeData->orderBy('omapid', 'ASC')->get();
        return $ReturnData;
    }
    public function CreateOfficeMapping($request, $OfficeMapArr){
        return office_mapping::create($OfficeMapArr);
    }
    public function UpdateOfficeMapping($OfficeMapArr, $OfficeMapToId){
        return office_mapping::where('omapid', $OfficeMapToId)->update($OfficeMapArr);
    }
    public function CheckOfficeMapping($checkOfficeMapArr){
        return office_mapping::select('office_id', 'office_map_to')
            ->whereRaw("CAST(office_id AS TEXT) ~* ?", [$checkOfficeMapArr['office_id']])  
            ->whereRaw("CAST(office_map_to AS TEXT) ~* ?", [$checkOfficeMapArr['office_map_to']])
            ->get();
    }
    public function CheckOfficeMappingUpdate($checkOfficeMapArr,$OMAPId){
        return office_mapping::select('office_id', 'office_map_to')
            ->where('omapid','!=',$OMAPId)
            ->whereRaw("CAST(office_id AS TEXT) ~* ?", [$checkOfficeMapArr['office_id']])  
            ->whereRaw("CAST(office_map_to AS TEXT) ~* ?", [$checkOfficeMapArr['office_map_to']])
            ->get();
    }
    public function ShowAccountsMappedOffice($OfficeMapToId){
        $OfficeData = NULL;
        $OfficeData = office_mapping::where('active',1)->where('office_map_to', $OfficeMapToId)->get();
        dd($OfficeData);
        return $OfficeData;
    }
}
