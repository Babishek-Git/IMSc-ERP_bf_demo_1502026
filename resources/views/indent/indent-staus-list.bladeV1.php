@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php



if(((session('WcmsRoleGroupCode') == "ADMUSER")||(session('WcmsRoleGroupCode') == "SUPUSER"))){
	$IsAdmin = 1;
}else{
	$IsAdmin = 0;
}

$EmpGroupedData = $data['EmpGroupedData'] ?? [];
$EmpDataArr = [];
if(isset($data['Empdata'])){
	$EmpData = $data['Empdata'];
	foreach($EmpData as $Empvalue){
		$EmpDataArr[$Empvalue->emp_no] = $Empvalue->emp_first_name;
	}
}

@endphp

<style>
    
	
</style>

<form action="" method="post" enctype="multipart/form-data" name="form">
	<div class="content">
		<div class="title"></div>
		<div class="container_12">			<div class="grid_12">
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
													<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Indent Status List</div></div></div>
													<div class="card-body padding-1 ChartCard" id="CourseChart">
														<div class="divrowbox innerdiv pt-2">
																					
															<div class="row smclearrow"></div>                                                                                											
															<table class="table-bordered table1" width="99%" align="center" id="dataTable">
																<thead>
																	<tr class="note heading">
																		<th  style="text-align:center">SNo.</th>
																		<th  style="text-align:center">Indent No</th>
																		<th  style="text-align:center">Indent Description</th>
																		<th  style="text-align:center">Indent Created By</th>
																		<th  style="text-align:center">Indent Date</th>
																		<th  style="text-align:center">Action</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		@if(isset($data['Indentdata']))
																			@foreach($data['Indentdata'] as $Indentdata)
																			    @if($Indentdata->created_by == session('WcmsEmpNo'))
																					<tr>
																						<td align="center">{{ $loop->iteration }} </td>
																						<td align="left">{{ $Indentdata->indent_no}}</td>
																						<td align="left">{{ $Indentdata->indent_descripton }}</td>
																						<td align="left">{{ $EmpDataArr[$Indentdata->created_by] }}</td>
																						<td align="left">{{ Helper::DisplayDateFormat($Indentdata->indent_date) }}</td>
																						<td align="center"><button type="button" onclick="window.location='{{ route('indent.indent-status-view',['id'=>encrypt($Indentdata->indent_id)]) }}'" class="btn btn-default tuploadbtn" title="Click here to view status" style="cursor: pointer;"><i class="fa fa-book"></i> Click here to view </button>
																					</tr>
																				@endif	
																			@endforeach
																		@endif
																	</tr>
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
									
								<!-- </div> -->
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
