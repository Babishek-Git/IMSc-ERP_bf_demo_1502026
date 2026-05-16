<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\organization;
use App\Models\AgmOffice;
use App\Models\AemEmployee;
use Illuminate\Support\Facades\Validator;
use Helper;
use DB;
use PDF;
use Session;
class OrganizationController extends Controller
{
    public function __construct(){
        $this->organization = new organization();
        $this->office = new AgmOffice();
        $this->emp   = new AemEmployee();
    }
    public function Organization(Request $request){
        $message = NULL;
        if(isset($request->btn_save)){
            if($request->input('btn_save') == "Save"){
                $ParGroupArr 	= $request->input('cmb_group');
                $NewGroupArr 	= $request->input('new_group');
                $OrgCodeArr 	= $request->input('txt_org_code');
                $ParCount 	 	= count($ParGroupArr);
                $ChiCount 	 	= count($NewGroupArr);
                $ParentId 	 	= $ParGroupArr[$ParCount-1];
                if($ParentId == "NEW"){
                    if($ParCount == 1){
                        $ParentId = 0;
                    }else{
                        $ParentId = $ParGroupArr[$ParCount-2];
                    }
                }
                $NewGroup  	 	= $NewGroupArr[$ChiCount-1];
                $OrgCode  	 	= $OrgCodeArr[$ChiCount-1];;        
                $InsertArr = array();
                $InsertArr['org_name']      = $NewGroup;
                $InsertArr['parent_id']     = $ParentId;
                $InsertArr['org_code']      = $OrgCode;
                $InsertArr['created_at']    = NOW();
                $InsertArr['created_by']    = session('WcmsEmpNo');
                $InsertArr['active']        = 1;

                $InsertDataArr['org_name'] = trim($InsertArr['org_name']);
                $InsertDataArr['org_name'] = preg_replace("/[^a-zA-Z0-9]+/", "", $InsertDataArr['org_name']); 
                $CheckOrganization = $this->organization->CheckOrganization($InsertDataArr);
                if(count($CheckOrganization)>0){
                    $LogMessage = "OrganizationController || Organization already exists )";
                    Helper::CreateLog($request,$LogMessage);       
                    $message = ("Failed: Organization already exists");
                }else{
                    $InsertedData = $this->organization->InsertData($InsertArr);
                    if($InsertedData != NULL)
                    {
                        $LogMessage = "OrganizationController ||  New Organization Created   )";
                        Helper::CreateLog($request,$LogMessage);       
                        $message = ("Success : New Organization Created !");
                    }
                } 
            }   
        } 
        $ShowGrandParent = $this->organization->ShowGrandParent($request);
        return view('organization.organization-creation')->with('data',compact('ShowGrandParent')) ->with('ALertMesage',$message);
    }
    public function ViewOrganization(Request $request)
    {
        $OrganizationList = $this->organization->ShowOrganizationList(NULL);
        return view('organization.view-organization')->with('data', compact('OrganizationList'));
    }

