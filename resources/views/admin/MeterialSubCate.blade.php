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
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Material Sub Category</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
											<div class="row smclearrow"></div>                                                                             											
											<div class="div3 label">Material Type <span class="reqindi">*</span></div>											
											<div class="div9">
											
											<select name="txt_mat_type" id="txt_mat_type" class="textboxdisplay" maxlength="10" style="width:500px;height:28px">
											<option value="">--------------- Select ---------------</option>	
												@if(isset($data['ShowMaterialDetails']))
													@foreach($data['ShowMaterialDetails'] as $MaterName)
														@if($MaterName->active == 1)
															@php
															$SelStr = "";
															if(isset($data['MateSubCatData'])){
																dump($data['MateSubCatData']);
																if($data['MateSubCatData']->matid == $MaterName->matid){
																	$SelStr = 'selected="selected"';
																}
															}
															@endphp
															<option value="{{ $MaterName->matid }}" {{ $SelStr }}>{{ $MaterName->mat_type }}</option>
															@endif
													@endforeach
                                                @endif
											</select>
											
												<input type="hidden" readonly="" name="hid_mscid" id="hid_mscid" class="tboxsmclass tschangeeve" style="width:99%" value="{{ $MaterName->matid }}">
														
											</div>
											<div class="row smclearrow"></div>
											<div class="div3 label">Material Sub Description <span class="reqindi">*</span> </div>											
											<div class="div9"><input type="text" name="txt_mat_sub_descrip" id="txt_mat_sub_descrip" maxlength="150" class="tboxclass alphanumeric" value="@if(isset($data['MateSubCatData'])){{ $data['MateSubCatData']->mat_sub_cata_desc }}@endif" style="width:500px"></div>
											<div class="row smclearrow"></div>
											<div class="div3 label">Material Sub Code <span class="reqindi">*</span></div>											
											<div class="div9"><input type="text" name="txt_mat_sub_code" id="txt_mat_sub_code" maxlength="25" class="tboxclass alphanumeric" value="@if(isset($data['MateSubCatData'])){{ $data['MateSubCatData']->mat_sub_cata_code }}@endif" style="width:500px" ></div>																																																					
											<div class="row smclearrow"></div>
											<!-- <div class="div3 label">Weight <span class="reqindi">*</span></div>											
											<div class="div9"><input type="text" name="txt_mat_weight" id="txt_mat_weight" maxlength="25" class="tboxsmclass validation restrictpaste numberonly" value="@if(isset($data['MateSubCatData'])){{ $data['MateSubCatData']->mat_weight }}@endif" style="width:500px" ></div> -->
											<div class="row smclearrow"></div>
											<input type="hidden" name ="mscid" id ="mscid" value ="@if(isset($data['MateSubCatData'])){{ $data['MateSubCatData']->mscid }}@endif">																														
											<div class="row smclearrow"></div> 
											@php $AddUrl = 'admin.ViewMaterSubCate'; @endphp
											<div class="row">
												<div class="div12" align="center">
												<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" View " onClick="window.location='{{route($AddUrl)}}'"/>
												<input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save "/>
												<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}"/>
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
	$(document).ready(function() {
		$("#txt_mat_type").chosen();
	});
	$("body").on("click","#btn_save", function(event){
		var MaterialCateType	= $('#txt_mat_type').val();
		var MaterialCateDesc 	= $('#txt_mat_sub_descrip').val();
		var MaterialCateCode 	= $('#txt_mat_sub_code').val();
		// var MaterialPWeight 	= $('#txt_mat_weight').val();

		if(MaterialCateType == "") {
			BootstrapDialog.alert("Please Enter Material Type!");
			event.preventDefault();
			event.returnValue = false;
		}else if(MaterialCateDesc == "") {
			BootstrapDialog.alert("Please Enter the Material Sub category Description!");
			event.preventDefault();
			event.returnValue = false;
		}else if(MaterialCateCode == "") {
			BootstrapDialog.alert("Please Enter Material Sub Category Code!");
			event.preventDefault();
			event.returnValue = false;
		}
		//  else if(MaterialPWeight == "") {
		// 	BootstrapDialog.alert("Please Enter Material Weight!");
		// 	event.preventDefault();
		// 	event.returnValue = false;
		// }
	});

	// $('body').on('keypress', ".numberonly",function(evt){
	// 	var result = $(this).val();	
	// 	var charCode = (evt.which) ? evt.which : event.keyCode;
	// 	var dot1 	 = result.indexOf('.');
	// 	var dot2 	 = result.lastIndexOf('.'); 
	// 	var val 	 = result;
	// 	var SplitVal = val.split(".");
	// 	var len 	 = SplitVal.length;
	// 	var Fraction = SplitVal[1];
	// 	if(Fraction){
	// 		var fractLen = Fraction.length;
	// 	}else{
	// 		var fractLen = 0;
	// 	}
	// 	if(charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)){
	// 		return false;
	// 	}else if (charCode == 46 && (dot1 == dot2) && dot1 != -1 && dot2 != -1){
	// 		return false;
	// 	}else if(isNaN(SplitVal[0])){
	// 		//Recovery = 'x';
	// 		return false;
	// 	}else if(isNaN(SplitVal[1]) && Number(fractLen) > 0){
	// 		//Recovery = 'x';
	// 		return false;
	// 	}else if (fractLen > 2){
	// 		return false;
	// 	}else{
	// 		return true;
	// 	}
	// });

	// $('.validation').on('input', function() {
	// 	var inputValue = $(this).val(); // Get the current value of the input field	
	// 	var number = parseInt(inputValue); // Convert the input value to an integer
	// 	if (number < -1) {
	// 		BootstrapDialog.alert("Invalid number, please enter valid number!");
	// 		event.preventDefault();
	// 		event.returnValue = false;
	// 	}
	// });

</script>

@endsection