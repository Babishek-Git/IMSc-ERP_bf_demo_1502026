@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
 if(isset($data['BankData'])){
	$BankData = $data['BankData'];
	$BankName = collect($BankData)->pluck('bank_name')->first();
	$BankId = collect($BankData)->pluck('bank_id')->first();
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
								<div class="div5 mbtable">
									<!-- <div class="form-box"> -->
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Bank Name</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<div class="div3 label">Bank Name <span class="reqindi">*</span></div>											
												<div class="div9"><input type="text" name="bank_name" id="bank_name" maxlength="50" class="tboxsmclass textonly" value="@if(isset($data['BankData'])){{ $data['BankData']->bank_name }}@endif"></div>
												<input type="hidden" name = "bank_id" id = "bank_id" value = "@if(isset($data['BankData'])){{ encrypt($data['BankData']->bank_id) }}@endif">
												<div class="row smclearrow"></div>  
												@php $AddUrl = 'bank.ViewBankList'; @endphp
												<div class="row">
													<div class="div12" align="center">
<!-- 													<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" View " onClick="window.location='{{route($AddUrl)}}'" />
 -->												<buton type="submit" class="step-btn" name="btn_save" id="btn_save" value="Save">Save</button>	
													<input type="hidden" name="hid_bank_id" id="csrf-hid_bank_id" value="@if(isset($BankId)){{$BankId}}@endif" />
													<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
													</div>		
												</div>
												<div class="row smclearrow"></div>  
											</div>
										</div>
								</div>
								<!--  ===================== -->
								<div class="div7">
									<div class="table-box">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row table-divhead" align="center">Bank List</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<table class="table-bordered table1" width="99%" align="center" id="dataTable">
													<thead>
														<tr class="note heading">
															<th  style="text-align:center">SNo.</th>
															<th  style="text-align:center">Bank Name</th>
															<th  style="text-align:center">Action</th>
														</tr>
													</thead>
													<tbody>
													@if(isset($data['BankDataView']))
														@foreach($data['BankDataView'] as $Row)	
															<tr>
																<td align="center">{{ $loop->iteration }} </td>
																<td align="left">{{ $Row->bank_name}}</td>
																<!-- <td>{{($Row->bank_id)}}</td> -->
																<td><button type="button" name="btn_edit" class="btn btn-default tuploadbtn" id="btn_edit" value=" Edit" onclick="window.location='{{ route('bank.Bank',['id'=>encrypt($Row->bank_id)]) }}'"> <i class='fa fa-edit'></i> Edit </button>	</td>
															</tr>
														@endforeach
													@endif
													</tbody>
												</table>
												
											</div>
										</div>	
									</d/iv>									
								</div>
								<!-- =====================- -->
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
	
$("body").on("click","#btn_save", function(event){
	var BankName = $('#bank_name').val();
	if(BankName == ""){
		BootstrapDialog.alert("Please enter the Bank  Name!");
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




</script>

@endsection
