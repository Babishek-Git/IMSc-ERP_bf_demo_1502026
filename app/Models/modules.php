<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modules extends Model
{
    use HasFactory;
	protected $table = 'erp_modules';
	public $timestamps = false;
    protected $primaryKey = 'moduleid';
    protected $fillable = [
        'module_name',
        'module_code',
        'parentid',
        'menu_icon',
        'menu_url',
        'is_navibar',
        'actions',
        'active',
        'menu_type',
        'dp_order',
        'page_code'
    ];
    public function childs() {
        return $this->hasMany('App\Models\modules','parentid','moduleid') ;
    }
	public function ShowModules($request,$ModuleIdArr){
        //return modules::where('is_navibar','Y')->whereNotNull('actions')->get();
        if($ModuleIdArr != NULL){
            return modules::where('is_navibar','Y')->whereIn('moduleid', $ModuleIdArr)->orderBy('parentid','asc')->orderBy('dp_order','asc')->get();
        }else{
            return modules::where('is_navibar','Y')->orderBy('parentid','asc')->orderBy('dp_order','asc')->where('active', 1)->get();
        }
    }
    public function ShowGrandParent($request){
        return modules::where('parentid', 0)->orderBy('moduleid', 'asc')->get();
        //dd($SelectQuery);
    }
    public function GetModule($GroupId){
        return modules::where('parentid', $GroupId)->where('active', 1)->orderBy('moduleid', 'asc')->get();
    }
    public function InsertData($InsertArr){
        return modules::create($InsertArr);
    }
    public function ShowModuleList($ModuleId){
        if($ModuleId != NULL){
            $ModuleData = modules::where('moduleid', $ModuleId)->orderby('moduleid','ASC')->get();
        }else{
            $ModuleData = modules::orderby('moduleid','ASC')->where('active', 1)->get();
        }
        return $ModuleData;        
    }
    public function UpdateModule($ModuleArr, $ModuleId){
        return modules::where('moduleid', $ModuleId)->update($ModuleArr);
    }
}
