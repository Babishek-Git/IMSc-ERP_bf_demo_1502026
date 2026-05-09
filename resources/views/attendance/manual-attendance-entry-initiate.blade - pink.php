@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
<style>
	/*.ThreeDCheck {
	opacity: 0;
	position: absolute;
	}

	.ChLable {
	position: relative;
	background: #fff;
	border-radius: 2em;
	padding: 0.8em 1em 0.8em 1em;
	cursor: pointer;
	text-shadow: 0 2px 2px #fff;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	box-shadow: 0 4px 7px 1px rgba(0, 0, 0, 0.2);
	border: 0.5px solid #00bcd4 !important;
	border-bottom: 2px solid #00bcd4 !important;
	width: 100%;
	}
	.ChLable::before {
	content: "";
	position: absolute;
	top: 50%;
	right: 0.7em;
	width: 3em;
	height: 1.2em;
	border-radius: 0.6em;
	background: #eee;
	transform: translateY(-50%);
	box-shadow: 0 1px 3px rgba(100, 100, 100, 0.5) inset, 0 0 10px rgba(100, 100, 100, 0.2) inset;
	}
	.ChLable::after {
	content: "";
	position: absolute;
	top: 48%;
	right: 2.6em;
	width: 1.4em;
	height: 1.4em;
	border: 0.25em solid #fafafa;
	border-radius: 50%;
	box-sizing: border-box;
	background-color: #ddd;
	background-image: linear-gradient(to top, #fff 0%, #fff 40%, transparent 100%);
	transform: translateY(-50%);
	box-shadow: 0 3px 3px rgba(0, 0, 0, 0.5);
	}
	.ChLable, .ChLable::before, .ChLable::after {
	transition: all 0.2s cubic-bezier(0.165, 0.84, 0.44, 1);
	}

	.ChLable:hover, input:focus + .ChLable {
	color: black;
	}
	.ChLable:hover::after, input:focus + .ChLable::after {
	background-color: #ccc;
	box-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
	}

	input:checked {
	counter-increment: total;
	}
	input:checked + .ChLable::before {
	background: #1CE;
	}
	input:checked + .ChLable::after {
	transform: translateX(2em) translateY(-50%);
	}
	.Btn-3Check{
	margin: 1em 0;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:17px;
	font-weight:400;
	color: #2F373E;
	width:100%;
	text-align:left;
	}*/
	/*.employee-grid {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
		gap: 15px;
		margin-bottom: 30px;
	}

	.employee-box {
		border: 2px solid #4dd0e1;
		border-radius: 8px;
		padding: 15px;
		background: white;
		display: flex;
		align-items: center;
		justify-content: space-between;
		transition: all 0.3s ease;
	}

	.employee-box:hover {
		box-shadow: 0 2px 8px rgba(77, 208, 225, 0.3);
		border-color: #26c6da;
	}

	.left-section {
		display: flex;
		align-items: center;
		gap: 10px;
	}

	.employee-label {
		font-size: 13px;
		font-weight: 600;
		color: #0000CD;
	}

	.checkbox-wrapper {
		position: relative;
		display: inline-block;
	}

	.checkbox-wrapper input[type="checkbox"] {
		position: absolute;
		opacity: 0;
		cursor: pointer;
		height: 0;
		width: 0;
	}

	.checkbox-custom {
		position: relative;
		width: 18px;
		height: 18px;
		border: 2px solid #4dd0e1;
		border-radius: 4px;
		cursor: pointer;
		transition: all 0.3s ease;
		background: white;
		display: flex;
		align-items: center;
		justify-content: center;
		flex-shrink: 0;
	}

	.checkbox-wrapper:hover .checkbox-custom {
		border-color: #26c6da;
		box-shadow: 0 0 6px rgba(77, 208, 225, 0.3);
	}

	.checkbox-wrapper input[type="checkbox"]:checked ~ .checkbox-custom {
		background: linear-gradient(135deg, #4dd0e1 0%, #26c6da 100%);
		border-color: #26c6da;
	}

	.checkbox-custom::after {
		content: '';
		position: absolute;
		display: none;
		left: 5px;
		top: 2px;
		width: 4px;
		height: 8px;
		border: solid white;
		border-width: 0 2px 2px 0;
		transform: rotate(45deg);
	}

	.checkbox-wrapper input[type="checkbox"]:checked ~ .checkbox-custom::after {
		display: block;
		animation: checkmark 0.3s ease;
	}

	@keyframes checkmark {
		0% {
			transform: rotate(45deg) scale(0);
			opacity: 0;
		}
		50% {
			transform: rotate(45deg) scale(1.2);
		}
		100% {
			transform: rotate(45deg) scale(1);
			opacity: 1;
		}
	}

	
	.status-indicator {
		width: 28px;
		height: 28px;
		border-radius: 50%;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 16px;
		font-weight: bold;
		transition: all 0.3s ease;
		flex-shrink: 0;
	}

	.status-indicator.pending {
		background-color: #e0e0e0;
		color: #9e9e9e;
	}

	.status-indicator.completed {
		background-color: #4caf50;
		color: white;
		animation: successPulse 0.6s ease;
	}

	@keyframes successPulse {
		0% {
			transform: scale(0.8);
			opacity: 0.5;
		}
		50% {
			transform: scale(1.1);
		}
		100% {
			transform: scale(1);
			opacity: 1;
		}
	}

	.next-button {
		background: #1e3a5f;
		color: white;
		border: none;
		padding: 12px 40px;
		font-size: 16px;
		font-weight: bold;
		border-radius: 5px;
		cursor: pointer;
		display: block;
		margin: 0 auto;
		transition: background 0.3s ease;
	}

	.next-button:hover {
		background: #2c5282;
	}

	.next-button:active {
		transform: scale(0.98);
	}

	.instructions {
		background: #e3f2fd;
		padding: 15px;
		border-radius: 5px;
		margin-bottom: 0px;
		font-size: 13px;
		color: #0000CD;
	}*/


	.center input[type="checkbox"] {
  position: relative;
  display: inline-block;
  min-height: 90px;
  width: 30%;
  background: #ebebeb;
  -webkit-appearance: none;
  -moz-appearance: none;
  -o-appearance: none;
  appearance: none;
}

