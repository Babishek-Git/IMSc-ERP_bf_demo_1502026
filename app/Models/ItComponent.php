<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class ItComponent extends Model
{
    use HasFactory;
	protected $table = 'erp_it_component';
	public $timestamps = false;
    protected $primaryKey = 'it_component_id';
    protected $fillable = [
        'it_component_code',
        'it_component_name',
        'it_component_mode',
        'it_component_value',
        'it_regime',
        'active'
    ];
    public function CreateItComponent($InsertArr){
        return self::create($InsertArr);
    }
    public function ShowItComponent() {
        return self::where('active',1)->get() ;
    } 
}
