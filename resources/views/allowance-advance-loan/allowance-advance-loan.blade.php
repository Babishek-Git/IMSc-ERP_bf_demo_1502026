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
							<div class="row">
								<div class="div3"></div>
								<div class="div6">
									<div class="form-box">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Allowance,Advance & Allowance Master</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
											<div class="row smclearrow"></div>
											<div class="div4 label label">Choose the Component</div>											
									        <div class="div2 lboxlabel"><input type="radio"name="rad_alw_adv" id="rad_alw" value="ALOW">  &emsp; Allowance</div>
											<div class="div2 lboxlabel"><input type="radio" name="rad_alw_adv"  id="rad_adv" value="ADVA"> &emsp; Advance</div>
											<div class="div2 lboxlabel"><input type="radio" name="rad_alw_adv"  id="rad_adv" value="LOAN"> &emsp; Loan</div>
											<div class="row smclearrow"></div>                                                                                											
											<div class="div4 label"><span id="TypeCode">Allowance</span> Code <span class="reqindi">*</span></div>
											<div class="div7"><input type="text" name="txt_alw_adv_code" id="txt_alw_adv_code" class="tboxsmclass" value=""></div>
											<div class="row smclearrow"></div>                                                                                											
											<div class="div4 label"><span id="TypeName">Allowance</span> Name <span class="reqindi">*</span></div>
											<div class="div7"><input type="text" name="txt_alw_adv_name" id="txt_alw_adv_name" class="tboxsmclass" value=""></div>
											<div class="row smclearrow"></div>
											<div class="div4 label label">Is Taxable</div>											
									        <div class="div2 lboxlabel"><input type="radio"name="rad_tax" id="rad_is_tax" value="YES">  &emsp; Yes</div>
											<div class="div2 lboxlabel"><input type="radio" name="rad_tax" id="rad_no_tax" value="NO"> &emsp; No</div>
											<div class="row smclearrow"></div>
											<div class="div4 label label">Percentage/Fixed Amount</div>											
									        <div class="div2 lboxlabel"><input type="radio"name="rad_perc_amt" id="rad_perc" value="PERC">  &emsp; Percentage</div>
											<div class="div4 lboxlabel"><input type="radio"name="rad_perc_amt" id="rad_fix_amt" value="FIXAMt"> &emsp; Fixed Amount</div>
											<div class="row smclearrow"></div>
											<div id="perc_Rate"></div>
											<div class="div4 label Perct hide">Percentage Rate</div>
											<div class="div4 Perct hide" ><input type="text" name="percente_rate"  id="percente_rate" class="tboxsmclass" value=""></div>
											<div class="div3 pd-l-20 Perct hide">
												<select class="Perct hide" name="rate_type" id="rate_type" class="tboxsmclass ChosenInput">
													<option class="label" value="BASIC">BASIC</option>
													<option class="label" value="BASICDA">BASIC DA</option>
											    </select>
										    </div>
											<div class="div4 label Fixamt hide">Fixed Amount</div>
											<div class="div7 Fixamt hide"> <input type="text" name="txt_fix_amt"  id="txt_fix_amt" class="tboxsmclass" value=""></div>
											<div class="row smclearrow"></div>
											<div class="div4 label">With Effect From <span class="reqindi">*</span></div>
											<div class="div7"><input type="text" name="txt_witheffect" id="txt_witheffect" class="tboxsmclass datepicker" value=""></div>
											<div class="row smclearrow"></div>
											<div class="div4 label">Applicable To <span class="reqindi">*</span></div>
											@if(isset($data['EmployeeGroupData']))
												@foreach($data['EmployeeGroupData'] as $EmployeeGroupData)
													<div class="div3 lboxlabel"><input type="checkbox" name="txt_allowance_to[]" id="txt_allowance_to" value="{{$EmployeeGroupData->emp_group_id}}"> &emsp; {{$EmployeeGroupData->emp_group_name}}</div>
												@endforeach
											@endif 
											<!-- <div class="row smclearrow"></div>
											<div class="row smclearrow"></div>                                                                                											
											<div class="div3" align="right"><input type="checkbox" name="ch_perc_app" id="ch_perc_app" class="tboxsmclass" value="True"></div>
											<div class="div9 label" align="left">Is Percentage Applicable<span class="reqindi">*</span></div> 
											<div class="row smclearrow"></div> -->
											@php $BackUrl = 'user.ViewUser'; @endphp 									
											<div class="row">
												<div class="div12" align="center">
													<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" Back " onClick="window.location='{{route($BackUrl)}}'" />
													<button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Save">Save</button>									
													<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
												</div>		
											</div>
											<div class="row smclearrow"></div>  
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
	$(".ChosenInput").chosen();
	$("#txt_division").chosen();
	$("#txt_role_group").chosen();
	$("#perc_Rate").empty();
	$('#dataTable').DataTable({
		responsive: true,
		paging: true, 
	});	

	$(document).on('click','input[name="rad_alw_adv"]',function(){
		
		let Type = $(this).val();
		if(Type == 'ALOW'){
			$('#TypeName').text('Allowance');
			$('#TypeCode').text('Allowance');
			$('#MaxType').text('Allowance');
		}else if(Type == 'ADVA'){
			$('#TypeName').text('Advance');
			$('#TypeCode').text('Advance');
			$('#MaxType').text('Advance');
		}else{
			$('#TypeName').text('Loan');
			$('#TypeCode').text('Loan');
			$('#MaxType').text('Loan');
		}
	});

	// $(document).on('change','#rad_perc',function(){
	// 		$("#perc_Rate").append( '<div class="div4 label">Percentage Rate</div> <div class="div4"> <input type="text" name="percente_rate"  id="percente_rate" class="tboxsmclass" value=""></div><div class="div3 pd-l-20"><select name="rate_type" id="rate_type" class="tboxsmclass ChosenInput"><option value="BASIC">BASIC</option><option value="BASICDA">BASIC DA</option></select></div>' );
	// });
	
	 $(document).on('change','input[name="rad_perc_amt"]',function(){
		let Type = $(this).val();
		if(Type == 'PERC'){ 
			$(".Perct").removeClass('hide');
		    $(".Fixamt").addClass('hide');
		}else if(Type == 'FIXAMt'){
			$(".Fixamt").removeClass('hide');
		    $(".Perct").addClass('hide');
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
					message: 'Are you sure want to Allowance,Adance,Loan Master ?',
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
