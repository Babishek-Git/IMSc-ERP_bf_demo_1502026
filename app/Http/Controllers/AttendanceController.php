<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\AemEmployee;
use App\Models\AgmOffice;
use App\Models\DesignationMaster;
use App\Models\organization;
use App\Models\EmployeeCategory;
use App\Models\EmployeeSalute;
use App\Models\EmployeeMaritalStatus;
use App\Models\EmployeeGroupMaster;
use App\Models\Role;
use App\Models\LeaveType;
use App\Models\EmployeeAttendanceMaster;
use App\Models\EmployeeAttendanceDt;
use App\Models\LeaveApplicationDt;
use Helper;
use DB;
use Session;
class AttendanceController extends Controller
{   
    public function __construct(){ 
        $this->Employee = new AemEmployee();
        $this->EmpAttendanceMaster = new EmployeeAttendanceMaster();
        $this->EmpAttendanceDt = new EmployeeAttendanceDt();
        $this->EmployeeGroupMaster = new EmployeeGroupMaster();
        $this->LeaveApplicationDt = new LeaveApplicationDt();
        $this->LeaveType = new LeaveType();
    }
    public function ManualAttendance(Request $request)
    {   
        if(isset($request->btn_save_attendance)){  
            $PayRollYear            = $request->txt_float_pay_year;
            $PayRollMonth           = $request->txt_float_pay_month; 
            $PayRollMonthYear       = $request->txt_float_pay_month_yr; 
            $WorkingDays            = $request->txt_float_working_days;
            $SaveIcNoList           = $request->txt_float_icno;
            $SavePresentDaysList    = $request->txt_float_present;
            $SaveAbsentDaysList     = $request->txt_float_absent;
            $SaveLeaveList          = $request->txt_float_leave;
            $SaveLeaveTypeList      = $request->cmb_float_leave_type;
            $SaveHalfDaysList       = $request->txt_float_half_day;
            $SavePayCalcDaysList    = $request->txt_float_pay_calc_days;
            $SaveAttendRemarksList  = $request->txt_float_remarks;
            $SaveEmpWorkingDaysList = $request->txt_float_emp_working_days;
            $SaveEmpLeaveDataList   = $request->txt_float_leave_data;
            $SaveEmpGroupType       = $request->txt_float_emp_group_type;

            
            try {
                $EmpGroupType = decrypt($SaveEmpGroupType);
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) { 
                $message = 'Invalid Access';
                Session::put('ALertMesage', $message);
                return redirect()->route('attendance.ManualAttendance');
            }
            $EmpGroupTypeArr = [$EmpGroupType];//explode(",",$EmpGroupType);

            if(($SaveIcNoList != NULL)&&($SaveIcNoList != "")){
                $SaveIcNoList = json_decode($SaveIcNoList);
                //$SaveIcNoList = collect($SaveIcNoList)->toArray();
            }else{
                $SaveIcNoList = [];
            }

            if(($SavePresentDaysList != NULL)&&($SavePresentDaysList != "")){
                $SavePresentDaysList = json_decode($SavePresentDaysList);
                //$SavePresentDaysList = collect($SavePresentDaysList)->toArray();
            }else{
                $SavePresentDaysList = [];
            }

            if(($SaveAbsentDaysList != NULL)&&($SaveAbsentDaysList != "")){
                $SaveAbsentDaysList = json_decode($SaveAbsentDaysList);
                //$SaveAbsentDaysList = collect($SaveAbsentDaysList)->toArray();
            }else{
                $SaveAbsentDaysList = [];
            }

            if(($SaveLeaveList != NULL)&&($SaveLeaveList != "")){
                $SaveLeaveList = json_decode($SaveLeaveList);
                //$SaveLeaveList = collect($SaveLeaveList)->toArray();
            }else{
                $SaveLeaveList = [];
            }

            if(($SaveLeaveTypeList != NULL)&&($SaveLeaveTypeList != "")){
                $SaveLeaveTypeList = json_decode($SaveLeaveTypeList);
                //$SaveLeaveTypeList = collect($SaveLeaveTypeList)->toArray();
            }else{
                $SaveLeaveTypeList = [];
            }

            if(($SaveHalfDaysList != NULL)&&($SaveHalfDaysList != "")){
                $SaveHalfDaysList = json_decode($SaveHalfDaysList);
                //$SaveHalfDaysList = collect($SaveHalfDaysList)->toArray();
            }else{
                $SaveHalfDaysList = [];
            }

            if(($SavePayCalcDaysList != NULL)&&($SavePayCalcDaysList != "")){
                $SavePayCalcDaysList = json_decode($SavePayCalcDaysList);
                //$SavePayCalcDaysList = collect($SavePayCalcDaysList)->toArray();
            }else{
                $SavePayCalcDaysList = [];
            }

            if(($SaveAttendRemarksList != NULL)&&($SaveAttendRemarksList != "")){
                $SaveAttendRemarksList = json_decode($SaveAttendRemarksList);
                //$SaveAttendRemarksList = collect($SaveAttendRemarksList)->toArray();
            }else{
                $SaveAttendRemarksList = [];
            }

            if(($SaveEmpWorkingDaysList != NULL)&&($SaveEmpWorkingDaysList != "")){
                $SaveEmpWorkingDaysList = json_decode($SaveEmpWorkingDaysList);
                //$SaveEmpWorkingDaysList = collect($SaveEmpWorkingDaysList)->toArray();
            }else{
                $SaveEmpWorkingDaysList = [];
            }

            if(($SaveEmpLeaveDataList != NULL)&&($SaveEmpLeaveDataList != "")){
                $SaveEmpLeaveDataList = json_decode($SaveEmpLeaveDataList);
                //$SaveEmpLeaveDataList = collect($SaveEmpLeaveDataList)->toArray();
            }else{
                $SaveEmpLeaveDataList = [];
            }
            //dd($SaveEmpLeaveDataList);
            

            
            DB::beginTransaction();
            try {
                $AttendanceData = EmployeeAttendanceMaster::where('payroll_year',$PayRollYear)->where('payroll_month',$PayRollMonth)->where('emp_group_type',$EmpGroupType)->get();
                $AttendanceId = collect($AttendanceData)->pluck('attendance_master_id')->first();
                if(filled($AttendanceId)){
                    $DelEmpNoData = $this->Employee->ShowEmployeeByEmpGrpArr($EmpGroupTypeArr);
                    $DelEmpNoList = filled($DelEmpNoData) ? $DelEmpNoData->pluck('emp_no')->toArray() : [];

                    EmployeeAttendanceDt::where('attendance_master_id',$AttendanceId)->whereIn('emp_no',$DelEmpNoList)->delete();
                    EmployeeAttendanceMaster::where('attendance_master_id',$AttendanceId)->delete();
                }
                if(($SaveIcNoList != NULL)&&($SaveIcNoList != '')){
                    $SaveMastArr['payroll_year']            = $PayRollYear;
                    $SaveMastArr['payroll_month']           = $PayRollMonth;
                    $SaveMastArr['payroll_month_year']      = $PayRollMonthYear;
                    $SaveMastArr['attendance_generate_dt']  = NOW();
                    $SaveMastArr['attendance_generate_by']  = session('WcmsEmpNo');
                    $SaveMastArr['total_working_days']      = $WorkingDays;
                    $SaveMastArr['active']                  = 1;
                    $SaveMastArr['created_at']              = NOW();
                    $SaveMastArr['created_by']              = session('WcmsEmpNo'); 
                    $SaveMastArr['emp_group_type']          = $EmpGroupType; 
                    /*if(filled($AttendanceId)){
                        $MastData = $this->EmpAttendanceMaster->updateEmployeeAttendanceMaster($SaveMastArr,$AttendanceId);
                        $AttedenceNewId = $AttendanceId;
                    }else{
                        $MastData = $this->EmpAttendanceMaster->createEmployeeAttendanceMaster($SaveMastArr);
                        $AttedenceNewId = $MastData->attendance_master_id;
                    }*/
                    $MastData = $this->EmpAttendanceMaster->createEmployeeAttendanceMaster($SaveMastArr);
                    $AttedenceNewId = $MastData->attendance_master_id;
                    
                    //dd($SaveEmpWorkingDaysList);
                    foreach($SaveIcNoList as $SaveIcNoKey => $SaveIcNo){
                        $EmpWorkingDay  = $SaveEmpWorkingDaysList[$SaveIcNoKey];
                        $PresentDay     = $SavePresentDaysList[$SaveIcNoKey];
                        $AbsentDay      = NULL;//$SaveAbsentDaysList[$SaveIcNoKey];
                        $Leave          = $SaveLeaveList[$SaveIcNoKey];
                        $LeaveType      = NULL;//$SaveLeaveTypeList[$SaveIcNoKey];
                        $HalfDay        = NULL;//$SaveHalfDaysList[$SaveIcNoKey];
                        $PayCalcDay     = $SavePayCalcDaysList[$SaveIcNoKey];
                        $Remarks        = $SaveAttendRemarksList[$SaveIcNoKey];
                        $LeaveData      = $SaveEmpLeaveDataList[$SaveIcNoKey];
                        if($Remarks == ''){
                            $Remarks = NULL;
                        }
                        $SaveArr['attendance_master_id'] = $AttedenceNewId;
                        $SaveArr['emp_no']          = $SaveIcNo;
                        $SaveArr['days_present']    = $PresentDay;
                        $SaveArr['days_absent']     = $AbsentDay;
                        $SaveArr['days_leave']      = $Leave;
                        $SaveArr['leave_type']      = $LeaveType;
                        $SaveArr['days_half']       = $HalfDay;
                        $SaveArr['days_pay_calc']   = $PayCalcDay;
                        $SaveArr['remarks']         = $Remarks;
                        $SaveArr['emp_working_days']= $EmpWorkingDay;
                        $SaveArr['leave_data']      = json_encode($LeaveData);
                        $SaveArr['active']          = 1;
                        $SaveArr['created_at']      = NOW();
                        $SaveArr['created_by']      = session('WcmsEmpNo');  //dd($SaveArr);
                        $this->EmpAttendanceDt->createEmployeeAttendanceDt($SaveArr);
                    }
                }
                DB::commit();
                $message = "Attendance details saved"; 
            
            } catch (\Exception $e) {  dd($e);
                $message = "Error : Attendance details not saved. Please try again"; 
            }
            //dd($message);
            Session::put('ALertMesage', $message);
            return redirect()->route('attendance.ManualAttendance');
        }
        //dd(1);
        if(isset($request->btn_initiate)){  
            $PayGenYear = $request->cmb_pay_year; 
            $PayGenMonth = $request->cmb_pay_month; 
            $EmpGroup = $request->ch_emp_group;
            $EmpGroupArr = [$EmpGroup];
            $EmpGroupStr = implode(",",$EmpGroupArr);
            $EmployeeList    = $this->Employee->ShowMultipleEmployeesWithEmpGroup($EmpGroupArr); 
            $AttendancePeriod = Helper::GetStartDateEndDateFromMonth($PayGenMonth,$PayGenYear); 
            $AttendanceFDate = $AttendancePeriod['StartDate']; 
            $AttendanceTDate = $AttendancePeriod['EndDate']; 
            $LeaveData = $this->LeaveApplicationDt->ShowLeaveForAttendance($AttendanceFDate,$AttendanceTDate);  
            $ParamArr = ['FromDate'=>$AttendanceFDate,'ToDate'=>$AttendanceTDate,'LeaveData'=>$LeaveData];
            $AttendanceLeaveData = Helper::GetActualLeaveDaysForAttendanceCalc($ParamArr); 
            $EmpAttendanceLeaveData = collect($AttendanceLeaveData ?? [])->groupBy('emp_no');
            $LeaveTypeIdArr = collect($AttendanceLeaveData ?? [])->pluck('leave_type_id')->toArray();
            //$HalfPayLeaveData = $AttendanceLeaveData->where('leaveType.leave_type_code', 'HPL'); To get Specific leave type using field available in relations
            $LeaveTypeData = $this->LeaveType->ShowMultipleLeaveType($LeaveTypeIdArr);
            $WorkingDayData = Helper::GetActualWorkingDaysInMonth($PayGenMonth,$PayGenYear); 
            return view('attendance.manual-attendance-entry')->with('data',compact('EmployeeList','PayGenYear','PayGenMonth','EmpAttendanceLeaveData','LeaveTypeData','WorkingDayData','EmpGroupStr'));  
        }
        $employeeGroupMaster= $this->EmployeeGroupMaster->ShowEmployeeGroup(NULL);  
        return view('attendance.manual-attendance-entry-initiate')->with('data', compact(var_name: 'employeeGroupMaster'));
    }  
}
