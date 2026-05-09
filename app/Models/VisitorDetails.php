<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorDetails extends Model
{
    use HasFactory;
    protected $table = 'erp_visitor_details';
    public $timestamps = false;
    protected $primaryKey = 'visitor_id';
    protected $fillable = [
        'visitor_emp_no',
        'visitor_catagory_id',
        'visitor_institue',
        'visitor_purpose',
        'inviting_faculty_id',
        'visit_from_date',
        'visit_to_date',
        'active',
        'created_at',
        'created_by'
    ];

    public function createVisitor($VisitorArr){
        return self::create($VisitorArr);
    }
}
