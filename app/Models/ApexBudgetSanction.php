<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class ApexBudgetSanction extends Model
{
    use HasFactory;
    protected $table = 'erp_apex_budget_sanction';
    public $timestamps = false;
    protected $primaryKey = 'budget_sanction_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'budget_sanction_title',
        'budget_sanction_no',
        'budget_sanction_amt',
        'budget_sanction_date',
        'gia_id',
        'apex_project_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'active'
    ];

    public function ShowApexSanction(){
        return self::where('active', 1)->get();     
    }
    public function CreateApexBudgetSanction($SancDataArr){
        return self::create($SancDataArr);
    }
    public function DeleteApexSanctionByProjectId($ApexProjectId){
        return self::where('apex_project_id', $ApexProjectId)->delete();     
    }
    public function ShowApexSanctionWithActiveProject(){
        $TodateDate = date('Y-m-d');
        return self::select('erp_apex_budget_sanction.*','erp_project.*')
                    ->join('erp_project','erp_project.project_id', '=', 'erp_apex_budget_sanction.apex_project_id')
                    /*->where('erp_project.project_end_at', '>=', $TodateDate)*/
                    ->where('erp_project.active', 1)->get();     
    }

}