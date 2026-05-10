
	<script>
		var KillEvent = 0;
		$(document).ready(function(){
			//INDENT FUND AVALABE HIDE THE FORWARD BUTTON/////
			var BudgetVerfi   = $('#hidd_buget_apr').val();
			var ISFundAvable  = $('#hidd_fund_avable').val();
			$('.WorkFlowAction').each(function () {
				var BtnValue = $(this).val();
				var DataFlag = $(this).data('flag');
				if (BudgetVerfi == 'Y' && ISFundAvable =='NO' && BtnValue == 'FORWARD' && DataFlag == 'FW'){
					$(this).hide();
				}
			});
			// THIS IS FOR INDENT CONSUAMBLES ITEM RATE CHANGE BY Purchase & Stores administrator ///
			$('body').on('change','.contrate',function(){
				var Index         = $(this).data('index');
				var ItemRate      = Number($('#txt_item_rate' + Index).val()) || 0;
				var ItemQty       = Number($('#txt_item_quantity_req_name_' + Index).val()) || 0;
				var ItemContPrice = Number($('#txt_cont_item_rate_'+ Index).val()) || 0;
				var Amount        = 0;
				ItemContPrice     = (ItemContPrice != 0) ? ItemContPrice : ItemRate;
				var Amount        = ItemQty * ItemContPrice;
				$("#txt_item_amount_" + Index).val(Amount);
				$("#txt_display_item_amount_" + Index).text(Amount);
				$("#txt_display_total_amount_" + Index).text(Amount);
				$("#txt_total_amount_" + Index).val(Amount);
				$('#tax_display_type_text_' + Index).text('Inclusive');
				$('#tax_type_text_' + Index).val('INC');
				calculateGrandTotal();
			});
			function calculateGrandTotal() {
				var grandTotal = 0;
				$('.row-amount').each(function() {
					var value = Number($(this).text()) || 0;
					grandTotal += value;
				});
				$('#grand_total_display').text(grandTotal.toFixed(2));
				$('#hidd_total_amt').val(grandTotal.toFixed(2));
			}
			// STILL HERE ////////
			$("body").on("click",".SearchItemMenu", function(event){
				var MatTypeId = $('#hidd_mat_typ_id').val();
				if(MatTypeId != '' || MatTypeId != null || MatTypeId != undefined) {
					$.ajax({
						type: 'POST',
						url: "{{ route('indent.GetIndentConsumableData') }}",
						data: { "_token": "{{ csrf_token() }}", 'MatTypeId': MatTypeId },
						success: function (data) { 
							if (data != null) {
								var ConsumablesDetailsArr = data['ConsumablesData'];
								var Sno = 1;
								if(data != null) {
									var ConsumablesDetailsDataStr = '';
									ConsumablesDetailsDataStr += '<table class="formtable" id="dataTable" width="100%">';
									ConsumablesDetailsDataStr += '<tr><th colspan="5"> Rate Contrate item and their Rate (RCI) Upto date </th></tr>';
									ConsumablesDetailsDataStr += '<tr><th class="lboxlabel">S.No.</th><th class="lboxlabel">Item Name</th><th class="lboxlabel">Item Rate (Rs.)</th><th class="lboxlabel">Item GST (%)</th><th class="lboxlabel">Total Amout</th></tr>';
									ConsumablesDetailsArr.forEach(function(item) {
       									var TotalAmout = item.rate_per_unit + (item.rate_per_unit * item.gst / 100);
										ConsumablesDetailsDataStr += '<tr><td class="lboxlabel" style="text-align: center;">'+Sno+'</td><td class="lboxlabel" style="text-align: center;">'+item.rc_item_name+'</td><td class="lboxlabel" style="text-align: center;">'+item.rate_per_unit+'</td><td class="lboxlabel" style="text-align: center;">'+item.gst+'</td><td class="lboxlabel" style="text-align: center;">'+TotalAmout+'</td></tr>';
										Sno++;
									});
									ConsumablesDetailsDataStr += '</table>';
								}
								BootstrapDialog.show({
									title: 'Rate Contrate Item Information',
									message: ConsumablesDetailsDataStr,
									buttons: [{
										label: 'OK',
										action: function(dialog) {
											dialog.close();
										}
									}]
								});
							}
						}
					});
				}
			});
			$("body").on("click",".WorkFlowAction", function(event){ 
				if(KillEvent == 0){
					var ActionRem   = $('#txt_action_remarks').val();
					let ActionFlag = $(this).attr("data-flag");
					if((ActionFlag == 'RJ')){
						if(ActionRem == ''){
							BootstrapDialog.alert("Remarks should not be empty");
							event.preventDefault();
							return false;
							exit();
						}
					}
					/////// THIS IS FOR INDENT BUDGET CERTIFICATION PART ///////
					var BudgetVerfi = $('#hidd_buget_apr').val();
					var FunCertifi  = $('input[name="rad_Basis"]:checked').val();
					if(BudgetVerfi =='Y'){
						if (!FunCertifi) {
							BootstrapDialog.alert("Please confirm whether DCA certification is available (Yes or No).");
							event.preventDefault();
							return false;
						}
					}
					/////////////////////////////////////////////////////////////
					$("#txt_wf_action").val('');
					if((ActionFlag == 'AP')){
						$("#txt_wf_action").val(ActionFlag);
					}
					if((ActionFlag == 'RJ')){
						$("#txt_wf_action").val(ActionFlag);
					}
					var Role = "X";//$(this).attr('data-role');
					let TriggerBtn = $(this).attr("id"); 
					var EmpNo = "";
					$("#txt_wf_mode").val('');
					$('#txt_wf_remark').val('');
					var RemarkLabel   = 'higher';
					var IsEditPayment = $('#hidd_ispayemt_edit').val();
            		var RemarksErr    = 0;
					var HasError      = false;
					$('.accremarks').css('background-color', '#FAFDFE');
		    		$('.accremarks').css('color', '#001BC6');
					if(IsEditPayment =='Y'){
						$('input[name="txt_item_pay_perc[]"]').each(function (index) {
							var sno = index + 1;
							var payPerc = parseFloat($('#txt_item_pay_perc_' + sno).val()) || 0;
							var accPerc = parseFloat($('#txt_acc_item_pay_perc_' + sno).val()) || 0;
							let RemarksField = $('#txt_acc_remarks_' + sno);
							var AccRemarks = $('#txt_acc_remarks_' + sno).val().trim();
							 if (payPerc !== accPerc) {
								if (AccRemarks === '') {
									RemarksField.css({
										'background-color': 'red',
										'color': '#FFFFFF'
									});
									HasError = true;
								}
							}
						});
						if (HasError) {
							BootstrapDialog.alert("Enter remarks wherever Payment % and DCA Certified % are not equal.");
							event.preventDefault();
							return false;
						}
					}
					if((ActionFlag == "SU")||(ActionFlag == "FW")||(ActionFlag == "BK")){
						if(ActionFlag == "SU"){
							RemarkLabel = 'higher';
						}else if(ActionFlag == "FW"){
							RemarkLabel = 'higher';
						}else if(ActionFlag == "BK"){
							RemarkLabel = 'lower';
						}else{
							RemarkLabel = '';
						}
						/*if(ActionFlag == "SU"){
							EmpNo = $("#txt_fw_emp_no").val();
							if($("#FwUser").length){
								var UserData = $("#FwUser").attr("data-user");
							}else{
								var UserData = [];
							}
							RemarkLabel = 'higher';
						}else if(ActionFlag == "FW"){
							EmpNo = $("#txt_fw_emp_no").val(); 
							if($("#FwUser").length){
								var UserData = $("#FwUser").attr("data-user");
							}else{
								var UserData = [];
							}
							RemarkLabel = 'higher';
						}else if(ActionFlag == "BK"){
							EmpNo = $("#txt_bw_emp_no").val();
							if($("#BwUser").length){
								var UserData = $("#BwUser").attr("data-user");
							}else{
								var UserData = [];
							}
							RemarkLabel = 'lower';
						}else{
							var UserData = [];
						}  
						let Users;
						if(UserData != ''){ 
							Users = $.parseJSON(UserData); 
						}else{ 
							Users = {}; 
						}
						*/

						let EmpStr = '<div class="lboxlabel">Select Employee <span id="RoleLabel"></span></div>';
						EmpStr += '<div class="row smclearrow"></div>';
						EmpStr += '<select class="tboxsmclass" name="modal_emp" id="modal_emp">';
						EmpStr += '<option value=""> --- Select --- </option>';
						/*Object.entries(Users).forEach(([key1, value1]) => {
							EmpStr += '<option value="'+value1.emp_no+'">'+value1.emp_known_as+'</option>';
						});*/
						EmpStr += '</select>';
						let SkipEmpStr = '<div class="row smclearrow"><input type="hidden" name="modal_action_flag" id="modal_action_flag" value="'+ActionFlag+'"></div>';
						// SkipEmpStr += '<div class="row">&nbsp;</div>';
						// SkipEmpStr += '<div class="row lboxlabel rgtext"><input type="checkbox" class="SkipEmployee" name="modal_skip_employee" id="modal_skip_employee" value=""> &nbsp;Click here to skip the above role if the person mentioned is on leave or unavailable</div>';
						// SkipEmpStr += '<div class="row smclearrow"></div>';
						// SkipEmpStr += '<div class="row hide SkipEmpRow">';
						// SkipEmpStr += '<div class="lboxlabel">Select Employee <span id="RoleLabelSkip"></span></div>';
						// SkipEmpStr += '<div class="row smclearrow"></div>';
						// SkipEmpStr += '<select class="tboxsmclass" name="modal_skip_emp" id="modal_skip_emp">';
						// SkipEmpStr += '<option value=""> --- Select --- </option>';
						// SkipEmpStr += '</select>';
						// SkipEmpStr += '</div>';
						// SkipEmpStr += '<div class="row smclearrow hide SkipEmpRow"></div>';
						// SkipEmpStr += '<div class="row hide SkipEmpRow">';
						// SkipEmpStr += '<div class="row smclearrow"></div>';
						// SkipEmpStr += '<div class="lboxlabel">Remarks for skipping to the next '+RemarkLabel+' level</div>';
						// SkipEmpStr += '<div class="row"><textarea class="tboxsmclass" rows="5" name="modal_skip_remarks" id="modal_skip_remarks" maxlength="1000"></textarea></div>';
						// SkipEmpStr += '</div>';

						let OthOrgEmpStr = '';
						// let OthOrgEmpStr = '<div class="row smclearrow"></div>';
						// OthOrgEmpStr += '<div class="row smclearrow"></div>';
						// OthOrgEmpStr += '<div class="row lboxlabel rgtext"><input type="checkbox" class="OthOrgEmployee" name="modal_oth_org_employee" id="modal_oth_org_employee" value=""> &nbsp;Click here to select an employee from another organization if the employee from the same organization is on leave or unavailable (applicable for the same role)</div>';
						// OthOrgEmpStr += '<div class="row smclearrow"></div>';
						// OthOrgEmpStr += '<div class="row hide OthOrgEmpRow">';
						// OthOrgEmpStr += '<div class="lboxlabel">Select Employee (Approving Authority)</div>';
						// OthOrgEmpStr += '<select class="tboxsmclass" name="modal_oth_org_emp" id="modal_oth_org_emp" style="font-weight:500">';
						// OthOrgEmpStr += '<option value=""> --- Select --- </option>';
						// OthOrgEmpStr += '</select>';
						// OthOrgEmpStr += '</div>';
						// OthOrgEmpStr += '<div class="row smclearrow hide OthOrgEmpRow"></div>';
						// OthOrgEmpStr += '<div class="row hide OthOrgEmpRow">';
						// OthOrgEmpStr += '<div class="row smclearrow"></div>';
						// OthOrgEmpStr += '<div class="lboxlabel">Remarks for choosing other organization employee</div>';
						// OthOrgEmpStr += '<div class="row"><textarea class="tboxsmclass" rows="5" name="modal_oth_org_emp_remarks" id="modal_oth_org_emp_remarks" maxlength="1000"></textarea></div>';
						// OthOrgEmpStr += '</div>';
						// OthOrgEmpStr += '<div class="row"></div>';
						
						// OthOrgEmpStr += '<div class="row"></div>';
						event.preventDefault();
						BootstrapDialog.show({
							title: 'Work Flow Information',
							message: EmpStr+SkipEmpStr+OthOrgEmpStr,
							buttons: [{
								label: 'OK Proceed',
								action: function(dialog) {
									var Err = 0;
									var WorkFlowMode = $("#txt_wf_mode").val();
									if($("#modal_emp").val() == ''){
										BootstrapDialog.alert('Please select employee..!!');
										Err++;
									}else{
										if(WorkFlowMode == "SKIP"){
											var SkipEmp = $("#modal_skip_emp").val();
											var SkipRemarks = $("#modal_skip_remarks").val();
											if(SkipEmp == ""){
												BootstrapDialog.alert("Skip to Employee name should not be empty");
												Err++;
											}else if(SkipRemarks == ""){
												BootstrapDialog.alert("Skip to Employee remarks should not be empty");
												Err++;
											}
										}else if(WorkFlowMode == "OTHORG"){
											var OthOrgEmp = $("#modal_oth_org_emp").val();
											var OthOrgRemark = $("#modal_oth_emp_remarks").val();
											if(OthOrgEmp == ""){
												BootstrapDialog.alert("Other Organization Employee name should not be empty");
												Err++;
											}else if(OthOrgRemark == ""){
												BootstrapDialog.alert("Other Organization Employee remarks should not be empty");
												Err++;
											}
										}
									}
									if(Err == 0){
										if(WorkFlowMode == "SKIP"){
											var EmployeeNo 	= $("#modal_skip_emp").val();
											var WflowRemarks = $("#modal_skip_remarks").val();
										}else if(WorkFlowMode == "OTHORG"){
											var EmployeeNo 	= $("#modal_oth_org_emp").val();
											var ActualEmpNo = $("#modal_emp").val();
											var WflowRemarks = $("#modal_oth_org_emp_remarks").val();
											$("#txt_actual_emp").val(ActualEmpNo);
										}else{
											var EmployeeNo = $("#modal_emp").val();
											$("#txt_actual_emp").val('');
											var WflowRemarks = '';
										}
										//$('#txt_wf_remark').val(WflowRemarks);
										var WflowRemarks = ActionRem;
										$('#txt_wf_remark').val(WflowRemarks);
										if((ActionFlag == "SU")||(ActionFlag == "FW")){
											$("#txt_wf_emp_no").val(EmployeeNo);
										}
										if(ActionFlag == "BK"){
											$("#txt_wf_emp_no").val(EmployeeNo);
										}
										if(ActionFlag == "SU"){
											var ConfirmMessage = "Are you sure to submit ?";
										}else if(ActionFlag == "FW"){
											var ConfirmMessage = "Are you sure want to forward ?";
										}else if(ActionFlag == "BK"){
											var ConfirmMessage = "Are you sure want to return back ?";
										}else{
											var ConfirmMessage = "";
										}
										if(ConfirmMessage != ""){
											event.preventDefault();
											BootstrapDialog.confirm({
												title: 'Confirmation Message',
												message: ConfirmMessage,
												closable: false, // <-- Default value is false
												draggable: false, // <-- Default value is false
												btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
												btnOKLabel: 'Ok', // <-- Default value is 'OK',
												callback: function(result) {
													if(result){														
														if((TriggerBtn != '')&&(TriggerBtn !== 'undefined')){
															KillEvent = 1; 
															$("#"+TriggerBtn).trigger( "click" );
														}
													}else {
														KillEvent = 0;
													}
												}
											});
											dialog.close();
										}
									}
								}
							},{
								label: 'Cancel',
								action: function(dialog) {
									dialog.close();
								}
							}],
							onshown: function(dialogRef){ 
								$(this).GetWorkFlowEmployeeData(event,Role,ActionFlag);
							}
						});
					}	
				}
			});
			$("body").on("click",".SkipEmployee", function(event,Role,ActionFlag){
				if($(this).is(':checked')){
					$(".SkipEmpRow").removeClass("hide");
					$(".OthOrgEmployee").prop('checked',false);
					$(".OthOrgEmpRow").addClass("hide");
					$("#modal_oth_org_employee").val('');
					$("#modal_oth_emp_remarks").val('');
					$("#txt_actual_emp").val('');
					$(this).GetSkipEmployeeData(event);
					$("#txt_wf_mode").val('SKIP');
				}else{
					$(".SkipEmpRow").addClass("hide");
					$("#modal_skip_employee").val('');
					$("#modal_skip_remarks").val('');
					$("#txt_wf_mode").val('');
					$("#txt_actual_emp").val('');
				}
			});
			$("body").on("click",".OthOrgEmployee", function(event,Role,ActionFlag){
				if($(this).is(':checked')){
					$(".OthOrgEmpRow").removeClass("hide");
					$(".SkipEmployee").prop('checked',false);
					$(".SkipEmpRow").addClass("hide");
					$("#modal_skip_employee").val('');
					$("#modal_skip_remarks").val('');
					$(this).GetOthEmployeeData(event);
					$("#txt_wf_mode").val('OTHORG');
					$("#txt_actual_emp").val('');
				}else{
					$(".OthOrgEmpRow").addClass("hide");
					$("#modal_oth_org_employee").val('');
					$("#modal_oth_emp_remarks").val('');
					$("#txt_wf_mode").val('');
					$("#txt_actual_emp").val('');
				}
			});
			$.fn.GetWorkFlowEmployeeData = function(event,Role,ActionFlag) {
				let TransactionId 	 = $("#txt_application_id").val();
				let WflowModule 	 = $("#wf_module_code").val();
				let ModalActionFlag  = $("#modal_action_flag").val();
				var WorkFlowDataJson = {
					TransactionId: TransactionId,
					WflowModule: WflowModule,
					ModalActionFlag: ModalActionFlag,
					ProcessLevel: 'BEFORE_SUBMIT'
				};
				var WorkFlowData = JSON.stringify(WorkFlowDataJson);
				$("#RoleLabel").html('');
				$("#modal_emp").chosen("destroy");
				$("#modal_emp").find('option:not(:first)').remove();
				$.ajax({ 
					type: 'POST',
					url: "{{ route('workflow.get-workflow-employees') }}",
					data : { "_token": "{{ csrf_token() }}",Page: 'WORKFLOW', WorkFlowData: WorkFlowData },
					dataType: 'json',
					success: function (data) {
						if(data != null){	
							var EmpData = data['EmpData'];
							var SelEmp = data['SelEmp'];
							var RoleName = data['RoleName'];
							var NextRole = data['NextRole'];
							var RolePosition = data['RolePosition'];
							if((RoleName != null)&&(RoleName != '')){
								$("#RoleLabel").html('<span class="rbadge1 rbadgeA">Role : '+RoleName+'</span>');
							}
							var EmpLength = EmpData.length;
							$.each(EmpData, function(index, element) {
								if((SelEmp == element.emp_no)||(EmpLength == 1)){
									var SelectStr = 'selected="selected"';
								}else{
									var SelectStr = '';
								}
								$("#modal_emp").append('<option value="'+element.emp_no+'" '+SelectStr+'><span class="testing">'+element.emp_name_payslip+' (' + RoleName + ')</option>');
							});
							$("#modal_emp").chosen();
							$('.chosen-container').css('font-weight',500);
							$("#txt_wf_role").val(NextRole);
							$("#txt_wf_action").val(ModalActionFlag);
							$("#txt_role_position").val(RolePosition);
						}
					}
				});
			}
			$.fn.GetSkipEmployeeData = function(event) {
				let GlobId 		= $("#txt_globid").val();
				let WflowModule = $("#wf_module_code").val();
				let MastId 		= $("#txt_mastid").val();
				let ActionFlag  = $("#modal_action_flag").val();
				var OtherDataJson = {
					MastId: MastId
				};
				var OtherData = JSON.stringify(OtherDataJson);
				$("#modal_skip_emp").chosen("destroy");
				$("#modal_skip_emp").find('option:not(:first)').remove();
				$("#RoleLabelSkip").html('');
				$.ajax({ 
					type: 'POST',
					url: "{{ route('ajax.GetWorkFlowEmployees') }}",
					data : { "_token": "{{ csrf_token() }}", GlobId: GlobId, WflowModule: WflowModule, ActionFlag: ActionFlag, Page: 'SKIP', OtherData: OtherData },
					dataType: 'json',
					success: function (data) {
						if(data != null){	
							var EmpData = data['EmpData'];
							var RoleName = data['RoleName'];
							if((RoleName != null)&&(RoleName != '')){
								$("#RoleLabelSkip").html('<span class="rbadge1 rbadgeA">Role : '+RoleName+'</span>');
							}
							$.each(EmpData, function(index, element) {
								$("#modal_skip_emp").append('<option value="'+element.emp_no+'"><span class="testing">'+element.emp_known_as+'</option>');
							});
							$("#modal_skip_emp").chosen();
							$('.chosen-container').css('font-weight',500);
						}
					}
				});
			}
			$.fn.GetOthEmployeeData = function(event) {
				let GlobId 		= $("#txt_globid").val();
				let WflowModule = $("#wf_module_code").val();
				let MastId 		= $("#txt_mastid").val();
				let ActionFlag  = $("#modal_action_flag").val();
				var OtherDataJson = {
					MastId: MastId
				};
				var OtherData = JSON.stringify(OtherDataJson);
				$("#modal_oth_org_emp").chosen("destroy");
				$("#modal_oth_org_emp").find('option:not(:first)').remove();
				$.ajax({ 
					type: 'POST',
					url: "{{ route('ajax.GetWorkFlowEmployees') }}",
					data : { "_token": "{{ csrf_token() }}", GlobId: GlobId, WflowModule: WflowModule, ActionFlag: ActionFlag, Page: 'OTHORG', OtherData: OtherData },
					dataType: 'json',
					success: function (data) {
						if(data != null){	
							var EmpData = data['EmpData'];
							var ErrMsg  = data['ErrMsg']; 
							if((ErrMsg != null)&&(ErrMsg != '')){ 
								BootstrapDialog.alert(ErrMsg);
								$(".OthOrgEmployee").prop('checked',false);
								$(".OthOrgEmpRow").addClass("hide");
								$("#modal_oth_org_employee").val('');
								$("#modal_oth_emp_remarks").val('');
								$("#txt_wf_mode").val('');
								$("#txt_actual_emp").val('');
							}else{
								$.each(EmpData, function(index, element) {
									var OrgGroup 		= element.group;
									var OrgDivision 	= element.division_short_name;
									var OrgSection 		= element.section_short_name;
									var OrgSubSection 	= element.sub_section_short_name;
									var OrgArr = [];
									if((OrgGroup != '')&&(OrgGroup != 'null')&&(OrgGroup != null)){
										OrgArr.push("Group :  "+OrgGroup);
									}
									if((OrgDivision != '')&&(OrgDivision != 'null')&&(OrgDivision != null)){
										OrgArr.push("Division :  "+OrgDivision);
									}
									if((OrgSection != '')&&(OrgSection != 'null')&&(OrgSection != null)){
										OrgArr.push("Section :  "+OrgSection);
									}
									if((OrgSubSection != '')&&(OrgSubSection != 'null')&&(OrgSubSection != null)){
										OrgArr.push("Sub Section :  "+OrgSubSection);
									}
									var OrgString = OrgArr.join('; ');

									if((element.emp_known_as == '')||(element.emp_known_as == null)||(element.emp_known_as == 'null')){
										var NameArr = [];
										var EmpFName 	= element.emp_firstname;
										var EmpMName 	= element.emp_middlename;
										var EmpLName 	= element.emp_lastname;

										if((EmpFName != '')&&(EmpFName != 'null')&&(EmpFName != null)){
											NameArr.push(EmpFName);
										}
										if((EmpMName != '')&&(EmpMName != 'null')&&(EmpMName != null)){
											NameArr.push(EmpMName);
										}
										if((EmpLName != '')&&(EmpLName != 'null')&&(EmpLName != null)){
											NameArr.push(EmpLName);
										}
										var EmpName = NameArr.join(' ');
									}else{
										var EmpName = element.emp_known_as;
									}
									var ExistInWorkFLowEmp = $('#modal_emp option[value="' + element.employee_no + '"]').length > 0;
									if(!ExistInWorkFLowEmp){
										$("#modal_oth_org_emp").append('<option value="'+element.employee_no+'"><span class="testing">'+element.employee_no+' - '+EmpName+' - '+OrgString+'</option>');
									}
								});
							}
							$("#modal_oth_org_emp").chosen();
							$('.chosen-container').css('font-weight',500);
						}
					}
				});
			}

			

		});
	</script>
