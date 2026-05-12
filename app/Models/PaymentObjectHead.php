<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class PaymentObjectHead extends Model
{
    use HasFactory;
    protected $table = 'erp_payment_object_head';
    public $timestamps = false;
    protected $primaryKey = 'payment_oh_id';
    protected $fillable = [
        'payment_id',
        'ledger_id',
        'object_head_id',
        'ohl_mapping_id',
        'payment_oh_amount',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'ledger_group_id',
        'gia_id',
        'project_id',
        'object_head_sub_cata_id',
        'parent_project_id'
    ];
    public static function CreatePaymentObjectHead($SaveData){
        return self::create($SaveData);
    }
    public static function UpdatePaymentObjectHead($SaveData,$PaymentObjectHeadId){
        return self::where('payment_oh_id',$PaymentObjectHeadId)->update($SaveData);
    }
    public static function DeletePaymentObjectHead($PaymentId){
        return self::where('payment_id',$PaymentId)->delete();
    }
    
    public static function ShowPaymentObjectHead($PaymentId){
        if($PaymentId != NULL){
            return self::where('active',1)->where('payment_id',$PaymentId)->get();
        }else{
            return self::where('active',1)->get();
        }
    }
    public static function ShowMultiplePaymentObjectHead($PaymentIdArr){
        return self::where('active',1)->whereIn('payment_id',$PaymentIdArr)->get();
    }
    public static function ShowAPexProjectObjectHeadExpenditure($StartDate,$EndDate){
        $data = DB::table('erp_payment_object_head as poh')
            ->join('erp_payment as p', 'p.payment_id', '=', 'poh.payment_id')
            //->whereBetween('p.voucher_dt', ['2026-01-01', '2026-01-31'])
            ->whereDate('p.voucher_dt', '<=', $EndDate)
            ->select(
                'poh.gia_id',
                'poh.object_head_id',
                'poh.object_head_sub_cata_id',
                'poh.parent_project_id',
                DB::raw('SUM(poh.payment_oh_amount) as total_amount')
            )
            ->groupBy(
                'poh.gia_id',
                'poh.object_head_id',
                'poh.object_head_sub_cata_id',
                'poh.parent_project_id'
            )
            ->get();
        return $data;
    }
    public static function ShowSubProjectObjectHeadExpenditure($StartDate,$EndDate){
        $data = DB::table('erp_payment_object_head as poh')
            ->join('erp_payment as p', 'p.payment_id', '=', 'poh.payment_id')
            //->whereBetween('p.voucher_dt', ['2026-01-01', '2026-01-31'])
            ->whereDate('p.voucher_dt', '<=', $EndDate)
            ->select(
                'poh.gia_id',
                'poh.object_head_id',
                'poh.object_head_sub_cata_id',
                'poh.parent_project_id',
                'poh.project_id',
                DB::raw('SUM(poh.payment_oh_amount) as total_amount')
            )
            ->groupBy(
                'poh.gia_id',
                'poh.object_head_id',
                'poh.object_head_sub_cata_id',
                'poh.parent_project_id',
                'poh.project_id'
            )
            ->get();
        return $data;
    }
}
