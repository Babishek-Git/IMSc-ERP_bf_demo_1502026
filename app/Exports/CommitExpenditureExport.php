<?php
  
namespace App\Exports;
  
use App\Models\workorder;
use App\Models\commit_exp_master;
use App\Models\commit_exp_dt;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Support\Collection;
use Carbon\Carbon;
  
class CommitExpenditureExport implements FromCollection, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;

    function __construct($id) {
            $this->id = $id;
    }
    public function registerEvents(): array {
        
        return [
            AfterSheet::class => function(AfterSheet $event) {
                /** @var Sheet $sheet */
                $sheet = $event->sheet;

                $SheetId = $this->id; 
                $workorder = new workorder();
                $WorkData = $workorder->ShowSheet(NULL, $SheetId);
                if(filled($WorkData)){
                    $GlobId             = collect($WorkData)->pluck('globid')->first();
                    $WorkOrderCost      = collect($WorkData)->pluck('work_order_cost')->first();
                    if($WorkOrderCost == NULL){
                        $WorkOrderCost = 0;
                    }
                    $sheet->setCellValue('G1', "Work Order Cost");
                    $sheet->setCellValue('G2', $WorkOrderCost);
                    $sheet->setCellValue('H1', "Comp Code No.");
                    $sheet->setCellValue('I1', "Head of Account");
                    $sheet->setCellValue('J1', "Sanctioned Cost");
                    $commit_exp_dt = new commit_exp_dt(); 
                    $HoAData = $commit_exp_dt->ShowHOADataByWorkId(NULL,$GlobId, NULL); //dd($HoAData);
                    if(filled($HoAData)){
                        $Row = 2; 
                        foreach($HoAData as $HoADataKey => $HoADataValue){
                            $Ccno       = $HoADataValue->comp_code;
                            $Hoa        = $HoADataValue->hoa;
                            $SancCost   = $HoADataValue->pres_sanc_amt;
                            $sheet->setCellValue('H'.$Row, $Ccno);
                            $sheet->setCellValue('I'.$Row, $Hoa);
                            $sheet->setCellValue('J'.$Row, $SancCost);
                            $Row++;
                        }
                    }
                }
                
                //$cellRange = 'A1:D1'; // All headers
                $event->sheet->getDelegate();//->getStyle($cellRange);//->applyFromArray($styleArray);
            },
        ];
    }
    public function collection()
    {
        
        try {   
            $SheetId = $this->id;
        }catch (\Illuminate\Contracts\Encryption\DecryptException $e) { 
            return NULL;
        }
        $data = [];
        $workorder = new workorder();
        $WorkData = $workorder->ShowSheet(NULL, $SheetId);
        if(filled($WorkData)){
            $GlobId             = collect($WorkData)->pluck('globid')->first();
            $WOCommenceDate 	= collect($WorkData)->pluck('work_commence_date')->first();
            $WOCompletionDate 	= collect($WorkData)->pluck('date_of_completion')->first();//work_orders_ext
            $WOExtensionDate 	= collect($WorkData)->pluck('work_orders_ext')->first();
            $WorkOrderCost      = collect($WorkData)->pluck('work_order_cost')->first();
            if($WorkOrderCost == NULL){
                $WorkOrderCost = 0;
            }
            
            $FromDate = $WOCommenceDate;
            if($WOExtensionDate != NULL){
                $ToDate = $WOExtensionDate;
            }else{
                $ToDate = $WOCompletionDate;
            }
            $start = Carbon::parse($FromDate);
            $end = Carbon::parse($ToDate);
            $start->day(1);
            $end->day(1);
            // Create an array to store the months
            $MonthYearArr = [];
            // Loop through all the months between the two dates
            while ($start <= $end) { 
                // Format the date as 'mm/yyyy' and 'Mon/yyyy'
                $MonthYearArr[$start->format('m/Y')] = $start->format('M/Y');
                //echo $start->format('M/Y')." = ".$end->format('M/Y')."<br/>";
                // Move to the next month
                $start->addMonth();
            }
            $commitExpMast = new commit_exp_master();
            $commit_exp_dt = new commit_exp_dt();
            $CommitExpMastData = $commitExpMast->ShowCommitExpendLastRecord($SheetId);
            $CommitExpDtGrpData = array();
            if(filled($CommitExpMastData)){
                $CommitId = $CommitExpMastData->cexpid;
                if($CommitId != NULL){
                    $CommitExpDtData = $commit_exp_dt->ShowComitExpDataById($CommitId);
                    if(filled($CommitExpDtData)){
                        $CommitExpDtGrpData = collect($CommitExpDtData)->groupBy('comp_code');
                    }
                }
            }
            $HoAData = $commit_exp_dt->ShowHOADataByWorkId(NULL,$GlobId, NULL);
            if(filled($HoAData)){
                $WoTemp = 0; 
                foreach($HoAData as $HoADataKey => $HoADataValue){
                    $Ccno       = $HoADataValue->comp_code;
                    $Hoa        = $HoADataValue->hoa;
                    $SancCost   = $HoADataValue->pres_sanc_amt;
                    $CommitExpMonthGrpData = array();
                    if(isset($CommitExpDtGrpData[$Ccno])){
                        $CommitExpCcnoData = $CommitExpDtGrpData[$Ccno];
                        if(filled($CommitExpCcnoData)){
                            $CommitExpMonthGrpData = collect($CommitExpCcnoData)->keyBy('month_year');
                        }
                    }
                    if(count($MonthYearArr) > 0){
                        foreach($MonthYearArr as $MonthYearKey => $MonthYearValue){
                            $MonthlyAmount = '';
                            if(isset($CommitExpMonthGrpData[$MonthYearKey])){
                                $CommitExpMonthData = $CommitExpMonthGrpData[$MonthYearKey];
                                $MonthlyAmount = $CommitExpMonthData->amount;
                            }
                            $data[] = [
                                'Comp. Code No.' => $Ccno,
                                'Month/Year' => $MonthYearKey,
                                'Amount' => $MonthlyAmount,
                            ];
                        }
                    }
                }
            }
            
        }
        return new Collection($data);
        //return TrEstMeas::select("m_item_no", "m_description", "m_no", "m_length", "m_breadth","m_depth","m_weight","m_dia","m_qty","unit_name")->join('erp_partab_details','erp_partab_details.partabdetid','=','erp_tr_est_meas.partabdetid')->leftJoin('erp_item_unit', 'erp_tr_est_meas.m_unit', '=', 'erp_item_unit.unitid')->where('mastid',$this->id)->get();
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["Comp. Code No.", "Month/Year", "Amount"];
    }
}