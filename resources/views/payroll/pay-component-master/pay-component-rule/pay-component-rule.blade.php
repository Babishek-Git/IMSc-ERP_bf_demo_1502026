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
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Pay Component Rule</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
																	
											<div class="div2 label">
												Pay Component <span class="reqindi">*</span>
											</div>
											<div class="div3">
												<select name="cmb_pay_component" id="cmb_pay_component" class="tboxsmclass">
													<option value="">-------- Select -------</option>
													@if(isset($data['components']))
														@foreach($data['components'] as $key => $value)
															<option value="{{$value->component_id}}" data-typeCode="{{$value->componentType->component_type_code}}" data-typeId="{{$value->component_type_id}}">{{$value->component_name}}</option>
														@endforeach
													@endif	
												</select>
											</div>
											<div class="div2 label pd-l-20">
												Rule Type <span class="reqindi">*</span>
											</div>
											<div class="div3">
												<select name="cmb_rule_type" id="cmb_rule_type" class="tboxsmclass">
													<option value="">-------- Select -------</option>
													@if(isset($data['ruleType']))
														@foreach($data['ruleType'] as $key => $value)
															<option value="{{$value->rule_type_code}}">{{$value->rule_type_name}}</option>
														@endforeach
													@endif	
												</select>
											</div>
											<div class="row smclearrow"></div> 

											<div class="div2 label fixAmt hide">
												Fixed Amount <span class="reqindi">*</span>
											</div>
											<div class="div3 fixAmt hide">
												<input type="text" name="txt_fixed_amt" id="txt_fixed_amt" class="tboxsmclass">
											</div>
											<div class="row smclearrow fixAmt hide"></div> 

											<div class="div2 label Percent hide">
												Percentage <span class="reqindi">*</span>
											</div>
											<div class="div3 Percent hide">
												<input type="text" name="txt_percentage" id="txt_percentage" class="tboxsmclass">
											</div>
											<div class="div2 label pd-l-20 Percent hide">% of Component <span class="reqindi">*</span></div>
											<div class="div3 Percent hide">
												<select name="cmb_pay_component_for_perc" id="cmb_pay_component_for_perc" class="tboxsmclass">
													<option value="">-------- Select -------</option>
													@if(isset($data['components']))
														@foreach($data['components'] as $key => $value)
															<option value="{{$value->component_id}}" data-typeCode="{{$value->componentType->component_type_code}}" data-typeId="{{$value->component_type_id}}">{{$value->component_name}}</option>
														@endforeach
													@endif	
												</select>
											</div>
											<div class="row smclearrow Percent hide"></div> 
											<div class="row smclearrow Formula hide">&nbsp;</div> 
											<div class="row step-mbtable Formula hide" style="border-radius: 15px;">
												<div class="row divhead">Formula Builder</div>
												<div class="div3">
													<div class="box-oval" style="margin:3px">
														<div class="div12 label">
															Base Component <span class="reqindi">*</span>
														</div>
														<div class="div12 no-mg-top">
															<select name="cmb_pay_component_for_formula" id="cmb_pay_component_for_formula" class="tboxsmclass">
																<option value="">-------- Select -------</option>
																@if(isset($data['components']))
																	@foreach($data['components'] as $key => $value)
																		<option value="{{$value->component_id}}" data-typeCode="{{$value->componentType->component_type_code}}" data-typeId="{{$value->component_type_id}}">{{$value->component_name}}</option>
																	@endforeach
																@endif	
															</select>
														</div>
														
														<div class="row smclearrow"></div> 
														<div class="div12 label">
															Operation <span class="reqindi">*</span>
														</div>
														<div class="div12 no-mg-top">
															<select name="cmb_operation" id="cmb_operation" class="tboxsmclass">
																<option value="">-------- Select -------</option>
																<option value="ADD">Addition [+]</option>
																<option value="SUB">Subtraction [-]</option>
																<option value="MUL">Multiplication [x]</option>
																<option value="DIV">Division [/]</option>
																<option value="PERC">Percentage [%]</option>
															</select>
														</div>
														<div class="row smclearrow"></div> 
														<div class="div12 label">
															Conditional <span class="reqindi">*</span>
														</div>
														<div class="div12 no-mg-top">
															<select name="cmb_conditional" id="cmb_conditional" class="tboxsmclass">
																<option value="">-------- Select -------</option>
																<option value="IF_COND">IF</option>
																<option value="ELSE_COND">ELSE</option>
															</select>
														</div>
														<div class="row smclearrow"></div> 
														<div class="div12 label">
															Static Value <span class="reqindi">*</span>
														</div>
														<div class="div12 no-mg-top">
															<input type="text" name="txt_percentage" id="txt_percentage" class="tboxsmclass">
														</div>
														<div class="row smclearrow">&nbsp;</div> 
													</div>
												</div>
												<div class="div9">
													<div class="box-oval" style="margin:3px">
														<div class="div3 cboxlabel">
															Min Value <span class="reqindi">*</span>
														</div>
														<div class="div3 label">
															<input type="text" name="txt_fixed_amt" id="txt_fixed_amt" class="tboxsmclass">
														</div>
														<div class="div2 cboxlabel">
															Max Value <span class="reqindi">*</span>
														</div>
														<div class="div3 label">
															<input type="text" name="txt_fixed_amt" id="txt_fixed_amt" class="tboxsmclass">
														</div>
														<div class="row smclearrow"></div>
														<div class="div12">
															<textarea name="txt_formula_text" id="txt_formula_text" class="tboxsmclass" rows="13"></textarea>
														</div> 
														<div class="row smclearrow"></div> 
													</div>
												</div>
												<div class="row smclearrow"></div> 
											</div>
											

											<div class="row smclearrow">&nbsp;</div>  
											<div class="row">
												<div class="div12" align="center">
													<input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />									
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
