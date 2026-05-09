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
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Technical Bid Eligible Document</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
																	
											<div class="row smclearrow"></div> 
											<div class="row">
												<div class="div3 label">Tech. Bid Document Description</div>											
												<div class="div9"><input type="text" name="txt_doc_description" id="txt_doc_description" maxlength="3000" class="tboxclass" value="@if(isset($data['TechBidData'])){{ $data['TechBidData']->tbdoc_desc }}@endif" autocomplete="off"></div>                                                                               											
											</div>
											<div class="row">
												<div class="div3 label">Tech. Bid Document Display Order</div>											
												<div class="div9"><input type="number" name="txt_doc_order" id="txt_doc_order"  class="tboxclass numberonly" value="@if(isset($data['TechBidData'])){{ $data['TechBidData']->tbdoc_order }}@endif" autocomplete="off"></div>                                                                               											
											</div>
											<input type="hidden" name = "hid_tbdocid" id = "hid_tbdocid" value = "@if(isset($data['TechBidData'])){{ encrypt($data['TechBidData']->tbdocid) }}@endif">
											<div class="row smclearrow"></div>  
											@php $AddUrl = 'admin.viewtechbidelgdoc'; @endphp
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
	var DocDesc = $('#txt_doc_description').val();
	var DoscOrder = $('#txt_doc_order').val();
	if(DocDesc == ""){
		BootstrapDialog.alert("Please enter the Document Description!");
		event.preventDefault();
		event.returnValue = false;
	}else if(DoscOrder == ""){
		BootstrapDialog.alert("Please enter the Unit Full Name!");
		event.preventDefault();
		event.returnValue = false;
	}
});

$('body').on('keypress', ".numberonly",function(evt){
		var result = $(this).val();	
		var charCode = (evt.which) ? evt.which : event.keyCode;
		var dot1 	 = result.indexOf('.');
		var dot2 	 = result.lastIndexOf('.'); 
		var val 	 = result;
		var SplitVal = val.split(".");
		var len 	 = SplitVal.length;
		var Fraction = SplitVal[1];
		if(Fraction){
			var fractLen = Fraction.length;
		}else{
			var fractLen = 0;
		}
		if(charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)){
			return false;
		}else if (charCode == 46 && (dot1 == dot2) && dot1 != -1 && dot2 != -1){
			return false;
		}else if(isNaN(SplitVal[0])){
			//Recovery = 'x';
			return false;
		}else if(isNaN(SplitVal[1]) && Number(fractLen) > 0){
			//Recovery = 'x';
			return false;
		}else if (fractLen > 1){
			return false;
		}else{
			return true;
		}
	});








</script>

@endsection
