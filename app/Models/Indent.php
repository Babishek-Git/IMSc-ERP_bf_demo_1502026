<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class Indent extends Model
{
    use HasFactory;
    protected $table = 'erp_indent';
    public $timestamps = false;
    protected $primaryKey = 'indent_id';
    protected $fillable = [
        'indent_no',
        'indent_date',
        'project_head',
        'emp_no',
        'group_id',
        'div_id',
        'sec_id',
        'material_category_id',
        'material_type_id',    
        'material_type_code',
        'suggested_supplier',
        'payment_term',
        'total_estimated_cost',
        'status',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'approved_by',
        'approved_dt',
        'rejected_dt',
        'from_emp_no',
        'from_role',
        'to_role',
        'is_approved',
        'target_roles',
        'to_emp_no',
        'indent_suffix_no',
        'indent_pro_name',
        'approve_auth_role',
        'is_completed',
        'project_id',
        'indent_descripton',
        'mat_type_id',
        'is_fund_availabile',
        'reg_kit',
        'object_head_id',
        'oh_sub_cata_id',
        'mat_categ_id'
    ];
    public static function ShowIndentDetails($request){
        return Indent::where('active',1)->orderby('indent_id','DESC')->get();
    }
    public function ShowIndent($request,$IndentId){
        if($IndentId!=Null){
        $IndentData = Indent::join('erp_employee','erp_indent.created_by','=','erp_employee.emp_no')->where ('indent_id',$IndentId)->get();
        }
        else{
            $IndentData = Indent::join('erp_employee','erp_indent.created_by','=','erp_employee.emp_no')->orderby('indent_id','DESC')->get();
        }
        if($IndentId != NULL){
            $IndentData->where('erp_indent.indent_id',$IndentId);
        }
        return $IndentData;  
    } 
    public function CreateIndent($IndentArr){
        return Indent::create($IndentArr);
    }
    public function UpdateIndent($IndentArr, $IndentId){
        return Indent::where('indent_id', $IndentId)->update($IndentArr);
    }
    public static function IndentMaxSuffixNo($request){
        return Indent::max('indent_suffix_no');
    }
    public static function IndentApplicationData($request,$IndentId){
        if(filled($IndentId)){
            return Indent::where('indent_id',$IndentId)->where('active',1)->get();
        }
    }
    public static function ShowApprovedIndent($request){
       // return Indent::where([['status', 'approved'], ['is_completed', 'true'],['active', 1]])->get();
        return Indent::where([
            ['status', 'approved'], 
            ['is_completed', 'true'],
            ['active', 1]
        ])
        ->whereNotIn('indent_id', function($query){ //GET INDENT ID //
            $query->select('indent_id')
                  ->from('erp_po_order')
                  ->whereNotNull('indent_id'); 
        })
        ->orderby('indent_id','DESC')
        ->get();
    }
    public static function ShowIndentSubmittedData($request){
        return Indent::where('active',1)->where('status', '!=', 'SU')->orderby('indent_id','DESC')->get();
    }
    public static function GetIndentApprovedAmoutByProjId($ProjId){
        if(filled($ProjId)){
            return self::where('project_id',$ProjId)->where('active',1)->where('status', 'approved')->where('is_completed', 'true')->get();
        }
    }
    public static function IndentApprovedData(){
        return self::where('active',1)->where('status', 'approved')->where('is_completed', 'true')->orderby('indent_id','DESC')->get();
    }
}
        