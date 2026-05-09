<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class TaxRate extends Model
{
    use HasFactory;
	protected $table = 'erp_tax_rate';
	public $timestamps = false;
    protected $primaryKey = 'tax_id';
    protected $fillable = [
        'tax_name',
        'tax_rate',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public function ShowTaxRate() {
        return self::get() ;
    }
    
}
