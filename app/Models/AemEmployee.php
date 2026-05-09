<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class AemEmployee extends Model
{
    use HasFactory;
	protected $table = 'erp_employee';
    public $timestamps = false;
    protected $primaryKey = 'emp_no';
    protected $fillable = [
        'emp_no',
        'computer_no',
        'emp_first_name',
        'emp_middle_name',
        'emp_last_name',
        'emp_name_payslip',
        'salute',
        'pao_code',
        'employee_type',
        'employee_group_type',
        'employment_type',
        'emp_dob',
        'emp_doj',
        'emp_retirement_dt',
        'group_id',
        'division_id',
        'section_id',
        'emp_designation_id',
        'emp_gender',
        'emp_category',
        'emp_marital_status',
        'emp_salute',
        'emp_off_ext_no',
        'emp_mobile',
        'emp_off_email',
        'emp_address',
        'emp_aadhaar_no',
        'emp_pan_no',
        'emp_build_loc',
        'is_phy_challange',
        'phy_challange_type',
        'phy_challange_perc',
        'is_pf_applicable',
        'pf_number',
        'is_esi_applicable',
        'esi_number',
        'is_nps_applicable',
        'pran_number',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'is_phy_challange',
        'phy_challange_type',
        'phy_challange_perc',
        'is_pf_applicable',
        'pf_number',
        'is_esi_applicable',
        'esi_number',
        'is_nps_applicable',
        'pran_number',
        'nominee_fam_det_id',
        'emp_passport_no',
        'emp_nationality',
        'emp_country',
        'emp_hometown',
        'emp_main_project_id',
        'emp_sub_project_id',
        'tax_regime',
        'is_register',
        'is_project_applicable',
        'pdf_ipdf',
        'single_dual',
        'visitor_catagory_id',
        'ic_no',
        'emp_father_name',
        'emp_mother_name',
        'emp_permanent_addres',
        'emp_personal_mail_id',
        'emp_personal_mobile_no',
        'emp_home_town_state',
        'emp_home_town_near_rail_station',
        'emp_home_town_address',
        'project_guide',
        'emp_blood_group',
        'emp_height',
        'emp_identity_mark',
<<<<<<< Updated upstream
        'emp_pdf_name'
=======
        'emp_pdf_name',
        'pfmr_id'
>>>>>>> Stashed changes
    ];
    public static function ShowEmployees($request,$EmpNo){
        $EmpQuery = DB::table('erp_employee AS t1')
            ->select('t1.*','t2.office_name AS group','t3.office_name AS division','t3.office_short_name AS division_short_name','t4.office_name AS section','t4.office_short_name AS section_short_name','t5.designation_name','t7.emp_group_name')
            ->join('erp_emp_designation AS t5','t1.emp_designation_id','=','t5.designation_id')
            ->leftjoin('erp_emp_group AS t7','t1.employee_group_type','=','t7.emp_group_id')
            ->leftJoin("erp_office AS t2",function($join){
                $join->on('t1.group_id', '=', 't2.office_id');
            })
            ->leftJoin("erp_office AS t3",function($join){
                $join->on('t1.division_id', '=', 't3.office_id');
            })
            ->leftJoin("erp_office AS t4",function($join){
                $join->on('t1.section_id', '=', 't4.office_id');
            });
        if($EmpNo != NULL){
            $EmpQuery->where('t1.emp_no',$EmpNo);
        }
        $EmpData = $EmpQuery->get(); 
        return $EmpData;
    }

    public static function showRegisteredEmp($request,$EmpNo){
        $RegEmpData = DB::table('erp_employee AS t1')
        ->select(
            't1.*',
            't2.office_name AS group',
            't3.designation_name AS designation_name',
            't4.employment_type_code As type_code')
        ->leftJoin("erp_office AS t2",function($join){
            $join->on('t1.group_id', '=', 't2.office_id');
        })->join('erp_emp_designation AS t3','t1.emp_designation_id','=','t3.designation_id')
        ->leftjoin('erp_emp_group AS t4','t1.employee_group_type','=','t4.emp_group_id');
        
        if($EmpNo != NULL){
            $RegEmpData->where('t1.emp_no',$EmpNo);
        }
        $RegEmpData = $RegEmpData->where('t4.employment_type_code','P')->where('t1.is_register',1)->where('t1.active',1)->get(); 
        
        return $RegEmpData;
    }

    public function CreateEmployee($EmpArr){
        return AemEmployee::create($EmpArr);
    }
    public function UpdateEmployee($EmpArr, $EmpNo){
        return AemEmployee::where('emp_no', $EmpNo)->update($EmpArr);
    }
    public function CheckEmployee($EmpNo){
        return AemEmployee::select('emp_no')->where('emp_no', $EmpNo)->get();
    }
    public function ShowEmployeeByEmpNoArr($EmpArr){ 
        $EmpData = NULL;
        if($EmpArr != NULL){ 
            if(count($EmpArr) > 0){ //dd($EmpArr);
                $EmpData = AemEmployee::whereIn('emp_no',$EmpArr)->where('active',1)->get();
            }
        }
        return $EmpData;
    }
   
    public function ShowEmployeeBySessionEmpNo(){ 
        $EmpQuery = DB::table('erp_employee AS t1')
            ->select('t1.*','t2.office_name AS group','t3.office_name AS division','t3.office_short_name AS division_short_name','t4.office_name AS section','t4.office_short_name AS section_short_name','t5.designation_name','t1.emp_no AS emp_no','t7.emp_group_name')
            ->join('erp_emp_designation AS t5','t1.emp_designation_id','=','t5.designation_id')
            ->leftjoin('erp_emp_group AS t7','t1.employee_group_type','=','t7.emp_group_id')
            ->leftJoin("erp_office AS t2",function($join){
                $join->on('t1.group_id', '=', 't2.office_id');
            })
            ->leftJoin("erp_office AS t3",function($join){
                $join->on('t1.division_id', '=', 't3.office_id');
            })
            ->leftJoin("erp_office AS t4",function($join){
                $join->on('t1.section_id', '=', 't4.office_id');
            });
        if(session('WcmsEmpNo') != NULL){
            $EmployeeNo=session('WcmsEmpNo');
            $EmpQuery->where('t1.emp_no',$EmployeeNo);
        }
        $EmpData = $EmpQuery->get(); 
        return $EmpData;
        //return AemEmployee::where('emp_no',session('WcmsEmpNo'))->where('active',1)->get();
    }
    public function ShowEmployeesByMaritalStatus($request,$EmpNo)
    {
         $EmpQuery = DB::table('erp_employee AS t1')
            ->select('t1.*','t2.office_name AS group','t3.office_name AS division','t3.office_short_name AS division_short_name','t4.office_name AS section','t4.office_short_name AS section_short_name','t5.designation_name')
            ->join('erp_emp_designation AS t5','t1.emp_designation_id','=','t5.designation_id')
            ->leftJoin("erp_office AS t2",function($join){
                $join->on('t1.group_id', '=', 't2.office_id');
            })
            ->leftJoin("erp_office AS t3",function($join){
                $join->on('t1.division_id', '=', 't3.office_id');
            })
            ->leftJoin("erp_office AS t4",function($join){
                $join->on('t1.section_id', '=', 't4.office_id');
            })
            ->where('t1.emp_marital_status', 'U')
            ->orderBy('t1.emp_first_name');
        if($EmpNo != NULL){
            $EmpQuery->where('t1.emp_no',$EmpNo);
        }
        $MaritalData = $EmpQuery->get(); 
        return $MaritalData;
                
    }
     public function ShowEmployeeByEmpGrpArr($EmpGrpArr){ 
        $EmpData = NULL;
        if(filled($EmpGrpArr)){ 
            $EmpData = AemEmployee::whereIn('employee_group_type',$EmpGrpArr)->where('active',1)->orderBy('emp_name_payslip','ASC')->get();
        }
        return $EmpData;
     }
    public static function ShowEmployeeNames(){
        return DB::table('erp_employee')->select('emp_no', 'emp_name_payslip')->get();
    }

    public static function ShowEmployeeGuideNames($GroupType){
        return DB::table('erp_employee')->select('emp_no', 'emp_name_payslip')->where('employee_group_type',$GroupType)->get();
    }

    public static function ShowMultipleEmployees($EmpArr){
        $EmpData = DB::table('erp_employee AS t1')
            ->select('t1.*','t2.office_name AS group','t3.office_name AS division','t3.office_short_name AS division_short_name','t4.office_name AS section','t4.office_short_name AS section_short_name','t5.designation_name','t7.emp_group_name','t7.emp_group_name')
            ->join('erp_emp_designation AS t5','t1.emp_designation_id','=','t5.designation_id')
            ->leftjoin('erp_employee_bank_acc_dt AS t6','t1.emp_no','=','t6.emp_no')
            ->leftjoin('erp_emp_group AS t7','t1.employee_group_type','=','t7.emp_group_id')
            ->leftJoin("erp_office AS t2",function($join){
                $join->on('t1.group_id', '=', 't2.office_id');
            })
            ->leftJoin("erp_office AS t3",function($join){
                $join->on('t1.division_id', '=', 't3.office_id');
            })
            ->leftJoin("erp_office AS t4",function($join){
                $join->on('t1.section_id', '=', 't4.office_id');
            })->whereIn('t1.emp_no',$EmpArr)->get(); 
        return $EmpData;
    }
    public static function ShowMultipleEmployeesWithEmpGroup($EmpGroupArr){
        $EmpData = DB::table('erp_employee AS t1')
            ->select('t1.*','t2.office_name AS group','t3.office_name AS division','t3.office_short_name AS division_short_name','t4.office_name AS section','t4.office_short_name AS section_short_name','t5.designation_name')
            ->join('erp_emp_designation AS t5','t1.emp_designation_id','=','t5.designation_id')
            ->join('erp_emp_group AS t7','t1.employee_group_type','=','t7.emp_group_id')
            ->leftjoin('erp_employee_bank_acc_dt AS t6','t1.emp_no','=','t6.emp_no')
            ->leftJoin("erp_office AS t2",function($join){
                $join->on('t1.group_id', '=', 't2.office_id');
            })
            ->leftJoin("erp_office AS t3",function($join){
                $join->on('t1.division_id', '=', 't3.office_id');
            })
            ->leftJoin("erp_office AS t4",function($join){
                $join->on('t1.section_id', '=', 't4.office_id');
            })->whereIn('t1.employee_group_type',$EmpGroupArr)->get(); 
        return $EmpData;
    }
    public function ShowEmployeeForAllotment()
    {
        return DB::table('erp_employee as e')
                ->leftJoin('erp_house_master as h', 'e.emp_no', '=', 'h.emp_no')
                ->whereNull('h.emp_no')
                ->where('e.employment_type', 'P')
                ->select('e.emp_no', 'e.emp_name_payslip')
                ->get();
    }
    public static function ShowEmployeesBYEmpNo($request,$EmpNo){ // THIS FUNCTION AD BY BABI FOR INDENT CREATION ///
        $EmpData = NULL;
        if(filled($EmpNo)){
            $EmpData = AemEmployee ::where('emp_no',$EmpNo)->where('active',1)->get();
        }else{
            $EmpData = AemEmployee ::where('active',1)->get();
        }
        return $EmpData;

    }
    //This function has been moved to ReimbursementMaster Model By Mythili on 24.03.2026
    // public function ShowEmployeesByReimbursementDetail()
    // {
    // $ClaimData = DB::table('erp_employee AS t1')
    //             ->select('t1.*','t5.*','t2.*','t3.*')
    //             ->join('erp_emp_designation AS t5','t1.emp_designation_id','=','t5.designation_id')
    //             ->join('erp_reimbursement_master AS t2','t1.emp_no','=','t2.emp_no')
    //             ->join('erp_ta_reimbursement_dt AS t3','t3.reimbursement_id','=','t2.reimbursement_id')
    //             ->where('reimbursement_type_code','TA')
    //             ->get();    
    //     return $ClaimData;
    // }
    // This function has been moved to FamilyDeatils Model By Mythili on 24.03.2026
    /*public static function ShowEmployeesFamilyDetails($request,$EmpNo){
        $EmpQuery = DB::table('erp_employee AS t1')
            ->select('t1.*','t2.office_name AS group','t3.office_name AS division','t3.office_short_name AS division_short_name','t4.office_name AS section','t4.office_short_name AS section_short_name','t5.designation_name','erp_relationship_master.*','erp_dependant_master.*','t9.*')
            ->join('erp_emp_designation AS t5','t1.emp_designation_id','=','t5.designation_id')->leftjoin('erp_employee_bank_acc_dt AS t6','t1.emp_no','=','t6.emp_no')->leftJoin('erp_emp_family_details AS t9','t1.emp_no','=','t9.emp_no')
            ->leftJoin('erp_relationship_master','erp_relationship_master.relationship_id','=','t9.fam_relationship_id')->leftJoin('erp_dependant_master','erp_dependant_master.dependant_id','=','erp_relationship_master.dependant_id')
            ->leftJoin("erp_office AS t2",function($join){
                $join->on('t1.group_id', '=', 't2.office_id');
            })
            ->leftJoin("erp_office AS t3",function($join){
                $join->on('t1.division_id', '=', 't3.office_id');
            })
            ->leftJoin("erp_office AS t4",function($join){
                $join->on('t1.section_id', '=', 't4.office_id');
            });
        if($EmpNo != NULL){
            $EmpQuery->where('t1.emp_no',$EmpNo);
        }
        $EmpData = $EmpQuery->get(); 
        return $EmpData;
    } 
    public static function ShowEmployeesBYEmpNo($request,$EmpNo){
        $EmpData = NULL;
        if(filled($EmpNo)){
            $EmpData = AemEmployee ::where('emp_no',$EmpNo)->where('active',1)->get();
        }else{
            $EmpData = AemEmployee ::where('active',1)->get();
        }
        return $EmpData;

    }
    } */
    // This function has been moved to FamilyDeatils Model By Mythili on 24.03.2026
    // public function ShowEmployeebByMedicalCard(){ 
    //     $EmpQuery = DB::table('erp_employee AS t1')
    //         ->select('t1.*','t2.office_name AS group','t3.office_name AS division','t3.office_short_name AS division_short_name','t4.office_name AS section','t4.office_short_name AS section_short_name','t5.designation_name','t6.*','t7.*','t8.*','t9.*','erp_relationship_master.*','t1.emp_no AS emp_no','erp_dependant_master.*')
    //         ->join('erp_emp_designation AS t5','t1.emp_designation_id','=','t5.designation_id')->leftJoin('erp_employee_pay_level AS t6','t1.emp_no','=','t6.emp_no')->leftJoin('erp_house_master AS t7','t1.emp_no','=','t7.emp_no')->leftJoin('erp_employee_bank_acc_dt AS t8','t1.emp_no','=','t8.emp_no')
    //         ->leftJoin('erp_emp_family_details AS t9','t1.emp_no','=','t9.emp_no')->leftJoin('erp_relationship_master','erp_relationship_master.relationship_id','=','t9.fam_relationship_id')->leftJoin('erp_dependant_master','erp_dependant_master.dependant_id','=','erp_relationship_master.dependant_id')->leftJoin("erp_office AS t2",function($join){
    //             $join->on('t1.group_id', '=', 't2.office_id');
    //         })
    //         ->leftJoin("erp_office AS t3",function($join){
    //             $join->on('t1.division_id', '=', 't3.office_id');
    //         })
    //         ->leftJoin("erp_office AS t4",function($join){
    //             $join->on('t1.section_id', '=', 't4.office_id');
    //         });
    //     if(session('WcmsEmpNo') != NULL){
    //         $EmployeeNo=session('WcmsEmpNo');
    //         $EmpQuery->where('t1.emp_no',$EmployeeNo);
    //     }
    //     $EmpData = $EmpQuery->get(); 
    //     return $EmpData;
    //     //return AemEmployee::where('emp_no',session('WcmsEmpNo'))->where('active',1)->get();
    // }
    // This function has been moved to EmployeePayLevel Model By Mythili on 24.03.2026
    // public function ShowEmployeeByLtcAdvance(){ 
    //     $EmpQuery = DB::table('erp_employee AS t1')
    //         ->select('t1.*','t2.office_name AS group','t3.office_name AS division','t3.office_short_name AS division_short_name','t4.office_name AS section','t4.office_short_name AS section_short_name','t5.designation_name','t6.*','t7.*','t8.*','t1.emp_no AS emp_no')
    //         ->join('erp_emp_designation AS t5','t1.emp_designation_id','=','t5.designation_id')->leftJoin('erp_employee_pay_level AS t6','t1.emp_no','=','t6.emp_no')->leftJoin('erp_house_master AS t7','t1.emp_no','=','t7.emp_no')->leftJoin('erp_employee_bank_acc_dt AS t8','t1.emp_no','=','t8.emp_no')
    //         ->leftJoin("erp_office AS t2",function($join){
    //             $join->on('t1.group_id', '=', 't2.office_id');
    //         })
    //         ->leftJoin("erp_office AS t3",function($join){
    //             $join->on('t1.division_id', '=', 't3.office_id');
    //         })
    //         ->leftJoin("erp_office AS t4",function($join){
    //             $join->on('t1.section_id', '=', 't4.office_id');
    //         });
    //     if(session('WcmsEmpNo') != NULL){
    //         $EmployeeNo=session('WcmsEmpNo');
    //         $EmpQuery->where('t1.emp_no',$EmployeeNo);
    //     }
    //     $EmpData = $EmpQuery->get(); 
    //     return $EmpData;
    //     //return AemEmployee::where('emp_no',session('WcmsEmpNo'))->where('active',1)->get();
    // }
        // This function has been moved to FamilyDeatils Model By Mythili on 24.03.2026
    // public function ShowEmployeeBySessionEmpNoandFamilyMember(){ 
    //     $EmpQuery = DB::table('erp_employee AS t1')
    //         ->select('t1.*','t2.office_name AS group','t3.office_name AS division','t3.office_short_name AS division_short_name','t4.office_name AS section','t4.office_short_name AS section_short_name','t5.designation_name','t1.emp_no AS emp_no','t6.*','t7.*','t8.*')
    //         ->join('erp_emp_designation AS t5','t1.emp_designation_id','=','t5.designation_id')->leftJoin('erp_emp_family_details AS t6','t1.emp_no','=','t6.emp_no')
    //         ->leftJoin('erp_relationship_master As t7','t7.relationship_id','=','t6.fam_relationship_id')->leftJoin('erp_dependant_master As t8','t8.dependant_id','=','t7.dependant_id')
    //         ->leftJoin("erp_office AS t2",function($join){
    //             $join->on('t1.group_id', '=', 't2.office_id');
    //         })
    //         ->leftJoin("erp_office AS t3",function($join){
    //             $join->on('t1.division_id', '=', 't3.office_id');
    //         })
    //         ->leftJoin("erp_office AS t4",function($join){
    //             $join->on('t1.section_id', '=', 't4.office_id');
    //         });
    //     if(session('WcmsEmpNo') != NULL){
    //         $EmployeeNo=session('WcmsEmpNo');
    //         $EmpQuery->where('t1.emp_no',$EmployeeNo);
    //     }
    //     $EmpData = $EmpQuery->get(); 
    //     return $EmpData;
    //     //return AemEmployee::where('emp_no',session('WcmsEmpNo'))->where('active',1)->get();
    // }
    // This function has been moved to HouseMaster Model By Mythili on 24.03.2026
    // public function ShowEmployeeBySessionEmpNoByHouse(){ 
    //     $EmpQuery = DB::table('erp_employee AS t1')
    //         ->select('t1.*','t2.office_name AS group','t3.office_name AS division','t3.office_short_name AS division_short_name','t4.office_name AS section','t4.office_short_name AS section_short_name','t5.designation_name','t7.*','t8.*','t1.emp_no AS emp_no')
    //         ->join('erp_emp_designation AS t5','t1.emp_designation_id','=','t5.designation_id')->leftJoin('erp_house_master AS t7','t1.emp_no','=','t7.emp_no')->leftJoin('erp_employee_bank_acc_dt AS t8','t1.emp_no','=','t8.emp_no')
    //         ->leftJoin("erp_office AS t2",function($join){
    //             $join->on('t1.group_id', '=', 't2.office_id');
    //         })
    //         ->leftJoin("erp_office AS t3",function($join){
    //             $join->on('t1.division_id', '=', 't3.office_id');
    //         })
    //         ->leftJoin("erp_office AS t4",function($join){
    //             $join->on('t1.section_id', '=', 't4.office_id');
    //         });
    //     if(session('WcmsEmpNo') != NULL){
    //         $EmployeeNo=session('WcmsEmpNo');
    //         $EmpQuery->where('t1.emp_no',$EmployeeNo);
    //     }
    //     $EmpData = $EmpQuery->get(); 
    //     return $EmpData;
    //     //return AemEmployee::where('emp_no',session('WcmsEmpNo'))->where('active',1)->get();
    // }
    //Move on to EmpFamilyDetails on 24.03.2026 By Mythili
    // public function ShowEmployeeBySessionEmpNoNominee(){ 
    //     $EmpQuery = DB::table('erp_employee AS t1')
    //         ->select('t1.*','t2.office_name AS group','t3.office_name AS division','t3.office_short_name AS division_short_name','t4.office_name AS section','t4.office_short_name AS section_short_name','t5.designation_name','t1.emp_no AS emp_no','t6.*','t7.*','t8.*')
    //         ->join('erp_emp_designation AS t5','t1.emp_designation_id','=','t5.designation_id')->leftJoin('erp_emp_family_details AS t6','t1.emp_no','=','t6.emp_no')
    //         ->leftJoin('erp_relationship_master As t7','t7.relationship_id','=','t6.fam_relationship_id')->leftJoin('erp_dependant_master As t8','t8.dependant_id','=','t7.dependant_id')
    //         ->leftJoin("erp_office AS t2",function($join){
    //             $join->on('t1.group_id', '=', 't2.office_id');
    //         })
    //         ->leftJoin("erp_office AS t3",function($join){
    //             $join->on('t1.division_id', '=', 't3.office_id');
    //         })
    //         ->leftJoin("erp_office AS t4",function($join){
    //             $join->on('t1.section_id', '=', 't4.office_id');
    //         });
    //     if(session('WcmsEmpNo') != NULL){
    //         $EmployeeNo=session('WcmsEmpNo');
    //         $EmpQuery->where('t1.emp_no',$EmployeeNo);
    //     }
    //     $EmpData = $EmpQuery->get(); 
    //     return $EmpData;
    //     //return AemEmployee::where('emp_no',session('WcmsEmpNo'))->where('active',1)->get();
    // }
    public static function ShowEmployeeswithNoPFMRId($request,$EmpNo){
        $EmpQuery = DB::table('erp_employee AS t1')
            ->select('t1.*','t2.office_name AS group','t3.office_name AS division','t3.office_short_name AS division_short_name','t4.office_name AS section','t4.office_short_name AS section_short_name','t5.designation_name')
            ->join('erp_emp_designation AS t5','t1.emp_designation_id','=','t5.designation_id')
            ->leftJoin("erp_office AS t2",function($join){
                $join->on('t1.group_id', '=', 't2.office_id');
            })
            ->leftJoin("erp_office AS t3",function($join){
                $join->on('t1.division_id', '=', 't3.office_id');
            })
            ->leftJoin("erp_office AS t4",function($join){
                $join->on('t1.section_id', '=', 't4.office_id');
            });
        if($EmpNo != NULL){
            $EmpQuery->where('t1.emp_no',$EmpNo);
        }
        $EmpData = $EmpQuery->whereNull('pfmr_id')->get(); 
        return $EmpData;
    }
    public static function ShowEmployeeswithPFMRId($request,$EmpNo){
        $EmpQuery = DB::table('erp_employee AS t1')
            ->select('t1.*','t2.office_name AS group','t3.office_name AS division','t3.office_short_name AS division_short_name','t4.office_name AS section','t4.office_short_name AS section_short_name','t5.designation_name')
            ->join('erp_emp_designation AS t5','t1.emp_designation_id','=','t5.designation_id')
            ->leftJoin("erp_office AS t2",function($join){
                $join->on('t1.group_id', '=', 't2.office_id');
            })
            ->leftJoin("erp_office AS t3",function($join){
                $join->on('t1.division_id', '=', 't3.office_id');
            })
            ->leftJoin("erp_office AS t4",function($join){
                $join->on('t1.section_id', '=', 't4.office_id');
            });
        if($EmpNo != NULL){
            $EmpQuery->where('t1.emp_no',$EmpNo);
        }
        $EmpData = $EmpQuery->whereNotNull('pfmr_id')->get(); 
        return $EmpData;
    }
    
}
