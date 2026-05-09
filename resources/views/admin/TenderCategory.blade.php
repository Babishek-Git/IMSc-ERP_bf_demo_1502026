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
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Tender Category</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
                                            <div class="row smclearrow"></div>
											<div class="div3 label">Tender Category <span class="reqindi">*</span> </div>											
											<div class="div9"><input type="text" name="txt_tendercategory" id="txt_tendercategory" maxlength="150" class="tboxclass alphanumeric" value="@if(isset($data['ShowTenderCategoryData'])){{ $data['ShowTenderCategoryData']->tr_category }}@endif" style="width:500px"></div>
                                            <div class="row smclearrow"></div>
											<input type="hidden" name ="Hid_TrCatId" id ="Hid_TrCatId" value ="@if(isset($data['ShowTenderCategoryData'])){{ $data['ShowTenderCategoryData']->trcatid }}@endif">																														
											<div class="row smclearrow"></div>
											@php $AddUrl = 'admin.ViewTenderCategory'; @endphp
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
$("body").on("click","#btn_save", function(event){
		var TenderCateg	= $('#txt_tendercategory').val();

		if(TenderCateg == "") {
			BootstrapDialog.alert("Please enter the Tender Category!");
			event.preventDefault();
			event.returnValue = false;
		}
	});
</script>
@endsection