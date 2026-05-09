@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
$FinYear     = Helper::GetCurrentFinYear(NULL);
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
								<div class="div2">&nbsp;</div>
								<div class="div8 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Budget Received Entry</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
											<div class="row smclearrow"></div> 
											<div class="div3 label">Project  Name</div>
											<div class="div9">                                                
                                                <div class = "GR1">
                                                    <select class="group tboxclass" name="cmb_proj_name" id="cmb_proj_name" >
                                                        <option value=""> ------ Select ------ </option>
                                                        @if(isset($data['ProjectHeadGroupData']))
                                                            @foreach($data['ProjectHeadGroupData'] as $List)
                                                                <option value="{{ $List->project_id }}">{{ $List->full_heads }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>  
											<div class="row smclearrow"></div> 
											<div class="div3 label">Object Head</div>
											<div class="div9">                                                
                                                <div class = "GR1">
                                                    <select class="group tboxclass" name="cmb_obj_head" id="cmb_obj_head" >
                                                        <option value=""> ------ Select ------ </option>
                                                    </select>
                                                </div>
                                            </div> 
											<div class="row smclearrow"></div> 
											<div class="div3 label">Claim Period</div>
											<div class="div9">                                                
                                                <div class = "div4">
                                                    <select class="group tboxclass" name="cmb_claim_period" id="cmb_claim_period" >
                                                        <option value=""> ------ Select ------ </option>
                                                        <option value="Q1">Q1</option>
                                                        <option value="Q2">Q2</option>
                                                        <option value="Q3">Q3</option>
														<option value="Q4">Q4</option>
                                                    </select>
                                                </div>
                                            </div> 
											<div class="div3 label">Received Amount</div>
											<div class="div9">                                                
                                                <div class = "div4">
													<input type="text" class="tboxsmclass decimalnum" name="curr_final_year" id="curr_final_year"  value="">
                                                </div>
                                            </div>   
											<div class="div3 label">Received On</div>
											<div class="div9">                                                
                                                <div class = "div4">
													<input type="text" class="tboxsmclass datepicker" name="curr_final_year" id="curr_final_year"  value="">
                                                </div>
                                            </div> 
											<div class="row smclearrow"></div>  
											<div class="row smclearrow"></div>                                                                                											
											<div class="row">
												<div class="div12" align="center">
                                                    <!-- <input type="button" name="btn_back" id="btn_back" class="backbutton" value=" Back "> -->
													<input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />				
													<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
												</div>		
											</div>
											<div class="row smclearrow"></div>  
										</div>
									</div>										
								</div>
								<div class="div2">&nbsp;</div>
							</div>                           
						</div>
					</blockquote>
				</div>
			</div>
		</div>
	</form>
</body>	

<script>
$(function(){
	$(".decimalnum").on("input", function() {
		this.value = this.value.replace(/[^0-9.]/g, ''); //
	});
	$("#cmb_proj_name").chosen();
	$("#cmb_claim_mode").chosen();
	$("#cmb_obj_head").chosen();
	$('body').on("change", "#cmb_proj_name", function (e) {
    	var ProjectId = $(this).val();
		$.ajax({
			type: 'POST',
			url: '{{ route("budget.sanction-details") }}',
			data: {"_token": "{{ csrf_token() }}",projid: ProjectId},
			success: function (data) {
				var AllObectHead = data.AllObectHead ?? [];
				var ObectHeadSubCataGrpData = data.ObectHeadSubCataGrpData ?? {};
				var optionStr = '';
				if (AllObectHead.length > 0) {
					$.each(AllObectHead, function (index, head) {
						var isSubCata = 0;
						if (ObectHeadSubCataGrpData[head.object_head_id]) {
							var subCataList = ObectHeadSubCataGrpData[head.object_head_id];
							if (subCataList.length > 0) {
								isSubCata = 1;
								$.each(subCataList, function (i, sub) {
									optionStr += '<option value="' + sub.oh_sub_cata_id + '" ' +'data-mode="OHSC" ' +'data-ohid="' + sub.object_head_id + '" ' +'data-subcata="' + sub.oh_sub_cata_id + '">' +sub.oh_sub_cata_name +'</option>';
								});
							}
						}
						if (isSubCata === 0) {
							optionStr += '<option value="' + head.object_head_id + '" ' +'data-mode="OH" ' +'data-ohid="' + head.object_head_id + '" ' +'data-subcata="">' +head.object_head_name +'</option>';
						}
					});
				}
				$('#cmb_obj_head').html('<option value=""> ------ Select ------ </option>' + optionStr);
				$("#cmb_obj_head").trigger("chosen:updated");
			}
		});
	});
	// $('body').on("click","#btn_save", function(event){ 
	// 	var CodeErr 	= $("#cmb_proj_name").val();
	// 	var CodeErr 	= $("#cmb_obj_head").val();
	// 	var CodeErr 	= $("#cmb_proj_name").val();
	// 	var CodeErr 	= $("#cmb_proj_name").val();
	// 	var GroupName 	= $(".newgroup").val(); 
    // 	var Url 		= $(".url").val();
	// 	var Navbar 		= $(".nbar").val(); 
    // 	var Order 		= $(".order").val();

	// 	if(GrpCnt > 0){
	// 		BootstrapDialog.alert("Error : Group Name in drop down box should not be empty");
	// 		event.preventDefault();
	// 		event.returnValue = false;
	// 	}else if(CodeErr == 1){
	// 		BootstrapDialog.alert("Error : Group Code already exists. please enter different code.");
	// 		event.preventDefault();
	// 		event.returnValue = false;
	// 	}else if(GroupName == "") {
	// 		BootstrapDialog.alert("Error : New Group Name should not be empty.!");
	// 		event.preventDefault();
	// 		event.returnValue = false;
	// 	}else if(Url == "") {
	// 		BootstrapDialog.alert("Error : URL should not be empty.!");
	// 		event.preventDefault();
	// 		event.returnValue = false;
	// 	}else if(Navbar == "") {
	// 		BootstrapDialog.alert("Error : Navbar should not be empty.!");
	// 		event.preventDefault();
	// 		event.returnValue = false;
	// 	}else if(Order == "") {
	// 		BootstrapDialog.alert("Error : Order should not be empty.!");
	// 		event.preventDefault();
	// 		event.returnValue = false;
	// 	}
	// });
});

</script>
@endsection
