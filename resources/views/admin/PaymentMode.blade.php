@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')


<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="" method="post" enctype="multipart/form-data" name="form">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row ">
								<div class="div2">&nbsp;</div>
								<div class="div8 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Payment Type</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div3 label">
													Payment Mode <span class="reqindi">*</span>
												</div>
												<div class="div9">
													<input type="text" name="txt_payment_mode" id="txt_payment_mode" maxlength="50" class="tboxclass" value="@if(isset($data['PayModeData'])){{ $data['PayModeData']->payment_mode }}@endif">                                                                               											
													<input type="hidden" name = "hid_pmid" id = "hid_pmid" value = "@if(isset($data['PayModeData'])){{ encrypt($data['PayModeData']->pmid) }}@endif">
												</div>
											</div>
											<div class="row smclearrow"></div>  
											@php $AddUrl = 'admin.ViewPaymentMode'; @endphp
											<div class="row">
												<div class="div12" align="center">
												<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" View " onClick="window.location='{{route($AddUrl)}}'" />
												<input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />									
												<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
												</div>		
											</div>
											<div class="row smclearrow"></div>  
										</div>
									</div>										
								</div>
							</div>                           
						</div>
					</blockquote>
				</div>
			</div>
		</div>
	</form>
</body>

<script>
	$("body").on("click","#btn_save", function(event){
		var PaymentM = $('#txt_payment_mode').val();
		if(PaymentM == ""){
			BootstrapDialog.alert("Please enter the Payment Mode !");
			event.preventDefault();
			event.returnValue = false;
		}
	});
</script>

@endsection
