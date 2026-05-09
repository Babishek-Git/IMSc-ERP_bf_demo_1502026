<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class DocumentsType extends Model
{
    use HasFactory;
    protected $table = 'erp_document_types';
    public $timestamps = false;
    protected $primaryKey = 'document_type_id';
    protected $fillable = [
        'document_type_code',
        'document_type_name',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public static function ShowDocumentTypeByCode($DocTypeCode){
        return self::where('document_type_code',$DocTypeCode)->get();
    }
    public function createDocumentsType($EmployeeArr){
        return self::create($EmployeeArr);
    }
    public function updateDocumentsType($DocumentArr,$DocumentTypeId){
        return self::where('document_type_id', $DocumentTypeId)->Update($DocumentArr);
    }
 
    
    /*public function CheckDesign($AAIISDesign){
        if($AAIISDesign != NULL){
            return designation::select('designation_name')->where('designation_name',$AAIISDesign)->get();
        }else{
            return designation::select('designation_name')->get();
        }
    }*/
}
