@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1">
					<form name="form" method="post" action="">

						<div class="container">
							<div class="div2">&nbsp;</div>
							<div class="div8 mbtable" >
							  	<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Sub-Abstract Print</div></div></div>
								
								  	<div class="divrowbox innerdiv pt-2">
										<div class="row">
											<div class="div3 label"> 	
												Work Short Name
											</div>
											<div class="div9">
												<select name="cmb_work_no" id="cmb_work_no" onChange="find_workname()" class="tboxclass" style="height: 27px;" tabindex="7">
													<option value="">--------------- Select --------------- </option>
													@if(isset($works))
														@foreach($works as $work)
														<option value="{{ $work['sheetid'] }}">{{ $work['short_name'] }}</option>
														@endforeach
													@endif

													<input type="hidden" name="hide_schid[]" id="hide_schid" value="" >

												</select>

											</div>
										</div>

										<div class="row">
											<div class="div3 label"> 	
												Work Order No.
											</div>
											<div class="div9">
												<input type="text" name="txt_workorder_no" id="txt_workorder_no" readonly="" rows="6" class="tboxclass">
											</div>
										</div>

										<div class="row">
											<div class="div3 label"> 	
												Name of the Work
											</div>
											<div class="div9">
												<textarea name="workname" id="workname" readonly="" rows="6" class="tboxclass"></textarea>
											</div>
										</div>
										<div class="row">
											<div class="div12 label" align="left" style="color:#CC0047">
											* After Completion of Check Measurements, Sub-Abstract Print Option will be Enabled.
											</div>
										</div>

										<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
											<div class="buttonsection">
												<input type="button" name="back" value="Back" id="back" class="backbutton" onClick="goBack();" />
												<input type="hidden" class="text" name="submit" value="true" />
												<input  type="hidden" class="text" name="runningbilltext" id="runningbilltext" value=""/>




											</div>	
											<div class="buttonsection" id="view_btn_section">

												<input type="submit" class="btn" data-type="submit" value=" View " name="submit" id="submit"   />

												<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="div2">&nbsp;</div>
						</div>
					</form>
				</blockquote>
			</div>
		</div>
	</div>
<script>
	$('#cmb_work_no').chosen();
		$('#cmb_work_no').change(function() {
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

		$(document).ready(function(){
          	$("body").on("click", "#submit", function(event){ 
              	var WorkSname 	   = $("#cmb_work_no").val();
				var WorkOrdernum   = $("#txt_workorder_no").val();
              	var NameofWork 	   = $("#txt_workname").val(); 
				if(WorkSname == 0){
					BootstrapDialog.alert("Work Short Name should not be empty");
					return false;
				}else if(WorkOrdernum == 0){
					BootstrapDialog.alert("Work Order Number should not be empty");
					return false;
				}else if(NameofWork == 0){
					BootstrapDialog.alert("Name of Work should not be empty");
					return false;
				}
          	});
		});
</script>
@endsection
