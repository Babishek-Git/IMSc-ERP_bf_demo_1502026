@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
	if(isset($data['TemplateCont'])){
		$TemplateCont = $data['TemplateCont']->tmp_desc;
		$TemplateCont = json_decode($TemplateCont,true);
		$Content = $TemplateCont['Text'];

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
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">NIT - Template</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pad-0-top">
											<div class="row">
												<div class="row">
													<div class="div12" align="right">
														<input type="button" class="btn btn-info" name="btn_download" id="btn_download" onclick="window.location.href='{{ route('admin.NITTemplate',['TYPE'=>'DOWNLOAD'])}}'" value=" Download PDF " />
													</div>		
												</div>
												<div class="row">
													<div class="div12">
														<textarea name='txt_nit_temp' id='txt_nit_temp' class="tboxsmclass NitTemplate" rows="5" style="width:100%;">@if(isset($Content)) @php echo $Content; @endphp @endif</textarea>
													</div>
												</div>
												<div class="row smclearrow"></div>  
												<div class="row">
													<div class="div12" align="center">
														<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}"/>
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
	$(document).ready(function(){
		/*$(".NitTemplate").each(function() { 
			let Id = $(this).attr('id');  
			let Val = $(this).val(); 
			$("#"+Id).Editor(); 
			$(this).closest('div').find('.Editor-editor').html(Val);
		});*/
		var KillEvent = 0;
		$("#txt_nit_temp").Editor();
		var val = $("#txt_nit_temp").val();
		$('.Editor-editor').html(val);
		$('body').on("click","#btn_save", function(e){ 
			let Content = $(".Editor-editor").html(); 
			$("#txt_nit_temp").val(Content); 
			if(KillEvent == 0){
				var NitContent = $("#txt_nit_temp").val();
				if(NitContent == ""){
					BootstrapDialog.alert("Please enter valid template content..!!");
					event.preventDefault();
					event.returnValue = false;
				}else{ 
					event.preventDefault();
					BootstrapDialog.confirm({
						title: 'Confirmation Message',
						message: 'Are you sure want to save ?',
						closable: false, // <-- Default value is false
						draggable: false, // <-- Default value is false
						btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
						btnOKLabel: 'Ok', // <-- Default value is 'OK',
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
	});
</script>
@endsection