    public function OfficeCreation(Request $request)
    {
        $message = NULL;
        if(isset($request->btn_save)) {
            if ($request->input('btn_save') == "Save") {
                $message = $this->ValidateOfficeCreation($request);
                if(!filled($message)){
                    return $this->SaveOfficeCreation($request);
                }
            }
        }
        if (session('WcmsRoleGroupCode') == 'ADMUSER') {
            $ShowOrganization = $this->organization->ShowOrganizationList(NULL)->whereIn('org_code', ['S', 'SS']);
        }else if (session('WcmsRoleGroupCode') == 'SUPUSER') {
            $ShowOrganization = $this->organization->ShowOrganizationList(NULL);
        }else{
            $ShowOrganization = NULL;
        }

        return view('organization.office-creation')->with('data', compact('ShowOrganization'))->with('ALertMesage', $message);
    }
    public function ValidateOfficeCreation(Request $request){
        $message = '';
        $NewGroupArr = $request->input('new_group');
        $OffShoNameArr = $request->input('txt_office_shortName');
        $Rules = [ 'NGRP_F' => 'required', 'OFFSH_F' => 'required' ];
        foreach($request->input('new_group') as $NGrp){
            $ValidateGroup = [ 'NGRP_F' => $NGrp ];
            $Validate = Validator::make($ValidateGroup, $Rules);
            if($Validate->fails()) {
                $ValidateFields = $Validate->failed();
                foreach($ValidateFields as $ValidFieldName => $ValidRules){
                    if($ValidFieldName == "NGRP_F"){
                        $message = 'Error : Invalid New Group Name..!!';
                    }
                }
                if($message != ''){
                    return $message;
                }
            }
        }
        foreach($request->input('txt_office_shortName') as $MUrl){
            $ValidateMenuUrl = [ 'OFFSH_F' => $MUrl ];
            $Validate = Validator::make($ValidateMenuUrl, $Rules);
            if($Validate->fails()) {
                $ValidateFields = $Validate->failed();
                foreach($ValidateFields as $ValidFieldName => $ValidRules){
                    if($ValidFieldName == "OFFSH_F"){
                        $message = 'Error : Invalid Office Shortname..!!';
                    }
                }
                if($message != ''){
                    return $message;
                }
            }
        }
    }

    public function SaveOfficeCreation(Request $request){
        $message = "Sorry, Unable to create office..!!";
        $ParGroupArr = $request->input('cmb_group');
        $NewGroupArr = $request->input('new_group');
        $OffShoNameArr = $request->input('txt_office_shortName');
        $OffTypeArr = $request->input('org_code');
        $OffIdArr = $request->input('officeNo');
        $ParCount = count($ParGroupArr);
        $ChiCount = count($NewGroupArr);
        $ParentId = $ParGroupArr[$ParCount - 1];
        if ($ParentId == "NEW") {
            if ($ParCount == 1) {
                $ParentId = 0;
            } else {
                $ParentId = $ParGroupArr[$ParCount - 2];
            }
        }
        $NewGroup = $NewGroupArr[$ChiCount - 1];
        $OfficeShort = $OffShoNameArr[$ChiCount - 1];
        $OfficeType = $OffTypeArr;
        $OfficeId = $OffIdArr ?? 0;
        if($NewGroup == NULL) {
            $message = "Please enter the Office Name!";
        }else if($OfficeShort == NULL) {
            $message = "Please enter the Office Short Name!";
        }else{
            $OfficeArr = array();
            $OfficeArr['office_name'] = $NewGroup;
            $OfficeArr['repoting_to_office'] = $OfficeId;
            $OfficeArr['office_short_name'] = $OfficeShort;
            $OfficeArr['office_type'] = $OfficeType;
            $OfficeArr['created_at'] = now();
            $OfficeArr['created_by'] = session('WcmsEmpNo');
            $OfficeArr['active'] = 1;
            $InsertDataArr['office_name'] = trim($OfficeArr['office_name']);
            $InsertDataArr['office_name'] = preg_replace("/[^a-zA-Z0-9]+/", "", $InsertDataArr['office_name']);
            $InsertDataArr['repoting_to_office'] = trim($OfficeArr['repoting_to_office']);
            $InsertDataArr['repoting_to_office'] = $OfficeArr['repoting_to_office'];
            $CheckOffice = $this->office->CheckOfficeData($InsertDataArr);
            
            if(count($CheckOffice) > 0){
                $LogMessage = "AdminController ||  New Office Already exists ";
                Helper::CreateLog($request,$LogMessage);                       
                $message = "Failed: Already exists";
            }else{
                $InsertedData = $this->office->CreateOfficeData($OfficeArr);
                if($InsertedData != NULL){
                    $LogMessage = "AdminController || New Office Created , created by ".session('WcmsEmpNo')." ";
                    Helper::CreateLog($request,$LogMessage);                       
                    $message = "Success : New Office Created !";
                }
            }
        }
        Session::put('ALertMesage', $message);
        return redirect()->route('organization.OfficeCreation');
    }

