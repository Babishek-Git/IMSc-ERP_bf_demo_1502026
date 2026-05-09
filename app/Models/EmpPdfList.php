<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpPdfList extends Model
{
    use HasFactory;
    protected $table = 'erp_emp_pdflist';
    public $timestamps = false;
    protected $primaryKey = 'emp_pdf_id';
    public $incrementing = false;   
    protected $keyType = 'string'; 
    protected $fillable = [
        'emp_pdf_name',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];

    public function ShowPdflist($PdfId)
    {
        if($PdfId != NULL){
            return EmpPdfList::where('emp_pdf_id',$PdfId)->get();
        }else{
            return EmpPdfList::orderBy('emp_pdf_id', 'asc')->get();
        }
    }
    
}
