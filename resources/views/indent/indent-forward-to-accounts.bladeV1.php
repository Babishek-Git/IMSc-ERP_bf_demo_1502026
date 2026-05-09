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
													<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Indent Forward to Accounts Section</div></div></div>
													<div class="card-body padding-1 ChartCard" id="CourseChart">
														<div class="divrowbox innerdiv pt-2">
																					
															<div class="row smclearrow"></div>                                                                                											
															<table class="table-bordered table1" width="99%" align="center" id="dataTable">
																<thead>
																	<tr class="note heading">
																		<th  style="text-align:center">SNo.</th>
																		<th  style="text-align:center">Indent No.</th>
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
																				@if($Indentdata ->to_emp_no == session('WcmsEmpNo'))
																					<tr>
																						<td align="center">{{ $loop->iteration }} </td>
																						<td align="left">{{ $Indentdata->indent_no}}</td>
																						<td align="left">{{ $Indentdata->indent_descripton }}</td>
																						<td align="left">{{ $Indentdata->emp_name_payslip }}</td>
																						<td align="left">{{ Helper::DisplayDateFormat($Indentdata->indent_date) }}</td>
																						<td align="center" ><button type="button" name="btn_edit" class="btn btn-default tuploadbtn" id="btn_edit" value=" Edit" onclick="window.location='{{ route('indent.indent-creation',['EditId' => encrypt($Indentdata->indent_id),'page' => encrypt('FORWARD')]) }}'"> <i class='fa fa-share'></i> View & Forward </button></td>
																					</tr>
																				@endif	
																			@endforeach
																		@endif
																	</tr>
																</tbody>
															</table>
															<div class="row smclearrow"></div> 
															<div class="row smclearrow"></div> 
															<div class="row smclearrow"></div>                                                                                											
														</div>
													</div>	
												</div>									
											</div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
										</div>
									<div class="row" align="center">
										<!-- <button type="submit" id="btn_save" name="btn_save" class="step-btn" value="Save">SAVE</button>  -->
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

							<input type="hidden" name="wf_module_code" id="wf_module_code" value="{{ encrypt('INDENT') }}" />
                            <input type="hidden" name="txt_wf_mode" id="txt_wf_mode" />
                            <input type="hidden" name="txt_actual_emp" id="txt_actual_emp" />
                            <input type="hidden" name="txt_wf_remark" id="txt_wf_remark" />
                            <input type="hidden" name="txt_wf_emp_no" id="txt_wf_emp_no" />
                            <input type="hidden" name="txt_wf_role" id="txt_wf_role" />
                            <input type="hidden" name="txt_wf_action" id="txt_wf_action" />
                            <input type="hidden" name="txt_role_position" id="txt_role_position" />
						</div>
					</div>
               				                      
				</blockquote>
			</div>
		</div>
	</div>
</form>
@include('common-workflow.workflow-process')

<script>

</script>
@endsection
