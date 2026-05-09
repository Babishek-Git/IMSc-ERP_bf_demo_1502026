<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class Recovery extends Model
{
    use HasFactory;
    protected $table = 'erp_recovery';
    public $timestamps = false;
    protected $primaryKey = 'recovery_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'recovery_name',
        'recovery_code',
        'active'
    ];

    public function ShowRecovery(){
        return self::where('active', 1)->get();     
    }

}