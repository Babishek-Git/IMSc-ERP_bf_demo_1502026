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
								
								<div class="div6">
									<div class="form-box">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Employee Electricity Charges Update</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row">     
													<div class="div12"> 
														<fieldset class="fieldbox">
															<legend class="fieldbox-legend">Selected  Month & Year</legend>
															<div class="fieldbox-div">	
																<div class ="row">
																	<div class="row smclearrow"></div>	
																	<div class="div2 label">Month <span class="reqindi">*</span></div>
																	<div class="div4">
																		<select name="cmb_month" id="cmb_month"  class="tboxsmclass ChosenInput">
																			<option value="">- Select Month-</option>
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
																	<div class="div2 cboxlabel">Year <span class="reqindi">*</span></div>
																	<div class="div4">
																		<select name="cmb_year" id="cmb_year"  class="tboxsmclass ChosenInput">
																			<option value="">-Select year-</option>
																			<option value="2026">2026</option>
																			<option value="2025">2025</option>
																		</select>
																	</div>
																	
																</div>
																<div class="row smclearrow">&nbsp;</div>
															</div>
														</fieldset> 
														<div class="row smclearrow"></div> 
														<div class="row smclearrow"></div> 

														<fieldset class="fieldbox">
															<legend class="fieldbox-legend">Enter the Electricity Unit & Charges</legend>
															<div class="fieldbox-div">	
																<div class ="div12">                                                                           											
																	<table class="formtable" align="center" width="100%">
																		<thead>
																			<tr>
																				<th class="colhead" nowrap="nowrap">SNo</th>
																				<th class="colhead">Employee Name</th>
																				<th class="colhead">Employee ICNo</th>
																				<th class="colhead">Employee Designation</th>
																				<th class="colhead">EB Unit</th>	
																				<th class="colhead">EB Charges</br>( &#8377; )</th>	
																			</tr>
																		</thead>
																		<tbody>
																		
																		@if(isset($data['HouseData']))
																			@foreach($data['HouseData'] as $HouseData)
																			<tr>
																				<td align="center">{{$loop->iteration}}</td>
																				<td>{{$HouseData->emp_name_payslip}}</td>
																				<input type="hidden" name="txt_emp_name_payslip[]" id="txt_emp_name_payslip{{$HouseData->emp_no}}" class="tboxclass" value="{{$HouseData->emp_no}}">

																				<td>{{$HouseData->emp_no}}</td>
																				<input type="hidden" name="txt_emp_no[]" id="txt_emp_no{{$HouseData->emp_no}}" class="tboxclass" value="{{$HouseData->emp_no}}">
																				
																				<td>{{$HouseData->designation_name}}</td>
																				<input type="hidden" name="txt_designation[]" id="txt_designation{{$HouseData->designation_id}}" class="tboxclass" value="{{$HouseData->designation_id}}">
																				
																				<td><input type="text" name="txt_eb_unit[]" id="txt_eb_unit" class="tboxclass" value=""></td>
																				<td><input type="text" name="txt_eb_charge[]" id="txt_eb_charge" class="tboxclass" value=""></td>
																				</td>
																			</tr>
																			@endforeach
																		@endif
																		
																		</tbody>
																	</table>
																</div>
															</div>
															<div class="row smclearrow"></div>
															<div class="row smclearrow"></div>
															<div class="row smclearrow"></div>
														</fieldset>
													</div>
												</div>  
												<div class="row">
													<div class="div12" align="center">
														<button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Save">Save</button>								
														<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
													</div>		
												</div>
												<div class="row smclearrow"></div>  
											</div>
										</div>	
									</div>									
								</div>
								<div class="div6">
									<div class="table-box">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row table-divhead" align="center"> Electicity Charges Update</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<table class="formtable" width="99%" align="center" id="dataTable">
													<thead>
														<tr class="note heading">
															<th  style="text-align:center">SNo.</th>
															<th  style="text-align:center">Employee Name</th>
															<th  style="text-align:center">Employee IcNo</th>
															<th  style="text-align:center">Employee Designation</th>
															<th  style="text-align:center">EB Unit</th>
															<th  style="text-align:center">EB Charge</br>( &#8377; )</th>
															
														</tr>
													</thead>
													<tbody>
													@if(isset($data['EbData']))
														@foreach($data['EbData'] as $EbData)
															<tr>
																<td align="center">{{ $loop->iteration }} </td>
																<td align="left">{{ $EbData->emp_name_payslip}}</td>
																<td align="left">{{ $EbData->emp_no}}</td>
																<td align="left">{{ $EbData->designation_name}}</td>
																<td align="left">{{ $EbData->eb_consump_unit}}</td>
																<td align="left">{{ $EbData->eb_amount}}</td>
															</tr>
														@endforeach
													@endif
													</tbody>
												</table>
											
											</div>
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
<script type="text/javascript" language="javascript">
	$("#txt_division").chosen();
	$("#txt_role_group").chosen();
	$('#dataTable').DataTable({
		responsive: true,
		paging: true, 
	});	

	var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var RoleName   		= $("#txt_role_name").val();
			var RoleDivision   	= $("#txt_division").val();
			var RoleGroup 		= $("#txt_role_group").val();

			if(RoleName == ""){
				BootstrapDialog.alert("Role Name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(RoleDivision == ""){
				BootstrapDialog.alert("Division Name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(RoleGroup == ""){
				BootstrapDialog.alert("User Group Name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure want to save Role ?',
					closable: false, // <-- Default value is false
					draggable: false, // <-- Default value is false
					btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
					btnOKLabel: 'Ok', // <-- Default value is 'OK',
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

</script>
@endsection
