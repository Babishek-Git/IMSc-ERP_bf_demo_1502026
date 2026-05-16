@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
$FinYear             = Helper::GetCurrentFinYear(NULL);
$ProjectHeadMapArray = $data['ProjectHeadMapArray'] ?? [];
@endphp

<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="" method="post" enctype="multipart/form-data" name="form" autocomplete="off">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row ">
								<div class="div2">&nbsp;</div>
								<div class="div8 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Budget Claim Entry</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="row row-fluid line-control-menu-bar formtitlebar" style="border:none">
										<div class="btn-group floatr">
											<button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Save">Save</button>
											@if(isset($data['BudgetType']))
											@if($data['BudgetType'] == "CRA")
												&nbsp;<input type="button" class="backbutton" name="back" id="back" value=" Back " onclick="window.location='{{ route('budget.project-budget-sanction-initiate') }}'" />
											@endif
											@endif
											<input type="button" class="backbutton" name="home" id="home" value=" Home " onclick="window.location='{{ route('dashboard.index') }}'" />
										</div>
									</div>
										<div class="divrowbox innerdiv pt-2">
											<div class="div3 label">Grant-in-Aid</div>
											<div class="div9">                                                
												<select class="tboxsmclass ChosenInput" name="cmb_gia" id="cmb_gia">
													<option value=""> ------ Select ------ </option>
													@if(isset($data['GrandDetails']))
														@foreach($data['GrandDetails'] as $GaList)
															<option value="{{ $GaList->gia_id }}" data-code ="{{$GaList->gia_code }}">{{ $GaList->gia_name }}</option>
														@endforeach
													@endif
												</select>
                                            </div>  
											
											<div class="row smclearrow"></div>

											<div class="div3 label ShowDet">Project  Name</div>
											<div class="div9 ShowDet">                                                
												<select class="tboxsmclass" name="cmb_proj_name" id="cmb_proj_name" >
													<option value=""> ------ Select ------ </option>
													@if(isset($data['ProjectHeadGroupData']))
														@foreach($data['ProjectHeadGroupData'] as $List)
															<option value="{{ $List->project_id }}" data-parid="{{$List->project_parentid}}">{{ $List->project_name }}</option>
														@endforeach
													@endif
												</select>
                                            </div> 
											<div class="row smclearrow"></div>  
											<div class="div3 label">Financial Year</div>
											<div class="div4">                                                
												<input type="text" class="tboxsmclass" name="curr_final_year" id="curr_final_year" readonly value="{{ $FinYear ?? '' }}">
                                            </div>   
											<div class="row smclearrow"></div>  
											<div class="div3 label">Claim Date</div>
											<div class="div4">                                                
												<input type="text" class="tboxsmclass datepicker" name="claim_date" id="claim_date"  value="">
                                            </div> 
											<div class="row smclearrow ShowQUarter"></div>   
											<div class="div3 label ShowQUarter">Quarter</div>
											<div class="div4 ShowQUarter">                                                
												<select class="tboxsmclass ShowQUarter monthquarterVald" name="cmb_quarter" id="cmb_quarter" >
													<option value=""> ------ Select ------ </option>
													<option value="Q1"> Q1 </option>
													<option value="Q2"> Q2 </option>
													<option value="Q3"> Q3 </option>
													<option value="Q4"> Q4 </option>
												</select>
                                            </div> 

											<div class="row smclearrow ShowMonth"></div>    
											<div class="div3 label ShowMonth">Month</div>
											<div class="div4 ShowMonth">                                                
												<select class="tboxsmclass ShowMonth monthquarterVald" name="cmb_month" id="cmb_month" >
													<option value=""> ------ Select ------ </option>
													<option value="04">April</option>
													<option value="05">May</option>
													<option value="06">June</option>
													<option value="07">July</option>
													<option value="08">August</option>
													<option value="09">September</option>
													<option value="10">October</option>
													<option value="11">November</option>
													<option value="12">December</option>
													<option value="01">January</option>
													<option value="02">February</option>
													<option value="03">March</option>
												</select>
                                            </div> 
											<div class="div5 ShowMonth"></div>  
											<div class="row smclearrow"></div>                                                                                											
											<div class="row smclearrow"></div>                                                                                											
												<div id="sanction_table_container"></div>                                         
											<div class = "GR1"><div class="row smclearrow"></div></div>  										
											<div class="row">
												<div class="div-12" align="center">
                                                    <!-- <input type="button" name="btn_back" id="btn_back" class="backbutton" value=" Back "> -->
													<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
													<input type="hidden" name="txt_budget_type" id="txt_budget_type" value="{{ $data['BudgetType'] }}" />
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
    $(".ChosenInput").chosen();
    $(".ShowDet").hide();
    $(".ShowQUarter").hide();
    $(".ShowMonth").hide();
    $(".decimalnum").on("input", function () {
        this.value = this.value.replace(/[^0-9.]/g, '');
    });
    $('body').on("change", "#cmb_gia", function (e) {
		$("#cmb_month").val('');
		$("#cmb_quarter").val('');
        $("#sanction_table_container").html('');
        $(".ShowDet").hide();
        var GiaId   = $(this).val();
        var Giacode = $(this).find(':selected').data('code');
        if (Giacode == 'CRA') {
            $(".ShowDet").show();
            $(".ShowQUarter").show();
            $(".ShowMonth").hide();
            if ($("#cmb_proj_name").data('chosen')) {
                $("#cmb_proj_name").chosen('destroy');
            }
            $("#cmb_proj_name").chosen();
        } else {
            $(".ShowQUarter").hide();
            $(".ShowMonth").show();
            if ($("#cmb_month").data('chosen')) {
                $("#cmb_month").chosen('destroy');
            }
            $("#cmb_month").chosen();
        }
    });
	$('body').on("change", "#cmb_month", function (e) {
		var ClaimText     = $("#cmb_month option:selected").text();
		var ClaimType      = $("#cmb_month option:selected").val();
		var Month         = $(this).val();
		var FinancialYear = $("#curr_final_year").val();
		var GiaId         = $("#cmb_gia").val();
		var Giacode       = $("#cmb_gia option:selected").data('code');
		var ProjectId     = '';
		var ProjectParId  = '';
		loadSanctionTable(GiaId,Giacode,ProjectId,ProjectParId,FinancialYear,ClaimText,ClaimType);
	});
	$('body').on("change", "#cmb_quarter", function (e) {
		var ProjectName   = $("#cmb_proj_name").val(); 
		if(ProjectName == '' || ProjectName == null){
			$(this).val('');
			BootstrapDialog.alert("Error : Select the Project Name ..!");
			event.preventDefault();
			event.returnValue = false;
		}else{
			var Quarter       = $(this).val();
			var ClaimText     = $("#cmb_quarter option:selected").text();
			var ClaimType      = $("#cmb_quarter option:selected").val();
			var FinancialYear = $("#curr_final_year").val();
			var GiaId         = $("#cmb_gia").val();
			var Giacode       = $("#cmb_gia option:selected").data('code');
			var ProjectId     = $("#cmb_proj_name").val(); 
			var ProjectParId  = $("#cmb_proj_name").find(':selected').data('parid');
			loadSanctionTable(GiaId,Giacode,ProjectId,ProjectParId,FinancialYear,ClaimText,ClaimType);
		}
	});
	$('body').on("change", "#cmb_proj_name", function (e) {
		$("#cmb_quarter").val('');
        $("#sanction_table_container").html('');
	});
	function loadSanctionTable(GiaId,Giacode,ProjectId,ProjectParId,FinancialYear,ClaimText,ClaimType) {
		var LabelText = ClaimText ?? '';
		$.ajax({
			type: 'POST',
			url: '{{ route("budget.sanction-details") }}',
			data: {
				"_token": "{{ csrf_token() }}",
				GiaId: GiaId,
				Giacode: Giacode,
				ProjectId: ProjectId,
				ProjectParentId: ProjectParId,
				FinancialYear: FinancialYear,
				ClaimTypeId: ClaimType
			},
			success: function (data) { //console.log(data);
				$("#sanction_table_container").html('');
				var ObjectHeadSubCategoryData    = data.ObjectSubCategoryData ?? [];
				var ObjectHeadGaiMappData        = data.AllObectHeadGaiMappingData ?? [];
				var AllObectHead                 = data.AllObjHeadData ?? [];
				var AllObjHeadSubCatGroupByData  = data.AllObjHeadSubCatGroupByData ?? [];
				var BudgetAllocationData         = data.BudgetAllocationData ?? [];
				var BudgetClaimData              = data.ClaimData ?? [];
				
				var SancationTable = '';
					SancationTable += '<table class="attTable" align="center" id="RelationshipTable" width="100%">';
					SancationTable += '<thead>';
					SancationTable += '<tr>';
					SancationTable += '<th style="vertical-align:middle; text-align:center;">Object Head</th>';
					// SancationTable += '<th>Proposed Amount (Rs.)</th>';
					SancationTable += '<th style="vertical-align:middle; text-align:center;">Allocation Amount (₹ in Lakhs) <br>' + FinancialYear + '</th>';
					SancationTable += '<th style="vertical-align:middle; text-align:center;">Claim Amount (₹ in Lakhs) <br>' + LabelText + '</th>';
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
   									var BugAllocatedId         = AllocationByObjHead ? AllocationByObjHead.budget_allocation_id : '';
									var ClaimDataByAlloc       = BudgetClaimData.find(item => item.budget_allocation_id == BugAllocatedId);
									var ClaimedAmount          = ClaimDataByAlloc ? ClaimDataByAlloc.claimed_amount : '';
									var ClaimedDate            = ClaimDataByAlloc ? ClaimDataByAlloc.claimed_date : '';
									$("#claim_date").val(ClaimedDate);
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
   													var BugAllocatedId   = Allocation ? Allocation.budget_allocation_id : '';
													var ClaimDataByAlloc = BudgetClaimData.find(item => item.budget_allocation_id == BugAllocatedId);
													var ClaimedAmount    = ClaimDataByAlloc ? ClaimDataByAlloc.claimed_amount : '';
													var ClaimedDate      = ClaimDataByAlloc ? ClaimDataByAlloc.claimed_date : '';
													$("#claim_date").val(ClaimedDate);
													SancationTable += '<tr>';
													SancationTable += '<td><input type="text" class="tboxsmclass" readonly value="' + (val.oh_sub_cata_name ? val.oh_sub_cata_name : '') + '">';
													SancationTable += '<input type="hidden" name ="obj_head_id[]" id="obj_head_id"class="tboxsmclass" value="' + (val.object_head_id ? val.object_head_id : '') + '">';
													SancationTable += '<input type="hidden" name ="obj_head_data_mode[]" id="obj_head_data_mode"class="tboxsmclass" value="OHSC">';
													SancationTable += '<input type="hidden" name ="obj_head_sub_id[]" id="obj_head_sub_id"class="tboxsmclass" value="' + (val.oh_sub_cata_id ? val.oh_sub_cata_id : '') + '">';
													SancationTable +='</td>';
													// SancationTable += '<td><input type="text" class="tboxsmclass decimalnum" readonly name="proposed_amount[]" value ="' + ProposedAmt + '"></td>';
													SancationTable += '<td><input type="text" class="tboxsmclass decimalnum" readonly style="text-align:right;" name="sanction_amount[]" value ="' + SanctionedAmt + '"></td>';
													SancationTable += '<td><input type="text" class="tboxsmclass decimalnum" style="text-align:right;" name="claim_amount[]" value ="' + ClaimedAmount + '"></td>';
													SancationTable += '<input type="hidden" name ="bud_allocted_id[]" id="bud_allocted_id"class="tboxsmclass" value="' + BugAllocatedId + '">';
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
											// SancationTable += '<td><input type="text" class="tboxsmclass decimalnum" readonly name="proposed_amount[]" value ="' + ProposedAmtByObjHead + '"></td>';
											SancationTable += '<td><input type="text" class="tboxsmclass decimalnum" readonly style="text-align:right;" name="sanction_amount[]" value ="' + SanctionedAmtByObjHead + '"></td>';
											SancationTable += '<td><input type="text" class="tboxsmclass decimalnum" style="text-align:right;" name="claim_amount[]" value ="' + ClaimedAmount + '"></td>';
											SancationTable += '<input type="hidden" name ="bud_allocted_id[]" id="bud_allocted_id"class="tboxsmclass" value="' + BugAllocatedId  + '">';
											SancationTable += '</tr>';
										}
									}else{
										SancationTable += '<tr>';
										SancationTable += '<td><input type="text" class="tboxsmclass" readonly value="' + (element.object_head_name ? element.object_head_name : '') + '">';
										SancationTable += '<input type="hidden" name ="obj_head_id[]" id="obj_head_id"class="tboxsmclass" value="' + (element.object_head_id ? element.object_head_id : '') + '">';
										SancationTable += '<input type="hidden" name ="obj_head_data_mode[]" id="obj_head_data_mode"class="tboxsmclass" value="OH">';
										SancationTable += '</td>';
										// SancationTable += '<td><input type="text" class="tboxsmclass decimalnum" readonly name="proposed_amount[]" value ="' + ProposedAmtByObjHead + '"></td>';
										SancationTable += '<td><input type="text" class="tboxsmclass decimalnum"  style="text-align:right;" readonlyname="sanction_amount[]" value ="' + SanctionedAmtByObjHead + '"></td>';
										SancationTable += '<td><input type="text" class="tboxsmclass decimalnum" style="text-align:right;" name="claim_amount[]" value ="' + ClaimedAmount + '"></td>';
										SancationTable += '<input type="hidden" name ="bud_allocted_id[]" id="bud_allocted_id"class="tboxsmclass" value="' + BugAllocatedId + '">';
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
	var KillEvent = 0;
	$('body').on("click","#btn_save", function(event){ 
		if(KillEvent == 0){
			var Gaiid 	    = $("#cmb_gia").val();
			var ClaimDate 	= $("#claim_date").val();
			var Month       = $("#cmb_month").val();
			var Quarter     = $("#cmb_quarter").val(); 
			var Giacode     = $("#cmb_gia option:selected").data('code');

			if(Gaiid == ''){
				BootstrapDialog.alert("Error : Select the Grant-in-Aid..!");
				event.preventDefault();
				event.returnValue = false;
			}else if(ClaimDate == ''){
				BootstrapDialog.alert("Error : Claim Date Should not be in empty..!");
				event.preventDefault();
				event.returnValue = false;
			}else if( Giacode != 'CRA' && Month == "") {
				BootstrapDialog.alert("Error : Select the  Month ..!");
				event.preventDefault();
				event.returnValue = false;
			}else if( Giacode == 'CRA' &&  Quarter == '') {
				BootstrapDialog.alert("Error : Select the Quarter..!");
				event.preventDefault();
				event.returnValue = false;
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure you want to save the Budget claim  Details?',
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
