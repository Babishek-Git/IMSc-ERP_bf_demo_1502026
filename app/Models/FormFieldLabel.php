<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class FormFieldLabel extends Model
{
    use HasFactory;
    protected $table = 'erp_form_field_label';
    public $timestamps = false;
    protected $primaryKey = 'field_label_id';
    protected $fillable = [
        'field_code',
        'field_name',
        'field_label_display',
        'emp_group_id'
    ];

    public static function getAllFieldLabel($GroupId)
    {
        if($GroupId != NULL){
            $LabelData = self::where('emp_group_id',$GroupId)->get();
        }else{
            $LabelData = self::get();
        }

        return $LabelData;     
    } 

    public static function getFieldLabel($fieldCode, $groupId, $default)
    {
        $label = self::where('field_code', $fieldCode)->where('emp_group_id', $groupId)->first();

        return $label ? $label->field_label_display : $default;
    } 

}