<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class ExternalSanction extends Model
{
    use HasFactory;
    protected $table = 'erp_external_sanction_master';
    public $timestamps = false;
    protected $primaryKey = 'external_sanction_id';
    protected $fillable = [
        'external_sanction_amount',
        'external_sanction_date',
        'external_sanction_no',
        'project_id',
        'sanction_type',
        'sub_project_id',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public function ShowExternalSanction(){
        return self :: get();        
    }
    public function CreateExternalSanction($SancArr){
        return self::create($SancArr);
    }

}
        