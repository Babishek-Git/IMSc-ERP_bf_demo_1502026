@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php

 if(isset($data['Empdata'])){
	$Empdata  = $data['Empdata'];
	$ICNo     = collect($Empdata)->pluck('emp_no')->first();
	$EmpName  = collect($Empdata)->pluck('emp_first_name')->first();
	$EmpDOB   = collect($Empdata)->pluck('emp_dob')->first();
	$EmpDOJ   = collect($Empdata)->pluck('emp_doj')->first();
	$EmpRET   = collect($Empdata)->pluck('emp_retirement_dt')->first();
	$Desig    = collect($Empdata)->pluck('designation_name')->first();
	$GroupId   = collect($Empdata)->pluck('group')->first();
	$DivId   = collect($Empdata)->pluck('division_short_name')->first();
	$SecId   = collect($Empdata)->pluck('section')->first();
}

if(((session('WcmsRoleGroupCode') == "ADMUSER")||(session('WcmsRoleGroupCode') == "SUPUSER"))){
	$IsAdmin = 1;
}else{
	$IsAdmin = 0;
}

$EmpGroupedData = $data['EmpGroupedData'] ?? [];
@endphp
<style>
    
	
</style>

<form action="" method="post" enctype="multipart/form-data" name="form">
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1" style="overflow:auto">
					<div class="container">
						<div class="row plr">
              				<!-- <div class="div1"></div> -->
							<div class="div12 mbtable">
								<!-- <div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Employee Address Update -  Approval Form</div></div></div>
								<div class="row innerdiv">
									<div class="row">  -->
										 <!-- Form Steps --> 
										<div class="form-step active">
											<div class="div12">
												<div class="table-box">
													<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Employee Marital Status Update -  Waiting for Approval List</div></div></div>
													<div class="card-body padding-1 ChartCard" id="CourseChart">
														<div class="divrowbox innerdiv pt-2">
																					
															<div class="row smclearrow"></div>                                                                                											
															<table class="table-bordered table1" width="99%" align="center" id="dataTable">
																<thead>
																	<tr>
																		<th  rowspan="2" style="text-align:center">SNo.</th>
																		<th  rowspan="2" style="text-align:center">IC No.</th>
																		<th  rowspan="2" style="text-align:center">Name</th>
																		<th  rowspan="2" style="text-align:center">Section</th>
																		<th  colspan="2" style="text-align:center">Spouse Details</th>
																		<th  rowspan="2" style="text-align:center">Supporting Document</th>
																	</tr>
																	<tr>
																		<th style="text-align:center">Spouse DoB</th>
																		<th style="text-align:center">Spouse Name</th>
																	</tr>
																</thead>
																<tbody>
																@if(isset($data['MaritalData']))
																	@foreach($data['MaritalData'] as $MaritalData)
																		@php
																			$GroupDivSecArr = []; $GroupDivSecStr = ''; $OfficeName = '';
																			if(isset($EmpGroupedData[$MaritalData->emp_no])){
																				$EmpData 	= $EmpGroupedData[$MaritalData->emp_no];
																				if($EmpData->group != NULL){
																					$GroupDivSecArr[] = $EmpData->group;
																					$OfficeName = $EmpData->group;
																				}
																				if($EmpData->division != NULL){
																					$GroupDivSecArr[] = $EmpData->division;
																					$OfficeName = $EmpData->division;
																				}
																				if($EmpData->section != NULL){
																					$GroupDivSecArr[] = $EmpData->section;
																					$OfficeName = $EmpData->section;
																				} 
																				$GroupDivSecStr = implode(" / ",$GroupDivSecArr);
																			}
																			$SpouseDoB = optional(json_decode($MaritalData->new_value))->spouse_dob ?? '';
																			$SpouseName = optional(json_decode($MaritalData->new_value))->spouse_name ?? '';
																		@endphp
																		<tr>
																			<td align="center">{{ $loop->iteration }} </td>
																			<td align="left">{{ $MaritalData->emp_no }}</td>
																			<td align="left">{{ $MaritalData->emp_name_payslip }}</td>
																			<td align="left">{{ $OfficeName }}</td>
																			<td align="left">{{ $SpouseDoB }} </td>
																			<td align="left">{{ $SpouseName }} </td>
																			<td align="left"></td>
																		</tr>
																	@endforeach
																@endif
																</tbody>
															</table>
															
														</div>
													</div>	
												</div>									
											</div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
										</div>
									<div class="row" align="center">
										<button type="submit" id="SaveDraft" name="SaveDraft" class="step-btn" value="Save">SAVE</button> 
										<div class="row smclearrow"></div>
										<div class="row smclearrow"></div>
										<div class="row smclearrow"></div>
									<!-- </div>
								</div> -->
							</div>
						</div>
					</div>
					<div class="row">
						<div class="div12" align="center">
							<input type="hidden" name="txt_tab" id="txt_tab" value="1" />
							<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
						</div>
					</div>
               				                      
				</blockquote>
			</div>
		</div>
	</div>
</form>
<script>
$(".ChosenInput").chosen();
/* $("body").on("change", "#txt_emp_icno", function (event) {
	
    var EmpNo = $(this).val();
	
    if ((EmpNo!='') && (EmpNo!=null)) {

        $.ajax({
            type: 'POST',
            url: "{{ route('employee.GetEmployeeData') }}",
            data: { "_token": "{{ csrf_token() }}", 'EmpNo': EmpNo },
            // dataType: 'json',
            success: function (data) {
                if (data != '') {
                    let EmpData = data['EmpData']; console.log(EmpData);
                    if ((EmpData != '') && (EmpData != null)) {
                        //$("#section_name").empty();
                        $.each(EmpData, function (index, element) {
						   var Dob = GlobalFormatDateDDMMYYYY(element.emp_dob);
						   var Doj = GlobalFormatDateDDMMYYYY(element.emp_doj);
						   var Dor = GlobalFormatDateDDMMYYYY(element.emp_retirement_dt);
						   $("#txt_icno").val(element.emp_no);
                           $("#txt_payslip_name").val(element.emp_name_payslip);
                           $("#txt_designation").val(element.designation_name);
                           $("#txt_dob").val(Dob);         
                           $("#txt_doj").val(Doj);
                           $("#txt_date_retire").val(Dor);
                           $("#txt_group").val(element.group);
                           $("#txt_div").val(element.division_short_name);
                           $("#txt_sec").val(element.section);
                           $("#txt_cont_oldaddress").val(element.emp_address);
                        });
                $    }else{
						BootstrapDialog.alert("Please Enter the Correct Employee Number");
						$("#txt_emp_no").val(''); 
					}
                }
            }
        });
    }
	
}); */
$('#dataTable').DataTable({
		responsive: true,
		paging: true, 
	});
</script>
@endsection
