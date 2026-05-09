@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php
if(isset($data['WorkData'])){
	$WorkData = $data['WorkData'];
	foreach($WorkData as $work){
		$Globid = $work->globid;
		$WorkName =  $work->work_name;
	}
}
@endphp
<div class="content">
	<div class="title"></div>
	<div class="container_12">
		<div class="grid_12">
			<blockquote class="bq1">
				<form name="form" method="post" action="{{ route('admin.createworkstageupdation')}}">
					<div class="container">
						<div class="div2">&nbsp;</div>
						<div class="div8 mbtable" >
							<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Work Stage Updation</div></div></div>						
							<div class="divrowbox innerdiv pt-2">
							
								<div class="div3 label">Work Short Name<span class="reqindi">*</span></div>
								<div class="div9" align="left">
									<select name="cmb_work_sname" id="cmb_work_sname" style="height:22px;" class= "tboxclass" tabindex="1">
										<option value="">--------------- Select ---------------</option>
										@if(isset($WorkData))
										@foreach($WorkData as $work)
											<option value="{{ encrypt($work['globid']) }}">{{ $work['work_name'] }}</option>
										@endforeach
										@endif
									</select>
								</div>
								<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />								
								<div class="row smclearrow"></div>
								<div class="row">
									<div class="div12" align="center">	
										<input type="submit" class="backbutton" name="btn_view" id="btn_view" value=" Next " />
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
$('#cmb_work_sname').chosen();
$('#cmb_work_sname').change(function() {
	var Id = $(this).val();
	$("#txt_workorder_no").val('');
	$("#txt_workname").val('');
	$("#txt_workorder_date").val('');
	$.ajax({
		type:'POST',
		url:"{{ route('ajax.FindWorkName') }}",
		data:{'_token': '{{ csrf_token() }}','Id':Id, 'Page':'WORK'},
		success:function(data){ 
			if(data != null){  
			var SheetData = data['sheetdata'];  
				$.each(SheetData, function(key, value) { 
					$("#txt_workorder_no").val(value.work_order_no);
					$("#txt_workname").val(value.work_name);
					$("#txt_workorder_date").val(value.work_order_date);
				});
			}
		}
	});
});
$("body").on("click", "#btn_view", function(event) {
	var workorder = $("#cmb_work_sname").val();
	if(workorder == ''){
		BootstrapDialog.alert("Please Select Work Short Name");
		event.preventDefault;
		return false;
	}
});
</script>
@endsection

