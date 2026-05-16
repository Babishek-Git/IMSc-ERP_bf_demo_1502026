@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php

 if(isset($data['EditDesignationData'])){
	
	$EditDesignationData = $data['EditDesignationData'];
	$ShortName = collect($EditDesignationData)->pluck('designation_short_name')->first();
	$DesgName = collect($EditDesignationData)->pluck('designation_name')->first();
	$DesgId = collect($EditDesignationData)->pluck('designation_id')->first();
	$GroupId = collect($EditDesignationData)->pluck('emp_group_id')->first();
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
							<div class="row">
								<div class="div3">&nbsp;</div>
								<div class="div6">
								<div class="form-box">	
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Designation Master</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">

											<div class="div3 label">
													Employee Group <span class="reqindi">*</span>
												</div>
												<div class="div9">
													<select name="cmb_emp_grp" id="cmb_emp_grp" class="tboxsmclass">
														<option value="">----------- Select -- --------</option>
														@if(isset($data['GroupData']))
																@foreach($data['GroupData'] as $EmpgroupData)
																	@php
																	$selstr= "";
																	if(isset($GroupId)){
																		if($GroupId == $EmpgroupData->emp_group_id)
																		{
																			$selstr='selected="selected"';
																		}
																	}
																	@endphp
																	<option value="{{$EmpgroupData->emp_group_id}}" {{$selstr}}>{{$EmpgroupData->emp_group_name}}</option>
																@endforeach
															@endif
																								
													</select>
												</div>
											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Designation Name <span class="reqindi">*</span></div>
											<div class="div9"><input type="text" name="txt_desig_name" id="txt_desig_name" class="tboxsmclass" value="@if(isset($DesgName)){{$DesgName}}@endif"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Designation</br>Short Name <span class="reqindi">*</span></div>
											<div class="div9"><input type="text" name="txt_desig_shortname" id="txt_desig_shortname" class="tboxsmclass" value="@if(isset($ShortName)){{$ShortName}}@endif"></div>
											<div class="row smclearrow"></div>
																					
											@php $AddUrl = 'DesignationMaster.ViewDesignationMaster'; @endphp										
											<div class="row">
												<div class="div12" align="center">
													<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" Back " onClick="window.location='{{route($AddUrl)}}'" />
													<input type="submit" class="step-btn" name="btn_save" id="btn_save" value=" Save " />					
													<input type="hidden" name="hid_desg_id" id="csrf-hid_desg_id" value="@if(isset($DesgId)){{$DesgId}}@endif" />
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
	//$("#txt_division").chosen();
	//$("#txt_role_group").chosen();
	$('#dataTable').DataTable({
		responsive: true,
		paging: true, 
	});
	var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var DesigShortName   = $("#txt_desig_shortname").val();
			var DesigName  	= $("#txt_desig_name").val();
			

			if(DesigShortName == ""){
				BootstrapDialog.alert("Designation short Name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(DesigName == ""){
				BootstrapDialog.alert("Designation Name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure want to save Designation ?',
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
