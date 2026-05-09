<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'erp_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //'name',
        //'email',
        'username',
        'password',
        'emp_no',
        'isadmin',
        'issuperadmin',
        'sectionid',
        'modulerights',
        'active',
        'userid',
        'userrole',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'is_portal',
        'ic_no'
    ];
    protected $primaryKey = 'id';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Always encrypt password when it is updated.
     *
     * @param $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    public function CreateUser($request, $UserArr){
        return User::create($UserArr);
    }

    public function CheckUser($UserArr){
        return User::select('username')
        //->where('div_code',$UserArr['divcode'])
                    ->whereRaw("REGEXP_REPLACE(REGEXP_REPLACE(username, '[^a-zA-Z0-9]+', '', 'g'), ' ', '', 'g') ILIKE ?", [$UserArr['username']])  
                    ->get();
    }
    public function UpdateUser($UserArr, $Id){
        return User::where('id', $Id)->update($UserArr);
    }
    public function ShowUserList($Id){
        if($Id != NULL){
            $UserData = User::where('id', $Id)->orderby('id','ASC')->get();
        }else{
            $UserData = User::orderby('id','ASC')->where('active',1)->get();
        }
        return $UserData;        
    }
    public static function ShowAllUserList()
    {
        $UserData = DB::table('erp_users')
        ->select('erp_users.*', 'erp_employee.*','erp_users.active as usactive')
        ->join('erp_employee', function ($join) {
            $join->on(DB::raw('CASE WHEN erp_users.username ~ E\'^[0-9]+$\' THEN CAST(erp_users.username AS bigint) ELSE NULL END'), '=', 'erp_employee.emp_no');
        })
        ->orderby('erp_users.id','ASC')
        ->get();
        return $UserData;
    }
     public static function ShowAllUserWithRoleList()//Jemi
    {        
        $UserData = DB::table('erp_users AS t1')
            ->select('t1.*','t2.*','t3.role_id','t4.role_name','t5.*')
            ->join('erp_employee AS t2','t1.emp_no','=','t2.emp_no')
            ->join('erp_role_mapping AS t3','t1.emp_no','=','t3.employee_no')
            ->join('erp_role AS t4','t3.role_id','=','t4.roleid')
            ->join('erp_emp_designation AS t5','t5.designation_id','=','t2.emp_designation_id')
            ->get();
            
            //dd($UserData);
        return $UserData;
        
    } 
    
    
}