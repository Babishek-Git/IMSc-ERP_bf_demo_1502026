@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
<div class="content">
	<div class="title"></div>
	<div class="container_12">
		<div class="grid_12">
			<blockquote class="bq1">
				<form name="form" method="post" action="{{ route('workflow.WorkFlowAssign') }}">
					<div class="container">
						<div class="div2">&nbsp;</div>
						<div class="div8 mbtable" >
							<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Work Flow Assign - Work Based</div></div></div>
								<div class="divrowbox innerdiv pt-2">
									<div class="row">
										<div class="div2 label">
											Work Name <span class="reqindi">*</span>
										</div>
										<div class="div9">
											<select name="txt_globid" id="txt_globid" class="tboxclass" style="height: 30px;" tabindex="1" >
												<option value="">--------------- Select --------------- </option>
												@if(isset ($data['works']))
													@foreach($data['works'] as $key => $work)
														<option value="{{ encrypt($work['globid']) }}">{{ $work['work_name'] }}</option>
													@endforeach
												@endif
											</select>
										</div>
										
									</div>
									<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
										<div class="buttonsection" id="next_btn_section">
											<input type="submit" data-type="submit" value="Next" name="btn_next" id="btn_next" />
											<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
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
	$('#txt_globid').chosen();
	
	$("body").on("click", "#btn_next", function(event) {
		var workorder = $("#txt_globid").val();
		if(workorder == ''){
			BootstrapDialog.alert("Please Select Work Name");
			event.preventDefault;
			return false;
		}
	});
</script>
@endsection