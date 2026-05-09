@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="" method="post" enctype="multipart/form-data" name="form">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row ">
								<div class="div2">&nbsp;</div>
								<div class="div8 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Executed By</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Name of Work <span class="reqindi">*</span></div>											
											<div class="div9">
											<div class="div9"><textarea type="text" readonly="" name="txt_name_of_work" id="txt_name_of_work" maxlength="50" class="tboxclass disable estchange" value="" style="width:500px">@if(isset($WorkName)){{ $WorkName; }}@endif</textarea></div>
											</div>
											@php
												if(isset($data['NameOfWork'])){
													$Module = collect($data['NameOfWork'])->pluck('work_stage')->first();
													$GlobId = collect($data['NameOfWork'])->pluck('globid')->first();
													$RefNo = collect($data['NameOfWork'])->pluck('ref_no')->first();
													$RefNoLen = strlen($RefNo);
													$WorkStage = Helper::GetWorkStage($Module);
													 
													if($RefNoLen >= 60){
														@endphp
														<div class="row smclearrow"></div>                                                                          											
														<div class="div3 label">Ref No <span class="reqindi">*</span></div>											
														<div class="div9"><textarea type="text" readonly="" name="txt_module_name" id="txt_module_name" maxlength="50" class="tboxclass disable estchange" value="" style="width:500px">{{ $RefNo }}</textarea></div>
														<div class="row smclearrow"></div>
														@php
													}else{
														@endphp
														<div class="row smclearrow"></div>                                                                          											
														<div class="div3 label">Ref No <span class="reqindi">*</span></div>											
														<div class="div9"><input type="text" readonly="" name="txt_module_name" id="txt_module_name" maxlength="50" class="tboxclass disable estchange" value="{{ $RefNo }}" style="width:500px"></div>
														<div class="row smclearrow"></div>
														@php
													}   
													if(isset($data['TsNo'])){
														$TsNo = $data['TsNo'];
														if($TsNo != NULL){
															@endphp        
															<div class="row smclearrow"></div>                                                                       											
															<div class="div3 label">Technical Sanction No. <span class="reqindi">*</span></div>											
															<div class="div9"><input type="text" readonly="" name="txt_ts_no" id="txt_ts_no" maxlength="50" class="tboxclass disable estchange" value="{{ $TsNo }}" style="width:500px"></div>
															<div class="row smclearrow"></div>
															@php
														}
													}
													if(isset($data['TrNo'])){
														$TrNo = $data['TrNo'];
														if($TrNo != NULL){
															@endphp        
															<div class="row smclearrow"></div>                                                                       											
															<div class="div3 label">Tender No. <span class="reqindi">*</span></div>											
															<div class="div9"><input type="text" readonly="" name="txt_tr_no" id="txt_tr_no" maxlength="50" class="tboxclass disable estchange" value="{{ $TrNo }}" style="width:500px"></div>
															<div class="row smclearrow"></div>
															@php
														}
													}
													if(isset($data['WorkOrderNo'])){
														$WorkOrderNo = $data['WorkOrderNo'];
														if($WorkOrderNo != NULL){
															@endphp        
															<div class="row smclearrow"></div>                                                                       											
															<div class="div3 label">Work Order No. <span class="reqindi">*</span></div>											
															<div class="div9"><input type="text" readonly="" name="txt_work_order_no" id="txt_work_order_no" maxlength="50" class="tboxclass disable estchange" value="{{ $WorkOrderNo }}" style="width:500px"></div>
															<div class="row smclearrow"></div>
															@php
														}
													}
													@endphp
													<div class="row smclearrow"></div>                                                                             											
													<div class="div3 label">Module Name <span class="reqindi">*</span></div>											
													<div class="div9"><input type="text" readonly="" name="txt_module_name" id="txt_module_name" maxlength="50" class="tboxclass disable estchange" value="{{ $WorkStage }}" style="width:500px"></div>
													<div class="row smclearrow"></div>

													<input type="hidden" name = "hid_exected_id" id = "hid_exected_id" value = "{{ $GlobId }}">
													@php
												}
											@endphp	
											
											<div class="div3 label">Work Created Employee Name<span class="reqindi">*</span> </div>
											@php
												if(isset($data['EmpNo'])){
													$EmpName = collect($data['EmpNo'])->pluck('emp_known_as')->first();
													$EmpNo = collect($data['EmpNo'])->pluck('emp_no')->first();
													@endphp
													<div class="div9"><input type="text" readonly="" name="txt_from_emp_no" id="txt_from_emp_no" maxlength="50" class="tboxclass disable estchange" value="{{ $EmpName }} ({{$EmpNo}})" style="width:500px"></div>
													@php
												}
											@endphp										

											<div class="div3 label">To Employee name<span class="reqindi">*</span></div>											
											<div class="div9">
											<select name="sel_select_to_employee" id="sel_select_to_employee" class="textboxdisplay" style="width:500px;height:30px">
												<option value="">--------------- Select ---------------</option>																
												@if(isset($data['StaffData']))
													@foreach($data['StaffData'] as $key=>$value)
														<option value="{{ $value->emp_no }}">{{ $value->emp_known_as }} - {{ $value->emp_no }}</option>
													@endforeach
												@endif
											</select>
											</div>

											<div class="row smclearrow"></div> 
											@php $AddUrl = 'admin.ExecutedWork'; @endphp
											<div class="row">
												<div class="div12" align="center">
												<input type="button" name="back" value="Back" class="backbutton" onClick="window.location='{{route($AddUrl)}}'" >
												<input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" UPDATE " />									
												<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
												</div>		
											</div>
											<div class="row smclearrow"></div>  
										</div>
									</div>										
								</div>
							</div>                           
						</div>
					</blockquote>
				</div>
			</div>
		</div>
	</form>
</body>


<script>
	$(document).ready(function() {
		$("#sel_select_to_employee").chosen();

	});


$("body").on("click","#btn_save", function(event){
	var ToEmpName = $('#sel_select_to_employee').val();
	if(ToEmpName == ""){
		BootstrapDialog.alert("Please select the employee name!");
		event.preventDefault();
		event.returnValue = false;
	}
});

</script>

@endsection