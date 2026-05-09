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
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Budget Sancation Entry</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
											<div class="row smclearrow"></div>  
											<div class="div3 label">Final Year</div>
											<div class="div9">                                                
                                                <div class = "div3">
													<input type="text" class="tboxsmclass" name="curr_final_year" id="curr_final_year" readonly value="{{ $FinYear ?? '' }}">
                                                </div>
                                            </div>   
											<div class="row smclearrow"></div>  
											<div class="div3 label">Claim Mode</div>
											<div class="div9">                                                
                                                <div class = "div3">
													<select class="group tboxclass" name="cmb_claim_mode" id="cmb_claim_mode" >
                                                        <option value=""> ------ Select ------ </option>
                                                        <option value="MONTHLY">Monthly</option>
                                                            
                                                    </select>
                                                </div>
                                            </div>     
											<div class="row smclearrow"></div>  
											<div class="div3 label">Sancation No.</div>
											<div class="div9">                                                
                                                <div class = "div4">
													<input type="text" class="tboxsmclass" name="sanction_no" id="sanction_no"  value="">
                                                </div>
                                            </div>                                                                            											
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
											<div class="row smclearrow"></div>                                                                                											
												<div id="sanction_table_container"></div>                                         
											<div class = "GR1"><div class="row smclearrow"></div></div>  										
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
	$('body').on("change", "#cmb_proj_name", function (e) {
    	var ProjectId = $(this).val();
		$.ajax({
			type: 'POST',
			url: '{{ route("budget.sanction-details") }}',
			data: {
				"_token": "{{ csrf_token() }}",
				projid: ProjectId
			},
			success: function (data) {
				var ObjectHeadData = data.ObjectHead ?? {};
				$("#sanction_table_container").html('');
				if (ObjectHeadData && Object.keys(ObjectHeadData).length > 0) {
					var SancationTable = '';
					SancationTable += '<table class="formtable" align="center" id="RelationshipTable" width="100%">';
					SancationTable += '<thead>';
					SancationTable += '<tr>';
					SancationTable += '<th>Object Head</th>';
					SancationTable += '<th>Proposed Amount</th>';
					SancationTable += '<th>Sanction Amount</th>';
					SancationTable += '</tr>';
					SancationTable += '</thead>';
					SancationTable += '<tbody>';
					$.each(ObjectHeadData, function (key, group) {
						$.each(group, function (element, val) {
							SancationTable += '<tr>';
							SancationTable += '<td><input type="text" class="tboxsmclass" name="obj_head_name[]" value="' + (val.oh_sub_cata_name ?? '') + '"></td>';
							SancationTable += '<input type="hidden"  name="obj_head_id[]" value="' + (val.object_head_id ?? '') + '">';
							SancationTable += '<td><input type="text" class="tboxsmclass decimalnum" name="proposed_amount[]" value=""></td>';
							SancationTable += '<td><input type="text" class="tboxsmclass decimalnum"  name="sanction_amount[]" value=""></td>';
							SancationTable += '</tr>';
						});
					});
					SancationTable += '</tbody>';
					SancationTable += '</table>';
					$("#sanction_table_container").html(SancationTable);

				} else {
					$("#sanction_table_container").html('<p>No data found</p>');
				}
			}
		});
	});
	// $('body').on("click","#btn_save", function(event){ 
	// 	var GrpCnt = 0;
	// 	$(".group").each(function() {
	// 		var Grp = $(this).val();
	// 		if(Grp == ""){
	// 			GrpCnt++;
	// 		}
	// 	}); 
	// 	var CodeErr 	= $("#txt_code_err").val();
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
