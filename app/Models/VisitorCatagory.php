<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorCatagory extends Model
{
    use HasFactory;
    protected $table = 'erp_visitor_catagory';
    public $timestamps = false;
    protected $primaryKey = 'visitor_cata_id';
    protected $fillable = [
        'visit_cata_name',
        'per_day_fee',
        'active',
        'created_at',
        'created_by',
        'updated_by',
        'updated_at'
    ];

    public function ShowVisitorCatagory()
    {
        $VisitorData = self::where('active',1)->orderBy('visit_cata_name', 'asc')->get();

        return $VisitorData;        
    }
}
