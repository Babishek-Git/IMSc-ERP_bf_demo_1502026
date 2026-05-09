@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php
 if(isset($data['BankBranchData'])){
	
	$BankBranchData = $data['BankBranchData'];
	$BankName = collect($BankBranchData)->pluck('bank_id')->first();
	$IFFCCode = collect($BankBranchData)->pluck('ifsc_code')->first();
	$BranchAddr = collect($BankBranchData)->pluck('branch_addr1')->first();
	$StateId = collect($BankBranchData)->pluck('state_id')->first();
	$CityName = collect($BankBranchData)->pluck('branch_city')->first();
}
@endphp

<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="" method="post" enctype="multipart/form-data" name="form">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row plr">
								<!-- <div class="div2">&nbsp;</div> -->
								<div class="div5 mbtable">
									<!-- <div class="form-box"> -->
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">External Sanction</div></div></div>
										<input type="hidden" name="txt_section_category" id="txt_section_category"  class="tboxsmclass" value="EXT">
										<input type="hidden" name="txt_internal_external" id="txt_internal_external"  class="tboxsmclass" value="E">
										<input type="hidden" name="txt_sanction_type" id="txt_sanction_type"  class="tboxsmclass" value="NR">
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
												<div class="div4 label">Project Name<span class="reqindi"> *</span></div>
												<div class="div8">
													<select name="cmb_project_name" id="cmb_project_name" class="tboxsmclass ChosenInput">
													<option value="">-------- Select------</option>
														@if(isset($data['ProjectData']))
															@foreach($data['ProjectData'] as $ProjectData)
																<option value="{{$ProjectData->project_id}}">{{$ProjectData->project_name}}</option>
															@endforeach
														@endif
													</select>
												</div>
												<div class="div4 label">Financial year<span class="reqindi"> *</span></div>
												<div class="div8">
													<select name="cmb_fin_year" id="cmb_fin_year" class="tboxsmclass ChosenInput">
													<option value="">-------- Select------</option>
													<option value="2025-2026">2025-2026</option>
														@if(isset($data['LeafNode']))
															@foreach($data['LeafNode'] as $LeafNode)
																<option value="{{$LeafNode->ledger_group_id}}">{{$LeafNode->ledger_group_name}}</option>
															@endforeach
														@endif
													</select>
												</div>
												<!-- <div class="div4 label">Grant-In-Aid<span class="reqindi"> *</span></div>
												<div class="div8">
													<select name="cmb_gia" id="cmb_gia" class="tboxsmclass ChosenInput">
													<option value="">-------- Select------</option>
														@if(isset($data['GrantinaidData']))
															@foreach($data['GrantinaidData'] as $GrantinaidData)
																<option value="{{$GrantinaidData->gia_id}}">{{$GrantinaidData->gia_name}}</option>
															@endforeach
														@endif
													</select>
												</div> -->
												<div class="div4 label">External Sanction No. <span class="reqindi">*</span></div>		
												<div class="div8"><input type="text" name="txt_sanction_no" id="txt_sanction_no"  class="tboxsmclass" value=""></div>										
												<div class="row smclearrow"></div> 
												
												
												<div class="row smclearrow"></div> 
												<div class="div4 label"> Sanction Amount <span class="reqindi">*</span> </div>											
												<div class="div8"><input type="text" name="txt_sanction_amount" id="txt_sanction_amount" class="tboxsmclass alphanumeric" value="" ></div>
												<div class="row smclearrow"></div> 
												<div class="div4 label">DAE Apex Sanction Date <span class="reqindi">*</span></div>											
												<div class="div8"><input type="text" name="txt_sanction_date" id="txt_sanction_date"  class="tboxsmclass datepicker" value=""  ></div>
												<div class="row smclearrow"></div> 
												<div class="div4 label label">
													Sanction Type <span class="reqindi">*</span>
												</div>
												<div class="div3">
													<div class="inputGroup paddlr2">
														<input id="rad_recurring" name="rad_sanction_type" type="radio" value="R"/>
														<label for="rad_recurring" style="padding:3px 0px; width:100%"> &nbsp;Recurring</label>
													</div>
												</div>
												<div class="div3">
													<div class="inputGroup paddlr2">
														<input id="rad_non_recurring" name="rad_sanction_type" type="radio" value="NR" checked/>
														<label for="rad_non_recurring" style="padding:3px 0px; width:100%"> &nbsp;Non Recurring</label>
													</div>
												</div> 
												

												<div class="row smclearrow"></div> 
												@php $AddUrl = 'bank.ViewBankBranchList'; @endphp
												<div class="row">
													<div class="div12" align="center">
													<!-- <input type="button" class="backbutton" name="btn_view" id="btn_view" value=" View " onClick="window.location='{{route($AddUrl)}}'" /> -->
													<button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Save">Save</button>
													<input type="hidden" name="hid_bankbranch_id" id="csrf-hid_bankbranch_id" value="@if(isset($BankBranchId)){{$BankBranchId}}@endif" />
													<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
													</div>		
												</div>
												<div class="row smclearrow"></div>  
											</div>
										</div>
									</div>										
								<!-- </div> -->
								<div class="div7">
									<div class="table-box">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row table-divhead" align="center">External Sanction List</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<table class="table-bordered table1" width="99%" align="center" id="dataTable">
													<thead>
														<tr class="note heading">
															<th  style="text-align:center">SNo.</th>
															<th  style="text-align:center">Project Name</th>
															<th  style="text-align:center">External Sanction No.</th>
															<th  style="text-align:center">External Sanction Amount</th>
															<th  style="text-align:center">External Sanction Date</th>
															<th  style="text-align:center">External Sanction Type</th>
															<th  style="text-align:center">Action</th>
														</tr>
													</thead>
													<tbody>
													@if(isset($data['SanctionData']))
														@foreach($data['SanctionData'] as $SanctionData)
															<tr>
																<td align="center">{{ $loop->iteration }} </td>
																<td align="left">{{ $SanctionData->project_name }}</td>
																<td align="left">{{ $SanctionData->budget_sanction_no }}</td>
																<td align="left">{{ $SanctionData->budget_sanction_amt }}</td>
																<td align="left">{{ Helper::DisplayDateFormat($SanctionData->budget_sanction_date) }}</td>
															   	<td align="center">
																@if($SanctionData->sanction_type == "R"){{ 'Recurring' }}@endif
																@if($SanctionData->sanction_type == "NR"){{ 'Non-Recurring' }}@endif
															</td>
																<td><button type="button" name="btn_edit" class="btn btn-default tuploadbtn" id="btn_edit" value=" Edit" onclick="window.location='{{ route('bank.rbi-sanction',['id'=>encrypt($SanctionData->rbi_sanction_id)]) }}'"> <i class='fa fa-edit'></i> Edit </button></td>

															</tr>
														@endforeach
													@endif
													</tbody>
												</table>
												
											</div>
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
	$('#dataTable').DataTable({
		responsive: true,
		paging: true, 
	});
	$(".ChosenInput").chosen();


