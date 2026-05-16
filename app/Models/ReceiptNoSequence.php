<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptNoSequence extends Model
{
     use HasFactory;
    protected $table = 'erp_receipt_no_seq';
    public $timestamps = false;
    protected $primaryKey = 'receiptno_id';
    protected $fillable = [
        'receiptno',
        'group_code',
        'division_code',
        'section_code',
        'active',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'starts_on',
        'closed_on',
        'action',
    ];
    public static function ReceiptNoSeq($request){
        return ReceiptNoSequence::where('active','1')->where('status','ACTIVE')->get();

    } 
}
