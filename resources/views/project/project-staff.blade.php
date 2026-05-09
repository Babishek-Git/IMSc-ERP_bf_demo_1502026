@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
$AcademicStaffArray = $data['AcademicStaffData'] ?? [];
$Index =0;
@endphp

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
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Project Staff</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
											<div class="row row-fluid line-control-menu-bar formtitlebar" style="border:none" align="Right">
												<input type="submit" class="step-btn" name="btn_save" id="btn_save" value=" Save " />
											</div>
											<div class="row smclearrow"></div>                                                                                											
											<div class="div2 label">
													Project / Sub-Project Name<span class="reqindi">*</span>
												</div>
												<div class="div10">
													<select name="cmb_pro_name" id="cmb_pro_name" class="tboxsmclass">
														<option value="">---------- Select ----------</option>
														@if(isset($data['ProjectDataView']))
																@foreach($data['ProjectDataView'] as $ProjectDataView)
																	<option value="{{$ProjectDataView->project_id}}" >{{$ProjectDataView->full_heads}}</option>
																@endforeach
															@endif
														
													</select>
												</div>
																	
												<div class="row">     
												<div class="div12">                                                                        											
													<table class="formtable" align="center" id="dataTable" width="100%">
														<thead>
															<tr>
																<th class="colhead" nowrap="nowrap">SNo</th>
																<th class="colhead">IC No</th>
																<th class="colhead">Name</th>
																<th class="colhead">Designation</th>
																<th class="colhead">Project Investigator</th>															
																<th class="colhead">Project co Investigator</th>															
															</tr>
														</thead>
														<tbody>
														@php $Index =0; $Sno   = 1;@endphp
														@if(isset($data['EmployeeData']))
															@foreach($data['EmployeeData'] as $EmployeeData)
																@if(isset($AcademicStaffArray[$EmployeeData->employee_group_type]))
																	<tr>
																		<td align="center">{{$Sno}}</td>
																		<td>{{$EmployeeData->emp_no}}</td>
																		<td>{{$EmployeeData->emp_name_payslip}}</td>
																		<td>{{$EmployeeData->designation_name}}</td>
																		<input type="hidden" class="emp_icno" value="{{$EmployeeData->emp_no}}">
																		<input type="hidden"name='emp_group_id[]' id= 'emp_group_id' value="{{$EmployeeData->group_id}}">
																		<input type="hidden"name='emp_staff_icno[]' id= 'emp_staff_icno' value="{{$EmployeeData->emp_no}}">
																		<td align="center">
																			<input type="radio"name="check_po_inves[]"id="check_po_inves_{{$Index}}"data-index="{{$Index}}"class="pi-radiobox" value="{{$EmployeeData->emp_no}}">
																		</td>
																		<td align="center">
																			<input type="checkbox" name="check_po_co_inves[]" data-index="{{$Index}}" class="cert-checkbox" value="{{$EmployeeData->emp_no}}">
																		</td>
																	</tr>
																	@php $Sno++; @endphp
																@endif
															@php $Index ++;@endphp
															@endforeach
														@endif
														</tbody>
													</table>
												</div>
											</div>
											<div class="row">
												<div class="div12" align="center">
													<!-- <input type="submit" class="step-btn" name="btn_save" id="btn_save" value=" Save " />									 -->
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
	$("#cmb_pro_name").chosen();

	$('#check_all_certified').on('change', function() {
        $('.cert-checkbox').prop('checked', $(this).prop('checked'));
    });
	$('.pi-radiobox').on('change', function () {
		$('.cert-checkbox')
			.prop('disabled', false);
		let rowCheckbox = $(this)
			.closest('tr')
			.find('.cert-checkbox');
		rowCheckbox
			.prop('checked', false)
			.prop('disabled', true);
	});
	$('.cert-checkbox').on('change', function () {
		let rowRadio = $(this)
			.closest('tr')
			.find('.pi-radiobox');
		if ($(this).is(':checked')) {
			rowRadio
				.prop('checked', false)
				.prop('disabled', true);

		} else {
			rowRadio.prop('disabled', false);
		}
	});
	//$("#txt_division").chosen();
	//$("#txt_role_group").chosen();
	$('body').on("change", "#cmb_pro_name", function (e) {
    	var ProjectId = $(this).val();
		$.ajax({
			type: 'POST',
			url: '{{ route("Project.project-staff") }}',
			data: {
				"_token": "{{ csrf_token() }}",
				projid: ProjectId
			},
			success: function (data) {
				var StaffProjectData = data.StaffProjectData ?? [];
				$('.pi-radiobox, .cert-checkbox')
				.prop('checked', false)
					.prop('disabled', false);
				$('#dataTable tbody tr').each(function () {
					let row   = $(this);
					let empNo = row.find('.emp_icno').val();
					let match = StaffProjectData.find(item => item.emp_no == empNo);
					if (match) {
						let index = row.find('.pi-radiobox').data('index');
						let MatchProIncest = match.project_investigator;
						if (MatchProIncest == true  && match.active == '1') {
							row.find('.pi-radiobox').prop('checked', true).trigger('change');
						}
						if (match.project_co_pi == true && match.active == '1') {
							row.find('.cert-checkbox').prop('checked', true).trigger('change');
						}
					}
				});
			}
		});
	});
	var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
            var PIErr         = 0;
            var PcoErr         = 0;
			var ProjectName   = $("#cmb_pro_name").val();
			var DesigName  	  = $("#txt_desig_name").val();
			$('.cert-checkbox').each(function() {
                if ($(this).is(':checked')) {
                    PcoErr++;
                }
            });
			$('.pi-radiobox').each(function() {
                if ($(this).is(':checked')) {
                    PIErr++;
                }
            });
			if(ProjectName == ""){
				BootstrapDialog.alert("Select the Project / Sub-Project Name..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(PIErr == 0 && PcoErr == 0){
				BootstrapDialog.alert("Select at least one Project Investigator or Project Co-Investigator..!!");
				event.preventDefault();
				event.returnValue = false;	
			// }else if(PIErr == "0"){
			// 	BootstrapDialog.alert("Check one Project Investigator..!!");
			// 	event.preventDefault();
			// 	event.returnValue = false;
			// }else if(PcoErr == "0"){
			// 	BootstrapDialog.alert("Check Project co Investigator..!!");
			// 	event.preventDefault();
			// 	event.returnValue = false;
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure want to save Project Staff Details..?',
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
