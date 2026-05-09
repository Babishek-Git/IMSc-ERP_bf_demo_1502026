@extends('layouts.dashboard-master')
@section('content')
<form name="form" method="post" action="{{ route($formdata['formaction']) }}">
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1">
					<div class="container">
						<div class="row">
							<div class="div2">&nbsp;</div>
							<div class="div8 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">{{ $formdata['formtitle'] }}</div></div></div>
								
								<div class="divrowbox innerdiv pt-2">
									<div class="div3 label">Work Short Name</div>
									<div class="div9" align="left">
										<select name="cmb_work_no" id="cmb_work_no" class="tboxclass">
											<option value="">--------------- Select ---------------</option>
											@foreach($works as $work)
											<option value="{{ $work['sheetid'] }}">{{ $work['short_name'] }}</option>
											@endforeach
										</select>
									</div>

									<div class="div3 label">Work Order No.</div>
									<div class="div9" align="left">
										<input type="text" name="txt_workorder_no" id="txt_workorder_no" readonly="" class="tboxclass">
									</div>

									<div class="div3 label">Name of the Work</div>
									<div class="div9" align="left">
										<textarea name="workname" id="workname" readonly="" rows="6" class="tboxclass"></textarea>
									</div>

									<div style="text-align:center; height:45px; line-height:45px;" class="div12">
										<div class="buttonsection">
											<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"  />
										</div>
										<div class="buttonsection">
											<input type="submit" data-type="submit" value=" View " name="btn_view" id="btn_view"/>
											<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
											<input type="hidden" name="req_page" id="req_page" value="{{ $formdata['formpage'] }}" />
										</div>
									</div>
									<div class="row smclearrow"></div>
								</div>
							</div>	
							<div class="div2">&nbsp;</div>
						</div>
					</div>
				</blockquote>
			</div>
		</div>
	</div>
</form>
          
</body>
</html>
<script>
	$('#cmb_work_no').chosen();
	$('#cmb_work_no').change(function() {
		var work = $(this).val();
		$("#txt_workorder_no").val('');
		$("#workname").val('');
		$.ajax({
			type:'POST',
			url:"{{ route('posts.getwork') }}",
			data:{'_token': '{{ csrf_token() }}','work':work},
			success:function(data){ 
				if(data){ 
					$.each(data, function(key, value) {
						$("#txt_workorder_no").val(value.work_order_no);
						$("#workname").val(value.work_name);
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

