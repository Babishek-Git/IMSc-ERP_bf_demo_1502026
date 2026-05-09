<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class MaterialCertifySection extends Model
{
    use HasFactory;
	protected $table = 'erp_material_certify_section';
	public $timestamps = false;
    protected $primaryKey = 'certify_section_id';
    protected $fillable = [
        'office_id',
        'active',
        'created_at',
        'created_by'
    ];
    public function CreateMaterialCertifySection($InsertArr){
        return self::create($InsertArr);
    }
    public function ShowMaterialCertifySection() {
        return self::join('erp_office','erp_office.office_id','=','erp_material_certify_section.office_id')
        ->where('erp_material_certify_section.active',1)
        ->where('erp_office.active',1)
        ->orderBy('erp_office.office_name','ASC')
        ->get();
    } 
}
