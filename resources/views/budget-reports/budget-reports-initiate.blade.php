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
	margin: 0.5em 0;
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
<body class="page1" id="top" oncontextmenu="return false" onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="" method="post" enctype="multipart/form-data" name="form">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row ">
								<div class="row smclearrow"></div>  
								<div class="row smclearrow"></div>
								<div class="row smclearrow"></div>  
								<div class="row smclearrow"></div>
								<div class="div2">&nbsp;</div>
								<div class="div8 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Budget Reports</div></div></div>
									<div class="div12">
										<div class="row">
											<div class="center">
												<div class="row" style="padding:3px 50px">
													<div class="Btn-3Check">
														<input name="rad_emp_group_apex" id="group_apex" type="radio" checked readonly class="ThreeDCheck Initiate" style="display:none" value="AOHC"/>
														<label class="ChLable" for="group_apex">
															Click Here for <span style="color:#FA0F32">Apex Project & Object Head Consolidated Expenditure</span> Reports
														</label>
													</div>
												</div>
											</div>
										
											<div class="center">
												<div class="row" style="padding:3px 50px">
													<div class="Btn-3Check">
														<input name="rad_emp_group_sub_project" id="group_apex_sub_project" type="radio" checked readonly class="ThreeDCheck Initiate" style="display:none" value="SPOHC"/>
														<label class="ChLable" for="group_apex_sub_project">
															Click Here for <span style="color:#FA0F32">Sub Project & Object Head Consolidated Expenditure</span> Reports
														</label>
													</div>
												</div>
											</div>

											<div class="center">
												<div class="row" style="padding:3px 50px">
													<div class="Btn-3Check">
														<input name="rad_emp_group_apex_fy" id="rad_emp_group_apex_fy" type="radio" checked readonly class="ThreeDCheck Initiate" style="display:none" value="ROHC"/>
														<label class="ChLable" for="rad_emp_group_apex_fy">
															Click Here for <span style="color:#FA0F32">Revenue Object Head Consolidated Expenditure</span> Reports
														</label>
													</div>
												</div>
											</div>

											<div class="center">
												<div class="row" style="padding:3px 50px">
													<div class="Btn-3Check">
														<input name="rad_emp_group_sub_project_fy" id="rad_emp_group_sub_project_fy" type="radio" checked readonly class="ThreeDCheck Initiate" style="display:none" value="AOHE"/>
														<label class="ChLable" for="rad_emp_group_sub_project_fy">
															Click Here for <span style="color:#02C213">Apex Project & Object Head Detail Expendtiture</span> Reports
														</label>
													</div>
												</div>
											</div>

											<div class="center">
												<div class="row" style="padding:3px 50px">
													<div class="Btn-3Check">
														<input name="rad_emp_group_sub_project_claim" id="rad_emp_group_sub_project_claim" type="radio" checked readonly class="ThreeDCheck Initiate" style="display:none" value="SPOHE"/>
														<label class="ChLable" for="rad_emp_group_sub_project_claim">
															Click Here for <span style="color:#B39205">Sub Project & Object Head Detail Expendtiture</span> Reports
														</label>
													</div>
												</div>
											</div>

											<div class="center">
												<div class="row" style="padding:3px 50px">
													<div class="Btn-3Check">
														<input name="rad_emp_group_sub_project_rec" id="rad_emp_group_sub_project_rec" type="radio" checked readonly class="ThreeDCheck Initiate" style="display:none" value="ROHE"/>
														<label class="ChLable" for="rad_emp_group_sub_project_rec">
															Click Here for <span style="color:#0056EB">Revenue & Object Head Detail Expenditure</span> Reports
														</label>
													</div>
												</div>
											</div>
										</div>
										<div class="row smclearrow"></div>  
										<div class="row smclearrow"></div>  
										<div class="row smclearrow"></div>  
										<div class="row smclearrow"></div>
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
	$("body").on("click",".Initiate", function(event){
		var ProjectOption  = $(this).val();
		/*if(ProjectOption == "APEX"){
			window.location.href = "{{ route('budget.project-sanction-entry') }}";
		}
		if(ProjectOption == "SUBPROJECT"){
			window.location.href = "{{ route('budget.sub-project-sanction-entry') }}";
		}
		if(ProjectOption == "APEXFY"){
			let currentYear = new Date().getFullYear();
			let OptionStr = '<div class="row">';
			OptionStr += '<div class="div2 label">Financial Year</div>';
			OptionStr += '<div class="div7 label">';
			OptionStr += '<select class="tboxsmclass" name="cmb_modal_financial_year" id="cmb_modal_financial_year">';
			OptionStr += '<option value=""> --- Select --- </option>';
			for(let i = 0; i < 10; i++){
				let startYear = currentYear + i;
				let endYear = (startYear + 1);
				let fy = startYear + '-' + endYear;
				OptionStr += `<option value="${fy}">${fy}</option>`;
			}
			OptionStr += '</select>';
			BootstrapDialog.show({
				title: 'Financial Year',
				message: OptionStr,
				buttons: [{
					label: 'Next',
					action: function(dialogRef) {
						let FinancialYear = $("#cmb_modal_financial_year").val();
						var form 	= document.createElement("form");
						form.method = "POST"; 
						form.action = "{{ route('budget.project-sanction-entry-fy') }}";
						form.name 	= "sanctionform"; 
						document.body.appendChild(form); 
						var csrfToken 	= document.createElement("input"); 
						csrfToken.type 	= "hidden";
						csrfToken.name 	= "_token"; 
						csrfToken.value = "{{ Session::token() }}"; 
						form.appendChild(csrfToken);
						var FloatingPageIp1 	= document.createElement("input");
						FloatingPageIp1.type 	= "hidden";
						FloatingPageIp1.name 	= "txt_float_financial_year";
						FloatingPageIp1.value 	= FinancialYear; 
						form.appendChild(FloatingPageIp1);
						var FloatingSubmitBtn 	= document.createElement("input");
						FloatingSubmitBtn.type 	= "submit";
						FloatingSubmitBtn.name	= "btn_next";
						FloatingSubmitBtn.id 	= "btn_next";
						form.appendChild(FloatingSubmitBtn);

						$("#btn_next").trigger("click");
						dialogRef.close();
					}
				},{
					label: 'Close',
					action: function(dialogRef) {
						dialogRef.close();
					}
				}],
				onshown: function(dialogRef){
					$("#cmb_modal_financial_year").chosen();
				}
			});
		}*/
		const routes = {
			AOHC: "{{ route('budget-reports.apex-project-object-head-consolidated') }}",
			SPOHC: "{{ route('budget-reports.sub-project-object-head-consolidated') }}",
			ROHC: "{{ route('budget-reports.revenue-object-head-consolidated') }}",
			AOHE: "{{ route('budget.budget-received-entry') }}",
			SPOHE: "{{ route('budget.budget-received-entry') }}",
			ROHE: "{{ route('budget.budget-received-entry') }}"
		};

		if(routes[ProjectOption]) {
			const form = document.createElement("form");
			form.method = "POST";
			form.action = routes[ProjectOption];
			if(ProjectOption == 'ROHC'){
				let currentYear = new Date().getFullYear();
				let startYear = 2026;
				let OptionStr = '<div class="row">';
				OptionStr += '<div class="div2 label">Financial Year</div>';
				OptionStr += '<div class="div7 label">';
				OptionStr += '<select class="tboxsmclass" name="cmb_modal_financial_year" id="cmb_modal_financial_year">';
				OptionStr += '<option value=""> --- Select --- </option>';
				for(let i = startYear; i < currentYear+2; i++){
					let startYear = i;
					let endYear = (i + 1);
					let fy = startYear + '-' + endYear;
					OptionStr += `<option value="${fy}">${fy}</option>`;
				}
				OptionStr += '</select>';
				BootstrapDialog.show({
					title: 'Financial Year',
					message: OptionStr,
					buttons: [{
						label: 'Next',
						action: function(dialogRef) {
							let FinancialYear = $("#cmb_modal_financial_year").val();
							form.innerHTML = `
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="txt_budget_type" value="CRA">
							<input type="hidden" name="txt_float_financial_year" value="${FinancialYear}">
							<input type="hidden" name="btn_next_float" value="1">
							`;
							document.body.appendChild(form);
							form.submit();
							dialogRef.close();
						}
					},{
						label: 'Close',
						action: function(dialogRef) {
							dialogRef.close();
						}
					}],
					onshown: function(dialogRef){
						$("#cmb_modal_financial_year").chosen();
					}
				});
			}else{
				form.innerHTML = `
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="txt_budget_type" value="CRA">
				<input type="hidden" name="btn_next_float" value="1">
				`;
				document.body.appendChild(form);
				form.submit();
			}
			
		}
		
	});
</script>
@endsection
