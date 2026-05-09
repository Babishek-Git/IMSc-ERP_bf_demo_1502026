@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
$FinYear             = Helper::GetCurrentFinYear(NULL);
$ProjectHeadMapArray = $data['ProjectHeadMapArray'] ?? [];
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
								<div class="div1">&nbsp;</div>
								<div class="div10 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Budget claim Entry</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
											<table class="formtable" align="center" id="RelationshipTable" width="100%">
												<thead> 
													<tr>
														<th style="width: 20px;" rowspan="2">S.No.</th>
														<th rowspan="2">Project Name</th>
														<th rowspan="2" >Object Head</th>
														<th rowspan="2" style="width: 80px;">Proposed Amount</th>
														<th rowspan="2" style="width: 100px;">Sanction Amount</th>
														<th colspan="4" style="width: 200px;">Quarter</th> 
													</tr>
													<tr>
														<th  style="width: 80px;">Q1</th>
														<th  style="width: 80px;">Q2</th>
														<th  style="width: 80px;">Q3</th>
														<th  style="width: 80px;">Q4</th>
													</tr>
												</thead>
												<tbody>
													@php $Sno =1; @endphp
													@if(isset($data['BudgetAllocationData']))
														@foreach($data['BudgetAllocationData'] as $allocatdata)
															@php
																$ObjId   = $allocatdata->object_head_id;
																$ObjName = $data['AllObectHeadSubCataGrpData'][$ObjId][0]->oh_sub_cata_name ?? '';
															@endphp
															<tr>
																<td><input type="text"  style="width:100%" name="txt_sno" id="txt_sno_" class="tboxsmclass itemno decimalnum" data-index = '{{$Sno}}' readonly value="{{$Sno}}"></td>
																<td><textarea name="txt_item_goods_service_name_0" id="txt_item_goods_service_name_{{$Sno}}" data-index = '{{$Sno}}' readonly class="tboxsmclass">{{$ProjectHeadMapArray [$allocatdata->project_id] ?? ''}}</textarea></td>
																<td><input type="text" style="width:100%" name="txt_item_estimate_no_0" id="txt_item_estimate_no_{{$Sno}}" readonly  data-index = '{{$Sno}}' class="tboxsmclass decimalnum " value="{{$ObjName ?? ''}}"></td>
																<td><input type="text" style="width:100%" name="txt_item_amout_0" id="txt_item_amout_{{$Sno}}" data-index = '{{$Sno}}' class="tboxsmclass decimalnum " readonly value="{{$allocatdata->proposed_amount ?? ''}}"></td>
																<td><input type="text" style="width:100%" name="txt_item_amout_0" id="txt_item_amout_{{$Sno}}" data-index = '{{$Sno}}' class="tboxsmclass decimalnum " readonly value="{{$allocatdata->sanctioned_amount ?? ''}}"></td>
																<td><input type="text" style="width:100%" name="txt_claim_q1[]" id="txt_claim_q1_{{$Sno}}" data-index = '{{$Sno}}' class="tboxsmclass decimalnum "  value=""></td>
																<td><input type="text" style="width:100%" name="txt_claim_q2[]" id="txt_claim_q2_{{$Sno}}" data-index = '{{$Sno}}' class="tboxsmclass decimalnum "  value=""></td>
																<td><input type="text" style="width:100%" name="txt_claim_q3[]" id="txt_claim_q3_{{$Sno}}" data-index = '{{$Sno}}' class="tboxsmclass decimalnum "  value=""></td>
																<td><input type="text" style="width:100%" name="txt_claim_q4[]" id="txt_claim_q4_{{$Sno}}" data-index = '{{$Sno}}' class="tboxsmclass decimalnum "  value=""></td>
																<input type="hidden" style="width:100%" name="txt_budget_allocat_id[]" id="txt_budget_allocat_id_{{$Sno}}" data-index = '{{$Sno}}' class="tboxsmclass decimalnum "  value="{{$allocatdata->budget_allocation_id ?? ''}}">
															</tr>
															@php $Sno ++; @endphp
														@endforeach	
													@endif
												</tbody>
											</table>                                        
											<div class="row">
												<div class="div12" align="center">
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
