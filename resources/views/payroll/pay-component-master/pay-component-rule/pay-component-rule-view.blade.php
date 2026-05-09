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
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Pay Component Rule List</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
											<div class="row smclearrow"></div>     
											<div class="row">     
												<div class="div12">                                                                        											
													<table class="formtable" align="center" id="dataTable" width="100%">
														<thead>
															<tr>
																<th class="colhead" nowrap="nowrap">SNo.</th>
																<th class="colhead">Component Name</th>
																<th class="colhead">Min. Amount</th>
																<th class="colhead">Max. Amount</th>
																<th class="colhead">Rule Type</th>
																<th class="colhead">Fixed Amount</th>
																<th class="colhead">Fixed Percentage</th>
																<th class="colhead">Base Component</th>
																<th class="colhead">Formula</th>
																<th class="colhead">With Effect From</th>
															</tr>
														</thead>
														<tbody>
														@if(isset($data['RuleData']))
														@foreach($data['RuleData'] as $RuleData)
															<tr>
																<td align="center">{{$loop->iteration}}</td>
																<td>{{$RuleData->component_name}}</td>
																<td>{{$RuleData->min_amount}}</td>
																<td>{{$RuleData->max_amount}}</td>
																<td>{{$RuleData->rule_type_name}}</td>
																<td>{{$RuleData->fixed_amount}}</td>
																<td>{{$RuleData->fixed_percentag}}</td>
																<td>{{$RuleData->base_component}}</td>
																<td>{{$RuleData->formula}}</td>
																<td>{{Helper::DisplayDateFormat($RuleData->with_effect_from)}}</td>
															</tr>
														@endforeach
														@endif
														</tbody>
													</table>
												</div>
											</div>						
											<div class="row smclearrow">&nbsp;</div>  
											<div class="row">
												<div class="div12" align="center">
													<input type="submit" class="backbutton" name="btn_back" id="btn_back" value=" Back " onclick="window.location='{{ route('PayComponent.PayComponentRule') }}'" />									
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
<script type="text/javascript" language="javascript">
	$("#cmb_pay_component").chosen({width: "100%"});
	$("#cmb_rule_type").chosen({width: "100%"});
	$("#cmb_pay_component_for_perc").chosen({width: "100%"});
	$("#cmb_pay_component_for_formula").chosen({width: "100%"});
	$("#cmb_operation").chosen({width: "100%"});
	$("#cmb_conditional").chosen({width: "100%"});
	$('#dataTable').DataTable({
		responsive: true,
		paging: true, 
	});
	$(document).on('change', "#cmb_rule_type",function(evt){
		$(".fixAmt").addClass('hide');
		$(".Percent").addClass('hide');
		$(".Formula").addClass('hide');
		if($(this).val() == "FIXED"){
			$(".fixAmt").removeClass('hide');
		}else if($(this).val() == "PERCENTAGE"){
			$(".Percent").removeClass('hide');
		}else if($(this).val() == "FORMULA"){
			$(".Formula").removeClass('hide');
		}
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
