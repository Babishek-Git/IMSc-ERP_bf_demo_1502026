@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php
 if(isset($data['BankBranchData'])){
	
	$BankBranchData = $data['BankBranchData'];
	$BankName = collect($BankBranchData)->pluck('bank_id')->first();
	$IFFCCode = collect($BankBranchData)->pluck('ifsc_code')->first();
	$BranchAddr = collect($BankBranchData)->pluck('branch_addr1')->first();
	$StateId = collect($BankBranchData)->pluck('state_id')->first();
	$CityName = collect($BankBranchData)->pluck('branch_city')->first();
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
								<div class="div5 mbtable">
									<!-- <div class="form-box"> -->
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Visitors ID Card</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
												<div class="div4 label">Vistor Category<span class="reqindi"> *</span></div>
													<div class="div8">
														<select name="cmb_visit_category" id="cmb_visit_category" class="tboxsmclass ChosenInput">
														<option value="">-------- Select------</option>
															@if(isset($data['ProjectData']))
																	@foreach($data['ProjectData'] as $ProjectData)
																		<option value="{{$ProjectData->project_id}}">{{$ProjectData->project_name}}</option>
																	@endforeach
																@endif
														</select>
												</div>
												<div class="div4 label">Sub Project Name<span class="reqindi"> *</span></div>
													<div class="div8">
														<select name="cmb_subproject_name" id="cmb_subproject_name" class="tboxsmclass ChosenInput">
															<option value="">-------- Select------</option>
														</select>
												</div>
												<div class="div4 label">Name <span class="reqindi">*</span></div>											
												<div class="div8"><input type="text" name="txt_name" id="txt_ex_san_no"  class="tboxsmclass" value=""></div>																																																					
												<div class="div4 label">Date of Birth<span class="reqindi">*</span> </div>											
												<div class="div8"><input type="text" name="txt_dob" id="txt_dob" class="tboxsmclass alphanumeric" value="" ></div>
												<div class="row smclearrow"></div> 
												<div class="div4 label">Email Id<span class="reqindi">*</span></div>											
												<div class="div8"><input type="text" name="txt_email_id" id="txt_email_id"  class="tboxsmclass datepicker" value=""  ></div>
												<div class="row smclearrow"></div> 
												<div class="div4 label">Mobile No.<span class="reqindi">*</span></div>											
												<div class="div8"><input type="text" name="txt_mob_no" id="txt_mob_no"  class="tboxsmclass datepicker" value=""  ></div>
												<div class="row smclearrow"></div> 
												<div class="div2 label">Visting From Date<span class="reqindi">*</span></div>											
												<div class="div2"><input type="text" name="txt_from_date" id="txt_from_date"  class="tboxsmclass datepicker" value=""  ></div>
												<div class="div2 label">Visting To Date<span class="reqindi">*</span></div>											
												<div class="div2"><input type="text" name="txt_to_date" id="txt_to_date"  class="tboxsmclass datepicker" value=""  ></div>
												<div class="row smclearrow"></div> 
												<div class="div4 label label">
													Sanction Type <span class="reqindi">*</span>
												</div>
												 <div class="div3 no-margin">
													<div class="inputGroup paddlr2">
														<input id="rad_recurring" name="rad_sanction_type" type="radio" value="R"/>
														<label for="rad_recurring" style="padding:3px 0px; width:100%"> &nbsp;Recurring</label>
													</div>
												</div>
												<div class="div3 no-margin">
													<div class="inputGroup paddlr2">
														<input id="rad_non_recurring" name="rad_sanction_type" type="radio" value="N"/>
														<label for="rad_non_recurring" style="padding:3px 0px; width:100%"> &nbsp;Non Recurring</label>
													</div>
												</div> 
												
												<div class="row smclearrow"></div> 
												@php $AddUrl = 'bank.ViewBankBranchList'; @endphp
												<div class="row">
													<div class="div12" align="center">
													<!-- <input type="button" class="backbutton" name="btn_view" id="btn_view" value=" View " onClick="window.location='{{route($AddUrl)}}'" /> -->
													<button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Save">Save</button>
													<input type="hidden" name="hid_bankbranch_id" id="csrf-hid_bankbranch_id" value="@if(isset($BankBranchId)){{$BankBranchId}}@endif" />
													<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
													</div>		
												</div>
												<div class="row smclearrow"></div>  
											</div>
										</div>
									</div>										
								<!-- </div> -->
								
			</div>
		</div>
	</form>
</body>


<script>
	$('#dataTable').DataTable({
		responsive: true,
		paging: true, 
	});
	$(".ChosenInput").chosen();
	$(document).ready(function() {
		$("#state_name").chosen();
		$("#bank_name").chosen();

	});


$("body").on("click","#btn_save", function(event){
	var BankName = $('#bank_name').val();
	var IFSCCode = $('#ifsc_code').val();
	var BranchAddr = $('#branch_Address').val();
	var StateName = $('#state_name').val();
	var CityName = $('#city_name').val();
	if(BankName == ""){
		BootstrapDialog.alert("Please select the Bank  Name!");
		event.preventDefault();
		event.returnValue = false;
	}else if(IFSCCode == ""){
		BootstrapDialog.alert("Please Enter the IFSC Code!");
		event.preventDefault();
		event.returnValue = false;
	}else if(BranchAddr == ""){
		BootstrapDialog.alert("Please Enter the Bank  Address!");
		event.preventDefault();
		event.returnValue = false;
	}else if(StateName == ""){
		BootstrapDialog.alert("Please select the State Name!");
		event.preventDefault();
		event.returnValue = false;
	}else if(CityName == ""){
		BootstrapDialog.alert("Please enter the City Name!");
		event.preventDefault();
		event.returnValue = false;
	}
});

$('body').on('keypress', ".textonly", function(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (!(charCode >= 65 && charCode <= 90) &&   
        !(charCode >= 97 && charCode <= 122) && 
        charCode !== 32) {                     
        return false;
    } else {
        return true;
    }
});
$('body').on('keypress', ".alphanumeric", function(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (!((charCode >= 48 && charCode <= 57) ||   
          (charCode >= 65 && charCode <= 90) ||   
          (charCode >= 97 && charCode <= 122))) {  
        return false;
    } else {
        return true;
    }
});

$("body").on("change","#cmb_project_name", function(event){
	//alert();
	var ProjectId = $(this).val();
	$("#cmb_subproject_name").chosen('destroy');
	$('#cmb_subproject_name').children('option:not(:first)').remove();
	if ((ProjectId != '') && (ProjectId != null)) {
        $.ajax({
            type: 'POST',
            url: "{{ route('Project.GetProjectData') }}",
            data: { "_token": "{{ csrf_token() }}", 'ProjectId': ProjectId },
            // dataType: 'json',
            success: function (data) {
                if (data != '') {
                    let ProjectData = data['ProjectData']; 
                    if ((ProjectData != '') && (ProjectData != null)) { 
                        //$("#section_name").empty();
                        $.each(ProjectData, function (index, element) { console.log(element.subproject_name);
						 	$("#cmb_subproject_name").append('<option value="'+element.subproject_id+'">'+element.subproject_name+'</option>');
                        });
                    }else{
						BootstrapDialog.alert("Please Enter the Correct Project Name");
						$("#cmb_project_name").val(''); 
					}
                }
				$("#cmb_subproject_name").chosen();
            }
        });
    }

});
	


</script>

@endsection