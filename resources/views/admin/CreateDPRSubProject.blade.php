@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<form action="{{ route('admin.CreateDPRSubProject') }}" method="post" enctype="multipart/form-data" name="form">
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1" style="overflow:auto">
					<div class="container">
						<div class="row ">
							<div class="div2">&nbsp;</div>
							<div class="div8 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">DPR-Sub Project</div></div></div>
								<div class="divrowbox innerdiv pt-2">
									<div class="row smclearrow"></div>
									<div class="row">
										<div class="div3 label">
											DPR No. <span class="reqindi">*</span>
										</div>
										<div class="div7">
											<select id="cmb_dpr_no" name="cmb_dpr_no" class="tboxclass" >
												<option value="">-------- Select --------</option>
												@php
												if(isset($data['SelectData'])){
												@endphp
													@foreach($data['SelectData'] as $Projects)
														@if($Projects->active == 1)
															@php
															if(isset($data['DPRSubProjData']) && $Projects->dprid){
																$SelStr = "selected='selected'";
															}else{
																$SelStr = '';
															}
															@endphp
															<option value="{{ $Projects->dprid }}" {{ $SelStr }}> {{ $Projects->dpr_project_code }} </option>
														@endif
													@endforeach
												@php
												}
												@endphp
											</select>
											<input type="hidden" name="hid_dspid" id="hid_dspid" value="@if(isset($data['DPRSubProjData'])){{ encrypt($data['DPRSubProjData']->dspmid) }}@endif">
										</div>
									</div>
									<div class="row">
										<div class="div3 label">
											Sub Project No. <span class="reqindi">*</span>
										</div>
										<div class="div7">
										<input type="text" name='txt_sub_proj_no' id='txt_sub_proj_no' maxlength = "500" class="tboxclass" value="@if(isset($data['DPRSubProjData'])){{ $data['DPRSubProjData']->sub_proj_no }}@endif">
										</div>
									</div>
									<div class="row smclearrow"></div>
									<div class="row">
										<div class="div3 label">
											Sub Project Tittle <span class="reqindi">*</span>
										</div>
										<div class="div7">
										<input type="text" name='txt_sub_proj_tittle' id='txt_sub_proj_tittle' maxlength = "500" class="tboxclass" value="@if(isset($data['DPRSubProjData'])){{ $data['DPRSubProjData']->sub_proj_title }}@endif">
										</div>
									</div>
									<div class="row smclearrow"></div>
									<div class="row">
										<div class="div3 label">
											Sub Project Sanction Date <span class="reqindi">*</span>
										</div>
										<div class="div7">
											<input type="text" name='txt_sub_proj_sanct_dt' placeholder="DD/MM/YYYY" id='txt_sub_proj_sanct_dt' readonly=""  class="tboxsmclass datepicker" value="@if(isset($data['DPRSubProjData'])){{ Helper::DisplayDateFormat($data['DPRSubProjData']->sub_proj_sanct_dt) }}@endif">
										</div>
									</div>
									<div class="row">
										<div class="div3 label">
											Sub project Sanction Amount <span class="reqindi">*</span>
										</div>
										<div class="div7">
											<input type="text" name='txt_sub_proj_sanct_amt' id='txt_sub_proj_sanct_amt' class="tboxsmclass" value="@if(isset($data['DPRSubProjData'])){{ $data['DPRSubProjData']->sub_proj_sanct_amt }}@endif">
										</div>
									</div>
								</div>
								<div class="row smclearrow"></div>												
								@php $AddUrl = 'admin.ViewDPRSubProject'; @endphp
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
	$(document).ready(function() {
		$("#cmb_dpr_no").chosen();
	});
	$(document).ready(function(){
		$("body").on("click","#btn_save", function(event){
			var DPRNumber = $('#cmb_dpr_no').val();
			var DPRSubProjNo = $('#txt_sub_proj_no').val();
			var DPRSubProjTittle = $('#txt_sub_proj_tittle').val();
			var DPRSubProjSanctDt = $('#txt_sub_proj_sanct_dt').val();
			var DPRSubProjSanctAmt = $('#txt_sub_proj_sanct_amt').val();
			if(DPRNumber == ""){
				BootstrapDialog.alert("Please Select the DPR Number!");
				event.preventDefault();
				event.returnValue = false;
			}
			else if(DPRSubProjNo == "") {
				BootstrapDialog.alert("Please Enter the Sub Project Number!");
				event.preventDefault();
				event.returnValue = false;
			}
			else if(DPRSubProjTittle == "") {
				BootstrapDialog.alert("Please Enter the Sub project Tittle!");
				event.preventDefault();
				event.returnValue = false;
			}
			else if(DPRSubProjSanctDt == "") {
				BootstrapDialog.alert("Please Enter the Sub Project Sanction Date!");
				event.preventDefault();
				event.returnValue = false;
			}
			else if(DPRSubProjSanctAmt == "") {
				BootstrapDialog.alert("Please Enter the Sub Project Sanction Amount!");
				event.preventDefault();
				event.returnValue = false;
			}
		}); 
		$('body').on('keypress', "#txt_sub_proj_sanct_amt",function(evt){
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
				url: "{{ route('ajax.DuplicateDPRSubProject') }}",
				data: {'_token': '{{ csrf_token() }}', 'DPRNo': DPRNo},
				success: function(data){ 
					if(HidId == null){
						if(data>0) { 
							BootstrapDialog.alert("Failed: Sub Project Number Already Exists!");
						}
					}
				}
			});
		});
	});	

</script>
@endsection


