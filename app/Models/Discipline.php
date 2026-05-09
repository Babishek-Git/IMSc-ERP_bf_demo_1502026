<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Discipline extends Model
{
    use HasFactory;
	protected $table = 'erp_discipline';
	public $timestamps = false;
    protected $primaryKey = 'discipline_id';
    protected $fillable = [
        'discipline_name',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public function CreateDiscipline($InsertArr){
        return self::create($InsertArr);
    }
    public function ShowDiscipline() {
        return self::get() ;
    } 
}
