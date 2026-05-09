<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpDocuments extends Model
{
    use HasFactory;
    protected $table = 'erp_emp_documents';
    public $timestamps = false;
    protected $primaryKey = 'emp_document_id';
    protected $fillable = [
        'emp_document_type_id',
        'doc_file_name',
        'doc_file_name_actual',
        'doc_description',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'emp_no'
    ];
    public function ShowDocuments()
    {
        return self::get();        
    }
    public function createDocuments($EmployeeArr){
        return self::create($EmployeeArr);
    }
    public function updateDocuments($DocumentArr,$DocumentId){
        return self::where('emp_document_id', $DocumentId)->Update($DocumentArr);
    }
    public function DeleteDocuments($EmpNo,$DocumentTypeId){
        return self::where('emp_no',$EmpNo)->where('emp_document_type_id',$DocumentTypeId)->delete();
    }
    
    /*public function CheckDesign($AAIISDesign){
        if($AAIISDesign != NULL){
            return designation::select('designation_name')->where('designation_name',$AAIISDesign)->get();
        }else{
            return designation::select('designation_name')->get();
        }
    }*/
}
