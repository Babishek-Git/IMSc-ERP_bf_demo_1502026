<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SequenceNo extends Model
{
    use HasFactory;
    protected $table = 'erp_seq_no';
    public $timestamps = false;
    protected $primaryKey = 'seqid';
    protected $fillable = [       
        'module_code',
        'fin_year',
        'sequence_no',
        'transaction_id',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'sub_module_code' 
    ];
    public static function ShowSequenceNoBySeqId($SeqId){
        if($SeqId != NULL){
            return self::where('active',1)->where('seqid',$SeqId)->get();
        }else{
            return NULL;
        }
    }
}
