@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<form action="{{ route('admin.CreateDPR') }}" method="post" enctype="multipart/form-data" name="form">
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1" style="overflow:auto">
					<div class="container">
						<div class="row ">
							<div class="div2">&nbsp;</div>
							<div class="div8 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">DPR</div></div></div>
								<div class="divrowbox innerdiv pt-2">
									<div class="row smclearrow"></div>
									<div class="row">
										<div class="div3 label">
											DPR No. <span class="reqindi">*</span>
										</div>
										<div class="div7">
											<input type="text" name='txt_dpr_no' id='txt_dpr_no' class="tboxclass" maxlength="500" value="@if(isset($data['DPRData'])){{ $data['DPRData']->dpr_no }}@endif">
											<input type="hidden" name = "hid_dprid" id = "hid_dprid" value = "@if(isset($data['DPRData'])){{ encrypt($data['DPRData']->dprid) }}@endif">
										</div>
									</div>
									<div class="row">
										<div class="div3 label">
											DPR Tittle <span class="reqindi">*</span>
										</div>
										<div class="div7">
										<input type="text" name='txt_dpr_tittle' id='txt_dpr_tittle' class="tboxclass" maxlength="500" value="@if(isset($data['DPRData'])){{ $data['DPRData']->dpr_title }}@endif">
										</div>
									</div>
									<div class="row smclearrow"></div>
									<div class="row">
										<div class="div3 label">
											Financial Sanction No. <span class="reqindi">*</span>
										</div>
										<div class="div7">
										<input type="text" name='txt_dpr_sanct_no' id='txt_dpr_sanct_no' class="tboxclass" maxlength="500" value="@if(isset($data['DPRData'])){{ $data['DPRData']->dpr_sanct_no }}@endif">
										</div>
									</div>
									<div class="row smclearrow"></div>
									<div class="row">
										<div class="div3 label">
											Financial Sanction Date <span class="reqindi">*</span>
										</div>
										<div class="div7">
											<input type="text" name='txt_dpr_sanct_dt' placeholder="DD/MM/YYYY" id='txt_dpr_sanct_dt' readonly=""  class="tboxsmclass datepicker" value="@if(isset($data['DPRData'])){{ Helper::DisplayDateFormat($data['DPRData']->dpr_sanct_dt) }}@endif">
										</div>
									</div>
									<div class="row">
										<div class="div3 label">
											Financial Sanction Amount <span class="reqindi">*</span>
										</div>
										<div class="div7">
											<input type="text" name='txt_dpr_sanct_amt' id='txt_dpr_sanct_amt' class="tboxsmclass" value="@if(isset($data['DPRData'])){{ $data['DPRData']->dpr_sanct_amt }}@endif">
										</div>
									</div>
									<div class="row smclearrow"></div>	
									<div class="row smclearrow"></div>	
									<div class="row">
										<div class="div3 label">
											Apex Project Coordinator
										</div>
									</div>
									<div class="row">
										<div class="div3 label">
											Employee No <span class="reqindi">*</span>
										</div>
										<div class="div7">
											<input type="text" name='txt_empno' id='txt_empno' class="tboxsmclass numberonly"  value="@if(isset($data['DPRData'])){{ $data['DPRData']->emp_no }}@endif">
										</div>
									</div>
									<div class="row">
										<div class="div3 label">
											Name
										</div>
										<div class="div7">
											<input type="text" name='txt_emp_name' id='txt_emp_name' maxlength="100" class="tboxsmclass disable" readonly="" value="@if(isset($data['DPRData'])){{ $data['DPRData']->emp_name }}@endif">
										</div>
									</div>
									<div class="row">
										<div class="div3 label">
											Desigination
										</div>
										<div class="div7">
											<input type="text" name='txt_desigination' id='txt_desigination' maxlength="100" class="tboxsmclass disable" readonly="" value="@if(isset($data['DPRData'])){{ $data['DPRData']->emp_desigination }}@endif">
										</div>
									</div>
								</div>
								<div class="row smclearrow"></div>												
								@php $AddUrl = 'admin.ViewDPR'; @endphp
								<div class="row">
									<div class="div12" align="center">
										<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" View " onClick="window.location='{{route($AddUrl)}}'" />
										<input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />									
										<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
									</div>		
								</div>
								<div class="div12"></div>
							</div>
							<div class="div2">&nbsp;</div>
						</div>                          
					</div>	
				</blockquote>
			</div>
		</div>					
	</div>
</form>

