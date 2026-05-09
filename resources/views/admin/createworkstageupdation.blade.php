@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php

if(isset($data['SecAdvItemList'])){
	$SecAdvItemList = $data['SecAdvItemList'];
	//dd($SecAdvItemList);
}
if(isset($data['WorkData'])){
	$WorkData = $data['WorkData'];
	foreach($WorkData as $work){
		$GlobId = $work->globid;
		$WorkName =  $work->work_name;
		$WorkDate =  $work->work_order_date;
		$WorkStage = $work->work_stage;
	}
}
@endphp

<body class="page1" id="top">
	<form name="form" method="post" action="">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row ">
								<div class="div1">&nbsp;</div>
								<div class="div10 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> Work Stage Updation </div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
										<div class="smediv">&nbsp;</div>
										<div class="titlesec disable" style="width:99%">
											<b>Name of Work</b> :  {{ $WorkName }}&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:#DF0979; font-weight:bold; background:#edeaea; border-radius:7px; padding:2px;"></font>
										</div>
										<div class="smediv">&nbsp;</div>
										<input type="hidden" name = "cmb_work_sname" id = "cmb_work_sname" value="@if($GlobId)){{ encrypt($GlobId) }}@endif">
										</div>
									</div>
									<div class="row">
										<div class="div2" align="centre">
											<label for="">&nbsp;&nbsp;Work Stage</label>
										</div>
										<div class="div5">
											<input type="text" name='work_stage' id='work_stage' class="tboxclass disable" value="{{ $WorkStage  }}" readonly=""></td>
										</div>
									</div>
									<div class="row">
										<div class="div2" align="centre">
											<label for="">&nbsp;&nbsp;Change to:</label>
										</div>
										<div class="div5">
										<select name="change_work_stage" id="change_work_stage" class="tboxsmclass" align="left">
											<option value="">--------------- Select ---------------</option>
											@if(isset ($data['WorkStageArr']))
											@foreach($data['WorkStageArr'] as $key => $value)
											@php 
											$SelStr = "";
											if(isset($data['UnitWtSecThickData'])){
												if($data['UnitWtSecThickData']->conv_action == $key){
													$SelStr = 'selected="selected"';
												} 
											}
											@endphp
											<option value="{{ $key }}" {{$SelStr}}>{{ $value }}</option>
											@endforeach
											@endif
										</select>
									</div>
									</div>
									<div class="row smclearrow"></div>
									@php $AddUrl = 'admin.workstageupdation'; @endphp 
									<div class="row">
										<div class="div12" align="center">
											<!-- <input type="button" class="backbutton" name="btn_view" id="btn_view" value=" View "  /> -->
											<input type="button" name="back" value="Back" class="backbutton" onClick="window.location='{{route($AddUrl)}}'" >
											<input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />									
											<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
										</div>
									</div>	
									<div class="row smclearrow"></div>	
								</div>
								<div class="div1">&nbsp;</div>
							</div>
						</div>
					</blockquote>
				</div>
			</div>
		</div>
	</form>
</body>
<script>
	$("#change_work_stage").chosen();

	var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var WorkStage 		= $("#change_work_stage").val();
			if(WorkStage == ""){
				BootstrapDialog.alert("Please select the Work to Change..!!");
				event.preventDefault();
				event.returnValue = false;
			}else{
			event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure want to save this Work Stage ?',
					closable: false, 				
					draggable: false, 			
					btnCancelLabel: 'Cancel', 	
					btnOKLabel: 'Ok', 		
					callback: function(result) {
						if(result){
							KillEvent = 1;
							$("#btn_save").trigger( "click" );
						}else {
							KillEvent = 0;
						}
					}
				});
			}
		}
	});
</script>
@endsection
