<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class BudgetSanction extends Model
{
    use HasFactory;
    protected $table = 'erp_budget_sanction';
    public $timestamps = false;
    protected $primaryKey = 'budget_sanction_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'budget_sanction_title',
        'budget_sanction_no',
        'budget_sanction_amt',
        'budget_sanction_date',
        'sanction_category',
        'internal_external',
        'sanction_type',
        'gia_id',
        'project_id',
        'sub_project_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'fin_year',
        'active'
    ];

    public function ShowDaeSanction(){
        return self::where('sanction_category', 'DAE')->get();     
    }

    public function ShowApexSanction(){
        return self::where('sanction_category', 'APEX')->get();     
    }

    public function ShowExternalSanction(){
        return self::join('erp_project','erp_project.project_id','=','erp_budget_sanction.project_id')->where('erp_budget_sanction.active',1)->where('erp_budget_sanction.sanction_category', 'EXT')->get();     
    }

    public function CreateBudgetSanction($SancArr){
        return self::create($SancArr);
    }

    public static function ShowBudgetSanactionByProjId($request,$ProjectId){
        $RetSanData = NULL;
        if(filled($ProjectId)){
            $RetSanData = BudgetSanction::where('project_id',$ProjectId)->get();
        }
        return $RetSanData;
    }
}