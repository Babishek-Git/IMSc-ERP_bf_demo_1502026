<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportingDocument extends Model
{
    use HasFactory;
    protected $table      = 'erp_supp_doc';
    public $timestamps    = false;
    protected $primaryKey = 'sup_doc_id';
    protected $fillable   = [
        'transaction_id',
        'module_code',
        'doc_desc',
        'org_file_name',
        'file_name',
        'doc_date',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'module_sub_code'
    ];
    public static function SupportingDocCreate($SaveData){
        return self::create($SaveData);
    }
    public static function GetSancationDocData($TransId,$ModuleCode){
        if($TransId != '' && $ModuleCode !== ''){
            return self::where('transaction_id',$TransId)->where('module_code',$ModuleCode)->where('active',1)->get();
        }
    }
    public static function GetSancationDocUploadData($ModuleCode){
        return self::where('module_code',$ModuleCode)->where('active',1)->get();
    }
    public static function GetSuppDocDownloadData($SupDocId,$ModuleCode){
        if($SupDocId != '' && $ModuleCode !== ''){
            return self::where('sup_doc_id',$SupDocId)->where('module_code',$ModuleCode)->where('active',1)->get();
        }
    }
    public static function GetDocDetailsBySubModuleCode ($TransId,$ModuleCode,$SubModuleCode){
         if($TransId != '' && $ModuleCode !== '' && $SubModuleCode != ''){
            return self::where('transaction_id',$TransId)->where('module_code',$ModuleCode)->where('module_sub_code',$SubModuleCode)->where('active',1)->get();
        }
    }
}
