<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\EBCharges;
use App\Models\HouseMaster;
use App\Models\AemEmployee;
use Helper;
use DB;
use Session;
class EBChargeController extends Controller
{
    public function __construct(){
        $this->Eb        = new EBCharges();
        $this->house     = new HouseMaster();
        $this->employee  = new AemEmployee();
    }
    public function EBCharge (Request $request)
    {
        if(isset($request->btn_save))
        {
            DB::beginTransaction();
            try {
                DB::table('erp_emp_eb_charges')->where('pay_month', $request->cmb_month)->where('pay_year', $request->cmb_year)->delete();
                foreach ($request->txt_house_address as $key => $houseAddress) {

                    $saveData = [
                        'pay_month' => $request->cmb_month,
                        'pay_year' => $request->cmb_year,
                        'emp_no' => $request->txt_emp_no[$key] ?? null,
                        'eb_charge' => $request->txt_eb_charge[$key] ?? 0,
                        'lf_charge' => $request->txt_lf_charge[$key] ?? 0,
                        'wc_charge' => $request->txt_wc_charge[$key] ?? 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    $this->Eb->createEBCharges($saveData);
                }
                DB::commit();
                return redirect()->back()->with('success', 'Saved successfully');
            } catch (\Exception $e) {
                DB::rollback();
                dd($e);
                return redirect()->back()->with('error', $e->getMessage());
            }
            Session::put('ALertMesage', $message);
            return redirect()->route('EbTrariffMaster.EBTariffMaster');
        }
      
        $HouseData     = $this->house->ShowHouseMaster(null,null);
        $EbData        = $this->Eb->ShowCharges();
        $EmployeeData  = $this->employee->ShowPermenentEmployee();
        
        return view('eb-charge.eb-charge')->with('data', compact('EbData','HouseData','EmployeeData'));
    }

    public function getEmployeeDetails(Request $request)
    {
        $employee = $this->employee->join('erp_emp_designation', 'erp_emp_designation.designation_id', '=', 'erp_employee.emp_designation_id')
            ->where('erp_employee.emp_no', $request->emp_no)
            ->select(
                'erp_employee.emp_no',
                'erp_employee.emp_name_payslip',
                'erp_emp_designation.designation_name'
        )->first();

        return response()->json([
            'emp_no' => $employee->emp_no ?? '',
            'designation_name' => $employee->designation_name ?? '',
        ]);
    }
    

}
