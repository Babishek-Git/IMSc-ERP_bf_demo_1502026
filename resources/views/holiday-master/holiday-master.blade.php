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
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Holiday Master</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
												<div class="div4 label">Holiday Name <span class="reqindi">*</span></div>											
												<div class="div8"><input type="text" name="txt_holi_name" id="txt_holi_name"  class="tboxsmclass" value=""></div>
												<div class="div4 label">Holiday Date <span class="reqindi">*</span></div>											
												<div class="div8"><input type="text" name="txt_holi_date" id="txt_holi_date"  class="tboxsmclass datepicker" value=""  ></div>
												<div class="div4 label">Holiday Type<span class="reqindi"> *</span></div>
													<div class="div8">
														<select name="cmb_holi" id="cmb_holi" class="tboxsmclass ChosenInput">
														<option value="">-------- Select------</option>
														<option value="GH">Goverment Holiday</option>
														<option value="RH">Regional Holiday</option>
														@if(isset($data['LeafNode']))
																	@foreach($data['LeafNode'] as $LeafNode)
																		<option value="{{$LeafNode->holiday_id}}">{{$LeafNode->holiday_type}}</option>
																	@endforeach
																@endif
														</select>
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
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row table-divhead" align="center">DAE Sanction List</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<table class="table-bordered table1" width="99%" align="center" id="dataTable">
													<thead>
														<tr class="note heading">
															<th  style="text-align:center">SNo.</th>
															<th  style="text-align:center">Holiday Name</th>
															<th  style="text-align:center">Holiday Date</th>
															<th  style="text-align:center">Holiday Type</th>
															<th  style="text-align:center">Action</th>
														</tr>
													</thead>
													<tbody>
													@if(isset($data['HolidayData']))
														@foreach($data['HolidayData'] as $HolidayData)
															<tr>
																<td align="center">{{ $loop->iteration }} </td>
																<td align="left">{{ $HolidayData->holiday_name }}</td>
																<td align="left">{{ Helper::DisplayDateFormat($HolidayData->holiday_date) }}</td>
																<td align="left">{{ $HolidayData->holiday_type }}</td>
																
															   
																<td><button type="button" name="btn_edit" class="btn btn-default tuploadbtn" id="btn_edit" value=" Edit" onclick="window.location='{{ route(''holiday-master.holiday-master',['id'=>encrypt($HolidayData->rbi_sanction_id)]) }}'"> <i class='fa fa-edit'></i> Edit </button></td>

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
	$(document).ready(function() {
		$("#state_name").chosen();
		$("#bank_name").chosen();

	});


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