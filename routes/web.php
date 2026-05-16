<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ChangeEvent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    
    Route::group(['middleware' => ['guest']], function() {
		/**
		 * Home Routes
		 */
		//Route::get('/', 'HomeController@index')->name('home.index');
		Route::get('/', 'LoginController@show')->name('login.show');
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');
		Route::match(array('GET','POST'),'/sso', 'LoginController@sso')->name('login.sso');
        Route::match(array('GET','POST'),'/logout', 'LoginController@logout')->name('logout.perform');
    });

    Route::group(['middleware' => ['auth','ssoauth']], function() { 
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
		
		// Route::get('/', 'UsersController@index')->name('users.index');
		
		Route::get('/home', 'DashboardController@index')->name('dashboard.index');
		Route::get('/', 'DashboardController@index')->name('dashboard.index');

		Route::group(['middleware' => ['checkReferrer']], function() { 
			/**
			 * User Routes
			 */
			Route::group(['prefix' => 'employee'], function() { 
				Route::match(array('GET','POST'),'/createEmployee', 'EmployeeController@CreateEmployee')->name('employee.createEmployee');
				Route::match(array('GET','POST'),'/ViewEmployee', 'EmployeeController@ViewProfile')->name('employee.ViewProfile');
				Route::match(array('GET','POST'),'/viewPay', 'EmployeeController@ViewPay')->name('employee.view-pay');
				Route::match(array('GET','POST'),'/CreatePay', 'EmployeeController@CreatePay')->name('employee.create-pay');
				Route::match(array('GET','POST'),'/viewEmployee', 'EmployeeController@ViewEmployee')->name('employee.viewEmployee');
				Route::match(array('POST'),'/GetEmployeeRoles', 'EmployeeController@GetEmployeeRoles')->name('employee.GetEmployeeRoles');
				Route::match(array('POST'),'/GetEmployeeData', 'EmployeeController@GetEmployeeData')->name('employee.GetEmployeeData');
				Route::match(array('GET','POST'),'/view-employee-list', 'EmployeeController@ViewEmployeeList')->name('employee.view-employee-list');
				Route::match(array('GET','POST'),'/export-employee-pdf', 'EmployeeController@ExportEmployeePdf')->name('employee.export-employee-pdf');
				Route::match(array('GET'),'/get-fellowship-amount', 'EmployeeController@getFellowshipAmount')->name('employee.get-fellowship-amount');
				Route::match(array('GET'),'/get-fellowship-by-experience', 'EmployeeController@getByExperience')->name('employee.get-fellowship-by-experience');

			});
			Route::group(['prefix' => 'fellowship-rate'], function() { 
				Route::match(array('GET','POST'),'/fellowship-rate', 'FelowshipRateController@FelowshipRate')->name('fellowship-rate.fellowship-rate');
			});
			Route::group(['prefix' => 'user'], function() { 
				Route::match(array('GET','POST'),'/UserCreation', 'Usercontroller@UserCreation')->name('user.UserCreation');
				Route::match(array('GET','POST'),'/ViewUser', 'UserController@ViewUser')->name('user.ViewUser');
			});
			
			Route::group(['prefix' => 'ajaxsss'], function() {
				Route::match(array('POST'),'/GetModulesByDivision', 'AjaxController@GetModulesByDivision')->name('ajax.GetModulesByDivision');
				Route::match(array('POST'),'/ModuleFind', 'AjaxController@ModuleFind')->name('ajax.ModuleFind');			
				Route::match(array('POST'),'/GetStaffByRole', 'AjaxController@GetStaffByRole')->name('ajax.GetStaffByRole');	           	   //LINE ADDED BY GODWIN - 19/08/2023
				Route::match(array('POST'),'/AllStaff', 'AjaxController@GetAllStaff')->name('ajax.GetAllStaff');
				Route::match(array('POST'),'/GetSelectedStaff', 'AjaxController@GetSelectedStaff')->name('ajax.GetSelectedStaff');
				Route::match(array('POST'),'/GetSelectedLevel', 'AjaxController@GetSelectedLevel')->name('ajax.GetSelectedLevel');
				Route::match(array('POST'),'/GetEmployeeRoles', 'AjaxController@GetEmployeeRoles')->name('ajax.GetEmployeeRoles');
				Route::match(array('POST'),'/GetModuleWorkFlow', 'AjaxController@GetModuleWorkFlow')->name('ajax.GetModuleWorkFlow');
				Route::match(array('POST'),'/GetExcelSheets', 'EstimateController@GetExcelSheets')->name('ajax.GetExcelSheets');
				Route::match(array('POST'),'/GetOrgCode', 'AjaxController@GetOrgCode')->name('ajax.GetOrgCode');
				Route::match(array('POST'),'/DuplicateUnit', 'AjaxController@DuplicateUnit')->name('ajax.DuplicateUnit');
				Route::match(array('POST'),'/GetEmployee', 'AjaxController@GetEmployee')->name('ajax.GetEmployee');
				Route::match(array('POST'),'/GetLocation', 'AjaxController@GetLocation')->name('ajax.GetLocation');
				Route::match(array('POST'),'/deleteEmployee', 'AjaxController@DeleteEmployeeDetail')->name('ajax.DeleteEmployeeDetail');
				Route::match(array('POST'),'/Reporttooffice', 'AjaxController@OfficeRepoToOffice')->name('ajax.Reporttooffice');
				Route::match(array('POST'),'/DeleteWorkFlow', 'AjaxController@DeleteWorkFlowModule')->name('ajax.DeleteWorkFlow');
				Route::match(array('POST'),'/getModuleAccess', 'AjaxController@getModuleAccess')->name('ajax.getModuleAccess');
				Route::match(array('POST'),'/switchEmployeeRole', 'AjaxController@switchEmployeeRole')->name('ajax.switchEmployeeRole');
				Route::match(array('POST'),'/EmployeeDetails', 'AjaxController@EmployeeDetails')->name('ajax.EmployeeDetails');
				Route::match(array('POST'),'/OfficeFind', 'AjaxController@OfficeFind')->name('ajax.OfficeFind');
				Route::match(array('POST'),'/DeleteOffice', 'AjaxController@DeleteOffice')->name('ajax.DeleteOffice');
				Route::match(array('POST'),'/OrganizationFind', 'AjaxController@OrganizationFind')->name('ajax.OrganizationFind');
				Route::match(array('POST'),'/DeleteOrganization', 'AjaxController@DeleteOrganization')->name('ajax.DeleteOrganization');
				Route::match(array('POST'),'/DeleteState', 'AjaxController@DeleteState')->name('ajax.DeleteState');
				Route::match(array('POST'),'/StateGSTCode', 'AjaxController@StateGSTCode')->name('ajax.StateGSTCode');
				Route::match(array('POST'),'/Deleteuser', 'AjaxController@Deleteuser')->name('ajax.Deleteuser');
				Route::match(array('POST'),'/GetAllEmployee', 'AjaxController@GetAllEmployee')->name('ajax.GetAllEmployee');
				Route::match(array('POST'),'/DeleteUnit', 'AjaxController@DeleteUnit')->name('ajax.DeleteUnit');			
				Route::match(array('POST'),'/UndoDelete', 'AjaxController@UndoDelete')->name('ajax.UndoDelete');
				Route::match(array('POST'),'/UndoDeleteUnit', 'AjaxController@UndoDeleteUnit')->name('ajax.UndoDeleteUnit');
				Route::match(array('POST'),'/FindEmployeeNo', 'AjaxController@FindEmployeeNo')->name('ajax.FindEmployeeNo');
				Route::match(array('POST'),'/FindEmployeeByRole', 'AjaxController@FindEmployeeByRole')->name('ajax.FindEmployeeByRole');
				Route::match(array('POST'),'/DeleteRoleMapping', 'AjaxController@DeleteRoleMapping')->name('ajax.DeleteRoleMapping');
				Route::match(array('POST'),'/DeleteOfficeMapping', 'AjaxController@DeleteOfficeMapping')->name('ajax.DeleteOfficeMapping');
				Route::match(array('POST'),'/GetEmployeeInfoByWeb', 'AjaxController@GetEmployeeInfoByWeb')->name('ajax.GetEmployeeInfoByWeb');
				Route::match(array('POST'),'/FindEmpRoleData', 'AjaxController@FindEmpRoleData')->name('ajax.FindEmpRoleData');
				Route::match(array('POST'),'/RoleMappingStatus', 'AjaxController@RoleMappingStatus')->name('ajax.RoleMappingStatus');
				Route::match(array('POST'),'/GetModulesDataForSection', 'AjaxController@GetModulesDataForSection')->name('ajax.GetModulesDataForSection');
				Route::match(array('POST'),'/GetSectionModuleWorkFlow', 'AjaxController@GetSectionModuleWorkFlow')->name('ajax.GetSectionModuleWorkFlow');
				Route::match(array('POST'),'/GeneratePdf', 'AjaxController@GeneratePdfCommon')->name('ajax.GeneratePdf');

				Route::match(array('POST'),'/GetWorkFlowEmployees', 'AjaxControllerCommonWorkFlow@GetWorkFlowEmployees')->name('ajax.GetWorkFlowEmployees');
				Route::match(array('POST'),'/DeleteDeviation', 'AjaxController@DeleteDeviation')->name('ajax.DeleteDeviation');
				Route::match(array('POST'),'/GetAdminName', 'AjaxController@GetAdminName')->name('ajax.GetAdminName');
				Route::match(array('POST'),'/GetDivSubSecModuleWorkFlow', 'AjaxController@GetDivSubSecModuleWorkFlow')->name('ajax.GetDivSubSecModuleWorkFlow'); 
				Route::match(array('POST'),'/FindDivisionRole', 'AjaxController@FindDivisionRole')->name('ajax.FindDivisionRole');
				Route::match(array('POST'),'/ajaxsss/CheckLTCLeaveApply', 'ChangeLTCAdvClaimController@CheckLTCLeaveApply')->name('ajax.CheckLTCLeaveApply');

			});

			Route::group(['prefix' => 'roles'], function() { 
				Route::match(array('GET','POST'),'/RoleMaster', 'RolesController@RoleMaster')->name('roles.RoleMaster');
				Route::match(array('GET','POST'),'/ViewRoleMaster', 'RolesController@ViewRoleMaster')->name('roles.ViewRoleMaster');
				//Route::match(array('GET','POST'),'/RoleMapping', 'RolesController@RoleMapping')->name('roles.RoleMapping');
				//Route::match(array('GET','POST'),'/switchRole', 'RolesController@switchRole')->name('roles.switchRole');
				Route::match(array('GET','POST'),'/ViewRoleMapping', 'RolesController@ViewRoleMapping')->name('roles.ViewRoleMapping');
				//Route::match(array('GET','POST'),'/RoleMenuMapping','RolesController@RoleMenuMapping',array('as'=>'jquery.RoleMenuMapping'))->name('roles.RoleMenuMapping');
			});

			Route::group(['prefix' => 'rolemapping'], function() { 
				Route::match(array('GET','POST'),'/RoleMapping', 'RoleMappingController@RoleMapping')->name('rolemapping.RoleMapping');
				Route::match(array('GET','POST'),'/switchRole', 'RoleMappingController@switchRole')->name('rolemapping.switchRole');
				Route::match(array('GET','POST'),'/ViewRoleMapping', 'RoleMappingController@ViewRoleMapping')->name('rolemapping.ViewRoleMapping');
				Route::match(array('GET','POST'),'/RoleMenuMapping','RoleMappingController@RoleMenuMapping',array('as'=>'jquery.RoleMenuMapping'))->name('rolemapping.RoleMenuMapping');
				Route::match(array('GET','POST'),'/getModuleAccess', 'RoleMappingController@getModuleAccess')->name('rolemapping.getModuleAccess');
				Route::match(array('GET','POST'),'/SwitchEmployeeRole', 'RoleMappingController@SwitchEmployeeRole')->name('rolemapping.SwitchEmployeeRole');
				Route::match(array('GET','POST'),'/SwitchRole', 'RoleMappingController@SwitchRole')->name('rolemapping.SwitchRole');
			});

			Route::group(['prefix' => 'bank'], function() { 
				Route::match(array('GET','POST'),'/Bank', 'BankController@BankMaster')->name('bank.Bank');
				Route::match(array('GET','POST'),'/ViewBankList', 'BankController@BankList')->name('bank.ViewBankList');
				Route::match(array('GET','POST'),'/BankBranch', 'BankController@BankBranchMaster')->name('bank.BankBranch');
				Route::match(array('GET','POST'),'/ViewBankBranchList', 'BankController@BankBranchList')->name('bank.ViewBankBranchList');
				Route::match(array('GET','POST'),'/BankInstrument', 'BankController@BankInstrument')->name('bank.BankInstrument');
				Route::match(array('GET','POST'),'/ViewBankInstruments', 'BankController@ViewBankInstruments')->name('bank.ViewBankInstruments');
				Route::match(array('POST'),'/DeleteBankInstrument', 'BankController@DeleteBankInstrument')->name('bank.DeleteBankInstrument');
				Route::match(array('POST'),'/DeleteBank', 'BankController@DeleteBank')->name('bank.DeleteBank');
				Route::match(array('POST'),'/DeleteBankBranch', 'BankController@DeleteBankBranch')->name('bank.DeleteBankBranch');
				Route::match(array('POST'),'/UndoDelete', 'BankController@UndoDelete')->name('bank.UndoDelete');
				Route::match(array('POST'),'/GetBankData', 'BankController@GetBankData')->name('bank.GetBankData');
				Route::match(array('GET','POST'),'/RBISanction', 'BankController@RBISanction')->name('bank.rbi-sanction');
				Route::match(array('GET','POST'),'/ImscAccountEntry', 'BankController@ImscAccountEntry')->name('bank.imsc-account-entry');
				Route::match(array('GET','POST'),'/ViewBankMaster', 'BankController@BankMasterView')->name('bank.ViewBankMaster');
				Route::match(array('GET','POST'),'/ViewBankBranchList', 'BankController@BankBranchList')->name('bank.ViewBankBranchList');
			});
			Route::group(['prefix' => 'budget-allocation'], function() { 
				Route::match(array('GET','POST'),'/budget-sanction', 'BudgetSanactionController@BudgetSanction')->name('budget.sanction-entry');
				Route::match(array('GET','POST'),'/budget-sanction-details', 'BudgetSanactionController@BudgetSanctionEntryDetails')->name('budget.sanction-details');
				Route::match(array('GET','POST'),'/budget-claim-details', 'BudgetSanactionController@BudgetSanctionClaimDetails')->name('budget.sanction-claim-details');
				Route::match(array('GET','POST'),'/budget-claim', 'BudgetSanactionController@BudgetClaim')->name('budget.budget-claim-entry');
				Route::match(array('GET','POST'),'/budget-received', 'BudgetSanactionController@BudgetRecived')->name('budget.budget-received-entry');
				Route::match(array('GET','POST'),'/budget-balance', 'BudgetSanactionController@BudgetBalance')->name('budget.balance-entry');
				Route::match(array('GET','POST'),'/budget-balance-view', 'BudgetSanactionController@BudgetBalanceView')->name('budget.balance-view');
			});
			Route::group(['prefix' => 'project-budget-sanction'], function() { 
                Route::match(array('GET','POST'),'/project-budget-sanction-initiate', 'ProjectBudgetSanctionController@ProjectBudgetSanctionInitiate')->name('budget.project-budget-sanction-initiate');
                Route::match(array('GET','POST'),'/project-budget-sanction', 'ProjectBudgetSanctionController@ProjectBudgetSanction')->name('budget.project-sanction-entry');
                Route::match(array('GET','POST'),'/sub-project-budget-sanction', 'ProjectBudgetSanctionController@SubProjectBudgetSanction')->name('budget.sub-project-sanction-entry');
                Route::match(array('GET','POST'),'/project-budget-sanction-finance-year', 'ProjectBudgetSanctionController@ProjectBudgetSanctionFinanceYear')->name('budget.project-sanction-entry-fy');
                Route::match(array('GET','POST'),'/sub-project-budget-sanction-finance-year', 'ProjectBudgetSanctionController@SubProjectBudgetSanctionFinanceYear')->name('budget.sub-project-sanction-entry-fy');
            });
			Route::group(['prefix' => 'budget-reports'], function() { 
                Route::match(array('GET','POST'),'/budget-reports', 'BudgetReportsController@BudgetReportsInitiate')->name('budget-reports.budget-reports');
                Route::match(array('GET','POST'),'/apex-project-object-head-consolidated', 'BudgetReportsController@ApexProjectObjectHeadConsolidated')->name('budget-reports.apex-project-object-head-consolidated');
                Route::match(array('GET','POST'),'/sub-project-object-head-consolidated', 'BudgetReportsController@SubProjectObjectHeadConsolidated')->name('budget-reports.sub-project-object-head-consolidated');
                Route::match(array('GET','POST'),'/revenue-object-head-consolidated', 'BudgetReportsController@RevenueObjectHeadConsolidated')->name('budget-reports.revenue-object-head-consolidated');
            });
			Route::group(['prefix' => 'budget-mapping'], function() { 
                Route::match(array('GET','POST'),'/gia-object-head-mapping', 'BudgetMappingController@GiaObjectHeadMapping')->name('budget-mapping.gia-object-head-mapping');
                Route::match(array('GET','POST'),'/object-head-ledger-mapping', 'BudgetMappingController@LedgerObjectHeadMapping')->name('budget-mapping.object-head-ledger-mapping');
				Route::match(array('GET','POST'),'/object-head-ledger-mapping-view', 'BudgetMappingController@LedgerObjectHeadMappingView')->name('budget-mapping.object-head-ledger-mapping-view');
            });
			Route::group(['prefix' => 'imsc-bank'], function() { 
				Route::match(array('GET','POST'),'/RBISanction', 'DaeSanctionController@BudgetSanction')->name('bank.rbi-sanction');
				Route::match(array('GET','POST'),'/ImscAccountEntry', 'ImscBankController@ImscAccountEntry')->name('bank.imsc-account-entry');
				Route::match(array('GET','POST'),'/DAEApexSanction', 'ApexSanctionController@BudgetSanction')->name('bank.dae-apex-sanction');
				Route::match(array('GET','POST'),'/ExternalSanction', 'ExternalSanctionController@BudgetSanction')->name('bank.external-sanction');
			});
			Route::group(['prefix' => 'module'], function() { 
				Route::match(array('GET','POST'),'/ModuleCreation', 'ModuleController@ModuleCreation')->name('module.ModuleCreation');
				Route::match(array('POST'),'/ModuleFind', 'ModuleController@ModuleFind')->name('module.ModuleFind');
			});
			Route::group(['prefix' => 'pfmr-unique-id'], function() { 
				Route::match(array('GET','POST'),'/pfmrw-unique-id', 'PFMRUniqueIdController@PFMRUniqueId')->name('pfmr_unique_id.pfmr_unique_id');
				Route::match(array('GET','POST'),'/view-pfmrw-unique-id', 'PFMRUniqueIdController@ViewPFMRUniqueId')->name('pfmr_unique_id.view-pfmr_unique_id');
			});
			Route::group(['prefix' => 'workflow-module'], function() { 
				Route::match(array('GET','POST'),'/workflow-module', 'WorkFlowModuleController@WorkFlowModules')->name('workflow.workflow-module');
				Route::match(array('GET','POST'),'/workflow-module-view', 'WorkFlowModuleController@ViewWorkFlowModules')->name('workflow.workflow-module-view');
			});
			Route::group(['prefix' => 'pfmr-unique-id'], function() { 
				Route::match(array('GET','POST'),'/pfmrw-unique-id', 'PFMRUniqueIdController@PFMRUniqueId')->name('pfmr_unique_id.pfmr_unique_id');
				Route::match(array('GET','POST'),'/view-pfmrw-unique-id', 'PFMRUniqueIdController@ViewPFMRUniqueId')->name('pfmr_unique_id.view-pfmr_unique_id');
			});
			Route::group(['prefix' => 'fellowship-rate'], function() { 
				Route::match(array('GET','POST'),'/fellowship-rate', 'FelowshipRateController@FelowshipRate')->name('fellowship-rate.fellowship-rate');
			});
			Route::group(['prefix' => 'workflow'], function() { 
				Route::match(array('GET','POST'),'/WorkFlowAssign', 'WorkFlowAssignController@WorkFlowAssign')->name('workflow.WorkFlowAssign');
				Route::match(array('GET','POST'),'/workFlowAssignWorkBased', 'WorkFlowAssignController@workFlowAssignWorkBased')->name('workflow.workFlowAssignWorkBased');
				Route::match(array('GET','POST'),'/WorkFlowChange', 'WorkFlowAssignController@WorkFlowChange')->name('workflow.WorkFlowChange'); 	
				Route::match(array('GET','POST'),'/ModuleWorkFlow', 'WorkFlowAssignController@ModuleWorkFlow')->name('workflow.ModuleWorkFlow');
				Route::match(array('GET','POST'),'/View-ModuleWorkFlow', 'WorkFlowAssignController@ViewModuleWorkFlow')->name('workflow.ViewModuleWorkFlow');
				Route::match(array('GET','POST'),'/ViewModuleWorkFlow', 'WorkFlowAssignController@ModuleWorkFlow')->name('workflow.ModuleWorkFlow');
				Route::match(array('GET','POST'),'/ModuleWorkFlowSectionWise', 'WorkFlowAssignController@ModuleWorkFlowSectionWise')->name('workflow.ModuleWorkFlowSectionWise');
				Route::match(array('GET','POST'),'/SaveEditModuleTargetRoles', 'WorkFlowAssignController@SaveEditModuleTargetRoles')->name('workflow.SaveEditModuleTargetRoles');
				Route::match(array('GET','POST'),'/get-workflow-employees', 'CommonWorkFlowController@GetWorkFlowEmployee')->name('workflow.get-workflow-employees');
			});
			Route::group(['prefix' => 'organization'], function() { 
				Route::match(array('GET','POST'),'/OfficeCreation', 'OrganizationController@OfficeCreation')->name('organization.OfficeCreation');
				Route::match(array('GET','POST'),'/ViewOffice', 'OrganizationController@ViewOffice')->name('organization.ViewOffice');
				Route::match(array('GET','POST'),'/Organization', 'OrganizationController@Organization')->name('organization.Organization');
				Route::match(array('GET','POST'),'/ViewOrganization', 'OrganizationController@ViewOrganization')->name('organization.ViewOrganization');
				Route::match(array('POST'),'/OfficeFind', 'OrganizationController@OfficeFind')->name('organization.OfficeFind');
				Route::match(array('POST'),'/Reporttooffice', 'OrganizationController@OfficeRepoToOffice')->name('organization.Reporttooffice');
			});
			Route::group(['prefix' => 'dashboard'], function() {    

				Route::match(array('POST'),'/DataReports', 'DashboardController@DataReports')->name('dashboard.DataReports');
				Route::match(array('POST'),'/GetDashboardDetails', 'DashboardController@GetDashboardDetails')->name('dashboard.GetDashboardDetails');
				//Route::match(array('GET','POST'),'/GetMyDeskData', 'DashboardController@GetMyDeskData')->name('dashboard.GetMyDeskData');

			});
			Route::group(['prefix' => 'EmploymentType'], function() {
				Route::match(array('GET','POST'),'/EmploymentType', 'EmploymentTypeController@EmploymentType')->name('EmploymentType.EmploymentType');
			});


			Route::group(['prefix' => 'EmployeeGroup'], function() {
				Route::match(array('GET','POST'),'/EmployeeGroupMaster', 'EmployeeGroupController@EmployeeGroupMaster')->name('EmployeeGroup.EmployeeGroupMaster');
			});
			
			Route::group(['prefix' => 'EmployeeType'], function() {
				Route::match(array('GET','POST'),'/EmployeeType', 'EmployeeTypeController@EmployeeType')->name('EmployeeType.EmployeeType');
			});
			Route::group(['prefix' => 'EmployeeCategory'], function() {
				Route::match(array('GET','POST'),'/EmployeeCategory', 'EmployeeCategoryController@EmployeeCategory')->name('EmployeeCategory.EmployeeCategory');
			});
			Route::group(['prefix' => 'DesignationMaster'], function() {
				Route::match(array('GET','POST'),'/DesignationMaster', 'DesignationMasterController@DesignationMaster')->name('DesignationMaster.DesignationMaster');
				Route::match(array('GET','POST'),'/ViewDesignationMaster', 'DesignationMasterController@ViewDesignationMaster')->name('DesignationMaster.ViewDesignationMaster');

				});

			Route::group(['prefix' => 'SendMail'], function() {

				Route::match(array('GET','POST'),'/SendRecoveryToVendor', 'SendMailController@SendRecoveryToVendor')->name('SendMail.SendRecoveryToVendor');
				Route::match(array('GET','POST'),'/MailVendor', 'SendMailController@MailVendor')->name('SendMail.MailVendor');
			
			});
			Route::group(['prefix' => 'rollBack'], function() {
				Route::match(array('GET','POST'),'/RollBackBill', 'RollBackController@RollBackBillList')->name('rollBack.RollBackBill');
				Route::match(array('GET','POST'),'/RollBack', 'RollBackController@RollBackBill')->name('rollBack.RollBack');
			});

			Route::group(['prefix' => 'payroll'], function() {
				Route::match(array('GET','POST'),'/SamplePage', 'PayrollController@SamplePage')->name('payroll.SamplePage');
			});
			Route::group(['prefix' => 'incometax'], function() {
				Route::match(array('GET','POST'),'/ITCalculation', 'IncomeTaxController@ITCalculation')->name('incometax.ITCalculation');
				Route::match(array('GET','POST'),'/tax-regime-selection', 'ITRegimeController@TaxRegimeSelection')->name('incometax.tax-regime-selection');
				Route::match(array('GET','POST'),'/projected-it-calculation', 'ProjectedTaxCalculationController@ProjectedITCalculation')->name('incometax.projected-it-calculation');
				Route::match(array('GET','POST'),'/final-it-calculation', 'IncomeTaxController@FinalTaxCalculation')->name('incometax.final-it-calculation');
				Route::match(array('GET','POST'),'/IncomeTaxRateFixation', 'IncomeTaxRateFixationController@IncomeTaxRateFixation')->name('income-tax-rate.income-tax-rate-fixation');
				Route::match(array('GET'),'/projected-it-calculation-info', 'ProjectedTaxCalculationController@ProjectedITCalculation')->name('incometax.projected-it-calculation-info');
			});
			Route::group(['prefix' => 'PayComponent'], function() {
				Route::match(array('GET','POST'),'/PayComponentType', 'PayComponentTypeController@PayComponentType')->name('PayComponent.PayComponentType');
				Route::match(array('GET','POST'),'/PayComponent', 'PayComponentsController@PayComponent')->name('PayComponent.PayComponent');
				Route::match(array('GET','POST'),'/PayComponentRule', 'PayComponentRulesController@PayComponentRule')->name('PayComponent.PayComponentRule');
				
			});
			Route::group(['prefix' => 'EmployeePay'], function() {
				Route::match(array('GET','POST'),'/EmployeeFixedPay', 'EmployeeFixedPayController@EmployeeFixedPay')->name('EmployeePay.EmployeeFixedPay');
				Route::match(array('GET','POST'),'/EmployeePayStructure', 'EmployeePayStructureController@EmployeePayStructure')->name('EmployeePay.EmployeePayStructure');
			});
			//Route::resource('roles', RolesController::class);
			//Route::resource('permissions', PermissionsController::class);
			// Route::group(['prefix' => 'LeaveMaster'], function() {
			// 	Route::match(array('GET','POST'),'/LeaveMaster', 'LeaveMasterController@LeaveMaster')->name('LeaveMaster.LeaveMaster');
			// 	// Check Later Route::match(array('GET','POST'),'/LeaveBalanceForDataEntry', 'ChangeRequestController@ShowLeaveBalanceForDataEntry')->name('LeaveBalanceForDataEntry.LeaveBalanceForDataEntry');

			// });
			//  Check Later Route::group(['prefix' => 'LeaveBalanceForDataEntry'], function() {
			// 	Route::match(array('GET','POST'),'/LeaveBalanceForDataEntry', 'LeaveBalanceController@ShowLeaveBalanceForDataEntry')->name('LeaveBalanceForDataEntry.LeaveBalanceForDataEntry');
			// 	// Route::match(array('GET','POST'),'/LeaveBalanceForDataEntry', 'ChangeRequestController@ShowLeaveBalanceForDataEntry')->name('LeaveBalanceForDataEntry.LeaveBalanceForDataEntry');

			// });
			Route::group(['prefix' => 'ResearchLevel'], function() {
				Route::match(array('GET','POST'),'/ResearchLevel', 'ResearchLevelController@ResearchLevel')->name('ResearchLevel.ResearchLevel');
			});

			Route::group(['prefix' => 'EbTrariffMaster'], function() {
				Route::match(array('GET','POST'),'/EBTariffCharge', 'EBChargeController@EBCharge')->name('EbTrariffMaster.EBTariffMaster');
				Route::match(array('GET','POST'),'/get-employee-details', 'EBChargeController@getEmployeeDetails')->name('EbTrariffMaster.get-employee-details');
			});
			Route::group(['prefix' => 'HouseMaster'], function() {
				Route::match(array('GET','POST'),'/HouseMaster', 'HouseMasterController@HouseMaster')->name('HouseMaster.HouseMaster');
				Route::match(array('GET','POST'),'/HouseAllotment', 'HouseMasterController@HouseAllotment')->name('HouseMaster.HouseAllotment');
				Route::match(array('GET','POST'),'/HouseVacation', 'HouseMasterController@HouseVacation')->name('HouseMaster.HouseVacation');
				Route::match(array('POST'),'/GetHouseData', 'HouseMasterController@GetHouseData')->name('HouseMaster.GetHouseData');

			});
			Route::group(['prefix' => 'HostelMaster'], function() {
				Route::match(array('GET','POST'),'/HostelMaster', 'HostelMasterController@HostelMaster')->name('HostelMaster.HostelMaster');
				Route::match(array('GET','POST'),'/HostelAllotment', 'HostelMasterController@HostelAllotment')->name('HostelMaster.HostelAllotment');
				Route::match(array('GET','POST'),'/HostelVacation', 'HostelMasterController@HostelVacation')->name('HostelMaster.HostelVacation');
			});
			Route::group(['prefix' => 'LicenceFeeWaterTariff'], function() {
				Route::match(array('GET','POST'),'/LicenceFeeWaterCharge', 'LicenceFeeWaterChargeController@LicenceFeeWaterCharge')->name('LicenceFeeWaterTariff.LicenceFeeWaterCharge');
			});
			Route::group(['prefix' => 'DefaultMasterValue'], function() {
				Route::match(array('GET','POST'),'/DefaultMasterValue', 'DefaultMasterValueController@DefaultMasterValue')->name('DefaultMasterValue.DefaultMasterValue');
			});

			Route::group(['prefix' => 'AllowanceAdvanceMaster'], function() {
				Route::match(array('GET','POST'),'/AllowanceAdvanceMaster',     'AllowanceAdvanceController@AllowanceAdvanceMaster')->name('AllowanceAdvanceMaster.AllowanceAdvanceMaster');
				Route::match(array('GET','POST'),'/ViewAllowanceAdvanceMaster', 'AllowanceAdvanceController@ViewAllowanceAdvanceMaster')->name('AllowanceAdvanceMaster.ViewAllowanceAdvanceMaster');

			});

			Route::group(['prefix' => 'Project'], function() {
				Route::match(array('GET','POST'),'/project-master', 'ProjectMasterController@ProjectMaster')->name('Project.project-master');
				Route::match(array('POST'),'/ProjectGroupFind', 'ProjectMasterController@ProjectGroupFind')->name('Project.ProjectGroupFind');
				Route::match(array('GET','POST'),'/project-head', 'ProjectMasterController@ProjectHead')->name('Project.project-head');
				Route::match(array('GET','POST'),'/project-staff', 'ProjectMasterController@ProjectStaff')->name('Project.project-staff');
				Route::match(array('GET','POST'),'/project-sub-project-master', 'ProjectMasterController@SubProjectMaster')->name('Project.sub-project-master');
			    Route::match(array('GET','POST'),'/view-project-master', 'ProjectMasterController@ViewProjectMaster')->name('Project.view-project');
			});
			Route::group(['prefix' => 'SdAndPO'], function() {
				Route::match(array('GET','POST'),'/sd-entry', 'SdAndPgEntryController@SDentyForm')->name('sdpo-entry.sd-entry');
				Route::match(array('GET','POST'),'/pg-entry', 'SdAndPgEntryController@POentyForm')->name('sdpo-entry.pg-entry');
				Route::match(array('GET','POST'),'/get-sd-percentage', 'SdAndPgEntryController@getSdPercentage')->name('SdAndPO.get-sd-percentage');
				Route::match(array('GET','POST'),'/po-sd-pg', 'SdAndPgEntryController@PoSDPGData')->name('sdpo.po-sd-pg');
				Route::match(array('GET','POST'),'/sd-view', 'PurchaseOrderController@ViewPurchaseOrderForSD')->name('sdpo-entry.view-sd');
				Route::match(array('GET','POST'),'/pg-view', 'PurchaseOrderController@ViewPurchaseOrderForPG')->name('sdpo-entry.view-pg');
			});
			
			Route::group(['prefix' => 'change-request'], function() {
				Route::match(array('GET','POST'),'/address-change-request-list', 'ChangeAddressRequestController@EmpChangeAddrReqSelfServiceList')->name('change-request.address-change-request-list');
				Route::match(array('GET','POST'),'/address-change-request', 'ChangeAddressRequestController@EmpChangeAddrReqSelfService')->name('change-request.address-change-request');
				Route::match(array('GET','POST'),'/address-change-request-process', 'ChangeAddressRequestController@EmpChangeAddrReqProcess')->name('change-request.address-change-request-process');
				Route::match(array('GET','POST'),'/address-change-request-pending-list', 'ChangeAddressRequestController@EmpChangeAddrReqPendingList')->name('change-request.address-change-request-pending-list');
				Route::match(array('GET','POST'),'/export-employee-id-pdf', 'ChangeAddressRequestController@ExportEmployeeAddressPdf')->name('change-request.address.export-address-pdf');


				Route::match(array('GET','POST'),'/home-town-change-request-list', 'ChangeHomeTownRequestController@EmpChangeHomeTownReqSelfServiceList')->name('change-request.hometown-change-request-list');
				Route::match(array('GET','POST'),'/home-town-change-request', 'ChangeHomeTownRequestController@EmpChangeHomeTownReqSelfService')->name('change-request.home-town-change-request');
				Route::match(array('GET','POST'),'/home-town-change-request-process', 'ChangeHomeTownRequestController@EmpChangeHomeTownReqProcess')->name('change-request.hometown-change-request-process');
				Route::match(array('GET','POST'),'/home-town-change-request-pending-list', 'ChangeHomeTownRequestController@EmpChangeHomeTownReqPendingList')->name('change-request.hometown-change-request-pending-list');

				Route::match(array('GET','POST'),'/contact-change-request-list', 'ChangeContactRequestController@EmpChangeContactReqSelfServiceList')->name('change-request.contact-change-request-list');
				Route::match(array('GET','POST'),'/contact-change-request', 'ChangeContactRequestController@EmpChangeContactReqSelfService')->name('change-request.contact-change-request');
				Route::match(array('GET','POST'),'/contact-change-request-process', 'ChangeContactRequestController@EmpContactReqProcess')->name('change-request.contact-change-request-process');
				Route::match(array('GET','POST'),'/contact-change-request-pending-list', 'ChangeContactRequestController@EmpChangeContactReqPendingList')->name('change-request.contact-change-request-pending-list');

				Route::match(array('GET','POST'),'/marital-status-change-request-list', 'ChangeMaritalRequestController@EmpChangeMaritalStatusReqSelfServiceList')->name('change-request.marital-change-request-list');
				Route::match(array('GET','POST'),'/marital-status-request', 'ChangeMaritalRequestController@EmpChangeMaritalStatusReqSelfService')->name('change-request.marital-change-request');
				Route::match(array('GET','POST'),'/marital-status-request-process', 'ChangeMaritalRequestController@EmpMaritalStatusReqProcess')->name('change-request.marital-change-request-process');
				Route::match(array('GET','POST'),'/marital-status-request-pending-list', 'ChangeMaritalRequestController@EmpChangeMaritalStatusReqPendingList')->name('change-request.marital-change-request-pending-list');

				Route::match(array('GET','POST'),'/physical-disability-change-request-list', 'ChangePhysicaldisabilityRequestController@EmpChangePhysicaldisabilityReqSelfServiceList')->name('change-request.physical-disability-change-request-list');
				Route::match(array('GET','POST'),'/physical-disability-request', 'ChangePhysicaldisabilityRequestController@EmpChangePhysicaldisabilityReqSelfService')->name('change-request.physical-disability-change-request');
				Route::match(array('GET','POST'),'/physical-disability-request-process', 'ChangePhysicaldisabilityRequestController@EmpPhysicaldisabilityReqProcess')->name('change-request.physical-disability-change-request-process');
				Route::match(array('GET','POST'),'/physical-disability-request-pending-list', 'ChangePhysicaldisabilityRequestController@EmpChangePhysicaldisbilityReqPendingList')->name('change-request.physical-disability-change-request-pending-list');

				Route::match(array('GET','POST'),'/bank-details-change-request-list', 'ChangeBankDetailRequestController@EmpChangeBankReqSelfServiceList')->name('change-request.bank-details-change-request-list');
				Route::match(array('GET','POST'),'/bank-details-change-request', 'ChangeBankDetailRequestController@EmpChangeBankReqSelfService')->name('change-request.bank-details-change-request');
				Route::match(array('GET','POST'),'/bank-details-change-request-process', 'ChangeBankDetailRequestController@EmpChangeBankReqProcess')->name('change-request.bank-details-change-request-process');
				Route::match(array('GET','POST'),'/bank-details-change-request-pending-list', 'ChangeBankDetailRequestController@EmpChangeBankReqPendingList')->name('change-request.bank-details-change-request-pending-list');

				Route::match(array('GET','POST'),'/ltc-adv-change-request-list', 'ChangeLTCAdvClaimController@EmpChangeLTCReqSelfServiceList')->name('change-request.ltc-adv-change-request-list');
                Route::match(array('GET','POST'),'/ltc-adv-change-request', 'ChangeLTCAdvClaimController@EmpChangeLTCReqSelfService')->name('change-request.ltc-adv-change-request');
                Route::match(array('GET','POST'),'/ltc-adv-change-request-process', 'ChangeLTCAdvClaimController@EmpChangeLTCReqProcess')->name('change-request.ltc-adv-change-request-process');
                Route::match(array('GET','POST'),'/ltc-adv-change-request-pending-list', 'ChangeLTCAdvClaimController@EmpChangeLTCReqPendingList')->name('change-request.ltc-adv-change-request-pending-list');
                Route::match(array('GET','POST'),'/ltc-adv-status', 'ChangeLTCAdvClaimController@LtcStatusList')->name('ltc-adv.ltc-adv-status-list');

				Route::match(array('GET','POST'),'/ltc-claim-change-request-list', 'ChangeLTCAdvClaimController@EmpChangeClaimReqSelfServiceList')->name('change-request.ltc-settlement-change-request-list');
                Route::match(array('GET','POST'),'/ltc-claim-change-request', 'ChangeLTCAdvClaimController@EmpChangeLTCClaimSelfService')->name('change-request.ltc-settlement-change-request');
                Route::match(array('GET','POST'),'/ltc-claim-change-request-process', 'ChangeLTCAdvClaimController@EmpChangeClaimReqProcess')->name('change-request.ltc-settlement-change-request-process');
                Route::match(array('GET','POST'),'/ltc-claim-change-request-pending-list', 'ChangeLTCAdvClaimController@EmpChangeClaimReqPendingList')->name('change-request.ltc-settlement-change-request-pending-list');
                Route::match(array('GET','POST'),'/ltc-claim-status-list', 'ChangeLTCAdvClaimController@LTCClaimStatusList')->name('ltc-claim.ltc-claim-status-list');
				Route::match(array('GET','POST'),'/export-employee-ltc-pdf', 'ChangeLTCAdvClaimController@ExportEmployeeLtcAdvPdf')->name('change-request.ltcadvclaim.export-ltc-adv-pdf');


				Route::match(array('GET','POST'),'/empaddr-change-request', 'ChangeRequestController@EmpAddrChangeRequest')->name('change-request.empaddr-change-request');
				Route::match(array('GET','POST'),'/empaddr-request', 'ChangeRequestController@EmpAddrChangeRequestProcess')->name('change-request.empaddr-request');
				Route::match(array('GET','POST'),'/empname-change-request', 'ChangeRequestController@EmpNameChangeRequest')->name('change-request.empname-change-request');
				//Route::match(array('GET','POST'),'/empaddr-change-request', 'ChangeRequestController@EmpAddrChangeRequest')->name('change-request.empaddr-change-request');
				//Route::match(array('GET','POST'),'/empaddr-request', 'ChangeRequestController@EmpAddrChangeRequestProcess')->name('change-request.empaddr-request');
				Route::match(array('GET','POST'),'/empcontact-change-request', 'ChangeRequestController@EmpContactChangeRequest')->name('change-request.empcontact-change-request1');
				Route::match(array('GET','POST'),'/empbankdetails-change-request', 'ChangeRequestController@EmpBankDetailsChangeRequest')->name('change-request.empbankdetails-change-request');
				Route::match(array('GET','POST'),'/document-upload-request', 'ChangeRequestController@DocumentUploadRequest')->name('change-request.document-upload-request');
				Route::match(array('GET','POST'),'/nominee-update-request', 'ChangeRequestController@NomineeUpdateRequest')->name('change-request.nominee-update-request');
				Route::match(array('GET','POST'),'/maritalstatus-change-request', 'ChangeRequestController@MaritalStatusUpdateRequest')->name('change-request.maritalstatus-change-request');
				Route::match(array('GET','POST'),'/empfamilydetails-change-request', 'ChangeRequestController@FamilyDetailUpdateRequest')->name('change-request.empfamilydetails-change-request');
				Route::match(array('GET','POST'),'/physicaldisability-change-request', 'ChangeRequestController@PhysicalDisabilityRequest')->name('change-request.physicaldisability-change-request');
				Route::match(array('GET','POST'),'/id-card-request', 'ChangeRequestController@IDCardRequest')->name('change-request.id-card-request');
				Route::match(array('GET','POST'),'/export-id-card-request-pdf', 'ChangeRequestController@ExportIdCardRequestPdf')->name('change-request.export-id-card-pdf');
				Route::match(array('GET','POST'),'/medical-card-request', 'ChangeRequestController@MedicalCardRequest')->name('change-request.medical-card-request');
				Route::match(array('GET','POST'),'/leave-join-request', 'ChangeRequestController@LeaveJoiningRequest')->name('change-request.leave-join-request');
				Route::match(array('GET','POST'),'/leave-request', 'ChangeRequestController@LeaveRequest')->name('change-request.leave-request');
				Route::match(array('GET','POST'),'/ltcadvance-request', 'ChangeRequestController@AdvClaimLTCRequest')->name('change-request.adv-claim-ltc-request');
				Route::match(array('GET','POST'),'/hra-claim-request', 'ChangeRequestController@HRAClaimRequest')->name('change-request.hra-claim-request');
				Route::match(array('GET','POST'),'/datcrd-mobphn-chrg-clm-request', 'ChangeRequestController@DataCardMobPhonChrgClaimRequest')->name('change-request.datcrd-mobphn-chrg-clm-request');
				Route::match(array('GET','POST'),'/cpf-gpf-advan-request', 'ChangeRequestController@CPFGPFAdvanceRequest')->name('change-request.cpf-gpf-advan-request');
				Route::match(array('GET','POST'),'/witdraw-fr-cpf-gpf-request', 'ChangeRequestController@WitDrawFrCPFGPFRequest')->name('change-request.witdraw-fr-cpf-gpf-request');
				Route::match(array('GET','POST'),'/pf-addi-subcr-request', 'ChangeRequestController@PFAddiSubscriRequest')->name('change-request.pf-addi-subcr-request');
				Route::match(array('GET','POST'),'/fix-of-pay-promo-app-request', 'ChangeRequestController@FixOfPayPromoAppRequest')->name('change-request.fix-of-pay-promo-app-request');
				Route::match(array('GET','POST'),'/reimbur-book-allow-request', 'ChangeRequestController@ReimburBokAllowRequest')->name('change-request.reimbur-book-allow-request');
				Route::match(array('GET','POST'),'/clm-honrm-ur-teach-assi-request', 'ChangeRequestController@ClmHonoUdrTeachAssiRequest')->name('change-request.clm-honrm-ur-teach-assi-request');
				Route::match(array('GET','POST'),'/el-encash-ltc-request', 'ChangeRequestController@ELEncashLTCRequest')->name('change-request.el-encash-ltc-request');
				Route::match(array('GET','POST'),'/sett-claim-ltc-request', 'ChangeRequestController@SettClaimLTCRequest')->name('change-request.sett-claim-ltc-request');
				Route::match(array('GET','POST'),'/home-town-request', 'ChangeRequestController@HomeTownRequest')->name('change-request.home-town-request');
			});
			Route::group(['prefix' => 'cea'], function() {
				Route::match(array('GET','POST'),'/cea-application', 'CeaController@CeaReimbursementRequest')->name('cea.cea-Application');

            });
			Route::group(['prefix' => 'ta'], function() {
				Route::match(array('GET','POST'),'/tada-exp-claim-request', 'TaController@TADAExpClaimRequest')->name('ta.tada-exp-claim-request');
				Route::match(array('GET','POST'),'/View-tada-exp-claim-request', 'TaController@ViewTADAExpClaimList')->name('ta.view-ta-exp-claim-list');
			});
			Route::group(['prefix' => 'material-type'], function() {
				Route::match(array('GET','POST'),'/material-type', 'MaterialtypeController@Materialtype')->name('material-type.material-type');
			});
			Route::group(['prefix' => 'material-unit-master'], function() {
				Route::match(array('GET','POST'),'/material-unit-master', 'MaterialUnitController@MaterialUnit')->name('material-unit-master.material-unit-master');
			});
			Route::group(['prefix' => 'cea'], function() {
				Route::match(array('GET','POST'),'/cea', 'ChildEducationAllowanceController@cearate')->name('cea.cea-rate');
			});
			Route::group(['prefix' => 'attendance'], function() {
                Route::match(array('GET','POST'),'/ManualAttendance', 'AttendanceController@ManualAttendance')->name('attendance.ManualAttendance');
            });
			Route::group(['prefix' => 'payslip'], function() {
				Route::match(array('GET','POST'),'/payslip-generate', 'PayslipController@PaySlipGenerate')->name('payslip.payslip-generate');
			});
			
			Route::group(['prefix' => 'payroll'], function() {
				Route::match(array('GET','POST'),'/pay-generate', 'PayrollController@PayGenerate')->name('payroll.pay-generate');
				Route::match(array('GET','POST'),'/pay-save', 'PayrollController@SavePayRoll')->name('payroll.pay-save');
			});
			// Route::group(['prefix' => 'LeaveBalance'], function() {
			// 	Route::match(array('GET','POST'),'/LeaveBalance', 'LeaveBalanceController@LeaveType')->name('LeaveBalance.LeaveBalanceForDataEntry');
			// 	Route::match(array('GET','POST'),'/GetEmpLeaveBalance', 'LeaveBalanceController@GetEmpLeaveBalance')->name('LeaveBalance.GetEmpLeaveBalance');
			// });
			Route::group(['prefix' => 'LeaveBalance'], function() {
				Route::match(array('GET','POST'),'/LeaveBalance', 'LeaveBalanceController@LeaveType')->name('LeaveBalance.LeaveBalanceForDataEntry');
				Route::match(array('GET','POST'),'/GetEmpLeaveBalance', 'LeaveApplicationController@getEmpLeaveBalance')->name('LeaveBalance.GetEmpLeaveBalance');
			});
			Route::group(['prefix' => 'dependent'], function() {
				Route::match(array('POST'),'/get-dependent', 'DependentController@GetDependent')->name('dependent.get-dependent');
			});
			Route::group(['prefix' => 'relationship'], function() {
				Route::match(array('POST'),'/get-relationship', 'RelationshipController@GetRelationShip')->name('relationship.get-relationship');
				Route::match(array('POST'),'/get-relationship-relationid', 'RelationshipController@GetRelationShipByRelationId')->name('relationship.get-relationship-relationid');
			});
			// Route::group(['prefix' => 'budget-allocation'], function() { 
            //     Route::match(array('GET','POST'),'/budget-sanction', 'BudgetSanactionController@BudgetSanction')->name('budget.sanction-entry');
            //     Route::match(array('GET','POST'),'/budget-sanction-details', 'BudgetSanactionController@BudgetSanctionEntryDetails')->name('budget.sanction-details');
            //     Route::match(array('GET','POST'),'/budget-claim', 'BudgetSanactionController@BudgetClaim')->name('budget.budget-claim-entry');
            //     Route::match(array('GET','POST'),'/budget-received', 'BudgetSanactionController@BudgetRecived')->name('budget.budget-received-entry');
            // });
			Route::group(['prefix' => 'LeaveApplication'], function() {
				Route::match(array('GET','POST'),'/LeaveApplicationAdmin', 'LeaveApplicationController@LeaveApplicationAdmin')->name('LeaveApplication.LeaveApplicationAdmin');
				Route::match(array('GET','POST'),'/LeaveApplicationSelf', 'LeaveApplicationController@LeaveApplicationSelf')->name('LeaveApplication.LeaveApplicationSelf');
				Route::match(array('GET','POST'),'/LeaveApplicationPendingSelfList', 'LeaveApplicationController@LeaveApplicationPendingSelfList')->name('LeaveApplication.LeaveApplicationPendingSelfList');
				Route::match(array('GET','POST'),'/LeaveApplicationPendingAdminList', 'LeaveApplicationController@LeaveApplicationPendingAdminList')->name('LeaveApplication.LeaveApplicationPendingAdminList');

				Route::match(array('GET','POST'),'/CalculateDays', 'LeaveApplicationController@calculateLeaveDays')->name('leave.calculateDays');
				Route::match(array('GET','POST'),'/AllBalances', 'LeaveApplicationController@getAllLeaveBalances')->name('leave.allBalances');
				Route::match(array('GET','POST'),'/LeaveApprovalList', 'LeaveApplicationController@LeaveApprovalList')->name('leave.LeaveApprovalList');
				Route::match(array('GET','POST'),'/ViewLeaveApplication', 'LeaveApplicationController@ViewLeaveApplication')->name('leave.ViewLeaveApplication');
				Route::match(array('GET','POST'),'/LeaveMaster', 'LeaveMasterController@LeaveMaster')->name('LeaveMaster.LeaveMaster');
			});
			Route::group(['prefix' => 'ledger'], function() {
				Route::match(array('GET','POST'),'/ledgergroupcreation', 'LedgerController@LedgerGroupcreation')->name('ledger.ledger-group-creation');
				Route::match(array('GET','POST'),'/ledgercreation', 'LedgerController@Ledgercreation')->name('ledger.ledger-creation');
				Route::match(array('POST'),'/LedgerGroupFind', 'LedgerController@LedgerGroupFind')->name('ledger.LedgerGroupFind');
			});
			Route::group(['prefix' => 'Indent'], function() {
				Route::match(array('GET','POST'),'/Indent', 'IndentController@IndentCreation')->name('indent.indent-creation');
				Route::match(array('GET','POST'),'/IndentView', 'IndentController@IndentView')->name('indent.indent-view');
				Route::match(array('GET','POST'),'/IndentsubmittedView', 'IndentController@IndentsubmittedView')->name('indent.indent-submitted-view');
				Route::match(array('GET','POST'),'/IndentForward','IndentController@IndentForward')->name('indent.indent-forward-to-accounts');
				Route::match(array('GET','POST'),'/IndentStatus','IndentController@IndentStatus')->name('indent.indent-staus');
				Route::match(array('GET','POST'),'/Indent-All-Status','IndentController@IndentAllStatus')->name('indent.indent-all-staus');
				Route::match(array('POST'),'/IndentStatus', 'IndentController@IndentStatus')->name('indent.indent-status-view');
				Route::match(array('POST'),'/IndentData', 'IndentController@GetIndentData')->name('indent.GetIndentData');
				Route::match(array('POST'),'/GetIndentAjaxData', 'IndentController@GetIndentAjaxData')->name('indent.GetIndentAjaxData');
				Route::match(array('POST'),'/GetIndentConsumableData', 'IndentController@GetIndentConsumableData')->name('indent.GetIndentConsumableData');
				Route::match(array('POST'),'/GetObjectHeadData', 'IndentController@GetObjectHeadData')->name('indent.GetObjectHeadData');
				Route::match(array('GET','POST'),'/approved-indent-sanction-list', 'IndentController@SanctionApproval')->name('indent.approved-indent-sanction-list');
				Route::match(array('GET','POST'),'/sanction-process', 'IndentController@SanctionProcessStatus')->name('indent.sanction-process');
				Route::match(array('GET','POST'),'/approved-indent-status', 'IndentController@IndentStatusUpdate')->name('indent.approved-indent-status');
				Route::match(array('GET','POST'),'/sanction-doc-upload', 'IndentController@SanctionDocumentUpload')->name('indent.sanction-document-upload');
				Route::match(array('GET','POST'),'/DownloadFile', 'IndentController@DownloadFile')->name('indent.sanction-document-download');
				Route::match(array('GET','POST'),'/sanction-SupportingDoc', 'IndentController@SancationSupportingDoc')->name('indent.sanction-SupportingDoc');
			});
			Route::group(['prefix' => 'Vouchers'], function() { 
				Route::match(array('GET','POST'),'/Vouchers', 'VouchersController@Vouchers')->name('Voucher.Vouchers');
				Route::match(array('GET','POST'),'/voucher-creation-list', 'VouchersController@VoucherCreationList')->name('Voucher.voucher-creation-list');
				Route::match(array('GET','POST'),'/get-transaction-data', 'VouchersController@GetTransactionData')->name('Voucher.get-transaction-data');
				Route::match(array('GET','POST'),'/get-transaction-mapping-data', 'VouchersController@GetTransactionMappingData')->name('Voucher.get-transaction-mapping-data');
				Route::match(array('GET'),'/get-paydata-ledger-group', 'VouchersController@GetLegderGroupPayData')->name('Voucher.get-paydata-ledger-group');
				Route::match(array('GET','POST'),'/voucher-view-list', 'VouchersController@VoucherViewList')->name('Voucher.voucher-view-list');
			});
			Route::group(['prefix' => 'payment'], function() { 
				Route::match(array('GET','POST'),'/salary-payment-creation-list', 'SalaryPaymentController@SalaryPaymentCreationList')->name('payment.salary-payment-creation-list');
				Route::match(array('GET','POST'),'/salary-payment-create', 'SalaryPaymentController@SalaryPaymentCreate')->name('payment.salary-payment-create');
				Route::match(array('GET','POST'),'/indent-bill-payment-creation-list', 'BillPaymentController@BillPaymentCreationList')->name('payment.indent-bill-payment-creation-list');
				Route::match(array('GET','POST'),'/indent-bill-payment-create', 'BillPaymentController@BillPaymentCreate')->name('payment.indent-bill-payment-create');
				Route::match(array('GET','POST'),'/other-payment-creation-list', 'OtherPaymentController@OtherPaymentCreationList')->name('payment.other-payment-creation-list');
				Route::match(array('GET','POST'),'/other-payment-creation', 'OtherPaymentController@OtherPaymentCreate')->name('payment.other-payment-creation');
			});
			Route::group(['prefix' => 'wating-approval'], function() {
				Route::match(array('GET','POST'),'/AddressUpdateApproval', 'WaitingApprovalController@AddressApproval')->name('wating-for-approval.addr-update-approval');
			});
			Route::group(['prefix' => 'wating-approval'], function() {
				Route::match(array('GET','POST'),'/AddressUpdateApproval', 'WaitingApprovalController@AddressApproval')->name('wating-for-approval.addr-update-approval');
				Route::match(array('GET','POST'),'/ContactUpdateApproval', 'WaitingApprovalController@ContactApproval')->name('wating-for-approval.contact-update-approval');
				Route::match(array('GET','POST'),'/BankDetaisUpdateApproval', 'WaitingApprovalController@BankDetailsApproval')->name('wating-for-approval.bank-details-update-approval');
				Route::match(array('GET','POST'),'/MaritalStatusUpdateApproval', 'WaitingApprovalController@MaritalStatusUpdateApproval')->name('wating-for-approval.marital-status-update-approval');
				Route::match(array('GET','POST'),'/PhyscialDisabilityUpdateApproval', 'WaitingApprovalController@PhysicalUpdateApproval')->name('wating-for-approval.physical-disability-update-approval');
			});
			Route::group(['prefix' => 'item-master'], function() {
				Route::match(array('GET','POST'),'/item-master', 'ItemController@ItemMaster')->name('item-master.item-master');
			});

			Route::group(['prefix' => 'rc-item-master'], function() {
				Route::match(array('GET','POST'),'/rc-item-master', 'RcItemController@ItemGroupcreation')->name('rc-item-master.rc-item-master');
				Route::match(array('POST'),'/ItemGroupFind', 'RcItemController@ItemGroupFind')->name('Item.ItemGroupFind');
				Route::match(array('GET','POST'),'/view-item-master', 'RcItemController@ViewItemMaster')->name('rc-item-master.view-rc-item-master');
				Route::match(array('POST'),'/ItemData', 'RcItemController@GetItemData')->name('Item.GetItemData');

			});

			Route::group(['prefix' => 'vendor'], function() {
				Route::match(array('GET','POST'),'/vendor-entry-form', 'VendorController@VenodorEntryForm')->name('vendor.vendor-entry-form');
			});
			
			Route::group(['prefix' => 'purchase-order'], function() {
				Route::match(array('GET','POST'),'/purchase-order-form', 'PurchaseOrderController@PurchaseOrderForm')->name('purchase-order.purchase-order_form');
				Route::match(array('GET','POST'),'/purchase-order_view', 'PurchaseOrderController@PurchaseOrderView')->name('purchase-order.purchase-order_view');
				Route::match(array('GET','POST'),'/purchase-order-register', 'PurchaseOrderController@PurchaseOrderRegister')->name('purchase-order.purchase-order-register');
			});
			Route::group(['prefix' => 'amc-purchase-order'], function() {
				Route::match(array('GET','POST'),'/amc-purchase-order-creation', 'AMCPurchaseOrderController@AMCPurchaseOrderCreation')->name('amc-purchase-order.amc-purchase-order-creation');
				Route::match(array('GET','POST'),'/amc-purchase-order-submission', 'AMCPurchaseOrderController@AMCPurchaseOrderEditSubmit')->name('amc-purchase-order.amc-purchase-order-submission');
				Route::match(array('GET','POST'),'/amc-purchase-order-register', 'AMCPurchaseOrderController@AMCPurchaseOrderRegister')->name('amc-purchase-order.amc-purchase-order-register');
			});
			Route::group(['prefix' => 'register'], function() {
				Route::match(array('GET','POST'),'/register', 'StockRegisterController@StockRegister')->name('register.stock-register');
				Route::match(array('GET','POST'),'/registeinventory', 'InventoryRegisterController@InventoryRegister')->name('register.Inventory-register');
			});
			Route::group(['prefix' => 'amc-material'], function() {
				Route::match(array('GET','POST'),'/amc-material-entry', 'AMCMaterialInwardController@AMCMaterialInwardEntry')->name('amc-material.amc-material-inward-entry');
				Route::match(array('GET','POST'),'/amc-material', 'AMCMaterialInwardController@AMCMaterialInwardList')->name('amc-material.amc-material-inward-list');
				Route::match(array('GET','POST'),'/amc-submit', 'AMCMaterialInwardController@AMCMaterialInwardSubmission')->name('amc-material.amc-material-inward-submit');
				Route::match(array('GET','POST'),'/amc-material-payment', 'AMCMaterialInwardController@AMCMaterialInwardPaymentSubmission')->name('amc-material-payment.amc-material-inward-payment-submission');
			});
			Route::group(['prefix' => 'Material'], function() {
				Route::match(array('GET','POST'),'/Material', 'MaterialInwardController@MaterialInwardCreation')->name('material.material-inward-creation');
				Route::match(array('GET','POST'),'/MaterialInwardSubmission', 'MaterialInwardController@MaterialInwardSubmission')->name('material.material-inward-submission');
				Route::match(array('GET','POST'),'/MaterialInwardPaymentSubmission', 'MaterialInwardController@MaterialInwardPaymentSubmission')->name('material.material-inward-payment-submission');
				Route::match(array('GET','POST'),'/MaterialInwardDeliveryChallanUpload', 'MaterialInwardController@MaterialInwardDeliveryChallanUpload')->name('material.material-inward-delivery-Challan-upload');
                Route::match(array('GET','POST'),'/MaterialInwardDeliveryChallanQty', 'MaterialInwardController@MaterialInwardDeliveryChallanQty')->name('material.material-inward-delivery-Challan-qty');

			});
			Route::group(['prefix' => 'Material-pending-payement'], function() {
                Route::match(array('GET','POST'),'/MaterialInwardPendingPaymentList', 'MaterialInwardPendingPaymentController@MaterialInwardPendingPaymentList')->name('material.material-inward-pending-payment');
                Route::match(array('GET','POST'),'/MaterialInwardPendingPaymentSubmit', 'MaterialInwardPendingPaymentController@MaterialInwardPendingPaymentSubmit')->name('material.material-inward-pending-payment-submission');
			});
			Route::group(['prefix' => 'register'], function() {
				Route::match(array('GET','POST'),'/registerlibrary', 'AMCLibraryRegisterController@AMCLibraryRegister')->name('register.amc-library-register');
			});
			Route::group(['prefix' => 'register'], function() {
				Route::match(array('GET','POST'),'/registeramcElectrical', 'AMCElectricalRegisterController@AMCElectricalRegister')->name('register.amc-electrical-register');
			});
			Route::group(['prefix' => 'physical-stock'], function() {
				Route::match(array('GET','POST'),'/physical-stock', 'PhysicalStockCreationController@PhysicalStockCreation')->name('physical-stock.Physical-Stock-Creation');
				Route::match(array('POST'),'/MaterialGroupFind', 'PhysicalStockCreationController@MaterialGroupFind')->name('physical-stock.materialGroupFind');
				Route::match(array('GET','POST'),'/physical-stock-view', 'PhysicalStockCreationController@PhysicalStockview')->name('physical-stock.physical-stock-view');

			});	
			Route::group(['prefix' => 'location'], function() {
				Route::match(array('GET','POST'),'/location', 'LocationController@LocationMaster')->name('location.location-master');
				Route::match(array('GET','POST'),'/locationView', 'LocationController@ViewLocationMaster')->name('location.ViewLocationMaster');
			});
			Route::group(['prefix' => 'amc'], function() {
				Route::match(array('GET','POST'),'/AmscLiveUpdate', 'AMCController@AmscLiveUpdate')->name('amc.amsc-live-update');
				Route::match(array('GET','POST'),'/ViewAmscLiveUpdate', 'AMCController@AmscLiveUpdate')->name('amc.amsc-view-live-update');
			});
			Route::group(['prefix' => 'budget-estimate'], function() {
				Route::match(array('GET','POST'),'/budget-estimate', 'BudgetEstimateController@BudgetEstimate')->name('budget-estimate.budget-estimate');
			});
			Route::group(['prefix' => 'project-mapping'], function() {
				Route::match(array('GET','POST'),'/project-mapping', 'ProjectMappingController@projectHeadMapping')->name('project-mapping.project-mapping-create');
			});
			Route::group(['prefix' => 'request-updates'], function() {
				Route::match(array('GET','POST'),'/addr-update', 'RequestUpdatesController@AddressUpdate')->name('request-updates.addr-update');

				
				Route::match(array('GET','POST'),'/contact-no-update', 'RequestUpdatesController@ContactUpdate')->name('request-updates.contact-no-update');
				Route::match(array('GET','POST'),'/bank-details-update', 'RequestUpdatesController@BankDetailsUpdate')->name('request-updates.bank-details-update');
				Route::match(array('GET','POST'),'/family-members-update', 'RequestUpdatesController@FamilyMembersUpdate')->name('request-updates.family-members-update');
				Route::match(array('GET','POST'),'/martial-status-update', 'RequestUpdatesController@MaritalStatusUpdate')->name('request-updates.martial-status-update');
				Route::match(array('GET','POST'),'/nominee-update', 'RequestUpdatesController@NomineeUpdate')->name('request-updates.nominee-update');
				Route::match(array('GET','POST'),'/physical-disability-update', 'RequestUpdatesController@PhysicalDisabilityUpdate')->name('request-updates.physical-disability-update');
				Route::match(array('GET','POST'),'/id-card-update', 'RequestUpdatesController@IdCardUpdate')->name('request-updates.id-card-update');
				Route::match(array('GET','POST'),'/medical-card-update', 'RequestUpdatesController@MedicalCardUpdate')->name('request-updates.medical-card-update');
				Route::match(array('GET','POST'),'/cea-application', 'RequestUpdatesController@CeaReimbursementUpdate')->name('request-updates.cea-application-update');
				Route::match(array('GET','POST'),'/hra-claim', 'RequestUpdatesController@HRAClaimRequest')->name('request-updates.hra-claim-request');
				Route::match(array('GET','POST'),'/ltcadvance-request', 'RequestUpdatesController@AdvClaimLTCRequest')->name('request-updates.adv-claim-ltc-request');
				Route::match(array('GET','POST'),'/datcrd-mobphn-chrg-clm-request', 'RequestUpdatesController@DataCardMobPhonChrgClaimRequest')->name('request-updates.datcrd-mobphn-chrg-clm-request');
				Route::match(array('GET','POST'),'/cpf-gpf-advan-request', 'RequestUpdatesController@CPFGPFAdvanceRequest')->name('request-updates.cpf-gpf-advan-request');
				Route::match(array('GET','POST'),'/witdraw-fr-cpf-gpf-request', 'RequestUpdatesController@WitDrawFrCPFGPFRequest')->name('request-updates.witdraw-fr-cpf-gpf-request');
				Route::match(array('GET','POST'),'/pf-addi-subcr-request', 'RequestUpdatesController@PFAddiSubscriRequest')->name('request-updates.pf-addi-subcr-request');
				Route::match(array('GET','POST'),'/home-town-request', 'RequestUpdatesController@HomeTownRequest')->name('request-updates.home-town-update');
			});

			Route::group(['prefix' => 'all-request-updates'], function() {
				Route::match(array('GET','POST'),'/addr-update', 'AllRequestUpdatesController@AddressUpdate')->name('all-request-update.addr-update');
				Route::match(array('GET','POST'),'/contact-no-update', 'AllRequestUpdatesController@ContactUpdate')->name('all-request-update.contact-no-update');
				Route::match(array('GET','POST'),'/bank-details-update', 'AllRequestUpdatesController@BankDetailsUpdate')->name('all-request-update.bank-details-update');
				Route::match(array('GET','POST'),'/family-members-update', 'AllRequestUpdatesController@FamilyMembersUpdate')->name('all-request-update.family-members-update');
				Route::match(array('GET','POST'),'/martial-status-update', 'AllRequestUpdatesController@MaritalStatusUpdate')->name('all-request-update.martial-status-update');
				Route::match(array('GET','POST'),'/nominee-update', 'AllRequestUpdatesController@NomineeUpdate')->name('all-request-update.nominee-update');
				Route::match(array('GET','POST'),'/physical-disability-update', 'AllRequestUpdatesController@PhysicalDisabilityUpdate')->name('all-request-update.physical-disability-update');
				Route::match(array('GET','POST'),'/id-card-update', 'AllRequestUpdatesController@IdCardUpdate')->name('all-request-update.id-card-update');
				Route::match(array('GET','POST'),'/medical-card-update', 'AllRequestUpdatesController@MedicalCardUpdate')->name('all-request-update.medical-card-update');
				Route::match(array('GET','POST'),'/cea-application', 'AllRequestUpdatesController@CeaReimbursementUpdate')->name('all-request-update.cea-application-update');
				Route::match(array('GET','POST'),'/hra-claim', 'AllRequestUpdatesController@HRAClaimRequest')->name('all-request-update..hra-claim-request');
				Route::match(array('GET','POST'),'/ltcadvance-request', 'AllRequestUpdatesController@AdvClaimLTCRequest')->name('all-request-update.adv-claim-ltc-request');
				Route::match(array('GET','POST'),'/datcrd-mobphn-chrg-clm-request', 'AllRequestUpdatesController@DataCardMobPhonChrgClaimRequest')->name('all-request-update.datcrd-mobphn-chrg-clm-request');
				Route::match(array('GET','POST'),'/cpf-gpf-advan-request', 'AllRequestUpdatesController@CPFGPFAdvanceRequest')->name('all-request-update.cpf-gpf-advan-request');
				Route::match(array('GET','POST'),'/witdraw-fr-cpf-gpf-request', 'AllRequestUpdatesController@WitDrawFrCPFGPFRequest')->name('all-request-update.witdraw-fr-cpf-gpf-request');
				Route::match(array('GET','POST'),'/pf-addi-subcr-request', 'AllRequestUpdatesController@PFAddiSubscriRequest')->name('all-request-update.pf-addi-subcr-request');
				Route::match(array('GET','POST'),'/tada-exp-claim-request', 'AllRequestUpdatesController@TADAExpClaimList')->name('all-request-update.ta-exp-claim-list');
				Route::match(array('GET','POST'),'/cea-application', 'AllRequestUpdatesController@CeaReimbursementUpdate')->name('all-request-update.cea-application-update');
				Route::match(array('GET','POST'),'/medical-card-request', 'AllRequestUpdatesController@MedicalCardRequest')->name('all-request-update.medical-card-request');

			});

			Route::group(['prefix' => 'Visitor-id-card'], function() {
				Route::match(array('GET','POST'),'/Visitor-id-card', 'VisitorsIdCardController@VisitordIdCard')->name('visting-id-card.visting-id-card');
			});
			
			Route::group(['prefix' => 'holiday-master'], function() {
				Route::match(array('GET','POST'),'/holiday-master', 'HolidayMasterController@HolidayMaster')->name('holiday-master.holiday-master');
			});
		});
		
    });
});