    public function Office(Request $request)
    {
        $message = NULL;
        $OfficeData = NULL;

        if(isset($request->id))
        { 
            try {
                $OffId = decrypt($request->id);
            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $data = "Error : Sorry Invalid Attempt";
                return view('error.PayLoadError')->with('data',$data);
            }
            $OfficeData = $this->office->ShowOfficeData($OffId);
            $OfficeData = $OfficeData->first(); 
        }
       
        if($request->btn_save){  
            $ValMsg = $this->ValidateOffice($request);
            if(!filled($ValMsg)){  
                if($request->id != NULL){     
                    try {
                        $OffId = decrypt($request->id);
                    }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                        $data = "Error : Sorry Invalid Attempt";
                        return view('error.PayLoadError')->with('data',$data);
                    }
                    $OfficeArr['office_name']       = $request->txt_office_name;
                    $OfficeArr['office_short_name'] = $request->txt_off_short_name;
                    $OfficeArr['updated_at']        = NOW();
                    $OfficeArr['updated_by']        = session('WcmsEmpNo');

                    $UpdateOffice = $this->office->UpdateOfficeList($OfficeArr, $OffId);
                    if($UpdateOffice == true){
                        $LogMessage = "AdminController || Office Name Updated , updated by ".session('WcmsEmpNo')." ";
                        Helper::CreateLog($request,$LogMessage);                           
                        $message = ("Office Name Updated Sucessfully!");
                    }
                    $OfficeData = NULL;
                }
            }else{
                $message = " Sorry : ".$ValMsg." Office Name Not Saved..Please try again..!! ";
            }
        }
        return view('organization.office')->with('data',compact('OfficeData')) ->with('ALertMesage',$message);
    }

    public function ViewOffice(Request $request)
    {
        // if (session('WcmsRoleGroupCode') == 'ADMUSER') {
        //     $ParentId = session('WcmsEmpDiv');
        //     $OfficeList = $this->office->ShowOfficeChildData($ParentId);
        // } else if (session('WcmsRoleGroupCode') == 'SUPUSER') {
        //     $OfficeList = $this->office->ShowReportingToOfficeDataWOActive(NULL);
        // } else {
        //     $OfficeList = NULL;
        // }
        $OfficeGroupData = $this->office->ShowAllParentChild();
        return view('organization.view-office-list')->with('data', compact('OfficeGroupData'));
    }
    public function ValidateOffice($request){  
        $message = '';
        $Rules = [ 'OFF_NAME_REQ' => 'required|max:100',
                   'OFF_SHORT_NAME_REQ' => 'required|max:40', ];
        $ValidateData = [
            'OFF_NAME_REQ' => $request->input('txt_office_name'),
            'OFF_SHORT_NAME_REQ' => $request->input('txt_off_short_name'),
        ];
        if($message == ''){
            $Validate = Validator::make($ValidateData, $Rules);
            if($Validate->fails()) {
                $ValidateFields = $Validate->failed();
                foreach($ValidateFields as $ValidFieldName => $ValidRules){
                    if($ValidFieldName == "OFF_NAME_REQ"){
                        $message = 'Error : Invalid Office Name..!!';
                    }else if($ValidFieldName == "OFF_SHORT_NAME_REQ"){
                        $message = 'Error : Invalid Office Short Code..!!';
                    }
                }
            }
        }
        return $message;
    }

    public function UndoDelete(Request $request)
    {
        $Id = decrypt($request->input('Id'));
        $Type = $request->input('Type');
        $UndoDeleteArr = ['active' => 1];
        switch ($Type) {
            case 'OrganizationMaster':
                $UndoDeleteData = $this->organization->UpdateOrganizationList($UndoDeleteArr, $Id);
                $LogMessage = "AjaxController || Organization Activated successfully ";
                Helper::CreateLog($request,$LogMessage);   
                break;
            case 'OfficeMaster':
                $UndoDeleteData = $this->office->UpdateOfficeList($UndoDeleteArr, $Id);
                $LogMessage = "AjaxController || Office Activated successfully ";
                Helper::CreateLog($request,$LogMessage);   
                break;
            default:
                return response()->json(['error' => 'Invalid type'], 400);
        }
        return $UndoDeleteData;
    }

    public function OfficeFind(Request $request){                                 
        $GroupId = $request->input('groupid');
        $Orgid   = $request->input('parentID');
        $GetorganizationData = $this->organization->ShowOrganizationByParentId($request,$Orgid);
        $OrgType = $GetorganizationData->pluck('org_code')->first();       
    
        if($OrgType == 'D') {
            if (session('WcmsRoleGroupCode') == 'ADMUSER') {
                $GetorganizationData = $GetorganizationData->where('office_id',session('WcmsEmpDiv'));
            } else if (session('WcmsRoleGroupCode') == 'SUPUSER') {
                $GetorganizationData = $this->organization->ShowOrganizationByParentId($request,$Orgid);
            } else {
                $GetorganizationData = NULL;
            }
        } else { 
            if (session('WcmsRoleGroupCode') == 'ADMUSER') {
                $GetorganizationData = $GetorganizationData->where('repoting_to_office',session('WcmsEmpDiv'));
            } else if (session('WcmsRoleGroupCode') == 'SUPUSER') {
                $GetorganizationData = $this->organization->ShowOrganizationByParentId($request,$Orgid);
            } else {
                $GetorganizationData = NULL;
            }
        }
    
        return $GetorganizationData;
    }

    public function OfficeRepoToOffice(Request $request){ 
        $OfficeId = $request->input('Id');
        $GetOfficeRepoToOffice = $this->office->ShowOfficeWithRepToOffice($OfficeId);
        $officeType = $GetOfficeRepoToOffice->pluck('office_type')->first();       
        /*if($officeType == 'D')
        {
            if (session('WcmsRoleGroupCode') == 'ADMUSER') {
                $GetOfficeRepoToOffice = $GetOfficeRepoToOffice->where('office_id',session('WcmsEmpDiv'));
            }else if (session('WcmsRoleGroupCode') == 'ACCADMUSER') {
                $GetOfficeRepoToOffice = $GetOfficeRepoToOffice->where('office_id',session('WcmsEmpDiv'));
            }else if (session('WcmsRoleGroupCode') == 'SUPUSER') {
                $GetOfficeRepoToOffice = $this->office->ShowOfficeWithRepToOffice($OfficeId);
            }else {
                $GetOfficeRepoToOffice = NULL;
            }
        }else{
            $GetOfficeRepoToOffice = $this->office->ShowOfficeWithRepToOffice($OfficeId);
        }*/
        $GetOfficeRepoToOffice = $this->office->ShowOfficeWithRepToOffice($OfficeId);
        //dd($GetOfficeRepoToOffice);
        $GetOrganization = $this->organization->ShowOrganization($request)->where('office_type', $officeType)->first(); 
        $ShowEmployeeList = $this->emp->ShowEmployees($request,NULL);
        $ShowOfficeList = $this->office->ShowOfficeData($OfficeId);
        $WcmsRoleGroupCode = session('WcmsRoleGroupCode');
        $WcmsEmpDiv = session('WcmsEmpDiv');
        $OutputArr["GetOfficeRepoToOffice"] = $GetOfficeRepoToOffice;
        $OutputArr["GetOrganization"]  = $GetOrganization;
        $OutputArr["ShowEmployeeList"] = $ShowEmployeeList;
        $OutputArr["WcmsRoleGroupCode"] = $WcmsRoleGroupCode;
        $OutputArr["WcmsEmpDiv"] = $WcmsEmpDiv;
        
        return $OutputArr;
    }
}
