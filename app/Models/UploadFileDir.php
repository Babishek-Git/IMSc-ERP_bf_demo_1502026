<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadFileDir extends Model
{
    use HasFactory;
    protected $table = 'erp_upload_file_dir';
    public $timestamps = false;
    protected $primaryKey = 'updirid';
    protected $fillable = [
        'module_code',
        'module_sub_code',
        'directory_name',
        'active'
    ];
    public function UploadFileDirectoryByCode($ModuleCode,$SubModuleCode){
        $DirectoryData = NULL;
        $DirectoryData = self::where('active',1)->where('module_code',$ModuleCode)->where('module_sub_code',$SubModuleCode)->get();
        return $DirectoryData;
    }
    public function UploadProcessFileDirectoryByCode(){
        $DirectoryData = NULL;
        $DirectoryData = self::where('active',1)
        ->where(function ($query){
            return $query->where('module_code', 'UPLOAD')
                ->orWhere('module_code', 'DOWNLOAD');
        })
        ->get(); 
        return $DirectoryData;
    }
    public function CreateUploadFileDir($request, $UploadFileDirect){ //added on 03092024
        return self::create($UploadFileDirect);
    }
    public function CheckUplFilDir($UploadFileDirect){
        return self::select('directory_name')
            ->whereRaw("REGEXP_REPLACE(REGEXP_REPLACE(directory_name, '[^a-zA-Z0-9]+', '/', 'g'), ' ', '', 'g') ILIKE ?", [$UploadFileDirect['directory_name']])
            ->get();
    }
    public function UpdateUploadFileDir($UploadFileDirect, $updirid){ 
        return self::where('updirid',$updirid)->update($UploadFileDirect);
    }
    public function CheckUploadFileDirUpdate($UploadFileDirect, $HidUpDirId){ 
        return self::select('directory_name')
            ->where('updirid', '!=', $HidUpDirId)
            ->where(function ($query) use ($UploadFileDirect) {
                $query->WhereRaw("REGEXP_REPLACE(REGEXP_REPLACE(directory_name, '[^a-zA-Z0-9]+', '/', 'g'), ' ','',  'g') ILIKE ?", [$UploadFileDirect['directory_name']]);
            })
        ->get();
    }
    public function ShowUploadFileDirectory($updirid){  //added on 03092024
        if($updirid != NULL){
            $UpdiridData = self::where('updirid', $updirid)->orderby('updirid','ASC')->get();
        }else{
            $UpdiridData = self::orderby('updirid','ASC')->where('active',1)->get();
        }
        return $UpdiridData; 
    }
}