<script>
$(document).ready(function(){
	$("body").on("click","#btn_save", function(event){
		var DPRNumber = $('#txt_dpr_no').val();
		var DPRTittle = $('#txt_dpr_tittle').val();
		var DPRSanctNo = $('#txt_dpr_sanct_no').val();
		var DPRSanctDt = $('#txt_dpr_sanct_dt').val();
		var DPRSanctAmt = $('#txt_dpr_sanct_amt').val();
		var EmpNo 	= $('#txt_empno').val();

		if(DPRNumber == ""){
			BootstrapDialog.alert("Please Enter the DPR Number!");
			event.preventDefault();
			event.returnValue = false;
		}
		else if(DPRTittle == "") {
			BootstrapDialog.alert("Please Enter the DPR Tittle!");
			event.preventDefault();
			event.returnValue = false;
		}
		else if(DPRSanctNo == "") {
			BootstrapDialog.alert("Please Enter the Financial Sanction Number!");
			event.preventDefault();
			event.returnValue = false;
		}
		else if(DPRSanctDt == "") {
			BootstrapDialog.alert("Please Enter the Financial Sanction Date!");
			event.preventDefault();
			event.returnValue = false;
		}
		else if(DPRSanctAmt == "") {
			BootstrapDialog.alert("Please Enter the Financial Sanction Amount!");
			event.preventDefault();
			event.returnValue = false;
		}
		else if(EmpNo == "") {
			BootstrapDialog.alert("Please Enter the Employee Number Sanction!");
			event.preventDefault();
			event.returnValue = false;
		}
	}); 
	$('body').on('keypress', "#txt_dpr_sanct_amt",function(evt){
		var result = $(this).val();	
		var charCode = (evt.which) ? evt.which : event.keyCode;
		var dot1 	 = result.indexOf('.');
		var dot2 	 = result.lastIndexOf('.'); 
		var val 	 = result;
		var SplitVal = val.split(".");
		var len 	 = SplitVal.length;
		var Fraction = SplitVal[1];
		if(Fraction){
			var fractLen = Fraction.length;
		}else{
			var fractLen = 0;
		}
		if(charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)){
			return false;
		}else if (charCode == 46 && (dot1 == dot2) && dot1 != -1 && dot2 != -1){
			return false;
		}else if(isNaN(SplitVal[0])){
			//Recovery = 'x';
			return false;
		}else if(isNaN(SplitVal[1]) && Number(fractLen) > 0){
			//Recovery = 'x';
			return false;
		}else if (fractLen > 1){
			return false;
		}else{
			return true;
		}
	});
	$('body').on("change", ".tboxclass" ,function(event){
		var DPRNo     = $('#txt_dpr_no').val();
		var HidId    = $('#hid_dprid').val();
		$.ajax({
			type: 'POST',
			url: "{{ route('ajax.DuplicateDPR') }}",
			data: {'_token': '{{ csrf_token() }}', 'DPRNo': DPRNo},
			success: function(data){ 
				if(HidId == null){
					if(data>0) { 
                		BootstrapDialog.alert("Failed: DPR Number Already Exists!");
					}
				}
			}
		});
	});
});	

$("body").on("change", "#txt_empno", function (event) {
	var EmployeeNo = $("#txt_empno").val();
	$.ajax({
		type: 'POST',
		url: "{{ route('ajax.EmployeeDetails') }}",
		data: {'_token': '{{ csrf_token() }}', 'EmployeeNo': EmployeeNo },
		success: function (data) {
			if (data.employee.length > 0) {
				const employeeData = data.employee[0];
				$("#txt_emp_name").val(employeeData.emp_known_as).addClass("disable").attr("readonly", true);
                $("#txt_desigination").val(employeeData.designation_name).addClass("disable").attr("readonly", true);
			} else {
				$("#txt_emp_name").val('').removeClass("disable").removeAttr("readonly");
                $("#txt_desigination").val('').removeClass("disable").removeAttr("readonly");
			}
		},
		error: function () {
			BootstrapDialog.alert("An error occurred while fetching Employee Details!");
		}
	});
});

	$('body').on('keypress', ".numberonly",function(evt){
		var result = $(this).val();	
		var charCode = (evt.which) ? evt.which : event.keyCode;
		var dot1 	 = result.indexOf('.');
		var dot2 	 = result.lastIndexOf('.'); 
		var val 	 = result;
		var SplitVal = val.split(".");
		var len 	 = SplitVal.length;
		var Fraction = SplitVal[1];
		if(Fraction){
			var fractLen = Fraction.length;
		}else{
			var fractLen = 0;
		}
		if(charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)){
			return false;
		}else if (charCode == 46 && (dot1 == dot2) && dot1 != -1 && dot2 != -1){
			return false;
		}else if(isNaN(SplitVal[0])){
			//Recovery = 'x';
			return false;
		}else if(isNaN(SplitVal[1]) && Number(fractLen) > 0){
			//Recovery = 'x';
			return false;
		}else if (fractLen > 1){
			return false;
		}else{
			return true;
		}
	});

</script>
@endsection

