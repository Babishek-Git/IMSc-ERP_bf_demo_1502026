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
							<div class="row plr">
								<div class="div2">&nbsp;</div>
								<div class="div8 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Income Tax Regime Selection Initiation</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
											<!-- <div class="instructions">
												<i class="fa fa-info-circle" style="font-size:20px; color: #0D7A73;"></i> Select employee types for attendance generation. Green checkmark indicates successfully / already generated.
											</div>	 -->
											<div class="row smclearrow"></div>  
											<div class="row">
												<div class="div2">&nbsp;</div>
												<div class="div2 label cboxlabel">Financial Year</div>
												<div class="div2">
													<select name="cmb_fin_year" id="cmb_fin_year" class="tboxsmclass ChosenInput">
														<option value=""> -- Select -- </option>
														@if(isset($data['AllFinancialYear']))
														@foreach($data['AllFinancialYear'] as $FinancialYear)
															<option value="{{$FinancialYear}}">{{$FinancialYear}}</option>
														@endforeach
														@endif
													</select>
												</div>
												
												<div class="div2">&nbsp;</div>
											</div>					
											<div class="row smclearrow"></div>  
											<div class="row smclearrow"></div>  
											<div class="div12">
												<div class="center">
													<fieldset class="emp-checkbox-group">
													@if(isset($data['employeeGroupMaster']))
														@foreach($data['employeeGroupMaster'] as $EmployeeGroupMasterList)
															
															<div id="AdminStatus{{$EmployeeGroupMasterList->emp_group_id}}" class="status-indicator pending">&nbsp;</div>

															<div class="emp-checkbox">
																<label class="emp-checkbox-wrapper">
																	<input type="checkbox" class="emp-checkbox-input" name="ch_emp_group[]" id="{{$EmployeeGroupMasterList->emp_group_id}}" value="{{ $EmployeeGroupMasterList->emp_group_id }}" />
																	<span class="emp-checkbox-tile">
																		<span class="emp-checkbox-icon">
																			<img src="{{asset('assets/images/employee2.png')}}" alt="emp" width="50" height="50">
																		</span>
																		<span class="emp-checkbox-label">{{ $EmployeeGroupMasterList->emp_group_name }}</span>
																	</span>
																</label>
															</div>
														@endforeach
													@endif
													</fieldset>
												</div>
											</div>
											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div12" align="center">
													<input type="submit" class="backbutton" name="btn_initiate" id="btn_initiate" value=" Next " />									
													<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
												</div>		
											</div>
											<div class="row smclearrow"></div>  
										</div>
									</div>										
								</div>
								<div class="div2">&nbsp;</div>
							</div>                           
						</div>
					</blockquote>
				</div>
			</div>
		</div>
	</form>
</body>	
<script type="text/javascript" language="javascript">
	$(".ChosenInput").chosen();
	var KillEvent = 0;
	$("body").on("click","#btn_initiate", function(event){
		if(KillEvent == 0){
			var EmpGrpLength  = $('input[name="ch_emp_group[]"]:checked').length;
			if(EmpGrpLength == 0) {
				BootstrapDialog.alert("Please select atleast one option to proceed");
				event.preventDefault();
				event.returnValue = false;
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure want to go next ?',
					closable: false, // <-- Default value is false
					draggable: false, // <-- Default value is false
					btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
					btnOKLabel: 'Ok', // <-- Default value is 'OK',
					callback: function(result) {
						if(result){
							KillEvent = 1;
							$("#btn_initiate").trigger( "click" );
						}else {
							KillEvent = 0;
						}
					}
				});
			}
		}
	});

</script>
@endsection
