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
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Budget Allocation Entry</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="row row-fluid line-control-menu-bar formtitlebar" style="border:none">
											<div class="btn-group floatr">
												<button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Save">Save</button>
												<input type="button" class="backbutton" name="home" id="home" value=" Home " onclick="window.location='{{ route('dashboard.index') }}'" /> &nbsp;
											</div>
										</div>
										<div class="divrowbox innerdiv pt-2">
											<div class="div3 label">Grant-in-Aid</div>
											<div class="div9">                                                
												<select class="group tboxclass" name="cmb_gia" id="cmb_gia">
													<option value=""> ------ Select ------ </option>
													@if(isset($data['GrandDetails']))
														@foreach($data['GrandDetails'] as $GaList)
															<option value="{{ $GaList->gia_id }}" data-code ="{{$GaList->gia_code }}">{{ $GaList->gia_name }}</option>
														@endforeach
													@endif
												</select>
                                            </div>  
											
											<div class="row smclearrow"></div>  
											<!-- <div class="row smclearrow"></div>  
											<div class="div3 label">Claim Mode</div>
											<div class="div9">                                                
                                                <div class = "div3">
													<select class="group tboxclass" name="cmb_claim_mode" id="cmb_claim_mode" >
                                                        <option value=""> ------ Select ------ </option>
                                                        <option value="MONTHLY">Monthly</option>
                                                            
                                                    </select>
                                                </div>
                                            </div>      -->
											<div class="div3 label ShowDet">Project  Name</div>
											<div class="div9 ShowDet">                                                
												<select class="group tboxclass " name="cmb_proj_name" id="cmb_proj_name" >
													<option value=""> ------ Select ------ </option>
													@if(isset($data['ProjectHeadGroupData']))
														@foreach($data['ProjectHeadGroupData'] as $List)
															<option value="{{ $List->project_id }}" data-parid="{{$List->project_parentid}}">{{ $List->project_name }}</option>
														@endforeach
													@endif
												</select>
                                            </div>  
											<div class="div3 label">Sanction No.</div>
											<div class="div9">                                                
												<input type="text" class="tboxsmclass" name="sanction_no" id="sanction_no"  value="">
                                            </div>  
											<div class="row smclearrow"></div>  
											<div class="div3 label">Financial Year</div>
											<div class="div4">                                                
												<input type="text" class="tboxsmclass" name="curr_final_year" id="curr_final_year" readonly value="{{ $FinYear ?? '' }}">
                                            </div>  
											<div class="div5 label">&nbsp;</div> 
											<div class="row smclearrow">&nbsp;</div>                                                                                											
											<div id="sanction_table_container"></div>                                         
											<div class = "GR1"><div class="row smclearrow"></div></div>  										
											<div class="row">
												<div class="div12" align="center">
                                                    <!-- <input type="button" name="btn_back" id="btn_back" class="backbutton" value=" Back "> -->
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
$(document).ready(function () {
	$(".ShowDet").hide();
	$(".decimalnum").on("input", function() {
		this.value = this.value.replace(/[^0-9.]/g, ''); //
	});
	$("#cmb_claim_mode").chosen();
	$("#cmb_gia").chosen();
	$('body').on("change", "#cmb_gia", function (e) {
		$("#sanction_no").val('');
		$("#sanction_table_container").html('');
		var GiaId           = $(this).val();
		var Giacode         = $(this).find(':selected').data('code');
		if(Giacode != 'CRA'){
			$(".ShowDet").hide();
			$("#cmb_proj_name").val('');
			SancationDetails(GiaId,Giacode);
		}else{
			$("#cmb_proj_name").val('');
			$(".ShowDet").show();
			$("#cmb_proj_name").chosen();
		}
	});
	$('body').on("change", "#cmb_proj_name", function (e) {
		var GiaId         = $("#cmb_gia").val();
		var Giacode       = $("#cmb_gia option:selected").data('code');
		var ProjectId     = $(this).val();
    	var ProjectParId  = $(this).find(':selected').data('parid');
 		ProjectSancationDetails(GiaId,Giacode,ProjectId,ProjectParId)
	});
	function SancationDetails(GiaId,Giacode){
		var FinancialYear = $("#curr_final_year").val();
		$.ajax({
			type: 'POST',
			url: '{{ route("budget.sanction-details") }}',
			data: {
				"_token": "{{ csrf_token() }}",
				GiaId: GiaId,Giacode: Giacode,FinancialYear:FinancialYear
			},
			success: function (data) { //console.log(data);
				$("#sanction_table_container").html('');
				var ObjectHeadSubCategoryData    = data.ObjectSubCategoryData ?? [];
				var ObjectHeadGaiMappData        = data.AllObectHeadGaiMappingData ?? [];
				var AllObectHead                 = data.AllObjHeadData ?? [];
				var AllObjHeadSubCatGroupByData  = data.AllObjHeadSubCatGroupByData ?? [];
				var BudgetAllocationData         = data.BudgetAllocationData ?? [];
				var SancationNo                  = BudgetAllocationData?.[0]?.budget_sanction_no ?? '';
				$("#sanction_no").val(SancationNo);
				var SancationTable = '';
					SancationTable += '<table class="formtable" align="center" id="RelationshipTable" width="100%">';
					SancationTable += '<thead>';
					SancationTable += '<tr>';
					SancationTable += '<th>Object Head</th>';
					SancationTable += '<th>Overall Sanction Amount (Lakhs ₹)</th>';
					SancationTable += '<th>Allocation Amount (Lakhs ₹) <br>Financial Year (' + FinancialYear + ')</th>';
					SancationTable += '</tr>';
					SancationTable += '</thead>';
					SancationTable += '<tbody>';
				if (ObjectHeadGaiMappData && ObjectHeadGaiMappData.length > 0) {
					$.each(ObjectHeadGaiMappData, function (key, mappelement) {
						if (AllObectHead.length > 0) {
							var element = AllObectHead.find(e => e.object_head_id == mappelement.object_head_id);
							// $.each(AllObectHead, function (key, element) {
							if(element){
								if (mappelement.object_head_id == element.object_head_id) {
									var ObjHeadId              = element.object_head_id;
									var AllocationByObjHead    = BudgetAllocationData.find(item =>item.object_head_id == ObjHeadId);
									var ProposedAmtByObjHead   = AllocationByObjHead ? AllocationByObjHead.proposed_amount : '';
									var SanctionedAmtByObjHead = AllocationByObjHead ? AllocationByObjHead.sanctioned_amount : '';
									if(mappelement.is_sup_cata_applicable == true){
										var IsSubCata = 0;
										if (AllObjHeadSubCatGroupByData[element.object_head_id] !== undefined) {
											var ObjectHeadSubCata = AllObjHeadSubCatGroupByData[element.object_head_id];
											if (ObjectHeadSubCata && ObjectHeadSubCata.length > 0) {
												var IsSubCata = 1;
												$.each(ObjectHeadSubCata, function (key, val) {
													var subCatId      = val.oh_sub_cata_id;
													var Allocation    = BudgetAllocationData.find(item =>item.oh_sub_cata_id == subCatId);
													var ProposedAmt   = Allocation ? Allocation.proposed_amount : '';
   													var SanctionedAmt = Allocation ? Allocation.sanctioned_amount : '';
													SancationTable += '<tr>';
													SancationTable += '<td><input type="text" class="tboxsmclass" readonly value="' + (val.oh_sub_cata_name ? val.oh_sub_cata_name : '') + '">';
													SancationTable += '<input type="hidden" name ="obj_head_id[]" id="obj_head_id"class="tboxsmclass" value="' + (val.object_head_id ? val.object_head_id : '') + '">';
													SancationTable += '<input type="hidden" name ="obj_head_data_mode[]" id="obj_head_data_mode"class="tboxsmclass" value="OHSC">';
													SancationTable += '<input type="hidden" name ="obj_head_sub_id[]" id="obj_head_sub_id"class="tboxsmclass" value="' + (val.oh_sub_cata_id ? val.oh_sub_cata_id : '') + '">';
													SancationTable +='</td>';
													SancationTable += '<td><input type="text" class="tboxsmclass decimalnum" style="text-align:right;" name="proposed_amount[]"  value ="' + ProposedAmt + '" ></td>';
													SancationTable += '<td><input type="text" class="tboxsmclass decimalnum" style="text-align:right;" name="sanction_amount[]" value ="' + SanctionedAmt + '" ></td>';
													SancationTable += '</tr>';
												});
											}
										}
										if (IsSubCata == 0) {
											SancationTable += '<tr>';
											SancationTable += '<td><input type="text" class="tboxsmclass" readonly value="' + (element.object_head_name ? element.object_head_name : '') + '">';
											SancationTable += '<input type="hidden" name ="obj_head_id[]" id="obj_head_id"class="tboxsmclass" value="' + (element.object_head_id ? element.object_head_id : '') + '">';
											SancationTable += '<input type="hidden" name ="obj_head_data_mode[]" id="obj_head_data_mode"class="tboxsmclass" value="OH">';
											SancationTable += '</td>';
											SancationTable += '<td><input type="text" class="tboxsmclass decimalnum" style="text-align:right;" name="proposed_amount[]" value ="' + ProposedAmtByObjHead + '"></td>';
											SancationTable += '<td><input type="text" class="tboxsmclass decimalnum" style="text-align:right;" name="sanction_amount[]" value ="' + SanctionedAmtByObjHead + '" ></td>';
											SancationTable += '</tr>';
										}
									}else{
										SancationTable += '<tr>';
										SancationTable += '<td><input type="text" class="tboxsmclass" readonly value="' + (element.object_head_name ? element.object_head_name : '') + '">';
										SancationTable += '<input type="hidden" name ="obj_head_id[]" id="obj_head_id"class="tboxsmclass" value="' + (element.object_head_id ? element.object_head_id : '') + '">';
										SancationTable += '<input type="hidden" name ="obj_head_data_mode[]" id="obj_head_data_mode"class="tboxsmclass" value="OH">';
										SancationTable += '</td>';
										SancationTable += '<td><input type="text" class="tboxsmclass decimalnum" style="text-align:right;" name="proposed_amount[]" value ="' + ProposedAmtByObjHead + '" ></td>';
										SancationTable += '<td><input type="text" class="tboxsmclass decimalnum" style="text-align:right;" name="sanction_amount[]" value ="' + SanctionedAmtByObjHead + '"></td>';
										SancationTable += '</tr>';
									}
								}
								
							}
							// });
						}
					});
					
				}else{
					SancationTable += '<tr>';
					SancationTable += '<td colspan="4"  class="tboxsmclass decimalnum" style="text-align:center; ">No Records Found</td>';
					SancationTable += '</tr>';
				}
				SancationTable += '</tbody>';
				SancationTable += '</table>';
				$("#sanction_table_container").html(SancationTable);
			}
		});
	};
	function ProjectSancationDetails(GiaId,Giacode,ProjectId,ProjectParId){
		var FinancialYear = $("#curr_final_year").val();
		$.ajax({
			type: 'POST',
			url: '{{ route("budget.sanction-details") }}',
			data: {"_token": "{{ csrf_token() }}",GiaId: GiaId,Giacode: Giacode,ProjectId:ProjectId,ProjectParentId:ProjectParId,FinancialYear:FinancialYear},
			success: function (data) { console.log(data);
				$("#sanction_table_container").html('');
				var AllObectHead                 = data.AllObjHeadData ?? [];
				var ObjectHeadSubCategoryData    = data.ObjectSubCategoryData ?? [];
				var AllObjHeadSubCatGroupByData  = data.AllObjHeadSubCatGroupByData ?? [];
				var ObjectMappingProjectData     = data.AllObectHeadGaiMappingData ?? [];
				var BudgetAllocationData         = data.BudgetAllocationData ?? [];
				var SancationNo                  = BudgetAllocationData?.[0]?.budget_sanction_no ?? '';
				$("#sanction_no").val(SancationNo);
				var SancationTable = '';
					SancationTable += '<table class="formtable" align="center" id="RelationshipTable" width="100%">';
					SancationTable += '<thead>';
					SancationTable += '<tr>';
					SancationTable += '<th>Object Head</th>';
					SancationTable += '<th>Overall Sanction Amount (Lakhs ₹)</th>';
					SancationTable += '<th>Allocation Amount (Lakhs ₹) <br>Financial Year (' + FinancialYear + ')</th>';
					SancationTable += '</tr>';
					SancationTable += '</thead>';
					SancationTable += '<tbody>';
				if (ObjectMappingProjectData && ObjectMappingProjectData.length > 0) {
					
					$.each(ObjectMappingProjectData, function (key, mappelement) {
						if (AllObectHead.length > 0) {
							var element = AllObectHead.find(e => e.object_head_id == mappelement.object_head_id);
							// $.each(AllObectHead, function (key, element) {
							if(element){
								if (mappelement.object_head_id == element.object_head_id) {
									var ObjHeadId              = element.object_head_id;
									var AllocationByObjHead    = BudgetAllocationData.find(item =>item.object_head_id == ObjHeadId);
									var ProposedAmtByObjHead   = AllocationByObjHead ? AllocationByObjHead.proposed_amount : '';
									var SanctionedAmtByObjHead = AllocationByObjHead ? AllocationByObjHead.sanctioned_amount : '';
									if(mappelement.is_sup_cata_applicable == true){
										var IsSubCata = 0;
										if (AllObjHeadSubCatGroupByData[element.object_head_id] !== undefined) {
											var ObjectHeadSubCata = AllObjHeadSubCatGroupByData[element.object_head_id];
											if (ObjectHeadSubCata && ObjectHeadSubCata.length > 0) {
												var IsSubCata = 1;
												$.each(ObjectHeadSubCata, function (key, val) {
													var subCatId      = val.oh_sub_cata_id;
													var Allocation    = BudgetAllocationData.find(item =>item.oh_sub_cata_id == subCatId);
													var ProposedAmt   = Allocation ? Allocation.proposed_amount : '';
   													var SanctionedAmt = Allocation ? Allocation.sanctioned_amount : '';
													SancationTable += '<tr>';
													SancationTable += '<td><input type="text" class="tboxsmclass" readonly value="' + (val.oh_sub_cata_name ? val.oh_sub_cata_name : '') + '">';
													SancationTable += '<input type="hidden" name ="obj_head_id[]" id="obj_head_id"class="tboxsmclass" value="' + (val.object_head_id ? val.object_head_id : '') + '">';
													SancationTable += '<input type="hidden" name ="obj_head_data_mode[]" id="obj_head_data_mode"class="tboxsmclass" value="OHSC">';
													SancationTable += '<input type="hidden" name ="obj_head_sub_id[]" id="obj_head_sub_id"class="tboxsmclass" value="' + (val.oh_sub_cata_id ? val.oh_sub_cata_id : '') + '">';
													SancationTable +='</td>';
													SancationTable += '<td><input type="text" class="tboxsmclass decimalnum" style="text-align:right;" name="proposed_amount[]" value ="' + ProposedAmt + '"></td>';
													SancationTable += '<td><input type="text" class="tboxsmclass decimalnum" style="text-align:right;" name="sanction_amount[]" value ="' + SanctionedAmt + '"></td>';
													SancationTable += '</tr>';
												});
											}
										}
										if (IsSubCata == 0) {
											SancationTable += '<tr>';
											SancationTable += '<td><input type="text" class="tboxsmclass" readonly value="' + (element.object_head_name ? element.object_head_name : '') + '">';
											SancationTable += '<input type="hidden" name ="obj_head_id[]" id="obj_head_id"class="tboxsmclass" value="' + (element.object_head_id ? element.object_head_id : '') + '">';
											SancationTable += '<input type="hidden" name ="obj_head_data_mode[]" id="obj_head_data_mode"class="tboxsmclass" value="OH">';
											SancationTable += '</td>';
											SancationTable += '<td><input type="text" class="tboxsmclass decimalnum" style="text-align:right;" name="proposed_amount[]" value ="' + ProposedAmtByObjHead + '"></td>';
											SancationTable += '<td><input type="text" class="tboxsmclass decimalnum" style="text-align:right;" name="sanction_amount[]" value ="' + SanctionedAmtByObjHead + '"></td>';
											SancationTable += '</tr>';
										}
									}else{
										SancationTable += '<tr>';
										SancationTable += '<td><input type="text" class="tboxsmclass" readonly value="' + (element.object_head_name ? element.object_head_name : '') + '">';
										SancationTable += '<input type="hidden" name ="obj_head_id[]" id="obj_head_id"class="tboxsmclass" value="' + (element.object_head_id ? element.object_head_id : '') + '">';
										SancationTable += '<input type="hidden" name ="obj_head_data_mode[]" id="obj_head_data_mode"class="tboxsmclass" value="OH">';
										SancationTable += '</td>';
										SancationTable += '<td><input type="text" class="tboxsmclass decimalnum" style="text-align:right;" name="proposed_amount[]" value ="' + ProposedAmtByObjHead + '"></td>';
										SancationTable += '<td><input type="text" class="tboxsmclass decimalnum" style="text-align:right;" name="sanction_amount[]" value ="' + SanctionedAmtByObjHead + '"></td>';
										SancationTable += '</tr>';
									}
								}	
								// if (IsSubCata == 0) {
								// 	SancationTable += '<tr>';
								// 	SancationTable += '<td><input type="text" class="tboxsmclass" readonly value="' + (element.object_head_name ? element.object_head_name : '') + '">';
								// 	SancationTable += '<input type="hidden" name ="obj_head_id[]" id="obj_head_id"class="tboxsmclass" value="' + (element.object_head_id ? element.object_head_id : '') + '">';
								// 	SancationTable += '<input type="hidden" name ="obj_head_data_mode[]" id="obj_head_data_mode"class="tboxsmclass" value="OH">';
								// 	SancationTable += '</td>';
								// 	SancationTable += '<td><input type="text" class="tboxsmclass decimalnum"></td>';
								// 	SancationTable += '<td><input type="text" class="tboxsmclass decimalnum"></td>';
								// 	SancationTable += '</tr>';
								// }
							}
							// });
						}
						SancationTable += '<input type="hidden" name ="project_id[]" id="project_id"class="tboxsmclass" value="' + (mappelement.project_id ? mappelement.project_id : '') + '"value="mappelement.)">';
					});
					
				}else{
					SancationTable += '<tr>';
					SancationTable += '<td colspan="4"  class="tboxsmclass decimalnum" style="text-align:center; ">No Records Found</td>';
					SancationTable += '</tr>';
				}
				SancationTable += '</tbody>';
				SancationTable += '</table>';
				$("#sanction_table_container").html(SancationTable);
			}
		});
	};
	var KillEvent = 0;
	$('body').on("click","#btn_save", function(event){ 
		if(KillEvent == 0){
			var GiaId 	        = $("#cmb_gia").val();
			var FinancialYear 	= $("#curr_final_year").val(); 
			var SancationNo 	= $("#sanction_no").val(); 
			if(GiaId =='' || GiaId == undefined){
				BootstrapDialog.alert("Error : Seclect the Grant-in-Aid..!");
				event.preventDefault();
				event.returnValue = false;
			}else if(FinancialYear == ""){
				BootstrapDialog.alert("Error : FinancialYear should not be empty .");
				event.preventDefault();
				event.returnValue = false;
			}else if(SancationNo == "") {
				BootstrapDialog.alert("Error : Sancation No should not be empty.!");
				event.preventDefault();
				event.returnValue = false;
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure you want to save the Budget Allocation  Details?',
					closable: false, // <-- Default value is false
					draggable: false, // <-- Default value is false
					btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
					btnOKLabel: 'Ok', // <-- Default value is 'OK',
					callback: function(result) {
						if(result){
							KillEvent = 1;
							$("#btn_save").trigger( "click" );
						}else {
							KillEvent = 0;
						}
					}
				});
			}
		}
	});
});

</script>
@endsection
