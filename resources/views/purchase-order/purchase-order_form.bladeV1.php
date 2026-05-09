@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
<style>
	
</style>

@php
 if(isset($data['Empdata'])){
	$Empdata  = $data['Empdata'];
	$ICNo     = collect($Empdata)->pluck('emp_no')->first();
	$EmpName  = collect($Empdata)->pluck('emp_first_name')->first();
	$EmpDOB   = collect($Empdata)->pluck('emp_dob')->first();
	$EmpDOJ    = collect($Empdata)->pluck('emp_doj')->first();
	$EmpRET    = collect($Empdata)->pluck('emp_retirement_dt')->first();
	$Desig    = collect($Empdata)->pluck('designation_name')->first();
	$GroupId   = collect($Empdata)->pluck('group')->first();
	$DivId   = collect($Empdata)->pluck('division_short_name')->first();
	$SecId   = collect($Empdata)->pluck('section')->first();
}
if(isset($data['EditIndentData'])){
	$EditIndentData     = $data['EditIndentData'];
	$IndentNo           = collect($EditIndentData)->pluck('indent_no')->first();
	$IndentDescription  = collect($EditIndentData)->pluck('indent_descripton')->first();
	$CreatedBy          = collect($EditIndentData)->pluck('created_by')->first();
	$IndentDate         = collect($EditIndentData)->pluck('indent_date')->first();
	$IndentId           = collect($EditIndentData)->pluck('indent_id')->first();
}
if(isset($data['ShowIndentEditDetails'])){
	$EditIndentDetailsData     = $data['ShowIndentEditDetails'];
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
								<div class="div2">&nbsp;</div>
								<div class="div8 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Purchase Order Form</div></div></div>
								<div class="row innerdiv">
									<div class="row"> 
										
											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">
													Indent No./ Date<span class="reqindi">*</span>
											</div>
											<div class="div9">
												<select name="cmb_indent_no_date" id="cmb_indent_no_date" class="tboxsmclass ChosenInput">
													<option value="">---------- Select ----------</option>
													@if(isset($data['Indentdata']))
														@foreach($data['Indentdata'] as $Indentdata)
															<option value="{{$Indentdata->indent_id}}">No. {{$Indentdata->indent_no}} , Date:{{Helper::DisplayDateFormat($Indentdata->indent_date)}} </option>
														@endforeach
													@endif
												</select>
											</div>
											<div class="div3 label">Indent Title<span class="reqindi">*</span></div>
											<div class="div9"><input type="text" name="txt_indent_title" id="txt_indent_title" class="tboxsmclass" value="" readonly></div>
											<div class="div3 label">Purchase Order No.<span class="reqindi">*</span></div>
											<div class="div9"><input type="text" name="txt_pur_order_no" id="txt_pur_order_no" class="tboxsmclass" value=""></div>
											<div class="div3 label">Purchase Order Name<span class="reqindi">*</span></div>
											<div class="div9"><input type="text" name="txt_pur_order_name" id="txt_pur_order_name" class="tboxsmclass" value=""></div>
											<div class="div3 label">Purchase Order Date<span class="reqindi">*</span></div>
											<div class="div9"><input type="text" name="txt_pur_order_date" id="txt_pur_order_date" class="tboxsmclass datepicker" value=""></div>
											<div class="div3 label">Purchase Order Amount<span class="reqindi">*</span></div>
											<div class="div9"><input type="text" name="txt_pur_amt" id="txt_pur_amt" class="tboxsmclass passorderamt" value=""></div>
											<div class="div3 label pocmlable ">PCOM1/PCOM2<span class="reqindi">*</span></div>
											<div class="div9  label pocmlable">
												<input type="radio" name="rad_pcom" id="pcom_1" value="YES">&emsp;PCOM1 &emsp;
    											<input type="radio" name="rad_pcom" id="pcom_2" value="NO"> &emsp;PCOM2
											</div>
											<div class="div3 label tenderlabel">Tender No.<span class="reqindi">*</span></div>
											<div class="div9 tenderlabel"><input type="text" name="txt_tender_no" id="txt_tender_no" class="tboxsmclass" value=""></div>
											<div class="div3 label quotationlable">Quotation Date<span class="reqindi">*</span></div>
											<div class="div9 quotationlable"><input type="text" name="txt_quotation_date" id="txt_quotation_date" class="tboxsmclass datepicker" value=""></div>
											<div class="div3 label">
												Vendor Name<span class="reqindi">*</span>
											</div>
											<div class="div9">
												<select name="cmb_vendor_name" id="cmb_vendor_name" class="tboxsmclass ChosenInput">
													<option value="">-------------- Select -------------</option>
													@if(isset($data['Contractordata']))
														@foreach($data['Contractordata'] as $Contractordata)
															<option value="{{$Contractordata->contid}}"> {{$Contractordata->name_contractor }}</option>
														@endforeach
													@endif
												</select>
											</div>
											<div class="div3 label">Work Duration <span class="reqindi">*</span></div>
											<div class="div3"><input type="text" name="txt_work_dur" id="txt_work_dur" class="tboxsmclass" value=""></div> 
									        <div class= "div6 padl">
												<select  name="cmb_mode" id="cmb_mode" class="tboxsmclass alphanumeric ChosenInput">	
													<option value="">------ Select ------</option>
													<option value="MONTH"{{isset($ProjectMode) && $ProjectMode == 'MONTH' ? 'selected' : '' }}>MONTH</option>
													<option value="YEAR" {{isset($ProjectMode) && $ProjectMode == 'YEAR' ? 'selected' : '' }}>YEAR</option>
													<option value="DAYS" {{isset($ProjectMode) && $ProjectMode == 'DAYS' ? 'selected' : '' }}>DAYS</option>
												</select>
											</div>
											<div class="div3 label">Work Starting Date<span class="reqindi">*</span></div>
											<div class="div9"><input type="text" name="txt_start_date" id="txt_start_date" class="tboxsmclass datepicker" value=""></div>
											<div class="div3 label">Work Completion Date<span class="reqindi">*</span></div>
											<div class="div9"><input type="text" name="txt_end_date" id="txt_start_date" class="tboxsmclass datepicker" value=""></div>
											<div class="row smclearrow"></div>   
											<div class="div3 label">whether PG collected <span class="reqindi">*</span></div>
											<div class="div9">
												<input type="radio" name="rad_pg_collected" id="rad_pg_collected_yes" value="YES" {{ old('rad_project_type', $ProjectType ?? '') == 'INT' ? 'checked' : '' }}> <span class="label">Yes &emsp;</span>
												<input type="radio" name="rad_pg_collected" id="rad_pg_collected_no" value="NO" {{ old('rad_project_type', $ProjectType ?? '') == 'EXT' ? 'checked' : '' }}> <span class="label">No</span>
											</div>
											<div id="internal_options" style="display:none; "> 
												<div class="div3 label"> Mode Of Issue <span class="reqindi">*</span></div>
												<div class="div9">
													<input type="radio" name="rad_internal_type" value="DAE" {{ old('rad_internal_type', $ProjectTo ?? '') == 'DAE' ? 'checked' : '' }}>
													<span class="label"> Demand Draft &emsp; </span>
													<input type="radio" name="rad_internal_type" value="APEX" {{ old('rad_internal_type', $ProjectTo ?? '') == 'APEX' ? 'checked' : '' }}>
													<span class="label"> Bank Guarantee</span>
												</div>
												<div class="row smclearrow"></div>
												<div class="div3 label">Expiry Date<span class="reqindi">*</span></div>
												<div class="div2"><input type="text" name="txt_start_date" id="txt_start_date"  class="tboxsmclass datepicker" value=""></div>
											</div>
											<div class="row smclearrow"></div>   
											<div class="div3 label">
												Material Certify By<span class="reqindi">*</span>
											</div>
											<div class="div9">
												<select name="cmb_mat_certify_sec" id="cmb_mat_certify_sec" class="tboxsmclass ChosenInput">
													<option value="">-------------- Select -------------</option>
													@if(isset($data['MaterialCertifySecData']))
														@foreach($data['MaterialCertifySecData'] as $MaterialCertifySec)
															<option value="{{$MaterialCertifySec->office_id}}"> {{$MaterialCertifySec->office_name }}</option>
														@endforeach
													@endif
												</select>
											</div>
											<div class="row">
								<div class="div12" align="center">
									<button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Save">Save</button>	
									<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
									<div class="row smclearrow"></div>
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
 	$(document).ready(function(){
		$('input[name="rad_pg_collected"]').click(function(){

        var projectType = $(this).val();

        if(projectType == 'YES'){
            $("#internal_options").show();
        }else{
            $("#internal_options").hide();
        }
    	});
		$('.pocmlable, .tenderlabel,.quotationlable').hide();
		$('body').on('input change', '.passorderamt', function(event) {
			var PassOrderAmount = parseFloat($(this).val()) || 0;
			if (PassOrderAmount >= 50000) {
				$('.pocmlable').show();
				$('.quotationlable').hide();
			} 
			if (PassOrderAmount < 50000){
				$('.pocmlable').hide();
				$('.tenderlabel').hide();
				$('.quotationlable').show();
			}
		
		});	
		$("#txt_pur_amt").on("keyup change", function() {
   		var PassOrderAmount = parseFloat($(this).val());
        if (PassOrderAmount >= 50000) {
            $("#pcom_1").prop("checked", true);
        } 	
		if (PassOrderAmount >= 500001){
				$("#pcom_2").prop("checked", true);
			}
        
       });
		$('body').on('input change', '.pocmlable', function(event) {
            var PcomValue = $('input[name="rad_pcom"]:checked').val();
			if(PcomValue == 'YES'){
				$('.tenderlabel').show();
			}else if(PcomValue == 'NO'){
				$('.tenderlabel').hide();
			}
		});
		$("body").on("change", "#cmb_indent_no_date", function (event) {
			var IndentId = $(this).val();
			if ((IndentId!='') && (IndentId!=null)) {
				$.ajax({
					type: 'POST',
					url: "{{ route('indent.GetIndentData') }}",
					data: { "_token": "{{ csrf_token() }}", 'IndentId': IndentId },
					// dataType: 'json',
					success: function (data) {
						if (data != '') {
							let IndentData = data['IndentData']; console.log(IndentData); 
							if ((IndentData != '') && (IndentData != null)) { 
								$.each(IndentData, function (index, element) {
								$("#txt_indent_title").val(element.indent_descripton);
								$("#txt_pur_order_name").val(element.indent_descripton);
								});
							}else{
								BootstrapDialog.alert("Please Enter the Correct Indent No");
								$("#cmb_indent_no_date").val(''); 
							}
						}
					}
				});
			}
		}); 
	});	
		


// page load check (important)
// if ($('#rad_pg_collected').is(':checked')) {
//     $('#pg_details').show();
// }
// 	});

	/* $("body").on("change", "#cmb_indent_no_date", function(event){
		alert();
		let Indent = $(this).val();
    }); */

</script>
@endsection
