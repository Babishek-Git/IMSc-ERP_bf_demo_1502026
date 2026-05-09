@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
<style>
	.ThreeDCheck {
	opacity: 0;
	position: absolute;
	}

	.ChLable {
	position: relative;
	background: #fff;/*#f8f8f8;*/
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
		flex: 0 0 calc(33.333% - 10px);
	margin: 1em 0;
	/*font: 1.5em/1.4 "Open Sans Condensed", sans-serif;*/
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:17px;
	font-weight:400;
	color: #2F373E;
	width:100%;
	text-align:left;
	}
	.parent-flex {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
	}

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
								<div class="div12">&nbsp;</div>
									<div class="div12 mbtable">
										<div class="row"><div class="div12" style="margin-top:0px;">
											<div class="row divhead" align="center" style="text-align:left">
												Administrative & Academic & Pensioners
											</div>
										</div>
									</div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">					
											<div class="row smclearrow"></div>  
											<div class="div"></div>                                                                              											
											<div class="parent-flex">
												@if(isset($data['employeeGroupMaster']['P']))
													@foreach($data['employeeGroupMaster']['P'] as $item)
														<div class="Btn-3Check">
															<input 
																name="rad_emp_group" 
																id="group_{{ $item->emp_group_id }}" 
																type="radio" 
																class="ThreeDCheck" 
																style="display:none" 
																value="{{ $item->emp_group_id }}"
															/>
															<label class="ChLable" for="group_{{ $item->emp_group_id }}">
																{{ $item->emp_group_name }}
															</label>
														</div>
													@endforeach
												@endif
											</div>
											<div class="div2"></div>    
											<div class="row smclearrow"></div> 
										</div>
									</div>										
								</div>
								<div class="div12 mbtable">
									<div class="row">
										<div class="div12" style="margin-top:0px;">
											<div class="row divhead" align="center" style="text-align:left">
												Research Scholar, Project Staff & Trainee
											</div>
										</div>
									</div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">					
											<div class="row smclearrow"></div>  
											<div class="div"></div>                                                                              											
											<div class="parent-flex">
												@if(isset($data['employeeGroupMaster']['T']))
													@foreach($data['employeeGroupMaster']['T'] as $item)
														<div class="Btn-3Check">
															<input 
																name="rad_emp_group" 
																id="group_{{ $item->emp_group_id }}" 
																type="radio" 
																class="ThreeDCheck" 
																style="display:none" 
																value="{{ $item->emp_group_id }}"
															/>
															<label class="ChLable" for="group_{{ $item->emp_group_id }}">
																{{ $item->emp_group_name }}
															</label>
														</div>
													@endforeach
												@endif
											</div>
											<div class="div2"></div>    
											<div class="row smclearrow"></div> 
										</div>
									</div>										
								</div>
								@php $AddUrl = 'roles.ViewRoleMaster'; @endphp										
											<div class="row">
												<div class="div12" align="center">
													<input type="submit" class="step-btn" name="btn_initiate" id="btn_initiate" value=" Next " />									
													<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
												</div>		
											</div>
											<div class="row smclearrow"></div> 
								<div class="div3">&nbsp;</div>
							</div>                           
						</div>
					</blockquote>
				</div>
			</div>
		</div>
	</form>
</body>	
<script type="text/javascript" language="javascript">
	var KillEvent = 0;
	$("body").on("click","#btn_initiate", function(event){
		if(KillEvent == 0){
			var EmpGrpLength  = $('input[name="rad_emp_group"]:checked').length;
			if(EmpGrpLength == 0) {
				BootstrapDialog.alert("Please select atleast one option to proceed");
				event.preventDefault();
				event.returnValue = false;
			}else{
				event.preventDefault();
				KillEvent = 1;
				$("#btn_initiate").trigger( "click" );
				// BootstrapDialog.confirm({
				// 	title: 'Confirmation Message',
				// 	message: 'Are you sure want to go next ?',
				// 	closable: false, // <-- Default value is false
				// 	draggable: false, // <-- Default value is false
				// 	btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
				// 	btnOKLabel: 'Ok', // <-- Default value is 'OK',
				// 	callback: function(result) {
				// 		if(result){
				// 			KillEvent = 1;
				// 			$("#btn_initiate").trigger( "click" );
				// 		}else {
				// 			KillEvent = 0;
				// 		}
				// 	}
				// });
			}
		}
	});

</script>
@endsection
