@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php
 if(isset($data['EditProjectData'])){
	$EditProjectData = $data['EditProjectData'];
	$ProjectName     = collect($EditProjectData)->pluck('project_name')->first();
	$ProjectDuration = collect($EditProjectData)->pluck('project_duration')->first();
	$ProjectMode 	 = collect($EditProjectData)->pluck('project_duration_mode')->first();
	$ProjectStart    = collect($EditProjectData)->pluck('project_start_at')->first();
	$ProjectEnd    	 = collect($EditProjectData)->pluck('project_end_at')->first();
	$ProjectId    	 = collect($EditProjectData)->pluck('project_id')->first();
	$ProjectType   	 = collect($EditProjectData)->pluck('project_type')->first();
}
@endphp

<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="" method="post" enctype="multipart/form-data" name="form">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row plr">
								<!-- <div class="div2">&nbsp;</div> -->
								<div class="div5">
								<div class="form-box">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Project Master</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Project Type <span class="reqindi">*</span></div>
											<div class="div9">
												<input type="radio" name="rad_project_type" id="rad_project_type_int" value="INT" {{ old('rad_project_type', $ProjectType ?? '') == 'INT' ? 'checked' : '' }}> <span class="label">Internal (IMSc) &emsp;</span>
												<input type="radio" name="rad_project_type" id="rad_project_type_ext" value="EXT" {{ old('rad_project_type', $ProjectType ?? '') == 'EXT' ? 'checked' : '' }}> <span class="label">External</span>
											</div>
											<div class="row smclearrow"></div>
											<input type="hidden" name="rad_internal_type" id="rad_internal_type" value="">
											<input type="hidden" name="ProjectTo" id="ProjectTo" value="">
											<div id="internal_options" style="display:none;">
											<div class="div3 label"> Project To</div>
											<div class="div9">
												 <!-- <input type="radio" name="rad_internal_type" value="DAE" {{ old('rad_internal_type', $ProjectTo ?? '') == 'DAE' ? 'checked' : '' }}>
												<span class="label"> DAE &emsp; </span>  -->

												<!-- <input type="radio" name="rad_internal_type" id="rad_internal_type" value="APEX" {{ old('rad_internal_type', $ProjectTo ?? '') == 'APEX' ? 'checked' : '' }}>
												<span class="label"> APEX</span> -->
											</div>
										</div>
											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Project Name <span class="reqindi">*</span></div>
											<div class="div9"><input type="text" name="txt_pro_name" id="txt_pro_name" class="tboxsmclass" value="@if(isset($ProjectName)){{$ProjectName}}@endif"></div>
											<div class="row smclearrow"></div>
											
											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Project Duration <span class="reqindi">*</span></div>
											<div class="div3"><input type="text" name="txt_pro_dur" id="txt_pro_dur" class="tboxsmclass" value="@if(isset($ProjectDuration)){{$ProjectDuration}}@endif"></div> 
																				
									        <div class= "div6 padl">
												<select  name="cmb_mode" id="cmb_mode" class="tboxsmclass alphanumeric">	
													<option value="">---- Select ----</option>
													<option value="MONTH"{{isset($ProjectMode) && $ProjectMode == 'MONTH' ? 'selected' : '' }}>MONTH</option>
													<option value="YEAR" {{isset($ProjectMode) && $ProjectMode == 'YEAR' ? 'selected' : '' }}>YEAR</option>
													<option value="DAYS" {{isset($ProjectMode) && $ProjectMode == 'DAYS' ? 'selected' : '' }}>DAYS</option>
												</select>
											</div>
											<div class="row smclearrow"></div>
											<div class="div3 label">Project Start Date <span class="reqindi">*</span></div>
											<div class="div3"><input type="text" name="pro_start_date" id="pro_start_date" class="tboxsmclass datepicker" value="@if(isset($ProjectStart)){{Helper::DisplayDateFormat($ProjectStart)}}@endif"></div>
											<div class="row smclearrow"></div>
											<div class="div3 label padl">Project End Date <span class="reqindi">*</span></div>
											<div class="div3"><input type="text" name="pro_end_date" id="pro_end_date" class="tboxsmclass" value="@if(isset($ProjectEnd)){{Helper::DisplayDateFormat($ProjectEnd)}}@endif" readonly></div>
											
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											@php $AddUrl = 'roles.ViewRoleMaster'; @endphp										
											<div class="row">
												<div class="div12" align="center">
													<button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Save">Save</button>
													<input type="hidden" name="hid_pro_id" id="csrf-hid_pro_id" value="@if(isset($ProjectId)){{$ProjectId}}@endif" />
													<input type="hidden" name="hid_del_id" id="hid_del_id" value="" />
													<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
												
												</div>		
											</div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
										</div>
									</div>										
								</div>
								<!-- ================ -->
								<!-- ================ -->
								</div>
								<!-- ============== -->
								<div class="div7">
									<div class="table-box">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row table-divhead" align="center">Project Master List</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<table class="formtable" width="99%" align="center" id="dataTable">
													<thead>
														<tr class="">
															<th style="text-align:center">SNo.</th>
															<th style="text-align:center">Project Name</th>
															<th style="text-align:center">Project Type</th>
															<th style="text-align:center">Project To</th>
															<th style="text-align:center">Project Duration</th>
															<th style="text-align:center">Project Start Date</th>
															<th style="text-align:center">Project End Date</th>
															<th style="text-align:center">Action</th>
														</tr>
													</thead>
													<tbody>
														@if(isset($data['ProjectDataView']))
															@foreach($data['ProjectDataView'] as $ProjectDataView)
																<tr>
																	<td align="center">{{ $loop->iteration }} </td>
																	<td align="left">{{ $ProjectDataView->project_name}}</td>
																	<td align="left">{{ $ProjectDataView->project_for}}</td>
																	<td align="center">
																		{{ $ProjectDataView->project_type_label }}
																	</td>
																	<td align="left">{{ $ProjectDataView->project_duration}} {{ $ProjectDataView->project_duration_mode}}</td>
																	<td align="left">{{Helper::DisplayDateFormat( $ProjectDataView->project_start_at)}}</td>
																	<td align="left">{{Helper::DisplayDateFormat( $ProjectDataView->project_end_at)}}</td>
																	<td>
																		<button type="button" name="btn_edit" class="btn btn-default tuploadbtn" id="btn_edit" value="Edit" onclick="window.location='{{ route('Project.project-master',['id'=>encrypt($ProjectDataView->project_id), 'action'=>encrypt('EDIT')]) }}'"> <i class='fa fa-edit'></i> Edit </button>
																	</td>
																	<!-- <td>
																		<button type="button" name="btn_delete" class="btn btn-default tuploadbtn" id="btn_delete" value="Delete" onclick="window.location='{{ route('Project.project-master',['id'=>encrypt($ProjectDataView->project_id), 'action'=>encrypt('DEL')]) }}'"> <i class='fa fa-trash'></i> Delete</button>
																	</td> -->
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
	//$("#txt_division").chosen();
	//$("#txt_role_group").chosen();
	$('#dataTable').DataTable({
		responsive: true,
		paging: true, 
	});
	$(document).ready(function(){

    $('input[name="rad_project_type"]').click(function(){
        var projectType = $(this).val();
        if(projectType == 'INT'){
            $('#rad_internal_type').val('APEX');
        }else{
            $('#rad_internal_type').val('');
        }
    });
	$("#txt_pro_dur, #cmb_mode, #pro_start_date").on("change keyup", function(){

    var duration = $("#txt_pro_dur").val();
    var mode = $("#cmb_mode").val();
    var startDate = $("#pro_start_date").val();

    if(duration != "" && mode != "" && startDate != ""){

        // convert dd/mm/yyyy → yyyy-mm-dd
        var parts = startDate.split("/");
        var formattedDate = parts[2] + "-" + parts[1] + "-" + parts[0];

        var date = new Date(formattedDate);

        if(mode == "DAYS"){
            date.setDate(date.getDate() + parseInt(duration));
        }
        else if(mode == "MONTH"){
            date.setMonth(date.getMonth() + parseInt(duration));
        }
        else if(mode == "YEAR"){
            date.setFullYear(date.getFullYear() + parseInt(duration));
        }

        var day = ("0" + date.getDate()).slice(-2);
        var month = ("0" + (date.getMonth()+1)).slice(-2);
        var year = date.getFullYear();

        var endDate = day + "/" + month + "/" + year;

        $("#pro_end_date").val(endDate);
		$("#pro_end_date").prop('readonly', true);
    }

});
});
	var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var ProjectType   	= $("input[name='rad_project_type']:checked").val();
			var ProjectName   	= $("#txt_pro_name").val();
			var ProjectDuration = $("#txt_pro_dur").val();
			var DurationMode   	= $("#cmb_mode").val();
			var StartDate   	= $("#pro_start_date").val();
			var EndDate   		= $("#pro_end_date").val();
			// var ProjectTo       = $('input[name="rad_internal_type"]:checked').val();

			if(!ProjectType){
				BootstrapDialog.alert("Please select project type");
				event.preventDefault();
				event.returnValue = false;
			}else if(ProjectName == ""){
				BootstrapDialog.alert("Project name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(ProjectDuration == ""){
				BootstrapDialog.alert("Project duration should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(DurationMode == ""){
				BootstrapDialog.alert("Please select project duration mode..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(StartDate == ""){
				BootstrapDialog.alert("Project start date should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(EndDate == ""){
				BootstrapDialog.alert("Project end date should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure want to Project Master ?',
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
