<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class DashboardContent extends Model
{
    use HasFactory;
    protected $table = 'erp_dashboard_content';
    public $timestamps = false;
    protected $primaryKey = 'content_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'content_code',
        'content_name',
        'content_type',
        'applicable_role',
        'redirect_url',
        'active',
        'fa_icon'
    ];

    public function ShowDashboardContentBySessionRole(){
        //return self::where('active', 1)->get();   
        $RoleId = session('WcmsEmpRoleId'); // or auth()->user()->role_id
    
        return self::where('active', 1)
            ->whereRaw('? = ANY(string_to_array(applicable_role, \',\')::int[])', [$RoleId])
            ->orderBy('content_id', 'ASC')
            ->get();  
    }

}