.center input[type="checkbox"]:after { 
  content: attr(data-label); 
  font-size: 13px;
  font-weight: 600;
  color: #555555;
  position: absolute;
  left: 0; 
  right: 0; 
  bottom: 0; 
  top: 0;
  margin: auto;
  display: flex;          /* use flexbox instead of line-height */
  align-items: center;    /* vertical center */
  justify-content: center;/* horizontal center */
  height: 70px;
  width: 70px;
  border-radius: 50%;
  background-color: #ffffff;
  transition: all 0.3s ease-out;
  text-align: center;
}

.center input[type="checkbox"]:before { 
  position: absolute;
  margin: auto auto;
  left: 0; right: 0; bottom: 0; top: 0;
  content: '';
  display: block; 
  height: 80px;
  width: 80px;
  border: 2px solid #fff;
  border-radius: 50%;
  -webkit-transition: all 0.1s ease-in;
  -moz-transition: all 0.1s ease-in;
  -ms-transition: all 0.1s ease-in;
  -o-transition: all 0.1s ease-in;
  transition: all 0.1s ease-in;
  font-size: 13px;
}

.center input[type="checkbox"]:hover:before {
  height: 60px;
  width: 60px;
}

.center input[type="checkbox"]:checked:before {
  height: 100%;
  width: 100%;
  background: #dd3455;
  border: none;
  border-radius: 0;
}

.center input[type="checkbox"]:focus {
  outline: none;
}

/*.center input[type="checkbox"].a:after { content: 'A'; } 
.center input[type="checkbox"].b:after { content: 'B'; }
.center input[type="checkbox"].c:after { content: 'C'; }*/
.center input[type="checkbox"]:after { 
  content: attr(data-label); 
}


/*.center input[type="checkbox"]:checked:after { content: '✓'; } */


	
</style>
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
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Manual Attendance Entry Initiate</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
											<!-- <div class="instructions">
												<i class="fa fa-info-circle" style="font-size:20px; color: #0D7A73;"></i> Select employee types for attendance generation. Green checkmark indicates successfully / already generated.
											</div>	 -->
											<div class="row smclearrow"></div>  
											<div class="row">
												<div class="div2">&nbsp;</div>
												<div class="div2 label cboxlabel">Payroll Year</div>
												<div class="div2">
													<select name="cmb_pay_year" id="cmb_pay_year" class="tboxsmclass ChosenInput">
														<option value=""> -- Select -- </option>
														<option value="2024">2024</option>
														<option value="2025">2025</option>
														<option value="2026">2026</option>
													</select>
												</div>
												<div class="div2 label cboxlabel">Payroll Month</div>
												<div class="div2">
													<select name="cmb_pay_month" id="cmb_pay_month" class="tboxsmclass ChosenInput">
														<option value=""> -- Select -- </option>
														<option value="1">January</option>
														<option value="2">February</option>
														<option value="3">March</option>
														<option value="4">April</option>
														<option value="5">May</option>
														<option value="6">June</option>
														<option value="7">July</option>
														<option value="8">August</option>
														<option value="9">September</option>
														<option value="10">October</option>
														<option value="11">November</option>
														<option value="12">December</option>
													</select>
												</div>
												<div class="div2">&nbsp;</div>
											</div>					
											<div class="row smclearrow"></div>  
											<div class="row smclearrow"></div>  
											<div class="div12">
												<div class="center">
													@if(isset($data['employeeGroupMaster']))
														@foreach($data['employeeGroupMaster'] as $EmployeeGroupMasterList)
															<!-- <div class="Btn-3Check" style="margin-top:2px;">
																<input name="ch_emp_group" id="{{ $EmployeeGroupMasterList->emp_group_id }}" type="radio" class="ThreeDCheck Stmt" style="display:none" value="{{ $EmployeeGroupMasterList->emp_group_id }}"/>
																<label class="ChLable" for="{{ $EmployeeGroupMasterList->emp_group_id }}">{{ $EmployeeGroupMasterList->emp_group_name }}</label>
															</div> -->
															<!-- <div class="employee-box">
																<div class="left-section">
																	<label class="checkbox-wrapper">
																		<input type="checkbox" name="ch_emp_group[]" id="{{$EmployeeGroupMasterList->emp_group_id}}" value="{{ $EmployeeGroupMasterList->emp_group_id }}">
																		<span class="checkbox-custom"></span>
																	</label>
																	<div class="employee-label">{{ $EmployeeGroupMasterList->emp_group_name }}</div>
																</div>
																<div id="AdminStatus{{$EmployeeGroupMasterList->emp_group_id}}" class="status-indicator pending">✓</div>
															</div> -->
															<input type="checkbox" name="A" class="a" data-label="{{ $EmployeeGroupMasterList->emp_group_name }}"/> 
														@endforeach
													@endif
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
