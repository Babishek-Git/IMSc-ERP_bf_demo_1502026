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
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Bank Branch</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<div class="div3 label">Bank Name <span class="reqindi">*</span></div>											
												<div class="div9">
												<select name="bank_name" id="bank_name" class="textboxdisplay" style="width:400px;height:30px">
													<option value="">--------------- Select ---------------</option>
													@if(isset ($data['BankList']))
														@foreach($data['BankList'] as $key => $value)
															@if($value->active == 1)
																@php 
																$SelStr = "";
																if(isset($data['BankBranchData'])){
																	if($data['BankBranchData']->bank_id == $value->bank_id){
																		$SelStr = 'selected="selected"';
																	} 
																}
																@endphp
																<option value="{{$value->bank_id}}" {{$SelStr}}>{{$value->bank_name}}</option>
															@endif
														@endforeach
													@endif
												</select>
												</div>
											
												<div class="div3 label">State Name <span class="reqindi">*</span></div>											
												<div class="div9">
												<select name="state_name" id="state_name" class="textboxdisplay" style="width:400px;height:30px">
													<option value="">--------------- Select ---------------</option>																
													@if(isset ($data['StateList']))
														@foreach($data['StateList'] as $key => $value)
															@if($value->active == 1)
																@php 
																$SelStr = "";
																if(isset($data['BankBranchData'])){
																	if($data['BankBranchData']->state_id == $value->state_id){
																		$SelStr = 'selected="selected"';
																	} 
																}
																@endphp
																<option value="{{$value->state_id}}"  {{$SelStr}}>{{$value->state_name}}</option>
															@endif
														@endforeach
													@endif
												</select>
												</div>

												<div class="div3 label">City Name <span class="reqindi">*</span></div>											
												<div class="div9"><input type="text" name="city_name" id="city_name"  class="tboxsmclass textonly" value="@if(isset($data['BankBranchData'])){{ $data['BankBranchData']->branch_city }}@endif" style="width:400px" ></div>																																																					
												
												<div class="div3 label">IFSC Code <span class="reqindi">*</span> </div>											
												<div class="div9"><input type="text" name="ifsc_code" id="ifsc_code" class="tboxsmclass alphanumeric" value="@if(isset($data['BankBranchData'])){{ $data['BankBranchData']->ifsc_code }}@endif" style="width:400px"></div>

												<div class="div3 label">Branch Address <span class="reqindi">*</span></div>											
												<div class="div9"><input type="text" name="branch_Address" id="branch_Address"  class="tboxsmclass" value="@if(isset($data['BankBranchData'])){{ $data['BankBranchData']->branch_addr1 }}@endif" style="width:400px" ></div>

												<input type="hidden" name = "branch_id" id = "branch_id" value = "@if(isset($data['BankBranchData'])){{ encrypt($data['BankBranchData']->branch_id) }}@endif">																														
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
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row table-divhead" align="center">Bank Branch List</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<table class="table-bordered table1" width="99%" align="center" id="dataTable">
													<thead>
														<tr class="note heading">
															<th  style="text-align:center">SNo.</th>
															<th  style="text-align:center">Bank Name</th>
															<th  style="text-align:center">Branch Address</th>
															<th  style="text-align:center">IFSC code</th>
															<th  style="text-align:center">State Name</th>
															<th  style="text-align:center">Action</th>
														</tr>
													</thead>
													<tbody>
													@if(isset($data['BankBranchView']))
														@foreach($data['BankBranchView'] as $BankBranchView)
															<tr>
																<td align="center">{{ $loop->iteration }} </td>
																<td align="left">{{ $BankBranchView->bank_name }}</td>
																<td align="left">{{ $BankBranchView->branch_addr1 }}</td>
																<td align="left">{{ $BankBranchView->ifsc_code }}</td>
																<td align="left">{{ $BankBranchView->state_name }}</td>
																<!-- <td align="left">{{ $BankBranchView->branch_city }}</td> -->
																<td><button type="button" name="btn_edit" class="btn btn-default tuploadbtn" id="btn_edit" value=" Edit" onclick="window.location='{{ route('bank.BankBranch',['id'=>encrypt($BankBranchView->branch_id)]) }}'"> <i class='fa fa-edit'></i> Edit </button></td>

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