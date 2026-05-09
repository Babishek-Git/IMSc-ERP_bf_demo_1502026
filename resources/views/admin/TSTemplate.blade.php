@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
	if(isset($data['TsTemplateCont'])){
		$TsTemplateCont = $data['TsTemplateCont']->tmp_desc;
	}
@endphp
<style>
	.editdiv{
		border:2px solid #000;
		font-family:verdana;
		font-size:12px;
		color:#001BC6;
		background-color:#fff;
		padding:6px;
		border-radius:8px;
	}
</style>   
@php
  
if((isset($data['TsTemplateCont']))){
	$TsTemplateCont = $data['TsTemplateCont'];	//dd($TsTemplateCont);
}

@endphp
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="" method="post" enctype="multipart/form-data" name="form">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row ">
								<div class="div1">&nbsp;</div>
								<div class="div10 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">TS - Template</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pad-0-top">
											<div class="row">
												<div class="row smclearrow"></div>
												<div class="row smclearrow"></div>
												<div class="row">
													<div class="formbox">
														<div class="row label">
															<b>History</b>
														</div>
														<textarea id="txt_ts_temp" name = "txt_ts_temp[]" class="tboxclass TsTemplate" rows="5"></textarea>
														<input type="hidden" name="txt_ts_temp[]" id="txt_ts_temp_History" value="History">
														<div class="row clearrow"></div>
													</div>
												</div>
												<div class="row">
													<div class="formbox">
														<div class="row label">
															<b>Design & Scope of Work</b>
														</div>
														<textarea id="txt_ts_temp1" name = "txt_ts_temp[]" class="tboxclass TsTemplate" rows="5"></textarea>
														<input type="hidden" name="txt_ts_temp[]" id="txt_ts_temp_Design & Scope of Work" value="Design & Scope of Work">
														<div class="row clearrow"></div>
													</div>
												</div>
												<div class="row">
													<div class="formbox">
														<div class="row label">
															<b>Rates</b>
														</div>
														<textarea id="txt_ts_temp2" name = "txt_ts_temp[]" class="tboxclass TsTemplate" rows="5"></textarea>
														<input type="hidden" name="txt_ts_temp[]" id="txt_ts_temp_Rates" value="Rates">
														<div class="row clearrow"></div>
													</div>
												</div>
												<div class="row">
													<div class="formbox">
														<div class="row label">
															<b>Cost</b>
														</div>
														<textarea id="txt_ts_temp3" name = "txt_ts_temp[]" class="tboxclass TsTemplate" rows="5"></textarea>
														<input type="hidden" name="txt_ts_temp[]" id="txt_ts_temp_Cost" value="Cost">
														<div class="row clearrow"></div>
													</div>
												</div>
												<div class="row">
													<div class="formbox">
														<div class="row label">
															<b>Agency</b>
														</div>
														<textarea id="txt_ts_temp4" name = "txt_ts_temp[]" class="tboxclass TsTemplate" rows="5"></textarea>
														<input type="hidden" name="txt_ts_temp[]" id="txt_ts_temp_Agency" value="Agency">
														<div class="row clearrow"></div>
													</div>
												</div>
												<div class="row">
													<div class="formbox">
														<div class="row label">
															<b>Time</b>
														</div>
														<textarea id="txt_ts_temp5" name = "txt_ts_temp[]" class="tboxclass TsTemplate" rows="5"></textarea>
														<input type="hidden" name="txt_ts_temp[]" id="txt_ts_temp_Time" value="Time">
														<div class="row clearrow"></div>
													</div>
												</div>
												
												
											
												<div class="row smclearrow"></div>
												<div class="row">
													<div class="div12" align="center">
														<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}"/>
														<input type="hidden" name="combined_content" id="combined_content_input" value="">
														<input type="submit" class="btn btn-info" data-type="submit" name="btn_save" id="btn_save" value=" Save " />
													</div>		
												</div>
																									
											</div>
										</div>
									</div>
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

	$(".TsTemplate").each(function(){
		let Id = $(this).attr('id');
		let Val = $(this).val(); 
		$("#"+Id).Editor(); 
		$(this).closest('div').find('.Editor-editor').html(Val);
		$(this).closest('div').find('.Editor-editor').attr("data-id", Id)
		//$(this).closest('textarea').val(Val);
	});
	$("body").on("blur",".Editor-editor", function(event){ 
		let Content = $(this).html(); 
		let Id = $(this).attr('data-id');
		$("#"+Id).text(Content);
	});

</script>
@endsection
