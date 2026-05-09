@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php
if(isset($data['EmpData'])){
		foreach($data['EmpData'] as $emp){
			$EmpNo = $emp->emp_no;
		}
	}
@endphp

<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="" method="post" enctype="multipart/form-data" name="form">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row plr">
								
								<div class="div12 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Leave Balance Update</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
											<div class="row">     
														<div class="div12">                                                                        											
															<table class="formtable" align="center" id="dataTable" width="100%">
																<thead>
																	<tr>
																		<th class="colhead" nowrap="nowrap">SNo</th>
																		<th class="colhead">Employee Name</th>
																		@if(isset($data['LeaveTypeData']))
																		@foreach($data['LeaveTypeData'] as $Row)
																			<th class="colhead">{{$Row->leave_type_code}}</th>
																		@endforeach
																		@endif
																	</tr>
																</thead>
																<tbody>
																<!-- <tr> -->
																@if(isset($data['EmpNameData']))
																	@foreach($data['EmpNameData'] as $EmpNameData)
																	<tr>
																		<td align="center">{{$loop->iteration}}</td>
																		<td>
																			<input type="hidden" name="txt_emp_no[]" id="txt_emp_no[]" class="tboxclass" value="{{$EmpNameData->emp_no}}">
																			{{$EmpNameData->emp_name_payslip}}
																		</td>
																		@if(isset($data['LeaveTypeData']))
																		@foreach($data['LeaveTypeData'] as $LeaveBalanceData)
																		<td>
																			<input type="hidden" name="hid_leave_type_{{$EmpNameData->emp_no}}[]" id="hid_{{$LeaveBalanceData->leave_type_code}}" class="tboxclass" value="{{$LeaveBalanceData->leave_type_id}}">
																			<input type="text" name="txt_leave_balance_{{$EmpNameData->emp_no}}[]" id="txt_{{$LeaveBalanceData->leave_type_code}}" class="tboxclass" value="">
																		</td>
																		@endforeach
																		@endif
																	</tr> 
																	@endforeach
																@endif
																<!-- </tr> -->
																</tbody>
															</table>
														</div>
													</div>
													<!-- <fieldset class="fieldbox">
														<legend class="fieldbox-legend">Enter Leave Balance Data</legend>
														<div class="fieldbox-div">
															<div>
																@if(isset($data['EmpData']))
															@foreach($data['EmpData'] as $EmpData)
																<option value="{{$EmpData->emp_no}}">{{$EmpData->emp_first_name}}--{{$EmpData->emp_no}}--{{$EmpData->designation_name}}</option>
															@endforeach
															@endif	
															</div>
															<div id="AdminSection">
															</div>
															<div class="row smclearrow"></div>
															<div class="row smclearrow"></div>
															<div class="row smclearrow"></div>
														</div>
													</fieldset> -->
											
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
										</div>
									<div class="row" align="center">
										<button type="submit" id="btn_save" name="btn_save" class="step-btn" value="Save">SAVE</button> 
										<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
													
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
									</div>
									</div>
									</div>										
								</div>
								<div class="div4">&nbsp;</div>
							</div>                           
						</div>
						
					</blockquote>
				</div>
			</div>
		</div>
	</form>
	
</body>	
<script type="text/javascript" language="javascript">
var IsSecAdminChkBoxThr="";
var KillEvent = 0;
$("body").on("click","#btn_save", function(event){
	if(KillEvent == 0){
		var EMPNo   	= $("#txt_emp_no").val();
		if(EMPNo == ''){
			BootstrapDialog.alert("Please Enter the Employee No..!!");
			event.preventDefault();
			event.returnValue = false;
		}else{
			event.preventDefault();
			BootstrapDialog.confirm({
				title: 'Confirmation Message',
				message: 'Are you sure want to save the User ?',
				closable: false,
				draggable: false, 
				btnCancelLabel: 'Cancel', 
				btnOKLabel: 'Ok', 
				callback: function(result) {
					if(result){
						KillEvent = 1;
						$("#btn_save").trigger( "click" );
					}else {
						KillEvent = 0;
					}
				}
			});
		}
	}
});

$("body").on("change", "#cmb_emp_name", function (event) {
	if (IsSecAdminChkBoxThr= "YES"){
		$("#AdminSection").empty(); 
	}
	if (RoleAlreadyAdded= "YES"){
		$("#AdminSection").empty(); 
		$("#cmb_role_name").empty(); 
	}
	var EmpNo = $(this).val();
    if ((EmpNo != '') && (EmpNo != null)) {
        $.ajax({
            type: 'POST',
            url: "{{ route('employee.GetEmployeeData') }}",//this 'employee.GetEmployeeData' is 'obj created in the controller.funName'
            data: { "_token": "{{ csrf_token() }}", 'EmpNo': EmpNo },
            // dataType: 'json',
            success: function (data) {
                if (data != '') {
                    let EmpData = data['EmpData']; 
					let SectionRoleData = data['SectionRoleData'];
                    if ((EmpData != '') && (EmpData != null)) {
                        //$("#section_name").empty();
                        $.each(EmpData, function (index, element) { 
							// console.log("Index: " + index + " | Value: " + element);
                           $("#txt_emp_icno").val(element.emp_no);
						   $("#txt_emp_name").val(element.emp_name_payslip);
                           $("#txt_designation").val(element.designation_name);
                           $("#txt_dob").val(element.emp_dob);         
                           $("#txt_doj").val(element.emp_doj);
                           $("#txt_date_retire").val(element.emp_retirement_dt);
                           $("#txt_group").val(element.group);
                           $("#txt_div").val(element.division_short_name);
                           $("#txt_sec").val(element.section);
						    if(element.section_id && element.section) {
								$("#AdminSection").append( '<label><input type="checkbox" name="is_section_admin" value="' + element.section_id + '"> Is He/She ' + element.section + ' Administrator</label><br>' );
								IsSecAdminChkBoxThr= "YES";
						    }
                        });
                    }
					if(SectionRoleData != null){
						$.each(SectionRoleData, function (index, element) { 
							$("#cmb_role_name").append('<option value="'+element.roleid+'">'+element.role_name+'</option>');
							RoleAlreadyAdded= "YES";
						});
					}
                }
            }
        });
    }
});


</script>
@endsection
