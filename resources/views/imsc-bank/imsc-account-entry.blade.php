@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php
 if(isset($data['BankBranchData'])){
	
	$BankBranchData = $data['BankBranchData'];
	
	$BankName = collect($BankBranchData)->pluck('bank_id')->first();
	$BranchName = collect($BankBranchData)->pluck('branch_id')->first();
	
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
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">IMSc Account No.  Entry Form</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
												
												<div class="div4 label">Account Name<span class="reqindi">*</span></div>											
												<div class="div8"><input type="text" name="txt_acc_name" id="txt_acc_name"  class="tboxsmclass" value=""></div>	
												<div class="row smclearrow"></div>																																																				
												
												<div class="div4 label">Account No<span class="reqindi">*</span> </div>											
												<div class="div8"><input type="text" name="txt_acc_no" id="txt_acc_no" class="tboxsmclass alphanumeric" value="" ></div>
												<div class="row smclearrow"></div>
												<div class="div4 label">Ifsc Code <span class="reqindi">*</span></div>											
												<div class="div8">
												<select name="cmb_ifsc_code" id="cmb_ifsc_code" class="tboxsmclass ChosenInput">
													<option value="">--------------- Select ---------------</option>
													@if(isset ($data['BankBranchData']))
														@foreach($data['BankBranchData'] as $BankBranchData)
															<option value="{{$BankBranchData->ifsc_code}}">{{$BankBranchData->ifsc_code}}</option>
														@endforeach
													@endif
												</select>
												</div>
												<div class="row smclearrow"></div>
												<div class="div4 label">Bank Name<span class="reqindi">*</span> </div>											
												<div class="div8">
														<input type="text" name="txt_bank_name" id="txt_bank_name" class="tboxsmclass" value="">
														<input type="hidden" name="txt_bank_id" id="txt_bank_id" class="tboxsmclass" value="">
													</div>
												<div class="row smclearrow"></div>
												<div class="div4 label">Branch Address<span class="reqindi">*</span></div>											
												<div class="div8">
													<input type="text" name="txt_branch_addr" id="txt_branch_addr"  class="tboxsmclass" value="">
												    <input type="hidden" name="txt_branch_id" id="txt_branch_id" class="tboxsmclass" value=""  >
												</div>
												<div class="row smclearrow"></div> 
												@php $AddUrl = 'bank.ViewBankBranchList'; @endphp
												<div class="row">
													<div class="div12" align="center">
													<!-- <input type="button" class="backbutton" name="btn_view" id="btn_view" value=" View " onClick="window.location='{{route($AddUrl)}}'" /> -->
													<button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Save">Save</button>
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
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row table-divhead" align="center">IMSc Account No. List Form</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<table class="table-bordered table1" width="99%" align="center" id="dataTable">
													<thead>
														<tr class="note heading">
															<th  style="text-align:center">SNo.</th>
															<th  style="text-align:center">Account Name</th>
															<th  style="text-align:center">Account No.</th>
															<th  style="text-align:center">IFSC Code</th>
															<th  style="text-align:center">Bank Name</th>
															<th  style="text-align:center">Branch Name</th>
															<th  style="text-align:center">Action</th>
														</tr>
													</thead>
													<tbody>
													@if(isset($data['ImscAccountData']))
														@foreach($data['ImscAccountData'] as $ImscAccountData)
															<tr>
																<td align="center">{{ $loop->iteration }} </td>
																<td align="left">{{ $ImscAccountData->account_name }}</td>
																<td align="left">{{ $ImscAccountData->account_no }}</td>
																<td align="left">{{ $ImscAccountData->ifsc_code }}</td>
																<td align="left">{{ $ImscAccountData->bank_name }}</td>
																<td align="left">{{ $ImscAccountData->branch_addr1 }}</td>
																<td><button type="button" name="btn_edit" class="btn btn-default tuploadbtn" id="btn_edit" value=" Edit" onclick="window.location='{{ route('bank.imsc-account-entry',['id'=>encrypt($ImscAccountData->account_id)]) }}'"> <i class='fa fa-edit'></i> Edit </button></td>

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
	$(".ChosenInput").chosen();	
	$('#dataTable').DataTable({
		responsive: true,
		paging: true, 
	});
	
	$("body").on("change", "#cmb_ifsc_code", function (event) {
	$("#txt_bank_name").val('');
	$("#txt_bank_id").val('');
	$("#txt_branch_address").val('');
	$("#txt_branch_id").val('');
    var IfscCode = $(this).val();
    if ((IfscCode!='') && (IfscCode!=null)) {
        $.ajax({
            type: 'POST',
            url: "{{ route('bank.GetBankData') }}",
            data: { "_token": "{{ csrf_token() }}", 'IfscCode': IfscCode },
            // dataType: 'json',
            success: function (data) {
                if (data != '') {
                    let BankData = data['BankData']; console.log(BankData);
                    if ((BankData != '') && (BankData != null)) {
                        //$("#section_name").empty();
                        $.each(BankData, function (index, element) {
							let BankName  	= element.bank_name; 
							let BranchAddr  = element.branch_addr1;
							let BranchId 	= element.branch_id;
							let BankId 		= element.bank_id;
							$("#txt_bank_name").val(BankName);
							$("#txt_bank_id").val(BankId);
							$("#txt_branch_addr").val(BranchAddr);
							$("#txt_branch_id").val(BranchId);
                           
                        });
                    }else{
						BootstrapDialog.alert("Please Enter the Correct IFSC Code");
						$("#cmb_ifsc_code").val(''); 
					}
                }
            }
        });
    }
	
});


</script>

@endsection