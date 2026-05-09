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
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Recovery</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
																	
											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Recovery Name <span class="reqindi">*</span></div>											
											<div class="div9"><input type="text" name="txt_rec_name" id="txt_rec_name" class="tboxclass" maxlength="50" value="@if(isset($data['RecoveryData'])){{ $data['RecoveryData']->rec_name }}@endif"></div>
											<input type="hidden" name = "hid_recoveryid" id = "hid_recoveryid" value = "@if(isset($data['RecoveryData'])){{ encrypt($data['RecoveryData']->recoveryid) }}@endif">
											<div class="row smclearrow"></div>  
                                            <div class="div3 label">Recovery Code <span class="reqindi">* </span></br><span style="font-size: smaller; color: red;"> (If it is other recovery, start with "OTH")</span></div>											
											<div class="div9"><input type="text" name="txt_rec_code" id="txt_rec_code" maxlength="10" class="tboxclass" value="@if(isset($data['RecoveryData'])){{ $data['RecoveryData']->rec_code }}@endif"></div>
											<div class="row smclearrow"></div>
                                            <div class="div3 label">Recovery Type <span class="reqindi">*</span></div>											
											<div class="div9">
                                                <select name="cmb_rec_type" id="cmb_rec_type" class="tboxsmclass" align="left">
                                                    <option value="">---- Select ----</option>													
                                                    <option value="PA" name = "cmb_rec_type" id = "cmb_rec_type" @if(isset($data['RecoveryData']) && $data['RecoveryData']->rec_type == "PA"){{ 'selected = "selected"' }}@endif>Part A</option>
                                                    <option value="PB" name = "cmb_rec_type" id = "cmb_rec_type" @if(isset($data['RecoveryData']) && $data['RecoveryData']->rec_type == "PB"){{ 'selected = "selected"'; }}@endif>Part B</option>
                                                </select>
                                            </div>
											<div class="row smclearrow"></div>
                                            <div class="div3 label">Recovery Mode <span class="reqindi">*</span></div>											
											<div class="div9">
                                                <select name="cmb_rec_mode" id="cmb_rec_mode" class="tboxsmclass" align="left">
                                                    <option value="">---- Select ----</option>
                                                    <option value="AMT" name = "cmb_rec_mode" id = "cmb_rec_mode" @if(isset($data['RecoveryData']) && $data['RecoveryData']->rec_mode == "AMT"){{ 'selected = "selected"' }}@endif>Amount</option>
                                                    <option value="PERC" name = "cmb_rec_mode" id = "cmb_rec_mode" @if(isset($data['RecoveryData']) && $data['RecoveryData']->rec_mode == "PERC"){{ 'selected = "selected"' }}@endif>Percentage</option>
                                                </select>
                                            </div>
											<div class="row smclearrow"></div>
                                            <div class="div3 label">Recovery <span class="reqindi">*</span></div>											
											<div class="div9"><input type="text" name="txt_recovery" id="txt_recovery" class="tboxclass" value="@if(isset($data['RecoveryData'])){{ $data['RecoveryData']->recovery }}@endif"></div>
											<div class="row smclearrow"></div>
											@php $AddUrl = 'admin.ViewRecovery'; @endphp
											<div class="row">
												<div class="div12" align="center">
												<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" View " onClick="window.location='{{route($AddUrl)}}'" />
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

<script>

$(document).ready(function(){
	$("body").on("click","#btn_save", function(event){
		var RecoveryName = $('#txt_rec_name').val();
		var RecoveryCode = $('#txt_rec_code').val();
		var RecoveryType = $('#cmb_rec_type').val();
		var RecoveryMode = $('#cmb_rec_mode').val();
		var Recovery     = $('#txt_recovery').val();
		if(RecoveryName == ""){
			BootstrapDialog.alert("Please enter the Recovery Name!");
			event.preventDefault();
			event.returnValue = false;
		}
		else if(RecoveryCode == "") {
			BootstrapDialog.alert("Please enter the Recovery Code!");
			event.preventDefault();
			event.returnValue = false;
		}
		else if(RecoveryType == "") {
			BootstrapDialog.alert("Please enter the Recovery Type!");
			event.preventDefault();
			event.returnValue = false;
		}
		else if(RecoveryMode == "") {
			BootstrapDialog.alert("Please enter the Recovery Mode!");
			event.preventDefault();
			event.returnValue = false;
		}
		else if(Recovery == "") {
			BootstrapDialog.alert("Please enter the Recovery!");
			event.preventDefault();
			event.returnValue = false;
		}
	}); 
	$('body').on("change", ".tboxclass" ,function(event){
		var RecoveryName = $('#txt_rec_name').val();
		var RecoveryCode = $('#txt_rec_code').val();
		var HidId        = $('#hid_recoveryid').val();
		$.ajax({
			type: 'POST',
			url: "{{ route('ajax.DuplicateRecovery') }}",
			data: {'_token': '{{ csrf_token() }}', 'RecName': RecoveryName, 'RecCode': RecoveryCode },
			success: function(data){ 
				if(HidId == null){
					if(data>0) {
                		BootstrapDialog.alert("Recovery already exists!");
					}
				}
			}
		});
	});
	$('body').on('change', "#txt_recovery",function(evt){
		var Recovery = $(this).val();
		var RecMode = $("#cmb_rec_mode").val();
		if(RecMode == "PERC"){
			if(Number(Recovery) > 100){
				BootstrapDialog.alert('Invalid Percentage');
				$(this).val('');
			}
		}
	});
	
	$('body').on('keypress', "#txt_recovery",function(evt){
		var SelectedOption = $("#cmb_rec_mode").val();
		var Recovery = $(this).val();
		if(SelectedOption == "PERC"){

			var charCode = (evt.which) ? evt.which : event.keyCode;
			var dot1 	 = Recovery.indexOf('.');
			var dot2 	 = Recovery.lastIndexOf('.'); 
			var val 	 = Recovery;
			var SplitVal = val.split(".");
			var len 	 = SplitVal.length;
			var WholeNo = SplitVal[0];
			
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
		} 
		else if(SelectedOption == "AMT"){
			var charCode = (evt.which) ? evt.which : event.keyCode;
			var dot1 	 = Recovery.indexOf('.');
			var dot2 	 = Recovery.lastIndexOf('.'); 
			var val 	 = Recovery;
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
		}
	});

});

</script>

@endsection