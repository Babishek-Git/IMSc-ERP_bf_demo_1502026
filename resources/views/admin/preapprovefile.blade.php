@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
if(isset($data['WorkStage'])){ //dd($data['WorkStage']);
}
@endphp
<div class="content">
	<div class="title"></div>
	<div class="container_12">
		<div class="grid_12">
			<blockquote class="bq1">
				<form name="form" method="post" action="{{ route('admin.ViewPreApprovedFiles') }}">
					<div class="container">
						<div class="div2">&nbsp;</div>
						<div class="div8 mbtable" >
							<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Pre Approved File</div></div></div>
								<div class="divrowbox innerdiv pt-2">
									<div class="row">
										<div class="div3 label">
											Work Stage <span class="reqindi">*</span>
										</div>
										<div class="div7">
											<select name="work_stage" id="work_stage" class="tboxclass" style="height: 30px;" tabindex="1" >
												<option value="">--------------- Select --------------- </option>
												@if(isset ($data['WorkStage']))
													@foreach($data['WorkStage'] as $key => $value)
														<option value="{{ $value->wf_module_code }}">{{ $value->wf_module_name }}</option>
													@endforeach
												@endif
											</select>
										</div>
										<!--
										<div class="row">
											<div class="div3 label"> 	
												Work Order No.
											</div>
											<div class="div9">
												<input type="text" name="txt_workorder_no" id="txt_workorder_no" class="tboxclass disable" readonly="">
											</div>
										</div>
										-->
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
	$('#work_stage').chosen();
	$('#cmb_work_no').change(function() {
		var Id = $(this).val();
		$("#txt_workorder_no").val('');
		$.ajax({
			type:'POST',
			url: "{{ route('ajax.FindEstTsTrName') }}",
			data: { "_token": "{{ csrf_token() }}", 'Id': Id, 'Page': 'EST'},
			success:function(data){ 
				if(data != null){  
				var SheetData = data['sheetdata'];  
					$.each(SheetData, function(key, value) { 
						$("#txt_workorder_no").val(value.work_order_no);
					});
				}
			}
		});
	});
	$("body").on("click", "#btn_next", function(event) {
		var workorder = $("#cmb_work_no").val();
		if(workorder == ''){
			BootstrapDialog.alert("Please Select Work Name");
			event.preventDefault;
			return false;
		}
	});
</script>
@endsection