@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')




<form name="form" method="get" action="{{ route('admin.viewwater') }}">
<div class="content">
	<div class="title"></div>
	<div class="container_12">
		<div class="grid_12">
			<blockquote class="bq1" style="overflow:auto">
				<div class="container">
					<div class="row ">
						<div class="div3"></div>
						<div class="div6 mbtable">
							<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">View Water Meter Details</div></div></div>
							<div class="card-body padding-1 ChartCard" id="CourseChart">
								<div class="divrowbox innerdiv pt-2">
										<div class="row">
											<div class="row">
												<div class="div3 label">	
													Work Short Name
												</div> 
												<div class="div9">
													<select name="cmb_work_sname" id="cmb_work_sname" class="tboxsmclass" style="width:465px">
														<option value="">------------- Select Work Short Name --------------</option>
														@if(isset($data1))
															@foreach($data1 as $Pin)
																@php
																if((isset($WorkId))&&($WorkId == $Pin->sheetid)){
																	$SelStr = 'selected="selected"';
																}else{
																	$SelStr = '';
																}
																@endphp
																<option value="{{ $Pin->sheetid }}" {{ $SelStr }}> {{ $Pin->short_name }} </option>
															@endforeach
														@endif
													</select>
												</div>
											</div>
											
											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div3 label">
													Work Order No.
												</div>
												<div class="div9">
													<input type="text" name="txt_workorder_no" id="txt_workorder_no" class="textboxdisplay" style="width:460px;" disabled="disabled">
												</div>
											</div>
											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div3 label">
													Name of Work
												</div>
												<div class="div9">
													<textarea name='txt_workname' id='txt_workname' class="tboxsmclass txtarea_style" disabled="disabled" rows="6" style="width: 465px; height:60px;">@if(isset($WorkName)) {{ $WorkName }} @endif</textarea>
												</div>
											</div>	
										</div>
										<input type="hidden" class="text" name="submit" value="true" />
										<input  type="hidden" class="text" name="runningbilltext" id="runningbilltext" value=""/>

										<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
										<div class="buttonsection">
											<input type="button" name="back" value="Back" id="back" class="backbutton" onClick="goBack();" /> 
										</div>
										<div class="buttonsection">
											<input type="submit" class="btn" data-type="submit" value=" View " name="btn_view" id="btn_view" />
											<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
										</div>
									</div>  

								</div>
							</div>
						</div>
						<div class="div3"></div>
					</div>
					
				</form>          
			</blockquote>
		</div>
	</div>
</div>
<script type="text/javascript" src="dataTable/jquery.dataTables.min.js"></script>
<script>
	$('body').on("change","#cmb_work_sname", function(e){ 
	 	var Id = $(this).val();
		$("#txt_workorder_no").val('');
		$("#txt_workname").val('');
	 	$.ajax({ 
	 		type: 'GET', 
	 		url: "{{ route('ajax.FindWorkName') }}", 
	 		data: { 'Id': Id, 'Page': 'WORK'}, 
	 		success: function (data) { 
				if(data != null){
					var SheetData = data['sheetdata'];
					$.each(SheetData, function(key, value) { 
						$("#txt_workorder_no").val(value.work_order_no);
						$("#txt_workname").val(value.work_name); 	
					});
				}
	 		}
	 	});
	 });

	$("body").on("click", "#btn_view", function(event) {
		var workorder = $("#txt_workorder_no").val();
		if(workorder == ''){
			alert("Please Select Work Short Name");
			event.preventDefault;
			return false;
		}
	});
</script>
@endsection
