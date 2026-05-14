<?php
namespace App\Helpers;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\Unit;
use App\Models\mail_transaction;
use App\Models\UploadFileDir;
use App\Models\SequenceNo;
use App\Models\LogDt;
use App\Models\Holiday;
use App\Models\Payment;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use Session;
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Mail;
use App\Mail\NotifyMail;
use App\Mail\TdsIntimation;
use NumberFormatter;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Helper{

    public static function GetAutoSequenceNo($ModuleCode,$TransactionId,$SubModuleCode = NULL){
        $FinYear = Helper::GetCurrentFinYear(NULL);
        $DataArr = array();
        $DataArr['module_code']     = $ModuleCode;
        $DataArr['fin_year']        = $FinYear;
        //$DataArr['division_id']     = $DivisionId;
        $DataArr['transaction_id']  = $TransactionId;
        $DataArr['active']          = 1;
        $DataArr['created_by']      = session('WcmsEmpNo');
        $DataArr['created_at']      = NOW();
        if(isset($SubModuleCode)){
            if($SubModuleCode != NULL){
                $DataArr['sub_module_code']  = $SubModuleCode;
            }
        }
        $SeqNoData 	                = SequenceNo::create($DataArr);
        return $SeqNoData;
    }
    public static function IND_money_format($money){

        $decimal = (string)($money - floor($money));
        $money = floor($money);
        $length = strlen($money);
        $m = '';
        $money = strrev($money);
        for($i=0;$i<$length;$i++){
            if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$length){
                $m .=',';
            }
            $m .=$money[$i];
        }
        $result = strrev($m);
        $decimal = preg_replace("/0\./i", ".", $decimal);
        $decimal = substr($decimal, 0, 3);
        if( $decimal != '0'){
        $result = $result.$decimal;
        }
        return $result;
    }
    public static function RupeesInWords($Amount){
        $Rupees = '';
        if(($Amount != '')&&($Amount != NULL)){
            $formatter = new NumberFormatter('en_IN', NumberFormatter::SPELLOUT);
            $Rupees = $formatter->format($Amount);
        }
        return $Rupees;
    }
    public static function UploadFile($FileSDoc,$FileName,$ModuleCode,$ModuleSubCode){
        if($FileSDoc) {
            //$targetServer = 'http://192.168.35.162/html/UploadFile.php'; // Adjust the target server URL
            //$targetServer = 'http://10.31.72.160/work/UpoadFile.php';
            $uploaddir = new UploadFileDir();
            $DirectoryData = $uploaddir->UploadFileDirectoryByCode($ModuleCode,$ModuleSubCode);
            $ProcessDirData = $uploaddir->UploadProcessFileDirectoryByCode();
            $TargetDir = NULL;
            if($DirectoryData != NULL){
                if(count($DirectoryData) > 0){
                    $TargetDir = collect($DirectoryData)->pluck('directory_name')->first();
                }
            }
            $TargetServerFile = NULL;
            if($ProcessDirData != NULL){
                if(count($ProcessDirData) > 0){
                    $TargetServerFile = collect($ProcessDirData)->where('module_code','UPLOAD')->pluck('directory_name')->first();
                }
            }
            if($TargetDir == NULL){
                $IsUpload = 'DF';
            }else if($TargetServerFile == NULL){
                $IsUpload = 'DF';
            }else{
                $response = Http::attach(
                    'file',
                    file_get_contents($FileSDoc->getRealPath()),
                    $FileSDoc->getClientOriginalName()
                )->post($TargetServerFile,['TargetDir'=>$TargetDir,'FileName'=>$FileName]);
                $responseData = json_decode($response->body(), true);
                if ($responseData && isset($responseData['status'])) {
                    if ($responseData['status'] === 'success') {
                        $IsUpload = 'Y';
                    }else if ($responseData['status'] === 'dirfailure') {
                        $IsUpload = 'DF';
                    }else {
                        $IsUpload = 'N';
                    }
                } else {
                    $IsUpload = 'E';
                }
            }
        }else{
            $IsUpload = 'UE';
        }
        return $IsUpload;
    }
    public static function DownloadFile($FileName,$ModuleCode,$ModuleSubCode){
        if($FileName) {
            $uploaddir = new UploadFileDir();
            $DirectoryData = $uploaddir->UploadFileDirectoryByCode($ModuleCode,$ModuleSubCode);
            $ProcessDirData = $uploaddir->UploadProcessFileDirectoryByCode();
            $TargetDir = NULL;
            if($DirectoryData != NULL){
                if(count($DirectoryData) > 0){
                    $TargetDir = collect($DirectoryData)->pluck('directory_name')->first();
                }
            }
            $TargetServerFile = NULL;
            if($ProcessDirData != NULL){
                if(count($ProcessDirData) > 0){
                    $TargetServerFile = collect($ProcessDirData)->where('module_code','DOWNLOAD')->pluck('directory_name')->first();
                }
            }
            //dd($TargetServerFile);
            if($TargetDir == NULL){
                $IsUpload = 'DF'; 
            }else if($TargetServerFile == NULL){
                $IsUpload = 'DF'; 
            }else{ 
                $FilePath = $TargetDir.$FileName; 
                try { 
                    $ch = curl_init();
                    // Set cURL options
                    curl_setopt($ch, CURLOPT_URL, $TargetServerFile . '?FilePath=' . $FilePath);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    // Execute cURL session and get the response
                    $response = curl_exec($ch);
                    if($response == "IR"){
                        $IsUpload = "Invalid request";
                    }else if($response == "IFP"){
                        $IsUpload = "Invalid file path";
                    }else if($response == "FNF"){
                        $IsUpload = "File not found";
                    }else if($response == "IFF"){
                        $IsUpload = "Invalid file format";
                    }else{
                        // Check for cURL errors
                        if (curl_errno($ch)) {
                            // Handle cURL error
                            $IsUpload = 'Error: cURL request failed - ' . curl_error($ch);
                        } else {
                            // Get the HTTP status code
                            $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                            // Check if the request was successful (HTTP status code 2xx)
                            if ($httpStatusCode >= 200 && $httpStatusCode < 300) {
                                // Process the response content
                                $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);//dd(filesize($FilePath));
                                // Set the appropriate headers for file download
                                //try { 
                                    header("Content-type: $contentType");
                                    header('Content-Disposition: attachment; filename=' . basename($FilePath));
                                    //header('Content-Length: ' . filesize($FilePath)); 
                                    // Output the file content 
                                    echo $response; 
                                    $responseData = json_decode($response, true);
                                    if($responseData == NULL){
                                        exit; 
                                    }
                            } else {
                                // Handle HTTP error
                                //$IsUpload = 'Error: HTTP request failed - HTTP Status Code: ' . $httpStatusCode;
                            }
                        }
                    }
                    // Close cURL session
                    curl_close($ch);
                    
                } catch (\Throwable $e) {
                    // Handle other exceptions or errors
                    $IsUpload = 'Error: File not found / File format is not supported'. $e;
                }
            }
        }else{
            $IsUpload = 'Error : Invalid file name / file name not found';
        }
        
        return $IsUpload;
    }
    public static function DownloadFileIntoApplicationDir($FileName,$ModuleCode,$ModuleSubCode){
        if($FileName) {
            $uploaddir = new UploadFileDir();
            $DirectoryData = $uploaddir->UploadFileDirectoryByCode($ModuleCode,$ModuleSubCode);
            $ProcessDirData = $uploaddir->UploadProcessFileDirectoryByCode();
            $TargetDir = NULL;
            if($DirectoryData != NULL){
                if(count($DirectoryData) > 0){
                    $TargetDir = collect($DirectoryData)->pluck('directory_name')->first();
                }
            }
            $TargetServerFile = NULL;
            if($ProcessDirData != NULL){
                if(count($ProcessDirData) > 0){
                    $TargetServerFile = collect($ProcessDirData)->where('module_code','DOWNLOAD')->pluck('directory_name')->first();
                }
            }
            //dd($TargetServerFile);
            if($TargetDir == NULL){
                $IsUpload = 'DF'; 
            }else if($TargetServerFile == NULL){
                $IsUpload = 'DF'; 
            }else{ 
                $FilePath = $TargetDir.$FileName; 
                try { 
                    $ch = curl_init();
                    // Set cURL options
                    curl_setopt($ch, CURLOPT_URL, $TargetServerFile . '?FilePath=' . $FilePath);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    // Execute cURL session and get the response
                    $response = curl_exec($ch); 
                    if($response == "IR"){
                        $IsUpload = "Invalid request";
                    }else if($response == "IFP"){
                        $IsUpload = "Invalid file path";
                    }else if($response == "FNF"){
                        $IsUpload = "File not found";
                    }else if($response == "IFF"){
                        $IsUpload = "Invalid file format";
                    }else{ 
                        // Check for cURL errors
                        if (curl_errno($ch)) {
                            // Handle cURL error
                            $IsUpload = 'Error: cURL request failed - ' . curl_error($ch);
                        } else { 
                            // Get the HTTP status code
                            $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                            // Check if the request was successful (HTTP status code 2xx)
                            if ($httpStatusCode >= 200 && $httpStatusCode < 300) {
                                // Process the response content
                                $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);//dd(filesize($FilePath));
                                // Set the appropriate headers for file download
                                //try { 
                                    //header("Content-type: $contentType");
                                    //header('Content-Disposition: attachment; filename=' . basename($FilePath));
                                    //dd(123);
                                    
                                    $savedFilePath = public_path('uploads/' . $FileName); // Change the directory as needed
                                    //return $response;
                                    File::put($savedFilePath, $response);
                                    //dd($savedFilePath);
                                    //header('Content-Length: ' . filesize($FilePath)); 
                                    // Output the file content 
                                    //return $response; 
                                    //$responseData = json_decode($response, true);
                                    //if($responseData == NULL){
                                        //exit; 
                                   // }
                            } else {
                                // Handle HTTP error
                                //$IsUpload = 'Error: HTTP request failed - HTTP Status Code: ' . $httpStatusCode;
                            }
                        }
                    }
                    // Close cURL session
                    curl_close($ch);
                    
                } catch (\Throwable $e) {
                    // Handle other exceptions or errors
                    $IsUpload = 'Error: File not found / File format is not supported'. $e;
                }
            }
        }else{
            $IsUpload = 'Error : Invalid file name / file name not found';
        }
        
        return $IsUpload;
    }
    public static function PreViewUploadedFile($FileName,$ModuleCode,$ModuleSubCode){
        if($FileName) {
            $uploaddir = new UploadFileDir();
            $DirectoryData = $uploaddir->UploadFileDirectoryByCode($ModuleCode,$ModuleSubCode);
            $ProcessDirData = $uploaddir->UploadProcessFileDirectoryByCode();
            $TargetDir = NULL;
            if($DirectoryData != NULL){
                if(count($DirectoryData) > 0){
                    $TargetDir = collect($DirectoryData)->pluck('directory_name')->first();
                }
            }
            $TargetServerFile = NULL;
            if($ProcessDirData != NULL){
                if(count($ProcessDirData) > 0){
                    $TargetServerFile = collect($ProcessDirData)->where('module_code','DOWNLOAD')->pluck('directory_name')->first();
                }
            }
            //dd($TargetServerFile);
            if($TargetDir == NULL){
                $IsUpload = 'DF'; 
            }else if($TargetServerFile == NULL){
                $IsUpload = 'DF'; 
            }else{ 
                $FilePath = $TargetDir.$FileName; 
                try { 
                    $ch = curl_init();
                    // Set cURL options
                    curl_setopt($ch, CURLOPT_URL, $TargetServerFile . '?FilePath=' . $FilePath);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    // Execute cURL session and get the response
                    $response = curl_exec($ch);
                    if($response == "IR"){
                        $IsUpload = "Invalid request";
                    }else if($response == "IFP"){
                        $IsUpload = "Invalid file path";
                    }else if($response == "FNF"){
                        $IsUpload = "File not found";
                    }else if($response == "IFF"){
                        $IsUpload = "Invalid file format";
                    }else{
                        // Check for cURL errors
                        if (curl_errno($ch)) {
                            // Handle cURL error
                            $IsUpload = 'Error: cURL request failed - ' . curl_error($ch);
                        } else {
                            // Get the HTTP status code
                            $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                            // Check if the request was successful (HTTP status code 2xx)
                            if ($httpStatusCode >= 200 && $httpStatusCode < 300) {
                                // Process the response content
                                $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);//dd(filesize($FilePath));
                                // Set the appropriate headers for file download
                                //try { 
                                    header("Content-type: $contentType");
                                    header('Content-Disposition: attachment; filename=' . basename($FilePath));
                                    //header('Content-Length: ' . filesize($FilePath)); 
                                    // Output the file content 
                                    return $response; 
                                    $responseData = json_decode($response, true);
                                    if($responseData == NULL){
                                        exit; 
                                    }
                            } else {
                                // Handle HTTP error
                                //$IsUpload = 'Error: HTTP request failed - HTTP Status Code: ' . $httpStatusCode;
                            }
                        }
                    }
                    // Close cURL session
                    curl_close($ch);
                    
                } catch (\Throwable $e) {
                    // Handle other exceptions or errors
                    $IsUpload = 'Error: File not found / File format is not supported'. $e;
                }
            }
        }else{
            $IsUpload = 'Error : Invalid file name / file name not found';
        }
        
        return $IsUpload;
    }




    public static function SaveFile($FileName, $ModuleCode, $ModuleSubCode, $Path){
        if(empty($FileName)) {
            return 'Error: Invalid file name / file name not found';
        }
    
        $uploaddir = new UploadFileDir();
        $DirectoryData = $uploaddir->UploadFileDirectoryByCode($ModuleCode, $ModuleSubCode);
        $ProcessDirData = $uploaddir->UploadProcessFileDirectoryByCode();
    
        $TargetDir = NULL;
        if($DirectoryData != NULL && count($DirectoryData) > 0){
            $TargetDir = collect($DirectoryData)->pluck('directory_name')->first();
        }
        $TargetServerFile = NULL;
        if($ProcessDirData != NULL && count($ProcessDirData) > 0){
            $TargetServerFile = collect($ProcessDirData)->where('module_code','DOWNLOAD')->pluck('directory_name')->first();
        }
        if($TargetServerFile == NULL){
            return 'Error: Directory not found';
        }
    
        if($TargetDir == NULL){
            return 'DF'; 
        }
    
        $FilePath = $TargetDir  . $FileName; 
    
        if (!file_exists($FilePath)) {
            return 'Error: Source file not found';
        }
    
        if (!file_exists($Path)) {
            mkdir($Path, 0777, true);
        }
    
        $TargetFilePath = $Path . '/' . $FileName; 
    
        if(copy($FilePath, $TargetFilePath)){
            return true;
        } else {
            return 'Error: File Not Found';
        }
    }

    
    public static function CreateLog($request,$Message){ 
        $Now = Carbon::now();
        $Now = $Now->format('d-M-Y H:i:s');  
        $Inform = $request->ip()." || ".$Now." || Employee No. : ".session('WcmsEmpNo')." || ".$Message; 
        Log::channel('wcmslog')->info($Inform); 
    }

    public static function CreateLogInTable($request,$LogData){ 
        if(filled($LogData)){
            //$Message = $LogData['MESSAGE'];
            $Now = Carbon::now();
            $Now = $Now->format('d/m/Y H:i:s');  
            //$Inform = $request->ip()." || ".$Now." || Employee No. : ".session('WcmsEmpNo')." || ".$Message; 
            $LogDt = new LogDt();
            $SaveLogData['module_code']     = $LogData['MODULE_CODE'] ?? NULL;
            $SaveLogData['table_name']      = $LogData['TABLE_NAME'] ?? NULL;
            $SaveLogData['model_name']      = $LogData['MODEL_NAME'] ?? NULL;
            $SaveLogData['old_value']       = $LogData['OLD_VALUE'] ?? NULL;
            $SaveLogData['new_value']       = $LogData['NEW_VALUE'] ?? NULL;
            $SaveLogData['transaction_id']  = $LogData['TRANSACTION_ID'] ?? NULL;
            $SaveLogData['action']          = $LogData['ACTION'] ?? NULL;
            $SaveLogData['remarks']         = $LogData['REMARKS'] ?? null;
            $SaveLogData['action_done_by']  = session('WcmsEmpNo');
            $SaveLogData['action_done_on']  = NOW();
            $SaveLogData['ip_address']      = $request->ip();
            $SaveLogData['cont_fuc_name']   = $LogData['CONT_FUNC_NAME'] ?? null;
            $LogDt->CreateLogDt($SaveLogData);
            //Log::channel('wcmslog')->info($Inform); 
        }
    }


    public static function SendMail($MailContentArr,$MailPage){ //$MailPage = 'TEST';
        if($MailPage == "WFLOW"){
            if(($MailContentArr != NULL)&&(count($MailContentArr) > 0)){
                $MailContent = NULL;
                $GlobId     = $MailContentArr['globid'];
                $Action     = $MailContentArr['action'];
                $ToEmpNo    = $MailContentArr['to_emp_no'];
                $IsApprove  = $MailContentArr['is_approve'];
                $WorkStage  = $MailContentArr['work_stage'];
               
                $ToEmpData = Helper::ShowEmployeeByEmpNo($ToEmpNo);
                if(($ToEmpData != NULL)&&(count($ToEmpData)>0)){
                    $ToEmail = collect($ToEmpData)->pluck("o_email")->first();
                }else{
                    $ToEmail = NULL;
                }
                $MailDataArr = array();
                if(($ToEmail != NULL)&&($MailContent != NULL)&&($ToEmpNo != NULL)){
                    Mail::to($ToEmail)->send(new NotifyMail($MailContent));
                    $MailDataArr['mail_sub_flag']   = 'WORKFLOW';
                    $MailDataArr['mail_from']       = env('MAIL_USERNAME');
                    $MailDataArr['mail_to']         = $ToEmail;
                    $MailDataArr['mail_content']    = $MailContent;
                    $MailDataArr['mail_type']       = 'INSIDE_ORG';
                    $MailDataArr['created_by']      = session('WcmsEmpNo');
                    $MailDataArr['created_at']      = NOW();
                    $MailDataArr['cc_mail']         = NULL;
                    if(Mail::failures()){
                        $MailDataArr['mail_status']      = 'FAILED';
                    }else{
                        $MailDataArr['mail_status']      = 'SUCCESS';
                    }
                    $Mtrans = new mail_transaction();
                    $Test = $Mtrans->CreateMailTransaction(NULL,$MailDataArr);
                }
            }
        }
        if($MailPage == "NEWS"){
            if(($MailContentArr != NULL)&&(count($MailContentArr) > 0)){
                $Subject = $MailContentArr['subject'];
                $Message = $MailContentArr['message'];
                $Attachment = $MailContentArr['attachment'];
                $DivCode = $MailContentArr['division'];
                $EmpData = AemEmployee::where('division_code',$DivCode)->where('active',1)->pluck('o_email')->toArray();
                Mail::to($EmpData)->send(new NotifyMail($Message,$Subject,$Attachment));           
            }            
            if(Mail::failures()){
                $Result = "Mail Not Sent";
            }else{
                $Result = "Mail Sent Successfully..";
            }
            unlink($Attachment);
            return $Result;
        }


        
    }
    public static function RemoveComma($Input){
        $Result = '';
        if(($Input != '')&&($Input != NULL)){
            $Result = str_replace(',', '', $Input);
        }
        return $Result;
    }
    public static function ValidateEmptySpace($ValidateVar){       ///  Function to Validate Empty Spaces
        $ValidateVar = str_replace(' ', '', $ValidateVar);    // Remove spaces        
        $ValidateVar = preg_replace('/[^A-Za-z0-9]/', '', $ValidateVar);  // Remove special characters using regular expression
        if($ValidateVar == ""){
            return false;
        }else{
            return true;
        }
    }
    public static function ValidateFieldLength($TableName, $FieldName, $ValidateVar){        ///  Function to Validate Field Length From Database, Both String and Array allowed
        $TableData = DB::select("SELECT column_name, character_maximum_length FROM information_schema.columns WHERE table_name = ? AND column_name = ?", [$TableName, $FieldName]);
        $FieldLength = NULL;    $Err = 0;
        if (!empty($TableData)) {
            $FieldLength = $TableData[0]->character_maximum_length;
        }
        if($FieldLength != NULL){
            if (is_array($ValidateVar)) {
                $Err = array_map(function ($str) use ($Err, $FieldLength){
                    $GivenCharLength = mb_strlen($str, 'UTF-8');
                    if($GivenCharLength < $FieldLength){
                        $Err++;
                    }
                    return $Err;
                }, $ValidateVar);
            } else {
                $GivenCharLength = mb_strlen($ValidateVar, 'UTF-8');
                if($GivenCharLength > $FieldLength){
                    $Err++;
                }
            }
        }else{
            $Err++;
        }
        if($Err > 0){
            return false;
        }else{
            return true;
        }
    }
    public static function ValidateNumeric($ValidateVar){        ///  Function to Validate Numeric and Decimal Vlaue Only
        $factor = 0;
        if(!preg_match('/^\d+(\.\d+)?$/', $ValidateVar)){
            $factor = 1;
        }
        return $factor;
    }
    
    
    public static function IndianMoneyFormat($Amount){
		$amt1 = number_format($Amount, 2, '.', '');
        $amt2 = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $amt1);
        return $amt2;
	}
    public static function IndianNumberFormat($Amount,$Decimal){
		$amt1 = number_format($Amount, $Decimal, '.', '');
        $amt2 = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $amt1);
        return $amt2;
	}
    

    
    public static function RemoveRegExpItemUnit($ItemUnit){
        $NewUnit = $ItemUnit;
        if(($ItemUnit != NULL)&&($ItemUnit != "")){
            $NewUnit = strtoupper($ItemUnit);
            $NewUnit = trim($NewUnit);
            $NewUnit = preg_replace("/[^a-zA-Z0-9]+/", "", $NewUnit); 
        }
        return $NewUnit;
    }
    public static function DBDateFormat($InputDate){
        if(($InputDate != NULL)&&($InputDate != '')){
            $dt = explode('/', $InputDate);
            $dd = $dt[0];
            $mm = $dt[1];
            $yy = $dt[2];
            return $yy.'-'.$mm.'-'.$dd;
        }else{
            return '';
        }
    }
    public static function DataBaseDateFormat($InputDate){
        if(($InputDate != NULL)&&($InputDate != '')){
            $dt = explode('/', $InputDate);
            $dd = $dt[0];
            $mm = $dt[1];
            $yy = $dt[2];
            return $yy.'-'.$mm.'-'.$dd;
        }else{
            return '';
        }
    }
    public static function DisplayDateFormat($InputDate){
        if(($InputDate != NULL)&&($InputDate != '')){
            $dt = explode('-', $InputDate);
            $dd = $dt[2];
            $mm = $dt[1];
            $yy = $dt[0];
            return $dd.'/'.$mm.'/'.$yy;
        }else{
            return '';
        }
    }
    public static function DatabaseDateFormatWithTime($InputDate){
        $OutputDate = Carbon::createFromFormat('d/m/Y H:i', $InputDate)->format('Y-m-d H:i');  
        return $OutputDate;
    }
    public static function DisplayDateFormatWithTime($InputDate){
        $OutputDate = Carbon::createFromFormat('Y-m-d H:i:s', $InputDate)->format('d/m/Y H:i');
        return $OutputDate;
    }
    
    
    
    
    Public static function MBPageBreak(){
        return "<div style='page-break-after:always;'><hr style='color:#fff'></div>";
    }
    
   
    public static function PdfHeading($request,$GlobID){
        $DivisionName = "";
        if(filled($GlobID)){
            if(isset($request->AccountsHeading)){
                $DivisionName = "ACCOUNTS DIVISION";
            }else{
                $Getworks = new works();
                $GetEmployee = new AemEmployee();
                $WorksData = $Getworks->ShowWorks($GlobID,NULL);
                $CreatedBy = collect($WorksData)->pluck('created_by')->first();
                $EmpData = $GetEmployee->ShowEmployees($request,$CreatedBy);
                foreach($EmpData as $EmpD){
                    $EmpName = $EmpD->emp_known_as;
                    $DivisionName = $EmpD->division;
                    $DesigName = $EmpD->designation_name;
                    $DivisionShortName = $EmpD->division_short_name;
                }
            }
        }
        $MainTitle = '<div class="row" style="text-align:center;">';
        $MainTitle = $MainTitle . '<div style="tex-align:center"><b>GOVERNMENT OF INDIA</b></div>';
        $MainTitle = $MainTitle . '<div style="tex-align:center"><b>BHABHA ATOMIC RESEARCH CENTRE</b></div>';
        $MainTitle = $MainTitle . '<div style="tex-align:center"><b>'.$DivisionName.'</b></div>';
        $MainTitle = $MainTitle . '<div style="tex-align:center; font-size:11px;">( WCMS report )</div>';
        $MainTitle = $MainTitle . '</div></br>';
        return $MainTitle;
    }

    public static function IndianRupeesToWords($request,$x){
        $word = '';
        $nwords = array("", "One", "Two", "Three", "Four", "Five", "Six", 
                    "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
                    "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
                   "Nineteen", "Twenty", 30 => "Thirty", 40 => "Forty",
                     50 => "Fifty", 60 => "Sixty", 70 => "Seventy", 80 => "Eighty",
                     90 => "Ninety");
        if(!is_numeric($x)){
            $w = '#';
        }else{
            if($x < 0){
                $w = 'minus ';
                $x = -$x;
            }else{
                $w = '';
            }
                         
            if($x < 21){
                $w .= $nwords[$x];
            }else if($x < 100){
                $w .= $nwords[10 * floor($x/10)];
                $r = fmod($x, 10);
                if($r > 0){
                    $w .= ' '. $nwords[$r];
                }
            }else if($x < 1000){
                $w .= $nwords[floor($x/100)] .' Hundred';
                $r = fmod($x, 100);
                if($r > 0){
                    $w .= ' '. number_to_words($r);
                }
            }else if($x < 100000){
                $w .= number_to_words(floor($x/1000)) .' Thousands';
                $r = fmod($x, 1000);
                // echo $r;
                if($r > 0){
                    $w .= ' ';
                    if($r < 100){
                        $w .= ' ';
                    }
                    $w .= number_to_words($r);
                }
            }else if($x < 10000000){
                $w .= number_to_words(floor($x/100000)) .' Lakhs';
                $r = fmod($x, 100000);
                if($r > 0){
                    $w .= ' ';
                    if($r < 100){
                        $w .= ' ';
                    }
                    $w .= number_to_words($r);
                }
            }else{
                //return "ten togvfsgfgtehgthsus";
                $w .= number_to_words(floor($x/10000000)) .' Crores';
                $r = fmod($x, 10000000);
                if($r > 0){
                    $w .= ' ';
                    if($r < 100){
                        $word .= ' ';
                    }
                    $w .= number_to_words($r);
                }
            }
        }
        return $w;
    }
    
    public static function IndianRupeesFormat($fullmoney){
        if(($fullmoney != "0.00")&&($fullmoney != "0.0")&&($fullmoney != 0)){
            $fullmoney = (float)$fullmoney;
            $fullmoney = number_format($fullmoney, 2, ".", "");
        }
        $expfullmoney = explode(".",$fullmoney);
        if(isset($expfullmoney[0])){
            $money = $expfullmoney[0];
        }else{
            $money = 0;
        }
        if(isset($expfullmoney[1])){
            $paise = $expfullmoney[1];
        }else{
            $paise = 0;
        }
       
        $len = strlen($money);
        $m = '';
        $money = strrev($money);
        for($i=0;$i<$len;$i++){
            if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$len){
                $m .=',';
            }
            $m .=$money[$i];
        }
        if($m == ""){ $m = 0; } if( $paise == ""){$paise = '00'; } if( $paise == "0"){$paise = '00'; }
        $Rupees = strrev($m).".".$paise;
        
        return $Rupees;
    }
    public static function IndianRupeesFormatWithoutPise($fullmoney){
        if(($fullmoney != "0.00")&&($fullmoney != "0.0")&&($fullmoney != 0)){
            $fullmoney = (float)$fullmoney;
            $fullmoney = number_format($fullmoney, 2, ".", "");
        }
        $expfullmoney = explode(".",$fullmoney);
        if(isset($expfullmoney[0])){
            $money = $expfullmoney[0];
        }else{
            $money = 0;
        }
        if(isset($expfullmoney[1])){
            $paise = '';//$expfullmoney[1];
        }else{
            $paise = '';//0;
        }
       
        $len = strlen($money);
        $m = '';
        $money = strrev($money);
        for($i=0;$i<$len;$i++){
            if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$len){
                $m .=',';
            }
            $m .=$money[$i];
        }
        if($m == ""){ $m = 0; } //if( $paise == ""){$paise = '00'; } if( $paise == "0"){$paise = '00'; }
        $Rupees = strrev($m);//.".".$paise;
        
        return $Rupees;
    }

   
   
    
    public static function GetAllUnits($request){
        $Unit = new Unit();
        $UnitData =  $Unit->ShowUnit(NULL);
        if($UnitData != NULL){
            if(count($UnitData) > 0){
                $UnitData = collect($UnitData)->where('active',1);
            }
        }
        return $UnitData;
    }
    public static function GetCurrentFinYear($request){
        return ( date('m') > 3) ? date('Y')."-".(date('Y')+1) : (date('Y')-1)."-".date('Y');
    }
    public static function GetAllFinancialYear($request){
        $Month = date('n');
        $Year = date('Y');
        $StartYear = 2018;
        if($Month > 3){
            $EndYear = $Year + 1;
        }else{
            $EndYear = $Year+1;
        }
        $FinYearArr = array();
        for($i = $StartYear; $i < $EndYear; $i++){
            $StartY = $i;
            $EndY   = $i+1;
            $FinYear = $StartY."-".$EndY;
            $FinYearArr[] = $FinYear;
        }
        return $FinYearArr;
    }

   
    public static function ReturnStyleDynamically($ArrayVal){
        $OutPutArr = array();
        $total = count($ArrayVal);
        // Calculate percentage width for each value
        $percentages = array_map(function($value) use ($total) {
            $TotVal = (6 / $total) * 100;
            return round($TotVal);
        }, $ArrayVal);
        $OutPutArr['ArrayVal'] = $ArrayVal;
        $OutPutArr['StyleWidth'] = $percentages;
        return $OutPutArr;
    }
    

    public static function GetWordWrapCount($Description,$NoOfChar){
        $WordWrapCnt 	= 0; 
        $NewDescWork 	= "";
        $Desc 		    = wordwrap($Description,$NoOfChar,'<br>');
        $ExplodeLine 	= explode('<br>', $Desc);
        $LineCnt 		= count($ExplodeLine);
        for($xc = 0; $xc < $LineCnt; $xc++){
            if($ExplodeLine[$xc] != ""){
                $WordWrapCnt++;
                $NewDescWork .= $ExplodeLine[$xc]."<br/> ";
            }
        }
        if($NewDescWork != ""){
            $NewDescWork = str_replace("<br>","",$NewDescWork);
            $NewDescWork = str_replace("<br >","",$NewDescWork);
            $NewDescWork = str_replace("<br/>","",$NewDescWork);
        }
        return array($NewDescWork, $WordWrapCnt);
    }

    public static function GetStartDateEndDateFromMonth($Month,$Year){
        // Create date from year and month
        $Date = Carbon::create($Year, $Month, 1);
        // Get start and end of month
        $StartDate = $Date->copy()->startOfMonth()->toDateString();
        $EndDate   = $Date->copy()->endOfMonth()->toDateString();
        return ['StartDate' => $StartDate, 'EndDate' => $EndDate];
    }

    public static function GetActualLeaveDaysForAttendanceCalc($ParamArr){
        $FromDate = $ParamArr['FromDate'];
        $ToDate = $ParamArr['ToDate'];
        $LeaveData = $ParamArr['LeaveData']; 
        $LeaveData = $LeaveData->map(function ($Leave) use ($FromDate, $ToDate) {
            $OverlapStart = Carbon::parse($Leave->from_date)->max(Carbon::parse($FromDate));
            $OverlapEnd   = Carbon::parse($Leave->to_date)->min(Carbon::parse($ToDate));
            $Days = $OverlapStart->diffInDays($OverlapEnd) + 1;
            $Leave->actual_days_attend_calc = $Days;
            return $Leave;
        });
        return $LeaveData;
    }

    public static function GetActualWorkingDaysInMonth($Month,$Year){
        $MonthDateData = self::GetStartDateEndDateFromMonth($Month,$Year);
        $StartDate = $MonthDateData['StartDate']; 
        $EndDate = $MonthDateData['EndDate'];
        $Holiday = new Holiday();
        $HoldayData = $Holiday->ShowHolidaysPeriod($StartDate,$EndDate);
        $HolidayDates = array_flip($HoldayData->pluck('holiday_date')->toArray());
        $WorkingDays = 0;
        $DaysArr = [];
        foreach(CarbonPeriod::create($StartDate, $EndDate) as $Date){
            $FormattedDate = $Date->format('Y-m-d');
            if(!$Date->isWeekend() && !isset($HolidayDates[$FormattedDate])){
                $WorkingDays++;
                $DaysArr[] = $FormattedDate;
            }
        }
        return ['DaysList'=>$DaysArr, 'WorkingDays'=>$WorkingDays];//$WorkingDays;
    }

    public static function GetDaysInMonth($Month,$Year){
        $Days = Carbon::create($Year, $Month, 1)->daysInMonth;
        return $Days;
    }
    public static function Forward_Reject_Approve_Button($request,$SubmitBtnName,$WorkFlowActionData,$BackUrl,$EditId,$RouteUrl,$ActionStatus,$ModuleCode){
        $IsApprove  = $WorkFlowActionData['IsApprove'] ?? NULL;
        $IsNext     = $WorkFlowActionData['IsNext'] ?? NULL;
        $IsPrevious = $WorkFlowActionData['IsPrevious'] ?? NULL;
        $FwRoleName = $WorkFlowActionData['NextRoleName'] ?? NULL;
        $PrevRoleName = $WorkFlowActionData['PrevRoleName'] ?? NULL;
        $RoleName     = isset($FwRoleName[0]) ? $FwRoleName[0] : '';
        $PrevRoleName = isset($PrevRoleName[0]) ? $PrevRoleName[0] : '';
        $ReturnArr  = [];
        $ApndTxt    = '';
        if($ActionStatus == 'PROCESS'){
            $ApndTxt .= '<div class="row row-fluid line-control-menu-bar formtitlebar" style="border:none">';
            $ApndTxt .= '<div class="btn-group floatr">';
            $ApndTxt .= '<button type="button" class="btn btn-default btnprimary" title="Back" name="back" id="back" value=" BACK "   onclick="window.location=\''.route($BackUrl).'\'"><i class="fa fa-arrow-circle-o-left pt2"></i> Back</button>';
            $ApndTxt .= '</div>';
            if($IsPrevious == 'Y'){
                $ApndTxt .= '<div class="btn-group floatr">';
                $ApndTxt .= '<button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="RJ" class="btn btn-default btninfo WorkFlowAction" value="REJECT"  data-flag="RJ"><i class="fa fa-times"></i> Return to ' . $PrevRoleName . ' </button>';
                $ApndTxt .= '</div>';
            }
            if($IsApprove == 'Y'){
                $ApndTxt .= '<div class="btn-group floatr">';
                $ApndTxt .= '<button type="submit" class="btn btn-default btninfo  WorkFlowAction" id="SubmitApplication" name="SubmitApplication" data-flag="AP" value="APPROVE"><i class="fa fa-check-circle"></i> Approve </button>';
                $ApndTxt .= '</div>';
            }
            if(($IsApprove == NULL) && ($IsNext == 'Y')){
                $ApndTxt .= '<div class="btn-group floatr">';
                $ApndTxt .= '<button type="submit" class="btn btn-default btninfo  WorkFlowAction"  id="SubmitApplication" name="SubmitApplication" data-flag="FW"  value="FORWARD" ><i class="fa fa-arrow-right"></i> Recommend / Forward to ' . $RoleName . '</button>';
                $ApndTxt .= '</div>';
            }
            if(($WorkFlowActionData['WorkFlowAction'] ?? null) === 'SU'){
                $ApndTxt  .= '<div class="btn-group floatr">';
                $ApndTxt .= '<button type="submit" id="SubmitApplication" name="SubmitApplication" data-flag="SU"  class="btn btn-default btninfo  WorkFlowAction" value="SUBMIT" data-flag="SU"><i class="fa fa-arrow-circle-right pt2"></i> '.$SubmitBtnName.' </button>';
                $ApndTxt .= '</div>';
                // $ApndTxt  .= '<div class="btn-group floatr">';
                // $ApndTxt .= '<button type="button" class="btn btn-default 	btnprimary"  name="btn_edit" id="btn_edit" value=" Edit "onclick="window.location=\''.route($RouteUrl, ['page' => encrypt('EDIT'), 'EditId' => encrypt($EditId), 'modulecode' => encrypt($ModuleCode)]).'\'" ><i class="fa fa-edit pt2"></i> Edit</button>';
                // $ApndTxt .= '</div>'; 
            }
        }else if($ActionStatus == 'VIEW'){
            $ApndTxt .= '<div class="row row-fluid line-control-menu-bar formtitlebar" style="border:none">';
            $ApndTxt .= '<div class="btn-group floatr">';
            $ApndTxt .= '<button type="button" class="btn btn-default btnprimary" title="Back" name="back" id="back" value=" BACK "   onclick="window.location=\''.route($BackUrl).'\'"><i class="fa fa-arrow-circle-o-left pt2"></i> Back</button>';
            $ApndTxt .= '</div>';
        }else if($ActionStatus == 'EDIT'){
            $ApndTxt .= '<div class="row row-fluid line-control-menu-bar formtitlebar" style="border:none">';
            $ApndTxt .= '<div class="btn-group floatr">';
            $ApndTxt .= '<button type="button" class="btn btn-default btnprimary" title="Back" name="back" id="back" value=" BACK "   onclick="window.location=\''.route($BackUrl).'\'"><i class="fa fa-arrow-circle-o-left pt2"></i> Back</button>';
            $ApndTxt .= '</div>';
            $ApndTxt .= '<div class="btn-group floatr">';
            $ApndTxt .= '<button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Update">Update</button>';	
            $ApndTxt .= '</div>';
        }

        $ApndTxt .= '</div>'; 
        $ReturnArr['HTMLSTR'] = $ApndTxt;
        return $ReturnArr;
    }
    public static function SavePaymentDetails($request,$TransactionId,$TransactionTable,$ModuleCode,$PaymentDetArray){
        $SaveData         = [];
        $ContID           = $PaymentDetArray['vendorId'] ?? NULL;
        $ContName         = $PaymentDetArray['vendorName'] ?? NULL;
        $GrossTotal       = $PaymentDetArray['GrossTotal'] ?? NULL;
        $PayAmout         = $PaymentDetArray['TotalPayAmout'] ?? NULL;
        $BalancePayAmout  = $PaymentDetArray['BalanceAmout'] ?? NULL;
        if(filled($ContID)){
            $PaymentTo = 'VENDOR';
        }else {
            $PaymentTo  = NULL;
        }
        $SaveData = [
            'transaction_id'    => $TransactionId,
            'transaction_table' => $TransactionTable,
            'module_code'       => $ModuleCode,
            'gross_amount'      => $PaymentDetArray['GrossTotal'] ?? NULL,
            'net_amount'        => $PaymentDetArray['TotalPayAmout'] ?? NULL,
            'payment_to'        => $PaymentTo ?? NULL,
            'pay_vendor_id'     => $PaymentDetArray['vendorId'] ?? NULL,
            'active'            => 1,
            'created_at'        => now(),
            'created_by'        => session('WcmsEmpNo'),
        ];
        return Payment::CreatePayment($SaveData);
    }
    public static function GetFinYearByMonthYear($Month,$Year){
        return ( $Month > 3) ? $Year."-".($Year+1) : ($Year-1)."-".$Year;
    }
    public static function toRoman($number) {
        $map = [
            'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
            'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
            'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
        ];
        $result = '';
        foreach ($map as $roman => $value) {
            while ($number >= $value) {
                $result .= $roman;
                $number -= $value;
            }
        }
        return strtolower($result);
    }
}
?>