<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Gia extends Model
{
    use HasFactory;
	protected $table = 'erp_gia';
	public $timestamps = false;
    protected $primaryKey = 'gia_id';
    protected $fillable = [
        'gia_code',
        'gia_name',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'applicable_to'
    ];
    public function CreateGia($InsertArr){
        return self::create($InsertArr);
    }
    public function ShowGia() {
        return self::where('active',1)->get() ;
    } 
    public function ShowGiaForSanction($SanctionType) {
        $results = DB::table('erp_gia')
            ->whereRaw("? = ANY(string_to_array(applicable_to, ','))", [$SanctionType])
            ->get();

        return $results;
    } 
    public function ShowMultipleGiaById($GiaIdArr)
    {
        return self::whereIn('gia_id',$GiaIdArr)->get();
    }
}
