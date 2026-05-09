<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role_master extends Model
{
    use HasFactory;
    protected $table = 'erp_role_master';
    public $timestamps = false;
    protected $primaryKey = 'role_id';
    protected $fillable = [
        'role_name',
        'role_order',
        'user_type'               
    ];
}
