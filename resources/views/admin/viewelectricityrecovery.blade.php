@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<body class="page1" id="top">
	<form name="form" method="get" action="{{ route('admin.viewelectricityrecoverylist') }}">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row ">
								<div class="div3">&nbsp;</div>
								<div class="div6 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> View Electricity Recovery </div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
											<div class="row">
												<div class="row smclearrow"></div>
												<div class="row">
													<div class="div3 label">	
														Work Short Name
													</div> 
													<div class="div9">
														<select name="cmb_work_sname" id="cmb_work_sname" onChange="find_workname()" class="textboxdisplay" style="width:470px;height:22px;" tabindex="7">
																<option value="">--------------- Select ---------------</option>
																@foreach($works as $work)
															<option value="{{ $work['sheetid'] }}">{{ $work['short_name'] }}</option>
																@endforeach
														</select>
													</div>
												</div>
												<div class="row smclearrow"></div>
												<div class="row">
													<div class="div3 label">
														Work Order No.
													</div>
													<div class="div9">
														<input type="text" name="txt_workorder_no" id="txt_workorder_no" class="textboxdisplay" style="width:465px;" disabled="disabled">
													</div>
												</div>
												<div class="row smclearrow"></div>
												<div class="row">
													<div class="div3 label">
														Name of Work
													</div>
													<div class="div9">
														<textarea name='txt_workname' id='txt_workname' class="textboxdisplay txtarea_style" style="width: 470px;" rows="5" disabled="disabled"></textarea>
													</div>
												</div>											
											</div>
											<div class="row">
												<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
													<div class="buttonsection">
														<input type="button" name="back" value="Back" id="back" class="backbutton" onClick="goBack();" /> 
													</div>
													<div class="buttonsection">
														<input type="submit" class="backbutton" name="btn_view" id="btn_view" value="View" >
													</div>
													<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
													<input type="hidden" name='contid' id='contid' class="textboxdisplay"  value="" size="40" >
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="div3">&nbsp;</div>
							</div>
						</div>
					</blockquote>
				</div>
			</div>
		</div>
	</form>
</body>

<script>
	$('#cmb_work_sname').chosen();
	$('#cmb_work_sname').change(function() {
		var work = $(this).val();
		$("#txt_workorder_no").val('');
		$("#txt_workname").val('');
		$.ajax({
			type:'GET',
			url:"{{ route('posts.getwork') }}",
			data:{'work':work},
			success:function(data){ 
				if(data){ 
					$.each(data, function(key, value) { 
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
				BootstrapDialog.alert("Please Select Work Short Name");
				event.preventDefault;
				return false;
			}
		});

</script>
@endsection
