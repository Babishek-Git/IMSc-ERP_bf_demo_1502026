<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class UIConfig extends Model
{
    use HasFactory;
    protected $table = 'erp_ui_config';
    public $timestamps = false;
    protected $primaryKey = 'ui_config_id';
    protected $fillable = [
        'menu_module_code',
        'page_name',
        'config_for',
        'active',
        'menu_group_id'
    ];

    public static function getAllUIConfig($GroupId)
    {
        if($GroupId != NULL){
            $LabelData = UIConfig::where('menu_group_id', $GroupId)->get();
        }else{
            $LabelData = UIConfig::get();
        }

        return $LabelData;     
    } 

}