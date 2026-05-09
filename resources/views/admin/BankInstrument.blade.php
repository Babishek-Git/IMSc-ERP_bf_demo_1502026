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
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Bank Instrument</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
																	
											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Bank Instrument Name <span class="reqindi">*</span></div>											
											<div class="div9"><input type="text" name="txt_bankinstrument_name" id="txt_bankinstrument_name" maxlength="50" class="tboxclass alphanumeric" value="@if(isset($data['BankInstrumentData'])){{ $data['BankInstrumentData']->bank_inst_name }}@endif"></div>
											<input type="hidden" name = "bank_inst_id" id = "bank_inst_id" value = "@if(isset($data['BankInstrumentData'])){{ encrypt($data['BankInstrumentData']->bank_inst_id) }}@endif">
											<div class="row smclearrow"></div>  
											<div class="div3 label">Bank Instrument Code <span class="reqindi">*</span></div>											
											<div class="div9"><input type="text" name="txt_bankinstrument_code" id="txt_bankinstrument_code" maxlength="5" class="tboxclass alphanumeric" value="@if(isset($data['BankInstrumentData'])){{ $data['BankInstrumentData']->inst_code }}@endif"></div>											
											<div class="row smclearrow"></div>  
											@php $AddUrl = 'admin.ViewBankInstruments'; @endphp
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
		var BankInstName = $('#txt_bankinstrument_name').val();
		var BankInstCode = $('#txt_bankinstrument_code').val();
		if(BankInstName == ""){
			BootstrapDialog.alert("Please enter the Bank Instrument Name!");
			event.preventDefault();
			event.returnValue = false;
		}else if(BankInstCode == ""){
			BootstrapDialog.alert("Please enter the Bank Instrument Code!");
			event.preventDefault();
			event.returnValue = false;
		}
	});
	$('body').on('keypress', ".alphanumeric", function(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if (!((charCode >= 48 && charCode <= 57) ||   
			(charCode >= 65 && charCode <= 90) ||   
			(charCode >= 97 && charCode <= 122))) {  
			return false;
		} else {
			return true;
		}
	});
</script>

@endsection
