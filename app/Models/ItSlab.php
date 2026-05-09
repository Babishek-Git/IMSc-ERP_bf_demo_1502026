<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class ItSlab extends Model
{
    use HasFactory;
	protected $table = 'erp_it_slab';
	public $timestamps = false;
    protected $primaryKey = 'it_slab_id';
    protected $fillable = [
        'fin_year',
        'min_income',
        'max_income',
        'tax_rate',
        'tax_regime',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public function CreateItSlab($InsertArr){
        return self::create($InsertArr);
    }
    public function ShowItSlab($FinYear) {
        return self::where('active',1)->where('fin_year',$FinYear)->orderBy('min_income','ASC')->get() ;
    } 
}
