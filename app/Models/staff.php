<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class staff extends Model
{
    use HasFactory;
	protected $table = 'erp_staff';
    public $timestamps = false;
    protected $primaryKey = 'staffid';
    protected $fillable = [
        'staffcode',
        'staff_unit',
        'staff_emp_no',
        'staffname',
        'email',
        'designationid',
        'designation_name',
        'sub_sec_id',
        'discipline_id',
        'mobile',
        'intercom',
        'doj',
        'dob',
        'sectionid',
        'section_name',
        'sroleid',
        'srole_name',
        'levelid',
        'active',
        'image',
        'userid',
        'useracc',
        'temp_flag',
        'dedicated_to'         
    ];
    public function ShowStaffData($Join)
    {
        if($Join == "A")
        {
            return DB::table('erp_staff')
            ->select('erp_staff.*','erp_staffrole.*')
            ->join('erp_staffrole','erp_staff.sroleid', '=', 'erp_staffrole.sroleid')
            ->get();
        }
        else{
            return staff::where('active','=',1)->where('sectionid','!=','2')->get();
        }       

        
    }
		
}
