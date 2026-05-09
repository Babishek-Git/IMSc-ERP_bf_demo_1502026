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
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Upload File Directory</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
																	
											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Module Name <span class="reqindi">*</span></div>											
											<div class="div9">
											<select name="txt_module_name" id="txt_module_name" class="textboxdisplay" style="width:500px;height:28px">
												<option value="">--------------- Select ---------------</option>
												@if(isset($data['ShowModuleList']))

                                                    @foreach($data['ShowModuleList'] as $key=>$value)
                                                        @if($value->active == 1)
													    	@php 
													    	$SelStr = "";
													    	if(isset($data['UpFileDirData'])){ 
													    		if($data['UpFileDirData']->module_code == $value->wf_module_code){
                                                                    
													    			$SelStr = 'selected="selected"';
													    		} 
													    	}
													    	@endphp
														<option value="{{$value->wf_module_code}}" {{ $SelStr }}>{{ $value->wf_module_name}}</option>
                                                        @endif
													@endforeach
                                                @endif	
												<option value="UPLOAD">UPLOAD</option>
												<option value="DOWNLOAD">DOWNLOAD</option>
												<option value="AGMT">Agreement</option>
												<option value="TEVAL">Technical Bid Evaluation</option>
											</select>
											</div>
											
											<div class="div3 label">Module Sub Code <span class="reqindi">*</span> </div>											
											<div class="div9"><input type="text" name="txt_module_sub_code" id="txt_module_sub_code" maxlength="15" class="tboxclass alphanumeric" value="@if(isset($data['UpFileDirData'])){{ $data['UpFileDirData']->module_sub_code }}@endif" style="width:500px"></div>

											<div class="div3 label">Directory Name <span class="reqindi">*</span></div>											
											<div class="div9"><input type="text" name="txt_directory" id="txt_directory" maxlength="240" class="tboxclass alphanumeric" value="@if(isset($data['UpFileDirData'])){{ $data['UpFileDirData']->directory_name }}@endif" style="width:500px" ></div>																																																					
											
											<input type="hidden" name = "hid_updirid" id = "hid_updirid" value = "@if(isset($data['UpFileDirData'])){{ encrypt($data['UpFileDirData']->updirid) }}@endif">																														
											<div class="row smclearrow"></div> 
											@php $AddUrl = 'admin.ViewUploadFileDirect'; @endphp
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
	var ModuleName = $('#txt_module_name').val();
	var ModuleSubCode = $('#txt_module_sub_code').val();
	var Directory = $('#txt_directory').val();
	if(ModuleName == ""){
		BootstrapDialog.alert("Please select the Module Name!");
		event.preventDefault();
		event.returnValue = false;
	}else if(ModuleSubCode == ""){
		BootstrapDialog.alert("Please Enter the Module Sub Code!");
		event.preventDefault();
		event.returnValue = false;
	}else if(Directory == ""){
		BootstrapDialog.alert("Please Enter the FIle Directory!");
		event.preventDefault();
		event.returnValue = false;
	}
});	

</script>

@endsection