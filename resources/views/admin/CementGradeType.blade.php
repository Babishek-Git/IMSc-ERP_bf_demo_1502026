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
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Cement Grade Type</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
																	
											<div class="row smclearrow"></div>	
											<div class="div3 label">Description <span class="reqindi">*</span> </div>											
											<div class="div9"><input type="text" maxlength="150" name="descrip_cement_grade" id="descrip_cement_grade" maxlength="150" class="tboxclass alphanumeric" value="@if(isset($data['ShowCementGradeData'])){{ $data['ShowCementGradeData']->cement_type_desc }}@endif" style="width:450px"></div>

											<div class="div3 label">Code <span class="reqindi">*</span></div>											
											<div class="div9"><input type="text" name="code_cement_grade" id="code_cement_grade" maxlength="10" class="tboxclass" value="@if(isset($data['ShowCementGradeData'])){{ $data['ShowCementGradeData']->cement_type_code }}@endif" style="width:450px" ></div>

											<div class="div3 label">Coefficient <span class="reqindi">*</span></div>											
											<div class="div9"><input type="text" name="coefficient_cement_grade" id="coefficient_cement_grade" maxlength="50" class="tboxclass numberonly" value="@if(isset($data['ShowCementGradeData'])){{ $data['ShowCementGradeData']->coefficient }}@endif" style="width:450px"></div>																																																					
											
											<input type="hidden" name = "cement_grade_id" id = "cement_grade_id" value = "@if(isset($data['ShowCementGradeData'])){{ $data['ShowCementGradeData']->cemtypeid }}@endif">																														
											<div class="row smclearrow"></div> 
											@php $AddUrl = 'admin.ViewCementGradeType'; @endphp
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
	function edit(url) {
		window.location.href = url;
	}

	$(function () {
		$("body").on("click","#btn_save", function(event){
			var Description = $('#descrip_cement_grade').val();
			var Code = $('#code_cement_grade').val();
			var Coefficient = $('#coefficient_cement_grade').val();
			if(Description == ""){
				BootstrapDialog.alert("Please select the Description!");
				event.preventDefault();
				event.returnValue = false;
			}else if(Code == ""){
				BootstrapDialog.alert("Please Enter the Code!");
				event.preventDefault();
				event.returnValue = false;
			}else if(Coefficient == ""){
				BootstrapDialog.alert("Please Enter the Coefficient!");
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
				return false;
			}else if(isNaN(SplitVal[1]) && Number(fractLen) > 0){
				return false;
			}else if (fractLen > 2){
				return false;
			}else{
				return true;
			}
		});
	});
</script>
@endsection