$("body").on("click","#btn_save", function(event){
	var BankName = $('#bank_name').val();
	var IFSCCode = $('#ifsc_code').val();
	var BranchAddr = $('#branch_Address').val();
	var StateName = $('#state_name').val();
	var CityName = $('#city_name').val();
	if(BankName == ""){
		BootstrapDialog.alert("Please select the Bank  Name!");
		event.preventDefault();
		event.returnValue = false;
	}else if(IFSCCode == ""){
		BootstrapDialog.alert("Please Enter the IFSC Code!");
		event.preventDefault();
		event.returnValue = false;
	}else if(BranchAddr == ""){
		BootstrapDialog.alert("Please Enter the Bank  Address!");
		event.preventDefault();
		event.returnValue = false;
	}else if(StateName == ""){
		BootstrapDialog.alert("Please select the State Name!");
		event.preventDefault();
		event.returnValue = false;
	}else if(CityName == ""){
		BootstrapDialog.alert("Please enter the City Name!");
		event.preventDefault();
		event.returnValue = false;
	}
});

$('body').on('keypress', ".textonly", function(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (!(charCode >= 65 && charCode <= 90) &&   
        !(charCode >= 97 && charCode <= 122) && 
        charCode !== 32) {                     
        return false;
    } else {
        return true;
    }
});
$('body').on('keypress', ".alphanumeric", function(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (!((charCode >= 48 && charCode <= 57) ||   
          (charCode >= 65 && charCode <= 90) ||   
          (charCode >= 97 && charCode <= 122))) {  
        return false;
    } else {
        return true;
    }
});





</script>

@endsection